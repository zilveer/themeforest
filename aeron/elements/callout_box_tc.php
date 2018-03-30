<?php

/*********** Shortcode: Callout box ************************************************************/

$tcvpb_elements['callout_box_tc'] = array(
	'name' => esc_html__('Callout Box', 'ABdev_aeron' ),
	'type' => 'block',
	'icon' => 'pi-callout-box',
	'category' => esc_html__('Content', 'ABdev_aeron' ),
	'attributes' => array(
		'style' => array(
			'description' => esc_html__( 'Box Style', 'ABdev_aeron' ),
			'default' => 'style_1',
			'type' => 'select',
			'values' => array(
				'style_1' =>  esc_html__( 'Style 1', 'ABdev_aeron' ),
				'style_2' =>  esc_html__( 'Style 2', 'ABdev_aeron' ),
				'style_3' =>  esc_html__( 'Style 3', 'ABdev_aeron' ),
			),
		),
		'background' => array(
			'type' => 'coloralpha',
			'description' => esc_html__( 'Background', 'ABdev_aeron' ),
		),
		'inverted' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__( 'Inverted (White) Text', 'ABdev_aeron' ),
		),
		'title' => array(
			'description' => esc_html__( 'Title', 'ABdev_aeron' ),
			'divider' => 'true',
			'type' => 'small_tinymce',
		),
		'subscribe' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__( 'Subscribe Field', 'ABdev_aeron' ),
			'divider' => 'true',
			'tab'	=> esc_html__('Button', 'the-creator-vpb'),
		),
		'no_button' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__( 'No Button', 'ABdev_aeron' ),
			'tab'	=> esc_html__('Button', 'the-creator-vpb'),
		),
		'button_text' => array(
			'description' => esc_html__( 'Button Text', 'ABdev_aeron' ),
			'default' => esc_html__( 'Click Here', 'ABdev_aeron' ),
			'tab'	=> esc_html__('Button', 'the-creator-vpb'),
		),
		'button_style' => array(
			'description' => esc_html__( 'Button Style', 'ABdev_aeron' ),
			'default' => 'normal',
			'type' => 'select',
			'values' => array(
				'regular' =>  esc_html__( 'Regular', 'ABdev_aeron' ),
				'stroke' =>  esc_html__( 'Stroke', 'ABdev_aeron' ),
				'striped' =>  esc_html__( 'Striped', 'ABdev_aeron' ),
			),
			'tab'	=> esc_html__('Button', 'the-creator-vpb'),
		),
		'button_size' => array(
			'description' => esc_html__( 'Button Size', 'ABdev_aeron' ),
			'default' => 'medium',
			'type' => 'select',
			'values' => array(
				'small' =>  esc_html__( 'Small', 'ABdev_aeron' ),
				'normal' => esc_html__( 'Normal', 'ABdev_aeron' ),
				'fullwidth' => esc_html__( 'Fullwidth', 'ABdev_aeron' ),
			),
			'tab'	=> esc_html__('Button', 'the-creator-vpb'),
		),
		'button_color' => array(
			'description' => esc_html__( 'Button Color', 'ABdev_aeron' ),
			'default' => 'white',
			'type' => 'select',
			'values' => array(
				'main' =>  esc_html__( 'Main', 'ABdev_aeron' ),
				'light' =>  esc_html__( 'Light', 'ABdev_aeron' ),
				'accent' =>  esc_html__( 'Accent', 'ABdev_aeron' ),
				'dark' =>  esc_html__( 'Dark', 'ABdev_aeron' ),
				'white' =>  esc_html__( 'White', 'ABdev_aeron' ),
				'green' =>  esc_html__( 'Green', 'ABdev_aeron' ),
				'orange' =>  esc_html__( 'Orange', 'ABdev_aeron' ),
				'red' =>  esc_html__( 'Red', 'ABdev_aeron' ),
			),
			'tab'	=> esc_html__('Button', 'the-creator-vpb'),
		),
		'button_url' => array(
			'description' => esc_html__( 'Button URL', 'ABdev_aeron' ),
			'type' => 'url',
			'tab'	=> esc_html__('Button', 'the-creator-vpb'),
		),
		'button_target' => array(
			'default' => '_self',
			'type' => 'select',
			'description' => esc_html__( 'Button Target', 'ABdev_aeron' ),
			'values' => array(
				'_self' =>  esc_html__( 'Self', 'ABdev_aeron' ),
				'_blank' => esc_html__( 'Blank', 'ABdev_aeron' ),
			),
			'tab'	=> esc_html__('Button', 'the-creator-vpb'),
		),
		'button_icon' => array(
			'description' => esc_html__('Button Icon Name', 'ABdev_aeron'),
			'info' => esc_html__('Optional icon after button text', 'ABdev_aeron'),
			'type' => 'icon',
			'tab'	=> esc_html__('Button', 'the-creator-vpb'),
		),
		'animation' => array(
			'default'     => '',
			'description' => esc_html__('Entrance Animation', 'ABdev_aeron'),
			'type'        => 'select',
			'tab'         => esc_html__('Animation', 'ABdev_aeron'),
			'values'      => array(
				''                  => esc_html__('None', 'ABdev_aeron'),
				'animate_fade'      => esc_html__('Fade', 'ABdev_aeron'),
				'animate_afc'       => esc_html__('Zoom', 'ABdev_aeron'),
				'animate_afl'       => esc_html__('Fade to Right', 'ABdev_aeron'),
				'animate_afr'       => esc_html__('Fade to Left', 'ABdev_aeron'),
				'animate_aft'       => esc_html__('Fade Down', 'ABdev_aeron'),
				'animate_afb'       => esc_html__('Fade Up', 'ABdev_aeron'),
			),
		),
		'trigger_pt' => array(
			'description' => esc_html__('Trigger Point (in px)', 'ABdev_aeron'),
			'info'        => esc_html__('Amount of pixels from bottom to start animation', 'ABdev_aeron'),
			'default'     => '0',
			'tab'         => esc_html__('Animation', 'ABdev_aeron'),
		),
		'duration' => array(
			'description' => esc_html__('Animation Duration (in ms)', 'ABdev_aeron'),
			'default'     => '1000',
			'tab'         => esc_html__('Animation', 'ABdev_aeron'),
		),
		'delay' => array(
			'description' => esc_html__('Animation Delay (in ms)', 'ABdev_aeron'),
			'default'     => '0',
			'tab'         => esc_html__('Animation', 'ABdev_aeron'),
		),
		'id' => array(
			'description' => esc_html__('ID', 'ABdev_aeron'),
			'info' => esc_html__('Additional custom ID', 'ABdev_aeron'),
			'tab' => esc_html__('Advanced', 'ABdev_aeron'),
		),	
		'class' => array(
			'description' => esc_html__('Class', 'ABdev_aeron'),
			'info' => esc_html__('Additional custom classes for custom styling', 'ABdev_aeron'),
			'tab' => esc_html__('Advanced', 'ABdev_aeron'),
		),
	),
	'content' => array(
		'description' => esc_html__( 'Content', 'ABdev_aeron' ),
	),

);

