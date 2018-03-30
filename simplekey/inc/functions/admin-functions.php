<?php
/** 
 * Admin Functions
 * @package VAN Framework 
 */
 
/* TABLE OF CONTENTS
 * - van_head()
 * - van_footer()
 * - van_favicon()
 * - van_seo_setting()
 * - van_add_styles()
 * - van_additional_code()
 * - van_statistics_code()
 * - van_customize_meta_boxes()
 * - van_page_excerpt_metabox()
 * - van_custom_profile( $contactmethods )
 * - van_dashboard_widget() 
 * - van_posts_list($cate_id,$number,$echo)
 * - van_breadcrumbs()
 * - van_ad()
 * - van_category_tags($cate_slug,$number,$format)
 */

/*Integration Head*/
add_action('wp_head', 'van_head');
function van_head(){
    van_favicon();
	van_custom_css();
	van_additional_code();
	if ( is_singular() && get_option('thread_comments'))wp_enqueue_script( 'comment-reply' );
}

/*Integration Footer*/
add_action('wp_footer', 'van_footer');
function van_footer(){
   van_footer_code();
}

/*Add a lovely favicon*/
function van_favicon() {
   global $VAN;
   if(isset($VAN['favicon'])&&$VAN['favicon'] <> ''){
     echo '<link rel="shortcut icon" href="'.$VAN['favicon'].'" type="image/x-icon">'.PHP_EOL; 
   } 
}

