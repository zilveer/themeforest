<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Creatve Link for Visual Composer
* Add-on URI: http://dev.brainstormforce.com
*/ 
global $dfd_ronneby;
if(isset($dfd_ronneby['enable_default_addons']) && strcmp($dfd_ronneby['enable_default_addons'], '1') === 0) {
	if(!class_exists('AIO_creative_link')) {
		class AIO_creative_link {
			function __construct() {
				add_shortcode('ult_createlink',array($this,'ult_createlink_shortcode'));
				add_action('init',array($this,'ultimate_createlink'));
				add_action( 'wp_enqueue_scripts', array( $this, 'creative_link_scripts'), 1 );
				//add_action( 'admin_enqueue_scripts', array( $this, 'link_backend_scripts') );	
			}

			//enque script
			function creative_link_scripts(){
				wp_register_style( 'ult_cllink', get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-css/creative-link.min.css',array(),null );
				wp_register_script('jquery.ult_cllink',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-js/creative-link.min.js',array('jquery'),null);
			}
			/*function link_backend_scripts(){
				wp_enqueue_script("ult_jquery_creative_link",plugins_url("../admin/js/jquery_creative_link.js ",__FILE__),array('jquery'),null);

			}*/

			// Shortcode handler function for stats Icon
			function ult_createlink_shortcode($atts) {

				extract(shortcode_atts( array(	

					'btn_link'			 => '',
					'text_color'		 => '#333333',
					'text_hovercolor' 	 => '#333333',
					'background_color'   => '#ffffff',
					'bghovercolor' 		 => '',				
					'font_family' 		 => '',
					'heading_style' 	 => '',
					'title_font_size'    => '',
					'title_line_ht'		 => '',
					'link_hover_style'	 =>'',
					'border_style' 		 => 'solid',
					'border_color' 		 => '#333333',			
					'border_hovercolor'  => '#333333',
					'border_size' 		 => '1',
					'el_class'  		 => '',
					'dot_color' 		 =>'#333333',
					'css'		         =>'',
					'title'				 =>'',
					'text_style'		 =>'',

				),$atts));

				$href=$target=$text=$url= $alt_text="";
				if($btn_link !== ''){
					 $href = vc_build_link($btn_link);
					$target =(isset($href['target'])) ? "target='".trim($href['target'])."'" :'';

					$alt_text=$href['title'];
					$url=$href['url'];
					if($url==''){
						$url="javascript:void(0);";
					}
				}
				else{
					$url="javascript:void(0);";
				}

				/*--- design option---*/
				if($title!==''){
					$text=$title;
				}
				else{
					$text=$alt_text;
				}

				$css_class ='';$title_style='';$secondtitle_style=$span_style='';
				$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), "ult_createlink", $atts );
				$css_class = esc_attr( $css_class );

				if($link_hover_style=='Style_2'){
					$span_style = 'background:'.esc_attr($background_color).';';     //background-color
				}

				/*--- hover effect for link-----*/

				$data_link='';
				if($link_hover_style==''){  
					$data_link .='data-textcolor="'.esc_attr($text_color).'"';
					$data_link .='data-texthover="'.esc_attr($text_hovercolor).'"';
				}
				else{
					$data_link .='data-textcolor="'.esc_attr($text_color).'"';
					$data_link .='data-texthover="'.esc_attr($text_hovercolor).'"';
				}

				if($link_hover_style=='Style_2'){
					if($text_hovercolor==''){
						$text_hovercolor=$text_color;
					}
					if($bghovercolor==''){
						$bghovercolor=$background_color;
					}
					if($text_hovercolor=='' && $bghovercolor==''){

						$data_link .='data-bgcolor="'.esc_attr($background_color).'"';
						$data_link .='data-bghover="'.esc_attr($background_color).'"';
						//$data_link .='data-texthover="'.$text_color.'"';
					} else {
						$data_link .='data-bgcolor="'.esc_attr($background_color).'"';
						$data_link .='data-bghover="'.esc_attr($bghovercolor).'"';
					}
					//echo$bghovercolor;
				}
				$data_link .='data-style="'.esc_attr($link_hover_style).'"';

				/*--- border style---*/

				$data_border='';
				if($border_style!=''){
					$data_border .='border-color:'.esc_attr($border_color).';';
					$data_border .='border-width:'.esc_attr($border_size).'px;';
					$data_border .='border-style:'.esc_attr($border_style).';';
				}

				$main_span=$before=$borderhover=$ult_style2css=$ult_style11css='';
				$after='';$style=$class=$id=$colorstyle=$borderstyle=$style11_css_class='';

				/*---- text typography----*/

				if($text_style!=''){
					$colorstyle.='float:'.$text_style.';';
				}


				if (function_exists('get_ultimate_font_family')) {
					$mhfont_family = get_ultimate_font_family($font_family);  		//for font family
					if($mhfont_family!=''){
						$colorstyle .= 'font-family:'.esc_attr($mhfont_family).';';
					}
					//$secondtitle_style .='font-family:'.$mhfont_family.';';
				}
				if (function_exists('get_ultimate_font_style')) {       
					//for font style
					$colorstyle .= get_ultimate_font_style($heading_style);
					//$secondtitle_style .=get_ultimate_font_style($heading_style);
				}
				if($title_font_size!=''){
					$colorstyle .= 'font-size:'.esc_attr($title_font_size).'px;'; 
				}
				//font-size
				$title_style .= 'color:'.esc_attr($text_color).';';//color

				if($link_hover_style!='Style_2'){
					if($title_line_ht!=''){
						$colorstyle .= 'line-height:'.esc_attr($title_line_ht).'px;';	
						//$colorstyle .='color:'.$text_color.';';
					}
						//font-line-height
				} else {
					if($title_line_ht!='') {
						$colorstyle .= 'line-height:'.esc_attr($title_line_ht).'px;';	
					}		//font-line-height
				}

				//$secondtitle_style .= 'font-size:'.$title_font_size.'px;';			//font-size for backend title
				//$secondtitle_style .= 'line-height:'.$title_line_ht.'px;';			
				/*-- hover style---*/
				$id='';
				if($link_hover_style=='Style_1'){               //style1
					$class .='ult_cl_link_1';
					//$id .='ult_cl_link_1';
					$colorstyle .='color:'.esc_attr($text_color).';'; //text color for bracket
					if($title_font_size!=''){
						$colorstyle .='font-size:'.esc_attr($title_font_size).'px;';
					}
				} else if($link_hover_style=='Style_2'){              //style2
					$class .='ult_cl_link_2';
					//$id .='ult_cl_link_2';
				} else if($link_hover_style=='Style_3'){               //style3
					$class .='ult_cl_link_3';
					//$id .='ult_cl_link_3';
					$data_border='';
					$data_border .='border-color:'.esc_attr($border_color).';';
					$data_border .='border-bottom-width:'.esc_attr($border_size).'px;';
					$data_border .='border-style:'.esc_attr($border_style).';';
					if($title_font_size!=''){
						$colorstyle .='font-size:'.esc_attr($title_font_size).'px;';
					}
					$borderstyle .= $data_border; //text color for btm border
					$after .='<span class="ult_link_btm3 " style="'.$borderstyle.'"></span>';

				} else if($link_hover_style=='Style_4'){               //style4
					$class .='ult_cl_link_4';
					//$id .='ult_cl_link_4';
					$data_border='';
					$data_border .='border-color:'.esc_attr($border_color).';';
					$data_border .='border-bottom-width:'.esc_attr($border_size).'px;';
					$data_border .='border-style:'.esc_attr($border_style).';';
					if($title_font_size!=''){
						$colorstyle .='font-size:'.esc_attr($title_font_size).'px;';
					}
					$borderstyle .=$data_border; //text color for btm border
					$after .='<span class="ult_link_btm4 " style="'.$borderstyle.'"></span>';
				} else if($link_hover_style=='Style_6'){               //style6
					$class .='ult_cl_link_6';
					//$id .='ult_cl_link_6';//
					$colorstyle .='color:'.esc_attr($text_hovercolor).';'; 
					if($title_font_size!=''){
						$colorstyle .='font-size:'.esc_attr($title_font_size).'px;';
					}
					$after .='<span class="ult_btn6_link_top " data-color="'.esc_attr($dot_color).'">•</span>';
				} else if($link_hover_style=='Style_5'){               //style5
					$class .='ult_cl_link_5';
					//$id .='ult_cl_link_5';//
					if($title_font_size!=''){
						$colorstyle .='font-size:'.esc_attr($title_font_size).'px;';
					}
					$data_border='';
					$data_border .='border-color:'.esc_attr($border_color).';';
					$data_border .='border-bottom-width:'.esc_attr($border_size).'px;';
					$data_border .='border-style:'.esc_attr($border_style).';';
					$borderstyle .=$data_border; //text color for btm border
					$before='<span class="ult_link_top" style="'.$borderstyle.'"></span>';
					$after .='<span class="ult_link_btm  " style="'.$borderstyle.'"></span>';
				} else if($link_hover_style=='Style_7'){               //style7
					$class .='ult_cl_link_7';
					//$id .='ult_cl_link_7';//
					//$colorstyle .='font-size:'.$title_font_size.'px;';
					$borderstyle .='background:'.esc_attr($border_color).';';
					$borderstyle .='height:'.esc_attr($border_size).'px;';

					$before='<span class="ult_link_top btn7_link_top " style="'.$borderstyle.'"></span>';
					$after .='<span class="ult_link_btm  btn7_link_btm" style="'.$borderstyle.'"></span>';
				} else if($link_hover_style=='Style_8'){               //style8
					$class .='ult_cl_link_8';
					//$id .='ult_cl_link_8';//
					if($title_font_size!=''){
						$colorstyle .='font-size:'.esc_attr($title_font_size).'px;';
					}
					$borderstyle .='outline-color:'.esc_attr($border_color).';';
					$borderstyle .='outline-width:'.esc_attr($border_size).'px;';
					$borderstyle .='outline-style:'.esc_attr($border_style).';'; //text color for btm border

					$borderhover .='outline-color:'.esc_attr($border_hovercolor).';';
					$borderhover .='outline-width:'.esc_attr($border_size).'px;';
					$borderhover .='outline-style:'.esc_attr($border_style).';'; //text color for btm border

					$before='<span class="ult_link_top ult_btn8_link_top " style="'.$borderstyle.'"></span>';
					$after .='<span class="ult_link_btm  ulmt_btn8_link_btm" style="'.$borderhover.'"></span>';
				} else if($link_hover_style=='Style_9'){               //style9
					$class .='ult_cl_link_9';
					//$id .='ult_cl_link_9';//
					if($title_font_size!=''){
						$colorstyle .='font-size:'.esc_attr($title_font_size).'px;';
					}
					//$borderstyle .='background:'.$border_color.';';
					//$borderstyle .='height:'.$border_size.'px;';
					$borderstyle .= 'border-top-width:'.esc_attr($border_size).'px;';
					$borderstyle .= 'border-top-style:'.esc_attr($border_style).';';
					$borderstyle .= 'border-top-color:'.esc_attr($border_color).';';

					//$borderstyle .='height:'; //text color for btm border
					$before='<span class="ult_link_top ult_btn9_link_top " style="'.$borderstyle.'"></span>';
					$after .='<span class="ult_link_btm  ult_btn9_link_btm" style="'.$borderstyle.'"></span>';
				} else if($link_hover_style=='Style_10'){               //style10
					$class .='ult_cl_link_10';
					//$id .='ult_cl_link_10';//
					if($title_font_size!=''){
						$colorstyle .='font-size:'.esc_attr($title_font_size).'px;';
					}
					$borderstyle .='background:'.esc_attr($border_color).';';
					$borderstyle .='height:'.esc_attr($border_size).'px;';
					$span_style .= 'background:'.esc_attr($background_color).';';
					if($border_style!=''){
						$span_style .= 'border-top:'.esc_attr($border_size).'px '.esc_attr($border_style).' '.esc_attr($border_color).';';
					}

					$span_style1='';
					$span_style1 .= 'background:'.esc_attr($bghovercolor).';';
				} else if($link_hover_style=='Style_11'){  
					 //style11
					$style11_css_class='';
					$style11_css_class=$css_class;
					$css_class='';
					$class .='ult_cl_link_11';
					//$id .='ult_cl_link_11';//
					$span_style .='background:'.esc_attr($background_color).';';
					$span_style1='';
					$span_style1 .= 'background:'.esc_attr($bghovercolor).';';
					$span_style1 .= 'color:'.esc_attr($text_hovercolor).';';
					//$span_style1 .= $secondtitle_style;

					//padding 
					$ult_style2css=$css_class;
					$css_class='';
					$domain = strstr($css, 'padding');
					$domain=(explode("}",$domain));
					$ult_style11css=$domain[0];

					$before='<span class="ult_link_top ult_btn11_link_top " style="'.$span_style1.';'.$ult_style11css.'">'.$text.'</span>';
				}
				//echo $bghovercolor;
				//$text=ucfirst($text);
				$text=$text;
				if($link_hover_style=='Style_2'){
					$ult_style2css=$css_class;
					$css_class='';

				}
				$output='';

				if($link_hover_style!='Style_10'){

					$output .='<span class=" ult_main_cl '.esc_attr($el_class).' '.esc_attr($style11_css_class).'" >
						<span class="'.$class.'  ult_crlink" >
							<a  href="'.esc_url($url).'" '.$target.' class="ult_colorlink  '.esc_attr($css_class) .'" style="'.$colorstyle.' "  '.$data_link.' title="'.$alt_text.'">
								'.$before.'
								<span data-hover="'.esc_attr($text).'" style="'.$title_style.';'.$span_style.';'.$ult_style11css.'" class="ult_btn10_span  '.esc_attr($ult_style2css).' ">'.$text.'</span>
								'.$after.'
							</a>
						</span>
					</span>';

				} else if($link_hover_style=='Style_10'){

					$output .='<span class=" ult_main_cl  '.esc_attr($el_class).'" >
						<span class="'.esc_attr($class).'  ult_crlink" id="'.esc_attr($id).'">
							<a  href="'.esc_url($url).'" '.$target.' class="ult_colorlink   "  style="'.$colorstyle.' "  '.$data_link.' title="'.esc_atr($alt_text).'">
								<span   class="ult_btn10_span  '.esc_attr($css_class) .'" style="'.$span_style.'" data-color="'.esc_attr($border_color).'"  data-bhover="'.esc_attr($bghovercolor).'" data-bstyle="'.esc_attr($border_style).'">
									<span class="ult_link_btm  ult_btn10_link_top" style="'.$span_style1.'">
										<span style="'.$title_style.';color:'.esc_attr($text_hovercolor).'" class="style10-span">'.$text.'</span>
									</span>
									<span style="'.$title_style.';">'.$text.'</span>
								</span>

							</a>
						</span>
					</span>';
				}
				if($text!=''){
					return $output;
				}
				//return $output;

			}


			function ultimate_createlink() {
				if(function_exists('vc_map')) {
					vc_map(
						array(
						   'name' => __('Creative Link'),
						   'base' => 'ult_createlink',
						   'icon'=>'creative-link.png',
						   'category' => __('Ultimate VC Addons','dfd'),
						   'description' => __('Add a custom link.','dfd'),
						   'params' => array(							
								// Play with icon selector
								array(
									'type' => 'textfield',
									'class' => '',
									'admin_label' => true,
									'heading' => __('Title', 'dfd'),
									'param_name' => 'title',
									'value' => '',
									//'description' => __('Ran out of options? Need more styles? Write your own CSS and mention the class name here.', 'dfd'),
								),
								array(
									'type' => 'vc_link',
									'class' => '',
									'heading' => __('Link ','dfd'),
									'param_name' => 'btn_link',
									'value' => '',
									'description' => __('Add a custom link or select existing page. You can remove existing link as well.','dfd'),
									//'group' => 'Title Setting',

								),


								/*---typography-------*/

								array(
										'type' => 'ult_param_heading',
										'param_name' => 'bt1typo-setting',
										'text' => __('Typography', 'ultimate'),
										'value' => '',
										'class' => '',
										'group' => 'Typography ',
										'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',

									),

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
								/*-----------general------------*/
								array(
									'type' => 'dropdown',
									'class' => '',
									'admin_label' => true,
									'heading' => __('Link Style', 'dfd'),
									'param_name' => 'link_hover_style',
									'value' => array(
										'None'=> '',
										'Style 1'=> 'Style_1',
										'Style 2' => 'Style_2',
										'Style 3' => 'Style_3',
										'Style 4'=> 'Style_4',
										'Style 5' => 'Style_5',
										'Style 6' => 'Style_6',
										/*'Style 7' => 'Style_7',*/
										'Style 7' => 'Style_8',
										'Style 8' => 'Style_9',
										'Style 9' => 'Style_10',
										'Style 10' => 'Style_11',
									),
									'description' => __('Select the Hover style for Link.','dfd'),

								),
								array(
										'type' => 'ult_param_heading',
										'param_name' => 'button1bg_settng',
										'text' => __('Color Settings', 'dfd'),
										'value' => '',
										'class' => '',
										'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
									),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Link Color', 'dfd'),
									'param_name' => 'text_color',
									'value' => '#333333',
									'description' => __('Select text color for Link.', 'dfd'),	

								),
								/*array(
									'type' => 'chk-switch',
									'class' => '',
									'heading' => __('Hover Effect ', 'dfd'),
									'param_name' => 'enable_hover',
									'value' => '',
									'options' => array(
											'enable' => array(
												'label' => 'Enable Hover effect?',
												'on' => 'Yes',
												'off' => 'No',
											)
										),
									/*'description' => __('Enable Hover effect on hover?', 'dfd'),
								'dependency' => Array('element' => 'link_hover_style','value' => array('Style_2')),
								),*/
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Link Hover Color', 'dfd'),
									'param_name' => 'text_hovercolor',
									'value' => '#333333',
									'description' => __('Select text hover color for Link.', 'dfd'),	
									//'dependency' => Array('element' => 'link_hover_style','not_empty' => true),

								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Link Background Color', 'dfd'),
									'param_name' => 'background_color',
									'value' => '#ffffff',
									'description' => __('Select Background Color for link.', 'dfd'),	
									//'group' => 'Title Setting',
									'dependency' => Array('element' => 'link_hover_style','value' => array('Style_2','Style_10','Style_11')),
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Link Background Hover Color', 'dfd'),
									'param_name' => 'bghovercolor',
									'value' => '',
									'description' => __('Select background hover color for link.', 'dfd'),	
									'dependency' => Array('element' => 'link_hover_style','value' => array('Style_2','Style_10','Style_11')),

								),
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Border Style', 'dfd'),
									'param_name' => 'border_style',
									'value' => array(
										/*'None'=> ' ',*/
										'Solid'=> 'solid',
										'Dashed' => 'dashed',
										'Dotted' => 'dotted',
										'Double' => 'double',
										'Inset' => 'inset',
										'Outset' => 'outset',

									),
									'description' => __('Select the border style for link.','dfd'),
									'dependency' => Array('element' => 'link_hover_style','value' => array('Style_3','Style_4','Style_5','Style_7','Style_8','Style_9','Style_10')),

								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Link Border Color', 'dfd'),
									'param_name' => 'border_color',
									'value' => '#333333',
									'description' => __('Select border color for link.', 'dfd'),	
									//'dependency' => Array('element' => 'border_style', 'not_empty' => true),
									'dependency' => Array('element' => 'border_style', 'value' => array('solid','dashed','dotted','double','inset','outset')),

								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Link Border HoverColor', 'dfd'),
									'param_name' => 'border_hovercolor',
									'value' => '#333333',
									'description' => __('Select border hover color for link.', 'dfd'),	
									'dependency' => Array(
										'element'=>'link_hover_style','value' => array('Style_8'),
										/*'element' => 'border_style',  'not_empty' => true*/ ),

								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Link Border Width', 'dfd'),
									'param_name' => 'border_size',
									'value' => 1,
									'min' => 1,
									'max' => 10,
									'suffix' => 'px',
									'description' => __('Thickness of the border.', 'dfd'),
									//'dependency' => Array('element' => 'border_style', 'not_empty' => true),	
									'dependency' => Array('element' => 'border_style', 'value' => array('solid','dashed','dotted','double','inset','outset')),

								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Link Dot Color', 'dfd'),
									'param_name' => 'dot_color',
									'value' => '#333333',
									'description' => __('Select color for dots.', 'dfd'),	
									'dependency' => Array('element'=>'link_hover_style','value' => array('Style_6')),
								),
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Link Alignment', 'dfd'),
									'param_name' => 'text_style',
									'value' => array(
										'Center'=> ' ',
										'Left'=> 'left',
										'Right' => 'right',

									),
									'description' => __('Select the text align for link.','dfd'),
									//'group' => 'Typography ',
								),
								array(
									'type' => 'textfield',
									'class' => '',
									'heading' => __('Custom CSS Class', 'dfd'),
									'param_name' => 'el_class',
									'value' => '',
									'description' => __('Ran out of options? Need more styles? Write your own CSS and mention the class name here.', 'dfd'),
								),
								array(
									'type' => 'css_editor',
									'heading' => __( 'Css', 'dfd' ),
									'param_name' => 'css',
									'group' => __( 'Design ', 'dfd' ),
									'edit_field_class' => 'vc_col-sm-12 vc_column no-vc-background no-vc-border creative_link_css_editor',
								),
							),
						)
					);
				}
			}

		}
	}
	if(class_exists('AIO_creative_link')) {
		$AIO_creative_link = new AIO_creative_link;
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_ult_createlink extends WPBakeryShortCode {
		}
	}
}