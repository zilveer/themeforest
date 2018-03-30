<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

//Upcoming Events
add_shortcode( 'eventum_counter', function($atts, $content = null){

	extract(shortcode_atts(array(
		'date'					=> '',
		"title"					=> '',
		"title_fontsize" 		=> '',
		"subtitle_fontsize" 	=> '',
		"title_fontweight" 		=> '',
		"subtitle_fontweight" 	=> '',
		"title_text_color" 		=> '',
		"sub_text_color" 		=> '',
		"subtitle"				=> '',
		"class" 				=>'',
		), $atts));

	global $post;
	
	$output = '';
	// Load the method jquery script.?>
    <script type="text/javascript">
    jQuery(function($) {'use strict';
        $('#countdown-timer').countdown("<?php echo str_replace('-', '/', $date); ?>", function(event) {
            $(this).html(event.strftime('<div class="countdown-section"><span class="countdown-amount first-item countdown-days">%-D </span><span class="countdown-period">%!D:<?php echo esc_html__("DAY", "eventum"); ?>,<?php echo esc_html__("DAYS", "eventum"); ?>;</span></div><div class="countdown-section"><span class="countdown-amount countdown-hours">%-H </span><span class="countdown-period">%!H:<?php echo esc_html__("HOUR", "eventum"); ?>,<?php echo esc_html__("HOURS", "eventum"); ?>;</span></div><div class="countdown-section"><span class="countdown-amount countdown-minutes">%-M </span><span class="countdown-period">%!M:<?php echo esc_html__("MINUTE", "eventum"); ?>,<?php echo esc_html__("MINUTES", "eventum"); ?>;</span></div><div class="countdown-section"><span class="countdown-amount countdown-seconds">%-S </span><span class="countdown-period">%!S:<?php echo esc_html__("SECOND", "eventum"); ?>,<?php echo esc_html__("SECONDS", "eventum"); ?>;</span></div>'));
        });
    });
    </script>
    <?php
    $output .= '<div class="shortcode-event-countdown '.esc_attr($class).'">';
    $output .= '<div id="event-countdown" class="row">';
    $output .= '<div id="countdown-timer"></div>';

	// Title
	if($title) {
		$title_style = '';
		if($title_text_color) $title_style .= 'color:' . esc_attr( $title_text_color ) . ';';
		if($title_fontsize) $title_style .= 'font-size:'.esc_attr( $title_fontsize ).'px;line-height:'.esc_attr( $title_fontsize ).'px;';
		if($title_fontweight) $title_style .= 'font-weight:'.esc_attr( $title_fontweight ).';';

		$output .= '<h2 class="countdown-timer-title" style="' . $title_style . '">' . esc_attr( $title ) . '</h2>';
	}

	if($subtitle) {
		$subtitle_style = '';
		if($sub_text_color) $subtitle_style .= 'color:' . esc_attr( $sub_text_color ) . ';';
		if($subtitle_fontsize) $subtitle_style .= 'font-size:'.esc_attr( $subtitle_fontsize ).'px;line-height:'.esc_attr( $subtitle_fontsize ).'px;';
		if($subtitle_fontweight) $subtitle_style .= 'font-weight:'.esc_attr( $subtitle_fontweight ).';';
		$output .= '<h3 class="countdown-timer-subtitle" style="' . $subtitle_style . '">' . esc_html( $subtitle ) . '</h3>';
	}
	
	$output .= '</div>';
	$output .= '</div>';

	return $output;

});



//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
vc_map(array(
	"name" => esc_html__("Eventum Events Counter", 'eventum'),
	"base" => "eventum_counter",
	"icon" => "icon-thm-event-counter",
	"class" => "",
	"description" => esc_html__("Eventum Events Counter addons", 'eventum'),
	"category" => __('Themeum', 'eventum'),
	"params" => array(

		array(
			"type" => "textfield",
			"heading" => esc_html__("Title", 'eventum'),
			"param_name" => "title",
			"value" => "",
			"admin_label"=>true,
		),		

		array(
			"type" => "textfield",
			"heading" => esc_html__("Countdown Date", 'eventum'),
			"param_name" => "date",
			"value" => "2020/10/10 12:34:56",
			"description" => __("Date and time format (yyyy/mm/dd hh:mm:ss) Ex. 2020/10/10 12:34:56", 'eventum'),
		),

		array(
			"type" => "textfield",
			"heading" => esc_html__("Font Size", 'eventum'),
			"param_name" => "title_fontsize",
			"value" => "",
			),

		array(
			"type" => "textfield",
			"heading" => esc_html__("Font Weight", 'eventum'),
			"param_name" => "title_fontweight",
			"value" => "",
			),

		array(
			"type" => "colorpicker",
			"heading" => esc_html__("Font Color", 'eventum'),
			"param_name" => "title_text_color",
			"value" => "",
			),

		array(
			"type" => "textfield",
			"heading" => esc_html__("Sub Title", 'eventum'),
			"param_name" => "subtitle",
			"value" => "",
			),
		array(
			"type" => "textfield",
			"heading" => esc_html__("Subtitle Font Size", 'eventum'),
			"param_name" => "subtitle_fontsize",
			"value" => "",
			),

		array(
			"type" => "colorpicker",
			"heading" => esc_html__("SubTitle Font Color", 'eventum'),
			"param_name" => "sub_text_color",
			"value" => "",
			),	

		array(
			"type" => "textfield",
			"heading" => esc_html__("Subtitle Font Weight", 'eventum'),
			"param_name" => "subtitle_fontweight",
			"value" => "",
			),				

		array(
			"type" => "textfield",
			"heading" => esc_html__("Extra CSS Class", 'eventum'),
			"param_name" => "class",
			"value" => "",
			"description" => "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file."
			),

		)
	));
}