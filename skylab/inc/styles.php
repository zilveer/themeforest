<?php
/**
 * Adds classes to the array of body classes.
 */
function mega_body_shop_classes( $classes ) {
		
	// Shop layout
	global $woocommerce;
	if ( $woocommerce ) {
		if ( is_shop() || is_product_category() ) {
			$shop_layout = ot_get_option( 'shop_layout' );
			if ( $shop_layout == 'right-sidebar' || isset($_GET['sidebar']) && $_GET['sidebar'] == 'right-sidebar')
				$classes[] = 'shop-right-sidebar';
			else if ( $shop_layout == 'full-width' || isset($_GET['sidebar']) && $_GET['sidebar'] == 'full-width')
				$classes[] = 'shop-no-sidebar';
			else $classes[] = 'shop-left-sidebar';
		}
	}

	return $classes;
}
add_filter( 'body_class', 'mega_body_shop_classes' );

/**
 * Filter Primary Typography Fonts.
 */
function filter_ot_recognized_font_families( $array, $field_id ) {
  if ( $field_id == 'primary_typography' || $field_id == 'menu_typography' || $field_id == 'header_typography' ) {
  
	$systemFontSelect = array(
		'Arial' => 'Arial',
		'Calibri' => 'Calibri',
		'Century Gothic' => 'Century Gothic',
		'Courier' => 'Courier',
		'Courier New' => 'Courier New',
		'Georgia' => 'Georgia',
		'Modern' => 'Modern',
		'Tahoma' => 'Tahoma',
		'Times New Roman' => 'Times New Roman',
		'Trebuchet MS' => 'Trebuchet MS',
		'Verdana' => 'Verdana'
	);
  
    $array = $systemFontSelect;
  }
  
  return $array;
  
}
add_filter( 'ot_recognized_font_families', 'filter_ot_recognized_font_families', 10, 2 );



/**
 * A safe way to add/enqueue a CSS/JavaScript to the wordpress generated page. 
 */
function mega_enqueue_google_fonts() {
	$google_font_family = ot_get_option( 'google_font_family' );
	if ( ! empty( $google_font_family ) ) {
		echo $google_font_family;
	}
}
add_action( 'wp_head', 'mega_enqueue_google_fonts', 2 );

function mega_enqueue_menu_google_fonts() {
	$menu_google_font_family = ot_get_option( 'menu_google_font_family' );
	if ( ! empty( $menu_google_font_family ) ) {
		echo $menu_google_font_family;
	}
}
add_action( 'wp_head', 'mega_enqueue_menu_google_fonts', 2 );

function mega_enqueue_header_google_fonts() {
	$header_google_font_family = ot_get_option( 'header_google_font_family' );
	if ( ! empty( $header_google_font_family ) ) {
		echo $header_google_font_family;
	}
}
add_action( 'wp_head', 'mega_enqueue_header_google_fonts', 2 );



/**
 * Add a style block to the theme for the primary typography.
 */
function mega_print_primary_typography() {
	$primary_typography = ot_get_option( 'primary_typography', array() );
	
	$google_font_name = ot_get_option( 'google_font_name' );
	
	if ( ! empty( $google_font_name ) ) {
		$primary_font = $google_font_name;
	} else if ( ! empty( $primary_typography['font-family'] ) ) {
		$primary_font = $primary_typography['font-family'];
	}
	
	// Don't do anything if the font-family is empty.
	if ( ! empty( $primary_typography['font-family'] ) || ! empty( $google_font_name ) ) :
?>
	<style>
		/* Primary Typography */
		body, input, textarea, select, #cancel-comment-reply-link {
			font-family: "<?php echo esc_attr( $primary_font ); ?>", sans-serif !important;
		}
		/* AddThis Typography */
		#at16recap, #at_msg, #at16p label, #at16nms, #at16sas, #at_share .at_item, #at16p, #at15s, #at16p form input, #at16p textarea {
			font-family: "<?php echo esc_attr( $primary_font ); ?>", sans-serif !important;
		}
		/* fancyBox */
		.fancybox-title {
			font-family: "<?php echo esc_attr( $primary_font ); ?>", sans-serif !important;
		}
		/* WooCommerce */
		.woocommerce ul.products li.product h3, .woocommerce-page ul.products li.product h3 {
			font-family: "<?php echo esc_attr( $primary_font ); ?>", sans-serif !important;
		}
	</style>
<?php
	endif;
}
add_action( 'wp_head', 'mega_print_primary_typography' );

/**
 * Add a style block to the theme for the menu typography.
 */
function mega_print_menu_typography() {
	$menu_typography = ot_get_option( 'menu_typography' );
	
	$menu_google_font_name = ot_get_option( 'menu_google_font_name' );
	
	if ( ! empty( $menu_google_font_name ) ) {
		$menu_font = $menu_google_font_name;
	} else if ( ! empty( $menu_typography['font-family'] ) ) {
		$menu_font = $menu_typography['font-family'];
	}
	
	
	// Don't do anything if the font-family is empty.
	if ( ! empty( $menu_typography['font-family'] ) || ! empty( $menu_google_font_name ) ) :
?>
	<style>
		/* Menu Typography */
		#access ul,
		#access-mobile {
			font-family: "<?php echo esc_attr( $menu_font ); ?>", sans-serif;
		}
	</style>
<?php
	endif;
}
add_action( 'wp_head', 'mega_print_menu_typography' );

/**
 * Add a style block to the theme for the header typography.
 */
