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
        $data = array();
        $data = $this->input->post('userinfo', TRUE);

        if ((!empty($data))) {
            if (((isset($data['username'])) && (preg_match('/^[a-zA-Z0-9]+[-_,a-zA-Z0-9\s]*$/', $data['username']))) && ((isset($data['fname'])) && (preg_match('/^[a-zA-Z0-9]+[-_,a-zA-Z0-9\s]*$/', $data['fname']))) && ((isset($data['lname'])) && (preg_match('/^[a-zA-Z0-9]+[-_,a-zA-Z0-9\s]*$/', $data['lname']))) && (isset($data['password']) && (strlen($data['password']) >= 8)) && ((isset($data['email'])) && (preg_match('/^([a-z0-9][-a-z0-9_\+\.]*[a-z0-9])@([a-z0-9][-a-z0-9\.]*[a-z0-9]\.(arpa|root|aero|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|ac|ad|ae|af|ag|ai|al|am|an|ao|aq|ar|as|at|au|aw|ax|az|ba|bb|bd|be|bf|bg|bh|bi|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|cr|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|ee|eg|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gg|gh|gi|gl|gm|gn|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|im|in|io|iq|ir|is|it|je|jm|jo|jp|ke|kg|kh|ki|km|kn|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|mv|mw|mx|my|mz|na|nc|ne|nf|ng|ni|nl|no|np|nr|nu|nz|om|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tl|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)|([0-9]{1,3}\.{3}[0-9]{1,3}))$/', $data['email'])))) {
                $this->load->model('administrator_model');
                if ($this->administrator_model->duplicate_account_check($data)) {
                    $this->administrator_model->save($data);
                    echo json_encode(array('addUser' => array('successCode' => '000', 'successMessage' => 'user added successfully!')));
                    exit();
                } else {
                    echo json_encode(array('addUser' => array('successCode' => '999', 'successMessage' => 'user already existed or please choose different email and username!')));
                    exit();
                }
            } else {
                echo json_encode(array('addUser' => array('successCode' => '001', 'successMessage' => 'user has not been added, please try again!')));
                exit();
            }
        }
        return $this->load->view('add_user');
    }

    public function delete_user() {
        $id = NULL;
        $id = $this->input->get('id', TRUE);
        $this->load->model('administrator_model');
        $this->administrator_model->delete($id);

        redirect('administrator/user_list');
    }

    public function edit_user() {
        $data = array();
        $id = NULL;
        $id = $this->input->get('id', TRUE);
        $data = $this->input->post('userinfo', TRUE);
        $this->load->model('administrator_model');

        if ((!empty($data))) {
            if (((isset($data['username'])) && (preg_match('/^[a-zA-Z0-9]+[-_,a-zA-Z0-9\s]*$/', $data['username']))) && ((isset($data['fname'])) && (preg_match('/^[a-zA-Z0-9]+[-_,a-zA-Z0-9\s]*$/', $data['fname']))) && ((isset($data['lname'])) && (preg_match('/^[a-zA-Z0-9]+[-_,a-zA-Z0-9\s]*$/', $data['lname']))) && (isset($data['password']) && (strlen($data['password']) >= 8)) && ((isset($data['email'])) && (preg_match('/^([a-z0-9][-a-z0-9_\+\.]*[a-z0-9])@([a-z0-9][-a-z0-9\.]*[a-z0-9]\.(arpa|root|aero|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|ac|ad|ae|af|ag|ai|al|am|an|ao|aq|ar|as|at|au|aw|ax|az|ba|bb|bd|be|bf|bg|bh|bi|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|cr|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|ee|eg|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gg|gh|gi|gl|gm|gn|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|im|in|io|iq|ir|is|it|je|jm|jo|jp|ke|kg|kh|ki|km|kn|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|mv|mw|mx|my|mz|na|nc|ne|nf|ng|ni|nl|no|np|nr|nu|nz|om|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tl|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)|([0-9]{1,3}\.{3}[0-9]{1,3}))$/', $data['email'])))) {

                $this->administrator_model->edit($data['id'], $data);
                echo json_encode(array('editUser' => array('successCode' => '000', 'successMessage' => 'user information updated successfully!')));
                exit();
            } else {
                echo json_encode(array('editUser' => array('successCode' => '001', 'successMessage' => 'some problem in updation, please try again!')));
                exit();
            }
        }
        return $this->load->view('edit_user', array('user' => $this->administrator_model->get_user_info($id)));
    }

    public function logout() {
        $this->session->unset_userdata('admininfo');
        redirect('administrator/index');
    }

    public function isadmin_signin() {
        $admin_info = $this->session->userdata('admininfo');       
            
       if (isset($admin_info['username']) && ($admin_info['username'])){
            echo json_encode(array('isAdminSignin' => array('successCode' => '000', 'successMessage' => 'you are logged-in!')));
            exit();
        }
        echo json_encode(array('isAdminSignin' => array('successCode' => '001', 'successMessage' => 'Please logged-in first!')));
        exit();
    }

}

