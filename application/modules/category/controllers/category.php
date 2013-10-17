<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category extends MX_Controller {

    public function index() {

        $category = array();
        $subcategory = array();
        $this->load->model('category_model');
        $category = $this->category_model->get_category();
        $subcategory = $this->category_model->get_sub_category();

        for ($i = 0; $i < count($category); $i++) {
            for ($j = 0; $j < count($subcategory); $j++) {
                if ($category[$i]['id'] == $subcategory[$j]['cat_id']) {
                    $category[$i]['subcategory'][] = $subcategory[$j];
                }
            }
        }

        return $this->load->view('category', array('category' => $category));
    }

    public function get_category() {

        $this->load->model('category_model');
        return $this->category_model->get_category();
    }

    public function registration() {
        $data = array();
        $data = $this->input->post('userinfo', TRUE);

        if ((!empty($data))) {
            if (((isset($data['username'])) && (preg_match('/^[a-zA-Z0-9]+[-_,a-zA-Z0-9\s]*$/', $data['username']))) && ((isset($data['fname'])) && (preg_match('/^[a-zA-Z0-9]+[-_,a-zA-Z0-9\s]*$/', $data['fname']))) && ((isset($data['lname'])) && (preg_match('/^[a-zA-Z0-9]+[-_,a-zA-Z0-9\s]*$/', $data['lname']))) && (isset($data['password']) && (strlen($data['password']) >= 8)) && ((isset($data['email'])) && (preg_match('/^([a-z0-9][-a-z0-9_\+\.]*[a-z0-9])@([a-z0-9][-a-z0-9\.]*[a-z0-9]\.(arpa|root|aero|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|ac|ad|ae|af|ag|ai|al|am|an|ao|aq|ar|as|at|au|aw|ax|az|ba|bb|bd|be|bf|bg|bh|bi|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|cr|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|ee|eg|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gg|gh|gi|gl|gm|gn|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|im|in|io|iq|ir|is|it|je|jm|jo|jp|ke|kg|kh|ki|km|kn|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|mv|mw|mx|my|mz|na|nc|ne|nf|ng|ni|nl|no|np|nr|nu|nz|om|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tl|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)|([0-9]{1,3}\.{3}[0-9]{1,3}))$/', $data['email'])))) {
                $this->load->model('category_model');
                $this->category_model->save($data);
                echo json_encode(array('addUser' => array('successCode' => '000', 'successMessage' => 'user register successfully!')));
                exit();
            } else {
                echo json_encode(array('addUser' => array('successCode' => '001', 'successMessage' => 'registration fail, please try again!')));
                exit();
            }
        }
        return $this->load->view('registration');
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
                $this->load->model('category_model');
                $this->category_model->save($data);
                echo json_encode(array('forgotPassword' => array('successCode' => '000', 'successMessage' => 'user register successfully!')));
                exit();
            } else {
                echo json_encode(array('forgotPassword' => array('successCode' => '001', 'successMessage' => 'registration fail, please try again!')));
                exit();
            }
        }
        return $this->load->view('forgotpassword');
    }

    public function passwordreset() {
        return $this->load->view('hmvc_view');
    }

}

/* End of file hmvc.php */
/* Location: ./application/widgets/hmvc/controllers/hmvc.php */