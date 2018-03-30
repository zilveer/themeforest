<?php 
// Register Styles
function register_styles(){
	
	wp_register_style('style', get_template_directory_uri() .	'/style.css');
		wp_enqueue_style( 'style');
	wp_register_style('prettyPhoto', get_template_directory_uri() .	'/styles/prettyPhoto.css');
		wp_enqueue_style( 'prettyPhoto');
}
add_action('themnific_head', 'register_styles');


/*-----------------------------------------------------------------------------------*/
/* Custom functions */
/*-----------------------------------------------------------------------------------*/


	global $themnific_options;
	$output = '';

// Add custom styling
add_action('themnific_head','themnific_custom_styling');
function themnific_custom_styling() {
	
	// Get options
	$home = home_url();
	$home_theme  = get_template_directory_uri();
	
	$sec_body_color = get_option('themnific_custom_color');
	$thi_body_color = get_option('themnific_thi_body_color');
	$for_body_color = get_option('themnific_for_body_color');
	$body_color = get_option('themnific_body_color');
	$text_color = get_option('themnific_text_color');
	$text_color_alter = get_option('themnific_text_color_alter');
	$body_color_sec = get_option('themnific_body_color_sec');
	$sec_text_color = get_option('themnific_sec_text_color');
	$thi_text_color = get_option('themnific_thi_text_color');
	$link = get_option('themnific_link_color');
	$link_alter = get_option('themnific_link_color_alter');
	$hover = get_option('themnific_link_hover_color');
	$sec_link = get_option('themnific_sec_link_color');
	$sec_hover = get_option('themnific_sec_link_hover_color');
	$thi_hover = get_option('themnific_thi_link_hover_color');
	$body_bg = get_option('themnific_body_bg');
	$body_bg_sec = get_option('themnific_body_bg_sec');
	$shadows = get_option('themnific_shadows_color');
	$shadows_sec = get_option('themnific_shadows_color_sec');
	$shadows_thi = get_option('themnific_shadows_color_thi');
	$border = get_option('themnific_border_color');
	$border_sec = get_option('themnific_border_color_sec');
	$border_thi = get_option('themnific_border_color_thi');
	    $custom_css = get_option('themnific_custom_css');
		
	// Add CSS to output
		if ($custom_css)
		$output .= $custom_css;
		$output = '';
	
	if ($body_color)
		$output = 'body,.stuff{background-color:'.$body_color.'}' . "\n";
	if ($sec_body_color)
		$output .= '#header,#header_bottom,#portfolio-filter li.active a,.nav li ul,.body2,.searchformhead input.s,#navigation .scrollTo_top{background-color:'.$sec_body_color.'}' . "\n";
	if ($thi_body_color)
		$output .= '#footer,#portfolio-filter li a,.wp-caption{background-color:'.$thi_body_color.'}' . "\n";
	if ($for_body_color)
		$output .= '.wpcf7-submit.wpcf7-submit,.item_full,a#navtrigger,#serinfo-nav li.current,.page-numbers.current,.flex-direction-nav li a,.hrline span,.hrlineB span,.inpost,.inpost2,#tabsmallss li.ui-tabs-selected span,.imgwrap,span.ribbon,a.mainbutton,#submit,#comments .navigation a,.tagssingle a,.contact-form .submit{background-color:'.$for_body_color.'}' . "\n";
		$output .= '#main-nav>li:hover,.mi-slider nav a:hover,.mi-slider nav a.mi-selected,#main-nav>li.current-cat,#main-nav>li.current_page_item{border-color:'.$for_body_color.' !important}' . "\n";
		$output .= '.nav a:hover,.mi-slider nav a:hover,.mi-slider nav a.mi-selected,#main-nav>li.current-cat>a,#main-nav>li.current_page_item>a{color:'.$for_body_color.'}' . "\n";
	if ($text_color)
		$output.= 'body,.body1 {color:'.$text_color.'}' . "\n";	
	if ($sec_text_color)
		$output .= '.body2,.body2 h2,.body2 h3,#header,#portfolio-filter>li.active>a,#header h1 a,.postinfo a{color:'.$sec_text_color.' !important}' . "\n";
	if ($text_color_alter)
		$output .= '.XXX {color:'.$text_color_alter.' !important}' . "\n";
	if ($link)
		$output .= '.body1 a, a:link, a:visited,#serinfo h4 a,.related li a {color:'.$link.'}' . "\n";
	if ($link_alter)
		$output .= '#footer a,#portfolio-filter li a,.wp-caption{color:'.$link_alter.'}' . "\n";
	if ($hover)
		$output .= '#header a:hover,.entry a,a:hover,.body1 a:hover,#serinfo a:hover,#portfolio-filter a.current,li.current-cat a,#portfolio-filter li.active a,#homecontent h2 span a {color:'.$hover.'}' . "\n";
		$output .= '.imagepost,.videopost,.imageformat{background-color:'.$hover.'}' . "\n";
	if ($sec_link)
		$output .= '.body2 a,a.body2{color:'.$sec_link.'}' . "\n";
	if ($sec_hover)
		$output .= '.body2 a:hover,p.body2 a:hover{color:'.$sec_hover.'!important}' . "\n";
	if ($thi_hover)
		$output .= '.xxx{color:'.$thi_hover.'}' . "\n";
		
		
		

	if ($body_bg)
		$output .= 'body{background-image:url('.$home_theme.'/images/bg/'.$body_bg.')}' . "\n";
		
		
	if ($border)
		$output .= '#singlecontent .tickercontainer,.postinfo,.postlist,#singlecontent,.wp-caption,#footer,.fblock,.tabitem,.etabs,.tab,#sidebar,#sidebar h2,#hometab,.searchform input.s,.fullbox,.pagination,input, textarea,input checkbox,input radio,select, file{border-color:'.$border.' !important}' . "\n";	
		$output .= 'ul#serinfo-nav,.hrline,.hrlineB{background-color:'.$border.'}' . "\n";	

	if ($border_sec)
		$output .= '.body2,#cats_wrap,.nav>li,#main-nav,#main-nav>li,#footer h2,.nav li ul,.nav li ul li a,#header_bottom {border-color:'.$border_sec.' !important}' . "\n";

	if ($border_thi)
		$output .= '.xxx {border-color:'.$border_thi.' !important}' . "\n";



		// General Typography		
		$font_text = get_option('themnific_font_text');	
		$font_text_sec = get_option('themnific_font_text_sec');	
		
		$font_nav = get_option('themnific_font_nav');
		$font_h1 = get_option('themnific_font_h1');		
		$font_h2_homepage = get_option('themnific_font_h2_homepage');
		$font_h2 = get_option('themnific_font_h2');	
		$font_h3 = get_option('themnific_font_h3');	
		$font_h4 = get_option('themnific_font_h4');	
		$font_h5 = get_option('themnific_font_h5');	
		$font_h6 = get_option('themnific_font_h5');	
		
		
		$font_h2_tagline = get_option('themnific_font_h2_tagline');	
	
	
		if ( $font_text )
			$output .= 'body,input, textarea,input checkbox,input radio,select, file {font:'.$font_text["style"].' '.$font_text["size"].'px/1.8em '.stripslashes($font_text["face"]).';color:'.$font_text["color"].'}' . "\n";
			
		if ( $font_text_sec )
			$output .= '#footer {font:'.$font_text_sec["style"].' '.$font_text_sec["size"].'px/2.2em '.stripslashes($font_text_sec["face"]).';color:'.$font_text_sec["color"].'}' . "\n";
			$output .= '#footer h2 {color:'.$font_text_sec["color"].' !important}' . "\n";

		if ( $font_h1 )
			$output .= 'h1 {font:'.$font_h1["style"].' '.$font_h1["size"].'px/1.1em '.stripslashes($font_h1["face"]).';color:'.$font_h1["color"].'}';		
		if ( $font_h2_homepage )
			$output .= '#homecontent h2  {font:'.$font_h2_homepage["style"].' '.$font_h2_homepage["size"].'px/0.8em '.stripslashes($font_h2_homepage["face"]).';color:'.$font_h2_homepage["color"].'}';
		if ( $font_h2 )
			$output .= 'h2 {font:'.$font_h2["style"].' '.$font_h2["size"].'px/1.2em '.stripslashes($font_h2["face"]).';color:'.$font_h2["color"].'}';
		if ( $font_h3 )
			$output .= 'h3,a.tmnf-sc-button.xl {font:'.$font_h3["style"].' '.$font_h3["size"].'px/1.2em '.stripslashes($font_h3["face"]).';color:'.$font_h3["color"].'}';
		if ( $font_h4 )
			$output .= 'h4 {font:'.$font_h4["style"].' '.$font_h4["size"].'px/1.5em '.stripslashes($font_h4["face"]).';color:'.$font_h4["color"].'}';	
		if ( $font_h5 )
			$output .= 'h5 {font:'.$font_h5["style"].' '.$font_h5["size"].'px/1.5em '.stripslashes($font_h5["face"]).';color:'.$font_h5["color"].'}';	
		if ( $font_h6 )
			$output .= 'h6 {font:'.$font_h6["style"].' '.$font_h6["size"].'px/1.5em '.stripslashes($font_h6["face"]).';color:'.$font_h6["color"].'}' . "\n";
			
			
		if ( $font_nav )
			$output .= '.nav>li>a,.grid-nav>li>a,.searchform input.s {font:'.$font_nav["style"].' '.$font_nav["size"].'px/1.7em '.stripslashes($font_nav["face"]).';color:'.$font_nav["color"].'}';	
			$output .= '#tabsmallss li h3,.inpost p.inslider,.inpost2 p,.tickerwrap,ul#serinfo-nav li a {font-family:'.stripslashes($font_nav["face"]).'}';	
		
		
		
	// custom stuff	
		if ( $font_text )
			$output .= '.tab-post small a,.taggs a,.ei-slider-thumbs li a {color:'.$font_text["color"].'}' . "\n";	
	
	// Output styles
		if ($output <> '') {
			$output = "<!-- Themnific Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
			echo $output;
	}
		
} 


// Add custom styling
add_action('themnific_head','themnific_mobile_styling');
	// Add stylesheet for shortcodes to HEAD
	function themnific_mobile_styling() {
		echo "<!-- Themnific Mobile & Special CSS -->\n";
		
		// google fonts link generator
		get_template_part('/functions/admin-fonts');
		wp_register_style('style-custom', get_template_directory_uri() .	'/style-custom.css');
			wp_enqueue_style( 'style-custom');	
		
		wp_register_style('font-awesome.min', get_template_directory_uri() .	'/styles/font-awesome.min.css');
			wp_enqueue_style( 'font-awesome.min');
		wp_register_style('font-awesome-ie7', get_template_directory_uri() .	'/styles/font-awesome-ie7.css');
			wp_enqueue_style( 'font-awesome-ie7');
		wp_register_style('mobile', get_template_directory_uri() .	'/styles/mobile.css');
			wp_enqueue_style( 'mobile');

} 
?>