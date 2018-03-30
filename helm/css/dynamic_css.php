<?php
require_once( '../../../../wp-load.php' );
Header("Content-type: text/css");

$theme_imagepath =  get_template_directory_uri() . '/images/';


function ApplyFont ( $fontName , $fontClasses ) {

	$got_font=of_get_option($fontName, $fontClasses);
	
	if ($got_font) {
		$font_pieces = explode(":", $got_font);
		$font_name = $font_pieces[0];
		echo $fontClasses . "{ font-family:'" . $font_name . "'; }";
	}

}

$heading_classes='
h1,
h2,
h3,
h4,
h5,
h6';

$page_heading_classes='
.entry-content h1,
.entry-content h2,
.entry-content h3,
.entry-content h4,
.entry-content h5,
.entry-content h6,
ul#portfolio-tiny h4,
ul#portfolio-small h4, ul#portfolio-large h4,
.entry-post-title h2,
.news-text a
';
//Font

ApplyFont ( "heading_font" , $heading_classes );
ApplyFont ( "page_headings" , $page_heading_classes );
ApplyFont ( "menu_font" , ".homemenu, .homemenu ul li strong" );
ApplyFont ( "super_title" , ".slideshow_title" );

//Logo
$logo_topmargin=of_get_option('logo_topmargin');
if ($logo_topmargin) {
	echo '.logo { margin-top: '.$logo_topmargin.'px; }';
}
$logo_bottommargin=of_get_option('logo_bottommargin');
if ($logo_bottommargin) {
	echo '.logo { margin-bottom: '.$logo_bottommargin.'px; }';
}
$logo_leftmargin=of_get_option('logo_leftmargin');
if ($logo_leftmargin) {
	echo '.logo { margin-left: '.$logo_leftmargin.'px; }';
}


//Step Icons
$step_1_icon=of_get_option('step_1_icon');
if ($step_1_icon) {
	echo '.grid-list-four-services .service-icon1 { background-image: url('.$step_1_icon.'); }';
}
$step_2_icon=of_get_option('step_2_icon');
if ($step_2_icon) {
	echo '.grid-list-four-services .service-icon2 { background-image: url('.$step_2_icon.'); }';
}
$step_3_icon=of_get_option('step_3_icon');
if ($step_3_icon) {
	echo '.grid-list-four-services .service-icon3 { background-image: url('.$step_3_icon.'); }';
}
$step_4_icon=of_get_option('step_4_icon');
if ($step_4_icon) {
	echo '.grid-list-four-services .service-icon4 { background-image: url('.$step_4_icon.'); }';
}
//icon Backgrounds
$stepicon_1_bgcolor=of_get_option('stepicon_1_bgcolor');
if ($stepicon_1_bgcolor) {
	echo '.grid-list-four-services .service-icon1 { background-color:'.$stepicon_1_bgcolor.'; }';
}
$stepicon_2_bgcolor=of_get_option('stepicon_2_bgcolor');
if ($stepicon_2_bgcolor) {
	echo '.grid-list-four-services .service-icon2 { background-color:'.$stepicon_2_bgcolor.'; }';
}
$stepicon_3_bgcolor=of_get_option('stepicon_3_bgcolor');
if ($stepicon_3_bgcolor) {
	echo '.grid-list-four-services .service-icon3 { background-color:'.$stepicon_3_bgcolor.'; }';
}
$stepicon_4_bgcolor=of_get_option('stepicon_4_bgcolor');
if ($stepicon_4_bgcolor) {
	echo '.grid-list-four-services .service-icon4 { background-color:'.$stepicon_4_bgcolor.'; }';
}

//Step Backgrounds
$step_1_bgcolor=of_get_option('step_1_bgcolor');
if ($step_1_bgcolor) {
	echo '.grid-list-four-services ul li .gridfour_col1 { background-color:'.$step_1_bgcolor.'; }';
}
$step_2_bgcolor=of_get_option('step_2_bgcolor');
if ($step_2_bgcolor) {
	echo '.grid-list-four-services ul li .gridfour_col2 { background-color:'.$step_2_bgcolor.'; }';
}
$step_3_bgcolor=of_get_option('step_3_bgcolor');
if ($step_3_bgcolor) {
	echo '.grid-list-four-services ul li .gridfour_col3 { background-color:'.$step_3_bgcolor.'; }';
}
$step_4_bgcolor=of_get_option('step_4_bgcolor');
if ($step_4_bgcolor) {
	echo '.grid-list-four-services ul li .gridfour_col4 { background-color:'.$step_4_bgcolor.'; }';
}

