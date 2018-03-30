/**
 * SMOF js
 *
 * contains the core functionalities to be used
 * inside SMOF
 */

jQuery.noConflict();

/** Fire up jQuery - let's dance!
 */
jQuery(document).ready(function($){

    //(un)fold options in a checkbox-group
    jQuery('.fld').click(function() {
        var $fold='.f_'+this.id;
        $($fold).slideToggle('normal', "swing");
    });

    //delays until AjaxUpload is finished loading
    //fixes bug in Safari and Mac Chrome
    if (typeof AjaxUpload != 'function') {
        return ++counter < 6 && window.setTimeout(init, counter * 500);
    }

    //hides warning if js is enabled
    $('#js-warning').hide();

    //Tabify Options
    $('.group').hide();

    // Display last current tab
    if ($.cookie("of_current_opt") === null) {
        $('.group:first').fadeIn('fast');
        $('#of-nav li:first').addClass('current');
    } else {

        var hooks = $('#hooks').html();
        hooks = jQuery.parseJSON(hooks);

        $.each(hooks, function(key, value) {

            if ($.cookie("of_current_opt") == '#of-option-'+ value) {
                $('.group#of-option-' + value).fadeIn();
                $('#of-nav li.' + value).addClass('current');
            }

        });

    }

    //Current Menu Class
    $('#of-nav li a').click(function(evt){
        // event.preventDefault();

        $('#of-nav li').removeClass('current');
        $(this).parent().addClass('current');

        var clicked_group = $(this).attr('href');

        $.cookie('of_current_opt', clicked_group, { expires: 7, path: '/' });

        $('.group').hide();

        $(clicked_group).fadeIn('fast');
        return false;

    });

    //Expand Options
    var flip = 0;

    $('#expand_options').click(function(){
        if(flip == 0){
            flip = 1;
            $('#of_container #of-nav').hide();
            $('#of_container #content').width(760);
            $('#of_container .group').add('#of_container .group h2').show();

            $(this).removeClass('expand');
            $(this).addClass('close');
            $(this).text('Close');

        } else {
            flip = 0;
            $('#of_container #of-nav').show();
            $('#of_container #content').width(600);
            $('#of_container .group').add('#of_container .group h2').hide();
            $('#of_container .group:first').show();
            $('#of_container #of-nav li').removeClass('current');
            $('#of_container #of-nav li:first').addClass('current');

            $(this).removeClass('close');
            $(this).addClass('expand');
            $(this).text('Expand');

        }

    });

    //Update Message popup
    $.fn.center = function () {
        this.animate({"top":( $(window).height() - this.height() - 200 ) / 2+$(window).scrollTop() + "px"},100);
        this.css("left", 250 );
        return this;
    }


    $('#of-popup-save').center();
    $('#of-popup-reset').center();
    $('#of-popup-fail').center();

    $(window).scroll(function() {
        $('#of-popup-save').center();
        $('#of-popup-reset').center();
        $('#of-popup-fail').center();
    });


    //Masked Inputs (images as radio buttons)
    $('.of-radio-img-img').click(function(){
        $(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
        $(this).addClass('of-radio-img-selected');
    });
    $('.of-radio-img-label').hide();
    $('.of-radio-img-img').show();
    $('.of-radio-img-radio').hide();

    //Masked Inputs (background images as radio buttons)
    $('.of-radio-tile-img').click(function(){
        $(this).parent().parent().find('.of-radio-tile-img').removeClass('of-radio-tile-selected');
        $(this).addClass('of-radio-tile-selected');
    });
    $('.of-radio-tile-label').hide();
    $('.of-radio-tile-img').show();
    $('.of-radio-tile-radio').hide();

    //AJAX Upload
    function of_image_upload() {
        $('.image_upload_button').each(function(){

            var clickedObject = $(this);
            var clickedID = $(this).attr('id');

            var nonce = $('#security').val();

            new AjaxUpload(clickedID, {
                action: ajaxurl,
                name: clickedID, // File upload name
                data: { // Additional data to send
                    action: 'of_ajax_post_action',
                    type: 'upload',
                    security: nonce,
                    data: clickedID },
                autoSubmit: true, // Submit file after selection
                responseType: false,
                onChange: function(file, extension){},
                onSubmit: function(file, extension){
                    clickedObject.text('Uploading'); // change button text, when user selects file
                    this.disable(); // If you want to allow uploading only 1 file at time, you can disable upload button
                    interval = window.setInterval(function(){
                        var text = clickedObject.text();
                        if (text.length < 13){	clickedObject.text(text + '.'); }
                        else { clickedObject.text('Uploading'); }
                    }, 200);
                },
                onComplete: function(file, response) {
                    window.clearInterval(interval);
                    clickedObject.text('Upload Image');
                    this.enable(); // enable upload button


                    // If nonce fails
                    if(response==-1){
                        var fail_popup = $('#of-popup-fail');
                        fail_popup.fadeIn();
                        window.setTimeout(function(){
                            fail_popup.fadeOut();
                        }, 2000);
                    }

                    // If there was an error
                    else if(response.search('Upload Error') > -1){
                        var buildReturn = '<span class="upload-error">' + response + '</span>';
                        $(".upload-error").remove();
                        clickedObject.parent().after(buildReturn);

                    }
                    else{
                        var buildReturn = '<img class="hide of-option-image" id="image_'+clickedID+'" src="'+response+'" alt="" />';

                        $(".upload-error").remove();
                        $("#image_" + clickedID).remove();
                        clickedObject.parent().after(buildReturn);
                        $('img#image_'+clickedID).fadeIn();
                        clickedObject.next('span').fadeIn();
                        clickedObject.parent().prev('input').val(response);
                    }
                }
            });

        });

    }

    of_image_upload();

    //AJAX Remove Image (clear option value)
    $('.image_reset_button').live('click', function(){

        var clickedObject = $(this);
        var clickedID = $(this).attr('id');
        var theID = $(this).attr('title');

        var nonce = $('#security').val();

        var data = {
            action: 'of_ajax_post_action',
            type: 'image_reset',
            security: nonce,
            data: theID
        };

        $.post(ajaxurl, data, function(response) {

            //check nonce
            if(response==-1){ //failed

                var fail_popup = $('#of-popup-fail');
                fail_popup.fadeIn();
                window.setTimeout(function(){
                    fail_popup.fadeOut();
                }, 2000);
            }

            else {

                var image_to_remove = $('#image_' + theID);
                var button_to_hide = $('#reset_' + theID);
                image_to_remove.fadeOut(500,function(){ $(this).remove(); });
                button_to_hide.fadeOut();
                clickedObject.parent().prev('input').val('');
            }


        });

    });

    // Style Select
    (function ($) {
        styleSelect = {
            init: function () {
                $('.select_wrapper').each(function () {
                    $(this).prepend('<span>' + $(this).find('.select option:selected').text() + '</span>');
                });
                $('.select').live('change', function () {
                    $(this).prev('span').replaceWith('<span>' + $(this).find('option:selected').text() + '</span>');
                });
                $('.select').bind($.browser.msie ? 'click' : 'change', function(event) {
                    $(this).prev('span').replaceWith('<span>' + $(this).find('option:selected').text() + '</span>');
                });
            }
        };
        $(document).ready(function () {
            styleSelect.init()
        })
    })(jQuery);


    /** Aquagraphite Slider MOD */

        //Hide (Collapse) the toggle containers on load
    $(".slide_body").hide();

    //Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
    $(".slide_edit_button").live( 'click', function(){
        $(this).parent().toggleClass("active").next().slideToggle("fast");
        return false; //Prevent the browser jump to the link anchor
    });

    // Update slide title upon typing
    function update_slider_title(e) {
        var element = e;
        if ( this.timer ) {
            clearTimeout( element.timer );
        }
        this.timer = setTimeout( function() {
            $(element).parent().prev().find('strong').text( element.value );
        }, 100);
        return true;
    }

    $('.of-slider-title').live('keyup', function(){
        update_slider_title(this);
    });


    //Remove individual slide
    $('.slide_delete_button').live('click', function(){
        // event.preventDefault();
        var agree = confirm("Are you sure you wish to delete this slide?");
        if (agree) {
            var $trash = $(this).parents('li');
            //$trash.slideUp('slow', function(){ $trash.remove(); }); //chrome + confirm bug made slideUp not working...
            $trash.animate({
                opacity: 0.25,
                height: 0,
            }, 500, function() {
                $(this).remove();
            });
            return false; //Prevent the browser jump to the link anchor
        } else {
            return false;
        }
    });

    //Add new slide
    $(".slide_add_button").live('click', function(){
        var slidesContainer = $(this).prev();
        var sliderId = slidesContainer.attr('id');
        var sliderInt = $('#'+sliderId).attr('rel');

        var numArr = $('#'+sliderId +' li').find('.order').map(function() {
            var str = this.id;
            str = str.replace(/\D/g,'');
            str = parseFloat(str);
            return str;
        }).get();

        var maxNum = Math.max.apply(Math, numArr);
        if (maxNum < 1 ) { maxNum = 0};
        var newNum = maxNum + 1;

        var newSlide = '<li class="temphide"><div class="slide_header"><strong>Slide ' + newNum + '</strong><input type="hidden" class="slide of-input order" name="' + sliderId + '[' + newNum + '][order]" id="' + sliderId + '_slide_order-' + newNum + '" value="' + newNum + '"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><label>Title</label><input class="slide of-input of-slider-title" name="' + sliderId + '[' + newNum + '][title]" id="' + sliderId + '_' + newNum + '_slide_title" value=""><label>Image URL</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][url]" id="' + sliderId + '_' + newNum + '_slide_url" value=""><div class="upload_button_div"><span class="button media_upload_button" id="' + sliderId + '_' + newNum + '" rel="'+sliderInt+'">Upload</span><span class="button mlu_remove_button hide" id="reset_' + sliderId + '_' + newNum + '" title="' + sliderId + '_' + newNum + '">Remove</span></div><div class="screenshot"></div><label>Link URL (optional)</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][link]" id="' + sliderId + '_' + newNum + '_slide_link" value=""><label>Description (optional)</label><textarea class="slide of-input" name="' + sliderId + '[' + newNum + '][description]" id="' + sliderId + '_' + newNum + '_slide_description" cols="8" rows="8"></textarea><a class="slide_delete_button" href="#">Delete</a><div class="clear"></div></div></li>';

        slidesContainer.append(newSlide);
        $('.temphide').fadeIn('fast', function() {
            $(this).removeClass('temphide');
        });

        of_image_upload(); // re-initialise upload image..

        return false; //prevent jumps, as always..
    });

    //Sort slides
    jQuery('.slider').find('ul').each( function() {
        var id = jQuery(this).attr('id');
        $('#'+ id).sortable({
            placeholder: "placeholder",
            opacity: 0.6
        });
    });


    /**	Sorter (Layout Manager) */
    jQuery('.sorter').each( function() {
        var id = jQuery(this).attr('id');
        $('#'+ id).find('ul').sortable({
            items: 'li',
            placeholder: "placeholder",
            connectWith: '.sortlist_' + id,
            opacity: 0.6,
            update: function() {
                $(this).find('.position').each( function() {

                    var listID = $(this).parent().attr('id');
                    var parentID = $(this).parent().parent().attr('id');
                    parentID = parentID.replace(id + '_', '')
                    var optionID = $(this).parent().parent().parent().attr('id');
                    $(this).prop("name", optionID + '[' + parentID + '][' + listID + ']');

                });
            }
        });
    });


    /**	Ajax Backup & Restore MOD */
        //backup button
    $('#of_backup_button').live('click', function(){

        var answer = confirm("Click OK to backup your current saved options.")

        if (answer){

            var clickedObject = $(this);
            var clickedID = $(this).attr('id');

            var nonce = $('#security').val();

            var data = {
                action: 'of_ajax_post_action',
                type: 'backup_options',
                security: nonce
            };

            $.post(ajaxurl, data, function(response) {

                //check nonce
                if(response==-1){ //failed

                    var fail_popup = $('#of-popup-fail');
                    fail_popup.fadeIn();
                    window.setTimeout(function(){
                        fail_popup.fadeOut();
                    }, 2000);
                }

                else {

                    var success_popup = $('#of-popup-save');
                    success_popup.fadeIn();
                    window.setTimeout(function(){
                        location.reload();
                    }, 1000);
                }

            });

        }

        return false;

    });

    //restore button
    $('#of_restore_button').live('click', function(){

        var answer = confirm("'Warning: All of your current options will be replaced with the data from your last backup! Proceed?")

        if (answer){

            var clickedObject = $(this);
            var clickedID = $(this).attr('id');

            var nonce = $('#security').val();

            var data = {
                action: 'of_ajax_post_action',
                type: 'restore_options',
                security: nonce
            };

            $.post(ajaxurl, data, function(response) {

                //check nonce
                if(response==-1){ //failed

                    var fail_popup = $('#of-popup-fail');
                    fail_popup.fadeIn();
                    window.setTimeout(function(){
                        fail_popup.fadeOut();
                    }, 2000);
                }

                else {

                    var success_popup = $('#of-popup-save');
                    success_popup.fadeIn();
                    window.setTimeout(function(){
                        location.reload();
                    }, 1000);
                }

            });

        }

        return false;

    });

    /**	Ajax Transfer (Import/Export) Option */
    $('#of_import_button').live('click', function(){

        var answer = confirm("Click OK to import options.")

        if (answer){

            var clickedObject = $(this);
            var clickedID = $(this).attr('id');

            var nonce = $('#security').val();

            var import_data = $('#export_data').val();

            var data = {
                action: 'of_ajax_post_action',
                type: 'import_options',
                security: nonce,
                data: import_data
            };

            $.post(ajaxurl, data, function(response) {
                var fail_popup = $('#of-popup-fail');
                var success_popup = $('#of-popup-save');

                //check nonce
                if(response==-1){ //failed
                    fail_popup.fadeIn();
                    window.setTimeout(function(){
                        fail_popup.fadeOut();
                    }, 2000);
                }
                else
                {
                    success_popup.fadeIn();
                    window.setTimeout(function(){
                        location.reload();
                    }, 1000);
                }

            });

        }

        return false;

    });

    /** AJAX Save Options */
    $('#of_save').live('click',function() {

        var nonce = $('#security').val();

        $('.ajax-loading-img').fadeIn();

        //get serialized data from all our option fields
        var serializedReturn = $('#of_form :input[name][name!="security"][name!="of_reset"]').serialize();

        var data = {
            type: 'save',
            action: 'of_ajax_post_action',
            security: nonce,
            data: serializedReturn
        };

        $.post(ajaxurl, data, function(response) {
            var success = $('#of-popup-save');
            var fail = $('#of-popup-fail');
            var loading = $('.ajax-loading-img');
            loading.fadeOut();

            if (response==1) {
                success.fadeIn();
            } else {
                fail.fadeIn();
            }

            window.setTimeout(function(){
                success.fadeOut();
                fail.fadeOut();
            }, 2000);
        });

        return false;

    });


    /* AJAX Options Reset */
    $('#of_reset').click(function() {

        //confirm reset
        var answer = confirm("Click OK to reset. All settings will be lost and replaced with default settings!");

        //ajax reset
        if (answer){

            var nonce = $('#security').val();

            $('.ajax-reset-loading-img').fadeIn();

            var data = {

                type: 'reset',
                action: 'of_ajax_post_action',
                security: nonce,
            };

            $.post(ajaxurl, data, function(response) {
                var success = $('#of-popup-reset');
                var fail = $('#of-popup-fail');
                var loading = $('.ajax-reset-loading-img');
                loading.fadeOut();

                if (response==1)
                {
                    success.fadeIn();
                    window.setTimeout(function(){
                        location.reload();
                    }, 1000);
                }
                else
                {
                    fail.fadeIn();
                    window.setTimeout(function(){
                        fail.fadeOut();
                    }, 2000);
                }


            });

        }

        return false;

    });


    /**	Tipsy @since v1.3 */
    if (jQuery().tipsy) {
        $('.typography-size, .typography-height, .typography-face, .typography-style, .of-typography-color').tipsy({
            fade: true,
            gravity: 's',
            opacity: 0.7,
        });
    }


    /**
     * JQuery UI Slider function
     * Dependencies 	 : jquery, jquery-ui-slider
     * Feature added by : Smartik - http://smartik.ws/
     * Date 			 : 03.17.2013
     */
    jQuery('.smof_sliderui').each(function() {

        var obj   = jQuery(this);
        var sId   = "#" + obj.data('id');
        var val   = parseInt(obj.data('val'));
        var min   = parseInt(obj.data('min'));
        var max   = parseInt(obj.data('max'));
        var step  = parseInt(obj.data('step'));

        //slider init
        obj.slider({
            value: val,
            min: min,
            max: max,
            step: step,
            slide: function( event, ui ) {
                jQuery(sId).val( ui.value );
            }
        });

    });


    /**
     * Switch
     * Dependencies 	 : jquery
     * Feature added by : Smartik - http://smartik.ws/
     * Date 			 : 03.17.2013
     */
    jQuery(".cb-enable").click(function(){
        var parent = $(this).parents('.switch-options');
        jQuery('.cb-disable',parent).removeClass('selected');
        jQuery(this).addClass('selected');
        jQuery('.main_checkbox',parent).attr('checked', true);

        //fold/unfold related options
        var obj = jQuery(this);
        var $fold='.f_'+obj.data('id');
        jQuery($fold).slideDown('normal', "swing");
    });
    jQuery(".cb-disable").click(function(){
        var parent = $(this).parents('.switch-options');
        jQuery('.cb-enable',parent).removeClass('selected');
        jQuery(this).addClass('selected');
        jQuery('.main_checkbox',parent).attr('checked', false);

        //fold/unfold related options
        var obj = jQuery(this);
        var $fold='.f_'+obj.data('id');
        jQuery($fold).slideUp('normal', "swing");
    });
    //disable text select(for modern chrome, safari and firefox is done via CSS)
    if (($.browser.msie && $.browser.version < 10) || $.browser.opera) {
        $('.cb-enable span, .cb-disable span').find().attr('unselectable', 'on');
    }


    /**
     * Google Fonts
     * Dependencies 	 : google.com, jquery
     * Feature added by : Smartik - http://smartik.ws/
     * Date 			 : 03.17.2013
     */
    function GoogleFontSelect( slctr, mainID ){

        var _selected = $(slctr).val(); 						//get current value - selected and saved
        var _linkclass = 'style_link_'+ mainID;
        var _previewer = mainID +'_ggf_previewer';

        if( _selected ){ //if var exists and isset

            //Check if selected is not equal with "Select a font" and execute the script.
            if ( _selected !== 'none' && _selected !== 'Select a font' ) {

                //remove other elements crested in <head>
                $( '.'+ _linkclass ).remove();

                //replace spaces with "+" sign
                var the_font = _selected.replace(/\s+/g, '+');

                //add reference to google font family
                $('head').append('<link href="http://fonts.googleapis.com/css?family='+ the_font +'" rel="stylesheet" type="text/css" class="'+ _linkclass +'">');

                //show in the preview box the font
                $('.'+ _previewer ).css('font-family', _selected +', sans-serif' );

            }else{

                //if selected is not a font remove style "font-family" at preview box
                $('.'+ _previewer ).css('font-family', '' );

            }

        }

    }

    //init for each element
    jQuery( '.google_font_select' ).each(function(){
        var mainID = jQuery(this).attr('id');
        GoogleFontSelect( this, mainID );
    });

    //init when value is changed
    jQuery( '.google_font_select' ).change(function(){
        var mainID = jQuery(this).attr('id');
        GoogleFontSelect( this, mainID );
    });



}); //end doc ready

jQuery(document).ready(function($) {
	var colors = {
		color_0: {
			header_bg: '#fff',
			menu_text: '#444',
			menu_hover_text: '#fda527',
			menu_active_text: '#fe4641',
			drop_bg: '#fff',
			drop_text: '#444',
			drop_hover_bg: '#fff',
			drop_hover_text: '#fda527',
			drop_active_bg: '#fff',
			drop_active_text: '#fe4641',
			main_bg: '#fff',
			main_border: '#e5e5e5',
			main_text: '#444',
			main_primary: '#fe4641',
			main_secondary: '#fda527',
			main_faded: '#999',
			footer_bg: '#252525',
			footer_border: '#333',
			footer_text: '#999',
			footer_link: '#fe4641',
			footer_link_hover: '#fda527'
		},
		color_1: {
			header_bg: '#2c3e50',
			menu_text: '#edf0f2',
			menu_hover_text: '#fc4349',
			menu_active_text: '#fff',
			drop_bg: '#2c3e50',
			drop_text: '#edf0f2',
			drop_hover_bg: '#2c3e50',
			drop_hover_text: '#fc4349',
			drop_active_bg: '#2c3e50',
			drop_active_text: '#6dbcdb',
			main_bg: '#fff',
			main_border: '#e4e8eb',
			main_text: '#5c6166',
			main_primary: '#6dbcdb',
			main_secondary: '#fc4349',
			main_faded: '#a4abb3',
			footer_bg: '#2c3e50',
			footer_border: '#3f4e5d',
			footer_text: '#b5c0c4',
			footer_link: '#6dbcdb',
			footer_link_hover: '#fc4349'
		},
		color_2: {
			header_bg: '#29b28f',
			menu_text: '#fff',
			menu_hover_text: '#fff',
			menu_active_text: '#fff',
			drop_bg: '#0190a8',
			drop_text: '#fff',
			drop_hover_bg: '#fff',
			drop_hover_text: '#0190a8',
			drop_active_bg: '#008299',
			drop_active_text: '#fff',
			main_bg: '#f2f7f7',
			main_border: '#dae0e0',
			main_text: '#5c6566',
			main_primary: '#29b28f',
			main_secondary: '#0190a8',
			main_faded: '#a4b1b3',
			footer_bg: '#445a58',
			footer_border: '#546a68',
			footer_text: '#c9d1d0',
			footer_link: '#29b28f',
			footer_link_hover: '#fff'
		},
		color_3: {
			header_bg: '#fff',
			menu_text: '#444',
			menu_hover_text: '#000',
			menu_active_text: '#c20',
			drop_bg: '#fff',
			drop_text: '#444',
			drop_hover_bg: '#000',
			drop_hover_text: '#fff',
			drop_active_bg: '#fff',
			drop_active_text: '#c20',
			main_bg: '#fff',
			main_border: '#e5e5e5',
			main_text: '#444',
			main_primary: '#c20',
			main_secondary: '#000',
			main_faded: '#999',
			footer_bg: '#000',
			footer_border: '#1a1a1a',
			footer_text: '#777',
			footer_link: '#bbb',
			footer_link_hover: '#fff'
		},
		color_4: {
			header_bg: '#121619',
			menu_text: '#d0d5db',
			menu_hover_text: '#937cbf',
			menu_active_text: '#69aadb',
			drop_bg: '#121619',
			drop_text: '#d0d5db',
			drop_hover_bg: '#121619',
			drop_hover_text: '#937cbf',
			drop_active_bg: '#121619',
			drop_active_text: '#69aadb',
			main_bg: '#222b34',
			main_border: '#323e49',
			main_text: '#d0d5db',
			main_primary: '#69aadb',
			main_secondary: '#937cbf',
			main_faded: '#6c7880',
			footer_bg: '#121619',
			footer_border: '#1f2529',
			footer_text: '#848b91',
			footer_link: '#d0d5db',
			footer_link_hover: '#937cbf'
		},
		color_5: {
			header_bg: '#fff',
			menu_text: '#66525f',
			menu_hover_text: '#f4a641',
			menu_active_text: '#f4a641',
			drop_bg: '#fff',
			drop_text: '#66525f',
			drop_hover_bg: '#f4a641',
			drop_hover_text: '#fff',
			drop_active_bg: '#fff',
			drop_active_text: '#f4a641',
			main_bg: '#fff',
			main_border: '#ebe6e9',
			main_text: '#66525f',
			main_primary: '#f4a641',
			main_secondary: '#921245',
			main_faded: '#b39fac',
			footer_bg: '#301c2a',
			footer_border: '#442b3d',
			footer_text: '#b8a5b2',
			footer_link: '#f4a641',
			footer_link_hover: '#fff'
		}
	}

	function update_custom_colors(color_scheme){
		for (var field_id in color_scheme) {
			var color_hex = color_scheme[field_id];
			jQuery('#section-' + field_id + ' .colorSelector').ColorPickerSetColor(color_hex);
			jQuery('#section-' + field_id + ' .colorSelector').children('div').css('backgroundColor', color_hex);
			jQuery('#section-' + field_id + ' .of-color').val(color_hex);
		}
	}

	jQuery('#color_scheme').change(function() {
		switch ($(this).val()){
			case 'White Alizarin': update_custom_colors(colors.color_0); break;
			case 'Nautical Knot': update_custom_colors(colors.color_1); break;
			case 'Mild Ocean': update_custom_colors(colors.color_2); break;
			case 'Black & White': update_custom_colors(colors.color_3); break;
			case 'Twilight': update_custom_colors(colors.color_4); break;
			case 'White Royal': update_custom_colors(colors.color_5); break;
		}
	});

    jQuery('.of-color').on('change', function(){
        jQuery(this).siblings('.colorSelector').ColorPickerSetColor(jQuery(this).val());
        jQuery(this).siblings('.colorSelector').children('div').css('backgroundColor', jQuery(this).val());
    });
});