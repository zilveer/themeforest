<?php
header("Content-type: text/css; charset: UTF-8");

$post_id = !empty($_GET["post_id"]) ? intval($_GET["post_id"]) : null;
$backup_id = $post_id;
$iron_styles = new Dynamic_Styles(IRON_TEXT_DOMAIN);

if($post_id) {

	$parents = get_post_ancestors($post_id);

	$background_id = get_field('background', $post_id);
	$background_color = get_field('background_color', $post_id);

	while(empty($background_id) && empty($background_color) && !empty($parents)) {

		$post_id = array_pop($parents);
		$background_id = get_field('background', $post_id);
		$background_color = get_field('background_color', $post_id);
	}

	if(!empty($background_id) || !empty($background_color)) {

		if(!empty($background_id)) {
			$background_url = wp_get_attachment_image_src( $background_id, 'full' );
			$background_url = $background_url[0];
		}else{
			$background_url = 'none';
		}
			
		$background_repeat = get_field('background_repeat', $post_id);
		$background_size = get_field('background_size', $post_id);
		$background_position = get_field('background_position', $post_id);
		//$background_attachment = get_field('background_attachment', $post_id);
		$background_attachment = 'fixed';

		$iron_styles->useOptions(false);
		
/*
		if($iron_styles->is_touch_device && $background_attachment == 'fixed') {
			$background_url = '';
		}
*/
		
		$background = array(
			'background-image' => $background_url,
			'background-repeat' => $background_repeat,
			'background-size' => $background_size,
			'background-position' => $background_position,
			'background-attachment' => $background_attachment,
			'background-color' => $background_color
		);

		$iron_styles->setBackground('body', $background, true);

		$iron_styles->useOptions(true);

	}else{
		$iron_styles->setBackground('body', 'body_background', true);
	}
	
	
	
	$content_background_color = get_field('content_background_color', $post_id);
	$content_background_transparency = get_field('content_background_transparency', $post_id);
	
	$iron_styles->useOptions(false);
	
	if(!empty($content_background_color) && isset($content_background_transparency)) {
		$rgb = $iron_styles->hex2rgb($content_background_color);
		$rgba = "rgba(".($rgb[0].",".$rgb[1].",".$rgb[2].",".$content_background_transparency).")";
		$iron_styles->set('#pusher', 'background-color', $rgba); 
		
	}else{
	
		if(!empty($content_background_color))
			$iron_styles->set('#pusher', 'background-color', $content_background_color);
			
		if(isset($content_background_transparency))	
			$iron_styles->set('#pusher', 'opacity', $content_background_transparency);
	}
	
	$iron_styles->useOptions(true);


}else{
	$iron_styles->setBackground('body', 'body_background', true);
}

if(empty($content_background_color)) {

	$content_selector = '#pusher';
	$iron_styles->setBackground($content_selector, 'content_background');

}

// FEATURED COLOR 

