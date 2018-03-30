( function($) {
    $(window).load( function() {
        var init_post_format = $( '#post-formats-select' ).find( '.post-format:checked' ).val();
        add_post_format( init_post_format );
    } );
 
    $( '#post-formats-select' ).find( '.post-format' ).change( function() {
        var post_format = $(this).val();
        add_post_format( post_format );
    } );
 
    function add_post_format( post_format ) {
        post_format = ( 0 == post_format ) ? 'standard' : post_format;
        if ( frames['content_ifr'] )
            $( 'html', frames['content_ifr'].document ).removeClass().addClass( 'format-' + post_format );
    }
} )(jQuery);