<?php 
/*
 * Template Name: Coming Soon
 */
get_header('alternative'); ?>

<?php
    global $themeum_options;
    $comingsoon_date = '';
    if (isset($themeum_options['comingsoon-date'])) {
        $comingsoon_date = esc_attr($themeum_options['comingsoon-date']);
    }
?>

<div class="comingsoon" style="background-image: url(<?php echo esc_url($themeum_options['comingsoon']['url']); ?>);">
    <div>

    <div class="comingsoon-content">

        <script type="text/javascript">
        jQuery(function($) {
            $('#comingsoon-countdown').countdown("<?php echo str_replace('-', '/', $comingsoon_date); ?>", function(event) {
                $(this).html(event.strftime('<div class="countdown-section"><span class="countdown-amount first-item countdown-days">%-D </span><span class="countdown-period">%!D:<?php echo esc_html__("DAY", "eventum"); ?>,<?php echo esc_html__("DAYS", "eventum"); ?>;</span></div><div class="countdown-section"><span class="countdown-amount countdown-hours">%-H </span><span class="countdown-period">%!H:<?php echo esc_html__("HOUR", "eventum"); ?>,<?php echo esc_html__("HOURS", "eventum"); ?>;</span></div><div class="countdown-section"><span class="countdown-amount countdown-minutes">%-M </span><span class="countdown-period">%!M:<?php echo esc_html__("MINUTE", "eventum"); ?>,<?php echo esc_html__("MINUTES", "eventum"); ?>;</span></div><div class="countdown-section"><span class="countdown-amount countdown-seconds">%-S </span><span class="countdown-period">%!S:<?php echo esc_html__("SECOND", "eventum"); ?>,<?php echo esc_html__("SECONDS", "eventum"); ?>;</span></div>'));
            });
        });
        </script>

        <div id="comingsoon-countdown"></div>

        <h2 class="page-header"><?php if (isset($themeum_options['comingsoon-title'])) echo esc_html($themeum_options['comingsoon-title']); ?></h2>
        <p class="comingsoon-message-desc"><?php if (isset($themeum_options['comingsoon-message-desc'])) echo esc_html($themeum_options['comingsoon-message-desc']); ?></p>

    
        <div class="social-share">
            <ul>
                <?php if ( isset($themeum_options['wp-facebook']) && $themeum_options['wp-facebook'] ) { ?>
                <li><a href="<?php echo esc_url($themeum_options['wp-facebook']); ?>"><i class="fa fa-facebook"></i></a></li>
                <?php } ?>   
                <?php if ( isset($themeum_options['wp-twitter']) && $themeum_options['wp-twitter'] ) { ?>
                <li><a href="<?php echo esc_url($themeum_options['wp-twitter']); ?>"><i class="fa fa-twitter"></i></a></li>
                <?php } ?>    
                <?php if ( isset($themeum_options['wp-google-plus']) && $themeum_options['wp-google-plus'] ) { ?>
                <li><a href="<?php echo esc_url($themeum_options['wp-google-plus']); ?>"><i class="fa fa-google-plus"></i></a></li>
                <?php } ?>
                <?php if ( isset($themeum_options['wp-pinterest']) && $themeum_options['wp-pinterest'] ) { ?>  
                <li><a href="<?php echo esc_url($themeum_options['wp-pinterest']); ?>"><i class="fa fa-pinterest"></i></a></li>
                <?php } ?>
                <?php if ( isset($themeum_options['wp-youtube']) && $themeum_options['wp-youtube'] ) { ?>  
                <li><a href="<?php echo esc_url($themeum_options['wp-youtube']); ?>"><i class="fa fa-youtube"></i></a></li>
                <?php } ?>
                <?php if ( isset($themeum_options['wp-linkedin']) && $themeum_options['wp-linkedin'] ) { ?>  
                <li><a href="<?php echo esc_url($themeum_options['wp-linkedin']); ?>"><i class="fa fa-linkedin"></i></a></li>
                <?php } ?>
                <?php if ( isset($themeum_options['wp-dribbble']) && $themeum_options['wp-dribbble'] ) { ?>  
                <li><a href="<?php echo esc_url($themeum_options['wp-dribbble']); ?>"><i class="fa fa-dribbble"></i></a></li>
                <?php } ?>
                <?php if ( isset($themeum_options['wp-behance']) && $themeum_options['wp-behance'] ) { ?>  
                <li><a href="<?php echo esc_url($themeum_options['wp-behance']); ?>"><i class="fa fa-behance"></i></a></li>
                <?php } ?>
                <?php if ( isset($themeum_options['wp-flickr']) && $themeum_options['wp-flickr'] ) { ?>  
                <li><a href="<?php echo esc_url($themeum_options['wp-flickr']); ?>"><i class="fa fa-flickr"></i></a></li>
                <?php } ?>
                <?php if ( isset($themeum_options['wp-vk']) && $themeum_options['wp-vk'] ) { ?>  
                <li><a href="<?php echo esc_url($themeum_options['wp-vk']); ?>"><i class="fa fa-vk"></i></a></li>
                <?php } ?>
                <?php if ( isset($themeum_options['wp-skype']) && $themeum_options['wp-skype'] ) { ?>  
                <li><a href="skype:#<?php echo esc_url($themeum_options['wp-skype']); ?>?chat"><i class="fa fa-skype"></i></a></li>
                <?php } ?>
                <?php if ( isset($themeum_options['wp-instagram']) && $themeum_options['wp-instagram'] ) { ?>  
                <li><a href="<?php echo esc_url($themeum_options['wp-instagram']); ?>"><i class="fa fa-instagram"></i></a></li>
                <?php } ?>
            </ul>
        </div>
        
        
    </div>
</div>
</div>


<?php get_footer('alternative');