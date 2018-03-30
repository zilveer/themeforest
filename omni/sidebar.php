<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package omni
 */

?>

<?php if ( is_active_sidebar( 'primary' ) ) : ?>
	<aside id="sidebar" class="col-md-4 blog-content-column" role="complementary">
		<?php dynamic_sidebar( 'primary' ); ?>
	</aside><!-- #secondary -->
<?php else : ?>
	<aside id="sidebar" class="col-md-4 blog-content-column" role="complementary">
		<div class="message-box-entry style-1">
			<div class="text-box"><h4><?php esc_html_e( 'Please add some widgets to that area', 'omni' ) ?></h4></div>
		</div>
	</aside><!-- Time to add some widgets! -->
<?php endif;

