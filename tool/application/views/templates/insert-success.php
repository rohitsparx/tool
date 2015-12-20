<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if ($rowNum = $this->session->userdata('template_row')) {
    $action = $this->session->userdata('template_action');
    $this->session->unset_userdata('template_row');
    $this->session->unset_userdata('template_action');
    ?>
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">
                Data Successfully <?= $action ?>.
                <!--Data successfully inserted at row - <?= $rowNum ?>-->
            </h3>
            <div class="box-tools pull-right">
                <button data-widget="remove" class="btn btn-box-tool"><i class="fa fa-times"></i></button>
            </div>
        </div>
    </div>
    <?php
}?>