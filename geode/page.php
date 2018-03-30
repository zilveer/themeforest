<?php
/**
 * @package WordPress
 * @subpackage Geode
 * @since Geode 1.0
 */

get_header(); ?>

<?php
	$align = apply_filters('geode_sidebar_position', get_option('pix_style_main_sidebar_position')) == 'right'  ? 'left' : 'right';
?>

<?php get_template_part( 'title', '' ); ?>
<div class="site-content cf site-main side-template">
	<div id="primary" class="align<?php echo $align; ?>" data-delay="0">
		<div id="content" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>
		</div><!-- #content -->
	</div><!-- #primary -->

	<?php geode_sidebar('right'); ?>
</div><!-- .site-content -->

<?php get_footer(); ?>