var show_delay = 777;
var hide_delay = 333;
var media_id = '';

ajaxurl = tmm_l10n.ajaxurl;

(function($) {

	$.fn.life = function(types, data, fn) {
		"use strict";
		$(this.context).on(types, this.selector, data, fn);
		return this;
	};

})(jQuery);

function escapeHTML(s) {
	return String(s).replace(/&(?!\w+;)/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

jQuery(document).ready(function() {

		jQuery('body').append(
			'<div id="html_buffer"></div>\
			<div class="info_popup"></div>\
			<div style="display: none;">\
				<div id="google_font_set" style="width: 800px; height: 600px;">\
					<ul id="google_font_set_list"></ul><br />\
				</div>\
				<div id="ui_slider_item">\
					<div class="clearfix ui-slider-item" id="__UI_SLIDER_NAME__">\
						<input type="text" class="range-amount-value" value="__UI_SLIDER_VALUE__" />\
						<input type="hidden" value="__UI_SLIDER_VALUE__" name="__UI_SLIDER_NAME__" class="range-amount-value-hidden" />\
						<div class="slider-range __UI_SLIDER_NAME__"></div>\
					</div>\
				</div>\
			</div>');
    
        
        //Menu Options
        
        jQuery('.menu_icon_type').life('change', function(){
            var $this = jQuery(this),
            val = $this.val(), 
            this_icon = $this.next('i');
            this_icon.attr('class', val);
        });
              
        jQuery('input[type=checkbox].edit-menu-item-mega').life('change',function(){
            var $this = jQuery(this);
            var thisItemMenu = $this.parent().parent().parent().parent().parent();
            
            if ($this.prop('checked')){
                var next = thisItemMenu.nextUntil(".menu-item-depth-0");
                next.each(function(){
                    var $this = jQuery(this);
                    var styleTitleI = $this.find('.item-title>i');
                    var styleColumnType = $this.find('.column_layout_menu');
                    var styleIcon = $this.find('.set_icon_menu');
                    var styleImage = $this.find('.set_image_menu');
                    var styleShortcode = $this.find('.set_shortcode_menu'); 
                   if ($this.attr('class').indexOf('menu-item-depth-1')!=-1){                    
                        styleTitleI.show();
                        styleColumnType.show();
                        styleIcon.hide();
                        styleImage.hide();                        
                        
                   } else{
                        styleTitleI.hide();
                        styleColumnType.hide();
                   }
                    
                   if ($this.attr('class').indexOf('menu-item-depth-2')!=-1){
                        
                        styleShortcode.show();                       
                                                
                   }else{
                        styleShortcode.hide();
                   }
                   
                });
            }else{
                var next = thisItemMenu.nextUntil(".menu-item-depth-0");
                next.each(function(){
                    var $this = jQuery(this); 
                    var styleTitleI = $this.find('.item-title>i');
                    var styleColumnType = $this.find('.column_layout_menu');
                    var styleIcon = $this.find('.set_icon_menu');
                    var styleImage = $this.find('.set_image_menu');
                    var styleShortcode = $this.find('.set_shortcode_menu');
                    
                    styleTitleI.hide();
                    styleColumnType.hide();
                    styleShortcode.hide();
                    styleIcon.show();
                    styleImage.show();
                });
            }
        });
        
        if(typeof wpNavMenu != 'undefined'){   
            
            var menu_item = jQuery('li.menu-item');
            menu_item.each(function(){
                if (jQuery(this).attr('class').indexOf('menu-item-depth-0')!=-1){
                    var styleImage = jQuery(this).find('.set_image_menu');
                    styleImage.hide();
                }
                if (jQuery(this).attr('class').indexOf('menu-item-depth-2')!=-1){
                    var parent=jQuery(this).prev();
                    for(var i=0; jQuery('.menu-item').length; i++){
                        if (parent.attr('class').indexOf('menu-item-depth-0')==-1){
                            parent = parent.prev();
                        }else{
                            var styleShortcode = jQuery(this).find('.set_shortcode_menu');
                            var parent_check = parent.find('input[type=checkbox].edit-menu-item-mega');
                            if(parent_check.prop('checked')){
                                styleShortcode.show();
                            }else{
                                styleShortcode.hide();
                            }
                            return;
                        }
                    }
                }
            });         
            
            var tmm_api = wpNavMenu;

	        if (tmm_api.menuList) {

		        tmm_api.menuList.on( "sortstart", function( event, ui ) {
			        /* fix for iframe */
			        var editor_wrap = ui.item.find('.advanced_editor'),
				        id = editor_wrap.data('editorid'),
				        hide_button = editor_wrap.siblings('.hide_editor');
			        if(hide_button.length){
				        hide_button.trigger('click');
			        }
			        tinymce.execCommand('mceRemoveEditor', true, id);

			        var styleTitleI = ui.item.find('.item-title>i');
			        var styleColumnType = ui.item.find('.column_layout_menu');
			        var styleIcon = ui.item.find('.set_icon_menu');
			        var styleImage = ui.item.find('.set_image_menu');
			        styleTitleI.removeAttr('style');
			        styleColumnType.removeAttr('style');
			        styleIcon.removeAttr('style');
			        styleImage.removeAttr('style');

			        try {
				        tinymce.remove();
			        } catch (e) {}
		        });

		        tmm_api.menuList.on( "sortstop", function( event, ui ) {
			        var styleTitleI = ui.item.find('.item-title>i');
			        var styleColumnType = ui.item.find('.column_layout_menu');
			        var styleIcon = ui.item.find('.set_icon_menu');
			        var styleImage = ui.item.find('.set_image_menu');
			        var styleShortcode = ui.item.find('.set_shortcode_menu');

			        setTimeout(function(){

				        if (ui.item.attr('class').indexOf('menu-item-depth-0')!=-1){
					        styleImage.hide();
				        }

				        if (ui.item.attr('class').indexOf('menu-item-depth-1')!=-1){
					        var parent=ui.item.prev();
					        for(var i=0; jQuery('.menu-item').length; i++){
						        if (parent.attr('class').indexOf('menu-item-depth-0')==-1){
							        parent = parent.prev();
						        }else{
							        var parent_check = parent.find('input[type=checkbox].edit-menu-item-mega');
							        if(parent_check.prop('checked')){
								        styleTitleI.show();
								        styleColumnType.show();
								        styleIcon.hide();
								        styleImage.hide();
							        }else{
								        styleTitleI.hide();
								        styleColumnType.hide();
							        }
							        return;
						        }

					        }

				        }
				        if (ui.item.attr('class').indexOf('menu-item-depth-2')!=-1){
					        var parent=ui.item.prev();
					        for(var i=0; jQuery('.menu-item').length; i++){
						        if ( parent.attr('class') && parent.attr('class').indexOf('menu-item-depth-0')==-1){
							        parent = parent.prev();
						        }else{
							        var parent_check = parent.find('input[type=checkbox].edit-menu-item-mega');
							        if(parent_check.prop('checked')){
								        styleShortcode.show();
							        }else{
								        styleShortcode.hide();
							        }
							        return;
						        }
					        }
				        }

			        },1000);

		        });

	        }

        }
        
        jQuery('.show_editor').life('click', function(){
            jQuery('.advanced_editor').each(function(){
                var $this = jQuery(this);
                $this.slideUp('300'); 
                $this.prev().attr('class', 'show_editor').text('Show advanced editor');
            });
            var $this = jQuery(this);            
            var advanced_editor = $this.parent().find('.advanced_editor');            
            advanced_editor.slideDown('300');
            $this.attr('class', 'hide_editor').text('Hide advanced editor');
            var id = $this.data('id');               

	        tinymce.execCommand('mceAddEditor', true, id);
	        tinyMCE.get(id).focus();

			tinymce.get(id).on('blur', function(){
				var content = tinyMCE.activeEditor.getContent();

				content = jQuery.trim(content);

				if (content.length == 0) {
					content = '<p></p>';
				}

				jQuery('#'+id).text(content);
			});
            
            return false;
        });
        
        jQuery('.hide_editor').life('click', function(){
            var $this = jQuery(this);
			var id = $this.data('id');
			var content = tinyMCE.activeEditor.getContent();

			jQuery('#'+id).text(content);
			tinymce.get( id ).off('blur');

            var advanced_editor = $this.parent().find('.advanced_editor'); 
            advanced_editor.slideUp('300');
            $this.attr('class', 'show_editor').text('Show advanced editor');
            return false;
        });
        
        jQuery('.add_menu_item_image').life('click', function(){               
                       
            $this = jQuery(this);
            this_dataid = $this.data('id');
            image_holder = jQuery('.menu_item_image_'+this_dataid);
            src_holder = jQuery('input[name="menu-item-image[' + this_dataid + ']"]');

            var insert = function(id){
                 var data = {
                    action : "setmenu_featured_image",
                    id : id
                };
                jQuery.post(ajaxurl, data, function(response){
                     response = jQuery.parseJSON(response);
                     image_holder.append(response['img']);
                     src_holder.val(response['src']['0']);
                     $this.text('Remove featured image').attr('class', 'remove_menu_item_image');
                });
            };

            wp.media.featuredImage.select = function(){
                var id= this.get('selection').single().id;
                insert(id);
            };

            wp.media.featuredImage.frame().open(null);

            return false;
        });      
        
        jQuery('.remove_menu_item_image').life('click', function(){
            var $this = jQuery(this);
            $this.next().find('img').remove();
            $this.prev().val('none');
            $this.text('Add Featured Image').attr('class', 'add_menu_item_image');
            return false;
        });
        
        jQuery(".option_menu_checkbox").life('click', function() {
			if (jQuery(this).is(":checked")) {
				jQuery(this).prev("input[type=hidden]").val(1);				
			} else {
				jQuery(this).prev("input[type=hidden]").val('none');				
			}
		});
        
	colorizator();

	draw_ui_slider_items();
	
	jQuery('.button_upload').life('click', function()
	{
		get_tb_editor_image_link(jQuery(this).prev('input, textarea'));
		return false;
	});

	jQuery('.button_upload_audio').life('click', function()
	{
		get_tb_editor_audio_link(jQuery(this).prev('input, textarea'));
		return false;
	});

	jQuery('.button_upload_video').life('click', function()
	{
		get_tb_editor_video_link(jQuery(this).prev('input, textarea'));
		return false;
	});

    jQuery('.website_width_switcher').life('change', function(){
        var val = jQuery(this).val();
        switchWebsiteWidth(val);
    });

    var websiteWidthIn = jQuery('.website_width_switcher').val();
    switchWebsiteWidth(websiteWidthIn);

    function switchWebsiteWidth(val){
        var websiteWidthPx = jQuery('.website_width_px').parents('.option'),
            websiteWidthPer = jQuery('.website_width_per').parents('.option');
        switch(val){
            case 'px':
                websiteWidthPx.slideDown(300);
                websiteWidthPer.slideUp(300);
                break;
            case 'per':
                websiteWidthPx.slideUp(300);
                websiteWidthPer.slideDown(300);
                break;
        }
    }

	jQuery('#logo_image').life('change', function()
	{
		var src = jQuery(this).val(),
			display = (src !== '') ? 'inline' : 'none';

		jQuery('#logo_preview_image').attr('src', src).css('display', display);
	});

    var logoOptionsVal = jQuery('#use_logo_two_colors').is(':checked');
    switchLogoOptions(logoOptionsVal);

    jQuery('#use_logo_two_colors').life('change', function(){
        var val = jQuery(this).is(':checked');
        switchLogoOptions(val);
    });

    function switchLogoOptions(val){
        var advancedLogoOptions = jQuery('.advanced_logo_options'),
            logoText = jQuery('.logo_text_val');
        if(val){
            var logoTextVal = jQuery('.logo_text_val').val(),
                prevSeparate = jQuery('.splitted_logo_text').val();
            if (prevSeparate == '') {
                jQuery('.splitted_logo_text').val(logoTextVal);
            }

            advancedLogoOptions.slideDown(300);
            logoText.attr('disabled', true).css('background-color', '#eee');
        } else {
            advancedLogoOptions.slideUp(300);
            logoText.attr('disabled', false).css('background-color', '#fff');
        }
    }

	//option_checkbox
	jQuery(".option_checkbox").life('click', function() {
		if (jQuery(this).is(":checked")) {
			jQuery(this).prev("input[type=hidden]").val(1);
			jQuery(this).next("input[type=hidden]").val(1);
			jQuery(this).val(1);
		} else {
			jQuery(this).prev("input[type=hidden]").val(0);
			jQuery(this).next("input[type=hidden]").val(0);
			jQuery(this).val(0);
		}
	});

	jQuery(".admin-choice-sidebar").on("click", "a", function(e) {
		var self = jQuery(this), hidden, data_val;

		if(self.parents('.admin-choice-sidebar').hasClass('admin-product-sidebar')){
			hidden = jQuery(".product_sidebar_position");
			data_val = self.parent().attr('data-val');
		}else{
			hidden = jQuery("[name=sidebar_position]");
			data_val = self.attr('data-val');
		}

		hidden.val(data_val);

		self.parent().siblings().removeClass("current-item");
		self.parent().addClass("current-item");

		e.preventDefault();
	});

	jQuery(".admin-page-choice-sidebar").on("click", "a", function(e) {
		var self = jQuery(this), hidden, data_val;
		hidden = jQuery("[name=page_sidebar_position]");
		data_val = self.attr('data-val');
		hidden.val(data_val);

		self.parent().siblings().removeClass("current-item");
		self.parent().addClass("current-item");

		e.preventDefault();
	});

    // Widget Options

    jQuery('.widget .show_mode').each(function(){
        var $this = jQuery(this),
            val = $this.val();
        changeMode(val, $this);
    });

    jQuery('.widget.open .show_mode').life('change', function(){
        var $this = jQuery(this),
            val = $this.val();
            changeMode(val, $this);
    });

    function changeMode(val, $this){
        var selectedOption = $this.parent().parent().find('.selected_option');
        var allOption = $this.parent().parent().find('.all_option');

        switch (val){
            case 'mode1':
                selectedOption.slideDown(300);
                allOption.slideUp(300);
                break;
            case 'mode2':
                selectedOption.slideUp(300);
                allOption.slideDown(300);
                break;
        }
    }

    jQuery(document).ajaxSuccess(function(e, xhr, settings) {
        var widget_id_base_accordion = 'tmm_accordion_widget',
         widget_id_base_metro = 'tmm_featured_boxes',
         widget_id_base_testimonials = 'tmm_testimonials_widget';

        if(settings.data && settings.data.search('action=save-widget') != -1 && settings.data.search('id_base=' + widget_id_base_accordion) != -1) {
            if (jQuery('.widget-content .tabs-nav').length){
                jQuery('.widget-content .tabs-nav').each(function () {
                    var $this = jQuery(this),
                        link = $this.find('li>a');
                    initNav(link, 'first');
                });
            }
        }
        if(settings.data && settings.data.search('action=save-widget') != -1 && settings.data.search('id_base=' + widget_id_base_metro) != -1) {
            colorizator();
        }
        if(settings.data && settings.data.search('action=save-widget') != -1 && settings.data.search('id_base=' + widget_id_base_testimonials) != -1) {
            jQuery('.widget .show_mode').each(function(){
                var $this = jQuery(this),
                    val = $this.val();

                    changeMode(val, $this);

            });
        }

    });

    jQuery('.remove_section').life('click', function(){
        var $this = jQuery(this),
            liItem = $this.parent('li'),
            itemClass = liItem.attr('class'),
            tab;

        itemClass = itemClass.split(' ');
        itemClass = itemClass['0'];

        tab = jQuery('[href="'+ '.' + itemClass +'"]').parent('li');

        var id = $this.parents('.accordion_layout').attr('class');
        id = id.split(' ');
        id = id['0'];
        id = id.split('_');
        id = id['2'];

        if (jQuery('.accordion_layout_' + id + ' .layers_items>li').length > 1){
            liItem.remove();
            tab.remove();
            initNav('.accordion_layout_' + id + ' .tabs-nav li a', 'last');
            generateNumbers(id);

            changeValue(id);
        }

        return false;
    });

    jQuery('.widget.open .add_new_section').life('click', function(){

        var $this = jQuery(this),
            layout = $this.parent('.accordion_layout'),
            tabs = layout.find('.tabs-nav'),
            items = layout.find('.layers_items'),
            old_tab_val = tabs.find('li:last').text(),
            new_tab =  tabs.find('li:last').clone(),
            new_item = items.find('li:last').clone(),
            new_val;

        var d = new Date(),
        uniqid = Math.random() * d.getTime();
        uniqid = Math.round(uniqid);

        new_val = old_tab_val.split('#');
        new_val = new_val['1'];
        new_val = +new_val + 1;

        new_tab.find('a').attr('href', '.item_'+uniqid).attr('class', '').html('#'+new_val);
        new_item.attr('class', 'item_'+uniqid+' layer_item');
        new_item.find('.item_title').val('');
        new_item.find('.item_body').text('');
        new_item.css({'opacity' : '1'});

        tabs.append(new_tab);
        items.append(new_item);

        var id = $this.parents('.accordion_layout').attr('class');
        id = id.split(' ');
        id = id['0'];
        id = id.split('_');
        id = id['2'];
        initNav('.accordion_layout_' + id + ' .tabs-nav li a', 'last');

        return false;
    });

    function generateNumbers(id){
        var tabs = jQuery('.accordion_layout_' + id +' .tabs-nav>li>a');
        tabs.each(function(i){
           var $this = jQuery(this);
            $this.text('#'+(i+1));
        });
    }

    function initNav(nav, int) {

        var nav = jQuery(nav);

        nav.life('click', function() {
            var $this = jQuery(this);
            var content = $this.parent().parent().next().children('li');
            var nav = $this.parent().parent().find('li>a');

            if ($this.attr('class').indexOf('active') == -1) {
                content.each(function(){
                    jQuery(this).hide();
                });
                nav.each(function(){
                    jQuery(this).removeClass('active');
                });

                $this.addClass('active');

                jQuery(".widget-content " + $this.attr('href')).fadeIn(300);
            }
            return false;
        });

        switch (int){
            case 'first':
                nav.first().trigger('click');
                break;
            case 'last':
                nav.last().trigger('click');
                break;
            default:
                nav.first().trigger('click');
                break;
        }

    }

    if (jQuery('.widget-content .tabs-nav').length){
        jQuery('.widget-content .tabs-nav').each(function () {
           var $this = jQuery(this),
                link = $this.find('li>a');
                initNav(link, 'first');
        });
    }

    //changeValue(id);

    function changeValue(id){
        var acc_titles = '',
            inputTitles, textBodies,
            acc_bodies = '';

        inputTitles = jQuery('.accordion_layout_' + id ).find('.item_title');
        textBodies = jQuery('.accordion_layout_'+ id ).find('.item_body');

        inputTitles.each(function(i){
            var $this = jQuery(this),
                val = $this.val();
            if (val!=''){
                acc_titles = (acc_titles) ? acc_titles + '^'+ val : acc_titles + val;

                var val_text = jQuery(textBodies[i]).val();
                acc_bodies = (acc_bodies) ? acc_bodies + '^'+ val_text : acc_bodies + val_text;
            }
        });

        jQuery('.accordion_layout_' + id + ' .acc_titles').val(acc_titles);
        jQuery('.accordion_layout_' + id + ' .acc_bodies').val(acc_bodies);
    }
    jQuery('.acc_changer').life('keyup change', function() {
        var id = jQuery(this).parents('.accordion_layout');
        id = id.attr('class');
        id = id.split(' ');
        id = id['0'];
        id = id.split('_');
        id = id['2'];
        changeValue(id);
    });

    /* dissmiss admin notices */
    jQuery(".is-dismissible").on("click", '.notice-dismiss', function (e) {

        var type = jQuery(this).parents('.notice').attr('class');

        var data = {
            action: 'tmm_dismiss_notice',
            type: type
        }

        jQuery.post(ajaxurl, data, function () {});

    });

});

//******************

function getURLParameter(name) {
	return decodeURI((RegExp(name + '=' + '(.+?)(&|$)').exec(location.search) || [, null])[1]);
}

function draw_ui_slider_items() {

	var items = jQuery(".ui_slider_item");
	var template = jQuery("#ui_slider_item").html();

	jQuery.each(items, function(key, item) {
		var max_value = parseInt(jQuery(item).attr('max-value'), 10);
		var min_value = parseInt(jQuery(item).attr('min-value'), 10);
		var name = jQuery(item).attr('name');
		var value = parseFloat(jQuery(item).attr('value'), 10);
		if (!value) {
			value = 0;
		}

		var html = template;
		//*****
		html = html.replace(/__UI_SLIDER_NAME__/gi, name);
		html = html.replace(/__UI_SLIDER_VALUE__/gi, value);
		jQuery(item).replaceWith(html);

		jQuery("#" + name + " .range-amount-value").val(value);
		jQuery("#" + name + " .range-amount-value-hidden").val(value);

		var slider = jQuery("." + name).slider({
			range: "max",
			animate: true,
			value: parseFloat(value, 10),
			step: 1,
			min: parseInt(min_value, 10),
			max: parseInt(max_value, 10),
			slide: function(event, ui) {
				jQuery("#" + name + " .range-amount-value").val(ui.value);
				jQuery("#" + name + " .range-amount-value-hidden").val(ui.value);
			}
		});

		jQuery("#" + name + " .range-amount-value").life('change', function() {
			var value = parseFloat(jQuery(this).val(), 10);
			slider.slider("value", value);
			jQuery("#" + name + " .range-amount-value-hidden").val(value);
		});

	});
}

//******************

function show_info_popup(text) {
	jQuery(".info_popup").text(text);
	jQuery(".info_popup").fadeTo(400, 0.9);
	window.setTimeout(function() {
		jQuery(".info_popup").fadeOut(400);
	}, 1000);
}

function show_static_info_popup(text) {
	jQuery(".info_popup").empty().append(text);
	jQuery(".info_popup").fadeTo(400, 0.9);
}

function hide_static_info_popup() {
	window.setTimeout(function() {
		jQuery(".info_popup").fadeOut(400);
	}, hide_delay);
}

function get_tb_editor_image_link(input_object, input_object2) {
	var frame = wp.media({
            title: wp.media.view.l10n.chooseImage,
            multiple: false,
            library: { type: 'image' }
        });

    frame.on( 'select', function() {
        var selection = frame.state().get('selection');
        selection.each(function(attachment) {
            var url = attachment.attributes.url;
            input_object.val(url).trigger('change');
            if (input_object2 != undefined) {
                input_object2.val(url);
            }
        });
    });

    frame.open();
}

function get_tb_editor_audio_link(input_object, input_object2) {
	var frame = wp.media({
            title: wp.media.view.l10n.audioAddSourceTitle,
            multiple: false,
            library: { type: 'audio' }
        });

    frame.on( 'select', function() {
        var selection = frame.state().get('selection');
        selection.each(function(attachment) {
            var url = attachment.attributes.url;
            input_object.val(url).trigger('change');
            if (input_object2 != undefined) {
                input_object2.val(url);
            }
        });
    });

    frame.open();
}

function get_tb_editor_video_link(input_object, input_object2) {
	var frame = wp.media({
            title: wp.media.view.l10n.videoAddSourceTitle,
            multiple: false,
            library: { type: 'video' }
        });

    frame.on( 'select', function() {
        var selection = frame.state().get('selection');
        selection.each(function(attachment) {
            var url = attachment.attributes.url;
            input_object.val(url).trigger('change');
            if (input_object2 != undefined) {
                input_object2.val(url);
            }
        });
    });

    frame.open();
}

function get_time_miliseconds() {
	var d = new Date();
	return d.getTime();
}

function uniqid() {
	var uniqid = Math.random() * get_time_miliseconds();
	return Math.round(uniqid);
}

function show_loader() {
	show_static_info_popup(tmm_l10n.loading);
}

function hide_loader() {
	hide_static_info_popup();
}
//******************
function gmt_init_map(Lat, Lng, map_canvas_id, zoom, maptype, info, show_marker, show_popup, scrollwheel) {
	var latLng = new google.maps.LatLng(Lat, Lng);
	var homeLatLng = new google.maps.LatLng(Lat, Lng);

	switch (maptype) {
		case "SATELLITE":
			maptype = google.maps.MapTypeId.SATELLITE;
			break;

		case "HYBRID":
			maptype = google.maps.MapTypeId.HYBRID;
			break;

		case "TERRAIN":
			maptype = google.maps.MapTypeId.TERRAIN;
			break;

		default:
			maptype = google.maps.MapTypeId.ROADMAP;
			break;

	}

	var map;
	map = new google.maps.Map(document.getElementById(map_canvas_id), {
		zoom: zoom,
		center: latLng,
		mapTypeId: maptype,
		scrollwheel: scrollwheel
	});


	if (show_marker) {
		var marker = new google.maps.Marker({
			position: homeLatLng,
			draggable: true,
			map: map
		});
	}

	google.maps.event.addListener(marker, "dragend", function() {
		jQuery("#event_map_latitude").val(marker.position.lat());
		jQuery("#event_map_longitude").val(marker.position.lng());
	});

	google.maps.event.addListener(map, "zoom_changed", function() {
		jQuery("#event_map_zoom").val(map.zoom);
	});

}


function colorizator() {
	var pickers = jQuery('.bgpicker');

	jQuery.each(pickers, function(key, picker) {

		var bg_hex_color = jQuery(picker).prev('.bg_hex_color');

		if (!jQuery(bg_hex_color).val()) {
			jQuery(bg_hex_color).val();
		}

		jQuery(picker).css('background-color', jQuery(bg_hex_color).val()).ColorPicker({
			color: jQuery(bg_hex_color).val(),
			onChange: function(hsb, hex, rgb) {
				jQuery(picker).css('backgroundColor', '#' + hex);
				jQuery(bg_hex_color).val('#' + hex);
				jQuery(bg_hex_color).trigger('change');
			}
		});

	});
}

//for dynamic html
function items_colorizator(in_container) {
	var pickers = jQuery(in_container).find('.bgpicker');
	jQuery.each(pickers, function(key, picker) {

		var bg_hex_color = jQuery(picker).prev('.bg_hex_color');

		if (!jQuery(bg_hex_color).val()) {
			jQuery(bg_hex_color).val();
		}

		jQuery(picker).css('background-color', jQuery(bg_hex_color).val()).ColorPicker({
			color: jQuery(bg_hex_color).val(),
			onChange: function(hsb, hex, rgb) {
				jQuery(picker).css('backgroundColor', '#' + hex);
				jQuery(bg_hex_color).val('#' + hex);
				jQuery(bg_hex_color).trigger('change');
			}
		});

	});
}

function insert_html_in_buffer(html) {
	jQuery("#html_buffer").html(html);
}
