<?php
echo Modules::run('template/index');
echo Modules::run('template/leftsidepanel');
?>
<link class="cssdeck" rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-responsive.min.css" class="cssdeck">
<script type="text/javascript" src="<?php echo base_url(); ?>js/global.js"></script>




<div class="modal-body" style="min-height:700px;margin-left: 30%;">
    <a href="<?php echo base_url(); ?>index.php/category/join_subcategory?id=<?php if (isset($tournaments['id']) && ($tournaments['id'])) echo $tournaments['id']; ?>"><?php
        if (isset($tournaments['is_joined']) && ($tournaments['is_joined'])) {
            ?><a href="<?php echo base_url(); ?>index.php/image/add_photo_tournament?id=<?php if (isset($tournaments['id']) && ($tournaments['id'])) echo $tournaments['id']; ?>&cat_id=<?php if (isset($tournaments['cat_id']) && ($tournaments['cat_id'])) echo $tournaments['cat_id']; ?>"><button class="btn btn-primary" style="margin-left: 80%;">Add Photo</button></a><?php } else { ?><a href="<?php echo base_url(); ?>index.php/category/join_tournament?id=<?php if (isset($tournaments['id']) && ($tournaments['id'])) echo $tournaments['id']; ?>"><button class="btn btn-primary" style="margin-left: 80%;">Join Tournament</button></a>
        <?php } ?>
        <div class="tab-pane active in" id="create">



            <div id="legend">
                <legend class="">Tournaments Details</legend>
            </div>   
            <a href="javascript:void(0);"><?php if (isset($tournaments['catagory_name']) && ($tournaments['catagory_name'])) echo $tournaments['catagory_name']; ?></a>>><a href="javascript:void(0);"><?php if (isset($tournaments['name']) && ($tournaments['name'])) echo $tournaments['name']; ?></a><br/>
            <span id="msg" class="err"></span>
            <div class="control-group">
                <!-- Username -->
                <label class="control-label"  for="username">Description:</label>
                <div class="controls">
                    <?php if (isset($tournaments['description']) && ($tournaments['description'])) echo $tournaments['description']; ?>
                </div>
            </div>

            <div class="control-group">
                <!-- Password-->
                <label class="control-label" for="password">Status:</label>
                <div class="controls">
                    <?php if (isset($tournaments['start_date']) && ($tournaments['start_date'])) echo ' Starting Date: '.$tournaments['start_date'];if (isset($tournaments['start_vote_date']) && ($tournaments['start_vote_date'])) echo ' Vote from date: '.$tournaments['start_vote_date'];if (isset($tournaments['start_hour']) && ($tournaments['start_hour'])){if($tournaments['start_hour']<10)echo ' Starting Hour: 0'.$tournaments['start_hour'];else echo ' Starting Hour: '.$tournaments['start_hour'];} ?> -to- <?php if (isset($tournaments['end_date']) && ($tournaments['end_date'])) echo ' Ending Date: '.$tournaments['end_date'];if (isset($tournaments['end_hour']) && ($tournaments['end_hour'])){ if($tournaments['end_hour']<10)echo ' Ending Hour: 0'.$tournaments['end_hour'];else echo ' Ending Hour: '.$tournaments['end_hour'];} ?>
                </div>
            </div>
            <div class="control-group">
                <div style="position: relative;margin-top:22%;"><?php
                    $i = 0;
                    if(!empty($images))
                    foreach ($images as $value) {
                        ?>

                        <div style="width: 200px; height: 200px;position: absolute;margin-left:<?php echo $i * 200; ?>px;">
                            <input type="hidden" id="<?php if (isset($value['id']) && ($value['id'])) echo $value['id']; ?>"><a href="<?php echo base_url() . 'index.php/image/image_info?id=' . $value['id']; ?>"> <img src="<?php if (isset($value['image']) && ($value['image'])) echo base_url() . 'uploads/' . $value['image']; ?>" width="100" height="100" /></a>
                            <br/> Points: <?php echo Modules::run('like/get_image_likes_count/'.$value['id'])*15;?> &nbsp;&nbsp;<?php echo isset($value['username'])&&($value['username'])?$value['username']:NULL;?> 
                        </div>

                        <?php
                        $i++;
                        if ($i == 3) {
                            $i = 0;
                            echo '<br/>';
                        }
                    }
                    ?></div>  
            </div>


        </div>				
</div>		

<script type="text/javascript">
    function get_base_url() {
        return '<?php echo base_url(); ?>';
    }
</script>


<script class="cssdeck" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>

<?php
echo Modules::run('template/footer');
?>