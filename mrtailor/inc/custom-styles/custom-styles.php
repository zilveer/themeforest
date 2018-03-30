<?php
if ( ! function_exists ('mr_tailor_custom_styles') ) {
function mr_tailor_custom_styles() {	
	global $mr_tailor_theme_options;
	global $slider_metabox;
	$slider_metabox->the_meta();
	
	//convert hex to rgb
	if ( ! function_exists ('getbowtied_hex2rgb') ) {
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
	}
	
	ob_start();	
	?>

	<!-- ******************************************************************** -->
	<!-- * Theme Options Styles ********************************************* -->
	<!-- ******************************************************************** -->
		
	<style>
		
		/***************************************************************/
		/* Fonts *******************************************************/
		/***************************************************************/
        
        <?php        
        $custom_main_font = "sans-serif";
        $custom_secondary_font = "sans-serif";
    
        if ($mr_tailor_theme_options['main_font_source'] == "1") { $custom_main_font = $mr_tailor_theme_options['main_font']['font-family'] . ', sans-serif'; }    
        if ($mr_tailor_theme_options['main_font_source'] == "2") { $custom_main_font = $mr_tailor_theme_options['main_typekit_font_face'] . ', sans-serif'; }
    
        if ($mr_tailor_theme_options['secondary_font_source'] == "1") { $custom_secondary_font = $mr_tailor_theme_options['secondary_font']['font-family'] . ', sans-serif'; }
        if ($mr_tailor_theme_options['secondary_font_source'] == "2") { $custom_secondary_font = $mr_tailor_theme_options['secondary_typekit_font_face'] . ', sans-serif'; }
    
        $base_font = $custom_main_font;
        $headings_font = $custom_main_font;        
       
        if ( (isset($mr_tailor_theme_options['body_text_font_family'])) && ($mr_tailor_theme_options['body_text_font_family']) != "" ) :
            
            if ($mr_tailor_theme_options['body_text_font_family'] == "main_font") :
                $base_font = $custom_main_font;  
            endif;
    
            if ($mr_tailor_theme_options['body_text_font_family'] == "secondary_font") :
                $base_font = $custom_secondary_font;
            endif;

        endif;
    
        if ( (isset($mr_tailor_theme_options['title_font_family'])) && ($mr_tailor_theme_options['title_font_family']) != "" ) :
            
            if ($mr_tailor_theme_options['title_font_family'] == "main_font") :
                $headings_font = $custom_main_font;  
            endif;
    
            if ($mr_tailor_theme_options['title_font_family'] == "secondary_font") :
                $headings_font = $custom_secondary_font;
            endif;

        endif;
        ?>
        
        /* Base Font */
        
        body,
        .product_meta span a,
		.product_meta span span,
		.comments-title,
		.wishlist_items_number,
		.shopping_bag_items_number,
		.copyright_text,
		.order_details li strong,
		.wpcf7 input,
		.mobile-navigation .sub-menu a,
		.cart-subtotal .amount,
		.order-total .amount,
		.wpb_tabs .ui-widget,
		.wpb_tour .ui-widget,
		.wpb_accordion .ui-widget,
		.products ul h3,
		ul.products h3,
		.widget ul small.count,
		.country_select.select2-container .select2-selection,
		.state_select.select2-container .select2-selection,
		.woocommerce #payment .payment_method_paypal .about_paypal,
		.woocommerce .form-row.terms .checkbox.check_label,
		.shortcode_title.main_font,
        .label,
		.main-navigation .sub-menu li a,
		.remember-me,
		.woocommerce form .form-row label.inline,
		.woocommerce-page form .form-row label.inline,
		.nav-next-title,
		.nav-previous-title,
		.woocommerce-MyAccount-navigation ul li
        {
            font-family: <?php echo $base_font; ?>;
        }
        
        
        @media only screen and (min-width: 63.9375em) {

	        .site-content p,
	        .site-content ul,
	        .site-content ol,
	        .site-content dl,
			table tr td,
			table thead tr th,
			table tbody tr td,
			table tfoot tr th,
			table tfoot tr td,
			.woocommerce table.shop_attributes td
			{
				<?php if ( (isset($mr_tailor_theme_options['body_text_font_size'])) && ($mr_tailor_theme_options['body_text_font_size']) != "" ) : ?>
					font-size:<?php echo $mr_tailor_theme_options['body_text_font_size']; ?>px;
				<?php endif; ?>
	            
	            <?php if ( (isset($mr_tailor_theme_options['body_text_line_height'])) && ($mr_tailor_theme_options['body_text_line_height']) != "" ) : ?>
	                line-height:<?php echo $mr_tailor_theme_options['body_text_line_height']; ?>px;
	            <?php endif; ?>
	        }        
	        
			<?php if ( (isset($mr_tailor_theme_options['body_text_font_weight'])) && ($mr_tailor_theme_options['body_text_font_weight']) != "" ) : ?>
			    body,
				.woocommerce table.shop_attributes td,
				.product-name .product-quantity
				{
					font-weight: <?php echo $mr_tailor_theme_options['body_text_font_weight']; ?>;
				}
			<?php endif; ?>

		}
		
		
        
        /* Headings Font */
        
        h1, h2, h3, h4, h5, h6,
		.product .price,
		.tabs li a,
		.blog-list-day,
		.edit-account legend,
		.add_to_cart_inline .amount,
		.categories_grid .category_name,
		.category_list .category_name,
		.vc_tta-title-text
		{
            font-family: <?php echo $headings_font; ?>;
        }
        
		@media only screen and (min-width: 63.9375em) {

			<?php if ( (isset($mr_tailor_theme_options['body_text_font_size'])) && ($mr_tailor_theme_options['body_text_font_size']) != "" ) : ?>
				
				h1
				{	
					font-size:<?php echo 3.125*$mr_tailor_theme_options['body_text_font_size']; ?>px;
				}
				
				h2, .edit-account legend
				{	
					font-size:<?php echo 2.3125*$mr_tailor_theme_options['body_text_font_size']; ?>px;
				}
				
				h3
				{	
					font-size:<?php echo 1.6875*$mr_tailor_theme_options['body_text_font_size']; ?>px;
				}
				
				h4,
				.woocommerce div.product .woocommerce-tabs ul.tabs li a,
				.woocommerce #content div.product .woocommerce-tabs ul.tabs li a,
				.woocommerce-page div.product .woocommerce-tabs ul.tabs li a,
				.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a,
				.woocommerce .single_product_summary_related h2,
				.woocommerce .single_product_summary_upsell h2,
				.single_product_summary_related h2,
				.single_product_summary_upsell h2
				{	
					font-size:<?php echo 1.4375*$mr_tailor_theme_options['body_text_font_size']; ?>px;
				}
				
				h5
				{	
					font-size:<?php echo 1.125*$mr_tailor_theme_options['body_text_font_size']; ?>px;
				}
				
				h6
				{	
					font-size:<?php echo 1*$mr_tailor_theme_options['body_text_font_size']; ?>px;
				}
				
			<?php endif; ?>

		}

		<?php if ( (isset($mr_tailor_theme_options['h1_font_size'])) && ($mr_tailor_theme_options['h1_font_size']) != "" ) : ?>
			
			@media only screen and (min-width: 63.9375em) {
				.page-title,
				.entry-title,
				.main-slider h2,
				.lookbook-first-slide-wrapper h2
				{	
					font-size:<?php echo $mr_tailor_theme_options['h1_font_size']; ?>px;
				}
			}

		<?php endif; ?>

		<?php if ( (isset($mr_tailor_theme_options['h1_line_height'])) && ($mr_tailor_theme_options['h1_line_height']) != "" ) : ?>

		@media only screen and (min-width: 63.9375em) {
			.page-title,
			.entry-title,
			.main-slider h2,
			.lookbook-first-slide-wrapper h2
			{
				line-height: <?php echo $mr_tailor_theme_options['h1_line_height']; ?>px;
			}
		}

		<?php endif; ?>

		<?php if ( (isset($mr_tailor_theme_options['h_letter_spacing'])) && ($mr_tailor_theme_options['h_letter_spacing']) != "" ) : ?>

		@media only screen and (min-width: 63.9375em) {
			.page-title,
			.entry-title,
			.product_infos .price,
			.wpb_tabs_nav li,
			.add_to_cart_inline .amount,
			.main-slider h2,
			.lookbook-first-slide-wrapper h2,
			.shortcode_banner_simple_height_content h3,
			.categories_grid .category_name,
			.category_list .category_name,
			.shortcode_title
			{
				letter-spacing: <?php echo $mr_tailor_theme_options['h_letter_spacing']/100; ?>em;
			}
		}

		<?php endif; ?>

        
        <?php if ( (isset($mr_tailor_theme_options['title_font_weight'])) && ($mr_tailor_theme_options['title_font_weight']) != "" ) : ?>
			
				h1, h2, h3, h4, h5, h6,
				.more-link,
				.filters_button,
				.trigger-share-list,
				.post-navigation,
				.catalog_top .select2-container .select2-selection,
				.products a.button,
				.woocommerce .products a.button,
				.product_after_shop_loop .price,
				.woocommerce div.product span.price,
				.woocommerce-page div.product span.price,
				.woocommerce #content div.product span.price,
				.woocommerce-page #content div.product span.price,
				.woocommerce div.product p.price,
				.woocommerce-page div.product p.price,
				.woocommerce #content div.product p.price,
				.woocommerce-page #content div.product p.price,
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
				.yith-wcwl-add-button,
				.trigger-share-list,
				.woocommerce div.product .woocommerce-tabs ul.tabs li a,
				.woocommerce table.shop_attributes th,
				.product_meta > span,
				.woocommerce-page .cart-collaterals .cart_totals table th,
				.woocommerce-page .cart-collaterals .cart_totals .shipping td:first-child,
				.woocommerce div.product form.cart .variations label,
				.woocommerce #content div.product p.stock,
				.woocommerce-page #content div.product p.stock,
				.wpb_wrapper .vc_progress_bar .vc_single_bar .vc_label .vc_label_units,
				.woocommerce-checkout .woocommerce-info,
				.woocommerce div.product p.price ins,
				.woocommerce div.product span.price ins,
				strong,
				dl dt,
				.edit-account legend,
				.add_to_cart_inline .amount,
				.categories_grid .category_name,
				.category_list .category_name,
				.vc_tta-title-text
				{
					font-weight: <?php echo $mr_tailor_theme_options['title_font_weight']; ?>;
				}
				
		<?php endif; ?>
        
        <?php if ( (isset($mr_tailor_theme_options['main_header_font_weight'])) && (trim($mr_tailor_theme_options['main_header_font_weight']) != "" ) ) : ?>
            .main-navigation .megamenu-1-col > ul > li > a,
            .main-navigation .megamenu-2-col > ul > li > a,
            .main-navigation .megamenu-3-col > ul > li > a,
            .main-navigation .megamenu-4-col > ul > li > a,
            #site-navigation > ul > li > a,
            #site-navigation > ul > li > a strong
            {
                font-weight: <?php echo $mr_tailor_theme_options['main_header_font_weight']; ?>;
            }
        <?php endif; ?>
        
        /* exceptions: always secondary font */
        
        #site-navigation-top-bar,
		.site-title,
		.widget h3,
		.widget_product_search #searchsubmit,
		.widget_search #searchsubmit,
		.widget_product_search .search-submit,
		.widget_search .search-submit,
		.comment-respond label,
		.button,
		button,
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
		blockquote cite,
		.widget .tagcloud a,
		.widget_shopping_cart .total strong,
		table thead th,
		.woocommerce div.product form.cart div.label label,
		.woocommerce-page div.product form.cart div.label label,
		.woocommerce #content div.product form.cart div.label label,
		.woocommerce-page #content div.product form.cart div.label label,
		.woocommerce span.onsale,
		.woocommerce-page span.onsale,
		.recently_viewed_in_single h2,
		.woocommerce .cart-collaterals .cart_totals table th,
		.woocommerce-page .cart-collaterals .cart_totals table th,
		.woocommerce .cart-collaterals .shipping-calculator-button,
		.woocommerce-page .cart-collaterals .shipping-calculator-button,
		.woocommerce form .form-row label,
		.woocommerce-page form .form-row label,
		.main-slider h1,
		.site-tools,
		.post-edit-link,
		.comment-edit-link,
		.comment-reply-link,
		.slider_button,
		.go_home,
		.filters_button,
		.woocommerce-ordering,
		.out_of_stock_badge_loop,
		.out_of_stock_badge_single,
		.add_to_wishlist,
		.out-of-stock,
		.wishlist-in-stock,
		.wishlist-out-of-stock,
		.cross-sells h2,
		tr.shipping > td:first-of-type,
		.checkout_login .woocommerce-info,
		.checkout_coupon_box .woocommerce-info,
		.check_label_radio,
		.order_details .title,
		.order_details li,
		.customer_details dt,
		.account_view_link,
		.order_details_footer tr td:first-of-type,
		.wpcf7,
		.mobile-navigation,
		.widget_layered_nav ul li.chosen,
		.widget_layered_nav_filters ul li.chosen a,
		.product_meta > span,
		.woocommerce table.shop_attributes th,
		.woocommerce-page table.shop_attributes th,
		.wpb_tour.wpb_content_element .wpb_tabs_nav li a,
		.mobile-menu-text,
		.trigger-share-list,
		.shortcode_banner_simple_height_bullet span,
		.select2-container .select2-selection,
		select.topbar-language-switcher,
		select.wcml_currency_switcher,
		.blog-isotope .more-link,
		.blog-isotope .post_meta_archive,
		.product_after_shop_loop .price,
		.products a.button,
		.yith-wcwl-wishlistaddedbrowse a,
		.yith-wcwl-wishlistexistsbrowse a,
		.woocommerce-message a,
		.shop_table.order_details tfoot th:first-child,
		.shop_table.order_details tfoot td:first-child,
		.shop_table.woocommerce-checkout-review-order-table tfoot th:first-child,
		.shop_table.woocommerce-checkout-review-order-table tfoot td:first-child,
		.woocommerce .shop_table.customer_details tbody tr th,
		.woocommerce table.shop_table_responsive.customer_details tr td:before,
		.woocommerce-page table.shop_table_responsive.customer_details tr td:before,
		.woocommerce .cart-collaterals .cart-subtotal .amount,
		.woocommerce .cart-collaterals .shipping,
		.woocommerce .cart-collaterals .cart-subtotal,
		.shortcode_title.secondary_font,
		.post_header_date,
		.post_footer_date,
		.blog-list-date,
		.comment-metadata,
		.more-link,
        .main-navigation .megamenu-1-col > ul > li > a,
		.main-navigation .megamenu-2-col > ul > li > a,
		.main-navigation .megamenu-3-col > ul > li > a,
		.main-navigation .megamenu-4-col > ul > li > a,
		#site-navigation > ul > li > a,
		#mobile-main-navigation ul li,
		.vc_btn,
		.nav-previous a,
		.nav-next a
		{
			font-family: <?php echo $custom_secondary_font; ?>
		}


		
		/***************************************************************/
		/* Body (.st-content) ******************************************/
		/***************************************************************/
		
		.st-content {
			
			<?php if ( (isset($mr_tailor_theme_options['main_bg_color'])) && (trim($mr_tailor_theme_options['main_bg_color']) != "" ) ) : ?>
				background-color:<?php echo $mr_tailor_theme_options['main_bg_color'] ?>;
			<?php endif; ?>
			
			<?php if ( (isset($mr_tailor_theme_options['main_bg_image']['url'])) && (trim($mr_tailor_theme_options['main_bg_image']['url']) != "" ) ) : ?>
				background-size: cover;
				background-attachment:fixed; /* creates a weird chrome bug - fix with refreshBackgrounds() function */
			<?php endif; ?>
		}
		
		<?php if ( (isset($mr_tailor_theme_options['main_bg_image']['url'])) && (trim($mr_tailor_theme_options['main_bg_image']['url']) != "" ) ) : ?>
		/* min-width 641px, medium screens */
		@media only screen and (min-width: 40.063em) {
			.st-content {
				background-image: url(<?php echo $mr_tailor_theme_options['main_bg_image']['url'] ?>);
			}
		}
		<?php endif; ?>
		
		
		<?php if ( (isset($mr_tailor_theme_options['main_bg_color'])) && (trim($mr_tailor_theme_options['main_bg_color']) != "" ) ) : ?>
			
			.slide-from-left.filters,
			.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
			.woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle
			{
				background:<?php echo $mr_tailor_theme_options['main_bg_color'] ?>;
			}
		<?php endif; ?>
			
			
		/***************************************************************/
		/* Body Text Color  *******************************************/
		/***************************************************************/
			
		<?php if ( (isset($mr_tailor_theme_options['body_color'])) && (trim($mr_tailor_theme_options['body_color']) != "" ) ) : ?>
			
			body,
			pre,
			label,
			blockquote,
			blockquote p,
			blockquote cite,
			abbr,
			acronym,
			table tr td,
			.woocommerce .recently_viewed_in_single h2,
			.product-nav-previous a,
			.product-nav-next a,
			#shipping_method .check_label_radio,
			.cart-collaterals table tr th,
			.woocommerce-checkout .woocommerce-info:before,
			.woocommerce-checkout .woocommerce-info,
			.payment_methods .check_label_radio,
			.order_details.bacs_details li strong,
			.thank_you_header .order_details li strong,
			.woocommerce #content div.product p.stock.in-stock,
			.woocommerce div.product p.stock.in-stock,
			.woocommerce-page #content div.product p.stock.in-stock,
			.woocommerce-page div.product p.stock.in-stock,
			.wpb_widgetised_column a,
			.quantity input.qty,
			.woocommerce .quantity .qty,
			.shop_table.order_details tfoot th:first-child,
			.shop_table.order_details tfoot td:first-child,
			.shop_table.woocommerce-checkout-review-order-table tfoot th:first-child,
			.shop_table.woocommerce-checkout-review-order-table tfoot td:first-child,
			.woocommerce .shop_table.customer_details tbody tr th
			{
				color: <?php echo esc_html($mr_tailor_theme_options['body_color']); ?>;
			}
			
			.woocommerce a.remove
			{
				color: <?php echo esc_html($mr_tailor_theme_options['body_color']); ?> !important;
			}
			
			.product_after_shop_loop .price,
			.woocommerce #content div.product p.price del,
			.woocommerce #content div.product span.price del,
			.woocommerce div.product p.price del,
			.woocommerce div.product span.price del,
			.woocommerce-page #content div.product p.price del,
			.woocommerce-page #content div.product span.price del,
			.woocommerce-page div.product p.price del,
			.woocommerce-page div.product span.price del
			{
				color: rgba(<?php echo getbowtied_hex2rgb($mr_tailor_theme_options['body_color']); ?>,0.80);
			}
			
			a:hover, a:focus,
			.woocommerce .woocommerce-breadcrumb a:hover,
			.woocommerce-page .woocommerce-breadcrumb a:hover,
			.nav-previous-title,
			.nav-next-title,
			.woocommerce #content div.product .woocommerce-tabs ul.tabs li a:hover,
			.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover,
			.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a:hover,
			.woocommerce-page div.product .woocommerce-tabs ul.tabs li a:hover,
			.woocommerce table.shop_table th,
			.woocommerce-page table.shop_table th,
			.woocommerce-page #payment div.payment_box,
			.woocommerce-checkout .order_details.bacs_details li,
			.thank_you_header .order_details li,
			.customer_details dt,
			.wpb_widgetised_column,
			.wpb_widgetised_column .product_list_widget .star-rating span:before,
			.wpb_widgetised_column .widget_layered_nav ul li small.count,
			.post_header_date a:hover,
			.post_footer_date a:hover,
			.comment-metadata,
			.post_meta_archive a:hover,
			.products li:hover .add_to_wishlist:before,
			.product_after_shop_loop .price del,
			.wc-layered-nav-rating a
			{
				color: rgba(<?php echo getbowtied_hex2rgb($mr_tailor_theme_options['body_color']); ?>,0.55);
			}
			
			.widget.widget_price_filter .price_slider_amount .button:hover,
			.woocommerce a.remove:hover
			{
				color: rgba(<?php echo getbowtied_hex2rgb($mr_tailor_theme_options['body_color']); ?>,0.55) !important;
			}
			
			.required,
			.woocommerce form .form-row .required,
			.wp-caption-text,
			.woocommerce .woocommerce-breadcrumb,
			.woocommerce-page .woocommerce-breadcrumb,
			.woocommerce .woocommerce-result-count,
			.woocommerce-page .woocommerce-result-count
			.woocommerce div.product .woocommerce-tabs ul.tabs li a,
			.woocommerce #content div.product .woocommerce-tabs ul.tabs li a,
			.woocommerce-page div.product .woocommerce-tabs ul.tabs li a,
			.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a,
			.product_list_widget .wishlist-out-of-stock,
			.woocommerce #reviews #comments ol.commentlist li .comment-text .verified,
			.woocommerce-page #reviews #comments ol.commentlist li .comment-text .verified,
			.woocommerce #content div.product p.stock.out-of-stock,
			.woocommerce div.product p.stock.out-of-stock,
			.woocommerce-page #content div.product p.stock.out-of-stock,
			.woocommerce-page div.product p.stock.out-of-stock,
			.yith-wcwl-add-button:before,
			.post_header_date a,
			.post_footer_date a,
			.comment-metadata,
			.post_meta_archive a
			{
				color: rgba(<?php echo getbowtied_hex2rgb($mr_tailor_theme_options['body_color']); ?>,0.45);
			}
			
			.products a.button:hover
			{
				color: rgba(<?php echo getbowtied_hex2rgb($mr_tailor_theme_options['body_color']); ?>,0.45) !important; 
			}
			
			.products .add_to_wishlist:before
			{
				color: rgba(<?php echo getbowtied_hex2rgb($mr_tailor_theme_options['body_color']); ?>,0.40);
			}
			
			.woocommerce .star-rating:before,
			.woocommerce-page .star-rating:before,
			.woocommerce p.stars,
			.woocommerce-page p.stars
			{
				color: rgba(<?php echo getbowtied_hex2rgb($mr_tailor_theme_options['body_color']); ?>,0.35); 
			}
			
			pre
			{
				border-color: rgba(<?php echo getbowtied_hex2rgb($mr_tailor_theme_options['body_color']); ?>,0.15);
			}
			
			hr,
			.woocommerce div.product .woocommerce-tabs ul.tabs li,
			.woocommerce #content div.product .woocommerce-tabs ul.tabs li,
			.woocommerce-page div.product .woocommerce-tabs ul.tabs li,
			.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li,
			.wpb_widgetised_column .tagcloud a
			{
				border-color: rgba(<?php echo getbowtied_hex2rgb($mr_tailor_theme_options['body_color']); ?>,0.13);
			}
			
			.woocommerce table.shop_table tbody th,
			.woocommerce table.shop_table tbody td,
			.woocommerce table.shop_table tbody tr:first-child td,
			.woocommerce table.shop_table tfoot th,
			.woocommerce table.shop_table tfoot td,
			.woocommerce .shop_table.customer_details tbody tr:first-child th,
			.woocommerce .cart-collaterals .cart_totals tr.order-total td,
			.woocommerce .cart-collaterals .cart_totals tr.order-total th,
			.woocommerce-page .cart-collaterals .cart_totals tr.order-total td,
			.woocommerce-page .cart-collaterals .cart_totals tr.order-total th,
			.woocommerce .my_account_container table.shop_table.order_details tr:first-child td,
			.woocommerce-page .my_account_container table.shop_table.order_details tr:first-child td,
			.woocommerce .my_account_container table.shop_table order_details_footer tr:last-child td,
			.woocommerce-page .my_account_container table.shop_table.order_details_footer tr:last-child td,
			.blog-isotop-master-wrapper #nav-below.paging-navigation,
			.payment_methods li:first-child
			{
				border-top-color: rgba(<?php echo getbowtied_hex2rgb($mr_tailor_theme_options['body_color']); ?>,0.13);
			}
			
			abbr,
			acronym
			{
				border-bottom-color: rgba(<?php echo getbowtied_hex2rgb($mr_tailor_theme_options['body_color']); ?>,1);	
			}
			
			table tr,
			.woocommerce .my_account_container table.shop_table.order_details tr:last-child td,
			.woocommerce-page .my_account_container table.shop_table.order_details tr:last-child td,
			.payment_methods li,
			.slide-from-left.filters aside,
			.quantity input.qty,
			.woocommerce .quantity .qty,
			.woocommerce .shop_table.customer_details tbody tr:last-child th,
			.woocommerce .shop_table.customer_details tbody tr:last-child td
			{
				border-bottom-color: rgba(<?php echo getbowtied_hex2rgb($mr_tailor_theme_options['body_color']); ?>,0.13);
			}
			
			
			.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
			.woocommerce-page .widget_price_filter .ui-slider .ui-slider-range
			{
				background: rgba(<?php echo getbowtied_hex2rgb($mr_tailor_theme_options['body_color']); ?>,0.35);
			}
			
			.woocommerce-checkout .thank_you_bank_details h3:after,
			.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,
			.woocommerce-page .widget_price_filter .price_slider_wrapper .ui-widget-content,
			.blog-isotope:before,
			.blog-isotope:after
			{
				background: rgba(<?php echo getbowtied_hex2rgb($mr_tailor_theme_options['body_color']); ?>,0.13);
			}
			
			pre
			{
				background: rgba(<?php echo getbowtied_hex2rgb($mr_tailor_theme_options['body_color']); ?>,0.05);
			}
			
			.comments_section,
			.cart-buttons,
			.woocommerce .cart-collaterals,
			.woocommerce-page .cart-collaterals,
			.single_product_summary_upsell,
			.single_product_summary_related,
			.shop_table.order_details tfoot,
			.shop_table.woocommerce-checkout-review-order-table tfoot
			{
				background: rgba(<?php echo getbowtied_hex2rgb($mr_tailor_theme_options['body_color']); ?>,0.04);
			}
			
				
			/* min-width 641px, medium screens */
			@media only screen and (min-width: 40.063em) {
				
				.woocommerce #content nav.woocommerce-pagination ul,
				.woocommerce nav.woocommerce-pagination ul,
				.woocommerce-page #content nav.woocommerce-pagination ul,
				.woocommerce-page nav.woocommerce-pagination ul
				{
					border-color: rgba(<?php echo getbowtied_hex2rgb($mr_tailor_theme_options['body_color']); ?>,0.13)  transparent rgba(<?php echo getbowtied_hex2rgb($mr_tailor_theme_options['body_color']); ?>,0.13) rgba(<?php echo getbowtied_hex2rgb($mr_tailor_theme_options['body_color']); ?>,0.13);
				}
				
				.woocommerce #content nav.woocommerce-pagination ul li,
				.woocommerce nav.woocommerce-pagination ul li,
				.woocommerce-page #content nav.woocommerce-pagination ul li,
				.woocommerce-page nav.woocommerce-pagination ul li
				{
					border-right-color: rgba(<?php echo getbowtied_hex2rgb($mr_tailor_theme_options['body_color']); ?>,0.13);
				}
				
				.woocommerce div.product .woocommerce-tabs ul.tabs li,
				.woocommerce #content div.product .woocommerce-tabs ul.tabs li,
				.woocommerce-page div.product .woocommerce-tabs ul.tabs li,
				.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li
				{
					border-bottom-color:  transparent;
				}
			}
			
		<?php endif; ?>
		
		
		
		/***************************************************************/
		/* Headings Color  *********************************************/
		/***************************************************************/
		
		<?php if ( (isset($mr_tailor_theme_options['headings_color'])) && (trim($mr_tailor_theme_options['headings_color']) != "" ) ) : ?>
			
			h1, h2, h3, h4, h5, h6,
			table tr th,
			.woocommerce div.product span.price,
			.woocommerce-page div.product span.price,
			.woocommerce #content div.product span.price,
			.woocommerce-page #content div.product span.price,
			.woocommerce div.product p.price,
			.woocommerce-page div.product p.price,
			.woocommerce #content div.product p.price,
			.woocommerce-page #content div.product p.price,
			.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active a,
			.woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
			.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active a,
			.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active a,
			.woocommerce table.shop_table .product-name a,
			.woocommerce-page table.shop_table .product-name a,
			ul.products h3 a,
			.products ul h3 a,
			.edit-account legend
			{
				color: <?php echo esc_html($mr_tailor_theme_options['headings_color']); ?>;
			}
			
			.wpb_widgetised_column .widget-title
			{
				color: <?php echo esc_html($mr_tailor_theme_options['headings_color']); ?> !important;
			}
			
			ul.products h3 a:hover,
			.products ul h3 a:hover
			{
				color: rgba(<?php echo getbowtied_hex2rgb($mr_tailor_theme_options['headings_color']); ?>,0.8);
			}
			
			.woocommerce div.product .woocommerce-tabs ul.tabs li.active,
			.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active,
			.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active,
			.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active
			{
				border-bottom-color: <?php echo esc_html($mr_tailor_theme_options['headings_color']); ?>;
			}
			
			.woocommerce-checkout .entry-title:after,
			.woocommerce-account .entry-title:after
			{
				background: <?php echo esc_html($mr_tailor_theme_options['headings_color']); ?>;
			}
			
		<?php endif; ?>
				
				
				
		/***************************************************************/
		/* Main Color  *************************************************/
		/***************************************************************/
		
		<?php if ( (isset($mr_tailor_theme_options['main_color'])) && (trim($mr_tailor_theme_options['main_color']) != "" ) ) : ?>
		
		.widget .tagcloud a:hover,
		.woocommerce span.onsale,
		.woocommerce-page span.onsale,
		.woocommerce nav.woocommerce-pagination ul li span.current, 
		.woocommerce nav.woocommerce-pagination ul li a:hover, 
		.woocommerce nav.woocommerce-pagination ul li a:focus, 
		.woocommerce #content nav.woocommerce-pagination ul li span.current, 
		.woocommerce #content nav.woocommerce-pagination ul li a:hover, 
		.woocommerce #content nav.woocommerce-pagination ul li a:focus, 
		.woocommerce-page nav.woocommerce-pagination ul li span.current, 
		.woocommerce-page nav.woocommerce-pagination ul li a:hover, 
		.woocommerce-page nav.woocommerce-pagination ul li a:focus, 
		.woocommerce-page #content nav.woocommerce-pagination ul li span.current, 
		.woocommerce-page #content nav.woocommerce-pagination ul li a:hover, 
		.woocommerce-page #content nav.woocommerce-pagination ul li a:focus,
		.woocommerce .widget_layered_nav_filters ul li a,
		.woocommerce-page .widget_layered_nav_filters ul li a,
		.woocommerce .widget_layered_nav ul li.chosen a,
		.woocommerce-page .widget_layered_nav ul li.chosen a,
		.nl-field ul,
		.nl-form .nl-submit,
		.audioplayer-bar-played,
		.audioplayer-volume-adjust div div,
		.select2-results .select2-highlighted,
		.slide-from-right,
		.with_thumb_icon,
		/*begin app.css*/
		.woocommerce-page a.button, .woocommerce-page a.button,
		.woocommerce-page a.button.alt,
		.woocommerce-page button.button,
		.woocommerce-page button.button,
		.woocommerce-page button.button.alt,
		.woocommerce-page #content input.woocommerce-Button.button,
		.woocommerce-page #respond input#submit,
		.woocommerce-page #respond input#submit,
		.woocommerce-page #content #respond input#submit,
		.woocommerce-page #respond #content input#submit,
		.woocommerce-page a.button.alt,
		.woocommerce-page a.alt.button,
		.woocommerce-page button.button.alt,
		.woocommerce-page button.alt.button,
		.woocommerce-page #respond input.alt#submit,
		.woocommerce-page #content input.alt.button,
		ul.pagination li.current a,
		ul.pagination li.current a:hover, ul.pagination li.current a:focus,
		.progress .meter,
		.sub-nav dt.active a,
		.sub-nav dd.active a,
		.sub-nav li.active a,
		.top-bar-section ul li > a.button, .top-bar-section ul .woocommerce-page li > a.button, .woocommerce-page .top-bar-section ul li > a.button,
		.top-bar-section ul .woocommerce-page li > a.button.alt,
		.woocommerce-page .top-bar-section ul li > a.button.alt,
		.top-bar-section ul li.active > a,
		.no-js .top-bar-section ul li:active > a,
		.woocommerce-edit-address #content .woocommerce input.button
		/*end app.css*/
		{
			background: <?php echo $mr_tailor_theme_options['main_color'] ?>;
		}
		
		.blog_list_img
		{
			background-color: <?php echo $mr_tailor_theme_options['main_color'] ?>;
		}
		
		.select2-container,
		.big-select,
		select.big-select,
		.select2-dropdown-open.select2-drop-above .select2-choice,
		.select2-dropdown-open.select2-drop-above .select2-choices, 
		.select2-container .select2-selection,
		.yith-wcwl-add-button,
		.yith-wcwl-wishlistaddedbrowse .feedback,
		.yith-wcwl-wishlistexistsbrowse .feedback,
		.shopping_bag_items_number,
		.wishlist_items_number,
		.woocommerce .star-rating span:before,
		.woocommerce-page .star-rating span:before,
		/*begin app.css*/
		.woocommerce .woocommerce-breadcrumb a,
		.woocommerce-page .woocommerce-breadcrumb a,
		.panel.callout a,
		.side-nav li a,
		.has-tip:hover, .has-tip:focus,
		a,
		.edit-link,
		.comment-reply,
		.comment-edit-link,
		.woocommerce p.stars a.active:after,
		.woocommerce p.stars a:hover:after,
		.woocommerce-page p.stars a.active:after,
		.woocommerce-page p.stars a:hover:after,
		.yith-wcwl-wishlistaddedbrowse,
		.yith-wcwl-wishlistexistsbrowse,
		.woocommerce-ordering:before,
		.woocommerce-page #content .actions .coupon input.button,
		.woocommerce-page #content .actions .coupon input.button.alt,
		.woocommerce-page #content .actions > input.button,
		.woocommerce-page #content .actions > input.button.alt
		/*end app.css*/
		{
			color: <?php echo $mr_tailor_theme_options['main_color'] ?>;
		}
		
		.products a.button,
		.cart-buttons .update_and_checkout .update_cart,
		.cart-buttons .coupon .apply_coupon,
		.widget.widget_price_filter .price_slider_amount .button,
		#wishlist-offcanvas .button,
		#wishlist-offcanvas input[type="button"],
		#wishlist-offcanvas input[type="reset"],
		#wishlist-offcanvas input[type="submit"],
		/*begin app.css*/
		.tooltip.opened
		/*end app.css*/
		{
			color: <?php echo $mr_tailor_theme_options['main_color'] ?> !important;
		}
		
		.shortcode_products_slider .products a.button:hover
		{
			color: rgba(<?php echo getbowtied_hex2rgb($mr_tailor_theme_options['main_color']); ?>,0.8) !important;
		}
		
		/*begin app.css*/
		.label,
		button,
		.button,
		.woocommerce-page a.button, .woocommerce-page a.button,
		.woocommerce-page a.button.alt,
		.woocommerce-page .woocommerce a.button,
		.woocommerce .woocommerce-page a.button,
		.woocommerce-page .woocommerce a.button.alt,
		.woocommerce .woocommerce-page a.button.alt,
		.woocommerce-page button.button,
		.woocommerce-page button.button,
		.woocommerce-page button.button.alt,
		.woocommerce-page .woocommerce button.button,
		.woocommerce .woocommerce-page button.button,
		.woocommerce-page .woocommerce button.button.alt,
		.woocommerce .woocommerce-page button.button.alt,
		.woocommerce-page #respond input#submit,
		.woocommerce-page .woocommerce #respond input#submit,
		.woocommerce #respond .woocommerce-page input#submit,
		.woocommerce-page #respond input#submit,
		.woocommerce-page #content #respond input#submit,
		.woocommerce-page #respond #content input#submit,
		.woocommerce-page #content .woocommerce #respond input#submit,
		.woocommerce #respond .woocommerce-page #content input#submit,
		.woocommerce-page a.button.alt,
		.woocommerce-page a.alt.button,
		.woocommerce-page .woocommerce a.alt.button,
		.woocommerce .woocommerce-page a.alt.button,
		.woocommerce-page button.button.alt,
		.woocommerce-page button.alt.button,
		.woocommerce-page .woocommerce button.alt.button,
		.woocommerce .woocommerce-page button.alt.button,
		.woocommerce-page input.alt.button,
		.woocommerce-page #respond input.alt#submit,
		.woocommerce-page #content input.alt.button,
		.woocommerce-page .woocommerce input.alt.button,
		.woocommerce .woocommerce-page input.alt.button,
		.woocommerce-page .woocommerce #respond input.alt#submit,
		.woocommerce #respond .woocommerce-page input.alt#submit,
		.woocommerce-page .woocommerce #content input.alt.button,
		.woocommerce #content .woocommerce-page input.alt.button,
		.woocommerce a.button,
		.woocommerce .woocommerce-page a.button,
		.woocommerce-page .woocommerce a.button,
		.woocommerce .woocommerce-page a.button.alt,
		.woocommerce-page .woocommerce a.button.alt,
		.woocommerce a.button,
		.woocommerce a.button.alt,
		.woocommerce button.button,
		.woocommerce .woocommerce-page button.button,
		.woocommerce-page .woocommerce button.button,
		.woocommerce .woocommerce-page button.button.alt,
		.woocommerce-page .woocommerce button.button.alt,
		.woocommerce button.button,
		.woocommerce button.button.alt,
		.woocommerce input.button,
		.woocommerce .woocommerce-page #respond input#submit,
		.woocommerce-page #respond .woocommerce input#submit,
		.woocommerce #respond input#submit,
		.woocommerce #respond input#submit,
		.woocommerce #content .woocommerce-page #respond input#submit,
		.woocommerce-page #respond .woocommerce #content input#submit,
		.woocommerce #content input.button,
		.woocommerce #content #respond input#submit,
		.woocommerce #respond #content input#submit,
		.woocommerce a.button.alt,
		.woocommerce .woocommerce-page a.alt.button,
		.woocommerce-page .woocommerce a.alt.button,
		.woocommerce a.alt.button,
		.woocommerce button.button.alt,
		.woocommerce .woocommerce-page button.alt.button,
		.woocommerce-page .woocommerce button.alt.button,
		.woocommerce button.alt.button,
		.woocommerce .woocommerce-page input.alt.button,
		.woocommerce-page .woocommerce input.alt.button,
		.woocommerce .woocommerce-page #respond input.alt#submit,
		.woocommerce-page #respond .woocommerce input.alt#submit,
		.woocommerce .woocommerce-page #content input.alt.button,
		.woocommerce-page #content .woocommerce input.alt.button,
		.woocommerce input.alt.button,
		.woocommerce #respond input.alt#submit,
		.woocommerce #content input.alt.button,
		input[type="button"],
		input[type="reset"],
		input[type="submit"],
		.alert-box,
		.woocommerce .quantity .plus,
		.woocommerce .quantity .minus,
		.woocommerce-page .quantity .plus,
		.woocommerce-page .quantity .minus,
		.woocommerce-page #content .quantity .plus,
		.woocommerce-page #content .quantity .minus
		/*end app.css*/
		{
			background-color: <?php echo $mr_tailor_theme_options['main_color'] ?>;
		}
		
		.main-navigation ul ul li a:hover,
		.box-share-link:hover span
		{
			border-bottom-color: <?php echo $mr_tailor_theme_options['main_color'] ?>;
		}
		
		.login_header
		{
			border-top-color: <?php echo $mr_tailor_theme_options['main_color'] ?>;			
		}
		
		.cart-buttons .update_and_checkout .update_cart,
		.cart-buttons .coupon .apply_coupon,
		.shopping_bag_items_number,
		.wishlist_items_number,
		.widget .tagcloud a:hover,
		.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
		.woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle,
		.woocommerce-page #content .actions .coupon input.button,
		.woocommerce-page #content .actions .coupon input.button.alt,
		.woocommerce-page #content .actions > input.button,
		.woocommerce-page #content .actions > input.button.alt
		{
			border-color: <?php echo $mr_tailor_theme_options['main_color'] ?>;
		}
		
		.cart-buttons .update_and_checkout .update_cart,
		.cart-buttons .coupon .apply_coupon
		{
			border-color: <?php echo $mr_tailor_theme_options['main_color'] ?> !important;
		}
		
		<?php endif; ?>
				
		
		/***************************************************************/
		/* Top Bar *****************************************************/
		/***************************************************************/

		#site-top-bar,
		#site-navigation-top-bar .sf-menu ul
		{
			<?php if ( (isset($mr_tailor_theme_options['top_bar_background_color'])) && (trim($mr_tailor_theme_options['top_bar_background_color']) != "" ) ) : ?>
				background: <?php echo $mr_tailor_theme_options['top_bar_background_color'] ?>;
			<?php endif; ?>
		}
		
		<?php if ( (isset($mr_tailor_theme_options['top_bar_typography'])) && (trim($mr_tailor_theme_options['top_bar_typography']) != "" ) ) : ?>
		#site-top-bar,
		#site-top-bar a
		{
			color:<?php echo $mr_tailor_theme_options['top_bar_typography'] ?>;
		}
		<?php endif; ?>
		
		
		
		/***************************************************************/
		/* 	Header *****************************************************/
		/***************************************************************/
		
		<?php
		
		if ( (isset($mr_tailor_theme_options['site_logo']['url'])) && (trim($mr_tailor_theme_options['site_logo']['url']) != "" ) ) {
			
			if (is_ssl()) {
				$site_logo = str_replace("http://", "https://", $mr_tailor_theme_options['site_logo']['url']);		
			} else {
				$site_logo = $mr_tailor_theme_options['site_logo']['url'];
			}
			
			//$site_logo_size = getimagesize($site_logo);
			//$site_logo_width = $site_logo_size[0];
			//$site_logo_height = $site_logo_size[1];
		?>
		
		.site-branding {
			height:auto;
			border:0;
			padding:0;
		}
		
		<?php if ( (isset($mr_tailor_theme_options['logo_height'])) && (trim($mr_tailor_theme_options['logo_height']) != "" ) ) { ?>
		<?php $site_logo_height = $mr_tailor_theme_options['logo_height']; ?>
		.site-branding img {
			height:<?php echo $site_logo_height; ?>px;
			width:auto;
		}
		<?php } ?>
		
		@media only screen and (min-width: 40.063em) {
			<?php if ( $site_logo_height < 54 ) { ?>
				
				.site-branding
				{
					padding:<?php echo (54-$site_logo_height)/2; ?>px 0;
				}
				
				#site-navigation
				{
					line-height: 54px;
				}
				
			<?php } else { ?>	
				
				#site-navigation {
					line-height:<?php echo $site_logo_height; ?>px;
				}
				
				.site-header-sticky .site-branding
				{
					padding: 7px 0;
				}
				
			<?php } ?>
			
		}
		
		/*.site-tools {
			top:<?php //echo $site_logo_height / 2 - 20; ?>px;
		}*/

		<?php
		} else {
		?>
		
		@media only screen and (min-width: 64.063em) {
			#site-navigation {
				line-height:66px; /* 66px/2 */
			}
			
			.site-header-sticky .site-branding
			{
				min-height: 40px;
				padding: 5px 25px;
				margin-top: 7px;
			}

			.site-header-sticky .site-title
			{
				font-size: 24px;
			}
			
		}
		
		<?php
		}
		?>

		<?php if ( (isset($mr_tailor_theme_options['header_paddings'])) && (trim($mr_tailor_theme_options['header_paddings']) != "" ) ) { ?>
		.site-header {
			padding:<?php echo $mr_tailor_theme_options['header_paddings']; ?>px 0;
		}
		<?php } ?>
		
		<?php if ( (isset($mr_tailor_theme_options['main_header_typography']['font-size'])) && (trim($mr_tailor_theme_options['main_header_typography']['font-size']) != "" ) ) : ?>
		.site-header,
		.site-header-sticky,
		#site-navigation,
		.shortcode_banner_simple_height_bullet span
		{
			font-size: <?php echo $mr_tailor_theme_options['main_header_typography']['font-size'] ?>;
		}
		<?php endif; ?>
		
		<?php if ( (isset($mr_tailor_theme_options['main_header_background_color'])) && (trim($mr_tailor_theme_options['main_header_background_color']) != "" ) ) : ?>
		.site-header,
		.site-header-sticky,
		.shopping_bag_items_number,
        .wishlist_items_number
		{
			background: <?php echo $mr_tailor_theme_options['main_header_background_color'] ?>;
		}
		<?php endif; ?>
        
        
        
        <?php if ( (isset($mr_tailor_theme_options['main_header_typography']['color'])) && (trim($mr_tailor_theme_options['main_header_typography']['color']) != "" ) ) : ?>
		.site-header,
		#site-navigation a,
		.site-header-sticky,
		.site-header-sticky a,
        .site-tools ul li a,
        .shopping_bag_items_number,
        .wishlist_items_number,
        .site-title a,
        .widget_product_search .search-but-added,
        .widget_search .search-but-added
		{
			color:<?php echo $mr_tailor_theme_options['main_header_typography']['color'] ?>;
		}
		.site-tools.site_tools_sticky ul li a
		{
			color:<?php echo $mr_tailor_theme_options['main_header_typography']['color'] ?> !important;
		}
        .shopping_bag_items_number,
        .wishlist_items_number,
        .site-branding
        {
            border-color: <?php echo $mr_tailor_theme_options['main_header_typography']['color'] ?>;
        }
		<?php endif; ?>
        
        /***************************************************************/
		/* Transparent Header ******************************************/
		/***************************************************************/
		
		<?php if ( (isset($mr_tailor_theme_options['main_header_background_transparency'])) && ($mr_tailor_theme_options['main_header_background_transparency'] == "1" ) ) : ?>                        
		
            .transparent_header .top-headers-wrapper {
                position:absolute;
            }

            <?php 
            
            $content_padding_top = $mr_tailor_theme_options['logo_height'] + 2*$mr_tailor_theme_options['header_paddings'] + 70 + 30;
    
            if ( (isset($mr_tailor_theme_options['header_layout'])) && ($mr_tailor_theme_options['header_layout'] == "1" ) ) {
                $content_padding_top += 70;
            }
    
            ?>

            .blog .transparent_header .content-area,
            .single:not(.single-portfolio) .transparent_header .content-area,
            .archive .transparent_header .content-area,
            .page-template-default .transparent_header .content-area
            {
                padding-top:<?php echo $content_padding_top; ?>px;
            }
        
            .transparent_header .entry-header.with_featured_img,
            .transparent_header .category_header.with_featured_img
            {
                margin-top: -<?php echo $content_padding_top; ?>px;
                padding-top:<?php echo $content_padding_top; ?>px;
            }
        
            .transparent_header .site-header
            {
                background: transparent;
            }        
            
            /* Light Header ******************************************/
        
            .transparent_header.transparency_light .site-header,
            .transparent_header.transparency_light #site-navigation a,
            .transparent_header.transparency_light .site-header-sticky,
            .transparent_header.transparency_light .site-header-sticky a,
            .transparent_header.transparency_light .site-tools ul li a,
            .transparent_header.transparency_light .shopping_bag_items_number,
            .transparent_header.transparency_light .wishlist_items_number,
            .transparent_header.transparency_light .site-title a,
            .transparent_header.transparency_light .widget_product_search .search-but-added,
            .transparent_header.transparency_light .widget_search .search-but-added
            {
                color:<?php echo $mr_tailor_theme_options['main_header_transparent_light_color'] ?>;
            }
            .transparent_header.transparency_light .shopping_bag_items_number,
            .transparent_header.transparency_light .wishlist_items_number,
            .transparent_header.transparency_light .site-branding
            {
                border-color: <?php echo $mr_tailor_theme_options['main_header_transparent_light_color'] ?>;
            }
            .transparent_header.transparency_light .shopping_bag_items_number,
            .transparent_header.transparency_light .wishlist_items_number
            {
                background: <?php echo $mr_tailor_theme_options['main_header_transparent_light_color'] ?>;
                color: <?php echo $mr_tailor_theme_options['main_header_transparent_dark_color'] ?>;
            }
        
            /* Dark Header ******************************************/    
        
            .transparent_header.transparency_dark .site-header,
            .transparent_header.transparency_dark #site-navigation a,
            .transparent_header.transparency_dark .site-header-sticky,
            .transparent_header.transparency_dark .site-header-sticky a,
            .transparent_header.transparency_dark .site-tools ul li a,
            .transparent_header.transparency_dark .shopping_bag_items_number,
            .transparent_header.transparency_dark .wishlist_items_number,
            .transparent_header.transparency_dark .site-title a,
            .transparent_header.transparency_dark .widget_product_search .search-but-added,
            .transparent_header.transparency_dark .widget_search .search-but-added
            {
                color:<?php echo $mr_tailor_theme_options['main_header_transparent_dark_color'] ?>;
            }
            .transparent_header.transparency_dark .shopping_bag_items_number,
            .transparent_header.transparency_dark .wishlist_items_number,
            .transparent_header.transparency_dark .site-branding
            {
                border-color: <?php echo $mr_tailor_theme_options['main_header_transparent_dark_color'] ?>;
            }
            .transparent_header.transparency_dark .shopping_bag_items_number,
            .transparent_header.transparency_dark .wishlist_items_number
            {
                background: <?php echo $mr_tailor_theme_options['main_header_transparent_dark_color'] ?>;
                color: <?php echo $mr_tailor_theme_options['main_header_transparent_light_color'] ?>;
            }
		
        <?php endif; ?>
        
        /***************************************************************/
		/* /Transparent Header *****************************************/
		/***************************************************************/

		
		/***************************************************************/
		/* Custom Menu Colors ******************************************/
		/***************************************************************/

		<?php if ( (isset($mr_tailor_theme_options['navigation_bg'])) && (trim($mr_tailor_theme_options['navigation_bg']) != "" ) ) : ?>

		.main-navigation ul ul,
		.main-navigation ul ul ul,
		.main-navigation ul ul ul ul,
		.main-navigation ul ul ul ul ul
		{
			background: <?php echo $mr_tailor_theme_options['navigation_bg'] ?>;
		}

		<?php endif; ?>

		<?php if ( (isset($mr_tailor_theme_options['navigation_link_color'])) && (trim($mr_tailor_theme_options['navigation_link_color']) != "" ) ) : ?>

		.main-navigation ul ul li a {
			color: <?php echo $mr_tailor_theme_options['navigation_link_color'] ?> !important;
		}

		.main-navigation ul ul li a:hover, .box-share-link:hover span {
			border-bottom-color: <?php echo $mr_tailor_theme_options['navigation_link_color'] ?>;
		}

		<?php endif; ?>

		/***************************************************************/
		/* /Custom Menu Colors *****************************************/
		/***************************************************************/
		
		
		
		
		/***************************************************************/
		/* Footer ******************************************************/
		/***************************************************************/

		#site-footer
		{
			<?php if ( (isset($mr_tailor_theme_options['footer_background_color'])) && (trim($mr_tailor_theme_options['footer_background_color']) != "" ) ) : ?>
				background: <?php echo $mr_tailor_theme_options['footer_background_color'] ?>;
			<?php endif; ?>
		}
		
		<?php if ( (isset($mr_tailor_theme_options['footer_texts_color'])) && (trim($mr_tailor_theme_options['footer_texts_color']) != "" ) ) : ?>
		#site-footer,
		#site-footer .widget-title,
		#site-footer a:hover,
        #site-footer .star-rating span:before,
        #site-footer .star-rating span:before
		{
			color:<?php echo $mr_tailor_theme_options['footer_texts_color'] ?>;
		}
		<?php endif; ?>
		
		<?php if ( (isset($mr_tailor_theme_options['footer_links_color'])) && (trim($mr_tailor_theme_options['footer_links_color']) != "" ) ) : ?>
		#site-footer a
		{
			color:<?php echo $mr_tailor_theme_options['footer_links_color'] ?>;
		}
		<?php endif; ?>

		
		/***************************************************************/
		/* Breadcrumbs *************************************************/
		/***************************************************************/
		
		
		<?php if ( (isset($mr_tailor_theme_options['breadcrumbs'])) && ($mr_tailor_theme_options['breadcrumbs']) == "0" ) : ?>
		.woocommerce .woocommerce-breadcrumb,
		.woocommerce-page .woocommerce-breadcrumb
		{
			display:none;
		}
		<?php endif; ?>
		
		
		/***************************************************************/
		/* Slider ******************************************************/
		/***************************************************************/
		
		<?php
		$slide_counter = 0;
		while($slider_metabox->have_fields('items'))
		{
			$slide_counter++;
		?>
			
			.main-slider .slide_<?php echo $slide_counter; ?> {
				background-image:url(<?php echo ($slider_metabox->get_the_value('imgurl')); ?>);
			}
			
			.main-slider .slide_<?php echo $slide_counter; ?> .main-slider-elements.animated {				
				-webkit-animation-name: <?php echo ($slider_metabox->get_the_value('slide_animation')); ?>;
				-moz-animation-name: <?php echo ($slider_metabox->get_the_value('slide_animation')); ?>;
				-o-animation-name: <?php echo ($slider_metabox->get_the_value('slide_animation')); ?>;
				animation-name: <?php echo ($slider_metabox->get_the_value('slide_animation')); ?>;
			}
			
			<?php if ($slider_metabox->get_the_value('slider_mood') == 'light') : ?>

				.main-slider .slide_<?php echo $slide_counter; ?> h1 {
					color:#000;
				}
				
				.main-slider .slide_<?php echo $slide_counter; ?> h1:after {
					background:#000;
				}
				
				.main-slider .slide_<?php echo $slide_counter; ?> h2 {
					color:#000;
				}
				
				.main-slider .slide_<?php echo $slide_counter; ?> a.slider_button {
					color:#fff;
					background:#000;
				}
				
				.main-slider .slide_<?php echo $slide_counter; ?> a.slider_button:hover {
					color:#000 !important;
					background:#fff !important;
				}
				
				.main-slider .slide_<?php echo $slide_counter; ?> .arrow-left,
				.main-slider .slide_<?php echo $slide_counter; ?> .arrow-right
				{
					color:#000;
				}
				
			<?php endif; ?>
			
		<?php    
		}	
		?>
        
		/********************************************************************/
		/* Custom CSS *******************************************************/
		/********************************************************************/
		
		<?php if ( (isset($mr_tailor_theme_options['custom_css'])) && (trim($mr_tailor_theme_options['custom_css']) != "" ) ) : ?>
			<?php echo $mr_tailor_theme_options['custom_css'] ?>
		<?php endif; ?>
	
	</style>

<script>
//alert("Base Font: <?php echo $base_font; ?>, Secondary Font: <?php echo $custom_secondary_font; ?>");
</script>

<?php
$content = ob_get_clean();
$content = str_replace(array("\r\n", "\r"), "\n", $content);
$lines = explode("\n", $content);
$new_lines = array();
foreach ($lines as $i => $line) { if(!empty($line)) $new_lines[] = trim($line); }
echo implode($new_lines);
} //function
} //if

add_filter( 'wp_head', 'mr_tailor_custom_styles', 100 );