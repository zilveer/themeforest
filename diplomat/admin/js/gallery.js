var TMM_GALLERY_ADMIN = function() {

	var self = {
		html_buffer: "",
		init: function() {
			jQuery('body').append('<div id="inpost_gallery_html_buffer" style="display: none;"></div>');
			jQuery('body').append('<div id="inpost_gallery_info_popup" style="display: none;"></div>');

			self.html_buffer = jQuery("#inpost_gallery_html_buffer");


			jQuery("#gallery_item_list").sortable({
				stop: function() {
				//self.recount_slides();
				}
			});
			//*****
			jQuery('.js_inpost_gallery_add_slide').life('click', function(event)
			{
				window.send_to_editor = function(html)
				{
					self.insert_html_in_buffer(html);
					var images = jQuery(self.html_buffer).find('a');
					var img_urls = new Array();
					jQuery.each(images, function(index, value) {
						img_urls[index] = jQuery(value).attr('href');
					});

					self.add_meta_slide_items(img_urls, 0);
					self.insert_html_in_buffer("");
				//tb_remove();
				};
				//tb_show('', 'media-upload.php?post_id=0&type=image&tab=library&TB_iframe=true');
				wp.media.editor.open(null);

				return false;
			});

			jQuery(".delete_gallery_item").life('click', function() {
				var self_button = this;
				jQuery(self_button).parents('li').eq(0).hide(333, function() {
					jQuery(self_button).parents('li').eq(0).remove();
				});

				return false;
			});

			jQuery(".js_edit_gallery_item").life('click', function() {
				var unique_id=jQuery(this).data("unique-id");
				var title=jQuery(this).parent().find(".js_edit_gallery_item_title").val();			
				var description=jQuery(this).parent().find(".js_edit_gallery_item_description").val();			
				jQuery("[name='tmm_gallery[" + unique_id + "][title]']").val(title);
				jQuery("[name='tmm_gallery[" + unique_id + "][description]']").val(description);
				tb_remove();
				return true;
			});

		},
		add_meta_slide_items: function(img_urls, index) {
			show_info_popup(tmm_l10n.loading);
			var data = {
				action: "add_gallery_item",
				imgurl: img_urls[index]
			};
			jQuery.post(ajaxurl, data, function(response) {
				jQuery("#gallery_item_list").append(response);
				if (index < (img_urls.length - 1)) {
					self.add_meta_slide_items(img_urls, index + 1);
				}
			});
		},
		insert_html_in_buffer: function(html) {
			jQuery(self.html_buffer).html(html);
		}
	};

	return self;
};


var tmm_admin_gallery = new TMM_GALLERY_ADMIN();
jQuery(document).ready(function() {
	tmm_admin_gallery.init();
});

