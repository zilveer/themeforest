<?php
	
	header("Content-type: text/css; charset: UTF-8");
	
	require_once('../../../../wp-load.php');
	
	$options = get_option('sf_supreme_options');
	
	// Standard Styling
	$accent_color = get_option('accent_color', '#10c4f7');
	$secondary_accent_color = get_option('secondary_accent_color', '#2e2e36');
	$secondary_accent_alt_color = get_option('secondary_accent_alt_color', '#ffffff');
	
	// Page Styling
	$page_bg_color = get_option('page_bg_color', '#FFFFFF');
	$inner_page_bg_color = get_option('inner_page_bg_color', '#f7f7f7');
	$body_bg_use_image = $options['use_bg_image'];	
	$body_upload_bg = $options['custom_bg_image'];
	$body_preset_bg = $options['preset_bg_image'];
	$section_divide_color = get_option('section_divide_color', '#e4e4e4');
	$alt_bg_color = get_option('alt_bg_color', '#FFFFFF');
	$bg_size = $options['bg_size'];
	
	// Header Styling	
	$topbar_bg_color = get_option('topbar_bg_color', '#000000');
	$topbar_text_color = get_option('topbar_text_color', '#ccc');
	$topbar_divider_color = get_option('topbar_divider_color', '#333333');
	$header_bg_color1 = get_option('header_bg_color1', '#fefefe');
	$header_bg_color2 = get_option('header_bg_color2', '#f7f7f7');
	$header_text_color = get_option('header_text_color', '#222222');
	$ticker_bg_color = get_option('ticker_bg_color', '#10c4f7');
	$ticker_text_color = get_option('ticker_text_color', '#232323');
	
	// Aux Area Styling	
	$aux_bg_color = get_option('aux_bg_color', '#e4e4e4');
	$aux_alt_bg_color = get_option('aux_alt_bg_color', '#eeeeee');
	$aux_text_color = get_option('aux_text_color', '#999999');
	$aux_link_color = get_option('aux_link_color', '#FFFFFF');
	
	// Navigation Styling
	$nav_bg_color = get_option('nav_bg_color', '#FFFFFF');
	$nav_text_color = get_option('nav_text_color', '#232323');
	$nav_text_hover_color = get_option('nav_text_hover_color', '#00aeef');
	$nav_selected_text_color = get_option('nav_selected_text_color', '#4a9cba');
	$nav_arrow_color = get_option('nav_arrow_color', '#45a5db');
	$nav_sm_bg_color = get_option('nav_sm_bg_color', '#FFFFFF');
	$nav_sm_text_color = get_option('nav_sm_text_color', '#8F8F8F');
	$nav_sm_text_hover_color = get_option('nav_sm_text_hover_color', '#3392DB');
	$nav_sm_selected_text_color = get_option('nav_sm_selected_text_color', '#4a9cba');
	$nav_divider = get_option('nav_divider', 'solid');
	$nav_divider_color = get_option('nav_divider_color', '#EEEEEE');
	
	// Page Heading Styling
	$breadcrumb_text_color = get_option('breadcrumb_text_color', '#999999');
	$breadcrumb_link_color = get_option('breadcrumb_link_color', '#999999');
	$page_heading_text_color = get_option('page_heading_text_color', '#222222');
	
	// Body Styling
	$body_text_color = get_option('body_color', '#222222');
	$link_text_color = get_option('link_color', '#333333');
	$h1_text_color = get_option('h1_color', '#222222');
	$h2_text_color = get_option('h2_color', '#222222');
	$h3_text_color = get_option('h3_color', '#222222');
	$h4_text_color = get_option('h4_color', '#222222');
	$h5_text_color = get_option('h5_color', '#222222');
	$h6_text_color = get_option('h6_color', '#222222');
	$impact_text_color = get_option('impact_text_color', '#222222');

	// Shortcode Stying
	$pt_primary_bg_color = get_option('pt_primary_bg_color', '#00AEEF');
	$pt_secondary_bg_color = get_option('pt_secondary_bg_color', '#B4E5F8');
	$pt_tertiary_bg_color = get_option('pt_tertiary_bg_color', '#E1F3FA');
	$lpt_primary_row_color = get_option('lpt_primary_row_color', '#f7f7f7');
	$lpt_secondary_row_color = get_option('lpt_secondary_row_color', '#eeeeee');
	$lpt_default_pricing_header = get_option('lpt_default_pricing_header', '#999999');
	$lpt_default_package_header = get_option('lpt_default_package_header', '#bbbbbb');
	$lpt_default_footer = get_option('lpt_default_footer', '#e4e4e4');
	$icon_container_bg_color = get_option('icon_container_bg_color', '#B4E5F8');
	$icon_color = get_option('sf_icon_color', '#000000');
	$tab_rollover_color = get_option('tab_rollover_color', '#EEEEEE');
	
	// Footer Styling
	$footer_bg_color1 = get_option('footer_bg_color1', '#FFFFFF');
	$footer_bg_color2 = get_option('footer_bg_color2', '#F7F7F7');
	$footer_text_color = get_option('footer_text_color', '#222222');
	$footer_link_color = get_option('footer_link_color', '#00aeef');
	$copyright_bg_color = get_option('copyright_bg_color', '#000000');
	$copyright_text_color = get_option('copyright_text_color', '#999999');
	
	// Logo Spacing
	$logo_width = $options['logo_width'];
	$logo_spacing_top = $options['logo_top_spacing'];
	$logo_spacing_right = $options['logo_right_spacing'];
	$logo_spacing_bottom = $options['logo_bottom_spacing'];
	$logo_spacing_left = $options['logo_left_spacing'];
		
	// Font
	$standard_font = $options['web_standard_font'];
	$heading_font = $options['web_heading_font'];
	$use_custom_font_one = $options['use_custom_font_one'];
	$custom_font_one = explode(':', $options['standard_font']);
	$use_custom_font_two = $options['use_custom_font_two'];
	$custom_font_two = explode(':', $options['heading_font']);
	$use_custom_font_impact = $options['use_custom_font_impact'];
	$custom_font_impact = explode(':', $options['impact_font']);
	$google_font_one = str_replace("+", " ", $custom_font_one[0]);
	$google_font_one_weight = 400;
	if ( isset($custom_font_one[1]) ) {
	$google_font_one_weight = $custom_font_one[1];
	}
	$google_font_two = str_replace("+", " ", $custom_font_two[0]);
	$google_font_two_weight = 400;
	if ( isset($google_font_two[1]) ) {
	$google_font_two_weight = $custom_font_two[1];
	}
	$google_font_impact = str_replace("+", " ", $custom_font_impact[0]);
	
	// Font Sizing
	$body_font_size = $options['body_font_size'];
	$body_font_line_height = $options['body_font_line_height'];
	$h1_font_size = $options['h1_font_size'];
	$h1_font_line_height = $options['h1_font_line_height'];
	$h2_font_size = $options['h2_font_size'];
	$h2_font_line_height = $options['h2_font_line_height'];
	$h3_font_size = $options['h3_font_size'];
	$h3_font_line_height = $options['h3_font_line_height'];
	$h4_font_size = $options['h4_font_size'];
	$h4_font_line_height = $options['h4_font_line_height'];
	$h5_font_size = $options['h5_font_size'];
	$h5_font_line_height = $options['h5_font_line_height'];
	$h6_font_size = $options['h6_font_size'];
	$h6_font_line_height = $options['h6_font_line_height'];
	
	// Custom CSS
	$custom_css = $options['custom_css'];

