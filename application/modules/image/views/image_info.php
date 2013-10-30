<?php
echo Modules::run('template/index');
echo Modules::run('template/leftsidepanel');
?>
<link class="cssdeck" rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-responsive.min.css" class="cssdeck">
<script type="text/javascript" src="<?php echo base_url(); ?>js/global.js"></script>

<div class="modal-header" style="margin-left: 30%;">

</div>
<div class="modal-body" style="min-height:1000px;margin-left: 30%;">
    <a href=""><?php echo $image_info['category_name']; ?></a> >> <a href=""><?php echo $image_info['sub_category_name']; ?></a>
    <div class="comment-wrap"> <img src="<?php echo base_url() . 'images/' . $image_info['image']; ?>" /><br/><br/><br/>

        <?php
        $comments = array();
        $comments = Modules::run('comment/get_comments', $image_info['id']);
        for ($i = 0; $i < count($comments); $i++) {
            ?>
            <table>
                <tr><th width="50%" style="text-align:left;"><?php echo $comments[$i]['sub']; ?></th></tr>
                <tr><td width="50%" style="text-align:left;"><?php echo $comments[$i]['description']; ?></td></tr>
                <tr><td width="50%" style="text-align:center;"><?php echo '-by ' . $comments[$i]['username'] . ' on ' . date('l jS \of F Y h:i:s A', $comments[$i]['date']); ?></td></tr>
            </table><br/>
        <?php } ?>
        <a href="javascript:void(0);" id="likes"><img src="<?php echo base_url() . 'images/like.png'; ?>" /><?php echo '(' . Modules::run('likes/image_likes_count', $image_info['id']) . ')'; ?></a>
        <div id="user_liked_list"><ul>
            <?php $user_likes = Modules::run('likes/get_liked_user_list', $image_info['id']);
            for($i=0;$i<count($user_likes);$i++){
                ?><li>-<?php echo $user_likes[$i]['username']; ?></li>
                    <?php } ?></ul></div>
        <form id="comment_box" action="" method="POST">
            <table><tr>
                    <td>subject: </td><td><input type="text" name="subject" id="subject" /><span id="subject_err" class="err"></span></td>
                </tr>
                <tr>
                    <td>description: </td><td><textarea name="description" id="description"></textarea><span id="description_err" class="err"></span></td>
                </tr>
                <tr>
                    <td><input type="hidden" name="photo_id" id="photo_id" value="<?php echo $image_info['id']; ?>" /></td><td><button class="btn btn-success">Submit</button></td>
                </tr></table>
        </form>
    </div>			
</div>		

<script type="text/javascript">
    function get_base_url() {
        return '<?php echo base_url(); ?>';
    }
</script>




<?php
echo Modules::run('template/footer');
?>