<?php  
// css to be compiled to overrule the default css
// variables

$redux_wish = wish_redux();
// logo dimensions
$logo_dim = $redux_wish['wish_logo_dimensions'];
$logo_width = $logo_dim['width'];
$logo_height = $logo_dim['height'];
$logo_units = $logo_dim['units'];
$logo_w = "";
$logo_h = "";

if($logo_width != "px" && $logo_width != ""){
	$logo_w = "width: " .esc_attr($logo_width). ";";
}

if($logo_height != "px" && $logo_height != "px"){
	$logo_h = "height: " .esc_attr($logo_height). ";";
}


// logo spacing
$logo_spacing = $redux_wish['wish-logo-spacing'];
$logo_top = $logo_spacing['margin-top'];
$logo_left = $logo_spacing['margin-left'];


$css = "";

	$regular_button_background = $redux_wish['wish-regular-button-bgcolor'];
	$regular_button_text = $redux_wish['wish-regular-button-txt-color'];
	$regular_button_border = $redux_wish['wish-regular-button-border-color'];
	$regular_button_background_hover = $redux_wish['wish-regular-button-bgcolor-hover'];
	$regular_button_text_hover = $redux_wish['wish-regular-button-txt-color-hover'];

	$regular_transparent_button_background = $redux_wish['wish-regular-transparent-button-bgcolor'];
	$regular_transparent_button_text = $redux_wish['wish-regular-transparent-button-txt-color'];
	$regular_transparent_button_background_hover = $redux_wish['wish-regular-transparent-button-bgcolor-hover'];
	$regular_transparent_button_text_hover = $redux_wish['wish-regular-transparent-button-txt-color-hover'];


	$square_button_background = $redux_wish['wish-square-button-bgcolor'];
	$square_button_text = $redux_wish['wish-square-button-txt-color'];
	$square_button_border = $redux_wish['wish-square-button-border-color'];
	$square_button_background_hover = $redux_wish['wish-square-button-bgcolor-hover'];
	$square_button_text_hover = $redux_wish['wish-square-button-txt-color-hover'];

	$square_transparent_button_background = $redux_wish['wish-transparent-square-button-bgcolor'];
	$square_transparent_button_text = $redux_wish['wish-transparent-square-button-txt-color'];
	$square_transparent_button_background_hover = $redux_wish['wish-transparent-square-button-bgcolor-hover'];
	$square_transparent_button_text_hover = $redux_wish['wish-transparent-square-button-txt-color-hover'];

	$dark_square_button_background = $redux_wish['wish-dark-square-button-bgcolor'];
	$dark_square_button_text = $redux_wish['wish-dark-square-button-txt-color'];
	$dark_square_button_border = $redux_wish['wish-dark-square-button-border-color'];
	$dark_square_button_background_hover = $redux_wish['wish-dark-square-button-bgcolor-hover'];
	$dark_square_button_text_hover = $redux_wish['wish-dark-square-button-txt-color-hover'];

	$dark_square_transparent_button_background = $redux_wish['wish-dark-square-button-bgcolor'];
	$dark_square_transparent_button_text = $redux_wish['wish-dark-square-button-txt-color'];
	$dark_square_transparent_button_background_hover = $redux_wish['wish-dark-square-button-bgcolor-hover'];
	$dark_square_transparent_button_text_hover = $redux_wish['wish-dark-square-button-txt-color-hover'];


	/*Menu Styling*/
	$wish_floating_menu = $redux_wish['wish-floating-menu'];
	$wish_menu_top_margin = $redux_wish['wish-menu-top-margin'];


	$wish_menu_bgcolor = $redux_wish['wish-menu-bgcolor'];
	$wish_menu_bgcolor_inner = $redux_wish['wish-menu-bgcolor-inner'];


	$wish_menu_font = $redux_wish['wish-menu-font'];
	$wish_menu_color_hover = $redux_wish['wish-menu-color-hover'];
	$wish_menu_title = $redux_wish['wish-menu-title'];
	$wish_menu_title_pages = $redux_wish['wish-menu-title-pages'];


	$wish_mega_menu_title = $redux_wish['wish-mega-menu-title'];
	$wish_menu_title_color_hover = $redux_wish['wish-menu-title-color-hover'];

	/*Responsive Menu*/
	$wish_res_menu_bgcolor = $redux_wish['wish-res-menu-bgcolor'];
	$wish_res_menu_font = $redux_wish['wish-res-menu-font'];


	/*footers*/
	$wish_footer1_social_font = $redux_wish['wish-footer1-social-font'];
	$wish_footer1_title_font = $redux_wish['wish-footer1-title-font'];
	$wish_footer1_contact_font = $redux_wish['wish-footer1-contact-font'];
	$wish_footer1_address_font = $redux_wish['wish-footer1-address-font'];
	$wish_footer1_address_link_font = $redux_wish['wish-footer1-address-link-font'];


	// footer 2
    
	$wish_footer2_bg_color = $redux_wish['wish-footer2-bg-color'];
	$wish_footer2_title_font = $redux_wish['wish-footer2-title-fonts'];
	$wish_footer2_text_font = $redux_wish['wish-footer2-text-fonts'];
	$wish_footer2_icons_color = $redux_wish['wish-footer2-contact-icons-color'];



	// footer 3

	$wish_footer3_bgcolor = $redux_wish['wish-footer3-bgcolor'];
	$wish_footer3_title_font = $redux_wish['wish-footer3-title-font'];
	$wish_footer3_icons_color = $redux_wish['wish-footer3-icons-color'];




	// footer 4
	$wish_footer4_bgcolor = $redux_wish['wish-footer4-bgcolor'];
	$wish_footer4_title_font = $redux_wish['wish-footer4-title-font'];
	$wish_footer4_text_font = $redux_wish['wish-footer4-text-font'];
	$wish_footer4_links = $redux_wish['wish-footer4-links'];
	$wish_footer4_bgimage = $redux_wish['wish-footer4-bgimage'];
	
	// footer 5
	$wish_footer5_bgcolor = $redux_wish['wish-footer5-bgcolor'];
	$wish_footer5_font = $redux_wish['wish-footer5-font'];

	// footer 6
	$wish_footer6_bgcolor = $redux_wish['wish-footer6-bgcolor'];
	$wish_footer6_title_font = $redux_wish['wish-footer6-title-font'];
	$wish_footer6_icon_colors = $redux_wish['wish-footer6-icon-colors'];
	$wish_footer6_contact_title_font = $redux_wish['wish-footer6-contact-title-font'];
	$wish_footer6_contact_text_font = $redux_wish['wish-footer6-contact-text-font'];

	// top bar
	
	$wish_topbar_font = $redux_wish['wish-topbar-font'];
	$wish_topbar_font_regular = $redux_wish['wish-topbar-font-regular'];



