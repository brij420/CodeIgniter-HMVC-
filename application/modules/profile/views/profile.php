<?php
echo Modules::run('template/profile_home');
echo Modules::run('template/profile_leftsidepanel');
echo Modules::run('template/profile_rightsidepanel',array('user_info'=>$user_info));
echo Modules::run('template/footer');
?>