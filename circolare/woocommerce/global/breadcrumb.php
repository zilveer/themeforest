<?php
/**
 * Shop breadcrumb
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $wp_query, $author;

$prepend      = '';
$delimiter = '<span class="sep">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
$permalinks   = get_option( 'woocommerce_permalinks' );
$shop_page_id = wc_get_page_id( 'shop' );
$shop_page    = get_post( $shop_page_id );
$before = "<li>";
$after = "</li>";

?>
<div class="general-block-outer">
<div class="general-block breadcrumbs">
	
<?php if ( $breadcrumb ) : ?>

	<?php echo $wrap_before; ?>
	<ul class="breadcrumbs">
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

	</ul><?php echo $wrap_after; ?><div class="clear"></div></div></div>

<?php endif; ?>