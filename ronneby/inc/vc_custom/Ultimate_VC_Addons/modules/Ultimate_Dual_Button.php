<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Just Dual Button for Visual Composer
* Add-on URI: http://dev.brainstormforce.com
*/
//error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
global $dfd_ronneby;
if(isset($dfd_ronneby['enable_default_addons']) && strcmp($dfd_ronneby['enable_default_addons'], '1') === 0) {
	if(!class_exists('AIO_Dual_Button')) {
		class AIO_Dual_Button {
			function __construct() {
				add_shortcode('ult_dualbutton',array($this,'ultimate_dualbtn_shortcode'));
				add_action('init',array($this,'ultimate_dual_button'));
				add_action( 'wp_enqueue_scripts', array( $this, 'dualbutton_scripts') );
				add_action( 'admin_enqueue_scripts', array( $this, 'dualbutton_backend_scripts') );		
			}
			function dualbutton_backend_scripts($hook){
				if($hook == "post.php" || $hook == "post-new.php"){
					wp_register_script("jquery_dualbtn_new",  get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/admin/js/dualbtnbackend.js',array('jquery'),null);
					wp_enqueue_script('jquery_dualbtn_new');
				}
			}

			//enque script
			function dualbutton_scripts(){
				wp_register_style( 'ult-dualbutton', get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-css/dual-button.min.css');
				wp_register_script('jquery.dualbtn',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-js/dual-button.min.js' ,array('jquery'),null);

				if(isset($_SERVER['HTTP_REFERER'])){
					$params = parse_url($_SERVER['HTTP_REFERER']);
				$vc_is_inline = false;
				if(isset($params['query'])){
					parse_str($params['query'],$params);
					$vc_is_inline = isset($params['vc_action']) ? true : false;
				}

				if($vc_is_inline){
					//echo $vc_is_inline;
						wp_enqueue_style( 'ult-dualbutton', get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-css/dual-button.min.css');
						wp_enqueue_script('jquery.dualbtn',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-js/dual-button.min.js',array('jquery'),null);
					}
				}
			}



			// Shortcode handler function for stats Icon
			function ultimate_dualbtn_shortcode($atts) {

				$button1_text= $icon_type = $icon = $icon_img = $img_width = $icon_size = $icon_color = $icon_hover_color = $icon_style = $icon_color_bg ='';
				$icon_border_style= $icon_color_border = $icon_border_size = $icon_border_radius = $icon_border_spacing = $icon_link = $icon_align = $btn1_background_color = $btn1_bghovercolor = $btn2_font_family = $btn2_heading_style = $btn1_text_color = $btn1_text_hovercolor = '';
				$button2_text = $btn_icon_type = $btn_icon = $btn_icon_img = $btn_img_width = $btn_icon_size = 
				$btn_icon_color = $btn_icon_style = $btn_icon_color_bg = $btn_icon_border_style = $btn_icon_color_border = 
				$btn_icon_border_size = $btn_icon_border_radius = $btn_icon_border_spacing =  $btn_icon_link = $btn2_icon_align = 
				$btn2_background_color = $btn2_bghovercolor = $btn2_font_family = $btn2_heading_style = $btn2_text_color = 
				$btn2_text_hovercolor='';
				$divider_style = $divider_text = $divider_text_color = $divider_bg_color = $divider_icon = $divider_icon_img = $btn_border_style = $btn_color_border = $btn_border_size = $btn_border_radius = $btn_hover_style = $title_font_size = $title_line_ht = $el_class = '';

				extract(shortcode_atts( array(	

				/*--------btn1-----------*/			
					'button1_text' => '',
					'icon_type' => 'selector',
					'icon' => '',
					'icon_img' => '',
					'img_width' => '',				
					'icon_size' => '32',
					'icon_color' => '#333333',
					'icon_hover_color' =>'#333333',
					'icon_style' => 'none',			
					'icon_color_bg' => '#ffffff',
					'icon_border_style' => '',
					'icon_color_border' => '#333333',
					'icon_border_size' => '1',
					'icon_border_radius' => '0',
					'icon_border_spacing' => '30',
					'icon_link' => '',
					'icon_align' => 'left',
					'btn1_background_color'=>'#ffffff',
					'btn1_bghovercolor' => '#bcbcbc',
					'btn1_font_family' => '',
					'btn1_heading_style' => '',
					'btn1_text_color' => '#333333',
					'btn1_text_hovercolor'=>'#333333',
					'icon_color_hoverbg'=>'#ecf0f1',
					'icon_color_hoverborder'=>'#333333',
					'btn1_padding'=>'',

					/*--------btn2-----------*/
					'button2_text' => '',
					'btn_icon_type' => 'selector',
					'btn_icon' => '',
					'btn_icon_img' => '',
					'btn_img_width' => '48',				
					'btn_icon_size' => '32',
					'btn_icon_color' => '#333333',
					'btn_iconhover_color'=>'#333333',
					'btn_icon_style' => 'none',
					'btn_icon_color_bg' => '#ffffff',			
					'icon_color_bg' => '#ffffff',
					'btn_icon_border_style' => '',
					'btn_icon_color_border' => '#333333',
					'btn_icon_border_size' => '1',
					'btn_icon_border_radius' => '1',
					'btn_icon_border_spacing' => '30',
					'btn_icon_link' => '',
					'btn2_icon_align' => 'right',
					'btn2_background_color'=>'#ffffff',
					'btn2_bghovercolor' => '#bcbcbc',
					'btn2_font_family' => '',
					'btn2_heading_style' => '',
					'btn2_text_color' => '#333333',
					'btn2_text_hovercolor'=>'#333333',
					'btn_icon_color_hoverbg'=>'#ffffff',
					'btn_icon_color_hoverborder'=>'#333333',
					'btn2_padding'=>'',

					/*--------divider-----------*/

					'divider_style' => 'text',
					'divider_text' => 'or',
					'divider_text_color' => '#ffffff',
					'divider_bg_color' => '#333333',
					'divider_icon' => '',				
					'divider_icon_img' => '',
					'divider_border_radius'=>'',
					'divider_border_size'=>'1',
					'divider_color_border'=>'#e7e7e7',
					'divider_border_style'=>'',

					/*--------general-----------*/

					'btn_border_style' => '',
					'btn_color_border'=>'#333333',
					'btn_border_size' => '1',
					'btn_border_radius' => '',			
					'btn_hover_style' => 'Style 1',
					'title_font_size' => '15',
					'title_line_ht' => '15',
					'el_class' => '',
					'btn_alignment'=>'center',
					'btn_width'=>'',
					'dual_resp' =>'on',

					//'btn_resp_width'=>'',
					//'btn_color_hoverborder'=>' ', 

				),$atts));

				$extraclass=$el_class;
				$el_class1=$css_trans=$button2_bstyle=$button1_bstyle=$target1=$url1=$btn_color_hoverborder='';
				$iconoutput= $style = $link_sufix = $link_prefix = $target = $href = $icon_align_style = '';
				$secicon=$style1='';

				if($icon_link !== ''){
					 $href = vc_build_link($icon_link);
					$target =(isset($href['target'])) ? "target='".esc_attr($href['target'])."'" :'';
					$target = str_replace(' ', '', $target);
					 $url1=$href['url'];
					if($url1==''){
						$url1="javascript:void(0);";
					}
					//echo $url1;
				}
				else{
					$url1="javascript:void(0);";	
				}

				if($icon_type == 'custom'){
					if($icon_img!==''){
					$img = apply_filters('ult_get_img_single', $icon_img, 'url');
					$alt = get_post_meta($icon_img, '_wp_attachment_image_alt', true);
					if($icon_style !== 'none'){
						if($icon_color_bg !== '')
							$style .= 'background:'.esc_attr($icon_color_bg).';';
						//$style .= 'background:transperent;';
					}
					if($icon_style == 'circle'){
						$el_class.= ' uavc-circle ';
					}
					if($icon_style == 'square'){
						$el_class.= ' uavc-square ';
					}
					if($icon_style == 'advanced' && $icon_border_style !== '' ){
						$style .= 'border-style:'.esc_attr($icon_border_style).';';
						$style .= 'border-color:'.esc_attr($icon_color_border).';';
						$style .= 'border-width:'.esc_attr($icon_border_size).'px;';
						$style .= 'padding:'.esc_attr($icon_border_spacing).'px;';
						$style .= 'border-radius:'.esc_attr($icon_border_radius).'px;';
					}
					if(!empty($img)){
						if($icon_link == '' || $icon_align == 'center') {
							//$style .= 'display:inline-block;';
						}
						$iconoutput .= "\n".'<span class="aio-icon-img '.esc_attr($el_class).' '.'btn1icon " style="font-size:'.esc_attr($img_width).'px;'.$style.'" '.$css_trans.'>';
						$iconoutput .= "\n\t".'<img class="img-icon dual_img" alt="'.esc_attr($alt).'" src="'.esc_url($img).'" />';	
						$iconoutput .= "\n".'</span>';
					}
					if(!empty($img)){
					$iconoutput = $iconoutput;
					}
					else{
						$iconoutput = '';
					}

				} 
				}else {
					if($icon!=='')
					{
						if($icon_color !== '')
							$style .= 'color:'.$icon_color.';';
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
						if($icon_align !== 'left'){
							$style .= 'display:inline-block;';
						}
						if($icon !== ""){
							$iconoutput .= "\n".'<span class="aio-icon btn1icon '.esc_attr($icon_style).' '.esc_attr($el_class).'" '.$css_trans.' style="'.$style.'">';				
							$iconoutput .= "\n\t".'<i class="'.esc_attr($icon).'" ></i>';	
							$iconoutput .= "\n".'</span>';
						}
						if($icon !== "" && $icon!=="none"){
						$iconoutput = $iconoutput;
						}
						else{
							$iconoutput = '';
						}

					}
				}
				if($iconoutput !== ''){
					 //$iconoutput = '<div class="align-icon" style="'.$icon_align_style.'">'.$iconoutput.'</div>';
				}



				$style2=$href1 =$target2=$img2=$alt1 =$iconoutput2=$url2='';
				/*---- for icon 2--------------*/
				if($btn_icon_link !== ''){
							 $href1 = vc_build_link($btn_icon_link);
							$target1 =(isset($href1['target'])) ? "target='".esc_attr($href1['target'])."'" :'';
							// $link_prefix .= '<a class="aio-tooltip " href = "'.$href1['url'].'" '.$target1.' data-toggle="tooltip" data-placement="'.$tooltip_disp.'" title="'.$tooltip_text.'">';
							// $link_sufix .= '</a>';
							$target1 = str_replace(' ', '', $target1);
							$url2=$href1['url'];
							if($url2==''){
								$url2="javascript:void(0);";
							}
						} 
						else{
					$url2="javascript:void(0);";
				}

				if($btn_icon_type == 'custom'){
					$img2 = apply_filters('ult_get_img_single', $btn_icon_img, 'url');
					$alt2 = get_post_meta($btn_icon_img, '_wp_attachment_image_alt', true);
					if($btn_icon_style !== 'none'){
						if($btn_icon_color_bg !== '')
							$style2 .= 'background:'.esc_attr($btn_icon_color_bg).';';
						//$style2 .= 'background:transperent;';
					}

					if($btn_icon_style == 'square'){
						$el_class1.= ' uavc-square ';
					}
					if($btn_icon_style == 'circle'){
						$el_class1.= ' uavc-circle ';
					}
					if($btn_icon_style == 'advanced' && $btn_icon_border_style !== '' ){
						$style2 .= 'border-style:'.esc_attr($btn_icon_border_style).';';
						$style2 .= 'border-color:'.esc_attr($btn_icon_color_border).';';
						$style2 .= 'border-width:'.esc_attr($btn_icon_border_size).'px;';
						$style2 .= 'padding:'.esc_attr($btn_icon_border_spacing).'px;';
						$style2 .= 'border-radius:'.esc_attr($btn_icon_border_radius).'px;';
					}
					if(!empty($img2)){
						if($btn_icon_link == '' || $btn2_icon_align == 'center') {
							//$style .= 'display:inline-block;';
						}
						$iconoutput2 .= "\n".'<span class="aio-icon-img '.$el_class1.' btn1icon" style="font-size:'.esc_attr($btn_img_width).'px;'.$style2.'" '.$css_trans.'>';
						$iconoutput2 .= "\n\t".'<img class="img-icon dual_img" alt="'.esc_attr($alt2).'" src="'.esc_url($img2).'" />';	
						$iconoutput2 .= "\n".'</span>';
					}
					if(!empty($img2)){
						$iconoutput2 = $iconoutput2;
					}
					else{
						$iconoutput2 = '';
					}
				} else {
					if($btn_icon_color !== '')
						$style2 .= 'color:'.esc_attr($btn_icon_color).';';
					if($btn_icon_style !== 'none'){
						if($btn_icon_color_bg !== '')
							$style2 .= 'background:'.esc_attr($btn_icon_color_bg).';';
					}
					if($btn_icon_style == 'advanced'){
						$style2 .= 'border-style:'.esc_attr($btn_icon_border_style).';';
						$style2 .= 'border-color:'.esc_attr($btn_icon_color_border).';';
						$style2 .= 'border-width:'.esc_attr($btn_icon_border_size).'px;';
						$style2 .= 'width:'.esc_attr($btn_icon_border_spacing).'px;';
						$style2 .= 'height:'.esc_attr($btn_icon_border_spacing).'px;';
						$style2 .= 'line-height:'.esc_attr($btn_icon_border_spacing).'px;';
						$style2 .= 'border-radius:'.esc_attr($btn_icon_border_radius).'px;';
					}
					//echo $btn_icon_size;
					if($btn_icon_size !== ''){
						$style2 .='font-size:'.esc_attr($btn_icon_size).'px;';
					}

					if($btn2_icon_align !== 'left'){
						$style2 .= 'display:inline-block;';
					}
					if($btn_icon !== ""){
						$iconoutput2 .= "\n".'<span class="aio-icon btn1icon '.esc_attr($btn_icon_style).' '.esc_attr($el_class1).'" '.$css_trans.' style="'.$style2.'">';				
						$iconoutput2 .= "\n\t".'<i class="'.esc_attr($btn_icon).'" ></i>';	
						$iconoutput2 .= "\n".'</span>';
					}
					if($btn_icon !== "" && $btn_icon!=="none"){
						$iconoutput2 = $iconoutput2;
					}
					else{

						$iconoutput2 = '';
					}
				}
				if($icon_align_style !== ''){
					 //$iconoutput = '<div class="align-icon" style="'.$icon_align_style.'">'.$iconoutput.'</div>';
				}


				$hstyle=$hoverstyle='';
				$btn_hover_style;
				if($btn_hover_style=='Style 1'){
					$hoverstyle='ult-dual-btn';
				}
				if($btn_hover_style==''){
					$hoverstyle='ult-dual-btn';

				}
				if($btn_hover_style=='Style 2'){
					$hoverstyle='ult-dual-btn3';

				}
				if($btn_hover_style=='Style 3'){
					$hoverstyle='ult-dual-btn4';
				}

				/*--------css for title1------------*/
				$btn1_padding;
				$title1_style='';
				if (function_exists('get_ultimate_font_family')) {
					$mhfont_family = get_ultimate_font_family($btn1_font_family);
					$title1_style .= 'font-family:'.esc_attr($mhfont_family).';';
				}
				if (function_exists('get_ultimate_font_style')) {
					$title1_style .= get_ultimate_font_style($btn1_heading_style);
				}
				$title1_style .= 'font-size:'.esc_attr($title_font_size).'px;';//style
				$title1_style .= 'color:'.esc_attr($btn1_text_color).';';//color
				if($title_line_ht!=''){
				$title1_style .= 'line-height:'.esc_attr($title_line_ht).'px;';//line-height
				}
				/*--------css for title2------------*/

				$title2_style='';
				if (function_exists('get_ultimate_font_family')) {
					$mhfont_family1 = get_ultimate_font_family($btn2_font_family);
					$title2_style .= 'font-family:'.esc_attr($mhfont_family1).';';
				}
				if (function_exists('get_ultimate_font_style')) {
					$title2_style .= get_ultimate_font_style($btn2_heading_style);
				}
				$title2_style .= 'font-size:'.esc_attr($title_font_size).'px;';//style
				$title2_style .= 'color:'.esc_attr($btn2_text_color).';';//color
				if($title_line_ht!=''){
					$title2_style .= 'line-height:'.esc_attr($title_line_ht).'px;';//line-height
				}
				/*--------css for button1------------*/

				$btncolor_style='';
				$btncolor_style .= 'background-color:'.esc_attr($btn1_background_color).' !important;';

				/*--------css for button2------------*/

				$btncolor1_style='';
				$btncolor1_style .= 'background-color:'.esc_attr($btn2_background_color).' !important;';

				/*--------css for button------------*/

				$btnmain_style='';
				$btnmain_style .= 'border-color:'.esc_attr($btn_color_border).';';

				$btnmain_style .= 'border-style:'.esc_attr($btn_border_style).';';
				if($btn_border_style!=''){
					$btnmain_style .= 'border-width:'.esc_attr($btn_border_size).'px;';
				} else {
					$btnmain_style .= 'border-width:0px;';
				}
				$btnmain_style .= 'border-radius:'.esc_attr($btn_border_radius).'px;';
				if($btn_width!='')
					$btnmain_style .= 'width:'.esc_attr($btn_width).'px;';


				/*--------for divider------------*/
				$text_style='';
				$text_style .='line-height: 1.8em;';
				$text_style .='color:'.esc_attr($divider_text_color).';';
				$text_style .='background-color:'.esc_attr($divider_bg_color).';';

				if($divider_border_style==''){
					$text_style .='border-width:0px;';
				} else {
					$text_style .='border-color:'.esc_attr($divider_color_border).';';
					$text_style .='border-width:'.esc_attr($divider_border_size).'px;';
					$text_style .='border-style:'.esc_attr($divider_border_style).';';
					$text_style .='border-radius:'.esc_attr($divider_border_radius).'px;';
				}

				if($divider_style=='text') {
					$text=$divider_text;
				} else if($divider_style=='icon') {
					$text='<i class="'.esc_attr($divider_icon).'"></i>';
				} else if($divider_style=='image') {
					$text_style='';
					$text_style.='width: 25px;
					height: 25px;
					border-radius: 50%;
					background-color:'.esc_attr($divider_bg_color).';';

					$img3 = apply_filters('ult_get_img_single', $divider_icon_img, 'url');
					$alt3 = get_post_meta($divider_icon_img, '_wp_attachment_image_alt', true);
					$text='<img class="img-icon" alt="'.esc_attr($alt3).'" src="'.esc_url($img3).'" style="'.$text_style.'" />';
				}

				/*--- generate random no------------*/
				$dual_resp;
				$resp_data='data-response="'.esc_attr($dual_resp).'"';
				$id='';
				$id="ult_btn_".mt_rand();


				/*----------for btn1 hover------------*/
				$btn_hover='';
				$btn_hover .='data-bgcolor="'.esc_attr($btn1_background_color).'" ';
				$btn_hover .='data-bghovercolor="'.esc_attr($btn1_bghovercolor).'" ';
				$btn_hover .='data-icon_color="'.esc_attr($icon_color).'" ';
				$btn_hover .='data-icon_hover_color="'.esc_attr($icon_hover_color).'" ';
				$btn_hover .='data-textcolor="'.esc_attr($btn1_text_color).'" ';
				$btn_hover .='data-texthovercolor="'.esc_attr($btn1_text_hovercolor).'" ';
				if($icon_style == 'none'){
					$btn_hover .='data-iconbgcolor="transperent" ';
					$btn_hover .='data-iconbghovercolor="transperent" ';
					$btn_hover .='data-iconborder="transperent" ';
					$btn_hover .='data-iconhoverborder="transperent" ';
				} else {
					$btn_hover .='data-iconbgcolor="'.esc_attr($icon_color_bg).'" ';
					$btn_hover .='data-iconbghovercolor="'.esc_attr($icon_color_hoverbg).'" ';
					$btn_hover .='data-iconborder="'.esc_attr($icon_color_border).'" ';
					$btn_hover .='data-iconhoverborder="'.esc_attr($icon_color_hoverborder).'" ';
				}


				/*----------for btn2 hover------------*/
				$btn2_hover='';
				$btn2_hover .='data-bgcolor="'.esc_attr($btn2_background_color).'" ';
				$btn2_hover .='data-bghovercolor="'.esc_attr($btn2_bghovercolor).'" ';
				$btn2_hover .='data-icon_color="'.esc_attr($btn_icon_color).'" ';
				$btn2_hover .='data-icon_hover_color="'.esc_attr($btn_iconhover_color).'" ';
				$btn2_hover .='data-textcolor="'.esc_attr($btn2_text_color).'" ';
				$btn2_hover .='data-texthovercolor="'.esc_attr($btn2_text_hovercolor).'" ';
				if($btn_icon_style == 'none'){
					$btn2_hover .='data-iconbgcolor="transperent" ';
					$btn2_hover .='data-iconbghovercolor="transperent" ';
					$btn2_hover .='data-iconborder="transperent" ';
					$btn2_hover .='data-iconhoverborder="transperent" ';
				} else {
					$btn2_hover .='data-iconbgcolor="'.esc_attr($btn_icon_color_bg).'" ';
					$btn2_hover .='data-iconbghovercolor="'.esc_attr($btn_icon_color_hoverbg).'" ';
					$btn2_hover .='data-iconborder="'.esc_attr($btn_icon_color_border).'" ';
					$btn2_hover .='data-iconhoverborder="'.esc_attr($btn_icon_color_hoverborder).'" ';
				}

				//echo $btn_hover_style;

				/*--- main button border-----*/
				$mainbtn='';
				if($btn_hover_style == ''){
					$mainbtn .= 'data-bcolor="'.esc_attr($btn_color_border).'"';
					$mainbtn .= 'data-bhcolor="'.esc_attr($btn_color_border).'"';
				} else {
					$mainbtn .= 'data-bcolor="'.esc_attr($btn_color_border).'"';
					$mainbtn .= 'data-bhcolor="'.esc_attr($btn_color_hoverborder).'"';
				}

				 $icon_align;

				/*---- for icon line-height----*/
				$size=$icon1_lineht=$icon2_lineht=$iconht1='';
				$iconht=$icon2_lineht2=$iconht2=$icon1_lineht2='';$icnsize='';$icnsize1='';$icnsize2='';

				//echo $iconoutput;
				//echo $iconoutput2;
				$emptyicon='';$emptyicon1='';
				if( $iconoutput==''){
					$emptyicon='padding-left:0px;';
					$icon_align='left';
				}
				if($iconoutput2==''){
					$emptyicon1='padding-left:0px;';
					$btn2_icon_align='right';
				}

				$subop='';
				$subop .='
				<div class="ult_dual_button to-'.esc_attr($btn_alignment).'  '.esc_attr($extraclass).'"  '.$resp_data.' id="'.esc_attr($id).'">

				<div class="ulitmate_dual_buttons '.esc_attr($hoverstyle).' ult_main_dualbtn " '.$mainbtn.'>

				<div class="ult_dualbutton-wrapper btn-inline place-template bt1 ">';
				$is_no_icon_first = (trim($iconoutput) === '') ? 'ult-dual-btn-no-icon' : '';
				if($icon_align=='right') {
					$subop .='<a href="'.esc_url($url1).'" '.$target.' class="ult_ivan_button   round-square  with-icon icon-after with-text place-template ult_dual1" style=" '.$icon1_lineht2.';margin-right:px;'.$size.';'.$btncolor_style.$button1_bstyle.'; '.$btnmain_style.';">
						<span class="ult-dual-btn-1 ' .esc_attr($btn_hover_style). '" style=""  '.$btn_hover.'>
							<span class="text-btn ult-dual-button-title title_left" style="'.$title1_style.'">'.$button1_text.'</span>
							<span class="icon-simple icon-right1 ult_btn1span '.esc_attr($is_no_icon_first).'"  style="'.$icnsize1.';'.$emptyicon.' ">'.$iconoutput.'</span
						</span>
					</a>';
				} else {
					$subop .='<a href="'.esc_url($url1).'" '.$target.'class="ult_ivan_button   round-square  with-icon icon-before with-text place-template ult_dual1" style="'.$icon1_lineht2.';margin-right:px;'.$size.';'.$btncolor_style.$button1_bstyle.'; '.$btnmain_style.';">
						<span class="ult-dual-btn-1 ' .esc_attr($btn_hover_style). '" style=""  '.$btn_hover.'>
							<span class="icon-simple icon-left1 ult_btn1span '.esc_attr($is_no_icon_first).'"  style="'.$icnsize1.';'.$emptyicon.' ">'.$iconoutput.'</span>
							<span class="text-btn ult-dual-button-title" style="'.$title1_style.'">'.$button1_text.'</span>
						</span>
					</a>';
				}


				$subop .='<span class="middle-text" style="'.$text_style.'">
				<span class="middle-inner"  >'.$text.'</span>
				</span>

				</div>

				<div class="ult_dualbutton-wrapper btn-inline place-template btn2 ">';
				$is_no_icon = (trim($iconoutput2) === '') ? 'ult-dual-btn-no-icon' : '';
				if($btn2_icon_align=='right') {
					$subop .='<a href="'.esc_url($url2).'" '.$target1.' class="ult_ivan_button   round-square  with-icon icon-after with-text place-template ult_dual2"  style="'.$icon2_lineht2.';'.$btncolor1_style.$button2_bstyle.';margin-left:px;'.$size.';'.$btnmain_style.'">
						<span class="ult-dual-btn-2 ' .esc_attr($btn_hover_style). '"  '.$btn2_hover.'>
							<span class="text-btn ult-dual-button-title" style="'.$title2_style.'">'.$button2_text.'</span>
							<span class="icon-simple icon-right2 ult_btn1span '.esc_attr($is_no_icon).'"  style="'.$icnsize2.';'.$emptyicon1.' ">'.$iconoutput2.'</span>
						</span>
					</a>';
				} else {
					$subop .='<a href="'.esc_url($url2).'" '.$target1.' class="ult_ivan_button   round-square  with-icon icon-before with-text place-template ult_dual2"  style="'.$icon2_lineht2.';'.$btncolor1_style.$button2_bstyle.';margin-left:-0px;'.$size.'; '.$btnmain_style.'">
						<span class="ult-dual-btn-2 ' .esc_attr($btn_hover_style). '"  '.$btn2_hover.'>
							<span class="icon-simple icon-left2 ult_btn1span '.esc_attr($is_no_icon).'"  style="'.$icnsize2.';'.$emptyicon1.' ">'.$iconoutput2.'</span>
							<span class="text-btn ult-dual-button-title title_right" style="'.$title2_style.'">'.$button2_text.'</span>
						</span>
					</a>';
				}
				$subop .='</div>
				</div>
				</div>';

				return 	$subop ;	
			}

			function ultimate_dual_button() {
				if(function_exists('vc_map')) {
					vc_map(
						array(
						   'name' => __('Dual Button'),
						   'base' => 'ult_dualbutton',
							'icon' => 'dual_button',
							//'icon'=>plugins_url('../admin/img/dual_button.png',__FILE__),
							'category' => __('Ultimate VC Addons','dfd'),
							// 'front_enqueue_js' => array(plugins_url('../assets/min-js/dual_button.min.js',__FILE__),array('jquery'),null),
							// 'front_enqueue_js' =>  preg_replace( '/\s/', '%20', plugins_url( '../admin/js/dualbtnfront.js', __FILE__ ) ),
							'description' => __('Add a dual button and give some custom style.','dfd'),
							'params' => array(							
								// Play with icon selector
							/*-----------general------------*/
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Button Style', 'dfd'),
									'param_name' => 'btn_hover_style',
									'value' => array(
										'Style 1'=> 'Style 1',
										'Style 2' => 'Style 2',
										/*'Style 3' => 'Style 3',*/
										'None'=> ' ',

									),
									'description' => __('Select the Hover style for Button.','dfd'),

								),
								array(
									'type' => 'number',
									'param_name' => 'title_font_size',
									'heading' => __('Text Font size','dfd'),
									'value' => '',
									'suffix' => 'px',
									'edit_field_class' => 'vc_column vc_col-sm-4',
								),

								array(
									'type' => 'number',
									'param_name' => 'title_line_ht',
									'heading' => __('Text Line Height','dfd'),
									'value' => '',
									'suffix' => 'px',
									'edit_field_class' => 'vc_column vc_col-sm-4',

								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Border Radius', 'dfd'),
									'param_name' => 'btn_border_radius',

									'min' => 1,
									'max' => 50,
									'suffix' => 'px',
									 //'dependency' => Array('element' => 'btn_border_style', 'not_empty' => true),
									 'edit_field_class' => 'vc_column vc_col-sm-4',

								),
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Border Style', 'dfd'),
									'param_name' => 'btn_border_style',
									'value' => array(
										'None'=> '',
										'Solid'=> 'solid',
										'Dashed' => 'dashed',
										'Dotted' => 'dotted',
										'Double' => 'double',
										'Inset' => 'inset',
										'Outset' => 'outset',
									),
									'description' => __('Select the border style for Button.','dfd'),
									//'dependency' => Array('element' => 'btn_hover_style', 'not_empty' => true),


								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Border Color', 'dfd'),
									'param_name' => 'btn_color_border',
									'value' => '',
									'description' => __('Select border color for button.', 'dfd'),	
									'dependency' => Array('element' => 'btn_border_style', 'not_empty' => true),
									'edit_field_class' => 'vc_column vc_col-sm-6',
								),

								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Border Width', 'dfd'),
									'param_name' => 'btn_border_size',
									'value' => '',
									'min' => 1,
									'max' => 10,
									'suffix' => 'px',
									'description' => __('Thickness of the border.', 'dfd'),
									'dependency' => Array('element' => 'btn_border_style', 'not_empty' => true),	
									'edit_field_class' => 'vc_column vc_col-sm-6',
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Button Width', 'dfd'),
									'param_name' => 'btn_width',
									'min' => 1,
									'max' => 50,
									'suffix' => 'px',
									 //'dependency' => Array('element' => 'btn_border_style', 'not_empty' => true),
									 'edit_field_class' => 'vc_column vc_col-sm-6',

								),
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Button Alignment', 'dfd'),
									'param_name' => 'btn_alignment',
									'value' => array(
										'center'=> '',
										'left'=> 'left',
										'right' => 'right',

									),
									'edit_field_class' => 'vc_column vc_col-sm-6',

								),
								array(
										'type' => 'ult_switch',
										'class' => '',
										//'heading' => __('Want To show button in responsive mode', 'dfd'),
										'param_name' => 'dual_resp',
										// 'admin_label' => true,
										'value' => 'on',
										'default_set' => true,
										'options' => array(
											'on' => array(
												'label' => __('Enable Responsive Mode?','dfd'),
												'on' => __('Yes','dfd'),
												'off' => __('No','dfd'),
											  ),
										  ),
										/*'description' => __('', 'smile'),*/
										'description' => __('Enable Responsive Mod or not', 'dfd'),
									),

								array(
									'type' => 'textfield',
									'class' => '',
									'heading' => __('Custom CSS Class', 'dfd'),
									'param_name' => 'el_class',
									'value' => '',
									'description' => __('Ran out of options? Need more styles? Write your own CSS and mention the class name here.', 'dfd'),
								),

							/*---bt1----*/
								/*array(
										'type' => 'ult_param_heading',
										'param_name' => 'btn1_text_setting',
										'text' => __('Button Text', 'dfd'),
										'value' => '',
										'class' => '',
										'group' => __('Button1','dfd'),
										'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
									),*/

								array(
									'type' => 'textfield',
									'class' => '',
									'heading' => __(' Button Text', 'dfd'),
									'param_name' => 'button1_text',
									'value' => '',
									'admin_label' => true,
									'description' => __('Enter your text here.', 'dfd'),
									'group' => 'Button1',
								),
								array(
									'type' => 'vc_link',
									'class' => '',
									'heading' => __('Link ','dfd'),
									'param_name' => 'icon_link',
									'value' => '',
									'description' => __('Add a custom link or select existing page. You can remove existing link as well.','dfd'),
									'group' => 'Button1',

								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Background Color', 'dfd'),
									'param_name' => 'btn1_background_color',
									'value' => '',
									'description' => __('Select Background Color for Button.', 'dfd'),	
									'group' => 'Button1',

								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Background Hover Color', 'dfd'),
									'param_name' => 'btn1_bghovercolor',
									'value' => '',
									'description' => __('Select background hover color for Button.', 'dfd'),	
									/*'dependency' => Array('element' => 'btn_hover_style', 'not_empty' => true),*/
									'dependency' => Array('element' => 'btn_hover_style', 'value' => array('Style 1','Style 2','Style 3')),
									'group' => 'Button1',

								),

								array(
										'type' => 'ult_param_heading',
										'param_name' => 'btn1_icon_setting',
										'text' => __('Icon/Image ', 'dfd'),
										'value' => '',
										'class' => '',
										'group' => __('Button1','dfd'),
										'edit_field_class' => 'ult-param-heading-wrapper  vc_column vc_col-sm-12',
									),

								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Icon to display', 'dfd'),
									'param_name' => 'icon_type',
									'value' => array(
										'Font Icon Manager' => 'selector',
										'Custom Image Icon' => 'custom',
									),
									'description' => __('Use existing font icon or upload a custom image.', 'dfd'),
									'group' => 'Button1',
								),
								array(
									'type' => 'icon_manager',
									'class' => '',
									'heading' => __('Select Icon ','dfd'),
									'param_name' => 'icon',
									'value' => '',
									'description' => __('Click and select icon of your choice. If you can\'t find the one that suits for your purpose','dfd').', '.__('you can','dfd').' <a href="admin.php?page=font-icon-Manager" target="_blank">'.__('add new here','dfd').'</a>.',
									'dependency' => Array('element' => 'icon_type','value' => array('selector')),
									'group' => 'Button1',
								),
								array(
									'type' => 'ult_img_single',
									'class' => '',
									'heading' => __('Upload Image Icon:', 'dfd'),
									'param_name' => 'icon_img',
									//'admin_label' => true,
									'value' => '',
									'description' => __('Upload the custom image icon.', 'dfd'),
									'dependency' => Array('element' => 'icon_type','value' => array('custom')),
									'group' => 'Button1',
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Image Width', 'dfd'),
									'param_name' => 'img_width',
									'value' => '',
									'min' => 16,
									'max' => 512,
									'suffix' => 'px',
									'description' => __('Provide image width', 'dfd'),
									'dependency' => Array('element' => 'icon_type','value' => array('custom')),
									'group' => 'Button1',
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Size of Icon', 'dfd'),
									'param_name' => 'icon_size',
									'value' => '',
									'min' => 12,
									'max' => 72,
									'suffix' => 'px',
									'description' => __('How big would you like it?', 'dfd'),
									'dependency' => Array('element' => 'icon_type','value' => array('selector')),
									'group' => 'Button1',
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Icon Color', 'dfd'),
									'param_name' => 'icon_color',
									'value' => '',
									'description' => __('Icon Color!', 'dfd'),
									'dependency' => Array('element' => 'icon_type','value' => array('selector')),						
									'group' => 'Button1',
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Icon Hover Color', 'dfd'),
									'param_name' => 'icon_hover_color',
									'value' => '',
									'description' => __('Icon hover color !', 'dfd'),
									'dependency' => Array('element' => 'icon_type','value' => array('selector'),
														/*'element' => 'btn_hover_style', 'not_empty' => true*/),						
									'group' => 'Button1',
								),
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Icon or Image Style', 'dfd'),
									'param_name' => 'icon_style',
									'value' => array(
										'Simple' => 'none',
										'Circle Background' => 'circle',
										'Square Background' => 'square',
										'Design your own' => 'advanced',
									),
									'description' => __('We have given three quick preset if you are in a hurry. Otherwise, create your own with various options.', 'dfd'),
									'group' => 'Button1',
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Icon or Image Background Color ', 'dfd'),
									'param_name' => 'icon_color_bg',
									'value' => '',
									'description' => __('Select background color for icon.', 'dfd'),	
									'dependency' => Array('element' => 'icon_style', 'value' => array('circle','square','advanced')),
									'group' => 'Button1',
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Icon or Image Background Hover Color ', 'dfd'),
									'param_name' => 'icon_color_hoverbg',
									'value' => '',
									'description' => __('Select background hover color for icon.', 'dfd'),	
									'dependency' => Array('element' => 'icon_style', 'value' => array('circle','square','advanced')
										),
									'group' => 'Button1',
								),
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Icon or Image Border Style', 'dfd'),
									'param_name' => 'icon_border_style',
									'value' => array(
										'Solid'=> 'solid',
										/*'None'=> '',*/
										'Dashed' => 'dashed',
										'Dotted' => 'dotted',
										'Double' => 'double',
										'Inset' => 'inset',
										'Outset' => 'outset',
									),
									'description' => __('Select the border style for icon.','dfd'),
									'dependency' => Array('element' => 'icon_style', 'value' => array('advanced')),
									'group' => 'Button1',
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Icon or Image Border Color', 'dfd'),
									'param_name' => 'icon_color_border',
									'value' => '',
									'description' => __('Select border color for icon.', 'dfd'),	
									'dependency' => Array('element' => 'icon_border_style', 'not_empty' => true),
									'group' => 'Button1',
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Icon or Image Border Hover Color', 'dfd'),
									'param_name' => 'icon_color_hoverborder',
									'value' => '',
									'description' => __('Select border hover color for icon.', 'dfd'),	
									'dependency' => Array('element' => 'icon_border_style', 'not_empty' => true),
									'group' => 'Button1',
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Icon or Image Border Width', 'dfd'),
									'param_name' => 'icon_border_size',
									'value' => '',
									'min' => 1,
									'max' => 10,
									'suffix' => 'px',
									'description' => __('Thickness of the border.', 'dfd'),
									'dependency' => Array('element' => 'icon_border_style', 'not_empty' => true),
									'group' => 'Button1',
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Icon or Image Border Radius', 'dfd'),
									'param_name' => 'icon_border_radius',
									'value' => '',
									'min' => 1,
									'max' => 100,
									'suffix' => 'px',
									'description' => __('0 pixel value will create a square border. As you increase the value, the shape convert in circle slowly. (e.g 500 pixels).', 'dfd'),
									'dependency' => Array('element' => 'icon_border_style', 'not_empty' => true),
									'group' => 'Button1',
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Background Size', 'dfd'),
									'param_name' => 'icon_border_spacing',
									'value' => '',
									'min' => 2,
									'max' => 100,
									'suffix' => 'px',
									'description' => __('Spacing from center of the icon till the boundary of border / background', 'dfd'),
									'dependency' => Array('element' => 'icon_border_style', 'not_empty' => true),
									'group' => 'Button1',

								),

								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Alignment', 'dfd'),
									'param_name' => 'icon_align',
									'value' => array(
										//'Center'	=>	'center',
										'Left'		=>	'',
										'Right'		=>	'right'
									),
									'group' => 'Button1',
								),
								array(
									'type' => 'textfield',
									'class' => '',
									'heading' => __(' Button Text', 'dfd'),
									'param_name' => 'button2_text',
									'value' => '',
									'admin_label' => true,
									'description' => __('Enter your Button2 text here.', 'dfd'),
									'group' => 'Button2',
								),
								array(
									'type' => 'vc_link',
									'class' => '',
									'heading' => __('Link ','dfd'),
									'param_name' => 'btn_icon_link',
									'value' => '',
									'description' => __('Add a custom link or select existing page. You can remove existing link as well.','dfd'),
									'group' => 'Button2',

								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Background Color', 'dfd'),
									'param_name' => 'btn2_background_color',
									'value' => '',
									'description' => __('Select Background Color for Button.', 'dfd'),	
									'group' => 'Button2',

								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Background Hover Color', 'dfd'),
									'param_name' => 'btn2_bghovercolor',
									'value' => '',
									'description' => __('Select background hover color for Button.', 'dfd'),
									//'dependency' => Array('element' => 'btn_hover_style', 'not_empty' => true),	
									'dependency' => Array('element' => 'btn_hover_style', 'value' => array('Style 1','Style 2','Style 3')),
									'group' => 'Button2',

								),

								array(
										'type' => 'ult_param_heading',
										'param_name' => 'btn1_icon_setting',
										'text' => __('Icon/Image ', 'ultimate'),
										'value' => '',
										'class' => '',
										'group' => __('Button2','dfd'),
										'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
									),
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Icon to display:', 'dfd'),
									'param_name' => 'btn_icon_type',
									'value' => array(
										'Font Icon Manager' => 'selector',
										'Custom Image Icon' => 'custom',
									),
									'description' => __('Use existing font icon or upload a custom image.', 'dfd'),
									'group' => 'Button2',
								),
								array(
									'type' => 'icon_manager',
									'class' => '',
									'heading' => __('Select Icon ','dfd'),
									'param_name' => 'btn_icon',
									'value' => '',
									'description' => __('Click and select icon of your choice. If you can\'t find the one that suits for your purpose','dfd').', '.__('you can','dfd').' <a href="admin.php?page=font-icon-Manager" target="_blank">'.__('add new here','dfd').'</a>.',
									'dependency' => Array('element' => 'btn_icon_type','value' => array('selector')),
									'group' => 'Button2',
								),
								array(
									'type' => 'ult_img_single',
									'class' => '',
									'heading' => __('Upload Image Icon:', 'dfd'),
									'param_name' => 'btn_icon_img',
									//'admin_label' => true,
									'value' => '',
									'description' => __('Upload the custom image icon.', 'dfd'),
									'dependency' => Array('element' => 'btn_icon_type','value' => array('custom')),
									'group' => 'Button2',
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Image Width', 'dfd'),
									'param_name' => 'btn_img_width',
									'value' => '',
									'min' => 16,
									'max' => 512,
									'suffix' => 'px',
									'description' => __('Provide image width', 'dfd'),
									'dependency' => Array('element' => 'btn_icon_type','value' => array('custom')),
									'group' => 'Button2',
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Size of Icon', 'dfd'),
									'param_name' => 'btn_icon_size',
									'value' => '',
									'min' => 12,
									'max' => 72,
									'suffix' => 'px',
									'description' => __('How big would you like it?', 'dfd'),
									'dependency' => Array('element' => 'btn_icon_type','value' => array('selector')),
									'group' => 'Button2',
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Icon Color', 'dfd'),
									'param_name' => 'btn_icon_color',
									'value' => '',
									'description' => __('Icon Color!', 'dfd'),
									'dependency' => Array('element' => 'btn_icon_type','value' => array('selector')),						
									'group' => 'Button2',
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Icon Hover Color', 'dfd'),
									'param_name' => 'btn_iconhover_color',
									'value' => '',
									'description' => __('Icon hover color!', 'dfd'),
									'dependency' => Array('element' => 'btn_icon_type','value' => array('selector')),						
									'group' => 'Button2',
								),
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Icon or Image Style', 'dfd'),
									'param_name' => 'btn_icon_style',
									'value' => array(
										'Simple' => 'none',
										'Circle Background' => 'circle',
										'Square Background' => 'square',
										'Design your own' => 'advanced',
									),
									'description' => __('We have given three quick preset if you are in a hurry. Otherwise, create your own with various options.', 'dfd'),
									'group' => 'Button2',
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Icon or Image Background Color', 'dfd'),
									'param_name' => 'btn_icon_color_bg',
									'value' => '',
									'description' => __('Select background color for icon.', 'dfd'),	
									'dependency' => Array('element' => 'btn_icon_style', 'value' => array('circle','square','advanced')),
									'group' => 'Button2',
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Icon or Image Background hover Color', 'dfd'),
									'param_name' => 'btn_icon_color_hoverbg',
									'value' => '',
									'description' => __('Select background hover color for icon.', 'dfd'),	
									'dependency' => Array('element' => 'btn_icon_style', 'value' => array('circle','square','advanced')
														  ),
									'group' => 'Button2',
								),
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Icon or Image Border Style', 'dfd'),
									'param_name' => 'btn_icon_border_style',
									'value' => array(
										'None'=> '',
										'Solid'=> 'solid',
										'Dashed' => 'dashed',
										'Dotted' => 'dotted',
										'Double' => 'double',
										'Inset' => 'inset',
										'Outset' => 'outset',
									),
									'description' => __('Select the border style for Button.','dfd'),
									'dependency' => Array('element' => 'btn_icon_style', 'value' => array('advanced')),
									'group' => 'Button2',
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Icon or Image Border Color', 'dfd'),
									'param_name' => 'btn_icon_color_border',
									'value' => '',
									'description' => __('Select border color for icon.', 'dfd'),	
									'dependency' => Array('element' => 'btn_icon_border_style', 'not_empty' => true),
									'group' => 'Button2',
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Icon or Image Border Hover Color', 'dfd'),
									'param_name' => 'btn_icon_color_hoverborder',
									'value' => '',
									'description' => __('Select border color for icon.', 'dfd'),	
									'dependency' => Array('element' => 'btn_icon_border_style', 'not_empty' => true
															),
									'group' => 'Button2',
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Icon or Image Border Width', 'dfd'),
									'param_name' => 'btn_icon_border_size',
									'value' => '',
									'min' => 1,
									'max' => 10,
									'suffix' => 'px',
									'description' => __('Thickness of the border.', 'dfd'),
									'dependency' => Array('element' => 'btn_icon_border_style', 'not_empty' => true),
									'group' => 'Button2',
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Icon or Image Border Radius', 'dfd'),
									'param_name' => 'btn_icon_border_radius',
									'value' => '',
									'min' => 1,
									'max' => 100,
									'suffix' => 'px',
									'description' => __('0 pixel value will create a square border. As you increase the value, the shape convert in circle slowly. (e.g 500 pixels).', 'dfd'),
									'dependency' => Array('element' => 'btn_icon_border_style', 'not_empty' => true),
									'group' => 'Button2',
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Icon or Image Background Size', 'dfd'),
									'param_name' => 'btn_icon_border_spacing',
									'value' => '',
									'min' => 30,
									'max' => 500,
									'suffix' => 'px',
									'description' => __('Spacing from center of the icon till the boundary of border / background', 'dfd'),
									'dependency' => Array('element' => 'btn_icon_border_style', 'not_empty' => true),
									'group' => 'Button2',

								),

								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Alignment', 'dfd'),
									'param_name' => 'btn2_icon_align',
									'value' => array(
										//'Center'	=>	'center',
										'Right'		=>	'',
										'Left'		=>	'left',

									),
									'group' => 'Button2',
								),

								/*--------divider---------------*/
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Select Deivider options', 'dfd'),
									'param_name' => 'divider_style',
									'value' => array(
										'Text'	=>	'text',
										'Icon'		=>	'icon',
										'Image'		=>	'image'
									),
									'group' => 'Divider',
								),
								array(
									'type' => 'textfield',
									'class' => '',
									'heading' => __(' Text', 'dfd'),
									'param_name' => 'divider_text',
									'value' => '',
									'description' => __('Enter your Divider text here.', 'dfd'),
									'dependency' => Array('element' => 'divider_style', 'value' => array('text')),
									'group' => 'Divider',
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Text/Icon Color', 'dfd'),
									'param_name' => 'divider_text_color',
									'value' => '',
									'description' => __('Select  color for divider text/icon.', 'dfd'),	
									'dependency' => Array('element' => 'divider_style', 'value' => array('text','icon')),
									'group' => 'Divider',
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Background Color', 'dfd'),
									'param_name' => 'divider_bg_color',
									'value' => '',
									'description' => __('Select border color for Icon/Text/Image.', 'dfd'),	
									'dependency' => Array('element' => 'divider_style', 'not_empty' => true),
									'group' => 'Divider',
								),

								array(
									'type' => 'icon_manager',
									'class' => '',
									'heading' => __('Select Icon ','dfd'),
									'param_name' => 'divider_icon',
									'value' => '',
									'description' => __('Click and select icon of your choice. If you can\'t find the one that suits for your purpose','dfd').', '.__('you can','dfd').' <a href="admin.php?page=font-icon-Manager" target="_blank">'.__('add new here','dfd').'</a>.',
									'dependency' => Array('element' => 'divider_style','value' => array('icon')),
									'group' => 'Divider',
								),
								array(
									'type' => 'ult_img_single',
									'class' => '',
									'heading' => __('Upload Image Icon:', 'dfd'),
									'param_name' => 'divider_icon_img',
									//'admin_label' => true,
									'value' => '',
									'description' => __('Upload the custom image icon.', 'dfd'),
									'dependency' => Array('element' => 'divider_style','value' => array('image')),
									'group' => 'Divider',
								),
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Border Style', 'dfd'),
									'param_name' => 'divider_border_style',
									'value' => array(
										'None'=> '',
										'Solid'=> 'solid',
										'Dashed' => 'dashed',
										'Dotted' => 'dotted',
										'Double' => 'double',
										'Inset' => 'inset',
										'Outset' => 'outset',
									),
									'description' => __('Select the border style for Button.','dfd'),
									//'dependency' => Array('element' => 'btn_hover_style', 'not_empty' => true),
									'group' => 'Divider',

								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Border Color', 'dfd'),
									'param_name' => 'divider_color_border',
									'value' => '',
									'description' => __('Select border color for divider.', 'dfd'),	
									'dependency' => Array('element' => 'divider_border_style', 'not_empty' => true),
									//'edit_field_class' => 'vc_column vc_col-sm-4',
									'group' => 'Divider',
								),

								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Border Width', 'dfd'),
									'param_name' => 'divider_border_size',
									'value' => '',
									'min' => 1,
									'max' => 10,
									'suffix' => 'px',
									'description' => __('Thickness of the border.', 'dfd'),
									'dependency' => Array('element' => 'divider_border_style', 'not_empty' => true),	
									//'edit_field_class' => 'vc_column vc_col-sm-4',
									'group' => 'Divider',
								),

									array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Border Radius', 'dfd'),
									'param_name' => 'divider_border_radius',

									'min' => 1,
									'max' => 50,
									'suffix' => 'px',
									 'dependency' => Array('element' => 'divider_border_style', 'not_empty' => true),
									// 'edit_field_class' => 'vc_column vc_col-sm-4',
									 'group' => 'Divider',

								),
								/*--- typgraphy--*/



										array(
										'type' => 'ult_param_heading',
										'param_name' => 'bt1typo-setting',
										'text' => __('Button 1 ', 'ultimate'),
										'value' => '',
										'class' => '',
										'group' => __('Typography','dfd'),
										'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
									),

								array(
									'type' => 'ultimate_google_fonts',
									'heading' => __('Title Font Family', 'dfd'),
									'param_name' => 'btn1_font_family',
									'description' => __('Select the font of your choice. ','dfd').', '.__('you can','dfd').' <a href="admin.php?page=ultimate-font-manager" target="_blank">'.__('add new in the collection here','dfd').'</a>.',
									'group' => 'Typography',
									),	

								array(
									'type' => 'ultimate_google_fonts_style',
									'heading' 		=>	__('Font Style', 'dfd'),
									'param_name'	=>	'btn1_heading_style',

									'group' => 'Typography',
								),	
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Text Color', 'dfd'),
									'param_name' => 'btn1_text_color',
									'value' => '',
									'description' => __('Select text color for icon.', 'dfd'),	
									'group' => 'Typography',

								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Text Hover Color', 'dfd'),
									'param_name' => 'btn1_text_hovercolor',
									'value' => '',
									'description' => __('Select text hover color for icon.', 'dfd'),	
									//'dependency' => Array('element' => 'btn_hover_style', 'not_empty' => true),
									'dependency' => Array('element' => 'btn_hover_style', 'value' => array('Style 1','Style 2','Style 3')),
									'group' => 'Typography',

								),

								array(
										'type' => 'ult_param_heading',
										'param_name' => 'btn2_bg_setting',
										'text' => __('Button 2 ', 'ultimate'),
										'value' => '',
										'class' => '',
										'group' => __('Typography','dfd'),
										'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
									),

								array(
									'type' => 'ultimate_google_fonts',
									'heading' => __('Title Font Family', 'dfd'),
									'param_name' => 'btn2_font_family',
									'description' => __('Select the font of your choice. ','dfd').', '.__('you can','dfd').' <a href="admin.php?page=ultimate-font-manager" target="_blank">'.__('add new in the collection here','dfd').'</a>.',
									'group' => 'Typography',
									),	

								array(
									'type' => 'ultimate_google_fonts_style',
									'heading' 		=>	__('Font Style', 'dfd'),
									'param_name'	=>	'btn2_heading_style',

									'group' => 'Typography',
								),		
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Text Color', 'dfd'),
									'param_name' => 'btn2_text_color',
									'value' => '',
									'description' => __('Select text color for icon.', 'dfd'),	
									'group' => 'Typography',

								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Text Hover Color', 'dfd'),
									'param_name' => 'btn2_text_hovercolor',
									'value' => '',
									'description' => __('Select text hover color for icon.', 'dfd'),
									//'dependency' => Array('element' => 'btn_hover_style', 'not_empty' => true),	
									'dependency' => Array('element' => 'btn_hover_style', 'value' => array('Style 1','Style 2','Style 3')),
									'group' => 'Typography',

								),


							),
						)
					);
				}
			}

		}
	}
	if(class_exists('AIO_Dual_Button')) {
		$AIO_Dual_Button = new AIO_Dual_Button;


	}
	if(class_exists('WPBakeryShortCode')) {
		class WPBakeryShortCode_ult_dualbutton extends WPBakeryShortCode {
		}
	}
}
