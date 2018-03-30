<?php
/**
 * My Orders
 *
 * Shows recent orders on the account page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

$downloads = WC()->customer->get_downloadable_products();

if ( empty( $downloads ) ) { ?>

    <p><?php _e( 'There are not available downloads.', 'yit' ); ?></p>

<?php } else { ?>

    <h2><?php echo apply_filters( 'woocommerce_my_account_my_downloads_title', __( 'Available downloads', 'yit' ) ); ?></h2>

    <ul class="digital-downloads">
        <?php foreach ( $downloads as $download ) : ?>
            <li>
                <?php
                do_action( 'woocommerce_available_download_start', $download );

                if ( is_numeric( $download['downloads_remaining'] ) ) {
                    echo apply_filters( 'woocommerce_available_download_count', '<span class="count">' . sprintf( _n( '%s download remaining', '%s downloads remaining', $download['downloads_remaining'], 'yit' ), $download['downloads_remaining'] ) . '</span> ', $download );
                }
                echo "<span class='fa fa-download'></span>";

                echo apply_filters( 'woocommerce_available_download_link', '<a href="' . esc_url( $download['download_url'] ) . '">' . $download['download_name'] . '</a>', $download );

                do_action( 'woocommerce_available_download_end', $download );
                ?>
            </li>
        <?php endforeach; ?>
    </ul>

<?php } ?>