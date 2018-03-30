<?php

return array(
	'icon'   => 'el el-group',
	'title'  => __( 'Team', 'BERG' ),
	'class'  => 'team_member_section',
	'fields' => array(
		array(
			'id'       => 'team_name',
			'type'     => 'text',
			'title'    => __( 'Team member name', 'BERG' ),
			'default' => ''
		),
		array(
			'id'       => 'team_pos',
			'type'     => 'text',
			'title'    => __( 'Team member position', 'BERG' ),
			'default' => ''
		),	
		array(
			'id'       => 'team_desc',
			'type'     => 'editor',
			'title'    => __( 'Team member description', 'BERG' ),
			'class'	   => 'team-desc-field',
			'args'   => array(
				'media_buttons' => false, 'tinymce' => array('toolbar'=> 'bold,italic,strikethrough,bullist,numlist,blockquote,hr,alignleft,aligncenter,alignright,link,unlink,wp_more,spellchecker,wp_fullscreen,wp_adv ', 'toolbar2' => 'formatselect,underline,alignjustify,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help,yopress')
			),
			'default' => ''
		),		
		array(
			'id' => 'team_member',
			'type' => 'team_member',
			'class'	   => 'team-add-field',
			// 'title' => __( '', 'BERG' ),
		),
		array(
			'id'   =>'berg_team_settings',
		    'title' => __('Team settings', 'BERG'),
		    'type' => 'divide'
		),
		array(
			'id' => 'berg_team_align',
			'title' => __('Text align', 'BERG'),
			'type' => 'select',
			'options' => array(
				'left' => __('Left', 'BERG'),
				'center' => __('Center', 'BERG'),
				'right' => __('Right', 'BERG'),
			),
			'default'  => 'left',
			'select2'  => array( 'allowClear' => false ),
		),
		array(
			'id'    	  => 'berg_team_overlay',
			'type'  	  => 'color',
			'title'    	  => __( 'Overlay color on background image', 'BERG' ),
			'default' 	  => 'rgba(0,0,0,0.6)',
			'transparent' => true,
			'validate' 	  => '',
			'output'	  => array( 'background-color' => '.team-page .bg-overlay'),
			'subtitle'  => __( 'Define the color and transparency level of the overlay background color.', 'BERG' ),  
		),

	)
);