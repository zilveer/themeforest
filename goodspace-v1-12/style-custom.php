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
/* Background
   ================================= */
<?php 
	$background_style = get_option(THEME_SHORT_NAME.'_background_style', 'Pattern');
	if($background_style == 'Pattern'){
		$background_pattern = get_option(THEME_SHORT_NAME.'_background_pattern', '1');
		?>
		
		html{ 
			background-image: url('<?php echo GOODLAYERS_PATH; ?>/images/pattern/pattern-<?php echo $background_pattern; ?>.png');
			background-repeat: repeat; 
		}
		
		<?php
	}
?>
   
/* Logo
   ================================= */
.logo-wrapper{ 
	margin-top: <?php echo get_option(THEME_SHORT_NAME . "_logo_top_margin", '0'); ?>px;
	margin-left: <?php echo get_option(THEME_SHORT_NAME . "_logo_left_margin", '10'); ?>px;
	margin-bottom: <?php echo get_option(THEME_SHORT_NAME . "_logo_bottom_margin", '33'); ?>px;
}
.navigation-wrapper{
	margin-top: <?php echo get_option(THEME_SHORT_NAME . "_navigation_top_margin", '55'); ?>px;
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
	background-color: <?php echo get_option(THEME_SHORT_NAME . "_body_background", '#dddddd'); ?>;
}
div.social-icon, /* to fix IE problem */
div.container{
	background: <?php echo get_option(THEME_SHORT_NAME . "_container_background", '#ffffff'); ?>;
}
div.divider{
	border-bottom: 1px solid <?php echo get_option(THEME_SHORT_NAME . "_divider_line", '#ececec'); ?>;
}

/* Font Family 
  ================================= */
body{
	font-family: <?php echo substr(get_option(THEME_SHORT_NAME . "_content_font"), 2); ?>;
}
h1, h2, h3, h4, h5, h6, .gdl-title{
	font-family: <?php echo substr(get_option(THEME_SHORT_NAME . "_header_font"), 2); ?>;
}
.stunning-text-wrapper{
	background-color: <?php echo get_option(THEME_SHORT_NAME . "_stunning_text_background_color", '#ffffff'); ?> !important;
	border-bottom: 1px solid <?php echo get_option(THEME_SHORT_NAME . "_stunning_text_bottom_border", '#dddddd'); ?>;
}
h1.stunning-text-title{
	font-family: <?php echo substr(get_option(THEME_SHORT_NAME . "_stunning_text_font"), 2); ?>;
	color: <?php echo get_option(THEME_SHORT_NAME . "_stunning_text_title_color", '#333333'); ?>;
}
.gdl-slider-title{
	font-family: <?php echo substr(get_option(THEME_SHORT_NAME . "_slider_title_font"), 2); ?>;
}
.stunning-text-caption{
	color: <?php echo get_option(THEME_SHORT_NAME . "_stunning_text_caption_color", '#8c8c8c'); ?>;
}
  
/* Font Color
   ================================= */
body{
	color: <?php echo get_option(THEME_SHORT_NAME . "_content_color", '#919191'); ?> !important;
}
.footer-wrapper a{
	color: <?php echo get_option(THEME_SHORT_NAME . "_footer_link_color", '#000000'); ?>;
}
a{
	color: <?php echo get_option(THEME_SHORT_NAME . "_link_color", '#272727'); ?>;
}
.gdl-link-title{
	color: <?php echo get_option(THEME_SHORT_NAME . "_link_color", '#272727'); ?> !important;
}
a:hover{
	color: <?php echo get_option(THEME_SHORT_NAME . "_link_hover_color", '#272727'); ?>;
}
.footer-wrapper a:hover{
	color: <?php echo get_option(THEME_SHORT_NAME . "_footer_link_hover_color", '#a8a8a8'); ?>;
}
h1, h2, h3, h4, h5, h6, .title-color{
	color: <?php echo get_option(THEME_SHORT_NAME.'_title_color', '#383838'); ?>;
}
div.gdl-page-title-left-bar{
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_title_left_bar_color', '#e3e3e3'); ?>;
}
div.gdl-page-caption{
	color: <?php echo get_option(THEME_SHORT_NAME.'_caption_color', '#7d7d7d'); ?>;
}
.sidebar-title-color{
	color: <?php echo get_option(THEME_SHORT_NAME.'_sidebar_title_color', '#191919'); ?> !important;
}

/* Slider Color 
	================================ */
