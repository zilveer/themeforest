<?php 
// Prevent loading this file directly
if ( ! defined( 'ABSPATH' ) ) { exit; }

//////////////////////////////////////////////////////////////////
// Customizer - Add CSS
//////////////////////////////////////////////////////////////////
function gorilla_custom_css_func() {

	global $data;

	$data = array();

	if(get_theme_mod( 'gorilla_upload_body_bg_image' )) {
		$data[] = "body {
			background-image: url(".get_theme_mod( 'gorilla_upload_body_bg_image' ).");
			background-position: center center;
			background-repeat: no-repeat;
			background-size: cover;
		}";
	}

	if(get_theme_mod( 'gorilla_body_bg_attachment' )) {
		$data[] = "body {
			background-attachment: ".get_theme_mod( 'gorilla_body_bg_attachment' ).";
		}";
	}

	if(get_theme_mod( 'gorilla_body_bg_color' )) {
		$data[] = "body {
			background-color:".get_theme_mod('gorilla_body_bg_color').";
		}";
	}

	if(get_theme_mod( 'gorilla_body_bg_repeat' ) == "repeat") {
		$data[] = "body {
			background-repeat:".get_theme_mod( 'gorilla_body_bg_repeat' ).";
			background-size: inherit;
		}";
	}

	// Accent Color Styles

	if(get_theme_mod( 'gorilla_color_accent' )) {
		$data[] = ".widget a:hover, .footer .widget a:hover,
				   a, .nav-menu li.current_page_item > a, .nav-menu li.current_page_ancestor > a, .nav-menu li.current-menu-item > a, #footer-copyright p i,
				   .widget .about-widget .widget-link:hover,
				   .post-tags a:hover,
				   .like-comment-buttons a:hover,
				   .widget .about-widget .widget-link:hover:after,
				   .about-widget a:not(.widget-link), .widget_text a, #right-side-area .about-widget a:not(.widget-link),  #right-side-area  .widget_text a,
				   .comment-item .comment-text em,
				   .footer .widget.gorilla_recent_post_with_thumbs_widget .recent_post_text a:hover,
				   .footer a:hover, .footer .recentcomments a:hover, #footer-widget-area .widget .about-widget .widget-link:hover,
				   .post-list.full .like-comment-buttons-wrapper .like-comment-buttons a:hover,
				   .single .like-comment-buttons-wrapper .like-comment-buttons a:hover, .page-introduce-title .search-query,
				   .nav-menu ul a:hover,
				   .nav-menu ul ul a:hover,
				   .nav-menu > li > a:hover,
				   .nav-menu > li:hover > a {
			color: ".get_theme_mod( 'gorilla_color_accent' )."; 
		}

			.share-box:hover,.post:hover .share-box:hover,
			.widget .tagcloud a:hover,#footer-widget-area .widget .tagcloud a:hover,
			.widget-social-links a:hover > span, #footer-widget-area .widget-social-links a:hover > span ,
			.author-content .author-social:hover, #respond #submit:hover,
			.mejs-controls .mejs-time-rail .mejs-time-current,
			.btn:hover, .light .btn:hover, .dark .btn:hover, .goto-top,
			.featured-area[data-slider-type='slider'] .slider-item .format-icon,
			.widget ul.side-newsfeed li .side-item .side-image a .format-icon,
			button[type='submit'], input[type='submit'],
			.wpcf7 .wpcf7-submit, #sidebar .widget.widget_latest_tweets_widget .widget-title,
			.archive-title-area .format-icon, .featured
		{ 
			background-color:".get_theme_mod( 'gorilla_color_accent' )."; 
		}";
	}

	if(get_theme_mod( 'gorilla_header_padding' )) {
		$data[] = "#main-top-wrapper { padding:".get_theme_mod( 'gorilla_header_padding' )."px 0; }";
	}
	
	if(get_theme_mod( 'gorilla_topbar_bg' )) {
		$data[] = ".main-navigation-wrapper { background:".get_theme_mod( 'gorilla_topbar_bg' )."; }";
	}

	// Color Settings
	if(get_theme_mod( 'gorilla_topbar_nav_color' )) {
		$data[] = ".nav-menu > li > a,.top-search-area a,.main-navigation-wrapper.sticky .right-side-menu, .slicknav_menu .slicknav_icon-bar, #top-social-items a { 
			color:".get_theme_mod( 'gorilla_topbar_nav_color' )."; 

		}";
	}

	if(get_theme_mod( 'gorilla_topbar_nav_color_active' )) {
		$data[] = ".nav-menu > li > a:hover, .nav-menu > li:hover > a,.main-navigation-wrapper.sticky .right-side-menu:hover, 
		.nav-menu li.current_page_item > a, .nav-menu li.current_page_ancestor > a, .nav-menu li.current-menu-item > a {  
			color:".get_theme_mod( 'gorilla_topbar_nav_color_active' )."; 
		}";
	}

	if(get_theme_mod( 'gorilla_drop_bg' )) {
		$data[] = ".nav-menu .sub-menu, .nav-menu .children { 
			background-color:".get_theme_mod( 'gorilla_drop_bg' )."; 

		}";
	}

	if(get_theme_mod( 'gorilla_drop_border' )) {
		$data[] = ".nav-menu .sub-menu a { 
			border-bottom-color:".get_theme_mod( 'gorilla_drop_border' ).";
		}";
	}

	if(get_theme_mod( 'gorilla_drop_text_color' )) {
		$data[] = ".nav-menu .sub-menu a { 
			color:".get_theme_mod( 'gorilla_drop_text_color' )."; 
		}";
	}

	if(get_theme_mod( 'gorilla_drop_text_hover_color' )) {
		$data[] = ".nav-menu ul a:hover, .nav-menu ul ul a:hover { 
			color: ".get_theme_mod( 'gorilla_drop_text_hover_color' ).";
		}";
	}

	if(get_theme_mod( 'gorilla_text_color' )) {
		$data[] = "body,.like-comment-buttons a,.post-tags a,
		.widget li, .widget a,
		button, input, select, textarea
			color: ".get_theme_mod( 'gorilla_text_color' ).";
		}";
	}

	if(get_theme_mod( 'gorilla_headings_color' )) {
		$data[] = "h1, h2, h3, h4, h5, h6,.post-header h1 a, .post-header h2 a, .post-header h1, .post-header h2,
		.widget ul.side-newsfeed li .side-item .side-item-text h4 a, .masonry-layout .post-item .item h2 a, .related-posts .item h3 a, .featured-posts h4 a,
		.featured-posts-container h3 span, .list-layout .post-header h2 a { 
			color: ".get_theme_mod( 'gorilla_headings_color' ).";
		}";
	}

	if(get_theme_mod( 'gorilla_layout_text_color' )) {
		$data[] = ".layout-title .layout-text,.layout-title h3,.layout-title .sub-title {
			color:".get_theme_mod( 'gorilla_layout_text_color' )."; 
		} 
		.layout-title .layout-text { opacity:.9;}";
	}


	//Fonts Management
	$is_available_body = get_theme_mod("gorilla_content_font", "0");
	if($is_available_body != "0") {
		$data[] = "body,blockquote p ,.btn,.post.sticky .featured,.post-header .cat,
		.post-header .date-author,.format-quote .post-entry blockquote cite,.like-comment-buttons a,
		.post-tags a,.pagination a, #respond h3 small a, .nav-menu.footer  > li > a,
		.post-entry-bottom a.custom-more-link,.widget .about-widget .widget-link,
		#respond #submit, .side-item .side-image .side-item-category-inner, .widget .tagcloud a,
		.post-featured-item .custom-caption, .fotorama .fotorama__caption__wrap,#respond label,
		#footer-copyright p {
			font-family: '".gorilla_get_font_family(get_theme_mod("gorilla_content_font")) ."'; 
		}";
	}

	//Fonts Management
	$is_available_heading = get_theme_mod("gorilla_headings_font", "0");
	if($is_available_heading != "0") {
		$data[] = "h1,h2,h3,h4,h5,h6, #right-side-area .widget-title, .featured-area[data-slider-type='carousel'] .carousel-item h2,
				.featured-area[data-slider-type='carousel'] .carousel-item h2 a,
				.featured-area[data-slider-type='slider'] .slider-item h2, .featured-area[data-slider-type='slider'] .slider-item h2 a,
				 #alternate-widget-area .rotatingtweet p.rtw_main,.post-header h1 a, .post-header h2 a, .post-header h1, .post-header h2,
				.format-link .post-entry a, .format-quote .post-entry blockquote p, .author-content h5 a, .box-title-area .title,
				.widget-title, .rotatingtweet p.rtw_main, .comment-item .comment-text span.author, .comment-item .comment-text span.author a, .widget p.tweet-text,  .widget.gorilla_recent_post_with_thumbs_widget .recent_post_text a {
			font-family: '".gorilla_get_font_family(get_theme_mod("gorilla_headings_font")) ."'; 
		}";
	}

	//Fonts Management
	$is_available_navigation = get_theme_mod("gorilla_navigation_font","0");
	if($is_available_navigation != "0") {
		$data[] = ".nav-menu li, .nav-menu > li > a {
			font-family: '".gorilla_get_font_family(get_theme_mod("gorilla_navigation_font")) ."'; 
		}";
	}
	

	//Sidebar
	if(get_theme_mod( 'gorilla_sidebar_color' ) || get_theme_mod( 'gorilla_sidebar_bg_color' )) {
		$data[] = "#sidebar .widget-title {";
		if(get_theme_mod( 'gorilla_sidebar_color' )) {
			$data[] .= "color:".get_theme_mod( 'gorilla_sidebar_color' ).";";
		}
		if(get_theme_mod( 'gorilla_sidebar_bg_color' )) {
			$data[] .= "background-color:".get_theme_mod( 'gorilla_sidebar_bg_color' ).";";
		}
		$data[] .= "}";
	}


	//Footer
	
	if(get_theme_mod( 'gorilla_footer_widget_color' )) {
		$data[] = "#footer-widget-area .widget-title { color:".get_theme_mod( 'gorilla_footer_widget_color' )."; }";
	}
	
	if(get_theme_mod( 'gorilla_footer_widget_text_color' )) {
		$data[] = ".footer, .footer li, .footer .widget.gorilla_recent_post_with_thumbs_widget .recent_post_text, 
			.footer .widget.gorilla_recent_post_with_thumbs_widget .recent_post_text a,
			#footer-widget-area p, .footer .recentcomments a, .footer a, .footer .widget li, .footer .widget a, #footer-widget-area {color:".get_theme_mod( 'gorilla_footer_widget_text_color' ).";
		}";
	}

	if(get_theme_mod( 'gorilla_footer_widget_text_secondary_color' )) {
		$data[] = "#footer-widget-area .widget.gorilla_recent_post_with_thumbs_widget .recent_post_text .post-date,
			#footer-widget-area .widget.gorilla_recent_post_with_thumbs_widget .recent_post_text .post-date, 
			#footer-widget-area .widget ul.side-newsfeed li .side-item .side-item-text .side-item-meta,
			#footer-widget-area .widget_recent_entries .post-date {color:".get_theme_mod( 'gorilla_footer_widget_text_secondary_color' ).";
		}

		#footer-widget-area .tweet-details a {
			color:".get_theme_mod( 'gorilla_footer_widget_text_secondary_color' )." !important;
		}";
	}

	if(get_theme_mod( 'gorilla_footer_widget_links_hover_color' )) {
		$data[] = " #footer-widget-area .widget a:hover,
		.widget.gorilla_recent_post_with_thumbs_widget .recent_post_text a:hover,
		.footer .widget a:hover {
			color:".get_theme_mod( 'gorilla_footer_widget_links_hover_color' ).";
		}

		#footer-widget-area .widget-social-links a:hover > span,
		#footer-widget-area .widget .tagcloud a:hover
		 {
			background-color:".get_theme_mod( 'gorilla_footer_widget_links_hover_color' ).";
		}";
	}

	
	

	if(get_theme_mod( 'gorilla_footer_widget_area_bg_color' )) {
		$data[] = "#footer-widget-area { background:".get_theme_mod( 'gorilla_footer_widget_area_bg_color' )."; }";
	}

	if(get_theme_mod( 'gorilla_footer_image_bg' )) {
		$data[] = "#footer-widget-area { 
			background-image: url(".get_theme_mod( 'gorilla_footer_image_bg' ).");
			background-position: center center;
			background-repeat: no-repeat;
			background-size: cover;
		}";
	}
	
	if(get_theme_mod( 'gorilla_footer_widget_text_color' )) {
		$data[] = "#footer-widget-area, #footer-widget-area p { color:".get_theme_mod( 'gorilla_footer_widget_text_color' )."; }";
	}

	if(get_theme_mod( 'gorilla_footer_widget_text_color' )) {
		$data[] = ".footer .recentcomments a, .footer a, #footer-widget-area .widget .about-widget .widget-link { color:".get_theme_mod( 'gorilla_footer_widget_text_color' )."; }";
	}

	if(get_theme_mod( 'gorilla_footer_text_bg_color' )) {
		$data[] = " #footer-widget-area .widget .tagcloud a, #footer-widget-area .widget-social-links a span { background-color:".get_theme_mod( 'gorilla_footer_text_bg_color' )."; }";
	}

	if(get_theme_mod( 'gorilla_footer_tag_text_color' )) {
		$data[] = "#footer-widget-area .widget .tagcloud a{ color:".get_theme_mod( 'gorilla_footer_tag_text_color' )."; }";
	}
	

	//Footer Copyright Area
	if(get_theme_mod( 'gorilla_footer_copyright_bg' )) {
		$data[] = "#footer-copyright { background:".get_theme_mod( 'gorilla_footer_copyright_bg' )."; }";
	}

	if(get_theme_mod( 'gorilla_footer_copyright_color' )) {
		$data[] = "#footer-copyright p { color:".get_theme_mod( 'gorilla_footer_copyright_color')."; }";
	}


    $data = implode ('', $data);
    $data = preg_replace( '#\s+#', ' ', $data );
	$data = preg_replace( '#/\*.*?\*/#s', '', $data );
	$data = str_replace( '; ', ';', $data );
	$data = str_replace( ': ', ':', $data );
	$data = str_replace( ' {', '{', $data );
	$data = str_replace( '{ ', '{', $data );
	$data = str_replace( ', ', ',', $data );
	$data = str_replace( '} ', '}', $data );
	$data = str_replace( ';}', '}', $data );

	return $data;
}

