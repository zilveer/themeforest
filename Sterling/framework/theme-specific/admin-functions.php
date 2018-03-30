<?php
/*-----------------------------------------------------------------------------------*/
/*  Theme Header Output	

/*  Custom Login Logo

/*  Custom Login Logo URL
	
/*  Custom CSS Output
	
/*  Interface Options
	
/*  Google Fonts
	
/*  Theme Designer
	
/*  Add Favicon			
	
/*  Add analytics code to footer
	
/*  Hide Meta Boxes			
/*-----------------------------------------------------------------------------------*/



/*-----------------------------------------------------------------------------------*/
/* Theme Header Output - wp_head() */
/*-----------------------------------------------------------------------------------*/

// This sets up the layouts and styles selected from the options panel

if (!function_exists('siteoptions_wp_head')) {
	function siteoptions_wp_head() { 
		$shortname = "st";
	    $GLOBALS['main_stylesheet'] = get_option('st_main_scheme');
		$GLOBALS['secondary_stylesheet'] = get_option('st_secondary_scheme');
		$GLOBALS['responsive'] = get_option('st_responsive');
		
		//Styles
		echo '<link href="'. get_stylesheet_directory_uri() . '/style.css' .'" rel="stylesheet" type="text/css" media="screen" />'."\n";
		
		if($GLOBALS['main_stylesheet'] != '')
	    echo '<link href="'. TT_CSS . $GLOBALS['main_stylesheet'] .'.css'.'" rel="stylesheet" type="text/css" media="screen" />'."\n";
		
		if($GLOBALS['main_stylesheet'] == '')
	    echo '<link href="'. TT_CSS . 'primary-blue.css'.'" rel="stylesheet" type="text/css" media="screen" />'."\n"; 
			
		if($GLOBALS['secondary_stylesheet'] != 'default')
	    echo '<link href="'. TT_CSS . $GLOBALS['secondary_stylesheet'].'.css'.'" rel="stylesheet" type="text/css" media="screen" />'."\n";
		
		if($GLOBALS['responsive'] == 'false')
	    echo '<link href="'. get_template_directory_uri() .'/css/_mobile.css'.'" rel="stylesheet" type="text/css" media="screen" />'."\n";

		echo '<link href="'. get_template_directory_uri() .'/css/_font-awesome.css'.'" rel="stylesheet" type="text/css" media="screen" />'."\n";

		//Check for WooCommerce and display Stylesheet
		if (class_exists('woocommerce')){
		echo '<link href="'. get_template_directory_uri() . '/css/_woocommerce.css' .'" rel="stylesheet" type="text/css" media="screen" />'."\n";
		}	              
	  }			
	}

add_action('wp_head', 'siteoptions_wp_head');


/*---------------------------------------------------------------*/
/*	 Custom Login Logo
/*---------------------------------------------------------------*/
function truethemes_custom_login_logo(){
        global $ttso;
		$loginlogo = $ttso->st_loginlogo;
		if ( ! empty( $loginlogo ) ) {
        echo '<style type="text/css">
            .login h1 a { 
            	background-image:url('.$loginlogo.') !important;
            	background-size:inherit !important;
            	width: auto !important;

            }
        </style>';
        }
}
add_action('login_head', 'truethemes_custom_login_logo');




/*---------------------------------------------------------------*/
/*	 Custom Login Logo URL
/*---------------------------------------------------------------*/
function truethemes_change_wp_login_url() {
    return esc_url( home_url() );
}
add_filter('login_headerurl', 'truethemes_change_wp_login_url');
    
function truethemes_change_wp_login_title() {
    return get_option('blogname');
}
add_filter('login_headertitle', 'truethemes_change_wp_login_title');




/*
* function to push in custom css font color and font-size etc..
* for use in truethemes_settings_css()

* @param string $option_value, assigned option value from database
* @param string $css_code, for custom css code.*/
function truethemes_push_custom_css($option_value,$css_code){

global $css_array;

	if($option_value!=''&&$option_value!='--select--'){	
	 $option_value_code = $css_code;
	 array_push($css_array,$option_value_code);	
	}
}

