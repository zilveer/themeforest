<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
Add-on: Ultimate Parallax Background for VC
Add-on URI: https://brainstormforce.com/demos/parallax/
Description: Display interactive image and video parallax background in visual composer row
Version: 1.0
*/
if(!class_exists('VC_Ultimate_Parallax')){
	class VC_Ultimate_Parallax{
		function __construct(){
			add_action('admin_enqueue_scripts',array($this,'admin_scripts'));
			/*add_action('wp_enqueue_scripts',array($this,'front_scripts'),9999); */
			add_action('init',array($this,'parallax_init'));
			add_filter('parallax_image_video',array($this,'parallax_shortcode'), 10, 2);
			/*if ( function_exists('vc_add_shortcode_param')) {
				//vc_add_shortcode_param('number' , array(&$this, 'number_settings_field' ) );
				vc_add_shortcode_param('radio_image_box' , array(&$this, 'radio_image_settings_field' ) );
			}
			if ( function_exists('vc_add_shortcode_param')) {
				vc_add_shortcode_param('gradient' , array(&$this, 'gradient_picker' ) );
			}
			*/
		}/* end constructor */
		
		public static function parallax_shortcode($atts, $content){
			$canvas_color = $bg_color_value = $bg_type = $bg_image = $bg_image_new = $bg_image_canvas = $bsf_img_repeat = $parallax_style = $video_opts = $video_url = $video_url_2 = $video_poster = $bg_image_size = $bg_image_posiiton = $u_video_url = $parallax_sense = $parallax_offset = $bg_cstm_size = $bg_override = $bg_img_attach = $u_start_time = $u_stop_time = $layer_image = $css = $animation_type = $horizontal_animation = $vertical_animation = $animation_speed = $animated_bg_color = $fadeout_row = $fadeout_start_effect = $parallax_content = $parallax_content_sense = $disable_on_mobile = $disable_on_mobile_img_parallax = $animation_repeat = $animation_direction = $enable_overlay = $overlay_color = $overlay_pattern = $overlay_pattern_opacity = $overlay_pattern_size = $multi_color_overlay = $overlay = $canvas_style = $canvas_size = "";
			
			$seperator_html = $seperator_bottom_html = $seperator_top_html = $seperator_css = $seperator_enable = $seperator_type = $seperator_position = $seperator_shape_size = $seperator_shape_background = $seperator_shape_border = $seperator_shape_border_color = $seperator_shape_border_width = '';
			
			$ult_hide_row = $ult_hide_row_large_screen = $ult_hide_row_desktop = $ult_hide_row_tablet = $ult_hide_row_tablet_small = $ult_hide_row_mobile = $ult_hide_row_mobile_large = '';
			
			extract( shortcode_atts( array(
			    'bg_type' 					=> 'no_bg',
			    'canvas_style' 				=> 'style_1',
			    'canvas_size' 				=> 'parent',
				'bg_image' 					=> '',
				'bg_image_new' 				=> '',
				'bg_image_canvas' 			=> '',
				'bg_image_repeat' 			=> 'repeat',
				'bg_image_size'				=> 'cover',
				'parallax_style' 			=> 'vcpb-default',
				'parallax_sense'			=> '30',
				'parallax_offset'			=> '',
				'video_opts' 				=> '',
				'bg_image_posiiton'			=> '',
				'video_url' 				=> '',
				'video_url_2' 				=> '',
				'video_poster' 				=> '',
				'u_video_url' 				=> '',
				'bg_cstm_size'				=> '',
				'bg_override'				=> '0',
				'bg_img_attach' 			=> 'scroll',
				'u_start_time'				=> '',
				'u_stop_time'				=> '',
				'layer_image'				=> '',
				'bg_grad'					=> '',
				'bg_color_value' 			=> '',		
				'canvas_color'				=> '',		
				'bg_fade'					=> '',
				'css' 						=> '',
				'viewport_vdo' 				=> '',
				'enable_controls' 			=> '',
				'controls_color' 			=> '',
				'animation_direction' 		=> 'left-animation',
				'animation_type' 			=> 'false',
				'horizontal_animation' 		=> '',
				'vertical_animation' 		=> '',
				'animation_speed' 			=> '',
				'animation_repeat' 			=> 'repeat',
				'animated_bg_color' 		=> '',
				'fadeout_row' 				=> '',
				'fadeout_start_effect' 		=> '30',
				'parallax_content'			=> '',
				'parallax_content_sense'	=> '30',
				'disable_on_mobile'			=> '',
				//'disable_on_mobile_img_parallax' => '',
				'enable_overlay' 			=> '',
				'overlay_color'				=> '',
				'overlay_pattern' 			=> '',
				'overlay_pattern_opacity' 	=> '80',
				'overlay_pattern_size' 		=> '',
				'multi_color_overlay'		=> '',
				'multi_color_overlay_opacity' => '0.6',
				'seperator_enable' 			=> '',
				'seperator_type' 			=> 'none_seperator',
				'seperator_position'		=> '',
				'seperator_shape_size' 		=> '40',
				'seperator_shape_background' => '#fff',
				'seperator_shape_border' 	=> 'none',
				'seperator_shape_border_color' => '',
				'seperator_shape_border_width' => '1',
				'seperator_svg_height' 		=> '60',
				'icon_type'					=> 'no_icon',
				'icon'						=> '',
				'icon_color'				=> '',
				'icon_style'				=> 'none',
				'icon_color_bg'				=> '',
				'icon_border_style'			=> '',
				'icon_color_border'			=> '#333333',
				'icon_border_size'			=> '1',
				'icon_border_radius'		=> '50',
				'icon_border_spacing'		=> '50',
				'icon_img'					=> '',
				'img_width'					=> '48',
				'icon_size'					=> '32',
				'ult_hide_row'				=> '',
				'ult_hide_row_large_screen' => '',
				'ult_hide_row_desktop'		=> '',
				'ult_hide_row_tablet'		=> '',
				'ult_hide_row_tablet_small' => '',
				'ult_hide_row_mobile'		=> '',
				'ult_hide_row_mobile_large'	=> '',
				'video_fixer' 				=> 'true'
			), $atts ) );
			
			$parallax_offset_value = '';
			if(isset($parallax_offset) && !empty($parallax_offset) && $parallax_style == 'vcpb-vz-jquery') {
				$parallax_offset_value .= 'data-parallax_offset="'.esc_attr($parallax_offset).'"';
			}
			
			/* enqueue scripts */
			if(($bg_type !== '' && $bg_type !== 'no_bg') || $parallax_content != '' || $fadeout_row != ''){
				/*
				$ultimate_js = get_option('ultimate_js');
				
				if($ultimate_js != 'enable') :
					if($bg_type == 'no_bg' && ($parallax_content != '' || $fadeout_row != '')) {
						wp_enqueue_script('ultimate-row-bg',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-js/ultimate_bg.min.js?'.$bg_type);
						wp_enqueue_script('ultimate-custom');
					} else if($bg_type != 'no_bg' && ($parallax_content != '' || $fadeout_row != '')) {
						wp_enqueue_script('ultimate-appear');
						wp_enqueue_script('ultimate-row-bg',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-js/ultimate_bg.min.js?'.$bg_type);
						wp_enqueue_script('ultimate-custom');
					} else if($bg_type != 'no_bg' && ($parallax_content == '' || $fadeout_row == '')) {
						wp_enqueue_script('ultimate-appear');
						wp_enqueue_script('ultimate-row-bg',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-js/ultimate_bg.min.js?'.$bg_type);
						wp_enqueue_script('ultimate-custom');
					}
				endif;		
				*/
				$html = $autoplay = $muted = $loop = $pos_suffix = $bg_img = $bg_img_id = $icon_inline = '';
				
				//if($disable_on_mobile != '')
				//{
				//	if($disable_on_mobile == 'enable_on_mobile_value')
				//		$disable_on_mobile = 'false';
				//	else
				//		$disable_on_mobile = 'true';
				//}
				//else
					$disable_on_mobile = 'true';
				/*
				if($disable_on_mobile_img_parallax == 'off')
					$disable_on_mobile_img_parallax = 'true';
				else
					$disable_on_mobile_img_parallax = 'false';
				*/	
				$disable_on_mobile_img_parallax = 'true';
				// for overlay	
				if($enable_overlay == 'enable_overlay_value') {
					if($overlay_pattern != 'transperant' && $overlay_pattern != '') {
						$pattern_url = get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/images/patterns/'.$overlay_pattern;
						
					} else {
						$pattern_url = '';
					}
					if(preg_match('/^#[a-f0-9]{6}$/i', $overlay_color)) { //hex color is valid
						$overlay_color = hex2rgbUltParallax($overlay_color, $opacity = 0.2);
					}

					if(strpos( $overlay_pattern_opacity, '.' ) === false) {
						$overlay_pattern_opacity = $overlay_pattern_opacity/100;
					}
						
					$overlay = ' data-overlay="true" data-overlay-color="'.esc_attr($overlay_color).'" data-overlay-pattern="'.esc_attr($pattern_url).'" data-overlay-pattern-opacity="'.$overlay_pattern_opacity.'" data-overlay-pattern-size="'.$overlay_pattern_size.'" ';
					
					if($multi_color_overlay == 'uvc-multi-color-bg') {
						$multi_color_overlay_opacity = $multi_color_overlay_opacity/100;
						$overlay .= ' data-multi-color-overlay="'.esc_attr($multi_color_overlay).'" data-multi-color-overlay-opacity="'.esc_attr($multi_color_overlay_opacity).'" ';
					}
				} else {
					$overlay = ' data-overlay="false" data-overlay-color="" data-overlay-pattern="" data-overlay-pattern-opacity="" data-overlay-pattern-size="" ';
				}
				
				// for seperator 
				if($seperator_enable == 'seperator_enable_value') {
					$seperator_bottom_html = ' data-seperator="true" ';
					$seperator_bottom_html .= ' data-seperator-type="'.esc_attr($seperator_type).'" ';
					$seperator_bottom_html .= ' data-seperator-shape-size="'.esc_attr($seperator_shape_size).'" ';
					$seperator_bottom_html .= ' data-seperator-svg-height="'.esc_attr($seperator_svg_height).'" ';
					$seperator_bottom_html .= ' data-seperator-full-width="true"';
					$seperator_bottom_html .= ' data-seperator-position="'.esc_attr($seperator_position).'" ';
					
					if($seperator_shape_background != '')
						$seperator_bottom_html .= ' data-seperator-background-color="'.esc_attr($seperator_shape_background).'" ';
					if($seperator_shape_border != 'none')
					{
						$seperator_bottom_html .= ' data-seperator-border="'.esc_attr($seperator_shape_border).'" ';
						$bwidth = ($seperator_shape_border_width == '') ? '1' : $seperator_shape_border_width;
						$seperator_bottom_html .= ' data-seperator-border-width="'.esc_attr($bwidth).'" ';
						$seperator_bottom_html .= ' data-seperator-border-color="'.esc_attr($seperator_shape_border_color).'" ';
					}
					
					if($icon_type != 'no_icon')
					{
						$icon_animation = '';
						$alignment = 'center';
						$icon_inline = do_shortcode('[just_icon icon_align="'.$alignment.'" icon_type="'.$icon_type.'" icon="'.$icon.'" icon_img="'.$icon_img.'" img_width="'.$img_width.'" icon_size="'.$icon_size.'" icon_color="'.$icon_color.'" icon_style="'.$icon_style.'" icon_color_bg="'.$icon_color_bg.'" icon_color_border="'.$icon_color_border.'"  icon_border_style="'.$icon_border_style.'" icon_border_size="'.$icon_border_size.'" icon_border_radius="'.$icon_border_radius.'" icon_border_spacing="'.$icon_border_spacing.'" icon_animation="'.$icon_animation.'"]');
					}
					$seperator_bottom_html .= ' data-icon="'.htmlentities($icon_inline).'" ';
				}
				
				$seperator_html = $seperator_top_html.' '.$seperator_bottom_html;
				
				// for hide row
				$device_message = $ult_hide_row_data = '';
				if($ult_hide_row == 'ult_hide_row_value') {
					if($ult_hide_row_large_screen == 'large_screen')
						$ult_hide_row_data .= ' uvc_hidden-lg ';
					if($ult_hide_row_desktop == 'desktop')
						$ult_hide_row_data .= ' uvc_hidden-ml ';
					if($ult_hide_row_tablet == 'tablet')
						$ult_hide_row_data .= ' uvc_hidden-md ';
					if($ult_hide_row_tablet_small == 'xs_tablet')
						$ult_hide_row_data .= ' uvc_hidden-sm ';
					if($ult_hide_row_mobile == 'mobile')
						$ult_hide_row_data .= ' uvc_hidden-xs ';
					if($ult_hide_row_mobile_large == 'xl_mobile')
						$ult_hide_row_data .= ' uvc_hidden-xsl ';
						
					if($ult_hide_row_data != '')
						$ult_hide_row_data = ' data-hide-row="'.esc_attr($ult_hide_row_data).'" ';
				}
				
				// RTL 
				$rtl = 'false';
				if(is_rtl())
					$rtl = 'true';
				
				$output = '<!-- Row Backgrounds {'.esc_attr($device_message).'} -->';
				if($bg_image_new != ""){
					$bg_img_id = $bg_image_new;
				} elseif( $bg_image != ""){
					$bg_img_id = $bg_image;
				} else {
					if($css !== ""){
						$arr = explode('?id=', $css);
						if(isset($arr[1])){
							$arr = explode(')', $arr[1]);
							$bg_img_id = $arr[0];
						}
					}
				}
				if($bg_image_posiiton!=''){
					if(strpos($bg_image_posiiton, 'px')){
						$pos_suffix ='px';
					}
					elseif(strpos($bg_image_posiiton, 'em')){
						$pos_suffix ='em';
					}
					else{
						$pos_suffix='%';
					}
				}			
				if($bg_type== "no_bg"){
					$html .= '<div class="upb_no_bg" data-fadeout="'.esc_attr($fadeout_row).'" data-fadeout-percentage="'.esc_attr($fadeout_start_effect).'" data-parallax-content="'.esc_attr($parallax_content).'" data-parallax-content-sense="'.esc_attr($parallax_content_sense).'" data-row-effect-mobile-disable="'.esc_attr($disable_on_mobile).'" data-img-parallax-mobile-disable="'.esc_attr($disable_on_mobile_img_parallax).'" data-rtl="'.esc_attr($rtl).'" '.$seperator_html.' '.$ult_hide_row_data.'></div>';
				} elseif($bg_type == "canvas_animated"){
					$unique_id = uniqid('dfd-canvas-bg-');
					$data_canvas_color = 'data-canvas-color="'.esc_attr($canvas_color).'"';
					if($canvas_style == 'style_1') {
						wp_enqueue_script('dfd-tweenlite');
						wp_enqueue_script('dfd-easepack');
						wp_enqueue_script('dfd-rAF');
					} elseif ($canvas_style == 'style_2') {
						wp_enqueue_script('dfd-particleground');
					} elseif ($canvas_style == 'style_3') {
						wp_enqueue_script('dfd-three');
						wp_enqueue_script('dfd-projector');
						wp_enqueue_script('dfd-canvas-renderer');
					} elseif ($canvas_style == 'style_4') {
						wp_enqueue_script('dfd-particleground-old');
					}
					$bg_img_url = '';
					if($bg_image_canvas){
						$bg_img = wp_get_attachment_image_src($bg_image_canvas,'full');
						$bg_img_url = $bg_img[0];
					}
					$html .= '<div class="dfd_bg_canvas" data-canvas-id="'.esc_attr($unique_id).'" data-canvas-style="'.esc_attr($canvas_style).'" data-canvas-size="'.esc_attr($canvas_size).'" '.$data_canvas_color.' data-bg-color="'.esc_attr($bg_color_value).'" data-ultimate-bg="url('.esc_url($bg_img_url).')" data-image-id="'.esc_attr($bg_img_id).'" data-ultimate-bg-style="'.esc_attr($bg_type).'" data-bg-img-repeat="'.esc_attr($bg_image_repeat).'" data-bg-img-size="'.esc_attr($bg_image_size).'" data-bg-img-position="'.esc_attr($bg_image_posiiton).'" data-bg-override="'.esc_attr($bg_override).'" data-bg_img_attach="'.esc_attr($bg_img_attach).'" data-upb-overlay-color="'.esc_attr($overlay_color).'" data-upb-bg-animation="'.esc_attr($bg_fade).'" data-fadeout="'.esc_attr($fadeout_row).'" data-fadeout-percentage="'.esc_attr($fadeout_start_effect).'" data-parallax-content="'.esc_attr($parallax_content).'" data-parallax-content-sense="'.esc_attr($parallax_content_sense).'" data-row-effect-mobile-disable="'.esc_attr($disable_on_mobile).'" data-img-parallax-mobile-disable="'.esc_attr($disable_on_mobile_img_parallax).'" data-rtl="'.esc_attr($rtl).'" '.$overlay.' '.$seperator_html.' '.$ult_hide_row_data.'></div>';
				} elseif($bg_type == "image"){
					if($bg_image_size=='cstm'){
						if($bg_cstm_size!=''){
							$bg_image_size = $bg_cstm_size;
						}
					}
					if($parallax_style == 'vcpb-fs-jquery' || $parallax_style=="vcpb-mlvp-jquery"){
						if($parallax_style == 'vcpb-fs-jquery')
							wp_enqueue_script('jquery.shake',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-js/jparallax.min.js');
						
						if($parallax_style=="vcpb-mlvp-jquery")
							wp_enqueue_script('jquery.vhparallax',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-js/jquery.vhparallax.min.js');
						$imgs = explode(',',$layer_image);
						$layer_image = array();
						foreach ($imgs as $value) {
							$layer_image[] = wp_get_attachment_image_src($value,'full');
						}
						foreach ($layer_image as $key=>$value) {
							$bg_imgs[]=$layer_image[$key][0];
						}
						$html .= '<div class="upb_bg_img" data-ultimate-bg="'.implode(',', $bg_imgs).'" data-ultimate-bg-style="'.esc_attr($parallax_style).'" data-bg-img-repeat="'.esc_attr($bg_image_repeat).'" data-bg-img-size="'.esc_attr($bg_image_size).'" data-bg-img-position="'.esc_attr($bg_image_posiiton).'" data-parallx_sense="'.esc_attr($parallax_sense).'" '.$parallax_offset_value.' data-bg-override="'.esc_attr($bg_override).'" data-bg_img_attach="'.esc_attr($bg_img_attach).'" data-upb-overlay-color="'.esc_attr($overlay_color).'" data-upb-bg-animation="'.esc_attr($bg_fade).'" data-fadeout="'.esc_attr($fadeout_row).'" data-fadeout-percentage="'.esc_attr($fadeout_start_effect).'" data-parallax-content="'.esc_attr($parallax_content).'" data-parallax-content-sense="'.esc_attr($parallax_content_sense).'" data-row-effect-mobile-disable="'.esc_attr($disable_on_mobile).'" data-img-parallax-mobile-disable="'.esc_attr($disable_on_mobile_img_parallax).'" data-rtl="'.esc_attr($rtl).'" '.$overlay.' '.$seperator_html.' '.$ult_hide_row_data.'></div>';
					} else{
						//if($parallax_style == 'vcpb-vz-jquery' || $parallax_style=="vcpb-hz-jquery")
							//wp_enqueue_script('jquery.vhparallax',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-js/jquery.vhparallax.min.js');
							
						if($bg_img_id){
							if($animation_direction == '' && $animation_type != 'false')
							{
								if($animation_type == 'h')
									$animation = $horizontal_animation;
								else
									$animation = $vertical_animation;
							}
							else
							{
								if($animation_direction == 'top-animation' || $animation_direction == 'bottom-animation')
									$animation_type = 'v';
								else
									$animation_type = 'h';
									$animation = $animation_direction;
								if($animation == '')
									$animation = 'left-animation';
							}
							
							$bg_img = wp_get_attachment_image_src($bg_img_id,'full');
							$html .= '<div class="upb_bg_img" data-ultimate-bg="url('.esc_url($bg_img[0]).')" data-image-id="'.esc_attr($bg_img_id).'" data-ultimate-bg-style="'.esc_attr($parallax_style).'" data-bg-img-repeat="'.esc_attr($bg_image_repeat).'" data-bg-img-size="'.esc_attr($bg_image_size).'" data-bg-img-position="'.esc_attr($bg_image_posiiton).'" data-parallx_sense="'.esc_attr($parallax_sense).'" '.$parallax_offset_value.' data-bg-override="'.esc_attr($bg_override).'" data-bg_img_attach="'.esc_attr($bg_img_attach).'" data-upb-overlay-color="'.esc_attr($overlay_color).'" data-upb-bg-animation="'.esc_attr($bg_fade).'" data-fadeout="'.esc_attr($fadeout_row).'" data-bg-animation="'.esc_attr($animation).'" data-bg-animation-type="'.esc_attr($animation_type).'" data-animation-repeat="'.esc_attr($animation_repeat).'" data-fadeout-percentage="'.esc_attr($fadeout_start_effect).'" data-parallax-content="'.esc_attr($parallax_content).'" data-parallax-content-sense="'.esc_attr($parallax_content_sense).'" data-row-effect-mobile-disable="'.esc_attr($disable_on_mobile).'" data-img-parallax-mobile-disable="'.esc_attr($disable_on_mobile_img_parallax).'" data-rtl="'.esc_attr($rtl).'" '.$overlay.' '.$seperator_html.' '.$ult_hide_row_data.'></div>';
						}
					}
				} elseif($bg_type == "video"){
					$v_opts = explode(",",$video_opts);
					if(is_array($v_opts)){
						foreach($v_opts as $opt){
							if($opt == "muted") $muted .= $opt;
							if($opt == "autoplay") $autoplay .= $opt;
							if($opt == "loop") $loop .= $opt;
						}
					}
					if($viewport_vdo != '')
						$enable_viewport_vdo = 'true';
					else
						$enable_viewport_vdo = 'false';
						
					$video_fixer_option = get_option('ultimate_video_fixer');
					if($video_fixer_option) {
						if($video_fixer_option == 'enable')
							$video_fixer = 'false';
					}
						
					$u_stop_time = ($u_stop_time!='')?$u_stop_time:0;
					$u_start_time = ($u_stop_time!='')?$u_start_time:0;
					$v_img = wp_get_attachment_image_src($video_poster,'full');				
					$html .= '<div class="upb_content_video" data-controls-color="'.esc_attr($controls_color).'" data-controls="'.esc_attr($enable_controls).'" data-viewport-video="'.esc_attr($enable_viewport_vdo).'" data-ultimate-video="'.esc_url($video_url).'" data-ultimate-video2="'.esc_attr($video_url_2).'" data-ultimate-video-muted="'.esc_attr($muted).'" data-ultimate-video-loop="'.esc_attr($loop).'" data-ultimate-video-poster="'.esc_url($v_img[0]).'" data-ultimate-video-autoplay="autoplay" data-bg-override="'.esc_attr($bg_override).'" data-upb-overlay-color="'.esc_attr($overlay_color).'" data-upb-bg-animation="'.esc_attr($bg_fade).'" data-fadeout="'.esc_attr($fadeout_row).'" data-fadeout-percentage="'.esc_attr($fadeout_start_effect).'" data-parallax-content="'.esc_attr($parallax_content).'" data-parallax-content-sense="'.esc_attr($parallax_content_sense).'" data-row-effect-mobile-disable="'.esc_attr($disable_on_mobile).'" data-rtl="'.esc_attr($rtl).'" data-img-parallax-mobile-disable="'.esc_attr($disable_on_mobile_img_parallax).'" '.$overlay.' '.$seperator_html.' '.$ult_hide_row_data.' data-video_fixer="'.$video_fixer.'"></div>';
					
					if($enable_controls == 'display_control')
						wp_enqueue_style('ultimate-vidcons',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/fonts/vidcons.css');
				} elseif ($bg_type=='u_iframe') {
					//wp_enqueue_script('jquery.tublar',plugins_url('../assets/js/tubular.js',__FILE__));
					wp_enqueue_script('jquery.ytplayer',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-js/jquery.mb.YTPlayer.min.js');
					$v_opts = explode(",",$video_opts);
					$v_img = wp_get_attachment_image_src($video_poster,'full');
					if(is_array($v_opts)){
						foreach($v_opts as $opt){
							if($opt == "muted") $muted .= $opt;
							if($opt == "autoplay") $autoplay .= $opt;
							if($opt == "loop") $loop .= $opt;
						}
					}
					if($viewport_vdo != '') {
						
						$enable_viewport_vdo = 'true';
					} else {
						$enable_viewport_vdo = 'false';
					}
						
					$video_fixer_option = get_option('ultimate_video_fixer');
					if($video_fixer_option) {
						if($video_fixer_option == 'enable')
							$video_fixer = 'false';
					}
					
					$html .= '<div class="upb_content_iframe" data-controls="'.esc_attr($enable_controls).'" data-viewport-video="'.esc_attr($enable_viewport_vdo).'" data-ultimate-video="'.esc_url($u_video_url).'" data-bg-override="'.esc_attr($bg_override).'" data-start-time="'.esc_attr($u_start_time).'" data-stop-time="'.esc_attr($u_stop_time).'" data-ultimate-video-muted="'.esc_attr($muted).'" data-ultimate-video-loop="'.esc_attr($loop).'" data-ultimate-video-poster="'.esc_url($v_img[0]).'" data-upb-overlay-color="'.esc_attr($overlay_color).'" data-upb-bg-animation="'.esc_attr($bg_fade).'" data-fadeout="'.esc_attr($fadeout_row).'" data-fadeout-percentage="'.esc_attr($fadeout_start_effect).'"  data-parallax-content="'.esc_attr($parallax_content).'" data-parallax-content-sense="'.esc_attr($parallax_content_sense).'" data-row-effect-mobile-disable="'.esc_attr($disable_on_mobile).'" data-img-parallax-mobile-disable="'.esc_attr($disable_on_mobile_img_parallax).'" data-rtl="'.esc_attr($rtl).'" '.$overlay.' '.$seperator_html.' '.$ult_hide_row_data.' data-video_fixer="'.$video_fixer.'"></div>';
				} elseif ($bg_type == 'grad') {
					$html .= '<div class="upb_grad" data-grad="'.esc_attr($bg_grad).'" data-bg-override="'.esc_attr($bg_override).'" data-upb-overlay-color="'.esc_attr($overlay_color).'" data-upb-bg-animation="'.esc_attr($bg_fade).'" data-fadeout="'.esc_attr($fadeout_row).'" data-fadeout-percentage="'.esc_attr($fadeout_start_effect).'" data-parallax-content="'.esc_attr($parallax_content).'" data-parallax-content-sense="'.esc_attr($parallax_content_sense).'" data-row-effect-mobile-disable="'.esc_attr($disable_on_mobile).'" data-img-parallax-mobile-disable="'.esc_attr($disable_on_mobile_img_parallax).'" data-rtl="'.esc_attr($rtl).'" '.$overlay.' '.$seperator_html.' '.$ult_hide_row_data.'></div>';
				} elseif($bg_type == 'bg_color'){
					$html .= '<div class="upb_color" data-bg-override="'.esc_attr($bg_override).'" data-bg-color="'.esc_attr($bg_color_value).'" data-fadeout="'.esc_attr($fadeout_row).'" data-fadeout-percentage="'.esc_attr($fadeout_start_effect).'" data-parallax-content="'.esc_attr($parallax_content).'" data-parallax-content-sense="'.esc_attr($parallax_content_sense).'" data-row-effect-mobile-disable="'.esc_attr($disable_on_mobile).'" data-img-parallax-mobile-disable="'.esc_attr($disable_on_mobile_img_parallax).'" data-rtl="'.esc_attr($rtl).'" '.$overlay.' '.$seperator_html.' '.$ult_hide_row_data.'></div>';
				}
				$output .= $html;
				if($bg_type=='no_bg'){
					return $output;
				} else {
					self::front_scripts();
					return $output;
				}
				
			}
		} /* end parallax_shortcode */
		function parallax_init(){
			$group_name = 'Ultimate Background';
			$group_effects = 'Ultimate Effects';
			if(function_exists('vc_remove_param')){
//				//vc_remove_param('vc_row','bg_image');
//				//vc_remove_param('vc_row','bg_image');
//				//vc_remove_param('vc_row','el_class');
//				vc_remove_param('vc_row','bg_image_repeat');
//				vc_remove_param('vc_row','font_color');
//				vc_remove_param('vc_row','full_width');
//				vc_remove_param('vc_row','el_id');
//				vc_remove_param('vc_row','parallax');
//				vc_remove_param('vc_row','parallax_image');
//				//vc_remove_param('vc_row','full_height');
//				//vc_remove_param('vc_row','content_placement');
//				vc_remove_param('vc_row','video_bg');
//				vc_remove_param('vc_row','video_bg_url');
//				vc_remove_param('vc_row','video_bg_parallax');
			}
			
			//$pluginname = dirname(dirname(plugin_basename( __FILE__ )));
			
			$patterns_list = glob(locate_template('/inc/vc_custom/Ultimate_VC_Addons/assets/images/patterns/').'/*.*');
			$patterns = array();
			
			foreach($patterns_list as $pattern)
				$patterns[basename($pattern)] = get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/images/patterns/'.basename($pattern);
				
			/*	
			$separator_path = realpath(dirname(plugin_dir_path(__FILE__)).'/assets/images/separator');
			$separator_list = glob($separator_path.'/*.*');
			$separator_imgs = array();
			
			foreach($separator_list as $separator)
				$separator_imgs[basename($separator)] = get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/'.$pluginname.'/assets/images/separator/'.basename($separator);*/
			if(function_exists('vc_add_param')){
				vc_add_param('vc_row',array(
						'type' => 'dropdown',
						'class' => '',
						'admin_label' => true,
						'heading' => __('Background Style', 'dfd'),
						'param_name' => 'bg_type',
						'value' => array(
							__('Default','dfd') => 'no_bg',
							__('Single Color','dfd') => 'bg_color',
							__('Gradient Color','dfd') => 'grad',
							__('Image / Parallax (parallax is not available for One Page scroll page template)','dfd') => 'image',
							__('YouTube Video (not available for One Page scroll page template)','dfd') => 'u_iframe',
							__('Hosted Video (not available for One Page scroll page template)','dfd') => 'video',
							__('Animated Background','dfd') => 'canvas_animated',
							//__('No','dfd') => 'no_bg',
							),
						"description" => __("Select the kind of background would you like to set for this row. Not sure? See Narrated <a href='https://www.youtube.com/watch?v=Qxs8R-uaMWk&list=PL1kzJGWGPrW981u5caHy6Kc9I1bG1POOx' target='_blank'>Video Tutorials</a>", 'dfd'),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						'type' => 'dropdown',
						'class' => '',
						'admin_label' => true,
						'heading' => __('Background Style', 'dfd'),
						'param_name' => 'canvas_style',
						'value' => array(
							__('Style 1','dfd') => 'style_1',
							__('Style 2','dfd') => 'style_2',
							__('Style 3','dfd') => 'style_3',
							__('Style 4','dfd') => 'style_4',
						),
						"description" => __("", 'dfd'),
						"dependency" => array("element" => "bg_type","value" => array("canvas_animated")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						'type' => 'dropdown',
						'class' => '',
						'admin_label' => true,
						'heading' => __('Apply animation size to:', 'dfd'),
						'param_name' => 'canvas_size',
						'value' => array(
							__('Row size','dfd') => 'parent',
							__('Window size','dfd') => 'window',
						),
						"description" => __("", 'dfd'),
						"dependency" => array("element" => "bg_type","value" => array("canvas_animated")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "gradient",
						"class" => "",
						"heading" => __("Gradient Type", 'dfd'),						
						"param_name" => "bg_grad",
						"description" => __('At least two color points should be selected. <a href="https://www.youtube.com/watch?v=yE1M4AKwS44" target="_blank">Video Tutorial</a>', 'dfd'),
						"dependency" => array("element" => "bg_type","value" => array("grad")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __("Background Color", 'dfd'),						
						"param_name" => "bg_color_value",
						//"description" => __('At least two color points should be selected. <a href="https://www.youtube.com/watch?v=yE1M4AKwS44" target="_blank">Video Tutorial</a>', 'dfd'),
						"dependency" => array("element" => "bg_type","value" => array("bg_color", "canvas_animated")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __("Animated lines color", 'dfd'),						
						"param_name" => "canvas_color",
						//"description" => __('At least two color points should be selected. <a href="https://www.youtube.com/watch?v=yE1M4AKwS44" target="_blank">Video Tutorial</a>', 'dfd'),
						"dependency" => array("element" => "canvas_style","value" => array('style_2', 'style_4')),
						"group" => $group_name,
					)
				);
				vc_add_param("vc_row", array(
						"type" => "dropdown",
						"class" => "",
						"heading" => __("Parallax Style",'dfd'),
						"param_name" => "parallax_style",
						"value" => array(
							__("Simple Background Image",'dfd') => "vcpb-default",
							__("Auto Moving Background",'dfd') => "vcpb-animated",
							__("Vertical Parallax On Scroll",'dfd') => "vcpb-vz-jquery",
							__("Horizontal Parallax On Scroll",'dfd') => "vcpb-hz-jquery",
							__("Interactive Parallax On Mouse Hover",'dfd') => "vcpb-fs-jquery",
							__("Multilayer Vertical Parallax",'dfd') => "vcpb-mlvp-jquery",
						), 
						"description" => __("Select the kind of style you like for the background.",'dfd'),
						"dependency" => array("element" => "bg_type","value" => array("image")),
						"group" => $group_name,
					)
				);	
				vc_add_param('vc_row',array(
						"type" => "attach_image",
						"class" => "",
						"heading" => __("Background Image", 'dfd'),
						"param_name" => "bg_image_new",
						"value" => "",
						"description" => __("Upload or select background image from media gallery.", 'dfd'),
						"dependency" => array("element" => "parallax_style","value" => array("vcpb-default","vcpb-animated","vcpb-vz-jquery","vcpb-hz-jquery",)),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "attach_image",
						"class" => "",
						"heading" => __("Background Image", 'dfd'),
						"param_name" => "bg_image_canvas",
						"value" => "",
						"description" => __("Upload or select background image from media gallery.", 'dfd'),
						"dependency" => array("element" => "bg_type","value" => array("canvas_animated")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "attach_images",
						"class" => "",
						"heading" => __("Layer Images", 'dfd'),
						"param_name" => "layer_image",
						"value" => "",
						"description" => __("Upload or select background images from media gallery.", 'dfd'),
						"dependency" => array("element" => "parallax_style","value" => array("vcpb-fs-jquery","vcpb-mlvp-jquery")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "dropdown",
						"class" => "",
						"heading" => __("Background Image Repeat", 'dfd'),
						"param_name" => "bg_image_repeat",
						"value" => array(
								__("Repeat", 'dfd') => "repeat",
								__("Repeat X", 'dfd') => "repeat-x",
								__("Repeat Y", 'dfd') => "repeat-y",
								__("No Repeat", 'dfd') => "no-repeat",
							),
						"description" => __("Options to control repeatation of the background image. Learn on <a href='http://www.w3schools.com/cssref/playit.asp?filename=playcss_background-repeat' target='_blank'>W3School</a>", 'dfd'),
						"dependency" => Array("element" => "parallax_style","value" => array("vcpb-default","vcpb-fix","vcpb-vz-jquery","vcpb-hz-jquery")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "dropdown",
						"class" => "",
						"heading" => __("Background Image Size", 'dfd'),
						"param_name" => "bg_image_size",
						"value" => array(
								__("Cover - Image to be as large as possible", 'dfd') => "cover",
								__("Contain - Image will try to fit inside the container area", 'dfd') => "contain",
								__("Initial", 'dfd') => "initial",
								/*__("Automatic", 'dfd') => "automatic", */
							),
						"description" => __("Options to control size of the background image. Learn on <a href='http://www.w3schools.com/cssref/playit.asp?filename=playcss_background-size&preval=50%25' target='_blank'>W3School</a>", 'dfd'),
						"dependency" => Array("element" => "parallax_style","value" => array("vcpb-default","vcpb-animated","vcpb-fix","vcpb-vz-jquery","vcpb-hz-jquery")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("Custom Background Image Size", 'dfd'),
						"param_name" => "bg_cstm_size",
						"value" =>"",
						"description" => __("You can use initial, inherit or any number with px, em, %, etc. Example- 100px 100px", 'dfd'),
						"dependency" => Array("element" => "bg_image_size","value" => array("cstm")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "dropdown",
						"class" => "",
						"heading" => __("Scroll Effect", 'dfd'),
						"param_name" => "bg_img_attach",
						"value" => array(
								__("Move with the content", 'dfd') => "scroll",
								__("Fixed at its position", 'dfd') => "fixed",								
							),
						"description" => __("Options to set whether a background image is fixed or scroll with the rest of the page.", 'dfd'),
						"dependency" => Array("element" => "parallax_style","value" => array("vcpb-default","vcpb-animated","vcpb-hz-jquery","vcpb-vz-jquery")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "number",
						"class" => "",
						"heading" => __("Parallax Speed", 'dfd'),
						"param_name" => "parallax_sense",
						"value" =>"30",
						"min"=>"1",
						"max"=>"100",
						"description" => __("Control speed of parallax. Enter value between 1 to 100", 'dfd'),
						"dependency" => Array("element" => "parallax_style","value" => array("vcpb-vz-jquery","vcpb-animated","vcpb-hz-jquery","vcpb-vs-jquery","vcpb-hs-jquery","vcpb-fs-jquery","vcpb-mlvp-jquery")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "number",
						"class" => "",
						"heading" => __("Parallax Offset", 'dfd'),
						"param_name" => "parallax_offset",
						"value" =>"",
						"min"=>"-500",
						"max"=>"500",
						"description" => __("Parallax start offset value. Enter value between -500 to 500", 'dfd'),
						"dependency" => Array("element" => "parallax_style","value" => array("vcpb-vz-jquery")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("Background Image Posiiton", 'dfd'),
						"param_name" => "bg_image_posiiton",
						"value" =>"",	
						"description" => __("You can use any number with px, em, %, etc. Example- 100px 100px.", 'dfd'),
						"dependency" => Array("element" => "parallax_style","value" => array("vcpb-default","vcpb-fix")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						'type' => 'dropdown',
						'class' => '',
						'heading' => __('Animation Direction', 'dfd'),
						'param_name' => 'animation_direction',
						'value' => array(
								__('None', 'dfd') => '',
								__('Left to Right', 'dfd') => 'left-animation',
								__('Right to Left', 'dfd') => 'right-animation',
								__('Top to Bottom', 'dfd') => 'top-animation',
								__('Bottom to Top', 'dfd') => 'bottom-animation',
								
							),
						'dependency' => Array('element' => 'parallax_style','value' => array('vcpb-animated')),
						'group' => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "dropdown",
						"class" => "",
						"heading" => __("Background Repeat", 'dfd'),
						"param_name" => "animation_repeat",
						"value" => array(
								__("Repeat", 'dfd') => "repeat",
								__("Repeat X", 'dfd') => "repeat-x",
								__("Repeat Y", 'dfd') => "repeat-y",
								__("No Repeat", 'dfd') => "no-repeat",
							),
						"dependency" => Array("element" => "parallax_style","value" => array("vcpb-animated")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("Link to the video in MP4 Format", 'dfd'),
						"param_name" => "video_url",
						"value" => "",
						/*"description" => __("Enter your video URL. You can upload a video through <a href='".home_url()."/wp-admin/media-new.php' target='_blank'>WordPress Media Library</a>, if not done already.", 'dfd'),*/
						"dependency" => Array("element" => "bg_type","value" => array("video")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("Link to the video in WebM / Ogg Format", 'dfd'),
						"param_name" => "video_url_2",
						"value" => "",
						"description" => __("IE, Chrome & Safari <a href='http://www.w3schools.com/html/html5_video.asp' target='_blank'>support</a> MP4 format, while Firefox & Opera prefer WebM / Ogg formats. You can upload the video through <a href='".home_url()."/wp-admin/media-new.php' target='_blank'>WordPress Media Library</a>.", 'dfd'),
						"dependency" => Array("element" => "bg_type","value" => array("video")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("Enter YouTube URL of the Video", 'dfd'),
						"param_name" => "u_video_url",
						"value" => "",
						"description" => __("Enter YouTube url. Example - YouTube (https://www.youtube.com/watch?v=tSqJIIcxKZM) ", 'dfd'),
						"dependency" => Array("element" => "bg_type","value" => array("u_iframe")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "checkbox",
						"class" => "",
						"heading" => __("Extra Options", 'dfd'),
						"param_name" => "video_opts",
						"value" => array(
								__("Loop",'dfd') => "loop",
								__("Muted",'dfd') => "muted",
							),
						/*"description" => __("Select options for the video.", 'dfd'),*/
						"dependency" => Array("element" => "bg_type","value" => array("video","u_iframe")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "attach_image",
						"class" => "",
						"heading" => __("Placeholder Image", 'dfd'),
						"param_name" => "video_poster",
						"value" => "",
						"description" => __("Placeholder image is displayed in case background videos are restricted (Ex - on iOS devices).", 'dfd'),
						"dependency" => Array("element" => "bg_type","value" => array("video","u_iframe")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "number",
						"class" => "",
						"heading" => __("Start Time", 'dfd'),
						"param_name" => "u_start_time",
						"value" => "",
						"suffix" => "seconds",
						/*"description" => __("Enter time in seconds from where video start to play.", 'dfd'),*/
						"dependency" => Array("element" => "bg_type","value" => array("u_iframe")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "number",
						"class" => "",
						"heading" => __("Stop Time", 'dfd'),
						"param_name" => "u_stop_time",
						"value" => "",
						"suffix" => "seconds",
						"description" => __("You may start / stop the video at any point you would like.", 'dfd'),
						"dependency" => Array("element" => "bg_type","value" => array("u_iframe")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "chk-switch",
						"class" => "",
						"heading" => __("Play video only when in viewport", 'dfd'),
						"param_name" => "viewport_vdo",
						//"admin_label" => true,
						"value" => "",
						"options" => array(
								"viewport_play" => array(
									"label" => "",
									"on" => "Yes",
									"off" => "No",
								)
							),
						"description" => __("Video will be played only when user is on the particular screen position. Once user scroll away, the video will pause.", 'dfd'),
						"dependency" => Array("element" => "bg_type","value" => array("video","u_iframe")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "chk-switch",
						"class" => "",
						"heading" => __("Display Controls", 'dfd'),
						"param_name" => "enable_controls",
						//"admin_label" => true,
						"value" => "",
						"options" => array(
								"display_control" => array(
									"label" => "",
									"on" => "Yes",
									"off" => "No",
								)
							),
						"description" => __("Display play / pause controls for the video on bottom right position.", 'dfd'),
						"dependency" => Array("element" => "bg_type","value" => array("video")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __("Color of Controls Icon", 'dfd'),
						"param_name" => "controls_color",
						//"admin_label" => true,
						//"description" => __("Display play / pause controls for the video on bottom right position.", 'dfd'),
						"dependency" => Array("element" => "enable_controls","value" => array("display_control")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "dropdown",
						"class" => "",
						"heading" => __("Background Override (Read Description)", 'dfd'),
						"param_name" => "bg_override",
						"value" =>array(
							__('Default Width','dfd')=>"0",
							__("Apply 1st parent element's width",'dfd')=>"1",
							__("Apply 2nd parent element's width",'dfd')=>"2",
							__("Apply 3rd parent element's width",'dfd')=>"3",
							__("Apply 4th parent element's width",'dfd')=>"4",
							__("Apply 5th parent element's width",'dfd')=>"5",
							__("Apply 6th parent element's width",'dfd')=>"6",
							__("Apply 7th parent element's width",'dfd')=>"7",
							__("Apply 8th parent element's width",'dfd')=>"8",
							__("Apply 9th parent element's width",'dfd')=>"9",
							__("Full Width",'dfd')=>"full",
							__("Maximum Full Width",'dfd')=>"ex-full",
							__("Browser Full Dimension",'dfd')=>"browser_size"
						),
						"description" => __("By default, the background will be given to the Visual Composer row. However, in some cases depending on your theme's CSS - it may not fit well to the container you are wishing it would. In that case you will have to select the appropriate value here that gets you desired output..", 'dfd'),
						"dependency" => Array("element" => "bg_type","value" => array("u_iframe","image","video","grad","bg_color","animated")),
						"group" => $group_name,
					)
				);
				
				/*vc_add_param('vc_row',array(
						"type" => "ult_switch",
						"class" => "",
						"heading" => __("Activate on Mobile", 'dfd'),
						"param_name" => "disable_on_mobile_img_parallax",
						//"admin_label" => true,
						"value" => "",
						"options" => array(
								"disable_on_mobile_img_parallax_value" => array(
									"label" => "",
									"on" => "Yes",
									"off" => "No",
								)
							),
						"group" => $group_name,
						"dependency" => Array("element" => "parallax_style","value" => array("vcpb-animated","vcpb-vz-jquery","vcpb-hz-jquery","vcpb-fs-jquery","vcpb-mlvp-jquery")),
					)
				);*/			
				
				vc_add_param('vc_row',array(
						"type" => "ult_switch",
						"class" => "",
						"heading" => __("Easy Parallax", 'dfd'),
						"param_name" => "parallax_content",
						//"admin_label" => true,
						"value" => "",
						"options" => array(
								"parallax_content_value" => array(
									"label" => "",
									"on" => "Yes",
									"off" => "No",
								)
							),
						"group" => $group_effects,
						'edit_field_class' => 'uvc-divider last-uvc-divider vc_column vc_col-sm-12',
						"description" => __("If enabled, the elements inside row - will move slowly as user scrolls.", 'dfd')
					)
				);
				vc_add_param('vc_row',array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("Parallax Speed", 'dfd'),
						"param_name" => "parallax_content_sense",
						//"admin_label" => true,
						"value" => "30",
						"group" => $group_effects,
						"description" => __("Enter value between 0 to 100", 'dfd'),
						"dependency" => Array("element" => "parallax_content", "value" => array("parallax_content_value"))
					)
				);
				vc_add_param('vc_row',array(
						"type" => "ult_switch",
						"class" => "",
						"heading" => __("Fade Effect on Scroll", 'dfd'),
						"param_name" => "fadeout_row",
						//"admin_label" => true,
						"value" => "",
						"options" => array(
								"fadeout_row_value" => array(
									"label" => "",
									"on" => "Yes",
									"off" => "No",
								)
							),
						"group" => $group_effects,
						'edit_field_class' => 'uvc-divider last-uvc-divider vc_column vc_col-sm-12',
						"description" => __("If enabled, the the content inside row will fade out slowly as user scrolls down.", 'dfd')
					)
				);
				vc_add_param('vc_row',array(
						"type" => "number",
						"class" => "",
						"heading" => __("Viewport Position", 'dfd'),
						"param_name" => "fadeout_start_effect",
						"suffix" => "%",
						//"admin_label" => true,
						"value" => "30",
						"group" => $group_effects,
						"description" => __("The area of screen from top where fade out effect will take effect once the row is completely inside that area.", 'dfd'),
						"dependency" => Array("element" => "fadeout_row", "value" => array("fadeout_row_value"))
					)
				);
				/*vc_add_param('vc_row',array(
						"type" => "ult_switch",
						"class" => "",
						"heading" => __("Activate Parallax on Mobile", 'dfd'),
						"param_name" => "disable_on_mobile",
						//"admin_label" => true,
						"value" => "",
						"options" => array(
								"enable_on_mobile_value" => array(
									"label" => "",
									"on" => "Yes",
									"off" => "No",
								)
							),
						"group" => $group_effects,
						
					)
				);*/
				
				vc_add_param('vc_row',array(
					'type' => 'ult_switch',
					'heading' => __('Enable Overlay', 'dfd'),
					'param_name' => 'enable_overlay',
					'value' => '',
					'options' => array(
						'enable_overlay_value' => array(
							'label' => '',
							'on' => 'Yes',
							'off' => 'No'
						)
					),
					'edit_field_class' => 'uvc-divider last-uvc-divider vc_column vc_col-sm-12',
					'group' => $group_effects,
				));
				vc_add_param('vc_row',array(
					'type' => 'colorpicker',
					'heading' => __('Color', 'dfd'),
					'param_name' => 'overlay_color',
					'value' => '',
					'group' => $group_effects,
					'dependency' => Array('element' => 'enable_overlay', 'value' => array('enable_overlay_value')),
					'description' => __('Select RGBA values or opacity will be set to 20% by default.','dfd')
				));
					
				vc_add_param(
					'vc_row',
					array(
						'type' => 'radio_image_box',
						'heading' => __('Pattern','dfd'),
						'param_name' => 'overlay_pattern',
						'value' => '',
						'options' => $patterns,
						/*'options' => array(
							'image-1' => get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/images/patterns/01.png',
							'image-2' => get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/images/patterns/12.png',
						),*/
						'css' => array(
							'width' => '40px',
							'height' => '35px',
							'background-repeat' => 'repeat',
							'background-size' => 'cover' 
						),
						'group' => $group_effects,
						'dependency' => Array('element' => 'enable_overlay', 'value' => array('enable_overlay_value'))
					)
				);
				vc_add_param(
					'vc_row',
					array(
						'type' => 'number',
						'heading' => __('Pattern Opacity','dfd'),
						'param_name' => 'overlay_pattern_opacity',
						'value' => '80',
						'min' => '0',
						'max' => '100',
						'suffix' => '%',
						'group' => $group_effects,
						'dependency' => Array('element' => 'enable_overlay', 'value' => array('enable_overlay_value')),
						'description' => __('Enter value between 0 to 100 (0 is maximum transparency, while 100 is minimum)','dfd')
					)
				);
				vc_add_param(
					'vc_row',
					array(
						'type' => 'number',
						'heading' => __('Pattern Size','dfd'),
						'param_name' => 'overlay_pattern_size',
						'value' => '',
						'suffix' => 'px',
						'group' => $group_effects,
						'dependency' => Array('element' => 'enable_overlay', 'value' => array('enable_overlay_value')),
						'description' => __('This is optional; sets the size of the pattern image manually.', 'dfd')
					)
				);
				
				vc_add_param(
					'vc_row',
					array(
						'type' => 'checkbox',
						'heading' => __('Fany Multi Color Overlay','dfd'),
						'param_name' => 'multi_color_overlay',
						'value' => array(
							__('Enable', 'js_composer') => 'uvc-multi-color-bg' 
						),
						'group' => $group_effects,
						'dependency' => Array('element' => 'enable_overlay', 'value' => array('enable_overlay_value')),
						//'description' => __('This is optional; sets the size of the pattern image manually.', 'dfd')
					)
				);
				vc_add_param(
					'vc_row',
					array(
						'type' => 'number',
						'heading' => __('Multi Color Overlay Opacity','dfd'),
						'param_name' => 'multi_color_overlay_opacity',
						'value' => '0.6',
						'group' => $group_effects,
						'dependency' => Array('element' => 'multi_color_overlay', 'value' => array('uvc-multi-color-bg')),
					)
				);
				
				vc_add_param(
					'vc_row',
					array(
						'type' => 'ult_switch',
						'heading' => __('Separator ','dfd'),
						'param_name' => 'seperator_enable',
						'value' => '',
						'options' => array(
							'seperator_enable_value' => array(
								'on' => 'Yes', 
								'off' => 'No'
							)
						),
						'edit_field_class' => 'uvc-divider last-uvc-divider vc_column vc_col-sm-12',
						'group' => $group_effects,
					)
				);
				
				vc_add_param(
					'vc_row',
					array(
						'type' => 'dropdown',
						'heading' => __('Type','dfd'),
						'param_name' => 'seperator_type',
						'value' => array(
							__('None','dfd') => 'none_seperator',
							//__('Triangle','dfd') => 'triangle_seperator',
							__('Triangle','dfd') => 'triangle_svg_seperator',
							__('Big Triangle','dfd') => 'xlarge_triangle_seperator',
							__('Big Triangle Left','dfd') => 'xlarge_triangle_left_seperator',
							__('Big Triangle Right','dfd') => 'xlarge_triangle_right_seperator',
							//__('Half Circle','dfd') => 'circle_seperator',
							__('Half Circle','dfd') => 'circle_svg_seperator',
							__('Curve Center','dfd') => 'xlarge_circle_seperator',
							__('Curve Left','dfd') => 'curve_up_seperator',
							__('Curve Right','dfd') => 'curve_down_seperator',
							__('Tilt Left','dfd') => 'tilt_left_seperator',
							__('Tilt Right','dfd') => 'tilt_right_seperator',
							__('Round Split','dfd') => 'round_split_seperator',
							__('Waves','dfd') => 'waves_seperator',
							__('Clouds','dfd') => 'clouds_seperator',
						),
						'group' => $group_effects,
						'dependency' => Array('element' => 'seperator_enable', 'value' => array('seperator_enable_value')),
						'edit_field_class' => 'uvc-divider-content-first vc_column vc_col-sm-12',
					)
				);
				vc_add_param(
					'vc_row',
					array(
						'type' => 'dropdown',
						'heading' => __('Position','dfd'),
						'param_name' => 'seperator_position',
						'value' => array(
							__('None','dfd') => '',
							__('Top','dfd') => 'top_seperator',
							__('Bottom','dfd') => 'bottom_seperator',
							__('Top & Bottom', 'dfd') => 'top_bottom_seperator'
						),
						'group' => $group_effects,
						'dependency' => Array('element' => 'seperator_enable', 'value' => array('seperator_enable_value')),
						'edit_field_class' => 'uvc-divider-content-first vc_column vc_col-sm-12',
					)
				);
				vc_add_param(
					'vc_row',
					array(
						'type' => 'number',
						'heading' => __('Size','dfd'),
						'param_name' => 'seperator_shape_size',
						'value' => '40',
						'suffix' => 'px',
						'group' => $group_effects,
						'dependency' => Array('element' => 'seperator_type', 'value' => array('triangle_seperator','circle_seperator','round_split_seperator'))
					)
				);
				vc_add_param(
					'vc_row',
					array(
						'type' => 'number',
						'heading' => __('Height','dfd'),
						'param_name' => 'seperator_svg_height',
						'value' => '60',
						'suffix' => 'px',
						'group' => $group_effects,
						'dependency' => Array('element' => 'seperator_type', 'value' => array('xlarge_triangle_seperator','curve_up_seperator','curve_down_seperator','waves_seperator','clouds_seperator','xlarge_circle_seperator','triangle_svg_seperator','circle_svg_seperator','xlarge_triangle_left_seperator','xlarge_triangle_right_seperator','tilt_left_seperator','tilt_right_seperator'))
					)
				);
				vc_add_param(
					'vc_row',
					array(
						'type' => 'colorpicker',
						'heading' => __('Background','dfd'),
						'param_name' => 'seperator_shape_background',
						'value' => '#fff',
						'group' => $group_effects,
						'dependency' => Array('element' => 'seperator_type', 'value' => array('xlarge_triangle_seperator','triangle_seperator','circle_seperator','curve_up_seperator','curve_down_seperator','round_split_seperator','waves_seperator','clouds_seperator','xlarge_circle_seperator','triangle_svg_seperator','circle_svg_seperator','xlarge_triangle_left_seperator','xlarge_triangle_right_seperator','tilt_left_seperator','tilt_right_seperator')),
						'description' => __('Mostly, this should be background color of your adjacent row section.', 'dfd')
					)
				);
				vc_add_param(
					'vc_row',
					array(
						'type' => 'dropdown',
						'heading' => __('Border','dfd'),
						'param_name' => 'seperator_shape_border',
						'value' => array(
							__('None','dfd') => 'none',
							__('Solid','dfd') => 'solid',
							__('Dotted','dfd') => 'dotted',
							__('Dashed','dfd') => 'dashed'
						),
						'group' => $group_effects,
						//'dependency' => Array('element' => 'seperator_enable', 'value' => array('seperator_enable_value')),
						'dependency' => Array('element' => 'seperator_type', 'value' => array('none_seperator','triangle_seperator','circle_seperator','round_split_seperator'))
					)
				);
				vc_add_param(
					'vc_row',
					array(
						'type' => 'colorpicker',
						'heading' => __('Border Color','dfd'),
						'param_name' => 'seperator_shape_border_color',
						'value' => '',
						'group' => $group_effects,
						//'dependency' => Array('element' => 'seperator_enable', 'value' => array('seperator_enable_value')),
						'dependency' => Array('element' => 'seperator_type', 'value' => array('none_seperator','triangle_seperator','circle_seperator','round_split_seperator'))
					)
				);
				vc_add_param(
					'vc_row',
					array(
						'type' => 'number',
						'heading' => __('Border Width','dfd'),
						'param_name' => 'seperator_shape_border_width',
						'value' => '1',
						'suffix' => 'px',
						'group' => $group_effects,
						//'dependency' => Array('element' => 'seperator_enable', 'value' => array('seperator_enable_value')),
						'dependency' => Array('element' => 'seperator_type', 'value' => array('none_seperator','triangle_seperator','circle_seperator','round_split_seperator')),
						'edit_field_class' => 'uvc-divider-content-last vc_column vc_col-sm-12',
					)
				);
				vc_add_param(
					'vc_row',				
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => __("Icon to display:", 'dfd'),
						"param_name" => "icon_type",
						"value" => array(
							__('None','dfd') => "no_icon",
							__('Font Icon Manager','dfd') => "selector",
							__('Custom Image Icon','dfd') => "custom",
						),
						'group' => $group_effects,
						"description" => __("Use an existing font icon or upload a custom image.", 'dfd'),
						'dependency' => Array('element' => 'seperator_enable', 'value' => array('seperator_enable_value')),
					)
				);
				vc_add_param(
					'vc_row',
					array(
						"type" => "icon_manager",
						"class" => "",
						"heading" => __("Select Icon ",'dfd'),
						"param_name" => "icon",
						"value" => "",
						'group' => $group_effects,
						"description" => __("Click and select icon of your choice. If you can't find the one that suits for your purpose, you can <a href='admin.php?page=font-icon-Manager' target='_blank'>add new here</a>.", 'dfd'),
						"dependency" => Array("element" => "icon_type","value" => array("selector")),
					)
				);
				vc_add_param(
					'vc_row',
					array(
						"type" => "number",
						"class" => "",
						"heading" => __("Size of Icon", 'dfd'),
						"param_name" => "icon_size",
						"value" => 32,
						"min" => 12,
						"max" => 72,
						"suffix" => "px",
						'group' => $group_effects,
						"description" => __("How big would you like it?", 'dfd'),
						"dependency" => Array("element" => "icon_type","value" => array("selector")),
					)
				);
				vc_add_param(
					'vc_row',
					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __("Color", 'dfd'),
						"param_name" => "icon_color",
						"value" => "",
						'group' => $group_effects,
						"description" => __("Give it a nice paint!", 'dfd'),
						"dependency" => Array("element" => "icon_type","value" => array("selector")),						
					)
				);
				vc_add_param(
					'vc_row',
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
						'group' => $group_effects,
						"description" => __("We have given three quick preset if you are in a hurry. Otherwise, create your own with various options.", 'dfd'),
						"dependency" => Array("element" => "icon_type","value" => array("selector")),
					)
				);
				vc_add_param(
					'vc_row',
					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __("Background Color", 'dfd'),
						"param_name" => "icon_color_bg",
						"value" => "",
						'group' => $group_effects,
						"description" => __("Select background color for icon.", 'dfd'),	
						"dependency" => Array("element" => "icon_style", "value" => array("circle","square","advanced")),
					)
				);
				vc_add_param(
					'vc_row',
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => __("Icon Border Style", 'dfd'),
						"param_name" => "icon_border_style",
						"value" => array(
							__('None','dfd') => "",
							__('Solid','dfd') => "solid",
							__('Dashed','dfd') => "dashed",
							__('Dotted','dfd') => "dotted",
							__('Double','dfd') => "double",
							__('Inset','dfd') => "inset",
							__('Outset','dfd') => "outset",
						),
						'group' => $group_effects,
						"description" => __("Select the border style for icon.",'dfd'),
						"dependency" => Array("element" => "icon_style", "value" => array("advanced")),
					)
				);
				vc_add_param(
					'vc_row',
					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __("Border Color", 'dfd'),
						"param_name" => "icon_color_border",
						"value" => "#333333",
						'group' => $group_effects,
						"description" => __("Select border color for icon.", 'dfd'),	
						"dependency" => Array("element" => "icon_border_style", "not_empty" => true),
					)
				);
				vc_add_param(
					'vc_row',
					array(
						"type" => "number",
						"class" => "",
						"heading" => __("Border Width", 'dfd'),
						"param_name" => "icon_border_size",
						"value" => 1,
						"min" => 1,
						"max" => 10,
						"suffix" => "px",
						'group' => $group_effects,
						"description" => __("Thickness of the border.", 'dfd'),
						"dependency" => Array("element" => "icon_border_style", "not_empty" => true),
					)
				);
				vc_add_param(
					'vc_row',
					array(
						"type" => "number",
						"class" => "",
						"heading" => __("Border Radius", 'dfd'),
						"param_name" => "icon_border_radius",
						"value" => 50,
						"min" => 1,
						"max" => 500,
						"suffix" => "px",
						'group' => $group_effects,
						"description" => __("0 pixel value will create a square border. As you increase the value, the shape convert in circle slowly. (e.g 500 pixels).", 'dfd'),
						"dependency" => Array("element" => "icon_border_style", "not_empty" => true),
					)
				);
				vc_add_param(
					'vc_row',
					array(
						"type" => "number",
						"class" => "",
						"heading" => __("Background Size", 'dfd'),
						"param_name" => "icon_border_spacing",
						"value" => 50,
						"min" => 30,
						"max" => 500,
						"suffix" => "px",
						'group' => $group_effects,
						"description" => __("Spacing from center of the icon till the boundary of border / background", 'dfd'),
						"dependency" => Array("element" => "icon_style", "value" => array("advanced")),
					)
				);
				vc_add_param(
					'vc_row',
					array(
						"type" => "attach_image",
						"class" => "",
						"heading" => __("Upload Image Icon:", 'dfd'),
						"param_name" => "icon_img",
						"value" => "",
						'group' => $group_effects,
						"description" => __("Upload the custom image icon.", 'dfd'),
						"dependency" => Array("element" => "icon_type","value" => array("custom")),
					)
				);
				vc_add_param(
					'vc_row',
					array(
						"type" => "number",
						"class" => "",
						"heading" => __("Image Width", 'dfd'),
						"param_name" => "img_width",
						"value" => 48,
						"min" => 16,
						"max" => 512,
						"suffix" => "px",
						'group' => $group_effects,
						"description" => __("Provide image width", 'dfd'),
						"dependency" => Array("element" => "icon_type","value" => array("custom")),
					)
				);
				
				vc_add_param(
					'vc_row',
					array(
						'type' => 'ult_switch',
						'heading' => __('Hide Row','dfd'),
						'param_name' => 'ult_hide_row',
						'value' => '',
						'options' => array(
							'ult_hide_row_value' => array(
								'on' => 'Yes', 
								'off' => 'No'
							)
						),
						'edit_field_class' => 'uvc-divider last-uvc-divider vc_column vc_col-sm-12',
						'group' => $group_effects,
					)
				);
				
				vc_add_param(
					'vc_row',
					array(
						'type' => 'ult_switch',
						'heading' => __('<i class="dashicons dashicons-welcome-view-site"></i> Large Screen','dfd'),
						'param_name' => 'ult_hide_row_large_screen',
						'value' => '',
						'options' => array(
							'large_screen' => array(
								'on' => 'Yes', 
								'off' => 'No'
							)
						),
						'group' => $group_effects,
						"dependency" => Array("element" => "ult_hide_row","value" => array("ult_hide_row_value")),
						'edit_field_class' => 'vc_column vc_col-sm-4',
					)
				);
				vc_add_param(
					'vc_row',
					array(
						'type' => 'ult_switch',
						'heading' => __('<i class="dashicons dashicons-desktop"></i> Desktop','dfd'),
						'param_name' => 'ult_hide_row_desktop',
						'value' => '',
						'options' => array(
							'desktop' => array(
								'on' => 'Yes', 
								'off' => 'No'
							)
						),
						'group' => $group_effects,
						"dependency" => Array("element" => "ult_hide_row","value" => array("ult_hide_row_value")),
						'edit_field_class' => 'vc_column vc_col-sm-4',
					)
				);
				vc_add_param(
					'vc_row',
					array(
						'type' => 'ult_switch',
						'heading' => __('<i class="dashicons dashicons-tablet" style="transform: rotate(90deg);"></i> Tablet','dfd'),
						'param_name' => 'ult_hide_row_tablet',
						'value' => '',
						'options' => array(
							'tablet' => array(
								'on' => 'Yes', 
								'off' => 'No'
							)
						),
						'group' => $group_effects,
						"dependency" => Array("element" => "ult_hide_row","value" => array("ult_hide_row_value")),
						'edit_field_class' => 'vc_column vc_col-sm-4',
					)
				);
				vc_add_param(
					'vc_row',
					array(
						'type' => 'ult_switch',
						'heading' => __('<i class="dashicons dashicons-tablet"></i> Tablet Portrait','dfd'),
						'param_name' => 'ult_hide_row_tablet_small',
						'value' => '',
						'options' => array(
							'xs_tablet' => array(
								'on' => 'Yes', 
								'off' => 'No'
							)
						),
						'group' => $group_effects,
						"dependency" => Array("element" => "ult_hide_row","value" => array("ult_hide_row_value")),
						'edit_field_class' => 'vc_column vc_col-sm-4',
					)
				);
				vc_add_param(
					'vc_row',
					array(
						'type' => 'ult_switch',
						'heading' => __('<i class="dashicons dashicons-smartphone"></i> Mobile','dfd'),
						'param_name' => 'ult_hide_row_mobile',
						'value' => '',
						'options' => array(
							'mobile' => array(
								'on' => 'Yes', 
								'off' => 'No'
							)
						),
						'group' => $group_effects,
						"dependency" => Array("element" => "ult_hide_row","value" => array("ult_hide_row_value")),
						'edit_field_class' => 'vc_column vc_col-sm-4',
					)
				);
				vc_add_param(
					'vc_row',
					array(
						'type' => 'ult_switch',
						'heading' => __('<i class="dashicons dashicons-smartphone" style="transform: rotate(90deg);"></i> Mobile Landscape','dfd'),
						'param_name' => 'ult_hide_row_mobile_large',
						'value' => '',
						'options' => array(
							'xl_mobile' => array(
								'on' => 'Yes', 
								'off' => 'No'
							)
						),
						'group' => $group_effects,
						"dependency" => Array("element" => "ult_hide_row","value" => array("ult_hide_row_value")),
						'edit_field_class' => 'vc_column vc_col-sm-4',
					)
				);
				/*vc_add_param(
					'vc_row',
					array(
						'type' => 'dropdown',
						'heading' => __('Breakpoint', 'dfd'),
						'param_name' => 'ult_hide_row_breakpoint',
						'value' => array(
							__('Desktop','dfd') => 'desktop',
							__('Tablet','dfd') => 'tablet',
							__('Tablet Small','dfd') => 'xs-tablet',
							__('Mobile','dfd') => 'mobile',
							__('Mobile Large','dfd') => 'xl-mobile',
						),
						'group' => $group_effects,
						'dependency' => Array('element' => 'ult_hide_row','value' => array('ult_hide_row_value')),
					)			
				);*/
			}
		} /* parallax_init*/
		/*
		function radio_image_settings_field($settings, $value)
		{
			$default_css = array(
				'width' => '25px',
				'height' => '25px',
				'background-repeat' => 'repeat',
				'background-size' => 'cover'
			);
			$dependency = vc_generate_dependencies_attributes($settings, $value);
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$options = isset($settings['options']) ? $settings['options'] : '';
			$css = isset($settings['css']) ? $settings['css'] : $default_css;
			$class = isset($settings['class']) ? $settings['class'] : '';
			$useextension = (isset($settings['useextension']) && $settings['useextension'] != '' ) ? $settings['useextension'] : 'true';
			$default = isset($settings['default']) ? $settings['default'] : 'transparent';
			$show_default = isset($settings['show_default']) ? $settings['show_default'] : true;
			
			$uni = uniqid();
			
			$output = '';
			$output = '<input id="radio_image_setting_val_'.$uni.'" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . ' '.$value.' vc_ug_gradient" name="' . $param_name . '"  style="display:none"  value="'.$value.'" '.$dependency.'/>';
			$output .= '<div class="ult-radio-image-box" data-uniqid="'.$uni.'">';
				if($value == 'transperant')
					$checked = 'checked';
				else
					$checked = '';
				if($show_default) {
					$output .= '<label>
						<input type="radio" name="radio_image_'.$uni.'" '.$checked.' class="radio_pattern_image" value="'.$default.'" />
						<span class="pattern-background no-bg" style="background:transparent;"></span>
					</label>';
				}
				foreach($options as $key => $img_url)
				{
					if($value == $key)
						$checked = 'checked';
					else
						$checked = '';
					if($useextension != 'true')
					{
						$temp = pathinfo($key);
						$temp_filename = $temp['filename'];
						$key = $temp_filename;
					}
					$output .= '<label>
						<input type="radio" name="radio_image_'.$uni.'" '.$checked.' class="radio_pattern_image" value="'.$key.'" />
						<span class="pattern-background" style="background:url('.$img_url.')"></span>
					</label>';
				}
			$output .= '</div>';
			$output .= '<style>
				.ult-radio-image-box label > input{
					display:none;
				}
				.ult-radio-image-box label > input + img{
					cursor:pointer;
				  	border:2px solid #fff;
				}
				.ult-radio-image-box .no-bg {
					border:2px solid #ccc;
				}
				.ult-radio-image-box label > input:checked + img, .ult-radio-image-box label > input:checked + .pattern-background{
				  	border:2px solid #f00;
				}
				.pattern-background {';
					foreach($css as $attr => $inine_style)
					{
						$output .= $attr.':'.$inine_style.';';
					}
					$output .= 'display: inline-block;
					border:2px solid #ddd;
				}
			</style>';
			$output .= '<script type="text/javascript">
				jQuery(".radio_pattern_image").change(function(){
					var radio_id = jQuery(this).parent().parent().data("uniqid");
					var val = jQuery(this).val();
					jQuery("#radio_image_setting_val_"+radio_id).val(val);
				});
			</script>';
			return $output;
		}
		*/
		function gradient_picker($settings, $value)
		{
			//$dependency = vc_generate_dependencies_attributes($settings);
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$color1 = isset($settings['color1']) ? $settings['color1'] : ' ';
			$color2 = isset($settings['color2']) ? $settings['color2'] : ' ';			
			$class = isset($settings['class']) ? $settings['class'] : '';
			$uni = uniqid();
			$output = '<div class="vc_ug_control" data-uniqid="'.$uni.'" data-color1="'.$color1.'" data-color2="'.$color2.'">';
			//$output .= '<div class="wpb_element_label" style="margin-top: 10px;">'.__('Gradient Type','dfd').'</div>
			$output .= '<select id="grad_type'.$uni.'" class="grad_type" data-uniqid="'.$uni.'">
				<option value="vertical">Vertical</option>
				<option value="horizontal">Horizontal</option>
				<option value="custom">Custom</option>
			</select>
			<div id="grad_type_custom_wrapper'.$uni.'" class="grad_type_custom_wrapper" style="display:none;"><input type="number" id="grad_type_custom'.$uni.'" placeholder="45" data-uniqid="'.$uni.'" class="grad_custom" style="width: 200px; margin-bottom: 10px;"/> deg</div>';
			$output .= '<div class="wpb_element_label" style="margin-top: 10px;">'.__('Choose Colors','dfd').'</div>';
			$output .= '<div class="grad_hold" id="grad_hold'.$uni.'"></div>';
			$output .= '<div class="grad_trgt" id="grad_target'.$uni.'"></div>';
			
			$output .= '<input id="grad_val'.$uni.'" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . ' vc_ug_gradient" name="' . $param_name . '"  style="display:none"  value="'.$value.'" /></div>';
				
			?>
				<script type="text/javascript">
				jQuery(document).ready(function(){	
						jQuery('.grad_type').change(function(){
							var uni = jQuery(this).data('uniqid');
							var hid = "#grad_hold"+uni;
							var did = "#grad_target"+uni;
							var cid = "#grad_type_custom"+uni;
							var tid = "#grad_val"+uni;
							var cid_wrapper = "#grad_type_custom_wrapper"+uni;
							var orientation = jQuery(this).children('option:selected').val();
							
							if(orientation == 'custom')
							{
								jQuery(cid_wrapper).show();
							}
							else
							{
								jQuery(cid_wrapper).hide();
								if(orientation == 'vertical')
									var ori = 'top';
								else
									var ori = 'left';
								
								jQuery(hid).data('ClassyGradient').setOrientation(ori);
								var newCSS = jQuery(hid).data('ClassyGradient').getCSS();
								jQuery(tid).val(newCSS);
							}
							
						});
				
						jQuery('.grad_custom').on('keyup',function() {
							var uni = jQuery(this).data('uniqid');
							var hid = "#grad_hold"+uni;
							var gid = "#grad_type"+uni;
							var tid = "#grad_val"+uni;
							var orientation = jQuery(this).val()+'deg';
							jQuery(hid).data('ClassyGradient').setOrientation(orientation);
							var newCSS = jQuery(hid).data('ClassyGradient').getCSS();
							jQuery(tid).val(newCSS);
						});
								
						function gradient_pre_defined(){
							jQuery('.vc_ug_control').each(function(){
								var uni = jQuery(this).data('uniqid');
								var hid = "#grad_hold"+uni;
								var did = "#grad_target"+uni;
								var tid = "#grad_val"+uni;
								var oid = "#grad_type"+uni;
								var cid = "#grad_type_custom"+uni;
								var cid_wrapper = "#grad_type_custom_wrapper"+uni;
								var orientation = jQuery(oid).children('option:selected').val();
								var prev_col = jQuery(tid).val();
								
								var is_custom = 'false';
								
								if(prev_col!='')
								{
									if(prev_col.indexOf('-webkit-linear-gradient(top,') != -1)
									{
										var p_l = prev_col.indexOf('-webkit-linear-gradient(top,');
										prev_col = prev_col.substring(p_l+28);
										p_l = prev_col.indexOf(');');
										prev_col = prev_col.substring(0,p_l);
										orientation = 'vertical';
									}
									else if(prev_col.indexOf('-webkit-linear-gradient(left,') != -1)
									{
										var p_l = prev_col.indexOf('-webkit-linear-gradient(left,');
										prev_col = prev_col.substring(p_l+29);
										p_l = prev_col.indexOf(');');
										prev_col = prev_col.substring(0,p_l);
										orientation = 'horizontal';
									}
									else
									{
										var p_l = prev_col.indexOf('-webkit-linear-gradient(');
										
										var subStr = prev_col.match("-webkit-linear-gradient((.*));background: -o");
										
										var prev_col = subStr[1].replace(/\(|\)/g, '');
										
										var temp_col = prev_col;
										
										var t_l = temp_col.indexOf('deg');
										var deg = temp_col.substring(0,t_l);
										
										prev_col = prev_col.substring(t_l+4, prev_col.length);
										
										jQuery(cid).val(deg);
										jQuery(cid_wrapper).show();
										orientation = 'custom';
										is_custom = 'true';
									}
								}
								else
								{
									prev_col ="#e3e3e3 0%";
								}
								
								jQuery(oid).children('option').each(function(i,opt){
									if(opt.value == orientation)
										jQuery(this).attr('selected',true);
										
								});
								
								if(is_custom == 'true')
									orientation = deg+'deg';
								else
								{
									if(orientation == 'vertical')
										orientation = 'top';
									else
										orientation = 'left';
								}
								
								jQuery(hid).ClassyGradient({
									width:350,
									height:25,
									orientation : orientation,	
							        target:did,
							        gradient: prev_col,
							        onChange: function(stringGradient,cssGradient) {
							        	cssGradient = cssGradient.replace('url(data:image/svg+xml;base64,','');
							        	var e_pos = cssGradient.indexOf(';');
							        	cssGradient = cssGradient.substring(e_pos+1);							        	
							        	if(jQuery(tid).parents('.wpb_el_type_gradient').css('display')=='none'){
											//jQuery(tid).val('');	
											cssGradient='';
										}
										jQuery(tid).val(cssGradient);
							        },
							        onInit: function(cssGradient){
							        	//console.log(jQuery(tid).val())
										//check_for_orientation();
							        }
								});
								jQuery('.colorpicker').css('z-index','999999');
							})
						}	
						gradient_pre_defined();					
				})
				</script>
			<?php
			return $output;
		}
		function number_settings_field($settings, $value)
		{
			//$dependency = vc_generate_dependencies_attributes($settings);
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$min = isset($settings['min']) ? $settings['min'] : '';
			$max = isset($settings['max']) ? $settings['max'] : '';
			$suffix = isset($settings['suffix']) ? $settings['suffix'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			$output = '<input type="number" min="'.$min.'" max="'.$max.'" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="'.$value.'" style="max-width:100px; margin-right: 10px;" />'.$suffix;
			return $output;
		}
		function admin_scripts($hook){
			if($hook == "post.php" || $hook == "post-new.php" || $hook == "edit.php"){
				wp_enqueue_script('jquery.colorpicker',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/admin/js/jquery.colorpicker.js');
				wp_enqueue_script('jquery.classygradient',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/admin/js/jquery.classygradient.min.js');			
				wp_enqueue_style('classycolorpicker.style',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/admin/css/jquery.colorpicker.css');
				//wp_enqueue_style('classygradient.style',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/admin/css/jquery.classygradient.min.css');
				//wp_enqueue_style("ultimate-admin-style",get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/admin/css/style.css');
			}
		}/* end admin_scripts */
		static function front_scripts(){
			/* wp_enqueue_script('jquery.video_bg',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/js/ultimate_bg.js','1.0',array('jQuery')); */	
			
			/*$ultimate_css = get_option('ultimate_css');	
			if($ultimate_css != "enable")
				wp_enqueue_style('background-style',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-css/background-style.min.css');*/
		} /* end front_scripts */
	}
	new VC_Ultimate_Parallax;
}
//$ultimate_row = get_option('ultimate_row');
if ( !function_exists( 'vc_theme_after_vc_row' ) ) {
	function vc_theme_after_vc_row($atts, $content = null) {
		 return VC_Ultimate_Parallax::parallax_shortcode($atts, $content);
		 //return apply_filters( 'parallax_image_video', '', $atts, $content );
		 //return '<div><p>Append this div before shortcode</p></div>';
	}
}
//}
function hex2rgbUltParallax($hex, $opacity) {
	$hex = str_replace("#", "", $hex);
	if (preg_match("/^([a-f0-9]{3}|[a-f0-9]{6})$/i",$hex)):      // check if input string is a valid hex colour code
		if(strlen($hex) == 3) { // three letters code
		   $r = hexdec(substr($hex,0,1).substr($hex,0,1));
		   $g = hexdec(substr($hex,1,1).substr($hex,1,1));
		   $b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else { // six letters coode
		   $r = hexdec(substr($hex,0,2));
		   $g = hexdec(substr($hex,2,2));
		   $b = hexdec(substr($hex,4,2));
		}
		return 'rgba('.implode(",", array($r, $g, $b)).','.$opacity.')';         // returns the rgb values separated by commas, ready for usage in a rgba( rr,gg,bb,aa ) CSS rule
		// return array($r, $g, $b); // alternatively, return the code as an array
	else: return "";  // input string is not a valid hex color code - return a blank value; this can be changed to return a default colour code for example
	endif;
} // hex2rgb()