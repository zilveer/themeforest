<?php 

/*
 * Template Name: Coming Soon
 */

get_header('alternative'); ?>

<?php
    global $themeum_options;
    $comingsoon_date = '';
    if (isset($themeum_options['comingsoon-date'])) {
        $comingsoon_date = $themeum_options['comingsoon-date'];
    }
?>

<div class="comingsoon">


    <?php if( isset($themeum_options['comingsoon-logo']['url'] )): ?>
        <div class="comingsoon-logo">
            <img src="<?php echo esc_url( $themeum_options['comingsoon-logo']['url'] ); ?>" alt="<?php  esc_html_e( 'logo', 'themeum' ); ?>">
        </div>
    <?php endif; ?>

    <div class="comingsoon-content">
        <h2 class="page-header"><?php if (isset($themeum_options['comingsoon-title'])) echo $themeum_options['comingsoon-title']; ?></h2>
        <p class="comingsoon-message-desc"><?php if ( isset($themeum_options['comingsoon-message-desc']) ) echo $themeum_options['comingsoon-message-desc']; ?></p>

        <script type="text/javascript">
        jQuery(function($) {
            $('#comingsoon-countdown').countdown("<?php echo str_replace('-', '/', $comingsoon_date); ?>", function(event) {
                $(this).html(event.strftime('<div class="countdown-section"><span class="countdown-amount first-item">%-D </span><span class="countdown-period">%!D:<?php echo __("Day", "themeum"); ?>,<?php echo __("Days", "themeum"); ?>;</span></div><div class="countdown-section"><span class="countdown-amount">%-H </span><span class="countdown-period">%!H:<?php echo __("Hour", "themeum"); ?>,<?php echo __("Hours", "themeum"); ?>;</span></div><div class="countdown-section"><span class="countdown-amount">%-M </span><span class="countdown-period">%!M:<?php echo __("Minute", "themeum"); ?>,<?php echo __("Minutes", "themeum"); ?>;</span></div><div class="countdown-section"><span class="countdown-amount">%-S </span><span class="countdown-period">%!S:<?php echo __("Second", "themeum"); ?>,<?php echo __("Seconds", "themeum"); ?>;</span></div>'));
            });
        });
        </script>

        <div id="comingsoon-countdown"></div>
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
                <?php if ( isset($themeum_options['wp-instagram']) && $themeum_options['wp-instagram'] ) { ?>  
                <li><a href="<?php echo esc_url($themeum_options['wp-instagram']); ?>"><i class="fa fa-instagram"></i></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>

<?php get_footer('alternative');