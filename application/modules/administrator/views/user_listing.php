<?php echo Modules::run('template/admin_header',array('admin'=>'current')); ?>
<!-- start content -->
<div id="content">

    <!--  start page-heading -->
    <div id="page-heading">
        <h1>List of User's</h1>
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

                    <!--  start table-content  -->
                    <div id="table-content">



                        <!--  start product-table ..................................................................................... -->
                        <form id="mainform" action="">
                            <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
                                <tr>

                                    <th class="table-header-repeat line-left minwidth-1"><a href="">Last Name</a>	</th>
                                    <th class="table-header-repeat line-left minwidth-1"><a href="">First Name</a></th>
                                    <th class="table-header-repeat line-left"><a href="">Email</a></th>
                                    <th class="table-header-repeat line-left"><a href="">User Type</a></th>
                                    <th class="table-header-repeat line-left"><a href="">Status</a></th>
                                    <th class="table-header-options line-left"><a href="">Options</a></th>
                                </tr>
                                <?php for ($i = 0; $i < count($user_listing); $i++) { ?>
                                    <tr>

                                        <td><?php echo $user_listing[$i]['lname']; ?></td>
                                        <td><?php echo $user_listing[$i]['fname']; ?></td>
                                        <td><a href=""><?php echo $user_listing[$i]['email']; ?></a></td>
                                        <td><?php
                                            if (isset($user_listing[$i]['is_admin']) && ($user_listing[$i]['is_admin']))
                                                echo 'admin';
                                            else
                                                echo 'user'
                                                ?></td>
                                        <td><a href=""><?php
                                                if (isset($user_listing[$i]['is_active']) && ($user_listing[$i]['is_active']))
                                                    echo 'active';
                                                else
                                                    echo 'inactive'
                                                    ?></a></td>
                                        <td class="options-width">
                                            <a href="administrator/add_user" title="Add" class="icon-1 info-tooltip"></a>
                                            <a href="administrator/edit_user?id=<?php echo $user_listing[$i]['id']; ?>" title="Edit" class="icon-3 info-tooltip"></a>
                                            <?php  if (isset($user_listing[$i]['is_admin']) && (!$user_listing[$i]['is_admin'])){?>
                                            <a href="administrator/delete_user?id=<?php echo $user_listing[$i]['id']; ?>" title="Delete" class="icon-2 info-tooltip"></a>                                                        
                                            <?php }?>
                                        </td>
                                    </tr>
                                <?php } ?>

                            </table>
                            <!--  end product-table................................... --> 
                        </form>
                    </div>
                    <!--  end content-table  -->



                    <!--  start paging..................................................... -->
                    <table border="0" cellpadding="0" cellspacing="0" id="paging-table">
                        <tr>
                            <td>
                                <a href="" class="page-far-left"></a>
                                <a href="" class="page-left"></a>
                                <div id="page-info">Page <strong>1</strong> / 15</div>
                                <a href="" class="page-right"></a>
                                <a href="" class="page-far-right"></a>
                            </td>
                            <td>
                                <select  class="styledselect_pages">
                                    <option value="">Number of rows</option>
                                    <option value="">1</option>
                                    <option value="">2</option>
                                    <option value="">3</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <!--  end paging................ -->

                    <div class="clear"></div>

                </div>
                <!--  end content-table-inner ............................................END  -->
            </td>
            <td id="tbl-border-right"></td>
        </tr>
        <tr>
            <th class="sized bottomleft"></th>
            <td id="tbl-border-bottom">&nbsp;</td>
            <th class="sized bottomright"></th>
        </tr>
    </table>
    <div class="clear">&nbsp;</div>

</div>
<?php echo Modules::run('template/admin_footer'); ?>