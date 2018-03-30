<?php
add_shortcode( 'themeum_alert', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'type'		=> 'success',
		'message'	=> '',
		'link'	=> '',
		'target'	=> '_blank',
		'class'			=> '',
		), $atts));

	$output	= '';


    switch ($type) {
        case 'success':
        	$output .= '<div class="alert alert-success alert-dismissible" role="alert">';
			$output .= '<div class="alert-icon alert-success-icon"><i class="fa fa-check"></i></div>';
			$output .= '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>';
			$output .= '<strong>'.$message.'</strong> <a href="'. $link .'" target="'. $target .'" class="alert-link">'. __("link", "themeum") .'</a>';
			$output .= '</div>';
            break;
        case 'information':
        	$output .= '<div class="alert alert-info alert-dismissible" role="alert">';
			$output .= '<div class="alert-icon alert-info-icon"><i class="fa fa-info"></i></div>';
			$output .= '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>';
			$output .= '<strong>'.$message.'</strong> <a href="'. $link .'" target="'. $target .'" class="alert-link">'. __("link", "themeum") .'</a>';
			$output .= '</div>';
            break;        

        case 'warning':
        	$output .= '<div class="alert alert-warning alert-dismissible" role="alert">';
			$output .= '<div class="alert-icon alert-warning-icon"><i class="fa fa-exclamation-triangle"></i></div>';
			$output .= '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>';
			$output .= '<strong>'.$message.'</strong> <a href="'. $link .'" target="'. $target .'" class="alert-link">'. __("link", "themeum") .'</a>';
			$output .= '</div>';
            break;        

        case 'error':
        	$output .= '<div class="alert alert-danger alert-dismissible" role="alert">';
			$output .= '<div class="alert-icon alert-danger-icon"><i class="fa fa-bug"></i></div>';
			$output .= '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>';
			$output .= '<strong>'.$message.'</strong> <a href="'. $link .'" target="'. $target .'" class="alert-link">'. __("link", "themeum") .'</a>';
			$output .= '</div>';
            break;

        default:
            $output = '<div class="themeum-divider  themeum-'.$type.'" ></div>';
            break;
    }

	return $output;

});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
vc_map(array(
	"name" => __("Themeum Alert", "themeum"),
	"base" => "themeum_alert",
	'icon' => 'icon-thm-alert',
	"class" => "",
	"description" => __("Widget Title Heading", "themeum"),
	"category" => __('Themeum', "themeum"),
	"params" => array(
								

		array(
			"type" => "dropdown",
			"heading" => __("Select Alert", "themeum"),
			"param_name" => "type",
			"value" => array('Success'=>'success','Information'=>'information','Warning'=>'warning','Error'=>'error'),
			),

		array(
			"type" => "textfield",
			"heading" => __("Alert Message", "themeum"),
			"param_name" => "message",
			"value" => ""
			),			

		array(
			"type" => "textfield",
			"heading" => __("Alert Link", "themeum"),
			"param_name" => "link",
			"value" => ""
			),	

		array(
			"type" => "dropdown",
			"heading" => __("Target Link", "themeum"),
			"param_name" => "target",
			"value" => array('Blank'=>'_blank','Parent'=>'_parent','Self'=>'_self'),
			),					

		array(
			"type" => "textfield",
			"heading" => __("Custom Class", "themeum"),
			"param_name" => "class",
			"value" => ""
			),		

		)
	));
}