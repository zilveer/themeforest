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
 * @package 	proStore/woocommerce/single-product/up-sells.php
 * @sub-package WooCommerce/Templates/single-product/up-sells.php
 * @file		1.0
 * @file(Woo)	1.6.4
 */
?>
<?php global $product, $woocommerce_loop; ?>

<?php

$upsells = $product->get_upsells();

if ( sizeof( $upsells ) == 0 ) return;

$args = array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'posts_per_page' 		=> 4,
	'no_found_rows' 		=> 1,
	'orderby' 				=> 'rand',
	'post__in' 				=> $upsells
);

$products = new WP_Query( $args );

if ( $products->have_posts() ) : 

	$usID = "slider" . dechex(time()).dechex(mt_rand(1,65535));
	
	?>

	<section class="slider">
		<div class="flexslider" id="<?php echo $usID; ?>">
			<ul class="slides">
				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

					<?php woocommerce_get_template_part( 'content', 'related' ); ?>

				<?php endwhile; // end of the loop. ?>
			</ul>
		</div>
	</section>

	<?php
		$params = array($usID,'2');
		print_carousel_script($params);

endif;

wp_reset_postdata();