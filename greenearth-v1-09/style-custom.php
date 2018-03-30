<?php
	/*	
	*	Goodlayers Custom Style File (style-custom.php)
	*	---------------------------------------------------------------------
	*	This file fetch all style options in admin panel to generate the css
	*	to attach to header.php file
	*	---------------------------------------------------------------------
	*/
	
	header("Content-type: text/css;");
	
	$current_url = dirname(__FILE__);
	$wp_content_pos = strpos($current_url, 'wp-content');
	$wp_content = substr($current_url, 0, $wp_content_pos);

	require_once($wp_content . 'wp-load.php');	
?>
/* Logo / Navigation
   ================================= */
.logo-wrapper{ 
	margin-top: <?php echo get_option(THEME_SHORT_NAME . "_logo_top_margin", '15'); ?>px;
	margin-left: <?php echo get_option(THEME_SHORT_NAME . "_logo_left_margin", '25'); ?>px;
	margin-bottom: <?php echo get_option(THEME_SHORT_NAME . "_logo_bottom_margin", '12'); ?>px;
}  
.main-navigation-wrapper{ 
	margin-top: <?php echo get_option(THEME_SHORT_NAME . "_navigation_top_margin", '13'); ?>px;
	margin-right: <?php echo get_option(THEME_SHORT_NAME . "_navigation_right_margin", '25'); ?>px;
} 
  
/* Social Network
   ================================= */
.social-icon-wrapper{
	bottom: <?php echo get_option(THEME_SHORT_NAME . "_social_wrapper_bottom", '27'); ?>px;
}
   
/* Font Size
   ================================= */
h1{
	font-size: <?php echo get_option(THEME_SHORT_NAME . "_h1_size", '30'); ?>px;
}
h2{
	font-size: <?php echo get_option(THEME_SHORT_NAME . "_h2_size", '25'); ?>px;
}
h3{
	font-size: <?php echo get_option(THEME_SHORT_NAME . "_h3_size", '20'); ?>px;
}
h4{
	font-size: <?php echo get_option(THEME_SHORT_NAME . "_h4_size", '18'); ?>px;
}
h5{
	font-size: <?php echo get_option(THEME_SHORT_NAME . "_h5_size", '16'); ?>px;
}
h6{
	font-size: <?php echo get_option(THEME_SHORT_NAME . "_h6_size", '15'); ?>px;
}

/* Element Color
   ================================= */
   
html{
	background-color: <?php echo get_option(THEME_SHORT_NAME . "_body_background", '#ffffff'); ?>;
}
div.divider{
	border-color: <?php echo get_option(THEME_SHORT_NAME . "_divider_line", '#ececec'); ?>;
}

/* Font Family 
  ================================= */
body{
	font-family: <?php echo substr(get_option(THEME_SHORT_NAME . "_content_font"), 2); ?>;
}
.gdl-slider-font{
	font-family: <?php echo substr(get_option(THEME_SHORT_NAME . "_slider_font"), 2); ?>;
}
h1, h2, h3, h4, h5, h6, .gdl-title{
	font-family: <?php echo substr(get_option(THEME_SHORT_NAME . "_header_font"), 2); ?>;
}
h1.stunning-text-title{
	font-family: <?php echo substr(get_option(THEME_SHORT_NAME . "_stunning_text_font"), 2); ?>;
	color: <?php echo get_option(THEME_SHORT_NAME . "_stunning_text_title_color", '#333333'); ?>;
}
.stunning-text-caption{
	color: <?php echo get_option(THEME_SHORT_NAME . "_stunning_text_caption_color", '#666666'); ?>;
}
.stunning-text-caption span{
	<?php $caption_bg = get_option(THEME_SHORT_NAME . "_stunning_text_caption_background", '#f3f3f3'); ?>;
	background: <?php echo $caption_bg ?>;
	
	-moz-box-shadow: 15px 0 0 <?php echo $caption_bg ?>, -15px 0 0 <?php echo $caption_bg ?>;
	-webkit-box-shadow: 15px 0 0 <?php echo $caption_bg ?>, -15px 0 0 <?php echo $caption_bg ?>;
	box-shadow: 15px 0 0 <?php echo $caption_bg ?>, -15px 0 0 <?php echo $caption_bg ?>;
}

