<?php echo Modules::run('template/admin_header',array('admin'=>'current')); ?>

<div id="content">

    <!--  start page-heading -->
    <div id="page-heading">
        <h1>Add User</h1>
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
                                    <form action="" method="POST" id="add_user_form" style="margin-left: 30%;">
                                        <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                                            <tr>
                                                <th valign="top">First Name:</th>
                                                <td><input type="text"  id="fname" name="fname" style="width: 200px;" /><span class="err" id="fname_err"></span></td>

                                            </tr>
                                            <tr>
                                                <th valign="top">Last Name:</th>
                                                <td><input type="text"  id="lname" name="lname" style="width: 200px;" /><span class="err" id="lname_err"></span></td>

                                            </tr>
                                            <tr>
                                                <th valign="top">Username:</th>
                                                <td><input type="text"  id="username" name="username" style="width: 200px;" /><span class="err" id="username_err"></span></td>

                                            </tr>
                                            <tr>
                                                <th valign="top">Password:</th>
                                                <td><input type="password"  id="password" name="password" style="width: 200px;" /><span class="err" id="password_err"></span></td>

                                            </tr>
                                            <tr>
                                                <th valign="top">Confirm password:</th>
                                                <td><input type="password"  id="confirm_password" name="confirm_password" style="width: 200px;" /><span class="err" id="confirm_password_err"></span></td>

                                            </tr>
                                            <tr>
                                                <th valign="top">Email:</th>
                                                <td><input type="text"  id="email" name="email"  style="width: 200px;" /><span class="err" id="email_err"></span></td>

                                            </tr>
                                            <tr>
                                                <th valign="top">Gender:</th>
                                                <td><input type="radio" name="gender"  value="male" class="input-xlarge" checked="checked"> male
                                                    <input type="radio" name="gender" class="input-xlarge" value="female"> female<br><br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th valign="top">is Administrator:</th>
                                                <td><input type="checkbox" name="is_admin" id="is_admin" value="1" class="input-xlarge" checked="checked"> 
                                                    
                                                </td>
                                            </tr>


                                            <tr>
                                                <th valign="top"><button class="btn btn-primary" >Create Account</button></th>
                                                <td> <button class="btn btn-primary" id="admin_cancel" >cancel</button></td>

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