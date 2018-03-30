<?php
//======================================================================
// Service Block Split - Template
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
$partName = 'preload-container';
$section_template_class = 'service-split';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// Meta Box Header / Subtext
//-----------------------------------------------------
$partName = 'header';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// Column Sizing
//-----------------------------------------------------
$html_show = get_post_meta($post->ID, $key.'_show_content', true );

if ($html_show == 1 && $show = 1){ // switch between 50% / 50% or 100% width.
	$bootstrap_tier = 'col-sm-6';	
}else{
	$bootstrap_tier = 'col-sx-12';
}

//-----------------------------------------------------
// Reverse Float Alignment
//-----------------------------------------------------
$contact_reverse = get_post_meta($post->ID, $key.'_reverse', true ); // Reverse Floats
$bootstrap_tier_pull = "";
$bootstrap_tier_push = "";

if ($contact_reverse == 1){
	$bootstrap_tier_pull = ' col-sm-pull-6';
	$bootstrap_tier_push = ' col-sm-push-6';
}


echo '<div class="row">';

	//-----------------------------------------------------
	// Side bar settings
	//-----------------------------------------------------

	$page_layout = get_post_meta($post->ID, 'themo_page_layout', true );

	if($page_layout == 'right' || $page_layout == 'left'){
		$bootstrap_tier = 'col-sm-12';
		$bootstrap_tier_pull = "";
		$bootstrap_tier_push = "";
		if ($contact_reverse == 1){
			themo_print_service_block_HTML($html_show,$post->ID,$key,$bootstrap_tier,$bootstrap_tier_pull);
			themo_print_service_block($show,$post->ID,$key,$bootstrap_tier,$bootstrap_tier_push);
		}else{
			themo_print_service_block($show,$post->ID,$key,$bootstrap_tier,$bootstrap_tier_push);
			themo_print_service_block_HTML($html_show,$post->ID,$key,$bootstrap_tier,$bootstrap_tier_pull);
		}
	}else{

		themo_print_service_block($show,$post->ID,$key,$bootstrap_tier,$bootstrap_tier_push);
		themo_print_service_block_HTML($html_show,$post->ID,$key,$bootstrap_tier,$bootstrap_tier_pull);
	}


echo '</div><!-- /.row -->';


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