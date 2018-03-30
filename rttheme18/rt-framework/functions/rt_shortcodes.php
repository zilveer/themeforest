<?php
/* RT-Theme Shortcodes */ 

/*
* ------------------------------------------------- *
*		USE SHORTCODES IN WIDGET TEXTS
* ------------------------------------------------- *		
*/ 

add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode', 20);


/*
* ------------------------------------------------- *
*		CONTENT FILTER - THE SHORTCODE CLEANER		
* ------------------------------------------------- *		
*/ 
if( ! function_exists("rt_content_filter") ){
	function rt_content_filter($content) {

	// array of custom shortcodes requiring the fix
	$block = join("|",array("rt_column","rt_columns","columns","column","slider","slide","photo_gallery","image","auto_thumb","icon_list","icon_list_line","tabs","tab","accordion","pane","table_column","pricing_table","contact_form","pullquote","banner","button","heading","location","google_maps","h_chained_contents","h_content","v_media_boxes","v_media_box","v_icon_boxes","v_icon_box","content_box","content_icon_box"));

	// opening tag
	$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]", $content);
	// closing tag
	$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);

	return $rep;
	}
}

add_filter("the_content", "rt_content_filter"); 

/*
* ------------------------------------------------- *
*		Content Box With Featured Image
* ------------------------------------------------- *		
*/ 

if( ! function_exists("rt_content_box") ){
	function rt_content_box( $atts, $content = null ) {
	global $rt_column_layout;
	/*
		[content_box 
			id=""
			title="" 
			title_position="" 
			featured_image="" 
			icon="" 
			icon_style="" 
			text_position="" 
			link="" 
			link_text="" 
			link_target=""
		][/content_box]
	*/
	

	//defaults
	extract(shortcode_atts(array(  
		"id"  => 'content-random-'.rand(100000, 1000000), 
		"title" => '', 
		"title_position" => "",
		"image_style" => "",
		"featured_image" => "",
		"icon" => "",
		"icon_style" => "",
		"text_position" => "",
		"link" => "",
		"link_text" => "",
		"link_target" => "_self",
	), $atts));
	

	//icon
	$icon = ! ( $icon_style  == '0' ) ? $icon : "";

	//link target
	$link_target = ! empty( $link_target ) ? $link_target : '_self';

	//icon style
	$icon_style_class = ($icon_style == "2") ? "default_icon" : "";
 

	//title position 
	$title_position = empty( $title_position ) ? "embedded" : $title_position;

	//icon output 
	$icon_output = "";
	if( ! empty( $icon ) && ! empty( $title ) ){
		$icon_output ='<span class="'.$icon.' '. $icon_style_class .' heading_icon icon-large"></span>'; 
	}

	// column layout
	$rt_column_layout =isset( $rt_column_layout ) ? $rt_column_layout : 2;

	// crop
	$crop = $image_style != 0 ? true : false ;	

	// Thumbnail width & height
	$w = rt_get_min_resize_size( $rt_column_layout );
	$h = $crop ? $w : 10000;	

	// Get image data
	$image_args = array( 
		"image_url" => $featured_image,
		"image_id" => "",
		"w"=> $w,
		"h"=> $h,
		"crop" => $crop,
	);

	$image_output = rt_get_image_data( $image_args );   
 
	//featured image style
	if( $image_style == 1 ){
		$featured_image_style_class = "rounded_image pin bw_filter";
	}elseif ( $image_style == 2 ) {
		$featured_image_style_class = "rounded_image pin";
	}elseif ( $image_style == 3 ) {
		$featured_image_style_class = "octangle bw_filter";		
	}elseif ( $image_style == 4 ) {
		$featured_image_style_class = "octangle";				
	}else{
		$featured_image_style_class = "";
	}

	//featured image output
	$featured_image_output = "";

	if( ! empty( $featured_image ) ){
		$image_id = isset($featured_image) ? rt_get_attachment_id_from_src($featured_image) : "";   
		$image_alternative_text = get_post_meta($image_id, '_wp_attachment_image_alt', true); 			

		//create img src
		$featured_image_output = ( $text_position == "2" ) ? 
				'<img src="'.$image_output["thumbnail_url"].'" class="aligncenter" alt="'.$image_alternative_text.'" />':
				'<img src="'.$image_output["thumbnail_url"].'" alt="'.$image_alternative_text.'" />';

		//add links to the featured image
		$featured_image_output =  ! empty( $link ) ? '<a href="'.$link.'" title="'.$title.'" target="'.$link_target.'">'.$featured_image_output.'</a>' : $featured_image_output;

		//add holder
		$featured_image_output = '<div class="featured_image_holder '.$featured_image_style_class.'">'.$featured_image_output.'</div>';
	} 

 
	//caption style class
	$caption_style_class ="";  

	if( $text_position == "2" ){
		$caption_style_class = 'title_centered ';
	}

	if( $title_position == "embedded" && ! empty( $featured_image_output )){
		$caption_style_class .= 'embedded ';
	}	 

	if( $icon_style == "2" ){
		$caption_style_class .= 'default_icon squared ';
	} 


	//title position style
	$title_style_class ="";  

	if( $icon && $icon_style > 2 && $text_position == "1" && $title_position != "embedded" ){
		$title_style_class .= 'with_left_icon ';
	} 

	//title with link
	$title_with_link = ! empty( $link ) ? '<a href="'.$link.'" title="'.$title.'" target="'.$link_target.'">'.$title.'</a>' : $title;
	
	//title output
	$title_output = "";
	if( $title ){
		$title_output ='<h3 class="featured_article_title '.$title_style_class.'">'.$icon_output.' '.$title_with_link.'</h3>'; 
	} 



	//caption output
	$caption_output = "";

	if( $featured_image_output ||  $title_output ){

		if( $title_position == "embedded"){
			$caption_output ='<div class="caption '.$caption_style_class.'">'.$featured_image_output.' '.$title_output.'</div>';
		}

		if( $title_position == "after" ){
			$caption_output = $featured_image_output .'<div class="space margin-b20"></div><div class="caption '.$caption_style_class.'">'.$title_output.'</div>';
		} 

		if( $title_position == "before" ){
			$caption_output = '<div class="caption '.$caption_style_class.'">'.$title_output.'</div> <div class="space margin-b10"></div>' .$featured_image_output;
		}

		$caption_output .='<div class="space margin-b20"></div>';

	}

	//text 
	$text = do_shortcode(stripslashes($content));	
 
	if( $text_position == 2 ){ //centered paragraphs
		$changes = array ('<p>' => '<p class="aligncenter">');
		$text = strtr($text, $changes);
	}
 
	//link output
	$link_output = "";

	if ( ! empty( $link ) && ! empty( $link_text ) ) {
		if( $text_position == 2){
			$link_output .= '<a class="read_more centered" href="'.$link.'" title="'.$title.'" target="'.$link_target.'"><span class="icon-angle-right"></span> '.$link_text.'</a>';
		}else{
			$link_output .= '<a class="read_more" href="'.$link.'" title="'.$title.'" target="'.$link_target.'"><span class="icon-angle-right"></span> '.$link_text.'</a>';
		}
	}


	//final output
	$output=""; 
	$output.='<article id="'.$id.'" class="featured" data-rt-animate="animate" data-rt-animation-type="fadeIn" data-rt-animation-group="single">' .$caption_output;
	$output.= $text.''.$link_output;
	$output.='</article>'; 

	return $output; 
	}
}

add_shortcode('content_box', 'rt_content_box');

/*
* ------------------------------------------------- *
*		Content Box With Icon
* ------------------------------------------------- *		
*/ 

if( ! function_exists("rt_content_icon_box") ){
	function rt_content_icon_box( $atts, $content = null ) {
	global $rt_is_template_builder;

	/*
		[content_icon_box 
			id=""
			title="" 
			title_position="" 
			featured_image="" 
			icon="" 
			icon_style="" 
			text_position="" 
			link="" 
			link_text="" 
			link_target=""
			icon_color=""
			icon_bg_color=""
			icon_border_color=""
		][/content_icon_box]
	*/

	//defaults
	extract(shortcode_atts(array(  
		"id"  => 'content-random-'.rand(100000, 1000000), 
		"title" => '', 
		"title_position" => "", 
		"icon" => "",
		"icon_style" => "",
		"text_position" => "",
		"link" => "",
		"link_text" => "",
		"link_target" => "_self",
		"icon_color" => "",
		"icon_bg_color" => "",
		"icon_border_color" => ""
	), $atts));
	

	//icon
	$icon = ! ( $icon_style  == '0' ) ? $icon : "";

	//link target
	$link_target = ! empty( $link_target ) ? $link_target : '_self';

	//icon style
	$icon_style_class = "";

	switch ($icon_style){
		
		case '1':
			$icon_style_class ="default_icon";		
			break;

		case '2':
			$icon_style_class ="default_icon";		
			break;

		case '3':
			$icon_style_class ="big_icon";		
			break;

		case '4':
			$icon_style_class ="big_square_icon";		
			break;

		case '5':
			$icon_style_class ="medium_rounded_icon";		
			break;

		case '6':
			$icon_style_class ="big_rounded_icon";		
			break;

		case '7':
			$icon_style_class ="big_rounded_icon pin";		
			break;			

		default:
			$icon_style_class ="big_icon";
			break;
	}

	if( $text_position == 2){
		$icon_style_class .=" centered";
	}


	//create css for custom icon colors
	$icon_custom_css = "";
	if( ! $rt_is_template_builder ){
		$icon_custom_css .= $icon_color ? "" : "";
		$icon_custom_css .= ! empty( $icon_color ) ? sprintf(' color:%1$s !important;', $icon_color ) : "";
		$icon_custom_css .= ! empty( $icon_bg_color ) ? sprintf(' background-color: %1$s;', $icon_bg_color ) : "";
		$icon_custom_css .= ! empty( $icon_border_color ) ? sprintf(' border-color: %1$s;', $icon_border_color ) : "";
		$icon_custom_css  = ! empty( $icon_custom_css ) ? ' style="'. $icon_custom_css .'" ' : "";
	}

	//title position 
	$title_position = empty( $title_position ) ? "embedded" : $title_position;
 
 	//icon align
 	$icon_align = $text_position == 1 ? "embedded" : "centered"; 

	//icon output 
	$icon_output = "";

	if( $icon){
		if(  $icon_style == 0 || $icon_style == 1 || $icon_style == 2 ){
			$icon_output ='<span class="'.$icon.' '. $icon_align .' '. $title_position .' heading_icon icon-large" '.$icon_custom_css.'></span>'; 
		} 

		if(  $icon_style == 3 || $icon_style == 4 || $icon_style == 5 || $icon_style == 6 || $icon_style == 7 ){
			$icon_output = '<span class="'.$icon_style_class.' '. $icon_align .' '. $title_position .' heading_icon animated '.$icon.' loaded" '.$icon_custom_css.'></span>';		
		}
	}

	//icon output with link
	$icon_output = ! empty( $link ) ? '<a href="'.$link.'" title="'.$title.'" target="'.$link_target.'">'.$icon_output.'</a>' : $icon_output;
 
	//caption style class
	$caption_style_class ="";  

	if( $text_position == "2"  ){
		$caption_style_class = 'title_centered ';
	}

	if( $icon_style == "2" ){
		$caption_style_class .= 'default_icon squared ';
	} 


	//title position style
	$title_style_class ="";  

	if( $icon && $icon_style < 2 && $title_position == "embedded" ){
		$title_style_class .= 'icon-home heading_icon';
	} 


	//title position style
	$title_style_class ="";  

	if( $icon && $title_position == "embedded"  ){
		$title_style_class .= 'with_left_icon ';
	} 

	//title with link
	$title_with_link = ! empty( $link ) ? '<a href="'.$link.'" title="'.$title.'" target="'.$link_target.'">'.$title.'</a>' : $title;
	
	//title output
	$title_output = "";
	if( $title ){
		
		if( $title_position == "embedded" ){
			$title_output ='<h3 class="featured_article_title '.$title_style_class.'">'.$icon_output.' '.$title_with_link.'</h3>'; 
			$icon_output = '';
		}else{
			$title_output ='<h3 class="featured_article_title '.$title_style_class.'">'.$title_with_link.'</h3>'; 
		}
	} 

	//caption output
	$caption_output = "";

	if( $icon_output ||  $title_output ){

		if( $title_position == "embedded" ){
			$caption_output ='<div class="caption '.$caption_style_class.'">'.$icon_output.' '.$title_output.'</div>';
		}

		if( $title_position == "after" ){
			$caption_output = $icon_output .'<div class="space margin-b10"></div> <div class="caption '.$caption_style_class.'">'.$title_output.'</div>';
		} 

		if( $title_position == "before" ){
			$caption_output = '<div class="caption '.$caption_style_class.'">'.$title_output.'</div> <div class="space margin-b10"></div>' .$icon_output;
		}

		$caption_output .='<div class="space margin-b10"></div>';

	}

	//text 
	$text = do_shortcode(stripslashes($content));	
 
	if( $text_position == 2 ){ //centered paragraphs
		$changes = array ('<p>' => '<p class="aligncenter">');
		$text = strtr($text, $changes);
	}
 
	//link output
	$link_output = "";

	if ( ! empty( $link ) && ! empty( $link_text ) ) {
		$link_output .= '<div class="clear margin-b10"></div>';
		if( $text_position == 2){
			$link_output .= '<a class="read_more centered" href="'.$link.'" title="'.$title.'" target="'.$link_target.'"><span class="icon-angle-right"></span> '.$link_text.'</a>';
		}else{
			$link_output .= '<a class="read_more" href="'.$link.'" title="'.$title.'" target="'.$link_target.'"><span class="icon-angle-right"></span> '.$link_text.'</a>';
		}
	}

	//final output
	$output="";
	$output.='<article id="'.$id.'" class="featured" data-rt-animate="animate" data-rt-animation-type="fadeInDown" data-rt-animation-group="single">' .$caption_output;
	$output.= $text.''.$link_output;
	$output.='</article>'; 

	return $output;
	}
}
 
add_shortcode('content_icon_box', 'rt_content_icon_box');

/*
* ------------------------------------------------- *
*		Horizontal Chained Contents
* ------------------------------------------------- *		
*/ 

if( ! function_exists("rt_h_chained_contents") ){
	function rt_h_chained_contents( $atts, $content = null ) {
	global $rt_hc_image_style,$rt_bw_filter;
	/*
		[h_chained_contents 
			id=""
			image_style="" 
			bw_filter = ""
		][/h_chained_contents]
	*/

	//defaults
	extract(shortcode_atts(array(  
		"id"  => 'content-random-'.rand(100000, 1000000), 
		"image_style" => "rounded_image",
		"bw_filter" => ""
	), $atts));
	
	//chained content image style
	$rt_hc_image_style = $image_style;

	//b/w filter
	$rt_bw_filter = ! empty( $bw_filter ) && $bw_filter != "false" ? true : false;

	//output
	$output=""; 
	$output.='<ul id="'.$id.'" class="horizontal_chained_contents" data-rt-animation-group="group">';
	$output.= do_shortcode( $content );
	$output.='</ul>'; 

	return $output; 
	}
}

if( ! function_exists("rt_h_content") ){
	function rt_h_content( $atts, $content = null ) {
	global $rt_hc_image_style,$rt_bw_filter;
	/*
		[h_content 
			id=""
			image="" 
			title="" 
 			link=""  
			link_target=""
		][/h_content]
	*/

	//defaults
	extract(shortcode_atts(array(  
		"id"  => 'item-random-'.rand(100000, 1000000), 
		"image"	=>	"", 
		"title"	=>	"", 
		"link"	=>	"", 
		"link_target" => "_self"
	), $atts));

	//link target
	$link_target = ! empty( $link_target ) ? $link_target : '_self';

	// Thumbnail width & height
	$h = $w = 460;

	// Get image data
	$image_args = array( 
		"image_url" => $image,
		"image_id" => "",
		"w"=> $w,
		"h"=> $h,
		"crop" => "true",
		"class" => "aligncenter"
	); 

	//image output
	$image_output = get_resized_image_output( $image_args );   

	//add links to the featured image
	$image_output =  ! empty( $link ) ? '<a href="'.$link.'" title="'.sanitize_text_field($title).'" target="'.$link_target.'">'.$image_output.'</a>' : $image_output;

	//b/w filter
	$bw_filter  = $rt_bw_filter ? "bw_filter" : "";

	//image section
	$image_section = sprintf('<div class="chanied_media_holder image"><div class="featured_image_holder %3$s %1$s">%2$s</div></div>',$rt_hc_image_style,$image_output,$bw_filter);

	//title with link
	$title =  ! empty( $link ) ? '<a href="'.$link.'" title="'.sanitize_text_field($title).'" target="'.$link_target.'">'.$title.'</a>' :  $title ;

	//title output
	$title_output =  ! empty( $title ) ? '<h3 class="featured_article_title">'.$title.'</h3>' : "" ;

	//content section
	$content_section = sprintf('<div class="chanied_content_holder"> %1$s %2$s</div>',$title_output, do_shortcode($content));	

	//output
	$output = sprintf('<li id="%1$s" data-rt-animate="animate" data-rt-animation-type="fadeInDown"> %2$s %3$s</li>',$id, $image_section, $content_section );	
 
	return $output; 
	}
} 

