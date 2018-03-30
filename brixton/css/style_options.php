<?php
global $pmc_data; 
$use_bg = ''; $background = ''; $custom_bg = ''; $body_face = ''; $use_bg_full = ''; $bg_img = ''; $bg_prop = '';



if(isset($pmc_data['background_image_full'])) {
	$use_bg_full = $pmc_data['background_image_full'];
	
}

if(isset($pmc_data['use_boxed'])){
	$use_boxed = $pmc_data['use_boxed'];
}
else{
	$use_boxed = 0;
}

if($use_bg_full) {


	if($use_bg_full && isset($pmc_data['use_boxed']) && $pmc_data['use_boxed'] == 1) {
		$bg_img = $pmc_data['image_background'];
		$bg_prop = '';
	}

	

	
	$background = 'url('. $bg_img .') '.$bg_prop ;

}

function ieOpacity($opacityIn){
	
	$opacity = explode('.',$opacityIn);
	if($opacity[0] == 1)
		$opacity = 100;
	else
		$opacity = $opacity[1] * 10;
		
	return $opacity;
}

function HexToRGB($hex,$opacity) {
		$hex = preg_replace("/#/", "", $hex);
		$color = array();
 
		if(strlen($hex) == 3) {
			$color['r'] = hexdec(substr($hex, 0, 1) . $r);
			$color['g'] = hexdec(substr($hex, 1, 1) . $g);
			$color['b'] = hexdec(substr($hex, 2, 1) . $b);
		}
		else if(strlen($hex) == 6) {
			$color['r'] = hexdec(substr($hex, 0, 2));
			$color['g'] = hexdec(substr($hex, 2, 2));
			$color['b'] = hexdec(substr($hex, 4, 2));
		}
 
		return 'rgba('.$color['r'] .','.$color['g'].','.$color['b'].','.$opacity.')';
	}
	
	if(isset($pmc_data['google_menu_custom']) && $pmc_data['google_menu_custom'] != ''){
		$font_menu = explode(':',$pmc_data['google_menu_custom']);
		if(count($font_menu)>1) {
			$font_menu = $font_menu[0];
		}
		else{
			$font_menu = $pmc_data['google_menu_custom'];
		}
	}else{
		$font_menu = explode(':',$font_menu);
		if(count($font_menu)>1) {
			$font_menu = $font_menu[0];
		}
		else{
			$font_menu = $font_menu;
		}
	}		
	
	if(isset($pmc_data['google_quote_custom']) && $pmc_data['google_quote_custom'] != ''){
		$font_quote = explode(':',$pmc_data['google_quote_custom']);
		if(count($font_quote)>1) {
			$font_quote = $font_quote[0];
		}
		else{
			$font_quote = $pmc_data['google_quote_custom'];
		}
	}else{
		$font_quote = explode(':',$font_quote);
		if(count($font_quote)>1) {
			$font_quote = $font_quote[0];
		}
		else{
			$font_quote = $font_quote;
		}
	}	

	if(isset($pmc_data['google_heading_custom']) && $pmc_data['google_heading_custom'] != ''){
		$font_heading = explode(':',$pmc_data['google_heading_custom']);
		if(count($font_heading)>1) {
			$font_heading = $font_heading[0];
		}
		else{
			$font_heading= $pmc_data['google_heading_custom'];
		}	
	}else{
		$font_heading = explode(':',$font_heading);
		if(count($font_heading)>1) {
			$font_heading = $font_heading[0];
		}
		else{
			$font_heading=$font_heading;
		}	
	}

	if(isset($pmc_data['google_body_custom']) && $pmc_data['google_body_custom'] != ''){
		$font_body = explode(':',$pmc_data['google_body_custom']);
		if(count($font_body)>1) {
			$font_body = $font_body[0];
		}
		else{
			$font_body = $pmc_data['google_body_custom'];
		}
	}else{
		$font_body = explode(':',$font_body);
		if(count($font_body)>1) {
			$font_body = $font_body[0];
		}
		else{
			$font_body = $font_body;
		}		
	}	

?>


