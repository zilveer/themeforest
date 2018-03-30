<?php 

/**
	CF7 support
**/
if( in_array('contact-form-7/wp-contact-form-7.php', get_option('active_plugins')) ){ //first check if plugin is installed
	
	$args = array (
		'post_type' => 'wpcf7_contact_form',
		'posts_per_page' => -1,
		'orderby' => 'menu_order',
		'order' => 'ASC',
	);
	$contact_forms = get_posts($args);

	$forms = array();
	if(is_array($contact_forms)){
		foreach ($contact_forms as $cform) {
			$forms[$cform->ID] = $cform->post_title;
		}
	}

	$tcvpb_elements['contact-form-7'] = array(
		'name' => esc_html__('Contact form 7', 'ABdev_aeron' ),
		'description' => esc_html__('Contact Form 7', 'ABdev_aeron'),
		'type' => 'block',
		'icon' => 'pi-contact-form-7',
		'category' =>  esc_html__('Content', 'ABdev_aeron'),
		'third_party' => 1, 
		'attributes' => array(
			'id' => array(
				'description' => esc_html__('Select Form', 'ABdev_aeron'),
				'default' => '',
				'type' => 'select',
				'values' => $forms,
			),
		),
	);
}