?>

/* Standard Styles
================================================== */

/*========== Custom Font Styles ==========*/

body, h6, #sidebar .widget-heading h3, #header-search input, .header-items h3.phone-number, .related-wrap h3, #comments-list > h3, .item-heading h1, .sf-button, button, input[type="submit"], input[type="email"], input[type="reset"], input[type="button"], .wpb_accordion_section h3, #header-login input, #mobile-navigation > div {
	font-family: "<?php echo $standard_font; ?>", Arial, Helvetica, Tahoma, sans-serif;
}
h1, h2, h3, h4, h5, .custom-caption p, span.dropcap1, span.dropcap2, span.dropcap3, span.dropcap4, .wpb_call_text, .impact-text, .testimonial-text, .header-advert {
	font-family: "<?php echo $heading_font; ?>", Arial, Helvetica, Tahoma, sans-serif;
}
body, p, li p, .masonry-items .blog-item .quote-excerpt, #commentform label, .contact-form label {
	font-size: <?php echo $body_font_size; ?>px;
	line-height: <?php echo $body_font_line_height; ?>px;
}
h1, .wpb_impact_text .wpb_call_text, .impact-text {
	font-size: <?php echo $h1_font_size; ?>px;
	line-height: <?php echo $h1_font_line_height; ?>px;
}
h2 {
	font-size: <?php echo $h2_font_size; ?>px;
	line-height: <?php echo $h2_font_line_height; ?>px;
}
h3 {
	font-size: <?php echo $h3_font_size; ?>px;
	line-height: <?php echo $h3_font_line_height; ?>px;
}
h4, .body-content.quote {
	font-size: <?php echo $h4_font_size; ?>px;
	line-height: <?php echo $h4_font_line_height; ?>px;
}
h5 {
	font-size: <?php echo $h5_font_size; ?>px;
	line-height: <?php echo $h5_font_line_height; ?>px;
}
h6 {
	font-size: <?php echo $h6_font_size; ?>px;
	line-height: <?php echo $h6_font_line_height; ?>px;
}


/*========== Main Color Styles ==========*/

