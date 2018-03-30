<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;

echo '<div class="rating-price">';
wc_get_template( 'single-product/price.php' );
wc_get_template( 'single-product/rating.php' );
echo '</div>';
