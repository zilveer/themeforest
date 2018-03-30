<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Icons Block for Visual Composer
*/
if(!class_exists('Old_Dfd_Icons')) 
{
	class Old_Dfd_Icons
	{
		function __construct()
		{
			add_action('init',array($this,'ultimate_icon_init'));
			add_shortcode('ultimate_icons',array($this,'ultimate_icons_shortcode'));
			add_shortcode('single_icon',array($this,'single_icon_shortcode'));
		}
		function ultimate_icon_init() {
			if(function_exists('vc_map')) {
				vc_map(
					array(
						'name' => __('Icons', 'dfd'),
						'base' => 'ultimate_icons',
						'class' => 'ultimate_icons',
						'icon' => 'ultimate_icons',
						'category' => __('Ronneby 1.0','dfd'),
						'description' => __('Add a set of multiple icons and give some custom style.','dfd'),
						'as_parent' => array('only' => 'single_icon'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
						'content_element' => true,
						'show_settings_on_create' => true,
						'js_view' => 'VcColumnView',
						'params' => array(							
							// Play with icon selector
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Alignment','dfd'),
								'param_name' => 'align',
								'value' => array(
									__('Left Align','dfd') => 'uavc-icons-left',
									__('Right Align','dfd') => 'uavc-icons-right',
									__('Center Align','dfd') => 'uavc-icons-center'
								),
								'description' => __('', 'dfd'),
							),
							array(
								'type' => 'textfield',
								'class' => '',
								'heading' => __('Extra Class','dfd'),
								'param_name' => 'el_class',
								'value' => '',
								'description' => __('Write your own CSS and mention the class name here.', 'dfd'),
							),
						)
					)
				);
				vc_map(
					array(
					   'name' => __('Icon Item', 'dfd'),
					   'base' => 'single_icon',
					   'class' => 'vc_simple_icon',
					   'icon' => 'vc_just_icon',
					   'category' => __('DFD VC Addons','dfd'),
					   'description' => __('Add a set of multiple icons and give some custom style.','dfd'),
					   'as_child' => array('only' => 'ultimate_icons'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
					   'show_settings_on_create' => true,
					   'params' => array(
							// Play with icon selector
							array(
								'type' => 'icon_manager',
								'class' => '',
								'heading' => __('Select Icon ','dfd'),
								'param_name' => 'icon',
								'value' => '',
								'admin_label' => true,
								'description' => __('Click and select icon of your choice. If you can\'t find the one that suits for your purpose, you can <a href="admin.php?page=font-icon-Manager" target="_blank">add new here</a>.', 'dfd'),
								'group'=> 'Select Icon',
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Size of Icon', 'dfd'),
								'param_name' => 'icon_size',
								'value' => 32,
								'min' => 12,
								'max' => 72,
								'suffix' => 'px',
								'description' => __('How big would you like it?', 'dfd'),
								'group'=> 'Select Icon',
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Space after Icon', 'dfd'),
								'param_name' => 'icon_margin',
								'value' => 5,
								'min' => 0,
								'max' => 100,
								'suffix' => 'px',
								'description' => __('How much distance would you like in two icons?', 'dfd'),
								'group' => 'Other Settings'
							),
							array(
								'type' => 'colorpicker',
								'class' => '',
								'heading' => __('Color', 'dfd'),
								'param_name' => 'icon_color',
								'value' => '#333333',
								'description' => __('Give it a nice paint!', 'dfd'),
								'group'=> 'Select Icon',
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Icon Style', 'dfd'),
								'param_name' => 'icon_style',
								'value' => array(
									__('Simple','dfd') => 'none',
									__('Circle Background','dfd') => 'circle',
									__('Square Background','dfd') => 'square',
									__('Design your own','dfd') => 'advanced',
								),
								'description' => __('We have given three quick preset if you are in a hurry. Otherwise, create your own with various options.', 'dfd'),
								'group' => 'Select Icon'
							),
							array(
								'type' => 'colorpicker',
								'class' => '',
								'heading' => __('Background Color', 'dfd'),
								'param_name' => 'icon_color_bg',
								'value' => '#ffffff',
								'description' => __('Select background color for icon.', 'dfd'),	
								'dependency' => Array('element' => 'icon_style', 'value' => array('circle','square','advanced')),
								'group' => 'Select Icon'
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Icon Border Style', 'dfd'),
								'param_name' => 'icon_border_style',
								'value' => array(
									__('None','dfd')=> '',
									__('Solid','dfd')=> 'solid',
									__('Dashed','dfd') => 'dashed',
									__('Dotted','dfd') => 'dotted',
									__('Double','dfd') => 'double',
									__('Inset','dfd') => 'inset',
									__('Outset','dfd') => 'outset',
								),
								'description' => __('Select the border style for icon.','dfd'),
								'dependency' => Array('element' => 'icon_style', 'value' => array('advanced')),
								'group' => 'Select Icon'
							),
							array(
								'type' => 'colorpicker',
								'class' => '',
								'heading' => __('Border Color', 'dfd'),
								'param_name' => 'icon_color_border',
								'value' => '#333333',
								'description' => __('Select border color for icon.', 'dfd'),	
								'dependency' => Array('element' => 'icon_border_style', 'not_empty' => true),
								'group' => 'Select Icon'
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Border Width', 'dfd'),
								'param_name' => 'icon_border_size',
								'value' => 1,
								'min' => 1,
								'max' => 10,
								'suffix' => 'px',
								'description' => __('Thickness of the border.', 'dfd'),
								'dependency' => Array('element' => 'icon_border_style', 'not_empty' => true),
								'group' => 'Select Icon'
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Border Radius', 'dfd'),
								'param_name' => 'icon_border_radius',
								'value' => 50,
								'min' => 1,
								'max' => 500,
								'suffix' => 'px',
								'description' => __('0 pixel value will create a square border. As you increase the value, the shape convert in circle slowly. (e.g 500 pixels).', 'dfd'),
								'dependency' => Array('element' => 'icon_border_style', 'not_empty' => true),
								'group' => 'Select Icon'
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Background Size', 'dfd'),
								'param_name' => 'icon_border_spacing',
								'value' => 50,
								'min' => 30,
								'max' => 500,
								'suffix' => 'px',
								'description' => __('Spacing from center of the icon till the boundary of border / background', 'dfd'),
								'dependency' => Array('element' => 'icon_border_style', 'not_empty' => true),
								'group' => 'Select Icon'
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Link ','dfd'),
								'param_name' => 'icon_link',
								'value' => '',
								'description' => __('Add a custom link or select existing page. You can remove existing link as well.','dfd'),
								'group' => 'Other Settings'
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Animation','dfd'),
								'param_name' => 'icon_animation',
								'value' => array(
							 		__('No Animation','dfd') => '',
									__('Swing','dfd') => 'swing',
									__('Pulse','dfd') => 'pulse',
									__('Fade In','dfd') => 'fadeIn',
									__('Fade In Up','dfd') => 'fadeInUp',
									__('Fade In Down','dfd') => 'fadeInDown',
									__('Fade In Left','dfd') => 'fadeInLeft',
									__('Fade In Right','dfd') => 'fadeInRight',
									__('Fade In Up Long','dfd') => 'fadeInUpBig',
									__('Fade In Down Long','dfd') => 'fadeInDownBig',
									__('Fade In Left Long','dfd') => 'fadeInLeftBig',
									__('Fade In Right Long','dfd') => 'fadeInRightBig',
									__('Slide In Down','dfd') => 'slideInDown',
									__('Slide In Left','dfd') => 'slideInLeft',
									__('Slide In Left','dfd') => 'slideInLeft',
									__('Bounce In','dfd') => 'bounceIn',
									__('Bounce In Up','dfd') => 'bounceInUp',
									__('Bounce In Down','dfd') => 'bounceInDown',
									__('Bounce In Left','dfd') => 'bounceInLeft',
									__('Bounce In Right','dfd') => 'bounceInRight',
									__('Rotate In','dfd') => 'rotateIn',
									__('Light Speed In','dfd') => 'lightSpeedIn',
									__('Roll In','dfd') => 'rollIn',
									),
								'description' => __('Like CSS3 Animations? We have several options for you!','dfd'),
								'group' => 'Other Settings'
						  	),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Tooltip', 'dfd'),
								'param_name' => 'tooltip_disp',
								'value' => array(
									__('None','dfd')=> '',
									__('Tooltip from Left','dfd') => 'left',
									__('Tooltip from Right','dfd') => 'right',
									__('Tooltip from Top','dfd') => 'top',
									__('Tooltip from Bottom','dfd') => 'bottom',
								),
								'description' => __('Select the tooltip position','dfd'),
								'group' => 'Other Settings'
							),							
							array(
								'type' => 'textfield',
								'class' => '',
								'heading' => __('Tooltip Text', 'dfd'),
								'param_name' => 'tooltip_text',
								'value' => '',
								'description' => __('Enter your tooltip text here.', 'dfd'),
								'dependency' => Array('element' => 'tooltip_disp', 'not_empty' => true),
								'group' => 'Other Settings'
							),
							array(
								'type' => 'textfield',
								'class' => '',
								'heading' => __('Custom CSS Class', 'dfd'),
								'param_name' => 'el_class',
								'value' => '',
								'description' => __('Ran out of options? Need more styles? Write your own CSS and mention the class name here.', 'dfd'),
								'group' => 'Select Icon'
							),
						),
					)
				);
			}
		}
		// Shortcode handler function for stats Icon
		function ultimate_icons_shortcode($atts,$content = null) {
			$align = $el_class = '';
			extract(shortcode_atts(array(
				'align' => 'uavc-icons-left',
				'el_class' => ''
			),$atts));
			
			$output = '<div class="'.esc_attr($align).' uavc-icons '.esc_attr($el_class).'">';
			$output .= do_shortcode($content);
			$output .= '</div>';
			
			return $output;
		}
		
		function single_icon_shortcode($atts) {
			
			$icon_type = $icon_img = $img_width = $icon = $icon_color = $icon_color_bg = $icon_size = $icon_style = $icon_border_style = $icon_border_radius = $icon_color_border = $icon_border_size = $icon_border_spacing = $icon_link = $el_class = $icon_animation =  $tooltip_disp = $tooltip_text = $icon_margin = '';
			extract(shortcode_atts( array(
				'icon'=> '',				
				'icon_size' => '32',				
				'icon_margin' => '5',
				'icon_color' => '#333333',
				'icon_style' => 'none',
				'icon_color_bg' => '#ffffff',
				'icon_border_style' => '',
				'icon_color_border' => '#333333',			
				'icon_border_size' => '1',
				'icon_border_radius' => '50',
				'icon_border_spacing' => '50',
				'icon_link' => '',
				'icon_animation' => '',
				'tooltip_disp' => '',
				'tooltip_text' => '',
				'el_class'=>'',
			),$atts));
			/*
			$ultimate_js = get_option('ultimate_js');
			if(isset($tooltip_disp) && $tooltip_disp != '' && $ultimate_js != 'enable')
				wp_enqueue_script('aio-tooltip',get_template_directory_uri().'/inc/vc_custom/dfd_vc_addons/assets/min-js/tooltip.min.js',array('jquery'));
			*/	
			if($icon_animation !== 'none')
			{
				$css_trans = 'data-animation="'.esc_attr($icon_animation).'" data-animation-delay="03"';
			}
			$output = $style = $link_sufix = $link_prefix = $target = $href = $icon_align_style = '';
			$uniqid = uniqid();
			if($icon_link !== ''){
				$href = vc_build_link($icon_link);
				$target = (isset($href['target'])) ? "target='".esc_attr(preg_replace('/\s+/', '', $href['target']))."'" : '';
				$link_prefix .= '<a class="aio-tooltip '.esc_attr($uniqid).'" href = "'.esc_url($href['url']).'" '.$target.' data-toggle="tooltip" data-placement="'.esc_attr($tooltip_disp).'" title="'.esc_attr($tooltip_text).'">';
				$link_sufix .= '</a>';
			} else {
				if($tooltip_disp !== ""){
					$link_prefix .= '<span class="aio-tooltip '.esc_attr($uniqid).'" href = "'.esc_url($href).'" '.$target.' data-toggle="tooltip" data-placement="'.esc_attr($tooltip_disp).'" title="'.esc_attr($tooltip_text).'">';
					$link_sufix .= '</span>';
				}
			}
						
			if($icon_color !== '')
				$style .= 'color:'.esc_attr($icon_color).';';
			if($icon_style !== 'none'){
				if($icon_color_bg !== '')
					$style .= 'background:'.esc_attr($icon_color_bg).';';
			}
			if($icon_style == 'advanced'){
				$style .= 'border-style:'.esc_attr($icon_border_style).';';
				$style .= 'border-color:'.esc_attr($icon_color_border).';';
				$style .= 'border-width:'.esc_attr($icon_border_size).'px;';
				$style .= 'width:'.esc_attr($icon_border_spacing).'px;';
				$style .= 'height:'.esc_attr($icon_border_spacing).'px;';
				$style .= 'line-height:'.esc_attr($icon_border_spacing).'px;';
				$style .= 'border-radius:'.esc_attr($icon_border_radius).'px;';
			}
			if($icon_size !== '')
				$style .='font-size:'.esc_attr($icon_size).'px;';
			
			if($icon_margin !== '')
				$style .= 'margin-right:'.esc_attr($icon_margin).'px;';
			
			if($icon !== ""){
				$output .= "\n".$link_prefix.'<div class="aio-icon '.esc_attr($icon_style).' '.esc_attr($el_class).'" '.$css_trans.' style="'.$style.'">';				
				$output .= "\n\t".'<i class="'.esc_attr($icon).'"></i>';	
				$output .= "\n".'</div>'.$link_sufix;
			}
			//$output .= do_shortcode($content);
			if($tooltip_disp !== ""){
				$output .= '<script>
					jQuery(function () {
						jQuery(".'.esc_js($uniqid).'").bsf_tooltip("hide");
					});
				</script>';
			}			
			return $output;
		}
	}
}
if(class_exists('Old_Dfd_Icons'))
{
	$Old_Dfd_Icons = new Old_Dfd_Icons;
}
//Extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) && !class_exists('WPBakeryShortCode_ultimate_icons') ) {
    class WPBakeryShortCode_ultimate_icons extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) && !class_exists('WPBakeryShortCode_single_icon') ) {
    class WPBakeryShortCode_single_icon extends WPBakeryShortCode {
    }
}