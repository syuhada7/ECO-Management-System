<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bom_model extends CI_Model
{
    private $table = 'bom';

    public function get($id = null)
    {
        $this->db->from('bom');
        if ($id != null) {
            $this->db->where('id_bom', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_komen($id = null)
    {
        $tipe = "BOM";
        $this->db->from('komentar');
        if ($id != null || $tipe != null) {
            $this->db->where('id_bom', $id);
            $this->db->where('tipe', $tipe);
        }
        $query = $this->db->get();
        return $query;
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function insert_komen($data)
    {
        return $this->db->insert('komentar', $data);
    }
}
