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
	margin-top: <?php echo get_option(THEME_SHORT_NAME . "_logo_top_margin", '49'); ?>px;
	margin-left: <?php echo get_option(THEME_SHORT_NAME . "_logo_left_margin", '0'); ?>px;
	margin-bottom: <?php echo get_option(THEME_SHORT_NAME . "_logo_bottom_margin", '32'); ?>px;
}  
  
.top-banner-wrapper{
	margin-top: <?php echo get_option(THEME_SHORT_NAME . "_banner_top_margin", '36'); ?>px;
	margin-bottom: <?php echo get_option(THEME_SHORT_NAME . "_banner_bottom_margin", '0'); ?>px;
} 

/* Social Network
   ================================= */
.social-wrapper{
	margin-top: <?php echo get_option(THEME_SHORT_NAME . "_social_wrapper_margin", '95'); ?>px;
}  
   
/* Font Size
   ================================= */
body{
	font-size: <?php echo get_option(THEME_SHORT_NAME . "_body_font_size", '12'); ?>px;
}
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


/* Font Family 
  ================================= */
<?php $temp_font = substr(get_option(THEME_SHORT_NAME . "_content_font"), 2); 

if(!empty($temp_font) && ($temp_font != 'default -')){ ?>
body{
	font-family: <?php echo $temp_font;  ?>;
}

<?php }

$temp_font = substr(get_option(THEME_SHORT_NAME . "_header_font"), 2); 

if(!empty($temp_font) && ($temp_font != 'default -')){ ?>
h1, h2, h3, h4, h5, h6, .gdl-title{
	font-family: <?php echo $temp_font; ?>;
}
<?php  }

$temp_font = substr(get_option(THEME_SHORT_NAME . "_stunning_text_font"), 2); 

if(!empty($temp_font) && ($temp_font != 'default -')){ ?>
h1.stunning-text-title{
	font-family: <?php echo $temp_font; ?>;
}
<?php } ?>

h1.stunning-text-title{
	color: <?php echo get_option(THEME_SHORT_NAME . "_stunning_text_title_color", '#333333'); ?>;
}
.stunning-text-caption{
	color: <?php echo get_option(THEME_SHORT_NAME . "_stunning_text_caption_color", '#666666'); ?>;
}
  
/* Font Color
   ================================= */
body{
	color: <?php echo get_option(THEME_SHORT_NAME . "_content_color", '#666666'); ?> !important;
}
a{
	color: <?php echo get_option(THEME_SHORT_NAME . "_link_color", '#ef7f2c'); ?>;
}
.footer-wrapper a{
	color: <?php echo get_option(THEME_SHORT_NAME . "_footer_link_color", '#ef7f2c'); ?>;
}
.gdl-link-title{
	color: <?php echo get_option(THEME_SHORT_NAME . "_link_color", '#ef7f2c'); ?> !important;
}
a:hover{
	color: <?php echo get_option(THEME_SHORT_NAME . "_link_hover_color", '#ef7f2c'); ?>;
}
.footer-wrapper a:hover{
	color: <?php echo get_option(THEME_SHORT_NAME . "_footer_link_hover_color", '#ef7f2c'); ?>;
}
.gdl-slider-title{
	color: <?php echo get_option(THEME_SHORT_NAME . "_slider_title_color", '#ffffff'); ?> !important;
}  
.pika-stage .caption,
.flex-caption{
	color: <?php echo get_option(THEME_SHORT_NAME . "_slider_caption_color", '#d9d9d9'); ?> !important;
}  
h1, h2, h3, h4, h5, h6, .title-color{
	color: <?php echo get_option(THEME_SHORT_NAME.'_title_color', '#494949'); ?>;
}
.sidebar-title-color, .sidebar-header-title{
	color: <?php echo get_option(THEME_SHORT_NAME.'_sidebar_title_color', '#494949'); ?> !important;
}
.sidebar-content-color{
	color: <?php echo get_option(THEME_SHORT_NAME.'_sidebar_content_color', '#989898'); ?> !important;
}
.custom-sidebar .gdl-widget-tab-header-item a{
	color: <?php echo get_option(THEME_SHORT_NAME.'_tab_widget_title_color', '#a0a0a0'); ?> !important;
}
.custom-sidebar .gdl-widget-tab-header-item.active a{
	color: <?php echo get_option(THEME_SHORT_NAME.'_tab_widget_title_active_color', '#ef7f2c'); ?> !important;
}
.custom-sidebar .post-info-color{
	color: <?php echo get_option(THEME_SHORT_NAME.'_sidebar_info_color', '#a4a4a4'); ?> !important;
}
.recent-post-widget-thumbnail,
div.custom-sidebar .news-widget-thumbnail img,
div.custom-sidebar .news-widget-avatar img{
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_tab_widget_frame_color', '#dddddd'); ?> !important;
}
/* Post/Port Color
   ================================= */
   
