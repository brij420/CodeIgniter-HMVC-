<?php echo Modules::run('template/admin_header',array('category'=>'current')); ?>
<!-- start content -->
<div id="content">

    <!--  start page-heading -->
    <div id="page-heading">
        <h1>Category List</h1>
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

                                    <th class="table-header-repeat line-left minwidth-1"><a href="">S.No.</a>	</th>
                                    <th class="table-header-repeat line-left minwidth-1"><a href="">Category Name</a></th>
                                    <th class="table-header-repeat line-left"><a href="">Date</a></th>
                                    <th class="table-header-options line-left"><a href="">Options</a></th>
                                </tr>
                                <?php for ($i = 0; $i < count($category_listing); $i++) { ?>
                                    <tr>

                                        <td><?php echo $i + 1; ?></td>
                                        <td><?php echo $category_listing[$i]['name']; ?></td>
                                        <td><a href=""><?php echo date('Y-m-d', $category_listing[$i]['date']); ?></a></td>

                                        <td class="options-width">
                                            <a href="<?php echo base_url();?>index.php/category/add_category" title="Add" class="icon-1 info-tooltip"></a>
                                            <a href="<?php echo base_url();?>index.php/category/edit_category?id=<?php echo $category_listing[$i]['id']; ?>" title="Edit" class="icon-3 info-tooltip"></a>
                                            <a href="<?php echo base_url();?>index.php/category/delete_category?id=<?php echo $category_listing[$i]['id']; ?>" title="Delete" class="icon-2 info-tooltip"></a>                                                        
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
<!--  end content -->
<?php echo Modules::run('template/admin_footer'); ?>