(function($) {
    $(document).ready( function() {
        $( '.accordion' ).accordion({ icons: { 'header': 'ui-icon-plus', 'headerSelected': 'ui-icon-minus' }, fillSpace: true, heightStyle: "content"} );
    });
})(jQuery);