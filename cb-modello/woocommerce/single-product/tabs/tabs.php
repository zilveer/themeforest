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
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

    <div class="tabbable tabs-left">
    <div class="row">
        <div class="col-xs-12 col-sm-3 no-margin">
            <ul class="nav nav-tabs ">

	<?php $i=1; $slash=''; foreach ( $tabs as $key => $tab ) { $i++; }
	$j=1; foreach ( $tabs as $key => $tab ) : ?>
		<?php $j++; ?>
		<li class="<?php echo $key ?>_tab <?php if($j==2) echo 'active';?>"><a href="#tab-<?php echo $key ?>" data-toggle="tab"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?>
		</a>
		</li>

		<?php endforeach; ?>
    </ul>
        </div>
    <div class="col-xs-12 col-sm-9 no-margin ">

        <!-- Tab panes -->
        <div class="tab-content ">

	<?php
    $first = true;

    foreach ( $tabs as $key => $tab ) : ?>

            <div class="tab-pane fade in <?php if($first) echo 'active';$first=false;?>" id="tab-<?php echo $key ?>">
	<?php call_user_func( $tab['callback'], $key, $tab ) ?>
	</div>

	<?php endforeach; ?>
            </div></div>
</div></div>

	<?php endif; ?>