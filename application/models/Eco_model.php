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

    public function get_id($id = null)
    {
        $this->db->from('f_date');
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
        $this->db->from('tabel_material');
        $this->db->where('id_eco', $id);
        $this->db->where('material_no', $rm);
        $query = $this->db->get();
        return $query;
    }

    public function get_drm($id)
    {
        return $this->db
            ->where('id_eco', $id)
            ->get('tabel_material')
            ->result();
    }

    public function get_detail($id)
    {
        return $this->db
            ->where('id_eco', $id)
            ->get('e_model')
            ->result();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function insert_komen($data)
    {
        return $this->db->insert('komentar', $data);
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

    public function update($id, $data)
    {
        $this->db->where('id_eco', $id);
        $this->db->update('eco', $data);
        // $this->db->update('delivery_schedule', $data2);
    }

    public function get_first_date($id)
    {
        return $this->db->get_where('f_date', [
            'id_fdate' => $id
        ]);
    }

    public function delete_first_date($id, $id_eco)
    {
        $data = [
            'file1'      =>  ""
        ];
        $this->db->where('id_fdate', $id);
        $this->db->where('id_eco', $id_eco);
        $this->db->update('f_date', $data);
    }
    public function delete_f_date($f_path)
    {
        $data = [
            'img_qc'      =>  ""
        ];
        $this->db->where('img_qc', $f_path);
        $this->db->update('eco', $data);
    }

    public function delete($where)
    {
        $this->db->where($where);
        $this->db->delete('eco');
    }
}