$featured_color = '
a,
code,
.blockquote-block,
.event-row span.city,
.tab-circle,
.wpb_content_element.circle a,
a.button-more,.pages a,
.pages .current,
.no-touch .iron_widget_newsletter input[type="submit"]:hover,
.iron_widget_twitter .twitter-logo,
.iron_widget_twitter .twitter-logo-small,
.blockquote-block,
.event-row span.city,
.tab-circle,
.comment-content a,
.comment-author .fn,
.comment-author .url,
.comment-reply-link,
.comment-reply-login,
.no-touch .comment-meta a:hover,
.no-touch .comment-reply-title small a:hover,
.comments-title,
.nav-menu .current_page_item > a,
.nav-menu .current_page_ancestor > a,
.nav-menu .current-menu-item > a,
.nav-menu .current-menu-ancestor > a,
.iron_widget_recent_tweets .meta .time a,
.carousel .datetime,
.article .datetime,
.single-post time,
.meta .datetime,
.blockquote-block .title,
.blockquote-block figcaption,
span.wpcf7-not-valid-tip-no-ajax,
.wpcf7-response-output,
.photos-list .hover-text span,
.contact-box .phone,
.error,
.success span,
.concerts-list .title-row .date,
.concerts-list .expanded .title-row .link,
.iron_widget_newsletter label span,
.concerts-list .title-row .link,
.icon-concert-dropdown,
li.expanded .title-row .icon-concert-dropdown,
.no-touch .media-block a:hover .media-decoration.media-audio,
.no-touch .media-block a:hover .media-decoration.media-audio,
.media-decoration.media-video,
.carousel .video-box .btn-play,
.terms-list small,
.terms-list [class^="icon-"],
.terms-list [class*=" icon-"],
.concerts-list .title-row .city,
.no-touch .nm_mc_form .nm_mc_button:hover,
.no-touch .footer-wrapper-backtotop:hover,
#sidebar .panel-action,
.tweet_text a,
.no-touch .iron_widget_newsletter .nm_mc_button input[type="submit"]:hover,
.no-touch #footer .iron_widget_newsletter input[type="submit"]:hover,
.no-touch #footer .nm_mc_form input[type="submit"]:hover,
.iron_widget_newsletter input[type="submit"],
.nm_mc_form input[type="submit"],
.event-more-button,
.no-touch .nav-menu li:hover > a,
.no-touch ul.nav-menu ul a:hover,
.no-touch .nav-menu ul ul a:hover,
.no-touch .nav-menu .has-drop-down ul a:hover,
.no-touch .nav-menu li a.backbtn:hover,
.wpb_content_element a,
#sidebar .textwidget a,
blockquote p,
.footer__widgets ul a,
.wooprice ins,
.woocommerce ul.products li.product .price,
.woocommerce-page ul.products li.product .price,
.woocommerce div.product span.price,
.woocommerce div.product p.price,
.woocommerce #content div.product span.price,
.woocommerce #content div.product p.price,
.woocommerce-page div.product span.price,
.woocommerce-page div.product p.price,
.woocommerce-page #content div.product span.price,
.woocommerce-page #content div.product p.price,
.wooprice,
.woocommerce .star-rating, 
.woocommerce-page .star-rating,
.woocommerce nav.woocommerce-pagination ul li a,
.woocommerce nav.woocommerce-pagination ul li span,
.woocommerce #content nav.woocommerce-pagination ul li a,
.woocommerce #content nav.woocommerce-pagination ul li span,
.woocommerce-page nav.woocommerce-pagination ul li a,
.woocommerce-page nav.woocommerce-pagination ul li span,
.woocommerce-page #content nav.woocommerce-pagination ul li a,
.woocommerce-page #content nav.woocommerce-pagination ul li span,
.woocommerce table.cart a.remove,
.woocommerce #content table.cart a.remove,
.woocommerce-page table.cart a.remove,
.woocommerce-page #content table.cart a.remove,
.woocommerce .woocommerce-product-rating .star-rating,
.woocommerce-page .woocommerce-product-rating .star-rating,
.woo-thanks,
.infobox-icon,
.menu-toggle-off,
a.back-btn,
.playlist_enabled .player-box .jp-playlist ul li .button,
.button.add_to_cart_button.product_type_simple,
.post-password-form input[type="submit"],
.no-touch .has-drop-down-a:hover .sub-arrow i,
.social-networks a i:hover,
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
.shipping-calculator-button,
.articles-classic .text-box a:hover h2,
.articles-classic a.readmore-classic:hover,
#commentform .form-submit #submit,
.classic-meta .meta-author-link,
.stickypost i,
.simple-post-txt-wrap a:hover h2,
.portfolio .portfolio-prev:hover .prev-text,
.portfolio .portfolio-next:hover .next-text,
.portfolio .portfolio-prev:hover i.fa-long-arrow-left,
.portfolio .portfolio-next:hover i.fa-long-arrow-right,
.portfolio .portfolio-mid-wrap i.fa-th:hover,
.woocommerce .woocommerce-message::before,
.woocommerce .woocommerce-info::before';

$iron_styles->setColor($featured_color, 'featured_color');


