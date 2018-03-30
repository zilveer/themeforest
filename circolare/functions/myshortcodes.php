<?php

/*     SHORTCODES      */

// CLEAR SHORTCODE
function clear_code() {
return '<div class="clear"></div>';
}
add_shortcode('clear', 'clear_code');

// RAW SHORTCODE FOR DISABLING AUTO FORMATTING IN POSTS
function raw_formatter($content) {
	$new_content = '';
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);
	foreach ($pieces as $piece) {
		if (preg_match($pattern_contents, $piece, $matches)) {
			$new_content .= $matches[1];
		} else {
			$new_content .= wptexturize(wpautop($piece));
		}
	}
	return $new_content;
}
// Remove the 2 main auto-formatters
remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');
// Before displaying for viewing, apply this function
add_filter('the_content', 'raw_formatter', 99);
add_filter('widget_text', 'raw_formatter', 99);


function rawr_code( $atts, $content = null ) {
	
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);
	return do_shortcode($content);
	
}
add_shortcode('rawr', 'rawr_code');


//		FLOAT SHORTCODES
function alignleft_code( $atts, $content = null ) {
	return '<div class="float-left">' . "\n" . do_shortcode($content) . "\n" . '</div>';
}
add_shortcode('alignleft', 'alignleft_code');

function alignright_code( $atts, $content = null ) {
	return '<div class="float-right">' . "\n" . do_shortcode($content) . "\n" . '</div>';
}
add_shortcode('alignright', 'alignright_code');


//		HALF COLUMN
function col2_code( $atts, $content = null ) {
	return '<div class="one-half float-left">' . "\n" . do_shortcode($content) . "\n" . '</div>';
}
add_shortcode('col2', 'col2_code');

//		ONE THIRD COLUMN
function col3_code( $atts, $content = null ) {
	return '<div class="one-third float-left">' . "\n" . do_shortcode($content) . "\n" . '</div>';
}
add_shortcode('col3', 'col3_code');

//		ONE FOURTH COLUMN
function col4_code( $atts, $content = null ) {
	return '<div class="one-fourth float-left">' . "\n" . do_shortcode($content) . "\n" . '</div>';
}
add_shortcode('col4', 'col4_code');

//		TWO THIRD COLUMN
function col23_code( $atts, $content = null ) {
	return '<div class="two-third float-left ">' . "\n" . do_shortcode($content) . "\n" . '</div>';
}
add_shortcode('col23', 'col23_code');

//		THREE FOURTH COLUMN
function col34_code( $atts, $content = null ) {
	return '<div class="three-fourth float-left">' . "\n" . do_shortcode($content) . "\n" . '</div>';
}
add_shortcode('col34', 'col34_code');

//		LAST HALF COLUMN
function col2_last_code( $atts, $content = null ) {
	return '<div class="one-half float-left last">' . "\n" . do_shortcode($content) . "\n" . '</div>';
}
add_shortcode('col2_last', 'col2_last_code');

//		LAST ONE THIRD COLUMN
function col3_last_code( $atts, $content = null ) {
	return '<div class="one-third float-left last">' . "\n" . do_shortcode($content) . "\n" . '</div>';
}
add_shortcode('col3_last', 'col3_last_code');

//		LAST ONE FOURTH COLUMN
function col4_last_code( $atts, $content = null ) {
	return '<div class="one-fourth float-left last">' . "\n" . do_shortcode($content) . "\n" . '</div>';
}
add_shortcode('col4_last', 'col4_last_code');

//		LAST TWO THIRD COLUMN
function col23_last_code( $atts, $content = null ) {
	return '<div class="two-third float-left last">' . "\n" . do_shortcode($content) . "\n" . '</div>';
}
add_shortcode('col23_last', 'col23_last_code');

//		LAST THREE FOURTH COLUMN
function col34_last_code( $atts, $content = null ) {
	return '<div class="three-fourth float-left last">' . "\n" . do_shortcode($content) . "\n" . '</div>';
}
add_shortcode('col34_last', 'col34_last_code');


