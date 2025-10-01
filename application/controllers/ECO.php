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
        $this->load->model(['User_model']);
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
    public function v_list()
    {
        $this->template->load('templates/template', 'eco/v_list');
    }

    public function save()
    {
        // Konfigurasi upload
        $config['upload_path']   = './uploads/eco_file/';
        $config['allowed_types'] = 'pdf|docx|jpg|png|xlsx';
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

        // Ambil input dari form
        $data = [
            'dept'             => $this->input->post('dept'),
            'register'     => $this->input->post('regis_id'),
            'model_pn' => $this->input->post('model_pn'),
            'pn_name'          => $this->input->post('pn_name'),
            'in_eco_num'          => $this->input->post('in_eco_num'),
            'in_eco_path'     => $file1,
            'kr_eco_num'          => $this->input->post('kr_eco_num'),
            'kr_eco_path'     => $file2,
            'last_stock'          => $this->input->post('cr_stock'),
            'effec_date'          => $this->input->post('efect_date'),
            'expec-date'          => $this->input->post('expec-date'),
            'h_apply'          => $this->input->post('h-apply'),
            'dwg_pn'          => $this->input->post('dwg_pn'),
            'rm'          => $this->input->post('rm'),
            'ket'          => $this->input->post('ket')
        ];

        $this->Eco_model->insert($data);
        redirect('ECO');
    }
    public function status_report()
    {
        $data['row'] = $this->Eco_model->get();
        $this->template->load('templates/template', 'eco/status_report', $data);
    }
}
