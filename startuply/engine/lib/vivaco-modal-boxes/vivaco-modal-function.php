<?php

$animation_types = array(
	'no' => 'Default',
	'bounce' => 'Bounce',
	'flash' => 'Flash',
	'pulse' => 'Pulse',
	'rubberBand' => 'RubberBand',
	'shake' => 'Shake',
	'swing' => 'Swing',
	'tada' => 'Tada',
	'wobble' => 'Wobble',
	'jello' => 'Jello',
	'bounceIn' => 'BounceIn',
	'bounceInDown' => 'BounceInDown',
	'bounceInLeft' => 'BounceInLeft',
	'bounceInRight' => 'BounceInRight',
	'bounceInUp' => 'BounceInUp',
	'fadeIn' => 'FadeIn',
	'fadeInDown' => 'FadeInDown',
	'fadeInDownBig' => 'FadeInDownBig',
	'fadeInLeft' => 'FadeInLeft',
	'fadeInLeftBig' => 'FadeInLeftBig',
	'fadeInRight' => 'FadeInRight',
	'fadeInRightBig' => 'FadeInRightBig',
	'fadeInUp' => 'FadeInUp',
	'fadeInUpBig' => 'FadeInUpBig',
	'flipInX' => 'FlipInX',
	'flipInY' => 'FlipInY',
	'lightSpeedIn' => 'LightSpeedIn',
	'lightSpeedOut' => 'LightSpeedOut',
	'rotateIn' => 'RotateIn',
	'rotateInDownLeft' => 'RotateInDownLeft',
	'rotateInDownRight' => 'RotateInDownRight',
	'rotateInUpLeft' => 'RotateInUpLeft',
	'rotateInUpRight' => 'RotateInUpRight',
	'hinge' => 'Hinge',
	'rollIn' => 'RollIn',
	'zoomIn' => 'ZoomIn',
	'zoomInDown' => 'ZoomInDown',
	'zoomInLeft' => 'ZoomInLeft',
	'zoomInRight' => 'ZoomInRight',
	'zoomInUp' => 'ZoomInUp',
	'slideInDown' => 'SlideInDown',
	'slideInLeft' => 'SlideInLeft',
	'slideInRight' => 'SlideInRight',
	/*'slideInUp' => 'SlideInUp',*/
	'roll3dInTop' => 'Roll3dInTop',
	'roll3dInLeft' => 'Roll3dInLeft',
	'roll3dInRight' => 'Roll3dInRight',
	'flip3dHorizontal' => 'Flip3dHorizontal',
	'flip3dVertical' => 'Flip3dVertical',
	'flip3dInTop' => 'Flip3dInTop',
	'flip3dInBottom' => 'Flip3dInBottom',
	'flip3dInLeft' => 'Flip3dInLeft',
	'flip3dInRight' => 'Flip3dInRight',
);

