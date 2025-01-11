<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function insertData($tableName, $data){
        return $this->db->insert($tableName, $data);
    }

    public function getUserByIdentifier($identifier) {

        $this->db->where('email', $identifier);
        $this->db->or_where('username', $identifier);
        $data = $this->db->get('users')->row_array();

        if (!empty($data)) {
            return $data;
        }
        return false;
    }
}
