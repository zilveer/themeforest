<?php
if ( !function_exists ('theretailer_custom_styles') ) {
	
	function theretailer_custom_styles() {
	global $theretailer_theme_options;
	?>
	
	<!-- ******************************************************************** -->
	<!-- Custom CSS Codes -->
	<!-- ******************************************************************** -->
    
    <?php
	if ((isset($theretailer_theme_options['progress_bar'])) && ($theretailer_theme_options['progress_bar'] == "1")) {
	?>
	<style>
	.global_content_wrapper,
	.page_full_width
	{
		opacity:0;
		transition:opacity .3s linear;
	}
	</style>
    <?php } ?>
	
	<?php
	if ((!$theretailer_theme_options['ratings_on_product_listing']) || ($theretailer_theme_options['ratings_on_product_listing'] == "0")) {
	?>
	<style>
	.product_item .star-rating,
	.products_slider_item .star-rating {
		display:none !important;
	}
	</style>
	<?php } ?>
	
	
	<!--woocommerce rating-->
	
	<?php if ( (!isset($theretailer_theme_options['ratings_styles'])) || ($theretailer_theme_options['ratings_styles'] == 0) ) : ?>
		
		<!--rating dashes-->
		<style>
			
			.reviews_nr {
				display:inline-block;
				float:left;
				font-size:13px;
				padding:1px 10px 0 0;
			}
			
			.woocommerce .product_item .star-rating,
			.woocommerce-page .product_item .star-rating {
				float: none;
				height: 15px;
				margin-top: -3px;
			}
			
			.woocommerce div.product .woocommerce-product-rating
			{
				margin-bottom: 20px;
			}
			
			.woocommerce .woocommerce-product-rating .star-rating
			{
				display: inline-block;
				float: none;
				margin: 2px 10px 2px 0;
			}
			
			.star-rating {
				/*float: right;*/
				/*display:inline-block;*/
				float:none;
				display:block;
				width: 80px !important;
				height: 16px;
				margin:0;
				background: url('<?php echo esc_url( get_template_directory_uri() ); ?>/images/star.png') repeat-x left 0 !important;
			}
			
			.star-rating span {
				background: url('<?php echo esc_url( get_template_directory_uri() ); ?>/images/star.png') repeat-x left -32px !important;
				height: 0;
				padding-top: 16px;
				overflow: hidden;
				float: left;
			}
			
			.after_title_reviews .star-rating {
				/*float: right;*/
				/*display:inline-block;*/
				float:left;
				display:block;
				width: 80px;
				height: 16px;
				margin: 0;
				background: url('<?php echo esc_url( get_template_directory_uri() ); ?>/images/star.png') repeat-x left 0 !important;
			}
			
			.woocommerce .star-rating span:before,
			.woocommerce-page .star-rating span:before {
				content: "" !important;
			}
			
			.woocommerce .star-rating:before,
			.woocommerce-page .star-rating:before {
				content: "" !important;
			}
			
			.widget .star-rating {
				/*float: right;*/
				/*display:inline-block;*/
				float:none !important;
				display:block !important;
				width: 80px !important;
				height: 16px !important;
				margin:-4px 0 0 80px !important;
				background: url('<?php echo esc_url( get_template_directory_uri() ); ?>/images/star.png') repeat-x left 0 !important;
			}
			
			.widget .star-rating span {
				background: url('<?php echo esc_url( get_template_directory_uri() ); ?>/images/star.png') repeat-x left -32px !important;
				height: 0 !important;
				padding-top: 16px !important;
				overflow: hidden !important;
				float: left !important;
			}
			
			p.stars span{
				/*width:80px !important;*/
				/*height:5px !important;*/
				position:relative !important;
				/*background:url(images/star.png) repeat-x left 0px !important;*/
				overflow:visible !important;
				/*padding-bottom:5px !important;*/
				margin-right: 0 !important;
			}
			
			p.stars span a:hover,
			p.stars span a:focus
			{
				background:url('<?php echo esc_url( get_template_directory_uri() ); ?>/images/star.png') repeat-x left -18px !important;
			}
			
			p.stars span a.active{
				background:url('<?php echo esc_url( get_template_directory_uri() ); ?>/images/star.png') repeat-x left -34px !important;
			}
			
			.woocommerce p.stars a,
			.woocommerce-page p.stars a {
				margin-right: 0;
			}
			
			.woocommerce p.stars:before,
			.woocommerce-page p.stars:before,
			.woocommerce p.stars:after,
			.woocommerce-page p.stars:after {
				content: "" !important;
			}
			
			.woocommerce p.stars a:before,
			.woocommerce-page p.stars a:before,
			.woocommerce p.stars a:after,
			.woocommerce-page p.stars a:after {
				content: "" !important;
			}
			
			.woocommerce p.stars, .woocommerce-page p.stars {
				/*width:80px !important;*/
			}
			
			.woocommerce p.stars a.star-1,
			.woocommerce-page p.stars a.star-1 {
				width: 16px !important;
				border:0;
				background:url('<?php echo esc_url( get_template_directory_uri() ); ?>/images/star.png') repeat-x left -2px;
				margin-right:5px;
			}
			
			.woocommerce p.stars a.star-2,
			.woocommerce-page p.stars a.star-2 {
				width: 32px !important;
				border:0;
				background:url('<?php echo esc_url( get_template_directory_uri() ); ?>/images/star.png') repeat-x left -2px;
				margin-right:5px;
			}
			
			.woocommerce p.stars a.star-3,
			.woocommerce-page p.stars a.star-3 {
				width: 48px !important;
				border:0;
				background:url('<?php echo esc_url( get_template_directory_uri() ); ?>/images/star.png') repeat-x left -2px;
				margin-right:5px;
			}
			
			.woocommerce p.stars a.star-4,
			.woocommerce-page p.stars a.star-4 {
				width: 64px !important;
				border:0;
				background:url('<?php echo esc_url( get_template_directory_uri() ); ?>/images/star.png') repeat-x left -2px;
				margin-right:5px;
			}
			
			.woocommerce p.stars a.star-5,
			.woocommerce-page p.stars a.star-5 {
				width: 80px !important;
				border:0;
				background:url('<?php echo esc_url( get_template_directory_uri() ); ?>/images/star.png') repeat-x left -2px;
				margin-right:5px;
			}

			.woocommerce .widget_rating_filter ul li .star-rating
			{
			    margin: -2px 0 0 0 !important;
			    top: 0px;
			    float: left !important;
			}
		</style>
		
	<?php else: ?>
		
		<!--rating stars-->
		<style>
			.reviews_nr {
				display:inline-block;
				font-size:13px;
				line-height: 1.53em;
				padding:1px 6px 0 0;
			}

	
			.woocommerce .star-rating,
			.woocommerce-page .star-rating,
			.star-rating
			{
				font-size:10px;
				margin:5px 0;
				float: none;
				height: 1em;
				line-height: 1em;
				overflow: hidden;
				position: relative;
			}
			
			.woocommerce .star-rating:before,
			.woocommerce-page .star-rating:before,
			.star-rating:before
			{
				font-family: FontAwesome;
				font-style: normal;
				font-weight: normal;
				text-decoration: inherit;
				content: "\f005\f005\f005\f005\f005";
				color: #d3ced2;
				
				float: left;
				left: 0;
				position: absolute;
				top: 0;
			}
			
			.woocommerce .star-rating span,
			.woocommerce-page .star-rating span,
			.star-rating span
			{
				float: left;
				overflow: hidden;
				padding-top: 1.5em;
				position: absolute;
				left: 0;
				top: 0;
			}
			
			.woocommerce .star-rating span:before,
			.woocommerce-page .star-rating span:before,
			.star-rating span:before
			{
				font-family: FontAwesome;
				font-style: normal;
				font-weight: normal;
				text-decoration: inherit;
				content: "\f005\f005\f005\f005\f005";
				
				position: absolute;
				top: 0;
				left: 0;
			}
			
			.woocommerce .product_item .star-rating,
			.woocommerce-page .product_item .star-rating,
			.product_item .star-rating
			{
				font-size: 10px;
				width: 46px;
				margin:3px 0 8px;
				top: 2px;
			}
			
			.woocommerce div.product .woocommerce-product-rating
			{
				text-align: left;
				margin-bottom: 20px;
			}
			
			.woocommerce div.product .woocommerce-review-link
			{
				margin-right: 7px;
			}
			
			.woocommerce .woocommerce-product-rating .star-rating
			{
				display: inline-block;
				float: none;
				font-size: 10px;
				line-height: 12px;
				width: 46px;
				margin: 0px;
				
				position: relative;
				top: 0px;
			}
			
			.woocommerce #reviews .star-rating,
			.woocommerce-page #reviews .star-rating
			{
				font-size: 10px;
				width: 46px;
				float: right;
				top: -1px;
				margin-right:0px;
			}
			
			.woocommerce .comment-form-rating p.stars,
			.woocommerce-page .comment-form-rating p.stars
			{
				font-size: 0.75rem;
				margin-top: 2px !important;
			}
			
			.woocommerce p.stars a.star-1,
			.woocommerce p.stars a.star-2,
			.woocommerce p.stars a.star-3,
			.woocommerce p.stars a.star-4,
			.woocommerce p.stars a.star-5,
			.woocommerce-page p.stars a.star-1,
			.woocommerce-page p.stars a.star-2,
			.woocommerce-page p.stars a.star-3,
			.woocommerce-page p.stars a.star-4,
			.woocommerce-page p.stars a.star-5
			{
				border: none;
				color: #bbb;
			}
			
			.woocommerce p.stars a.star-1:after,
			.woocommerce p.stars a.star-2:after,
			.woocommerce p.stars a.star-3:after,
			.woocommerce p.stars a.star-4:after,
			.woocommerce p.stars a.star-5:after,
			.woocommerce-page p.stars a.star-1:after,
			.woocommerce-page p.stars a.star-2:after,
			.woocommerce-page p.stars a.star-3:after,
			.woocommerce-page p.stars a.star-4:after,
			.woocommerce-page p.stars a.star-5:after
			{
				display: inline-block;
				font-family: FontAwesome;
				font-style: normal;
				font-weight: normal;
				line-height: 1;
				-webkit-font-smoothing: antialiased;
				-moz-osx-font-smoothing: grayscale;
			}
			
			.woocommerce p.stars a.star-1:after,
			.woocommerce-page p.stars a.star-1:after,
			.woocommerce p.stars a.star-1.active:after,
			.woocommerce p.stars a.star-1:hover:after,
			.woocommerce-page p.stars a.star-1.active:after,
			.woocommerce-page p.stars a.star-1:hover:after
			{
				content: "\f005";
			}
			
			.woocommerce p.stars a.star-2:after,
			.woocommerce-page p.stars a.star-2:after,
			.woocommerce p.stars a.star-2.active:after,
			.woocommerce p.stars a.star-2:hover:after,
			.woocommerce-page p.stars a.star-2.active:after,
			.woocommerce-page p.stars a.star-2:hover:after
			{
				content: "\f005\f005";
			}
			
			.woocommerce p.stars a.star-3:after,
			.woocommerce-page p.stars a.star-3:after,
			.woocommerce p.stars a.star-3.active:after,
			.woocommerce p.stars a.star-3:hover:after,
			.woocommerce-page p.stars a.star-3.active:after,
			.woocommerce-page p.stars a.star-3:hover:after
			{
				content: "\f005\f005\f005";
			}
			
			.woocommerce p.stars a.star-4:after,
			.woocommerce-page p.stars a.star-4:after,
			.woocommerce p.stars a.star-4.active:after,
			.woocommerce p.stars a.star-4:hover:after,
			.woocommerce-page p.stars a.star-4.active:after,
			.woocommerce-page p.stars a.star-4:hover:after
			{
				content: "\f005\f005\f005\f005";
			}
			
			.woocommerce p.stars a.star-5:after,
			.woocommerce-page p.stars a.star-5:after,
			.woocommerce p.stars a.star-5.active:after,
			.woocommerce p.stars a.star-5:hover:after,
			.woocommerce-page p.stars a.star-5.active:after,
			.woocommerce-page p.stars a.star-5:hover:after
			{
				content: "\f005\f005\f005\f005\f005";
			}
			
			.slider.style_1 .star-rating span
			{
				color: #fff;
			}
			
		</style>
		
	<?php endif; ?>
	
	
	<?php
	if ((!$theretailer_theme_options['reviews_on_product_page']) || ($theretailer_theme_options['reviews_on_product_page'] == "0")) {
	?>
	<style>
		.woocommerce-tabs .reviews_tab {
			visibility:hidden;
		}
	
		.woocommerce-product-rating,
		.woocommerce .woocommerce-product-rating,
		.woocommerce-tabs #reviews
		{
			display: none;
		}
	</style>
	<?php } ?>
		
	<style>
	
	/***************************************************************/
	/****************************** Body ***************************/
	/***************************************************************/
	
	body {
		<?php if ( $theretailer_theme_options['main_bg_color'] ) { ?>
		background-color:<?php echo $theretailer_theme_options['main_bg_color']; ?>;
		<?php } ?>
		<?php if ( $theretailer_theme_options['main_bg'] ) { ?>
		background-image:url(<?php echo $theretailer_theme_options['main_bg']; ?>);
		background-size:cover;
		background-attachment:fixed;
		<?php } ?>
	}
	
	/***************************************************************/
	/************************** Main font **************************/
	/***************************************************************/
	
	body,#respond #author,#respond #email,#respond #url,#respond #comment,.ctextfield,.cselect,.ctextarea,.ccheckbox_group label,.cradio_group label,.gbtr_light_footer_no_widgets,.gbtr_widget_footer_from_the_blog .gbtr_widget_item_title,.widget input[type=text],.widget input[type=password], .widget input[type=search], .widget select,.gbtr_tools_search_inputtext,.gbtr_second_menu,.gbtr_little_shopping_bag .overview,.gbtr_featured_section_title,h1.entry-title,h1.page-title,h1.entry-title a,h1.page-title a,em.items_found_cart,.product_item p,div.product .product_title,#content div.product .product_title,.gbtr_product_description,div.product form.cart .variations .value select,#content div.product form.cart .variations .value select,div.product div.product_meta,#content div.product div.product_meta,div.product .woocommerce_tabs .panel,#content div.product .woocommerce_tabs .panel,#content div.product div.product_meta,div.product .woocommerce-tabs .panel,#content div.product .woocommerce-tabs .panel,.coupon .input-text,.cart_totals .shipping td,.shipping_calculator h3,.checkout h3,.gbtr_checkout_method_header,.checkout .input-text,.checkout #shiptobilling label,table.shop_table tfoot .shipping td,.gbtr_checkout_login .input-text,table.my_account orders .order-number a,.myaccount_user,.order-info,.myaccount_user span,.order-info span,.gbtr_my_account_wrapper input,.gbtr_my_account_wrapper select,.gbtr_login_register_wrapper h2,.gbtr_login_register_wrapper input,.sf-menu li li a,div.product form.cart .variations .reset_variations,#content div.product form.cart .variations .reset_variations,.shortcode_banner_simple_inside h3,.shortcode_banner_simple_inside h3 strong,.woocommerce_message a.button,.mc_var_label,form .form-row .input-text,
	form .form-row textarea, form .form-row select,#icl_lang_sel_widget a,#megaMenu ul.megaMenu li li li a span, #megaMenu ul.megaMenu li li li span.um-anchoremulator span, .group_table .label a,.wpcf7 input,.wpcf7 textarea,#ship-to-different-address label,#ship-to-different-address .checkbox,
	.wpcf7 select, .cart_list_product_title, .wpb_tabs .ui-widget, .minicart_product, table.my_account_orders td.order-total, .select2-search input
	{
		font-family: '<?php echo $theretailer_theme_options['gb_main_font']; ?>', Arial, Helvetica, sans-serif !important;
	}
	
	/********************************************************************/
	/************************** Secondary font **************************/
	/********************************************************************/
	
	.shortcode_banner_simple_inside h4, .shortcode_banner_simple_height h4, .shortcode_banner_simple_bullet,.shortcode_banner_simple_height_bullet, .main-navigation .mega-menu > ul > li > a,.cbutton,.widget h4.widget-title,.widget input[type=submit],.widget.widget_shopping_cart .total,.widget.widget_shopping_cart .total strong,ul.product_list_widget span.amount,.gbtr_tools_info,.gbtr_tools_account,.gbtr_little_shopping_bag .title,.product_item h3,.product_item .price,a.button,button.button,input.button,#respond input#submit,#content input.button,div.product .product_brand,div.product .summary span.price,div.product .summary p.price,#content div.product .summary span.price,#content div.product .summary p.price,.quantity input.qty,#content .quantity input.qty,div.product form.cart .variations .label,#content div.product form.cart .variations .label,.gbtr_product_share ul li a,div.product .woocommerce_tabs ul.tabs li a,#content div.product .woocommerce_tabs ul.tabs li a,div.product .woocommerce-tabs ul.tabs li a,#content div.product .woocommerce-tabs ul.tabs li a,table.shop_table th,table.shop_table .product-name .category,table.shop_table td.product-subtotal,.coupon .button-coupon,.cart_totals th,.cart_totals td,form .form-row label,table.shop_table td.product-quantity,table.shop_table td.product-name .product_brand,table.shop_table td.product-total,table.shop_table tfoot th,table.shop_table tfoot td,.gbtr_checkout_method_content .title,.gbtr_left_column_my_account ul.menu_my_account,table.my_account_orders td.order-total,.minicart_total_checkout,.addresses .title h3,.sf-menu a,.shortcode_featured_1 a,.shortcode_tabgroup ul.tabs li a,.shortcode_our_services a,span.onsale,.product h3,#respond label,form label,form input[type=submit],.section_title,.entry-content-aside-title,.gbtr_little_shopping_bag_wrapper_mobiles span,.grtr_product_header_mobiles .price,.gbtr_footer_widget_copyrights,.woocommerce_message,.woocommerce_error,.woocommerce_info,.woocommerce-message,.woocommerce-error,.woocommerce-info,p.product,.empty_bag_button,.from_the_blog_date,.gbtr_dark_footer_wrapper .widget_nav_menu ul li,.widget.the_retailer_recent_posts .post_date,.theretailer_product_sort,.light_button,.dark_button,.light_grey_button,.dark_grey_button,.custom_button,.style_1 .products_slider_category,.style_1 .products_slider_price,.page_archive_subtitle,.mc_var_label,.theretailer_style_intro,.wpmega-link-title,#megaMenu h2.widgettitle,.group_table .price,.shopping_bag_centered_style,.customer_details dt,#lang_sel_footer,.out_of_stock_badge_single,.out_of_stock_badge_loop,.portfolio_categories li,#load-more-portfolio-items,.portfolio_details_item_cat,.yith-wcwl-add-button,table.shop_table .amount, .woocommerce table.shop_table .amount,.yith-wcwl-share h4,.wishlist-out-of-stock,.wishlist-in-stock,
	.orderby,em.items_found,.select2-results, .messagebox_text, .vc_progress_bar, .wpb_heading.wpb_pie_chart_heading, .shortcode_icon_box .icon_box_read_more, .vc_btn,  ul.cart_list .empty,.woocommerce ul.cart_list .empty, ul.cart_list .variation dt,  .tagcloud a, td.product-name dl.variation dt, .woocommerce td.product-name dl.variation dt, .trigger-share-list, .box-share-link, .woocommerce table.shop_table_responsive tr td:before, .woocommerce-page table.shop_table_responsive tr td:before, table.my_account_orders td.order-total .amount, .shipping-calculator-button, .gbtr_left_column_cart h3,
	.gbtr_left_column_cart h2, .gbtr_left_column_cart_shipping h3 a ,
	.vc_btn3,
	.woocommerce-cart .woocommerce .cart-collaterals h2,
	li.woocommerce-MyAccount-navigation-link a
	{
		font-family: '<?php echo $theretailer_theme_options['gb_secondary_font']; ?>', Arial, Helvetica, sans-serif !important;
	}
	
	/********************************************************************/
	/*************************** Main Color *****************************/
	/********************************************************************/
	
	a,
	.default-slider-next i,
	.default-slider-prev i,
	li.product h3:hover,
	.product_item h3 a,
	div.product .product_brand,
	div.product div.product_meta a:hover,
	#content div.product div.product_meta a:hover,
	#reviews a,
	div.product .woocommerce_tabs .panel a,
	#content div.product .woocommerce_tabs .panel a,
	div.product .woocommerce-tabs .panel a,
	#content div.product .woocommerce-tabs .panel a,
	.product_navigation .nav-back a,
	table.shop_table td.product-name .product_brand,
	.woocommerce table.shop_table td.product-name .product_brand,
	table.my_account_orders td.order-actions a:hover,
	ul.digital-downloads li a:hover,
	.gbtr_login_register_switch ul li,
	.entry-meta a:hover,
	footer.entry-meta .comments-link a,
	#nav-below .nav-previous-single a:hover,
	#nav-below .nav-next-single a:hover,
	.gbtr_dark_footer_wrapper .widget_nav_menu ul li a:hover,
	.gbtr_dark_footer_wrapper a:hover,
	.shortcode_meet_the_team .role,
	.accordion .accordion-title a:hover,
	.testimonial_left_author h5,
	.testimonial_right_author h5,
	#comments a:hover,
	.portfolio_item a:hover,
	.emm-paginate a:hover span,
	.emm-paginate a:active span,
	.emm-paginate .emm-prev:hover,
	.emm-paginate .emm-next:hover,
	.mc_success_msg,
	.page_archive_items a:hover,
	.gbtr_product_share ul li a,
	div.product form.cart .variations .reset_variations,
	#content div.product form.cart .variations .reset_variations,
	table.my_account_orders .order-number a,
	.gbtr_dark_footer_wrapper .tagcloud a:hover,
	table.shop_table .product-name small a,
	.woocommerce table.shop_table .product-name small a,
	ul.gbtr_digital-downloads li a,
	div.product div.summary a,
	#content div.product div.summary a,
	.cart_list.product_list_widget .minicart_product,
	.shopping_bag_centered_style .minicart_product,
	.woocommerce .woocommerce-breadcrumb a,
	.woocommerce-page .woocommerce-breadcrumb a,
	.product_item:hover .add_to_wishlist:before,
	.product_item .image_container .yith-wcwl-wishlistaddedbrowse a:before,
	.product_item .image_container .yith-wcwl-wishlistexistsbrowse a:hover:before,
	.woocommerce .star-rating span,
	.woocommerce-page .star-rating span,
	.star-rating span,
	.woocommerce-page p.stars a:hover:after,
	.woocommerce-page p.stars .active:after,
	.woocommerce-cart .entry-content .woocommerce .actions input[type=submit],
	.cart-collaterals .woocommerce-shipping-calculator button
	{
		color:<?php echo $theretailer_theme_options['accent_color']; ?>;
	}
	
	.shopping_bag_centered_style:hover,
	.sf-menu li > a:hover,
	.accordion .accordion-title a:hover,
	.gbtr_login_register_switch ul li,
	.woocommerce-checkout .woocommerce-info a,
	.main-navigation .mega-menu > ul > li > a:hover,
	.main-navigation > ul > li:hover > a
	{
		color:<?php echo $theretailer_theme_options['accent_color']; ?> !important;
	}
	
	.woocommerce_message, .woocommerce_error, .woocommerce_info,
	.woocommerce-message, .woocommerce-error, .woocommerce-info,
	form input[type=submit]:hover,
	.widget input[type=submit]:hover,
	.tagcloud a:hover,
	#wp-calendar tbody td a,
	.widget.the_retailer_recent_posts .post_date,
	a.button:hover,button.button:hover,input.button:hover,#respond input#submit:hover,#content input.button:hover,
	.myaccount_user,
	.order-info,
	.shortcode_featured_1 a:hover,
	.from_the_blog_date,
	.style_1 .products_slider_images,
	.portfolio_sep,
	.portfolio_details_sep,
	.gbtr_little_shopping_bag_wrapper_mobiles span,
	#mc_signup_submit:hover,
	.page_archive_date,
	.shopping_bag_mobile_style .gb_cart_contents_count,
	.shopping_bag_centered_style .items_number,
	.audioplayer-bar-played,
	.audioplayer-volume-adjust div div,
	#mobile_menu_overlay li a:hover,
	.addresses a:hover,
	#load-more-portfolio-items a:hover,
	.select2-results .select2-highlighted,
	.shortcode_icon_box .icon_box_read_more:hover,
	#nprogress .bar,
	.box-share-list,
	.woocommerce-cart a.button:hover,
	.main-navigation ul ul li a:hover
	{
		background: <?php echo $theretailer_theme_options['accent_color']; ?>;
	}
	
	.woocommerce_message,
	.woocommerce-message,
	.gbtr_minicart_cart_but:hover,
	.gbtr_minicart_checkout_but:hover,
	span.onsale,
	.woocommerce span.onsale,
	.product_main_infos span.onsale,
	.quantity .minus:hover,
	#content .quantity .minus:hover,
	.quantity .plus:hover,
	#content .quantity .plus:hover,
	.single_add_to_cart_button:hover,
	.shortcode_getbowtied_slider .button:hover,
	.add_review .button:hover,
	#fancybox-close:hover,
	.shipping-calculator-form .button:hover,
	.coupon .button-coupon:hover,
	.gbtr_left_column_cart .update-button:hover,
	.gbtr_left_column_cart .checkout-button:hover,
	.button_create_account_continue:hover,
	.button_billing_address_continue:hover,
	.button_shipping_address_continue:hover,
	.button_order_review_continue:hover,
	#place_order:hover,
	.gbtr_my_account_button input:hover,
	.gbtr_track_order_button:hover,
	.gbtr_login_register_wrapper .button:hover,
	.gbtr_login_register_reg .button:hover,
	.gbtr_login_register_log .button:hover,
	p.product a:hover,
	#respond #submit:hover,
	.widget_shopping_cart .button:hover,
	.sf-menu li li a:hover,
	.lost_reset_password .button:hover,
	.widget_price_filter .price_slider_amount .button:hover,
	.gbtr_order_again_but:hover,
	.gbtr_save_but:hover,
	input.button:hover,#respond input#submit:hover,#content input.button:hover,
	.wishlist_table tr td .add_to_cart:hover,
	.vc_btn.vc_btn_xs:hover,
	.vc_btn.vc_btn_sm:hover,
	.vc_btn.vc_btn_md:hover,
	.vc_btn.vc_btn_lg:hover,
	.order-actions a:hover,
	.widget_price_filter .ui-slider .ui-slider-range,
	.woocommerce .widget_price_filter .ui-slider .ui-slider-range
	{
		background: <?php echo $theretailer_theme_options['accent_color']; ?> !important;
	}
	
	.widget.the_retailer_connect a:hover,
	.gbtr_login_register_switch .button:hover,
	.more-link,
	.gbtr_dark_footer_wrapper .button,
	.light_button:hover,
	.dark_button:hover,
	.light_grey_button:hover,
	.dark_grey_button:hover,
	.gbtr_little_shopping_bag_wrapper_mobiles:hover,
	.menu_select.customSelectHover,
	.gbtr_tools_account.menu-hidden .topbar-menu li a:hover,
	.woocommerce-cart .wc-proceed-to-checkout a.checkout-button
	{
		background-color:<?php echo $theretailer_theme_options['accent_color']; ?>;
	}
	
	.widget_layered_nav ul li.chosen a,
	.widget_layered_nav_filters ul li.chosen a,
	a.button.added::before,
	button.button.added::before,
	input.button.added::before,
	#respond input#submit.added::before,
	#content input.button.added::before,
	.woocommerce a.button.added::before,
	.woocommerce button.button.added::before,
	.woocommerce input.button.added::before,
	.woocommerce #respond input#submit.added::before,
	.woocommerce #content input.button.added::before,
	.custom_button:hover
	{
		background-color:<?php echo $theretailer_theme_options['accent_color']; ?> !important;
	}
	
	.tagcloud a:hover,
	.woocommerce-cart .entry-content .woocommerce .actions input[type=submit],
	.cart-collaterals .woocommerce-shipping-calculator button
	{
		border: 1px solid <?php echo $theretailer_theme_options['accent_color']; ?> !important;
	}
	
	.gbtr_tools_account.menu-hidden .topbar-menu
	{
		border-color: <?php echo $theretailer_theme_options['accent_color']; ?> #cccccc #cccccc;
	}
	
	.tagcloud a:hover,
	.widget_layered_nav ul li.chosen a,
	.widget_layered_nav_filters ul li.chosen a
	{
		border: 1px solid <?php echo $theretailer_theme_options['accent_color']; ?> !important;
	}
	
	.widget.the_retailer_connect a:hover,
	.default-slider-next,
	.default-slider-prev,
	.shortcode_featured_1 a:hover,
	.light_button:hover,
	.dark_button:hover,
	.light_grey_button:hover,
	.dark_grey_button:hover,
	.emm-paginate a:hover span,
	.emm-paginate a:active span,
	.shortcode_icon_box .icon_box_read_more:hover
	{
		border-color:<?php echo $theretailer_theme_options['accent_color']; ?>;
	}
	
	.custom_button:hover,
	.vc_btn.vc_btn_xs:hover,
	.vc_btn.vc_btn_sm:hover,
	.vc_btn.vc_btn_md:hover,
	.vc_btn.vc_btn_lg:hover
	{
		border-color:<?php echo $theretailer_theme_options['accent_color']; ?> !important;
	}
	
	.product_type_simple,
	.product_type_variable,
	.myaccount_user:after,
	.order-info:after
	{
		border-bottom-color:<?php echo $theretailer_theme_options['accent_color']; ?> !important;
	}
	
	.first-navigation ul ul,
	.secondary-navigation ul ul
	{
		border-top-color:<?php echo $theretailer_theme_options['accent_color']; ?>;
	}
	
	#megaMenu ul.megaMenu > li.ss-nav-menu-mega > ul.sub-menu-1, 
	#megaMenu ul.megaMenu li.ss-nav-menu-reg ul.sub-menu ,
	.menu_centered_style .gbtr_minicart 
	{
		border-top-color:<?php echo $theretailer_theme_options['accent_color']; ?> !important;
	}
	
	#nprogress .spinner-icon {
		border-top-color: <?php echo $theretailer_theme_options['accent_color']; ?>;
		border-left-color: <?php echo $theretailer_theme_options['accent_color']; ?>;
	}
	
	
	
	/********************************************************************/
	/************************ Secondary Color ***************************/
	/********************************************************************/
	
	
	.sf-menu a,
	.sf-menu a:visited,
	.sf-menu li li a,
	.widget h4.widget-title,
	h1.entry-title,
	h1.page-title,
	h1.entry-title a,
	h1.page-title a,
	.entry-content h1,
	.entry-content h2,
	.entry-content h3,
	.entry-content h4,
	.entry-content h5,
	.entry-content h6,
	.gbtr_little_shopping_bag .title a,
	.theretailer_product_sort,
	.shipping_calculator h3 a,
	.shortcode_featured_1 a,
	.shortcode_tabgroup ul.tabs li.active a,
	ul.product_list_widget span.amount,
	.woocommerce ul.product_list_widget span.amount
	{
		color:<?php echo $theretailer_theme_options['primary_color']; ?>;
	}
	
	
	
	/********************************************************************/
	/****************************** Wrapper *****************************/
	/********************************************************************/
	
	#global_wrapper {
		margin:0 auto;	
		<?php if ($theretailer_theme_options['gb_layout'] == "boxed") { ?>
			width:100%;
			max-width:<?php echo $theretailer_theme_options['boxed_layout_width']; ?>px !important;
		<?php } else { ?>
			width:100%;
		<?php } ?>	
	}
	
	/********************************************************************/
	/****************************** Top Bar *****************************/
	/********************************************************************/
	
	<?php if (isset($theretailer_theme_options['topbar_bg_color'])) { ?>
	.gbtr_tools_wrapper {
		background:<?php echo $theretailer_theme_options['topbar_bg_color']; ?>;
	}
	<?php } ?>
	
	<?php if (isset($theretailer_theme_options['topbar_color'])) { ?>
	.gbtr_tools_wrapper,
	.gbtr_tools_account ul li a,
	.logout_link,
	.gbtr_tools_search_inputbutton,
	.top-bar-menu-trigger,
	.top-bar-menu-trigger-mobile,
	.gbtr_tools_search_trigger,
	.gbtr_tools_search_trigger_mobile
	{
		color:<?php echo $theretailer_theme_options['topbar_color']; ?>;
	}
	<?php } ?>
	
	<?php if (isset($theretailer_theme_options['top_bar_font_size'])) { ?>
	.gbtr_tools_info,
	.gbtr_tools_account
	{
		font-size:<?php echo $theretailer_theme_options['top_bar_font_size']; ?>px;
	}
	<?php } ?>
	
	/********************************************************************/
	/****************************** Header ******************************/
	/********************************************************************/
	
	.gbtr_header_wrapper {
		<?php if (!isset($theretailer_theme_options['menu_header_top_padding_1_7'])) { ?>
		padding-top:30px;
		<?php } else { ?>
		padding-top:<?php echo $theretailer_theme_options['menu_header_top_padding_1_7']; ?>px;
		<?php } ?>
		
		<?php if (!isset($theretailer_theme_options['menu_header_bottom_padding_1_7'])) { ?>
		padding-bottom:30px;
		<?php } else { ?>
		padding-bottom:<?php echo $theretailer_theme_options['menu_header_bottom_padding_1_7']; ?>px;
		<?php } ?>
		
		background-color:<?php echo $theretailer_theme_options['header_bg_color']; ?>;
	}
	
	.sf-menu a,
	.sf-menu a:visited,
	.shopping_bag_centered_style,
	.main-navigation .mega-menu > ul > li > a,
	.main-navigation .mega-menu > ul > li > a:visited
	{
		color: <?php echo $theretailer_theme_options['primary_menu_color']; ?>;
	}
	
	
	.main-navigation ul ul li a,
	.main-navigation ul ul li a:visited,
	.gbtr_second_menu li a {
		color: <?php echo $theretailer_theme_options['secondary_menu_color']; ?>;
	}
	
	<?php if (isset($theretailer_theme_options['main_navigation_font_size'])) { ?>
	.sf-menu a,
	.main-navigation .mega-menu > ul > li > a,
	.shopping_bag_centered_style
	{
		font-size:<?php echo $theretailer_theme_options['main_navigation_font_size']; ?>px;
	}
	<?php } ?>
	
	<?php if (isset($theretailer_theme_options['secondary_navigation_font_size'])) { ?>
	.gbtr_second_menu {
		font-size:<?php echo $theretailer_theme_options['secondary_navigation_font_size']; ?>px;
	}
	<?php } ?>
	
	/********************************************************************/
	/************************** Light footer ****************************/
	/********************************************************************/
	
	.gbtr_light_footer_wrapper,
	.gbtr_light_footer_no_widgets {
		background-color:<?php echo $theretailer_theme_options['primary_footer_bg_color']; ?>;
	}
	
	/********************************************************************/
	/************************** Dark footer *****************************/
	/********************************************************************/
	
	.gbtr_dark_footer_wrapper,
	.gbtr_dark_footer_wrapper .tagcloud a,
	.gbtr_dark_footer_no_widgets {
		background-color:<?php echo $theretailer_theme_options['secondary_footer_bg_color']; ?>;
	}
	
	.gbtr_dark_footer_wrapper .widget h4.widget-title {
		border-bottom:<?php echo $theretailer_theme_options['secondary_footer_title_border']['width']; ?>px <?php echo $theretailer_theme_options['secondary_footer_title_border']['style']; ?> <?php echo $theretailer_theme_options['secondary_footer_title_border']['color']; ?>;
	}
	
	.gbtr_dark_footer_wrapper,
	.gbtr_dark_footer_wrapper .widget h4.widget-title,
	.gbtr_dark_footer_wrapper a,
	.gbtr_dark_footer_wrapper .widget ul li,
	.gbtr_dark_footer_wrapper .widget ul li a,
	.gbtr_dark_footer_wrapper .textwidget,
	.gbtr_dark_footer_wrapper #mc_subheader,
	.gbtr_dark_footer_wrapper ul.product_list_widget span.amount,
	.gbtr_dark_footer_wrapper .widget_calendar,
	.gbtr_dark_footer_wrapper .mc_var_label,
	.gbtr_dark_footer_wrapper .tagcloud a,
	.trigger-footer-widget-area
	{
		color:<?php echo $theretailer_theme_options['secondary_footer_color']; ?>;
	}
	
	.gbtr_dark_footer_wrapper ul.product_list_widget span.amount
	{
			color:<?php echo $theretailer_theme_options['secondary_footer_color']; ?> !important;
	}
	
	.gbtr_dark_footer_wrapper .widget input[type=text],
	.gbtr_dark_footer_wrapper .widget input[type=password],
	.gbtr_dark_footer_wrapper .tagcloud a
	{
		border: 1px solid <?php echo $theretailer_theme_options['secondary_footer_borders_color']; ?>;
	}
	
	.gbtr_dark_footer_wrapper .widget ul li {
		border-bottom: 1px dotted <?php echo $theretailer_theme_options['secondary_footer_borders_color']; ?> !important;
	}
	
	.gbtr_dark_footer_wrapper .widget.the_retailer_connect a {
		border-color:<?php echo $theretailer_theme_options['secondary_footer_bg_color']; ?>;
	}
	
	/********************************************************************/
	/********************** Mobiles Footer ******************************/
	/********************************************************************/
	
	<?php if ((isset($theretailer_theme_options['expandable_footer_mobiles'])) && ($theretailer_theme_options['expandable_footer_mobiles'] == "0")) : ?>
	.trigger-footer-widget-area {
		display:none;
	}
	.gbtr_widgets_footer_wrapper {
		display:block;
	}
	<?php endif; ?>
	
	/********************************************************************/
	/********************** Copyright footer ****************************/
	/********************************************************************/
	
	.gbtr_footer_wrapper {
		background:<?php echo $theretailer_theme_options['copyright_bar_bg_color']; ?>;
	}
	
	.bottom_wrapper {
		border-top:<?php echo $theretailer_theme_options['copyright_bar_top_border']['width']; ?>px <?php echo $theretailer_theme_options['copyright_bar_top_border']['style']; ?> <?php echo $theretailer_theme_options['copyright_bar_top_border']['color']; ?>;
	}
	
	.gbtr_footer_widget_copyrights {
		color:<?php echo $theretailer_theme_options['copyright_text_color']; ?>;
	}
	
	/********************************************************************/
	/******************* Background sprite normal ***********************/
	/********************************************************************/
	
	blockquote:before,
	.format-status .entry-content:before,
	.woocommerce_message::before,
	.woocommerce_error::before,
	.woocommerce_info::before,
	.woocommerce-message::before,
	.woocommerce-error::before,
	.woocommerce-info::before,
	.widget #searchform input[type=submit],
	.widget .woocommerce-product-search input[type=submit],
	.gbtr_little_shopping_bag .title,
	ul.cart_list .empty:before,
	.gbtr_product_sliders_header .big_arrow_right,
	.gbtr_items_sliders_header .big_arrow_right,
	.gbtr_product_sliders_header .big_arrow_right:hover,
	.gbtr_items_sliders_header .big_arrow_right:hover,
	.gbtr_product_sliders_header .big_arrow_left,
	.gbtr_items_sliders_header .big_arrow_left,
	.gbtr_product_sliders_header .big_arrow_left:hover,
	.gbtr_items_sliders_header .big_arrow_left:hover,
	.product_button a.button,
	.product_button button.button,
	.product_button input.button,
	.product_button #respond input#submit,
	.product_button #content input.button,
	.product_button a.button:hover,
	.product_button button.button:hover,
	.product_button input.button:hover,
	.product_button #respond input#submit:hover,
	.product_button #content input.button:hover,
	.product_type_simple,
	.product_type_variable,
	a.button.added::before,
	button.button.added::before,
	input.button.added::before,
	#respond input#submit.added::before,
	#content input.button.added::before,
	.gbtr_product_share ul li a.product_share_facebook:before,
	.gbtr_product_share ul li a.product_share_pinterest:before,
	.gbtr_product_share ul li a.product_share_email:before,
	.gbtr_product_share ul li a.product_share_twitter:before,
	.product_single_slider_previous,
	.product_single_slider_next,
	.product_navigation .nav-previous-single a,
	.product_navigation .nav-previous-single a:hover,
	.product_navigation .nav-next-single a,
	.product_navigation .nav-next-single a:hover,
	.gbtr_left_column_cart_sep,
	.empty_bag_icon,
	.checkout h3:after,
	.gbtr_checkout_method_header:after,
	#nav-below .nav-previous-single a .meta-nav,
	#nav-below .nav-previous-single a:hover .meta-nav,
	#nav-below .nav-next-single a .meta-nav,
	#nav-below .nav-next-single a:hover .meta-nav,
	.accordion .accordion-title:before,
	.accordion .accordion-title.active:before,
	.testimonial_left_content div:before,
	.testimonial_right_content div:before,
	.slide_everything .slide_everything_previous,
	.slide_everything .slide_everything_next,
	.products_slider_previous,
	.products_slider_next,
	.gbtr_little_shopping_bag_wrapper_mobiles,
	.menu_select,
	.theretailer_product_sort,
	.img_404,
	.widget ul li.recentcomments:before,
	#icl_lang_sel_widget a.lang_sel_sel,
	.cart-collaterals .wc-proceed-to-checkout:before
	{
		<?php if ( $theretailer_theme_options['icons_sprite_normal'] ) { ?>
		background-image:url(<?php echo $theretailer_theme_options['icons_sprite_normal']; ?>) !important;
		<?php } else { ?>
		background-image:url(<?php echo get_template_directory_uri(); ?>/images/sprites.png) !important;
		<?php } ?>
	}
	
	<?php if ( (!$theretailer_theme_options['flip_product']) || ($theretailer_theme_options['flip_product'] == 0) ) { ?>
	
	/********************************************************************/
	/************************* Flip products ****************************/
	/********************************************************************/
	
	<?php if ( ($theretailer_theme_options['flip_product_mobiles']) && ($theretailer_theme_options['flip_product_mobiles'] == 1) ) { ?>
	@media only screen and (min-width: 719px) {
	<?php } ?>

	/* Deprecated

	.image_container a {
		float: left;
		-webkit-perspective: 600px;
		-moz-perspective: 600px;
	}
	
	.image_container a .front {
		-webkit-transform: rotateX(0deg) rotateY(0deg);
		-webkit-backface-visibility: hidden;
	
		-moz-transform: rotateX(0deg) rotateY(0deg);
		-moz-backface-visibility: hidden;
	
		-o-transition: all .4s ease-in-out;
		-ms-transition: all .4s ease-in-out;
		-moz-transition: all .4s ease-in-out;
		-webkit-transition: all .4s ease-in-out;
		transition: all .4s ease-in-out;
	}
	
	.image_container a:hover .front {
		-webkit-transform: rotateY(180deg);
		-moz-transform: rotateY(180deg);
	}
	
	.image_container a .back {
		-webkit-transform: rotateY(-180deg);
		-webkit-transform-style: preserve-3d;
		-webkit-backface-visibility: hidden;
	
		-moz-transform: rotateY(-180deg);
		-moz-transform-style: preserve-3d;
		-moz-backface-visibility: hidden;
	
		-o-transition: all .4s ease-in-out;
		-ms-transition: all .4s ease-in-out;
		-moz-transition: all .4s ease-in-out;
		-webkit-transition: all .4s ease-in-out;
		transition: all .4s ease-in-out;
	}
	
	.image_container a:hover .back {
		-webkit-transform: rotateX(0deg) rotateY(0deg);
		-moz-transform: rotateX(0deg) rotateY(0deg);
		z-index:10;
		position:absolute;
	}

	*/

	.image_container a {
		float: left;
		/*-webkit-transform: translate3d(0, 0, 0);
		transform-style: preserve-3d;*/
		perspective: 600px;
		-webkit-perspective: 600px;
		/*-webkit-transform-style: preserve-3d;
		-webkit-transition: 0.1s;*/

	}

	.image_container a .front,
	.image_container a .back
	{
		backface-visibility: hidden;
		-webkit-backface-visibility: hidden;
		transition: 0.6s;
		-webkit-transition: 0.6s;
		transform-style: preserve-3d;
		-webkit-transform-style: preserve-3d;
	}

	.image_container a .front {
		z-index: 2;
		transform: rotateY(0deg);
		-webkit-transform: rotateY(0deg);
	}

	.image_container a .back {
		transform: rotateY(-180deg);
		-webkit-transform: rotateY(-180deg);
	}

	.image_container a:hover .back {
		transform: rotateY(0deg);
		-webkit-transform: rotateY(0deg);
	}
	
	.image_container a:hover .front {
	    transform: rotateY(180deg);
	    -webkit-transform: rotateY(180deg);
	}
	
	<?php if ( ($theretailer_theme_options['flip_product_mobiles']) && ($theretailer_theme_options['flip_product_mobiles'] == 1) ) { ?>
	}
	<?php } ?>
	
	<?php } ?>
	
	<?php if ( ($theretailer_theme_options['revolution_slider_in_mobile_phones']) && ($theretailer_theme_options['revolution_slider_in_mobile_phones'] == 1) ) { ?>
	/********************************************************************/
	/********** Remove Revolution on mobile phones **********************/
	/********************************************************************/
	
	@media only screen and (max-width: 479px) {
		
		.rev_slider_wrapper {
			display:none !important;
		}
		
	}
	<?php } ?>
	
	
	/********************************************************************/
	/************************ Retina Stuff ******************************/
	/********************************************************************/
	
	@media only screen and (-webkit-min-device-pixel-ratio: 2), 
	only screen and (min-device-pixel-ratio: 2)
	{
		blockquote:before,
		.woocommerce_message::before,
		.woocommerce_error::before,
		.woocommerce_info::before,
		.woocommerce-message::before,
		.woocommerce-error::before,
		.woocommerce-info::before,
		.widget #searchform input[type=submit],
		.gbtr_little_shopping_bag .title,
		/*ul.cart_list .remove,
		ul.cart_list .empty:before,*/
		.gbtr_product_sliders_header .big_arrow_right,
		.gbtr_items_sliders_header .big_arrow_right,
		.gbtr_product_sliders_header .big_arrow_right:hover,
		.gbtr_items_sliders_header .big_arrow_right:hover,
		.gbtr_product_sliders_header .big_arrow_left,
		.gbtr_items_sliders_header .big_arrow_left,
		.gbtr_product_sliders_header .big_arrow_left:hover,
		.gbtr_items_sliders_header .big_arrow_left:hover,
		.product_button a.button,
		.product_button button.button,
		.product_button input.button,
		.product_button #respond input#submit,
		.product_button #content input.button,
		.product_button a.button:hover,
		.product_button button.button:hover,
		.product_button input.button:hover,
		.product_button #respond input#submit:hover,
		.product_button #content input.button:hover,
		.product_type_simple,
		.product_type_variable,
		a.button.added::before,
		button.button.added::before,
		input.button.added::before,
		#respond input#submit.added::before,
		#content input.button.added::before,
		.gbtr_product_share ul li a.product_share_facebook:before,
		.gbtr_product_share ul li a.product_share_pinterest:before,
		.gbtr_product_share ul li a.product_share_email:before,
		.gbtr_product_share ul li a.product_share_twitter:before,
		.product_single_slider_previous,
		.product_single_slider_next,
		.product_navigation .nav-previous-single a,
		.product_navigation .nav-previous-single a:hover,
		.product_navigation .nav-next-single a,
		.product_navigation .nav-next-single a:hover,
		/*table.shop_table a.remove,
		table.shop_table a.remove:hover,*/
		.gbtr_left_column_cart_sep,
		.empty_bag_icon,
		.checkout h3:after,
		.gbtr_checkout_method_header:after,
		#nav-below .nav-previous-single a .meta-nav,
		#nav-below .nav-previous-single a:hover .meta-nav,
		#nav-below .nav-next-single a .meta-nav,
		#nav-below .nav-next-single a:hover .meta-nav,
		.accordion .accordion-title:before,
		.accordion .accordion-title.active:before,
		.testimonial_left_content div:before,
		.testimonial_right_content div:before,
		.slide_everything .slide_everything_previous,
		.slide_everything .slide_everything_next,
		.products_slider_previous,
		.products_slider_next,
		.gbtr_little_shopping_bag_wrapper_mobiles,
		.menu_select,
		.theretailer_product_sort,
		.img_404,
		.widget ul li.recentcomments:before,
		#icl_lang_sel_widget a.lang_sel_sel,
		.trigger-footer-widget-icon
		{
			<?php if ( $theretailer_theme_options['icons_sprite_retina'] ) { ?>
			background-image:url(<?php echo $theretailer_theme_options['icons_sprite_retina']; ?>) !important;
			<?php } else { ?>
			background-image:url(<?php echo get_template_directory_uri(); ?>/images/sprites@2x.png) !important;
			<?php } ?>
			background-size:1000px 1000px !important;
		}
	}
	
	/********************************************************************/
	/************************* Custom CSS *******************************/
	/********************************************************************/
	
	<?php if ( (isset($theretailer_theme_options['custom_css'])) && ($theretailer_theme_options['custom_css'] != "") ) : ?>
		<?php echo $theretailer_theme_options['custom_css']; ?>
	<?php endif; ?>
	
	<?php
	if ((!isset($theretailer_theme_options['breadcrumbs'])) || ($theretailer_theme_options['breadcrumbs'] == "0")) {
	?>
	.woocommerce-breadcrumb {
		display:none;
	}
	<?php } ?>
	
	</style>
	
	<?php 
	}
	
} //if
add_action( 'wp_head', 'theretailer_custom_styles', 100 );
?>