.gdl-page-caption{
	font-family: <?php echo substr(get_option(THEME_SHORT_NAME . "_header_font"), 2); ?>;
}


/* Font Color
   ================================= */
body{
	color: <?php echo get_option(THEME_SHORT_NAME . "_content_color", '#777777'); ?> !important;
}
.footer-wrapper a{
	color: <?php echo get_option(THEME_SHORT_NAME . "_footer_link_color", '#ffffff'); ?>;
}
a{
	color: <?php echo get_option(THEME_SHORT_NAME . "_link_color", '#4f4f4f'); ?>;
}
.gdl-link-title{
	color: <?php echo get_option(THEME_SHORT_NAME . "_link_color", '#4f4f4f'); ?> !important;
}
a:hover{
	color: <?php echo get_option(THEME_SHORT_NAME . "_link_hover_color", '#8a8a8a'); ?>;
}
.footer-wrapper a:hover{
	color: <?php echo get_option(THEME_SHORT_NAME . "_footer_link_hover_color", '#cfcfcf'); ?>;
}
.gdl-slider-title{
	color: <?php echo get_option(THEME_SHORT_NAME . "_slider_title_color", '#ffffff'); ?> !important;
}  
.gdl-slider-caption, .nivo-caption{
	color: <?php echo get_option(THEME_SHORT_NAME . "_slider_caption_color", '#b5b5b5'); ?> !important;
}  
h1, h2, h3, h4, h5, h6, .title-color{
	color: <?php echo get_option(THEME_SHORT_NAME.'_title_color', '#494949'); ?>;
}
.header-title-wrapper{
	background-color: <?php echo get_option(THEME_SHORT_NAME . "_header_title_background", '#f3f3f3'); ?> !important;
}
.sidebar-title-color{
	color: <?php echo get_option(THEME_SHORT_NAME.'_sidebar_title_color', '#494949'); ?> !important;
}
.gdl-page-title{
	text-shadow: 1px 2px <?php echo get_option(THEME_SHORT_NAME.'_page_title_shadow', '#2b360e'); ?> !important;
	color: <?php echo get_option(THEME_SHORT_NAME.'_page_title_color', '#ffffff'); ?> !important;
}
.gdl-page-caption{
	color: <?php echo get_option(THEME_SHORT_NAME.'_page_caption_color', '#ffffff'); ?> !important;
}
.gdl-blog-info-title{
	color: <?php echo get_option(THEME_SHORT_NAME.'_post_title_color', '#1f1f1f'); ?> !important;
}

/* Post/Port Color
   ================================= */
   
.port-title-color,
.port-title-color a{
	color: <?php echo get_option(THEME_SHORT_NAME.'_port_title_color', '#303030'); ?> !important;
}
.port-title-color a:hover{
	color: <?php echo get_option(THEME_SHORT_NAME.'_port_title_hover_color', '#4d4d4d'); ?> !important;
}
ul#portfolio-item-filter{
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_port_filter_background', '#f5f5f5'); ?> !important;
}
ul#portfolio-item-filter,
ul#portfolio-item-filter a{
	color: <?php echo get_option(THEME_SHORT_NAME.'_port_filter_text', '#838383'); ?> !important;
}
ul#portfolio-item-filter a:hover{
	color: <?php echo get_option(THEME_SHORT_NAME.'_port_filter_text_hover', '#1c1c1c'); ?> !important;
}
ul#portfolio-item-filter a.active{
	color: <?php echo get_option(THEME_SHORT_NAME.'_port_filter_text_current', '#1c1c1c'); ?> !important;
}
.post-title-color{
	color: <?php echo get_option(THEME_SHORT_NAME.'_post_title_color', '#303030'); ?> !important;
}
.post-title-color a:hover{
	color: <?php echo get_option(THEME_SHORT_NAME.'_post_title_hover_color', '#4d4d4d'); ?> !important;
}
div.custom-sidebar #twitter_update_list, .blog-item0 .post-info-color a,
.post-info-color, div.custom-sidebar #twitter_update_list{
	color: <?php echo get_option(THEME_SHORT_NAME.'_post_info_color', '#7b7b7b'); ?> !important;
}

div.pagination a{ background-color: <?php echo get_option(THEME_SHORT_NAME.'_pagination_normal_state', '#f5f5f5'); ?>; }

