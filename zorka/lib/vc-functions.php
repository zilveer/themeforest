<?php
add_action( 'vc_before_init', 'g5plus_vcSetAsTheme' );
function g5plus_vcSetAsTheme() {
    vc_set_as_theme();
}

function g5plus_vc_remove_frontend_links() {
    vc_disable_frontend();
}
add_action( 'vc_after_init', 'g5plus_vc_remove_frontend_links' );

function g5plus_get_css_animation($css_animation){
    $output = '';
    if ($css_animation != '') {
        wp_enqueue_script('waypoints');
	    $output = ' wpb_animate_when_almost_visible g5plus-css-animation wpb_' . $css_animation;
    }
    return $output;
}

function g5plus_get_style_animation($duration, $delay) {
    $styles = array();
    if ($duration != '0' && !empty($duration)) {
        $duration = (float)trim($duration, "\n\ts");
        $styles[] = "-webkit-animation-duration: {$duration}s";
        $styles[] = "-moz-animation-duration: {$duration}s";
        $styles[] = "-ms-animation-duration: {$duration}s";
        $styles[] = "-o-animation-duration: {$duration}s";
        $styles[] = "animation-duration: {$duration}s";
    }
    if ($delay != '0' && !empty($delay)) {
        $delay = (float)trim($delay, "\n\ts");
        $styles[] = "opacity: 0";
        $styles[] = "-webkit-animation-delay: {$delay}s";
        $styles[] = "-moz-animation-delay: {$delay}s";
        $styles[] = "-ms-animation-delay: {$delay}s";
        $styles[] = "-o-animation-delay: {$delay}s";
        $styles[] = "animation-delay: {$delay}s";
    }
    if (count($styles) > 1) {
        return 'style="' . implode(';', $styles) . '"';
    }
    return implode(';', $styles);
}

function  g5plus_convert_hex_to_rgba($hex,$opacity=1) {
    $hex = str_replace("#", "", $hex);
    if(strlen($hex) == 3) {
        $r = hexdec(substr($hex,0,1).substr($hex,0,1));
        $g = hexdec(substr($hex,1,1).substr($hex,1,1));
        $b = hexdec(substr($hex,2,1).substr($hex,2,1));
    }
    else {
        $r = hexdec(substr($hex,0,2));
        $g = hexdec(substr($hex,2,2));
        $b = hexdec(substr($hex,4,2));
    }
    $rgba = 'rgba('.$r.','.$g.','.$b.','.$opacity.')';
    return $rgba;
}


