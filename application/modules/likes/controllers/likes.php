<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Likes extends MX_Controller {

    public function index($id = 1) {
        $this->load->model('likes_model');
        return $this->load->view('images', array('images' => $this->likes_model->get_image_list($id)));
    }

    public function image_likes_count($id=NULL) {
        $this->load->model('likes_model');
        return $this->likes_model->get_image_likes_count($id);
        
    }

    public function image_info() {
        $id = $this->input->get('id', TRUE);
        $this->load->model('likes_model');
        return $this->load->view('image_info', array('image_info' => $this->likes_model->get_image_details($id)));
    }

    public function delete_user() {
        $this->load->model('likes_model');
        return $this->load->view('user_listing', array('user_listing' => $this->likes_model->get_user_list()));
    }

    public function edit_user() {
        $this->load->model('likes_model');
        return $this->load->view('user_listing', array('user_listing' => $this->likes_model->get_user_list()));
    }

    public function logout() {
        $this->session->unset_userdata('admininfo');
        redirect('administrator/index');
    }

}

