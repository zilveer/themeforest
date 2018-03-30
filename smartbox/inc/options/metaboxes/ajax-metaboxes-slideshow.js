/**
 * Oxygenna.com
 *
 * $Template:: *(TEMPLATE_NAME)*
 * $Copyright:: *(COPYRIGHT)*
 * $Licence:: *(LICENCE)*
 */

(function( $ ){
    $(document).ready(function($){
        // get the select box we need to toggle options with
        var $select = $( '#' + theme + '_link_type' );
        var $selectContainer = $select.parents( '.rwmb-field' );
        var $toggleOptions = $selectContainer.siblings( '.rwmb-field' );

        $select.change(function(){
            // hide all controls after the select
            $toggleOptions.hide();
            // show selected options
            switch( $(this).val() ) {
                case 'page':
                    $( $toggleOptions[0] ).show();
                break;
                case 'post':
                    $( $toggleOptions[1] ).show();
                break;
                case 'portfolio':
                    $( $toggleOptions[2] ).show();
                break
                case 'category':
                    $( $toggleOptions[3] ).show();
                break;
                case 'url':
                    $( $toggleOptions[4] ).show();
                break;
            }
        }).trigger('change');
    });
})( jQuery );