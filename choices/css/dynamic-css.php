<?php

/*
This file holds ALL color information of the theme that is applied with the styling backend admin panel. 
It is recommended to not edit this file, instead create new styles in custom.css and overwrite the styles within this file

Example of available values
$bg 				=> #222222
$bg2 				=> #f8f8f8
$primary 			=> #c8ccc2
$secondary			=> #182402
$color	 			=> #ffffff
$border 			=> #e1e1e1
$img 				=> /wp-content/themes/skylink/images/background-images/dashed-cross-dark.png
$pos 				=> top left
$repeat 			=> no-repeat
$attach 			=> scroll
$heading 			=> #eeeeee
$meta 				=> #888888
$background_image	=> #222222 url(/wp-content/themes/skylink/images/background-images/dashed-cross-dark.png) top left no-repeat scroll
*/



global 	$avia_config; 
$output = "";
$body_color = "";

extract($color_set);
extract($main_color);
extract($styles);


######################################################################
# CREATE THE CSS DYNAMIC CSS RULES
######################################################################
/*default*/


$output .= "

::-moz-selection{
background-color: $primary;
color: $bg;
}

::-webkit-selection{
background-color: $primary;
color: $bg;
}

::selection{
background-color: $primary;
color: $bg;
}

";

if(!empty($body_color))
{
	$output .= "

	body.boxed {background-color: $body_color;}

";
}


if(isset($body_background))
{
	$output .= "
	
	body.boxed { background: $body_background ;}
	
	";
}


/*color sets*/
foreach ($color_set as $key => $colors) // iterates over the color sets: usually $key is either: header_color, main_color, footer_color, socket_color
{
	$key = ".".$key;
	extract($colors);
	
	
	/*general styles*/
	$output.= "
$key, $key div, $key  span, $key  applet, $key object, $key iframe, $key h1, $key h2, $key h3, $key h4, $key h5, $key h6, $key p, $key blockquote, $key pre, $key a, $key abbr, $key acronym, $key address, $key big, $key cite, $key code, $key del, $key dfn, $key em, $key img, $key ins, $key kbd, $key q, $key s, $key samp, $key small, $key strike, $key strong, $key sub, $key sup, $key tt, $key var, $key b, $key u, $key i, $key center, $key dl, $key dt, $key dd, $key ol, $key ul, $key li, $key fieldset, $key form, $key label, $key legend, $key table, $key caption, $key tbody, $key tfoot, $key thead, $key tr, $key th, $key td, $key article, $key aside, $key canvas, $key details, $key embed, $key figure, $key fieldset, $key figcaption, $key footer, $key header, $key hgroup, $key menu, $key nav, $key output, $key ruby, $key section, $key summary, $key time, $key mark, $key audio, $key video, #top $key .pullquote_boxed{
border-color:$border;
	}
	

$key , $key .site-background, $key .first-quote,  $key .related_image_wrap, $key .gravatar img, $key .comment-reply-link, $key .inner_slide .numeric_controls a, $key .hr_content, $key .news-thumb, $key .post-format-icon, $key .ajax_controlls a{
background-color:$bg;
color: $color;
}

$key h1, $key h2, $key h3, $key h4, $key h5, $key h6, $key strong, $key strong a, $key .sidebar .current_page_item a, $key .pagination .current, $key .comment-count, $key .callout .content-area, $key .avia-big-box .avia-innerbox, $key .avia-big-box .avia-innerbox a{
color:$heading;
}
	
$key .meta-color, $key .sidebar, $key .sidebar a, $key .minor-meta, $key .minor-meta a, $key .text-sep, $key .quote-content, $key .quote-content a, $key blockquote, $key .post_nav a, $key .comment-text, $key .template-search  a.news-content, $key .subtitle_intro, $key div .hr_content, $key .hr a, $key .breadcrumb, $key .breadcrumb a, $key .portfolio_excerpt, $key .avia-big-box-bellow, $key .side-container-inner, $key .news-time{
color: $meta;
}

