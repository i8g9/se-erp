<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
        // $this->load->model('Dashboard_model', 'dashboard');
        // $this->load->model('Admin_model', 'admin');
        // $this->load->model('Disaster_model', 'disaster');
        if (!$this->session->userdata('username')) {
            redirect('Auth');
        } else {
            if ($this->session->userdata('role') != 1) {
                redirect('user/blocked');
            }
        };
    }

    public function index()
    {
        $data['user'] = $this->user->getUser($this->session->userdata('username'));
        $data['userAll'] = $this->user->getAllUser();
        $this->load->view('template/header');
        $this->load->view('admin/list', $data);
        $this->load->view('template/footer');
    }

    public function request()
    {
        $data['user'] = $this->user->getUser($this->session->userdata('username'));
        // $data['request'] = $this->admin->request();
        $this->load->view('template/header');
        $this->load->view('admin/request', $data);
        $this->load->view('template/footer');
    }

    public function payment()
    {
        $data['user'] = $this->user->getUser($this->session->userdata('username'));
        // $data['disaster'] = $this->disaster->getDisaster();
        // $data['province'] = $this->dashboard->province();
        $this->load->view('template/header');
        $this->load->view('admin/payment', $data);
        $this->load->view('template/footer');
    }

    public function getPhoto()
    {
        $id = $this->input->post('id');
        $data['request'] = $this->admin->requestbyId($id);

        echo json_encode($data);
    }

    public function reject()
    {
        $id = $this->input->post('id');
        $this->db->set('is_active', 2);
        $this->db->where('id_family', $id);
        $query = $this->db->update('family');

        echo json_encode($query);
    }

    public function approve()
    {
        $id = $this->input->post('id');
        $this->db->set('is_active', 1);
        $this->db->where('id_family', $id);
        $query = $this->db->update('family');

        echo json_encode($query);
    }

    public function addDisaster()
    {
        $data = [
            'name' => $this->input->post('selectDisaster'),
            'id_region' => $this->input->post('selectProvince'),
            'date' => $this->input->post('date'),
            'casualty' => $this->input->post('casualty'),
        ];
        $this->db->insert('disaster', $data);
        redirect('admin/disaster');
    }

    public function changeStatus()
    {
        $nik = $this->input->post('id');
        $status = $this->input->post('value');
        $data = array(
            'status' => $status,
        );

        $this->db->where('nik', $nik);
        $query = $this->db->update('user', $data);
        echo json_encode($query);
    }

    public function report()
    {
        $data['user'] = $this->user->getUser($this->session->userdata('username'));
        $data['report'] = $this->admin->report();
        $this->load->view('template/header');
        $this->load->view('admin/report', $data);
        $this->load->view('template/footer');
    }

    public function getPhotoReport()
    {
        $id = $this->input->post('id');
        $data['report'] = $this->admin->reportbyId($id);

        echo json_encode($data);
    }

    public function deleteReport()
    {
        $id = $this->input->post('id');
        $this->db->set('is_active', 0);
        $this->db->where('id_report', $id);
        $query = $this->db->update('report');

        echo json_encode($query);
    }
}