//Accents
$accent_color=of_get_option('accent_color');
if ($accent_color) {
echo "
#recentposts_list .recentpost_info .recentpost_title,
#popularposts_list .popularpost_info .popularpost_title,
.homemenu ul li strong,
.grid-list-home-columns ul li h3 a,
ul.portfolio-four h4 a,
ul.portfolio-three h4 a,
ul.portfolio-two h4 a,
ul.portfolio-one h4 a,
.last-bigsaywrap a,
.entry-post-title h2 a,
.sidebar a,
ul.portfolio-metainfo li a,
.ajax-portfolio-data h1 a {
color: ".$accent_color.";
}";
}

$accent_color_hover=of_get_option('accent_color_hovers');
if ($accent_color_hover) {
//background color
echo "
.main-select-menu select,
.pagination span.current {
background-color:".$accent_color_hover.";
}

#recentposts_list .recentpost_info .recentpost_title:hover,
#popularposts_list .popularpost_info .popularpost_title:hover,
.grid-list-home-columns ul li h3 a:hover,
ul.portfolio-four h4 a:hover,
ul.portfolio-three h4 a:hover,
ul.portfolio-two h4 a:hover,
ul.portfolio-one h4 a:hover,
.last-bigsaywrap a:hover,
.entry-post-title h2 a:hover,
.sidebar a:hover,
ul.portfolio-metainfo li a:hover,
.ajax-portfolio-data h1 a:hover,
.homemenu ul li:hover strong {
color: ".$accent_color_hover.";
}

ul.portfolio-filter li.current a:after {
	border-bottom:4px solid ".$accent_color_hover.";
}
";

}


//Menu color

$photomenusubcat_color=of_get_option('photomenusubcat_color');
if ($photomenusubcat_color) {
echo '.homemenu ul ul li { background:'.$photomenusubcat_color.'; }';
}

$photomenu_link_color=of_get_option('photomenu_link_color');
if ($photomenu_link_color) echo '.homemenu a,.homemenu ul li strong {color:'.$photomenu_link_color.' !important;}';

$photomenu_hover_color=of_get_option('photomenu_hover_color');
if ($photomenu_hover_color) echo '.homemenu ul ul li:hover>a {background:'.$photomenu_hover_color.';}';

$photomenu_desc_color=of_get_option('photomenu_desc_color');
if ($photomenu_desc_color) echo '.homemenu ul li span {color:'.$photomenu_desc_color.';}';

$photomenu_subcat_hover_color=of_get_option('photomenu_subcat_hover_color');
if ($photomenu_subcat_hover_color) echo '.homemenu ul ul li {background:'.$photomenu_subcat_hover_color.';}';

$photomenu_linkhover_color=of_get_option('photomenu_linkhover_color');
if ($photomenu_linkhover_color) echo '.homemenu a:hover, .homemenu ul li strong:hover { color:'.$photomenu_linkhover_color.'  !important;}';

$content_pagebg=of_get_option('content_pagebg');
if ($content_pagebg) {
echo '.container, .postsummarywrap, .contents-wrap, .fullpage-contents-wrap, .page-contents-wrap,.mcycletextwrap { background-color:'.$content_pagebg.'; }';
echo '.blogseperator { background-color:'.$content_pagebg.'; border:none;}';
}

$content_titlebg=of_get_option('content_titlebg');
if ($content_titlebg) {
echo 'h1.entry-title,h2.entry-title { background-color:'.$content_titlebg.'; }';
}

$content_title=of_get_option('content_title');
if ($content_title) {
echo 'h1.entry-title,h2.entry-title { color:'.$content_title.'; }';
}

