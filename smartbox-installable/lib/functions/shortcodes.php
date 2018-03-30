<?php
/**
 * This file contains all the shortcodes and TinyMCE formatting buttons functionality.
 *
 */

/* ------------------------------------------------------------------------*
 * SPECIAL TABS
 * ------------------------------------------------------------------------*/

function show_special_tabs($atts, $content = null) {
	extract(shortcode_atts(array(
		"titles" => '',
		"width" => 'medium'
	), $atts));
	$titlearr=explode(',',$titles);
	$html='<div class="tabs-container"><ul class="tabs ">';
	if($width=='small'){
		$wclass='w1';
	}elseif($width=='big'){
		$wclass='w3';
	}else{
		$wclass='w2';
	}
	foreach($titlearr as $title){
		$html.='<li class="'.$wclass.'"><a href="#">'.$title.'</a></li>';
	}
	$html.='</ul><div class="panes">'.do_shortcode($content).'</div></div>';
	return $html;
}
add_shortcode('special_tabs', 'show_special_tabs');

/* ------------------------------------------------------------------------*
 * TABS
 * ------------------------------------------------------------------------*/

function show_tabs($atts, $content = null) {
	extract(shortcode_atts(array(
		"titles" => '',
		"width" => 'medium'
	), $atts));
	$titlearr=explode(',',$titles);
	$html='<div class="tabs-container"><ul class="tabs ">';
	if($width=='small'){
		$wclass='w1';
	}elseif($width=='big'){
		$wclass='w3';
	}else{
		$wclass='w2';
	}
	foreach($titlearr as $title){
		$html.='<li class="'.$wclass.'"><a href="#">'.$title.'</a></li>';
	}
	$html.='</ul><div class="panes">'.do_shortcode($content).'</div></div>';
	return $html;
}
add_shortcode('tabs', 'show_tabs');


function show_pane($atts, $content = null) {
	return '<div>'.do_shortcode($content).'</div>';
}
add_shortcode('pane', 'show_pane');


function show_accordion($atts, $content = null) {
	return '<div class="accordion-container"><div id="accordion">'.do_shortcode($content).'</div></div>';
}
add_shortcode('accordion', 'show_accordion');


function show_apane($atts, $content = null) {
	extract(shortcode_atts(array(
		"title" => ''
		), $atts));
		return '<h2>'.$title.'</h2><div class="pane">'.do_shortcode($content).'</div>';
}
add_shortcode('apane', 'show_apane');


function show_testimonials($atts, $content = null) {
	return '<div class="testimonial-container"><div id="testimonials">'.do_shortcode($content).'</div></div>';
}
add_shortcode('testimonials', 'show_testimonials');


function show_testim($atts, $content = null) {
	extract(shortcode_atts(array(
		"author" => '',
		"img" =>''
		), $atts));
		return '<img src="'.$img.'" alt="" class="img-frame" /><div class="testim-pane"><h3>'.$author.'</h3><p>'.do_shortcode($content).'</p></div>';
}
add_shortcode('testim', 'show_testim');

/* ------------------------------------------------------------------------*
 * SERVICES BOXES
 * ------------------------------------------------------------------------*/

function designare_services_boxes(){
	$html='<div class="columns-wrapper nomargin">';
	for($i=1; $i<=3; $i++){
		$lastClass=$i==3?'nomargin':'';
		$html.='<div class="services-box three-columns '.$lastClass.'">';
		$html.='<h2>'.get_opt('_home_box_title'.$i).'</h2> <div class="double-line"></div>';
		if(get_opt('_home_box_icon'.$i)!=''){
			$html.='<img src="'.get_opt('_home_box_icon'.$i).'" />';
		}
		$html.='<p>'.get_opt('_home_box_desc'.$i).'</p>';
		if(trim(get_opt('_home_box_btn_link'.$i))){
			$html.='<a href="'.get_opt('_home_box_btn_link'.$i).'" >'.get_opt('_home_box_btn_text'.$i).'<span class="more-arrow">&raquo;</span></a>';
		}
		$html.='</div>';
	}

	$html.='</div>';
	return $html;
}


add_shortcode('servicesboxes', 'designare_services_boxes');


