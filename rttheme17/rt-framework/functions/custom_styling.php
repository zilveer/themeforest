<?php
#-----------------------------------------
#	RT-Theme custom_styling.php
#	version: 1.0
#-----------------------------------------


#
#   General Custom Styling
#

function rt_custom_styling(){
	global $post,$google_font_replace; 

	echo '<style type="text/css">'; 

	
	
	#
	#   Custom Primary Colors
	#
	$rttheme_primary_color=get_option(THEMESLUG.'_primary_color');
	if($rttheme_primary_color){
		$css_for_rttheme_primary_color = '

			/*color*/
			#logo h1,#logo h1 a,
			.head_text h1,.head_text h2,.head_text h3,.head_text h4,.head_text h5,.head_text h6,
			.content a, .sidebar a, #footer .box.footer.widget a, .tweet_time a, .box .tweet_text a, .box .tweet_text a:hover,   
			.widget_nav_menu ul li a:hover, .widget_categories  ul li a:hover, .widget_meta  ul li a:hover, .widget_recent_entries  ul li a:hover, .widget_pages  ul li a:hover, .widget_rss  ul li a:hover,.widget_recent_comments  ul li a:hover, 
			.banner .featured_text a,
			.content h1 a:hover,.content h2 a:hover,.content h3 a:hover,.content h4 a:hover,.content h5 a:hover,.content h6 a:hover,
			.rt-toggle ol li.open .toggle-head,
			ul.tabs a.current, ul.tabs a.current:hover, ul.tabs a:hover, ul.tabs li.current a,
			a.read_more, a.read_more:hover,a.more-link,a.more-link:hover,
			.portfolio_sortables ul li.active a,	
			body .tp-caption a	
			{
				color:'.$rttheme_primary_color.'; 
			}

			/*link hovers */
			#logo h1 a:hover,
			.box .tweet_text a:hover,  
			h1 a:hover,h2 a:hover,h3 a:hover,h4 a:hover,h5 a:hover,h6 a:hover,
			.box .tweet_text a:hover, 
			ul.tabs a.current:hover, ul.tabs a:hover,
			a.read_more:hover,a.more-link:hover			
			{
				color:'.$rttheme_primary_color.'; 
				opacity:0.8;
				filter:alpha(opacity=80);
			}			

			/*background-color*/
			.icon-holder,
			.head_text .arrow,
			.box:hover > .image-border-bottom,
			#navigation ul,
			#navigation_bar > ul > li.current_page_item > a, #navigation_bar > ul > li.current_page_parent > a, #navigation_bar > ul > li.current-menu-ancestor > a , #navigation_bar > ul > li > a:hover, #navigation_bar > ul > li:hover > a,
			.flex-caption .desc-background,
			.flex-direction-nav li, .flex-direction-nav li a,
			.flex-control-nav li a,
			body .search-bar form input.searchsubmit,
			.paging li a:hover,.paging li a:hover, .paging li.active a,
			.post-navigations a,
			a.banner_button,
			a.banner_button:hover,
			.social_tip,
			.icon-overlay .icon,
			.blog_list .date ,
			.rt-toggle ol li .toggle-number,
			.mobile-date,
			body span.onsale,
			.theme-default .nivo-directionNav a ,
			.theme-default .nivo-caption  .desc-background,
			.theme-default .nivo-directionNav a,
			body .tp-leftarrow.round, body .tp-rightarrow.round,
			body .tp-leftarrow.default, body .tp-rightarrow.default,
			body .tp-caption.r-theme-blue,
			body .tp-button.auto_color_button, body .tp-button.auto_color_button:hover, body .purchase.auto_color_button, body .purchase.auto_color_button:hover			
			{
				background-color:'.$rttheme_primary_color.';
			}
 
			::selection{
				background-color:'.$rttheme_primary_color.';
			}
 
			::-moz-selection{
				background-color:'.$rttheme_primary_color.';
			}
 	

			/*border-color*/
			.logo-holder,
			ul.tabs a.current, ul.tabs a.current:hover, ul.tabs a:hover, ul.tabs li.current a ,
			blockquote p,
			blockquote.alignleft p,
			blockquote.alignright p{
				border-color:'.$rttheme_primary_color.';
			}
				
		';
	
		; 


		echo (trim(str_replace("\n","",str_replace("\t","",$css_for_rttheme_primary_color))));
	}


	#
	#   Background Image
	#
	$background_image= "";
	$randomized_banckground_images =  "";
	$background_position= "";
	$background_attachment= "";
	$background_repeat= "";
	$background_color= "";
	$full_width_background=	"";
	$background_overlay_image  = "";

	// meta values for current post 

	if( !is_archive() && !is_search() && !is_404() && $post){
		$background_image= get_post_meta( $post->ID, THEMESLUG . "_background_image_url", true );
		$randomized_banckground_images =  trim(get_post_meta( $post->ID, THEMESLUG . "_background_image_urls", true ));
		$background_position= get_post_meta( $post->ID, THEMESLUG . "_background_position", true );
		$background_attachment= get_post_meta( $post->ID, THEMESLUG . "_background_attachment", true );
		$background_repeat= get_post_meta( $post->ID, THEMESLUG . "_background_repeat", true );
		$background_color= get_post_meta( $post->ID, THEMESLUG . "_background_color", true );
		$full_width_background=	get_post_meta( $post->ID, THEMESLUG . "_full_width_background", true );
	}

	    // WooCommerce
	    if ( class_exists( 'Woocommerce' ) ) {		 
			$woo_page_id ="";
			$woo_page_id = (is_product_category() || is_shop()) ? woocommerce_get_page_id('shop') : $woo_page_id;

			if($woo_page_id){
				$background_image= get_post_meta( $woo_page_id, THEMESLUG . "_background_image_url", true );
				$randomized_banckground_images =  trim(get_post_meta( $post->ID, THEMESLUG . "_background_image_urls", true ));
				$background_position= get_post_meta( $woo_page_id, THEMESLUG . "_background_position", true );
				$background_attachment= get_post_meta( $woo_page_id, THEMESLUG . "_background_attachment", true );
				$background_repeat= get_post_meta( $woo_page_id, THEMESLUG . "_background_repeat", true );
				$background_color= get_post_meta( $woo_page_id, THEMESLUG . "_background_color", true );
				$full_width_background=	get_post_meta( $woo_page_id, THEMESLUG . "_full_width_background", true );
			} 
	    }

	// default values
	if(!$background_image && !$randomized_banckground_images && !$background_color){ 
		$background_image= get_option( THEMESLUG.'_background_image_url' );
		$randomized_banckground_images =  trim(get_option( THEMESLUG.'_background_image_urls'));
		$background_position= get_option( THEMESLUG.'_background_position' );
		$background_attachment= get_option( THEMESLUG.'_background_attachment' );
		$background_repeat= get_option( THEMESLUG.'_background_repeat' );
		$full_width_background=	get_option(THEMESLUG.'_full_width_background');
	}

	if(!$background_color){ 
		$background_color= get_option( THEMESLUG.'_background_color' );
	} 

	//Randomized Backgrounds
	if($randomized_banckground_images){
		$random_background = trim(preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $randomized_banckground_images)); 
		$images=explode("\n",  $random_background);    
		$random_number = rand(0, count($images)-1);
		$background_image = $images[$random_number];
	}

	if((!$full_width_background) && ( $background_image || $randomized_banckground_images || $background_color )){
		echo 'body {';
			if($background_image)  echo 'background-image:url('.$background_image.');';
			if($background_position && $background_image) echo 'background-position: top '.$background_position.';';
			if($background_attachment && $background_image) echo 'background-attachment:'.$background_attachment.';';
			if($background_repeat && $background_image) echo 'background-repeat:'.$background_repeat.';';
		echo '}';
	}

	if($background_color) echo 'body {background-color:'.$background_color.';}';					


	if(($full_width_background && $background_image )  || ( $background_color && !$background_image )){
		echo 'body {background-image:none;}';
	}

	#
	#   Background Overlay Image
	#

	// meta values for current post
	if( !is_archive() && !is_search() && !is_404() && $post){
	$background_overlay_image= get_post_meta( $post->ID, THEMESLUG . "_background_overlay_image_url", true );
	$enable_background_overlay= (get_post_meta( $post->ID, THEMESLUG . "_rt_hidden", true )) ? get_post_meta( $post->ID, THEMESLUG . "_enable_background_overlay", true ) : "checked";
	}else{
	$enable_background_overlay = "checked";
	}
	
	    // WooCommerce
	    if ( class_exists( 'Woocommerce' ) ) {		 
			$woo_page_id ="";
			$woo_page_id = (is_product_category() || is_shop()) ? woocommerce_get_page_id('shop') : $woo_page_id;

			if($woo_page_id){
				$background_overlay_image= get_post_meta( $woo_page_id, THEMESLUG . "_background_overlay_image_url", true );
				$enable_background_overlay= (get_post_meta( $woo_page_id, THEMESLUG . "_rt_hidden", true )) ? get_post_meta( $woo_page_id, THEMESLUG . "_enable_background_overlay", true ) : "checked";
			} 
	    }
	
	// default values	
	if(!$background_overlay_image) $background_overlay_image= get_option( THEMESLUG.'_background_overlay_image_url' );
	if($enable_background_overlay) $enable_background_overlay= get_option( THEMESLUG.'_enable_background_overlay' ); 

	 
	if($enable_background_overlay && $background_overlay_image){
		echo '#container {background:url('.$background_overlay_image.')  no-repeat center top;}';
	}  

	 
	if(!$enable_background_overlay){
		echo '#container {'; 
		echo 'background:none;'; 
		echo '}';
	}  
 
	
	#
	#   Custom Menu Font Color
	#
	$rttheme_menu_font_color=get_option(THEMESLUG.'_menu_font_color'); // menu item color
	$rttheme_menu_font_color_hover=get_option(THEMESLUG.'_menu_font_color_hover'); // menu item hover color
	$rttheme_menu_sub_font_color=get_option(THEMESLUG.'_menu_font_sub_color'); // menu item color
	$rttheme_menu_sub_font_color_hover=get_option(THEMESLUG.'_menu_font_color_sub_hover'); // menu item hover color
	
	if($rttheme_menu_font_color){// menu item color
		echo '#navigation_bar > ul > li > a{color:'.$rttheme_menu_font_color.';}';
	}
	
	if($rttheme_menu_font_color_hover){// menu active item color
		echo '#navigation_bar > ul > li.current_page_item > a, #navigation_bar > ul > li.current-menu-ancestor > a , #navigation_bar > ul > li > a:hover, #navigation_bar > ul > li:hover > a{color:'.$rttheme_menu_font_color_hover.';}';	
	}
	
	if($rttheme_menu_sub_font_color){// menu item color
		echo '#navigation_bar ul ul li a{color:'.$rttheme_menu_sub_font_color.' !important;}';
	}
	
	if($rttheme_menu_sub_font_color_hover){// menu active item color
		echo '#navigation_bar ul li li a:hover,#navigation_bar li.hasSubMenu:hover > a {color:'.$rttheme_menu_sub_font_color_hover.' !important;}';	
	}

	
	#
	#   Custom Menu Background Color
	#
	$rttheme_menu_background_color=get_option(THEMESLUG.'_menu_background_color'); // menu item background color
	$rttheme_menu_sub_background_color=get_option(THEMESLUG.'_menu_sub_background_color'); // menu item background color


	if($rttheme_menu_background_color){// menu item background color
		echo '#navigation_bar > ul > li.current_page_item > a, #navigation_bar > ul > li.current-menu-ancestor > a , #navigation_bar > ul > li > a:hover, #navigation_bar > ul > li:hover > a{background-color:'.$rttheme_menu_background_color.';}';
	}

	if($rttheme_menu_sub_background_color){// menu item sub background color
		echo '#navigation ul{background-color:'.$rttheme_menu_sub_background_color.';}';
	}


	#
	#   Custom Body Font Color
	#
	$rttheme_body_font_color=get_option('rttheme_body_font_color');
	if($rttheme_body_font_color){
		echo 'body,.banner .featured_text,
			blockquote.testimonial p,
			blockquote.testimonial p span.author
			{color:'.$rttheme_body_font_color.';text-shadow:none;}';
	}
	

	
	#
	#   Custom Link Colors
	#
	$rttheme_link_color=get_option(THEMESLUG.'_link_color');
	$rttheme_link_color_hover=get_option(THEMESLUG.'_link_color_hover');
	
	if($rttheme_link_color){
		echo '.content a, .sidebar a, #footer .box.footer.widget a,.tweet_time a, .box .tweet_text a, .banner .featured_text a, a.read_more,a.more-link{color:'.$rttheme_link_color.';}'; 
	}
	if($rttheme_link_color_hover){
		echo '.content a:hover, .sidebar a:hover, #footer .box.footer.widget a:hover,.tweet_time a:hover, .box .tweet_text a:hover, .banner .featured_text a:hover, a.read_more:hover,a.more-link:hover {color:'.$rttheme_link_color_hover.';text-shadow:none;}'; 
	}
	

	#
	#   Custom Heading Font Color
	#
	$rttheme_heading_font_color=get_option('rttheme_heading_font_color');
	if($rttheme_heading_font_color){
		echo 'h1,h2,h3,h4,h5,h6, .content h1 a, .content h2 a, .content h3 a, .content h4 a, .content  h5 a, .content h6 a
			{color:'.$rttheme_heading_font_color.';}';
	}
	
	#
	#   Custom Footer Font Color
	#
	$rttheme_footer_font_color=get_option('rttheme_footer_font_color');
	if($rttheme_footer_font_color){
		echo '#footer
			{color:'.$rttheme_footer_font_color.';}';
	}
	
	#
	#   Custom Footer Link Color
	#
	$rttheme_footer_link_color=get_option('rttheme_footer_link_color');
	if($rttheme_footer_link_color){
		echo 'ul.footer_links a,ul.footer_links
			{color:'.$rttheme_footer_link_color.';}';
		echo 'ul.footer_links li
			{border-color:'.$rttheme_footer_link_color.';}';
	}


	#
	#   Custom Footer Link Color:hover
	#
	$rttheme_footer_link_hover_color=get_option('rttheme_footer_link_hover_color');
	if($rttheme_footer_link_hover_color){
		echo 'ul.footer_links a:hover
			{color:'.$rttheme_footer_link_hover_color.';}'; 
	}



	#
	#   Custom Breadcrumnb Menu Font Color
	#
	$rttheme_breadcrumb_font_color=get_option('rttheme_breadcrumb_font_color');
	if($rttheme_breadcrumb_font_color){
		echo '.breadcrumb
			{color:'.$rttheme_breadcrumb_font_color.';}';
	}
	
	#
	#   Custom Breadcrumnb Menu Link Color
	#
	$rttheme_breadcrumb_link_color=get_option('rttheme_breadcrumb_link_color');
	if($rttheme_breadcrumb_link_color){
		echo '.breadcrumb a
			{color:'.$rttheme_breadcrumb_link_color.';}'; 
	}


	#
	#   Custom Breadcrumnb Menu Link Color:hover
	#
	$rttheme_breadcrumb_link_hover_color=get_option('rttheme_breadcrumb_link_hover_color');
	if($rttheme_breadcrumb_link_hover_color){
		echo '.breadcrumb a:hover
			{color:'.$rttheme_breadcrumb_link_hover_color.';}'; 
	}



	#
	#   Custom Menu Font Size
	#
	$rttheme_menu_font_size=get_option(THEMESLUG.'_menu_font_size');
	if($rttheme_menu_font_size){
		echo '#navigation_bar > ul > li > a {font-size:'.$rttheme_menu_font_size.'px;}';
	}


	#
	#   Custom Banner Font Size
	#
	$rttheme_banner_font_size=get_option(THEMESLUG.'_banner_font_size');
	if($rttheme_banner_font_size){
		echo '.banner p {font-size:'.$rttheme_banner_font_size.'px;}';
	}


	#
	#   Widget Headings Font Size
	#
	$rttheme_widget_heading_font_size=get_option(THEMESLUG.'_widget_heading_font_size');
	if($rttheme_widget_heading_font_size){
		echo '.template_builder h3, .widget .title h3, .sidebar .title h3 {font-size:'.$rttheme_widget_heading_font_size.'px !important;}';
	}

	
	#
	#   Custom Heading Sizes
	#
	for ($i = 1; $i <= 6; $i++) {
		$this_heading=get_option('rttheme_h'.$i.'_font_size');
		if($this_heading){ 
			echo 'h'.$i.'{ font-size:'.$this_heading.'px;line-height:140%; }'; 
		}
	}
	
	
	#
	#   Custom Body Font Size
	#
	$rttheme_body_font_size=get_option('rttheme_body_font_size');
	if($rttheme_body_font_size){
		echo 'body {font-size:'.$rttheme_body_font_size.'px;line-height:160%;}';
	}
	
	#
	#   Custom Body Font Family
	#
	$rttheme_body_font_family=get_option('rttheme_body_font_family');
	if($rttheme_body_font_family){
		echo 'body {font-family:'.$rttheme_body_font_family.';}';
	} 
	
	echo '</style>';

	#
	#   Display CSS codes for Google Fonts that generated by theme.php
	#	
	echo (trim(str_replace("\r\n","",str_replace("\t","",$google_font_replace))));


	#
	#   Custom Footer Background
	#
	$rttheme_footer_background_color=get_option('rttheme_footer_background_color');
	$rttheme_footer_opacity = get_option('rttheme_footer_opacity');

	if($rttheme_footer_background_color){
		$footerRGB = HexToRGB($rttheme_footer_background_color);
		$rttheme_footer_opacity_modern_browsers = ($rttheme_footer_opacity || $rttheme_footer_opacity=="0") ? intval($rttheme_footer_opacity)/100 : "0.3";
		if(is_array($footerRGB)){
			echo '<style type="text/css">';
			echo '#footer {background-color: rgba('.$footerRGB["r"].','.$footerRGB["g"].','.$footerRGB["b"].', '.$rttheme_footer_opacity_modern_browsers.');}';
			echo '</style>';

			#
			#	internet explorer  ;( - IE 8 and before versions are not supports rgba colors and Microsoft.gradient technique acts weird, 
			#	these codes trying to serve closer results with a modern browser for IE 8-
			#
			if($rttheme_footer_opacity || $rttheme_footer_opacity==0){
				if($rttheme_footer_opacity == "0"){
					$rttheme_footer_opacity_ie = "00";
				}elseif(intval($rttheme_footer_opacity) > 85 ){
					$rttheme_footer_opacity_ie = "1";
				}elseif(intval($rttheme_footer_opacity) > 59 && intval($rttheme_footer_opacity) < 85 ){
					$rttheme_footer_opacity_ie = "99";
				}elseif(intval($rttheme_footer_opacity) > 10 && intval($rttheme_footer_opacity) < 59 ){
					$rttheme_footer_opacity_ie = $rttheme_footer_opacity+15;
				}elseif(intval($rttheme_footer_opacity) < 10 && intval($rttheme_footer_opacity) > 0 ){
					$rttheme_footer_opacity_ie = "0".$rttheme_footer_opacity; 
				}else{
					$rttheme_footer_opacity_ie = $rttheme_footer_opacity; 
				}
			
			}else{
				$rttheme_footer_opacity_ie  = 30;
			} 

			echo '
				<!--[if lt IE 9]>
				<style type="text/css">
				   #footer { 
					  background:transparent;
					  filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#'.$rttheme_footer_opacity_ie.''.trim(str_replace('#','',$rttheme_footer_background_color)).',endColorstr=#'.$rttheme_footer_opacity_ie.''.trim(str_replace('#','',$rttheme_footer_background_color)).');				
					  zoom: 1;
				    } 
				</style>
				<![endif]-->
			';
		
		}
	}

	#
	#   Custom CSS Codes
	#
	$rttheme_custom_css=get_option('rttheme_custom_css'); 
	if($rttheme_custom_css){
		echo '<style type="text/css">'.$rttheme_custom_css.'</style>';	
	}
}
add_filter('wp_head','rt_custom_styling');
 

