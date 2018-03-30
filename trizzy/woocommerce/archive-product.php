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

get_header( 'shop' ); ?>
<?php
$sliderstatus = ot_get_option( 'pp_shop_slider_on' );
if($sliderstatus == 'on') {
    if (function_exists('icl_get_languages')) {
          $languages = icl_get_languages('skip_missing=0&orderby=code');
           if(!empty($languages)){
                foreach($languages as $l){
                    if(ICL_LANGUAGE_CODE == $l['language_code']) {
                    echo '<div class="container fullwidth-element home-slider">'; putRevSlider(ot_get_option( 'pp_shop_revo_slider'.$l['language_code'])); echo "</div>";
                    }
                }
           }
    } else {
       echo '<div class="container fullwidth-element home-slider">';putRevSlider(ot_get_option( 'pp_shop_revo_slider' )); echo "</div>";
    }
} ?>
<!-- Titlebar
================================================== -->
<?php
if(ot_get_option('pp_shop_search_on','off') == 'on') {
	get_template_part( 'inc/woosearchbox' );
} else {
	if(ot_get_option('pp_woo_parallax') == 'on') { ?>
<section class="parallax-titlebar fullwidth-element"  data-background="<?php echo ot_get_option('pp_woo_parallax_color','#000'); ?>" data-opacity="<?php echo ot_get_option('pp_woo_parallax_opacity','0.45'); ?>" data-height="160">
	<img src="<?php echo ot_get_option('pp_woo_parallax_bg'); ?>" alt="" />
	<div class="parallax-overlay"></div>
	<div class="parallax-content">
		<h2>
			<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?><?php woocommerce_page_title(); ?><?php endif; ?>
			<?php $subtitle = ot_get_option('pp_woo_subtitle');
			if(empty($subtitle)) { ?>
				<span><?php _e('International Shipping','trizzy'); ?></span>
			<?php } else {
				echo "<span>".$subtitle."</span>";
			} ?>
		</h2>
		<?php if(ot_get_option('pp_breadcrumbs','on') == 'on')  { do_action( 'trizzy_woocommerce_breadcrumb' ); } ?>
	</div>
</section>
<?php } else { ?>
<section class="titlebar">
<div class="container">
    <div class="sixteen columns">
        <h2><?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?><?php woocommerce_page_title(); ?><?php endif; ?></h2>
        <?php if(ot_get_option('pp_breadcrumbs','on') == 'on')  { do_action( 'trizzy_woocommerce_breadcrumb' ); } ?>
    </div>
</div>
</section>
<?php }
}	?>


<?php $shop_layout = ot_get_option('pp_woo_layout','right-sidebar'); ?>
<div class="container <?php echo $shop_layout ?>-class">
	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		if($shop_layout == 'left-sidebar') { do_action( 'woocommerce_sidebar' ); }?>
		<?php if(ot_get_option('pp_shop_search_on','off') == 'on') {
			if ( is_search() || is_tax()) { ?>
			<div class="columns <?php if($shop_layout == 'full-width') { echo "sixteen"; } else { echo "twelve"; }?> shop-search-title">
				<h3 class="headline"><?php echo trizzy_woocommerce_page_title(); ?></h3><span class="line"></span>

				<div class="clearfix"></div>
				<?php if(is_tax() || is_search()) {
					global $wp_query;
					$shop_page_id = wc_get_page_id( 'shop' ); ?>
					<a href="<?php echo get_permalink( $shop_page_id) ?>" class="back-to-shop <?php if ( $wp_query->found_posts == 1) { echo "link-up"; } ?>"><i class="fa fa-caret-left"></i>  <?php _e('Back to All Products','trizzy'); ?></a>
				<?php } ?>
			</div>
		<?php }
		} ?>
		

		<?php if ( have_posts() ) : ?>
			<?php
				/**
				 * woocommerce_before_shop_loop hook
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */

			if($shop_layout == 'full-width') {
				do_action( 'woocommerce_before_shop_loop' );
			?>
				<div class="sixteen columns full-width">
			<?php } else { ?>
				<div class="twelve columns">
			<?php do_action( 'woocommerce_before_shop_loop' );
				}
			?>
			<?php do_action( 'woocommerce_archive_description' ); ?>
			<div class="clearfix"></div>
			<?php if($shop_layout == 'full-width') { ?> </div><div class="clearfix"></div> <?php } ?>
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
			<?php if($shop_layout == 'right-sidebar') { ?><div class="columns twelve shop-search-title"> <?php } ?>
			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>
		<?php if($shop_layout != 'full-width') { ?></div> <!-- eof twelve --><?php } ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
		if($shop_layout == 'right-sidebar') { do_action( 'woocommerce_sidebar' ); }
	?>

	</div> <!-- eof contaienr -->
<?php get_footer( 'shop' ); ?>
