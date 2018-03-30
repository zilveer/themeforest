(function($) {
    $(document).ready(function() {
        var $title = $( '#how-to-use-relation-tags-title' );
        var $content = $( '#how-to-use-relation-tags-content' );

        $content.hide();
        $title.click( function( event ) {
            event.preventDefault();

            $content.slideToggle( 'fast' );
        });
    });
})(jQuery);
