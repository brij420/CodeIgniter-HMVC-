

<?php for ($i = 0; $i < count($images); $i++) {
    if (isset($images[$i]['id']) && ($images[$i]['id'])) {
        ?>               
        <li>
            <h1><?php echo $images[$i]['sub_category_name']; ?></h1>
            <a href="<?php echo base_url().'index.php/';?>image/image_info?id=<?php echo $images[$i]['id']; ?>"><img src="<?php echo base_url() . 'images/' . $images[$i]['image']; ?>" width="207" height="207" alt="" /></a>
        </li>
        <?php }
    } ?>

