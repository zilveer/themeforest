<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: CountDown for Visual Composer
* Add-on URI: http://dev.brainstormforce.com
*/
if(!class_exists('Ultimate_CountDown'))
{
	class Ultimate_CountDown
	{
		function __construct()
		{
			add_action('init',array($this,'countdown_init'));
			add_shortcode('ult_countdown',array($this,'countdown_shortcode'));
			add_action('admin_enqueue_scripts',array($this,'admin_scripts'));
			add_action('wp_enqueue_scripts',array($this,'count_down_scripts'),1);
		}
		function count_down_scripts() {
			wp_register_script("jquery.timecircle",get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-js/jquery.countdown_org.min.js',array('jquery'),null);
			wp_register_script("jquery.countdown",get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-js/count-timer.min.js',array('jquery'),null);
		}
		function admin_scripts($hook) {
		   if($hook == "post.php" || $hook == "post-new.php"){
				wp_enqueue_script('jquery.datetimep',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/admin/js/bootstrap-datetimepicker.min.js','1.0','jQuery',true);			
				wp_enqueue_style('colorpicker.style',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/admin/css/bootstrap-datetimepicker.min.css');
		   }
	   	}
		function countdown_init() {
			if(function_exists('vc_map')) {
				vc_map(
					array(
					   "name" => __("Countdown", 'dfd'),
					   "base" => "ult_countdown",
					   "class" => "vc_countdown",
					   "icon" => "vc_countdown",
					   "category" => __('Ronneby 1.0','dfd'),
					   "description" => __("Countdown Timer.",'dfd'),
					   "params" => array(
					   		array(
						   		"type" => "dropdown",
								"class" => "",
								"heading" => __("Countdown Timer Style", 'dfd'),
								"param_name" => "count_style",
								"value" => array(
										__("Digit and Unit Side by Side",'dfd') => "ult-cd-s1",
										__("Digit and Unit Up and Down",'dfd') => "ult-cd-s2",
									),
								"group" => "General Settings",
								//"description" => __("Select style for countdown timer.", 'dfd'),
							),
							array(
						   		"type" => "datetimepicker",
								"class" => "",
								"heading" => __("Target Time For Countdown", 'dfd'),
								"param_name" => "datetime",
								"value" => "", 
								"description" => __("Date and time format (yyyy/mm/dd hh:mm:ss).", 'dfd'),
								"group" => "General Settings",
							),	
							array(
						   		"type" => "dropdown",
								"class" => "",
								"heading" => __("Countdown Timer Depends on", 'dfd'),
								"param_name" => "ult_tz",
								"value" => array(
										__("WordPress Defined Timezone",'dfd') => "ult-wptz",
										__("User's System Timezone",'dfd') => "ult-usrtz",
									),
								//"description" => __("Select style for countdown timer.", 'dfd'),
								"group" => "General Settings",
							),						
							array(
						   		"type" => "checkbox",
								"class" => "",
								"heading" => __("Select Time Units To Display In Countdown Timer", 'dfd'),
								"param_name" => "countdown_opts",
								"value" => array(
										__("Years",'dfd') => "syear",
										__("Months",'dfd') => "smonth",
										__("Weeks",'dfd') => "sweek",
										__("Days",'dfd') => "sday",										
										__("Hours",'dfd') => "shr",
										__("Minutes",'dfd') => "smin",
										__("Seconds",'dfd') => "ssec",										
									),
								//"description" => __("Select options for the video.", 'dfd'),
								"group" => "General Settings",
							),
							array(
						   		"type" => "colorpicker",
								"class" => "",
								"heading" => __("Timer Digit Text Color", 'dfd'),
								"param_name" => "tick_col",
								"value" => "",
								//"description" => __("Text color for time ticks.", 'dfd'),
								"group" => "General Settings",
							),
							array(
						   		"type" => "number",
								"class" => "",
								"heading" => __("Timer Digit Text Size", 'dfd'),
								"param_name" => "tick_size",
								"suffix"=>"px",
								"min"=>"0",
								"value" => "36",
								//"description" => __("Font size of tick text.", 'dfd'),
								"group" => "General Settings",
							),
							array(
						   		"type" => "dropdown",
								"class" => "",
								"heading" => __("Timer Digit Text Style", 'dfd'),
								"param_name" => "tick_style",								
								"value" => array(
												__('Normal','dfd')=>"",
												__('Bold','dfd')=>"bold",
												__('Italic','dfd')=>"italic",
												__('Bold & Italic','dfd')=>"boldnitalic",
											),
								//"description" => __("Font size of tick text.", 'dfd'),
								"group" => "General Settings",
							),
							array(
						   		"type" => "colorpicker",
								"class" => "",
								"heading" => __("Timer Unit Text Color", 'dfd'),
								"param_name" => "tick_sep_col",
								"value" => "",
								//"description" => __("Text color for time ticks Period.", 'dfd'),
								"group" => "General Settings",
							),
							array(
						   		"type" => "number",
								"class" => "",
								"heading" => __("Timer Unit Text Size", 'dfd'),
								"param_name" => "tick_sep_size",
								"value" => "13",
								"suffix"=>"px",
								"min"=>"0",
								//"description" => __("Font size of tick text Period.", 'dfd'),
								"group" => "General Settings",
							),
							array(
						   		"type" => "dropdown",
								"class" => "",
								"heading" => __("Timer Unit Text Style", 'dfd'),
								"param_name" => "tick_sep_style",
								"value" => array(
												__('Normal','dfd')=>"",
												__('Bold','dfd')=>"bold",
												__('Italic','dfd')=>"italic",
												__('Bold & Italic','dfd')=>"boldnitalic",
											),
								//"description" => __("Font size of tick text.", 'dfd'),
								"group" => "General Settings",
							),
							array(
						   		"type" => "dropdown",
								"class" => "",
								"heading" => __("Timer Digit Border Style", 'dfd'),
								"param_name" => "br_style",
								"value" => array(
											__('None','dfd')=>'',
											__('Solid','dfd')=>"solid",
											__('Dashed','dfd')=>"dashed",
											__('Dotted','dfd')=>"dotted",
											__('Double','dfd')=>"double",
											__('Inset','dfd')=>"inset",
											__('Outset','dfd')=>"outset",
											),
								//"description" => __("Border-style.", 'dfd'),
								"group" => "General Settings",								
							),
							array(
						   		"type" => "number",
								"class" => "",
								"heading" => __("Timer Digit Border Size", 'dfd'),
								"param_name" => "br_size",
								"value" => "",
								"min"=>"0",
								"suffix"=>"px",
								//"description" => __("Border-size.", 'dfd'),
								"dependency" => Array("element"=>"br_style","value"=>array("solid","dotted","dashed","double","inset","outset",)),
								"group" => "General Settings",
							),
							array(
						   		"type" => "colorpicker",
								"class" => "",
								"heading" => __("Timer Digit Border Color", 'dfd'),
								"param_name" => "br_color",
								"value" => "",
								//"description" => __("Text color for time ticks Period.", 'dfd'),
								"dependency" => Array("element"=>"br_style","value"=>array("solid","dotted","dashed","double","inset","outset",)),
								"group" => "General Settings",
							),
							array(
						   		"type" => "number",
								"class" => "",
								"heading" => __("Timer Digit Border Radius", 'dfd'),
								"param_name" => "br_radius",
								"value" => "",
								"min"=>"0",
								"suffix"=>"px",
								//"description" => __("Border-Time Radius.", 'dfd'),
								"dependency" => Array("element"=>"br_style","value"=>array("solid","dotted","dashed","double","inset","outset",)),
								"group" => "General Settings",
							),
							array(
						   		"type" => "colorpicker",
								"class" => "",
								"heading" => __("Timer Digit Background Color", 'dfd'),
								"param_name" => "timer_bg_color",
								"value" => "",
								//"description" => __("Background-Color.", 'dfd'),
								"group" => "General Settings",								
							),
							array(
						   		"type" => "number",
								"class" => "",
								"heading" => __("Timer Digit Background Size", 'dfd'),
								"param_name" => "br_time_space",
								"min"=>"0",
								"value" => "0",
								"suffix"=>"px",
								//"description" => __("Border-Timer Space.", 'dfd'),
								"group" => "General Settings",
							),							
							array(
						   		"type" => "textfield",
								"class" => "",
								"heading" => __("Extra Class", 'dfd'),
								"param_name" => "el_class",
								"value" => "",
								"description" => __("Extra Class for the Wrapper.", 'dfd'),
								"group" => "General Settings",
							),
							array(
						   		"type" => "textfield",
								"class" => "",
								"heading" => __("Day (Singular)", 'dfd'),
								"param_name" => "string_days",
								"value" => "Day",
								//"description" => __("Enter your string for day.", 'dfd'),
								"group" => "Strings Translation",
							),
							array(
						   		"type" => "textfield",
								"class" => "",
								"heading" => __("Days (Plural)", 'dfd'),
								"param_name" => "string_days2",
								"value" => "Days",
								//"description" => __("Enter your string for days.", 'dfd'),
								"group" => "Strings Translation",
							),
							array(
						   		"type" => "textfield",
								"class" => "",
								"heading" => __("Week (Singular)", 'dfd'),
								"param_name" => "string_weeks",
								"value" => "Week",
								//"description" => __("Enter your string for Week.", 'dfd'),
								"group" => "Strings Translation",
							),
							array(
						   		"type" => "textfield",
								"class" => "",
								"heading" => __("Weeks (Plural)", 'dfd'),
								"param_name" => "string_weeks2",
								"value" => "Weeks",
								//"description" => __("Enter your string for Weeks.", 'dfd'),
								"group" => "Strings Translation",
							),
							array(
						   		"type" => "textfield",
								"class" => "",
								"heading" => __("Month (Singular)", 'dfd'),
								"param_name" => "string_months",
								"value" => "Month",
								//"description" => __("Enter your string for Month.", 'dfd'),
								"group" => "Strings Translation",
							),
							array(
						   		"type" => "textfield",
								"class" => "",
								"heading" => __("Months (Plural)", 'dfd'),
								"param_name" => "string_months2",
								"value" => "Months",
								//"description" => __("Enter your string for Months.", 'dfd'),
								"group" => "Strings Translation",
							),
							array(
						   		"type" => "textfield",
								"class" => "",
								"heading" => __("Year (Singular)", 'dfd'),
								"param_name" => "string_years",
								"value" => "Year",
								//"description" => __("Enter your string for Year.", 'dfd'),
								"group" => "Strings Translation",
							),
							array(
						   		"type" => "textfield",
								"class" => "",
								"heading" => __("Years (Plural)", 'dfd'),
								"param_name" => "string_years2",
								"value" => "Years",
								//"description" => __("Enter your string for Years.", 'dfd'),
								"group" => "Strings Translation",
							),
							array(
						   		"type" => "textfield",
								"class" => "",
								"heading" => __("Hour (Singular)", 'dfd'),
								"param_name" => "string_hours",
								"value" => "Hour",
								//"description" => __("Enter your string for Hour.", 'dfd'),
								"group" => "Strings Translation",
							),
							array(
						   		"type" => "textfield",
								"class" => "",
								"heading" => __("Hours (Plural)", 'dfd'),
								"param_name" => "string_hours2",
								"value" => "Hours",
								//"description" => __("Enter your string for Hours.", 'dfd'),
								"group" => "Strings Translation",
							),
							array(
						   		"type" => "textfield",
								"class" => "",
								"heading" => __("Minute (Singular)", 'dfd'),
								"param_name" => "string_minutes",
								"value" => "Minute",
								//"description" => __("Enter your string for Minute.", 'dfd'),
								"group" => "Strings Translation",
							),
							array(
						   		"type" => "textfield",
								"class" => "",
								"heading" => __("Minutes (Plural)", 'dfd'),
								"param_name" => "string_minutes2",
								"value" => "Minutes",
								//"description" => __("Enter your string for Minutes.", 'dfd'),
								"group" => "Strings Translation",
							),							
							array(
						   		"type" => "textfield",
								"class" => "",
								"heading" => __("Second (Singular)", 'dfd'),
								"param_name" => "string_seconds",
								"value" => "Second",
								//"description" => __("Enter your string for Second.", 'dfd'),
								"group" => "Strings Translation",
							),
							array(
						   		"type" => "textfield",
								"class" => "",
								"heading" => __("Seconds (Plural)", 'dfd'),
								"param_name" => "string_seconds2",
								"value" => "Seconds",
								//"description" => __("Enter your string for Seconds.", 'dfd'),
								"group" => "Strings Translation",
							),
							array(
								"type" => "heading",
								"sub_heading" => "<span style='display: block;'><a href='http://bsf.io/szdd2' target='_blank'>Watch Video Tutorial &nbsp; <span class='dashicons dashicons-video-alt3' style='font-size:30px;vertical-align: middle;color: #e52d27;'></span></a></span>",
								"param_name" => "notification",
								'edit_field_class' => 'ult-param-important-wrapper ult-dashicon ult-align-right ult-bold-font ult-blue-font vc_column vc_col-sm-12',
								"group" => "General Settings",
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
						)	
					)
				);
			}
		}
		// Shortcode handler function for  icon block
		function countdown_shortcode($atts)
		{
			$count_style = $module_animation  = $datetime = $ult_tz = $countdown_opts = $tick_col = $tick_size = $tick_style = $tick_sep_col = $tick_sep_size = '';
			$tick_sep_style = $br_color = $br_style = $br_size = $timer_bg_color = $br_radius = $br_time_space = $el_class = '';
			$string_days = $string_weeks = $string_months = $string_years = $string_hours = $string_minutes = $string_seconds = '';
			$string_days2 = $string_weeks2 = $string_months2 = $string_years2 = $string_hours2 = $string_minutes2 = $string_seconds2 = '';
			extract(shortcode_atts( array(
				'count_style'=>'ult-cd-s1',
				'datetime'=>'',
				'ult_tz'=>'ult-wptz',
				'countdown_opts'=>'',
				'tick_col'=>'',
				'tick_size'=>'36',
				'tick_style'=>'',
				'tick_sep_col'=>'',
				'tick_sep_size'=>'13',
				'tick_sep_style'=>'',
				'br_color'=>'',
				'br_style'=>'',
				'br_size'=>'',
				'timer_bg_color'=>'',
				'br_radius'=>'',
				'br_time_space'=>'0',				
				'el_class'=>'',
				'string_days' => 'Day',
				'string_days2' => 'Days',
				'string_weeks' => 'Week',
				'string_weeks2' => 'Weeks',
				'string_months' => 'Month',
				'string_months2' => 'Months',
				'string_years' => 'Year',
				'string_years2' => 'Years',
				'string_hours' => 'Hour',
				'string_hours2' => 'Hours',
				'string_minutes' => 'Minute',
				'string_minutes2' => 'Minutes',
				'string_seconds' => 'Second',
				'string_seconds2' => 'Seconds',
				'module_animation' => '',
			),$atts));	
			$count_frmt = $labels = '';
			$labels = $string_years2 .','.$string_months2.','.$string_weeks2.','.$string_days2.','.$string_hours2.','.$string_minutes2.','.$string_seconds2;
			$labels2 = $string_years .','.$string_months.','.$string_weeks.','.$string_days.','.$string_hours.','.$string_minutes.','.$string_seconds;
			$countdown_opt = explode(",",$countdown_opts);				
				if(is_array($countdown_opt)){
					foreach($countdown_opt as $opt){
						if($opt == "syear") $count_frmt .= 'Y';
						if($opt == "smonth") $count_frmt .= 'O';
						if($opt == "sweek") $count_frmt .= 'W';
						if($opt == "sday") $count_frmt .= 'D';
						if($opt == "shr") $count_frmt .= 'H';
						if($opt == "smin") $count_frmt .= 'M';
						if($opt == "ssec") $count_frmt .= 'S';	
					}
				}
			$data_attr = '';
			if($count_frmt=='') $count_frmt = 'DHMS';
			if($br_size =='' || $br_color == '' || $br_style ==''){
				if($timer_bg_color==''){
					$el_class.=' ult-cd-no-border';
				}
			}
			else{
				$data_attr .=  'data-br-color="'.esc_attr($br_color).'" data-br-style="'.esc_attr($br_style).'" data-br-size="'.esc_attr($br_size).'" ';
			}
			$data_attr .= ' data-tick-style="'.esc_attr($tick_style).'" ';
			$data_attr .= ' data-tick-p-style="'.esc_attr($tick_sep_style).'" ';	
			$data_attr .= ' data-bg-color="'.esc_attr($timer_bg_color).'" data-br-radius="'.esc_attr($br_radius).'" data-padd="'.esc_attr($br_time_space).'" ';

			$animate = $animation_data = '';

			if ( ! ( $module_animation == '' ) ) {
				$animate        = ' cr-animate-gen';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}

			$output = '<div class="ult_countdown '.esc_attr($el_class).' '.esc_attr($count_style).' '.esc_attr($animate).' " '.$animation_data.'>';
			if($datetime!=''){
				$output .='<div class="ult_countdown-div ult_countdown-dateAndTime '.esc_attr($ult_tz).'" data-labels="'.esc_attr($labels).'" data-labels2="'.esc_attr($labels2).'"  data-terminal-date="'.esc_attr($datetime).'" data-countformat="'.esc_attr($count_frmt).'" data-time-zone="'.get_option('gmt_offset').'" data-time-now="'.str_replace('-', '/', current_time('mysql')).'" data-tick-size="'.esc_attr($tick_size).'" data-tick-col="'.esc_attr($tick_col).'" data-tick-p-size="'.esc_attr($tick_sep_size).'" data-tick-p-col="'.esc_attr($tick_sep_col).'" '.$data_attr.'>'.$datetime.'</div>';
			}			
			$output .='</div>';
			return $output;		
		}
	}
	//instantiate the class
	$ult_countdown = new Ultimate_CountDown;
}