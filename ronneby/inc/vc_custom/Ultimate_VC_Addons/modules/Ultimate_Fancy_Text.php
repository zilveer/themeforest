<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Ultimate Fancy Text
* Add-on URI: http://dev.brainstormforce.com
*/
if(!class_exists('Ultimate_FancyText')){
	class Ultimate_FancyText{
		
		function __construct(){
			add_action('init',array($this,'ultimate_fancytext_init'));
			add_shortcode('ultimate_fancytext',array($this,'ultimate_fancytext_shortcode'));
			add_action('wp_enqueue_scripts', array($this, 'register_fancytext_assets'));
		}
		function register_fancytext_assets()
		{
			wp_register_style('ultimate-fancytext-style',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-css/fancytext.min.css',array(),null);
			wp_register_script('ultimate-typed-js',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-js/typed.min.js',array('jquery'),null);
			wp_register_script('ultimate-vticker-js',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-js/vticker.min.js',array('jquery'),null);
		}

		function ultimate_fancytext_init(){
			if(function_exists("vc_map")){
				vc_map(
					array(
					   "name" => __("Fancy Text",'dfd'),
					   "base" => "ultimate_fancytext",
					   "class" => "vc_ultimate_fancytext",
					   "icon" => "vc_ultimate_fancytext",
					   "category" => __('Ronneby 1.0','dfd'),
					   "description" => __("Fancy lines with animation effects.",'dfd'),
					   "params" => array(
					   		array(
								"type" => "textfield",
								"param_name" => "fancytext_prefix",
								"heading" => __("Prefix",'dfd'),
								"value" => "",
							),
							array(
								'type' => 'textarea',
								'heading' => __( 'Fancy Text', 'dfd' ),
								'param_name' => 'fancytext_strings',
								'description' => __('Enter each string on a new line','dfd'),
								'admin_label' => true
							),
							array(
								"type" => "textfield",
								"param_name" => "fancytext_suffix",
								"heading" => __("Suffix",'dfd'),
								"value" => "",
							),
							array(
								"type" => "dropdown",
								"heading" => __("Effect", 'dfd'),
								"param_name" => 'fancytext_effect',
								"value" => array(
									__("Type", 'dfd') => "typewriter",
									__("Slide Up", 'dfd') => "ticker",
									__("Slide Down", 'dfd') => "ticker-down"
								),
							),
							array(
								"type" => "dropdown",
								"heading" => __("Alignment", 'dfd'),
								"param_name" => "fancytext_align",
								"value" => array(
									__("Center",'dfd') => "center",
									__("Left",'dfd') => "left",
									__("Right",'dfd') => "right"
								)
							),
							array(
								"type" => "number",
								"heading" => __("Type Speed", 'dfd'),
								"param_name" => "strings_textspeed",
								"min" => 0,
								"value" => 35,
								"suffix" => __("In Miliseconds",'dfd'),
								"group" => "Advanced Settings",
								"dependency" => array("element" => "fancytext_effect", "value" => array("typewriter")),
								"description" => __("Speed at which line progresses / Speed of typing effect.", 'dfd')
							),
							array(
								"type" => "number",
								"heading" => __("Backspeed", 'dfd'),
								"param_name" => "strings_backspeed",
								"min" => 0,
								"value" => 0,
								"suffix" => __("In Miliseconds",'dfd'),
								"group" => "Advanced Settings",
								"dependency" => array("element" => "fancytext_effect", "value" => array("typewriter")),
								"description" => __("Speed of delete / backspace effect.", 'dfd')
							),

							array(
								"type" => "number",
								"heading" => __("Start Delay", 'dfd'),
								"param_name" => "strings_startdelay",
								"min" => 0,
								"value" => 200,
								"suffix" => __("In Miliseconds",'dfd'),
								"group" => "Advanced Settings",
								"dependency" => array("element" => "fancytext_effect", "value" => array("typewriter")),
								"description" => __("Example - If set to 5000, the first string will appear after 5 seconds.", 'dfd')
							),
							
							array(
								"type" => "number",
								"heading" => __("Back Delay", 'dfd'),
								"param_name" => "strings_backdelay",
								"min" => 0,
								"value" => 1500,
								"suffix" => __("In Miliseconds",'dfd'),
								"group" => "Advanced Settings",
								"dependency" => array("element" => "fancytext_effect", "value" => array("typewriter")),
								"description" => __("Example - If set to 5000, the string will remain visible for 5 seconds before backspace effect.",'dfd')
							),
							array(
								"type" => "ult_switch",
								"heading" => __("Enable Loop", 'dfd'),
								"param_name" => "typewriter_loop",
								"value" => "true",
								"default_set" => true,
								"options" => array(
									"true" => array(
										"label" => "",
										"on" => "Yes",
										"off" => "No"
									)
								),
								"group" => "Advanced Settings",
								"dependency" => array("element" => "fancytext_effect", "value" => array("typewriter"))
							),
							array(
								"type" => "ult_switch",
								"heading" => __("Show Cursor", 'dfd'),
								"param_name" => "typewriter_cursor",
								"value" => "true",
								"default_set" => true,
								"options" => array(
									"true" => array(
										"label" => "",
										"on" => "Yes",
										"off" => "No",
									)
								),
								"group" => "Advanced Settings",
								"dependency" => array("element" => "fancytext_effect", "value" => array("typewriter"))
							),
							array(
								"type" => "textfield",
								"heading" => __("Cursor Text",'dfd'),
								"param_name" => "typewriter_cursor_text",
								"value" => "|",
								"group" => "Advanced Settings",
								"dependency" => array("element" => "typewriter_cursor", "value" => array("true"))
							),
							array(
								"type" => "number",
								"heading" => __("Animation Speed", 'dfd'),
								"param_name" => "strings_tickerspeed",
								"min" => 0,
								"value" => 200,
								"suffix" => __("In Miliseconds",'dfd'),
								"group" => "Advanced Settings",
								"dependency" => array("element" => "fancytext_effect", "value" => array("ticker","ticker-down")),
								"description" => __("Duration of 'Slide Up' animation", 'dfd')
							),
							array(
								"type" => "number",
								"heading" => __("Pause Time", 'dfd'),
								"param_name" => "ticker_wait_time",
								"min" => 0,
								"value" => "3000",
								"suffix" => __("In Miliseconds",'dfd'),
								"group" => "Advanced Settings",
								"dependency" => array("element" => "fancytext_effect", "value" => array("ticker","ticker-down")),
								"description" => __("How long the string should stay visible?",'dfd')
							),
							array(
								"type" => "number",
								"heading" => __("Show Items", 'dfd'),
								"param_name" => "ticker_show_items",
								"min" => 1,
								"value" => 1,
								"group" => "Advanced Settings",
								"dependency" => array("element" => "fancytext_effect", "value" => array("ticker","ticker-down")),
								"description" => __("How many items should be visible at a time?", 'dfd')
							),
							array(
								"type" => "ult_switch",
								"heading" => __("Pause on Hover",'dfd'),
								"param_name" => "ticker_hover_pause",
								"value" => "true",
								"options" => array(
									"true" => array(
										"label" => "",
										"on" => "Yes",
										"off" => "No",
									)
								),
								"group" => "Advanced Settings",
								"dependency" => array("element" => "fancytext_effect", "value" => array("ticker","ticker-down"))
							),
							array(
								"type" => "textfield",
								"heading" => __("Extra Class",'dfd'),
								"param_name" => "ex_class"
							),
							array(
								"type" => "ultimate_google_fonts",
								"heading" => __("Font Family", 'dfd'),
								"param_name" => "strings_font_family",
								"description" => __("Select the font of your choice.",'dfd')." ".__("You can",'dfd')." <a target='_blank' href='".admin_url('admin.php?page=ultimate-font-manager')."'>".__("add new in the collection here",'dfd')."</a>.",
								"group" => "Typography"
							),
							array(
								"type" => "ultimate_google_fonts_style",
								"heading" 		=>	__("Font Style", 'dfd'),
								"param_name"	=>	"strings_font_style",
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"class" => "font-size",
								"heading" => __("Font Size", 'dfd'),
								"param_name" => "strings_font_size",
								"min" => 10,
								"suffix" => "px",
								"group" => "Typography"
							),
							array(
								"type" => "dropdown",
								"heading" 		=>	__("Font Weight", 'dfd'),
								"param_name"	=>	"strings_font_weight",
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
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Line Height", 'dfd'),
								"param_name" => "strings_line_height",
								"value" => "",
								"suffix" => "px",
								"group" => "Typography"
							),
							array(
								"type" => "colorpicker",
								"heading" => __("Fancy Text Color",'dfd'),
								"param_name" => "fancytext_color",
								"group" => "Typography",
								"dependency" => array("element" => "fancytext_effect", "value" => array("typewriter","ticker","ticker-down"))
							),
							array(
								"type" => "colorpicker",
								"heading" => __("Fancy Text Background",'dfd'),
								"param_name" => "ticker_background",
								"group" => "Typography",
								"dependency" => array("element" => "fancytext_effect", "value" => array("typewriter","ticker","ticker-down"))
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Prefix & Suffix Text Color", 'dfd'),
								"param_name" => "strings_color",
								"value" => "",
								"group" => "Typography"
							),
							array(
								"type" => "colorpicker",
								"heading" => __("Cursor Color",'dfd'),
								"param_name" => "typewriter_cursor_color",
								"group" => "Typography",
								"dependency" => array("element" => "fancytext_effect", "value" => array("typewriter"))
							),
							array(
								"type" => "dropdown",
								"heading" => __("Markup",'dfd'),
								"param_name" => "fancytext_tag",
								"value" => array(
									__("div",'dfd') => "div",
									__("H1",'dfd') => "h1",
									__("H2",'dfd') => "h2",
									__("H3",'dfd') => "h3",
									__("H4",'dfd') => "h4",
									__("H5",'dfd') => "h5",
									__("H6",'dfd') => "h6",
								),
								"group" => "Typography",
							),
							array(
								"type" => "ult_param_heading",
								"text" => "<span style='display: block;'><a href='http://bsf.io/t5ir4' target='_blank'>".__("Watch Video Tutorial",'dfd')." &nbsp; <span class='dashicons dashicons-video-alt3' style='font-size:30px;vertical-align: middle;color: #e52d27;'></span></a></span>",
								"param_name" => "notification",
								'edit_field_class' => 'ult-param-important-wrapper ult-dashicon ult-align-right ult-bold-font ult-blue-font vc_column vc_col-sm-12',
							),
						)
					)
				);
			}
		}
		function ultimate_fancytext_shortcode($atts, $content = null){
			$output = $fancytext_strings = $fancytext_prefix = $fancytext_suffix = $fancytext_effect = $strings_textspeed = $strings_tickerspeed = $typewriter_cursor = $typewriter_cursor_text = $typewriter_loop = $fancytext_align = $strings_font_family = $strings_font_style = $strings_font_weight = $strings_font_size = $strings_color = $strings_line_height = $strings_startdelay = $strings_backspeed = $strings_backdelay = $ticker_wait_time = $ticker_show_items = $ticker_hover_pause = $ex_class = '';
			
			$id = uniqid(rand());
			
			extract(shortcode_atts(array(
				'fancytext_prefix' => '',
				'fancytext_strings' => '',
				'fancytext_suffix' => '',
				'fancytext_effect' => 'typewriter',
				'fancytext_align' => 'center',
				'strings_textspeed' => '35',
				'strings_backspeed' => '0',
				'strings_startdelay' => '200',
				'strings_backdelay' => '1500',
				'typewriter_loop' => 'true',
				'typewriter_cursor' => 'true',
				'typewriter_cursor_text' => '|',
				'strings_tickerspeed' => '200',
				'ticker_wait_time' => '3000',
				'ticker_show_items' => '1',
				'ticker_hover_pause' => 'true',
				'typewriter_cursor_color' => '',
				'fancytext_tag' => 'div',
				'strings_font_family' => '',
				'strings_font_style' => '',
				'strings_font_size' => '',
				'strings_font_weight' => '400',
				'strings_color' => '',
				'strings_line_height' => '',
				'ticker_background' => '',
				'fancytext_color' => '',
				'ex_class' => ''
			),$atts));
			
			$string_inline_style = $vticker_inline = $valign = '';
			
			if($strings_font_family != '')
			{
				$font_family = get_ultimate_font_family($strings_font_family);
				$string_inline_style .= 'font-family:\''.$font_family.'\';';
			}
			
			$string_inline_style .= get_ultimate_font_style($strings_font_style);
			
			if($strings_font_size != '')
				$string_inline_style .= 'font-size:'.esc_attr($strings_font_size).'px;';
			
			if($strings_font_weight != '')
				$string_inline_style .= 'font-weight:'.esc_attr($strings_font_weight).';';
			
			if($strings_color != '')
				$string_inline_style .= 'color:'.esc_attr($strings_color).';';
				
			if($strings_line_height != '')
				$string_inline_style .= 'line-height:'.esc_attr($strings_line_height).'px;';
				
			if($fancytext_align != '')
				$string_inline_style .= 'text-align:'.esc_attr($fancytext_align).';';
			
			// Order of replacement
			$order   = array("\r\n", "\n", "\r", "<br/>", "<br>");
			$replace = '|';
			
			// Processes \r\n's first so they aren't converted twice.
			$str = str_replace($order, $replace, $fancytext_strings);
			
			$lines = explode("|", $str);
			
			$count_lines = count($lines);
			
			$ex_class .= ' uvc-type-align-'.esc_attr($fancytext_align).' ';
			if($fancytext_prefix == '')
				$ex_class .= 'uvc-type-no-prefix';
				
			if($fancytext_color != '')
				$vticker_inline .= 'color:'.esc_attr($fancytext_color).';';
			if($ticker_background != '')
			{
				$vticker_inline .= 'background:'.esc_attr($ticker_background).';';
				if($fancytext_effect == 'typewriter')
					$valign = 'fancytext-typewriter-background-enabled';
				else
					$valign = 'fancytext-background-enabled';
			}
			
			$ultimate_js = get_option('ultimate_js');
			
			$output = '<'.esc_attr($fancytext_tag).' class="uvc-type-wrap '.esc_attr($ex_class).' uvc-wrap-'.esc_attr($id).'" style="'.$string_inline_style.'">';
				if(trim($fancytext_prefix) != '')
				{
					$output .= '<span class="ultimate-'.esc_attr($fancytext_effect).'-prefix">'.ltrim($fancytext_prefix).'</span>';
				}
				if($fancytext_effect == 'ticker' || $fancytext_effect == 'ticker-down')
				{
					/*if($ultimate_js != 'enable')
						wp_enqueue_script('ultimate-vticker-js');*/
					if($strings_font_size != '')
						$inherit_font_size = 'ultimate-fancy-text-inherit';
					else
						$inherit_font_size = '';
					if($ticker_hover_pause != 'true')
						$ticker_hover_pause = 'false';
					if($fancytext_effect == 'ticker-down')
						$direction = "down";
					else
						$direction = "up";
					$output .= '<div id="vticker-'.esc_attr($id).'" class="ultimate-vticker '.esc_attr($fancytext_effect).' '.esc_attr($valign).' '.esc_attr($inherit_font_size).'" style="'.$vticker_inline.'"><ul>';
						foreach($lines as $line)
						{
							$output .= '<li>'.strip_tags($line).'</li>';
						}
					$output .= '</ul></div>'; 
				}
				else
				{
					/*if($ultimate_js != 'enable')
						wp_enqueue_script('ultimate-typed-js');*/
					if($typewriter_loop != 'true')
						$typewriter_loop = 'false';			
					if($typewriter_cursor != 'true')
						$typewriter_cursor = 'false';						
					$strings = '['; 
						foreach($lines as $key => $line)  
						{ 
							$strings .= '"'.__(trim(htmlspecialchars_decode(strip_tags($line))),'js_composer').'"';
							if($key != ($count_lines-1))
								$strings .= ','; 
						} 
					$strings .= ']';
					$output .= '<span id="typed-'.esc_attr($id).'" class="ultimate-typed-main '.esc_attr($valign).'" style="'.$vticker_inline.'"></span>';
				}
				if(trim($fancytext_suffix) != '')
				{
					$output .= '<span class="ultimate-'.esc_attr($fancytext_effect).'-suffix">'.rtrim($fancytext_suffix).'</span>';
				}
				if($fancytext_effect == 'ticker' || $fancytext_effect == 'ticker-down')
				{
					$output .= '<script type="text/javascript">
						jQuery(function($){
							$(window).load(function() {
								$("#vticker-'.esc_js($id).'")
									.vTicker({
										speed: '.esc_js($strings_tickerspeed).',
										showItems: '.esc_js($ticker_show_items).',
										pause: '.esc_js($ticker_wait_time).',
										mousePause : '.esc_js($ticker_hover_pause).',
										direction: "'.esc_js($direction).'",
									});
							});
						});
					</script>';
				}
				else
				{
					$output .= '<script type="text/javascript"> jQuery(function($){
							$(window).load(function() {
								$("#typed-'.esc_js($id).'").typed({ 
									strings: '.$strings.',
									typeSpeed: '.esc_js($strings_textspeed).',
									backSpeed: '.esc_js($strings_backspeed).',
									startDelay: '.esc_js($strings_startdelay).',
									backDelay: '.esc_js($strings_backdelay).',
									loop: '.esc_js($typewriter_loop).',
									loopCount: false,
									showCursor: '.esc_js($typewriter_cursor).',
									cursorChar: "'.esc_js($typewriter_cursor_text).'",
									attr: null
								});
							});
						});
					</script>';
					if($typewriter_cursor_color != '')
					{
						$output .= '<style>
							.uvc-wrap-'.esc_attr($id).' .typed-cursor {
								color:'.esc_attr($typewriter_cursor_color).';
							}
						</style>';
					}
				}
			$output .= '</'.esc_attr($fancytext_tag).'>';
			
			/*$args = array(
				$strings_font_family
			);
			enquque_ultimate_google_fonts($args);*/
			
			return $output;
		}
	} // end class
	new Ultimate_FancyText;
	if(class_exists('WPBakeryShortCode'))
	{
		class WPBakeryShortCode_ultimate_fancytext extends WPBakeryShortCode {
		}
	}

}