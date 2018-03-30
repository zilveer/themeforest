<?php 
$site_logo_padding = couponxl_get_option( 'site_logo_padding' );
$site_navigation_padding = couponxl_get_option( 'site_navigation_padding' );

$main_color = couponxl_get_option( 'main_color' );
$main_color_font = couponxl_get_option( 'main_color_font' );
$body_bg_color = couponxl_get_option( 'body_bg_color' );

$button_light_green_bg_color = couponxl_get_option( 'button_light_green_bg_color' );
$button_light_green_font_color = couponxl_get_option( 'button_light_green_font_color' );
$button_light_green_bg_color_hvr = couponxl_get_option( 'button_light_green_bg_color_hvr' );
$button_light_green_font_color_hvr = couponxl_get_option( 'button_light_green_font_color_hvr' );

$navigation_font = couponxl_get_option( 'navigation_font' );
$titles_font = couponxl_get_option( 'titles_font' );
$text_font = couponxl_get_option( 'text_font' );

$home_page_bg_image = couponxl_get_option( 'home_page_bg_image' );
$home_page_main_title_font_color = couponxl_get_option( 'home_page_main_title_font_color' );
$home_page_bg_image_repeat = couponxl_get_option( 'home_page_bg_image_repeat' );
$home_page_bg_image_size = couponxl_get_option( 'home_page_bg_image_size' );
$home_page_main_title_font_color = couponxl_get_option( 'home_page_main_title_font_color' );

$home_page_search_input_bg_color = couponxl_get_option( 'home_page_search_input_bg_color' );
$home_page_search_input_border_color = couponxl_get_option( 'home_page_search_input_border_color' );
$home_page_search_input_font_color = couponxl_get_option( 'home_page_search_input_font_color' );
$home_page_search_input_placeholder_color = couponxl_get_option( 'home_page_search_input_placeholder_color' );
$home_page_search_input_bg_color_focus = couponxl_get_option( 'home_page_search_input_bg_color_focus' );
$home_page_search_input_border_color_focus = couponxl_get_option( 'home_page_search_input_border_color_focus' );
$home_page_search_input_font_color_focus = couponxl_get_option( 'home_page_search_input_font_color_focus' );
$home_page_search_dropdown_bg_color = couponxl_get_option( 'home_page_search_dropdown_bg_color' );
$home_page_search_dropdown_font_color = couponxl_get_option( 'home_page_search_dropdown_font_color' );
$home_page_search_dropdown_bg_color_hvr = couponxl_get_option( 'home_page_search_dropdown_bg_color_hvr' );
$home_page_search_dropdown_font_color_hvr = couponxl_get_option( 'home_page_search_dropdown_font_color_hvr' );

$page_title_bg_color = couponxl_get_option( 'page_title_bg_color' );
$page_title_bg_image = couponxl_get_option( 'page_title_bg_image' );
$page_title_bg_image_repeat = couponxl_get_option( 'page_title_bg_image_repeat' );
$page_title_bg_image_size = couponxl_get_option( 'page_title_bg_image_size' );
$page_title_font_color = couponxl_get_option( 'page_title_font_color' );

$breadcrumbs_bg_color = couponxl_get_option( 'breadcrumbs_bg_color' );
$breadcrumbs_font_color = couponxl_get_option( 'breadcrumbs_font_color' );
$breadcrumbs_link_font_color = couponxl_get_option( 'breadcrumbs_link_font_color' );
$breadcrumbs_link_font_color_hvr = couponxl_get_option( 'breadcrumbs_link_font_color_hvr' );

$notification_bg_color = couponxl_get_option( 'notification_bg_color' );
$notification_font_color = couponxl_get_option( 'notification_font_color' );
?>

.site-logo{
	padding: <?php echo $site_logo_padding; ?>;
}

.nav.navbar-nav{
    padding: <?php echo $site_navigation_padding ?>;
}

body[class*=" "]{
	font-family: "<?php echo $text_font ?>", sans-serif;
	background-color: <?php echo $body_bg_color ?>;
}

