<div class="left-sidebar">
    <div class="logo"><a href="#"><img src="<?php echo base_url(); ?>images/kkk-logo.png" /></a></div>
    <div class="left-nav">
        <?php
        $userinfo = array();
        $userinfo = $this->session->userdata('userinfo');
        if (isset($userinfo['id']) && ($userinfo['id'])) {
            ?>

            <a href="<?php echo base_url(); ?>index.php/profile/index"> <h2>Profile</h2></a>
        <?php } ?>
        <h2>Categories</h2>
        <?php echo Modules::run('category/index'); ?>
    </div>
</div>