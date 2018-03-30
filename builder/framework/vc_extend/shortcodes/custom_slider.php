<?php
/*Custom Slider*/
add_shortcode('oi_custom_slider', 'oi_custom_slider_f');
function oi_custom_slider_f( $atts, $content = null)
{
	extract(shortcode_atts(
		array(
			'oi_id' => 'example_id_for_element',
			'oi_slider_nav' =>'Arrows',
			'oi_descr' => "Show",
			'oi_slider_nav_s' =>'100px',
			'oi_slider_nav_m' =>'-60px',
			'oi_slider_nav_p' =>'120px',
			'oi_slider_nav_c' =>'#e0e0e0',
			'oi_slider_nav_ch' =>'#000',
			'oi_autoplay' =>'true',
			'oi_time' =>'5000',
			'oi_items_1400' =>'1',
			'oi_items_m_1400' =>'0',
			'oi_items_1200' =>'1',
			'oi_items_m_1200' =>'0',
			'oi_items_800' =>'1',
			'oi_items_m_800' =>'0',
			'oi_items_600' =>'1',
			'oi_items_m_600' =>'0',
			'oi_items_0' =>'1',
			'oi_items_m_0' =>'0',
			
		), $atts)
	);
	$arrow_nav ='false';
	$output = '';
	if($oi_slider_nav =="Arrows"){
		$arrow_nav ='true';
	}
	$extra_class='';
	if($oi_descr == 'None'){$extra_class ='do_not_show_hover';}
	$output .='<style>';
		if($oi_slider_nav =="Arrows"){
			$output .='#'.$oi_id.' { padding:0px '.$oi_slider_nav_p.';}';
		}
		$output .= '#'.$oi_id.' .owl-nav .owl-prev, #'.$oi_id.' .owl-nav .owl-next { margin-top:'.$oi_slider_nav_m.' !important; } ';
		$output .='#'. $oi_id.' .owl-nav .owl-prev, #'.$oi_id.' .owl-nav .owl-next i {color:'.$oi_slider_nav_c.'}';
	$output .='</style>';
	
	$output .='<div class="'.$extra_class.'" data-icon-size="'.$oi_slider_nav_s.'" data-color-hover="'.$oi_slider_nav_ch.'" data-arrows="'.$arrow_nav.'"  data-color="'.$oi_slider_nav_c.'" class="oi_owl_slider" id="'.$oi_id.'">'.do_shortcode($content).'</div>';
	$output .='<script>
	jQuery.noConflict()(function($){
		$(document).ready(function() {
		$("#'.$oi_id.'").owlCarousel({
			loop:true,
			autoplay:'.$oi_autoplay.',
			nav:'.$arrow_nav.',
			autoplayTimeout:'.$oi_time.',
			autoplayHoverPause:true,
			dots:false,
			navText:[,],
			responsive: {
				0: {
					margin: '.$oi_items_m_0.',
					items: '.$oi_items_0.'
				},
				600: {
					margin: '.$oi_items_m_600.',
					items: '.$oi_items_600.'
				},
				800: {
					margin: '.$oi_items_m_800.',
					items: '.$oi_items_800.'
				},
				1200: {
					margin: '.$oi_items_m_1200.',
					items: '.$oi_items_1200.'
				},
				1400: {
					margin: '.$oi_items_m_1400.',
					items: '.$oi_items_1400.'
				}
			}
		});
		});
	});
	</script>';
	
	return $output;
};