.block_footer_text, .quote-category .blogpostcategory, .quote-widget p, .quote-widget .blogcontent-title {font-family: <?php echo $font_quote; ?>, "Helvetica Neue", Arial, Helvetica, Verdana, sans-serif;}
body {	 
	background:<?php echo $pmc_data['body_background_color'].' '.$background ?>  !important;
	color:<?php echo $pmc_data['body_font']['color']; ?>;
	font-family: <?php echo $font_body; ?>, "Helvetica Neue", Arial, Helvetica, Verdana, sans-serif;
	font-size: <?php echo $pmc_data['body_font']['size']; ?>;
	font-weight: normal;
}
::selection { background: #000; color:#fff; text-shadow: none; }

h1, h2, h3, h4, h5, h6, .block1 p, .blog-category a, .post-meta a,.widget_wysija_cont .wysija-submit  {font-family: <?php echo $font_heading; ?>, "Helvetica Neue", Arial, Helvetica, Verdana, sans-serif;}
h1 { 	
	color:<?php echo $pmc_data['heading_font_h1']['color']; ?>;
	font-size: <?php echo $pmc_data['heading_font_h1']['size'] ?> !important;
	}
	
h2, .term-description p { 	
	color:<?php echo $pmc_data['heading_font_h2']['color']; ?>;
	font-size: <?php echo $pmc_data['heading_font_h2']['size'] ?> !important;
	}

h3 { 	
	color:<?php echo $pmc_data['heading_font_h3']['color']; ?>;
	font-size: <?php echo $pmc_data['heading_font_h3']['size'] ?> !important;
	}

h4 { 	
	color:<?php echo $pmc_data['heading_font_h4']['color']; ?>;
	font-size: <?php echo $pmc_data['heading_font_h4']['size'] ?> !important;
	}	
	
h5 { 	
	color:<?php echo $pmc_data['heading_font_h5']['color']; ?>;
	font-size: <?php echo $pmc_data['heading_font_h5']['size'] ?> !important;
	}	

h6 { 	
	color:<?php echo $pmc_data['heading_font_h6']['color']; ?>;
	font-size: <?php echo $pmc_data['heading_font_h6']['size'] ?> !important;
	}	
	
a {color:#333;}
h1 a {color:<?php echo $pmc_data['heading_font_h1']['color']; ?>;}
h2 a {color:<?php echo $pmc_data['heading_font_h2']['color']; ?>;}
h3 a {color:<?php echo $pmc_data['heading_font_h3']['color']; ?>;}
h4 a {color:<?php echo $pmc_data['heading_font_h4']['color']; ?>;}
h5 a {color:<?php echo $pmc_data['heading_font_h5']['color']; ?>;}
h6 a {color:<?php echo $pmc_data['heading_font_h6']['color']; ?>;}

.pagenav a {font-family: <?php echo $font_menu; ?> !important;
			  font-size: <?php echo $pmc_data['menu_font']['size'] ?>;
			  font-weight:<?php echo $pmc_data['menu_font']['style'] ?>;
			  color:<?php echo $pmc_data['menu_font']['color'] ?>;
}
.pagenav .social_icons a{color:<?php echo $pmc_data['menu_font']['color'] ?>;}
.pagenav .social_icons a:hover{color:<?php echo $pmc_data['body_box_coler']; ?>;}
.pagenav li li a, .block1_lower_text p,.widget_wysija_cont .updated, .widget_wysija_cont .login .message  {font-family: <?php echo $font_body; ?>, "Helvetica Neue", Arial, Helvetica, Verdana, sans-serif !important;color:#444;font-size:14px;}

 
h3#reply-title, select, input, textarea, button, .link-category .title a{font-family: <?php echo $font_body; ?>, "Helvetica Neue", Arial, Helvetica, Verdana, sans-serif;}

.prev-post-title, .next-post-title, .blogmore, .more-link {font-family: <?php echo $font_heading; ?>, "Helvetica Neue", Arial, Helvetica, Verdana, sans-serif;}


div#logo {padding-top:<?php echo $pmc_data['logo_top_padding']; ?>px;padding-bottom:<?php echo $pmc_data['logo_bottom_padding']; ?>px;}

.logo-advertise .widget {margin-top:<?php echo $pmc_data['sidebar_header_top_padding']; ?>px;}

#brixton-slider {margin-top:<?php echo $pmc_data['rev_slider_margin']; ?>px;}

/* ***********************
--------------------------------------
------------MAIN COLOR----------
--------------------------------------
*********************** */

a:hover, span, .current-menu-item a, .blogmore, .more-link, .pagenav.fixedmenu li a:hover, .widget ul li a:hover,.pagenav.fixedmenu li.current-menu-item > a,.block2_text a,
.blogcontent a, .sentry a

{
	color:<?php echo $pmc_data['mainColor']; ?>;
}

.su-quote-style-default  {border-left:5px solid <?php echo $pmc_data['mainColor']; ?>;}

 
/* ***********************
--------------------------------------
------------BACKGROUND MAIN COLOR----------
--------------------------------------
*********************** */

.top-cart, .blog_social .addthis_toolbox a:hover, #footer .social_icons a, .sidebar .social_icons a, .widget_tag_cloud a, .sidebar .widget_search #searchsubmit,
.menu ul.sub-menu li:hover, .specificComment .comment-reply-link:hover, #submit:hover, .addthis_toolbox a:hover, .wpcf7-submit:hover, #submit:hover,
.link-title-previous:hover, .link-title-next:hover, .specificComment .comment-edit-link:hover, .specificComment .comment-reply-link:hover, h3#reply-title small a:hover, .pagenav li a:after,
.widget_wysija_cont .wysija-submit,.sidebar-buy-button a, .widget ul li:before, #footer .widget_search #searchsubmit
  {
	background:<?php echo $pmc_data['mainColor']; ?> ;
}
.essb_links.essb_template_dark-retina a:hover {background:<?php echo $pmc_data['mainColor']; ?> !important;}
.pagenav  li li a:hover {background:none;}
.link-title-previous:hover, .link-title-next:hover {color:#fff;}
#headerwrap {background:<?php echo $pmc_data['menu_background_color']; ?>;border-top:<?php echo $pmc_data['menu_top_border']; ?>px solid #000;border-bottom:<?php echo $pmc_data['menu_bottom_border']; ?>px solid #000;}
.top-wrapper {background:<?php echo $pmc_data['top_menu_background_color']; ?>;}
div#logo, .logo-wrapper {background:<?php echo $pmc_data['header_background_color']; ?>;}

 /* ***********************
--------------------------------------
------------BOXED---------------------
-----------------------------------*/
<?php if($use_boxed == 0 &&  isset($pmc_data['use_background']) && $pmc_data['use_background'] == 1){ ?>
	body, .cf, .mainwrap, .post-full-width, .titleborderh2, .sidebar  {
	background:<?php echo $pmc_data['body_background_color'].' '.$background ?>  !important; 
	}
	
<?php	} ?>
 <?php if(isset($pmc_data['use_boxed']) &&  $use_boxed == 1){ ?>
header,.outerpagewrap{background:none !important;}
header,.outerpagewrap,.mainwrap, .block2, .sidebars-wrap{background-color:<?php echo $pmc_data['body_background_color'] ?> ;}
@media screen and (min-width:1220px){
body {width:1220px !important;margin:0 auto !important;}
.top-nav ul{margin-right: -21px !important;}
.mainwrap.shop {float:none;}
.pagenav.fixedmenu { width: 1220px !important;}
.bottom-support-tab,.totop{right:5px;}
<?php if($use_bg_full){ ?>
	body {
	background:<?php echo $pmc_data['body_background_color'].' '.$background ?>  !important; 
	background-attachment:fixed !important;
	background-size:cover !important; 
	-webkit-box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.2);
-moz-box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.2);
box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.2);
	}	
<?php	} ?>
 <?php if(!$use_bg_full){ ?>
	body {
	background:<?php echo $pmc_data['body_background_color'].' '.$background ?>  !important; 
	
	}
	
<?php	} ?>	
}
<?php } ?>
 
 <?php if(!empty($pmc_data['image_background_header'])){ ?>
	header {
	background:<?php echo $pmc_data['body_background_color'].' url('. $pmc_data['image_background_header'] .')'; ?>  !important; 
	background-attachment:fixed !important;
	width:100%;
	-webkit-box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.2);
	-moz-box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.2);
	box-shadow:	0px 0px 5px 1px rgba(0,0,0,0.2);
	float:left;
	}	
	.top-wrapper ,.logo-wrapper , div#logo{background:none;}
<?php	} ?>
 <?php if(empty($pmc_data['use_menu_back']) && !empty($pmc_data['image_background_header'])){ ?>
	#headerwrap {background:none;}
<?php	} ?>
<?php if(is_active_sidebar( 'sidebar-under-header-left') || is_active_sidebar( 'sidebar-under-header-fullwidth' )) {?>
	.sidebars-wrap.top {padding-top: 40px !important;}
<?php } ?>
 <?php if(is_active_sidebar( 'sidebar-footer-fullwidth' ) || is_active_sidebar( 'sidebar-footer-left' )){ ?>
	.sidebars-wrap.bottom {margin-top: 40px !important;}
<?php } ?>
 

/* ***********************
--------------------------------------
------------CUSTOM CSS----------
--------------------------------------
*********************** */

<?php echo pmc_stripText($pmc_data['custom_style']) ?>