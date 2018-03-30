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
.widget_shopping_cart .buttons a, .widget_price_filter_custom .price_slider_amount .button, .place-order .button, .widget_login .submitbutton,
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

.searchTop #searchsubmit:hover {background: <?php echo $pmc_data['mainColor']; ?> url(images/topSocialIcons.png) no-repeat -219px -1px;}
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
 .widget_price_filter_custom .price_slider_amount .button:hover, .place-order .button:hover, .widget_login .submitbutton:hover,
 .woocommerce-tabs ul.tabs .active a, .woocommerce-tabs ul.tabs a:hover, .woocommerce-tabs ul.tabs a.current, .show_review_form.button:hover,
 .rightContentSP .single_add_to_cart_button:hover, a.button:hover, button.button:hover, input.button:hover, #respond input#submit:hover, #content input.button:hover,
 .menu .pmcbig ul.sub-menu li li:hover a:before 
{background:<?php echo $pmc_data['mainColor']; ?> !important;}
 .homerecent .overdefult, .item3 .overdefult{background: <?php echo HexToRGB($pmc_data['mainColor'], 0.8); ?> url(images/plusIcon.png) no-repeat 160px 140px;}
.blogpostcategory .overdefultlink{background: <?php echo HexToRGB($pmc_data['mainColor'], 0.8); ?> url(images/plusIcon.png) no-repeat 370px 165px;}
 .item4 .overdefult {background: <?php echo HexToRGB($pmc_data['mainColor'], 0.8); ?> url(images/plusIcon.png) no-repeat 100px 50px;}
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
 #portitems2 .image,  .widget_price_filter_custom .ui-slider .ui-slider-handle, 
.widget_price_filter_custom .ui-widget-content, .item4 .image, .item3 .image, .item2 .image, .featured-circles-text a ,.featured-circles-icon-inner,
#commentform #respond #commentform input#submit:hover, #respond #commentform input#submit:hover, .aq-block-aq_contact_block .wpcf7-submit:hover
{background:<?php echo $pmc_data['mainColor']; ?> ;}
.featured-block:hover {background:<?php echo $pmc_data['mainColor']; ?> !important ;}

.widget_tag_cloud a:hover, .widget_product_tag_cloud a:hover{background:<?php echo $pmc_data['mainColor']; ?> !important;}

.wp-pagenavi a:hover, .wp-pagenavi span.current, #content input.button,
 #respond input#submit:hover, #content input.button:hover
  {background:<?php echo $pmc_data['mainColor']; ?>; text-shadow:0 1px 0 <?php echo HexToRGB($pmc_data['ShadowColorFont'],$pmc_data['ShadowOpacittyColorFont'])?>;}
.blogpostcategory .comment-inside a, .singledefult .comment-inside a, .blogpostcategory .date-inside,.singledefult .date-inside,textSlide .quote, textSlide .quote2 {color: <?php echo $pmc_data['body_box_coler']; ?> !important; text-shadow:0 1px 0 <?php echo HexToRGB($pmc_data['ShadowColorFont'],$pmc_data['ShadowOpacittyColorFont'])?>;}
.textSlide .button, .textSlide .box {text-shadow:none;}
.iosSlider .prevButton, a.nivo-prevNav{background:<?php echo $pmc_data['mainColor']; ?> url(images/slideshowArrows.png) no-repeat 16px 19px !important;}
.iosSlider .nextButton, a.nivo-nextNav{background:<?php echo $pmc_data['mainColor']; ?> url(images/slideshowArrows.png) no-repeat -46px 19px !important;}
.iosSlider .prevButton, .blogsingleimage .prevbutton.port, .leftContentSP .images.imagesSP .prevbutton.port {background: <?php echo $pmc_data['mainColor']; ?>; background: <?php echo HexToRGB($pmc_data['mainColor'], $pmc_data['slider_opacity']); ?>}
.iosSlider .nextButton, .blogsingleimage .nextbutton.port,.leftContentSP .images.imagesSP .nextbutton.port  {background: <?php echo $pmc_data['mainColor']; ?>; background: <?php echo HexToRGB($pmc_data['mainColor'], $pmc_data['slider_opacity']); ?> }
.tp-leftarrow.default{background: <?php echo HexToRGB($pmc_data['mainColor'], $pmc_data['slider_opacity']); ?> url(images/slideshowArrows.png) no-repeat 16px 19px !important;}
.tp-rightarrow.default {background: <?php echo HexToRGB($pmc_data['mainColor'], $pmc_data['slider_opacity']); ?> url(images/slideshowArrows.png) no-repeat -46px 19px !important;}


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

