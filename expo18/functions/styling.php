<?php

if( !function_exists( 'om_include_fonts' ) ) {
	function om_include_fonts() {

		$main_font=get_option(OM_THEME_PREFIX . 'base_font');
		$main_font_google=false;
		$highlight_font=get_option(OM_THEME_PREFIX . 'highlight_font');
		$highlight_font_google=false;
		$logo_font=get_option(OM_THEME_PREFIX . 'logo_font');
		$logo_font_google=false;
		$testimonial_font=get_option(OM_THEME_PREFIX . 'testimonial_font');
		$testimonial_font_google=false;
	
		if(in_array($main_font,array('Arvo','Open Sans','Dosis','Montserrat','Satisfy'))) {
			$main_font_google=true;
		}
	
		if(in_array($highlight_font,array('Arvo','Open Sans','Dosis','Montserrat','Satisfy'))) {
			$highlight_font_google=true;
		}
		
		if(in_array($logo_font,array('Arvo','Open Sans','Dosis','Montserrat','Satisfy'))) {
			$logo_font_google=true;
		}
		
		if(in_array($testimonial_font,array('Arvo','Open Sans','Dosis','Montserrat','Satisfy'))) {
			$testimonial_font_google=true;
		}	
	
		$custom_main_font=get_option(OM_THEME_PREFIX . 'custom_base_font');
		if($custom_main_font) {
			$main_font=$custom_main_font;
			$main_font_google=true;
		}
	
		$custom_highlight_font=get_option(OM_THEME_PREFIX . 'custom_highlight_font');
		if($custom_highlight_font) {
			$highlight_font=$custom_highlight_font;
			$highlight_font_google=true;
		}
	
		$custom_logo_font=get_option(OM_THEME_PREFIX . 'custom_logo_font');
		if($custom_logo_font) {
			$logo_font=$custom_logo_font;
			$logo_font_google=true;
		}
	
		$custom_testimonial_font=get_option(OM_THEME_PREFIX . 'custom_testimonial_font');
		if($custom_testimonial_font) {
			$testimonial_font=$custom_testimonial_font;	
			$testimonial_font_google=true;
		}

		$charsets=array(
			'latin_ext',
			'arabic',
			'cyrillic',
			'cyrillic_ext',
			'devanagari',
			'greek',
			'greek_ext',
			'hebrew',
			'khmer',
			'telugu',
			'vietnamese',
		);

		$charsets_include=array();
		foreach($charsets as $charset) {
			if( get_option(OM_THEME_PREFIX . 'google_charset_'.$charset) == 'true' ) {
				$charsets_include[]=$charset;
			}
		}		

		$subset='';			
		if(!empty($charsets_include)) {
			$subset='&subset=latin,'.implode(',',$charsets_include);
		}
		
		if($main_font_google) {
			$family=urlencode($main_font).':400,800,400italic,800italic'.$subset;
			wp_enqueue_style(sanitize_title($family), '//fonts.googleapis.com/css?family='.$family);
		}
		if($highlight_font_google) {
			$family=urlencode($highlight_font).':400,600,800'.$subset;
			wp_enqueue_style(sanitize_title($family), '//fonts.googleapis.com/css?family='.$family);
		}
		if($logo_font_google) {
			$family=urlencode($logo_font).$subset;
			wp_enqueue_style(sanitize_title($family), '//fonts.googleapis.com/css?family='.$family);
		}
		if($testimonial_font_google) {
			$family=urlencode($testimonial_font).$subset;
			wp_enqueue_style(sanitize_title($family), '//fonts.googleapis.com/css?family='.$family);
		}
		
	}
}
add_action('wp_enqueue_scripts', 'om_include_fonts');

