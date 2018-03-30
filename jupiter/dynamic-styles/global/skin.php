<?php

global $mk_options;
$skin_color = $mk_options['skin_color'];
$skin_darker = hexDarker($skin_color, 20);


Mk_Static_Files::addGlobalStyle("


.mk-testimonial-author,
.modern-style .mk-testimonial-company,
#wp-calendar td#today,
.news-full-without-image .news-categories span,
.news-half-without-image .news-categories span,
.news-fourth-without-image .news-categories span,
.mk-read-more,
.news-single-social li a,
.portfolio-widget-cats,
.portfolio-carousel-cats,
.blog-showcase-more,
.simple-style .mk-employee-item:hover .team-member-position,
.mk-portfolio-classic-item .portfolio-categories a,
.register-login-links a:hover,
.not-found-subtitle,
.mk-mini-callout a,
.search-loop-meta a,
.mk-tooltip a:hover,
.new-tab-readmore,
.mk-news-tab .mk-tabs-tabs li.is-active a,
.mk-woo-tabs .mk-tabs-tabs li.ui-state-active a,
.monocolor.pricing-table .pricing-price span,
.quantity .plus:hover,	
.quantity .minus:hover,
.blog-modern-comment:hover,
.blog-modern-share:hover
{
	color: {$skin_color};
}

.mk-tabs .mk-tabs-tabs li.is-active a > i,
.mk-accordion .mk-accordion-single.current .mk-accordion-tab:before,
.widget_testimonials .testimonial-slider .testimonial-author,
#mk-filter-portfolio li a:hover,
#mk-language-navigation ul li a:hover,
#mk-language-navigation ul li.current-menu-item > a,
.mk-quick-contact-wrapper h4,
.divider-go-top:hover i,
.widget-sub-navigation ul li a:hover,
#mk-footer .widget_posts_lists ul li .post-list-meta time,
.mk-footer-tweets .tweet-username,
.product-category .item-holder:hover h4
{
	color: {$skin_color} !important;
}

.accent-bg-color,
.image-hover-overlay,
.newspaper-portfolio,
.similar-posts-wrapper .post-thumbnail:hover > .overlay-pattern,
.portfolio-logo-section,
.post-list-document .post-type-thumb:hover,
#cboxTitle,
#cboxPrevious,
#cboxNext,
#cboxClose,
.comment-form-button,
.mk-dropcaps.fancy-style,
.mk-image-overlay,
.pinterest-item-overlay,
.news-full-with-image .news-categories span,
.news-half-with-image .news-categories span,
.news-fourth-with-image .news-categories span,
.widget-portfolio-overlay,
.portfolio-carousel-overlay,
.blog-carousel-overlay,
.mk-blog-classic-item .blog-loop-comments span,
.mk-similiar-overlay,
.mk-skin-button,
.mk-flex-caption .flex-desc span,
.mk-icon-box .mk-icon-wrapper i:hover,
.mk-quick-contact-link:hover,
.quick-contact-active.mk-quick-contact-link,
.mk-fancy-table th,
.ui-slider-handle,
.widget_price_filter .ui-slider-range,
.shop-skin-btn,
#review_form_wrapper input[type=submit],
#mk-nav-search-wrapper form .nav-side-search-icon:hover,
form.ajax-search-complete i,
.blog-modern-btn,
.showcase-blog-overlay,
.gform_button[type=submit],
.button.alt,
#respond #submit,
.woocommerce .price_slider_amount .button.button,
.mk-shopping-cart-box .mk-button.checkout,
.widget_shopping_cart .mk-button.checkout,
.widget_shopping_cart .mk-button.checkout
{
	background-color: {$skin_color} !important;
}
.a_accent-bg-hover:hover {
	background-color: {$skin_color};	
}

  ::-webkit-selection
{
    background-color: {$skin_color};
    color:#fff;
}

::-moz-selection
{
    background-color: {$skin_color};
    color:#fff;
}

::selection
{
    background-color: {$skin_color};
    color:#fff;
}

.mk-circle-image .item-holder
{
	-webkit-box-shadow:0 0 0 1px {$skin_color};
	-moz-box-shadow:0 0 0 1px {$skin_color};
	box-shadow:0 0 0 1px {$skin_color};
}



.mk-blockquote.line-style,
.bypostauthor > .mk-single-comment .comment-content,
.bypostauthor > .mk-single-comment .comment-content:after,
.mk-tabs.simple-style .mk-tabs-tabs li.is-active a
{
	border-color: {$skin_color} !important;
}



.news-full-with-image .news-categories span,
.news-half-with-image .news-categories span,
.news-fourth-with-image .news-categories span,
.mk-flex-caption .flex-desc span
{
	box-shadow: 8px 0 0 {$skin_color}, -8px 0 0 {$skin_color};
}



.monocolor.pricing-table .pricing-cols .pricing-col.featured-plan
{
	border:1px solid {$skin_color} !important;
}




.mk-skin-button.three-dimension
{
	box-shadow: 0px 3px 0px 0px {$skin_darker};
}


.mk-skin-button.three-dimension:active
{
	box-shadow: 0px 1px 0px 0px {$skin_darker};
}


");