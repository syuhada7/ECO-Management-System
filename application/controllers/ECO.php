<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ECO extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model('Eco_model');
        $this->load->library('form_validation', 'upload');
        $this->load->model(['User_model', 'Delivery_model']);
    }

    public function index()
    {
        $data['row'] = $this->Eco_model->get();
        $this->template->load('templates/template', 'eco/index', $data);
    }
    public function detail_ajax()
    {
        $id = $this->input->post('id_eco');
        $data['eco_rows'] = $this->Eco_model->get_detail($id);
        $this->load->view('eco/detail_eco', $data);
    }
    public function regis()
    {
        $data['next_id'] = $this->Eco_model->get_next_id();
        $this->template->load('templates/template', 'eco/regis', $data);
    }
    public function delivery($id = null, $rm = null)
    {
        if (!$id || !$rm) {
            echo json_encode(['error' => 'Parameter tidak lengkap']);
            return;
        }

        // Validasi material_id dan material_no cocok
        $material = $this->Eco_model->get_rm($id, $rm);
        if (!$material) {
            echo json_encode(['error' => 'Material tidak ditemukan']);
            return;
        }
        $data['row'] = $this->Delivery_model->get_rm($id, $rm);
        $this->template->load('templates/template', 'eco/delivery', $data);
    }

    // Halaman detail berdasarkan ID & Material
    public function v_list($id = null, $rm = null)
    {
        if (!$id || !$rm) {
            echo json_encode(['error' => 'Parameter tidak lengkap']);
            return;
        }

        // Validasi material_id dan material_no cocok
        $material = $this->Eco_model->get_rm($id, $rm);
        if (!$material) {
            echo json_encode(['error' => 'Material tidak ditemukan']);
            return;
        }

        $data['row'] = $this->Eco_model->get($id);
        $data['row2'] = $this->Eco_model->get_rm($id, $rm);
        $data['row3'] = $this->Delivery_model->get_rm($id, $rm);
        $data['materials'] = $this->Delivery_model->get_all_materials();
        $this->template->load('templates/template', 'eco/v_list', $data);
    }
    public function meeting($id)
    {
        $data['row'] = $this->Eco_model->get($id);
        $this->template->load('templates/template', 'eco/meeting_report', $data);
    }
    public function approval($id)
    {
        $data['row'] = $this->Eco_model->get($id);
        $data['row2'] = $this->db->get('komentar');
        $this->template->load('templates/template', 'eco/approval', $data);
    }
    public function inspection($id)
    {
        $data['row'] = $this->Eco_model->get($id);
        $data['row2'] = $this->Eco_model->get_id($id);
        $this->template->load('templates/template', 'eco/inspection', $data);
    }
    public function status_report()
    {
        $data['row'] = $this->Eco_model->get();
        $this->template->load('templates/template', 'eco/status_report', $data);
    }

    public function save()
    {
        // ================= UPLOAD CONFIG =================
        $config['upload_path']   = './uploads/eco_file/';
        $config['allowed_types'] = 'html|pptx|xlsx|pdf|jpeg|jpg|png';
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
        // Upload file 2 
        $this->upload->initialize($config);
        $file2 = "";
        if ($this->upload->do_upload('attachment2')) {
            $file2_data = $this->upload->data();
            $file2 = $file2_data['file_name'];
        }

        // ================= MAIN ECO TABLE =================
        $data = [
            'dept'            => $this->input->post('dept'),
            'register'        => $this->input->post('regis_id'),
            'pn_name'         => $this->input->post('pn_name'),
            'status1'         => 'On Schedule',
            'status2'         => 'On Progress',
            'in_eco_num'      => $this->input->post('in_eco_num'),
            'in_eco_path'     => $file1,
            'kr_eco_num'      => $this->input->post('kr_eco_num'),
            'kr_eco_path'     => $file2,
            'effec_date'      => $this->input->post('efect_date'),
            'expec_date'      => $this->input->post('expec_date'),
            'h_apply'         => $this->input->post('h-apply'),
            'dwg_pn'          => $this->input->post('dwg_pn'),
            'last_stock_date' => $this->input->post('regis_date'),
            'ket'             => $this->input->post('ket')
        ];

        $this->Eco_model->insert($data);

        // ================= DETAIL ECO (MULTI ROW) =================
        $post = $this->input->post();

        foreach ($post['model_pn'] as $i => $model) {

            // skip jika semua kosong
            if (
                empty($model) &&
                empty($post['pn_number'][$i]) &&
                empty($post['rm'][$i]) &&
                empty($post['cr_stock'][$i])
            ) {
                continue;
            }

            $data_detail = [
                'id_eco'        => $post['id_eco'],
                'model_pn'      => $model,
                'pn_number'     => $post['pn_number'][$i] ?? null,
                'rm'            => $post['rm'][$i] ?? null,
                'cr_stock'      => $post['cr_stock'][$i] ?? 0,
            ];

            $this->db->insert('detail_eco', $data_detail);
        }


        // ================= MATERIAL TABLE (MULTI ROW) =================
        foreach ($post['rm'] as $i => $rm) {
            $data_material = [
                'id_eco'             => $post['id_eco'],
                'material_no'        => $rm,
                'current_stock'      => $post['cr_stock'][$i] ?? 0,
                'effective_date'     => $post['efect_date'],
                'exhaust_date'       => $post['expec_date'],
                'shipping_available' => 'Possible'
            ];
            $this->db->insert('tabel_material', $data_material);
        }

        redirect('eco');
    }


    public function save_delivery()
    {
        // proses simpan ke database
        $id = $this->input->post('id_eco');
        $rm = $this->input->post('material_no');
        $qty_shipped = $this->input->post('quantity_shipped');
        $current_stock = $this->input->post('previous_inventory');
        $last_stock = $current_stock - $qty_shipped;

        // contoh insert
        $data = [
            'id_eco' => $this->input->post('id_eco'),
            'regis' => $this->input->post('regis_id'),
            'dept' => $this->input->post('dept'),
            'delivery_schedule' => $this->input->post('delivery_date'),
            'material_no' => $this->input->post('material_no'),
            'shipped_wio' => $this->input->post('shipped_wio'),
            'previous_inventory' => $current_stock,
            'quantity_shipped' => $qty_shipped,
            'current_stock' => $last_stock,
            'note' => $this->input->post('note')
        ];
        $this->Delivery_model->insert($data);
        $this->Eco_model->update_delivery();
        $this->Eco_model->update_stock();
        $this->Delivery_model->update_delivery();
        redirect('eco/v_list/' . $id . '/' . $rm);
    }

    public function upload_meeting()
    {
        $id = $this->input->post('id_eco');
        // Konfigurasi upload
        $config['upload_path']   = './uploads/eco_file/';
        $config['allowed_types'] = 'pdf|xlsx|xls|pptx|ppt|jpeg|jpg|png';
        $config['max_size']      = 51200; // 25MB

        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        }
        // Upload file 1
        $this->upload->initialize($config);
        $file1 = "";
        if ($this->upload->do_upload('attachment1')) {
            $file1_data = $this->upload->data();
            $file1 = $file1_data['file_name'];
        }
        // Ambil input dari form
        $data = [
            'img_meeting'   => $file1,
            'status1'       => 'COMPLETE'
        ];
        $this->Eco_model->update_meeting($data);
        redirect('eco/meeting/' . $id);
    }

    public function upload_inspection()
    {
        $id = $this->input->post('id_eco');
        // Konfigurasi upload
        $config['upload_path']   = './uploads/eco_file/';
        $config['allowed_types'] = 'pdf|xlsx|xls|pptx|ppt|jpeg|jpg|png';
        $config['max_size']      = 51200; // 25MB

        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        }
        // Upload file 1
        $this->upload->initialize($config);
        $file1 = "";
        if ($this->upload->do_upload('attachment1')) {
            $file1_data = $this->upload->data();
            $file1 = $file1_data['file_name'];
        }
        // Ambil input dari form
        $data = [
            'img_qc'             => $file1,
            'first_release_date' => $this->input->post('fr_date')
        ];

        // update table materials
        $data2 = [
            'id_eco'                => $this->input->post('id_eco'),
            'file1'                 => $file1,
            'depart'                => $this->input->post('dept'),
            'username'              => $this->input->post('regis_id'),
            'date_1'                => $this->input->post('fr_date')
        ];

        $this->Eco_model->update_inspection($data);
        $this->db->insert('f_date', $data2);
        redirect('eco/inspection/' . $id);
    }

    public function update_approval()
    {
        $id_eco   = $this->input->post('id_eco');
        $col_name = $this->input->post('approval_column');
        $value    = $this->input->post('approval_value');

        if (!empty($id_eco) && !empty($col_name)) {
            // 🔹 1. Update kolom approval yang sesuai
            $this->db->where('id_eco', $id_eco);
            $this->db->update('eco', [$col_name => $value]);

            // 🔹 2. Ambil ulang data ECO untuk pengecekan status
            $eco = $this->db->get_where('eco', ['id_eco' => $id_eco])->row();

            if ($eco) {
                // 🔹 3. Daftar semua kolom approval
                $approvals = [
                    $eco->aproval1,
                    $eco->aproval2,
                    $eco->aproval3,
                    $eco->aproval4,
                    $eco->aproval5,
                    $eco->aproval6,
                    $eco->aproval7
                ];

                // 🔹 4. Cek apakah semua sudah diisi
                $incomplete = in_array(null, $approvals, true) || in_array('', $approvals, true);

                // 🔹 5. Jika semua sudah terisi → update status jadi "Complete"
                if (!$incomplete) {
                    $this->db->where('id_eco', $id_eco);
                    $this->db->update('eco', ['status1' => 'Complete', 'status2' => 'Complete']);
                } else {
                    $this->db->where('id_eco', $id_eco);
                    $this->db->update('eco', ['status1' => 'On Progress', 'status2' => 'On Progress']);
                }
            }
        } else {
            $this->session->set_flashdata('error', 'Invalid data.');
        }

        // 🔹 6. Redirect kembali
        redirect('eco');
    }

    //save komentar
    public function komentar()
    {
        $id   = $this->input->post('id_eco');

        // insert
        $data = [
            'id_eco'        => $this->input->post('id_eco'),
            'nama_user'     => $this->input->post('nama_user'),
            'komen'         => $this->input->post('komentar')
        ];
        $this->Eco_model->insert_komen($data);
        redirect('eco/approval/' . $id);
    }

    // Ajax ambil data delivery schedule dari DB
    public function get_delivery($id = null, $material_no = null)
    {
        if (!$id || !$material_no) {
            echo json_encode(['error' => 'Parameter tidak lengkap']);
            return;
        }

        // Validasi material_id dan material_no cocok
        $material = $this->Delivery_model->get_rm($id, $material_no);
        if (!$material) {
            echo json_encode(['error' => 'Material tidak ditemukan']);
            return;
        }

        $data = $this->Delivery_model->get_by_material($material_no);
        echo json_encode($data);
    }

    public function edit($id)
    {
        // ambil data eco utama
        $eco = $this->Eco_model->get($id)->row();

        if (!$eco) {
            echo "<script>alert('Data tidak ditemukan');</script>";
            redirect('eco');
        }

        // ambil detail eco (multi row)
        $detail = $this->Eco_model->get_detail($id);

        $data = [
            'row'        => $eco,
            'detail_eco' => $detail
        ];

        $this->template->load('templates/template', 'eco/update', $data);
    }


    public function update()
    {
        $id = $this->input->post('id_eco');

        // ================= UPLOAD CONFIG =================
        $config['upload_path']   = './uploads/eco_file/';
        $config['allowed_types'] = 'html|pptx|xlsx|pdf|jpeg|jpg|png';
        $config['max_size']      = 51200;

        $this->load->library('upload', $config);

        // ================= GET OLD DATA =================
        $old = $this->Eco_model->get($id)->row();

        // ================= FILE 1 =================
        $file1 = $old->in_eco_path;
        if (!empty($_FILES['attachment1']['name'])) {
            if ($this->upload->do_upload('attachment1')) {
                $file1 = $this->upload->data('file_name');
            }
        }

        // ================= FILE 2 =================
        $file2 = $old->kr_eco_path;
        if (!empty($_FILES['attachment2']['name'])) {
            $this->upload->initialize($config);
            if ($this->upload->do_upload('attachment2')) {
                $file2 = $this->upload->data('file_name');
            }
        }

        // ================= UPDATE ECO =================
        $data = [
            'pn_name'     => $this->input->post('pn_name'),
            'in_eco_num'  => $this->input->post('in_eco_num'),
            'in_eco_path' => $file1,
            'kr_eco_num'  => $this->input->post('kr_eco_num'),
            'kr_eco_path' => $file2,
            'effec_date'  => $this->input->post('efect_date'),
            'expec_date'  => $this->input->post('expec_date'),
            'h_apply'     => $this->input->post('h-apply'),
            'dwg_pn'      => $this->input->post('dwg_pn'),
            'ket'         => $this->input->post('ket')
        ];

        $this->Eco_model->update($id, $data);

        // ================= UPDATE DETAIL ECO =================
        $post = $this->input->post();

        // hapus detail lama
        $this->db->where('id_eco', $id)->delete('detail_eco');

        // insert ulang
        foreach ($post['model_pn'] as $i => $model) {

            if (
                empty($model) &&
                empty($post['pn_number'][$i]) &&
                empty($post['rm'][$i]) &&
                empty($post['cr_stock'][$i])
            ) {
                continue;
            }

            $this->db->insert('detail_eco', [
                'id_eco'        => $id,
                'model_pn'      => $model,
                'pn_number'     => $post['pn_number'][$i] ?? null,
                'rm'            => $post['rm'][$i] ?? null,
                'cr_stock'      => $post['cr_stock'][$i] ?? 0,
                'date_update'   => date('Y-m-d H:i:s'),
            ]);
        }

        // ================= UPDATE MATERIAL TABLE =================
        $this->db->where('id_eco', $id)->delete('tabel_material');

        foreach ($post['rm'] as $i => $rm) {
            $this->db->insert('tabel_material', [
                'id_eco'             => $id,
                'material_no'        => $rm,
                'current_stock'      => $post['cr_stock'][$i] ?? 0,
                'effective_date'     => $post['efect_date'],
                'exhaust_date'       => $post['expec_date'],
                'date_update'        => date('Y-m-d H:i:s'),
                'u_update'           => $this->input->post('user_u'),
                'shipping_available' => 'Possible'
            ]);
        }

        redirect('eco');
    }
}
