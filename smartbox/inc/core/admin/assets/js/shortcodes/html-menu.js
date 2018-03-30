(function($){
    $(window).load(function() {
        // create div for new menu in html editor toolbar
        $('#ed_toolbar').append('<div id="access"></div>');
        // create shortcode menu inside new div
        $( '#access' ).htmlMenu();
    });

    $(document).ready(function() {
        $(window).resize( thickDims );

        $('body').on( 'click', '.thickbox-preview', function() {
            setTimeout( thickDims, 500 );
        } );
    });

    var thickDims, tbWidth, tbHeight;

    function thickDims() {
        var tbWindow = $('#TB_window'), H = $(window).height(), W = $(window).width(), w, h;

        w = (tbWidth && tbWidth < W - 90) ? tbWidth : W - 90;
        h = (tbHeight && tbHeight < H - 60) ? tbHeight : H - 60;

        if ( tbWindow.size() ) {
            tbWindow.width(w).height(h);
            $('#TB_iframeContent').width(w).height(h - 27);
            tbWindow.css({'margin-left': '-' + parseInt((w / 2),10) + 'px'});
            if ( typeof document.body.style.maxWidth != 'undefined' )
                tbWindow.css({'top':'30px','margin-top':'0'});
        }
    };



    //plugin code
    $.fn.htmlMenu = function(){
        function fetchData( $this ) {
            // fetch menu data and build menu
            $.getJSON( ajaxurl + '?action=oxy_shortcodes_menu', function( data ) {
                var menu = buildMenu( data );
                $this.append( '<ul><li><a>Shortcodes</a>' + menu + '</li></ul>' );
            })
            .error( function() {
                console.log('Error fetching menu');
            });
        }

        function buildMenu( data ) {
            var menuCode = '<ul>';
            $.each( data, function() {
                var item = this;
                // if this item has shortcodes then it must be a category
                if( item.members !== undefined ) {
                    if( item.title !== undefined ) {
                        menuCode += '<li><a>' + item.title + '</a>';
                        menuCode += buildMenu( item.members, '' );
                        menuCode += '</li>';
                    }
                    else {
                        console.log( item, 'Missing a title' );
                    }
                }
                else {
                    // must be a shortcode
                    if( item.shortcode !== undefined ) {
                        switch( item.insert_with ) {
                            case 'dialog':
                                // add onclick call to thickbox
                                menuCode += '<li><a href="' + createDialogURL( item ) + '" class="thickbox thickbox-preview" title="' + item.title + '">' + item.title + '</a></li>';
                            break;
                            case 'insert':
                                // just insert code
                                menuCode += "<li><a href='#' onclick='QTags.insertContent(\"" + item.insert.replace(/\"/g, '\\"') + "\")'>" + item.title + '</a></li>';
                            break;
                        }
                    }
                }
            });
            return menuCode + '</ul>';
        }

        function createDialogURL( item ) {
            // create dialog parameters
            var params = [];
            params.push( 'action=oxy_shortcodes' );
            params.push( 'shortcode=' + item.shortcode );

            //params.push( 'title_param=' + item.title );
            params.push( 'MCE=false' );
            params.push( 'KeepThis=true' );
            params.push( 'TB_iframe=true' );

            // create thickbox call
            return ajaxurl + '?' + params.join( '&' );
        }


        return this.each(function() {
            var $this = $(this);
            //run plugin
            fetchData( $this );
        });

    };
})(jQuery);