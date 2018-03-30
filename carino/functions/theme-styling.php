<?php
/**
* Theme Styling . 
* PLEASE DO NOT MODIFY THIS FILE
*
* @author : VanThemes ( http://www.vanthemes.com )
* 
*/

/**
* Register scripts
**************************************************/
add_action( 'wp_enqueue_scripts', 'van_theme_scripts' );
function van_theme_scripts(){

		/**
		* Js
		*/
		wp_register_script( 'van-scripts', VAN_JS . '/carino.js', array( 'jquery' ), '1.0.0', true );
		wp_register_script( 'van-flexslider', VAN_JS . '/jquery.flexslider-min.js', array( 'jquery' ), '2.2.0', true );
		wp_register_script( 'van-plugins', VAN_JS . '/jquery.plugins.js', array( 'jquery' ), false, true );
		wp_register_script( 'van-isotope', VAN_JS . '/jquery.isotope.min.js', array( 'jquery' ), '1.5.25', true );
		/**
		* CSS
		*/
		$sets = van_chars_sets();
		wp_register_style( 'van-fonts', '//fonts.googleapis.com/css?family=Montserrat:400,700|Raleway:400,600,500,700' . $sets , array(), false, 'all' );
		wp_register_style( 'van-shortcodes', VAN_CSS .'/shortcodes.css', array(), '2.0.1', 'all' );

		wp_enqueue_style("van-fonts");
		wp_enqueue_style( 'van-style', get_stylesheet_uri(), array(), '1.0.0', 'all' );
		wp_enqueue_style("van-shortcodes");

		wp_enqueue_script( 'van-scripts' );
		wp_enqueue_script( 'van-flexslider' );
		wp_enqueue_script( 'van-isotope' );
		wp_enqueue_script( 'van-plugins' );

		if ( is_singular() && get_option('thread_comments') && comments_open() ) {
			wp_enqueue_script( 'comment-reply' );
		}

		/**
		* Skins
		*/
		if( van_get_option("skin") and van_get_option("skin") !== "default" ){
			wp_enqueue_style('van-skins', VAN_CSS . '/skins/' . van_get_option("skin") . '.css', array(), false, 'all' );
		}
		/**
		* MediaElements
		*/
		if ( van_get_option("pagination") && van_get_option("pagination") == "ajax" && !is_singular() ) {
			wp_enqueue_style( 'wp-mediaelement' );
		 	wp_enqueue_script( 'wp-mediaelement' );
		}
}
/**
* Theme Head
********************************************/
add_action('wp_head', 'van_theme_head');
function van_theme_head(){
	/**
	* Ie Fix
	*/
	?>
	<!--[if lt IE 9]>
	<script src="<?php echo VAN_JS ?>/html5shiv.js"></script>
	<script src="<?php echo VAN_JS ?>/selectivizr-min.js"></script>
	<![endif]-->
	<?php
	/**
	* disable / enable resposive
	*/
	if( van_get_option( 'disable_responsive' ) ) {
		echo '<meta name="viewport" content="width=1045">';
	}else{
		add_filter('body_class','van_responsive_class');
		echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" >' . "\n";
	}

}
/**
* Typography 
***************************************************************/
/**
* character sets
*/
function van_chars_sets() {

	$sets = "";
	$sets_enabled = false;
	if ( van_get_option( "cyrillic_ext" ) ) {$sets .= "cyrillic-ext,";$sets_enabled = true;}
	if ( van_get_option( "greek_ext" ) ) {$sets .= "greek-ext,";$sets_enabled = true;}
	if ( van_get_option( "greek" ) ) {$sets .= "greek,";$sets_enabled = true;}
	if ( van_get_option( "vietnamese" ) ) {$sets .= "vietnamese,";$sets_enabled = true;}
	if ( van_get_option( "latin_ext" ) ) {$sets .= "latin-ext,";$sets_enabled = true;}
	if ( van_get_option( "cyrillic" ) ) {$sets .= "cyrillic,";$sets_enabled = true;}
	
	if ( $sets_enabled ) {
		$sets = "&subset=latin," . substr($sets, 0, -1);
		$sets_enabled = true;
	}

	return $sets;
}
/**
* Typography selectors
*/
	$selectors = array();
	$selectors["general"]            = "body";
	$selectors["header_ty_menu"]= "#main-nav-wrap #main-navigation ul li a";
	$selectors["post_title"]    	 = ".entry-title a";
	$selectors["sidebar_title"]     = "#sidebar .widget-title";
	$selectors["boxes_title"]   	  = ".row-title";
	$selectors["foot_title"] 	  = "#footer-widget .widget-title";
	$selectors["archives_title"]	  = ".page-header .page-title h2, .page-header .page-title h1";
	$selectors["single_post_title"] = "#single-outer h1.entry-title";
	$selectors["entry_meta"]   	   = ".entry-meta";
	$selectors["entry_content"]  	   = ".entry-content";
	$selectors["heading1"]     	   = ".entry-content h1";
	$selectors["heading2"]    	   = ".entry-content h2";
	$selectors["heading3"]    	   = ".entry-content h3";
	$selectors["heading4"]    	   = ".entry-content h4";
	$selectors["heading5"]   	   = ".entry-content h5";
	$selectors["heading6"]   	   = ".entry-content h6";

