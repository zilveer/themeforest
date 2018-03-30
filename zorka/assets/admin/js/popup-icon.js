Popup_icon = {
	htmlTag : {
		wrapper : '.popup-icon-wrapper',
		iconPreview :'#iconPreview',
		btnSave : '#btnSave'
	},
	vars : {
		obj_Call : null,
		current_icon : ''
	},
	init : function (obj_Call) {

		Popup_icon.vars.obj_Call = null;
		Popup_icon.vars.current_icon = '';

		if (obj_Call != undefined) {
			Popup_icon.vars.obj_Call = obj_Call;
			if (obj_Call.val() != '') {
				Popup_icon.vars.current_icon = obj_Call.val();
			}
		}

		if (jQuery('#g5plus-framework-popup-icon-wrapper').length == 0) {
			jQuery.ajax({
				type   : 'POST',
				data   : 'action=popup_icon',
				url    : zorka_ajax_url,
				success: function (html) {
					jQuery('body').append(html);
					Popup_icon.showPopup();
				},
				error  : function (html) {
				}
			});
		} else {
			Popup_icon.showPopup();
		}


	},
	showPopup: function() {
		Popup_icon.processButton();
		tb_show('Icons','#TB_inline?height=410&width=750&inlineId=g5plus-framework-popup-icon-wrapper',false);
	},
	processButton : function() {
		jQuery('#txtSearch',Popup_icon.htmlTag.wrapper).keyup(function(){
			// Retrieve the input field text and reset the count to zero
			var filter = jQuery(this).val(), count = 0;
			// Loop through the icon list
			jQuery('.list-icon ul li a',Popup_icon.htmlTag.wrapper).each(function(){
				// If the list item does not contain the text phrase fade it out
				if (jQuery(this).attr('title').search(new RegExp(filter, "i")) < 0) {
					jQuery(this).parent().fadeOut();
				} else {
					jQuery(this).parent().show();
					count++;
				}
			});
		});

		jQuery('.list-icon ul li a',Popup_icon.htmlTag.wrapper).off('click').on('click',function(){
			var icon = jQuery(this).attr('title');
			Popup_icon.vars.current_icon = icon;
			Popup_icon.setPreview();
		});


		jQuery(Popup_icon.htmlTag.btnSave,Popup_icon.htmlTag.wrapper).off('click').on('click',function(){
			tb_remove();
			if (Popup_icon.vars.obj_Call != null && Popup_icon.vars.obj_Call != undefined) {
				Popup_icon.vars.obj_Call.val(Popup_icon.vars.current_icon);
				Popup_icon.vars.obj_Call.trigger('change');
			}
		});

		Popup_icon.setPreview();

		if (Popup_icon.vars.current_icon != '') {
			var obj_icon_current = jQuery('.list-icon ul li a[title="'+Popup_icon.vars.current_icon+ '"]',Popup_icon.htmlTag.wrapper);
			if (obj_icon_current.length > 0){
				obj_icon_current.addClass('active');
				setTimeout(function(){
					var scrollTop =obj_icon_current.offset().top - jQuery('.list-icon',Popup_icon.htmlTag.wrapper).offset().top;
					jQuery('.list-icon',Popup_icon.htmlTag.wrapper).animate({scrollTop : scrollTop},1000);
				},500);

			}
		}

	},
	setPreview : function() {
		jQuery('.list-icon ul li a',Popup_icon.htmlTag.wrapper).removeClass('active');
		if (Popup_icon.vars.current_icon != '') {
			jQuery(Popup_icon.htmlTag.iconPreview + ' i',Popup_icon.htmlTag.wrapper).attr('class', Popup_icon.vars.current_icon);
			jQuery(Popup_icon.htmlTag.iconPreview,Popup_icon.htmlTag.wrapper).prev('span').text(Popup_icon.vars.current_icon);

		}
	}
};
jQuery(document).ready(function(){
	setTimeout(function() {
		jQuery(document).on('click','.browse-icon',function(){
			var text_box = jQuery(this).prev('input');
			Popup_icon.init(text_box);
		});

		jQuery(document).on('change','.input-icon',function(){
			var icon = jQuery(this).val();
			if (icon != '') {
				jQuery('.icon-preview > i',jQuery(this).parent()).attr('class', icon);
			}
		});
	}, 1000);
});