<?php
/**
 * 404 page
 *
 * @package BuildPress
 */

get_header();

get_template_part( 'part-main-title' );
get_template_part( 'part-breadcrumbs' );

?>

<div class="master-container">
	<div class="error-404">
		<div class="container">
			<img src="<?php echo get_template_directory_uri(); ?>/assets/images/404.png" alt="404 Picture" class="push-down-30" width="262" height="208">
			<h2 class="alternative-heading--center"><?php _e( 'Looks Like Something Went Wrong!' , 'buildpress_wp'); ?></h2>
			<p class="error-404__text">
				<?php printf(
					/* translators: the first %s for line break, the second and third %s for link to home page wrap */
					__( 'The page you were looking for is not here. %s Go %s Home %s or try to search' , 'buildpress_wp'),
					'<br />',
					'<b><a href="' . esc_url( home_url( '/' ) ) . '">',
					'</a></b>'
				); ?>:
			</p>
			<div class="widget_search">
				<?php echo get_search_form(); ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>