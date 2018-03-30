(function($){

var TMM_ADMIN_SLIDES = function() {

	var self = {
		html_buffer: null,
		init: function() {
			try {
				jQuery("#tmm_posts_slide_group").sortable({
					axis: 'y',
					cursor: 'move',
					handle: '.slide-dragger',
					start: function( event, ui ) {
						var id = ui.item.find('.slide-options-dialog').data('editorid');
						ui.item.find('.attr_title').removeClass('active').next().hide();
						tinymce.execCommand('mceRemoveEditor', true, id);
					},
					stop: function( event, ui ) {
						var id = ui.item.find('.slide-options-dialog').data('editorid');
						tinymce.execCommand('mceAddEditor', true, id);
					}
				});
			} catch (e) {

			}

			self.html_buffer = jQuery("#html_buffer");

			changeSliderType(jQuery('.slider_type').val());

			jQuery('.slider_type').click(function(){
				var $this = jQuery(this),
					val = $this.val();
					changeSliderType(val);
			});

			jQuery('#tmm_posts_slide_group').sortable();

			function changeSliderType(val){
				var post_slides = jQuery('#post_slides'),
					sequence_slides = jQuery('#sequence_slides');

				switch (val){
					case 'post':
						post_slides.show(300);
						sequence_slides.hide();
						break;
					case 'sequence':
						post_slides.hide();
						sequence_slides.show(300);
						break;
				}
			}

			jQuery('.js_add_slide').life('click', function()
			{
				window.send_to_editor = function(html)
				{
					self.insert_html_in_buffer(html);
					var images = jQuery('#html_buffer').find('a');
					var img_urls = new Array();
					jQuery.each(images, function(index, value) {
						img_urls[index] = jQuery(value).attr('href');
					});

					self.add_meta_slide_items(img_urls, 0);
					self.insert_html_in_buffer("");
				}

				wp.media.editor.open();

				return false;
			});

			jQuery('.js_add_post_slide').life('click', function(){
				self.add_post_slide();
				return false;
			});

			jQuery('.js_edit_slide').life('click', function()
			{
				var slide_id = jQuery(this).data('slide-id');

				window.send_to_editor = function(html)
				{
					self.insert_html_in_buffer(html);
					var imgurl = jQuery('#html_buffer').find('a').eq(0).attr('href');
					show_static_info_popup(tmm_l10n.loading);
					var data = {
						action: "get_resized_image_url",
						imgurl: imgurl,
						alias: '230*184'
					};
					jQuery.post(ajaxurl, data, function(response) {
						var time = get_time_miliseconds();
						jQuery("#slide_item_" + slide_id + " .slide-thumb img").attr('src', response + "?t=" + time);
						jQuery("#slide_item_" + slide_id + " .slide-thumb input.post_thumb").val(imgurl);
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
				});
				return false;
			});

			jQuery('div.attr_wrapper_options').addClass('hide');

			jQuery('#tmm_posts_slide_group h3.attr_title').life('click', function() {
				var $this = $(this);

				if($this.hasClass('active')){
					$this.removeClass('active').next().slideUp('200');
				}else{
					var id = $this.parent().data('editorid');

					$('#tmm_posts_slide_group h3.attr_title').removeClass('active').next('.attr_wrapper_options').hide();
					$this.addClass('active');

					for (var i = 0; i < tinymce.editors.length; i++) {
						if (tinymce.editors[i].id == id) {
							tinymce.activeEditor = tinymce.editors[i];
						}
					}

					$this.next().slideDown('200');
				}

			});

			jQuery('.post_slider_item').life('click', function(){
				var $this = jQuery(this),
					icon = jQuery('<div class="media-modal-icon"></div>');
				if ($this.attr('class').indexOf('selected')==-1){
					$this.addClass('selected');
					$this.append(icon);
				}else{
					$this.removeClass('selected');
					$this.find('.media-modal-icon').remove();
				}

			});

		},
		add_post_slide: function(){
			var template_wrapper = $('#tmm_slider_add_post_slide'),
				template_html = template_wrapper.html();

			var popup_params = {
				content: template_html,
				title: tmm_l10n.title_slide_posts,
				popup_class: 'tmm-popup-post-slides',
				open: function() {

				},
				close:function(){

				},
				save: function() {
					var cur_popup = $('.tmm-popup-post-slides'),
						post_ids = '',
						selected_item = cur_popup.find('.post_slider_item.selected');
					selected_item.each(function(){
						var $this = $(this),
							val = $this.find('.post_id').val();
						post_ids = (post_ids!='') ? post_ids+'^'+val : post_ids+val;
					});

					var data = {
						action: "add_post_slide_item",
						posts: post_ids
					}
					jQuery.post(ajaxurl, data, function(response) {
						jQuery("#tmm_posts_slide_group").append(response);
					});

				}
			};
			$.tmm_popup(popup_params);
		},
		add_meta_slide_items: function(img_urls, index) {
			show_info_popup(tmm_l10n.loading);
			var data = {
				action: "add_meta_slide_item",
				imgurl: img_urls[index]
			};
			jQuery.post(ajaxurl, data, function(response) {
				//jQuery("#tmm_slide_group").append(response);
				jQuery("#tmm_posts_slide_group").append(response);
                jQuery('.attr_wrapper_options').hide();
				if (index < (img_urls.length - 1)) {
					self.add_meta_slide_items(img_urls, index + 1);
				}

				if (index == img_urls.length - 1) {//for one calling on the end
					colorizator();
				}

				var id = jQuery('textarea.wp-editor-area:last').attr('id');

				tinyMCE.execCommand('mceAddEditor', false, id);
				quicktags(id);
				QTags._buttonsInit();
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

})(jQuery);