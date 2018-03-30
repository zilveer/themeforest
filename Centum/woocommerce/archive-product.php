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

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); 

$slider_on  = ot_get_option( 'pp_shop_slider_on' );
if ( $slider_on == 'on') {
	$layout = get_theme_mod( 'centum_layout_style', 'boxed' );
	if($layout == "wide") {
		echo '<section class="slider">'; putRevSlider(ot_get_option( 'pp_shop_revo_slider' )); echo "</section>";
	} else {
		echo '<div class="container"><div class="sixteen columns"><section class="slider">'; putRevSlider(ot_get_option( 'pp_shop_revo_slider' )); echo "</section></div></div>";
	}
}
?>
<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
<div class="container">
    <div class="sixteen columns">
     	<!-- Page Title -->
     	<div id="page-title">

        <?php $breadcrumbs = ot_get_option('centum_breadcrumbs'); 	?>
        	<h1 <?php if($breadcrumbs == 'yes') echo 'class="has-breadcrumbs"';?>><?php woocommerce_page_title(); ?></h1>

	        <?php
	        if(ot_get_option('centum_breadcrumbs') == 'yes') {
	        woocommerce_breadcrumb(array(
	           'delimiter'  => ' ',
	           'wrap_before'  => '<ul id="breadcrumbs"><li><a>Home</a></li>',
	           'wrap_after' => '</ul>',
	           'before'   => '<li class="current_element">',
	           'after'   => '</li>',
	           'home'    => null
	           ));
	        }
	        ?>
           <div id="bolded-line"></div>
       </div>
       <!-- Page Title / End -->
   	</div>
</div>
<?php endif; ?>

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
		if($shop_layout == 'left-sidebar') { do_action( 'woocommerce_sidebar' ); }
	?>
		<?php if(ot_get_option('pp_shop_search_on','off') == 'on') {
			if ( is_search() || is_tax()) { ?>
			<div class="columns twelve shop-search-title">
				<h3 class="headline"><?php echo centum_woocommerce_page_title(); ?></h3><span class="line"></span>
				<div class="clearfix"></div>
				<?php if(is_tax() || is_search()) {
					global $wp_query;
					$shop_page_id = wc_get_page_id( 'shop' ); ?>
					<a href="<?php echo get_permalink( $shop_page_id) ?>" class="back-to-shop <?php if ( $wp_query->found_posts == 1) { echo "link-up"; } ?>"><i class="fa fa-caret-left"></i>  <?php _e('Back to All Products','centum'); ?></a>
				<?php } ?>
			</div>
		<?php }
		} ?>
		<?php do_action( 'woocommerce_archive_description' ); ?>

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
				<div class="clearfix"></div>
			<?php if($shop_layout == 'full-width') { ?> </div> <?php } ?>
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