.home-page-body{
	<?php if( !empty( $home_page_bg_image['url'] ) ): ?>
		background-image: url( <?php echo $home_page_bg_image['url'] ?> );
	<?php endif; ?>
	background-repeat: <?php echo $home_page_bg_image_repeat ?>;
	background-size: <?php echo $home_page_bg_image_size ?>;
}

.home-page-title h1, .home-page-title h5{
	color: <?php echo $home_page_main_title_font_color; ?>;
}

.page-title{
	background-color: <?php echo $page_title_bg_color ?>;
	<?php if( !empty( $page_title_bg_image['url'] ) ): ?>
		background-image: url( <?php echo $page_title_bg_image['url'] ?> );
	<?php endif; ?>
	background-repeat: <?php echo $page_title_bg_image_repeat ?>;
	background-size: <?php echo $page_title_bg_image_size ?>;
}

.page-title h1, .page-title h2, .page-title h3, .page-title h4, .page-title h5, .page-title p{
	color: <?php echo $page_title_font_color ?>;
}

/* GREEN COLOR */

/* GREEN BORDERS */
.coupon-code-modal,
.coupon-code-modal.print {
    border-color: <?php echo $button_light_green_font_color ?>;
}

/* Backgrounds */
.btn,
.white-block-media .btn,
.white-block-content a.btn,
.input-group input[type="checkbox"]:checked:before,
.coupon-code-modal,
.coupon-code-modal.print,
.widget_couponxl_filter ul li.active.current:before{
    background-color: <?php echo $button_light_green_bg_color ?>;
    color: <?php echo $button_light_green_font_color ?>;
}

.widget_couponxl_filter ul li.active.current:after,
.show-all a,
.show-all a:focus,
.widget_couponxl_filter .show-all a:hover{
    color: <?php echo $button_light_green_bg_color ?>;
}


/* Fonts */
.deal-bought-wrap i,
.deal-bought-info h4,
.deal-sidebar-box .white-block-content a,
.deal-sidebar-box .white-block-content a:hover,
.comments .comment-inner .comment-body .comment-reply-link span,
.widget-footer .widget .twitter ul li p a:hover,
.widget-footer .twitter ul li p a:hover,
.widget-footer .tweet-meta li a i:hover,
.widget-footer .widget_couponxl_custom_locations .white-block-content ul li a:hover,
.widget-footer .widget_couponxl_custom_menu .white-block-content ul li a:hover,
.widget-footer .offer-cat-filter li:hover a,
.widget-footer .offer-cat-filter li:hover a i,
.widget-footer .offer-cat-filter li:last-child a:hover,
.widget-footer .widget .offer-type-filter li a.active,
.widget-footer .widget .offer-type-filter li a:hover,
.widget-footer .widget .white-block-content ul li a:hover,
.widget-footer .widget .white-block-content .nav-tabs li a:hover,
.widget-footer .widget .white-block-content .nav-tabs li.active a,
.widget-footer .widget a:hover,
.widget-footer .widget #calendar_wrap table tbody tr td a,
.page-template-page-tpl_my_profile .white-block .white-block-content .bootstrap-table td a,
.page-template-page-tpl_my_profile .white-block .white-block-content .bootstrap-table td a:hover,
.page-template-page-tpl_my_profile .input-group .new-marker,
.page-template-page-tpl_my_profile .input-group .new-marker:hover,
.page-template-page-tpl_my_profile .input-group .remove-marker,
.green-text{
    color: <?php echo $button_light_green_bg_color ?>;
}

/* DARKER GREEN FOR BIG BUTTONS ON HOVER */
.btn:hover,
.top-bar .keyword-search-toggle:active:hover,
.top-bar .keyword-search-toggle:focus:hover,
.btn:focus,
.btn:active,
.white-block-media .btn:hover,
.show-code i,
.white-block-content a.show-code i,
.white-block-content a.btn:hover{
    background-color: <?php echo $button_light_green_bg_color_hvr ?>;
    color: <?php echo $button_light_green_font_color_hvr ?>;
}

