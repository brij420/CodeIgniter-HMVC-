<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Image extends MX_Controller {

    public function index($id = 1) {
        $this->load->model('image_model');
        return $this->load->view('images', array('images' => $this->image_model->get_image_list($id)));
    }

    public function add_photo_tournament() {
        $data = array();
        $data = $this->input->post('image', TRUE);
        $this->load->model('image_model');
        if ((!empty($data))) {
            $data['image'] = explode(',', $data['image_name']);
            $data['image'] = array_unique($data['image']);
            $userinfo = array();
            $userinfo = $this->session->userdata('userinfo');
            if (isset($userinfo['id']) && ($userinfo['id'])) {
                $data['user_id'] = $userinfo['id'];
            }
            for ($i = 0; $i < count($data['image']); $i++) {
                if (isset($data['image'][$i]) && ($data['image'][$i]))
                    $this->image_model->save_image_tournament($this->image_model->save_image($data['image'][$i], $data), $data);
            }
            echo json_encode(array('saveImage' => array('successCode' => '000', 'successMessage' => 'image has been added successfully!')));
            exit();
        }


        return $this->load->view('add_photo', array('id' => $this->input->get('id', TRUE), 'cat_id' => $this->input->get('cat_id', TRUE)));
    }

    public function get_all_images($id = 1) {
        $userinfo = array();
        $this->load->model('image_model');
        $userinfo = $this->session->userdata('userinfo');
        if (isset($userinfo['id']) && ($userinfo['id'])) {
            return $this->load->view('images', array('images' => $this->image_model->get_image_list($id, $userinfo['id'])));
        }
        return false;
    }

    public function get_images() {
        $userinfo = array();
        $this->load->model('image_model');
        $userinfo = $this->session->userdata('userinfo');
        if (isset($userinfo['id']) && ($userinfo['id'])) {
            return $this->load->view('profile_images', array('images' => $this->image_model->get_images($userinfo['id'])));
        }
        return false;
    }

    public function delete_profile_image() {
        $userinfo = array();
        $this->load->model('image_model');
        $this->image_model->delete_profile_image($this->input->get('id', TRUE));
        redirect('profile/index');
    }

    public function save_profile_images($images = NULL, $user_id = NULL) {
        $data = explode(',', $images);
        $this->load->model('image_model');
        $data = array_unique($data);
        for ($i = 0; $i < count($data); $i++) {
            if (isset($data[$i]) && ($data[$i]))
                $this->image_model->save($data[$i], $user_id);
        }
        return $data[0];
        //return $this->load->view('images', array('images' => $this->image_model->get_image_list($id)));
    }

    public function image_list() {
        $this->load->model('image_model');
        return $this->load->view('images', array('images' => $this->image_model->get_user_list()));
    }

    public function get_tournament_images() {
        $this->load->model('image_model');
        echo json_encode(array('imageList' => array('successCode' => '000', 'successMessage' => 'image list!', 'images' => $this->image_model->get_image_list($this->input->get('id', TRUE)))));
        exit();
    }

    public function delete_tournament_image() {
        $id = $this->input->get('id', TRUE);
        $this->load->model('image_model');
        $this->image_model->delete_tournament_image($this->input->get('id', TRUE));
        redirect('image/images');
    }

    public function images() {

        return $this->load->view('image_list', array('tournaments' => Modules::run('category/get_turnament_list')));
    }

    public function image_info() {
        $id = $this->input->get('id', TRUE);
        $this->load->model('image_model');
        return $this->load->view('image_info', array('image_info' => $this->image_model->get_image_details($id)));
    }

    public function add_image() {
        $data = array();
        $data = $this->input->post('image', TRUE);
        $this->load->model('image_model');
        if ((!empty($data))) {
            $data['image'] = explode(',', $data['image_name']);
            $data['image'] = array_unique($data['image']);
            $userinfo = array();
            $userinfo = $this->session->userdata('userinfo');
            if (isset($userinfo['id']) && ($userinfo['id'])) {
                $data['user_id'] = $userinfo['id'];
            }
            for ($i = 0; $i < count($data['image']); $i++) {
                if (isset($data['image'][$i]) && ($data['image'][$i]))
                    $this->image_model->save_image($data['image'][$i], $data);
            }
            echo json_encode(array('saveImage' => array('successCode' => '000', 'successMessage' => 'image has been added successfully!')));
            exit();
        }

        echo json_encode(array('saveImage' => array('successCode' => '001', 'successMessage' => 'problem in image adding!')));
        exit();
    }

    public function add_profile_image() {
        $data = array();
        $data = $this->input->post('profile_image', TRUE);
        $this->load->model('image_model');
        if ((!empty($data))) {
            $data['image'] = explode(',', $data['image_name']);
            $data['image'] = array_unique($data['image']);
            $userinfo = array();
            $userinfo = $this->session->userdata('userinfo');
            if (isset($userinfo['id']) && ($userinfo['id'])) {
                $data['user_id'] = $userinfo['id'];
            }
            for ($i = 0; $i < count($data['image']); $i++) {
                if (isset($data['image'][$i]) && ($data['image'][$i]))
                    $this->image_model->save_profile_image($data['image'][$i], $data);
            }
            echo json_encode(array('saveImage' => array('successCode' => '000', 'successMessage' => 'image has been added successfully!')));
            exit();
        }

        echo json_encode(array('saveImage' => array('successCode' => '001', 'successMessage' => 'problem in image adding!')));
        exit();
    }

    public function upload_file() {
        $this->load->model('image_model');
        $uploaddir = './uploads/';
        $file = $uploaddir . basename($_FILES['uploadfile']['name']);

        if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) {
            echo json_encode(array('fileUpload' => array('successCode' => '000', 'successMessage' => 'file has been uploaded successfully!', 'file' => $_FILES['uploadfile']['name'])));
            exit();
        }
        echo json_encode(array('fileUpload' => array('successCode' => '001', 'successMessage' => 'problem in file uploading!')));
        exit();
    }

}

