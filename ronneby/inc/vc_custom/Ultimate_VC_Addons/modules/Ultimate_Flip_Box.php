<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Flip Box for Visual Composer
* Add-on URI: http://dev.brainstormforce.com
*/
global $dfd_ronneby;
if(isset($dfd_ronneby['enable_default_addons']) && strcmp($dfd_ronneby['enable_default_addons'], '1') === 0) {
	if(!class_exists('AIO_Flip_Box')) {
		class AIO_Flip_Box {
			function __construct()
			{
				add_action('init',array($this,'block_init'));
				add_shortcode('icon_counter',array($this,'block_shortcode'));
				add_action( 'wp_enqueue_scripts', array( $this, 'flip_box_scripts' ), 1 );
			}
			function block_init()
			{
				if(function_exists('vc_map'))
				{
					vc_map(
						array(
						   'name' => __('Flip Box','dfd'),
						   'base' => 'icon_counter',
						   'class' => 'vc_flip_box',
						   'icon' => 'vc_icon_block',
						   'category' => 'Ultimate VC Addons',
						   'description' => __('Icon, some info & CTA. Flips on hover.','dfd'),
						   'params' => array(
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Flip Type ','dfd'),
									'param_name' => 'flip_type',
									'value' => array(
										__('Flip Horizontally From Left','dfd') => 'horizontal_flip_left',
										__('Flip Horizontally From Right','dfd') => 'horizontal_flip_right',
										__('Flip Vertically From Top','dfd') => 'vertical_flip_top',
										__('Flip Vertically From Bottom','dfd') => 'vertical_flip_bottom',
										__('Vertical Door Flip','dfd') => 'vertical_door_flip',
										__('Reverse Vertical Door Flip','dfd') => 'reverse_vertical_door_flip',
										__('Horizontal Door Flip','dfd') => 'horizontal_door_flip',
										__('Reverse Horizontal Door Flip','dfd') => 'reverse_horizontal_door_flip',
										__('Book Flip (Beta)','dfd') => 'style_9',
										__('Flip From Left (Beta)','dfd') => 'flip_left',
										__('Flip From Right (Beta)','dfd') => 'flip_right',
										__('Flip From Top (Beta)','dfd') => 'flip_top',
										__('Flip From Bottom (Beta)','dfd') => 'flip_bottom',
									),
									'description' => __('Select Flip type for this flip box.','dfd')
								),
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Flip Box Style', 'dfd'),
									'param_name' => 'flip_box_style',
									'value' => array(
										'Simple' => 'simple',
										'Advanced' => 'advanced',
									),
									'description' => __('Select the border style for icon.','dfd'),
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Size of Box Border', 'dfd'),
									'param_name' => 'border_size',
									'value' => 2,
									'min' => 1,
									'max' => 10,
									'suffix' => 'px',
									'description' => __('Enter value in pixels.', 'dfd'),
									'dependency' => Array('element' => 'flip_box_style', 'value' => array('simple')),
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Border Color', 'dfd'),
									'param_name' => 'border_color',
									'value' => '#A4A4A4',
									'description' => __('Select the color for border on front.', 'dfd'),
									'dependency' => Array('element' => 'flip_box_style', 'value' => array('simple')),
								),
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Box Border Style', 'dfd'),
									'param_name' => 'box_border_style',
									'value' => array(
										'None'=> 'none',
										'Solid'=> 'solid',
										'Dashed' => 'dashed',
										'Dotted' => 'dotted',
										'Double' => 'double',
										'Inset' => 'inset',
										'Outset' => 'outset',
									),
									'description' => __('Select the border style for box.','dfd'),
									'dependency' => Array('element' => 'flip_box_style', 'value' => array('advanced')),
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Size of Box Border', 'dfd'),
									'param_name' => 'box_border_size',
									'value' => 2,
									'min' => 1,
									'max' => 10,
									'suffix' => 'px',
									'description' => __('Enter value in pixels.', 'dfd'),
									'dependency' => Array('element' => 'box_border_style', 'value' => array('solid','dashed','dotted','double','inset','outset')),
								),
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Icon to display:', 'dfd'),
									'param_name' => 'icon_type',
									'value' => array(
										__('Font Icon Manager','dfd') => 'selector',
										__('Custom Image Icon','dfd') => 'custom',
									),
									'description' => __('Use an existing font icon or upload a custom image.', 'dfd'),
									'group' => 'Icon'
								),
								array(
									'type' => 'icon_manager',
									'class' => '',
									'heading' => __('Select Icon ','dfd'),
									'param_name' => 'icon',
									'value' => '',
									'description' => __('Click and select icon of your choice. If you can\'t find the one that suits for your purpose, you can','dfd').' <a href="admin.php?page=font-icon-Manager" target="_blank">'.__('add new here','dfd').'</a>.',
									'dependency' => Array('element' => 'icon_type','value' => array('selector')),
									'group' => 'Icon'
								),
								array(
									'type' => 'ult_img_single',
									'class' => '',
									'heading' => __('Upload Image Icon:', 'dfd'),
									'param_name' => 'icon_img',
									'value' => '',
									'description' => __('Upload the custom image icon.', 'dfd'),
									'dependency' => Array('element' => 'icon_type','value' => array('custom')),
									'group' => 'Icon'
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Image Width', 'dfd'),
									'param_name' => 'img_width',
									'value' => 48,
									'min' => 16,
									'max' => 512,
									'suffix' => 'px',
									'description' => __('Provide image width', 'dfd'),
									'dependency' => Array('element' => 'icon_type','value' => array('custom')),
									'group' => 'Icon'
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Size of Icon', 'smile'),
									'param_name' => 'icon_size',
									'value' => 32,
									'min' => 12,
									'max' => 72,
									'suffix' => 'px',
									'description' => __('How big would you like it?', 'dfd'),
									'dependency' => Array('element' => 'icon_type','value' => array('selector')),
									'group' => 'Icon'
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Color', 'dfd'),
									'param_name' => 'icon_color',
									'value' => '#333333',
									'description' => __('Give it a nice paint!', 'dfd'),
									'dependency' => Array('element' => 'icon_type','value' => array('selector')),
									'group' => 'Icon'				
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
									'dependency' => Array('element' => 'icon_type','value' => array('selector')),
									'group' => 'Icon'
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Background Color', 'dfd'),
									'param_name' => 'icon_color_bg',
									'value' => '#ffffff',
									'description' => __('Select background color for icon.', 'dfd'),	
									'dependency' => Array('element' => 'icon_style', 'value' => array('circle','square','advanced')),
									'group' => 'Icon'
								),
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Icon Border Style', 'dfd'),
									'param_name' => 'icon_border_style',
									'value' => array(
										__('Solid','dfd') => 'solid',
										__('Dashed','dfd') => 'dashed',
										__('Dotted','dfd') => 'dotted',
										__('Double','dfd') => 'double',
										__('Inset','dfd') => 'inset',
										__('Outset','dfd') => 'outset',
									),
									'description' => __('Select the border style for icon.','dfd'),
									'dependency' => Array('element' => 'icon_style', 'value' => array('advanced')),
									'group' => 'Icon'
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Border Color', 'dfd'),
									'param_name' => 'icon_color_border',
									'value' => '#333333',
									'description' => __('Select border color for icon.', 'dfd'),	
									'dependency' => Array('element' => 'icon_border_style', 'not_empty' => true),
									'group' => 'Icon'
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
									'group' => 'Icon'
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Border Radius', 'dfd'),
									'param_name' => 'icon_border_radius',
									'value' => 500,
									'min' => 1,
									'max' => 500,
									'suffix' => 'px',
									'description' => __('0 pixel value will create a square border. As you increase the value, the shape convert in circle slowly. (e.g 500 pixels).', 'dfd'),
									'dependency' => Array('element' => 'icon_border_style', 'not_empty' => true),
									'group' => 'Icon'
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Background Size', 'smile'),
									'param_name' => 'icon_border_spacing',
									'value' => 50,
									'min' => 30,
									'max' => 500,
									'suffix' => 'px',
									'description' => __('Spacing from center of the icon till the boundary of border / background', 'dfd'),
									'dependency' => Array('element' => 'icon_style', 'value' => array('advanced')),
									'group' => 'Icon'
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Text Color', 'dfd'),
									'param_name' => 'text_color',
									'value' => '#333333',
									'description' => __('Color of title & description text.', 'dfd'),	
									'dependency' => Array('element' => 'flip_box_style', 'value' => array('simple')),
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Background Color', 'dfd'),
									'param_name' => 'bg_color',
									'value' => '#efefef',
									'description' => __('Light colors look better for background.', 'dfd'),
									'dependency' => Array('element' => 'flip_box_style', 'value' => array('simple')),
								),
								array(
									 'type' => 'textfield',
									 'class' => '',
									 'heading' => __('Title on Front','dfd'),
									 'param_name' => 'block_title_front',
									 'admin_label' => true,
									 'value' => '',
									 'description' => __('Perhaps, this is the most highlighted text.','dfd'),
									 'group' => 'Front'
								),						  
								array(
									 'type' => 'textarea',
									 'class' => '',
									 'heading' => __('Description on Front ','dfd'),
									 'param_name' => 'block_desc_front',
									 'value' => '',
									 'description' => __('Keep it short and simple!','dfd'),
									 'group' => 'Front'
								),

								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Text Color', 'dfd'),
									'param_name' => 'block_text_color',
									'value' => '#333333',
									'description' => __('Color of front side title & description text.', 'dfd'),	
									'dependency' => Array('element' => 'flip_box_style', 'value' => array('advanced')),
									'group' => 'Front'					
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Background Color', 'dfd'),
									'param_name' => 'block_front_color',
									'value' => '#efefef',
									'description' => __('Light colors look better on front.', 'dfd'),
									'dependency' => Array('element' => 'flip_box_style', 'value' => array('advanced')),
									'group' => 'Front'						
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Border Color', 'dfd'),
									'param_name' => 'box_border_color',
									'value' => '#A4A4A4',
									'description' => __('Select the color for border on front.', 'dfd'),
									'dependency' => Array('element' => 'box_border_style', 'value' => array('solid','dashed','dotted','double','inset','outset')),
									'group' => 'Front'
								),
								array(
									 'type' => 'textfield',
									 'class' => '',
									 'heading' => __('Title on Back ','dfd'),
									 'param_name' => 'block_title_back',
									 'admin_label' => true,
									 'value' => '',
									 'description' => __('Some nice heading for the back side of the flip.','dfd'),
									 'group' => 'Back'
								),
								array(
									 'type' => 'textarea',
									 'class' => '',
									 'heading' => __('Description on Back','dfd'),
									 'param_name' => 'block_desc_back',
									 'value' => '',
									 'description' => __('Text here will be followed by a button. So make it catchy!','dfd'),
									 'group' => 'Back'
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Text Color', 'dfd'),
									'param_name' => 'block_back_text_color',
									'value' => '#333333',
									'description' => __('Color of back side title & description text.', 'dfd'),
									'dependency' => Array('element' => 'flip_box_style', 'value' => array('advanced')),
									'group' => 'Back'
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Background Color', 'dfd'),
									'param_name' => 'block_back_color',
									'value' => '#efefef',
									'description' => __('Select the background color for back .', 'dfd'),
									'dependency' => Array('element' => 'flip_box_style', 'value' => array('advanced')),			
									'group' => 'Back'	
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Border Color', 'dfd'),
									'param_name' => 'box_border_color_back',
									'value' => '#A4A4A4',
									'description' => __('Select the color for border on back.', 'dfd'),
									'dependency' => Array('element' => 'box_border_style', 'value' => array('solid','dashed','dotted','double','inset','outset')),
									'group' => 'Back'
								),
								array(
									 'type' => 'dropdown',
									 'class' => '',
									 'heading' => __('Link','dfd'),
									 'param_name' => 'custom_link',
									 'value' => array(
											__('No Link','dfd') => '',
											__('Add custom link with button','dfd') => '1',
										),
									 'description' => __('You can add / remove custom link','dfd')
								),
								array(
									 'type' => 'vc_link',
									 'class' => '',
									 'heading' => __('Link ','dfd'),
									 'param_name' => 'button_link',
									 'value' => '',
									 'description' => __('You can link or remove the existing link on the button from here.','dfd'),
									 'dependency' => Array('element' => 'custom_link', 'not_empty' => true, 'value' => array('1')),
								),
								array(
									'type' => 'textfield',
									'class' => '',
									'heading' => __('Button Text','dfd'),
									'param_name' => 'button_text',
									'value' => '',
									'description' => __('The \'call to action\' text','dfd'),
									'dependency' => Array('element' => 'custom_link', 'not_empty' => true, 'value' => array('1')),
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Button background color', 'dfd'),
									'param_name' => 'button_bg',
									'value' => '#333333',
									'description' => __('Color of the button. Make sure it\'ll match with Back Side Box Color.', 'dfd'),
									'dependency' => Array('element' => 'custom_link', 'not_empty' => true, 'value' => array('1')),
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Button Text Color', 'dfd'),
									'param_name' => 'button_txt',
									'value' => '#FFFFFF',
									'description' => __('Select the color for button text.', 'dfd'),
									'dependency' => Array('element' => 'custom_link', 'not_empty' => true, 'value' => array('1')),
								),
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Set Box Height','dfd'),
									'param_name' => 'height_type',
									'value' => array(
										__('Display full the content and adjust height of box accordingly','dfd')=>'ifb-jq-height',
										__('Hide extra content that doesn\'t fit in height of the box','dfd') => 'ifb-auto-height',								
										__('Give a custom height of your choice to the box','dfd') => 'ifb-custom-height',								
									),
									'description' => __('Select height option for this box.','dfd')
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Box Height', 'dfd'),
									'param_name' => 'box_height',
									'value' => 300,
									'min' => 200,
									'max' => 1200,
									'suffix' => 'px',
									'description' => __('Provide box height', 'dfd'),
									'dependency' => Array('element' => 'height_type','value' => array('ifb-custom-height')),
								),
								array(
										'type' => 'ult_switch',
										'class' => '',
										//'heading' => __('Want To show button in responsive mode', 'dfd'),
										'param_name' => 'cont_align',
										'value' => 'off',
										'default_set' => true,
										'options' => array(
											'on' => array(
												'label' => __('Display Content Vertically Center ?','dfd'),
												'on' => __('Yes','dfd'),
												'off' => __('No','dfd'),
											  ),
										  ),
										/*'description' => __('', 'smile'),*/
										//'description' => __('Display Content Vertically Center ', 'dfd'),
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
									'param_name' => 'ult_param_heading',
									'heading' => __('Title settings','dfd'),
									'value' => '',
									'class' => 'ult-param-heading',
									'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
									'group' => 'Typography'
								),
								array(
									'type' => 'ultimate_google_fonts',
									'heading' => __('Font Family','dfd'),
									'param_name' => 'title_font',
									'value' => '',
									'group' => 'Typography'
								),
								array(
									'type' => 'ultimate_google_fonts_style',
									'heading' => __('Font Style','dfd'),
									'param_name' => 'title_font_style',
									'value' => '',
									'group' => 'Typography'
								),
								array(
									'type' => 'number',
									'param_name' => 'title_font_size',
									'heading' => __('Font size','dfd'),
									'value' => '',
									'suffix' => 'px',
									'min' => 10,
									'group' => 'Typography'
								),
								array(
									'type' => 'number',
									'param_name' => 'title_font_line_height',
									'heading' => __('Font Line Height','dfd'),
									'value' => '',
									'suffix' => 'px',
									'min' => 10,
									'group' => 'Typography'
								),
								array(
									'type' => 'ult_param_heading',
									'param_name' => 'desc_text_typography',
									'heading' => __('Description settings','dfd'),
									'value' => '',
									'class' => 'ult-param-heading',
									'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
									'group' => 'Typography'
								),
								array(
									'type' => 'ultimate_google_fonts',
									'heading' => __('Font Family','dfd'),
									'param_name' => 'desc_font',
									'value' => '',
									'group' => 'Typography'
								),
								array(
									'type' => 'ultimate_google_fonts_style',
									'heading' => __('Font Style','dfd'),
									'param_name' => 'desc_font_style',
									'value' => '',
									'group' => 'Typography'
								),
								array(
									'type' => 'number',
									'param_name' => 'desc_font_size',
									'heading' => __('Font size','dfd'),
									'value' => '',
									'suffix' => 'px',
									'min' => 10,
									'group' => 'Typography'
								),
								array(
									'type' => 'number',
									'param_name' => 'desc_font_line_height',
									'heading' => __('Font Line Height','dfd'),
									'value' => '',
									'suffix' => 'px',
									'min' => 10,
									'group' => 'Typography'
								),
							),
						)
					);
				}
			}
			// Shortcode handler function for  icon block
			function block_shortcode($atts)
			{
				$icon_type = $icon_img = $img_width = $icon = $icon_color = $icon_color_bg = $icon_size = $icon_style = $icon_border_style = $icon_border_radius = $icon_color_border = $icon_border_size = $icon_border_spacing = $icon_link = $el_class = $icon_animation = $block_title_front = $block_desc_front = $block_title_back = $block_desc_back = $button_text = $button_link = $block_text_color = $block_front_color = $block_back_color = $block_back_text_color = $animation = $font_size_icon = $box_border_style = $box_border_size = $box_border_color = $border_size = $border_color = $box_border_color_back = $custom_link = $button_bg = $button_txt = $height_type = $box_height = $flip_type = $flip_box_style = $text_color = $bg_color = $front_text = $back_text = $box_border_color_advanced = '';
				$desc_font_line_height = $title_font_line_height = $title_font=$title_font_style=$title_font_size=$desc_font = $desc_font_style = $desc_font_size = '';
				extract(shortcode_atts( array(
					'icon_type' => 'selector',
					'icon' => '',
					'icon_img' => '',
					'img_width' => '48',
					'icon_size' => '32',				
					'icon_color' => '#333333',
					'icon_style' => 'none',
					'icon_color_bg' => '#ffffff',
					'icon_color_border' => '#333333',			
					'icon_border_style' => 'solid',
					'icon_border_size' => '1',
					'icon_border_radius' => '500',
					'icon_border_spacing' => '50',
					'icon_link' => '',
					'icon_animation' => '',
					'block_title_front' => '',
					'block_desc_front' => '',
					'block_title_back' => '',
					'block_desc_back' =>'',
					'custom_link' => '',
					'button_text' =>'',
					'button_link' =>'',
					'button_bg' => '#333333',
					'button_txt' => '#FFFFFF',
					'flip_type' =>'horizontal_flip_left',
					'text_color' => '#333333',
					'bg_color' => '#efefef',
					'block_text_color' =>'#333333',
					'block_front_color' =>'#efefef',
					'block_back_color' =>'#efefef',
					'el_class' =>'',
					'block_back_text_color' =>'#333333',
					'border_size' => '2', 
					'border_color' => '#A4A4A4', 
					'box_border_style' => 'none', 
					'box_border_size' => '2', 
					'box_border_color' => '#A4A4A4', 
					'box_border_color_back' => '#A4A4A4',
					'height_type' => 'ifb-jq-height',
					'box_height' => '300',
					'flip_box_style' => 'simple',
					'title_font' => '',
					'title_font_style' => '',
					'title_font_size' => '',
					'title_font_line_height'=> '',
					'desc_font' => '',
					'desc_font_style' => '',
					'desc_font_size' => '',
					'desc_font_line_height'=> '',
					'cont_align'=>'',

				),$atts));	
				$output = $f_style = $b_style = $ico_color = $box_border = $icon_border = $link_style = $height = $link_sufix = $link_prefix = $link_style = '';
				$title_style = $desc_style = '';
				$border_front = $border_back = '';
				//$font_args = array();
				if($icon_type == 'custom'){
					$icon_style = 'none';
				}
				$flip_icon = do_shortcode('[just_icon icon_type="'.$icon_type.'" icon="'.$icon.'" icon_img="'.$icon_img.'" img_width="'.$img_width.'" icon_size="'.$icon_size.'" icon_color="'.$icon_color.'" icon_style="'.$icon_style.'" icon_color_bg="'.$icon_color_bg.'" icon_color_border="'.$icon_color_border.'"  icon_border_style="'.$icon_border_style.'" icon_border_size="'.$icon_border_size.'" icon_border_radius="'.$icon_border_radius.'" icon_border_spacing="'.$icon_border_spacing.'" icon_link="'.$icon_link.'" icon_animation="'.$icon_animation.'"]');
				$css_trans = $icon_border = $box_border = '';
				$height = $target = '';

				/* title */
				if($title_font != '')
				{
					$font_family = get_ultimate_font_family($title_font);
					$title_style .= 'font-family:\''.esc_attr($font_family).'\';';
					//array_push($font_args, $title_font);
				}
				if($title_font_style != '') {
					$title_style .= get_ultimate_font_style($title_font_style);
				}
				if($title_font_size != '') {
					$title_style .= 'font-size:'.esc_attr($title_font_size).'px;';
				}
				if($title_font_line_height != '') {
					$title_style .= 'line-height:'.esc_attr($title_font_line_height).'px;';
				}

				/* description */
				if($desc_font != '') {
					$font_family = get_ultimate_font_family($desc_font);
					$desc_style .= 'font-family:\''.esc_attr($font_family).'\';';
					//array_push($font_args, $desc_font);
				}
				if($desc_font_style != '') {
					$desc_style .= get_ultimate_font_style($desc_font_style);
				}
				if($desc_font_size != '') {
					$desc_style .= 'font-size:'.esc_attr($desc_font_size).'px;';
				}
				if($desc_font_line_height != '') {
					$desc_style .= 'line-height:'.esc_attr($desc_font_line_height).'px;';
				}
				//enquque_ultimate_google_fonts($font_args);

				if($icon_border_style !== 'none') {
					$icon_border .= 'border-style: '.esc_attr($icon_border_style).';';
					$icon_border .= 'border-width: '.esc_attr($icon_border_size).'px;';
				}
				$box_style_data = '';
				if($height_type == "ifb-custom-height"){
					$box_style_data .= " data-min-height='".esc_attr($box_height)."px'";
					/*$height = 'height:'.$box_height.'px;';*/
					$flip_type .= ' flip-box-custom-height';
				}
				if($flip_box_style !== 'simple'){
					$border_front =  'border-color:'.esc_attr($box_border_color).';';
					$border_back =  'border-color:'.esc_attr($box_border_color_back).';';
					if($box_border_style !== 'none') {
						$box_border .= 'border-style: '.esc_attr($box_border_style).';';
						$box_border .= 'border-width: '.esc_attr($box_border_size).'px;';
					}
					if($animation !== 'none') {
						$css_trans = 'data-animation="'.esc_attr($animation).'" data-animation-delay="03"';
					}
					if($block_text_color != ''){
						$f_style .='color:'.esc_attr($block_text_color).';';
						$front_text .= 'color:'.esc_attr($block_text_color).';';
						//$desc_style .= 'color:'.$block_text_color.';';
					}
					if($block_front_color != '') {
						$f_style .= 'background:'.esc_attr($block_front_color).';';
					}
					if($block_back_text_color != ''){
						$b_style .='color:'.esc_attr($block_back_text_color).';';
						$back_text .='color:'.esc_attr($block_back_text_color).';';
					}
					if($block_back_color != '') {
						$b_style .= 'background:'.esc_attr($block_back_color).';';
					}
				} else {
					if($text_color != ''){
						$f_style .='color:'.esc_attr($text_color).';';
						$b_style .='color:'.esc_attr($text_color).';';
						$front_text = $back_text = 'color:'.esc_attr($text_color).';';
						$desc_style .= 'color:'.esc_attr($block_text_color).';';
					}
					if($bg_color != '') {
						$f_style .= 'background:'.esc_attr($bg_color).';';
						$b_style .= 'background:'.esc_attr($bg_color).';';
					}
					if($border_color != '') {
						$border_front =  'border-color:'.esc_attr($border_color).';';
						$border_back =  'border-color:'.esc_attr($border_color).';';
						$box_border = 'border-width: '.esc_attr($border_size).'px;';
						$box_border .= 'border-style: solid;';
					}
				}


				if($cont_align=='') {
					$cont_align='off';
				}
				$verticalcont='';
				if($cont_align=='on'){
					$verticalcont.='ifb-flip-box-section-vertical-middle';
				}

				$output .= '<div class="flip-box-wrap">';
				$output .= '<div class="flip-box '.esc_attr($height_type).' '.esc_attr($el_class).' '. esc_attr($flip_type) .' flip-'.esc_attr($height_type).'" '.$css_trans.' style="'.$height.'" '.$box_style_data.'>';
				$output .= '<div class="ifb-flip-box">';
					$output .= '<div class="ifb-face ifb-front" style="'.$f_style.' '.$box_border.' '.$border_front.'">
								<div class="ifb-flip-box-section '.esc_attr($verticalcont).'">
								';
							if($icon !== '' || $icon_img !== '') {
								$output.='<div class="flip-box-icon">'.$flip_icon.'</div>';
							}
							if($block_title_front!='') {
								$output.='<h3 style="'.$front_text.' '.$title_style.'">'.$block_title_front.'</h3>';
							}
							if($block_desc_front!='') {
								$output.='<div class="ifb-flip-box-section-content" style="'.$desc_style.$front_text.'"><p>'.$block_desc_front.'</p></div>';
							}
						$output.='</div></div><!-- END .front -->
							<div class="ifb-face ifb-back" style="'.$b_style.' '.$box_border.' '.$border_back.'">
								<div class="ifb-flip-box-section '.esc_attr($verticalcont).'">';
								if($block_title_back!='') {
									$output.='<h3 style="'.$back_text.' '.$title_style.'">'.$block_title_back.'</h3>';
								}

								if($block_desc_back!=''){
									if($button_link !== ''){
										$output .= '<div class="ifb-desc-back">';
									}
									$output.='<div class="ifb-flip-box-section-content" style="'.$desc_style.$back_text.'"><p>'.$block_desc_back.'</p></div>';
									if($button_link !== ''){
										$output .= '</div>';
									}
								}
								if($button_text!== '' && $custom_link){
									$link_prefix = '<div class="flip_link">';
									if($button_bg !== '' && $button_txt !== '') {
										$link_style = 'style="background:'.$button_bg.'; color:'.$button_txt.';"';
									}
									if($button_link!== ''){								
										$href = vc_build_link($button_link);
										if(isset($href['target']) && $href['target'] != ''){
											$target = 'target="'.esc_attr($href['target']).'"';
										}
										$link_prefix .= '<a href = "'.esc_url($href['url']).'" '.$target.' '.$link_style.'>';
										$link_sufix .= '</a>';
									}
									$link_sufix .= '</div>';
									$output.=$link_prefix.$button_text.$link_sufix;
								}
							$output.='</div></div><!-- END .back -->';
						$output .= '</div> <!-- ifb-flip-box -->';
					$output .= '</div> <!-- flip-box -->';
				$output .='</div><!-- End icon block -->';
				return $output;		
			}
			function flip_box_scripts() {
				wp_register_script('flip_box_js', get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-js/flip-box.min.js' , array('jquery'), null, true);
				wp_register_style('ult-flip-style', get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-css/flip-box.min.css', array(), null, false);
			}
		}
		//instantiate the class
		new AIO_Flip_Box;
		if(class_exists('WPBakeryShortCode')) {
			class WPBakeryShortCode_icon_counter extends WPBakeryShortCode {
			}
		}
	}
}
