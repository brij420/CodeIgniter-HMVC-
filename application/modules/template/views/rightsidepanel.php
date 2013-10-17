<div class="right-sidebar">
    <div class="services-wrap">
        <div class="services-widget">
            <h2 class="credit"><span>Buy</span> Credits</h2>
            <p>Ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et <a href="#" class="arrow"><img src="<?php echo base_url(); ?>images/next-arrow.png" /></a></p>
        </div>
        <div class="services-widget">
            <h2 class="plan"><span>Buy</span> a Plan</h2>
            <p>Ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et <a href="#" class="arrow"><img src="<?php echo base_url(); ?>images/next-arrow.png" /></a></p>
        </div>
        <div class="services-widget last">
            <h2 class="question"><span>Have a</span> Question?</h2>
            <p>Ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et <a href="#" class="arrow"><img src="<?php echo base_url(); ?>images/next-arrow.png" /></a></p>
        </div>
    </div>
    <div id="slider" class="theme-mordilion">
        <ul>
            <li>
                <img src="<?php echo base_url(); ?>images/slider1.png" alt="" />
                <div>
                    <h3 style="margin-top: 0;">Lpsum dolor sit amet</h3>
                </div>
            </li>
            <li>
                <img src="<?php echo base_url(); ?>images/slider2.png" alt="" />
                <div>
                    <h3 style="margin-top: 0;">Lpsum dolor sit amet</h3>
                </div>
            </li>
            <li>
                <img src="<?php echo base_url(); ?>images/slider3.png" alt="" />
                <div>
                    <h3 style="margin-top: 0;">Lpsum dolor sit amet</h3>
                </div>
            </li>
            <li>
                <img src="<?php echo base_url(); ?>images/slider4.png" alt="" />
                <div>
                    <h3 style="margin-top: 0;">Lpsum dolor sit amet</h3>
                </div>
            </li>
            <li>
                <img src="<?php echo base_url(); ?>images/slider5.png" alt="" />
                <div>
                    <h3 style="margin-top: 0;">Lpsum dolor sit amet</h3>
                </div>
            </li>
            <li>
                <img src="<?php echo base_url(); ?>images/slider6.png" alt="" />
                <div>
                    <h3 style="margin-top: 0;">Lpsum dolor sit amet</h3>
                </div>
            </li>
            <li>
                <img src="<?php echo base_url(); ?>images/slider7.png" alt="" />
                <div>
                    <h3 style="margin-top: 0;">Lpsum dolor sit amet</h3>
                </div>
            </li>
        </ul>
    </div>


    <?php
    $category = Modules::run('category/get_category');
    for ($i = 0; $i < count($category); $i++) {
        $list = NULL;
        $list = Modules::run('image/index', $category[$i]['id']);
        if (preg_match('/img/', $list)) {
            ?>
            <div class="jcarousel-skin-tango">
                <h2><?php echo $category[$i]['name']; ?></h2>
                <ul id="mycarousel">
                    <?php echo $list; ?>
                </ul>

            </div>
        <?php }
    }
    ?>
    <div class="comment-wrap">
        <ul>
            <li>
                <h3>Gennaro Franco liked the picture</h3>
                
            </li>
            <li>
                <h3>Gennaro Franco liked the picture</h3>
                <img src="<?php echo base_url(); ?>images/comment-img.png" />
            </li>
            <li>
                <h3>Gennaro Franco liked the picture</h3>
                <img src="<?php echo base_url(); ?>images/comment-img.png" />
            </li>
        </ul>
    </div>
</div>