/* PURPRLE COLOR BACKGROUNDS */
ul.list-unstyled.mega_menu .widget ul li:hover a .badge,
.featured-stores-title,
.widget .offer-type-filter li a.active,
.offer-cat-filter li:hover a i,
.pagination li.active a,
.pagination li.active a:hover,
.store-name a:hover,
.white-block .tree li a .badge,
.shop-offer-filter a.active,
.shop-offer-filter a.active:hover,
.widget .white-block-content .nav-tabs li.active a,
.pagination li a:hover,
.panel-title a span.toggle:hover,
.widget_couponxl_popular_stores .white-block-content div:hover a i,
.widget_couponxl_custom_stores .white-block-content div:hover a i
{
    background-color: <?php echo $main_color ?>;
    color: <?php echo $main_color_font ?>;
}

/* PURPLE FONT COLORS */
.white-block-title i,
.white-block-title a:hover,
.white-block-title a:hover i,
.navigation .nav.navbar-nav > li.open > a,
.navigation .nav.navbar-nav > li > a:hover,
.navigation .nav.navbar-nav > li > a:focus,
.navigation .nav.navbar-nav > li > a:active,
.navigation .nav.navbar-nav > li.current > a,
.navigation .navbar-nav > li.current-menu-parent > a,
.navigation .navbar-nav > li.current-menu-ancestor > a,
.navigation .navbar-nav > li.current-menu-item > a,
.breadcrumb-section .breadcrumb li a:hover,
.white-block-footer .price,
.white-block-content .price,
.contact-page .white-block-content .price,
.featured-stores-title a.btn:hover,
.widget-title h4,
.deal-sidebar-box .widget-title .price,
.deal-value-wrap li h6,
.comment-reply-title a:hover,
.white-block .tree li a:hover,
.page-template-page-tpl_my_profile .white-block:not(.widget) .white-block-title h2,
.page-template-page-tpl_my_profile .white-block:not(.widget) .white-block-content ul li.active:before,
.page-template-page-tpl_my_profile .white-block:not(.widget) .white-block-content ul li:hover:before,
.error404 .white-block.top-border:before,
.error404 .white-block h1,
.widget .white-block-content ul li a:hover,
.widget .twitter ul li p a:hover,
.twitter ul li p a:hover,
.tweet-meta li a i:hover,
.widget a:hover,
.widget #calendar_wrap table tbody tr td a,
.widget_rss h4 a,
.coupon_modal_content a,
.offer-box .white-block-content a:hover h3,
.blog-item-content a:hover h2.blog-title,
.offer-box .white-block-content a:hover,
.white-block-content h2 a:focus,
.white-block-content h2 a:hover,
.nav.navbar-nav ul li a:hover,
.nav.navbar-nav ul li:last-child a:hover,
.error404 .white-block.top-border.top-border:before,
.error404 .white-block.top-border h1,
.panel-title a{
    color: <?php echo $main_color ?>;
}

/* PURPLE BORDERS */
.top-border,
.widget .offer-type-filter li a.active,
.pagination li.active a,
.pagination li.active a:hover,
.page-template-page-tpl_my_profile .white-block:not(.widget) .white-block-content ul li.active,
.page-template-page-tpl_my_profile .white-block:not(.widget) .white-block-content ul li:hover,
.coupon_modal_content a,
.pagination li a:hover{
    border-color: <?php echo $main_color ?>;
}

/* Backgrouund */
section .home-page-search-box .input-group input.form-control {
    background-color: <?php echo $home_page_search_input_bg_color ?>;
	border-color: rgba( <?php echo couponxl_hex2rgb( $home_page_search_input_border_color ) ?>, .2 );
	color: <?php echo $home_page_search_input_font_color ?>;
}

/* Background on Focus */
section .home-page-search-box .input-group input.form-control:focus {
    background-color: <?php echo $home_page_search_input_bg_color_focus ?>;
	border-color: rgba( <?php echo couponxl_hex2rgb( $home_page_search_input_border_color_focus ) ?>, .2 );
	color: <?php echo $home_page_search_input_font_color_focus ?>;
}

