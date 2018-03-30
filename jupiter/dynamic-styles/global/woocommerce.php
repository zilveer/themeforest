<?php

global $mk_options;

$skin_color_60 = mk_color($mk_options['skin_color'], 0.6);

Mk_Static_Files::addGlobalStyle("

.product-loading-icon
{
	background-color:{$skin_color_60};
}

.mk-woocommerce-carousel .the-title,
.mk-woocommerce-carousel .product-title {
	font-size: {$mk_options['p_size']}px !important;
	text-transform: initial;
}
.mk-product-loop.compact-layout .products .item .mk-love-holder .mk-love-this:hover span,
.mk-product-loop.compact-layout .products .item .mk-love-holder .mk-love-this:hover i{
	color: {$mk_options['skin_color']};
}
");