<?php
ob_start();
$thm_options = get_option('webnus_options');


/*
 * Body style
*/
if (!empty($thm_options['webnus_background_pattern']) && ($thm_options['webnus_background_pattern'] != 'none')) {
	echo "body{background-image:url('{$thm_options['webnus_background_pattern']}') !important; background-repeat:repeat;} ";
}

/*
 * Header Style
*/
if(!empty($thm_options['webnus_container_width']))
{
	$w_value = trim ($thm_options['webnus_container_width']);
	if($w_value){
		if(substr($w_value,-2,2)!="px"){$w_value.='px';};
		echo esc_attr( "#wrap .container {max-width:{$w_value};}\n\n" );
	}
}

if(!empty($thm_options['webnus_header_padding_top']))
{
	$w_value = trim ($thm_options['webnus_header_padding_top']);
	if($w_value){
		if(substr($w_value,-2,2)!="px"){$w_value.='px';};
		echo esc_attr( "#header {padding-top:{$w_value};}\n\n" );
	}
}

if(!empty($thm_options['webnus_header_padding_bottom']))
{
	$w_value = trim ($thm_options['webnus_header_padding_bottom']);
	if($w_value){
		if(substr($w_value,-2,2)!="px"){$w_value.='px';};
		echo esc_attr( "#header {padding-bottom:{$w_value};}\n\n" );
	}
}

/*
 * Custom Fonts For P,H Tags
*/
$w_custom_font1_src = $w_custom_font2_src = $w_custom_font3_src ='';

//custom-font-1 font-face

  if(isset($thm_options['webnus_custom_font1_eot']))
    $w_custom_font1_src[] = "url('{$thm_options['webnus_custom_font1_eot']['url']}?#iefix') format('embedded-opentype')";
  if(isset($thm_options['webnus_custom_font1_woff']))   
    $w_custom_font1_src[] = "url('{$thm_options['webnus_custom_font1_woff']['url']}') format('woff')";
  if(isset($thm_options['webnus_custom_font1_ttf']))
    $w_custom_font1_src[] = "url('{$thm_options['webnus_custom_font1_ttf']['url']}') format('truetype')";

if($w_custom_font1_src !='')
{
  $w_custom_font1_src= implode(",\n",$w_custom_font1_src);
  echo "@font-face {
  font-family: 'custom-font-1';
  font-style: normal;
  font-weight: normal;
  src: {$w_custom_font1_src};\n}\n";
}

//custom-font-2 font-face

  if(isset($thm_options['webnus_custom_font2_eot']))
    $w_custom_font2_src[] = "url('{$thm_options['webnus_custom_font2_eot']['url']}?#iefix') format('embedded-opentype')";
  if(isset($thm_options['webnus_custom_font2_woff']))   
    $w_custom_font2_src[] = "url('{$thm_options['webnus_custom_font2_woff']['url']}') format('woff')";
  if(isset($thm_options['webnus_custom_font2_ttf']))
    $w_custom_font2_src[] = "url('{$thm_options['webnus_custom_font2_ttf']['url']}') format('truetype')";

if($w_custom_font2_src !='')
{
  $w_custom_font2_src= implode(",\n",$w_custom_font2_src);
  echo "@font-face {
  font-family: 'custom-font-2';
  font-style: normal;
  font-weight: normal;
  src: {$w_custom_font2_src};\n}\n";
}

//custom-font-3 font-face

  if(isset($thm_options['webnus_custom_font3_eot']))
    $w_custom_font3_src[] = "url('{$thm_options['webnus_custom_font3_eot']['url']}?#iefix') format('embedded-opentype')";
  if(isset($thm_options['webnus_custom_font3_woff']))   
    $w_custom_font3_src[] = "url('{$thm_options['webnus_custom_font3_woff']['url']}') format('woff')";
  if(isset($thm_options['webnus_custom_font3_ttf']))
    $w_custom_font3_src[] = "url('{$thm_options['webnus_custom_font3_ttf']['url']}') format('truetype')";

if($w_custom_font3_src !='')
{
  $w_custom_font3_src= implode(",\n",$w_custom_font3_src);
  echo "@font-face {
  font-family: 'custom-font-3';
  font-style: normal;
  font-weight: normal;
  src: {$w_custom_font3_src};\n}\n";
}


/*
 * Color Skin Style Generator
 */
 
 /* == Menu Colors ------------------ */
 
if(!empty($thm_options['webnus_menu_link_color'])) {
  echo "#wrap #nav a { color:{$thm_options['webnus_menu_link_color']['regular']};}\n\n";
}

