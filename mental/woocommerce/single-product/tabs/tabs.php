<?php
/**
 * Single Product tabs
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

	<div class="woocommerce-tabs">

		<ul class="nav nav-tabs" role="tablist">
			<?php $i=0; foreach ( $tabs as $key => $tab ) : ?>

				<li class="<?php echo esc_attr($key) ?>_tab <?php echo (0 == $i ? 'active':'') ?>">
					<a href="#tab-<?php echo esc_attr($key) ?>" role="tab" data-toggle="tab"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></a>
				</li>

			<?php $i++; endforeach; ?>
		</ul>

		<div class="tab-content">
			<?php $i=0; foreach ( $tabs as $key => $tab ) : ?>

				<div class="tab-pane <?php echo (0 == $i ? 'active':'') ?>" id="tab-<?php echo esc_html($key); ?>">
					<?php call_user_func( $tab['callback'], $key, $tab ) ?>
				</div>

			<?php $i++; endforeach; ?>
		</div>
	</div>

<?php endif; ?>