if( function_exists('acf_add_local_field_group') ) {

	$prefix = 'vivaco_';

	// GENERAL

	acf_add_local_field_group(array(
		'key' => $prefix . 'general',
		'title' => __( 'General', 'vivaco' ),
		'fields' => array (),
		'menu_order' => 0,
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'vivaco-modals',
				),
			),
		),
		//'style' => 'seamless',
		'label_placement' => 'left',
	));
		acf_add_local_field(array(
			'key' => $prefix . 'show_on',
			'label' => 'Show on',
			'instructions' => 'Choose pages to show the modal box',
			'name' => $prefix . 'show_on',
			'type' => 'select',
			'parent' => $prefix . 'general',
			'choices' => array(
				'all' => 'All pages',
				'front' => 'Homepage only',
				'exc_front' => 'All pages exc homepage',
				'specific_page' => 'Only Pages from list below',
			),
			'default_value' => 'all',
		));
		
		
		acf_add_local_field(array(
			'key' => $prefix . 'trigger',
			'label' => 'Trigger',
			'instructions' => 'Choose event to trigger the modal box',
			'name' => $prefix . 'trigger',
			'type' => 'select',
			'parent' => $prefix . 'general',
			'choices' => array(
				'load' => 'On page load',
				'timeout' => 'On page load + X seconds',
				'scroll' => 'On page load + X scroll',
				'click' => 'On custom element click',
				'button' => 'Custom trigger (assign modal box to a button or image via Visual Composer)',
			),
		));

		acf_add_local_field(array(
			'key' => $prefix . 'trigger_click',
			'label' => 'Class name',
			'instructions' => 'Set class name (e.g.:"myclass") that will trigger modal upon click',
			'name' => $prefix . 'trigger_click',
			'type' => 'text',
			'parent' => $prefix . 'general',
			'conditional_logic' => array (
				array (
					array (
						'field' => $prefix . 'trigger',
						'operator' => '==',
						'value' => 'click',
					),
				),
			),
		));

		acf_add_local_field(array(
			'key' => $prefix . 'trigger_scroll',
			'label' => 'Pixels',
			'instructions' => 'Scrolled from top',
			'name' => $prefix . 'trigger_scroll',
			'type' => 'text',
			'parent' => $prefix . 'general',
			'conditional_logic' => array (
				array (
					array (
						'field' => $prefix . 'trigger',
						'operator' => '==',
						'value' => 'scroll',
					),
				),
			),
		));


		acf_add_local_field(array(
			'key' => $prefix . 'trigger_timeout',
			'label' => 'Seconds',
			'instructions' => 'After page is fully loaded',
			'name' => $prefix . 'trigger_timeout',
			'type' => 'text',
			'parent' => $prefix . 'general',
			'conditional_logic' => array (
				array (
					array (
						'field' => $prefix . 'trigger',
						'operator' => '==',
						'value' => 'timeout',
					),
				),
			),
		));

		acf_add_local_field(array(
			'key' => $prefix . 'urls',
			'label' => 'Page Urls (Include)',
			'name' => $prefix . 'urls',
			'type' => 'textarea',
			'instructions' => 'Specify each page url per line to display this popup on certain website pages.',
			'parent' => $prefix . 'general',
			'conditional_logic' => array (
				array (
					array (
						'field' => $prefix . 'show_on',
						'operator' => '==',
						'value' => 'specific_page',
					),
				),
			),
		));

		acf_add_local_field(array(
			'key' => $prefix . 'urls_exclude',
			'label' => 'Page Urls (Exclude)',
			'name' => $prefix . 'urls_exclude',
			'type' => 'textarea',
			'instructions' => 'Specify each page url per line to restrict display of this popup.',
			'parent' => $prefix . 'general',
		));

		/*
		acf_add_local_field(array(
			'key' => $prefix . 'raw_before',
			'label' => 'Raw HTML before modal box',
			'name' => $prefix . 'raw_before',
			'type' => 'textarea',
			'parent' => $prefix . 'general',
		));

		acf_add_local_field(array(
			'key' => $prefix . 'raw_after',
			'label' => 'Raw HTML after modal box',
			'name' => $prefix . 'raw_after',
			'type' => 'textarea',
			'parent' => $prefix . 'general',
		));
		*/

	acf_add_local_field_group(array(
		'key' => $prefix . 'design',
		'title' => __( 'Design', 'vivaco' ),
		'fields' => array (),
		'menu_order' => 1,
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'vivaco-modals',
				),
			),
		),
		//'style' => 'seamless',
		'label_placement' => 'left',
	));

		acf_add_local_field(array(
			'key' =>  $prefix . 'size',
			'label' => 'Size',
			'instructions' => 'predefined sizes',
			'name' =>  $prefix . 'size',
			'type' => 'select',
			'parent' => $prefix . 'design',
			'choices' => array(
				'small' => 'Small',
				'normal' => 'Normal',
				'large' => 'Large',
				'custom' => 'Custom'
			),
			'default_value' => 'small',
		));

		acf_add_local_field(array(
			'key' => $prefix . 'custom_size',
			'label' => __( 'Custom modal box size', 'vivaco' ),
			'instructions' => __( 'Set custom size in pixels for Width x Height e.g.:"250x250"', 'vivaco' ),
			'name' => $prefix . 'custom_size',
			'type' => 'text',
			'parent' => $prefix . 'design',
			'conditional_logic' => array (
				array (
					array (
						'field' => $prefix . 'size',
						'operator' => '==',
						'value' => 'custom',
					),
				),
			),
		));
		
		acf_add_local_field(array(
			'key' =>  $prefix . 'position',
			'label' => 'Position',
			'instructions' => 'where it is shown on page',
			'name' =>  $prefix . 'position',
			'type' => 'select',
			'parent' => $prefix . 'design',
			'choices' => array(
				'top left' => 'Top left',
				'top' => 'Top center',
				'top right' => 'Top right',
				'left' => 'Center left',
				'center' => 'Center center',
				'right' => 'Center right',
				'bottom left' => 'Bottom left',
				'bottom' => 'Bottom center',
				'bottom right' => 'Bottom right',
			),
			'default_value' => 'center',
		));

		acf_add_local_field(array(
			'key' =>  $prefix . 'background',
			'label' => __( 'Modal background type', 'vivaco' ),
			'instructions' => 'modal box inner background',
			'name' =>  $prefix . 'background',
			'type' => 'select',
			'parent' => $prefix . 'design',
			'choices' => array(
				'no' => 'Default',
				'color' => 'Color',
				'image' => 'Image',
				'hide_bg' => 'Hide background (transparent)',
			),
			'default_value' => 'no',
		));

		acf_add_local_field(array(
			'key' => $prefix . 'background_color',
			'label' => __( 'Modal background Color', 'vivaco' ),
			'name' => $prefix . 'background_color',
			'type' => 'color_picker',
			'parent' => $prefix . 'design',
			'conditional_logic' => array (
				array (
					array (
						'field' => $prefix . 'background',
						'operator' => '==',
						'value' => 'color',
					),
				),
			),
		));

		acf_add_local_field(array(
			'key' => $prefix . 'background_image',
			'label' => __( 'Modal background Image', 'vivaco' ),
			'name' => $prefix . 'background_image',
			'type' => 'image',
			'parent' => $prefix . 'design',
			'conditional_logic' => array (
				array (
					array (
						'field' => $prefix . 'background',
						'operator' => '==',
						'value' => 'image',
					),
				),
			),
		));
		
		acf_add_local_field(array(
			'key' =>  $prefix . 'overlay',
			'label' => 'Page overlay',
			'instructions' => 'page background when modal is opened',
			'name' =>  $prefix . 'overlay',
			'type' => 'select',
			'parent' => $prefix . 'design',
			'choices' => array(
				'no' => 'No overlay',
				'color' => 'Color',
				'image' => 'Image'
			),
			'default_value' => 'no',
		));

		acf_add_local_field(array(
			'key' => $prefix . 'overlay_color',
			'label' => __( 'Overlay Color', 'vivaco' ),
			'name' => $prefix . 'overlay_color',
			'type' => 'color_picker',
			'parent' => $prefix . 'design',
			'conditional_logic' => array (
				array (
					array (
						'field' => $prefix . 'overlay',
						'operator' => '==',
						'value' => 'color',
					),
				),
			),
		));		
		
		acf_add_local_field(array(
			'key' => $prefix . 'overlay_color_opacity',
			'label' => __( 'Overlay Color Opacity', 'vivaco' ),
			'name' => $prefix . 'overlay_color_opacity',
			'type' => 'number',
			'parent' => $prefix . 'design',
			'conditional_logic' => array (
				array (
					array (
						'field' => $prefix . 'overlay',
						'operator' => '==',
						'value' => 'color',
					),
				),
			),
		));

		acf_add_local_field(array(
			'key' => $prefix . 'overlay_image',
			'label' => __( 'Overlay Image', 'vivaco' ),
			'name' => $prefix . 'overlay_image',
			'type' => 'image',
			'parent' => $prefix . 'design',
			'conditional_logic' => array (
				array (
					array (
						'field' => $prefix . 'overlay',
						'operator' => '==',
						'value' => 'image',
					),
				),
			),
		));

		acf_add_local_field(array(
			'key' =>  $prefix . 'start_animation',
			'label' => __( 'Start animation type', 'vivaco' ),
			'name' =>  $prefix . 'start_animation',
			'type' => 'select',
			'parent' => $prefix . 'design',
			'choices' => $animation_types,
		));

		
		acf_add_local_field(array(
			'key' => $prefix . 'duration',
			'label' => __( 'Animation speed (ms)', 'vivaco' ),
			'name' => $prefix . 'duration',
			'type' => 'text',
			'parent' => $prefix . 'design',
		));
		


	acf_add_local_field_group(array(
		'key' => $prefix . 'extra',
		'title' => __( 'Extra', 'vivaco' ),
		'fields' => array (),
		'menu_order' => 2,
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'vivaco-modals',
				),
			),
		),
		//'style' => 'seamless',
		'label_placement' => 'left',
	));


		acf_add_local_field(array(
			'key' => $prefix . 'dis_page_scroll',
			'label' => __( 'Disable Page Scroll', 'vivaco' ),
			'instructions' => 'no scrolling when modal is opened',
			'name' => $prefix . 'dis_page_scroll',
			'type' => 'checkbox',
			'parent' => $prefix . 'extra',
			'choices' => array(
				'true' =>  __( '', 'vivaco' ),
			),
		));

		acf_add_local_field(array(
			'key' => $prefix . 'hide_desctop',
			'label' => __( 'Hide on desktop', 'vivaco' ),
			'name' => $prefix . 'hide_desktop',
			'type' => 'checkbox',
			'parent' => $prefix . 'extra',
			'choices' => array(
				'true' => __( '', 'vivaco' ),
			),
		));

		acf_add_local_field(array(
			'key' => $prefix . 'hide_tablets',
			'label' => __( 'Hide on tablets', 'vivaco' ),
			'name' => $prefix . 'hide_tablets',
			'type' => 'checkbox',
			'parent' => $prefix . 'extra',
			'choices' => array(
				'true' => __( '', 'vivaco' ),
			),
		));

		acf_add_local_field(array(
			'key' => $prefix . 'hide_phones',
			'label' => __( 'Hide on phones', 'vivaco' ),
			'name' => $prefix . 'hide_phones',
			'type' => 'checkbox',
			'parent' => $prefix . 'extra',
			'choices' => array(
				'true' => __( '', 'vivaco' ),
			),
		));

			//---------------

	acf_add_local_field_group(array(
		'key' => $prefix . 'cookie',
		'title' => __( 'Cookies', 'vivaco' ),
		'click' => 'On click',
		'instructions' => 'Set action that will set a cookie',
		'menu_order' => 3,
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'vivaco-modals',
				),
			),
		),
		//'style' => 'seamless',
		'label_placement' => 'left',
	));

	acf_add_local_field(array(
		'key' =>  $prefix . 'cookie_trigger',
		'label' => __( 'Cookie Trigger', 'vivaco' ),
		'name' =>  $prefix . 'cookie_trigger',
		'instructions' => 'Choose action that will set a cookie',
		'type' => 'select',
		'parent' => $prefix . 'cookie',
		'choices' => array(
			'dis' => 'Disable',
			'open' => 'On modal open',
			'close' => 'On modal close'
		),
		'default_value' => 'dis'
	));

	acf_add_local_field(array(
		'key' => $prefix . 'cookie_expire',
		'label' => __( 'Cookie time', 'vivaco' ),
		'instructions' => 'Set cookie life time',
		'name' => $prefix . 'cookie_expire',
		'type' => 'text',
		'parent' => $prefix . 'cookie',
		'conditional_logic' => array(
			array(
				array(
					'field' => $prefix . 'cookie_trigger',
					'operator' => '!=',
					'value' => 'dis'
				)
			)
		),
	));

	acf_add_local_field(array(
		'key' => $prefix . 'cookie_key',
		'label' => __( 'Cookie key', 'vivaco' ),
		'name' => $prefix . 'cookie_key',
		'instructions' => 'Set cookie key',
		'type' => 'text',
		'parent' => $prefix . 'cookie',
		'conditional_logic' => array(
			array(
				array(
					'field' => $prefix . 'cookie_trigger',
					'operator' => '!=',
					'value' => 'dis'
				)
			)
		),
		//'default_value' => 'hide',
	));
		
/*-------------------------------------------------------------------------------
	Show modal ID in custom column
-------------------------------------------------------------------------------*/

function vivaco_modals_columns($columns)
{
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' 	=> 'Title',
		//'author'	=>	'Author',
		'id'		=>	'',
		'date'		=>	'Date',
	);
	return $columns;
}
add_filter("manage_edit-vivaco-modals_columns", "vivaco_modals_columns");


function vivaco_modals_custom_columns($column)
{
	global $post;
	if($column == 'id'){
		echo "Modal Box ID: <strong>".$post->ID."</strong>";
	}
}
add_action("manage_vivaco-modals_posts_custom_column", "vivaco_modals_custom_columns");

}
