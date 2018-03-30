<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$first_opened = yit_get_option( 'shop-products-tab-first-opened', 'no' );
?>

<div class="single-product-tabs vertical">
    <ul class="tabs">
        <?php foreach ( $tabs as $key => $tab ) : ?>

            <li class="<?php echo $key ?>_tab">
                <div class="tab_name<?php if ( $first_opened == 'yes' ) echo ' active' ?>">
                    <h4>
                        <?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?>
                        <span class="fa fa-plus"></span>
                    </h4>
                </div>
                <div class="panel entry-content" id="tab-<?php echo $key ?>"<?php if ( $first_opened == 'yes' ) echo ' style="display: block;"' ?>">
                    <?php call_user_func( $tab['callback'], $key, $tab ) ?>
                </div>
            </li>

        <?php $first_opened = 'no'; endforeach; ?>
    </ul>

</div>