#
#   Home Page Posts Custom Styling
#
function rt_posts_custom_styling(){
global $google_fonts; 

	$the_query = new WP_Query('meta_value=custom_styled&post_type=home_page&posts_per_page=10000');
	$style = "";
	$selected_google_fonts = array();
 
		while ($the_query->have_posts()) : $the_query->the_post(); 

			$google_font_for_title	= get_post_meta( $the_query->post->ID, THEMESLUG . "_google_fonts_heading", true );
			$heading_font_size = get_post_meta( $the_query->post->ID, THEMESLUG . "_heading_font_size", true );
			$heading_font_color = get_post_meta( $the_query->post->ID, THEMESLUG . "_heading_font_color", true );

			$google_font_for_text	= get_post_meta( $the_query->post->ID, THEMESLUG . "_google_fonts_body", true );
			$text_font_size = get_post_meta( $the_query->post->ID, THEMESLUG . "_text_font_size", true );
			$text_font_color = get_post_meta( $the_query->post->ID, THEMESLUG . "_text_font_color", true );
			$link_font_color = get_post_meta( $the_query->post->ID, THEMESLUG . "_link_font_color", true );
			$box_bg_color = get_post_meta( $the_query->post->ID, THEMESLUG . "_box_bg_color", true );

			array_push($selected_google_fonts, $google_font_for_title);
			array_push($selected_google_fonts, $google_font_for_text); 
	
			
			if($google_font_for_title) $style .= '#post-'.$the_query->post->ID.' h3, #post-'.$the_query->post->ID.' h3 a{font-family:"'.$google_fonts[$google_font_for_title][0].'";}';
			if($heading_font_size) $style .= '#post-'.$the_query->post->ID.' h3, #post-'.$the_query->post->ID.' h3 a{font-size:'.$heading_font_size.'px; line-height:130%;}';
			if($heading_font_color) $style .= '#post-'.$the_query->post->ID.' h3, #post-'.$the_query->post->ID.' h3 a{color:'.$heading_font_color.';}#post-'.$the_query->post->ID.' h3 a:hover{opacity:0.7;}';

			if($google_font_for_text) $style .=  '#post-'.$the_query->post->ID.' p{font-family:"'.$google_fonts[$google_font_for_text][0].'"; }';	
			if($text_font_size) $style .= '#post-'.$the_query->post->ID.' p{font-size:'.$text_font_size.'px; line-height:130%; }';
			if($text_font_color) $style .= '#post-'.$the_query->post->ID.' p{color:'.$text_font_color.';}';				
			if($link_font_color) $style .= '#post-'.$the_query->post->ID.' p a, #post-'.$the_query->post->ID.' a.read_more{color:'.$link_font_color.';}#post-'.$the_query->post->ID.' p a:hover, #post-'.$the_query->post->ID.' a.read_more:hover{opacity:0.7;}';			
			if($box_bg_color) $style .= '#post-'.$the_query->post->ID.'{background-color:'.$box_bg_color.';}';

		endwhile; 

	wp_reset_query();
	wp_reset_postdata();
			
	if($style){
		echo '<style type="text/css">'; 	
		echo $style;
		echo '</style>'."\n"; 
	}
	
	foreach(array_unique($selected_google_fonts) as $font_file){
		if($font_file){
			$font_file=str_replace("&","&amp;",$font_file);
			echo "\n".'<link href="https://fonts.googleapis.com/css?family='.$font_file.'" rel="stylesheet" type="text/css" />'."\n";
		}
	}
	
}
add_filter('wp_head','rt_posts_custom_styling'); 

