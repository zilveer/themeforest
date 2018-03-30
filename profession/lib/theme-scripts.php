<?php
function px_register_color_skin()
{
	wp_register_style('skin1', THEME_CSS_URI . '/color/gray.css', false, '1.0');
	wp_register_style('skin2', THEME_CSS_URI . '/color/green.css', false, '1.0');
	wp_register_style('skin3', THEME_CSS_URI . '/color/brown.css', false, '1.0');
	wp_register_style('skin4', THEME_CSS_URI . '/color/yellow.css', false, '1.0');
	wp_register_style('skin5', THEME_CSS_URI . '/color/orange.css', false, '1.0');
	wp_register_style('skin6', THEME_CSS_URI . '/color/red.css', false, '1.0');
	wp_register_style('skin7', THEME_CSS_URI . '/color/purple.css', false, '1.0');
	wp_register_style('skin8', THEME_CSS_URI . '/color/blue.css', false, '1.0');
	wp_register_style('skin9', THEME_CSS_URI . '/color/bgray.css', false, '1.0');
	wp_register_style('skin10', THEME_CSS_URI . '/color/bgreen.css', false, '1.0');
	wp_register_style('skin11', THEME_CSS_URI . '/color/bbrown.css', false, '1.0');
	wp_register_style('skin12', THEME_CSS_URI . '/color/byellow.css', false, '1.0');
	wp_register_style('skin13', THEME_CSS_URI . '/color/borange.css', false, '1.0');
	wp_register_style('skin14', THEME_CSS_URI . '/color/bred.css', false, '1.0');
	wp_register_style('skin15', THEME_CSS_URI . '/color/bpurple.css', false, '1.0');
	wp_register_style('skin16', THEME_CSS_URI . '/color/bblue.css', false, '1.0');
}

//Select theme skin
function px_theme_skin_color() 
{
	$color = opt('theme_skin_color');
	
	if($color == 'skin_1')
		wp_enqueue_style('skin1');
	else if($color == 'skin_2')
		wp_enqueue_style('skin2');
	else if($color == 'skin_3')
		wp_enqueue_style('skin3');
	else if($color == 'skin_4')
		wp_enqueue_style('skin4');
	else if($color == 'skin_5')
		wp_enqueue_style('skin5');
	else if($color == 'skin_6')
		wp_enqueue_style('skin6');
	else if($color == 'skin_7')
		wp_enqueue_style('skin7');
	else if($color == 'skin_8')
		wp_enqueue_style('skin8');	
	else if($color == 'skin_9')
		wp_enqueue_style('skin9');
	else if($color == 'skin_10')
		wp_enqueue_style('skin10');
	else if($color == 'skin_11')
		wp_enqueue_style('skin11');
	else if($color == 'skin_12')
		wp_enqueue_style('skin12');
	else if($color == 'skin_13')
		wp_enqueue_style('skin13');
	else if($color == 'skin_14')
		wp_enqueue_style('skin14');
	else if($color == 'skin_15')
		wp_enqueue_style('skin15');	
	else if($color == 'skin_16')
		wp_enqueue_style('skin16');	
}

