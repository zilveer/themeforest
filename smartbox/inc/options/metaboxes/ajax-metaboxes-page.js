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
        var $select = $( '#' + theme + '_header_type' );
        var $selectContainer = $select.parents( '.rwmb-field' );

        // hide all controls after the select
        $selectContainer.nextAll().hide();

        $select.change(function(){
            // hide all controls after the select
            $selectContainer.nextAll().hide();
            // show selected options
            switch( $(this).val() ) {
                case 'map':
                    $('.rwmb-map-wrapper').show().prev().show();
                    google.maps.event.trigger( $( '.rwmb-map-canvas' )[0], 'resize');
                break;
                case 'slideshow':
                    $('.rwmb-taxonomy-wrapper:eq(0)').show();
                break;
                case 'revslider':
                    $('.rwmb-taxonomy-wrapper:eq(1)').show();
                break;
                case 'super_hero':
                    $('.rwmb-thickbox_image-wrapper').show();
                break;
            }
        }).trigger('change');
    });
})( jQuery );