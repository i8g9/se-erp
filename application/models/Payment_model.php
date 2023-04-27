<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table = 'tb_payment';
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($data, $id)
    {
        $this->db->where('id_payment', $id);
        $this->db->update($this->table, $data);
        return true;
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_payment', $id);
        $query = $this->db->get();

        return $query->row_array();
    }

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function reject($id)
    {
        $data = array(
            'status' => 2,
        );
        $this->db->where('id_payment', $id);
        $this->db->update($this->table, $data);
        return true;
    }

    public function approve($id)
    {
        $data = array(
            'status' => 1,
        );
        $this->db->where('id_payment', $id);
        $this->db->update($this->table, $data);
        return true;
    }
}
