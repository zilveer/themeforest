// Images uploader 

var _id = null;
var _input = null;
var send = null;

jQuery(document).ready(function() {
	jQuery(document).on('click', '.upload_image_button', function() {
		var formfield = '';
		jQuery('.fancybox-overlay').css('display', 'none');
		formfield = jQuery(this).parent().find('#upload_image').attr('name');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true&amp;height=700&amp;width=800');
		_input = jQuery(this).prev();
		_id = jQuery(this).attr('data-id');
		return false;
	});

	var old_tb_remove = window.tb_remove;

	window.tb_remove = function() {
		jQuery('.fancybox-overlay').css('display', 'block');
		old_tb_remove();
	};

	send = window.send_to_editor;

	window.send_to_editor = function(html) {
		if(_id != null && _input != null) {
			var content = jQuery(html);
			var href = content.attr('href');
			var url = jQuery(html).find('img').attr('src');
			_input.val(href);
			//_input.val(url);
			jQuery('#image_upload_preview_'+_id).attr('src', url);
			jQuery('#image_upload_preview_'+_id).parent().removeClass('nonactive');
			tb_remove();
			jQuery('.fancybox-overlay').css('display', 'block');
			_id = null;
			_input = null;
		} else {
			send(html);
		}
	};

	jQuery('.upload_image_remove_button').on('click', function() {
		jQuery('.uploadinput-' + jQuery(this).data('id')).val('');
		jQuery('#image_upload_preview_' + jQuery(this).data('id')).attr('src', '');
		var img = jQuery('#image_upload_preview_' + jQuery(this).data('id'));
		var cloneImg = img.clone();
		var parent = img.parent();
		img.parent().addClass('nonactive');
		img.remove();
		parent.append(cloneImg);
	});

});