add_shortcode('h_chained_contents', 'rt_h_chained_contents');
add_shortcode('h_content', 'rt_h_content'); 


/*
* ------------------------------------------------- *
*		Verticaly Chained Media Boxes
* ------------------------------------------------- *		
*/ 

if( ! function_exists("rt_v_chained_media_boxes") ){
	function rt_v_chained_media_boxes( $atts, $content = null ) {
	global $rt_vc_image_style, $rt_vc_image_align, $rt_bw_filter;
	/*
		[v_media_boxes 
			id=""
			image_style="" 
			image_align=""
			bw_filter"=""
		][/v_media_boxes]
	*/

	//defaults
	extract(shortcode_atts(array(  
		"id"  => 'content-random-'.rand(100000, 1000000), 
		"image_style" => "rounded_image",
		"image_align" => "left",
		"bw_filter" => ""
	), $atts));
	
	//chained content image style
	$rt_vc_image_style = $image_style;
	$rt_vc_image_align = $image_align;

	//b/w filter
	$rt_bw_filter = ! empty( $bw_filter ) && $bw_filter != "false" ? true : false;

	//image align class
	$image_align_class = $image_align == "right" ? "right_aligned_media" : "";

	//output
	$output=""; 
	$output.='<section id="'.$id.'" class="chained_contents '.$image_align_class.'" data-rt-animation-group="group"><ul>';
	$output.= do_shortcode( $content );
	$output.='</ul></section>'; 

	return $output; 
	}
}

if( ! function_exists("rt_v_media_box") ){
	function rt_v_media_box( $atts, $content = null ) {
	global $rt_vc_image_style, $rt_vc_image_align, $rt_bw_filter;
	/*
		[v_media_box 
			image="" 
			title="" 
 			link=""  
			link_target=""
		][/v_media_box]
	*/

	//defaults
	extract(shortcode_atts(array(
		"image"	=>	"", 
		"title"	=>	"", 
		"link"	=>	"", 
		"link_target" => "_self"
	), $atts));

	//link target
	$link_target = ! empty( $link_target ) ? $link_target : '_self';

	// Thumbnail width & height
	$h = $w = 460;

	// Get image data
	$image_args = array( 
		"image_url" => $image,
		"image_id" => "",
		"w"=> $w,
		"h"=> $h,
		"crop" => "true",
		"class" => "aligncenter"
	); 

	//image output
	$image_output = get_resized_image_output( $image_args );

	//add links to the featured image
	$image_output =  ! empty( $link ) ? '<a href="'.$link.'" title="'.sanitize_text_field($title).'" target="'.$link_target.'">'.$image_output.'</a>' : $image_output;

	//b/w filter
	$bw_filter  = $rt_bw_filter ? "bw_filter" : "";

	//image section
	$image_section = sprintf('<div class="chanied_media_holder image"><div class="featured_image_holder %1$s %3$s">%2$s</div></div>',$rt_vc_image_style,$image_output,$bw_filter);

	//title with link
	$title =  ! empty( $link ) ? '<a href="'.$link.'" title="'.sanitize_text_field($title).'" target="'.$link_target.'">'.$title.'</a>' :  $title ;

	//title output
	$title_output =  ! empty( $title ) ? '<h3 class="featured_article_title">'.$title.'</h3>' : "" ;

	//content section
	$content_section = sprintf('<div class="chanied_content_holder"> %1$s %2$s</div>',$title_output, do_shortcode($content));	

	//output
	$output = sprintf('<li data-rt-animate="animate" data-rt-animation-type="fadeInDown">%1$s %2$s</li>',$image_section, $content_section );	
 

	return $output; 
	}
} 

add_shortcode('v_media_boxes', 'rt_v_chained_media_boxes');
add_shortcode('v_media_box', 'rt_v_media_box'); 


/*
* ------------------------------------------------- *
*		Verticaly Chained Icon Boxes
* ------------------------------------------------- *		
*/ 

if( ! function_exists("rt_v_chained_icon_boxes") ){
	function rt_v_chained_icon_boxes( $atts, $content = null ) {

	/*
		[v_icon_boxes 
			id=""
			icon_align=""
		][/v_icon_boxes]
	*/

	//defaults
	extract(shortcode_atts(array(  
		"id"  => 'content-random-'.rand(100000, 1000000), 
		"icon_align" => "left"
	), $atts));

	//icon align class
	$icon_align_class = $icon_align == "right" ? "right_aligned_media" : "";

	//output
	$output=""; 
	$output.='<section id="'.$id.'" class="chained_contents icon_chain '.$icon_align_class.'" data-rt-animation-group="group"><ul>';
	$output.= do_shortcode( $content );
	$output.='</ul></section>'; 

	return $output; 
	}
}

if( ! function_exists("rt_v_icon_box") ){
	function rt_v_icon_box( $atts, $content = null ) {

	/*
		[v_icon_box 
			icon="" 
			title="" 
 			link=""  
			link_target=""
		][/v_icon_box]
	*/

	//defaults
	extract(shortcode_atts(array(
		"icon"	=>	"", 
		"title"	=>	"", 
		"link"	=>	"", 
		"link_target" => "_self"
	), $atts));

	//link target
	$link_target = ! empty( $link_target ) ? $link_target : '_self';

	//icon output
	$icon_output = sprintf('<span class="%s"></span>',$icon);

	//add links to the icon
	$icon_output =  ! empty( $link ) ? '<a href="'.$link.'" title="'.sanitize_text_field($title).'" target="'.$link_target.'">'.$icon_output.'</a>' : $icon_output;

	//icon section
	$icon_section = sprintf('<div class="chanied_media_holder icon"><div class="icon_holder rounded">%1$s</div></div>',$icon_output);

	//title with link
	$title =  ! empty( $link ) ? '<a href="'.$link.'" title="'.sanitize_text_field($title).'" target="'.$link_target.'">'.$title.'</a>' :  $title ;

	//title output
	$title_output =  ! empty( $title ) ? '<h3 class="featured_article_title">'.$title.'</h3>' : "" ;

	//content section
	$content_section = sprintf('<div class="chanied_content_holder"> %1$s %2$s</div>',$title_output, do_shortcode($content));	

	//output
	$output = sprintf('<li data-rt-animate="animate" data-rt-animation-type="fadeInDown">%1$s %2$s</li>', $icon_section, $content_section );	
 

	return $output; 
	}
} 

add_shortcode('v_icon_boxes', 'rt_v_chained_icon_boxes');
add_shortcode('v_icon_box', 'rt_v_icon_box'); 

/*
* ------------------------------------------------- *
*		Content Box
* ------------------------------------------------- *		
*/ 

if( ! function_exists("rt_text_box") ){
	function rt_text_box( $atts, $content = null ) {

	/*
		[text_box 
			id="" 
		]text[/text_box]
	*/

	extract( $atts );  

	//id
	$id = ! empty( $id ) ? $id : 'text-random-'.rand(100000, 1000000) ;
 
	//text 
	$text = do_shortcode(stripslashes($content));	
  
	//final output
	$output="";
	$output.='<section id="'.$id.'" class="text_box" data-rt-animate="animate" data-rt-animation-type="fadeIn" data-rt-animation-group="single">';
	$output.= $text;
	$output.='</section>'; 

	return $output;
	}
}

add_shortcode('text_box', 'rt_text_box');

/*
* ------------------------------------------------- *
*		Header Content Rows 
* ------------------------------------------------- *		
*/ 
if( ! function_exists("rt_header_content_row") ){
	function rt_header_content_row( $atts, $content = null ) { 
	global $rt_breadcrumb_position;
	
	//extract vars
	extract($atts);
	
	//content section 
	$header_content = do_shortcode( $content ); 

	return $header_content;
	}
}	

add_shortcode('header', 'rt_header_content_row'); 

/*
* ------------------------------------------------- *
*		Footer Content Rows 
* ------------------------------------------------- *		
*/ 
if( ! function_exists("rt_footer_content_row") ){
	function rt_footer_content_row( $atts, $content = null ) { 
	
	//extract vars
	extract($atts);
	
	//content section
	$footer_content = do_shortcode( $content ); 

	return $footer_content;
	}
}	

add_shortcode('footer', 'rt_footer_content_row'); 