function px_theme_scripts() {

	//Register Styles
	wp_enqueue_style('style', get_bloginfo('stylesheet_url'), false, THEME_VERSION);

	if(opt('responsive_layout')) {
		wp_enqueue_style('responsive-style', THEME_CSS_URI . '/responsive.css', false, THEME_VERSION);
	}
	
	 if((!is_page_template('template-home.php'))&& opt('responsive_layout'))
    {
        wp_enqueue_style('blog-responsive-style', THEME_CSS_URI . '/blog-responsive.css', false, THEME_VERSION);
    }
	
	if (!is_admin()) {
		wp_enqueue_script('jquery');
	}
	
	
	wp_register_style('isotope', THEME_CSS_URI. '/isotope.css', false, '1.5.2', 'screen');
	wp_register_style('blogcss', THEME_CSS_URI. '/blog.css', false, '1.0', 'screen');
	
	//Register scripts
	wp_register_script( 'idTabs', THEME_JS_URI . '/jquery.idTabs.min.js', false, '2.2', true );
	
	// flex Slider 
	wp_register_script( 'flex-slider', THEME_JS_URI . '/jquery.flexslider-min.js', false, '2.2.2', true );
	wp_register_style('flex-slider', THEME_CSS_URI. '/flexslider.css', false, '2.2.2', 'screen');

	
	wp_register_script( 'magnific-popup', THEME_JS_URI . '/jquery.magnific-popup.min.js', false, '0.8.8', true );
	wp_register_style('magnific-popup', THEME_CSS_URI. '/magnific-popup.css', false, '0.8.8', 'screen');
		
	wp_register_script( 'superfish', THEME_JS_URI . '/superfish.js', false, '1.6.7', true );
	
	wp_register_script( 'isotope', THEME_JS_URI . '/jquery.isotope.min.js', false, '1.5.19', true );
	
	wp_register_script( 'scrollTo', THEME_JS_URI . '/jquery.scrollTo.min.js', false, '1.4.6', true );
 
  	wp_register_script( 'idTabs', THEME_JS_URI . '/jquery.idTabs.min.js', false, '3.1.2', true );
	
	wp_register_script( 'audioscript', THEME_JS_URI . '/audio.js', false, '3.1.2', true );	
	
	wp_register_script( 'mousewheel', THEME_JS_URI . '/jquery.mousewheel.min.js', false, '3.0.6', true );
	wp_register_script( 'nicescroll', THEME_JS_URI . '/jquery.nicescroll.js', false, '3.1.4', true );
	
	wp_register_style('mCustomScrollbar', THEME_CSS_URI. '/jquery.mCustomScrollbar.css', false, '1.0.0', 'screen');
	wp_register_script( 'mCustomScrollbar', THEME_JS_URI . '/jquery.mCustomScrollbar.concat.min.js', false, '1.0.0', true );
	
	wp_register_script( 'jscrollpane', THEME_JS_URI . '/jquery.jscrollpane.min.js', false, '2.0.16', true );
	wp_register_style('jscrollpane', THEME_CSS_URI. '/jquery.jscrollpane.css', false, '2.0.16', 'screen');

	wp_register_script( 'carouFredSel', THEME_JS_URI . '/jquery.carouFredSel-6.2.1-packed.js', false,'6.2.1',true );

	wp_register_script( 'jquery-easing', THEME_JS_URI . '/jquery.easing.1.3.js', false, '1.3', true );
	wp_register_script( 'widgets', THEME_JS_URI . '/widgets.js', false, THEME_VERSION, true );
	wp_register_script( 'easy-pie-chart', THEME_JS_URI . '/jquery.easy-pie-chart.js', false,'1.6.2',true );	
	wp_register_style('easy-pie-chart', THEME_CSS_URI. '/jquery.easy-pie-chart.css', false, '1.6.2', 'screen');
	wp_register_script( 'animate-enhanced', THEME_JS_URI . '/jquery.animate-enhanced.min.js',false, '1.0', true);

	
	wp_register_script( 'gmap3', THEME_JS_URI . '/gmap3.js', false,'5.1.1',true );
	
	//Enqueue default Scripts
	wp_enqueue_script('superfish');
		
	//Isotope Plugin
	wp_enqueue_style('isotope');
	wp_enqueue_script('isotope');

	wp_enqueue_script('magnific-popup');
	wp_enqueue_style('magnific-popup');

	//Flex Slider
	wp_enqueue_script('flex-slider');
	wp_enqueue_style('flex-slider');
	
	wp_enqueue_script('mousewheel');
	wp_enqueue_script('nicescroll');
	wp_enqueue_style('mCustomScrollbar');
	wp_enqueue_script('mCustomScrollbar');
	
	wp_enqueue_style('jscrollpane');
	wp_enqueue_script('jscrollpane');
	
	wp_enqueue_script('scrollTo');
	wp_enqueue_script('idTabs');
	wp_enqueue_script('jquery-easing');
	wp_enqueue_script('audioscript');

	wp_enqueue_script('widgets');
	wp_enqueue_script('easy-pie-chart');
	wp_enqueue_style('easy-pie-chart');
	wp_enqueue_script('carouFredSel');
	wp_enqueue_script('animate-enhanced');
    
	wp_enqueue_script('gmap3');
	
	//Include page specific scripts
	if( ! is_page_template('template-home.php') )
	{
		wp_enqueue_style('blogcss');
	}
	
	px_register_color_skin();
	px_theme_skin_color();
	
    //Custom Script
    wp_enqueue_script(
        'custom',
        THEME_JS_URI . '/custom.js',
        false,
        THEME_VERSION,
        true
    );

    wp_localize_script( 'custom', 'theme_uri',
        array(
            'img' => THEME_IMAGES_URI
        )
    );

    wp_localize_script( 'custom', 'theme_strings', array('contact_submit'=>__('Send', TEXTDOMAIN) ) );


	//Pie Chart Color
	$theme_support_skin = opt('theme_support_skin');
	if (empty($theme_support_skin)) {

		$piechart_skin = opt('theme_skin_color');
	
		if($piechart_skin == 'skin_1')
			$piechart_color = '#7e7e7e';
		else if($piechart_skin == 'skin_2')
			$piechart_color = '#a2b567';
		else if($piechart_skin == 'skin_3')
			$piechart_color = '#ceac6a';
		else if($piechart_skin == 'skin_4')
			$piechart_color = '#ffae00';
		else if($piechart_skin == 'skin_5')
			$piechart_color = '#ff7800';
		else if($piechart_skin == 'skin_6')
			$piechart_color = '#df1d1d';
		else if($piechart_skin == 'skin_7')
			$piechart_color = '#774b8c';
		else if($piechart_skin == 'skin_8')
			$piechart_color = '#70B0EB';
	} else {
		$piechart_color = $theme_support_skin;
	}			

	$js_opt = array(
		'scrolling_speed' => opt ('scrolling_speed'),
		'pie_chart_color' => $piechart_color
		
	);
	wp_localize_script('custom', 'pixflow_js_opt', $js_opt );
	
	// horizontal Scroll Option 
	$Scroll_opt = array(
		'scroll_display' => opt ('scroll_display'),
	);
	wp_localize_script('custom', 'pixflow_Scroll_opt', $Scroll_opt );
	
	px_Load_Posts_Init();
	px_google_webfonts();
	px_styles_method();
	
}
add_action('wp_enqueue_scripts', 'px_theme_scripts');

