<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Navigation extends CI_Model {

    public $totalRows = NULL;
    public $resultSet = NULL;
    private $table = 'navigation';

    function __construct() {
        parent::__construct();
    }

    public function getAllModules($orderBy = array()) {
        if ($this->totalRows != NULL && $total == TRUE) {
            return $this->totalRows;
        }
        //ID 	NAME 	HEADINGNAME 	DISPLAYNAME 	MODULE_PID 	DISPLAY_ORDER
        /*
          $this->db->select("*");
          $this->db->from($this->table);
          if(sizeof($orderBy)==0) {
          $orderBy['orderBy'] = 'DISPLAY_ORDER';
          $orderBy['orderWay'] = 'DESC';
          }
          $this->db->order_by($orderBy['orderBy'], $orderBy['orderWay']);
          $query = $this->db->get();
         */
        $query = $this->db_me->query("select * from navigation as g where MODULE_PID = 0
				union all
				select l.*
				from navigation r 
				left join (select * from navigation) as l on r.ID = l.ID
				where
				r.MODULE_PID != 0");
        $result = $query->result_array();
        $this->resultSet = $result;
        return $result;
    }

    public function getAllModulesTree($current = 0) {
        $order['orderBy'] = "ID";
        $order['orderWay'] = "ASC";
        $modules_array = array();
        $modules = $this->getAllModules($order);
        //$this->console->log($modules);
        $parent_array = array();
        foreach ($modules as $key => $val) {
            //	$this->console->log((int)$val["MODULE_PID"]);
            if ((int) $val["MODULE_PID"] == 0) {
                $modules_array["module_$val[ID]"] = $val;
                $parent_array[] = $val["ID"];
            } else {
                if (in_array($val["MODULE_PID"], $parent_array)) {
                    if (!isset($modules_array["module_$val[MODULE_PID]"]["child"])) {
                        $modules_array["module_$val[MODULE_PID]"]["child"] = array();
                    }
                    $modules_array["module_$val[MODULE_PID]"]["child"][] = $val;
                    //$modules_array["module_$val[MODULE_PID]"];										
                }
            }
        }
        //$this->console->log($modules_array);	
        return $modules_array;
    }

    public function getModulesAsComboArray($orderBy = array()) {
        $arr = $this->getAllModules($orderBy);
        $comboArray = array();
        foreach ($arr as $row) {
            if ($row['ID'] != 0) {
                $comboArray["$row[ID]"] = $row['DISPLAYNAME'];
            }
        }
        return $comboArray;
    }

    function __destruct() {
        
    }

}

?>