<?php

class Image_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function save($image = NULL, $user_id = NULL) {
        $images = array(
            'images' => isset($image) && ($image) ? $image : '',
            'user_id' => isset($user_id) && ($user_id) ? $user_id : '',
            'create' => time()
        );

        return $this->db->insert('images', $images);
    }

    function save_image($image = NULL, $data = array()) {
        $images = array(
            'id' => '',
            'image' => isset($image) && ($image) ? $image : '',
            'user_id' => isset($data['user_id']) && ($data['user_id']) ? $data['user_id'] : '',
            'cat_id' => isset($data['select_category']) && ($data['select_category']) ? $data['select_category'] : '',
            'sub_cat_id' => isset($data['select_subcategory']) && ($data['select_subcategory']) ? $data['select_subcategory'] : '',
            'thumb' => '',
            'date' => time()
        );

        return $this->db->insert('photo', $images);
    }

    function save_profile_image($image = NULL, $data = array()) {
        $images = array(
            'id' => '',
            'images' => isset($image) && ($image) ? $image : '',
            'user_id' => isset($data['user_id']) && ($data['user_id']) ? $data['user_id'] : '',
            'create' => time()
        );

        return $this->db->insert('images', $images);
    }

    function save_image_tournament($image_id = NULL, $data = array()) {
        $images = array(
            'id' => '',
            'image_id' => isset($image_id) && ($image_id) ? $image_id : '',
            'user_id' => isset($data['user_id']) && ($data['user_id']) ? $data['user_id'] : '',
            'subcategory_id' => isset($data['select_subcategory']) && ($data['select_subcategory']) ? $data['select_category'] : '',
            'create' => time()
        );

        return $this->db->insert('tournaments', $images);
    }

    function get_image_list($id = NULL) {
        $row = $this->db->query("SELECT photo.*,sub_categories.name as sub_category_name,user_account.id as userId,user_account.username as userName,winner.photo_id as is_winner FROM photo LEFT JOIN sub_categories ON(photo.sub_cat_id=sub_categories.id) LEFT JOIN user_account ON(photo.user_id=user_account.id) LEFT JOIN winner ON (photo.id=winner.photo_id) WHERE photo.cat_id='" . $id . "'");
        $result = $row->result_array();
        return $result;
    }

    function get_images($user_id = NULL) {
        if (isset($user_id) && ($user_id)) {
            //$row = $this->db->query("SELECT photo.*,sub_categories.name as sub_category_name,categories.name as category_name FROM photo LEFT JOIN sub_categories ON(photo.sub_cat_id=sub_categories.id) LEFT JOIN categories ON(photo.cat_id=categories.id) WHERE photo.user_id='" . $user_id . "'");
            $row = $this->db->query("SELECT * FROM images WHERE images.user_id='" . $user_id . "'");
        }
        $result = $row->result_array();
        return $result;
    }

    function delete_profile_image($id = NULL) {
        return $this->db->delete('images', array('id' => $id));
    }

    function delete_tournament_image($id = NULL) {
        return $this->db->delete('photo', array('id' => $id));
    }

    function get_image_details($id = NULL) {
        $row = $this->db->query("SELECT photo.*,categories.name as category_name,sub_categories.name as sub_category_name FROM photo  LEFT JOIN categories ON(photo.cat_id=categories.id) LEFT JOIN sub_categories ON(photo.sub_cat_id=sub_categories.id) WHERE photo.id='" . $id . "'");
        $result = $row->result_array();

        return isset($result[0]) && ($result[0]) ? $result[0] : NULL;
    }

}

?>
