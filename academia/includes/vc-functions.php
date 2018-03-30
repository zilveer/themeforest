<?php
function g5plus_custom_wp_admin_style()
{
    $primary_color = '';
    if (isset($g5plus_options['primary_color']) && !empty($g5plus_options['primary_color'])) {
        $primary_color = $g5plus_options['primary_color'];
    }
    if (empty($primary_color)) {
        $primary_color = '#9261aa';
    }
    $secondary_color = '';
    if (isset($g5plus_options['secondary_color']) && !empty($g5plus_options['secondary_color'])) {
        $secondary_color = $g5plus_options['secondary_color'];
    }
    if (empty($secondary_color)) {
        $secondary_color = '#ffbd33';
    }
    $tertiary_color = '';
    if (isset($g5plus_options['tertiary_color']) && !empty($g5plus_options['tertiary_color'])) {
        $tertiary_color = $g5plus_options['tertiary_color'];
    }
    if (empty($tertiary_color)) {
        $tertiary_color = '#30a8cc';
    }
    echo "<style>
    .vc_colored-dropdown .p-color {
        background-color: {$primary_color} !important;
    }
    .vc_colored-dropdown .s-color {
        background-color: {$secondary_color} !important;
    }
    .vc_colored-dropdown .t-color {
        background-color: {$tertiary_color} !important;
    }
    </style>";
}

add_action('admin_head', 'g5plus_custom_wp_admin_style');

add_action('vc_before_init', 'g5plus_vcSetAsTheme');
function g5plus_vcSetAsTheme()
{
    vc_set_as_theme();
}
//function g5plus_vc_remove_frontend_links()
//{
//    vc_disable_frontend();
//}
//
//add_action('vc_after_init', 'g5plus_vc_remove_frontend_links');
$list = array(
    'page',
    'post',
    'ourteacher'
);
vc_set_default_editor_post_types( $list );
function g5plus_number_settings_field($settings, $value)
{
    $param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
    $type = isset($settings['type']) ? $settings['type'] : '';
    $min = isset($settings['min']) ? $settings['min'] : '';
    $max = isset($settings['max']) ? $settings['max'] : '';
    $suffix = isset($settings['suffix']) ? $settings['suffix'] : '';
    $class = isset($settings['class']) ? $settings['class'] : '';
    $output = '<input type="number" min="' . esc_attr($min) . '" max="' . esc_attr($max) . '" class="wpb_vc_param_value ' . esc_attr($param_name) . ' ' . esc_attr($type) . ' ' . esc_attr($class) . '" name="' . esc_attr($param_name) . '" value="' . esc_attr($value) . '" style="max-width:100px; margin-right: 10px;" />' . esc_attr($suffix);
    return $output;
}

function g5plus_icon_text_settings_field($settings, $value)
{
    return '<div class="vc-text-icon">'
    . '<input  name="' . $settings['param_name'] . '" style="width:80%;" class="wpb_vc_param_value wpb-textinput widefat input-icon ' . esc_attr($settings['param_name']) . ' ' . esc_attr($settings['type']) . '_field" type="text" value="' . esc_attr($value) . '"/>'
    . '<input title="' . esc_html__('Click to browse icon', 'g5plus-academia') . '" style="width:20%; height:34px;" class="browse-icon button-secondary" type="button" value="' . esc_html__('Browse Icon', 'g5plus-academia') . '" >'
    . '<span class="icon-preview"><i class="' . esc_attr($value) . '"></i></span>'
    . '</div>';
}

