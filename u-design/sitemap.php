<?php
/**
 * @package WordPress
 * @subpackage U-Design
 */
/**
 * Template Name: Sitemap page
 */
if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header();

$content_position = ( $udesign_options['sitemap_sidebar'] == 'left' ) ? 'grid_16 push_8' : 'grid_16';
?>

<div id="content-container" class="container_24">
    <div id="main-content" class="<?php echo $content_position; ?>">
	<div class="main-content-padding">
<?php           udesign_main_content_top( is_front_page() ); ?>
<?php		if (have_posts()) : while (have_posts()) : the_post();
		    the_content();
		endwhile; endif; ?>
            
<?php	    // the sitemap contents are passed through the action hook "udesign_main_content_bottom" and defined in "functions.php"
            udesign_main_content_bottom(); ?>
	</div><!-- end main-content-padding -->
    </div><!-- end main-content -->

<?php if( sidebar_exist('SitemapSidebar') ) { get_sidebar('SitemapSidebar'); } ?>
</div><!-- end content-container -->

<div class="clear"></div>

<?php

get_footer();



