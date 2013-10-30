<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Template extends MX_Controller {

    public function index($data = NULL) {
        return $this->load->view('header', $data);
    }

    public function leftsidepanel($data = NULL) {
        return $this->load->view('leftsidepanel', $data);
    }

    public function rightsidepanel($data = NULL) {
        return $this->load->view('rightsidepanel', $data);
    }

    public function footer($data = NULL) {
        return $this->load->view('footer', $data);
    }

    public function admin_header($data = NULL) {
        return $this->load->view('administrator_header', $data);
    }

    public function admin_footer($data = NULL) {
        return $this->load->view('admin_footer', $data);
    }

}
