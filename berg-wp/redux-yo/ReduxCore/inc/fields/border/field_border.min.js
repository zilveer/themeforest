/*
 Field Border (border)
 */

/*global redux_change, wp, redux*/

(function( $ ) {
    "use strict";

    redux.field_objects = redux.field_objects || {};
    redux.field_objects.border = redux.field_objects.border || {};

    $( document ).ready(
        function() {
            
        }
    );

    redux.field_objects.border.init = function( selector ) {
        if ( !selector ) {
            selector = $( document ).find( ".redux-group-tab:visible" ).find( '.redux-container-border:visible' );
        }

        $( selector ).each(function() {
                var el = $( this );
                var parent = el;

                var alphaElement = $(this).find('.redux-color-init');
                
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
                el.find( ".redux-border-top, .redux-border-right, .redux-border-bottom, .redux-border-left, .redux-border-all" ).numeric({
                    allowMinus: false
                });

                var default_params = {
                    triggerChange: true,
                    allowClear: true
                };

                var select2_handle = el.find( '.redux-container-border' ).find( '.select2_params' );

                if ( select2_handle.size() > 0 ) {
                    var select2_params = select2_handle.val();

                    select2_params = JSON.parse( select2_params );
                    default_params = $.extend( {}, default_params, select2_params );
                }

                el.find( ".redux-border-style" ).select2( default_params );

                el.find( '.redux-border-input' ).on(
                    'change', function() {
                        var units = $( this ).parents( '.redux-field:first' ).find( '.field-units' ).val();
                        if ( $( this ).parents( '.redux-field:first' ).find( '.redux-border-units' ).length !== 0 ) {
                            units = $( this ).parents( '.redux-field:first' ).find( '.redux-border-units option:selected' ).val();
                        }
                        var value = $( this ).val();
                        if ( typeof units !== 'undefined' && value ) {
                            value += units;
                        }
                        if ( $( this ).hasClass( 'redux-border-all' ) ) {
                            $( this ).parents( '.redux-field:first' ).find( '.redux-border-value' ).each(
                                function() {
                                    $( this ).val( value );
                                }
                            );
                        } else {
                            $( '#' + $( this ).attr( 'rel' ) ).val( value );
                        }
                    }
                );
        
                el.find( '.redux-border-units' ).on(
                    'change', function() {
                        $( this ).parents( '.redux-field:first' ).find( '.redux-border-input' ).change();
                    }
                );

                el.find( '.redux-color-init' ).wpColorPicker({
                    change: function( u ) {
                        redux_change( $( this ) );
                        el.find( '#' + u.target.getAttribute( 'data-id' ) + '-transparency' ).removeAttr( 'checked' );
                    },
                    
                    clear: function() {
                        redux_change( $( this ).parent().find( '.redux-color-init' ) );
                    }
                });

                el.find( '.redux-color' ).on(
                    'keyup', function() {
                        var color = colorValidate( this );

                        if ( color && color !== $( this ).val() ) {
                            $( this ).val( color );
                        }
                    }
                );

                // Replace and validate field on blur
                el.find( '.redux-color' ).on(
                    'blur', function() {
                        var value = $( this ).val();

                        if ( colorValidate( this ) === value ) {
                            if ( value.indexOf( "#" ) !== 0 ) {
                                $( this ).val( $( this ).data( 'oldcolor' ) );
                            }
                        }
                    }
                );

                // Store the old valid color on keydown
                el.find( '.redux-color' ).on(
                    'keydown', function() {
                        $( this ).data( 'oldkeypress', $( this ).val() );
                    }
                );

                ////// alpha slider
                var control = alphaElement,
                    value = control.val().replace(/\s+/g, ''),
                    alpha_val = 100,
                    alpha, alpha_output, transparency_checkbox;

                if (value.match(/rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/)) {
                    alpha_val = parseFloat(value.match(/rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/)[1])*100;
                }

                control.wpColorPicker({
                    clear: function(event, ui) {
                        alpha.val(100);
                        alpha_output.val(100 + '%');
                    }
                });

                var htmlToAppend = '<div class="vc_alpha-container"><label>Alpha: <output class="rangevalue">' + alpha_val + '%</output></label><input type="range" min="0" max="100" value="' + alpha_val + '" name="alpha" class="vc_alpha-field"></div>';
                control.parents('.wp-picker-container:first').addClass('vc_color-picker').find('.iris-picker').append(htmlToAppend);

                if (value === 'transparent') {
                    value = 'rgba(0,0,0,0)';
                }

                alpha = control.parents('.wp-picker-container:first').find('.vc_alpha-field');
                alpha_output = control.parents('.wp-picker-container:first').find('.vc_alpha-container output');
                transparency_checkbox = control.parents('.redux-field-container:first').find('.color-transparency');

                alpha.bind('change keyup', function() {
                    transparency_checkbox.removeAttr('checked');

                    var alpha_val = parseFloat(alpha.val()),
                        iris = control.data('a8cIris'),
                        color_picker = control.data('wpWpColorPicker');

                    alpha_output.val(alpha.val() + '%');
                    iris._color._alpha = (alpha_val/100.0);
                    control.val(iris._color.toString());
                    color_picker.toggler.css({ backgroundColor: control.val() });
                }).val(alpha_val);
                ////// alpha slider
            }
        );
    };
})( jQuery );
