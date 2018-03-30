<?php

/*This file holds ALL color information of the theme that is applied with the styling backend admin panel. It is recommended to not edit this file, instead create new styles in custom.css and overwrite the styles within this file*/


global $avia_config;

  $avia_config['colorRules']['body_font'] 	= $body_font		= avia_get_option('body_font');
  $avia_config['colorRules']['primary'] 	= $primary			= avia_get_option('primary');
  $avia_config['colorRules']['body_bg'] 	= $body_bg			= avia_get_option('bg_color');
  $avia_config['colorRules']['boxed_bg'] 	= $boxed_bg			= avia_get_option('bg_color_boxed');
  $avia_config['colorRules']['border'] 		= $border			= avia_get_option('border');
  $avia_config['colorRules']['highlight'] 	= $highlight		= avia_get_option('highlight');
  $avia_config['colorRules']['bg_highlight']= $bg_highlight		= avia_get_option('bg_highlight');
  $avia_config['colorRules']['socket'] 		= $socket			= avia_get_option('socket_bg'); 
  $avia_config['colorRules']['socket_font'] = $socket_font		= avia_get_option('socket_font'); 
  $avia_config['colorRules']['footer'] 		= $footer			= avia_get_option('footer_bg'); 
  $avia_config['colorRules']['footer_font'] = $footer_font		= avia_get_option('footer_font'); 
  $avia_config['colorRules']['sidebar'] 	= $sidebar			= avia_get_option('sidebar_bg'); 
  $avia_config['colorRules']['sidebar_font']= $sidebar_font		= avia_get_option('sidebar_font'); 
  $avia_config['colorRules']['footer_meta'] = $footer_meta  	= avia_backend_merge_colors($footer_font, $footer);
  $avia_config['colorRules']['footer_meta_2'] = $footer_meta_2  = avia_backend_merge_colors($footer_meta, $footer);
  $avia_config['colorRules']['footer_meta'] = $footer_meta  	= avia_backend_merge_colors($footer_font, $footer_meta); 
  $avia_config['colorRules']['bg_image'] 	= $bg_image			= avia_get_option('bg_image') == "custom" ? avia_get_option('bg_image_custom') : avia_get_option('bg_image');


$meta_color 	= avia_backend_merge_colors($body_font, $boxed_bg); // creates a new color from the background color and the default font color (results in a lighter color)
$heading_color 	= avia_backend_merge_colors($body_font, avia_backend_counter_color($boxed_bg)); //calculates the inverse of the background color, then again creates a new color for headins (results in a stronger color)
$content_bg 	= $boxed_bg;


$meta_color = avia_backend_merge_colors($body_font, $meta_color);

$avia_config['colorRules']['meta_color'] = $meta_color;
$avia_config['colorRules']['heading_color'] = $heading_color;
$avia_config['colorRules']['content_bg'] = $content_bg;


$modify_to = 'lighter';
if($sidebar)
{
	$avia_config['colorRules']['sidebar_font_light']  = $sidebar_font_light  = avia_backend_merge_colors($sidebar, $sidebar_font);
	$avia_config['colorRules']['sidebar_extra_light'] = $sidebar_extra_light = avia_backend_merge_colors(avia_backend_merge_colors($sidebar, $sidebar_font_light),$sidebar);
	$avia_config['colorRules']['sidebar_hover'] 	  = $sidebar_hover       = avia_backend_calculate_similar_color($sidebar, $modify_to, 1);
	if($sidebar == '#ffffff' || $sidebar == '#fff' ) $avia_config['colorRules']['sidebar_hover'] = $sidebar_hover = '#f8f8f8';
	if($sidebar == '#f8f8f8' )  $avia_config['colorRules']['sidebar_hover'] = $sidebar_hover = '#ffffff';
}
else if($sidebar == "" || $sidebar =='#' || $sidebar == 'transparent')
{
	$avia_config['colorRules']['sidebar_font_light']  = $sidebar_font_light  = avia_backend_merge_colors($body_bg, $sidebar_font);
	$avia_config['colorRules']['sidebar_extra_light'] = $sidebar_extra_light = avia_backend_merge_colors(avia_backend_merge_colors($body_bg, $sidebar_font_light),$body_bg);
	$avia_config['colorRules']['sidebar_hover'] 	  = $sidebar_hover       = avia_backend_calculate_similar_color($body_bg, $modify_to, 1);
	if($body_bg == '#ffffff' || $body_bg == '#fff' )  $avia_config['colorRules']['sidebar_hover'] = $sidebar_hover = '#f8f8f8';
}




