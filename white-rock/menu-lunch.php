<?php
// Template Name: Menu Page - Lunch
/**
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>

		<?php
		global $wp_query;
		$thePostID = $wp_query->post->ID;
		?>
		<div id="page-title">
			<div class="width-container paged-title">
				<h1><?php the_title(); ?></h1>	
			</div>
		<div id="page-title-divider"></div>
		</div><!-- #page-title -->
		<div class="clearfix"></div>
		<?php if(has_post_thumbnail()): ?>
			<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'progression-page-title'); ?>
			<script type='text/javascript'>
			jQuery(document).ready(function($) {  
			    $("#page-title").backstretch([
					"<?php echo $image[0]; ?>"
					<?php if( class_exists( 'kdMultipleFeaturedImages' ) ) {
						if( kd_mfi_get_featured_image_url( 'featured-image-2', 'page', 'progression-page-title', $thePostID ) != "" ) {
						    echo ',"', kd_mfi_get_featured_image_url( 'featured-image-2', 'page', 'progression-page-title', $thePostID ) , '"';
						}

						if( kd_mfi_get_featured_image_url( 'featured-image-3', 'page', 'progression-page-title', $thePostID ) != "" ) {
						    echo ',"', kd_mfi_get_featured_image_url( 'featured-image-3', 'page', 'progression-page-title', $thePostID ) , '"';
						}
					}
			 		?>
				],{
			            fade: 750,
			            duration: <?php echo of_get_option('slider_autoplay', 8000); ?>
			     });
			});
			</script>
		<?php endif; ?>

<div id="main" class="site-main">
	<div class="width-container">

<?php while ( have_posts() ) : the_post(); ?>
		<?php the_content(); ?>
<?php endwhile; // end of the loop. ?>


<?php if ( is_active_sidebar( 'lunch-widgets-col-2' ) ) : ?><div class="grid2column"><?php endif; ?>

<?php if ( ! dynamic_sidebar( 'Lunch Widgets Column 1' ) ) : ?>
<?php endif; // end sidebar widget area ?>
<?php if ( is_active_sidebar( 'lunch-widgets-col-2' ) ) : ?></div><?php endif; ?>

<?php if ( is_active_sidebar( 'lunch-widgets-col-2' ) ) : ?>
<div class="grid2column lastcolumn">
<?php if ( ! dynamic_sidebar( 'Lunch Widgets Column 2' ) ) : ?>
<?php endif; // end sidebar widget area ?>
</div>
<?php endif; ?>

<div class="clearfix"></div>
<?php get_footer(); ?>