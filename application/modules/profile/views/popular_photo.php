<?php
echo Modules::run('template/index');
echo Modules::run('template/leftsidepanel');
?>
<link class="cssdeck" rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-responsive.min.css" class="cssdeck">
<script type="text/javascript" src="<?php echo base_url(); ?>js/global.js"></script>

<div class="modal-header" style="margin-left: 30%;">

    <h3>User Sign-up</h3>
</div>
<div class="modal-body" style="max-height:700px;margin-left: 30%;">
    <div class="tab-pane active in" id="create">
        <span id="msg" class="err" ></span>
        <form id="registration" method="" action="" enctype="multipart/form-data">
            <label>Nickname</label>
            <input type="text" value="" id="username" name="username" class="input-xlarge"><br/><span class="err" id="username_err"></span>
            <label>Password</label>
            <input type="password" value="" id="password" name="password" class="input-xlarge"><br/><span class="err" id="password_err"></span>
            <label>confirm-Password</label>
            <input type="password" value="" id="confirm_password" name="confirm_password" class="input-xlarge"><br/><span class="err" id="confirm_password_err"></span>
            <label>First Name</label>
            <input type="text" value="" id="fname" name="fname" class="input-xlarge"><br/><span class="err" id="fname_err"></span>
            <label>Last Name</label>
            <input type="text" value="" id="lname" name="lname" class="input-xlarge"><br/><span class="err" id="lname_err"></span>
            <label>Gender</label>
            <input type="radio" name="gender"  value="male" class="input-xlarge" checked="checked"> male
            <input type="radio" name="gender" class="input-xlarge" value="female"> female<br><br>
            <label>Email</label>
            <input type="text" value="" id="email" name="email" class="input-xlarge"><br/><span class="err" id="email_err"></span>
            <label>Upload File</label>
            <input type="button" id="upload" value="click here to upload image" /><span id="status"></span>
            <input type="hidden" id="image_name" name="image_name" value=""/>
            <ul id="files" ></ul>

            <label>Address</label>
            <textarea rows="4" cols="50" id="address" name="address"></textarea><br/><span class="err" id="email_err"></span>
            <label>City</label>
            <input type="text" value="" id="city" name="city" class="input-xlarge"><br/><span class="err" id="city_err"></span>
            <label>Country</label>
            <input type="text" value="" id="country" name="country" class="input-xlarge"><br/><span class="err" id="country_err"></span>
            <label>Phone No.</label>
            <input type="text" value="" id="phone" name="phone" class="input-xlarge"><br/><span class="err" id="phone_err"></span>

            <div>
                <button class="btn btn-primary" >Create Account</button> <button class="btn btn-primary" id="cancel" >cancel</button>
            </div>
        </form>
    </div>


</div>


<script class="cssdeck" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>

<?php
echo Modules::run('template/footer');
?>