$featured_background = '
.no-touch .store-list a.button:hover,
.album-overlay,
.pages .current,
.no-touch .pages a:hover,
.no-touch a.button-more:hover,
.type-album .tracks-block .player-box,
.player-box .jp-progress .jp-play-bar,
.no-touch .recent-posts .media-block a:hover,
.iron_widget_newsletter,
.iron_widget_newsletter input[type="email"],
.nm_mc_form input[type="text"],
#footer .newsletter-wrap,
.no-touch .concerts-list .title-row:hover .buttons .button,
.no-touch .store-list a.button:hover,
.album-overlay,
.marquee .tp-leftarrow,
.marquee .tp-rightarrow,
.marquee .more,
.player-box .jp-progress .jp-play-bar,
.no-touch .carousel .btn-prev:hover,
.no-touch .carousel .btn-next:hover,
.no-touch .carousel .slide a:hover,
.concert-box .hover-box,
.no-touch .article a:hover,
.pages .current,
.no-touch .pages a:hover,
.no-touch .button-more:hover,
a.button,
.comment-form #submit,
.wpcf7-submit,
.filters-block a.active,
.no-touch .media-block a:hover,
.form input[type="submit"],
.concerts-list .title-row .time,
.no-touch .concerts-list .title-row.has_countdown:hover .buttons,
.concerts-list .expanded .title-row .button,
.concerts-list .expanded .title-row:after,
.iron_widget_newsletter input[type="submit"]:focus,
.no-touch .iron_widget_newsletter input[type="submit"]:hover,
.select-options .item-selected a,
.no-touch .concerts-list .expanded .title-row .opener:hover:after,
.concerts-list .title-row .button,
.media-decoration.media-audio,
.tracks-list .btn-play [class^="icon-"],
.tracks-list .btn-play [class*=" icon-"],
.tracks-list .btn-pause [class^="icon-"],
.tracks-list .btn-pause [class*=" icon-"],
.no-touch .player-box a:hover [class^="icon-"],
.no-touch .player-box a:hover [class*=" icon-"],
.no-touch .social-networks a:hover [class^="icon-"],
.no-touch .social-networks a:hover [class*=" icon-"],
.carousel .video-box .icon-play,
#searchform input[type="submit"],
.no-touch .news-grid-wrap a:hover,
.no-touch .iron_widget_videos .video-list article a:hover,
a.back-btn:hover,
.no-touch .photo-wrap:hover .tab-text,
.no-touch .videogrid:hover .text-box,
.media-block.sticky a,
.playlist_enabled .player-box .jp-playlist ul li .button:hover,
.button.add_to_cart_button.product_type_simple:hover,
.post-password-form input[type="submit"]:hover,
.title-row.no-countdown:hover,
.woocommerce a.button:hover,
.woocommerce button.button:hover,
.woocommerce input.button:hover,
.woocommerce #respond input#submit:hover,
.woocommerce #content input.button:hover,
.woocommerce-page a.button:hover,
.woocommerce-page button.button:hover,
.woocommerce-page input.button:hover,
.woocommerce-page #respond input#submit:hover,
.woocommerce-page #content input.button:hover,
.woocommerce a.button.alt:hover,
.woocommerce button.button.alt:hover,
.woocommerce input.button.alt:hover,
.woocommerce #respond input#submit.alt:hover,
.woocommerce #content input.button.alt:hover,
.woocommerce-page a.button.alt:hover,
.woocommerce-page button.button.alt:hover,
.woocommerce-page input.button.alt:hover,
.woocommerce-page #respond input#submit.alt:hover,
.woocommerce-page #content input.button.alt:hover,
.woocommerce table.cart a.remove:hover,
.woocommerce #content table.cart a.remove:hover,
.woocommerce-page table.cart a.remove:hover,
.woocommerce-page #content table.cart a.remove:hover,
.shipping-calculator-button:hover,
.woocommerce #content nav.woocommerce-pagination ul li a:focus,
.woocommerce #content nav.woocommerce-pagination ul li a:hover,
.woocommerce #content nav.woocommerce-pagination ul li span.current,
.woocommerce nav.woocommerce-pagination ul li a:focus,
.woocommerce nav.woocommerce-pagination ul li a:hover,
.woocommerce nav.woocommerce-pagination ul li span.current,
.woocommerce-page #content nav.woocommerce-pagination ul li a:focus,
.woocommerce-page #content nav.woocommerce-pagination ul li a:hover,
.woocommerce-page #content nav.woocommerce-pagination ul li span.current,
.woocommerce-page nav.woocommerce-pagination ul li a:focus,
.woocommerce-page nav.woocommerce-pagination ul li a:hover,
.woocommerce-page nav.woocommerce-pagination ul li span.current,
.playlist_enabled .player-box .jp-playlist ul li.jp-playlist-current,
.no-touch .playlist_enabled .player-box .jp-playlist ul li:hover,
.woocommerce-message .button.wc-forward:hover,
#commentform .form-submit #submit:hover,
.news-grid-wrap a.sticky,
.news-grid-wrap.isotope-item a.sticky,
ins';

$iron_styles->setBackgroundColor($featured_background, 'featured_color');

$featured_border = '
.tab-circle,a.button-more,
.tab-circle,
input.error,
.event-more-button,
.woocommerce .woocommerce-info,
.woocommerce-page .woocommerce-info,
.woocommerce .woocommerce-message,
.woocommerce-page .woocommerce-message,
.chosen-container-active .chosen-single,
a.back-btn,
.playlist_enabled .player-box .jp-playlist ul li .button,
.button.add_to_cart_button.product_type_simple,
.post-password-form input[type="submit"],
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
.woocommerce-page #content input.button.alt
.shipping-calculator-button,
.articles-classic a.readmore-classic:hover,
#commentform .form-submit #submit,
.page-template-archive-posts-classic-php .media-block.sticky  .holder,
blockquote,
.portfolio .portfolio-rightside a.portfolio-button';

$iron_styles->setBorderColor($featured_border, 'featured_color');



// PRIMARY COLOR LIGHT

