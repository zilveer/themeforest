<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */


add_filter( 'rwmb_meta_boxes', 'g5plus_register_meta_boxes' );

/**
 * Register meta boxes
 *
 * Remember to change "your_prefix" to actual prefix in your project
 *
 * @return void
 */
function g5plus_register_meta_boxes( $meta_boxes )
{
	/**
	 * prefix of meta keys (optional)
	 * Use underscore (_) at the beginning to make keys hidden
	 * Alt.: You also can make prefix empty to disable it
	 */
	// Better has an underscore as last sign
	$prefix = 'g5plus-';
	// Post Format
	$meta_boxes[] = array(
		'title'  => esc_html__('Post Format: Image','zorka'),
		'id'     => $prefix. 'meta-box-post-format-image',
		'pages'  => array( 'post' ),
		'fields' => array(
			array(
				'name'             => esc_html__('Image', 'zorka' ),
				'id'               => 'post-format-image',
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
			),
		),
	);

	$meta_boxes[] = array(
		'title'  => esc_html__('Post Format: Gallery', 'zorka' ),
		'id'     => $prefix. 'meta-box-post-format-gallery',
		'pages'  => array( 'post' ),
		'fields' => array(
			array(
				'name' => esc_html__('Images', 'zorka' ),
				'id'   => 'post-format-gallery',
				'type' => 'image_advanced',
			),
		),
	);

	$meta_boxes[] = array(
		'title'  => esc_html__('Post Format: Video', 'zorka' ),
		'id'     => $prefix. 'meta-box-post-format-video',
		'pages'  => array( 'post' ),
		'fields' => array(
			array(
				'name' => esc_html__('Video URL or Embeded Code', 'zorka' ),
				'id'   => 'post-format-video',
				'type' => 'textarea',
			),
		)
	);

	$meta_boxes[] = array(
		'title'  => esc_html__('Post Format: Audio', 'zorka' ),
		'id'     => $prefix. 'meta-box-post-format-audio',
		'pages'  => array( 'post' ),
		'fields' => array(
			array(
				'name' => esc_html__('Audio URL or Embeded Code', 'zorka' ),
				'id'   => 'post-format-audio',
				'type' => 'textarea',
			),
		)
	);




	// Display Settings
	$meta_boxes[] = array(
		'title'  => esc_html__('Page Settings', 'zorka' ),
		'pages'  => array( 'page','post' ),
		'fields' => array(
			array(
				'name' => esc_html__('Page Title Area', 'zorka' ),
				'id'   => 'heading-title',
				'type' => 'heading',
			),
            array(
                'name'  => esc_html__('Hide Page Title Area?', 'zorka' ),
                'id'    => 'hide-page-title',
                'type'  => 'checkbox',
                'class' => 'checkbox-toggle reverse',
            ),

            array(
                'name'     => esc_html__('Select Page Title Style', 'zorka' ),
                'id'       => "custom-page-title-style",
                'type'     => 'select',
                'options'  => array(
                    '1' 	=> 'Style 1',
                    '2' 	=> 'Style 2',
                ),
                // Select multiple values, optional. Default is false.
                'multiple'    => false,
                'std'         => '1',
                'before'  => '<div>'
            ),
			array(
				'name'   => esc_html__('Custom Page Title', 'zorka' ),
				'id'     => 'custom-page-title',
				'type'   => 'text',
				'desc'   => esc_html__('Leave empty to use post title', 'zorka' ),
			),

			array(
				'name'   => esc_html__('Custom Page Sub Title', 'zorka' ),
				'id'     => 'custom-page-sub-title',
				'type'   => 'text',
			),
            array(
                'name' => esc_html__('Custom Page Title Background', 'zorka' ),
                'id'   => 'custom-page-title-background',
                'type' => 'file_input',
                'after' => '</div>',
            ),

			array(
				'name' => esc_html__('Custom Layout', 'zorka' ),
				'id'   => 'heading-layout',
				'type' => 'heading'
            ),
			array(
				'name'  => esc_html__('Use Custom Layout?', 'zorka' ),
				'id'    => 'use-custom-layout',
				'type'  => 'checkbox',
				'class' => 'checkbox-toggle',
				'desc'  => sprintf( esc_html__('This will <b>overwrite</b> layout settings in <a href="%s" target="_blank">Theme Options</a> with values different <b>none</b>.', 'zorka' ), admin_url( 'themes.php?page=optionsframework' ) ),
			),
			array(
				'name'     => esc_html__('Select Layout Style', 'zorka' ),
				'id'       => "layout-style",
				'type'     => 'select',
				'options'  => array(
					'none' => esc_html__('None','zorka'),
					'wide' => esc_html__('Wide', 'zorka' ),
					'boxed' => esc_html__('Boxed', 'zorka' ),
				),
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => 'none',
				'before'  => '<div>'
			),
			array(
				'name'    => esc_html__('Page Layout', 'zorka' ),
				'id'      => 'page-layout',
				'type'    => 'select',
				'std'     => 'none',
				'options' => array(
					'none' => 'None',
					'full-content'  => esc_html__('Full Width','zorka'),
                    'container-full-content'  => esc_html__('Container Full Width','zorka'),
					'left-sidebar'  => esc_html__('Left Sidebar','zorka'),
					'right-sidebar' => esc_html__('Right Sidebar','zorka'),
				),
				'after'   => '</div>'
			),
			array(
				'name' => esc_html__('Custom Header', 'zorka' ),
				'id'   => 'heading-header',
				'type' => 'heading'),
			array(
				'name'     => esc_html__('Select Header Layout', 'zorka' ),
				'id'       => "header-layout",
				'type'     => 'select',
				'options'  => array(
					'none' => esc_html__('None','zorka'),
					'1' => esc_html__('Header 1', 'zorka' ),
					'2' => esc_html__('Header 2', 'zorka' ),
					'3' => esc_html__('Header 3', 'zorka' ),
					'4' => esc_html__('Header 4', 'zorka' ),
					'5' => esc_html__('Header 5', 'zorka' ),
					'6' => esc_html__('Header 6', 'zorka' ),
					'7' => esc_html__('Header 7', 'zorka' ),
					'8' => esc_html__('Header 8', 'zorka' ),
					'9' => esc_html__('Header 9', 'zorka' ),
					'10' => esc_html__('Header 10', 'zorka' ),
					'11' => esc_html__('Header 11', 'zorka' ),
				),
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => 'none'
			),
            array(
                'name' => esc_html__('Custom Footer', 'zorka' ),
                'id'   => 'heading-footer',
                'type' => 'heading'),
			array(
                'name'     => esc_html__('Select Footer Layout', 'zorka' ),
                'id'       => "footer-layout",
                'type'     => 'select',
                'options'  => array(
                    'none' => esc_html__('None','zorka'),
                    '1' => esc_html__('Light', 'zorka' ),
                    '2' => esc_html__('Dark', 'zorka' )
                ),
                // Select multiple values, optional. Default is false.
                'multiple'    => false,
                'std'         => 'none'
            ),

		)
	);

	return $meta_boxes;
}

add_action( 'admin_enqueue_scripts', 'g5plus_admin_script_meta_box' );

function g5plus_admin_script_meta_box() {
	$screen = get_current_screen();
	if ( ! in_array( $screen->post_type, array( 'post', 'page') ) ) {
		return;
	}
	wp_enqueue_script( 'g5plus-meta-box', THEME_URL . 'assets/admin/js/meta-boxes.js', array( 'jquery' ), '', true );
}