//Register Google Fonts
function px_google_webfonts() {
    $protocol = is_ssl() ? 'https' : 'http';
    $query_args = array(
        'family' =>  opt('google_font_family') ,
    );

    wp_enqueue_style('google-webfonts',
        esc_url(add_query_arg($query_args, "$protocol://fonts.googleapis.com/css") ),
        array(), null);
}

//Dynamic Style
function px_styles_method() {
	wp_enqueue_style(
		'custom-style',
		THEME_CSS_URI . '/options.css'
	);
			
	$theme_support_skin = opt('theme_support_skin');
	$about_color = opt('about_color');
	$resume_color = opt('resume_color');
	$portfolio_color = opt('portfolio_color');
	$contact_color = opt('contact_color');
	$menu_color = opt('menu_color');
	$links_color = opt('links_color');
	$links_hover_color = opt('links_hover_color');
	$selection_color = opt('selection_color');
	$custom_part_color = opt('custom_part_color');
	$backgroundColor = opt('backgroundColor');
	$google_font = opt('google_font');

    $opacity_org=opt('opacity_effect');
    $opacity=floatval($opacity_org) / 100;
    
    
    
		
	
    $opacity_css=
        "
        .mainpart
        {
        opacity:$opacity;
        -moz-opacity: $opacity;
        -khtml-opacity:$opacity;
        opacity: $opacity;
        -ms-filter: 'progid:DXImageTransform.Microsoft.Alpha(Opacity=$opacity_org)';
        }

  
        ";
    
    
	$theme_support_skin_css = 
		"
		.loadmore p:hover,
		.exp a:hover,
		.blog-post-meta-seperator,
		.blog-post-readmore a,
		.comment_list .comment .meta .comment-reply-login,
		.comment_list .comment .meta .comment-reply-link{color:{$theme_support_skin}; }
		.subnavigation a:hover,
		.subnavigation a.current,
		.resume-skill-next:hover,
		.resume-skill-prev:hover,
		.post-pagination a:hover,
		.post-pagination .this-page,
		.frame-overlay{background-color:{$theme_support_skin}; }
			";	
				
		$about_color_css = 
			"
			#home { background-color: {$about_color}; }
			";			

		$backgroundColor_css = 
			"
			body { background-color: {$backgroundColor} !important; }
			";
			
		$resume_color_css = 
			"
			#resume{ background-color: {$resume_color};}
			";

		$portfolio_color_css = 
			"
			#portfolio{ background-color:{$portfolio_color}; }
			";
				
		$contact_color_css = 
			"
			#contact { background-color:{$contact_color}; }
			";
		
		$custom_part_color_css = 
			"
			#custom_part { background-color:{$custom_part_color}; }
			";
		
		$menu_color_css = 
			"
			.menu,.menu-button-minus ,.mobile-menu>a ,.mobile-ul li {background-color:{$menu_color} !important;}
			";						
				
		$links_color_css = 
			"
			a { color:{$links_color}; }
			";		
			
		$links_hover_color_css = 
			"
			a:hover { color:{$links_hover_color}; }
			";	
				
		$selection_color_css = 
			"
			::selection { background: {$selection_color}; /* Safari */ }
			::-moz-selection { background: {$selection_color}; /* Firefox */ }
			";	
				
		$google_font_css = 
			"
			body , h1, h2, h3, h4, h5, h6 , input ,.post-pagination span,.post-pagination a , blockquote ,.btn {
				font-family: {$google_font}, sans-serif  !important;
			}
			";		
				
		$custom_css = opt('custom_css');
				
	if(opt('theme_support_skin') != '') { 		
		wp_add_inline_style( 'custom-style', $theme_support_skin_css );
	}
    
    if(opt('opacity_effect') != '') { 		
		wp_add_inline_style( 'custom-style', $opacity_css );
	}
	
	if(opt('about_color') != '') { 		
		wp_add_inline_style( 'custom-style', $about_color_css );
	}
	
	if(opt('backgroundColor') != '') { 		
		wp_add_inline_style( 'custom-style', $backgroundColor_css );
	}
	
	if(opt('resume_color') != '') { 		
		wp_add_inline_style( 'custom-style', $resume_color_css );
	}
	
	if(opt('portfolio_color') != '') { 		
		wp_add_inline_style( 'custom-style', $portfolio_color_css );
	}
	
	if(opt('contact_color') != '') { 		
		wp_add_inline_style( 'custom-style', $contact_color_css );
	}
	
	if(opt('custom_part_color') != '') { 		
		wp_add_inline_style( 'custom-style', $custom_part_color_css );
	}
	
	if(opt('links_color') != '') { 		
		wp_add_inline_style( 'custom-style', $links_color_css );
	}
	
	if(opt('menu_color') != '') { 		
		wp_add_inline_style( 'custom-style', $menu_color_css );
	}
	
	if(opt('links_hover_color') != '') { 		
		wp_add_inline_style( 'custom-style', $links_hover_color_css );
	}
	
	if(opt('selection_color') != '') { 		
		wp_add_inline_style( 'custom-style', $selection_color_css );
	}
	
	if(opt('google_font') != '') { 		
		wp_add_inline_style( 'custom-style', $google_font_css );
	}
	
	if(opt('custom_css') != '') { 		
		wp_add_inline_style( 'custom-style', $custom_css );
	}
}