function mega_print_header_typography() {
	$header_typography = ot_get_option( 'header_typography' );
	
	$header_google_font_name = ot_get_option( 'header_google_font_name' );
	
	if ( ! empty( $header_google_font_name ) ) {
		$header_font = $header_google_font_name;
	} else if ( ! empty( $header_typography['font-family'] ) ) {
		$header_font = $header_typography['font-family'];
	}
	
	
	// Don't do anything if the font-family is empty.
	if ( ! empty( $header_typography['font-family'] ) || ! empty( $header_google_font_name ) ) :
?>
	<style>
		/* Header Typography */
		h1, h2, h3, h4, h5, h6,
		.testimonial-big blockquote,
		.showbiz-title,
		#content .showbiz-title a,
		#content .showbiz-title a:visited,
		#content .showbiz-title a:hover,
		.wpb_content_element .wpb_tour_tabs_wrapper .wpb_tabs_nav a,
		.wpb_content_element .wpb_accordion_header a,
		.tp-caption.skylab_very_big_white,
		.tp-caption.skylab_very_big_black,
		.woocommerce #page div.product .woocommerce-tabs ul.tabs li a {
			font-family: "<?php echo esc_attr( $header_font ); ?>", sans-serif;
		}
	</style>
<?php
	endif;
}
add_action( 'wp_head', 'mega_print_header_typography' );

/**
 * Add a style block to the theme for the primary color.
 */
