<?php
echo Modules::run('template/index');
echo Modules::run('template/leftsidepanel');
?>
<link class="cssdeck" rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-responsive.min.css" class="cssdeck">
<script type="text/javascript" src="<?php echo base_url(); ?>js/global.js"></script>

<div class="modal-header" style="margin-left: 30%;">

    
</div>
<div class="modal-body" style="max-height:700px;margin-left: 30%;">
    <div class="tab-pane active in" id="create">
        <span id="msg" class="err"></span>
        <form id="resetpassword" method="POST" action="">
            <fieldset>
                <div id="legend">
                    <legend class="">Reset Password</legend>
                </div>    
                <div class="control-group">
                    <!-- Username -->
                    <label class="control-label"  for="password">Password</label>
                    <div class="controls">
                        <input type="password" id="password" name="password" placeholder="" class="input-xlarge"><span id="password_err" class="err"></span>
                    </div>
                </div>    
                 <div class="control-group">
                    <!-- Username -->
                    <label class="control-label"  for="confirm_password">confirm password</label>
                    <div class="controls">
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="" class="input-xlarge"><span id="confirm_password_err" class="err"></span>
                    </div>
                </div> 


                <div class="control-group">
                    <!-- Button -->
                    <div class="controls">
                        <input type="hidden" id="link" name="link" value="<?php if(isset($link) &&($link))echo $link;?>"placeholder="" class="input-xlarge"><button class="btn btn-success">Submit</button> <button class="btn btn-primary" id="cancel" >cancel</button>
                    </div>
                </div>
            </fieldset>
        </form>                
    </div>				
</div>		

<script type="text/javascript">
function get_base_url(){
    return '<?php echo base_url();?>';
}
</script>


<script class="cssdeck" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>

<?php
echo Modules::run('template/footer');
?>