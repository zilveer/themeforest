<?php
/**
 * Shipping Methods Display
 *
 * In 2.1 we show methods per package. This allows for multiple methods per order if so desired.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $venedor_woo_version;

?>
<tr class="shipping">
    <?php if ( version_compare($venedor_woo_version, '2.5', '<') ) : ?>
        <th><?php
            if ( $show_package_details ) {
                printf( __( 'Shipping #%d', 'woocommerce' ), $index + 1 );
            } else {
                _e( 'Shipping', 'woocommerce' );
            }
        ?></th>
        <td>
            <?php if ( ! empty( $available_methods ) ) : ?>

                <?php if ( 1 === count( $available_methods ) ) :
                    $method = current( $available_methods );

                    echo wp_kses_post( wc_cart_totals_shipping_method_label( $method ) ); ?>
                    <input type="hidden" name="shipping_method[<?php echo $index; ?>]" data-index="<?php echo $index; ?>" id="shipping_method_<?php echo $index; ?>" value="<?php echo esc_attr( $method->id ); ?>" class="shipping_method" />

                <?php elseif ( get_option( 'woocommerce_shipping_method_format' ) === 'select' ) : ?>

                    <select name="shipping_method[<?php echo $index; ?>]" data-index="<?php echo $index; ?>" id="shipping_method_<?php echo $index; ?>" class="shipping_method">
                        <?php foreach ( $available_methods as $method ) : ?>
                            <option value="<?php echo esc_attr( $method->id ); ?>" <?php selected( $method->id, $chosen_method ); ?>><?php echo wp_kses_post( wc_cart_totals_shipping_method_label( $method ) ); ?></option>
                        <?php endforeach; ?>
                    </select>

                <?php else : ?>

                    <ul id="shipping_method">
                        <?php foreach ( $available_methods as $method ) : ?>
                            <li>
                                <input type="radio" name="shipping_method[<?php echo $index; ?>]" data-index="<?php echo $index; ?>" id="shipping_method_<?php echo $index; ?>_<?php echo sanitize_title( $method->id ); ?>" value="<?php echo esc_attr( $method->id ); ?>" <?php checked( $method->id, $chosen_method ); ?> class="shipping_method" />
                                <label for="shipping_method_<?php echo $index; ?>_<?php echo sanitize_title( $method->id ); ?>"><?php echo wp_kses_post( wc_cart_totals_shipping_method_label( $method ) ); ?></label>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                <?php endif; ?>

            <?php elseif ( ( WC()->countries->get_states( WC()->customer->get_shipping_country() ) && ! WC()->customer->get_shipping_state() ) || ! WC()->customer->get_shipping_postcode() ) : ?>

                <?php if ( is_cart() && get_option( 'woocommerce_enable_shipping_calc' ) === 'yes' ) : ?>

                    <p><?php _e( 'Please use the shipping calculator to see available shipping methods.', 'woocommerce' ); ?></p>

                <?php elseif ( is_cart() ) : ?>

                    <p><?php _e( 'Please continue to the checkout and enter your full address to see if there are any available shipping methods.', 'woocommerce' ); ?></p>

                <?php else : ?>

                    <p><?php _e( 'Please fill in your details to see available shipping methods.', 'woocommerce' ); ?></p>

                <?php endif; ?>

            <?php else : ?>

                <?php if ( is_cart() ) : ?>

                    <?php echo apply_filters( 'woocommerce_cart_no_shipping_available_html',
                        '<div class="woocommerce-info alert alert-info"><p>' . __( 'There are no shipping methods available. Please double check your address, or contact us if you need any help.', 'woocommerce' ) . '</p></div>'
                    ); ?>

                <?php else : ?>

                    <?php echo apply_filters( 'woocommerce_no_shipping_available_html',
                        '<p>' . __( 'There are no shipping methods available. Please double check your address, or contact us if you need any help.', 'woocommerce' ) . '</p>'
                    ); ?>

                <?php endif; ?>

            <?php endif; ?>

            <?php if ( $show_package_details ) : ?>
                <?php
                    foreach ( $package['contents'] as $item_id => $values ) {
                        if ( $values['data']->needs_shipping() ) {
                            $product_names[] = $values['data']->get_title() . ' &times;' . $values['quantity'];
                        }
                    }

                    echo '<p class="woocommerce-shipping-contents"><small>' . __( 'Shipping', 'woocommerce' ) . ': ' . implode( ', ', $product_names ) . '</small></p>';
                ?>
            <?php endif; ?>
        </td>
    <?php else : ?>
        <th><?php echo wp_kses_post( $package_name ); ?></th>
        <td data-title="<?php echo esc_attr( $package_name ); ?>">
            <?php if ( 1 < count( $available_methods ) ) : ?>
                <ul id="shipping_method">
                    <?php foreach ( $available_methods as $method ) : ?>
                        <li>
                            <?php
                            printf( '<input type="radio" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" %4$s />
								<label for="shipping_method_%1$d_%2$s">%5$s</label>',
                                $index, sanitize_title( $method->id ), esc_attr( $method->id ), checked( $method->id, $chosen_method, false ), wc_cart_totals_shipping_method_label( $method ) );

                            do_action( 'woocommerce_after_shipping_rate', $method, $index );
                            ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php elseif ( 1 === count( $available_methods ) ) :  ?>
                <?php
                $method = current( $available_methods );
                printf( '%3$s <input type="hidden" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d" value="%2$s" class="shipping_method" />', $index, esc_attr( $method->id ), wc_cart_totals_shipping_method_label( $method ) );
                do_action( 'woocommerce_after_shipping_rate', $method, $index );
                ?>
            <?php elseif ( ! WC()->customer->has_calculated_shipping() ) : ?>
                <?php echo wpautop( __( 'Shipping costs will be calculated once you have provided your address.', 'woocommerce' ) ); ?>
            <?php else : ?>
                <?php echo apply_filters( is_cart() ? 'woocommerce_cart_no_shipping_available_html' : 'woocommerce_no_shipping_available_html', '<div class="woocommerce-info alert alert-info">'.wpautop( __( 'There are no shipping methods available. Please double check your address, or contact us if you need any help.', 'woocommerce' ) ).'</div>' ); ?>
            <?php endif; ?>

            <?php if ( $show_package_details ) : ?>
                <?php echo '<p class="woocommerce-shipping-contents"><small>' . esc_html( $package_details ) . '</small></p>'; ?>
            <?php endif; ?>
        </td>
    <?php endif; ?>
</tr>
