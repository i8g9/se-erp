<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PurchaseDtl_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table = 'tb_purchase_detail';
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($data, $id)
    {
        $this->db->where('id_purchase', $id);
        $this->db->update($this->table, $data);
        return true;
    }

    public function save($data)
    {
        $this->db->replace($this->table, $data);
    }

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getByPurchaseId($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_purchase', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getUser($username)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('username', $username);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getUserbyId($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_user', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function deleteByPurchaseId($id)
    {
        $this->db->where('id_purchase', $id);
        $this->db->delete($this->table);
        return true;
    }
}
