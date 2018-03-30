<?php

// Enable shortdoces in sidebar default Text widget
add_filter('widget_text', 'do_shortcode');

/*-----------------------------------------------------------------------------------*/
/*	Button Shortcode
/*-----------------------------------------------------------------------------------*/

function st_button( $atts, $content = null ) {
	
	extract(shortcode_atts(array(
		'url'     	 => '#',
		'target'     => '_self',
		'color'   => '',
		'size'	=> ''
    ), $atts));
	
   return '<a class="st-btn '.$size.' st-btn-'.$color.' st-btn-'.$size.'" href="'.$url.'">' . do_shortcode($content) . '</a>';
}

add_shortcode('button', 'st_button');

/*-----------------------------------------------------------------------------------*/
/*	Lightbox Shortcode
/*-----------------------------------------------------------------------------------*/

function st_lightbox( $atts, $content = null ) {
	
	extract(shortcode_atts(array(
		'url'     	 => '#',
		'title'     => '',
		'rel'   => '',
		'type' => '',
    ), $atts));
	if ($type == 'media' ) 
		{$lightbox_type = 'fancybox-media';} 
	elseif ($type == 'iframe')
		{$lightbox_type = 'various';
		$data_type = 'data-fancybox-type="iframe"';}
	elseif ($type == 'content')
		{$lightbox_type = 'various';}
	else {$lightbox_type = 'fancybox';}
   return '<a class="'.$lightbox_type.'" '.$data_type.' href="'.$url.'">' . do_shortcode($content) . '</a>';
}

add_shortcode('lightbox', 'st_lightbox');

/*-----------------------------------------------------------------------------------*/
/*	Lightbox Popup Shortcode
/*-----------------------------------------------------------------------------------*/

function st_lightbox_popup( $atts, $content = null ) {
	
	extract(shortcode_atts(array(
		'id'   => ''
    ), $atts));

   return '<div id="'.$id.'" style="display:none;">' . do_shortcode($content) . '</div>';
}

add_shortcode('lightbox_popup', 'st_lightbox_popup');

/*-----------------------------------------------------------------------------------*/
/*	Pricing Table
/*-----------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/*	Alerts
/*-----------------------------------------------------------------------------------*/

function st_alert( $atts, $content = null ) {
$title_print = '';
$title_class = '';
	extract(shortcode_atts(array(
		'style'   => '',
		'title' => ''
    ), $atts));
	if ($title != '' ) {
		$title_print = '<span>'.$title.'</span>';
		$title_class = 'with_title';
	} 

   return '<div class="st-alert st-alert-'.$style.' '.$title_class.'">'.$title_print . do_shortcode($content) . '</div>';
}

add_shortcode('alert', 'st_alert');

/*-----------------------------------------------------------------------------------*/
/*	Tabs
/*-----------------------------------------------------------------------------------*/

function st_tabs( $atts, $content = null ) {
	global $shortcode_tabs;
	extract(shortcode_atts(array(
		'style' => ''
    ), $atts));

	do_shortcode($content);

	$tab_items = '';
	$tab_content = '';
	$id = base_convert(microtime(), 10, 36);
	

	if (is_array($shortcode_tabs)) {

		for ($i = 0; $i < count($shortcode_tabs); $i++) {
			$tab_items .= '<li class="' . ( ( $i == 0 ) ? 'active' : '' ) . '"><a href="#'.$id.'_'.$i.'" data-toggle="tab">'.$shortcode_tabs[$i]['title'].'</a></li>'; 
			$tab_content .= '<div class="tab-pane ' . ( ( $i == 0 ) ? 'active' : '' ) . '" id="'.$id.'_'.$i.'">'.do_shortcode($shortcode_tabs[$i]['content']).'</div>'; 
		}

		$finished_tabs = '<div id="tab-'.$id.'" class="tabbable '.$style.'"><ul class="nav nav-tabs">'.$tab_items.'</ul><div class="tab-content">'.$tab_content.'</div></div><script type="text/javascript">jQuery(document).ready(function($) {$("#tab-'.$id.'").tab("show")});</script>'; 
	}
	$shortcode_tabs = '';
	
	return $finished_tabs;
	
}
add_shortcode('tabs', 'st_tabs');


