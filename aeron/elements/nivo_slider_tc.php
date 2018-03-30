<?php

/*********** Shortcode: Nivo Slider ************************************************************/

$tcvpb_elements['nivo_tc'] = array(
	'name'         => esc_html__('Nivo Slider', 'ABdev_aeron' ),
	'type'         => 'block',
	'icon'         => 'pi-slider',
	'category'     => esc_html__('Media', 'ABdev_aeron'),
	'child'        => 'nivo_single_tc',
	'child_button' => esc_html__('New Image', 'ABdev_aeron'),
	'child_title'  => esc_html__('Image', 'ABdev_aeron'),
	'attributes'   => array(
		'dummy' => array(
			'type' => 'hidden',
		),
		'randomstart' => array(
			'description' => esc_html__('Start on a random slide', 'ABdev_aeron'),
			'default'     => 'false',
			'type'        => 'select',
			'values'      => array(
				'true'  => esc_html__( 'Yes', 'ABdev_aeron'),
				'false' => esc_html__( 'No', 'ABdev_aeron'),
			),
			'divider' => 'true',
			'tab'     => esc_html__('Custom', 'ABdev_aeron'),
		),
		'manualadvance' => array(
			'description' => esc_html__('Autoplay', 'ABdev_aeron'),
			'info' 		  => esc_html__('Check if you want the carousel to autoplay', 'ABdev_aeron'),
			'default'     => 'false',
			'type'        => 'select',
			'values'      => array(
				'true'  => esc_html__( 'No', 'ABdev_aeron'),
				'false' => esc_html__( 'Yes', 'ABdev_aeron'),
			),
			'tab' => esc_html__('Custom', 'ABdev_aeron'),
		),
		'autoplay_effect' => array(
			'description' 	=> esc_html__('Autoplay Effect', 'ABdev_aeron'),
			'default'       => 'fade',
			'type'          => 'select',
			'values'        => array(
				'sliceDown'          => esc_html__( 'Slice Down', 'ABdev_aeron'),
				'sliceDownLeft'      => esc_html__( 'Slice Down Left', 'ABdev_aeron'),
				'sliceUp'            => esc_html__( 'Slice Up', 'ABdev_aeron'),
				'sliceUpLeft'        => esc_html__( 'Slice Up Left', 'ABdev_aeron'),
				'sliceUpDown'        => esc_html__( 'Slice Up Down', 'ABdev_aeron'),
				'sliceUpDownLeft'    => esc_html__( 'Slice Up Down Left', 'ABdev_aeron'),
				'fold'               => esc_html__( 'Fold', 'ABdev_aeron'),
				'fade'               => esc_html__( 'Fade', 'ABdev_aeron'),
				'random'             => esc_html__( 'Random', 'ABdev_aeron'),
				'slideInRight'       => esc_html__( 'Slide in Right', 'ABdev_aeron'),
				'slideInLeft'        => esc_html__( 'Slide in Left', 'ABdev_aeron'),
				'boxRandom'          => esc_html__( 'Box Random', 'ABdev_aeron'),
				'boxRain'            => esc_html__( 'Box Rain', 'ABdev_aeron'),
				'boxRainReverse'     => esc_html__( 'Box Rain Reverse', 'ABdev_aeron'),
				'boxRainGrow'        => esc_html__( 'Box Rain Grow', 'ABdev_aeron'),
				'boxRainGrowReverse' => esc_html__( 'Box Rain Grow Reverse', 'ABdev_aeron'),
			),
			'divider' => 'true',
			'tab'     => esc_html__('Custom', 'ABdev_aeron'),
		),
		'slices' => array(
			'description' => esc_html__('Slices', 'ABdev_aeron'),
			'info'        => esc_html__('For slice animations', 'ABdev_aeron'),
			'default'     => '15',
			'tab'         => esc_html__('Custom', 'ABdev_aeron'),
		),
		'boxcols' => array(
			'description' => esc_html__('Box Cols', 'ABdev_aeron'),
			'info'        => esc_html__('For box animations', 'ABdev_aeron'),
			'default'     => '8',
			'tab'         => esc_html__('Custom', 'ABdev_aeron'),
		),
		'boxrows' => array(
			'description' => esc_html__('Box Rows', 'ABdev_aeron'),
			'info'        => esc_html__('For box animations', 'ABdev_aeron'),
			'default'     => '4',
			'divider'     => 'true',
			'tab'         => esc_html__('Custom', 'ABdev_aeron'),
		),
		'animation' => array(
			'description' => esc_html__('Slide transition speed', 'ABdev_aeron'),
			'info'        => esc_html__('Duration in ms. Default: 800 ms', 'ABdev_aeron'),
			'default'     => '800',
			'tab'         => esc_html__('Animation', 'ABdev_aeron'),
		),
		'duration' => array(
			'description' => esc_html__('Duration of the slide', 'ABdev_aeron'),
			'info'        => esc_html__('Duration in ms. Default: 3000 ms', 'ABdev_aeron'),
			'default'     => '3000',
			'tab'         => esc_html__('Animation', 'ABdev_aeron'),
		),
		'startslide' => array(
			'description'=> esc_html__('Set starting Slide (0 is default', 'ABdev_aeron'),
			'default'    => '0',
			'tab'        => esc_html__('Custom', 'ABdev_aeron'),
		),
		'directionnav' => array(
			'description' => esc_html__('Next & Prev navigation', 'ABdev_aeron'),
			'default'     => 'false',
			'type'        => 'select',
			'values'      => array(
				'true'  => esc_html__( 'Yes', 'ABdev_aeron'),
				'false' => esc_html__( 'No', 'ABdev_aeron'),
			),
			'tab' => esc_html__('Navigation', 'ABdev_aeron'),
		),
		'prevtext' => array(
			'description' => esc_html__('Previous Text', 'ABdev_aeron'),
			'default'     => 'Prev',
			'tab'         => esc_html__('Navigation', 'ABdev_aeron'),
		),
		'nexttext' => array(
			'description' => esc_html__('Next Text', 'ABdev_aeron'),
			'default'     => 'Next',
			'tab'         => esc_html__('Navigation', 'ABdev_aeron'),
		),
		'controlnav' => array(
			'description' => esc_html__('1,2,3... navigation', 'ABdev_aeron'),
			'default'     => 'false',
			'type'        => 'select',
			'values'      => array(
				'true'  => esc_html__( 'Yes', 'ABdev_aeron'),
				'false' => esc_html__( 'No', 'ABdev_aeron'),
			),
			'tab' => esc_html__('Navigation', 'ABdev_aeron'),
		),
		'controlnavthumbs' => array(
			'description'  => esc_html__('Use thumbnails for Control Nav', 'ABdev_aeron'),
			'default'      => 'false',
			'type'         => 'select',
			'values'       => array(
				'true' => esc_html__( 'Yes', 'ABdev_aeron'),
				'false' => esc_html__( 'No', 'ABdev_aeron'),
			),
			'tab' => esc_html__('Navigation', 'ABdev_aeron'),
		),
		'pauseonhover' => array(
			'description' => esc_html__('Stop animation while hovering', 'ABdev_aeron'),
			'default'     => 'true',
			'type'        => 'select',
			'values'      => array(
				'true'  => esc_html__( 'Yes', 'ABdev_aeron'),
				'false' => esc_html__( 'No', 'ABdev_aeron'),
			),
			'tab' => esc_html__('Custom', 'ABdev_aeron'),
		),
		'class' => array(
			'description' => esc_html__('Class', 'ABdev_aeron'),
			'info'        => esc_html__('Additional custom classes for custom styling', 'ABdev_aeron'),
			'tab'         => esc_html__('Advanced', 'ABdev_aeron'),
		),
	),
);


