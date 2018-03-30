<?php
/*
Template Name: Onepage Full size page
Author: Azelab <support@azelab.com>
*/
defined( 'ABSPATH' ) OR exit( 'restricted access' ); // Protect against direct call
?>
<?php get_header(); ?>

<?php if ( get_mental_option( 'show_menubar' ) ) { get_template_part( 'blocks/menubar-onepage' ); } ?>

<div id="main" role="main" class="onepage-with-menubar">

	<?php $footer_parallax_effect = ( get_mental_option( 'footer_parallax' ) && get_mental_option( 'footer_show' ) )? true : false ; ?>

	<?php if ( $footer_parallax_effect ): ?>
		<div class="parallax-footer">
	<?php endif ?>

	<?php if ( ! get_mental_option( 'show_topmenu' ) ) get_template_part( 'blocks/mobile-header' ) ?>

	<?php if ( get_mental_option( 'show_topmenu' ) ) get_template_part( 'blocks/topmenu' ); ?>

	<?php if ( get_mental_option( 'show_header' ) ): ?>

		<?php azl_get_template_part('blocks/header', '', array('title' => get_the_title())); ?>

	<?php endif ?>

	<?php if ( have_posts() ): while( have_posts() ) : the_post(); ?>
	

		<?php the_content(); ?>
	

	<?php endwhile; ?>

	<?php else: ?>

		<h2><?php _e( 'Sorry, nothing to display.', 'mental' ); ?></h2>

	<?php endif; ?>

	<?php if ( $footer_parallax_effect ): ?>
		</div>
	<?php endif ?>

	<?php if ( get_mental_option( 'footer_show' ) ) get_template_part( 'blocks/widget-footer' ) ?>

</div> <!-- main -->

<?php get_footer(); ?>
