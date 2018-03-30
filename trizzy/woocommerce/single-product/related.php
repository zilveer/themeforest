<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop, $post;
$layout         = get_post_meta($post->ID, 'pp_sidebar_layout', TRUE);
if(empty($layout)) { $layout = 'full-width'; }

$related = $product->get_related( $posts_per_page );

if ( sizeof( $related ) == 0 ) return;

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => $posts_per_page,
	'orderby'              => $orderby,
	'post__in'             => $related,
	'post__not_in'         => array( $product->id )
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) : ?>
<?php echo $layout != 'full-width' ? '<div class="twelve columns alpha omega">' : '<div class="sixteen alpha columns">'; ?>
	<h3 class="headline"><?php _e( 'Related Products', 'trizzy' ); ?></h3>
	<span class="line margin-bottom-0"></span>
</div>
<div class="clearfix"></div>

	<div class="related products">
		<?php while ( $products->have_posts() ) : $products->the_post(); ?>
			<?php wc_get_template_part( 'content', 'product' ); ?>
		<?php endwhile; // end of the loop. ?>
	</div>
<?php endif;

wp_reset_postdata();
