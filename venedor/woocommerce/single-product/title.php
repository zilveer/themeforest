<?php
/**
 * Single Product title
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $venedor_quickview;
if ( !isset($venedor_quickview) ) : ?>
<h1 itemprop="name" class="product_title"><?php the_title(); ?></h1>
<?php else : ?>
<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><h1 itemprop="name" class="product_title"><?php the_title(); ?></h1></a>
<?php endif; ?>