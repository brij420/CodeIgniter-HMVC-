<?php

class Comment_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function save($data = array()) {
        $userinfo = array();
        $userinfo = $this->session->userdata('userinfo');
        $comment_data = array(
            'user_id' => isset($userinfo['id']) && ($userinfo['id']) ? $userinfo['id'] : NULL,
            'photo_id' => isset($data['photo_id']) && ($data['photo_id']) ? $data['photo_id'] : NULL,
            'sub' => isset($data['subject']) && ($data['subject']) ? $data['subject'] : NULL,
            'description' => isset($data['description']) && ($data['description']) ? $data['description'] : NULL,
            'date' => time()
        );

        return $this->db->insert('comment', $comment_data);
    }

    function get_all_comments($id) {
        $row = $this->db->query("SELECT comment.*,user_account.username FROM comment LEFT JOIN user_account ON(comment.user_id=user_account.id) WHERE photo_id='" . $id . "'");
        $result = $row->result_array();
        return $result;
    }

    function get_sub_category() {
        $row = $this->db->query("SELECT * FROM sub_categories");
        $result = $row->result_array();
        return $result;
    }

    function authentication($data = array()) {
        $row = $this->db->query("SELECT COUNT(*) FROM comment WHERE username='" . $data['username'] . "' AND  password='" . md5($data['password']) . "'");
        $result = $row->result_array();
        if (isset($result[0]['COUNT(*)']) && ($result[0]['COUNT(*)'])) {
            return true;
        }
        return false;
    }

    function delete($id = NULL) {
        return $this->db->delete('comment', array('id' => $id));
    }

    function edit($id = NULL) {
        $data = array(
            'title' => $title,
            'name' => $name,
            'date' => $date
        );

        $this->db->where('id', $id);
        $this->db->update('comment', $data);
    }

}

?>
