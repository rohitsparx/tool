<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class DB_Me extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function logQueries() {
        $CI = & get_instance();
        $times = $CI->db->query_times;                   // Get execution time of all the queries executed by controller
        foreach ($CI->db->queries as $key => $query) {
            $data = array(
                'query' => $query,
                'time' => date("Y-m-d H:i:s"),
                'execution_time' => $times[$key]
            );
            $CI->db->insert('logs', $data);
//            print_r('<pre>');
//            print_r($data);
//            print_r('</pre>');
        }
    }

//    public function insert($str) {
//        $this->logQueries();
//        return $this->db->insert($str);
//    }

    public function query($query) {
        $this->logQueries();
        return $this->db->query($query);
    }

    function __destruct() {
        
    }

}

?>