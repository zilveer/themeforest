<?php
/**
 * Initialize the meta boxes. 
 */
add_action( 'admin_init', '_dd_theme_post_options' );

/**
 * Metabox options
 */
function _dd_theme_post_options() {
  
  	global $dd_sn;

	$dd_custom_options = array(
		'id'          => 'post_options',
		'title'       => 'Post Options',
		'desc'        => 'Theme specific options for blog posts.',
		'pages'       => array( 'post' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(
			array(
				'id'      => $dd_sn . 'layout',
				'label'   => 'Layout',
				'desc'    => 'Choose which layout do you want for this post, full content or with sidebar.',
				'std'     => 'cs',
				'type'    => 'select',
				'class'   => '',
				'choices' => array(
					array(
						'value'       => 'fc',
						'label'       => 'Full Content',
					),
					array(
						'value'       => 'cs',
						'label'       => 'Content + Sidebar',
					),
				)
			),
			array(
				'id'      => $dd_sn . 'header_image',
				'label'   => 'Header Image',
				'desc'    => 'Upload an image that will serve as the background image. If none uploaded the default will be used (from theme options).',
				'std'     => '',
				'type'    => 'upload',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'post_format_link_url',
				'label'   => 'Link Post Format - URL',
				'desc'    => 'If you chose the <strong>link</strong> post format enter the URL here.',
				'std'     => '',
				'type'    => 'text',
				'class'   => '',
			),
		)
	);
  
  	ot_register_meta_box( $dd_custom_options );

  	$dd_custom_options = array(
		'id'          => 'page_options',
		'title'       => 'Page Options',
		'desc'        => 'Theme specific options for pages.',
		'pages'       => array( 'page' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(
			array(
				'id'      => $dd_sn . 'layout',
				'label'   => 'Layout',
				'desc'    => 'Choose which layout do you want for this page, full content or with sidebar.',
				'std'     => 'fc',
				'type'    => 'select',
				'class'   => '',
				'choices' => array(
					array(
						'value'       => 'fc',
						'label'       => 'Full Content',
					),
					array(
						'value'       => 'cs',
						'label'       => 'Content + Sidebar',
					),
				)
			),
			array(
				'id'      => $dd_sn . 'blog_layout',
				'label'   => 'Blog - Layout',
				'desc'    => 'Choose which layout do you want for this blog posts listing.',
				'std'     => '2col',
				'type'    => 'select',
				'class'   => '',
				'choices' => array(
					array(
						'value'       => '2col',
						'label'       => '2 Columns',
					),
					array(
						'value'       => '3col',
						'label'       => '3 Columns',
					),
					array(
						'value'       => '3col_s',
						'label'       => '3 Columns with Sidebar',
					),
					array(
						'value'       => '4col',
						'label'       => '4 Columns',
					),
				)
			),
			array(
				'id'      => $dd_sn . 'blog_cats',
				'label'   => 'Blog - Categories',
				'desc'    => 'Choose which categories you want to show. If none chosen all will be shown.',
				'std'     => '',
				'type'    => 'category_checkbox',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'gallery_layout',
				'label'   => 'Gallery - Layout',
				'desc'    => 'Choose which layout do you want for this gallery listing.',
				'std'     => '2col',
				'type'    => 'select',
				'class'   => '',
				'choices' => array(
					array(
						'value'       => '2col',
						'label'       => '2 Columns',
					),
					array(
						'value'       => '3col',
						'label'       => '3 Columns',
					),
					array(
						'value'       => '3col_s',
						'label'       => '3 Columns with Sidebar',
					),
					array(
						'value'       => '4col',
						'label'       => '4 Columns',
					),
				)
			),
			array(
				'id'      => $dd_sn . 'gallery_cats',
				'label'   => 'Gallery - Categories',
				'desc'    => 'Choose which categories you want to show. If none chosen all will be shown.',
				'std'     => '',
				'type'    => 'taxonomy_checkbox',
				'taxonomy' => 'dd_gallery_cats',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'posts_per_page',
				'label'   => 'Posts per Page',
				'desc'    => 'How many posts to show per page.',
				'std'     => '10',
				'type'    => 'text',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'header_image',
				'label'   => 'Header Image',
				'desc'    => 'Upload an image that will serve as the background image. If none uploaded the default will be used (from theme options).',
				'std'     => '',
				'type'    => 'upload',
				'class'   => '',
			),
		)
	);
  
  	ot_register_meta_box( $dd_custom_options );

  	$dd_custom_options = array(
		'id'          => 'gallery_options',
		'title'       => 'Gallery Options',
		'desc'        => 'Theme specific options for galleries.',
		'pages'       => array( 'dd_gallery' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(
			array(
				'id'      => $dd_sn . 'layout',
				'label'   => 'Layout',
				'desc'    => 'Choose which layout do you want for this post, full content or with sidebar.',
				'std'     => 'cs',
				'type'    => 'select',
				'class'   => '',
				'choices' => array(
					array(
						'value'       => 'fc',
						'label'       => 'Full Content',
					),
					array(
						'value'       => 'cs',
						'label'       => 'Content + Sidebar',
					),
				)
			),
			array(
				'id'      => $dd_sn . 'header_image',
				'label'   => 'Header Image',
				'desc'    => 'Upload an image that will serve as the background image. If none uploaded the default will be used (from theme options).',
				'std'     => '',
				'type'    => 'upload',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'gallery_images',
				'label'   => 'Gallery Images',
				'desc'    => 'Add images for this gallery.',
				'std'     => '',
				'type'    => 'list-item',
				'class'   => '',
				'settings' => array(
					array(
						'label'       => 'Description',
						'id'          => $dd_sn . 'description',
						'type'        => 'textarea',
					),
					array(
						'label'       => 'Gallery Image',
						'id'          => $dd_sn . 'gallery_image',
						'type'        => 'upload',
					),
				)
			),
		)
	);
  
  	ot_register_meta_box( $dd_custom_options );

}