/*Custom Slider*/
vc_map( array(
    "name" => __("Custom Slider", "orangeidea"),
    "base" => "oi_custom_slider",
	"category" => __('BUILDER','orangeidea'),
    "as_parent" => array('only' => 'vc_testimonial_item, vc_portfolio_item, oi_partner'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    "show_settings_on_create" => true,
    "params" => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_id",
			"group" => "General",
			"heading" => __("Slider ID", "orangeidea"),
			"value" => 'example_id_for_element',
			"description" => __( "Please set slider ID", 'orangeidea' )
		),
		array(
			'type' => 'dropdown',
			'heading' => "Autoplay",
			'param_name' => 'oi_autoplay',
			"group" => "General",
			'value' => array( "true", "false"),
			'std' => 'true',
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_time",
			"group" => "General",
			"heading" => __("Autoplay Timeout", "orangeidea"),
			"value" => '5000',
		),
		
		array(
			'type' => 'dropdown',
			'heading' => "Navigation",
			'param_name' => 'oi_slider_nav',
			"group" => "Navigation",
			'value' => array( "Arrows", "None"),
			'std' => 'Arrows',
		),
		
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"group" => "Navigation",
			"param_name" => "oi_slider_nav_s",
			"heading" => __("Arrows Size", "orangeidea"),
			"value" => '100px',
			"description" => __( "Size in px", 'orangeidea' )
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"group" => "Navigation",
			"param_name" => "oi_slider_nav_p",
			"heading" => __("Arrows side margin", "orangeidea"),
			"value" => '120px',
			"description" => __( "Size in px", 'orangeidea' )
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"group" => "Navigation",
			"param_name" => "oi_slider_nav_m",
			"heading" => __("Arrows top margin", "orangeidea"),
			"value" => '-60px',
			"description" => __( "Size in px", 'orangeidea' )
		),
		
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"group" => "Navigation",
			"param_name" => "oi_slider_nav_c",
			"heading" => __("Arrows Color", "orangeidea"),
			"value" => '#e0e0e0',
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"group" => "Navigation",
			"param_name" => "oi_slider_nav_ch",
			"heading" => __("Arrows Color on Hover", "orangeidea"),
			"value" => '#000',
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"group" => "Responsive",
			"param_name" => "oi_items_1400",
			"heading" => __("Items per row for 1400px wide screen", "orangeidea"),
			"value" => '1',
			"description" => __( "For big desktops", 'orangeidea' )
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"group" => "Responsive",
			"param_name" => "oi_items_m_1400",
			"heading" => __("Space between for items 1400px wide screen", "orangeidea"),
			"value" => '0',
			"description" => __( "For big desktops", 'orangeidea' )
		),
		
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"group" => "Responsive",
			"param_name" => "oi_items_1200",
			"heading" => __("Items per row for 1200px wide screen", "orangeidea"),
			"value" => '1',
			"description" => __( "For standard desktops", 'orangeidea' )
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"group" => "Responsive",
			"param_name" => "oi_items_m_1200",
			"heading" => __("Space between for items 1200px wide screen", "orangeidea"),
			"value" => '0',
			"description" => __( "For standard desktops", 'orangeidea' )
		),
		
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"group" => "Responsive",
			"param_name" => "oi_items_800",
			"heading" => __("Items per row for 800px wide screen", "orangeidea"),
			"value" => '1',
			"description" => __( "For landscape tablet view", 'orangeidea' )
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"group" => "Responsive",
			"param_name" => "oi_items_m_800",
			"heading" => __("Space between items for 800px wide screen", "orangeidea"),
			"value" => '0',
			"description" => __( "For landscape tablet view", 'orangeidea' )
		),
		
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"group" => "Responsive",
			"param_name" => "oi_items_600",
			"heading" => __("Items per row for 600px wide screen", "orangeidea"),
			"value" => '1',
			"description" => __( "For portrait tablet view", 'orangeidea' )
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"group" => "Responsive",
			"param_name" => "oi_items_m_600",
			"heading" => __("Space between items for 600px wide screen", "orangeidea"),
			"value" => '0',
			"description" => __( "For portrait tablet view", 'orangeidea' )
		),
		
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"group" => "Responsive",
			"param_name" => "oi_items_0",
			"heading" => __("Items per row for mobile", "orangeidea"),
			"value" => '1',
			"description" => __( "For mobile", 'orangeidea' )
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"group" => "Responsive",
			"param_name" => "oi_items_m_0",
			"heading" => __("Space between items for mobile", "orangeidea"),
			"value" => '0',
			"description" => __( "For mobile", 'orangeidea' )
		),
		
		
		
    ),
    "js_view" => 'VcColumnView'
) );


