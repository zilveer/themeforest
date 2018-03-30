<?php
/**
 * @package WordPress
 * @subpackage U-Design
 */
/**
 * Template Name: Full-width page
 */
if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


get_header(); ?>
<?php   if( get_theme_mod( 'udesign_include_container' ) ) : ?>
<div id="content-container" class="container_24">
    <div id="main-content" class="grid_24">
	<div class="main-content-padding">
<?php   endif; ?>
<?php       udesign_main_content_top( is_front_page() ); ?>
<?php	    if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
<?php               udesign_entry_before(); ?>
		    <div class="entry">
<?php                   udesign_entry_top(); ?>
<?php			the_content(__('<p class="serif">Read the rest of this entry &raquo;</p>', 'udesign')); ?>
<?php			udesign_entry_bottom(); ?>
		    </div>
<?php               udesign_entry_after(); ?>
		</div>
<?php		( $udesign_options['show_comments_on_pages'] == 'yes' ) ? comments_template() : ''; ?>
<?php	    endwhile; endif; ?>
	    <div class="clear"></div>
<?php	    udesign_main_content_bottom(); ?>
<?php   if( get_theme_mod( 'udesign_include_container' ) ) : ?>
	</div><!-- end main-content-padding -->
    </div><!-- end main-content -->
</div><!-- end content-container -->
<?php   endif; ?>

<div class="clear"></div>

<?php

get_footer();


