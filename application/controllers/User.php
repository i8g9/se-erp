<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
        // $this->load->model('Dashboard_model', 'dashboard');
        if (!$this->session->userdata('username')) {
            redirect('Auth');
        };
    }

    public function index()
    {
        $data['user'] = $this->user->getUser($this->session->userdata('username'));
        // $data['member'] = $this->user->getFamily($data['user']['id_family']);
        // $data['province'] = $this->dashboard->province();
        $this->load->view('template/header');
        $this->load->view('user/purchase', $data);
        $this->load->view('template/footer');
    }

    public function getUser()
    {
        $id = $this->input->post('id');
        $result = $this->user->getUserbyId($id);

        echo json_encode($result);
    }

    public function payment()
    {
        $data['user'] = $this->user->getUser($this->session->userdata('username'));
        // $data['province'] = $this->dashboard->province();
        $this->load->view('template/header');
        $this->load->view('user/payment', $data);
        $this->load->view('template/footer');
    }

    public function edit()
    {
        $data['user'] = $this->user->getUser($this->session->userdata('username'));
        if ($this->input->post('username') != $data['user']['head_family']) {
            $us = '|is_unique[family.head_family]';
        } else {
            $us = '';
        }
        $this->form_validation->set_rules('username', 'Username', 'required' . $us);
        if ($this->form_validation->run() == false) {
            $data['province'] = $this->dashboard->province();
            $data['edit'] = "active";
            $this->load->view('template/header');
            $this->load->view('user/profile', $data);
            $this->load->view('template/footer');
        } else {
            $image = $_FILES['picture'];
            if ($image['name'] != '') {
                $config['upload_path'] = './assets/profileImage';
                $config['allowed_types'] = 'jpg|png|jpeg';

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('picture')) {
                    echo "Upload Failed";
                    die();
                } else {
                    $old_image = $data['user']['profile'];
                    if ($old_image != 'profile-img.jpg') {
                        unlink(FCPATH . 'assets/profileImage/' . $old_image);
                    }
                    $image = $this->upload->data('file_name');
                }
            } else {
                $image = $data['user']['profile'];
            }

            $user = [
                'id_region' => htmlspecialchars($this->input->post('selectProvince', true)),
                'head_family' => $this->input->post('username'),
                'profile' => $image,
            ];

            $this->session->set_userdata('username', $this->input->post('username'));
            $this->db->where('id_family', $data['user']['id_family']);
            $this->db->update('family', $user);
            $this->session->set_flashdata('update', '<div class="alert alert-primary alert-dismissable fade show" role="alert">Your Account has been updated</div>');
            redirect('user/profile');
        }
    }

    public function change()
    {
        $data['user'] = $this->user->getUser($this->session->userdata('username'));
        $this->form_validation->set_rules('password', 'Current Password', 'required');
        $this->form_validation->set_rules('newpassword', 'New Password', 'required|matches[renewpassword]');
        $this->form_validation->set_rules('renewpassword', 'Confirm New Password', 'required|matches[newpassword]');
        if ($this->form_validation->run() == false) {
            $data['province'] = $this->dashboard->province();
            $data['change'] = "active";
            $this->load->view('template/header');
            $this->load->view('user/profile', $data);
            $this->load->view('template/footer');
        } else {
            $current_password = $this->input->post('password');
            $new_password = $this->input->post('newpassword');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('change', '<div class="alert alert-primary alert-dismissable fade show" role="alert">Wrong Password</div>');
                redirect('user/change');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('change', '<div class="alert alert-primary alert-dismissable fade show" role="alert">New Password cannot be the same as current password</div>');
                    redirect('user/change');
                } else {
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                    $this->db->set('password', $password_hash);
                    $this->db->where('id_family', $data['user']['id_family']);
                    $this->db->update('family');
                    $this->session->set_flashdata('change', '<div class="alert alert-primary alert-dismissable fade show" role="alert">Password Changed</div>');
                    redirect('user/change');
                }
            }
        }
    }

    public function add()
    {
        $data['user'] = $this->user->getUser($this->session->userdata('username'));
        $this->form_validation->set_rules('userId', 'ID', 'required|trim|is_unique[user.nik]');
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('role', 'Role', 'required|trim');
        $this->form_validation->set_rules('date', 'Date', 'required|trim');
        $this->form_validation->set_rules('address', 'Address', 'required|trim');
        if (empty($_FILES['photo'])) {
            $this->form_validation->set_rules('photo', 'Photo', 'required');
        }
        $this->form_validation->set_rules('contact', 'Contact', 'required|trim');
        if ($this->form_validation->run() == false) {
            $array = array(
                'error' => true,
                'userId_error' => form_error('userId', '<div class="invalid">', '</div>'),
                'name_error' => form_error('name', '<div class="invalid">', '</div>'),
                'role_error' => form_error('role', '<div class="invalid">', '</div>'),
                'date_error' => form_error('date', '<div class="invalid">', '</div>'),
                'address_error' => form_error('address', '<div class="invalid">', '</div>'),
                'photo_error' => form_error('photo', '<div class="invalid">', '</div>'),
                'contact_error' => form_error('contact', '<div class="invalid">', '</div>'),
            );

            echo json_encode($array);
        } else {
            $image = $_FILES['photo'];
            $config['upload_path'] = './assets/userImage';
            $config['allowed_types'] = 'jpg|png|jpeg';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('photo')) {
                echo "Upload Failed";
                die();
            } else {
                $image = $this->upload->data('file_name');
            }
            $user = [
                'nik' => $this->input->post('userId'),
                'name' => $this->input->post('name'),
                'gender' => $this->input->post('gender'),
                'role' => $this->input->post('role'),
                'status' => 0,
                'dob' => $this->input->post('date'),
                'address' => $this->input->post('address'),
                'religion' => $this->input->post('selectReligion'),
                'photo' => $image,
                'married_status' => $this->input->post('status'),
                'contact' => $this->input->post('contact'),
                'id_disaster' => 0,
                'id_family' => $data['user']['id_family'],
            ];
            $this->db->insert('user', $user);
            $array = array(
                'error' => false,
            );
            echo json_encode($array);
        }
    }

    public function editData()
    {
        $nik = $this->input->post('userId');
        $data['member'] = $this->user->getUserbyId($nik);
        // var_dump($data['member']);
        // die;
        if ($this->input->post('userId') != $data['member']['nik']) {
            $us = '|is_unique[user.nik]';
        } else {
            $us = '';
        }
        $data['user'] = $this->user->getUser($this->session->userdata('username'));
        $this->form_validation->set_rules('userId', 'ID', 'required|trim' . $us);
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('role', 'Role', 'required|trim');
        $this->form_validation->set_rules('date', 'Date', 'required|trim');
        $this->form_validation->set_rules('address', 'Address', 'required|trim');
        if (empty($_FILES['photo'])) {
            $this->form_validation->set_rules('photo', 'Photo', 'required');
        }
        $this->form_validation->set_rules('contact', 'Contact', 'required|trim');
        if ($this->form_validation->run() == false) {
            $array = array(
                'error' => true,
                'userId_error' => form_error('userId', '<div class="invalid">', '</div>'),
                'name_error' => form_error('name', '<div class="invalid">', '</div>'),
                'role_error' => form_error('role', '<div class="invalid">', '</div>'),
                'date_error' => form_error('date', '<div class="invalid">', '</div>'),
                'address_error' => form_error('address', '<div class="invalid">', '</div>'),
                'photo_error' => form_error('photo', '<div class="invalid">', '</div>'),
                'contact_error' => form_error('contact', '<div class="invalid">', '</div>'),
            );

            echo json_encode($array);
        } else {
            $image = $_FILES['photo'];
            $config['upload_path'] = './assets/userImage';
            $config['allowed_types'] = 'jpg|png|jpeg';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('photo')) {
                echo "Upload Failed";
                die();
            } else {
                $old_image = $data['member']['photo'];
                if ($old_image != 'profile-img.jpg') {
                    unlink(FCPATH . 'assets/userImage/' . $old_image);
                }
                $image = $this->upload->data('file_name');
            }
            $user = [
                'nik' => $this->input->post('userId'),
                'name' => $this->input->post('name'),
                'gender' => $this->input->post('gender'),
                'role' => $this->input->post('role'),
                'status' => 0,
                'dob' => $this->input->post('date'),
                'address' => $this->input->post('address'),
                'religion' => $this->input->post('selectReligion'),
                'photo' => $image,
                'married_status' => $this->input->post('status'),
                'contact' => $this->input->post('contact'),
                'id_disaster' => 0,
                'id_family' => $data['user']['id_family'],
            ];
            $this->db->where('nik', $nik);
            $this->db->update('user', $user);
            $array = array(
                'error' => false,
            );
            echo json_encode($array);
        }
    }

    public function delete()
    {
        $id_user = $this->input->post('userId');
        $this->user->deleteById($id_user);
        redirect('user');
    }

    public function blocked()
    {
        $this->load->view('template/header');
        $this->load->view('blocked');
        $this->load->view('template/footer');
    }
}
