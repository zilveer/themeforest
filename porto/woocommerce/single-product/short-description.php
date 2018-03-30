<?php
/**
 * Single product short description
 *
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $post;

if ( ! $post->post_excerpt ) {
    return;
}

?>
<div class="description" itemprop="description">
	<?php echo force_balance_tags( apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ) ?>
</div>