<?php
global $themename, $data;
$shortname = "wm";

function wm_wp_head() {
	global $themename, $data;
	$shortname = "wm";
	
	$wm_head_include = get_option( $shortname.'_head_include' ); 
	echo $wm_head_include;

	global $data;	

	global $post;

	///width of the slider caption
	if(get_post_meta($post->ID, 'kingsize_post_slide_caption', true ) != '')
		$width_slide_caption = get_post_meta($post->ID, 'kingsize_post_slide_caption', true );
	elseif(get_post_meta($post->ID, 'kingsize_page_slide_caption', true ) != '' )
		$width_slide_caption = get_post_meta($post->ID, 'kingsize_page_slide_caption', true );
	elseif(get_post_meta($post->ID, 'kingsize_portfolio_slide_caption', true ) != '' )
		$width_slide_caption = get_post_meta($post->ID, 'kingsize_portfolio_slide_caption', true );
	

?>
	
	<style type="text/css">
		a, .more-link {color: <?php echo $data['wm_link_color']; ?>;}
		a:hover, a:focus, a.underline:hover, a.comment-reply-link:hover {color: <?php echo $data['wm_link_color_hover']; ?>;}
		p, body, ul.contact-widget, .woocommerce ul.products li.product .price, .woocommerce div.product p.price, .woocommerce div.product span.price, ul, ol, li {color: <?php echo $data['wm_color_text']; ?>;}
		#logo {height: <?php echo $data['wm_logo_height']; ?>px;}
		#navContainer h5 {color: <?php echo $data['wm_menu_text_color']; ?>;}
		#navContainer h6 {color: <?php echo $data['wm_menu_description_text_color']; ?>;}
		.post h3 a, h3.post_title a {color: <?php echo $data['wm_post_title_color']; ?>;}
		.post h3 a:hover, h3.post_title a:hover {color: <?php echo $data['wm_post_title_color_hover']; ?>;}
	    #mainNavigation ul li ul li a.active, #mainNavigation li.current-menu-item a, #navbar li.current-menu-ancestor > a , #mainNavigation li.current-menu-parent > a, #mainNavigation li.current-menu-item a, #mainNavigation li.current-menu-ancestor > a h5, #mainNavigation li.current-menu-parent > a > h5, #mainNavigation li.current-menu-parent > a, #mainNavigation li.current-menu-item a , #mainNavigation li.current-menu-ancestor > a, #mainNavigation li.current-menu-item h5 {color: <?php echo $data['wm_menu_active_color']; ?>;} 
		#navContainer h6.sub.space.active {color: <?php echo $data['wm_menu_active_description_color']; ?> ;}
		div.hide.success p {color: <?php echo $data['wm_success_color']; ?>;}
		#mainNavigation ul li ul {background: <?php echo $data['wm_submenu_color']; ?>;}
		#mainNavigation ul li ul {border: 1px solid <?php echo $data['wm_submenu_border_color']; ?>;}
		h1 {color: <?php echo $data['wm_heading_text_color_h1']; ?>;}
		h2 {color: <?php echo $data['wm_heading_text_color_h2']; ?>;} 
		h3, #footer_columns h3, #sidebar h3 {color: <?php echo $data['wm_heading_text_color_h3']; ?>;}
		h4 {color: <?php echo $data['wm_heading_text_color_h4']; ?>;} 
		h5 {color: <?php echo $data['wm_heading_text_color_h5']; ?>;} 
		h6 {color: <?php echo $data['wm_heading_text_color_h6']; ?>;} 
		h2.title-page {color: <?php echo $data['wm_section_header_titles_color']; ?>;} 
		<?php if ( !empty($data['wm_google_fonts_name']) ) { ?>#mainNavigation ul li ul li a, .post_title, .older-entries, .title-page, #navContainer .menu, h1, h2, h3, h4, h5, h6, .woocommerce div.product .woocommerce-tabs ul.tabs li a {font-family:<?php echo $data['wm_google_fonts_name'].' !important'?>;}<?php } ?>
		h2.slidecaption {color: <?php echo $data['wm_heading_text_color_h2_slider']; ?>;} 
		#slidedescriptiontext {color: <?php echo $data['wm_text_color_slider']; ?>;}
		a#slidebutton {color: <?php echo $data['wm_text_color_slider_link']; ?>;}
		a#slidebutton:hover {color: <?php echo $data['wm_text_color_slider_link_hover']; ?>;}
		.social-networks-menu a, .footer-networks a {color: <?php echo $data['wm_social_link_color']; ?>;}
		.social-networks-menu a:hover, .footer-networks a:hover {color: <?php echo $data['wm_social_link_color_hover']; ?>;}
		
		<?php if ( !empty($data['wm_input_color']) ) { ?>
		input[type="text"], input[type="password"], input[type="date"], input[type="datetime"], input[type="email"], input[type="number"], input[type="search"], input[type="tel"], input[type="time"], input[type="url"], textarea {background-color: <?php echo $data['wm_input_color']; ?> !important; color: <?php echo $data['wm_input_text_color']; ?> !important;} 
		<?php } ?>
		<?php if ( !empty($data['wm_input_focus_color']) ) { ?>
		input[type="text"]:focus, input[type="password"]:focus, input[type="date"]:focus, input[type="datetime"]:focus, input[type="email"]:focus, input[type="number"]:focus, input[type="search"]:focus, input[type="tel"]:focus, input[type="time"]:focus, input[type="url"]:focus, textarea:focus {background-color: <?php echo $data['wm_input_focus_color']; ?> !important; color: <?php echo $data['wm_input_focus_text_color']; ?> !important;}
		<?php } ?>
		
		/* Font Sizes */
		<?php if ( !empty($data['wm_font_size_menu']) ) { ?>
		div#mainNavigation ul li a h5 {font-size: <?php echo $data['wm_font_size_menu']; ?>px !important;}
		<?php } ?>
		<?php if ( !empty($data['wm_font_size_menu_desc']) ) { ?>
		div#mainNavigation ul li a h6 {font-size: <?php echo $data['wm_font_size_menu_desc']; ?>px !important;}
		<?php } ?>
		<?php if ( !empty($data['wm_font_size_sub_menu']) ) { ?>
		#mainNavigation ul li ul li a {font-size: <?php echo $data['wm_font_size_sub_menu']; ?>px !important;}
		<?php } ?>
		<?php if ( !empty($data['wm_font_size_body']) ) { ?>
		body, p, .footer ul, .footer ol, .footer li, #pagination a, #sidebar ul, #sidebar li, #sidebar p, .page_content li, .page_content ol, .page_content ul, .page_content, .toggle_wrap a, blockquote, input[type="text"], input[type="password"], input[type="date"], input[type="datetime"], input[type="email"], input[type="number"], input[type="search"], input[type="tel"], input[type="time"], input[type="url"], textarea, .send-link, td, th, .more-link {font-size: <?php echo $data['wm_font_size_body']; ?>px !important;}
		<?php } ?>
		<?php if ( !empty($data['wm_font_size_h1']) ) { ?>
		h1 {font-size: <?php echo $data['wm_font_size_h1']; ?>px !important;}
		<?php } ?>
		<?php if ( !empty($data['wm_font_size_h2']) ) { ?>
		h2 {font-size: <?php echo $data['wm_font_size_h2']; ?>px !important;}
		<?php } ?>
		<?php if ( !empty($data['wm_font_size_h3']) ) { ?>
		h3 {font-size: <?php echo $data['wm_font_size_h3']; ?>px !important;}
		<?php } ?>
		<?php if ( !empty($data['wm_font_size_h4']) ) { ?>
		h4 {font-size: <?php echo $data['wm_font_size_h4']; ?>px !important;}
		<?php } ?>
		<?php if ( !empty($data['wm_font_size_h5']) ) { ?>
		h5 {font-size: <?php echo $data['wm_font_size_h5']; ?>px !important;}
		<?php } ?>
		<?php if ( !empty($data['wm_font_size_h6']) ) { ?>
		h6 {font-size: <?php echo $data['wm_font_size_h6']; ?>px !important;}
		<?php } ?>
		
		div#navContainer { position: <?php if ( $data['wm_menu_position_enabled'] == "1" ) {?>absolute<?php } else { ?>fixed<?php } ?>; }
		<?php if($data["wm_gallery_titles_prettyphoto"] !=  "Enable PrettyPhoto Titles") {?> div.ppt, .pp_description { display: none !important;  } <?php } ?>
		
		<?php if ( !empty($data['wm_slider_alignment_top']) ) { ?>
		.slider-top {top: <?php echo $data['wm_slider_alignment_top']; ?>px !important;}
		<?php } ?>
		<?php if ( !empty($data['wm_slider_alignment_bottom']) ) { ?>
		.slider-info {bottom: <?php echo $data['wm_slider_alignment_bottom']; ?>px !important;}
		<?php } ?>
	</style>
	
<?php }

add_action('wp_head', $shortname.'_wp_head');
?>
