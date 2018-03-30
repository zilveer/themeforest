/* Oxygenna Shortcode Generator Javascript ver 0.1 */
(function( $ ){
    $.fn.scGenerator = function( options ) {
        // Create some defaults, extending them with any options that were provided
        var settings = $.extend( {
            'shortcode-select' : '#shortcode'
            }, options
        );

        var codes = {
            // layout : createColumns,
            // tabs : createTabs,
            // accordion_section : createAccordion,
            // heading : createHeading,
            // services : createServices
        };

        var lineBreak;

        $.fn.extend({
            getCode : function() {
                var sc = null;
                var $code = $(settings['shortcode-select']);
                var code = $code.val();
                if( '' != code ) {
                    // check for special code
                    if( 'function' === typeof codes[code] ) {
                        sc = codes[code].apply( this , [code] );
                    }
                    else { // simple standard code
                        sc = createCode( code );
                    }
                }
                return sc;
            }
        });

        function createCode( name ) {
            // start shortcode
            var sc = '[' + name;
            // fetch attribute inputs except content one
            var inputs = $(':input[name^="' + name + '_"]').not( ':input[name="' + name + '_content"]' );

            // create attributes
            inputs.each( function() {
                sc += createAttribute( $(this), name );
            });

            // check for content
            sc += createContent( name );
            return sc;
        }

        function createAttribute( $input, name ) {
            var value = getInputValue( $input );
            // if value is the default value then we skip it to
            // keep shortcodes short
            if( $input.attr( 'data-default' ) == value ) {
                value = null;
            }

            if( null !== value ) {
                var name = $input.attr('name').replace( name + '_', '' ).replace( '[]', '');
                return ' ' + name + '="' + value + '"';
            }
            else {
                return '';
            }
        }

        function getInputValue( $input ) {
            var value = null;
            if( $input.is( 'select' ) ) {
                if( $input.attr( 'multiple' ) == 'multiple' ) {
                    value = $input.val() || [];
                    value = value.join(',');
                }
                else {
                    value = $input.val();
                }
            }
            else if( $input.is( 'input[type="radio"]' ) ) {
                if( $input.is( ':checked' ) ) {
                    value = $input.val();
                }
            }
            else {
                value = $input.val();
            }
            return value;
        }

        function createContent( name ) {
            var content = $( '[name="' + name + '_content"]' );
            var returnVal = ']';
            if( content.length > 0 ) {
                content = getInputValue( content );
                // if name has postfix _content then use as content
                if( content !== null ) {
                    // create content
                    returnVal = ']' + content.replace(/\n/g,lineBreak) + '[/' + name + ']';
                }
            }
            return returnVal;
        }

        function createColumns( name ) {
            var number = $( '#' + name + '_columns' ).val();
            var sc = '';
            for( var i = 1 ; i <= number ; i++ ) {
                // create code then remove postfix (half_col1 goes to half)
                var input = $( '#' + name + '_' + i );
                sc += '[' + input.attr('data-shortcode') + ']' + input.val() + '[/' + input.attr('data-shortcode') + ']';
            }
            return sc;
        }

        function createTabs( name ) {
            var number = $( '#tabs_details' ).val();
            var sc = '[tabs]' + lineBreak;
            for( var i = 1 ; i <= number ; i++ ) {
                var title = $( ':input[name="tabs_details_title' + i + '"]:enabled' );
                var content = $( ':input[name="tabs_details_content' + i + '"]:enabled' );
                sc += '[tab title="' + title.val() + '"]' + lineBreak;
                sc += content.val();
                sc += lineBreak + '[/tab]' + lineBreak;
            }
            sc += '[/tabs]';
            return sc;
        }

        function createAccordion( name ) {
            var number = $( '#accordion_details' ).val();
            var sc = '[accordions]' + lineBreak;
            for( var i = 1 ; i <= number ; i++ ) {
                var title = $( ':input[name="accordion_details_title' + i + '"]:enabled' );
                var content = $( ':input[name="accordion_details_content' + i + '"]:enabled' );
                sc += '[accordion title="' + title.val() + '"]' + lineBreak;
                sc += content.val();
                sc += lineBreak + '[/accordion]' + lineBreak;
            }
            sc += '[/accordions]';
            return sc;
        }

        function createHeading( name ) {
            // get size of heading
            var size = jQuery('input[name="heading_size"]:checked').val();
            // get extra attributes
            var line = createAttribute( jQuery('input[name="heading_line"]:checked') , 'heading' );
            var align = createAttribute( jQuery('input[name="heading_align"]:checked') , 'heading' );
            var background = createAttribute( jQuery('input[name="heading_icon_background"]:checked') , 'heading' );
            var icon = createAttribute( jQuery('input[name="heading_icon_content"]') , 'heading' );
            var font = createAttribute( jQuery('select[name="heading_icon_font"]') , 'heading' );
            var colour = createAttribute( jQuery('input[name="heading_icon_colour"]') , 'heading' );

            var sc = '[h' + size + line + align + icon + background + font + colour + ']' + $( '#heading_content' ).val() + '[/h' + size + ']';
            return sc;
        }

        function createServices( name ) {
            var number = $( '#services_count' ).val();
            var sc = '[services]' + lineBreak;
            for( var i = 1 ; i <= number ; i++ ) {
                var title = $( 'input[name="services_details_title' + i + '"]:enabled' );
                var icon = $( 'input[name="services_details_icon' + i + '"]:enabled' );
                var content = $( 'textarea[name="services_details_content' + i + '"]:enabled' );
                var font = $( 'select[name="services_details_icon' + i + '_font"]:enabled' );
                sc += '[service title="' + title.val() + '" icon="' + icon.val() + '" font="' + font.val() + '"]' + lineBreak;
                sc += content.val();
                sc += lineBreak + '[/service]' + lineBreak;
            }
            sc += '[/services]';
            return sc;
        }

        return this.each(function() {
            var $this = $(this);
            lineBreak = hasMCE ? '<br />' : '\n';
            //set title of tinymcepopup
            if( hasMCE ) {
                document.title = tinyMCEPopup.getWindowArg("title_param");
            }
            $this.bind( 'submit', function() {
                var code = $this.getCode();
                if( null !== code ) {
                    if( hasMCE ) {
                        tinyMCEPopup.execCommand( 'mceInsertContent', false, code );
                    }
                    else {
                        var win = window.dialogArguments || opener || parent || top;
                        win.send_to_editor( code );
                    }
                    closeWindow();
                }
                return false;
            });
        });
    };
})( jQuery );