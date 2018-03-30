<?php
$unique_id = isset($index) ? $index : uniqid();
$editor_id = 'slide_content_'.$unique_id;
?>

<div class="slide-item" id="slide_item_<?php echo $unique_id ?>">

	<div class="slide-dragger"></div>

    <div class="slide-thumb">
		<img src="<?php echo esc_url(TMM_Helper::resize_image($group['imgurl'], '230*184')); ?>" alt="slide" />
		<input type="hidden" class='post_thumb' name="post_slides_group[<?php echo $unique_id ?>][imgurl]" value="<?php echo esc_attr($group['imgurl']); ?>" />
		<a href="#" class="button js_edit_slide" data-slide-id="<?php echo $unique_id ?>"><?php esc_html_e('Edit Image', 'diplomat'); ?></a>
	</div>

    <a href="#" class="js_delete_slide" slide-id="<?php echo esc_attr($unique_id); ?>" title="<?php esc_attr_e('Delete Slide', 'diplomat'); ?>"><?php esc_html_e('Delete Slide', 'diplomat'); ?></a>

	<?php if (!empty(TMM_Slider::$slider_options)): ?>

		<div id="slide_options_<?php echo $unique_id ?>" class="slide-options-dialog" data-editorid="<?php echo esc_attr($editor_id); ?>" dialog-id="<?php echo esc_attr($unique_id); ?>">
			<?php foreach (TMM_Slider::$slider_options as $slider_key => $slider){ ?>
			
			<?php
				if ($slider_key == 'layerslider') {
					continue;
				}
				?>

				<h3 class="attr_title"><?php echo esc_html($slider['name']); esc_html_e(' Item', 'diplomat'); ?></h3>

				<div class="attr_wrapper_options">
					
					<?php
                        $content = (isset($group['slide_content'])) ? $group['slide_content'] :'';
                        $settings = array(
                            'default_editor' => 'tinymce',
                            'media_buttons' => true,
                            'textarea_name' => 'post_slides_group[' . $unique_id .'][slide_content]'
                        );
						
                        wp_editor( $content, $editor_id, $settings);
							?>

						<div class="clear"></div>
				</div>
			<?php } ?>
		</div>
				
		<div class="clear"></div>
	<?php endif; ?>
		
</div>
