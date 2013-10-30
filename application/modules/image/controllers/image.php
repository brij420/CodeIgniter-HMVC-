<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Image extends MX_Controller {

    public function index($id = 1) {
        $this->load->model('image_model');
        return $this->load->view('images', array('images' => $this->image_model->get_image_list($id)));
    }

    public function save_profile_images($images = NULL, $user_id = NULL) {
        $data = explode(',', $images);
        $this->load->model('image_model');
        $data = array_unique($data);
        for ($i = 0; $i < count($data); $i++){
            if(isset($data[$i])&&($data[$i]))
            $this->image_model->save($data[$i], $user_id);
        }
        return $data[0];
        //return $this->load->view('images', array('images' => $this->image_model->get_image_list($id)));
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