/*Add Cunstom CSS*/
function van_custom_css() {
   global $VAN;
   $custom_css='';
   if(isset($VAN['enable_custom']) && $VAN['enable_custom']==1){
	   //Add Fonts
	   $section_heading_font = explode(':', $VAN['section_heading_font']);
	   $section_subtitle_font = explode(':', $VAN['section_subtitle_font']);
	   $navi_link_font = explode(':', $VAN['navi_link_font']);
	   
	   
	   if($VAN['section_heading_font']<>'' && $VAN['section_heading_font']!=="nexa_boldregular" && $VAN['section_heading_font']!=="league_gothic" && $VAN['section_heading_font']!=="nexa_lightregular" && $VAN['section_heading_font']!=="infinity" && $VAN['section_heading_font']!=="Oswald")
	   $custom_css.='<link href="http://fonts.googleapis.com/css?family='.str_replace(' ', '+', $section_heading_font[0]).'&subset=latin,latin-ext" rel="stylesheet" type="text/css">'.PHP_EOL;
	   
	   if($VAN['section_subtitle_font']<>'' && $VAN['section_subtitle_font']!=="nexa_lightregular" && $VAN['section_subtitle_font']!=="nexa_boldregular" && $VAN['section_subtitle_font']!=="league_gothic" && $VAN['section_subtitle_font']!=="infinity" && $VAN['section_subtitle_font']!=="Oswald")
	   $custom_css.='<link href="http://fonts.googleapis.com/css?family='.str_replace(' ', '+', $section_subtitle_font[0]).'&subset=latin,latin-ext" rel="stylesheet" type="text/css">'.PHP_EOL;
	   
	   if($VAN['navi_link_font']<>'' && $VAN['navi_link_font']!=="nexa_boldregular" && $VAN['navi_link_font']!=="league_gothic" && $VAN['navi_link_font']!=="nexa_lightregular" && $VAN['navi_link_font']!=="infinity" && $VAN['navi_link_font']!=="Oswald")
	   $custom_css.='<link href="http://fonts.googleapis.com/css?family='.str_replace(' ', '+', $navi_link_font[0]).'&subset=latin,latin-ext" rel="stylesheet" type="text/css">'.PHP_EOL;
	}
	
	$custom_css.='<style type="text/css">'.PHP_EOL;
	if(isset($VAN['isLoad'])&&$VAN['isLoad']==0)$custom_css.='body.home{display:block;}'.PHP_EOL; 
	if(isset($VAN['logo']) && $VAN['logo'] <> ''){
		 $custom_css.='h1#site-logo a{background:url('.$VAN['logo'].') no-repeat center;}'.PHP_EOL; 
	}
	if(isset($VAN['home_top_height']) && $VAN['home_top_height'] <> '' && $VAN['home_revslider']<>''){
	  $custom_css.='.home #top{height:'.$VAN['home_top_height'].';}';
	}
	if(isset($VAN['high_logo']) && $VAN['high_logo'] <> ''){
		 $custom_css.='@media only screen and (-Webkit-min-device-pixel-ratio: 1.5),
						only screen and (-moz-min-device-pixel-ratio: 1.5),
						only screen and (-o-min-device-pixel-ratio: 3/2),
						only screen and (min-device-pixel-ratio: 1.5) {
						  h1#site-logo a {
							background-image: url('.$VAN['high_logo'].');
							background-size: auto 69px;
						  }
						}'.PHP_EOL; 
	}
	if(isset($VAN['enable_custom']) && $VAN['enable_custom']==1){ 
	   //Custom CSS
	   if(isset($VAN['global_link']) && $VAN['global_link'] <> ''){
		 $custom_css.='a{color:'.$VAN['global_link'].';}'.PHP_EOL; 
	   }
	   if(isset($VAN['global_link_hover']) && $VAN['global_link_hover'] <> ''){
		 $custom_css.='a:hover{color:'.$VAN['global_link_hover'].';}'.PHP_EOL; 
	   }
	   if(isset($VAN['selection_color']) && $VAN['selection_color'] <> ''){
		 $custom_css.='::selection{background:'.$VAN['selection_color'].';}'.PHP_EOL; 
	   }
	   
	   if(isset($VAN['sticky_top_bg']) && $VAN['sticky_top_bg'] <> ''){
		 $custom_css.='#extra-top{background:'.$VAN['navi_bg'].';}'.PHP_EOL; 
	   }
	   
	   if(isset($VAN['navi_bg']) && $VAN['navi_bg'] <> ''){
		 $custom_css.='#primary-menu,#primary-menu-container li ul.sub-menu{background:'.$VAN['navi_bg'].';}'.PHP_EOL; 
	   }
	   
	   if(isset($VAN['navi_link_font']) && $VAN['navi_link_font'] <> ''){
		 $custom_css.='#primary-menu-container a{font-family:"'.str_replace('+', ' ', $navi_link_font[0]).'",Arial;}'.PHP_EOL; 
	   }
	   if(isset($VAN['navi_link_size']) && $VAN['navi_link_size'] <> ''){
		 $custom_css.='#primary-menu-container a{font-size:'.$VAN['navi_link_size'].'px;}'.PHP_EOL; 
	   }
	   if(isset($VAN['navi_link']) && $VAN['navi_link'] <> ''){
		 $custom_css.='#primary-menu-container a,#primary-menu-container li ul.sub-menu li a{color:'.$VAN['navi_link'].';}'.PHP_EOL; 
	   }
	   if(isset($VAN['navi_link_hover']) && $VAN['navi_link_hover'] <> ''){
		  $custom_css.='#primary-menu-container a:hover,#primary-menu-container li.current-menu-item a:hover,#primary-menu-container li ul.sub-menu li a:hover{color:'.$VAN['navi_link_hover'].';}'.PHP_EOL; 
	   }
	   if(isset($VAN['navi_link_bghover']) && $VAN['navi_link_bghover'] <> ''){
		 $custom_css.='.sf-menu li:hover, .sf-menu li.sfHover,
.sf-menu a:focus, .sf-menu a:hover, .sf-menu a:active {background:'.$VAN['navi_link_bghover'].';}'.PHP_EOL; 
	   }
	   if(isset($VAN['navi_link_active']) && $VAN['navi_link_active'] <> ''){
		 $custom_css.='#primary-menu-container ul li.current-menu-item a{color:'.$VAN['navi_link_active'].';}'.PHP_EOL; 
	   }
	   if(isset($VAN['footer_bg_color']) && $VAN['footer_bg_color'] <> '' || isset($VAN['footer_text_color']) && $VAN['footer_text_color'] <> ''){
		 $custom_css.='#footer{background:'.$VAN['footer_bg_color'].';color:'.$VAN['footer_text_color'].';}'.PHP_EOL; 
	   }
	   if(isset($VAN['footer_link']) && $VAN['footer_link'] <> ''){
		 $custom_css.='#footer a{color:'.$VAN['footer_link'].';}'.PHP_EOL; 
	   }
	   if(isset($VAN['footer_link_hover']) && $VAN['footer_link_hover'] <> ''){
		 $custom_css.='#footer a:hover{color:'.$VAN['footer_link_hover'].';}'.PHP_EOL; 
	   }
	   if(isset($VAN['section_heading_font']) && $VAN['section_heading_font'] <> ''){
		$custom_css.='.page-area .title h1,.page-area .title h1 strong,.page-area .title h2,.page-area .title h2 strong,.entry h1,.entry h2,.entry h3,.entry h4,.entry h5,.entry h6,.post h2{font-family:"'.str_replace('+', ' ', $section_heading_font[0]).'",Arial;}'.PHP_EOL;
	   }
	   if(isset($VAN['section_subtitle_font']) && $VAN['section_subtitle_font'] <> ''){
		$custom_css.='.page-area .title p{font-family:"'.str_replace('+', ' ', $section_subtitle_font[0]).'",Arial;}'.PHP_EOL;
	   }
	   if(isset($VAN['section_heading_size']) && $VAN['section_heading_size'] <> ''){
		$custom_css.='.page-area .title h1,.page-area .title h1 strong,.page-area .title h2,.page-area .title h2 strong{font-size:'.$VAN['section_heading_size'].'px;}'.PHP_EOL;
	   }
	   if(isset($VAN['section_subtitle_size']) && $VAN['section_subtitle_size'] <> ''){
		$custom_css.='.page-area .title p{font-size:'.$VAN['section_subtitle_size'].'px;}'.PHP_EOL;
	   }
	   if(isset($VAN['contact_background']) && $VAN['contact_background'] <> ''){
		 $custom_css.='#contact{background:url('.$VAN['contact_background'].') repeat center fixed;background-size:cover;}'.PHP_EOL; 
	   }
	   if(isset($VAN['contact_background_color']) && $VAN['contact_background_color'] <> ''){
		 $custom_css.='#contact{background-color:'.$VAN['contact_background_color'].';}'.PHP_EOL; 
	   }
	   if(isset($VAN['contact_text_color']) && $VAN['contact_text_color'] <> ''){
		 $custom_css.='#contact,#contact .title h1 strong,#contact,#contact .title h2 strong,#contact .title p,.contactway{color:'.$VAN['contact_text_color'].';}'.PHP_EOL; 
                 $custom_css.='#contact .contactway{border-color:'.$VAN['contact_text_color'].';filter:alpha(Opacity=80);-moz-opacity:0.8;opacity: 0.8;}';
	   }
	   if(isset($VAN['contact_input_background']) && $VAN['contact_input_background'] <> ''){
		 $custom_css.='.contactform input,.contactform textarea{background:'.$VAN['contact_input_background'].';}'.PHP_EOL; 
	   }
	   if(isset($VAN['contact_input_text']) && $VAN['contact_input_text'] <> ''){
		 $custom_css.='.contactform input,.contactform textarea{color:'.$VAN['contact_input_text'].';}'.PHP_EOL; 
		 $custom_css.='#contactName::-moz-placeholder {color:'.$VAN['contact_input_text'].';}
                       ::-webkit-input-placeholder {color:'.$VAN['contact_input_text'].';}'.PHP_EOL; 
	   }
	   if(isset($VAN['contact_btn_background']) && $VAN['contact_btn_background'] <> ''){
		 $custom_css.='.contactform .contact-btn{background:'.$VAN['contact_btn_background'].';}'.PHP_EOL; 
	   }
	   if(isset($VAN['contact_btn_text']) && $VAN['contact_btn_text'] <> ''){
		 $custom_css.='#contact .contactform .contact-btn{color:'.$VAN['contact_btn_text'].';text-shadow:none;}'.PHP_EOL; 
	   }
   }
   if(van_is_mobile() && !is_home()){
       $custom_css.='.portfolio-item{display:none;}';
   }
   if(!isset($VAN['isResponsive']) || $VAN['isResponsive']==1){
	   if(isset($VAN['show_mobile_logo']) && $VAN['show_mobile_logo'] == 1){
		   $custom_css.='@media only screen and (max-width: 767px) {
					h1#site-logo,
					h1#site-logo a{width:60%;height:60px;background-size:100%;background-position:center;}
					:root .css3-selectbox{
						 display:inline-block;
						 width:40%;
						 float:right;
						 margin-right:15px;
					}
		   }'.PHP_EOL;
	   }else{
		  $custom_css.='@media only screen and (max-width: 767px) {
					:root .css3-selectbox{width:95%;display:inline-block;margin:15px;}
					h1#site-logo{display:none;}
					}'.PHP_EOL;
	   }
   }
   $custom_css.='</style>'.PHP_EOL;
   $custom_css.='<link href="'.get_template_directory_uri().'/custom.css" type="text/css" rel="stylesheet" />'.PHP_EOL;
   if(!isset($VAN['isResponsive']) || $VAN['isResponsive']==1){
     $custom_css.='<link href="'.get_template_directory_uri().'/assets/css/media-queries.css" type="text/css" rel="stylesheet" />'.PHP_EOL;
   }
   $custom_css.='<link href="http://fonts.googleapis.com/css?family=Oswald:400,700,300&subset=latin,latin-ext" type="text/css" rel="stylesheet" />'.PHP_EOL;
   echo $custom_css;
}

