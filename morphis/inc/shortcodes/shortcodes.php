<?php 
/**
 * Shortcodes
 * Description: a collection of shortcodes
 *
 * @package WordPress
 * @subpackage Morphis
 * 
 */
 
function section_clear_shortcode( $atts, $content = null ) {	
	return ''. do_shortcode($content) . '<div class="clear"></div>';	
}
add_shortcode( 'section_clear', 'section_clear_shortcode' );


/* One-third Column */
function wpt_one_third_column_alpha( $atts, $content = null ) {	
	return '<section class="one-third column alpha half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'one_third_column_alpha', 'wpt_one_third_column_alpha' );

function wpt_one_third_column_omega( $atts, $content = null ) {	
	return '<section class="one-third column omega half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'one_third_column_omega', 'wpt_one_third_column_omega' );

function wpt_one_third_column( $atts, $content = null ) {	
	return '<section class="one-third column half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'one_third_column', 'wpt_one_third_column' );


/* Two-thirds Column */
function wpt_two_thirds_column_alpha( $atts, $content = null ) {	
	return '<section class="two-thirds column alpha half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'two_thirds_column_alpha', 'wpt_two_thirds_column_alpha' );

function wpt_two_thirds_column_omega( $atts, $content = null ) {	
	return '<section class="two-thirds column omega half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'two_thirds_column_omega', 'wpt_two_thirds_column_omega' );

function wpt_two_thirds_column( $atts, $content = null ) {	
	return '<section class="two-thirds column half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'two_thirds_column', 'wpt_two_thirds_column' );

/* Sixteen Columns */
function wpt_sixteen_columns_alpha( $atts, $content = null ) {	
	return '<section class="sixteen columns alpha half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'sixteen_columns_alpha', 'wpt_sixteen_columns_alpha' );

function wpt_sixteen_columns_omega( $atts, $content = null ) {	
	return '<section class="sixteen columns omega half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'sixteen_columns_omega', 'wpt_sixteen_columns_omega' );

function wpt_sixteen_columns( $atts, $content = null ) {	
	return '<section class="sixteen columns half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'sixteen_columns', 'wpt_sixteen_columns' );

/* Fifteen Columns */
function wpt_fifteen_columns_alpha( $atts, $content = null ) {	
	return '<section class="fifteen columns alpha half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'fifteen_columns_alpha', 'wpt_fifteen_columns_alpha' );

function wpt_fifteen_columns_omega( $atts, $content = null ) {	
	return '<section class="fifteen columns omega half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'fifteen_columns_omega', 'wpt_fifteen_columns_omega' );

function wpt_fifteen_columns( $atts, $content = null ) {	
	return '<section class="fifteen columns half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'fifteen_columns', 'wpt_fifteen_columns' );

/* Fourteen Columns */
function wpt_fourteen_columns_alpha( $atts, $content = null ) {	
	return '<section class="fourteen columns alpha half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'fourteen_columns_alpha', 'wpt_fourteen_columns_alpha' );

function wpt_fourteen_columns_omega( $atts, $content = null ) {	
	return '<section class="fourteen columns omega half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'fourteen_columns_omega', 'wpt_fourteen_columns_omega' );

function wpt_fourteen_columns( $atts, $content = null ) {	
	return '<section class="fourteen columns half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'fourteen_columns', 'wpt_fourteen_columns' );

/* Thirteen Columns */
function wpt_thirteen_columns_alpha( $atts, $content = null ) {	
	return '<section class="thirteen columns alpha half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'thirteen_columns_alpha', 'wpt_thirteen_columns_alpha' );

function wpt_thirteen_columns_omega( $atts, $content = null ) {	
	return '<section class="thirteen columns omega half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'thirteen_columns_omega', 'wpt_thirteen_columns_omega' );

function wpt_thirteen_columns( $atts, $content = null ) {	
	return '<section class="thirteen columns half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'thirteen_columns', 'wpt_thirteen_columns' );

/* Twelve Columns */
function wpt_twelve_columns_alpha( $atts, $content = null ) {	
	return '<section class="twelve columns alpha half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'twelve_columns_alpha', 'wpt_twelve_columns_alpha' );

function wpt_twelve_columns_omega( $atts, $content = null ) {	
	return '<section class="twelve columns omega half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'twelve_columns_omega', 'wpt_twelve_columns_omega' );

function wpt_twelve_columns( $atts, $content = null ) {	
	return '<section class="twelve columns half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'twelve_columns', 'wpt_twelve_columns' );

/* Eleven Columns */
function wpt_eleven_columns_alpha( $atts, $content = null ) {	
	return '<section class="eleven columns alpha half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'eleven_columns_alpha', 'wpt_eleven_columns_alpha' );

function wpt_eleven_columns_omega( $atts, $content = null ) {	
	return '<section class="eleven columns omega half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'eleven_columns_omega', 'wpt_eleven_columns_omega' );

function wpt_eleven_columns( $atts, $content = null ) {	
	return '<section class="eleven columns half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'eleven_columns', 'wpt_eleven_columns' );

/* Eight Columns */
function wpt_eight_columns_alpha( $atts, $content = null ) {	
	return '<section class="eight columns alpha half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'eight_columns_alpha', 'wpt_eight_columns_alpha' );

function wpt_eight_columns_omega( $atts, $content = null ) {	
	return '<section class="eight columns omega half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'eight_columns_omega', 'wpt_eight_columns_omega' );

function wpt_eight_columns( $atts, $content = null ) {	
	return '<section class="eight columns half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'eight_columns', 'wpt_eight_columns' );


/* Nine Columns */
function wpt_nine_columns_alpha( $atts, $content = null ) {	
	return '<section class="nine columns alpha half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'nine_columns_alpha', 'wpt_nine_columns_alpha' );

function wpt_nine_columns_omega( $atts, $content = null ) {	
	return '<section class="nine columns omega half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'nine_columns_omega', 'wpt_nine_columns_omega' );

function wpt_nine_columns( $atts, $content = null ) {	
	return '<section class="nine columns half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'nine_columns', 'wpt_nine_columns' );


/* Ten Columns */
function wpt_ten_columns_alpha( $atts, $content = null ) {	
	return '<section class="ten columns alpha half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'ten_columns_alpha', 'wpt_ten_columns_alpha' );

function wpt_ten_columns_omega( $atts, $content = null ) {	
	return '<section class="ten columns omega half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'ten_columns_omega', 'wpt_ten_columns_omega' );

function wpt_ten_columns( $atts, $content = null ) {	
	return '<section class="ten columns half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'ten_columns', 'wpt_ten_columns' );

/* Seven Columns */
function wpt_seven_columns_alpha( $atts, $content = null ) {	
	return '<section class="seven columns alpha half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'seven_columns_alpha', 'wpt_seven_columns_alpha' );

function wpt_seven_columns_omega( $atts, $content = null ) {	
	return '<section class="seven columns omega half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'seven_columns_omega', 'wpt_seven_columns_omega' );

function wpt_seven_columns( $atts, $content = null ) {	
	return '<section class="seven columns half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'seven_columns', 'wpt_seven_columns' );

/* Six Columns */
function wpt_six_columns_alpha( $atts, $content = null ) {	
	return '<section class="six columns alpha half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'six_columns_alpha', 'wpt_six_columns_alpha' );

function wpt_six_columns_omega( $atts, $content = null ) {	
	return '<section class="six columns omega half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'six_columns_omega', 'wpt_six_columns_omega' );

function wpt_six_columns( $atts, $content = null ) {	
	return '<section class="six columns half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'six_columns', 'wpt_six_columns' );

/* Five Columns */
function wpt_five_columns_alpha( $atts, $content = null ) {	
	return '<section class="five columns alpha half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'five_columns_alpha', 'wpt_five_columns_alpha' );

function wpt_five_columns_omega( $atts, $content = null ) {	
	return '<section class="five columns omega half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'five_columns_omega', 'wpt_five_columns_omega' );

function wpt_five_columns( $atts, $content = null ) {	
	return '<section class="five columns half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'five_columns', 'wpt_five_columns' );



/* Four Columns */
function wpt_four_columns_alpha( $atts, $content = null ) {	
	return '<section class="four columns alpha half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'four_columns_alpha', 'wpt_four_columns_alpha' );

function wpt_four_columns_omega( $atts, $content = null ) {	
	return '<section class="four columns omega half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'four_columns_omega', 'wpt_four_columns_omega' );

function wpt_four_columns( $atts, $content = null ) {	
	return '<section class="four columns half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'four_columns', 'wpt_four_columns' );


/* Three Columns */
function wpt_three_columns_alpha( $atts, $content = null ) {	
	return '<section class="three columns alpha half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'three_columns_alpha', 'wpt_three_columns_alpha' );

function wpt_three_columns_omega( $atts, $content = null ) {	
	return '<section class="three columns omega half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'three_columns_omega', 'wpt_three_columns_omega' );

function wpt_three_columns( $atts, $content = null ) {	
	return '<section class="three columns half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'three_columns', 'wpt_three_columns' );


/* Two Columns */
function wpt_two_columns_alpha( $atts, $content = null ) {	
	return '<section class="two columns alpha half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'two_columns_alpha', 'wpt_two_columns_alpha' );

function wpt_two_columns_omega( $atts, $content = null ) {	
	return '<section class="two columns omega half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'two_columns_omega', 'wpt_two_columns_omega' );

function wpt_two_columns( $atts, $content = null ) {	
	return '<section class="two columns half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'two_columns', 'wpt_two_columns' );

/* One Column */
function wpt_one_column_alpha( $atts, $content = null ) {	
	return '<section class="one column alpha half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'one_column_alpha', 'wpt_one_column_alpha' );

function wpt_one_column_omega( $atts, $content = null ) {	
	return '<section class="one column omega half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'one_column_omega', 'wpt_one_column_omega' );

function wpt_one_column( $atts, $content = null ) {	
	return '<section class="one column half-bottom">' . do_shortcode($content) . '</section>';	
}
add_shortcode( 'one_column', 'wpt_one_column' );


/* -------------- Youtube Shortcode -------------- */
function youtube_pulp_shortcode($atts, $content=null){

	extract(shortcode_atts( array('id' => '', 'caption' => ''), $atts));

	$return = $content;
	
	$with_caption = '';
	if($content)
		$return .= "<br /><br />";
		
	if($caption != ''):
		$caption = '<div class="video-caption"><p>' . $caption . '</p></div>';
		$with_caption = 'with-caption';
	else:
		
	endif;

	$return .= '<div class="video-figure '. $with_caption .'"><iframe class="youtube-video" width="560" height="349" src="http://www.youtube.com/embed/' . $id . '" frameborder="0" allowfullscreen></iframe></div>' . $caption . '';

	return $return; 

}
add_shortcode('youtube', 'youtube_pulp_shortcode');


/* -------------- Google Maps Shortcode -------------- */
function gsm_google_static_map_shortcode($atts, $content = NULL){

  $args = shortcode_atts(array(

    //defaults          
    'center' => '41.88,-87.63',
    'zoom' => '14',
    'map_height' => '500',
    'scale' => '1',
    'sensor' => 'true',
    'maptype' => 'roadmap',
    'format' => 'png',
    'markers' => $atts['center'],
	'caption' => ''
  
  ), $atts );

  $map_url = '';
  
  //show a heading above the map image using the supplied content, if it exists
  if($content != NULL) $map_url = '<h3>' . $content . '</h3>';
   
  //construct map url with img title and alt attributes using supplied content 
  $map_url .= '<div class="squared"><figure><img class="full-pic-width" src="http://maps.googleapis.com/maps/api/staticmap?';
  
  foreach($args as $arg => $value){
	if($arg != 'caption' && $arg != 'map_height') {
		$map_url .= $arg . '=' . urlencode($value) . '&';
	} elseif ($arg == 'map_height') {
		$map_url .= 'size=700x' . urlencode($value) . '&';
	} else {
		if($value != '')
		$caption = '<div class="video-caption"><p style="display:inline;">' . $value . '</p></div>';
	}
  
  }
  
  $map_url .= '"/></figure>' . $caption . '</div><div class="clear"></div>';
  
  return $map_url;

}
add_shortcode( 'gsm_google_static_map', 'gsm_google_static_map_shortcode' );


/* -------------- Buttons Shortcode -------------- */
function button_shortcode($atts, $content=null){

	extract(shortcode_atts( array('url' => '', 'size' => '', 'color' => 'white', 'target' => '_self'), $atts));

	return '<a href="'. $url .'" target="'. $target .'" class="button '. $size .' '. $color .'">' . do_shortcode($content) . '</a>';

}

add_shortcode('button', 'button_shortcode');

/* -------------- Tabs Shortcode -------------- */
function tabs_shortcode($atts, $content=null){
		$defaults = array();
		extract( shortcode_atts( $defaults, $atts ) );
		
		// Extract the tab titles for use in the tab widget.
		preg_match_all( '/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
		
		$tab_titles = array();
		if( isset($matches[1]) ){ $tab_titles = $matches[1]; }
		
		$output = '';		
		if( count($tab_titles) ){		   
			$output .= '<ul class="tabs">';
			$countTab = 0;
			foreach( $tab_titles as $tab ){
				$countTab++;
				if($countTab == 1) :
				$output .= '<li><a class="active" href="#'. sanitize_title( $tab[0] ) .'">' . $tab[0] . '</a></li>';
				else :
				$output .= '<li><a href="#'. sanitize_title( $tab[0] ) .'">' . $tab[0] . '</a></li>';
				endif;
			}
		    
		    $output .= '</ul>';
		    $output .= '<ul class="tabs-content">' . do_shortcode( $content ) . '</ul>';		    
		} else {
			$output .= do_shortcode( $content );
		}
		
		return $output;

}

add_shortcode('tabs', 'tabs_shortcode');

if (!function_exists('tab')) {
	function tab( $atts, $content = null ) {
		$defaults = array( 'title' => 'Tab' );
		extract( shortcode_atts( $defaults, $atts ) );
		
		return '<li id="'. sanitize_title( $title ) .'">'. do_shortcode( $content ) .'</li>';
	}
	add_shortcode( 'tab', 'tab' );
}

/* -------------- Accordions Shortcode -------------- */
function accordions_shortcode($atts, $content=null){
		$defaults = array();
		extract( shortcode_atts( $defaults, $atts ) );
		
		// Extract the tab titles for use in the tab widget.
		preg_match_all( '/accordion title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
		
		$tab_titles = array();
		if( isset($matches[1]) ){ $tab_titles = $matches[1]; }
		
		$output = '';
		
		if( count($tab_titles) ){
		    $output .= '<div id="accordion">';
			
			$output .= do_shortcode( $content );
		    
		    $output .= '</div>';
		} else {
			$output .= do_shortcode( $content );
		}		

		return $output;

}

add_shortcode('accordions', 'accordions_shortcode');

if (!function_exists('accordion')) {
	function accordion( $atts, $content = null ) {
		$defaults = array( 'title' => 'Accordion' );
		extract( shortcode_atts( $defaults, $atts ) );
		
		return '<div class="accordion-button"><a href="#">' . $title . '</a></div><div class="accordion-content">'. do_shortcode( $content ) .'</div>';
	}
	add_shortcode( 'accordion', 'accordion' );
}

/* -------------- Centered Heading -------------- */
if (!function_exists('centered_heading_shortcode')) {
	function centered_heading_shortcode( $atts, $content = null ) {
		
		extract(shortcode_atts(  array( 'header' => 'h4', 'sub_header' => '', 'sub_header_url' => '', 'sub_header_target' => '_self' ), $atts));		
		return '<'. $header .' class="centered-heading"><span>'. do_shortcode( $content ) .'</span><a target="'. $sub_header_target .'" href="'. $sub_header_url .'">' . $sub_header . '</a></'. $header .'>';						
	}
	add_shortcode( 'centered_heading', 'centered_heading_shortcode' );
}

/* -------------- Drop Cap -------------- */
if (!function_exists('dropcap_shortcode')) {
	function dropcap_shortcode( $atts, $content = null ) {
		
		$firstLetter = '';
		$prePendContent = '';
		
		$firstLetter = substr($content, 0 , 1);
		$prePendContent = substr($content, 1);
		
		return '<p><span class="dropcap">'. $firstLetter .'</span>'. do_shortcode( $prePendContent ) .'</p>';		
		
	}
	add_shortcode( 'dropcap', 'dropcap_shortcode' );
}

/* -------------- Blockquote -------------- */
if (!function_exists('blockquote_shortcode')) {
	function blockquote_shortcode( $atts, $content = null ) {
		
		extract(shortcode_atts(  array( 'cite' => '' ), $atts));		
		$optional_cite = '';
		
		if($cite == '') {
			$optional_cite = ''; 
		} else {
			$optional_cite = '<cite>' . $cite . '</cite>';
		}
		
		return '<blockquote><p>' . do_shortcode($content) . '<span class="close-quote"></span></p>' . $optional_cite . '</blockquote>';		
		
	}
	add_shortcode( 'blockquote', 'blockquote_shortcode' );
}

/* -------------- Highlight Text Shortcode -------------- */
function highlight_shortcode($atts, $content=null){

	extract(shortcode_atts( array('color' => 'red'), $atts));

	return '<span class="highlight-text highlight-'. $color .'">'. do_shortcode($content) .'</span>';

}

add_shortcode('highlight', 'highlight_shortcode');


/* -------------- Horizontal Lines Shortcode -------------- */
function hr_line_shortcode($atts, $content=null){

	extract(shortcode_atts( array('style' => ''), $atts));

	return '<hr class="'. $style .'" />';

}

add_shortcode('hr_line', 'hr_line_shortcode');


/* -------------- Lists Shortcode -------------- */
function lists_shortcode($atts, $content=null){

	extract(shortcode_atts( array('list_type' => 'ul', 'style' => ''), $atts));

	if($list_type == 'ol'): $style_s = '';
	else: $style_s = $style;
	endif;
	
	return '<'. $list_type .' class="'. $style_s .' clearfix">'. do_shortcode($content) .'</'. $list_type .'>';	

}

add_shortcode('lists', 'lists_shortcode');

function list_item_shortcode($atts, $content=null){
	
	return '<li>'. do_shortcode($content) .'</li>';	

}

add_shortcode('list_item', 'list_item_shortcode');


/* -------------- Notification Boxes Shortcode -------------- */
function info_boxes_shortcode($atts, $content=null){

	extract(shortcode_atts( array('type' => 'tip'), $atts));
	 
	return	'<div id="info-box">
			<div class="info-box '. $type .'">
				<a href="#" class="info-icon"></a>								
				<p>'. do_shortcode($content) .'</p>
				<a href="#" class="info-close-icon"></a>
			</div> 
		</div>';

}

add_shortcode('info_boxes', 'info_boxes_shortcode');



/* -------------- Image Floats Shortcode -------------- */
function image_floats_shortcode($atts, $content=null){

	extract(shortcode_atts( array('img_link_url' => '', 'img_link_target' => '_self', 'img_width' => '300', 'float' => '', 'caption' => '', 'allow_lightbox' => '0'), $atts));
	
	$content_decoded = utf8_encode(html_entity_decode($content));
	$wrap_center_above = '';
	$wrap_center_below = '';
	$rel = '';
	$img_width_wrapper = '';
	$tag_img_width_wrapper = '';
	
		
	if($img_width != '') {
		$img_width_wrapper = 'style="width:'. $img_width .'px;"';
		$tag_img_width_wrapper = 'width="'. $img_width .'"';
	}
	
	
	if($float =='center-align-image') {
		
		$wrap_center_above = '<div class="center-align-container" ' . $img_width_wrapper . ' >';
		$wrap_center_below = '</div>';		
	}
	
	if($float =='no-align-image') {
		$wrap_center_above = '<div class="no-align-container" ' . $img_width_wrapper . '>';
		$wrap_center_below = '</div>';		
	}		
	
	if($allow_lightbox == 'on') {
		$rel = 'prettyPhoto';
	}	
	
	if ($img_link_url != '') { // has url 
	
		if(false === strpos($img_link_url, '://')){ // check if url is appropriate
			$img_link_url = 'http://' . $img_link_url;
		}
		
		$the_image = '<a href="' . $img_link_url . '" alt="' . $caption . '" title="' . $caption . '"><img class="image-height-auto" src="'. $content_decoded .'" alt="' . $caption . '" title="' . $caption . '" ' . $tag_img_width_wrapper . ' /></a>';
	} else { // no url w/ lightbox
		$img_link_url = $content_decoded;
		$the_image = '<a href="' . $img_link_url . '" rel=\''.$rel.'\' alt="' . $caption . '" title="' . $caption . '"><img class="image-height-auto" src="'. $content_decoded .'" alt="' . $caption . '" title="' . $caption . '" ' . $tag_img_width_wrapper . ' /></a>';
	}
	
	return $wrap_center_above . '<div class="clearfix '. $float .'">' . $the_image . '<div class="image-caption"><p>' . $caption . '</p></div></div>' . $wrap_center_below;

}

add_shortcode('image_floats', 'image_floats_shortcode');


/* -------------- Vimeo Shortcode -------------- */
function vimeo_pulp_shortcode($atts, $content=null) {

	extract(shortcode_atts( array('vimeo_id' => '', 'vimeo_caption' => '', 'color' => '00adef'), $atts));
	
	$color = str_replace('#', '', $color);
	
	$return = $content;
	
	$caption = '';
	$with_caption = '';
	
	if($content)
		$return .= "<br /><br />";
		
	if($vimeo_caption != ''):
		$caption = '<div class="video-caption"><p>' . $vimeo_caption . '</p></div>';
		$with_caption = 'with-caption';
	else:
		
	endif;		
		
	$return .= '<div class="video-figure ' . $with_caption . '"><iframe src="http://player.vimeo.com/video/'. $vimeo_id .'?player_id=vimeo_post_1&amp;title=0&amp;byline=0&amp;portrait=0&amp;color=' . $color . '" width="560"  height="349" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>' . $caption . '';

	return $return; 
	
		
}
add_shortcode('vimeo', 'vimeo_pulp_shortcode');


/* -------------- Custom Typography Shortcode -------------- */
function typography_shortcode($atts, $content=null) {
	
	$return = '';
	
	extract(shortcode_atts( array('font' => '', 'font_size' => '', 'font_color' => '', 'line_height' => '20'), $atts));
	
	wp_enqueue_style( 'custom-typo' . $font, get_template_directory_uri() . '/inc/shortcodes/custom-typo/' . $font . '.css', false, '1.0', 'all' );			
				
	$return .= '<span class="custom-typo" style="font-family: \''. $font .'\'; font-size: '. $font_size .'px; color: '. $font_color .'; line-height: ' . $line_height . 'px;">' . do_shortcode($content) . '</span>';
	return $return; 	
		
}

add_shortcode('typography', 'typography_shortcode');


/* -------------- Clear Floats Shortcode -------------- */
function clear_shortcode($atts, $content=null) {
	
	return '<div class="clear"></div>';
	
}
add_shortcode('clear', 'clear_shortcode');


/* -------------- Call Out Box Shortcode -------------- */
function call_out_shortcode($atts, $content=null) {

	extract(shortcode_atts( array('align' => 'left'), $atts));
	
	$return = '';
	
	$return .= '<div id="call-out" class="' . $align . '">' .
					'<p>' . do_shortcode($content) . '</p>' .
				'</div>';
	
	return $return;
	
}
add_shortcode('call_out', 'call_out_shortcode');




/* -------------- Price Boxes Shortcode -------------- */
function price_boxes_shortcode($atts, $content=null){
		$defaults = array();
		extract( shortcode_atts( $defaults, $atts ) );
		return '<div id="price-boxes">' . do_shortcode($content) . '</div>';
}

add_shortcode('price_boxes', 'price_boxes_shortcode');

if (!function_exists('price_box_shortcode')) {

	function price_box_shortcode( $atts, $content = null ) {
	
		$defaults = array( 	
						'column' => 'two_columns_alpha',
						'title' => __( 'Basic', 'morphis' ), 
						'price' => '$12', 
						'period' => __( 'month', 'morphis' ), 
						'periodic_detail' => __( 'Billed Annually', 'morphis' ),
						'plan_info' => __( 'Perfect match for starting up a small business.', 'morphis' ),						
						'plan_list_items' => __('Unlimited Users,Support, Web Design, Unlimited Bandwidth, 10GB Disk Usage', 'morphis' ),						
						'plan_url_link_name' => __( 'Sign Up', 'morphis' ),						
						'plan_url_link' => 'http://google.com',						
						'plan_featured' => ''
					);
				
		extract( shortcode_atts( $defaults, $atts ) );		
		$plan_list_items = $content;
		if($column == 'one_third_column'):
		$column_width = 'one-third column';
		elseif($column == 'one_third_column_alpha'):
			$column_width = 'one-third column alpha';
		elseif($column == 'one_third_column_omega'):
			$column_width = 'one-third column omega';
		else:
			$column_width = str_replace('_',' ', $column);
		endif;
		
		$priceCurrency = htmlspecialchars(substr($price, 0, 1));
		$priceNumber = substr($price, 1);
		$listItems = explode(",", $plan_list_items);
		$fullListItem = '';
		
		foreach($listItems as $item) {
			$fullListItem .= '<li>' . trim($item) . '</li>';
		}
		
		if($plan_featured == ''): 
			$featuredBtn = 'white';
		else:
			$featuredBtn = 'yellow';
		endif;
		
		$return = '';
		
		$return .=	'<div class="price-box ' . $column_width . '">' .
						'<div class="plan">' .
							'<div class="title">' .
								'<h5>' .$title . '</h5>' .
							'</div>' .
							'<div class="price">' .
								'<span class="number"><span class="currency">' .$priceCurrency . '</span>' . $priceNumber . '<span class="periodic">/' . $period . '</span></span>' .										
							'</div>' .
							'<div class="periodic-detail">' .
								'<p>' . $periodic_detail . '</p>' .						
							'</div>' .
						'</div>' .
						'<div class="plan-detail">' .
							'<p class="info">' . $plan_info . '</p>' .
								'<ul class="clearfix">' .$fullListItem . '</ul>' .								
								'<a href="' . $plan_url_link . '" class="button ' . $featuredBtn . ' full-width medium">' . $plan_url_link_name . '</a>' .
						'</div>' .
					'</div>';
		
		return $return;
		
	}
	
	add_shortcode( 'price_box', 'price_box_shortcode' );
	
}

/* -------------- Twitter Share Button Shortcode -------------- */
function twitter_share_shortcode($atts, $content=null) {
	
	global $NHP_Options;
	$twitter_username = $NHP_Options['twitter_username'];
	$page_url = curPageURL();

	return '<a href="https://twitter.com/share" class="twitter-share-button" data-url="' . $page_url . '" data-via="' . $twitter_username . '" data-lang="en" data-count="horizontal">Tweet</a>' .
	'<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';

}
add_shortcode('twitter_share', 'twitter_share_shortcode');

/* -------------- Facebook Like Button Shortcode -------------- */
function facebook_like_shortcode($atts, $content=null) {
	
	wp_enqueue_script( 'facebook-like', get_template_directory_uri() . '/inc/shortcodes/tinymce/js/facebook-like.js', false, '1.0', false );

	return '<div id="fb-root"></div>' .
		   '<div class="fb-like" data-layout="button_count" data-width="60" data-show-faces="false" data-font="lucida grande"></div>';		
	
}
add_shortcode('facebook_like', 'facebook_like_shortcode');

/* -------------- Pinterest Pin It Button Shortcode -------------- */
function pin_it_button_shortcode($atts, $content=null) {
	
	$defaults = array( 	
		'pin_url' => ''
	);
	
	extract( shortcode_atts( $defaults, $atts ) );
	
	if($pin_url == '') {
	
		$page_url = curPageURL();	
		global $post;
		$img_src = '';
		
		$args = array(
			'orderby' => 'menu_order',
			'post_type' => 'attachment',
			'post_parent' => $post->ID,
			'post_mime_type' => 'image',
			'post_status' => null,
			'numberposts' => -1
		);
		
		$attachments = get_posts($args);
		if( !empty($attachments) ) {
					
			foreach( $attachments as $attachment ) {                
				$src = wp_get_attachment_image_src( $attachment->ID, 'full' );			
				$img_src = $src[0];
		   
			}
		}
		
	} else {
		
		$img_src = $pin_url;
		
	}
	
	/* HORIZONTAL PINTEREST BUTTON WITH COUNTER */
	return '<div class="pinterest-posts"><a href="http://pinterest.com/pin/create/button/?url=' . $page_url . '&media=' . $img_src . '" class="pin-it-button" count-layout="horizontal">Pin It</a><script type="text/javascript" src="http://assets.pinterest.com/js/pinit.js"></script></div>';	
	
}
add_shortcode('pin_it_button', 'pin_it_button_shortcode');

/* -------------- Google +1 Button Shortcode -------------- */
function plus_one_shortcode($atts, $content=null) {
	
	wp_enqueue_script( 'plus_one', get_template_directory_uri() . '/inc/shortcodes/tinymce/js/plus-one.js', false, '1.0', false );

	return '<div class="g-plusone" data-size="medium"></div>';			
	
}
add_shortcode('plus_one', 'plus_one_shortcode');




/* -------------- Team Member Shortcode -------------- */
function team_members_shortcode($atts, $content=null){
		$defaults = array();
		extract( shortcode_atts( $defaults, $atts ) );
		return '<div id="team-members">' . do_shortcode($content) . '</div>';
}

add_shortcode('team_members', 'team_members_shortcode');

if (!function_exists('team_member_shortcode')) {

function team_member_shortcode($atts, $content=null) {
	
	$defaults = array( 	
						'column' => 'one_third_column_alpha',
						'img' => '', 
						'name' => 'Sheldon Cooper', 
						'job_desc' => 'Visual Designer', 
						'desc' => 'Porta rhoncus massa, pellentesque. Porta platea! Sociis lorem.',
						'specialties' => 'Web Design, PHP, jQuery',												
					);
				
	extract( shortcode_atts( $defaults, $atts ) );	
	
	if($column == 'one_third_column'):
		$column_width = 'one-third column';
	elseif($column == 'one_third_column_alpha'):
		$column_width = 'one-third column alpha';
	elseif($column == 'one_third_column_omega'):
		$column_width = 'one-third column omega';
	else:
		$column_width = str_replace('_',' ', $column);
	endif;
	
	
	
	$specialtiesArr = explode(",", $specialties);
	$specialtyList = '';
	
	foreach($specialtiesArr as $specialty) {
		$specialtyList .= '<li>' . trim($specialty) . '</li>';
	}
	
	$return = '<div id="team-member" class="' . $column_width . ' simple-hover">' .
				'<div class="frame">' .
					'<img src="' . $img . '" class="pic" width="80"/>' .
						'<div class="team-member-info">' .
							'<h5>' . $name . '</h5>' .
							'<h6>' . $job_desc . '</h6>' .
							'<p>' . $desc . '</p>' .
							'<ul class="list-check clearfix">' . $specialtyList .
							'</ul>' .
						'</div>' .
				'</div>	' .
			'</div>';
	return $return;			
	
}
add_shortcode('team_member', 'team_member_shortcode');

}




?>