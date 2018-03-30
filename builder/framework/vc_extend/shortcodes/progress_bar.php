<?php
/*Progress bar*/
add_shortcode('oi_progress', 'oi_progress_f');
function oi_progress_f( $atts, $content = null)
{
	extract(shortcode_atts(
		array(
			'oi_progress_value' => "50",
			'oi_progress_color' => '#00F6FF',
			'oi_progress_radius' => '100px',
			'oi_progress_h' => '30px',
			'oi_progress_title' => 'Progress Bar 50%',
			'oi_progress_title_c' => '#fff',
			'oi_progress_bg' => '#eaeaea',
		), $atts)
	);

	$output =' 
	<div class="progress oi_progress" style="height:'.$oi_progress_h.'; border-radius:'.$oi_progress_radius.' !important; background-color:'.$oi_progress_bg.'">
		<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="'.$oi_progress_value.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$oi_progress_value.'%; background-color:'.$oi_progress_color.';"><span style="color:'.$oi_progress_title_c.'">'.$oi_progress_title.'</span></div>
	</div>
	';
	return $output;
};

vc_map( array(
   "name" => __("Progress Bar",'orangeidea'),
   "base" => "oi_progress",
   "class" => "",
   "icon" => "icon-wpb-team_member",
   "admin_enqueue_css" => array(get_template_directory_uri().'/vc_extend/style.css'),
   "category" => __('BUILDER','orangeidea'),
   "params" => array(
	  array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Progress Value",'orangeidea'),
         "param_name" => "oi_progress_value",
         "value" => "50",
      ),
	  array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Progress Height",'orangeidea'),
         "param_name" => "oi_progress_h",
         "value" => "30px",
      ),
	  
	  array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Progress Border Radius",'orangeidea'),
         "param_name" => "oi_progress_radius",
         "value" => "100px",
      ),
	  array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_progress_color",
			"heading" => __("Bar Color", "orangeidea"),
			"value" => '#00F6FF',
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_progress_bg",
			"heading" => __("Bar Background", "orangeidea"),
			"value" => '#eaeaea',
		),
	  array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Title",'orangeidea'),
         "param_name" => "oi_progress_title",
         "value" => "Progress Bar 50%",
      ),
	  
	 array(
		"type" => "colorpicker",
		"holder" => "div",
		"class" => "",
		"param_name" => "oi_progress_title_c",
		"heading" => __("Title Color", "orangeidea"),
		"value" => '#fff',
	),
   )
) );