.port-title-color{
	color: <?php echo get_option(THEME_SHORT_NAME.'_port_title_color', '#ef7f2c'); ?> !important;
}
.port-title-color a:hover{
	color: <?php echo get_option(THEME_SHORT_NAME.'_port_title_hover_color', '#ef7f2c'); ?> !important;
}
.post-title-color{
	color: <?php echo get_option(THEME_SHORT_NAME.'_post_title_color', '#333333'); ?> !important;
}
.post-title-color a:hover{
	color: <?php echo get_option(THEME_SHORT_NAME.'_post_title_hover_color', '#707070'); ?> !important;
}
.post-widget-title-color{
	color: <?php echo get_option(THEME_SHORT_NAME.'_post_widget_title_color', '#ef7f2c'); ?> !important;
}
.post-info-color, div.custom-sidebar #twitter_update_list{
	color: <?php echo get_option(THEME_SHORT_NAME.'_post_info_color', '#a4a4a4'); ?> !important;
}
div.pagination{
	border-color: <?php echo get_option(THEME_SHORT_NAME.'_pagination_border', '#dfdfdf'); ?>; 
}
div.pagination a{ 
	color: <?php echo get_option(THEME_SHORT_NAME.'_pagination_text_color', '#8c8c8c'); ?>; 
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_pagination_background', '#f0f0f0'); ?>; 
}
div.pagination a:hover, div.pagination span.current{ 
	color: <?php echo get_option(THEME_SHORT_NAME.'_pagination_hover_text', '#525252'); ?>; 
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_pagination_hover_background', '#ffffff'); ?>; 
}
.about-author-wrapper{
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_post_about_author_color', '#f9f9f9'); ?> !important;
}

/* Column Service
   ================================= */
h2.column-service-title{
	color: <?php echo get_option(THEME_SHORT_NAME.'_column_service_title_color', '#ef7f2c'); ?> !important;
}

/* Stunning Text
   ================================= */
.stunning-text-button{
	color: <?php echo get_option(THEME_SHORT_NAME.'_stunning_text_button_color', '#ffffff'); ?> !important;
	<?php $stunning_text_button_color = get_option(THEME_SHORT_NAME.'_stunning_text_button_background', '#ff8a42'); ?> 
	background-color: <?php echo $stunning_text_button_color ?> !important;
	border: 1px solid <?php echo $stunning_text_button_color ?> !important;
}

/* Footer Color
   ================================= */
