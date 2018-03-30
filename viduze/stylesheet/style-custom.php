<?php
	/*	
	*	CrunchPress Custom Style File (style-custom.php)
	*	---------------------------------------------------------------------
	*	This file fetch all style options in admin panel to generate the css
	*	to attach to header.php file
	*	---------------------------------------------------------------------
	*/

	header('Content-type: text/css;');
	
	$current_url = dirname(__FILE__);
	$wp_content_pos = strpos($current_url, 'wp-content');
	$wp_content = substr($current_url, 0, $wp_content_pos);

	require_once $wp_content . 'wp-load.php';
	
?>

/* Background
   ------------------------------------------------------------------ */
<?php   $color_scheme = get_option(THEME_NAME_S.'_default_background_color','#fff'); 
	    $background_style =  get_option(THEME_NAME_S.'_background_style','Pattern');
		
	
	    if($background_style == 'Color'){ ?>
        html{ 
			background-color: <?php echo $color_scheme; ?> ; 
		}
<?php
  
  
       $background_style =  get_option(THEME_NAME_S.'_background_style','Pattern');
	   }elseif($background_style == 'Custom Image'){
			$background_id = get_option(THEME_NAME_S.'_background_custom');
			if(!empty($background_id)){ 
				$background_image = wp_get_attachment_image_src( $background_id, 'full' );
				echo ' html{ background: url("'.$background_image[0] . '")};';
			}
		}
	   else if($background_style == 'Pattern'){
       $background_pattern = get_option(THEME_NAME_S.'_background_pattern','1');
		?>
        
        html{
			background-image: url('<?php echo CP_THEME_PATH_URL; ?>/images/pattern/pattern-<?php echo $background_pattern; ?>.png');
			background-repeat: repeat; 
            position:relative;
		}
            <?php
	}
?>
 
 
/* If User Login
   ------------------------------------------------------------------ */

<?php  if ( is_user_logged_in() ) { ?>
  html {
    margin-top: 28px !important;
    position: relative;
}
<?php  } ?>

           
            <?php $primary_color = get_option(THEME_NAME_S.'master_color','#00d8ff'); 
             $hex = $primary_color; list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x"); $primary_color_rgb = "$r , $g , $b";
 ?>
            <?php $secondary_color = get_option(THEME_NAME_S.'secondary_color','#A39B79'); 
                  $hex = $secondary_color; list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x"); $secondary_color_rgb = "$r , $g , $b";
 ?>
            <?php $heading_color = get_option(THEME_NAME_S.'_default_heading_color','#A39B79');  ?>
            <?php $link_color = get_option(THEME_NAME_S.'_default_link_color','#333333');  ?>
            <?php $overall_color = "#00d8ff"/*get_option(THEME_NAME_S.'_default_overall_color','#CBC39F');*/  ?>
            
     <?php
    
	 
	 // Other Colors
	 $border_color = get_option(THEME_NAME_S.'border_color','#00d8ff');
     $button_bg_color = get_option(THEME_NAME_S.'button_bg_color','#00D8FF');
	 $button_text_color = get_option(THEME_NAME_S.'button_text_color','#000000');
  	 $button_bg_hover_color = get_option(THEME_NAME_S.'button_bg_hover_color','#006c7f');
	 $button_text_hover_color = get_option(THEME_NAME_S.'button_text_hover_color','#fffff');
	 
	
?>   
.tagcloud a:hover { color: #333 !important; text-decoration: none; background-color: <?php echo $primary_color; ?>; }
/*
==============================================
					TEXT COLOR
==============================================
*/

.color, .fa-twitter, .tweets .tweet-link, ul.views li, ul.views li a, input[type="text"]:focus, .more:hover, .v-gallery p.color a, .copyrights a, .video-status ul li i, .video-status ul li a:hover, .video-status ul li a, ul.members .thumb h3, ul.members .thumb h3 small, .pagination ul li a:hover, .group-directory p.color, .error-404 h1, #carousel .caption:after {
	color: <?php echo $primary_color; ?>;
}

