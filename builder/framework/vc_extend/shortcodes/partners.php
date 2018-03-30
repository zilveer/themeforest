<?php
/*Partner*/
add_shortcode('oi_partner', 'oi_partner_f');
function oi_partner_f( $atts, $content = null)
{
	extract(shortcode_atts(
		array(
			'image' => "",
			'url' => 'http://www.google.com',
			'title' => 'Partner Title',
			'oi_c' => '#fff',
			'oi_bg' => '#000',
			'oi_pos' => 'bottom',
			'oi_target' =>'_blank'
		), $atts)
	);
	$image_done = wp_get_attachment_image($image,'full img-responsive vc_team_member_image');

	$output ='<div data-color="'.$oi_c.'" data-bg="'.$oi_bg.'" data-position="'.$oi_pos.'" title="'.$title.'" id="oi_'.$image.'_partner" class="oi_partner_holder"><a target="'.$oi_target.'" href="'.$url.'">'.$image_done.'</a></div>';
	return $output;
};


vc_map( array(
   "name" => __("Partner logo",'orangeidea'),
   "base" => "oi_partner",
   "class" => "",
   "icon" => "icon-wpb-team_member",
   "admin_enqueue_css" => array(get_template_directory_uri().'/vc_extend/style.css'),
   "category" => __('BUILDER','orangeidea'),
   "params" => array(
	  array(
         "type" => "attach_image",
         "class" => "",
         "heading" => __("logo",'orangeidea'),
         "param_name" => "image",
         "value" => "",
      ),
	  array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("URL",'orangeidea'),
         "param_name" => "url",
         "value" => "http://www.google.com",
      ),
	  array(
			'type' => 'dropdown',
			'heading' => "URL Target",
			'param_name' => 'oi_target',
			'value' => array( "_self", "_blank"),
			'std' => '_blank',
		),
	  array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Title",'orangeidea'),
         "param_name" => "title",
         "value" => "Partner Title",
      ),
	  array(
			'type' => 'dropdown',
			'heading' => "tooltip Position",
			'param_name' => 'oi_pos',
			'value' => array( "bottom", "top", "left", "right"),
			'std' => 'bottom',
		),
	  
	  array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_c",
			"heading" => __("Tooltip title color", "orangeidea"),
			"value" => '#fff',
		),
		 array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_bg",
			"heading" => __("ToolTip bg color", "orangeidea"),
			"value" => '#000',
		),
   )
) );