/**
* Register New Google Web Fonts
*/
add_action('wp_enqueue_scripts', 'van_register_font');
function van_register_font(){
	global $selectors;
	$fonts_api = array();
	foreach ($selectors as $key => $value) {
		$cur_value  = van_get_option('typography');
		$item_value = isset( $cur_value[$key] ) ? $cur_value[$key] : array('color'=>'', 'size'=>'', 'family'=>'', 'weight'=>'', 'style'=>'');
		$fonts      = htmlspecialchars_decode($item_value['family']);

		if ( $fonts ) {
			$fonts_api[] = $fonts;
		}
	}
	$final_fonts = array_unique($fonts_api);
	if ( $final_fonts ) {
		$implode      = implode("|", $final_fonts );
		$urlencode   =  urlencode( str_replace('+',' ',$implode) );
		$sets = van_chars_sets();
		wp_enqueue_style( "van_custom_fonts" , '//fonts.googleapis.com/css?family=' . $urlencode . $sets , array(), false, 'all');   
	}
}
/**
* insert fonts in the right selectors
*/
function van_selectors_font(){
	global $selectors;
	$output = "";
	foreach( $selectors as $key => $value){
		$cur_value  = van_get_option('typography');
		$item_value = isset( $cur_value[$key] ) ? $cur_value[$key] : array('color'=>'', 'size'=>'', 'family'=>'', 'weight'=>'', 'style'=>'');
		$font_family = explode(":", $item_value['family']);
		if( $item_value['family'] || $item_value['color'] || $item_value['size'] || $item_value['weight'] || $item_value['style']){
			$output .= $value."{";
			if($item_value["color"]){  $output .= "color: ".$item_value['color'].";";}
			if($item_value["family"]){ $output .= "font-family: '".str_replace("+", " ", $font_family[0])."',arial,helvetica,Sans-Serif;";}
			if($item_value["size"]) {  $output .= "font-size: ".$item_value['size']."px;";}
			if($item_value["weight"]){ $output .= "font-weight: ".$item_value['weight'].";";}
			if($item_value["style"]) { $output .= "font-style: ".$item_value['style'].";";}
			$output .= "}\n";
		}
	}
	return $output;
}

