<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Kliklikes</title>
        <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

            <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.9.1.min.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.simpleSlider.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>js/ajaxupload.3.5.js"></script>


            <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.jcarousel.min.js"></script>
            <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/skin.css">
                <script type="text/javascript" src="<?php echo base_url(); ?>js/photo.js"></script>
                <script type="text/javascript">
                    function get_base_url() {
                        return '<?php echo base_url(); ?>';
                    }
                </script>
                </head>

                <body>
                    <div class="wrapper">
                        <div class="top-header">
                            <div class="serach-wrap">
                                <input class="input" type="text" placeholder="Search for Friends, Photos and Tournaments" />
                                <input type="button" class="submit"/></div>
                            <div class="social-wrap">
                                Get your photos<br />liked by your friends!
                            </div>
                            <div class="top-nav">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>index.php/user/index/">Home</a></li>
                                    <li><a href="<?php echo base_url(); ?>index.php/user/index/">My Account</a></li>
                                    <?php
                                    $userinfo = array();
                                    $userinfo = $this->session->userdata('userinfo');
                                    if (isset($userinfo['id']) && ($userinfo['id'])) {
                                        ?>

                                        <li><a href="<?php echo base_url(); ?>index.php/user/logout/">Log Out</a></li>
                                    <?php } else { ?>
                                        <li><a href="<?php echo base_url(); ?>index.php/user/login/">Sign-in</a></li>
                                        <li><a href="<?php echo base_url(); ?>index.php/user/registration/">Registration</a></li>
                                    <?php } ?>

                                </ul>
                            </div>
                        </div>
                        <div class="content-wrap">