function mega_print_primary_color_style() {
	$primary_color = ot_get_option( 'primary_color' );
	
	// Don't do anything if the primary color is empty or the default.
	if ( empty( $primary_color ) || $primary_color == '#96e0e9' )
		return;
?>
	<style>
		/* Primary color */
		#content #nav-pagination a:hover,
		#content .wpb_accordion .wpb_accordion_wrapper .ui-state-active .ui-icon,
		#content .wpb_content_element.tabs-custom .wpb_tabs_nav li.ui-tabs-active,
		#content .wpb_content_element.tabs-custom-2 .wpb_tabs_nav li.ui-tabs-active a,
		#content .wpb_content_element.tabs-custom-3 .wpb_tabs_nav li.ui-tabs-active a,
		.woocommerce #page nav.woocommerce-pagination ul li a:hover,
		.woocommerce-page #page nav.woocommerce-pagination ul li a:hover,
		#order_review_wrapper,
		#content #nav-pagination-single a,
		#respond input#submit {
			border-color: <?php echo esc_attr( $primary_color ); ?>;
		}
		#content #nav-pagination a:hover,
		.date-wrapper .entry-date,
		.woocommerce #page .quantity .plus:hover,
		.woocommerce .quantity .minus:hover,
		.woocommerce #page #content .quantity .plus:hover,
		.woocommerce #page #content .quantity .minus:hover,
		.woocommerce-page #page .quantity .plus:hover,
		.woocommerce-page #page .quantity .minus:hover,
		.woocommerce-page #page #content .quantity .plus:hover,
		.woocommerce-page #page #content .quantity .minus:hover,
		#page .chosen-container .chosen-results .highlighted,
		.woocommerce #page .widget_price_filter .price_slider_wrapper .ui-widget-content,
		.woocommerce-page #page .widget_price_filter .price_slider_wrapper .ui-widget-content,
		.woocommerce #page nav.woocommerce-pagination ul li a:hover,
		.woocommerce-page #page nav.woocommerce-pagination ul li a:hover,
		#page .chosen-container .chosen-results li.highlighted,
		#page .sd-social-icon .sd-content ul li[class*='share-'] a.sd-button:hover,
		#content #nav-pagination-single a:hover,
		#respond input#submit:hover {
			background: <?php echo esc_attr( $primary_color ); ?>;
		}
		.below-content-entry-meta a:hover,
		#block-portfolio .hentry a.content-wrapper:hover .portfolio-data h2,
		.title-visible a.portfolio-data:hover h2,
		.title-visible .portfolio-data:hover,
		h1 a:hover,
		h2 a:hover,
		h3 a:hover,
		h4 a:hover,
		h5 a:hover,
		h6 a:hover,
		a,
		.woocommerce-links a:hover,
		#top-bar .social-accounts .social:hover,
		#access .social-accounts .social:hover ,
		#search-header-icon:hover i:before,
		#branding .woocommerce-cart:hover,
		#top-bar-wrapper .woocommerce-cart:hover,
		.transparent-header #branding #access .woocommerce-cart-wrapper ul li a:hover,
		#branding #access ul li a:active,
		#branding #access ul li a:hover,
		#access ul li.sfHover > a,
		#access ul .current-menu-item > a,
		#access ul .current_page_item > a,
		.transparent-header #branding #access ul li li a:active,
		.transparent-header #branding #access ul li li a:hover,
		.transparent-header #access ul li li.sfHover > a,
		.transparent-header #access ul li .current-menu-item > a,
		.transparent-header #access ul li .current_page_item > a,
		#access ul .current-menu-ancestor > a,
		#access ul .menu-item-object-custom.current_page_item > a,
		#access ul .menu-item-object-custom.current-menu-item a:hover,
		#access ul .menu-item-object-custom.current_page_item a:hover,
		#access ul li li a:hover,
		#access ul li li.sfHover > a,
		#access ul li .current-menu-item > a,
		#access ul li .current_page_item > a,
		#access-mobile .current-menu-item > a,
		#access-mobile .current_page_item > a,
		#access-mobile .current-menu-ancestor > a,
		#access-mobile .m-hover,
		#remove-search:hover,
		.entry-title a:hover,
		.archive footer.entry-meta a:hover,
		.search footer.entry-meta a:hover,
		.blog footer.entry-meta a:hover,
		.single-post footer.entry-meta a:hover,
		.archive footer.entry-meta a:hover i:before,
		.search footer.entry-meta a:hover i:before,
		.blog footer.entry-meta a:hover i:before,
		.single-post footer.entry-meta a:hover i:before,
		.entry-meta a:hover,
		.archive .entry-meta a:hover,
		.search .entry-meta a:hover,
		.blog .entry-meta a:hover,
		.single-post .entry-meta a:hover,
		.archive .entry-meta a:hover .fontello-comment:before,
		.search .entry-meta a:hover .fontello-comment:before,
		.blog .entry-meta a:hover .fontello-comment:before,
		.single-post .entry-meta a:hover .fontello-comment:before,
		#content #nav-pagination .next:hover,
		#content #nav-pagination .prev:hover,
		.widget a,
		#wp-calendar #today,
		.comment-reply-link:hover,
		.comment-edit-link:hover,
		.comment-author a:hover,
		#supplementary .widget a:hover,
		#site-generator a:hover,
		#site-generator .social-accounts .social:hover,
		.dark a:hover,
		.wpb_thumbnails h2 a:hover,
		.wpb_thumbnails h3 a:hover,
		.teaser_grid_container .comments-link a:hover,
		.teaser_grid_container .comments-link a:hover i:before,
		.wpb_grid.columns_count_1 .teaser_grid_container .comments-link a:hover,
		.wpb_grid.columns_count_1 footer.entry-meta a:hover,
		.columns_count_1 .entry-meta a:hover,
		#content .wpb_accordion .wpb_accordion_wrapper .ui-state-active .ui-icon:before,
		#content .wpb_accordion .wpb_accordion_wrapper .ui-state-active .ui-icon,
		#content .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header a:focus,
		#content .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header a:active,
		#content .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header a:hover,
		#content .wpb_content_element .wpb_tabs_nav li.ui-tabs-active a,
		#content .wpb_content_element.tabs-custom-2 .wpb_tabs_nav li.ui-state-hover a,
		#content .wpb_content_element.tabs-custom-3 .wpb_tabs_nav li.ui-state-hover a,
		#content .wpb_tour.wpb_content_element .wpb_tabs_nav li a.ui-tabs-active,
		#content .wpb_tour.wpb_content_element .wpb_tabs_nav li a:hover,
		.person-desc-wrapper a,
		.woocommerce #page .woocommerce-breadcrumb a:hover,
		.woocommerce-page #page .woocommerce-breadcrumb a:hover,
		.woocommerce ul.products li.product a:hover,
		.woocommerce-page ul.products li.product a:hover,
		.woocommerce ul.products li.product a:hover h3,
		.woocommerce-page ul.products li.product a:hover h3,
		.woocommerce ul.products li.product .posted_in a:hover,
		.woocommerce-page ul.products li.product .posted_in a:hover,
		.woocommerce #page div.product span.price,
		.woocommerce #page div.product p.price,
		.woocommerce #page #content div.product span.price,
		.woocommerce #page #content div.product p.price,
		.woocommerce-page #page div.product span.price,
		.woocommerce-page #page div.product p.price,
		.woocommerce-page #page #content div.product span.price,
		.woocommerce-page #page #content div.product p.price,
		.woocommerce #page ul.products li.product .price,
		.woocommerce-page #page ul.products li.product .price,
		.woocommerce #page nav.woocommerce-pagination ul li a.next:hover,
		.woocommerce-page #page nav.woocommerce-pagination ul li a.next:hover,
		.woocommerce #page nav.woocommerce-pagination ul li a.prev:hover,
		.woocommerce-page #page nav.woocommerce-pagination ul li a.prev:hover,
		.woocommerce #page table.cart a.remove:hover,
		.woocommerce #page #content table.cart a.remove:hover,
		.woocommerce-page #page table.cart a.remove:hover,
		.woocommerce-page #page #content table.cart a.remove:hover,
		.woocommerce p.stars a.star-1:hover:after,
		.woocommerce p.stars a.star-2:hover:after,
		.woocommerce p.stars a.star-3:hover:after,
		.woocommerce p.stars a.star-4:hover:after,
		.woocommerce p.stars a.star-5:hover:after,
		.woocommerce-page p.stars a.star-1:hover:after,
		.woocommerce-page p.stars a.star-2:hover:after,
		.woocommerce-page p.stars a.star-3:hover:after,
		.woocommerce-page p.stars a.star-4:hover:after,
		.woocommerce-page p.stars a.star-5:hover:after,
		.woocommerce #page .products .star-rating,
		.woocommerce-page #page .products .star-rating,
		.woocommerce #page .star-rating,
		.woocommerce-page #page .star-rating,
		.woocommerce #page a.added_to_cart,
		.woocommerce-page #page a.added_to_cart,
		#content #nav-pagination-single a,
		#content nav i,
		#respond input#submit,
		#site-generator #to-top:hover,
		.more-link,
		.archive footer.entry-meta .tag-links a:hover,
		.search footer.entry-meta .tag-links a:hover,
		.blog footer.entry-meta .tag-links a:hover,
		.single-post footer.entry-meta .tag-links a:hover,
		#mobile-menu-dropdown:hover i:before,
		#mobile-menu-dropdown:hover {
			color: <?php echo esc_attr( $primary_color ); ?>;
		}
		.transparent-header #branding #access ul li a:active,
		.transparent-header #branding #access ul li a:hover,
		.transparent-header #access ul li.sfHover > a,
		.transparent-header #access ul .current-menu-item > a,
		.transparent-header #access ul .current_page_item > a,
		.transparent-header #access ul .current-menu-ancestor > a {
			color: <?php echo esc_attr( $primary_color ); ?>;
		}
		.showbiz-title a:hover,
		#top-bar #lang_sel:hover .lang_sel_sel,
		#top-bar #lang_sel a:hover,
		.tagcloud a:hover {
			color: <?php echo esc_attr( $primary_color ); ?> !important;
		}
		
		/* UberMenu Skin: Skylab */
		#megaMenu ul.megaMenu > li.current-menu-item > a,
		#megaMenu ul.megaMenu > li.current-menu-parent > a,
		#megaMenu ul.megaMenu > li.current-menu-ancestor > a,
		#megaMenu ul li.ss-nav-menu-mega ul ul.sub-menu li a:hover,
		#megaMenu ul ul.sub-menu > li:hover > a,
		#megaMenu ul li.menu-item.ss-nav-menu-mega ul.sub-menu > li.menu-item:hover > a {
			color: <?php echo esc_attr( $primary_color ); ?>;
		}
		#megaMenu ul.megaMenu > li.current-menu-item > a,
		#megaMenu ul.megaMenu > li.current-menu-parent > a,
		#megaMenu ul.megaMenu > li.current-menu-ancestor > a,
		#megaMenu.megaMenuHorizontal ul.megaMenu > li.ss-nav-menu-mega > ul.sub-menu-1,
		#megaMenu.megaMenuHorizontal ul.megaMenu li.ss-nav-menu-reg ul.sub-menu,
		#megaMenu.wpmega-nojs li.menu-item.ss-nav-menu-mega ul.sub-menu.sub-menu-1,
		#megaMenu.megaFullWidthSubs li.menu-item.ss-nav-menu-mega ul.sub-menu.sub-menu-1,
		#megaMenu li.menu-item.ss-nav-menu-mega.ss-nav-menu-mega-fullWidth ul.sub-menu.sub-menu-1 {
			border-color: <?php echo esc_attr( $primary_color ); ?>;
		}
		#megaMenu ul.megaMenu > li.current-menu-ancestor > a {
			border-color: <?php echo esc_attr( $primary_color ); ?> !important;
		}
		#megaMenu ul.megaMenu > li:hover > a,
		#megaMenu ul.megaMenu > li > a:hover,
		#megaMenu ul.megaMenu > li.megaHover > a,
		#megaMenu ul ul.sub-menu li.current-menu-item > a {
			color: <?php echo esc_attr( $primary_color ); ?> !important;
		}
		#megaMenu ul.megaMenu > li:hover > a,
		#megaMenu ul.megaMenu > li > a:hover,
		#megaMenu ul.megaMenu > li.megaHover > a {
			border-color: <?php echo esc_attr( $primary_color ); ?> !important;
		}
		#top-bar #lang_sel:hover .lang_sel_sel {
			color: <?php echo esc_attr( $primary_color ); ?> !important;
		}
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_primary_color_style' );