::selection, ::-moz-selection {
	background-color: <?php echo $accent_color; ?>;	
}
.recent-post figure,
.wpb_box_text.coloured .box-content-wrap,
span.highlighted,
span.dropcap4,
.loved-item:hover .loved-count,
.flickr-widget li,
#header-language-flags .current-language,
.wpcf7 input.wpcf7-submit[type="submit"] {
	background-color: <?php echo $accent_color; ?>!important;
}
.sf-button.accent {
	background: none;
	background-image: none;
	background-color: <?php echo $accent_color; ?>!important;
}
a:hover,
#sidebar a:hover,
.pagination-wrap a:hover,
.carousel-nav a:hover,
.jcarousel-prev:hover,
.jcarousel-next:hover,
.portfolio-pagination div:hover > i,
.read-more,
#menubar-controls a.active,
#footer a:hover,
#footer .twitter-text a,
#footer .twitter-link a,
#copyright a,
.beam-me-up a:hover span,
.portfolio-item .portfolio-item-permalink,
.read-more-link,
.blog-item .read-more,
.blog-item-details a,
.author-link,
.comment-meta .edit-link a,
.comment-meta .comment-reply a,
.tags-wrap a,
#reply-title small a,
ul.member-contact, ul.member-contact li a,
#respond .form-submit input:hover,
.tm-toggle-button-wrap a,
span.dropcap2,
ul.tabs li.ui-state-default a:hover,
.accordion .accordion-header:hover,
.wpb_accordion .accordion-header:hover a,
.wpb_accordion .ui-accordion-header:hover a,
.wpb_accordion .ui-accordion-header:hover .ui-icon,
.wpb_divider.go_to_top a,
love-it-wrapper:hover .love-it,
.love-it-wrapper:hover span,
.love-it-wrapper .loved,
.comments-likes a:hover i,
.comments-likes .love-it-wrapper:hover a i,
.comments-likes a:hover span,
.love-it-wrapper:hover a i,
.item-link,
#header-translation p a,
#posts-slider .flex-caption-large h1 a:hover,
.twitter-link a,
.wooslider .slide-title a:hover {
	color: <?php echo $accent_color; ?>;
}
.read-more i:before,
.read-more em:before,
.sidebar a:not(.sf-button) {
	color: <?php echo $accent_color; ?>;
}
.bypostauthor .comment-wrap .comment-avatar,
.search-form input:focus,
.wpcf7 input[type="text"]:focus,
.wpcf7 textarea:focus {
	border-color: <?php echo $accent_color; ?>!important;
}
#nav-section,
#mini-header,
nav .menu ul {
	border-top-color: <?php echo $accent_color; ?>;
}
nav .menu ul li:first-child:after,
.navigation a:hover > .nav-text {
	border-bottom-color: <?php echo $accent_color; ?>;
}
nav .menu ul ul li:first-child:after {
	border-right-color: <?php echo $accent_color; ?>;
}
.wpb_impact_text .wpb_button span {
	color: #fff;
}
article.type-post #respond .form-submit input#submit {
	background-color: <?php echo $secondary_accent_color; ?>;
}

/*========== Main Styles ==========*/

::selection, ::-moz-selection {
	color: #fff;
}
body {
	color: <?php echo $body_text_color; ?>;
}
.carousel-nav a, .pagination-wrap a, .search-pagination a {
	color: <?php echo $body_text_color; ?>;
}
<?php if ($body_bg_use_image) { ?>
	<?php if ($body_upload_bg) { ?>
	body {
		background: <?php echo $page_bg_color; ?> url(<?php echo $body_upload_bg; ?>) repeat center top fixed;
	}
	<?php } else { ?>
	body {
		background: <?php echo $page_bg_color; ?> url(<?php echo $body_preset_bg; ?>) repeat center top fixed;
	}
	<?php } ?>
	body {
		background-size: <?php echo $bg_size; ?>;
	}	
<?php } else { ?>
body {
	background: <?php echo $page_bg_color; ?>;
}
<?php } ?>
#main-container, .tm-toggle-button-wrap a {
	background-color: <?php echo $inner_page_bg_color; ?>;
}
a {
	color: <?php echo $link_text_color; ?>;
}
.pagination-wrap li span.current, .pagination-wrap li a:hover {
	color: <?php echo $secondary_accent_alt_color ?>;
	background-color: <?php echo $secondary_accent_color; ?>;
}
.pagination-wrap li a {
	color: #232323;
	background-color: #dbdbdb;
}
input[type="text"], input[type="password"], input[type="email"], textarea, select {
	border-color: <?php echo $section_divide_color; ?>;
	background: <?php echo $alt_bg_color; ?>;
}

/*========== Header Styles ==========*/

