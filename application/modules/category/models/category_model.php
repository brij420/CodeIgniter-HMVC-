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
            'description' => isset($data['description']) && ($data['description']) ? $data['description'] : NULL,
            'fees' => isset($data['fees']) && ($data['fees']) ? $data['fees'] : NULL,
            'start_date' => isset($data['start_date']) && ($data['start_date']) ? $data['start_date'] : NULL,
            'start_vote_date' => isset($data['start_vote_date']) && ($data['start_vote_date']) ? $data['start_vote_date'] : NULL,
            'end_date' => isset($data['end_date']) && ($data['end_date']) ? $data['end_date'] : NULL,
            'start_hour' => isset($data['start_hour']) && ($data['start_hour']) ? $data['start_hour'] : '',
            'end_hour' => isset($data['end_hour']) && ($data['end_hour']) ? $data['end_hour'] : '',
            'fprize' => isset($data['fprize']) && ($data['fprize']) ? $data['fprize'] : '',
            'sprize' => isset($data['sprize']) && ($data['sprize']) ? $data['sprize'] : '',
            'tprize' => isset($data['tprize']) && ($data['tprize']) ? $data['tprize'] : '',
            'four_prize' => isset($data['four_prize']) && ($data['four_prize']) ? $data['four_prize'] : '',
            'fifth_prize' => isset($data['fifth_prize']) && ($data['fifth_prize']) ? $data['fifth_prize'] : '',
            'six_prize' => isset($data['six_prize']) && ($data['six_prize']) ? $data['six_prize'] : '',
            'seven_prize' => isset($data['seven_prize']) && ($data['seven_prize']) ? $data['seven_prize'] : '',
            'eight_prize' => isset($data['eight_prize']) && ($data['eight_prize']) ? $data['eight_prize'] : '',
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
        return isset($result[0]) && ($result[0]) ? $result[0] : NULL;
    }

    function get_tournament_info($id = NULL) {
        $row = $this->db->query("SELECT sub_categories.*,categories.name as catagory_name,join_tournaments.id as is_joined FROM sub_categories LEFT JOIN categories ON(sub_categories.cat_id=categories.id) LEFT JOIN join_tournaments ON(sub_categories.id=join_tournaments.subcategory_id) LEFT JOIN tournaments ON(sub_categories.id=tournaments.subcategory_id) WHERE sub_categories.id='" . $id . "'");
        $result = $row->result_array();
        return isset($result[0]) && ($result[0]) ? $result[0] : NULL;
    }

    function get_tournament_photos($id = NULL) {
        $row = $this->db->query("SELECT photo.*,user_account.username FROM photo INNER JOIN user_account ON(photo.user_id=user_account.id) WHERE photo.sub_cat_id='" . $id . "'");
        $result = $row->result_array();
        return isset($result) && ($result) ? $result : NULL;
    }

    function join_tournament($id = NULL, $user_id = NULL) {
        $join_tournament = array(
            'subcategory_id' => $id,
            'user_id' => $user_id,
            'date' => time()
        );

        if ($this->duplicate_join_tournaments_check($id, $user_id)) {
            return $this->db->insert('join_tournaments', $join_tournament);
        }
        return FALSE;
    }

    function duplicate_join_tournaments_check($id = NULL, $user_id = NULL) {
        $row = $this->db->query("SELECT COUNT(*) FROM join_tournaments WHERE subcategory_id='" . $id . "' AND user_id='" . $user_id . "'");
        $result = $row->result_array();
        if (isset($result[0]['COUNT(*)']) && ($result[0]['COUNT(*)'])) {
            return false;
        }
        return true;
    }

    function get_sub_category($cat_id = NULL) {
        if ($cat_id) {
            $row = $this->db->query("SELECT * FROM sub_categories WHERE cat_id='" . $cat_id . "'");
        } else {

            $row = $this->db->query("SELECT * FROM sub_categories");
        }
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

    function save_winner($user_id = NULL, $image_id = NULL, $sub_cat_id = NULL) {
        $winner = array(
            'user_id' => $user_id,
            'photo_id' => $image_id,
            'sub_cat_id' => $sub_cat_id,
            'date' => time()
        );

        return $this->db->insert('winner', $winner);
    }

    function duplicate_winner_check($user_id = NULL, $image_id = NULL, $sub_cat_id = NULL) {
        $row = $this->db->query("SELECT COUNT(*) FROM winner WHERE user_id='" . $user_id . "' AND photo_id='" . $image_id . "' AND sub_cat_id='" . $sub_cat_id . "'");
        $result = $row->result_array();
        if (isset($result[0]['COUNT(*)']) && ($result[0]['COUNT(*)'])) {
            return false;
        }
        return true;
    }

    function delete($id = NULL) {
        $this->db->delete('sub_categories', array('cat_id' => $id));
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
            'description' => isset($data['description']) && ($data['description']) ? $data['description'] : NULL,
            'fees' => isset($data['fees']) && ($data['fees']) ? $data['fees'] : NULL,
            'start_date' => isset($data['start_date']) && ($data['start_date']) ? $data['start_date'] : NULL,
            'start_vote_date' => isset($data['start_vote_date']) && ($data['start_vote_date']) ? $data['start_vote_date'] : NULL,
            'end_date' => isset($data['end_date']) && ($data['end_date']) ? $data['end_date'] : NULL,
            'start_hour' => isset($data['start_hour']) && ($data['start_hour']) ? $data['start_hour'] : '',
            'end_hour' => isset($data['end_hour']) && ($data['end_hour']) ? $data['end_hour'] : '',
            'fprize' => isset($data['fprize']) && ($data['fprize']) ? $data['fprize'] : '',
            'sprize' => isset($data['sprize']) && ($data['sprize']) ? $data['sprize'] : '',
            'tprize' => isset($data['tprize']) && ($data['tprize']) ? $data['tprize'] : '',
            'four_prize' => isset($data['four_prize']) && ($data['four_prize']) ? $data['four_prize'] : '',
            'fifth_prize' => isset($data['fifth_prize']) && ($data['fifth_prize']) ? $data['fifth_prize'] : '',
            'six_prize' => isset($data['six_prize']) && ($data['six_prize']) ? $data['six_prize'] : '',
            'seven_prize' => isset($data['seven_prize']) && ($data['seven_prize']) ? $data['seven_prize'] : '',
            'eight_prize' => isset($data['eight_prize']) && ($data['eight_prize']) ? $data['eight_prize'] : '',
            'date' => time()
        );
        $this->db->where('id', $id);
        return $this->db->update('sub_categories', $subcategories);
    }

}

?>