$content_titlelinks=of_get_option('content_titlelinks');
if ($content_titlelinks) {
echo '.grid-list-home-columns ul li h3 a,ul.portfolio-four h4 a, ul.portfolio-three h4 a, ul.portfolio-two h4 a, ul.portfolio-one h4 a { color:'.$content_titlelinks.'; }';
}

$content_titlehover=of_get_option('content_titlehover');
if ($content_titlehover) {
echo '.grid-list-home-columns ul li h3 a:hover,ul.portfolio-four h4 a:hover, ul.portfolio-three h4 a:hover, ul.portfolio-two h4 a:hover, ul.portfolio-one h4 a:hover { color:'.$content_titlehover.'; }';
}

$content_titles=of_get_option('content_titles');
if ($content_titles) {
echo '
.entry-content h1,
.entry-content h2,
.entry-content h3,
.entry-content h4,
.entry-content h5,
.entry-content h6,
.mcycletextwrap h3,
h2.ajax-projects-title,
.entry-post-title h2 a,
#contactform #contact label,
ul.tabs li a
{ color:'.$content_titles.'; }';
}

$content_text=of_get_option('content_text');
if ($content_text) {
echo '
.entry-content p,
.entry-content,
.postformat_quote,
.quote_author,
.news-text,
#recentposts_list p, #popularposts_list p,
.sidebar-widget,
.work-details p
{ color:'.$content_text.'; }';
}

$sidebar_title=of_get_option('sidebar_title');
if ($sidebar_title) {
echo '.sidebar h3 { color:'.$sidebar_title.'; }';
}


$blog_allowedtags=of_get_option('blog_allowedtags');
if ($blog_allowedtags) {
echo '.form-allowed-tags { display:none; }';
}

$footer_bgcolor=of_get_option('footer_bgcolor');
if ($footer_bgcolor) {
echo '.footer-container { background-color:'.$footer_bgcolor.'; }';
}

$footer_text=of_get_option('footer_text');
if ($footer_text) {
echo '#footer #recentposts_list p, #footer #popularposts_list p, .footer-widget ul li { color:'.$footer_text.'; }';
}

$footer_link=of_get_option('footer_link');
if ($footer_link) {
echo '#footer .description a, #footer .textwidget a, #footer .footer-widget ul a,#footer #popularposts_list .popularpost_info .popularpost_title, #footer #recentposts_list .recentpost_info .recentpost_title, .relatedtitle a { color:'.$footer_link.'; }';
}

$footer_linkhover=of_get_option('footer_linkhover');
if ($footer_linkhover) {
echo '#footer .description a:hover, #footer .textwidget a:hover, #footer .footer-widget ul a:hover, #footer #popularposts_list .popularpost_info .popularpost_title:hover, #footer #recentposts_list .recentpost_info .recentpost_title:hover, .relatedtitle a:hover { color:'.$footer_linkhover.'; }';
}

$footer_labeltext=of_get_option('footer_labeltext');
if ($footer_labeltext) {
echo '#footer h3 { color:'.$footer_labeltext.'; }';
}

$hline=of_get_option('footer_hline');
if ($hline) {
echo '#recentposts_list li, #popularposts_list li,.footer-widget ul li { border-bottom:1px solid '.$hline.'; }';
}

$footer_copyrightbg=of_get_option('footer_copyrightbg');
if ($footer_copyrightbg) {
echo '#copyright { background-color:'.$footer_copyrightbg.'; }';
}

$footer_copyrighttext=of_get_option('footer_copyrighttext');
if ($footer_copyrighttext) {
echo '#copyright { color:'.$footer_copyrighttext.'; }';
}

$submenu_hover=of_get_option('submenu_hover');
if ($submenu_hover) {
echo '.menu ul {left:auto;}';
}
// Postformat icons check
$postformat_icons=of_get_option('postformat_icons');
if (!$postformat_icons) {
echo '.postformat_icon { background-image:none; padding-left:0; }';
}
// Menu description Check
$menudesc_status=of_get_option('menudesc_status');
if (!$menudesc_status) {
echo '.homemenu ul li span {display:none;}';
}
?>