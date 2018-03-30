<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/woocommerce/single-product/related.php
 * @sub-package WooCommerce/Templates/single-product/related.php
 * @file		1.0
 * @file(Woo)	1.6.4
 */
?>
<?php global $product, $woocommerce_loop; ?>

<?php

$upsells = $product->get_upsells();

$related = $product->get_related();

if ( sizeof($related) == 0 ) return;

$args = apply_filters('woocommerce_related_products_args', array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'no_found_rows' 		=> 1,
	'posts_per_page' 		=> $posts_per_page,
	'orderby' 				=> $orderby,
	'post__in' 				=> $related
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) :

	$rpID = "slider" . dechex(time()).dechex(mt_rand(1,65535));

	?>

	<section class="slider">
		<div class="flexslider" id="<?php echo $rpID; ?>">
			<ul class="slides">
				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

					<?php woocommerce_get_template_part( 'content', 'related' ); ?>

				<?php endwhile; // end of the loop. ?>
			</ul>
		</div>
	</section>

	<?php
	$number="2";
	if ( sizeof($related) == 0 || sizeof( $upsells) == 0 || $data[$prefix."woocommerce_product_related"]!="1" || $data[$prefix."woocommerce_product_maylike"]!="1") {
		$number="4";
	}

	$params = array($rpID,$number);
	print_carousel_script($params);

endif;
wp_reset_postdata();
