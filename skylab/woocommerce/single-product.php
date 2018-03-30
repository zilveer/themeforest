<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header('shop'); ?>

	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
	
		<?php $background_overlay_color_for_heading = ot_get_option( 'background_overlay_color_for_heading' ); ?>
		<?php if ( empty( $background_overlay_color_for_heading ) ) { ?>
			<?php $background_overlay_color_for_heading = '#ffffff'; ?>
		<?php } ?>
				
		<?php $background_overlay_opacity_for_heading = ot_get_option( 'background_overlay_opacity_for_heading' ); ?>
		<?php if ( empty( $background_overlay_opacity_for_heading ) ) { ?>
			<?php $background_overlay_opacity_for_heading = '.1'; ?>
		<?php } ?>
		<?php $rgb = mega_hex2rgb( $background_overlay_color_for_heading ); ?>
		<?php $rgba = "rgba(" . $rgb[0] . ", " . $rgb[1] . ", " . $rgb[2] . ", " . $background_overlay_opacity_for_heading . ")"; ?>
				
		<?php $color_for_heading = ot_get_option( 'color_for_heading' ); ?>
		<?php if ( empty( $color_for_heading ) ) { ?>
			<?php $color_for_heading = '#111111'; ?>
		<?php } ?>
	
		<div class="entry-header-wrapper">
			<header class="entry-header clearfix" <?php if ( $background_overlay_color_for_heading != '#ffffff' || $background_overlay_opacity_for_heading != '.1' ) { ?>style="<?php if ( $background_overlay_color_for_heading != '#ffffff' ) { ?>background: <?php echo esc_attr( $background_overlay_color_for_heading ); ?>;<?php } ?> <?php if ( $background_overlay_opacity_for_heading != '.1' ) { ?>background: <?php echo esc_attr( $rgba ); ?>;<?php } ?>"<?php } ?>>
				<?php woocommerce_breadcrumb(); ?>
			</header><!-- .entry-header -->
		</div>
	<?php endif; ?>

	<div id="main" class="clearfix">
	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action('woocommerce_before_main_content');
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php woocommerce_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action('woocommerce_after_main_content');
	?>

	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action('woocommerce_sidebar');
	?>

<?php get_footer('shop'); ?>