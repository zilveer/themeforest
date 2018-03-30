<?php
	/**
	 * The template for displaying product category thumbnails within loops.
	 *
	 * Override this template by copying it to yourtheme/woocommerce/content-product_cat.php
	 *
	 * @author 		WooThemes
	 * @package 	WooCommerce/Templates
	 * @version     2.6.1
	 */
	
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
	global $woocommerce_loop, $sidebars;
	
	// Store loop count we're currently on
	if ( empty( $woocommerce_loop['loop'] ) ) {
		$woocommerce_loop['loop'] = 0;
	}
	
	if ( empty( $woocommerce_loop['columns'] ) ) {
		global $sidebars;
		$columns = 4;
		
		if ( $sidebars == "no-sidebars" || is_singular('portfolio') ) {
			$columns = 4;
		} else if ( $sidebars == "both-sidebars" ) {
			$columns = 2;
		} else {
			$columns = 3;
		}
		$woocommerce_loop['columns'] = $columns;
	}

    // Classes
    $classes = array();
    
    if ( version_compare( WOOCOMMERCE_VERSION, "2.6.0" ) < 0 ) {
    	// Increase loop count
    	$woocommerce_loop['loop']++;
    	
    	// Extra post classes
    	if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
    		$classes[] = 'first';
    	if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
    		$classes[] = 'last';
    }
    
?>
<li <?php wc_product_cat_class( $classes, $category ); ?>>

	<?php do_action( 'woocommerce_before_subcategory', $category ); ?>

	<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">

		<?php
			/**
			 * woocommerce_before_subcategory_title hook
			 *
			 * @hooked woocommerce_subcategory_thumbnail - 10
			 */
			do_action( 'woocommerce_before_subcategory_title', $category );
		?>
		
		<div class="product-cat-info">
			
			<h3><?php echo $category->name; ?></h3>
	
			<?php if ( $category->count > 0 ) {
				echo apply_filters( 'woocommerce_subcategory_count_html', ' <span class="count">' . $category->count . ' '. __("items", "swiftframework") . '</span>', $category );
				}
			?>
			
		</div>

		<?php
			/**
			 * woocommerce_after_subcategory_title hook
			 */
			do_action( 'woocommerce_after_subcategory_title', $category );
		?>

	</a>

	<?php do_action( 'woocommerce_after_subcategory', $category ); ?>

</li>