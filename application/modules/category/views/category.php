 
<ul>
    <?php for ($i = 0; $i < count($category); $i++) { ?>
        <li>
            <a href="javascript:void(0);"><?php if(isset($category[$i]['name'])&&($category[$i]['name']))echo $category[$i]['name']; ?></a>
            <ul>
                <?php if(isset($category[$i]['subcategory'])&&($category[$i]['subcategory']))for ($j = 0; $j < count($category[$i]['subcategory']); $j++) { ?>
                    <li><a href="javascript:void(0);"><?php echo $category[$i]['subcategory'][$j]['name']; ?></a></li>
                <?php } ?>
            </ul>
        </li>
    <?php } ?>



</ul>