#
#  Revolution Slider Overwrites 
#  This must be here, not in the css file
#
function rt_revslider_css(){
	if(class_exists("RevSlider")){
		echo '<style type="text/css">body #container .rev_slider_wrapper, body #container .rev_slider  { max-width:940px !important;}body #container .sidebarwidth .rev_slider_wrapper, body #container .sidebarwidth .rev_slider {  max-width:600px !important; }@media only screen and (min-width: 768px) and (max-width: 958px) {body.responsive #container .rev_slider_wrapper, body.responsive #container .rev_slider { max-width:708px !important;}body.responsive #container .sidebarwidth .rev_slider_wrapper, body.responsive #container .sidebarwidth .rev_slider {  max-width:452px !important; }}@media only screen and (min-width: 480px) and (max-width: 767px) {body.responsive #container .rev_slider_wrapper, body.responsive #container .rev_slider  { max-width:420px !important;}}@media only screen and (min-width: 320px) and (max-width: 479px) { body.responsive #container .rev_slider_wrapper, body.responsive #container .rev_slider { max-width:280px !important;}}@media only screen and (min-width: 0px) and (max-width: 319px) { body.responsive #container .rev_slider_wrapper, body.responsive #container .rev_slider { max-width:240px !important;}}.tp-thumbs{bottom: 20px !important;}.tp-bannershadow {width: 100% !important;}</style>';
	}	
}
add_filter('wp_head','rt_revslider_css'); 
?>