if(!empty($thm_options['webnus_menu_link_color'])) {
  echo "
    #wrap.pax-t #nav li a:hover,
    #wrap.pax-t #nav li:hover > a,
    #wrap.pax-t #nav li.current > a,
    #wrap.pax-t #header.horizontal-w #nav > li > a:hover,
    #wrap.pax-t #header.horizontal-w #nav > li.current > a,
    .transparent-header-w.t-dark-w .pax-t #header.horizontal-w.duplex-hd #nav > li:hover > a,
    .transparent-header-w .pax-t #header.horizontal-w #nav > li:hover > a,
    
    #wrap.trust-t #nav li a:hover,
    #wrap.trust-t #nav li:hover > a,
    #wrap.trust-t #nav li.current > a,
    #wrap.trust-t #header.horizontal-w #nav > li > a:hover,
    #wrap.trust-t #header.horizontal-w #nav > li.current > a,
    .transparent-header-w.t-dark-w .trust-t #header.horizontal-w.duplex-hd #nav > li:hover > a,
    .transparent-header-w .trust-t #header.horizontal-w #nav > li:hover > a,
    
    #wrap.solace-t #nav li a:hover,
    #wrap.solace-t #nav li:hover > a,
    #wrap.solace-t #nav li.current > a,
    #wrap.solace-t #header.horizontal-w #nav > li > a:hover,
    #wrap.solace-t #header.horizontal-w #nav > li.current > a,
    .transparent-header-w.t-dark-w .solace-t #header.horizontal-w.duplex-hd #nav > li:hover > a,
    .transparent-header-w .solace-t #header.horizontal-w #nav > li:hover > a {color:{$thm_options['webnus_menu_link_color']['hover']};}\n\n
    ";
}

if(!empty($thm_options['webnus_menu_link_color'])) {
  echo "#wrap #nav li.current > a, #wrap #nav li.current ul li a:hover, #wrap #nav li.active > a {color:{$thm_options['webnus_menu_link_color']['active']};}\n\n";
}


/* scroll to top */

if(isset($thm_options['webnus_scroll_to_top_hover_background_color']) && $thm_options['webnus_scroll_to_top_hover_background_color']!='')
{
	echo esc_attr( "#wrap #scroll-top a {background-color:{$thm_options['webnus_scroll_to_top_hover_background_color']['regular']};}\n" );
	echo esc_attr( "#wrap #scroll-top a:hover {background-color:{$thm_options['webnus_scroll_to_top_hover_background_color']['hover']};}\n" );
}

