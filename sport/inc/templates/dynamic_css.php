<?php 

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
	
	
	
	
/* ==========================================================================
   THEME COLOURS
   
   
   001. BODY BACKGROUND
   002. MAIN PLATE BACKGROUND
   003. MAIN TEXT
   004. LINKS
   005. LINK HOVER
   006. MAIN HEADINGS
   007. SECONDARY BODY TEXT
   008. TERTIARY BODY TEXT
   009. LOGO AS TEXT
   010. FEATURE COLOR 1
   011. FEATURE COLOR 2
   012. WHITE TEXT
   013. PRE HEADER BACKGROUND
   014. PRE HEADER TEXT	
   015. PRE HEADER TEXT HOVER
   016. HEADER BACKGROUND
   017. HEADER TEXT
   018. HEADER TEXT HOVER
   019. POST HEADER BACKGROUND
   020. POST HEADER TEXT
   021. POST HEADER TEXT HOVER
   022. PRE HEADER TERTIARY MENU BACKGROUND
   023. HEADER TERTIARY MENU BACKGROUND
   024. POST TERTIARY MENU BACKGROUND
   025. SIDR BACKGROUND
   026. SIDR TEXT
   027. SIDR TEXT HOVER
   028. SIDR BORDER
   029. BUTTON 1 BACKGROUND COLOR
   030. BUTTON 1 HOVER BACKGROUND COLOR
   031. BUTTON COLOR 1
   032. FEATURE BACKGROUND COLOR 2
   033. BUTTON 2 HOVER BACKGROUND COLOR
   034. BUTTON COLOR 2
   035. FEATURE BACKGROUND COLOR 3
   036. BUTTON 3 HOVER BACKGROUND COLOR
   037. BUTTON COLOR 3
   038. FEATURE BLOCK 1 BACKGROUND
   039. FEATURE BLOCK 2 BACKGROUND
   040. LITE BLOCKS BACKGROUND
   041 /042. FORM ELEMENTS
   043. MAIN BORDERS
   044. FOOTER BACKGROUND
   045. FOOTER HEADINGS
   046. FOOTER TEXT
   047. FOOTER TEXT HOVER
   048. FOOTER BORDERS
   049. FOOTER BUTTONS
   050. / 051. FOOTER FORMS
   052. FOOTER ALTERNATE BLOCK COLOR
   053. BASELINE BACKGROUND
   054. BASE TEXT
   055. BASE TEXT HOVER	   

   
   ========================================================================== */	
	
	
	
	
/* 
001. BODY BACKGROUND _________________________________________________________ */

 body.boxed-page{
   	background: #f1f1f1;
   	<?php if (!empty($canon_options_appearance['color_body'])) echo "background: ".$canon_options_appearance['color_body']."!important;"; ?>
}







/* 
002. MAIN PLATE BACKGROUND ____________________________________________________ */

.outter-wrapper, .text-seperator-line h5, .comment-num, fieldset.boxy fieldset, .mosaic-backdrop, .tooltipster-default, 
ul.tab-nav li.active, .white-btn, a.white-btn, .white-btn:hover, a.white-btn:hover, .owlCustomNavigation .btn, .owlCustomNavigation .btn:hover, .pb_gallery .main .isotope_filter_menu li a, .boxed-page .tt_event_theme_page:before, .tt_event_theme_page, .main table.tt_timetable tr, .single-events, .pb_gallery .main .isotope_filter_menu li a

 /* WOO COMMERCE */,
 .woocommerce #payment div.payment_box, .woocommerce-page #payment div.payment_box, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active
 
 /* BUDDYPRESS */,
 #buddypress div.item-list-tabs ul li.selected, #buddypress div.item-list-tabs ul li.current, #buddypress div.item-list-tabs ul li.selected a, #buddypress div.item-list-tabs ul li.current a, #buddypress .item-list-tabs.activity-type-tabs ul li.selected, #bbpress-forums div.odd, #bbpress-forums ul.odd
 
 /* EVENTS CALENDAR */,
 .tribe-events-list-separator-month span, .single-tribe_events .tribe-events-schedule .tribe-events-cost, .tribe-events-sub-nav li a
 
 /* TABLEPRESS */,
 .tablepress .even td
  {
   	background: #ffffff;  
   	<?php if (!empty($canon_options_appearance['color_plate'])) echo "background: ".$canon_options_appearance['color_plate'].";"; ?>
}
	
	




	

/* 
003. MAIN TEXT ________________________________________________________________ */  

html, body, button, input, select, textarea, aside .tweet, ul.tab-nav li, ul.accordion li, .accordion-btn,  ul.toggle li, div.post-footer, .main-content .woocommerce-message, .lead, strong, b, pre, .tt_event_theme_page p, .tt_event_items_list li

/* WOO COMMERCE */,
.woocommerce-tabs .comment-text .description, #payment ul.payment_methods.methods p { 
	color: #3d4942;
   	<?php if (!empty($canon_options_appearance['color_general_text'])) echo "color: ".$canon_options_appearance['color_general_text'].";"; ?>
}
	
	
	
	
	
	

/* 
004. LINKS ____________________________________________________________________ */  
a, .boxy blockquote cite, a h4, .tt_tabs_navigation li a{
	color: #3d4942;
	<?php if (!empty($canon_options_appearance['color_links'])) echo "color: ".$canon_options_appearance['color_links'].";"; ?>
}

/* TABLEPRESS */
.dataTables_wrapper .dataTables_paginate a{
	color: #3d4942;
	<?php if (!empty($canon_options_appearance['color_links'])) echo "color: ".$canon_options_appearance['color_links']."!important;"; ?>
}	
	
	
	
	
	

/* 
005. LINK HOVER _______________________________________________________________ */ 

.main a:hover,  #scrollUp:hover, .main h1 a:hover,  a:hover span,  .boxed h5, .main a:hover *, .icon-thirds li:hover em:before,  
h4 span, .boxed ul.social-link a:hover, .meta.option-set a.selected, .page-numbers.current, span.wpcf7-not-valid-tip, .current-cat,  .main .btn.white-btn:hover, .main a.btn.white-btn:hover, .main .owlCustomNavigation .btn:hover, .iconBlock .fa, .media_links a, .pb_gallery .main .isotope_filter_menu li a:hover,  .owlCustomNavigation .btn:hover,  a:hover, ul.tab-nav li:hover, ul.tab-nav li.active, h3.v_nav.v_active, h3.v_nav:hover, ul.sitemap li li a:before, .list-1 li:before, .list-2 li:before, .list-3 li:before, .list-4 li:before, #recaptcha_audio_play_again:before, #recaptcha_audio_download:before, .toggle-btn.active, .accordion-btn.active, a.toggle-btn:before,  a.accordion-btn:before, .boxy ul.social-link a:hover, .boxy .inner-box h5, .active-time a, .tooltip.fa, .event-table td.current-day b:first-child, .tooltipster-content .tt-date, .evt-price, ul.pagination li a.active, .widget-list.option-set li a.selected, .widget-list.option-set li a:hover, .paralax-block .big-count div, .big-count div span,

.tt_tabs_navigation li a:hover, .pb_gallery .main .isotope_filter_menu li a:hover, .page-template-page-gallery-php .gallery-filter li a.selected,
.breadcrumb-wrapper a:hover 

/* BBPRESS */,
#bbpress-forums #bbp-single-user-details #bbp-user-navigation li.current a

/* EVENTS CALENDAR */,
.tribe-events-list-separator-month span, .tribe-events-sub-nav li a, .tribe-events-tooltip .date-start.dtstart, .tribe-events-tooltip .date-end.dtend, .single-tribe_events .tribe-events-schedule .tribe-events-cost

/* TABLEPRESS */,
.paginate_button:hover:before, .paginate_button:hover:after, .dataTables_wrapper .dataTables_paginate a
{
	color: #ffba00;	
	<?php if (!empty($canon_options_appearance['color_links_hover'])) echo "color: ".$canon_options_appearance['color_links_hover'].";"; ?>
}

