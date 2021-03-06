<?php

class AdminUserLogs_model extends CI_Model {
    function getAdmin($where = NULL) {
        $table = "admin";
        if ($where !== NULL) {
            $this->db->where($where);
        }
        $query = $this->db->get($table);
        return ($query->num_rows() > 0) ? $query->result() : false;
    }
    
    function getUserLogs(){
        $table = "log";
        $this->db->join("user", "log.user_id = user.user_id", "OUTER JOIN");
        $this->db->where(array('log_type' => 'log'));
        $query = $this->db->get($table);
        return ($query->num_rows() > 0) ? $query->result() : false;
    }

    
}