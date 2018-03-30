var copy_content = '';
var copy_id = '';
var copy_name = '';
var persistedval = '';
var not_updated = false ;

if (window.sessionStorage){
    
    var persistedval=sessionStorage.getItem("copy_template") //returns copy_content
    if (persistedval != '' && persistedval != null) {
        jQuery('.paste').removeClass('hidden');
    };
}

/* copy template */
function copy1(contentID, element_id, element_name){
    var contentID = jQuery(contentID);
    copy_content = contentID.html();
    copy_name = element_name;
    if (copy_content) { 
        jQuery('.paste').removeClass('hidden');

        if (window.sessionStorage){
            sessionStorage.setItem("copy_template", copy_content); //store data using setItem()
            sessionStorage.setItem("copy_id", element_id);
            sessionStorage.setItem("copy_name", element_name);
            var persistedval=sessionStorage.getItem("copy_template"); //returns copy_content
        }
    };  
    return copy_content;      
}

/* paste template */
function paste1(contentID, element_id){
    var contentID = jQuery(contentID);
    var new_content = contentID.html('');
    var persistedval=sessionStorage.getItem("copy_template");

    copy_id = sessionStorage.getItem("copy_id");
    copy_name = sessionStorage.getItem("copy_name");
    var exp = new RegExp( copy_id, 'g' );
    copy_content1 = persistedval.replace(exp, element_id);

    var exp1 = new RegExp( copy_name, 'g' );
    var element_name = jQuery('.for_template_' + element_id).find('.dbl-clickable-text').find('.text').text();
    copy_content2 = copy_content1.replace(exp1, element_name);

    new_content.append( copy_content2 );
    jQuery('.paste').addClass('hidden');
    jQuery('.copy').addClass('hidden');
    jQuery( '.edit-header').click( function(){
        jQuery( this).parents( 'div.region-inside').children( '.element-container').addClass( 'editing' );
    });

    jQuery( '.layout-builder .row-element').trigger( 'init-row' );
    jQuery( '.layout-builder .region').trigger( 'init-region' );

    jQuery('.row-width input').click(function(){
        if(jQuery(this).val() == 'full_width_yes'){
            jQuery(this).parents( '.element-container' ).find('.row_bg_color_options').show();
        }else{
            jQuery(this).parents( '.element-container' ).find('.row_bg_color_options').hide();
        }
    }); 

}

