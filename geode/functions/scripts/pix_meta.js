/********************************
*
*   Get thumbnail from the server
*
********************************/
function geodeGetThumbnailUrl($id, $field, $altbg){
	var data = {
		action: 'geode_get_thumb',
		content: $id
	};
	jQuery.post(ajaxurl, data)
		.success(function(html){
			$field.css({backgroundImage: $altbg + 'url('+html+')'});
		});
}

/********************************
*
*   Determine whether a color is dark or bright
*
********************************/
function geode_hex2rgb( hex ) {
	hex = (hex.substr(0,1)=="#") ? hex.substr(1) : hex;
	if (hex.length < 6) {
		hex = hex[0]+hex[0]+hex[1]+hex[1]+hex[2]+hex[2];
	}
	if (!isNaN(hex)) {
		return [parseInt(hex.substr(0,2), 16), parseInt(hex.substr(2,2), 16), parseInt(hex.substr(4,2), 16)];
	} else {
		return [255,255,255];
	}
}
function geode_checkDarkness( hex ) {
	var rgb = geode_hex2rgb( hex );
    var min, max, delta, h, s, l;
    var r = rgb[0], g = rgb[1], b = rgb[2];
    min = Math.min(r, Math.min(g, b));
    max = Math.max(r, Math.max(g, b));
    delta = max - min;
    l = (min + max) / 2;
    s = 0;
    if (l > 0 && l < 1) {
      s = delta / (l < 0.5 ? (2 * l) : (2 - 2 * l));
    }
    h = 0;
    if (delta > 0) {
      if (max == r && max != g) h += (g - b) / delta;
      if (max == g && max != b) h += (2 + (b - r) / delta);
      if (max == b && max != r) h += (4 + (r - g) / delta);
      h /= 6;
    }
    return l > (255/2);
}
/********************************
*
*   Tabs
*
********************************/
var initTabs = function(){
	if(jQuery.isFunction(jQuery.fn.tabs)) {
		jQuery('.pix-ui-tabs').tabs();
	}
};

/********************************
*
*   Upload media
*
********************************/
var uploadImages = function(){
	jQuery('.pix_meta_boxes .pix_upload').each(function(){
		var t = jQuery(this),
			id = jQuery('input[data-type$="id"]', this).val(),
			field = jQuery('.img_preview', this);

		if ( id!=='' ) {
			field.addClass('filled');
			geodeGetThumbnailUrl(id, field, '');
		}

		jQuery(this).off('click', '.pix_remove_img');
		jQuery(this).on('click', '.pix_remove_img', function( e ){
			e.preventDefault();
			field.removeClass('filled');
			field.css({backgroundImage: 'none'});
			jQuery('input[data-type="id"]',t).val('');
			jQuery('input[data-type="size"]',t).val('');
		});
	});

	jQuery('.pix_meta_boxes').off('click','.pix_upload.upload_image a.pix_button, .pix_upload.upload_image span.img_preview');
	jQuery('.pix_meta_boxes').on('click', '.pix_upload.upload_image a.pix_button, .pix_upload.upload_image span.img_preview', function( e ){
		e.preventDefault();
		var button = jQuery(this),
			wrap = button.parents('.pix_upload').eq(0);

		var pix_media_frame = wp.media.frames.pix_media_frame = wp.media({

			className: 'media-frame pix-media-frame',
			frame: 'post',
			multiple: false,
			library: {
				type: 'image'
			}
		});

		pix_media_frame.on('insert', function(){
			var media_attachments = pix_media_frame.state().get('selection').toJSON(),
				thumbSize = jQuery('.attachment-display-settings select.size option:selected').val(),
				thumbUrl;

/******************************** Fill the input ********************************/
			jQuery.each(media_attachments, function(index, el) {
				var url = this.url,
					id = this.id,
					size = typeof thumbSize!=='undefined' ? thumbSize : '',
					field = wrap.find('.img_preview').addClass('filled');
				geodeGetThumbnailUrl(id, field, '');
				wrap
					.find('input[data-type="id"]').val(id).end()
					.find('input[data-type="size"]').val(size);

			});
/******************************** Fill the input ********************************/
		});

		pix_media_frame.open();
		jQuery('.media-menu a').eq(1).hide();
		jQuery('.media-toolbar-secondary').hide();
	});

	jQuery('.pix_meta_boxes').off('click', '.pix_upload.upload_video a');
	jQuery('.pix_meta_boxes').on('click', '.pix_upload.upload_video a', function( e ){
		e.preventDefault();
		var button = jQuery(this);

		var pix_media_frame = wp.media.frames.pix_media_frame = wp.media({

			className: 'media-frame pix-media-frame',
			frame: 'post',
			multiple: false,
			library: {
				type: 'video'
			}
		});

		pix_media_frame.on('insert', function(){
			var media_attachment = pix_media_frame.state().get('selection').first().toJSON(),
				previewUrl;
			console.log(media_attachment);
			url = media_attachment.url;
			button.parents('.pix_upload').eq(0).find('input').val(url);
			button.off('click');
		});

		pix_media_frame.open();
	});

};


