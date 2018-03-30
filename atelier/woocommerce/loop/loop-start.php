<?php
	/**
	* Product Loop Start
	*
	* @author 		WooThemes
	* @package 	WooCommerce/Templates
	* @version     2.0.0
	*/
	
	global $sf_options, $sf_product_multimasonry;
	$product_multi_masonry = $sf_options['product_multi_masonry'];
	$product_display_type = $sf_options['product_display_type'];
	$product_display_gutters = $sf_options['product_display_gutters'];
	
	// GET VARIABLES
	if ( isset($_GET['product_display']) ) {
		$product_display_type = $_GET['product_display'];
	}
	if ( isset($_GET['product_gutters']) ) {
		$product_display_gutters = $_GET['product_gutters'];
	}
	
	$list_class = "";
	
	if ( $product_multi_masonry ) {
		$list_class .= 'multi-masonry-items';
		$sf_product_multimasonry = true;
	} else {
		$list_class .= 'product-grid';
		$sf_product_multimasonry = false;
	}

?>
<?php if (!$product_display_gutters && ($product_display_type == "gallery" || $product_display_type == "gallery-bordered" || $product_multi_masonry)) { ?>
	<ul id="products" class="products <?php echo esc_attr($list_class); ?> no-gutters clearfix">
<?php } else { ?>
	<ul id="products" class="products <?php echo esc_attr($list_class); ?> gutters row clearfix">
<?php } ?>

		<?php if ( $product_multi_masonry ) { ?>
    		<div class="clearfix product col-sm-3 grid-sizer"></div>
    	<?php } ?>