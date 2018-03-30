/*
 Field Color (color)
 */

/*global jQuery, document, redux_change, redux*/

(function( $ ) {
    'use strict';

    redux.field_objects = redux.field_objects || {};
    redux.field_objects.color = redux.field_objects.color || {};

    $( document ).ready(
        function() {

        }
    );


    var $ = jQuery;

        Color.prototype.toString = function() {
            if (this._alpha < 1) {
                return this.toCSS('rgba', this._alpha).replace(/\s+/g, '');
            }
            var hex = parseInt(this._color, 10).toString(16);
            if (this.error)
                return '';
            if (hex.length < 6) {
                for (var i = 6 - hex.length - 1; i >= 0; i--) {
                    hex = '0' + hex;
                }
            }
            return '#' + hex;
        };
        $('.color-picker-holder .color-picker').each(function() {
            var $control = $(this);

/*          if (!$control.hasClass('pickerStarted')) {*/

                var value = $control.val().replace(/\s+/g, ''),
                    alpha_val = 100,
                    $alpha, $alpha_output;
                if (value.match(/rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/)) {
                    alpha_val = parseFloat(value.match(/rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/)[1]) * 100;
                }
                $control.wpColorPicker({
                    clear: function(event, ui) {
                        $alpha.val(100);
                        $alpha_output.val(100 + '%');
                    }
                });
                $('<div class="vc_alpha-container">' + '<label>Alpha: <output class="rangevalue">' + alpha_val + '%</output></label>' + '<input type="range" min="1" max="100" value="' + alpha_val + '" name="alpha" class="vc_alpha-field">' + '</div>').appendTo($control.parents('.wp-picker-container:first').addClass('vc_color-picker').find('.iris-picker'));
                $alpha = $control.parents('.wp-picker-container:first').find('.vc_alpha-field');
                $alpha_output = $control.parents('.wp-picker-container:first').find('.vc_alpha-container output')
                $alpha.bind('change keyup', function() {
                    var alpha_val = parseFloat($alpha.val()),
                        iris = $control.data('a8cIris'),
                        color_picker = $control.data('wpWpColorPicker');
                    $alpha_output.val($alpha.val() + '%');
                    iris._color._alpha = alpha_val / 100.0;
                    $control.val(iris._color.toString());
                    color_picker.toggler.css({
                        backgroundColor: $control.val()
                    });
                }).val(alpha_val).trigger('change');

            /*  $control.addClass('pickerStarted');
            }*/
        });









    redux.field_objects.color.init = function( selector ) {
        
        if ( !selector ) {
            selector = $( document ).find( ".redux-group-tab:visible" ).find( '.redux-container-color:visible' );
        }

        $( selector ).each(
            function() {

                var el = $( this );
                var parent = el;
                
                if ( !el.hasClass( 'redux-field-container' ) ) {
                    parent = el.parents( '.redux-field-container:first' );
                }
                if ( parent.is( ":hidden" ) ) { // Skip hidden fields
                    return;
                }
                if ( parent.hasClass( 'redux-field-init' ) ) {
                    parent.removeClass( 'redux-field-init' );
                } else {
                    return;
                }

                var $control = el.find( '.redux-color-init' );

                var value = $control.val().replace(/\s+/g, ''),
                    alpha_val = 100,
                    $alpha, $alpha_output;
                if (value.match(/rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/)) {
                    alpha_val = parseFloat(value.match(/rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/)[1]) * 100;
                }
                
                $control.wpColorPicker({
                    change: function( u ) {
                        redux_change( $( this ) );
                        el.find( '#' + u.target.getAttribute( 'data-id' ) + '-transparency' ).removeAttr( 'checked' );
                    },
                    clear: function() {
                        redux_change( $( this ).parent().find( '.redux-color-init' ) );
                        $alpha.val(100);
                        $alpha_output.val(100 + '%');
                    }
                });
                

                $('<div class="vc_alpha-container">' + '<label>Alpha: <output class="rangevalue">' + alpha_val + '%</output></label>' + '<input type="range" min="1" max="100" value="' + alpha_val + '" name="alpha" class="vc_alpha-field">' + '</div>').appendTo($control.parents('.wp-picker-container:first').addClass('vc_color-picker').find('.iris-picker'));
                $alpha = $control.parents('.wp-picker-container:first').find('.vc_alpha-field');
                $alpha_output = $control.parents('.wp-picker-container:first').find('.vc_alpha-container output')
                $alpha.bind('change keyup', function() {
                    var alpha_val = parseFloat($alpha.val()),
                        iris = $control.data('a8cIris'),
                        color_picker = $control.data('wpWpColorPicker');
                    $alpha_output.val($alpha.val() + '%');
                    iris._color._alpha = alpha_val / 100.0;
                    $control.val(iris._color.toString());
                    color_picker.toggler.css({
                        backgroundColor: $control.val()
                    });
                }).val(alpha_val).trigger('change');



                el.find( '.redux-color' ).on(
                    'focus', function() {
                        $( this ).data( 'oldcolor', $( this ).val() );
                    }
                );

                el.find( '.redux-color' ).on(
                    'keyup', function() {
                        var value = $( this ).val();
                        var color = colorValidate( this );
                        var id = '#' + $( this ).attr( 'id' );

                        if ( value === "transparent" ) {
                            $( this ).parent().parent().find( '.wp-color-result' ).css(
                                'background-color', 'transparent'
                            );
                    
                            el.find( id + '-transparency' ).attr( 'checked', 'checked' );
                        } else {
                            el.find( id + '-transparency' ).removeAttr( 'checked' );

                            if ( color && color !== $( this ).val() ) {
                                $( this ).val( color );
                            }
                        }
                    }
                );

                // Replace and validate field on blur
                el.find( '.redux-color' ).on(
                    'blur', function() {
                        var value = $( this ).val();
                        var id = '#' + $( this ).attr( 'id' );

                        if ( value === "transparent" ) {
                            $( this ).parent().parent().find( '.wp-color-result' ).css(
                                'background-color', 'transparent'
                            );
                    
                            el.find( id + '-transparency' ).attr( 'checked', 'checked' );
                        } else {
                            if ( colorValidate( this ) === value ) {
                                if ( value.indexOf( "#" ) !== 0 ) {
                                    $( this ).val( $( this ).data( 'oldcolor' ) );
                                }
                            }

                            el.find( id + '-transparency' ).removeAttr( 'checked' );
                        }
                    }
                );

                // Store the old valid color on keydown
                el.find( '.redux-color' ).on(
                    'keydown', function() {
                        $( this ).data( 'oldkeypress', $( this ).val() );
                    }
                );

                // When transparency checkbox is clicked
                el.find( '.color-transparency' ).on(
                    'click', function() {
                        if ( $( this ).is( ":checked" ) ) {
                            
                            el.find( '.redux-saved-color' ).val( $( '#' + $( this ).data( 'id' ) ).val() );
                            el.find( '#' + $( this ).data( 'id' ) ).val( 'transparent' );
                            el.find( '#' + $( this ).data( 'id' ) ).parent().parent().find( '.wp-color-result' ).css(
                                'background-color', 'transparent'
                            );
                        } else {
                            if ( el.find( '#' + $( this ).data( 'id' ) ).val() === 'transparent' ) {
                                var prevColor = $( '.redux-saved-color' ).val();

                                if ( prevColor === '' ) {
                                    prevColor = $( '#' + $( this ).data( 'id' ) ).data( 'default-color' );
                                }

                                el.find( '#' + $( this ).data( 'id' ) ).parent().parent().find( '.wp-color-result' ).css(
                                    'background-color', prevColor
                                );
                        
                                el.find( '#' + $( this ).data( 'id' ) ).val( prevColor );
                            }
                        }
                    }
                );
            }
        );
    };
})( jQuery );