function tcvpb_callout_box_tc_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( tcvpb_extract_attributes('callout_box_tc'), $atts ) );
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$animation_classes='';
	$animation_out='';
	if($animation!=''){
		$animation_classes = 'tcvpb-animo '.esc_attr($animation).'';
		$animation_out = ' data-trigger_pt="'.esc_attr($trigger_pt).'" data-duration="'.esc_attr($duration).'" data-delay="'.esc_attr($delay).'"';
	}
	
	$class = ($no_button == '1') ? 'tcvpb-callout_box_no_button '.$class : $class;

	$button_class_out = 'tcvpb-button';
	$button_class_out .= ' tcvpb-button_'.$button_color;
	$button_class_out .= ' tcvpb-button_'.$button_style;
	$button_class_out .= ' tcvpb-button_'.$button_size;
	$button_icon_out = ($button_icon!='') ? '<i class="'.$button_icon.'"></i>' : '';

	$title_out = ($title!='') ? '<h3 class="tcvpb-callout_box_title">'.$title.'</h3>' : '';

	$background_out = ($background!='') ? 'style="background-color:'.esc_attr($background).';"' : '';

	$class = 'tcvpb-callout_box_'.$style.' '.$class;

	$return = '<div '.esc_attr($id_out).' class="tcvpb-callout_box '.$class.' '.$animation_classes.'" '.$background_out.' '.$animation_out.'>';
	
	if ( $no_button != '1' ){
		$return .= '<div class="tcvpb_container"><div class="tcvpb_column_tc_span9">';
	}

	if ( $subscribe == '1' ){
		$return .= '<div class="tcvpb_container"><div class="tcvpb_column_tc_span9">';
	}

	$return .= '
		'.$title_out.'
		'.do_shortcode($content).'';
	
	if ( $no_button != '1' ){
		$return .= '</div>
				<div class="tcvpb_column_tc_span3">
					<a href="'. $button_url .'" target="' . $button_target . '" class="'.$button_class_out.'">'.$button_text.$button_icon_out.'</a>
				</div>
			</div>';
	} 

	if ( $subscribe == '1' ){
		$return .= '</div>
				<div class="tcvpb_column_tc_span3">';
					if ( in_array('ab-simple-subscribe/ab-simple-subscribe.php', get_option('active_plugins')) ) {
						$return .= ''.do_shortcode('[ABss_subscribe_form no_name="1" no_button="1" email_placeholder="Your Email &nbsp;&nbsp;&nbsp;↵"]').'';
					}else{
						$return .= '<p>'.esc_html__('This options requires AB Simple Subscribe plugin to be activated', 'ABdev_aeron').'</p>';
					}
	$return .= '</div>
			</div>';
	}

	$return .= '</div>';

	return $return;
}