( function( $ ){  
    function set_the_ids( target ){
        var $target = $( target );
        var html = $target.get( 0).outerHTML;
        var date = new Date();
        var $template = $target.hasClass( 'template' ) ? $target : $target.parents( '.template' );
        var templateID = ( $template.attr( 'data-id' ) ) && ( $template.attr( 'data-id' ) != '__template__' ) ? $template.attr( 'data-id' ) : date.getTime();
        var $row = $target.hasClass( 'row-element' ) ? $target : $target.parents( '.row-element' );
        var rowID = ( $row.attr( 'data-id' ) ) && ( $row.attr( 'data-id' ) != '__row__' ) ? $row.attr( 'data-id' ) : date.getTime();
        var $element = $target.hasClass( 'columns resizable' ) ? $target : $target.parents( '.columns.resizable' );
        var elementID = ( $element.attr( 'data-id' ) ) && ( $element.attr( 'data-id' ) != '_id_' ) ? $element.attr( 'data-id' ) : date.getTime();
        var exp = new RegExp( '__template__', 'g' );
        html = html.replace( exp, templateID );
        exp = new RegExp( '__row__', 'g' );
        html = html.replace( exp, rowID );
        exp = new RegExp( '_id_', 'g' );
        html = html.replace( exp, elementID );
        var $newtarget = $( html );
        $target.replaceWith( $newtarget );
        return $newtarget;
    }

    $( function(){
        $( document ).keyup( function( e ) {
            if ( e.keyCode == 27 ){
                $( document ).trigger( 'escape-key' );
            }
        });

        $.fn.cols = function ( columns ) {
            var colClass;
            if ( typeof columns == 'undefined' ){
                var arr = TemplateBuilder.columns.arr;
                var classes = $(this).attr('class').split(' ');
                for (var classNumber in TemplateBuilder.columns.arr) {
                    if( classes.indexOf( TemplateBuilder.columns.arr[ classNumber ] ) != -1 ){
                        return parseInt( classNumber );
                    }
                }
            } else {
                if (typeof columns == 'number') {
                    colClass = TemplateBuilder.columns.arr[ columns ];
                } else {
                    colClass = columns;
                }

                $( this).find( '.delete-column, .column-sort' ).toggle( 'twelve' != colClass );
                return this.each( function () {
                    var $this = $( this );
                    $this.removeClass( 'zero ' + TemplateBuilder.columns.classes );
                    $this.addClass( colClass );
                });
            }
        };

        $( '.twelve.columns ').find( '.delete-column, .column-sort').hide();

        function insert_select_box( box_filter, $element ){
            var $box = $( '#the-closet .select-box' ).filter( box_filter ).clone();
            if($element.parents('header.region').length){
                var html = $box.get( 0).outerHTML; 
                var exp = new RegExp( '\\[_rows', 'g' ); 
                html = html.replace( exp, '[_header_rows' );
                $box = $( html );
            }else if($element.parents('footer.region').length){
                var html = $box.get( 0).outerHTML;
                var exp = new RegExp( '\\[_rows', 'g' );
                html = html.replace( exp, '[_footer_rows' );
                $box = $( html );
            }
            var $existing_box = $element.find( '.select-box').filter( box_filter );
            $element.find( '.panel .element_type_list').append( $box );
            $('.element_type_list').removeClass('hidden');
            $box = set_the_ids( $box );
            if( $existing_box.length ){
                var $reference = $box.find( '.content>p');
                if( !$reference.length){
                    $box.find('.content').prepend('<p class="hidden"></p>');
                    var $reference = $box.find( '.content>p');
                }
                $existing_box.find( 'input:checked').each( function( index, elem ){
                    var val = $( elem).val();
                    //$box.find( 'input[value="' + val + '"]').prop( 'checked', true).parent().addClass( 'added').insertAfter( $reference );
                    //for checked checkboxes add class 'added' to parent label
                    $box.find( 'input[value="' + val + '"]').prop( 'checked', true).parent().addClass( 'added');
                });
                $existing_box.remove();
            }
        }

        function clear_box( box_filter, $element ){
            var $box = $element.find( '.select-box').filter( box_filter );
            $box.addClass( 'hidden').each( function( index, box ){
                var $box = $( box );
                var $inputs = $box.find( 'input:checked' );
                $inputs.remove();
                $box.html( '' );
                $box.append( $inputs );
            });
            $('.element_type_list').addClass('hidden');
        }

        $( '.layout-builder').on( 'click', '.element-container.editing .element-type label input.category-type', function( event ){
            var $element = $( event.currentTarget).parents( '.element-container' );
            insert_select_box( '.categories', $element );
        });

        $( '.layout-builder').on( 'click', '.element-container.editing .element-type label input.event-category-type', function( event ){
            var $element = $( event.currentTarget).parents( '.element-container' );
            insert_select_box( '.eventcategories', $element );
        });

        $( '.layout-builder').on( 'click', '.element-container.editing .element-type label input.tag-type', function( event ){
            var $element = $( event.currentTarget).parents( '.element-container' );
            insert_select_box( '.tags', $element );
        });

        $( '.layout-builder').on( 'click', '.element-container.editing .element-type label input.portfolio-type', function( event ){
            var $element = $( event.currentTarget).parents( '.element-container' );
            insert_select_box( '.portfolios', $element );
        });
        
        $( '.layout-builder').on( 'click', '.element-container.editing .element-type label input.post-type', function( event ){
            var $element = $( event.currentTarget).parents( '.element-container' );
            insert_select_box( '.posts', $element );
        });

        $( '.layout-builder').on( 'click', '.element-container.editing .element-type label input.page-type', function( event ){
            var $element = $( event.currentTarget).parents( '.element-container' );
            insert_select_box( '.pages', $element );
        });

        $( '.layout-builder').on( 'click', '.element-container.editing .element-type label input.event-type', function( event ){ /*if Event button is clicked we show bellow the list of available Event posts*/
            var $element = $( event.currentTarget).parents( '.element-container' );
            insert_select_box( '.events', $element );
        });

        $( '.layout-builder').on( 'click', '.element-container.editing .element-type label input.box-set', function( event ){
            var $element = $( event.currentTarget).parents( '.element-container' );
            insert_select_box( '.boxes', $element );
        });

        $( '.layout-builder').on( 'click', '.element-container.editing .element-type label input.team-group', function( event ){
            var $element = $( event.currentTarget).parents( '.element-container' );
            insert_select_box( '.teams', $element );
        });

        $( '.layout-builder').on( 'click', '.element-container.editing .element-type label input.banner-type', function( event ){
            var $element = $( event.currentTarget).parents( '.element-container' );
            insert_select_box( '.banners', $element );
        });

        $( '.layout-builder').on( 'click', '.element-container.editing .element-type label input.testimonial-type', function( event ){
            var $element = $( event.currentTarget).parents( '.element-container' );
            insert_select_box( '.testimonials', $element );
        });

        $( '.layout-builder').on( 'click', '.element-container.editing .element-type label input.logo-type, .element-container.editing .element-type label input.menu-type, .element-container.editing .element-type label input.searchbar-type, .element-container.editing .element-type label input.login-type, .element-container.editing .element-type label input.copyright-type, .element-container.editing .element-type label input.breadcrumbs-type, .element-container.editing .element-type label input.textelement-type, .element-container.editing .element-type label input.socialicons-type, .element-container.editing .element-type label input.delimiter-type, .element-container.editing .element-type label input.empty-type', function( event ){
            var $element = $( event.currentTarget).parents( '.element-container' );
            clear_box( '*', $( event.currentTarget).parents( '.element-container' ) );
        });

        $( '.layout-builder').on( 'click', '.element-container.editing .element-type label input.widget-type', function( event ){
            var $element = $( event.currentTarget).parents( '.element-container' );
            insert_select_box( '.sidebars', $element );
        });


        $( '.layout-builder').on( 'keyup', '.select-box .search:not(.generic-record-search)', function( event ){
            var val = $( event.currentTarget).val();
            $( event.currentTarget).parents( '.select-box').find( 'label.choose-many, label.choose-one').each( function( index, elem ){
                if( $( elem).text().toLowerCase().trim().indexOf( val.toLowerCase().trim() ) == -1 ){
                    $( elem).hide();
                }else{
                    $( elem).show();
                }
            });
        });

        $( document ).on( 'escape-key' , function(){
            $( '.element-container.editing .apply' ).click();
        });

        $( '.dbl-clickable-text').dblclick( function(){
            $( this).hide();
            $( this).siblings( '.hidden-input').show().focus().select();
        });

        $( '.hidden-input').bind( 'blur change', function(){
            $( this).hide();
            $( this).siblings( '.dbl-clickable-text').show().find( '.text').text( $( this).val() );
        });

        $( '.admin-menu').on( 'click', '.template-menu-item', function( event ){
            var id = $( event.currentTarget).attr( 'data-id' );
            //$( event.currentTarget).addClass( 'current').siblings().removeClass( 'current' );
            //$( '.template').hide();
            $( '#template_' + id).show();
            //$( '#last_selected_template').val(id);
        });

        var last_selected = $( '#last_selected_template').val();
        var $menu_item_for_last_selected = $( '.for_template_' + last_selected );
        if( $menu_item_for_last_selected.length){
            $menu_item_for_last_selected.click();
        }else{
            $( '.admin-menu .for_template_' + TemplateBuilder.first_template).click();
        }

        $( '.template-menu-item .hidden-input').bind( 'keyup', function(){
            var id = $( this).parents( 'li').attr( 'data-id' );
            var val = $( this).val();
            $( '#template_' + id).find( '.title.has-hidden-input .text').text( val );
            $( '#template_' + id).find( '.title.has-hidden-input .hidden-input').val( val );
        });

        $( '.layout-builder').on( 'keyup', '.template .title.has-hidden-input .hidden-input', function(){
            var id = $( this).parents( '.template').attr( 'data-id' );
            var val = $( this).val();
            $( '.for_template_' + id).find( '.text').text( val );
            $( '.for_template_' + id).find( '.hidden-input').val( val );
        });


        $( '.template .title.has-hidden-input .hidden-input').bind( 'keyup', function(){
            var id = $( this).parents( '.template').attr( 'data-id' );
            var val = $( this).val();
        });

        $count = 1;
        $( '.admin-menu .add-new').click( function(){
            /* we need not_updated variable to verify if user saved the new created template */
            if (not_updated) {
                alert("Please  save your current template !");
            }else{
                not_updated = true;
                /* if is the first click we append the form content else we delete the existing template and add the new one. */
                if ($count == 1) {
                    var $template = $( '#the-closet .template').first().clone( true);
                    $template.prependTo( '.layout-builder' );
                    var date = new Date();
                    $template = set_the_ids( $template );
                    var id = $template.attr( 'data-id' );
                    var $prototype = $( '#menu-item-prototypes li').clone( true, true ).prependTo( '.admin-menu ul');
                    var id1 = $('#last_selected_template' ).val();
                    $('.for_template_'+id1).removeClass('current');
                    $prototype.attr( 'data-id', id )
                        .addClass( 'for_template_' + id )
                        .addClass('current')
                        .click()
                        .find( '.dbl-clickable-text').trigger( 'dblclick' );
                    
                    var click_action = "delete_template('"+id+"');";
                    $('.for_template_'+id).find('.delete').click(function() { eval(click_action); });

                    $template.find( '.region').trigger( 'init-region' );
                    $template.find( '.row-element').trigger( 'init-row' );
                    $template.find( '.columns').trigger( 'init-columns' );
                    $template.find( '.fpb.apply').trigger('init-description');

                    $( '.edit-header').click( function(){
                        $( this).parents( 'div.region-inside').children( '.element-container').addClass( 'editing' );
                    });
                    $( '#template_'+id1).hide();
                }else if($count > 1 ){
                    $('.template-menu-item').removeClass('current');
                    $('.layout-builder').html('');
                    var $template = $( '#the-closet .template').first().clone( true);
                    $template.prependTo( '.layout-builder' );
                    var date = new Date();
                    $template = set_the_ids( $template );
                    var id = $template.attr( 'data-id' );
                    var $prototype = $( '#menu-item-prototypes li').clone( true, true ).prependTo( '.admin-menu ul');
                    var id1 = $('#last_selected_template' ).val();
                    $('.for_template_'+id1).removeClass('current');
                    $prototype.attr( 'data-id', id )
                        .addClass( 'for_template_' + id )
                        .addClass('current')
                        .click()
                        .find( '.dbl-clickable-text').trigger( 'dblclick' );
                    
                    var click_action = "delete_template('"+id+"');";
                    $('.for_template_'+id).find('.delete').click(function() { eval(click_action); });

                    $template.find( '.region').trigger( 'init-region' );
                    $template.find( '.row-element').trigger( 'init-row' );
                    $template.find( '.columns').trigger( 'init-columns' );
                    $template.find( '.fpb.apply').trigger('init-description');

                    $( '.edit-header').click( function(){
                        $( this).parents( 'div.region-inside').children( '.element-container').addClass( 'editing' );
                    });
                    $( '#template_'+id1).hide();
                };  
                $count++;
            }
          
        });

        $( '.layout-builder').on( 'resize', '.resizable', function( event ){
            var cols = $( event.currentTarget ).cols();
            $( event.currentTarget).find( '.numbercolumns .number').text( cols );
            $( event.currentTarget).find( 'input.element-columns').val( cols );
            if( 1 == cols ){
                $( event.currentTarget).find( '.numbercolumns .singular').show();
                $( event.currentTarget).find( '.numbercolumns .plural').hide();
            }else{
                $( event.currentTarget).find( '.numbercolumns .plural').show();
                $( event.currentTarget).find( '.numbercolumns .singular').hide();
            }
        });

        $( '.layout-builder').on( 'click', '.delete-row', function(){
            if(confirm('Are you sure?')){
                $( this).parents( '.row-element').remove();
            }
        });

        $( '.layout-builder' ).on( 'click', '.generic-field-image-select label', function( event ){
            $( event.currentTarget ).parents( '.generic-field-image-select').find( 'label').removeClass( 'selected' );
            $( event.currentTarget ).toggleClass( 'selected', $( event.currentTarget ).find( 'input:checked').length );
        });

        $( '.layout-builder' ).on( 'click', '.add-column', function( event ){
            var $row = $( event.target ).parent().next();
            var $oldColumn = $row.find( '.columns').last();
            while( $oldColumn.length && $oldColumn.cols() <= 1 ){
                $oldColumn = $oldColumn.prev();
            }

            if( $oldColumn.length && $oldColumn.cols() > 1 ){
                var $oldColumnsNumber = $oldColumn.cols() - 1;
                if( $( this).parents( 'header.region').length ){
                    var $newColumn = $( '#the-closet header.region .row-element:not(.undeletable) .columns').last().clone( true, false ).trigger( 'init-columns' );
                }else if( $( this).parents( 'div.region').length ){
                    var $newColumn = $( '#the-closet div.region .row-element:not(.undeletable) .columns').last().clone( true, false ).trigger( 'init-columns' );
                }else if( $( this).parents( 'footer.region').length ){
                    var $newColumn = $( '#the-closet footer.region .row-element:not(.undeletable) .columns').last().clone( true, false ).trigger( 'init-columns' );
                }
                $newColumn.cols( 1 ).trigger( 'resize' );
                $oldColumn.cols( $oldColumnsNumber ).trigger( 'resize' );
                $row.append( $newColumn );
                $newColumn = set_the_ids( $newColumn );
                $newColumn.trigger( 'resize' );
                $newColumn.trigger( 'init-columns' );
            }else{
                $row.next().text( TemplateBuilder.translations.cannot_add_columns ).stop().show().delay( 1000).fadeOut();
            }
        });

        $( '.layout-builder' ).on( 'click', '.add-element', function(){
            var date = new Date();
            var id = date.getTime();
            var $element = $( '#the-closet .element-container').first().clone( true, true ).addClass( 'editing newborn' ).appendTo( $( this).parents( '.columns' ) );
            var exp = new RegExp( '_id_', 'g' );
            var html = $element.html().replace( exp, id );
            var rowID = $( this).parents( '.row-element').attr( 'data-id' );
            var exp = new RegExp( '__row__', 'g' );
            html = html.replace( exp, rowID );
            var templateID = $( this ).parents( '.template').attr( 'data-id' );
            exp = new RegExp( '__template__', 'g' );
            html = html.replace( exp, templateID );
            $element.html( html );
            $( '#element-builder-shadow').addClass( 'block' );
        });

        $( '.layout-builder' ).on( 'click', '.edit-element.edit-row', function( event ){ /*show 'edit row' Box*/
            $( this).parents( 'div.row-element').children( '.element-container').addClass( 'editing' );
            $('.my-color-field').wpColorPicker();
        });

        
        $( '.layout-builder' ).on( 'click', '.edit-element.edit-row-activation', function( event ){ /*show 'edit row activation' Box*/
            $( this).parents( 'div.row-element').children( '.element-container.activation').addClass( 'editing' );
        });

        $( '.layout-builder' ).on( 'click', '.edit-element', function( event ){
            $( event.currentTarget ).parents( '.columns').find( '.element-container').addClass( 'editing' );
            $( event.currentTarget).parents( '.columns').find( '.element-type label.selected').click().find( 'input').click();
            $( '#element-builder-shadow').addClass( 'block' );
            $( '.element-container.editing' ).find( '.standard-generic-field').first().trigger( 'show-hide' );

            var id = $( this).attr('data-element-id');
            $( this).parents(' header.region').find('.row-element  .display_hint#'+id).hide();
            $( this).parents(' div.region').find('.row-element .display_hint#'+id).hide();
            $( this).parents(' footer.region').find('.row-element .display_hint#'+id).hide();
            
            if ($( '#element-builder-shadow').hasClass( 'block' )) {
                $('body').css('overflow-y', 'hidden');
            }
        });

        $( '.layout-builder').on( 'click', '.fpb.discard', function(){
            $( this).parents( '.element-container').remove();
            $( '#element-builder-shadow').removeClass( 'block' );
            $('body').css('overflow-y', '');
        });

        $( 'a.has-popup label').on( 'click', function( event ){
            if( $( this).parent().hasClass( 'disabled' ) ){
                event.preventDefault();
                event.stopPropagation();
            }
        });

        $( '.layout-builder' ).on('keyup', '.option-numberposts input, .digit', function( event ){
            act.accept_digits( event.currentTarget );
        });

        $( '.layout-builder').on( 'click', '.fpb.apply', function( event ){
            $( event.currentTarget ).parents( '.element-container').removeClass( 'editing newborn').parents( '.columns').removeClass( 'empty' );
            $( '#element-builder-shadow').removeClass( 'block' );
            $('body').css('overflow-y', '');
            clear_box( '*', $( event.currentTarget).parents( '.element-container' ) );
            $( '.element-container.editing .apply' ).click(); /*click on all save btn to hide all boxes*/
        });

        $( '#element-builder-shadow').click( function(){
            $( '.element-container.editing .apply' ).click();
        });

        $( '.layout-builder').on( 'click', '.delete-column', function( event ){
            if(confirm('Are you sure?')){
                var $columns = $( event.currentTarget ).parents( '.columns' );
                var $columnsReceiver = $columns.next();
                if( !$columnsReceiver.length ){
                    $columnsReceiver = $columns.prev();
                }
                if( $columnsReceiver.length ){
                    var receiverColumns = $columnsReceiver.cols() + $columns.cols();
                    $columnsReceiver.cols( receiverColumns ).trigger( 'resize' );
                    $columns.remove();
                }
            }
        });

        /*clicked on check buttons from row settings to highlight the label*/
        $('.row-options label input:checked').parents( 'label' ).click();

        $( '.layout-builder' ).on( 'init-columns', '.columns', function( event ){
            $( event.currentTarget ).find( '.generic-field-image-select label input:checked' ).parents( 'label' ).click();
            $( event.currentTarget ).find( '.handle' ).each( function( index, elem ){
                $( elem).draggable({
                    axis: 'x',
                    grid: [ 60, 0 ],
                    cursor: 'move',
                    stop: function(){
                        var $resizable = $( elem).parents( '.resizable' );
                        var currentNumberOfColumns = $resizable.cols();
                        var newColumns = Math.round( ( $( this ).position().left + 10 ) / 60 );
                        var difference = currentNumberOfColumns - newColumns;
                        var $next = $resizable.next( '.resizable' );
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
        });

        $( '.layout-builder').on( 'init-row',  '.row-element', function( event ){
            $( event.currentTarget ).find( '.row' ).sortable({
                handle:'.column-sort',
                axis: 'x'
            });
            $( event.currentTarget ).find( '.columns').trigger( 'init-columns' );
        });

        $( '.layout-builder .row-element').trigger( 'init-row' );

        $( '.layout-builder').on( 'init-region', '.region', function( event ){
            $( event.currentTarget).find( '.add-sort').sortable({
                handle: '.tools .sort',
                axis: 'y'
            });
        });

        $( '.layout-builder .region').trigger( 'init-region' );
        
        var cl = 0;
        $( '.layout-builder').on( 'click', 'header.region .add-row-button', function(){
            var $to = $( this).parents( 'header.region').find( '.add-sort' );
            var $row = $( '#the-closet header.region .row-element').last().clone( true );
            $row.appendTo( $to );
            $row = set_the_ids( $row );
            $row.trigger( 'init-row' );

            var id = $( this).parents( 'header.region').find( '.row-element' ).last();
            var id1 = id.attr( 'data-id' );
            $( this).parents(' header.region').find('.row-element .display_hint').last().show();

            $('.row-width input').click(function(){
                if($(this).val() == 'full_width_yes'){
                    $(this).parents( '.element-container' ).find('.row_bg_color_options').show();
                }else{
                    $(this).parents( '.element-container' ).find('.row_bg_color_options').hide();
                }

                $(this).parents( '.element-container' ).find('.row_bg_color_options').find('.wp-color-result:first').css('display', 'none');

            }); 

            $('.row-width input:checked').each(function(){
                
                if($(this).val() == 'full_width_yes'){
                    $(this).parents( '.element-container' ).find('.row_bg_color_options').show();
                }else{
                    $(this).parents( '.element-container' ).find('.row_bg_color_options').hide();
                }
                
            }); 

            cl++;                
            $('.delimiter-type input').click(function(){

                if($(this).parents( '.element-container' ).find('.delimiter_color_picker').find('.wp-color-result').length == 2 || cl >=2 ){
                    $(this).parents( '.element-container' ).find('.delimiter_color_picker').find('.wp-color-result:first').css('display', 'none');
                }
            })

        });

        $( '.layout-builder').on( 'click', 'div.region .add-row-button', function(){
            var $to = $( this).parents( 'div.region').find( '.add-sort' );
            var $row = $( '#the-closet div.region .row-element').last().clone( true );
            $row.appendTo( $to );
            $row = set_the_ids( $row );
            $row.trigger( 'init-row' );
            var id = $( this).parents( 'div.region').find( '.row-element' ).last();
            var id1 = id.attr( 'data-id' );
            $( this).parents(' div.region').find('.row-element .display_hint').last().show();

            $('.row-width input').click(function(){
                if($(this).val() == 'full_width_yes'){
                    $(this).parents( '.element-container' ).find('.row_bg_color_options').show();
                }else{
                    $(this).parents( '.element-container' ).find('.row_bg_color_options').hide();
                }
                $(this).parents( '.element-container' ).find('.row_bg_color_options').find('.wp-color-result:first').css('display', 'none');
            }); 

            $('.row-width input:checked').each(function(){
                
                if($(this).val() == 'full_width_yes'){
                    $(this).parents( '.element-container' ).find('.row_bg_color_options').show();
                }else{
                    $(this).parents( '.element-container' ).find('.row_bg_color_options').hide();
                }
                
            });

            cl++;                
            $('.delimiter-type input').click(function(){

                if($(this).parents( '.element-container' ).find('.delimiter_color_picker').find('.wp-color-result').length == 2 || cl >=2 ){
                    $(this).parents( '.element-container' ).find('.delimiter_color_picker').find('.wp-color-result:first').css('display', 'none');
                }
            })

        });

        $( '.layout-builder').on( 'click','footer.region .add-row-button', function(){
            var $to = $( this).parents( 'footer.region').find( '.add-sort' );
            var $row = $( '#the-closet footer.region .row-element').last().clone( true );
            $row.appendTo( $to );
            $row = set_the_ids( $row );
            $row.trigger( 'init-row' );
            var id = $( this).parents( 'footer.region').find( '.row-element' ).last();
            var id1 = id.attr( 'data-id' );
            $( this).parents(' footer.region').find('.row-element .display_hint').last().show();

            $('.row-width input').click(function(){
                if($(this).val() == 'full_width_yes'){
                    $(this).parents( '.element-container' ).find('.row_bg_color_options').show();
                }else{
                    $(this).parents( '.element-container' ).find('.row_bg_color_options').hide();
                }

                $(this).parents( '.element-container' ).find('.row_bg_color_options').find('.wp-color-result:first').css('display', 'none');
            }); 

            $('.row-width input:checked').each(function(){
                
                if($(this).val() == 'full_width_yes'){
                    $(this).parents( '.element-container' ).find('.row_bg_color_options').show();
                }else{
                    $(this).parents( '.element-container' ).find('.row_bg_color_options').hide();
                }
                
            });

            cl++;                
            $('.delimiter-type input').click(function(){

                if($(this).parents( '.element-container' ).find('.delimiter_color_picker').find('.wp-color-result').length == 2 || cl >=2 ){
                    $(this).parents( '.element-container' ).find('.delimiter_color_picker').find('.wp-color-result:first').css('display', 'none');
                }
            })
        });

        $( '.edit-header').click( function(){
            $( this).parents( 'div.region-inside').children( '.element-container').addClass( 'editing' );
        });

        $( '.layout-builder').on( 'show-hide', '.options-orderby', function( event ){
            var $element_container = $( event.currentTarget).parents( '.element-container' );
            var element_type = $element_container.find( '.element-type input:checked').val();
            if( 'featured' != element_type ){
                $( event.currentTarget).find( '.orderby-hot-date').addClass( 'disabled').find( 'input').attr( 'disabled', true );
                if( $( event.currentTarget).find( '.orderby-hot-date input:checked').length ){
                    $( event.currentTarget).find( 'input').first().click().trigger( 'change' );
                }
            }else{
                $( event.currentTarget).find( '.orderby-hot-date.disabled').find( 'input').attr( 'disabled', false );
                $( event.currentTarget).find( '.orderby-hot-date').removeClass( 'disabled' );
            }
        });

        $( '.layout-builder').on( 'show-hide', '.options-behavior, .options-orderby, .options-order', function( event ){
            var $element_container = $( event.currentTarget).parents( '.element-container' );
            var element_type = $element_container.find( '.element-type input:checked').val();

            /*add values for which to hide Order option in the following array*/
            var arr = ['empty', 'delimiter','textelement','widget_zone','post', 'page', 'event', 'boxes','teams','banners','testimonials'];

            
            $( event.currentTarget).toggle( !( jQuery.inArray( element_type, arr) > -1 ) );
        });

        $( '.layout-builder').on( 'show-hide', '.options-team-rounded, .options-team-position', function( event ){
            var $element_container = $( event.currentTarget).parents( '.element-container' );
            var element_type = $element_container.find( '.element-type input:checked').val();
            $( event.currentTarget).toggle( 'teams' == element_type );
        });

        $( '.layout-builder').on( 'show-hide', '.options-show-excerpt, .options-show-meta, .options-content-position', function( event ){
            var $element_container = $( event.currentTarget).parents( '.element-container' );
            var element_type = $element_container.find( '.element-type input:checked').val();

            /*add bellow element types for which to hide classes above*/
            var arr = ['empty', 'delimiter','textelement','widget_zone','post', 'page', 'event', 'boxes','teams','banners','testimonials'];

            $( event.currentTarget).toggle( !( $element_container.find( '.element-view-type input:checked' ).val() != 'grid_view' || jQuery.inArray( element_type, arr) > -1 ) );

        });

        $( '.layout-builder').on( 'show-hide', '.masonry-options', function(event){
            var $element_container = $( event.currentTarget).parents( '.element-container' );
            var element_type = $element_container.find( '.element-type input:checked').val();
            var view = $element_container.find( '.element-view-type input:checked').val();
            $( event.currentTarget).toggle( ( view == 'grid_view' || view == 'grid_view_thumbnails') && element_type != 'empty' && element_type != 'delimiter' && element_type != 'textelement' && element_type != 'widget_zone' && element_type != 'post' && element_type != 'page' && element_type != 'event' && element_type != 'boxes' && element_type != 'teams' );
        });

        /*conditions when to show /hide gutter options*/
        $( '.layout-builder').on( 'show-hide', '.gutter-options', function(event){
            var $element_container = $( event.currentTarget).parents( '.element-container' );
            var element_type = $element_container.find( '.element-type input:checked').val();
            var view = $element_container.find( '.element-view-type input:checked').val();
            /*we want to show it only for thumbs view when NOT delimite, empty ... and other elements that don't display posts*/
            $( event.currentTarget).toggle( (view == 'grid_view_thumbnails') && element_type != 'empty' && element_type != 'delimiter' && element_type != 'textelement' && element_type != 'widget_zone' && element_type != 'post' && element_type != 'page' && element_type != 'event' && element_type != 'boxes' && element_type != 'teams' );
        });

        $( '.layout-builder').on( 'show-hide', '.options-orderby', function( event ){
            var $element_container = $( event.currentTarget).parents( '.element-container' );

            /*show the option to sort by Event start date Only if 'eventcategory' or 'latest_events' elements are selected*/
            if( 'eventcategory' == $element_container.find( '.element-type input:checked').val() || 'latest_events' == $element_container.find( '.element-type input:checked').val()){
                $( event.currentTarget).find( '.order-events-start-date.disabled').find( 'input').attr( 'disabled', false );
                $( event.currentTarget).find( '.order-events-start-date').show();
            }else{
                $( event.currentTarget).find( '.order-events-start-date').hide(); /*hide this option*/
                if( $( event.currentTarget).find( '.order-events-start-date input:checked').length ){
                    $( event.currentTarget).find( '.order-events-start-date input:checked').attr("disabled", "disabled")
                    $( event.currentTarget).find( 'input').prop( 'checked', false).parent().removeClass( 'selected' );
                    $( event.currentTarget).find( 'input:not(:disabled)').first().prop( 'checked', true );
                    $( event.currentTarget).find( 'input:not(:disabled)').first().parent().addClass( 'selected' );
                }
            }
        });

        $( '.layout-builder').on( 'show-hide', '.options-behavior', function( event ){
            var $element_container = $( event.currentTarget).parents( '.element-container' );

            /*if featured, latest post OR masonry is enabled  We have to disable enb_tabber Option */
            if( 'featured' == $element_container.find( '.element-type input:checked').val() || 'latest' == $element_container.find( '.element-type input:checked').val() || 'latest_events' == $element_container.find( '.element-type input:checked').val() || 'latest_events' == $element_container.find( '.element-type input:checked').val()  || 'yes' == $element_container.find( '.masonry-options label input:checked').val() ){
                $( event.currentTarget).find( '.enb_tabber').hide();
                if( $( event.currentTarget).find( '.enb_tabber input:checked').length ){
                    $( event.currentTarget).find( 'input').prop( 'checked', false).parent().removeClass( 'selected' );
                    $( event.currentTarget).find( 'input').last().prop( 'checked', true );
                    $( event.currentTarget).find( 'input').last().parent().addClass( 'selected' );
                }
            }else{
                $( event.currentTarget).find( '.enb_tabber.disabled').find( 'input').attr( 'disabled', false );
                $( event.currentTarget).find( '.enb_tabber').show();
            }

            if( 'grid_view' == $element_container.find( '.element-view-type input:checked').val() || 'list_view' == $element_container.find( '.element-view-type input:checked').val() ){
                $( event.currentTarget).find( '.enb_filters').addClass( 'disabled').find( 'input').attr( 'disabled', true );
                if( $( event.currentTarget).find( '.enb_filters input:checked').length ){
                    $( event.currentTarget).find( 'input').prop( 'checked', false).parent().removeClass( 'selected' );
                    $( event.currentTarget).find( 'input').last().prop( 'checked', true );
                    $( event.currentTarget).find( 'input').last().parent().addClass( 'selected' );
                }
            }else{
                $( event.currentTarget).find( '.enb_filters.disabled').find( 'input').attr( 'disabled', false );
                $( event.currentTarget).find( '.enb_filters').removeClass( 'disabled' );
            }

            /* show/hide full_width_thumb_news and small thumb view*/
/*            if($element_container.find( '.element-view-type input:checked').val() == 'news_view'){
                $( $element_container).find( '.full_width_thumb_news').show();
                $( $element_container).find( '.small_thumbnail').hide();
            }else{
                $( $element_container).find( '.full_width_thumb_news').hide();
                $( $element_container).find( '.small_thumbnail').show();
            }*/
            
            if( 'yes' == $element_container.find( '.masonry-options label input:checked').val() || 'list_view' == $element_container.find( '.element-view-type input:checked').val() || 'timeline_view' == $element_container.find( '.element-view-type input:checked').val() || 'latest' == $element_container.find( '.element-type input:checked').val() || 'latest_events' == $element_container.find( '.element-type input:checked').val()   /*|| 'news_view' == $element_container.find( '.element-view-type input:checked').val()*/ ){
                if( $( event.currentTarget).find( '.enb_carousel input:checked').length ){
                    $( event.currentTarget).find( 'input' ).prop( 'checked', false ).parent().removeClass( 'selected' );
                    $( event.currentTarget).find( 'input').last().prop( 'checked', true);
                    $( event.currentTarget).find( 'input').last().parent().addClass( 'selected' );
                }
                $( event.currentTarget).find( '.enb_carousel').addClass( 'disabled').find( 'input').attr( 'disabled', true );

                $( event.currentTarget).find( '.enb_filters').addClass( 'disabled').find( 'input').attr( 'disabled', true );
                                                
            }else{
                $( event.currentTarget).find( '.enb_carousel.disabled').find( 'input').attr( 'disabled', false );
                $( event.currentTarget).find( '.enb_carousel').removeClass( 'disabled' );
            }


            if( 'list_view' == $element_container.find( '.element-view-type input:checked').val() && 'yes' == $element_container.find( '.enb-list-thumbs-container input:checked').val() ){
                if( $( event.currentTarget).find( '.enb_carousel input:checked, .enb_pagination input:checked, .enb_load_more input:checked, .enb_tabber input:checked').length ){
                    $( event.currentTarget).find( 'input' ).prop( 'checked', false ).parent().removeClass( 'selected' );
                    $( event.currentTarget).find( 'input').last().prop( 'checked', true);
                    $( event.currentTarget).find( 'input').last().parent().addClass( 'selected' );
                }
                $( event.currentTarget).find( '.enb_pagination, .enb_load_more, .enb_tabber').addClass( 'disabled').find( 'input').attr( 'disabled', true );
            }else{
                $( event.currentTarget).find( '.enb_pagination.disabled, .enb_load_more.disabled, .enb_tabber.disabled').find( 'input').attr( 'disabled', false );
                $( event.currentTarget).find( '.enb_pagination, .enb_load_more, .enb_tabber').removeClass( 'disabled' );
            }
        });

        $( '.layout-builder').on( 'click', 'a.clear-input', function( event ){
            var $input = $( event.currentTarget).prev();
            $input.val( '').trigger( 'keyup' );
        });

        $( '.layout-builder').on( 'show-hide', '.options-view-type', function( event ){
            var $element_container = $( event.currentTarget).parents( '.element-container' );
            var element_type = $element_container.find( '.element-type input:checked').val();
            if( 'latest' == element_type || 'featured' == element_type || 'latest_events' == element_type ) {
                clear_box( '*', $( event.currentTarget).parents( '.element-container' ) );
            }
            $( event.currentTarget).toggle( !( element_type == 'widget_zone' || element_type == 'post' || element_type == 'page' || element_type == 'event' || element_type == 'boxes' || element_type == 'team' ) );
        });

        $( '.layout-builder').on( 'show-hide', '.options-list-view-excerpt', function( event ){
            var $element_container = $( event.currentTarget).parents( '.element-container' );
            var element_type = $element_container.find( '.element-type input:checked').val();
            $( event.currentTarget).toggle( ( element_type != 'empty' && element_type != 'delimiter' && element_type != 'textelement' && element_type != 'testimonials' && element_type != 'banners' && element_type != 'teams' && element_type != 'boxes' && element_type != 'widget_zone' && element_type != 'post' && element_type != 'page' && element_type != 'event' && element_type != 'box' && element_type != 'team' && ( $element_container.find( '.element-view-type input:checked' ).val() == 'list_view' ) ) );
        });

        $( '.layout-builder').on( 'show-hide', '.options-list-thumb-size, .options-list-title-position', function( event ){
            var $element_container = $( event.currentTarget).parents( '.element-container' );
            var element_type = $element_container.find( '.element-type input:checked').val();
            $( event.currentTarget).toggle( !( element_type == 'widget_zone' || element_type == 'post' || element_type == 'page' || element_type == 'boxes' || element_type == 'team' || ($element_container.find( '.element-view-type input:checked' ).val() != 'list_view' || $element_container.find('.enb-list-thumbs-container input:checked').val() == 'yes' ) ) );
        });

        $( '.layout-builder').on( 'show-hide', '.hide_excerpt-options', function( event ){
            var $element_container = $( event.currentTarget).parents( '.element-container' );
            var element_type = $element_container.find( '.element-type input:checked').val();
            $( event.currentTarget).toggle( !( element_type == 'textelement' || element_type == 'boxes' || element_type == 'testimonials' || element_type == 'banners' || element_type == 'widget_zone' || element_type == 'post' || element_type == 'page' || element_type == 'team' || ($element_container.find( '.element-view-type input:checked' ).val() != 'list_view' || $element_container.find( '.option-list-thumb-size input:checked' ).val() != 'no_thumb' || $element_container.find('.enb-list-thumbs-container input:checked').val() == 'yes' ) ) );
        });


        /*show 'number of columns' for menu only it has 'vertical' value*/
        $( '.layout-builder').on( 'show-hide', '.option-columns', function( event ){
            var $element_container = $( event.currentTarget).parents( '.element-container' );
            var element_type = $element_container.find( '.element-type input:checked').val();
            /*show 'number of columns' for menu only it has 'vertical' value*/
            $( event.currentTarget).toggle(  $element_container.find( '.generic-menustyles input:checked' ).val() == 'vertical' && (element_type == 'menu' || element_type == 'top_menu' ) );
        });

        $( '.layout-builder').on( 'show-hide', '.options-columns', function( event ){
            var $element_container = $( event.currentTarget).parents( '.element-container' );
            var element_type = $element_container.find( '.element-type input:checked').val(); 
            $element_container.find( '.options-numberposts .hint').add( event.currentTarget).toggle( !( element_type == 'empty' || element_type == 'delimiter' || element_type == 'widget_zone' || element_type == 'textelement' || element_type == 'post' || element_type == 'page' || element_type == 'event' || ($element_container.find( '.element-view-type input:checked' ).val() == 'list_view' && !(element_type == 'boxes' || element_type == 'teams') ) || ($element_container.find( '.element-view-type input:checked' ).val() == 'timeline_view' && !(element_type == 'boxes' || element_type == 'teams') ) /*|| ($element_container.find( '.element-view-type input:checked' ).val() == 'news_view' && !(element_type == 'boxes' || element_type == 'teams') )*/ || element_type == 'banners' || element_type == 'testimonials' ) );
        });


        $( '.layout-builder').on( 'show-hide', '.option-numberposts', function( event ){
            
            /*add values for which to hide NUmber of posts in the following array*/
            var arr = ['widget_zone','post','page','event', 'banners','logo', 'searchbar','login','testimonials','copyright', 'breadcrumbs','textelement','socialicons', 'delimiter', 'empty'];
            
            var $element_container = $( event.currentTarget).parents( '.element-container' );
            var element_type = $element_container.find( '.element-type input:checked').val();
            $( event.currentTarget).toggle( !( jQuery.inArray( element_type, arr) > -1 ) );
        });

        $( '.layout-builder').on( 'show-hide', '.popular_tags_options', function( event ){
            
            /*add values for which to Show 'popular_tags_options' in the following array*/
            var arr = ['popular_tags'];
            var $element_container = $( event.currentTarget).parents( '.element-container' );
            var element_type = $element_container.find( '.element-type input:checked').val();
            $( event.currentTarget).toggle( jQuery.inArray( element_type, arr) > -1 );
        });
        
        $( '.layout-builder').on( 'show-hide', '.text_align_options', function( event ){
            
            /*add values for which to Show 'text_align_options' in the following array*/
            var arr = ['menu', 'top_menu', 'socialicons', 'textelement', 'searchbar', 'logo', 'copyright'];
            var $element_container = $( event.currentTarget).parents( '.element-container' );
            var element_type = $element_container.find( '.element-type input:checked').val();
            $( event.currentTarget).toggle( jQuery.inArray( element_type, arr) > -1 );
        });

        /* show/hide Row BG color depending if full width row is enabled or not*/
        $('.row-width input').click(function(){
            if($(this).val() == 'full_width_yes'){
                $(this).parents( '.element-container' ).find('.row_bg_color_options').show();
            }else{
                $(this).parents( '.element-container' ).find('.row_bg_color_options').hide();
            }
        }); 

        $('.row-width input:checked').each(function(){
            
            if($(this).val() == 'full_width_yes'){
                $(this).parents( '.element-container' ).find('.row_bg_color_options').show();
            }else{
                $(this).parents( '.element-container' ).find('.row_bg_color_options').hide();
            }
            
        }); 

        $( '.layout-builder').on( 'show-hide', '.menu_options', function( event ){
            /*add values for which to show main menu Styles in the following array*/
            var arr = ['menu','top_menu'];
            
            var $element_container = $( event.currentTarget).parents( '.element-container' );
            var element_type = $element_container.find( '.element-type input:checked').val();
            $( event.currentTarget).toggle( ( jQuery.inArray( element_type, arr) > -1 ) );
        });

        $( '.layout-builder').on( 'show-hide', '.option-text', function( event ){
            
            /*add values for which to show Text of posts in the following array*/
            var arr = ['textelement'];
     
            var $element_container = $( event.currentTarget).parents( '.element-container' );
               var element_type = $element_container.find( '.element-type input:checked').val();
            $( event.currentTarget).toggle(  jQuery.inArray( element_type, arr) > -1 );
        });

        $( '.layout-builder').on( 'show-hide', '.option-social_hint', function( event ){
            
            /*add values for which to hide Text of posts in the following array*/
            var arr = ['socialicons'];
            
            var $element_container = $( event.currentTarget).parents( '.element-container' );
            var element_type = $element_container.find( '.element-type input:checked').val();
            //$( event.currentTarget).toggle( !( element_type == 'widget_zone' || element_type == 'post' || element_type == 'page' || element_type == 'banners') );
            $( event.currentTarget).toggle( jQuery.inArray( element_type, arr) > -1 );
        });

        $( '.layout-builder').on( 'show-hide', '.option-delimiter_hint', function( event ){
            
            /*add values for which to hide Text of posts in the following array*/
            var arr = ['delimiter'];
            
            var $element_container = $( event.currentTarget).parents( '.element-container' );
            var element_type = $element_container.find( '.element-type input:checked').val();
            $( event.currentTarget).toggle( jQuery.inArray( element_type, arr) > -1 );

            /*add values for which to hide Delimiter color Option in the following array*/
            var delimiter_arr = ['white_space'];
            
            var delimiter_type = $element_container.find( '.delimiter-type input:checked').val(); /*get the value of the selected delimiter type*/
            
            if(jQuery.inArray( delimiter_type, delimiter_arr) > -1){
                $element_container.find('.delimiter_color').hide();
            }else{
                $element_container.find('.delimiter_color').show();
                $('.my-color-field').wpColorPicker();
            }
            
        });

        $( '.layout-builder').on( 'show-hide', '.option-empty_hint', function( event ){
            
            /*add values for which to hide Text of posts in the following array*/
            var arr = ['empty'];
            
            var $element_container = $( event.currentTarget).parents( '.element-container' );
            var element_type = $element_container.find( '.element-type input:checked').val();
            $( event.currentTarget).toggle( jQuery.inArray( element_type, arr) > -1 );
        });

        $( '.layout-builder').on( 'show-hide', '.options-view-type', function( event ){
            var $element_container = $( event.currentTarget).parents( '.element-container' );
            var element_type = $element_container.find( '.element-type input:checked').val();
            $( event.currentTarget).toggle( element_type != 'empty' && element_type != 'delimiter' && element_type != 'boxes' && element_type != 'textelement' && element_type != 'teams' && element_type != 'banners' && element_type != 'testimonials' && element_type != 'widget_zone' && element_type != 'post' && element_type != 'event' && element_type != 'page' && element_type != 'boxes' && element_type != 'team' );
        });

        $( '.layout-builder').on( 'show-hide', '.option-list-thumb-size, .option-list-title-position', function( event ){
            var $element_container = $( event.currentTarget).parents( '.element-container' );
            var element_type = $element_container.find( '.element-type input:checked').val();
            $( event.currentTarget).toggle( !( element_type == 'empty' || element_type == 'delimiter' || element_type == 'textelement' || element_type == 'testimonials' || element_type == 'banners' || element_type == 'teams' || element_type == 'boxes' ||  element_type == 'widget_zone' || element_type == 'post' || element_type == 'event' || element_type == 'page' || element_type == 'boxes' || element_type == 'team' /*|| ($element_container.find( '.element-view-type input:checked' ).val() != 'news_view')*/ || ($element_container.find( '.element-view-type input:checked' ).val() != 'list_view' || $element_container.find('.enb-list-thumbs-container input:checked').val() == 'yes' ) ) );
        });

        $( '.layout-builder').on( 'show-hide', '.enb-list-thumbs-container', function( event ){
            var $element_container = $( event.currentTarget).parents( '.element-container' );
            var element_type = $element_container.find( '.element-type input:checked').val();
            $( event.currentTarget).toggle( !( element_type == 'empty' || element_type == 'delimiter' || element_type == 'textelement' || element_type == 'testimonials' || element_type == 'banners' || element_type == 'teams' || element_type == 'boxes' || element_type == 'widget_zone' || element_type == 'post' || element_type == 'page' || element_type == 'team' || ( $element_container.find( '.element-view-type input:checked' ).val() != 'list_view' && $element_container.find( '.element-view-type input:checked' ).val() != 'timeline_view') ) );
        });

        $( '.layout-builder').on( 'click', '.standard-generic-field label input, .taxonomy label input', function(){
            $( '.element-container.editing' ).find( '.standard-generic-field').first().trigger( 'show-hide' );
        });

        $( '.layout-builder').on( 'show-hide', '.standard-generic-field', function( event ){
            $( event.currentTarget ).nextAll( '.standard-generic-field').first().trigger( 'show-hide' );
        });

        $( '.layout-builder').on( 'click init-description', '.fpb.apply', function( event ){
            var $element_container = $( event.currentTarget).parents( '.element-container' );
            var type = $element_container.find( '.element-type input:checked').val();
            var text_label = $element_container.find( 'input.element-title').val(); /* Element label given by hte user */
            
            var text = $element_container.find( '.element-type label.selected').text(); /*The element type*/

            if(jQuery.trim(text_label) != '' ){
                text =  '<b>' + text_label+ '</b> - '+ text;               
            }
            $element_container.find( '.element-description').html( text );
        }).find( '.fpb.apply').trigger( 'init-description' );
    });
}( jQuery ) );


/* save new created template */
function save_templates(){
    var data = jQuery(".template_form").serialize();
        jQuery( '.saving-mesage').show();
        jQuery.ajax({
        url: MyAjax.ajaxurl,
        data: '&action=save_templates&template=' + data,
        type: 'POST',
        cache: false,
        success: function (data) { 
            not_updated = false;
            jQuery('.for_template_'+data).find('a.dbl-clickable-text').attr('href', 'admin.php?page=cosmothemes__templates&tab='+data);            
            jQuery( '.saving-mesage').hide();
            jQuery("html, body").animate({ scrollTop: 0 }, "slow");
            jQuery('#template_'+data).prepend('<div id="message-text"><span class="cosmo-ico"></span>Your settings have been saved</div>');
            setTimeout(function () {
            jQuery('#message-text').fadeOut(function(){
                jQuery(this).remove();
              });
            }, 2000);            
        },
        error: function (xhr) {
            
            
        }
    });
        //return false;
}

/* delete template*/
function delete_template(id){
    jQuery( '.admin-menu').on( 'click', '.delete', function( event ){
        if( confirm( 'Are you sure?' ) ){
        jQuery( '.layout-builder').prepend( '<h2 class="deleting-message">Deleting...</h2>' );

        var data = jQuery(".template_form").serialize();
        jQuery.ajax({
        url: MyAjax.ajaxurl,
        data: '&action=delete_template&template_id=' + id,
        type: 'POST',
        cache: false,
        success: function (data) { 
            window.location.href='?page=cosmothemes__templates';
        },
        error: function (xhr) {
                        
        }
        });
        return false;
        }
    });
}

jQuery(document).ready(function(){
    var id = jQuery('#last_selected_template' ).val();
    jQuery('.for_template_'+id).addClass('current');
});