#top-bar-date {
	border-right-color: <?php echo $topbar_divider_color; ?>;
}
#top-bar {
	background: <?php echo $topbar_bg_color; ?>;
}
#top-bar .menu li {
	border-left-color: <?php echo $topbar_divider_color; ?>;
}
#top-bar-date, #top-bar .menu > li > a {
	color: <?php echo $topbar_text_color; ?>;
}
#header-section {
	background-color: <?php echo $header_bg_color1; ?>;
	background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(<?php echo $header_bg_color2; ?>), to(<?php echo $header_bg_color1; ?>));
	background: -webkit-linear-gradient(top, <?php echo $header_bg_color1; ?>, <?php echo $header_bg_color2; ?>);
	background: -moz-linear-gradient(top, <?php echo $header_bg_color1; ?>, <?php echo $header_bg_color2; ?>);
	background: -ms-linear-gradient(top, <?php echo $header_bg_color1; ?>, <?php echo $header_bg_color2; ?>);
	background: -o-linear-gradient(top, <?php echo $header_bg_color1; ?>, <?php echo $header_bg_color2; ?>);
}
#logo img {
	padding-top: <?php echo $logo_spacing_top; ?>px;
	padding-right: <?php echo $logo_spacing_right; ?>px;
	padding-bottom: <?php echo $logo_spacing_bottom; ?>px;
	padding-left: <?php echo $logo_spacing_left; ?>px;
}
<?php if ($logo_width > 0) { ?>
#logo img {
	max-width: <?php echo $logo_width; ?>px;
}
<?php } ?>
.header-advert {
	color: <?php echo $header_text_color; ?>;
}
.page-content {
	border-bottom-color: <?php echo $section_divide_color; ?>;
}

/*========== Aux Area Styles ==========*/

#aux-area, #header-search, #header-subscribe, #header-translation, #header-login {
	background: <?php echo $aux_bg_color; ?>;
}
#menubar-controls .control-item.selected-item:before {
	border-top-color: <?php echo $aux_bg_color; ?>;
}
.nav-accent-bar #menubar-controls .control-item.selected-item:before {
	border-top-color: <?php echo $accent_color; ?>;
}
#header-login #username {
	background: <?php echo $aux_alt_bg_color; ?>;
}
#header-search ::-webkit-input-placeholder {
	color: <?php echo $aux_text_color; ?>;
}
#header-search ::-moz-input-placeholder {
	color: <?php echo $aux_text_color; ?>;
}
#header-subscribe ::-webkit-input-placeholder {
	color: <?php echo $aux_text_color; ?>;
}
#header-subscribe ::-moz-input-placeholder {
	color: <?php echo $aux_text_color; ?>;
}
#header-subscribe input, #header-search input, #header-login input, #header-login span, #header-translation p {
	color: <?php echo $aux_text_color; ?>!important;
}
#header-login .logout-link, #header-login .admin-link, #header-login .recover-password {
	color: <?php echo $aux_link_color; ?>;
}


/*========== Navigation Styles ==========*/

#nav-pointer {
	border-bottom-color: <?php echo $nav_arrow_color; ?>;
}
nav .menu > li:before {
	background: <?php echo $nav_arrow_color; ?>;
}
nav .menu .sub-menu .parent > a:after {
	border-left-color: <?php echo $nav_arrow_color; ?>;
}
#nav-section, #mini-header {
	background-color: <?php echo $nav_bg_color; ?>;
}
nav .menu ul {
	background-color: <?php echo $nav_sm_bg_color; ?>;
	border-color: <?php echo $nav_divider_color; ?>;
}
nav .menu ul li {
	border-bottom-color: <?php echo $nav_divider_color; ?>;
	border-bottom-style: <?php echo $nav_divider; ?>;
}
nav .menu > li a, #menubar-controls a, #mini-search a {
	color: <?php echo $nav_text_color; ?>;
}
nav .menu > li a:hover {
	color: <?php echo $nav_text_hover_color; ?>;
}
nav .menu ul li a {
	color: <?php echo $nav_sm_text_color; ?>;
}
nav .menu ul li:hover > a {
	color: <?php echo $nav_sm_text_hover_color; ?>;
}
nav .menu li.parent > a:after, nav .menu li.parent > a:after:hover {
	color: #aaa;
}
nav .menu li.current-menu-ancestor > a, nav .menu li.current-menu-item > a {
	color: <?php echo $nav_selected_text_color; ?>;
}
nav .menu ul li.current-menu-ancestor > a, nav .menu ul li.current-menu-item > a {
	color: <?php echo $nav_sm_selected_text_color; ?>;
}
#mini-search input {
	color: <?php echo $nav_text_color; ?>;
}

/*========== Page Heading Styles ==========*/

.heading-divider {
	background: <?php echo $accent_color; ?>;
}
.page-heading h1 {
	color: <?php echo $page_heading_text_color; ?>!important;
	border-bottom-color: <?php echo $secondary_accent_color; ?>;
}
#breadcrumbs {
	color: <?php echo $breadcrumb_text_color; ?>;
}
#breadcrumbs a, #breadcrumb i {
	color: <?php echo $breadcrumb_link_color; ?>;
}

