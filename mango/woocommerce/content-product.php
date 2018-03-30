<?php

/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */






if ( ! defined( 'ABSPATH' ) ) {

	exit; // Exit if accessed directly

}



global $product, $woocommerce_loop, $mango_shop_page_settings;



// Store loop count we're currently on

if ( empty( $woocommerce_loop['loop'] ) ) {

	$woocommerce_loop['loop'] = 0;

}



// Ensure visibility

if ( ! $product || ! $product->is_visible() ) {

	return;

}



// Increase loop count

$woocommerce_loop['loop']++;





// Extra post classes

$classes = array();

	$classes[] = 'mango_product product';

if($mango_shop_page_settings['mango_shop_view']=='list'){

    $classes[] = 'product-list';

if($mango_shop_page_settings['list_ver']=='list_right'){

	$classes[] = 'text-right';

}

}



?>

<?php global  $mango_settings;?>

<div <?php post_class( $classes ); ?>>



<?php

if(!is_single()){

	include('quick_view.php');

}

?>

<div class="product-top">

	<?php

		/** 

		 * QUICK VIEW

		 */

	if($mango_settings['mango_show_quick_button'])

	{

	?>

		<div class="woocommerce quick-button">

			<a class="top-line-a right  open-product btn btn-custom2  btn-xs" data-id="<?php echo the_ID();?>"><i class="fa fa-expand"></i>

			<span><?php _e('Quick View','mango')?></span>

			</a>	

		</div>	

	<?php 

	}

	?>

	<?php do_action('mango_shop_custom_action'); ?>

</div>



<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>



<div class="product-content <?php echo ($mango_shop_page_settings['mango_shop_view']=='list')?'product-list-content':''; echo ($mango_shop_page_settings['grid_ver']=="v_4")?" product-meta-box":"" ?>">

	<?php

		/**

		 * woocommerce_before_shop_loop_item_title hook

		 *

		 * @hooked woocommerce_show_product_loop_sale_flash - 10

		 * @hooked woocommerce_template_loop_product_thumbnail - 10

		 */

		do_action( 'woocommerce_before_shop_loop_item_title' );

	?>

	

	<h3 class="product-title">

		<a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a>

	</h3>



<?php

	/**

	 * woocommerce_after_shop_loop_item_title hook.

	 *

	 * @hooked woocommerce_template_loop_rating - 5

	 * @hooked woocommerce_template_loop_price - 10

	 */



	 //woocommerce_template_loop_rating();

	do_action( 'woocommerce_after_shop_loop_item_title' );

?>

</div>

	<?php



		/**

		 * woocommerce_after_shop_loop_item hook.

		 *

		 * @hooked woocommerce_template_loop_product_link_close - 5

		 * @hooked woocommerce_template_loop_add_to_cart - 10

		 */

		do_action( 'woocommerce_after_shop_loop_item' );



	?>

</div>

