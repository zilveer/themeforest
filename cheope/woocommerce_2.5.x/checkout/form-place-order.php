

		<div class="form-row place-order">

			<noscript><?php _e('Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'yit'); ?><br/><input type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php _e('Update totals', 'yit'); ?>" /></noscript>

			<?php wp_nonce_field('woocommerce-process_checkout')?>

			<?php do_action( 'woocommerce_review_order_before_submit' ); ?>

            <?php if( yit_get_option('shop-checkout-multistep') ) : ?>
            <input type="submit" class="button prev" name="login" value="<?php _e('&larr; Payment Method', 'yit'); ?>" data-next="4" />
            <?php endif ?>

            <?php if (wc_get_page_id('terms')>0 && !yit_get_option('shop-checkout-multistep') ) : ?>
                <p class="form-row terms">
                    <label for="terms" class="checkbox"><?php _e('I accept the', 'yit'); ?> <a href="<?php echo esc_url( get_permalink(wc_get_page_id('terms')) ); ?>" target="_blank"><?php _e('terms &amp; conditions', 'yit'); ?></a></label>
                    <input type="checkbox" class="input-checkbox" name="terms" <?php if (isset($_POST['terms'])) echo 'checked="checked"'; ?> id="terms" />
                </p>
            <?php endif; ?>

            <?php
            $order_button_text = apply_filters( 'woocommerce_order_button_text', __( 'Place order', 'yit' ) );

            echo apply_filters( 'woocommerce_order_button_html', '<input type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '" />' );
            ?>

            <?php if( !yit_get_option('shop-checkout-multistep') ) { echo '<div class="clear space"></div>'; } ?>

            <?php if (wc_get_page_id('terms')>0 && yit_get_option('shop-checkout-multistep') ) : ?>
                <p class="form-row terms">
                    <label for="terms" class="checkbox"><?php _e('I accept the', 'yit'); ?> <a href="<?php echo esc_url( get_permalink(wc_get_page_id('terms')) ); ?>" target="_blank"><?php _e('terms &amp; conditions', 'yit'); ?></a></label>
                    <input type="checkbox" class="input-checkbox" name="terms" <?php if (isset($_POST['terms'])) echo 'checked="checked"'; ?> id="terms" />
                </p>
            <?php endif; ?>

			<?php do_action( 'woocommerce_review_order_after_submit' ); ?>

		</div>
