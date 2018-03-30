/*global redux_change, wp, redux*/

(function( $ ) {
    "use strict";

    redux.field_objects = redux.field_objects || {};
    redux.field_objects.rows = redux.field_objects.rows || {};

    $( document ).ready(
        function() {
            //redux.field_objects.rows.init();
        }
    );

    redux.field_objects.rows.init = function( selector ) {
        if ( !selector ) {
            selector = $( document ).find( ".redux-group-tab:visible" ).find( '.redux-container-rows:visible' );
        }

        $( selector ).each(

            function() {
                var el = $( this );
                redux.field_objects.row_media.init(el);
                redux.field_objects.rows.initCheckbox(el);
                redux.field_objects.rows.initRadioButton(el);
                redux.field_objects.rows.initHeadingGroup(el);

                var parent = el;
                if ( !el.hasClass( 'redux-field-container' ) ) {
                    parent = el.parents( '.redux-field-container:first' );
                }
                if ( parent.is( ":hidden" ) ) { // Skip hidden fields
                    return;
                }
                
                if ( parent.hasClass( 'redux-container-rows' ) ) {
                    parent.addClass( 'redux-field-init' );    
                }
                
                if ( parent.hasClass( 'redux-field-init' ) ) {
                    parent.removeClass( 'redux-field-init' );
                } else {
                    return;
                }

                redux.field_objects.rows.initSelect2(this);

                el.find( '.redux-slides-remove' ).live(
                    'click', function() {
                        redux_change( $( this ) );

                        $( this ).parent().siblings().find( 'input[type="text"]' ).val( '' );
                        $( this ).parent().siblings().find( 'textarea' ).val( '' );
                        $( this ).parent().siblings().find( 'input[type="hidden"]' ).val( '' );

                        var slideCount = $( this ).parents( '.redux-container-rows:first' ).find( '.redux-slides-accordion-group' ).length;

                        if ( slideCount > 1 ) {
                            $( this ).parents( '.redux-slides-accordion-group:first' ).slideUp(
                                'medium', function() {
                                    $( this ).remove();
                                }
                            );
                        } else {
                            var content_new_title = $( this ).parent( '.redux-slides-accordion' ).data( 'new-content-title' );

                            $( this ).parents( '.redux-slides-accordion-group:first' ).find( '.remove-image' ).click();
                            $( this ).parents( '.redux-container-rows:first' ).find( '.redux-slides-accordion-group:last' ).find( '.redux-slides-header' ).text( content_new_title );
                        }
                    }
                );

                //el.find( '.redux-slides-add' ).click(
                el.find( '.redux-slides-add' ).off('click').click(
                    function() {
                        var lastSlide = $( this ).prev().find( '.redux-slides-accordion-group:last' );
                        lastSlide.find('select.select2-offscreen').select2('destroy');

                        var newSlide = $( this ).prev().find( '.redux-slides-accordion-group:last' ).clone( true );
                        var slideCount = $( newSlide ).find( '.slide-title' ).attr( "name" ).match( /[0-9]+(?!.*[0-9])/ );


                        var slideCount1 = slideCount * 1 + 1;

                        $( newSlide ).find( 'input[type="text"],input[type="checkbox"], input[type="radio"], input[type="hidden"], textarea' ).each(
                            function() {
                                if(this.hasAttribute('name')){

                                    if( ($(this).is(':hidden') && ($(this).hasClass('checkbox-check') || $(this).hasClass('radio-button-value') ) )){
                                        $( this ).attr(
                                            "name", jQuery( this ).attr( "name" ).replace( /\[[0-9]\]/, '[' + slideCount1 + ']' )
                                        );
                                    }else if( $(this).is(':radio')){
                                        $( this ).attr(
                                            "name", jQuery( this ).attr( "name" ).replace( /_[0-9]_/, '_' + slideCount1 + '_' )
                                        );

                                    }else{
                                        $( this ).attr(
                                            "name", jQuery( this ).attr( "name" ).replace( /[0-9]+(?!.*[0-9])/, slideCount1 )
                                        );
                                        $( this ).val( '' );
                                    }

                                }
                                if ( $( this ).hasClass( 'slide-sort' ) ) {
                                    $( this ).val( slideCount1 );
                                }
                                if(this.hasAttribute('id')){
                                    $( this ).attr( "id", $( this ).attr( "id" ).replace( /[0-9]+(?!.*[0-9])/, slideCount1 ) );
                                }
                                if($(this).is(':checkbox')){
                                    $(this).attr('checked', false);
                                }
                            }
                        );

                        //process select 2
                        $('select.redux-select-item', newSlide ).each(
                            function(){
                                if(this.hasAttribute('name')){
                                    $( this ).attr(
                                        "name", jQuery( this ).attr( "name" ).replace( /[0-9]+(?!.*[0-9])/, slideCount1 )
                                    ).attr( "id", $( this ).attr( "id" ).replace( /[0-9]+(?!.*[0-9])/, slideCount1 ) );
                                    $( this ).val( '' );
                                    if ( $( this ).hasClass( 'slide-sort' ) ) {
                                        $( this ).val( slideCount1 );
                                    }
                                }

                            }
                        )

                        var content_new_title = $( this ).prev().data( 'new-content-title' );

                        $( newSlide ).find( '.screenshot' ).removeAttr( 'style' );
                        $( newSlide ).find( '.screenshot' ).addClass( 'hide' );
                        $( newSlide ).find( '.screenshot a' ).attr( 'href', '' );
                        $( newSlide ).find( '.remove-image' ).addClass( 'hide' );
                        $( newSlide ).find( '.redux-slides-image' ).attr( 'src', '' ).removeAttr( 'id' );
                        $( newSlide ).find( 'h3' ).text( '' ).append( '<span class="redux-slides-header">' + content_new_title + '</span><span class="ui-accordion-header-icon ui-icon ui-icon-plus"></span>' );
                        $( this ).prev().append( newSlide );
                        redux.field_objects.rows.initSelect2(newSlide);
                        redux.field_objects.rows.initSelect2(lastSlide);

                        redux.field_objects.rows.initCheckbox(newSlide);
                        redux.field_objects.rows.initHeadingGroup(newSlide);

                        redux.field_objects.rows.initRadioButton(newSlide);
                    }
                );

                el.find( '.slide-title' ).keyup(
                    function( event ) {
                        var newTitle = event.target.value;
                        $( this ).parents().eq( 3 ).find( '.redux-slides-header' ).text( newTitle );
                    }
                );


                el.find( ".redux-slides-accordion" )
                    .accordion(
                    {
                        header: "> div > fieldset > h3",
                        collapsible: true,
                        active: false,
                        heightStyle: "content",
                        icons: {
                            "header": "ui-icon-plus",
                            "activeHeader": "ui-icon-minus"
                        }
                    }
                )
                    .sortable(
                    {
                        axis: "y",
                        handle: "h3",
                        connectWith: ".redux-slides-accordion",
                        start: function( e, ui ) {
                            ui.placeholder.height( ui.item.height() );
                            ui.placeholder.width( ui.item.width() );
                        },
                        placeholder: "ui-state-highlight",
                        stop: function( event, ui ) {
                            // IE doesn't register the blur when sorting
                            // so trigger focusout handlers to remove .ui-state-focus
                            ui.item.children( "h3" ).triggerHandler( "focusout" );
                            var inputs = $( 'input.slide-sort' );
                            inputs.each(
                                function( idx ) {
                                    $( this ).val( idx );
                                }
                            );
                        }
                    }
                );
            }
        );
    };
    redux.field_objects.rows.initSelect2 = function(el){
        $('select.redux-select-item',el).each(
            function() {
                var default_params = {
                    width: 'resolve',
                    triggerChange: true,
                    allowClear: true
                };
                if ( $( this ).siblings( '.select2_params' ).size() > 0 ) {
                    var select2_params = $( this ).siblings( '.select2_params' ).val();
                    select2_params = JSON.parse( select2_params );
                    default_params = $.extend( {}, default_params, select2_params );
                }
                if ( $( this ).hasClass( 'font-icons' ) ) {
                    default_params = $.extend(
                        {}, {
                            formatResult: redux.field_objects.rows.addIcon,
                            formatSelection: redux.field_objects.rows.addIcon,
                            escapeMarkup: function( m ) {
                                return m;
                            }
                        }, default_params
                    );
                }

                $( this ).select2( default_params );

                if ( $( this ).hasClass( 'select2-sortable' ) ) {
                    default_params = {};
                    default_params.bindOrder = 'sortableStop';
                    default_params.sortableOptions = {placeholder: 'ui-state-highlight'};
                    $( this ).select2Sortable( default_params );
                }

                $( this ).on(
                    "change", function() {
                        redux_change( $( $( this ) ) );
                        $( this ).select2SortableOrder();
                    }
                );
            }
        );

    };

    redux.field_objects.rows.initCheckbox = function(container){
        $( 'li.check-box', container ).each(
            function() {
                var el = $( this );
                var parent = el;
                if ( parent.is( ":hidden" ) ) { // Skip hidden fields
                    return;
                }
                el.find( '.checkbox' ).on(
                    'click', function( e ) {
                        var val = 0;
                        if ( $( this ).is( ':checked' ) ) {
                            val = $( this ).parent().find( '.checkbox-check' ).attr( 'data-val' );
                        }
                        $( this ).parent().find( '.checkbox-check' ).val( val );
                        redux_change( $( this ) );
                    }
                );
            }
        );
    };
    redux.field_objects.rows.initRadioButton = function(container){
        $( 'input[type="radio"]', container ).each(
            function() {
                var el = $( this );
                $(this).change(function(){
                    var parentWrap = $(this).parent().parent().parent();
                    $('input[type="hidden"]',parentWrap).val($(this).val());
                });
            }
        );
    }

    redux.field_objects.rows.addIcon = function( icon ) {
        if ( icon.hasOwnProperty( 'id' ) ) {
            return "<span class='elusive'><i class='" + icon.id + "'></i>" + "&nbsp;&nbsp;" + icon.text + "</span>";
        }
    };
    redux.field_objects.rows.initHeadingGroup = function(el){
        $('.redux-slides-accordion-group', el).each(function(){
            var parent = $(this);
            $( this ).find( 'input.slide-title' ).each(
                function(){
                    var $title = $(this).val();
                    $('h3',parent).html($title);

                    $(this).change(function(){
                        var parent = $(this).parent().parent().parent().parent();
                        $('h3',parent).html($(this).val());
                    })
                }
            );
        });

    };
})( jQuery );