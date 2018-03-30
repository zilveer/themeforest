<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 9/25/2015
 * Time: 3:15 PM
 */
if (in_array('yith-woocommerce-wishlist/init.php', apply_filters('active_plugins', get_option('active_plugins'))) && (get_option( 'yith_wcwl_enabled' ) == 'yes')) {
	echo do_shortcode('[yith_wcwl_add_to_wishlist]');
}


