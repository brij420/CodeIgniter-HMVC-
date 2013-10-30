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
        <form id="forgotpassword" method="POST" action="">
            <fieldset>
                <div id="legend">
                    <legend class="">Forgot Password</legend>
                </div>    
                <div class="control-group">
                    <!-- Username -->
                    <label class="control-label"  for="email">Email</label>
                    <div class="controls">
                        <input type="text" id="email" name="email" placeholder="" class="input-xlarge">
                    </div>
                </div>              


                <div class="control-group">
                    <!-- Button -->
                    <div class="controls">
                        <button class="btn btn-success">Submit</button> <button class="btn btn-primary" id="cancel" >cancel</button>
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