/**
 * Add a style block to the theme for the alt buttons background color - hover/active.
 */
function mega_print_alt_button_background_color_hover_style() {
	$alt_button_background_color = ot_get_option( 'alt_button_background_color' );
	
	// Don't do anything if the alt buttons background color - hover/active is empty or the default.
	if ( empty( $alt_button_background_color ) || $alt_button_background_color == '#2495d6' )
		return;
?>
	<style>
		/* Alt Buttons Background Color - Hover/Active */
		.wpcf7-submit:hover,
		#page .woocommerce-cart-checkout .alt:hover,
		#respond input#submit:hover,
		.woocommerce #page a.button.alt:hover,
		.woocommerce #page button.button.alt:hover,
		.woocommerce #page input.button.alt:hover,
		.woocommerce #page #respond input#submit.alt:hover,
		.woocommerce #page #content input.button.alt:hover,
		.woocommerce-page #page a.button.alt:hover,
		.woocommerce-page #page button.button.alt:hover,
		.woocommerce-page #page input.button.alt:hover,
		.woocommerce-page #page #respond input#submit.alt:hover,
		.woocommerce-page #page #content input.button.alt:hover {
			background-color: <?php echo esc_attr( $alt_button_background_color ); ?>;
		}
	</style>
<?php
}
//add_action( 'wp_head', 'mega_print_alt_button_background_color_hover_style' );

/**
 * Add a style block to the theme for the header background color.
 */
function mega_print_header_background_color_style() {
	$header_background_color = ot_get_option( 'header_background_color' );
	
	// Don't do anything if the header background color is empty or the default.
	if ( empty( $header_background_color ) || $header_background_color == '#ffffff' )
		return;
?>
	<style>
		/* Header Background Color */
		#header,
		#megaMenu.megaMenuHorizontal ul.megaMenu > li.menu-item > ul.sub-menu.sub-menu-1,
		#branding .search-form-wrapper,
		#branding .search-form-wrapper em,
		#access ul li ul {
			background: <?php echo esc_attr( $header_background_color ); ?>;
		}
		#megaMenu.megaMenuHorizontal ul.megaMenu > li > a,
		#megaMenu.megaMenuHorizontal ul.megaMenu > li > span.um-anchoremulator,
		#access ul a {
			border-color: <?php echo esc_attr( $header_background_color ); ?>;
		}
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_header_background_color_style' );

/**
 * Add a style block to the theme for the navigation link color.
 */
function mega_print_navigation_link_color_style() {
	$navigation_link_color = ot_get_option( 'navigation_link_color' );
	
	// Don't do anything if the navigation link color is empty or the default.
	if ( empty( $navigation_link_color ) || $navigation_link_color == '#111111' )
		return;
?>
	<style>
		/* Navigation Link color */
		#megaMenu ul.megaMenu > li > a,
		#megaMenu ul.megaMenu > li > span.um-anchoremulator,
		#branding .woocommerce-cart,
		#search-header-icon i:before,
		#megaMenu ul ul.sub-menu li > a,
		#megaMenu ul li.ss-nav-menu-mega ul ul.sub-menu li > a,
		#megaMenu ul ul.sub-menu li > a,
		#megaMenu ul li.ss-nav-menu-mega ul.sub-menu-1 > li > span.um-anchoremulator,
		#access ul a,
		#access .social-accounts .social,
		#site-title a,
		#mobile-menu-dropdown i:before {
			color: <?php echo esc_attr( $navigation_link_color ); ?>;
		}
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_navigation_link_color_style' );

/**
 * Add a style block to the theme for the navigation link color - hover/active.
 */
