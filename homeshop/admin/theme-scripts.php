<?php


/*-----------------------------------------------------------------------------------*/
/*Add scripts and styles to backend
/*-----------------------------------------------------------------------------------*/

function homeshop_options_scripts($hook) {
	$template_url = get_template_directory_uri();

	wp_register_script( 'loft-upload', $template_url . '/admin/js/upload_media.js', array( 'jquery', 'media-upload', 'thickbox' ), '', true );

 
  
	wp_enqueue_script( 'jquery-ui-dialog' );
	wp_enqueue_style( 'wp-jquery-ui-dialog' );
	
	wp_enqueue_style( 'wp-color-picker');
    wp_enqueue_script( 'wp-color-picker');
	
	if ($hook == 'appearance_page_siteoptions' ) {
		wp_enqueue_script( 'thickbox', '', array( 'jquery' ), '', true );
		wp_enqueue_style( 'thickbox' );
		wp_enqueue_script( 'media-upload', '', array( 'jquery' ), '', true );
		wp_enqueue_script( 'loft-upload', '', array( 'jquery' ), '', true );
		wp_localize_script( 'loft-upload', 'loft', array( 'template_url'=> $template_url));
		wp_enqueue_script( 'admin-js', $template_url . '/admin/js/admin.js', array( 'jquery',  'jquery-ui-dialog' ), '', 'true');
		wp_enqueue_script( 'jquery_cookie', $template_url . '/js/jquery.cookie.js', array( 'jquery' ), '1.0', true );
	
	wp_enqueue_style( 'admin', $template_url . '/admin/css/admin_options.css' );
    
    wp_enqueue_style( 'modal', $template_url . '/admin/css/jquery-ui.css' );
	
	
	wp_enqueue_script( 'blogscripts-js', $template_url . '/admin/js/blog_scripts.js', array( 'jquery' ), '', true);
	}
	
	wp_enqueue_style( 'admin-custom', $template_url . '/admin/admin_style.css' );
	
	
	if ($hook == 'edit-tags.php') {
		wp_enqueue_script( 'jquery-ui-widget', '', array( 'jquery' ), '', true );
		}

    wp_enqueue_script( 'jquery-ui-core', '', array( 'jquery' ), '', true);
    wp_enqueue_script( 'jquery-ui-sortable', '', array( 'jquery' ), '', true );
	wp_enqueue_script( 'modernizr', $template_url . '/admin/js/modernizr.custom.js', array( 'jquery', '', true ));
	
	if ($hook == 'post.php' ) {
	wp_enqueue_script( 'blogscripts-js', $template_url . '/admin/js/blog_scripts.js', array( 'jquery' ), '', true);
	wp_register_script('cf_builder', get_template_directory_uri() . '/admin/js/contactform_builder.js' , array('jquery'), null, true);
	wp_enqueue_script('cf_builder');
	}
	

}

add_action( 'admin_enqueue_scripts', 'homeshop_options_scripts' );

if ( !function_exists( 'is_login_page' ) ) {

	function is_login_page() {
		return in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) );
	}
}











