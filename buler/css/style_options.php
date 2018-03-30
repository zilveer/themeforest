<?php
global $pmc_data; 
$use_bg = ''; $background = ''; $custom_bg = ''; $body_face = ''; $use_bg_header =''; $background_header = ''; $custom_bg_header = '';

if(isset($pmc_data['background_image'])) {
	$use_bg = $pmc_data['background_image'];
}


if(isset($pmc_data['background_image_header'])) {
	$use_bg_header = $pmc_data['background_image_header'];
}

if($use_bg) {

	$custom_bg = $pmc_data['body_bg_custom'];
	
	if(!empty($custom_bg)) {
		$bg_img = $custom_bg;
	} else {
		$bg_img = $pmc_data['body_bg'];
	}
	
	$bg_prop = $pmc_data['body_bg_properties'];
	
	$background = 'url('. $bg_img .') '.$bg_prop ;

}


/*if($use_bg_header) {

	$custom_bg_header = $pmc_data['header_bg_custom'];
	
	if(!empty($custom_bg)) {
		$bg_img_header = $custom_bg;
	} else {
		$bg_img_header = $pmc_data['header_bg'];
	}
	
	$bg_prop_header = $pmc_data['header_bg_properties'];
	
	$background_header = 'url('. $bg_img_header .') '.$bg_prop_header ;

}*/

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
	


?>

