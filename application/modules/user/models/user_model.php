<?php

class User_model extends CI_Model {

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

        return $this->db->insert('user_account', $user_data);
    }

    function get($data = array()) {
        $row = $this->db->query("SELECT * FROM user_account WHERE username='" . $data['username'] . "' AND  password='" . md5($data['password']) . "'");
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

    function delete($id = NULL) {
        return $this->db->delete('user_account', array('id' => $id));
    }

    function edit($id = NULL) {
        $data = array(
            'title' => $title,
            'name' => $name,
            'date' => $date
        );

        $this->db->where('id', $id);
        $this->db->update('user_account', $data);
    }

}

?>