$css .= "
.wish-rkt-menu-default .logo img{
	" . esc_attr($logo_w) . "
	" . esc_attr($logo_h) . "

	margin-top: ".esc_attr($logo_top).";
	margin-left: ".esc_attr($logo_left).";
}




";

	$css .= 
	"
	/*Styling Option*/
	

	/*Regular Button*/
	.buttons a.fill, .woocommerce ul.products li.product .button, .woocommerce .container div.product form.cart .button{
		background-color: ".esc_attr($regular_button_background).";
		color: ".esc_attr($regular_button_text).";
		border-color: ".esc_attr($regular_button_border).";
	}
	.buttons a.fill:hover, .woocommerce ul.products li.product .button:hover, .woocommerce .container div.product form.cart .button:hover{
		background-color: ".esc_attr($regular_button_background_hover).";
		color: ".esc_attr($regular_button_text_hover).";
	}
	.buttons a.nofill{
		background-color: ".esc_attr($regular_transparent_button_background)." !important;
		color: ".esc_attr($regular_transparent_button_text)." !important;
	}
	.buttons a.nofill:hover{
		background-color: ".esc_attr($regular_transparent_button_background_hover)." !important;
		color: ".esc_attr($regular_transparent_button_text_hover)." !important;
	}





	/* comments button */
	.form-submit .button_comment{
		background-color: ".esc_attr($regular_button_background).";
		color: ".esc_attr($regular_button_text).";
		border-color: ".esc_attr($regular_button_border).";
	}

	.form-submit .button_comment:hover{
		background-color: ".esc_attr($regular_button_background_hover).";
		color: ".esc_attr($regular_button_text_hover).";
	}





	/*Square Button*/
	.sqr-buttons a.fill{
		background-color: ".esc_attr($square_button_background).";
		color: ".esc_attr($square_button_text).";
		border-color: ".esc_attr($square_button_border).";
	}
	.sqr-buttons a.fill:hover{
		background-color: ".esc_attr($square_button_background_hover).";
		color: ".esc_attr($square_button_text_hover).";
	}
	.sqr-buttons a.nofill{
		background-color: ".esc_attr($square_transparent_button_background)." !important;
		color: ".esc_attr($square_transparent_button_text)." !important;
	}
	.sqr-buttons a.nofill:hover{
		background-color: ".esc_attr($square_transparent_button_background_hover)." !important;
		color: ".esc_attr($square_transparent_button_text_hover)." !important;
	}

	/*Dark Square Button*/
	.dark-sqr-buttons a.fill{
		background-color: ".esc_attr($dark_square_button_background).";
		color: ".esc_attr($dark_square_button_text).";
		border-color: ".esc_attr($dark_square_button_border).";
		border-radius: 0px;
	}
	.dark-sqr-buttons a.fill:hover{
		background-color: ".esc_attr($dark_square_button_background_hover).";
		color: ".esc_attr($dark_square_button_text_hover).";
	}
	.dark-sqr-buttons a.nofill{
		background-color: ".esc_attr($dark_square_transparent_button_background)." !important;
		color: ".esc_attr($dark_square_transparent_button_text)." !important;
	}
	.dark-sqr-buttons a.nofill:hover{
		background-color: ".esc_attr($dark_square_transparent_button_background_hover)." !important;
		color: ".esc_attr($dark_square_transparent_button_text_hover)." !important;
	}


	/*Menu Styling*/

