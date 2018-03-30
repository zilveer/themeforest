<?php
/**
 * Shop breadcrumb
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $wp_query;

$prepend      = '';
$delimiter = ' &raquo; ';
$permalinks   = get_option( 'woocommerce_permalinks' );
$shop_page_id = wc_get_page_id( 'shop' );
$shop_page    = get_post( $shop_page_id );

$wrap_before = '<div id="breadcrumb">';
$wrap_after = '</div>';
?>

<?php if ( $breadcrumb ) : ?>

	<?php echo $wrap_before; ?>

	<?php foreach ( $breadcrumb as $key => $crumb ) : ?>

		<?php echo $before; ?>

		<?php if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) : ?>
			<?php echo '<a href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a>'; ?>
		<?php else : ?>
			<?php echo esc_html( $crumb[0] ); ?>
		<?php endif; ?>

		<?php echo $after; ?>

		<?php if ( sizeof( $breadcrumb ) !== $key + 1 ) : ?>
			<?php echo $delimiter; ?>
		<?php endif; ?>

	<?php endforeach; ?>

	<?php echo $wrap_after; ?>

<?php endif; ?>
<a class="back-to" href="javascript: history.go(-1)"><?php _e('&laquo; Return to Previous Page', ETHEME_DOMAIN); ?></a>  
<div class="clear"></div>