/* TABLEPRESS */
.dataTables_wrapper .dataTables_paginate a:hover
{
	color: #ffba00;	
	<?php if (!empty($canon_options_appearance['color_links_hover'])) echo "color: ".$canon_options_appearance['color_links_hover']."!important;"; ?>
}
	
	
	
	
	
	
	
	
	

/* 
006. MAIN HEADINGS ____________________________________________________________ */

 h1, h1 a, h2, h2 a, h3, h3 a, h4, h4 a, h5, h6, .feature-link, .icon-thirds li em:before, .countdown_amount,  .caption-cite, .sc_accordion-btn, .accordion-btn, .toggle-btn, .sc_toggle-btn, .text-seperator h5, .big-count div, .tt_event_theme_page h2, .tt_event_theme_page h5, .tt_responsive .tt_timetable.small .box_header, .tt_timetable th, .tt_timetable td, .tt_event_theme_page h4, .tt_event_theme_page h3, .type-cpt_project ul.meta li:first-child strong, .pb_gallery_preview ul.meta li:first-child strong, .page-template-page-gallery-php ul.meta li:first-child strong

/* WOO COMMERCE */,
.woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price, .woocommerce table.cart a.remove:hover, .woocommerce #content table.cart a.remove:hover, .woocommerce-page table.cart a.remove:hover, .woocommerce-page #content table.cart a.remove:hover, .summary.entry-summary .price span,  .woocommerce div.product .woocommerce-tabs ul.tabs li a, .woocommerce #content div.product .woocommerce-tabs ul.tabs li a, .woocommerce-page div.product .woocommerce-tabs ul.tabs li a, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a, mark

/* BBPRESS*/,
#bbpress-forums .bbp-forum-title, #bbpress-forums .bbp-topic-permalink

/* BUDDYPRESS */,
#buddypress .activity-meta a.bp-primary-action span

/* EVENTS CALENDAR */,
.single-tribe_events .tribe-events-schedule *
{
	color: #004720;
   	<?php if (!empty($canon_options_appearance['color_headings'])) echo "color: ".$canon_options_appearance['color_headings'].";"; ?>
}
	
	
	
	
	



/* 
007. SECONDARY BODY TEXT _______________________________________________________ */

.lead, .boxy blockquote, blockquote.post-type-quote, blockquote{
	color: #1c2721;
	<?php if (!empty($canon_options_appearance['color_text_2'])) echo "color: ".$canon_options_appearance['color_text_2'].";"; ?>
}







/* 
008. TERTIARY BODY TEXT _______________________________________________________ */
.meta.date, .rating:not(:checked) > label, .toggle-btn span, .rate-box strong, .star-rating > span,
.time-table tr td:first-child, .event-table td b:first-child, .widget .post-date, .widget .rss-date, .eol *, .paging .half.eol:after, .paging .half.eol:before,
 .paging .half.eol .meta, .breadcrumb-wrapper, .breadcrumb-wrapper a, .meta, .meta a,  caption, .wp-caption-text, .multi_navigation_hint, .tweet:before,  .white-btn, a.white-btn, aside .tweet .meta:before, .twitter_theme_design .tweet .meta:before, .post-type-tweet:before,   .owlCustomNavigation .btn, .sticky:before,
 .milestone-container .time-date, .approval_pending_notice

/* WOO COMMERCE */,
 .woocommerce-result-count, .woocommerce ul.products li.product .price del, .woocommerce-page ul.products li.product .price del, .summary.entry-summary .price del span,  .woocommerce .cart-collaterals .cart_totals p small, .woocommerce-page .cart-collaterals .cart_totals p small, .woocommerce .star-rating:before, .woocommerce-page .star-rating:before, .widget_shopping_cart_content .cart_list li .quantity

/* BBPRESS*/,
  .bbp-forum-header a.bbp-forum-permalink, .bbp-topic-header a.bbp-topic-permalink, .bbp-reply-header a.bbp-reply-permalink,
  #bbpress-forums .bbp-topic-header .bbp-meta a.bbp-topic-permalink, #bbpress-forums #bbp-single-user-details #bbp-user-navigation a

/* BUDDYPRESS */,
  #buddypress div#item-header div#item-meta

/* EVENTS CALENDAR */,
  .tribe-events-sub-nav li a:hover, .tribe-events-event-meta .tribe-events-venue-details, .tribe-events-thismonth div:first-child, .tribe-events-list-widget ol li .duration
  
  {
	color: #bdbdbd;
	<?php if (!empty($canon_options_appearance['color_text_3'])) echo "color: ".$canon_options_appearance['color_text_3'].";"; ?>
}

/* TABLEPRESS */
.dataTables_wrapper .dataTables_paginate a.disabled {
	color: #bdbdbd;
	<?php if (!empty($canon_options_appearance['color_text_3'])) echo "color: ".$canon_options_appearance['color_text_3']."!important;"; ?>
}







/* 
009. LOGO AS TEXT ____________________________________________________________ */
.logo.text{
	color: #ffffff;
	<?php if (!empty($canon_options_appearance['color_text_logo'])) echo "color: ".$canon_options_appearance['color_text_logo'].";"; ?>
}










/* 
010. FEATURE COLOR 1 ____________________________________________________________ */

.feature-link:after, h1 span, h2 span, h1 span, h2 span, h3 span, h6 span,  .widget-footer .tab-nav li.active, .statistics li span,   ol > li:before, h3.v_active,   aside .tweet a, .twitter_theme_design .tweet a,  h3.fittext, .price-cell .inwrap:after,  .widget-footer .tab-content-block h3.v_nav.v_active,  .error[generated=true],  ul.pagination li a.active,  .main .feature-link:hover,  .highlight, .toolbar-search-btn:hover em, div.media_links a:hover, .main-container .countdown_section, .canon_animated_number h1, .feat-1,  a.feat-1, h1 span,  h2 span, h3 span, .highlight, .highlight:before, .highlight:after, a.feat-title:hover, .paging .meta, .paging .col-1-2:before, .paging .col-1-2:after,.tt_event_hours_count, .tt_event_url, .tt_items_list .value

 
 /* WOO COMMERCE */,
 .shipping_calculator h2 a, .woocommerce table.cart a.remove, .woocommerce #content table.cart a.remove, .woocommerce-page table.cart a.remove, .woocommerce-page #content table.cart a.remove, .woocommerce form .form-row .required, .woocommerce-page form .form-row .required, .woocommerce div.product .woocommerce-tabs ul.tabs li a:hover, .woocommerce #content div.product .woocommerce-tabs ul.tabs li a:hover, .woocommerce-page div.product .woocommerce-tabs ul.tabs li a:hover, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a:hover, .woocommerce div.product .stock, .woocommerce #content div.product .stock, .woocommerce-page div.product .stock, .woocommerce-page #content div.product .stock, .woocommerce div.product .out-of-stock, .woocommerce #content div.product .out-of-stock, .woocommerce-page div.product .out-of-stock, .woocommerce-page #content div.product .out-of-stock
 
 /* BBPRESS*/,
 #bbpress-forums .bbp-forum-title:hover, #bbpress-forums .bbp-topic-permalink:hover, .bbp-forum-header a.bbp-forum-permalink:hover, .bbp-topic-header a.bbp-topic-permalink:hover, .bbp-reply-header a.bbp-reply-permalink:hover, #bbpress-forums .bbp-topic-header .bbp-meta a.bbp-topic-permalink:hover, #bbpress-forums #bbp-single-user-details #bbp-user-navigation li a:hover, .widget_display_stats dl dd strong
 
 /* BUDDYPRESS */,
 #buddypress div.item-list-tabs ul li.selected a, #buddypress div.item-list-tabs ul li.current a
 
 /* EVENTS CALENDAR */,
 #tribe-bar-collapse-toggle:hover
 
 
 /* TABLEPRESS */,
 .paginate_button.disabled:after, .paginate_button.disabled:before, .paginate_button:after, .paginate_button:before
{
	color: #14934d;
   	<?php if (!empty($canon_options_appearance['color_feat_text_1'])) echo "color: ".$canon_options_appearance['color_feat_text_1'].";"; ?>
}
span.sportrate, span.quoterate{
	color: #14934d;
	<?php if (!empty($canon_options_appearance['color_feat_text_1'])) echo "color: ".$canon_options_appearance['color_feat_text_1']."!important;"; ?>
}
	






