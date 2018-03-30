<?php
/**
 * Cross-sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
do_action('wd_before_cross_sell');
global $woocommerce_loop, $woocommerce, $product, $smof_data;

$crosssells = WC()->cart->get_cross_sells();

if ( sizeof( $crosssells ) == 0 ) return;

$meta_query = WC()->query->get_meta_query();
$posts_per_page = 4;//absint($smof_data['wd_prod_cat_column'])>0?absint($smof_data['wd_prod_cat_column']):4;
$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'posts_per_page'      => apply_filters( 'woocommerce_cross_sells_total', $posts_per_page ),
	'no_found_rows'       => 1,
	'orderby'             => 'rand',
	'post__in'            => $crosssells,
	'meta_query'          => $meta_query
);

$products = new WP_Query( $args );

$woocommerce_loop['columns'] 	= apply_filters( 'woocommerce_cross_sells_columns', $posts_per_page );

if ( $products->have_posts() ) : ?>

	<div class="cross-sells">

		<div class="cross-sells-title"><div class="wd_title_cross_sells"><h2 class="heading-title"><?php _e( 'You may also like', 'wpdance' ) ?></h2></div></div>

		<?php woocommerce_product_loop_start(); ?>

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php wc_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // end of the loop. ?>

		<?php woocommerce_product_loop_end(); ?>

	</div>
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery(".woocommerce .cross-sells ul.products li").removeClass("col-sm-24 col-sm-12 col-sm-8 col-sm-6 col-sm-4").addClass("col-sm-6");
	});
</script>
<?php endif;
do_action('wd_after_cross_sell');
wp_reset_query();