jQuery(document).ready(function(jQuery) {

    /*
     * Logo Button
     */

    jQuery('#upload_logo_button').click(function() {
        tb_show('Upload a logo', 'media-upload.php?referer=ishyoboy_framework&type=image&TB_iframe=true&post_id=0', false);
        return false;
    });

    if ( jQuery('#upload_logo_button').length > 0 ){
        window.send_to_editor = function(html) {
            var image_url = jQuery('img',html).attr('src');
            jQuery('#logo_url').val(image_url);
            tb_remove();
            jQuery('#upload_logo_preview').html('<img src="' + image_url + '" style="max-width:100%;" />');
            jQuery('#submit').trigger('click');
        }

        jQuery('#logo_text').click( function(){
            if ( jQuery(this).is(':checked')){
                jQuery('#logo_section').parent().parent().stop(true, true).fadeOut('300');
            }
            else{
                jQuery('#logo_section').parent().parent().stop(true, true).fadeIn('300');
            }
        });

        if ( jQuery('#logo_text').is(':checked')){
            jQuery('#logo_section').parent().parent().hide();
        }
    }

    /*
     * Post types
     */

    // Post-types Show/Hide
    radios = jQuery('#post-formats-select input');

    if ( !(jQuery('input[value="ishyoboy_slides"]').length > 0) ){
        jQuery('[id^=ishyoboy_meta_post_]').hide();
        var val = jQuery('#post-formats-select input:checked').val();
        jQuery('#ishyoboy_meta_post_' + val ).show();
    }
    radios.change( function() {

        var val = jQuery(this).val();

        if ( jQuery('[id^=ishyoboy_meta_post_]:visible').length > 0 ){
            jQuery('[id^=ishyoboy_meta_post_]:visible').slideUp(300, function(){
                jQuery('#ishyoboy_meta_post_' + val ).slideDown(300);
            });
        }
        else{
            jQuery('#ishyoboy_meta_post_' + val ).slideDown(300);
        }
    });

    if ( jQuery('#ishyometa_ishyoboy_post_embedded_video').length > 0){

        if ( jQuery('#ishyometa_ishyoboy_post_embedded_video').is( ":checked" ) ){
            jQuery('tr').has('#ishyometa_ishyoboy_post_video').show();
            jQuery('tr').has('#ishyometa_ishyoboy_post_video_mp4, ' +
                '#ishyometa_ishyoboy_post_video_webm, ' +
                '#ishyometa_ishyoboy_post_video_poster').hide();
        }else{
            jQuery('tr').has('#ishyometa_ishyoboy_post_video').hide();
            jQuery('tr').has('#ishyometa_ishyoboy_post_video_mp4, ' +
                '#ishyometa_ishyoboy_post_video_webm, ' +
                '#ishyometa_ishyoboy_post_video_poster').show();
        }

        jQuery('#ishyometa_ishyoboy_post_embedded_video').change(function(){
            if ( jQuery(this).is( ":checked" ) ){
                jQuery('tr').has('#ishyometa_ishyoboy_post_video_mp4, ' +
                    '#ishyometa_ishyoboy_post_video_webm, ' +
                    '#ishyometa_ishyoboy_post_video_poster').fadeOut(300,function(){
                        jQuery('tr').has('#ishyometa_ishyoboy_post_video').fadeIn(300);
                    });


            }else{
                jQuery('tr').has('#ishyometa_ishyoboy_post_video').fadeOut(300, function(){
                    jQuery('tr').has('#ishyometa_ishyoboy_post_video_mp4, ' +
                        '#ishyometa_ishyoboy_post_video_webm, ' +
                        '#ishyometa_ishyoboy_post_video_poster').fadeIn(300);
                });
            }
        });
    }

    /*
     * Taglines
     */

    if ( jQuery('#ishyometa_ishyoboy_display_lead').length > 0){

        if ( jQuery('#ishyometa_ishyoboy_display_taglines').is( ":checked" ) ){
            jQuery('tr').has('#ishyometa_ishyoboy_top_tagline').show();
            jQuery('tr').has('#ishyometa_ishyoboy_bottom_tagline').show();
        }else{
            jQuery('tr').has('#ishyometa_ishyoboy_top_tagline').hide();
            jQuery('tr').has('#ishyometa_ishyoboy_bottom_tagline').hide();
        }

        jQuery('#ishyometa_ishyoboy_display_taglines').change(function(){
            if ( jQuery(this).is( ":checked" ) ){
                jQuery('tr').has('#ishyometa_ishyoboy_top_tagline').fadeIn(300);
                jQuery('tr').has('#ishyometa_ishyoboy_bottom_tagline').fadeIn(300);
            }else{
                jQuery('tr').has('#ishyometa_ishyoboy_top_tagline').fadeOut(300);
                jQuery('tr').has('#ishyometa_ishyoboy_bottom_tagline').fadeOut(300);
            }
        });
    }

    /*
     * Lead section
     */

    if ( jQuery('#ishyometa_ishyoboy_display_lead').length > 0){

        if ( jQuery('#ishyometa_ishyoboy_display_lead').is( ":checked" ) ){
            jQuery('tr').has('#ishyoboylead').show();
            jQuery('tr').has('#ishyometa_ishyoboy_lead_type_boxed').show();
        }else{
            jQuery('tr').has('#ishyoboylead').hide();
            jQuery('tr').has('#ishyometa_ishyoboy_lead_type_boxed').hide();
        }

        jQuery('#ishyometa_ishyoboy_display_lead').change(function(){
            if ( jQuery(this).is( ":checked" ) ){
                jQuery('tr').has('#ishyoboylead').fadeIn(300);
                jQuery('tr').has('#ishyometa_ishyoboy_lead_type_boxed').fadeIn(300);
            }else{
                jQuery('tr').has('#ishyoboylead').fadeOut(300);
                jQuery('tr').has('#ishyometa_ishyoboy_lead_type_boxed').fadeOut(300);
            }
        });
    }


    /*
     *   Color picker activation
     */

    jQuery('.color_box').each(function(){
        var _this = this;
        var default_value = jQuery(this).next('input').val();
        jQuery(this).ColorPicker({
            color: default_value,
            onShow: function (colpkr) {
                jQuery(colpkr).stop(true,true).fadeIn(500);
                return false;
            },
            onHide: function (colpkr) {
                jQuery(colpkr).stop(true,true).fadeOut(500);
                return false;
            },
            onChange: function (hsb, hex, rgb) {
                jQuery(_this).css('backgroundColor', '#' + hex);
                jQuery(_this).next('input').attr('value','#' + hex);
            }
        });
    });

    /*
     *   Font selector activation
     */
    jQuery('select.font-select').change(function(){
        jQuery('head').append( "<link class='link-body' href='//fonts.googleapis.com/css?family=" + jQuery(this).val() + "' rel='stylesheet' type='text/css'>" );
        var preview = jQuery(this).next('.font-preview');

        if ( !preview.is(":visible") ){
            preview.fadeIn(300);
        }

        jQuery(this).parent().find('h3 > span').html( jQuery(this).val() );
        preview.css('font-family', jQuery(this).val());
    });

    jQuery('select.font-select').each(function(){
        jQuery('head').append( "<link class='link-body' href='//fonts.googleapis.com/css?family=" + jQuery(this).val() + "' rel='stylesheet' type='text/css'>" );
        var preview = jQuery(this).next('.font-preview');

        if ( !preview.is(":visible") ){
            preview.fadeIn(300);
        }

        jQuery(this).parent().find('h3 > span').html( jQuery(this).val() );
        preview.css('font-family', jQuery(this).val());
    });


    /*
     *   Sidebar position
     */
    if ( jQuery('#ishyometa_ishyoboy_sidebar_position').length > 0){

        jQuery('#ishyometa_ishyoboy_sidebar_position').change(function(){
            $val = jQuery(this).val();
            if ('left' == $val || 'right' == $val){
                jQuery('#ishyometa_ishyoboy_sidebar_boxitem').fadeIn(300);
            }
            else{
                jQuery('#ishyometa_ishyoboy_sidebar_boxitem').fadeOut(300);
            }
        });

        jQuery('#ishyometa_ishyoboy_sidebar_position').each(function(){
            $val = jQuery(this).val();
            if ('left' == $val || 'right' == $val){
                jQuery('#ishyometa_ishyoboy_sidebar_boxitem').show();
            }
            else{
                jQuery('#ishyometa_ishyoboy_sidebar_boxitem').hide();
            }
        });
    }


    /*
     *   Expandable header
     */
    if ( jQuery('#ishyometa_ishyoboy_use_header_sidebar').length > 0){

        jQuery('#ishyometa_ishyoboy_use_header_sidebar').change(function(){
            $val = jQuery(this).val();
            if ('1' == $val){
                jQuery('#ishyometa_ishyoboy_header_sidebar_boxitem').fadeIn(300);
                jQuery('#ishyometa_ishyoboy_header_sidebar_on_boxitem').fadeIn(300);
            }
            else{
                jQuery('#ishyometa_ishyoboy_header_sidebar_boxitem').fadeOut(300);
                jQuery('#ishyometa_ishyoboy_header_sidebar_on_boxitem').fadeOut(300);
            }
        });

        jQuery('#ishyometa_ishyoboy_use_header_sidebar').each(function(){
            $val = jQuery(this).val();
            if ('1' == $val){
                jQuery('#ishyometa_ishyoboy_header_sidebar_boxitem').show();
                jQuery('#ishyometa_ishyoboy_header_sidebar_on_boxitem').show();
            }
            else{
                jQuery('#ishyometa_ishyoboy_header_sidebar_boxitem').hide();
                jQuery('#ishyometa_ishyoboy_header_sidebar_on_boxitem').hide();
            }
        });
    }

    /*
     *   Footer widget area box
     */
    if ( jQuery('#ishyometa_ishyoboy_use_footer_widget_area').length > 0){
        jQuery('#ishyometa_ishyoboy_use_footer_widget_area').change(function(){
            $val = jQuery(this).val();
            if ('1' == $val){
                jQuery('#ishyometa_ishyoboy_footer_sidebar_boxitem').fadeIn(300);
            }
            else{
                jQuery('#ishyometa_ishyoboy_footer_sidebar_boxitem').fadeOut(300);
            }
        });

        jQuery('#ishyometa_ishyoboy_use_footer_widget_area').each(function(){
            $val = jQuery(this).val();
            if ('1' == $val){
                jQuery('#ishyometa_ishyoboy_footer_sidebar_boxitem').show();
            }
            else{
                jQuery('#ishyometa_ishyoboy_footer_sidebar_boxitem').hide();
            }
        });
    }

    /*
     *  SORTABLE SOCIAL ICONS
     */


    if ( jQuery('input[value="ishyoboy_framework_social_options"]').length > 0 ){

        // Hide all hidden fields - in our case order field
        jQuery('tr').has('.ishyoboy_hidden').hide();

        // Detect all necessary elements
        var $children = jQuery('tr').has('.ishyoboy_sortable');
        var $options = $children.parent();
        var $form = jQuery('form').has( $options );

        $options.addClass('social');


        // Add fields ids to <tr> so toArray function of the "sortable" plugin could be used.
        $children.each(function(){
            jQuery(this).attr('id', jQuery(this).find('.ishyoboy_main_field').attr('id'));
            jQuery(this).children('th').prepend('<span class="icon-' + jQuery(this).attr('id').substr(7) + '"></span>');

            // jQuery(this).children('th').addClass( 'icon-' + jQuery(this).attr('id').substr(7) );
        });

        // Get order if already saved to db
        var $order = jQuery('#order_social_fields').attr('value');


        // If order exists in db -> reorder all fields
        if ( '' != $order ){

            $order = $order.split(',');

            // Clone and remove all elements
            $items = new Array();
            $children.each(function(){
                $items[jQuery(this).attr('id')] = jQuery(this).clone();
                jQuery(this).detach();
            });

            // Recreate the elements using the order from db
            for (var $i = 0; $i < $order.length; $i++){

                // create only if the field existed
                if ( undefined != $items[ $order[$i] ] ){

                    var e = $items[ $order[$i] ];
                    e.appendTo($options);
                    delete $items[ $order[$i] ];

                }

            }

            // Add remaining items which were created after a first order was saved to DB
            for (var $index in $items) {
                var i = $items[ $index ];
                i.appendTo($options);
            }

        }

        // Make the whole list sortable
        $options.sortable({ cursor: "move" });

        $form.submit( function(){

            // Save the order of all fieds to the order field
            $ids = $options.sortable('toArray');
            $options.children().removeAttr('id');
            jQuery('#order_social_fields').attr('value', $ids.toString());

        });
    }


    /*
     *   Widgets
     */

    jQuery('div[id*="ishyoboy"]').each(function(){
        jQuery(this).find('.widget-title').prepend('<span class="ishyoboy-icon"></span>');
    });

    /*
     * Color Themes
     */

    checkbox = jQuery('.ishyoboy_framework_settings #use_custom_colors');
    if (checkbox.length > 0){

        checkbox.change(function(){

            if ( jQuery(this).is( ":checked" ) ){
                jQuery('tr').has('.ishyoboy_theme_selector_theme').fadeOut(300,function(){
                    jQuery('tr').has('.color_box').fadeIn(300);
                });
            }
            else{

                jQuery('tr').has('.color_box').fadeOut(300,function(){
                    jQuery('tr').has('.ishyoboy_theme_selector_theme').fadeIn(300);
                });
            }

        });

        // Defaults
        if ( checkbox.is( ":checked" ) ){
            jQuery('tr').has('.ishyoboy_theme_selector_theme').hide();
            jQuery('tr').has('.color_box').show();
        }
        else{

            jQuery('tr').has('.color_box').hide();
            jQuery('tr').has('.ishyoboy_theme_selector_theme').show();
        }

    }


});