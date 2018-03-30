<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<input type="hidden" name="tmm_meta_saving" value="1" />
<?php wp_enqueue_style('tmm_theme_admin_gallery_css', TMM_THEME_URI . '/admin/css/gallery.css'); ?>
<?php
$gallery_types = array('standard_gallery' => 'Standard Gallery',
                       'accordion_grid_gallery' => 'Accordion Grid Gallery'
                        );
$gallery_type = 'standard_gallery';
?>
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
									<strong><?php echo esc_html($post_type_name); ?></strong>
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
									<strong><?php echo esc_html($post_type_name); ?></strong>
									<span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">
										<?php esc_html_e('Set up a video for this post', 'diplomat'); ?>
									</span>
								</label>
							</th>
							<td>                                                           
                                
								<input type="text" style="width:80%; margin-right: 0; float:left;" size="30" value="<?php echo (isset($post_type_values[$post_pod_type])) ? esc_attr($post_type_values[$post_pod_type]) : '' ?>" class="" name="post_type_values[<?php echo esc_attr($post_pod_type) ?>]">
                                &nbsp;                                
                                <a class="button button_upload_video" href="#" style="float: left; margin-left: 9px;"><?php esc_html_e('Browse', 'diplomat'); ?></a>
							</td>
						</tr>
						<tr>
							<th style="width:25%">
								<label for="post_type_conrainer">
									<span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">
										<?php esc_html_e('Cover Image for Self Hosted Video', 'diplomat'); ?>
									</span>
								</label>
							</th>
							<td>
								<div>
									<input type="text" style="width:80%; margin-right: 0; float:left;" size="30" value="<?php echo (isset($post_type_values['video_cover_image'])) ? esc_attr($post_type_values['video_cover_image']) : '' ?>" name="post_type_values[video_cover_image]">
									&nbsp;
									<a class="button button_upload" href="#" style="float: left; margin-left: 9px;"><?php esc_html_e('Browse', 'diplomat'); ?></a>
								</div>
								<br>
								<label class="selectit">
									<input type="hidden" value="<?php echo isset($post_type_values['video_cover_image_on_mobiles']) ? (int) $post_type_values['video_cover_image_on_mobiles'] : 1; ?>" name="post_type_values[video_cover_image_on_mobiles]">
									<?php $is_checked = isset($post_type_values['video_cover_image_on_mobiles']) ? intval($post_type_values['video_cover_image_on_mobiles']) : 1; ?>
									<input type="checkbox" class="option_checkbox" value="1" <?php checked($is_checked, 1); ?>>
									<?php _e('Show Cover Image Only on Mobiles', 'diplomat'); ?>
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
									<strong><?php esc_html($post_type_name) ?></strong>
									<span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">
										<?php esc_html_e('Set up an audio for this post', 'diplomat'); ?>
									</span>
								</label>
							</th>
							<td>
								<input type="text" style="width:80%; margin-right: 0; float:left;" size="30" value="<?php echo (isset($post_type_values[$post_pod_type])) ? esc_attr($post_type_values[$post_pod_type]) : '' ?>" class="" name="post_type_values[<?php echo esc_attr($post_pod_type) ?>]">
								&nbsp;<a class="button button_upload_audio image-button" href="#" style="float: left; margin-left: 9px;"><?php esc_html_e('Browse', 'diplomat'); ?></a>
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
									<strong><?php echo esc_html($post_type_name); ?></strong>
									<span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">
										<?php esc_html_e('Place here a link for this post like http://site.com/', 'diplomat'); ?>
									</span>
								</label>
							</th>
							<td>
								<input type="text" style="width:90%; margin-right: 0; float:left;" size="30" value="<?php echo esc_attr(@$post_type_values[$post_pod_type]) ?>" class="" name="post_type_values[<?php echo esc_attr($post_pod_type) ?>]">
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
									<strong><?php echo esc_html($post_type_name); ?></strong>
									<span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">
										<?php esc_html_e('Create a quote for this post', 'diplomat'); ?>
									</span>
								</label>
							</th>
							<td>
								<textarea name="post_type_values[<?php echo esc_attr($post_pod_type) ?>]" style="width:95%; margin-right: 20px; height:200px;"><?php echo (isset($post_type_values[$post_pod_type])) ? esc_html($post_type_values[$post_pod_type]) : '' ?></textarea>
							</td>
						</tr>
                        
						<tr>
							<th style="width:25%">
								<label for="post_type_conrainer">
									<strong><?php esc_html_e('Author', 'diplomat'); ?></strong>
									
								</label>
							</th>
							<td>
								<input type="text" name="post_type_values[<?php echo esc_attr($post_pod_type) ?>_author]" style="width:95%; margin-right: 20px;" value="<?php echo (isset($post_type_values[$post_pod_type.'_author'])) ? esc_attr($post_type_values[$post_pod_type.'_author']) : '' ?>">
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
									<strong><?php echo esc_html($post_type_name); ?></strong>
									<span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">
										<?php esc_html_e('Create your gallery for post', 'diplomat'); ?>
									</span>
								</label>
							</th>
							<td>
								<p><a href="#" class="add-images-to-page button"><?php esc_html_e('Add Images', 'diplomat'); ?></a></p>

								<ul id="post_pod_gallery">

									<?php if (!empty($post_type_values[$post_pod_type]) AND is_array($post_type_values[$post_pod_type])): ?>
										<?php foreach ($post_type_values[$post_pod_type] as $imgurl) : ?>
												<?php echo TMM::draw_html('page/draw_post_podtype_gallery_image', array('imgurl' => $imgurl, 'gallery_type'=>$gallery_type)); ?>
										<?php endforeach; ?>
									<?php endif; ?>
								</ul>

								<div class="clear"></div>
							</td>
						</tr>
						<tr>
							<th><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">
									<?php esc_html_e('Gallery options', 'diplomat'); ?>
								</span>
							</th>
							<td>
								<label for="post_type_values[<?php echo esc_attr($post_pod_type) ?>_autoplay]"><?php esc_html_e('Auto Play', 'diplomat') ?></label>
								<input type="checkbox" name="post_type_values[<?php echo esc_attr($post_pod_type) ?>_autoplay]" id="post_type_values[<?php echo esc_attr($post_pod_type) ?>_autoplay]" <?php echo (isset($post_type_values[$post_pod_type.'_autoplay'])&&($post_type_values[$post_pod_type.'_autoplay'])) ? 'checked' : 'not'; ?>>

								<label for="post_type_values[<?php echo esc_attr($post_pod_type) ?>_speed]" style="margin-left: 40px;"><?php esc_html_e('Speed', 'diplomat') ?></label>
								<input type="text" id="post_type_values[<?php echo esc_attr($post_pod_type) ?>_speed]" name="post_type_values[<?php echo esc_attr($post_pod_type) ?>_speed]" value="<?php echo (isset($post_type_values[$post_pod_type.'_speed'])) ? esc_attr($post_type_values[$post_pod_type.'_speed']) : '5000' ?>">
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

		jQuery('[name=post_format]').click(function(){
			var post_pod_type=jQuery(this).val();
			jQuery('.post_type_conrainer').hide(400);
			jQuery('.post_type_'+post_pod_type+'_conrainer').show(400);
		});

		jQuery("#post_pod_gallery").sortable();
		jQuery('.add-images-to-page').life('click', function() {
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
            
		jQuery('[name=gallery_type]').change(function(){
			var $this = jQuery(this);
			var gallery_items = jQuery('#post_pod_gallery');
			var data = {
				action: "change_post_gallery_type",
				gallery_type: $this.val(),
				post_id:<?php echo $post_id ?>
			}
			jQuery.post(ajaxurl, data, function(response){
				var table = $this.parent().parent().parent();
				$this.parent().parent().next().remove();
				table.append(response);
			});
		});

		jQuery(".delete_gallery_item").life('click',function(){
			jQuery(this).parent().remove();
			return false;
		});
	});
	
	function add_meta_slide_items(img_urls, index){
		show_info_popup(tmm_l10n.loading);

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