/*
/* function to push in custom font type.
* for use in truethemes_settings_css()

* @param string $option_value, option value from database
* @paran string $css_code, for custom css font code*/
function truethemes_push_custom_font($option_value,$css_code){
global $css_array;
global $css_link_container;
$google_font_types = array(
		'Droid Sans',
		'Cabin',
		'Questrial',
		'Cuprum',
		'News Cycle',
		'Enriqueta',
		'Open Sans',
		'Arvo',
		'Kreon',
		'Indie Flower',
		'Josefin Sans'
		);
	
    if( ($option_value != 'nofont' && $option_value != '')){
	        $custom_logo_font_link = '<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family='.$option_value.'" />'."\n";	
			$custom_logo_font_code = $css_code;
						
			//check if font is google font, if yes, we provide font link
			if(in_array($option_value,$google_font_types)){
		
			if(!in_array($custom_logo_font_link,$css_link_container)){
			//check if already in link container, if not then we add the css link.
				array_push($css_link_container,$custom_logo_font_link);
				}			
			}
				
			array_push($css_array,$custom_logo_font_code);
	 }
}




/*
*  set global css array and css link container
*  for use in truethemes_setting_css() and truethemes_push_custom_css*/

if(!isset($css_array)){
$css_array = array();
}

if(!isset($css_link_container)){
$css_link_container = array();
}

/*-----------------------------------------------------------------------------------*/
/* Custom CSS Output
/*-----------------------------------------------------------------------------------*/

