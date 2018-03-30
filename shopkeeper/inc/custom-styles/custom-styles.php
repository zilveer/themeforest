<?php
if ( !function_exists ('shopkeeper_custom_styles') ) {
function shopkeeper_custom_styles() {	
	global $post, $shopkeeper_theme_options;	
	
	//convert hex to rgb
	function getbowtied_hex2rgb($hex) {
		$hex = str_replace("#", "", $hex);
		
		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		$rgb = array($r, $g, $b);
		return implode(",", $rgb); // returns the rgb values separated by commas
		//return $rgb; // returns an array with the rgb values
	}
	
	ob_start();	
	?>
	
	<!-- ******************************************************************** -->
	<!-- * Theme Options Styles ********************************************* -->
	<!-- ******************************************************************** -->
		
	<style>
		
		/***************************************************************/
		/* Body ********************************************************/
		/***************************************************************/
		
		.st-content {			
			<?php if ( (isset($shopkeeper_theme_options['main_background']['background-color'])) ) : ?>
			background-color:<?php echo esc_html($shopkeeper_theme_options['main_background']['background-color']); ?>;
			<?php endif; ?>
			
			<?php if ( (isset($shopkeeper_theme_options['main_background']['background-image'])) && ($shopkeeper_theme_options['main_background']['background-image'] != "") ) : ?>
			background-image:url(<?php echo esc_url($shopkeeper_theme_options['main_background']['background-image']); ?>);
			<?php endif; ?>
			
			<?php if ( (isset($shopkeeper_theme_options['main_background']['background-repeat'])) ) : ?>
			background-repeat:<?php echo esc_html($shopkeeper_theme_options['main_background']['background-repeat']); ?>;
			<?php endif; ?>
			
			<?php if ( (isset($shopkeeper_theme_options['main_background']['background-position'])) ) : ?>
			background-position:<?php echo esc_html($shopkeeper_theme_options['main_background']['background-position']); ?>;
			<?php endif; ?>
			
			<?php if ( (isset($shopkeeper_theme_options['main_background']['background-size'])) ) : ?>
			background-size:<?php echo esc_html($shopkeeper_theme_options['main_background']['background-size']); ?>;
			<?php endif; ?>
			
			<?php if ( (isset($shopkeeper_theme_options['main_background']['background-attachment'])) ) : ?>
			background-attachment:<?php echo esc_html($shopkeeper_theme_options['main_background']['background-attachment']); ?>;
			<?php endif; ?>
		}
		
		/***************************************************************/
		/* Fonts *******************************************************/
		/***************************************************************/
		
		<?php //if ( (isset($shopkeeper_theme_options['main_font']['font-family'])) && (trim($shopkeeper_theme_options['main_font']['font-family']) != "" ) ) : ?>			
			h1, h2, h3, h4, h5, h6,
			.comments-title,
			.comment-author,
			#reply-title,
			#site-footer .widget-title,
			.accordion_title,
			.ui-tabs-anchor,
			.products .button,
			.site-title a,
			.post_meta_archive a,
			.post_meta a,
			.post_tags a,
			 #nav-below a,
			.list_categories a,
			.list_shop_categories a,
			.main-navigation > ul > li > a,
			.main-navigation .mega-menu > ul > li > a,
			.more-link,
			.top-page-excerpt,
			.select2-search input,
			.product_after_shop_loop_buttons a,
			.woocommerce .products-grid a.button,
			.page-numbers,
			input.qty,
			.button,
			button,
			.button_text,
			input[type="button"],
			input[type="reset"],
			input[type="submit"],
			.woocommerce a.button,
			.woocommerce-page a.button,
			.woocommerce button.button,
			.woocommerce-page button.button,
			.woocommerce input.button,
			.woocommerce-page input.button,
			.woocommerce #respond input#submit,
			.woocommerce-page #respond input#submit,
			.woocommerce #content input.button,
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
			.yith-wcwl-wishlistexistsbrowse.show a,
			.share-product-text,
			.tabs > li > a,
			label,
			.comment-respond label,
			.product_meta_title,
			.woocommerce table.shop_table th, 
			.woocommerce-page table.shop_table th,
			#map_button,
			.coupon_code_text,
			.woocommerce .cart-collaterals .cart_totals tr.order-total td strong,
			.woocommerce-page .cart-collaterals .cart_totals tr.order-total td strong,
			.cart-wishlist-empty,
			.return-to-shop .wc-backward,
			.order-number a,
			.account_view_link,
			.post-edit-link,
			.from_the_blog_title,
			.icon_box_read_more,
			.vc_pie_chart_value,
			.shortcode_banner_simple_bullet,
			.shortcode_banner_simple_height_bullet,
			.category_name,
			.woocommerce span.onsale,
			.woocommerce-page span.onsale,
			.out_of_stock_badge_single,
			.out_of_stock_badge_loop,
			.page-numbers,
			.page-links,
			.add_to_wishlist,
			.yith-wcwl-wishlistaddedbrowse,
			.yith-wcwl-wishlistexistsbrowse,
			.filters-group,
			.product-name,
			.woocommerce-page .my_account_container table.shop_table.order_details_footer tr:last-child td:last-child .amount,
			.customer_details dt,
			.widget h3,
			.widget ul a,
			.widget a,
			.widget .total .amount,
			.wishlist-in-stock,
			.wishlist-out-of-stock,
			.comment-reply-link,
			.comment-edit-link,
			.widget_calendar table thead tr th,
			.page-type,
			.mobile-navigation a,
			table thead tr th,
			.portfolio_single_list_cat,
			.portfolio-categories,
			.shipping-calculator-button,
			.vc_btn,
			.vc_btn2,
			.vc_btn3,
			.offcanvas-menu-button .menu-button-text,
			.account-tab-item .account-tab-link,
			.account-tab-list .sep,
			ul.order_details li span,
			ul.order_details.bacs_details li,
			.widget_calendar caption,
			.widget_recent_comments li a,
			.edit-account legend,
			.widget_shopping_cart li.empty,
			.cart-collaterals .cart_totals .shop_table .order-total .woocommerce-Price-amount,
			.woocommerce table.cart .cart_item td a, 
			.woocommerce #content table.cart .cart_item td a, 
			.woocommerce-page table.cart .cart_item td a, 
			.woocommerce-page #content table.cart .cart_item td a,
			.woocommerce table.cart .cart_item td span, 
			.woocommerce #content table.cart .cart_item td span, 
			.woocommerce-page table.cart .cart_item td span, 
			.woocommerce-page #content table.cart .cart_item td span,
			.woocommerce-MyAccount-navigation ul li 
			{ 
				font-family: 
				<?php if ($shopkeeper_theme_options['font_source'] == "3") echo '\'' . $shopkeeper_theme_options['main_typekit_font_face'] . '\','; ?>
				<?php if ($shopkeeper_theme_options['font_source'] == "2") echo '\'' . $shopkeeper_theme_options['main_google_font_face'] . '\','; ?>
				<?php if ($shopkeeper_theme_options['font_source'] == "1") echo '\'' . $shopkeeper_theme_options['main_font']['font-family'] . '\','; ?> 
				sans-serif;
			}			
		<?php //endif; ?>
		
		<?php //if ( (isset($shopkeeper_theme_options['secondary_font']['font-family'])) && (trim($shopkeeper_theme_options['secondary_font']['font-family']) != "" ) ) : ?>
			body,
			p,
			#site-navigation-top-bar,
			.site-title,
			.widget_product_search #searchsubmit,
			.widget_search #searchsubmit,
			.widget_product_search .search-submit,
			.widget_search .search-submit,
			#site-menu,
			.copyright_text,
			blockquote cite,
			table thead th,
			.recently_viewed_in_single h2,
			.woocommerce .cart-collaterals .cart_totals table th,
			.woocommerce-page .cart-collaterals .cart_totals table th,
			.woocommerce .cart-collaterals .shipping_calculator h2,
			.woocommerce-page .cart-collaterals .shipping_calculator h2,
			.woocommerce table.woocommerce-checkout-review-order-table tfoot th,
			.woocommerce-page table.woocommerce-checkout-review-order-table tfoot th,
			.qty,
			.shortcode_banner_simple_inside h4,
			.shortcode_banner_simple_height h4,
			.fr-caption,
			.post_meta_archive,
			.post_meta,
			.page-links-title,
			.yith-wcwl-wishlistaddedbrowse .feedback,
			.yith-wcwl-wishlistexistsbrowse .feedback,
			.product-name span,
			.widget_calendar table tbody a,
			.fr-touch-caption-wrapper,
			.woocommerce .login-register-container p.form-row.remember-me-row label,
			.woocommerce .checkout_login p.form-row label[for="rememberme"],
			.woocommerce .checkout_login p.lost_password,
			.form-row.remember-me-row a,
			.wpb_widgetised_column aside ul li span.count,
			.woocommerce td.product-name dl.variation dt, 
			.woocommerce td.product-name dl.variation dd, 
			.woocommerce td.product-name dl.variation dt p, 
			.woocommerce td.product-name dl.variation dd p, 
			.woocommerce-page td.product-name dl.variation dt, 
			.woocommerce-page td.product-name dl.variation dd p, 
			.woocommerce-page td.product-name dl.variation dt p, 
			.woocommerce-page td.product-name dl.variation dd p,
			.woocommerce span.amount,
			.woocommerce ul#shipping_method label,
			.woocommerce .select2-container,
			.check_label,
			.woocommerce-page #payment .terms label,
			ul.order_details li strong,
			.woocommerce-order-received .woocommerce table.shop_table tfoot th, 
			.woocommerce-order-received .woocommerce-page table.shop_table tfoot th,
			.woocommerce-view-order .woocommerce table.shop_table tfoot th, 
			.woocommerce-view-order .woocommerce-page table.shop_table tfoot th,
			.widget_recent_comments li,
			.widget_shopping_cart p.total,
			.widget_shopping_cart p.total .amount,
			.mobile-navigation li ul li a,
			.woocommerce table.cart .cart_item td:before, 
			.woocommerce #content table.cart .cart_item td:before, 
			.woocommerce-page table.cart .cart_item td:before, 
			.woocommerce-page #content table.cart .cart_item td:before
			{
				font-family: 
				<?php if ($shopkeeper_theme_options['font_source'] == "3") echo '\'' . $shopkeeper_theme_options['secondary_typekit_font_face'] . '\','; ?>
				<?php if ($shopkeeper_theme_options['font_source'] == "2") echo '\'' . $shopkeeper_theme_options['secondary_google_font_face'] . '\','; ?>
				<?php if ($shopkeeper_theme_options['font_source'] == "1") echo '\'' . $shopkeeper_theme_options['secondary_font']['font-family'] . '\','; ?> 
				sans-serif;
			}			
		<?php //endif; ?>
		
		
		
		
		/***************************************************************/
		/* Body Text Colors  *******************************************/
		/***************************************************************/
		
		<?php if ( (isset($shopkeeper_theme_options['body_color'])) && (trim($shopkeeper_theme_options['body_color']) != "" ) ) : ?>
		body,
		table tr th,
		table tr td,
		table thead tr th,
		blockquote p,
		label,
		.woocommerce .woocommerce-breadcrumb a,
		.woocommerce-page .woocommerce-breadcrumb a,
		.select2-dropdown-open.select2-drop-above .select2-choice,
		.select2-dropdown-open.select2-drop-above .select2-choices, 
		.select2-container .select2-choice,
		.select2-container,
		.big-select,
		.select.big-select,
		.list-centered li a,
		.post_meta_archive a,
		.post_meta a,
		.nav-next a,
		.nav-previous a,
		.blog-single h6,
		.page-description,
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
		.woocommerce table.shop_table th,
		.woocommerce-page table.shop_table th,
		.woocommerce .cart-collaterals .cart_totals h2,
		.woocommerce .cart-collaterals .cross-sells h2,
		.woocommerce-page .cart-collaterals .cart_totals h2,
		.woocommerce .cart-collaterals .cart_totals table tr.order-total td:last-child,
		.woocommerce-page .cart-collaterals .cart_totals table tr.order-total td:last-child,
		.woocommerce-checkout .woocommerce-info,
		.woocommerce-checkout h3,
		.woocommerce-checkout h2,
		.woocommerce-account h2,
		.woocommerce-account h3,
		.customer_details dt,
		/*.wpb_widgetised_column .widget:hover a,*/
		.wpb_widgetised_column .widget a,
		.wpb_widgetised_column .widget.widget_product_categories a:hover,
		.wpb_widgetised_column .widget.widget_layered_nav a:hover,
		.wpb_widgetised_column .widget.widget_layered_nav li,
		.portfolio_single_list_cat a,
		.gallery-caption-trigger,
		.woocommerce .widget_layered_nav ul li.chosen a,
		.woocommerce-page .widget_layered_nav ul li.chosen a,
		.widget_layered_nav ul li.chosen a,
		.woocommerce .widget_product_categories ul li.current-cat > a,
		.woocommerce-page .widget_product_categories ul li.current-cat > a,
		.widget_product_categories ul li.current-cat > a,
		.wpb_widgetised_column .widget.widget_layered_nav_filters a,
		.woocommerce-cart .cart-collaterals .cart_totals table .order-total td .amount,
		.widget_shopping_cart p.total,
		.widget_shopping_cart p.total .amount,
		.wpb_widgetised_column .widget_shopping_cart li.empty
		{
			color: <?php echo esc_html($shopkeeper_theme_options['body_color']); ?>;
		}
		
		.woocommerce a.remove
		{
			color: <?php echo esc_html($shopkeeper_theme_options['body_color']); ?> !important;
		}
		
		.nav-previous-title,
		.nav-next-title,
		.post_tags a,
		.wpb_widgetised_column .tagcloud a,
		.products .add_to_wishlist:before
		{
			color: rgba(<?php echo getbowtied_hex2rgb($shopkeeper_theme_options['body_color']); ?>,0.4);
		}
		
		.required/*,
		.woocommerce a.remove*/
		{
			color: rgba(<?php echo getbowtied_hex2rgb($shopkeeper_theme_options['body_color']); ?>,0.4) !important;
		}
		
		.yith-wcwl-add-button,
		.yith-wcwl-wishlistaddedbrowse,
		.yith-wcwl-wishlistexistsbrowse,
		.share-product-text,
		.product_meta .sku,
		.product_meta a,
		.product_meta_separator,
		.woocommerce table.shop_attributes td,
		.woocommerce-page table.shop_attributes td,
		.woocommerce .woocommerce-breadcrumb,
		.woocommerce-page .woocommerce-breadcrumb,
		.tob_bar_shop,
		.post_meta_archive,
		.post_meta,
		del,
		.woocommerce .cart-collaterals .cart_totals table tr td:last-child,
		.woocommerce-page .cart-collaterals .cart_totals table tr td:last-child,
		.product-name .product-quantity,
		.woocommerce #payment div.payment_box,
		.wpb_widgetised_column .widget li,
		.wpb_widgetised_column .widget_calendar table thead tr th,
		.wpb_widgetised_column .widget_calendar table thead tr td,
		.wpb_widgetised_column .widget .post-date,
		.wpb_widgetised_column .recentcomments,
		.wpb_widgetised_column .amount,
		.wpb_widgetised_column .quantity,
		.products li:hover .add_to_wishlist:before,
		.product_after_shop_loop .price,
		.product_after_shop_loop .price ins,
		.wpb_wrapper .add_to_cart_inline del,
		.wpb_widgetised_column .widget_price_filter .price_slider_amount,
		.woocommerce td.product-name dl.variation dt, 
		.woocommerce td.product-name dl.variation dd, 
		.woocommerce td.product-name dl.variation dt p, 
		.woocommerce td.product-name dl.variation dd p, 
		.woocommerce-page td.product-name dl.variation dt, 
		.woocommerce-page td.product-name dl.variation dd p, 
		.woocommerce-page td.product-name dl.variation dt p, 
		.woocommerce-page td.product-name dl.variation dd p
		{
			color: rgba(<?php echo getbowtied_hex2rgb($shopkeeper_theme_options['body_color']); ?>,0.55);
		}
		
		.products a.button.add_to_cart_button.loading
		{
			color: rgba(<?php echo getbowtied_hex2rgb($shopkeeper_theme_options['body_color']); ?>,0.55) !important;
		}
		
		.add_to_cart_inline .amount,
		.wpb_widgetised_column .widget,
		.wpb_widgetised_column .widget a:hover,
		.wpb_widgetised_column .widget.widget_product_categories a,
		.wpb_widgetised_column .widget.widget_layered_nav a,
		.widget_layered_nav ul li a,
		.widget_layered_nav,
		.wpb_widgetised_column aside ul li span.count,
		.shop_table.cart .product-price .amount,
		.woocommerce-cart .cart-collaterals .cart_totals table th,
		.woocommerce-cart .cart-collaterals .cart_totals table td,
		.woocommerce-cart .cart-collaterals .cart_totals table td .amount,
		.woocommerce ul#shipping_method label
		{
			color: rgba(<?php echo getbowtied_hex2rgb($shopkeeper_theme_options['body_color']); ?>,0.8);
		}
		
		input[type="text"],
		input[type="password"],
		input[type="date"],
		input[type="datetime"],
		input[type="datetime-local"],
		input[type="month"], input[type="week"],
		input[type="email"], input[type="number"],
		input[type="search"], input[type="tel"],
		input[type="time"], input[type="url"],
		textarea,
		select,
		.chosen-container-single .chosen-single,
		.country_select.select2-container,
		.woocommerce form .form-row.woocommerce-validated .select2-container,
		.woocommerce form .form-row.woocommerce-validated input.input-text,
		.woocommerce form .form-row.woocommerce-validated select,
		.woocommerce form .form-row.woocommerce-invalid .select2-container,
		.woocommerce form .form-row.woocommerce-invalid input.input-text,
		.woocommerce form .form-row.woocommerce-invalid select,
		.country_select.select2-container,
		.state_select.select2-container,
		#coupon_code
		{
			border-color: rgba(<?php echo getbowtied_hex2rgb($shopkeeper_theme_options['body_color']); ?>,0.1);
		}
		
		input[type="text"]:focus, input[type="password"]:focus,
		input[type="date"]:focus, input[type="datetime"]:focus,
		input[type="datetime-local"]:focus, input[type="month"]:focus,
		input[type="week"]:focus, input[type="email"]:focus,
		input[type="number"]:focus, input[type="search"]:focus,
		input[type="tel"]:focus, input[type="time"]:focus,
		input[type="url"]:focus, textarea:focus,
		select:focus,
		#coupon_code:focus,
		.chosen-container-single .chosen-single:focus,
		.woocommerce .product_infos .quantity input.qty,
		.woocommerce #content .product_infos .quantity input.qty,
		.woocommerce-page .product_infos .quantity input.qty,
		.woocommerce-page #content .product_infos .quantity input.qty,
		.post_tags a,
		.wpb_widgetised_column .tagcloud a,
		.coupon_code_wrapper,
		.woocommerce form.checkout_coupon,
		.woocommerce-page form.checkout_coupon,
		.woocommerce ul.digital-downloads:before,
		.woocommerce-page ul.digital-downloads:before,
		.woocommerce ul.digital-downloads li:after,
		.woocommerce-page ul.digital-downloads li:after,
		.widget_search .search-form,
		.woocommerce .widget_layered_nav ul li a:before,
		.woocommerce-page .widget_layered_nav ul li a:before,
		.widget_layered_nav ul li a:before,
		.woocommerce .widget_product_categories ul li a:before,
		.woocommerce-page .widget_product_categories ul li a:before,
		.widget_product_categories ul li a:before,
		.woocommerce-cart.woocommerce-page #content .quantity input.qty
		{
			border-color: rgba(<?php echo getbowtied_hex2rgb($shopkeeper_theme_options['body_color']); ?>,0.15);
		}
		
		.list-centered li a,
		.woocommerce .cart-collaterals .cart_totals h2,
		.woocommerce .cart-collaterals .cross-sells h2,
		.woocommerce-page .cart-collaterals .cart_totals h2,
		.my_address_title,
		.woocommerce .shop_table.order_details tbody tr:last-child td,
		.woocommerce-page .shop_table.order_details tbody tr:last-child td,
		.woocommerce #payment ul.payment_methods li,
		.woocommerce-page #payment ul.payment_methods li,
		.comment-separator,
		.comment-list .pingback,
		.wpb_widgetised_column .widget,
		.search_result_item,
		.woocommerce div.product .woocommerce-tabs ul.tabs li:after,
		.woocommerce #content div.product .woocommerce-tabs ul.tabs li:after,
		.woocommerce-page div.product .woocommerce-tabs ul.tabs li:after,
		.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li:after,
		.woocommerce .cart-collaterals .cart_totals .order-total td,
		.woocommerce .cart-collaterals .cart_totals .order-total th,
		.woocommerce-page .cart-collaterals .cart_totals .order-total td,
		.woocommerce-page .cart-collaterals .cart_totals .order-total th
		{
			border-bottom-color: rgba(<?php echo getbowtied_hex2rgb($shopkeeper_theme_options['body_color']); ?>,0.15);
		}
		
		table tr td,
		.woocommerce table.shop_table td,
		.woocommerce-page table.shop_table td,
		.product_socials_wrapper,
		.woocommerce-tabs,
		.comments_section,
		.portfolio_content_nav #nav-below,
		.woocommerce .cart-collaterals .cart_totals .order-total td,
		.woocommerce .cart-collaterals .cart_totals .order-total th,
		.woocommerce-page .cart-collaterals .cart_totals .order-total td,
		.woocommerce-page .cart-collaterals .cart_totals .order-total th
		{
			border-top-color: rgba(<?php echo getbowtied_hex2rgb($shopkeeper_theme_options['body_color']); ?>,0.15);
		}
		
		table.shop_attributes tr td,
		.wishlist_table tr td,
		.shop_table.cart tr td
		{
			border-bottom-color: rgba(<?php echo getbowtied_hex2rgb($shopkeeper_theme_options['body_color']); ?>,0.1);
		}
		
		.product_meta,
		.woocommerce .cart-collaterals,
		.woocommerce-page .cart-collaterals,
		.checkout_right_wrapper,
		.track_order_form,
		.order-info
		{
			background: rgba(<?php echo getbowtied_hex2rgb($shopkeeper_theme_options['body_color']); ?>,0.05);
		}
		
		.woocommerce-cart .cart-collaterals:before,
		.woocommerce-cart .cart-collaterals:after,
		.custom_border:before,
		.custom_border:after
		{
			background-image: radial-gradient(closest-side, transparent 9px, rgba(<?php echo getbowtied_hex2rgb($shopkeeper_theme_options['body_color']); ?>,0.05) 100%);
		}
		
		.actions .button,
		.actions .coupon .button
		{
			background: rgba(<?php echo getbowtied_hex2rgb($shopkeeper_theme_options['body_color']); ?>,0.55) !important;
		}
		
		.actions .button:hover,
		.actions .coupon .button:hover
		{
			background: rgba(<?php echo getbowtied_hex2rgb($shopkeeper_theme_options['body_color']); ?>,0.44) !important;
		}

		.wpb_widgetised_column aside ul li span.count
		{
			background: rgba(<?php echo getbowtied_hex2rgb($shopkeeper_theme_options['body_color']); ?>,0.05);
		}

		/*.wpb_widgetised_column aside ul li span.count
		{
			border-color: rgba(<?php echo getbowtied_hex2rgb($shopkeeper_theme_options['body_color']); ?>,0.05);
		}*/
		
		.comments_section
		{
			background-color: rgba(<?php echo getbowtied_hex2rgb($shopkeeper_theme_options['body_color']); ?>,0.01) !important;
		}
		
		<?php endif; ?>
		
		<?php if ( (isset($shopkeeper_theme_options['headings_color'])) && (trim($shopkeeper_theme_options['headings_color']) != "" ) ) : ?>
		h1, h2, h3, h4, h5, h6,
		.entry-title-archive a,
		.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active a,
		.woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
		.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active a,
		.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active a,
		.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active a:hover,
		.woocommerce div.product .woocommerce-tabs ul.tabs li.active a:hover,
		.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active a:hover,
		.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active a:hover,
		.woocommerce table.cart .product-name a,
		.product-title-link,
		.wpb_widgetised_column .widget .product_list_widget a
		{
			color: <?php echo esc_html($shopkeeper_theme_options['headings_color']); ?>;
		}
		
		.woocommerce div.product .woocommerce-tabs ul.tabs li a,
		.woocommerce #content div.product .woocommerce-tabs ul.tabs li a,
		.woocommerce-page div.product .woocommerce-tabs ul.tabs li a,
		.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a
		{
			color: rgba(<?php echo getbowtied_hex2rgb($shopkeeper_theme_options['headings_color']); ?>,0.35);
		}
		
		.woocommerce #content div.product .woocommerce-tabs ul.tabs li a:hover,
		.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover,
		.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a:hover,
		.woocommerce-page div.product .woocommerce-tabs ul.tabs li a:hover
		{
			color: rgba(<?php echo getbowtied_hex2rgb($shopkeeper_theme_options['headings_color']); ?>,0.45);
		}
		
		.page-title:after
		{
			background: <?php echo esc_html($shopkeeper_theme_options['headings_color']); ?>;
		}
		
		<?php endif; ?>
		
		
		
		
		/***************************************************************/
		/* Main Color  *************************************************/
		/***************************************************************/
		
		<?php if ( (isset($shopkeeper_theme_options['main_color'])) && (trim($shopkeeper_theme_options['main_color']) != "" ) ) : ?>
		
		a,
		.comments-area a,
		.edit-link,
		.post_meta_archive a:hover,
		.post_meta a:hover,
		.entry-title-archive a:hover,
		blockquote:before,
		.no-results-text:before,
		.list-centered a:hover,
		.comment-reply i,
		.comment-edit-link i,
		.comment-edit-link,
		.filters-group li:hover,
		#map_button,
		.widget_shopkeeper_social_media a,
		.account-tab-link-mobile,
		.lost-reset-pass-text:before,
		.list_shop_categories a:hover,
		.add_to_wishlist:hover,
		.woocommerce div.product span.price,
		.woocommerce-page div.product span.price,
		.woocommerce #content div.product span.price,
		.woocommerce-page #content div.product span.price,
		.woocommerce div.product p.price,
		.woocommerce-page div.product p.price,
		.woocommerce #content div.product p.price,
		.woocommerce-page #content div.product p.price,
		.comment-metadata time,
		.woocommerce p.stars a.star-1.active:after,
		.woocommerce p.stars a.star-1:hover:after,
		.woocommerce-page p.stars a.star-1.active:after,
		.woocommerce-page p.stars a.star-1:hover:after,
		.woocommerce p.stars a.star-2.active:after,
		.woocommerce p.stars a.star-2:hover:after,
		.woocommerce-page p.stars a.star-2.active:after,
		.woocommerce-page p.stars a.star-2:hover:after,
		.woocommerce p.stars a.star-3.active:after,
		.woocommerce p.stars a.star-3:hover:after,
		.woocommerce-page p.stars a.star-3.active:after,
		.woocommerce-page p.stars a.star-3:hover:after,
		.woocommerce p.stars a.star-4.active:after,
		.woocommerce p.stars a.star-4:hover:after,
		.woocommerce-page p.stars a.star-4.active:after,
		.woocommerce-page p.stars a.star-4:hover:after,
		.woocommerce p.stars a.star-5.active:after,
		.woocommerce p.stars a.star-5:hover:after,
		.woocommerce-page p.stars a.star-5.active:after,
		.woocommerce-page p.stars a.star-5:hover:after,
		.yith-wcwl-add-button:before,
		.yith-wcwl-wishlistaddedbrowse .feedback:before,
		.yith-wcwl-wishlistexistsbrowse .feedback:before,
		.woocommerce .star-rating span:before,
		.woocommerce-page .star-rating span:before,
		.product_meta a:hover,
		.woocommerce .shop-has-sidebar .no-products-info .woocommerce-info:before,
		.woocommerce-page .shop-has-sidebar .no-products-info .woocommerce-info:before,
		.woocommerce .woocommerce-breadcrumb a:hover,
		.woocommerce-page .woocommerce-breadcrumb a:hover,
		.intro-effect-fadeout.modify .post_meta a:hover,
		.from_the_blog_link:hover .from_the_blog_title,
		.portfolio_single_list_cat a:hover,
		.widget .recentcomments:before,
		.widget.widget_recent_entries ul li:before,
		#placeholder_product_quick_view .product_title:hover,
		.wpb_widgetised_column aside ul li.current-cat > span.count
		{
			color: <?php echo esc_html($shopkeeper_theme_options['main_color']); ?>;
		}
		
		@media only screen and (min-width: 40.063em) {
			
			.nav-next a:hover,
			.nav-previous a:hover
			{
				color: <?php echo esc_html($shopkeeper_theme_options['main_color']) ?>;
			}
		
		}
		
		.widget_shopping_cart .buttons a.view_cart,
		.widget.widget_price_filter .price_slider_amount .button,
		.products a.button,
		.woocommerce .products .added_to_cart.wc-forward,
		.woocommerce-page .products .added_to_cart.wc-forward
		{
			color: <?php echo esc_html($shopkeeper_theme_options['main_color']) ?> !important;
		}
		
		.order-info mark,
		.login_footer,
		.post_tags a:hover,
		.with_thumb_icon,
		.wpb_wrapper .wpb_toggle:before,
		#content .wpb_wrapper h4.wpb_toggle:before,
		.wpb_wrapper .wpb_accordion .wpb_accordion_wrapper .ui-state-default .ui-icon,
		.wpb_wrapper .wpb_accordion .wpb_accordion_wrapper .ui-state-active .ui-icon,
		.widget .tagcloud a:hover,
		.single_product_summary_related h2:after,
		.single_product_summary_upsell h2:after,
		.page-title.portfolio_item_title:after,
		#button_offcanvas_sidebar_left,
		#button_offcanvas_sidebar_left i,
		.thumbnail_archive_container:before,
		.from_the_blog_overlay,
		.select2-results .select2-highlighted,
		.wpb_widgetised_column aside ul li.chosen span.count,
		.woocommerce .widget_product_categories ul li.current-cat > a:before,
		.woocommerce-page .widget_product_categories ul li.current-cat > a:before,
		.widget_product_categories ul li.current-cat > a:before
		{
			background: <?php echo esc_html($shopkeeper_theme_options['main_color']) ?>;
		}
		
		
		@media only screen and (max-width: 40.063em) {
			
			.nav-next a:hover,
			.nav-previous a:hover
			{
				background: <?php echo esc_html($shopkeeper_theme_options['main_color']) ?>;
			}
		
		}

		.woocommerce .widget_layered_nav ul li.chosen a:before,
		.woocommerce-page .widget_layered_nav ul li.chosen a:before,
		.widget_layered_nav ul li.chosen a:before,
		.woocommerce .widget_layered_nav ul li.chosen:hover a:before,
		.woocommerce-page .widget_layered_nav ul li.chosen:hover a:before,
		.widget_layered_nav ul li.chosen:hover a:before,
		.woocommerce .widget_layered_nav_filters ul li a:before,
		.woocommerce-page .widget_layered_nav_filters ul li a:before,
		.widget_layered_nav_filters ul li a:before,
		.woocommerce .widget_layered_nav_filters ul li a:hover:before,
		.woocommerce-page .widget_layered_nav_filters ul li a:hover:before,
		.widget_layered_nav_filters ul li a:hover:before,
		.woocommerce .widget_rating_filter ul li.chosen a:before
		{
			background-color: <?php echo esc_html($shopkeeper_theme_options['main_color']) ?>;
		}
		
		
		.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
		.woocommerce-page .widget_price_filter .ui-slider .ui-slider-range,
		.woocommerce .quantity .plus,
		.woocommerce .quantity .minus,
		.woocommerce #content .quantity .plus,
		.woocommerce #content .quantity .minus,
		.woocommerce-page .quantity .plus,
		.woocommerce-page .quantity .minus,
		.woocommerce-page #content .quantity .plus,
		.woocommerce-page #content .quantity .minus,
		.widget_shopping_cart .buttons .button.wc-forward.checkout
		{
			background: <?php echo esc_html($shopkeeper_theme_options['main_color']) ?> !important;
		}
		
		.button,
		input[type="button"],
		input[type="reset"],
		input[type="submit"]
		{
			background-color: <?php echo esc_html($shopkeeper_theme_options['main_color']) ?> !important;
		}
		
		
		.product_infos .yith-wcwl-wishlistaddedbrowse a:hover,
		.product_infos .yith-wcwl-wishlistexistsbrowse a:hover,
		.shipping-calculator-button:hover,
		.products a.button:hover,
		.woocommerce .products .added_to_cart.wc-forward:hover,
		.woocommerce-page .products .added_to_cart.wc-forward:hover,
		.products .yith-wcwl-wishlistexistsbrowse:hover a,
		.products .yith-wcwl-wishlistaddedbrowse:hover a,
		.order-number a:hover,
		.account_view_link:hover,
		.post-edit-link:hover,
		.url:hover
		{
			color:  rgba(<?php echo getbowtied_hex2rgb($shopkeeper_theme_options['main_color']); ?>,0.8) !important;
		}
		
		.product-title-link:hover
		{
			color:  rgba(<?php echo getbowtied_hex2rgb($shopkeeper_theme_options['headings_color']); ?>,0.8);
		}
	
		
		.button:hover,
		input[type="button"]:hover,
		input[type="reset"]:hover,
		input[type="submit"]:hover,
		.woocommerce .product_infos .quantity .minus:hover,
		.woocommerce #content .product_infos .quantity .minus:hover,
		.woocommerce-page .product_infos .quantity .minus:hover,
		.woocommerce-page #content .product_infos .quantity .minus:hover,
		.woocommerce .quantity .plus:hover,
		.woocommerce #content .quantity .plus:hover,
		.woocommerce-page .quantity .plus:hover,
		.woocommerce-page #content .quantity .plus:hover
		{
			background: rgba(<?php echo getbowtied_hex2rgb($shopkeeper_theme_options['main_color']); ?>,0.8) !important;
		}
		
		.post_tags a:hover,
		.widget .tagcloud a:hover,
		.widget_shopping_cart .buttons a.view_cart,
		.account-tab-link-mobile,
		.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
		.woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle,
		.woocommerce .widget_product_categories ul li.current-cat > a:before,
		.woocommerce-page .widget_product_categories ul li.current-cat > a:before,
		.widget_product_categories ul li.current-cat > a:before,
		.widget_product_categories ul li a:hover:before,
		.widget_layered_nav ul li a:hover:before,
		.widget_product_categories ul li a:hover ~ .count,
		.widget_layered_nav ul li a:hover ~ .count,
		.cd-top
		{
			border-color: <?php echo esc_html($shopkeeper_theme_options['main_color']) ?>;
		}
		
		.wpb_tour.wpb_content_element .wpb_tabs_nav  li.ui-tabs-active a,
		.wpb_tabs.wpb_content_element .wpb_tabs_nav li.ui-tabs-active a,
		.woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
		.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active a,
		.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active a,
		.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active a,
		.main-navigation ul ul li a:hover
		{
			border-bottom-color: <?php echo esc_html($shopkeeper_theme_options['main_color']) ?>;
		}
		
		.woocommerce div.product .woocommerce-tabs ul.tabs li.active,
		.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active,
		.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active,
		.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active
		{
			border-top-color: <?php echo esc_html($shopkeeper_theme_options['main_color']) ?>;			
		}
		
		
		<?php endif; ?>
		
		
		/***************************************************************/
		/* Top Bar *****************************************************/
		/***************************************************************/
		
		<?php 
		if ( (isset($shopkeeper_theme_options['top_bar_switch'])) && ($shopkeeper_theme_options['top_bar_switch'] == "1" ) ) { 
			$site_top_bar_height = 43;
		} else {
			$site_top_bar_height = 0;
		}
		?>
		
		<?php if ( (isset($shopkeeper_theme_options['top_bar_navigation_position'])) && (trim($shopkeeper_theme_options['top_bar_navigation_position']) == "left" ) ) : ?>
		#site-navigation-top-bar {
			float:left;
		}
		<?php endif; ?>
		
		#site-top-bar {
			height:<?php echo esc_html($site_top_bar_height) ?>px;
		}
		
		#site-top-bar,
		#site-navigation-top-bar .sf-menu ul
		{
			<?php if ( (isset($shopkeeper_theme_options['top_bar_background_color'])) && (trim($shopkeeper_theme_options['top_bar_background_color']) != "" ) ) : ?>
				background: <?php echo esc_html($shopkeeper_theme_options['top_bar_background_color']) ?>;
			<?php endif; ?>
		}
		
		<?php if ( (isset($shopkeeper_theme_options['top_bar_typography'])) && (trim($shopkeeper_theme_options['top_bar_typography']) != "" ) ) : ?>
		#site-top-bar,
		#site-top-bar a
		{
			color:<?php echo esc_html($shopkeeper_theme_options['top_bar_typography']) ?>;
		}
		<?php endif; ?>
		
		
		
		/***************************************************************/
		/* 	Header *****************************************************/
		/***************************************************************/
		
		<?php if ( (isset($shopkeeper_theme_options['sticky_header_background_color'])) && (trim($shopkeeper_theme_options['sticky_header_background_color']) != "" ) ) : ?>
			.site-header
			{
				background: <?php echo esc_html($shopkeeper_theme_options['sticky_header_background_color']) ?>;
			}
		<?php endif; ?>
		
		@media only screen and (min-width: 63.9375em) {
		.site-header {
			<?php if ( (isset($shopkeeper_theme_options['main_header_background']['background-color'])) ) : ?>
			background-color:<?php echo esc_html($shopkeeper_theme_options['main_header_background']['background-color']); ?>;
			<?php endif; ?>
			
			<?php if ( (isset($shopkeeper_theme_options['main_header_background']['background-image'])) && ($shopkeeper_theme_options['main_header_background']['background-image']) != "" ) : ?>
			background-image:url(<?php echo esc_url($shopkeeper_theme_options['main_header_background']['background-image']); ?>);
			<?php endif; ?>
			
			<?php if ( (isset($shopkeeper_theme_options['main_header_background']['background-repeat'])) ) : ?>
			background-repeat:<?php echo esc_html($shopkeeper_theme_options['main_header_background']['background-repeat']); ?>;
			<?php endif; ?>
			
			<?php if ( (isset($shopkeeper_theme_options['main_header_background']['background-position'])) ) : ?>
			background-position:<?php echo esc_html($shopkeeper_theme_options['main_header_background']['background-position']); ?>;
			<?php endif; ?>
			
			<?php if ( (isset($shopkeeper_theme_options['main_header_background']['background-size'])) ) : ?>
			background-size:<?php echo esc_html($shopkeeper_theme_options['main_header_background']['background-size']); ?>;
			<?php endif; ?>
			
			<?php if ( (isset($shopkeeper_theme_options['main_header_background']['background-attachment'])) ) : ?>
			background-attachment:<?php echo esc_html($shopkeeper_theme_options['main_header_background']['background-attachment']); ?>;
			<?php endif; ?>
		}
		}
		
		
		<?php 
		$site_logo_height = 33;
		if ( (isset($shopkeeper_theme_options['site_logo']['url'])) && (trim($shopkeeper_theme_options['site_logo']['url']) != "" ) ) {
			$site_logo_height = $shopkeeper_theme_options['logo_height']; 
		} else {
			$site_logo_height = 33;
		}
		?>
		
		<?php 
		
		$content_margin = 0;
		
		//if ( is_admin_bar_showing() ) { $content_margin = 32; }
		
		$page_id = "";
		if ( is_single() || is_page() ) {
			$page_id = get_the_ID();
		} else if ( is_home() ) {
			$page_id = get_option('page_for_posts');						
		}
					
		
		if ( 
		((isset($shopkeeper_theme_options['sticky_header'])) && (trim($shopkeeper_theme_options['sticky_header']) == "1" )) || 
		((isset($shopkeeper_theme_options['main_header_transparency'])) && (trim($shopkeeper_theme_options['main_header_transparency']) == "1" )) ||
		((get_post_meta($page_id, 'page_header_transparency', true)) && (get_post_meta($page_id, 'page_header_transparency', true) != "inherit"))
		) { 
			
			if ( isset($shopkeeper_theme_options['main_header_layout']) ) {		
				if ( $shopkeeper_theme_options['main_header_layout'] == "1" ) {
					$content_margin = $content_margin + $site_top_bar_height + $site_logo_height + $shopkeeper_theme_options['spacing_above_logo'] + $shopkeeper_theme_options['spacing_below_logo'];
				} 		
				elseif ( $shopkeeper_theme_options['main_header_layout'] == "2" ) {
					$content_margin = $content_margin + $site_top_bar_height + $site_logo_height + $shopkeeper_theme_options['spacing_above_logo'] + $shopkeeper_theme_options['spacing_below_logo'];
				}
				elseif ( $shopkeeper_theme_options['main_header_layout'] == "3" ) {
					$content_margin = $content_margin + $site_top_bar_height + $site_logo_height + $shopkeeper_theme_options['spacing_above_logo'] + $shopkeeper_theme_options['spacing_below_logo'] + 50;
				} 		
			}		
			else {	
				wp_enqueue_style('shopkeeper-header-default', get_template_directory_uri() . '/css/header-default.css', array(), '1.0', 'all' );	
			}
			
		}
		?>
		
		<?php if ( (isset($shopkeeper_theme_options['header_width'])) && ($shopkeeper_theme_options['header_width'] == "full") ) : ?>
		.site-header,
		#site-top-bar
		{
			padding-left:20px;
			padding-right:20px;
		}
		<?php endif; ?>
		
		<?php
		
		if ( (isset($shopkeeper_theme_options['site_logo']['url'])) && (trim($shopkeeper_theme_options['site_logo']['url']) != "" ) ) {
			
			if (is_ssl()) {
				$site_logo = str_replace("http://", "https://", $shopkeeper_theme_options['site_logo']['url']);		
			} else {
				$site_logo = $shopkeeper_theme_options['site_logo']['url'];
			}
			
		?>
		
			<?php if ( (isset($shopkeeper_theme_options['logo_height'])) && (trim($shopkeeper_theme_options['logo_height']) != "" ) ) { ?>
			
			@media only screen and (min-width: 63.9375em) {
			.site-branding img {
				height:<?php echo esc_html($site_logo_height); ?>px;
				width:auto;
			}
			
			.site-header .main-navigation,
			.site-header .site-tools
			{
				height:<?php echo esc_html($site_logo_height); ?>px;
				line-height:<?php echo esc_html($site_logo_height); ?>px;
			}
			}
			
			<?php } ?>

		<?php
		}
		?>
		
		@media only screen and (min-width: 63.9375em) {
			.site-header.sticky .main-navigation,
			.site-header.sticky .site-tools,
			.site-header.sticky .site-branding img
			{
				height:33px;
				line-height:33px;
				width:auto;
			}
		}

		<?php if ( (isset($shopkeeper_theme_options['spacing_above_logo'])) && (trim($shopkeeper_theme_options['spacing_above_logo']) != "" ) ) { ?>
		@media only screen and (min-width: 63.9375em) {
			.site-header {
				padding-top:<?php echo esc_html($shopkeeper_theme_options['spacing_above_logo']); ?>px;
			}
		}
		<?php } ?>
		
		<?php if ( (isset($shopkeeper_theme_options['spacing_below_logo'])) && (trim($shopkeeper_theme_options['spacing_below_logo']) != "" ) ) { ?>
		@media only screen and (min-width: 63.9375em) {
			.site-header {
				padding-bottom:<?php echo esc_html($shopkeeper_theme_options['spacing_below_logo']); ?>px;
			}
		}
		<?php } ?>
		
		@media only screen and (min-width: 63.9375em) {
			#page_wrapper.sticky_header .content-area,
			#page_wrapper.transparent_header .content-area
			{
				margin-top:<?php echo esc_html($content_margin); ?>px;
			}
			
			.transparent_header .single-post-header .title,
			#page_wrapper.transparent_header .shop_header .page-title
			{
				padding-top: <?php echo esc_html($content_margin); ?>px;
			}
			
			.transparent_header .single-post-header.with-thumb .title
			{
				padding-top: <?php echo esc_html(200 + $content_margin); ?>px;
			}

			.transparent_header.sticky_header .page-title-shown .entry-header.with_featured_img,
			{
				margin-top: -<?php echo esc_html($content_margin)+85; ?>px;
			}

			.sticky_header .page-title-shown .entry-header.with_featured_img
			{
				margin-top: -<?php echo esc_html($content_margin); ?>px;
			}

			.page-template-default .transparent_header .entry-header.with_featured_img,
			.page-template-page-full-width .transparent_header .entry-header.with_featured_img
			{
				margin-top: -<?php echo esc_html($content_margin)+85; ?>px;
			}
		}
		
		<?php if ( (isset($shopkeeper_theme_options['main_header_font_size'])) && (trim($shopkeeper_theme_options['main_header_font_size']) != "" ) ) : ?>
		.site-header,
		.default-navigation,
		.main-navigation .mega-menu > ul > li > a
		{
			font-size: <?php echo esc_html($shopkeeper_theme_options['main_header_font_size']) ?>px;
		}
		<?php endif; ?>		
		
		<?php if ( (isset($shopkeeper_theme_options['sticky_header_color'])) && (trim($shopkeeper_theme_options['sticky_header_color']) != "" ) ) : ?>
		.site-header,
		.main-navigation a,
		.site-tools ul li a,
		.shopping_bag_items_number,
		.wishlist_items_number,
		.site-title a,
		.widget_product_search .search-but-added,
		.widget_search .search-but-added
		{
			color:<?php echo esc_html($shopkeeper_theme_options['sticky_header_color']) ?>;
		}

		.site-branding
		{
			border-color: <?php echo esc_html($shopkeeper_theme_options['main_header_font_color']) ?>;
		}
		<?php endif; ?>
		
		<?php if ( (isset($shopkeeper_theme_options['main_header_font_color'])) && (trim($shopkeeper_theme_options['main_header_font_color']) != "" ) ) : ?>
		@media only screen and (min-width: 63.9375em) {
			.site-header,
			.main-navigation a,
			.site-tools ul li a,
			.shopping_bag_items_number,
			.wishlist_items_number,
			.site-title a,
			.widget_product_search .search-but-added,
			.widget_search .search-but-added
			{
				color:<?php echo esc_html($shopkeeper_theme_options['main_header_font_color']) ?>;
			}
	
			.site-branding
			{
				border-color: <?php echo esc_html($shopkeeper_theme_options['main_header_font_color']) ?>;
			}
		}
		<?php endif; ?>
		
		
		<?php if ( (isset($shopkeeper_theme_options['main_header_transparent_light_color'])) && (trim($shopkeeper_theme_options['main_header_transparent_light_color']) != "" ) ) : ?>
		@media only screen and (min-width: 63.9375em) {
			#page_wrapper.transparent_header.transparency_light .site-header,
			#page_wrapper.transparent_header.transparency_light .site-header .main-navigation a,
			#page_wrapper.transparent_header.transparency_light .site-header .site-tools ul li a,
			#page_wrapper.transparent_header.transparency_light .site-header .shopping_bag_items_number,
			#page_wrapper.transparent_header.transparency_light .site-header .wishlist_items_number,
			#page_wrapper.transparent_header.transparency_light .site-header .site-title a,
			#page_wrapper.transparent_header.transparency_light .site-header .widget_product_search .search-but-added,
			#page_wrapper.transparent_header.transparency_light .site-header .widget_search .search-but-added
			{
				color:<?php echo esc_html($shopkeeper_theme_options['main_header_transparent_light_color']) ?>;
			}
		}
		<?php endif; ?>
		
		
		<?php if ( (isset($shopkeeper_theme_options['main_header_transparent_dark_color'])) && (trim($shopkeeper_theme_options['main_header_transparent_dark_color']) != "" ) ) : ?>
		@media only screen and (min-width: 63.9375em) {
			#page_wrapper.transparent_header.transparency_dark .site-header,
			#page_wrapper.transparent_header.transparency_dark .site-header .main-navigation a,
			#page_wrapper.transparent_header.transparency_dark .site-header .site-tools ul li a,
			#page_wrapper.transparent_header.transparency_dark .site-header .shopping_bag_items_number,
			#page_wrapper.transparent_header.transparency_dark .site-header .wishlist_items_number,
			#page_wrapper.transparent_header.transparency_dark .site-header .site-title a,
			#page_wrapper.transparent_header.transparency_dark .site-header .widget_product_search .search-but-added,
			#page_wrapper.transparent_header.transparency_dark .site-header .widget_search .search-but-added
			{
				color:<?php echo esc_html($shopkeeper_theme_options['main_header_transparent_dark_color']) ?>;
			}
		}
		<?php endif; ?>
		
		
		/* sticky */
		
		<?php if ( (isset($shopkeeper_theme_options['sticky_header_background_color'])) && (trim($shopkeeper_theme_options['sticky_header_background_color']) != "" ) ) : ?>
		@media only screen and (min-width: 63.9375em) {
			.site-header.sticky,
			#page_wrapper.transparent_header .site-header.sticky
			{
				background: <?php echo esc_html($shopkeeper_theme_options['sticky_header_background_color']) ?>;
			}
		}
		<?php endif; ?>
		
		<?php if ( (isset($shopkeeper_theme_options['sticky_header_color'])) && (trim($shopkeeper_theme_options['sticky_header_color']) != "" ) ) : ?>
		@media only screen and (min-width: 63.9375em) {
			.site-header.sticky,
			.site-header.sticky .main-navigation a,
			.site-header.sticky .site-tools ul li a,
			.site-header.sticky .shopping_bag_items_number,
			.site-header.sticky .wishlist_items_number,
			.site-header.sticky .site-title a,
			.site-header.sticky .widget_product_search .search-but-added,
			.site-header.sticky .widget_search .search-but-added,
			#page_wrapper.transparent_header .site-header.sticky,
			#page_wrapper.transparent_header .site-header.sticky .main-navigation a,
			#page_wrapper.transparent_header .site-header.sticky .site-tools ul li a,
			#page_wrapper.transparent_header .site-header.sticky .shopping_bag_items_number,
			#page_wrapper.transparent_header .site-header.sticky .wishlist_items_number,
			#page_wrapper.transparent_header .site-header.sticky .site-title a,
			#page_wrapper.transparent_header .site-header.sticky .widget_product_search .search-but-added,
			#page_wrapper.transparent_header .site-header.sticky .widget_search .search-but-added
			{
				color:<?php echo esc_html($shopkeeper_theme_options['sticky_header_color']) ?>;
			}
			
			.site-header.sticky .site-branding
			{
				border-color: <?php echo esc_html($shopkeeper_theme_options['sticky_header_color']) ?>;
			}
		}
		<?php endif; ?>
		
		<?php 
		
		if ( 
		(isset($shopkeeper_theme_options['main_header_wishlist'])) && 
		(isset($shopkeeper_theme_options['main_header_shopping_bag'])) && 
		(isset($shopkeeper_theme_options['main_header_search_bar'])) && 
		(isset($shopkeeper_theme_options['main_header_off_canvas'])) && 
		($shopkeeper_theme_options['main_header_wishlist'] == "0") && 
		($shopkeeper_theme_options['main_header_shopping_bag'] == "0") && 
		($shopkeeper_theme_options['main_header_search_bar'] == "0") && 
		($shopkeeper_theme_options['main_header_off_canvas'] == "0") ) : 
		?>
		
		.site-tools { margin:0; }
		
		<?php endif; ?>
		
		
		<?php if ( (isset($shopkeeper_theme_options['sticky_header_logo']['url'])) && (trim($shopkeeper_theme_options['sticky_header_logo']['url']) != "" ) ) : ?>
		@media only screen and (max-width: 63.9375em) {
			.site-logo {
				display:none;
			}
			.sticky-logo {
				display:block;
			}
		}
		<?php endif; ?>
		
		
		
		/* header-centered-2menus */
		
		<?php if ( (isset($shopkeeper_theme_options['main_header_layout'])) && ($shopkeeper_theme_options['main_header_layout'] == "2") ) : ?>
		
			<?php
			
			$header_col_right_menu_right_padding = 0;
			
			if ( (isset($shopkeeper_theme_options['main_header_wishlist'])) && ($shopkeeper_theme_options['main_header_wishlist'] == "1") ) $header_col_right_menu_right_padding += 60;
			if ( (isset($shopkeeper_theme_options['main_header_shopping_bag'])) && ($shopkeeper_theme_options['main_header_shopping_bag'] == "1") ) $header_col_right_menu_right_padding += 60;
			if ( (isset($shopkeeper_theme_options['main_header_search_bar'])) && ($shopkeeper_theme_options['main_header_search_bar'] == "1") ) $header_col_right_menu_right_padding += 40;
			if ( (isset($shopkeeper_theme_options['main_header_off_canvas'])) && ($shopkeeper_theme_options['main_header_off_canvas'] == "1") ) $header_col_right_menu_right_padding += 40;
			
			?>
			
			.header_col.right_menu {
				padding-right:<?php echo esc_html($header_col_right_menu_right_padding); ?>px;
			}
			
			.rtl .header_col.right_menu {
				padding-right:0;
			}
			.rtl .header_col.left_menu {
				padding-left:<?php echo esc_html($header_col_right_menu_right_padding); ?>px;
			}

			/*.header_col.left_menu {
				padding-left:<?php echo esc_html($header_col_right_menu_right_padding); ?>px;
			}*/
			
			<?php if ( (isset($shopkeeper_theme_options['main_header_navigation_position_header_2'])) && ($shopkeeper_theme_options['main_header_navigation_position_header_2'] == "1") ) : ?>
			.header_col.left_menu .main-navigation {
				text-align:right !important;
				margin:0 -15px !important;
			}
			.header_col.right_menu .main-navigation {
				text-align:left !important;
				margin:0 -15px !important;
			}
			<?php endif; ?>
			
			<?php if ( (isset($shopkeeper_theme_options['main_header_navigation_position_header_2'])) && ($shopkeeper_theme_options['main_header_navigation_position_header_2'] == "2") ) : ?>
			.header_col.left_menu .main-navigation {
				text-align:left !important;
				margin:0 -15px !important;
			}
			.header_col.right_menu .main-navigation {
				text-align:right !important;
				margin:0 -15px !important;
			}
			<?php endif; ?>
			
			.site-header .site-tools {
				height:30px !important;
				/*line-height:30px !important;*/
				position:absolute;
				top:2px;
				right:0;
			}
			
			<?php if ( (isset($shopkeeper_theme_options['logo_min_height'])) && (trim($shopkeeper_theme_options['logo_min_height']) != "" ) ) : ?>
			.header_col.branding {
				min-width:<?php echo esc_html($shopkeeper_theme_options['logo_min_height']); ?>px;
			}
			<?php endif; ?>
		
		<?php endif; ?>
		
		
		/* header-centered-menu-under */
		
		<?php if ( (isset($shopkeeper_theme_options['main_header_layout'])) && ($shopkeeper_theme_options['main_header_layout'] == "3") ) : ?>
		
			.main-navigation {
				text-align:center !important;
			}
			
			.site-header .main-navigation {
				height:50px !important;
				line-height:50px !important;
				margin:10px auto -10px auto;
			}
			
			.site-header .site-tools {
				height:30px !important;
				line-height:30px !important;
				position:absolute;
				top:2px;
				right:0;
			}
		
		<?php endif; ?>

		
		
		
		
		/***************************************************************/
		/* Footer ******************************************************/
		/***************************************************************/

		#site-footer
		{
			<?php if ( (isset($shopkeeper_theme_options['footer_background_color'])) && (trim($shopkeeper_theme_options['footer_background_color']) != "" ) ) : ?>
				background: <?php echo esc_html($shopkeeper_theme_options['footer_background_color']) ?>;
			<?php endif; ?>
		}
		
		<?php if ( (isset($shopkeeper_theme_options['footer_background_color'])) && (trim($shopkeeper_theme_options['footer_background_color']) == "transparent" ) ) : ?>
			@media only screen and (max-width: 641px) {
				#site-footer {
					padding-top:0;
				}
			}
		<?php endif; ?>
		
		<?php if ( (isset($shopkeeper_theme_options['footer_texts_color'])) && (trim($shopkeeper_theme_options['footer_texts_color']) != "" ) ) : ?>
		#site-footer,
		#site-footer .copyright_text a
		{
			color:<?php echo esc_html($shopkeeper_theme_options['footer_texts_color']) ?>;
		}
		<?php endif; ?>
		
		<?php if ( (isset($shopkeeper_theme_options['footer_links_color'])) && (trim($shopkeeper_theme_options['footer_links_color']) != "" ) ) : ?>
		#site-footer a,
		#site-footer .widget-title,
		.cart-empty-text,
		.footer-navigation-wrapper ul li:after
		{
			color:<?php echo esc_html($shopkeeper_theme_options['footer_links_color']) ?>;
		}		
		<?php endif; ?>

		<?php if ( (isset($shopkeeper_theme_options['expandable_footer'])) && (trim($shopkeeper_theme_options['expandable_footer']) == "0" ) ) : ?>
		.trigger-footer-widget-area {
			display: none;
		}
		.site-footer-widget-area {
			display: block;
		}
		<?php endif; ?>
		
		
		
		
		/***************************************************************/
		/* Breadcrumbs *************************************************/
		/***************************************************************/
		
		
		<?php if ( (isset($shopkeeper_theme_options['breadcrumbs'])) && ($shopkeeper_theme_options['breadcrumbs']) == "0" ) : ?>
		.woocommerce .woocommerce-breadcrumb,
		.woocommerce-page .woocommerce-breadcrumb
		{
			display:none;
		}
		<?php endif; ?>


		
		
		/***************************************************************/
		/* Product Page Full Screen Description ************************/
		/***************************************************************/
		
		<?php if (isset($post->ID)) : ?>		
		<?php if (get_post_meta( $post->ID, 'product_full_screen_description_meta_box_check', true ) == "on") : ?>
		
		#tab-description .boxed-row
		{
			max-width: 1255px;
			margin: 0 auto;
		}
		
		.woocommerce div.product .woocommerce-tabs #tab-description,
		.woocommerce #content div.product .woocommerce-tabs #tab-description,
		.woocommerce-page div.product .woocommerce-tabs #tab-description,
		.woocommerce-page #content div.product .woocommerce-tabs #tab-description
		{
			padding: 0;
		}
		
		#tab-description .row
		{
			padding: 0;
		}
		
		
		/* Visual Composer Shortcodes */
		
		/* max-width 640px, small screens */
		@media only screen and (max-width: 40.063em) {
			
			.woocommerce div.product .woocommerce-tabs #tab-description,
			.woocommerce #content div.product .woocommerce-tabs #tab-description,
			.woocommerce-page div.product .woocommerce-tabs #tab-description,
			.woocommerce-page #content div.product .woocommerce-tabs #tab-description
			{
				position: relative;
				top: -1px;
			}
			
			#tab-description .columns .columns
			{
				padding-left: 30px !important;
				padding-right: 30px !important;
			}
		}
		
		/*min-width 641px and max-width 1023px, medium screens */
		@media only screen and (min-width: 40.063em) and (max-width: 63.9375em) {
		
			#tab-description .columns .columns
			{
				padding-left: 60px !important;
				padding-right: 60px !important;
			}
			
		}
		
		/* max-width 1023px, small screens/medium screens */
		@media only screen and (max-width: 63.9375em) {
			
			#tab-description .row,
			#tab-description .columns
			{
				padding-left: 0 !important;
				padding-right: 0 !important;
			}
			
			#tab-description .columns .row
			{
				margin-left: 0;
				margin-right: 0;
			}
			
			#tab-description .columns .columns .columns
			{
				padding-left: 0px !important;
				padding-right: 0px !important;
			}
			
			#tab-description .columns .wpb_content_element
			{
				padding-left: 0 !important;
				padding-right: 0 !important;
			}
		}
		
		/* min-width 1023px, large screens */
		@media only screen and (min-width: 63.9375em) {
			
			.woocommerce #tab-description > .row,
			/*.woocommerce #tab-description .row .row,*/
			.woocommerce #tab-description  .row  .large-centered
			{
				width:100% !important;
				max-width:100% !important;
				padding:0 !important;
				margin:0 !important;
			}
		}
			
		<?php endif; ?>		
		<?php endif; ?>
		
		
		/********************************************************************/
		/* Custom CSS *******************************************************/
		/********************************************************************/
		
		<?php if ( (isset($shopkeeper_theme_options['custom_css'])) && (trim($shopkeeper_theme_options['custom_css']) != "" ) ) : ?>
			<?php echo $shopkeeper_theme_options['custom_css'] ?>
		<?php endif; ?>
	
	</style>

<?php
$content = ob_get_clean();
$content = str_replace(array("\r\n", "\r"), "\n", $content);
$lines = explode("\n", $content);
$new_lines = array();
foreach ($lines as $i => $line) { if(!empty($line)) $new_lines[] = trim($line); }
echo implode($new_lines);
} //if
} //function
?>
<?php add_action( 'wp_head', 'shopkeeper_custom_styles', 99 ); ?>