//load fonts
function homeShop_fonts() {
    $protocol = is_ssl() ? 'https' : 'http';

   wp_enqueue_style( 'Roboto', $protocol . '://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,700,900,700italic,500italic' );

  
   
	if(get_option('sense_logo_font_family') != '' && get_option('sense_menu_font') != 'Roboto') {
			wp_enqueue_style( 'mytheme-loftfonts', "$protocol://fonts.googleapis.com/css?family=".get_option('sense_logo_font_family')."" );
		}
		
	if(get_option('sense_menu_font') != '' && get_option('sense_menu_font') != 'Roboto') {
			wp_enqueue_style( 'mytheme-loftmenu', "$protocol://fonts.googleapis.com/css?family=".get_option('sense_menu_font')."" );
		}	
	if(get_option('sense_page_title_font') != '' && get_option('sense_menu_font') != 'Roboto') {
			wp_enqueue_style( 'mytheme-loftmenutitle', "$protocol://fonts.googleapis.com/css?family=".get_option('sense_page_title_font')."" );
		}	
	if(get_option('sense_h1_font') != '' && get_option('sense_menu_font') != 'Roboto') {
			wp_enqueue_style( 'mytheme-h1', "$protocol://fonts.googleapis.com/css?family=".get_option('sense_h1_font')."" );
		}	
	if(get_option('sense_h2_font') != '' && get_option('sense_menu_font') != 'Roboto') {
			wp_enqueue_style( 'mytheme-h2', "$protocol://fonts.googleapis.com/css?family=".get_option('sense_h2_font')."" );
		}	
	if(get_option('sense_h3_font') != '' && get_option('sense_menu_font') != 'Roboto') {
			wp_enqueue_style( 'mytheme-h3', "$protocol://fonts.googleapis.com/css?family=".get_option('sense_h3_font')."" );
		}	
	if(get_option('sense_h4_font') != '' && get_option('sense_menu_font') != 'Roboto') {
			wp_enqueue_style( 'mytheme-h4', "$protocol://fonts.googleapis.com/css?family=".get_option('sense_h4_font')."" );
		}	
	if(get_option('sense_h5_font') != '' && get_option('sense_menu_font') != 'Roboto') {
			wp_enqueue_style( 'mytheme-h5', "$protocol://fonts.googleapis.com/css?family=".get_option('sense_h5_font')."" );
		}	
	if(get_option('sense_h6_font') != '' && get_option('sense_menu_font') != 'Roboto') {
			wp_enqueue_style( 'mytheme-h6', "$protocol://fonts.googleapis.com/css?family=".get_option('sense_h6_font')."" );
		}		
}
add_action( 'wp_enqueue_scripts', 'homeShop_fonts' );


