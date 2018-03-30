<!-- OPTIONS CALL HERE TO USE IN REST OF DOCUMENT -->
	<?php 
		$canon_options = get_option('canon_options');
		$canon_options_homepage = get_option('canon_options_homepage');
		$canon_options_appearance = get_option('canon_options_appearance');
		$canon_options_advanced = get_option('canon_options_advanced');

	 ?>

	<style type="text/css" scoped>
	
	
	/* ==========================================================================
	   Theme Colours
	   ========================================================================== */
	   
	/* Feature Colour 1 - Bright Blue */
	.feature-link:after, .more:before, .parallax-block span, .widget-footer .tweet a, .widget-footer .tweet a *, .main ul li:before, .main a:hover, footer ul.social-link a:hover em:before, h1 span, h2 span,
	.main h1 a:hover, a:hover span, h1 span, h2 span, h3 span, h6 span, ul.toggle .toggle-btn.active, .tab-nav li.active, .widget-footer .tab-nav li.active, #fittext1, .statistics li span, .statistics li em, .more:before, ol > li:before, h3.v_active, .accordion-btn.active,  aside .tweet a, .twitter_theme_design .tweet a, .logo-text:hover, h4.fittext, .comment-reply-link:before, .comment-edit-link:before, #cancel-comment-reply-link:before, .sc_accordion-btn.active, .price-cell .inwrap:after, .skin_corporate h3.fittext,  .widget-footer .tab-content-block h3.v_nav.v_active, 
	 /* Woo Commerce Classes */
	 .shipping_calculator h2 a, .woocommerce table.cart a.remove, .woocommerce #content table.cart a.remove, .woocommerce-page table.cart a.remove, .woocommerce-page #content table.cart a.remove, .woocommerce form .form-row .required, .woocommerce-page form .form-row .required, .woocommerce div.product .woocommerce-tabs ul.tabs li a:hover, .woocommerce #content div.product .woocommerce-tabs ul.tabs li a:hover, .woocommerce-page div.product .woocommerce-tabs ul.tabs li a:hover, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a:hover, .woocommerce .star-rating span:before, .woocommerce-page .star-rating span:before, .woocommerce div.product .stock, .woocommerce #content div.product .stock, .woocommerce-page div.product .stock, .woocommerce-page #content div.product .stock, .woocommerce div.product .out-of-stock, .woocommerce #content div.product .out-of-stock, .woocommerce-page div.product .out-of-stock, .woocommerce-page #content div.product .out-of-stock,
	 /* BBPress Classes*/
	 #bbpress-forums .bbp-forum-title:hover, #bbpress-forums .bbp-topic-permalink:hover, .bbp-forum-header a.bbp-forum-permalink:hover, .bbp-topic-header a.bbp-topic-permalink:hover, .bbp-reply-header a.bbp-reply-permalink:hover, #bbpress-forums .bbp-topic-header .bbp-meta a.bbp-topic-permalink:hover, #bbpress-forums #bbp-single-user-details #bbp-user-navigation li a:hover, .widget_display_stats dl dd strong,
	 /* BuddyPress Classes */
	 #buddypress div.item-list-tabs ul li.selected a, #buddypress div.item-list-tabs ul li.current a,
	 /* Events Calendar Styles */
	 #tribe-bar-collapse-toggle:hover, .tribe-bar-active a
	 {
		color: #4ec6e9;
	   	<?php if (!empty($canon_options_appearance['color_feature_1'])) echo "color: ".$canon_options_appearance['color_feature_1'].";"; ?>
	}	
	
	
	
	/* Feature Colour 2 - Orange */
	.white-btn, a.white-btn, cite, .error[generated=true], .comments .more:before, nav a.active, #nav a:hover, #nav ul a:hover, ul.pagination li a.active, .boxed h5, .icon-thirds li:hover em:before, .caption-cite, h4 span, ul.comments h5 a, .boxed ul.social-link a:hover, .meta.option-set a.selected, #scrollUp:hover, .page-numbers.current, span.wpcf7-not-valid-tip, .current-cat, .header-container .nav li:before, .skin_corporate h4.fittext, 
	/* BBPress Classes */
	#bbpress-forums #bbp-single-user-details #bbp-user-navigation li.current a,
	/* Event Calendar Styles */
	.tribe-events-list-separator-month span, .tribe-events-sub-nav li a, .tribe-events-tooltip .date-start.dtstart, .tribe-events-tooltip .date-end.dtend, .single-tribe_events .tribe-events-schedule .tribe-events-cost
	{
		color: #ff6666;
	   	<?php if (!empty($canon_options_appearance['color_feature_2'])) echo "color: ".$canon_options_appearance['color_feature_2'].";"; ?>
	}
	
	
	
	
	
	/* Main Plate */
	 .outter-wrapper, .price:hover, .price.price-feature, .price-table:hover, .price-table.price-table-feature, fieldset fieldset, .main table, .text-seperator h5,
	/* Woo Commerce Classes */
	 .woocommerce #payment div.payment_box, .woocommerce-page #payment div.payment_box, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active,
	 /* BuddyPress Classes*/
	 #buddypress div.item-list-tabs ul li.selected, #buddypress div.item-list-tabs ul li.current, #buddypress div.item-list-tabs ul li.selected a, #buddypress div.item-list-tabs ul li.current a, #buddypress .item-list-tabs.activity-type-tabs ul li.selected, #bbpress-forums div.odd, #bbpress-forums ul.odd,
	 /* Event Calender Styles */
	 .tribe-events-list-separator-month span, .single-tribe_events .tribe-events-schedule .tribe-events-cost
	  {
	   	background: #fff;  
	   	<?php if (!empty($canon_options_appearance['color_plate'])) echo "background: ".$canon_options_appearance['color_plate'].";"; ?>
	}
	
	
	
	/* Body Colour */
	 body{
	   	background: #242931;  
	   	<?php if (!empty($canon_options_appearance['color_body'])) echo "background: ".$canon_options_appearance['color_body']."!important;"; ?>
	}
	
	
	
	   
	/* General Text - Grey */
	html, button, input, select, textarea, a, aside .tweet, ul.tab-nav li, ul.accordion li, .accordion-btn, footer.outter-wrapper,
	/* Woo Commerce Classes */
	.woocommerce-tabs .comment-text .description, #payment ul.payment_methods.methods p { 
		color: #4b525d;
	   	<?php if (!empty($canon_options_appearance['color_general_text'])) echo "color: ".$canon_options_appearance['color_general_text'].";"; ?>
	}
	
	
	
	
	/* Headings - Dark Grey */
	h1, h1 a, h2, h2 a, h3, h3 a, h4, h4 a, h5, h6, .lead, blockquote, .text-seperator h5, strong, b, .feature-link, .more, pre, .icon-thirds li em:before, .countdown_amount,
	/* Woo Commerce Classes */
	.woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price, .woocommerce table.cart a.remove:hover, .woocommerce #content table.cart a.remove:hover, .woocommerce-page table.cart a.remove:hover, .woocommerce-page #content table.cart a.remove:hover, .summary.entry-summary .price span,  .woocommerce div.product .woocommerce-tabs ul.tabs li a, .woocommerce #content div.product .woocommerce-tabs ul.tabs li a, .woocommerce-page div.product .woocommerce-tabs ul.tabs li a, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a, mark,
	/* BBPress Classes*/
	#bbpress-forums .bbp-forum-title, #bbpress-forums .bbp-topic-permalink,
	/* BuddyPress Classes */
	#buddypress .activity-meta a.bp-primary-action span,
	/* Events Claender Styles */
	.single-tribe_events .tribe-events-schedule *
	
	{
		color: #2f353f;
	   	<?php if (!empty($canon_options_appearance['color_headings'])) echo "color: ".$canon_options_appearance['color_headings'].";"; ?>
	}
	
	
	
	
	/* White Text */
	.caption-pre-heading, .parallax-block h4, .parallax-block h5, .callout-block h4, .callout-block h5, .nav a, #nav .donate a:hover, .widget-footer strong, .btn, input[type=submit], .price h3, ol.graphs > li div, .highlight, #menu-icon, ul.pagination .left a:hover, ul.pagination .right a:hover, ul.paging a:hover span, .tp-caption.btn a, a.tp-button, #scrollUp, .feature-heading *, ul.pagination .left a, ul.pagination .right a, ul.paging a span, ul.page-numbers li a.next, ul.page-numbers li a.prev, ul.paging span, .logo-text, .widget-footer .tab-nav li, nav li.donate.current-menu-item > a,  .timeline_load_more:hover h4, .construction_msg h1, .main a.btn:hover, .price h3 span, .price-table-feature .price-cell.feature h3, .price-table-feature .price-cell h3 span, .price-cell.feature h3, .price-cell h3 span, .widget-footer .tab-content-block h3.v_nav, .download-table .fa, a.button, a.button:hover,  .woocommerce span.onsale, .woocommerce-page span.onsale, .flex-direction-nav a,
	/* BBPress Classes */
	#bbp_reply_submit, button.button, .bbp-pagination-links a.next.page-numbers, .bbp-pagination-links a.prev.page-numbers, .bbp-logged-in .button.logout-link,
	/* BuddyPress Classes*/
	#buddypress button, #buddypress a.button, #buddypress input[type="submit"], #buddypress input[type="button"], #buddypress input[type="reset"], #buddypress ul.button-nav li a, #buddypress div.generic-button a, #buddypress .comment-reply-link, a.bp-title-button, #buddypress button:hover, #buddypress a.button:hover, #buddypress input[type="submit"]:hover, #buddypress input[type="button"]:hover, #buddypress input[type="reset"]:hover, #buddypress ul.button-nav li a:hover, #buddypress div.generic-button a:hover, #buddypress .comment-reply-link:hover, a.bp-title-button:hover, #buddypress #profile-edit-form ul.button-nav li a, .bp-login-widget-user-links .bp-login-widget-user-logout a,
	/* Events Calender Styles */
	.tribe-events-event-cost span, .tribe-events-loop .hentry .tribe-events-read-more,
	.tribe-events-loop .type-tribe_events .tribe-events-read-more,
	 aside .tribe-events-list-widget .tribe-events-widget-link a,  .tribe-events-tcblock .tribe-events-read-more,  .tribe-events-tcblock .tribe-events-read-more:hover
	 {
		color: #fff;
	   	<?php if (!empty($canon_options_appearance['color_white_text'])) echo "color: ".$canon_options_appearance['color_white_text'].";"; ?>
	}
	
	
	
	
	/* Meta Colour - Light Grey */
	 aside ul li a, aside ul li, .meta, .meta a, ul.link-list li a, caption, .wp-caption-text, .countdown_section, .btn.white-btn:hover, a.btn.white-btn:hover, .multi_navigation_hint, .tweet:before, aside .tweet .meta:before, .twitter_theme_design .tweet .meta:before, .post-type-tweet:before,
	 /* Woo Commerce Classes */
	  .woocommerce-result-count, .woocommerce ul.products li.product .price del, .woocommerce-page ul.products li.product .price del, .summary.entry-summary .price del span,  .woocommerce .cart-collaterals .cart_totals p small, .woocommerce-page .cart-collaterals .cart_totals p small, .woocommerce .star-rating:before, .woocommerce-page .star-rating:before,
	  /* BBPress Classes */
	  .bbp-forum-header a.bbp-forum-permalink, .bbp-topic-header a.bbp-topic-permalink, .bbp-reply-header a.bbp-reply-permalink,
	  #bbpress-forums .bbp-topic-header .bbp-meta a.bbp-topic-permalink, #bbpress-forums #bbp-single-user-details #bbp-user-navigation a,
	  /* BuddyPress Classes*/
	  #buddypress div#item-header div#item-meta,
	  /* Events Calendar Styles */
	  .tribe-events-sub-nav li a:hover, .tribe-events-loop .hentry .tribe-events-venue-details, .tribe-events-loop .type-tribe_events .tribe-events-venue-details, .tribe-events-thismonth div:first-child, .tribe-events-list-widget ol li .duration,  .tribe-events-tcblock .tribe-events-venue-details
	  
	   {
	 	color: #b2b8bd;
	   	<?php if (!empty($canon_options_appearance['color_meta'])) echo "color: ".$canon_options_appearance['color_meta'].";"; ?>
	 }
	
	
	
	
	/* Header Nav - Dark Grey */
	.outter-wrapper.header-container, #nav ul, .price h3, ol.graphs > li div.grey-btn, .btn.grey-btn, .price-cell.feature  {
		background: #2f353f;
	   	<?php if (!empty($canon_options_appearance['color_header_nav'])) echo "background: ".$canon_options_appearance['color_header_nav'].";"; ?>
	}
	
	
	
	
	/* Menu Item Colour */
	.nav ul li a:hover, .nav li.current-menu-ancestor > a, #nav .sub-menu li.current-menu-ancestor > a:hover,  nav li.current-menu-item > a
	
	 {
		color: #ff6666;
	   	<?php if (!empty($canon_options_appearance['color_menu_nav'])) echo "color: ".$canon_options_appearance['color_menu_nav'].";"; ?>
	}
	@media only screen and (max-width: 768px) { 
		#nav .donate a:hover{
			color: #ff6666;
			<?php if (!empty($canon_options_appearance['color_menu_nav'])) echo "color: ".$canon_options_appearance['color_menu_nav'].";"; ?>
		}
	
	}
	
	
	
	/* Third Level Menu - Dark Grey */
	#nav li:hover ul ul, #nav li:hover ul ul:before, .tp-bullets.simplebullets.round .bullet{
		background: #242931;
	   	<?php if (!empty($canon_options_appearance['color_third_nav'])) echo "background: ".$canon_options_appearance['color_third_nav'].";"; ?>
	}
	
	
	
	
	/* Feature Button - Orange */
	#nav .donate a:hover, .btn.orange-btn, a.btn.orange-btn, .btn:hover, a.btn:hover, input[type=submit]:hover, .btn.active, .tp-caption.btn a:hover, a.tp-button,
	ol.graphs > li div, .highlight, #menu-icon, ul.pagination .left a:hover, ul.pagination .right a:hover, ul.paging a:hover span, .tp-caption.btn a, ul.paging a span:hover, ul.page-numbers li a.next:hover, ul.page-numbers li a.prev:hover, ul.paging span:hover, .tp-button.default, .purchase.default, .purchase:hover.default, .price-feature .btn:hover, .price-feature a.btn:hover, .tp-bullets.simplebullets.round .bullet.selected, .skin_earth .pb_supporters .btn,  .skin_corporate .price-table-feature .price-cell.last .btn:hover,  .skin_earth .price-table-feature .price-cell.last .btn:hover,
	/* WOO COMMERCE */
	.woocommerce a.button:hover, .woocommerce button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce #content input.button:hover, .woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover, .woocommerce-page #respond input#submit:hover, .woocommerce-page #content input.button:hover, .woocommerce .shop_table.cart td.actions .button, .woocommerce .shop_table.cart td.actions .button.alt:hover, .woocommerce .woocommerce-message a.button,  .product .cart button.single_add_to_cart_button:hover, #place_order:hover, .woocommerce span.onsale, .woocommerce-page span.onsale, .widget_price_filter .ui-slider .ui-slider-handle,
	/* BBPress Classes */
	#bbp_reply_submit:hover, button.button:hover, .bbp-pagination-links a.next.page-numbers:hover, .bbp-pagination-links a.prev.page-numbers:hover, .bbp-logged-in .button.logout-link:hover,
	/* BudyPress Classes*/
	#buddypress button:hover, #buddypress a.button:hover, #buddypress input[type="submit"]:hover, #buddypress input[type="button"]:hover, #buddypress input[type="reset"]:hover, #buddypress ul.button-nav li a:hover, #buddypress div.generic-button a:hover, #buddypress .comment-reply-link:hover, a.bp-title-button:hover, #buddypress #profile-edit-form ul.button-nav li a:hover, .bp-login-widget-user-logout a:hover,
	/* Events Calender Styles */
	.tribe-events-loop .hentry .tribe-events-read-more:hover, .tribe-events-loop .type-tribe_events .tribe-events-read-more:hover, aside .tribe-events-list-widget .tribe-events-widget-link a:hover,  .tribe-events-tcblock .tribe-events-read-more:hover,
	
	/* GRAVITY FORMS */
	.gf_progressbar_percentage
	
	{
		background-color: #ff6666;
	   	<?php if (!empty($canon_options_appearance['color_feature_button'])) echo "background-color: ".$canon_options_appearance['color_feature_button'].";"; ?>
	}
	
	
	
	
	/* Feature Button 2 - Blue */
	.blue-btn, a.blue-btn, .btn, a.btn, input[type=submit], .flex-control-paging li a.flex-active, .price.price-feature h3,
	ol.graphs > li div.blue-btn, a.tp-button:hover, .tp-button.blue, .purchase.blue, .purchase:hover.blue, .price-table-feature .price-cell.feature,  .skin_corporate .tp-button, .skin_earth .pb_supporters .btn:hover, .skin_earth .pb_supporters .btn.green-btn:hover, 
	/* Woo Commerce Classes */
	p.demo_store, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce #content input.button, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page #content input.button,  .woocommerce span.onsale, .woocommerce-page span.onsale, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit.alt, .woocommerce #content input.button.alt, .woocommerce-page a.button.alt, .woocommerce-page button.button.alt, .woocommerce-page input.button.alt, .woocommerce-page #respond input#submit.alt, .woocommerce-page #content input.button.alt, .woocommerce-message:before, .woocommerce .shop_table.cart td.actions .button.alt, .woocommerce .shop_table.cart td.actions .button:hover, .woocommerce .woocommerce-message a.button:hover,
	/* BBPress Classes */
	#bbp_reply_submit, button.button, .bbp-logged-in .button.logout-link,
	/* BudyPress Classes */
	#buddypress button, #buddypress a.button, #buddypress input[type="submit"], #buddypress input[type="button"], #buddypress input[type="reset"], #buddypress ul.button-nav li a, #buddypress div.generic-button a, #buddypress .comment-reply-link, a.bp-title-button, #buddypress #profile-edit-form ul.button-nav li a, .bp-login-widget-user-logout a,
	/* Events Calender Styles */
	.tribe-events-loop .hentry .tribe-events-read-more,
	.tribe-events-loop .type-tribe_events .tribe-events-read-more, aside .tribe-events-list-widget .tribe-events-widget-link a,  .tribe-events-tcblock .tribe-events-read-more,
	.tribe-events-calendar .tribe-events-has-events:after
	{
		background: #4ec6e9;
	   	<?php if (!empty($canon_options_appearance['color_feature_button_2'])) echo "background: ".$canon_options_appearance['color_feature_button_2'].";"; ?>
	}
	
	
	
	
	/* Feature Button 3 - Green */
	 .tp-caption.btn a:hover, ol.graphs > li div.green-btn,  .vert-line:before, .vert-line:after, .timeline_load_more:hover, .tp-button.green,  .skin_earth .tp-button:hover,
	.purchase.green, .purchase:hover.green, .price-feature .btn, .price-feature a.btn, .skin_corporate .tp-button:hover,  .skin_corporate .price.price-feature h3, .skin_earth .price.price-feature h3, .skin_corporate .price-table-feature .price-cell.feature, .skin_corporate .price-table-feature .price-cell.last .btn, .skin_earth .price-table-feature .price-cell.feature, .skin_earth .price-table-feature .price-cell.last .btn,
	/* Events Calender Styles */
	.tribe-events-event-cost span
	{
		background: #7cbf09;
	   	<?php if (!empty($canon_options_appearance['color_feature_button_3'])) echo "background: ".$canon_options_appearance['color_feature_button_3'].";"; ?>
	}
	
	
	
	
	/* Feature Button 4 - Green */
	.donate, .green-btn, a.green-btn, .skin_earth .pb_supporters .btn.green-btn {
		background: #7cbf09;
	   	<?php if (!empty($canon_options_appearance['color_feature_button_4'])) echo "background: ".$canon_options_appearance['color_feature_button_4'].";"; ?>
	}
	
	
	
	
	
	/* Feature block - Blue */
	.callout-block {
		background: #4ec6e9;
	   	<?php if (!empty($canon_options_appearance['color_feature_block'])) echo "background: ".$canon_options_appearance['color_feature_block'].";"; ?>
	}
	
	
	
	
	/* Feature block 2 - Light Blue */
	.social-block{
		background: #e1f5fb;	
	   	<?php if (!empty($canon_options_appearance['color_feature_block_2'])) echo "background: ".$canon_options_appearance['color_feature_block_2'].";"; ?>
	}
	
	
	
	
	
	/* Light Button - Grey */
	ul.pagination .left a, ul.pagination .right a, ul.paging a span, ul.page-numbers li a.next, ul.page-numbers li a.prev, ul.paging span, ul.tab-nav li, .vert-line,
	/* BBPress Classes */
	.bbp-pagination-links a.next.page-numbers, .bbp-pagination-links a.prev.page-numbers
	{
		background: #E8E8E8;
	   	<?php if (!empty($canon_options_appearance['color_light_button'])) echo "background: ".$canon_options_appearance['color_light_button'].";"; ?>
	}
	
	
	
	
	/* White Button - White */
	.white-btn, a.white-btn,
	/* Events Calender Styles */
	.tribe-events-sub-nav li a
	{
		background: #ffffff;
	   	<?php if (!empty($canon_options_appearance['color_white_button'])) echo "background: ".$canon_options_appearance['color_white_button'].";"; ?>
	}
	
	
	
	
	
	/* Dark Grey Button - Dark Grey */
	#pax, .tp-button.darkgrey, .tp-button.grey, .tp-button:hover.grey, .purchase.darkgrey, .purchase:hover.darkgrey, .skin_corporate .price h3, .skin_corporate .price-cell.feature{
		background: #344158;
	   	<?php if (!empty($canon_options_appearance['color_dark_button'])) echo "background-color: ".$canon_options_appearance['color_dark_button'].";"; ?>
	}
	
	
	
	
	/* Price Table - Light Grey */
	.price, .price-table, .btn.white-btn:hover, a.btn.white-btn:hover, .timeline_load_more, .main table tr:nth-child(2n+1), .main table th, ul.sitemap li a, 
	/* BuddyPress Classes*/
	#bbpress-forums li.bbp-header, #bbpress-forums div.even, #bbpress-forums ul.even, #bbpress-forums li.bbp-header, #bbpress-forums li.bbp-footer, #bbpress-forums div.bbp-forum-header, #bbpress-forums div.bbp-topic-header, #bbpress-forums div.bbp-reply-header,
	/* Events Calender Styles */
	.tribe-events-sub-nav li a:hover
	
	{
		background: #f7f7f7;
	   	<?php if (!empty($canon_options_appearance['color_price_table'])) echo "background: ".$canon_options_appearance['color_price_table'].";"; ?>
	}
	
	
	
	
	/* Form Fields - Light Grey */
	input[type=text],  input[type=email], input[type=password], textarea, input[type=tel],  input[type=range], input[type=url],
	/* Woo Commerce Classes */
	input.input-text, .woocommerce ul.products li.product, .woocommerce ul.products li.product.last .woocommerce-page ul.products li.product, .col2-set.addresses .address, .woocommerce-message, .woocommerce div.product .woocommerce-tabs ul.tabs li, .woocommerce #content div.product .woocommerce-tabs ul.tabs li, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li, .woocommerce #payment, .woocommerce-page #payment, .woocommerce-main-image img, input#coupon_code,  .widget_price_filter .ui-slider .ui-slider-range,
	/* BuddyPress Classes */
	#buddypress .item-list-tabs ul li, #buddypress .standard-form textarea, #buddypress .standard-form input[type="text"], #buddypress .standard-form input[type="text"], #buddypress .standard-form input[type="color"], #buddypress .standard-form input[type="date"], #buddypress .standard-form input[type="datetime"], #buddypress .standard-form input[type="datetime-local"], #buddypress .standard-form input[type="email"], #buddypress .standard-form input[type="month"], #buddypress .standard-form input[type="number"], #buddypress .standard-form input[type="range"], #buddypress .standard-form input[type="search"], #buddypress .standard-form input[type="tel"], #buddypress .standard-form input[type="time"], #buddypress .standard-form input[type="url"], #buddypress .standard-form input[type="week"], #buddypress .standard-form select, #buddypress .standard-form input[type="password"], #buddypress .dir-search input[type="search"], #buddypress .dir-search input[type="text"], #buddypress form#whats-new-form textarea, #buddypress div.activity-comments form textarea, #buddypress div.item-list-tabs ul li.selected a span, #buddypress div.item-list-tabs ul li.current a span
	{
		background: #f2f2f2;
	   	<?php if (!empty($canon_options_appearance['color_form_fields_bg'])) echo "background: ".$canon_options_appearance['color_form_fields_bg'].";"; ?>
		color: #969ca5;
	   	<?php if (!empty($canon_options_appearance['color_form_fields_text'])) echo "color: ".$canon_options_appearance['color_form_fields_text'].";"; ?>
	}
	
	
	
	
	
	/* Elements - Light Grey*/
	.message.promo, ul.timeline > li, ul.tab-nav li.active, .tab-content-block, ul.comments .odd, ol.graphs > li,
	/* Events Calender Styles */
	.tribe-events-loop .hentry, .tribe-events-loop .type-tribe_events, .tribe-events-tcblock
	{
		background: #fbfbfb;
	   	<?php if (!empty($canon_options_appearance['color_elements'])) echo "background: ".$canon_options_appearance['color_elements'].";"; ?>
	}	
	
	
	
	
	/* Border/Rules - Light Grey */
	hr, .right-aside, blockquote.right, fieldset, .main table, .main table th, .main table td, .main ul.meta li, .text-seperator, .tab-nav li.active, .tab-content-block, .tab-nav li, ul.toggle li, .boxed ul.social-link, .btn.white-btn, a.btn.white-btn,  a.white-btn, #fittext2, caption, .wp-caption-text, .tab-content-block, h3.v_nav, .message.promo, ul.timeline > li, ul.accordion li, .timeline_load_more,  li.tl_right:before, li.tl_left:before, .widget.kause_fact p, .cpt_people .social-link, ul.toggle li:first-child, ul.accordion li:first-child, ul.sc_accordion li, .price-detail ul li, .price-detail ul li:last-child, .price-cell, .hr-temp, aside ul li, ul.link-list li, ul.statistics li, .multi_nav_control, .sermon_links, .pb_sermon .sermon_wrapper,
	/* Woo Commerce Classes */
	ul.products li .price, ul.products li h3, .woocommerce #payment div.payment_box, .woocommerce-page #payment div.payment_box, .col2-set.addresses .address, p.myaccount_user, .summary.entry-summary .price,  .summary.entry-summary .price, .product_meta .sku_wrapper, .product_meta .posted_in, .product_meta .tagged_as, .product_meta span:first-child, .woocommerce-message, .related.products, .woocommerce .widget_shopping_cart .total, .woocommerce-page .widget_shopping_cart .total, .woocommerce div.product .woocommerce-tabs ul.tabs li, .woocommerce #content div.product .woocommerce-tabs ul.tabs li, .woocommerce-page div.product .woocommerce-tabs ul.tabs li, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li, .woocommerce div.product .woocommerce-tabs ul.tabs:before, .woocommerce #content div.product .woocommerce-tabs ul.tabs:before, .woocommerce-page div.product .woocommerce-tabs ul.tabs:before, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs:before, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce #reviews #comments ol.commentlist li img.avatar, .woocommerce-page #reviews #comments ol.commentlist li img.avatar, .woocommerce #reviews #comments ol.commentlist li .comment-text, .woocommerce-page #reviews #comments ol.commentlist li .comment-text, .upsells.products, .woocommerce #payment ul.payment_methods, .woocommerce-page #payment ul.payment_methods, .woocommerce form.login, .woocommerce form.checkout_coupon, .woocommerce form.register, .woocommerce-page form.login, .woocommerce-page form.checkout_coupon, .woocommerce-page form.register, .widget_price_filter .price_slider_wrapper .ui-widget-content,
	/* BBPress Classes */
	#bbp-user-navigation ul li, .widget_display_stats dl dt, .widget_display_stats dl dd, #bbpress-forums ul.bbp-lead-topic, #bbpress-forums ul.bbp-topics, #bbpress-forums ul.bbp-forums, #bbpress-forums ul.bbp-replies, #bbpress-forums ul.bbp-search-results, #bbpress-forums li.bbp-body ul.forum, #bbpress-forums li.bbp-body ul.topic, #bbpress-forums li.bbp-header, #bbpress-forums li.bbp-footer, div.bbp-forum-header, div.bbp-topic-header, div.bbp-reply-header,
	/* BudyPress Classes */
	#buddypress .item-list-tabs ul li, #buddypress #item-nav .item-list-tabs ul, #buddypress div#subnav.item-list-tabs, #buddypress #subnav.item-list-tabs li, #bp-login-widget-form, #buddypress #members-directory-form div.item-list-tabs ul li, #buddypress #members-directory-form div.item-list-tabs ul, #buddypress .activity-comments ul li, #buddypress div.activity-comments > ul > li:first-child, #buddypress .item-list-tabs.activity-type-tabs ul, #buddypress div.item-list-tabs ul li a span,
	/* Events Calendar Styles */
	#tribe-bar-form, #tribe-bar-views, .tribe-events-list-separator-month, .tribe-events-loop .hentry, .tribe-events-loop .type-tribe_events, .tribe-events-sub-nav li a, .events-archive.events-gridview #tribe-events-content table .vevent, .single-tribe_events .tribe-events-schedule, .tribe-events-single-section.tribe-events-event-meta, .single-tribe_events #tribe-events-footer, .tribe-events-list-widget ol li, .tribe-events-tcblock,
	
	/* GRAVITY FORMS */
	.gf_progressbar  
	 {
		border-color: #eaeaea!important;
	   	<?php if (!empty($canon_options_appearance['color_lines'])) echo "border-color: ".$canon_options_appearance['color_lines']."!important;"; ?>
	}
	
	
	
		
		
	/* Footer Block - Dark Grey */
	.widget-footer, .widget-footer table {
		background: #2f353f;
	   	<?php if (!empty($canon_options_appearance['color_footer_block'])) echo "background: ".$canon_options_appearance['color_footer_block'].";"; ?>
	}



	/* Footer Base - Dark Grey */
	footer.outter-wrapper, .widget-footer ul.tab-nav li.active, .widget-footer .tab-content-block, .widget-footer table th, .widget-footer table tr:nth-child(2n+1), .widget-footer .tab-content-block h3.v_nav.v_active{
		background: #242931;
	   	<?php if (!empty($canon_options_appearance['color_footer_base'])) echo "background: ".$canon_options_appearance['color_footer_base'].";"; ?>
	}



	/* Footer Headings */
	.widget-footer h3, .widget-footer .tweet:before, .time-date, .widget-footer .tweet > p:before{
		color: #808b9c;
	   	<?php if (!empty($canon_options_appearance['color_footer_headings'])) echo "color: ".$canon_options_appearance['color_footer_headings'].";"; ?>
	}
	
	
	
	
	/* Footer Text */
	.widget-footer, .widget-footer .tweet, .widget-footer a, footer ul.social-link a em:before, .widget-footer ul.accordion li, .widget-footer blockquote{
		color: #ebebeb;
	   	<?php if (!empty($canon_options_appearance['color_footer_text'])) echo "color: ".$canon_options_appearance['color_footer_text'].";"; ?>
	}
	
	
	
	/* Footer Buttons */
	.widget-footer a.btn, .widget-footer .btn{
		background: #4ec6e9;
		<?php if (!empty($canon_options_appearance['color_footer_button'])) echo "background: ".$canon_options_appearance['color_footer_button'].";"; ?>
	}
	
	
	
	/* Footer Form Fields - Grey */
	.widget-footer input[type=text],  .widget-footer input[type=email], .widget-footer input[type=password], .widget-footer input[type=tel], .widget-footer textarea{
		background: #828995;
	   	<?php if (!empty($canon_options_appearance['color_footer_form_fields_bg'])) echo "background: ".$canon_options_appearance['color_footer_form_fields_bg'].";"; ?>
		color: #fff;
	   	<?php if (!empty($canon_options_appearance['color_footer_form_fields_text'])) echo "color: ".$canon_options_appearance['color_footer_form_fields_text'].";"; ?>
	}
	
	
	
	
	/* Footer Form Fields on Focus - Dark Grey */
	.widget-footer input[type=text]:focus,  .widget-footer input[type=email]:focus, .widget-footer input[type=password]:focus, .widget-footer ul.tab-nav li, .widget-footer input[type=tel]:focus, .widget-footer textarea:focus,  .widget-footer .tab-content-block h3.v_nav {
		background: #6d7482;
	   	<?php if (!empty($canon_options_appearance['color_footer_form_fields_focus'])) echo "background: ".$canon_options_appearance['color_footer_form_fields_focus'].";"; ?>
	}
	
	
		
	/* Footer Border/Rules - Dark Grey */
	.widget-footer ul.tab-nav li, .widget-footer .tab-content-block, .widget-footer ul.accordion li, .widget-footer ul.link-list li, .widget-footer ul.statistics li, .widget-footer #bp-login-widget-form, .widget-footer .bbp-login-form fieldset, .widget-footer fieldset, .widget-footer .widget_display_stats dl dd, .widget-footer table, .widget-footer table th, .widget-footer table td, .widget-footer caption, .widget-footer .tab-content-block h3.v_nav{
		border-color: #4B525D!important;
	   	<?php if (!empty($canon_options_appearance['color_footlines'])) echo "border-color: ".$canon_options_appearance['color_footlines']."!important;"; ?>
	}
	@media only screen and (max-width: 768px) { 
		.widget-footer .widget{
			border-color: #4B525D!important;
			<?php if (!empty($canon_options_appearance['color_footlines'])) echo "border-color: ".$canon_options_appearance['color_footlines']."!important;"; ?>
		}
	
	}
	
	
	
	
	/* ==========================================================================
	   HEADER
	   ========================================================================== */
	
	/* LOGO MAX WIDTH */

		.logo{
			max-width: 99px; 
			<?php if (!empty($canon_options['logo_max_width'])) echo "max-width: ".$canon_options['logo_max_width']."px;"; ?>
		}

	/* HEADER PADDING*/

		.header-container header{
			padding-top: 0px;
			<?php if ($canon_options['header_padding_top'] > -1) echo "padding-top: ".$canon_options['header_padding_top']."px;"; ?>

			padding-bottom: 0px;
			<?php if ($canon_options['header_padding_bottom'] > -1) echo "padding-bottom: ".$canon_options['header_padding_bottom']."px;"; ?>
		}   

	/* HEADER ELEMENTS POSITIONING */

		#header_logo {
			position: relative;	
			top: 0px;
			<?php if (!empty($canon_options['pos_logo_top'])) echo "top: ".$canon_options['pos_logo_top']."px;"; ?>
			left: 0px;
			<?php if (!empty($canon_options['pos_logo_left'])) echo "left: ".$canon_options['pos_logo_left']."px;"; ?>
		}

		#nav-wrap {
			position: relative;	
			top: 0px;
			<?php if (!empty($canon_options['pos_nav_top'])) echo "top: ".$canon_options['pos_nav_top']."px;"; ?>
			right: 0px;
			<?php if (!empty($canon_options['pos_nav_right'])) echo "right: ".$canon_options['pos_nav_right']."px;"; ?>
		}

		/* TEXT AS LOGO SIZE */

		.logo-text {
			<?php if (isset($canon_options['logo_text_size'])) echo "font-size: ".$canon_options['logo_text_size']."px;"; ?>
		}

	/* ==========================================================================
		Theme Fonts
	========================================================================== */

		
		/* BODY TEXT */  
		body, h3.v_nav, ul.accordion li, #bbpress-forums, .main .fa *, 
		/* BBPress Classes */
		.bbp-topic-header .bbp-meta, #bbpress-forums .bbp-topic-header .bbp-meta a.bbp-topic-permalink {
			 font-family: Georgia, "Times New Roman", Times, serif;
			<?php if ($canon_options_appearance['font_main'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_main']); ?>
		}
		
		
		/* QUOTE TEXT */   
		.lead, blockquote, .tweet, .post-type-quote, .tweet b, aside .tweet, .widget-footer .tweet, .post-type-tweet, .parallax-block h4, .callout-block h4, .parallax-block h5, .callout-block h5, h4.fittext,
		/* BuddyPress Classes */
		#buddypress div#item-header div#item-meta
		{
			 font-family: Georgia, "Times New Roman", Times, serif;
			<?php if ($canon_options_appearance['font_quote'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_quote']); ?>
		}
		
		/* LOGO TEXT */
		.logo-text{
			 font-family: Georgia, "Times New Roman", Times, serif;
			<?php if ($canon_options_appearance['font_logotext'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_logotext']); ?>
		}
		
		/* BOLD TEXT */ 
		strong, h5, h6, b, .more, ol > li:before, .comment-reply-link, .comment-edit-link, ul.pagination li, ul.paging li, ul.page-numbers li, .link-pages p, #comments_pagination, ol.graphs > li, label, .price h3 span, .feature-link, legend,
		/* BBPress Classes*/
		#bbpress-forums .bbp-forum-title, #bbpress-forums .bbp-topic-permalink, #bbpress-forums div.bbp-forum-title h3, #bbpress-forums div.bbp-topic-title h3, #bbpress-forums div.bbp-reply-title h3, .bbp-pagination-links a, .bbp-pagination-links span.current,
		/* BuddyPress Classes */
		#buddypress .activity-meta a.bp-primary-action span
		  {
			 font-family: 'robotobold';
			 font-weight: normal;
			 font-style: normal;
			<?php if ($canon_options_appearance['font_bold'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_bold']); ?>
		}
		
		
		/* BUTTON TEXT */
		.btn, .tp-button, ol.graphs > li, .btn, input[type=submit], .button,
		/* BuddyPress Classes */
		 #buddypress #profile-edit-form ul.button-nav li a, .bp-login-widget-user-logout a, #buddypress button, #buddypress a.button, #buddypress input[type="submit"], #buddypress input[type="button"], #buddypress input[type="reset"], #buddypress ul.button-nav li a, #buddypress div.generic-button a, #buddypress .comment-reply-link, a.bp-title-button, #buddypress #profile-edit-form ul.button-nav li a, .bp-login-widget-user-logout a,
		 /* Events Calender Styles */
		 .tribe-events-loop .hentry .tribe-events-read-more, 
		 .tribe-events-loop .type-tribe_events .tribe-events-read-more, aside .tribe-events-list-widget .tribe-events-widget-link a,  .tribe-events-tcblock .tribe-events-read-more
		 {
			font-family: 'robotomedium';
			<?php if ($canon_options_appearance['font_button'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_button']); ?>
		}
		
		
		/* ITALIC TEXT */ 
		.error[generated=true], .wp-caption-text, span.wpcf7-not-valid-tip{
			 font-family: 'robotoitalic';
			 font-weight: normal;
			 font-style: normal;
			<?php if ($canon_options_appearance['font_italic'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_italic']); ?>
		}
		
		
		/* MAIN HEADING TEXT */ 
		h1, h2, h3, .coms h4, .text-seperator h5, .countdown_section, h3 label,
		/* Events Calender Styles */
		.tribe-events-tooltip h4, .single-tribe_events .tribe-events-schedule .tribe-events-cost
		{
			 font-family: 'league_gothicregular';
			 font-weight: normal;
			 font-style: normal;
			<?php if ($canon_options_appearance['font_heading'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_heading']); ?>
		}
		
		
		/* NAV STYLE TEXT */ 
		.nav a, #menu-icon, .main ul.meta li, cite, aside ul li, ul.tab-nav li, .boxed h5, .feature-heading p.heading, h6, aside ul li, ul.link-list li, ul.statistics li,
		ul.comments h5, ul.comments h6, input[type=text],  input[type=email], input[type=password], textarea, input[type=tel], input[type=url], input[type=date], input[type=range], .error[generated=true], .corner-date, h3.title,  .widget-footer .tab-content-block h3.v_nav,
		/* BBPress Classes*/
		#bbpress-forums .forum-titles li, .forums.bbp-replies li.bbp-header div, .forums.bbp-replies li.bbp-footer div, #bbpress-forums .forums.bbp-search-results li.bbp-header div, #bbpress-forums .forums.bbp-search-results li.bbp-footer div, #bbpress-forums #bbp-user-wrapper h2.entry-title, #bbpress-forums #bbp-single-user-details #bbp-user-navigation a, .bbp-logged-in h4, .widget_display_stats dl dt,
		/* BudyPress Classes */
		#buddypress .item-list-tabs ul li, #buddypress table th, #buddypress table tr td.label, .widget.buddypress .bp-login-widget-user-links > div.bp-login-widget-user-link a, #buddypress div.activity-comments form div.ac-reply-content a,
		/* Event Calendar Styles */
		.tribe-events-list-separator-month span, .tribe-events-sub-nav li a, .tribe-events-event-cost span, 
		.tribe-events-loop .hentry .time-details,
		 .tribe-events-loop .type-tribe_events .time-details,  
		.tribe-events-loop .hentry .tribe-events-venue-details *,
		.tribe-events-loop .type-tribe_events .tribe-events-venue-details *, 
		.tribe-events-tooltip .date-start.dtstart, .tribe-events-tooltip .date-end.dtend, .tribe-events-list-widget ol li .duration, .tribe-events-tcblock .tribe-events-venue-details, .tribe-events-tcblock  .tribe-events-event-meta
		 {
			font-family: 'RobotoCondensed';
			font-weight: normal;
			font-style: normal;
			<?php if ($canon_options_appearance['font_nav'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_nav']); ?>
		}
		
		
		
		/* WIDGET FOOTER TEXT */ 
		.widget-footer, footer, .widget-footer ul.accordion li {
			font-family: 'robotoregular';
			<?php if ($canon_options_appearance['font_widget_footer'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_widget_footer']); ?>
		}
		
		
		
	/* ==========================================================================
	   Background
	   ========================================================================== */
		   
		 /*Background Option for Site */
		body{
			<?php if (!empty($canon_options_appearance['bg_img_url'])) echo 'background-image: url("' . $canon_options_appearance['bg_img_url'] . '")!important;'; ?>
			<?php if (isset($canon_options_appearance['bg_repeat'])) echo 'background-repeat: ' . $canon_options_appearance['bg_repeat'] . '!important;'; ?>
			<?php if (isset($canon_options_appearance['bg_attachment'])) echo 'background-attachment: ' . $canon_options_appearance['bg_attachment'] .'!important;'; ?>
			background-position: top center;
			<?php if (isset($canon_options_appearance['bg_link'])) { if (!empty($canon_options_appearance['bg_link'])) { echo "cursor: pointer;"; } } ;?>
		} 

		body div {
			cursor: auto;	
		}
		
		@media only screen and (max-width: 768px) { 
				#nav, #nav ul, #nav, #menu-icon.active  {
					background-color: #282D36; 
					<?php if (!empty($canon_options_appearance['color_responsive_menu'])) echo "background-color: ".$canon_options_appearance['color_responsive_menu'].";"; ?>
				}
				
		}  

		    
	/* ==========================================================================
	   FINAL CALL CSS
	   ========================================================================== */
		   
		
		/* FINAL CALL CSS */
		<?php if ($canon_options_advanced['use_final_call_css'] == "checked" && !empty($canon_options_advanced['final_call_css'])) { echo $canon_options_advanced['final_call_css']; } ?>

	</style>