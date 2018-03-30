(function($) {
    $.fn.yiw_features_tab = function( options ) {
        var config = {
            'tabNav' : 'ul.features-tab-labels',
            'tabDivs': 'div.features-tab-wrapper'
        };

        if( options ) $.extend( config, options );

        this.each( function () {
            var tabNav  = $( config.tabNav, this );
            var tabDivs = $( config.tabDivs, this );
            var labelNumber = tabNav.children( 'li' ).length;

            tabDivs.children( 'div' ).hide();

            var currentDiv = tabDivs.children( 'div' ).eq( tabNav.children( 'li.current-feature' ).index() );
            currentDiv.show();

            $( 'li', tabNav ).hover( function() {
                if( !$( this ).hasClass( 'current-feature' ) ) {
                    var currentDiv = tabDivs.children( 'div' ).eq( $( this ).index() );
                    tabNav.children( 'li' ).removeClass( 'current-feature' );

                    $( this ).addClass( 'current-feature' );

                    tabDivs.children( 'div' ).hide().removeClass( 'current-feature' );   console.log('hover');
                    currentDiv.fadeIn( 'slow', function() {
                        $(document).trigger('feature_tab_opened');
                    });
                }
            });

        });
    }
})(jQuery);
(function($){
    $( '.features-tab-container' ).yiw_features_tab();
})(jQuery);