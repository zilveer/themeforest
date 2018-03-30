/* =========================================================
 * composer-custom-views fix
 * ====================================================== */


(function ($) {

    window.VcRowView.prototype.buildDesignHelpers = function () {
        var model = this.model,
            $elem = this.$el,
            $columnToggle = $elem.find( '> .controls .column_toggle' ),
            imageID = model.getParam('vsc_bg_image'),
            color = model.getParam('vsc_bg_color'),
            video = model.getParam('vsc_youtube_url'),
            rowId = model.getParam( 'el_id' );

        $elem.find( '> .controls .vc_row_color' ).remove();
        $elem.find( '> .controls .vc_row_image' ).remove();
        $elem.find( '> .controls .vc_row_video' ).remove();
        $elem.find( '> .controls .vc_row-hash-id' ).remove();
        $elem.find( '> .controls .vc_row_section_break' ).remove();

        if ( !$elem.is('.wpb_vc_row_inner') ) {
            $('<span class="vc_control vc_row_section_break" title="Page break">PAGE SECTION</span>').insertBefore( $columnToggle );
        }

        if ( imageID ) {
            $.ajax({ type: 'POST', url: window.ajaxurl, dataType: 'html', data: {
                action: 'wpb_single_image_src',
                content: imageID,
                size: 'thumbnail',
                _vcnonce: window.vcAdminNonce
            }} ).done( function ( url ) {
                if ( url ) {
                    $( '<span class="vc_row_image" style="background-image: url(' + url + ');" title="' + window.i18nLocale.row_background_image + '"></span>' ).insertAfter( $columnToggle );
                }
            } );
        }

        if ( ! _.isEmpty( rowId ) ) {
            $( '<span class="vc_row-hash-id"></span>' ).text( '#' + rowId ).insertAfter( $columnToggle );
        }

        if ( video ) {
            $( '<span class="vc_row_video" title="Row background video"></span>' ).insertAfter( $columnToggle );
        }

        if ( color ) {
            $( '<span class="vc_row_color" style="background-color: ' + color + '" title="' + window.i18nLocale.row_background_color + '"></span>' ).insertAfter( $columnToggle );
        }
    }

})(window.jQuery);
