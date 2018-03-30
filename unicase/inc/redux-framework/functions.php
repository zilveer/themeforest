<?php

#-----------------------------------------------------------------
# Setup
#-----------------------------------------------------------------

function redux_queue_font_awesome() {
    wp_register_style(
		'redux-font-awesome',
		get_template_directory_uri() . '/assets/css/font-awesome.min.css',
		array(),
		time(),
		'all'
    );
    wp_enqueue_style( 'redux-font-awesome' );
}

function redux_remove_demo_mode() { // Be sure to rename this function to something more unique
    remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
    remove_action( 'admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );
}

function redux_get_product_attr_taxonomies() {
	if( function_exists( 'unicase_get_product_attr_taxonomies' ) ) {
		return unicase_get_product_attr_taxonomies();
	}
}

#-----------------------------------------------------------------
# General
#-----------------------------------------------------------------

function redux_toggle_pace( $enable ) {
	global $unicase_options;

	if( isset( $unicase_options['enable_pace'] ) ) {
		if( $unicase_options['enable_pace'] == '1' ) {
			$enable = TRUE;
		} else {
			$enable = FALSE;
		}
	}

	return $enable;
}

function redux_toggle_scrollup( $enable ) {
	global $unicase_options;

	if( isset( $unicase_options['enable_scroll_to_top'] ) ) {
		if( $unicase_options['enable_scroll_to_top'] == '1' ) {
			$enable = TRUE;
		} else {
			$enable = FALSE;
		}
	}

	return $enable;
}

function redux_apply_layout_style( $layout_style ) {
	global $unicase_options;

	if( isset( $unicase_options['layout_style'] ) ) {
		$layout_style = $unicase_options['layout_style'];
	}

	return $layout_style;
}

#-----------------------------------------------------------------
# Header
#-----------------------------------------------------------------

function redux_apply_logo( $logo ) {
	global $unicase_options;

	if( !empty( $unicase_options['use_text_logo'] ) && $unicase_options['use_text_logo'] == '1' ) {
		$logo = '<span class="logo-text">' . $unicase_options['logo_text'] . '</span>';
	} else {
		if ( !empty( $unicase_options['site_logo']['url'] ) ) {
			$unicase_site_logo = $unicase_options['site_logo'];
			$logo = '<img alt="logo" src="' . esc_url( $unicase_site_logo['url'] ) . '" width="' . esc_attr( $unicase_site_logo['width'] ) . '" height="' . esc_attr( $unicase_site_logo['height'] ) . '"/>';
		}
	}

	return $logo;
}

function redux_apply_header_style( $header_style ) {
	global $unicase_options;

	if( !empty( $unicase_options['header_style'] ) ) {
		$header_style = $unicase_options['header_style'];
	}

	return $header_style;
}

function redux_toggle_sticky_header( $enable ) {
	global $unicase_options;

	if( isset( $unicase_options['sticky_header'] ) ) {
		if( $unicase_options['sticky_header'] == '1' ) {
			$enable = TRUE;
		} else {
			$enable = FALSE;
		}
	}

	return $enable;
}

function redux_apply_enable_live_search( $enable ) {
	global $unicase_options;

	if( isset( $unicase_options['live_search'] ) ) {
		if( $unicase_options['live_search'] == '1' ) {
			$enable = TRUE;
		} else {
			$enable = FALSE;
		}
	}

	return $enable;
}

function redux_apply_live_search_template( $live_search_template ) {
	global $unicase_options;

	if( ! empty( $unicase_options['live_search_template'] ) ) {
		$live_search_template = $unicase_options['live_search_template'];
	}

	return $live_search_template;
}

function redux_apply_live_search_empty_msg( $live_search_empty_msg ) {
	global $unicase_options;

	if( ! empty( $unicase_options['live_search_empty_msg'] ) ) {
		$live_search_empty_msg = $unicase_options['live_search_empty_msg'];
	}

	return $live_search_empty_msg;
}

function redux_apply_enable_search_categories( $enable ) {
	global $unicase_options;

	if( isset( $unicase_options['display_search_categories_filter'] ) ) {
		if( $unicase_options['display_search_categories_filter'] == '1' ) {
			$enable = TRUE;
		} else {
			$enable = FALSE;
		}
	}

	return $enable;
}

function redux_apply_search_categories_args( $args ) {
	global $unicase_options;

	if( isset( $unicase_options['header_search_dropdown'] ) && 'hsd0' === $unicase_options[ 'header_search_dropdown' ] ) {
		$args[ 'parent' ] = 0;
	}

	return $args;
}

function redux_apply_header_contact_info( $info ) {
	global $unicase_options;

	if ( isset( $unicase_options['header_support_phone'] ) || isset( $unicase_options['header_support_email'] ) ) :
		ob_start();
		?>
		<div class="contact-row">
			<?php if( !empty( $unicase_options['header_support_phone'] ) ) : ?>
				<div class="phone inline">
					<i class="fa fa-phone"></i> <?php echo esc_html( $unicase_options['header_support_phone'] ); ?>
				</div>
			<?php endif; ?>
			<?php if( !empty( $unicase_options['header_support_email'] ) ) : ?>
				<div class="contact inline">
					<i class="fa fa-envelope"></i> <?php echo esc_html( $unicase_options['header_support_email'] ); ?>
				</div>
			<?php endif; ?>
		</div><!-- /.contact-row -->
		<?php
		$info = ob_get_clean();
	endif;

	return $info;
}

function redux_apply_top_cart_text( $top_cart_text ) {
	global $unicase_options;

	if( !empty( $unicase_options['top_cart_text'] ) ) {
		$top_cart_text = $unicase_options['top_cart_text'];
	}

	return $top_cart_text;
}

function redux_apply_top_cart_dropdown_trigger( $cart_dropdown_trigger ) {
	global $unicase_options;

	if( !empty( $unicase_options['cart_dropdown_trigger'] ) ) {
		$cart_dropdown_trigger = $unicase_options['cart_dropdown_trigger'];
	}

	return $cart_dropdown_trigger;
}

function redux_apply_top_cart_dropdown_animation( $cart_dropdown_animation) {
	global $unicase_options;

	if( !empty( $unicase_options['cart_dropdown_animation'] ) ) {
		$cart_dropdown_animation = 'animated ' . $unicase_options['cart_dropdown_animation'];
	}

	return $cart_dropdown_animation;	
}

#-----------------------------------------------------------------
# Footer
#-----------------------------------------------------------------

function redux_apply_footer_bg( $additional_classes ) {
	global $unicase_options;

	if( !empty( $unicase_options['footer_style'] ) ) {
		$additional_classes = ' ' . $unicase_options['footer_style'];
	}

	return $additional_classes;
}

function redux_apply_footer_contact_info( $contact_info ) {
	global $unicase_options;

	if( isset( $unicase_options['footer_contact_info'] ) ) {
		$contact_info = $unicase_options['footer_contact_info'];
	}

	return $contact_info;
}

function redux_apply_copyright_text( $copyright_text ) {
	global $unicase_options;

	if( isset( $unicase_options['footer_credit'] ) ) {
		$copyright_text = $unicase_options['footer_credit'];
	}

	return $copyright_text;
}

function redux_apply_footer_logo() {
	global $unicase_options;

	if( !empty( $unicase_options['footer_credit_card_icons_gallery'] ) ) : 
	$credit_cart_icons = explode( ',', $unicase_options['footer_credit_card_icons_gallery'] ); ?>
    <div class="footer-payment-logo">
        <ul>
        	<?php foreach ( $credit_cart_icons as $credit_cart_icon ): ?>
        	<?php $credit_cart_image_atts = wp_get_attachment_image_src( $credit_cart_icon ); ?>
            <li><img src="<?php echo esc_attr( $credit_cart_image_atts[0] ); ?>" alt="" width="40" height="29"></li>
        	<?php endforeach; ?>
        </ul>
    </div><!-- /.payment-methods -->
    <?php
    endif; 
}

#-----------------------------------------------------------------
# Navigation
#-----------------------------------------------------------------

function redux_apply_dropdown_style( $nav_menu_class ) {
	global $unicase_options;

	if( isset( $unicase_options['primary_dropdown_style'] ) && $unicase_options['primary_dropdown_style'] == 'inverse') {
		$nav_menu_class = 'navbar-nav-inverse';		
	} else {
		$nav_menu_class = '';
	}

	return $nav_menu_class;
}

function redux_apply_dropdown_trigger( $trigger, $theme_location ) {
	global $unicase_options;

	if( isset( $unicase_options[$theme_location . '_dropdown_trigger'] ) ) {
		$trigger = $unicase_options[$theme_location . '_dropdown_trigger'];
	}

	return $trigger;
}

function redux_apply_dropdown_animation( $animation, $theme_location ) {
	global $unicase_options;

	if( isset( $unicase_options[$theme_location . '_dropdown_animation'] ) ) {
		$animation = 'animated ' . $unicase_options[$theme_location . '_dropdown_animation'];
	}

	return $animation;
}

function redux_toggle_dropdown_indicator( $show, $theme_location ) {
	global $unicase_options;

	if( isset( $unicase_options[$theme_location . '_show_dropdown_indicator'] ) ) {
		if( $unicase_options[$theme_location . '_show_dropdown_indicator'] ) {
			$show = TRUE;
		} else {
			$show = FALSE;
		}
	}

	return $show;
}

#-----------------------------------------------------------------
# Shop General
#-----------------------------------------------------------------

function redux_is_catalog_mode_disabled() {
	global $unicase_options;

	if( isset( $unicase_options['catalog_mode'] ) && $unicase_options['catalog_mode'] == '1' ) {
		$is_disabled = FALSE;
	} else {
		$is_disabled = TRUE;
	}

	return $is_disabled;
}

function redux_apply_catalog_mode_for_product_loop( $product_link, $product ) {
	global $unicase_options;

	if( ! redux_is_catalog_mode_disabled() ) {
		$product_link = sprintf( '<a href="%s" class="button product_type_%s">%s</a>',
			get_permalink( $product->ID ),
			esc_attr( $product->product_type ),
			apply_filters( 'unicase_catalog_mode_button_text', esc_html__( 'View Product', 'unicase' ) )
		);
	}

	return $product_link;
}

function redux_apply_product_brand_taxonomy( $brand_taxonomy ) {
	global $unicase_options;

	if( isset( $unicase_options['product_brand_taxonomy'] ) ) {
		$brand_taxonomy = $unicase_options['product_brand_taxonomy'];
	}

	return $brand_taxonomy;
}

function redux_toggle_footer_brands_carousel( $enable ) {
	global $unicase_options;

	if( isset( $unicase_options['enable_product_brands_carousel'] ) ) {
		if( $unicase_options['enable_product_brands_carousel'] == '1' ) {
			$enable = TRUE;
		} else {
			$enable = FALSE;
		}
	}

	return $enable;
}

function redux_apply_compare_page_url( $compare_page_url ) {
	global $unicase_options;

	if( isset( $unicase_options['product_comparison_page'] ) ) {
		$compare_page_id = $unicase_options['product_comparison_page'];

		if( function_exists( 'icl_object_id' ) ) {
			$compare_page_id = icl_object_id( $compare_page_id, 'page' );
		}

		$compare_page_url = get_permalink( $compare_page_id );
	}

	return $compare_page_url;
}

#-----------------------------------------------------------------
# Shop Catalog Pages
#-----------------------------------------------------------------

function redux_apply_shop_jumbotron( $static_block_id ) {
	global $unicase_options;

	if( isset( $unicase_options['shop_jumbotron'] ) ) {
		$static_block_id = $unicase_options['shop_jumbotron'];
	}

	return $static_block_id;
}

function redux_apply_shop_page_layout( $args ) {
	global $unicase_options;

	if( !empty( $unicase_options['shop_page_layout'] ) ) {

		if( $unicase_options['shop_page_layout'] == 'full-width' ) {
			
			$args['layout'] 				= 'layout-fullwidth';
			$args['layout_name'] 			= 'unicase-fullwidth';
			$args['content_area_classes']	= '';
			$args['sidebar_area_classes']	= '';

		} elseif ( $unicase_options['shop_page_layout'] == 'left-sidebar' ) {

			$args['layout'] 				= 'layout-sidebar';
			$args['layout_name'] 			= 'unicase-left-sidebar';
			$args['content_area_classes']	= 'col-sm-12 col-md-9 col-md-push-3 col-lg-9 col-lg-push-3';
			$args['sidebar_area_classes']	= 'col-sm-12 col-md-3 col-lg-3 col-md-pull-9 col-lg-pull-9';

		} elseif ( $unicase_options['shop_page_layout'] == 'right-sidebar' ) {

			$args['layout'] 				= 'layout-sidebar';
			$args['layout_name'] 			= 'unicase-right-sidebar';
			$args['content_area_classes']	= 'col-sm-12 col-md-9 col-lg-9';
			$args['sidebar_area_classes']	= 'col-sm-12 col-md-3 col-lg-3';

		}
	}

	return $args;
}

function redux_apply_loop_shop_columns() {
	global $unicase_options;
	return $unicase_options['product_columns'];
}

function redux_apply_products_per_page( $products_per_page ) {
	global $unicase_options;

	if( isset( $unicase_options['products_per_page'] ) ) {
		$products_per_page = $unicase_options['products_per_page'];
	}

	return $products_per_page;
}

function redux_apply_shop_view( $shop_view ) {
	global $unicase_options;

	if( isset( $unicase_options['remember_user_view'] ) && $unicase_options['remember_user_view'] && isset( $_COOKIE['user_shop_view'] ) ){
		$shop_view = $_COOKIE['user_shop_view'];
	} else {
		if( isset( $unicase_options['shop_default_view'] ) && !empty( $unicase_options['shop_default_view']) ) {
			$shop_view = $unicase_options['shop_default_view'];
		}
	}

	return $shop_view;
}

#-----------------------------------------------------------------
# Shop : Product Item Settings
#-----------------------------------------------------------------

function redux_apply_product_animation( $animation ) {
	global $unicase_options;

	if( isset( $unicase_options['product_item_animation'] ) && $unicase_options['product_item_animation'] != 'none' ) {
		$animation = $unicase_options['product_item_animation'];
	} else {
		$animation = '';
	}

	return $animation;
}

function redux_apply_product_animation_delay( $should_delay ) {
	global $unicase_options;

	if( isset( $unicase_options['should_product_animation_delay'] ) ) {
		$should_delay = $unicase_options['should_product_animation_delay'];
	}

	return $should_delay;
}

function redux_toggle_echo( $enable ) {
	global $unicase_options;

	if( isset( $unicase_options['enable_lazy_loading'] ) ) {
		$enable = $unicase_options['enable_lazy_loading'];
	}

	return $enable;
}

function redux_apply_enable_shop_quick_view( $enable ) {
	global $unicase_options;

	if( isset( $unicase_options['enable_quick_view'] ) ) {
		$enable = $unicase_options['enable_quick_view'];
	}

	return $enable;
}

#-----------------------------------------------------------------
# Shop : Single Product Settings
#-----------------------------------------------------------------

function redux_apply_product_single_style( $product_style ) {
	global $unicase_options;

	if( !empty( $unicase_options['shop_single_product_style'] ) ) {
		$product_style = $unicase_options['shop_single_product_style'];
	}

	return $product_style;
}

function redux_toggle_single_product_share( $show ) {
	global $unicase_options;

	if( isset( $unicase_options['enable_single_product_share'] ) ) {
		$show = $unicase_options['enable_single_product_share'];
	}

	return $show;
}

#-----------------------------------------------------------------
# BLOG
#-----------------------------------------------------------------

function redux_apply_blog_layout( $args ) {
	global $unicase_options;

	if( isset( $unicase_options['blog_layout'] ) ) {

		if( $unicase_options['blog_layout'] == 'full-width' ) {
			
			$args['layout'] 				= 'layout-fullwidth';
			$args['layout_name'] 			= 'unicase-fullwidth';
			$args['content_area_classes']	= '';
			$args['sidebar_area_classes']	= '';

		} elseif ( $unicase_options['blog_layout'] == 'left-sidebar' ) {

			$args['layout'] 				= 'layout-sidebar';
			$args['layout_name'] 			= 'unicase-left-sidebar';
			$args['content_area_classes']	= 'col-sm-12 col-md-9 col-md-push-3 col-lg-9 col-lg-push-3';
			$args['sidebar_area_classes']	= 'col-sm-12 col-md-3 col-lg-3 col-md-pull-9 col-lg-pull-9';

		} elseif ( $unicase_options['blog_layout'] == 'right-sidebar' ) {

			$args['layout'] 				= 'layout-sidebar';
			$args['layout_name'] 			= 'unicase-right-sidebar';
			$args['content_area_classes']	= 'col-lg-9 col-md-9 col-sm-12';
			$args['sidebar_area_classes']	= 'col-lg-3 col-md-3 col-sm-12';

		}
	}

	return $args;
}

function redux_toggle_force_excerpt( $force_excerpt ) {
	global $unicase_options;

	if( isset( $unicase_options['force_excerpt'] ) ) {
		$force_excerpt = $unicase_options['force_excerpt'];
	}

	return $force_excerpt;
}

function redux_toggle_post_placeholder_img( $enable_placeholder_img ) {
	global $unicase_options;

	if( isset( $unicase_options['post_placeholder_img'] ) ) {
		$enable_placeholder_img = $unicase_options['post_placeholder_img'];
	}

	return $enable_placeholder_img;
}

function redux_apply_post_item_animation( $post_classes ) {
	global $unicase_options;

	if( 'post' == get_post_type() && isset( $unicase_options['post_item_animation'] ) && $unicase_options['post_item_animation'] != 'none' ) {
		$post_classes[] = 'wow';
		$post_classes[] = $unicase_options['post_item_animation'];
	}

	return $post_classes;
}

function redux_toggle_single_post_share( $enable ) {
	global $unicase_options;

	if( isset( $unicase_options['enable_post_item_share'] ) ) {
		$enable = $unicase_options['enable_post_item_share'];
	}

	return $enable;
}

#-----------------------------------------------------------------
# Social Icons
#-----------------------------------------------------------------

function redux_apply_social_icons_url() {
	global $unicase_options;

	$social_icons = array(
		array(
		    'title'     => esc_html__('Facebook', 'unicase'),
		    'id'        => 'facebook',
		    'icon'      => 'fa fa-facebook',
		),

		array(
		    'title'     => esc_html__('Twitter', 'unicase'),
		    'id'        => 'twitter',
		    'icon'      => 'fa fa-twitter',
		),

		array(
		    'title'     => esc_html__('Google+', 'unicase'),
		    'id'        => 'google-plus',
		    'icon'      => 'fa fa-google-plus',
		),

		array(
		    'title'     => esc_html__('Pinterest', 'unicase'),
		    'id'        => 'pinterest',
		    'icon'      => 'fa fa-pinterest',
		),

		array(
		    'title'     => esc_html__('LinkedIn', 'unicase'),
		    'id'        => 'linkedin',
		    'icon'      => 'fa fa-linkedin',
		),

		array(
		    'title'     => esc_html__('RSS', 'unicase'),
		    'id'        => 'rss',
		    'icon'      => 'fa fa-rss',
		),

		array(
		    'title'     => esc_html__('Tumblr', 'unicase'),
		    'id'        => 'tumblr',
		    'icon'      => 'fa fa-tumblr',
		),

		array(
		    'title'     => esc_html__('Instagram', 'unicase'),
		    'id'        => 'instagram',
		    'icon'      => 'fa fa-instagram',
		),

		array(
		    'title'     => esc_html__('Youtube', 'unicase'),
		    'id'        => 'youtube',
		    'icon'      => 'fa fa-youtube',
		),

		array(
		    'title'     => esc_html__('Vimeo', 'unicase'),
		    'id'        => 'vimeo',
		    'icon'      => 'fa fa-vimeo-square',
		),

		array(
		    'title'     => esc_html__('Dribbble', 'unicase'),
		    'id'        => 'dribbble',
		    'icon'      => 'fa fa-dribbble',
		),

		array(
		    'title'     => esc_html__('Stumble Upon', 'unicase'),
		    'id'        => 'stumbleupon',
		    'icon'      => 'fa fa-stumpleupon',
		),

		array(
		    'title'     => esc_html__('Sound Cloud', 'unicase'),
		    'id'        => 'soundcloud',
		    'icon'      => 'fa fa-soundcloud',
		),

		array(
		    'title'     => esc_html__('Vine', 'unicase'),
		    'id'        => 'vine',
		    'icon'      => 'fa fa-vine',
		),

		array(
            'title'     => esc_html__('RSS', 'unicase'),
            'id'        => 'rss',
            'icon'      => 'fa fa-rss',
            'link'		=> get_bloginfo( 'rss2_url' )
        ),
	);

	foreach( $social_icons as $key => $social_icon ) {
		$option_key = $social_icon['id'];

		if( !empty( $unicase_options[$option_key] ) ) {
			$social_icons[$key]['link'] = $unicase_options[$option_key];
		}
	}

	return $social_icons;
}

#-----------------------------------------------------------------
# Styling
#-----------------------------------------------------------------

function redux_apply_primary_color() {
	global $unicase_options;

	if ( isset( $unicase_options['use_predefined_color'] ) && ( $unicase_options['use_predefined_color'] ) ) {
		$color = ( isset( $unicase_options['main_color'] ) ? $unicase_options['main_color'] : 'green' );
		return get_template_directory_uri() . '/assets/css/'.$color.'.css';
	} else {
		return get_template_directory_uri() . '/assets/css/custom-color.css';
	}
}

function redux_load_addtional_google_fonts( $fonts ) {
	global $unicase_options;

    if( isset( $unicase_options['unicase_display_style'] ) && $unicase_options['unicase_display_style'] == 'unicase-style-2' ) {
		/* translators: If there are characters in your language that are not supported by Fjalla One, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== esc_html_x( 'on', 'Fjalla+One font: on or off', 'unicase' ) ) {
			$fonts[] =  'Fjalla One';
		}
	}

    return $fonts;
}

function redux_apply_body_classes( $classes ) {
	global $unicase_options;

	if( isset( $unicase_options['unicase_display_style'] ) && $unicase_options['unicase_display_style'] == 'unicase-style-2' ) {
		$classes[]	= $unicase_options['unicase_display_style'];
	}

	return $classes;
}

#-----------------------------------------------------------------
# TYPOGRAPHY
#-----------------------------------------------------------------

function redux_has_google_fonts( $load_default ) {
	global $unicase_options;

	if( isset( $unicase_options['use_predefined_font'] ) ) {
		$load_default = $unicase_options['use_predefined_font'];
	}

	return $load_default;
}

function redux_apply_custom_fonts() {
	global $unicase_options;

	if( isset( $unicase_options['use_predefined_font'] ) && !$unicase_options['use_predefined_font'] ) :
		
		$title_font 			= $unicase_options['unicase_title_font'];
		$content_font			= $unicase_options['unicase_content_font'];
		$title_font_family 		= $title_font['font-family'];
		$title_font_weight		= $title_font['font-weight'];
		$content_font_family	= $content_font['font-family'];
		?>
		<style type="text/css">
			.navbar .navbar-collapse .nav-outer .navbar-nav > li > a,
			.terms-and-conditions h2 {
			    font-family: <?php echo esc_html( $content_font_family ); ?>;
			}

			.section-title,
	        .product h3.section-title,
	        .widget-area .widget ul.product_list_widget li a,
	        #comments h2.comments-title,
	        ol.comment-list .comment-meta,
	        .hentry .entry-header .entry-title,
	        .blog-post-author-details h5,
	        .widget-area .widget.widget_recent_reviews ul li span.reviewer,
	        .widget-area .widget.widget_wpt .inside .tab-content ul li .entry-title a{
				font-family: <?php echo esc_html( $content_font_family );?>;
			}

			h1, .h1,
			h2, .h2,
			h3, .h3,
			h4, .h4,
			h5, .h5,
			h6, .h6{
				font-family: <?php echo esc_html( $title_font_family );?> !important;
				font-weight: <?php echo esc_html( $title_font_weight );?> !important;
			}

			body {
				font-family: <?php echo esc_html( $content_font_family );?> !important;
			}

		</style>
		<?php
	elseif( isset( $unicase_options['unicase_display_style'] ) && $unicase_options['unicase_display_style'] == 'unicase-style-2' ) :
		?>
		<style type="text/css">
			h1, h2, h3, h4, h5, h6,
			.navbar .navbar-collapse .nav-outer >.navbar-nav > li > a,
	        ol.comment-list .comment-meta .comment-author.vcard,
	        ol.pings-list .comment-meta .comment-author.vcard,
	        .hentry .entry-header .entry-title,
	        .widget-area .widget.widget_recent_reviews ul li span.reviewer,
	        .widget-area .widget.widget_wpt .inside .tab-content ul li .entry-title a,
	        .top-cart-row .dropdown-cart .dropdown-trigger-cart .total-price-basket .cart-info,
	        .top-cart-row .dropdown-cart .dropdown-trigger-cart .total-price-basket .cart-info .label-name,
	        .widget_shopping_cart .dropdown-menu ul.product_list_widget li.mini_cart_item a,
	        .widget_shopping_cart .widget_shopping_cart_content ul.product_list_widget li.mini_cart_item a, 
	        .unicase-mini-cart .dropdown-menu ul.product_list_widget li.mini_cart_item a,
	        .unicase-mini-cart .widget_shopping_cart_content ul.product_list_widget li.mini_cart_item a,
	        .widget_shopping_cart .dropdown-menu p.total strong, 
	        .widget_shopping_cart .widget_shopping_cart_content p.total strong, 
	        .unicase-mini-cart .dropdown-menu p.total strong, 
	        .unicase-mini-cart .widget_shopping_cart_content p.total strong,
	        .vc_wp_custommenu .widget.widget_nav_menu > h3.widget-title,
	        .unicase-banner-wrapper h1, .unicase-banner-wrapper h2, .unicase-banner-wrapper h3,
	        .unicase-banner-wrapper h4, .unicase-banner-wrapper h5, 
	        footer .footer-top-widgets .opening-time .contact-number,
	        .widget-area .widget ul.product_list_widget li a .product-title,
	        .single-product .entry-summary .product_title,
	        .woocommerce-tabs .tabs > li > a,
	        .woocommerce .shop_table thead tr th,
	        .woocommerce .shop_table tbody tr td.product-name a,
	        .woocommerce .shop_table .amount,
	        .cart-collaterals .panel .panel-heading .panel-title,
	        .cart_totals table tbody tr th,
	        .cart_totals table tbody tr td .amount,
	        .woocommerce-checkout .entry-content .woocommerce .woocommerce-info,
	        .woocommerce-checkout .panel .panel-heading .panel-title,
	        .woocommerce-checkout .entry-content .woocommerce-checkout .woocommerce-shipping-fields #ship-to-different-address label,
	        .woocommerce .shop_table tbody tr td.product-name,
	        .wishlist_table .yith-wcwl-share .yith-wcwl-share-title,
	        .faq .faq-row .item .vc_tta-panel-heading .vc_tta-panel-title,
	        .widget-area .widget.widget_rss li a.rsswidget, 
	        .vc_wp_custommenu .widget.widget_rss li a.rsswidget,
	        #respond .comment-reply-title,
	        .woocommerce-cart .woocommerce .cart-empty {
				font-family: 'Fjalla One' !important;
				font-weight: 400 !important;
			}
		</style>
		<?php
	endif;
}

#-----------------------------------------------------------------
# CUSTOM CODE
#-----------------------------------------------------------------

function redux_apply_custom_css() {
	global $unicase_options;

	if( isset( $unicase_options['custom_css'] ) && trim( $unicase_options['custom_css'] ) != '' ) :
	?>
	<style type="text/css">
	<?php echo $unicase_options['custom_css']; ?>
	</style>
	<?php
	endif;
}