/********************************
*
*   Color pickers
*
********************************/
function init_farbtastic(){
	if(jQuery.isFunction(jQuery.fn.farbtastic)) {
		jQuery('.colorpicker').each(function(){
			jQuery(this).after('<div class="picker_close" />');
		});
		jQuery(document).off('click','.pix_color_picker .pix_button');
		jQuery(document).on('click','.pix_color_picker .pix_button',function(){
			var t = jQuery(this);
			t.siblings('.colorpicker, i').fadeIn(150);

			t.siblings('i').off('click');
			t.siblings('i').on('click',function() {
				t.siblings('.colorpicker, i').fadeOut(150);
			});
	
			return false;
		});

		jQuery('.pix_meta_boxes .pix_color_picker').each(function() {
			var divPicker = jQuery(this).find('.colorpicker'),
				inputPicker = jQuery(this).find('input[type=text]');
			var txtColor = geode_checkDarkness(inputPicker.val()) ? '#000' : '#fff';
			inputPicker.css({backgroundColor:inputPicker.val(), color: txtColor});

			jQuery.farbtastic(divPicker, function(color){
				var txtColor = geode_checkDarkness(color) ? '#000' : '#fff';
				inputPicker.val(color).css({backgroundColor:color, color: txtColor});
			});
			inputPicker.on('keyup',function(){
				var colorVal = inputPicker.val();
				jQuery.farbtastic(divPicker).setColor(colorVal);
				inputPicker.css({backgroundColor:colorVal});
			});
		});
	}
}


/********************************
*
*   google maps
*
********************************/
function init_gMaps(){
	jQuery('.pix_meta_boxes').off('click', '.pix_googlemap_bg');
	jQuery('.pix_meta_boxes').on('click', '.pix_googlemap_bg', function(e){
		e.preventDefault();
		var t = jQuery(this),
			h = jQuery(window).height(),
			cols = 'three',
			val = 'maps',
			div = jQuery('#shortcodelic_'+val+'_generator'),
			input = t.parents('.pix_upload').eq(0).find('input[type="text"]');
		jQuery('.shortcodelic-dialog .ui-dialog-content').dialog('close');
		div.dialog({
			height: (h*0.8),
			width: '92%',
			modal: false,
			dialogClass: 'wp-dialog shortcodelic-dialog shortcodelic-'+cols+'-cols-dialog',
			position: { my: "center", at: "center", of: window },
			title: div.data('title'),
			zIndex: 100,
			open: function(){
				var tdial = jQuery(this);
				tdial.scrollTop(0);
				tdial.closest('.ui-dialog').find('.ui-button').eq(0).addClass('ui-dialog-titlebar-edit');
				if ( !jQuery('#shortcodelic-modal-overlay').length ) {
					jQuery('body').addClass('overflow_hidden').append('<div id="shortcodelic-modal-overlay" />');
				}
				getSelectValue(tdial);
				init_sliders();
				init_farbtastic();
				var set = setTimeout(function(){ jQuery(window).triggerHandler('resize'); },100);
			},
			buttons: {
				'0': function() {
					var ser = jQuery(this).find('input[name], textarea[name], select[name]').serialize();
					updatePostMeta(ser, 'shortcodelic_'+val, false, val);
				},
				'1': function() {
					var ser = jQuery(this).find('input[name], textarea[name], select[name]').serialize();
					updatePostMeta(ser, 'shortcodelic_'+val, true, val);
					var valInput = jQuery('input#shortcodelic_get_sc', div).val();
					input.val(valInput);
					jQuery(this).dialog( "close" );
				}
			},
			close: function(){
				jQuery('.el-list .element-tab', div).not('.clone').remove();
				var html = div.html();
				jQuery('body').removeClass('overflow_hidden');
				jQuery('#shortcodelic-modal-overlay').remove();
				/*jQuery('select option[value=""]',div).prop('selected', true);
				jQuery('select',div).trigger('change');*/
			}
		});
		jQuery(window).bind('resize',function() {
			h = jQuery(window).height();
			jQuery(div).dialog('option',{'height':(h*0.8),'position':{ my: "center", at: "center", of: window }});
		})/*.triggerHandler('resize')*/;
	});
}

/********************************
*
*   Sliders
*
********************************/
function init_sliders() {
	if(jQuery.isFunction(jQuery.fn.slider)) {
		jQuery('.slider_div').each(function(){
			var t = jQuery(this),
				value = jQuery('input',t).val(),
				mi = 1,
				m = 20,
				s = 1;
			if(t.hasClass('milliseconds')){
				mi = 0;
				m = 50000;
				s = 100;
			} else if(t.hasClass('milliseconds_2')){
				mi = 0;
				m = 5000;
				s = 10;
			} else if(t.hasClass('opacity')){
				mi = 0;
				m = 1;
				s = 0.05;
			} else if(t.hasClass('border')){
				mi = 0;
				m = 50;
				s = 1;
			} else if(t.hasClass('em')){
				mi = 0;
				m = 8;
				s = 0.001;
			} else if(t.hasClass('percent')){
				mi = 0;
				m = 100;
				s = 1;
			} else if(t.hasClass('ratio')){
				mi = 0;
				m = 20;
				s = 0.01;
			} else if(t.hasClass('gutter')){
				mi = 0;
				m = 20;
				s = 0.1;
			}
			jQuery('.slider_cursor',t).slider({
				range: 'min',
				value: value,
				min: mi,
				max: m,
				step: s,
				slide: function( event, ui ) {
					var value = ui.value;
					jQuery('input',t).val( value );
				}
			});
			jQuery('a',t).mousedown(function(event){
				t.addClass('active');
			});
			jQuery(document).mouseup(function(){
				t.removeClass('active');
			});
			jQuery('input',t).keyup(function(){
				var v = jQuery('input',t).val();
				jQuery('.slider_cursor',t).slider({
					range: 'min',
					value: v,
					min: 0,
					max: m,
					step: s,
					slide: function( event, ui ) {
						jQuery('input',t).val( ui.value );
					}
				});
			});
			jQuery('.slider_cursor',t).each(function(){
				if ( jQuery('.ui-slider-range-min',this).length > 1 ) {
					jQuery('.ui-slider-range-min',this).not(':last').remove();
				}
			});
		});
	}
}

jQuery(function(){
	initTabs();
	uploadImages();
	init_farbtastic();
	init_gMaps();
	init_sliders();
});