function g5plus_multi_select_settings_field_shortcode_param($settings, $value)
{
    $param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
    $param_option = isset($settings['options']) ? $settings['options'] : '';
    $output = '<input type="hidden" name="' . $param_name . '" id="' . $param_name . '" class="wpb_vc_param_value ' . $param_name . '" value="' . $value . '"/>';
    $output .= '<select multiple id="' . $param_name . '_select2" name="' . $param_name . '_select2" class="multi-select">';
    if ($param_option != '' && is_array($param_option)) {
        foreach ($param_option as $text_val => $val) {
            if (is_numeric($text_val) && (is_string($val) || is_numeric($val))) {
                $text_val = $val;
            }
            $output .= '<option id="' . $val . '" value="' . $val . '">' . htmlspecialchars($text_val) . '</option>';
        }
    }

    $output .= '</select><input type="checkbox" id="' . $param_name . '_select_all" >' . esc_html__('Select All', 'g5plus-academia');
    $output .= '<script type="text/javascript">
		        jQuery(document).ready(function($){

					$("#' . $param_name . '_select2").select2();

					var order = $("#' . $param_name . '").val();
					if (order != "") {
						order = order.split(",");
						var choices = [];
						for (var i = 0; i < order.length; i++) {
							var option = $("#' . $param_name . '_select2 option[value="+ order[i]  + "]");
							if (option.length > 0) {
							    choices[i] = {id:order[i], text:option[0].label, element: option};
							}
						}
						$("#' . $param_name . '_select2").select2("data", choices);
					}

			        $("#' . $param_name . '_select2").on("select2-selecting", function(e) {
			            var ids = $("#' . $param_name . '").val();
			            if (ids != "") {
			                ids +=",";
			            }
			            ids += e.val;
			            $("#' . $param_name . '").val(ids);
                    }).on("select2-removed", function(e) {
				          var ids = $("#' . $param_name . '").val();
				          var arr_ids = ids.split(",");
				          var newIds = "";
				          for(var i = 0 ; i < arr_ids.length; i++) {
				            if (arr_ids[i] != e.val){
				                if (newIds != "") {
			                        newIds +=",";
					            }
					            newIds += arr_ids[i];
				            }
				          }
				          $("#' . $param_name . '").val(newIds);
		             });

		            $("#' . $param_name . '_select_all").click(function(){
		                if($("#' . $param_name . '_select_all").is(":checked") ){
		                    $("#' . $param_name . '_select2 > option").prop("selected","selected");
		                    $("#' . $param_name . '_select2").trigger("change");
		                    var arr_ids =  $("#' . $param_name . '_select2").select2("val");
		                    var ids = "";
                            for (var i = 0; i < arr_ids.length; i++ ) {
                                if (ids != "") {
                                    ids +=",";
                                }
                                ids += arr_ids[i];
                            }
                            $("#' . $param_name . '").val(ids);

		                }else{
		                    $("#' . $param_name . '_select2 > option").removeAttr("selected");
		                    $("#' . $param_name . '_select2").trigger("change");
		                    $("#' . $param_name . '").val("");
		                }
		            });
		        });
		        </script>
		        <style>
		            .multi-select
		            {
		              width: 100%;
		            }
		            .select2-drop
		            {
		                z-index: 100000;
		            }
		        </style>';
    return $output;
}
if (function_exists('vc_add_' . 'shortcode_param')) {
    call_user_func('vc_add_' . 'shortcode_param', 'number', 'g5plus_number_settings_field');
    call_user_func('vc_add_' . 'shortcode_param', 'icon_text', 'g5plus_icon_text_settings_field');
    call_user_func('vc_add_' . 'shortcode_param', 'multi-select', 'g5plus_multi_select_settings_field_shortcode_param');
}
function g5plus_add_vc_param()
{
    $academia_font_awesome = G5Plus_Global::font_awesome();

    if (function_exists('vc_add_param')) {
        vc_add_param('vc_icon',array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'g5plus-academia' ),
                'param_name' => 'icon_fontawesome',
                'value' => 'fa fa-info-circle',
                'settings' => array(
                    'emptyIcon' => false,
                    // default true, display an "EMPTY" icon?
                    'iconsPerPage' => 4000,
                    'source' => $academia_font_awesome,
                    // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'fontawesome',
                ),
                'description' => esc_html__( 'Select icon from library.', 'g5plus-academia' ),
            )
        );
    }
}

g5plus_add_vc_param();

function g5plus_get_css_animation($css_animation)
{
    $output = '';
    if ($css_animation != '') {
        wp_enqueue_script('waypoints');
        $output = ' wpb_animate_when_almost_visible g5plus-css-animation ' . $css_animation;
    }
    return $output;
}

function g5plus_get_style_animation($duration, $delay)
{
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

function  g5plus_convert_hex_to_rgba($hex, $opacity = 1)
{
    $hex = str_replace("#", "", $hex);
    if (strlen($hex) == 3) {
        $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
        $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
        $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
    } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }
    $rgba = 'rgba(' . $r . ',' . $g . ',' . $b . ',' . $opacity . ')';
    return $rgba;
}

