<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
 
global $woocommerce_loop, $shopkeeper_theme_options;
?>

<?php

$products_per_column_xlarge = 6;
$products_per_column_large = 4;
$products_per_column_medium = 3;

if ( ( isset($woocommerce_loop['columns']) && $woocommerce_loop['columns'] != "" ) ) {
	$products_per_column = $woocommerce_loop['columns'];
} else {
	if ( ( !isset($shopkeeper_theme_options['products_per_column']) ) ) {
		$products_per_column = 4;
	} else {
		$products_per_column = $shopkeeper_theme_options['products_per_column'];
		
        if (isset($_GET["products_per_row"])) $products_per_column = $_GET["products_per_row"];
	}
}

if ($products_per_column == 6) {
	$products_per_column_xlarge = 6;
	$products_per_column_large = 4;
	$products_per_column_medium = 3;
}

if ($products_per_column == 5) {
	$products_per_column_xlarge = 5;
	$products_per_column_large = 4;
	$products_per_column_medium = 3;
}

if ($products_per_column == 4) {
	$products_per_column_xlarge = 4;
	$products_per_column_large = 4;
	$products_per_column_medium = 3;
}

if ($products_per_column == 3) {
	$products_per_column_xlarge = 3;
	$products_per_column_large = 3;
	$products_per_column_medium = 2;
}

if ($products_per_column == 2) {
	$products_per_column_xlarge = 2;
	$products_per_column_large = 2;
	$products_per_column_medium = 2;
}

?>

<div class="row">
	<div class="large-12 columns">
		<ul id="products-grid" class="products products-grid small-block-grid-2 medium-block-grid-<?php echo $products_per_column_medium; ?> large-block-grid-<?php echo $products_per_column_large; ?> xlarge-block-grid-<?php echo $products_per_column_xlarge; ?> xxlarge-block-grid-<?php echo $products_per_column; ?> columns-<?php echo $products_per_column; ?>">