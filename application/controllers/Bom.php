<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bom extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('Bom_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['row'] = $this->Bom_model->get();
        $this->template->load('templates/template', 'bom/index', $data);
    }

    public function approval($id)
    {
        $data['row'] = $this->Bom_model->get($id);
        $data['row2'] = $this->Bom_model->get_komen($id);
        $this->template->load('templates/template', 'bom/approval', $data);
    }

    public function add()
    {
        // ================= UPLOAD CONFIG =================
        $config['upload_path']   = './uploads/eco_file/';
        $config['allowed_types'] = 'xls|xlsx';
        $config['max_size']      = 51200;

        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        }

        $this->load->library('upload', $config);

        // Upload file 1
        $this->upload->initialize($config);
        $file1 = "";
        if ($this->upload->do_upload('attachment1')) {
            $file1_data = $this->upload->data();
            $file1 = $file1_data['file_name'];
        }

        // ================= MAIN BOM TABLE =================
        $data = [
            'no_pn'        => $this->input->post('no_pn'),
            'file_bom'     => $file1,
            'u_created'    => $this->input->post('u_created'),
            'status'       => 'In Progress',
            'remarks'      => $this->input->post('remarks')
        ];

        $this->Bom_model->insert($data);
        redirect('bom');
    }

    public function update_approval()
    {
        $id_bom   = $this->input->post('id_bom');
        $col_name = $this->input->post('approval_column');
        $value    = $this->input->post('approval_value');

        if (!empty($id_bom) && !empty($col_name)) {
            // 🔹 1. Update kolom approval yang sesuai
            $this->db->where('id_bom', $id_bom);
            $this->db->update('bom', [$col_name => $value]);

            // 🔹 2. Ambil ulang data ECO untuk pengecekan status
            $bom = $this->db->get_where('bom', ['id_bom' => $id_bom])->row();

            if ($bom) {
                // 🔹 3. Daftar semua kolom approval
                $approvals = [
                    $bom->approv1,
                    $bom->approv2,
                    $bom->approv3,
                    $bom->approv4,
                    $bom->approv5,
                    $bom->approv6,
                    $bom->approv7
                ];

                // 🔹 4. Cek apakah semua sudah diisi
                $incomplete = in_array(null, $approvals, true) || in_array('', $approvals, true);

                // 🔹 5. Jika semua sudah terisi → update status jadi "Complete"
                if (!$incomplete) {
                    $this->db->where('id_bom', $id_bom);
                    $this->db->update('bom', ['status' => 'Complete']);
                } else {
                    $this->db->where('id_bom', $id_bom);
                    $this->db->update('bom', ['status' => 'In Progress']);
                }
            }
        } else {
            $this->session->set_flashdata('error', 'Invalid data.');
        }

        // 🔹 6. Redirect kembali
        redirect('bom');
    }

    //save komentar
    public function komentar()
    {
        $id   = $this->input->post('id_bom');

        // insert
        $data = [
            'id_bom'        => $this->input->post('id_bom'),
            'nama_user'     => $this->input->post('nama_user'),
            'komen'         => $this->input->post('komentar'),
            'tipe'          => 'BOM'
        ];
        $this->Bom_model->insert_komen($data);
        redirect('bom/approval/' . $id);
    }
}