body {}
#headerwrap{background:<?php echo $pmc_data['header_background_color'].' '.$background ?>  !important;}
body {	 
	background:<?php echo $pmc_data['body_background_color'].' '.$background ?>  !important;
	color:<?php echo $pmc_data['body_font']['color']; ?>;
	font-family: <?php echo str_replace("%20"," ",str_replace(":300"," ",str_replace(":200"," ",str_replace(":400"," ",$pmc_data['body_font']['face'])))); ?>, "Helvetica Neue", Arial, Helvetica, Verdana, sans-serif;
	font-size: <?php echo $pmc_data['body_font']['size']; ?>;
	font-weight: normal;
	line-height: 1.65em;
	letter-spacing: normal;
}
::selection { background: <?php echo $pmc_data['mainColor']; ?>; color:#fff; text-shadow: none; }
h1,h2,h3,h4,h5,h6, .blogpostcategory .posted-date p, .team .title, .term-description p, .titleBottom{
	font-family: <?php echo str_replace("%20"," ",str_replace(":300"," ",str_replace(":200"," ",str_replace(":400"," ",$pmc_data['heading_font']['face'])))); ?> !important;
	<?php if(strpos($pmc_data['heading_font']['face'],'200')) {?>
		font-weight: 300;
	<?php } else { ?>
		font-weight: normal;
	<?php }  ?>
	line-height: 110%;
}
#submit, .aq-block-aq_contact_block .wpcf7-submit, .homerecent .productF .recentCart, .homerecent .productR .recentCart,
.homerecent .productR .recentdescription .onsale, .cartTopDetails .product_list_widget .buttons a, .homerecent .wocategoryFull .one_fourth h3 a,
.widget_shopping_cart .buttons a, .widget_price_filter .price_slider_amount .button, .place-order .button, .widget_login .submitbutton,
.woocommerce-tabs ul.tabs a, #reviews #comments .add_review a, .rightContentSP .price, .rightContentSP .single_add_to_cart_button,
.mainwrap.shop.sidebarshop .homerecent.productRH .recentdescription h3 a,
a.button, button.button, input.button, #respond input#submit, #content input.button, .menu .pmcbig span, .menu .pmcbig .pmcmenutitle > a
{font-family: <?php echo str_replace("%20"," ",str_replace(":300"," ",str_replace(":200"," ",str_replace(":400"," ",$pmc_data['heading_font']['face'])))); ?> !important;
	<?php if(strpos($pmc_data['heading_font']['face'],'200')) {?>
		font-weight: 300;
	<?php } else { ?>
		font-weight: normal;
	<?php }  ?>}
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
h2.title a {color:<?php echo $pmc_data['heading_font_h2']['color']; ?>;}
a, a:active, a:visited, .footer_widget .widget_links ul li a{color: <?php echo $pmc_data['body_link_coler']; ?>;}	
.widget_nav_menu ul li a  {color: <?php echo $pmc_data['body_link_coler']; ?>;}
a:hover, h2.title a:hover, .item3 h3:hover, .item4 h3:hover, .item3 h3 a:hover, #portitems2 h3 a:hover {color: <?php echo $pmc_data['mainColor']; ?>;}
.product-remove a:hover {color: <?php echo $pmc_data['mainColor']; ?> !important;}
.item3 h3, .item4 h3, .item3 h3 a, .item4 h3 a, .item3 h4, .item2 h4, .item4 h4, #portitems2 h3 a {color:<?php echo $pmc_data['heading_font_h3']['color']; ?>;}


/* ***********************
--------------------------------------
------------NIVO SLIDER----------
--------------------------------------
*********************** */

.nivo-caption { 
	position:absolute; 
	background-color: <?php echo$pmc_data['slider_backColorNivo'] ?>;
	background-color: <?php echo HexToRGB($pmc_data['slider_backColorNivo'],$pmc_data['slider_opacity'])?>;
	border: 1px solid <?php echo $pmc_data['slider_borderColorNivo']; ?>; 
	color: <?php echo $pmc_data['slider_fontSize_colorNivo']['color']; ?>; 
	font-size: <?php echo $pmc_data['slider_fontSize_colorNivo']['size']; ?>;
	font-family: <?php echo str_replace("%20"," ",str_replace(":300"," ",str_replace(":200"," ",str_replace(":400"," ",$pmc_data['heading_font']['face'])))); ?> !important;
	letter-spacing: normal;
	padding:5px 15px 5px 15px;
	z-index:99;
	top:50px;
	left:0px;
	text-align:center;
	line-height:120%;
}

.nivo-caption a { 
	color: <?php echo $pmc_data['slider_fontSize_colorNivo']['color']; ?>;  
	text-decoration: underline; 
}	



/* ***********************
--------------------------------------
------------JUST FOR THE LIVE DEMO COLORS PREVIEW----------
--------------------------------------
*********************** */
.slotholder img, .iosSlider .slider .item .desc a {background:<?php echo $pmc_data['mainColor']; ?> !important;}
.ui-progressbar-value {background-color:<?php echo $pmc_data['mainColor']; ?> !important;}


.aq-posts-block .postDate, .item3 .portDate {background:<?php echo $pmc_data['mainColor']; ?>;}
.aq-posts-block .postDate, .item3 .portDate {background: <?php echo HexToRGB($pmc_data['mainColor'], $pmc_data['slider_opacity']); ?>;}
.slider-category .anythingBase,#nslider img, .related h3, .projectdescription h3, .portsingle .portfolio h3, .titleborderh,
.socialsingle h2, .portCategory3 a {
	background:<?php echo $pmc_data['body_background_color'].' '.$background  ?>  !important;
	}
.portsingle .item4 h3 {background:transparent !important;}
#slider-wrapper-iframe, #slider-wrapper  {background:<?php echo $pmc_data['header_background_color'].' '.$background_header  ?>  !important;}

.woocommerce-checkout .form-row .chzn-container-single .chzn-single div b {background-position: 0 7px !important;}
.woocommerce-checkout .form-row .chzn-container-active .chzn-single-with-drop div b {background-position: -18px 7px !important;}
/* ***********************
--------------------------------------
------------MAIN COLOR----------
--------------------------------------
*********************** */

#footer .product_list_widget li del, #footer .widget del span, .footer_widget h3 span,.catlinkhover,.item h3 a:hover, .item2 h3 a:hover, .item4 h3 a:hover,.catlink:hover, .item4 h4 a:hover,.tags a:hover,
.blogpost .link:hover,.blogpost .postedin:hover ,.blogpost .postedin:hover, .blogpost .link a:hover,.blogpostcategory a.textlink:hover,
.footer_widget .widget_links ul li a:hover, .footer_widget .widget_categories  ul li a:hover,  .footer_widget .widget_archive  ul li a:hover,
#footerb .footernav ul li a:hover,.footer_widget  ul li a:hover,.tags span a:hover,.more-link:hover,.showpostpostcontent h1 a:hover,
.menu li a:hover,.menu li a:hover strong, .menu li ul li:hover ul li:hover a,.blogpostcategory .meta .written:hover a ,.blogpostcategory .meta .comments:hover a ,
#wp-calendar a , .widgett a:hover ,.widget_categories li.current-cat a, .widget_categories li.current-cat, .blogpostcategory .meta .time a:hover,.homerecent h2 span, .advertise h2 span, 
.related h3 span, .homeremove .catlink .sortingword:hover, .homeremove .catlinkhover .sortingword, .blogpost .datecomment  .link a,
.titleborderh span, .textSlide .box, .widget_login p a:hover, .priceSP ins,  .boxmore a:hover,.single-portfolio-skils i, .posted-date a, .categoryblog a,.blogpostcategory .blogmore,
 .textSlide .salePrice1 a, .textSlide .salePrice2 a, .textSlide .salePrice3 a, .textSlide span, .homerecent .recentmore:hover,.content ol.commentlist li .reply a, .content ol.commentlist li .comment-author .commentsDate,
.widget_login p a:hover, .priceSP ins, .titletext span,.homerecent h3:hover,.aq-posts-block h3:hover,.portsingle.home .read-more a,.top-nav a:hover, .recentdescription-text a,
.homerecent .recentLinkMore a, .langActive, langNotActive:hover,  .portCategory3 a, .outerpagewrap .portnavigation .portprev, .outerpagewrap .portnavigation .portnext,
.featured-circles.dark,  .featured-circles.dark h5, .aq_block_faq:hover i, .aq_block_faq:hover h2, .aq-posts-block .categories a, .post.home .read-more a, .post.home .read-more, .post.home .read-more:hover,
.infotext a,.aq-posts-block-meta a, .copyright a, .blogpostcategory .post-meta a, .singledefult .meta a, .testimonial-author span.author:hover, .testimonial-author a:hover span.author, .current-menu-ancestor > a,
.menu > li a strong:after, .footer_widget .widget_nav_menu ul li a:after, .featured-block span, .homerecent .wocategoryFull .one_fourth h3 a:hover, .rightContentSP .amount,
.mainwrap.shop.sidebarshop .homerecent.productRH .recentdescription h3 a:hover, .cartTopDetails .product_list_widget li a:hover
{color:<?php echo $pmc_data['mainColor']; ?> !important;}


.socialsingle h2 span, .homerecent h2 span, .advertise h2 span, .related h3 span, .portfolio h3 span, .portsingleshare span, .titleborderh span,
.blogpostcategory .meta .category a, .singledefult .meta .category a, #portitems2 .category a, .homerecent .category a, .portcategories a
{background:<?php echo $pmc_data['mainColor']; ?> !important; color: <?php echo $pmc_data['body_box_coler']; ?> !important;text-shadow:0 1px 0 <?php echo HexToRGB($pmc_data['ShadowColorFont'],$pmc_data['ShadowOpacittyColorFont'])?>;padding:2px 6px 3px 6px; }
.widget del .amount {background:none !important;}

.menu .pmcbig ul.sub-menu li li a:before {border:2px solid <?php echo $pmc_data['mainColor']; ?>;}
.textSlide h1.underline {border-bottom:6px solid <?php echo $pmc_data['mainColor']; ?>;}
.TopHolder {border-top:5px solid <?php echo $pmc_data['mainColor']; ?>;}

.searchTop #searchsubmit:hover {background: <?php echo $pmc_data['mainColor']; ?> url(<?php echo get_template_directory_uri() ?>/css/images/topSocialIcons.png) no-repeat -219px -1px;}
/* ***********************
--------------------------------------
------------BOX COLOR----------
--------------------------------------
*********************** */


 .item3 h3, .item4 h3, .item3 h3 a, .item4 h3 a ,.homewrap .homesingleleft,.homewrap .homesingleright, .container,.audioPlayerWrap
{ background:<?php echo $pmc_data['boxColor']; ?>}
.iosSlider .slider .item {border-left: 1px solid <?php echo $pmc_data['boxColor']; ?>}
.image-gallery, .gallery-item, .blogpostcategory iframe, #slider-category, .blogFullWidth #slider-category, 
.category_posts .widgett img,.recent_posts .widgett  img,.blogpostcategory .commentblog .circleHolder, .singledefult .commentblog .circleHolder

{ background:<?php echo $pmc_data['boxColor']; ?> !important;}

.recentdescription-borderLine .left, .testimonial-borderLine .left, .category_posts .widgett img:hover,.recent_posts .widgett  img:hover,#fancybox-close:hover, 
.homePostComments a, .blogpostcategory .blogComments, .singledefult .blogComments,.portCategory a, .closehomeshow-portfolio, .closehomeshow-post, .closehomeshow-feautured, .closehomeshow-recent,
 .outerpagewrap .portnavigation .portprev:hover, .outerpagewrap .portnavigation .portnext:hover, .related .one_fourth .image img:hover,
 .homerecent .productF .recentCart a:hover, .homerecent .productR .recentCart a:hover, .product_list_widget .cartTopDetails .buttons a:hover,
 .cartTopDetails .product_list_widget  .buttons a:hover, .widget_shopping_cart .buttons a:hover,
 .widget_price_filter .price_slider_amount .button:hover, .place-order .button:hover, .widget_login .submitbutton:hover,
 .woocommerce-tabs ul.tabs .active a, .woocommerce-tabs ul.tabs a:hover, .woocommerce-tabs ul.tabs a.current, .show_review_form.button:hover,
 .rightContentSP .single_add_to_cart_button:hover, a.button:hover, button.button:hover, input.button:hover, #respond input#submit:hover, #content input.button:hover,
 .menu .pmcbig ul.sub-menu li li:hover a:before 
{background:<?php echo $pmc_data['mainColor']; ?> !important;}
 .homerecent .overdefult, .item3 .overdefult{background: <?php echo HexToRGB($pmc_data['mainColor'], 0.8); ?> url(<?php echo get_template_directory_uri() ?>/css/images/plusIcon.png) no-repeat 160px 140px;}
.blogpostcategory .overdefultlink{background: <?php echo HexToRGB($pmc_data['mainColor'], 0.8); ?> url(<?php echo get_template_directory_uri() ?>/css/images/plusIcon.png) no-repeat 370px 165px;}
 .item4 .overdefult {background: <?php echo HexToRGB($pmc_data['mainColor'], 0.8); ?> url(<?php echo get_template_directory_uri() ?>/css/images/plusIcon.png) no-repeat 100px 50px;}
 #portitems2 .overdefult {background: <?php echo HexToRGB($pmc_data['mainColor'], 0.8); ?>;}
.item2 .portCategory a{background:none !important;}
.homerecent h3 a, .item4 h3, .item4 h3 a {color:<?php echo $pmc_data['body_font']['color']; ?>;}
#remove a, #remove a span{color:<?php echo $pmc_data['body_font']['color']; ?>;font-family: <?php echo str_replace("%20"," ",str_replace(":300"," ",str_replace(":200"," ",str_replace(":400"," ",$pmc_data['body_font']['face'])))); ?>, "Helvetica Neue", Arial, Helvetica, Verdana, sans-serif;} 

/* ***********************
--------------------------------------
------------BOX FONT COLOR----------
--------------------------------------
*********************** */

.homerecent h3.category a, .blogpostcategory .meta .category a, .singledefult .meta .category a, #portitems2 h3.category a, .team .role,.portcategories a,
.wp-pagenavi a:hover, .wp-pagenavi span.current, #respond #commentform input#submit:hover, #contactform .contactbutton .contact-button:hover, .blogpostcategory .date-inside, .singledefult .date-inside,
 .pagecontent h1,.homerecent h3.category a:hover,
.homeremove .catlink span, .errorpage .postcontent h2, .errorpage .posttext, .blogpostcategory .date-inside .day, .singledefult .date-inside .day,.blogpostcategory .date-inside .month, .singledefult .date-inside .month,textSlide .quote, textSlide .quote2, .infotext span,
.widget_tag_cloud a:hover, .widget_product_tag_cloud a:hover, .boxmore a 

 {color: <?php echo $pmc_data['body_box_coler']; ?> !important;}
.homeremove .catlinkhover .sortingword, .homeremove .catlink .sortingword:hover {background:<?php echo $pmc_data['body_box_coler']; ?>;}

/* ***********************
--------------------------------------
------------MAIN COLOR BOXED----------
--------------------------------------
*********************** */
.role, .team .icon img, .blogpostcategory .posted-date .date-inside,.singledefult .posted-date .date-inside,
.errorpage,  ins, 
.item4 .image, .item3 .image, .item2 .image, .item2 .image, .category_posts .widgett img:hover, .recent_posts .widgett  img:hover,
 #portitems2 .image,  .widget_price_filter .ui-slider .ui-slider-handle, 
.widget_price_filter .ui-widget-content, .item4 .image, .item3 .image, .item2 .image, .featured-circles-text a ,.featured-circles-icon-inner,
#commentform #respond #commentform input#submit:hover, #respond #commentform input#submit:hover, .aq-block-aq_contact_block .wpcf7-submit:hover, mark
{background:<?php echo $pmc_data['mainColor']; ?> ;}
.featured-block:hover {background:<?php echo $pmc_data['mainColor']; ?> !important ;}

.widget_tag_cloud a:hover, .widget_product_tag_cloud a:hover{background:<?php echo $pmc_data['mainColor']; ?> !important;}

.wp-pagenavi a:hover, .wp-pagenavi span.current, #content input.button,
 #respond input#submit:hover, #content input.button:hover
  {background:<?php echo $pmc_data['mainColor']; ?>; text-shadow:0 1px 0 <?php echo HexToRGB($pmc_data['ShadowColorFont'],$pmc_data['ShadowOpacittyColorFont'])?>;}
.blogpostcategory .comment-inside a, .singledefult .comment-inside a, .blogpostcategory .date-inside,.singledefult .date-inside,textSlide .quote, textSlide .quote2 {color: <?php echo $pmc_data['body_box_coler']; ?> !important; text-shadow:0 1px 0 <?php echo HexToRGB($pmc_data['ShadowColorFont'],$pmc_data['ShadowOpacittyColorFont'])?>;}
.textSlide .button, .textSlide .box {text-shadow:none;}
.iosSlider .prevButton, a.nivo-prevNav{background:<?php echo $pmc_data['mainColor']; ?> url(<?php echo get_template_directory_uri() ?>/css/images/slideshowArrows.png) no-repeat 16px 19px !important;}
.iosSlider .nextButton, a.nivo-nextNav{background:<?php echo $pmc_data['mainColor']; ?> url(<?php echo get_template_directory_uri() ?>/css/images/slideshowArrows.png) no-repeat -46px 19px !important;}
.iosSlider .prevButton, .blogsingleimage .prevbutton.port, .leftContentSP .images.imagesSP .prevbutton.port {background: <?php echo $pmc_data['mainColor']; ?>; background: <?php echo HexToRGB($pmc_data['mainColor'], $pmc_data['slider_opacity']); ?>}
.iosSlider .nextButton, .blogsingleimage .nextbutton.port,.leftContentSP .images.imagesSP .nextbutton.port  {background: <?php echo $pmc_data['mainColor']; ?>; background: <?php echo HexToRGB($pmc_data['mainColor'], $pmc_data['slider_opacity']); ?> }
.tp-leftarrow.default{background: <?php echo HexToRGB($pmc_data['mainColor'], $pmc_data['slider_opacity']); ?> url(<?php echo get_template_directory_uri() ?>/css/images/slideshowArrows.png) no-repeat 16px 19px !important;}
.tp-rightarrow.default {background: <?php echo HexToRGB($pmc_data['mainColor'], $pmc_data['slider_opacity']); ?> url(<?php echo get_template_directory_uri() ?>/css/images/slideshowArrows.png) no-repeat -46px 19px !important;}


/* ***********************
--------------------------------------
------------MAIN BORDER COLOR----------
--------------------------------------
*********************** */
#logo a, .recentborder,.item4 .recentborder, .item3 .recentborder,.afterlinehome,.TopHolder ,.borderLineLeft, .borderLineLeftSlideshow  {border-color:<?php echo $pmc_data['mainColor']; ?> ;}
.featured-circles:hover {border: 2px solid <?php echo HexToRGB($pmc_data['mainColor'], 0.9)?>;}
.featured-circles {border-top:2px solid <?php echo HexToRGB($pmc_data['mainColor'], 0.9)?>;border-bottom:2px solid <?php echo HexToRGB($pmc_data['mainColor'], 0.9)?>;}
.gototop:hover {background-color:<?php echo HexToRGB($pmc_data['mainColor'], 0.75)?> !important;}
.widget-line, .advertise li:hover  {border-bottom:3px solid <?php echo $pmc_data['mainColor']; ?>; }
/* ***********************
--------------------------------------
------------BODY COLOR----------
--------------------------------------
*********************** */

.blogpost .link a,.datecomment span,.homesingleleft .tags a,.homesingleleft .postedin a,.blogpostcategory .category a,.singledefult .category a,.blogpostcategory .comments a,.singledefult .comments a,
.blogpostcategory a.textlink ,.singledefult a.textlink ,.written a, .blogpostcategory .meta .time a, .singledefult .meta .time a	
{ color:<?php echo $pmc_data['body_font']['color']; ?>}


/* ***********************
--------------------------------------
------------MENU----------
--------------------------------------
*********************** */

.menu li:hover ul {border-bottom: 5px solid <?php echo $pmc_data['mainColor']; ?>;}
.menu li ul li a, .item4 h4 a, #portitems2 .category a, .homerecent .category a, .item3 h4 a
{	font-family: <?php echo str_replace("%20"," ",str_replace(":300"," ",str_replace(":200"," ",str_replace(":400"," ",$pmc_data['body_font']['face'])))); ?>, "Helvetica Neue", Arial, Helvetica, Verdana, sans-serif !important; }
.menu > li a {	font-family: <?php echo str_replace("%20"," ",str_replace(":300"," ",str_replace(":200"," ",str_replace(":400"," ",$pmc_data['menu_font'])))); ?>, "Helvetica Neue", Arial, Helvetica, Verdana, sans-serif !important; color:#47403A;letter-spacing: normal;}
.menu a span{ 	font-family: <?php echo str_replace("%20"," ",str_replace(":300"," ",str_replace(":200"," ",str_replace(":400"," ",$pmc_data['body_font']['face'])))); ?>, "Helvetica Neue", Arial, Helvetica, Verdana, sans-serif  !important; color:#aaa !important;letter-spacing: normal;}

.top-nav a {color:#fff;}
/* ***********************
--------------------------------------
------------BLOG----------
-----------------------------------*/
.blogpostcategory h2 {line-height: 110% !important;}
.wp-pagenavi span.pages {font-family: <?php echo str_replace("%20"," ",str_replace(":300"," ",str_replace(":200"," ",str_replace(":400"," ",$pmc_data['body_font']['face'])))); ?>, "Helvetica Neue", Arial, Helvetica, Verdana, sans-serif;}
.showpostpostcontent h1 a {color:<?php echo $pmc_data['heading_font_h2']['color']; ?>;}
.wp-pagenavi a:hover,.page .homerecent .bx-prev:hover, .page .homerecent .bx-next:hover,.page .homerecent.post .bx-prev:hover, .page .homerecent.post .bx-next:hover,
.page .homerecent .bx-next:hover, .advertise .bx-next:hover, .post-full-width-inner .bx-next:hover,
.page .homerecent .bx-prev:hover, .advertise .bx-prev:hover, .post-full-width-inner .bx-prev:hover  
{ background-color:<?php echo $pmc_data['mainColor']; ?> !important; }
.blogpost .datecomment a, .related h4 a, .content ol.commentlist li .comment-author .fn a{color:<?php echo $pmc_data['body_font']['color']; ?>;}
.blogpost .datecomment a:hover, .tags a:hover, .related h4 a:hover, .content ol.commentlist li .comment-author .fn a:hover{ color:<?php echo $pmc_data['mainColor']; ?>; }
.comment-author .fn a{font-family: <?php echo str_replace("%20"," ",str_replace(":300"," ",str_replace(":200"," ",str_replace(":400"," ",$pmc_data['heading_font']['face'])))); ?> !important;}
.image-gallery, .gallery-item { border: 2px dashed <?php echo $pmc_data['mainColor']; ?>;}
.blogpostcategory .posted-date p, .singledefult .posted-date p{font-family: <?php echo str_replace("%20"," ",str_replace(":300"," ",str_replace(":200"," ",str_replace(":400"," ",$pmc_data['body_font']['face'])))); ?>, "Helvetica Neue", Arial, Helvetica, Verdana, sans-serif !important;text-shadow:0 1px 0 <?php echo HexToRGB($pmc_data['ShadowColorFont'],$pmc_data['ShadowOpacittyColorFont'])?>;}
.pagecontent h1, .pagecontent p,  .team .role,  .pagecontentContent #breadcrumb {text-shadow:0 1px 0 <?php echo HexToRGB($pmc_data['ShadowColorFont'],$pmc_data['ShadowOpacittyColorFont'])?>;}

/* ***********************
--------------------------------------
------------Widget----------
-----------------------------------*/
.wttitle a {color:<?php echo $pmc_data['heading_font_h4']['color']; ?>;}

.widgett a:hover, .widget_nav_menu ul li a:hover{color:<?php echo $pmc_data['mainColor']; ?> !important;}
 .widget_nav_menu ul li a{	font-family: <?php echo str_replace("%20"," ",str_replace(":300"," ",str_replace(":200"," ",str_replace(":400"," ",$pmc_data['body_font']['face'])))); ?>, "Helvetica Neue", Arial, Helvetica, Verdana, sans-serif !important; }
.related h4{	font-family: <?php echo str_replace("%20"," ",str_replace(":300"," ",str_replace(":200"," ",str_replace(":400"," ",$pmc_data['body_font']['face'])))); ?>, "Helvetica Neue", Arial, Helvetica, Verdana, sans-serif !important; }
.widget_search form div {	font-family: <?php echo str_replace("%20"," ",str_replace(":300"," ",str_replace(":200"," ",str_replace(":400"," ",$pmc_data['body_font']['face'])))); ?>, "Helvetica Neue", Arial, Helvetica, Verdana, sans-serif !important;}
.widgett a {	font-family: <?php echo str_replace("%20"," ",str_replace(":300"," ",str_replace(":200"," ",str_replace(":400"," ",$pmc_data['body_font']['face'])))); ?>, "Helvetica Neue", Arial, Helvetica, Verdana, sans-serif !important;}
.widget_tag_cloud a{	font-family: <?php echo str_replace("%20"," ",str_replace(":300"," ",str_replace(":200"," ",str_replace(":400"," ",$pmc_data['body_font']['face'])))); ?>, "Helvetica Neue", Arial, Helvetica, Verdana, sans-serif !important;}

/* ***********************
--------------------------------------
------------BUTTONS WITH SHORTCODES----------
--------------------------------------
*********************** */
.button_purche_right_top,.button_download_right_top,.button_search_right_top {font-family: <?php echo str_replace("%20"," ",str_replace(":300"," ",str_replace(":200"," ",str_replace(":400"," ",$pmc_data['heading_font']['face'])))); ?> !important;color:<?php echo $pmc_data['heading_font_h2']['color']; ?>;text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);}
.button_purche:hover,.button_download:hover,.button_search:hover {color:<?php echo $pmc_data['mainColor']; ?> !important;}
.ribbon_center_red a, .ribbon_center_blue a, .ribbon_center_white a, .ribbon_center_yellow a, .ribbon_center_green a {font-family: <?php echo str_replace("%20"," ",str_replace(":300"," ",str_replace(":200"," ",str_replace(":400"," ",$pmc_data['heading_font']['face'])))); ?> !important;}
a.button.loading::before, button.button.loading::before, input.button.loading::before {content: "";position: absolute;height: 32px;width: 32px;bottom: 20px;left: 150px;text-indent: 0;background:url(images/loading.gif) no-repeat;}


/* ***********************
--------------------------------------
------------EXTRA TYPOGRAPHY----------
-----------------------------------*/
.homerecent h3 a, .item4 h3, .item4 h3 a, .boxdescwraper h2,.socialfooter h3,  #portitems2 h3, 
.content ol.commentlist li .comment-author .fn a, .projectdescription h2, .team .title, .menu ul.sub-menu li a, .menu ul.children li a
{ font-family: <?php echo str_replace("%20"," ",str_replace(":300"," ",str_replace(":200"," ",str_replace(":400"," ",$pmc_data['body_font']['face'])))); ?>, "Helvetica Neue", Arial, Helvetica, Verdana, sans-serif !important;}


/* ***********************
--------------------------------------
------------GRADIENTS----------
-----------------------------------*/

.widget_price_filter .ui-slider .ui-slider-handle {-moz-box-shadow:none;-webkit-box-shadow:none;border-radius: 3px;}

 .page .homerecent .bx-next, .advertise .bx-next, .post-full-width-inner .bx-next {background-image: url('<?php echo get_template_directory_uri() ?>/css/images/slideshowArrowForward.png');background-position:0px 1px;}
 .page .homerecent .bx-prev, .advertise .bx-prev, .post-full-width-inner .bx-prev   {background-image: url('<?php echo get_template_directory_uri() ?>/css/images/slideshowArrowBackward.png');background-position:0px 1px;}





/* ***********************
--------------------------------------
------------CUSTOM CSS----------
--------------------------------------
*********************** */

<?php echo pmc_stripText($pmc_data['custom_style']) ?>