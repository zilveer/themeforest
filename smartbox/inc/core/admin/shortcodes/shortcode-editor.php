<?php
/**
 * Creates the shortcode popup dialog screen
 *
 * @package Smartbox
 * @subpackage Core
 * @since 1.0
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.5.8
 */

if ( !defined('ABSPATH') )
    die('You are not allowed to call this page directly.');

$shortcode_options = include_once ADMIN_SC_DIR . 'shortcode-options.php';

// create nonce for preview
$nonce = wp_create_nonce( 'oxy-preview-nonce' );
// create preview url
global $blog_id;
$preview_url = get_home_url( $blog_id, 'wp-admin/admin-ajax.php?_ajax_nonce=' . $nonce . '&action=oxy_shortcode_preview&sc=' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php do_action('admin_xml_ns'); ?> <?php language_attributes(); ?>>
    <head>
        <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
        <?php if( 'true' == $_GET['MCE'] ) : ?>
        <script type="text/javascript" src="<?php echo includes_url( 'js/tinymce/tiny_mce_popup.js' ); ?>?ver=342"></script>
        <?php endif; ?>
        <?php
        do_action('admin_enqueue_scripts');
        do_action('admin_print_styles');
        do_action('admin_print_scripts');
        do_action('admin_head');
        ?>
        <script type="text/javascript" charset="utf-8">
            var hasMCE = typeof( tinyMCEPopup ) !== 'undefined';
            function closeWindow() {
                if( hasMCE ) {
                    tinyMCEPopup.close();
                }
                else {
                    var win = window.dialogArguments || opener || parent || top;
                    win.tb_remove();
                }
            }

            var updateThrottle = null;
            jQuery(document).ready( function() {
                // setup shortcode generator
                jQuery( '#shortcode_form' ).scGenerator();
                // add close window code
                jQuery( '#cancel' ).click( closeWindow );
                // straight change update for form elements
                jQuery( 'select,input[type=radio],input[type=hidden]' ).not('.font-option').change( updatePreview );
                // text based updates need to be throttled
                jQuery( 'textarea,input[type=text]' ).on('keyup', throttledUpdatePreview );
                jQuery( '.slider-option,.colour-option,.font-option' ).change( throttledUpdatePreview );
                // check for font-variant updates
                jQuery( 'body' ).bind('fontChange', throttledUpdatePreview );
                // update preview on first load
                updatePreview();
                jQuery( '#preview').height( jQuery(document).height() );
            });

            function throttledUpdatePreview() {
                // wait 2 secs before updating
                clearTimeout( updateThrottle );
                updateThrottle = setTimeout( updatePreview, 2000 );
            }

            function updatePreview() {
                var code = jQuery( '#shortcode_form' ).getCode();
                if( hasMCE ) {
                    // replace <br/> tags with /n before we send to preview
                    var regex = /<br\s*[\/]?>/gi;
                    code = code.replace(regex, "\n");
                }
                jQuery( '#preview' ).attr( 'src', "<?php echo $preview_url; ?>" + encodeURIComponent( code ) );
            }
        </script>
    </head>
    <body>
        <?php $shortcode_options->display(); ?>
    </body>
</html>