/*
==============================================
				BACKGROUND COLOR
==============================================
*/
.bg-color, .main-navigation ul li a:hover, .main-navigation ul ul, .main-navigation ul li:hover > a, .caption, .jspTrack, .jspHorizontalBar, .video-heading, .h-style, .jcarousel-skin-tango .jcarousel-next-horizontal:hover, .jcarousel-skin-tango .jcarousel-next-horizontal:focus, .search-widget button, .nav-tabs > .active > a,
.nav-tabs > .active > a:hover, .nav-tabs > .active > a:focus, .nav > li > a:hover, .nav > li > a:focus, .nav > li > a:active, .blog-post i.post-icon, .load-more, .jcarousel-skin-tango .jcarousel-prev-horizontal:hover, .jcarousel-skin-tango .jcarousel-prev-horizontal:focus, .categories-widget ul li a:hover, .tags-widget ul li a:hover, ul.list li:before, .reply, .comments ul ul li:after, .comments ul li:after, .form-btn, .community-status ul li:hover, .group-directory header a, .error-404 a, .main-navigation .btn, .sigin a:hover, .flex-direction-nav a, .product-listing .text{
	background-color: <?php echo $primary_color; ?>;
}
.footer-widgets ul li:hover { background-color: <?php echo $primary_color; ?>; }
#buddypress ul.item-list li:hover { background: #eee; }