.about-author-wrapper{
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_post_about_author_color', '#f9f9f9'); ?> !important;
}

/* Column Service
   ================================= */
h2.column-service-title{
	color: <?php echo get_option(THEME_SHORT_NAME.'_column_service_title_color', '#ef7f2c'); ?> !important;
}

/* Footer Color
   ================================= */
div.footer-wrapper-gimmick{
	background: <?php echo get_option(THEME_SHORT_NAME . "_footer_top_bar", '#43392b'); ?>;
}
.footer-widget-wrapper .custom-sidebar-title{ 
	color: <?php echo get_option(THEME_SHORT_NAME.'_footer_title_color', '#ffffff'); ?> !important;
}
.footer-wrapper{ 
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_footer_background', '#2f261a'); ?> !important;
}
.footer-wrapper .gdl-divider,
.footer-wrapper .custom-sidebar.gdl-divider div,
.footer-wrapper .custom-sidebar.gdl-divider ul li{
	border-color: <?php echo get_option(THEME_SHORT_NAME.'_footer_divider_color', '#3f362a'); ?> !important;
}
.footer-wrapper, .footer-wrapper table th{
	color: <?php echo get_option(THEME_SHORT_NAME.'_footer_content_color', '#cfc2ae'); ?> !important;
}
.footer-wrapper .post-info-color, .footer-wrapper div.custom-sidebar #twitter_update_list{
	color: <?php echo get_option(THEME_SHORT_NAME.'_footer_content_info_color', '#aba395'); ?> !important;
}
div.footer-wrapper div.contact-form-wrapper input[type="text"], 
div.footer-wrapper div.contact-form-wrapper input[type="password"], 
div.footer-wrapper div.contact-form-wrapper textarea, 
div.footer-wrapper div.custom-sidebar #search-text input[type="text"], 
div.footer-wrapper div.custom-sidebar .contact-widget-whole input, 
div.footer-wrapper div.custom-sidebar .contact-widget-whole textarea {
	color: <?php echo get_option(THEME_SHORT_NAME.'_footer_input_text', '#ccc2b6'); ?> !important; 
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_footer_input_background', '#362d20'); ?> !important;
	border: 1px solid <?php echo get_option(THEME_SHORT_NAME.'_footer_input_border', '#362d20'); ?> !important;
}
div.footer-wrapper a.button, div.footer-wrapper button, div.footer-wrapper button:hover {
	color: <?php echo get_option(THEME_SHORT_NAME.'_footer_button_text', '#8f8982'); ?> !important; 
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_footer_button_color', '#423626'); ?> !important;
}
div.copyright-wrapper{ 
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_copyright_background', '#1f1911'); ?> !important; 
	color: <?php echo get_option(THEME_SHORT_NAME.'_copyright_text', '#808080'); ?> !important;
}

/* Twitter
   ================================= */
.twitter-content, .twitter-content a{ 
	color: <?php echo get_option(THEME_SHORT_NAME.'_twitter_item_content', '#898989'); ?> !important;
}
.twitter-date{
	color: <?php echo get_option(THEME_SHORT_NAME.'_twitter_item_date', '#464646'); ?> !important;
}
/* Divider Color
   ================================= */
.scroll-top{ 
	color: <?php echo get_option(THEME_SHORT_NAME.'_back_to_top_text_color', '#7c7c7c'); ?> !important;
}
.gdl-divider,
.custom-sidebar.gdl-divider div,
.custom-sidebar.gdl-divider .custom-sidebar-title,
.custom-sidebar.gdl-divider ul li{
	border-color: <?php echo get_option(THEME_SHORT_NAME . "_divider_line", '#ececec'); ?> !important;
}
table th{
	color: <?php echo get_option(THEME_SHORT_NAME.'_table_text_title', '#666666'); ?>;
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_table_title_background', '#f7f7f7'); ?>;
}
table, table tr, table tr td, table tr th{
	border-color: <?php echo get_option(THEME_SHORT_NAME . "_table_border", '#e5e5e5'); ?>;
}

/* Testimonial Color
   ================================= */
.testimonial-content{
	color: <?php echo get_option(THEME_SHORT_NAME.'_testimonial_text', '#aaaaaa'); ?> !important;
}
.testimonial-author-name{
	color: <?php echo get_option(THEME_SHORT_NAME.'_testimonial_author', '#000000'); ?> !important;
}
.testimonial-author-position{
	color: <?php echo get_option(THEME_SHORT_NAME.'_testimonial_position', '#7f7f7f'); ?> !important;
}

