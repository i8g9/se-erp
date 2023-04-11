<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('Dashboard_model', 'dashboard');
        $this->load->model('User_model', 'user');
    }

    public function index()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('template/header');
            $this->load->view('auth/login');
            $this->load->view('template/footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->user->getUser($username);
        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'username' => $user['username'],
                        'role' => $user['role'],
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissable fade show" role="alert">Wrong Password</div>');
                    redirect('Auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissable fade show" role="alert">Username is not validated, please wait for validation or contact the admin</div>');
                redirect('Auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissable fade show" role="alert">Username is not registered</div>');
            redirect('Auth');
        }
    }

    public function register()
    {
        $this->form_validation->set_rules('username', 'Username', 'is_unique[tb_user.username]');
        if ($this->form_validation->run() == false) {
            $this->load->view('template/header');
            $this->load->view('auth/register');
            $this->load->view('template/footer');
        } else {
            $data = [
                'username' => htmlspecialchars($this->input->post('username', true)),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role' => 2,
                'is_active' => 1,
            ];
            $this->db->insert('tb_user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-primary alert-dismissable fade show" role="alert">Your Account has been created</div>');
            redirect('Auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('id_role');
        $this->session->set_flashdata('message', '<div class="alert alert-primary alert-dismissable fade show" role="alert">Logout Succesful</div>');
        redirect('auth');
    }
    public function usernavbar()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('id_role');
        $this->session->set_flashdata('message', '<div class="alert alert-primary alert-dismissable fade show" role="alert">Logout Succesful</div>');
        redirect('dashboard');
    }
}