//		TABS MAIN SHORTCODE
function tabs_main($atts, $content = null) {

	$output = '<div class="tabs-product"><ul class="tabs">';
	
	foreach ($atts as $key => $tab) {
		$output .= '<li><a href="#' . $key . '">' .$tab. '</a></li>';
	}	
	$output .= '</ul><div class="clear"></div>' . do_shortcode($content) . '</div>';
	return $output;
}
add_shortcode('tabgroup', 'tabs_main');


//		TAB ELEMENT
function tab_elements($atts, $content = null) {
	extract(shortcode_atts(array(
		"id" => ""
	), $atts));
	return '<div id="' . $id . '">' . do_shortcode($content) . '</div>';
}
add_shortcode('tab', 'tab_elements');


//		ACCORDION
function accordion_main($atts, $content = null) {
	return '<div id="accordion" class="custom-accordion">' . do_shortcode($content) . '</div>';
}
add_shortcode('accordion_group', 'accordion_main');


//		ACCORDION ELEMENT
function accordion_elements($atts, $content = null) {
	extract(shortcode_atts(array(
		"title" => "Title"
	), $atts));
	$output = '<h3>' . $title . '</h3><div>' . do_shortcode($content) . '</div>';
	return $output;
}
add_shortcode('accordion', 'accordion_elements');

//		ICONS SHORTCODE
function icon_code($atts, $content = null) {
	extract(shortcode_atts(array( "type" => 'support' ), $atts));	
	
	return '<span class="icon-' . $type . ' heading-style">'  . do_shortcode($content) . '</span>';	
}
add_shortcode('icon', 'icon_code');


//		CLIENTS SHORTCODE
function client_code($atts, $content = null) {
	extract(shortcode_atts(array( "image" => '', "linkto" => '#' ), $atts));	
	
	return '<div class="float-left clients"><a href="' . $linkto . '"><img src="' . $image . '" alt="" /></a></div>';	
}
add_shortcode('client', 'client_code');


//		FANCY QUOTES
function quote_code($atts, $content = null) {
	$avatar_image = THEME_DIR . "/images/staff.jpg";

	extract(shortcode_atts(array( "type" => '', "avatar" => $avatar_image ), $atts));	
	
	if($type == "idea") {
		return '<div class="quote2">
			<div class="text heading-style">' . do_shortcode($content) . '</div>
		</div>';
	} elseif($type == "award") {
		return '<div class="quote3">
			<div class="text heading-style">' . do_shortcode($content) . '</div>
		</div>';
	} else {
		if($avatar == "") $avatar = $avatar_image;
		return '<div class="quote">
			<div class="image">
				<img src="' . $avatar . '" style="border-radius: 40px;" width="80px" height="80px" alt="" />
			</div>
			<div class="text">' . do_shortcode($content) . '</div>
		</div>';
	}
}
add_shortcode('quote', 'quote_code');


//		FANCY BORDER
function fancyborder_main($atts, $content = null) {
	return '<div class="general-block-outer"><div class="general-block">' . do_shortcode($content) . '</div></div>';
}
add_shortcode('fancyborder', 'fancyborder_main');


