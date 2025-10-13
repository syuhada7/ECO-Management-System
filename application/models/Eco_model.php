<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Eco_model extends CI_Model
{
    private $table = 'eco';

    public function get($id = null)
    {
        $this->db->from('eco');
        if ($id != null) {
            $this->db->where('id_eco', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_next_id()
    {
        $this->db->select_max('id_eco');
        $query = $this->db->get('eco');
        $result = $query->row();
        return $result ? $result->id_eco + 1 : 1;
    }
    public function get_rm($id, $rm)
    {
        $this->db->from('eco');
        $this->db->where('id_eco', $id);
        $this->db->where('rm', $rm);
        $query = $this->db->get();
        return $query;
    }
    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update_meeting($data)
    {
        $id = $this->input->post('id_eco');
        // Query update
        $this->db->where('id_eco', $id);
        $this->db->update('eco', $data);
    }

    public function update_inspection($data)
    {
        $id = $this->input->post('id_eco');
        // Query update
        $this->db->where('id_eco', $id);
        $this->db->update('eco', $data);
    }

    public function update_delivery()
    {
        $id = $this->input->post('id_eco');
        $rm = $this->input->post('material_no');
        $data = [
            'last_stock'        =>  $this->input->post('current_stock'),
            'last_stock_date'   => date('Y-m-d H:i:s')
        ];

        // Query update
        $this->db->where('id_eco', $id);
        $this->db->where('rm', $rm);
        $this->db->update('eco', $data);
    }
}