/* 
011. FEATURE COLOR 2 ____________________________________________________________ */

.more:before, .comments .more:before, cite, .main ul li:before, .comment-reply-link:before, .comment-edit-link:before, #cancel-comment-reply-link:before,
ul.toggle .toggle-btn.active, .tab-nav li.active, .accordion-btn.active, .sc_accordion-btn.active, ul.accordion li a.accordion-btn:before, ul.toggle li a.toggle-btn:before, h4.fittext, .statistics li em, .price h3,  .price-cell:first-child p span, .price-cell:after, .tt_event_theme_page ul li:before

 /* WOO COMMERCE */,
 .woocommerce .star-rating span:before, .woocommerce-page .star-rating span:before ,
 
 .tribe-bar-active a
{
	color: #ffba00;	
   	<?php if (!empty($canon_options_appearance['color_feat_text_2'])) echo "color: ".$canon_options_appearance['color_feat_text_2'].";"; ?>
}








/* 
 012. WHITE TEXT ____________________________________________________________ */
 
 .parallax-block h4, .parallax-block h5, .callout-block h5, .widget-footer strong, .btn, input[type=button], input[type=submit], ol.graphs > li div, #menu-icon, .tp-caption.btn a, a.tp-button, #scrollUp, .feature-heading *,  .logo-text, .widget-footer .tab-nav li, nav li.donate.current-menu-item > a,  .timeline_load_more:hover h4, .main a.btn:hover, .price h3 span, .price-table-feature .price-cell.feature p, .price-table-feature .price-cell h3 span, .price-cell.feature h3, .price-cell h3 span, .widget-footer .tab-content-block h3.v_nav, .download-table .fa, .button, a.button:hover, a.btn:hover, .btn:hover .ficon, .ui-autocomplete li, .ui-autocomplete li a, .ui-state-focus, .iconBlock em.fa, .post-tag-cloud a:hover,.mosaic-overlay *, .sport-rs-heading, .sport-rs-text, .corner, .paralax-block.outter-wrapper blockquote, .price h3 span,  .price-cell:first-child p, td.active-time b:first-child, .paralax-block h1, .paralax-block h2, .paralax-block h3, .paralax-block h4, .paralax-block h5, .paralax-block h6, .paralax-block p, .paralax-block .big-count span 
 
 
 /* WOO COMMERCE */,
 .woocommerce span.onsale, .woocommerce-page span.onsale
 
 /* BBPRESS*/,
 #bbp_reply_submit, button.button, .bbp-pagination-links a.next.page-numbers, .bbp-pagination-links a.prev.page-numbers, .bbp-logged-in .button.logout-link
 
 /* BUDDYPRESS */,
 #buddypress button, #buddypress a.button, #buddypress input[type="submit"], #buddypress input[type="button"], #buddypress input[type="reset"], #buddypress ul.button-nav li a, #buddypress div.generic-button a, #buddypress .comment-reply-link, a.bp-title-button, #buddypress button:hover, #buddypress a.button:hover, #buddypress input[type="submit"]:hover, #buddypress input[type="button"]:hover, #buddypress input[type="reset"]:hover, #buddypress ul.button-nav li a:hover, #buddypress div.generic-button a:hover, #buddypress .comment-reply-link:hover, a.bp-title-button:hover, #buddypress #profile-edit-form ul.button-nav li a, .bp-login-widget-user-links .bp-login-widget-user-logout a
 
 /* EVENTS CALENDAR */,
 .tribe-events-event-cost span, a.tribe-events-read-more, a.tribe-events-read-more:hover, .tribe-events-list-widget .tribe-events-widget-link a
  {
 	color: #fff;
    <?php if (!empty($canon_options_appearance['color_white_text'])) echo "color: ".$canon_options_appearance['color_white_text'].";"; ?>
 }








/* 
013. PRE HEADER BACKGROUND ____________________________________________________________ */

.pre-header-container, .pre-header-container ul, .pre-header-container .nav ul, .outter-wrapper.search-header-container,
.pre-header-container .nav ul ul li:hover ul  {
	background: #1c2721;
   	<?php if (!empty($canon_options_appearance['color_preheader_bg'])) echo "background: ".$canon_options_appearance['color_preheader_bg'].";"; ?>
}







/* 
014. PRE HEADER TEXT ____________________________________________________________ */

.pre-header-container, .pre-header-container a, .pre-header-container a *, .pre-header-container .hasCountdown * {
	color: #ffffff;
   	<?php if (!empty($canon_options_appearance['color_preheader'])) echo "color: ".$canon_options_appearance['color_preheader'].";"; ?>
}







/* 
015. PRE HEADER TEXT HOVER ____________________________________________________________ */

.pre-header-container a:hover, .pre-header-container a:hover *,
.pre-header-container li.current-menu-ancestor > a, 
.pre-header-container .sub-menu li.current-menu-ancestor > a:hover,  
.pre-header-container li.current-menu-item > a {
	color: #ffba00;
   	<?php if (!empty($canon_options_appearance['color_preheader_hover'])) echo "color: ".$canon_options_appearance['color_preheader_hover'].";"; ?>
}
	
	
	
	
	
	

/* 
016. HEADER BACKGROUND ____________________________________________________________ */

.outter-wrapper.header-container, .header-container .nav ul, .ui-autocomplete li, .price h3, ol.graphs > li div.grey-btn, .btn.grey-btn, .price-cell.feature, .header-container .nav ul ul li:hover ul  {
	background: #00632c;
   	<?php if (!empty($canon_options_appearance['color_header_bg'])) echo "background: ".$canon_options_appearance['color_header_bg'].";"; ?>
}







/* 
017. HEADER TEXT ____________________________________________________________ */

.header-container, .header-container a, .header-container a *, .header-container .hasCountdown *  {
	color: #ffffff;
   	<?php if (!empty($canon_options_appearance['color_header'])) echo "color: ".$canon_options_appearance['color_header'].";"; ?>
}







/* 
018. HEADER TEXT HOVER ____________________________________________________________ */

.header-container a:hover, .header-container a:hover *,
.header-container li.current-menu-ancestor > a, 
.header-container .sub-menu li.current-menu-ancestor > a:hover,  
.header-container li.current-menu-item > a,
.ui-autocomplete li.ui-state-focus    {
	color: #ffba00;
   	<?php if (!empty($canon_options_appearance['color_header_hover'])) echo "color: ".$canon_options_appearance['color_header_hover'].";"; ?>
}
	
	



	

	

/* 
019. POST HEADER BACKGROUND ____________________________________________________________ */

.post-header-container, .post-header-container .nav ul,
.post-header-container .nav ul ul li:hover ul {
	background: #004720;
   	<?php if (!empty($canon_options_appearance['color_postheader_bg'])) echo "background: ".$canon_options_appearance['color_postheader_bg'].";"; ?>
}







/* 
020. POST HEADER TEXT ____________________________________________________________ */

.post-header-container, .post-header-container a, .post-header-container a *, .post-header-container .hasCountdown *{
	color: #ffffff;
   	<?php if (!empty($canon_options_appearance['color_postheader'])) echo "color: ".$canon_options_appearance['color_postheader'].";"; ?>
}







/* 
021. POST HEADER TEXT HOVER ____________________________________________________________ */

.post-header-container a:hover, .post-header-container a:hover *,
.post-header-container li.current-menu-ancestor > a, 
.post-header-container .sub-menu li.current-menu-ancestor > a:hover,  
.post-header-container li.current-menu-item > a  {
	color: #ffba00;
   	<?php if (!empty($canon_options_appearance['color_postheader_hover'])) echo "color: ".$canon_options_appearance['color_postheader_hover'].";"; ?>
}
	
	
	
	
	

	

/* 
022. PRE HEADER TERTIARY MENU BACKGROUND _________________________________________________ */

 .pre-header-container ul ul.sub-menu ul.sub-menu, .pre-header-container ul li:hover ul ul:before{
	background: #003919;
   	<?php if (!empty($canon_options_appearance['color_third_prenav'])) echo "background: ".$canon_options_appearance['color_third_prenav'].";"; ?>
}







