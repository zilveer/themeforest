<?php
/**
 * Single Product Up-Sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop, $post;
$layout         = get_post_meta($post->ID, 'pp_sidebar_layout', TRUE);
if(empty($layout)) { $layout = 'full-width'; }
$upsells = $product->get_upsells();

if ( sizeof( $upsells ) == 0 ) return;

$meta_query = WC()->query->get_meta_query();

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => $posts_per_page,
	'orderby'             => $orderby,
	'post__in'            => $upsells,
	'post__not_in'        => array( $product->id ),
	'meta_query'          => $meta_query
	);

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = '4';

if ( $products->have_posts() ) : ?>

<?php echo $layout != 'full-width' ? '<div class="twelve columns alpha omega">' : '<div class="sixteen alpha columns">'; ?>

	<h3 class="headline"><?php _e( 'You may also like&hellip;', 'trizzy' ) ?></h3>
	<span class="line margin-bottom-0"></span>
</div>
<div class="clearfix"></div>

<div class="upsells products  margin-bottom-30">

	<?php while ( $products->have_posts() ) : $products->the_post(); ?>

		<?php wc_get_template_part( 'content', 'product' ); ?>

	<?php endwhile; // end of the loop. ?>

</div>



<?php endif;

wp_reset_postdata();