/*	.wish-primary-menu .menu > li > a, .wish-header-fixed-wrapper.wish-is-fixed .wish-header-fixed .menu > li > a, .wish-primary-menu .menu > li > a, .wish-header-fixed .menu > li.menu-full-width .wish-submenu-ddown .container > ul > li > a {
		font-family: '" . esc_attr($wish_menu_title["font-family"]) . "';
  		font-size: ". esc_attr($wish_menu_title["font-size"]) .";
  		font-weight: ". esc_attr($wish_menu_title["font-weight"]) .";
  		color: ". esc_attr($wish_menu_title["color"]) .";
	}*/

	.menu-inner-pages .wish-primary-menu .menu > li > a, .menu-inner-pages.wish-header-fixed-wrapper.wish-is-fixed .wish-header-fixed .menu > li > a, .menu-inner-pages .wish-primary-menu .menu > li > a, .menu-inner-pages .wish-header-fixed .menu > li.menu-full-width .wish-submenu-ddown .container > ul > li > a {
		font-family: '" . esc_attr($wish_menu_title_pages["font-family"]) . "';
  		font-size: ". esc_attr($wish_menu_title_pages["font-size"]) .";
  		font-weight: ". esc_attr($wish_menu_title_pages["font-weight"]) .";
  		color: ". esc_attr($wish_menu_title_pages["color"]) .";
	}


	.wish-primary-menu .menu > li.menu-full-width .wish-submenu-ddown .container > ul > li > a{

		font-family: '" . esc_attr($wish_mega_menu_title["font-family"]) . "';
  		font-size: ". esc_attr($wish_mega_menu_title["font-size"]) .";
  		font-weight: ". esc_attr($wish_mega_menu_title["font-weight"]) .";
  		color: ". esc_attr($wish_mega_menu_title["color"]) .";

	}


	.wish-wp-menu-wrapper .menu li a:hover,.wish-primary-menu .menu > li.menu-full-width .wish-submenu-ddown .container > ul > li > a:hover,.wish-header-fixed-wrapper.wish-is-fixed .wish-header-fixed .menu > li > a, .wish-primary-menu .menu > li > a:hover{
		color: ".esc_attr($wish_menu_title_color_hover).";
	}
	.wish-primary-menu .menu > li .wish-submenu-ddown .container > ul > li a, .wish-primary-menu .menu > li .wish-submenu-ddown .container > ul > li a{
		font-family: '" . esc_attr($wish_menu_font["font-family"]) . "';
  		font-size: ". esc_attr($wish_menu_font["font-size"]) .";
  		font-weight: ". esc_attr($wish_menu_font["font-weight"]) .";
  		color: ". esc_attr($wish_menu_font["color"]) .";
	}
	.wish-primary-menu .menu > li .wish-submenu-ddown .container > ul > li a:hover,  .wish-primary-menu .menu > li .wish-submenu-ddown .container > ul > li a:hover{
		color: ".esc_attr($wish_menu_color_hover).";
	}";

	global $post;

	if(function_exists('rwmb_meta')){
		$force_float_menu = rwmb_meta('wish_force_float_menu');
	}else{
		$force_float_menu = false;
	}

	$top_bar_css = "";

	//if not floating menu
	if(  !(is_front_page() && $wish_floating_menu) && !$force_float_menu){
		$menu_select = ".wish-rkt-menu-default";

	}else{ //if foating menu
		$menu_select = ".wish-rkt-menu-default > .container";
		$top_bar_css = "#tc{background-color:transparent;}";
	}

	if(is_array($wish_menu_bgcolor)){
		$wish_menu_bgcolor = $wish_menu_bgcolor['rgba'];
	}


	$css .= $menu_select . "{
		background-color: ".esc_attr($wish_menu_bgcolor).";
	}

	{$top_bar_css}

	/* Responsive Menu Styling */
	.mean-container .mean-nav ul li a{
		font-family: '" . esc_attr($wish_res_menu_font["font-family"]) . "';
  		font-size: ". esc_attr($wish_res_menu_font["font-size"]) .";
  		font-weight: ". esc_attr($wish_res_menu_font["font-weight"]) .";
  		color: ". esc_attr($wish_res_menu_font["color"]) .";
	}
	.mean-container .mean-nav ul li{
		background-color: ".esc_attr($wish_res_menu_bgcolor).";
	}


	/* footers */
	.shareon h3{
		font-family: '" . esc_attr($wish_footer1_social_font["font-family"]) . "';
  		font-size: ". esc_attr($wish_footer1_social_font["font-size"]) .";
  		font-weight: ". esc_attr($wish_footer1_social_font["font-weight"]) .";
  		color: ". esc_attr($wish_footer1_social_font["color"]) .";
	}
	.letsmake h3{
		font-family: '" . esc_attr($wish_footer1_title_font["font-family"]) . "';
  		font-size: ". esc_attr($wish_footer1_title_font["font-size"]) .";
  		font-weight: ". esc_attr($wish_footer1_title_font["font-weight"]) .";
  		color: ". esc_attr($wish_footer1_title_font["color"]) .";
	}
	.letsmake h4{
		font-family: '" . esc_attr($wish_footer1_contact_font["font-family"]) . "';
  		font-size: ". esc_attr($wish_footer1_contact_font["font-size"]) .";
  		font-weight: ". esc_attr($wish_footer1_contact_font["font-weight"]) .";
  		color: ". esc_attr($wish_footer1_contact_font["color"]) .";
  		line-height: ". esc_attr($wish_footer1_contact_font["line-height"]) .";
	}

	.address h3{
		font-family: '" . esc_attr($wish_footer1_address_font["font-family"]) . "';
  		font-size: ". esc_attr($wish_footer1_address_font["font-size"]) .";
  		font-weight: ". esc_attr($wish_footer1_address_font["font-weight"]) .";
  		color: ". esc_attr($wish_footer1_address_font["color"]) .";
	}

	.address .links a{
		font-family: '" . esc_attr($wish_footer1_address_link_font["font-family"]) . "';
  		font-size: ". esc_attr($wish_footer1_address_link_font["font-size"]) .";
  		font-weight: ". esc_attr($wish_footer1_address_link_font["font-weight"]) .";
  		color: ". esc_attr($wish_footer1_address_link_font["color"]) .";
	}

    footer.grey-bg{
    	background-color: ". esc_attr($wish_footer2_bg_color) .";
    }

    .getintouch-footer h3, .followus h3{
    	font-family:  ". esc_attr($wish_footer2_title_font['font-family']) .";
    	font-weight:  ". esc_attr($wish_footer2_title_font['font-weight']) .";
    	font-size:  ". esc_attr($wish_footer2_title_font['font-size']) .";
    	color:  ". esc_attr($wish_footer2_title_font['color']) .";
    }

	.getintouch-footer ul li{
    	font-family:  ". esc_attr($wish_footer2_text_font['font-family']) .";
    	font-weight:  ". esc_attr($wish_footer2_text_font['font-weight']) .";
    	font-size:  ". esc_attr($wish_footer2_text_font['font-size']) .";
    	color:  ". esc_attr($wish_footer2_text_font['color']) .";
	}

	.getintouch-footer ul li i, .followus ul li i{
		color: ". esc_attr($wish_footer2_icons_color) . ";
	}

	/* footer 3 */
	.footer3{
		background-color: ".esc_attr($wish_footer3_bgcolor).";
	}

	
	.footer3 .s-icons ul li i{
		color: ".esc_attr($wish_footer3_icons_color).";
	}
	
	.footer3-title{
		font-family: ".esc_attr($wish_footer3_title_font['font-family']).";	
		font-weight: ".esc_attr($wish_footer3_title_font['font-weight']).";	
		font-size: ".esc_attr($wish_footer3_title_font['font-size']).";	
		color: ".esc_attr($wish_footer3_title_font['color']).";
	}


	
	/* footer 4 */
	.footer4{
		background-image:url(".esc_url($wish_footer4_bgimage['url']).");
		background-color: ".esc_attr($wish_footer4_bgcolor).";
		font-family: ".esc_attr($wish_footer4_text_font['font-family']).";	
		font-weight: ".esc_attr($wish_footer4_text_font['font-weight']).";	
		font-size: ".esc_attr($wish_footer4_text_font['font-size']).";	
		color: ".esc_attr($wish_footer4_text_font['color']).";
		line-height: ".esc_attr($wish_footer4_text_font['line-height']).";

	}
	
	.footer4 h3{
		font-family: ".esc_attr($wish_footer4_title_font['font-family']).";	
		font-weight: ".esc_attr($wish_footer4_title_font['font-weight']).";	
		font-size: ".esc_attr($wish_footer4_title_font['font-size']).";	
		color: ".esc_attr($wish_footer4_title_font['color']).";
		line-height: ".esc_attr($wish_footer4_title_font['line-height']).";
	}
	
	.footer4 a{
		color: ".esc_attr($wish_footer4_links['regular']).";		
	}
	.footer4 a:hover{
		color: ".esc_attr($wish_footer4_links['hover']).";		
	}
	.footer4 a:active{
		color: ".esc_attr($wish_footer4_links['active']).";		
	}


