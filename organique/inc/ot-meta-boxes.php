<?php
/**
 * Meta Boxes for various data
 *
 * @package Organique
 */


add_action( 'admin_init', 'custom_meta_boxes' );

function custom_meta_boxes() {
	if ( ! function_exists( 'ot_register_meta_box' ) ) {
		return;
	}

	// default array of data
	$default = array(
		'id'       => 'organique_options',
		'title'    => _x( 'Organique Options', 'backend', 'organique_wp' ),
		'desc'     => _x( 'Options specific to Organique theme', 'backend', 'organique_wp' ),
		'pages'    => array(),
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array()
	);

	// page
	$meta_box_data = array_replace_recursive( $default, array(
		'pages'  => array( 'page' ),
		'fields' => array(
			array(
				'id'      => 'sidebar_position',
				'label'   => _x( 'Position of the sidebar', 'backend', 'organique_wp' ),
				'desc'    => _x( 'Position the sidebar for this particular page to the left, right or do not display it at all.', 'backend', 'organique_wp' ),
				'std'     => 'right',
				'type'    => 'radio',
				'class'   => '',
				'choices' => array(
					array(
						'value' => 'right',
						'label' => _x( 'Right', 'backend', 'organique_wp' )
					),
					array(
						'value' => 'left',
						'label' => _x( 'Left', 'backend', 'organique_wp' )
					),
					array(
						'value' => 'no',
						'label' => _x( 'No sidebar', 'backend', 'organique_wp' )
					),
				)
			),
			array(
				'id'      => 'featured_text',
				'label'   => _x( 'Featured text', 'backend', 'organique_wp' ),
				'desc'    => _x( 'Featured text which is shown under the title.', 'backend', 'organique_wp' ),
				'std'     => '',
				'type'    => 'textarea',
				'class'   => '',
				'choices' => array()
			),
			array(
				'id'      => 'revo_slider_alias',
				'label'   => _x( 'Slider Revolution alias or LayerSlider ID', 'backend', 'organique_wp'),
				'desc'    => _x( 'Slider Revolution <strong>OR</strong> LayerSlider can be used as alternative slider and do not come with the theme for free. You can buy Slider Revolution <a href="http://codecanyon.net/item/slider-revolution-responsive-wordpress-plugin/2751380?ref=ProteusThemes" target="_blank">here</a> or LayerSlider <a href="http://codecanyon.net/item/layerslider-responsive-wordpress-slider-plugin-/1362246?ref=ProteusThemes" target="_blank">here</a>. Only applies to the template "Front Page with Slider". Paste the alias (for Revolution) or ID (for Layer) of the slider you created in the plugin to this box (only <a href="https://www.diigo.com/item/image/3rli1/s9bj?size=o" target="_blank">alias</a>, not the whole shortcode).', 'backend', 'organique_wp'),
				'std'     => '',
				'type'    => 'text',
			),
		)
	));
	ot_register_meta_box( $meta_box_data );


	// post/single
	$meta_box_data = array_replace_recursive( $default, array(
		'pages'    => array( 'post' ),
		'fields'   => array(
			array(
				'id'      => 'sidebar_position',
				'label'   => _x( 'Position of the sidebar', 'backend', 'organique_wp' ),
				'desc'    => _x( 'Position the sidebar for this particular post to the left, right or do not display it at all.', 'backend', 'organique_wp' ),
				'std'     => 'as_blog',
				'type'    => 'radio',
				'class'   => '',
				'choices' => array(
					array(
						'value' => 'as_blog',
						'label' => _x( 'Default (the same as blog layout)', 'backend', 'organique_wp' )
					),
					array(
						'value' => 'right',
						'label' => _x( 'Right', 'backend', 'organique_wp' )
					),
					array(
						'value' => 'left',
						'label' => _x( 'Left', 'backend', 'organique_wp' )
					),
					array(
						'value' => 'no',
						'label' => _x( 'No sidebar', 'backend', 'organique_wp' )
					),
				)
			),
		)
	));
	ot_register_meta_box( $meta_box_data );


	// testimonials
	$meta_box_data = array(
		'id'       => 'testimonial_options',
		'title'    => _x( 'Testimonial Options', 'backend', 'organique_wp'),
		'desc'     => '',
		'pages'    => array( 'testimonials' ),
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'id'      => 'author_title',
				'label'   => _x( 'Title of the author for this testimonial', 'backend', 'organique_wp'),
				'desc'    => '',
				'std'     => '',
				'type'    => 'text',
				'class'   => '',
				'choices' => array()
			),
		)
	);
	ot_register_meta_box( $meta_box_data );

	// slider
	$meta_box_data = array(
		'id'       => 'slider_options',
		'title'    => _x( 'Slider Options', 'backend', 'organique_wp'),
		'desc'     => '',
		'pages'    => array( 'slider' ),
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'id'      => 'slider_subtitle',
				'label'   => _x( 'Smaller text above the title of the slide', 'backend', 'organique_wp'),
				'desc'    => '',
				'std'     => '',
				'type'    => 'text',
			),
		)
	);
	ot_register_meta_box( $meta_box_data );


	// team
	$my_meta_box = array(
		'id'       => 'team_options',
		'title'    => _x( 'Organique Options', 'backend', 'organique_wp'),
		'desc'     => _x( 'Options specific to Organique theme', 'backend', 'organique_wp'),
		'pages'    => array( 'team' ),
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'id'    => 'subtitle',
				'label' => _x( 'Subtitle', 'backend', 'organique_wp'),
				'desc'  => _x( 'Subtitle of this team member (shown right below the name).', 'backend', 'organique_wp'),
				'std'   => '',
				'type'  => 'text',
			),
		)
	);
	ot_register_meta_box( $my_meta_box );
}