if( $thm_options['webnus_custom_color_skin_enable'] == 1 ) { ?>
	/* == TextColors
	---------------- */
	#wrap.colorskin-custom .whmpress_announcements a, #wrap.colorskin-custom .whmpress_announcements a :hover, #wrap.colorskin-custom .whmpress_pricing_table.one.featured, #wrap.colorskin-custom .whmpress_pricing_table.two .pricing_table_price, #wrap.colorskin-custom .whmpress_pricing_table.one .pricing_table_submit button, #wrap.colorskin-custom .whmpress_pricing_table.one .pricing_table_combo button, #wrap.colorskin-custom .whmpress_pricing_table.two .pricing_table_combo button, #wrap.colorskin-custom .whmpress_pricing_table.two .pricing_table_submit, #wrap.colorskin-custom #bridge .dropdown-menu a:hover, #wrap.colorskin-custom .crsl .owl-buttons div:hover, #wrap.colorskin-custom .icon-box14 a.magicmore:before, #wrap.colorskin-custom .vc_tta-color-white.vc_tta-style-modern.vc_tta-o-shape-group .vc_tta-tab.vc_active>a i.vc_tta-icon, #wrap.colorskin-custom #bridge input[name="hosting"].btn, #wrap.colorskin-custom #bridge .navbar .nav > li > a:before, #wrap.colorskin-custom #bridge p a, #wrap.colorskin-custom #bridge p a, #wrap.colorskin-custom #bridge .btn-group .btn, #wrap.colorskin-custom #bridge #order-standard_cart .products .product header span:first-child, #wrap.colorskin-custom #bridge #order-boxes a, #wrap.colorskin-custom .button.gray.rounded.bordered-bot,  #wrap.colorskin-custom .icon-box3:hover .magicmore, #wrap.colorskin-custom .icon-box3 a.magicmore, #wrap.colorskin-custom  .vc_tta-tabs.vc_tta-style-modern.vc_tta-shape-round .vc_tta-tab .vc_tta-icon, .colorskin-custom .w-pricing-table.pt-type2 .pt-footer a, .colorskin-custom .rec-post h5 a:hover, .colorskin-custom .about-author-sec h5 a:hover, .colorskin-custom #header h6 i, .colorskin-custom .components h6 i, .colorskin-custom .top-bar h6 i, .top-inf h6 i, .colorskin-custom .top-links a:hover, .colorskin-custom .w-header-type-11 #nav > li:hover > a, .colorskin-custom #nav ul li.current > a, .colorskin-custom #nav ul li a:hover, .colorskin-custom #nav li.current ul li a:hover, .colorskin-custom .nav-wrap2 #nav ul li a:hover, .colorskin-custom .nav-wrap2.darknavi #nav ul li a:hover, .colorskin-custom #nav ul li.current > a, .colorskin-custom #nav ul li:hover > a, .colorskin-custom .icon-box22:hover h4, .colorskin-custom  .icon-box22:hover i, .colorskin-custom  .icon-box22.w-featured i, .colorskin-custom  .icon-box22.w-featured h4, .colorskin-custom .icon-box22 a.magicmore, .colorskin-custom .w-pricing-table.pt-type2 > span, .colorskin-custom a.magicmore, .colorskin-custom .blox.dark .icon-box9 i, .colorskin-custom .icon-box20:hover i, .colorskin-custom .our-team4 .social-team a i:before, .colorskin-custom .our-process-item:hover i, .colorskin-custom .our-process-item:hover i, .colorskin-custom #footer .side-list ul li>a:after, .colorskin-custom .widget ul li.cat-item a:before, .colorskin-custom .footer-navi a:after, .colorskin-custom .footer-navi a:hover, .colorskin-custom .custom-footer-menu a:hover, .colorskin-custom  .buy-process-item h4, .colorskin-custom .buy-process-item.featured i, .colorskin-custom .testimonials-slider-w.flexslider .flex-direction-nav a i, .colorskin-custom .icon-box21 i, .colorskin-custom .icon-box21:hover h4 , .colorskin-custom .post-format-icon, .colorskin-custom .latestposts-nine .latest-b9-meta .date:after, .colorskin-custom .latestposts-nine .latest-b9-meta .categories:after, .colorskin-custom .w-pricing-table.pt-type4 h3, .colorskin-custom .w-pricing-table.pt-type4.featured h3, .colorskin-custom .w-pricing-table.pt-type4 .pt-price h4 span, .colorskin-custom  .w-pricing-table.pt-type4 .pt-price h4 small, .colorskin-custom #footer .side-list ul li:hover a, .colorskin-custom .w-pricing-table.pt-type5 .pt-header h3, .colorskin-custom .w-pricing-table.pt-type5 .pt-header h4 > span, .colorskin-custom .w-pricing-table.pt-type5 .pt-header h4  small, .colorskin-custom .w-pricing-table.pt-type5 .pt-header h5, .colorskin-custom .icon-box i, .colorskin-custom .blgtyp3.blog-post h6 a, .colorskin-custom .blgtyp1.blog-post h6 a, .colorskin-custom .blgtyp2.blog-post h6 a, .colorskin-custom .blog-single-post .postmetadata h6 a, .colorskin-custom .blog-single-post h6.blog-author a, .colorskin-custom .blog-inner .blog-author:after, .colorskin-custom .blog-inner .blog-date:after, .colorskin-custom .blog-post a:hover, .colorskin-custom .blog-author span, .colorskin-custom .blog-line p a:hover, .colorskin-custom a.readmore, .colorskin-custom .sidebar .widget .tabs li:hover a, .colorskin-custom .sidebar .widget .tabs li.active a, .colorskin-custom .pin-box h4 a:hover, .colorskin-custom .tline-box h4 a:hover, .colorskin-custom .pin-ecxt h6.blog-cat a:hover, .colorskin-custom .colorf, .colorskin-custom .related-works .portfolio-item:hover h5 a, .colorskin-custom .icon-box1 i:before, .colorskin-custom .icon-box1 h4, .colorskin-custom .icon-box3 i, .colorskin-custom .icon-box3 h4, .colorskin-custom .icon-box3 p, .colorskin-custom .icon-box4:hover i, .colorskin-custom .icon-box5 i, .colorskin-custom .icon-box7 i, .colorskin-custom .icon-box8 i, .colorskin-custom .blox.dark .icon-box9 i, .colorskin-custom .icon-box9 i, .colorskin-custom .icon-box11 i, .colorskin-custom .blox.dark .icon-box15 i, .colorskin-custom .blox.dark .icon-box15 h4, .colorskin-custom .blox.dark .icon-box15 a.magicmore, .colorskin-custom .icon-box16 h4, .colorskin-custom .icon-box16 i, .colorskin-custom .icon-box18 i, .colorskin-custom .icon-box19 i, .colorskin-custom .icon-box23 h4, .colorskin-custom .icon-box24 i, .colorskin-custom #bridge #order-boxes a, .colorskin-custom .latestposts-two .blog-line:hover h4 a, .colorskin-custom .latestposts-two .blog-line p.blog-cat a, .colorskin-custom .latestposts-two .blog-line:hover .img-hover:before, .colorskin-custom .latestposts-three h6.latest-b2-cat a, .colorskin-custom .latestposts-three .latest-b2-metad2 span a:hover, .colorskin-custom .latestposts-three h3.latest-b2-title a:hover, .colorskin-custom .latestposts-four h3.latest-b2-title a:hover, .colorskin-custom .latestposts-five h6.latest-b2-cat a, .colorskin-custom .latestposts-six .latest-content p.latest-date, .colorskin-custom .latestposts-six .latest-title a:hover, .colorskin-custom .latestposts-six .latest-author a:hover, .colorskin-custom .latestposts-seven .wrap-date-icons h3.latest-date, .colorskin-custom .latestposts-seven .latest-content .latest-title a:hover, .colorskin-custom .latestposts-seven .latest-content .latest-author a, .colorskin-custom .latestposts-eleven .latest-b11 .latest-b11-meta .date:after, .colorskin-custom h6.blog-cat a, .colorskin-custom .latestposts-one .latest-title a:hover, .colorskin-custom .latestposts-one .latest-author a:hover, .colorskin-custom a.magicmore, .colorskin-custom .button.skyblue.bordered-bot, .colorskin-custom button.skyblue.bordered-bot, .colorskin-custom input[type="submit"].skyblue.bordered-bot, .colorskin-custom input[type="reset"].skyblue.bordered-bot, .colorskin-custom input[type="button"].skyblue.bordered-bot, .colorskin-custom .our-team6 h5, .colorskin-custom .our-clients-wrap.crsl .owl-buttons div:active, .colorskin-custom .our-team5 h5, .colorskin-custom .our-team5 .social-team a i:hover:before, .colorskin-custom .latestposts-ten .latest-b10 .latest-b10-content a.readmore, .colorskin-custom .w-pricing-table.pt-type1 .pt-footer a, .colorskin-custom .w-pricing-table.pt-type1 .pt-footer a, .colorskin-custom .w-pricing-table.pt-type1 .plan-price span, .colorskin-custom .w-pricing-table.pt-type1 .plan-price small, .transparent-header-w .colorskin-custom #header.horizontal-w.sticky #nav > li.active > a, .transparent-header-w.t-dark-w .colorskin-custom #header.horizontal-w.sticky #nav > li.active > a, .transparent-header-w.t-dark-w .colorskin-custom #header.horizontal-w.sticky #nav > li:hover > a, .colorskin-custom .w-pricing-table.pt-type7 .plan-title, .colorskin-custom .icon-box1 img:after, .colorskin-custom .icon-box1 i:after, .colorskin-custom #header #nav .active a

	{ color: <?php echo esc_attr($thm_options['webnus_custom_color_skin']); ?>}

	/* == Backgrounds
	----------------- */
	#wrap.colorskin-custom .w-pricing-table.pt-type6 .pt-header, #wrap.colorskin-custom .whmpress_price_matrix table th, #wrap.colorskin-custom .whmpress_price_matrix_domain table th, #wrap.colorskin-custom .whmpress_announcements .announcement-date, #wrap.colorskin-custom .whmpress_pricing_table.one.featured .pricing_table_price, #wrap.colorskin-custom .whmpress_pricing_table.one.featured .pricing_table_heading, #wrap.colorskin-custom .whmpress_pricing_table.one.featured .pricing_table_submit, #wrap.colorskin-custom .whmpress a.buy-button, #wrap.colorskin-custom .whmpress a.whmpress-btn, #wrap.colorskin-custom .whmpress a.whois-button, #wrap.colorskin-custom .whmpress a.www-button, #wrap.colorskin-custom .whmpress button, #wrap.colorskin-custom .whmpress input[type=submit], #wrap.colorskin-custom .whmpress_order_button, #wrap.colorskin-custom .blog-social a:hover, #wrap.colorskin-custom .vc_carousel.vc_carousel_horizontal.hero-carousel .hero-carousel-wrap .hero-metadata .category a, #wrap.colorskin-custom .onsale, .woocommerce-page #wrap.colorskin-custom .container .button, .woocommerce-page #wrap.colorskin-custom .ui-slider-handle, #wrap.colorskin-custom .blox.dark .subtitle-element4 h1:after, #wrap.colorskin-custom .blox.dark .subtitle-element4 h2:after, #wrap.colorskin-custom .blox.dark .subtitle-element4 h3:after, #wrap.colorskin-custom .blox.dark .subtitle-element4 h4:after, #wrap.colorskin-custom .blox.dark .subtitle-element4 h5:after, #wrap.colorskin-custom .blox.dark .subtitle-element4 h6:after, #wrap.colorskin-custom .icon-box10 a.magicmore, #wrap.colorskin-custom  #header.w-header-type-11 .logo-wrap, #wrap.colorskin-custom .components .woo-cart-header .header-cart span, #wrap.colorskin-custom .max-title:after, #wrap.colorskin-custom .w-pricing-table.pt-type2.featured .pt-footer a, #wrap.colorskin-custom .teaser-box3 .teaser-subtitle, #wrap.colorskin-custom .our-team4:hover, #wrap.colorskin-custom #pre-footer .footer-subscribe-bar, #wrap.colorskin-custom .wpcf7 .w-contact-p input[type=submit], #wrap.colorskin-custom #bridge .btn-primary, #wrap.colorskin-custom #bridge #order-boxes table.styled tr th, #wrap.colorskin-custom .tablepress tfoot th, #wrap.colorskin-custom .tablepress thead th, #wrap.colorskin-custom .vc_tta-accordion.vc_tta-style-classic.vc_tta-shape-square .vc_tta-panel.vc_active .vc_tta-panel-heading, #wrap.colorskin-custom .vc_tta-accordion.vc_tta-style-classic.vc_tta-shape-square .vc_tta-controls-icon-position-right .vc_tta-controls-icon, #wrap.colorskin-custom .wp-pagenavi a:hover, .colorskin-custom .our-team2 figure h2, .colorskin-custom .our-team2 .social-team, .colorskin-custom .socialfollow a:hover, .colorskin-custom #header.sm-rgt-mn #menu-icon span.mn-ext1, .colorskin-custom #header.sm-rgt-mn #menu-icon span.mn-ext2, .colorskin-custom #header.sm-rgt-mn #menu-icon span.mn-ext3, .colorskin-custom .pin-ecxt2 .col1-3 span, .colorskin-custom .comments-number-x span, .colorskin-custom .side-list li:hover img, .colorskin-custom .subscribe-box .subscribe-box-top, .colorskin-custom .event-clean .event-article:hover .event-date, .colorskin-custom .event-list .event-date, .colorskin-custom .latestposts-seven .latest-img:hover img, .colorskin-custom #nav > li.current > a:before, .colorskin-custom .max-hero h5:before, .colorskin-custom .ministry-box2:hover img, .colorskin-custom .sermons-simple article:hover .sermon-img img, .colorskin-custom .a-sermon .sermon-img:hover img, .colorskin-custom .a-sermon .media-links, .colorskin-custom .event-grid .event-detail, .colorskin-custom .teaser-box4 .teaser-title, .colorskin-custom .magic-link a, .colorskin-custom .subscribe-flat .subscribe-box-input .subscribe-box-submit, .colorskin-custom .w-callout.w-callout-b, .colorskin-custom .icon-box12 i, .colorskin-custom .magic-link a, .colorskin-custom #tribe-events-content-wrapper .tribe-events-calendar td:hover, .colorskin-custom #tribe-events-content-wrapper .tribe-events-sub-nav a:hover, .colorskin-custom #tribe-events-content-wrapper #tribe-bar-form .tribe-events-button, .colorskin-custom .tribe-events-list .booking-button, .colorskin-custom .tribe-events-list .event-sharing > li:hover, .colorskin-custom .tribe-events-list .event-sharing .event-share:hover .event-sharing-icon, .colorskin-custom .tribe-events-list .event-sharing .event-social li a, .colorskin-custom #tribe-events-pg-template .tribe-events-button, .colorskin-custom .single-tribe_events .booking-button, .colorskin-custom .event-grid .event-detail, .colorskin-custom .causes .cause-content .donate-button-exx:hover, .colorskin-custom .cause-box .donate-button:hover, .colorskin-custom .tribe-events-list-separator-month span, .colorskin-custom .flip-clock-wrapper ul, .colorskin-custom .flip-clock-wrapper ul li a div div.inn, .colorskin-custom .latestnews2 .ln-date .ln-month, .colorskin-custom .top-bar .inlinelb.topbar-contact:hover, .colorskin-custom #scroll-top a:hover, .colorskin-custom #footer .widget-subscribe-form button:hover, .colorskin-custom .postmetadata h6.blog-views span, .colorskin-custom #commentform input[type="submit"], .colorskin-custom .a-post-box .latest-cat, .colorskin-custom .modal-title, .colorskin-custom .latestnews1 .ln-item:hover .ln-content, .colorskin-custom .latestposts-one .latest-b-cat:hover, .colorskin-custom .footer-in .contact-inf button:hover, .colorskin-custom .subtitle-element5 h1:after, .colorskin-custom .subtitle-element5 h2:after, .colorskin-custom .subtitle-element5 h3:after, .colorskin-custom .subtitle-element5 h4:after, .colorskin-custom .subtitle-element5 h5:after, .colorskin-custom .subtitle-element5 h6:after, .colorskin-custom .w-pricing-table.pt-type6 .pt-footer, .colorskin-custom .buy-process-wrap:before, .colorskin-custom .buy-process-item .icon-wrapper:before, .colorskin-custom .buy-process-item i, .colorskin-custom .subtitle-element:after, .colorskin-custom .ts-tetra.testimonials-slider-w.flexslider .flex-control-paging li a.flex-active, .colorskin-custom .testimonials-slider-w.flexslider .flex-direction-nav a:hover, .colorskin-custom .vc_tta-tabs.vc_tta-style-modern.vc_tta-shape-round .vc_tta-tab.vc_active > a, .colorskin-custom .blox .icon-box21:hover i, .colorskin-custom .icon-box25 i, .colorskin-custom .wp-pagenavi a:hover, .colorskin-custom .tline-topdate, .colorskin-custom #tline-content:before, .colorskin-custom .tline-row-l:after, .colorskin-custom .tline-row-r:before, .colorskin-custom .related-works .portfolio-item > a:hover:before, .colorskin-custom .latest-projects-navigation a:hover, .colorskin-custom .subtitle-element:after, .colorskin-custom .icon-box1:hover, .colorskin-custom .icon-box3:hover, .colorskin-custom .blox.dark .icon-box3:hover, .colorskin-custom .icon-box3 h4:after, .colorskin-custom .icon-box3 a.magicmore, .colorskin-custom .icon-box6 i, .colorskin-custom .icon-box8:hover i, .colorskin-custom .icon-box11:hover i, .colorskin-custom .icon-box18:hover i, .colorskin-custom .icon-box21:hover i, .colorskin-custom .icon-box23 i, .colorskin-custom .icon-box24:hover i, .colorskin-custom .latestposts-four .latest-b2 h6.latest-b2-cat, .colorskin-custom .our-team1 figcaption, .colorskin-custom .widget-subscribe-form button, .colorskin-custom .button.skyblue.bordered-bot:hover, .colorskin-custom button.skyblue.bordered-bot:hover, .colorskin-custom input[type="submit"].skyblue.bordered-bot:hover, .colorskin-custom input[type="reset"].skyblue.bordered-bot:hover, .colorskin-custom input[type="button"].skyblue.bordered-bot:hover, .colorskin-custom #talk-business input[type=submit], .colorskin-custom .w-pricing-table.pt-type1.featured .plan-title, .colorskin-custom .w-pricing-table.pt-type1.featured .plan-price, .colorskin-custom .w-pricing-table.pt-type1.featured .pt-footer, .colorskin-custom .w-pricing-table.pt-type1.featured .pt-footer, .colorskin-custom .tablepress a.magicmore, .colorskin-custom .top-bar a.topbar-btn, .colorskin-custom .wpcf7 .wpcf7-form input[type="submit"], .colorskin-custom #seo_consolation_form .checkbox_seo_title input[type=checkbox]:checked + span.wpcf7-list-item-label:before, .colorskin-custom .button.theme-skin, .colorskin-custom .w-pricing-table.pt-type7 .pt-footer a.magicmore, .colorskin-custom .icon-box1 img:after, .colorskin-custom .icon-box1 i:after
	{ background-color: <?php echo esc_attr( $thm_options['webnus_custom_color_skin'] ); ?>}

	/* == BorderColors
	------------------ */
	#wrap.colorskin-custom .whmpress_pricing_table.one.featured, #wrap.colorskin-custom #bridge .navbar .nav > li.active > a:not(#Menu-Account), #wrap.colorskin-custom #bridge .navbar .nav > li > a:not(#Menu-Account):hover, #wrap.colorskin-custom #bridge .btn, #wrap.colorskin-custom #bridge .btn, #wrap.colorskin-custom #bridge .whmcscontainer .logincontainer input#password, #wrap.colorskin-custom #bridge .whmcscontainer .logincontainer input#username, #wrap.colorskin-custom #bridge #order-boxes .fields-container, #wrap.colorskin-custom .easydesign-contact, .colorskin-custom .our-team2, .colorskin-custom .max-title h1:after, .colorskin-custom .max-title h2:after, .colorskin-custom .max-title h3:after, .colorskin-custom .max-title h4:after, .colorskin-custom .max-title h5:after, .colorskin-custom .max-title h6:after, .colorskin-custom .w-pricing-table.pt-type2:hover, .colorskin-custom .w-pricing-table.pt-type2:hover > span, .colorskin-custom .w-pricing-table.pt-type2.featured > span, .colorskin-custom .w-pricing-table.pt-type2.featured, .colorskin-custom .our-team4:hover, .colorskin-custom .our-process-item:hover i, .colorskin-custom .buy-process-item.featured i, .colorskin-custom .subtitle-element h1:after, .colorskin-custom .subtitle-element h2:after, .colorskin-custom .subtitle-element h3:after, .colorskin-custom .subtitle-element h5:after, .colorskin-custom .subtitle-element h6:after, .colorskin-custom .testimonials-slider-w.flexslider .flex-direction-nav a, .colorskin-custom .icon-box21:hover i, .colorskin-custom .icon-box25, .colorskin-custom .tline-row-l, .colorskin-custom .tline-row-r, .colorskin-custom .esg-filterbutton.selected, .colorskin-custom .w-divider7 h3:after, .colorskin-custom .vc_tta-accordion.vc_tta-style-classic.vc_tta-shape-square .vc_active .vc_tta-panel-heading .vc_tta-controls-icon::after, .colorskin-custom .vc_tta-accordion.vc_tta-style-classic.vc_tta-shape-square .vc_active .vc_tta-panel-heading .vc_tta-controls-icon::before, .colorskin-custom .icon-box8:hover i, .colorskin-custom .icon-box11:hover i, .colorskin-custom .icon-box16 a.magicmore, .colorskin-custom .icon-box19 i, .colorskin-custom .icon-box19 a.magicmore:hover, .colorskin-custom .icon-box21:hover i, .colorskin-custom .subtitle-element3 h4:after, .colorskin-custom .max-title3 h1:before, .colorskin-custom .max-title3 h2:before, .colorskin-custom .max-title3 h3:before, .colorskin-custom .max-title3 h4:before, .colorskin-custom .max-title3 h5:before, .colorskin-custom .max-title3 h6:before, .colorskin-custom .toggle-top-area .widget .instagram-feed a img:hover, .colorskin-custom #footer .widget .instagram-feed a img:hover, .colorskin-custom .button.skyblue.bordered-bot, .colorskin-custom button.skyblue.bordered-bot, .colorskin-custom input[type="submit"].skyblue.bordered-bot, .colorskin-custom input[type="reset"].skyblue.bordered-bot, .colorskin-custom input[type="button"].skyblue.bordered-bot, .colorskin-custom .esg-filterbutton.selected, .colorskin-custom .w-pricing-table.pt-type1.featured, .colorskin-custom .subtitle-element h1:after, .colorskin-custom .subtitle-element h2:after, .colorskin-custom .subtitle-element h3:after, .colorskin-custom .subtitle-element h4:after, .colorskin-custom .subtitle-element h5:after, .colorskin-custom .subtitle-element h6:after, .colorskin-custom .w-pricing-table.pt-type2.featured .pt-footer a, .colorskin-custom .our-team3:hover figure img, .colorskin-custom .gogmapseo
	{ border-color: <?php echo esc_attr( $thm_options['webnus_custom_color_skin'] ); ?>}

	/* == border topcolor
	-------------------- */
	#wrap.colorskin-custom .whmpress_pricing_table.one.featured .pricing_table_price:after, #wrap.colorskin-custom .latestposts-eleven .latest-b11, #wrap.colorskin-custom .w-pricing-table.pt-type5 .pt-header h4:after, #wrap.colorskin-custom #bridge .navbar .nav li.dropdown .dropdown-toggle .caret, #wrap.colorskin-custom #bridge .navbar .nav li.dropdown.open .caret, .colorskin-custom .w-pricing-table.pt-type1.featured .plan-price:after

	{ border-top-color: <?php echo esc_attr( $thm_options['webnus_custom_color_skin'] ); ?>;}

	/* == border bottom
	-------------------- */
	#wrap.colorskin-custom .max-title2 h1:before, #wrap.colorskin-custom .max-title2 h2:before, #wrap.colorskin-custom .max-title2 h3:before, #wrap.colorskin-custom .max-title2 h4:before, #wrap.colorskin-custom .max-title2 h5:before, #wrap.colorskin-custom .max-title2 h6:before, #wrap.colorskin-custom .subtitle-element2 h4:before, #wrap.colorskin-custom #bridge .navbar .nav > li > a:not(#Menu-Account):after #wrap.colorskin-custom #bridge .navbar .nav li.dropdown .dropdown-toggle .caret, #wrap.colorskin-custom #bridge .navbar .nav li.dropdown.open .caret 

	{ border-bottom-color: <?php echo esc_attr( $thm_options['webnus_custom_color_skin'] ); ?>;}

	/* == color
	-------------------- */	
	#wrap.colorskin-custom .icon-box14 a.magicmore:hover, #wrap.colorskin-custom .internalpadding form input[type="submit"], #wrap.colorskin-custom #bridge .navbar .nav > li > a:hover, #wrap.colorskin-custom #slide-6-layer-35, #wrap.colorskin-custom .transparent-header-w.t-dark-w, #wrap.colorskin-custom .top-bar .top-links a:hover, #wrap.colorskin-custom .transparent-header-w #header.horizontal-w #nav > li:hover > a, #wrap.colorskin-custom #nav li.current > a, #wrap.colorskin-custom #nav ul li:hover > a, #wrap.colorskin-custom .transparent-header-w.t-dark-w, #wrap.colorskin-custom #header.horizontal-w #nav > li:hover > a, #wrap.colorskin-custom .icon-box3:hover a.magicmore, .colorskin-custom .colorf .spl, .colorskin-custom .our-team4 .social-team a i:before
	{ color: <?php echo esc_attr( $thm_options['webnus_custom_color_skin'] ); ?> !important;}

	/* == Background color
	-------------------- */
	#wrap.colorskin-custom .w-pricing-table.pt-type6 .pt-header, #wrap.colorskin-custom [data-alias="Host-slider"] #slide-5-layer-5, #wrap.colorskin-custom [data-alias="Host-slider"] #slide-4-layer-6, #wrap.colorskin-custom [data-alias="Host-slider"] #slide-6-layer-20, #wrap.colorskin-custom [data-alias="Host-slider"] #slide-6-layer-5, #wrap.colorskin-custom [data-alias="Host-slider"] #slide-6-layer-35:hover, #wrap.colorskin-custom .icon-box14 a.magicmore:hover:before
	{ background-color: <?php echo esc_attr( $thm_options['webnus_custom_color_skin'] ); ?> !important;}

	/* == border color
	-------------------- */
	#wrap.colorskin-custom .w-pricing-table.pt-type6, #wrap.colorskin-custom #slide-6-layer-35, #wrap.colorskin-custom .w-pricing-table.pt-type6:nth-of-type(4n+4),#wrap.colorskin-custom .icon-box14 a.magicmore:hover:before,#wrap.colorskin-custom .esg-filterbutton.selected
	{ border-color: <?php echo esc_attr( $thm_options['webnus_custom_color_skin'] ); ?> !important;}


	/* == Woocommerce Specifics
	--------------------------- */
	.colorskin-custom .woocommerce div.product .woocommerce-tabs ul.tabs li.active
	{ border-top-color: <?php echo esc_attr( $thm_options['webnus_custom_color_skin'] ); ?> !important;}

<?php } 


/*
 * Custom CSS
*/
echo strip_tags($thm_options['webnus_custom_css']);

$out = $GLOBALS['webnus_dyncss'] = '';
$out = ob_get_contents();
$out = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $out);
$GLOBALS['webnus_dyncss'] = str_replace(array("\r\n", "\r", "\n", "\t", '    '), '', $out);
ob_end_clean();

function webnus_dyncss_output() {
	$out = $GLOBALS['webnus_dyncss'];
	return $out;
}