<?php 

function get_custom_css( $page_id ) {

	global $NHP_Options;
	$options_morphis = $NHP_Options;
	$template_dir = get_template_directory_uri();
	
	$output = '';
	$link_color = $options_morphis['link_color']; 
	$main_accent_hover_color = $options_morphis['main_accent_hover_color']; 
	$body_font_color = $options_morphis['body_font_color']; 
	$heading_font_color = $options_morphis['heading_font_color']; 
	$footer_font_color = $options_morphis['footer_font_color']; 
	$section_pattern = $options_morphis['section_pattern']; 
	$sub_footer_pattern = $options_morphis['sub_footer_pattern']; 
	
	if(!empty($options_morphis['sidebar_headings_pattern'])) {
		$sidebar_headings_pattern = $options_morphis['sidebar_headings_pattern'];
	}

	if(!empty($options_morphis['section_pattern_upload'])) {
		$section_pattern_upload = $options_morphis['section_pattern_upload'];
	}

	if(!empty($options_morphis['sub_footer_pattern_upload'])) {
		$sub_footer_pattern_upload = $options_morphis['sub_footer_pattern_upload'];
	}

	if(!empty($options_morphis['sidebar_headings_pattern_upload'])) {
		$sidebar_headings_pattern_upload = $options_morphis['sidebar_headings_pattern_upload'];
	}

	$select_heading_font = str_replace( 'fontface-', '', $options_morphis['select_heading_font'] );
	$select_main_body_font = str_replace( 'fontface-', '', $options_morphis['select_main_body_font'] );
	$select_headline_main_font = str_replace( 'fontface-', '', $options_morphis['select_headline_main_font'] );
	$select_font_subsets = array();
	
	//character subsets
	if( !empty( $options_morphis['select_font_subsets'] ) ) {
		$select_font_subsets = $options_morphis['select_font_subsets'];
	} else {
		$select_font_subsets = array();
	}
	
	$select_font_subsets_glued = '';
	if( !empty($select_font_subsets) ) {
		$select_font_subsets_glued = '&subset=' . implode( ",", array_keys($select_font_subsets) );
	}

	$select_heading_font_style = '';
	$select_main_body_font_style = '';
	$select_headline_main_font_style = '';
	
	// Google Web Font usage
	// [1] Check first if this is a Google Web Font
	$google_web_font_heading = explode( ':', $select_heading_font );
	if(!empty($google_web_font_heading[1]) && ($google_web_font_heading[1]) != "") {
		$output .= '@import url(http://fonts.googleapis.com/css?family=' . str_replace(" ", "+", $google_web_font_heading[0]) . ( ($google_web_font_heading[1] == "regular") ? "" :  ":". $google_web_font_heading[1] ) . $select_font_subsets_glued . ');
		';
		$select_heading_font = $google_web_font_heading[0];
		if( strpos($google_web_font_heading[1], "italic" ) !== FALSE ) {
			$select_heading_font_style = ' font-style: italic; ';
		}
	}

	$google_web_font_main_body = explode( ':', $select_main_body_font );
	if(!empty($google_web_font_main_body[1]) && ($google_web_font_main_body[1]) != "") {
		$output .= '@import url(http://fonts.googleapis.com/css?family=' . str_replace(" ", "+", $google_web_font_main_body[0]) . ( ($google_web_font_main_body[1] == "regular") ? "" : ":". $google_web_font_main_body[1] ) . $select_font_subsets_glued . ');
		';
		$select_main_body_font = $google_web_font_main_body[0];
		if( strpos($google_web_font_main_body[1], "italic" ) !== FALSE ) {
			$select_main_body_font_style = ' font-style: italic; ';
		}
	}

	$google_web_font_headline = explode( ':', $select_headline_main_font );
	if(!empty($google_web_font_headline[1]) && ($google_web_font_headline[1]) != "") {
		$output .= '@import url(http://fonts.googleapis.com/css?family=' . str_replace(" ", "+", $google_web_font_headline[0]) . ( ($google_web_font_headline[1] == "regular") ? "" : ":".  $google_web_font_headline[1] ) . $select_font_subsets_glued . ');
		';
		$select_headline_main_font = $google_web_font_headline[0];
		if( strpos($google_web_font_headline[1], "italic" ) !== FALSE ) {
			$select_headline_main_font_style = ' font-style: italic; ';
		}
	}
		
	// layouts and skins
	$boxed_full_layout_select = $options_morphis['boxed_full_layout_select'];
	$select_skin = $options_morphis['select_skin'];
	
	$output .= "
	
	/* Body */
	body, span, p, #latest-blogs time, #team-member .team-member-info h6 { color: $body_font_color; }	
	body.dark-skin, body.light-skin { color: $body_font_color; }	

	/* Header */
	h1, h2, h3, h4, h5, h6, h1 span, h2 span, h3 span, h4 span, 
	h5 span, h6 span, strong, b, #latest-blogs h6, #services h6, 
	#latest-blogs time { color: $heading_font_color; }
	#latest-blogs .quote-pf-home h6 { border-left: 1px dashed $link_color; }

	/* Links */
	a, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, nav ul li a, nav ul > li a, 
	a.normal-link, a.read-more, a.read-this, a.more-link, .portfolio-data h6, 
	.centered-heading a:hover, #linky .boxy .masonry-title a:hover, 
	#latest-blogs p a:hover, .nav-previous a, .nav-next a, .entry-meta li a, 
	.twitter-feed li a, .comment a time, .comment-reply-link, .portfolio-nav li a, 
	#siteInfo p a, .entry-content p a:hover, #latest-blogs h6 a, #latest-blogs p a, 
	.inner-content p a, .blog3 p a, blockquote cite, .portfolio-meta dt, .entry-title { color: $link_color; }
	.light-skin nav ul li a, .light-skin nav ul > li a { color: $heading_font_color;  }
	a:hover, h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, 
	h6 a:hover, h1 span a:hover, h2 span a:hover, h3 span a:hover, 
	h4 span a:hover, h5 span a:hover, h6 span a:hover, ul.tabs li a.active, 
	.active-button, #call-out .highlight, nav ul li a:hover, 
	nav ul li a.current-page, .current-selected, nav li ul > li a:hover, 
	a.normal-link:hover, a.simple-link:hover, ul.simple-link a:hover, 
	.simple-link a:hover, span.orange, span.accent, #latest-blogs h6 a:hover, 
	.centered-list, .left-list, .filter a:hover, .current a, .filter a.current, 
	.active-sub-filter > a, .dark-skin .blog-post ul.meta1 li time .date-day, 
	.dark-skin .blog-post ul.meta1 li time .date-month, 
	.dark-skin .blog-post ul.meta1 li time .date-year, 
	#siteInfo p a:hover, .nav-previous a:hover, .nav-next a:hover, 
	#cancel-comment-reply-link, .entry-content p a, .inner-content p a:hover, 
	.chat-post-format:hover p strong, .entry-content p.status_pf:hover, 
	.entry-content.status p.status_pf:hover, .pagination span.current, 
	.pagination a:hover, .overlay h6:hover, a.read-more:hover, a.read-this:hover, 
	#latest-blogs h6 a:hover, .centered-heading a, #footer-wrapper a:hover, 
	.portfolio-data:hover h6, #latest-blogs p a:hover, #linky .boxy .masonry-title a, 
	.entry-meta li a:hover, .twitter-feed li a:hover, .comment a:hover time, 
	.comment-reply-link:hover, .portfolio-nav li a:hover, .blog3 p a:hover { color: $main_accent_hover_color; }
	#linky .boxy { border-bottom: 1px solid $main_accent_hover_color; }
	.light-skin #secondary .widget-title { border-top: 1px solid #eee; }
	.entry-content p.status_pf:hover, .entry-content.status p.status_pf:hover, 
	.chat-post-format:hover, .link-format:hover { border: 1px solid $main_accent_hover_color; }
	span.currency, span.periodic { color: #fff; }
	.dark-skin .entry-content p a:hover, .dark-skin #cancel-comment-reply-link:hover, 
	.dark-skin .inner-content p a:hover, .dark-skin .blog3 p a:hover, .portfolio-nav li a:hover { text-shadow: none; }
	.portfolio-nav li a:hover { border-bottom: none; }
	 .light-skin .blog-post ul.meta1 li time, .ei-slider-thumbs li.ei-slider-element { background: $main_accent_hover_color; }	 
	 #footer-wrapper, #footer-wrapper p, #footer-wrapper h6 { color: $footer_font_color; }

	";
	
	/* Section Patterns */
	if(!empty($section_pattern_upload)) {
		$output .= '
		#top-section, #tweet-strip, #siteInfo, #main-slider .divider  { background: url(' . $section_pattern_upload . ') repeat top left #333; } 
		';
	} else {
		if($section_pattern == '' || $section_pattern == 'none') {		
			$output .= '
			#top-section, #tweet-strip, #siteInfo, #main-slider .divider  { background: transparent; }
			';			
		} else {
			$output .= '
			#top-section, #tweet-strip, #siteInfo, #main-slider .divider  { background: url(\'' . get_template_directory_uri() . '/images/patterns/' . $section_pattern . '\') repeat top left #333; }
			';
		}
	}

	if(!empty($sub_footer_pattern_upload)) {
		/* Copyright - Sub-footer Patterns */
		$output .= '
		#siteInfo { background: url(' . $sub_footer_pattern_upload . ') repeat top left transparent; }
		';
	} else {
		if($sub_footer_pattern != 'none') {
		/* Copyright - Sub-footer Patterns */
		$output .= '
		#siteInfo { background: url(' . get_template_directory_uri() . '/images/patterns/' . $sub_footer_pattern . ') repeat top left transparent; }
		';
		}
	}

	if(!empty($sidebar_headings_pattern_upload)) {
		/* Sidebar Heading Pattern */
		$output .= '
		#secondary .widget-title, .portfolio-meta dt, .portfolio-launch {
			background: url(' . $sidebar_headings_pattern_upload . ') repeat top left transparent;
		}
		';
	} else {
		if(!empty($sidebar_headings_pattern)) {
			if($sidebar_headings_pattern != 'none') {
				/* Sidebar Heading Pattern */
				$output .= '
				#secondary .widget-title, .portfolio-meta dt, .portfolio-launch {
					background: url(' . get_template_directory_uri() . '/images/patterns/' . $sidebar_headings_pattern . ') repeat top left transparent;
				}
				';
			}
		}
	}

	$output .= "	
	blockquote p { font-family: Georgia; font-style: italic; }	
	";
			
	if($select_heading_font != 'Georgia' && $select_heading_font != 'Arial' && $select_heading_font != 'ArialBold' && empty($google_web_font_heading[1])) {
		/* Load Heading Font */
		$output .= "
		@font-face {
			font-family: '$select_heading_font';
			src: url('$template_dir/fonts/$select_heading_font/$select_heading_font-webfont.eot');
			src: url('$template_dir/fonts/$select_heading_font/$select_heading_font-webfont.eot?#iefix') format('embedded-opentype'),
				 url('$template_dir/fonts/$select_heading_font/$select_heading_font-webfont.woff') format('woff'),
				 url('$template_dir/fonts/$select_heading_font/$select_heading_font-webfont.ttf') format('truetype'),
				 url('$template_dir/fonts/$select_heading_font/$select_heading_font-webfont.svg#$select_heading_font') format('svg');
			font-weight: normal;
			font-style: normal;
		}
		";
	}
		
	if($select_heading_font == 'Blanch') {
		$text_transform_heading = 'uppercase';
	} else {
		$text_transform_heading = 'none';
	}

	//if heading font is Arial Bold
	if($select_heading_font == 'ArialBold') {		
		/* Heading Font */
		$output .= "
		h1, h2, h3, h4, h5, h6, .ei-title h3, .logo { font-family: 'Arial', sans-serif; font-weight: bold; text-transform: $text_transform_heading; }
		";
	} else {
		/* Heading Font */
		$output .= "
		h1, h2, h3, h4, h5, h6, .ei-title h3, .logo { font-family: '$select_heading_font'; $select_heading_font_style text-transform: $text_transform_heading; }
		";
	}
		
	if($select_main_body_font != 'Georgia' && $select_main_body_font != 'Arial' && empty($google_web_font_main_body[1])) {
		/* Load Main Body Font */
		$output .= "
		@font-face {
			font-family: '$select_main_body_font';
			src: url('$template_dir/fonts/$select_main_body_font/$select_main_body_font-webfont.eot');
			src: url('$template_dir/fonts/$select_main_body_font/$select_main_body_font-webfont.eot?#iefix') format('embedded-opentype'),
				 url('$template_dir/fonts/$select_main_body_font/$select_main_body_font-webfont.woff') format('woff'),
				 url('$template_dir/fonts/$select_main_body_font/$select_main_body_font-webfont.ttf') format('truetype'),
				 url('$template_dir/fonts/$select_main_body_font/$select_main_body_font-webfont.svg#$select_main_body_font') format('svg');
			font-weight: normal;
			font-style: normal;
		}
		";
	}

	/* Main Body Font */
	$output .= "
	body { font: 12px/1.667em '$select_main_body_font'; $select_main_body_font_style }
	.button, form { margin-bottom: 20px; }
		fieldset {	margin-bottom: 20px; }
		input[type=\"text\"],
		input[type=\"password\"],
		input[type=\"email\"],
		input[type=\"url\"],
		textarea,
		select { font-family: '$select_main_body_font', Georgia, serif; line-height: 1.667em; $select_main_body_font_style }
	";

	if($select_headline_main_font != 'Georgia' && $select_headline_main_font != 'Arial' && empty($google_web_font_headline[1])) {
		/* Load Headline Main Font */
		$output .= "
		@font-face {
			font-family: '$select_headline_main_font';
			src: url('$template_dir/fonts/$select_headline_main_font/$select_headline_main_font-webfont.eot');
			src: url('$template_dir/fonts/$select_headline_main_font/$select_headline_main_font-webfont.eot?#iefix') format('embedded-opentype'),
				 url('$template_dir/fonts/$select_headline_main_font/$select_headline_main_font-webfont.woff') format('woff'),
				 url('$template_dir/fonts/$select_headline_main_font/$select_headline_main_font-webfont.ttf') format('truetype'),
				 url('$template_dir/fonts/$select_headline_main_font/$select_headline_main_font-webfont.svg#$select_headline_main_font') format('svg');
			font-weight: normal;
			font-style: normal;
		}
		";
	}
		
		
	if($select_headline_main_font == 'Blanch') {
		$text_transform_headline = 'uppercase';
	} else {
		$text_transform_headline = 'none';
	}

	/* Heading Font */
	$output .= "
	#headline h1, .ei-title h2, #headline-page h1 { font-family: '$select_headline_main_font'; $select_headline_main_font_style text-transform: '$text_transform_headline'; }
	";
	
	// Boxed or Full Layout
	if($boxed_full_layout_select == 'boxed') {

		if(!empty($section_pattern_upload)) {
			$output .= "
			body { background: url('$section_pattern_upload') repeat top left #333; }
			#top-section { background: url('$section_pattern_upload') repeat top left #333; -webkit-box-shadow: none; -box-shadow: none; -moz-box-shadow: none; border: none; }
			";
		} else {
			if($section_pattern == 'none') {
				$output .= "
				body, #main-slider .bottom-spacer { background: trasparent!important; }
				#top-section { background: transparent; -webkit-box-shadow: none; -box-shadow: none; -moz-box-shadow: none; border: none; }
				";
			} else {
				$output .= "
				body { background: url('" . get_template_directory_uri() . "/images/patterns/$section_pattern') repeat top left #333; }
				#top-section { background: url('" . get_template_directory_uri() . "/images/patterns/$section_pattern') repeat top left #333; -webkit-box-shadow: none; -box-shadow: none; -moz-box-shadow: none; border: none; }
				";
			}
		}
	
		$output .= "
		header#branding { margin-top: 40px; }	
		#top-section .sixteen { padding-top: 15px; }	
		";
	
		if($select_skin == 'dark') {
		
			$main_bg = "background: url('$template_dir/images/patterns/tactile_noise.png') repeat top left #2e2e2e;";
			$output .= "
			#tweet-strip .container { background: #171717; background: rgba(0,0,0,0.1); }
			#wrapper { -webkit-box-shadow: 0px 0px 7px 0px rgba(0, 0, 0, 0.48); box-shadow: 0px 0px 7px 0px rgba(0, 0, 0, 0.48); -moz-box-shadow: 0px 0px 7px 0px rgba(0, 0, 0, 0.48); }
			body { background-color: #555; }
			";
			
			if( $options_morphis['option_disable_responsive_grid'] != '1' ) {			  
				$output .= "
				@media only screen and (max-width: 959px) {
						/* Header Navigation */
						header { margin-bottom: 60px; }		
				}
				 
				@media only screen and (min-width: 480px) and (max-width: 767px) {
						/* Header */
						header#branding { margin-bottom: 40px; }
						
				}

				@media only screen and (max-width: 479px) {
						/* Header */
						header#branding { margin-bottom: 30px; }			
						#carousel-pagination { top: 90px; }
				}
				";
			}
			
		} else {
		
			$main_bg = "background: #ffffff;" ;
			$output .= "
			#tweet-strip .container { background: #fff; background: rgba(255,255,255, 0.35); border-top: 1px solid #eee; border-bottom: 1px solid #eee; }
			#wrapper { -webkit-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.08); box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.08); -moz-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.08); }
			body { background-color: #fff; }
			";
			//if( !empty($options_morphis['option_disable_responsive_grid']) ) {
				if( $options_morphis['option_disable_responsive_grid'] != '1' ) {	
					$output .= "
					@media only screen and (min-width: 480px) and (max-width: 767px) {
							/* Header */
							header { margin-bottom: 50px; border-bottom: none; }
							header#branding { border-bottom: none; margin-bottom: 0; }		
					}

					@media only screen and (max-width: 848px) and (min-width: 768px) {
							header#branding { border-bottom: none; }
					}

					@media only screen and (max-width: 479px) {
							/* Header */
							header { margin-bottom: 50px; border-bottom: none; }	
							header#branding { border-bottom: none; margin-bottom: 0; }
							#carousel-pagination { top: 90px; }
					}
					";
				}
			//}		
		
		}

		$output .= "
		.container { background: #fff; padding: 0 40px; $main_bg }
		#footer-wrapper { 
			background: transparent; 
			padding: 0; 
			border: none; 
			-webkit-box-shadow: none; 
			-box-shadow: none; 
			-moz-box-shadow: none; 
			outline-color: transparent;  
			text-shadow: none; 
			color: $body_font_color;  
		}	
		#footer-wrapper h6 { color: $heading_font_color; }
		#footer-wrapper a, #siteInfo a { color: $link_color; }
		#siteInfo a:hover { color: $main_accent_hover_color; }
		#footer-wrapper .container { padding-top: 60px; }
		.page-template-template-home-php #main { padding-top: 80px; }	
		#main-slider { margin-bottom: 0; padding-bottom: 0; background: transparent; }
		#main-slider .container, #main-slider .bottom-spacer { padding-bottom: 0; }	
		#main-slider .divider { display: none; }
		#tweet-strip { border: none; -webkit-box-shadow: none; -box-shadow: none; -moz-box-shadow: none; outline-color: transparent; }
		#tweet-strip .container { min-height: 60px; }
		#tweet-strip .tweet-icon { left: 40px; }
		#tweet-strip .container {  }
		#tweet-strip .tweet-icon { top: none; }
		#siteInfo { background: transparent; margin-bottom: 100px; -webkit-box-shadow: none; -box-shadow: none; -moz-box-shadow: none; border: none; }
		#siteInfo .container { padding-bottom: 20px; color: $body_font_color; text-shadow: none; }
		#wrapper { position: relative; padding: 0; width: 1040px; margin: 60px auto auto;  }
		";
	
		//if( !empty( $options_morphis['option_disable_responsive_grid'] ) ) {
			if( $options_morphis['option_disable_responsive_grid'] != '1' ) {
			
				$output .= "
				/* Smaller than standard 960 (devices and browsers) */
				
				@media only screen and (min-width: 959px) and (max-width: 1040px) {
				  
					#wrapper { width: 848px; }	
					.container { width: 768px; }
					.container .column,
					.container .columns { 
						margin-left: 10px; 
						margin-right: 10px;  
					}
					.column.alpha, 
					.columns.alpha { 
						margin-left: 0; 
						margin-right: 10px; 
					}
					.column.omega, 
					.columns.omega { 
						margin-left: 10px; 
						margin-right: 0;
					}
					.container .one.column { width: 28px; }
					.container .two.columns { width: 76px; }
					.container .three.columns { width: 124px; }
					.container .four.columns { width: 172px; }
					.container .five.columns { width: 220px; }
					.container .six.columns { width: 268px; }
					.container .seven.columns { width: 316px; }
					.container .eight.columns { width: 364px; }
					.container .nine.columns { width: 412px; }
					.container .ten.columns { width: 460px; }
					.container .eleven.columns { width: 508px; }
					.container .twelve.columns { width: 556px; }
					.container .thirteen.columns { width: 604px; }
					.container .fourteen.columns { width: 652px; }
					.container .fifteen.columns { width: 700px; }
					.container .sixteen.columns { width: 748px; }
					.container .one-third.column { width: 236px; }
					.container .two-thirds.column { width: 492px; }

					/* Offsets */
					.container .offset-by-one { padding-left: 48px; }
					.container .offset-by-two { padding-left: 96px; }
					.container .offset-by-three { padding-left: 144px; }
					.container .offset-by-four { padding-left: 192px; }
					.container .offset-by-five { padding-left: 240px; }
					.container .offset-by-six { padding-left: 288px; }
					.container .offset-by-seven { padding-left: 336px; }
					.container .offset-by-eight { padding-left: 348px; }
					.container .offset-by-nine { padding-left: 432px; }
					.container .offset-by-ten { padding-left: 480px; }
					.container .offset-by-eleven { padding-left: 528px; }
					.container .offset-by-twelve { padding-left: 576px; }
					.container .offset-by-thirteen { padding-left: 624px; }
					.container .offset-by-fourteen { padding-left: 672px; }
					.container .offset-by-fifteen { padding-left: 720px; }
						
					#services h6, 
					#services p, 
					#services ul li { text-align: left; }
					
					/* Main Home Page Slider */
					#main-slider  .slides-carousel .slide h3{ font-size: 30px; }			
					#main-slider  .slides-carousel .slide p { font-size: 20px; }			
					#main-slider  .slides-carousel .slide a {
						font-size: 15px; 
						margin-left: -6em;
					}
							
					/* Recent Works */			
					#carousel-portfolio section { padding: 0 10px; }			
					/* Normal Portfolio with 4 columns */
					.portfolio.normal li.portfolio-data:nth-child(4n) { margin-right: 0; }			
					.portfolio.normal img { 
						width: 100%; 
						height: auto;
					}
					
					/* Portfolio layouts */
					#portfolio-2-columns .portfolio.two-columns img, 
					#portfolio-3-columns .portfolio.three-columns img, 
					#portfolio-w-sidebar .portfolio.with-sidebar img { 
						width: 100%; 
						height: auto;
					}
					
					.overlay img { height: auto; }			
					.blog-post ul.meta1 li time { 
						width: 94px;
						height: 94px;
					}			
					.blog-post ul.meta1 li time .date-month {
						font-size: 14px;
					}			
					.blog-post ul.meta1 li time .date-day {
						font-size: 35px;	
						margin-bottom: -10px;
						margin-top: -10px;
					}			
					.blog-post ul.meta1 li time .date-year {
						font-size: 14px;		
					}
				}
				
				/* Smaller than standard 960 (devices and browsers) */  

				/* Tablet Portrait size to standard 960 (devices and browsers) */
				@media only screen and (min-width: 848px) and (max-width: 959px) {
					#wrapper { width: 848px; }				
				}
				  
				/* All Mobile Sizes (devices and browser) */
				@media only screen and (max-width: 767px) {
					#wrapper { width: 380px; }
				}	  
				  
				@media only screen and (min-width: 768px) and (max-width: 848px) {

					#wrapper { width: 500px; }
					.container { width: 420px; }
					.container .columns, 
					.container .column { margin: 0; }
					.container .one.column,
					.container .two.columns,
					.container .three.columns,
					.container .four.columns,
					.container .five.columns,
					.container .six.columns,
					.container .seven.columns,
					.container .eight.columns,
					.container .nine.columns,
					.container .ten.columns,
					.container .eleven.columns,
					.container .twelve.columns,
					.container .thirteen.columns,
					.container .fourteen.columns,
					.container .fifteen.columns,
					.container .sixteen.columns,
					.container .one-third.column,
					.container .two-thirds.column { width: 420px; }		
							
					.logo { float: none; margin: 0 auto; text-align: center; }
					#logo img { display: inline; float: none; text-align: center; }
					#branding .container-frame { margin-bottom: 40px; }
					#branding nav ul { display: none; }
					#branding nav select { display: block; }

					/* Social Icons */		
					#top-section .social-container { text-align: center; }
					#top-section .social-icons { margin: 15px 0; display: block; list-style-type: none; list-style: none; line-height: 33px; width: 100%; }
					#top-section .social-icons li { 
						margin-top: 3px; 
						margin-bottom: 3px; 
						display: inline-block;
						float: none;
					}

					#nav-container .container-frame { margin-bottom: 50px; }

					/* Drop-down Navigation */
					nav#access select { margin-top: 0; }

					/* Header Main */
					header#branding { margin-top: 40px; margin-bottom: 40px; }

					/* Services Section */
					#services .columns, #services .column { margin-bottom: 20px; }

					#services h6, #services p, #services ul li { text-align: left; }

					.headquarter-widget p, .textwidget { margin-bottom: 40px; }

					/* Navigation */
					nav ul { display: none; }

					nav select { 
						display: block; 
						margin: 80px 0 0;
						width: 100%; 
					}

					nav { margin-top: 60px; }

					/* Main Home Page Slider */
					#main-slider  .slides-carousel .slide h3{ font-size: 20px; }
					#main-slider  .slides-carousel .slide p { font-size: 14px; }
					#main-slider  .slides-carousel .slide a { 
						font-size: 12px; 
						margin-left: -4.5em; 
						min-width: 100px; 
					}

					/* blog */
					.entry-meta.meta1 { margin-bottom: 20px; }
					.entry-title { text-align: center; }
					.single-post-meta { 
						margin-bottom: 20px; 
						text-align: center; 		
					}

					.single-post-meta span.postformat-icon { display: none; }
					.blog-post .post { padding-bottom: 0; }
					#nav-single { margin: 0 0 40px; }

					/* flickr secondary sidebar */
					#secondary .widget .flickr-widget li:nth-child(3n) { margin-right: 10px; }
					#secondary .widget .flickr-widget li:nth-child(7n) { margin-right: 0; }		

					/* back to top link */
					a.to-top { display: none; }

					/* Sidebar */
					.sidebar-borders { padding-left: 0; }

					.sidebar-borders-left { padding-right: 0; }

					/* Recent Works */		

					#carousel-portfolio section { padding: 0 10px; } 
					#carousel-portfolio .icon-view { display: none; }
					#carousel-portfolio .icon-link { display: none; }
					#carousel-portfolio h5 { letter-spacing:0; }
					#headline h1, #headline-page h1 { font-size: 26px; }
					#headline h2, #headline-page h2 { font-size: 17px; }
					#headline p, 
					#headline-page p { 
						font-size: 14px; 
						margin-left: 0; 
						margin-right: 0; 
						text-align: center; 
					}

					/* Latest Blogs */
					#latest-blogs { text-align: center; }
					#latest-blogs figure { margin-bottom: 20px; padding: 0 100px; }
					.blog-post ul.meta1 li time { 
						width: 120px;
						height: 120px;
					}
					.blog-post ul.meta1 li time .date-month {
						font-size: 14px;
					}
					.blog-post ul.meta1 li time .date-day {
						font-size: 54px;	
						margin-bottom: 8px;
						margin-top: none;
					}
					.blog-post ul.meta1 li time .date-year {
						font-size: 14px;		
					}
					
					/* Normal Portfolio with 4 columns */
					.portfolio.normal li.portfolio-data:nth-child(2n) { margin-right: 0; }
					.portfolio.normal img { 
						width: 100%; 
						height: auto;
					}

					/* Portfolio layouts */
					#portfolio-2-columns .portfolio.two-columns img, 
					#portfolio-3-columns .portfolio.three-columns img, 
					#portfolio-w-sidebar .portfolio.with-sidebar img { 
						width: 100%; 
						height: auto;
					}

					.portfolio-client { text-align: center; }				
					.sidebar-borders {
						margin-left: 0;
					}
					.sidebar-borders-left {
						margin-right: 0;
					}

				}
				  
				  
				/* Mobile Landscape Size to Tablet Portrait (devices and browsers) */
				@media only screen and (min-width: 480px) and (max-width: 767px) {
					#wrapper { width: 500px; }
				}

				@media only screen and (min-width: 479px) and (max-width: 500px) {
					#wrapper { width: 380px; }
					.container { width: 300px; }
					.columns, 
					.column { margin: 0; }

					.container .one.column,
					.container .two.columns,
					.container .three.columns,
					.container .four.columns,
					.container .five.columns,
					.container .six.columns,
					.container .seven.columns,
					.container .eight.columns,
					.container .nine.columns,
					.container .ten.columns,
					.container .eleven.columns,
					.container .twelve.columns,
					.container .thirteen.columns,
					.container .fourteen.columns,
					.container .fifteen.columns,
					.container .sixteen.columns,
					.container .one-third.column,
					.container .two-thirds.column  { width: 300px; }

					/* Offsets */
					.container .offset-by-one,
					.container .offset-by-two,
					.container .offset-by-three,
					.container .offset-by-four,
					.container .offset-by-five,
					.container .offset-by-six,
					.container .offset-by-seven,
					.container .offset-by-eight,
					.container .offset-by-nine,
					.container .offset-by-ten,
					.container .offset-by-eleven,
					.container .offset-by-twelve,
					.container .offset-by-thirteen,
					.container .offset-by-fourteen,
					.container .offset-by-fifteen { padding-left: 0; }

					.logo { float: none; margin: 0 auto; text-align: center; }

					#logo img { display: inline; float: none; text-align: center; }

					#branding .container-frame { margin-bottom: 20px; }

					#branding nav ul { display: none; }

					#branding nav select { display: block; }

					/* Social Icons */
					#top-section .social-icons { margin: 15px 0; }
					#top-section .social-icons li { 
						margin-top: 3px; 
						margin-bottom: 3px; 
					}

					#nav-container .container-frame { margin-bottom: 30px; }

					/* Drop-down Navigation */
					nav#access select { margin-top: 0; }

					/* Header Main */
					header#branding { margin-top: 40px; }

					/* Services Section */
					#services .columns, 
					#services .column { margin-bottom: 20px; } 

					#services h5, 
					#services p, 
					#services ul li { text-align: left; }

					/* blog */
					.entry-meta.meta1 { margin-bottom: 20px; }

					.entry-title { text-align: center; }	

					.single-post-meta { 
						text-align: center; 
						margin-bottom: 20px; 
					}

					.single-post-meta span.postformat-icon { display: none; }

					.blog-post .post { padding-bottom: 0; }

					#nav-single { margin: 0 0 40px; }

					/* flickr secondary sidebar */
					#secondary .widget .flickr-widget li:nth-child(3n) { margin-right: 10px; }

					#secondary .widget .flickr-widget li:nth-child(5n) { margin-right: 0; }

					.dark-skin #secondary .container-frame { margin-bottom: 20px; }

					#secondary .widget_search input { margin-bottom: 0; }

					.headquarter-widget p, .textwidget { margin-bottom: 40px; }

					/* Navigation */
					.menu { display: none; }

					nav select { 
						display: block; 
						width: 100%;
					}

					nav select { 
						display: block; 
						margin: 80px 0 0;
						width: 100%; 	
					}

					nav { margin-top: 60px; }

					/* Header */
					header { 
						border-bottom: none; 
						margin-bottom: 30px; 		
					}

					/* Main Home Page Slider */
					#main-slider  .slides-carousel .slide h3{ display: none; }

					#main-slider  .slides-carousel .slide p { display: none; }

					#main-slider  .slides-carousel .slide a { display: none; }
						
					#services h6, 
					#services p, 
					#services ul li { text-align: left; }

					/* back to top link */
					a.to-top { display: none; }

					/* Headline */
					#headline { padding-bottom: 0px; }

					#headline h1, #headline-page h1 { font-size: 26px; }

					#headline h2, #headline-page h2 { font-size: 17px; }

					#headline p, #headline-page p { 		
						margin-left: 0; 
						margin-right: 0; 
						margin-bottom: 40px;
						text-align: center; 
					}

					/* Recent Works */		

					#carousel-portfolio section { padding: 0 10px; } 

					#carousel-portfolio section { padding: 0 10px; } 

					#carousel-portfolio .icon-view { display: none; }

					#carousel-portfolio .icon-link { display: none; }

					#carousel-portfolio h5 { letter-spacing:0; }

					/* Latest Blogs */
					#latest-blogs { text-align: center; }

					#latest-blogs figure { margin-bottom: 20px; }

					.blog-post ul.meta1 li time { 
						width: 120px;
						height: 120px;
					}

					.blog-post ul.meta1 li time .date-month {
						font-size: 14px;
					}

					.blog-post ul.meta1 li time .date-day {
						font-size: 54px;	
						margin-bottom: 8px;
						margin-top: none;
					}

					.blog-post ul.meta1 li time .date-year {
						font-size: 14px;		
					}

					/* Sidebar */
					.sidebar-borders { padding-left: 0; }

					.sidebar-borders-left { padding-right: 0; }
							
					/* Normal Portfolio with 4 columns */
					.portfolio.normal li.portfolio-data { margin-right: 0; }

					.portfolio.normal img { 
						width: 100%; 
						height: auto;
					}

					/* Portfolio layouts */
					#portfolio-2-columns .portfolio.two-columns img, 
					#portfolio-3-columns .portfolio.three-columns img, 
					#portfolio-w-sidebar .portfolio.with-sidebar img { 
						width: 100%; 
						height: auto;
					}

					#portfolio-w-sidebar .portfolio.with-sidebar li.portfolio-data:nth-child(3n) { margin-right: 0; }

					.portfolio-client { text-align: center; }

					 .sidebar-borders {
						margin-left: 0;
					}
					.sidebar-borders-left {
						margin-right: 0;
					}

				}

				  
				@media only screen and (max-width: 479px) {
					.container { width: 220px; }
					#wrapper { width: 300px; margin: 60px auto; }
					.columns, 
					.column { margin: 0; }
					
					.container .one.column,
					.container .two.columns,
					.container .three.columns,
					.container .four.columns,
					.container .five.columns,
					.container .six.columns,
					.container .seven.columns,
					.container .eight.columns,
					.container .nine.columns,
					.container .ten.columns,
					.container .eleven.columns,
					.container .twelve.columns,
					.container .thirteen.columns,
					.container .fourteen.columns,
					.container .fifteen.columns,
					.container .sixteen.columns,
					.container .one-third.column,
					.container .two-thirds.column  { width: 220px; }

					/* Offsets */
					.container .offset-by-one,
					.container .offset-by-two,
					.container .offset-by-three,
					.container .offset-by-four,
					.container .offset-by-five,
					.container .offset-by-six,
					.container .offset-by-seven,
					.container .offset-by-eight,
					.container .offset-by-nine,
					.container .offset-by-ten,
					.container .offset-by-eleven,
					.container .offset-by-twelve,
					.container .offset-by-thirteen,
					.container .offset-by-fourteen,
					.container .offset-by-fifteen { padding-left: 0; }
					
				}
				";
			}
		//}
			
		$output .= "
		#masonry #linky.container { 
			padding-right: 0; 
			padding-left: 0; 
		}
		";
		
	}

	//full bg image
	$output .= " /* Page ID = $page_id */";
	 // get image url
	$full_bg_image_url = get_post_meta($page_id,'_cmb_unique_full_bg_image',TRUE);
	$toggle_full_bg_tile = get_post_meta($page_id,'_cmb_toggle_full_bg_tile',TRUE);
	$bg_repeat = '';
	$bg_size = '';
	
	if($toggle_full_bg_tile == 'on') {
		$bg_repeat = 'repeat ';
		$bg_size = '';
	} else {
		$bg_repeat = 'center center fixed no-repeat;  -moz-background-size: cover;
			  background-size: cover; ';
		$bg_size = '-moz-background-size: 1024px 768px;
				background-size: 1024px 768px; ';
	}

	if($boxed_full_layout_select == 'boxed') {
		if( $full_bg_image_url != '') {
			$output .="
				body {
					background: #000 url('$full_bg_image_url') $bg_repeat;		 
				}
				@media only all and (max-width: 1024px) and (max-height: 768px) {
				  body { $bg_size; }
				}
			";
		}
	} elseif($boxed_full_layout_select == 'full') {
		if( $full_bg_image_url != '') {
			$output .= "
			#top-section, #tweet-strip, #siteInfo, #main-slider .divider, #siteInfo {
				background: transparent url('$full_bg_image_url') $bg_repeat;
			}
			@media only all and (max-width: 1024px) and (max-height: 768px) {
			  #top-section, #tweet-strip, #siteInfo, #main-slider .divider, #siteInfo {	$bg_size; }
			}
			";
		}
	}
	
	$output .= "
	.single-portfolio #main { padding-top: 0; }
	";
		
	// fix for aligned images on mobile devices
	//if( !empty( $options_morphis['option_disable_responsive_grid'] ) ) {
		if( $options_morphis['option_disable_responsive_grid'] != '1' ) {
			$output .= "
			@media only screen and (min-width: 320px) and (max-width: 767px) {	
				.left-align-image img, .right-align-image img, .center-align-image img, .no-align-image img,
				.left-align-image, .right-align-image, .center-align-image, .no-align-image,
				.alignnone, .alignleft, .alignright, .aligncenter, .alignnone img, .alignleft img, .alignright img, .aligncenter img {
					position: relative;
					display: block;
					width: 100%;
					height: auto;
					margin: 0 0 20px 0;
					padding: 0;
				}
				
				div.center-align-container[style], div.no-align-container[style], div.wp-caption[style] {
					margin: 0!important;
					padding: 0!important;
					display: block!important;
					width: 100%!important;
				}
				
				div.wp-caption[style] {
					padding: 10px!important;
				}
				
				.left-align-image, .right-align-image, .center-align-image, .no-align-image,
				.wp-caption.alignnone, .wp-caption.alignleft, .wp-caption.alignright, .wp-caption.aligncenter {
					padding: 10px;
				}
				
				.wp-caption.alignleft, .wp-caption.aligncenter, .wp-caption.alignright {
					padding-right: 10px;
				}
			}
			";
		}
	//}
	
		
	// wooCommerce 
	$output .= "
	ul.products li.product .onsale-wrap,
	.single-default-page .product .onsale-wrap {
		background: $main_accent_hover_color; 
	}

	ul.products li.product a:hover h3 {
		color: $main_accent_hover_color;
		-webkit-transition: all 0.2s linear;
		-moz-transition: all 0.2s linear;
		-o-transition: all 0.2s linear;
		transition: all 0.2s linear;
	}

	ul.products li.product ins .amount,
	.single-default-page .product ins .amount {
		color: $main_accent_hover_color;
	}

	table.variations .reset_variations {
		background: $link_color;
		color: #fff;
	}

	table.variations .reset_variations:hover {
		background: $main_accent_hover_color;
		color: #fff;
	}

	.product .single_variation_wrap .variations_button .qty:focus {
		outline-color: $main_accent_hover_color;
		border: 1px solid transparent;
	}

	/* woocommerce tabs */

	.woocommerce_tabs ul.tabs li a:hover,
	.woocommerce_tabs ul.tabs li.active a,
	.woocommerce-tabs ul.tabs li a:hover,
	.woocommerce-tabs ul.tabs li.active a {
		color: $main_accent_hover_color;
	}

	.woocommerce_tabs ul.tabs li.active:before,
	.woocommerce-tabs ul.tabs li.active:before {
		background: $main_accent_hover_color;
	}

	.woocommerce_tabs ul.tabs li.active a,
	.woocommerce-tabs ul.tabs li.active a {
		border-top-color: $main_accent_hover_color;
	}

	/* WooCOmmerce Messages */
	.woocommerce_message,
	.woocommerce-message {
		border-color: $main_accent_hover_color;
	}
	.woocommerce_message:before,
	.woocommerce-message:before {
		color: $main_accent_hover_color;
	}

	.woocommerce_message .button,
	.woocommerce-message .button {
		background: transparent;
		color: $main_accent_hover_color!important;
	}

	.woocommerce_message .button:hover,
	.woocommerce-message .button:hover {
		color: $link_color!important;
	}

	.woocommerce_message,
	.woocommerce_info,
	.woocommerce_error,
	.woocommerce-message,
	.woocommerce-info,
	.woocommerce-error {
	  background: transparent;
	  border: 1px solid $main_accent_hover_color;
	}
	.woocommerce_message:before,
	.woocommerce_info:before,
	.woocommerce_error:before,
	.woocommerce-message:before,
	.woocommerce-info:before,
	.woocommerce-error:before {
	  color: $main_accent_hover_color;
	}

	 a.remove:hover {
		background: $main_accent_hover_color;
		color: #fff;
	}


	.woocommerce_error {
	  border-color: $main_accent_hover_color;
	}

	.woocommerce_error:before {
	  color: $main_accent_hover_color;
	}

	ul.order_details li strong, 
	ul.order_details li span {
		color: $main_accent_hover_color;
	}

	.dark-skin ul.products li.product a:hover img, 
	.dark-skin .product .images:hover {
		background: $main_accent_hover_color;
	}

	.dark-skin .widget_product_search input {
		color: $main_accent_hover_color;
	}

	.dark-skin .woocommerce_tabs ul.tabs li.active a,
	.dark-skin .woocommerce-tabs ul.tabs li.active a,
	.dark-skin input.minus, 
	.dark-skin input.plus,
	.dark-skin.woocommerce-cart .cart td.product-quantity .quantity input.minus,
	.dark-skin.woocommerce-cart .cart td.product-quantity .quantity input.plus {
		color: $main_accent_hover_color;
	}

	.dark-skin table.variations .reset_variations {
		color: #333;
	}
	";

	/* Font Sizes */
	$font_size_logo_branding = $options_morphis['font_size_logo_branding'];
	$font_size_body = $options_morphis['font_size_body'];
	$font_size_h1 = $options_morphis['font_size_h1'];
	$font_size_h2 = $options_morphis['font_size_h2'];
	$font_size_h3 = $options_morphis['font_size_h3'];
	$font_size_h4 = $options_morphis['font_size_h4'];
	$font_size_h5 = $options_morphis['font_size_h5'];
	$font_size_h6 = $options_morphis['font_size_h6'];
	$font_size_menu = $options_morphis['font_size_menu'];
	$font_size_centered_heading = $options_morphis['font_size_centered_heading'];
	$font_size_headline_h1 = $options_morphis['font_size_headline_h1'];
	$font_size_headline_h2 = $options_morphis['font_size_headline_h2'];
	$font_size_page_post_content = $options_morphis['font_size_page_post_content'];
		
	if(!empty($font_size_logo_branding)) {
		$output .= "
		/* Logo Branding */
		header .logo a { font-size: $font_size_logo_branding; }
		";
	}
	
	if(!empty($font_size_body)) {
		$output .="
		/* Body */
		body, p, a.button, button, input[type=\"submit\"], input[type=\"reset\"], input[type=\"button\"], ul.tabs li a,
		#accordion .accordion-button a, label, legend, label span, legend span, blockquote cite, #linky .boxy .masonry-title,
		#linky .boxy p, .centered-list, .sidebar-right, .sidebar-left, .sidebar-right p, .sidebar-left p,
		#siteInfo p, .jta-tweet-attributes, .jta-tweet-actions, .blog-post .comment-form-wrapper input,
		.blog-post .comment-form-wrapper label, #cancel-comment-reply-link, .pagination li,
		.entry-meta.meta1, .tagcloud a  { font-size: $font_size_body; }
		";
	}
	
	if(!empty($font_size_h1)) {
		$output .="
		h1 { font-size: $font_size_h1; }
		";
	}

	if(!empty($font_size_h2)) {
		$output .="
		h2 { font-size: $font_size_h2; }
		";
	}

	if(!empty($font_size_h3)) {
		$output .="
		h3 { font-size: $font_size_h3; }
		";
	}

	if(!empty($font_size_h4)) {
		$output .="
		h4 { font-size: $font_size_h4; }
		";
	}

	if(!empty($font_size_h5)) {
		$output .="
		h5 { font-size: $font_size_h5; }
		";
	}

	if(!empty($font_size_h6)) {
		$output .="
		h6, #secondary .widget-title { font-size: $font_size_h6; }
		";
	}

	if(!empty($font_size_menu)) {
		$output .="
		/* Menu */
		#nav-container nav ul > li a, #nav-container nav select, #nav-container nav ul li ul > li a { font-size: $font_size_menu; }
		";
	}

	if(!empty($font_size_centered_heading)) {
		$output .="
		/* Centered Heading */
		.centered-heading { font-size: $font_size_centered_heading; }
		";
	}

	if(!empty($font_size_headline_h1)) {
		$output .="
		#headline h1 { font-size: $font_size_headline_h1; }
		";
	}

	if(!empty($font_size_headline_h2)) {
		$output .="
		#headline h2 { font-size: $font_size_headline_h2; }
		";
	}

	if(!empty($font_size_page_post_content)) {
		$output .="
		/* Page/Post Content */
		.entry-content p, .entry-content { font-size: $font_size_page_post_content; }
		";
	}
	
	// Custom CSS
	/* Custom CSS code (if theres any) */
	$output .= "
	" .	html_entity_decode( $options_morphis['custom_css_code'] ) ."
	";
	
	return $output;
}

?>