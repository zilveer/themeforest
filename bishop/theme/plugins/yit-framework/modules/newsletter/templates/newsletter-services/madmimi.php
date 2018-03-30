<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Template file for mailchimp subscription form
 *
 * @package Yithemes
 * @author Antonio La Rocca <antonio.larocca@yithemes.it>
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly
$button_class = ( isset( $button_class ) && $button_class != '' ) ? $button_class : 'btn-alternative';
$sc_type      = ( isset( $widget ) && $widget ) ? 'widget' : 'shortcode';
$button_text = ( YIT_Newsletter()->get_meta( '_madmimi-submit-label', $post_id ) != '' ) ? YIT_Newsletter()->get_meta( '_madmimi-submit-label', $post_id ) : __( 'Submit', 'yit' );
?>

<div class="message-box"></div>
<form method="post" action="#">
    <fieldset>
        <ul class="group">
            <li>
                <?php
                if($shortcode == 'newsletter_form'):
                    ?>
                    <label for="yit_madmimi_newsletter_form_email"><?php _e( 'Email', 'yit' ) ?></label>
                <?php
                endif;
                ?>
                <div class="newsletter_form_email">
                    <input type="text" <?php echo ( $shortcode == 'newsletter_cta' ) ? 'placeholder="' . __( 'Email', 'yit' ) . '"' : ''?> name="yit_madmimi_newsletter_form_email" id="yit_madmimi_newsletter_form_email" class="email-field text-field <?php echo empty( $icon_form ) ? 'no-icon' : '';?> autoclear" />
                    <?php if( isset( $icon_form ) && $icon_form != '-1' ):
                        if( strpos( $icon_form, ':' )  ){
                                $icon_data = YIT_Plugin_Common::get_icon( $icon_form );
                                $icon = '<span class="mail-icon-' . $sc_type . '" ' . $icon_data . '></span>';
                            }
                        elseif( ! empty( $icon_form ) ) {
                            $icon  = '<span class="fa fa-'. $icon_form .' mail-icon-' . $sc_type . '"></span>';
                            $icon .= '<style>.mail-icon-' . $sc_type . ':before { content: "\\' . $icon_form . '"; }</style>';
                        }

                        echo ! empty( $icon ) ? $icon : '';
                    endif; ?>
                </div>
            </li>
            <li>
                <input type="hidden" name="yit_madmimi_newsletter_form_id" value="<?php echo $post_id?>"/>
                <input type="hidden" name="action" value="subscribe_madmimi_user"/>
                <?php wp_nonce_field( 'yit_madmimi_newsletter_form_nonce', 'yit_madmimi_newsletter_form_nonce'); ?>
                <input class="button btn submit-field madmimi-subscription-ajax-submit <?php echo $button_class ?>" type="button" value="<?php echo $button_text ?>" />
            </li>
        </ul>
    </fieldset>
</form>

<?php
yit_enqueue_script( 'yit-madmimi-ajax-send-form', YIT_Newsletter()->plugin_assets_url.'/js/madmimi-ajax-subscribe.js', array( 'jquery' ), '', true);
wp_localize_script( 'yit-madmimi-ajax-send-form', 'madmimi_localization', array( 'url' => admin_url( 'admin-ajax.php' ), 'error_message' => 'Ops! Something went wrong' ) );
?>