/*========== Body Styles ==========*/

body, input[type="text"], input[type="password"], input[type="email"], textarea, select {
	color: <?php echo $body_text_color; ?>;
}
h1, h1 a {
	color: <?php echo $h1_text_color; ?>;
}
h2, h2 a {
	color: <?php echo $h2_text_color; ?>;
}
h3, h3 a {
	color: <?php echo $h3_text_color; ?>;
}
h4, h4 a {
	color: <?php echo $h4_text_color; ?>;
}
h5, h5 a {
	color: <?php echo $h5_text_color; ?>;
}
h6, h6 a {
	color: <?php echo $h6_text_color; ?>;
}
.wpb_impact_text .wpb_call_text, .impact-text {
	color: <?php echo $impact_text_color; ?>;
}
.read-more i, .read-more em {
	color: transparent;
}


/*========== Content Styles ==========*/

h3.wpb_heading span, .carousel-nav {
	background: <?php echo $inner_page_bg_color; ?>;
}
.pb-border-bottom, .pb-border-top {
	border-color: <?php echo $section_divide_color; ?>;
}
.flexslider ul.slides {
	background: <?php echo $inner_page_bg_color; ?>;
}
#posts-slider ul.slides {
	background: <?php echo $secondary_accent_color; ?>;
}
#posts-slider .flex-caption-large, #posts-slider .flex-caption-large h1 a {
	color: <?php echo $secondary_accent_alt_color ?>;
}
#posts-slider .flex-caption-large .comments-likes > div {
	color: <?php echo $secondary_accent_color; ?>;
	background: <?php echo $accent_color; ?>;
}
#posts-slider .flex-caption-large .comments-likes .comment-circle a:hover {
	color: <?php echo $secondary_accent_color; ?>;
}
#posts-slider .flex-caption-large .comments-likes span.loved, #posts-slider .flex-caption-large .comments-likes .love-it-wrapper:hover span {
	color: <?php echo $secondary_accent_color; ?>;
}

/*========== Sidebar Styles ==========*/

.sidebar .widget-heading h3 {
	color: <?php echo $h3_text_color; ?>;
}
.sidebar .widget-heading h3 span {
	background: <?php echo $inner_page_bg_color; ?>;
}
.widget ul li {
	border-color: <?php echo $section_divide_color; ?>;
}
.widget .tagcloud a:hover {
	color: <?php echo $body_text_color; ?>;
}
ul.wp-tag-cloud li > a {
	color: <?php echo $secondary_accent_alt_color ?>!important;
	background: <?php echo $secondary_accent_color; ?>;
}
.wp-tag-cloud li a:before {
	border-right-color: <?php echo $secondary_accent_color; ?>;
}
ul.wp-tag-cloud li > a:hover {
	color: <?php echo $body_text_color; ?>!important;
	background: <?php echo $accent_color; ?>;
}
.wp-tag-cloud li a:hover:before {
	border-right-color: <?php echo $accent_color; ?>;
}
.loved-item .loved-count {
	color: <?php echo $secondary_accent_alt_color ?>;
	background: <?php echo $secondary_accent_color; ?>;
}
.twitter-link {
	background: <?php echo $secondary_accent_color; ?>;
}
.twitter-link > a > span {
	color: <?php echo $secondary_accent_alt_color ?>;
}
.subscribers-list li > a.social-circle {
	color: <?php echo $secondary_accent_alt_color ?>;
	background: <?php echo $secondary_accent_color; ?>;
}
.subscribers-list li:hover > a.social-circle {
	color: #fbfbfb;
	background: <?php echo $accent_color; ?>;
}
.sidebar .widget_categories ul > li a, .sidebar .widget_archive ul > li a, .sidebar .widget_nav_menu ul > li a, .sidebar .widget_meta ul > li a, .sidebar .widget_login ul > li a, .sidebar .widget_recent_products ul > li a, .sidebar .widget_shopping_cart ul > li a {
	color: #222;
}
.sidebar .widget_categories ul > li a:hover, .sidebar .widget_archive ul > li a:hover, .sidebar .widget_nav_menu ul > li a:hover, .widget_nav_menu ul > li.current-menu-item a, .sidebar .widget_meta ul > li a:hover, .sidebar .widget_login ul > li a:hover, .sidebar .widget_recent_products ul > li a:hover, .sidebar .widget_shopping_cart ul > li a:hover {
	color: <?php echo $secondary_accent_alt_color ?>;
	background: <?php echo $secondary_accent_color; ?>;
}
#calendar_wrap caption {
	border-bottom-color: <?php echo $secondary_accent_color; ?>;
}
.sidebar .widget_calendar tbody tr > td a {
	color: <?php echo $secondary_accent_alt_color ?>;
	background-color: <?php echo $secondary_accent_color; ?>;
}
.sidebar .widget_calendar tbody tr > td a:hover {
	background-color: <?php echo $accent_color; ?>;
}
.sidebar .widget_calendar tfoot a {
	color: <?php echo $secondary_accent_color; ?>;
}
.sidebar .widget_calendar tfoot a:hover {
	color: <?php echo $accent_color; ?>;
}
.widget_sf_infocus_widget .infocus-item h5 a {
	color: <?php echo $secondary_accent_color; ?>;
}
.widget_sf_infocus_widget .infocus-item h5 a:hover {
	color: <?php echo $accent_color; ?>;
}
.sidebar .widget_shopping_cart .buttons a {
	color: #5e5e5e;
}