.footer-widget-wrapper .custom-sidebar-title{ 
	color: <?php echo get_option(THEME_SHORT_NAME.'_footer_title_color', '#171717'); ?> !important;
}
.footer-widget-wrapper{ 
	border-top: 1px solid <?php echo get_option(THEME_SHORT_NAME.'_footer_top_border', '#e9e9e9'); ?> !important;
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_footer_background', '#ffffff'); ?> !important;
}
.footer-wrapper .gdl-divider{
	border-color: <?php echo get_option(THEME_SHORT_NAME.'_footer_divider_color', '#ebebeb'); ?> !important;
}
.footer-wrapper, .footer-wrapper table th{
	color: <?php echo get_option(THEME_SHORT_NAME.'_footer_content_color', '#b1b1b1'); ?> !important;
}
.footer-wrapper .post-info-color, div.custom-sidebar #twitter_update_list{
	color: <?php echo get_option(THEME_SHORT_NAME.'_footer_content_info_color', '#b1b1b1'); ?> !important;
}
div.footer-wrapper div.contact-form-wrapper input[type="text"], 
div.footer-wrapper div.contact-form-wrapper input[type="password"], 
div.footer-wrapper div.contact-form-wrapper textarea, 
div.footer-wrapper div.custom-sidebar #search-text input[type="text"], 
div.footer-wrapper div.custom-sidebar .contact-widget-whole input, 
div.footer-wrapper div.custom-sidebar .contact-widget-whole textarea {
	color: <?php echo get_option(THEME_SHORT_NAME.'_footer_input_text', '#888888'); ?> !important; 
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_footer_input_background', '#f0f0f0'); ?> !important;
	border: 1px solid <?php echo get_option(THEME_SHORT_NAME.'_footer_input_border', '#e8e8e8'); ?> !important;
}
div.footer-wrapper a.button, div.footer-wrapper button, div.footer-wrapper button:hover {
	color: <?php echo get_option(THEME_SHORT_NAME.'_footer_button_text', '#ffffff'); ?> !important; 
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_footer_button_color', '#7d7d7d'); ?> !important;
}
div.copyright-wrapper-gimmick{
	background: <?php echo get_option(THEME_SHORT_NAME . "_copyright_top_bar", '#c1c1c1'); ?>;
}
div.copyright-wrapper{ 
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_copyright_background', '#2f2f2f'); ?> !important; 
	color: <?php echo get_option(THEME_SHORT_NAME.'_copyright_text', '#808080'); ?> !important;
}
div.copyright-wrapper{
	<?php $gdl_copyright_shadow = get_option(THEME_SHORT_NAME.'_copyright_shadow','#111111'); ?>
	-moz-box-shadow:inset 0px 3px 6px -3px <?php echo $gdl_copyright_shadow; ?>;
	-webkit-box-shadow:inset 0px 3px 6px -3px <?php echo $gdl_copyright_shadow; ?>;
	box-shadow:inset 0px 3px 6px -3px <?php echo $gdl_copyright_shadow; ?>; 
}
div.footer-wrapper div.custom-sidebar .recent-post-widget-thumbnail {  
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_footer_frame_background', '#ebebeb'); ?> !important; 
}

/* Divider Color
   ================================= */
.gdl-divider{
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
	color: <?php echo get_option(THEME_SHORT_NAME.'_testimonial_text', '#848484'); ?> !important;;
}
.testimonial-author-name{
	color: <?php echo get_option(THEME_SHORT_NAME.'_testimonial_author', '#494949'); ?> !important;; 
}
.testimonial-author-position{
	color: <?php echo get_option(THEME_SHORT_NAME.'_testimonial_position', '#8d8d8d'); ?> !important;;
}

/* Tabs Color
   ================================= */
ul.tabs li a {
	color: <?php echo get_option(THEME_SHORT_NAME.'_tab_title_color', '#666666'); ?>;
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_tab_background_color', '#f5f5f5'); ?> !important;
}
ul.tabs li a.active {
	color: <?php echo get_option(THEME_SHORT_NAME.'_tab_title_active_color', '#111111'); ?>;
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_tab_active_background_color', '#ffffff'); ?> !important;
}

/* Navigation Color
   ================================= */