//ENQUEUE JQUERY & CUSTOM SCRIPTS
function homeShop_load_scripts() {
	if(get_option('sense_site_icon') != ''):
		printf("<link rel='shortcut icon' href='%s'/>\r\n", trim(get_option('sense_site_icon')));
		printf("<link rel='icon' href='%s'/>\r\n", trim(get_option('sense_site_icon')));
	else:
		$favicon = '<link rel="shortcut icon" href="'.get_template_directory_uri().'/fav.ico"/>
		<link rel="icon" href="'.get_template_directory_uri().'/fav.ico"/>';
		echo $favicon;
	endif;

	if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );


	if( function_exists( 'icl_t' ) ) {
	$menu_text = icl_t('Homeshop', 'menu_text_item', 'Menu');
	} else {
	$menu_text = __('Menu', 'homeshop');
	}
	
	if( function_exists( 'icl_t' ) ) {
	$navigation_text_item = icl_t('Homeshop', 'navigation_text_item', 'Navigation');
	} else {
	$navigation_text_item = __('Navigation', 'homeshop');
	}
	
	if( function_exists( 'icl_t' ) ) {
	$no_wcwl_list = icl_t('Homeshop', 'no_wcwl_list', 'You need to be logged in to add product to wishlist.');
	} else {
	$no_wcwl_list = __('You need to be logged in to add product to wishlist.', 'homeshop');
	}
	
	
	
	wp_localize_script('jquery', 'global', array(
				'paththeme' => get_template_directory_uri(),
				'no_wcwl_list' => $no_wcwl_list,
				'header_search' => get_option('sense_show_header_search')
			));
	
	$is_rtl = 'ltr';
	if (is_rtl()) {
		$is_rtl = 'rtl';
	}
	
	if ( !is_admin() && !is_login_page() ) {
		?> <script type="text/javascript"> 

			 window.map_address1 = '<?php echo get_option('sense_contact_urlmaps1'); ?>';
			 window.map_address2 = '<?php echo get_option('sense_contact_urlmaps2'); ?>';
			 window.paththeme = '<?php echo get_template_directory_uri(); ?>';
			 window.site_name = '<?php bloginfo('name'); ?>';
			 window.owner_email = '<?php echo get_option('admin_email'); ?>';
			 window.owner_email_sub = '<?php echo get_option('sense_mail_subscribe'); ?>';	
			 window.menu_text = '<?php echo $menu_text; ?>';
			 window.navigation_text = '<?php echo $navigation_text_item; ?>';
			 window.header_search = '<?php echo get_option('sense_show_header_search'); ?>';
			 window.added_text = '<?php echo get_option('sense_added_text_newsletter'); ?>';
			 window.added_text2 = '<?php echo get_option('sense_added_text_newsletter2'); ?>';
			 
			 window.is_rtl = '<?php echo $is_rtl; ?>';
			 
			 
		</script> <?php
		wp_enqueue_style( 'style', get_stylesheet_uri() );
		wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css');
		wp_enqueue_style( 'perfect-scrollbar-css', get_template_directory_uri() . '/css/perfect-scrollbar.css');
		wp_enqueue_style( 'flexslider-css', get_template_directory_uri() . '/css/flexslider.css');
		wp_enqueue_style( 'fontello-css', get_template_directory_uri() . '/css/fontello.css');
		wp_enqueue_style( 'settings-css', get_template_directory_uri() . '/css/settings.css');
		wp_enqueue_style( 'animation-css', get_template_directory_uri() . '/css/animation.css');
		wp_enqueue_style( 'owl-carousel-css', get_template_directory_uri() . '/css/owl.carousel.css');
		wp_enqueue_style( 'owl-theme-css', get_template_directory_uri() . '/css/owl.theme.css');
		wp_enqueue_style( 'chosen-css', get_template_directory_uri() . '/css/chosen.css');
		wp_enqueue_style( 'nouislider-css', get_template_directory_uri() . '/css/jquery.nouislider.min.css');
		
		wp_enqueue_style( 'video-js-css', get_template_directory_uri() . '/video-js/video-js.css');

		wp_enqueue_style( 'style1-css', get_template_directory_uri() . '/css/style1.css');
		

       //load theme custom style css
	   homeShop_css_loader();
	   
		wp_enqueue_script('jquery');
		
		wp_enqueue_script('jquery-form');
		
		wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.min.js', false, '', true );
	
		wp_enqueue_script( 'jquery_ui', get_template_directory_uri() . '/js/jquery-ui.min.js', array('jquery'), '1.9.2', true );
	
	
	$ajaxurl = admin_url('admin-ajax.php');
	$ajax_nonce = wp_create_nonce('MailChimp');
	wp_localize_script( 'jquery', 'ajaxVars', array( 'ajaxurl' => $ajaxurl, 'ajax_nonce' => $ajax_nonce )); 
	
	
	
	
	wp_enqueue_script( 'jquery_raty', get_template_directory_uri() . '/js/jquery.raty.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'perfect-scrollbar', get_template_directory_uri() . '/js/perfect-scrollbar.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'zoomsl-3.0', get_template_directory_uri() . '/js/zoomsl-3.0.min.js', array('jquery'), '', true);
	//wp_enqueue_script( 'fancybox_pack', get_template_directory_uri() . '/js/jquery.fancybox.pack.js', array('jquery'), '', true);
	
	wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/flexslider.min.js', array('jquery'), '', true);
	wp_enqueue_script( 'iosslider', get_template_directory_uri() . '/js/jquery.iosslider.min.js', array('jquery'), '', true);
	wp_enqueue_script( 'nouislider', get_template_directory_uri() . '/js/jquery.nouislider.min.js', array('jquery'), '', true);
	
	wp_enqueue_script( 'owl_carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), '', true);
	
	wp_enqueue_script( 'zoomsl-3.0', get_template_directory_uri() . '/js/zoomsl-3.0.min.js', array('jquery'), '', true);
	
	wp_enqueue_script( 'chosen', get_template_directory_uri() . '/js/chosen.jquery.min.js', array('jquery'), '', true);
	wp_enqueue_script( 'tinynav', get_template_directory_uri() . '/js/tinynav.min.js', array('jquery'), '', true);
	
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '', true);
	
	wp_enqueue_script( 'masonry-3.2.1', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array('jquery'), '', true);

	
	wp_enqueue_script( 'main-script', get_template_directory_uri() . '/js/main-script.js', array('jquery'), '', true);
	
	
	wp_enqueue_script( 'mobile-megamenu', get_template_directory_uri() . '/js/mobile-megamenu.js', array('jquery'), '', true);
	
	
	wp_enqueue_script( 'video_js', get_template_directory_uri() . '/video-js/video.js', array('jquery'), '', true);
	
	}
}
add_action('wp_enqueue_scripts', 'homeShop_load_scripts', 1);




