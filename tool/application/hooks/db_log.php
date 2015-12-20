<?php
// Name of Class as mentioned in $hook['post_controller]
class Db_log {

    function __construct() {
        
    }

    // Name of function same as mentioned in Hooks Config
//    function logQueries() {
//        $CI = & get_instance();
//        $times = $CI->db->query_times;                   // Get execution time of all the queries executed by controller
//        foreach ($CI->db->queries as $key => $query) {
//            $data = array(
//                'query' => $query,
//                'time' => date("Y-m-d H:i:s"),
//                'execution_time' => $times[$key]
//            );
//            $CI->db->insert('logs', $data);
//            print_r('<pre>');
//            print_r($data);
//            print_r('</pre>');
//        }
////        exit;
//    }

}
?>
