<?php
header("Content-type: text/css; charset: UTF-8");
$uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $uri[0] . 'wp-load.php' );

$font       = of_get_option('font_pred');
$fontsec  = of_get_option('font_sec');
$color      = of_get_option('color_picker');
$image    = get_stylesheet_directory_uri() . '/images/patterns/';
$type        = of_get_option('type_background');
$patterns  = of_get_option('patterns');
$rgb 	    = wize_hex2rgba($color, 0.8);
$rgb2 		= wize_hex2rgba($color, 0.6);

switch ($type) {
    case "pattern":
        echo '
body {
	background: url("' . $image . '' . $patterns . '.png");
    }
	';
	break;
}

echo '
body, h1, h2, h3, h4, h5, h6, li { font-family: "' . $font . '" }

.error-404 h4, .feat-date, .feat-cat, .menu-search form #search, h1.blog, h3.sh-title, h3.sh-title2, h3.wd-title, #footer h3.wd-title, .rsContent-venue, .cvr-title h1, .cvr-cat, .cvr-date, .evhead-date, .evhead-week, .evhead-loc, a.info-like, a.info-liked, .info-view, .info-com, .sng-title h1, .sng-cat, .sng-tag span, .sng-tag a, .sng-social span, .sng-links-prev a, .sng-links-next a, .sng-aut p.user, #author-info p.aut, .bl1-title h2, .bl1-cat, .bl1-date, .bl2-title h2, .bl2-cat, .bl2-date, .ev1-title h2, .ev1-dmy, .ev1-week, .ev1-info, a.ev1-button, .ev1-none, .ev2-dm, .ev2-week span, .ev2-year, .ev2-title h2, .ev2-venue, .ev2-time, a.ev2-button, .ev2-none, .pv1-title h2, .pv1-venue, .pv1-date, .pv2-title h2, .pv2-venue, .pv2-date, .ad1-title h2, .ad1-genre, .ad1-date, .ad2-title h2, .ad2-genre, .ad2-date, .mix-title span, .mix-title h2, .mix-dj, .mix-genre, .mediasng-title h1, .mediasng-venue, .mediasng-date, .mediasng-genre, .mediasng-artist, .mediasng-time, ul.adsng-meta li, ul.adsng-meta2 li, a.adsng-other, ul.songs-list li, .mixsng-title h1, ul.tracklist li, .evsng-date, .sng-date, ul.evsng-meta li, ul.evsng-meta2 li, a.evsng-button, .evsng-none, a.evsng-zoom, a.evsng-map, #wizemenu > ul > li > a, .widget_calendar table#wp-calendar caption, .widget_recent_comments  li.recentcomments a, .widget_recent_entries li a, .wd-ad1-title h2 a, .wd-ad1-gen, .wd-ad1-date, #wd-ad1 ul.songs-list li, .wd-ad1-buy span, a.wd-ad1-other, .wd-ad2-title h2, .wd-ad2-gen, .wd-ad2-date, #wd-ad2 ul.songs-list li, .wd-ad2-buy span, a.wd-ad2-other, .wd-bl1 h2 a, .wd-bl1-date, .wd-bl2-title h2, .wd-bl2-date, .wd-bl2-cat, .wd-ev1-dm, .wd-ev1-dm span, .wd-ev1-week, .wd-ev1-info h2 a, a.wd-ev1-button, .wd-ev1-none, .wd-ev2-week span, .wd-ev2-dm, a.wd-ev2-button, .wd-ev2-none, .wd-ev2-week, .wd-ev2-title h2 a, .widget_like li, .wd-lk-title h2, .wd-ph-title h2 a, .wd-ph-venue, .wd-sld-title h2 a, .wd-sld-cat, .wd-sld-date, .wd-vd-title h2 a, .wd-vd-venue, .pagination span, .pagination a, h3#reply-title, .comment-author cite, .reply a, p.form-submit input#submit, #respond .button-send#submitmail, .bl1 .sticky, .bl2 .sticky, .rsTmb h2, .rsTmb span, #fap-wrapper, #fap-playlist li, .radio-wz-open-hidden, #radiochannelname, #radiostatustext, #radiovolumetext, .sld-full-title, .sld-full-desc, .sld-full-date, .sld-title, .sld-desc, .sld-date, .feat-title h2, .feat-date, button-link a, ul.tabs li a, .trigger a, a#sdc, #wizewoo h1.product_title, #wizewoo span.onsale, #wizewoo p.price, #wizewoo span.amount, #wizewoo button, #wizewoo ul.tabs li a, #wizewoo .entry-content h2, #wizewoo #review_form_wrapper p.stars a, #wizewoo #review_form_wrapper input.submit, #wizewoo ul.products li a .star-rating, #wizewoo ul.products li h3, #wizewoo ul.products li a.button, #wizewoo .woocommerce h2, #wizewoo .woocommerce h3, #wizewoo .woocommerce td.actions input.button, #wizewoo .woocommerce a.checkout-button, #wizewoo #order_review input#place_order, #wizewoo .checkout_coupon input.button, #wizewoo .woocommerce input.button, ul.product_list_widget li .product-title h2, ul.product_list_widget li span.amount, #wizewoo ul.products li a.added_to_cart { font-family: "' . $fontsec . '" }

