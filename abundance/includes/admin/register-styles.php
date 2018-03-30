<?php
global $avia_config;


$primary = avia_get_option('primary');
$primary_font = avia_get_option('header_font');
$secondary = avia_get_option('secondary');
$header = avia_get_option('header_bg');
$header_dark = avia_backend_calculate_similar_color($header, 'darker', 1);

//calculates a second color for hover effects based on the primary color choosen in the backend
$modify = 2;
if(avia_get_option('stylesheet') == 'dark-skin.css') $modify = 5;
$primary_addapted 	= avia_backend_calculate_similar_color($primary, 'lighter', $modify);
$secondary_addapted = avia_backend_calculate_similar_color($secondary, 'darker', $modify);

$avia_config['style'] = array(

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
		'elements'	=>'.button, #submit, .dropcap2, #header, #footer, #socket, div #footer h1, div #footer h2, div #footer h3, div #footer h4, div #footer h5, div #footer h6 ,div #footer h1 a,div  #footer h2 a, div #footer h3 a, div #footer h4 a, div #footer h5 a, div #footer h6 a, #top .sub_menu a, a.button , .button a:hover, .button:hover, div .widget_layered_nav ul li.chosen a, .widget_layered_nav ul .chosen small.count, #main table th, div .quantity input.minus:hover, div .quantity input.plus:hover',
		'key'		=>'color',
		'value'		=> $primary_font
		),
		
		
		array(
		'elements'	=>'#header, #footer, .dropcap2, div .callout .big_button, #top .main_menu .avia_mega ul ul li, #top .main_menu .avia_mega >li >ul li, .thumbnail_container:hover, div .widget_layered_nav ul li.chosen, #main table th, div .quantity input.minus:hover, div .quantity input.plus:hover, a.remove:hover',
		'key'		=>'background-color',
		'value'		=> $header
		),
		
		array(
		'elements'	=>'#socket, div .callout .big_button:hover',
		'key'		=>'background-color',
		'value'		=> $header_dark
		),
		
		array(
		'elements'	=>'div .callout .big_button',
		'key'		=>'border-color',
		'value'		=> $header
		),
	
		
		array(
		'elements'	=>'a, h4.teaser_text, .entry-content h1, .entry-content h2, #top .pagination a:hover, #top .tweets a',
		'key'		=>'color',
		'value'		=> $primary
		),
		
		array(
		'elements'	=>'#top #footer, #top #footer span, #top #footer div, #top #footer p, #top #footer a, #top #socket a',
		'key'		=>'color',
		'value'		=> $primary_font
		),
		
		array(
		'elements'	=>'#top #footer, #top #footer span, #top #footer div, #top #footer p, #top #footer a',
		'key'		=>'background-color',
		'value'		=> $header
		),
		
		array(
		'elements'	=>'#top #footer a, #top #socket a, #footer .widget_archive ul, #footer .widget_categories ul, #footer .widget_pages ul, #footer .widget_links ul, #footer .widget_meta ul, #footer .widget_nav_menu ul, #top .sub_menu li',
		'key'		=>'border-color',
		'value'		=> avia_backend_calculate_similar_color($header, 'lighter', 2)
		),
		
		
		
		
		array(
		'elements'	=>'#top .button, #top #submit',
		'key'		=>'background-color',
		'value'		=> $primary
		),

		
		array(
		'elements'	=>'#top .button:hover, #top #submit:hover',
		'key'		=>'background-color',
		'value'		=> $secondary
		),
		
		array(
		'elements'	=>'a:hover, .widget .news-link:hover, #top .main_menu .menu .current-menu-item a strong',
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


	$avia_config['style'][] = array(
		'elements'	=>'html, body',
		'key'		=>'background-color',
		'value'		=> avia_get_option('bg_color')
		);

		

if($header == avia_get_option('bg_color'))
{
	$avia_config['style'][] = array(
		'elements'	=>'#top #footer, #top #footer span, #top #footer div, #top #footer p, #top #footer a',
		'key'		=>'background-color',
		'value'		=> avia_backend_calculate_similar_color($header, 'lighter', 1)
		);
}
	

if(avia_get_option('bg_image') != '')
{
	$avia_config['style'][] = array(
		'elements'	=>'#header',
		'key'		=>'background-color',
		'value'		=> avia_get_option('bg_image_header_active')
		);

	if(avia_get_option('bg_image_repeat') != 'fullscreen')
	{
	$avia_config['style'][] = array(
		'elements'	=>'html, body',
		'key'		=>'backgroundImage',
		'value'		=> avia_get_option('bg_image')
		);
		
	$avia_config['style'][] = array(
		'elements'	=>'html, body',
		'key'		=>'background-position',
		'value'		=> 'top '.avia_get_option('bg_image_position')
		);

		
	$avia_config['style'][] = array(
		'elements'	=>'html, body',
		'key'		=>'background-repeat',
		'value'		=> avia_get_option('bg_image_repeat')
		);
		
	$avia_config['style'][] = array(
		'elements'	=>'html, body',
		'key'		=>'background-attachment',
		'value'		=> avia_get_option('bg_image_attachment')
		);
	}
}




