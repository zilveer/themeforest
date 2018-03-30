<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
function sf_add_desc_tab($tabs = array()) {
	global $post;
	$product_description = sf_get_post_meta($post->ID, 'sf_product_description', true);
	if ($product_description != "") {
		$tabs['description'] = array(
			'title'    => __( 'Description', 'swiftframework' ),
			'priority' => 10,
			'callback' => 'woocommerce_product_description_tab'
		);
	}
	return $tabs;
}
add_filter('woocommerce_product_tabs', 'sf_add_desc_tab', 0);
 
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

	<div class="woocommerce-tabs wc-tabs-wrapper">
		<ul class="tabs wc-tabs">
			<?php foreach ( $tabs as $key => $tab ) : ?>
				
				<?php if (isset($tab['title'])) { ?>
				
				<li class="<?php echo esc_attr( $key ); ?>_tab">
					<a href="#tab-<?php echo esc_attr( $key ); ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
				</li>
				
				<?php } ?>

			<?php endforeach; ?>
		</ul>
		<?php foreach ( $tabs as $key => $tab ) : ?>
		
			<?php if (isset($tab['callback'])) { ?>

			<div class="panel entry-content" id="tab-<?php echo esc_attr($key); ?>">
				<?php call_user_func( $tab['callback'], $key, $tab ) ?>
			</div>
			
			<?php } ?>

		<?php endforeach; ?>
	</div>

<?php endif; ?>