/*footer 5 */

.footer5{
	background-color: ".esc_attr($wish_footer5_bgcolor)." !important;
	font-family: ".esc_attr($wish_footer5_font['font-family']).";	
	font-weight: ".esc_attr($wish_footer5_font['font-weight']).";	
	font-size: ".esc_attr($wish_footer5_font['font-size']).";	
	color: ".esc_attr($wish_footer5_font['color']).";
	line-height: ".esc_attr($wish_footer5_font['line-height']).";
}

.footer5 a{
	color: ".esc_attr($wish_footer5_font['color']).";
}





/*footer 6 */
.footer6{
	background-color: ".esc_attr($wish_footer6_bgcolor).";
	
}

.footer6 h1{
		font-family: ".esc_attr($wish_footer6_title_font['font-family']).";	
		font-weight: ".esc_attr($wish_footer6_title_font['font-weight']).";	
		font-size: ".esc_attr($wish_footer6_title_font['font-size']).";	
		color: ".esc_attr($wish_footer6_title_font['color']).";
		line-height: ".esc_attr($wish_footer6_title_font['line-height']).";
}

.footer6 i, .footer6 u li i, .footer .icon i{
	color: ".esc_attr($wish_footer6_icon_colors).";
}

.footer6 .caption{
		font-family: ".esc_attr($wish_footer6_contact_title_font['font-family']).";	
		font-weight: ".esc_attr($wish_footer6_contact_title_font['font-weight']).";	
		font-size: ".esc_attr($wish_footer6_contact_title_font['font-size']).";	
		color: ".esc_attr($wish_footer6_contact_title_font['color']).";
		line-height: ".esc_attr($wish_footer6_contact_title_font['line-height']).";
}