// Single Tab
function st_shortcode_tab( $atts, $content = null ) {
	global $shortcode_tabs;
	extract(shortcode_atts(array(
		'title' => ''
    ), $atts));

	$tab_elements['title'] = $title;
	$tab_elements['content'] = do_shortcode($content);
	
	$shortcode_tabs[] = $tab_elements;

	
}
add_shortcode('tab', 'st_shortcode_tab');


/*-----------------------------------------------------------------------------------*/
/*	Toggle
/*-----------------------------------------------------------------------------------*/
function st_toggle( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'title' => '',
		'start' => 'closed'
    ), $atts));
	$id = base_convert(microtime(), 10, 36);

	$item = '<div class="st-toggle"><div class="st-toggle-action"><span class="plus">+</span><span class="minus">-</span><a href="#'.sanitize_title($title).'">'.$title.'</a></div><div class="st-toggle-content">'.do_shortcode($content).'</div></div>';
	
	return $item;
	
}
add_shortcode('toggle', 'st_toggle');

/*-----------------------------------------------------------------------------------*/
/*	Accordion
/*-----------------------------------------------------------------------------------*/
function st_accordion( $atts, $content = null ) {
	$item = '<div class="st-accordion-wrap">'.do_shortcode($content).'</div>';
	return $item;	
}
add_shortcode('accordion', 'st_accordion');

function st_accordion_block( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'title' => ''
    ), $atts));
	$item = '<div class="st-accordion-title"><span class="plus">+</span><span class="minus">-</span><a href="#'.sanitize_title($title).'">'.$title.'</a></div><div class="st-accordion-content">'.do_shortcode($content).'</div>';
	
	return $item;
	
}
add_shortcode('accordion_block', 'st_accordion_block');

/*-----------------------------------------------------------------------------------*/
/*	Columns
/*-----------------------------------------------------------------------------------*/
function st_column_row( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'type' => '',
		'gutters' => ''
    ), $atts));
	if ($type == 'fixed') {
	return '<div class="row-fixed">'. do_shortcode($content) .'</div>';
	} elseif ($type == 'adaptive') {
	return '<div class="row-adaptive">'. do_shortcode($content) .'</div>';	
	} else {
	return '<div class="row">'. do_shortcode($content) .'</div>';	
	}
}
add_shortcode('row', 'st_column_row');

function st_col_half( $atts, $content = null ) {
	return '<div class="column col-half">'. do_shortcode($content) .'</div>';
}
add_shortcode('col_half', 'st_col_half');

function st_col_third( $atts, $content = null ) {
	return '<div class="column col-third">'. do_shortcode($content) .'</div>';
}
add_shortcode('col_third', 'st_col_third');

function st_col_fourth( $atts, $content = null ) {
	return '<div class="column col-fourth">'. do_shortcode($content) .'</div>';
}
add_shortcode('col_fourth', 'st_col_fourth');

function st_col_fifth( $atts, $content = null ) {
	return '<div class="column col-fifth">'. do_shortcode($content) .'</div>';
}
add_shortcode('col_fifth', 'st_col_fifth');

function st_col_five( $atts, $content = null ) {
	return '<div class="column col-sixth">'. do_shortcode($content) .'</div>';
}
add_shortcode('col_sixth', 'st_col_five');





/*-----------------------------------------------------------------------------------*/
/*	Misc
/*-----------------------------------------------------------------------------------*/
function st_fix_shortcodes($content){   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );

    $content = strtr($content, $array);
    return $content;
}
add_filter('the_content', 'st_fix_shortcodes');
