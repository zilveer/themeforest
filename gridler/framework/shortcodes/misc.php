<?php


function theme_shortcode_images_url($atts, $content = null) {
  return get_template_directory_uri() . '/images'; 
}
add_shortcode("images_url", "theme_shortcode_images_url"); 


//Image Frame

function theme_image_frame( $atts, $content = null ) {
   return '<img class="image-frame" src="' . do_shortcode($content) . '" alt="" />';
} add_shortcode('image_frame', 'theme_image_frame');

//Pretty Photo Shortcodes
function theme_prettyphoto_video( $atts, $content = null ) {
  extract(shortcode_atts(array(
  'url' => '',
  ), $atts));
   return '<a href="' .$url. '" rel="prettyPhoto">' . do_shortcode($content) . '</a>';
} add_shortcode('lightbox_video', 'theme_prettyphoto_video');


//Headings
function theme_shortcode_h2( $atts, $content = null ) {
   return '<h2>' . do_shortcode($content) . '</h2>';
} add_shortcode('h2', 'theme_shortcode_h2');

function theme_shortcode_h3( $atts, $content = null ) {
   return '<h3>' . do_shortcode($content) . '</h3>';
} add_shortcode('h3', 'theme_shortcode_h3');

function theme_shortcode_h4( $atts, $content = null ) {
   return '<h4>' . do_shortcode($content) . '</h4>';
} add_shortcode('h4', 'theme_shortcode_h4');

function theme_shortcode_h5( $atts, $content = null ) {
   return '<h5>' . do_shortcode($content) . '</h5>';
} add_shortcode('h5', 'theme_shortcode_h5');

function theme_shortcode_h6( $atts, $content = null ) {
   return '<h6>' . do_shortcode($content) . '</h6>';
} add_shortcode('h6', 'theme_shortcode_h6');


//Text Callout
function theme_shortcode_callout($atts, $content = null) {
  extract(shortcode_atts(array(
  'align' => '',
  'button' => '',
  'button_color' => 'black',
  'button_link' => '#',
  'button_align' => 'right',
  'button_size' => 'medium',
  'button_text' => ''
  ), $atts));
	
	if ($button){ $button_print = '<a class="button ' .$button_size. ' ' .$button_color. ' align' .$button_align. '" href="' .$button_link. '"><span>' .$button_text. '</span></a>';}  
	if ($button){
   return '[raw]<div class="callout gfont ' .$align. '">' .$button_print. '' . do_shortcode($content) . '</div><div class="clear"></div>[/raw]';
	} else {
	return '[raw]<div class="callout gfont ' .$align. '">' . do_shortcode($content) . '</div><div class="clear"></div>[/raw]';	
	};
}
add_shortcode('callout', 'theme_shortcode_callout');



//Dropcap

function theme_shortcode_dropcap1( $atts, $content = null ) {
   return '<span class="dropcap1">' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap1', 'theme_shortcode_dropcap1');

function theme_shortcode_dropcap2( $atts, $content = null ) {
   return '<span class="dropcap2">' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap2', 'theme_shortcode_dropcap2');

//Pullquote

function theme_shortcode_pullquote_right( $atts, $content = null ) {
   return '<span class="pullquote_right">' . do_shortcode($content) . '</span>';
}
add_shortcode('pullquote_right', 'theme_shortcode_pullquote_right');


function theme_shortcode_pullquote_left( $atts, $content = null ) {
   return '<span class="pullquote_left">' . do_shortcode($content) . '</span>';
}
add_shortcode('pullquote_left', 'theme_shortcode_pullquote_left');


//Dividers

function theme_shortcode_divider() {
	return '<div class="divider"></div>';
}
add_shortcode('divider', 'theme_shortcode_divider');

function theme_shortcode_divider_dashed() {
	return '<div class="divider_dashed"></div>';
}
add_shortcode('divider_dashed', 'theme_shortcode_divider_dashed');

function theme_shortcode_divider_top() {
	return '<div class="divider"><a class="top" href="#">Top</a></div>';
}
add_shortcode('divider_top', 'theme_shortcode_divider_top');

function theme_shortcode_clearboth() {
   return '<div class="clear"></div>';
}
add_shortcode('clearboth', 'theme_shortcode_clearboth');

//Highlights

function theme_shortcode_highlight( $atts, $content = null ) {
   return '<span class="highlight">' . do_shortcode($content) . '</span>';
}
add_shortcode('highlight', 'theme_shortcode_highlight');

//Notifications

function theme_shortcode_notification_success( $atts, $content = null ) {
   return '<div class="notification success">' . do_shortcode($content) . '</div>';
}
add_shortcode('notification_success', 'theme_shortcode_notification_success');

function theme_shortcode_notification_error( $atts, $content = null ) {
   return '<div class="notification error">' . do_shortcode($content) . '</div>';
}
add_shortcode('notification_error', 'theme_shortcode_notification_error');

function theme_shortcode_notification_warning( $atts, $content = null ) {
   return '<div class="notification warning">' . do_shortcode($content) . '</div>';
}
add_shortcode('notification_warning', 'theme_shortcode_notification_warning');

function theme_shortcode_notification_info( $atts, $content = null ) {
   return '<div class="notification info">' . do_shortcode($content) . '</div>';
}
add_shortcode('notification_info', 'theme_shortcode_notification_info');

function theme_shortcode_notification_tip( $atts, $content = null ) {
   return '<div class="notification tip">' . do_shortcode($content) . '</div>';
}
add_shortcode('notification_tip', 'theme_shortcode_notification_tip');

// Content Toggle

function theme_shortcode_toggle_content( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'title'      => '',
    ), $atts));
	
   return '[raw]<h3 class="toggle"><a href="#">' .$title. '</a></h3><div class="toggle_content" style="display: none;">' . do_shortcode($content) . '</div>[/raw]';
}
add_shortcode('toggle', 'theme_shortcode_toggle_content');


