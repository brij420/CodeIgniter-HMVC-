
<div style="position: relative;margin-top:22%;"><?php
$i = 0;
foreach ($images as $value) {    
    ?>

    <div style="width: 150px; height: 150px;position: absolute;margin-left:<?php echo $i*200;?>px;">
        <?php if (isset($value['sub_category_name']) && ($value['sub_category_name'])) echo $value['sub_category_name']; ?><br/>
        <?php if (isset($value['category_name']) && ($value['category_name'])) echo $value['category_name']; ?><br/>
        <input type="hidden" id="<?php if (isset($value['id']) && ($value['id'])) echo $value['id']; ?>"> <img src="<?php if (isset($value['image']) && ($value['image'])) echo base_url() . 'uploads/' . $value['image']; ?>" width="100" height="100" />
    </div>

    <?php
    $i++;
    if ($i == 3) {
        $i = 0;
        echo '<br/>';
    }
}
?></div>

