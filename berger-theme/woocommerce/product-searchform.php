<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<?php $default_search = __("Search and type enter...", THEME_LANGUAGE_DOMAIN);  ?>
<form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
	<div id="search-margin">
    	<input type="text" value="<?php $search = get_search_query(); if( $search ) echo $search; else echo $default_search; ?>" onblur="if(this.value == '') { this.value = '<?php echo $default_search; ?>'; }" onfocus="if(this.value == '<?php echo $default_search; ?>') { this.value = ''; }" size="30" id="search-shop" name="s">
    </div>
	<input type="hidden" name="post_type" value="product" />
</form>
