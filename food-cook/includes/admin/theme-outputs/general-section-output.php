<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) :
    die ( 'You do not have sufficient permissions to access this page' );
endif;

$woo_options = get_option( 'woo_options' );

/*-----------------------------------------------------------------------------------*/
/* Add custom styling 																 */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'woo_custom_styling' ) ) {
	function woo_custom_styling() {
		global $woo_options;
		$df_options = get_theme_mod( 'df_options' );

		$default_google_font = false;

		$output = $body = $wrapper = $getrecipe = $navigation_css = $footer_wrap_css = $footer_bottom_wrap_css = '';

		// isset customize value
		$main_logo 	 	= isset( $df_options['logo'] ) ? $df_options['logo'] : NULL;
		$retina_logo 	= isset( $df_options['retina_logo'] ) ? $df_options['retina_logo'] : NULL;
		$ads_top 	 	= isset( $df_options['woo_ad_top'] ) ? $df_options['woo_ad_top'] : NULL;
		$general_style 	= isset( $df_options['woo_style_disable'] ) ? $df_options['woo_style_disable'] : NULL;

		// Logo
		if ( $main_logo != '' ) { $output .= '#logo .site-title, #logo .site-description { display:none; }'; }

		// Logo Retina
		if( $retina_logo != '' ) {
			$output .= '@media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min-device-pixel-ratio: 2), only screen and (min-resolution: 2dppx) { #logo .logo-normal{ display: none; } #logo .logo-retina{ display: inline; } }';
	    }

	    // ads top
		if ( $ads_top == 'true' ) {
			$output .= '@media only screen and (min-width: 769px) { #logo { text-align:left; float:left; } }';
		}

		// Check if we are wanting to generate the custom styling or not.
		if ( $general_style != 'true' ) {

		} else{
			if ( $output != '' ) { echo $output; }
			return;
		}

		// Get general border color value
		$border_general  	 		= isset($woo_options['woo_style_border']) ? $woo_options['woo_style_border'] : false;
		// General styling value
		$link 			 	 		= isset($woo_options['woo_link_color']) ? $woo_options['woo_link_color']: false;
		$hover 			 	 		= isset($woo_options['woo_link_hover_color']) ? $woo_options['woo_link_hover_color']: false;
		$button 		 	 		= isset($woo_options['woo_button_color']) ? $woo_options['woo_button_color']: false;
		$button_hover 	 	 		= isset($woo_options['woo_button_hover_color']) ? $woo_options['woo_button_hover_color']: false;
		// Boxed styling
		$boxed 			 	 		= isset($woo_options['woo_boxed_layout']) ? $woo_options['woo_boxed_layout']: false;
		$bg_color 		 	 		= isset($woo_options['woo_style_bg']) ? $woo_options['woo_style_bg']: false;
		$bg_image 		 	 		= isset($woo_options['woo_style_bg_image']) ? $woo_options['woo_style_bg_image']: false;
		$bg_image_repeat 	 		= isset($woo_options['woo_style_bg_image_repeat']) ? $woo_options['woo_style_bg_image_repeat']: false;
		$bg_image_pos 	 	 		= isset($woo_options['woo_style_bg_image_pos']) ? $woo_options['woo_style_bg_image_pos']: false;
		$bg_image_attach 	 		= isset($woo_options['woo_style_bg_image_attach']) ? $woo_options['woo_style_bg_image_attach']: false;
		$bg_image_size 	 			= isset($woo_options['woo_style_bg_image_size']) ? $woo_options['woo_style_bg_image_size']: false;
		$box_bg 		 	 		= isset($woo_options['woo_style_box_bg']) ? $woo_options['woo_style_box_bg']: false;
		$box_shadow 	 	 		= isset($woo_options['woo_box_shadow']) ? $woo_options['woo_box_shadow']: false;
		// Main navigation
		$nav_bg 					= isset($woo_options['woo_nav_bg']) ? $woo_options['woo_nav_bg']: false;
		$nav_hover 			 		= isset($woo_options['woo_nav_hover']) ? $woo_options['woo_nav_hover']: false;
		$nav_hover_bg 		 		= isset($woo_options['woo_nav_hover_bg']) ? $woo_options['woo_nav_hover_bg']: false;
		$nav_currentitem 	 		= isset($woo_options['woo_nav_currentitem']) ? $woo_options['woo_nav_currentitem']: false;
		$nav_currentitem_bg  		= isset($woo_options['woo_nav_currentitem_bg']) ? $woo_options['woo_nav_currentitem_bg']: false;
		// Divider border
		$nav_divider_border  		= isset($woo_options['woo_nav_divider_border']) ? $woo_options['woo_nav_divider_border']: false;
		$nav_div_border_width  		= isset($nav_divider_border['width']) ? $nav_divider_border['width']: false;
		$nav_div_border_style  		= isset($nav_divider_border['style']) ? $nav_divider_border['style']: false;
		$nav_div_border_color  		= isset($nav_divider_border['color']) ? $nav_divider_border['color']: false;
		// Dropdown border
		$nav_dropdown_border 		= isset($woo_options['woo_nav_dropdown_border']) ? $woo_options['woo_nav_dropdown_border']: false;
		$nav_dn_border_width		= isset($nav_dropdown_border['width']) ? $nav_dropdown_border['width']: false;
		$nav_dn_border_style		= isset($nav_dropdown_border['style']) ? $nav_dropdown_border['style']: false;
		$nav_dn_border_color		= isset($nav_dropdown_border['color']) ? $nav_dropdown_border['color']: false;
		// Border top
		$nav_border_top 	 		= isset($woo_options['woo_nav_border_top']) ? $woo_options['woo_nav_border_top']: false;
		$nav_border_top_width 		= isset($nav_border_top['width']) ? $nav_border_top['width']: false;
		$nav_border_top_style 		= isset($nav_border_top['style']) ? $nav_border_top['style']: false;
		$nav_border_top_color 		= isset($nav_border_top['color']) ? $nav_border_top['color']: false;
		// Border bottom
		$nav_border_bot 	 		= isset($woo_options['woo_nav_border_bot']) ? $woo_options['woo_nav_border_bot']: false;
		$nav_border_bot_width 		= isset($nav_border_bot['width']) ? $nav_border_bot['width']: false;
		$nav_border_bot_style 		= isset($nav_border_bot['style']) ? $nav_border_bot['style']: false;
		$nav_border_bot_color 		= isset($nav_border_bot['color']) ? $nav_border_bot['color']: false;
		// Top navigation
		$top_nav_border 	 		= isset($woo_options['woo_top_nav_border']) ? $woo_options['woo_top_nav_border']: false;
		$top_nav_border_bottom 		= isset($woo_options['woo_top_nav_border_bottom']) ? $woo_options['woo_top_nav_border_bottom']: false;
		$top_nav_bg 		 		= isset($woo_options['woo_top_nav_bg']) ? $woo_options['woo_top_nav_bg']: false;
		$top_nav_hover 		 		= isset($woo_options['woo_top_nav_hover']) ? $woo_options['woo_top_nav_hover']: false;
		$top_nav_hover_bg 	 		= isset($woo_options['woo_top_nav_hover_bg']) ? $woo_options['woo_top_nav_hover_bg']: false;
		$top_search 		 		= isset($woo_options['woo_top_search_bg']) ? $woo_options['woo_top_search_bg']: false;
		$nav_sub_bg 		 		= isset($woo_options['woo_nav_sub_bg']) ? $woo_options['woo_nav_sub_bg']: false;
		// Footer
		$footer_bg 			  		= isset($woo_options['woo_footer_bg']) ? $woo_options['woo_footer_bg']: false;
		// footer border top
		$footer_border_top 	  		= isset($woo_options['woo_footer_border_top']) ? $woo_options['woo_footer_border_top']: false;
		$footer_br_top_width  		= isset($footer_border_top['width']) ? $footer_border_top['width']: false;
		$footer_br_top_style  		= isset($footer_border_top['style']) ? $footer_border_top['style']: false;
		$footer_br_top_color  		= isset($footer_border_top['color']) ? $footer_border_top['color']: false;
		// footer border bottom
		$footer_border_bottom 		= isset($woo_options['woo_footer_border_bottom']) ? $woo_options['woo_footer_border_bottom']: false;
		$footer_br_bottom_width		= isset($footer_border_bottom['width']) ? $footer_border_bottom['width']: false;
		$footer_br_bottom_style		= isset($footer_border_bottom['style']) ? $footer_border_bottom['style']: false;
		$footer_br_bottom_color		= isset($footer_border_bottom['color']) ? $footer_border_bottom['color']: false;
		//Recipe style
		$recipe_icon_bg 			= isset($woo_options['woo_recipe_icon_bg']) ? $woo_options['woo_recipe_icon_bg']: false;
		$recipe_icon_hover_bg 		= isset($woo_options['woo_recipe_icon_hover_bg']) ? $woo_options['woo_recipe_icon_hover_bg']: false;
		$recipe_img_bottom 			= isset($woo_options['woo_recipe_img_border_bottom']) ? $woo_options['woo_recipe_img_border_bottom']: false;
		$recipe_img_bottom_single 	= isset($woo_options['woo_recipe_img_border_bottom_single']) ? $woo_options['woo_recipe_img_border_bottom_single']: false;

		// html background style
		$body .= $bg_color ? 'background-color:' . $bg_color . ';' : '';
		$body .= $bg_image ? 'background-image:url(' . $bg_image . ');' : '';
		$body .= $bg_image ? 'background-repeat:' . $bg_image_repeat . ';' : '';
		$body .= $bg_image ? 'background-position:' . $bg_image_pos . ';' : '';
		$body .= $bg_image ? 'background-attachment:' . $bg_image_attach . ';' : '';
		$body .= $bg_image ? 'background-size:' . $bg_image_size . ';' : '';


		// general border color output
		$output .= $border_general ? 'hr, .entry img, img.thumbnail, .entry .wp-caption,.page-template-template-blog-elegant-php .meta .meta-divider, .archive-elegant-post .meta .meta-divider, form:not(.searchform) .linked-more, .recipe-info-single-big, .woocommerce .product_meta, #footer-widgets, #comments, #comments .comment.thread-even, #respond h3.comment-reply-title, .info-extra, #comments ul.children li, .entry h1, .widget li, .type-post, #footer-widgets li, .recipe-menu-tab, .recipe-menu-tab a, .recipe-menu-tab a:hover, .recipe-tabMenu .ui-state-active a { border-color:' . $border_general . '}' : '';
		$output .= $border_general ? '.page-template-template-blog-elegant-php .meta .day, .archive-elegant-post .meta .day { color:' . $border_general . '}' : '';

		// Link color output
		$output .= $link ? '.recipe-menu-tab a:hover, .recipe-tabMenu .ui-state-active a, .nutritional p span, .info-bot li, .rate-box .status span, .nutritional p, .text-size, button.increase, button.decrease, .info-bot span, .prep-time li:last-child, .cook-time li:last-child, .yield li:last-child,a:link, a:visited, .widget ul li a, .post-more .sep { color:' . $link . '; }' : '';
		$output .= $link ? '.linked-more .show_hide { color:' . $link . ' !important; }' : '';
		$output .= $link ? '.linked-more { border-color:' . $link . '; }' : '';
		$output .= $hover ? 'button.increase:hover, button.decrease:hover, .extra a:hover, .menu-tab a:hover, .get-recipe a:hover,a:hover, .post-more a:hover, .post-meta a:hover, .post p.tags a:hover, .widget ul li a:hover, .post .title:hover a, .post-meta a:hover { color:' . $hover . '; }' : '';

		// Button color output
		$output .= $button ? 'body #top a.button,body #top a.button:visited,body #wrapper #content .button, body #wrapper #content .button:visited, body #wrapper #content .reply a, body #wrapper #content #respond .form-submit input#submit, .df-ajax-search, .searchform button {border: none; background:' . $button . '}' : '';
		$output .= $button_hover ? 'body #top a.button:hover,body #wrapper #content .button:hover, body #wrapper #content .reply a:hover, body #wrapper #content #respond .form-submit input#submit:hover, .df-ajax-search:hover, .searchform button:hover {border: none; background:' . $button_hover . '}' : '';

		// html background style output
		$output .= $boxed == 'true' && $body != '' ? 'html.boxed { background: none;' . $body . '}' : '';

		// boxed background style
		$wrapper   .= $boxed == 'true' && $box_bg ? 'background-color:' . $box_bg . ';' : '';
		$wrapper   .= $boxed == 'true' && $box_shadow == 'true' ? 'box-shadow: 0 0 1em 0 rgba(0,0,0,.3);-moz-box-shadow: 0px 1px 5px rgba(0,0,0,.3);-webkit-box-shadow: 0 0 1em 0 rgba(0,0,0,.3);' : '';
		$getrecipe .= $boxed == 'true' && $box_bg ? 'background-color:' . $box_bg . ';' : '';

		// boxed background style output
		$output .= $wrapper != '' && $getrecipe != '' ? 'html.boxed body {' . $wrapper . '}' : '';
		$output .= $wrapper != '' && $getrecipe != '' ? '.get-recipe a, .linked-more span {' . $getrecipe . '}' : '';

		// Navbar color hover output
	 	$output .= $nav_hover ? 'ul.nav li a:hover { color:' . $nav_hover . '!important; }' : '';
	 	$output .= $nav_hover_bg ? '#navigation ul.nav > li a:hover, #navigation ul.nav > li:hover { background-color:' . $nav_hover_bg . '!important; }' : '';

		// Submenu navbar style
		$output .= $nav_dropdown_border && $nav_dn_border_width >= 0 ? '@media only screen and ( min-width: 769px ) { #navigation ul.nav li ul { border: ' . $nav_dn_border_width . 'px ' . $nav_dn_border_style . ' ' . $nav_dn_border_color . '; } }' : '';
		$output .= $nav_dropdown_border && $nav_dn_border_width == 0 ? '#navigation ul.nav > li > ul { left: 0; }' : '';

		// Divider navbar style
		$output .= $nav_divider_border && $nav_div_border_width >= 0 ? '#navigation ul.nav > li  { border-right: ' . $nav_div_border_width . 'px ' . $nav_div_border_style . ' ' . $nav_div_border_color . '; }' : '';
		$output .= $nav_divider_border && $nav_div_border_width >= 0 ? '#navigation ul.nav > li:first-child { border-left: ' . $nav_div_border_width . 'px ' . $nav_div_border_style . ' ' . $nav_div_border_color . '; }' : '';
		$output .= $nav_divider_border && $nav_div_border_width == 0 ? '#navigation ul.nav > li > ul  { left: 0; }' : '';

		// Current item navbar background
		$output .= $nav_currentitem_bg ? '#navigation ul.nav li.current_page_item a, #navigation ul.nav li.current_page_parent a, #navigation ul.nav li.current-menu-ancestor a, #navigation ul.nav li.current-cat a, #navigation ul.nav li.current-menu-item a { background-color:' . $nav_currentitem_bg . '; }' : '';
		// Current item navbar link
	 	$output .= $nav_currentitem ? '#navigation ul.nav li.current_page_item > a, #navigation ul.nav li.current_page_parent > a, #navigation ul.nav li.current-menu-ancestor > a, #navigation ul.nav li.current-cat > a, #navigation ul.nav li.current-menu-item > a { color:' . $nav_currentitem . '!important; }' : '';

		// Navbar style output
	 	$navigation_css .= $nav_bg ? 'background:' . $nav_bg . ';' : '';
		$navigation_css .= ( $nav_border_top && $nav_border_top_width >= 0 ) ? 'border-top:' . $nav_border_top_width . 'px ' . $nav_border_top_style . ' ' . $nav_border_top_color . ';border-bottom:' . $nav_border_bot_width . 'px ' . $nav_border_bot_style . ' ' . $nav_border_bot_color . ';' : '';

		$output .= ( $nav_border_bot && $nav_border_bot_width == 0 ) ? '#navigation { box-shadow: none; -moz-box-shadow: none; -webkit-box-shadow: none; }' : '';
	 	$output .= ( $navigation_css != '' ) ? '#navigation {' . $navigation_css . '}' : '';

	 	// Topbar style output
		$output .= $top_nav_border ? '#top,  #top ul.cart li.container .widget { border-top:2px solid ' . $top_nav_border . ';}' : '';
		$output .= $top_nav_border_bottom ? '#top { border-bottom:1px solid ' . $top_nav_border_bottom . ';}' : '';
		$output .= $top_nav_bg ? '#top, #top ul.nav li ul li a:hover { background:' . $top_nav_bg . ';}' : '';
		$output .= $top_nav_hover ? '#top ul.nav li a:hover, #top ul.nav li.current_page_item a, #top ul.nav li.current_page_parent a,#top ul.nav li.current-menu-ancestor a,#top ul.nav li.current-cat a,#top ul.nav li.current-menu-item a,#top ul.nav li.sfHover, #top ul.nav li ul, #top ul.nav > li:hover a, #top ul.nav li ul li a, #top div.social-top a:hover, #top nav.account-links li a:hover { color:' . $top_nav_hover . '!important;}' : '';
		$output .= $top_nav_hover_bg ? '#top ul.nav li a:hover, #top ul.nav li.current_page_item a, #top ul.nav li.current_page_parent a,#top ul.nav li.current-menu-ancestor a,#top ul.nav li.current-cat a,#top ul.nav li.current-menu-item a,#top ul.nav li.sfHover, #top ul.nav li ul, #top ul.nav > li:hover { background:' . $top_nav_hover_bg . ';}' : '';
		$output .= $top_search ? '.df-ajax-search { background-color:' . $top_search . '; }' : '';
		$output .= $nav_sub_bg ? '@media only screen and ( min-width: 769px ) {	#navigation ul.nav li ul { background: '.$nav_sub_bg.'; } }' : '';

		$footer_wrap_css .= $footer_bg ? 'background-color:' . $footer_bg . ';' : '';
		$footer_wrap_css .= $footer_border_top ? 'border-top:' . $footer_br_top_width . 'px ' . $footer_br_top_style . ' ' . $footer_br_top_color . ';' : '';
		$footer_bottom_wrap_css .= $footer_border_bottom ? 'border-bottom:' . $footer_br_bottom_width . 'px ' . $footer_br_top_style . ' ' . $footer_br_bottom_color . ';' : '';

		// Footer border output
		$output .= ( $footer_wrap_css != '' ) ? '#footer-wrap {' . $footer_wrap_css . '}' : '';
		$output .= ( $footer_bottom_wrap_css != '' ) ? '#footer-wrap-bottom {' . $footer_bottom_wrap_css . '}' : '';

		// post type recipe
		$output .= $recipe_icon_bg ? '.fork em, .rating-single p,.rate-title p { background-color:' . $recipe_icon_bg . ';}' : '';
		$output .= $recipe_icon_bg ? '.prep-time em, .cook-time em, .yield em, .skill_level em, .info-bot li, .nutritional p span { color:' . $recipe_icon_bg . ';}' : '';
		$output .= $recipe_icon_hover_bg ? '.fork em:hover { background-color:' . $recipe_icon_hover_bg . ';}' : '';
		$output .= $recipe_img_bottom ? '.th-recipe, .th-recipe-list{ border-bottom:' . $recipe_img_bottom["width"] . 'px' . ' ' . $recipe_img_bottom["style"] . ' ' . $recipe_img_bottom["color"] . ';}' : '';
		$output .= $recipe_img_bottom ? '.rate-title ,.recipe-info-single-big{ border-bottom:' . $recipe_img_bottom_single["width"] . 'px' . ' ' . $recipe_img_bottom_single["style"] . ' ' . $recipe_img_bottom_single["color"] . ';}' : '';
		$output .= $recipe_img_bottom ? '.line-gold ,.recipe-info-single-big{ border-top:' . $recipe_img_bottom_single["width"] . 'px' . ' ' . $recipe_img_bottom_single["style"] . ' ' . $recipe_img_bottom_single["color"] . ';}' : '';

		//Shop style
		if( class_exists( 'woocommerce' ) ) {
			$shop_top_cart 	 = $woo_options['woo_shop_top_cart_bg'];
			$shop_img_bottom = $woo_options['woo_shop_img_border_bottom'];
			$shop_onsale 	 = $woo_options['woo_shop_onsale_bg'];

			$output .= $shop_top_cart ? '#top ul.cart li.container a.cart-contents:before { background:' . $shop_top_cart . ';}' : '';
			$output .= $shop_img_bottom ?'ul.products li.product img { border-bottom:' . $shop_img_bottom["width"] . 'px' . ' ' . $shop_img_bottom["style"] . ' ' . $shop_img_bottom["color"] . ';}' : '';
			$output .= $shop_onsale ? 'ul.products li.product .onsale, .single-product .onsale { background:' . $shop_onsale . ';}' : '';
		}

		// Output styles
		if ( isset( $output ) ) : echo $output;	endif;

	} // End woo_custom_styling()
}