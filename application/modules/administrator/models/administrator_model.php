<?php

class Administrator_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function save($data = array()) {
        $user_data = array(
            'fname' => isset($data['fname']) && ($data['fname']) ? $data['fname'] : NULL,
            'lname' => isset($data['lname']) && ($data['lname']) ? $data['lname'] : NULL,
            'username' => isset($data['username']) && ($data['username']) ? $data['username'] : NULL,
            'email' => isset($data['email']) && ($data['email']) ? $data['email'] : NULL,
            'password' => isset($data['password']) && ($data['password']) ? md5($data['password']) : NULL,
            'is_admin' => isset($data['is_admin']) && ($data['is_admin']) ? $data['is_admin'] : '',
            'gender' => isset($data['gender']) && ($data['gender']) ? $data['gender'] : '',
            'create' => time(),
            'image' => '',
        );

        return $this->db->insert('user_account', $user_data);
    }

    function duplicate_account_check($data = array()) {
        $row = $this->db->query("SELECT COUNT(*) FROM user_account WHERE username='" . $data['username'] . "' AND  email='" . $data['email'] . "'");
        $result = $row->result_array();
        if (isset($result[0]['COUNT(*)']) && ($result[0]['COUNT(*)'])) {
            return false;
        }
        return true;
    }

    function get($data = array()) {
        $row = $this->db->query("SELECT * FROM user_account WHERE username='" . $data['username'] . "' AND  password='" . md5($data['password']) . "'");
        $result = $row->result_array();
        return $result[0];
    }
    
    function get_user_info($id=NULL) {
        $row = $this->db->query("SELECT * FROM user_account WHERE id='" . $id . "'");
        $result = $row->result_array();
        return $result[0];
    }

    function get_user_list() {
        $row = $this->db->query("SELECT * FROM user_account");
        $result = $row->result_array();
        return $result;
    }

    function authentication($data = array()) {
        $row = $this->db->query("SELECT COUNT(*) FROM user_account WHERE username='" . $data['username'] . "' AND  password='" . md5($data['password']) . "'");
        $result = $row->result_array();
        if (isset($result[0]['COUNT(*)']) && ($result[0]['COUNT(*)'])) {
            return true;
        }
        return false;
    }

    function delete($id = NULL) {
        return $this->db->delete('user_account', array('id' => $id));
    }

    function edit($id = NULL,$data=array()) {
        $user_data = array(
            'fname' => isset($data['fname']) && ($data['fname']) ? $data['fname'] : NULL,
            'lname' => isset($data['lname']) && ($data['lname']) ? $data['lname'] : NULL,
            'username' => isset($data['username']) && ($data['username']) ? $data['username'] : NULL,
            'email' => isset($data['email']) && ($data['email']) ? $data['email'] : NULL,
            'password' => isset($data['password']) && ($data['password']) ? md5($data['password']) : NULL,
            'is_admin' => isset($data['is_admin']) && ($data['is_admin']) ? $data['is_admin'] : '',
            'gender' => isset($data['gender']) && ($data['gender']) ? $data['gender'] : '',
            'create' => time(),
            'image' => '',
        );

        $this->db->where('id', $id);
        $this->db->update('user_account', $user_data);
    }

}

?>
