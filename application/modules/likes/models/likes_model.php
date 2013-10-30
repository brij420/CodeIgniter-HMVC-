<?php

class Likes_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function save($id = NULL) {
        $userinfo = array();
        $userinfo = $this->session->userdata('userinfo');
        if ($this->like_check($id, $userinfo['id'])) {
            $user_data = array(
                'user_id' => isset($userinfo['id']) && ($userinfo['id']) ? $userinfo['id'] : NULL,
                'photo_id' => isset($id) && ($id) ? $id : NULL,
                'date' => time()
            );
            return $this->db->insert('like', $user_data);
        }

        return FALSE;
    }

    function like_check($photo_id = NULL, $user_id = NULL) {
        $row = $this->db->query("SELECT COUNT(*) FROM `like` WHERE photo_id='" . $photo_id . "' AND user_id='" . $user_id . "'");
        $result = $row->result_array();
        if (isset($result[0]['COUNT(*)']) && (!$result[0]['COUNT(*)'])) {
            return TRUE;
        }
        return FALSE;
    }

    function get_liked_user_list($id = NULL) {
        $row = $this->db->query("SELECT user_account.username FROM `like` LEFT JOIN user_account ON (`like`.`user_id`=`user_account`.`id`)WHERE `like`.`photo_id`='" . $id . "'");
        $result = $row->result_array();
        return $result;
    }

    function get_image_likes_count($id = NULL) {
        $row = $this->db->query("SELECT COUNT(*) FROM `like` WHERE photo_id='" . $id . "'");
        $result = $row->result_array();
        return isset($result[0]['COUNT(*)']) && ($result[0]['COUNT(*)']) ? $result[0]['COUNT(*)'] : 0;
    }

}

?>
