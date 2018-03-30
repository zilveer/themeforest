( function( $ ){
    $( function(){
        $.fn.cols = function (columns) {
            var colClass;
            if (typeof columns == 'undefined') {
                var arr = SidebarResizer.columns.arr;
                var classes = $(this).attr('class').split(' ');
                for (var classNumber in SidebarResizer.columns.arr) {
                    if (classes.indexOf(SidebarResizer.columns.arr[ classNumber ]) != -1) {
                        return parseInt(classNumber);
                    }
                }
            } else {
                if (typeof columns == 'number') {
                    colClass = SidebarResizer.columns.arr[ columns ];
                } else {
                    colClass = columns;
                }
                return this.each(function () {
                    var $this = $(this);
                    $this.removeClass('zero ' + SidebarResizer.columns.classes);
                    $this.addClass(colClass);
                });
            }
        };

        $( '.resizable' ).bind( 'resize', function(){
            var cols = $( this).cols();
            $( this).find( '.numbercolumns .number').text( cols );
            $( this).find( 'input.element-columns').val( cols );
            if( 1 == cols ){
                $( this).find( '.numbercolumns .singular').show();
                $( this).find( '.numbercolumns .plural').hide();
            }else{
                $( this).find( '.numbercolumns .plural').show();
                $( this).find( '.numbercolumns .singular').hide();
            }
        });

        $( 'body' ).on( 'click', '.generic-field-image-select label', function( event ){
            $( event.currentTarget ).parents( '.generic-field-image-select').find( 'label').removeClass( 'selected' );
            $( event.currentTarget ).toggleClass( 'selected', $( event.currentTarget ).find( 'input:checked').length );
        });

        $( '.generic-field-image-select label input:checked' ).parents( 'label' ).click();

        $( '.add-column' ).click( function(){
            var $row = $( this).parent().next();
            var $oldColumn = $row.find( '.columns').last();
            while( $oldColumn.length && $oldColumn.cols() <= 1 ){
                $oldColumn = $oldColumn.prev();
            }

            if( $oldColumn.length && $oldColumn.cols() > 1 ){
                var $oldColumnsNumber = $oldColumn.cols() - 1;
                if( $( this).parents( 'header.region').length ){
                    var $newColumn = $( '#the-closet header.region .columns').first().clone( true, true).trigger( 'init-columns' );
                }else if( $( this).parents( 'div.region').length ){
                    var $newColumn = $( '#the-closet div.region .columns').first().clone( true, true).trigger( 'init-columns' );
                }else if( $( this).parents( 'footer.region').length ){
                    var $newColumn = $( '#the-closet footer.region .columns').first().clone( true, true).trigger( 'init-columns' );
                }
                $newColumn.cols( 1 ).trigger( 'resize' );
                $oldColumn.cols( $oldColumnsNumber ).trigger( 'resize' );
                var date = new Date();
                var id = date.getTime();
                var exp = new RegExp( '_id_', 'g' );
                var html = $newColumn.html().replace( exp, id );
                var rowID = $( this).parents( '.row-element').attr( 'data-id' );
                var exp = new RegExp( '__row__', 'g' );
                html = html.replace( exp, rowID );
                var templateID = $( this ).parents( '.template').attr( 'data-id' );
                exp = new RegExp( '__template__', 'g' );
                html = html.replace( exp, templateID );
                $newColumn.html( html );
                $row.append( $newColumn );
            }else{
                $row.next().text( SidebarResizer.translations.cannot_add_columns ).stop().show().delay( 1000).fadeOut();
            }
        });

        $( 'body' ).on( 'click', '.add-element', function(){
            var date = new Date();
            var id = date.getTime();
            var $element = $( '#the-closet .element-container').first().clone( true, true ).addClass( 'editing newborn' ).appendTo( $( this).parents( '.columns' ) );
            var exp = new RegExp( '_id_', 'g' );
            var html = $element.html().replace( exp, id );
            var rowID = $( this).parents( '.row-element').attr( 'data-id' );
            exp = new RegExp( '__row__', 'g' );
            html = html.replace( exp, rowID );
            var templateID = $( this ).parents( '.template').attr( 'data-id' );
            exp = new RegExp( '__template__', 'g' );
            html = html.replace( exp, templateID );
            $element.html( html );
            $( '#element-builder-shadow').addClass( 'block' );
        });

        $( 'body' ).on( 'click', '.edit-element', function( e ){
            $( e.target ).parents( '.columns').find( '.element-container').addClass( 'editing' );
            $( '#element-builder-shadow').addClass( 'block' );
        });

        $( 'body').on( 'click', '.fpb.discard', function(){
            $( this).parents( '.element-container').remove();
            $( '#element-builder-shadow').removeClass( 'block' );
        });

        $( 'a.has-popup label').on( 'click', function( event ){
            if( $( this).parent().hasClass( 'disabled' ) ){
                event.preventDefault();
                event.stopPropagation();
            }
        });

        $( '.option-numberposts input' ).on('keyup', function(){
            act.accept_digits( this );
        });

        $( 'body').on( 'click', '.fpb.apply', function(){
            $( this).parents( '.element-container').removeClass( 'editing newborn').parents( '.columns').removeClass( 'empty' );
            $( '#element-builder-shadow').removeClass( 'block' );
        });

        $( '#element-builder-shadow').click( function(){
            $( '.element-container.editing .discard' ).click();
        });

        $( '.delete-column' ).on( 'click', function(){
            var $columns = $( this).parents( '.columns' );
            var $columnsReceiver = $columns.next();
            if( !$columnsReceiver.length ){
                $columnsReceiver = $columns.prev();
            }
            if( $columnsReceiver.length ){
                var receiverColumns = $columnsReceiver.cols() + $columns.cols();
                $columnsReceiver.cols( receiverColumns ).trigger( 'resize' );
                $columns.remove();
            }
        });

        $( '.columns').bind( 'init-columns', function(){
            $( this).find( '.handle' ).each( function( index, elem ){
                $( elem).draggable({
                    axis: 'x',
                    grid: [ 60, 0 ],
                    cursor: 'move',
                    stop: function(){
                        $( elem).draggable( 'option', 'revert', false );
                        var $resizable = $( elem).parents( '.resizable' );
                        var currentNumberOfColumns = $resizable.cols();
                        var newColumns = Math.round( ( $( this ).position().left + 10 ) / 60 );
                        var difference = currentNumberOfColumns - newColumns;
                        var $next = $resizable.next( '.resizable');
                        if( $next.hasClass( 'disabled' ) ){
                            $( elem).draggable( 'option', 'revert', true );
                            return;
                        }
                        var nextNumberOfColumns;
                        if( $next.length ){
                            nextNumberOfColumns = parseInt( $next.cols() ) + difference;
                        }

                        if( newColumns < 12 && newColumns > 0 && ( !$next.length || nextNumberOfColumns > 0  ) ){
                            $resizable.cols( newColumns );
                            if( $next.length ){
                                $next.cols( nextNumberOfColumns );
                            }
                            $resizable.add( $next).trigger( 'resize' );
                        }
                        $resizable.parents( '.row' ).find( '.handle').css( 'left', 'auto' );
                    }
                });
            });
        }).trigger( 'init-columns' );

        $( '.row-element').bind( 'init-row', function(){
            $( this).find( '.row' ).sortable({
                handle:'.column-sort',
                axis: 'x'
            });
            $( this ).find( '.columns').trigger( 'init-columns' );
        }).trigger( 'init-row' );

        $( 'body .row-element').trigger( 'init-row' );

        $( '.generic-field-sidebar-resizer .add-sort' ).sortable({
            handle: '.tools .sort',
            axis: 'y'
        });

        $( '#full_width' ).click( function(){
            $( '.first, .second').addClass( 'disabled').find( 'input.is-disabled').val( 'true' );
            $( '.main').cols( 12).trigger( 'resize' );
        });

        $( '#one_left_sidebar').click( function(){
            $( '.second').addClass( 'disabled').find( 'input.is-disabled').val( 'true' );
            var firstcols = $( '.first').cols();
            $( '.main').cols( 12 - firstcols).trigger( 'resize' );
            $( '.first').removeClass( 'disabled').find( 'input.is-disabled').val( 'false');
            $( '.first' ).prependTo( '.row-element .row').trigger( 'resize' );
            $( '.main .relative-wrapper').hide();
        });

        $( '#two_left_sidebars').click( function(){
            var firstcols = $( '.first').cols();
            var secondcols = $( '.second').cols();
            $( '.main').cols( 12 - firstcols - secondcols ).trigger( 'resize' );
            $( '.first, .second').removeClass( 'disabled').find( 'input.is-disabled').val( 'false');
            $( '.second' ).prependTo( '.row-element .row').trigger( 'resize' );
            $( '.first' ).insertBefore( '.second').trigger( 'resize' );
        });

        $( '#one_left_one_right_sidebar').click( function(){
            $( '.main .relative-wrapper').show();
            var firstcols = $( '.first').cols();
            var secondcols = $( '.second').cols();
            $( '.main').cols( 12 - firstcols - secondcols ).trigger( 'resize' );
            $( '.first, .second').removeClass( 'disabled').find( 'input.is-disabled').val( 'false');
            $( '.second' ).prependTo( '.row-element .row').trigger( 'resize' );
            $( '.first' ).appendTo( '.row-element .row').trigger( 'resize' );
        });

        $( '#one_right_sidebar').click( function(){
            $( '.main .relative-wrapper').show();
            $( '.first' ).addClass( 'disabled').find( 'input.is-disabled').val( 'true' );
            var secondcols = $( '.second').cols();
            $( '.main').cols( 12 - secondcols).trigger( 'resize' );
            $( '.second').removeClass( 'disabled').find( 'input.is-disabled').val( 'false');
            $( '.second').appendTo( '.row-element .row').trigger( 'resize' );
        });

        $( '#two_right_sidebars').click( function(){
            $( '.main .relative-wrapper').show();
            var firstcols = $( '.first').cols();
            var secondcols = $( '.second').cols();
            $( '.main').cols( 12 - firstcols - secondcols ).trigger( 'resize' );
            $( '.first, .second').removeClass( 'disabled').find( 'input.is-disabled').val( 'false');
            $( '.first' ).appendTo( '.row-element .row').trigger( 'resize' );
            $( '.second' ).insertAfter( '.first').trigger( 'resize' );
        });

        $( '.layout-tools a').click( function(){
            $( this).addClass( 'selected').siblings().removeClass( 'selected' );
        });

        $( '.sidebar-dropdown:not(.template-dropdown) select').change( function(){
            if( $( this ).find( 'option:last-child').is( ':selected' ) ){
                location.href = 'admin.php?page=cosmothemes__extra';
            }
        });

        $( '.template-dropdown select').change( function(){
            if( $( this ).find( 'option:last-child').is( ':selected' ) ){
                location.href = 'admin.php?page=cosmothemes__templates';
            }
        });

        $( '.layout-tools a').click( function(){
            $(this).find( 'input').click();
        });

        $( '.layout-tools input').click( function(event){
            event.stopPropagation();
        });

        $( '.layout-tools input:checked').parents('a').click();
    });
}( jQuery ) );