/*Add some CSS or JS code to head*/
function van_additional_code() {
   global $VAN;
   if(isset($VAN['additional_code'])&&$VAN['additional_code'] <> ""){  
     echo stripslashes($VAN['additional_code']); 
   } 
}

/*Add statistics code to footer*/
function van_footer_code() {
   global $VAN;
   if(isset($VAN['footer_code'])&&$VAN['footer_code'] <> ""){  
   echo stripslashes($VAN['footer_code']); 
   } 
}

/*Customize meta box*/
function van_customize_meta_boxes() {
     remove_meta_box('postcustom','post','normal');
}
//add_action('admin_init','van_customize_meta_boxes');


/*Add page excerpt textarea*/
function van_page_excerpt_metabox() {
    add_meta_box( 'postexcerpt', __('Excerpt','van'), 'post_excerpt_meta_box', 'page', 'normal', 'high' );
}
//add_action( 'admin_menu', 'van_page_excerpt_metabox' );

/*Add items in profile;*/
function van_custom_profile( $contactmethods ) {
    $contactmethods['telephone'] = 'Telphone';
	$contactmethods['address'] = 'Address';
    unset($contactmethods['aim']);
    unset($contactmethods['yim']);
    unset($contactmethods['jabber']);
    return $contactmethods;
}
//add_filter('user_contactmethods','van_custom_profile',10,1);

/*Add widget in dashboard*/
function van_dashboard_widget() {
	echo 'Content here';
}
function van_add_dashboard_widgets() {
    wp_add_dashboard_widget('van_dashboard_widget', 'Title', 'van_dashboard_widget');
}
//add_action('wp_dashboard_setup', 'van_dashboard_widgets' );
?>