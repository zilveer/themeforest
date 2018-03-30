<?php
/**
 * Product loop title
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $post;
?>
<h2 class="card__title"><?php the_title(); ?></h2>
<div class="card__tagline"><?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ); ?></div>