$primary_background_light = '
.footer__widgets > .iron_widget_newsletter input[type="submit"],
.carousel .btn-prev,
.carousel .btn-next,
.panel .opener,
.blockquote-box figcaption:before,
.meta .datetime,
.concerts-list .title-row .time,
.form input[type="text"],
.form input[type="email"],
.form input[type="password"],
.form textarea,
.comment-form input,
.comment-form textarea,
.select-options,
.jp-no-solution,
.no-touch .nav-menu li:hover > a,
.no-touch ul.nav-menu ul a:hover,
.no-touch .nav-menu ul ul a:hover,
.no-touch .nav-menu .has-drop-down ul a:hover,
.meta .datetime,
.no-touch .nm_mc_form .nm_mc_button:hover,
.comment-text,
#footer .iron_widget_newsletter .nm_mc_button:hover';

$iron_styles->setBackgroundColor($primary_background_light, 'primary_color_light');


$primary_border_light = '
#footer .iron_widget_newsletter input[type="email"],
#footer .nm_mc_form input[type="text"],
#footer .iron_widget_newsletter input[type="submit"],
#footer .nm_mc_form input[type="submit"],
.no-touch .concerts-list .title-row:hover .buttons .button,
.vc_span4 .concerts-list .title-row .datetime,
.vc_span3 .concerts-list .title-row .datetime,
.vc_span2 .concerts-list .title-row .datetime,
#sidebar .concerts-list .title-row .datetime,
.footer__widgets .panel__heading,
.footer__widgets > .iron_widget_newsletter .control-append,
.concerts-list .title-row .datetime,
.event-row .datetime,
.pages.full li a,
.pages.full li span,
.comment-reply-title small a,
#footer .widget-area label.control-label,
.page-numbers.dots';

$iron_styles->setBorderColor($primary_border_light, 'primary_color_light');



// PRIMARY COLOR DARK
$woo_backgrounds = (bool)$iron_styles->get_option('woo_backgrounds');

if($woo_backgrounds){
	$primary_background_dark = '
	.media-block a,
	.blockquote-block,
	.store-list a.button,
	.concerts-list li,
	.event-row,
	.type-album .text-box,
	.tracks-list > li,
	.panel-action,
	.iron_widget_twitter .panel__body,
	.iron_widget_twitter .panel-action,
	.iron_widget_radio .panel__body,
	.photo-wrap .photo-album-tab,
	.news-grid-wrap a,
	.container .iron_widget_newsletter,
	.container .newsletter-wrap,
	.videogrid,
	.iron_widget_videos .video-list article a,
	blockquote,
	.woocommerce nav.woocommerce-pagination ul li a,
	.woocommerce nav.woocommerce-pagination ul li span,
	.woocommerce #content nav.woocommerce-pagination ul li a,
	.woocommerce #content nav.woocommerce-pagination ul li span,
	.woocommerce-page nav.woocommerce-pagination ul li a,
	.woocommerce-page nav.woocommerce-pagination ul li span,
	.woocommerce-page #content nav.woocommerce-pagination ul li a,
	.woocommerce-page #content nav.woocommerce-pagination ul li span,
	.woocommerce .woocommerce-message,
	.woocommerce .woocommerce-error,
	.woocommerce .woocommerce-info,
	.woocommerce-page .woocommerce-message,
	.woocommerce-page .woocommerce-error,
	.woocommerce-page .woocommerce-info,
	.woocommerce ul.products li.product,
	.woocommerce-page ul.products li.product,
	.woocommerce div.product div.summary,
	.woocommerce #content div.product div.summary,
	.woocommerce-page div.product div.summary,
	.woocommerce-page #content div.product div.summary,
	.woocommerce div.product .woocommerce-tabs .panel,
	.woocommerce #content div.product .woocommerce-tabs .panel,
	.woocommerce-page div.product .woocommerce-tabs .panel,
	.woocommerce-page #content div.product .woocommerce-tabs .panel,
	.woocontent.cart,
	form.checkout,
	.woocommerce-account .woocommerce,
	.cart-empty,
	.woocommerce-checkout .woocommerce,
	.track_order,
	.woocommerce div.product .woocommerce-tabs ul.tabs li.active,
	.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active,
	.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active,
	.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active,
	.description_tab,
	.reviews_tab,
	.articles-classic .media-block .holder,
	.pages a';
} else {
	$primary_background_dark = '
	.media-block a,
	.blockquote-block,
	.store-list a.button,
	.concerts-list li,
	.event-row,
	.type-album .text-box,
	.tracks-list > li,
	.panel-action,
	.iron_widget_twitter .panel__body,
	.iron_widget_twitter .panel-action,
	.iron_widget_radio .panel__body,
	.photo-wrap .photo-album-tab,
	.news-grid-wrap a,
	.container .iron_widget_newsletter,
	.container .newsletter-wrap,
	.videogrid,
	.iron_widget_videos .video-list article a,
	blockquote,
	.articles-classic .media-block .holder,
	.pages a';
}

$iron_styles->setBackgroundColor($primary_background_dark, 'primary_color_dark');



