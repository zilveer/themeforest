<?php
/**
 * Layout functions used in the theme
 *
 * @package unicase
 */

if( ! function_exists( 'unicase_get_page_layout_args' ) ) {
	/**
	 * Gets Page Layout for various pages used in the theme
	 * 
	 * @since v1.0.0
	 */
	function unicase_get_page_layout_args() {

		$args = array(
			'layout'				=> 'layout-sidebar',
			'page_name'				=> '',
			'site_content_classes'	=> '',
			'container_classes'		=> 'container inner-top-vs inner-bottom-sm ',
			'content_area_classes'	=> 'col-lg-9 col-md-9 col-sm-12',
			'sidebar_area_classes'	=> 'col-lg-3 col-md-3 col-sm-12',
		);
		
		$page_layout = 'full-width';
		$page_name = '';
		$wishlist_page_id = get_option( 'yith_wcwl_wishlist_page_id' );

		if( is_woocommerce_activated() && is_woocommerce() ) {
			
			if( is_product() ) {
				
				$style = unicase_single_product_style();
				
				$args = array(
					'layout' 				=> 'layout-sidebar',
					'page_name'				=> 'woocommerce-single-product',
					'site_content_classes'	=> '',
					'container_classes'		=> 'container inner-xs ',
					'content_area_classes'	=> 'col-sm-12 col-md-12 col-lg-9 col-lg-push-3',
					'sidebar_area_classes'	=> 'col-sm-12 col-md-12 col-lg-3 col-lg-pull-9',
					'site_main_classes'		=> $style,
				);

			} else if( is_shop() ) {

				$args = array(
					'layout'				=> 'layout-sidebar',
					'page_name'				=> 'shop-page',
					'site_content_classes'	=> '',
					'container_classes'		=> 'container inner-xs ',
					'content_area_classes'	=> 'col-sm-12 col-md-9 col-md-push-3 col-lg-9 col-lg-push-3',
					'sidebar_area_classes'	=> 'col-sm-12 col-md-3 col-lg-3 col-md-pull-9 col-lg-pull-9',
					'site_main_classes'		=> '',
					'has_jumbotron'			=> true,
					'products_per_row'		=> 3,
				);

				$static_block_id = apply_filters( 'unicase_shop_jumbotron_id', '' );

				if( ! empty( $static_block_id ) ) {
					$static_block = get_post( $static_block_id );
					remove_filter( 'the_content', 'wptexturize' );
					$jumbotron = apply_filters( 'the_content' , $static_block->post_content );
					add_filter( 'the_content', 'wptexturize' );

					$args['shop_jumbotron'] = str_replace( 'wpb_row', '', $jumbotron );
					$args['has_jumbotron'] = TRUE;
				}

			} else if ( is_product_category() || is_tax( 'product_label' ) ) {

				$args = array(
					'layout'				=> 'layout-sidebar',
					'page_name'				=> 'product-category-page',
					'site_content_classes'	=> '',
					'container_classes'		=> 'container inner-xs ',
					'content_area_classes'	=> 'col-sm-12 col-md-9 col-md-push-3 col-lg-9 col-lg-push-3',
					'sidebar_area_classes'	=> 'col-sm-12 col-md-3 col-lg-3 col-md-pull-9 col-lg-pull-9',
					'site_main_classes'		=> '',
					'has_jumbotron'			=> true,
					'products_per_row'		=> 3,
				);

				$term 				= get_term_by( 'slug', get_query_var('term'), get_query_var('taxonomy') );
				$term_id 			= $term->term_id;
				$static_block_id 	= get_woocommerce_term_meta( $term_id, 'static_block_id', true );

				if( !empty( $static_block_id ) ) {
					$static_block = get_post( $static_block_id );
					remove_filter( 'the_content', 'wptexturize' );
					$jumbotron = apply_filters( 'the_content' , $static_block->post_content );
					add_filter( 'the_content', 'wptexturize' );

					$args['shop_jumbotron'] = str_replace( 'wpb_row', '', $jumbotron );
					$args['has_jumbotron'] = TRUE;
				}

			}

		} else if( is_woocommerce_activated() && is_cart() ) {
			
			$args = array(
				'layout'	 			=> 'layout-fullwidth',
				'page_name'				=> 'woocommerce-cart',
				'site_content_classes'	=> '',
				'container_classes'		=> 'container inner-top-vs inner-bottom-vsm',
				'content_area_classes'	=> '',
				'sidebar_area_classes'	=> '',
			);
		
		} else if( is_woocommerce_activated() && is_checkout() ) {
			
			$args = array(
				'layout'	 			=> 'layout-fullwidth',
				'page_name'				=> 'woocommerce-checkout',
				'site_content_classes'	=> '',
				'container_classes'		=> 'container inner-top-vs inner-bottom-sm',
				'content_area_classes'	=> '',
				'sidebar_area_classes'	=> '',
			);
		
		} else if( is_woocommerce_activated() && is_account_page() ) {

			if( !is_user_logged_in() ) {

				$args = array(
					'layout'				=> 'layout-fullwidth',
					'layout_name'			=> 'unicase-fullwidth',
					'page_name'				=> 'woocommerce-account',
					'container_classes'		=> 'container inner-top-vs inner-bottom-sm',
				);

				if( is_wc_endpoint_url( 'lost-password' ) ) {

					$args = array(
						'layout'				=> 'layout-fullwidth',
						'layout_name'			=> 'unicase-fullwidth',
						'page_name'				=> 'woocommerce-account',
						'container_classes'		=> 'container inner-top-vs inner-bottom-sm',
					);
				}

			} else {

				$args = array(
					'layout'				=> 'layout-fullwidth',
					'layout_name'			=> 'unicase-fullwidth',
					'page_name'				=> 'woocommerce-account',
					'container_classes'		=> 'container inner-top-vs inner-bottom-sm',
				);
			}

		} else if( is_single() ) {

			$args = array(
				'layout'				=> 'layout-sidebar',
				'page_name'				=> 'blog-single',
				'site_content_classes'	=> '',
				'container_classes'		=> 'container inner-vs',
				'content_area_classes'	=> 'col-lg-9 col-md-9 col-sm-12',
				'sidebar_area_classes'	=> 'col-lg-3 col-md-3 col-sm-12',
			);

		} else if( !empty( $wishlist_page_id ) && is_page( $wishlist_page_id ) ) {
			
			$args = array(
				'layout'				=> 'layout-fullwidth',
				'page_name'				=> '',
				'site_content_classes'	=> '',
				'container_classes'		=> 'container inner-top-vs inner-bottom-sm ',
				'content_area_classes'	=> '',
				'sidebar_area_classes'	=> '',
				'show_page_header'		=> FALSE,
			);

		} else if( is_page() ) {

			global $post;
			$page_meta_values = get_post_meta( $post->ID, '_unicase_page_metabox', true );

			$show_page_header = TRUE;
			$should_wrap_page = TRUE;
			$show_breadcrumb  = TRUE;

			if( isset( $page_meta_values['hide_page_title'] ) && $page_meta_values['hide_page_title'] == '1' ) {
				$show_page_header = FALSE;
			}

			if( isset( $page_meta_values['hide_breadcrumb'] ) && $page_meta_values['hide_breadcrumb'] == '1' ) {
				$show_breadcrumb = FALSE;
			}

			$container_classes = isset( $page_meta_values['container_classses'] ) ? $page_meta_values['container_classses'] : '';
			if( isset( $page_meta_values['do_not_wrap_page'] ) && $page_meta_values['do_not_wrap_page'] == '1' ) {
				$container_classes = 'uncontainer ' . $container_classes;
			} else {
				$container_classes = 'container ' . $container_classes;
			}

			$site_content_classes 	= isset( $page_meta_values['site_content_classes'] ) ? $page_meta_values['site_content_classes'] : '';
			$content_area_classes 	= isset( $page_meta_values['content_area_classes'] ) ? $page_meta_values['content_area_classes'] : '';
			$sidebar_area_classes 	= isset( $page_meta_values['sidebar_area_classes'] ) ? $page_meta_values['sidebar_area_classes'] : '';
			$header_classes 		= isset( $page_meta_values['header_classes'] ) ? $page_meta_values['header_classes'] : '';
			$body_classes 			= isset( $page_meta_values['body_classes'] ) ? $page_meta_values['body_classes'] : '';
			$static_block_id 		= isset( $page_meta_values['header_content_static_block_ID'] ) ? $page_meta_values['header_content_static_block_ID'] : '';
			$footer_classes 		= isset( $page_meta_values['footer_classes'] ) ? $page_meta_values['footer_classes'] : '';

			$args = array(
				'layout'				=> 'layout-fullwidth',
				'layout_name'			=> 'unicase-fullwidth',
				'show_page_header'		=> $show_page_header,
				'show_breadcrumb'		=> $show_breadcrumb,
				'container_classes'		=> $container_classes,
				'site_content_classes'	=> $site_content_classes,
				'content_area_classes'	=> $content_area_classes,
				'sidebar_area_classes'	=> $sidebar_area_classes,
				'header_classes'		=> $header_classes,
				'body_classes'			=> $body_classes,
				'footer_classes'		=> $footer_classes,
			);

			if( isset( $page_meta_values['enable_sidebar'] ) && $page_meta_values['enable_sidebar'] == '1' ) {
				$args['layout'] = 'layout-sidebar';
				$args['layout_name'] = 'unicase-left-sidebar';
				$args['content_area_classes'] .= ' col-sm-12 col-md-9 col-md-push-3 col-lg-9 col-lg-push-3';
				$args['sidebar_area_classes'] .= ' col-sm-12 col-md-3 col-lg-3 col-md-pull-9 col-lg-pull-9';
			}

			if( isset( $page_meta_values['page_sidebar'] ) && $page_meta_values['page_sidebar'] == '1' ) {
				$args['sidebar'] = 'page';
			}

			if( !empty( $static_block_id ) ) {
				$static_block = get_post( $static_block_id );
				
				if( $static_block ) {
					remove_filter( 'the_content', 'wptexturize' );
					$jumbotron = apply_filters( 'the_content' , $static_block->post_content );
					add_filter( 'the_content', 'wptexturize' );

					$args['jumbotron'] = str_replace( 'wpb_row', '', $jumbotron );
					$args['has_jumbotron'] = TRUE;
				}
			}

			if ( is_front_page() ) {
				// static homepage
				$args['body_class'] = 'frontpage';
				$args['container_classes'] .= ' inner-top-xs inner-bottom-vsm';
			} else {
				// other pages
				$args['container_classes'] .= ' inner-top-vs inner-bottom-sm';
			}

		} else {
				
			if ( is_front_page() && is_home() ) {
		  		// Default homepage which is also Blog page
				$args = array(
					'layout'				=> 'layout-sidebar',
					'page_name'				=> 'blog-page',
					'site_content_classes'	=> '',
					'container_classes'		=> 'container inner-top-vs',
					'content_area_classes'	=> 'col-lg-9 col-md-9 col-sm-12',
					'sidebar_area_classes'	=> 'col-lg-3 col-md-3 col-sm-12',
					'site_main_classes'		=> 'site-main-blog',
				);

			} else if ( is_home() ) {
			  	
			  	// blog page
				$args = array(
					'layout'				=> 'layout-sidebar',
					'page_name'				=> 'blog-page',
					'site_content_classes'	=> '',
					'container_classes'		=> 'container inner-top-vs inner-bottom-sm ',
					'content_area_classes'	=> 'col-lg-9 col-md-9 col-sm-12',
					'sidebar_area_classes'	=> 'col-lg-3 col-md-3 col-sm-12',
				);

			}
		}

		if( isset( $args['page_name'] ) ) {
			$page_name = $args['page_name'];
		}

		return apply_filters( 'unicase_page_layout_args_' . $page_name , $args );
	}
}

