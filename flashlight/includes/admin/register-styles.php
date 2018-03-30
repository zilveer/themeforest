<?php
global $avia_config;


$primary = avia_get_option('primary');
$primary_font = avia_get_option('primary_font');
$secondary = avia_get_option('secondary');

//calculates a second color for hover effects based on the primary color choosen in the backend
$modify = 2;
if(avia_get_option('stylesheet') == 'dark-skin.css') $modify = 5;
$primary_addapted 	= avia_backend_calculate_similar_color($primary, 'lighter', $modify);
$secondary_addapted = avia_backend_calculate_similar_color($secondary, 'darker', $modify);

$avia_config['style'] = array(
		
		array(
		'elements'	=>'.button, #submit,  .dropcap2, input[name="Submit"]',
		'key'		=>'color',
		'value'		=> $primary_font
		),
		
		
		array(
		'elements'	=>'a, h4.teaser_text, #top .pagination a:hover, #top .tweets a, #top .main_menu .menu .current-menu-item a strong',
		'key'		=>'color',
		'value'		=> $primary
		),
		
		array(
		'elements'	=>'#top .button, #top #submit, .dropcap2, input[name="Submit"], a.remove:hover',
		'key'		=>'background-color',
		'value'		=> $primary
		),

		
		array(
		'elements'	=>'#top .button:hover, #top #submit:hover, input[name="Submit"]:hover, .quantity input.minus:hover, .quantity input.plus:hover',
		'key'		=>'background-color',
		'value'		=> $secondary
		),

		
		array(
		'elements'	=>'::-moz-selection',
		'key'		=>'background-color',
		'value'		=> $primary
		),
		
		array(
		'elements'	=>'::-webkit-selection',
		'key'		=>'background-color',
		'value'		=> $primary
		),
		
		array(
		'elements'	=>'::selection',
		'key'		=>'background-color',
		'value'		=> $primary
		),
		
		array(
		'elements'	=>'::-moz-selection',
		'key'		=>'color',
		'value'		=> $primary_font
		),
		
		array(
		'elements'	=>'::-webkit-selection',
		'key'		=>'color',
		'value'		=> $primary_font
		),
		
		array(
		'elements'	=>'::selection',
		'key'		=>'color',
		'value'		=> $primary_font
		),
		
		array(
		'elements'	=>'a:hover, .widget .news-link:hover, #top .main_menu .menu  a:hover strong',
		'key'		=>'color',
		'value'		=> $secondary
		),

		
		array(
		'key'	=>	'direct_input',
		'value'		=> avia_get_option('quick_css')
		),
		
		array(
		'elements'	=> '.cufon_headings',
		'key'	=>	'cufon',
		'value'		=> avia_get_option('font_heading')
		),
		
		
		
);	

if(avia_get_option('bg_color') != ""){

	$avia_config['style'][] = array(
		'elements'	=>'html, body',
		'key'		=>'background-color',
		'value'		=> avia_get_option('bg_color')
		);
		
}

	

		
	

if(avia_get_option('bg_image') != '' && avia_get_option('bg_image_repeat') != 'fullscreen')
{
	$avia_config['style'][] = array(
		'elements'	=>'html, body',
		'key'		=>'backgroundImage',
		'value'		=> avia_get_option('bg_image')
		);

		
	$avia_config['style'][] = array(
		'elements'	=>'html, body',
		'key'		=>'background-repeat',
		'value'		=> avia_get_option('bg_image_repeat')
		);

}