//option css load/////////////////////////////////////////////////////////////////////////////////////////	
function homeShop_css_loader() {
	
	echo '<style type="text/css">' . PHP_EOL;

	if(get_option('sense_short_des') && get_option('sense_short_des') == 'hide') {
	echo ".product-info .description{ display: none !important; }";
	}
	
	if(get_option('sense_show_breadcrumbs') && get_option('sense_show_breadcrumbs') == 'hide') {
	echo ".breadcrumbs{ display: none !important; }";
	}
	
	
	echo "#middle-navigation .login-create>.icons, #middle-navigation .login-create>p>a:hover
		{ color: " . get_option('sense_login_create_color') . " !important; }";
	
	echo "#middle-navigation .login-create .box-dropdown .box-wrapper
		{border-color: " . get_option('sense_login_create_color') . " !important; }";
	
	echo "#middle-navigation .login-create.purple .box-dropdown:after
		{border-bottom: 10px solid " . get_option('sense_login_create_color') . " !important; }";
	
	echo "#middle-navigation .login-create, #middle-navigation .login-create h4,
	#middle-navigation .login-create label { color: " . get_option('sense_text_login_create_color') . " !important; }";
	
	echo "#middle-navigation .login-create a { color: " . get_option('sense_link_login_create_color') . " !important; }";
	
	echo "#middle-navigation .login-create .footer a.button { background: " . get_option('sense_button_login_create_color') . " !important; }";
	
	echo "#middle-navigation .login-create .footer a.button:hover { background: " . get_option('sense_button_login_create_hover_color') . " !important; }";
	
	echo ".carousel-arrows .icons:hover, .flex-direction-nav a:hover { background: " . get_option('sense_bg_main_block_title_arrhover_color') . " !important; }";
	
	echo ".tags a, body .woo_compare_button_go, body .woo_compare_widget_button_go { background: " . get_option('sense_button_category_shop_color') . " !important; }";
	echo ".tags a:hover, body .woo_compare_widget_button_go:hover { background: " . get_option('sense_button_category_shop_hover_color') . " !important; }";
	
	echo "li.grey>a, input.grey, .button.grey, #main-navigation li.grey li, span.product-action.grey { background: " . get_option('sense_button_gray_shop_color') . " !important;
	color: " . get_option('sense_button_gray_text_shop_color') . " !important;}";
	
	echo "li.grey>a:hover, 
	#main-navigation .grey ul.wide-dropdown ul a:hover, 
	input.grey:hover , 
	.button.grey:hover, 
	li.grey.current-item>a, 
	li.grey.current-item, 
	.icons.grey:hover, 
	span.product-action.grey:hover { background: " . get_option('sense_button_gray_hover_shop_color') . " !important;
	color: " . get_option('sense_button_gray_text_hover_shop_color') . " !important;	}";
	
	
	echo "table.compare-table p.compare-tags a { background: " . get_option('sense_button_category_campare_color') . " !important; }";
	echo "table.compare-table p.compare-tags  a:hover { background: " . get_option('sense_button_category_campare_hover_color') . " !important; }";
	
	
	echo "li.orange.top_cart .parent-background { background: " . get_option('sense_button_checkout_top_color') . " !important; }";
	echo "li.orange.top_cart .parent-background:hover { background: " . get_option('sense_button_checkout_top_hover_color') . " !important; }";
	
	echo "li.orange.top_cart .box-dropdown a.button { background: " . get_option('sense_button_view_top_color') . " ; }";
	echo "li.orange.top_cart .box-dropdown a.button:hover { background: " . get_option('sense_button_view_top_hover_color') . " ; }";
	
	echo "li.orange.top_cart .parent-color { color: " . get_option('sense_button_remove_top_color') . " !important; }";
	
	echo "li.orange.top_cart .parent-border { border-color: " . get_option('sense_button_remove_top_color') . " !important; }";
	
	echo "li.orange.top_cart .parent-arrow:after { border-bottom-color: " . get_option('sense_button_remove_top_color') . " !important; }";
	
	echo "#main-footer ul li a:hover { color: " . get_option('sense_footer_link_hover_color') . " !important; }";
	
	echo ".blog-actions-big span.product-action.red { background: " . get_option('sense_page_print_color') . " !important; }";
	echo ".blog-actions-big span.product-action.red:hover { background: " . get_option('sense_page_print_hover_color') . " !important; }";
	
	echo ".blog-actions-big span.product-action.home-green { background: " . get_option('sense_page_send_color') . " !important; }";
	echo ".blog-actions-big span.product-action.home-green:hover { background: " . get_option('sense_page_send_hover_color') . " !important; }";
	
	echo ".blog-actions span.product-action.dark-blue, .blog-actions span.product-action.blog_more { background: " . get_option('sense_page_more_color') . " !important; }";
	echo ".blog-actions span.product-action.dark-blue:hover, .blog-actions span.product-action.blog_more:hover { background: " . get_option('sense_page_more_hover_color') . " !important; }";
	
	
	echo "#comment-form input.dark-blue, #review_form #commentform input[type='submit'] { background: " . get_option('sense_page_submit_color') . " !important; }";
	echo "#comment-form input.dark-blue:hover, #review_form #commentform input[type='submit']:hover { background: " . get_option('sense_page_submit_hover_color') . " !important; }";
	
	echo ".tabs  .tab-heading a.button, .main-content table th, .category-heading,
    .accordion-header	{ background: " . get_option('sense_bg_block_title_tabs_color') . "  !important; }";
	echo ".tabs  .tab-heading a:hover, .tabs  .tab-heading a.button.active,
		.accordion-active .accordion-header, .accordion-header:hover{ background: " . get_option('sense_bg_block_title_tabs_active_color') . "  !important; }";
	
	
	echo ".coupon-table input.green, .actions input.green, .place-order input[type='submit'], .shipping-calculator-form input.green { background: " . get_option('sense_shop_coupon_color') . " !important; }";
	echo ".coupon-table input.green:hover, .actions input.green:hover, .place-order input[type='submit']:hover, .shipping-calculator-form input.green:hover { background: " . get_option('sense_shop_coupon_hover_color') . " !important; }";
	
	
	echo "td.wishlist-info .product-category a{ color: " . get_option('sense_category_wishlist_color') . " !important; }";
	
	echo ".contact-form input[type='submit']{ background: " . get_option('sense_send_submit_color') . " !important; }";
	echo ".contact-form input[type='submit']:hover{ background: " . get_option('sense_send_submit_hover_color') . " !important; }";
	
	
	
	
	echo "#logo h1 a.logo  {  font-size: " . get_option('sense_logo_size_loft') . "px !important; color: " . get_option('sense_logo_color') . " !important; font-family: " . get_option('sense_logo_font_family') . " !important;}";
	
	echo ".content a  { color: " . get_option('sense_basic_link_color') . " ; }";
	echo ".content a:hover, .content a:focus, header #top-header li a:hover { color: " . get_option('sense_basic_link_hover_color') . " ; }";
	
	echo ".carousel-heading, .sidebar-box-heading, .flex-direction-nav a, .vc_tta-style-flat .vc_tta-tab.vc_active > a, .vc_tta-style-flat .vc_tta-tab > a:hover, .vc_tta-style-flat .vc_tta-tab > a:focus
	{ background: " . get_option('sense_bg_main_block_title_color') . "  !important; }";
	
	echo ".category-buttons a#grid, .category-buttons a#list 
	{ color: " . get_option('sense_icon_grid_color') . "  !important; }";
	echo ".category-buttons .icons:hover,
