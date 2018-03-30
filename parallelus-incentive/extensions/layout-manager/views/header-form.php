<?php global $layout_manager_admin; ?>
<?php if(!empty($layout_manager_admin->navigation) && !in_array($layout_manager_admin->navigation, array('add-layout', 'edit-layout'))): ?>
<table class="form-table">
	<tbody>
		<tr class="">
			<th scope="row" valign="top">
				<?php _e('Title', 'framework') ?>
				<p class="description required"><?php _e('Required', 'framework') ?></p>
			</th>
			<td>
				<input class="input-text " type="text" name="header-title" id="header-title" value="<?php echo isset($header['title']) ? $header['title'] : ''; ?>">
			</td>
		</tr>
	</tbody>
</table>
<?php endif; ?>
<?php 	
	global $layouts_manager, $layout_manager_admin, $libraries;
	if(isset($layouts_manager->layouts_manager_options['settings']['headers'])){
		$form_builder = $libraries['FormsBuilder'];

		$form_json = isset($layouts_manager->layouts_manager_options['headers-options']) ? 
			$layouts_manager->layouts_manager_options['headers-options'] : '';

		do_action("before_header_layout_fields");
		if($form_json != ''){
			$form_settings = json_decode(json_encode($form_json));			
			
			$layout_manager_admin->elements = $form_settings->elements;
			$layout_manager_admin->builder_page = $form_settings;
			
			if(isset($header)){
				$form_settings->settings->alias = $header['alias'];
				$layout_manager_admin->data = $form_builder->get_custom_options_vals('layout_header_'.$header['alias'], true);
			}
			$custom_alias = isset($header['alias']) ? $header['alias'] : '[First Save Header]';
			$form_builder->section = 'header';
			$form_builder->render_form($form_settings, false, $layouts_manager, $layout_manager_admin, 'layout_header_'.$custom_alias); // render form in one function call
		}
		do_action("after_header_layout_fields");
	}
?>