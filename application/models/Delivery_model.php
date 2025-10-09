<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Delivery_model extends CI_Model
{
    private $table = 'delivery_schedule';

    public function get($id = null)
    {
        $this->db->from('delivery_schedule');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_rm($id, $rm)
    {
        $this->db->from('tabel_material');
        $this->db->where('id_eco', $id);
        $this->db->where('material_no', $rm);
        $query = $this->db->get();
        return $query;
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    // Ambil 1 material berdasarkan id dan material_no (validasi klik)
    public function get_material_by_id_pn($id, $material_no)
    {
        return $this->db
            ->where('id_eco', $id)
            ->where('material_no', $material_no)
            ->get('tabel_material')
            ->row();
    }

    public function update_delivery()
    {
        $id = $this->input->post('id_eco');
        $rm = $this->input->post('material_no');
        $cr_stock = (int) $this->input->post('current_stock'); // pastikan integer

        // Siapkan data dasar untuk update
        $data = [
            'current_stock' => $cr_stock
        ];

        // Logika otomatis status shipping
        if ($cr_stock === 0) {
            $data['shipping_available'] = 'Material Empty';
        } else {
            $data['shipping_available'] = 'possible';
        }

        // Lakukan update ke database
        $this->db->where('id_eco', $id);
        $this->db->where('material_no', $rm);
        $this->db->update('tabel_material', $data);

        // Kembalikan hasil
        return $this->db->affected_rows() > 0;
    }


    // Ambil semua material
    public function get_all_materials()
    {
        return $this->db->get('tabel_material')->result();
    }

    public function get_by_material($material_no)
    {
        return $this->db->get_where('delivery_schedule', ['material_no' => $material_no])->result();
    }
}
