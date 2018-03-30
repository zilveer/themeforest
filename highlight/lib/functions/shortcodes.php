<?php
/**
 * This file contains all the shortcodes and TinyMCE formatting buttons functionality.
 *
 * @author Pexeto
 */



/* ------------------------------------------------------------------------*
 * TABS
 * ------------------------------------------------------------------------*/

function show_tabs($atts, $content = null) {
	extract(shortcode_atts(array(
		"titles" => '',
	), $atts));
	$titlearr=explode(',',$titles);
	$html='<div class="tabs-container"><ul class="tabs ">';
	foreach($titlearr as $title){
		$html.='<li class="w3"><a href="#">'.$title.'</a></li>';
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
 * OTHER ELEMENTS
 * ------------------------------------------------------------------------*/

function show_services_boxes($atts, $content = null) {
	return pexeto_services_boxes();
}
add_shortcode('servicesboxes', 'show_services_boxes');


/* ------------------------------------------------------------------------*
 * ADD CUSTOM FORMATTING BUTTONS
 * ------------------------------------------------------------------------*/

global $pexeto_buttons;
$pexeto_buttons=array("pexetohighlight1", "pexetohighlight2", "pexetodropcaps", "|", "pexetolistcheck", "pexetoliststar",
"pexetolistarrow", "pexetolistarrow2", "pexetolistarrow4", "pexetolistplus", "|", "pexetolinebreak", 
"pexetoframe", "pexetolightbox", "|", "pexetobutton", "pexetoinfoboxes", "|", "pexetotwocolumns", "pexetothreecolumns", "pexetofourcolumns", "|", "pexetopricingtable");

function add_pexeto_buttons() {
	if ( get_user_option('rich_editing') == 'true') {
		add_filter('mce_external_plugins', 'add_pexeto_btn_tinymce_plugin');
		add_filter('mce_buttons_3', 'register_pexeto_buttons');
	}
}

add_action('init', 'add_pexeto_buttons');


/**
 * Register the buttons
 * @param $buttons
 */
function register_pexeto_buttons($buttons) {
	global $pexeto_buttons;

	array_push($buttons, implode(',',$pexeto_buttons));
	return $buttons;
}

/**
 * Add the buttons
 * @param $plugin_array
 */
function add_pexeto_btn_tinymce_plugin($plugin_array) {
	global $pexeto_buttons;
	foreach($pexeto_buttons as $btn){
		$plugin_array[$btn] = PEXETO_LIB_URL.'formatting-buttons/editor-plugin.js';
	}
	return $plugin_array;
}