/**
* Theme Styling
*************************************************/
add_action('wp_head', 'van_theme_styling');
function van_theme_styling (){
	$output = "";
	/**
	* Theme Color
	*/

	if ( van_get_option("theme_color") ) {

		$output .= '#main-nav-wrap #main-navigation ul li ul li:hover, #main-nav-wrap #main-navigation ul li a:hover { color: ' . van_get_option("theme_color") . ' !important }' . "\n";
		$output .= 'a, .page-header .page-title h1 span, #main-content.error404 #sitemap-container .sitemap a:hover, #main-content.error404 p.e-404, .entry-title a:hover, .entry-meta a:hover, #comments .commentslist li .comment-header .comment-author a:hover, #comments .commentslist li .comment-header .comment-dt a:hover, .widget li a:hover, .widget_categories li:before, .widget_nav_menu li:before, .widget_meta li:before, .widget_recent_entries li:before, .widget_pages li:before, .widget_archive li:before, #loginform-container .login-helpers a:hover, #user-logged .login-helpers a:hover, .tabs-widget .tabs-nav .active, #main-footer #footer-widget a:hover, #main-footer #footer-widget .box-entry h4 a:hover, #main-nav-wrap #main-navigation ul li:hover > a, #main-nav-wrap #main-navigation ul li.current-menu-item > a, #main-nav-wrap #main-navigation ul li.current-menu-parent > a { color: ' . van_get_option("theme_color") . ' }' . "\n";
		$output .= '#main-content.error404 .main-search input[type="submit"], .entry-media .thumb-overlay, article.quote-format .entry-media, #single-outer article.post-inner #entry-footer .article-tags a, #comments .commentslist li .replay a, #comments #respond input[type="submit"], .flickr-widget .flickr_badge_image:hover, #loginform-container input[type="submit"], .newsletter input[type="submit"], .tagcloud a, #wp-calendar caption, #wp-calendar #today, #contact input[type="submit"], .scrolltop, .main-search input[type="submit"] { background: ' . van_get_option("theme_color") . ' }' . "\n";
		$output .= '#main-content.error404 .main-search .s:focus, .newsletter input[type="text"]:focus , .main-search input[type="text"]:focus, article.status-format .entry-container, article.link-format .entry-container, #comments #respond input[type="text"]:focus, #comments #respond textarea:focus, #loginform-container input[type="text"]:focus, .newsletter input[type="text"]:focus, #loginform-container input[type="password"]:focus, .newsletter input[type="password"]:focus, #contact input[type="text"]:focus, #contact textarea:focus, #main-nav-wrap #main-navigation ul li a:hover, #main-nav-wrap #main-navigation ul li:hover > a, #main-nav-wrap #main-navigation ul li.current-menu-item > a, #main-nav-wrap #main-navigation ul li.current-menu-parent > a { border-color: ' . van_get_option("theme_color") . ' }' . "\n";
		$output .= 'article.post-inner .entry-media .link, article.post-inner .entry-media .zoom, mark, ins { background-color: ' . van_get_option("theme_color") . ' }' . "\n";
		$output .= '.player-container .mejs-container .mejs-controls { background: ' . van_get_option("theme_color") . ' !important }' . "\n";

	}
	/**
	* Background
	*/
	if( van_get_option("bg_type") && van_get_option("bg_type") == "pattern" ){
		$matches = null;
		$subject = van_get_option("pattern");
		$preg     = preg_match_all('/(^pattern[0-9]{1,2})_([0-9]{1,4})x([0-9]{1,4})/', $subject, $matches);
		$name     = $matches[1][0];
		$pWidth = $matches[2][0];
		$pHeight = $matches[3][0];
		$output .= 'body{background-image: url(' . VAN_IMG . '/patterns/' . $name . '.png); -webkit-background-size: ' . $pWidth . 'px ' . $pHeight . 'px;background-size: ' . $pWidth . 'px ' . $pHeight . 'px;); }' . "\n";
		$output .= '@media only screen and (-webkit-min-device-pixel-ratio: 1.5),only screen and (-moz-min-device-pixel-ratio: 1.5),only screen and (-o-min-device-pixel-ratio: 3/2),only screen and (min-device-pixel-ratio: 1.5),only screen and (min-resolution: 144dpi) {background-image: url(' . VAN_IMG . '/patterns/' . $name . '@2x.png);}' . "\n";

	} elseif( van_get_option("bg_type") && van_get_option("bg_type") == "custom"  ){
		$custom_bg   = "";
		$custom_bg  .=  van_get_option("custom_bg")   ? 'background-image: url(' . van_get_option("custom_bg") .');' : '';
		$custom_bg  .=  van_get_option("bg_color")   ? 'background-color: ' . van_get_option("bg_color") .';' : '';
		$custom_bg  .=  van_get_option("bg_repeat") ? 'background-repeat: '  . van_get_option("bg_repeat") .';' : '';
		$custom_bg  .=  ( van_get_option("bg_pos_x") || van_get_option("bg_pos_y") ) ?'background-position: '  . van_get_option("bg_pos_x") . ' ' . van_get_option("bg_pos_y") .';' : ''; 
		$custom_bg  .=  van_get_option("bg_attachment") ? 'background-attachment: '  . van_get_option("bg_attachment") .';': '';
		if ($custom_bg !="") {
			if( !van_get_option("full_screen_bg") ){
				$output .= 'body{' . $custom_bg . '}' . "\n";
			}else{
				$output .= '.full-screen-bg{display:block;' . $custom_bg . 'filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src=' . van_get_option("custom_bg") . ', sizingMethod=\'scale\');-ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src=' . van_get_option("custom_bg") . ', sizingMethod=\'scale\')";}' . "\n";
			}
		}	
	}
	/**
	* Links
	*/
	if ( van_get_option("links_color") ) {
		$output .= 'a{color: ' . van_get_option("links_color") . ';}' . "\n";
	}
	if ( van_get_option("links_hover") ) {
		$output .= 'a:hover{color: ' . van_get_option("links_hover") . ';}' . "\n";
	}
	/**
	* Header
	*/
	if ( van_get_option("top_br_bg") ){
		$output .= '#top-bar{background: ' . van_get_option("top_br_bg") . ';}' . "\n";
	}
	if ( van_get_option("top_br_social_color") ) {
		$output .= '#top-bar #header-social ul li a .icon{color: ' . van_get_option("top_br_social_color") . ';}' . "\n";
	}
	if ( van_get_option("top_br_social_hover") ) {
		$output .= '#top-bar #header-social ul li a .icon:hover{color: ' . van_get_option("top_br_social_hover") . ';}' . "\n";
	}
	if ( van_get_option("nav_bg") ) {
		$output .= '#main-header #main-nav-wrap{background: ' . van_get_option("nav_bg") . ';}' . "\n";
	}
	if ( van_get_option("nav_search_color") ) {
		$output .= '#main-nav-wrap #header-search .search-icn{color: ' . van_get_option("nav_search_color") . ';}' . "\n";
	}
	if ( van_get_option("nav_links_color") ) {
		$output .= '#main-nav-wrap #main-navigation ul li a{color: ' . van_get_option("nav_links_color") . ';}' . "\n";
	}
	if ( van_get_option("nav_links_hover") ) {
		$output .= '#main-nav-wrap #main-navigation ul li:hover > a, #main-nav-wrap #main-navigation ul li.current-menu-item > a, #main-nav-wrap #main-navigation ul li.current-menu-parent > a, #main-nav-wrap #main-navigation ul li a:hover{color: ' . van_get_option("nav_links_hover") . ';}' . "\n";
	}
	/**
	* Container
	*/
	if ( van_get_option("content_bg") ) {
		$output .= '.content{background: ' . van_get_option("content_bg") . ';}' . "\n";
	}
	/**
	* Footer
	*/
	if ( van_get_option("footer_bg") ) {
		$output .= '#main-footer #footer-widget{background: ' . van_get_option("footer_bg") . ';}' . "\n";
	}
	if ( van_get_option("footer_title") ) {
		$output .= '#main-footer #footer-widget .widget-title{color: ' . van_get_option("footer_title") . ';}' . "\n";
	}
	if ( van_get_option("footer_text") ) {
		$output .= '#main-footer #footer-widget{color: ' . van_get_option("footer_text") . ';}' . "\n";	
	}
	if ( van_get_option("footer_links") ) {
		$output .= '#main-footer #footer-widget a{color: ' . van_get_option("footer_links") . ';}' . "\n";
	}
	if ( van_get_option("footer_hover") ) {
		$output .= '#main-footer #footer-widget a:hover{color: ' . van_get_option("footer_hover") . ';}' . "\n";
	}
	/**
	* Footer Bottom
	*/
	if ( van_get_option("footer_bottom_bg") ){ 
		$output .= '#main-footer #footer-bottom{background: ' . van_get_option("footer_bottom_bg") . ';}' . "\n";
	}
	if ( van_get_option("footer_bottom_text") ) {
		$output .= '#main-footer #footer-bottom .footer-copyrights{color: ' . van_get_option("footer_bottom_text") . ';}' . "\n";
	}
	if ( van_get_option("footer_bottom_links") ) {
		$output .= '#main-footer #footer-bottom a, #main-footer #footer-bottom .footer-nav-wrap ul li a{color: ' . van_get_option("footer_bottom_links") . ';}' . "\n";
	}
	if ( van_get_option("footer_bottom_hover") ) {
		$output .= '#main-footer #footer-bottom a:hover, #main-footer #footer-bottom .footer-nav-wrap ul li a:hover{color: ' . van_get_option("footer_bottom_hover") . ';}' . "\n";
	}
	/**
	* typography
	*/
	$output .= van_selectors_font();

	if ( $output != "" ) {
		echo  "\n" . '<style type="text/css" media="screen">' . "\n";
			echo $output;
		echo '</style>' . "\n";
	}
}

/**
* Custom Css
*****************************************/
add_action('wp_head', 'van_custom_css');
function van_custom_css(){
	if ( van_get_option('global_css') || van_get_option('global_css') || van_get_option('wide_css') ||  van_get_option('phone_css') ) {
		
		echo '<style type="text/css" media="screen">' . "\n";

			if( van_get_option('global_css') ){ 
				echo van_get_option('global_css',true);
			}
			if( van_get_option('tablets_css') ){ 
				echo  '@media only screen and (min-width: 768px) and (max-width: 979px){' . van_get_option('tablets_css',true) . '}' . "\n";
			}
			if( van_get_option('wide_css') ){ 
				echo  '@media only screen and (max-width: 767px) and (min-width: 480px){' . van_get_option('wide_css',true) . '}' . "\n";
			}
			if( van_get_option('phone_css') ){ 
				echo  '@media only screen and (max-width: 479px) {' . van_get_option('phone_css',true) . '}' . "\n";
			}
		echo '</style>' . "\n";
	}
}