/*========== Portfolio Styles ==========*/

.filter-wrap ul li.selected a {
	color: <?php echo $secondary_accent_alt_color ?>;
	background: <?php echo $secondary_accent_color; ?>;
}
.portfolio-item {
	border-bottom-color: <?php echo $section_divide_color; ?>;
}
.masonry-items .portfolio-item-details {
	border-color: <?php echo $section_divide_color; ?>;
	background: <?php echo $alt_bg_color; ?>;
}
.masonry-items .blog-item .blog-details-wrap:before {
	background-color: <?php echo $alt_bg_color; ?>;
}
.masonry-items .portfolio-item figure {
	border-color: <?php echo $section_divide_color; ?>;
}
.portfolio-details-wrap span span {
	color: #666;
}
.portfolio-item figure .overlay {
	box-shadow: inset 0 0 0 0 <?php echo $accent_color; ?>;
	color: #fff;
}
.browser-ie .portfolio-item figure .overlay {
	background-color: <?php echo $accent_color; ?>;
}
.thumb-info h2 {
	color: #fff;
}
.portfolio-item figure:hover .overlay {
    box-shadow: inset 0 0 0 200px <?php echo $accent_color; ?>;
}
.portfolio-item.eight figure:hover .overlay {
    box-shadow: inset 0 0 0 240px <?php echo $accent_color; ?>;
}
.portfolio-item.one-col figure:hover .overlay {
    box-shadow: inset 0 0 0 480px <?php echo $accent_color; ?>;
}

/*========== Blog Styles ==========*/

.blog-item {
	border-color: <?php echo $section_divide_color; ?>;
}
a.cat-item {
	background: #ccc;
	color: #fff;
}
.blog-item figure .overlay {
	box-shadow: inset 0 0 0 200px <?php echo $accent_color; ?>;
	color: #fff;
}
.browser-ie .blog-item figure .overlay {
	background-color: <?php echo $accent_color; ?>;
}
.blog-item h2 {
	color: #222;
	border-color: <?php echo $section_divide_color; ?>;
}
.masonry-items .blog-item {
	border-color: <?php echo $section_divide_color; ?>;
	background: <?php echo $alt_bg_color; ?>;
}
.blog-item .spacer, .mini-items .blog-item-details, .author-info-wrap, .related-wrap, .tags-link-wrap, .comment .comment-wrap, .share-links, .single-portfolio .share-links, .single .pagination-wrap {
	border-color: <?php echo $section_divide_color; ?>;
}
.related-item figure {
	background-color: <?php echo $secondary_accent_color; ?>;
}
.required {
	color: #ee3c59;
}
article.type-post #respond .form-submit input#submit {
	color: #fff;
}
#respond {
	background: #f1f1f1;	
}
#respond .form-submit input:hover {
	color: #ccc!important;
}
.author-info-wrap .cl-circles > div {
	color: <?php echo $accent_color; ?>;
	background: <?php echo $section_divide_color; ?>;
}
.author-info-wrap .cl-circles > div:hover {
	color: <?php echo $accent_color; ?>;
	background: <?php echo $secondary_accent_color; ?>;
}
.author-info-wrap .cl-circles .comment-circle > span > a, .author-info-wrap .cl-circles .love-it-wrapper > a, .author-info-wrap .cl-circles .love-it-wrapper > a > i {
	color: <?php echo $accent_color; ?>;
}
.article-review-wrap {
	border-top-color: <?php echo $section_divide_color; ?>;
}
.review-bar {
	background: <?php echo $section_divide_color; ?>;
}
.review-bar .bar {
	background-color: <?php echo $secondary_accent_color; ?>;
	color: <?php echo $secondary_accent_alt_color; ?>;
}
.review-overview-wrap .overview-circle {
	background-color: <?php echo $secondary_accent_color; ?>;
	color: <?php echo $secondary_accent_alt_color; ?>;
}
.comments-likes a i, .comments-likes a span, .comments-likes .love-it-wrapper a i {
	color: <?php echo $body_text_color; ?>;
}
.recent-post figure .overlay, .related-item figure .overlay {
	box-shadow: inset 0 0 0 130px <?php echo $accent_color; ?>;
	color: #fff;
}
.browser-ie .recent-post figure .overlay, .browser-ie .related-item figure .overlay {
	background-color: <?php echo $accent_color; ?>;
}
.recent-post figure .overlay span.loved, .recent-post figure .overlay span.loved i, .recent-post figure .overlay:hover span.loved i, .recent-post figure .overlay:hover span.loved span {
	color: #222!important;
}
#respond .form-submit input:hover {
	color: #fff!important;
}
.recent-post .thumb-info a:hover {
	color: #222;
}

