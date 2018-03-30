<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
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
	
		<?php $header_background_for_shop = ot_get_option( 'header_background_for_shop' ); ?>
		<?php if ( ! empty( $header_background_for_shop ) ) { ?>
		<?php $parallax_header_background_for_shop = ot_get_option( 'parallax_header_background_for_shop' ); ?>
		
		<?php $shop_header_margin = ot_get_option( 'shop_header_margin' ); ?>
		<?php if ( empty( $shop_header_margin ) ) { ?>
			<?php $shop_header_margin = '130'; ?>
		<?php } ?>
		
		<div class="entry-header-wrapper" style="background-image: url(<?php echo esc_url( $header_background_for_shop ); ?>);" <?php if ( ! empty( $parallax_header_background_for_shop ) ) { ?>data-600-top="background-position:50% 75%;" data--600-top="background-position:50% 25%;" data-smooth-scrolling="on"<?php } ?>>
			<header class="entry-header clearfix" <?php if ( $shop_header_margin != '130' ) { ?>style="margin: <?php echo esc_attr( $shop_header_margin - 1 ); ?>px auto  <?php echo esc_attr( $shop_header_margin ); ?>px";<?php } ?>>
				<h1 class="entry-title"><?php woocommerce_page_title(); ?></h1>
			</header><!-- .entry-header -->
		</div>
		<?php } else { ?>
	
		<div class="entry-header-wrapper" <?php if ( $background_overlay_color_for_heading != '#ffffff' || $background_overlay_opacity_for_heading != '.1' ) { ?>style="<?php if ( $background_overlay_color_for_heading != '#ffffff' ) { ?>background: <?php echo esc_attr( $background_overlay_color_for_heading ); ?>;<?php } ?> <?php if ( $background_overlay_opacity_for_heading != '.1' ) { ?>background: <?php echo esc_attr( $rgba ); ?>;<?php } ?>"<?php } ?>>
			<header class="entry-header clearfix">
				<h1 class="page-title" <?php if ( $color_for_heading != '#111111' ) { ?>style="color: <?php echo esc_attr( $color_for_heading ); ?>";<?php } ?>><?php woocommerce_page_title(); ?></h1>
				
				<?php woocommerce_breadcrumb(); ?>
			</header><!-- .entry-header -->
		</div>
		
		<?php }?>
	<?php endif; ?>

	<?php //do_action( 'woocommerce_archive_description' ); ?>

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

		<?php if ( have_posts() ) : ?>

			<?php
				/**
				 * woocommerce_before_shop_loop hook
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
			?>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php woocommerce_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

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
		$shop_layout = ot_get_option( 'shop_layout' );
		if ( isset($_GET['sidebar']) ) {
			if ( $shop_layout !== 'full-width' && $_GET['sidebar'] !== 'full-width') {
				do_action('woocommerce_sidebar');
			}
		} else {
			if ( have_posts() ) {
				do_action('woocommerce_sidebar');
			}
		}
	?>

<?php get_footer('shop'); ?>