$key a, $key .widget_first{
color:$primary;
}

$key a:hover, $key h1 a:hover, $key h2 a:hover, $key h3 a:hover, $key h4 a:hover, $key h5 a:hover, $key h6 a:hover,  $key .template-search  a.news-content:hover{
color: $secondary;
}	

$key .primary-background, $key .dropcap2, $key .primary-background a, $key .slide_controls a:hover, $key .avia_welcome_text, $key .avia_welcome_text a, $key .pagination a:hover, div $key .button, $key #submit, $key .big_button, $key .iconbox_icon, $key .iconbox_top_icon, $key .side-container-inner .day, #top $key .active_item, $key .contentSlideControlls .activeItem, $key input[type='submit']{
background-color: $primary;
color:$bg;
border-color:$primary;
}

$key .button:hover, $key .ajax_controlls a:hover, $key #submit:hover, $key .big_button:hover, $key .contentSlideControlls a:hover, $key input[type='submit']:hover{
background-color: $secondary;
color:$bg;
border-color:$secondary;
}

$key .timeline-bullet{
background-color:$border;
border-color: $bg;
}

$key .iconbox_top, #top $key.thumbnails_container_wrap, $key .portfolio-sort-container .inner-entry, $key .pullquote_boxed, $key .side-container-inner .date_group{
background: $bg2;
}

#top $key .post_timeline li:hover .timeline-bullet, $key .portfolio-sort-container .inner-entry:hover{
background-color:$secondary;
}

#top #wrap_all $key .portfolio-sort-container .inner-entry:hover h1, #top #wrap_all $key .portfolio-sort-container .inner-entry:hover h1 a, #top #wrap_all $key .portfolio-sort-container .inner-entry:hover p{
color:#fff;
}

$key blockquote, $key .portfolio-sort-container .inner-entry:hover{
border-color:$primary;
}

$key .widget_nav_menu ul:first-child>.current-menu-item, $key .widget_nav_menu ul:first-child>.current_page_item{
background-color: $bg;
}

#top $key.title_container .main-title, #top $key.title_container .main-title a, #top $key .title_container .main-title, #top $key .title_container .main-title a, $key .slideshow li{
color:$color;
}

";



//main menu
$output.= "

$key .main_menu ul, $key .main_menu .menu ul li a, $key .pointer_arrow_wrap .pointer_arrow{
background-color:$bg;
color: $meta;
}

$key .main_menu ul:first-child > li > a, #top $key .main_menu .menu ul .current_page_item > a, #top $key .main_menu .menu ul .current-menu-item > a {
color:$color;
}

#top $key .main_menu .menu ul li>a:hover{
color:$color;
}

$key .main_menu ul:first-child > li a:hover, 
$key .main_menu ul:first-child > li.current-menu-item > a,  
$key .main_menu ul:first-child > li.current_page_item > a, 
$key .main_menu ul:first-child > li.active-parent-item > a{
color:$meta;
}
";




// form fields
$output.= "

 $key .input-text, $key input[type='text'], $key input[type='input'], $key input[type='password'], $key input[type='email'], $key textarea, $key select{
border-color:$border;
background-color: $bg2;
color:$meta;
}

";



//sidebar tab & Tabs shortcode
$output.= "
div  $key .tabcontainer .active_tab_content, div $key .tabcontainer  .active_tab{
background-color: $bg2;
color:$color;
}


$key .sidebar_tab_icon {
background-color: $border;
}

#top $key .sidebar_active_tab .sidebar_tab_icon {
background-color: $primary;
}

$key .sidebar_tab:hover .sidebar_tab_icon {
background-color: $secondary;
}

$key .sidebar_tab, $key .tabcontainer .tab{
color: $meta;
}

$key div .sidebar_active_tab , $key .sidebar_tab:hover{
color: $color;
background-color: $bg;
}

