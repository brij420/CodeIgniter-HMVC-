<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends MX_Controller {

    public function index() {

        return $this->load->view('home');
    }

    public function login() {
        $userinfo = array();
        $userinfo = $this->session->userdata('userinfo');
        if (isset($userinfo['id']) && ($userinfo['id'])) {
            redirect('user/index');
        }
        $data = array();
        $data = $this->input->post('signin', TRUE);
        if ((!empty($data))) {
            if (((isset($data['username'])) && (preg_match('/^[a-zA-Z0-9]+[-_,a-zA-Z0-9\s]*$/', $data['username']))) && (isset($data['password']) && (strlen($data['password']) >= 8))) {
                $this->load->model('user_model');
                if ($this->user_model->authentication($data)) {
                    $this->session->set_userdata(array('userinfo' => $this->user_model->get($data)));
                }
                echo json_encode(array('signin' => array('successCode' => '000', 'successMessage' => 'user signin successfully!')));
                exit();
            } else {
                echo json_encode(array('signin' => array('successCode' => '001', 'successMessage' => 'Invalid signin credentials!')));
                exit();
            }
        }
        return $this->load->view('login');
    }

    public function activate_account() {
        $data = array();
        $link = $this->input->get('link', TRUE);
        $this->load->model('user_model');
        if ($this->user_model->update(array('is_active' => '1'), array('confirmation' => $link))) {
            $this->session->set_userdata(array('userinfo' => $this->user_model->get(array('link' => $link))));
            redirect('user/index');
        }
        redirect('user/registration');
    }

    public function registration() {
        $data = array();
        $data = $this->input->post('userinfo', TRUE);

        if ((!empty($data))) {
            if (((isset($data['username'])) && (preg_match('/^[a-zA-Z0-9]+[-_,a-zA-Z0-9\s]*$/', $data['username']))) && ((isset($data['fname'])) && (preg_match('/^[a-zA-Z0-9]+[-_,a-zA-Z0-9\s]*$/', $data['fname']))) && ((isset($data['lname'])) && (preg_match('/^[a-zA-Z0-9]+[-_,a-zA-Z0-9\s]*$/', $data['lname']))) && (isset($data['password']) && (strlen($data['password']) >= 8)) && ((isset($data['email'])) && (preg_match('/^([a-z0-9][-a-z0-9_\+\.]*[a-z0-9])@([a-z0-9][-a-z0-9\.]*[a-z0-9]\.(arpa|root|aero|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|ac|ad|ae|af|ag|ai|al|am|an|ao|aq|ar|as|at|au|aw|ax|az|ba|bb|bd|be|bf|bg|bh|bi|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|cr|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|ee|eg|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gg|gh|gi|gl|gm|gn|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|im|in|io|iq|ir|is|it|je|jm|jo|jp|ke|kg|kh|ki|km|kn|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|mv|mw|mx|my|mz|na|nc|ne|nf|ng|ni|nl|no|np|nr|nu|nz|om|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tl|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)|([0-9]{1,3}\.{3}[0-9]{1,3}))$/', $data['email'])))) {
                $this->load->model('user_model');
                if ($this->user_model->duplicate_account_check($data)) {
                    $data['confirmation'] = md5($data['username'] . time());
                    $image = Modules::run('image/save_profile_images', $data['image_name'], $this->user_model->save($data));
                    if ($this->user_model->update(array('image' => $image), array('username' => $data['username']))) {
                        $body = "Dear " . $data['username'] . ",
                                    thank you for registering on the Kliklikes website.
                                    Your username is " . $data['username'] . ".
                                    To activate your account please click on the link <a target='_blank' href='" . base_url() . "index.php/user/activate_account?link=" . $data['confirmation'] . "'>click here!</a>.

                                    Thank you,

                                    The Kliklikes Team";
                        $this->send_email($data['email'], "Registeration confirmation", $body, "brij420@gmail.com", "Brijesh Kumar");
                    }
                    echo json_encode(array('addUser' => array('successCode' => '000', 'successMessage' => 'user register successfully!')));
                    exit();
                } else {
                    echo json_encode(array('addUser' => array('successCode' => '999', 'successMessage' => 'user already has been registered or please choose different email and username!')));
                    exit();
                }
            } else {
                echo json_encode(array('addUser' => array('successCode' => '001', 'successMessage' => 'registration fail, please try again!')));
                exit();
            }
        }
        return $this->load->view('registration');
    }

    public function send_email($to = NULL, $subject = NULL, $message = NULL, $from = NULL, $fromName = NULL, $cc = NULL, $bcc = NULL) {
        $this->load->library('email');

        $this->email->from($from, $fromName);
        $this->email->to($to);
        if ($cc)
            $this->email->cc($cc);
        if ($bcc)
            $this->email->bcc($bcc);

        $this->email->subject($subject);
        $this->email->message($message);

        return $this->email->send();
    }

    public function upload_file() {
        $this->load->model('user_model');
        $uploaddir = './uploads/';
        $file = $uploaddir . basename($_FILES['uploadfile']['name']);

        if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) {
            echo json_encode(array('fileUpload' => array('successCode' => '000', 'successMessage' => 'file has been uploaded successfully!', 'file' => $_FILES['uploadfile']['name'])));
            exit();
        }
        echo json_encode(array('fileUpload' => array('successCode' => '001', 'successMessage' => 'problem in file uploading!')));
        exit();
    }

    public function is_signin() {
        $userinfo = array();
        $userinfo = $this->session->userdata('userinfo');
        if (isset($userinfo['id']) && ($userinfo['id'])) {
            echo json_encode(array('isSignin' => array('successCode' => '000', 'successMessage' => 'you are logged-in!')));
            exit();
        }
        echo json_encode(array('isSignin' => array('successCode' => '001', 'successMessage' => 'Please logged-in first!')));
        exit();
    }

    public function logout() {
        $this->session->unset_userdata('userinfo');
        return $this->index();
    }

    public function forgotpassword() {
        $data = array();
        $data = $this->input->post('forgotpassword', TRUE);
        if ((!empty($data))) {
            if ((isset($data['email'])) && (preg_match('/^([a-z0-9][-a-z0-9_\+\.]*[a-z0-9])@([a-z0-9][-a-z0-9\.]*[a-z0-9]\.(arpa|root|aero|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|ac|ad|ae|af|ag|ai|al|am|an|ao|aq|ar|as|at|au|aw|ax|az|ba|bb|bd|be|bf|bg|bh|bi|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|cr|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|ee|eg|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gg|gh|gi|gl|gm|gn|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|im|in|io|iq|ir|is|it|je|jm|jo|jp|ke|kg|kh|ki|km|kn|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|mv|mw|mx|my|mz|na|nc|ne|nf|ng|ni|nl|no|np|nr|nu|nz|om|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tl|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)|([0-9]{1,3}\.{3}[0-9]{1,3}))$/', $data['email']))) {
                $this->load->model('user_model');
                $data['unique_string'] = rand(1, 999);
                $this->user_model->edit($data);

                $this->load->library('email');

                $this->email->from('test@gmail.com', 'Test');
                $this->email->to($data['email']);
                $this->email->cc('test@gmail.com');
                //$this->email->bcc('them@their-example.com');

                $this->email->subject('Forgot Password');
                $this->email->message('Testing the email for Forgot Password.Please click <a href="' . base_url() . 'index.php/user/reset_password?link=' . $data['unique_string'] . '">here</a> ');

                $this->email->send();

                echo json_encode(array('forgotPassword' => array('successCode' => '000', 'successMessage' => 'password request has been sent on your email successfully!')));
                exit();
            } else {
                echo json_encode(array('forgotPassword' => array('successCode' => '001', 'successMessage' => 'problem in sending email, please try again!')));
                exit();
            }
        }
        return $this->load->view('forgotpassword');
    }

    public function reset_password() {
        $data = array();
        $data = $this->input->post('reset_password', TRUE);
        if ((!empty($data))) {
            if ((isset($data['password'])) && ($data['password']) && (isset($data['link'])) && ($data['link'])) {
                $this->load->model('user_model');
                $this->user_model->reset_password($data);

                echo json_encode(array('resetPassword' => array('successCode' => '000', 'successMessage' => 'password has been reset successfully!')));
                exit();
            } else {
                echo json_encode(array('resetPassword' => array('successCode' => '001', 'successMessage' => 'problem in resetting password, please try again!')));
                exit();
            }
        }
        return $this->load->view('reset_password', array('link' => $this->input->get('link', TRUE)));
    }

}

/* End of file hmvc.php */
/* Location: ./application/widgets/hmvc/controllers/hmvc.php */