<?php

class Category_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function save($data = array()) {
        $categories = array(
            'name' => isset($data['category']) && ($data['category']) ? $data['category'] : NULL,
            'date' => time()
        );

        return $this->db->insert('categories', $categories);
    }

    function save_subcategory($data = array()) {
        $subcategories = array(
            'cat_id' => isset($data['select_category']) && ($data['select_category']) ? $data['select_category'] : NULL,
            'name' => isset($data['subcategory']) && ($data['subcategory']) ? $data['subcategory'] : NULL,
            'date' => time()
        );

        return $this->db->insert('sub_categories', $subcategories);
    }

    function get_category() {
        $row = $this->db->query("SELECT * FROM categories");
        $result = $row->result_array();
        return $result;
    }

    function get_category_by_id($id = NULL) {
        $row = $this->db->query("SELECT * FROM categories WHERE id='" . $id . "'");
        $result = $row->result_array();
        return $result[0];
    }

    function get_subcategory_by_id($id = NULL) {
        $row = $this->db->query("SELECT * FROM sub_categories WHERE id='" . $id . "'");
        $result = $row->result_array();
        return isset($result[0])&&($result[0])?$result[0]:NULL;
    }

    function get_sub_category() {
        $row = $this->db->query("SELECT * FROM sub_categories");
        $result = $row->result_array();
        return $result;
    }

    function duplicate_category_check($data) {
        $row = $this->db->query("SELECT COUNT(*) FROM categories WHERE name='" . $data['category'] . "'");
        $result = $row->result_array();
        if (isset($result[0]['COUNT(*)']) && ($result[0]['COUNT(*)'])) {
            return false;
        }
        return true;
    }

    function duplicate_subcategory_check($data) {
        $row = $this->db->query("SELECT COUNT(*) FROM sub_categories WHERE name='" . $data['subcategory'] . "'");
        $result = $row->result_array();
        if (isset($result[0]['COUNT(*)']) && ($result[0]['COUNT(*)'])) {
            return false;
        }
        return true;
    }

    function get_subcategory() {
        $row = $this->db->query("SELECT sub_categories.name as subcategory_name,sub_categories.date as date,sub_categories.cat_id as cat_id,sub_categories.id as id,categories.name as category_name FROM sub_categories LEFT JOIN categories ON(sub_categories.cat_id=categories.id)");
        $result = $row->result_array();
        return $result;
    }

    function delete($id = NULL) {
        return $this->db->delete('categories', array('id' => $id));
    }

    function delete_subcategory($id = NULL) {
        return $this->db->delete('sub_categories', array('id' => $id));
    }

    function edit($id = NULL, $data = array()) {
        $category_data = array(
            'name' => isset($data['category']) && ($data['category']) ? $data['category'] : NULL,
            'date' => time()
        );

        $this->db->where('id', $id);
        return $this->db->update('categories', $category_data);
    }

    function edit_subcategory($id = NULL, $data = array()) {
        $subcategories = array(
            'cat_id' => isset($data['select_category']) && ($data['select_category']) ? $data['select_category'] : NULL,
            'name' => isset($data['subcategory']) && ($data['subcategory']) ? $data['subcategory'] : NULL,
            'date' => time()
        );
        $this->db->where('id', $id);
        return $this->db->update('sub_categories', $subcategories);
    }

}

?>
