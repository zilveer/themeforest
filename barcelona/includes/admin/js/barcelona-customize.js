(function($) {
    $(document).ready(function() {

        var body = $('body');

        wp.customize( 'background_image', function( value ) {
            value.bind( function( newval ) {
                if ( newval != '' ) {
                    if (!body.hasClass('boxed-layout')) {
                        body.addClass('boxed-layout-bg');
                    }
                } else {
                    if (!body.hasClass('po-bg')) {
                        body.removeClass('boxed-layout-bg');
                    }
                }
                $(window).trigger('scroll');
            } );
        } );

    });
})(jQuery);