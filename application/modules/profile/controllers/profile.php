<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profile extends MX_Controller {

    public function index() {
        $userinfo = array();
        $userinfo = $this->session->userdata('userinfo');
        if (!isset($userinfo['id']) && (!$userinfo['id'])) {
           // redirect('user/index');
        }
        return $this->load->view('profile',array('user_info'=>$userinfo));
    }

    public function add_photo() {

        return $this->load->view('add_photo');
    }

   

}

/* End of file hmvc.php */
/* Location: ./application/widgets/hmvc/controllers/hmvc.php */