//load more function
function px_Load_Posts_Init() {
	
	global $wp_query;
	// What page are we on? And what is the pages limit?
	$max = $wp_query-> max_num_pages;
	$paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
	
	// Add some parameters for the JS.
	wp_localize_script(
		'custom',
		'paged_data',
		array(
			'startPage' => $paged,
			'maxPages' => $max,
			'nextLink' => next_posts($max, false),
			'loadingText' => __('Loading ...', TEXTDOMAIN),
			'loadMoreText' => __('Load More', TEXTDOMAIN),
			'noMorePostsText' => __('No More Posts Available', TEXTDOMAIN)
		)
	);
	
	$queryArgs = array (
		'post_type'      => 'portfolio',
		'posts_per_page' =>  opt('portfolioposts_per_page'),
		'pageVar' => 'list1'
	);
	
	$query = new WP_Query($queryArgs);
	$ppaged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
	$pmax = $query->max_num_pages;
	$count_posts = wp_count_posts( 'portfolio' )->publish;
	$ppostperpage = opt('portfolioposts_per_page') ;
	$maxPages =  ceil ($count_posts / $ppostperpage)  ;	
	
	wp_localize_script (
		'custom',
		'portfolio_data',
		array (
			'startPage' => $ppaged,
			'maxPages' => $maxPages,
			'nextLink' => next_posts($pmax, false),
			'loadingText' => __('Loading Portfolio...', TEXTDOMAIN),
			'loadMoreText' => __('Load More', TEXTDOMAIN),
			'noMorePostsText' => __('No More Portfolio Available', TEXTDOMAIN)
		)
	);	
}