/* 
023. HEADER TERTIARY MENU BACKGROUND ____________________________________________________________ */

.header-container .nav li:hover ul ul, 
.header-container .nav li:hover ul ul:before, 
.tp-bullets.simplebullets.round .bullet{
	background: #003919;
   	<?php if (!empty($canon_options_appearance['color_third_nav'])) echo "background: ".$canon_options_appearance['color_third_nav'].";"; ?>
}







/* 
024. POST TERTIARY MENU BACKGROUND _________________________________________________ */

.post-header-container .nav li:hover ul ul, .post-header-container .nav li:hover ul ul:before{
	background: #003919;
   	<?php if (!empty($canon_options_appearance['color_third_postnav'])) echo "background: ".$canon_options_appearance['color_third_postnav'].";"; ?>
}
	
	
	
	
	

/* 
025. SIDR BACKGROUND ____________________________________________________________ */

.sidr {
	background: #1c2721;
   	<?php if (!empty($canon_options_appearance['color_sidr_bg'])) echo "background: ".$canon_options_appearance['color_sidr_bg'].";"; ?>
}






/* 
026. SIDR TEXT ____________________________________________________________ */

.sidr, .sidr a {
	color: #ffffff;
   	<?php if (!empty($canon_options_appearance['color_sidr'])) echo "color: ".$canon_options_appearance['color_sidr'].";"; ?>
}






/* 
027. SIDR TEXT HOVER ____________________________________________________________ */

.sidr a:hover, .sidr a:hover *  {
	color: #ffba00;
   	<?php if (!empty($canon_options_appearance['color_sidr_hover'])) echo "color: ".$canon_options_appearance['color_sidr_hover'].";"; ?>
}






/* 
028. SIDR BORDER ____________________________________________________________ */

.sidr ul, .sidr li {
	border-color: #2d3a33!important;
		<?php if (!empty($canon_options_appearance['color_sidr_line'])) echo "border-color: ".$canon_options_appearance['color_sidr_line']."!important;"; ?>
}




/* 
029. BUTTON 1 BACKGROUND COLOR  _________________________________________________ */

.header-container .nav .donate a:hover, .feat-1, a.feat-1, .btn.feat-1, .btn.orange-btn, a.btn.orange-btn, .btn:hover, .btn.hover, a.btn:hover, input[type=button]:hover, input[type=submit]:hover, .btn.active, ol.graphs > li div, .tp-caption.btn a,  .purchase.default, .purchase:hover.default,  .tp-bullets.simplebullets.round .bullet.selected, .skin_earth .pb_supporters .btn,  .skin_corporate .price-table-feature .price-cell.last .btn:hover,  .skin_earth .price-table-feature .price-cell.last .btn:hover, .owl-theme .owl-controls .owl-page.active span, .owl-theme .owl-controls.clickable .owl-page:hover span, .search_controls li.search_control_search,  a.btn, button, .price h3, .price-cell:first-child, table td.active-time, .time-table tr:nth-child(n+1):nth-child(even) td.active-time, .event-table tr:nth-child(n+1):nth-child(even) td.active-time, .owl-controls .owl-page span

/* WOO COMMERCE */,
.woocommerce a.button:hover, .woocommerce button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce #content input.button:hover, .woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover, .woocommerce-page #respond input#submit:hover, .woocommerce-page #content input.button:hover, .woocommerce .shop_table.cart td.actions .button, .woocommerce .shop_table.cart td.actions .button.alt:hover, .woocommerce .woocommerce-message a.button,  .product .cart button.single_add_to_cart_button:hover, #place_order:hover, .woocommerce span.onsale, .woocommerce-page span.onsale, .widget_price_filter .ui-slider .ui-slider-handle 

/* BBPRESS */,
#bbp_reply_submit:hover, button.button:hover, .bbp-pagination-links a.next.page-numbers:hover, .bbp-pagination-links a.prev.page-numbers:hover, .bbp-logged-in .button.logout-link:hover

/* BUDDYPRESS */,
#buddypress button:hover, #buddypress a.button:hover, #buddypress input[type="submit"]:hover, #buddypress input[type="button"]:hover, #buddypress input[type="reset"]:hover, #buddypress ul.button-nav li a:hover, #buddypress div.generic-button a:hover, #buddypress .comment-reply-link:hover, a.bp-title-button:hover, #buddypress #profile-edit-form ul.button-nav li a:hover, .bp-login-widget-user-logout a:hover

/* EVENTS CALENDAR */,
.tribe-events-read-more:hover, .tribe-events-list-widget .tribe-events-widget-link a:hover,  .tribe-events-event-cost span

/* GRAVITY FORMS */,
.gf_progressbar_percentage

/* Rev Slider */,
.tp-button.btn

{
	background: #00632c;
   	<?php if (!empty($canon_options_appearance['color_btn_1_bg'])) echo "background: ".$canon_options_appearance['color_btn_1_bg'].";"; ?>
}


	




/* 
030. BUTTON 1 HOVER BACKGROUND COLOR  _________________________________________________ */

.feat-1:hover, a.feat-1:hover, .btn.feat-1:hover, a.btn:hover, button:hover
{
	background: #1c2721;
   	<?php if (!empty($canon_options_appearance['color_btn_1_hover_bg'])) echo "background: ".$canon_options_appearance['color_btn_1_hover_bg'].";"; ?>
}







/* 
031. BUTTON COLOR 1 _________________________________________________ */
.feat-1, a.feat-1, .btn.feat-1, a.btn,  button, .active-time, .active-time a:hover, .active-time .evt-date, a.btn:hover, input[type=button]:hover, input[type=submit]:hover, button:hover
{
	color: #ffffff;
   	<?php if (!empty($canon_options_appearance['color_btn_1'])) echo "color: ".$canon_options_appearance['color_btn_1'].";"; ?>
}
	



	


/* 
032. FEATURE BACKGROUND COLOR 2 _________________________________________________ */

.feat-2, a.feat-2, .btn.feat-2, input[type=button], input[type=submit], .flex-control-paging li a.flex-active, .price.price-feature h3,
ol.graphs > li div.feat-2, .tp-button.blue, .purchase.blue, .purchase:hover.blue, .price-table-feature .price-cell.feature,  a.tp-button, li.search_control_close,  .search_controls li.search_control_search:hover, .price-feature .btn, .price-feature a.btn, .ui-state-focus,
a.btn-2, button.btn-2

/* WOO COMMERCE */,
p.demo_store, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce #content input.button, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page #content input.button,  .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit.alt, .woocommerce #content input.button.alt, .woocommerce-page a.button.alt, .woocommerce-page button.button.alt, .woocommerce-page input.button.alt, .woocommerce-page #respond input#submit.alt, .woocommerce-page #content input.button.alt, .woocommerce-message:before, .woocommerce .shop_table.cart td.actions .button.alt, .woocommerce .shop_table.cart td.actions .button:hover, .woocommerce .woocommerce-message a.button:hover

/* BBPRESS */,
#bbp_reply_submit, button.button, .bbp-logged-in .button.logout-link

/* BUDDYPRESS */,
#buddypress button, #buddypress a.button, #buddypress input[type="submit"], #buddypress input[type="button"], #buddypress input[type="reset"], #buddypress ul.button-nav li a, #buddypress div.generic-button a, #buddypress .comment-reply-link, a.bp-title-button, #buddypress #profile-edit-form ul.button-nav li a, .bp-login-widget-user-logout a

/* EVENTS CALENDAR */,
.tribe-events-list-widget .tribe-events-widget-link a, .tribe-events-read-more,
.tribe-events-calendar .tribe-events-has-events:after
{
	background: #ffba00;
   	<?php if (!empty($canon_options_appearance['color_btn_2_bg'])) echo "background: ".$canon_options_appearance['color_btn_2_bg'].";"; ?>
}







/* 
033. BUTTON 2 HOVER BACKGROUND COLOR  _________________________________________________ */