if( !function_exists( 'om_theme_get_styling' ) ) {
	
	function om_theme_get_styling() {
		
		ob_start();
		
		$main_font=get_option(OM_THEME_PREFIX . 'base_font');
		$highlight_font=get_option(OM_THEME_PREFIX . 'highlight_font');
		$logo_font=get_option(OM_THEME_PREFIX . 'logo_font');
		$testimonial_font=get_option(OM_THEME_PREFIX . 'testimonial_font');
	
		$custom_main_font=get_option(OM_THEME_PREFIX . 'custom_base_font');
		if($custom_main_font) {
			$main_font=$custom_main_font;
		}
	
		$custom_highlight_font=get_option(OM_THEME_PREFIX . 'custom_highlight_font');
		if($custom_highlight_font) {
			$highlight_font=$custom_highlight_font;
		}
	
		$custom_logo_font=get_option(OM_THEME_PREFIX . 'custom_logo_font');
		if($custom_logo_font) {
			$logo_font=$custom_logo_font;
		}
	
		$custom_testimonial_font=get_option(OM_THEME_PREFIX . 'custom_testimonial_font');
		if($custom_testimonial_font) {
			$testimonial_font=$custom_testimonial_font;	
		}
		
		echo '
	
			body,
			input,
			textarea
			{
				font-family:"'.$main_font.'";
			}
			
			
			.logo-text
			{
				font-family: "'.$logo_font.'";
			}
			
			.dates-place,
			.countdown-box .field .name,
			.countdown-box .field .value,
			.primary-menu,
			.secondary-menu-wrapper,
			.slider,
			.testimonial .author .name,
			.binfopane,
			.agenda-day,
			.new-comment-header,
			h1,h2,h3,h4,h5,h6,
			.post-title,
			.posts-list-small .title,
			.secondary-menu-control,
			.menu-special-button
			{
				font-family: "'.$highlight_font.'";
			}
			
			.testimonial .text
			{
				font-family: "'.$testimonial_font.'";
			}
			
		';
	
		/***************** Color ********************/
	
		$primary_color=get_option(OM_THEME_PREFIX . 'primary_color');
		$highlight_color=get_option(OM_THEME_PREFIX . 'highlight_color');

		echo '
			/*
			 * Primary color
			**/
			
			h1,
			h2,
			h3,
			h4,
			h5,
			h6,
			.h-bg,
			a,
			.countdown-box .field .value,
			.primary-menu li a:hover,
			.secondary-menu-control,
			.slider li,
			.slider-pager a:hover,
			.agenda-day
			{
				color:'.$primary_color.';
			}
			
			.menu-pane,
			.primary-menu ul,
			.slider-progress .inner,
			.binfopane-button,
			.agenda-item .time span,
			.h-bg,
			.button, a.button,
			.dropcap.bgcolor-theme,
			.marker,
			input[type=submit],
			.new-comment-pane input[type=submit],
			.registration-form input[type=submit]
			{
				background-color:'.$primary_color.';
			}
		';
	
		$tmp=str_replace('#','',$primary_color);
		$tmp1=round(base_convert(substr($tmp,0,2),16,10)*0.85);
		$tmp2=round(base_convert(substr($tmp,2,2),16,10)*0.85);
		$tmp3=round(base_convert(substr($tmp,4,2),16,10)*0.85);
		if($tmp1 < 0)
			$tmp1=0;
		if($tmp2 < 0)
			$tmp2=0;
		if($tmp3 < 0)
			$tmp3=0;
		$primary_color_darken='rgb('.$tmp1.','.$tmp2.','.$tmp3.')';
	
		echo '
		.primary-menu ul ul:after
		{
			border-right-color:'.$primary_color_darken.';
		}
		
		.slider-pager a,
		.agenda-item .time span,
		.primary-menu-select select
		{
			border-color:'.$primary_color.';
		}
		
		/*
		 * Highlight color
		**/
		
		.logo-text span,
		.footerline a:hover,
		.slider li .text span,
		ul.speakers li:hover .name,
		.post-title a:hover
		{
			color:'.$highlight_color.';
		}
		
		::selection
		{
			background:'.$highlight_color.';
		}
		::-moz-selection
		{
			background: '.$highlight_color.';
		}
		
		.binfopane-button .hov,
		.agenda-item:hover .time span,
		.post:hover .post-date,
		.menu-special-button,
		.menu-special-button-mobile
		{
			background-color: '.$highlight_color.';
		}
		
		.agenda-item:hover .time span,
		ul.speakers li:hover .pic,
		.post:hover .post-date
		{
			border-color: '.$highlight_color.';
		}
		';
	
		$out = ob_get_contents();
    ob_end_clean();
    
		$out=preg_replace('#/\*[\s\S]*?\*/#','',$out);
		$out=preg_replace('/\s*([\{\},;])\s*/','$1',$out);
		$out=trim($out);
    
    return $out;
	}
	
}

if( !function_exists( 'om_custom_style_file_name' ) ) {
	
	function om_custom_style_file_path() {
		
		if ( is_multisite() ) {
			return '/style-custom-' . get_current_blog_id() . '.css';
		} else {
			return '/style-custom.css';
		}
		
	}
}

if( !function_exists( 'om_theme_styling' ) ) {
	
	function om_theme_styling() {
		if(get_option( OM_THEME_PREFIX . 'use_inline_css' ) == 'true' || !file_exists(get_template_directory() . om_custom_style_file_path())) {
			add_action('wp_head','om_theme_custom_styling_inline_css');
		} else {
			add_action('wp_enqueue_scripts', 'om_theme_custom_styling_css_file');
		}
	}

}
add_action('init', 'om_theme_styling');

if( !function_exists( 'om_theme_custom_styling_inline_css' ) ) {
	function om_theme_custom_styling_inline_css() {
		$css=om_theme_get_styling();
		echo '<style>' . $css . '</style>';
	}
}

if( !function_exists( 'om_theme_custom_styling_css_file' ) ) {
	function om_theme_custom_styling_css_file() {
		$salt=get_option( OM_THEME_PREFIX . 'style-custom-salt' );
		if($salt != '')
			$salt='?rev='.$salt;
		$custom_css_file=om_custom_style_file_path() . $salt;

		wp_enqueue_style('style-custom', get_template_directory_uri() . $custom_css_file);
	}
}

if( !function_exists( 'om_theme_update_custom_style_file' ) ) {
	
	function om_theme_update_custom_style_file() {
		
		$f=@fopen(TEMPLATEPATH . om_custom_style_file_path(), 'w+');
		if($f) {
			$css=om_theme_get_styling();
			fwrite($f,$css);
			fclose($f);
		}
		
		update_option( OM_THEME_PREFIX . 'style-custom-salt', rand(10000, 99999) ); 
		
	}
	add_action('om_options_updated','om_theme_update_custom_style_file');
}