.footer6 .description, .footer6 .description a{
		font-family: ".esc_attr($wish_footer6_contact_text_font['font-family']).";	
		font-weight: ".esc_attr($wish_footer6_contact_text_font['font-weight']).";	
		font-size: ".esc_attr($wish_footer6_contact_text_font['font-size']).";	
		color: ".esc_attr($wish_footer6_contact_text_font['color']).";
		line-height: ".esc_attr($wish_footer6_contact_text_font['line-height']).";
}


";









$css .= "
.topbar-inner-pages, .topbar-inner-pages a, .topbar-inner-pages span a{
	font-family: ".esc_attr($wish_topbar_font_regular['font-family']).";
	font-weight: ".esc_attr($wish_topbar_font_regular['font-weight']).";	
	font-size: ".esc_attr($wish_topbar_font_regular['font-size']).";	
	color: ".esc_attr($wish_topbar_font_regular['color']).";
	line-height: ".esc_attr($wish_topbar_font_regular['line-height']).";
}

@media (max-width: 1100px) {
	.top-contact, .top-contact a{
		font-family: ".esc_attr($wish_topbar_font_regular['font-family']).";
		font-weight: ".esc_attr($wish_topbar_font_regular['font-weight']).";	
		font-size: ".esc_attr($wish_topbar_font_regular['font-size']).";	
		color: ".esc_attr($wish_topbar_font_regular['color']).";
		line-height: ".esc_attr($wish_topbar_font_regular['line-height']).";
	}

}
 






