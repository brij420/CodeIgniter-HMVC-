<?php

class User_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function save($data = array()) {
        $user_data = array(
            'fname' => isset($data['fname']) && ($data['fname']) ? $data['fname'] : '',
            'lname' => isset($data['lname']) && ($data['lname']) ? $data['lname'] : '',
            'username' => isset($data['username']) && ($data['username']) ? $data['username'] : '',
            'email' => isset($data['email']) && ($data['email']) ? $data['email'] : '',
            'gender' => isset($data['gender']) && ($data['gender']) ? $data['gender'] : '',
            'password' => isset($data['password']) && ($data['password']) ? md5($data['password']) : NULL,
            'address' => isset($data['address']) && ($data['address']) ? $data['address'] : NULL,
            'city' => isset($data['city']) && ($data['city']) ? $data['city'] : NULL,
            'country' => isset($data['country']) && ($data['country']) ? $data['country'] : NULL,
            'phone' => isset($data['phone']) && ($data['phone']) ? $data['phone'] : NULL,
            'confirmation' => isset($data['confirmation']) && ($data['confirmation']) ? $data['confirmation'] : '',
            'is_admin' => '',
            'create' => time(),
            'image' => '',
        );

        $this->db->insert('user_account', $user_data);
        return $this->db->insert_id();
    }

    function get($data = array()) {
        $row = $this->db->query("SELECT * FROM user_account WHERE (username='" . $data['username'] . "' AND  password='" . md5($data['password']) . "')||(confirmation='" . $data['link'] . "')");
        $result = $row->result_array();
        return $result[0];
    }

    function authentication($data = array()) {
        $row = $this->db->query("SELECT COUNT(*) FROM user_account WHERE username='" . $data['username'] . "' AND  password='" . md5($data['password']) . "'");
        $result = $row->result_array();
        if (isset($result[0]['COUNT(*)']) && ($result[0]['COUNT(*)'])) {
            return true;
        }
        return false;
    }

    function duplicate_account_check($data = array()) {
        $row = $this->db->query("SELECT COUNT(*) FROM user_account WHERE username='" . $data['username'] . "'");
        $result = $row->result_array();
        if (isset($result[0]['COUNT(*)']) && ($result[0]['COUNT(*)'])) {
            return false;
        }
        return true;
    }

    function delete($id = NULL) {
        return $this->db->delete('user_account', array('id' => $id));
    }

    function update($data = array(), $condition = array()) {
        $this->db->where($condition);
        return $this->db->update('user_account', $data);
    }

    function edit($data = NULL) {
        $this->db->where('email', $data['email']);
        return $this->db->update('user_account', array('forgot_password_link' => $data['unique_string']));
    }

    function reset_password($data = NULL) {
        $this->db->where('forgot_password_link', $data['link']);
        return $this->db->update('user_account', array('password' => md5($data['password'])));
    }

}

?>
