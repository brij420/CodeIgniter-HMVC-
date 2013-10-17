<?php

class Likes_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function save($data = array()) {
        $user_data = array(
            'fname' => isset($data['fname']) && ($data['fname']) ? $data['fname'] : NULL,
            'lname' => isset($data['lname']) && ($data['lname']) ? $data['lname'] : NULL,
            'm_name' => isset($data['mname']) && ($data['mname']) ? $data['mname'] : NULL,
            'username' => isset($data['username']) && ($data['username']) ? $data['username'] : NULL,
            'email' => isset($data['email']) && ($data['email']) ? $data['email'] : NULL,
            'password' => isset($data['password']) && ($data['password']) ? md5($data['password']) : NULL,
            'is_admin' => '',
            'create' => time(),
            'image' => '',
        );

        return $this->db->insert('like', $user_data);
    }

    function get($data = array()) {
        $row = $this->db->query("SELECT * FROM like WHERE username='" . $data['username'] . "' AND  password='" . md5($data['password']) . "'");
        $result = $row->result_array();
        return $result[0];
    }

    function get_image_likes_count($id = NULL) {
        $row = $this->db->query("SELECT COUNT(*) FROM `like` WHERE photo_id='" . $id . "'");
        $result = $row->result_array();
        return isset($result[0]['COUNT(*)']) && ($result[0]['COUNT(*)']) ? $result[0]['COUNT(*)'] : 0;
    }

    function get_image_details($id = NULL) {
        $row = $this->db->query("SELECT photo.*,categories.name as category_name,sub_categories.name as sub_category_name FROM photo  LEFT JOIN categories ON(photo.cat_id=categories.id) LEFT JOIN sub_categories ON(photo.sub_cat_id=sub_categories.id) WHERE photo.id='" . $id . "'");
        $result = $row->result_array();

        return isset($result[0]) && ($result[0]) ? $result[0] : NULL;
    }

    function get_category_list() {
        $row = $this->db->query("SELECT * FROM categories");
        $result = $row->result_array();
        return $result;
    }

    function authentication($data = array()) {
        $row = $this->db->query("SELECT COUNT(*) FROM like WHERE username='" . $data['username'] . "' AND  password='" . md5($data['password']) . "'");
        $result = $row->result_array();
        if (isset($result[0]['COUNT(*)']) && ($result[0]['COUNT(*)'])) {
            return true;
        }
        return false;
    }

    function delete($id = NULL) {
        return $this->db->delete('like', array('id' => $id));
    }

    function edit($id = NULL) {
        $data = array(
            'title' => $title,
            'name' => $name,
            'date' => $date
        );

        $this->db->where('id', $id);
        $this->db->update('like', $data);
    }

}

?>
