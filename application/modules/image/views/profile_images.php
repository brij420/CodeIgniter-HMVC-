
<div style="position: relative;margin-top:22%;">
    <table>
        <tr>
            <td>Profile Name: <?php echo $user_info['fname'] . ' ' . $user_info['lname'] . '<br/>Email: <a href="">' . $user_info['email'] . '</a>'; ?></td>
        </tr>

    </table>
    <h2>Profile Picture</h2> 
    <?php
    $i = 0;
    foreach ($images as $value) {
        ?>

        <div style="width: 150px; height: 150px;position: absolute;margin-left:<?php echo $i * 200; ?>px;">

            <input type="hidden" id="<?php if (isset($value['id']) && ($value['id'])) echo $value['id']; ?>"><a href="<?php echo base_url() . 'index.php/image_info?id=' . $value['id']; ?>"> <img src="<?php if (isset($value['images']) && ($value['images'])) echo base_url() . 'uploads/' . $value['images']; ?>" width="100" height="100" /></a>
            <br/><a href="<?php echo base_url() . 'index.php/image/delete_profile_image?id=' . $value['id']; ?>">Delete</a>
        </div>

        <?php
        $i++;
        if ($i == 3) {
            $i = 0;
            echo '<br/>';
        }
    }
    ?></div>

