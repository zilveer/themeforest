<?php
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version 	1.2.2
 * 
 * Theme Secondary Color Schemes Rules
 * Created by CMSMasters
 * 
 */


function cmsms_theme_colors_secondary() {
	$cmsms_option = cmsms_get_global_options();
	
	
	$cmsms_color_schemes = cmsms_color_schemes_list();
	
	
	unset($cmsms_color_schemes['header']);
	
	unset($cmsms_color_schemes['header_top']);
	
	
	$custom_css = "/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version 	1.2.1
 * 
 * Theme Secondary Color Schemes Rules
 * Created by CMSMasters
 * 
 */

";
	
	
	foreach ($cmsms_color_schemes as $scheme => $title) {
		$rule = (($scheme != 'default') ? "html .cmsms_color_scheme_{$scheme} " : '');
		
		
		if (class_exists('woocommerce')) {
			$custom_css .= "
/***************** Start {$title} WooCommerce Color Scheme Rules ******************/

	/* Start Main Content Font Color */
	{$rule}.cmsms_products .product .product_outer .product_inner .cmsms_product_cat, 
	{$rule}.cmsms_products .product .product_outer .product_inner .cmsms_product_cat a, 
	{$rule}.cmsms_products .product .product_outer .product_inner .cmsms_product_info .price del, 
	{$rule}.cmsms_products .product .product_outer .product_inner .cmsms_product_footer > a, 
	{$rule}.cmsms_single_product .cmsms_product_right_column .price del, 
	{$rule}#order_review .shop_table td.product-name, 
	{$rule}#order_review .shop_table td.product-name *, 
	{$rule}.shop_table.order_details td.product-name, 
	{$rule}.shop_table.order_details td.product-name *, 
	{$rule}.cmsms_dynamic_cart .cmsms_dynamic_cart_button, 
	{$rule}.widget_shopping_cart_content .cart_list li .quantity, 
	{$rule}.product_list_widget li del .amount, 
	{$rule}.quantity .text {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_color']) . "
	}
	/* Finish Main Content Font Color */
	
	
	/* Start Primary Color */
	{$rule}.cmsms_products .product .product_outer .product_inner .cmsms_product_cat a:hover, 
	{$rule}.cmsms_products .product .product_outer .product_inner .cmsms_product_info .price, 
	{$rule}.cmsms_products .product .product_outer .product_inner .cmsms_product_footer > a:hover, 
	{$rule}.cmsms_products .product .product_outer .product_inner .cmsms_product_footer > a:hover:before, 
	{$rule}.cmsms_products .product .product_outer .product_inner .cmsms_product_footer > a.cmsms_add_to_cart_button.loading, 
	{$rule}.cmsms_products .product .product_outer .product_inner .cmsms_product_footer > a.cmsms_add_to_cart_button.loading:before, 
	{$rule}.cmsms_single_product .cmsms_product_right_column .price, 
	{$rule}.required, 
	{$rule}.shop_table .product-name a:hover, 
	{$rule}.shop_table td.product-subtotal, 
	{$rule}.cart_totals table tr.cart-subtotal td, 
	{$rule}.cart_totals table tr.order-total td, 
	{$rule}#order_review .shop_table tr.order-total th, 
	{$rule}#order_review .shop_table tr.order-total td, 
	{$rule}.shop_table.order_details td.product-name a:hover, 
	{$rule}.shop_table.order_details tfoot tr:last-child th, 
	{$rule}.shop_table.order_details tfoot tr:last-child td, 
	{$rule}.cmsms_dynamic_cart .cmsms_dynamic_cart_button:hover, 
	{$rule}.cmsms_dynamic_cart:hover .cmsms_dynamic_cart_button, 
	{$rule}.widget_shopping_cart_content .cart_list li a:hover, 
	{$rule}.widget_shopping_cart_content .cart_list li .quantity .amount, 
	{$rule}.widget_shopping_cart_content .total .amount, 
	{$rule}.product_list_widget li > a:hover, 
	{$rule}.product_list_widget li .amount {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_link']) . "
	}
	
	{$rule}.onsale {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_link']) . "
	}
	/* Finish Primary Color */
	
	
	/* Start Highlight Color */
	{$rule}.input-checkbox + label:after, 
	{$rule}.input-radio + label:after, 
	{$rule}.shipping_method + label:after {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_hover']) . "
	}
	/* Finish Highlight Color */
	
	
	/* Start Headings Color */
	{$rule}.cmsms_single_product .cmsms_product_right_column .product_meta strong, 
	{$rule}.cmsms_single_product .cmsms_woo_tabs .shop_attributes th, 
	{$rule}.shop_table thead th, 
	{$rule}.shop_table td.product-remove .remove, 
	{$rule}.shop_table td.product-name, 
	{$rule}.shop_table td.product-name a, 
	{$rule}.cart_totals table tr.cart-subtotal th, 
	{$rule}.cart_totals table tr.order-total th, 
	{$rule}#order_review .shop_table tr.cart-subtotal th, 
	{$rule}#order_review .shop_table tr.cart-subtotal td, 
	{$rule}ul.order_details li > span, 
	{$rule}.shop_table.order_details tfoot tr:first-child th, 
	{$rule}.shop_table.order_details tfoot tr:first-child td, 
	{$rule}.widget_shopping_cart_content .cart_list li a, 
	{$rule}.widget_shopping_cart_content .total strong, 
	{$rule}.cmsms_added_product_info .cmsms_added_product_info_text, 
	{$rule}.product_list_widget li > a {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_heading']) . "
	}
	
	{$rule}.out-of-stock {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_heading']) . "
	}
	
	{$rule}.cmsms_single_product .cmsms_product_images .cmsms_product_thumbs .cmsms_product_thumb:hover {
		" . cmsms_color_css('border-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_heading']) . "
	}
	/* Finish Headings Color */
	
	
	/* Start Main Background Color */
	{$rule}.onsale, 
	{$rule}.out-of-stock {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.quantity .text, 
	{$rule}.woocommerce-message, 
	{$rule}.woocommerce-info, 
	{$rule}#order_review #payment, 
	{$rule}.cmsms_dynamic_cart .widget_shopping_cart_content, 
	{$rule}.cmsms_added_product_info, 
	{$rule}.widget_price_filter .price_slider_wrapper .price_slider {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.cmsms_dynamic_cart .widget_shopping_cart_content:after, 
	{$rule}.cmsms_added_product_info:after {
		" . cmsms_color_css('border-' . (is_rtl() ? 'right' : 'left') . '-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_bg']) . "
	}
	/* Finish Main Background Color */
	
	
	/* Start Alternate Background Color */
	{$rule}.cmsms_products .product .product_outer .product_inner .cmsms_product_footer > a:hover, 
	{$rule}.shop_table thead th, 
	{$rule}.shop_table td.product-remove .remove, 
	{$rule}.shop_table td.actions, 
	{$rule}.cart_totals table tr.cart-subtotal th, 
	{$rule}.cart_totals table tr.cart-subtotal td, 
	{$rule}.cart_totals table tr.order-total th, 
	{$rule}.cart_totals table tr.order-total td, 
	{$rule}.input-checkbox + label:before,
	{$rule}.input-radio + label:before, 
	{$rule}.shipping_method + label:before, 
	{$rule}#order_review .shop_table tr.cart-subtotal th, 
	{$rule}#order_review .shop_table tr.cart-subtotal td, 
	{$rule}#order_review .shop_table tr.order-total th, 
	{$rule}#order_review .shop_table tr.order-total td, 
	{$rule}#order_review #payment .payment_methods .payment_box, 
	{$rule}ul.order_details li > span, 
	{$rule}.shop_table.order_details tfoot tr:first-child th, 
	{$rule}.shop_table.order_details tfoot tr:last-child th, 
	{$rule}.shop_table.order_details tfoot tr:first-child td, 
	{$rule}.shop_table.order_details tfoot tr:last-child td, 
	{$rule}.cmsms_dynamic_cart .cmsms_dynamic_cart_button, 
	{$rule}.widget_price_filter .price_slider_wrapper .price_slider .ui-slider-range {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_alternate']) . "
	}
	
	{$rule}#order_review #payment .payment_methods .payment_box:after {
		" . cmsms_color_css('border-bottom-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_alternate']) . "
	}
	/* Finish Alternate Background Color */
	
	
	/* Start Borders Color */
	{$rule}.cmsms_star_rating .cmsms_star, 
	{$rule}.comment-form-rating .stars > span, 
	{$rule}.comment-form-rating .stars > span a:hover, 
	{$rule}.comment-form-rating .stars > span a.active, 
	{$rule}.cmsms_products .product .product_outer .product_inner .cmsms_product_footer > a:before {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
	}
	
	{$rule}.widget_price_filter .price_slider_wrapper .price_slider .ui-slider-handle {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
	}
	
	{$rule}.cmsms_products .product .product_outer .product_inner, 
	{$rule}.cmsms_products .product .product_outer .product_inner .cmsms_product_footer, 
	{$rule}.cmsms_products .product .product_outer .product_inner .cmsms_product_footer > a.cmsms_add_to_cart_button + .cmsms_details_button, 	
	{$rule}.cmsms_products .product .product_outer .product_inner .cmsms_product_footer > a.added_to_cart + .cmsms_details_button, 
	{$rule}.cmsms_single_product .cmsms_product_images .cmsms_product_image, 
	{$rule}.cmsms_single_product .cmsms_product_images .cmsms_product_thumbs .cmsms_product_thumb, 
	{$rule}.cmsms_single_product .cmsms_woo_tabs .shop_attributes th, 
	{$rule}.cmsms_single_product .cmsms_woo_tabs .shop_attributes td, 
	{$rule}.cmsms_single_product .cmsms_woo_tabs #reviews #comments .commentlist, 
	{$rule}.cmsms_single_product .cmsms_woo_tabs #reviews #comments .commentlist .comment .comment_container .comment-text, 
	{$rule}.woocommerce-message, 
	{$rule}.woocommerce-info, 
	{$rule}.shop_table, 
	{$rule}.shop_table th, 
	{$rule}.shop_table td, 
	{$rule}.shop_table td.product-remove .remove, 
	{$rule}.shop_table td.product-thumbnail img, 
	{$rule}.cart_totals table, 
	{$rule}.cart_totals table tr th, 
	{$rule}.cart_totals table tr td, 
	{$rule}.input-checkbox + label:before,
	{$rule}.input-radio + label:before, 
	{$rule}.shipping_method + label:before, 
	{$rule}#order_review #payment, 
	{$rule}#order_review #payment .payment_methods .payment_box, 
	{$rule}ul.order_details, 
	{$rule}ul.order_details li, 
	{$rule}ul.order_details li > span, 
	{$rule}.cmsms_dynamic_cart .cmsms_dynamic_cart_button, 
	{$rule}.cmsms_dynamic_cart .widget_shopping_cart_content, 
	{$rule}.cmsms_added_product_info, 
	{$rule}.widget_shopping_cart_content .cart_list li, 
	{$rule}.cmsms_added_product_info .cmsms_added_product_info_img, 
	{$rule}.widget_price_filter .price_slider_wrapper .price_slider, 
	{$rule}.product_list_widget li, 
	{$rule}.product_list_widget li img, 
	{$rule}.quantity .text {
		" . cmsms_color_css('border-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
	}
	
	{$rule}#order_review #payment .payment_methods .payment_box:before {
		" . cmsms_color_css('border-bottom-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
	}
	
	{$rule}.cmsms_dynamic_cart .widget_shopping_cart_content:before, 
	{$rule}.cmsms_added_product_info:before {
		" . cmsms_color_css('border-' . (is_rtl() ? 'right' : 'left') . '-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
	}
	/* Finish Borders Color */

/***************** Finish {$title} WooCommerce Color Scheme Rules ******************/


";
		}


		if (class_exists('Tribe__Events__Main')) {
			$custom_css .= "
/***************** Start {$title} Events Color Scheme Rules ******************/

	/* Start Main Content Font Color */ 
	{$rule}#tribe-events-bar #tribe-bar-views .tribe-bar-views-inner ul.tribe-bar-views-list li.tribe-bar-views-option a, 
	{$rule}#tribe-events-content.tribe-events-single .cmsms_single_event_header .cmsms_single_event_header_left .tribe-events-schedule > h6.tribe-events-cost, 
	{$rule}.recurringinfo, 
	{$rule}.tribe-events-countdown-widget .tribe-countdown-time .tribe-countdown-timer .tribe-countdown-number .tribe-countdown-under, 
	{$rule}.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-grid-wrapper .tribe-mini-calendar tbody td.tribe-events-has-events div, 
	{$rule}.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-grid-wrapper .tribe-mini-calendar tbody td.tribe-events-has-events * {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_color']) . "
	}
	
	{$rule}#tribe-events-bar #tribe-bar-views .tribe-bar-views-inner label.button .cmsms_next_arrow {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_color']) . "
	}
	
	{$rule}#tribe-events-bar #tribe-bar-views .tribe-bar-views-inner label.button .cmsms_next_arrow:before, 
	{$rule}#tribe-events-bar #tribe-bar-views .tribe-bar-views-inner label.button .cmsms_next_arrow:after {
		" . cmsms_color_css('border-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_color']) . "
	}
	/* Finish Main Content Font Color */
	
	
	/* Start Primary Color */
	{$rule}#tribe-events-content.tribe-events-single .cmsms_single_event_header .cmsms_single_event_header_left .tribe-events-schedule > h6, 
	{$rule}#tribe-events-content.tribe-events-single .cmsms_single_event_header .cmsms_single_event_header_right .tribe-events-cal-links a:hover, 
	{$rule}#tribe-events-content.tribe-events-month table.tribe-events-calendar tbody td div[id*=\"tribe-events-daynum-\"] a:hover, 
	{$rule}.tribe-events-tooltip .entry-title, 
	{$rule}#tribe-events-footer > a:hover, 
	{$rule}#tribe-events-content.tribe-events-list .vevent .cmsms_events_list_event_wrap .cmsms_events_list_event_header .tribe-events-event-cost, 
	{$rule}#tribe-events-content.tribe-events-list .vevent .cmsms_events_list_event_wrap .tribe-events-event-meta .time-details, 
	{$rule}.recurringinfo a:hover, 
	{$rule}#tribe-events-content.tribe-events-list .vevent .cmsms_events_list_event_wrap .tribe-events-event-meta .tribe-events-venue-details a:hover, 
	{$rule}ul.tribe-related-events > li .tribe-related-events-thumbnail .cmsms_events_img_placeholder:hover, 
	{$rule}.tribe-events-venue .cmsms_events_venue_header .cmsms_events_venue_header_right a:hover, 
	{$rule}.tribe-events-organizer .cmsms_events_organizer_header .cmsms_events_organizer_header_right a:hover, 
	{$rule}#tribe-events-content.tribe-events-photo #tribe-events-photo-events .tribe-events-photo-event .tribe-events-photo-event-wrap .tribe-events-event-details .tribe-events-event-meta .time-details, 
	{$rule}#tribe-mobile-container .tribe-mobile-day .tribe-events-mobile .tribe-events-event-body .time-details, 
	{$rule}.tribe-events-countdown-widget .tribe-countdown-text a:hover, 
	{$rule}.tribe-events-venue-widget .tribe-venue-widget-wrapper .tribe-venue-widget-venue .tribe-venue-widget-venue-name a:hover, 
	{$rule}.widget .vevent .entry-title a:hover, 
	{$rule}.widget.tribe-events-list-widget .tribe-event-title a:hover, 
	{$rule}.widget .vevent .cmsms_widget_event_info, 
	{$rule}.widget.tribe-this-week-events-widget .duration, 
	{$rule}.widget .tribe-events-widget-link a:hover, 
	{$rule}.widget.tribe-events-list-widget .tribe-event-duration, 
	{$rule}.widget.tribe-this-week-events-widget .tribe-events-viewmore a:hover, 
	{$rule}.widget .vevent .cmsms_widget_event_venue_info_loc .cmsms_widget_event_venue_info a:hover, 
	{$rule}.widget .vevent .cmsms_widget_event_venue_info_loc .cmsms_widget_event_venue_loc a, 
	{$rule}.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-grid-wrapper .tribe-mini-calendar tbody td.tribe-events-has-events:hover *, 
	{$rule}.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-list-wrapper .tribe-events-loop .vevent .tribe-mini-calendar-event .list-info, 
	{$rule}.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-list-wrapper .tribe-events-loop .vevent .tribe-mini-calendar-event .list-info .tribe-mini-calendar-event-venue a:hover {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_link']) . "
	}
	
	{$rule}#tribe-events-content.tribe-events-week-grid .tribe-events-grid .tribe-week-event:hover > div:first-child, 
	{$rule}#tribe-events-bar #tribe-bar-views .tribe-bar-views-inner ul.tribe-bar-views-list li.tribe-bar-views-option a:hover, 
	{$rule}#tribe-events-bar #tribe-bar-views .tribe-bar-views-inner ul.tribe-bar-views-list li.tribe-bar-views-option.tribe-bar-active a, 
	{$rule}#tribe-events-bar #tribe-bar-views.tribe-bar-views-open .tribe-bar-views-inner label.button {
		" . cmsms_color_css('border-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_link']) . "
	}
	
	{$rule}.tribe-bar-views-open label.button, 
	{$rule}#tribe-events-bar #tribe-bar-views .tribe-bar-views-inner ul.tribe-bar-views-list li.tribe-bar-views-option a:hover, 
	{$rule}#tribe-events-bar #tribe-bar-views .tribe-bar-views-inner ul.tribe-bar-views-list li.tribe-bar-views-option.tribe-bar-active a, 
	{$rule}#tribe-events-content.tribe-events-month table.tribe-events-calendar tbody td.tribe-events-present div[id*=\"tribe-events-daynum-\"], 
	{$rule}#tribe-events-content.tribe-events-week-grid .tribe-events-grid .tribe-grid-header .tribe-grid-content-wrap .column a:hover, 
	{$rule}#tribe-events-content.tribe-events-week-grid .tribe-events-grid .tribe-week-event:hover > div:first-child, 
	{$rule}.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-grid-wrapper .tribe-mini-calendar th.tribe-mini-calendar-dayofweek, 
	{$rule}.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-grid-wrapper .tribe-mini-calendar tbody td.tribe-events-has-events div .tribe-mini-calendar-day-link:before, 
	{$rule}.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-grid-wrapper .tribe-mini-calendar tbody td.tribe-events-present, 
	{$rule}.widget .list-date span.list-daynumber, 
	{$rule}.tribe-this-week-events-widget .this-week-today .tribe-this-week-widget-header-date,
	{$rule}.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-grid-wrapper .tribe-mini-calendar .tribe-mini-calendar-nav div .tribe-mini-calendar-nav-link:hover {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_link']) . "
	}
	
	@media only screen and (max-width: 767px) {
		{$rule}#main #tribe-events-content.tribe-events-month table.tribe-events-calendar tbody td.tribe-events-thismonth:hover * {
			" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_link']) . "
		}
		
		{$rule}#main #tribe-events-content.tribe-events-month table.tribe-events-calendar tbody td.tribe-events-thismonth.tribe-events-present {
			" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_link']) . "
		}
	}
	/* Finish Primary Color */
	
	
	/* Start Highlight Color */
	
	@media only screen and (max-width: 767px) {
		{$rule}#main #tribe-events-content.tribe-events-month table.tribe-events-calendar tbody td.tribe-events-has-events:before {
			" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_hover']) . "
		}
	}
	/* Finish Highlight Color */
	
	
	/* Start Headings Color */
	{$rule}#tribe-events-content.tribe-events-single .cmsms_single_event_header .cmsms_single_event_header_right .tribe-events-cal-links a, 
	{$rule}#tribe-events-content.tribe-events-single .cmsms_single_event_meta .tribe-events-meta-group .cmsms_event_meta_info .cmsms_event_meta_info_item .cmsms_event_meta_info_item_title, 
	{$rule}#tribe-events-content.tribe-events-single .cmsms_single_event_meta .tribe-events-meta-group .cmsms_event_meta_info .cmsms_event_meta_info_item dt, 
	{$rule}#tribe-events-bar .tribe-bar-filters .tribe-bar-filters-inner .tribe-bar-date-filter .label-tribe-bar-date, 
	{$rule}#tribe-events-bar .tribe-bar-filters .tribe-bar-filters-inner .tribe-bar-search-filter label, 
	{$rule}#tribe-events-bar .tribe-bar-filters .tribe-bar-filters-inner .tribe-bar-geoloc-filter label, 
	{$rule}#tribe-events-bar .tribe-bar-filters .tribe-bar-filters-inner .tribe-bar-submit label, 
	{$rule}#tribe-events-content.tribe-events-month table.tribe-events-calendar tbody td div[id*=\"tribe-events-daynum-\"], 
	{$rule}#tribe-events-content.tribe-events-month table.tribe-events-calendar tbody td div[id*=\"tribe-events-daynum-\"] a, 
	{$rule}.tribe-events-tooltip .tribe-events-event-body .tribe-event-duration, 
	{$rule}#tribe-events-footer > a, 
	{$rule}#tribe-events-content.tribe-events-list .tribe-events-list-separator-month, 
	{$rule}#tribe-mobile-container .tribe-mobile-day .tribe-mobile-day-heading, 
	{$rule}#tribe-mobile-container .tribe-mobile-day .tribe-mobile-day-date, 
	{$rule}.recurringinfo a, 
	{$rule}#tribe-events-content.tribe-events-list .vevent .cmsms_events_list_event_wrap .tribe-events-event-meta .tribe-events-venue-details .author, 
	{$rule}#tribe-events-content.tribe-events-list .vevent .cmsms_events_list_event_wrap .tribe-events-event-meta .tribe-events-venue-details a, 
	{$rule}#tribe-events-content.tribe-events-day .tribe-events-day-time-slot > h5, 
	{$rule}.tribe-events-notices, 
	{$rule}ul.tribe-related-events > li .tribe-related-events-thumbnail .cmsms_events_img_placeholder, 
	{$rule}.tribe-events-venue .cmsms_events_venue_header .cmsms_events_venue_header_right a, 
	{$rule}.tribe-events-organizer .cmsms_events_organizer_header .cmsms_events_organizer_header_right a, 
	{$rule}#tribe-events-content.tribe-events-week-grid .tribe-events-grid .tribe-week-event > div:first-child > .entry-title, 
	{$rule}#tribe-events-content.tribe-events-week-grid .tribe-events-grid .tribe-week-event > div:first-child > .entry-title a, 
	{$rule}.tribe-events-countdown-widget .tribe-countdown-text a, 
	{$rule}.tribe-events-countdown-widget .tribe-countdown-time .tribe-countdown-timer .tribe-countdown-number, 
	{$rule}.tribe-events-countdown-widget .tribe-countdown-time .tribe-countdown-timer .tribe-countdown-colon, 
	{$rule}.tribe-events-venue-widget .tribe-venue-widget-wrapper .tribe-venue-widget-venue .tribe-venue-widget-venue-name, 
	{$rule}.tribe-events-venue-widget .tribe-venue-widget-wrapper .tribe-venue-widget-venue .tribe-venue-widget-venue-name a, 
	{$rule}.widget.tribe-events-list-widget .tribe-event-title, 
	{$rule}.widget.tribe-events-list-widget .tribe-event-title a, 
	{$rule}.widget .vevent .entry-title, 
	{$rule}.widget .vevent .entry-title a, 
	{$rule}.widget .tribe-events-widget-link a, 
	{$rule}.widget.tribe-this-week-events-widget .tribe-events-viewmore a, 
	{$rule}.widget .vevent .cmsms_widget_event_venue_info_loc .cmsms_widget_event_venue_info a, 
	{$rule}.widget .vevent .cmsms_widget_event_venue_info_loc .cmsms_widget_event_venue_loc a:hover, 
	{$rule}.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-list-wrapper .tribe-events-loop .vevent .tribe-mini-calendar-event .list-info .tribe-mini-calendar-event-venue, 
	{$rule}.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-list-wrapper .tribe-events-loop .vevent .tribe-mini-calendar-event .list-info .tribe-mini-calendar-event-venue a {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_heading']) . "
	}
	
	{$rule}.tribe-events-sub-nav li a span, 
	{$rule}#tribe-events-content.tribe-events-month table.tribe-events-calendar thead th, 
	{$rule}#tribe-events-content.tribe-events-week-grid .tribe-events-grid .tribe-grid-header, 
	{$rule}.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-grid-wrapper .tribe-mini-calendar .tribe-mini-calendar-nav div, 
	{$rule}.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-grid-wrapper .tribe-mini-calendar tbody td.tribe-mini-calendar-today, 
	{$rule}.widget .list-date span.list-dayname {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_heading']) . "
	}
	
	{$rule}.tribe-events-sub-nav li a span:before, 
	{$rule}.tribe-events-sub-nav li a span:after {
		" . cmsms_color_css('border-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_heading']) . "
	}
	
	@media only screen and (max-width: 767px) {
		{$rule}#main #tribe-events-content.tribe-events-month table.tribe-events-calendar tbody td.tribe-events-thismonth * {
			" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_heading']) . "
		}
	
		{$rule}#main #tribe-events-content.tribe-events-month table.tribe-events-calendar tbody td.tribe-events-thismonth.mobile-active {
			" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_heading']) . "
		}
	}
	/* Finish Headings Color */
	
	
	/* Start Main Background Color */
	{$rule}#tribe-events-bar #tribe-bar-views .tribe-bar-views-inner ul.tribe-bar-views-list li.tribe-bar-views-option a:hover, 
	{$rule}#tribe-events-bar #tribe-bar-views .tribe-bar-views-inner ul.tribe-bar-views-list li.tribe-bar-views-option.tribe-bar-active a, 
	{$rule}#tribe-events-bar #tribe-bar-views.tribe-bar-views-open .tribe-bar-views-inner label.button,
	{$rule}#tribe-events-content.tribe-events-month table.tribe-events-calendar thead th, 
	{$rule}#tribe-events-content.tribe-events-month table.tribe-events-calendar tbody td.tribe-events-present div[id*=\"tribe-events-daynum-\"], 
	{$rule}#tribe-events-content.tribe-events-month table.tribe-events-calendar tbody td.tribe-events-present div[id*=\"tribe-events-daynum-\"] a, 
	{$rule}#tribe-events-content.tribe-events-month table.tribe-events-calendar tbody td.tribe-events-present div[id*=\"tribe-events-daynum-\"] a:hover, 
	{$rule}#tribe-events-content.tribe-events-week-grid .tribe-events-grid .tribe-grid-header .tribe-grid-content-wrap .column, 
	{$rule}#tribe-events-content.tribe-events-week-grid .tribe-events-grid .tribe-grid-header .tribe-grid-content-wrap .column a, 
	{$rule}#tribe-events-content.tribe-events-week-grid .tribe-events-grid .tribe-week-event:hover > div:first-child a, 
	{$rule}.tribe-this-week-events-widget .this-week-today .tribe-this-week-widget-header-date, 
	{$rule}.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-grid-wrapper .tribe-mini-calendar .tribe-mini-calendar-nav div, 
	{$rule}.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-grid-wrapper .tribe-mini-calendar th.tribe-mini-calendar-dayofweek, 
	{$rule}.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-grid-wrapper .tribe-mini-calendar tbody td.tribe-events-present *, 
	{$rule}.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-grid-wrapper .tribe-mini-calendar tbody td.tribe-events-present:hover *, 
	{$rule}.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-grid-wrapper .tribe-mini-calendar tbody td.tribe-mini-calendar-today *, 
	{$rule}.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-grid-wrapper .tribe-mini-calendar tbody td.tribe-mini-calendar-today:hover *, 
	{$rule}.widget .list-date span.list-dayname, 
	{$rule}.widget .list-date span.list-daynumber {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}#tribe-events-bar #tribe-bar-views .tribe-bar-views-inner ul.tribe-bar-views-list li.tribe-bar-views-option a, 
	{$rule}#tribe-events-bar #tribe-bar-views.tribe-bar-views-open .tribe-bar-views-inner label.button .cmsms_next_arrow,
	{$rule}#tribe-events-bar #tribe-bar-views .tribe-bar-views-inner label.button:hover .cmsms_next_arrow,
	{$rule}#tribe-events-content.tribe-events-month table.tribe-events-calendar, 
	{$rule}.tribe-events-tooltip, 
	{$rule}#tribe-events-content.tribe-events-week-grid .tribe-events-grid, 
	{$rule}.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-grid-wrapper .tribe-mini-calendar .tribe-mini-calendar-nav div .tribe-mini-calendar-nav-link span, 
	{$rule}.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-grid-wrapper .tribe-mini-calendar, 
	{$rule}.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-grid-wrapper .tribe-mini-calendar tbody td.tribe-events-present div .tribe-mini-calendar-day-link:before, 
	{$rule}.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-grid-wrapper .tribe-mini-calendar tbody td.tribe-mini-calendar-today div .tribe-mini-calendar-day-link:before {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}#tribe-events-bar #tribe-bar-views .tribe-bar-views-inner label.button:hover .cmsms_next_arrow:before, 
	{$rule}#tribe-events-bar #tribe-bar-views.tribe-bar-views-open .tribe-bar-views-inner label.button .cmsms_next_arrow:before, 
	{$rule}#tribe-events-bar #tribe-bar-views.tribe-bar-views-open .tribe-bar-views-inner label.button .cmsms_next_arrow:after,
	{$rule}#tribe-events-bar #tribe-bar-views .tribe-bar-views-inner label.button:hover .cmsms_next_arrow:after, 
	{$rule}.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-grid-wrapper .tribe-mini-calendar .tribe-mini-calendar-nav div .tribe-mini-calendar-nav-link:before, 
	{$rule}.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-grid-wrapper .tribe-mini-calendar .tribe-mini-calendar-nav div .tribe-mini-calendar-nav-link span:before, 
	{$rule}.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-grid-wrapper .tribe-mini-calendar .tribe-mini-calendar-nav div .tribe-mini-calendar-nav-link span:after {
		" . cmsms_color_css('border-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.tribe-events-tooltip:after {
		" . cmsms_color_css('border-top-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.recurringinfo .recurring-info-tooltip:after {
		" . cmsms_color_css('border-bottom-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}#tribe-events-content.tribe-events-week-grid .tribe-events-grid .tribe-grid-body .tribe-events-tooltip:after {
		" . cmsms_color_css('border-right-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}#tribe-events-content.tribe-events-week-grid .tribe-events-grid .tribe-grid-body .tribe-events-right .tribe-events-tooltip:after {
		" . cmsms_color_css('border-left-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_bg']) . "
	}
	
	@media only screen and (max-width: 767px) {
		{$rule}#main #tribe-events-content.tribe-events-month table.tribe-events-calendar tbody td.tribe-events-thismonth.mobile-active *, 
		{$rule}#main #tribe-events-content.tribe-events-month table.tribe-events-calendar tbody td.tribe-events-thismonth.tribe-events-present * {
			" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_bg']) . "
		}
		
		{$rule}#main #tribe-events-content.tribe-events-month table.tribe-events-calendar tbody td.tribe-events-has-events.mobile-active:before, 
		{$rule}#main #tribe-events-content.tribe-events-month table.tribe-events-calendar tbody td.tribe-events-present:before {
			" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_bg']) . "
		}
	}
	/* Finish Main Background Color */
	
	
	/* Start Alternate Background Color */
	{$rule}#tribe-events-content.tribe-events-month table.tribe-events-calendar tbody td div[id*=\"tribe-events-daynum-\"], 
	{$rule}#tribe-events-content.tribe-events-month table.tribe-events-calendar tbody td div[id*=\"tribe-events-event-\"]:hover, 
	{$rule}#tribe-mobile-container .tribe-mobile-day .tribe-mobile-day-heading, 
	{$rule}#tribe-mobile-container .tribe-mobile-day .tribe-mobile-day-date, 
	{$rule}.tribe-events-notices, 
	{$rule}ul.tribe-related-events > li .tribe-related-events-thumbnail .cmsms_events_img_placeholder, 
	{$rule}#tribe-events-content.tribe-events-photo #tribe-events-photo-events .tribe-events-photo-event .tribe-events-photo-event-wrap, 
	{$rule}#tribe-events-content.tribe-events-week-grid .tribe-events-grid .tribe-grid-allday, 
	{$rule}#tribe-events-content.tribe-events-week-grid .tribe-events-grid .tribe-week-grid-wrapper .tribe-grid-body .tribe-week-grid-hours div, 
	{$rule}#tribe-events-content.tribe-events-week-grid .tribe-events-grid .tribe-week-event > div:first-child, 
	{$rule}#tribe-events-content.tribe-events-week-grid .tribe-events-grid .tribe-week-grid-wrapper .tribe-week-today, 
	{$rule}.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-grid-wrapper .tribe-mini-calendar tbody td.tribe-events-othermonth {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_alternate']) . "
	}
	
	@media only screen and (max-width: 767px) {
		{$rule}#main #tribe-events-content.tribe-events-month table.tribe-events-calendar tbody td.tribe-events-thismonth {
			" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_alternate']) . "
		}
	}
	/* Finish Alternate Background Color */
	
	
	/* Start Borders Color */
	{$rule}.bd_font_color {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
	}
	
	{$rule}#tribe-events-content.tribe-events-day .tribe-events-day-time-slot > h5,
	{$rule}.widget.tribe-this-week-events-widget .tribe-this-week-widget-day,
	{$rule}#tribe-events-content.tribe-events-list .tribe-events-list-separator-month, 
	{$rule}#tribe-events-bar #tribe-bar-views .tribe-bar-views-inner ul.tribe-bar-views-list li.tribe-bar-views-option a, 
	{$rule}#tribe-events-content.tribe-events-single .cmsms_single_event_header, 
	{$rule}#tribe-events-content.tribe-events-single .cmsms_single_event_meta .tribe-events-meta-group .cmsms_event_meta_info .cmsms_event_meta_info_item, 
	{$rule}.tribe-bar-filters, 
	{$rule}.tribe-events-sub-nav li a, 
	{$rule}#tribe-events-content.tribe-events-month table.tribe-events-calendar tbody td, 
	{$rule}#tribe-events-content.tribe-events-month table.tribe-events-calendar tbody td div[id*=\"tribe-events-daynum-\"], 
	{$rule}.tribe-events-tooltip, 
	{$rule}#tribe-events-content.tribe-events-list .vevent, 
	{$rule}.tribe-events-notices, 
	{$rule}#tribe-events-content.tribe-events-month table.tribe-events-calendar tbody td .tribe-events-viewmore, 
	{$rule}.tribe-events-venue .cmsms_events_venue_header, 
	{$rule}.tribe-events-organizer .cmsms_events_organizer_header, 
	{$rule}.tribe-events-photo #tribe-events-header, 
	{$rule}#tribe-events-content.tribe-events-photo #tribe-events-photo-events .tribe-events-photo-event .tribe-events-photo-event-wrap, 
	{$rule}#tribe-events-content.tribe-events-week-grid .tribe-events-grid, 
	{$rule}#tribe-events-content.tribe-events-week-grid .tribe-events-grid .slimScrollDiv, 
	{$rule}#tribe-events-content.tribe-events-week-grid .tribe-events-grid .tribe-grid-content-wrap .column, 
	{$rule}#tribe-events-content.tribe-events-week-grid .tribe-events-grid .tribe-grid-allday, 
	{$rule}#tribe-events-content.tribe-events-week-grid .tribe-events-grid .tribe-week-grid-wrapper, 
	{$rule}#tribe-events-content.tribe-events-week-grid .tribe-events-grid .tribe-week-grid-wrapper .tribe-week-grid-outer-wrap .tribe-week-grid-inner-wrap .tribe-week-grid-block div, 
	{$rule}#tribe-events-content.tribe-events-week-grid .tribe-events-grid .tribe-week-grid-wrapper .tribe-grid-body .tribe-week-grid-hours div, 
	{$rule}#tribe-mobile-container .tribe-mobile-day .tribe-events-mobile, 
	{$rule}.widget .vevent,
	{$rule}.tribe-events-list-widget ol li, 
	{$rule}.tribe-events-adv-list-widget ol li,
	{$rule}.tribe-events-sub-nav li a:hover span:before, 
	{$rule}.tribe-events-sub-nav li a:hover span:after,
	{$rule}#tribe-events-content.tribe-events-week-grid .tribe-events-grid .tribe-week-event > div:first-child,
	{$rule}.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-grid-wrapper .tribe-mini-calendar th, 
	{$rule}.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-grid-wrapper .tribe-mini-calendar td {
		" . cmsms_color_css('border-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
	}
	
	{$rule}.tribe-events-sub-nav li a:hover span {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
	}
	
	{$rule}.tribe-events-tooltip:before {
		" . cmsms_color_css('border-top-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
	}
	 
	{$rule}.recurringinfo .recurring-info-tooltip:before {
		" . cmsms_color_css('border-bottom-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
	}
	
	{$rule}#tribe-events-content.tribe-events-week-grid .tribe-events-grid .tribe-grid-body .tribe-events-tooltip:before {
		" . cmsms_color_css('border-right-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
	}
	
	{$rule}#tribe-events-content.tribe-events-week-grid .tribe-events-grid .tribe-grid-body .tribe-events-right .tribe-events-tooltip:before {
		" . cmsms_color_css('border-left-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
	}
	/* Finish Borders Color */