// SECONDARY COLOR LIGHT

$secondary_background_light = '
#footer,
.no-touch .panel-action:hover,
.no-touch #sidebar .panel-action:hover,
.iron_widget_newsletter .newsletter-wrap nm_mc_button,
.no-touch .iron_widget_newsletter input[type="submit"]:hover,
.no-touch a.button:hover,
.wpb_accordion_section a,
.ui-tabs-anchor';


$iron_styles->setBackgroundColor($secondary_background_light, 'secondary_color_light');


// SECONDARY COLOR LIGHT

$secondary_border_light = '
.comment-respond,
.container .iron_widget_newsletter input[type="email"],
.container .nm_mc_form input[type="text"],
.container .iron_widget_newsletter input[type="submit"],
.container .nm_mc_form input[type="submit"],
.post-password-form input[type="password"],
.wpb_tabs_nav';


$iron_styles->setBorderColor($secondary_border_light, 'secondary_color_light');



// SECONDARY COLOR DARK

$secondary_background_dark = '.footer-block.share';

$iron_styles->setBackgroundColor($secondary_background_dark, 'secondary_color_dark');



// TEXT COLOR LIGHT

$text_color_light = '
.iron_widget_newsletter input[type="email"],
.nm_mc_form input[type="text"],
.nm_mc_form label,
#footer .iron_widget_newsletter input[type="submit"],
#footer .nm_mc_form input[type="submit"],
.countdown-block,
.countdown-section,
.countdown-amount,
.countdown-period,
.vc_span4 .countdown-block,
.vc_span3 .countdown-block,
.vc_span2 .countdown-block,
#sidebar .countdown-block,
.footer-block .social-networks a,
.footer__widgets,
.footer-row,
.footer__widgets > .iron_widget_newsletter .control-label,
.footer__widgets > .iron_widget_newsletter .form-control,
.footer-row ul,
.footer-row ul a,
.countdown-block,
.concerts-list .title-row .open-link,
.no-touch .concerts-list .title-row .button:hover,
.panel__heading,
.panel__footer,
.title-box,
.title-box h2,
.no-touch .carousel .btn-prev:hover,
.no-touch .carousel .btn-next:hover,
.media-decoration.media-audio,
#header,
.nav-menu li a,
ul.nav-menu ul a,
.nav-menu ul ul a,
.iosSlider .slider .item .inner .text1 span,
.iosSlider .slider .item .inner .text2 span,
.no-touch a.button:hover,
.no-touch .store-list a.button:hover,
.concerts-list,
.no-touch .title-row:hover .icon-concert-dropdown,
.no-touch .concerts-list .title-row:hover .button:hover,
.no-touch .concerts-list .expanded .title-row .button:hover,
.concerts-list .title-row .opener,
.album-listen,
.circle,
.tracks-list,
.tracks-list .button,
.tracks-list .btn-play,
.tracks-list .btn-pause,
.no-touch .tracks-list .btn-play:hover,
.no-touch .tracks-list .btn-pause:hover,
.iron_widget_radio .info-box li.jp-playlist-current .track-name,
.no-touch .iron_widget_radio .info-box li:hover .track-name,
.gallery-caption,
.pages .current,
.no-touch .pages a:hover,
.no-touch a.button-more:hover,
.pages .current,
.no-touch .form input[type="submit"]:hover,
.comment-form #submit,
.wpcf7-submit,
.no-touch .comment-form #submit:hover,
.no-touch .wpcf7-submit:hover,
.concert-box .time,
.video-box .hover-box,
.video-box h2,
.video-box .icon-play,
.marquee .more,
.pages .current,
.no-touch .pages a:hover,
.no-touch .button-more:hover,
.no-touch .concerts-list .title-row.has_countdown:hover .button:hover,
.no-touch .concerts-list .title-row.has_countdown:hover .buttons .button,
.iron_widget_newsletter .form-status,
.concerts-list .title-row .button,
.event-text-wrap .location-h,
.event-text-wrap .city-h,
.footer__widgets .iron_widget_radio .info-box,
#footer .tweet_text,
#footer .nm_mc_error
#footer .textwidget,
#footer .newsletter-title-wrap h3,
#footer .newsletter-description-wrap,
#footer .newsletter-description-wrap p,
.tracks-list > li.jp-playlist-current:before,
.no-touch .tracks-list > li:hover:before,
a.button,
play-button,
.darker-overlay h1,
.darker-overlay h2,
.darker-overlay h3,
.darker-overlay h4,
.darker-overlay h5,
.darker-overlay h6,
#footer .wp-calendar,
#footer p,
#footer ul,
#footer li,
#footer dl,
#footer dt,
#footer dd,
#footer ol,
#footer pre,
#footer tr,
#footer td,
#footer th,
#sidebar .button.wc-forward,
.post-password-form input[type="password"],
#footer .iron_widget_newsletter .newsletter-wrap .control-description,
#footer .iron_widget_newsletter .nm_mc_button:hover';

