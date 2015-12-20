<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Templates extends CI_Controller {

    public $module_name = 'templates';

    public function __construct() {
        parent::__construct();
        $this->load->model($this->module_name . '_model');
        $this->load->helper(array('form', 'url'));
    }

    public function index() {
        $allData = $this->{$this->module_name . '_model'}->getAllData();
        $params['allData'] = $allData;
//        print_r($allData);
//        foreach ($allData as $row) {
//            echo $row->TITLE;
//        }
        $this->load->view('templates/index', $params);
    }

    public function add() {
        $this->load->view('templates/add-edit-form');
    }

    public function edit($id = 0) {
        $result = $this->{$this->module_name . '_model'}->getById($id);
        $params['ID'] = $id;
        $params['result'] = $result;
        $params['module_name'] = $this->module_name;
//        print_r('<pre> ');
//        print_r($result);
//        print_r('</pre>');
        $this->load->view('templates/add-edit-form', $params);
    }

    public function delete($id = 0) {
        $idDeleted = $this->{$this->module_name . '_model'}->deleteById($id);
//        exit;
        redirect('templates/index');
    }

    public function save() {

        $postData = $this->input->post();

        $saveData['TITLE'] = $postData['TITLE'];
        $saveData['PRICE'] = $postData['PRICE'];
        $saveData['TEXT_COLOR'] = $postData['TEXT_COLOR'];
        $saveData['TEXT_FONT'] = $postData['TEXT_FONT'];
        $saveData['PRINT_WIDTH'] = $postData['PRINT_WIDTH'];
        $saveData['PRINT_HEIGHT'] = $postData['PRINT_HEIGHT'];
        if (isset($postData['PUBLISH_STATUS'])) {
            $saveData['PUBLISH_STATUS'] = $postData['PUBLISH_STATUS'];
        }
        $saveData['update_date'] = date("Y-m-d H:i:s");
        $uploadedPath = $this->{$this->module_name . '_model'}->uploadImg('IMAGE');
        if (strlen($uploadedPath) > 0) {
            $saveData['IMAGE'] = $uploadedPath;
        } else {
            
        }

//        echo "rohit - - ".strlen($uploadedPath);

        if ($postData["record_id"]) {
//            echo $postData["record_id"];
            $this->{$this->module_name . '_model'}->updateById($postData["record_id"], $saveData);
//            print_r('<pre> ');
//            print_r($saveData);
//            print_r('</pre>');
            $isSaved = 1;
        } else {
            $saveData['insert_date'] = date("Y-m-d H:i:s");
            $isSaved = $this->{$this->module_name . '_model'}->insert($saveData);
        }


        $success = ($isSaved > 0) ? TRUE : FALSE;
        if ($isSaved) {
            $params['success'] = $success;
            $session_arr['template_row'] = $isSaved;
            $session_arr['template_action'] = "Inserted";
            if ($postData["record_id"]) {
                $session_arr['template_action'] = "Updated";
            }
            $this->session->set_userdata($session_arr);
        } else {
            print_r('<pre> Some Error Occured');
            print_r($saveData);
            print_r('</pre>');
        }

//        exit;
        redirect('templates/index');
    }

    public function publishtoggle($id = 0, $status) {
        if ($id == 0) {
            $result = "";
        } else {
            $result = $this->{$this->module_name . '_model'}->publishtoggle($id, $status);
        }
        echo $result;
    }

}