/* Placeholders */
section .home-page-search-box .input-group input.form-control,
section .home-page-search-box .input-group input.form-control::-webkit-input-placeholder,
section .home-page-search-box .input-group input.form-control:-moz-placeholder,
section .home-page-search-box .input-group input.form-control::-moz-placeholder,
section .home-page-search-box .input-group input.form-control:-ms-input-placeholder,
section .home-page-search-box .input-group input.form-control:focus::-webkit-input-placeholder,
section .home-page-search-box .input-group input.form-control:focus:-moz-placeholder,
section .home-page-search-box .input-group input.form-control:focus::-moz-placeholder,
section .home-page-search-box .input-group input.form-control:focus:-ms-input-placeholder{
    color: <?php echo $home_page_search_input_placeholder_color; ?>;
}


/* Dropdown Background */
.home-page-search-box .search_options ul li a {
    background-color: <?php echo $home_page_search_dropdown_bg_color; ?>;
    border-color: <?php echo $home_page_search_dropdown_bg_color; ?>;
    color: <?php echo $home_page_search_dropdown_font_color ?>;
}

/* Dropdown Background On Hover*/
.home-page-search-box .search_options ul li a:hover {
    background-color: <?php echo $home_page_search_dropdown_bg_color_hvr; ?>;
    border-color: <?php echo $home_page_search_dropdown_bg_color_hvr; ?>;
    color: <?php echo $home_page_search_dropdown_font_color_hvr; ?>;
}

/* Breadcrumbs Background */
.breadcrumb-section,
.breadcrumb {
    background-color: <?php echo $breadcrumbs_bg_color ?>;
    color: <?php echo $breadcrumbs_font_color; ?>;
}

/* Breadcrumb Font */
.breadcrumb-section .breadcrumb li a {
    color: <?php echo $breadcrumbs_link_font_color; ?>;
}
/* Breadcrumb Font on Hover */
.breadcrumb-section .breadcrumb li a:hover {
    color: <?php echo $breadcrumbs_link_font_color_hvr; ?>;
}

/* NAVIGATION */
.nav.navbar-nav li a,
.navigation .nav.navbar-nav > li > a,
.navigation .nav.navbar-nav > li.open > a,
.navigation .nav.navbar-nav > li > a:hover,
.navigation .nav.navbar-nav > li > a:focus,
.navigation .nav.navbar-nav > li > a:active,
.navigation .nav.navbar-nav > li.current > a,
.navigation .navbar-nav > li.current-menu-parent > a,
.navigation .navbar-nav > li.current-menu-ancestor > a,
.navigation .navbar-nav > li.current-menu-item > a,
.nav.navbar-nav ul li.open > a,
.nav.navbar-nav ul li.open > a:hover,
.nav.navbar-nav ul li.open > a:focus,
.nav.navbar-nav ul li.open > a:active,
.nav.navbar-nav ul li.current > a,
.navbar-nav ul li.current-menu-parent > a,
.navbar-nav ul li.current-menu-ancestor > a,
.navbar-nav ul li.current-menu-item > a{
    font-family: "<?php echo $navigation_font; ?>", sans-serif;
}

/* TITLES */
h1,
h2,
h3,
h4,
h5,
h6,
.btn,
.white-block-title a,
.home-page-title h1,
.page-title h1,
.page-title h2,
.page-title h3,
.page-title h4,
.home-page-title h5,
.page-title h5,
.page-title p,
.white-block-media .btn,
.white-block-footer .price,
.white-block-content .price,
.contact-page .white-block-content .price,
.featured-stores-title h2,
.featured-stores-title a.btn,
.widget-title h4,
.widget .offer-type-filter li a,
.offer-cat-filter li:last-child a,
.white-block-content a.btn,
.deal-sidebar-box .widget-title .price,
.deal-sidebar-box .widget-title .price-sale,
.deal-countdown-wrap,
.deal-bought-wrap,
.deal-value-wrap li p,
.pagination li a,
.pagination li:first-child a,
.pagination li:last-child a,
.widget-footer .widget .widget-title h4,
.white-block .tree li a,
.shop-offer-filter a,
.widget .white-block-content .nav-tabs li a,
.coupon-code-modal,
.coupon-code-modal.print{
    font-family: "<?php echo $titles_font; ?>", sans-serif;
}

.notification-bar{
    background: <?php echo $notification_bg_color ?>;
    color: <?php echo $notification_font_color ?>;
}

.notification-bar a{
    color: <?php echo $notification_font_color ?>;
}