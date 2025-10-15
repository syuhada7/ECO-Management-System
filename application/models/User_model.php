<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function login($post)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('nama', $post['nama']);
        $this->db->where('password', md5($post['password']));
        $query = $this->db->get();
        return $query;
    }

    public function get($id = null)
    {
        $this->db->from('user');
        if ($id != null) {
            $this->db->where('id_user', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params['nama'] = $post['nama'];
        $params['password'] = md5($post['password1']);
        $params['nik'] = $post['nik'];
        $params['level'] = $post['level'];
        $params['dept'] = $post['dept'];
        $params['image'] = 'default.png';
        $params['is_active'] = 1;
        $this->db->insert('user', $params);
    }

    public function edit($post)
    {
        $params['nama'] = $post['nama'];
        if (!empty($post['password1'])) {
            $params['password'] = md5($post['password1']);
        }
        $params['nik'] = $post['nik'];
        $params['level'] = $post['level'];
        $params['dept'] = $post['dept'];
        $this->db->where('id_user', $post['id_user']);
        $this->db->update('user', $params);
    }

    public function delete($where)
    {
        $this->db->where($where);
        $this->db->delete('user');
    }
}