/***************** Finish {$title} Events Color Scheme Rules ******************/


";
		}
	}
	
	
	$cmsms_header_bg = explode('|', $cmsms_option[CMSMS_SHORTNAME . '_header_bg']);
	
	$cmsms_header_dropdown_bg = explode('|', $cmsms_option[CMSMS_SHORTNAME . '_header_dropdown_bg']);
	
	
	$cmsms_header_top_bd = explode('|', $cmsms_option[CMSMS_SHORTNAME . '_header_top_border']);
	
	$cmsms_header_top_dropdown_bg = explode('|', $cmsms_option[CMSMS_SHORTNAME . '_header_top_dropdown_bg']);
	
	
	$custom_css .= "
/***************** Start Header Color Scheme Rules ******************/

	/* Start Header Content Color */
	.header_mid,
	.header_bot, 
	.header_mid_inner .social_wrap a {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_color']) . "
	}
	/* Finish Header Content Color */
	
	
	/* Start Header Primary Color */
	.header_mid a,
	.header_mid h1 a:hover,
	.header_mid h2 a:hover,
	.header_mid h3 a:hover,
	.header_mid h4 a:hover,
	.header_mid h5 a:hover,
	.header_mid h6 a:hover,
	.header_mid .color_2,
	.header_bot a,
	.header_bot h1 a:hover,
	.header_bot h2 a:hover,
	.header_bot h3 a:hover,
	.header_bot h4 a:hover,
	.header_bot h5 a:hover,
	.header_bot h6 a:hover,
	.header_bot .color_2,
	.header_mid h1,
	.header_mid h2,
	.header_mid h3,
	.header_mid h4,
	.header_mid h5,
	.header_mid h6,
	.header_mid h1 a,
	.header_mid h2 a,
	.header_mid h3 a,
	.header_mid h4 a,
	.header_mid h5 a,
	.header_mid h6 a,
	.header_bot h1,
	.header_bot h2,
	.header_bot h3,
	.header_bot h4,
	.header_bot h5,
	.header_bot h6,
	.header_bot h1 a,
	.header_bot h2 a,
	.header_bot h3 a,
	.header_bot h4 a,
	.header_bot h5 a,
	.header_bot h6 a,
	#navigation > li > a,
	.header_mid_outer .header_mid_inner .search_wrap .search_bar_wrap button[type=submit][class^=\"cmsms-icon-\"],
	.header_mid_outer .header_mid_inner .search_wrap .search_bar_wrap button[type=submit][class*=\" cmsms-icon-\"],
	.header_mid_outer .header_mid_inner .search_wrap .search_but,
	.header_mid .search_bar_wrap button[type=submit][class^=\"cmsms-icon-\"],
	.header_mid .search_bar_wrap button[type=submit][class*=\" cmsms-icon-\"],
	.header_bot .search_bar_wrap button[type=submit][class^=\"cmsms-icon-\"],
	.header_bot .search_bar_wrap button[type=submit][class*=\" cmsms-icon-\"], 
	.header_mid_inner .social_wrap a:hover {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_link']) . "
	}
	
	.header_mid .cmsms_button,
	.header_mid .button:hover,
	.header_bot .cmsms_button,
	.header_bot .button:hover,
	.header_mid .button,
	.header_bot .button {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_header_link']) . "
	}
	
	.header_mid input[type=text]:focus,
	.header_mid input[type=email]:focus,
	.header_mid input[type=password]:focus,
	.header_mid textarea:focus,
	.header_top input[type=text]:focus,
	.header_top input[type=email]:focus,
	.header_top input[type=password]:focus,
	.header_top textarea:focus {
		" . cmsms_color_css('border-color', $cmsms_option[CMSMS_SHORTNAME . '_header_link']) . "
	}
	/* Finish Header Primary Color */
	
	
	/* Start Header Rollover Color */
	.header_mid a:hover,
	.header_bot a:hover,
	#navigation > li > a:hover,
	#navigation > li.current-menu-item > a,
	#navigation > li.current_page_item > a,
	#navigation > li.current-menu-ancestor > a,
	#navigation > li.menu-item-highlight > a {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_hover']) . "
	}
	
	@media only screen and (min-width: 1024px) {
		#navigation > li:hover > a {
			" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_hover']) . "
		}
	}
	/* Finish Header Rollover Color */
	
	
	/* Start Header Background Color */
	.header_mid .cmsms_button,
	.header_mid .cmsms_button:hover, 
	.header_bot .cmsms_button,
	.header_bot .cmsms_button:hover {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_bg']) . "
	}
	
	.header_mid input[type=text]:focus,
	.header_mid input[type=number]:focus,
	.header_mid input[type=email]:focus,
	.header_mid input[type=password]:focus,
	.header_mid textarea:focus,
	.header_bot input[type=text]:focus,
	.header_bot input[type=number]:focus,
	.header_bot input[type=email]:focus,
	.header_bot input[type=password]:focus,
	.header_bot textarea:focus,
	.header_mid_outer,
	.header_bot_outer,
	.header_mid_outer .header_mid_inner .search_wrap.search_opened .search_but {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_header_bg']) . "
	}
	/* Finish Header Background Color */
	
	
	/* Start Header Rollover Background Color */
	#navigation > li > a:hover,
	#navigation > li.current-menu-item > a,
	#navigation > li.current_page_item > a,
	#navigation > li.current-menu-ancestor > a,
	#navigation > li > a > span.nav_bg_clr,
	#navigation > li.menu-item-highlight > a > span.nav_bg_clr {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_header_hover_bg']) . "
	}
	
	@media only screen and (min-width: 1024px) {
		#navigation > li:hover > a {
			" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_header_hover_bg']) . "
		}
	}
	/* Finish Header Rollover Background Color */
	
	
	/* Start Header Borders Color */
	.header_mid input[type=text],
	.header_mid input[type=number],
	.header_mid input[type=email],
	.header_mid input[type=password],
	.header_mid input[type=submit],
	.header_mid button,
	.header_mid textarea,
	.header_mid select,
	.header_mid option,
	.header_bot input[type=text],
	.header_bot input[type=number],
	.header_bot input[type=email],
	.header_bot input[type=password],
	.header_bot input[type=submit],
	.header_bot button,
	.header_bot textarea,
	.header_bot select,
	.header_bot option,
	.header_mid_outer .header_mid_inner .search_wrap.search_opened .search_but,
	.header_mid .search_bar_wrap,
	.header_bot .search_bar_wrap, 
	#navigation li a {
		" . cmsms_color_css('border-color', $cmsms_option[CMSMS_SHORTNAME . '_header_border']) . "
	}
	
	.header_mid_outer,
	.header_bot_outer,
	.header_mid hr,
	.header_mid .cmsms_divider,
	.header_bot hr,
	.header_bot .cmsms_divider {
		" . cmsms_color_css('border-bottom-color', $cmsms_option[CMSMS_SHORTNAME . '_header_border']) . "
	}
	/* Finish Header Borders Color */
	
	
	/* Start Header Dropdown Link Color */
	.header_mid .button,
	.header_mid .button:hover, 
	.header_bot .button,
	.header_bot .button:hover, 
	#navigation ul li a {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_dropdown_link']) . "
	}
	
	@media only screen and (max-width: 1024px) {
		#navigation > li > a {
			" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_dropdown_link']) . "
		}
	}
	/* Finish Header Dropdown Link Color */
	
	
	/* Start Header Dropdown Rollover Color */
	#navigation ul li > a:hover,
	#navigation ul li.current-menu-item > a,
	#navigation ul li.current_page_item > a,
	#navigation ul li.current-menu-ancestor > a,
	#navigation > li li.menu-item-highlight > a,
	#navigation > li li.menu-item-highlight > a:hover,
	#navigation > li.menu-item-mega li > a:hover,
	#navigation > li.menu-item-mega li.current-menu-ancestor > a,
	#navigation > li.menu-item-mega li li > a:hover,
	#navigation > li.menu-item-mega > ul > li > a,
	#navigation > li.menu-item-mega > ul > li > a:hover,
	#navigation > li.menu-item-mega > div.menu-item-mega-container li > a:hover,
	#navigation > li.menu-item-mega > div.menu-item-mega-container li.current-menu-item > a,
	#navigation > li.menu-item-mega > div.menu-item-mega-container li.current_page_item > a,
	#navigation > li.menu-item-mega > div.menu-item-mega-container li.menu-item-highlight > a,
	#navigation > li.menu-item-mega > div.menu-item-mega-container li.menu-item-highlight > a:hover,
	#navigation > li.menu-item-mega > div.menu-item-mega-container li.menu-item-highlight:hover > a:hover,
	#navigation > li.menu-item-mega > div.menu-item-mega-container > ul > li > a,
	#navigation > li.menu-item-mega > div.menu-item-mega-container > ul > li > a:hover,
	#navigation > li.menu-item-mega > div.menu-item-mega-container > ul > li > a[href]:hover,
	#navigation > li.menu-item-mega > div.menu-item-mega-container > ul li li > a:hover,
	#navigation > li.menu-item-mega > div.menu-item-mega-container > ul li li:hover > a:hover {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_dropdown_hover']) . "
	}
	
	@media only screen and (max-width: 1024px) {
		#navigation > li > a:hover,
		#navigation > li.current-menu-item > a,
		#navigation > li.current_page_item > a,
		#navigation > li.current-menu-ancestor > a,
		#navigation > li.menu-item-highlight > a {
			" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_dropdown_hover']) . "
		}
	}
	
	@media only screen and (min-width: 1024px) {
		#navigation ul li:hover > a,
		#navigation > li li.menu-item-highlight:hover > a,
		#navigation > li.menu-item-mega li:hover > a,
		#navigation > li.menu-item-mega > ul > li:hover > a,
		#navigation > li.menu-item-mega > div.menu-item-mega-container li:hover > a,
		#navigation > li.menu-item-mega > div.menu-item-mega-container > ul li li:hover > a,
		#navigation > li.menu-item-mega > div.menu-item-mega-container li.menu-item-highlight:hover > a {
			" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_dropdown_hover']) . "
		}
	}
	/* Finish Header Dropdown Rollover Color */
	
	
	/* Start Header Dropdown Background Color */
	.header_mid input[type=text],
	.header_mid input[type=number],
	.header_mid input[type=email],
	.header_mid input[type=password],
	.header_mid input[type=submit],
	.header_mid button,
	.header_mid textarea,
	.header_mid select,
	.header_mid option,
	.header_bot input[type=text],
	.header_bot input[type=number],
	.header_bot input[type=email],
	.header_bot input[type=password],
	.header_bot input[type=submit],
	.header_bot button,
	.header_bot textarea,
	.header_bot select,
	.header_bot option,
	#navigation ul,
	#navigation > li.menu-item-mega li > a:hover,
	#navigation > li.menu-item-mega > div.menu-item-mega-container {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_header_dropdown_bg']) . "
	}
	
	@media only screen and (max-width: 1024px) {
		#navigation {
			" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_header_dropdown_bg']) . "
		}
	}
	
	@media only screen and (min-width: 1024px) {
		#navigation > li.menu-item-mega li:hover > a {
			" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_header_dropdown_bg']) . "
		}
	}
	
	#navigation > li.menu-item-has-children > a:before,
	#navigation > li.menu-item-has-children > a > span.nav_bg_clr:before {
		" . cmsms_color_css('border-bottom-color', $cmsms_option[CMSMS_SHORTNAME . '_header_dropdown_bg']) . "
	}
	/* Finish Header Dropdown Background Color */
	
	
	/* Start Header Dropdown Rollover Background Color */
	#navigation ul li > a:hover,
	#navigation ul li.current-menu-item > a,
	#navigation ul li.current_page_item > a,
	#navigation ul li.current-menu-ancestor > a,
	#navigation > li.menu-item-mega li li:hover > a:hover,
	#navigation > li.menu-item-mega li li.current-menu-item > a,
	#navigation > li.menu-item-mega li li.current_page_item > a,
	.header_mid .search_bar_wrap,
	.header_mid .search_bar_wrap input[type=text],
	.header_mid .search_bar_wrap input[type=text]:focus,
	.header_bot .search_bar_wrap,
	.header_bot .search_bar_wrap input[type=text],
	.header_bot .search_bar_wrap input[type=text]:focus {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_header_dropdown_hover_bg']) . "
	}
	
	@media only screen and (max-width: 1024px) {
		#navigation > li > a:hover,
		#navigation > li.current-menu-item > a,
		#navigation > li.current_page_item > a,
		#navigation > li.current-menu-ancestor > a,
		#navigation > li > a > span.nav_bg_clr,
		#navigation > li.menu-item-highlight > a > span.nav_bg_clr {
			" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_header_dropdown_hover_bg']) . "
		}
	}
	
	@media only screen and (min-width: 1024px) {
		#navigation ul li:hover > a {
			" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_header_dropdown_hover_bg']) . "
		}
	}
	/* Finish Header Dropdown Rollover Background Color */
	
	
	/* Start Header Dropdown Borders Color */
	#navigation > li.menu-item-mega > div.menu-item-mega-container > ul:after {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_header_dropdown_border']) . "
	}
	
	#navigation ul,
	#navigation > li.menu-item-mega > div.menu-item-mega-container {
		" . cmsms_color_css('border-color', $cmsms_option[CMSMS_SHORTNAME . '_header_dropdown_border']) . "
	}
	
	@media only screen and (max-width: 1024px) {
		#navigation li a {
			" . cmsms_color_css('border-color', $cmsms_option[CMSMS_SHORTNAME . '_header_dropdown_border']) . "
		}
		
		.header_mid_outer,
		.header_bot_outer {
			" . cmsms_color_css('border-bottom-color', $cmsms_option[CMSMS_SHORTNAME . '_header_dropdown_border']) . "
		}
	}
	
	#navigation ul li,
	#navigation > li.menu-item-mega > div.menu-item-mega-container li li li:first-child {
		" . cmsms_color_css('border-top-color', $cmsms_option[CMSMS_SHORTNAME . '_header_dropdown_border']) . "
	}
	/* Finish Header Dropdown Borders Color */
	
	
	/* Start Header Custom Rules */
	.header_mid ::selection,
	.header_bot ::selection {
		" . cmsms_color_css('background', $cmsms_option[CMSMS_SHORTNAME . '_header_link']) . "
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_bg']) . "
	}
	
	.header_mid ::-moz-selection,
	.header_bot ::-moz-selection {
		" . cmsms_color_css('background', $cmsms_option[CMSMS_SHORTNAME . '_header_link']) . "
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_bg']) . "
	}
	
	#page.fixed_header .header_mid_outer,
	#page.fixed_header .header_bot_outer {
		background-color:rgba(" . hex2rgb($cmsms_header_bg[0]) . ", " . ((int) $cmsms_header_bg[1] / 100) . ");
	}
	";
	
	
	if ($cmsms_option[CMSMS_SHORTNAME . '_header_dropdown_shadow']) {
	$custom_css .= "
	#navigation ul,
	#navigation > li.menu-item-mega > div.menu-item-mega-container {
		-webkit-box-shadow:0 5px 15px 0 rgba(" . hex2rgb($cmsms_header_dropdown_bg[0]) . ', ' . ((int) $cmsms_option[CMSMS_SHORTNAME . '_header_dropdown_shadow_opacity'] / 100) . ");
		-moz-box-shadow:0 5px 15px 0 rgba(" . hex2rgb($cmsms_header_dropdown_bg[0]) . ', ' . ((int) $cmsms_option[CMSMS_SHORTNAME . '_header_dropdown_shadow_opacity'] / 100) . ");
		box-shadow:0 5px 15px 0 rgba(" . hex2rgb($cmsms_header_dropdown_bg[0]) . ', ' . ((int) $cmsms_option[CMSMS_SHORTNAME . '_header_dropdown_shadow_opacity'] / 100) . ");
	}
	";
	}
	
	
	$custom_css .= "
	/* Finish Header Custom Rules */