/* Tabs Color
   ================================= */
<?php $gdl_tab_border = get_option(THEME_SHORT_NAME.'_tab_border_color', '#dddddd'); ?>
ul.tabs{
	border-color: <?php echo $gdl_tab_border; ?> !important;
}
ul.tabs li a {
	color: <?php echo get_option(THEME_SHORT_NAME.'_tab_text_color', '#666666'); ?> !important;
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_tab_background_color', '#f5f5f5'); ?> !important;
	border-color: <?php echo $gdl_tab_border; ?> !important;
}
ul.tabs li a.active {
	color: <?php echo get_option(THEME_SHORT_NAME.'_tab_active_text_color', '#111111'); ?> !important;
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_tab_active_background_color', '#fff'); ?> !important;
}

/* Featured Media
   ================================= */
h3.feature-media-title{ 
	color: <?php echo get_option(THEME_SHORT_NAME.'_featured_media_title', '#202020'); ?> !important;
}
div.feature-media-caption{ 
	color: <?php echo get_option(THEME_SHORT_NAME.'_featured_media_caption', '#858585'); ?> !important;
}   
div.feature-media-content{ 
	color: <?php echo get_option(THEME_SHORT_NAME.'_featured_media_content', '#828282'); ?> !important;
}   

/* Header Color
   ================================= */
div.header-bottom-bar.slider-off{
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_header_bottom_line', '#43392b'); ?>;
}  
div.bottom-slider-top-bar,
div.header-bottom-bar{
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_top_slider_bottom_line', '#43392b'); ?>;
}   
div.bottom-slider-wrapper{
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_under_slider_background', '#2d2418'); ?>;
}   
div.bottom-slider-wrapper h1, div.bottom-slider-wrapper h2, div.bottom-slider-wrapper h3,
div.bottom-slider-wrapper h4, div.bottom-slider-wrapper h5, div.bottom-slider-wrapper h6{
	color: <?php echo get_option(THEME_SHORT_NAME.'_under_slider_title', '#ffffff'); ?>;
}
div.bottom-slider-wrapper{
	color: <?php echo get_option(THEME_SHORT_NAME.'_under_slider_cotent', '#b5ab9e'); ?>;
}
div.bottom-slider-wrapper a{
	color: <?php echo get_option(THEME_SHORT_NAME.'_under_slider_link', '#ffffff'); ?>;
}
div.bottom-slider-wrapper a:hover{
	color: <?php echo get_option(THEME_SHORT_NAME.'_under_slider_link_hover', '#ffffff'); ?>;
}
/* Navigation Color
   ================================= */
.navigation-wrapper .sf-menu li a{
	color: <?php echo get_option(THEME_SHORT_NAME.'_main_navigation_text', '#ffffff'); ?> !important;
}
.navigation-wrapper .sf-menu ul a,
.navigation-wrapper .sf-menu .current-menu-ancestor ul a,
.navigation-wrapper .sf-menu .current-menu-item ul a{
	color: <?php echo get_option(THEME_SHORT_NAME.'_sub_navigation_text', '#e6e6e6'); ?> !important;
}
.navigation-wrapper .sf-menu ul a:focus,
.navigation-wrapper .sf-menu ul a:active,
.navigation-wrapper .sf-menu ul a:hover,
.navigation-wrapper .sf-menu .current-menu-item ul a:focus,
.navigation-wrapper .sf-menu .current-menu-item ul a:active,
.navigation-wrapper .sf-menu .current-menu-item ul a:hover{
	color: <?php echo get_option(THEME_SHORT_NAME.'_sub_navigation_text_hover', '#999999'); ?> !important;
}
.navigation-wrapper .sf-menu a:focus, 
.navigation-wrapper .sf-menu a:hover, 
.navigation-wrapper .sf-menu a:active{
	color: <?php echo get_option(THEME_SHORT_NAME.'_main_navigation_text_hover', '#3d3d3d'); ?> !important;
} 
.navigation-wrapper .sf-menu .current-menu-ancestor a,
.navigation-wrapper .sf-menu .current-menu-item a {
	color: <?php echo get_option(THEME_SHORT_NAME.'_main_navigation_text_current', '#999999'); ?> !important;
}
.navigation-wrapper .sf-menu ul .current-menu-ancestor a,
.navigation-wrapper .sf-menu ul .current-menu-item a {
	color: <?php echo get_option(THEME_SHORT_NAME.'_sub_navigation_text_current', '#3d3d3d'); ?> !important;
}


