<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
        $this->load->model('Purchase_model', 'purchase');
        $this->load->model('PurchaseDtl_model', 'purchaseDtl');
        $this->load->model('Payment_model', 'payment');
        $this->load->model('Supplier_model', 'supplier');
        if (!$this->session->userdata('username')) {
            redirect('Auth');
        };
    }

    public function index()
    {
        $data['user'] = $this->user->getUser($this->session->userdata('username'));
        $data['purchase'] = $this->purchase->getAllById($this->session->userdata('id_user'));
        $data['supplier'] = $this->supplier->getAll();
        $this->load->view('template/header');
        $this->load->view('user/purchase', $data);
        $this->load->view('template/footer');
    }

    public function getById()
    {
        $id = $this->input->post('id');
        $result = $this->purchase->getById($id);

        echo json_encode($result);
    }

    public function getDtlById()
    {
        $id = $this->input->post('id');
        $result = $this->purchaseDtl->getByPurchaseId($id);

        echo json_encode($result);
    }

    public function payment()
    {
        $data['user'] = $this->user->getUser($this->session->userdata('username'));
        $data['purchase'] = $this->purchase->getAllPaymentById($this->session->userdata('id_user'));
        $data['payment'] = $this->payment->getAll();
        $data['supplier'] = $this->supplier->getAll();
        // echo json_encode($data['purchase']);
        // die;
        $this->load->view('template/header');
        $this->load->view('user/payment', $data);
        $this->load->view('template/footer');
    }

    public function getPayment()
    {
        $id = $this->session->userdata('id_user');
        $idx = $this->input->post('id');

        $result = $this->purchase->getPaymentById($id, $idx);

        echo json_encode($result);
    }

    public function savePayment()
    {
        $image = $_FILES['payment'];
        $config['upload_path'] = './assets/paymentImage';
        $config['allowed_types'] = 'jpg|png|jpeg';

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('payment')) {
            echo "Upload Failed";
            die();
        } else {
            $image = $this->upload->data('file_name');
        }

        $data = array(
            'id_purchase' => $this->input->post('id_purchase'),
            'id_user' => $this->session->userdata('id_user'),
            'photo' => $image,
            'status' => 0,
            'payment' => $this->input->post('price'),
        );

        $this->payment->insert($data);
        redirect('user/payment');
    }

    public function savePurchase()
    {
        try {
            $data = array(
                "id_purchase" => $this->input->post('id_purchase'),
                "id_supplier" => $this->input->post('supplier'),
                "id_user" => $this->session->userdata('id_user'),
                "status" => 1
            );


            $id = $data["id_purchase"];

            if ($id != null) {
                $this->purchase->update($data, $id);
            } else {
                $resp = $this->purchase->insert($data);
                $id = $resp;
            }

            for ($idx = 0; $idx < count($this->input->post('produk')); $idx++) {
                $harga_satuan = $this->input->post('subtotal')[$idx];
                $kuantitas = $this->input->post('qty')[$idx];
                $dataMaterial = array(
                    'id_detail' => $this->input->post('id')[$idx],
                    'id_purchase' => $id,
                    'id_product' => $this->input->post('produk')[$idx],
                    'qty' => $kuantitas,
                    'harga_satuan' => $harga_satuan,
                    'harga_total' => $kuantitas * $harga_satuan,
                );

                $this->purchaseDtl->save($dataMaterial);
            }

            $output['data'] = '';
        } catch (Exception $e) {
            $output['code'] = "0";
            $output['message'] = $e->getMessage();
        }
        redirect('user');
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $query = $this->purchase->deleteById($id);
        $this->purchaseDtl->deleteByPurchaseId($id);

        echo json_encode($query);
    }

    public function blocked()
    {
        $this->load->view('template/header');
        $this->load->view('blocked');
        $this->load->view('template/footer');
    }
}
