<!-- CUSTOM THEME STYLES -->
<style type="text/css">
<?php 

$css='';
$option_keys = array("skin" , "custom_color" , "content_bg",
	"body_color" ,  "custom_body_bg" , "body_text_size" , "border_color",
	"logo_image" , "retina_logo_image" , "logo_width" , "logo_height" , 
	"link_color" , "heading_color" , "accent_color" , "custom_accent_color",
	"footer_bg", "footer_text_color" , "footer_copyright_bg", "footer_link_color",
	"headings_font_family" , "body_font", "menu_font", "footer_border_color",
	"footer_copyright_text", "footer_title_color", "header_color",
	"content_bg", "secondary_color", "secondary_text_color",
	"side_color", "side_heading_color", "side_border_color", "cta_bg_color", 
	"cta_color");

foreach ($option_keys as $key) {
	$pexeto_css[$key] = pexeto_get_saved_option($key);
}

$pexeto_main_color=$pexeto_css['custom_color']==''?$pexeto_css['skin']:$pexeto_css['custom_color'];

/**--------------------------------------------------------------------*
 * SET THE LOGO
 *---------------------------------------------------------------------*/

$logo_width = 133;
$logo_height = 50;


if(!empty($pexeto_css['logo_width'])){
	$logo_width = $pexeto_css['logo_width'];
	$css.= '#logo-container img{width:'.$pexeto_css['logo_width'].'px; }';
}


if(!empty($pexeto_css['logo_height'])){
	$logo_height = $pexeto_css['logo_height'];
	$css.= '#logo-container img{height:'.$pexeto_css['logo_height'].'px;}';
}


/**--------------------------------------------------------------------*
 * GENERAL OPTIONS
 *---------------------------------------------------------------------*/