/***************** Finish Header Color Scheme Rules ******************/



/***************** Start Header Top Color Scheme Rules ******************/

	/* Start Header Top Content Color */
	.header_top,
	.header_top_outer .meta_wrap, 
	.header_top_inner .social_wrap a {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_color']) . "
	}
	/* Finish Header Top Content Color */
	
	
	/* Start Header Top Primary Color */
	.header_top a,
	.header_top .color_2,
	.header_top_outer nav > div > ul > li a,
	.header_top_outer .meta_wrap a,
	.header_top h1,
	.header_top h2,
	.header_top h3,
	.header_top h4,
	.header_top h5,
	.header_top h6,
	.header_top h1 a,
	.header_top h2 a,
	.header_top h3 a,
	.header_top h4 a,
	.header_top h5 a,
	.header_top h6 a,
	.header_top h1 a:hover,
	.header_top h2 a:hover,
	.header_top h3 a:hover,
	.header_top h4 a:hover,
	.header_top h5 a:hover,
	.header_top h6 a:hover,
	.header_top .search_bar_wrap button[type=submit][class^=\"cmsms-icon-\"],
	.header_top .search_bar_wrap button[type=submit][class*=\" cmsms-icon-\"] {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_link']) . "
	}
	
	@media only screen and (max-width: 1024px) {
		html #page #header .header_top .header_top_outer .header_top_inner .header_top_right .nav_wrap nav #top_line_nav li > a {
			" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_link']) . "
		}
	}
	
	.header_top .cmsms_button,
	.header_top .button:hover,
	.header_top_outer nav > div > ul > li > a > span.cmsms_count,
	.header_top .button {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_link']) . "
	}
	
	.header_top input[type=text]:focus,
	.header_top input[type=number]:focus,
	.header_top input[type=email]:focus,
	.header_top input[type=password]:focus,
	.header_top textarea:focus {
		" . cmsms_color_css('border-color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_link']) . "
	}
	/* Finish Header Top Primary Color */
	
	
	/* Start Header Top Rollover Color */
	.header_top a:hover,
	.header_top_outer nav > div > ul > li:hover > a,
	.header_top_outer nav > div > ul > li.current-menu-item > a,
	.header_top_outer nav > div > ul > li.current-menu-ancestor > a,
	.header_top_outer .meta_wrap a:hover, 
	.header_top_inner .social_wrap a:hover {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_hover']) . "
	}
	
	@media only screen and (max-width: 1024px) {
		html #page #header .header_top .header_top_outer .header_top_inner .header_top_right .nav_wrap nav #top_line_nav li > a:hover, 
		html #page #header .header_top .header_top_outer .header_top_inner .header_top_right .nav_wrap nav #top_line_nav li.current-menu-item > a {
			" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_hover']) . "
		}
	}
	
	.header_top_but .cmsms_top_arrow, 
	.header_top_but .cmsms_bot_arrow {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_hover']) . "
	}
	
	.header_top_but .cmsms_top_arrow:before, 
	.header_top_but .cmsms_top_arrow:after, 
	.header_top_but .cmsms_top_arrow span:before, 
	.header_top_but .cmsms_top_arrow span:after, 
	.header_top_but .cmsms_bot_arrow:before, 
	.header_top_but .cmsms_bot_arrow:after, 
	.header_top_but .cmsms_bot_arrow span:before, 
	.header_top_but .cmsms_bot_arrow span:after {
		" . cmsms_color_css('border-color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_hover']) . "
	}
	/* Finish Header Top Rollover Color */
	
	
	/* Start Header Top Background Color */
	.header_top_outer nav > div > ul > li > a > span.cmsms_count,
	.header_top .cmsms_button,
	.header_top .cmsms_button:hover {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_bg']) . "
	}
	
	.header_top,
	.header_top input[type=text]:focus,
	.header_top input[type=number]:focus,
	.header_top input[type=email]:focus,
	.header_top input[type=password]:focus,
	.header_top textarea:focus,
	.header_top_outer {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_bg']) . "
	}
	/* Finish Header Top Background Color */
	
	
	/* Start Header Top Borders Color */
	.header_top input[type=text],
	.header_top input[type=number],
	.header_top input[type=email],
	.header_top input[type=password],
	.header_top input[type=submit],
	.header_top button,
	.header_top textarea,
	.header_top select,
	.header_top option,
	.header_top .search_bar_wrap {
		" . cmsms_color_css('border-color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_border']) . "
	}
	
	.header_top hr,
	.header_top .cmsms_divider {
		" . cmsms_color_css('border-bottom-color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_border']) . "
	}
	
	@media only screen and (max-width: 1024px) {
		html #page #header .header_top .header_top_outer .header_top_inner .header_top_left, 
		html #page #header .header_top .header_top_outer .header_top_inner .header_top_right {
			" . cmsms_color_css('border-bottom-color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_border']) . "
		}
		
		html #page #header .header_top .header_top_outer .header_top_inner .header_top_right .nav_wrap nav #top_line_nav li > a {
			" . cmsms_color_css('border-top-color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_border']) . "
		}
	}
	/* Finish Header Top Borders Color */
	
	
	/* Start Header Top Dropdown Link Color */
	.header_top_outer nav > div > ul > li a,
	.header_top_outer nav > div > ul > li ul li > a,
	.header_top .button,
	.header_top .button:hover, 
	html #page #header .header_top .header_top_outer .header_top_inner .header_top_right .nav_wrap .responsive_top_nav:hover, 
	html #page #header .header_top .header_top_outer .header_top_inner .header_top_right .nav_wrap .responsive_top_nav.active {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_dropdown_link']) . "
	}
	
	html #page #header .header_top .header_top_outer .header_top_inner .header_top_right .nav_wrap .responsive_top_nav {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_dropdown_link']) . "
	}
	/* Finish Header Top Dropdown Link Color */
	
	
	/* Start Header Top Dropdown Rollover Color */
	.header_top_outer nav > div > ul > li ul li:hover > a,
	.header_top_outer nav > div > ul > li ul li.current-menu-item > a,
	.header_top_outer nav > div > ul > li ul li.current-menu-ancestor > a, 
	html #page #header .header_top .header_top_outer .header_top_inner .header_top_right .nav_wrap .responsive_top_nav {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_dropdown_hover']) . "
	}
	/* Finish Header Top Dropdown Rollover Color */
	
	
	/* Start Header Top Dropdown Background Color */
	.header_top input[type=text],
	.header_top input[type=number],
	.header_top input[type=email],
	.header_top input[type=password],
	.header_top input[type=submit],
	.header_top button,
	.header_top textarea,
	.header_top select,
	.header_top option,
	.header_top_outer nav > div > ul > li ul,
	.header_top .search_bar_wrap,
	.header_top .search_bar_wrap input[type=text],
	.header_top .search_bar_wrap input[type=text]:focus {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_dropdown_bg']) . "
	}
	/* Finish Header Top Dropdown Background Color */
	
	
	/* Start Header Top Dropdown Border Color */
	
	.header_top_outer nav > div > ul > li.menu-item-has-children > a:before {
		" . cmsms_color_css('border-bottom-color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_dropdown_border']) . "
	}
	
	html #page #header .header_top .header_top_outer .header_top_inner .header_top_right .nav_wrap .responsive_top_nav:hover, 
	html #page #header .header_top .header_top_outer .header_top_inner .header_top_right .nav_wrap .responsive_top_nav.active {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_dropdown_border']) . "
	}
	/* Finish Header Top Dropdown Border Color */
	
	
	/* Start Header Top Custom Rules */
	.header_top ::selection {
		" . cmsms_color_css('background', $cmsms_option[CMSMS_SHORTNAME . '_header_top_link']) . "
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_bg']) . "
	}
	
	.header_top ::-moz-selection {
		" . cmsms_color_css('background', $cmsms_option[CMSMS_SHORTNAME . '_header_top_link']) . "
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_bg']) . "
	}
	
	.header_top_outer {
		-webkit-box-shadow:inset 0 -1px 0 0 rgba(" . hex2rgb($cmsms_header_top_bd[0]) . ', ' . ((int) $cmsms_header_top_bd[1] / 100) . ");
		-moz-box-shadow:inset 0 -1px 0 0 rgba(" . hex2rgb($cmsms_header_top_bd[0]) . ', ' . ((int) $cmsms_header_top_bd[1] / 100) . ");
		box-shadow:inset 0 -1px 0 0 rgba(" . hex2rgb($cmsms_header_top_bd[0]) . ', ' . ((int) $cmsms_header_top_bd[1] / 100) . ");
	}
	";
	
	
	if ($cmsms_option[CMSMS_SHORTNAME . '_header_top_dropdown_shadow']) {
	$custom_css .= "
	.header_top_outer nav > div > ul > li ul {
		-webkit-box-shadow:0 0 2px 0 rgba(" . hex2rgb($cmsms_header_top_bd[0]) . ', ' . ((int) $cmsms_option[CMSMS_SHORTNAME . '_header_top_dropdown_shadow_opacity'] / 100) . ");
		-moz-box-shadow:0 0 2px 0 rgba(" . hex2rgb($cmsms_header_top_bd[0]) . ', ' . ((int) $cmsms_option[CMSMS_SHORTNAME . '_header_top_dropdown_shadow_opacity'] / 100) . ");
		box-shadow:0 0 2px 0 rgba(" . hex2rgb($cmsms_header_top_bd[0]) . ', ' . ((int) $cmsms_option[CMSMS_SHORTNAME . '_header_top_dropdown_shadow_opacity'] / 100) . ");
	}
	";
	}
	
	
	$custom_css .= "
	/* Finish Header Top Custom Rules */

/***************** Finish Header Top Color Scheme Rules ******************/

";
	
	
	return $custom_css;
}

