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

if ( ! empty( $tabs ) ) :
    if(yit_get_sidebar_layout() != 'sidebar-no') :
        $span_class= "span".  (yit_get_option( 'shop-sidebar-width' )  != '2' ? 9 : 10);
    else :
        $span_class= "span12";
    endif;

    ?>

    <div class="woocommerce-tabs span<?php echo yit_get_sidebar_layout() == 'sidebar-no' ? 12 : ( yit_get_option( 'shop-sidebar-width' ) == '2' ? 10 : 9 ) ?>">
        <ul class="tabs">
            <?php foreach ( $tabs as $key => $tab ) : ?>

                <li class="<?php echo $key ?>_tab">
                    <a href="#tab-<?php echo $key ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', sprintf( __( '%s', 'yit' ), $tab['title'] ) , $key ) ?></a>
                </li>

            <?php endforeach; ?>
        </ul>
        <?php /* 2013.09.06 - SkyVerge, Inc. template modification to hide all but the first tab panel to improve page load appearance */ ?>
        <?php $first = true; ?>
        <?php foreach ( $tabs as $key => $tab ) : ?>

            <div class="panel entry-content" id="tab-<?php echo $key ?>" <?php echo ! $first ? 'style="display:none;"' : ''; $first = false; ?>>
                <?php call_user_func( $tab['callback'], $key, $tab ) ?>
            </div>

        <?php endforeach; ?>
    </div>

<?php endif; ?>