/*
==============================================
				BORDER COLOR
==============================================
*/
.border-color, .video-container h3, .header-style, .small-thumbs ul li, input[type="text"]:focus, textarea:focus, .tabs-widget .nav-tabs, .poted-by, .footer, .v-gallery .thumb img:hover, .widget-papuler-video ul li:hover img, .video-status ul, .video-status ul li, ul.members .thumb, .group-directory ul li, .recent-members ul li:hover img, .group-directory ul ul li:first-child, .group-directory ul ul li, .videos li, .banner #carousel.flexslider li, .recent-replies ul li, .flickr_badge_image img:hover{
	border-color: <?php echo $primary_color; ?>;
}	
#buddypress ul.item-list li, #buddypress ul.item-list, .nav-tabs { border-color: <?php echo $primary_color; ?> !important; }    
/** Typography
**********************************/    

 	 h1, h2, h3, h4, h5, h6, .cp-title, .b-post h3 a, .main-slider .cp-title > a , .testimonials .title span, .wellcome-msg p, .testimonials .title span, .author-det-box .title2 , .cart-btn2 a, div.product .product_title, #     content div.product .product_title { color:<?php echo $section_heading_color;  ?> }
    .page-title h2 { color:<?php echo $page_title_color;  ?> !important; }
	.page-title h2 a:hover { color:<?php echo $page_title_hover_color;  ?>; }
     body {color: <?php echo $body_text_color; ?>;} 
	 .testi-text p:before, .testi-text p:after { color: #fff; }
     a { color: <?php echo $link_color;  ?>; }
     ul.tags li a:hover, .blog-content a, .sidebar a:hover  { color: <?php echo $primary_color;  ?>; }
     .blog-content a:hover {text-decoration:underline;}
     a:hover, ul.tags li a:hover { color: <?php echo $link_hover_color;  ?>; }
    .about-us h4, .title-holder h3, .title-holder h3, .title-holder h2 { color: <?php echo $section_subheading_color ?>; }
	.feature_title h2 span, #footer .widget h4, .blog_meta,  .chart .label, .ico_list p, .our-team h5 { color: <?php echo $section_subheading_color ?>; }
  	a, .comment-author a, .comment-author { color: <?php echo $section_subheading_color ?>; }
	a.comment-reply-link { color: <?php echo $link_hover_color ?> !important; }
	.error-page h2, .error-page h3 { color: <?php echo $section_subheading_color ?>; }
	.hover_info .gallery > a { color: <?php echo $section_subheading_color ?>; }
	
/** Other Elements
**********************************/	
	.hinner { border-bottom: 2px solid <?php echo $border_color ?> !important; }
	#featured_work .testimonial { border-top: 2px solid <?php echo $border_color ?>; }
	.contact-widget-submit, .cp-button, .btn, #submit, .button, .comment-reply-link {  padding: 5px 18px; border:none !important;  transition: all 0.5s ease 0s; background-color:<?php echo $button_bg_color;  ?>; color:<?php echo $button_text_color; ?>; }
    
    #buddypress button, #buddypress a.button, #buddypress input[type="submit"], #buddypress input[type="button"], #buddypress input[type="reset"], #buddypress ul.button-nav li a, #buddypress div.generic-button a, #buddypress .comment-reply-link, a.bp-title-button {  padding: 5px 18px; border:none !important;  transition: all 0.5s ease 0s; background-color:<?php echo $button_bg_color;  ?> !important; color:<?php echo $button_text_color; ?> !important;  }
#buddypress a.bp-primary-action span, #buddypress #reply-title small a span {background:#333 !important;}
#buddypress button:hover, #buddypress a.button:hover, #buddypress a.button:focus, #buddypress input[type="submit"]:hover, #buddypress input[type="button"]:hover, #buddypress input[type="reset"]:hover, #buddypress ul.button-nav li a:hover, #buddypress ul.button-nav li.current a, #buddypress div.generic-button a:hover, #buddypress .comment-reply-link:hover, .comment-reply-link:hover {transition: all 0.5s ease 0s; background-color:<?php echo $button_bg_hover_color;  ?>!important; color:<?php echo $button_text_hover_color; ?>!important;}
	.contact-widget-submit:hover, .cp-button:hover, .btn:hover, #submit:hover, .button:hover { transition: all 0.5s ease 0s; background-color:<?php echo $button_bg_hover_color;  ?>; color:<?php echo $button_text_hover_color; ?>;}
	.cp-button, .btn, #submit, .button { background-position: right center; }
 	a.cp-button, input[type="submit"], input[type="reset"], input[type="button"], .shop-btn a {
		background-color: <?php echo $button_bg_color; ?>;
		color: <?php echo $button_text_color; ?>;
		border: medium none;
		padding: 8px 20px;
	}
	
	a.cp-button:hover, input[type="submit"]:hover, input[type="reset"]:hover, input[type="button"]:hover, .shop-btn a {
		background-color: <?php echo $button_bg_hover_color; ?>;
		color: <?php echo $button_text_hover_color; ?>;
	}
	
	
	.post-password-form input {margin-top:20px; }
	.post-password-form input[type="submit"] {margin-top:10px;}
	
	
	  	
 /** Footer Stlying
**********************************/    
 
    #footer .widget h4 { color: <?php echo $footer_title_color ?> ; } 
	#copyright a, #copyright a:hover , #copyright, #copyright p { color:#777777; }
	footer input, footer button { background:<?php echo $footer_button_color ?> !important;  color:<?php echo $footer_button_text_color ?> !important; }
	footer input[type="submit"] :hover, footer button:hover { background:<?php echo $footer_button_hover_color ?> !important ;  color:<?php echo $footer_button_hover_text_color ?> !important; }

    .footer, .footer p, #copyright, #footer .widget { color: <?php echo $footer_text_color ?> ; }
    .footer a, .footer i, #footer .widget a {color: <?php echo $footer_link_color ?> ; }
    .footer a:hover, #copyright a:hover { color: <?php echo $footer_link_hover_color ?> ; }	
	
	/*Team Block*/
	.project_heading { background: none repeat scroll 0 0 rgba(<?php echo $primary_color_rgb ?>, 0.5); }
	

	#wp-calendar a { color: <?php echo $primary_color;  ?>; }

	.post-widget-meta > a, .twtr-wdgt-sidbar ul li span {color:<?php echo $primary_color ?> !important;}


 
/* RTL funtion
   ------------------------------------------------------------------ */
<?php  $rtl = get_option ( THEME_NAME_S . '_rtl', 'disable' ); ?>
<?php if ($rtl== "enable") { ?>


     html {position:relative;}
	 body, .feature_title h2, #filter ul li a, .support_title h2, .blog-content {
     	text-align:right !important; 
     }
	.post-comments-top, #nav .navbar .nav, #nav_info, .socialicons {
    	float:left !important;
    }
    #nav_info {
        padding-left:10px !important;
    }
    .navbar-inner {
        padding-left:  0px !important;
	}
    .span3.logo-wrapper, .support_title ul {
       float:right !important;
    }
    .bx-wrapper .bx-controls-direction a, .flex-direction-nav li a, #email_ico, .slider-wrapper .nivoSlider a {
      font-size:0px !important;
    }
	select, textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input {
	text-align:right !important;	
	}
