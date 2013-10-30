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

    function get_image_list($id = NULL) {
        $row = $this->db->query("SELECT photo.*,sub_categories.name as sub_category_name FROM photo LEFT JOIN sub_categories ON(photo.sub_cat_id=sub_categories.id) WHERE photo.cat_id='" . $id . "'");
        $result = $row->result_array();
        return $result;
    }

    function get_image_details($id = NULL) {
        $row = $this->db->query("SELECT photo.*,categories.name as category_name,sub_categories.name as sub_category_name FROM photo  LEFT JOIN categories ON(photo.cat_id=categories.id) LEFT JOIN sub_categories ON(photo.sub_cat_id=sub_categories.id) WHERE photo.id='" . $id . "'");
        $result = $row->result_array();

        return isset($result[0]) && ($result[0]) ? $result[0] : NULL;
    }

}

?>