function mega_print_navigation_link_color_hover_style() {
	$navigation_link_color_hover = ot_get_option( 'navigation_link_color_hover' );
	
	// Don't do anything if the navigation link color - hover/active is empty or the default.
	if ( empty( $navigation_link_color_hover ) || $navigation_link_color_hover == '#96e0e9' )
		return;
?>
	<style>
		/* Navigation Link color - Hover/Active */
		#megaMenu ul.megaMenu > li.current-menu-item > a,
		#megaMenu ul.megaMenu > li.current-menu-parent > a,
		#megaMenu ul.megaMenu > li.current-menu-ancestor > a,
		#megaMenu ul li.menu-item.ss-nav-menu-mega ul.sub-menu > li.menu-item.current-menu-item > a,
		#megaMenu ul li.menu-item.ss-nav-menu-mega ul.sub-menu > li.menu-item:hover > a,
		#megaMenu ul.megaMenu > li:hover > a,
		#megaMenu ul.megaMenu > li > a:hover,
		#megaMenu ul.megaMenu > li.megaHover > a,
		#megaMenu ul li.ss-nav-menu-mega ul ul.sub-menu li a:hover,
		#megaMenu ul ul.sub-menu > li:hover > a,
		#megaMenu ul ul.sub-menu li.current-menu-item > a,
		#branding .woocommerce-cart:hover,
		#search-header-icon:hover i:before,
		#branding .woocommerce-cart-wrapper ul li a:hover,
		#access ul .current-menu-ancestor > a,
		#branding #access ul li a:active,
		#branding #access ul li a:hover,
		#access ul li.sfHover > a,
		#access ul .current-menu-item > a,
		#access ul .current_page_item > a,
		#mobile-menu-dropdown:hover i:before,
		#mobile-menu-dropdown:hover {
			color: <?php echo esc_attr( $navigation_link_color_hover ); ?> !important;
		}
		#megaMenu ul.megaMenu > li.current-menu-item > a,
		#megaMenu ul.megaMenu > li.current-menu-parent > a,
		#megaMenu ul.megaMenu > li.current-menu-ancestor > a,
		#megaMenu.wpmega-nojs li.menu-item.ss-nav-menu-mega ul.sub-menu.sub-menu-1,
		#megaMenu.megaFullWidthSubs li.menu-item.ss-nav-menu-mega ul.sub-menu.sub-menu-1,
		#megaMenu li.menu-item.ss-nav-menu-mega.ss-nav-menu-mega-fullWidth ul.sub-menu.sub-menu-1,
		#megaMenu ul.megaMenu > li:hover > a,
		#megaMenu ul.megaMenu > li > a:hover,
		#megaMenu ul.megaMenu > li.megaHover > a,
		#megaMenu.megaMenuHorizontal ul.megaMenu > li.ss-nav-menu-mega > ul.sub-menu-1,
		#megaMenu.megaMenuHorizontal ul.megaMenu li.ss-nav-menu-reg ul.sub-menu,
		#access ul .current-menu-ancestor > a,
		#branding #access ul li a:active,
		#branding #access ul li a:hover,
		#access ul li.sfHover > a,
		#access ul .current-menu-item > a,
		#access ul .current_page_item > a,
		#access ul li ul {
			border-color: <?php echo esc_attr( $navigation_link_color_hover ); ?> !important;
		}
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_navigation_link_color_hover_style' );

/**
 * Add a style block to the theme for the header text color.
 */
function mega_print_header_text_color_style() {
	$header_text_color = ot_get_option( 'header_text_color' );
	
	// Don't do anything if the header text color is empty or the default.
	if ( empty( $header_text_color ) || $header_text_color == '#777777' )
		return;
?>
	<style>
		/* Header Text Color */
		#branding .woocommerce-cart-wrapper ul li {
			color: <?php echo esc_attr( $header_text_color ); ?> !important;
		}
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_header_text_color_style' );

/**
 * Add a style block to the theme for the border between top bar and header color.
 */
function mega_print_border_between_top_bar_and_header_color_style() {
	$border_between_top_bar_and_header_color = ot_get_option( 'border_between_top_bar_and_header_color' );
	
	// Don't do anything if the border between top bar and header color is empty or the default.
	if ( empty( $border_between_top_bar_and_header_color ) || $border_between_top_bar_and_header_color == '#ffffff' )
		return;
?>
	<style>
		/* Border Between Top Bar and Header Color */
		#header,
		.left-menu #header {
			border-top-color: <?php echo esc_attr( $border_between_top_bar_and_header_color ); ?>;
		}
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_border_between_top_bar_and_header_color_style' );

/**
 * Add a style block to the theme for the header bottom border color.
 */
function mega_print_header_bottom_border_color_style() {
	$header_bottom_border_color = ot_get_option( 'header_bottom_border_color' );
	
	// Don't do anything if the header bottom border color is empty or the default.
	if ( empty( $header_bottom_border_color ) || $header_bottom_border_color == '#ffffff' )
		return;
?>
	<style>
		/* Header Bottom Border Color */
		#header,
		.left-menu #header {
			border-bottom-color: <?php echo esc_attr( $header_bottom_border_color ); ?>;
		}
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_header_bottom_border_color_style' );

/**
 * Add a style block to the theme for the header top border width.
 */
function mega_print_header_top_border_width_style() {
	$header_top_border_width = ot_get_option( 'header_top_border_width' );
	
	// Don't do anything if the header top border width is empty or the default.
	if ( $header_top_border_width == '1' )
		return;
?>
	<style>
		/* Header Top Border Width */
		#header {
			border-width: <?php echo esc_attr( $header_top_border_width ); ?>px;
		}
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_header_top_border_width_style' );

/**
 * Add a style block to the theme for the header height.
 */
function mega_print_header_height_style() {
	$header_height = ot_get_option( 'header_height' );
	
	// Don't do anything if the header height is the default.
	if ( $header_height == 73 || empty( $header_height ) )
		return;
?>
	<style>
		/* Header Height */
		.fixed #header {
			height: <?php echo esc_attr( $header_height ); ?>px;
		}
	</style>
<?php
}
//add_action( 'wp_head', 'mega_print_header_height_style' );

/**
 * Add a style block to the theme for the logo margin.
 */
function mega_print_logo_margin_style() {
	$logo_margin = ot_get_option( 'logo_margin' );
	
	// Don't do anything if the logo margin is the default.
	if ( $logo_margin == 23 )
		return;
?>
	<style>
		/* Logo Margin */
		.non-sticky-header .site-title-custom {
			margin: <?php echo esc_attr( $logo_margin ); ?>px 0px;
		}
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_logo_margin_style' );

/**
 * Add a style block to the theme for the search icon and social icons margin.
 */
function mega_print_search_icon_margin_style() {
	$search_icon_margin = ot_get_option( 'search_icon_margin' );
	
	// Don't do anything if the search icon margin is the default.
	if ( $search_icon_margin == 28 )
		return;
?>
	<style>
		/* Search Icon and Social Icons Margin */
		.search-header-wrapper,
		#access .social-accounts-wrapper {
			margin: <?php echo esc_attr( $search_icon_margin ); ?>px 0px;
		}
		#header #remove-search {
			padding: <?php echo esc_attr( $search_icon_margin ); ?>px 0px;
		}
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_search_icon_margin_style' );

