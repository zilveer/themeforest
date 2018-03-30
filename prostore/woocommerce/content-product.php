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
 * @sub-package WooCommerce/Templates/content-product.php
 * @file		1.0
 * @file(Woo)	1.6.4
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
	
	$overlay = $data[$prefix."woocommerce_product_overlay"];
	$overlay_resp = $data[$prefix."woocommerce_responsive_overlay"];
?>

<li class="product <?php
	if ( $woocommerce_loop['loop'] % $woocommerce_loop['columns'] == 0 )
		echo 'last';
	elseif ( ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] == 0 )
		echo 'first';
	?>">

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
	
	<a href="<?php the_permalink(); ?>">
		<?php
			do_action( 'woocommerce_before_shop_loop_item_title' );
		?>
	</a>
	
	<?php if ($overlay !="1") { ?>
		<?php if ($overlay_resp=="1") { ?>
			<div class="hide-for-small">
		<?php } ?>
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<?php 
					if($data[$prefix."woocommerce_product_desc"]=="1") echo the_excerpt(); ?>
				<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
		<?php if ($overlay_resp=="1") { ?>
			</div>
			<div class="overlay overlay-responsive">
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>				
			</div>
		<?php } ?>
	<?php } else { ?>	
		<div class="overlay">
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
		</div>
	<?php } ?>
	
	<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>

</li>