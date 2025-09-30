<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bom_model extends CI_Model
{
    public function get($id = null)
    {
        $this->db->from('bom');
        if ($id != null) {
            $this->db->where('id_bom', $id);
        }
        $query = $this->db->get();
        return $query;
    }
}
