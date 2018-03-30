<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Expandable Section for Visual Composer
* Add-on URI: http://dev.brainstormforce.com
*/
global $dfd_ronneby;
if(isset($dfd_ronneby['enable_default_addons']) && strcmp($dfd_ronneby['enable_default_addons'], '1') === 0) {
	if(!class_exists('AIO_ultimate_exp_section')) {
		class AIO_ultimate_exp_section{
			function __construct(){
				add_shortcode('ultimate_exp_section',array($this,'ultimate_exp_section_shortcode'));
				add_action('init',array($this,'ultimate_ultimate_exp_section'));
				add_action( 'wp_enqueue_scripts', array( $this, 'ultimate_exp_scripts') , 1);
			}

			function ultimate_exp_scripts(){
				wp_register_style( 'style_ultimate_expsection', get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-css/expandable-section.min.css',array(),null,FALSE);
				wp_register_script('jquery_ultimate_expsection',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-js/expandable-section.min.js',array('jquery','jquery_ui'),null);
				wp_register_script('jquery_ui',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-js/jquery-ui.min.js',array('jquery'),null);
			} 

			// Shortcode handler function for stats Icon
			function ultimate_exp_section_shortcode($atts ,$content) {
				$title=$heading_style=$font_family=$title_font_size=$title_line_ht=$text_color=$text_hovercolor=
				$icon_type=
				$icon=$icon_img=$img_width=$icon_size=$icon_size=$icon_color=
				$icon_hover_color=$icon_style=$icon_color_bg=$icon_color_hoverbg=
				$icon_border_style=$icon_color_border=$icon_color_hoverborder=
				$icon_border_size=$icon_border_radius=$icon_border_spacing=$map_override=
				$icon_align=$el_class=$css_editor='';

				extract(shortcode_atts( array(	

					'title'					=>' ',
					'heading_style'			=>' ',
					'font_family'			=>' ',
					'title_font_size'		=>'20',
					'title_line_ht'			=>'20',
					'text_color'			=>'#333333',
					'text_hovercolor'		=>'#333333',
					'icon_type'				=>'selector',
					'icon'					=>'',
					'icon_img'				=>'',
					'img_width'				=>'48',
					'icon_size'				=>'32',
					'icon_color'			=>'#333333',
					'icon_hover_color'		=>'#333333',
					'icon_style'			=>'none',
					'icon_color_bg'			=>'#ffffff',
					'icon_color_hoverbg'	=>'#ecf0f1',
					'icon_border_style' 	=>'solid',
					'icon_color_border' 	=>'#333333',
					'icon_color_hoverborder'=>'#333333',
					'icon_border_size'		=>'1',
					'icon_border_radius'    =>'0',
					'icon_border_spacing'	=>'30',
					'icon_align'			=>'center',
					'extra_class'			=>' ',
					'css'  					=>' ',
					'background_color'      =>'#dbdbdb',
					'bghovercolor'			=>'#e5e5e5',
					'cnt_bg_color'			=>'#dbdbdb',
					'cnt_hover_bg_color'	=>' ',
					'exp_icon'				=>' ',
					'exp_effect'			=>'slideToggle',
					'cont_css'				=>' ',
					'section_width'			=>' ',
					'map_override'			=>'0',
					'new_title'				=>' ',
					'new_icon'				=>' ',
					'new_icon_img'			=>' ',
					'title_active' 			=>'#333333',
					'title_active_bg' 		=>'#dbdbdb',
					'icon_active_color'		=>'#333333',
					'icon_active_color_bg'  =>'#ffffff',
					'title_margin'			=>' ',
					'iconmargin_css'		=>' ',
					'icon_color_activeborder'=>'#333333',
					'title_margin' 			=>' ',
					'title_padding'			=>' ',
					'desc_padding'			=>' ',
					'desc_margin'			=>' ',
					'icon_margin'			=>' ',
					'section_height'   		=>'0',
				),$atts));

				//echo $exp_effect;

				/*---------- data attribute-----------------------------*/
				//echo $title_margin.$title_padding;
				$data='';
				$data.='data-textcolor="'.esc_attr($text_color).'"';
				if($text_hovercolor==' '){
					$text_hovercolor = $text_color;
				}

				$data.='data-texthover="'.esc_attr($text_hovercolor).'"';
				$data.='data-icncolor="'.esc_attr($icon_color).'"';
				$data.='data-ihover="'.esc_attr($icon_hover_color).'"';
				$data.='data-height="'.esc_attr($section_height).'"';

				$data.='data-cntbg="'.esc_attr($background_color).'"';
				$data.='data-cnthvrbg="'.esc_attr($bghovercolor).'"';
				$data.='data-headerbg="'.esc_attr($background_color).'"';
				if($bghovercolor==' '){
					$bghovercolor=$background_color;
				}
				$data.='data-headerhover="'.esc_attr($bghovercolor).'"';
				$data.='data-title="'.esc_attr($title).'"';
				if($new_title==' '){
					$new_title=$title;
				}

				$data.='data-newtitle="'.esc_attr($new_title).'"';
				//echo $new_icon;
				$data.='data-icon="'.esc_attr($icon).'"';
				//echo $new_icon;
				if($new_icon==' '){
					$new_icon=$icon;
				}
				if($new_icon =='none'){
					$new_icon=$icon;
				}
				$data.='data-newicon="'.esc_attr($new_icon).'"';
				/*----active icon --------*/

				if($icon_active_color==''){
					$icon_active_color=$icon_hover_color;
				}
				$data.='data-activeicon="'.esc_attr($icon_active_color).'"';


				if($icon_style!= 'none'){
					$data.='data-icnbg="'.$icon_color_bg.'"';
					$data.='data-icnhvrbg="'.esc_attr($icon_color_hoverbg).'"';
					if($icon_active_color_bg==' '){
						$icon_active_color_bg=$icon_color_hoverbg;
					}
					$data.='data-activeiconbg="'.esc_attr($icon_active_color_bg).'"';

				}
				if($icon_style== 'advanced'){
					$data.='data-icnbg="'.esc_attr($icon_color_bg).'"';
					$data.='data-icnhvrbg="'.esc_attr($icon_color_hoverbg).'"';
					$data.='data-icnborder="'.esc_attr($icon_color_border).'"';
					if($icon_color_hoverborder==' '){
						$icon_color_hoverborder=$icon_color_border;
					}
					$data.='data-icnhvrborder="'.esc_attr($icon_color_hoverborder).'"';
					if($icon_active_color_bg==' '){
						$icon_active_color_bg=$bghovercolor;
					}
					$data.='data-activeiconbg="'.esc_attr($icon_active_color_bg).'"';

					if($icon_color_activeborder==' '){
						$icon_color_activeborder=$icnhvrborder;
					}
					$data.='data-activeborder="'.esc_attr($icon_color_activeborder).'"';

				}
				$data.='data-effect="'.esc_attr($exp_effect).'"';
				$data.='data-override="'.esc_attr($map_override).'"';

				/*---active color ----------*/
				if($title_active==''){
					$title_active=$text_hovercolor;
				}
				$data.='data-activetitle="'.esc_attr($title_active).'"';

				if($title_active_bg==' '){
					$title_active_bg=$bghovercolor;
				}
				$data.='data-activebg="'.esc_attr($title_active_bg).'"';

				/*----active icon --------*/

				/*if($icon_active_color==''){
					$icon_active_color=$bghovercolor;
				}
				$data.='data-activeicon="'.$icon_active_color.'"';

				if($icon_active_color_bg==''){
					$icon_active_color_bg=$bghovercolor;
				}
				$data.='data-activeicon="'.$icon_active_color_bg.'"';*/


				/*------------icon style---------*/
				$iconoutput =$newsrc=$src1=$img_ext='';
				$style =$css_trans=$iconbgstyle='';
				if($icon_type == 'custom'){

					if($icon_img!==''){

						$img = apply_filters('ult_get_img_single', $icon_img, 'url', 'large');

						$newimg=apply_filters('ult_get_img_single', $new_icon_img, 'url', 'large');

						$newsrc=$newimg;
						$src1=$img;
						$alt = get_post_meta($icon_img, '_wp_attachment_image_alt', true);

						if($icon_style !== 'none'){
							if($icon_color_bg !== '')
								$style .= 'background:'.esc_attr($icon_color_bg).';';
							//$style .= 'background:transperent;';
						}
						if($icon_style == 'circle'){
							$el_class.= ' uavc-circle ';
							$img_ext.= 'ult_circle ';
						}
						if($icon_style == 'square'){
							$el_class.= ' uavc-square ';
							$img_ext.= 'ult_square ';
						}
						if($icon_style == 'advanced' && $icon_border_style !== '' ){
							$style .= 'border-style:'.esc_attr($icon_border_style).';';
							$style .= 'border-color:'.esc_attr($icon_color_border).';';
							$style .= 'border-width:'.esc_attr($icon_border_size).'px;';
							$style .= 'padding:'.esc_attr($icon_border_spacing).'px;';
							$style .= 'border-radius:'.esc_attr($icon_border_radius).'px;';
						}
						if(!empty($img)){

							if($icon_align == 'center') {
								$style .= 'display:inline-block;';
							}
							$iconoutput .= "\n".'<span class="aio-icon-img '.esc_attr($el_class).' '.'ult_expsection_icon " style="font-size:'.esc_attr($img_width).'px;'.$style.'" '.$css_trans.'>';
							$iconoutput .= "\n\t".'<img class="img-icon ult_exp_img '.esc_attr($img_ext).'" alt="'.esc_attr($alt).'" src="'.esc_url($img).'" />';	
							$iconoutput .= "\n".'</span>';
						}
						if(!empty($img)){
							$iconoutput = $iconoutput;
						} else {
							$iconoutput = '';
						}

					}
				} else {
				if($icon!=='') {
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
					if($icon_align !== 'left'){
						$style .= 'display:inline-block;';
					}
					if($icon !== ""){
						$iconoutput .= "\n".'<span class="aio-icon  '.esc_attr($icon_style).' '.esc_attr($el_class).' ult_expsection_icon " '.$css_trans.' style="'.$style.'">';				
						$iconoutput .= "\n\t".'<i class="'.esc_attr($icon).' ult_ex_icon"  ></i>';	
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

			/*----------- image replace ----------------*/

			$data.='data-img="'.esc_url($src1).'"';
			if($newsrc==''){
				$newsrc=$src1;
			}
			$data.='data-newimg="'.esc_url($newsrc).'"';

			/*------------header bg style---------*/

			$headerstyle ='';
			if($text_color!='')
			$headerstyle.='color:'.esc_attr($text_color).';';
			if($background_color!='')
			$headerstyle.='background-color:'.esc_attr($background_color).';';

			if (function_exists('get_ultimate_font_family')) {
				$mhfont_family = get_ultimate_font_family($font_family);
				if($mhfont_family!='')
				$headerstyle .= 'font-family:'.esc_attr($mhfont_family).';';
			}
			if (function_exists('get_ultimate_font_style')) {
				$headerstyle .= get_ultimate_font_style($heading_style);
			}
			if($title_font_size!=''){
				$headerstyle.='font-size:'.esc_attr($title_font_size).'px;';
			}
			if($title_line_ht!=''){
				$headerstyle.='line-height:'.esc_attr($title_line_ht).'px;';
			}
			$headerstyle.=$title_margin;
			$headerstyle.=$title_padding;

			/*---------------title padding---------------------*/
			$css_class = '';
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), "ultimate_exp_section", $atts );
			$css_class = esc_attr( $css_class );

			 /*---------------desc padding---------------------*/
			$desc_css_class = '';
			$desc_css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $cont_css, ' ' ), "ultimate_exp_section", $atts );
			$desc_css_class = esc_attr( $desc_css_class );


			/*---------------desc padding---------------------*/
			$icon_css_class = '';
			$icon_css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $iconmargin_css, ' ' ), "ultimate_exp_section", $atts );
			$icon_css_class = esc_attr( $icon_css_class);

			 /*--------------------- full width row settings---------------------*/
			 //echo $map_override;

			/*------------content style--------------------------*/
			$cnt_style ='';

			if($cnt_bg_color!='') {
				$cnt_style .= 'background-color:'.esc_attr($cnt_bg_color).';';
			}
				//$cnt_style .= 'background-color:'.$bghovercolor.';';
			$cnt_style .= $desc_padding;
			$cnt_style .= $desc_margin;

			$position='';
			if($icon_align=='left'){
				$position='ult_expleft_icon';
			}
			if($icon_align=='right'){
				$position='ult_expright_icon';
			}
			$top='';
			$output='';
			$icon_output='';
			$text_align='';
			if($icon_align=='top'){
				if($icon_type == 'custom'){
					$text_align .='text-align:-webkit-center;';
				} else {
					$text_align .='text-align:center;';
				}
			//text_align .='text-align:center';

			}
			$text_align.=$icon_margin;

			if($iconoutput!=''){
				$icon_output='	<div class="ult-just-icon-wrapper ult_exp_icon">
								<div class="align-icon '.esc_attr($icon_css_class).'" style="text-align:'.esc_attr($icon_align).';'.esc_attr($text_align).'">
									'.$iconoutput.'
								</div>
							</div>';
			}
			//echo $icon;
			if(empty($iconoutput) || $iconoutput==' '){
				//echo"dhgfhj";
					$icon_output='';
				}
				$section_style=' ';
			if($section_width !==' '){
				$section_style='max-width:'.esc_attr($section_width).'px;';
			}

			$output.='
			<div class="ult_exp_section_layer '.esc_attr($extra_class).'" >
				<div class="ult_exp_section '.esc_attr($css_class) .'" style="'.$headerstyle.'" '.$data.'>';
					if($icon_align=='left'){
						$output.='<div class="ult_exp_section-main '.esc_attr($position).'">'.$icon_output.'
							<div class="ult_expheader" align="'.esc_attr($icon_align).'" >'.$title.'
							</div>
						</div>
					</div>';
					} else if($icon_align=='top') {
						$output.='<div class="ult_exp_section-main '.esc_attr($position).'">
								'.$icon_output.'
								<div class="ult_expheader" align="center" >'.$title.'
								 </div></div>
						</div>';
					} else {

					$output.='<div class="ult_exp_section-main '.esc_attr($position).'">
								<div class="ult_expheader" align="'.esc_attr($icon_align).'" >'.$title.'
								 </div>'.$icon_output.'</div>
							</div>';
					}
					if($content!=''){
						$output.='<div class="ult_exp_content '.esc_attr($desc_css_class).'" style="'.$cnt_style.'">';

						$output.='<div class="ult_ecpsub_cont" style="'.$section_style.'" >';
						$output.=	do_shortcode($content);
						$output.='</div>';
					}
					//<!--end of ult_ecpsub_cont-->
					$output.='</div>

				</div>';
				//<!--end of exp_content-->

				if($title!=' '|| $new_title!=' '){
					return $output;
				}
			}


			function ultimate_ultimate_exp_section() {
				if(function_exists('vc_map')) {
					vc_map(
						array(
							'name' => __('Expandable Section'),
							'base' => 'ultimate_exp_section',
							'icon'=> 'collapsable.png',
							'as_parent' => array('except' => 'ultimate_exp_section'),
							'category' => __('Ultimate VC Addons','dfd'),
							'description' => __('Add a Expandable Section.','dfd'),
							'content_element' => true,
							'front_enqueue_css' => get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-css/expandable-section.min.css',
							'front_enqueue_js' => get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-js/expandable-section.min.js',
							'controls' => 'full',
							'show_settings_on_create' => true,
							//'is_container'    => true,
							'params' => array(							
								// Play with icon selector
								array(
									'type' => 'textfield',
									'class' => '',
									'heading' => __('Title ','dfd'),
									'param_name' => 'title',
									'value' => '',
									//'description' => __('Add a custom link or select existing page. You can remove existing link as well.','dfd'),
									//'group' => 'Title Setting',
								),
								array(
									'type' => 'textfield',
									'class' => '',
									'heading' => __('Title After Click ','dfd'),
									'param_name' => 'new_title',
									'value' => '',
									'description' => __('Keep empty if you want to dispaly same title as previous.','dfd'),
									//'group' => 'Title Setting',
								),
								/*-----------general------------*/
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Title Color', 'dfd'),
									'param_name' => 'text_color',
									'value' => '',
									//'description' => __('Select text color for Link.', 'dfd'),	
									'group' => 'Color',							
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Title Background Color', 'dfd'),
									'param_name' => 'background_color',
									'value' => '',
									'group' => 'Color',
									'edit_field_class' => 'vc_col-sm-12 vc_column ult_space_border',
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Title Hover Color', 'dfd'),
									'param_name' => 'text_hovercolor',
									'value' => '',											
									'group' => 'Color',
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Title Hover Background Color', 'dfd'),
									'param_name' => 'bghovercolor',
									'value' => '',
									'group' => 'Color',
									'edit_field_class' => 'vc_col-sm-12 vc_column ult_space_border',
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Title Active Color', 'dfd'),
									'param_name' => 'title_active',
									'value' => '',											
									'group' => 'Color',
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Title Active Background Color', 'dfd'),
									'param_name' => 'title_active_bg',
									'value' => '',
									'group' => 'Color',
									'edit_field_class' => 'vc_col-sm-12 vc_column ult_space_border',
								),
								/*--container bg color---*/
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Content Background Color', 'dfd'),
									'param_name' => 'cnt_bg_color',
									'value' => '',
									'group' => 'Color',
								),
								/*---icon---*/
								array(
									'type' => 'ult_param_heading',
									'param_name' => 'btn1_icon_setting',
									'text' => __('Icon / Image ', 'dfd'),
									'value' => '',
									'class' => '',
									'group' => __('Icon','dfd'),
									'edit_field_class' => 'ult-param-heading-wrapper  vc_column vc_col-sm-12',
								),
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Icon to display', 'dfd'),
									'param_name' => 'icon_type',
									'value' => array(
										__('Font Icon Manager','dfd') => 'selector',
										__('Custom Image Icon','dfd') => 'custom',
									),
									'description' => __('Use existing font icon or upload a custom image.', 'dfd'),
									'group' => __('Icon','dfd'),
								),

								array(
									'type' => 'icon_manager',
									'class' => '',
									'heading' => __('Select Icon ','dfd'),
									'param_name' => 'icon',
									'value' => '',
									'description' => __('Click and select icon of your choice. If you can\'t find the one that suits for your purpose','dfd').', '.__('you can','dfd').' <a href="admin.php?page=font-icon-Manager" target="_blank">'.__('add new here','dfd').'</a>.',
									'dependency' => Array('element' => 'icon_type','value' => array('selector')),
									'group' => __('Icon','dfd'),
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
									'group' => __('Icon','dfd'),
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Image Width', 'dfd'),
									'param_name' => 'img_width',
									'value' =>'',
									'min' => 16,
									'max' => 512,
									'suffix' => 'px',
									'description' => __('Provide image width', 'dfd'),
									'dependency' => Array('element' => 'icon_type','value' => array('custom')),
									'group' => __('Icon','dfd'),
								),
								array(
									'type' => 'ult_param_heading',
									'param_name' => 'btn1_icon_setting',
									'text' => __(' ', 'dfd'),
									'value' => '',
									'class' => '',
									'group' => __('Icon','dfd'),
									'edit_field_class' => 'ult-param-heading-wrapper  vc_column vc_col-sm-12',
								),
								array(
									'type' => 'icon_manager',
									'class' => '',
									'heading' => __('Select Icon For On Click ','dfd'),
									'param_name' => 'new_icon',
									'value' => '',
									'description' => __('Click and select icon of your choice. If you can\'t find the one that suits for your purpose','dfd').', '.__('you can','dfd').' <a href="admin.php?page=font-icon-Manager" target="_blank">'.__('add new here','dfd').'</a>.',
									'dependency' => Array('element' => 'icon_type','value' => array('selector')),
									'group' => __('Icon','dfd'),
								),
								array(
									'type' => 'ult_img_single',
									'class' => '',
									'heading' => __('Upload Image On Click:', 'dfd'),
									'param_name' => 'new_icon_img',
									//'admin_label' => true,
									'value' => '',
									'description' => __('Upload the custom image icon.', 'dfd'),
									'dependency' => Array('element' => 'icon_type','value' => array('custom')),
									'group' => __('Icon','dfd'),
								),
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Icon / Image Position', 'dfd'),
									'param_name' => 'icon_align',
									'value' => array(
										__('Bottom','dfd')	=>	'',
										__('Top','dfd')		=>	'top',
										__('Left','dfd')		=>	'left',
										__('Right','dfd')		=>	'right'
									),
									'group' => __('Icon','dfd'),
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
									'group' => __('Icon','dfd'),
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Icon Color', 'dfd'),
									'param_name' => 'icon_color',
									'value' => '',
									'dependency' => Array('element' => 'icon_type','value' => array('selector')),						
									'group' => __('Icon','dfd'),
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Icon Hover Color', 'dfd'),
									'param_name' => 'icon_hover_color',
									'value' => '',
									'dependency' => Array('element' => 'icon_type','value' => array('selector')),						
									'group' => __('Icon','dfd'),
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Icon Active Color', 'dfd'),
									'param_name' => 'icon_active_color',
									'value' => '',
									'dependency' => Array('element' => 'icon_type','value' => array('selector')	),						
									'group' => __('Icon','dfd'),
								),
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Icon / Image Style', 'dfd'),
									'param_name' => 'icon_style',
									'value' => array(
										__('Simple','dfd') => 'none',
										__('Circle Background','dfd') => 'circle',
										__('Square Background','dfd') => 'square',
										__('Design your own','dfd') => 'advanced',
									),
									'description' => __('We have given three quick preset if you are in a hurry. Otherwise, create your own with various options.', 'dfd'),
									'group' => __('Icon','dfd'),
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Icon / Image Background Color ', 'dfd'),
									'param_name' => 'icon_color_bg',
									'value' => '',
									'dependency' => Array('element' => 'icon_style', 'value' => array('circle','square','advanced')),
									'group' => __('Icon','dfd'),
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Icon / Image Hover Background Color ', 'dfd'),
									'param_name' => 'icon_color_hoverbg',
									'value' => '',
									'dependency' => Array('element' => 'icon_style', 'value' => array('circle','square','advanced')),
									'group' => __('Icon','dfd'),
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Icon / Image Active Background Color ', 'dfd'),
									'param_name' => 'icon_active_color_bg',
									'value' => '',
									'dependency' => Array('element' => 'icon_style', 'value' => array('circle','square','advanced')),
									'group' => __('Icon','dfd'),
								),
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Icon / Image Border Style', 'dfd'),
									'param_name' => 'icon_border_style',
									'value' => array(
										__('Solid','dfd') => '',
										/*'None'=> '',*/
										__('Dashed','dfd') => 'dashed',
										__('Dotted','dfd') => 'dotted',
										__('Double','dfd') => 'double',
										__('Inset','dfd') => 'inset',
										__('Outset','dfd') => 'outset',
									),
									'description' => __('Select the border style for icon.','dfd'),
									'dependency' => Array('element' => 'icon_style', 'value' => array('advanced')),
									'group' => __('Icon','dfd'),
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Icon / Image Border Color', 'dfd'),
									'param_name' => 'icon_color_border',
									'value' => '',
									'dependency' => Array('element' => 'icon_border_style', 'not_empty' => true),
									'group' => __('Icon','dfd'),
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Icon / Image Hover Border Color', 'dfd'),
									'param_name' => 'icon_color_hoverborder',
									'value' => '',
									'dependency' => Array('element' => 'icon_border_style', 'not_empty' => true),
									'group' => __('Icon','dfd'),
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Icon / Image Active Border Color', 'dfd'),
									'param_name' => 'icon_color_activeborder',
									'value' => '',
									'dependency' => Array('element' => 'icon_border_style', 'not_empty' => true),
									'group' => __('Icon','dfd'),
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Icon / Image Border Width', 'dfd'),
									'param_name' => 'icon_border_size',
									'value' => '',
									'min' => 1,
									'max' => 10,
									'suffix' => 'px',
									'description' => __('Thickness of the border.', 'dfd'),
									'dependency' => Array('element' => 'icon_border_style', 'not_empty' => true),
									'group' => __('Icon','dfd'),
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Icon / Image Border Radius', 'dfd'),
									'param_name' => 'icon_border_radius',
									'value' =>'',
									'min' => 1,
									'max' => 100,
									'suffix' => 'px',
									'description' => __('0 pixel value will create a square border. As you increase the value, the shape convert in circle slowly. (e.g 500 pixels).', 'dfd'),
									'dependency' => Array('element' => 'icon_border_style', 'not_empty' => true),
									'group' => __('Icon','dfd'),
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
									'group' => __('Icon','dfd'),
								),
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Effect ', 'dfd'),
									'param_name' => 'exp_effect',
									'value' => array(
										__('Slide','dfd') => '',
										__('Fade','dfd') => 'fadeToggle',
									),
								),

								array(
									'type' => 'textfield',
									'class' => '',
									'heading' => __('Custom CSS Class', 'dfd'),
									'param_name' => 'extra_class',
									'value' => '',
									'description' => __('Ran out of options? Need more styles? Write your own CSS and mention the class name here.', 'dfd'),
								),
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Expandable Section Width Override', 'dfd'),
									'param_name' => 'map_override',
									'value' =>array(
										__('Default Width','dfd') =>'0',
										__('Apply 1st parent element\'s width','dfd') =>'1',
										__('Apply 2nd parent element\'s width','dfd') =>'2',
										__('Apply 3rd parent element\'s width','dfd') =>'3',
										__('Apply 4th parent element\'s width','dfd') =>'4',
										__('Apply 5th parent element\'s width','dfd') =>'5',
										__('Apply 6th parent element\'s width','dfd') =>'6',
										__('Apply 7th parent element\'s width','dfd') =>'7',
										__('Apply 8th parent element\'s width','dfd') =>'8',
										__('Apply 9th parent element\'s width','dfd') =>'9',
										__('Full Width','dfd') =>'full',
										__('Maximum Full Width','dfd') =>'ex-full',
									),
									'description' => __('By default, the section will be given to the Visual Composer row. However, in some cases depending on your theme\'s CSS - it may not fit well to the container you are wishing it would. In that case you will have to select the appropriate value here that gets you desired output..', 'dfd'),
									'group' => __( 'Design ', 'dfd' ),								
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Content Width', 'dfd'),
									'param_name' => 'section_width',
									'value' => '',
									'min' => 200,
									'max' => 1200,
									'suffix' => 'px',
									'description' => __('Adjust width of your content. Keep empty for full width.', 'dfd'),
									'group' => __( 'Design ', 'dfd' ),
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Top Gutter Position', 'dfd'),
									'param_name' => 'section_height',
									'value' => '',
									'min' => 0,
									'max' => 1200,
									'suffix' => 'px',
									'description' => __('After click distance between viewport top & expandable section.', 'dfd'),
									'group' => __( 'Design ', 'dfd' ),
								),
								array(
									'type' => 'ult_param_heading',
									'param_name' => 'title-setting',
									'text' => __('Title ', 'ultimate'),
									'value' => '',
									'class' => '',
									'group' => __( 'Design ', 'dfd' ),
									'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
								),
								array(
									'type' => 'ultimate_spacing',
									'heading' => ' Title Margin ',
									'param_name' => 'title_margin',
									'mode'  => 'margin',                    //  margin/padding
									'unit'  => 'px',                        //  [required] px,em,%,all     Default all
									'positions' => array(                   //  Also set 'defaults'
										__('Top','dfd') => '',
										__('Right','dfd') => '',
										__('Bottom','dfd') => '',
										__('Left','dfd') => '',
									),
									'group' => __( 'Design ', 'dfd' ),
									'description' => __('Add spacing from outside to titlebar.', 'dfd'),
								),
								array(
									'type' => 'ultimate_spacing',
									'heading' => ' Title Padding ',
									'param_name' => 'title_padding',
									'mode'  => 'padding',                    //  margin/padding
									'unit'  => 'px',                        //  [required] px,em,%,all     Default all
									'positions' => array(                   //  Also set 'defaults'
										__('Top','dfd') => '',
										__('Right','dfd') => '',
										__('Bottom','dfd') => '',
										__('Left','dfd') => '',
									),
									'group' => __( 'Design ', 'dfd' ),
									'description' => __('Add spacing from inside to titlebar.', 'dfd'),
								),
								array(
									'type' => 'ult_param_heading',
									'param_name' => 'title-setting',
									'text' => __('Content ', 'ultimate'),
									'value' => '',
									'class' => '',
									'group' => __( 'Design ', 'dfd' ),
									'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
								),
								array(
									'type' => 'ultimate_spacing',
									'heading' => ' Content Margin ',
									'param_name' => 'desc_margin',
									'mode'  => 'margin',                    //  margin/padding
									'unit'  => 'px',                        //  [required] px,em,%,all     Default all
									'positions' => array(                   //  Also set 'defaults'
										__('Top','dfd') => '',
										__('Right','dfd') => '',
										__('Bottom','dfd') => '',
										__('Left','dfd') => '',
									),
									'group' => __( 'Design ', 'dfd' ),
									'description' => __('Add spacing from outside to content.', 'dfd'),
								),
								array(
									'type' => 'ultimate_spacing',
									'heading' => ' Content Padding ',
									'param_name' => 'desc_padding',
									'mode'  => 'padding',                    //  margin/padding
									'unit'  => 'px',                        //  [required] px,em,%,all     Default all
									'positions' => array(                   //  Also set 'defaults'
										__('Top','dfd') => '',
										__('Right','dfd') => '',
										__('Bottom','dfd') => '',
										__('Left','dfd') => '',
									),
									'group' => __( 'Design ', 'dfd' ),
									'description' => __('Add spacing from inside to content.', 'dfd'),
								),
								array(
									'type' => 'ult_param_heading',
									'param_name' => 'icn-setting',
									'text' => __('Icon ', 'ultimate'),
									'value' => '',
									'class' => '',
									'group' => __( 'Design ', 'dfd' ),
									'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
								),

								array(
									'type' => 'ultimate_spacing',
									'heading' => ' Icon Margin ',
									'param_name' => 'icon_margin',
									'mode'  => 'margin',                    //  margin/padding
									'unit'  => 'px',                        //  [required] px,em,%,all     Default all
									'positions' => array(                   //  Also set 'defaults'
										__('Top','dfd') => '',
										__('Right','dfd') => '',
										__('Bottom','dfd') => '',
										__('Left','dfd') => '',
									),
									'group' => __( 'Design ', 'dfd' ),
									'description' => __('Add spacing to icon.', 'dfd'),
								),
								/*---typography-------*/
								array(
									'type' => 'ultimate_google_fonts',
									'heading' => __('Title Font Family', 'dfd'),
									'param_name' => 'font_family',
									'description' => __('Select the font of your choice. ','dfd').', '.__('you can','dfd').' <a href="admin.php?page=ultimate-font-manager" target="_blank">'.__('add new in the collection here','dfd').'</a>.',
									'group' => 'Typography ',
								),	
								array(
									'type' => 'ultimate_google_fonts_style',
									'heading' 		=>	__('Font Style', 'dfd'),
									'param_name'	=>	'heading_style',

									'group' => 'Typography ',
								),	
								array(
									'type' => 'number',
									'param_name' => 'title_font_size',
									'heading' => __('Font size','dfd'),
									'value' => '',
									'suffix' => 'px',
									'group' => 'Typography ',
								),

								array(
									'type' => 'number',
									'param_name' => 'title_line_ht',
									'heading' => __('Line Height','dfd'),
									'value' => '',
									'suffix' => 'px',
									'group' => 'Typography ',

								),
							),
							'js_view' => 'VcColumnView'
						)

					);
				}
			}

		}
	}
	if(class_exists('AIO_ultimate_exp_section')) {
		$AIO_ultimate_exp_section = new AIO_ultimate_exp_section;
	}

	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_ultimate_exp_section extends WPBakeryShortCodesContainer {
		}
	}
}
