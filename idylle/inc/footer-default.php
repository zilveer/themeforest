<?php if( function_exists('fw_get_db_settings_option') ) { ?>




<?php $main_footer_image = fw_resize(fw_get_db_settings_option('background_image/url'), '1900', '', true ); ?>

<!-- Footer -->
<section class="idy_box idy_footer idy_white_txt">
    
    <!-- Footer Image -->
    <div class="idy_footer_image idy_image_bck" <?php if(fw_get_db_settings_option('parallax')=='1') { echo 'data-stellar-background-ratio="0.4"';}?> data-image="<?php echo esc_attr($main_footer_image); ?>">       
    </div>

    <?php if(fw_get_db_settings_option('over_display')=='1') { ?>
    <!-- Over -->
    <div class="idy_over" data-color="<?php echo fw_get_db_settings_option('over_color'); ?>" data-opacity="<?php echo fw_get_db_settings_option('over_opacity'); ?>"></div>
    <?php } ?>


    <div class="container idy_text_center">

        <!-- Title -->
        <h2><?php echo fw_get_db_settings_option('footer_text'); ?></h2>

        <!-- Thanks -->
        <div class="idy_subtitle"><span><?php echo fw_get_db_settings_option('footer_thanks_text'); ?></span></div>
        <a href="#idy_page" class="idy_go idy_heart idy_heart_small">
            <i class="ti ti-arrow-up"></i>
        </a>


    </div>
</section>
<!-- Footer End -->



<?php } else { ?>
<!-- Footer -->
<section class="idy_box idy_footer idy_white_txt">
    
    <!-- Footer Image -->
    <div class="idy_footer_image idy_image_bck" data-color="#ec0201">       
    </div>

    <div class="container">
        
        <!-- Title -->
        <h2><?php esc_html_e('Idylle Theme', 'idylle') ?></h2>
        <!-- Thanks -->
        <div class="idy_subtitle idy_lettering"><span><?php esc_html_e('Thank You', 'idylle') ?></span></div>

        
    </div>
</section>
<!-- Footer End -->
<?php } ?>


</div>
</div>
<!-- Page End -->