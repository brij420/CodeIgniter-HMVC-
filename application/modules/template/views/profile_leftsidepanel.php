
<div class="left-sidebar">
    <div class="logo"><a href="#"><img src="<?php echo base_url(); ?>images/kkk-logo.png" /></a></div>
    <div class="left-nav">
        <a href="<?php echo base_url(); ?>index.php/user/index"> <h2>Categories</h2></a>
        <?php
        $userinfo = array();
        $userinfo = $this->session->userdata('userinfo');
        if (isset($userinfo['id']) && ($userinfo['id'])) {
            ?>

            <a href="<?php echo base_url(); ?>index.php/profile/index"> <h2>Profile</h2></a>

            <ul>
                <li>
                    <a href="#">Photo Gallery</a>
                    <ul>
                        <li><a href="<?php echo base_url(); ?>index.php/profile/add_photo/">Add photo</a></li>
                        <li><a href="<?php echo base_url(); ?>index.php/profile/edit_photo/">Edit Photo</a></li>
                        <li><a href="<?php echo base_url(); ?>index.php/profile/popular_photo/">Most liked Photos</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">User Information</a>
                    <ul>
                        <li><a href="#">Update Profile</a></li>                    
                    </ul>
                </li>            
            </ul>
        <?php } ?>
    </div>
</div>