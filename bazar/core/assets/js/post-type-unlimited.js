var loading_button = function() {
    jQuery('#publishing-action input[type="submit"]').each(function(){
        var t = jQuery(this);
        if ( t.hasClass('button-primary') )
            t.addClass('button-primary-disabled');
        else
            t.addClass('button-disabled');

        if ( jQuery(this).attr('id') == 'publish' )
            jQuery('#ajax-loading').css('visibility', 'visible');
        else
            jQuery('#draft-ajax-loading').css('visibility', 'visible');
    });
}

jQuery(document).ready( function($) {

    var active_tab = wpCookies.get( 'active_metabox_tab' );
    if ( active_tab == null ) {
        active_tab = $('ul.settings-tabs li:first-child a').attr('href');
    } else {
        active_tab = '#' + active_tab;
    }

    // category tabs
//             	$('.settings-tab .tabs-panel').hide();
//             	$( active_tab ).show();
    $('.settings-tabs a').click(function(){
        var t = $(this).attr('href');
        $(this).parent().addClass('tabs').siblings('li').removeClass('tabs');
        $('.tabs-panel').hide();
        $(t).show();

        return false;
    });

    $( '.settings-tab .slide-settings' ).hide();
    $( $('.settings-tab .slides-wrapper:not(.extra-images) a.selected').attr('href') ).show();
    $('.settings-tab .slides-wrapper:not(.extra-images) a').live( 'click', function(){
        $('.settings-tab .slides-wrapper:not(.extra-images) .edit').removeClass('edit');
        $('.settings-tab .slides-wrapper:not(.extra-images) .selected').removeClass('selected');
        $(this).addClass('selected');
        $('img', this).addClass('edit');

        $('.settings-tab .slide-settings').hide();
        $( $(this).attr('href') ).show();

        return false;
    });

    // LOAD IMAGES
    var update_images = function() {

        loading_button();

        var data = {
            action: 'update_images_post_type',
            post_id: post_id,
            post_type: typenow
        };

        $('#add-items-ajax-loading').css('visibility', 'visible');

        $.post(ajaxurl, data, function(response) {

            // get a sample of new image data to add in the form
            var $slide_setting = $('#item-0').clone();
            var from_id = 0;

            $.each( response, function( index, item_id ) {
                if ( $('#item-'+item_id).length == 0 ) {
                    var $copy_settings = $slide_setting.clone();
                    var next_order = parseInt( $('.slide-settings:last input[name$="[order]"]').val() ) + 1;
                    $copy_settings.attr('id', 'item-'+item_id );
                    $('input[name$="[order]"]', $copy_settings).val( next_order );
                    $('input, select, textarea, div, label', $copy_settings).each(function(){
                        var this_name = $(this).attr('name');
                        var this_id = $(this).attr('id');
                        var this_for = $(this).attr('for');
                        if ( this_name != undefined ) $(this).attr( 'name', this_name.replace( from_id, item_id ) );
                        if ( this_id != undefined ) $(this).attr('id', this_id.replace( from_id, item_id ) );
                        if ( this_for != undefined ) $(this).attr( 'for', this_for.replace( from_id, item_id ) );
                    });
                    $copy_settings.appendTo('#images-post-type').hide();
                }
            } );

            wpCookies.set( 'active_metabox_tab', 'item-edit' );
            window.onbeforeunload = null;
//     	    var actual_href = window.location.href;
//     	    window.location.href = actual_href.replace( /#(.*)?/, '' );    
            $('#post').submit();

// 			    $('#images-post-type').html(response);
// 			    
// 			    $( '.settings-tab .slide-settings' ).hide();
// 	            $( $('.settings-tab .slides-wrapper:not(.extra-images) a.selected').attr('href') ).show();
// 	            
// 	            $('#add-items-ajax-loading').css('visibility', 'hidden');
// 	            
// 	            tinyMCE.mceRepaint();
        }, 'json' );
    };

    $('.add-items').live( 'click', function(){
        tb_show('', 'media-upload.php?post_id='+post_id+'&TB_iframe=1&width=700');

        window.send_to_editor = function(html) {

            update_images();

            tb_remove();

        }

        $('body').bind( 'tb_unload', update_images );

        return false;
    });

    // SORTABLE
    $('.slides-wrapper:not(.extra-images).ui-sortable').sortable({
        axis: 'x',
        stop: function(e, ui) {
            $('.slides-wrapper:not(.extra-images).ui-sortable li').each(function(index){
                var id = $('a', this).attr('href');
                $( id + ' .order' ).attr('value', index);
            });
        }
    });

    $('.slide-settings .delete-item').live('click', function(){
        if ( ! confirm( cpt.delete_item ) )
            return false;

        var item_id = $(this).attr('rel');

        var data = {
            action: 'delete_item_post_type',
            item_id: item_id,
            post_id: post_id
        };

        $('#delete-item-ajax-loading-'+item_id).css('visibility', 'visible');

        $.post(ajaxurl, data, function(response) {
            $('.slides-wrapper:not(.extra-images) a[href="#item-'+item_id+'"]').parent().remove();
            $('#item-'+item_id).remove();

            var select = $('.slides-wrapper:not(.extra-images) li:first-child a').addClass('selected').attr('href');
            $(select).show();

            $('#delete-item-ajax-loading-'+item_id).css('visibility', 'hidden');
        });

        return false;
    });

    // UPDATE IMAGE
    if ( typeof items_id != 'undefined' ) {
        $.each( items_id, function( index, item_id ) {
            $('#'+cpt_metabox_name+'_image_'+item_id).next().removeClass('upload_button').click(function(){
                var upField = $(this).prev();
                tb_show('', 'media-upload.php?post_id=0&type=image&TB_iframe=true&width=700');

                window.send_to_editor = function(html) {
                    var imgurl = $('a', '<div>' + html + '</div>').attr('href');
                    if( typeof imgurl == 'undefined' ) imgurl =  $($(html)).attr('src');
                    var $classes = $('img', html).attr('class');
                    if( typeof $classes == 'undefined' ) $classes =  $($(html)).attr('class');
                    var new_image_id = $classes.replace(/(.*?)wp-image-/, '');

                    var data = {
                        action: 'update_image_post_type',
                        from_item_id: item_id,
                        post_id: post_id,
                        to_item_id: new_image_id
                    };

                    upField.val(imgurl);

                    $this_item = upField.parents('.slide-settings');
                    var this_item_id = $this_item.attr('id');

                    var thumburl = imgurl.split('.').reverse();
                    var baseurl = imgurl.replace( '.' + thumburl[0], '' );
                    thumburl = baseurl + '-140x100.' + thumburl[0];

                    $('a[href="#' + $this_item.attr('id') + '"] img').attr( 'src', thumburl );
                    $('select, input, textarea', $this_item).each(function(){
                        var this_name = $(this).attr('name');
                        var this_id = $(this).attr('id');
                        if ( this_name != undefined ) $(this).attr('name', this_name.replace( item_id, new_image_id ) );
                        if ( this_id != undefined )   $(this).attr('id', this_id.replace( item_id, new_image_id ) );
                    });
                    $('label', $this_item).each(function(){
                        var this_for = $(this).attr('for');
                        if ( this_for != undefined ) $(this).attr('for', this_for.replace( item_id, new_image_id ) );
                    });
                    if ( this_item_id != undefined ) $this_item.attr('id', this_item_id.replace( item_id, new_image_id ) );
                    $('a[href="#item-'+item_id+'"]').attr('href', '#'+$this_item.attr('id'));

                    $.post(ajaxurl, data, function(response) {
                        d = new Date();
                        $('a[href="#' + $this_item.attr('id') + '"] img').attr( 'src', thumburl+"?"+d.getTime() );
                        //window.location.href = window.location.href;
                    });

                    tb_remove();
                }

                return false;
            });
        } );
    }

    if ( adminpage == 'post-php' ){
        $('.tabs-panel:first select:first').change(function(){

            $(this).parents('.tabs-panel')
                .find('.sep:first ~ div:not(#config-notice)')
                .hide();

            if( $('#config-notice').length == 0 ) {
                $(this).parents('.tabs-panel')
                    .append('<div id="config-notice" class="the-metabox simple-text clearfix"><p>'+cpt.update_item+'</p></div>')
                    .show();
            }

        });
    }

    $('#post').submit(function(){
        var active_tab = $('.settings-tabs li.tabs a').attr('href');
        wpCookies.set( 'active_metabox_tab', active_tab.replace( '#', '' ) );
    });

    // REMOVE CATEGORY
    $('.remove_cat').live('click', function(){
        var cat_row  = $(this).parents('li');
        var cat_slug = $('input', cat_row).val();

        var data = {
            action: 'delete_category_post_type',
            post_id: post_id,
            cat_slug: cat_slug
        };

        $.post(ajaxurl, data, function(response) {
            $('input[value="'+cat_slug+'"]').each(function(){
                $(this).parents('li').remove();
            });
        });

        return false;
    });

    wpCookies.remove( 'active_metabox_tab' );

});