.widget_price_filter_custom .ui-slider .ui-slider-handle {-moz-box-shadow:none;-webkit-box-shadow:none;border-radius: 3px;}

 .page .homerecent .bx-next, .advertise .bx-next, .post-full-width-inner .bx-next {background-image: url('images/slideshowArrowForward.png');background-position:0px 1px;}
 .page .homerecent .bx-prev, .advertise .bx-prev, .post-full-width-inner .bx-prev   {background-image: url('images/slideshowArrowBackward.png');background-position:0px 1px;}


 
 
 
 
/* ***********************
--------------------------------------
------------RESPONSIVE MODE----------
--------------------------------------
*********************** */

<?php if($pmc_data['showresponsive'] ) { ?>

@media screen and (min-width:0px) and (max-width:1180px){
	.descriptionSP.short {text-align:left !important;margin-left:10px;}
	.socialProduct .addthis_toolbox {margin-left:10px;}
	.single_variation .price {margin-right:10px;}
	.rightContentSP .price {margin-left:10px;}
	.homerecent {padding: 20px 0 5px 0 !important;}
	.homerecent .recentdescription, .recentdescription-text {float:none;}
	.homerecent .recentdescription h3 {margin-bottom:20px;}
	.titlebordrtext .titleborderh2 {padding:0px;padding-top:10px;}
	.aq-block-aq_contact_block p {text-align:left;}
	.fullwidth .postcontent {margin-top:25px;}
	.single-portfolio-skils {padding-right:0px;width:95%;}
	.team {border-bottom:none !important;}
	.team .description, .team .iconwrap {padding-left:0px;}
	.team .role, .team .title, .team .iconwrap {margin-left:0px;}
	.content ol.commentlist li .reply a {margin-right:10px !important;}
	h3#comments {margin-left:20px !important;}
	.topNotification {margin-left:10px;}
	body{overflow:hidden;text-align:center;}
	.aq_block_faq, .testimonial-texts, .aq-posts-block {text-align:left;}
	.testimonial-description {background:#f1f1f1;}
	.breadcrumb-info{display:inline-block; float:none;}
	/*footer*/
	#footer{top:20px;}
	.footer_widget1{margin-top: 30px; }
	.twitterlink,.facebooklink,.vimeo,.dribble,.emaillink{float:none; }
	.footer_widget .widgett{margin:5px auto 15px auto !important; padding:0;}
	#footerb .copyright{padding-top:0px; margin-top:2px;width:95% !important; text-align:center !important;}
	.footer_widget .widget_search form div {padding:0;}
	.socialfooter .socialcategory{width:225px; float:none; margin:0 auto; display: inline-block;}
	.footer_widget .category_posts .widgett, .footer_widget .recent_posts .widgett{float:none;}

	/*menu + header*/
	#headerwrap{position:relative; min-height: 70px; float: left;}
	#logo {width:100%;float:left;position:relative; }
	#mainwrap,.outerpagewrap{top:0;}
	#header {float:left; padding-bottom:20px;}
	#logo {width:100%; }
	.infotext h2 {font-size:24px !important; line-height: 140%;}
	.current_page_ancestor, .current-menu-item{border:none !important;}
	.infotext h1 {text-align:center;}
	.menu,#header .infotextBorder{display:none !important;}
	.socialTopContainer {width:100%; float:none; margin:0 auto; display: inline-block;}
	.socialTopContainer a ,.socialcategory a {width: 15px !important; height: 15px !important; text-align:center;}
	.addthis_toolbox a.emaillink {width:40px; height:40px;}
	.socialTop {float:none; text-align:center;display: inline-block;}
	.searchTop {float:none; display:inline-block;margin-top:20px;}
	.respMenu { display:inline-block; margin: 5px 0; float: right;}
	.cartWrapper {position: relative;cursor: pointer;padding: 10px 10px 5px 10px !important;min-width: 110px;margin: 0 auto;height: 35px;float:none;}	
	.fixedmenu .cartWrapper{margin:0 auto !important;}
	.infotext h2{padding-top:23px;}
	.infotext{border-bottom:none;}
	
	/*homebox*/
	.descriptionHomePort {float:none;}
	.featured-circles{width:190px !important; display: inline-block;float: none; margin-top:5px;}
	.featured-circles h5{width:100%;}

	/*blocks*/
	.aq-template-wrapper .aq_span4 {height:auto;}
	.testimonial-description{width:auto;}
	.aq-block-aq_clear_block{height:15px !important;}
	.aq-block-media iframe{width:100%;}
	.aq-block-aq_featured_circles_block {display:inline-block; margin-left:2% !important; float: none !important;}
	.aq-block-aq_featured_circles_block  .featured-circles-text{height:40px; overflow:hidden;}
	.aq-block-aq_image_block img{max-width:100% !important;}
	.aq-block-aq_twitter_block li span{text-align: left !important;}
	.aq-block-aq_features_block{text-align:left;margin-bottom:20px}
	.aq-block-aq_title_border_block.aq_span12,.aq-block-aq_clear_block{clear:both}
	.aq_block_faq,.testimonials{width:98%;}
	.aq-block-aq_featured_circles_block{width:auto !important; height:240px;}

	/*home recent port*/
	.homerecent{margin-top:20px;}
	.homerecent .one_half  {padding:10px 0 !important; border-left:none; border-right:none;}
	.homerecent .recentimage{border:none !important; padding:0 !important; width:100%;  margin:0px auto !important; height:auto;}
	.recentmore {top:5px; float:none;}
	.homerecent{margin-top:0;}
	.homerecent h3{width:100% !important;text-align:center;}
	.top-nav li{padding-right:15px;}
	.boxdescwraper ,.boxImage{float:none; display:inline-block;}
	.boxdescwraper {top:-15px !important;}
	.sliderAdvertisePost .recentdescription h3 {margin-top:20px}
	.homerecent .recentdescriptionPort {width:100%;}
	.homerecent .star-rating{float:none !important; margin:0 auto !important;}
	.homerecent .recentdescription .star-rating, .homerecent .recentdescription .shortDescription { margin-left:0;}
	.homerecent .recentdescription {margin:0 0 5px 0;}
	.homerecent .productIframe.full {width:99%; margin-bottom:7px;}
	.homerecent .image img { width:auto;}
	.homerecent.post h3 {margin:0px 0 10px 5px !important}
	.homerecent .sliderAdvertisePost .image img {padding:0;}
	.homerecent.productRH .recentdescription h3 {font-size:24px !important;}
	.pagenav {height:0;}
	.homerecent h3{margin-left:5px !important;}
	.portsingle.home ,.post.home {padding:5px;}
	.closeajax{margin-left:5px;}
	.closeajax.port i{margin:0px;}	
	.homerecent .recentimage:hover img{
		-webkit-transform: scale(1) rotate(0deg);
		-moz-transform: scale(1) rotate(0deg);
		-ms-transform: scale(1) rotate(0deg);
		-o-transform: scale(1) rotate(0deg);
        transform: scale(1) rotate(0deg);
	}

	/*advertiset*/
	.advertise img, .advertise a{float:none;}
	.advertise {background: url(images/mainBorderLine.png) top repeat-x; margin-top:0;}
	.advertise .title{margin:30px 0 10px 0;}
	 
	 /*bxslider*/
	.bx-viewport{height:auto !important;}
	.post-full-width .bx-viewport {overflow:visible !important;}
	.bx-viewport ul{list-style:none;}
	.bx-viewport li{float:left; list-style:none; width:100%;}


	/*blog*/
	audio {width: 90%;}
	.blogpostcategory .meta,.blogpostcategory p{text-align:left;}
	.content{width:100%;}
	.blogpostcategory{width:98%; margin:0 auto 40px 0; float:none;display: inline-block;}
	.socialsingle .emaillink{height:0;}
	.blog .wp-pagenavi {margin-top:20px;}
	.blogpostcategory .overdefultlink {display:none !important;}
	#slider-category .slider-item img {height:98% !important; width:100% !important;}
	.anythingBase .panel {background:none !important;}
	.portfolio .description{margin-top:10px;}
	.blogimage img{width:97%; height:auto !important;}
	.blogpostcategory .blogimage {min-height:0 !important;}
	.blogpostcategory iframe{height:auto !important}
	#slider-category, .blogFullWidth #slider-category {width: 92.5% !important;height:auto !important; padding-bottom:0px !important;}
	#slider-category img, .blogFullWidth #slider-category img {width: 100% !important; height:auto !important;	padding-bottom:0px !important;}
	#slider-category .anythingSlider, .blogFullWidth #slider-category .anythingSlider {	padding-bottom:5px !important;}
	.blogpostcategory .meta {margin-left:5px;width:85.5%;}
	.infotext-button{float:right; width:15%; margin-top:15px;}
	.item3 .shortDescription {padding:0 !important; width:95% !important;}
	.item3 img {text-align:center !important;}
	.item3 {height:525px !important;}


	/*single*/
	.singledefult h1, .singledefult h2, .singledefult h3{text-align:left;}
	.blogpost{width:98%; margin:0 auto;}
	.singledefult .tags{text-align:center;}
	.blogpost .author{margin-left:0px ;}
	.postcontent.singledefult {background:none; margin-bottom:20px;}
	.posttext img {width: 97%;}
	
	.projectdetails #slider img{width:100%;}
	.projectdetails .blogsingleimage{padding:0;}
	.leftContentSP .images.imagesSP {border:none; background:none;}



	/*comment*/
	#commentform #respond #commentform textarea, #commentform #respond #commentform input{width:93%;margin-left: 10px; padding-right: 0; margin-right: 0; padding-left: 0;}
	#commentform #respond #commentform label {margin-left: 10px;}
	#commentform{width:93%; margin:0 auto;}
	#commentform #respond {padding:0;}
	.commentfield{float:none; text-align:left;}
	.commentlist .commenttext {width: 75%;text-align: left;padding:15px 10px 0 15px;}
	.comment-author{text-align:left;padding:0px 10px 0 0px;}



	/*team*/
	.one_third.team {background:none; padding-top:0px;}
	.team{margin-right:0;}
	.team .image{float:none; display:inline-block;}

	/*general*/
	.stock {padding-right:10px;}
	.recentimage .image{background:none !important;}
	.recentimage{overflow:hidden;width:95% !important; float:none !important; margin-left:0 !important;padding-left:0 !important; display: inline-block;}
	.recentimage .image{padding:5px 0 0 0 !important}	
	.homerecent .one_fourth, .homerecent .one_third {margin-bottom:15px;}

	h1,h2,h3,h4,h5,h6{margin-left:0 !important; margin-right:0 !important;}
	img {height: auto; }
	#main, .homerecent .recentdescription, .footer_widget1, .footer_widget2, .footer_widget3, .footer_widget4{padding:0 !important;}

	 .menu li li ,#remove , .titleborder,.footernav, .sidebar,.related,.editlink, .share-post-title, .advertise, .homerecent.SP,#footer .star-rating ,.shareBlog,
	.totop,.overdefult, .loading, .outerpagewrap.error404,.bx-prev,.bx-next,.homeIcon,#nslider,#nslidert.homerecent .category,.slider-wrapper, #nslider-wrapper, #slider-wrapper, .homePostComments,
	.blogsingleimage .nextbutton.port, .blogsingleimage .prevbutton.port,.nivoSlidert,.relatedtitle,.portfolio .category, .blogsingleimage .nextbutton.port, .blogsingleimage .prevbutton.port,.bottomborder,.header-shop,.categorytopbar,
	.infotext h2 span,	.outerpagewrap .portnavigation ,.top-nav ul,.infotext-widget,.item4 .portCategory, .portCategory,.infotext-title-small,.pagenav-top-border,.postcontent.post .blogsingleimage,
	.recentdescription .onsale, .leftContentSP .images.imagesSP, .leftContentSP #slider, .leftContentSP .anythingBase .panel, .leftContentSP .imagesSPAll #slider img{
		display:none !important;
	}
	.imagesSPAll {min-height:100px;}

	.leftContentSP .images.imagesSP {display: block !important;max-width: 100% !important; height: auto !important;}
	
	#header, .main ,#showpost  ,.homerecent ,.pagenav,.bx-wrapper,.homerecent,.homerecent .one_half ,.totop, .infotext ,.infotextwrap, #footerinside, .one_half,.footernav,#footerb ,
	.footer_widget1, .footer_widget2, .footer_widget3, .footer_widget4,.pagecontent, .portfolio,.wp-pagenavi,.image ,.pagecontentContent,#portitems2 h3,.leftContentSP .thumbnails,
	.one_fourth, .one_fifth,.three_fourths,.one_fourths,.two_thirds,.one_third,.team .social,.item3,.item4 ,.leftContentSP ,.rightContentSP, .imagesSPAll,.top-nav ,#respond #commentform input,
	#respond #commentform textarea ,.boxDescription,.footer_widget .widget_search form div,.infotext h1, .projectdescription .posttext,.homerecent .one_fourth,.pagecontentContent, object,.one_fourth, 
	.infotextBorder,.widgett,.homerecent .productF .recentimage, .homerecent .productR .recentimage,.holder-fixedmenu,.homerecentInner,.post-full-width-inner,
	.post.home .content .singledefult .sentry,.header-inner, .homerecent.shopSidebar{
		width:100% !important;
	}
	.projectdescription .posttext {width:98% !important;}
	
	.pagenav{position:relative; margin:0;}
	.shortDescription {padding:0; margin:0 !important; min-height: 115px;}
	.shopSidebar .one_fourth{margin-right:0;}
	.homerecent .one_fourth.last {margin-right:1% !important;}
	.homerecent li div:nth-child(even) {margin-right:0% }
	.shortDescription {font-size: 12px;}

	.borderLine {width:95% !important;}
	.borderLineRight{width:88% !important;}
	.borderLineLeft{width:10% !important;}
	.image .loading{text-align:center; width:100%;}
	
	.wp-pagenavi{padding:0 !important; }
	.posttext{text-align:left !important}
	.posttext .blogsingleimage,.gallery-single {width:100%;}
	.blogsingleimage iframe{width: 98%;}
	.block .h2{font-size:14px !important;}


	/*port*/
	.portfolio h3, .portfolio h4{text-align:center !important; margin-top: 10px;}
	#portitems4{text-align:center;margin:0 auto;}
	.portfolio{margin: 0 auto; display: inline-block;}
	.item4 h4 a{float:none; margin-top:10px; margin-bottom:20px; border:none; color:#2a2b2c;}
	.portsingle .portfolio, .portsingleshare,.titleborderh{display:none !important;}
	.blogsingleimage .sentry img, .projectdetails .blogsingleimage,.projectdetails,.projectdescription ,.blogpost .datecomment {width: 100% !important;}
	.projectdescription  p {text-align:left; padding:0;}
	.projectdescription {padding:0 0px 0 5px; margin-bottom: 30px;}
	.projectdescription h2{text-align:left;}
	.item4 h4 a {text-shadow:none !important;}
	#portitems2 .recentdescription .description {padding:0px 10px 10px 0px;}
	.item2 .image {background:#fff !important;}
	
	.item4 img{padding:0;}
	
	/*page*/
	.fullwidth{margin-top:0px;}
	.posttext {padding:0 5px;}
	.page .socialsingle {padding-left:5px;}
	#slider img{float: left; }


	/*shortcode*/
	.one_half, .one_third, .two_thirds, .one_fourth, .three_fourths, .one_fifth, .two_fifth, .three_fifths, .four_fifths {margin-top:10px; margin-right:0px;}

	.question h3, .success h3, .info h3, .error h3 {line-height:120%;}
	.rightContentSP .review-top-stars, .rightContentSP .amount, .rightContentSP .quantity-text {padding-left:10px !important;}



	#mainwrap{width:98.7% !important;padding-left:2px;}
}

/*479*/
@media screen and (min-width:460px) and (max-width:1180px){

	/*header*/
	.searchTop {margin-top:0px !important; }
	.searchTop #keyword{margin:0;}	
	.top-nav ul {margin-left:0px;} 
	.socialTop{float:left; margin-left:5px;}
	.searchTop{float:right; margin-top:0;}	
	.socialTopContainer{margin:10px auto;}
	
	/*footer*/
	#footer .widget{width:99%; margin:2px;}
	.gototop {margin:-25px 0px 0px 90% !important}

	/*team*/
	.team .image img {width:240px;}



	/*single*/
	.blogpost{width:98%; margin:0 auto 50px auto;}

	/*portfolio*/
	#portitems3  h3,#portitems3  h4{text-align:center !important;}
	#portitems2 .recentdescription {width:100% !important; min-height:125px;}




	.homerecent .one_fourth {width: 48.5% !important;text-align: center;margin: 0.3% auto; margin-left: 0.6%;}

	/*port*/
	.one_half.item2{width:47% !important; float:left; margin-right:0; margin-left:2%;}
	.one_half.item2 img{width: 100%; height:150px;}
	#portitems2 .one_half{margin-right:0 !important}
	.item3{float:left; margin-right:0; margin-left:2% !important; padding:0;}

	.item4{width:46% !important; float:left; margin-right:0; margin-left:2%;}


	.one_third.team {width:47% !important; float:left; margin-right:0; margin-left:2%;}

	.homerecent .one_third, .item3{width: 47.2% !important; float: left;padding-top:5px; margin-left:1%; margin-right:1%;}
	.homerecent .one_third.last{display:none;}

	.homerecent .one_fourth{width: 47.2% !important; float: left;padding-top:5px; margin-left:1%; margin-right:1%;}


}


@media screen and (min-width:490px) and (max-width:600px){
	.blogpostcategory .meta {width:80%;}


}

@media screen and (min-width:480px) and (max-width:715px){
	 .bx-wrapper img{width:100%;}
	
}

@media screen and (min-width:481px) and (max-width:1180px){
	 .shortDescription {min-height:68px;}
	 .blogpostcategory iframe{width: 98%;}

}

@media screen and (max-width:960px){
	.aq-block-aq_contact_block textarea {padding:0px !important;}
	.aq-block-aq_googlemap_block {height:200px !important;}
	.post-full-width {padding:0px 0 20px 0;}
	.featured-block {margin: 20px 0 20px 0;}
	.share-post-icon {float:none;}
	.topNotification div{margin-right:10px;}
	#searchsubmit {display:none;}
	.breadcrumb-info{display:inline-block; float:none;}
	.aq-template-wrapper .aq_span1,.aq-template-wrapper .aq_span2,.aq-template-wrapper .aq_span3,.aq-template-wrapper .aq_span4,.aq-template-wrapper .aq_span5,.aq-template-wrapper .aq_span6,
	.aq-template-wrapper .aq_span7,.aq-template-wrapper .aq_span8,.aq-template-wrapper .aq_span9,.aq-template-wrapper .aq_span10,.aq-template-wrapper .aq_span11,.aq-template-wrapper .aq_span12{width:100%;  }
	.testimonial-description{width:auto;}
	.testimonial-description:before{content:none;}
	/*top footer*/
	.footer-top-wrapper{height:100%;}
	.footer-top-wrapper div{padding:0;}
	.footer-top-wrapper {width:100%; border-top:2px solid #d9d9d9; border-bottom:3px solid #d9d9d9;float:left}
	.footer-top {width: 99%; margin:0 auto;height: 100%;border-bottom: 1px solid #ddd;}
	.footer-top-social-text {width: 100%;overflow: hidden;float:left; height:100%;    color:#fff;border-bottom: 1px solid #ddd;}
	.footer-top-social-text h4, .footer-top-search-text h4{font-size:22px !important; padding-top:10px; margin:0; color:#fff}
	.footer-top-social-text p,.footer-top-search-text p{font-size:14px;margin-top:-3px;}
	.footer-top-social-icons {   height:100%;width: 100%;border-bottom: 1px solid #ddd;text-align: center;display: inline-block;margin: 0 auto;}
	.footer-top-social-icons .socialcategory {padding-top:10px;text-align: center;margin: 0 auto;display: inline-block;}
	.footer-top-search-text {width: 100%;overflow: hidden;float:left; height:100%;   color:#fff;border-bottom: 1px solid #ddd;}
	.footer-top-search-field{ height:100%;   margin: 0px 0px 10px 0;display: inline-block; float:none;}
	.footer-top-search-field form {padding-top:10px;}
	#sidebarsearch   input {background:none;outline:none;border:2px solid #fff;border-radius:8px;height:26px;width:270px;color:#fff;}
	#sidebarsearch input#searchsubmit {height:40px;width:40px;background:#fff url(images/searchIconMagnifying.png)no-repeat 8px 7px;margin-left:-16px;}
	.specificComment{width:100%;}
	.comment .blogAuthor{display:none;}
	.authorBlogName{text-align:left;}
	.commentlist .commenttext{padding:0; margin:0; width:95%;}
	.socialfooter{float:left;width:100%; margin-bottom:15px;}
	.socialfooter .socialcategory {margin:-10px 0 0 0px;}
	.socialfooter h3{margin-top:15px;}	
	[class*="aq_span"] {margin-left:0;}
}

@media screen and (min-width:960px) and (max-width:1180px){
	.footer-top{width:100%;}
	.footer-top-search-text {display:none;}
	.footer-top-search-field{float: left; height:100%;   padding: 0 20px;}
	.item4{width:31% !important;}
	.one_half.item2{width:35% !important;}
}


@media screen and (max-width:515px){
	 
	.top-mail{display:none;}
	.aq_block_faq h2{width:79%;}
	

	.blogpostcategory iframe {width: 92.5% !important;}
	#slider-category, .blogFullWidth #slider-category {width: 92.5% !important;height:auto !important; padding-bottom:0px !important;}
	#slider-category img, .blogFullWidth #slider-category img {width: 100% !important; height:auto !important;	padding-bottom:0px !important;}
	#slider-category .anythingSlider, .blogFullWidth #slider-category .anythingSlider {	padding-bottom:5px !important;}

	/*single*/
	.leftholder,.addthis_button,.commenttitle,#commentform h3{display:none;}
	.singledefult .sentry,.singledefult .meta,#respond {width:100%;}
	.specificComment{margin:10px 0px 0px 0px;}
	.tags {margin-left:0; width:100%;}


	.tabs li{width:100%; float:left}
	ul.tabs a {padding:10px 0;}
	.tabs li h2{float:left; display:block; text-align:left;}


	/*account woo*/
	.order-shipto,.order-total{display:none;}
	
	/*woo category*/
	.categorytopbar{display:none;}
	

}

@media screen and (min-width:580px) and (max-width:1180px){
	.homerecent .one_half  {width: 48.0% !important; !important;margin:0 !important; margin-right:1.3% !important;}
	.homerecent .one_half .recentimage  {float:none; !important;}		
	.aq-posts-block .descriptionholder{text-align:left;}
	.item2 .recentdescription {margin-top:60px}
	.item4 img,.item2 img{height:200px !important;}
	.footer_widget1, .footer_widget2, .footer_widget3, .footer_widget4{width:48% !important; margin-right:0; }
	.footer_widget1, .footer_widget3{margin-right:4%;}
	.item3{width:45% !important;}
	


}

@media screen and (max-width:599px){
	ul.tabs a {width:99% !important;}
	.rightContentSP .single_variation {float:left!important;margin-left:10px;}
	.variations_button, .single_add_to_cart_button button {width:100% !important;}
	.rightContentSP .single_add_to_cart_button {width:100% !important;}
	.review-top-stock ,.review-top-stars ,.review-top-number-rating {font-size:13px;}
	 table.shop_table  .product-thumbnail {display:none !important;}
	.aq-block-aq_contact_block {margin-left:10px !important;}
	 
	.shopSidebar .recentimage {width:100% !important; padding-top: 10px;}
	.top-nav ul{display:none;}
	.homerecent h3{width:60%; height:20px}
	
	.share-post {margin-left:10px;}
	/*portfolio*/
	#portitems2 h3 {min-height:35px; }
	
	
	.infotext-title {width:100%;  overflow: hidden;}
	.infotext-button{display:none;}
	.infotext h2{float:none;}
	#logo img{width:80%;}
	.aq-posts-block .descriptionholder{text-align:center;}
	.aq-posts-block .imgholder{display:none;}
	
}

@media screen and (max-width:478px){
	.woocommerce-breadcrumb {font-size:13px;}
	table.shop_table  .product-thumbnail,  table.shop_table  .product-price {display:none !important;}
	 table.shop_table td, table.shop_table th {padding:3px !important}
	 .carButtons .checkout-button {margin-top:5px;}
	#portitems2 .image, #portitems2 .image img {float:none;}
	/*home recent port*/
	.infotext-title-small{display:none;}
	.recentdescription h3{text-align:center;}
	.recentimage, .recentdescription {width:100% !important; padding-top: 10px;}
	.recentdescription {padding-top: 0px;}
	.item4 .image {height:160px;}
	.respMenu{float:none;}
	.logo-fixedmenu{display:none;}

	.descriptionholder {width:100%;margin-left:0 !important;}
	.aq-block-aq_posts_block .imgholder {float:none !important;}	

	/*footer*/
	#footer .widget{width:98%; margin-left:2px;}
	.gototop {margin:-25px 0px 0px 80% !important}


	/*team*/
	.one_third.team {width:100%;}

	/*blog*/
	.blogpostcategory .leftholder{display:none;}
	.blogpostcategory .meta {width:100%; margin:0 auto;margin-left:5px;}
	.blogpostcategory .blogmore{width: 100%;float: right !important;text-align: left;}
	.blogpostcategory .meta .socialsingle{width:50%;}
	.comment-author, .commentlist .commenttext{width:90% !important; text-align:left !important;padding:0px 10px 0 0px;}
	.commentlist .avatar {width:100%; float:none;background:none;}



	/*single*/
	.singledefult .socialsingle{padding-left:0;}


	/*shortcode*/
	ul.tabs a{width: 99%; text-align: center; padding:15px 0; }
	ul.tabs li{float:none;}

}

@media screen and (max-width:295px){
	/*team*/
	.team .image img {width:220px;}
	.textwidget img{max-width:95%;}
	.socialfooter .socialcategory{width:215px; float:none; margin:0 auto; display: inline-block;}
	.recentdescription .shortDescription{width:80%;}
	.respMenu select{width:85%;}
	.socialTopContainer a ,.socialcategory a{width:13px !important; height:13px !important; }
	.top-time{display:none;}
	.item3{}
}


@media screen and (min-width:560px) and (max-width:1180px){
	/*blog*/
	.link-category .blogpostcategory{margin:0 auto 50px auto;}
	.posttext {width:600px; margin:0 auto;}
	.blogpostcategory .comment-inside .addthis_button {margin-left: -10px;}

	/*single*/
	.singledefult .author{margin-left:450px;}
	#commentform {float:none}
	.commentlist,#commentform{width: 100%;text-align: center;margin: 20px auto !important;text-align:center;}
	form#commentform{width:100%;}
	.singledefult .blogpost{width:100% !important; margin:0 auto;}
	#respond{width:85%;}

	/*comment*/

	#commentform{width:100%; margin:0 auto;}

	.homerecent.post h3{}


}

@media screen and (min-width:599px) and (max-width:1180px){
	/*homeRecent*/
	.homerecent.post .recentimage{width:auto;}
	.homerecent .one_third{width:47.0% !important; }
	 
	.item3 {width:45.0% !important; }
	.homerecent .one_third.last{margin-right:1.4% }
	.homerecent .sliderAdvertisePost li div:nth-child(even) {margin-right:0% }

}



@media screen and (min-width:700px) and (max-width:1180px){
	.recentdescription .description {text-align:left;padding-left:20px !important;}
	#portitems2 .recentdescription {padding-left:0%;}
	.homerecent.post .recentdescription{width:100%;}
	.blogpostcategory{width:600px; margin:0 auto 40px auto;}
	.aq-template-wrapper .aq_span3, .aq-template-wrapper .aq_span4, .aq-template-wrapper .aq_span5, .aq-template-wrapper .aq_span6, .aq-template-wrapper .aq_span7, .aq-template-wrapper .aq_span8{text-align:left; margin-left:0.5%}
}

@media screen and (min-width:700px) and (max-width:1180px){
	/*home recent port*/
	
	.recentdescription .descrpiton {text-align:left !important; padding-right: 5px;}


	.advertise .bx-next{margin-left:940px;}
	.advertise .bx-prev{margin-left:0;}
}



@media screen and (min-width:768px){
	/*shortcode*/
	.one_half { width: 48% }
	.one_third { width: 30% }
	.two_thirds { width: 65.33% }
	.one_fourth { width: 22% ; }
	.three_fourths { width: 74% }
	.one_fifth { width: 16.8% }
	.four_fifths { width: 79.2% }
}


@media
only screen
and (min-device-width : 320px)
and (max-device-width : 480px)
and (orientation : portrait)
and (-webkit-min-device-pixel-ratio : 2) {
/* Styles */
	 #logo img {width:50%}
	 .recentdescription .aq-posts-block-meta, .recentdescription .the_excerpt,
	 .aq-template-wrapper .aq_span6 .aq_span6	{margin-left:10px !important;}
	  .post-full-width {padding:0px 0 0px 0 !important;}
	 .testimonial-avatar {margin-right:0px !important;}
	 .testimonial-avatar img {margin-right:10px !important;}
	 .testimonial-description {width:90% !important; padding:10px !important;}
	#footerbwrap {height:75px; text-align:center;}
	.testimonial-borderLine {margin-left:10px !important;}
	.blogpost .projectdescription .datecomment, .single-portfolio-skils  {width:90% !important;}
}

@media
only screen
and (min-device-width : 320px)
and (max-device-width : 480px)
and (orientation : landscape)
and (-webkit-min-device-pixel-ratio : 2) {
/* Styles */
	
	.logo-fixedmenu {display:none !important;}
	.homerecent .one_third{width: 100% !important;} 
	
	.item3 {width:100% !important;}
	.item3 .recentimage, .item3 .recentdescription {width:80% !important;}
	 #logo img {width:40%}
	 .recentdescription .aq-posts-block-meta, .recentdescription .the_excerpt,
	 .aq-template-wrapper .aq_span6 .aq_span6, .aq-posts-block h3	{margin-left:10px !important;}
	  
	  .testimonial-avatar {margin-right:0px !important;}
	  .testimonial-avatar img {margin-right:10px !important;}
	  #footerbwrap {height:75px; text-align:center;}
	  .blogpost .projectdescription .datecomment, .single-portfolio-skils  {width:90% !important;}
	   .post-full-width {padding:0px 0 20px 0 !important;}
}

@media only screen and (device-width: 768px) {
  /* For general iPad layouts */
   
  
}

@media only screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape) {
  /* For portrait layouts only */
  
  	.menu > li {height:auto;padding-bottom:30px;float:left !important}
  .pagenav{text-align:center !important; float:right; width:100% !important;margin-bottom:62px !important; margin-right:0px !important;}
  .menu {margin-top:0px;display: block !important; float:right !important;}
  .menu {  width:100% !important;text-align:center !mportant; }
  .fixedmenu .menu {width:100%;margin-top:0px;margin-right:20px;}
  .menu li li {display:block !important; }
  .respMenu { display:none!important; }
  #logo { margin-top:30px;text-align:left;  width:100%;  text-align:center; }
	.menu .pmcbig ul.sub-menu li, .menu .pmcbig ul.sub-menu li ul {max-width:135px;}
 
.menu .current-menu-ancestor.has-sub-menu:before {display:none;}

}

<?php } ?>

/* ***********************
--------------------------------------
------------CUSTOM CSS----------
--------------------------------------
*********************** */

<?php echo pmc_stripText($pmc_data['custom_style']) ?>