(function ($) {
    "use strict"; 
	jQuery(document).ready(function ($) {
		if ($('.set_custom_images').length > 0) {
			if (typeof wp !== 'undefined' && wp.media && wp.media.editor) {
				$('.wrap').on('click', '.set_custom_images', function (e) {
					e.preventDefault();
					var input_text = $('#' + (this.id).substring(7));
					wp.media.editor.send.attachment = function (props, attachment) {
						input_text.val(attachment.url);
					};
					wp.media.editor.open(input_text);
					return false;
				});
			}
		}
		jQuery('.menu_icon_wrap').each(function(){
			var _this = $(this);
			var $item_id = _this.attr('data-item_id');
			jQuery("li",_this).click(function() {
				jQuery(this).attr("class","selected").siblings().removeAttr("class");
				var icon = jQuery(this).attr("data-icon");
				jQuery("#edit-menu-item-menu_icon-"+ $item_id ).val(icon);
				jQuery(".icon-preview-"+ $item_id).html("<i class=\'icon fa fa-"+icon+"\'></i>");
			});
		})
		jQuery('.btn_clear').click(function(){
			$(this).parent().find('.menu-item-bg_image,.menu-item-menu_icon').val('');
			$(this).parent().find('.icon-preview').html('');
		})
		jQuery('.menu-item-submenu_type').change(function(){
			var el = jQuery(this);
			var el_value 	= el.val();
			var el_id 		= el.attr('id');
			var menu_id 	= 'menu-item-'+el_id.substring(36);
			if( el_value == 'widget_area' ) {
				jQuery("#"+menu_id+" .el_multicolumn").hide();
				jQuery("#"+menu_id+" .el_widget_area").show();
			}else if( el_value == 'multicolumn' ){
				jQuery("#"+menu_id+" .el_widget_area").hide();
				jQuery("#"+menu_id+" .el_multicolumn").show();
			}else if( el_value == 'standard' ){
				jQuery("#"+menu_id+" .el_widget_area").hide();
				jQuery("#"+menu_id+" .el_multicolumn").hide();
			}
		})
	});  
}(jQuery));