//  List Styles 

function theme_shortcode_checklist( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="checklist">', do_shortcode($content));
	return $content;
}
add_shortcode('checklist', 'theme_shortcode_checklist');

function theme_shortcode_bulletlist( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="bulletlist">', do_shortcode($content));
	return $content;
}
add_shortcode('bulletlist', 'theme_shortcode_bulletlist');

function theme_shortcode_circlelist( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="circlelist">', do_shortcode($content));
	return $content;
}
add_shortcode('circlelist', 'theme_shortcode_circlelist');

function theme_shortcode_arrowlist( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="arrowlist">', do_shortcode($content));
	return $content;
}
add_shortcode('arrowlist', 'theme_shortcode_arrowlist');

function theme_shortcode_crosslist( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="crosslist">', do_shortcode($content));
	return $content;
}
add_shortcode('crosslist', 'theme_shortcode_crosslist');


function theme_shortcode_starlist( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="starlist">', do_shortcode($content));
	return $content;
}
add_shortcode('starlist', 'theme_shortcode_starlist');


function theme_twitter_feed($atts, $content = null) {
		//extracts our attrs . if not set set default
		extract(shortcode_atts(array(
		
			'id' => 'envato',
			'count' => 3
		
		), $atts));
		
		//twitter container ID
		$contId = randomTwitterId();
		
		//our output
		$output = '';
		
		//output script
		$output .= '<script type="text/javascript" charset="utf-8">
    getTwitters(\''.$contId.'\', {
        id: \''.$id.'\',
		prefix: \'\',
        clearContents: false,
        count: '.$count.', 
        ignoreReplies: false,
        newwindow: true,
        template: \'<img height="50" width="50" src="%user_profile_image_url%" class="alignleft" /><span class="twit-name">%user_screen_name%</span><span class="twit-time"> - %time%</span><br />%text%\'
    });
    </script>';
	
		//output container
		$output .= '[raw]<div class="twitter-feed" id="'.$contId.'"></div><div class="clear"></div>[/raw]';
		
		return $output;
		
	}
	
	function randomTwitterId() {
		
		$length = 10;
		$characters = 'abcdefghijklmnopqrstuvwxyz';
		$string = "";    
	
		for ($p = 0; $p < $length; $p++) {
			$string .= $characters[mt_rand(0, strlen($characters))];
		}
	
		return $string;
	}
	
	add_shortcode('twitter_feed', 'theme_twitter_feed');
	
	
function theme_testimonial($atts, $content = null) {
		
		//extracts our attrs . if not set set default
		extract(shortcode_atts(array(
		
			'author' => 'Anonymous',
			'location' => '',
			'image' => ''
		
		), $atts));
		
		if($image != '') {
			
			$output = '[raw]<blockquote class="testimonial"><span></span>'.$content.'</blockquote>
                                
                                <p class="testimonial_p"><img src="'.$image.'" alt="user" class="alignleft" /><span class="testimonial-name">'.$author.'</span><br />
                                <span class="testimonial-location">'.$location.'</span></p><div class="clear"></div>[/raw]';	
			
		} else {
			
			$output = '[raw]<blockquote class="testimonial"><span></span>'.$content.'</blockquote>
                                
                                <p class="testimonial_p"><span class="testimonial-name">'.$author.'</span><br />
                                <span class="testimonial-location">'.$location.'</span></p><div class="clear"></div>[/raw]';	
			
		}
						
		
						
		return $output;
		
	}
	add_shortcode('testimonial', 'theme_testimonial'	);
	
//List Pages Shortcode

function shortcode_list_pages( $atts, $content, $tag ) {
	
	global $post;
	
	// Child Pages
	$child_of = 0;
	if ( $tag == 'child-pages' )
		$child_of = $post->ID;
	if ( $tag == 'sibling-pages' )
		$child_of = $post->post_parent;
	
	// Set defaults
	$defaults = array(
		'class'       => $tag,
		'depth'       => 0,
		'show_date'   => '',
		'date_format' => get_option( 'date_format' ),
		'exclude'     => '',
		'include'     => '',
		'child_of'    => $child_of,
		'title_li'    => '',
		'authors'     => '',
		'sort_column' => 'menu_order, post_title',
		'sort_order'  => '',
		'link_before' => '',
		'link_after'  => '',
		'exclude_tree'=> '',
		'meta_key'    => '',
		'meta_value'  => '',
		'offset'      => '',
		'exclude_current_page' => 0
	);
	
	// Merge user provided atts with defaults
	$atts = shortcode_atts( $defaults, $atts );
	
	// Set necessary params
	$atts['echo'] = 0;
	if ( $atts['exclude_current_page'] && absint( $post->ID ) ) {
		if ( !empty( $atts['exclude'] ) )
			$atts['exclude'] .= ',';
		$atts['exclude'] .= $post->ID;
	}
	
	$atts = apply_filters( 'shortcode_list_pages_attributes', $atts, $content, $tag );
	
	// Create output
	$out = wp_list_pages( $atts );
	if ( !empty( $out ) )
		$out = '<ul class="' . $atts['class'] . '">' . $out . '</ul>';
	
	return apply_filters( 'shortcode_list_pages', $out, $atts, $content, $tag );
	
}

add_shortcode( 'child-pages', 'shortcode_list_pages' );
add_shortcode( 'sibling-pages', 'shortcode_list_pages' );
add_shortcode( 'list-pages', 'shortcode_list_pages' );