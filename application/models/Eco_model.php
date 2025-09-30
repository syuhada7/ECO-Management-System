<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Eco_model extends CI_Model
{
    public function get($id = null)
    {
        $this->db->from('eco');
        if ($id != null) {
            $this->db->where('id_eco', $id);
        }
        $query = $this->db->get();
        return $query;
    }
}
