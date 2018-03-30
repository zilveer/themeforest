<?php
/**
 * @package WordPress
 * @subpackage U-Design
 */
if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header();
?>

<div id="content-container" class="container_24">
    <div id="main-content" class="grid_24">
	<div class="main-content-padding">
<?php       udesign_main_content_top( is_front_page() );

            ob_start(); ?>

            <h3 class="page-404-message"><?php esc_html_e('Oops..., I cannot find the page you are looking for, sorry... ( Error 404 )', 'udesign'); ?></h3>

            <div class="page-404-help-options">
                <h6 class="page-404-message"><?php esc_html_e('Let me help you find it:', 'udesign'); ?></h6>
                <ol>
                    <li>
                        <?php _e('Search for it:', 'udesign'); ?>
                        <div class="inline-search-form"><?php get_search_form(); ?></div>
                    </li>
                    <li>
                        <?php _e('If you typed in a URL... check the spelling and try reloading the page.', 'udesign' ); ?>
                    </li>
                    <li>
                        <?php printf( __('Start over again with the %1$sHome page%2$s.', 'udesign'), '<a href="'.home_url().'">', '</a>' ); ?>

                    </li>
                </ol>
            </div>
<?php 
            $page_404_content_html = do_shortcode('[message type="warning"]' . ob_get_clean() . '[/message]');
            echo apply_filters( 'udesign_get_404_page_content', $page_404_content_html ); ?>

	    <div class="clear"></div>
            
<?php       udesign_main_content_bottom(); ?>
	</div><!-- end main-content-padding -->
    </div><!-- end main-content -->
</div><!-- end content-container -->

<div class="clear"></div>

<?php

get_footer();


