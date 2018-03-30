<?php

global $sitepress;

if ( isset( $sitepress ) && ! empty( $sitepress ) ) {

    $i_accept_the = yit_icl_translate( 'theme', 'yit', 'form-place-order-accept', 'I accept the' );
    $place_fix    = yit_icl_translate( 'theme', 'yit', 'form-place-order', 'Place order' );
    $terms_fix    = yit_icl_translate( 'theme', 'yit', 'form-place-order-terms-condition', 'terms &amp; conditions' );
    $since_fix    = yit_icl_translate( 'theme', 'yit', 'form-place-order-javascript-support-advise', 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.' );

}
else {

    $i_accept_the = __( 'I accept the', 'yit' );
    $place_fix    = __( 'Place order', 'yit' );
    $terms_fix    = __( 'terms &amp; conditions', 'yit' );
    $since_fix    = __( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'yit' );

}

?>

<div class="form-row place-order">

    <noscript><?php echo $since_fix; ?>
        <br /><input type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php _e( 'Update totals', 'yit' ); ?>" />
    </noscript>

    <?php wp_nonce_field( 'woocommerce-process_checkout' )?>

    <?php do_action( 'woocommerce_review_order_before_submit' ); ?>

    <!-- <input type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="<?php echo apply_filters('woocommerce_order_button_text', $place_fix); ?>" />
  -->
    <?php
    $order_button_text = apply_filters( 'woocommerce_order_button_text', $place_fix );

    echo apply_filters( 'woocommerce_order_button_html', '<input type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '" />' );
    ?>

    <?php if ( wc_get_page_id( 'terms' ) > 0 ) : ?>
        <?php $terms_is_checked = apply_filters( 'woocommerce_terms_is_checked_default', isset( $_POST['terms'] ) ); ?>
        <p class="form-row terms">
            <label for="terms" class="checkbox"><?php echo $i_accept_the; ?>
                <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'terms' ) ) ); ?>" target="_blank"><?php echo $terms_fix; ?></a></label>
            <input type="checkbox" class="input-checkbox" name="terms" <?php checked( $terms_is_checked, true ); ?> id="terms" />
        </p>
    <?php endif; ?>

    <?php do_action( 'woocommerce_review_order_after_submit' ); ?>

</div>
