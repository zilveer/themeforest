<?php
/*TESTIMONIAL  ITEM*/
add_shortcode('vc_testimonial_item', 'vc_testimonial_item_f');
function vc_testimonial_item_f( $atts, $content = null)
{
	extract(shortcode_atts(
		array(
			'id' => '',
			'oi_align' => 'left',
			'oi_title_size'=>'h6',
			'oi_content_size'=>'h3',
			'oi_content_c' =>'#000',
			'oi_author_c' =>'#999',
		), $atts)
	);
	$post = get_post($id);
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'wall-portfolio-squre'); 
	$title = $post->post_title;
	$content = $post->post_content;
	$output ='<div class="oi_testimonial_holder" style="text-align:'.$oi_align.'">';
		$output .='<span class="oi_testimonial_content_holder"><'.$oi_content_size.'  style="color:'.$oi_content_c.';  class="oi_tesimonial_content">'.$content.'</'.$oi_content_size.'></span>';
		$output .='<div class="clearfix"></div>';
		$output .='<div style="text-align:'.$oi_align.'" class="oi_testimonial_author_holder"><img class="oi_oi_testimonial_image" src="'.$image[0].'"><'.$oi_title_size.' style="color:'.$oi_author_c.'; text-align:'.$oi_align.'" class="oi_tesimonial_title">'.$title.'<br>'.get_post_meta($post->ID, 'testimonial-descr', true).'</'.$oi_title_size.'></div>';
	$output .='</div>';

	return $output;
};

vc_map( array(
	"name" => __("Testimonial Item",'orangeidea'),
	"base" => "vc_testimonial_item",
	"admin_enqueue_css" => array(get_template_directory_uri().'/framework/vc_extend/style.css'),
	"class" => "",
	"category" => __('BUILDER','orangeidea'),
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "id",
			"heading" => __("Testimonial Item", "orangeidea"),
			"value" => '',
			"description" => __( "Tesimonial ID", 'orangeidea' )
		),
		array(
			'type' => 'dropdown',
			'heading' => "Testimonial Size",
			'param_name' => 'oi_content_size',
			'value' => array( "h1", "h2", "h3", "h4", "h5", "h6", "p" ),
			'std' => 'h3',
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_content_c",
			"heading" => __("Content Color", "orangeidea"),
			"value" => '#000',
		),
		
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_author_c",
			"heading" => __("Author Color", "orangeidea"),
			"value" => '#999',
		),
		
		array(
			'type' => 'dropdown',
			'heading' => "Author Size",
			'param_name' => 'oi_title_size',
			'value' => array( "h1", "h2", "h3", "h4", "h5", "h6", "p" ),
			'std' => 'h6',
		),
		
		array(
			'type' => 'dropdown',
			'heading' => "Testimonial Align",
			'param_name' => 'oi_align',
			'value' => array( "left", "center", "right"),
			'std' => 'left',
		),
	)
) );