<?php if(get_option(THEME_SHORT_NAME.'_main_navigation_gradient', 'enable') == 'enable'){ ?>
div.navigation-wrapper{
	background: url('<?php echo GOODLAYERS_PATH; ?>/images/navigation-gradient.png') repeat-x; 
}
<?php } ?>
.top-navigation-wrapper{
	<?php $gdl_top_navigation_text_color = get_option(THEME_SHORT_NAME.'_top_navigation_text', '#b2b2b2'); ?>
	color: <?php echo $gdl_top_navigation_text_color; ?> !important;
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_top_navigation_background', '#444444'); ?> !important;
}
.top-navigation-left li a{ 
	<?php $gdl_top_navigation_text_color = '#' . hexDarker(substr($gdl_top_navigation_text_color, 1)); ?>
	border-right: 1px solid <?php echo $gdl_top_navigation_text_color; ?> !important;
}
.top-navigation-wrapper-gimmick{
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_top_navigation_bottom_bar', '#ff851d'); ?> !important;
}
.navigation-wrapper{
	<?php $gdl_border_top_bottom = get_option(THEME_SHORT_NAME.'_main_navigation_border_top_bottom', '#d7d7d7'); ?>
	border: 1px solid <?php echo $gdl_border_top_bottom; ?> !important;
	
	<?php $gdl_nav_buttom_shadow = get_option(THEME_SHORT_NAME.'_main_navigation_bottom_shadow', '#f5f5f5'); ?>
	-moz-box-shadow: 0px 1px 5px -1px <?php echo $gdl_nav_buttom_shadow; ?>;
	-webkit-box-shadow: 0px 1px 5px -1px <?php echo $gdl_nav_buttom_shadow; ?>;
	box-shadow: 0px 1px 5px -1px <?php echo $gdl_nav_buttom_shadow; ?>; 
}
div.navigation-top-gimmick{
	background-color: <?php echo $gdl_border_top_bottom; ?>;
}
.navigation-wrapper{
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_main_navigation_background', '#ececec'); ?> !important;
}
<?php $sub_menu_border = get_option(THEME_SHORT_NAME.'_main_navigation_sub_border', '#e9e9e9'); ?>
.navigation-wrapper .sf-menu ul{
	border-color: <?php echo $sub_menu_border; ?> !important;	
}

.navigation-wrapper .sf-menu .current-menu-ancestor ul a,
.navigation-wrapper .sf-menu .current-menu-item ul a,
.navigation-wrapper .sf-menu li li a{
	color: <?php echo get_option(THEME_SHORT_NAME.'_main_navigation_sub_text', '#888888'); ?> !important;
}
.navigation-wrapper .sf-menu li li a:focus, 
.navigation-wrapper .sf-menu li li a:hover, 
.navigation-wrapper li li .sf-menu a:active,
.navigation-wrapper .sf-menu ul .current-menu-ancestor a,
.navigation-wrapper .sf-menu ul .current-menu-item a {
	color: <?php echo get_option(THEME_SHORT_NAME.'_main_navigation_sub_text_hover', '#3d3d3d'); ?> !important;
}
.sf-menu li li{
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_main_navigation_sub_background', '#fbfbfb'); ?> !important;
	border-color: <?php echo $sub_menu_border; ?> !important;
}
.navigation-wrapper .sf-menu li a{
	color: <?php echo get_option(THEME_SHORT_NAME.'_main_navigation_text', '#666666'); ?> !important;
	border-right: 1px solid <?php echo $gdl_border_top_bottom; ?> !important;
}
.navigation-wrapper .sf-menu a:focus, .navigation-wrapper .sf-menu a:hover, .navigation-wrapper .sf-menu a:active{
	color: <?php echo get_option(THEME_SHORT_NAME.'_main_navigation_text_hover', '#3d3d3d'); ?> !important;
} 
.navigation-wrapper .sf-menu .current-menu-ancestor a,
.navigation-wrapper .sf-menu .current-menu-item a {
	color: <?php echo get_option(THEME_SHORT_NAME.'_main_navigation_text_current', '#3d3d3d'); ?> !important;
 }
