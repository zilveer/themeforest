<?php if (jwOpt::get_option('banner_leader_type', 'image') == 'image') { ?>
    <?php 
        $banner_link = jwOpt::get_option('leader_banner_link', '#');
    ?>
    <?php if ( strlen($banner_link) <= 0 || $banner_link == 'http://' || $banner_link == 'https://' ) { ?>
        <div class="reverie-leader-banner col-lg-12">
            <a href="#">
                <img src="<?php echo jwOpt::get_option('leader_banner', ''); ?>" alt="banner">
            </a>
        </div>
    <?php } else { ?>
        <div class="reverie-leader-banner col-lg-12">
            <a href="<?php echo jwOpt::get_option('leader_banner_link', '#'); ?>"  target="<?php echo jwOpt::get_option('banner_lead_link_target', '_blank'); ?>">
                <img src="<?php echo jwOpt::get_option('leader_banner', ''); ?>" alt="banner"> 
            </a>
        </div>
    <?php } ?>
<?php } else { ?>
    <?php 
        $google_ads = jwOpt::get_option('leader_banner_google', '#');
    ?>
    <?php if ( strlen($google_ads) > 0) { ?>
        <div class="reverie-leader-banner col-lg-12">
            <div class="google_ads">
                <?php echo do_shortcode($google_ads); ?>
            </div>
        </div>
    <?php } ?>
<?php } ?>