@media only screen and (max-width: 767px) {
	.responsive $key div .sidebar_active_tab{ background-color: $secondary; color:#fff; } /*hard coded white to match the icons beside which are also white*/
	.responsive $key .sidebar_tab_content{border-color:$border;}
}

";


//table shortcode

$output.= "
$key div .avia_table table, $key div .avia_table th, $key div .avia_table td {
border-color: $border;
}

$key div .avia_table, $key div .avia_table td{
background:$bg;
color: $color;
}


$key div .avia_table tr:nth-child(odd) td, $key div .avia_table tr:nth-child(odd) th, $key div .avia_table tr:nth-child(odd) .th, $key .avia_table .avia-button, $key .avia_table table tr.button-row td{
background-color: $bg2;
}


$key div .avia_table tr.description_row td, $key div .avia_table tr.pricing-row td, $key tr.pricing-row .avia-table-icon, $key tr.description_row .avia-table-icon, $key .css_3_hover{
color:$bg;
background: $primary;
}

html $key .avia_table table tr td.description_column, html $key .avia_table table.description_row tr td.description_column, .avia-table-icon{
border-color:$border;
color:$meta;
}

$key .avia_table .avia-button{
color: $bg;
background-color:$primary;
border-color:$primary;
}



";

	//apply background image if available
	if(isset($background_image)) 
	{
		$output .= "$key { background: $background_image; }
		";
	}
	
	//button and dropcap color white unless primary color is very very light
	if(avia_backend_calc_preceived_brightness($primary, 220))
	{
		$output .= "
		
		$key dropcap2, $key dropcap3, $key avia_button, $key avia_button:hover, $key .on-primary-color, $key .on-primary-color:hover{ 
		color: #fff; 
		}
		
		";
	}
	
	
	
	//only for certain areas
	switch($key)
	{
		case '.header_color':
		
		$output .= " 
			
			#header { border-color: $primary;  }
			#info_text_header, #info_text_header a, #info_text_header a:hover { background-color: $primary;  color:#fff;}
			
			";
		
		break;
		
		case '.main_color':
		
		$output .= " 
			
			#wrap_all{ background-color: $bg; }
			#top .feedback_button { border-color: $primary;  background-color: $primary;  color:#fff;}
			#top .feedback_button:hover { border-color: $secondary;  background-color: $secondary;  color:#fff;}
			
			";
		
		break;
		
		
	
		case '.footer_color':
			
			$output .= " 
			
			#footer  .widgettitle{ color: $meta;  }
			#footer a{color: $color; }
			#footer a:hover, #footer .widget_first{ color: $heading; }
			
			";
		
		break;
		
		
		case '.socket_color':
			
			$output .= " body.stretched {background-color: $bg;}";
		
		break;
	}
	
	
	
	//unset all vars with the help of variable vars :)
	foreach($colors as $key=>$val){ unset($$key); }

}

//filter to plug in, in case a plugin/extension/config file wants to make use of it
$output = apply_filters('avia_dynamic_css_output', $output, $color_set);


######################################################################
# OUTPUT THE DYNAMIC CSS RULES
######################################################################

//compress output
$output = preg_replace('/\r|\n|\t/', '', $output);

//todo: if the style are generated for the wordpress header call the generating script, otherwise create a simple css file and link to that file

$avia_config['style'] = array(

		array(
		'key'	=>	'direct_input',
		'value'		=> $output
		),
		
		array(
		'key'	=>	'direct_input',
		'value'		=> avia_get_option('quick_css')
		),
		
		//google webfonts
		array(
		'elements'	=> 'h1, h2, h3, h4, h5, h6, tr.pricing-row td, #top .portfolio-title, .callout .content-area, .avia-big-box .avia-innerbox',
		'key'	=>	'google_webfont',
		'value'		=> avia_get_option('google_webfont')
		),
		
		//google webfonts
		array(
		'elements'	=> 'body, .flex_column h1, .flex_column h2, .flex_column h3, .flex_column h4, .flex_column h5, .flex_column h6, #top .widgettitle',
		'key'	=>	'google_webfont',
		'value'		=> avia_get_option('default_font')
		)
);




