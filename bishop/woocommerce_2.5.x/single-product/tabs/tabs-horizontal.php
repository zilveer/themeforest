<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<div class="woocommerce-tabs clearfix horizontal">
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