<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Purchase_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table = 'tb_purchase';
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

    public function getAllPaymentById($id)
    {
        $this->db->select('a.id_purchase, a.id_supplier, SUM(b.harga_total) as harga');
        $this->db->from($this->table . ' a');
        $this->db->join('tb_purchase_detail b', 'b.id_purchase = a.id_purchase');
        $this->db->where('id_user', $id);
        $this->db->where('status', '2');
        $this->db->group_by(array("a.id_purchase", "a.id_supplier"));  // Produces: GROUP BY title, date
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPaymentById($id, $idx)
    {
        $this->db->select('a.id_purchase, a.id_supplier, SUM(b.harga_total) as harga');
        $this->db->from($this->table . ' a');
        $this->db->join('tb_purchase_detail b', 'b.id_purchase = a.id_purchase');
        $this->db->where('id_user', $id);
        $this->db->where('status', '2');
        $this->db->where('a.id_purchase', $idx);
        $this->db->group_by(array("a.id_purchase", "a.id_supplier"));  // Produces: GROUP BY title, date
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

    public function getAllJoin()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('tb_user', 'tb_user.id_user = tb_purchase.id_user');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAllById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_user', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_purchase', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function deleteById($id)
    {
        $this->db->where('id_purchase', $id);
        $this->db->delete($this->table);
        return true;
    }

    public function reject($id)
    {
        $data = array(
            'status' => 0,
        );
        $this->db->where('id_purchase', $id);
        $this->db->update($this->table, $data);
        return true;
    }

    public function approve($id)
    {
        $data = array(
            'status' => 2,
        );
        $this->db->where('id_purchase', $id);
        $this->db->update($this->table, $data);
        return true;
    }

    public function payment($id)
    {
        $data = array(
            'status' => 3,
        );
        $this->db->where('id_purchase', $id);
        $this->db->update($this->table, $data);
        return true;
    }
}
