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
 * Template file for custom newsletter form
 *
 * @package Yithemes
 * @author Antonio La Rocca <antonio.larocca@yithemes.it>
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly


$show_placeholder   = apply_filters( 'yit_show_placeholder', ( $shortcode == 'newsletter_cta' ), $shortcode  );
$placeholder        = ($show_placeholder ) ? 'placeholder="' . $email_label . '"' : '';
$button_class       = ( isset( $button_class ) && $button_class != '' ) ? $button_class : apply_filters( 'yit_newsletter_button_style', 'btn-alternative' );
$sc_type            = ( isset( $widget ) && $widget ) ? 'widget' : 'shortcode';
?>

<form method="<?php echo $method?>" action="<?php echo $action?>">
    <fieldset>
        <ul class="group">
            <li>
                <?php
                if( $shortcode == 'newsletter_form' ):
                ?>
                <label for="<?php echo $email_name ?>"><?php echo $email_label?></label>
                <?php
                endif;
                ?>
                <div class="newsletter_form_email">
                    <input type="text" <?php echo $placeholder ?> name="<?php echo $email_name ?>" id="<?php echo $email_name ?>" class="email-field text-field <?php echo empty( $icon_form ) ? 'no-icon' : '';?> autoclear" />
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
                <?php
                if ( $hidden_fields != '' ) {
                    $hidden_fields = explode( '&', $hidden_fields );
                    foreach ( $hidden_fields as $field ) {
                        list( $id_field, $value_field ) = explode( '=', $field );
                        echo '<input type="hidden" name="' . $id_field . '" value="' . $value_field . '" />';
                    }
                }
                ?>
                <input type="submit" class="btn submit-field <?php echo $button_class ?>" value="<?php echo $submit_label?>" />
            </li>
        </ul>
    </fieldset>
</form>