if(is_customize_preview()){
	function gorilla_custom_css_func_preview(){

		$data = gorilla_custom_css_func();
		echo '<style type="text/css">'.$data.'</style>';

	}
	add_action( 'wp_head', 'gorilla_custom_css_func_preview' );
}

function gorilla_custom_css_func_save(){
	
	$data = gorilla_custom_css_func();

	$upload_dir = wp_upload_dir();
	$upload_style_dir = $upload_dir['basedir'] . '/alison_styles';
    if (! is_dir($upload_style_dir)) {
       mkdir( $upload_style_dir, 0755 );
    }

	$filename = $upload_style_dir.'/custom.css';

	global $wp_filesystem;
	if( empty( $wp_filesystem ) ) {
		require_once( ABSPATH .'/wp-admin/includes/file.php' );
		WP_Filesystem();
	}

	if( $wp_filesystem ) {
		$wp_filesystem->put_contents(
			$filename,
			$data,
			FS_CHMOD_FILE // predefined mode settings for WP files
		);
	}

}
add_action( 'customize_save_after', 'gorilla_custom_css_func_save' );


function gorilla_get_font_family($url) {
	
	$url = $url;
	$patterns = array(
	      //replace the path root
	'!^//fonts.googleapis.com/css\?!',
	      //capture the family and avoid and any following attributes in the URI.
	'!(family=[^&:]+).*$!',
	      //delete the variable name
	'!family=!',
	      //replace the plus sign
	'!\+!');
	$replacements = array(
	"",
	'$1',
	'',
	' ');
	    
	return $font = preg_replace($patterns,$replacements,$url);

}

?>