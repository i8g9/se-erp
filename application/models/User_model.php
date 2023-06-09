<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table = 'tb_user';
    }

    public function getAllUser()
    {
        $this->db->select('*');
        $this->db->from($this->table);
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

    public function deleteById($id)
    {
        $this->db->where('id_user', $id);
        $this->db->delete($this->table);
        return true;
    }

    public function editById($id, $username)
    {
        $data = array(
            'username' => $username,
        );

        $this->db->where('id_user', $id);
        $this->db->update($this->table, $data);

        return true;
    }
}
