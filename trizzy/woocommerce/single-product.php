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

get_header( 'shop' ); ?>

<?php
$parallaximage = get_post_meta( $post->ID, 'pp_parallax_bg', TRUE );
$parallaxcolor = get_post_meta( $post->ID, 'pp_parallax_color', TRUE );
$parallaxopacity = get_post_meta( $post->ID, 'pp_parallax_opacity', TRUE );
$parallaxtype = get_post_meta($post->ID, 'pp_woo_parallax_type', TRUE);

if($parallaxtype == 'products') {
	if(!empty($parallaximage)) { ?>
	<section class="parallax-titlebar paralaxx-no-subtitle fullwidth-element"  data-background="<?php echo $parallaxcolor; ?>" data-opacity="<?php echo $parallaxopacity; ?>" data-height="160">
		<img src="<?php echo $parallaximage ?>" alt="" />
		<div class="parallax-overlay"></div>
		<div class="parallax-content">
			<h2><?php the_title(); ?>
				<?php $subtitle = get_post_meta($post->ID, 'pp_subtitle', TRUE);  if($subtitle) { ?>
					<span><?php echo $subtitle; ?></span>
				<?php } ?>
			</h2>

				<?php if(ot_get_option('pp_breadcrumbs','on') == 'on')  { do_action( 'trizzy_woocommerce_breadcrumb' ); } ?>

		</div>
	</section>
	<?php }
} else if($parallaxtype == 'general'){
	if(ot_get_option('pp_woo_parallax') == 'on') { ?>
	<section class="parallax-titlebar fullwidth-element"  data-background="<?php echo ot_get_option('pp_woo_parallax_color','#000'); ?>" data-opacity="<?php echo ot_get_option('pp_woo_parallax_opacity','0.45'); ?>" data-height="160">
		<img src="<?php echo ot_get_option('pp_woo_parallax_bg'); ?>" alt="" />
		<div class="parallax-overlay"></div>
		<div class="parallax-content">
			<h2>
				<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?><?php woocommerce_page_title(); ?><?php endif; ?>
				<?php $subtitle = ot_get_option('pp_woo_subtitle'); if(empty($subtitle)) { ?><span><?php _e('International Shipping','trizzy'); ?></span> <?php }
			else {
				echo "<span>".$subtitle."</span>";
			} ?>
			</h2>
			<?php if(ot_get_option('pp_breadcrumbs','on') == 'on')  { do_action( 'trizzy_woocommerce_breadcrumb' ); } ?>
		</div>
	</section>
	<?php }
} else { ?>
	<section class="titlebar">
	<div class="container">
	    <div class="sixteen columns">
	        <h2><?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?><?php woocommerce_page_title(); ?><?php endif; ?></h2>
	        <?php if(ot_get_option('pp_breadcrumbs','on') == 'on')  { do_action( 'trizzy_woocommerce_breadcrumb' ); } ?>
	    </div>
	</div>
	</section>
<?php }?>
	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>



<?php get_footer( 'shop' ); ?>