var do_countdown;
var interval = false;
( function($){
	do_countdown = function () {
        if ($('.countdown-in-progress').length > 0) {
            $('.countdown-in-progress').each(function (index, element) {
                var value = $(element).find('.countdown').text();
                if (value <= 0) {
                    $(element).trigger('countdown');
                    $(element).removeClass('.countdown-in-progress');
                } else {
                    value--;
                    $(element).find('.countdown').text(value);
                }
            });
        } else if (interval != false) {
            clearInterval(interval);
            interval = false;
        }
    };

	$( document ).keyup( function( e ) { 
        if ( e.keyCode == 27 ){
        	$( document ).trigger( 'escape-key' );
        }
    });

    function get_me_a_placeholder( id, name, url ){
        var $addmore;
        var $place;
        if( $( '.place>input.place-id[value*='+ id +']').length ){
            $place = $( '.place>input.place-id[value*='+ id +']').parent();
        }else{
            $place = $( '#the-closet .place').clone();
            $place.find( 'input.place-id').val( id );
            $place.find( 'input.place-name').val( name );
            $place.find( 'input.place-url').val( url );
            $place.find( '.title').html( name );
            $addmore = $( '<div><div class="fl"><div class="big-plus"></div><h3>' + TooltipBuilder.translations.addmore + ' ' + name + '</h3></div></div>');
            $addmore.addClass( 'addmore' );
            $place.find( '.container').html( '').append( $addmore );
            var placeIdPlacehoder=new RegExp( "_place_" , 'g' );
            var html = $place.get( 0 ).outerHTML.replace( placeIdPlacehoder, id );
            var $place = $( html );
            $( '#elements-container').append( $place );
        }
        $addmore = $place.find( '.addmore' );
        var $placeholder = $( '<div></div>');
        $placeholder.addClass( 'placeholder' );
        $placeholder.insertBefore( $addmore );
        $place.trigger( 'init-overview-ui' );
        return $placeholder;
    }

    $( '.place .container' ).sortable({
        handle: '.on-overview .sort-zone'
    });

    function add_element( _id, name, url ){
        var $element = $( '#the-closet .element-container' ).clone();
        var date = new Date();
        var id = date.getTime();
        var html = $element.get( 0 ).outerHTML;
        var idPlacehoder=new RegExp( "_id_" , 'g' );
        var placeIdPlacehoder=new RegExp( "_place_" , 'g' );
        var $placeholder = get_me_a_placeholder( _id, name, url );
        $placeholder.height( $element.height() );
        html = html.replace( idPlacehoder, id).replace( placeIdPlacehoder, _id );
        $element = jQuery( html );
        $( 'body').append( $element );
        $element.css( 'position', 'fixed' )
            .css( 'opacity' , 0 )
            .css( 'left' , '2000px' )
            .css( 'top' , $placeholder.offset().top - $( window).scrollTop() )
            .show()
            .animate( { opacity:1, left: $placeholder.offset().left }, function(){
                $placeholder.replaceWith( $element );
                $element.css( 'position', 'static' );
                if( ( $element.offset().top + $element.width() ) > $( window).height() ){
                    $.scrollTo( $element.offset().top, 400 );
                }
                $( '#elements-container').trigger( 'init-overview-ui' );
            });
    }

    $( '#add_to_frontpage').click( function(){
        add_element( 'frontpage', TooltipBuilder.translations.frontpage, TooltipBuilder.home_url );
	});

    $( '#add_to_post').click( function(){
        query_for_id( '.posts.fly-left' );
    });

    $( '#add_to_page').click( function(){
        query_for_id( '.pages.fly-left' );
    });

    $( '.fly-left' ).bind( 'hide' , function(){
        $( this ).animate( { right:'-100%', opacity: 0 } );
        $( this).find( '.taxonomy').removeClass( 'selected').find( 'input').attr( 'checked', 'false' );
    });

    function query_for_id( selector ){
        $( '.fly-left').not( selector).trigger( 'hide' );
        var $box = $( selector );
        $box.show().animate({
            opacity:1,
            right:'25%'
        }).find( '.taxonomy input').unbind( 'change').change( function(){
            var title = $( this).parent().text();
            var ID = $( this).val();
            var url = $( this).siblings( 'a').attr( 'href' );
            add_element( ID, title, url );
            $box.trigger( 'hide' );
        });
    }

    $( '#elements-container').bind( 'init-overview-ui', function(){
        var $indicator = $( '#invisible-fixed-point' );
        var $elements_container = $( this );
        $elements_container.find( '.addmore').unbind( 'click' ).click( function(){
            $( this).addClass( 'has-overview-ui' );
            var $place = $( this).parents( '.place' );
            var id = $place.find( 'input.place-id' ).val();
            var name = $place.find( 'input.place-name' ).val();
            add_element( id, name );
        });

        $elements_container.find( '.element-container').not( '.has-overview-ui').each( function( index, element_container ){
            var $element_container = $( element_container );

            $element_container.find( '.has-hidden-input' ).dblclick( function(){
                var val = $( this).find( '.dblclickable-text').html();
                $( this).find( '.dblclickable-text').hide();
                $( this).find( '.hidden-input' ).val( val).show().focus().select();
            });

            $element_container.find( '.hidden-input').on( 'change blur', function(){
                var val = $( this).val();
                $( this).hide();
                $( this).siblings( '.dblclickable-text').html( val).show();
            });

            $element_container.find( '.demo-content .hidden-input').on( 'change blur', function(){
                var val = $( this).val();
                $element_container.find( '.demo-content .hidden-input').not( this).val( val);
                $element_container.find( '.demo-content .hidden-input').not( this).siblings( '.dblclickable-text').html( val );
            });

            $element_container.find( '.demo-steps strong .hidden-input').on( 'change blur', function(){
                var val = $( this).val();
                $element_container.find( '.demo-steps strong .hidden-input').not( this).val( val);
                $element_container.find( '.demo-steps strong .hidden-input').not( this).siblings( '.dblclickable-text').html( val );
            });

            $element_container.addClass( 'has-overview-ui' );
            $element_container.find( '.on-overview .edit' ).click( function(){
                var $place = $( this).parents( '.place' );
                var url = $place.find( 'input.place-url').val();
                var $placeholder = $( '<div></div>' );
                $placeholder.addClass( 'placeholder' );
                if( $( '#tooltip-builder-iframe iframe').attr( 'src' ) != url ){
                    $( '#tooltip-builder-iframe iframe').attr( 'src', url );
                    $( '#tooltip-builder-iframe').fadeIn( function(){
                        $( '#tooltip-builder-iframe iframe').unbind( 'load').bind( 'load', function(){
                            $($("#tooltip-builder-iframe iframe")[0].contentWindow).scrollTo( parseInt( $element_container.find( 'input.pos-y').val() ) );
                            $($("#tooltip-builder-iframe iframe")[0].contentWindow).unbind( 'scroll' ).scroll( function(){
                                var y = parseInt( $element_container.find( 'input.pos-y').val() ) + parseInt( $( '#fake-container').offset().top ) - parseInt( $($("#tooltip-builder-iframe iframe")[0].contentWindow).scrollTop() );
                                $element_container.css( { top: y } );
                            });
                            $( '#tooltip-builder-iframe iframe').contents().find( '.demo-tooltip' ).remove();
                            var width = $( this).contents().find( '#page').width() + 30;
                            var left = $( this).contents().find( '#page').offset().left;
                            var top = $( this).contents().find( '#page').offset().top;
                            $( '#fake-container').width( width).css( 'left', left-30 ).css( 'top', top );
                            var oldX = $element_container.offset().left;
                            var oldY = $element_container.offset().top;
                            var x = parseInt( $element_container.find( 'input.pos-x').val() ) + parseInt( $( '#fake-container').offset().left );
                            var y = parseInt( $element_container.find( 'input.pos-y').val() ) + parseInt( $( '#fake-container').offset().top ) - parseInt( $($("#tooltip-builder-iframe iframe")[0].contentWindow).scrollTop() );
                            $element_container.addClass( 'editing' )
                                .css( 'left', oldX )
                                .css( 'top', oldY )
                                .animate( { left: x, top: y }, function(){
                                    $placeholder.insertBefore( $element_container );
                                    $element_container.trigger( 'init-editing-ui' );
                                });
                        });
                    });
                }else{
                    $( '#tooltip-builder-iframe').fadeIn( function(){
                        $($("#tooltip-builder-iframe iframe")[0].contentWindow).scrollTo( parseInt( $element_container.find( 'input.pos-y').val() ) );
                        var oldX = $element_container.offset().left;
                        var oldY = $element_container.offset().top;
                        var x = parseInt( $element_container.find( 'input.pos-x').val() ) + parseInt( $( '#fake-container').offset().left );
                        var y = parseInt( $element_container.find( 'input.pos-y').val() ) + parseInt( $( '#fake-container').offset().top ) - parseInt( $($("#tooltip-builder-iframe iframe")[0].contentWindow).scrollTop() );
                        $element_container.addClass( 'editing' )
                            .css( 'left', oldX )
                            .css( 'top', oldY )
                            .animate( { left: x, top: y }, function(){
                                $placeholder.insertBefore( $element_container );
                                $element_container.trigger( 'init-editing-ui' );
                            });
                    });
                }
            });

            $element_container.find( '.on-overview .delete').click( function(){
                $element_container.addClass( 'countdown-in-progress' );
                $element_container.find( '.tooltip-element' ).hide();
                $element_container.find( '.undo-container' ).show();
                if( interval == false ){
                    interval = setInterval( 'do_countdown()', 1000 );
                }
            });

            $element_container.bind( 'countdown', function(){
                $element_container.parents( '.place').trigger( 'countdown' );
                if( $( this ).hasClass( 'countdown-in-progress' ) ){
                    $( this ).animate( { left:'+2000' , height:1, opacity:0 }, function(){
                        $( this ).remove();
                        setTimeout( "jQuery( '#elements-container' ).trigger( 'init-overview-ui' );" , 1000 );
                    });
                }
            });

            $element_container.find( '.undo' ).click( function(){
                $element_container.removeClass( 'countdown-in-progress' );
                $( this ).siblings( '.countdown' ).text( 5 );
                $( this ).find( '.countdown' ).text( 5 );
                $element_container.find( '.tooltip-element' ).show();
                $element_container.find( '.undo-container' ).hide();
            });

            $element_container.bind( 'init-editing-ui', function( event, callback ){
                if( $element_container.hasClass( 'has-editing-ui' ) ){
                    return 0;
                }

                $( this ).draggable({
                    containment: '#fake-container',
                    handle: '.on-edit .sort-zone',
                    drag: function(){
                        var x = $( this).offset().left - $( '#fake-container').offset().left;
                        var y = $( this).offset().top - $( '#fake-container').offset().top + $($("#tooltip-builder-iframe iframe")[0].contentWindow).scrollTop();
                        $( '.element-container.editing span.pos-x').text( x );
                        $( '.element-container.editing input.pos-x').val( x );
                        $( '.element-container.editing span.pos-y').text( y );
                        $( '.element-container.editing input.pos-y').val( y );
                    }
                });

                $element_container.find( 'span.pos').dblclick( function(){
                    $( this).hide().next().show();
                });

                $element_container.find( 'input.pos').bind( 'blur change', function(){
                    $( this).hide().prev().show().text( $( this).val() );
                    var left = parseInt( $element_container.find( 'input.pos-x').val() ) + parseInt( $( '#fake-container').offset().left );
                    var top = parseInt( $element_container.find( 'input.pos-y').val() ) + parseInt( $( '#fake-container').offset().top ) - parseInt( $($("#tooltip-builder-iframe iframe")[0].contentWindow).scrollTop() );
                    $element_container.animate({
                        top: top,
                        left: left
                    });
                });

                $element_container.addClass( 'has-editing-ui' );
                $element_container.find( '.discard' ).click( function(){
                    if( $element_container.hasClass( 'newborn' ) ){
                        $element_container.animate( { opacity:0, top:'2500px' }, function(){
                            $element_container.remove();
                        });
                    }else{
                        $element_container.css( 'top' , $element_container.offset().top - $( window).scrollTop() );
                        $element_container.css( 'left' , $element_container.offset().left );
                        $element_container.css( 'width' , $element_container.width() );
                        $element_container.css( 'height' , $element_container.height() );
                        var $placeholder = $element_container.prev();
                        var newTop = $placeholder.offset().top - $( window).scrollTop();
                        var newLeft = $placeholder.offset().left;
                        var newWidth = $placeholder.width();
                        var newHeight = $placeholder.height();
                        $element_container.animate( { opacity:0.1, left: newLeft - 10, top:newTop - 10, width:newWidth, height: newHeight }, function(){
                            $element_container.css( 'top' , 'auto' )
                                .css( 'left' , 'auto' )
                                .animate( { opacity: 1 } )
                                .removeClass( 'editing' );
                            if( $placeholder.hasClass( 'placeholder' ) ){
                                $placeholder.replaceWith(  $element_container );
                            }
                        });
                    }
                    $( '#elements-container' ).trigger( 'init-overview-ui' );
                    $( '#element-builder-shadow').removeClass( 'block' );
                });

                $element_container.find( '.option-numberposts input' ).bind('keyup', function(){
                    act.accept_digits( this );
                });

                $element_container.find( '.arrow').click( function(){
                    if( $( this ).hasClass( 'left' ) ){
                        $( this).removeClass( 'left').addClass( 'top' );
                        var toAdd = 'top'
                    }else if( $( this).hasClass( 'top' ) ){
                        $( this).removeClass( 'top');
                        var toAdd = 'right'
                    }else{
                        $( this).removeClass( 'right');
                        var toAdd = 'left'
                    }
                    $( this).addClass( toAdd );
                    $( this).next( 'input').val( toAdd );
                });

                $element_container.find( '.apply' ).click( function(){
                    $( '#tooltip-builder-iframe').hide();
                    var id = $element_container.find( '.element-id' ).val();
                    $element_container.css( 'top' , $element_container.offset().top - $( window).scrollTop() );
                    $element_container.css( 'left' , $element_container.offset().left );
                    $element_container.css( 'width' , $element_container.width() );
                    $element_container.css( 'height' , $element_container.height() );
                    var $placeholder = $element_container.prev();
                    var newTop = $placeholder.offset().top - $( window).scrollTop();
                    var newLeft = $placeholder.offset().left;
                    var newWidth = $placeholder.width();
                    $element_container.animate( { opacity:0.1, left: newLeft - 13, top:newTop - 13 }, function(){
                        $element_container.css( 'top' , 'auto' )
                            .css( 'left' , 'auto' )
                            .animate( { opacity: 1 } )
                            .removeClass( 'editing' );
                        if( $placeholder.hasClass( 'placeholder' ) ){
                            $placeholder.replaceWith( $element_container );
                        }
                        $( '#elements-container' ).trigger( 'init-overview-ui' );
                    });
                });

                $element_container.find( '.on-edit .panel .generic-field-image-select label' ).click( function(){
                    if( !jQuery( this).parent( 'a.disabled').length ){
                        $( this ).siblings().removeClass( 'selected').filter( 'a.has-popup').find( 'label').removeClass( 'selected' );
                        $( this).parents( 'a.has-popup').siblings().removeClass( 'selected');
                        $( this ).addClass( 'selected' );
                    }
                });

                $element_container.find( '.on-edit .panel .generic-field-image-select label input:checked' ).parents( 'label').trigger( 'click' );

                $element_container.find( '.fly-left.taxonomies .search' ).not( '.generic-record-search' ).keyup( function(){
                    var val = $( this ).val();
                    $( this ).parents( '.fly-left' ).find( '.taxonomy' ).each( function( index, element ) {
                        if( $( element ).text().toLowerCase().trim().indexOf( val.toLowerCase().trim() ) == -1 ){
                            $( element ).hide();
                        }else{
                            $( element ).show();
                        }
                    });
                });

                $element_container.find( 'a.clear-input' ).click( function(){
                    var $input = $( this ).prev();
                    var val = $input.val();
                    if( val && val.length ){
                        val = val.slice( 0, -1 );
                        $input.val( val );
                        $input.trigger( 'keyup' );
                        setTimeout( "jQuery( 'a.clear-input' ).click()", 20 );
                    }
                });

                $element_container.find( '.fly-left.taxonomies .search.generic-record-search' ).change( function(){
                    var top = $( this ).position().top;
                    var $placeholder = $( '<div class="placeholder"></div>' );
                    $container = $( '<label></label>' );
                    $container.addClass( 'taxonomy' );
                    $placeholder.insertBefore( $( this ).parents( '.fly-left' ).find( '.content .taxonomy' ).first() );
                    $placeholder.css( 'height', '1px' );
                    var $search_input = $( this );
                    $container.css( 'position' , 'absolute' )
                        .css( 'top' , top )
                        .animate( { top: $placeholder.position().top }, function(){
                            var postID = $search_input.siblings( '.generic-value' ).val();
                            $placeholder.replaceWith( $container );
                            var $idInput = $( '<input>' );
                            $idInput.val( postID )
                                .attr( 'name' , $container.next().find( 'input' ).attr( 'name' ) )
                                .attr( 'type' , 'radio' )
                                .attr( 'checked' , 'checked' );
                            $container.siblings().find( 'input[value=' + postID + ']' ).parent().remove();
                            $container.css( 'position' , 'static' )
                                .css( 'top' , '' )
                                .text( $search_input.val() )
                                .append( $idInput )
                                .addClass( 'added')
                                .siblings().removeClass( 'added' )
                                .find( 'input' ).attr( 'checked' , false );
                            $( '#elements-container').trigger( 'init-overview-ui' );
                        });
                    $placeholder.animate( { height: 15 } );
                });

                var boxShow = function (box) {
                    $(box).css('left', '65%').css('opacity', 1).find('input.search').focus();
                    if ('function' == typeof callback) {
                        callback();
                    }
                };

                $element_container.find( '.element-type input' ).change( function(){
                    var id = $element_container.find( '.element-id' ).val();
                    var $box = false;
                    if( $( this ).hasClass( 'widget-type' ) ){
                        $box = $element_container.find( '.widgets.fly-left' );
                    }else{
                        $element_container.find( '.widgets.fly-left' ).trigger( 'hide' );
                    }

                    if( $( this ).hasClass( 'post-type' ) ){
                        $box = $element_container.find( '.posts.fly-left' );
                    }else{
                        $element_container.find( '.posts.fly-left' ).trigger( 'hide' );
                    }

                    if( $( this ).hasClass( 'page-type' ) ){
                        $box = $element_container.find( '.pages.fly-left' );
                    }else{
                        $element_container.find( '.pages.fly-left' ).trigger( 'hide' );
                    }

                    if( $( this ).hasClass( 'category-type' ) ){
                        $box = $element_container.find( '.categories.fly-left' );
                    }else{
                        $element_container.find( '.categories.fly-left' ).trigger( 'hide' );
                    }

                    if( $( this ).hasClass( 'tag-type' ) ){
                        $box = $element_container.find( '.tags.fly-left' );
                    }else{
                        $element_container.find( '.tags.fly-left' ).trigger( 'hide' );
                    }

                    if( $( this ).hasClass( 'portfolio-type' ) ){
                        $box = $element_container.find( '.portfolios.fly-left' );
                    }else{
                        $element_container.find( '.portfolios.fly-left' ).trigger( 'hide' );
                    }
                    
                    if( $box !== false ){
                        boxShow( $box );
                    }
                });

                $element_container.find( '.pages.fly-left .taxonomy input, .posts.fly-left .taxonomy input').change( function(){
                    if( $( this ).is( ':checked' ) ){
                        $( this ).parents( '.content' ).find( '.taxonomy.added input' ).trigger( 'change' );
                        $( this ).parent().addClass( 'added' );
                        var $placeholder = $( '<div class="placeholder"></div>' );
                        $container = $( this ).parent();
                        if( $container.prev().length ){
                            $placeholder.insertBefore( $container.siblings( '.taxonomy' ).first() );
                            $placeholder.css( 'height', '1px' );
                            $container.css( 'position' , 'absolute' )
                                .css( 'top' , $container.position().top )
                                .animate( { top: $placeholder.position().top }, function(){
                                    $placeholder.replaceWith( $container );
                                    $container.css( 'position' , 'static' )
                                        .css( 'top' , '' );
                                });
                            $placeholder.animate( { height: 15 } );
                        }
                    }else{
                        $( this ).parent().removeClass( 'added' );
                    }
                });

                $element_container.find( '.fly-left' ).not( '.pages' ).not( '.posts' ).find( '.taxonomy input' ).change( function(){
                    var $container = $( this ).parents( 'label' );
                    $container.toggleClass( 'added' );
                    var $placeholder = $( '<div class="placeholder"></div>' );
                    if( $container.hasClass( 'added' ) && !$container.prev().hasClass( 'added' ) && $container.prev().hasClass( 'taxonomy' ) ){
                        if( $container.siblings( '.added' ).length ){
                            $placeholder.insertAfter( $container.siblings( '.added' ).last() );
                        }else{
                            $placeholder.insertBefore( $container.siblings( '.taxonomy' ).first() );
                        }
                        $placeholder.css( 'height', '1px' );
                        $container.css( 'position' , 'absolute' )
                            .css( 'top' , $container.position().top )
                            .animate( { top: $placeholder.position().top }, function(){
                                $placeholder.replaceWith( $container );
                                $container.css( 'position' , 'static' )
                                    .css( 'top' , '' );
                            });
                        $placeholder.animate( { height: 15 } );
                    }else if( $container.siblings( '.added' ).length && $container.next().hasClass( 'added' )  ){
                        $placeholder.insertAfter( $container.siblings( '.added' ).last() );
                        $placeholder.css( 'height', '1px' );
                        $container.css( 'position' , 'absolute' )
                            .css( 'top' , $container.position().top )
                            .animate( { top: $placeholder.position().top }, function(){
                                $placeholder.replaceWith( $container );
                                $container.css( 'position' , 'static' )
                                    .css( 'top' , '' );
                            });
                        $placeholder.animate( { height: 15 } );
                    }
                });

                var hideGenericField = function (elem) {
                    $(elem).hide();
                };

                var showGenericField = function (elem) {
                    $(elem).show();
                };

                $element_container.find( '.options-behavior').bind( 'show-hide', function(){
                    var element_type = $element_container.find( '.element-type input:checked' ).val();
                    if( element_type == 'widget_zone' || element_type == 'post' || element_type == 'page' || $element_container.find( '.element-view-type input:checked' ).val() == 'list_view' ){
                        hideGenericField( this );
                    }else{
                        showGenericField( this );
                        if( $element_container.find( '.element-view-type input:checked' ).val() == 'grid_view' ){
                            jQuery( this).find( '.enb_filters').addClass( 'disabled').find( 'input').attr( 'disabled' ,true );
                            if( jQuery( this).find( '.enb_filters input:checked').length ){
                                jQuery( this).find( 'input').first().click().trigger( 'change' );
                            }

                        }else{
                            jQuery( this).find( '.enb_filters').addClass( 'disabled').find( 'input').attr( 'disabled' ,false );
                            jQuery( this).find( '.enb_filters').removeClass( 'disabled' );
                        }
                    }
                });


                $element_container.find( '.standard-generic-field input, .taxonomy input').change( function(){
                    $element_container.find( '.standard-generic-field').trigger( 'show-hide' );
                    if( $element_container.find( '.preview.needed').length ){
                        var $form = $( this).parents( 'form').clone();
                        var id = $element_container.find( 'iframe' ).attr( 'name' );
                        $form.attr( 'target' , id )
                            .attr( 'action' , FrontpageBuilder.home_url )
                            .css( 'display', 'none' )
                            .appendTo( $( 'body' ) )
                            .submit()
                            .remove();
                    }
                    var type = $element_container.find( '.element-type input:checked').val();
                });
                $element_container.find( '.standard-generic-field input' ).filter( ':checked, :selected').trigger( 'change' );

                hideGenericField = function (elem) {
                    $(elem).slideUp();
                };

                showGenericField = function (elem) {
                    $(elem).slideDown();
                };

                boxShow = function( box ){
                    $( box ).animate( { left:'65%', opacity: 1 }, function(){
                        $( this ).find( 'input.search' ).focus();
                    });
                }
            });
        });
    }).trigger( 'init-overview-ui' );
    $( '.element-container').trigger( 'init-editing-ui' );

    $( '#element-builder-shadow').click( function(){
        $( '.element-container.editing .discard' ).click();
    });
	$( document ).on( 'escape-key' , function(){
		$( '.element-container.editing .discard' ).click();
	});

    $( window).resize( function(){
        $( '#tooltip-builder-iframe iframe').trigger( 'resize' );
    });

	$( '.standard-generic-field.submit input[type=submit]' ).click( function( event ){
		if( $( '.countdown-in-progress' ).length ){
			event.preventDefault();
			$( '.element-container' ).trigger( 'countdown' );
			setTimeout( function(){
				$( '.standard-generic-field.submit input[type=submit]' ).click();
			}, 500 );
		}
	});
}(jQuery) );