.category-buttons .active .icons,
 .category-buttons .icons.active-button 
	{ background: " . get_option('sense_shop_grid_hover_color') . "  !important; }";
	
	
	
	echo "span.price, ul.fl-countdown li span { color: " . get_option('sense_price_color') . " !important; }";
	
	echo "span.add-to-cart, .product-actions .added_to_cart { background: " . get_option('sense_add_cart_color') . " !important; }";
	echo "span.add-to-cart:hover, .product-actions .added_to_cart:hover { background: " . get_option('sense_add_cart_hover_color') . " !important; }";
	
	echo "span.add-to-favorites { background: " . get_option('sense_wishlist_color') . " !important; }";
	echo "span.add-to-favorites:hover { background: " . get_option('sense_wishlist_hover_color') . " !important; }";
	
	echo "span.add-to-compare { background: " . get_option('sense_compare_color') . " !important; }";
	echo "span.add-to-compare:hover { background: " . get_option('sense_compare_hover_color') . " !important; }";
	
	$color_view = get_option('sense_quick_view_color');
	$color_view_hover = get_option('sense_quick_view_hover_color');
	echo "a.product-hover { background: " . hex2rgb($color_view, 0.7) . " !important; }";
	echo "a.product-hover:hover { background: " . hex2rgb($color_view_hover, 1) . " !important; }";
	
	echo "span.product-action.blog_add_comment, .blog-actions span.product-action.blue  { background: " . get_option('sense_add_comment_color') . " !important; }";
	echo "span.product-action.blog_add_comment:hover,
		.blog-actions span.product-action.blue:hover { background: " . get_option('sense_add_comment_hover_color') . " !important; }";
	
	echo "#login-dropdown #wp-submit, input[name='login']  { background: " . get_option('sense_login_color') . " !important; }";
	echo "#login-dropdown #wp-submit:hover, input[name='login']:hover { background: " . get_option('sense_login_hover_color') . " !important; }";
	
	echo "input[name='register']  { background: " . get_option('sense_register_color') . " !important; }";
	echo "input[name='register']:hover { background: " . get_option('sense_register_hover_color') . " !important; }";
	
	echo "table span.add-to-trash  { background: " . get_option('sense_remove_color') . " !important; }";
	echo "table span.add-to-trash:hover { background: " . get_option('sense_remove_hover_color') . " !important; }";
	
	echo "#back-to-top  { background: " . get_option('sense_back_top_color') . " !important; }";
	echo "#back-to-top:hover { background: " . get_option('sense_back_top_hover_color') . " !important; }";
	
	echo "#back-to-top   { color: " . get_option('sense_back_top_icon_color') . " !important; }";
	echo "#back-to-top:hover  { color: " . get_option('sense_back_top_icon_hover_color') . " !important; }";
	
	echo "#newsletter input[type='submit']   { background: " . get_option('sense_submit_newsletter_color') . " !important; }";
	echo "#newsletter input[type='submit']:hover  { background: " . get_option('sense_submit_newsletter_hover_color') . " !important; }";
	
	echo ".onsale,.fl-rulecnt .fl-rulcnt-overlay .fl-rulcnt-discount { background: " . get_option('sense_labels_color') . " !important; }";
	echo ".onsale.labels_stock { background: " . get_option('sense_labels_color_stock') . " !important; }";
	echo ".onsale.onfeatured { background: " . get_option('sense_labels_color_hot') . " !important; }";
	
	
	
	
	
	
	
	
	
	
	echo ".sidebar-dropdown  { background: " . get_option('sense_button_sidebar_dropdown_color') . " !important; }";
	
	echo ".sidebar-dropdown>li>ul>li>a:hover  { background: " . get_option('sense_button_sidebar_dropdown_hover_color') . " !important; }";
	
	
	$is_body_font_family = get_option('sense_basic_font');
	$is_body_font_color = get_option('basic_font_color');
	$is_body_font_style = get_option('sense_basic_text');
	$is_body_font_size = get_option('sense_size_basic_text');
	
	echo "
		.blog-info p, .page-content p, .categories-heading p, #products_tabs .tab-content 
		{	
		font-family: " . $is_body_font_family . " !important;  color: " . $is_body_font_color . "; font-style: " . $is_body_font_style . ";  font-size: " . $is_body_font_size . " !important; 
		} 
		";
	
	
	
	$is_body_font_family = get_option('sense_basic_font');
	$is_body_font_color = get_option('sense_basic_font_color');
	$is_body_font_style = get_option('sense_basic_text_styles');
	$is_body_font_size = get_option('sense_size_basic_text');
	
	echo "
		.blog-info p, .page-content p, .categories-heading p 
		{	
		font-family: " . $is_body_font_family . " !important;  color: " . $is_body_font_color . "; font-style: " . $is_body_font_style . ";  font-size: " . $is_body_font_size . " !important; 
		} 
		";
		
		
	$is_page_title_font_family = get_option('sense_page_title_font');
	$is_page_title_font_color = get_option('sense_page_title_font_color');
	$is_page_title_font_style = get_option('sense_page_title_styles');
	$is_page_title_font_size = get_option('sense_size_page_title');	
		
	echo "
		.sidebar-box-heading h4, .carousel-heading h4
		{	
		font-family: " . $is_page_title_font_family . " !important;  color: " . $is_page_title_font_color . "; font-style: " . $is_page_title_font_style . ";  font-size: " . $is_page_title_font_size . " !important; 
		} 
		";	
		
		
		
	$copyright_text_font_family = get_option('sense_copyright_font');
	$copyright_text_font_color = get_option('sense_copyright_font_color');
	$copyright_text_font_style = get_option('sense_copyright_text_styles');
	$copyright_text_font_size = get_option('sense_copyright_text_size');	
		
	echo "
		#lower-footer .copyright-text
		{	
		font-family: " . $copyright_text_font_family . " !important;  color: " . $copyright_text_font_color . "; font-style: " . $copyright_text_font_style . ";  font-size: " . $copyright_text_font_size . " !important; 
		} 
		";		
		
		
		
		
		
	$footer_titles_font_family = get_option('sense_footer_titles_font');
	$footer_titles_font_color = get_option('sense_footer_titles_font_color');
	$footer_titles_font_style = get_option('sense_footer_titles_styles');
	$footer_titles_font_size = get_option('sense_footer_titles_size');	
		
	echo "
		#main-footer h4, #upper-footer h4
		{	
		font-family: " . $footer_titles_font_family . " !important;  color: " . $footer_titles_font_color . "; font-style: " . $footer_titles_font_style . ";  font-size: " . $footer_titles_font_size . " !important; 
		} 
		";			
		
		
		
		
		
	$header_text_font_family = get_option('sense_header_text_font');
	$header_text_font_color = get_option('sense_header_text_font_color');
	$header_text_font_style = get_option('sense_header_text_styles');
	$header_text_font_size = get_option('sense_header_text_size');	
		
	echo "
		#top-header li a
		{	
		font-family: " . $header_text_font_family . " !important;  color: " . $header_text_font_color . "; font-style: " . $header_text_font_style . ";  font-size: " . $header_text_font_size . " !important; 
		} 
		";				
		
		
		
		
	$small_text_font_family = get_option('sense_small_text_font');
	$small_text_font_color = get_option('sense_small_text_font_color');
	$small_text_font_style = get_option('sense_small_text_styles');
	$small_text_font_size = get_option('sense_small_text_size');	
		
	echo "
		.blog-meta span
		{	
		font-family: " . $small_text_font_family . " !important;  color: " . $small_text_font_color . "; font-style: " . $small_text_font_style . ";  font-size: " . $small_text_font_size . " !important; 
		} 
		";		





	$is_h1_font_family = get_option('sense_h1_font');
	$is_h1_font_color = get_option('sense_h1_font_color');
	$is_h1_font_style = get_option('sense_h1_text');
	$is_h1_font_size = get_option('sense_text_h1');
	$is_h2_font_family = get_option('sense_h2_font');
	$is_h2_font_color = get_option('sense_h2_font_color');
	$is_h2_font_style = get_option('sense_h2_text');
	$is_h2_font_size = get_option('sense_text_h2');
	$is_h3_font_family = get_option('sense_h3_font');
	$is_h3_font_color = get_option('sense_h3_font_color');
	$is_h3_font_style = get_option('sense_h3_text');
	$is_h3_font_size = get_option('sense_text_h3');
	$is_h4_font_family = get_option('sense_h4_font');
	$is_h4_font_color = get_option('sense_h4_font_color');
	$is_h4_font_style = get_option('sense_h4_text');
	$is_h4_font_size = get_option('sense_text_h4');
	$is_h5_font_family = get_option('sense_h5_font');
	$is_h5_font_color = get_option('sense_h5_font_color');
	$is_h5_font_style = get_option('sense_h5_text');
	$is_h5_font_size = get_option('sense_text_h5');
	$is_h6_font_family = get_option('sense_h6_font');
	$is_h6_font_color = get_option('sense_h6_font_color');
	$is_h6_font_style = get_option('sense_h6_text');
	$is_h6_font_size = get_option('sense_text_h6');





	echo "
		.blog-info h1, .page-content h1, .wpb_text_column h1 {font-family: " . $is_h1_font_family . " !important;  color: " . $is_h1_font_color . " !important; font-style: " . $is_h1_font_style . " !important; 	font-size: " . $is_h1_font_size . " !important; } 

		.blog-info h2, .page-content h2, .wpb_text_column h2 {font-family: " . $is_h2_font_family . " !important;  color: " . $is_h2_font_color . " !important; font-style: " . $is_h2_font_style . " !important; 	font-size: " . $is_h2_font_size . " !important; } 

	    .blog-info h3, .page-content h3, .wpb_text_column h3 {font-family: " . $is_h3_font_family . " !important;  color: " . $is_h3_font_color . " !important; font-style: " . $is_h3_font_style . " !important; 	font-size: " . $is_h3_font_size . " !important; } 

	    .blog-info h4, .page-content h4, .wpb_text_column h4 {font-family: " . $is_h4_font_family . " !important;  color: " . $is_h4_font_color . " !important; font-style: " . $is_h4_font_style . " !important; 	font-size: " . $is_h4_font_size . " !important; } 

		.blog-info h5, .page-content h5, .wpb_text_column h5 {font-family: " . $is_h5_font_family . " !important;  color: " . $is_h5_font_color . " !important; font-style: " . $is_h5_font_style . " !important; 	font-size: " . $is_h5_font_size . " !important; } 

		.blog-info h6, .page-content h6, .wpb_text_column h6 {font-family: " . $is_h6_font_family . " !important;  color: " . $is_h6_font_color . " !important; font-style: " . $is_h6_font_style . " !important; 	font-size: " . $is_h6_font_size . " !important; } 
		";



		
		
		
		
	echo "#search-bar, body #main-navigation #mega_main_menu .nav-search.searchbar-visible:hover, #main-navigation #mega_main_menu .nav-search.searchbar-visible  { background: " . get_option('sense_bg_search_top_color') . " !important; }";	
	echo "#main-navigation #mega_main_menu .nav-search, #search-button  { background: " . get_option('sense_bg_search_top_btn_color') . " !important; }";	
	echo "body #main-navigation #mega_main_menu .nav-search:hover, #search-button:hover  { background: " . get_option('sense_bg_search_top_btn_hover_color') . " !important; }";	
		
	echo "body li.top_compare a { background: " . get_option('sense_bg_compare_top_color') . " !important; }";	
	echo "body li.top_compare a:hover  { background: " . get_option('sense_bg_compare_hover_top_color') . " !important; }";	
	
	
	echo "body li.top_wishlist a  { background: " . get_option('sense_bg_wishlist_top_color') . " !important; }";	
	echo "body li.top_wishlist a:hover  { background: " . get_option('sense_bg_wishlist_hover_top_color') . " !important; }";	
	
	
	echo "body li.top_cart a.top_cart_a { background: " . get_option('sense_bg_cart_top_color') . " !important; }";	
	echo "body li.top_cart a.top_cart_a:hover  { background: " . get_option('sense_bg_cart_hover_top_color') . " !important; }";	
		
		
	echo "body li.top_languages a.flag { background: " . get_option('sense_bg_languages_top_color') . " !important; }";	
	echo "body li.top_languages a.flag:hover  { background: " . get_option('sense_bg_languages_hover_top_color') . " !important; }";	
		
	echo "body li.top_currency a.cur_currency { background: " . get_option('sense_bg_currency_top_color') . " !important; }";	
	echo "body li.top_currency a.cur_currency:hover  { background: " . get_option('sense_bg_currency_hover_top_color') . " !important; }";	
		
		

	echo '</style>';		
}





?>