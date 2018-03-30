<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

$enable_form = YIT_Newsletter()->get_option( 'newsletter_form_enable' );
$form_name = YIT_Newsletter()->get_option( 'newsletter_form' );
$cookie_name = YIT_Newsletter()->get_option( 'newsletter_popup_cookie_var' );
$popup_title = YIT_Newsletter()->get_option( 'newsletter_popup_title' );
$popup_image_url = YIT_Newsletter()->get_option( 'newsletter_popup_image' );
$use_image = ( $popup_image_url != "" ) ? true : false;
$popup_message = YIT_Newsletter()->get_option( 'newsletter_popup_message' );
$hiding_text = YIT_Newsletter()->get_option( 'newsletter_popup_hide_text' );
$button_class = YIT_Newsletter()->get_option( 'newsletter_button_class' );

$show_left = $use_image;

$use_wc = false;

if( function_exists( "WC" ) ){
    $enable_woocommerce = YIT_Newsletter()->get_option( 'newsletter_popup_woocommerce_integration_enable' );
    $woocommerce_product_id = YIT_Newsletter()->get_option( 'newsletter_popup_woocommerce_ids' );

    if( $enable_woocommerce == "yes" && ! empty( $woocommerce_product_id ) ){

        if( ! empty( $woocommerce_product_id ) ){
            $use_wc = true;
            $woocommerce_product = wc_get_product( $woocommerce_product_id );

            $popup_title = $woocommerce_product->get_title();
            $popup_image_url = wp_get_attachment_url(  $woocommerce_product->get_image_id() );
            $popup_message = $woocommerce_product->post->post_content;

            $product_type = $woocommerce_product->product_type;
            if( $product_type == "simple" ){
                $yit_addtocart_url = add_query_arg('add-to-cart', $woocommerce_product->id, home_url());
            }
            elseif( $product_type == 'variation' ){
                $yit_addtocart_url = add_query_arg('add-to-cart', $woocommerce_product->id, home_url());
                $yit_addtocart_url = add_query_arg('variation_id', $woocommerce_product->id, $yit_addtocart_url);
                $yit_addtocart_url = add_query_arg('product_id', $woocommerce_product->id, $yit_addtocart_url);
                $yit_addtocart_url = add_query_arg('quantity', 1, $yit_addtocart_url);

                if( !empty( $woocommerce_product->variation_data ) ) {
                    foreach( $woocommerce_product->variation_data as $attribute => $value ) {
                        $yit_addtocart_url = add_query_arg($attribute, $value, $yit_addtocart_url);
                    }
                }
            }

            $woocommerce_button_text = YIT_Newsletter()->get_option( 'newsletter_popup_woocommerce_button' );
            $popup_addtocart_text = ( ! empty ( $woocommerce_button_text ) ) ? $woocommerce_button_text : $woocommerce_product->add_to_cart_text();
        }
    }
}

$show_right = $enable_form == 'yes' || $use_wc || ( isset( $popup_message ) && $popup_message != '' );
?>
<!-- yit-newsletter-popup -->
<div class="yit-popup-container">
    <h2 id="yit-popup-title"><?php echo $popup_title;?></h2>
    <div id="yit-popup-border" class="group <?php if($use_wc): ?> woocommerce<?php endif ?>">
        <?php if( $show_left ): ?>
        <div id="yit-popup-left" class="<?php echo ( ! $show_right ) ? 'yit-popup-full' : '' ?>" >
            <figure id="yit-popup-image"><img src="<?php echo $popup_image_url;?>" alt="<?php echo $popup_title;?>" /></figure>
        </div><!-- yith-popup-left -->
        <?php endif; ?><!-- if $yith_image -->
        <?php if( $show_right ): ?>
        <div id="yit-popup-right" class="<?php echo ( $use_wc ) ? 'product ' : '' ?> <?php echo ( ! $show_left ) ? 'yit-popup-full' : '' ?>">
            <p id="yit-popup-message"><?php echo $popup_message;?></p>
            <?php if( $use_wc ): ?>
                <div class="price"><?php echo $woocommerce_product->get_price_html() ?></div>
                <div class="add_to_cart"><a class="btn btn-flat" href="<?php echo esc_url( $yit_addtocart_url ) ?>"><?php echo $popup_addtocart_text?></a></div>
            <?php elseif( $enable_form == 'yes' ): ?>
                <?php echo do_shortcode( '[newsletter_form post_name="' . $form_name . '" button_class="' . $button_class . '"]' ) ?>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <div class="yit-popup-checkzone">
            <label for="hideforever">
                <input type="checkbox" id="hideforever" name="no-view" class="no-view yith-popup-checkbox"><?php echo $hiding_text;?>
            </label>
        </div>
    </div><!-- yit-popup-border -->
    <div id="yit-popup-footer">

    </div>
</div><!-- yit-popup-container -->
<!-- END yit-newsletter-popup -->