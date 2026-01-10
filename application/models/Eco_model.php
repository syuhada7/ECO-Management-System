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

    public function update()
    {
        $id = $this->input->post('id_eco');
        $params = [
            'model_pn'        =>  $this->input->post('model_pn'),
            'model_pn2'       =>  $this->input->post('model_pn2'),
            'model_pn3'       =>  $this->input->post('model_pn3'),
            'model_pn4'       =>  $this->input->post('model_pn4'),
            'pn_name'         =>  $this->input->post('pn_name'),
            'in_eco_num'      =>  $this->input->post('in_eco_num'),
            'kr_eco_num'      =>  $this->input->post('kr_eco_num'),
            'last_stock'      =>  $this->input->post('cr_stock'),
            'effec_date'      =>  $this->input->post('efect_date'),
            'expec_date'      =>  $this->input->post('expec_date'),
            'h_apply'         =>  $this->input->post('h-apply'),
            'dwg_pn'          =>  $this->input->post('dwg_pn'),
            'rm'              =>  $this->input->post('rm'),
            'last_stock_date' =>  $this->input->post('regis_date'),
            'ket'             =>  $this->input->post('ket'),
            'u_update'        =>  $this->input->post('user_u'),
            'date_update'     =>  date('Y-m-d H:i:s')
        ];

        if (!empty($this->input->post['attachment1'])) {
            $params['in_eco_path'] =  $this->input->post['attachment1'];
        }
        if (!empty($this->input->post['attachment2'])) {
            $params['kr_eco_path'] =  $this->input->post['attachment2'];
        }
        if (!empty($this->input->post['attachment3'])) {
            $params['dwg_path'] =  $this->input->post['attachment3'];
        }

        $data2 = [
            'id_eco'          =>  $id,
            'current_stock'   =>  $this->input->post('cr_stock'),
            'effective_date'  =>  $this->input->post('efect_date'),
            'exhaust_date'    =>  $this->input->post('expec_date'),
            'material_no'     =>  $this->input->post('rm'),
            'u_update'        =>  $this->input->post('user_u'),
            'date_update'     =>  date('Y-m-d H:i:s')
        ];

        $data3 = [
            'current_stock'        =>  $this->input->post('cr_stock')
        ];

        $this->db->where('id_eco', $id);
        $this->db->update('eco', $params);
        $this->db->update('tabel_material', $data2);
        $this->db->update('delivery_schedule', $data3);
    }
}
