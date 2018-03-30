<?php
#-----------------------------------------
#	RT-Theme custom_styling.php
#-----------------------------------------

#
#   General Custom Styling
#
function rt_custom_styling(){
 	global $rt_is_template_builder, $rt_templateID;

 	$rttheme_custom_css = "";

 	//Fonts
	$rttheme_custom_css .= rt_create_fonts_css();   

 	//Call Template Fonts
	rt_load_tempalte_fonts_css();   

 	//Font sizes
 	$rttheme_custom_css .= rt_create_font_size_css(); 
 	 	
 	//Custom Navigation colors
 	$rttheme_custom_css .= create_rt_navigation_color_css();

 	//Custom Page Background
 	$rttheme_custom_css .= create_rt_main_background_css();


 	// custom color sets & backgrounds 
 	if( $rt_is_template_builder ){
		
		$css_array = get_option(RT_THEMESLUG."_".$rt_templateID."_css_output");  

		//content colors
		if ( is_array( $css_array ) ){

			//color sets
			foreach ( $css_array["color_sets"] as $key => $value ) {			

				if( ! empty( $value["values"] ) ){
					$rttheme_custom_css .= create_rt_color_css( $value["values"], $value["container"] );
				}else{ 
						 
						//check if selected color set points another one 
						$get_preset_selection = get_option( RT_THEMESLUG.'_'.$value["selection"].'_colorset' );

						if ( "default" != $get_preset_selection &&  "new" != $get_preset_selection ){	  
							$rttheme_custom_css .= create_rt_color_css( rt_get_color_set( $get_preset_selection,  $value["selection"] ) , $value["container"] );   
						}else{ 
							$rttheme_custom_css .= create_rt_color_css( rt_get_color_set( $value["selection"] ), $value["container"] );	 
						}
						
				}
			}

			//backgrounds
				foreach ( $css_array["backgrounds"] as $key => $value ) {			

				if( ! empty( $value["values"] ) ){
					$rttheme_custom_css .= rt_create_background_css( $value["values"], $value["container"] );
				}else{
						//check if selected background set points another one 
						$get_preset_background = get_option( RT_THEMESLUG.'_'.$value["selection"].'_background' );

						if ( "default" != $get_preset_background &&  "new" != $get_preset_background ){	  
							$rttheme_custom_css .= rt_create_background_css( rt_get_background_options( $get_preset_background,  $value["selection"] ) , $value["container"] );   
						}else{ 
							$rttheme_custom_css .= rt_create_background_css( rt_get_background_options( $value["selection"] ), $value["container"] );	 
						}

				}
			}

			//css codes 
			if( ! empty( $css_array["css_codes"] ) ){
				$rttheme_custom_css .= $css_array["css_codes"];
			}
		  
		}


 	}else{

		//Header - Content CSS
		$rttheme_custom_css .= create_rt_color_css( rt_get_color_set( get_option( RT_THEMESLUG.'_header_colorset' ), "header" ), ".top_content"  );

		//Header - Background CSS
		$rttheme_custom_css .= rt_create_background_css( rt_get_background_options( get_option( RT_THEMESLUG.'_header_background' ), "header" ), ".top_content"  );

		//Content Area 1 - Content CSS
		$rttheme_custom_css .= create_rt_color_css( rt_get_color_set( get_option( RT_THEMESLUG.'_ca1_colorset' ), "ca1" ) , ".content_block_background"  );

		//Content Area 1 - Background CSS
		$rttheme_custom_css .= rt_create_background_css( rt_get_background_options( get_option( RT_THEMESLUG.'_ca1_background' ), "ca1" ), ".content_block_background"  );

		//Footer - Content CSS
		$rttheme_custom_css .= create_rt_color_css( rt_get_color_set( get_option( RT_THEMESLUG.'_footer_colorset' ), "footer" ), ".content_holder .content_footer"  );

		//Footer - Background CSS
		$rttheme_custom_css .= rt_create_background_css( rt_get_background_options( get_option( RT_THEMESLUG.'_footer_background' ), "footer" ), ".content_holder .content_footer"  );
 	}
 

	//Header Logo Bar - Content CSS
	$rttheme_custom_css .= create_rt_color_css( rt_get_color_set( get_option( RT_THEMESLUG.'_header_logo_colorset' ), "header_logo" ), "#header"  );

	//Header - Background CSS
	$rttheme_custom_css .= rt_create_background_css( rt_get_background_options( get_option( RT_THEMESLUG.'_header_logo_background' ), "header_logo" ), "#header"  );

	//Top Bar - Content CSS
	$rttheme_custom_css .= create_rt_top_bar_color_css();

	//Top Bar - Background CSS
	$rttheme_custom_css .= rt_create_background_css( rt_get_background_options( get_option( RT_THEMESLUG.'_top_bar_background' ), "top_bar" ), "#top_bar"  );		

	//Bottom Bar - Content CSS
	$rttheme_custom_css .= create_rt_bottom_bar_color_css();

	//Bottom Bar - Background CSS
	$rttheme_custom_css .= rt_create_background_css( rt_get_background_options( get_option( RT_THEMESLUG.'_bottom_bar_background' ), "bottom_bar" ), "#footer"  );		

	//Header Height for Design 2
	$rttheme_custom_css .= rt_create_header_height_css();		

	//Custom CSS Codes	
	$rttheme_custom_css .= stripcslashes(get_option( RT_THEMESLUG.'_custom_css' ));  


	/*
	*	Minify the css
	*/ 

	// Remove comments
	$rttheme_custom_css = preg_replace('#/\*.*?\*/#s', '', $rttheme_custom_css);
	// Remove whitespace
	$rttheme_custom_css = preg_replace('/\s*([{}|:;,])\s+/', '$1', $rttheme_custom_css);
	// Remove trailing whitespace at the start
	$rttheme_custom_css = preg_replace('/\s\s+(.*)/', '$1', $rttheme_custom_css);
	// Remove unnecesairy ;'s
	$rttheme_custom_css = str_replace(';}', '}', $rttheme_custom_css);  
	//Remove the tabs
	$rttheme_custom_css = str_replace("\t", "", $rttheme_custom_css); 

	$rttheme_custom_css = ! empty( $rttheme_custom_css ) ?  $rttheme_custom_css : "";	

	/*
	*	Add the inline css
	*/ 
	wp_add_inline_style( 'theme-skin', $rttheme_custom_css );
}
add_action( 'wp_enqueue_scripts', 'rt_custom_styling', 30 );

#
#  Load template builder fonts
#
function rt_create_header_height_css(){
	global $rt_header_layout_options; 
 	
 	$height = get_option(RT_THEMESLUG."_header_height");
	$height = is_numeric( $height ) ? $height : 80;

	$css = sprintf('
			/* resolutions bigger than 960px */
			@media only screen and (min-width: 960px)  { 

				.header-design2 .default_position #navigation_bar > ul > li > a{
					line-height: %1$spx; 
				}		

				.header-design2 #logo img{
					max-height: %2$spx; 
				}

				.header-design2  #logo h1, .header-design2  #logo h1 a{
					padding:0;
					line-height: %2$spx;
				}

				.header-design2 .section_logo > section {
					display: table;
					height: %2$spx;
				}

				.header-design2 #logo > a {
					display: table-cell;
					vertical-align: middle;
				}
			}
			', $height, $height-20);
 

 	return $css;
}

