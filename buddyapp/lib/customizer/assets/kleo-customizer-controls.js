( function($) {

    'use strict';

    $(document).ready(function() {

        // Dependent fields
        $('.condition-me').conditionize();

        // Switch Click
        // =========================================================================

        //
        $('.Switch').on('click', function() {
            if ($(this).hasClass('On')){
                $(this).parent().find('input:checkbox').attr('checked', true);
                $(this).removeClass('On').addClass('Off');
            } else {
                $(this).parent().find('input:checkbox').attr('checked', false);
                $(this).removeClass('Off').addClass('On');
            }
        });


        // Updating Message
        // =========================================================================

        //
        // Updating message setup.
        //

        var elPreview = $( '#customize-preview' );

        elPreview.prepend( '<div class="kleo-updating">Updating</div>' );

        var elUpdating         = $( '#customize-preview .kleo-updating' );
        var elControlsText     = $( '.customize-control input[type="text"], .customize-control textarea' );
        var elControlsNonText  = $( '.customize-control input[type="checkbox"], .customize-control input[type="radio"], .customize-control select' );
        var elControlsColors   = $( '.customize-control-color .wp-color-picker' );
        var elControlsUploader = $( '.customize-control-image .remove' );

        function showUpdatingMessage( elUpdated ) {
            if ( elUpdated.closest( '.control-section' ).attr( 'id' ).indexOf( 'kleo_section' ) !== -1 ) {
                var key = elUpdated.closest( '.customize-control' ).attr( 'id' ).split( '-' ).pop();
                if ( _wpCustomizeSettings.settings[key].transport === 'refresh' ) {
                    elUpdating.fadeIn( 'fast' );
                }
            }
        }


        //
        // Show updating message.
        //
        // 1. Text inputs and textarea.
        // 2. Checkboxes and radios.
        // 3. Color pickers.
        // 4. Uploader.
        //

        elControlsText.on( 'input cut paste', function() { // 1
            showUpdatingMessage( $(this) );
        });

        elControlsNonText.on( 'change', function() { // 2
            showUpdatingMessage( $(this) );
        });

        elControlsColors.on( 'irischange', function() { // 3
            showUpdatingMessage( $(this) );
        });

        $.each( wp.customize.control._value, function( index, item ) { // 4
            if ( item.uploader ) {
                item.uploader.uploader.bind( 'UploadComplete', function( files ) {
                    showUpdatingMessage( $( '#customize-control-' + index ) );
                });
            }
        });

        elControlsUploader.on( 'click', function() { // 4
            showUpdatingMessage( $(this) );
        });


        //
        // Hide updating message.
        //

        elPreview.on( 'DOMNodeRemoved', function( e ) {
            elUpdating.fadeOut( 'fast' );
        });

    });

    $.fn.conditionize = function(options){

        var settings = $.extend({
            hideJS: false
        }, options );

        $.fn.showOrHide = function(listenTo, listenFor, $section) {
            if ($(listenTo).is('select, input[type=text]') && $(listenTo).val() == listenFor ) {
                $section.show();
            }
            else if ($(listenTo + ":checked").length == listenFor) {
                $section.show();
            }
            else {
                $section.hide();
            }
        }

        return this.each( function() {
            if ( $(this).attr('data-cond-option')) {
                var listenTo = "[data-customize-setting-link=" + $(this).data('cond-option') + "]";
                var listenFor = $(this).data('cond-value');
                var $section = $(this).parent('.customize-control');

                //Set up event listener
                $(listenTo).on('change', function () {
                    $.fn.showOrHide(listenTo, listenFor, $section);
                });
                //If setting was chosen, hide everything first...
                if (settings.hideJS) {
                    $(this).hide();
                }
                //Show based on current value on page load
                $.fn.showOrHide(listenTo, listenFor, $section);
            }
        });
    };


}(jQuery));