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
            ?>

            <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        Hi, this is dashboard
                        <small>Select Category from left menu</small>
                    </h1>
                    <?php
                    $this->load->view('includes/breadcrumb.php');
                    ?>
                </section>

                <section class="content">
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
