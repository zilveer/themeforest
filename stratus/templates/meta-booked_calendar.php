<?php
//======================================================================
// Booked Calendar Template
//======================================================================

//-----------------------------------------------------
// GET BACKGROUND
//-----------------------------------------------------
$partName = 'background';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// GET BORDER
//-----------------------------------------------------
$partName = 'border';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// Preloader, Section, Container Open
//-----------------------------------------------------
$metadata = get_post_meta($post->ID);

// Float
$section_template_class = 'booked-calendar-mb';
if(isset($metadata[$key."_calendar_align"][0]) && $metadata[$key."_calendar_align"][0] == "left" || $metadata[$key."_calendar_align"][0] == "right"){
	$section_template_class .= ' cal-'.$metadata[$key."_calendar_align"][0];
}else{
	$section_template_class .= ' cal-'.$metadata[$key."_calendar_align"][0];
}

if(isset($metadata[$key."_calendar_align"][0]) && $metadata[$key."_calendar_align"][0] == "left" || $metadata[$key."_calendar_align"][0] == "right"){
	$class_one = 'float-content col-sm-7';
	$class_two = 'float-cal col-sm-5';
	$class_three = 'booked-cal-sm';
}else{
	$class_one = 'float-content col-sm-12';
	$class_two = 'float-cal col-sm-12';
	$class_three = 'booked-cal-full';
}

$show_tooltip = false;
// Tool Tip
if(isset($metadata[$key."_show_tooltip"][0]) && $metadata[$key."_show_tooltip"][0] == 1){
	if(isset($metadata[$key."_tooltip_text"][0]) && $metadata[$key."_tooltip_text"][0] > ''){
		$show_tooltip = true;
		$tooltip = $metadata[$key."_tooltip_text"][0];
	}
}

// Content Heading
if(isset($metadata[$key."_text_header"][0]) && $metadata[$key."_text_header"][0] > ''){
	$heading = true;
	$heading_text = $metadata[$key."_text_header"][0];
}

// Content
if(isset($metadata[$key."_text"][0]) && $metadata[$key."_text"][0] > ''){
	$content = true;
	$content_text = $metadata[$key."_text"][0];
}


$partName = 'preload-container';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// Meta Box Header / Subtext
//-----------------------------------------------------
$partName = 'header';
include( locate_template('templates/meta-part-' . $partName . '.php') );

/*****************************
BOOKED PLUGIN
*****************************/

if ($show == 1) {
	echo '<div class="row">';
		echo '<div class="'.$class_one.'">';
		if(isset($heading) && $heading){
			echo '<h2 class="booked-cal-title">'.sanitize_text_field($heading_text).'</h2>';
		}
		if(isset($content) && $content){
			echo '<div class="booked-cal-content">';

				echo themo_content($content_text);
			echo '</div>';
		}
		echo '</div>';
		echo '<div class="'.$class_two.'">';
			echo '<div class="'.$class_three.'">';
				if($show_tooltip){
				echo '<div class="cal-tooltip">';
					echo '<h3>'.sanitize_text_field($tooltip).'</h3>';
				echo '</div>';
				}
				echo do_shortcode(sanitize_text_field($metadata[$key."_shortcode"][0]));
			echo '</div>';
		echo '</div>';
	echo '</div>';
 }

//-----------------------------------------------------
// Preloader, Section, Container Close
//-----------------------------------------------------
$partName = 'preload-container-close';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// GET BORDER CLOSE
//-----------------------------------------------------
$partName = 'border-close';
include( locate_template('templates/meta-part-' . $partName . '.php') );