.sng-links-prev a:hover, .sng-links-next a:hover, a.ev1-button:hover, a.ev2-button:hover, a.evsng-button:hover, .widget_calendar tbody>tr>td a:hover, .widget_recent_comments li a:hover, .widget_recent_entries li a:hover, .wd-ad1-title h2 a:hover, #wd-bl1 .wd-bl1 h2 a:hover, .wd-ev1-info h2 a:hover, a.wd-ev1-button:hover, a.wd-ev2-button:hover, .wd-ev2-title h2 a:hover, .wd-ph-title h2 a:hover, .wd-vd-title h2 a:hover, #respond .button-send#submitmail:hover, .bl1-title h2:hover, .bl2-title h2:hover, .pv1-title h2:hover, .pv2-title h2:hover, .ad1-title h2:hover, .ad2-title h2:hover, .ev1-title h2:hover, .ev2-title h2:hover, .mix h2:hover, .videoGallery .rsThumb.rsNavSelected, .reply a:hover, .pagination a:hover, .pagination .current, .tagcloud a:hover, .sng-tag a:hover, .highlight, #fap-progress-bar, #fap-current-meta a:hover, #fap-volume-scrubber > #fap-volume-indicator, .button-link a, ul.tabs li a, a.pp_download, form > p > input, a#sdc:hover, p.form-submit input#submit:hover, .page-links a span, .widget_recent_comments li.recentcomments a:hover, #wizewoo button, #wizewoo ul.tabs li a:hover, #wizewoo #review_form_wrapper p.stars a:hover, #wizewoo ul.products li h3:hover, #wizewoo ul.products li a.button, #wizewoo .woocommerce td.actions input.button, #wizewoo .woocommerce a.checkout-button, #wizewoo #order_review input#place_order, #wizewoo .checkout_coupon input.button, #wizewoo .woocommerce input.button, ul.product_list_widget li:hover .product-title h2 { background: ' . $color . ' }

a.evsng-zoom, a.evsng-map, a.wd-ad1-beatport:hover, a.wd-ad1-amazon:hover, a.wd-ad1-itunes:hover, a.wd-ad1-other:hover, a.adsng-beatport:hover, a.adsng-amazon:hover, a.adsng-itunes:hover, a.adsng-other:hover { background-color: ' . $color . ' }

a, #wizemenu > ul li.has-sub > a:after, #wizemenu > ul ul li.has-sub > a:after, .evhead-cont:hover .evhead-date, .evhead-cont:hover .evhead-week, .sng-aut p.user a:hover, .widget_recent_comments li.recentcomments a.url, .widget_rss li a, .comment-author cite a:hover, #fap-playlist li span:hover { color: ' . $color . ' }

.rsDefault .rsCloseVideoIcn:hover { background: ' . $color . ' url("../images/close.png") }

.rsDefault .rsFullscreenIcn:hover { background: ' . $color . ' url("../images/extend.png") }

.wd-ad2-cover:hover .wd-ad2-bg, .wd-bl2-cover:hover .wd-bl2-bg, .wd-lk-cover:hover .wd-lk-bg, .wd-sld:hover .wd-sld-bg, .sld-full-title, .sld-title, .feat-cover:hover .feat-bg { background-color: ' . $rgb . ' }

#fap-loading-bar, #fap-volume-scrubber { background: ' . $rgb2 . ' }
';

echo of_get_option('custom_css');