/**
 * Add a style block to the theme for the menu position.
 */
function mega_print_menu_position_style() {
	$menu_position = ot_get_option( 'menu_position' );
	
	// Don't do anything if the menu position is empty or the default.
	if ( empty( $menu_position ) || $menu_position == 'right' )
		return;
	
	if ( ! empty( $menu_position ) && $menu_position == 'left' ) {
		$menu_position == 'left';
	} else if ( ! empty( $menu_position ) && $menu_position == 'center' ) {
		$menu_position == 'none';
	}
?>
	<style>
		<?php if ( $menu_position == 'left' || $menu_position == 'right' ) { ?>
		/* Menu Position */
		#access .nav-menu {
			float: <?php echo esc_attr( $menu_position ); ?>;
		}
		<?php } ?>
		<?php if ( ! empty( $menu_position ) && $menu_position == 'center' ) { ?>
		#access .nav-menu {
			margin-left: 0;
			float: none;
			margin-top: 0;
			margin-bottom: 0;
		}
		#access ul {
			float: none;
			text-align: center;
			position: absolute;
			width: 100%;
		}
		<?php } ?>
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_menu_position_style' );

/**
 * Add a style block to the theme for the menu text transform.
 */
function mega_print_menu_text_transform_style() {
	$menu_text_transform = ot_get_option( 'menu_text_transform' );
	
	// Don't do anything if the menu text transform is empty or the default.
	if ( empty( $menu_text_transform ) || $menu_text_transform == 'uppercase' )
		return;
?>
	<style>
		/* Menu Text Transform */
		#access ul,
		#access-mobile ul {
			text-transform: <?php echo esc_attr( $menu_text_transform ); ?>;
		}
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_menu_text_transform_style' );

/**
 * Add a style block to the theme for the enable borders top and bottom.
 */
function mega_print_enable_borders_top_and_bottom_for_menu_style() {
	$enable_borders_top_and_bottom_for_menu = ot_get_option( 'enable_borders_top_and_bottom_for_menu' );
	
	// Don't do anything if the enable borders top and bottom is empty or the default.
	if ( empty( $enable_borders_top_and_bottom_for_menu ) )
		return;
?>
	<style>
		/* Enable Borders Top and Bottom */
		#access {
			border-top: 1px solid #f5f5f5;
			border-bottom: 1px solid #f5f5f5;
		}
		.center-logo-and-menu-enabled .site-title-custom,
		.center-logo-and-menu-enabled #site-title {
			margin-bottom: 60px;
		}
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_enable_borders_top_and_bottom_for_menu_style' );

/**
 * Add a style block to the theme for the borders top and bottom for menu color.
 */
function mega_print_borders_top_and_bottom_for_menu_color_style() {
	$borders_top_and_bottom_for_menu_color = ot_get_option( 'borders_top_and_bottom_for_menu_color' );
	
	// Don't do anything if the borders top and bottom for menu color is empty or the default.
	if ( empty( $borders_top_and_bottom_for_menu_color ) || $borders_top_and_bottom_for_menu_color == '#f5f5f5' )
		return;
?>
	<style>
		/* Borders Top and Bottom for Menu Color */
		#access {
			border-color: <?php echo esc_attr( $borders_top_and_bottom_for_menu_color ); ?>;
		}
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_borders_top_and_bottom_for_menu_color_style' );

/**
 * Add a style block to the theme for the menu font size.
 */
function mega_print_menu_font_size_style() {
	$menu_font_size = ot_get_option( 'menu_font_size' );
	
	// Don't do anything if the menu font size is the default.
	if ( $menu_font_size == 13 )
		return;
?>
	<style>
		/* Menu Font Size */
		#access ul {
			font-size: <?php echo esc_attr( $menu_font_size ); ?>px;
		}
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_menu_font_size_style' );

/**
 * Add a style block to the theme for the top bar background color.
 */
function mega_print_top_bar_background_color_style() {
	$top_bar_background_color = ot_get_option( 'top_bar_background_color' );
	
	// Don't do anything if the header top bar background color is empty or the default.
	if ( empty( $top_bar_background_color ) || $top_bar_background_color == '#ffffff' )
		return;
?>
	<style>
		/* Top Bar Background Color */
		#top-bar-wrapper,
		#top-bar #lang_sel ul ul {
			background: <?php echo esc_attr( $top_bar_background_color ); ?>;
		}
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_top_bar_background_color_style' );

/**
 * Add a style block to the theme for the top bar text color.
 */
function mega_print_top_bar_text_color_style() {
	$top_bar_text_color = ot_get_option( 'top_bar_text_color' );
	
	// Don't do anything if the header top bar text color is empty or the default.
	if ( empty( $top_bar_text_color ) || $top_bar_text_color == '#777777' )
		return;
?>
	<style>
		/* Top Bar Text Color */
		#top-bar {
			color: <?php echo esc_attr( $top_bar_text_color ); ?>;
		}
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_top_bar_text_color_style' );

/**
 * Add a style block to the theme for the top bar link color.
 */