.feat-2:hover, a.feat-2:hover, .btn.feat-2:hover, a.btn-2:hover, .search_controls li.search_control_close:hover,
input[type=button]:hover,  input[type=submit]:hover, .price-feature .btn:hover, .price-feature a.btn:hover
{
	background-color: #00632c;
   	<?php if (!empty($canon_options_appearance['color_btn_2_hover_bg'])) echo "background: ".$canon_options_appearance['color_btn_2_hover_bg'].";"; ?>
}







/* 
034. BUTTON COLOR 2 _________________________________________________ */
.feat-2, a.feat-2, .btn.feat-2, .btn-2:hover, input[type=button], input[type=submit], .price.price-feature h3, .price-table-feature .price-cell.feature p span
{
	color: #ffffff;
   	<?php if (!empty($canon_options_appearance['color_btn_2'])) echo "color: ".$canon_options_appearance['color_btn_2'].";"; ?>
}
	
		
		





/* 
035. FEATURE BACKGROUND COLOR 3 _________________________________________________ */

ol.graphs > li div.feat-3, .btn.feat-3, a.btn.feat-3, .feat-3,  .vert-line:before, .vert-line:after, .timeline_load_more:hover, .iconBlock em.fa, 
#pax, .purchase.darkgrey, .purchase:hover.darkgrey,  .btn-3, ul.tab-nav li, .vert-line, .owl-theme .owl-controls .owl-page span

/* BBPRESS */,
.bbp-pagination-links a.next.page-numbers, .bbp-pagination-links a.prev.page-numbers

/* WOO COMMERCE */,
.widget_price_filter .ui-slider .ui-slider-range
{
	background: #eaeaea;
   	<?php if (!empty($canon_options_appearance['color_btn_3_bg'])) echo "background: ".$canon_options_appearance['color_btn_3_bg'].";"; ?>
}








/* 
036. BUTTON 3 HOVER BACKGROUND COLOR  _________________________________________________ */

.feat-3:hover, a.feat-3:hover, .btn.feat-3:hover, .post-tag-cloud a:hover, .owl-controls .owl-page span:hover, .btn-3:hover, .owl-page.active span
{
	background: #ffba00;
   	<?php if (!empty($canon_options_appearance['color_btn_3_hover_bg'])) echo "background: ".$canon_options_appearance['color_btn_3_hover_bg'].";"; ?>
}







/* 
037. BUTTON COLOR 3 _________________________________________________ */

.feat-3, a.feat-3, .btn.feat-3, .owl-controls .owl-page span
{
	color: #505a54;
   	<?php if (!empty($canon_options_appearance['color_btn_3'])) echo "color: ".$canon_options_appearance['color_btn_3'].";"; ?>
}
	
	
	

	
	
/* 
038. FEATURE BLOCK 1 BACKGROUND  ___________________________________________ */

.feat-block-1

/* TABLEPRESS */,
table.tablepress tfoot th, table.tablepress thead th,
.tablepress .sorting:hover,
.tablepress .sorting_asc,
.tablepress .sorting_desc{
	background: #f4f4f4;
	<?php if (!empty($canon_options_appearance['color_feat_block_1'])) echo "background: ".$canon_options_appearance['color_feat_block_1'].";"; ?>
}	




	
	
	
/* 
039. FEATURE BLOCK 2 BACKGROUND  ___________________________________________ */

.feat-block-2, .divider {
	background: #ececec;
	<?php if (!empty($canon_options_appearance['color_feat_block_2'])) echo "background: ".$canon_options_appearance['color_feat_block_2'].";"; ?>
}
	





	


/* 
040. LITE BLOCKS BACKGROUND _________________________________________________ */

.price, .price-table, .timeline_load_more, .main table tr:nth-child(2n+1), .main table th, ul.sitemap li a, ul.ophours li:nth-child(2n+2), blockquote.post-type-quote,
table.table-style-1 tr:nth-child(2n+2), table.table-style-1 th, .boxy, .message.promo, .post-container .boxy, 
.boxy.author, ul.comments .odd, .post-tag-cloud a, .box-content, .price, .price-table, .price-cell:after,
.time-table tr:nth-child(n+1):nth-child(even) td, .event-table tr:nth-child(n+1):nth-child(even) td,
.mobile-table tr:nth-child(n+1):nth-child(even) td, .post-excerpt blockquote,  ul.tab-nav li,
ul.timeline > li, ul.tab-nav li.active, .tab-content-block, ul.comments .odd, ol.graphs > li,
.tt_timetable .row_gray, .breadcrumb-wrapper


/* BUDDYPRESS */,
#bbpress-forums li.bbp-header, #bbpress-forums div.even, #bbpress-forums ul.even, #bbpress-forums li.bbp-header, #bbpress-forums li.bbp-footer, #bbpress-forums div.bbp-forum-header, #bbpress-forums div.bbp-topic-header, #bbpress-forums div.bbp-reply-header

/* EVENTS CALENDAR */,
.tribe-events-sub-nav li a:hover, .tribe-events-loop .hentry, .tribe-events-tcblock, .tribe-events-loop .type-tribe_events,

/* TABLEPRESS */,
.tablepress .odd td, .tablepress .row-hover tr:hover td

{
	background-color: #f6f6f6;
   	<?php if (!empty($canon_options_appearance['color_lite_block'])) echo "background: ".$canon_options_appearance['color_lite_block'].";"; ?>
}
	
	
	
	

/* 
041 /042. FORM ELEMENTS _________________________________________________ */

input[type=text],  input[type=email], input[type=password], textarea, input[type=tel],  input[type=range], input[type=url], input[type=number], input[type=search]

/* WOO COMMERCE */,
input.input-text, .woocommerce ul.products li.product, .woocommerce ul.products li.product.last .woocommerce-page ul.products li.product, .col2-set.addresses .address, .woocommerce-message, .woocommerce div.product .woocommerce-tabs ul.tabs li, .woocommerce #content div.product .woocommerce-tabs ul.tabs li, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li, .woocommerce #payment, .woocommerce-page #payment, .woocommerce-main-image img, input#coupon_code

/* BUDDYPRESS */,
#buddypress .item-list-tabs ul li, #buddypress .standard-form textarea, #buddypress .standard-form input[type="text"], #buddypress .standard-form input[type="text"], #buddypress .standard-form input[type="color"], #buddypress .standard-form input[type="date"], #buddypress .standard-form input[type="datetime"], #buddypress .standard-form input[type="datetime-local"], #buddypress .standard-form input[type="email"], #buddypress .standard-form input[type="month"], #buddypress .standard-form input[type="number"], #buddypress .standard-form input[type="range"], #buddypress .standard-form input[type="search"], #buddypress .standard-form input[type="tel"], #buddypress .standard-form input[type="time"], #buddypress .standard-form input[type="url"], #buddypress .standard-form input[type="week"], #buddypress .standard-form select, #buddypress .standard-form input[type="password"], #buddypress .dir-search input[type="search"], #buddypress .dir-search input[type="text"], #buddypress form#whats-new-form textarea, #buddypress div.activity-comments form textarea, #buddypress div.item-list-tabs ul li.selected a span, #buddypress div.item-list-tabs ul li.current a span

{
	background-color: #f6f6f6;
   	<?php if (!empty($canon_options_appearance['color_form_fields_bg'])) echo "background: ".$canon_options_appearance['color_form_fields_bg'].";"; ?>
	color: #969ca5;
   	<?php if (!empty($canon_options_appearance['color_form_fields_text'])) echo "color: ".$canon_options_appearance['color_form_fields_text'].";"; ?>
}

	
	
	
	
	
	
	





/* 
043. MAIN BORDERS _________________________________________________ */

