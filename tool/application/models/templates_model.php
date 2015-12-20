<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Templates_model extends CI_Model {

    public $table = 'templates';
    // fields
    public $fields = array('id', 'Title', 'Price', 'Image', 'PUBLISH_STATUS');
    public $orderBy = "id DESC";
    public $where = array("status" => '1');
    public $id_field = "id";
    public $imagesFields = array("Image" => array("width" => 40, "height" => 40));
    //join
    public $join = array(
    );

    function __construct() {
        parent::__construct();
    }

    public function insert($data = array()) {
        $this->db->set($data);
        $this->db->insert($this->table);
        return $this->db->insert_id();
    }

    public function getAllData() {
        $this->db->select($this->fields);
        $this->db->from($this->table);
        $this->db->where($this->where);
        $this->db->order_by($this->orderBy);

        return $this->db->get()->result_array();
    }

    public function updateById($id = 0, $data) {
        $this->db->where($this->id_field, $id);
        $this->db->update($this->table, $data);
    }

    public function getById($id = 0) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where(array($this->id_field => $id));
        return $this->db->get()->result_array();
    }

    public function deleteById($id = 0) {
        $this->db->where($this->id_field, $id);
        $this->db->update($this->table, array("status" => '0'));
    }

    function uploadImg($file = '', $rowID = 0) {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = "gif|jpg|png|jpeg";
        $config['overwrite'] = false;
        $config['max_size'] = '20480000'; // 20 MB
        $config['max_width'] = '5000';
        $config['max_height'] = '5000';

        $this->load->library('upload', $config);
        $this->upload->initialize($config); //Make this line must be here.

        if (!$this->upload->do_upload($file)) {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
            return '';
        } else {
            $data = $this->upload->data();
            $path = base_url() . $config['upload_path'] . $data['file_name'];
//            print_r($data);
            return $path;
        }
    }

    public function publishtoggle($id, $status) {
        $data = array(
            'publish_status' => $status
        );
        $this->db->where($this->id_field, $id);
        $res = $this->db->update($this->table, $data);
        return $res;
    }

}

?>