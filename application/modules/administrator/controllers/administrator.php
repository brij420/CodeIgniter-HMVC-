<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Administrator extends MX_Controller {

    public function index() {
        $admin_info = array();
        $admin_info = $this->session->userdata('admininfo');
        if (isset($admin_info['username']) && ($admin_info['username']))
            redirect('administrator/user_list');
        $data = array();
        $data['username'] = $this->input->post('username', TRUE);
        $data['password'] = $this->input->post('password', TRUE);
        if ((!empty($data))) {

            $this->load->model('administrator_model');
            if ($this->administrator_model->authentication($data)) {
                $this->session->set_userdata(array('admininfo' => $this->administrator_model->get($data)));
                // redirect('administrator/user_list');
            }
        }
        return $this->load->view('login');
    }

    public function user_list() {
        $this->load->model('administrator_model');
        return $this->load->view('user_listing', array('user_listing' => $this->administrator_model->get_user_list()));
    }

    public function add_user() {
        $this->load->model('administrator_model');
        return $this->load->view('user_listing', array('user_listing' => $this->administrator_model->get_user_list()));
    }

    public function delete_user() {
        $this->load->model('administrator_model');
        return $this->load->view('user_listing', array('user_listing' => $this->administrator_model->get_user_list()));
    }

    public function edit_user() {
        $this->load->model('administrator_model');
        return $this->load->view('user_listing', array('user_listing' => $this->administrator_model->get_user_list()));
    }

    public function logout() {
        $this->session->unset_userdata('admininfo');
        redirect('administrator/index');
    }

}