function mega_print_top_bar_link_color_style() {
	$top_bar_link_color = ot_get_option( 'top_bar_link_color' );
	
	// Don't do anything if the header top bar link color is empty or the default.
	if ( empty( $top_bar_link_color ) || $top_bar_link_color == '#96e0e9' )
		return;
?>
	<style>
		/* Top Bar Link Color */
		#top-bar #lang_sel a,
		#top-bar #lang_sel a:visited,
		.woocommerce-links a {
			color: <?php echo esc_attr( $top_bar_link_color ); ?>;
		}
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_top_bar_link_color_style' );

/**
 * Add a style block to the theme for the top bar link color - hover/active.
 */
function mega_print_top_bar_link_color_hover_style() {
	$top_bar_link_color_hover = ot_get_option( 'top_bar_link_color_hover' );
	
	// Don't do anything if the header top bar link color - hover/active is empty or the default.
	if ( empty( $top_bar_link_color_hover ) || $top_bar_link_color_hover == '#111111' )
		return;
?>
	<style>
		/* Top Bar Link Color - Hover/Active */
		.woocommerce-links a:hover,
		#top-bar #lang_sel a:hover,
		#top-bar .social-accounts .social:hover {
			color: <?php echo esc_attr( $top_bar_link_color_hover ); ?>;
		}
		#top-bar #lang_sel:hover .lang_sel_sel {
			color: <?php echo esc_attr( $top_bar_link_color_hover ); ?> !important;
		}
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_top_bar_link_color_hover_style' );

/**
 * Add a style block to the theme for the top bar social icons color.
 */
function mega_print_top_bar_social_icons_color_style() {
	$top_bar_social_icons_color = ot_get_option( 'top_bar_social_icons_color' );
	
	// Don't do anything if the social icons color is empty or the default.
	if ( empty( $top_bar_social_icons_color ) || $top_bar_social_icons_color == '#111111' )
		return;
?>
	<style>
		/* Social Icons color */
		#top-bar .social-accounts .social {
			color: <?php echo esc_attr( $top_bar_social_icons_color ); ?>;
		}
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_top_bar_social_icons_color_style' );

/**
 * Adds background image.
 */
function mega_print_background_style() {
	$background = ot_get_option( 'background', array() );
?>
	<?php if ( ! empty( $background['background-color'] )
			|| ! empty( $background['background-image'] )
			|| ! empty( $background['background-repeat'] )
			|| ! empty( $background['background-attachment'] )
			|| ! empty( $background['background-position'] )
			|| ! empty( $background['background-size'] )
			) { ?>
	<style>
		/* Background */
		.boxed {
			<?php if ( ! empty( $background['background-color'] ) ) { ?>
			background-color: <?php echo esc_attr( $background['background-color'] ); ?>;
			<?php } ?>
			
			<?php if ( ! empty( $background['background-image'] ) ) { ?>
			background-image: url('<?php echo esc_attr( $background['background-image'] ); ?>');
			<?php } ?>
			
			<?php if ( ! empty( $background['background-repeat'] ) ) { ?>
			background-repeat: <?php echo esc_attr( $background['background-repeat'] ); ?>;
			<?php } ?>
			
			<?php if ( ! empty( $background['background-attachment'] ) ) { ?>
			background-attachment: <?php echo esc_attr( $background['background-attachment'] ); ?>;
			<?php } ?>
			
			<?php if ( ! empty( $background['background-position'] ) ) { ?>
			background-position: <?php echo esc_attr( $background['background-position'] ); ?>;
			<?php } ?>
			
			<?php if ( ! empty( $background['background-size'] ) ) { ?>
			background-size: <?php echo esc_attr( $background['background-size'] ); ?>;
			<?php } ?>
		}
	</style>
	<?php } ?>
<?php
}
//add_action( 'wp_head', 'mega_print_background_style' );

/**
 * Add a style block to the theme for the footer background color.
 */
function mega_print_footer_background_color_style() {
	$footer_background_color = ot_get_option( 'footer_background_color' );
	
	// Don't do anything if the footer background color is empty or the default.
	if ( empty( $footer_background_color ) || $footer_background_color == '#ffffff' )
		return;
?>
	<style>
		/* Footer Background Color */
		#colophon {
			background-color: <?php echo esc_attr( $footer_background_color ); ?>;
		}
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_footer_background_color_style' );

/**
 * Add a style block to the theme for the back to top button color.
 */
function mega_print_back_to_top_button_color_style() {
	$back_to_top_button_color = ot_get_option( 'back_to_top_button_color' );
	
	// Don't do anything if the back to top button color is empty or the default.
	if ( empty( $back_to_top_button_color ) || $back_to_top_button_color == '#777777' )
		return;
?>
	<style>
		/* Back To Top Button Color */
		#site-generator #to-top {
			color: <?php echo esc_attr( $back_to_top_button_color ); ?>;
		}
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_back_to_top_button_color_style' );

/**
 * Add a style block to the theme for the back to top button color - hover/active.
 */
function mega_print_back_to_top_button_color_hover_style() {
	$back_to_top_button_color_hover = ot_get_option( 'back_to_top_button_color_hover' );
	
	// Don't do anything if the back to top button color - hover/active is empty or the default.
	if ( empty( $back_to_top_button_color_hover ) || $back_to_top_button_color_hover == '#96e0e9' )
		return;
?>
	<style>
		/* Back To Top Button Color - Hover/Active */
		#site-generator #to-top:hover {
			color: <?php echo esc_attr( $back_to_top_button_color_hover ); ?>;
		}
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_back_to_top_button_color_hover_style' );

/**
 * Add a style block to the theme for the footer top border color.
 */
function mega_print_footer_top_border_color_style() {
	$footer_top_border_color = ot_get_option( 'footer_top_border_color' );
	
	// Don't do anything if the footer top border color is empty or the default.
	if ( empty( $footer_top_border_color ) || $footer_top_border_color == '#ffffff' )
		return;
?>
	<style>
		/* Footer Top Border Color */
		#site-generator-wrapper {
			border-color: <?php echo esc_attr( $footer_top_border_color ); ?>;
		}
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_footer_top_border_color_style' );

/**
 * Add a style block to the theme for the footer widget title color.
 */
function mega_print_footer_widget_title_color_style() {
	$footer_widget_title_color = ot_get_option( 'footer_widget_title_color' );
	
	// Don't do anything if the footer widget title color is empty or the default.
	if ( empty( $footer_widget_title_color ) || $footer_widget_title_color == '#111111' )
		return;
?>
	<style>
		/* Footer Widget Title Color */
		#supplementary .widget-title {
			color: <?php echo esc_attr( $footer_widget_title_color ); ?>;
		}
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_footer_widget_title_color_style' );

