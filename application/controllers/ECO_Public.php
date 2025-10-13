<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ECO_Public extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(['Eco_model', 'User_model', 'Delivery_model']);
    }

    public function index()
    {
        $data['row'] = $this->Eco_model->get();
        $this->template->load('templates/template_public', 'public_eco/index', $data);
    }

    public function delivery($id)
    {
        $data['row'] = $this->Delivery_model->get_rm($id);
        $this->template->load('templates/template_public', 'public_eco/delivery', $data);
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
        $this->template->load('templates/template_public', 'public_eco/v_list', $data);
    }

    public function meeting($id)
    {
        $data['row'] = $this->Eco_model->get($id);
        $this->template->load('templates/template_public', 'public_eco/meeting_report', $data);
    }
    public function inspection($id)
    {
        $data['row'] = $this->Eco_model->get($id);
        $this->template->load('templates/template_public', 'public_eco/inspection', $data);
    }
    public function approval($id)
    {
        $data['row'] = $this->Eco_model->get($id);
        $this->template->load('templates/template_public', 'public_eco/approval', $data);
    }
    public function status_report()
    {
        $data['row'] = $this->Eco_model->get();
        $this->template->load('templates/template_public', 'public_eco/status_report', $data);
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
