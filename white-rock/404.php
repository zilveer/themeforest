<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>

	<div id="page-title">
		<div class="width-container paged-title">
			<h1 class="page-title"><?php _e( '404 Page Not Found ', 'progression' ); ?></h1>
		</div>
		<div id="page-title-divider"></div>
	</div><!-- #page-title -->
	<div class="clearfix"></div>
	<?php $page_for_posts = get_option('page_for_posts'); ?>
	<?php if(has_post_thumbnail($page_for_posts)): ?>
		<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($page_for_posts), 'progression-page-title'); ?>
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

	<p class="page-not-found"><?php _e( 'It looks like nothing was found at this location. ', 'progression' ); ?></p>


<?php get_footer(); ?>