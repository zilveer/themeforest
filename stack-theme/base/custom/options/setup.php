<?php 
	
// Option
$options = array(
	
	// Background
	array(
		'title' 	=> 'Setup',
		'options' 	=> array(
			
			array(
				'type' 			=> 'import_content',
				'id' 			=> 'enable_responsive',
				'title' 		=> __('Import Demo Content', 'theme_admin'),
				'description' 	=> __('loading demo data will overwrite your current widgets/sidebars configuration', 'theme_admin')
			),
			
					
		)
	),
	
);

$config = array(
	'title'			=> __('Setup', 'theme_admin'),
	'group_id' 		=> 'setup',
	'active_first' 	=> true
);
	
	
return array( 'options' => $options, 'config' => $config );

?>