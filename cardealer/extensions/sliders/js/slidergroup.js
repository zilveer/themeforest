var TMM_ADMIN_SLIDES = function() {

	var self = {
		html_buffer: null,
		init: function() {
			try {
				jQuery("#tmm_slide_group").sortable();
			} catch (e) {

			}

			self.html_buffer = jQuery("#html_buffer");

			jQuery('.js_add_slide').life('click', function()
			{
				window.send_to_editor = function(html)
				{
					self.insert_html_in_buffer(html);
					var images = jQuery('#html_buffer').find('a');
					var img_urls = [];
					jQuery.each(images, function(index, value) {
						img_urls[index] = jQuery(value).attr('href');
					});

					self.add_meta_slide_items(img_urls, 0);
					self.insert_html_in_buffer("");
				
				};
				
				wp.media.editor.open();

				return false;
			});


			jQuery('.js_edit_slide').life('click', function()
			{
				var slide_id = jQuery(this).data('slide-id');

				window.send_to_editor = function(html)
				{
					self.insert_html_in_buffer(html);
					var imgurl = jQuery('#html_buffer').find('a').eq(0).attr('href');
					show_static_info_popup(lang_loading);
					var data = {
						action: "get_resized_image_url",
						imgurl: imgurl,
						alias: '180*130'
					};
					jQuery.post(ajaxurl, data, function(response) {
						var time = get_time_miliseconds();
						jQuery("#slide_item_" + slide_id + " .slide-thumb img").attr('src', response + "?t=" + time);
						jQuery("#slide_item_" + slide_id + " .slide-thumb input[type=hidden]").val(imgurl);
						hide_static_info_popup();
					});

					self.insert_html_in_buffer("");
				};
                
                wp.media.editor.open();

				return false;
			});

			jQuery(".js_delete_slide").life('click', function() {
				var self_button = this;
				jQuery(self_button).parents('div.slide-item').eq(0).hide(333, function() {
					jQuery(self_button).parents('div.slide-item').eq(0).remove();
				})

				return false;
			});

			jQuery("[name=selected_slider]").life('change', function() {
				var value = jQuery(this).val();
				if (value == "0") {
					jQuery("[name=slider_group]").hide();
				} else {
					jQuery("[name=slider_group]").show();
				}

				return false;
			});
			
			// 
			jQuery('div.attr_wrapper_options').addClass('hide');
			jQuery('.slide-options-dialog').on('click', 'h3.attr_title', function() {
				jQuery(this)
						.addClass('active')
						.siblings('h3.attr_title')
							.removeClass('active');
				jQuery(this)
					.next()
						.slideDown('300')
						.siblings('div.attr_wrapper_options')
							.slideUp('300');
			});

		},
		add_meta_slide_items: function(img_urls, index) {
			show_info_popup(lang_loading);
			var data = {
				action: "add_meta_slide_item",
				imgurl: img_urls[index]
			};
			jQuery.post(ajaxurl, data, function(response) {
				jQuery("#tmm_slide_group").append(response);
				if (index < (img_urls.length - 1)) {
					self.add_meta_slide_items(img_urls, index + 1);
				}

				if(index == img_urls.length-1){//for one calling on the end
					colorizator();
				}

			});
		},
		insert_html_in_buffer: function(html) {
			jQuery(self.html_buffer).html(html);
		},
		get_html_from_buffer: function() {
			return jQuery(self.html_buffer).html();
		}
	}

	return self;
}


var tmm_admin_slides = new TMM_ADMIN_SLIDES();
jQuery(document).ready(function() {
	tmm_admin_slides.init();
});