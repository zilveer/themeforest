<?php

#-----------------------------------------------------------------
# Include Custom CSS in Theme Header
#-----------------------------------------------------------------


// Add styles to header
//-----------------------------------------------------------------
function theme_options_custom_css() {
	// Custom Styles from Theme Options
	echo '<style type="text/css">'. theme_custom_styles() .'</style>';
}
// Add hook for front-end <head></head>
add_action('wp_head', 'theme_options_custom_css', 101); // low priority to get it near the end


// Get custom styles from theme options
//-----------------------------------------------------------------
if ( ! function_exists( 'theme_custom_styles' ) ) :
function theme_custom_styles() {

	// Get header and footer information
	$header_data = get_layout_options('header');	
	$header = (isset($header_data)) ? $header_data : false;

	$footer_data = get_layout_options('footer');
	$footer = (isset($footer_data)) ? $footer_data : false;

	// Styles variable
	$CustomStyles = '';

	#-----------------------------------------------------------------
	# Styles from Theme Options
	#-----------------------------------------------------------------

	// Accent Color - Primary
	//................................................................

	$accent_1 = get_options_data('options-page', 'accent-color-1');

	if (isset($accent_1) && $accent_1 !== '#') {

		$accentStyles  = '.accent-primary, .jp-play-bar, .jp-volume-bar-value, .impactBtn, .impactBtn:hover, .impactBtn:active, .wpb_call_to_action .wpb_button, .wpb_call_to_action .wpb_button:hover, .wpb_call_to_action .wpb_button:active, button.vc_btn3.vc_btn3-color-accent-primary, a.vc_btn3.vc_btn3-color-accent-primary, .wpb_accent-primary, .wpb_button.wpb_accent-primary, .wpb_button.wpb_accent-primary:hover, .wpb_button.wpb_accent-primary:active, .vc_progress_bar .vc_single_bar.accent-primary .vc_bar { background-color: '. $accent_1 .'; }';
		$accentStyles .= '.inner-overlay i[class*="icon-"], .inner-overlay i[class*="fa fa-"] { border-color: '. $accent_1 .'; }';
		$accentStyles .= 'div.wpb_tour .ui-tabs .ui-tabs-nav li.ui-tabs-active a, div.wpb_tour .ui-tabs .ui-tabs-nav li.ui-tabs-active a:hover, body nav.ubermenu.ubermenu-main ul.ubermenu-nav > li.ubermenu-item.ubermenu-current-menu-item > a { border-bottom-color: '. $accent_1 .'; }';
		$accentStyles .= 'h1 em, h2 em, h3 em, h4 em, h5 em, h6 em, h2.wpb_call_text em, .iconBox.icon i[class^="icon-"], .iconBox.icon i[class^="fa fa-"], #content div.wpb_wrapper h4.wpb_toggle:hover, #content div.wpb_wrapper h4.wpb_toggle:before, .inner-overlay i[class*="icon-"], .inner-overlay i[class*="fa false-"] { color: '. $accent_1 .'; }';
	
		// Add styles to CSS variable
		$CustomStyles .= $accentStyles;
	}

	// Body background
	//................................................................

	$bodyBgColor  = get_options_data('options-page', 'background-color');
	$bodyPosition = get_options_data('options-page', 'background-position');
	$bodyImage    = get_options_data('options-page', 'background-image');
	if ( $bodyBgColor && $bodyBgColor != '#' ) {
		$bodyBg = 'background-color: '. $bodyBgColor .'; ';
	}
	if ( $bodyImage && $bodyPosition != 'full-screen' ) {
		$bodyBg .= 'background-image: url('. $bodyImage .'); ';
		$bodyBg .= 'background-repeat: '. get_options_data('options-page', 'background-repeat') .'; ';
		$bodyBg .= 'background-position: '. $bodyPosition . ' top;'; 
	}
	if (isset($bodyBg)) {
		
		$bodyBgStyles = 'body, body.boxed { '. $bodyBg .'; }';

		// Add styles to CSS variable
		$CustomStyles .= $bodyBgStyles;
	}

	// Links
	//................................................................

	$linkColor = get_options_data('options-page', 'link-color');
	if (!empty($linkColor) && $linkColor != '#') {

		$linkStyles = "a, .widget a { color: ". $linkColor ."; }";

		// Add styles to CSS variable
		$CustomStyles .= $linkStyles;
	}
	// Hover (links)
	$hoverColor = get_options_data('options-page', 'link-hover-color');
	if (!empty($hoverColor) && $hoverColor != '#') { 

		$linkHoverStyles = "a:hover, .entry-title a:hover, .widget a:hover, .wpb_carousel .post-title a:hover { color: ". $hoverColor ."; }";

		// Add styles to CSS variable
		$CustomStyles .= $linkHoverStyles;
	}

	// Menu background
	//................................................................

	$mainMenu = array();
	$mainMenu = get_options_data('options-page', 'menu-color');
	$mainMenuFont = get_options_data('options-page', 'menu-font-color');
	$mainMenuActive = get_options_data('options-page', 'menu-active-color');
	$menuOpacity = get_options_data('options-page', 'menu-opacity');

	// Header specific values
	if ( !empty($header['menu-color']) && $header['menu-color'] != '#' ) {
		$mainMenu = $header['menu-color'];	
	}
	if ( !empty($header['menu-font-color']) && $header['menu-font-color'] != '#' ) {
		$mainMenuFont = $header['menu-font-color'];	
	}
	if ( !empty($header['menu-active-color']) && $header['menu-active-color'] != '#' ) {
		$mainMenuActive = $header['menu-active-color'];	
	}
	if ( !empty($header['menu-opacity']) ) {
		$menuOpacity = $header['menu-opacity'];	
	}

	// Check for opacity
	if (isset($menuOpacity) && !empty($menuOpacity) && $menuOpacity != '1') {

		// Get RGB version of color
		if (isset($mainMenu)) {
			$mainMenu_rgba = get_as_rgba($mainMenu, '.'.$menuOpacity);
			$mainMenu_transparent = get_as_rgba($mainMenu, '0');
		}
	}

	// Menu background color
	if (!empty($mainMenu) && $mainMenu != '#') {
		$menuBg = 'background-color: '. $mainMenu .';';
		$menuBorder = 'border-color: '. $mainMenu .';';
		$menuBorderTop = 'border-top-color: '. $mainMenu .';';
		$menuBorderBottom = 'border-bottom-color: '. $mainMenu .';';
		// RGBA colors
		if (isset($mainMenu_rgba)) {
			$menuBg .= 'background-color: '. $mainMenu_rgba .';';
			$menuBorder .= 'border-color: '. $mainMenu_transparent .';';
			$menuBorderTop .= 'border-top-color: '. $mainMenu_transparent .';';
			$menuBorderBottom .= 'border-bottom-color: '. $mainMenu_transparent .';';
		}
		// Set the styles
		$menuBgStyles  = '#MainNav { '. $menuBg .' }';
		$menuBgStyles .= 'body nav.ubermenu.ubermenu-main ul.ubermenu-nav > li.ubermenu-item > a, body nav.ubermenu.ubermenu-main ul.ubermenu-nav > li.ubermenu-item > span.um-anchoremulator, body .ubermenu-responsive-toggle, #NavSearchForm button, #NavSearchForm input { '. $menuBorder .' }';
		$menuBgStyles .= 'body nav.ubermenu.ubermenu-main.ubermenuHorizontal ul.ubermenu-nav > li.ubermenu-item > ul.ubermenu-submenu.ubermenu-submenu-type-mega { '. $menuBorderTop .' }';
		$menuBgStyles .= '#MainNav, body nav.ubermenu.ubermenu-main ul.ubermenu-nav > li.ubermenu-item > a, body nav.ubermenu.ubermenu-main ul.ubermenu-nav > li.ubermenu-item > span.um-anchoremulator, body .ubermenu-responsive-toggle, .home nav.ubermenu.ubermenu-main ul.ubermenu-nav > li.ubermenu-item.ubermenu-current-menu-item > a, .home-page nav.ubermenu.ubermenu-main ul.ubermenu-nav > li.ubermenu-item.ubermenu-current-menu-item > a { '. $menuBorderBottom .' }';
		
		// Add styles to CSS variable
		$CustomStyles .= $menuBgStyles;
	}
	// Font color 
	if (isset($mainMenuFont) && !empty($mainMenuFont) && $mainMenuFont != '#') {
		// Print the styles
		$menuFontStyles = 'body nav.ubermenu.ubermenu-main ul.ubermenu-nav > li.ubermenu-item > a, body nav.ubermenu.ubermenu-main ul.ubermenu-nav > li.ubermenu-item > span.um-anchoremulator, body .ubermenu-responsive-toggle, .navSearch a, .navSearch a:visited { color: '. $mainMenuFont .'; }';
		
		// Add styles to CSS variable
		$CustomStyles .= $menuFontStyles;
	}
	// Active item font color
	if (isset($mainMenuActive) && !empty($mainMenuActive) && $mainMenuActive != '#') {
		// Print the styles
		$menuActiveStyles = 'body nav.ubermenu.ubermenu-main ul.ubermenu-nav > li.ubermenu-item.ubermenu-current-menu-item > a, .navSearch a:hover { color: '. $mainMenuActive .'; }';
		
		// Add styles to CSS variable
		$CustomStyles .= $menuActiveStyles;
	}

	// Masthead background
	//................................................................

	// Default color & image
	$mastheadBg = false;
	$mastheadBgRepeat = 'no-repeat';
	$mastheadBgPosition = 'left';
	$mastheadBgColor = get_options_data('options-page', 'masthead-background-color');
	if ($mastheadBgImage = get_options_data('options-page', 'masthead-background-image')) {
		$mastheadBgRepeat = get_options_data('options-page', 'masthead-background-repeat');
		$mastheadBgPosition = get_options_data('options-page', 'masthead-background-position');
	}
	// Masthead specific color & image
	if ( !empty($header['masthead-background-color']) && $header['masthead-background-color'] !== '#' ) {
		$mastheadBgColor = $header['masthead-background-color'];	
	}
	if ( !empty($header['masthead-background-image']) ) {
		$mastheadBgImage = $header['masthead-background-image'];	
		if ( !empty($header['masthead-background-repeat']) )
			$mastheadBgRepeat = $header['masthead-background-repeat'];	
		if ( !empty($header['masthead-background-position']) )
			$mastheadBgPosition = $header['masthead-background-position'];	
	}
	// Prepare the CSS
	if ( isset($mastheadBgColor) && !empty($mastheadBgColor) && $mastheadBgColor != '#' ) {
		$mastheadBg = 'background-color: '. $mastheadBgColor .'; ';
	}
	if ( isset($mastheadBgImage) && !empty($mastheadBgImage) ) {
		$mastheadBg .= 'background-image: url('. $mastheadBgImage .'); ';
		$mastheadBg .= 'background-repeat: '. $mastheadBgRepeat .'; ';
		$mastheadBg .= 'background-position: '. $mastheadBgPosition . ' top;'; 
	}
	// Output the CSS
	if ($mastheadBg) {
		// Get the styles
		$mastheadStyles = '#masthead, body.boxed #masthead, body.padded-box #masthead { '. $mastheadBg .'; }';
		// Add styles to CSS variable
		$CustomStyles .= $mastheadStyles;
	}

	// Header background
	//................................................................

	// Default color & image
	$headerBg = false;
	$headerBgRepeat = 'no-repeat';
	$headerBgPosition = 'left';
	$headerBgColor = get_options_data('options-page', 'header-background-color');
	if ($headerBgImage = get_options_data('options-page', 'header-background-image')) {
		$headerBgRepeat = get_options_data('options-page', 'header-background-repeat');
		$headerBgPosition = get_options_data('options-page', 'header-background-position');
	}
	// Header specific color & image
	if ( !empty($header['header-background-color']) && $header['header-background-color'] != '#'  ) {
		$headerBgColor = $header['header-background-color'];	
	}
	if ( !empty($header['header-background-image'])) {
		$headerBgImage = $header['header-background-image'];	
		if ( !empty($header['header-background-repeat']) )
			$headerBgRepeat = $header['header-background-repeat'];	
		if ( !empty($header['header-background-position']) )
			$headerBgPosition = $header['header-background-position'];	
	}
	// Prepare the CSS
	if ( isset($headerBgColor) && !empty($headerBgColor) && $headerBgColor != '#' ) {
		$headerBg = 'background-color: '. $headerBgColor .'; ';
	}
	if ( isset($headerBgImage) && !empty($headerBgImage) ) {
		$headerBg .= 'background-image: url('. $headerBgImage .'); ';
		$headerBg .= 'background-repeat: '. $headerBgRepeat .'; ';
		$headerBg .= 'background-position: '. $headerBgPosition . ' top;'; 
	}
	// Output the CSS
	if ($headerBg) {
		// Get the styles
		$headerStyles = '#TopContent { '. $headerBg .'; }';
		// Add styles to CSS variable
		$CustomStyles .= $headerStyles;
	}

	// Footer Top background
	//................................................................

	// Default color & image
	$footerTopBg = false;
	$footerTopBgRepeat = 'no-repeat';
	$footerTopBgPosition = 'left';
	$footerTopBgColor = get_options_data('options-page', 'footer-top-background-color');
	if ($footerTopBgImage = get_options_data('options-page', 'footer-top-background-image')) {
		$footerTopBgRepeat = get_options_data('options-page', 'footer-top-background-repeat');
		$footerTopBgPosition = get_options_data('options-page', 'footer-top-background-position');
	}
	// Header specific color & image
	if ( !empty($footer['footer-top-background-color']) && $footer['footer-top-background-color'] != '#' ) {
		$footerTopBgColor = $footer['footer-top-background-color'];	
	}
	if ( !empty($footer['footer-top-background-image']) ) {
		$footerTopBgImage = $footer['footer-top-background-image'];	
		if ( !empty($footer['footer-top-background-repeat']) )
			$footerTopBgRepeat = $footer['footer-top-background-repeat'];	
		if ( !empty($footer['footer-top-background-position']) )
			$footerTopBgPosition = $footer['footer-top-background-position'];	
	}
	// Prepare the CSS
	if ( isset($footerTopBgColor) && !empty($footerTopBgColor) && $footerTopBgColor !== '#' ) {
		$footerTopBg = 'background-color: '. $footerTopBgColor .'; ';
	}
	if ( isset($footerTopBgImage) && !empty($footerTopBgImage) ) {
		$footerTopBg .= 'background-image: url('. $footerTopBgImage .'); ';
		$footerTopBg .= 'background-repeat: '. $footerTopBgRepeat .'; ';
		$footerTopBg .= 'background-position: '. $footerTopBgPosition . ' top;'; 
	}
	// Output the CSS
	if ($footerTopBg) {
		// Get the styles
		$footerTopStyles = '#FooterTop { '. $footerTopBg .'; }';
		// Add styles to CSS variable
		$CustomStyles .= $footerTopStyles;
	}

	// Footer Bottom background
	//................................................................

	// Default color & image
	$footerBg = false;
	$footerBgRepeat = 'no-repeat';
	$footerBgPosition = 'left';
	$footerBgColor = get_options_data('options-page', 'footer-bottom-background-color');
	if ($footerBgImage = get_options_data('options-page', 'footer-bottom-background-image')) {
		$footerBgRepeat = get_options_data('options-page', 'footer-bottom-background-repeat');
		$footerBgPosition = get_options_data('options-page', 'footer-bottom-background-position');
	}
	// Footer specific color & image
	if ( !empty($footer['footer-bottom-background-color']) && $footer['footer-bottom-background-color'] != '#' ) {
		$footerBgColor = $footer['footer-bottom-background-color'];	
	}
	if ( !empty($footer['footer-bottom-background-image']) ) {
		$footerBgImage = $footer['footer-bottom-background-image'];	
		if ( !empty($footer['footer-bottom-background-repeat']) )
			$footerBgRepeat = $footer['footer-bottom-background-repeat'];	
		if ( !empty($footer['footer-bottom-background-position']) )
			$footerBgPosition = $footer['footer-bottom-background-position'];	
	}
	// Prepare the CSS
	if ( isset($footerBgColor) && !empty($footerBgColor) && $footerBgColor != '#' ) {
		$footerBg = 'background-color: '. $footerBgColor .'; ';
	}
	if ( isset($footerBgImage) && !empty($footerBgImage) ) {
		$footerBg .= 'background-image: url('. $footerBgImage .'); ';
		$footerBg .= 'background-repeat: '. $footerBgRepeat .'; ';
		$footerBg .= 'background-position: '. $footerBgPosition . ' top;'; 
	}
	// Output the CSS
	if ($footerBg) {
		// Get the styles
		$footerBottomStyles = '#FooterBottom { '. $footerBg .'; }';
		// Add styles to CSS variable
		$CustomStyles .= $footerBottomStyles;
	}

	// Fonts
	//................................................................

	$font_Heading  = get_options_data('options-page', 'font-heading-standard', 'default');
	$font_Body     = get_options_data('options-page', 'font-body-standard', 'default');
	$gFont_Heading = get_options_data('options-page', 'font-heading-google');
	$gFont_Body    = get_options_data('options-page', 'font-body-google');
	$color_Heading = get_options_data('options-page', 'font-heading-color');
	$color_Body    = get_options_data('options-page', 'font-body-color');
	// Standard Font Index
	$standard_font = array(
		"arial" => "Arial,Helvetica,Garuda,sans-serif",
		"arial-black" => "'Arial Black',Gadget,sans-serif",
		"courier-new" => "'Courier New',Courier,monospace",
		"georgia" => "Georgia,'Times New Roman',Times, serif",
		"lucida-console" => "'Lucida Console',Monaco,monospace",
		"lucida-sans-unicode" => "'Lucida Sans Unicode','Lucida Grande',sans-serif",
		"palatino-linotype" => "'Palatino Linotype','Book Antiqua',Palatino,serif",
		"tahoma" => "Tahoma,Geneva,sans-serif",
		"times-new-roman" => "'Times New Roman',Times,serif",
		"trebuchet-ms" => "'Trebuchet MS',Arial,Helvetica,sans-serif",
		"verdana" => "Verdana,Geneva,sans-serif"
	);

	// Heading font
	//................................................................

	$headingFont = false;
	if (!empty($gFont_Heading)) {
		// Get just the font name
		$headingFont = str_replace( '+', ' ', substr($gFont_Heading, 0, (strpos($gFont_Heading, ':')) ? strpos($gFont_Heading, ':') : strlen($gFont_Heading)) );
	} elseif (!empty($font_Heading) && $font_Heading != 'default') {
		$headingFont = $standard_font[$font_Heading];
	}
	if ($headingFont) { 
		// Get the styles
		$headingFontStyles = 'h1, h2, h3, h4, h5, h6, h2.wpb_call_text, .page-title, .headline, .comments-area article header cite, .vc_text_separator div, .headline, .entry-title.headline, body .wpb_accordion .ui-accordion .ui-accordion-header { font-family: '. $headingFont .'; }';
		// Add styles to CSS variable
		$CustomStyles .= $headingFontStyles;
	}
	if (!empty($color_Heading) && $color_Heading !== '#') {
		// Get the styles
		$headingColorStyles = 'h1, h2, h3, h4, h5, h6, h2.wpb_call_text, .page-title, .headline, .comments-area article header cite, .vc_text_separator div, body .wpb_accordion .ui-accordion .ui-accordion-header a, body .wpb_accordion .ui-accordion .ui-accordion-header a:hover, .site-header .site-title a, .entry-title, .entry-title a, .wpb_carousel .post-title a, .widget-area .widget li[class*="current"] a, .iconBox.icon i[class^="icon-"], .iconBox.icon i[class^="fa fa-"], .iconBox .iconBoxTitle { color: '. $color_Heading .'; }';
		// Add styles to CSS variable
		$CustomStyles .= $headingColorStyles;
	}

	// Body font
	//................................................................

	$bodyFont = false;
	if (!empty($gFont_Body)) {
		// Get just the font name
		$bodyFont = str_replace( '+', ' ', substr($gFont_Body, 0, strpos($gFont_Body, ':')) );
		$bodyFont = str_replace( '+', ' ', substr($gFont_Body, 0, (strpos($gFont_Body, ':')) ? strpos($gFont_Body, ':') : strlen($gFont_Body)) );
	} elseif (!empty($font_Body) && $font_Body != 'default') {
		$bodyFont = $standard_font[$font_Body];
	}
	if ( ($bodyFont && !empty($bodyFont)) || (!empty($color_Body) && $color_Body != '#') ) { 
		// Get the styles
		$bodyFontStyles = 'body { ';
		if ($bodyFont)   { 
			$bodyFontStyles .= 'font-family: '. $bodyFont. ';' ;
		} 
		if ($color_Body && $color_Body != '#') { 
			$bodyFontStyles .= 'color: '.$color_Body.';'; 
		} 
		$bodyFontStyles .=  '}';
		// Add styles to CSS variable
		$CustomStyles .= $bodyFontStyles;
	}

	// Custom CSS (user generated)
	//................................................................

	$userStyles = stripslashes(htmlspecialchars_decode(get_options_data('options-page', 'custom-styles'),ENT_QUOTES));

	// Add styles to CSS variable
	$CustomStyles .= $userStyles;

	// all done!
	return $CustomStyles;

}

endif; ?>