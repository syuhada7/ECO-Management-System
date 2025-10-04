<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['row'] = $this->User_model->get();
        $this->template->load('templates/template', 'User/data_user', $data);
    }

    public function add()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('nik', 'NIK', 'required|trim');
        $this->form_validation->set_rules('dept', 'Dept', 'required|trim');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', ['matches' => 'password dont match!!', 'min_length' => 'Password too short!']);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        $this->form_validation->set_rules('level', 'Level', 'trim|required');

        if ($this->form_validation->run() == false) {
            redirect('User');
        } else {
            $post = $this->input->post(null, TRUE);
            $this->User_model->add($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data Success Save');
            }
            redirect('User');
        }
    }

    // public function edit($id)
    // {
    //     $this->form_validation->set_rules('nama_pic', 'Nama PIC', 'trim|callback_username_check');
    //     $this->form_validation->set_rules('nik', 'NIK', 'trim');
    //     // Password validation only if password1 is provided
    //     if ($this->input->post('password1')) {
    //         $this->form_validation->set_rules('password1', 'Password', 'trim|min_length[6]|matches[password2]', [
    //             'matches' => 'Passwords do not match!',
    //             'min_length' => 'Password too short!'
    //         ]);
    //         $this->form_validation->set_rules('password2', 'Password', 'trim|matches[password1]');
    //     }
    //     $this->form_validation->set_rules('area', 'Area', 'trim|required');
    //     $this->form_validation->set_rules('level', 'Level', 'trim|required');
    //     if ($this->form_validation->run() == false) {
    //         $query = $this->User_model->get($id);
    //         if ($query->num_rows() > 0) {
    //             $data['row'] = $query->row();
    //             $this->template->load('templates/template', 'User /edit_user', $data);
    //         } else {
    //             $this->session->set_flashdata('error', 'Data not found!');
    //             redirect('User ');
    //         }
    //     } else {
    //         $post = $this->input->post(null, TRUE);
    //         // Hash the password if it's being changed
    //         if (!empty($post['password1'])) {
    //             $post['password'] = password_hash($post['password1'], PASSWORD_DEFAULT);
    //         } else {
    //             unset($post['password1']); // Remove password1 from the data to be updated
    //             unset($post['password2']); // Remove password2 from the data to be updated
    //         }
    //         $this->User_model->edit($post, $id); // Pass the ID to the model for updating
    //         if ($this->db->affected_rows() > 0) {
    //             $this->session->set_flashdata('success', 'Data successfully updated!');
    //         }
    //         redirect('User ');
    //     }
    // }

    function username_check()
    {
        $post = $this->input->post(null, TRUE);
        $query = $this->db->query("SELECT * FROM user WHERE nama = '$post[nama]' AND id_user != '$post[id_user]'");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('username_check', '{field} this username has been avail');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function delete($id)
    {
        $where = array('id_user' => $id);
        $this->User_model->delete($where, 'nama');
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Success Delete');
        }
        redirect('User');
    }
}
