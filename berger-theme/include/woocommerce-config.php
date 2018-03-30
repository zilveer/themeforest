<?php

add_theme_support( 'woocommerce' );
// if we want full customization remove the WC styles by uncommenting the next line
//add_filter( 'woocommerce_enqueue_styles', '__return_false' );

require_once ( get_template_directory() . '/include/woocommerce-hooks.php');

?>