function register_vc_map()
{
	if(!function_exists('vc_map_get_attributes')) return;
	$add_css_animation = array(
		'type' => 'dropdown',
		'heading' => esc_html__('CSS Animation', 'zorka' ),
		'param_name' => 'css_animation',
		'admin_label' => true,
		'value' => array(
			__( 'No', 'zorka' ) => '',
			__( 'Top to bottom', 'zorka' ) => 'top-to-bottom',
			__( 'Bottom to top', 'zorka' ) => 'bottom-to-top',
			__( 'Left to right', 'zorka' ) => 'left-to-right',
			__( 'Right to left', 'zorka' ) => 'right-to-left',
			__( 'Appear from center', 'zorka' ) => 'appear',
			__( 'FadeIn', 'zorka' ) => 'fadein'
		),
		'description' => esc_html__('Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'zorka' )
	);
	$add_duration_animation= array(
		'type' => 'textfield',
		'heading' => esc_html__('Animation Duration', 'zorka' ),
		'param_name' => 'duration',
		'value' => '',
		'description' => esc_html__('Duration in seconds. You can use decimal points in the value. Use this field to specify the amount of time the animation plays. <em>The default value depends on the animation, leave blank to use the default.</em>', 'zorka' ),
		'dependency'  => Array( 'element' => 'css_animation', 'value' => array( 'top-to-bottom','bottom-to-top','left-to-right','right-to-left','appear','fadein') ),
	);
	$add_delay_animation=array(
		'type' => 'textfield',
		'heading' => esc_html__('Animation Delay', 'zorka' ),
		'param_name' => 'delay',
		'value' => '',
		'description' => esc_html__('Delay in seconds. You can use decimal points in the value. Use this field to delay the animation for a few seconds, this is helpful if you want to chain different effects one after another above the fold.', 'zorka' ),
		'dependency'  => Array( 'element' => 'css_animation', 'value' => array( 'top-to-bottom','bottom-to-top','left-to-right','right-to-left','appear','fadein') ),
	);
	$params_row=array(
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__('Layout', 'zorka' ),
			'param_name' => 'layout',
			'value'      => array(
				__( 'Full Width', 'zorka' )  => 'wide',
				__( 'Container', 'zorka' ) => 'boxed',
				__( 'Container Fluid', 'zorka' ) => 'container-fluid',
			),
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Full height row?', 'zorka' ),
			'param_name' => 'full_height',
			'description' => esc_html__('If checked row will be set to full height.', 'zorka' ),
			'value' => array( esc_html__('Yes', 'zorka' ) => 'yes' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Content position', 'zorka' ),
			'param_name' => 'content_placement',
			'value' => array(
				__( 'Middle', 'zorka' ) => 'middle',
				__( 'Top', 'zorka' ) => 'top',
			),
			'description' => esc_html__('Select content position within row.', 'zorka' ),
			'dependency' => array(
				'element' => 'full_height',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Use video background?', 'zorka' ),
			'param_name' => 'video_bg',
			'description' => esc_html__('If checked, video will be used as row background.', 'zorka' ),
			'value' => array( esc_html__('Yes', 'zorka' ) => 'yes' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('YouTube link', 'zorka' ),
			'param_name' => 'video_bg_url',
			'value' => 'https://www.youtube.com/watch?v=lMJXxhRFO1k', // default video url
			'description' => esc_html__('Add YouTube link.', 'zorka' ),
			'dependency' => array(
				'element' => 'video_bg',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Parallax', 'zorka' ),
			'param_name' => 'video_bg_parallax',
			'value' => array(
				__( 'None', 'zorka' ) => '',
				__( 'Simple', 'zorka' ) => 'content-moving',
				__( 'With fade', 'zorka' ) => 'content-moving-fade',
			),
			'description' => esc_html__('Add parallax type background for row.', 'zorka' ),
			'dependency' => array(
				'element' => 'video_bg',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Parallax', 'zorka' ),
			'param_name' => 'parallax',
			'value' => array(
				__( 'None', 'zorka' ) => '',
				__( 'Simple', 'zorka' ) => 'content-moving',
				__( 'With fade', 'zorka' ) => 'content-moving-fade',
			),
			'description' => esc_html__('Add parallax type background for row (Note: If no image is specified, parallax will use background image from Design Options).', 'zorka' ),
			'dependency' => array(
				'element' => 'video_bg',
				'is_empty' => true,
			),
		),
		array(
			'type' => 'attach_image',
			'heading' => esc_html__('Image', 'zorka' ),
			'param_name' => 'parallax_image',
			'value' => '',
			'description' => esc_html__('Select image from media library.', 'zorka' ),
			'dependency' => array(
				'element' => 'parallax',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Parallax speed', 'zorka'),
			'param_name' => 'parallax_speed',
			'value' =>'1.5',
			'dependency' => Array('element' => 'parallax','value' => array('content-moving','content-moving-fade')),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Show background overlay', 'zorka' ),
			'param_name' => 'overlay_set',
			'description' => esc_html__('Hide or Show overlay on background images.', 'zorka' ),
			'value' => array(
				__( 'Hide, please', 'zorka' ) =>'hide_overlay',
				__( 'Show Overlay Color', 'zorka' ) =>'show_overlay_color',
				__( 'Show Overlay Image', 'zorka' ) =>'show_overlay_image',
			)
		),
		array(
			'type'        => 'attach_image',
			'heading'     => esc_html__('Image Overlay:', 'zorka' ),
			'param_name'  => 'overlay_image',
			'value'       => '',
			'description' => esc_html__('Upload image overlay.', 'zorka' ),
			'dependency'  => Array( 'element' => 'overlay_set', 'value' => array( 'show_overlay_image' ) ),
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__('Overlay color', 'zorka' ),
			'param_name' => 'overlay_color',
			'description' => esc_html__('Select color for background overlay.', 'zorka' ),
			'value' => '',
			'dependency' => Array('element' => 'overlay_set','value' => array('show_overlay_color')),
		),
		array(
			'type' => 'number',
			'class' => '',
			'heading' => esc_html__('Overlay opacity', 'zorka' ),
			'param_name' => 'overlay_opacity',
			'value' =>'50',
			'min'=>'1',
			'max'=>'100',
			'suffix'=>'%',
			'description' => esc_html__('Select opacity for overlay.', 'zorka' ),
			'dependency' => Array('element' => 'overlay_set','value' => array('show_overlay_color','show_overlay_image')),
		),
		array(
			'type' => 'el_id',
			'heading' => esc_html__('Row ID', 'zorka' ),
			'param_name' => 'el_id',
			'description' => sprintf( esc_html__('Enter row ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'zorka' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'zorka' ),
			'param_name' => 'el_class',
			'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'zorka' ),
		),
		array(
			'type' => 'css_editor',
			'heading' => esc_html__('CSS box', 'zorka' ),
			'param_name' => 'css',
			'group' => esc_html__('Design Options', 'zorka' )
		),
		$add_css_animation,
		$add_duration_animation,
		$add_delay_animation,
	);
    vc_map( array(
        'name' => esc_html__('Row', 'zorka' ),
        'base' => 'vc_row',
        'is_container' => true,
        'icon' => 'icon-wpb-row',
        'show_settings_on_create' => false,
        'category' => esc_html__('Content', 'zorka' ),
        'description' => esc_html__('Place content elements inside the row', 'zorka' ),
        'params' => $params_row,
        'js_view' => 'VcRowView'
    ) );
    vc_map( array(
        'name' => esc_html__('Row', 'zorka' ), //Inner Row
        'base' => 'vc_row_inner',
        'content_element' => false,
        'is_container' => true,
        'icon' => 'icon-wpb-row',
        'weight' => 1000,
        'show_settings_on_create' => false,
        'description' => esc_html__('Place content elements inside the row', 'zorka' ),
	    'params' => $params_row,
        'js_view' => 'VcRowView'
    ) );
}
add_action( 'vc_after_init', 'register_vc_map' );
function g5plus_add_vc_param()
{
	if (function_exists('vc_map_get_attributes')) {
		vc_add_param('vc_tta_accordion', array(
				'type' => 'dropdown',
				'param_name' => 'style',
				'value' => array(
					__('Zorka', 'zorka') => 'accordion_style1',
					__('Classic', 'zorka') => 'classic',
					__('Modern', 'zorka') => 'modern',
					__('Flat', 'zorka') => 'flat',
					__('Outline', 'zorka') => 'outline',
				),
				'heading' => esc_html__('Style', 'zorka'),
				'description' => esc_html__('Select accordion display style.', 'zorka'),
				'weight' => 1,
			)
		);
		vc_add_param('vc_tta_tour', array(
				'type' => 'dropdown',
				'param_name' => 'style',
				'value' => array(
					__('Zorka', 'zorka') => 'tour_style1',
					__('Classic', 'zorka') => 'classic',
					__('Modern', 'zorka') => 'modern',
					__('Flat', 'zorka') => 'flat',
					__('Outline', 'zorka') => 'outline',
				),
				'heading' => esc_html__('Style', 'zorka'),
				'description' => esc_html__('Select tour display style.', 'zorka'),
				'weight' => 1,
			)
		);
		$settings_vc_map = array(
			'category' => array(__('Content', 'zorka'), esc_html__('Zorka Shortcodes', 'zorka'))
		);
		vc_map_update('vc_tta_tabs', $settings_vc_map);
	}
}

g5plus_add_vc_param();