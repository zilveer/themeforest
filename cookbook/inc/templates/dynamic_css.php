<?php 

/******************************************************************************
INDEX

		THEME COLOURS
		FONTS
		OTHER DYNAMIC OPTIONS
		FINAL CALL CSS

*******************************************************************************/

	function canon_dynamic_css() {
			

		$canon_options = get_option('canon_options');
		$canon_options_frame = get_option('canon_options_frame');
		$canon_options_appearance = get_option('canon_options_appearance');
		$canon_options_advanced = get_option('canon_options_advanced');

	    // dev mode options
	    if ($canon_options['dev_mode'] == "checked") {
	        if (isset($_GET['anim_menus'])) { $canon_options_appearance['anim_menus'] = wp_filter_nohtml_kses($_GET['anim_menus']); }
	    }
		

 ?>

	<style type="text/css">
	

		/******************************************************************************
		THEME COLOURS
		
		01. Body Background
		02. Main Plate Background
		03. General Body Text
		04. Body Link Text
		05. Body Link Text Hover
		06. Main Headings
		07. Secondary Body Text
		08. Logo as Text
		09. Pre Header Background
		10. Pre Header Text
		11. Pre Header Text Hover
		12. Pre Header Tertiary Menu
		13. Header Background
		14. Header Text
		15. Header Text Hover
		16. Header 2nd Menu
		17. Header 3rd menu
		18. Post Header Background
		19. Post Header Text
		20. Post Header Text Hover
		21. Post Header Tertiary Menu
		22. Sidr Block Background
		23. Sidr Block Text
		24. Block Headings Background
		25. Block Headings 2 Background
		26. Feature Text Color 1
		27. Quotes Text
		28. White Text
		29. Button Color 1
		30. Button Color 1 Hover
		31. Light Blocks Background
		32. Featured Title Background
		33. Menu Border Color
		34. Main Border Color
		35. Form Elements
		36. Pre Footer Background
		37. Pre Footer Text Color
		38. Pre Footer Text Hover
		39. Footer Background
		40. Footer Text Color
		41. Footer Text Hover
		42. Footer Text Color 2
		43. Footer Border Color
		44. Secondary Footer Block
		45. Baseline
		46. Baseline Text
		47. Baseline Text Hover
		
		*******************************************************************************/
		
		

		/* 
		01. BODY BACKGROUND ________________________________________________________ */
		html{
			<?php if ($canon_options_appearance['color_page_bg'] != "#f1f1f1") echo "background-color: ".$canon_options_appearance['color_page_bg'].";"; ?> 
		}
		
		
	
	
		/* 
		02. MAIN PLATE BACKGROUND __________________________________________________ */
		.outter-wrapper, 
		.text-seperator-line h5, 
		.comment-num, 
		fieldset.boxy fieldset, 
		.mosaic-backdrop,
		ul.graphs > li, 
		ul.review-graph > li .rate-span, 
		ul.comments .even, 
		.maintenance_notice, 
		.text-seperator-line .btn, 
		.text-seperator-line .btn:hover,
		
		/* WOO COMMERCE */
		.woocommerce #payment div.payment_box, 
		.woocommerce-page #payment div.payment_box, 
		.woocommerce div.product .woocommerce-tabs ul.tabs li.active, 
		.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active, 
		.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active, 
		.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active,
		
		/* ROYAL SLIDER */
		.Canon_Slider_1 .rsThumb.rsNavSelecteds, 
		.Canon_Slider_3 .rsThumb.rsNavSelected, 
		.Canon_Slider_1 .rsThumb:nth-child(odd),
		
		/* VC SUPPORT */
		.wpb_tabs .wpb_tabs_nav li.ui-tabs-active, 
		.wpb_tabs .wpb_tabs_nav li.ui-tabs-active:hover,
		
		/* BUDDYPRESS */
		#buddypress div.item-list-tabs ul li.selected, 
		#buddypress div.item-list-tabs ul li.current, 
		#buddypress div.item-list-tabs ul li.selected a, 
		#buddypress div.item-list-tabs ul li.current a, 
		#buddypress .item-list-tabs.activity-type-tabs ul li.selected, 
		#bbpress-forums div.odd, #bbpress-forums ul.odd,
		
		/* EVENTS CALENDAR */
		.tribe-events-list-separator-month span, 
		.single-tribe_events .tribe-events-schedule .tribe-events-cost, 
		.tribe-events-sub-nav li a, 
		.tribe-events-calendar .tribe-events-tooltip, 
		.tribe-events-week .tribe-events-tooltip, 
		.recurring-info-tooltip  {
			<?php if ($canon_options_appearance['color_body_bg'] != "#ffffff") echo "background-color: ".$canon_options_appearance['color_body_bg'].";"; ?> 
		}	
		
		
		
		
		
		/* 
		03. GENERAL BODY TEXT ______________________________________________________ */
		html, 
		button, 
		input, 
		select, 
		textarea, 
		.comment-num,
		
		 /* EVENTS CALENDAR */
		.tribe-events-calendar .tribe-events-tooltip, 
		.tribe-events-week .tribe-events-tooltip, 
		.recurring-info-tooltip 
		{ 
			<?php if ($canon_options_appearance['color_general_text'] != "#222222") echo "color: ".$canon_options_appearance['color_general_text'].";"; ?>
		}
			
	
	
	
	
		/* 
		04. BODY LINK TEXT _________________________________________________________ */
		.body-wrapper a, 
		.boxy blockquote cite, 
		ul.comments li .more a:nth-child(2):before, 
		  
		/* VC SUPPORT */
		.wpb_toggle, 
		.text-seperator-line a.btn:hover, 
		.text-seperator-line a.btn, 
		.widget.woocommerce ul.product-categories li:before{
			 <?php if ($canon_options_appearance['color_body_link'] != "#222222") echo "color: ".$canon_options_appearance['color_body_link'].";"; ?>
		}






		/* 
		05. BODY LINK TEXT HOVER ___________________________________________________ */
		.body-wrapper a:hover, 
		ul.tab-nav li:hover, a.title:hover *, 
		a:hover *, 
		.link-multipages a:hover,
		.text-seperator-line h5,
		 
		/* VC SUPPORT */
		.wpb_toggle:hover, 
		.wpb_tour_tabs_wrapper 
		.wpb_tabs_nav li a:hover, 
		.text-seperator-line a.btn:hover,
		
		/* WOOCOMMERCE */
		.woocommerce nav.woocommerce-pagination ul li span.current, 
		.woocommerce nav.woocommerce-pagination ul li a:hover, 
		.woocommerce nav.woocommerce-pagination ul li a:focus, 
		.woocommerce #content nav.woocommerce-pagination ul li span.current, 
		.woocommerce #content nav.woocommerce-pagination ul li a:hover, 
		.woocommerce #content nav.woocommerce-pagination ul li a:focus, 
		.woocommerce-page nav.woocommerce-pagination ul li span.current, 
		.woocommerce-page nav.woocommerce-pagination ul li a:hover, 
		.woocommerce-page nav.woocommerce-pagination ul li a:focus, 
		.woocommerce-page #content nav.woocommerce-pagination ul li span.current, 
		.woocommerce-page #content nav.woocommerce-pagination ul li a:hover, 
		.woocommerce-page #content nav.woocommerce-pagination ul li a:focus,
		
		/* ROYAL SLIDER */
		.canonSlider .feat-title h6.meta a:hover,
		
		/* BBPRESS */
		#bbpress-forums #bbp-single-user-details #bbp-user-navigation li.current a,
		
		/* EVENTS CALENDAR */
		.tribe-events-list-separator-month span, 
		.tribe-events-sub-nav li a, 
		.tribe-events-tooltip .date-start.dtstart, 
		.tribe-events-tooltip .date-end.dtend, 
		.single-tribe_events .tribe-events-schedule .tribe-events-cost, 
		.tribe-bar-active a    {
			 <?php if ($canon_options_appearance['color_body_link_hover'] != "#c3ad70") echo "color: ".$canon_options_appearance['color_body_link_hover'].";"; ?>	
		}
		
		
		
		
		
		
		/* 
		06. MAIN HEADINGS TEXT ___________________________________________________ */
		h1, h2, h3, h4, h5, h6,
		
		/* WOO COMMERCE */
		.woocommerce ul.products li.product .price, 
		.woocommerce-page ul.products li.product .price, 
		.woocommerce table.cart a.remove:hover, 
		.woocommerce #content table.cart a.remove:hover, 
		.woocommerce-page table.cart a.remove:hover, 
		.woocommerce-page #content table.cart a.remove:hover, 
		.summary.entry-summary .price span,  
		.woocommerce div.product .woocommerce-tabs ul.tabs li a, 
		.woocommerce #content div.product .woocommerce-tabs ul.tabs li a, 
		.woocommerce-page div.product .woocommerce-tabs ul.tabs li a, 
		.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a, 
		mark,
		
		/* BBPRESS*/
		#bbpress-forums .bbp-forum-title, 
		#bbpress-forums .bbp-topic-permalink,
		
		/* BUDDYPRESS */
		#buddypress .activity-meta a.bp-primary-action span,
		
		/* EVENTS CALENDAR */
		.single-tribe_events .tribe-events-schedule * {
			 <?php if ($canon_options_appearance['color_body_headings'] != "#222222") echo "color: ".$canon_options_appearance['color_body_headings'].";"; ?>
		}
		
		
		
		
		
		/* 
		07. SECONDARY BODY TEXT ___________________________________________________ */
		.cookbook_more_posts .meta, 
		.tweet .meta, 
		.post-date, 
		.rss-date, 
		.review-box .star-rating, 
		.multi_navigation_hint,
		 p.link-pages
		
		/* WOO COMMERCE */
		 .woocommerce-result-count, 
		 .woocommerce ul.products li.product .price del, 
		 .woocommerce-page ul.products li.product .price del, 
		 .summary.entry-summary .price del span,  
		 .woocommerce .cart-collaterals .cart_totals p small, 
		 .woocommerce-page .cart-collaterals .cart_totals p small, 
		 .woocommerce .star-rating:before, 
		 .woocommerce-page .star-rating:before,
		 
		 /* BBPRESS*/
		   .bbp-forum-header a.bbp-forum-permalink, 
		   .bbp-topic-header a.bbp-topic-permalink, 
		   .bbp-reply-header a.bbp-reply-permalink,
		   #bbpress-forums .bbp-topic-header .bbp-meta a.bbp-topic-permalink, 
		   #bbpress-forums #bbp-single-user-details #bbp-user-navigation a,
		 
		 /* BUDDYPRESS */
		   #buddypress div#item-header div#item-meta,
		 
		 /* EVENTS CALENDAR */
		   .tribe-events-sub-nav li a:hover, 
		   .tribe-events-event-meta .tribe-events-venue-details, 
		   .tribe-events-thismonth div:first-child, 
		   .tribe-events-list-widget ol li .duration,
		   .tribe-bar-views-list li:before {
			<?php if ($canon_options_appearance['color_general_text_2'] != "#adadad") echo "color: ".$canon_options_appearance['color_general_text_2'].";"; ?>	
		}





		/* 
		08. LOGO AS TEXT ___________________________________________________________ */
		.outter-wrapper .logo.logo-text a{
			 <?php if ($canon_options_appearance['color_logo_text'] != "#222222") echo "color: ".$canon_options_appearance['color_logo_text'].";"; ?>
		}

		
		
		
		
		/* 
		09. PRE HEADER BLOCK BACKGROUND ____________________________________________ */
		.outter-wrapper.pre-header-container,
		.pre-header-container .nav ul, 
		.outter-wrapper.search-header-container{
			<?php if ($canon_options_appearance['color_prehead_bg'] != "#4c565c") echo "background-color: ".$canon_options_appearance['color_prehead_bg'].";"; ?> 
		}
		
		
		
		
		
		/* 
		10. PRE HEADER BLOCK TEXT __________________________________________________ */
		.pre-header-container, 
		.pre-header-container *, 
		.pre-header-container a, 
		.pre-header-container a *, 
		.pre-header-container .hasCountdown *  {
			<?php if ($canon_options_appearance['color_prehead'] != "#ffffff") echo "color: ".$canon_options_appearance['color_prehead'].";"; ?>
		}
		
		
		
		
		/* 
		11. PRE HEADER BLOCK TEXT HOVER ______________________________________________ */
		.pre-header-container a:hover, .pre-header-container a:hover *,
		.pre-header-container li.current-menu-ancestor > a, 
		.pre-header-container .sub-menu li.current-menu-ancestor > a:hover,  
		.pre-header-container li.current-menu-item > a{
			<?php if ($canon_options_appearance['color_prehead_hover'] != "#c3ad70") echo "color: ".$canon_options_appearance['color_prehead_hover'].";"; ?>
		}
		
		
		
		
		
		/* 
		12. PRE HEADER TERTIARY MENU BACKGROUND _________________________________________________ */
		.pre-header-container ul ul.sub-menu ul.sub-menu, 
		.pre-header-container ul li:hover ul ul:before{
		   	<?php if ($canon_options_appearance['color_third_prenav'] != "#333d43") echo "background-color: ".$canon_options_appearance['color_third_prenav'].";"; ?>
		}
		
		
		
		
		
		/* 
		13. HEADER BLOCK BACKGROUND ____________________________________________ */
		.outter-wrapper.header-container, 
		.header-container .nav ul {
			<?php if ($canon_options_appearance['color_head_bg'] != "#ffffff") echo "background-color: ".$canon_options_appearance['color_head_bg'].";"; ?> 
		}
		
		
		
		
		/* 
		14. HEADER BLOCK TEXT __________________________________________________ */
		.header-container, 
		.header-container *, 
		.header-container a, 
		.header-container a *, 
		.header-container .hasCountdown *{
			<?php if ($canon_options_appearance['color_head'] != "#222222") echo "color: ".$canon_options_appearance['color_head'].";"; ?>
		}
		
		
		
		
		
		/* 
		15. HEADER BLOCK TEXT HOVER ________________________________________________ */
		.header-container a:hover, 
		.header-container a:hover *,
		.header-container li.current-menu-ancestor > a,
		.header-container li.current-menu-ancestor.fa:before,
		.header-container li.current-menu-item.fa:before,
		.header-container li:hover.fa:before, 
		.header-container .sub-menu li.current-menu-ancestor > a:hover,  
		.header-container li.current-menu-item > a{
			<?php if ($canon_options_appearance['color_head_hover'] != "#c3ad70") echo "color: ".$canon_options_appearance['color_head_hover'].";"; ?>
		}
		



		/* 
		16. HEADER CONTAINER 2nD MENU  __________________________________________________ */
		.header-container .nav li ul:before,
		.header-container .nav li ul{
		     <?php if (!empty($canon_options_appearance['color_header_menus_2nd'])) echo "background-color: ".$canon_options_appearance['color_header_menus_2nd'].";"; ?>   
		}
		
		
		
		
		
		/* 
		17. HEADER CONTAINER 3RD MENU  __________________________________________________ */ 
		.header-container .nav li:hover ul ul, 
		.header-container .nav li:hover ul ul:before{
			<?php if (!empty($canon_options_appearance['color_header_menus'])) echo "background-color: ".$canon_options_appearance['color_header_menus'].";"; ?>
		}
		
		
		
		
		
		/* 
		18. POST HEADER BLOCK BACKGROUND ______________________________________________ */
		.outter-wrapper.post-header-container, 
		.post-header-container .nav ul{
			<?php if ($canon_options_appearance['color_posthead_bg'] != "#1f272a") echo "background-color: ".$canon_options_appearance['color_posthead_bg'].";"; ?> 
		}
		
		
		
		
		/* 
		19. POST HEADER BLOCK TEXT ____________________________________________________ */
		.post-header-container, 
		.post-header-container *, 
		.post-header-container a, 
		.post-header-container a *, 
		.post-header-container .hasCountdown * {
			<?php if ($canon_options_appearance['color_posthead'] != "#ffffff") echo "color: ".$canon_options_appearance['color_posthead'].";"; ?>
		}
		
		
		
		
			
		/* 
		20. POST HEADER BLOCK TEXT HOVER____________________________________________________ */
		.post-header-container a:hover, 
		.post-header-container a:hover *,
		.post-header-container li.current-menu-ancestor > a, 
		.post-header-container .sub-menu li.current-menu-ancestor > a:hover,  
		.post-header-container li.current-menu-item > a,
		.post-header-container .toolbar-search-btn *:hover  {
			<?php if ($canon_options_appearance['color_posthead_hover'] != "#c3ad70") echo "color: ".$canon_options_appearance['color_posthead_hover'].";"; ?>
		}
		
		
		
		
		
		/* 
		21. POST TERTIARY MENU BACKGROUND _________________________________________________ */
		.post-header-container .nav li:hover ul ul, 
		.post-header-container .nav li:hover ul ul:before{
		   	<?php if (!empty($canon_options_appearance['color_third_postnav'])) echo "background-color: ".$canon_options_appearance['color_third_postnav'].";"; ?>
		}
			
		
		
		
		
		
		/* 
		21. HEADER IMAGE TEXT _________________________________________________ */
		.pre-header-container.image-header-container .header_img_text *,
		.header-container.image-header-container .header_img_text *,
		.post-header-container.image-header-container .header_img_text *{
			<?php if ($canon_options_appearance['color_header_image'] != "#ffffff") echo "color: ".$canon_options_appearance['color_header_image'].";"; ?>
		}
		
		
		
		
		
		
		/* 
		22. SIDR BLOCK BACKGROUND ______________________________________________ */
		.sidr, 
		.ui-autocomplete li{
			<?php if ($canon_options_appearance['color_sidr_block'] != "#20272b") echo "background-color: ".$canon_options_appearance['color_sidr_block'].";"; ?> 
		}
		
		
		
		
		
		/* 
		23. SIDR MENU TEXT ______________________________________________________ */
		.sidr a, 
		.ui-autocomplete li a,
		.ui-autocomplete li{
			<?php if ($canon_options_appearance['color_menu_text_1'] != "#ffffff") echo "color: ".$canon_options_appearance['color_menu_text_1'].";"; ?>
		}
		
		
		
		
		/* 
		24. BLOCK HEADINGS BACKGROUND ______________________________________________ */
		.tab-nav li.active, 
		h3.v_nav.v_active, 
		.text-seperator-bar, 
		.widget_calendar caption {
			<?php if ($canon_options_appearance['color_block_headings'] != "#20272b") echo "background-color: ".$canon_options_appearance['color_block_headings'].";"; ?> 
		}
		
		
		
		
		
		/* 
		25. 2ND BLOCK HEADINGS BACKGROUND ______________________________________________ */
		.tab-nav li, 
		h3.v_nav, 
		.text-seperator-bar .btn:hover {
			<?php if ($canon_options_appearance['color_block_headings_2'] != "#4c565c") echo "background-color: ".$canon_options_appearance['color_block_headings_2'].";"; ?> 
		}
		
		
		
		
		/* 
		26. FEATURE TEXT COLOR 1 ______________________________________________________ */
		.feat-1, 
		.feat-1 *, 
		.feat-1 a, 
		a.feat-1, 
		.sidr a:hover, 
		.breadcrumb-wrapper a:hover, 
		.breadcrumb-wrapper a:hover *, 
		h1 span, 
		h2 span, 
		h3 span, 
		blockquote cite, 
		a.feat-title:hover, 
		ul.comments .meta a, 
		.paging .meta, 
		.paging .col-1-2:before, 
		.paging .col-1-2:after, 
		nav li.fa:before, 
		.logo.logo-text a:hover, 
		.canon_animated_number h1.super, 
		.statistics li em, 
		.page-numbers .current, 
		.sticky:before, 
		a.toggle-btn.active:after, 
		a.accordion-btn.active:after, 
		a.sc_toggle-btn.active:after, 
		a.sc_accordion-btn.active:after, 
		a.toggle-btn.active, 
		a.accordion-btn.active, 
		a.sc_toggle-btn.active, 
		a.sc_accordion-btn.active, 
		.cookbook_fact h4.fittext, 
		ol > li:before, 
		div.widget ul li:before,
		.post ul li:before, 
		.link-multipages a,
		.tc-info-box ul.tc-info-box-ul li:before,
		.widget_tag_cloud .tagcloud a:before,
		.page-numbers.current,
		.ui-autocomplete li.ui-state-focus,
		  
		/* VC SUPPPORT */
		.wpb_toggle_title_active, 
		.wpb_tour .wpb_tabs_nav li.ui-tabs-active a, 
		.ui-accordion-header-active a,
		
		/* WOO COMMERCE */
		.shipping_calculator h2 a, 
		.woocommerce table.cart a.remove, 
		.woocommerce #content table.cart a.remove, 
		.woocommerce-page table.cart a.remove, 
		.woocommerce-page #content table.cart a.remove, 
		.woocommerce form .form-row .required, 
		.woocommerce-page form .form-row .required, 
		.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover, 
		.woocommerce #content div.product .woocommerce-tabs ul.tabs li a:hover, 
		.woocommerce-page div.product .woocommerce-tabs ul.tabs li a:hover, 
		.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a:hover, 
		.woocommerce .star-rating span:before, 
		.woocommerce-page .star-rating span:before, 
		.woocommerce div.product .stock, 
		.woocommerce #content div.product .stock, 
		.woocommerce-page div.product .stock, 
		.woocommerce-page #content div.product .stock, 
		.woocommerce div.product .out-of-stock, 
		.woocommerce #content div.product .out-of-stock, 
		.woocommerce-page div.product .out-of-stock,
		.woocommerce-page #content div.product .out-of-stock,
		
		/* ROYAL SLIDER */
		.canonSlider .feat-title h6.meta, 
		.canonSlider .feat-title h6.meta a, 
		.canonSlider .rsThumb.rsNavSelected h3, 
		.canonSlider .rsThumb h6, 
		.canonSlider .rsThumb h6 a,
		
		/* BBPRESS*/
		#bbpress-forums .bbp-forum-title:hover, 
		#bbpress-forums .bbp-topic-permalink:hover, 
		.bbp-forum-header a.bbp-forum-permalink:hover, 
		.bbp-topic-header a.bbp-topic-permalink:hover, 
		.bbp-reply-header a.bbp-reply-permalink:hover, 
		#bbpress-forums .bbp-topic-header .bbp-meta a.bbp-topic-permalink:hover, 
		#bbpress-forums #bbp-single-user-details #bbp-user-navigation li a:hover, 
		.widget_display_stats dl dd strong,
		
		/* BUDDYPRESS */
		#buddypress div.item-list-tabs ul li.selected a, 
		#buddypress div.item-list-tabs ul li.current a,
		
		/* EVENTS CALENDAR */
		#tribe-bar-collapse-toggle:hover {
			<?php if ($canon_options_appearance['color_feat_text_1'] != "#c3ad70") echo "color: ".$canon_options_appearance['color_feat_text_1'].";"; ?>
		}
		
		
		
		
		
		/* 
		27. QUOTES TEXT ______________________________________________________________ */
		.boxy blockquote, 
		blockquote{
			<?php if ($canon_options_appearance['color_quotes'] != "#555f64") echo "color: ".$canon_options_appearance['color_quotes'].";"; ?>
		}
		
		
		
		
		
		/* 
		28. WHITE TEXT _______________________________________________________________ */
		.breadcrumb-wrapper, 
		.breadcrumb-wrapper a, 
		.tab-nav li, 
		h3.v_nav, 
		ol.sc_graphs li,
		.post-tag-cloud li a:hover, 
		.feat-block-1, 
		.feat-block-2, 
		.feat-block-3, 
		.feat-block-4, 
		.feat-block-5, 
		.text-seperator-bar h5, 
		.text-seperator-bar .btn, 
		.text-seperator-bar .btn:hover, 
		.btn, 
		input[type=button], 
		input[type=submit], 
		button, 
		.mosaic-overlay *,
		.search_controls li em, 
		.widget_calendar caption, 
		.flex-direction-nav a, 
		.flex-direction-nav a:hover, 
		.widget_rss .widget-title .rsswidget,
		a.btn, a.btn:hover, 
		.body-wrapper .btn:hover, 
		.body-wrapper .flex-direction-nav a:hover,
		.widget.cookbook_social_links ul.social-links:not(.standard) li a,
		.widget.cookbook_social_links ul.social-links:not(.standard) li a:hover *,
		
		/* VC SUPPORT */
		.wpb_teaser_grid .categories_filter li.active a, 
		 
		/* WOO COMMERCE */
		.woocommerce span.onsale, 
		.woocommerce-page span.onsale,
		
		/* BBPRESS*/
		#bbp_reply_submit, 
		button.button, 
		.bbp-pagination-links a.next.page-numbers, 
		.bbp-pagination-links a.prev.page-numbers, 
		.bbp-logged-in .button.logout-link,
		
		/* BUDDYPRESS */
		#buddypress button, 
		#buddypress a.button, 
		#buddypress input[type="submit"], 
		#buddypress input[type="button"], 
		#buddypress input[type="reset"], 
		#buddypress ul.button-nav li a, 
		#buddypress div.generic-button a, 
		#buddypress .comment-reply-link, 
		a.bp-title-button, 
		#buddypress button:hover, 
		#buddypress a.button:hover, 
		#buddypress input[type="submit"]:hover, 
		#buddypress input[type="button"]:hover, 
		#buddypress input[type="reset"]:hover, 
		#buddypress ul.button-nav li a:hover, 
		#buddypress div.generic-button a:hover, 
		#buddypress .comment-reply-link:hover, 
		a.bp-title-button:hover, 
		#buddypress #profile-edit-form ul.button-nav li a, 
		.bp-login-widget-user-links .bp-login-widget-user-logout a,
		
		/* EVENTS CALENDAR */
		.tribe-events-event-cost span, 
		a.tribe-events-read-more, 
		a.tribe-events-read-more:hover, 
		.tribe-events-list-widget .tribe-events-widget-link a   {
			<?php if ($canon_options_appearance['color_white_text'] != "#ffffff") echo "color: ".$canon_options_appearance['color_white_text'].";"; ?>
		}
		
		
	
		
		
		
		/* 
		29. BUTTON COLOR 1 ____________________________________________________________ */
		.btn, 
		input[type=button],
		input[type=submit],
		button,
		.feat-block-1,
		.search_controls li,
		.post-tag-cloud li a:hover,
		.search_controls li:hover,
		.ui-state-focus,
		  ul.graphs > li .rate-span div,
		 ul.review-graph > li .rate-span div,
		 .widget.cookbook_social_links ul.social-links:not(.standard) li a,
		
		/* VC SUPPORT */
		.wpb_teaser_grid .categories_filter li.active,
		.wpb_button_a .wpb_button.wpb_btn-inverse:hover,
		.vc_btn_black:hover,
		.vc_btn-juicy_pink, 
		a.vc_btn-juicy_pink, 
		button.vc_btn-juicy_pink,
		
		/* WOO COMMERCE */
		.woocommerce a.button, 
		.woocommerce button.button, 
		.woocommerce input.button, 
		.woocommerce #respond input#submit, 
		.woocommerce #content input.button, 
		.woocommerce-page a.button, 
		.woocommerce-page button.button, 
		.woocommerce-page input.button, 
		.woocommerce-page #respond input#submit, 
		.woocommerce-page #content input.button,  
		.woocommerce a.button.alt, 
		.woocommerce button.button.alt, 
		.woocommerce input.button.alt, 
		.woocommerce #respond input#submit.alt, 
		.woocommerce #content input.button.alt, 
		.woocommerce-page a.button.alt, 
		.woocommerce-page button.button.alt, 
		.woocommerce-page input.button.alt, 
		.woocommerce-page #respond input#submit.alt, 
		.woocommerce-page #content input.button.alt, 
		.woocommerce-message:before, 
		.woocommerce .shop_table.cart td.actions .button.alt, 
		.woocommerce .shop_table.cart td.actions .button:hover, 
		.woocommerce .woocommerce-message a.button:hover,
		.widget_price_filter .ui-slider .ui-slider-handle,
		
		/* BBPRESS */
		#bbp_reply_submit, 
		button.button, 
		.bbp-logged-in .button.logout-link,
		.bbp-pagination-links a.next.page-numbers, 
		.bbp-pagination-links a.prev.page-numbers,
		
		/* BUDDYPRESS */
		#buddypress button, 
		#buddypress a.button, 
		#buddypress input[type="submit"], 
		#buddypress input[type="button"], 
		#buddypress input[type="reset"], 
		#buddypress ul.button-nav li a, 
		#buddypress div.generic-button a, 
		#buddypress .comment-reply-link, 
		a.bp-title-button, 
		#buddypress #profile-edit-form ul.button-nav li a, 
		.bp-login-widget-user-logout a,
		
		
		/* EVENTS CALENDAR */
		.tribe-events-list-widget .tribe-events-widget-link a, 
		.tribe-events-read-more, 
		.tribe-events-calendar .tribe-events-has-events:after,
		
		/* GRAVITY FORMS */
		.gf_progressbar_percentage  {
			<?php if ($canon_options_appearance['color_btn_1'] != "#c3ad70") echo "background-color: ".$canon_options_appearance['color_btn_1'].";"; ?> 
		}
		
		
		
		
		
		
		/* 
		30. BUTTON COLOR 1 HOVER ______________________________________________________ */
		.btn:hover,
		input[type=button]:hover, 
		input[type=submit]:hover, 
		button:hover,
		.widget.cookbook_social_links ul.social-links:not(.standard) li a:hover,
		
		/* VC SUPPORT */
		.wpb_button_a .wpb_button.wpb_btn-inverse, 
		.vc_btn_black, 
		.vc_btn-juicy_pink:hover, 
		a.vc_btn-juicy_pink:hover, 
		button.vc_btn-juicy_pink:hover,
		
		/* WOO COMMERCE */
		p.demo_store, 
		.woocommerce a.button:hover,
		.woocommerce button:hover,
		.woocommerce button.button:hover,
		.woocommerce input.button:hover,
		.woocommerce #respond input#submit:hover,
		.woocommerce #content input.button:hover,
		.woocommerce-page a.button:hover,
		.woocommerce-page button.button:hover,
		.woocommerce-page input.button:hover,
		.woocommerce-page #respond input#submit:hover,
		.woocommerce-page #content input.button:hover,
		.woocommerce .shop_table.cart td.actions .button,
		.woocommerce .shop_table.cart td.actions .button.alt:hover,
		.woocommerce .woocommerce-message a.button,
		.product .cart button.single_add_to_cart_button:hover,
		#place_order:hover,
		.woocommerce span.onsale,
		.woocommerce-page span.onsale,
		
		/* BBPRESS */
		#bbp_reply_submit:hover, 
		button.button:hover, 
		.bbp-pagination-links a.next.page-numbers:hover, 
		.bbp-pagination-links a.prev.page-numbers:hover, 
		.bbp-logged-in .button.logout-link:hover,
		
		/* BUDDYPRESS */
		#buddypress button:hover, 
		#buddypress a.button:hover, 
		#buddypress input[type="submit"]:hover, 
		#buddypress input[type="button"]:hover, 
		#buddypress input[type="reset"]:hover, 
		#buddypress ul.button-nav li a:hover, 
		#buddypress div.generic-button a:hover, 
		#buddypress .comment-reply-link:hover, 
		a.bp-title-button:hover, 
		#buddypress #profile-edit-form ul.button-nav li a:hover, 
		.bp-login-widget-user-logout a:hover,
		
		/* EVENTS CALENDAR */
		.tribe-events-read-more:hover, 
		.tribe-events-list-widget .tribe-events-widget-link a:hover,  
		.tribe-events-event-cost span {
			<?php if ($canon_options_appearance['color_btn_1_hover'] != "#20272b") echo "background-color: ".$canon_options_appearance['color_btn_1_hover'].";"; ?>
		}
		
		
	
	
	
	
		/* 
		31. LIGHT BLOCKS BACKGROUND ___________________________________________________ */
		table.table-style-1 tr:nth-child(2n+2),
		table.table-style-1 th,
		fieldset.boxy,
		.message.promo,
		.post-container .boxy,
		.boxy.author,
		ul.comments .odd,
		.post-tag-cloud li a,
		.form-style-2 input[type=text],
		.form-style-2 input[type=email],
		.form-style-2 input[type=password],
		.form-style-2 textarea,
		.form-style-2 input[type=tel],
		.form-style-2 input[type=range],
		.form-style-2 input[type=url],
		.form-style-2 input[type=number],
		.boxy.review-box,
		.comments #respond.comment-respond,
		.tc-info-box,
		
		/* VC SUPPORT */
		.wpb_tour_next_prev_nav span,
		.wpb_tour_next_prev_nav span,
		.wpb_teaser_grid .categories_filter li,
		.wpb_call_to_action,
		.vc_call_to_action,
		.wpb_gmaps_widget .wpb_wrapper,
		.vc_progress_bar .vc_single_bar,
		.wpb_tabs .wpb_tabs_nav li, 
		.wpb_tabs .wpb_tabs_nav li:hover,
		.Canon_Slider_3 .rsThumb,
		
		/* WOO COMMERCE */
		input.input-text,
		.woocommerce ul.products li.product,
		.woocommerce ul.products li.product.last .woocommerce-page ul.products li.product,
		.col2-set.addresses .address,
		.woocommerce-message,
		.woocommerce div.product .woocommerce-tabs ul.tabs li,
		.woocommerce #content div.product .woocommerce-tabs ul.tabs li,
		.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li,
		.woocommerce #payment,
		.woocommerce-page #payment,
		.woocommerce-main-image img,
		input#coupon_code,
		.widget_price_filter .price_slider_wrapper .ui-widget-content,
		.woocommerce nav.woocommerce-pagination ul li span.current, 
		.woocommerce nav.woocommerce-pagination ul li a:hover, 
		.woocommerce nav.woocommerce-pagination ul li a:focus, 
		.woocommerce #content nav.woocommerce-pagination ul li span.current, 
		.woocommerce #content nav.woocommerce-pagination ul li a:hover, 
		.woocommerce #content nav.woocommerce-pagination ul li a:focus, 
		.woocommerce-page nav.woocommerce-pagination ul li span.current, 
		.woocommerce-page nav.woocommerce-pagination ul li a:hover, 
		.woocommerce-page nav.woocommerce-pagination ul li a:focus, 
		.woocommerce-page #content nav.woocommerce-pagination ul li span.current, 
		.woocommerce-page #content nav.woocommerce-pagination ul li a:hover, 
		.woocommerce-page #content nav.woocommerce-pagination ul li a:focus,
		
		/* ROYAL SLIDER */
		.cookbookDefault,
		.cookbookDefault .rsOverflow,
		.cookbookDefault .rsSlide,
		.cookbookDefault .rsVideoFrameHolder,
		.cookbookDefault .rsThumbs,
		
		/* BUDDYPRESS */
		#bbpress-forums li.bbp-header, 
		#bbpress-forums div.even, 
		#bbpress-forums ul.even, 
		#bbpress-forums li.bbp-header, 
		#bbpress-forums li.bbp-footer, 
		#bbpress-forums div.bbp-forum-header, 
		#bbpress-forums div.bbp-topic-header, 
		#bbpress-forums div.bbp-reply-header,
		
		/* EVENTS CALENDAR */
		.tribe-events-sub-nav li a:hover, 
		.tribe-events-loop .hentry, 
		.tribe-events-tcblock  {
			<?php if ($canon_options_appearance['color_block_light'] != "#f6f6f6") echo "background-color: ".$canon_options_appearance['color_block_light'].";"; ?>
		}
		
			
			
				
		
		/* 
		32. FEATURED TITLE BACKGROUND ___________________________________________________ */
		.feat-title{
			<?php if ($canon_options_appearance['color_feat_title'] != "#ffffff") echo "background-color: ".$canon_options_appearance['color_feat_title'].";"; ?>
		}
		
		
		
		
		
		/* 
		33. MENU BORDER COLOR ___________________________________________________ */
		.post-header-container #navigation .nav li a, 
		.header-container .nav ul#nav > li a, 
		.sidr ul, 
		.sidr ul li, 
		.post-header-container.nav-container nav ul > li > a, 
		.header-style-4 nav > ul > li > a{
			<?php if ($canon_options_appearance['color_border_1'] != "#2b363c!important") echo "border-color: ".$canon_options_appearance['color_border_1'].";"; ?>
		} 
		
		
		
		

		
		/* 
		34. MAIN BORDER COLOR ___________________________________________________ */
		.tab-contents,
		.body-wrapper ul.thumb-list li,
		.body-wrapper ul.wiget-comment-list li,
		hr,
		.text-seperator-line div,
		blockquote.right,
		blockquote.left,
		pre,
		table.table-style-1,
		table.table-style-1 th,
		table.table-style-1 td,
		table.table-style-2,
		table.table-style-2 th,
		table.table-style-2 td,
		.post-container,
		.sitemap div > ul,
		.page-heading,
		.thumb-list.archive,
		ul.comments,
		.post-tag-cloud,
		.paging,
		.paging .col-1-2.prev,
		input[type=text],
		input[type=email],
		input[type=password],
		textarea,
		input[type=tel],
		input[type=range],
		input[type=url],
		input[type=number],
		ul.toggle li,
		ul.accordion li,
		ul.toggle li:first-child,
		ul.accordion li:first-child,
		.cookbook_more_posts li,
		aside .list-1 li,
		ul.statistics li,
		ul.tweets li.tweet,
		.widget ul li,
		.widget_archive ul li,
		.widget_calendar th,
		.widget_calendar td,
		.widget_categories ul li,
		.widget_nav_menu ul li,
		.widget_meta ul li,
		.widget_pages ul li,
		.widget_recent_comments ul li,
		.widget_recent_entries ul li,
		.widget_tag_cloud .tagcloud a,
		.tabs-tags a,
		ul.graphs > li .rate-span,
		ul.review-graph > li .rate-span,
		.widget_rss ul li,
		.cat-desription p:last-child,
		.canon-cleanTabs-container ul.tab-nav li,
		ul.toggle li,
		ul.accordion li,
		ul.sc_toggle li,
		ul.sc_accordion li,
		.multi_nav_control,
		#comments_pagination .page-numbers:after,
		img.avatar,
		.tc-info-box-meta,
		.widget-title,
		 p.link-pages,
		
		/* VC SUPPPORT */
		.wpb_tabs .wpb_tabs_nav li,
		.vc_separator.vc_sep_color_grey .vc_sep_line,
		.vc_toggle,
		.wpb_content_element.wpb_tabs .wpb_tour_tabs_wrapper .wpb_tab,
		.wpb_tour .wpb_tabs_nav li,
		.wpb_tour .wpb_tour_tabs_wrapper .ui-tabs-panel,
		.wpb_content_element .wpb_accordion_wrapper .wpb_accordion_header,
		.wpb_content_element.wpb_tabs .wpb_tour_tabs_wrapper .wpb_tab,
		.wpb_teaser_grid ul.categories_filter,
		
		/* WOO COMMERCE */
		ul.products li .price,
		ul.products li h3,
		.woocommerce #payment div.payment_box,
		.woocommerce-page #payment div.payment_box,
		.col2-set.addresses .address,
		p.myaccount_user,
		.summary.entry-summary .price,
		.summary.entry-summary .price,
		.product_meta .sku_wrapper,
		.product_meta .posted_in,
		.product_meta .tagged_as,
		.product_meta span:first-child,
		.woocommerce-message,
		.related.products,
		.woocommerce .widget_shopping_cart .total,
		.woocommerce-page .widget_shopping_cart .total,
		.woocommerce div.product .woocommerce-tabs ul.tabs li,
		.woocommerce #content div.product .woocommerce-tabs ul.tabs li,
		.woocommerce-page div.product .woocommerce-tabs ul.tabs li,
		.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li,
		.woocommerce div.product .woocommerce-tabs ul.tabs:before,
		.woocommerce #content div.product .woocommerce-tabs ul.tabs:before,
		.woocommerce-page div.product .woocommerce-tabs ul.tabs:before,
		.woocommerce-page #content div.product .woocommerce-tabs ul.tabs:before,
		.woocommerce div.product .woocommerce-tabs ul.tabs li.active,
		.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active,
		.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active,
		.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active,
		.woocommerce #reviews #comments ol.commentlist li img.avatar,
		.woocommerce-page #reviews #comments ol.commentlist li img.avatar,
		.woocommerce #reviews #comments ol.commentlist li .comment-text,
		.woocommerce-page #reviews #comments ol.commentlist li .comment-text,
		.upsells.products,
		.woocommerce #payment ul.payment_methods,
		.woocommerce-page #payment ul.payment_methods,
		.woocommerce form.login,
		.woocommerce form.checkout_coupon,
		.woocommerce form.register,
		.woocommerce-page form.login,
		.woocommerce-page form.checkout_coupon,
		.woocommerce-page form.register,
		.woocommerce #reviews #comments ol.commentlist,
		.widget_price_filter .price_slider_wrapper .ui-widget-content,
		.widget.woocommerce .tagcloud a,
		.widget.woocommerce ul.product_list_widget li,
		.widget.woocommerce ul.product-categories li,
		.woocommerce nav.woocommerce-pagination ul li, 
		.woocommerce #content nav.woocommerce-pagination ul li, 
		.woocommerce-page nav.woocommerce-pagination ul li, 
		.woocommerce-page #content nav.woocommerce-pagination ul li,
		.woocommerce nav.woocommerce-pagination ul, 
		.woocommerce #content nav.woocommerce-pagination ul, 
		.woocommerce-page nav.woocommerce-pagination ul, 
		.woocommerce-page #content nav.woocommerce-pagination ul,
		.woocommerce table.shop_table td, 
		.woocommerce-page table.shop_table td,
		.woocommerce .cart-collaterals .cart_totals tr td, 
		.woocommerce .cart-collaterals .cart_totals tr th, 
		.woocommerce-page .cart-collaterals .cart_totals tr td, 
		.woocommerce-page .cart-collaterals .cart_totals tr th,
		.woocommerce .quantity input.qty, 
		.woocommerce #content .quantity input.qty, 
		.woocommerce-page .quantity input.qty, 
		.woocommerce-page #content .quantity input.qty,
		
		/* ROYAL SLIDER */
		.Canon_Slider_1 .rsThumb,
		.Canon_Slider_2 .rsThumbsVer,
		.Canon_Slider_3 .rsThumb,
		.Canon_Slider_3 .rsThumbsHor,
		.Canon_Slider_2 .rsThumb,
		
		/* BBPRESS */
		#bbpress-forums div.bbp-forum-author img.avatar, 
		#bbpress-forums div.bbp-topic-author img.avatar, 
		#bbpress-forums div.bbp-reply-author img.avatar,
		#bbp-user-navigation ul li, 
		.widget_display_stats dl dt, 
		.widget_display_stats dl dd, 
		#bbpress-forums ul.bbp-lead-topic, 
		#bbpress-forums ul.bbp-topics, 
		#bbpress-forums ul.bbp-forums, 
		#bbpress-forums ul.bbp-replies, 
		#bbpress-forums ul.bbp-search-results, 
		#bbpress-forums li.bbp-body ul.forum, 
		#bbpress-forums li.bbp-body ul.topic, 
		#bbpress-forums li.bbp-header, 
		#bbpress-forums li.bbp-footer, 
		div.bbp-forum-header, 
		div.bbp-topic-header, 
		div.bbp-reply-header,
		textarea#bbp_reply_content,
		#bbp_topic_content,
		#bbpress-forums li.bbp-header li.bbp-forum-freshness,
		#bbpress-forums li.bbp-body li.bbp-forum-freshness,
		#bbpress-forums li.bbp-header li.bbp-topic-freshness,
		#bbpress-forums li.bbp-body li.bbp-topic-freshness,
		
		/* BUDDYPRESS */
		#buddypress .item-list-tabs ul li, 
		#buddypress #item-nav .item-list-tabs ul, 
		#buddypress div#subnav.item-list-tabs, 
		#buddypress #subnav.item-list-tabs li, 
		#bp-login-widget-form, 
		#buddypress #members-directory-form div.item-list-tabs ul li, 
		#buddypress #members-directory-form div.item-list-tabs ul, 
		#buddypress .activity-comments ul li, 
		#buddypress div.activity-comments > ul > li:first-child, 
		#buddypress .item-list-tabs.activity-type-tabs ul, 
		#buddypress div.item-list-tabs ul li a span,
		#bbpress-forums fieldset.bbp-form,
		
		/* EVENTS CALENDAR */
		#tribe-bar-form, 
		#tribe-bar-views, 
		.tribe-events-list-separator-month, 
		.tribe-events-loop .hentry, 
		.tribe-events-sub-nav li a, 
		.events-archive.events-gridview #tribe-events-content table .vevent, 
		.single-tribe_events .tribe-events-schedule, 
		.tribe-events-single-section.tribe-events-event-meta, 
		.single-tribe_events #tribe-events-footer, 
		.tribe-events-list-widget ol li, 
		.tribe-events-tcblock, 
		.tribe-events-calendar .tribe-events-tooltip, 
		.tribe-events-week .tribe-events-tooltip, 
		.recurring-info-tooltip, 
		.tribe-events-mobile.hentry.vevent,
		#tribe-events-content .tribe-events-calendar td, 
		#tribe-events-content table.tribe-events-calendar,
		.tribe-events-loop .vevent.tribe-events-last, 
		.tribe-events-list .vevent.hentry.tribe-event-end-month,
		
		/* GRAVITY FORMS */
		.gf_progressbar
		  {
			<?php if ($canon_options_appearance['color_border_2'] != "#eaeaea!important") echo "border-color: ".$canon_options_appearance['color_border_2'].";"; ?>	
		}
		
		
		
		
		
		/* 
		35. FORM ELEMENTS ___________________________________________________ */		
		input[type=text],  
		input[type=email], 
		input[type=password], 
		textarea, 
		input[type=tel],  
		input[type=range], 
		input[type=url],
		input[type=number],
		
		/* BUDDYPRESS */
		#buddypress .item-list-tabs ul li, 
		#buddypress .standard-form textarea, 
		#buddypress .standard-form input[type="text"], 
		#buddypress .standard-form input[type="text"], 
		#buddypress .standard-form input[type="color"], 
		#buddypress .standard-form input[type="date"], 
		#buddypress .standard-form input[type="datetime"], 
		#buddypress .standard-form input[type="datetime-local"], 
		#buddypress .standard-form input[type="email"], 
		#buddypress .standard-form input[type="month"], 
		#buddypress .standard-form input[type="number"], 
		#buddypress .standard-form input[type="range"], 
		#buddypress .standard-form input[type="search"], 
		#buddypress .standard-form input[type="tel"], 
		#buddypress .standard-form input[type="time"], 
		#buddypress .standard-form input[type="url"], 
		#buddypress .standard-form input[type="week"], 
		#buddypress .standard-form select, 
		#buddypress .standard-form input[type="password"], 
		#buddypress .dir-search input[type="search"], 
		#buddypress .dir-search input[type="text"], 
		#buddypress form#whats-new-form textarea, 
		#buddypress div.activity-comments form textarea, 
		#buddypress div.item-list-tabs ul li.selected a span, 
		#buddypress div.item-list-tabs ul li.current a span {
			<?php if ($canon_options_appearance['color_forms_bg'] != "#f4f4f4") echo "background-color: ".$canon_options_appearance['color_forms_bg'].";"; ?>
		}	

		
		
		
		
		/* 
		36. PRE FOOTER ___________________________________________________ */	
		.outter-wrapper.pre-footer-container,
		.pre-footer-container .nav ul {
			<?php if ($canon_options_appearance['color_prefoot_bg'] != "#eaeaea") echo "background-color: ".$canon_options_appearance['color_prefoot_bg'].";"; ?>
		}
		
		
		
		
		/* 
		37. PRE FOOTER TEXT___________________________________________________ */	
		.pre-footer-container *{
			<?php if ($canon_options_appearance['color_prefoot'] != "#28292c") echo "color: ".$canon_options_appearance['color_prefoot'].";"; ?>
		}
		
		
		
		
		/* 
		38. PRE FOOTER TEXT HOVER ___________________________________________________ */	
		.pre-footer-container a:hover,
		.pre-footer-container a:hover *{
			<?php if ($canon_options_appearance['color_prefoot_hover'] != "#c3ad70") echo "color: ".$canon_options_appearance['color_prefoot_hover'].";"; ?>
		}
		
		
		
		
		
		/* 
		39. MAIN FOOTER ___________________________________________________ */
		.outter-wrapper.main-footer-container{
			<?php if ($canon_options_appearance['color_foot_bg'] != "#272f33") echo "background-color: ".$canon_options_appearance['color_foot_bg'].";"; ?>
		}
		
		
		
		
		/* 
		40. MAIN FOOTER TEXT___________________________________________________ */	
		.main-footer-container *{
			<?php if ($canon_options_appearance['color_foot'] != "#e3e5e7") echo "color: ".$canon_options_appearance['color_foot'].";"; ?>
		}
		
		
		
		
		/* 
		41. MAIN FOOTER TEXT HOVER ___________________________________________________ */	
		.main-footer-container a:hover,
		.main-footer-container a:hover *{
			<?php if ($canon_options_appearance['color_foot_hover'] != "#c3ad70") echo "color: ".$canon_options_appearance['color_foot_hover'].";"; ?>
		}
		
		
		
		
		/* 
		42. MAIN FOOTER SECONDARY TEXT ___________________________________________________ */
		.main-footer-container .cookbook_more_posts .meta *, 
		.main-footer-container .tweet .meta, 
		.main-footer-container .post-date,
		.main-footer-container .widget-title {
			<?php if ($canon_options_appearance['color_foot_2'] != "#ffffff") echo "color: ".$canon_options_appearance['color_foot_2'].";"; ?>
		}
		
		
		
		
		/* 
		43. MAIN FOOTER BORDER COLOR ___________________________________________________ */
		.main-footer-container .tag-cloud a,
		.main-footer-container .col-1-5,
		.main-footer-container ul.list-1 li,
		.main-footer-container ul.list-2 li,
		.main-footer-container ul.list-3 li,
		.main-footer-container .widget ul.toggle li,
		.main-footer-container .widget ul.accordion li,
		.main-footer-container .cookbook_more_posts li,
		.main-footer-container ul.statistics li,
		.main-footer-container ul.tweets li.tweet,
		.main-footer-container .widget_archive ul li,
		.main-footer-container .widget_calendar th,
		.main-footer-container .widget_calendar td,
		.main-footer-container .widget_categories ul li,
		.main-footer-container .widget_nav_menu ul li,
		.main-footer-container .widget_meta ul li,
		.main-footer-container .widget_pages ul li,
		.main-footer-container .widget_recent_comments ul li,
		.main-footer-container .widget_recent_entries ul li,
		.main-footer-container .widget_tag_cloud .tagcloud a,
		.main-footer-container .canon-cleanTabs-container ul.tab-nav li,
		.main-footer-container .tabs-tags a,
		.main-footer-container .thumb-list li,
		.main-footer-container .canon-cleanTabs-container .tab_content,
		.main-footer-container ul.wiget-comment-list li,
		.main-footer-container .wrapper > .col-1-2,
		.main-footer-container .wrapper > .col-1-3,
		.main-footer-container .wrapper > .col-1-4,
		.main-footer-container .wrapper > .col-1-5,
		.main-footer-container .wrapper > .col-2-3,
		.main-footer-container .wrapper > .col-3-4,
		.main-footer-container .wrapper > .col-2-5,
		.main-footer-container .wrapper > .col-3-5,
		.main-footer-container .wrapper > .col-4-5,
		.main-footer-container .widget-title  {
			<?php if ($canon_options_appearance['color_border_3'] != "#2b363c!important") echo "border-color: ".$canon_options_appearance['color_border_3'].";"; ?>
		}
		
		
		
		
		
		/* 
		44. MAIN FOOTER SECONDARY BLOCK ___________________________________________________ */
		.main-footer-container .widget_calendar caption,
		.main-footer-container .btn,
		.main-footer-container input[type=button],
		.main-footer-container input[type=submit],
		.main-footer-container button,
		.main-footer-container .form-style-2 .btn,
		.main-footer-container .form-style-2 input[type=button],
		.main-footer-container .form-style-2 input[type=submit],
		.main-footer-container .form-style-2 button,
		.main-footer-container .search_controls li  {
			<?php if ($canon_options_appearance['color_foot_bg_2'] != "#3a464c") echo "background-color: ".$canon_options_appearance['color_foot_bg_2'].";"; ?>
		}
		
		
		
		
		
		/* 
		45. POST FOOTER  ___________________________________________________ */	
		.outter-wrapper.post-footer-container,
		.post-footer-container .nav ul,
		.post-footer-container ul ul li:hover ul li {
			<?php if ($canon_options_appearance['color_baseline_bg'] != "#171e20") echo "background-color: ".$canon_options_appearance['color_baseline_bg'].";"; ?>
		}
		
		
		
		
		
		/* 
		46. POST FOOTER TEXT___________________________________________________ */	
		.post-footer-container *{
			<?php if ($canon_options_appearance['color_baseline'] != "#b6b6b6") echo "color: ".$canon_options_appearance['color_baseline'].";"; ?>
		}
		
		
		
		
		/* 
		47. POST FOOTER TEXT HOVER ___________________________________________________ */	
		.post-footer-container a:hover,
		.post-footer-container a:hover *{
			<?php if ($canon_options_appearance['color_baseline_hover'] != "#c3ad70") echo "color: ".$canon_options_appearance['color_baseline_hover'].";"; ?>
		}
		














		/******************************************************************************
		FONTS
		
		01. Body Text
		02. Main Headings Text
		03. Navigation
		04. Second/Meta Headings
		05. Bold Text
		06. Italics Text
		07. Strong Text
		08. Logo Text
		*******************************************************************************/


			
		/* 
		01. BODY TEXT _______________________________________________________________ */ 
		body,
		input[type=text],
		input[type=email],
		input[type=password],
		textarea,
		input[type=tel],
		input[type=range],
		input[type=url],
		input[type=number],
		.canonSlider,
		.fa *,
		.tc-info-box-meta h5 span {
			<?php if ($canon_options_appearance['font_main'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_main']); ?>
		}
			
		
			
		/* 
		02. MAIN HEADINGS TEXT ______________________________________________________ */ 
		h1,
		h2,
		h3,
		.widget_rss a.rsswidget,
		.wpb_tour .wpb_tabs_nav li,
		
		/* BBPRESS*/
		#bbpress-forums .bbp-forum-title, 
		#bbpress-forums .bbp-topic-permalink, 
		#bbpress-forums div.bbp-forum-title h3, 
		#bbpress-forums div.bbp-topic-title h3, 
		#bbpress-forums div.bbp-reply-title h3, 
		.bbp-pagination-links a, 
		.bbp-pagination-links span.current,
		
		/* BUDDYPRESS */
		#buddypress .activity-meta a.bp-primary-action span {
			<?php if ($canon_options_appearance['font_headings'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_headings']); ?>
		}
		
		
		 
		/* 
		03. NAVIGATION ______________________________________________________________ */    
		.nav a,  
		.header-container .wrapper ul li a,
		.header-container .canon_breadcrumbs li,  
		.pre-header-container .wrapper ul li a,
		.pre-header-container .canon_breadcrumbs, 
		.post-header-container.nav-container a, 
		.post-header-container .canon_breadcrumbs,  
		.sidr a,
		.responsive-menu-button  {
			<?php if ($canon_options_appearance['font_nav'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_nav']); ?>
		}
		
		
		
		
		
		/* 
		04. SECOND / META HEADINGS  _________________________________________________ */ 
		.breadcrumb-wrapper,
		.main-footer-container h3.widget-title,
		aside .widget-title,
		.tab-nav li,
		h3.v_nav,
		h6.meta,
		.rate-tab i,
		.text-seperator-bar .btn,
		blockquote cite,
		legend,
		.text-seperator-bar h5,
		.text-seperator-line h5,
		.text-seperator-bar .btn,
		.text-seperator-line .btn,
		ul.meta,
		ul.meta a,
		.page-heading,
		ul.pagination li,
		.paging .meta,
		ul.comments .meta,
		ul.comments li .more,
		.comment-num,
		.cookbook_more_posts .meta,
		.read_more:before,
		.tweet .meta,
		.post-date,
		ul.graphs > li,
		ul.review-graph > li,
		.rss-date,
		h4,
		h5,
		h6,
		.widget_rss .widget-title .rsswidget,
		.text-seperator-line .btn,
		ul.meta,
		ul.meta a,
		.meta,
		.meta a,
		.readmore.
		
		/* VC SUPPORT */
		.vc_separator h4,
		.wpb_tabs .wpb_tabs_nav li a,
		.wpb_tour .wpb_tour_next_prev_nav a,
		.wpb_teaser_grid .vc_read_more,
		.vc_carousel .vc_read_more,
		h4.wpb_heading,
		.wpb_widgetised_column .widget .widget-title,
		
		/* BBPRESS */
		.bbp-breadcrumb,
		.bbp-header,
		
		/* BUDDYPRESS */
		 #buddypress #profile-edit-form ul.button-nav li a, 
		 .bp-login-widget-user-logout a,
		 #buddypress button, 
		 #buddypress a.button, 
		 #buddypress input[type="submit"], 
		 #buddypress input[type="button"], 
		 #buddypress input[type="reset"], 
		 #buddypress ul.button-nav li a,
		 #buddypress div.generic-button a, 
		 #buddypress .comment-reply-link, 
		 a.bp-title-button, 
		 #buddypress #profile-edit-form ul.button-nav li a, 
		 .bp-login-widget-user-logout a, 
		 .tt_timetable .hours,
		 
		 /* EVENTS CALENDAR */
		 .tribe-events-read-more, 
		 .tribe-events-list-widget .tribe-events-widget-link a,
		 .tribe-events-calendar th {
			<?php if ($canon_options_appearance['font_headings_meta'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_headings_meta']); ?>
		}
		
		
		
		
		
		/* 
		05. BOLD TEXT  ___________________________________________________________ */
		strong,
		b,
		.page-heading,
		ul.pagination li,
		.paging .meta,
		ul.comments .meta,
		ul.comments li .more,
		ol.sc_graphs li div,
		.btn,
		input[type=button],
		input[type=submit],
		.button,
		button,
		ul.toggle li a.toggle-btn,
		ul.accordion li a.accordion-btn,
		.statistics li span,
		.read_more,
		ul.pagination a,
		ul.page-numbers,
		#cancel-comment-reply-link,
		a.toggle-btn:after,
		a.accordion-btn:after,
		a.sc_toggle-btn:after,
		a.sc_accordion-btn:after,
		a.toggle-btn,
		a.accordion-btn,
		a.sc_toggle-btn,
		a.sc_accordion-btn,
		ol > li:before,
		ul.sitemap > li > a,
		   
		/* VC SUPPORT */
		.wpb_toggle,
		.wpb_accordion .wpb_accordion_header a,
		.wpb_button_a .wpb_button,
		.vc_btn,
		.vc_progress_bar .vc_single_bar .vc_label {
			<?php if ($canon_options_appearance['font_bold'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_bold']); ?>
		}
		
		
		
		
		/* 
		06. ITALICS TEXT _______________________________________________________________ */ 
		.lead,
		em,
		i,
		blockquote,
		.boxy blockquote,
		.rate-tab strong,
		.wp-caption-text,
		ul.tweets li.tweet  {
			<?php if ($canon_options_appearance['font_italic'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_italic']); ?>
		}
		
		
		
		
		
		/* 
		07. STRONG TEXT  ___________________________________________________________ */
		.rate-tab strong {
			<?php if ($canon_options_appearance['font_strong'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_strong']); ?>
		}
		
		
		
		
		/* 
		08. LOGO TEXT  ___________________________________________________________ */
		.logo.logo-text a{
			<?php if ($canon_options_appearance['font_logo'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_logo']); ?>
		}
		
		
		
		
		/******************************************************************************
		OTHER DYNAMIC OPTIONS
		*******************************************************************************/
		
		
		/* LOGO MAX WIDTH */

			.logo{
				<?php if (!empty($canon_options_frame['logo_max_width'])) echo "max-width: ".$canon_options_frame['logo_max_width']."px;"; ?>
			}

		/* HEADER PADDING*/

			.header-container .wrapper{
				<?php if ($canon_options_frame['header_padding_top'] > -1) echo "padding-top: ".$canon_options_frame['header_padding_top']."px;"; ?>
				<?php if ($canon_options_frame['header_padding_bottom'] > -1) echo "padding-bottom: ".$canon_options_frame['header_padding_bottom']."px;"; ?>
			}   

		/* HEADER ELEMENTS POSITIONING */

			.main-header.left {
				position: relative;	
				<?php if (!empty($canon_options_frame['pos_left_element_top'])) echo "top: ".$canon_options_frame['pos_left_element_top']."px;"; ?>
				<?php if (!empty($canon_options_frame['pos_left_element_left'])) echo "left: ".$canon_options_frame['pos_left_element_left']."px;"; ?>
			}

			.main-header.right {
				position: relative;	
				<?php if (!empty($canon_options_frame['pos_right_element_top'])) echo "top: ".$canon_options_frame['pos_right_element_top']."px;"; ?>
				<?php if (!empty($canon_options_frame['pos_right_element_right'])) echo "right: ".$canon_options_frame['pos_right_element_right']."px;"; ?>
			}

		/* TEXT AS LOGO SIZE */

			.logo-text a {
				<?php if (isset($canon_options_frame['logo_text_size'])) echo "font-size: ".$canon_options_frame['logo_text_size']."px;"; ?>
			}

		/* RELATIVE FONT SIZE */

			html {
				<?php if ($canon_options_appearance['font_size_root'] != 100) echo "font-size: ".$canon_options_appearance['font_size_root']."%;"; ?>
			}

		/* ANIMATE MENUS */

			<?php if (isset($canon_options_appearance['anim_menus'])) {echo esc_attr($canon_options_appearance['anim_menus']);} ?> > li {
				opacity: 0;
				<?php 
					$anim_menus_enter = (isset($canon_options_appearance['anim_menus_enter'])) ? $canon_options_appearance['anim_menus_enter'] : 'left';
					$anim_menus_move = (isset($canon_options_appearance['anim_menus_move'])) ? $canon_options_appearance['anim_menus_move'] : '0';

					if ($anim_menus_enter == 'right') {
						$anim_menus_enter = 'left';
						$anim_menus_move = '-' . $anim_menus_move;
					}
					if ($anim_menus_enter == 'bottom') {
						$anim_menus_enter = 'top';
						$anim_menus_move = '-' . $anim_menus_move;
					}

					printf('%s: %spx;', esc_attr($anim_menus_enter), esc_attr($anim_menus_move));
				?>
			}

		
		/* BACKGROUND */
		
			html{
				<?php if (!empty($canon_options_appearance['bg_img_url'])) echo 'background-image: url("' . $canon_options_appearance['bg_img_url'] . '")!important;'; ?>
				<?php if (isset($canon_options_appearance['bg_repeat'])) echo 'background-repeat: ' . $canon_options_appearance['bg_repeat'] . '!important;'; ?>
				<?php if (isset($canon_options_appearance['bg_attachment'])) echo 'background-attachment: ' . $canon_options_appearance['bg_attachment'] .'!important;'; ?>
				background-position: top center;
				<?php if (isset($canon_options_appearance['bg_link'])) { if (!empty($canon_options_appearance['bg_link'])) { echo "cursor: pointer;"; } } ;?>
			} 

			body div { cursor: auto; }
			
			
				    
		/******************************************************************************
		FINAL CALL CSS
		*******************************************************************************/
		
		<?php if ($canon_options_advanced['use_final_call_css'] == "checked" && !empty($canon_options_advanced['final_call_css'])) { echo $canon_options_advanced['final_call_css']; } ?>


	</style>


<?php 

        // dev_mode
        if ($canon_options['dev_mode'] == "checked") {
            if (isset($_GET['preview_style'])) { 
                get_template_part('inc/templates/preview/'.wp_filter_nohtml_kses($_GET['preview_style']));
            }
        }


	} // end function canon_dynamic_css