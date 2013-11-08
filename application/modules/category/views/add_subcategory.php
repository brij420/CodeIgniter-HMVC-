<?php echo Modules::run('template/admin_header', array('subcategory' => 'current')); ?>
<script>

    $(document).ready(function() {
        $("#start_date").datepicker({
            changeMonth: true,
            dateFormat: "yy-mm-dd",
            onSelect: function(datetext) {
                var d = new Date(); // for now
                datetext = datetext + " " + d.getHours() + ": " + d.getMinutes() + ": " + d.getSeconds();
                $('#start_date').val(datetext);
            },
            changeYear: true
        });
        $("#start_vote_date").datepicker({
            changeMonth: true,
            dateFormat: "yy-mm-dd",
           /* onSelect: function(datetext) {
                var d = new Date(); // for now
                datetext = datetext + " " + d.getHours() + ": " + d.getMinutes() + ": " + d.getSeconds();
                $('#start_date').val(datetext);
            },*/
            changeYear: true
        });

        $("#end_date").datepicker({
            changeMonth: true,
            dateFormat: "yy-mm-dd",
            /*onSelect: function(datetext) {
             var d = new Date(); // for now
             datetext = datetext + " " + d.getHours() + ": " + d.getMinutes() + ": " + d.getSeconds();
             $('#end_date').val(datetext);
             },*/
            changeYear: true
        });
    });


</script>
<div id="content">

    <!--  start page-heading -->
    <div id="page-heading">
        <h1>Tournament</h1>
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
                                    <form action="" method="POST" id="add_subcategory_form" style="margin-left: 30%;">
                                        <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                                            <tr>
                                                <th valign="top">Category:</th>
                                                <td>	
                                                    <select  id="select_category" name="select_category" >
                                                        <option value="">select</option>                                                        
                                                    </select>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th valign="top">Tournament Name:</th>
                                                <td><input type="text"  id="subcategory" name="subcategory" style="width: 200px;" /><span class="err" id="subcategory_err"></span></td>

                                            </tr>                                           
                                            <tr>
                                                <th valign="top">Description:</th>
                                                <td><input type="text"  id="description" name="description" style="width: 200px;" /><span class="err" id="description_err"></span></td>

                                            </tr>      
                                            <tr>
                                                <th valign="top">Points:</th>
                                                <td><input type="text"  id="fees" name="fees" style="width: 200px;" /><span class="err" id="fees_err"></span></td>

                                            </tr>      
                                            <tr>
                                                <th valign="top">Start Date:</th>
                                                <td><input type="start_date"  id="start_date" name="start_date" style="width: 200px;" /><span class="err" id="start_date_err"></span></td>
                                            </tr>
                                            <tr>
                                                <th valign="top">Vote from Day:</th>
                                                <td><input type="text"  id="start_vote_date" name="start_vote_date" style="width: 200px;" /><span class="err" id="start_vote_date_err"></span>&nbsp;&nbsp; Hour: <select id='start_hour' name='start_hour'><option value='' selected="selected" >select</option>
                                                        <?php for ($i = 0; $i <= 24; $i++) { ?>    
                                                            <option value='<?php echo $i; ?>'><?php
                                                                if ($i < 10)
                                                                    echo '0' . $i;
                                                                else
                                                                    echo $i;
                                                                ?></option>
                                                        <?php } ?>

                                                    </select><span class="err" id="start_hour_err"></span></td>
                                            </tr>

                                            <tr>
                                                <th valign="top">Tournament closes day :</th>
                                                <td><input type="text"  id="end_date" name="end_date" style="width: 200px;" /><span class="err" id="end_date_err"></span>&nbsp;&nbsp;Hour:<select id='end_hour' name='end_hour' ><option value='' selected="selected" >select</option>
                                                        <?php for ($i = 0; $i <= 24; $i++) { ?>    
                                                            <option value='<?php echo $i; ?>'><?php
                                                                if ($i < 10)
                                                                    echo '0' . $i;
                                                                else
                                                                    echo $i;
                                                                ?></option>
                                                        <?php } ?>

                                                    </select><span class="err" id="end_hour_err"></span></td>

                                            </tr>
                                            <tr>
                                                <th valign="top">Prizes:</th>
                                                <td><table><tr><td>First: <input type="text"  id="fprize" name="fprize" style="width: 75px;" /><span class="err" id="fprize_err"></span></td></tr><tr><td>Second: <input type="text"  id="sprize" name="sprize" style="width: 75px;" /><span class="err" id="sprize_err"></span></td></tr><tr><td>Third: <input type="text"  id="tprize" name="tprize" style="width: 75px;" /><span class="err" id="tprize_err"></span></td></tr><tr><td>Fourth: <input type="text"  id="four_prize" name="four_prize" style="width: 75px;" /><span class="err" id="four_prize_err"></span></td></tr><tr><td>Fifth: <input type="text"  id="fifth_prize" name="fifth_prize" style="width: 75px;" /><span class="err" id="fifth_prize_err"></span></td></tr><tr><td>Sixth: <input type="text"  id="six_prize" name="six_prize" style="width: 75px;" /><span class="err" id="six_prize_err"></span></td></tr><tr><td>Seven: <input type="text"  id="seven_prize" name="seven_prize" style="width: 75px;" /><span class="err" id="seven_prize_err"></span></td></tr><tr><td>Eighth: <input type="text"  id="eight_prize" name="eight_prize" style="width: 75px;" /><span class="err" id="eight_prize_err"></span></td></tr></table></td>

                                            </tr> 

                                            <tr>
                                                <th valign="top"><button class="btn btn-primary" >Add Category</button></th>
                                                <td> <button class="btn btn-primary" id="subcategory_cancel" >cancel</button></td>

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