<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Interactive Banner - 2
*/
if(!class_exists('Ultimate_Interactive_Banner')) 
{
	class Ultimate_Interactive_Banner{
		function __construct(){
			add_action('init',array($this,'banner_init'));
			add_shortcode('interactive_banner_2',array($this,'banner_shortcode'));
		}
		function banner_init(){
			if(function_exists('vc_map'))
			{
				$json = ultimate_get_banner2_json();
				vc_map(
					array(
					   'name' => __('Interactive Banner 2','dfd'),
					   'base' => 'interactive_banner_2',
					   'class' => 'vc_interactive_icon',
					   'icon' => 'vc_icon_interactive',
					   'category' => __('Ronneby 1.0','dfd'),
					   'description' => __('Displays the banner image with Information','dfd'),
					   'params' => array(
							array(
								'type' => 'textfield',
								'class' => '',
								'heading' => __('Title ','dfd'),
								'param_name' => 'banner_title',
								'admin_label' => true,
								'value' => '',
								'description' => __('Give a title to this banner','dfd')
							),
							array(
								'type' => 'textarea',
								'class' => '',
								'heading' => __('Description','dfd'),
								'param_name' => 'banner_desc',
								'value' => '',
								'description' => __('Text that comes on mouse hover.','dfd')
							),
							array(
								'type' => 'attach_image',
								'class' => '',
								'heading' => __('Banner Image','dfd'),
								'param_name' => 'banner_image',
								'value' => '',
								'description' => __('Upload the image for this banner','dfd')
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Link ','dfd'),
								'param_name' => 'banner_link',
								'value' => '',
								'description' => __('Add link / select existing page to link to this banner','dfd'),
							),
							/*array(
								'type' => 'textfield',
								'class' => '',
								'heading' => __('Link Text','dfd'),
								'param_name' => 'banner_link_text',
								'value' => '',
								'description' => __('Enter text for button','dfd'),
								'dependency' => Array('element' => 'link_opts','value' => array('more')),
							),*/
							array(
								'type' => 'ult_select2',
								'class' => '',
								'heading' => __('Styles ','dfd'),
								'param_name' => 'banner_style',
								'value' => '',
								'json' => $json,
								'description' => '',
							),
							/*array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Banner Styles','dfd'),
								'param_name' => 'banner_style',
								'value' => array(
									__('Style 1','dfd') => 'style1',
									__('Style 2','dfd') => 'style2',
									__('Style 3','dfd') => 'style3',
									__('Style 4','dfd') => 'style4',
									__('Style 5','dfd') => 'style5',
									__('Style 6','dfd') => 'style6',
									__('Style 7','dfd') => 'style7',
									__('Style 8','dfd') => 'style8',
									__('Style 9','dfd') => 'style9',
									__('Style 10','dfd') => 'style10',
									__('Style 11','dfd') => 'style11',
									__('Style 12','dfd') => 'style12',
									__('Style 13','dfd') => 'style13',
									__('Style 14','dfd') => 'style14',
									__('Style 15','dfd') => 'style15',
									),
								'description' => __('Select animation effect style for this block.','dfd')
							),*/
							array(
								'type' => 'colorpicker',
								'class' => '',
								'heading' => __('Title Background Color','dfd'),
								'param_name' => 'banner_title_bg',
								'value' => '',
								'description' => '',
								'dependency' => Array('element' => 'banner_style', 'value' => array('style5')),
							),
							array(
								'type' => 'textfield',
								'class' => '',
								'heading' => __('Extra Class', 'dfd'),
								'param_name' => 'el_class',
								'value' => '',
								'description' => __('Add extra class name that will be applied to the icon process, and you can use this class for your customizations.', 'dfd'),
							),
							array(
								'type' => 'text',
								'heading' => __('<h2>Title Settings</h2>', 'dfd'),
								'param_name' => 'banner_title_typograpy',
								'dependency' => Array('element' => 'banner_title', 'not_empty' => true),
								'group' => 'Typography',
							),
							array(
								'type' => 'ultimate_google_fonts',
								'heading' => __('Font Family', 'dfd'),
								'param_name' => 'banner_title_font_family',
								"description" => __("Select the font of your choice. You can <a target='_blank' href='".admin_url('admin.php?page=ultimate-font-manager')."'>add new in the collection here</a>.", 'dfd'),
								'dependency' => Array('element' => 'banner_title', 'not_empty' => true),
								'group' => 'Typography'
							),
							array(
								'type' => 'ultimate_google_fonts_style',
								'heading' 		=>__('Font Style', 'dfd'),
								'param_name'	=>	'banner_title_style',
								'dependency' => Array('element' => 'banner_title', 'not_empty' => true),
								'group' => 'Typography'
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Font Size', 'dfd'),
								'param_name' => 'banner_title_font_size',
								'min' => 12,
								'suffix' => 'px',
								'dependency' => Array('element' => 'banner_title', 'not_empty' => true),
								'group' => 'Typography',
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Letter Spacing', 'dfd'),
								'param_name' => 'banner_title_letter_spacing',
								'min' => 12,
								'suffix' => 'px',
								'dependency' => Array('element' => 'banner_title', 'not_empty' => true),
								'group' => 'Typography',
							),
							array(
								'type' => 'text',
								'heading' => __('<h2>Description Settings</h2>', 'dfd'),
								'param_name' => 'banner_desc_typograpy',
								'group' => 'Typography',
							),
							array(
								'type' => 'ultimate_google_fonts',
								'heading' => __('Font Family', 'dfd'),
								'param_name' => 'banner_desc_font_family',
								"description" => __("Select the font of your choice. You can <a target='_blank' href='".admin_url('admin.php?page=ultimate-font-manager')."'>add new in the collection here</a>.", 'dfd'),
								'dependency' => Array('element' => 'banner_desc', 'not_empty' => true),
								'group' => 'Typography'
							),
							array(
								'type' => 'ultimate_google_fonts_style',
								'heading' 		=>	__('Font Style', 'dfd'),
								'param_name'	=>	'banner_desc_style',
								'dependency' => Array('element' => 'banner_desc', 'not_empty' => true),
								'group' => 'Typography'
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Font Size', 'dfd'),
								'param_name' => 'banner_desc_font_size',
								'min' => 12,
								'suffix' => 'px',
								'dependency' => Array('element' => 'banner_desc', 'not_empty' => true),
								'group' => 'Typography',
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Letter Spacing', 'dfd'),
								'param_name' => 'banner_desc_letter_spacing',
								'min' => 12,
								'suffix' => 'px',
								'dependency' => Array('element' => 'banner_desc', 'not_empty' => true),
								'group' => 'Typography',
							),
							array(
								'type' => 'colorpicker',
								'class' => '',
								'heading' => __('Title Color','dfd'),
								'param_name' => 'banner_color_title',
								'value' => '',
								'description' => '',
								'group' => 'Color Settings',
							),
							array(
								'type' => 'colorpicker',
								'class' => '',
								'heading' => __('Description Color','dfd'),
								'param_name' => 'banner_color_desc',
								'value' => '',
								'description' => '',
								'group' => 'Color Settings',
							),
							array(
								'type' => 'colorpicker',
								'class' => '',
								'heading' => __('Background Color','dfd'),
								'param_name' => 'banner_color_bg',
								'value' => '',
								'description' => '',
								'group' => 'Color Settings',
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Image Opacity', 'dfd'),
								'param_name' => 'image_opacity',
								'value' => 1,
								'min' => 0.0,
								'max' => 1.0,
								'step' => 0.1,
								'suffix' => '',
								'description' => __('Enter value between 0.0 to 1 (0 is maximum transparency, while 1 is lowest)','dfd'),
								'group' => 'Color Settings',
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Image Opacity on Hover', 'dfd'),
								'param_name' => 'image_opacity_on_hover',
								'value' => 1,
								'min' => 0.0,
								'max' => 1.0,
								'step' => 0.1,
								'suffix' => '',
								'description' => __('Enter value between 0.0 to 1 (0 is maximum transparency, while 1 is lowest)','dfd'),
								'group' => 'Color Settings',
							),
							array(
								'type' => 'checkbox',
								'class' => '',
								'heading' => __('Responsive Nature','dfd'),
								'param_name' => 'enable_responsive',
								'value' => array('Enable Responsive Behaviour' => 'yes'),
								'description' => __('If the description text is not suiting well on specific screen sizes, you may enable this option - which will hide the description text.','dfd'),
								'group' => 'Responsive',
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Minimum Screen Size', 'dfd'),
								'param_name' => 'responsive_min',
								'value' => 768,
								'min' => 100,
								'max' => 1000,
								'suffix' => 'px',
								'dependency' => Array('element' => 'enable_responsive', 'value' => 'yes'),
								'description' => __('Provide the range of screen size where you would like to hide the description text.','dfd'),
								'group' => 'Responsive',
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Maximum Screen Size', 'dfd'),
								'param_name' => 'responsive_max',
								'value' => 900,
								'min' => 100,
								'max' => 1000,
								'suffix' => 'px',
								'dependency' => Array('element' => 'enable_responsive', 'value' => 'yes'),
								'description' => __('Provide the range of screen size where you would like to hide the description text.','dfd'),	
								'group' => 'Responsive',
							),
							array(
								'type' => 'heading',
								"sub_heading" => "<span style='display: block;'><a href='http://bsf.io/n8o33' target='_blank'>Watch Video Tutorial &nbsp; <span class='dashicons dashicons-video-alt3' style='font-size:30px;vertical-align: middle;color: #e52d27;'></span></a></span>",
								'param_name' => 'notification',
								'edit_field_class' => 'ult-param-important-wrapper ult-dashicon ult-align-right ult-bold-font ult-blue-font vc_column vc_col-sm-12',
							),
							array(
								'type'        => 'dropdown',
								'class'       => '',
								'heading'     => __( 'Animation', 'dfd' ),
								'param_name'  => 'module_animation',
								'value'       => dfd_module_animation_styles(),
								'description' => __( '', 'dfd' ),
								'group'       => 'Animation Settings',
							),
						),
					)
				);
			}
		}
		// Shortcode handler function for stats banner
		function banner_shortcode($atts)
		{
			$banner_title = $banner_desc = $banner_image = $banner_link = $banner_style = $module_animation = $el_class = '';
			$banner_title_font_family=$banner_title_style = $banner_title_font_size = $banner_title_letter_spacing = $banner_desc_font_family = $banner_desc_style = $banner_desc_font_size = $banner_desc_letter_spacing = '';
			$banner_title_style_inline = $banner_desc_style_inline = $banner_color_bg = $banner_color_title = $banner_color_desc = $banner_title_bg = '';
			$image_opacity = $image_opacity_on_hover = $enable_responsive = $responsive_min = $responsive_max = '';
			extract(shortcode_atts( array(
				'banner_title' => '',
				'banner_desc' => '',
				'banner_title_location' => '',
				'banner_image' => '',
				'image_opacity' => '1',
				'image_opacity_on_hover' => '1',
				'banner_height'=>'',
				'banner_height_val'=>'',
				'banner_link' => '',
				/*'banner_link_text' => '',*/
				'banner_style' => '',
				'banner_title_font_family' => '',
				'banner_title_style' => '',
				'banner_title_font_size' => '',
				'banner_title_letter_spacing' => '',
				'banner_desc_font_family' => '',
				'banner_desc_style' => '',
				'banner_desc_font_size' => '',
				'banner_desc_letter_spacing' => '',
				'banner_color_bg' => '',
				'banner_color_title' => '',
				'banner_color_desc' => '',
				'banner_title_bg' => '',
				'enable_responsive' => '',
				'responsive_min' => '768',
				'responsive_max' => '900',
				'module_animation' => '',
				'el_class' =>'',
			),$atts));
			$output = $style = $target = $link = $banner_style_inline = $title_bg = $img_style = $responsive = '';
			//$banner_style = 'style01';
			
			if($enable_responsive == "yes") {
				$responsive .= 'data-min-width="'.esc_attr($responsive_min).'" data-max-width="'.esc_attr($responsive_max).'"';
				$el_class .= "ult-ib-resp";
			}
			
			if($banner_title_bg !== '' && $banner_style == "style5") {
				$title_bg .= 'background:'.esc_attr($banner_title_bg).';';
			}
			
			$img = wp_get_attachment_image_src( $banner_image, 'full');
			if($banner_link !== '') {
				$href = vc_build_link($banner_link);
				$link = $href['url'];
				$target = (isset($href['target'])) ? preg_replace('/\s+/', '', $href['target']) : '';
			} else {
				$link = "#";
			}
			
			if($banner_title_font_family != '') {
				$bfamily = get_ultimate_font_family($banner_title_font_family);
				if($bfamily != '') {
					$banner_title_style_inline = 'font-family:\''.esc_attr($bfamily).'\';';
				}
			}
			$banner_title_style_inline .= get_ultimate_font_style($banner_title_style);
			if($banner_title_font_size != '') {
				$banner_title_style_inline .= 'font-size:'.esc_attr($banner_title_font_size).'px;';
			}
			
			if($banner_title_letter_spacing != '') {
				$banner_title_style_inline .= 'letter-spacing:'.esc_attr($banner_title_letter_spacing).'px;';
			}
				
			if($banner_desc_font_family != '') {
				$bdfamily = get_ultimate_font_family($banner_desc_font_family);
				if($bdfamily != '') {
					$banner_desc_style_inline = 'font-family:\''.esc_attr($bdfamily).'\';';
				}
			}
			$banner_desc_style .= get_ultimate_font_style($banner_desc_style);
			if($banner_desc_font_size != '') {
				$banner_desc_style_inline .= 'font-size:'.esc_attr($banner_desc_font_size).'px;';
			}
			
			if($banner_desc_letter_spacing != '') {
				$banner_desc_style_inline .= 'letter-spacing:'.esc_attr($banner_desc_letter_spacing).'px;';
			}
			
			if($banner_color_bg != '') {
				$banner_style_inline .= 'background:'.esc_attr($banner_color_bg).';';
			}

			if($banner_color_title != '') {
				$banner_title_style_inline .= 'color:'.esc_attr($banner_color_title).';';
			}

			if($banner_color_desc != '') {
				$banner_desc_style_inline .= 'color:'.esc_attr($banner_color_desc).';';
			}

			//enqueue google font
			$args = array(
				$banner_title_font_family, $banner_desc_font_family
			);
			enquque_ultimate_google_fonts($args);
			
			if($image_opacity !== ''){
				$img_style .= 'opacity:'.esc_attr($image_opacity).';';
			}
			
			if($link !== "#")
				$href = 'href="'.esc_url($link).'"';
			else 
				$href = '';

			$animate = $animation_data = '';

			if ( ! ( $module_animation == '' ) ) {
				$animate        = ' cr-animate-gen';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}

			$output .= '<div class="ult-new-ib ult-ib-effect-'.esc_attr($banner_style).' '.esc_attr($el_class).' '.esc_attr($animate).'" '.$responsive.' style="'.$banner_style_inline.'" data-opacity="'.$image_opacity.'" data-hover-opacity="'.$image_opacity_on_hover.'" '.$animation_data.'>';

			$output .= '<img class="ult-new-ib-img" style="'.$img_style.'" alt="'.esc_attr($banner_title).'" src="'.esc_url($img[0]).'"/>';

			$output .= '<div class="ult-new-ib-desc" style="'.$title_bg.'">';
			$output .= '<h2 class="ult-new-ib-title" style="'.$banner_title_style_inline.'">'.$banner_title.'</h2>';
			$output .= '<p class="ult-new-ib-content" style="'.$banner_desc_style_inline.'">'.$banner_desc.'</p>';
			$output .= '</div>';
			if($target != '')
				$target = 'target="'.$target.'"';
			$output .= '<a class="ult-new-ib-link" '.$href.' '.$target.'></a>';
			$output .= '</div>';

			return $output;
		}
	}
}
if(class_exists('Ultimate_Interactive_Banner'))
{
	$Ultimate_Interactive_Banner = new Ultimate_Interactive_Banner;
}
