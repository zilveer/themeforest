<?php 
	global $layouts_manager, $libraries;

	$form_builder = $libraries['FormsBuilder'];
	$settings = $layouts_manager->layouts_manager_options['settings'];
	$option = $_REQUEST['option'];
	$form_json = array();

	switch ($option) {
		case 'headers':{
			$form_json = isset($layouts_manager->layouts_manager_options['headers-options']) ? 
				$layouts_manager->layouts_manager_options['headers-options'] : '';
		} break;
		
		case 'footers':{
			$form_json = isset($layouts_manager->layouts_manager_options['footers-options']) ? 
				$layouts_manager->layouts_manager_options['footers-options'] : '';
		} break;

		case 'other-options':{
			$form_json = isset($layouts_manager->layouts_manager_options['other-options']) ? 
				$layouts_manager->layouts_manager_options['other-options'] : '';
		} break;
	}
	
	if(isset($_REQUEST['option']) && in_array($_REQUEST['option'], array('headers', 'footers', 'other-options'))){
		$option = str_replace('-', '_', $_REQUEST['option']);
		$form_builder->save_action = 'save_options_'.$option;
		$form_builder->default_form_settings['page']['settings']['alias'] = $option;
	}

	$form_builder->resolutions = array(
		'title' => false,
		'alias' => false,
		'settings' => false,
		'options-tabs' => false,
		'options-containers' => true,
		'options-fields' => true,

	);		

	if(!empty($form_json)){
		$form = $form_json;

		if(in_array($_REQUEST['option'], array('headers', 'footers', 'other-options'))){
			$form['settings']['alias'] = $option;
		}
		
		$options = array(
			'new_page_id' => time(),
			'page' => $form,
			'settings' => array(
				'tabs' => true,
				'containers' => true,
				'fields' => true,
				'page_settings' => true
			),
			'page_json' => addslashes( json_encode( $form ) )
		);
		$form_builder->form_builder($options);
	}
	else{
		$form_builder->form_builder();		
	}

?>