/**
 * Add a style block to the theme for the footer text color.
 */
function mega_print_footer_text_color_style() {
	$footer_text_color = ot_get_option( 'footer_text_color' );
	
	// Don't do anything if the footer text color is empty or the default.
	if ( empty($footer_text_color) || $footer_text_color == '#777777' )
		return;
?>
	<style>
		/* Footer Text Color */
		#supplementary p,
		#supplementary .widget ul li,
		#supplementary .post-date {
			color: <?php echo esc_attr( $footer_text_color ); ?>;
		}
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_footer_text_color_style' );

/**
 * Add a style block to the theme for the footer link color.
 */
function mega_print_footer_link_color_style() {
	$footer_link_color = ot_get_option( 'footer_link_color' );
	
	// Don't do anything if the footer link color is empty or the default.
	if ( empty($footer_link_color) || $footer_link_color == '#96e0e9' )
		return;
?>
	<style>
		/* Footer Link Color */
		#supplementary .widget a,
		#wp-calendar #today {
			color: <?php echo esc_attr( $footer_link_color ); ?>;
		}
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_footer_link_color_style' );

/**
 * Add a style block to the theme for the footer link color - hover/active.
 */
function mega_print_footer_link_color_hover_style() {
	$footer_link_color_hover = ot_get_option( 'footer_link_color_hover' );
	
	// Don't do anything if the footer link color - hover/active is empty or the default.
	if ( empty($footer_link_color_hover) || $footer_link_color_hover == '#111111' )
		return;
?>
	<style>
		/* Footer Link Color - Hover/Active */
		#supplementary .widget a:hover {
			color: <?php echo esc_attr( $footer_link_color_hover ); ?>;
		}
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_footer_link_color_hover_style' );

/**
 * Add a style block to the theme for the border between footer and footer bottom area color.
 */
function mega_print_border_between_footer_and_footer_bottom_area_color_style() {
	$border_between_footer_and_footer_bottom_area_color = ot_get_option( 'border_between_footer_and_footer_bottom_area_color' );
	
	// Don't do anything if the border between footer and footer bottom area color is empty or the default.
	if ( empty( $border_between_footer_and_footer_bottom_area_color ) || $border_between_footer_and_footer_bottom_area_color == '#f5f5f5' )
		return;
?>
	<style>
		/* Border Between Footer and Footer Bottom Area Color */
		#site-generator-wrapper {
			border-color: <?php echo esc_attr( $border_between_footer_and_footer_bottom_area_color ); ?>;
		}
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_border_between_footer_and_footer_bottom_area_color_style' );

/**
 * Add a style block to the theme for the footer bottom area background color.
 */
function mega_print_footer_bottom_area_background_color_style() {
	$footer_bottom_area_background_color = ot_get_option( 'footer_bottom_area_background_color' );
	
	// Don't do anything if the footer bottom area background color is empty or the default.
	if ( empty( $footer_bottom_area_background_color ) || $footer_bottom_area_background_color == '#ffffff' )
		return;
?>
	<style>
		/* Footer Bottom Area Background Color */
		#site-generator-wrapper,
		#supplementary .widget .tagcloud a {
			background-color: <?php echo esc_attr( $footer_bottom_area_background_color ); ?>;
		}
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_footer_bottom_area_background_color_style' );

/**
 * Add a style block to the theme for the footer bottom area link color.
 */
function mega_print_footer_bottom_area_link_color_style() {
	$footer_bottom_area_link_color = ot_get_option( 'footer_bottom_area_link_color' );
	
	// Don't do anything if the footer bottom area link color is empty or the default.
	if ( empty($footer_bottom_area_link_color) || $footer_bottom_area_link_color == '#96e0e9' )
		return;
?>
	<style>
		/* Footer Bottom Area Link Color */
		#site-generator a {
			color: <?php echo esc_attr( $footer_bottom_area_link_color ); ?>;
		}
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_footer_bottom_area_link_color_style' );

/**
 * Add a style block to the theme for the footer bottom area link color - hover/active.
 */
function mega_print_footer_bottom_area_link_color_hover_style() {
	$footer_bottom_area_link_color_hover = ot_get_option( 'footer_bottom_area_link_color_hover' );
	
	// Don't do anything if the footer bottom area link color - hover/active is empty or the default.
	if ( empty($footer_bottom_area_link_color_hover) || $footer_bottom_area_link_color_hover == '#111111' )
		return;
?>
	<style>
		/* Footer Bottom Area Link Color - Hover/Active */
		#site-generator a:hover {
			color: <?php echo esc_attr( $footer_bottom_area_link_color_hover ); ?>;
		}
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_footer_bottom_area_link_color_hover_style' );

/**
 * Add a style block to the theme for the footer bottom area text color.
 */
function mega_print_footer_bottom_area_text_color_style() {
	$footer_bottom_area_text_color = ot_get_option( 'footer_bottom_area_text_color' );
	
	// Don't do anything if the footer bottom area text color is empty or the default.
	if ( empty($footer_bottom_area_text_color) || $footer_bottom_area_text_color == '#bbbbbb' )
		return;
?>
	<style>
		/* Footer Bottom Area Text Color */
		#site-generator {
			color: <?php echo esc_attr( $footer_bottom_area_text_color ); ?>;
		}
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_footer_bottom_area_text_color_style' );

/**
 * Add a style block to the theme for the footer info align.
 */
function mega_print_footer_info_align_style() {
	$footer_info_align = ot_get_option( 'footer_info_align' );
	
	// Don't do anything if the footer info align is empty or the default.
	if ( empty( $footer_info_align ) || $footer_info_align == 'left' )
		return;
	
	if ( ! empty( $footer_info_align ) || $footer_info_align == 'right' ) {
		$footer_info_align == 'right';
	}
?>
	<style>
		/* Footer Info Align */
		#site-generator p {
			float: <?php echo esc_attr( $footer_info_align ); ?>;
		}
	</style>
<?php
}
//add_action( 'wp_head', 'mega_print_footer_info_align_style' );