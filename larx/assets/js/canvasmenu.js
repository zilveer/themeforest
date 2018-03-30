jQuery(document).ready(function(){
    'use strict';

    /* ==============================================
        OFF-CANVAS NAV
    =============================================== */

    jQuery(function() {
        var $menu = jQuery('nav#menu'),
            $html = jQuery('html, body');

        $menu.mmenu({
            dragOpen: true
        });

        $menu.find( 'li > a' ).on( 'click',
            function()
            {
                var href = jQuery(this).attr( 'href' );

                //  if the clicked link is linked to an anchor, scroll the page to that anchor
                if ( href.slice( 0, 1 ) == '#' )
                {
                    $menu.one(
                        'closed.mm',
                        function()
                        {
                            setTimeout(
                                function()
                                {
                                    $html.animate({
                                        scrollTop: jQuery( href ).offset().top
                                    });
                                }, 10
                            );
                        }
                    );
                }
            }
        );
    });

});