hr, .right-aside, blockquote.right, fieldset, .main table, .main table th, .main table td, .main ul.meta li, .text-seperator .line em, .tab-nav li.active, .tab-content-block, .tab-nav li, ul.toggle li, .boxed ul.social-link, .btn.white-btn, a.btn.white-btn,  a.white-btn, #fittext2, caption, .wp-caption-text, .tab-content-block, h3.v_nav, .message.promo, ul.timeline > li, ul.accordion li, .timeline_load_more,  li.tl_right:before, li.tl_left:before, .widget.sport_fact p, .cpt_people .social-link, ul.toggle li:first-child, ul.accordion li:first-child, ul.sc_accordion li, .price-detail ul li, .price-detail ul li:last-child, .price-cell, .hr-temp, aside ul li, ul.link-list li, ul.statistics li, .multi_nav_control, .left-aside, .menuList .third, .menuList .half, .menuList .full, .menuList > .fourth, .post-tag-cloud a:first-child:after, blockquote, .owlCustomNavigation .btn, .pb_media .media_wrapper, .media_links, .pb_gallery .main .isotope_filter_menu li a, .text-seperator .line em, ul.ophours li, ul.ophours,
input[type=text],  input[type=email], input[type=password], textarea, input[type=tel],  input[type=range], input[type=url], input[type=number], input[type=search], .tc-page-heading, .paging, .paging .half.prev, blockquote.right, blockquote.left, .tt_event_page_right, .tt_upcoming_events_wrapper p.message, .page-template-page-gallery-php .gallery-filter li a, .tt_event_page_right ul li

/* WOO COMMERCE */,
ul.products li .price, ul.products li h3, .woocommerce #payment div.payment_box, .woocommerce-page #payment div.payment_box, .col2-set.addresses .address, p.myaccount_user, .summary.entry-summary .price,  .summary.entry-summary .price, .product_meta .sku_wrapper, .product_meta .posted_in, .product_meta .tagged_as, .product_meta span:first-child, .woocommerce-message, .related.products, .woocommerce .widget_shopping_cart .total, .woocommerce-page .widget_shopping_cart .total, .woocommerce div.product .woocommerce-tabs ul.tabs li, .woocommerce #content div.product .woocommerce-tabs ul.tabs li, .woocommerce-page div.product .woocommerce-tabs ul.tabs li, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li, .woocommerce div.product .woocommerce-tabs ul.tabs:before, .woocommerce #content div.product .woocommerce-tabs ul.tabs:before, .woocommerce-page div.product .woocommerce-tabs ul.tabs:before, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs:before, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce #reviews #comments ol.commentlist li img.avatar, .woocommerce-page #reviews #comments ol.commentlist li img.avatar, .woocommerce #reviews #comments ol.commentlist li .comment-text, .woocommerce-page #reviews #comments ol.commentlist li .comment-text, .upsells.products, .woocommerce #payment ul.payment_methods, .woocommerce-page #payment ul.payment_methods, .woocommerce form.login, .woocommerce form.checkout_coupon, .woocommerce form.register, .woocommerce-page form.login, .woocommerce-page form.checkout_coupon, .woocommerce-page form.register,
 .widget_price_filter .price_slider_wrapper .ui-widget-content

/* BBPRESS */,
#bbp-user-navigation ul li, .widget_display_stats dl dt, .widget_display_stats dl dd, #bbpress-forums ul.bbp-lead-topic, #bbpress-forums ul.bbp-topics, #bbpress-forums ul.bbp-forums, #bbpress-forums ul.bbp-replies, #bbpress-forums ul.bbp-search-results, #bbpress-forums li.bbp-body ul.forum, #bbpress-forums li.bbp-body ul.topic, #bbpress-forums li.bbp-header, #bbpress-forums li.bbp-footer, div.bbp-forum-header, div.bbp-topic-header, div.bbp-reply-header,

/* BUDDYPRESS */
#buddypress .item-list-tabs ul li, #buddypress #item-nav .item-list-tabs ul, #buddypress div#subnav.item-list-tabs, #buddypress #subnav.item-list-tabs li, #bp-login-widget-form, #buddypress #members-directory-form div.item-list-tabs ul li, #buddypress #members-directory-form div.item-list-tabs ul, #buddypress .activity-comments ul li, #buddypress div.activity-comments > ul > li:first-child, #buddypress .item-list-tabs.activity-type-tabs ul, #buddypress div.item-list-tabs ul li a span,

/* EVENTS CALENDAR */
#tribe-bar-form, #tribe-bar-views, .tribe-events-list-separator-month, .tribe-events-loop .hentry, .tribe-events-loop .type-tribe_events, .tribe-events-sub-nav li a, .events-archive.events-gridview #tribe-events-content table .vevent, .single-tribe_events .tribe-events-schedule, .tribe-events-single-section.tribe-events-event-meta, .single-tribe_events #tribe-events-footer, .tribe-events-list-widget ol li, .tribe-events-tcblock,

/* GRAVITY FORMS */
.gf_progressbar 
 {
	border-color: #eaeaea!important;
   	<?php if (!empty($canon_options_appearance['color_lines'])) echo "border-color: ".$canon_options_appearance['color_lines']."!important;"; ?>
}



	




/* 
044. FOOTER BACKGROUND _________________________________________________ */

.widget-footer, .widget-footer table {
	background: #004720;
   	<?php if (!empty($canon_options_appearance['color_footer_block'])) echo "background: ".$canon_options_appearance['color_footer_block'].";"; ?>
}







/* 
045. FOOTER HEADINGS _________________________________________________ */

.widget-footer h3, .time-date, .footer-wrapper h1, .footer-wrapper h2, .footer-wrapper h3, .footer-wrapper strong
{
	color: #ffffff;
   	<?php if (!empty($canon_options_appearance['color_footer_headings'])) echo "color: ".$canon_options_appearance['color_footer_headings'].";"; ?>
}








/* 
046. FOOTER TEXT _________________________________________________ */
	
.widget-footer, .widget-footer .tweet, .widget-footer a, .widget-footer ul.accordion li, .widget-footer blockquote, .widget-footer .tweet a, .widget-footer .tweet a *, .widget-footer cite, .footer-wrapper, .footer-wrapper a 
{
	color: #f0f6f3;
   	<?php if (!empty($canon_options_appearance['color_footer_text'])) echo "color: ".$canon_options_appearance['color_footer_text'].";"; ?>
}







/* 
047. FOOTER TEXT HOVER _________________________________________________ */

.widget-footer a:hover, .widget-footer ul li:before,  .widget-footer .tweet:before,  .widget-footer .tweet > p:before,  
.widget-footer ul.social-link a:hover em:before, .widget-footer .tweet a:hover, .widget-footer .tweet a:hover *, .footer-wrapper a:hover, .footer-wrapper ul li:before
 {
	color: #ffba00;
   	<?php if (!empty($canon_options_appearance['color_footer_text_hover'])) echo "color: ".$canon_options_appearance['color_footer_text_hover'].";"; ?>
}
	






/* 
048. FOOTER BORDERS  _________________________________________________ */

.widget-footer ul.tab-nav li, .widget-footer .tab-content-block, .widget-footer ul.accordion li, .widget-footer ul.link-list li, .widget-footer ul.statistics li, .widget-footer #bp-login-widget-form, .widget-footer .bbp-login-form fieldset, .widget-footer fieldset, .widget-footer .widget_display_stats dl dd, .widget-footer table, .widget-footer table th, .widget-footer table td, .widget-footer caption, .widget-footer .tab-content-block h3.v_nav, .widget-footer ul li, .widget-footer ul, .footer-wrapper .tag-cloud a,  .footer-wrapper .col-1-5, .footer-wrapper ul.list-1 li, .footer-wrapper ul.list-2 li, .footer-wrapper ul.list-3 li, .footer-wrapper .wrapper > .col-1-2, .footer-wrapper .wrapper > .col-1-3, .footer-wrapper .wrapper > .col-1-4, .footer-wrapper .wrapper > .col-1-5, .footer-wrapper .wrapper > .col-2-3, .footer-wrapper .wrapper > .col-3-4, .footer-wrapper .wrapper > .col-2-5, .footer-wrapper .wrapper > .col-3-5,
.footer-wrapper .wrapper > .col-4-5

{
	border-color: #255f3f!important;
   	<?php if (!empty($canon_options_appearance['color_footlines'])) echo "border-color: ".$canon_options_appearance['color_footlines']."!important;"; ?>
}
@media only screen and (max-width: 768px) { 
	.widget-footer .widget{
		border-color: #255f3f!important;
		<?php if (!empty($canon_options_appearance['color_footlines'])) echo "border-color: ".$canon_options_appearance['color_footlines']."!important;"; ?>
	}

}





