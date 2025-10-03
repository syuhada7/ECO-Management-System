<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Delivery_model extends CI_Model
{

    public function get_by_material($material_no)
    {
        return $this->db->get_where('delivery_schedule', ['material_no' => $material_no])->result();
    }
}
