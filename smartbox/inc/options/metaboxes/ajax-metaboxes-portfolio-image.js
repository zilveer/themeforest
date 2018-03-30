/**
 * Ajax for portfolio page
 *
 * @package Smartbox
 * @subpackage Admin
 * @since 1.3
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license **LICENSE**
 * @version 1.5.8
 */

(function( $ ){
    $(document).ready(function($){
        // get the select box we need to toggle options with
        var $select = $( '#' + theme + '_template' );
        var customHeaderMetabox = $('#' + theme + '_header_title').closest('.postbox');

        $select.change(function(){
            // show selected options
            customHeaderMetabox.toggle( $(this).val() !== 'partials/content-portfolio-single.php' );
        }).trigger('change');
    });
})( jQuery );