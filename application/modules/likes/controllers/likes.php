<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Likes extends MX_Controller {

    public function image_likes_count($id = NULL) {
        $this->load->model('likes_model');
        return $this->likes_model->get_image_likes_count($id);
    }

    public function likes_image() {
        $photo_id = $this->input->post('likes', TRUE);
        $this->load->model('likes_model');
        $this->likes_model->save($photo_id['photo_id']);
        $this->likes_model->get_liked_user_list($photo_id['photo_id']);
        exit();
    }

    public function get_liked_user_list($id = NULL) {
        $this->load->model('likes_model');
        return $this->likes_model->get_liked_user_list($id);
    }

}

