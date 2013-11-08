<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Comment extends MX_Controller {

    public function add_comment() {

        $data = array();
        $data = $this->input->post('comment', TRUE);

        if ((!empty($data))) {
            if (((isset($data['subject'])) && ($data['subject'])) && ((isset($data['description'])) && ($data['description']))) {
                $this->load->model('comment_model');
                $this->comment_model->save($data);
                echo json_encode(array('comment' => array('successCode' => '000', 'successMessage' => 'comment saved successfully!')));
                exit();
            }
            echo json_encode(array('comment' => array('successCode' => '001', 'successMessage' => 'there are error, please try again!')));
            exit();
        }
        echo json_encode(array('comment' => array('successCode' => '001', 'successMessage' => 'fields cannot be empty!')));
        exit();
    }

    function get_comments($id = NULL) {

        $this->load->model('comment_model');
        return $this->comment_model->get_all_comments($id);
    }

    public function image_comments_count($id = NULL) {
        $this->load->model('likes_model');
        return $this->likes_model->get_comment_count($id);
    }

}

/* End of file hmvc.php */
/* Location: ./application/widgets/hmvc/controllers/hmvc.php */