function truethemes_settings_css(){
global $css_array;
global $css_link_container;


//retrieve all settings from site options panel
global $ttso;
//modifed since 2.1.3 to prevent sanitize of custom css
$custom_css   		   = htmlspecialchars_decode(stripslashes($ttso->st_custom_css),ENT_QUOTES);
$toolbar_css           = $ttso->st_toolbar;
$dropdown_css		   = $ttso->st_dropdown;
$google_font		   = $ttso->st_google_font;
$google_font_open_sans = $ttso->st_google_font_open_sans;
$custom_google_font    = $ttso->st_custom_google_font;

$body_bg_color 							= $ttso->st_body_bg_color;
$body_bg_image						    = $ttso->st_body_bg_image;
$body_bg_image_select				    = $ttso->st_select_body_bg;
$body_designer_page_background_position = $ttso->st_designer_page_background_position;
$body_designer_page_background_repeat   = $ttso->st_designer_page_background_repeat;

$toolbar_bg_color    = $ttso->st_toolbar_bg_color;
$banner_bg_color     = $ttso->st_banner_bg_color;
$menubar_bg_color    = $ttso->st_menubar_bg_color;
//$content_bg_color    = $ttso->st_content_bg_color; - will include in future release
$footer_bg_color     = $ttso->st_footer_bg_color;
$banner_overlay      = $ttso->st_banner_overlay;
$shadow_style        = $ttso->st_shadow_style;
$boxedlayout_shadow  = $ttso->st_boxedlayout_shadow;
$toolbar_padding         = $ttso->st_toolbar_padding;
$interior_banner_padding = $ttso->st_interior_banner_padding;
$footer_padding          = $ttso->st_footer_padding;
$nav_bar_padding         = $ttso->st_nav_bar_padding;




/*--------------------------------------------------------------------*/
/* Interface Options 
/*--------------------------------------------------------------------*/

//custom css
if(!empty($custom_css)){
	array_push($css_array,$custom_css);
}


//navigation css
if($dropdown_css =='false'){
	$drop_css_code = 'header nav .sub-menu, .has_submenu > a:after {display: none !important;}';
	array_push($css_array,$drop_css_code);	
}

//toolbar css
if($toolbar_css =='false'){
	$toolbar_css_code = '.top-aside {display: none !important;}';
	array_push($css_array,$toolbar_css_code);	
}



/*--------------------------------------------------------------------*/
/* Google Fonts 
/*--------------------------------------------------------------------*/

//new option since @2.0.3 - Open Sans Recommendation
if( ($google_font_open_sans == 'true')){
	$google_font_open_sans_link = '<link href="//fonts.googleapis.com/css?family=Open+Sans:400,600,300" rel="stylesheet" type="text/css">'."\n";

$google_font_open_sans_code = '

body,
header nav,
.footer-callout,
#gallery-nav,
footer .foot-heading,
h1,
h2,
h3,
h4,
h5,
h6,
.page-banner-heading{
	font-family:\'Open Sans\',arial,sans-serif;
	-webkit-font-smoothing: antialiased !important;
	}
	.top-aside .social_icons a {
		font-weight:600;padding-top:3px;
	}
	nav a {
		font-size:14.5px;padding:3px 4px;
	}
	header .sub-menu a, .sidebar li, input, textarea, select {
		font-size:12px;
	}
	div.breadcrumbs {
		font-size:10px;
	}
	.metadata, .small_banner .page-banner-description {
		font-size:12px;
	}
	.footer-callout-content p {
		font-size:16px;
	}
	.social_icons a {
		padding-bottom:8px;
	}
	.small_banner .page-banner-heading {
		font-weight:300;padding-bottom:3px;
	}
	h3 {
		font-size: 16px;font-weight: 600;
	}
	.business-hours .day, strong, .tabs_type_1 dt, .tabs_type_2 dt, .accordion dt, .tt-contentbox-title span, .tt-dropcap-round, .tt-dropcap-square, .tt-dropcap-text {
		font-weight: 600;
	}
	.preview h2, .preview h2 a {
		font-size:22px;
	}
	.widget-heading {
		font-size: 15px;font-weight: 600;
	}
	p.callout-heading {
		letter-spacing:0px;
	}
	.banner-slider h1, .banner-slider h2, .banner-slider h3, .banner-slider h4, .banner-slider h5, .banner-slider h6 {
		font-weight: 300;
	}
			'."\n";
			
				array_push($css_link_container,$google_font_open_sans_link);
				array_push($css_array,$google_font_open_sans_code);
				  }
	
		if( ($google_font != 'nofont' && $custom_google_font == '')){
				$google_font_link = '<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family='.$google_font.'" />'."\n";	
				$google_font_code = 'h1, h2, h3, h4, h5, h6, .page-banner-heading, footer .foot-heading{font-family:\''.$google_font.'\', Arial, sans-serif;font-weight:400;}'."\n";
				array_push($css_link_container,$google_font_link);
				array_push($css_array,$google_font_code);
				  }
		
		if($custom_google_font != ''){
		
				//remove space and add + sign if there is space found in user entered custom font name.
				//the google font name in css link has a plus sign.
				$custom_google_font_name = str_replace(" ","+",$custom_google_font); 
		
				$google_custom_link =  '<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family='.$custom_google_font_name.'">'."\n";	
				
				$sanitize = array('+','-'); //some font name have plus parameter, such as Special+Elite
				// remove the plus and add space to custom font name, if there is a plus between the font name.
				$sanitized_google_font_name = str_replace($sanitize,' ',$custom_google_font);
				//the google font name in css item, does not have plus sign and needs a space.
				
				$google_custom_font_code = 'h1, h2, h3, h4, h5, h6, .page-banner-heading, footer .foot-heading, .footer-callout-content p{font-family:\''.$sanitized_google_font_name.'\', Arial, sans-serif;}'."\n";
				array_push($css_link_container,$google_custom_link);
				array_push($css_array,$google_custom_font_code);			
				 }

		 

/*--------------------------------------------------------------------*/
/* Theme Designer
/*--------------------------------------------------------------------*/

//body bg color	
$custom_body_bg_code = 'body,html{background-color:'.$body_bg_color.' !important;}';
truethemes_push_custom_css($body_bg_color,$custom_body_bg_code);

if($body_bg_image_select!='null'):	 

//body bg image - user selected from pre-defined images	
$custom_body_image_select_code = 'body,html{background-image:url('.get_template_directory_uri().'/images/body-backgrounds/'.$body_bg_image_select.'.png) !important;background-position:'.$body_designer_page_background_position.' !important;background-repeat:'.$body_designer_page_background_repeat.' !important;}';
truethemes_push_custom_css($body_bg_image_select,$custom_body_image_select_code);

endif;

//body bg image - custom upload	
$custom_body_image_code = 'body,html{background-image:url('.$body_bg_image.') !important;background-repeat:repeat !important;background-position:'.$body_designer_page_background_position.' !important;background-repeat:'.$body_designer_page_background_repeat.' !important;}';
truethemes_push_custom_css($body_bg_image,$custom_body_image_code);

//boxed layout drop shadow
$custom_boxedlayout_shadow_code = '#tt-boxed-layout {-moz-box-shadow: 0 0 20px 0 rgba(0, 0, 0, '.$boxedlayout_shadow.');-webkit-box-shadow: 0 0 20px 0 rgba(0, 0, 0, '.$boxedlayout_shadow.');box-shadow: 0 0 20px 0 rgba(0, 0, 0, '.$boxedlayout_shadow.');}';
truethemes_push_custom_css($boxedlayout_shadow,$custom_boxedlayout_shadow_code);

//toolbar bg color	
$custom_toolbar_bg_code = '.top-aside{background:none !important;background-color:'.$toolbar_bg_color.' !important;}';
truethemes_push_custom_css($toolbar_bg_color,$custom_toolbar_bg_code);


//banner bg color    
$custom_banner_bg_code = '.banner, .banner-slider, .small_banner{background:none !important;background-color:'.$banner_bg_color.' !important;}';
truethemes_push_custom_css($banner_bg_color,$custom_banner_bg_code);


//menubar_bg_color 
$custom_menubar_bg_code = 'header{background:none !important;background-color:'.$menubar_bg_color.' !important;}';
truethemes_push_custom_css($menubar_bg_color,$custom_menubar_bg_code);


/*
//content_bg_color - will add this in future release (requires re-thinking of all images,divider lines,background images used in content)  
$custom_content_bg_code = '#content-container{background:none !important;background-color:'.$content_bg_color.' !important;}';
truethemes_push_custom_css($content_bg_color,$custom_content_bg_code);
*/

//footer bg color	
$custom_footer_bg_code = 'footer{background:none !important;background-color:'.$footer_bg_color.' !important;}';
truethemes_push_custom_css($footer_bg_color,$custom_footer_bg_code);


//banner overlay image
if ($banner_overlay != "banner-none") {
 
$banner_overlay_code = '.tt-overlay{background:url('.get_template_directory_uri().'/images/banner-overlays/'.$banner_overlay.') center center no-repeat;}';
truethemes_push_custom_css($banner_overlay,$banner_overlay_code);	
}


//shadow_style
if ($shadow_style != "shadow-1.png") {
 
$shadow_style_code = '.shadow.top{background:url('.get_template_directory_uri().'/images/shadows/'.$shadow_style.') top center no-repeat;}';
truethemes_push_custom_css($shadow_style,$shadow_style_code);	
}


//top toolbar padding	
$toolbar_padding_code = '.top-aside{padding:'.$toolbar_padding.' 0;}';
truethemes_push_custom_css($toolbar_padding,$toolbar_padding_code);


/* homepage banner padding	
$home_banner_padding_code = '.banner-slider .center-wrap {padding:'.$home_banner_padding.' 0;}';
truethemes_push_custom_css($home_banner_padding,$home_banner_padding_code); */


//interior banner padding	
$interior_banner_padding_code = '.small_banner {padding:'.$interior_banner_padding.' 0;}';
truethemes_push_custom_css($interior_banner_padding,$interior_banner_padding_code);


//footer padding	
$footer_padding_code = '.footer-content {padding:'.$footer_padding.' 0;}';
truethemes_push_custom_css($footer_padding,$footer_padding_code);


//navigation bar padding	
$nav_bar_code = 'header {padding:'.$nav_bar_padding.' 0;}';
truethemes_push_custom_css($nav_bar_padding,$nav_bar_code);


//heading colors
$custom_heading_color_h1     = $ttso->st_custom_heading_color_h1;
$custom_heading_color_h2     = $ttso->st_custom_heading_color_h2;
$custom_heading_color_h3 	  = $ttso->st_custom_heading_color_h3;
$custom_heading_color_h4     = $ttso->st_custom_heading_color_h4;
$custom_heading_color_h5     = $ttso->st_custom_heading_color_h5;
$custom_heading_color_h6     = $ttso->st_custom_heading_color_h6;
$custom_heading_color_widget = $ttso->st_custom_heading_color_widget;

$custom_heading_color_code_h1 = 'h1,h1 a,h1 a:hover{color:'.$custom_heading_color_h1.';}';
truethemes_push_custom_css($custom_heading_color_h1,$custom_heading_color_code_h1);

$custom_heading_color_code_h2 = 'h2,h2 a,h2 a:hover{color:'.$custom_heading_color_h2.';}';
truethemes_push_custom_css($custom_heading_color_h2,$custom_heading_color_code_h2);

$custom_heading_color_code_h3 = 'h3,h3 a,h3 a:hover{color:'.$custom_heading_color_h3.';}';
truethemes_push_custom_css($custom_heading_color_h3,$custom_heading_color_code_h3);

$custom_heading_color_code_h4 = 'h4,h4 a,h4 a:hover{color:'.$custom_heading_color_h4.';}';
truethemes_push_custom_css($custom_heading_color_h4,$custom_heading_color_code_h4);

$custom_heading_color_code_h5 = 'h5,h5 a,h5 a:hover{color:'.$custom_heading_color_h5.';}';
truethemes_push_custom_css($custom_heading_color_h5,$custom_heading_color_code_h5);

$custom_heading_color_code_h6 = 'h6,h6 a,h6 a:hover{color:'.$custom_heading_color_h6.';}';
truethemes_push_custom_css($custom_heading_color_h6,$custom_heading_color_code_h6);

$custom_heading_color_code_widget = '.widget-heading{color:'.$custom_heading_color_widget.';}';
truethemes_push_custom_css($custom_heading_color_widget,$custom_heading_color_code_widget);


//link color
$custom_link_color = $ttso->st_custom_link_color;	
$custom_link_color_code = 'a, a:hover, .current-menu-item a, .current-menu-parent a, .current-menu-parent ul .current-menu-item a, .current-menu-ancestor ul .current-menu-ancestor a, .current_page_parent a{color:'.$custom_link_color.' !important;}header nav a {color:#636B73 !important;}footer a, footer a:hover {color:#FFF !important;}a.button{color:inherit !important;}';
truethemes_push_custom_css($custom_link_color,$custom_link_color_code);


//main menu active link color
$custom_link_color_main_menu = $ttso->st_custom_link_color_main_menu;	
$custom_link_color_code_main_menu = '.current-menu-item a,.current-menu-parent a,.current-menu-parent ul .current-menu-item a,.current-menu-ancestor ul .current-menu-ancestor a,.current_page_parent a, header a:hover{color:'.$custom_link_color_main_menu.' !important;}';
truethemes_push_custom_css($custom_link_color_main_menu,$custom_link_color_code_main_menu);
				  
			  
//construct items and links to print in <head>
//if not empty css_link_container
if(!empty($css_link_container)){
   foreach($css_link_container as $css_link){
	echo $css_link."\n";
   }
}		
	
//if not empty $css_array, print it out in <head>	
if(!empty($css_array)){
  echo "<!--styles generated by site options-->\n";
  echo"<style type='text/css'>\n";
		foreach($css_array as $css_item){
		 echo $css_item."\n";	        
		}
  echo"</style>\n";
}

}
add_action('wp_head','truethemes_settings_css',90);








