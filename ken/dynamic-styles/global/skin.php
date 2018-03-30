<?php
global $mk_settings;

Mk_Static_Files::addGlobalStyle("

	.mk-skin-color,
	.blog-categories a,
	.blog-categories,
	.rating-star .rated,
	.widget_testimonials .testimonial-position,
	.testimonial-company,
	.portfolio-similar-meta .cats,
	.entry-meta .cats a,
	.search-meta span a,
	.search-meta span,
	.single-share-trigger:hover,
	.single-share-trigger.mk-toggle-active,
	.project_content_section .project_cats a,
	.mk-love-holder i:hover,
	.blog-comments i:hover,
	.comment-count i:hover,
	.widget_posts_lists li .cats a,
	.mk-employeee-networks li a:hover,
	.mk-tweet-shortcode span a,
	.classic-hover .portfolio-permalink:hover i,
	.mk-pricing-table .mk-icon-star,
	.mk-process-steps.dark-skin .step-icon,
	.mk-edge-next,
	.mk-edge-prev,
	.prev-item-caption,
	.next-item-caption,
	.mk-employees.column_rounded-style .team-member-position, 
	.mk-employees.column-style .team-member-position,
	.mk-event-countdown.accent-skin .countdown-timer,
	.mk-event-countdown.accent-skin .countdown-text,
	.mk-box-text:hover i,
	.mk-process-steps.light-skin .mk-step:hover .step-icon,
	.mk-process-steps.light-skin .active-step-item .step-icon,
	.blog-modern-entry .blog-categories,
	.woocommerce-thanks-text
	{
		color: {$mk_settings['accent-color']};
	}

	.mk-love-holder .item-loved i,
	.widget_posts_lists .cats a,
	#mk-breadcrumbs a:hover,
	.widget_social_networks a.light,
	.widget_posts_tabs .cats a {
		color: {$mk_settings['accent-color']} !important;
	}

	a:hover,
	.mk-tweet-shortcode span a:hover {
		color:{$mk_settings['link-color']['hover']};
	}



	/* Main Skin Color : Background-color Property */
	#wp-calendar td#today,
	div.jp-play-bar,
	.mk-header-button:hover,
	.next-prev-top .go-to-top:hover,
	.wide-eye-portfolio-item .portfolio-meta .the-title,
	.mk-portfolio-carousel .portfolio-meta:before,
	.meta-image.frame-grid-portfolio-item .portfolio-meta .the-title,
	.masonry-border,
	.author-social li a:hover,
	.slideshow-swiper-arrows:hover,
	.mk-clients-shortcode .clients-info,
	.mk-contact-form-wrapper .mk-form-row i.input-focused,
	.mk-login-form .form-row i.input-focused,
	.comment-form-row i.input-focused,
	.widget_social_networks a:hover,
	.mk-social-network a:hover,
	.blog-masonry-entry .post-type-icon:hover,
	.list-posttype-col .post-type-icon:hover,
	.single-type-icon,
	.demo_store,
	.product_loop_button:hover,
	.mk-process-steps.dark-skin .mk-step:hover .step-icon,
	.mk-process-steps.dark-skin .active-step-item .step-icon,
	.mk-process-steps.light-skin .step-icon,
	.mk-social-network a.light:hover,
	.widget_tag_cloud a:hover,
	.widget_categories a:hover,
	.edge-nav-bg,
	.gform_wrapper .button:hover,
	.mk-event-countdown.accent-skin li:before,
	.masonry-border,
	.mk-gallery.thumb-style .gallery-thumb-lightbox:hover,
	.fancybox-close:hover,
	.fancybox-nav span:hover,
	.blog-scroller-arrows:hover,
	ul.user-login li a i,
	.mk-isotop-filter ul li a.current,
	.mk-isotop-filter ul li a:hover
	{
		background-color: {$mk_settings['accent-color']};
	}


	.next-prev-top .go-to-top,
	.mk-contact-form-wrapper .text-input:focus, .mk-contact-form-wrapper .mk-textarea:focus,
	.widget .mk-contact-form-wrapper .text-input:focus, .widget .mk-contact-form-wrapper .mk-textarea:focus,
	.mk-contact-form-wrapper .mk-form-row i.input-focused,
	.comment-form-row .text-input:focus, .comment-textarea textarea:focus,
	.comment-form-row i.input-focused,
	.mk-login-form .form-row i.input-focused,
	.mk-login-form .form-row input:focus,
	.mk-event-countdown.accent-skin li
	{
		border-color: {$mk_settings['accent-color']}!important;
	}


	::-webkit-selection
	{
		background-color: {$mk_settings['accent-color']};
		color:#fff;
	}

	::-moz-selection
	{
		background-color: {$mk_settings['accent-color']};
		color:#fff;
	}

	::selection
	{
		background-color: {$mk_settings['accent-color']};
		color:#fff;
	}

");



if (isset($mk_settings['sub-footer-border-top']) && ($mk_settings['sub-footer-border-top'] == 1)) {
	Mk_Static_Files::addGlobalStyle("
		#sub-footer{
			border-top:1px solid {$mk_settings['accent-color']};
		}
	");
}



if ($mk_settings['header-border-top'] == 1) {
		Mk_Static_Files::addGlobalStyle("
			.theme-main-wrapper:not(.vertical-header) #mk-header,
			.theme-main-wrapper:not(.vertical-header) .mk-secondary-header{

				border-top:1px solid {$mk_settings['accent-color']};
				
			}
		");
}