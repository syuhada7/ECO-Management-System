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
        $this->load->library('form_validation');
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
}