/*-----------------------------------------------------------------------------------*/
/* Add Favicon
/*-----------------------------------------------------------------------------------*/

function truethemes_favicon() {
	
	$GLOBALS['favicon'] = get_option('st_favicon');
	          if($GLOBALS['favicon'] != '')
	        echo '<link rel="shortcut icon" href="'.  esc_url( $GLOBALS['favicon'] ) .'"/>'."\n";}

add_action('wp_head', 'truethemes_favicon');






/*-----------------------------------------------------------------------------------*/
/* Add analytics code to footer 
/*-----------------------------------------------------------------------------------*/

function truethemes_analytics(){
	
	$GLOBALS['google'] = get_option('st_google_analytics');
	          
			  if($GLOBALS['google'] != '')
			  echo stripslashes(html_entity_decode( $GLOBALS['google'], ENT_QUOTES ) ) . "\n";
}
add_action('wp_footer','truethemes_analytics');



/*-----------------------------------------------------------------------------------*/
/* Hide Meta Boxes (if_enabled) 
/*-----------------------------------------------------------------------------------*/
function truethemes_metaboxes(){
	
	$GLOBALS['hide_metaboxes'] = get_option('st_hidemetabox');
	          
			  if($GLOBALS['hide_metaboxes'] == "true"){
				  
				  
	/* pages */
	remove_meta_box('commentstatusdiv','page','normal'); // Comments
	
	remove_meta_box('commentsdiv','page','normal'); // Comments
	
	remove_meta_box('trackbacksdiv','page','normal'); // Trackbacks
	
	remove_meta_box('postcustom','page','normal'); // Custom Fields
	
	remove_meta_box('authordiv','page','normal'); // Author
	
	//remove_meta_box('slugdiv','page','normal'); // Slug
	
	/* posts */
	remove_meta_box('commentsdiv','post','normal'); // Comments
	
	remove_meta_box('postcustom','post','normal'); // Custom Fields
	
	//remove_meta_box('slugdiv','post','normal'); // Slug
	
	}
}