.gdl-slider-title{
	color: <?php echo get_option(THEME_SHORT_NAME . "_slider_title_color", '#ffffff'); ?> !important;
}  
.gdl-slider-caption, .nivo-caption{
	<?php $slider_caption_color = get_option(THEME_SHORT_NAME . "_slider_caption_color", '#c6c6c6'); ?>
	color: <?php echo $slider_caption_color ?> !important;
}  
.flex-control-nav li a span,
.nivo-controlNav a span,
div.anythingSlider .anythingControls ul a span{
	background-color: <?php echo get_option(THEME_SHORT_NAME . "_slider_bullet_color", '#c5c5c5'); ?> !important;
}
.nivo-controlNav a:hover span,
.nivo-controlNav a.active span,
.flex-control-nav li a:hover span,
.flex-control-nav li a.flex-active span,
div.anythingSlider .anythingControls ul a:hover span,
div.anythingSlider .anythingControls ul a.cur span{
	background-color: <?php echo get_option(THEME_SHORT_NAME . "_slider_bullet_hover_color", '#4e4e4e'); ?> !important;
}
.flex-caption{
	background-color: <?php echo get_option(THEME_SHORT_NAME . "_slider_caption_bg", '#000000'); ?> !important;
}

/* Post/Port Color
   ================================= */
.post-title-color{
	color: <?php echo get_option(THEME_SHORT_NAME.'_post_title_color', '#646464'); ?> !important;
}
.post-title-color a:hover{
	color: <?php echo get_option(THEME_SHORT_NAME.'_post_title_hover_color', '#646464'); ?> !important;
}
div.single-port-little-bar{
	border-color: <?php echo get_option(THEME_SHORT_NAME.'_port_info_top_bar', '#b4b4b4'); ?> !important;
}
.single-port-info span.head,
.single-info-header,
.blog-info-header{
	color: <?php echo get_option(THEME_SHORT_NAME.'_post_info_header_color', '#212121'); ?> !important;
}
.port-info-color, .port-info-color a,
.post-info-color, .post-info-color a, 
div.custom-sidebar #twitter_update_list{
	color: <?php echo get_option(THEME_SHORT_NAME.'_post_info_color', '#9e9e9e'); ?> !important;
}
div.pagination a{ background-color: <?php echo get_option(THEME_SHORT_NAME.'_pagination_normal_state', '#f5f5f5'); ?>; }

.about-author-wrapper{
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_post_about_author_color', '#f9f9f9'); ?> !important;
}
.tagcloud a{
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_tag_cloud_background', '#ffffff'); ?> !important;
}
div.footer-widget-wrapper .tagcloud a{
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_footer_tag_cloud_background', '#ffffff'); ?> !important;
}

#portfolio-item-filter a{ 
	color: <?php echo get_option(THEME_SHORT_NAME.'_port_filter_color', '#a1a1a1'); ?>;
} 
#portfolio-item-filter a:hover{ 
	color: <?php echo get_option(THEME_SHORT_NAME.'_port_filter_color_hover', '#272727'); ?>;
} 
#portfolio-item-filter a.active{ 
	color: <?php echo get_option(THEME_SHORT_NAME.'_port_filter_color_active', '#272727'); ?>;
}

/* Column Service
   ================================= */
h2.column-service-title{
	color: <?php echo get_option(THEME_SHORT_NAME.'_column_service_title_color', '#3a3a3a'); ?> !important;
}

/* Footer Color
   ================================= */
