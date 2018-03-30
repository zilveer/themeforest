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
 * @package 	proStore/woocommerce/content-product.php
 * @sub-package
 * @file	 	1.0
 * @file(Woo)
 */
?>
<?php
	global $product, $woocommerce_loop, $data, $prefix;

	if ( empty( $woocommerce_loop['loop'] ) )
		$woocommerce_loop['loop'] = 0;

	if ( empty( $woocommerce_loop['columns'] ) )
		$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

	if ( ! $product->is_visible() )
		return;

	$woocommerce_loop['loop']++;

	$overlay = $data[$prefix."woocommerce_product_related_overlay"];
?>
<li class="product-related">

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<a href="<?php the_permalink(); ?>">
		<?php
			//do_action( 'woocommerce_before_shop_loop_item_title' );

			$thumb = featured_image_link_relatedp($post->ID);
			echo '<img src="'.$thumb.'" alt="'.get_the_title().'" title="'.get_the_title().'" width="400" height="400" />';
		?>
	</a>

	<?php
		if($overlay == "1") {
			echo '<div class="overlay">';
		}
	?>
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

		<?php
			do_action( 'woocommerce_after_shop_loop_item_title' );
		?>

	<?php
		if($overlay == "1") {
			echo '</div>';
		}
	?>

	<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>

</li>