$iron_styles->setColor($text_color_light, 'text_color_light');
$iron_styles->setColor('#footer ::-webkit-input-placeholder', 'text_color_light');
$iron_styles->setColor('#footer :-moz-placeholder', 'text_color_light');
$iron_styles->setColor('#footer ::-moz-placeholder', 'text_color_light');
$iron_styles->setColor('#footer :-ms-input-placeholder', 'text_color_light');



$text_color_dark = '
body,
.video-post,
.single-post h2,
.concerts-list .title-row .datetime,
.event-row .datetime,
.type-album .text-box h2,
.tab-title,
.tab-title .excerpt,
.tracks-list .name,
.comment-reply-title,
.info-section h2,
h2.widgettitle,
#sidebar .panel__heading,
#sidebar .panel__heading h3,
.media-block .datetime,
.media-block .category,
.form input[type="submit"],
.concerts-list .title-row .time,
.concerts-list .expanded .title-row .button,
.post_grid .tab-text time.datetime,
h1,
h3.widgettitle,
.concerts-list .title-row .location,
.excerpt p,
.tweet_text,
.iron_widget_radio .info-box .title, 
.iron_widget_radio .info-box .track-name,
.content-box,
.available-now,
.release-date,
.store-list a.button,
.jp-current-time,
.jp-duration,
.jp-play i,
.jp-pause i,
.jp-previous i,
.jp-next i,
.container .nm_mc_form input[type="text"],
.container .nm_mc_form label,
.container .nm_mc_error,
#sidebar .nm_mc_error,
.event-row span.location,
.event-boldtitle,
.event-wrapper .righthalf,
.event-row .button,
.media-block h2,
.p,
.tracks-list > li:before,
.tab-date,
.videogrid .text-box h2,
.control-description,
.wpb_content_element,
.no-touch .photo-wrap:hover .tab-circle,
.lighter-overlay h1,
.lighter-overlay h2,
.lighter-overlay h3,
.lighter-overlay h4,
.lighter-overlay h5,
.lighter-overlay h6,
.no-touch .news-grid-wrap a:hover time,
#sidebar .textwidget,
#sidebar a,
p,
ul,
li,
dl,
dt,
dd,
ol,
pre,
tr,
td,
th,
.wooprice del,
.woocommerce .woocommerce-message,
.woocommerce .woocommerce-error,
.woocommerce .woocommerce-info,
.woocommerce-page .woocommerce-message,
.woocommerce-page .woocommerce-error,
.woocommerce-page .woocommerce-info,
.description_tab,
.reviews_tab,
h3,
.event-map-link,
.news-grid-wrap a.sticky,
.news-grid-wrap.isotope-item a.sticky,
.entry p,
.portfolio-sidetitle,
.portfolio-sidelist,
.portfolio .portfolio-prev .prev-text,
.portfolio .portfolio-next .next-text,
.portfolio .portfolio-prev i.fa-long-arrow-left,
.portfolio .portfolio-next i.fa-long-arrow-right,
.portfolio .portfolio-mid-wrap i.fa-th';

$iron_styles->setBorderColor('.no-touch .photo-wrap:hover .tab-circle, .comment-list > li:after, .comment-list .children > li:before, .comment-reply-title', 'text_color_dark');

$iron_styles->setColor($text_color_dark, 'text_color_dark');
$iron_styles->setColor('::-webkit-input-placeholder', 'text_color_dark');
$iron_styles->setColor(':-moz-placeholder', 'text_color_dark');
$iron_styles->setColor('::-moz-placeholder', 'text_color_dark');
$iron_styles->setColor(':-ms-input-placeholder', 'text_color_dark');


