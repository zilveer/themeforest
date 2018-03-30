<?php global $theme_options; ?>
<!--custom style-->
<style type="text/css">
	<?php if($theme_options["header_background_color"]!=""): ?>
	.header_container
	{
		background-color: #<?php echo $theme_options["header_background_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["body_background_color"]!=""): ?>
	body
	{
		background-color: #<?php echo $theme_options["body_background_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["footer_background_color"]!=""): ?>
	.footer_container
	{
		background-color: #<?php echo $theme_options["footer_background_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["slider_title_color"]!=""): ?>
	.slider_content .title
	{
		color: #<?php echo $theme_options["slider_title_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["slider_subtitle_color"]!=""): ?>
	.slider_content .subtitle
	{
		color: #<?php echo $theme_options["slider_subtitle_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["slider_text_border_color"]!=""): ?>
	.slider_content
	{
		border-top-color: #<?php echo $theme_options["slider_text_border_color"]; ?>;
		border-bottom-color: #<?php echo $theme_options["slider_text_border_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["body_headers_color"]!=""): ?>
	h1, h2, h3, h4, h5,
	h1 a, h2 a, h3 a, h4 a, h5 a
	<?php
	if(is_plugin_active('woocommerce/woocommerce.php')):
	?>
	.woocommerce ul.cart_list li a,
	.woocommerce ul.product_list_widget li a
	<?php
	endif;
	?>
	{
		color: #<?php echo $theme_options["body_headers_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["body_headers_border_color"]!=""): ?>
	.box_header
	<?php
	if(is_plugin_active('woocommerce/woocommerce.php')):
	?>,
	.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover,
	.woocommerce div.product .woocommerce-tabs ul.tabs li a.selected, 
	.woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
	.woocommerce-checkout .woocommerce h2
	<?php
	endif;
	?>
	{
		<?php if($theme_options["body_headers_border_color"]=="none"): ?>
		border-bottom: none;
		<?php else: ?>
		<?php /* ?>border-bottom: 1px solid #<?php echo $theme_options["body_headers_border_color"] ?>;<?php */ ?>
		border-bottom-color: #<?php echo $theme_options["body_headers_border_color"] ?>;
		<?php endif; ?>
	}
	<?php endif; 
	if($theme_options["body_text_color"]!=""): ?>
	p,
	.post_content .text,
	#comments_list .comment_details p,
	.accordion .ui-accordion-content,
	.timetable,
	.gallery_item_details_list .details_box p,
	.gallery_item_details_list .details_box .list,
	.scrolling_list li,
	.scrolling_list li a
	<?php
	if(is_plugin_active('woocommerce/woocommerce.php')):
	?>
	,
	.woocommerce p,
	.woocommerce .woocommerce-error,
	.woocommerce .woocommerce-info,
	.woocommerce .woocommerce-message,
	.woocommerce table.shop_table,
	.woocommerce-cart .cart-collaterals .cart_totals table,
	li.payment_method_cod label
	<?php
	endif;
	?>
	{
		color: #<?php echo $theme_options["body_text_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["body_text2_color"]!=""): ?>
	.bread_crumb li,
	.accordion .ui-accordion-header h5,
	#comments_list .comment_details .posted_by,
	.header_top_sidebar 
	<?php
	if(is_plugin_active('woocommerce/woocommerce.php')):
	?>
	,
	.woocommerce div.product .woocommerce-tabs ul.tabs li a,
	.woocommerce .posted_in,
	.woocommerce .woocommerce-result-count,
	.woocommerce-page .woocommerce-result-count,
	.woocommerce .widget_price_filter .price_slider_amount .price_label,
	.woocommerce ul.products li.product .price,
	.woocommerce div.product p.price,
	.woocommerce #review_form_wrapper .comment-form-rating label,
	.woocommerce div.product span.price,
	.woocommerce .widget_top_rated_products .amount,
	.woocommerce ul.products li.product .price del,
	.woocommerce .widget_top_rated_products del,
	.woocommerce ul.products li.product .price ins,
	.woocommerce .widget_top_rated_products ins,
	.woocommerce form .form-row label
	<?php
	endif;
	?>
	{
		color: #<?php echo $theme_options["body_text2_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["footer_headers_color"]!=""): ?>
	.footer h1, .footer h2, .footer h3, .footer h4, .footer h5,
	.footer h1 a, .footer h2 a, .footer h3 a, .footer h4 a, .footer h5 a
	{
		color: #<?php echo $theme_options["footer_headers_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["footer_headers_border_color"]!=""): ?>
	.footer .box_header
	{
		<?php if($theme_options["footer_headers_border_color"]=="none"): ?>
		border-bottom: none;
		<?php else: ?>
		border-bottom: 1px solid #<?php echo $theme_options["footer_headers_border_color"] ?>;
		<?php endif; ?>
	}
	<?php endif; 
	if($theme_options["footer_text_color"]!=""): ?>
	.footer_contact_info_row,
	.copyright_area,
	.copyright_right .scroll_top,
	.footer .scrolling_list li,
	.footer .scrolling_list li a
	{
		color: #<?php echo $theme_options["footer_text_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["timeago_label_color"]!=""): ?>
	.timeago, .trainers .value
	{
		color: #<?php echo $theme_options["timeago_label_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["sentence_color"]!=""): ?>
	.sentence,
	.info_green,
	.gallery_item_details_list .details_box .subheader
	{
		color: #<?php echo $theme_options["sentence_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["logo_first_part_text_color"]!=""): ?>
	.logo_left
	{
		color: #<?php echo $theme_options["logo_first_part_text_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["logo_second_part_text_color"]!=""): ?>
	.logo_right
	{
		color: #<?php echo $theme_options["logo_second_part_text_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["body_button_color"]!=""): ?>
	.more,
	.ui-tabs-nav li a,
	.tabs_navigation li a,
	.scrolling_list li .number,
	.categories li, .widget_categories li,
	.categories li a, .widget_categories li a,
	.pagination li a, .pagination li span
	<?php
	if(is_plugin_active('woocommerce/woocommerce.php')):
	?>
	,
	.woocommerce ul.products li.product .button,
	.woocommerce #respond input#submit,
	.woocommerce a.button,
	.woocommerce button.button,
	.woocommerce input.button,
	.woocommerce #respond input#submit.alt,
	.woocommerce a.button.alt,
	.woocommerce button.button.alt,
	.woocommerce input.button.altm,
	.woocommerce .widget_product_search form input[type='submit'],
	.woocommerce .cart .coupon input.button,
	.woocommerce .product-categories li a,
	.woocommerce .woocommerce-pagination ul.page-numbers li a,
	.woocommerce .woocommerce-pagination ul.page-numbers li span,
	.woocommerce .woocommerce-pagination ul.page-numbers li a:focus,
	.woocommerce #respond input#submit.alt,
	.woocommerce a.button.alt,
	.woocommerce button.button.alt,
	.woocommerce input.button.alt,
	.woocommerce .posted_in a
	<?php
	endif;
	?>
	{
		color: #<?php echo $theme_options["body_button_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["body_button_hover_color"]!="" || $theme_options["body_button_border_hover_color"]!=""): ?>
	.more:hover,
	.categories li a:hover,
	.widget_categories li a:hover,
	li.current-cat a,
	.scrolling_list_control_left:hover, 
	.scrolling_list_control_right:hover,
	.search input[type='submit']:hover,
	.comment_form input[type='submit']:hover,
	.contact_form input[type='submit']:hover,
	.pagination li a:hover,
	.pagination li.selected a,
	.pagination li.selected span,
	.scrolling_list li a:hover .number,
	.ui-tabs-nav li a:hover,
	.ui-tabs-nav li.ui-tabs-active a,
	.tabs_navigation li a:hover,
	.tabs_navigation li a.selected
	<?php
	if(is_plugin_active('woocommerce/woocommerce.php')):
	?>
	,
	.woocommerce .product-categories li.current-cat a,
	.woocommerce .product-categories li a:hover
	.woocommerce ul.products li.product .button:hover,
	.woocommerce-cart .woocommerce .wc-proceed-to-checkout a.checkout-button:hover,
	.woocommerce .widget_price_filter .price_slider_amount .button:hover,
	.woocommerce .widget_product_search form input[type='submit']:hover,
	.woocommerce div.product form.cart .button.single_add_to_cart_button:hover,
	.woocommerce #review_form #respond .form-submit input:hover,
	.woocommerce #payment #place_order:hover,
	.woocommerce .cart input.button:hover,
	.woocommerce .button.wc-forward:hover,
	.woocommerce #respond input#submit:hover,
	.woocommerce a.button:hover,
	.woocommerce button.button:hover,
	.woocommerce input.button:hover,
	.woocommerce #respond input#submit.alt:hover,
	.woocommerce a.button.alt:hover,
	.woocommerce button.button.alt:hover,
	.woocommerce input.button.alt:hover,
	.woocommerce .cart .coupon input.button:hover,
	.woocommerce .woocommerce-pagination ul.page-numbers li a:hover,
	.woocommerce .woocommerce-pagination ul.page-numbers li a.current,
	.woocommerce .woocommerce-pagination ul.page-numbers li span.current,
	.woocommerce .posted_in a:hover
	<?php
	endif;
	?>
	{
		<?php if($theme_options["body_button_hover_color"]!=""): ?>
		color: #<?php echo $theme_options["body_button_hover_color"]; ?>;
		<?php endif;
		if($theme_options["body_button_border_hover_color"]!=""): ?>
		border-color: #<?php echo $theme_options["body_button_border_hover_color"]; ?>;
		<?php endif; ?>
	}
	<?php endif; 
	if($theme_options["body_button_border_color"]!=""): ?>
	.more,
	.categories li a,
	.widget_categories li a,
	.scrolling_list_control_left, 
	.scrolling_list_control_right,
	.pagination li a,
	.pagination li span,
	.scrolling_list li .number,
	.ui-tabs-nav li a,
	.tabs_navigation li a,
	.categories li.posted_by
	<?php
	if(is_plugin_active('woocommerce/woocommerce.php')):
	?>
	,
	.woocommerce .product-categories li a,
	.woocommerce .widget_price_filter .price_slider_amount .button,
	.woocommerce .woocommerce-pagination ul.page-numbers li a,
	.woocommerce .woocommerce-pagination ul.page-numbers li span,
	.woocommerce .woocommerce-pagination ul.page-numbers li a:focus,
	.woocommerce-cart .wc-proceed-to-checkout a.checkout-button,
	.woocommerce .widget_price_filter .price_slider_amount .button, 
	.woocommerce .widget_product_search form input[type='submit'], 
	.woocommerce div.product form.cart .button.single_add_to_cart_button, 
	.woocommerce #review_form #respond .form-submit input,
	.woocommerce #payment #place_order, 
	.woocommerce .cart input.button,
	.woocommerce .button.wc-forward,
	.woocommerce .posted_in a,
	.woocommerce #respond input#submit,
	.woocommerce a.button, .woocommerce button.button,
	.woocommerce input.button,
	.woocommerce #respond input#submit.alt,
	.woocommerce a.button.alt,
	.woocommerce button.button.alt,
	.woocommerce input.button.altm,
	.woocommerce .widget_product_search form input[type='submit'],
	.woocommerce .cart .coupon input.button
	<?php
	endif;
	?>
	{
		border-color: #<?php echo $theme_options["body_button_border_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["footer_button_color"]!=""): ?>
	.footer .ui-tabs-nav li a,
	.footer .tabs_navigation li a,
	.footer .scrolling_list li .number,
	.footer .categories li, .widget_categories li,
	.footer .categories li a, .widget_categories li a
	{
		color: #<?php echo $theme_options["footer_button_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["footer_button_hover_color"]!="" || $theme_options["footer_button_border_hover_color"]!=""): ?>
	.footer .more:hover,
	.footer .categories li a:hover,
	.footer .widget_categories li a:hover,
	.footer li.current-cat a,
	.footer .scrolling_list_control_left:hover, 
	.footer .scrolling_list_control_right:hover,
	.footer .scrolling_list li a:hover .number,
	.footer .ui-tabs-nav li a:hover,
	.footer .ui-tabs-nav li.ui-tabs-selected a,
	.footer .tabs_navigation li a:hover,
	.footer .tabs_navigation li a.selected
	{
		<?php if($theme_options["footer_button_hover_color"]!=""): ?>
		color: #<?php echo $theme_options["footer_button_hover_color"]; ?>;
		<?php endif;
		if($theme_options["footer_button_border_hover_color"]!=""): ?>
		border-color: #<?php echo $theme_options["footer_button_border_hover_color"]; ?>;
		<?php endif; ?>
	}
	<?php endif; 
	if($theme_options["footer_button_border_color"]!=""): ?>
	.footer .more,
	.footer .categories li a,
	.footer .widget_categories li a,
	.footer .scrolling_list_control_left, 
	.footer .scrolling_list_control_right,
	.footer .scrolling_list li .number,
	.footer .ui-tabs-nav li a,
	.footer .tabs_navigation li a
	{
		border-color: #<?php echo $theme_options["footer_button_border_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["menu_link_color"]!=""): ?>
	.sf-menu li a, .sf-menu li a:visited
	{
		color: #<?php echo $theme_options["menu_link_color"] ?>;
	}
	<?php endif; 
	if($theme_options["menu_link_border_color"]!=""): ?>
	.sf-menu li a, .sf-menu li a:visited
	{
		border-bottom: 2px solid #<?php echo $theme_options["menu_link_border_color"] ?>;
	}
	<?php endif; 
	if($theme_options["menu_active_color"]!="" || $theme_options["menu_active_border_color"]!=""): ?>
	.sf-menu li.selected a, .sf-menu li.current-menu-item a
	{
		<?php if($theme_options["menu_active_color"]!=""): ?>
		color: #<?php echo $theme_options["menu_active_color"] ?>;
		<?php endif; 
		if($theme_options["menu_active_border_color"]!=""):
			if($theme_options["menu_active_border_color"]=="none"): ?>
			border-bottom: none;
			<?php else: ?>
			border-bottom: 2px solid #<?php echo $theme_options["menu_active_border_color"] ?>;
			<?php endif;
		endif;?>
	}
	<?php endif;
	if($theme_options["menu_hover_color"]!=""): ?>
	.sf-menu li:hover a
	{
		color: #<?php echo $theme_options["menu_hover_color"] ?>;
	}
	<?php endif; 
	if($theme_options["menu_hover_border_color"]!=""): ?>
	.sf-menu li:hover a
	{
		<?php if($theme_options["menu_hover_border_color"]=="none"): ?>
		border-bottom: none;
		<?php else: ?>
		border-bottom: 2px solid #<?php echo $theme_options["menu_hover_border_color"] ?>;
		<?php endif; ?>
	}
	<?php endif; 
	if($theme_options["submenu_background_color"]!=""): ?>
	.sf-menu li ul li,
	.sf-menu li ul li a
	{
		background-color: #<?php echo $theme_options["submenu_background_color"] ?>;
	}
	<?php endif; 
	if($theme_options["submenu_hover_background_color"]!=""): ?>
	.sf-menu li ul li a:hover, .sf-menu li ul li.selected a
	{
		background-color: #<?php echo $theme_options["submenu_hover_background_color"] ?>;
	}
	<?php endif; 
	if($theme_options["submenu_color"]!=""): ?>
	.sf-menu li ul li a, .sf-menu li:hover ul li a
	{
		color: #<?php echo $theme_options["submenu_color"] ?>;
	}
	<?php endif; 
	if($theme_options["submenu_hover_color"]!=""): ?>
	.sf-menu li ul li a:hover, .sf-menu li ul li.selected a
	{
		color: #<?php echo $theme_options["submenu_hover_color"] ?>;
	}
	<?php endif;
	if($theme_options["mobile_menu_link_color"]!=""): ?>
	.mobile_menu>ul li a,
	.mobile_menu>ul li.current-menu-ancestor ul a,
	.mobile_menu>ul li.current-menu-ancestor ul li.current-menu-parent ul a,
	.mobile_menu>ul li.current-menu-ancestor ul li.current-menu-parent ul li.current-menu-parent ul a
	{
		color: #<?php echo $theme_options["mobile_menu_link_color"] ?>;
	}
	<?php endif;
	if($theme_options["mobile_menu_position_background_color"]!=""): ?>
	.mobile_menu>ul li a,
	.mobile_menu>ul li.current-menu-ancestor ul a,
	.mobile_menu>ul li.current-menu-ancestor ul li.current-menu-parent ul a,
	.mobile_menu>ul li.current-menu-ancestor ul li.current-menu-parent ul li.current-menu-parent ul a
	{
		background-color: #<?php echo $theme_options["mobile_menu_position_background_color"] ?>;
	}
	<?php endif;
	if($theme_options["mobile_menu_active_link_color"]!=""): ?>
	.mobile_menu>ul li.current-menu-item>a,
	.mobile_menu>ul li.current-menu-ancestor ul li.current-menu-item a,
	.mobile_menu>ul li.current-menu-ancestor ul li.current-menu-parent ul li.current-menu-item a,
	.mobile_menu>ul li.current-menu-ancestor a,
	.mobile_menu>ul li.current-menu-ancestor ul li.current-menu-parent a,
	.mobile_menu>ul li.current-menu-ancestor ul li.current-menu-parent ul li.current-menu-parent a
	{
		color: #<?php echo $theme_options["mobile_menu_active_link_color"] ?>;
	}
	<?php endif;
	if($theme_options["mobile_menu_active_position_background_color"]!=""): ?>
	.mobile_menu>ul li.current-menu-item>a,
	.mobile_menu>ul li.current-menu-ancestor ul li.current-menu-item a,
	.mobile_menu>ul li.current-menu-ancestor ul li.current-menu-parent ul li.current-menu-item a,
	.mobile_menu>ul li.current-menu-ancestor a,
	.mobile_menu>ul li.current-menu-ancestor ul li.current-menu-parent a,
	.mobile_menu>ul li.current-menu-ancestor ul li.current-menu-parent ul li.current-menu-parent a
	{
		background-color: #<?php echo $theme_options["mobile_menu_active_position_background_color"] ?>;
	}
	<?php endif;
	if($theme_options["form_hint_color"]!=""): ?>
	input[type='text'].hint,
	textarea.hint
	{
		color: #<?php echo $theme_options["form_hint_color"]; ?> !important;
	}
	::-webkit-input-placeholder
	{
		color: #<?php echo $theme_options["form_hint_color"]; ?> !important;
	}
	:-moz-placeholder
	{
		color: #<?php echo $theme_options["form_hint_color"]; ?> !important;
	}
	::-moz-placeholder
	{
		color: #<?php echo $theme_options["form_hint_color"]; ?> !important;
	}
	:-ms-input-placeholder
	{
		color: #<?php echo $theme_options["form_hint_color"]; ?> !important;
	}
	<?php endif; 
	if($theme_options["form_field_text_color"]!=""): ?>
	.search input,
	.comment_form input, .comment_form textarea,
	.contact_form input, .contact_form textarea
	<?php
	if(is_plugin_active('woocommerce/woocommerce.php')):
	?>
	,
	.woocommerce .widget_product_search form .search-field,
	.woocommerce-cart table.cart td.actions .coupon .input-text#coupon_code,
	.woocommerce form .form-row input.input-text,
	.woocommerce form .form-row textarea,
	.woocommerce #review_form_wrapper .comment-form-comment #comment
	<?php
	endif;
	?>
	{
		color: #<?php echo $theme_options["form_field_text_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["form_field_border_color"]!=""): ?>
	.search input,
	.comment_form input, .comment_form textarea,
	.contact_form input, .contact_form textarea
	<?php
	if(is_plugin_active('woocommerce/woocommerce.php')):
	?>
	,
	.woocommerce .widget_product_search form .search-field,
	.woocommerce-cart table.cart td.actions .coupon .input-text#coupon_code,
	.woocommerce form .form-row input.input-text,
	.woocommerce form .form-row textarea,
	.woocommerce #review_form_wrapper .comment-form-comment #comment,
	.woocommerce .quantity .qty,
	.woocommerce .quantity .plus,
	.woocommerce .quantity .minus
	<?php
	endif;
	?>
	{
		<?php if($theme_options["form_field_border_color"]=="none"): ?>
		border: none;
		<?php else: ?>
		border: 1px solid #<?php echo $theme_options["form_field_border_color"] ?>;
		<?php endif; ?>
	}
	<?php endif; 
	if($theme_options["form_field_active_border_color"]!=""): ?>
	.search .search_input:focus,
	.comment_form .text_input:focus, .comment_form textarea:focus,
	.contact_form .text_input:focus, .contact_form textarea:focus
	<?php
	if(is_plugin_active('woocommerce/woocommerce.php')):
	?>
	,
	.woocommerce .widget_product_search form .search-field:focus,
	.woocommerce-cart table.cart td.actions .coupon .input-text#coupon_code:focus,
	.woocommerce form .form-row input.input-text:focus,
	.woocommerce form .form-row textarea:focus,
	.woocommerce #review_form_wrapper .comment-form-comment #comment:focus,	
	.woocommerce-cart table.cart td.actions .coupon .input-text#coupon_code:focus
	<?php
	endif;
	?>
	{
		<?php if($theme_options["form_field_active_border_color"]=="none"): ?>
		border: none;
		<?php else: ?>
		border: 1px solid #<?php echo $theme_options["form_field_active_border_color"] ?>;
		<?php endif; ?>
	}
	<?php endif; 
	if($theme_options["link_color"]!=""): ?>
	a,
	.scrolling_list.latest_tweets li a,
	.items_list a,
	.scrolling_list li a,
	.footer .scrolling_list li a
	<?php
	if(is_plugin_active('woocommerce/woocommerce.php')):
	?>
	.woocommerce-message a,
	.woocommerce-info a,
	.woocommerce-error a,
	.woocommerce-review-link,
	.woocommerce-checkout #payment .payment_method_paypal .about_paypal,
	.woocommerce a.remove
	<?php
	endif;
	?>
	{
		color: #<?php echo $theme_options["link_color"]; ?> !important;
	}
	<?php endif; 
	if($theme_options["link_hover_color"]!=""): ?>
	a:hover,
	.scrolling_list.latest_tweets li a:hover,
	.scrolling_list li a:hover,
	.footer .scrolling_list li a:hover	
	{
		color: #<?php echo $theme_options["link_hover_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["link_hover_color"]!="" && is_plugin_active('woocommerce/woocommerce.php')):
	?>
	.woocommerce a.remove:hover
	{
		background-color: #<?php echo $theme_options["link_hover_color"]; ?>;
	}
	<?php
	endif;
	if($theme_options["date_box_color"]!="" || $theme_options["date_box_text_color"]!="") : ?>
	.comment_box .first_row
	{
		<?php if($theme_options["date_box_color"]!=""): ?>
		background-color: #<?php echo $theme_options["date_box_color"]; ?>;
		<?php endif;
		if($theme_options["date_box_text_color"]!=""): ?>
		color: #<?php echo $theme_options["date_box_text_color"]; ?>;
		<?php endif; ?>
	}
	<?php endif;
	if($theme_options["date_box_color"]!="" && is_plugin_active('woocommerce/woocommerce.php')):
	?>
	.woocommerce span.onsale,
	.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
	.woocommerce mark,
	.cart_items_number
	{
		background-color: #<?php echo $theme_options["date_box_color"]; ?>;
	}
	<?php
	endif;
	if($theme_options["date_box_color"]!="" && is_plugin_active('woocommerce/woocommerce.php')):
	?>
	.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
	.woocommerce .woocommerce-error,
	.woocommerce .woocommerce-info,
	.woocommerce .woocommerce-message
	{
		border-color: #<?php echo $theme_options["date_box_color"]; ?>;
	}
	<?php
	endif;
	if($theme_options["date_box_comments_number_text_color"]!=""): ?>
	.comment_box .comments_number
	{
		color: #<?php echo $theme_options["date_box_comments_number_text_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["date_box_comments_number_border_color"]!=""): ?>
	.comment_box .comments_number
	{
		<?php if($theme_options["date_box_comments_number_border_color"]=="none"): ?>
		border: none;
		<?php else: ?>
		border-bottom: 1px solid #<?php echo $theme_options["date_box_comments_number_border_color"] ?>;
		<?php endif; ?>
	}
	<?php endif; 
	if($theme_options["date_box_comments_number_hover_border_color"]!=""): ?>
	.comment_box .comments_number:hover
	{
		<?php if($theme_options["date_box_comments_number_hover_border_color"]=="none"): ?>
		border: none;
		<?php else: ?>
		border-bottom: 1px solid #<?php echo $theme_options["date_box_comments_number_hover_border_color"] ?>;
		<?php endif; ?>
	}
	<?php endif; 
	if($theme_options["gallery_box_color"]!=""): ?>
	.gallery_box .description
	{
		background-color: #<?php echo $theme_options["gallery_box_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["gallery_box_text_first_line_color"]!=""): ?>
	.gallery_box h3
	{
		color: #<?php echo $theme_options["gallery_box_text_first_line_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["gallery_box_text_second_line_color"]!=""): ?>
	.gallery_box .description h5
	{
		color: #<?php echo $theme_options["gallery_box_text_second_line_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["gallery_box_hover_color"]!=""): ?>
	.gallery_box:hover .description
	{
		background-color: #<?php echo $theme_options["gallery_box_hover_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["gallery_box_hover_text_first_line_color"]!=""): ?>
	.gallery_box:hover h3
	{
		color: #<?php echo $theme_options["gallery_box_hover_text_first_line_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["gallery_box_hover_text_second_line_color"]!=""): ?>
	.gallery_box:hover .description h5
	{
		color: #<?php echo $theme_options["gallery_box_hover_text_second_line_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["timetable_box_color"]!=""): ?>
	.timetable .event
	{
		background-color: #<?php echo $theme_options["timetable_box_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["timetable_box_hover_color"]!=""): ?>
	.timetable .event:hover
	{
		background-color: #<?php echo $theme_options["timetable_box_hover_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["gallery_details_box_border_color"]!=""): ?>
	.gallery_item_details_list .details_box
	{
		<?php if($theme_options["gallery_details_box_border_color"]=="none"): ?>
		border: none;
		<?php else: ?>
		border-top: 2px solid #<?php echo $theme_options["gallery_details_box_border_color"] ?>;
		border-bottom: 2px solid #<?php echo $theme_options["gallery_details_box_border_color"] ?>;
		<?php endif; ?>
	}
	<?php endif; 
	if($theme_options["bread_crumb_border_color"]!=""): ?>
	.bread_crumb
	{
		<?php if($theme_options["bread_crumb_border_color"]=="none"): ?>
		border: none;
		<?php else: ?>
		border-top: 1px solid #<?php echo $theme_options["bread_crumb_border_color"] ?>;
		border-bottom: 1px solid #<?php echo $theme_options["bread_crumb_border_color"] ?>;
		<?php endif; ?>
	}
	<?php endif; 
	if($theme_options["accordion_item_border_color"]!=""): ?>
	.accordion .ui-accordion-header,
	.ui-accordion-header
	{
		<?php if($theme_options["accordion_item_border_color"]=="none"): ?>
		border: none;
		<?php else: ?>
		border-bottom: 1px solid #<?php echo $theme_options["accordion_item_border_color"] ?>;
		<?php endif; ?>
	}
	<?php endif; 
	if($theme_options["accordion_item_border_hover_color"]!=""): ?>
	.accordion .ui-accordion-header.ui-state-hover,
	.ui-accordion-header.ui-state-hover
	{
		<?php if($theme_options["accordion_item_border_hover_color"]=="none"): ?>
		border: none;
		<?php else: ?>
		border-bottom: 1px solid #<?php echo $theme_options["accordion_item_border_hover_color"] ?>;
		<?php endif; ?>
	}
	<?php endif; 
	if($theme_options["accordion_item_border_active_color"]!=""): ?>
	.accordion .ui-accordion-header.ui-state-active,
	.ui-accordion-header.ui-state-active
	{
		<?php if($theme_options["accordion_item_border_active_color"]=="none"): ?>
		border: none;
		<?php else: ?>
		border-bottom: 2px solid #<?php echo $theme_options["accordion_item_border_active_color"] ?>;
		<?php endif; ?>
	}
	<?php endif; 
	if($theme_options["copyright_area_border_color"]!=""): ?>
	.copyright_area
	{
		<?php if($theme_options["copyright_area_border_color"]=="none"): ?>
		border: none;
		<?php else: ?>
		border-top: 1px solid #<?php echo $theme_options["copyright_area_border_color"] ?>;
		<?php endif; ?>
	}
	<?php endif;
	if($theme_options["top_hint_background_color"]!=""): ?>
	.top_hint
	{
		background-color: #<?php echo $theme_options["top_hint_background_color"]; ?>;
	}
	<?php endif;
	if($theme_options["top_hint_text_color"]!=""): ?>
	.top_hint
	{
		color: #<?php echo $theme_options["top_hint_text_color"]; ?>;
	}
	<?php endif;
	if($theme_options["comment_reply_button_color"]!=""): ?>
	#comments_list .reply_button
	{
		color: #<?php echo $theme_options["comment_reply_button_color"]; ?>;
	}
	<?php endif;
	if($theme_options["post_author_link_color"]!=""): ?>
	.categories li.posted_by .author,
	#comments_list .comment_details .posted_by a
	{
		color: #<?php echo $theme_options["post_author_link_color"]; ?>;
	}
	<?php endif;
	if($theme_options["contact_details_box_background_color"]!=""): ?>
	.contact_details_about
	{
		background-color: #<?php echo $theme_options["contact_details_box_background_color"]; ?>;
	}
	<?php endif;
	if($theme_options["header_font"]!=""): $header_font_explode = explode(":", $theme_options["header_font"]); ?>
	h1, h2, h3, h4, h5,
	.header_left a, .logo_left, .logo_right	
	{
		font-family: '<?php echo $header_font_explode[0]; ?>';
	}
	<?php endif;
	if($theme_options["subheader_font"]!=""): $subheader_font_explode = explode(":", $theme_options["subheader_font"]); ?>
	.sentence,
	.info_green, .info_white,
	.page_header h4,
	.slider_content .subtitle,
	.home_box h3,
	.accordion .ui-accordion-header h5,
	.gallery_box .description h5,
	.gallery_item_details_list .details_box .subheader,
	.footer_banner_box h3
	{
		font-family: '<?php echo $subheader_font_explode[0]; ?>';
	}
	<?php endif; ?>
</style>