/* Button Color
   ================================= */
<?php
	$gdl_button_color = get_option(THEME_SHORT_NAME.'_button_background_color', '#f1f1f1');
	$gdl_button_text = get_option(THEME_SHORT_NAME.'_button_text_color', '#7a7a7a');
	$gdl_button_hover = get_option(THEME_SHORT_NAME.'_button_text_hover_color', '#7a7a7a');
?>
a.button, button, input[type="submit"], input[type="reset"], input[type="button"],
a.gdl-button{
	background-color: <?php echo $gdl_button_color; ?>;
	color: <?php echo $gdl_button_text; ?>;
}

a.button:hover, button:hover, input[type="submit"]:hover, input[type="reset"]:hover, input[type="button"]:hover,
a.gdl-button:hover{
	color: <?php echo $gdl_button_hover; ?>;
}
   
/* Price Item
   ================================= */   
div.gdl-price-item .gdl-divider{ 
	border-color: <?php echo get_option(THEME_SHORT_NAME.'_price_item_border', '#ececec'); ?> !important;
}
div.gdl-price-item .price-title{
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_price_item_price_title_background', '#e9e9e9'); ?> !important;
	color: <?php echo get_option(THEME_SHORT_NAME.'_price_item_price_title_color', '#3a3a3a'); ?> !important;
}
div.gdl-price-item .price-item.active .price-title{ 
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_price_item_best_price_title_background', '#5f5f5f'); ?> !important;
	color: <?php echo get_option(THEME_SHORT_NAME.'_price_item_best_price_title_color', '#ffffff'); ?> !important;
}
div.gdl-price-item .price-tag{
	color: <?php echo get_option(THEME_SHORT_NAME.'_price_item_price_color', '#3a3a3a'); ?> !important;
}
div.gdl-price-item .price-item.active .price-tag{
	<?php $gdl_best_price_color = get_option(THEME_SHORT_NAME.'_price_item_best_price_color', '#ef7f2c'); ?>
	color: <?php echo $gdl_best_price_color; ?> !important;
}
div.gdl-price-item .price-item.active{
	border-top: 1px solid <?php echo $gdl_best_price_color; ?> !important;
}
/* Contact Form
   ================================= */
<?php
	$gdl_contact_form_frame = get_option(THEME_SHORT_NAME.'_contact_form_frame_color', '#f8f8f8');
	$gdl_contact_form_shadow = get_option(THEME_SHORT_NAME.'_contact_form_inner_shadow', '#ececec');
 ?>
div.contact-form-wrapper input[type="text"], 
div.contact-form-wrapper input[type="password"],
div.contact-form-wrapper textarea,
div.custom-sidebar #search-text input[type="text"],
div.custom-sidebar .contact-widget-whole input, 
div.comment-wrapper input[type="text"], input[type="password"], div.comment-wrapper textarea,
div.custom-sidebar .contact-widget-whole textarea,
span.wpcf7-form-control-wrap input[type="text"], 
span.wpcf7-form-control-wrap input[type="password"], 
span.wpcf7-form-control-wrap textarea{
	color: <?php echo get_option(THEME_SHORT_NAME.'_contact_form_text_color', '#888888'); ?>;
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_contact_form_background_color', '#fff'); ?>;
	border: 1px solid <?php echo get_option(THEME_SHORT_NAME.'_contact_form_border_color', '#cfcfcf'); ?>;

	-webkit-box-shadow: <?php echo $gdl_contact_form_shadow; ?> 0px 1px 4px inset, <?php echo $gdl_contact_form_frame; ?> -5px -5px 0px 0px, <?php echo $gdl_contact_form_frame; ?> 5px 5px 0px 0px, <?php echo $gdl_contact_form_frame; ?> 5px 0px 0px 0px, <?php echo $gdl_contact_form_frame; ?> 0px 5px 0px 0px, <?php echo $gdl_contact_form_frame; ?> 5px -5px 0px 0px, <?php echo $gdl_contact_form_frame; ?> -5px 5px 0px 0px;
	box-shadow: <?php echo $gdl_contact_form_shadow; ?> 0px 1px 4px inset, <?php echo $gdl_contact_form_frame; ?> -5px -5px 0px 0px, <?php echo $gdl_contact_form_frame; ?> 5px 5px 0px 0px, <?php echo $gdl_contact_form_frame; ?> 5px 0px 0px 0px, <?php echo $gdl_contact_form_frame; ?> 0px 5px 0px 0px, <?php echo $gdl_contact_form_frame; ?> 5px -5px 0px 0px, <?php echo $gdl_contact_form_frame; ?> -5px 5px 0px 0px;
}

