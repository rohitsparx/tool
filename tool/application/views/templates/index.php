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
        $source = dirname(__FILE__);
        $view_path = $this->config->item("view_path");
        $this->load->view('includes/header-files.php');
        ?>

    </head>
    <body class="hold-transition skin-green sidebar-mini">
        <div class="wrapper">


            <?php
            $this->load->view('includes/header.php');
            $this->load->view('includes/side-bar.php');
            ?>

            <div class="content-wrapper">

                <?php
                $this->load->view('templates/insert-success.php');
                ?>

                <section class="content-header">
                    <h1>
                        Manage Templates
                        <!--<small>Optional description</small>-->
                    </h1>
                    <?php
                    $this->load->view('includes/breadcrumb.php');
                    ?>
                </section>

                <section class="content">

                    <div class="box data-table">
                        <div class="box-header">
                            <h3 class="box-title">Templates -
                                <a href="<?= site_url('templates/add') ?>" class="btn bg-olive">Add New</a>
                            </h3>
                        </div>


                        <div class="box-body">
                            <?php
                            $this->load->view('templates/list-table.php');
//                            include_once $source.'/list-table.php';
                            ?>
                        </div>
                    </div><!-- /.box -->

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