//		DIVIDER SHORTCODE
function divider_code($atts, $content = null) {
	extract(shortcode_atts(array( "type" => 'line', "title" => 'Your Heading', "linkto" => '#' ), $atts));
	
	switch($type) {
		case "separator-bottom": return '<div class="block-separator-bottom"></div>'; break;
		case "separator-top": return '<div class="block-separator-top"></div>'; break;
		case "heading-large": return '<div class="sep-line-block medium-margin">
					<div class="sep-line-points-container">
						<div class="sep-line-points"></div>
					</div>
					<div class="sep-line-center-decoration-text heading-style">' . $title . '</div>
					<div class="sep-line-points-container">
						<div class="sep-line-points"></div>
					</div>
				</div>'; break;
		case "heading-small": return '<div class="sep-line-block medium-margin">
					<div class="sep-line-points-container">
						<div class="sep-line-points"></div>
					</div>
					<div class="sep-line-center-text">
						<h3>' . $title . '</h3>
					</div>
					<div class="sep-line-points-container">
						<div class="sep-line-points"></div>
					</div>
				</div>'; break;
		case "link" : return '<div class="sep-line-block">
				<div class="sep-line-points-container">
					<div class="sep-line-points"></div>
				</div>
				<div class="sep-line-center-text">
					<a href="' . $linkto . '" class="button red-submit-button">' . $title . '</a>
				</div>
				<div class="sep-line-points-container">
					<div class="sep-line-points"></div>
				</div>
			</div>'; break;
		default: return '<div class="line-separator"></div>';
	}
}
add_shortcode('divider', 'divider_code');


//     SHORTCODES FOR BUTTONS
function btn_code($atts, $content = null) {
	extract(shortcode_atts(array( "linkto" => '', "type" => 'dark' ), $atts));
	
	if($type == "light")
	return '<a href="' . $linkto . '" class="button light-button">' . do_shortcode($content) . '</a>';
	elseif($type == "colored")
	return '<a href="' . $linkto . '" class="button red-submit-button">' . do_shortcode($content) . '</a>';
	else
	return '<a href="' . $linkto . '" class="button">' . do_shortcode($content) . '</a>';
}
add_shortcode('button', 'btn_code');


//		SUCESS SHORTCODE
function success_code( $atts, $content = null ) {
	return '<div class="alert-success">' . "\n" . do_shortcode($content) . "\n" . '</div>';
}
add_shortcode('success', 'success_code');

//		ERROR SHORTCODE
function error_code( $atts, $content = null ) {
	return '<div class="alert-error">' . "\n" . do_shortcode($content) . "\n" . '</div>';
}
add_shortcode('error', 'error_code');

//		INFO SHORTCODE
function info_code( $atts, $content = null ) {
	return '<div class="alert-info">' . "\n" . do_shortcode($content) . "\n" . '</div>';
}
add_shortcode('info', 'info_code');

//		WARNING SHORTCODE
function warning_code( $atts, $content = null ) {
	return '<div class="alert-warning">' . "\n" . do_shortcode($content) . "\n" . '</div>';
}
add_shortcode('warning', 'warning_code');


//		FAQ SHORTCODE
function faq_code( $atts, $content = null ) {
	return '<ul class="faq-item">' . "\n" . do_shortcode($content) . "\n" . '</ul>';
}
add_shortcode('faq', 'faq_code');

//		FAQITEM SHORTCODE
function faqitem_code($atts, $content = null) {
	extract(shortcode_atts(array( "question" => 'Add a question here.' ), $atts));
		
	$output = '<li><dl>';
	$output .= '<dd><span class="question-symbol">Q:</span><p class="question">' . $question . '</p></dd>';
	$output .= '<dd><span class="answer-symbol">A:</span><p>' . do_shortcode($content) . '</p></dd>';
	$output .= '<dd><a href="#top" class="regular" title="Back to top">Back to top</a></dd>';
	$output .= '</dl></li>';
	return $output;
}
add_shortcode('faqitem', 'faqitem_code');



//		TEXT HIGHLIGHT SHORTCODE
function highlight_code($atts, $content = null) {
	extract(shortcode_atts(array( "type" => 'primary' ), $atts));
	
	if($type =='secondary')
		return '<span class="highlight2">'  . do_shortcode($content) . '</span>';
	else
		return '<span class="highlight">'  . do_shortcode($content) . '</span>';
}
add_shortcode('highlight', 'highlight_code');


//		CONTACT SHORTCODE
function contactform_code($atts, $content = null) {
		extract(shortcode_atts(array(
				"sendto" => ''
		), $atts));
		
		return add_contact_form($sendto);
}
add_shortcode('contactform', 'contactform_code');
?>