/*array that generates the colors. unfortunatley there is no easier way of grouping the items (or a more readable way)*/

$avia_config['style'] = array(

	//body font color
	array(
		'elements'	=>'#top .site-fontcolor, html, body, .blog-meta .post-meta-infos a, .blog-meta .post-meta-infos a span, .entry-content p a, .entry-content blockquote a, .entry-content>ul li a, .entry-content>ol li a',
		'key'		=>'color',
		'value'		=> $body_font
		),
		
	//meta font color: creates a lighter version of the main color
	array(
		'elements'	=>'#top .meta-color, div .meta-color a, .main_menu ul li a, .blog-inner-meta, .blog-inner-meta a, #top .widget ul li a, .minitext, .form-allowed-tags, div .pagination, #comments span, .minitext, .commentmetadata a, .blog-tags, .blog-tags a, .title_container #s, .wp-caption, .first-quote:before, .first-quote:after, blockquote small, blockquote cite, .hero-text, .js_active .tab, .news-time, .contentSlideControlls a, #js_sort_items a, .text-sep, .template-search a.post-entry .news-excerpt, .borderlist>li, .post_nav, .post_nav a, .quote-content, #top .widget_nav_menu li, .tweet-time, #top .avia_parnter_empty, .avia_socialcount a span, td, #top th.nobg, caption, .page-title, #top .first-title',
		'key'		=>'color',
		'value'		=> $meta_color
		),
		
	//heading font color: creates a stronger version of the main color
	array(
		'elements'	=>'#top .heading-color, strong, #top .main-color, .main_menu a,  #top .first-quote p, #top .main_menu .menu li li a:hover, h1, h2, h3, h4, h5, h6, .js_active .tab.active_tab, .first-quote, div .callout',
		'key'		=>'color',
		'value'		=> $heading_color
		),
	
	//superlight color
	array(
		'elements'	=>'#top .search-result-counter',
		'key'		=>'color',
		'value'		=> $bg_highlight
		),
		
	array(
		'elements'	=>'.side-container, .post_nav',
		'key'		=>'background-color',
		'value'		=> $heading_color
		),

	######################################################################
	# Page background color
	######################################################################

	
	array(
		'elements'	=>'#top .site-background, html, body, .comment-reply-link, .main_menu .menu ul li, .title_container #searchsubmit:hover, .isotope .entry-content, .image_overlay_effect, .tagcloud a, .news-thumb, .tweet-thumb a, fieldset, pre, .container_wrap .social_bookmarks li, #info_text_header.minimized',
		'key'		=>'background-color',
		'value'		=> $body_bg
		),
		
	array(
		'elements'	=>'tr:nth-child(even) td, tr:nth-child(even) th',
		'key'		=>'background-color',
		'value'		=> $body_bg
		),
		
	//font on elements with primary color, derived from background color	
	array(
		'elements'	=>'#top .on-primary-color, #top .on-primary-color a, .dropcap2, div .button, input[type="submit"], #submit, .info_text_header, .info_text_header a, .info_text_header a:hover, .contentSlideControlls a.activeItem, #top .related_posts .contentSlideControlls a.activeItem, .contentSlideControlls a:hover, #top .related_posts .contentSlideControlls a:hover, #top th, #top th a,  a.button:hover, .callout a, #top .big_button:hover',
		'key'		=>'color',
		'value'		=> $body_bg
		),
	
	//body background color highlight
	array(
		'elements'	=>'#top .aside-background, div .gravatar img, #top .main_menu .menu li ul a:hover, #top .related_posts_default_image, div .numeric_controls a, .title_container #searchsubmit, .title_container #s, .tab_content.active_tab_content, .js_active #top  .active_tab, .toggler.activeTitle, .contentSlideControlls a, #top .social_bookmarks li',
		'key'		=>'background-color',
		'value'		=> $bg_highlight
		),
		
		array(
		'elements'	=>'tr:nth-child(odd) td, tr:nth-child(odd) th',
		'key'		=>'background-color',
		'value'		=> $bg_highlight
		),
		
		
		
	
	//boxed background variations
	array(
		'elements'	=>'.boxed #overflow_bg, .boxed #primary, #top #header, #top.boxed .site-background, .boxed .comment-reply-link, .boxed .main_menu .menu ul li, .boxed .title_container #searchsubmit:hover, .boxed .isotope .entry-content, .boxed .image_overlay_effect, .boxed .tagcloud a, .boxed .news-thumb, .boxed fieldset, .boxed pre, .boxed .social_bookmarks li, .boxed #info_text_header.minimized, .portfolio-sort-container, .post_nav_sep, #top.boxed .news-thumb ,#top.boxed .tweet-thumb a',
		'key'		=>'background-color',
		'value'		=> $boxed_bg
		),
		
	array(
		'elements'	=>'.boxed tr:nth-child(even) td, .boxed tr:nth-child(even) th',
		'key'		=>'background-color',
		'value'		=> $boxed_bg
		),
	
	array(
		'elements'	=>'#top.boxed  .on-primary-color,  #top.boxed .on-primary-color a, .boxed .dropcap2, .boxed div .button,.boxed  input[type="submit"],.boxed  #submit, .boxed .info_text_header,.boxed  .info_text_header a,.boxed  .info_text_header a:hover, .boxed .contentSlideControlls a.activeItem, #top.boxed  .related_posts .contentSlideControlls a.activeItem, .boxed .contentSlideControlls a:hover, #top.boxed  .related_posts .contentSlideControlls a:hover, .boxed th, .boxed .tweet-thumb a, #top.boxed th, #top.boxed th a, .boxed a.button:hover, .boxed .callout a, .side-container, .main_menu ul:first-child > li.current-menu-item > a, .main_menu ul:first-child > li.current_page_item > a, .main_menu a:hover, .post_nav span, .post_nav a, .post_nav a:hover, #top .entry-content p a:hover, #top .entry-content blockquote a:hover, #top .entry-content>ul li a:hover, #top .entry-content>ol li a:hover',
		'key'		=>'color',
		'value'		=> $boxed_bg
		),




	######################################################################
	# primary color
	######################################################################
	
	//background color
	array(
		'elements'	=>'#top .primary-background, .dropcap2, div .button, input[type="submit"], #submit, .info_text_header, #info_text_header .infotext, .numeric_controls a:hover, .numeric_controls .active_item, .contentSlideControlls a.activeItem, #top th, #top .related_posts .contentSlideControlls a.activeItem, #top .arrow_controls a, #main .content #searchsubmit:hover, .callout a, #info_text_header.minimized:hover',
		'key'		=>'background-color',
		'value'		=> $primary
		),
		
	//color
	array(
		'elements'	=>'#top .primary-color, a, #cancel-comment-reply-link, .blog-tags a:hover, .relThumb a:hover strong, .flex_column h1, .flex_column h2, .flex_column h3, .flex_column h4, .flex_column h5, .flex_column h6, #top #wrap_all .tweet-text a, #top #js_sort_items a.active_sort, .callout a:hover',
		'key'		=>'color',
		'value'		=> $primary
		),
		
	//border color
	array(
		'elements'	=>'#top .primary-border, div .main_menu ul:first-child > li.current-menu-item > a, div .main_menu ul:first-child > li.current_page_item > a, div .button, input[type="submit"], #submit, #top .main_menu .menu ul, .info_text_header, .entry-content a, blockquote, blockquote blockquote blockquote',
		'key'		=>'border-color',
		'value'		=> $primary
		),


	//google webfonts
	array(
		'elements'	=> 'h1, h2, h3, h4, h5, h6, .hero-text, .first-quote, legend, #top .slideshow_caption h1, .main_menu ul:first-child > li > a strong',
		'key'	=>	'google_webfont',
		'value'		=> avia_get_option('google_webfont')
		),
		
	//google webfonts
	array(
		'elements'	=> 'body',
		'key'	=>	'google_webfont',
		'value'		=> avia_get_option('default_font')
		),
		
	######################################################################
	# border color
	######################################################################
	
	array(
		'elements'	=>'#top .extralight-border, div #header .container, div .pagination, #top .pagination span, div .pagination a, div .gravatar img, #top div .commentlist ul, div .children .children .says, div .commentlist>.comment, div .input-text, input[type="text"], input[type="password"], input[type="email"], textarea, select, #top .main_menu .menu li, pre, code, div .numeric_controls a, div .pullquote_boxed, div .news-thumb, div .tweet-thumb a, #top .borderlist>li, .post_nav, #top .wp-caption, .slideshow,  .widget a, .widget li, .widget span, .widget div, table, td, tr, th, #footer .container, #socket .container, #top fieldset, #top .social_bookmarks, #top .social_bookmarks li, #info_text_header, .ajax-control a, .inner_column, #top .blog-meta, .inner-entry, .inner_slide, #top .main_menu ul:first-child',
		'key'		=>'border-color',
		'value'		=> $border
		),	
		
	
	######################################################################
	# highlight hover color
	######################################################################
	
	array(
		'elements'	=>'#top .highlight-background, div .button:hover, input[type="submit"]:hover, #submit:hover, .contentSlideControlls a:hover, #top .related_posts .contentSlideControlls a:hover, #top .caption-slideshow-button:hover, #top .arrow_controls a:hover, #main .content #searchsubmit, #top .entry-content p a:hover, #top .entry-content blockquote a:hover, #top .entry-content>ul li a:hover, #top .entry-content>ol li a:hover',
		'key'		=>'background-color',
		'value'		=> $highlight
		),	
	
	array(
		'elements'	=>'a:hover, #top .widget ul li a:hover, #top .widget ul li .news-link:hover strong, #top #wrap_all .tweet-text a:hover, #js_sort_items a:hover, .ajax_slide a:hover, .ajax-control a:hover, .like-count:hover a',
		'key'		=>'color',
		'value'		=> $highlight
		),	
		
	array(
		'elements'	=>'#top .caption-slideshow-button:hover, blockquote blockquote, blockquote blockquote blockquote blockquote',
		'key'		=>'border-color',
		'value'		=> $highlight
		),
		
		
	######################################################################
	# sidebar
	
	#
	# $sidebar
	# $sidebar_font
	# $sidebar_font_light
	# $sidebar_extra_light
	# $sidebar_hover
	######################################################################		
	
	array(
		'elements'	=>'.sidebar, #sidebar_bg, #top .sidebar .main_menu .menu li ul a, .sidebar .main_menu .menu ul, #top .sidebar th, .sort_width_container.large_element #js_sort_items',
		'key'		=>'background-color',
		'value'		=> $sidebar
		),
		
		array(
		'elements'	=>'.sidebar tr:nth-child(even) td, .sidebar tr:nth-child(even) th',
		'key'		=>'background-color',
		'value'		=> $sidebar
		),
		
	array(
		'elements'	=>'.sidebar .main_menu ul:first-child > li.current-menu-item > a, .sidebar .main_menu ul:first-child > li.current_page_item > a, .sidebar .main_menu li:hover > a,  .sidebar .avia_socialcount, .sidebar .avia_parnter_empty, .sidebar .tagcloud a, .sidebar .tab_content.active_tab_content, .js_active #top .sidebar .active_tab, .sidebar .toggler.activeTitle, #top .portfolio-title, .inner-entry',
		'key'		=>'background-color',
		'value'		=> $sidebar_hover
		),
		
	array(
		'elements'	=>'.sidebar .main_menu ul:first-child > li> a, #top .sidebar .main_menu ul:first-child > li > a strong, #top .sidebar h1, #top .sidebar h2, #top .sidebar h3, #top .sidebar h4, #top .sidebar h5, #top .sidebar h6, #top .sidebar, #top .sidebar strong, #top #secondary .sidebar .widget a:hover, #top .sidebar th, #top .sidebar .widget ul li .news-link:hover strong, #top #wrap_all .sidebar .tweet-text a:hover, #top .sidebar .main_menu .menu li ul a:hover, #top .portfolio-title, #top .portfolio-title a:hover, #top .sort_width_container.large_element #js_sort_items a.active_sort',
		'key'		=>'color',
		'value'		=> $sidebar_font
		),	
			
	array(
		'elements'	=>'.sidebar .main_menu ul:first-child > li > a span, #top .sidebar span,  #top .sidebar .tweet-time, #top #secondary .sidebar .widget a,  #top #secondary .sidebar caption, #top .sidebar td, #top .sidebar .widget ul li .news-link:hover strong, #top .sidebar .main_menu .menu li ul a, #top .sort_width_container.large_element a',
		'key'		=>'color',
		'value'		=> $sidebar_font_light
		),	
		
	array(
		'elements'	=>'#top .sidebar img',
		'key'		=>'border-color',
		'value'		=> $sidebar_font_light
		),	
		
	array(
		'elements'	=>'#top #secondary .sidebar div, #top #secondary .sidebar ul, #top #secondary  .sidebar li, #top #secondary .sidebar a, #top #secondary .sidebar span, #top .sidebar .widget .seperator, .sidebar td, .sidebar th',
		'key'		=>'border-color',
		'value'		=> $sidebar_extra_light
		),	
		
	array(
		'elements'	=>'#top .sidebar img, .sidebar tr:nth-child(odd) td, .sidebar tr:nth-child(odd) th ',
		'key'		=>'background-color',
		'value'		=> $sidebar_extra_light
		),		
	
	######################################################################
	# footer
	######################################################################
	
	
array(
		'elements'	=>'#footer',
		'key'		=>'background-color',
		'value'		=> $footer
		),	
		
		array(
		'elements'	=>'#top #wrap_all #footer a, #footer h1, #footer h2, #footer h3, #footer h4, #footer h5, #footer h6, #footer strong, #footer .tabcontainer span, #top #footer table, #top #footer table td, #top #footer table caption',
		'key'		=>'color',
		'value'		=> $footer_font
		),
		
		array(
		'elements'	=>'#footer, #footer div, #footer p, #footer span, #top #wrap_all #footer a:hover strong',
		'key'		=>'color',
		'value'		=> $footer_meta
		),
		
		array(
		'elements'	=>'#footer a, #footer div, #footer span, #footer li, #footer ul',
		'key'		=>'border-color',
		'value'		=> $footer_meta_2
		),
		
		array(
		'elements'	=>'#footer table, #footer td, #footer tr, #footer th #footer img',
		'key'		=>'border-color',
		'value'		=> $footer_meta
		),
		
		
		array(
		'elements'	=>'#top #footer .tagcloud a, #footer .tab_content.active_tab_content, .js_active #top #footer .active_tab, #footer .news-thumb, #footer .tweet-thumb a',
		'key'		=>'background-color',
		'value'		=> $footer_meta_2
		),
		
		array(
		'elements'	=>'#footer tr:nth-child(odd) td, #footer tr:nth-child(odd) th',
		'key'		=>'background-color',
		'value'		=> $footer_meta_2
		),

		
	
		

		
	######################################################################
	# socket
	######################################################################
	
	array(
		'elements'	=>'#socket, #socket a, html.html_stretched',
		'key'		=>'background-color',
		'value'		=> $socket
		),	
		
		array(
		'elements'	=>'#socket, #socket a',
		'key'		=>'color',
		'value'		=> $socket_font
		),	
		
		
		
	######################################################################
	# text selection
	######################################################################		
	
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
		'value'		=> $content_bg
		),
		
		array(
		'elements'	=>'::-webkit-selection',
		'key'		=>'color',
		'value'		=> $content_bg
		),
		
		array(
		'elements'	=>'::selection',
		'key'		=>'color',
		'value'		=> $content_bg
		),
		
		array(
		'key'	=>	'direct_input',
		'value'		=> avia_get_option('quick_css')
		),
		
	
);



if($bg_image != '')
{

	if(avia_get_option('bg_image_repeat') != 'fullscreen')
	{
	$avia_config['style'][] = array(
		'elements'	=>'html.html_boxed, body',
		'key'		=>'backgroundImage',
		'value'		=> $bg_image
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