/* ------------------------------------------------------------------------*
 * SERVICES BALLS
 * ------------------------------------------------------------------------*/


function designare_services_balls(){
	$html='<div class="services_balls">';
	$html.= "tretas imensas";
	$html.='</div>';
	return $html;
}


add_shortcode('serviceballs', 'designare_services_balls');


/* ------------------------------------------------------------------------*
 * CONTACT FORM
 * ------------------------------------------------------------------------*/

function designare_contact_form(){
	if (!function_exists('icl_object_id'))
		$html='<div class="widget-contact-form">
	<form action="'.get_template_directory_uri().'/includes/send-email.php" method="post" id="submit-form" class="designare-contact-form">
	  <input type="text" name="name" class="required clear-on-click" id="name_text_box" value="'.des_text('_name_text').'" />
	  <input type="text" name="email" class="required clear-on-click email" id="email_text_box" value="'.des_text('_your_email_text').'" />
	  <textarea name="question" rows="" cols="" class="required"
	    id="question_text_area"></textarea>
	  
	  <a class="button send-button"><span>'.des_text('_send_text').'</span></a>
	  <div class="contact-loader"></div><div class="check"></div>
	   
	</form><div class="clear"></div></div>';
	else 
		$html='<div class="widget-contact-form">
	<form action="'.get_template_directory_uri().'/includes/send-email.php" method="post" id="submit-form" class="designare-contact-form">
	  <input type="text" name="name" class="required clear-on-click" id="name_text_box" value="'.__("Name","smartbox").'" />
	  <input type="text" name="email" class="required clear-on-click email" id="email_text_box" value="'.__("Email","smartbox").'" />
	  <textarea name="question" rows="" cols="" class="required"
	    id="question_text_area"></textarea>
	  
	  <a class="button send-button"><span>'.__("Send","smartbox").'</span></a>
	  <div class="contact-loader"></div><div class="check"></div>
	   
	</form><div class="clear"></div></div>';
	return $html;
}


add_shortcode('contactform', 'designare_contact_form');


/* ------------------------------------------------------------------------*
 * ADD CUSTOM FORMATTING BUTTONS
 * ------------------------------------------------------------------------*/

global $designare_buttons;
$designare_styling_buttons=array("designaretitle", "designaretitlesmall", "designarehighlight1", "designarehighlight2", "designaredropcaps", "|", "designarelistcheck", "designareliststar",
"designarelistarrow", "designarelistarrow2", "designarelistarrow4", "designarelistplus", "|", "designarelinebreak", 
"designareframe", "designarelightbox", "|", "designarebutton", "designareinfoboxes", "|", "designaretwocolumns", "designarethreecolumns", "designarefourcolumns", "|", "designarepricingtable");
$designare_content_buttons=array("designareservicesballs", "designareyoutube", "designarevimeo", "designareflash");

function add_designare_buttons() {
	if ( get_user_option('rich_editing') == 'true') {
		add_filter('mce_external_plugins', 'designare_add_btn_tinymce_plugin');
		add_filter('mce_buttons_3', 'designare_register_styling_buttons');
		add_filter('mce_buttons_4', 'designare_register_content_buttons');
	}
}

add_action('init', 'add_designare_buttons');


/**
 * Register the buttons
 * @param $buttons
 */
function designare_register_styling_buttons($buttons) {
	global $designare_styling_buttons;

	array_push($buttons, implode(',',$designare_styling_buttons));
	return $buttons;
}

/**
 * Add the buttons
 * @param $plugin_array
 */
function designare_add_btn_tinymce_plugin($plugin_array) {
	global $designare_styling_buttons, $designare_content_buttons;
	$merged_buttons=array_merge($designare_styling_buttons, $designare_content_buttons);
	foreach($merged_buttons as $btn){
		$plugin_array[$btn] = DESIGNARE_LIB_URL.'formatting-buttons/editor-plugin.js';
	}
	return $plugin_array;
}

/**
 * Register the buttons
 * @param $buttons
 */
function designare_register_content_buttons($buttons) {
	global $designare_content_buttons;

	array_push($buttons, implode(',',$designare_content_buttons));
	return $buttons;
}


