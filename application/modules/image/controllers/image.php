<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Image extends MX_Controller {

    public function index($id = 1) {
        $this->load->model('image_model');
        return $this->load->view('images', array('images' => $this->image_model->get_image_list($id)));
    }

    public function image_list() {
        $this->load->model('image_model');
        return $this->load->view('images', array('images' => $this->image_model->get_user_list()));
    }

    public function image_info() {
        $id = $this->input->get('id', TRUE);
        $this->load->model('image_model');
        return $this->load->view('image_info', array('image_info' => $this->image_model->get_image_details($id)));
    }
  

}

