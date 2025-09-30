<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bom extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model('Bom_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['row'] = $this->Bom_model->get();
        $this->template->load('templates/template', 'bom/index', $data);
    }
    public function v_list()
    {
        $data['row'] = $this->Bom_model->get();
        $this->template->load('templates/template', 'bom/v_list', $data);
    }
}
