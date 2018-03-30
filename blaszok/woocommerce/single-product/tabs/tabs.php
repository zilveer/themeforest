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

global $mpcth_options;
/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$defaults = array('description' => array(
		'title'    => __( 'Description', 'woocommerce' ),
		'priority' => 10,
		'callback' => 'woocommerce_product_description_tab'
	));
$tabs = apply_filters( 'woocommerce_product_tabs', $defaults );

$swap_tabs_to_accordion = isset($mpcth_options['mpcth_product_accordions']) && $mpcth_options['mpcth_product_accordions'];
$first_accordion = true;

if ( ! empty( $tabs ) ) : ?>

	<?php if ($swap_tabs_to_accordion) { ?>
		<div class="woocommerce-tabs woocommerce-accordions">
			<ul class="tabs">
				<?php foreach ( $tabs as $key => $tab ) : ?>

					<li class="<?php echo $key ?>_tab">
						<a href="#tab-<?php echo $key ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></a>
					</li>

				<?php endforeach; ?>
			</ul>
			<?php foreach ( $tabs as $key => $tab ) : ?>
				<h6 class="<?php echo $key ?>_tab <?php echo $first_accordion ? 'active' : ''; ?>">
					<a href="#tab-<?php echo $key ?>">
						<span>
							<?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?>
						</span>
						<i class="fa fa-fw fa-angle-down"></i>
						<i class="fa fa-fw fa-angle-up"></i>
					</a>
				</h6>

				<div class="panel entry-content" id="tab-<?php echo $key ?>">
					<?php call_user_func( $tab['callback'], $key, $tab ) ?>
				</div>

				<?php $first_accordion = false; ?>
			<?php endforeach; ?>
		</div>
	<?php } else { ?>
		<div class="woocommerce-tabs">
			<ul class="tabs">
				<?php foreach ( $tabs as $key => $tab ) : ?>

					<li class="<?php echo $key ?>_tab">
						<a href="#tab-<?php echo $key ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></a>
					</li>

				<?php endforeach; ?>
			</ul>
			<?php foreach ( $tabs as $key => $tab ) : ?>

				<div class="panel entry-content" id="tab-<?php echo $key ?>">
					<?php call_user_func( $tab['callback'], $key, $tab ) ?>
				</div>

			<?php endforeach; ?>
		</div>
	<?php } ?>

<?php endif; ?>