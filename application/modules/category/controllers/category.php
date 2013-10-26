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

    public function category_list() {
        $this->load->model('category_model');
        return $this->load->view('category_list', array('category_listing' => $this->category_model->get_category()));
    }

    public function add_category() {
        $data = array();
        $data = $this->input->post('category', TRUE);

        if ((!empty($data))) {
            if ((isset($data['category'])) && (preg_match('/^[a-zA-Z0-9]+[-_,a-zA-Z0-9\s]*$/', $data['category']))) {
                $this->load->model('category_model');
                if ($this->category_model->duplicate_category_check($data)) {
                    $this->category_model->save($data);
                    echo json_encode(array('addCategory' => array('successCode' => '000', 'successMessage' => 'category added successfully!')));
                    exit();
                } else {
                    echo json_encode(array('addCategory' => array('successCode' => '999', 'successMessage' => 'category already existed or please choose different email and username!')));
                    exit();
                }
            } else {
                echo json_encode(array('addCategory' => array('successCode' => '001', 'successMessage' => 'category has not been added, please try again!')));
                exit();
            }
        }

        return $this->load->view('add_category');
    }

    public function delete_category() {
        $id = NULL;
        $id = $this->input->get('id', TRUE);
        $this->load->model('category_model');
        $this->category_model->delete($id);

        redirect('category/category_list');
    }

    public function edit_category() {
        $data = array();
        $id = NULL;
        $id = $this->input->get('id', TRUE);
        $data = $this->input->post('category', TRUE);
        $this->load->model('category_model');

        if ((!empty($data))) {
            if (isset($data['category']) && ($data['category'])) {

                $this->category_model->edit($data['id'], $data);
                echo json_encode(array('editCategory' => array('successCode' => '000', 'successMessage' => 'category updated successfully!')));
                exit();
            } else {
                echo json_encode(array('editCategory' => array('successCode' => '001', 'successMessage' => 'some problem in updation, please try again!')));
                exit();
            }
        }
        return $this->load->view('edit_category', array('category' => $this->category_model->get_category_by_id($id)));
    }

    public function subcategory_list() {
        $this->load->model('category_model');
        return $this->load->view('subcategory_list', array('subcategory_listing' => $this->category_model->get_subcategory()));
    }

    public function get_parent_category() {
        $this->load->model('category_model');
        $id = null;
        $id = $this->category_model->get_subcategory_by_id($this->input->get('id', TRUE));
        echo json_encode(array('category' => $this->get_category(), 'id' => $id), TRUE);
        exit();
    }

    public function add_subcategory() {
        $data = $this->input->post('subcategory', TRUE);

        if ((!empty($data))) {
            if (isset($data['subcategory']) && (preg_match('/^[a-zA-Z0-9]+[-_,a-zA-Z0-9\s]*$/', $data['subcategory']))) {
                $this->load->model('category_model');
                if ($this->category_model->duplicate_subcategory_check($data)) {
                    $this->category_model->save_subcategory($data);
                    echo json_encode(array('addSubCategory' => array('successCode' => '000', 'successMessage' => 'user added successfully!')));
                    exit();
                } else {
                    echo json_encode(array('addSubCategory' => array('successCode' => '999', 'successMessage' => 'subcategory already existed!')));
                    exit();
                }
            } else {
                echo json_encode(array('addSubCategory' => array('successCode' => '001', 'successMessage' => 'subcategory has not been added, please try again!')));
                exit();
            }
        }

        return $this->load->view('add_subcategory');
    }

    public function edit_subcategory() {
        $data = array();
        $id = NULL;
        $id = $this->input->get('id', TRUE);
        $data = $this->input->post('subcategory', TRUE);
        $this->load->model('category_model');

        if ((!empty($data))) {
            if (isset($data['subcategory']) && (preg_match('/^[a-zA-Z0-9]+[-_,a-zA-Z0-9\s]*$/', $data['subcategory']))) {

                $this->category_model->edit_subcategory($data['id'], $data);
                echo json_encode(array('editSubCategory' => array('successCode' => '000', 'successMessage' => 'subcategory updated successfully!')));
                exit();
            } else {
                echo json_encode(array('editSubCategory' => array('successCode' => '001', 'successMessage' => 'some problem in updation, please try again!')));
                exit();
            }
        }
        return $this->load->view('edit_subcategory', array('edit_subcategory' => $this->category_model->get_subcategory_by_id($id)));
    }

    public function delete_subcategory() {
        $id = NULL;
        $id = $this->input->get('id', TRUE);
        $this->load->model('category_model');
        $this->category_model->delete_subcategory($id);

        redirect('category/subcategory_list');
    }

}

/* End of file hmvc.php */
/* Location: ./application/widgets/hmvc/controllers/hmvc.php */