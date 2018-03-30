<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/* Roles array ready for options */
global $wp_roles;
$tt_roles = array();
foreach ($wp_roles->roles as $key=>$value){
$tt_roles[$key] = $value['name']; }
//$tt_roles_tmp = array('nope' => __("No one","woffice")) + $tt_roles;
$tt_roles_tmp = $tt_roles;

if (function_exists('bp_is_active') && bp_is_active( 'xprofile' )) {
	
	$fields_options = array();
	
	// We fetch all the Buddypress fields : 
	global $wpdb;
	// We check for multisite : 
    if (is_multisite() && is_main_site()) {
	    $table_name = $wpdb->base_prefix .'bp_xprofile_fields';
    } else {
    	$table_name = $wpdb->prefix .'bp_xprofile_fields';
    }
            
	$sqlStr = "SELECT name FROM ".$table_name;
	$fields = $wpdb->get_results($sqlStr);
	//fw_print($fields);
	if(count($fields) > 0) {
	
		foreach ($fields as $field) {
			$field_name = $field->name;
			
			$fields_options["buddypress_".$field_name] = array(
				'type' => 'group',
				'title' => $field_name,
				'options' => array(
					'buddypress_'.$field_name.'_display' => array(
						'type'  => 'checkbox',
						'label' => __('Show','woffice'). ' ' .$field_name. '?',
						'value' => false,
						'desc' => __('If checked the field will be displayed on the members page.','woffice'),
					),
					'buddypress_'.$field_name.'_icon' => array(
						'type'  => 'icon',
						'value' => null,
						'label' => __('Field\'s icon','woffice'),
					)
				)
			);
		}	
	
	}
} 
else {
	$fields_options = array();
}

array_unshift($fields_options, array('buddypress_wordpress_email' => array(
    'type' => 'group',
    'title' => 'wordpress_email',
    'options' => array(
        'buddypress_wordpress_email_display' => array(
            'type'  => 'checkbox',
            'label' => __('Show the WordPress email','woffice'),
            'value' => false,
            'desc' => __('If checked the standard WordPress email (the email used to login) will be displayed on the members page.','woffice'),
        ),
        'buddypress_wordpress_email_icon' => array(
            'type'  => 'icon',
            'value' => null,
            'label' => __('Field\'s icon','woffice'),
        )
    )
    )
));

$options = array(
	'buddypress' => array(
		'title'   => __( 'Buddypress', 'woffice' ),
		'type'    => 'tab',
		'options' => array(
			'buddy-box' => array(
				'title'   => __( 'Main options', 'woffice' ),
				'type'    => 'box',
				'options' => array(
					'buddy_new_roles' => array(
						'label' => __('New Member Types', 'woffice'),
					    'type'  => 'html',
						'html'  => __('This option is not longer available within Woffice Theme Settings, now you need to use this external plugin to manage user roles: ', 'woffice'). '<a href="https://wordpress.org/plugins/user-role-editor/" target="_blank">User Role Editor</a>.',
					),
					'buddy_calendar'    => array(
						'label' => __( 'Personal Calendar', 'woffice' ),
						'desc'  => __( 'Show the personal calendar tab on user\'s profile.', 'woffice' ),
						'type'         => 'switch',
						'right-choice' => array(
							'value' => 'show',
							'label' => __( 'Show', 'woffice' )
						),
						'left-choice'  => array(
							'value' => 'hide',
							'label' => __( 'Hide', 'woffice' )
						),
						'value'        => 'hide',
					),
					'buddy_notes'    => array(
						'label' => __( 'Personal Note', 'woffice' ),
						'desc'  => __( 'Show the personal note tab on user\'s profile.', 'woffice' ),
						'type'         => 'switch',
						'right-choice' => array(
							'value' => 'show',
							'label' => __( 'Show', 'woffice' )
						),
						'left-choice'  => array(
							'value' => 'hide',
							'label' => __( 'Hide', 'woffice' )
						),
						'value'        => 'hide',
					),
					'buddy_directory_name'    => array(
						'label' => __( 'User member title', 'woffice' ),
						'desc'  => __( 'This is what will be displayed for each user in the members directory.', 'woffice' ),
						'type'         => 'switch',
						'right-choice' => array(
							'value' => 'name',
							'label' => __( 'First Name', 'woffice' )
						),
						'left-choice'  => array(
							'value' => 'username',
							'label' => __( 'Username', 'woffice' )
						),
						'value'        => 'username',
					),
					'buddy_filter'    => array(
						'label' => __( 'Members filter', 'woffice' ),
						'desc'  => __( 'Show the dropdown filter on the Buddypress members directory.', 'woffice' ),
						'type'         => 'switch',
						'right-choice' => array(
							'value' => 'show',
							'label' => __( 'Show', 'woffice' )
						),
						'left-choice'  => array(
							'value' => 'hide',
							'label' => __( 'Hide', 'woffice' )
						),
						'value'        => 'show',
					),
					'buddy_members_layout'    => array(
						'label' => __( 'Members layout', 'woffice' ),
						'desc'  => __( 'Layout of your members directory.', 'woffice' ),
						'type'         => 'switch',
						'right-choice' => array(
							'value' => 'cards',
							'label' => __( 'Cards', 'woffice' )
						),
						'left-choice'  => array(
							'value' => 'table',
							'label' => __( 'Table', 'woffice' )
						),
						'value'        => 'cards',
					),
					'buddy_excluded_directory'    => array(
						'label' => __( 'Members Excluded (Directory)', 'woffice' ),
						'desc'  => __( 'Do you want to exclude a role from the Members directory, they won\'t be displayed on the page.', 'woffice' ),
						'type'         => 'multi-select',
						'choices'      => $tt_roles_tmp
					),
				),
			),
			'buddy_fields' => array(
				'title'   => __( 'Display fields in Buddypress members directory', 'woffice' ),
				'type'  => 'box',
				'options' => $fields_options
			),
		)
	)
);