";



$wish_body_links = $redux_wish['wish-body-links'];
$css .= "
a{
	color: ".esc_attr($wish_body_links["regular"]).";
}
a:hover{
	color: ".esc_attr($wish_body_links["hover"]).";
}
a:active{
	color: ".esc_attr($wish_body_links["active"]).";
}

";



$wish_blog_title_font = $redux_wish['wish-blog-title-font'];
$wish_blog_text_font = $redux_wish['wish-blog-text-font'];
$wish_blog_page_bgcolor = $redux_wish['wish-blog-page-bgcolor'];
$wish_blog_sticky_bgcolor = $redux_wish['wish-blog-page-sticky-bgcolor'];




$css .= "
.blog-page .post .info h1{
	font-family: ".esc_attr($wish_blog_title_font['font-family']).";
	font-weight: ".esc_attr($wish_blog_title_font['font-weight']).";	
	font-size: ".esc_attr($wish_blog_title_font['font-size']).";	
	line-height: ".esc_attr($wish_blog_title_font['line-height']).";
	color: ".esc_attr($wish_blog_title_font['color']).";	
}

.archive .blog-page .post .info h1{
	font-family: ".esc_attr($wish_blog_title_font['font-family']).";
	font-weight: 400;	
	font-size: ".esc_attr($wish_blog_title_font['font-size']).";	
	line-height: ".esc_attr($wish_blog_title_font['line-height']).";
	color: ".esc_attr($wish_blog_title_font['color']).";	
}

.blog-page .post .info .description{
	font-family: ".esc_attr($wish_blog_text_font['font-family']).";
	font-weight: ".esc_attr($wish_blog_text_font['font-weight']).";	
	font-size: ".esc_attr($wish_blog_text_font['font-size']).";	
	line-height: ".esc_attr($wish_blog_text_font['line-height']).";	
	color: ".esc_attr($wish_blog_text_font['color']).";	
}

.blog-page{
	background-color: ".$wish_blog_page_bgcolor.";
}

.sticky .post .info{
	background-color: ".$wish_blog_sticky_bgcolor.";
}




";



