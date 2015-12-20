<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Designer Tool Admin</title>

        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <?php
        $this->load->view('includes/header-files.php');
        ?>

    </head>
    <body class="hold-transition skin-green sidebar-mini">
        <div class="wrapper">


            <?php
            $this->load->view('includes/header.php');
            $this->load->view('includes/side-bar.php');

            $id = 0;
            $TITLE = '';
            $PRICE = '';
            $IMAGE = '';
            $TEXT_COLOR = '';
            $TEXT_FONT = '';
            $PRINT_WIDTH = '';
            $PRINT_HEIGHT = '';
            $PUBLISH_STATUS = 0;
            $submit_btn_text = 'Add';

            if (isset($result)) {
                extract($result[0]);
                $submit_btn_text = 'Update';
            }
            ?>

            <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        Add Template
                        <!--<small>Optional description</small>-->
                    </h1>
                    <?php
                    $this->load->view('includes/breadcrumb.php');
                    ?>
                </section>

                <section class="content">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Create New Template</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal" 
                              action="<?= site_url('templates/save') ?>" 
                              accept-charset="utf-8" 
                              enctype="multipart/form-data" 
                              method="POST">
                            <!--name="template_add"-->
                            <input type="hidden" name="record_id" id="record_id" value="<?php echo $id; ?>" />

                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="">Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" 
                                               name="TITLE"
                                               placeholder="Title" 
                                               value="<?= $TITLE ?>"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="">PRICE</label>
                                    <div class="col-sm-10">
                                        <input type="text" 
                                               name="PRICE"
                                               placeholder="PRICE" 
                                               value="<?= $PRICE ?>"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="">Image</label>
                                    <div class="col-sm-10">
                                        <input type="file" id="" name="IMAGE" />
                                        <?php
                                        if ($IMAGE != "") {
                                            echo "<img src='$IMAGE' class='thumb-size-big' />";
                                        }
                                        ?>	
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="">Text Color</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="TEXT_COLOR">
                                            <option>option 1</option>
                                            <option>option 2</option>
                                            <option>option 3</option>
                                            <option>option 4</option>
                                            <option>option 5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="">Text Font</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="TEXT_FONT">
                                            <option>option 1</option>
                                            <option>option 2</option>
                                            <option>option 3</option>
                                            <option>option 4</option>
                                            <option>option 5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="">PRINT_WIDTH</label>
                                    <div class="col-sm-10">
                                        <input type="text" 
                                               name="PRINT_WIDTH"
                                               placeholder="PRINT_WIDTH" 
                                               value="<?= $PRINT_WIDTH ?>"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="">PRINT_HEIGHT</label>
                                    <div class="col-sm-10">
                                        <input type="text" 
                                               name="PRINT_HEIGHT"
                                               placeholder="PRINT_HEIGHT" 
                                               value="<?= $PRINT_HEIGHT ?>"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="">PUBLISH_STATUS</label>
                                    <div class="col-sm-10">
                                        <input type="checkbox" value="1" name="PUBLISH_STATUS" <?php echo ($PUBLISH_STATUS != 0) ? 'checked' : ''; ?>>
                                    </div>
                                </div>

                            </div>
                            <div class="box-footer">
                                <button class="btn btn-default" type="reset">Cancel</button>
                                <button class="btn btn-primary" type="submit" name="submit" value="<?= $submit_btn_text ?>" ><?= $submit_btn_text ?></button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>


            <?php
            $this->load->view('includes/footer.php');
            $this->load->view('includes/right-bar.php');
            $this->load->view('includes/footer-files.php');
            ?>


        </div>
    </body>
</html>