.footer-widget-wrapper .custom-sidebar-title{ 
	color: <?php echo get_option(THEME_SHORT_NAME.'_footer_title_color', '#404040'); ?> !important;
}
.footer-wrapper{ 
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_footer_background', '#eaeaea'); ?> !important;
}
.footer-wrapper .gdl-divider,
.footer-wrapper .custom-sidebar.gdl-divider div,
.footer-wrapper .custom-sidebar.gdl-divider ul li{
	border-color: <?php echo get_option(THEME_SHORT_NAME.'_footer_divider_color', '#d1d1d1'); ?> !important;
}
.footer-wrapper, .footer-wrapper table th{
	color: <?php echo get_option(THEME_SHORT_NAME.'_footer_content_color', '#000000'); ?> !important;
}
.footer-wrapper .post-info-color, div.custom-sidebar #twitter_update_list{
	color: <?php echo get_option(THEME_SHORT_NAME.'_footer_content_info_color', '#aaaaaa'); ?> !important;
}
div.footer-wrapper div.contact-form-wrapper input[type="text"], 
div.footer-wrapper div.contact-form-wrapper input[type="password"], 
div.footer-wrapper div.contact-form-wrapper textarea, 
div.footer-wrapper div.custom-sidebar #search-text input[type="text"], 
div.footer-wrapper div.custom-sidebar .contact-widget-whole input, 
div.footer-wrapper div.custom-sidebar .contact-widget-whole textarea {
	color: <?php echo get_option(THEME_SHORT_NAME.'_footer_input_text', '#888888'); ?> !important; 
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_footer_input_background', '#d4d4d4'); ?> !important;
	border: 1px solid <?php echo get_option(THEME_SHORT_NAME.'_footer_input_border', '#d4d4d4'); ?> !important;
}
div.footer-wrapper a.button, div.footer-wrapper button, div.footer-wrapper button:hover {
	color: <?php echo get_option(THEME_SHORT_NAME.'_footer_button_text', '#e8e8e8'); ?> !important; 
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_footer_button_color', '#222222'); ?> !important;
}
div.copyright-wrapper{ 
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_copyright_background', '#202020'); ?> !important; 
	color: <?php echo get_option(THEME_SHORT_NAME.'_copyright_text', '#808080'); ?> !important;
}
div.copyright-wrapper{
	<?php $gdl_copyright_shadow = get_option(THEME_SHORT_NAME.'_copyright_shadow','#111111'); ?>
	-moz-box-shadow:inset 0px 3px 6px -3px <?php echo $gdl_copyright_shadow; ?>;
	-webkit-box-shadow:inset 0px 3px 6px -3px <?php echo $gdl_copyright_shadow; ?>;
	box-shadow:inset 0px 3px 6px -3px <?php echo $gdl_copyright_shadow; ?>; 
}
div.footer-wrapper div.custom-sidebar .recent-post-widget-thumbnail {  
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_footer_frame_background', '#ffffff'); ?>; 
	border-color: <?php echo get_option(THEME_SHORT_NAME.'_footer_frame_border', '#ffffff'); ?>;
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
	color: <?php echo get_option(THEME_SHORT_NAME.'_testimonial_text', '#848484'); ?> !important;
}
.testimonial-author-name{
	color: <?php echo get_option(THEME_SHORT_NAME.'_testimonial_author', '#494949'); ?> !important;
}
.testimonial-author-position{
	color: <?php echo get_option(THEME_SHORT_NAME.'_testimonial_position', '#8d8d8d'); ?> !important;
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

/* Navigation Color
   ================================= */
.navigation-wrapper .sf-menu ul,
.navigation-wrapper .sf-menu ul li{
	border-color: <?php echo get_option(THEME_SHORT_NAME.'_sub_navigation_border', '#ececec'); ?> !important;
}
.sf-menu li li{
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_sub_navigation_background', '#fdfdfd'); ?> !important;
}
.navigation-wrapper .sf-menu li a{
	color: <?php echo get_option(THEME_SHORT_NAME.'_main_navigation_text', '#7d7d7d'); ?> !important;
}
.navigation-wrapper .sf-menu ul a,
.navigation-wrapper .sf-menu ul .current-menu-ancestor ul a,
.navigation-wrapper .sf-menu ul .current-menu-item ul a,
.navigation-wrapper .sf-menu .current-menu-ancestor ul a,
.navigation-wrapper .sf-menu .current-menu-item ul a{
	color: <?php echo get_option(THEME_SHORT_NAME.'_sub_navigation_text', '#7d7d7d'); ?> !important;
}
.navigation-wrapper .sf-menu ul a:hover,
.navigation-wrapper .sf-menu ul .current-menu-item ul a:hover,
.navigation-wrapper .sf-menu .current-menu-item ul a:hover{
	color: <?php echo get_option(THEME_SHORT_NAME.'_sub_navigation_text_hover', '#343434'); ?> !important;
}
.navigation-wrapper .sf-menu a:hover, 
.navigation-wrapper .sf-menu a:active{
	color: <?php echo get_option(THEME_SHORT_NAME.'_main_navigation_text_hover', '#343434'); ?> !important;
} 
.navigation-wrapper .sf-menu .current-menu-ancestor a,
.navigation-wrapper .sf-menu .current-menu-item a {
	color: <?php echo get_option(THEME_SHORT_NAME.'_main_navigation_text_current', '#343434'); ?> !important;
}
.navigation-wrapper .sf-menu ul .current-menu-ancestor a,
.navigation-wrapper .sf-menu ul .current-menu-ancestor ul .current-menu-item a,
.navigation-wrapper .sf-menu ul .current-menu-item a {
	color: <?php echo get_option(THEME_SHORT_NAME.'_sub_navigation_text_current', '#343434'); ?> !important;
}
.search-wrapper{
	border-left: 1px solid <?php echo $gdl_nav_border_right; ?>;
}
.search-wrapper form{
	border-left: 1px solid <?php echo $gdl_nav_border_left; ?>;
}



/* Button Color
   ================================= */
<?php
	$gdl_button_color = get_option(THEME_SHORT_NAME.'_button_background_color', '#f1f1f1');
	$gdl_button_border = get_option(THEME_SHORT_NAME.'_button_border_color', '#dedede');
	$gdl_button_text = get_option(THEME_SHORT_NAME.'_button_text_color', '#7a7a7a');
	$gdl_button_hover = get_option(THEME_SHORT_NAME.'_button_text_hover_color', '#7a7a7a');
?>
a.button, button, input[type="submit"], input[type="reset"], input[type="button"],
a.gdl-button{
	background-color: <?php echo $gdl_button_color; ?>;
	color: <?php echo $gdl_button_text; ?>;
	border: 1px solid <?php echo $gdl_button_border; ?>
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

div.single-port-next-nav a,
div.single-port-prev-nav a{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/port-nav.png') no-repeat; }

div.single-thumbnail-author,
div.archive-wrapper .blog-item .blog-thumbnail-author,
div.blog-item-holder .blog-item2 .blog-thumbnail-author{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/author.png') no-repeat 0px 1px; }

div.single-thumbnail-date,
div.custom-sidebar .recent-post-widget-date,
div.archive-wrapper .blog-item .blog-thumbnail-date,
div.blog-item-holder .blog-item1 .blog-thumbnail-date,
div.blog-item-holder .blog-item2 .blog-thumbnail-date{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/calendar.png') no-repeat 0px 1px; }

div.single-thumbnail-comment,
div.archive-wrapper .blog-item .blog-thumbnail-comment,
div.blog-item-holder .blog-item1 .blog-thumbnail-comment,
div.blog-item-holder .blog-item2 .blog-thumbnail-comment,
div.custom-sidebar .recent-post-widget-comment-num{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/comment.png') no-repeat 0px 1px; }

div.single-thumbnail-tag,
div.archive-wrapper .blog-item .blog-thumbnail-tag,
div.blog-item-holder .blog-item2 .blog-thumbnail-tag{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/tag.png') no-repeat; }

div.custom-sidebar #searchsubmit,	
div.search-wrapper input[type="submit"]{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/find-17px.png') no-repeat center; }	

div.single-port-visit-website{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/link-small.png') no-repeat 0px 2px; }

span.accordion-head-image.active,
span.toggle-box-head-image.active{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/minus-24px.png'); }
span.accordion-head-image,
span.toggle-box-head-image{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/plus-24px.png'); }

div.jcarousellite-nav .prev, 
div.jcarousellite-nav .next{ background-image: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/navigation-20px.png'); } 

div.testimonial-icon{ background: url("<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/quotes-18px.png"); }

div.custom-sidebar ul li{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/arrow4.png') no-repeat 0px 14px; }

div.gdl-portfolio-title-wrapper,
div.gdl-page-title-wrapper{
	background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/title-bg.png'); 
}

div.stunning-text-wrapper{ 
	background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/stunning-text-bg.png'); 
}
div.stunning-text-corner{
	background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/stunning-text-corner.png'); 
}

/* Footer Icon Type
   ================================= */
<?php global $gdl_footer_icon_type; ?>
div.footer-wrapper div.custom-sidebar ul li { background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_footer_icon_type; ?>/arrow4.png') no-repeat 0px 14px; }
div.footer-wrapper div.custom-sidebar #searchsubmit { background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_footer_icon_type; ?>/find-17px.png') no-repeat center; }
div.footer-wrapper div.custom-sidebar .recent-post-widget-comment-num { background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_footer_icon_type; ?>/comment.png') no-repeat 0px 1px; }
div.footer-wrapper div.custom-sidebar .recent-post-widget-date{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_footer_icon_type; ?>/calendar.png') no-repeat 0px 1px; }

/* Elements Shadow
   ================================= */
<?php $gdl_element_shadow = get_option(THEME_SHORT_NAME.'_elements_shadow','#ececec'); ?>

a.button, button, input[type="submit"], input[type="reset"], input[type="button"], 
a.gdl-button{
	-moz-box-shadow: 1px 1px 3px <?php echo $gdl_element_shadow; ?>;
	-webkit-box-shadow: 1px 1px 3px <?php echo $gdl_element_shadow; ?>;
	box-shadow: 1px 1px 3px <?php echo $gdl_element_shadow; ?>; 
}

div.gdl-price-item .price-item.active{ 
	-moz-box-shadow: 0px 0px 3px <?php echo $gdl_element_shadow; ?>;
	-webkit-box-shadow: 0px 0px 3px <?php echo $gdl_element_shadow; ?>;
	box-shadow: 0px 0px 3px <?php echo $gdl_element_shadow; ?>;
}

div.stunning-text-corner{ width: 11px; height: 11px; position: absolute; }
div.stunning-text-corner.top{ top: 0px; left: 0px; }
div.stunning-text-corner.bottom{ background-position: -11px 0px; bottom: 0px; right: 0px; }

div.column-service-learn-more{ font-style: italic; margin-top: 8px; }
div#custom-full-background { z-index: -1; }