/* 
049. FOOTER BUTTONS _________________________________________________ */

.widget-footer a.btn, .widget-footer .btn{
	background: #ffba00;
	<?php if (!empty($canon_options_appearance['color_footer_button'])) echo "background: ".$canon_options_appearance['color_footer_button'].";"; ?>
}







/* 
050. / 051. FOOTER FORMS  _________________________________________________ */

.widget-footer input[type=text], .widget-footer input[type=search],  .widget-footer input[type=email], .widget-footer input[type=password], .widget-footer input[type=tel], .widget-footer textarea{
	background: #003919;
   	<?php if (!empty($canon_options_appearance['color_footer_form_fields_bg'])) echo "background: ".$canon_options_appearance['color_footer_form_fields_bg'].";"; ?>
	color: #f0f6f3;
   	<?php if (!empty($canon_options_appearance['color_footer_form_fields_text'])) echo "color: ".$canon_options_appearance['color_footer_form_fields_text'].";"; ?>
}







/* 
052. FOOTER ALTERNATE BLOCK COLOR  _________________________________________________ */

.widget-footer input[type=text]:focus,  .widget-footer input[type=email]:focus, .widget-footer input[type=password]:focus, .widget-footer ul.tab-nav li, .widget-footer input[type=tel]:focus, .widget-footer textarea:focus,  .widget-footer .tab-content-block h3.v_nav, .pb_posts_graph {
	background: #1c2721;
   	<?php if (!empty($canon_options_appearance['color_footer_alt_block'])) echo "background: ".$canon_options_appearance['color_footer_alt_block'].";"; ?>
}
	
	
	





/* 
053. BASELINE BACKGROUND _________________________________________________ */

div.post-footer, .widget-footer ul.tab-nav li.active, .widget-footer .tab-content-block, .widget-footer table th, .widget-footer table tr:nth-child(2n+1), .widget-footer .tab-content-block h3.v_nav.v_active, .base-wrapper{
	background: #1c2721;
   	<?php if (!empty($canon_options_appearance['color_footer_base'])) echo "background: ".$canon_options_appearance['color_footer_base'].";"; ?>
}





/* 
054. BASE TEXT _____________________________________________________________ */
div.post-footer *{
	color: #ffffff;
	<?php if (!empty($canon_options_appearance['color_footer_base_text'])) echo "color: ".$canon_options_appearance['color_footer_base_text'].";"; ?>
}





