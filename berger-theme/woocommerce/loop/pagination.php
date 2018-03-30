<?php
/**
 * Pagination - Show numbered pagination for catalog pages.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $wp_query;

if ( $wp_query->max_num_pages <= 1 ) {
	return;
}
?>

<ul class="shop-nav">
<?php if( get_previous_posts_link() ){ ?>
<li class="prev-page"><?php previous_posts_link( __('Prev Page', THEME_LANGUAGE_DOMAIN) ); ?></li>
<?php } ?>
<?php if( get_next_posts_link('', $wp_query->max_num_pages ) ){ ?>
<li class="next-page"><?php next_posts_link( __('Next Page', THEME_LANGUAGE_DOMAIN), $wp_query->max_num_pages ); ?></li>
<?php } ?>
</ul>
