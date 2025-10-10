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
    public function regis()
    {
        $this->template->load('templates/template', 'eco/regis');
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

        $data['row'] = $this->Eco_model->get_rm($id, $rm);
        $data['row2'] = $this->Delivery_model->get_rm($id, $rm);
        $data['materials'] = $this->Delivery_model->get_all_materials();
        $this->template->load('templates/template', 'eco/v_list', $data);
    }
    public function meeting($id)
    {
        $data['row'] = $this->Eco_model->get($id);
        $this->template->load('templates/template', 'eco/meeting_report', $data);
    }
    public function status_report()
    {
        $data['row'] = $this->Eco_model->get();
        $this->template->load('templates/template', 'eco/status_report', $data);
    }

    public function save()
    {
        // Konfigurasi upload
        $config['upload_path']   = './uploads/eco_file/';
        $config['allowed_types'] = 'html|pptx|xlsx|pdf';
        $config['max_size']      = 4096; // 2MB

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

        // Upload file 2
        $this->upload->initialize($config);
        $file2 = "";
        if ($this->upload->do_upload('attachment2')) {
            $file2_data = $this->upload->data();
            $file2 = $file2_data['file_name'];
        }

        // Upload file 3
        $this->upload->initialize($config);
        $file2 = "";
        if ($this->upload->do_upload('attachment3')) {
            $file2_data = $this->upload->data();
            $file2 = $file2_data['file_name'];
        }

        // Ambil input dari form
        $data = [
            'dept'            => $this->input->post('dept'),
            'register'        => $this->input->post('regis_id'),
            'model_pn'        => $this->input->post('model_pn'),
            'pn_name'         => $this->input->post('pn_name'),
            'status1'         => "In Progress",
            'in_eco_num'      => $this->input->post('in_eco_num'),
            'in_eco_path'     => $file1,
            'kr_eco_num'      => $this->input->post('kr_eco_num'),
            'kr_eco_path'     => $file2,
            'last_stock'      => $this->input->post('cr_stock'),
            'effec_date'      => $this->input->post('efect_date'),
            'expec_date'      => $this->input->post('expec_date'),
            'h_apply'         => $this->input->post('h-apply'),
            'dwg_pn'          => $this->input->post('dwg_pn'),
            'rm'              => $this->input->post('rm'),
            'ket'             => $this->input->post('ket')
        ];

        $this->Eco_model->insert($data);
        redirect('ECO');
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
        $this->Delivery_model->update_delivery();
        redirect('eco/v_list/' . $id . '/' . $rm);
    }

    public function upload_meeting()
    {
        $id = $this->input->post('id_eco');
        // Konfigurasi upload
        $config['upload_path']   = './uploads/eco_file/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']      = 4096; // 2MB

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
            'img_meeting'   => $file1
        ];
        $this->Eco_model->update_meeting($data);
        redirect('eco/meeting/' . $id);
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
}
