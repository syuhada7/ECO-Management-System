<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('User_model');
    $this->load->library('form_validation');
  }

  public function index()
  {
    check_already_login();
    $this->load->view('templates/auth_header');
    $this->load->view('auth/login');
    $this->load->view('templates/auth_footer');
  }

  public function logout()
  {
    $params = array('id_user', 'level');
    $this->session->unset_userdata($params);
    redirect('Auth');
  }

  public function login()
  {
    $post = $this->input->post(null, TRUE);
    if (isset($post['btnlogin'])) {
      $query = $this->User_model->login($post);
      if ($query->num_rows() > 0) {
        $row = $query->row();
        $params = array(
          'id_user' => $row->id_user,
          'level' => $row->level
        );
        $this->session->set_userdata($params);
        echo "<script>
        alert('Hore, Login Success');
        window.location='" . site_url('Dashboard') . "';
        </script>";
      } else {
        echo "<script>
        alert('Sorry, Please check your username / password');
        window.location='" . site_url('Auth') . "';
        </script>";
      }
    }
  }
}