/* 
055. BASE TEXT HOVER  ______________________________________________________ */
div.post-footer a:hover, div.post-footer ul.social-link a:hover em:before{
	color: #ffba00;
	<?php if (!empty($canon_options_appearance['color_footer_base_text_hover'])) echo "color: ".$canon_options_appearance['color_footer_base_text_hover'].";"; ?>
}







	
	
	
	
	
	
	
	
	
	
	
	
	
	/* ==========================================================================
	   HEADER
	   ========================================================================== */
	
	/* LOGO MAX WIDTH */

		.logo{
			max-width: 135px; 
			<?php if (!empty($canon_options_frame['logo_max_width'])) echo "max-width: ".$canon_options_frame['logo_max_width']."px;"; ?>
		}

	/* HEADER PADDING*/

		.header-container .wrapper{
			padding-top: 0px;
			<?php if ($canon_options_frame['header_padding_top'] > -1) echo "padding-top: ".$canon_options_frame['header_padding_top']."px;"; ?>

			padding-bottom: 0px;
			<?php if ($canon_options_frame['header_padding_bottom'] > -1) echo "padding-bottom: ".$canon_options_frame['header_padding_bottom']."px;"; ?>
		}   

	/* HEADER ELEMENTS POSITIONING */

		.main-header.left {
			position: relative;	
			top: 0px;
			<?php if (!empty($canon_options_frame['pos_left_element_top'])) echo "top: ".$canon_options_frame['pos_left_element_top']."px;"; ?>
			left: 0px;
			<?php if (!empty($canon_options_frame['pos_left_element_left'])) echo "left: ".$canon_options_frame['pos_left_element_left']."px;"; ?>
		}

		.main-header.right {
			position: relative;	
			top: 0px;
			<?php if (!empty($canon_options_frame['pos_right_element_top'])) echo "top: ".$canon_options_frame['pos_right_element_top']."px;"; ?>
			right: 0px;
			<?php if (!empty($canon_options_frame['pos_right_element_right'])) echo "right: ".$canon_options_frame['pos_right_element_right']."px;"; ?>
		}

	/* TEXT AS LOGO SIZE */

		.logo-text {
			<?php if (isset($canon_options_frame['logo_text_size'])) echo "font-size: ".$canon_options_frame['logo_text_size']."px;"; ?>
		}


	/* ANIMATE MENUS */

		<?php if (isset($canon_options_appearance['anim_menus'])) {echo $canon_options_appearance['anim_menus'];} ?> > li {
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

				printf('%s: %spx;', $anim_menus_enter, $anim_menus_move);
			?>
		}












	/* ==========================================================================
		Theme Fonts
	========================================================================== */



		
		/* ----------------------------------------||||||||| BODY TEXT |||||||||||------------------------------------------------ */
		/* ----------------------------------------------------------------------------------------------------------------------- */
		
		/* BODY TEXT */  
		body, ul.accordion li, #bbpress-forums, .main .fa *, .pre-header-container nav a, .tt_event_theme_page p, .tt_event_items_list li, .tt_upcoming_events li .tt_upcoming_events_event_container .tt_upcoming_events_hours, table.tt_timetable, .tt_responsive .tt_timetable.small .tt_items_list a, .tt_responsive .tt_timetable.small .tt_items_list span, .single-cpt_people ul.meta li.person-info, .single-cpt_people ul.meta li.person-info li,
		.sidr #nav-wrap a, .sticky-header-wrapper .countdown 
		
		/* BBRESS */,
		.bbp-topic-header .bbp-meta, #bbpress-forums .bbp-topic-header .bbp-meta a.bbp-topic-permalink {
			 font-family: 'robotolight';
			<?php if ($canon_options_appearance['font_main'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_main']); ?>
		}
		
		
		
		
		
		/* ----------------------------------------||||||||| QUOTE TEXT |||||||||||------------------------------------------------ */
		/* ------------------------------------------------------------------------------------------------------------------------ */
		
		/* QUOTE TEXT */   
		blockquote, .tweet, .post-type-quote, .tweet b, aside .tweet, .widget-footer .tweet, .post-type-tweet, .parallax-block h4, .parallax-block h5, .callout-block h5,
		
		/* BUDDYPRESS */
		#buddypress div#item-header div#item-meta
		{
			 font-family: 'antic_slabregular';
			<?php if ($canon_options_appearance['font_quote'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_quote']); ?>
		}
		
		
		
		
		/* ----------------------------------------||||||||| LEAD TEXT |||||||||||------------------------------------------------- */
		/* ------------------------------------------------------------------------------------------------------------------------ */
		
		/* LEADIN TEXT */ 
		.lead{
			   font-family: 'robotolight';
			<?php if ($canon_options_appearance['font_lead'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_lead']); ?>
		}
		
		
		
		
		
		/* ----------------------------------------||||||||| LOGO TEXT |||||||||||------------------------------------------------- */
		/* ------------------------------------------------------------------------------------------------------------------------ */
		
		/* LOGO TEXT */
		.logo-text{
			 font-family: 'chunkfiveregular';
			<?php if ($canon_options_appearance['font_logotext'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_logotext']); ?>
		}
		
		
		
		
		/* ----------------------------------------||||||||| BOLD TEXT |||||||||||------------------------------------------------- */
		/* ------------------------------------------------------------------------------------------------------------------------ */
					
		/* BOLD TEXT */ 
		strong, h5, h6, b, .more, ol > li:before, .comment-reply-link, .comment-edit-link, ul.pagination li, ul.paging li, ul.page-numbers li, .link-pages p, #comments_pagination, ol.graphs > li, label, .feature-link, legend, ul.tab-nav li, h6.meta, .main table th, .widget_rss ul li a.rsswidget, ul.sitemap > li > a, .tt_upcoming_events li .tt_upcoming_events_event_container,  .tt_event_theme_page h5, .tt_timetable .event a, .tt_timetable .event .event_header, .tt_responsive .tt_timetable.small .box_header, .page-template-page-gallery-php .gallery-filter li a,  ul.canon_breadcrumbs, ul.canon_breadcrumbs a, ul.page-numbers li a.page-numbers,
		
		/* WOO COMMERCE*/
		.woocommerce span.onsale, .woocommerce-page span.onsale,
		
		/* BBPRESS*/
		#bbpress-forums .bbp-forum-title, #bbpress-forums .bbp-topic-permalink, #bbpress-forums div.bbp-forum-title h3, #bbpress-forums div.bbp-topic-title h3, #bbpress-forums div.bbp-reply-title h3, .bbp-pagination-links a, .bbp-pagination-links span.current,
		
		/* BUDDYPRESS */
		#buddypress .activity-meta a.bp-primary-action span
		
		/* TABLEPRESS */,
		.dataTables_paginate a
		  {
			 font-family: 'robotomedium';
			<?php if ($canon_options_appearance['font_bold'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_bold']); ?>
		}
		
		
		
		
		
		/* ----------------------------------------||||||||| BUTTON TEXT |||||||||||------------------------------------------------- */
		/* -------------------------------------------------------------------------------------------------------------------------- */
		
		/* BUTTON TEXT */
		.btn, .tp-button, ol.graphs > li, .btn, input[type=button], input[type=submit], .button, .tt_tabs_navigation li a, .responsive-menu-button,
		
		/* BUDDYPRESS */
		 #buddypress #profile-edit-form ul.button-nav li a, .bp-login-widget-user-logout a, #buddypress button, #buddypress a.button, #buddypress input[type="submit"], #buddypress input[type="button"], #buddypress input[type="reset"], #buddypress ul.button-nav li a, #buddypress div.generic-button a, #buddypress .comment-reply-link, a.bp-title-button, #buddypress #profile-edit-form ul.button-nav li a, .bp-login-widget-user-logout a, .tt_timetable .hours,
		 
		 /* EVENTS CALENDAR */
		 .tribe-events-read-more, .tribe-events-list-widget .tribe-events-widget-link a,
		 
		 /* REVOLUTION SLIDER */
		 a.tp-button
		 {
			font-family: 'robotomedium';
			<?php if ($canon_options_appearance['font_button'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_button']); ?>
		}
		
		
		
		
		
		/* ----------------------------------------||||||||| ITALIC TEXT |||||||||||------------------------------------------------- */
		/* -------------------------------------------------------------------------------------------------------------------------- */
		
		/* ITALIC TEXT */ 
		.error[generated=true], .wp-caption-text, span.wpcf7-not-valid-tip{
			 font-family: 'robotolight_italic';
			<?php if ($canon_options_appearance['font_italic'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_italic']); ?>
		}
		
		
		
		
		
		/* ----------------------------------------||||||||| MAIN HEADINGS TEXT |||||||||||------------------------------------------------- */
		/* --------------------------------------------------------------------------------------------------------------------------------- */
		
		/* MAIN HEADING TEXT */ 
		h1, h2, h3, .coms h4, .countdown_section, blockquote.bq2 cite, .widget-footer h3, .callout-block h4, .text-seperator h5,  cite,
		.price-cell:first-child p span, .tt_event_theme_page h2,  h5.box_header, .tt_event_theme_page h3, .type-cpt_project ul.meta li:first-child strong,
		.pb_gallery_preview ul.meta li:first-child strong, .page-template-page-gallery-php ul.meta li:first-child strong
		
		 /* EVENTS CALENDAR */,
		.tribe-events-tooltip h4, .single-tribe_events .tribe-events-schedule .tribe-events-cost
		{
			 font-family: 'chunkfiveregular';
			<?php if ($canon_options_appearance['font_heading'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_heading']); ?>
		}
		
		
		
		
		
		/* ----------------------------------------||||||||| SECOND HEADINGS TEXT |||||||||||------------------------------------------------- */
		/* ----------------------------------------------------------------------------------------------------------------------------------- */
		
		/* SECOND HEADINGS TEXT */
		 h4, h5, h3 label, h6, .sc_accordion-btn, .accordion-btn, .toggle-btn, .sc_toggle-btn, .canon_animated_number h1, .countdown_amount, h4.fittext,  .price h3 span,
		 .price-cell:first-child p, .tt_event_theme_page h4
		{
			  font-family: 'robotobold';
			<?php if ($canon_options_appearance['font_heading2'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_heading2']); ?>
		}
		
		
		
		
		
		
		/* ----------------------------------------------------||||||||| NAV TEXT |||||||||||------------------------------------------------- */
		/* ----------------------------------------------------------------------------------------------------------------------------------- */
		
		/* NAV STYLE TEXT */ 
		.nav a, #menu-icon, .main ul.meta li, .boxed h5, .feature-heading p.heading, ul.statistics li, 
		ul.comments h5, ul.comments h6, .error[generated=true], .corner-date, h3.title, .tab-content-block h3.v_nav,  
		
		/* BBPRESS */
		#bbpress-forums .forum-titles li, .forums.bbp-replies li.bbp-header div, .forums.bbp-replies li.bbp-footer div, #bbpress-forums .forums.bbp-search-results li.bbp-header div, #bbpress-forums .forums.bbp-search-results li.bbp-footer div, #bbpress-forums #bbp-user-wrapper h2.entry-title, #bbpress-forums #bbp-single-user-details #bbp-user-navigation a, .bbp-logged-in h4, .widget_display_stats dl dt,
		
		/* BUDDYPRESS */
		#buddypress .item-list-tabs ul li, #buddypress table th, #buddypress table tr td.label, .widget.buddypress .bp-login-widget-user-links > div.bp-login-widget-user-link a, #buddypress div.activity-comments form div.ac-reply-content a,
		
		/* EVENTS CALENDAR */
		.tribe-events-list-separator-month span, .tribe-events-sub-nav li a, .tribe-events-event-cost span, .tribe-events-event-meta .time-details, .tribe-events-event-meta .tribe-events-venue-details *, .tribe-events-tooltip .date-start.dtstart, .tribe-events-tooltip .date-end.dtend, .tribe-events-list-widget ol li .duration
		 {
			font-family: 'robotobold';
			<?php if ($canon_options_appearance['font_nav'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_nav']); ?>
		}
		
		
		
		
		
		/* ----------------------------------------------------||||||||| NAV TEXT |||||||||||------------------------------------------------- */
		/* ----------------------------------------------------------------------------------------------------------------------------------- */
		
		/* WIDGET FOOTER TEXT */ 
		.widget-footer, footer, .widget-footer ul.accordion li {
			font-family: 'robotolight';
			<?php if ($canon_options_appearance['font_widget_footer'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_widget_footer']); ?>
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	/* ==========================================================================
	   Background
	   ========================================================================== */
		   
		 /*Background Option for Site */
		body.boxed-page{
			<?php if (!empty($canon_options_appearance['bg_img_url'])) echo 'background-image: url("' . $canon_options_appearance['bg_img_url'] . '")!important;'; ?>
			<?php if (isset($canon_options_appearance['bg_repeat'])) echo 'background-repeat: ' . $canon_options_appearance['bg_repeat'] . '!important;'; ?>
			<?php if (isset($canon_options_appearance['bg_attachment'])) echo 'background-attachment: ' . $canon_options_appearance['bg_attachment'] .'!important;'; ?>
			background-position: top center;
			<?php if (isset($canon_options_appearance['bg_link'])) { if (!empty($canon_options_appearance['bg_link'])) { echo "cursor: pointer;"; } } ;?>
		} 

		body div {
			cursor: auto;	
		}
		
		 

		    
	/* ==========================================================================
	   FINAL CALL CSS
	   ========================================================================== */
		   
		
		/* FINAL CALL CSS */
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