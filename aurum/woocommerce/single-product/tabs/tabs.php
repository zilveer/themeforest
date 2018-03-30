<?php
/**
 * Single Product tabs
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

/* Note: This file has been altered by Laborator */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );


# start: modified by Arlind Nushi
global $cpage;

$tabs_keys = array_keys($tabs);
$active_tab = reset($tabs_keys);
#$active_tab = array_keys($tabs)[2];

if(isset($cpage))
	$active_tab = 'reviews';
# end: modified by Arlind Nushi

if ( ! empty( $tabs ) ) : ?>

	<div class="tabs">
		<ul class="nav nav-tabs">
			<?php foreach ( $tabs as $key => $tab ) : ?>

				<li class="<?php echo esc_attr( $key ) ?>_tab<?php echo $key == $active_tab ? ' active' : ''; ?>">
					<a href="#tab-<?php echo esc_attr( $key ) ?>" data-toggle="tab"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
				</li>

			<?php endforeach; ?>
		</ul>

		<div class="tab-content">
		<?php foreach ( $tabs as $key => $tab ) : ?>

			<div class="entry-content in fade tab-pane<?php echo $key == $active_tab ? ' active' : ''; ?>" id="tab-<?php echo esc_attr( $key ); ?>">
				<?php call_user_func( $tab['callback'], $key, $tab ) ?>
			</div>

		<?php endforeach; ?>
		</div>
	</div>

<?php endif; ?>