if( ! function_exists( 'unicase_apply_site_content_classes' ) ) {
	function unicase_apply_site_content_classes( $site_content_class ) {

		$layout_args = unicase_get_page_layout_args();

		if( ! empty( $layout_args['site_content_classes'] ) ) {
			$site_content_class .= ' ' . $layout_args['site_content_classes']; // additional space
		}

		return $site_content_class;
	}
}

if( ! function_exists( 'unicase_apply_container_classes' ) ) {
	function unicase_apply_container_classes( $container_classes ) {

		$layout_args = unicase_get_page_layout_args();

		if( ! empty( $layout_args['container_classes'] ) ) {
			$container_classes = $layout_args['container_classes'];
		}

		return $container_classes;
	}
}

if( ! function_exists( 'unicase_apply_content_area_classes' ) ) {
	function unicase_apply_content_area_classes( $content_area_classes ) {

		$layout_args = unicase_get_page_layout_args();

		if( ! empty( $layout_args['content_area_classes'] ) ) {
			$content_area_classes .= ' ' . $layout_args['content_area_classes']; // additional space
		}

		return $content_area_classes;
	}
}

if( ! function_exists( 'unicase_apply_sidebar_area_classes' ) ) {
	function unicase_apply_sidebar_area_classes( $sidebar_area_classes ) {

		$layout_args = unicase_get_page_layout_args();

		if( ! empty( $layout_args['sidebar_area_classes'] ) ) {
			$sidebar_area_classes .= ' ' . $layout_args['sidebar_area_classes']; // additional space
		}

		return $sidebar_area_classes;
	}
}