function tcvpb_nivo_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('nivo_tc'), $attributes));

	$classes[] = 'tcvpb-nivo-slider';
	$classes[] = esc_attr($class);
	$classes_out = implode(' ', $classes);

	return '<div id="tcvpb-nivo-slider" class="'.$classes_out.'">'.  do_shortcode($content)  . '</div>

	<script>
		jQuery(document).ready (function() {
			jQuery("#tcvpb-nivo-slider").nivoSlider({
		        effect: "'.esc_attr($autoplay_effect).'",
				slices: '.esc_attr($slices).',
				boxCols: '.esc_attr($boxcols).',
				boxRows: '.esc_attr($boxrows).',
				animSpeed: '.esc_attr($animation).',
				pauseTime: '.esc_attr($duration).',
				startSlide: '.esc_attr($startslide).',
				directionNav: '.esc_attr($directionnav).',
				controlNav: '.esc_attr($controlnav).',
				controlNavThumbs: '.esc_attr($controlnavthumbs).',
				pauseOnHover: '.esc_attr($pauseonhover).',
				manualAdvance: '.esc_attr($manualadvance).',
				prevText: "'.esc_attr($prevtext).'",
    			nextText: "'.esc_attr($nexttext).'",
				randomStart: '.esc_attr($randomstart).',
		    });
		});
	</script>
	';

}

$tcvpb_elements['nivo_single_tc'] = array(
	'name' => esc_html__('Nivo Single Slide', 'ABdev_aeron' ),
	'hidden' => true,
	'attributes' => array(
		'url' => array(
			'type' => 'image',
			'description' => esc_html__('Select Image', 'ABdev_aeron'),
		),
		'link' => array(
			'description' => esc_html__('Link', 'ABdev_aeron'),
			'default' => '',
		),
		'alt' => array(
			'description' => esc_html__('Image Alt Text', 'ABdev_aeron'),
		),
		'caption' => array(
			'description' => esc_html__('Image Caption Text', 'ABdev_aeron'),
		),
	),
	'description' => esc_html__('Single image section', 'ABdev_aeron' )
);
function tcvpb_nivo_single_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('nivo_single_tc'), $attributes));
	static $image_no;
	$image_no++;

	$display_image_out = ($image_no != 1) ? 'style="display:none;"' : '';

	$out = ( ($link!='')?'<a href="'.esc_url($link).'">':'').'<img src="'.esc_url($url).'" data-thumb="'.esc_url($url).'" alt="'.esc_attr($alt).'" '.$display_image_out.'>'.(($link!='')?'</a>':'');

	$return = ' '.$out.'';

	return $return;
}