#
#  Load template builder fonts
#
function rt_load_tempalte_fonts_css(){
	global $rt_google_fonts,$rt_is_template_builder, $rt_templateID; 

	//check if this is a tempalte builder page
 	if( ! $rt_is_template_builder ){
		return false;
	} 

	$css_array = get_option(RT_THEMESLUG."_".$rt_templateID."_css_output");   

	//selected fonts
	$selected_fonts = isset( $css_array["fonts"] ) && is_array( $css_array["fonts"] ) ? $css_array["fonts"] : ""; 

	//import google fonts
	if( is_array( $selected_fonts ) ){
		foreach( array_unique( $selected_fonts ) as $value) { 
			
			if( isset($rt_google_fonts[$value] ) ){ //check if it is a google font
				$value = str_replace("&", "&amp;", $value); 
				$value = str_replace("%3A", ":", $value); 
				wp_enqueue_style($value, '//fonts.googleapis.com/css?family='. $value .''); 	  
			}
		} 
	}
 
 	return true;
}

#
#  Create font family css
#
function rt_create_fonts_css(){
	global $rt_google_fonts;
	
	$css = '';

	//selected fonts
	$selected_fonts = array( "menu" => get_option( RT_THEMESLUG.'_fonts_menu' ), "heading" => get_option( RT_THEMESLUG.'_fonts_heading' ), "body" => get_option( RT_THEMESLUG.'_font_body' ), "serif" => get_option( RT_THEMESLUG.'_fonts_serif' ) );


	//import google fonts
	foreach( array_unique( $selected_fonts ) as $key => $value) {
		
		if( isset($rt_google_fonts[$value] ) ){ //check if it is a google font
 
			wp_enqueue_style($key, '//fonts.googleapis.com/css?family='. $value .''); 	  
		}
	}


	//create css outputs
	foreach( $selected_fonts as $key => $value) {

		//font family
		if( isset($rt_google_fonts[$value] ) ){ //check if it is a google font
			$font_family = "'".$rt_google_fonts[$value][0]."',sans-serif" ;
			$font_weight = isset( $rt_google_fonts[$value][2] ) ? $rt_google_fonts[$value][2]: "normal";
		}else{
			$font_family = $value ;
			$font_weight ="normal";
		}

		//heading
		if( $key == "heading" && ! empty( $value ) ){
			
			$css .= sprintf('
					.flex-caption,
					.pricing_table .table_wrap ul > li.caption,
					.pricing_table .table_wrap.highlight ul > li.caption,
					.banner p,
					.sidebar .featured_article_title,
					.footer_widgets_row .featured_article_title,
					.latest-news a.title,
					h1,h2,h3,h4,h5{
						font-family: %1$s;
						font-weight: %2$s !important;
					}				
					', $font_family, $font_weight );	

		}

		//menu
		if( $key == "menu" && ! empty( $value ) ){
			
			$css .= sprintf('
					#navigation_bar > ul > li > a{
						font-family: %1$s;
						font-weight: %2$s !important;
					}				
					', $font_family, $font_weight );	
		}


		//body
		if( $key == "body" && ! empty( $value ) ){
			
			$css .= sprintf('
					body,#navigation_bar > ul > li > a span,
					.product_info h5,
					.product_item_holder h5,
					#slogan_text
					{
						font-family: %1$s;
						font-weight: %2$s !important;
					}				
					', $font_family, $font_weight );	
		}		


		//serif
		if( $key == "serif" && ! empty( $value ) ){

			$css .= sprintf('
					.testimonial .text,
					blockquote p
					{
						font-family: %1$s;
						font-weight: %2$s !important;
					}				
					', $font_family, $font_weight );	
		}	
	}
 
 
 	return $css;
}

#
#  Create font size css
#
function rt_create_font_size_css(){

	$css = '';

	//selected fonts
	$selectors = array( 
					"h1" => get_option( RT_THEMESLUG.'_h1_font_size' ),
					"h2" => get_option( RT_THEMESLUG.'_h2_font_size' ),
					"h3" => get_option( RT_THEMESLUG.'_h3_font_size' ),
					"h4" => get_option( RT_THEMESLUG.'_h4_font_size' ),
					"h5" => get_option( RT_THEMESLUG.'_h5_font_size' ),
					"h6" => get_option( RT_THEMESLUG.'_h6_font_size' ),
					"widget_heading_font_size" => get_option( RT_THEMESLUG.'_widget_heading_font_size' ),
					"menu_font_size" => get_option( RT_THEMESLUG.'_menu_font_size' ),
					"body_font_size" => get_option( RT_THEMESLUG.'_body_font_size' )
				);


	//create css outputs
	foreach( $selectors as $key => $value) {

		//heading 1
		if( $key == "h1" && ! empty( $value ) ){
			
			$css .= sprintf('
					h1{
						font-size: %1$spx
					}				
					', $value );	
		}
 
 		//heading 2
		elseif( $key == "h2" && ! empty( $value ) ){
			
			$css .= sprintf('
					h2,.single-products .head_text h1, .single-product .head_text h1{
						font-size: %1$spx
					}				
					', $value );	
		}

 
 		//heading 3
		elseif( $key == "h3" && ! empty( $value ) ){
			
			$css .= sprintf('
					h3{
						font-size: %1$spx
					}				
					', $value );	
		}

 		//heading 4
		elseif( $key == "h4" && ! empty( $value ) ){
			
			$css .= sprintf('
					h4{
						font-size: %1$spx
					}				
					', $value );	
		}

 		//heading 5
		elseif( $key == "h5" && ! empty( $value ) ){
			
			$css .= sprintf('
					h5{
						font-size: %1$spx
					}				
					', $value );	
		}

 		//heading 6
		elseif( $key == "h6" && ! empty( $value ) ){
			
			$css .= sprintf('
					h6{
						font-size: %1$spx
					}				
					', $value );	
		}				


 		//widget heading font size
		elseif( $key == "widget_heading_font_size" && ! empty( $value ) ){
			
			$css .= sprintf('
					.featured_article_title{
						font-size: %1$spx
					}				
					', $value );	
		}				

 		//menu font size
		elseif( $key == "menu_font_size" && ! empty( $value ) ){
			
			$css .= sprintf('
					#navigation_bar > ul > li > a{
						font-size: %1$spx
					}				
					', $value );	
		}		

 		//body font size
		elseif( $key == "body_font_size" && ! empty( $value ) ){
			
			$css .= sprintf('
					body{
						font-size: %1$spx;
					}				
					', $value );	
		}		

	}
 
 
 	return $css;
}

#
#  Get color sets as an array
#
function rt_get_color_set( $colorset_code = "", $for = "" ){

	$color_set =  array();
	
	if ( ! empty( $for ) && get_option( RT_THEMESLUG.'_'. $for .'_colorset' ) == "new" || get_option( RT_THEMESLUG.'_'. $for .'_colorset' ) == "default" ) {
		$colorset_code = $for;
	} 

	if( get_option( RT_THEMESLUG.'_'. $colorset_code .'_colorset' ) == "new" ){
		$color_set = array(
			"primary" => get_option( RT_THEMESLUG.'_'. $colorset_code .'_primary' ),  // primary color
			"font" => get_option( RT_THEMESLUG.'_'. $colorset_code .'_font' ),  // font color
			"light_font" => get_option( RT_THEMESLUG.'_'. $colorset_code .'_light_font' ),  // light font color
			"headings" => get_option( RT_THEMESLUG.'_'. $colorset_code .'_headings' ),  // heading color 
			"heading_links" => get_option( RT_THEMESLUG.'_'. $colorset_code .'_heading_links' ),  // heading :hover color
			"link" => get_option( RT_THEMESLUG.'_'. $colorset_code .'_link' ),  // link color
			"link_hover" => get_option( RT_THEMESLUG.'_'. $colorset_code .'_link_hover' ),  // link :hover color
			"highlighted" => get_option( RT_THEMESLUG.'_'. $colorset_code .'_highlighted' ),  // highlighted content background color 
			"border" => get_option( RT_THEMESLUG.'_'. $colorset_code .'_border' ),  // border color 
			"social_media" => get_option( RT_THEMESLUG.'_'. $colorset_code .'_social_media' ),  // social media base color 
		); 
	}  


	return $color_set;
}

#
#  Get background options as an array
#
function rt_get_background_options( $colorset_code = "", $for = ""){

 	$background_options = array();
 
 	if ( ! empty( $for ) && get_option( RT_THEMESLUG.'_'. $for .'_background' ) == "new" || get_option( RT_THEMESLUG.'_'. $for .'_background' ) == "default" ) {
		$colorset_code = $for;
	}

	if( get_option( RT_THEMESLUG.'_'. $colorset_code .'_background' ) == "new" ){
		$background_options = array(
			"background_color" => get_option( RT_THEMESLUG.'_'. $colorset_code .'_background_color' ),  // content background color		
			"background_image_url" => get_option( RT_THEMESLUG.'_'. $colorset_code .'_background_image_url' ), //background-image 
			"background_attachment" => get_option( RT_THEMESLUG.'_'. $colorset_code .'_background_attachment' ), //background-attachment
			"background_position" => get_option( RT_THEMESLUG.'_'. $colorset_code .'_background_position' ), //background-position
			"background_repeat" => get_option( RT_THEMESLUG.'_'. $colorset_code .'_background_repeat' ), //background-repeat
			"background_size" => get_option( RT_THEMESLUG.'_'. $colorset_code .'_background_size' ), //background-size - 17
		);
 
	}

	return $background_options;
}

#
#   Create css for main background
#
function create_rt_main_background_css(){

		$css = '';

		if(  get_option( RT_THEMESLUG.'_content_layout') == "half-boxed" && get_option( RT_THEMESLUG.'_page_background') == "new" ){


				$background_color = get_option( RT_THEMESLUG.'_page_background_color');
				$background_image_url = get_option( RT_THEMESLUG.'_page_background_image_url');
				$background_attachment = get_option( RT_THEMESLUG.'_page_background_attachment');
				$background_position = get_option( RT_THEMESLUG.'_page_background_position');
				$background_repeat = get_option( RT_THEMESLUG.'_page_background_repeat');
				$background_size = get_option( RT_THEMESLUG.'_page_background_size');
		 
		 		// background color
				$css .= ! empty( $background_color ) ? sprintf('
						
					.half-boxed .content_holder
					{
						background-color: %1$s;
					}

				', $background_color ) : "" ; 

				// background image
				$css .= ! empty( $background_image_url ) ? sprintf('
						
					.half-boxed .content_holder
					{
						background-image: url( %1$s );
						background-attachment: %2$s;  
						background-position: %3$s;
						background-repeat: %4$s;
						background-size: %5$s;
					}

				',

				$background_image_url,  // image_url  - 1 
				$background_attachment,  // attachment - 2
				$background_position,  // position - 3
				$background_repeat,  // repeat - 4
				$background_size  // size - 5

				) : "" ; 

				//fix background if only color selected
				$css .= ! empty( $background_color ) && empty( $background_image_url ) ? '
						
					.half-boxed .content_holder{ 
						background-image: none;
				 	}

				' : "" ; 				
		}


		if(  get_option( RT_THEMESLUG.'_content_layout') == "boxed-body" && get_option( RT_THEMESLUG.'_page_background') == "new" ){


				$background_color = get_option( RT_THEMESLUG.'_page_background_color');
				$background_image_url = get_option( RT_THEMESLUG.'_page_background_image_url');
				$background_attachment = get_option( RT_THEMESLUG.'_page_background_attachment');
				$background_position = get_option( RT_THEMESLUG.'_page_background_position');
				$background_repeat = get_option( RT_THEMESLUG.'_page_background_repeat');
				$background_size = get_option( RT_THEMESLUG.'_page_background_size');
		 
		 		// background color
				$css .= ! empty( $background_color ) ? sprintf('
						
					.boxed-body
					{
						background-color: %1$s;
					}

				', $background_color ) : "" ; 

				// background image
				$css .= ! empty( $background_image_url ) ? sprintf('
						
					.boxed-body
					{
						background-image: url( %1$s );
						background-attachment: %2$s;  
						background-position: %3$s;
						background-repeat: %4$s;
						background-size: %5$s;
					}

				',

				$background_image_url,  // image_url  - 1 
				$background_attachment,  // attachment - 2
				$background_position,  // position - 3
				$background_repeat,  // repeat - 4
				$background_size  // size - 5

				) : "" ; 

				//fix background if only color selected
				$css .= ! empty( $background_color ) && empty( $background_image_url ) ? '
						
					.boxed-body{ 
						background-image: none;
				 	}

				' : "" ; 				
		}	
		return $css; 
}

#
#   Create a color set for navigation
#
function create_rt_navigation_color_css(){

		$css = '';

		if(  get_option( RT_THEMESLUG.'_navigation_colorset') == "new" ){

			$menu_font_color = get_option( RT_THEMESLUG.'_menu_font_color');
			$subtitle_font_color = get_option( RT_THEMESLUG.'_subtitle_font_color');
			$active_menu_background_color = get_option( RT_THEMESLUG.'_active_menu_background_color');
			$active_menu_font_color = get_option( RT_THEMESLUG.'_active_menu_font_color');
			$active_subtitle_font_color = get_option( RT_THEMESLUG.'_active_subtitle_font_color');
			$bar_background_color = get_option( RT_THEMESLUG.'_bar_background_color');
			$bar_background_image = get_option( RT_THEMESLUG.'_bar_background_image');
			$bar_border_color = get_option( RT_THEMESLUG.'_bar_border_color');
			$active_menu_border_color = get_option( RT_THEMESLUG.'_active_menu_border_color');

			$css .= '
				/* ----------------------------------------------------	
					MAIN NAVIGATION BAR
				------------------------------------------------------- */ 
			';


			// menu font color
			$css .= ! empty( $menu_font_color ) ? sprintf('
		
				#navigation_bar > ul > li > a,
				#navigation .sub-menu li a, 				
				#navigation .multicolumn-holder a, 
				#navigation .multicolumn-holder .column-heading > span, #navigation .multicolumn-holder .column-heading > a,
				#navigation .multicolumn-holder a:hover,
				#navigation ul.sub-menu li:hover > a
				{ color: %s; }

				#navigation .multicolumn-holder a:hover{
			 		opacity: 0.8;
				}
		 

			',$menu_font_color) : "" ;

			// subtitle font color
			$css .= ! empty( $subtitle_font_color ) ? sprintf('
		
				#navigation_bar > ul > li > a span,
				#navigation_bar ul ul > li > a span,
				#navigation_bar .multicolumn-holder ul > li:hover > a span,
				body .search-bar form input
				{ color: %s; }

			',$subtitle_font_color) : "" ;

			// active menu background color
			$css .= ! empty( $active_menu_background_color ) ? sprintf('
		
				#navigation_bar > ul > li.current_page_item, #navigation_bar > ul > li.current-menu-ancestor, #navigation_bar > ul > li:hover,
				#navigation ul.sub-menu li a:hover
				{ background-color: %1$s; }

				#navigation ul.sub-menu li:hover > a{
					opacity:0.8;
					background-color:transparent;
				}

			',$active_menu_background_color) : "" ; 


			// active menu top border color
			$css .= ! empty( $active_menu_border_color ) ? sprintf('
		
				#navigation_bar > ul > li.current_page_item > a:after,
				#navigation_bar > ul > li.current-menu-ancestor > a:after,
			 	#navigation_bar > ul > li:hover > a:after,
			 	#navigation_bar > ul > li > a:after
				{ background-color: %1$s; }

				#navigation .sub-menu li a:hover, #navigation .sub-menu li:hover > a{  
					box-shadow: inset 2px 0 0 %1$s;
				}

			',$active_menu_border_color) : "" ;


			// active menu font color
			$css .= ! empty( $active_menu_font_color ) ? sprintf('
		
				#navigation_bar > ul > li.current_page_item > a, 
				#navigation_bar > ul > li.current-menu-ancestor > a, 
				#navigation_bar > ul > li > a:hover, 
				#navigation_bar > ul > li:hover > a
				{ color: %1$s; }

			',$active_menu_font_color) : "" ;

			// active menu subtitle font color
			$css .= ! empty( $active_subtitle_font_color ) ? sprintf('
					
				#navigation_bar > ul > li.current_page_item > a span, 
				#navigation_bar > ul > li.current-menu-ancestor > a span, 
				#navigation_bar > ul > li > a:hover span,
				#navigation_bar > ul > li:hover > a span
				{ color: %s; }

			',$active_subtitle_font_color) : "" ; 


			// bar_background_color
			$css .= ! empty( $bar_background_color ) ? sprintf('
					
				#navigation_bar, #navigation ul.sub-menu, html .nav_border, .multicolumn-holder
				{ background-color: %s; }
 
			',$bar_background_color) : "" ; 

			// bar_background_image
			$css .= ! empty( $bar_background_image ) ? sprintf('
					
				.nav_border, .multicolumn-holder, #navigation .sub-menu { 
					background-image: url( %1$s );
					background-attachment: scroll;  
					background-position: center center;
					background-repeat: repeat;
			 	}

			 	.nav_border{border:none;}
			',$bar_background_image) : "" ; 

			//fix background if only color selected
			$css .= ! empty( $bar_background_color ) && empty( $bar_background_image ) ? sprintf('
					
				#navigation_bar, #navigation ul, html .stuck .nav_border{ 
					background-image: none;
			 	}

			',$bar_background_image) : "" ; 

			// bar_border_color
			$css .= ! empty( $bar_border_color ) ? sprintf('
				#navigation_bar > ul > li > a, #navigation {border-color:transparent;}
				#navigation ul li{border-width:0}
				#navigation ul li a {border-bottom:0 }
				#navigation_bar, html .stuck .nav_border {border-width:0 0 1px 0;}
				.search-bar, .search-bar form input:focus{background:transparent;}

				.nav_border, #navigation_bar, #navigation li, #navigation ul li a, html .stuck .nav_border, .search-bar, 
			 	#navigation li:first-child, .multicolumn-holder,
			 	#navigation .multicolumn-holder a,
			 	#navigation_bar .multicolumn-holder > ul,
			 	#navigation .sub-menu,
			 	#navigation .sub-menu li,
			 	.menu-style-two #header .nav_border,
				#navigation_bar #navigation li:last-child
				{ border-color: %1$s; }

				.responsive #navigation_bar li a, .responsive .stuck #navigation_bar li a{
					border-color: %1$s !important; 
				} 

			 	.search-bar .icon-search-1
				{ color: %1$s; }

			',$bar_border_color) : "" ; 
		}
		
		return $css; 
}

#
#   Create a color set for top bar
#
function create_rt_top_bar_color_css(){

		$css = '';

		if(  get_option( RT_THEMESLUG.'_top_bar_colorset') == "new" ){

			$top_bar_link = get_option( RT_THEMESLUG.'_top_bar_link');
			$top_bar_link_hover = get_option( RT_THEMESLUG.'_top_bar_link_hover');
			$top_bar_border = get_option( RT_THEMESLUG.'_top_bar_border');
			$top_bar_social_media = get_option( RT_THEMESLUG.'_top_bar_social_media');

			// top_bar_link
			$css .= ! empty( $top_bar_link ) ? sprintf('
		
				.top_links a,
				.top_links
				{ color: %s; }

			',$top_bar_link) : "" ;

			// top_bar_link_hover
			$css .= ! empty( $top_bar_link_hover ) ? sprintf('
		
				.top_links a:hover
				{ color: %s; }

			',$top_bar_link_hover) : "" ;

			// top_bar_border
			$css .= ! empty( $top_bar_border ) ? sprintf('
		
				.top_links > li,
				.flags li,
				.flags
				{ border-color: %1$s; }

			',$top_bar_border) : "" ;
 
	 		// social media base color
			$css .= ! empty( $top_bar_social_media ) ? sprintf('
				#top_bar .social_media li a
				{ background-color:%1$s; } 			
			',$top_bar_social_media) : "" ;

		}
		
		return $css; 
}

#   Create a color set for bottom bar
#
function create_rt_bottom_bar_color_css(){


		$css = '';

		if(  get_option( RT_THEMESLUG.'_bottom_bar_colorset') == "new" ){

			$bottom_bar_font = get_option( RT_THEMESLUG.'_bottom_bar_font');
			$bottom_bar_link = get_option( RT_THEMESLUG.'_bottom_bar_link');
			$bottom_bar_link_hover = get_option( RT_THEMESLUG.'_bottom_bar_link_hover');
			$bottom_bar_border = get_option( RT_THEMESLUG.'_bottom_bar_border');
			$bottom_bar_social_media = get_option( RT_THEMESLUG.'_bottom_bar_social_media');

			// bottom_bar_font
			$css .= ! empty( $bottom_bar_font ) ? sprintf('
		
				#footer .part1
				{ color: %s; }

			',$bottom_bar_font) : "" ;

			// bottom_bar_link
			$css .= ! empty( $bottom_bar_link ) ? sprintf('
		
				ul.footer_links a,
				ul.footer_links,
				#footer .part1 a 
				{ color: %s; }

			',$bottom_bar_link) : "" ;

			// bottom_bar_link_hover
			$css .= ! empty( $bottom_bar_link_hover ) ? sprintf('
		
				ul.footer_links a:hover,
				#footer .part1 a:hover 
				{ color: %s; }

			',$bottom_bar_link_hover) : "" ;

			// bottom_bar_border
			$css .= ! empty( $bottom_bar_border ) ? sprintf('
		
				ul.footer_links li,
				#footer
				{ border-color: %1$s; }

			',$bottom_bar_border) : "" ;
 
	 		// social media base color
			$css .= ! empty( $bottom_bar_social_media ) ? sprintf('
				#footer .social_media li a
				{ background-color:%1$s; } 			
			',$bottom_bar_social_media) : "" ;

		}
		
		return $css; 
}

#
#   Create a color set
#
function create_rt_color_css( $color_set = array(), $container = "" ){

		$css = '';
 
		extract(shortcode_atts(array(
			"primary" => "",
			"font" => "",
			"light_font" => "",
			"headings" => "",
			"heading_links" => "",
			"link" => "",
			"link_hover" => "",
			"highlighted" => "",
			"border" => "",
			"social_media" => ""
		), $color_set ) ); 

 
		// Primary color
		$css .= ! empty( $primary ) ? sprintf('
	
					/* ----------------------------------------------------	
						PRIMARY COLOR   ( for %2$s )
					------------------------------------------------------- */ 
	
					/* backgrounds */
					%2$s .social_share .s_buttons,   
					%2$s .woocommerce span.onsale,
					.woocommerce-page %2$s span.onsale,
					.woocommerce %2$s mark,
					%2$s .woocommerce .addresses .title .edit, .woocommerce-page %2$s .addresses .title .edit,
					%2$s .flex-active-slide .caption-one,
					%2$s .flexslider .flex-direction-nav a,
					%2$s .flexslider .carousel .flex-direction-nav a,
					%2$s .imgeffect a,		 
					%2$s .featured .default_icon .heading_icon,
					%2$s .medium_rounded_icon,
					%2$s .big_square_icon,
					%2$s .title_icon,
					%2$s .button_.default,
					%2$s .pricing_table .table_wrap.highlight ul > li.price div:before,
					%2$s .featured a.read_more, %2$s .featured a.more-link,
					%2$s .carousel-holder.with_heading .owl-controls .owl-buttons div,
					%2$s .rt-toggle ol li .toggle-number,
					%2$s .rt-toggle ol li.open .toggle-number,
					%2$s .latest-news .featured-image .date,
					%2$s .social_share .icon-share:before,
					%2$s .commententry .navigation > div, %2$s .commententry .navigation a,				 
					%2$s .blog_list h1[class^="icon-"]:before,
					%2$s .blog_list h2[class^="icon-"]:before,
					%2$s hr.style-six:before,
					%2$s .with_borders .box:before, %2$s .portfolio_boxes .box:before,
					%2$s .with_borders .box:after, %2$s .portfolio_boxes .box:after,
					%2$s .tab-style-three .tabs .with_icon a.current > span:before,
					%2$s .sidebar .featured_article_title:before
					{
						background: %1$s;
					}
	
					%2$s .pricing_table .table_wrap.highlight ul > li.caption,
					%2$s .flex-active-slide .caption-one, %2$s .flexslider .flex-direction-nav a, %2$s .flexslider .carousel .flex-direction-nav a, %2$s .imgeffect a,
					%2$s .chained_contents > ul li:hover .image.chanied_media_holder:after,
					%2$s .chained_contents li:hover .icon_holder.rounded:before
					{
						background-color:%1$s;  	
					}
	
					%2$s a,
					%2$s .widget_archive ul li a:hover, %2$s .widget_links ul li a:hover, %2$s .widget_nav_menu ul li a:hover, %2$s .widget_categories ul li a:hover, %2$s .widget_meta ul li a:hover, %2$s .widget_recent_entries  ul li a:hover, %2$s .widget_pages  ul li a:hover, %2$s .widget_rss ul li a:hover, %2$s .widget_recent_comments ul li a:hover, %2$s .widget_rt_categories ul li a:hover, %2$s .widget_product_categories ul li a:hover, 
					%2$s .imgeffect a:hover,
					%2$s .woocommerce .star-rating, .woocommerce-page %2$s  .star-rating,
					%2$s .woocommerce .cart-collaterals .cart_totals h2:before, .woocommerce-page %2$s .cart-collaterals .cart_totals h2:before,
					%2$s .woocommerce .cart-collaterals .shipping_calculator h2:before, .woocommerce-page %2$s .cart-collaterals .shipping_calculator h2:before, .woocommerce-account %2$s .woocommerce .addresses h3:before,
					%2$s .heading_icon,
					%2$s .large_icon,
					%2$s .big_icon,
					%2$s .big_rounded_icon,
					%2$s .featured a.read_more:hover, %2$s a.more-link:hover,
					%2$s .latest-news-2 a.title:hover,
					%2$s .social_share:hover .icon-share:before,
					%2$s h1 a:hover, %2$s h2 a:hover, %2$s h3 a:hover, %2$s h4 a:hover, %2$s h5 a:hover, %2$s h6 a:hover,
					%2$s .with_icons.colored > li span,
					%2$s #reply-title:before,
					%2$s a, %2$s .widget_archive ul li a:hover, %2$s .widget_links ul li a:hover, %2$s .widget_nav_menu ul li a:hover, %2$s .widget_categories ul li a:hover, %2$s .widget_meta ul li a:hover, %2$s .widget_recent_entries ul li a:hover, %2$s .widget_pages ul li a:hover, %2$s .widget_rss ul li a:hover, %2$s .widget_recent_comments ul li a:hover, %2$s .widget_rt_categories ul li a:hover, %2$s .widget_product_categories ul li a:hover,
					%2$s .imgeffect a:hover, 
					%2$s .heading_icon, %2$s .large_icon, %2$s .big_icon, 
					%2$s .big_rounded_icon, %2$s a.read_more:hover, %2$s a.more-link:hover, %2$s .latest-news-2 a.title:hover,
					%2$s .social_share:hover .icon-share:before, %2$s .with_icons.colored > li span, %2$s #reply-title:before,
					%2$s .content.full > .row > hr.style-six:after,
					%2$s .pin:after,
					%2$s .filter_navigation li a.active:before, %2$s .filter_navigation li a.active, %2$s .filter_navigation li a:hover,
					%2$s hr.style-eight:after,
					%2$s ul.page-numbers li a:hover, %2$s ul.page-numbers li .current,
					%2$s .widget ul li.current-menu-item > a, 
					%2$s .widget_rt_categories ul li.current-cat > a,
					%2$s .widget_product_categories ul li.current-cat > a
					{
						color: %1$s;	 	 
					}
	
	
					%2$s .big_rounded_icon.loaded,
					%2$s .featured a.read_more, %2$s .featured a.more-link,
					%2$s .social_share .s_buttons, 
					%2$s .pin:after,
					%2$s hr.style-eight,
					%2$s .with_icons.icon_borders.colored li span
					{ 
						border-color: %1$s;
					}
					 
					%2$s .tabs_wrap .tabs a.current, %2$s .tabs_wrap .tabs a.current:hover, %2$s .tabs_wrap .tabs a:hover, %2$s .tabs_wrap .tabs li.current a 
					{  	
						border-bottom-color:%1$s;
					}
	
					%2$s .vertical_tabs ul.tabs a.current, %2$s .vertical_tabs ul.tabs a.current:hover, %2$s .vertical_tabs ul.tabs a:hover, %2$s .vertical_tabs ul.tabs li.current a 
					{  	
						border-right-color: %1$s;
					}   
	
					/* ----------------------------------------------------	
						FIXES
					------------------------------------------------------- */ 
					%2$s .imgeffect a, %2$s .featured a.read_more{
						color: #fff;
					}
	
					%2$s .imgeffect a:hover, %2$s .featured a.read_more:hover{
						background: #fff;
					}					
		',
				$primary,  // primary color
				$container //container selector 

		) : "" ;
	 

		// font color
		$css .= ! empty( $font ) ? sprintf('
					
					/* ----------------------------------------------------	
						FONT COLOR   ( for %2$s )
					------------------------------------------------------- */ 
		
	
					/* font colors */
					%2$s,
					%2$s .tabs_wrap .tabs a,
					%2$s .banner .featured_text,
					%2$s .rt_form input[type="button"], %2$s .rt_form input[type="submit"],
					%2$s .rt_form input[type="text"], %2$s .rt_form select, %2$s .rt_form textarea,
					%2$s .woocommerce a.button, .woocommerce-page %2$s a.button, %2$s %2$s .woocommerce button.button, .woocommerce-page %2$s button.button, %2$s .woocommerce input.button, .woocommerce-page %2$s input.button, %2$s .woocommerce #respond input#submit, .woocommerce-page %2$s #respond input#submit, %2$s .woocommerce #content input.button, .woocommerce-page %2$s #content input.button, %2$s .woocommerce a.button.alt, .woocommerce-page %2$s a.button.alt, %2$s .woocommerce button.button.alt, .woocommerce-page %2$s button.button.alt, %2$s .woocommerce input.button.alt, .woocommerce-page %2$s input.button.alt, %2$s .woocommerce #respond input#submit.alt, .woocommerce-page %2$s #respond input#submit.alt, %2$s .woocommerce #content input.button.alt, .woocommerce-page %2$s #content input.button.alt,
					%2$s .widget_archive ul li a, %2$s .widget_links ul li a, %2$s .widget_nav_menu ul li a, %2$s .widget_categories ul li a, %2$s .widget_meta ul li a, %2$s .widget_recent_entries ul li a, %2$s .widget_pages ul li a, %2$s .widget_rss ul li a, %2$s .widget_recent_comments ul li a, %2$s .widget_product_categories ul li a,
					%2$s .info_box,
					%2$s .breadcrumb,
					%2$s .page-numbers li a, %2$s .page-numbers li > span,
					%2$s .rt_comments ol.commentlist li a, %2$s .cancel-reply a, 
					%2$s .rt_comments ol.commentlist li .comment-body .comment-meta a, %2$s #cancel-comment-reply-link,
					%2$s .breadcrumb a, 
					%2$s .breadcrumb span,  
					%2$s #slogan_text,
					%2$s .filter_navigation li a,
					%2$s .widget ul
					{
						color: %1$s;
					}
		',
				$font,  // font color
				$container //container selector 

		) : "" ;
	 

		// light font color
		$css .= ! empty( $light_font ) ? sprintf('

					/* ----------------------------------------------------	
						LIGHT FONT COLOR   ( for %2$s )
					------------------------------------------------------- */ 
	
					/* light font color */
					%2$s .blog_list .post_data, %2$s .blog_list .post_data a,
					%2$s .woocommerce .star-rating, %2$s .woocommerce-page .star-rating,
					%2$s .testimonial .text .icon-quote-left,
					%2$s .testimonial .text .icon-quote-right,
					%2$s .client_info,
					%2$s .rt_form label,
					%2$s i.decs_text,
					%2$s .client_info,
					%2$s .with_icons > li span,
					%2$s .with_icons.light > li span,
					%2$s .price del,
					%2$s .product_meta,
					%2$s span.top,
					%2$s .rt_comments ol.commentlist li .comment-body .comment-meta, %2$s .cancel-reply,
					%2$s .rt_comments ol.commentlist li .comment-body .author-name,
					%2$s .rt_comments ol.commentlist li p,
					%2$s li.comment #respond,
					%2$s .recent_posts .widget-meta,
					%2$s .content_block.archives .head_text h1, %2$s .content_block.archives .head_text h2
					{
						color: %1$s;
					}
		',
				$light_font,  // font color
				$container //container selector 

		) : "" ;
	 

		// heading font color
		$css .= ! empty( $headings ) ? sprintf('

					/* ----------------------------------------------------	
						HEDING COLOR   ( for %2$s )
					------------------------------------------------------- */ 
	
					/*	heading colors and links  */
					%2$s h1 a, %2$s h2 a, %2$s h3 a, %2$s h4 a, %2$s h5 a, %2$s h6 a,
					%2$s h1, %2$s h2, %2$s h3, %2$s h4, %2$s h5, %2$s h6,
					%2$s .latest-news-2 .title,
					%2$s.woocommerce ul.cart_list li a, 
					%2$s .woocommerce ul.product_list_widget li a, 
					.woocommerce-page %2$s ul.cart_list li a, 
					.woocommerce-page %2$s ul.product_list_widget li a,
					%2$s .heading h1, %2$s .heading h2,
					%2$s .footer .featured_article_title,
					%2$s .recent_posts .title a
					{
						color:%1$s;
					}
		',
				$headings,  // font color
				$container //container selector 

		) : "" ;
	 

		// heading:hover font color
		$css .= ! empty( $heading_links ) ? sprintf('
					 
					/* ----------------------------------------------------	
						HEDING:hover COLOR   ( for %2$s )
					------------------------------------------------------- */ 
	
					/*	heading hover color  */
					%2$s h1 a:hover,%2$s h2 a:hover,%2$s h3 a:hover,%2$s h4 a:hover,%2$s h5 a:hover,%2$s h6 a:hover,
					%2$s .latest-news-2 .title:hover,
					%2$s .woocommerce  ul.cart_list li a:hover, %2$s .woocommerce ul.product_list_widget li a:hover, .woocommerce-page %2$s ul.cart_list li a:hover, .woocommerce-page %2$s ul.product_list_widget li a:hover
					{ 
						color: %1$s;
					} 
		',
				$heading_links,  // font color
				$container //container selector 

		) : "" ;


		// link color
		$css .= ! empty( $link ) ? sprintf('
					 
					/* ----------------------------------------------------	
						LINK COLOR   ( for %2$s )
					------------------------------------------------------- */ 
	
					/*	links  */
					%2$s a,
					%2$s .latest-news a.title,
					%2$s .doc_icons ul li a,
					%2$s .filter_navigation li a.active:before
					{
						color: %1$s;
					}
		',
				$link,  // font color
				$container //container selector 

		) : "" ;


		// link:hover color
		$css .= ! empty( $link_hover ) ? sprintf('
					 
					/* ----------------------------------------------------	
						LINK:HOVER COLOR   ( for %2$s )
					------------------------------------------------------- */ 
	
					/*	links hover */
					%2$s a:hover,
					%2$s .latest-news a.title:hover,
					%2$s .doc_icons ul li a:hover,
					%2$s .woocommerce ul.cart_list li a:hover, %2$s .woocommerce ul.product_list_widget li a:hover, .woocommerce-page %2$s ul.cart_list li a:hover, .woocommerce-page %2$s ul.product_list_widget li a:hover,
					%2$s .rt_comments ol.commentlist li .comment-body .comment-meta a:hover, %2$s #cancel-comment-reply-link:hover,
					%2$s .breadcrumb a:hover span,
					%2$s .blog_list .post_data a:hover,
					%2$s .widget ul li a:hover 
					{ 
						color: %1$s;
					} 
		',
				$link_hover,  // font color
				$container //container selector 

		) : "" ;


		// highlighted content background
		$css .= ! empty( $highlighted ) ? sprintf('
					 
					/* ----------------------------------------------------	
						HIGHLIGHTED CONTENT COLOR   ( for %2$s )
					------------------------------------------------------- */ 
	
					/* colors highlighted content background colors */

					%2$s section.team.style-three .half-background:before,
					%2$s section.team.style-three .half-background,
					%2$s section.team.style-three hr:after,
					%2$s section.team.style-two .half-background:before,
					%2$s section.team.style-two .half-background,
					%2$s section.team.style-two hr:after,
					%2$s div.date_box .year,
					%2$s blockquote,
					%2$s .rt_form input[type="text"], %2$s .rt_form select, %2$s .rt_form textarea,
					%2$s .tab-style-two ul.tabs,
					%2$s .product_images,
					%2$s .rt_comments .comment-holder,
					%2$s .rt_comments ol.commentlist li .comment-body .comment-meta .comment-reply:hover,
					%2$s .info_box,
					%2$s .search_highlight, 
					%2$s table th,
					%2$s .vertical_tabs ul.tabs,
					%2$s .vertical_tabs ul.tabs a.current, %2$s .vertical_tabs ul.tabs a.current:hover, %2$s .vertical_tabs ul.tabs a:hover, %2$s .vertical_tabs ul.tabs li.current a,					
					%2$s .tab-style-two ul.tabs a.current:hover, %2$s .tab-style-two ul.tabs a:hover,
					%2$s .tab-style-three ul.tabs
					{
						background-color: %1$s;
					}


					/* ----------------------------------------------------	
						GRADIENT COLOR  ( for %2$s )
						as HIGHLIGHTED CONTENT COLOR for custom colored areas
					------------------------------------------------------- */ 
					
					/* gradient  */
					%2$s .gradient
					{			
						background:  %1$s; 
						filter: none;
					}

					/* ----------------------------------------------------	
						REMOVE ACTIVE ITEM SHADOWS OF TABS STYLE 3  ( for %2$s )
					------------------------------------------------------- */ 

					%2$s .tab-style-three ul.tabs a.current, %2$s .tab-style-three ul.tabs a.current:hover, %2$s .tab-style-three ul.tabs a:hover, %2$s .tab-style-three ul.tabs li.current a {
						-o-box-shadow: none;
						-moz-box-shadow: none;
						-webkit-box-shadow: none;
						box-shadow: none;
					}					
		',
				$highlighted,  // font color
				$container //container selector 

		) : "" ;


		// border colors 
		$css .= ! empty( $border ) ? sprintf('
					  
					/* ----------------------------------------------------	
						BORDER COLOR   ( for %2$s )
					------------------------------------------------------- */ 
	
					/* border colors */
					%2$s div.date_box,
					%2$s .post_data span,
					%2$s hr,
					%2$s .vertical_tabs .tabs_wrap,
					%2$s .vertical_tabs ul.tabs li,
					%2$s .vertical_tabs div.pane,				
					%2$s .tabs_wrap .tabs li,
					%2$s .banner.withborder,
					%2$s .rt_form input[type="text"], %2$s .rt_form select, %2$s .rt_form textarea,
					%2$s .sidebar .widget,
					%2$s section.content.left,
					%2$s .tab-style-two,
					%2$s .product_images,
					%2$s .rounded_carousel_holder,
					%2$s .rt_comments .comment-holder,
					%2$s .rt_comments .commentlist > li:before,
					%2$s .rt_comments .commentlist .children > li:before,
					%2$s .rt_comments .commentlist .children > li:after,
					%2$s .wooselect,
					%2$s section.content.right,
					%2$s .info_box,
					%2$s .woocommerce #reviews #comments ol.commentlist li .comment-text, .woocommerce-page %2$s #reviews #comments ol.commentlist li .comment-text,
					%2$s ul.page-numbers,
					%2$s .page-numbers li a, %2$s .page-numbers li > span,
					%2$s .woocommerce table.shop_table td, .woocommerce-page %2$s table.shop_table td, %2$s .woocommerce table.shop_table, .woocommerce-page %2$s table.shop_table,
					%2$s table th,
					%2$s table td, 
					%2$s .woocommerce .cart-collaterals .cart_totals tr td, .woocommerce-page %2$s .cart-collaterals .cart_totals tr td, %2$s .woocommerce .cart-collaterals .cart_totals tr th, .woocommerce-page %2$s .cart-collaterals .cart_totals tr th,
					%2$s table,
					%2$s .rt-toggle ol li .toggle-content,
					%2$s .footer .featured_article_title,
					%2$s .with_borders > .box,
					%2$s .price ins,
					%2$s .content.left .tab-style-three, %2$s .content.right .tab-style-three,
					#container %2$s .sidebar .widget,
					%2$s .filter_navigation,
					%2$s .filter_navigation li a,
					%2$s .portfolio_item_holder,
					%2$s div.breadcrumb,
					%2$s .product_images .slider-carousel,
					%2$s .hr:after, %2$s .content_block.archives .head_text h1:after, %2$s .content_block.archives .head_text h2:after,
					%2$s .horizontal_chained_contents .chanied_media_holder:after,
					%2$s .chained_contents > ul:after,
					%2$s .chained_contents > ul .chanied_media_holder:before
					{
					border-color:%1$s;		
					}
	
					%2$s .blog_list .post_data,
					%2$s div.date_box .year,
					%2$s .rt-toggle ol,
					%2$s .woocommerce .widget_shopping_cart .total, .woocommerce-page %2$s .widget_shopping_cart .total,
					%2$s li.comment #respond
					{
					border-top-color:%1$s;	
					}
	
					%2$s .vertical_tabs ul.tabs a.current, %2$s .vertical_tabs ul.tabs a.current:hover, %2$s .vertical_tabs ul.tabs a:hover, %2$s .vertical_tabs ul.tabs li.current a,
					%2$s .rt-toggle ol li,
					%2$s .tabs_wrap .tabs,
					%2$s .line,
					%2$s .woocommerce ul.cart_list li:after, %2$s .woocommerce ul.product_list_widget li:after, .woocommerce-page %2$s ul.cart_list li:after, .woocommerce-page %2$s ul.product_list_widget li:after,
					%2$s .widget_archive ul li, %2$s .widget_links ul li, %2$s .widget_nav_menu ul li, %2$s .widget_categories ul li, %2$s .widget_meta ul li, %2$s .widget_recent_entries ul li, %2$s .widget_pages ul li, %2$s .widget_rss ul li, %2$s .widget_recent_comments ul li, %2$s .widget_product_categories ul li,
					%2$s .small_box .blog-head-line
					{
					border-bottom-color:%1$s;		
					}
	
					/* colors that matches the border color */
					%2$s hr,
					%2$s blockquote p:first-child:before,
					%2$s blockquote p:last-child:after,
					%2$s .testimonial .text .icon-quote-left,
					%2$s .testimonial .text .icon-quote-right,
					%2$s .title_line:before,
					%2$s .woocommerce ul.cart_list li:before, %2$s .woocommerce ul.product_list_widget li:before, .woocommerce-page %2$s ul.cart_list li:before, .woocommerce-page %2$s ul.product_list_widget li:before,
					%2$s .woocommerce .star-rating:before, .woocommerce-page %2$s .star-rating:before,
					%2$s .filter_navigation:before,
					%2$s .filter_navigation:after,
					%2$s .heading-style-2:before,
					%2$s .heading-style-2:after,
					%2$s .hr:after, %2$s .content_block.archives .head_text h1:after, %2$s .content_block.archives .head_text h2:after
					{
					color:%1$s;		
					}
	
					/* background colors that matches the border color */
					%2$s .title_line:before,
					%2$s .rt_form input:focus, %2$s .rt_form select:focus, %2$s .rt_form textarea:focus,
					%2$s .rt_comments ol.commentlist li .comment-body .comment-meta .comment-reply,					
					%2$s .title_line .featured_article_title:after,
					%2$s .filter_navigation:before,
					%2$s .filter_navigation:after,
					%2$s .heading-style-2:before,
					%2$s .heading-style-2:after,
					%2$s .chained_contents > ul .chanied_media_holder:after
					{
					background-color:%1$s;		
					} 

					/* shadow colors that matches the border color */
					%2$s .with_borders > .last-row.box:last-child,%2$s .with_borders > .box.last,
					%2$s .with_effect.with_borders .box:hover .product_info
					{
					box-shadow: 1px 0 0 %1$s;
					}

					%2$s .tab-style-three ul.tabs { 
						box-shadow: 0 -1px 0 %1$s inset;
					}

					%2$s .rt_form input[type="text"], %2$s .rt_form input[type="email"], %2$s .rt_form select, %2$s .rt_form textarea, %2$s .wpcf7 input[type="text"], %2$s .wpcf7 input[type="email"], %2$s .wpcf7 select, %2$s .wpcf7 textarea {
						box-shadow: 1px 2px 0 rgba(0,0,0,0.03); 
					}

		',
				$border,  // font color
				$container //container selector 

		) : "" ;


		// social media base color
		$css .= ! empty( $social_media ) ? sprintf('

					/* ----------------------------------------------------	
						SOCIAL MEDIA BASE COLOR   ( for %2$s )
					------------------------------------------------------- */ 
	
					/* social media base color */
					%2$s .social_media li a{
						background-color:%1$s;  	
					} 			
		',
				$social_media,  // font color
				$container //container selector 

		) : "" ;
  

		return $css; 

}

#
#   Create background set
#
function rt_create_background_css( $background_options = array(), $container = "" ){

		$css = ''; 

		extract(shortcode_atts(array(
			"background_color" => "",
			"background_image_url" => "",
			"background_attachment" => "",
			"background_position" => "",
			"background_repeat" => "",
			"background_size" => ""
		), $background_options ) ); 

		
		// background color
		$css .= ! empty( $background_color ) ? sprintf('

	
					/* ----------------------------------------------------	
						THE CONTENT BACKGROUND COLOR   ( for %2$s )
					------------------------------------------------------- */ 
	
					/* content background color */
					%2$s{ 
						background-color: %1$s; 
					}
	
					/* colors must be same with content background color */
					%2$s .caption.embedded .featured_article_title,  
					%2$s hr.style-one:after,
					%2$s hr.style-two:after,
					%2$s hr.style-three:after,
					%2$s .flexslider, 
					%2$s span.top,
					%2$s .rt_comments ol ul.children,
					%2$s .flags,
					%2$s hr.style-six:after
					{
						background-color:%1$s;  	
					} 

					%2$s div.date_box
					{
						background:%1$s;  	
						box-shadow: 1px 2px 0 0 rgba(0,0,0,0.1);
						-moz-box-shadow: 1px 2px 0 0 rgba(0,0,0,0.1);
						-webkit-box-shadow: 1px 2px 0 0 rgba(0,0,0,0.1);
					} 
	
					/* ----------------------------------------------------	
						FIXES   ( for %2$s )
					------------------------------------------------------- */ 
					%2$s div.date_box .day
					{
						border-bottom: 0;
					}

					%2$s.top_content{
						border:0;
					}
	
					%2$s .rt_form input[type="text"], %2$s .rt_form select, %2$s .rt_form textarea,
					%2$s .rt_form input:focus, %2$s .rt_form select:focus, %2$s .rt_form textarea:focus,
					%2$s .tab-style-two ul.tabs a,
					%2$s .tab-style-two ul.tabs,
					%2$s .tab-style-two ul.tabs a.current, %2$s .tab-style-two ul.tabs a.current:hover, %2$s .tab-style-two ul.tabs a:hover, %2$s .tab-style-two ul.tabs li.current a,
					%2$s .wooselect
					{
						box-shadow: none;
						-webkit-box-shadow: none;
						-moz-box-shadow: none;
					}
	
					%2$s .rt_form input[type="button"], %2$s .rt_form input[type="submit"],
					%2$s .woocommerce a.button, .woocommerce-page %2$s a.button, %2$s .woocommerce button.button, .woocommerce-page %2$s button.button, %2$s .woocommerce input.button, .woocommerce-page %2$s input.button, %2$s .woocommerce #respond input#submit, .woocommerce-page %2$s #respond input#submit, %2$s .woocommerce #content input.button, .woocommerce-page %2$s #content input.button, %2$s .woocommerce a.button.alt, .woocommerce-page %2$s a.button.alt, %2$s .woocommerce button.button.alt, .woocommerce-page %2$s button.button.alt, %2$s .woocommerce input.button.alt, .woocommerce-page %2$s input.button.alt, %2$s .woocommerce #respond input#submit.alt, .woocommerce-page %2$s #respond input#submit.alt, %2$s .woocommerce #content input.button.alt, .woocommerce-page %2$s #content input.button.alt
					{
						text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.1); 
						-moz-text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.1); 
						-webkit-text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.1); 
					}	

					%2$s ul.page-numbers { 
						box-shadow: 0 2px 1px rgba(0, 0, 0, 0.05), 0 0 0 1px rgba(255, 255, 255, 0.2) inset; 
					}
		',
				$background_color,  // font color
				$container //container selector 

		) : "" ;

		// background image	

		/* ie8fix */
		$ie8fix = $background_size == "cover" || $background_size == "100% 100%" ? "
		.no-backgroundsize $container{        
			filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='{$background_image_url}', sizingMethod='scale') 	
		}":"";

		$css .= ! empty( $background_image_url ) ? sprintf('

	
					/* ----------------------------------------------------	
						THE BACKGROUND IMAGE   ( for %2$s )
					------------------------------------------------------- */ 
	
					/* content background image */
					%6$s{  
						background-image: url( %1$s );
						background-attachment: %2$s;  
						background-position: %3$s;
						background-repeat: %4$s;
						background-size: %5$s;
						-webkit-background-size: %5$s;
						-moz-background-size: %5$s;
						-o-background-size: %5$s;			 	
					}

					.mobile_device %6$s{   
						background-attachment: scroll;   
						-webkit-background-size: auto 100%;
						-moz-background-size: auto;
						-o-background-size: auto;			 	
					}

					%7$s

					%2$s.top_content{
						border:0;
					}					
		',
				$background_image_url,  // image_url  - 1 
				$background_attachment,  // attachment - 2
				$background_position,  // position - 3
				$background_repeat,  // repeat - 4
				$background_size,  // size - 5
				$container, //container selector - 6 
				$ie8fix // ie8fix - 7

		) : "" ; 


		//background color set - no background image
		$css .= empty( $background_image_url ) && ! empty( $background_color ) ? $container .'{background-image:none;}' : "";

		return $css;
}
?>