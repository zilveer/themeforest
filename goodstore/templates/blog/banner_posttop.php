<?php if (jwOpt::get_option('banner_posttop_type', 'image') == 'image') { ?>
    <div class="type-ads posttop"  >
        <div class="box">
            <div class="post_banner">   
                <a href="<?php echo jwOpt::get_option('banner_posttop_link', 'http://'); ?>"    target="<?php echo jwOpt::get_option('banner_posttop_target', '_blank'); ?>">
                    <img src="<?php echo jwOpt::get_option('banner_posttop', ''); ?>">
                </a>
            </div>
        </div>
    </div>  
<?php } else { ?>
<?php
    $google_ads = jwOpt::get_option('banner_posttop_google', '#');
    if ($google_ads != "#") {
    ?>
         <div class="type-ads google_ads_top posttop"  >
   
            <div class="box">
                <div class="google_ads">
                    <?php echo do_shortcode($google_ads); ?>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } ?>