if( ! function_exists( 'unicase_apply_site_main_classes' ) ) {
	function unicase_apply_site_main_classes( $site_main_classes ) {

		$layout_args = unicase_get_page_layout_args();

		if( ! empty( $layout_args['site_main_classes'] ) ) {
			$site_main_classes .= ' ' . $layout_args['site_main_classes']; // additional space
		}

		return $site_main_classes;
	}
}

if( ! function_exists( 'unicase_hook_jumbotron' ) ) {
	function unicase_hook_jumbotron() {
		
		$layout_args = unicase_get_page_layout_args();

		if( ! empty( $layout_args['jumbotron'] ) ) {
			echo wp_kses_post( $layout_args['jumbotron'] );
		}
	}
}

if( ! function_exists( 'unicase_toggle_page_header' ) ) {
	function unicase_toggle_page_header() {

		$layout_args = unicase_get_page_layout_args();

		if( isset( $layout_args['show_page_header'] ) ) {
			return $layout_args['show_page_header'];
		}

		return true;
	}
}

if( ! function_exists( 'unicase_toggle_breadcrumb' ) ) {
	function unicase_toggle_breadcrumb() {

		$layout_args = unicase_get_page_layout_args();

		if( isset( $layout_args['show_breadcrumb'] ) ) {
			return $layout_args['show_breadcrumb'];
		}

		return true;
	}
}