/*========== Self Hosted Media Styles ==========*/

div.jp-interface, div.jp-video div.jp-interface {
	background: #111;
}
.jp-controls a, .jp-toggles a {
	color: #fff;
}


/*========== Shortcode Styles ==========*/

.sf-button.accent {
	color: #fff;
}
a.sf-button:hover, #footer a.sf-button:hover {
	background-image: none;
	color: #fff!important;
}
a.sf-button.green:hover, a.sf-button.lightgrey:hover, a.sf-button.limegreen:hover {
	color: #111!important;
}
.wpcf7 input.wpcf7-submit[type="submit"] {
	color: #fff;
}
.wpb_single_image figure .overlay, .infocus-item figure .overlay {
	box-shadow: inset 0 0 0 380px <?php echo $accent_color; ?>;
	color: #fff;
}
.browser-ie .wpb_single_image figure .overlay {
	background-color: <?php echo $accent_color; ?>;
}
.sf-icon {
	color: <?php echo $icon_color; ?>;
}
.sf-icon-cont {
	background-color: <?php echo $icon_container_bg_color; ?>;
}
span.dropcap3 {
	background: #000;
	color: #fff;
}
span.dropcap4 {
	color: #fff;
}
ul.tabs li.ui-state-active a:hover, .accordion .accordion-header.ui-state-active:hover {
	color: #222;
}
.minimal .wpb_accordion_section, .minimal .wpb_accordion_section:first-child, .wpb_accordion.standard .wpb_accordion_section, .wpb_accordion.standard .wpb_accordion_section h3.ui-state-active {
	border-color: <?php echo $section_divide_color; ?>;
}
.wpb_divider, .wpb_divider.go_to_top_icon1, .wpb_divider.go_to_top_icon2, .testimonials > li, .jobs > li, .wpb_impact_text, .tm-toggle-button-wrap, .tm-toggle-button-wrap a, .portfolio-details-wrap, .wpb_divider.go_to_top a {
	border-color: <?php echo $section_divide_color; ?>;
}
.wpb_divider.go_to_top_icon1 a, .wpb_divider.go_to_top_icon2 a {
	background: <?php echo $inner_page_bg_color; ?>;
}
.wpb_tabs .ui-state-default:hover {
	background: <?php echo $tab_rollover_color; ?>;
}
.wpb_tabs.minimal .ui-state-active, .wpb_tabs.minimal .ui-state-active:hover, .wpb_tabs.left_minimal .ui-state-active, .wpb_tabs.left_minimal .ui-state-active:hover, .wpb_content_element .ui-widget-header .ui-state-active {
	background: <?php echo $inner_page_bg_color; ?>;
}
.ui-tabs .ui-tabs-nav li.ui-tabs-active a, .wpb_accordion .wpb_accordion_section > h3.ui-state-active a {
	color: <?php echo $secondary_accent_alt_color ?>;
	background-color: <?php echo $secondary_accent_color; ?>;
}
.ui-accordion .ui-accordion-header.ui-state-active .ui-icon {
	color: <?php echo $secondary_accent_alt_color ?>;
}
.wpb_accordion wpb_accordion_section > h3:hover a {
	color: <?php echo $accent_color; ?>;
}
blockquote.pullquote {
	border-color: <?php echo $section_divide_color; ?>;
}
.borderframe img {
	border-color: #eeeeee;
}
.labelled-pricing-table .column-highlight {
	background-color: #fff;
	-moz-box-shadow: 0 0 5px rgba(0,0,0,.1);
	-webkit-box-shadow: 0 0 5px rgba(0,0,0,.1);
	box-shadow: 0 0 5px rgba(0,0,0,.1);
}
.labelled-pricing-table .pricing-table-label-row, .labelled-pricing-table .pricing-table-row {
	background: <?php echo $lpt_secondary_row_color; ?>;
}
.labelled-pricing-table .alt-row {
	background: <?php echo $lpt_primary_row_color; ?>;
}
.labelled-pricing-table .pricing-table-price {
	background: <?php echo $lpt_default_pricing_header; ?>;
}
.labelled-pricing-table .pricing-table-package {
	background: <?php echo $lpt_default_package_header; ?>;
}
.labelled-pricing-table .lpt-button-wrap {
	background: <?php echo $lpt_default_footer; ?>;
}
.labelled-pricing-table .lpt-button-wrap a.accent {
	background: #222!important;
}
.labelled-pricing-table .column-highlight .lpt-button-wrap {
	background: transparent!important;	
}
.labelled-pricing-table .column-highlight .lpt-button-wrap a.accent {
	background: <?php echo $accent_color; ?>!important;
}
.column-highlight .pricing-table-price {
	color: #fff;
	background: <?php echo $pt_primary_bg_color; ?>;
	border-bottom-color: <?php echo $pt_primary_bg_color; ?>;
}
.column-highlight .pricing-table-package {
	background: <?php echo $pt_secondary_bg_color; ?>;
}
.column-highlight .pricing-table-details {
	background: <?php echo $pt_tertiary_bg_color; ?>;
}
.column-highlight .pricing-table-package {
	background-color: #b4e5f8;
}
.column-highlight .pricing-table-details {
	background-color: #e1f3fa;
}
.decorative-ampersand {
	font-family: 'Vidaloka', serif;
}
.wpb_box_text.coloured .box-content-wrap {
	color: #fff;
}
.wpb_box_text.whitestroke .box-content-wrap {
	background-color: #fff;
	border-color: <?php echo $section_divide_color; ?>;
}
.client-item figure {
	border-color: <?php echo $section_divide_color; ?>;
}
.client-item figure:hover {
	border-color: #333;
}
ul.member-contact li a:hover {
	color: #333;
}
#ticker-wrap {
	background-color: <?php echo $ticker_bg_color; ?>!important;
}
#ticker-wrap, #ticker-wrap a {
	color: <?php echo $ticker_text_color; ?>;
}