$iron_styles->setBackground('
.side-menu,
.nav-menu .sub-menu,
.nav-menu .children', 'menu_background');


$iron_styles->setBackgroundColor('ul.header-top-menu', 'header_top_menu_background');
$iron_styles->setColor('.menu-toggle > i, ul.header-top-menu li a', 'menu_open_icon_color');
$iron_styles->setColor('.menu-toggle-off i', 'menu_close_icon_color');
$iron_styles->setFont('ul.header-top-menu li a', 'header_top_menu_typography');

$menutypography = $iron_styles->get_option('header_top_menu_typography');
if(!empty($menutypography["color"])) {
	$iron_styles->setColor('.sub-arrow i', $menutypography["color"]);
}

$iron_styles->setFont('body, .entry p', 'body_typography', true);
$iron_styles->setFont('.nav-menu li a, ul.nav-menu li.menu-item ul.sub-menu li a', 'menu_typography', true);
$iron_styles->setFont('h1', 'h1_typography', true);
$iron_styles->setFont('h2, .single-post h2, .text-box h2, .video-box h2, .title-box h2, .news .media-block h2, .iron_widget_recent_posts .news .media-block h2, .type-album .text-box h2', 'h2_typography', true);
$iron_styles->setFont('h3, h3.widgettitle', 'h3_typography', true);
$iron_styles->setFont('h4', 'h4_typography', true);
$iron_styles->setFont('h5', 'h5_typography', true);
$iron_styles->setFont('h6', 'h6_typography', true);
$iron_styles->setFont('a.panel-action.panel-action__label', 'call_to_action_typography', true);

$iron_styles->useOptions(false);

$h1_options = $iron_styles->get_option('h1_typography');
$iron_styles->setBackgroundColor('span.heading-t, span.heading-b', $h1_options["color"]);

$h3_options = $iron_styles->get_option('h3_typography');
$iron_styles->setBackgroundColor('span.heading-t3, span.heading-b3', $h3_options["color"]);

$dark_text = $iron_styles->get_option('text_color_dark');
$iron_styles->setBackgroundColor('.lighter-overlay span.heading-t, .lighter-overlay span.heading-b', $dark_text);
$iron_styles->setBackgroundColor('.lighter-overlay span.heading-t3, .lighter-overlay span.heading-b3', $dark_text);

$light_text = $iron_styles->get_option('text_color_light');
$iron_styles->setBackgroundColor('.darker-overlay span.heading-t, .darker-overlay span.heading-b', $light_text);
$iron_styles->setBackgroundColor('.darker-overlay span.heading-t3, .darker-overlay span.heading-b3', $light_text);


$h4_options = $iron_styles->get_option('h4_typography');
if(!empty($h4_options["color"])) {
	$iron_styles->setBorderColor('h4', $h4_options["color"]);
}


$menu_margin = $iron_styles->get_option('menu_margin');

if(!empty($menu_margin)) {
	$menu_margin = str_replace('px', '', $menu_margin).'px';
	$iron_styles->set('.nav-menu li a', 'margin-top', $menu_margin);
	$iron_styles->set('.nav-menu li a', 'margin-bottom', $menu_margin);
}

if(!empty($h1_options["align"])) {

	$align = $h1_options["align"];
	if($align == 'left') {
		$iron_styles->set('span.heading-t, span.heading-b', 'margin-left', '0px');
	}else if($align == 'right') {
		$iron_styles->set('span.heading-t, span.heading-b', 'margin-right', '0px');
		$iron_styles->set('span.heading-t, span.heading-b', 'margin-left', 'auto');
    }	
}

if(!empty($h3_options["align"])) {

	$align = $h3_options["align"];
	if($align == 'left') {
		$iron_styles->set('span.heading-t3, span.heading-b3', 'margin-left', '0px');
	}else if($align == 'right') {
		$iron_styles->set('span.heading-t3, span.heading-b3', 'margin-right', '0px');
		$iron_styles->set('span.heading-t3, span.heading-b3', 'margin-left', 'auto');
    }	
}

$iron_styles->useOptions(true);


// Classic Menu

$iron_styles->useOptions(false);
$classic_menu_hmargin = $iron_styles->get_option('classic_menu_hmargin');
$iron_styles->set('.classic-menu', 'width', 'calc( 100% - '.$classic_menu_hmargin.' - '.$classic_menu_hmargin.' )');
$iron_styles->useOptions(true);

$classic_menu_width = $iron_styles->get_option('classic_menu_width');

$iron_styles->set('.classic-menu', 'margin-left', 'classic_menu_hmargin');
$iron_styles->set('.classic-menu', 'margin-right', 'classic_menu_hmargin');
$iron_styles->set('.classic-menu', 'margin-top', 'classic_menu_top_margin');
$iron_styles->set('.classic-menu', 'margin-bottom', 'classic_menu_bottom_margin');


if($classic_menu_width == 'fullwidth' ) {
	$selector = '.classic-menu';
}else{
	$selector = '.classic-menu > ul';
}

$iron_styles->set($selector, 'padding-left', 'classic_menu_hpadding');
$iron_styles->set($selector, 'padding-right', 'classic_menu_hpadding');
$iron_styles->set($selector, 'padding-top', 'classic_menu_vpadding');
$iron_styles->set($selector, 'padding-bottom', 'classic_menu_vpadding');


$iron_styles->set('.classic-menu > ul > li', 'margin-left', 'classic_menu_item_hmargin');
$iron_styles->set('.classic-menu > ul > li', 'margin-right', 'classic_menu_item_hmargin');
$iron_styles->set('.classic-menu > ul > li', 'margin-top', 'classic_menu_item_vmargin');
$iron_styles->set('.classic-menu > ul > li', 'margin-bottom', 'classic_menu_item_vmargin');

$iron_styles->set('.classic-menu > ul > li a', 'padding-left', 'classic_menu_item_hpadding');
$iron_styles->set('.classic-menu > ul > li a', 'padding-right', 'classic_menu_item_hpadding');
$iron_styles->set('.classic-menu > ul > li a', 'padding-top', 'classic_menu_item_vpadding');
$iron_styles->set('.classic-menu > ul > li a', 'padding-bottom', 'classic_menu_item_vpadding');


$iron_styles->set('.classic-menu > ul > li.logo', 'padding-left', 'classic_menu_logo_padding_left');
$iron_styles->set('.classic-menu > ul > li.logo', 'padding-top', 'classic_menu_logo_padding_top');
$iron_styles->set('.classic-menu > ul > li.logo', 'padding-right', 'classic_menu_logo_padding_right');
$iron_styles->set('.classic-menu > ul > li.logo', 'padding-bottom', 'classic_menu_logo_padding_bottom');

// Menu BG

$post_id = $backup_id;

if($post_id) {
	
	$menu_background = get_field('classic_menu_background', $post_id);

	if(!empty($menu_background)) {

		$menu_background_alpha = get_field('classic_menu_background_alpha', $post_id);
		
		if(isset($menu_background_alpha)) {
			
			$rgb = $iron_styles->hex2rgb($menu_background);
			$menu_background = "rgba(".($rgb[0].",".$rgb[1].",".$rgb[2].",".$menu_background_alpha).")";
		}
		
		$iron_styles->useOptions(false);
		$iron_styles->setBackgroundColor('.classic-menu', $menu_background);
		$iron_styles->useOptions(true);

		
	}else{
		$iron_styles->setBackgroundColor('.classic-menu', 'classic_menu_background');
		$iron_styles->setBackgroundColor('.classic-menu > ul', 'classic_menu_inner_background');
	}	
	
	$iron_styles->useOptions(false);
	$menu_is_over = get_field('classic_menu_over_content', $post_id);
	$menu_main_item_color = get_field('classic_menu_main_item_color', $post_id);

	if(!empty($menu_is_over) && !empty($menu_main_item_color)) {
		
		$iron_styles->set('.classic-menu.fixed:not(.fixed_before):not(.mini):not(.responsive) > ul > li > a', 'color', $menu_main_item_color);
		$iron_styles->set('.classic-menu.fixed:not(.absolute_before):not(.mini):not(.responsive) > ul > li > a', 'color', $menu_main_item_color);
	}
	$iron_styles->useOptions(true);	
	
}else{
	$iron_styles->setBackgroundColor('.classic-menu', 'classic_menu_background');
	$iron_styles->setBackgroundColor('.classic-menu > ul', 'classic_menu_inner_background');
}




// Menu Bg Mini
$iron_styles->setBackgroundColor('.classic-menu.mini', 'classic_menu_background_mini');

// Item Typo
$iron_styles->setFont('.classic-menu > ul > li a', 'classic_menu_typography');

// Sub Item Typo
$iron_styles->setFont('.classic-menu > ul > li > ul > li a', 'classic_sub_menu_typography');

// Item Hover
$iron_styles->setBackgroundColor('.classic-menu > ul > li a:hover', 'classic_menu_hover_bg_color');
$iron_styles->setColor('.classic-menu > ul > li a:hover', 'classic_menu_hover_text_color');

// Item Active
$iron_styles->setBackgroundColor('.classic-menu > ul > li.current-menu-item > a', 'classic_menu_active_bg_color');
$iron_styles->setColor('.classic-menu > ul > li.current-menu-item > a', 'classic_menu_active_text_color');

// Item Active
$iron_styles->setBackgroundColor('.classic-menu > ul > li.current-menu-ancestor > a', 'classic_menu_active_bg_color');
$iron_styles->setColor('.classic-menu > ul > li.current-menu-ancestor > a', 'classic_menu_active_text_color');

// Sub Item Hover
$iron_styles->setBackgroundColor('.classic-menu > ul > li > ul > li a:hover', 'classic_sub_menu_hover_bg_color');
$iron_styles->setColor('.classic-menu > ul > li > ul > li a:hover', 'classic_sub_menu_hover_text_color');

// Sub Item Active
$iron_styles->setBackgroundColor('.classic-menu > ul > li > ul > li.current-menu-item > a', 'classic_sub_menu_active_bg_color');
$iron_styles->setColor('.classic-menu > ul > li > ul > li.current-menu-item > a', 'classic_sub_menu_active_text_color');


$iron_styles->set('.classic-menu > ul > li > a', 'letter-spacing', 'classic_menu_letter_spacing');


$global_custom_css = $iron_styles->get_option('custom_css');
$iron_styles->setCustomCss($global_custom_css);

$iron_styles->render();