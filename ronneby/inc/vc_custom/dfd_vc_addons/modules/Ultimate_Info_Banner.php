<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Info Banner
*/
if(!class_exists('Old_Dfd_Info_Banner')) 
{
	class Old_Dfd_Info_Banner{
		function __construct(){
			add_action('init',array($this,'banner_init'));
			add_shortcode('ultimate_info_banner',array($this,'banner_shortcode'));
			add_action('wp_enqueue_scripts', array($this, 'register_info_banner_assets'),1);
		}
		function register_info_banner_assets()
		{
			wp_register_script('utl-info-banner-script',get_template_directory_uri().'/inc/vc_custom/dfd_vc_addons/assets/min-js/info-banner.min.js',array('jquery'), null);
			wp_register_style('utl-info-banner-style',get_template_directory_uri().'/inc/vc_custom/dfd_vc_addons/assets/min-css/info-banner.min.css',array('jquery'), null);
		}
		function banner_init(){
			if(function_exists('vc_map'))
			{
				vc_map(
					array(
					   "name" => __("Info Banner",'dfd'),
					   "base" => "ultimate_info_banner",
					   "class" => "vc_info_banner_icon",
					   "icon" => "vc_icon_info_banner",
					   "category" => __('Ronneby 1.0','dfd'),
					   "description" => __("Displays the banner information",'dfd'),
					   "params" => array(
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Icon to display:", 'dfd'),
								"param_name" => "icon_type",
								"value" => array(
									__('Font Icon Manager','dfd') => "selector",
									__('Custom Image Icon','dfd') => "custom",
								),
								"description" => __("Use an existing font icon</a> or upload a custom image.", 'dfd')
							),
							array(
								"type" => "icon_manager",
								"class" => "",
								"heading" => __("Select Icon ",'dfd'),
								"param_name" => "icon",
								"value" => "",
								"description" => __("Click and select icon of your choice. If you can't find the one that suits for your purpose, you can <a href='admin.php?page=font-icon-Manager' target='_blank'>add new here</a>.", 'dfd'),
								"dependency" => Array("element" => "icon_type","value" => array("selector")),
							),
							array(
								"type" => "attach_image",
								"class" => "",
								"heading" => __("Upload Image Icon:", 'dfd'),
								"param_name" => "icon_img",
								"value" => "",
								"description" => __("Upload the custom image icon.", 'dfd'),
								"dependency" => Array("element" => "icon_type","value" => array("custom")),
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Image Width", 'dfd'),
								"param_name" => "img_width",
								"value" => 48,
								"min" => 16,
								"max" => 512,
								"suffix" => "px",
								"description" => __("Provide image width", 'dfd'),
								"dependency" => Array("element" => "icon_type","value" => array("custom")),
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Size of Icon", 'dfd'),
								"param_name" => "icon_size",
								"value" => 32,
								"min" => 12,
								"max" => 72,
								"suffix" => "px",
								"description" => __("How big would you like it?", 'dfd'),
								"dependency" => Array("element" => "icon_type","value" => array("selector")),
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Color", 'dfd'),
								"param_name" => "icon_color",
								"value" => "#333333",
								"description" => __("Give it a nice paint!", 'dfd'),
								"dependency" => Array("element" => "icon_type","value" => array("selector")),						
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Icon Style", 'dfd'),
								"param_name" => "icon_style",
								"value" => array(
									__('Simple','dfd') => "none",
									__('Circle Background','dfd') => "circle",
									__('Square Background','dfd') => "square",
									__('Design your own','dfd') => "advanced",
								),
								"description" => __("We have given three quick preset if you are in a hurry. Otherwise, create your own with various options.", 'dfd'),
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Background Color", 'dfd'),
								"param_name" => "icon_color_bg",
								"value" => "#ffffff",
								"description" => __("Select background color for icon.", 'dfd'),	
								"dependency" => Array("element" => "icon_style", "value" => array("circle","square","advanced")),
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Icon Border Style", 'dfd'),
								"param_name" => "icon_border_style",
								"value" => array(
									__('None','dfd') => "",
									__('Solid','dfd')=> "solid",
									__('Dashed','dfd') => "dashed",
									__('Dotted','dfd') => "dotted",
									__('Double','dfd') => "double",
									__('Inset','dfd') => "inset",
									__('Outset','dfd') => "outset",
								),
								"description" => __("Select the border style for icon.",'dfd'),
								"dependency" => Array("element" => "icon_style", "value" => array("advanced")),
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Border Color", 'dfd'),
								"param_name" => "icon_color_border",
								"value" => "#333333",
								"description" => __("Select border color for icon.", 'dfd'),	
								"dependency" => Array("element" => "icon_border_style", "not_empty" => true),
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Border Width", 'dfd'),
								"param_name" => "icon_border_size",
								"value" => 1,
								"min" => 1,
								"max" => 10,
								"suffix" => "px",
								"description" => __("Thickness of the border.", 'dfd'),
								"dependency" => Array("element" => "icon_border_style", "not_empty" => true),
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Border Radius", 'dfd'),
								"param_name" => "icon_border_radius",
								"value" => 50,
								"min" => 1,
								"max" => 500,
								"suffix" => "px",
								"description" => __("0 pixel value will create a square border. As you increase the value, the shape convert in circle slowly. (e.g 500 pixels).", 'dfd'),
								"dependency" => Array("element" => "icon_border_style", "not_empty" => true),
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Background Size", 'dfd'),
								"param_name" => "icon_border_spacing",
								"value" => 50,
								"min" => 30,
								"max" => 500,
								"suffix" => "px",
								"description" => __("Spacing from center of the icon till the boundary of border / background", 'dfd'),
								"dependency" => Array("element" => "icon_style", "value" => array("advanced")),
							),

					   		array(
								"type" => "textarea",
								"class" => "",
								"heading" => __("Title ",'dfd'),
								"param_name" => "banner_title",
								"admin_label" => true,
								"value" => "",
								"description" => __("Give a title to this banner",'dfd')
							),
							array(
								"type" => "textarea_html",
								"class" => "",
								"heading" => __("Description",'dfd'),
								"param_name" => "content",
								"value" => "",
								//"description" => __("Text that comes on mouse hover.",'dfd')
							),
							array(
								"type" => "dropdown",
								"heading" => __('Information Alignment','dfd'),
								"param_name" => "info_alignment",
								"value" => array(
									__('Center','dfd') => "text-center",
									__('Left','dfd') => "text-left",
									__('Right','dfd') => "text-right"
								)
							),
							array(
								"type" => "dropdown",
								"heading" => __('Animation Effect','dfd'),
								"param_name" => "info_effect",
								"value" => array(
									__('No Effect','dfd') => "",
									__('Fade-In','dfd') => "fadeIn",
									__('Fade-In Left','dfd') => "fadeInLeft",
									__('Fade-In Right','dfd') => "fadeInRight",
									__('Fade-In Up','dfd') => "fadeInUp",
									__('Fade-In Down','dfd') => "fadeInDown",
									__('Flip','dfd') => "flipInX",
									__('Zoom','dfd') => "zoomIn"
								)
							),
							array(
								"type" => "attach_image",
								"class" => "",
								"heading" => __("Banner Image",'dfd'),
								"param_name" => "banner_image",
								"value" => "",
								"description" => __("Upload the image for this banner",'dfd'),
								"group" => "Image",
							),
							array(
								"type" => "dropdown",
								"heading" => __('Image Alignment','dfd'),
								"param_name" => "ib3_alignment",
								"value" => array(
									__("Top Left","js_composer") => "ultb3-img-top-left",
									__("Top Center","js_composer") => "ultb3-img-top-center",
									__("Top Right","js_composer") => "ultb3-img-top-right",
									__("Center Left","js_composer") => "ultb3-img-center-left",
									__("Center","js_composer") => "ultb3-img-center",
									__("Center Right","js_composer") => "ultb3-img-center-right",
									__("Bottom Left","js_composer") => "ultb3-img-bottom-left",
									__("Bottom Center","js_composer") => "ultb3-img-bottom-center",
									__("Bottom Right","js_composer") => "ultb3-img-bottom-right",
								),
								"group" => "Image",
							),
							array(
								"type" => "dropdown",
								"heading" => __('Effect','dfd'),
								"param_name" => "ib3_effect",
								"value" => array(
									__("No Effect","js_composer") => "",
									__("Slide Down","js_composer") => "ultb3-hover-1",
									__("Slide Up","js_composer") => "ultb3-hover-2",
									__("Slide Left","js_composer") => "ultb3-hover-3",
									__("Slide Right","js_composer") => "ultb3-hover-4",
									__("Pan","js_composer") => "ultb3-hover-5",
									__("Zoom Out","js_composer") => "ultb3-hover-6"
								),
								"group" => "Image",
							),
							array(
								"type" => "colorpicker",
								"heading" => __('Background Color', 'dfd'),
								"param_name" => "ib3_background",
								"group" => "Image",
							),
							array(
								"type" => "colorpicker",
								"heading" => __('Overlay Color on Image','dfd'),
								"param_name" => "overlay_color",
								"value" => "",
								"group" => "Image",
								//"dependency" => array("element" => "enable_overlay", "value" => array("enable_overlay_value"))
							),	
							array(
								"type" => "ult_param_heading",
								"text" => __('Sizing','dfd'),
								"param_name" => "image_height_typography",
								"class" => "ult-param-heading",
								"group" => "Image",
								'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
							),
						   array(
								"type" => "number",
								"param_name" => "module_min_height",
								"heading" => __('Module min height', 'dfd'),
								"min" => "50",
								"value" => "",
								"group" => "Image",
								'edit_field_class' => 'vc_column vc_col-sm-3',
							),
							array(
								"type" => "number",
								"param_name" => "banner_img_width",
								"heading" => __('Image width', 'dfd'),
								"min" => "50",
								"value" => "",
								"group" => "Image",
								'edit_field_class' => 'vc_column vc_col-sm-3',
							),
							array(
								"type" => "number",
								"param_name" => "banner_img_height",
								"heading" => __('Image height', 'dfd'),
								"min" => "50",
								"value" => "",
								"group" => "Image",
								'edit_field_class' => 'vc_column vc_col-sm-3',
							),
							array(
								'type' => 'checkbox',
								'class' => '',
								'heading' => __('Crop image','dfd'),
								'param_name' => 'banner_image_crop',
								'value' => array('Yes, please' => 'yes'),
								'edit_field_class' => 'vc_column vc_col-sm-3',
								"group" => "Image"
							),
							array(
								"type" => "dropdown",
								"heading" => __('Border','dfd'),
								"param_name" => "ib3_border",
								"value" => array(
									__('No Border', 'dfd') => "no-border",
									__('Solid', 'dfd') => "solid",
									__('Dashed','dfd') => "dashed",
									__('Dotted','dfd') => "dotted",
									__('Double','dfd') => "double"
								),
								"group" => "Design" 
							),
							array(
								"type" => "number",
								"heading" => __('Border Width', 'dfd'),
								"param_name" => "ib3_border_width",
								"suffix" => "px",
								"value" => "1",
								"group" => "Design",
								"dependency" => array("element" => "ib3_border", "value" => array("solid","dashed","dotted","double"))
							),
							array(
								"type" => "colorpicker",
								"heading" => __('Border Color', 'dfd'),
								"param_name" => "ib3_border_color",
								"group" => "Design",
								"dependency" => array("element" => "ib3_border", "value" => array("solid","dashed","dotted","double"))
							),
							array(
								"type" => "ult_param_heading",
								"text" => __("Title Settings", 'dfd'),
								"param_name" => "title_typograpy",
								"group" => "Typography",
								"class" => "ult-param-heading",
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
							),
							array(
								"type" => "ultimate_google_fonts",
								"heading" => __("Font Family", 'dfd'),
								"param_name" => "title_font_family",
								"description" => __("Select the font of your choice. You can <a target='_blank' href='".admin_url('admin.php?page=ultimate-font-manager')."'>add new in the collection here</a>.", 'dfd'),
								"group" => "Typography"
							),
							array(
								"type" => "ultimate_google_fonts_style",
								"heading" 		=>	__("Font Style", 'dfd'),
								"param_name"	=>	"title_font_style",
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"class" => "font-size",
								"heading" => __("Font Size", 'dfd'),
								"param_name" => "title_font_size",
								"min" => 10,
								"suffix" => "px",
								"group" => "Typography"
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Font Color", 'dfd'),
								"param_name" => "title_color",
								"value" => "",
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Line Height", 'dfd'),
								"param_name" => "title_line_height",
								"value" => "",
								"suffix" => "px",
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Letter spacing", 'dfd'),
								"param_name" => "title_letter_spacing",
								"value" => "",
								"suffix" => "px",
								"group" => "Typography"
							),
							array(
								"type" => "ult_param_heading",
								"text" => __("Description Settings", 'dfd'),
								"param_name" => "desc_typograpy",
								"group" => "Typography",
								"class" => "ult-param-heading",
								'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
							),
							array(
								"type" => "ultimate_google_fonts",
								"heading" => __("Font Family", 'dfd'),
								"param_name" => "desc_font_family",
								"description" => __("Select the font of your choice. You can <a target='_blank' href='".admin_url('admin.php?page=ultimate-font-manager')."'>add new in the collection here</a>.", 'dfd'),
								"group" => "Typography"
							),
							array(
								"type" => "ultimate_google_fonts_style",
								"heading" 		=>	__("Font Style", 'dfd'),
								"param_name"	=>	"desc_font_style",
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"class" => "font-size",
								"heading" => __("Font Size", 'dfd'),
								"param_name" => "desc_font_size",
								"min" => 10,
								"suffix" => "px",
								"group" => "Typography"
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Font Color", 'dfd'),
								"param_name" => "desc_color",
								"value" => "",
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Line Height", 'dfd'),
								"param_name" => "desc_line_height",
								"value" => "",
								"suffix" => "px",
								"group" => "Typography"
							),		
							array(
								"type" => "textfield",
								"heading" => __("Extra class name", "js_composer"),
								"param_name" => "el_class",
								"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
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
		function banner_shortcode($atts, $content = null)
		{
			$output= $module_animation = $el_class = $style = $img_style = $icon_type = $icon_img = $img_width = $icon = $icon_color = $icon_color_bg = $icon_size = $icon_style = $icon_border_style = $icon_border_radius = $icon_color_border = $icon_border_size = $icon_border_spacing = $el_class = $icon_animation = $title = $subtitle = $enable_custom_title_typography = $link = $hover_effect = $pos = $read_more = $read_more_style = $read_text = $box_border_style = $box_border_width =$box_border_color = $box_bg_color = $pos = $css_class = $desc_font_line_height = $title_font_line_height = $title_font_letter_spacing = $icon_hover_color = $icon_hover_background = $icon_hover_border_color = '';
			
			extract(shortcode_atts( array(
				'icon_type' => 'selector',
				'icon' => '',
				'icon_img' => '',
				'img_width' => '46',
				'icon_size' => '32',				
				'icon_color' => '#333333',
				'icon_style' => 'none',
				'icon_color_bg' => '#ffffff',
				'icon_color_border' => '#333333',			
				'icon_border_style' => '',
				'icon_border_size' => '1',
				'icon_border_radius' => '50',
				'icon_border_spacing' => '50',
				'icon_animation' => '',
				'banner_title' => '',
				'module_min_height' => '',
				'info_alignment' => 'text-center',
				'banner_image' => '',
				'ib3_alignment' => 'ultb3-img-top-left',
				'info_effect' => '',	
				'ib3_effect' => '',
				'ib3_background' => '',
				'ib3_border' => 'no-border',
				'ib3_border_width' => '1',
				'ib3_border_color' => '',
				'banner_img_width' => '',
				'banner_img_height' => '',
				'banner_image_crop' => '',
				'title_font_family' => '',
				'title_font_style' => '',
				'title_font_size' => '',
				'title_color' => '',
				'title_line_height' => '',
				'title_letter_spacing' => '',
				'desc_font_family' => '',
				'desc_font_style' => '',
				'desc_font_size' => '',
				'desc_color' => '',
				'desc_line_height' => '',
				'overlay_color' => '',
				'module_animation' => '',
				'el_class' => '',
			),$atts));
			
			
			$box_icon = do_shortcode('[just_icon icon_type="'.$icon_type.'" icon="'.$icon.'" icon_img="'.$icon_img.'" img_width="'.$img_width.'" icon_size="'.$icon_size.'" icon_color="'.$icon_color.'" icon_style="'.$icon_style.'" icon_color_bg="'.$icon_color_bg.'" icon_color_border="'.$icon_color_border.'"  icon_border_style="'.$icon_border_style.'" icon_border_size="'.$icon_border_size.'" icon_border_radius="'.$icon_border_radius.'" icon_border_spacing="'.$icon_border_spacing.'" icon_animation="'.$icon_animation.'"]');
			
			/* typography */
			$title_style_inline = $desc_style_inline = '';
			if($title_font_family != '') {
				$temp = get_ultimate_font_family($title_font_family);
				$title_style_inline .= 'font-family:'.esc_attr($temp).';';
			}
			
			$title_style_inline .= get_ultimate_font_style($title_font_style);
			
			if($title_font_size != '') {
				$title_style_inline .= 'font-size:'.esc_attr($title_font_size).'px;';
			}
			
			if($title_color != '') {
				$title_style_inline .= 'color:'.esc_attr($title_color).';';
			}
			
			if($title_line_height != '') {
				$title_style_inline .= 'line-height:'.esc_attr($title_line_height).'px;';
			}
			
			if($title_letter_spacing != '') {
				$title_style_inline .= 'letter-spacing:'.esc_attr($title_letter_spacing).'px;';
			}
				
			if($desc_font_family != '') {
				$temp = get_ultimate_font_family($desc_font_family);
				$desc_style_inline .= 'font-family:'.esc_attr($temp).';';
			}
			
			$desc_style_inline .= get_ultimate_font_style($desc_font_style);
			
			if($desc_font_size != '') {
				$desc_style_inline .= 'font-size:'.esc_attr($desc_font_size).'px;';
			}
			
			if($desc_color != '') {
				$desc_style_inline .= 'color:'.esc_attr($desc_color).';';
			}
				
			if($desc_line_height != '') {
				$desc_style_inline .= 'line-height:'.esc_attr($desc_line_height).'px;';
			}
				
			$args = array(
				$title_font_family, $desc_font_family
			);
			enquque_ultimate_google_fonts($args);
			/*end typography */
			
			$banner_img_width = !empty($banner_img_width) ? $banner_img_width : '600';
			$banner_img_height = !empty($banner_img_height) ? $banner_img_height : '550';
			if(empty($banner_image_crop)) {
				$banner_image_crop = false;
			}
			
			$banner_src = wp_get_attachment_image_src($banner_image,'full');
			$banner_img_meta = wp_get_attachment_metadata($banner_image);
			
			if(isset($banner_img_meta['image_meta']['caption']) && $banner_img_meta['image_meta']['caption'] != '') {
				$caption = $banner_img_meta['image_meta']['caption'];
			} else if(isset($banner_img_meta['image_meta']['title']) && $banner_img_meta['image_meta']['title'] != '') {
				$caption = $banner_img_meta['image_meta']['title'];
			} else {
				$caption = 'ib3 image';
			}
			
			if($ib3_background != '') {
				$style .= 'background-color: '.esc_attr($ib3_background).';';
			}
			
			if($module_min_height != '') {
				$style .= 'min-height: '.esc_attr($module_min_height).'px;';
			}
			
			if($ib3_border != 'no-border') {
				$style .= 'border:'.esc_attr($ib3_border_width).'px '.esc_attr($ib3_border).' '.esc_attr($ib3_border_color).';';
			}
				
			$id = uniqid(rand());

			$animate = $animation_data = '';

			if ( ! ( $module_animation == '' ) ) {
				$animate        = ' cr-animate-gen';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}
			
			$output .= '<div id="ultib3-'.$id.'" class="ultb3-box '.esc_attr($el_class).' '.esc_attr($animate).' '.esc_attr($ib3_effect).'" style="'.$style.'" '.$animation_data.'>';
				if($overlay_color != '') {
					$output .= '<div class="ultb3-box-overlay" style="background:'.esc_attr($overlay_color).';"></div>';
				}
					

				if(isset($banner_src[0]) && $banner_src[0] != '') {
					$banner_img_url = dfd_aq_resize($banner_src[0], $banner_img_width, $banner_img_height, $banner_image_crop, true, true);
					if(!$banner_img_url) {
						$banner_img_url = $banner_src[0];
					}
					$output .= '<img src="'.esc_url($banner_img_url).'" style="'.$img_style.'" class="ultb3-img '.esc_attr($ib3_alignment).'" alt="'.esc_attr($caption).'"/>';
				}
					

				$output .= '<div class="ultb3-info '.esc_attr($info_alignment).'" data-animation="'.esc_attr($info_effect).'" data-animation-delay="03">';	
				if($box_icon != '') {
					$output .= $box_icon;
				}
					
				if($banner_title != '') {
					$output .= '<h5 class="widget-title" style="'.$title_style_inline.'">'.$banner_title.'</h5>';
				}
					
				if($content != '') {
					$output .= '<div class="content" style="'.$desc_style_inline.'">'.wpb_js_remove_wpautop( $content , true ).'</div>';
				}
					
				$output .= '</div>';
			$output .= '</div>';
			
			return $output;
		}
	}
}
if(class_exists('Old_Dfd_Info_Banner')) {
	$Old_Dfd_Info_Banner = new Old_Dfd_Info_Banner;
}
