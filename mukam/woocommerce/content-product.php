<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
	$classes[] = 'first';
}
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
}

$classes[] = 'featuredproduct-item';
?>
<div  <?php post_class( $classes ); ?>>
	<div class="widget-thumb">
	<?php
		if ( has_post_thumbnail() ) {

			$image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
			$image       		= get_the_post_thumbnail( $post->ID, 'full', array(
				'title' => $image_title
				) );


			$linky = get_permalink($post->ID);

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '%s',$image ), $post->ID );
			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<span class="overthumb"></span><div class="carousel-icon"><a href="%s" data-rel="prettyPhoto" class="prettyPhoto lightzoom"><i class="mukam-search"></i></a><a href="%s" class="postlink"><i class="mukam-link"></i></a></div>', $image_link, $linky ), $post->ID );

		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', woocommerce_placeholder_img_src() ), $post->ID );

		}
	?>
	</div>
	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<a href="<?php the_permalink(); ?>">

		<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			
		?>

		<h4><?php the_title(); ?></h4>
		

		

	</a>
	<?php echo $product->get_categories( ', ', '<p>' . _n( '', '', sizeof( get_the_terms( $post->ID, 'product_cat' ) ), 'woocommerce' ) . ' ', '.</p>' ); ?>
	<?php
			/**
			 * woocommerce_after_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_price - 10
			 */
			?><div class="price-rating">
							<div class="product-price"><p><?php echo $product->get_price_html(); ?>
							</p>
							</div>
							
							<?php
							if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {
							
							$average = $product->get_average_rating();
								 echo '<div class="star-rating" title="'.sprintf(__( 'Rated %s out of 5', 'woocommerce' ), $average ).'"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"></span></div>';
							}?>	
												
			  				<div class="clearfix"></div>
			  </div>
			  <div class="clearfix"></div>	
			<?php
	?>
	<div class="addtocart">
	<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
	</div>

</div>