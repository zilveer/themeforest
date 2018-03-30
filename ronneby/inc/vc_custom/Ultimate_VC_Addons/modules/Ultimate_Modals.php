<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Ultimate Modals
* Add-on URI: https://www.brainstormforce.com
*/
if(!class_exists('Ultimate_Modals'))
{
	class Ultimate_Modals
	{
		function __construct()
		{
			// Add shortcode for modal popup
			add_shortcode('ultimate_modal', array(&$this, 'modal_shortcode' ) );
			// Initialize the modal popup component for Visual Composer
			add_action('init', array( &$this, 'ultimate_modal_init' ) );
			add_action('wp_head',array($this, 'enqueue_modal_js'),99);
			add_action("wp_enqueue_scripts", array($this, "register_modal_assets"),1);
		}
		function register_modal_assets()
		{
			wp_register_script("ultimate-modernizr",get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-js/modernizr.custom.min.js',array('jquery'),null);
			//wp_register_script("ultimate-classie",get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-js/classie.min.js',array('jquery'),null);
			//wp_register_script("ultimate-snap-svg",get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-js/snap.svg.min.js',array('jquery'),null);
			//wp_register_script("ultimate-frongloop",get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-js/froogaloop2.min.js',array('jquery'),null);
			//wp_register_script("ultimate-modal",get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-js/modal.min.js',array('jquery'),null);
			wp_register_script("ultimate-modal-all",get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-js/modal-all.min.js',array('jquery'),null);
		}
		function enqueue_modal_js(){
			echo '<script type="text/javascript">';
			echo 'jQuery(document).ready(function(){
					jQuery(".ult_modal-body iframe").each(function(index, element) {
						var w = jQuery(this).attr("width");
						var h = jQuery(this).attr("height");
						var st = \'<style type="text/css" id="modal-css">\';
							st += "#"+jQuery(this).closest(".ult-overlay").attr("id")+" iframe{width:"+w+"px !important;height:"+h+"px !important;}";
							st += ".fluid-width-video-wrapper{padding: 0 !important;}";
							st += "</style>";
						jQuery("head").append(st);
					});
				});';
			echo '</script>';
		}		
		// Add shortcode for icon-box
		function modal_shortcode($atts, $content = null)
		{
			$row_setting = '';
			// enqueue js
			/*
			$ultimate_js = get_option('ultimate_js');
			if($ultimate_js != 'enable')
				wp_enqueue_script('ultimate-modernizr');
			*/
			//wp_enqueue_script('ultimate-classie');
			//wp_enqueue_script('ultimate-snap-svg');
			//wp_enqueue_script('ultimate-frongloop');
			wp_enqueue_script('ultimate-modal-all');

			$icon = $modal_on = $modal_contain = $btn_size = $btn_align = $btn_bg_color = $btn_txt_color = $btn_border_color = $button_border_radius = $btn_hover_bg_color = $btn_hover_txt_color = $btn_hover_border_color = $btn_text = $read_text = $txt_color = $modal_title = $modal_size = $el_class = $modal_style = $btn_img = $overlay_bg_color = $overlay_bg_opacity = $modal_on_align = $content_bg_color = $content_text_color = /*$header_bg_color =*/ $header_text_color = $modal_border_style = $modal_border_width = $modal_border_color = $modal_box_shadow_disable = $modal_border_radius = $content_bg_check = '';
			$heading_tag = $heading_typography_type = $main_heading_font_size = $main_heading_font_family = $main_heading_custom_family = $main_heading_style = $main_heading_default_style = $main_heading_default_weight = $main_heading_color = $main_heading_line_height = $main_heading_letter_spacing = $alignment = '';
			$icon_type = $icon = $icon_img = $img_width = $icon_size = $icon_color = $icon_style = $icon_color_bg = $icon_color_border = $icon_border_style = $icon_border_size = $icon_border_radius = $icon_border_spacing = $icon_hover_color = $icon_hover_background = $icon_hover_border_color = $icon_animation = '';
			extract(shortcode_atts(array(
				'icon_type' => 'none',
				'icon' => '',
				'icon_img' => '',
				'img_width' => '48',
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
//				'icon_hover_color' => '',
//				'icon_hover_background' => '',
//				'icon_hover_border_color' => '',
				'modal_on' => 'ult-button',
				'modal_contain' => 'ult-html',
				'onload_delay'=>'2',
				'btn_size' => 'sm',
				'btn_align' => 'text-left',
				'overlay_bg_color' => '#333333',
				'overlay_bg_opacity' => '80',
				'btn_bg_color' => '',
				'btn_txt_color' => '',
				'btn_border_color' => '',
				'button_border_radius' => '',
				'btn_hover_bg_color' => '',
				'btn_hover_txt_color' => '',
				'btn_hover_border_color' => '',
				'btn_text' => '',				
				'read_text' => '',
				'txt_color' => '',
				'btn_img' => '',
				'modal_title' => '',
				'heading_tag' => 'h5',
				'heading_typography_type' => 'default',
				'main_heading_font_size'	=> 	'',
				'main_heading_font_family' => '',
				'main_heading_custom_family' => '',
				'main_heading_style'		=>	'',
				'main_heading_default_style'		=>	'normal',
				'main_heading_default_weight'		=>	'400',
				'main_heading_color'		=>	'',
				'main_heading_line_height' => '',
				'main_heading_letter_spacing' => '',
				'alignment' => 'text-center',
				'modal_size' => 'small',
				'modal_style' => 'overlay-cornerbottomleft',
				'content_bg_check' => '',
				'content_bg_color' => '',
				'content_text_color' => '',
				//'header_bg_color' => '',
				'header_text_color' => '#333333',
				'modal_on_align' => 'center',
				'modal_border_style' => '',
				'modal_border_width' => '2',
				'modal_border_color' => '#333333',
				'modal_box_shadow_disable' => '',
				'modal_border_radius' => '0',
				'el_class' => '',
				),$atts,'ultimate_modal'));
			$html = $style = $button_hover_style = $box_icon = $modal_class = $modal_data_class = $uniq = $overlay_bg = $content_style = $header_style = $content_box_style = $main_heading_style_inline = $css = '';
			$uniq = uniqid();
			
			if($modal_on == "ult-button"){
				$modal_on = "button";
			}
			if($heading_tag == '') {
				$heading_tag = 'h4';
			}
			/* ---- main heading styles ---- */
			if($main_heading_font_family != '' && strcmp($heading_typography_type, 'google_fonts') === 0) {
				$mhfont_family = get_ultimate_font_family($main_heading_font_family);
				$main_heading_style_inline .= 'font-family:\''.esc_attr($mhfont_family).'\';';
			} elseif(!empty($main_heading_custom_family) && strcmp($heading_typography_type, 'default') === 0) {
				$main_heading_style_inline .= 'font-family:\''.esc_attr($main_heading_custom_family).'\';';
			}
			// main heading font style
			if(strcmp($heading_typography_type, 'google_fonts') === 0) {
				$main_heading_style_inline .= get_ultimate_font_style($main_heading_style);
			}elseif(!empty($main_heading_default_style) && strcmp($heading_typography_type, 'default') === 0) {
				$main_heading_style_inline .= 'font-style:'.esc_attr($main_heading_default_style).';';
			}
			if(!empty($main_heading_default_weight) && strcmp($heading_typography_type, 'default') === 0) {
				$main_heading_style_inline .= 'font-weight:'.esc_attr($main_heading_default_weight).';';
			}
			//attach font size if set
			if($main_heading_font_size != '') {
				$main_heading_style_inline .= 'font-size:'.esc_attr($main_heading_font_size).'px;';
			}
			//attach font color if set	
			if($main_heading_color != '') {
				$main_heading_style_inline .= 'color:'.esc_attr($main_heading_color).';';
			}
			//line height
			if($main_heading_line_height != '') {
				$main_heading_style_inline .= 'line-height:'.esc_attr($main_heading_line_height).'px;';
			}
			//letter spacing
			if($main_heading_letter_spacing != '') {
				$main_heading_style_inline .= 'letter-spacing:'.esc_attr($main_heading_letter_spacing).'px;';
			}
			// Create style for content text color
			if($content_text_color !== '')
				$content_style .= 'color:'.esc_attr($content_text_color).';';
			// Create style for header background color
			/*if($header_bg_color !== '')
				$header_style .= 'background:'.$header_bg_color.';';*/
			// Create style for header text color
			if($header_text_color !== '')
				$header_style .= 'color:'.esc_attr($header_text_color).';';
			// Create style for content background color
			if($content_bg_color !== '') {
				$content_box_style .= 'background:'.esc_attr($content_bg_color).';';
			}
			if($modal_border_style !== ''){
				$content_box_style .= 'border-style:'.esc_attr($modal_border_style).';';
			}
			if($modal_border_width !== ''){
				$content_box_style .= 'border-width:'.esc_attr($modal_border_width).'px;';
			}
			if($modal_border_radius !== ''){
				$content_box_style .= 'border-radius:'.esc_attr($modal_border_radius).'px;';
			}
			if($modal_border_color !== ''){
				$content_box_style .= 'border-color:'.esc_attr($modal_border_color).';';
			}
			if(!empty($modal_box_shadow_disable)){
				$content_box_style .= 'box-shadow:none;';
			}
			$overlay_bg_opacity = ($overlay_bg_opacity/100);
			if($overlay_bg_color !== ''){
				if(strlen($overlay_bg_color) <= 7)
					$overlay_bg = ultimate_hex2rgb($overlay_bg_color,$overlay_bg_opacity);
				else
					$overlay_bg = $overlay_bg_color;
					
				if($modal_style != 'overlay-show-cornershape' && $modal_style != 'overlay-show-genie' && $modal_style != 'overlay-show-boxes'){
					$overlay_bg = 'background:'.esc_attr($overlay_bg).';';
				} else {
					$overlay_bg = 'fill:'.esc_attr($overlay_bg).';';
				}
			}
		
			if($modal_style != 'overlay-show-cornershape' && $modal_style != 'overlay-show-genie' && $modal_style != 'overlay-show-boxes'){
				$modal_class = 'overlay-show';
				$modal_data_class = 'data-overlay-class="'.esc_attr($modal_style).'"';
			} else {
				$modal_class = $modal_style;
				$modal_data_class = '';
			}
			if($modal_on == "button"){
				if($btn_bg_color !== ''){
					$style .= 'background:'.esc_attr($btn_bg_color).';';
				}
				if($btn_txt_color !== ''){
					$style .= 'color:'.esc_attr($btn_txt_color).';';
				}
				if($btn_border_color !== ''){
					$style .= 'border-color:'.esc_attr($btn_border_color).';';
				}
				if($button_border_radius !== ''){
					$style .= 'border-radius:'.esc_attr($button_border_radius).'px;';
				}
				if($el_class != '') {
					$modal_class .= ' '.esc_attr($el_class).'-button ';
				}
				
				if($btn_hover_bg_color != '' || $btn_hover_txt_color != '' || $btn_hover_border_color != '') {
					$button_hover_style .= '<style>#modal-'.esc_attr($uniq).'.btn:hover {';
					if($btn_hover_bg_color != ''){
						$button_hover_style .= 'background: '.esc_attr($btn_hover_bg_color).' !important;';
					}

					if($btn_hover_txt_color != '') {
						$button_hover_style .= 'color: '.esc_attr($btn_hover_txt_color).' !important;';
					}
					if($btn_hover_border_color != '') {
						$button_hover_style .= 'border-color: '.esc_attr($btn_hover_border_color).' !important;';
					}
					$button_hover_style .= '}</style>';
				}
				$html .= '<button style="'.$style.'" id="modal-'.esc_attr($uniq).'" data-class-id="content-'.esc_attr($uniq).'" class="btn btn-primary modal-module-button btn-'.esc_attr($btn_size).' '.esc_attr($btn_align).' '.esc_attr($modal_class).' ult-align-'.esc_attr($modal_on_align).'" '.$modal_data_class.'>'.$btn_text.'</button>';
				$html .= '<script type="text/javascript">(function($){$("head").append("'.$button_hover_style.'");})(jQuery);</script>';
			} elseif($modal_on == "image"){
				if($btn_img !==''){
					if($el_class != '')
						$modal_class .= ' '.esc_attr($el_class).'-image ';
					$img = wp_get_attachment_image_src( $btn_img, 'large');
					$html .= '<img src="'.esc_attr($img[0]).'" data-class-id="content-'.esc_attr($uniq).'" class="ult-modal-img '.esc_attr($modal_class).' ult-align-'.esc_attr($modal_on_align).' ult-modal-image-'.esc_attr($el_class).'" '.$modal_data_class.'/>';
				}
			} elseif($modal_on == 'icon') {
				$box_icon = do_shortcode('[just_icon icon_type="'.$icon_type.'" icon="'.$icon.'" icon_img="'.$icon_img.'" img_width="'.$img_width.'" icon_size="'.$icon_size.'" icon_color="'.$icon_color.'" icon_style="'.$icon_style.'" icon_color_bg="'.$icon_color_bg.'" icon_color_border="'.$icon_color_border.'"  icon_border_style="'.$icon_border_style.'" icon_border_size="'.$icon_border_size.'" icon_border_radius="'.$icon_border_radius.'" icon_border_spacing="'.$icon_border_spacing.'" icon_animation="'.$icon_animation.'"]');
//				if($icon_hover_color != '' || $icon_hover_background != '' || $title_hover_color != '' || $icon_hover_border_color != '') {
//					$css .= '<style type="text/css">';
//					if($icon_hover_color != '') {
//						$css .= '#modal-'.esc_attr($uniq).'.aio-icon-component.'.esc_attr($hover_effect).':hover .aio-icon {color: '. esc_attr($icon_hover_color) .' !important;}';
//					}
//					if($icon_hover_background != '') {
//						$css .= '#modal-'.esc_attr($uniq).'.aio-icon-component.'.esc_attr($hover_effect).':hover .aio-icon {background: '. esc_attr($icon_hover_background) .' !important;}';
//					}
//					if($icon_hover_border_color != '') {
//						if($box_border_color == '' || $box_border_color == '' || $box_border_width == ''){
//							$css .= '#modal-'.esc_attr($uniq).'.aio-icon-component.'.esc_attr($hover_effect).' .aio-icon {';
//						}
//						if($box_border_color == ''){
//							$css .="border-color: transparent;";
//						}
//						if($box_border_style == '') {
//							$css .="border-style: solid;";
//						}
//						if($box_border_width == ''){
//							$css .="border-width: 1px;";
//						}
//						$css .= '}';
//						$css .= '#modal-'.esc_attr($uniq).'.aio-icon-component.'.esc_attr($hover_effect).':hover .aio-icon {border-color: '. esc_attr($icon_hover_border_color) .' !important;}';
//					}
//					$css .= '</style>';
//				}
				$html .= '<div id="modal-'.esc_attr($uniq).'" data-class-id="content-'.esc_attr($uniq).'" class="overlay-show modal-icon" '.$modal_data_class.'>'.$box_icon.'</div>';
//				if($css != '') {
//					$html .= "<script type=\"text/javascript\">"
//							. "jQuery(document).ready(function() {"
//								."jQuery('head').append('".$css."');"
//							. "});"
//							."</script>";
//				}
			} elseif($modal_on == "onload"){
				$html .= '<div data-class-id="content-'.esc_attr($uniq).'" class="ult-onload '.esc_attr($modal_class).' " '.$modal_data_class.' data-onload-delay="'.esc_attr($onload_delay).'"></div>';
			} else {
				if($txt_color !== ''){
					$style .= 'color:'.esc_attr($txt_color).';';
					$style .= 'cursor:pointer;';
				}
				if($el_class != '')
					$modal_class .= ' '.esc_attr($el_class).'-link ';
				$html .= '<span style="'.$style.'" data-class-id="content-'.esc_attr($uniq).'" class="'.esc_attr($modal_class).' ult-align-'.esc_attr($modal_on_align).'" '.$modal_data_class.'>'.$read_text.'</span>';
			}
			if($modal_style == 'overlay-show-cornershape') {
				$html .= "\n".'<div class="ult-overlay overlay-cornershape content-'.esc_attr($uniq).' '.esc_attr($el_class).'" style="display:none" data-class="content-'.esc_attr($uniq).'" data-path-to="m 0,0 1439.999975,0 0,805.99999 -1439.999975,0 z">';
            	$html .= "\n\t".'<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 1440 806" preserveAspectRatio="none">
                					<path class="overlay-path" d="m 0,0 1439.999975,0 0,805.99999 0,-805.99999 z" style="'.$overlay_bg.'"/>
            					</svg>';
			} elseif($modal_style == 'overlay-show-genie') {
				$html .= "\n".'<div class="ult-overlay overlay-genie content-'.esc_attr($uniq).' '.esc_attr($el_class).'" style="display:none" data-class="content-'.esc_attr($uniq).'" data-steps="m 701.56545,809.01175 35.16718,0 0,19.68384 -35.16718,0 z;m 698.9986,728.03569 41.23353,0 -3.41953,77.8735 -34.98557,0 z;m 687.08153,513.78234 53.1506,0 C 738.0505,683.9161 737.86917,503.34193 737.27015,806 l -35.90067,0 c -7.82727,-276.34892 -2.06916,-72.79261 -14.28795,-292.21766 z;m 403.87105,257.94772 566.31246,2.93091 C 923.38284,513.78233 738.73561,372.23931 737.27015,806 l -35.90067,0 C 701.32034,404.49318 455.17312,480.07689 403.87105,257.94772 z;M 51.871052,165.94772 1362.1835,168.87863 C 1171.3828,653.78233 738.73561,372.23931 737.27015,806 l -35.90067,0 C 701.32034,404.49318 31.173122,513.78234 51.871052,165.94772 z;m 52,26 1364,4 c -12.8007,666.9037 -273.2644,483.78234 -322.7299,776 l -633.90062,0 C 359.32034,432.49318 -6.6979288,733.83462 52,26 z;m 0,0 1439.999975,0 0,805.99999 -1439.999975,0 z">';
				$html .= "\n\t".'<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 1440 806" preserveAspectRatio="none">
							<path class="overlay-path" d="m 701.56545,809.01175 35.16718,0 0,19.68384 -35.16718,0 z" style="'.$overlay_bg.'"/>
						</svg>';
			} elseif($modal_style == 'overlay-show-boxes') {
				$html .= "\n".'<div class="ult-overlay overlay-boxes content-'.esc_attr($uniq).' '.esc_attr($el_class).'" style="display:none" data-class="content-'.esc_attr($uniq).'">';
				$html .= "\n\t".'<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="101%" viewBox="0 0 1440 806" preserveAspectRatio="none">';
				$html .= "\n\t\t".'<path d="m0.005959,200.364029l207.551124,0l0,204.342453l-207.551124,0l0,-204.342453z" style="'.$overlay_bg.'"/>';
				$html .= "\n\t\t".'<path d="m0.005959,400.45401l207.551124,0l0,204.342499l-207.551124,0l0,-204.342499z" style="'.$overlay_bg.'"/>';
				$html .= "\n\t\t".'<path d="m0.005959,600.544067l207.551124,0l0,204.342468l-207.551124,0l0,-204.342468z" style="'.$overlay_bg.'"/>';
				$html .= "\n\t\t".'<path d="m205.752151,-0.36l207.551163,0l0,204.342437l-207.551163,0l0,-204.342437z" style="'.$overlay_bg.'"/>';
				$html .= "\n\t\t".'<path d="m204.744629,200.364029l207.551147,0l0,204.342453l-207.551147,0l0,-204.342453z" style="'.$overlay_bg.'"/>';
				$html .= "\n\t\t".'<path d="m204.744629,400.45401l207.551147,0l0,204.342499l-207.551147,0l0,-204.342499z" style="'.$overlay_bg.'"/>';
				$html .= "\n\t\t".'<path d="m204.744629,600.544067l207.551147,0l0,204.342468l-207.551147,0l0,-204.342468z" style="'.$overlay_bg.'"/>';
				$html .= "\n\t\t".'<path d="m410.416046,-0.36l207.551117,0l0,204.342437l-207.551117,0l0,-204.342437z" style="'.$overlay_bg.'"/>';
				$html .= "\n\t\t".'<path d="m410.416046,200.364029l207.551117,0l0,204.342453l-207.551117,0l0,-204.342453z" style="'.$overlay_bg.'"/>';
				$html .= "\n\t\t".'<path d="m410.416046,400.45401l207.551117,0l0,204.342499l-207.551117,0l0,-204.342499z" style="'.$overlay_bg.'"/>';
				$html .= "\n\t\t".'<path d="m410.416046,600.544067l207.551117,0l0,204.342468l-207.551117,0l0,-204.342468z" style="'.$overlay_bg.'"/>';
				$html .= "\n\t\t".'<path d="m616.087402,-0.36l207.551086,0l0,204.342437l-207.551086,0l0,-204.342437z" style="'.$overlay_bg.'"/>';
				$html .= "\n\t\t".'<path d="m616.087402,200.364029l207.551086,0l0,204.342453l-207.551086,0l0,-204.342453z" style="'.$overlay_bg.'"/>';
				$html .= "\n\t\t".'<path d="m616.087402,400.45401l207.551086,0l0,204.342499l-207.551086,0l0,-204.342499z" style="'.$overlay_bg.'"/>';
				$html .= "\n\t\t".'<path d="m616.087402,600.544067l207.551086,0l0,204.342468l-207.551086,0l0,-204.342468z" style="'.$overlay_bg.'"/>';
				$html .= "\n\t\t".'<path d="m821.748718,-0.36l207.550964,0l0,204.342437l-207.550964,0l0,-204.342437z" style="'.$overlay_bg.'"/>';
				$html .= "\n\t\t".'<path d="m821.748718,200.364029l207.550964,0l0,204.342453l-207.550964,0l0,-204.342453z" style="'.$overlay_bg.'"/>';
				$html .= "\n\t\t".'<path d="m821.748718,400.45401l207.550964,0l0,204.342499l-207.550964,0l0,-204.342499z" style="'.$overlay_bg.'"/>';
				$html .= "\n\t\t".'<path d="m821.748718,600.544067l207.550964,0l0,204.342468l-207.550964,0l0,-204.342468z" style="'.$overlay_bg.'"/>';
				$html .= "\n\t\t".'<path d="m1027.203979,-0.36l207.550903,0l0,204.342437l-207.550903,0l0,-204.342437z" style="'.$overlay_bg.'"/>';
				$html .= "\n\t\t".'<path d="m1027.203979,200.364029l207.550903,0l0,204.342453l-207.550903,0l0,-204.342453z" style="'.$overlay_bg.'"/>';
				$html .= "\n\t\t".'<path d="m1027.203979,400.45401l207.550903,0l0,204.342499l-207.550903,0l0,-204.342499z" style="'.$overlay_bg.'"/>';
				$html .= "\n\t\t".'<path d="m1027.203979,600.544067l207.550903,0l0,204.342468l-207.550903,0l0,-204.342468z" style="'.$overlay_bg.'"/>';
				$html .= "\n\t\t".'<path d="m1232.659302,-0.36l207.551147,0l0,204.342437l-207.551147,0l0,-204.342437z" style="'.$overlay_bg.'"/>';
				$html .= "\n\t\t".'<path d="m1232.659302,200.364029l207.551147,0l0,204.342453l-207.551147,0l0,-204.342453z" style="'.$overlay_bg.'"/>';
				$html .= "\n\t\t".'<path d="m1232.659302,400.45401l207.551147,0l0,204.342499l-207.551147,0l0,-204.342499z" style="'.$overlay_bg.'"/>';
				$html .= "\n\t\t".'<path d="m1232.659302,600.544067l207.551147,0l0,204.342468l-207.551147,0l0,-204.342468z" style="'.$overlay_bg.'"/>';
				$html .= "\n\t\t".'<path d="m-0.791443,-0.360001l207.551163,0l0,204.342438l-207.551163,0l0,-204.342438z" style="'.$overlay_bg.'"/>';
				$html .= "\n\t".'</svg>';
			} else {
				$html .= "\n".'<div class="ult-overlay content-'.esc_attr($uniq).' '.esc_attr($el_class).'" data-class="content-'.esc_attr($uniq).'" id="button-click-overlay-'.esc_attr($uniq).'" style="'.$overlay_bg.' display:none;">';
			}
			$html .= "\n\t".'<div class="ult_modal ult-fade ult-'.esc_attr($modal_size).'">';
			$html .= "\n\t\t".'<div class="ult_modal-content '.esc_attr($content_bg_check).'" style="'.$content_box_style.'">';
			if($modal_title !== ''){
				$html .= "\n\t\t\t".'<div class="ult_modal-header" style="'.$header_style.'">';
				$html .= "\n\t\t\t\t".$box_icon.'<'.esc_attr($heading_tag).' class="ult_modal-title '.esc_attr($alignment).'" style="'.$main_heading_style_inline.'">'.$modal_title.'</'.esc_attr($heading_tag).'>';
				$html .= "\n\t\t\t".'</div>';
			}
			$html .= "\n\t\t\t".'<div class="ult_modal-body '.esc_attr($modal_contain).'" style="'.$content_style.'">';
			$html .= "\n\t\t\t".wpb_js_remove_wpautop( $content , true );
			$html .= "\n\t\t\t".'</div>';
			$html .= "\n\t".'</div>';
			$html .= "\n\t".'</div>';
			$html .= "\n\t".'<div class="ult-overlay-close">Close</div>';
			$html .= "\n".'</div>';
			return $html;
		}
		/* Add modal popup Component*/
		function ultimate_modal_init()
		{
			if ( function_exists('vc_map'))
			{
				vc_map( 
					array(
						"name"		=> __("Modal Box", 'dfd'),
						"base"		=> "ultimate_modal",
						"icon"		=> "vc_modal_box",
						"class"	   => "modal_box",
						"category"  => __("Ronneby 1.0", 'dfd'),
						"description" => "Adds bootstrap modal box in your content",
						"controls" => "full",
						"show_settings_on_create" => true,
						"params" => array(
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Display Modal On -", 'dfd'),
								"param_name" => "modal_on",
								"value" => array(
									__('Button','dfd') => "ult-button",
									__('Image','dfd') => "image",
									__('Icon','dfd') => "icon",
									__('Text','dfd') => "text",
									__('On Page Load','dfd') => "onload",
								),
								"description" => __("When should the popup be initiated?", 'dfd')
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Icon to display:", 'dfd'),
								"param_name" => "icon_type",
								"value" => array(
									__('No Icon','dfd') => "none",
									__('Font Icon Manager','dfd') => "selector",
									__('Custom Image Icon','dfd') => "custom",
								),
								"dependency" => Array("element" => "modal_on","value" => array("icon")),
								"description" => __("Use <a href='admin.php?page=font-icon-Manager' target='_blank'>existing font icon</a> or upload a custom image.", 'dfd')
							),
							array(
								"type" => "icon_manager",
								"class" => "",
								"heading" => __("Select Icon ",'dfd'),
								"param_name" => "icon",
								"value" => "",
								"description" => __("Click and select icon of your choice. If you can't find the one that suits for your purpose, you can <a href='admin.php?page=AIO_Icon_Manager' target='_blank'>add new here</a>.", 'dfd'),
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
								"dependency" => Array("element" => "icon_type","value" => array("selector")),						
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
								"value" => 500,
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
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Animation",'dfd'),
								"param_name" => "icon_animation",
								"value" => array(
							 		__("No Animation",'dfd') => "",
									__("Swing",'dfd') => "swing",
									__("Pulse",'dfd') => "pulse",
									__("Fade In",'dfd') => "fadeIn",
									__("Fade In Up",'dfd') => "fadeInUp",
									__("Fade In Down",'dfd') => "fadeInDown",
									__("Fade In Left",'dfd') => "fadeInLeft",
									__("Fade In Right",'dfd') => "fadeInRight",
									__("Fade In Up Long",'dfd') => "fadeInUpBig",
									__("Fade In Down Long",'dfd') => "fadeInDownBig",
									__("Fade In Left Long",'dfd') => "fadeInLeftBig",
									__("Fade In Right Long",'dfd') => "fadeInRightBig",
									__("Slide In Down",'dfd') => "slideInDown",
									__("Slide In Left",'dfd') => "slideInLeft",
									__("Slide In Left",'dfd') => "slideInLeft",
									__("Bounce In",'dfd') => "bounceIn",
									__("Bounce In Up",'dfd') => "bounceInUp",
									__("Bounce In Down",'dfd') => "bounceInDown",
									__("Bounce In Left",'dfd') => "bounceInLeft",
									__("Bounce In Right",'dfd') => "bounceInRight",
									__("Rotate In",'dfd') => "rotateIn",
									__("Light Speed In",'dfd') => "lightSpeedIn",
									__("Roll In",'dfd') => "rollIn",
									),
								"description" => __("Like CSS3 Animations? We have several options for you!",'dfd')
						  	),
							// Modal Title
							array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("Modal Box Title", 'dfd'),
								"param_name" => "modal_title",
								"admin_label" => true,
								"value" => "",
								"description" => __("Provide the title for modal box.", 'dfd'),
							),
							array(
								"type" => "dropdown",
								"heading" => __("Modal Box Title Tag",'dfd'),
								"param_name" => "heading_tag",
								"value" => array(
									__("Default",'dfd') => "h5",
									__("H1",'dfd') => "h1",
									__("H2",'dfd') => "h2",
									__("H3",'dfd') => "h3",
									__("H4",'dfd') => "h4",
									__("H6",'dfd') => "h6",
								),
								"description" => __("Default is H5", 'dfd'),
							),
							array(
								"type" => "ult_param_heading",
								"text" => __("Modal Box Title Settings", 'dfd'),
								"param_name" => "main_heading_typograpy",
								"group" => "Typography",
								"class" => "ult-param-heading",
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Heading type', 'dfd'),
								'param_name' => 'heading_typography_type',
								'value' => array(
									__('Default', 'dfd')	=>	'default',
									__('Google Fonts','dfd')		=>	'google_fonts',
								),
								"group" => "Typography",
								"dependency" => Array("element" => "heading_type", "value" => array('customizable')),
							),
							array(
								"type" => "ultimate_google_fonts",
								"heading" => __("Font Family", 'dfd'),
								"param_name" => "main_heading_font_family",
								"description" => __("Select the font of your choice. You can <a target='_blank' href='".admin_url('admin.php?page=ultimate-font-manager')."'>add new in the collection here</a>.", 'dfd'),
								"group" => "Typography",
								"dependency" => Array("element" => "heading_typography_type", "value" => array('google_fonts')),
							),
							array(
								'type' => 'textfield',
								'heading' => __( 'Custom font family', 'dfd' ),
								'param_name' => 'main_heading_custom_family',
								'holder' => 'div',
								'value' => '',
								"group" => "Typography",
								"dependency" => Array("element" => "heading_typography_type", "value" => array('default')),
							),
							array(
								"type" => "ultimate_google_fonts_style",
								"heading" 		=>	__("Font Style", 'dfd'),
								"param_name"	=>	"main_heading_style",
								//"description"	=>	__("Main heading font style", 'dfd'),
								"dependency" => Array("element" => "heading_typography_type", "value" => array('google_fonts')),
								"group" => "Typography"
							),
							array(
								"type" => "dropdown",
								"heading" 		=>	__("Font Style", 'dfd'),
								"param_name"	=>	"main_heading_default_style",
								'value' => array(
									__('Normal', 'dfd')	=>	'normal',
									__('Italic','dfd')		=>	'italic',
									__('Inherit','dfd')		=>	'inherit',
									__('Initial','dfd')		=>	'initial',
								),
								"dependency" => Array("element" => "heading_typography_type", "value" => array('default')),
								"group" => "Typography"
							),
							array(
								"type" => "dropdown",
								"heading" 		=>	__("Font Weight", 'dfd'),
								"param_name"	=>	"main_heading_default_weight",
								'value' => array(
									__('Default', 'dfd')	=>	'400',
									'100'	=>	'100',
									'200'	=>	'200',
									'300'	=>	'300',
									'500'	=>	'500',
									'600'	=>	'600',
									'700'	=>	'700',
									'800'	=>	'800',
									'900'	=>	'900',
								),
								"dependency" => Array("element" => "heading_typography_type", "value" => array('default')),
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"class" => "font-size",
								"heading" => __("Font Size", 'dfd'),
								"param_name" => "main_heading_font_size",
								"min" => 10,
								"suffix" => "px",
								//"description" => __("Main heading font size", 'dfd'),
								"dependency" => Array("element" => "modal_title", "not_empty" => true),
								"group" => "Typography"
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Font Color", 'dfd'),
								"param_name" => "main_heading_color",
								"value" => "",
								//"description" => __("Main heading color", 'dfd'),	
								"dependency" => Array("element" => "modal_title", "not_empty" => true),
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Line Height", 'dfd'),
								"param_name" => "main_heading_line_height",
								"value" => "",
								"suffix" => "px",
								//"description" => __("Main heading color", 'dfd'),	
								"dependency" => Array("element" => "modal_title", "not_empty" => true),
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Letter spacing", 'dfd'),
								"param_name" => "main_heading_letter_spacing",
								"value" => "",
								"suffix" => "px",
								//"description" => __("Main heading color", 'dfd'),	
								"dependency" => Array("element" => "modal_title", "not_empty" => true),
								"group" => "Typography"
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Alignment", 'dfd'),
								"param_name" => "alignment",
								"value" => array(
									__('Center', 'dfd')	=>	"text-center",
									__('Left', 'dfd')		=>	"text-left",
									__('Right', 'dfd')		=>	"text-right"
								),
								"dependency" => Array("element" => "modal_title", "not_empty" => true),
								"group" => "Typography"
							),
							// Add some description
							array(
								"type" => "textarea_html",
								"class" => "",
								"heading" => __("Modal Content", 'dfd'),
								"param_name" => "content",
								"value" => "",
								"description" => __("Content that will be displayed in Modal Popup.", 'dfd')
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("What's in Modal Popup?", 'dfd'),
								"param_name" => "modal_contain",
								"value" => array(
									__('Miscellaneous Things','dfd') => "ult-html",
									__('Youtube Video','dfd') => "ult-youtube",
									__('Vimeo Video','dfd') => "ult-vimeo",
								),
								"description" => ""
							),
							array(
								"type"=>"number",
								"class"=>'',
								"heading"=>"Delay in Popup Display",
								"param_name"=>"onload_delay",
								"value"=>"2",
								"suffix"=>"seconds",
								"description"=>__("Time delay before modal popup on page load (in seconds)",'dfd'),
								"dependency"=>Array("element"=>"modal_on","value"=>array("onload"))
								),
							array(
								"type" => "attach_image",
								"class" => "",
								"heading" => __("Upload Image", 'dfd'),
								"param_name" => "btn_img",
								"admin_label" => true,
								"value" => "",
								"description" => __("Upload the custom image / image banner.", 'dfd'),
								"dependency" => Array("element" => "modal_on","value" => array("image")),
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Button Size", 'dfd'),
								"param_name" => "btn_size",
								"value" => array(
									__('Small','dfd') => "sm",
									__('Medium','dfd') => "md",
									__('Large','dfd') => "lg",
									__('Block','dfd') => "block",
								),
								"description" => __("How big the button would you like?", 'dfd'),
								"dependency" => Array("element" => "modal_on","value" => array("ult-button")),
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Button Alignment", 'dfd'),
								"param_name" => "btn_align",
								"value" => array(
									__('Left','dfd') => "text-left",
									__('Right','dfd') => "text-right",
									__('Center','dfd') => "text-center",
								),
								"description" => __("How big the button would you like?", 'dfd'),
								"dependency" => Array("element" => "modal_on","value" => array("ult-button")),
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Button Background Color", 'dfd'),
								"param_name" => "btn_bg_color",
								"value" => "",
								"description" => __("Give it a nice paint!", 'dfd'),
								"dependency" => Array("element" => "modal_on","value" => array("ult-button")),
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Button Text Color", 'dfd'),
								"param_name" => "btn_txt_color",
								"value" => "",
								"description" => __("Give it a nice paint!", 'dfd'),
								"dependency" => Array("element" => "modal_on","value" => array("ult-button")),
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Button Border Color", 'dfd'),
								"param_name" => "btn_border_color",
								"value" => "",
								"description" => __("Give it a nice paint!", 'dfd'),
								"dependency" => Array("element" => "modal_on","value" => array("ult-button")),
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Button Border Radius", 'dfd'),
								"param_name" => "button_border_radius",
								"value" => '',
								"min" => 0,
								"max" => 30,
								"suffix" => "px",
								"description" => __("Button border radius. From 0 to 30px values accepted", 'dfd'),
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Button Hover Background Color", 'dfd'),
								"param_name" => "btn_hover_bg_color",
								"value" => "",
								"description" => __("Give it a nice paint!", 'dfd'),
								"dependency" => Array("element" => "modal_on","value" => array("ult-button")),
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Button Hover Text Color", 'dfd'),
								"param_name" => "btn_hover_txt_color",
								"value" => "",
								"description" => __("Give it a nice paint!", 'dfd'),
								"dependency" => Array("element" => "modal_on","value" => array("ult-button")),
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Button Hover Border Color", 'dfd'),
								"param_name" => "btn_hover_border_color",
								"value" => "",
								"description" => __("Give it a nice paint!", 'dfd'),
								"dependency" => Array("element" => "modal_on","value" => array("ult-button")),
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Alignment", 'dfd'),
								"param_name" => "modal_on_align",
								"value" => array(
									__('Center','dfd') => "center",
									__('Left','dfd') => "left",
									__('Right','dfd') => "right",
								),
								"dependency"=>Array("element"=>"modal_on","value"=>array("button","image","text")),
								"description" => __("Selector the alignment of button/text/image", 'dfd')
							),
							array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("Text on Button", 'dfd'),
								"param_name" => "btn_text",
								"admin_label" => true,
								"value" => "",
								"description" => __("Provide the title for this button.", 'dfd'),
								"dependency" => Array("element" => "modal_on","value" => array("ult-button")),
							),
							// Custom text for modal trigger
							array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("Enter Text", 'dfd'),
								"param_name" => "read_text",
								"value" => "",
								"description" => __("Enter the text on which the modal box will be triggered.", 'dfd'),
								"dependency" => Array("element" => "modal_on","value" => array("text")),
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Text Color", 'dfd'),
								"param_name" => "txt_color",
								"value" => "",
								"description" => __("Give it a nice paint!", 'dfd'),
								"dependency" => Array("element" => "modal_on","value" => array("text")),
							),
							// Modal box size
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Modal Size", 'dfd'),
								"param_name" => "modal_size",
								"value" => array(
									__('Small','dfd') => "small",
									__('Medium','dfd') => "medium",
									__('Large','dfd') => "container",
									__('Block','dfd') => "block",
								),
								"description" => __("How big the modal box would you like?", 'dfd'),
							),
							// Modal Style
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => "Modal Box Style",
								"param_name" => "modal_style",
								"value" => array(
									__('Corner Bottom Left','dfd') => "overlay-cornerbottomleft",
									__('Corner Bottom Right','dfd') => "overlay-cornerbottomright",
									__('Corner Top Left','dfd') => "overlay-cornertopleft",
									__('Corner Top Right','dfd') => "overlay-cornertopright",
									__('Corner Shape','dfd') => "overlay-show-cornershape",
									__('Door Horizontal','dfd') => "overlay-doorhorizontal",
									__('Door Vertical','dfd') => "overlay-doorvertical",
									__('Fade','dfd') => "overlay-fade",
									__('Genie','dfd') => "overlay-show-genie",
									__('Little Boxes','dfd') => "overlay-show-boxes",
									__('Simple Genie','dfd') => "overlay-simplegenie",
									__('Slide Down','dfd') => "overlay-slidedown",
									__('Slide Up','dfd') => "overlay-slideup",
									__('Slide Left','dfd') => "overlay-slideleft",
									__('Slide Right','dfd') => "overlay-slideright",
									__('Zoom in','dfd') => "overlay-zoomin",
									__('Zoom out','dfd') => "overlay-zoomout",
								),
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Overlay Background Color", 'dfd'),
								"param_name" => "overlay_bg_color",
								"value" => "#333333",
								"description" => __("Give it a nice paint!", 'dfd'),
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Overlay Background Opacity", 'dfd'),
								"param_name" => "overlay_bg_opacity",
								"value" => 80,
								"min" => 10,
								"max" => 100,
								"suffix" => "%",
								"description" => __("Select opacity of overlay background.", 'dfd'),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Background Style', 'dfd'),
								'param_name' => 'content_bg_check',
								'value' => array(
									__('Light background', 'dfd') => '',
									__('Dark background', 'dfd') => 'dfd-background-dark'
								),
								'description' => __('Please specify background style for correct shortcodes appearance.', 'dfd'),
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Content Background Color", 'dfd'),
								"param_name" => "content_bg_color",
								"value" => "",
								"description" => __("Give it a nice paint!", 'dfd'),
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Content Text Color", 'dfd'),
								"param_name" => "content_text_color",
								"value" => "",
								"description" => __("Give it a nice paint!", 'dfd'),
							),
							/*array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Header Background Color", 'dfd'),
								"param_name" => "header_bg_color",
								"value" => "",
								"description" => __("Give it a nice paint!", 'dfd'),
							),*/
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Header Text Color", 'dfd'),
								"param_name" => "header_text_color",
								"value" => "#333333",
								"description" => __("Give it a nice paint!", 'dfd'),
							),
							// Modal box size
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Modal Box Border", 'dfd'),
								"param_name" => "modal_border_style",
								"value" => array(
									__('None','dfd') => "",
									__('Solid','dfd') => "solid",
									__('Double','dfd') => "double",
									__('Dashed','dfd') => "dashed",
									__('Dotted','dfd') => "dotted",
									__('Inset','dfd') => "inset",
									__('Outset','dfd') => "outset",
								),
								"description" => __("Do you want to give border to the modal content box?", 'dfd'),
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Border Width", 'dfd'),
								"param_name" => "modal_border_width",
								"value" => 2,
								"min" => 1,
								"max" => 25,
								"suffix" => "px",
								"description" => __("Select size of border.", 'dfd'),
								"dependency" => Array("element" => "modal_border_style","not_empty" => true),
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Border Color", 'dfd'),
								"param_name" => "modal_border_color",
								"value" => "#333333",
								"description" => __("Give it a nice paint!", 'dfd'),
								"dependency" => Array("element" => "modal_border_style","not_empty" => true),
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Border Radius", 'dfd'),
								"param_name" => "modal_border_radius",
								"value" => 0,
								"min" => 1,
								"max" => 500,
								"suffix" => "px",
								"description" => __("Want to shape the modal content box?.", 'dfd'),
								"dependency" => Array("element" => "modal_border_style","not_empty" => true),
							),
							array(
								'type' => 'checkbox',
								'class' => '',
								'heading' => __('Disable shadow','dfd'),
								'param_name' => 'modal_box_shadow_disable',
								'value' => array('Yes, please' => 'yes'),
							),
							// Customize everything
							array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("Extra Class", 'dfd'),
								"param_name" => "el_class",
								"value" => "",
								"description" => __("Add extra class name that will be applied to the modal popup, and you can use this class for your customizations.", 'dfd'),
							),
							array(
								"type" => "heading",
								"sub_heading" => "<span style='display: block;'><a href='http://bsf.io/ei2r5' target='_blank'>Watch Video Tutorial &nbsp; <span class='dashicons dashicons-video-alt3' style='font-size:30px;vertical-align: middle;color: #e52d27;'></span></a></span>",
								"param_name" => "notification",
								'edit_field_class' => 'ult-param-important-wrapper ult-dashicon ult-align-right ult-bold-font ult-blue-font vc_column vc_col-sm-12',
							),
						) // end params array
					) // end vc_map array
				); // end vc_map
			} // end function check 'vc_map'
		}// end function icon_box_init
	}//Class Ultimate_Modals end
}
if(class_exists('Ultimate_Modals'))
{
	$Ultimate_Modals = new Ultimate_Modals;
}