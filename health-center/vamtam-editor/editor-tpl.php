<div id="wpv-editor-shortcodes" class="clearfix">
	<ul>
		<?php echo $this->complex_elements() ?>
	</ul>
</div>

<div class="metabox-editor-content">
	<div id="visual_editor_edit_form"></div>
	<div id="visual_editor_content" class="wpv_main_sortable inner-sortable main_wrapper clearfix"></div>

	<div class="wpv-config-icons-selector hidden">
		<input type="search" placeholder="<?php esc_attr_e('Filter icons', 'health-center') ?>" class="icons-filter"/>
		<div class="icons-wrapper spinner">
			<input type="radio" value="" checked="checked"/>
		</div>
	</div>
</div>

<?php $status = get_post_meta($post->ID, '_wpv_ed_js_status', true) ?>
<input type="hidden" id="wpv_ed_js_status" name="_wpv_ed_js_status" value="<?php echo empty($status) ? 'true' : $status ?>" />
