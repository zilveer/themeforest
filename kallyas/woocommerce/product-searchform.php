<?php if(! defined('ABSPATH')){ return; }
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

<div class=" kl-gensearch--<?php echo zget_option( 'zn_main_style', 'color_options', false, 'light' ); ?>">
	<form method="get" class="woocommerce-product-search gensearch__form" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
		<label class="screen-reader-text" for="s"><?php _e( 'Search for:', 'zn_framework' ); ?></label>
		<input type="search" class="search-field inputbox gensearch__input" placeholder="<?php echo esc_attr_x( 'Search Products&hellip;', 'placeholder', 'zn_framework' ); ?>" value="<?php echo get_search_query(); ?>" name="s" id="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'zn_framework' ); ?>" />
		<button type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'zn_framework' ); ?>" class="gensearch__submit glyphicon glyphicon-search"></button>
		<input type="hidden" name="post_type" value="product" />
	</form>
</div>
