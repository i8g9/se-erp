<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
        $this->load->model('Purchase_model', 'purchase');
        $this->load->model('Supplier_model', 'supplier');
        $this->load->model('Product_model', 'product');
        $this->load->model('Payment_model', 'payment');
        if (!$this->session->userdata('username')) {
            redirect('Auth');
        } else {
            if ($this->session->userdata('role') != 1) {
                redirect('user/blocked');
            }
        };
    }

    //User List

    public function index()
    {
        $data['user'] = $this->user->getUser($this->session->userdata('username'));
        $data['userAll'] = $this->user->getAllUser();
        $this->load->view('template/header');
        $this->load->view('admin/list', $data);
        $this->load->view('template/footer');
    }

    public function getUser()
    {
        $id = $this->input->post('id');
        $query = $this->user->getUserbyId($id);

        echo json_encode($query);
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $query = $this->user->deleteById($id);

        echo json_encode($query);
    }

    public function edit()
    {
        $id = $this->input->post('id');
        $username = $this->input->post('username');
        $query = $this->user->editById($id, $username);

        echo json_encode($query);
    }

    //User Request

    public function request()
    {
        $data['user'] = $this->user->getUser($this->session->userdata('username'));
        $data['request'] = $this->purchase->getAllJoin();
        $data['supplier'] = $this->supplier->getAll();

        $this->load->view('template/header');
        $this->load->view('admin/request', $data);
        $this->load->view('template/footer');
    }

    public function reject()
    {
        $id = $this->input->post('id');
        $query = $this->purchase->reject($id);

        echo json_encode($query);
    }

    public function approve()
    {
        $id = $this->input->post('id');
        $query = $this->purchase->approve($id);

        echo json_encode($query);
    }

    //User Payment

    public function payment()
    {
        $data['user'] = $this->user->getUser($this->session->userdata('username'));
        $data['allUser'] = $this->user->getAllUser();
        $data['payment'] = $this->payment->getAll();
        $this->load->view('template/header');
        $this->load->view('admin/payment', $data);
        $this->load->view('template/footer');
    }

    public function rejectPay()
    {
        $id = $this->input->post('id');
        $query = $this->payment->reject($id);

        echo json_encode($query);
    }

    public function approvePay()
    {
        $id = $this->input->post('id');
        $query = $this->payment->approve($id);

        echo json_encode($query);
    }

    public function getPayment()
    {
        $id = $this->input->post('id');
        $query = $this->payment->getById($id);

        echo json_encode($query);
    }

    //Supplier

    public function supplier()
    {
        $data['user'] = $this->user->getUser($this->session->userdata('username'));
        $data['supplier'] = $this->supplier->getAll();
        // $data['province'] = $this->dashboard->province();
        $this->load->view('template/header');
        $this->load->view('admin/supplier', $data);
        $this->load->view('template/footer');
    }

    public function saveSupplier()
    {
        $id = $this->input->post('id_supplier');
        $data = array(
            'name' => $this->input->post('supplier'),
        );

        if ($id != null) {
            $this->supplier->update($data, $id);
        } else {
            $this->supplier->insert($data);
        }

        redirect('admin/supplier');
    }

    public function getSupplierById()
    {
        $id = $this->input->post('id');
        $query = $this->supplier->getById($id);

        echo json_encode($query);
    }

    public function deleteSupplier()
    {
        $id = $this->input->post('id');
        $query = $this->supplier->deleteById($id);

        echo json_encode($query);
    }

    //Product

    public function product()
    {
        $data['user'] = $this->user->getUser($this->session->userdata('username'));
        $data['product'] = $this->product->getAll();
        $data['supplier'] = $this->supplier->getAll();
        $this->load->view('template/header');
        $this->load->view('admin/product', $data);
        $this->load->view('template/footer');
    }

    public function saveProduct()
    {
        $id = $this->input->post('id_product');
        $data = array(
            'name' => $this->input->post('product'),
            'id_supplier' => $this->input->post('supplier'),
        );

        if ($id != null) {
            $this->product->update($data, $id);
        } else {
            $this->product->insert($data);
        }

        redirect('admin/Product');
    }

    public function getProductById()
    {
        $id = $this->input->post('id');
        $query = $this->product->getById($id);

        echo json_encode($query);
    }

    public function getAllProductById()
    {
        $id = $this->input->post('id');
        $query = $this->product->getAllById($id);

        echo json_encode($query);
    }

    public function deleteProduct()
    {
        $id = $this->input->post('id');
        $query = $this->product->deleteById($id);

        echo json_encode($query);
    }
}
