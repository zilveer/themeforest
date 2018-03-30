<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<input type="hidden" name="tmm_meta_saving" value="1" />
<ul>
	<?php foreach ($post_pod_types as $post_pod_type => $post_type_name): ?>

		<li style="display: <?php echo ($current_post_pod_type == $post_pod_type ? 'block' : 'none') ?>"  class="post_type_<?php echo $post_pod_type ?>_conrainer post_type_conrainer">

			<?php
			switch ($post_pod_type) {
				case 'default':
					?>
					<table class="form-table">
						<tr>
							<th style="width:25%">
								<label for="post_type_conrainer">
									<strong><?php echo $post_type_name ?></strong>
								</label>
							</th>
						</tr>
					</table>
					<?php
					break;
				case 'video':
					?>
					<table class="form-table">
						<tr>
							<th style="width:25%">
								<label for="post_type_conrainer">
									<strong><?php echo esc_html($post_type_name) ?></strong>
									<span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">
										<?php _e('Set up a video for this post', 'cardealer'); ?>
									</span>
								</label>
							</th>
							<td>

								<input type="text" style="width:80%; margin-right: 0; float:left;" size="30" value="<?php echo (isset($post_type_values[$post_pod_type])) ? $post_type_values[$post_pod_type] : '' ?>" class="" name="post_type_values[<?php echo esc_attr($post_pod_type) ?>]">
								&nbsp;
								<a class="button button_upload_video" href="#" style="float: left; margin-left: 9px;"><?php _e('Browse', 'cardealer'); ?></a>
							</td>
						</tr>
						<tr>
							<th style="width:25%">
								<label for="post_type_conrainer">
									<span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">
										<?php esc_html_e('Cover Image for Self Hosted Video', 'cardealer'); ?>
									</span>
								</label>
							</th>
							<td>
								<div>
									<input type="text" style="width:80%; margin-right: 0; float:left;" size="30" value="<?php echo (isset($post_type_values['video_cover_image'])) ? esc_attr($post_type_values['video_cover_image']) : '' ?>" name="post_type_values[video_cover_image]">
									&nbsp;
									<a class="button button_upload" href="#" style="float: left; margin-left: 9px;"><?php esc_html_e('Browse', 'cardealer'); ?></a>
								</div>
								<br>
								<label class="selectit">
									<input type="hidden" value="<?php echo isset($post_type_values['video_cover_image_on_mobiles']) ? (int) $post_type_values['video_cover_image_on_mobiles'] : 1; ?>" name="post_type_values[video_cover_image_on_mobiles]">
									<?php $is_checked = isset($post_type_values['video_cover_image_on_mobiles']) ? intval($post_type_values['video_cover_image_on_mobiles']) : 1; ?>
									<input type="checkbox" class="option_checkbox" value="1" <?php checked($is_checked, 1); ?>>
									<?php _e('Show Cover Image Only on Mobiles', 'cardealer'); ?>
								</label>
							</td>
						</tr>
					</table>
					<?php
					break;
				case 'audio':
					?>
					<table class="form-table">
						<tr>
							<th style="width:25%">
								<label for="post_type_conrainer">
									<strong><?php echo $post_type_name ?></strong>
									<span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">
										<?php _e('Set up an audio for this post', 'cardealer'); ?>
									</span>
								</label>
							</th>
							<td>
								<input type="text" style="width:90%; margin-right: 0; float:left;" size="30" value="<?php echo @$post_type_values[$post_pod_type] ?>" class="" name="post_type_values[<?php echo $post_pod_type ?>]">
								&nbsp;<a class="button button_upload" href="#" style="float: left; margin-left: 9px;"><?php _e('Browse', 'cardealer'); ?></a>
							</td>
						</tr>
					</table>
					<?php
					break;

				case 'link':
					?>
					<table class="form-table">
						<tr>
							<th style="width:25%">
								<label for="post_type_conrainer">
									<strong><?php echo $post_type_name ?></strong>
									<span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">
										<?php _e('Place here a link for this post like http://site.com/', 'cardealer'); ?>
									</span>
								</label>
							</th>
							<td>
								<input type="text" style="width:90%; margin-right: 0; float:left;" size="30" value="<?php echo @$post_type_values[$post_pod_type] ?>" class="" name="post_type_values[<?php echo $post_pod_type ?>]">
							</td>
						</tr>
					</table>
					<?php
					break;

				case 'quote':
					?>
					<table class="form-table">
						<tr>
							<th style="width:25%">
								<label for="post_type_conrainer">
									<strong><?php echo $post_type_name ?></strong>
									<span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">
										<?php _e('Create a quote for this post', 'cardealer'); ?>
									</span>
								</label>
							</th>
							<td>
								<textarea name="post_type_values[<?php echo $post_pod_type ?>]" style="width:95%; margin-right: 20px; height:200px;"><?php echo @$post_type_values[$post_pod_type] ?></textarea>
							</td>
						</tr>
					</table>
					<?php
					break;

				case 'gallery':
					?>
					<table class="form-table">
						<tr>
							<th style="width:25%">
								<label for="post_type_conrainer">
									<strong><?php echo $post_type_name ?></strong>
									<span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">
										<?php _e('Create your gallery for post', 'cardealer'); ?>
									</span>
								</label>
								<p><a href="#" style="float:left;" class="add-images-to-page button"><?php _e('Add Images', 'cardealer'); ?></a></p>
							</th>
							<td>
								<ul id="post_pod_gallery">
									<?php if (!empty($post_type_values[$post_pod_type]) AND is_array($post_type_values[$post_pod_type])): ?>
										<?php foreach ($post_type_values[$post_pod_type] as $imgurl) : ?>
											<?php echo TMM::draw_html('page/draw_post_podtype_gallery_image', array('imgurl' => $imgurl)); ?>
										<?php endforeach; ?>
									<?php endif; ?>
								</ul>
								<div class="clear"></div>
							</td>
						</tr>
					</table>
					<?php
					break;

				default:
					break;
			} ?>
		</li>

	<?php endforeach; ?>
</ul>

<script type="text/javascript">
	jQuery(function() {
		jQuery("#post_pod_gallery").sortable();
		jQuery('.add-images-to-page').click(function() {
			
			window.send_to_editor = function(html)
			{
				insert_html_in_buffer(html);
				var images = jQuery(jQuery("#html_buffer")).find('a');
				var img_urls = new Array();
				jQuery.each(images, function(index, value) {
					img_urls[index] = jQuery(value).attr('href');
				});

				add_meta_slide_items(img_urls, 0);
				insert_html_in_buffer("");
			};
			wp.media.editor.open(null);
			return false;
			
        });
		
		jQuery(".delete_gallery_item").life('click',function(){
			jQuery(this).parent().remove();
			return false;
		});

	});
	
	function add_meta_slide_items(img_urls, index) {
		show_info_popup(lang_loading);
		var data = {
			action: "add_post_podtype_gallery_image",
			imgurl: img_urls[index]
		};
		jQuery.post(ajaxurl, data, function(response) {
			jQuery("#post_pod_gallery").append(response);
			if (index < (img_urls.length - 1)) {
				add_meta_slide_items(img_urls, index + 1);
			}
		});

		jQuery("#post_pod_gallery").sortable();
		return false;
	}

</script>