add_action('admin_menu','truethemes_metaboxes',90);

function truethemes_css_hide_slug_metabox(){
	
	global $pagenow;
	
	if ( 'post.php' != $pagenow || 'post-new.php' != $pagenow )
		return;
		
	$GLOBALS['hide_metaboxes'] = get_option('st_hidemetabox');
	          
			  if($GLOBALS['hide_metaboxes'] == "true"){
	
	echo"<style>#slugdiv, #slugdiv-hide, label[for='slugdiv-hide']{display:none!important;}</style>";
	
	}          
}
add_action('admin_head','truethemes_css_hide_slug_metabox');


/*
* function to auto update WordPress (allow people to post comments on new articles) setting, under WordPress admin settings/discussion.
* 
* checks for user setting in site option.

**/
function truethemes_disable_comments(){
	if(is_admin()):
	global $ttso;
	
		if(function_exists('wp_get_theme')):
			$theme_object = wp_get_theme(); //WordPress 3.4.0 plus
			$theme_name = $theme_object->name;
		else:
			$theme_data = get_theme_data( get_template_directory() . '/style.css'); // before WordPress 3.4.0 deprecated function.
			$theme_name = $theme_data['Name'];
		endif;
	
	$show_posts_comments = '';
	
	if($theme_name == 'Sterling'){
		
		$show_posts_comments = $ttso->st_post_comments;
	}

	if($show_posts_comments !='false'){
		
		update_option('default_comment_status','open');
		
		}else{
		
		update_option('default_comment_status','closed');
	}

	endif;	
}
add_action('init','truethemes_disable_comments');