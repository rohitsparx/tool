<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function build_table($array, $me) {
    $html = '<table class="table js_data_table table-bordered table-striped">';
    // header row
    $html .= '<thead><tr>';
    foreach ($array[0] as $key => $value) {
        $html .= '<th>' . $key . '</th>';
    }
    $html .= '<th>' . 'Actions' . '</th>';
    $html .= '</tr><thead><tbody>';

    // data rows
    foreach ($array as $key => $value) {
        $html .= '<tr>';
        foreach ($value as $key2 => $value2) {
            $html .= '<td>' . getCellData($key2, $value2, $me) . '</td>';
        }
        
//        print_r('<pre>');
//        print_r($value);
//        print_r('</pre>');

        $html .= '<td>';
        $html .= '<div class="tools">' .
                '<a href="' . site_url('templates/edit/'.$value['id']) . '" title="Edit" class="fa fa-edit"></a>' .
                '<a href="' . site_url('templates/delete/'.$value['id']) . '"title="Delete" class="fa fa-trash-o"></a>' .
                '</div>';
        $html .= '</td>';

        $html .= '</tr>';
    }


    $html .= '</tbody></table>';
    return $html;
}

function getCellData($key, $value, $me) {
    $imagesFields = $me->{$me->module_name . '_model'}->imagesFields;

    if (isset($imagesFields[$key])) {
        $str = '<img class="thumb-size" src="' . $value . '" />';
        return $str;
    }
    return $value;
}

echo build_table($allData, $this);
?>