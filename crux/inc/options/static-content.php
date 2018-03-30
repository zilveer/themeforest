<?php

add_action( 'admin_init', 'stag_static_content' );

function stag_static_content(){
	$settings['description'] = __( 'Display Static Content right before the footer widget.', 'stag' );

	$settings[] = array(
	    'title' => __( 'Content Section Title', 'stag' ),
	    'desc'  => __( 'Enter the title for the content section.', 'stag' ),
	    'type'  => 'text',
	    'id'    => 'static_page_title'
	);

	$settings[] = array(
	    'title' => __( 'Select Page', 'stag' ),
	    'desc'  => __( 'Select page from which you want to display the content.', 'stag' ),
	    'type'  => 'pages',
	    'id'    => 'static_page'
	);

	$settings[] = array(
	    'title' => __( 'Background Image', 'stag' ),
	    'desc'  => __( 'Select the background image of the content section.', 'stag' ),
	    'type'  => 'file',
	    'id'    => 'static_page_background'
	);

	$settings[] = array(
	    'title' => __( 'Background Color', 'stag' ),
	    'desc'  => __( 'Select the background color of the content section', 'stag' ),
	    'type'  => 'color',
	    'id'    => 'static_page_background_color',
	    'val'	=> '#f7f5f1'
	);

	$settings[] = array(
	    'title' => __( 'Text Color', 'stag' ),
	    'desc'  => __( 'Select the text color of the content section', 'stag' ),
	    'type'  => 'color',
	    'id'    => 'static_page_text_color',
	    'val'	=> '#ffffff'
	);

	$settings[] = array(
	    'title' => __( 'Link Color', 'stag' ),
	    'desc'  => __( 'Select the link color of the content section', 'stag' ),
	    'type'  => 'color',
	    'id'    => 'static_page_link_color',
	    'val'	=> '#ffffff'
	);

	$settings[] = array(
	    'title' => __( 'Background Opacity', 'stag' ),
	    'desc'  => __( 'Enter the background image opacity of the content section', 'stag' ),
	    'type'  => 'text',
	    'id'    => 'static_page_background_opacity',
	    'val'	=> '50'
	);

	$settings[] = array(
		'title' => __( 'Where to show?', 'stag' ),
		'desc'  => __( 'Select on which pages static content should be shown.', 'stag' ),
		'type'  => 'multi_checkbox',
		'id'    => 'static_page_visible_on',
	    'options' => array(
			__( 'Single Pages', 'stag' ) => 'on',
	    	__( 'Single Posts', 'stag' ) => 'on',
	    	__( 'Single Product Pages', 'stag' ) => 'on',
	    	__( 'Archive Pages', 'stag' ) => 'on',
	    	__( 'Shop Archive Pages', 'stag' ) => 'on',
	    	__( 'Homepage', 'stag' ) => 'off',
	    	__( 'Blog Page', 'stag' ) => 'on',
	    	__( '404 Page', 'stag' ) => 'on'
    	)
	);

	stag_add_framework_page( __( 'Static Content', 'stag' ), $settings, 35 );
}
