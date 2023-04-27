<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table = 'tb_product';
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($data, $id)
    {
        $this->db->where('id_product', $id);
        $this->db->update($this->table, $data);
        return true;
    }

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_product', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getAllById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_supplier', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function deleteById($id)
    {
        $this->db->where('id_product', $id);
        $this->db->delete($this->table);
        return true;
    }
}
