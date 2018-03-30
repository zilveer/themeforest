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
 * Template file for show a message with newsletter subscription
 *
 * @package Yithemes
 * @author Francesco Licandro <francesco.licandro@yithemes.com>
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

global $wpdb;

//$icon_form = ( isset ( $icon_form ) ) ? $icon_form : 'f003';

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
        $email_name = str_replace( array( '&#91;', '&#93;' ), array( '[', ']' ), $email_name );

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
?>

<div class="call-three">

    <div class="newsletter-cta-form-container">

	<?php
	$center = '';
	if ( (isset($title) && $title != '') || (isset($incipit) && $incipit != '') ) :
    ?>

    <div class="text">
        <?php if ( isset($title) && $title != '' ) : ?><span class="newsletter-cta-title" style="<?php echo ( isset( $title_color ) ? 'color: ' . $title_color . ';' : '' )?> <?php echo ( isset( $title_size ) ? 'font-size: ' . $title_size . 'px;' : '' )?>"><?php echo $title ?></span><?php endif ?>
        <?php if ( isset($incipit) && $incipit != '' ) : ?><span class="newsletter-cta-incipit" style="<?php echo ( isset( $incipit_color ) ? 'color: ' . $incipit_color . ';' : '' )?> <?php echo ( isset( $incipit_size ) ? 'font-size: ' . $incipit_size . 'px;' : '' )?>"><?php echo $incipit ?></span><?php endif ?>
    </div>

	<?php
    else :
		$center= 'newsletter-call3-center';
	endif
    ?>

	<div class="newsletter-call3 <?php echo $center ?> clearfix">
        <?php
        if( yit_plugin_locate_template( YIT_Newsletter()->plugin_path, 'newsletter-services/'.$integration.'.php' ) ){
            yit_plugin_get_template( YIT_Newsletter()->plugin_path, 'newsletter-services/'.$integration.'.php' , $args );
        }
        ?>
	</div>
	<div class="clear"></div>

    </div>

</div>
<?php
    endif;
endif;
?>