/*========== Footer Styles ==========*/

#footer {
	background-color: <?php echo $footer_bg_color1; ?>;
	background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(<?php echo $footer_bg_color2; ?>), to(<?php echo $footer_bg_color1; ?>));
	background: -webkit-linear-gradient(top, <?php echo $footer_bg_color1; ?>, <?php echo $footer_bg_color2; ?>);
	background: -moz-linear-gradient(top, <?php echo $footer_bg_color1; ?>, <?php echo $footer_bg_color2; ?>);
	background: -ms-linear-gradient(top, <?php echo $footer_bg_color1; ?>, <?php echo $footer_bg_color2; ?>);
	background: -o-linear-gradient(top, <?php echo $footer_bg_color1; ?>, <?php echo $footer_bg_color2; ?>);
	border-top-color: <?php echo $section_divide_color; ?>;
}
#footer, #footer h3, #footer p {
	color: <?php echo $footer_text_color; ?>;
}
#footer a:not(.sf-button) {
	color: <?php echo $accent_color; ?>;
}
#footer .twitter-text a:hover {
	color: <?php echo $accent_color; ?>;
}
#copyright {
	background-color: <?php echo $copyright_bg_color; ?>;
}
#copyright p {
	color: <?php echo $copyright_text_color; ?>;
}


/*========== WooCommerce Styles ==========*/

.woocommerce-account p.myaccount_address, .woocommerce-account .page-content h2 {
	border-bottom-color: <?php echo $section_divide_color; ?>;
}
.woocommerce-page #respond .form-submit input:hover, ul.products li.product a:hover, .woocommerce_message a:hover {
	color: #333!important;
}
.woocommerce-page .button:hover {
	border-width: 1px;
}
.woocommerce-page input.button:hover {
	border-width: 0
}

/* Custom Styles
================================================== */

<?php if ($use_custom_font_one) { ?>body, h6, #sidebar .widget-heading h3, #header-search input, .header-items h3.phone-number, .related-wrap h3, #comments-list > h3, .item-heading h1, .sf-button, button, input[type="submit"], input[type="reset"], input[type="button"], input[type="email"], .wpb_accordion_section h3, #header-login input, #mobile-navigation > div {
	font-family: '<?php echo $google_font_one; ?>', sans-serif;
	font-weight: <?php echo $google_font_one_weight; ?>;
}<?php } ?>
<?php if ($use_custom_font_two) { ?>h1, h2, h3, h4, h5, .heading-font, .custom-caption p, span.dropcap1, span.dropcap2, span.dropcap3, span.dropcap4, .wpb_call_text, .impact-text, .testimonial-text, .header-advert {font-family: '<?php echo $google_font_two; ?>', sans-serif;}<?php } ?>
<?php if ($use_custom_font_impact) { ?>.wpb_call_text, .impact-text {
	font-family: '<?php echo $google_font_impact; ?>', sans-serif;
	font-weight: <?php echo $google_font_two_weight; ?>;
}<?php } ?>



/* User Specific Styles
================================================== */
<?php if ($custom_css) { ?><?php echo $custom_css; ?><?php } ?>