$accent_color=$pexeto_css['custom_accent_color']?$pexeto_css['custom_accent_color']:$pexeto_css['accent_color'];
if($accent_color!=''){
	$css.= 'button, .button, input[type="submit"], input[type="button"], #submit, .header-wrapper,
		.scroll-to-top:hover, .pc-next, .pc-prev, #content-container .wp-pagenavi span.current,
		#content-container .wp-pagenavi a:hover, .pg-pagination a.current, .pg-pagination a:hover,
		.ps-left-arrow:hover, .ps-right-arrow:hover, .pt-highlight .pt-title
		{background-color:#'.$accent_color.';}';

	$css.='.woocommerce .button, .woocommerce button{background-color:#'.$accent_color.' !important;}';

	$css.='a, a:hover, .tabs .current a, .read-more, .footer-widgets a:hover, .comment-info .reply, 
		.comment-info .reply a, .comment-info, #wp-calendar tbody td a,
		.widget_nav_menu li.current-menu-item > a, .post-title a:hover, .post-tags a,
		.archive-page a:hover, .testimonials-details a,
		.carousel-title .link-title, .post-info a, .pg-cat-filter a.current,
		.lp-title a:hover, .pg-icon {color:#'.$accent_color.';}';

	$css.='.accordion-title.current, .read-more:hover, .more-arrow, .sticky,
		.format-quote, .format-aside, .read-more, .bypostauthor {border-color:#'.$accent_color.';}';

	$css.='.pg-element-loading .icon-circle::after{border-top-color:#'.$accent_color.';}';
	
}


/**--------------------------------------------------------------------*
 * HEADER OPTIONS
 *---------------------------------------------------------------------*/
if(!empty($pexeto_css['header_color'])){
	$css.= '#menu>ul>li>a, #menu>ul>.current-menu-item>a, #menu>ul>li:hover>a,
	.page-title h1, #menu>ul>.current-menu-parent>a, #menu>ul>li.current-menu-ancestor>a
		{color:#'.$pexeto_css['header_color'].';}';
}

/**--------------------------------------------------------------------*
 * CONTENT OPTIONS
 *---------------------------------------------------------------------*/

if(!empty($pexeto_css['content_bg'])){
	$css.= '.post, .tabs .current a, .page-template-template-full-custom-php .page-wrapper,
	.content-box, .avatar, .comment-box, .search-results .post-content,
	.pg-info, .ps-wrapper, .content input[type="text"], 
	.content input[type="password"], .content textarea, .contact-captcha-container
	{background-color:#'.$pexeto_css['content_bg'].';}';
}

if(!empty($pexeto_css['custom_body_bg'])){
	$css.= '.page-wrapper, #sidebar input[type="text"], 
	#sidebar input[type="password"], #sidebar textarea, .comment-respond input[type="text"],
	 .comment-respond textarea{background-color:#'.$pexeto_css['custom_body_bg'].';}';
}

if(!empty($pexeto_css['body_color'])){
	$css.= '.content, .services-title-box, .services-box, .no-caps,
		.small-title span, .comment-date, .archive-page a, .post-info, 
		.ps-categories, .pg-categories, .content input[type=text], .content input[type=password], 
	.content textarea, .content input[type=search], .pt-col
		{color:#'.$pexeto_css['body_color'].';}';
}


if(!empty($pexeto_css['heading_color'])){
	$css.= '.content h1,.content h2,.content h3,.content h4,.content h5,
		.content h6, h1.page-heading, .post h1, 
		h2.post-title a, .content-box h2, #portfolio-categories ul li,
		.item-desc h4 a, .item-desc h4, .content table th, 
		.post-title, .archive-page h2, .page-heading, .ps-title,
		.tabs a, .post-title a:hover{color:#'.$pexeto_css['heading_color'].';}';
}

if(!empty($pexeto_css['link_color'])){
	$css.= 'a, a:hover, .post-info, .post-info a, .lp-post-info a, .read-more, .read-more:hover,
	.testimonials-details a, .carousel-title .link-title
		{color:#'.$pexeto_css['link_color'].';}';
	$css.='.read-more{border-color:#'.$pexeto_css['link_color'].';}';
}


if(!empty($pexeto_css['secondary_color'])){
	$css.= '.tabs-container > ul li a, .accordion-title,
	.post-tags a, .tabs-container > ul li a, .recaptcha-input-wrap,
	.pexeto-recent-posts .format-quote, .pexeto-recent-posts .format-aside, .pt-price-box
	{background-color:#'.$pexeto_css['secondary_color'].';}';

	$css.='.pc-next, .pc-prev, .ts-thumbnail-wrapper
		{border-color:#'.$pexeto_css['secondary_color'].';}';
}


if(!empty($pexeto_css['secondary_text_color'])){
	$css.= '.ps-loading,  .tabs-container > ul li a, .accordion-title,
	.post-tags a, .tabs-container > ul li a, .tabs .current a,
	.pexeto-recent-posts .format-quote, .pexeto-recent-posts .format-aside,
	.pt-cur, .pt-price, .pt-period
		{color:#'.$pexeto_css['secondary_text_color'].';}';
}


if(!empty($pexeto_css['border_color'])){
	$css.= 'blockquote, .content input[type=text], .content input[type=password], 
	.content textarea, .content input[type=search], .content table th, .content table tr,
	.content table thead, .content .table-bordered, .tabs-container > ul,
	.tabs .current a, .tabs-container .panes, .accordion-title, .avatar,
	.contact-captcha-container, .recaptcha-input-wrap, .pc-header, .rp-list ul, 
	.rp-list li, .archive-page ul, .page-heading
	{border-color:#'.$pexeto_css['border_color'].';}';
	$css.='.tabs-container > ul li a{box-shadow: none;}';
}



/**--------------------------------------------------------------------*
 * SIDE CONTENT OPTIONS
 *---------------------------------------------------------------------*/

if(!empty($pexeto_css['side_color'])){
	$css.= '.sidebar, .sidebar a, .widget_categories li a, .widget_nav_menu li a, 
		.widget_archive li a, .widget_links li a, .widget_recent_entries li a, 
		.widget_links li a, .widget_pages li a, .widget_recent_entries li a, 
		.recentcomments, .widget_meta li a, .sidebar input[type=text], .sidebar input[type=password], 
		.sidebar textarea, .sidebar input[type=search], .sidebar-box .recentcomments a,
		.comment-form, .comment-form input[type=text], .comment-form textarea,
		.pg-cat-filter a, .pg-cat-filter a.current, .pg-cat-filter li:after,
		.ps-nav-text, .ps-icon
		{color:#'.$pexeto_css['side_color'].';}';
}

if(!empty($pexeto_css['side_heading_color'])){
	$css.= '.sidebar h1,.sidebar h2,.sidebar h3,.sidebar h4,.sidebar h5,
		.sidebar h6, .sidebar h1 a,.sidebar h2 a,.sidebar h3 a,.sidebar h4 a,.sidebar h5 a,
		.sidebar h6 a, .sidebar-post-wrapper h6 a, #comments h3, #portfolio-slider .pc-header h4,
		#comments h4, #portfolio-gallery .pc-header h4
		{color:#'.$pexeto_css['side_heading_color'].';}';
}

if(!empty($pexeto_css['side_border_color'])){
	$css.= '.sidebar blockquote, .sidebar input[type=text], .sidebar input[type=password], 
	.sidebar textarea, .sidebar input[type=search], .sidebar table th, .sidebar table tr,
	.sidebar table thead, .sidebar .table-bordered, .lp-wrapper, .widget_categories li, 
	.widget_nav_menu li, .widget_archive li, .widget_links li, .widget_recent_entries li, 
	.widget_pages li, #recentcomments li, .widget_meta li, .widget_rss li,
	.comment-form input[type=text], .comment-form textarea, .comments-titile, #reply-title,
	#portfolio-slider .pc-header, #wp-calendar caption, #portfolio-gallery .pc-header,
	.widget_nav_menu ul ul li, .widget_categories ul ul li, .widget_nav_menu ul ul, .widget_categories ul ul
	{border-color:#'.$pexeto_css['side_border_color'].';}';
}


/**--------------------------------------------------------------------*
 * FOOTER OPTIONS
 *---------------------------------------------------------------------*/



if(!empty($pexeto_css['footer_bg'])){
	$css.= '#footer{background-color:#'.$pexeto_css['footer_bg'].';}';
}

if(!empty($pexeto_css['footer_copyright_bg'])){
	$css.= '.footer-bottom{background-color:#'.$pexeto_css['footer_copyright_bg'].';}';
}


if(!empty($pexeto_css['footer_border_color'])){
	$css.= '.footer-box .title, #footer .img-frame, #footer .lp-wrapper,
		#footer #recentcomments li, .footer-bottom,
	.footer-widgets .widget_categories li, .footer-widgets .widget_nav_menu li, 
	.footer-widgets .widget_archive li, .footer-widgets .widget_links li, 
	.footer-widgets .widget_recent_entries li, .footer-widgets .widget_pages li, 
	.footer-widgets #recentcomments li, .footer-widgets .widget_meta li, 
	.footer-widgets .widget_rss li, .footer-widgets .widget_nav_menu ul ul li, 
	.footer-widgets .widget_nav_menu ul ul, .footer-widgets .lp-wrapper, 
	.footer-widgets table thead, .footer-widgets table td
		 {border-color:#'.$pexeto_css['footer_border_color'].';}';
}



if(!empty($pexeto_css['footer_text_color'])){
	$css.= '#footer, .footer-box, #footer .footer-widgets .lp-post-info a {color:#'.$pexeto_css['footer_text_color'].';}';
}

if(!empty($pexeto_css['footer_copyright_text'])){
	$css.= '#footer .copyrights, #footer .footer-bottom li a, .footer-nav li:after{color:#'.$pexeto_css['footer_copyright_text'].';}';
}

if(!empty($pexeto_css['footer_title_color'])){
	$css.= '.footer-box .title{color:#'.$pexeto_css['footer_title_color'].';}';
}

if(!empty($pexeto_css['footer_link_color'])){
	$css.= '#footer .footer-widgets li a, #footer .footer-widgets a
		{color:#'.$pexeto_css['footer_link_color'].';}';

	$css.='#footer .button{color:#fff;}';
}


if(!empty($pexeto_css['cta_bg_color'])){
	$css.= '#footer-cta{background-color:#'.$pexeto_css['cta_bg_color'].';}';
}

if(!empty($pexeto_css['cta_color'])){
	$css.= '#footer-cta h5, .footer-cta-disc{color:#'.$pexeto_css['cta_color'].';}';
}

/**--------------------------------------------------------------------*
 * FONTS
 *---------------------------------------------------------------------*/
if($pexeto_css['headings_font_family']!='' && $pexeto_css['headings_font_family']!='default'){
	$font_name = pexeto_get_font_name_by_key($pexeto_css['headings_font_family']);
	if(!empty($font_name)){
		$css.= 'h1,h2,h3,h4,h5,h6{font-family:'.$font_name.';}';
	}
	
}


if(isset($pexeto_css['body_font']) && isset($pexeto_css['body_font']['family'])
	&& $pexeto_css['body_font']['family']!='' && $pexeto_css['body_font']['family']!='default'){
	$font_name = pexeto_get_font_name_by_key($pexeto_css['body_font']['family']);
	if(!empty($font_name)){
		$css.= 'body{font-family:'.$font_name.';}';
	}
}

if(isset($pexeto_css['body_font']) && isset($pexeto_css['body_font']['size'])
	&& !empty($pexeto_css['body_font']['size'])){
	$css.= 'body, #footer, .sidebar-box, .services-box, .ps-content, .page-masonry .post, .services-title-box{font-size:'.$pexeto_css['body_font']['size'].'px;}';
}

if(isset($pexeto_css['menu_font']) && isset($pexeto_css['menu_font']['family'])
	&& $pexeto_css['menu_font']['family']!='' && $pexeto_css['menu_font']['family']!='default'){
	$font_name = pexeto_get_font_name_by_key($pexeto_css['menu_font']['family']);
	if(!empty($font_name)){
		$css.= '#menu ul li a{font-family:'.$font_name.';}';
	}
}

if(isset($pexeto_css['menu_font']) && isset($pexeto_css['menu_font']['size']) 
	&& !empty($pexeto_css['menu_font']['size'])){
	$css.= '#menu ul li a{font-size:'.$pexeto_css['menu_font']['size'].'px;}';
}


/**--------------------------------------------------------------------*
 * ADDITIONAL STYLES
 *---------------------------------------------------------------------*/

if(pexeto_option('additional_styles')!=''){
	$css.=(pexeto_option('additional_styles'));
}

echo $css;
?>

</style>