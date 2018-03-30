<?php
/**
 * Single Product tabs
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

	<div class="pix-woocommerce-tabs">
		<ul class="pix-accordion  nav  nav--stacked">
			<?php foreach ( $tabs as $key => $tab ) : ?>

				<li class="panel  panel--<?php echo $key ?>">
					<a class="panel__title" href="#"><h3 class="hN  push-half--top  push-half--bottom  panel__title--h3"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></h3></a>
					<div class="panel__entry-content" id="tab-<?php echo $key ?>">
						<?php call_user_func( $tab['callback'], $key, $tab ); ?>
					</div>
				</li>

			<?php endforeach; ?>
		</ul>
		<hr class="separator  separator--section  hard--bottom" />
	</div>

<?php endif; ?>