function g5plus_register_vc_map()
{
    $academia_font_awesome = G5Plus_Global::font_awesome();
    $add_css_animation = array(
        'type' => 'dropdown',
        'heading' => esc_html__('CSS Animation', 'g5plus-academia'),
        'param_name' => 'css_animation',
        'value' => array(esc_html__('No', 'g5plus-academia') => '', esc_html__('Fade In', 'g5plus-academia') => 'wpb_fadeIn', esc_html__('Fade Top to Bottom', 'g5plus-academia') => 'wpb_fadeInDown', esc_html__('Fade Bottom to Top', 'g5plus-academia') => 'wpb_fadeInUp', esc_html__('Fade Left to Right', 'g5plus-academia') => 'wpb_fadeInLeft', esc_html__('Fade Right to Left', 'g5plus-academia') => 'wpb_fadeInRight', esc_html__('Bounce In', 'g5plus-academia') => 'wpb_bounceIn', esc_html__('Bounce Top to Bottom', 'g5plus-academia') => 'wpb_bounceInDown', esc_html__('Bounce Bottom to Top', 'g5plus-academia') => 'wpb_bounceInUp', esc_html__('Bounce Left to Right', 'g5plus-academia') => 'wpb_bounceInLeft', esc_html__('Bounce Right to Left', 'g5plus-academia') => 'wpb_bounceInRight', esc_html__('Zoom In', 'g5plus-academia') => 'wpb_zoomIn', esc_html__('Flip Vertical', 'g5plus-academia') => 'wpb_flipInX', esc_html__('Flip Horizontal', 'g5plus-academia') => 'wpb_flipInY', esc_html__('Bounce', 'g5plus-academia') => 'wpb_bounce', esc_html__('Flash', 'g5plus-academia') => 'wpb_flash', esc_html__('Shake', 'g5plus-academia') => 'wpb_shake', esc_html__('Pulse', 'g5plus-academia') => 'wpb_pulse', esc_html__('Swing', 'g5plus-academia') => 'wpb_swing', esc_html__('Rubber band', 'g5plus-academia') => 'wpb_rubberBand', esc_html__('Wobble', 'g5plus-academia') => 'wpb_wobble', esc_html__('Tada', 'g5plus-academia') => 'wpb_tada'),
        'description' => esc_html__('Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'g5plus-academia'),
        'group' => esc_html__('Animation Settings', 'g5plus-academia')
    );

    $add_duration_animation = array(
        'type' => 'textfield',
        'heading' => esc_html__('Animation Duration', 'g5plus-academia'),
        'param_name' => 'duration',
        'value' => '',
        'description' => __('Duration in seconds. You can use decimal points in the value. Use this field to specify the amount of time the animation plays. <em>The default value depends on the animation, leave blank to use the default.</em>', 'g5plus-academia'),
        'dependency' => Array('element' => 'css_animation', 'value' => array('wpb_fadeIn', 'wpb_fadeInDown', 'wpb_fadeInUp', 'wpb_fadeInLeft', 'wpb_fadeInRight', 'wpb_bounceIn', 'wpb_bounceInDown', 'wpb_bounceInUp', 'wpb_bounceInLeft', 'wpb_bounceInRight', 'wpb_zoomIn', 'wpb_flipInX', 'wpb_flipInY', 'wpb_bounce', 'wpb_flash', 'wpb_shake', 'wpb_pulse', 'wpb_swing', 'wpb_rubberBand', 'wpb_wobble', 'wpb_tada')),
        'group' => esc_html__('Animation Settings', 'g5plus-academia')
    );

    $add_delay_animation = array(
        'type' => 'textfield',
        'heading' => esc_html__('Animation Delay', 'g5plus-academia'),
        'param_name' => 'delay',
        'value' => '',
        'description' => esc_html__('Delay in seconds. You can use decimal points in the value. Use this field to delay the animation for a few seconds, this is helpful if you want to chain different effects one after another above the fold.', 'g5plus-academia'),
        'dependency' => Array('element' => 'css_animation', 'value' => array('wpb_fadeIn', 'wpb_fadeInDown', 'wpb_fadeInUp', 'wpb_fadeInLeft', 'wpb_fadeInRight', 'wpb_bounceIn', 'wpb_bounceInDown', 'wpb_bounceInUp', 'wpb_bounceInLeft', 'wpb_bounceInRight', 'wpb_zoomIn', 'wpb_flipInX', 'wpb_flipInY', 'wpb_bounce', 'wpb_flash', 'wpb_shake', 'wpb_pulse', 'wpb_swing', 'wpb_rubberBand', 'wpb_wobble', 'wpb_tada')),
        'group' => esc_html__('Animation Settings', 'g5plus-academia')
    );
    $params_row = array(
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Layout', 'g5plus-academia'),
            'param_name' => 'layout',
            'value' => array(
                esc_html__('Full Width (overflow hidden)', 'g5plus-academia') => 'fullwidth',
                esc_html__('Full Width (overflow visible)', 'g5plus-academia') => 'fullwidth-visible',
                esc_html__('Container', 'g5plus-academia') => 'container',
                esc_html__('Container Fluid', 'g5plus-academia') => 'container-fluid',
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Columns gap', 'js_composer' ),
            'param_name' => 'gap',
            'value' => array(
                '0px' => '0',
                '1px' => '1',
                '2px' => '2',
                '3px' => '3',
                '4px' => '4',
                '5px' => '5',
                '10px' => '10',
                '15px' => '15',
                '20px' => '20',
                '25px' => '25',
                '30px' => '30',
                '35px' => '35',
            ),
            'std' => '0',
            'description' => __( 'Select gap between columns in row.', 'js_composer' ),
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Full height row?', 'js_composer' ),
            'param_name' => 'full_height',
            'description' => esc_html__( 'If checked row will be set to full height.', 'js_composer' ),
            'value' => array( esc_html__( 'Yes', 'js_composer' ) => 'yes' ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Columns position', 'js_composer' ),
            'param_name' => 'columns_placement',
            'value' => array(
                esc_html__( 'Middle', 'js_composer' ) => 'middle',
                esc_html__( 'Top', 'js_composer' ) => 'top',
                esc_html__( 'Bottom', 'js_composer' ) => 'bottom',
                esc_html__( 'Stretch', 'js_composer' ) => 'stretch',
            ),
            'description' => esc_html__( 'Select columns position within row.', 'js_composer' ),
            'dependency' => array(
                'element' => 'full_height',
                'not_empty' => true,
            ),
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Equal height', 'js_composer' ),
            'param_name' => 'equal_height',
            'description' => esc_html__( 'If checked columns will be set to equal height.', 'js_composer' ),
            'value' => array( esc_html__( 'Yes', 'js_composer' ) => 'yes' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Content position', 'js_composer' ),
            'param_name' => 'content_placement',
            'value' => array(
                esc_html__( 'Default', 'js_composer' ) => '',
                esc_html__( 'Top', 'js_composer' ) => 'top',
                esc_html__( 'Middle', 'js_composer' ) => 'middle',
                esc_html__( 'Bottom', 'js_composer' ) => 'bottom',
            ),
            'description' => esc_html__( 'Select content position within columns.', 'js_composer' ),
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Use video background?', 'js_composer' ),
            'param_name' => 'video_bg',
            'description' => esc_html__( 'If checked, video will be used as row background.', 'js_composer' ),
            'value' => array( esc_html__( 'Yes', 'js_composer' ) => 'yes' ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'YouTube link', 'js_composer' ),
            'param_name' => 'video_bg_url',
            'value' => 'https://www.youtube.com/watch?v=lMJXxhRFO1k',
            // default video url
            'description' => esc_html__( 'Add YouTube link.', 'js_composer' ),
            'dependency' => array(
                'element' => 'video_bg',
                'not_empty' => true,
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Parallax', 'js_composer' ),
            'param_name' => 'video_bg_parallax',
            'value' => array(
                esc_html__( 'None', 'js_composer' ) => '',
                esc_html__( 'Simple', 'js_composer' ) => 'content-moving',
                esc_html__( 'With fade', 'js_composer' ) => 'content-moving-fade',
            ),
            'description' => esc_html__( 'Add parallax type background for row.', 'js_composer' ),
            'dependency' => array(
                'element' => 'video_bg',
                'not_empty' => true,
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Parallax', 'js_composer' ),
            'param_name' => 'parallax',
            'value' => array(
                esc_html__( 'None', 'js_composer' ) => '',
                esc_html__( 'Simple', 'js_composer' ) => 'content-moving',
                esc_html__( 'With fade', 'js_composer' ) => 'content-moving-fade',
            ),
            'description' => esc_html__( 'Add parallax type background for row (Note: If no image is specified, parallax will use background image from Design Options).', 'js_composer' ),
            'dependency' => array(
                'element' => 'video_bg',
                'is_empty' => true,
            ),
        ),
        array(
            'type' => 'attach_image',
            'heading' => esc_html__( 'Image', 'js_composer' ),
            'param_name' => 'parallax_image',
            'value' => '',
            'description' => esc_html__( 'Select image from media library.', 'js_composer' ),
            'dependency' => array(
                'element' => 'parallax',
                'not_empty' => true,
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Parallax speed', 'js_composer' ),
            'param_name' => 'parallax_speed_video',
            'value' => '1.5',
            'description' => esc_html__( 'Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)', 'js_composer' ),
            'dependency' => array(
                'element' => 'video_bg_parallax',
                'not_empty' => true,
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Parallax speed', 'js_composer' ),
            'param_name' => 'parallax_speed_bg',
            'value' => '1.5',
            'description' => esc_html__( 'Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)', 'js_composer' ),
            'dependency' => array(
                'element' => 'parallax',
                'not_empty' => true,
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Show background overlay', 'g5plus-academia'),
            'param_name' => 'overlay_set',
            'description' => esc_html__('Hide or Show overlay on background images.', 'g5plus-academia'),
            'value' => array(
                esc_html__('Hide, please', 'g5plus-academia') => 'hide_overlay',
                esc_html__('Show Overlay Color', 'g5plus-academia') => 'show_overlay_color',
                esc_html__('Show Overlay Image', 'g5plus-academia') => 'show_overlay_image',
            )
        ),
        array(
            'type' => 'attach_image',
            'heading' => esc_html__('Image Overlay:', 'g5plus-academia'),
            'param_name' => 'overlay_image',
            'value' => '',
            'description' => esc_html__('Upload image overlay.', 'g5plus-academia'),
            'dependency' => Array('element' => 'overlay_set', 'value' => array('show_overlay_image')),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Overlay color', 'g5plus-academia'),
            'param_name' => 'overlay_color',
            'description' => esc_html__('Select color for background overlay.', 'g5plus-academia'),
            'value' => '',
            'dependency' => Array('element' => 'overlay_set', 'value' => array('show_overlay_color')),
        ),
        array(
            'type' => 'number',
            'class' => '',
            'heading' => esc_html__('Overlay opacity', 'g5plus-academia'),
            'param_name' => 'overlay_opacity',
            'value' => '50',
            'min' => '1',
            'max' => '100',
            'suffix' => '%',
            'description' => esc_html__('Select opacity for overlay.', 'g5plus-academia'),
            'dependency' => Array('element' => 'overlay_set', 'value' => array('show_overlay_color', 'show_overlay_image')),
        ),
        array(
            'type' => 'el_id',
            'heading' => esc_html__( 'Row ID', 'js_composer' ),
            'param_name' => 'el_id',
            'description' => sprintf( __( 'Enter row ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'js_composer' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'js_composer' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'CSS box', 'js_composer' ),
            'param_name' => 'css',
            'group' => esc_html__( 'Design Options', 'js_composer' ),
        ),
        $add_css_animation,
        $add_duration_animation,
        $add_delay_animation,
    );

    vc_map(array(
        'name' => esc_html__('Row', 'g5plus-academia'),
        'base' => 'vc_row',
        'is_container' => true,
        'icon' => 'icon-wpb-row',
        'show_settings_on_create' => false,
        'category' => esc_html__('Content', 'g5plus-academia'),
        'description' => esc_html__('Place content elements inside the row', 'g5plus-academia'),
        'params' => $params_row,
        'js_view' => 'VcRowView'
    ));
    vc_map(array(
        'name' => esc_html__('Row', 'g5plus-academia'), //Inner Row
        'base' => 'vc_row_inner',
        'content_element' => false,
        'is_container' => true,
        'icon' => 'icon-wpb-row',
        'weight' => 1000,
        'show_settings_on_create' => false,
        'description' => esc_html__('Place content elements inside the row', 'g5plus-academia'),
        'params' => $params_row,
        'js_view' => 'VcRowView'
    ));
    $params_icon = array(
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__('Icon', 'g5plus-academia'),
            'param_name' => 'i_icon_fontawesome',
            'value' => 'fa fa-adjust', // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false,
                // default true, display an "EMPTY" icon?
                'iconsPerPage' => 4000,
                'source' => $academia_font_awesome,
                // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
            ),
            'dependency' => array(
                'element' => 'i_type',
                'value' => 'fontawesome',
            ),
            'description' => esc_html__('Select icon from library.', 'g5plus-academia'),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__('Icon', 'g5plus-academia'),
            'param_name' => 'i_icon_openiconic',
            'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'type' => 'openiconic',
                'iconsPerPage' => 4000, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'i_type',
                'value' => 'openiconic',
            ),
            'description' => esc_html__('Select icon from library.', 'g5plus-academia'),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__('Icon', 'g5plus-academia'),
            'param_name' => 'i_icon_typicons',
            'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'type' => 'typicons',
                'iconsPerPage' => 4000, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'i_type',
                'value' => 'typicons',
            ),
            'description' => esc_html__('Select icon from library.', 'g5plus-academia'),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__('Icon', 'g5plus-academia'),
            'param_name' => 'i_icon_entypo',
            'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'type' => 'entypo',
                'iconsPerPage' => 4000, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'i_type',
                'value' => 'entypo',
            ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__('Icon', 'g5plus-academia'),
            'param_name' => 'i_icon_linecons',
            'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'type' => 'linecons',
                'iconsPerPage' => 4000, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'i_type',
                'value' => 'linecons',
            ),
            'description' => esc_html__('Select icon from library.', 'g5plus-academia'),
        ),
    );
    /**
     * Pie chart
     */
    $params_piechart = array_merge(
        array(
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Layout Style', 'g5plus-academia'),
                'param_name' => 'layout_style',
                'admin_label' => true,
                'value' => array(esc_html__('Normal', 'g5plus-academia') => 'pie_text', esc_html__('Pie Icon', 'g5plus-academia') => 'pie_icon'),
                'description' => esc_html__('Select Layout Style.', 'g5plus-academia'),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Value', 'g5plus-academia'),
                'param_name' => 'value',
                'description' => esc_html__('Enter value for graph (Note: choose range from 0 to 100).', 'g5plus-academia'),
                'value' => '50',
                'admin_label' => true
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Label value', 'g5plus-academia'),
                'param_name' => 'label_value',
                'description' => esc_html__('Enter label for pie chart (Note: leaving empty will set value from "Value" field).', 'g5plus-academia'),
                'value' => ''
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Units', 'g5plus-academia'),
                'param_name' => 'units',
                'description' => esc_html__('Enter measurement units (Example: %, px, points, etc. Note: graph value and units will be appended to graph title).', 'g5plus-academia')
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Icon library', 'g5plus-academia'),
                'value' => array(
                    esc_html__('[None]', 'g5plus-academia') => '',
                    esc_html__('Font Awesome', 'g5plus-academia') => 'fontawesome',
                    esc_html__('Open Iconic', 'g5plus-academia') => 'openiconic',
                    esc_html__('Typicons', 'g5plus-academia') => 'typicons',
                    esc_html__('Entypo', 'g5plus-academia') => 'entypo',
                    esc_html__('Linecons', 'g5plus-academia') => 'linecons',
                    esc_html__('Image', 'g5plus-academia') => 'image',
                ),
                'admin_label' => true,
                'param_name' => 'i_type',
                'description' => esc_html__('Select icon library.', 'g5plus-academia'),
                'dependency' => Array('element' => 'layout_style', 'value' => array('pie_icon')),
            ),
        ),
        $params_icon,
        array(
            array(
                'type' => 'attach_image',
                'heading' => esc_html__('Upload Image Icon:', 'g5plus-academia'),
                'param_name' => 'i_icon_image',
                'value' => '',
                'description' => esc_html__('Upload the custom image icon.', 'g5plus-academia'),
                'dependency' => Array('element' => 'i_type', 'value' => array('image')),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Text value / Icon color', 'g5plus-academia'),
                'param_name' => 'value_color',
                'description' => esc_html__('Select value/icon color.', 'g5plus-academia'),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Bar color', 'g5plus-academia'),
                'param_name' => 'bar_color',
                'value' => array(esc_html__('Primary color', 'g5plus-academia') => 'p-color') + array(esc_html__('Secondary color', 'g5plus-academia') => 's-color') + array(esc_html__('Tertiary color', 'g5plus-academia') => 't-color') + getVcShared('colors-dashed') + array(esc_html__('Custom', 'g5plus-academia') => 'custom'),
                'description' => esc_html__('Select pie chart color.', 'g5plus-academia'),
                'param_holder_class' => 'vc_colored-dropdown',
                'std' => 's-color'
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Custom color', 'g5plus-academia'),
                'param_name' => 'bar_custom_color',
                'description' => esc_html__('Select custom bar color.', 'g5plus-academia'),
                'dependency' => array(
                    'element' => 'bar_color',
                    'value' => array('custom')
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Bar value color', 'g5plus-academia'),
                'param_name' => 'color',
                'value' => array(esc_html__('Primary color', 'g5plus-academia') => 'p-color') + array(esc_html__('Secondary color', 'g5plus-academia') => 's-color') + array(esc_html__('Tertiary color', 'g5plus-academia') => 't-color') + getVcShared('colors-dashed') + array(esc_html__('Custom', 'g5plus-academia') => 'custom'),
                'description' => esc_html__('Select pie chart color.', 'g5plus-academia'),
                'param_holder_class' => 'vc_colored-dropdown',
                'std' => 'p-color'
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Custom color', 'g5plus-academia'),
                'param_name' => 'custom_color',
                'description' => esc_html__('Select custom bar value color.', 'g5plus-academia'),
                'dependency' => array(
                    'element' => 'color',
                    'value' => array('custom')
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra class name', 'g5plus-academia'),
                'param_name' => 'el_class',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'g5plus-academia')
            ),
            array(
                'type' => 'css_editor',
                'heading' => esc_html__('CSS box', 'g5plus-academia'),
                'param_name' => 'css',
                'group' => esc_html__('Design Options', 'g5plus-academia')
            ),
        )
    );
    vc_map(array(
        'name' => esc_html__('Pie Chart', 'g5plus-academia'),
        'base' => 'vc_pie',
        'class' => '',
        'icon' => 'icon-wpb-vc_pie',
        'category' => array(esc_html__('Content', 'g5plus-academia'), esc_html__('Academia Shortcodes', 'g5plus-academia')),
        'description' => esc_html__('Animated pie chart', 'g5plus-academia'),
        'params' => $params_piechart,
    ));

    vc_map(array(
        'name' => esc_html__('Progress Bar', 'g5plus-academia'),
        'base' => 'vc_progress_bar',
        'icon' => 'icon-wpb-graph',
        'category' => array(esc_html__('Content', 'g5plus-academia'), esc_html__('Academia Shortcodes', 'g5plus-academia')),
        'description' => esc_html__('Animated progress bar', 'g5plus-academia'),
        'params' => array(
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Layout Style', 'g5plus-academia'),
                'param_name' => 'layout_style',
                'admin_label' => true,
                'value' => array(esc_html__('Text left', 'g5plus-academia') => 'style1', esc_html__('Text inner bar', 'g5plus-academia') => 'style2', esc_html__('Text move', 'g5plus-academia') => 'style3'),
                'description' => esc_html__('Select Layout Style.', 'g5plus-academia')
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Widget title', 'g5plus-academia'),
                'param_name' => 'title',
                'description' => esc_html__('Enter text used as widget title (Note: located above content element).', 'g5plus-academia')
            ),
            array(
                'type' => 'param_group',
                'heading' => esc_html__('Values', 'g5plus-academia'),
                'param_name' => 'values',
                'description' => esc_html__('Enter values for graph - value, title and color.', 'g5plus-academia'),
                'value' => urlencode(json_encode(array(
                    array(
                        'label' => esc_html__('Development', 'g5plus-academia'),
                        'value' => '90',
                    ),
                    array(
                        'label' => esc_html__('Design', 'g5plus-academia'),
                        'value' => '80',
                    ),
                    array(
                        'label' => esc_html__('Marketing', 'g5plus-academia'),
                        'value' => '70',
                    ),
                ))),
                'params' => array(
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Label', 'g5plus-academia'),
                        'param_name' => 'label',
                        'description' => esc_html__('Enter text used as title of bar.', 'g5plus-academia'),
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Value', 'g5plus-academia'),
                        'param_name' => 'value',
                        'description' => esc_html__('Enter value of bar.', 'g5plus-academia'),
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Color', 'g5plus-academia'),
                        'param_name' => 'color',
                        'value' => array(
                                esc_html__('Default', 'g5plus-academia') => ''
                            ) + array(
                                esc_html__('Primary color', 'g5plus-academia') => 'p-color',
                                esc_html__('Secondary color', 'g5plus-academia') => 's-color',
                                esc_html__('Tertiary color', 'g5plus-academia') => 't-color',
                                esc_html__('Classic Grey', 'g5plus-academia') => 'bar_grey',
                                esc_html__('Classic Blue', 'g5plus-academia') => 'bar_blue',
                                esc_html__('Classic Turquoise', 'g5plus-academia') => 'bar_turquoise',
                                esc_html__('Classic Green', 'g5plus-academia') => 'bar_green',
                                esc_html__('Classic Orange', 'g5plus-academia') => 'bar_orange',
                                esc_html__('Classic Red', 'g5plus-academia') => 'bar_red',
                                esc_html__('Classic Black', 'g5plus-academia') => 'bar_black',
                            ) + getVcShared('colors-dashed') + array(
                                esc_html__('Custom Color', 'g5plus-academia') => 'custom'
                            ),
                        'description' => esc_html__('Select single bar background color.', 'g5plus-academia'),
                        'admin_label' => true,
                        'param_holder_class' => 'vc_colored-dropdown'
                    ),
                    array(
                        'type' => 'colorpicker',
                        'heading' => esc_html__('Custom color', 'g5plus-academia'),
                        'param_name' => 'customcolor',
                        'description' => esc_html__('Select custom single bar value background color.', 'g5plus-academia'),
                        'dependency' => array(
                            'element' => 'color',
                            'value' => array('custom')
                        ),
                    ),
                    array(
                        'type' => 'colorpicker',
                        'heading' => esc_html__('Custom bar color', 'g5plus-academia'),
                        'param_name' => 'custombarcolor',
                        'description' => esc_html__('Select custom single bar background color.', 'g5plus-academia'),
                        'dependency' => array(
                            'element' => 'color',
                            'value' => array('custom')
                        ),
                    ),
                    array(
                        'type' => 'colorpicker',
                        'heading' => esc_html__('Custom label text color', 'g5plus-academia'),
                        'param_name' => 'customtxtcolor',
                        'description' => esc_html__('Select custom single bar label text color.', 'g5plus-academia'),
                        'dependency' => array(
                            'element' => 'color',
                            'value' => array('custom')
                        ),
                    ),
                    array(
                        'type' => 'colorpicker',
                        'heading' => esc_html__('Custom value text color', 'g5plus-academia'),
                        'param_name' => 'customvaluetxtcolor',
                        'description' => esc_html__('Select custom single bar value text color.', 'g5plus-academia'),
                        'dependency' => array(
                            'element' => 'color',
                            'value' => array('custom')
                        ),
                    ),
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Units', 'g5plus-academia'),
                'param_name' => 'units',
                'description' => esc_html__('Enter measurement units (Example: %, px, points, etc. Note: graph value and units will be appended to graph title).', 'g5plus-academia')
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Color', 'g5plus-academia'),
                'param_name' => 'bgcolor',
                'value' => array(
                        esc_html__('Primary color', 'g5plus-academia') => 'p-color',
                        esc_html__('Secondary color', 'g5plus-academia') => 's-color',
                        esc_html__('Tertiary color', 'g5plus-academia') => 't-color',
                        esc_html__('Classic Grey', 'g5plus-academia') => 'bar_grey',
                        esc_html__('Classic Blue', 'g5plus-academia') => 'bar_blue',
                        esc_html__('Classic Turquoise', 'g5plus-academia') => 'bar_turquoise',
                        esc_html__('Classic Green', 'g5plus-academia') => 'bar_green',
                        esc_html__('Classic Orange', 'g5plus-academia') => 'bar_orange',
                        esc_html__('Classic Red', 'g5plus-academia') => 'bar_red',
                        esc_html__('Classic Black', 'g5plus-academia') => 'bar_black',
                    ) + getVcShared('colors-dashed') + array(
                        esc_html__('Custom Color', 'g5plus-academia') => 'custom'
                    ),
                'std' => 'p-color',
                'description' => esc_html__('Select bar background color.', 'g5plus-academia'),
                'admin_label' => true,
                'param_holder_class' => 'vc_colored-dropdown',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Bar value custom background color', 'g5plus-academia'),
                'param_name' => 'custombgcolor',
                'description' => esc_html__('Select custom background color for bars value.', 'g5plus-academia'),
                'dependency' => array('element' => 'bgcolor', 'value' => array('custom'))
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Bar custom background color', 'g5plus-academia'),
                'param_name' => 'custombgbarcolor',
                'description' => esc_html__('Select custom background color for bars.', 'g5plus-academia'),
                'dependency' => array('element' => 'bgcolor', 'value' => array('custom'))
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Bar custom label text color', 'g5plus-academia'),
                'param_name' => 'customtxtcolor',
                'description' => esc_html__('Select custom label text color for bars.', 'g5plus-academia'),
                'dependency' => array('element' => 'bgcolor', 'value' => array('custom'))
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Bar custom value text color', 'g5plus-academia'),
                'param_name' => 'customvaluetxtcolor',
                'description' => esc_html__('Select custom value text color for bars.', 'g5plus-academia'),
                'dependency' => array('element' => 'bgcolor', 'value' => array('custom'))
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Options', 'g5plus-academia'),
                'param_name' => 'options',
                'value' => array(
                    esc_html__('Add stripes', 'g5plus-academia') => 'striped',
                    esc_html__('Add animation (Note: visible only with striped bar).', 'g5plus-academia') => 'animated'
                )
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra class name', 'g5plus-academia'),
                'param_name' => 'el_class',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'g5plus-academia')
            ),
            array(
                'type' => 'css_editor',
                'heading' => esc_html__('CSS box', 'g5plus-academia'),
                'param_name' => 'css',
                'group' => esc_html__('Design Options', 'g5plus-academia')
            ),
        )
    ));
}

add_action('vc_after_init', 'g5plus_register_vc_map');