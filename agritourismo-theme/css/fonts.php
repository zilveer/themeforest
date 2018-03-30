<?php
	header("Content-type: text/css");
	require_once('../../../../wp-load.php');
	//fonts
	$google_font_1 = get_option(THEME_NAME."_google_font_1");
	$google_font_2 = get_option(THEME_NAME."_google_font_2");


	//fonts size
	$font_size_1 = get_option(THEME_NAME."_font_size_1");


?>



/* Main Menu Font */
.main-menu ul li > a {
	font-family: "<?php echo $google_font_1;?>", serif;
	font-size: <?php echo $font_size_1;?>px;
}

/* Titles Font */
.main-block.big-error strong,
.woocommerce-tabs .tabs li,
.summary .amount,
.price-block .price,
.widget-event .event-wdget-date,
.accordion > div > a,
.menu-cart
.subtotal .subtotal-amount,
.menu-cart > div i,
.menu-cart strong,
h1, h2, h3, h4, h5, h6,
.content .main-title span,
.coupon .coupon-content b,
.widget ul li a,
.user-nick a,
.user-nick i,
#wp-calendar caption,
.widget-product .product-content span.price,
.price-range-content #amount {
	font-family: "<?php echo $google_font_2;?>", sans-serif;
}

