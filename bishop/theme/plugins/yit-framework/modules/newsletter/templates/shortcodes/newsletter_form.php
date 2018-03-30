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
 * Template file for newsletter form shortcode
 *
 * @package Yithemes
 * @author Antonio La Rocca <antonio.larocca@yithemes.it>
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

global $wpdb;


if( isset( $post_name ) && strcmp( $post_name, '' ) != 0 && $post_name != -1 ):
    $post_id = intval( $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_name = %s AND post_type = %s", $post_name, YIT_Newsletter()->newsletter_post_type ) ) );
    $integration = YIT_Newsletter()->get_meta( '_integration', $post_id );

    if( isset($integration) && $integration != -1 && strcmp( $integration, '' ) != 0 ):
        $method = YIT_Newsletter()->get_meta( '_method', $post_id );
        $action = YIT_Newsletter()->get_meta( '_action', $post_id );
        $email_name = YIT_Newsletter()->get_meta('_email-name', $post_id);
        $email_label = YIT_Newsletter()->get_meta('_email-label', $post_id);
        $hidden_fields = YIT_Newsletter()->get_meta('_hidden-fields', $post_id);
        $submit_label = YIT_Newsletter()->get_meta('_submit-label', $post_id);

        $shortcode = 'newsletter_form';

        $labels = array(
            'post_id',
            'method',
            'action',
            'email_name',
            'email_label',
            'hidden_fields',
            'submit_label',
            'shortcode',
            'mailchimp_list',
            'icon_form',
            'widget',
            'button_class'
        );

        $args = compact($labels);

        $is_widget = isset( $widget ) && $widget;
        ?>

<div class="newsletter-section clearfix <?php echo ( $is_widget ) ? 'newsletter-widget' : 'newsletter-shortcode' ?>">
    <p class="description">
        <?php
        if( ! $is_widget ){
            echo ( isset( $title ) && $title != '' ) ? '<span class="newsletter-form-title" style="' . ( ( isset( $title_color ) ) ? 'color: ' . $title_color . ';' : '' ) . ' ' . ( isset( $title_size ) ? 'font-size: ' . $title_size . 'px;' : '' ) . '">' . $title . '</span> ' : '';
            echo ( isset( $description ) && $description != '' ) ? '<span class="newsletter-form-description" style="' . ( ( isset( $description_color ) ) ? 'color: ' . $description_color . ';' : '' ) . ' ' . ( isset( $description_size ) ? 'font-size: ' . $description_size . 'px;' : '' ) . '">' .  $description . '</span>' : '';
        }
        ?>
    </p>
    <?php
    if( yit_plugin_locate_template( YIT_Newsletter()->plugin_path, 'newsletter-services/'.$integration.'.php' ) ){
        yit_plugin_get_template( YIT_Newsletter()->plugin_path, 'newsletter-services/'.$integration.'.php' , $args );
    }
    ?>
    <?php
    if( isset( $text ) && $text != '' ): ?>
        <p><?php echo $text ?></p>
    <?php endif;   ?>
</div>

<?php
    endif;
endif;
?>