<?php }?>
  
	
 
/* Font Size
   ------------------------------------------------------------------ */

h1{
	font-size: <?php echo get_option(THEME_NAME_S.'_h1_size', '30'); ?>px;
}
h2{
	font-size: <?php echo get_option(THEME_NAME_S.'_h2_size', '25'); ?>px;
}
h3{
	font-size: <?php echo get_option(THEME_NAME_S.'_h3_size', '20'); ?>px;
}
h4{
	font-size: <?php echo get_option(THEME_NAME_S.'_h4_size', '18'); ?>px;
}
h5{
	font-size: <?php echo get_option(THEME_NAME_S.'_h5_size', '16'); ?>px;
}
h6{
	font-size: <?php echo get_option(THEME_NAME_S.'_h6_size', '15'); ?>px;
}

#nav .navbar .nav > li > a {
   font-family: <?php echo substr(get_option('_menu_font'), 2); ?> !important;
}

/* Font Family 
  ------------------------------------------------------------------ */
body{
	font-family: <?php echo substr(get_option('cp_content_font'), 2); ?>;
	font-size: <?php echo get_option(THEME_NAME_S.'_content_size', '14'); ?>px;
}
<?php $cp_header_font = substr(get_option('cp_header_font'), 2); 
      $cp_menu_font = substr(get_option('_menu_font'), 2); 
      $default_header_font = "'Oswald',sans-serif";
?>


h1, h2, h3, h4, h5, h6, .cp-title, .adv_banner h4, .adv_banner p, .architec-btn, .time_line .cname, .time_line .cnamei, .font-family, .calendar , .top-slider .cp-slider-title, .top-slider p, #filter ul li a, .feature h4, .feature_title h2, .title-holder h2, #footer .widget h4, .faq_accordion h3 strong, .about-us h4, .title-holder h3, .title-holder h3, .our-team h4, .abilities_tab li a, .service-product ul li a, .view_more, .service-feature h4, .support_title h2, .right-sidebar h4, .comment-author a, .comment-author, .comment-date, .comment-reply, .logged-in-as, .support_title ul li, .title-holder h4, .blog_summary h3, .blog_summary h3 a, .blog_meta, .blog_summary_footer span, .blog_summary_footer span a, .title-holder-1 h4, #client_header h4, .timeline-logos p, a.cp-button, .message-box-title, .post-title a{
	
      	font-family: <?php echo $cp_header_font ?> !important;
	}


.sf-menu a,.navbar .nav > li > a {
    font-family: <?php echo substr(get_option('cp_menu_font'), 2); ?>; !important ;

}

#nav a, .top-nav a, .user-login-link{ font-family: <?php echo substr(get_option('cp_menu_font'), 2); ?>; !important }

#wp-calendar td, #wp-calendar th, .post h4, .tech-text, ul#nav, .box, .footer-tweet, .box h5, .right-heading span, .worship, .vies-calender, .news-heading, ul.pagination, .prayer-box, .posted, .prayer-heading, .prayer-heading span, .share-request, .blog-holder, .post-title, .blog-date, .title, .txt-widget, .txt-widget h4, .btn, .name, .map-view, .event-comment, .comment-post li, .blog-comments, .add-comment, .post-heading, .tags a, ul.tabs-content, div.comment-wrapper #reply-title, h3.accordion-header-title, div.blog-item-holder .blog-item2 .post-title, div.contact-form-wrapper ol li input, div.contact-form-wrapper textarea, .detail, .inner-heading, .event-slider-caption .left, .info-heading, .event-slider-button, #wp-calendar caption {
   font-family: <?php echo substr(get_option('cp_header_font'), 2); ?>;
}  

html, body, div, span, applet, object, iframe, p, blockquote, pre, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, embed, figure, figcaption, footer, header, hgroup, menu, nav, output, ruby, section, summary, time, mark, audio, video, .wellcome-msg p {
   font-family: <?php echo substr(get_option('cp_content_font'), 2); ?>;
}


/* load custom css
   ------------------------------------------------------------------ */


<?php $custom_style = get_option(THEME_NAME_S.'_custom_styling'); ?>

<?php echo $custom_style ?>