/* Icon Type (dark/light)
   ================================= */
<?php global $gdl_icon_type; ?>

div.single-port-next-nav .right-arrow{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/arrow-right.png') no-repeat; }
div.single-port-prev-nav .left-arrow{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/arrow-left.png') no-repeat; }

div.single-thumbnail-author,
div.archive-wrapper .blog-item .blog-thumbnail-author,
div.blog-item-holder .blog-item1 .blog-thumbnail-author,
div.blog-item-holder .blog-item2 .blog-thumbnail-author{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/author.png') no-repeat 0px 2px; }

div.single-thumbnail-date,
div.custom-sidebar .recent-post-widget-date,
div.archive-wrapper .blog-item .blog-thumbnail-date,
div.blog-item-holder .blog-item1 .blog-thumbnail-date,
div.blog-item-holder .blog-item2 .blog-thumbnail-date{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/calendar.png') no-repeat 0px 3px; }

div.single-thumbnail-comment,
div.archive-wrapper .blog-item .blog-thumbnail-comment,
div.blog-item-holder .blog-item1 .blog-thumbnail-comment,
div.blog-item-holder .blog-item2 .blog-thumbnail-comment,
div.custom-sidebar .recent-post-widget-comment-num{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/comment.png') no-repeat 0px 3px; }

div.single-thumbnail-tag,
div.archive-wrapper .blog-item .blog-thumbnail-tag,
div.blog-item-holder .blog-item1 .blog-thumbnail-tag,
div.blog-item-holder .blog-item2 .blog-thumbnail-tag{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/tag.png') no-repeat 0px 3px; }

div.custom-sidebar #searchsubmit,	
div.search-wrapper input[type="submit"]{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/find-17px.png') no-repeat center; }	

div.single-port-visit-website{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/link-small.png') no-repeat; }

span.accordion-head-image.active,
span.toggle-box-head-image.active{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/minus-24px.png'); }
span.accordion-head-image,
span.toggle-box-head-image{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/plus-24px.png'); }

div.jcarousellite-nav .prev, 
div.jcarousellite-nav .next{ background-image: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/navigation-20px.png'); } 

div.testimonial-icon{ background: url("<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/quotes-18px.png"); }

div.custom-sidebar ul li{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/arrow4.png') no-repeat 0px 15px; }

/* Footer Icon Type
   ================================= */
<?php global $gdl_footer_icon_type; ?>
div.footer-wrapper div.custom-sidebar ul li { background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_footer_icon_type; ?>/arrow4.png') no-repeat 0px 15px; }
div.footer-wrapper div.custom-sidebar #searchsubmit { background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_footer_icon_type; ?>/find-17px.png') no-repeat center; }
div.footer-wrapper div.custom-sidebar .recent-post-widget-comment-num { background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_footer_icon_type; ?>/comment.png') no-repeat 0px 3px; }
div.footer-wrapper div.custom-sidebar .recent-post-widget-date{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_footer_icon_type; ?>/calendar.png') no-repeat 0px 3px; }

/* Elements Shadow
   ================================= */
<?php $gdl_element_shadow = get_option(THEME_SHORT_NAME.'_elements_shadow','#888888'); ?>

a.button, button, input[type="submit"], input[type="reset"], input[type="button"], 
a.gdl-button{
	-moz-box-shadow: 0px 1px 1px <?php echo $gdl_element_shadow; ?>;
	-webkit-box-shadow: 0px 1px 1px <?php echo $gdl_element_shadow; ?>;
	box-shadow: 0px 1px 1px <?php echo $gdl_element_shadow; ?>; 
}