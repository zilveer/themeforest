<?php

add_action('admin_init', 'uxbarn_create_page_meta_boxes');

if( ! function_exists('uxbarn_create_page_meta_boxes')) {
	
	function uxbarn_create_page_meta_boxes() {
		uxbarn_create_page_intro_meta_box();
        uxbarn_create_page_header_image_setting();
		uxbarn_create_sidebar_meta_box();
	}
	
}

if( ! function_exists('uxbarn_create_page_intro_meta_box')) {
	
    function uxbarn_create_page_intro_meta_box() {
        $page_intro = array(
            'id'          => 'uxbarn_page_intro_meta_box',
            'title'       => __('Page Intro Settings', 'uxbarn'),
            'desc'        => '',
            'pages'       => array( 'page' ),
            'context'     => 'normal',
            'priority'    => 'high',
            'fields'      => array(
                array(
                    'id'          => 'uxbarn_page_intro_display',
                    'label'       => __('Page Intro Display?', 'uxbarn'),
                    'desc'        => __('Whether to show the Page Intro which will be displayed on the top of this page.', 'uxbarn'),
                    'std'         => 'true',
                    'type'        => 'radio',
                    'section'     => 'uxbarn_sec_page_intro',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => '',
                    'choices'     => array( 
                      array(
	                    'value'       => 'true',
	                    'label'       => __('Yes', 'uxbarn'),
	                    'src'         => ''
	                  ),
	                  array(
	                    'value'       => 'false',
	                    'label'       => __('No', 'uxbarn'),
	                    'src'         => ''
	                  )
                    ),
                ),
                array(
                    'id'          => 'uxbarn_page_intro_title',
                    'label'       => __('Intro Heading Text', 'uxbarn'),
                    'desc'        => __('To be displayed as a Page Intro\'s title. If it is left blank, general page title will be used instead.', 'uxbarn'),
                    'std'         => '',
                    'type'        => 'text',
                    'section'     => 'uxbarn_sec_page_intro',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => ''
                ),
                array(
                    'id'          => 'uxbarn_page_intro_body',
                    'label'       => __('Intro Body Text', 'uxbarn'),
                    'desc'        => __('To be displayed as a Page Intro\'s body.', 'uxbarn'),
                    'std'         => '',
                    'type'        => 'textarea-simple',
                    'section'     => 'uxbarn_sec_page_intro',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => ''
              ),
            )
        );
        
        ot_register_meta_box($page_intro);
    }

}

if( ! function_exists('uxbarn_create_page_header_image_setting')) {
	
    function uxbarn_create_page_header_image_setting() {
        $header_image = array(
            'id'          => 'uxbarn_page_header_image_meta_box',
            'title'       => __('Page Header Image Setting', 'uxbarn'),
            'desc'        => '',
            'pages'       => array( 'page' ),
            'context'     => 'normal',
            'priority'    => 'high',
            'fields'      => array(
                array(
                    'id'          => 'uxbarn_page_header_image_upload',
                    'label'       => __('Upload Header Image', 'uxbarn'),
                    'desc'        => __('Click the icon to upload the file or if you already know the URL of the image, just paste it into the box. Recommended size is 2000x330.', 'uxbarn'),
                    'std'         => '',
                    'type'        => 'upload',
                    'section'     => 'uxbarn_page_header_image_sec',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => ''
                  ),
            )
        );
        
        ot_register_meta_box($header_image);
    }

}

if( ! function_exists('uxbarn_create_sidebar_meta_box')) {
	
	function uxbarn_create_sidebar_meta_box() {
		$sidebar = array(
			'id'          => 'uxbarn_sidebar_meta_box',
			'title'       => __('Sidebar Settings', 'uxbarn'),
			'desc'        => '',
			'pages'       => array( 'page' ),
			'context'     => 'normal',
			'priority'    => 'high',
			'fields'      => array(
					array(
				        'id'          => 'uxbarn_setting_select_custom_sidebar',
				        'label'       => __('Custom Sidebar', 'uxbarn'),
				        'desc'        => __('Select the custom sidebar that you have created in Theme Options. <p>This custom sidebar will work on every normal page, <strong>except the blog page (Posts Page).</strong></p><p>To manage blog\'s sidebar, there is already the pre-defined sidebar for the blog page (named "Blog Sidebar" in "Appearance > Widgets") and you can set its preference in "Theme Options > Blog".</p>', 'uxbarn'),
				        'std'         => '',
				        'type'        => 'sidebar-select',
				        'section'     => 'uxbarn_sec_sidebar',
				        'rows'        => '',
				        'post_type'   => '',
				        'taxonomy'    => '',
				        'class'       => ''
				      ),
				      array(
                        'id'          => 'uxbarn_sidebar_location',
                        'label'       => __('Sidebar Location', 'uxbarn'),
                        'desc'        => __('Select the location to display the selected custom sidebar.', 'uxbarn'),
                        'std'         => 'right',
                        'type'        => 'select',
                        'section'     => 'uxbarn_sec_sidebar',
                        'rows'        => '',
                        'post_type'   => '',
                        'taxonomy'    => '',
                        'class'       => '',
                        'choices'     => array( 
                          array(
                            'value'       => 'right',
                            'label'       => __('Right', 'uxbarn'),
                            'src'         => ''
                          ),
                          array(
                            'value'       => 'left',
                            'label'       => __('Left', 'uxbarn'),
                            'src'         => ''
                          ),
                        ),
                      ),
			),
		);
		
		ot_register_meta_box($sidebar);
	}

}
	

?>