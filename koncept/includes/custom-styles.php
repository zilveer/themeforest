<?php 
/**
 * This file contains the output of the WordPress Theme Customizer (frontend)
 */

if( ! function_exists( 'krown_custom_css' ) ) {

	function krown_custom_css() {

		// Get Options

		$f_head = is_serialized( get_option('krown_type_heading' ) ) ? unserialize( get_option('krown_type_heading' ) ) : array( 'default' => true, 'font-family' => '"Helvetica Neue", Helvetica, Arial, sans-serif' );
		$f_body = is_serialized( get_option( 'krown_type_body' ) ) ? unserialize( get_option( 'krown_type_body' ) ) : array( 'default' => true, 'font-family' => '"Helvetica Neue", Helvetica, Arial, sans-serif' );
		$f_quote = is_serialized( get_option( 'krown_type_quotes' ) ) ? unserialize( get_option( 'krown_type_quotes' ) ) : array( 'default' => true, 'font-family' => '"Helvetica Neue", Helvetica, Arial, sans-serif' );
		
		$colors = get_option( 'krown_colors' );

		$protocol = is_ssl() ? 'https' : 'http';

		// Enequeue Google Fonts

		// - subsets

		$load_sets = false;
		$sets = '';

		if ( get_option('krown_type_sets_cyrillic') == '1' ) {
			$load_sets = true;
			$sets .= 'cyrillic,';
		}
		if ( get_option('krown_type_sets_cyrillic-extended') == '1' ) {
			$load_sets = true;
			$sets .= 'cyrillic-ext,';
		}
		if ( get_option('krown_type_sets_devenagari') == '1' ) {
			$load_sets = true;
			$sets .= 'devenagari,';
		}
		if ( get_option('krown_type_sets_greek') == '1' ) {
			$load_sets = true;
			$sets .= 'greek,';
		}
		if ( get_option('krown_type_sets_greek-extended') == '1' ) {
			$load_sets = true;
			$sets .= 'greek-ext,';
		}
		if ( get_option('krown_type_sets_khmer') == '1' ) {
			$load_sets = true;
			$sets .= 'khmer,';
		}
		if ( get_option('krown_type_sets_latin') == '1' ) {
			$load_sets = true;
			$sets .= 'latin,';
		}
		if ( get_option('krown_type_sets_latin-extended') == '1' ) {
			$load_sets = true;
			$sets .= 'latin-ext,';
		}
		if ( get_option('krown_type_sets_vietnamese') == '1' ) {
			$load_sets = true;
			$sets .= 'vietnamese,';
		}

		if ( $load_sets) { 
			$sets = '&subset=' . rtrim( $sets, "," );
		}

		// - actual font load

		if ( ! isset( $f_head['default'] ) ) {
			wp_enqueue_style( 'krown-font-head', "$protocol://fonts.googleapis.com/css?family=" . $f_head['css-name'] . ":300,400,400italic,500,600,700,700,800" . $sets );
		}

		if ( $f_body != $f_head && ! isset( $f_body['default'] ) ) {
			wp_enqueue_style( 'krown-font-body', "$protocol://fonts.googleapis.com/css?family=" . $f_body['css-name'] . ":300,400,400italic,500,600,700,700,800" . $sets );
		}

		if ( $f_body != $f_quote && $f_head != $f_quote && ! isset( $f_quote['default'] ) ) {
			wp_enqueue_style( 'krown-font-quote', "$protocol://fonts.googleapis.com/css?family=" . $f_quote['css-name'] . ":300,300italic,400,400italic" . $sets );
		}


		// Create Custom CSS

		$custom_css = '

			/* CUSTOM FONTS */

			h1, h2, h3, h4, h5, h6, #portfolio.show-category .item .caption span, #main-menu, input[type="submit"], a.checkout-button, .post-meta, .post-time, .pagination, .woocommerce-pagination, #filter, .woocommerce .price, #filter-opener .count, .single-product .cart .input-text, .product-quantity .input-text, .amount {
			  font-family: ' . $f_head['font-family'] . ';
			}

			body, input, textarea, button, blockquote .cite, blockquote cite, #lang_sel {
			  font-family: ' . $f_body['font-family'] . ';
			}

			#portfolio.show-excerpt .item .caption span, .krown-section-title.large h5, blockquote.alternate {
				font-family: ' . $f_quote['font-family'] . ';
			}

			/* CUSTOM COLORS */

			a, .no-touch #main-search #searchform .fa-search:hover, #main-menu a:hover, .post-header a:hover, .comment-title a:hover, .comment-reply-link:hover, .widget ul a:hover, #filter li a.selected, .single-product .product_meta a:hover, #lang_sel_footer ul li a:hover, #posts-container.classic .post a:hover h2, #posts-container.classic .post-meta a:hover {
				color: ' . $colors['main1'] . ';
			}
			#main-menu a:hover, #menu-closer .krown-svg, .menu-three #menu-closer:hover .krown-svg, #menu-opener:hover .krown-svg, #filter-opener:hover .krown-svg, #filter-opener.opened, #main-menu a:hover .krown-svg {
				fill: ' . $colors['main1'] . ';
			}
			.krown-button.light:hover, .krown-button.dark:hover, .krown-button.color, .fancybox-nav span:hover, .fancybox-close:hover, input[type="submit"]:hover, a.checkout-button:hover, .mejs-controls .mejs-time-rail .mejs-time-current, .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current, .mejs-controls .mejs-volume-button .mejs-volume-slider .mejs-volume-current, .mejs-overlay:hover .mejs-overlay-button, .star-rating .star, .star-rating .half-star, .comment-form-rating a.star, .single-product .cart .button:hover, .product-quantity .button:hover, .checkout-button.button, .single-product .cart .button:hover, .product-quantity .button:hover, .woocommerce-message .button:hover, .woocommerce-error .button:hover, .woocommerce-info .button:hover, .update-button:hover {
				background-color: ' . $colors['main1'] . ';
			}

			.pagination a:hover, .woocommerce-pagination a:hover, .krown-social i:before, .krown-tour .flex-direction-nav a:hover, #footer .krown-social a:hover i:before, #main-menu li.selected > a, .post-nav a:hover, .price_slider_amount .button:hover, .ie8 a:hover:before {
				color: ' . $colors['main2'] . ';
			}
			.tparrows.custom:hover:before {
				color: ' . $colors['main2'] . ' !important;
			}
			#main-menu li.selected .krown-svg, .post-nav a:hover .krown-svg {
				fill: ' . $colors['main2'] . ';
			}	
			.pagination a:hover, .woocommerce-pagination a:hover, .ui-slider-horizontal .ui-slider-handle:hover {
				border-color: ' . $colors['main2'] . ';
			}
			.flex-control-nav li a.flex-active, .tp-bullets.simplebullets.round .bullet.selected {
				background-color: ' . $colors['main2'] . ';
			}

			/* CUSTOM CSS */

		';

		$custom_css .= ot_get_option( 'krown_custom_css', '' );

		// Embed Custom CSS

		wp_add_inline_style( 'krown-style', $custom_css );

	}

}

add_action( 'wp_enqueue_scripts', 'krown_custom_css', 101 );


?>