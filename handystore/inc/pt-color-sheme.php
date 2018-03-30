<?php
// ----- Handy custom color sheme
if ( !function_exists( 'handy_add_inline_styles' ) ) {

	function handy_add_inline_styles() {

		/* Variables */
		$main_text = handy_get_option('primary_text_typography');
		$secondary_text_color = handy_get_option('secondary_text_color');
		$content_headings = handy_get_option('content_headings_typography');
		$sidebar_headings = handy_get_option('sidebar_headings_typography');
		$footer_headings = handy_get_option('footer_headings_typography');
		$footer_text_color = handy_get_option('footer_text_color');
		$link_color = handy_get_option('link_color');
		$link_color_hover = handy_get_option('link_color_hover');
		$main_decor_color = handy_get_option('main_decor_color');
		$button_typography = handy_get_option('button_typography');
		$button_background_color = handy_get_option('button_background_color');
		$button_text_hovered_color = handy_get_option('button_text_hovered_color');
		$main_border_color = handy_get_option('main_border_color');
		$sec_decor_color = handy_get_option('sec_decor_color');

		$out = '<style type="text/css">
				body.custom-color-sheme,
				.custom-color-sheme .post-list .item-content {
					font-size: '. esc_attr($main_text['size']) .';
					font-weight: '. esc_attr($main_text['style']) .';
					color: '. esc_attr($main_text['color']) .';
					font-family: "'. esc_attr($main_text['face']) .'", sans-serif;
				}
				.custom-color-sheme .site-content .entry-meta,
				.custom-color-sheme div.product .product_meta,
				.custom-color-sheme .entry-meta-bottom,
				.custom-color-sheme .comments-area .comment-meta
				.custom-color-sheme .pt-searchform .select2-container.search-select .select2-choice,
				.custom-color-sheme .hgroup-sidebar .widget.widget_shopping_cart .widget_shopping_cart_content,
				.custom-color-sheme .hgroup-sidebar .widget.widget_shopping_cart .excerpt-wrapper,
				.custom-color-sheme .site-header,
				.custom-color-sheme .breadcrumbs-wrapper .breadcrumbs a,
				.custom-color-sheme .breadcrumbs-wrapper .woocommerce-breadcrumb a,
				.custom-color-sheme .woocommerce .checkout .woocommerce-checkout-review-order-table .product-quantity,
				.custom-color-sheme .woocommerce-info,
				.custom-color-sheme .woocommerce td.product-name dl.variation,
				.custom-color-sheme div.product .social-links a,
				.custom-color-sheme .widget_layered_nav ul small.count,
				.custom-color-sheme .widget_pt_categories .pt-categories li .count,
				.custom-color-sheme .woocommerce-result-count,
				.custom-color-sheme #filters-sidebar .dropdown-filters-title,
				.custom-color-sheme .star-rating:before,
				.custom-color-sheme .breadcrumbs-wrapper .single-product-navi a,
				.custom-color-sheme div.product a.compare,
				.custom-color-sheme div.product .yith-wcwl-add-to-wishlist a,
				.custom-color-sheme div.product .woocommerce-review-link,
				.custom-color-sheme div.product .social-links span.sharecount,
				.custom-color-sheme .site-content .entry-additional-meta,
				.custom-color-sheme .site-content .entry-additional-meta a,
				.custom-color-sheme .breadcrumbs-wrapper .breadcrumbs,
				.custom-color-sheme .entry-meta-bottom .social-links a,
				.custom-color-sheme .entry-meta-bottom .social-links span.sharecount,
				.custom-color-sheme .entry-meta-bottom .post-views,
				.custom-color-sheme .entry-meta-bottom .like-wrapper a,
				.custom-color-sheme .post-list .item-content .author,
				.custom-color-sheme .post-list .item-content .date,
				.custom-color-sheme .post-list .item-content .buttons-wrapper,
				.custom-color-sheme .comments-area .comment-meta,
				.custom-color-sheme .post-navigation a,
				.custom-color-sheme .image-navigation a,
				.custom-color-sheme .pt-special p {
				  color: '. esc_attr($secondary_text_color) .';
				}
				.custom-color-sheme button:not(.btn),
				.custom-color-sheme input,
				.custom-color-sheme select,
				.custom-color-sheme textarea {
					color: '. esc_attr($secondary_text_color) .';
				}
				.custom-color-sheme .entry-title,
				.custom-color-sheme .page-title,
				.custom-color-sheme .related > h2,
				.custom-color-sheme .upsells > h2,
				.custom-color-sheme .wcv-related > h2,
				.custom-color-sheme .cart-collaterals .cross-sells .title-wrapper h2,
				.custom-color-sheme.woocommerce .checkout .woocommerce-billing-fields h3,
				.custom-color-sheme div.product .woocommerce-tabs .panel h2:first-of-type,
				.custom-color-sheme #reviews #respond .comment-reply-title,
				.custom-color-sheme .woocommerce .checkout .woocommerce-billing-fields h3,
				.custom-color-sheme #related_posts .related-posts-title,
				.custom-color-sheme .pt-woo-shortcode.with-slider .title-wrapper h3,
				.custom-color-sheme .pt-posts-shortcode.with-slider .title-wrapper h3,
				.custom-color-sheme div.product .product_title,
				.custom-color-sheme .site-content .entry-title a,
				.custom-color-sheme .comments-area .comments-title,
				.custom-color-sheme .comments-area .comment-reply-title {
					font-size: '. esc_attr($content_headings['size']) .';
					font-weight: '. esc_attr($content_headings['style']) .';
					color: '. esc_attr($content_headings['color']) .';
					font-family: "'. esc_attr($content_headings['face']) .'", sans-serif;
				}
				.custom-color-sheme .site-content h1,
				.custom-color-sheme .site-content h2,
				.custom-color-sheme .site-content h3,
				.custom-color-sheme .site-content h4,
				.custom-color-sheme .site-content h5,
				.custom-color-sheme .site-content h6 {
					color: '. esc_attr($content_headings['color']) .';
					font-family: "'. esc_attr($content_headings['face']) .'", sans-serif;
				}
				.custom-color-sheme .pt-woo-shortcode.with-slider .title-wrapper h3,
				.custom-color-sheme .pt-posts-shortcode.with-slider .title-wrapper h3 {
					border-color: '. esc_attr($content_headings['color']) .';
				}
				.custom-color-sheme .widget-title,
				.custom-color-sheme .widget.woocommerce .widget-title {
					font-size: '. esc_attr($sidebar_headings['size']) .';
					font-weight: '. esc_attr($sidebar_headings['style']) .';
					color: '. esc_attr($sidebar_headings['color']) .';
					font-family: "'. esc_attr($sidebar_headings['face']) .'", sans-serif;
				}
				.custom-color-sheme .site-footer .widget-title {
					font-size: '. esc_attr($footer_headings['size']) .';
					font-weight: '. esc_attr($footer_headings['style']) .';
					color: '. esc_attr($footer_headings['color']) .';
					font-family: "'. esc_attr($footer_headings['face']) .'", sans-serif;
				}
				.custom-color-sheme .site-footer,
				.custom-color-sheme .site-footer a {
					color: '. esc_attr($footer_text_color) .';
				}
				.custom-color-sheme a,
				.custom-color-sheme .site-content .entry-meta .entry-date,
				.custom-color-sheme .comments-area .comment-meta .comment-author-link,
				.custom-color-sheme .comments-area .comment-meta .author {
				  color: '. esc_attr($link_color) .';
 				}
				.custom-color-sheme a:hover,
				.custom-color-sheme a:active,
				.custom-color-sheme .breadcrumbs-wrapper .breadcrumbs a:hover,
				.custom-color-sheme .breadcrumbs-wrapper .woocommerce-breadcrumb a:hover,
				.custom-color-sheme .breadcrumbs-wrapper .breadcrumbs a:active,
				.custom-color-sheme .breadcrumbs-wrapper .woocommerce-breadcrumb a:active,
				.custom-color-sheme li.product .product-description-wrapper a:not(.button):hover,
				.custom-color-sheme li.product .product-description-wrapper a:not(.button):focus,
				.custom-color-sheme li.product .product-description-wrapper a:not(.button):active,
				.custom-color-sheme .select2-results .select2-highlighted .select2-result-label,
				.custom-color-sheme .select2-results li:hover .select2-result-label,
				.custom-color-sheme .select2-results li:hover .select2-result-sub li:hover .select2-result-label,
				.custom-color-sheme .site-main .select2-container .select2-choice:hover,
				.custom-color-sheme .site-main .select2-container .select2-choice:focus,
				.custom-color-sheme .site-main .select2-container .select2-choice:active,
				.custom-color-sheme .breadcrumbs-wrapper .single-product-navi a:hover,
				.custom-color-sheme .breadcrumbs-wrapper .single-product-navi a:focus,
				.custom-color-sheme .breadcrumbs-wrapper .single-product-navi a:active,
				.custom-color-sheme div.product a.compare:hover,
				.custom-color-sheme div.product .yith-wcwl-add-to-wishlist a:hover,
				.custom-color-sheme div.product .woocommerce-review-link:hover,
				.custom-color-sheme div.product .woocommerce-review-link:active,
				.custom-color-sheme div.product .woocommerce-review-link:focus,
				.custom-color-sheme .site-content .entry-title a:hover,
				.custom-color-sheme .page-links a:hover span,
				.custom-color-sheme .page-links a:focus span,
				.custom-color-sheme .page-links a:active span,
				.custom-color-sheme .comments-area .comment-meta .comment-author-link:hover,
				.custom-color-sheme .post-navigation a:hover,
				.custom-color-sheme .image-navigation a:hover,
				.custom-color-sheme .site-content a:hover,
				.custom-color-sheme .site-content a:focus,
				.custom-color-sheme .site-content a:active {
				  color: '. esc_attr($link_color_hover) .';
				}
				.custom-color-sheme button:not(.btn),
				.custom-color-sheme .button,
				.custom-color-sheme input[type="button"],
				.custom-color-sheme input[type="reset"],
				.custom-color-sheme input[type="submit"],
				.custom-color-sheme table.shop_table.cart td.actions .button,
				.custom-color-sheme div.product .special-buttons-wrapper .compare,
				.custom-color-sheme div.product .special-buttons-wrapper .yith-wcwl-add-to-wishlist a,
				.custom-color-sheme .figure.banner-with-effects.with-button.default-button a,
				.custom-color-sheme div.product .single_add_to_cart_button {
					font-size: '. esc_attr($button_typography['size']) .';
					font-weight: '. esc_attr($button_typography['style']) .';
					color: '. esc_attr($button_typography['color']) .';
					font-family: "'. esc_attr($button_typography['face']) .'", sans-serif;
					background-color: '. esc_attr($button_background_color) .';
				}
				.custom-color-sheme button:hover,
				.custom-color-sheme .button:hover,
				.custom-color-sheme input[type="button"]:hover,
				.custom-color-sheme input[type="reset"]:hover,
				.custom-color-sheme input[type="submit"]:hover,
				.custom-color-sheme table.shop_table.cart td.actions .button:hover,
				.custom-color-sheme div.product .special-buttons-wrapper .compare:hover,
				.custom-color-sheme div.product .special-buttons-wrapper .yith-wcwl-add-to-wishlist a:hover,
				.custom-color-sheme button:active,
				.custom-color-sheme .button:active,
				.custom-color-sheme div.product .special-buttons-wrapper .compare:active,
				.custom-color-sheme div.product .special-buttons-wrapper .yith-wcwl-add-to-wishlist a:active,
				.custom-color-sheme input[type="button"]:active,
				.custom-color-sheme input[type="reset"]:active,
				.custom-color-sheme input[type="submit"]:active,
				.custom-color-sheme table.shop_table.cart td.actions .button:active,
				.custom-color-sheme .figure.banner-with-effects.with-button.default-button a:hover,
				.custom-color-sheme .figure.banner-with-effects.with-button.default-button a:active,
				.custom-color-sheme div.product .single_add_to_cart_button:hover,
				.custom-color-sheme div.product .single_add_to_cart_button:focus,
				.custom-color-sheme div.product .single_add_to_cart_button:active {
					color: '. esc_attr($button_text_hovered_color) .';
					background-color: '. esc_attr($main_decor_color) .';
				}
				.custom-color-sheme div.product .special-buttons-wrapper .yith-wcwl-add-to-wishlist a::after,
				.custom-color-sheme div.product .special-buttons-wrapper .compare::after,
				.custom-color-sheme div.product .single_add_to_cart_button::after,
				.custom-color-sheme .footer-info-block .icon,
				.custom-color-sheme .entry-meta-bottom .social-links a:hover,
				.custom-color-sheme .entry-meta-bottom .like-wrapper a:hover,
				.custom-color-sheme .panel-heading:hover a:after,
				.custom-color-sheme blockquote:before,
				.custom-color-sheme blockquote:after,
				.custom-color-sheme q:before,
				.custom-color-sheme q:after,
				.custom-color-sheme .pt-testimonials span {
					color: '. esc_attr($main_decor_color) .';
				}
				.custom-color-sheme div.product .special-buttons-wrapper .yith-wcwl-add-to-wishlist a:hover::after,
				.custom-color-sheme div.product .special-buttons-wrapper .compare:hover::after,
				.custom-color-sheme div.product .single_add_to_cart_button:hover:after {
					color: '. esc_attr($button_text_hovered_color) .';
				}
				.custom-color-sheme li.product .product-description-wrapper .button.add_to_cart_button,
				.custom-color-sheme li.product .product-description-wrapper .button.product_type_variable,
				.custom-color-sheme li.product .product-description-wrapper .button.product_type_simple,
				.custom-color-sheme li.product .product-description-wrapper .outofstock .button,
				.custom-color-sheme li.product .product-description-wrapper .button.product_type_external,
				.custom-color-sheme li.product.list-view .product-description-wrapper .single_variation_wrap .button,
				.custom-color-sheme .site-main .owl-theme .owl-controls .owl-page span,
				.custom-color-sheme li.product .inner-product-content.fade-hover .additional-buttons .compare,
				.custom-color-sheme li.product .inner-product-content.fade-hover .additional-buttons .yith-wcwl-add-to-wishlist a,
				.custom-color-sheme li.product .inner-product-content.fade-hover .additional-buttons .yith-wcwl-wishlistexistsbrowse a,
				.custom-color-sheme li.product .inner-product-content.fade-hover .additional-buttons .yith-wcwl-wishlistaddedbrowse a,
				.custom-color-sheme li.product .inner-product-content.fade-hover .additional-buttons .compare.added,
				.custom-color-sheme .more-link i,
				.custom-color-sheme .panel-title a:after,
				.custom-color-sheme .panel-heading:hover a,
				.custom-color-sheme .tabbable .nav-tabs li a:before,
				.custom-color-sheme .pt-special:hover .icon,
				.custom-color-sheme .pt-testimonials .title-wrapper span:hover,
				.custom-color-sheme .pt-testimonials .title-wrapper span:focus {
					background-color: '. esc_attr($main_decor_color) .';
				}
				.custom-color-sheme div.product span.onsale,
				.custom-color-sheme mark, .custom-color-sheme ins,
				.custom-color-sheme .wp-caption,
				.custom-color-sheme li.product span.onsale,
				.custom-color-sheme .widget_pt_categories .pt-categories li .show-children:hover,
				.custom-color-sheme .hgroup-sidebar .widget.widget_shopping_cart .count,
				.custom-color-sheme .site-main .owl-theme .owl-controls .owl-buttons div,
				.custom-color-sheme .post-list .item-content:hover .link-to-post a,
				.custom-color-sheme .pt-sales-carousel ul.products h4:before,
				.custom-color-sheme .pt-sales-carousel ul.products .sale-value,
				.custom-color-sheme .pt-sales-carousel span.prev:hover,
				.custom-color-sheme .pt-sales-carousel span.prev:focus,
				.custom-color-sheme .pt-sales-carousel span.next:hover,
				.custom-color-sheme .pt-sales-carousel span.next:focus,
				.custom-color-sheme .pt-carousel figcaption a:hover,
				.custom-color-sheme .pt-carousel figcaption a:focus,
				.custom-color-sheme .pt-carousel figcaption a:active {
					background-color: '. esc_attr($main_decor_color) .';
				}
				.custom-color-sheme .star-rating span::before,
				.custom-color-sheme ins,
				.custom-color-sheme div.product .social-links a:hover,
				.custom-color-sheme div.product .social-links a:active,
				.custom-color-sheme li.product .additional-buttons .compare:hover::after,
				.custom-color-sheme li.product .additional-buttons .compare.added:hover::after,
				.custom-color-sheme li.product .additional-buttons .yith-wcwl-add-to-wishlist a:hover::after,
				.custom-color-sheme li.product .additional-buttons .yith-wcwl-wishlistaddedbrowse a:hover::after,
				.custom-color-sheme li.product .additional-buttons .yith-wcwl-wishlistexistsbrowse a:hover::after,
				.custom-color-sheme li.product .additional-buttons .jckqvBtn:hover i,
				.custom-color-sheme p.stars a:hover::after,
				.custom-color-sheme p.stars a.active::after,
				.custom-color-sheme p.stars a:hover ~ a::after,
				.custom-color-sheme p.stars a.active ~ a::after,
				.custom-color-sheme .site-content .entry-additional-meta .post-comments i,
				.custom-color-sheme .site-content .entry-additional-meta .likes-counter i,
				.custom-color-sheme .recent-post-list .recent-post-item i,
				.custom-color-sheme .recent-post-list .most-viewed-item i,
				.custom-color-sheme .most-viewed-list .recent-post-item i,
				.custom-color-sheme .most-viewed-list .most-viewed-item i,
				.custom-color-sheme .entry-meta-bottom .social-links a:hover,
				.custom-color-sheme .entry-meta-bottom .social-links a:active,
				.custom-color-sheme .entry-meta-bottom .like-wrapper a:hover,
				.custom-color-sheme .entry-meta-bottom .like-wrapper a:active,
				.custom-color-sheme .hgroup-sidebar .widget.widget_shopping_cart .heading,
				.custom-color-sheme .widget.widget_shopping_cart .total .amount,
				.custom-color-sheme .icon-with-description i,
				.custom-color-sheme .site-footer .widget ul li::before,
				.custom-color-sheme .widget_pt_categories .pt-categories li .show-children span:before,
				.custom-color-sheme a.button:hover,
				.custom-color-sheme .pt-sales-carousel span.prev::before,
				.custom-color-sheme .pt-sales-carousel span.next::before,
				.custom-color-sheme .pt-testimonials .title-wrapper span:before,
				.custom-color-sheme .pt-member-contact span {
					color: '. esc_attr($main_decor_color) .';
				}
				.custom-color-sheme li.product span.onsale::before {
					border-bottom: 14px solid '. esc_attr($main_decor_color) .';
			    border-top: 14px solid '. esc_attr($main_decor_color) .';
				}
				.custom-color-sheme .pagination .page-numbers.current,
				.custom-color-sheme .site-footer .widget button,
				.custom-color-sheme .site-footer .widget .button,
				.custom-color-sheme .site-footer .widget input[type="button"],
				.custom-color-sheme .site-footer .widget input[type="reset"],
				.custom-color-sheme .site-footer .widget input[type="submit"],
				.custom-color-sheme .woocommerce-pagination a:hover,
				.custom-color-sheme .woocommerce-pagination a:active,
				.custom-color-sheme .woocommerce-pagination a:focus,
				.custom-color-sheme .comment-numeric-navigation a:hover,
				.custom-color-sheme .comment-numeric-navigation a:active,
				.custom-color-sheme .comment-numeric-navigation a:focus,
				.custom-color-sheme .woocommerce a.button {
					background-color: '. esc_attr($main_decor_color) .';
					border-color: '. esc_attr($main_decor_color) .';
				}
				.custom-color-sheme .slider-navi span:hover,
				.custom-color-sheme .slider-navi span:active,
				.custom-color-sheme .pt-sales-carousel span.prev,
				.custom-color-sheme .pt-sales-carousel span.next,
				.custom-color-sheme .pt-testimonials .title-wrapper span {
					color: '. esc_attr($main_decor_color) .';
					border-color: '. esc_attr($main_decor_color) .';
				}
				.custom-color-sheme .pagination a:hover,
				.custom-color-sheme .pagination a:active,
				.custom-color-sheme .pagination a:focus,
				.custom-color-sheme .site-content .entry-additional-meta .link-to-post,
				.custom-color-sheme .widget_pt_categories .pt-categories li .show-children,
				.custom-color-sheme.woocommerce .add_to_cart_button:hover,
				.custom-color-sheme.woocommerce .button.product_type_variable:hover,
				.custom-color-sheme.woocommerce .product_type_simple:hover,
				.custom-color-sheme.woocommerce .outofstock .button:hover,
				.custom-color-sheme .pt-view-switcher span.active,
				.custom-color-sheme .to-top {
					border-color: '. esc_attr($main_decor_color) .';
					color: '. esc_attr($main_decor_color) .';
				}
				.custom-color-sheme .widget_tag_cloud a,
				.custom-color-sheme .footer-info-block .border,
				.custom-color-sheme .figure.banner-with-effects.with-button.default-button a,
				.custom-color-sheme.woocommerce .add_to_cart_button,
				.custom-color-sheme.woocommerce .button.product_type_variable,
				.custom-color-sheme.woocommerce .product_type_simple,
				.custom-color-sheme.woocommerce .outofstock .button,
				.custom-color-sheme .pt-view-switcher span:hover,
				.custom-color-sheme .pt-view-switcher span:focus,
				.custom-color-sheme .pt-view-switcher span.active,
				.custom-color-sheme .widget_pt_categories .pt-categories li .show-children,
				.custom-color-sheme .format-quote blockquote,
				.custom-color-sheme .wpcf7 .wpcf7-submit {
					border-color: '. esc_attr($main_decor_color) .';
				}
				.custom-color-sheme .widget_tag_cloud a:hover,
				.custom-color-sheme .widget_tag_cloud a:active,
				.custom-color-sheme .widget_pt_categories .pt-categories li .show-children:hover,
				.custom-color-sheme .widget_pt_categories .pt-categories li .show-children:active,
				.custom-color-sheme .to-top:hover {
					background-color: '. esc_attr($main_decor_color) .';
					color: '. esc_attr($button_text_hovered_color) .';
				}
				.custom-color-sheme .widget,
				.custom-color-sheme .post-list .post {
					border-color: '. esc_attr($main_border_color) .';
				}
				.custom-color-sheme li.product .product-description-wrapper .price,
				.custom-color-sheme li.product .product-description-wrapper .price ins,
				.custom-color-sheme .widget.woocommerce .product_list_widget li .price,
				.custom-color-sheme .widget_pt_vendor_products_widget .product_list_widget li .price,
				.custom-color-sheme div.product span.price,
				.custom-color-sheme div.product p.price {
					color: '. esc_attr($sec_decor_color) .';
				}
				.custom-color-sheme li.product span.custom-badge {
					background-color: '. esc_attr($sec_decor_color) .';
				}
				</style>';
		echo $out;
	}
}

function handy_color_sheme_body_class( $classes ) {
	$classes[] = 'custom-color-sheme';
	return $classes;
}
add_filter( 'body_class', 'handy_color_sheme_body_class' );
add_action( 'wp_head', 'handy_add_inline_styles' );