.search-wrapper,
.search-wrapper #search-text input[type="text"]{
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_search_box_background', '#2f2f2f'); ?> !important;
	color: <?php echo get_option(THEME_SHORT_NAME.'_search_box_text', '#696969'); ?> !important;
}
.search-left-gimmick,
.search-right-gimmick{
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_search_box_left_right_bar', '#323232'); ?>
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

div.single-thumbnail-author,
div.archive-wrapper .blog-item .blog-thumbnail-author,
div.blog-item-holder .blog-item .blog-thumbnail-author,
div.blog-item-holder .blog-item2 .blog-thumbnail-author{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/author.png') no-repeat 0px 0px; }

div.single-thumbnail-date,
div.custom-sidebar .recent-post-widget-date,
div.blog-item-holder .blog-item .blog-thumbnail-date,
div.archive-wrapper .blog-item .blog-thumbnail-date{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/calendar.png') no-repeat 0px 0px; }

div.single-thumbnail-comment,
div.archive-wrapper .blog-item .blog-thumbnail-comment,
div.blog-item-holder .blog-thumbnail-comment,
div.custom-sidebar .recent-post-widget-comment-num{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/comment.png') no-repeat 0px 0px; }

div.single-thumbnail-tag,
div.blog-item-holder .blog-item .blog-thumbnail-tag,
div.archive-wrapper .blog-item .blog-thumbnail-tag{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/tag.png') no-repeat; }

div.single-port-visit-website{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/link-small.png') no-repeat; }

span.accordion-head-image.active,
span.toggle-box-head-image.active{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/minus-24px.png'); }
span.accordion-head-image,
span.toggle-box-head-image{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/plus-24px.png'); }

div.jcarousellite-nav .prev, 
div.jcarousellite-nav .next{ background-image: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/navigation-20px.png'); } 

div.blog-item-slideshow-nav-right,
div.blog-item-slideshow-nav-left{ background-image: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/slideshow-navigation.png'); } 

div.testimonial-icon{ background: url("<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/quotes-18px.png"); }

div.blog-item-holder .blog-item-full .blog-small-list ul li{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/arrow4.png') no-repeat 0px 6px; }
div.custom-sidebar ul li{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/arrow4.png') no-repeat 0px 14px; }

div.divider{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/header-gimmick.png') repeat-x 0px 0px; }
div.header-gimmick{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/header-gimmick.png') repeat-x 0px 8px; }
div.sidebar-header-gimmick{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_icon_type; ?>/header-gimmick.png') repeat-x 0px 6px; }

/* Search Box Icon Type */
<?php $gdl_search_box_icon = get_option(THEME_SHORT_NAME.'_search_box_icon','light') ?>
div.custom-sidebar #searchsubmit,	
div.search-wrapper input[type="submit"]{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_search_box_icon; ?>/search-button.png') no-repeat center; }	


/* Footer Icon Type
   ================================= */
<?php global $gdl_footer_icon_type; ?>
div.footer-wrapper div.custom-sidebar ul li { background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_footer_icon_type; ?>/arrow4.png') no-repeat 0px 14px; }
div.footer-wrapper div.custom-sidebar #searchsubmit { background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_footer_icon_type; ?>/search-button.png') no-repeat center; }
div.footer-wrapper div.custom-sidebar .recent-post-widget-comment-num { background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_footer_icon_type; ?>/comment.png') no-repeat 0px 1px; }
div.footer-wrapper div.custom-sidebar .recent-post-widget-date{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $gdl_footer_icon_type; ?>/calendar.png') no-repeat 0px 1px; }

<?php $copyright_icon_type = get_option(THEME_SHORT_NAME.'_copyright_back_to_top_icon' ,'light'); ?>
div.back-to-top-button{ background: url('<?php echo GOODLAYERS_PATH; ?>/images/icon/<?php echo $copyright_icon_type; ?>/back-to-top.png'); }

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

/* BKP FRAME */
div.bkp-frame-wrapper,
div.page-bkp-frame-wrapper,
div.gdl-widget-tab-header-item,
div.gdl-widget-tab-header-item-last{
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_frame_outer_background', '#f8f8f8'); ?> !important;
}
div.bkp-frame-wrapper,
div.page-bkp-frame-wrapper{
	border-color: <?php echo get_option(THEME_SHORT_NAME.'_frame_outer_border', '#dadada'); ?> !important;
	
}
.gdl-tab-divider{
	border-color: <?php echo get_option(THEME_SHORT_NAME . "_tab_widget_border_color", '#e5e5e5'); ?> !important;
}
div.bkp-frame,
div.page-bkp-frame,
div.gdl-widget-tab-header-item.active{
	background-color: <?php echo get_option(THEME_SHORT_NAME.'_frame_inner_background', '#ffffff'); ?> !important;
}