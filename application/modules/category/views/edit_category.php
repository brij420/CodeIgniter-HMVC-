<?php echo Modules::run('template/admin_header',array('category'=>'current')); ?>

<div id="content">

    <!--  start page-heading -->
    <div id="page-heading">
        <h1>Edit Category</h1>
    </div>
    <!-- end page-heading -->

    <table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
        <tr>
            <th rowspan="3" class="sized"><img src="<?php echo base_url(); ?>images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
            <th class="topleft"></th>
            <td id="tbl-border-top">&nbsp;</td>
            <th class="topright"></th>
            <th rowspan="3" class="sized"><img src="<?php echo base_url(); ?>images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
        </tr>
        <tr>
            <td id="tbl-border-left"></td>
            <td>
                <!--  start content-table-inner ...................................................................... START -->
                <div id="content-table-inner">

                    <!--  start content-table-inner -->
                    <div id="content-table-inner">

                        <table border="0" width="100%" cellpadding="0" cellspacing="0">
                            <tr valign="top">
                                <td>

                                    <div id="msg" class="err"></div>
                                    <!-- start id-form -->
                                    <form action="" method="" id="edit_category_form" style="margin-left: 30%;">
                                        <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                                            <tr>
                                                <th valign="top">Category Name:</th>
                                                <td><input type="hidden" id="id" name="id" value="<?php echo $category['id'];?>" /><input type="text"  id="category" name="category" value="<?php echo $category['name'];?>" style="width: 200px;" /><span class="err" id="category_err"></span></td>

                                            </tr>                                           


                                            <tr>
                                                <th valign="top"><button class="btn btn-primary" >Edit Category</button></th>
                                                <td> <button class="btn btn-primary" id="category_cancel" >cancel</button></td>

                                            </tr>



                                        </table>
                                    </form>
                                    <!-- end id-form  -->

                                </td>

                            </tr>

                        </table>

                        <div class="clear"></div>


                    </div>
                    <!--  end content-table-inner  -->
                    <?php echo Modules::run('template/admin_footer'); ?>