/*
* ------------------------------------------------- *
*		Content Rows		
* ------------------------------------------------- *		
*/ 
if( ! function_exists("rt_content_row") ){
	function rt_content_row( $atts, $content = null ) { 
	global $rt_sidebar_location, $rt_is_template_builder, $rt_sidebar_counter;

	//extract vars
	extract($atts);	

	//sidebar counter
	$rt_sidebar_counter = $rt_sidebar_counter == "" ? 0 : $rt_sidebar_counter;

	//content location 
	if( $sidebar_selection != "full" ){
		$content_location =  ( $sidebar_selection == "left" ) ? "right" : "left";
	}else{
		$content_location = "full";
	}

	//the sidebar location array for global output
	$rt_sidebar_location = $rt_is_template_builder ? array($content_location, $sidebar_selection) : $rt_sidebar_location;

	//add class to content section
	$add_class = ( $content_location == "full" ) ? " clearfix" : "";  

	//special paddings for boxes
	$paddings = isset( $paddings ) ? $paddings : "";
	$add_class .= ( $paddings == true ) ? " extra_paddings" : "";   

	//get row style
	$full_width_row   = isset( $full_width_row ) ? $full_width_row : "";
	$add_holder_class = $full_width_row == "true" ? " full_width_row ": "";

	//the row class
	$add_holder_class .= $class;

	//custom css class
	$add_holder_class .= isset( $css_class ) ? " ".$css_class : "";	

	//parallax settings
	$parallax_settings = array(
				"1"=> array( "effect" => "horizontal", "direction" => -1),
				"2"=> array( "effect" => "horizontal", "direction" => 1),
				"3"=> array( "effect" => "vertical", "direction" => -1),
				"4"=> array( "effect" => "vertical", "direction" => 1),
				);

	//the output

	//parallax background
	$parallax_background = isset( $parallax_background ) && isset( $background_image_url ) && $parallax_background != "disabled_parallax" && !empty( $background_image_url ) ? '<div id="'. $id .'-parallax" class="rt-parallax-background" data-rt-parallax-direction="'. $parallax_settings[$parallax_background]["direction"] .'" data-rt-parallax-effect="'. $parallax_settings[$parallax_background]["effect"] .'" data-rt-background-image="'. $background_image_url .'"></div>' : "";

	if( $rt_is_template_builder ){
		//open holder
		echo sprintf('<div id="%s" class="content_block_background template_builder %s"> %s
			<section class="content_block clearfix">',$id, trim($add_holder_class), $parallax_background );  

			//open content section
			echo sprintf('<section id="%s-content" class="content %s %s">',$id, $content_location,$add_class); 

				//get info bar (breadcrumb and page title )	
				if( $row_counter == 1 ){
					echo do_action( "get_info_bar", apply_filters( 'get_info_bar_template_builder', array( "called_for" => "inside_content" )));			  
				}

				//content
				echo do_shortcode( $content ); 

			//close content section
			echo '</section>';
	 
			//sidebar section
			if( $sidebar_selection != "full" ){

				echo sprintf('<section id="%s-sidebar" class="sidebar %s %s">',$id, $sidebar_selection,  apply_filters("floating_sidebars","") );  	  			 

					if( $rt_sidebar_counter == 0 ){
						//get project details  
						do_action( "get_project_details");

						//get post navigation
						do_action( "get_post_navigation"); 
					}

					if( ! empty( $sidebar_id ) ){
						foreach ( explode(",", $sidebar_id) as $key => $value) {
							dynamic_sidebar($value);
						}
					}

				echo '</section>';

				$rt_sidebar_counter++;
			}

		//close holder
		echo '</section></div>';
		}else{
			//content
			echo do_shortcode( $content ); 			
		}
	}

}	

add_shortcode('row', 'rt_content_row'); 

/*
* ------------------------------------------------- *
*		Widget Caller
* ------------------------------------------------- *
*/
if( ! function_exists("rt_widget_caller") ){
	function rt_widget_caller($atts, $content = null){
	//[widget_caller id="sidebarid_37036"]

	//defaults
	extract(shortcode_atts(array(  
		"id" => ''
	), $atts));
	
	ob_start();

	 //check id
	if(!empty($id)){
		dynamic_sidebar($id);
	}
	
	$output_string = ob_get_contents();
	ob_end_clean(); 

	return $output_string;
	}
}	

add_shortcode('widget_caller', 'rt_widget_caller');

/*
* ------------------------------------------------- *
*		Horizontal Line		
* ------------------------------------------------- *		
*/ 
if( ! function_exists("rt_horizontal_line") ){
	function rt_horizontal_line( $atts, $content = null ) { 

	//defaults
	extract(shortcode_atts(array(  
		"style"  => '1', 
		"margin_top" => '0', 
		"margin_bottom" => '0', 
	), $atts));
	
	$styles = array("1"=>"one","2"=>"two","3"=>"three","4"=>"four","5"=>"five","6"=>"six","7"=>"seven","8"=>"eight");
	$horizontal_line = '<hr class="style-'.$styles[$style].' margin-t'.$margin_top.' margin-b'.$margin_bottom.' "  data-rt-animate="animate" data-rt-animation-type="fadeInDown" data-rt-animation-group="single" >';	 
	return $horizontal_line;
	}
}	

add_shortcode('horizontal_line', 'rt_horizontal_line'); 


/*
* ------------------------------------------------- *
*		Columns	
* ------------------------------------------------- *		
*/ 

//single column
if( ! function_exists("rt_columns") ){
	function rt_columns( $atts, $content = null ) { 
	global $rt_column_layout;

	//defaults
	extract(shortcode_atts(array(  
		"layout"  => 'one', 
	), $atts));

	//for global referance 
	$layout_values = array('one' => 1, 'two' => 2, 'three' => 3, 'four' => 4, 'five' => 5);
	$rt_column_layout = isset( $layout_values[$layout] ) ? $layout_values[$layout] : 1;
	

	$add_class = empty( $content ) ? "blank_box" : "";

	$colum = sprintf('<div class="box %s %s">%s</div>',$layout,$add_class, do_shortcode( $content ) ); 
	return $colum;	 
	}
}

add_shortcode('column', 'rt_columns'); 
add_shortcode('rt_column', 'rt_columns'); 


//columns holder
if( ! function_exists("rt_columns_holder") ){
	function rt_columns_holder( $atts, $content = null ) { 
 
	$columns = sprintf('<div class="row clearfix">%s</div>', do_shortcode( $content ) ); 
	return $columns;	 
	}
}

add_shortcode('columns', 'rt_columns_holder'); 
add_shortcode('rt_columns', 'rt_columns_holder'); 

/*
* ------------------------------------------------- *
*		Blog Posts	
* ------------------------------------------------- *		
*/ 

if( ! function_exists("rt_blogs") ){
	function rt_blogs( $atts, $content = null ) { 
	global $rt_list_style, $rt_pagination, $paged; 

	//defaults
	extract(shortcode_atts(array(  
		"pagination" => "false",
		"list_orderby" => "date",
		"list_order" => "DESC",
		"item_per_page"=> 9,
		"list_style" => "style1",
		"list_layout" => "one",
		"categories" => "", 
	), $atts));

	//list style
	$rt_list_style = $list_style;

	//layout name values
	$layout_values = array('one' => 1, 'two' => 2, 'three' => 3, 'four' => 4, 'five' => 5);

	//additional class for columns smaller than one
	$add_class = ( $list_layout != "one" ) ? "small_box" : "";

	//pagination
	$pagination = $pagination == "false" ? false : $pagination;

	//global values for posts
	$rt_pagination = $pagination; 


	if( ! empty( $pagination ) ){
		if (get_query_var('paged') ) {$paged = get_query_var('paged');} elseif ( get_query_var('page') ) {$paged = get_query_var('page');} else {$paged = 1;}
	}else{
		$paged=0;
	} 	 

	//create a post status array
	$post_status = is_user_logged_in() ? array( 'private', 'publish' ) : "publish";

	//general query
	$args=array( 
		'post_status'    =>	$post_status,
		'post_type'      =>	'post',
		'orderby'        =>	$list_orderby,
		'order'          =>	$list_order,
		'posts_per_page' =>	$item_per_page,
		'paged'          => $paged, 
		'cat'            =>	$categories,
	);
 
	ob_start();

	$the_query = new WP_Query($args);

	if ( $the_query->have_posts() ){ 	
		do_action( "blog_post_loop", $the_query, $list_layout );
	}
		
	$output_string = ob_get_contents();

	ob_end_clean(); 	

	return $output_string;
	}
}

add_shortcode('blog_box', 'rt_blogs'); 



/*
* ------------------------------------------------- *
*		Portfolio Posts	
* ------------------------------------------------- *		
*/ 

if( ! function_exists("rt_portfolio") ){
	function rt_portfolio( $atts, $content = null ) { 
	//[portfolio_box id="" item_width="5" pagination="" portf_list_orderby="" portf_list_order="" item_per_page="9" filterable="" categories="" display_descriptions ="" display_titles ="" display_embedded_titles =""]	
	global $rt_item_width, $post, $wp_query, $rt_display_descriptions, $rt_display_titles, $rt_display_embedded_titles, $paged;
	$sortNavigation = $filter_holder = "";

	//counter
	$counter = 1;	

	//defaults
	extract(shortcode_atts(array(  
		"id"  => 'portfolio-'.rand(100000, 1000000), 
		"item_width"  => 4, 
		"pagination" => "",
		"portf_list_orderby" => "date",
		"portf_list_order" => "DESC",
		"item_per_page"=> 9,
		"filterable" => "false",
		"categories" => "",
		"display_descriptions" => true,
		"display_titles" => true,
		"display_embedded_titles" => false		
	), $atts));


	//item width 
	$item_width = ! empty( $item_width ) ? $item_width : 4;

	//pagination
	$pagination = $pagination == "false" ? false : $pagination;	

	//filters
	$filterable = $filterable == "false" ? false : $filterable;

	//displays
	$display_embedded_titles = $display_embedded_titles == "false" ? "" : $display_embedded_titles;
	$display_titles = $display_titles == "false" ? "" : $display_titles;
	$display_descriptions = $display_descriptions == "false" ? "" : $display_descriptions;

	//categories - turn into an array
	$categories = ! empty( $categories ) ? explode(",", $categories) : "";  

	//global values for portfolio items
	$rt_item_width = $item_width;
	$rt_display_descriptions = $display_descriptions;
	$rt_display_titles = $display_titles;
	$rt_display_embedded_titles  = $display_embedded_titles;

	//add scripts and nav if filterable
	if( ! empty( $filterable ) ){

 
		wp_enqueue_script('isotope-js', RT_THEMEURI  . '/js/jquery.isotope.min.js',  array(), "", true ); 	 	
		wp_enqueue_script('rt-run-isotope', RT_THEMEURI  . '/js/rt_isotope.js',  array(), "", true ); 	 	

		//js script to run
		printf('
			<script type="text/javascript">
			 /* <![CDATA[ */ 
				// run isotope
					jQuery(window).load(function() { 
						jQuery("#%s").rt_run_isotope();
					}); 
			/* ]]> */	
			</script>
		',$id);					
 

		if( ! empty( $categories ) ){  
			if(is_array($categories)){ 
				foreach ($categories as $arrayorder => $termID) { 
					$sortCategories = get_term_by('id', $termID, 'portfolio_categories');
					$sortNavigation  .= '<li><a href="#" data-filter=".filter-'.$sortCategories->term_taxonomy_id.'">'.$sortCategories->name.'</a></li>';
				}
			}  

		}else{
			$sortCategories  = get_terms( 'portfolio_categories', 'orderby=name&hide_empty=1&order=ASC' );
			$sortCategories  = is_array($sortCategories) ? $sortCategories : "";

			foreach ($sortCategories as $key => $term) {
				$sortNavigation  .= '<li><a data-filter=".filter-'.$term->term_taxonomy_id.'">'.$term->name.'</a></li>';
			}	
		}
 
		$filter_holder = ! empty( $sortNavigation ) ? sprintf('<div class="filter-holder"><ul class="filter_navigation">%s %s</ul></div>','<li><a href="#" data-filter="*" class="active animate">'.__("show all","rt_theme").'</a></li>',$sortNavigation) : "";

	}
	
	//layout name values
	$layout_values = array('','one', 'two', 'three', 'four', 'five');

	//paged
	if( $pagination ){		
		if (get_query_var('paged') ) {$paged = get_query_var('paged');} elseif ( get_query_var('page') ) {$paged = get_query_var('page');} else {$paged = 1;}
	}else{
		$paged=0;
	} 	 	


	//create a post status array
	$post_status = is_user_logged_in() ? array( 'private', 'publish' ) : "publish";

	//general query
	$args=array( 
		'post_status'    =>	$post_status,
		'post_type'      =>	'portfolio',
		'orderby'        =>	$portf_list_orderby,
		'order'          =>	$portf_list_order,
		'posts_per_page' =>	$item_per_page,
		'paged'          => $paged																	
	);
 
	if( ! empty ( $categories ) ){
		$args = array_merge($args, array( 

			'tax_query' => array(
					array(
						'taxonomy' =>	'portfolio_categories',
						'field'    =>	'id',
						'terms'    =>	$categories,
						'operator' => 	"IN"
					)
				),	

		) );
	} 


	ob_start();

	$theQuery = query_posts($args);


	//add class
	$add_class = "";

	//get page & post counts
	$page_count = rt_get_page_count();
	$post_count = $page_count['post_count']; 

	
	//add holder class
	$add_holder_class = ! empty( $filterable ) ? "filterable" : "";

	echo '<div id="'.$id.'" class="portfolio_holder clearfix '.$add_holder_class.' " data-rt-animate="animate" data-rt-animation-type="fadeIn" data-rt-animation-group="single">';

	echo $filter_holder;

	echo '<ul class="portfolio_boxes fluid fixed" data-filter="'.$item_width.'">';

		while ( have_posts() ) : the_post();

			//get post format
			$portfolio_format = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_portfolio_post_format', true);
 

			//add first last classes if filterable is off 
			$add_class = "";

			if( $counter % $item_width == 1 || $item_width == 1 ){
				$add_class .= " first";
			}

			if( ( $counter % $item_width == 0 || $post_count == $counter ) && $add_class == "" ){
				$add_class .= " last";
			}
			
			//  selected term list of each post
			$term_list = get_the_terms($post->ID, 'portfolio_categories');

			//add terms as class name
			$addTermsClass = $filter_ids = "";
			if($term_list){
				if(is_array($term_list)){
					foreach ($term_list as $termSlug) {
						$addTermsClass .= " ". sanitize_html_class($termSlug->slug);

						$filter_ids .= ! empty( $filterable ) ? " filter-".$termSlug->term_taxonomy_id : "";
				
					}
				}
			}

			printf('<li class="box %s %s %s %s"><div class="portfolio_item_holder">'."\n",$layout_values[$item_width],$add_class,$addTermsClass, $filter_ids);
				get_template_part( 'portfolio-contents/content', $portfolio_format ); 
			echo '</div></li>'."\n";

			$counter++;
		endwhile; 

	echo '</ul></div>';


	if( $pagination ){
		rt_get_pagination( $wp_query );	
	} 

	wp_reset_query(); 
		
	$output_string = ob_get_contents();

	ob_end_clean(); 



	return $output_string;
	}
 }

add_shortcode('portfolio_box', 'rt_portfolio'); 



/*
* ------------------------------------------------- *
*		Product Posts	
* ------------------------------------------------- *		
*/ 

if( ! function_exists("rt_products") ){
	function rt_products( $atts, $content = null ) { 
	//[product_box id="" item_width="5" pagination="" list_orderby="" list_order="" item_per_page="9" categories="" ids="" display_descriptions="%s" display_titles="%s" display_price="%s" no_top_border="" no_bottom_border=""]
	global $rt_item_width,$wp_query,$rt_display_descriptions, $rt_display_price, $rt_display_titles, $paged;

	//counter
	$counter = 1;	

	//defaults
	extract(shortcode_atts(array(  
		"id"  => 'products-'.rand(100000, 1000000), 
		"heading"  => "", 
		"item_width"  => 4, 
		"pagination" => "",
		"list_orderby" => "date",
		"list_order" => "DESC",
		"item_per_page"=> 9,
		"categories" => "",
		"display_descriptions" => "",
		"display_titles" => "",
		"display_price" => "", 
		'with_borders'	=> "",
		'with_effect'	=> "", 
		"no_top_border" => "",
		"ids" => "",
		"no_bottom_border" => ""
	), $atts));


	//product id numbders
	$ids = ! empty( $ids ) ? explode(",", trim( $ids ) ) : array();

	//categories - turn into an array
	$categories = ! empty( $categories ) ? explode(",", $categories) : "";

	//item width 
	$item_width = ! empty( $item_width ) ? $item_width : 4;

	//layout name values
	$layout_values = array('','one', 'two', 'three', 'four', 'five');

	//pagination
	$pagination = $pagination == "false" ? false : $pagination;	

	//global values for product items
	$rt_item_width = $item_width;
	$rt_display_descriptions = $display_descriptions;
	$rt_display_titles = $display_titles; 
	$rt_display_price  = $display_price;

	//paged
	if($pagination){
		if (get_query_var('paged') ) {$paged = get_query_var('paged');} elseif ( get_query_var('page') ) {$paged = get_query_var('page');} else {$paged = 1;} 
	}else{
		$paged=0;
	}

	//create a post status array
	$post_status = is_user_logged_in() ? array( 'private', 'publish' ) : "publish";

	//general query
	$args=array( 
		'post_status'    =>	$post_status,
		'post_type'      =>	'products',
		'orderby'        =>	$list_orderby,
		'order'          =>	$list_order,
		'posts_per_page' =>	$item_per_page,
		'paged'          => $paged

	);


	if( ! empty ( $ids ) ){
		$args = array_merge($args, array( 'post__in'  => $ids) );
	}

	if( ! empty ( $categories ) ){
		$args = array_merge($args, array( 

			'tax_query' => array(
					array(
						'taxonomy' =>	'product_categories',
						'field'    =>	'id',
						'terms'    =>	$categories,
						'operator' => 	"IN"
					)
				),	

		) );
	} 
	 
	ob_start();
 
	$theQuery  = new WP_Query($args); 

	//add class
	$add_class = "";

	//get page & post counts
	$post_count = $theQuery->post_count;  
	
	//add holder class
	$add_holder_class = "";

	//add row class
	$add_row_class = "";

	//with borders
	$add_row_class .= $with_borders ? " with_borders fluid" : "" ;

	//with effects
	$add_row_class .= $with_effect ? " with_effect" : "" ;
	
	//remove top & bottom borders of grid
	$add_row_class .= $no_top_border ? " no_top_border" : "" ; 
	$add_row_class .= $no_bottom_border ? " no_bottom_border" : "" ; 


	//items at the first row
	$first_row = "first-row";

	$last_row = "";

	echo '<div id="'.$id.'" class="product_holder product-showcase clearfix '.$add_holder_class.' ">';

	echo '<div class="product_boxes" data-rt-animation-group="group">';


		if( ! empty( $heading ) && $with_borders ){

			//open row block
			if( $counter == 1 ){ 
				echo '<div class="row clearfix '.$add_row_class.'">';
			}

			printf('<div class="box %s %s first-row grid-title">'."\n",$layout_values[$item_width],"first");
				echo '<h3 class="grid_title">'.$heading.'</h3>';
				$counter++;
				$post_count++;
			echo '</div>'."\n";
		}

		while ( $theQuery->have_posts() ) : $theQuery->the_post();


			//add first last classes if filterable is off 
			$add_class = "";			

			if( $counter % $item_width == 1 || $item_width == 1 ){
				$add_class .= " first";

				$first_row = $first_row == "first-row" && $counter != 1 ? "" : $first_row; //add first row clas to boxes 

				$last_row = $post_count - $counter < $item_width ? "last-row" : ""; //add last row clas to boxes 
			}

			if( ( $counter % $item_width == 0 || $post_count == $counter ) ){
				$add_class .= " last";								
			}
			
			//  selected term list of each post
			$term_list = get_the_terms($theQuery->post->ID, 'product_categories');
			
			//add terms as class name
			$addTermsClass = "";
			if($term_list){
				if(is_array($term_list)){
					foreach ($term_list as $termSlug) {
						$addTermsClass .= " ". $termSlug->slug;
					}
				}
			}

			//open row block
			if( $with_borders && $counter == 1 ){ 
				//echo '<div class="row clearfix '.$add_row_class.'">';
			}

			if(  $counter % $item_width == 1 || $item_width == 1 ){
				echo '<div class="row clearfix '.$add_row_class.'">';
			}	


			printf('<div class="box %s %s %s %s %s"><div class="product_item_holder" data-rt-animate="animate" data-rt-animation-type="fadeIn">'."\n",$layout_values[$item_width],$add_class,$first_row,$last_row,$addTermsClass);
				get_template_part( 'product-contents/content' ); 				
			echo '</div></div>'."\n";

			//close row block and add hr  
			if( $counter % $item_width == 0 || $post_count == $counter ){
				echo '</div>';  
			}	  

			if( $pagination && $post_count == $counter  ){		 
				echo '<hr class="style-four">';
			}									

			$counter++;

		endwhile; 

	echo '</div></div>';
	
	if( $pagination ){
		rt_get_pagination( $theQuery );	
	} 

	wp_reset_query(); 
		
	$output_string = ob_get_contents();

	ob_end_clean(); 

	return $output_string;
	}
 }

add_shortcode('product_box', 'rt_products'); 

/*
* ------------------------------------------------- *
*		WooCommerce Product Posts	
* ------------------------------------------------- *		
*/ 

if( ! function_exists("rt_woo_products") ){
	function rt_woo_products( $atts, $content = null ) { 
	//[woo_products id="" item_width="5" pagination="" list_orderby="" list_order="" item_per_page="9" categories="" ids="" display_descriptions="%s" display_titles="%s" display_price="%s" no_top_border="" no_bottom_border=""]
	global $rt_item_width,$wp_query,$rt_display_descriptions, $rt_display_price, $rt_display_titles, $paged;

	//counter
	$counter = 1;	

	//defaults
	extract(shortcode_atts(array(  
		"id"  => 'woo-products-'.rand(100000, 1000000), 
		"heading"  => "", 
		"item_width"  => 4, 
		"pagination" => "",
		"list_orderby" => "date",
		"list_order" => "DESC",
		"item_per_page"=> 9,
		"categories" => "",
		"display_descriptions" => "",
		"display_titles" => "",
		"display_price" => "", 
		'with_borders'	=> true,
		'with_effect'	=> "", 
		"no_top_border" => "",
		"ids" => "",
		"no_bottom_border" => ""
	), $atts));


	//product id numbders
	$ids = ! empty( $ids ) ? explode(",", trim( $ids ) ) : array();

	//categories - turn into an array
	$categories = ! empty( $categories ) ? explode(",", $categories) : "";

	//item width 
	$item_width = ! empty( $item_width ) ? $item_width : 4;

	//layout name values
	$layout_values = array('','one', 'two', 'three', 'four', 'five');

	//pagination
	$pagination = $pagination == "false" ? false : $pagination;	

	//global values for product items
	$rt_item_width = $item_width;
	$rt_display_descriptions = $display_descriptions;
	$rt_display_titles = $display_titles; 
	$rt_display_price  = $display_price;

	//paged
	if($pagination){
		if (get_query_var('paged') ) {$paged = get_query_var('paged');} elseif ( get_query_var('page') ) {$paged = get_query_var('page');} else {$paged = 1;} 
	}else{
		$paged=0;
	}

	//create a post status array
	$post_status = is_user_logged_in() ? array( 'private', 'publish' ) : "publish";

	//general query
	$args=array( 
		'post_status'    =>	$post_status,
		'post_type'      =>	'product',
		'ignore_sticky_posts'	=> 1,
		'orderby'        =>	$list_orderby,
		'order'          =>	$list_order,
		'posts_per_page' =>	$item_per_page,
		'paged'          => $paged,
		'meta_query' 			=> array(
			array(
				'key' 			=> '_visibility',
				'value' 		=> array('catalog', 'visible'),
				'compare' 		=> 'IN'
			)
		)
	);

	if( ! empty ( $ids ) ){
		$args = array_merge($args, array( 'post__in'  => $ids) );
	}

	if( ! empty ( $categories ) ){
		$args = array_merge($args, array( 

			'tax_query' => array(
					array(
						'taxonomy' =>	'product_cat',
						'field'    =>	'slug',
						'terms'    =>	$categories,
						'operator' => 	"IN"
					)
				),	

		) );
	} 
	 
	ob_start();
 
	$theQuery  = new WP_Query($args); 

	//add class
	$add_class = "";

	//get page & post counts
	$post_count = $theQuery->post_count;  
	
	//add holder class
	$add_holder_class = "";

	//add row class
	$add_row_class = "";

	//with borders
	$add_row_class .= $with_borders ? " with_borders fluid" : "" ;

	//with effects
	$add_row_class .= $with_effect ? " with_effect" : "" ;
	
	//remove top & bottom borders of grid
	$add_row_class .= $no_top_border ? " no_top_border" : "" ; 
	$add_row_class .= $no_bottom_border ? " no_bottom_border" : "" ; 


	//items at the first row
	$first_row = "first-row";

	$last_row = "";

	echo '<div id="'.$id.'" class="product_holder clearfix '.$add_holder_class.' ">';

	echo '<div class="product_boxes woocommerce" data-rt-animation-group="group">';


		if( ! empty( $heading ) && $with_borders ){

			//open row block
			if( $counter == 1 ){ 
				echo '<div class="row clearfix '.$add_row_class.'">';
			}

			printf('<div class="box %s %s first-row grid-title">'."\n",$layout_values[$item_width],"first");
				echo '<h3 class="grid_title">'.$heading.'</h3>';
				$counter++;
				$post_count++;
			echo '</div>'."\n";
		}

		while ( $theQuery->have_posts() ) : $theQuery->the_post();


			//add first last classes if filterable is off 
			$add_class = "";			

			if( $counter % $item_width == 1 || $item_width == 1 ){
				$add_class .= " first";

				$first_row = $first_row == "first-row" && $counter != 1 ? "" : $first_row; //add first row clas to boxes 

				$last_row = $post_count - $counter < $item_width ? "last-row" : ""; //add last row clas to boxes 
			}

			if( ( $counter % $item_width == 0 || $post_count == $counter ) ){
				$add_class .= " last";								
			}
			
			//  selected term list of each post
			$term_list = get_the_terms($theQuery->post->ID, 'product_cat');
			
			//add terms as class name
			$addTermsClass = "";
			if($term_list){
				if(is_array($term_list)){
					foreach ($term_list as $termSlug) {
						$addTermsClass .= " ". $termSlug->slug;
					}
				}
			}

			//open row block
			if( $with_borders && $counter == 1 ){ 
				//echo '<div class="row clearfix '.$add_row_class.'">';
			}

			if(  $counter % $item_width == 1 || $item_width == 1 ){
				echo '<div class="row clearfix '.$add_row_class.'">';
			}	


			printf('<div class="box %s %s %s %s %s"><div class="product_item_holder" data-rt-animate="animate" data-rt-animation-type="fadeIn">'."\n",$layout_values[$item_width],$add_class,$first_row,$last_row,$addTermsClass);
				get_template_part( 'woocommerce/shortcode-content','product'); 		
			echo '</div></div>'."\n";

			//close row block and add hr  
			if( $counter % $item_width == 0 || $post_count == $counter ){
				echo '</div>';  
			}	  

			if( $pagination && $post_count == $counter  ){		 
				echo '<hr class="style-four">';
			}									

			$counter++;

		endwhile; 

	echo '</div></div>';
	
	if( $pagination ){
		rt_get_pagination( $theQuery );	
	} 

	wp_reset_query();  

	return ob_get_clean();
	}
 }

add_shortcode('woo_products', 'rt_woo_products'); 

/*
* ------------------------------------------------- *
*		Products Carousel
* ------------------------------------------------- *
*/

if( ! function_exists("rt_products_carousel") ){
	function rt_products_carousel( $atts, $content = null ) {
	//[product_carousel id="" heading="" heading_icon="" item_width="5" list_orderby="" list_order="" max_item="9" categories="" product_ids=""]
	global $rt_item_width,$rt_crop,$rt_display_titles;

	//enqueue script files
	wp_enqueue_script('jquery-owl-carousel', RT_THEMEURI . '/js/owl.carousel.min.js', array(), "", false ); 	

	//counter
	$counter = 1;	

	//defaults
	extract(shortcode_atts(array(  
		"id"  => 'product-carousel-'.rand(100000, 1000000), 
		"heading" => "",
		"heading_icon" => "",
		"item_width"  => 4, 
		"list_orderby" => "date",
		"list_order" => "DESC",
		"max_item"=> 100,
		"categories" => "",
		"ids" => array(),
		"style" => "",
		"crop" => "on",
	), $atts));


	//product id numbders
	$ids = ! empty( $ids ) ? explode(",", trim( $ids ) ) : array();

	//categories - turn into an array
	$categories = ! empty( $categories ) ? explode(",", $categories) : "";  

	//item width 
	$item_width = ! empty( $item_width ) ? $item_width : 4;

	//layout name values
	$layout_values = array('','one', 'two', 'three', 'four', 'five');

	//crop
	$crop = $crop == "false" ? false : $crop;	


	//global values for product items
	$rt_item_width = $item_width; 
	$rt_crop  = $crop;


	//create a post status array
	$post_status = is_user_logged_in() ? array( 'private', 'publish' ) : "publish";

	//general query
	$args=array( 
		'post_status'    =>	$post_status,
		'post_type'      =>	'products',
		'orderby'        =>	$list_orderby,
		'order'          =>	$list_order,
		'showposts' 	 =>	$max_item
	);


	if( ! empty ( $ids ) ){
		$args = array_merge($args, array( 'post__in'  => $ids) );
	}

	if( ! empty ( $categories ) ){
		$args = array_merge($args, array( 

			'tax_query' => array(
					array(
						'taxonomy' =>	'product_categories',
						'field'    =>	'id',
						'terms'    =>	$categories,
						'operator' => 	"IN"
					)
				),	

		) );
	} 
	 
	ob_start();

	$theQuery = query_posts($args);


	//add class
	$add_class = "";

	//get page & post counts
	$page_count = rt_get_page_count();
	$post_count = $page_count['post_count']; 


	//add holder class
	$add_holder_class = $style."_holder";
	$add_holder_class .= empty( $heading ) ? " without_heading" : " with_heading";



	echo '<div class="row clearfix">';

	echo ! empty( $heading ) ? do_shortcode ( '[heading_bar heading="'.$heading.'" icon="'.$heading_icon.'" ]' ) : "";

	echo '<div id="'.$id.'" class="carousel-holder clearfix '.$add_holder_class.' "  data-rt-animation-group="single" data-rt-animation-type="fadeIn" data-rt-animate="animate">';
 
	echo '<section class="carousel_items"><div class="owl-carousel">';

		while ( have_posts() ) : the_post();

			echo '<div class="product_item_holder item product">'."\n";
				get_template_part( 'product-contents/content','carousel'); 				
			echo '</div>'."\n";
 
			$counter++;

		endwhile; 

	echo '</div></section></div></div>';

	//js script to run
	printf('
		<script type="text/javascript">
		 /* <![CDATA[ */ 
			// run carousel
				jQuery(document).ready(function() { 
					 jQuery("#%1$s").rt_start_carousels(%2$s,"%3$s");
				}); 
		/* ]]> */	
		</script>
	',$id,$item_width,$style);		


	wp_reset_query(); 
		
	$output_string = ob_get_contents();

	ob_end_clean(); 

	return $output_string;
	}
}

add_shortcode('product_carousel', 'rt_products_carousel'); 


/*
* ------------------------------------------------- *
*		Portfolio Carousel
* ------------------------------------------------- *
*/

if( ! function_exists("rt_portfolio_carousel") ){
	function rt_portfolio_carousel( $atts, $content = null ) {
	//[portfolio_carousel id="" heading="" heading_icon="" item_width="5" list_orderby="" list_order="" max_item="9" categories="" product_ids="" ]
	global $rt_item_width,$rt_crop,$rt_display_titles,$rt_display_descriptions;

	//enqueue script files
	wp_enqueue_script('jquery-owl-carousel', RT_THEMEURI . '/js/owl.carousel.min.js', array(), "", false ); 	 

	//counter
	$counter = 1;	

	//defaults
	extract(shortcode_atts(array(  
		"id"  => 'portfolio-carousel-'.rand(100000, 1000000), 
		"heading" => "",
		"heading_icon" => "",
		"item_width"  => 4, 
		"list_orderby" => "date",
		"list_order" => "DESC",
		"max_item"=> 100,
		"categories" => "",
		"ids" => array(),
		"style" => "",
		"crop" => "on",
		"display_titles" => "",
		"display_descriptions" => "",
	), $atts));


	//product id numbders
	$ids = ! empty( $ids ) ? explode(",", trim( $ids ) ) : array();
	
	//item width 
	$item_width = ! empty( $item_width ) ? $item_width : 4;

	//categories - turn into an array
	$categories = ! empty( $categories ) ? explode(",", $categories) : "";  
 
	//layout name values
	$layout_values = array('','one', 'two', 'three', 'four', 'five');

	//crop
	$crop = $crop == "false" ? false : $crop;	

	//display titles
	$display_titles = $display_titles == "false" ? false : $display_titles;	

	//display descriptions
	$display_descriptions = $display_descriptions == "false" ? false : $display_descriptions;	

	//global values for portfolio items
	$rt_item_width = $item_width;
	$rt_display_descriptions = $display_descriptions;
	$rt_display_titles = $display_titles; 
	$rt_crop  = $crop;
	
	//create a post status array
	$post_status = is_user_logged_in() ? array( 'private', 'publish' ) : "publish";

	//general query
	$args=array( 
		'post_status'    =>	$post_status,
		'post_type'      =>	'portfolio',
		'orderby'        =>	$list_orderby,
		'order'          =>	$list_order,
		'showposts' 	 =>	$max_item
	);


	if( ! empty ( $ids ) ){
		$args = array_merge($args, array( 'post__in'  => $ids) );
	}

	if( ! empty ( $categories ) ){
		$args = array_merge($args, array( 

			'tax_query' => array(
					array(
						'taxonomy' =>	'portfolio_categories',
						'field'    =>	'id',
						'terms'    =>	$categories,
						'operator' => 	"IN"
					)
				),	

		) );
	} 
	 
	ob_start();

	$theQuery = query_posts($args);


	//add class
	$add_class = "";

	//get page & post counts
	$page_count = rt_get_page_count();
	$post_count = $page_count['post_count']; 

	//add holder class
	$add_holder_class = $style."_holder";
	$add_holder_class .= empty( $heading ) ? " without_heading" : " with_heading";


	echo '<div class="row clearfix">';

	echo ! empty( $heading ) ? do_shortcode ( '[heading_bar heading="'.$heading.'" icon="'.$heading_icon.'" ]' ) : "";

	echo '<div id="'.$id.'" class="carousel-holder clearfix '.$add_holder_class.' " data-rt-animation-group="single" data-rt-animation-type="fadeIn" data-rt-animate="animate">';
 
	echo '<section class="carousel_items clearfix"><div class="owl-carousel">';

		while ( have_posts() ) : the_post();

			echo '<div class="item">'."\n";
				//get post format
				$portfolio_format = get_post_meta(get_the_ID(), RT_COMMON_THEMESLUG.'_portfolio_post_format', true);

				//get portfolio content
				get_template_part( 'portfolio-contents/carousel-content', $portfolio_format ); 				

			echo '</div>'."\n";
 
			$counter++;

		endwhile; 

	echo '</div></section></div></div>'; 


	//js script to run
	printf('
		<script type="text/javascript">
		 /* <![CDATA[ */ 
			// run carousel
				jQuery(document).ready(function() { 
					 jQuery("#%1$s").rt_start_carousels(%2$s,"%3$s");
				}); 
		/* ]]> */	
		</script>
	',$id,$item_width,$style);		


	wp_reset_query(); 
		
	$output_string = ob_get_contents();

	ob_end_clean(); 

	return $output_string;
	}
}

add_shortcode('portfolio_carousel', 'rt_portfolio_carousel'); 

/*
* ------------------------------------------------- *
*		WooCommerce Products Carousel
* ------------------------------------------------- *
*/

if( ! function_exists("rt_wc_products_carousel") ){
	function rt_wc_products_carousel( $atts, $content = null ) {
	//[wcproduct_carousel id="" heading="" heading_icon="" item_width="5" list_orderby="" list_order="" max_item="9" categories="" product_ids=""]

	global $rt_item_width,$rt_display_titles;

	//enqueue script files
	wp_enqueue_script('jquery-owl-carousel', RT_THEMEURI . '/js/owl.carousel.min.js', array(), "", false ); 	

	//counter
	$counter = 1;	

	//defaults
	extract(shortcode_atts(array(  
		"id"  => 'wc-product-carousel-'.rand(100000, 1000000), 
		"heading" => "",
		"heading_icon" => "",
		"item_width"  => 4, 
		"list_orderby" => "date",
		"list_order" => "DESC",
		"max_item"=> 100,
		"categories" => "",
		"ids" => array(),
		"style" => ""
	), $atts));


	//product id numbders
	$ids = ! empty( $ids ) ? explode(",", trim( $ids ) ) : array();

	//categories - turn into an array
	$categories = ! empty( $categories ) ? explode(",", esc_attr( $categories ) ) : "";  

	//item width 
	$item_width = ! empty( $item_width ) ? $item_width : 4;

	//layout name values
	$layout_values = array('','one', 'two', 'three', 'four', 'five');

	//global values for product items
	$rt_item_width = $item_width;  

	//create a post status array
	$post_status = is_user_logged_in() ? array( 'private', 'publish' ) : "publish";

	//general query
	$args=array( 
		'post_status'    =>	$post_status,
		'post_type'      =>	'product',
		'orderby'        =>	$list_orderby,
		'order'          =>	$list_order,
		'showposts' 	 =>	$max_item
	);


	if( ! empty ( $ids ) ){
		$args = array_merge($args, array( 'post__in'  => $ids) );
	}

	if( ! empty ( $categories ) ){
		$args = array_merge($args, array( 

			'tax_query' => array(
					array(
						'taxonomy' =>	'product_cat',
						'field'    =>	'slug',
						'terms'    =>	$categories,
						'operator' => 	"IN"
					)
				),	

		) );
	} 
	 
	ob_start();

	$theQuery = query_posts($args);


	//add class
	$add_class = "";

	//get page & post counts
	$page_count = rt_get_page_count();
	$post_count = $page_count['post_count']; 


	//add holder class
	$add_holder_class = $style."_holder";
	$add_holder_class .= empty( $heading ) ? " without_heading" : " with_heading";

	echo '<div class="row clearfix">';

	echo ! empty( $heading ) ? do_shortcode ( '[heading_bar heading="'.$heading.'" icon="'.$heading_icon.'" ]' ) : "";

	echo '<div id="'.$id.'" class="carousel-holder woocommerce clearfix '.$add_holder_class.' "  data-rt-animation-group="single" data-rt-animation-type="fadeIn" data-rt-animate="animate">';
 
	echo '<section class="carousel_items"><div class="owl-carousel">';

		while ( have_posts() ) : the_post();

			get_template_part( '/woocommerce/content-product','carousel'); 		 
 
			$counter++;

		endwhile; 

	echo '</div></section></div></div>';

	//js script to run
	printf('
		<script type="text/javascript">
		 /* <![CDATA[ */ 
			// run carousel
				jQuery(document).ready(function() { 
					 jQuery("#%1$s").rt_start_carousels(%2$s,"%3$s");
				}); 
		/* ]]> */	
		</script>
	',$id,$item_width,$style);		


	wp_reset_query(); 
		
	$output_string = ob_get_contents();

	ob_end_clean(); 

	return $output_string;
	}
}

add_shortcode('wcproduct_carousel', 'rt_wc_products_carousel'); 

/*
* ------------------------------------------------- *
*		Blog Carousel 	
* ------------------------------------------------- *		
*/ 

if( ! function_exists("rt_blogs_carousel") ){
	function rt_blogs_carousel( $atts, $content = null ) { 

	global $rt_item_width, $rt_crop, $rt_display_excerpts, $rt_limit_chars;

	//enqueue script files
	wp_enqueue_script('jquery-owl-carousel', RT_THEMEURI . '/js/owl.carousel.min.js', array(), "", false ); 	 

	//counter
	$counter = 1;	

	//defaults
	extract(shortcode_atts(array(  
		"id"  => 'post-carousel-'.rand(100000, 1000000), 
		"heading" => "",
		"heading_icon" => "",
		"item_width"  => 4, 
		"list_orderby" => "date",
		"list_order" => "DESC",
		"max_item"=> 10,
		"categories" => "",
		"ids" => array(),
		"style" => "",
		"crop" => "on",
		"display_excerpts" => true,
		"limit_chars" => ""
	), $atts));


	//product id numbders
	$ids = ! empty( $ids ) ? explode(",", trim( $ids ) ) : array();
	
	//item width 
	$item_width = ! empty( $item_width ) ? $item_width : 4;

	//categories - turn into an array
	$categories = ! empty( $categories ) ? explode(",", $categories) : "";  
 
	//layout name values
	$layout_values = array('','one', 'two', 'three', 'four', 'five');

	//crop
	$crop = $crop == "false" ? false : $crop;	
 
	//display descriptions
	$display_excerpts = $display_excerpts == "false" ? false : $display_excerpts;	

	//global values for posts
	$rt_item_width = $item_width;
	$rt_display_excerpts = $display_excerpts; 
	$rt_limit_chars = $limit_chars;
	$rt_crop  = $crop;


	//create a post status array
	$post_status = is_user_logged_in() ? array( 'private', 'publish' ) : "publish";

	//general query
	$args=array( 
		'post_status'    =>	$post_status,
		'post_type'      =>	'post',
		'orderby'        =>	$list_orderby,
		'order'          =>	$list_order,
		'showposts' 	 =>	$max_item,
		'ignore_sticky_posts' => 1
	);


	if( ! empty ( $ids ) ){
		$args = array_merge($args, array( 'post__in'  => $ids) );
	}

	if( ! empty ( $categories ) ){
		$args = array_merge($args, array( 

			'tax_query' => array(
					array(
						'taxonomy' =>	'category',
						'field'    =>	'id',
						'terms'    =>	$categories,
						'operator' => 	"IN"
					)
				),	

		) );
	} 
	 
	ob_start();

	$theQuery = query_posts($args);


	//add class
	$add_class = "";

	//get page & post counts
	$page_count = rt_get_page_count();
	$post_count = $page_count['post_count']; 

	//add holder class
	$add_holder_class = $style."_holder";
	$add_holder_class .= empty( $heading ) ? " without_heading" : " with_heading";


	echo '<div class="row clearfix">';

	echo ! empty( $heading ) ? do_shortcode ( '[heading_bar heading="'.$heading.'" icon="'.$heading_icon.'" ]' ) : "";

	echo '<div id="'.$id.'" class="carousel-holder clearfix '.$add_holder_class.' " data-rt-animation-group="single" data-rt-animation-type="fadeIn" data-rt-animate="animate">';
 
	echo '<section class="latest-news carousel_items clearfix"><div class="owl-carousel">';

		while ( have_posts() ) : the_post();

			echo '<div class="item">'."\n";
				//get blog content
				get_template_part( 'post-contents/carousel', 'content' ); 				

			echo '</div>'."\n";
 
			$counter++;

		endwhile; 

	echo '</div></section></div></div>'; 


	//js script to run
	printf('
		<script type="text/javascript">
		 /* <![CDATA[ */ 
			// run carousel
				jQuery(document).ready(function() { 
					 jQuery("#%1$s").rt_start_carousels(%2$s,"%3$s");
				}); 
		/* ]]> */	
		</script>
	',$id,$item_width,$style);		


	wp_reset_query(); 
		
	$output_string = ob_get_contents();

	ob_end_clean(); 

	return $output_string;
	}
}

add_shortcode('blog_carousel', 'rt_blogs_carousel'); 

/*
* ------------------------------------------------- *
*		Staff Posts	
* ------------------------------------------------- *		
*/ 

if( ! function_exists("rt_staff") ){
	function rt_staff( $atts, $content = null ) { 
	//[staff_box id="" item_width="5" list_orderby="" list_order="" ids="" style=""]
	global $rt_item_width, $wp_query;

	//counter
	$counter = 1;	

	//defaults
	extract(shortcode_atts(array(  
		"id"  => 'staff-'.rand(100000, 1000000), 
		"item_width"  => 4, 
		"list_orderby" => "date",
		"list_order" => "DESC",
		"ids" => array(),
		"style" => ""
	), $atts));


	//product id numbders
	$ids = ! empty( $ids ) ? explode(",", trim( $ids ) ) : array();

	//item width 
	$item_width = ! empty( $item_width ) ? $item_width : 4;

	//global values for posts
	$rt_item_width = $item_width; 

	//layout name values
	$layout_values = array('','one', 'two', 'three', 'four', 'five');


	//create a post status array
	$post_status = is_user_logged_in() ? array( 'private', 'publish' ) : "publish";

	//general query
	$args=array( 
		'post_status'    =>	$post_status,
		'post_type'      =>	'staff',
		'orderby'        =>	$list_orderby,
		'order'          =>	$list_order,
		'showposts' 	 =>	1000															
	);


	if( ! empty ( $ids ) ){
		$args = array_merge($args, array( 'post__in'  => $ids) );
	}
 
	 
	ob_start();

	$theQuery = query_posts($args);

	//add class
	$add_class = "";

	//get page & post counts
	$page_count = rt_get_page_count();
	$post_count = $page_count['post_count']; 

	
	//add holder class
	$add_holder_class = " ".$style;

	echo '<section id="'.$id.'" class="team clearfix '.$add_holder_class.' " data-rt-animation-group="group">';

 
		while ( have_posts() ) : the_post();


			//add first last classes if filterable is off 
			$add_class = "";

			if( $counter % $item_width == 1 || $item_width == 1 ){
				$add_class .= " first";
			}

			if( ( $counter % $item_width == 0 || $post_count == $counter ) && $add_class == "" ){
				$add_class .= " last";
			}

			//open row block
			if( $counter % $item_width == 1 || $item_width == 1 ){
				echo '<div class="row clearfix">';
			}			

			printf('<div class="person box %s %s" data-rt-animate="animate" data-rt-animation-type="fadeInDown">'."\n",$layout_values[$item_width],$add_class);
				get_template_part( 'staff-contents/content'); 				
			echo '</div>'."\n";

			//close row block and add hr
			if( $counter % $item_width == 0 || $post_count == $counter ){
				echo '</div>';				
			}			

			if( $counter % $item_width == 0 && $post_count != $counter ){
				echo '<hr class="style-four">';
			}

			$counter++;

		endwhile; 

	echo '</section>';
	
	rt_get_pagination( $wp_query );
	wp_reset_query(); 
		
	$output_string = ob_get_contents();

	ob_end_clean(); 

	return $output_string;
	}
 }

add_shortcode('staff_box', 'rt_staff'); 


/*
* ------------------------------------------------- *
*		Testimonanials	
* ------------------------------------------------- *		
*/ 

if( ! function_exists("rt_testimonials") ){
	function rt_testimonials( $atts, $content = null ) { 
	//[testimonial_box id="" item_width="5" list_orderby="" list_order="" ids=""]
	global $paged;
	
	//counter
	$counter = 1;	

	//defaults
	extract(shortcode_atts(array(  
		"id"  => 'testimonial-'.rand(100000, 1000000), 
		"item_width"  => 4, 
		"ids" => array(),
		"style" => "",
		"item_per_page"=> 9,
		"list_orderby" => "date",
		"list_order" => "DESC",
		"pagination" => "",
	), $atts));


	//product id numbders
	$ids = ! empty( $ids ) ? explode(",", trim( $ids ) ) : array();

	//item width 
	$item_width = ! empty( $item_width ) ? $item_width : 4;

	//layout name values
	$layout_values = array('','one', 'two', 'three', 'four', 'five');

	//pagination
	$pagination = $pagination == "false" ? false : $pagination;		

	//paged
	if($pagination){
		if (get_query_var('paged') ) {$paged = get_query_var('paged');} elseif ( get_query_var('page') ) {$paged = get_query_var('page');} else {$paged = 1;} 
	}else{
		$paged=0;
	} 	  

	//create a post status array
	$post_status = is_user_logged_in() ? array( 'private', 'publish' ) : "publish";

	//general query
	$args=array( 
		'post_status'    =>	$post_status,
		'post_type'      =>	'testimonial',
		'orderby'        =>	$list_orderby,
		'order'          =>	$list_order,
		'posts_per_page' =>	$item_per_page,
		'paged'          => $paged															
	);

	if( ! empty ( $ids ) ){
		$args = array_merge($args, array( 'post__in'  => $ids) );
	}
 
	ob_start();

	$theQuery  = new WP_Query($args); 

	//add class
	$add_class = "";
 
	//get page & post counts
	$post_count = $theQuery->post_count;  
	
	//add holder class
	$add_holder_class = " ".$style;

	echo '<section id="'.$id.'" class="testimonials clearfix '.$add_holder_class.' " data-rt-animation-group="group">';

 
		while ( $theQuery->have_posts() ) : $theQuery->the_post();


			//add first last classes if filterable is off 
			$add_class = "";

			if( $counter % $item_width == 1 || $item_width == 1 ){
				$add_class .= " first";
			}

			if( ( $counter % $item_width == 0 || $post_count == $counter ) && $add_class == "" ){
				$add_class .= " last";
			}

			//open row block
			if( $counter % $item_width == 1 || $item_width == 1 ){
				echo '<div class="row clearfix">';
			}			

			printf('<div class="testimonial box %s %s" data-rt-animate="animate" data-rt-animation-type="fadeIn">'."\n",$layout_values[$item_width],$add_class);
				get_template_part( 'testimonial-contents/content'); 				
			echo '</div>'."\n";

			//close row block and add hr
			if( $counter % $item_width == 0 || $post_count == $counter ){
				echo '</div>';				
			}			

			if( $counter % $item_width == 0 && $post_count != $counter ){
				echo '<hr class="style-four">';
			}

			$counter++;

		endwhile; 

	echo '</section>';

	if( $pagination ){
		rt_get_pagination( $theQuery );	
	} 

	wp_reset_query(); 
		
	$output_string = ob_get_contents();

	ob_end_clean(); 

	return $output_string;
	}
 }

add_shortcode('testimonial_box', 'rt_testimonials'); 


/*
* ------------------------------------------------- *
*		Testimonanial Carousel
* ------------------------------------------------- *		
*/ 

if( ! function_exists("rt_testimonial_carousel") ){
	function rt_testimonial_carousel( $atts, $content = null ) { 
	//[testimonial_carousel id="" heading="" heading_icon="" item_width="5" list_orderby="" list_order="" ids=""]

	//enqueue script files
	wp_enqueue_script('jquery-owl-carousel', RT_THEMEURI . '/js/owl.carousel.min.js', array(), "", false ); 	 

	//counter
	$counter = 1;	

	//defaults
	extract(shortcode_atts(array(  
		"id"  => 'testimonial-carousel-'.rand(100000, 1000000), 
		"heading" => "",
		"heading_icon" => "",
		"max_item"=> 100,
		"item_width"  => 4, 
		"list_orderby" => "date",
		"list_order" => "DESC",
		"ids" => array(),
		"style" => ""
	), $atts));
 

	//id numbders
	$ids = ! empty( $ids ) ? explode(",", trim( $ids ) ) : array();
 
	//layout name values
	$layout_values = array('','one', 'two', 'three', 'four', 'five');


	//create a post status array
	$post_status = is_user_logged_in() ? array( 'private', 'publish' ) : "publish";

	//general query
	$args=array( 
		'post_status'    =>	$post_status,
		'post_type'      =>	'testimonial',
		'orderby'        =>	$list_orderby,
		'order'          =>	$list_order,
		'showposts' 	 =>	$max_item
	);


	if( ! empty ( $ids ) ){
		$args = array_merge($args, array( 'post__in'  => $ids) );
	}
 

	ob_start();

	$theQuery = query_posts($args);


	//add class
	$add_class = "";

	//get page & post counts
	$page_count = rt_get_page_count();
	$post_count = $page_count['post_count']; 

	//add holder class
	$add_holder_class = $style;
	$add_holder_class .= empty( $heading ) ? " without_heading" : " with_heading";


	echo '<div class="row clearfix">';

	echo ! empty( $heading ) ? do_shortcode ( '[heading_bar heading="'.$heading.'" icon="'.$heading_icon.'" ]' ) : "";

	echo '<div id="'.$id.'" class="carousel-holder clearfix '.$add_holder_class.' " data-rt-animate="animate" data-rt-animation-type="fadeIn" data-rt-animation-group="single">';
 
	echo '<section class="carousel_items clearfix"><div class="owl-carousel">';

		while ( have_posts() ) : the_post();

			echo '<div class="testimonial item">'."\n";

				//get content
				get_template_part( 'testimonial-contents/content'); 				 				

			echo '</div>'."\n";
 
			$counter++;

		endwhile; 

	echo '</div></section></div></div>'; 


	//js script to run
	printf('
		<script type="text/javascript">
		 /* <![CDATA[ */ 
			// run carousel
				jQuery(document).ready(function() { 
					 jQuery("#%1$s").rt_start_carousels(%2$s,"%3$s");
				}); 
		/* ]]> */	
		</script>
	',$id,$item_width,$style);		


	wp_reset_query(); 
		
	$output_string = ob_get_contents();

	ob_end_clean(); 

	return $output_string;
	}
}

add_shortcode('testimonial_carousel', 'rt_testimonial_carousel'); 


/*
* ------------------------------------------------- *
*		PHOTO GALLERY		
* ------------------------------------------------- *		
*/ 
if( ! function_exists("rt_photo_gallery") ){
	function rt_photo_gallery( $atts, $content = null ) {
	//[photo_gallery item_width=""]
	global $rt_counter, $rt_item_width, $rt_randomID;

	//defaults
	extract(shortcode_atts(array(  
		"item_width" => '5'				
	), $atts)); 

	//random id
	$randomID = rand(100000, 1000000); 	

	//counter
	$counter = 1;		

	//global values
	$rt_counter = $counter;
	$rt_item_width = $item_width;
	$rt_randomID = $randomID;

	$rt_photo_gallery='<div class="row clearfix"><ul class="photo_gallery shortcode" data-rt-animation-group="group">';
	$rt_photo_gallery .= do_shortcode(strip_tags($content));
	$rt_photo_gallery.='</ul><div class="clear"></div></div>';

	return $rt_photo_gallery;  
	}
}

if( ! function_exists("rt_photo_gallery_lines") ){
	function rt_photo_gallery_lines( $atts, $content = null ) {
	//[image]
	global $rt_counter, $rt_item_width, $rt_randomID;

	//defaults
	extract(shortcode_atts(array(  
		"lightbox"        => 'true',
		"custom_link"     => '',
		"title"           => '',
		"caption"         => '',
		"open_in_new_tab" => 'false',		
		"crop"            => 'true'
	), $atts)); 

	//if w & h suplied li's are fluid
	$rt_item_width = empty( $rt_item_width ) ? 6 : $rt_item_width;

	//layout name values
	$layout_values = array('','one', 'two', 'three', 'four', 'five', 'fluid');

	//variables
	$items_output = $caption_output = $lightbox_link = $image_effect = ""; 

	$photo=trim($content);

	// crop
	$crop = $crop == "false" ? false : true;	

	// Thumbnail width & height
	$w = rt_get_min_resize_size( $rt_item_width );
	$h = $crop ? $w / 1.5 : 10000;	

	// Get image data
	$image_args = array( 
		"image_url" => $photo,
		"image_id" => "",
		"w"=> $w,
		"h"=> $h,
		"crop" => true,
	);

	$image_output = rt_get_image_data( $image_args );   


	//target
	$target = $open_in_new_tab == "false" ? "_self" : "_new";

	//create lightbox link
	if( $lightbox != "false"){

		$lightbox_link = rt_create_lightbox_link(
			array(
				'class' => 'icon-zoom-in lightbox_ single',
				'href' => $image_output["image_url"],
				'title' => __('Enlarge Image','rt_theme'),
				'data_group' => $rt_randomID,
				'data_title' => $title,
				'data_description' => $caption,
				'data_thumbnail' => $image_output["lightbox_thumbnail"],
				'echo' => false
			)
		);

		$image_effect="imgeffect"; 

	}elseif( $custom_link == "" && $lightbox == "false" ){

		$lightbox_link = "";
		$image_effect=""; 
	}else{

		$lightbox_link = sprintf('
			<a href="%s" class="icon-link single" title="%s" target="%s"></a>',
			$custom_link, $title, $target);
		$image_effect="imgeffect"; 
	}
  

	//create caption
	$caption_output = ! empty( $caption ) ? sprintf('
		<p class="gallery-caption-text">%s</p>
	', $caption ) : "";

	// get the column class name
	$add_class = $layout_values[$rt_item_width];

	//add first last classes
	if( $rt_counter % $rt_item_width == 1 || $rt_item_width == 1 ){
		$add_class .= " first";
	}

	if( $rt_counter % $rt_item_width == 0 ){
		$add_class .= " last";
	}

	//list items output
	$items_output .= sprintf('
		<li class="box %s" data-rt-animate="animate" data-rt-animation-type="fadeIn">
			<div class="%s">	
				%s							
				<img src="%s" alt="%s"> 									
			</div>
			%s 	
		</li>
	',$add_class, $image_effect, $lightbox_link, $image_output["thumbnail_url"], $title, $caption_output);
	
	$rt_counter++;

	return $items_output;
	}	
}

add_shortcode('photo_gallery', 'rt_photo_gallery');
add_shortcode('image', 'rt_photo_gallery_lines');

/*
* ------------------------------------------------- *
*	Auto Thumbnails & Lightboxes	
* ------------------------------------------------- *		
*/ 
if( ! function_exists("rt_auto_thumb") ){
	function rt_auto_thumb( $atts, $content = null ) {
	//[auto_thumb width="" height="" link="" lightbox="" align="" title="" alt="" iframe="" frame=""]
 
	//defaults
	extract(shortcode_atts(array(  
		"width"    => '135',
		"height"   => '135',
		"link"     => '',
		"lightbox" => 'true',
		"align"    => 'alignleft',
		"title"    => '',
		"alt"      => '',
		"crop"     => true,
	), $atts));
	

	//width and height
	if($width=="")  $width = "135";
	if($height=="") $height = "135";
	
	//crop
	if($crop=="false"){
		$height = 100000;
		$crop = false;
	} 
	 
	//random id
	$randomID = rand(100000, 1000000);
	
	//if it's not a video
	if( $link == "" && $lightbox != "false" ){
		$link = $content; 
	} 
	
	/* icon */
	if (preg_match("/(png|jpg|gif)/",  trim($link) )) {
		$icon="icon-zoom-in";
	}elseif (preg_match("/(youtube|vimeo)/",  trim($link) )) {
		$icon="icon-right-dir";
	} else {
		$icon="icon-link";
	}
	

	//the photo url
	//clear p and br tags
	$content = preg_replace('#^<\/p>|<p>$#', '', trim($content));
	$content = preg_replace('#^<p>|<\/p>$#', '', trim($content));
	$content = preg_replace('#^<br />$#', '', trim($content));		
	$photo = trim($content);

	// Get image data
	$image_args = array( 
		"image_url" => $photo,
		"image_id" => "",
		"w"=> $width,
		"h"=> $height,
		"crop" => $crop,
	);

	$image_output = rt_get_image_data( $image_args );   


	//create lightbox link
	if( $lightbox != "false"  ){

		$lightbox_link = rt_create_lightbox_link(
			array(
				'class' => $icon. ' lightbox_ single',
				'href' => $link,
				'title' => __('Enlarge Image','rt_theme'),
				'data_group' => "image".$randomID,
				'data_title' => $title,
				'data_thumbnail' => $image_output["lightbox_thumbnail"],
				'echo' => false
			)
		);	

	}elseif( $link == "" && $lightbox == "false" ){

		$lightbox_link = "";

	}else{

		$lightbox_link = sprintf('
			<a href="%s" class="icon-link single" title=""></a>',
			$link, $title);
		
	}
  
	//output
	$output = sprintf('
		<div class="imgeffect single_image %s">	
			%s							
			<img src="%s" alt="%s"> 									
		</div>
	',$align, $lightbox_link, $image_output["thumbnail_url"], $title);

	
	return $output;
	}
}

add_shortcode('auto_thumb', 'rt_auto_thumb'); 


/*
* ------------------------------------------------- *
*		Contact Form Pages
* ------------------------------------------------- *
*/
if( ! function_exists("rt_shortcode_contact_form") ){
	function rt_shortcode_contact_form( $atts, $content = null ) {

	//defaults
	extract(shortcode_atts(array(  
		"title"    => '', 
		"email"     => '',
		"security"  => "true"
	), $atts));

	//security
	$security = apply_filters("contact_form_security", $security );	

	wp_enqueue_script('jquery-validate', RT_THEMEURI  . '/js/jquery.validate.js', array('jquery') );
	wp_enqueue_script('jqueryform', RT_THEMEURI  . '/js/jquery.form.js', array('jquery') );

	$contact_form = "";
	 
	//dynamic class for the form
	$dynamic_class="dynamic-class-".rand(100,1000000);

	//are you human quiz
	$security_question = array();
	$security_question['are_you_human_math1']=rand(1, 9);
	$security_question['are_you_human_math2']=rand(1, 99);
	$security_question['are_you_human_sum'] = $security !== "false" ? ( $security_question['are_you_human_math1'] + $security_question['are_you_human_math2'] ) : "nosecurity";
	$security_question['form_item'] = $security !== "false" ? '<li class="security-question"><label class="math_label" for="math">'.__('Security Question:','rt_theme').'</label>'.$security_question['are_you_human_math1'].' + '.$security_question['are_you_human_math2'].' = <input id="math" placeholder="?" type="text" name="math" value="" class="required" /></li>' : "" ;

	$contact_form.= !empty( $title ) ? '<div class="clear"></div><h3 class="featured_article_title">'. $title .'</h3><div class="space margin-b20"></div>' : "";
	$contact_form.= !empty( $content ) ? '<p><i class="decs_text">'. html_entity_decode(do_shortcode($content)) .'</i></p>' : "";

	if( ! empty( $email ) ){


	$contact_form .= '
		<!-- contact form -->
		<div class="contact_form '.$dynamic_class.'" data-rt-animate="animate" data-rt-animation-type="fadeInDown" data-rt-animation-group="single">
		<div class="clear"></div><div class="result"></div>
			<form action="#" name="contact_form" class="validate_form rt_form" method="post" role="form" >
				<ul>
					<li><label for="name">'.__('Your Name: (*)','rt_theme').'</label><input id="name" type="text" name="name" value="" class="required" /> </li>
					<li><label for="email">'.__('Your Email: (*)','rt_theme').'</label><input id="email" type="text" name="email" value="" class="required email" /> </li>
					<li><label for="message">'.__('Your Message: (*)','rt_theme').'</label><textarea id="message" name="message" rows="8" cols="40" class="required"></textarea></li>
					'.$security_question['form_item'].'
					<li>
					<input type="hidden" name="your_email" value="'.trim(base64_encode($email)).'">
					<input type="hidden" name="dynamic_class" value="'.trim($dynamic_class).'">
					<input type="hidden" name="rt_form_data" value="'.base64_encode($security_question['are_you_human_sum']).'">
					<input type="submit" class="button" value="'.__('Send','rt_theme').'"  /><span class="loading"></span></li>
				</ul>
			</form>
		</div><div class="clear"></div>
		<!-- /contact form -->
	'; 

	}else{
		$contact_form="ERROR: This shortcode does not contain an email attribute!";
	}

	return $contact_form;
	}
}

add_shortcode('contact_form', 'rt_shortcode_contact_form');


/*
* ------------------------------------------------- *
*		Image Slider
* ------------------------------------------------- *
*/
		
if( ! function_exists("rt_shortcode_slider") ){
	function rt_shortcode_slider( $atts, $content = null ) {
	//[slider slider_width="%s" slider_height="%s" slider_script="%s" image_resize="%s" image_crop="%s" slider_timeout="%s" nivo_slider_effect="%s" flex_slider_effect="%s"]%s[/slider]
	global $rt_slider_width, $rt_slider_height, $rt_slider_script, $rt_total_slide, $rt_slider_id, $rt_image_resize, $rt_image_crop, $rt_slide_count, $rt_caption_output, $rt_slide_output;

	//defaults
	extract(shortcode_atts(array(  
		"slider_id" => '',
		"slider_script" => 'flex_slider', 	   
		"slider_timeout" => 4, 	   
		"image_resize" => false,
		"image_crop" => false, 	   
		"slider_width" => 1000,
		"slider_height" => 1000, 	
		"flex_slider_effect" => "fade",
		"nivo_slider_effect" => "random"
	), $atts));

	//find total slide number
	$total_slide = substr_count($content,'[slide');
 
	//$image_resize
	$image_resize = $image_resize == "false" ? false : $image_resize;

	//$image_crop
	$image_crop = $image_crop == "false" ? false : $image_crop;	

	//random id
	if( empty( $slider_id ) ){
		$slider_id = "slider-".rand(100000, 1000000);	
	}   

	//global values & resets
	$rt_slider_width = $slider_width;
	$rt_slider_height = $slider_height;
	$rt_slider_script = $slider_script;
	$rt_total_slide = $total_slide;
	$rt_slider_id = $slider_id;
	$rt_image_resize = $image_resize;
	$rt_image_crop = $image_crop;
	$rt_slide_count = 0;
	$rt_caption_output = "";
	$rt_slide_output = "";
	
	


	if( $rt_slider_script == "flex_slider" ){
			//the slider holder output
			$slider_holder_output = sprintf('
				<div class="flex-container">
					<div class="flexslider" id="%s">
						<ul class="slides">%s</ul>						
					</div>
					<div class="flex-nav-container"></div>
				</div> 
			',$slider_id, trim( do_shortcode( trim( $content ) ) ) );

			//js script to run
			$slider_holder_output .= sprintf('
				<script type="text/javascript">
				 /* <![CDATA[ */ 
					// Flex Slider and Helper Functions
					jQuery(window).load(function() {
						jQuery("#%s").flexslider({
							animation: "%s",
							controlsContainer: "#%s .flex-nav-container",
							slideshow: true, 
							slideshowSpeed:%s*1000,
							smoothHeight: true,
							directionNav: true,
							controlNav:false, 
							prevText: "<span class=\"icon-left-open\"></span>", 
							nextText: "<span class=\"icon-right-open\"></span>",
							start: function( slider ) {
        						slider.parents(".flex-container:eq(0)").removeAttr("style");
        						jQuery.waypoints(\'refresh\');
      						},
      						after: function(){
      							jQuery.waypoints(\'refresh\');
      						},  
						});
					});  
				/* ]]> */	
				</script>
			',$slider_id,$flex_slider_effect,$slider_id,$slider_timeout);
	}

	if( $rt_slider_script == "nivo_slider" ){
			//the slider holder output
			$slider_holder_output = trim( do_shortcode( $content ) );

			//js script to run
			$slider_holder_output .= sprintf('
				<script type="text/javascript">
				 /* <![CDATA[ */ 
					// Nivo Slider
					jQuery(window).load(function() {
					  jQuery("#%s").nivoSlider({
							effect:"%s",
							pauseTime:%s*1000, // How long each slide will show	
							captionOpacity:1,
							controlNav: true 	 
					  });
					});  
				/* ]]> */	
				</script>
			',$slider_id,$nivo_slider_effect,$slider_timeout);
	}
	

	return $slider_holder_output;
	}
}

if( ! function_exists("rt_shortcode_slider_slides") ){
	function rt_shortcode_slider_slides( $atts, $content = null ) {
	//[slide link="link" title="title" img_url="" video_url="" styling="" title_color="" title_bg_color="" text_color="" text_bg_color="" title_size="" text_size=""]slide_text[/slide]
	global $rt_slider_width, $rt_slider_height, $rt_slider_script, $rt_total_slide, $rt_slide_count, $rt_caption_output, $rt_slide_output, $rt_slider_id, $rt_image_resize, $rt_image_crop;
	
	$text = $image_output = $resized_img_url = "";

	$rt_slide_count++;

	//defaults
	extract(shortcode_atts(array(  
		"link" => '',
		"title" => '',
		"title2" => '',
		"img_url" => '',
		"video_url" => '', 
		"text_align" => 'left', 
		"stretch_images" => true,
		"styling"=> "",
		"title_color"=> "",
		"title_bg_color"=> "",
		"text_color"=> "",
		"text_bg_color"=> "",
		"title_size"=> "",
		"text_size"=> ""
	), $atts)); 


	//nivo slide id
	$nivo_slide_id = ( $rt_slider_script == "nivo_slider" ) ? "random_".rand(100000, 1000000) : ""; //randomized
	$nivo_image_sync_id = ( $nivo_slide_id ) ? "#".$nivo_slide_id : ""; 


	//caption css	
	$caption_css = "";
	if( $styling == "new" ){  
		$caption_css .= ! empty( $title_color ) ? " color:".rt_rgba2hex($title_color)."; color:".$title_color.";" : ""; 
		$caption_css .= ! empty( $title_bg_color ) ? "background-image:none; background-color:".rt_rgba2hex($title_bg_color)."; background-color:".$title_bg_color.";" : "background-color:transparent;padding-top:0;padding-bottom:0;"; 
		$caption_css .= ! empty( $title_size ) ? " font-size:".str_replace("px", "", $title_size)."px;line-height:140%;" : ""; 
		$caption_css = ! empty( $caption_css ) ? 'style="'.$caption_css.'"' : "";
	}

	//text css	
	$text_css = "";
	if( $styling == "new" ){  
		$text_css .= ! empty( $text_color ) ? " color:".rt_rgba2hex($text_color)."; color:".$text_color.";" : ""; 
		$text_css .= ! empty( $text_bg_color ) ? "background-image:none; background-color:".rt_rgba2hex($text_bg_color)."; background-color:".$text_bg_color.";" : "background-color:transparent;padding-top:0;padding-bottom:0;"; 
		$text_css .= ! empty( $text_size ) ? " font-size:".str_replace("px", "", $text_size)."px;line-height:140%;" : ""; 
		$text_css = ! empty( $text_css ) ? 'style="'.$text_css.'"' : "";
	}	

	//allowed html codes
	$allowed_html_title = array('br' => array());
	$allowed_html_text = array(
		'a' => array(
			'href' => array(),
			'title' => array()
		),
		'br' => array(),
		'em' => array(),
		'strong' => array()
	);

	//title 
	$title = ! empty( $title ) ? 
				! empty( $link ) ? '<div class="caption-one" '.$caption_css.'><a href="'.$link.'" title="'.wp_kses($title,"").'" '.$caption_css.'>'.wp_kses( stripcslashes( $title ) ,$allowed_html_title).'</a></div>'."\n" : '<div class="caption-one" '.$caption_css.'>'.wp_kses($title,$allowed_html_title).'</div>'."\n"
			 : "";

	//text 
	$text = ! empty( $content ) ? '<div class="caption-text" '.$text_css.'>'.trim( wp_kses( stripcslashes( $content ) , $allowed_html_text ) ).'</div>'."\n" : "";	

	//li class
	$li_class = $stretch_images=="true" ? "stretch" : "";	

	//featured image output
	if( ! empty( $img_url ) ){
		$img_url = rt_find_image_org_path( $img_url );		
		$image_id = rt_get_attachment_id_from_src( $img_url );   
		$image_alternative_text = get_post_meta($image_id, '_wp_attachment_image_alt', true); 			
		
		$image_meta_data = wp_get_attachment_metadata( $image_id, "true" );
		$image_height = isset( $image_meta_data["height"] ) ? $image_meta_data["height"] : "";


		//crop & resize = true
		if( ! empty( $rt_image_resize ) && ! empty( $rt_image_crop ) ){
			$resized_img_url = rt_vt_resize( $image_id , $img_url, $rt_slider_width, $rt_slider_height, true, false );		
		}

		//crop = true & resize = false
		if( empty( $rt_image_resize ) && ! empty( $rt_image_crop ) ){
			$resized_img_url = rt_vt_resize( $image_id , $img_url, $rt_slider_width, $rt_slider_height, false, true );		
		}

		//crop = false & resize = true
		if( ! empty( $rt_image_resize ) && empty( $rt_image_crop ) ){
			$resized_img_url = rt_vt_resize( $image_id , $img_url, $rt_slider_width, $rt_slider_height, false, false );		
		} 

		//if resized or cropped
		if( isset( $resized_img_url ) && is_array( $resized_img_url ) ){
			$img_url = $resized_img_url["url"]; 
			$image_height = $resized_img_url["height"];		 
		} 

		//first image height
		$rt_first_slide_height = $rt_slide_count == 1 && $image_height ? $image_height : 0;
		$rt_first_slide_data = $rt_slide_count == 1 ? 'data-flexfirstslide="true"' : "";		
		$rt_first_slide_height_data = isset( $rt_first_slide_height ) && $rt_first_slide_height > 0 ? 'data-sliderminheight="'.$rt_first_slide_height.'px"' : "";		

		$image_output = ! empty( $link ) ? sprintf( '<a href="%s"><img src="%s" alt="%s" title="%s" /></a>'."\n", $link, $img_url, $image_alternative_text, $nivo_image_sync_id ) : sprintf( '<img src="%s" alt="%s" title="%s" />'."\n", $img_url, $image_alternative_text, $nivo_image_sync_id );

	} 


	//output for flexslider
	if( $rt_slider_script == "flex_slider" ){

		//caption
		$rt_caption_output = ! empty( $title ) || ! empty( $text ) ? sprintf('<div class="flex-caption %s"><div class="caption-holder">%s %s %s</div></div>'."\n", $text_align, $title, $title2, $text) : "";

		//slide output
		$rt_slide_output = sprintf( '<li class="%s" %s %s><div class="slide_data">%s %s</div></li>'."\n", $li_class, $rt_first_slide_height_data, $rt_first_slide_data, $image_output, $rt_caption_output );

		return $rt_slide_output;
	}


	//output for nivoslider
	if( $rt_slider_script == "nivo_slider" ){ 

		//caption
		$rt_caption_output .= ! empty( $title ) || ! empty( $text ) ? sprintf('
			<div id="%s" class="nivo-html-caption">			
				<div class="nivo-title caption-%s">
				%s
				</div>
				<div class="nivo-text">
				%s
				</div>
			</div>
			'."\n", $nivo_slide_id, $rt_slide_count, $title, $text) : "";	 		

		//slide output
		$rt_slide_output .= sprintf( "%s", $image_output );


		if ( $rt_total_slide == $rt_slide_count) {	 	

			//the slider holder output
			$rt_slide_output = sprintf('

				<div class="nivo-container theme-default">
					<div class="nivoSlider" id="%s">
						%s
					</div>
						%s
				</div>

			',$rt_slider_id, $rt_slide_output, $rt_caption_output);

			return $rt_slide_output;
		} 

	}	
	}
}

add_shortcode('slider', 'rt_shortcode_slider');
add_shortcode('slide', 'rt_shortcode_slider_slides');
 

/*
* ------------------------------------------------- *
*		Maps	
* ------------------------------------------------- *		
*/ 

if( ! function_exists("rt_google_map") ){
	function rt_google_map( $atts, $content = null ) { 

	//[google_maps map_id="" title="" height=""][/google_maps]  
	global $rt_map_id, $rt_total_location, $rt_location_count, $rt_locations_output, $rt_zoom; 

	extract(shortcode_atts(array(  
		"map_id" => "map-".rand(100000, 1000000),
		"title" => '',
		"height" => 300,
		"template_builder" => false,
		"zoom" => 3,
		"bwcolor" => ""
	), $atts));

	//load google api
	$api_key = get_option(RT_THEMESLUG.'_google_api_key');
	
	if( ! empty( $api_key ) ){
		$googlemaps_url = add_query_arg( 'key', urlencode( $api_key ), "//maps.googleapis.com/maps/api/js" );
		wp_enqueue_script('googlemaps',$googlemaps_url,array(), '1.0.0'); 	
	}else{
		wp_enqueue_script('googlemaps','//maps.googleapis.com/maps/api/js'); 
	}

	//find total location number
	$total_location = substr_count($content,'[location');

	//title
	$title_output = ! empty( $title ) ? '<h3 class="featured_article_title">'.$title.'</h3><div class="space margin-b20"></div>' : ""; 

	//global values
	$rt_map_id = $map_id;
	$rt_total_location = $total_location;
	$rt_location_count = 0; //reset counter
	$rt_locations_output = ""; //reset locations_output
	$rt_zoom = $zoom;


	//content
	$content = do_shortcode($content); 


	//height data for javascript
	if( $template_builder == false ){
		$google_map = sprintf('%s<div class="google_map_holder" data-height="%s" data-scope="#%s" data-bw="%s">%s</div>',$title_output, $height, $map_id, $bwcolor, $content); 
	}else{
		$google_map = sprintf('%s<div class="google_map_holder" data-scope="#%s" data-bw="%s">%s</div>',$title_output, $map_id, $bwcolor, $content); 	
	}

	

	return $google_map;
	}
}

if( ! function_exists("rt_map_location") ){
	function rt_map_location( $atts, $content = null ) {
	//[location title="" lat="" lon=""]text[/location]
	global $rt_map_id, $rt_total_location, $rt_location_count, $rt_locations_output, $rt_zoom; 

	extract(shortcode_atts(array(  
		"title" => "",
		"lat" => 0,
		"lon" => 0,
	), $atts));

	$rt_location_count++;


	//locations_output
	$rt_locations_output .= ! empty( $lat ) && ! empty( $lon ) ?  sprintf('["%s", %s, %s, 4,"%s"],', addslashes($title), $lat, $lon, addslashes($content)) : "";	 		

	if ( $rt_total_location == $rt_location_count) {	 	

		//js script to run
		$js_output = sprintf('

			<div id="%s" class="google_map"></div>
			<script type="text/javascript">
			 /* <![CDATA[ */ 
				// Runs google maps	
					jQuery(function() {
						jQuery("#%s").rt_maps([%s],%s); 
					});
			/* ]]> */	
			</script>

		', $rt_map_id, $rt_map_id, $rt_locations_output,$rt_zoom);

		return $js_output;
	} 
	} 
}

add_shortcode('google_maps', 'rt_google_map'); 
add_shortcode('location', 'rt_map_location'); 


/*
* ------------------------------------------------- *
*		Icon Lists
* ------------------------------------------------- *
*/

if( ! function_exists("rt_icon_list") ){
	function rt_icon_list( $atts, $content = null ) {
	//[icon_list title=""][/icon_list]
	global $rt_item_width, $rt_counter;

	extract(shortcode_atts(array(  
		"title" => '',
		"icon_style" => '',
		"font_size" => '',
		"item_width" => '1'				
	), $atts));

	//counter
	$rt_counter = 1;	

	//global values
	$rt_item_width = $item_width; 

	$list_holder_output = $title_output = "";

	//title
	$title_output = ! empty( $title ) ? '<h3 class="featured_article_title">'.$title.'</h3><div class="space margin-b20"></div>' : "";

	//fix shortcode
	$content = do_shortcode($content); 

	$list_holder_output = sprintf('	 
	 
		%s
		<ul class="with_icons %s %s" data-rt-animation-group="group">
		%s
		</ul>
	', $title_output, $icon_style, $font_size, $content );

	return $list_holder_output;
	}
}

if( ! function_exists("rt_icon_list_line") ){
	function rt_icon_list_line( $atts, $content = null ) {
	//[icon_list_line icon=""]content[/icon_list_line]
	global $rt_item_width, $rt_counter;


	extract(shortcode_atts(array(  
		"icon" => ''
	), $atts));	

	//fix shortcode
	$content = do_shortcode($content); 

 	//layout name values
	$layout_values = array('','one', 'two', 'three', 'four', 'five');

	// get the column class name
	$add_class = $layout_values[$rt_item_width];

	//add first last classes
	if( $rt_counter % $rt_item_width == 1 || $rt_item_width == 1 ){
		$add_class .= " first";
	}

	if( $rt_counter % $rt_item_width == 0 ){
		$add_class .= " last";
	}

	//icon output
	$icon_output = ! empty( $icon ) ? '<span class="'.$icon.' icon"></span>' : "";

	$rt_counter++;
	 
	$output = ' <li class="box '.$add_class.'" data-rt-animate="animate" data-rt-animation-type="fadeInDown">'. $icon_output .' <p>' . stripcslashes( $content ) . '</p></li>';
 
	return $output;
	}
}

add_shortcode('icon_list', 'rt_icon_list');
add_shortcode('icon_list_line', 'rt_icon_list_line');

/*
* ------------------------------------------------- *
*		Tabular Content
* ------------------------------------------------- *
*/

if( ! function_exists("rt_shortcode_tabs") ){
	function rt_shortcode_tabs( $atts, $content = null ) {
	//[tabs tabs_style="" tab1="" tab1-icon="" tab2="" tab2-icon="" tab3="" tab3-icon=""][/tabs]
	
	//fix shortcode
	$content = do_shortcode($content);  

	//class names
	$tab_style_names = array( 
			"horizontal" =>"tab-style-one", "horizontal2" => "tab-style-two", "horizontal3" => "tab-style-three", "vertical" => "vertical_tabs", 
			"tab-style-one" =>"tab-style-one", "tab-style-two" => "tab-style-two", "tab-style-three" => "tab-style-three", "vertical_tabs" => "vertical_tabs" //fixes for old names
			);	
	
	$tabs_style = isset( $atts['tabs_style'] ) && isset( $tab_style_names[ $atts['tabs_style'] ] ) ? $tab_style_names[$atts['tabs_style']] : $tab_style_names["horizontal"];

	$tabs = ""; 
	for($i=1;$i<20;$i++){
		$tab_name = isset($atts['tab'.$i]) ? $atts['tab'.$i] : "";
		$tab_icon = isset($atts['tab'.$i.'_icon']) ? $atts['tab'.$i.'_icon'] : "";

		if($tab_name){
		   $tabs .=  !empty($tab_icon) ? '<li class="with_icon"><a href="#"><span class="'.$tab_icon.' icon-large"></span> '.$tab_name.'</a></li>' : '<li><a href="#">'.$tab_name.'</a></li>';
		}
	}	

	return '<div class="shortcode_tabs '.$tabs_style.'" data-rt-animate="animate" data-rt-animation-type="fadeIn" data-rt-animation-group="single"><div class="tabs_wrap"><ul class="tabs clearfix">'.$tabs.'</ul><div class="panes">'.$content.'</div></div></div>';
	}
}

if( ! function_exists("rt_shortcode_tab") ){
	function rt_shortcode_tab( $atts, $content = null ) {
	//[tab][/tab] 
	
	//fix shortcode
	 $content = do_shortcode($content); 

	return ' <div class="pane fluid">' . $content . '</div>';
	}
}

add_shortcode('tabs', 'rt_shortcode_tabs');
add_shortcode('tab', 'rt_shortcode_tab');


/*
* ------------------------------------------------- *
*		Accordions
* ------------------------------------------------- *
*/

if( ! function_exists("rt_shortcode_accordion") ){
	function rt_shortcode_accordion( $atts, $content = null ) {
	//[accordion align="" style=""][/accordion]
	 global $rt_accordion_number_count, $rt_accordion_style, $rt_accordion_first_open;

	//defaults
	extract(shortcode_atts(array(  
		"style" => 'numbered',
		"align" => '',
		"first_one_open" => 'false', 
	), $atts));
	
	
	//global variables
	$rt_accordion_number_count= 1;
	$rt_accordion_style = $style;

	$rt_accordion_first_open = ($first_one_open=="true") ? "true" : "";
	
	//align 
	if($align) $align =  'small _'.$align;
	
	//fix shortcode
	$content = do_shortcode($content); 

	$accordion_holder  ="";
	$accordion_holder .='<div data-rt-animation-group="group" class="rt-toggle '.$align.'';
	$accordion_holder .= ($style=="numbered" || $style=="icons" ) ? "" : " no-numbers";
	$accordion_holder .='"><ol>'.apply_filters('the_content',$content).'</ol></div>'; 
	return $accordion_holder;
	}
}

if( ! function_exists("rt_shortcode_accordion_panel") ){
	function rt_shortcode_accordion_panel( $atts, $content = null ) {
	//[pane title="" icon=""][/pane]
	global $rt_accordion_number_count, $rt_accordion_style, $rt_accordion_first_open;

	$pane_title= isset( $atts['title'] ) ? $atts['title'] : "";
	$pane_icon= isset( $atts['icon'] ) ? $atts['icon'] : "";
	 
	//fix shortcode
	$content = apply_filters('the_content',$content);

	$panes  = ""; 
	$panes .= ($rt_accordion_first_open && $rt_accordion_number_count==1) ? '<li class="open" data-rt-animate="animate" data-rt-animation-type="fadeInDown">': '<li data-rt-animate="animate" data-rt-animation-type="fadeInDown">'; 
	$panes .= '<div class="toggle-head">';
	
	if($rt_accordion_style == "numbered") $panes .= '<div class="toggle-number">'.$rt_accordion_number_count.'</div>';
	if($rt_accordion_style == "icons") $panes .= '<div class="toggle-number"><span class="'.$pane_icon.'"></span></div>';

	$panes .= '<div class="toggle-title">'.$pane_title.'</div>';
	$panes .= '</div>'; 
	$panes .= '<div class="toggle-content fluid">';
	$panes .= $content; 
	$panes .= '</div>';
	$panes .= '</li>';

	$rt_accordion_number_count++;
	return $panes;
	}
}

add_shortcode('accordion', 'rt_shortcode_accordion');
add_shortcode('pane', 'rt_shortcode_accordion_panel');


/*
* ------------------------------------------------- *
*		SOCIAL MEDIA		
* ------------------------------------------------- *		
*/ 

if( ! function_exists("rt_social_media") ){
	function rt_social_media( $atts, $content = null ) {
 
	global $rt_social_media_icons;
	$social_media_output ='';			
	$target = "";					
	foreach ($rt_social_media_icons as $key => $value){
		

		//get the option values
		$link = get_option( RT_THEMESLUG.'_'.$value ); 
		$followText = get_option( RT_THEMESLUG.'_'.$value.'_text' );
		$target =  get_option( RT_THEMESLUG.'_'.$value.'_target' );

		if($value=="mail"){//e-mail icon link   
			if(strpos($link, "@")){
				$link = 'mailto:'.str_replace("mailto:", "", $link);  
			}else{
				$link = str_replace("mailto:", "", $link);				
			}  

		}else{
			$link = $link; 
		} 


		//all icons
		if($link){
			$social_media_output .= '<li class="'.$value.'">';
			$social_media_output .= '<a class="icon-'.$value.'" target="'.$target.'" href="'. $link .'" title="'. esc_attr( $key ) .'">';
			
			! empty( $followText )
			and	$social_media_output .= '<span>'. esc_attr( $followText ) .'</span>';

			empty( $followText )
			and	$social_media_output .= '<span>'. esc_attr( $key ) .'</span>';

			$social_media_output .= '</a>';
			$social_media_output .= '</li>';
		}
	}

	if($social_media_output){
		return  '<ul class="social_media">'.$social_media_output.'</ul>';
	}
	}
}

add_shortcode('rt_social_media_icons', 'rt_social_media');


/*
* ------------------------------------------------- *
*		Buttons
* ------------------------------------------------- *
*/

if( ! function_exists("rt_shortcode_button") ){
	function rt_shortcode_button( $atts, $content = null ) {		

	//defaults
	extract(shortcode_atts(array(  
		"id"                => '',
		"button_size"       => 'small',
		"button_text"       => '',
		"button_link"       => '',
		"button_icon"       => '',
		"button_align"      => '',
		"link_open"         => '_self',
		"margin_top"		=> 5,
		"button_style"		=> 'default',
		"href_title"		=> '',	
	), $atts));

	$button = ""; 

	$href_title = ! empty( $href_title ) ? $href_title : $button_text;


	//button format
	$button_format = '<a id="%s" href="%s" target="%s" title="%s" class="button_ %s %s %s margin-t%s align%s" data-rt-animate="animate" data-rt-animation-type="bounceIn" data-rt-animation-group="single" >%s</a>';

	$button = sprintf($button_format, $id, $button_link, $link_open, strip_tags( $href_title ), $button_style, $button_size, $button_icon, $margin_top, $button_align, $button_text);

	return $button;
	}
}

add_shortcode('button', 'rt_shortcode_button');	

/*
* ------------------------------------------------- *
*		Banners
* ------------------------------------------------- *
*/

if( ! function_exists("rt_shortcode_banner") ){
	function rt_shortcode_banner( $atts, $content = null ) {		

	//[banner id="" button_text="Button Text" button_link="link" link_target="_self" button_icon="icon-cart" button_size="small" button_style="default" border="false" gradient="false"]Banner Text[/banner]

	//defaults
	extract(shortcode_atts(array(  
		"id"             => "",
		"text_icon"      => '',
		"text_alignment" => 'left',
		"button_text"    => 'medium',
		"button_icon"    => '',
		"button_link"    => '',
		"button_size"    => 'small',
		"button_style"	 => 'default',
		"link_target"    => '_self',
		"border"    	 => '',
		"gradient"    	 => '',
	), $atts));

	#
	# Button
	# 

		$button_before_text = $button_after_text = $withbutton = $button = "";

		//button alignment
		$button_align = ( $text_alignment == "center") ? "center" : "right";			

		//top margin
		$margin_top = strstr($content, "<small>" ) ? 15 : 10;

		//button format
		$button_format = '
			[button 
				button_size = "'.$button_size.'" 
				button_text = "'.$button_text.'" 
				button_link = "'.$button_link.'" 
				button_icon = "'.$button_icon.'" 
				button_align = "'.$button_align.'" 
				margin_top = "'.$margin_top.'"
				link_open = "'.$link_target.'" 
			]
		';
 
		! empty( $button_text )		
			and $button = do_shortcode($button_format);

		if ($text_alignment == "center"){
			$button_after_text = $button;
		}else{
			$button_before_text = $button;
		}
			
	#
	# Banner
	#

		$id = empty( $id) ? "random-".rand(100000, 1000000): $id;

		//withbutton
		! empty( $button_before_text ) || ! empty( $button_after_text ) 
			and $withbutton = "withbutton";

		//withbutton
		! empty( $border ) && $border != "false"
			and $border = "withborder";

		//gradient
		! empty( $gradient ) && $gradient != "false"
			and $gradient = "gradient";

		//text icon position
		$text_icon_position = ( !empty( $text_icon ) && $text_alignment == "center") ? "big_icon_top" : "icon";			

 

		//banner format
		if( $text_alignment == "left"){
			$banner_format = '
				<div id="%1$s" class="banner %9$s %10$s clearfix" data-rt-animate="animate" data-rt-animation-type="fadeIn" data-rt-animation-group="single" >
				%8$s
					<div class="featured_text %2$s %3$s_button %4$s">
						<p class="%5$s %6$s">%7$s</p>
					</div>				
				</div>
			';
		}else{
			$banner_format = '
				<div id="%1$s" class="banner %9$s %10$s clearfix" data-rt-animate="animate" data-rt-animation-type="fadeIn" data-rt-animation-group="single" >			
					<div class="featured_text %2$s %3$s_button %4$s">
						<p class="%5$s %6$s">%7$s</p>
						%8$s
					</div>				
				</div>
			';
		}

		//textalign
		$text_alignment = ( $text_alignment == "center") ? "align".$text_alignment : "";			

		//banner output
		$banner = sprintf($banner_format, 
			$id,
			$withbutton,
			$button_size,
			$text_alignment,
			$text_icon,
			$text_icon_position,
			$content,
			$button,
			$border,
			$gradient //->10
			);
		return $banner;
	} 
}

add_shortcode('banner', 'rt_shortcode_banner');	

					
/*
* ------------------------------------------------- *
*		Sidebar Box
* ------------------------------------------------- *
*/

if( ! function_exists("rt_sidebar_box") ){
	function rt_sidebar_box( $atts, $content = null ) {
	//[sidebar_box sidebar_id="sidebar-for-footer-column-4" widget_box_width="4"]
	global $rt_widget_num,$rt_home_contents_count,$rt_box_width,$rt_sidebarID, $rt_sidebars_class; 

	//defaults
	extract(shortcode_atts(array(
		"sidebar_id"    	 => '',
		"widget_box_width"   => '4',
		"location"			 => 'default'
	), $atts));
		
	ob_start();

	$rt_box_width 	= $widget_box_width;
	$rt_home_contents_count=0;//reset widget count
	$rt_widget_num=false;//reset widget count 
	$rt_sidebarID = $sidebar_id;

	//add box layouts to the widgets
	add_filter('dynamic_sidebar_params', array( $rt_sidebars_class, 'home_page_layout_class' ) );  				

	//add footer class names if this widget inside the footer 
	if( $location == "footer" ){
		add_filter('dynamic_sidebar_params', array( $rt_sidebars_class, 'fix_footer_widgets_class' ) );  				
	}
 

	dynamic_sidebar($sidebar_id);	 

	$output_string = ob_get_contents();
	ob_end_clean(); 

	return $output_string; 
	}
}

add_shortcode('sidebar_box', 'rt_sidebar_box'); 


/*
* ------------------------------------------------- *
*		HEADING BAR
* ------------------------------------------------- *
*/

if( ! function_exists("rt_heading_bar") ){
	function rt_heading_bar( $atts, $content = null ) {
	// [heading_bar heading="" icon="" style=""]

	//defaults
	extract(shortcode_atts(array(
		"id" => '',
		"heading" => '',
		"icon"    => '',
		"style"   => '',
	), $atts));

	
	$icon_output = ! empty( $icon ) ? sprintf('<span class="%s heading_icon"></span>', $icon) : "";
	
	if ( empty( $style ) ){
		$heading_output = ! empty( $heading ) ? sprintf('<div class="title_line margin-b20"><h3 class="featured_article_title" data-rt-animate="animate" data-rt-animation-type="fade" data-rt-animation-group="single">%s %s</h3></div>',$icon_output, $heading) : "";
	}else{
		$heading_output = ! empty( $heading ) ? sprintf('<h3 class="featured_article_title heading-%s" data-rt-animate="animate" data-rt-animation-type="fade" data-rt-animation-group="single">%s %s</h3>',$style, $icon_output, $heading) : "";
	}

	return $heading_output; 
	}
}

add_shortcode('heading_bar', 'rt_heading_bar'); 


/*
* ------------------------------------------------- *
*		SPACE BAR
* ------------------------------------------------- *
*/

if( ! function_exists("rt_space_box") ){
	function rt_space_box( $atts, $content = null ) {
	// [space_box id="" height=""]

	//defaults
	extract(shortcode_atts(array(
		"id"  => '', 
		"height"  => 0, 
	), $atts));

	$style = intval( $height ) > 0 ? 'style="height:'.$height.'px"' : "";
	
	$output = ! empty( $id ) ? sprintf('<div id="%s" class="clearfix" %s></div>', $id, $style) : sprintf('<div class="clearfix" %s></div>',$style);

	return $output; 
	}
}

add_shortcode('space_box', 'rt_space_box'); 


/*
* ------------------------------------------------- *
*		PRICING TABLES
* ------------------------------------------------- *
*/

//table holder
if( ! function_exists("rt_table_holder") ){
	function rt_table_holder( $atts, $content = null ) {
	// [pricing_table style=""]

	//defaults
	extract(shortcode_atts(array(
		"style"  => '',
	), $atts));

	$output = '<div class="pricing_table '.$style.'" data-rt-animation-group="group">'; 

	$content = preg_replace('/<br \/>$/', '', trim($content));
	$content = preg_replace('/<br \/>/', '', $content, 1);

	$output .= do_shortcode( $content );
	$output .= '</div>';

	return $output;
	}
}

add_shortcode('pricing_table', 'rt_table_holder'); 			

//table columns
if( ! function_exists("rt_table_columns") ){
	function rt_table_columns( $atts, $content = null ) {
	//[table_column caption="" price="" info="" style=""]

	//defaults
	extract(shortcode_atts(array(
		"style"  => '',
		"caption" => '',
		"price" => '',
		"info" => ''
	), $atts));

	$output = '<div class="table_wrap '.$style.'" data-rt-animate="animate" data-rt-animation-type="fadeInDown"><ul>';	 
	

	$info_output = sprintf('
	<small>
		%s 
	</small>
	',$info);
 
	$output .= ! empty( $caption ) && $style != "features" ? sprintf('
		<li class="caption">
			<div class="title">%s%s</div>
		</li>
		',$caption,$info_output) : '<li class="caption empty"></li>';

	$output .= ! empty( $price ) && $style != "features"  ? sprintf('
		<li class="price">
			<div>
				<span>%s</span>
			</div>
		</li>
		',$price) : '<li class="price empty"></li>';


	$content = preg_replace('/<ul>/', '', $content, 1);

	if( $style != "features" ){
		$content = preg_replace('/<li>/', '<li class="start_position">', $content, 1);
	}else{
		$content = preg_replace('/<li>/', '<li class="features_start_position">', $content, 1);
	}

	$output .= do_shortcode( $content );
	$output .= '</div>';

	return $output;
	}
}

add_shortcode('table_column', 'rt_table_columns'); 			


/*
* ------------------------------------------------- *
*		Icons
* ------------------------------------------------- *
*/

if( ! function_exists("rt_icons") ){
	function rt_icons( $atts ) {
	// [icon name=""]

	//defaults
	extract(shortcode_atts(array(
		"name"  => '',
	), $atts));

	return '<span class="'.$name.'" data-rt-animate="animate" data-rt-animation-type="fadeInDown" data-rt-animation-group="single"></span>';
	}
}

add_shortcode('icon', 'rt_icons'); 			


/*
* ------------------------------------------------- *
*		TOOLTIP		
* ------------------------------------------------- *		
*/ 
if( ! function_exists("rt_tooltip") ){
	function rt_tooltip( $atts, $content = null ) {

	//[tooltip text="" link="" target="" color="black"]content[/tooltip]
 
	//defaults
	extract(shortcode_atts(array(  
		"text"   => '',
		"link"   => '',
		"target" => '',
		"color"  => 'black'
	), $atts));	

	$rt_tooltip	=""; 
	
	if($link)	$rt_tooltip .=  '<a href="'.$link.'" target="'.$target.'" class="t_'.$color.' j_ttip" title="'.$text.'" >';
	if(!$link)	$rt_tooltip .= '<span class="t_'.$color.' j_ttip" title="'.$text.'" >';		

	$rt_tooltip .= do_shortcode( $content );

	if(!$link)	$rt_tooltip .= '</span>';	
	if($link)	$rt_tooltip .= '</a>';
	
	return $rt_tooltip;
	}
}

add_shortcode('tooltip', 'rt_tooltip'); 


/*
* ------------------------------------------------- *
*		Info Boxes
* ------------------------------------------------- *
*/

if( ! function_exists("rt_info_box") ){
	function rt_info_box( $atts, $content = null ) {
	// [info_box style=""][/info_box]

	//defaults
	extract(shortcode_atts(array(
		"style"  => 'info', //announcement, ok, attention, info 
	), $atts));

	$icons = array(
				"announcement"=>"icon-megaphone-1",
				"ok"=>"icon-thumbs-up-1",
				"attention"=>"icon-attention",
				"info"=>"icon-info-circled" 
			);

	$output = sprintf('
		<div class="info_box margin-b20 clearfix %s" data-rt-animate="animate" data-rt-animation-type="fadeInDown" data-rt-animation-group="single">
			<span class="icon-cancel"></span>
			<p class="%s">
				%s
			</p>
		</div>
	',$style,$icons[$style], $content ); 

	return $output;
	}
}

add_shortcode('info_box', 'rt_info_box'); 			


/*
* ------------------------------------------------- *
*		PULLQUOTE
* ------------------------------------------------- *
*/

if( ! function_exists("rt_pullquote") ){
	function rt_pullquote( $atts, $content = null ) {
	// [pullquote align=""][/pullquote]

	//defaults
	extract(shortcode_atts(array(
		"align"  => 'left',
	), $atts));
 
	$output = sprintf('
		<blockquote class="pullquote align%s" data-rt-animate="animate" data-rt-animation-type="fadeInDown" data-rt-animation-group="single">%s</blockquote>
	',$align, $content ); 

	return $output;
	}
}

add_shortcode('pullquote', 'rt_pullquote'); 			

/*
* ------------------------------------------------- *
*		Default Content
* ------------------------------------------------- *
*/

if( ! function_exists("rt_default_content") ){
	function rt_default_content( $atts, $content = null ) {
	//[default_content]
	global $rt_post_type, $rt_global_post_values, $post;

	ob_start();

	wp_reset_query(); 


		// content of single product page
		if( $rt_post_type == "products" ){
			get_template_part( '/product-contents/single', 'products-content' );			
		}

		// content of single portfolio page
		elseif( $rt_post_type == "portfolio" ){
			get_template_part( '/portfolio-contents/single', 'portfolio-content' );
		}

		// content of arcgive of woocommerce
		elseif( $rt_post_type == "product" && is_archive() ){
			get_template_part( '/woocommerce/templatebuilder/archive', 'product' );
		}

		// content of single product page of woocommerce
		elseif( $rt_post_type == "product" && is_single() ){
			get_template_part( '/woocommerce/templatebuilder/single', 'product' );
		}		

		// content of single staff page
		elseif( $rt_post_type == "staff" && is_single() ){
			get_template_part( '/staff-contents/single', 'staff-content' );
		}	

		// content of single post
		elseif( $rt_post_type == "post" ){
			//get global post values
			$rt_global_post_values = rt_get_global_post_values( $post );
			get_template_part( '/post-contents/single-content', get_post_format() ); 
			
			//get comments
			if( comments_open() ){
				echo '<div class="entry commententry">';
					comments_template();
				echo '</div>';
			}

		}

		else{
			get_template_part( 'content', 'page' );

			//get comments
			if( comments_open() && get_option(RT_THEMESLUG."_allow_page_comments") ){
				echo '<div class="entry commententry">';
					comments_template();
				echo '</div>';
			}			
		}


	$output_string = ob_get_contents();
	ob_end_clean(); 

	return $output_string; 
	}
}

add_shortcode('default_content', 'rt_default_content'); 		


/*
* ------------------------------------------------- *
*		Video Embed
* ------------------------------------------------- *
*/

if( ! function_exists("rt_video_embed") ){
	function rt_video_embed( $atts, $content = null ) {
	//[video_embed  url=""]

	//defaults
	extract(shortcode_atts(array(
		"url" => ''
	), $atts));

	//external videos
	if ($url){
		 
		if( ! strpos($url, 'youtube') || ! strpos($url, 'vimeo') ){
			$video  = __("Only YouTube and Vimeo videos are supported with this shortcode.", "rt_theme_admin");
		}

		if( strpos($url, 'youtube')  ) { //youtube
			$video = '<div class="video-container"><iframe src="//www.youtube.com/embed/'.rt_find_tube_video_id($url).'" allowfullscreen></iframe></div>';
		}
		
		if( strpos($url, 'vimeo')  ) { //vimeo
			$video = '<div class="video-container"><iframe  src="//player.vimeo.com/video/'.rt_find_tube_video_id($url).'?color=d6d6d6&title=0&amp;byline=0&amp;portrait=0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
		} 

	} 
	
	return $video; 
	}
}

add_shortcode('video_embed', 'rt_video_embed'); 

/*
* ------------------------------------------------- *
*		Code Box
* ------------------------------------------------- *
*/

if( ! function_exists("rt_code_box") ){
	function rt_code_box( $atts, $content = null ) {
	//[code_box  heading=""]code_space[/code_box]

	//defaults
	extract(shortcode_atts(array(
		"heading"    => '', 
	), $atts));


	$heading_output = ! empty( $heading ) ? sprintf('<h3 class="featured_article_title">%s</h3>', $heading) : "";


	$output = $heading_output . do_shortcode( $content );

	return $output; 	
	}
}

add_shortcode('code_box', 'rt_code_box'); 

 
/*
* ------------------------------------------------- *
*		Widget Caller
* ------------------------------------------------- *
*/
if( ! function_exists("rt_product_categories") ){
	function rt_product_categories($atts, $content = null){
	
	global $rt_list_atts, $rt_category;

	//defaults
	$rt_list_atts = shortcode_atts( array(  
		"id"                   => '',
		"class"                => '',
		"ids"                  => '',
		"item_width"           => 4,
		"display_titles"       => "true",		
		"display_descriptions" => "true",		
		"display_thumbnails"   => "true",		
		"image_max_height"     => '',
		"crop"                 => '',
		'orderby'              => 'name',
		"order"                => "ACS",
		'parent'               => 0,
	), $atts );

	extract( $rt_list_atts );
	ob_start();
	
	// Product Categories		
	$product_args = array(
		'type'         => 'post',
		'orderby'      => $orderby,
		'order'        => $order,
		'hide_empty'   => 0,
		'hierarchical' => 1,  
		'taxonomy'     => 'product_categories',
		'pad_counts'   => true,
		'include'      => $ids,
		'parent' 		=> empty( $parent ) ? 0 : $parent
	);	

	$product_categories = get_categories($product_args);

	//fix true false
	$rt_list_atts["display_titles"] = ! empty( $display_titles ) && $display_titles !== "false" ? "true" : "false";
	$rt_list_atts["display_descriptions"] = ! empty( $display_descriptions ) && $display_descriptions !== "false" ? "true" : "false";
	$rt_list_atts["display_thumbnails"] = ! empty( $display_thumbnails ) && $display_thumbnails !== "false" ? "true" : "false";
	$rt_list_atts["crop"] = ! empty( $crop ) && $crop !== "false" ? "true" : $crop;

	//id attr
	$id = ! empty( $id ) ? 'id="'.sanitize_html_class($id).'"' : "";	 

	//layout name values
	$layout_values = array('','one', 'two', 'three', 'four', 'five');

	//output
	echo '<div '.$id.' class="product-showcase-categories clearfix '.sanitize_html_class($class).'">';
	echo '<div class="product_boxes" data-rt-animation-group="group">';	

	//items at the first and last row
	$first_row = "first-row";
	$last_row = "";

	$counter = 1;

	foreach ($product_categories as $key => $category ) {

			$rt_category  = $category;

			//open row block
			if(  $counter % $item_width == 1 || $item_width == 1 ){
				echo '<div class="row clearfix with_borders fluid">';
			}	

			//column class
			$add_class = "";
			if( $counter % $item_width == 1 || $item_width == 1 ){
				$add_class .= " first";

				$first_row = $first_row == "first-row" && $counter != 1 ? "" : $first_row; //add first row clas to boxes 
				$last_row = count( $product_categories ) - $counter < $item_width ? "last-row" : ""; //add last row clas to boxes 
			}

			if( ( $counter % $item_width == 0 || count( $product_categories ) == $counter ) ){
				$add_class .= " last";								
			}

			printf('<div class="box %s %s %s %s"><div data-rt-animate="animate" data-rt-animation-type="fadeIn">'."\n", $layout_values[$item_width], $add_class, $first_row, $last_row );
			
				get_template_part( 'product-contents/category-shortcode-content' ); 	

			echo '</div></div>'."\n";

			//close row block
			if( $counter % $item_width == 0 || count( $product_categories ) == $counter ){
				echo '</div>';  
			}

		$counter++;
	}

	echo '</div>';	
	echo '</div>';	


	$output_string = ob_get_contents();

	ob_end_clean(); 

	return $output_string;
	}
}	

add_shortcode('rt_product_categories', 'rt_product_categories');
?>