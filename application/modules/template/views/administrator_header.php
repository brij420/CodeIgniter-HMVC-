<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Internet Dreams</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/screen.css" type="text/css" media="screen" title="default" />
        <!--  date picker script -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/datePicker.css" type="text/css" />
        <link class="cssdeck" rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
            <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-responsive.min.css" class="cssdeck"></link>
            <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" class="cssdeck"></link>
            <script src="<?php echo base_url(); ?>js/jquery-1.9.1.min.js" type="text/javascript"></script>
            <script src="<?php echo base_url(); ?>js/jquery/date.js" type="text/javascript"></script>
            <script src="<?php echo base_url(); ?>js/jquery/jquery.datePicker.js" type="text/javascript"></script>
            <script src="<?php echo base_url(); ?>js/global.js" type="text/javascript"></script>
            <script type="text/javascript">
                function get_base_url() {
                    return '<?php echo base_url(); ?>';
                }
            </script>


    </head>
    <body> 
        <!-- Start: page-top-outer -->
        <div id="page-top-outer">    

            <!-- Start: page-top -->
            <div id="page-top">



                <div class="clear"></div>

            </div>
            <!-- End: page-top -->

        </div>
        <!-- End: page-top-outer -->

        <div class="clear">&nbsp;</div>

        <!--  start nav-outer-repeat................................................................................................. START -->
        <div class="nav-outer-repeat"> 
            <!--  start nav-outer -->
            <div class="nav-outer"> 

                <!-- start nav-right -->
                <div id="nav-right">

                    <div class="nav-divider">&nbsp;</div>

                    <a href="<?php echo base_url();?>index.php/administrator/logout" id="logout"><img src="<?php echo base_url(); ?>images/shared/nav/nav_logout.gif" width="64" height="14" alt="" /></a>
                    <div class="clear">&nbsp;</div>



                </div>
                <!-- end nav-right -->


                <!--  start nav -->
                <div class="nav">
                    <div class="table">

                        <ul class="<?php if(isset($admin) && ($admin))echo $admin; else echo 'select'?>" ><li><a href="<?php echo base_url();?>index.php/administrator/administrator/user_list"><b>User's List</b><!--[if IE 7]><!--></a><!--<![endif]-->

                            </li>
                        </ul>

                        <div class="nav-divider">&nbsp;</div>

                        <ul class="<?php if(isset($category) &&($category))echo $category; else echo 'select'?>" ><li><a href="<?php echo base_url();?>index.php/category/category/category_list"><b>Categories</b><!--[if IE 7]><!--></a><!--<![endif]-->

                            </li>
                        </ul>

                        <div class="nav-divider">&nbsp;</div>

                        <div class="nav-divider">&nbsp;</div>

                        <ul class="<?php if(isset($subcategory) &&($subcategory))echo $subcategory; else echo 'select'?>" ><li><a href="<?php echo base_url();?>index.php/category/category/subcategory_list"><b>SubCategories</b><!--[if IE 7]><!--></a><!--<![endif]-->

                            </li>
                        </ul>

                        <div class="nav-divider">&nbsp;</div>



                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <!--  start nav -->

            </div>
            <div class="clear"></div>
            <!--  start nav-outer -->
        </div>
        <!--  start nav-outer-repeat................................................... END -->

        <div class="clear"></div>
        <!-- start content-outer ........................................................................................................................START -->
        <div id="content-outer">