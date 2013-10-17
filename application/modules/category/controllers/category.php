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

}

/* End of file hmvc.php */
/* Location: ./application/widgets/hmvc/controllers/hmvc.php */