// woocommerce archive page
$woo_archive_prod_title = $redux_wish['wish-woo-archive-product-title'];
$woo_archive_prod_category = $redux_wish['wish-woo-archive-product-category'];
$woo_archive_prod_price = $redux_wish['wish-woo-archive-product-price'];
$wish_woo_archive_bgcolor = $redux_wish['wish-woo-archive-bgcolor'];
$wish_woo_star_color = $redux_wish['wish-woo-stars-color'];


$css .= "
.woocommerce ul.products li.product a{
	font-family: ".esc_attr($woo_archive_prod_title['font-family']).";
	font-weight: ".esc_attr($woo_archive_prod_title['font-weight']).";	
	font-size: ".esc_attr($woo_archive_prod_title['font-size']).";	
	line-height: ".esc_attr($woo_archive_prod_title['line-height']).";	
	color: ".esc_attr($woo_archive_prod_title['color']).";
}
.shop-products .category{
	font-family: ".esc_attr($woo_archive_prod_category['font-family']).";
	font-weight: ".esc_attr($woo_archive_prod_category['font-weight']).";	
	font-size: ".esc_attr($woo_archive_prod_category['font-size']).";	
	line-height: ".esc_attr($woo_archive_prod_category['line-height']).";
	color: ".esc_attr($woo_archive_prod_category['color']).";
}
.post-type-archive-product{
	background-color: ".esc_attr($wish_woo_archive_bgcolor).";
}
.woocommerce .star-rating span::before{
	color: ".esc_attr($wish_woo_star_color).";
}
.woocommerce ul.products li.product .price{
	font-family: ".esc_attr($woo_archive_prod_price['font-family']).";
	font-weight: ".esc_attr($woo_archive_prod_price['font-weight']).";	
	font-size: ".esc_attr($woo_archive_prod_price['font-size']).";	
	line-height: ".esc_attr($woo_archive_prod_price['line-height']).";
	color: ".esc_attr($woo_archive_prod_price['color']).";	
}

";



// woocommerce single product page
$woo_single_prod_title = $redux_wish['wish-woo-single-product-title'];
$woo_single_prod_price = $redux_wish['wish-woo-single-product-price'];
$woo_single_prod_bgcolor = $redux_wish['wish-woo-single-product-bgcolor'];


$css .= "
.summary h1{
	font-family: ".esc_attr($woo_single_prod_title['font-family']).";
	font-weight: ".esc_attr($woo_single_prod_title['font-weight']).";	
	font-size: ".esc_attr($woo_single_prod_title['font-size']).";	
	line-height: ".esc_attr($woo_single_prod_title['line-height']).";	
	color: ".esc_attr($woo_single_prod_title['color']).";
}
.woocommerce div.product p.price{
	font-family: ".esc_attr($woo_single_prod_price['font-family']).";
	font-weight: ".esc_attr($woo_single_prod_price['font-weight']).";	
	font-size: ".esc_attr($woo_single_prod_price['font-size']).";	
	line-height: ".esc_attr($woo_single_prod_price['line-height']).";	
	color: ".esc_attr($woo_single_prod_price['color']).";	
	width:100%;
}
.single-product{
	background-color: ".esc_attr($woo_single_prod_bgcolor).";
}

";

// wish-blog-banner-title-font
$wish_blog_banner_title_font = $redux_wish['wish-blog-banner-title-font'];
$wish_blog_banner_text_font = $redux_wish['wish-blog-banner-text-font'];

$css.= "
.parallax-inner h1{
	font-family: ".esc_attr($wish_blog_banner_title_font['font-family']).";
	font-weight: ".esc_attr($wish_blog_banner_title_font['font-weight']).";	
	font-size: ".esc_attr($wish_blog_banner_title_font['font-size']).";
	line-height: ".esc_attr($wish_blog_banner_title_font['line-height']).";
	color: ".esc_attr($wish_blog_banner_title_font['color']).";
}

.parallax-inner .description{
	font-family: ".esc_attr($wish_blog_banner_text_font['font-family']).";
	font-weight: ".esc_attr($wish_blog_banner_text_font['font-weight']).";	
	font-size: ".esc_attr($wish_blog_banner_text_font['font-size']).";
	line-height: ".esc_attr($wish_blog_banner_text_font['line-height']).";
	color: ".esc_attr($wish_blog_banner_text_font['color']).";
}
";



	wish_compile_css($css);





?>
