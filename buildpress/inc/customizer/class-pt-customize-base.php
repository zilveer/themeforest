<?php
/**
 * Contains methods for customizing the theme customization screen.
 *
 * @package BuildPress
 * @link http://codex.wordpress.org/Theme_Customization_API
 */

class BuildPress_Customizer_Base {
	/**
	 * The singleton manager instance
	 *
	 * @see wp-includes/class-wp-customize-manager.php
	 * @var WP_Customize_Manager
	 */
	protected $wp_customize;

	public function __construct( WP_Customize_Manager $wp_manager ) {
		// set the private propery to instance of wp_manager
		$this->wp_customize = $wp_manager;

		// register the settings/panels/sections/controls, main method
		$this->register();

		/**
		 * Action and filters
		 */

		// render the CSS and cache it to the theme_mod when the setting is saved
		add_action( 'customize_save_after' , array( $this, 'cache_rendered_css' ) );

		// save logo width/height dimensions
		add_action( 'customize_save_logo_img' , array( $this, 'save_logo_dimensions' ), 10, 1 );

		// flush the rewrite rules after the customizer settings are saved
		add_action( 'customize_save_after', 'flush_rewrite_rules' );

		// handle the postMessage transfer method with some dynamically generated JS in the footer of the theme
		add_action( 'wp_footer', array( $this, 'customize_footer_js' ), 30 );
	}

	/**
	* This hooks into 'customize_register' (available as of WP 3.4) and allows
	* you to add new sections and controls to the Theme Customize screen.
	*
	* Note: To enable instant preview, we have to actually write a bit of custom
	* javascript. See live_preview() for more.
	*
	* @see add_action('customize_register',$func)
	*/
	public function register () {
		/**
		 * Settings
		 */

		// branding
		$this->wp_customize->add_setting( 'logo_img', array( 'default' => get_template_directory_uri() . '/assets/images/logo.png' ) );
		$this->wp_customize->add_setting( 'logo2x_img' );

		// header and breadcrumbs
		$this->wp_customize->add_setting( 'top_bar_visibility', array( 'default' => 'yes' ) );
		$this->wp_customize->add_setting( new BuildPress_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'top_bar_bg', array(
			'default' => '#333333',
			'css_map' => array(
				'background|linear_gradient_to_bottom(3)' => array(
					'.top',
				),
				'border-bottom-color|lighten(10)' => array(
					'.top',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new BuildPress_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'top_bar_color', array(
			'default' => '#999999',
			'css_map' => array(
				'color' => array(
					'.top',
					'.top a',
					'.navigation--top > .menu-item-has-children > a::after',
				),
			)
		) ) );

		$this->wp_customize->add_setting( new BuildPress_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'header_bg', array(
			'default' => '#454545',
			'css_map' => array(
				'background-color' => array(
					'.header',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new BuildPress_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'header_bg_img', array(
			'css_map' => array(
				'background-image|url' => array(
					'.header',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new BuildPress_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'header_text_color', array(
			'default' => '#dddddd',
			'css_map' => array(
				'color' => array(
					'.icon-box__title',
					'.widget-icon-box .icon-box:hover .fa',
				),
				'color|darken(27)' => array (
					'.icon-box__subtitle',
					'.widget-icon-box .icon-box',
					'.textwidget',
				),
			)
		) ) );

		// navigation
		$this->wp_customize->add_setting( 'main_navigation_sticky', array( 'default' => 'static' ) );
		$this->wp_customize->add_setting( new BuildPress_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'main_navigation_bg', array(
			'default' => '#ffffff',
			'css_map' => array(
				'background|linear_gradient_to_bottom(7)' => array(
					'.navigation|@media (min-width: 992px)',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new BuildPress_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'main_navigation_color_mobile', array(
			'default' => '#dddddd',
			'css_map' => array(
				'color' => array(
					'.navigation--main > li > a',
					'.navigation--main > .menu-item-has-children > a::after',
					'.navigation--main .sub-menu > li > a',
				),
				'color|lighten(13)' => array(
					'.navigation--main > li:hover > a',
					'.navigation--main > .menu-item-has-children:hover > a::after',
					'.navigation--main .sub-menu > li:hover > a',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new BuildPress_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'main_navigation_color', array(
			'default' => '#999999',
			'css_map' => array(
				'color' => array(
					'.navigation--main > li > a|@media (min-width: 992px)',
					'.navigation--main > .menu-item-has-children > a::after|@media (min-width: 992px)',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new BuildPress_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'main_navigation_color_hover', array(
			'default' => '#333333',
			'css_map' => array(
				'color' => array(
					'.navigation--main > li:hover > a|@media (min-width: 992px)',
					'.navigation--main > .menu-item-has-children:hover > a::after|@media (min-width: 992px)',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new BuildPress_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'main_navigation_sub_color', array(
			'default' => '#333333',
			'css_map' => array(
				'color' => array(
					'.navigation--main .sub-menu > li > a|@media (min-width: 992px)',
					'.navigation--main .sub-menu > li > a:hover|@media (min-width: 992px)',
					'.navigation--main .sub-menu > .menu-item-has-children > a::after|@media (min-width: 992px)',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new BuildPress_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'main_title_bg_color', array(
			'default' => '#f2f2f2',
			'css_map' => array(
				'background-color' => array(
					'.main-title',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new BuildPress_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'main_title_bg_img', array(
			'default' => '%s/assets/images/title-area-pattern.png',
			'css_map' => array(
				'background-image|url' => array(
					'.main-title',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new BuildPress_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'main_title_color', array(
			'default' => '#333333',
			'css_map' => array(
				'color' => array(
					'.main-title h1',
				),
			)
		) ) );
		$this->wp_customize->add_setting( 'main_title_mode', array( 'default' => 'big-title-area' ) );
		$this->wp_customize->add_setting( new BuildPress_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'breadcrumbs_bg', array(
			'default' => '#ffffff',
			'css_map' => array(
				'background-color' => array(
					'.breadcrumbs',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new BuildPress_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'breadcrumbs_color', array(
			'default' => '#666666',
			'css_map' => array(
				'color' => array(
					'.breadcrumbs a',
				),
				'color|darken(5)' => array (
					'.breadcrumbs a:hover',
				),

			)
		) ) );
		$this->wp_customize->add_setting( new BuildPress_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'breadcrumbs_color_active', array(
			'default' => '#999999',
			'css_map' => array(
				'color' => array(
					'.breadcrumbs',
				),
			)
		) ) );

		// typography
		$this->wp_customize->add_setting( 'charset_setting', array( 'default' => 'latin' ) );

		// theme colors
		$this->wp_customize->add_setting( 'layout_mode', array( 'default' => 'wide' ) );
		$this->wp_customize->add_setting( 'theme_style', array( 'default' => 'classic' ) );

		if ( 'boxed' === get_theme_mod( 'layout_mode', 'wide' ) ) { // conditionally show option to chage color inside the .boxed-container
			$this->wp_customize->add_setting( new BuildPress_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'boxed_content_bg', array(
				'default' => '#ffffff',
				'css_map' => array(
					'background-color' => array(
						'.boxed-container',
					),
				)
			) ) );
		}

		$this->wp_customize->add_setting( new BuildPress_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'primary_color', array(
			'default' => '#f7c51e',
			'css_map' => array(
				'color' => array(
					'.jumbotron__category h6',
					'.social-icons__link',
					'.testimonial__rating',
					'body.woocommerce-page .star-rating',
					'body.woocommerce-page ul.products li.product a:hover img',
					'body.woocommerce-page p.stars a',
					'.navigation--top > li > a:hover',
					'.navigation--top > li:hover > a::after',
					'.navigation--top .sub-menu > li > a:hover',
					'.navigation--top > li:hover > a',
					'.widget_pt_icon_box .icon-box > .fa',
					'html body.woocommerce-page nav.woocommerce-pagination ul li .next:hover',
					'html body.woocommerce-page nav.woocommerce-pagination ul li .prev:hover',
				),
				'background-color' => array(
					'.jumbotron__category::after',
					'.alternative-heading::after',
					'.navbar-toggle',
					'#comments-submit-button',
					'.btn-primary',
					'.btn-primary:focus',
					'.panel-grid .widget-title::after',
					'.wpb-js-composer .wpb_wrapper .widget-title::after',
					'.footer .footer__headings::after',
					'.main-title h3::before',
					'.hentry__title::after',
					'.widget_search .search-submit',
					'.pagination li .current',
					'.pagination li:hover',
					'.sidebar__headings::after',
					'.header-light .navigation--main > .current-menu-item > a|@media (min-width: 992px)',
					'.header-light .navigation--main > .current-menu-ancestor > a|@media (min-width: 992px)',
					'.navigation--main .sub-menu > li > a|@media (min-width: 992px)',
					'.sidebar .widget_nav_menu ul li.current-menu-item > a',
					'.sidebar .widget_nav_menu ul li > a:hover',
					'.widget_calendar caption',
					'.widget_tag_cloud a',
					'body.woocommerce-page .widget_product_search #searchsubmit',
					'body.woocommerce-page span.onsale',
					'body.woocommerce-page ul.products::before',
					'body.woocommerce-page nav.woocommerce-pagination ul li span.current',
					'body.woocommerce-page nav.woocommerce-pagination ul li a:hover',
					'body.woocommerce-page a.add_to_cart_button:hover',
					'body.woocommerce-page button.button:hover',
					'body.woocommerce-page .widget_product_categories ul > li > a:hover',
					'body.woocommerce-page a.button:hover',
					'body.woocommerce-page input.button:hover',
					'body.woocommerce-page table.cart td.actions input.button.alt',
					'body.woocommerce-page .cart-collaterals .shipping_calculator h2::after',
					'body.woocommerce-page .cart-collaterals .cart_totals h2::after',
					'body.woocommerce-page .woocommerce-info',
					'body.woocommerce-page .woocommerce-message',
					'body.woocommerce-page .woocommerce-error',
					'body.woocommerce-page #payment #place_order',
					'body.woocommerce-page .short-description::before',
					'body.woocommerce-page .short-description::after',
					'body.woocommerce-page .quantity .minus:hover',
					'body.woocommerce-page .quantity .plus:hover',
					'body.woocommerce-page button.button.alt',
					'body.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active',
					'body.woocommerce-page #review_form #respond input#submit',
					'body.woocommerce-page div.product .woocommerce-tabs h2::after',
					'.buildpress-table thead th',
					'.brochure-box:hover',
					'body.woocommerce-page .widget_product_search .search-field + input',
					'.woocommerce button.button.alt:disabled',
					'.woocommerce button.button.alt:disabled:hover',
					'.woocommerce button.button.alt:disabled[disabled]',
					'.woocommerce button.button.alt:disabled[disabled]:hover',
					'.woocommerce-cart .wc-proceed-to-checkout a.checkout-button',
					'body .buildpress-light .esg-filterbutton:hover',
					'body .buildpress-light .esg-sortbutton:hover',
					'body .buildpress-light .esg-sortbutton-order:hover',
					'body .buildpress-light .esg-cartbutton-order:hover',
					'body .buildpress-light .esg-filterbutton.selected',
				),
				'border-color' => array(
					'.btn-primary',
					'.btn-primary:focus',
					'.logo-panel img:hover',
					'blockquote',
					'#comments-submit-button',
					'.navigation--main > li:hover > a',
					'.header-light .navigation--main > li.is-hover > a|@media (min-width: 992px)',
					'.header-light .navigation--main > li:hover > a|@media (min-width: 992px)',
					'body .buildpress .esg-navigationbutton:hover span',
					'body .buildpress .esg-filterbutton:hover span',
					'body .buildpress .esg-sortbutton:hover span',
					'body .buildpress .esg-sortbutton-order:hover span',
					'body .buildpress .esg-cartbutton-order:hover span',
					'body .buildpress .esg-filterbutton.selected span',
					'body .buildpress-light .esg-navigationbutton:hover span',
					'body .buildpress-light .esg-filterbutton:hover span',
					'body .buildpress-light .esg-sortbutton:hover span',
					'body .buildpress-light .esg-sortbutton-order:hover span',
					'body .buildpress-light .esg-cartbutton-order:hover span',
					'body .buildpress-light .esg-filterbutton.selected span',
				),
				'color|darken(6)' => array(
					'.social-icons__link:hover',
				),
				'background-color|darken(6)' => array(
					'.navbar-toggle:hover',
					'.btn-primary:hover',
					'.btn-primary:active',
					'.widget_search .search-submit:hover',
					'#comments-submit-button:hover',
					'.navigation--main .sub-menu > li > a:hover|@media (min-width: 992px)',
					'.widget_tag_cloud a:hover',
					'body.woocommerce-page .widget_product_search #searchsubmit:hover',
					'body.woocommerce-page .widget_product_search #searchsubmit:focus',
					'body.woocommerce-page table.cart td.actions input.button.alt:hover',
					'body.woocommerce-page #payment #place_order:hover',
					'body.woocommerce-page button.button.alt:hover',
					'body.woocommerce-page #review_form #respond input#submit:hover',
					'body.woocommerce-page .widget_product_search .search-field + input:hover',
					'body.woocommerce-page .widget_product_search .search-field + input:focus',
					'.woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover',
				),
				'border-color|darken(6)' => array(
					'.btn-primary:hover',
					'.btn-primary:active',
					'#comments-submit-button:hover',
					'.navigation--main .sub-menu > li > a',
					'.navigation--main .sub-menu',
					'.navigation--main .sub-menu > li > .sub-menu',
				),
				'background|important' => array(
					'body .eg-buildpress-item-skin-element-0',
					'body .eg-buildpress-item-skin-element-0:hover',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new BuildPress_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'secondary_color', array(
			'default' => '#1fa7da',
			'css_map' => array(
				'color' => array(
					'a',
				),
				'color|darken(6)' => array(
					'a:hover',
					'.more-link .btn:hover',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new BuildPress_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'text_color', array(
			'default' => '#999999',
			'css_map' => array(
				'color' => array(
					'body',
					'.textwidget',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new BuildPress_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'primary_btn_color', array(
			'default' => '#454545',
			'css_map' => array(
				'color' => array(
					'#comments-submit-button',
					'.btn-primary',
					'.btn-primary:focus',
					'.footer .btn-primary',
					'.sidebar .widget_nav_menu ul > li.current-menu-item a',
					'.sidebar .widget_nav_menu li.current-menu-ancestor a',
					'.widget_tag_cloud a',
					'.pagination li .current',
					'.widget_search .search-submit',
				),
				'color|darken(7)' => array(
					'#comments-submit-button:hover',
					'.btn-primary:hover',
					'.btn-primary:active',
					'.footer .btn-primary:hover',
					'.sidebar .widget_nav_menu ul > li a:hover',
					'.sidebar .widget_nav_menu ul > li.current-menu-item a:hover',
					'.widget_tag_cloud a:hover',
					'.pagination li:hover a',
					'body.woocommerce-page .woocommerce-message',
					'body.woocommerce-page nav.woocommerce-pagination ul li span.current',
					'body.woocommerce-page button.button.alt',
					'body.woocommerce-page table.cart td.actions input.button.alt',
					'body.woocommerce-page button.button.alt:hover',
					'body.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active a',
					'body.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active a:hover',
					'body.woocommerce-page nav.woocommerce-pagination ul li .prev:hover',
					'body.woocommerce-page nav.woocommerce-pagination ul li .next:hover',
					'body.woocommerce-page a.add_to_cart_button:hover',
					'body.woocommerce-page a.button:hover',
					'body.woocommerce-page input.button:hover',
					'body.woocommerce-page nav.woocommerce-pagination ul li a:hover',
					'body.woocommerce-page .woocommerce-info',
					'body.woocommerce-page #payment #place_order',
					'body.woocommerce-page .widget_product_categories ul > li > a:hover',
					'body.woocommerce-page .widget_product_search #searchsubmit',
					'body.woocommerce-page #review_form #respond input#submit',
					'body.woocommerce-page button.button:hover',
					'body.woocommerce-page .woocommerce-error .showlogin',
					'body.woocommerce-page .woocommerce-error .showcoupon',
					'body.woocommerce-page .woocommerce-info .showlogin',
					'body.woocommerce-page .woocommerce-info .showcoupon',
					'body.woocommerce-page .woocommerce-message .showlogin',
					'body.woocommerce-page .woocommerce-message .showcoupon',
					'body.woocommerce-page .woocommerce-error::before, body.woocommerce-page .woocommerce-info::before',
					'body.woocommerce-page .woocommerce-message::before',
				),
			)
		) ) );

		// projects
		$this->wp_customize->add_setting( 'projects_title_mode', array( 'default' => 'generic-title' ) );
		$this->wp_customize->add_setting( 'projects_title', array( 'default' => 'Projects' ) );
		$this->wp_customize->add_setting( 'projects_subtitle', array( 'default' => 'WHAT WE HAVE DONE SO FAR' ) );
		$this->wp_customize->add_setting( 'projects_slug', array(
			'default'           => 'projects',
			'sanitize_callback' => array( $this, 'sanitize_project_slug' ),
		) );
		$this->wp_customize->add_setting( 'prev_project_btn', array( 'default' => 'Previous Project' ) );
		$this->wp_customize->add_setting( 'next_project_btn', array( 'default' => 'Next Project' ) );

		// shop
		$this->wp_customize->add_setting( 'products_per_page', array( 'default' => 12 ) );
		$this->wp_customize->add_setting( 'single_product_sidebar', array( 'default' => 'left' ) );

		// page builder styles
		if ( $this->is_pb_2() ) {
			$this->wp_customize->add_setting( new BuildPress_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'pb_color_bg_color', array(
				'default' => '#eeeeee',
				'css_map' => array(
					'background-color' => array(
						'.wide-color',
					),
				)
			) ) );
			$this->wp_customize->add_setting( new BuildPress_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'pb_color_dark_bg_color', array(
				'default' => '#454545',
				'css_map' => array(
					'background-color' => array(
						'.wide-color-dark',
					),
				)
			) ) );
			$this->wp_customize->add_setting( new BuildPress_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'pb_pattern_bg_color', array(
				'default' => '#f2f2f2',
				'css_map' => array(
					'background-color' => array(
						'.wide-pattern',
					),
				)
			) ) );
			$this->wp_customize->add_setting( new BuildPress_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'pb_pattern_bg_img', array(
				'default' => '%s/assets/images/title-area-pattern.png',
				'css_map' => array(
					'background-image|url' => array(
						'.wide-pattern',
					),
				)
			) ) );
			$this->wp_customize->add_setting( new BuildPress_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'pb_image_bg_img', array(
				'default' => '%s/assets/images/motivational-background.jpg',
				'css_map' => array(
					'background-image|url' => array(
						'.wide-image',
					),
				)
			) ) );
			$this->wp_customize->add_setting( new BuildPress_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'pb_image_bg_size', array(
				'default' => 'cover',
				'css_map' => array(
					'background-size' => array(
						'.wide-image',
					),
				)
			) ) );
		}

		// footer
		$this->wp_customize->add_setting( 'footer_widgets_num', array( 'default' => 3 ) );
		$this->wp_customize->add_setting( new BuildPress_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'top_footer_bg_color', array(
			'default' => '#f2f2f2',
			'css_map' => array(
				'background-color' => array(
					'.footer',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new BuildPress_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'top_footer_bg_img', array(
			'default' => '%s/assets/images/title-area-pattern.png',
			'css_map' => array(
				'background-image|url' => array(
					'.footer',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new BuildPress_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'top_footer_title_color', array(
			'default' => '#3d3d3d',
			'css_map' => array(
				'color' => array(
					'.footer__headings',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new BuildPress_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'top_footer_text_color', array(
			'default' => '#666666',
			'css_map' => array(
				'color' => array(
					'.footer',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new BuildPress_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'top_footer_link_color', array(
			'default' => '#1fa7da',
			'css_map' => array(
				'color' => array(
					'.footer a',
				),
				'color|darken(20)' => array(
					'.footer a:hover',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new BuildPress_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'footer_bg_color', array(
			'default' => '#f7c51e',
			'css_map' => array(
				'background-color' => array(
					'.footer-bottom',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new BuildPress_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'footer_text_color', array(
			'default' => '#666666',
			'css_map' => array(
				'color' => array(
					'.footer-bottom',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new BuildPress_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'footer_link_color', array(
			'default' => '#666666',
			'css_map' => array(
				'color' => array(
					'.footer-bottom a',
				),
				'color|darken(20)' => array(
					'.footer-bottom a:hover',
				),
			)
		) ) );
		$this->wp_customize->add_setting( 'footer_left_txt', array( 'default' => 'BuildPress Theme By <a href="http://www.proteusthemes.com">ProteusThemes</a>.' ) );
		$this->wp_customize->add_setting( 'footer_right_txt', array( 'default' => '&copy; 1896 - 2014 <strong>BuildPress, LCC</strong>. All rights reserved.' ) );

		// custom code (css/js)
		$this->wp_customize->add_setting( 'custom_css', array( 'default' => '/* enter here your custom CSS styles */' ) );
		$this->wp_customize->add_setting( 'custom_js_head' );
		$this->wp_customize->add_setting( 'custom_js_footer' );

		// acf
		$this->wp_customize->add_setting( 'show_acf', array( 'default' => 'no' ) );

		// other
		$this->wp_customize->add_setting( 'google_maps_api_key' );

		/**
		 * Panel and Sections
		 */

		// one ProteusThemes panel to rule them all
		$this->wp_customize->add_panel( 'panel_buildpress', array(
			'title'       => _x( '[PT] Theme Options', 'backend', 'buildpress_wp' ),
			'description' => _x( 'All BuildPress theme specific settings.', 'backend', 'buildpress_wp' ),
			'priority'    => 10
		) );

		// individual sections

		// Logo
		$logo_section_array = array(
			'title'       => _x( 'Logo', 'backend', 'buildpress_wp' ),
			'description' => _x( 'Logo settings for the BuildPress theme.', 'backend', 'buildpress_wp' ),
			'priority'    => 10,
			'panel'       => 'panel_buildpress',
		);

		// Theme favicon section, which will be phased out, because of WP core favicon integration
		if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
			$logo_section_array['title']       = _x( 'Logo &amp; Favicon', 'backend', 'buildpress_wp' );
			$logo_section_array['description'] = _x( 'Logo &amp; Favicon for the BuildPress theme.', 'backend', 'buildpress_wp' );
		}

		$this->wp_customize->add_section( 'buildpress_section_logos', $logo_section_array );

		$this->wp_customize->add_section( 'buildpress_section_header', array(
			'title'       => _x( 'Header &amp; Breadcrumbs', 'backend', 'buildpress_wp' ),
			'description' => _x( 'All layout and appearance settings for the footer and breadcrumbs.', 'backend', 'buildpress_wp' ),
			'priority'    => 20,
			'panel'       => 'panel_buildpress'
		) );

		$this->wp_customize->add_section( 'buildpress_section_navigation', array(
			'title'       => _x( 'Navigation', 'backend', 'buildpress_wp' ),
			'description' => _x( 'All layout and appearance settings for the main navigation.', 'backend', 'buildpress_wp' ),
			'priority'    => 25,
			'panel'       => 'panel_buildpress'
		) );

		$this->wp_customize->add_section( 'buildpress_section_main_title', array(
			'title'       => _x( 'Main Title Area', 'backend', 'buildpress_wp' ),
			'description' => _x( 'All layout and appearance settings for the main title area (regular pages).', 'backend', 'buildpress_wp' ),
			'priority'    => 27,
			'panel'       => 'panel_buildpress'
		) );

		$this->wp_customize->add_section( 'buildpress_section_typography', array(
			'title'       => _x( 'Typography', 'backend', 'buildpress_wp' ),
			'priority'    => 30,
			'panel'       => 'panel_buildpress'
		) );

		$this->wp_customize->add_section( 'buildpress_section_theme_colors', array(
			'title'       => _x( 'Theme Layout &amp; Colors', 'backend', 'buildpress_wp' ),
			'priority'    => 40,
			'panel'       => 'panel_buildpress'
		) );

		$this->wp_customize->add_section( 'buildpress_section_projects', array(
			'title'       => _x( 'Projects', 'backend', 'buildpress_wp' ),
			'priority'    => 45,
			'panel'       => 'panel_buildpress'
		) );

		if ( is_woocommerce_active() ) {
			$this->wp_customize->add_section( 'buildpress_section_shop', array(
				'title'       => _x( 'Shop', 'backend', 'buildpress_wp' ),
				'priority'    => 50,
				'panel'       => 'panel_buildpress'
			) );
		}

		if ( $this->is_pb_2() ) {
			$this->wp_customize->add_section( 'section_page_builder', array(
				'title'       => _x( 'Page Builder Row Styles', 'backend', 'buildpress_wp' ),
				'description' => _x( 'Change the custom row styles of the page builder.', 'backend', 'buildpress_wp' ),
				'priority'    => 70,
				'panel'       => 'panel_buildpress'
			) );
		}

		$this->wp_customize->add_section( 'section_footer', array(
			'title'       => _x( 'Footer', 'backend', 'buildpress_wp' ),
			'description' => _x( 'All layout and appearance settings for the footer.', 'backend', 'buildpress_wp' ),
			'priority'    => 90,
			'panel'       => 'panel_buildpress'
		) );

		$this->wp_customize->add_section( 'section_custom_code', array(
			'title'       => _x( 'Custom Code' , 'backend', 'buildpress_wp' ),
			'priority'    => 100,
			'panel'       => 'panel_buildpress'
		) );

		$this->wp_customize->add_section( 'section_other', array(
			'title'       => _x( 'Other' , 'backend', 'buildpress_wp' ),
			'priority'    => 120,
			'panel'       => 'panel_buildpress',
		) );

		/**
		 * Controls
		 */

		// Section: buildpress_section_logos
		$this->wp_customize->add_control( new WP_Customize_Image_Control(
			$this->wp_customize,
			'logo_img',
			array(
				'label'       => _x( 'Logo Image', 'backend', 'buildpress_wp' ),
				'description' => _x( 'Recommended height for the Logo is 112px.', 'backend', 'buildpress_wp' ),
				'section'     => 'buildpress_section_logos',
			)
		) );

		$this->wp_customize->add_control( new WP_Customize_Image_Control(
			$this->wp_customize,
			'logo2x_img',
			array(
				'label'       => _x( 'Retina Logo Image', 'backend', 'buildpress_wp' ),
				'description' => _x( '2x logo size, for screens with high DPI.', 'backend', 'buildpress_wp' ),
				'section'     => 'buildpress_section_logos',
			)
		) );

		// Section: header
		$this->wp_customize->add_control( 'top_bar_visibility', array(
			'type'        => 'select',
			'priority'    => 0,
			'label'       => _x( 'Top bar visibility', 'backend', 'buildpress_wp' ),
			'description' => _x( 'Show or hide?', 'backend', 'buildpress_wp' ),
			'section'     => 'buildpress_section_header',
			'choices'     => array(
				'yes' => _x( 'Show', 'backend', 'buildpress_wp' ),
				'no'  => _x( 'Hide', 'backend', 'buildpress_wp' ),
			),
		) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'top_bar_bg',
			array(
				'priority' => 1,
				'label'    => _x( 'Top bar background color', 'backend', 'buildpress_wp' ),
				'section'  => 'buildpress_section_header',
			)
		) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'top_bar_color',
			array(
				'priority' => 2,
				'label'    => _x( 'Top bar text color', 'backend', 'buildpress_wp' ),
				'section'  => 'buildpress_section_header',
			)
		) );


		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'header_bg',
			array(
				'priority' => 30,
				'label'    => _x( 'Header background color', 'backend', 'buildpress_wp' ),
				'section'  => 'buildpress_section_header',
			)
		) );
		$this->wp_customize->add_control( new WP_Customize_Image_Control(
			$this->wp_customize,
			'header_bg_img',
			array(
				'priority' => 31,
				'label'    => _x( 'Header background pattern', 'backend', 'buildpress_wp' ),
				'section'  => 'buildpress_section_header',
			)
		) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'header_text_color',
			array(
				'priority' => 32,
				'label'    => _x( 'Header text color', 'backend', 'buildpress_wp' ),
				'section'  => 'buildpress_section_header',
			)
		) );

		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'breadcrumbs_bg',
			array(
				'priority' => 60,
				'label'    => _x( 'Breadcrumbs background color', 'backend', 'buildpress_wp' ),
				'section'  => 'buildpress_section_header',
			)
		) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'breadcrumbs_color',
			array(
				'priority' => 61,
				'label'    => _x( 'Breadcrumbs text color', 'backend', 'buildpress_wp' ),
				'section'  => 'buildpress_section_header',
			)
		) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'breadcrumbs_color_active',
			array(
				'priority' => 62,
				'label'    => _x( 'Breadcrumbs active text color', 'backend', 'buildpress_wp' ),
				'section'  => 'buildpress_section_header',
			)
		) );


		// section: buildpress_section_navigation
		$this->wp_customize->add_control( 'main_navigation_sticky', array(
			'type'        => 'select',
			'priority'    => 5,
			'label'       => _x( 'Static or sticky navbar?', 'backend', 'buildpress_wp' ),
			'section'     => 'buildpress_section_navigation',
			'choices'     => array(
				'static' => _x( 'Static', 'backend', 'buildpress_wp' ),
				'sticky' => _x( 'Sticky', 'backend', 'buildpress_wp' ),
			),
		) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'main_navigation_bg',
			array(
				'priority' => 10,
				'label'    => _x( 'Main navigation background color', 'backend', 'buildpress_wp' ),
				'section'  => 'buildpress_section_navigation',
			)
		) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'main_navigation_color_mobile',
			array(
				'priority' => 20,
				'label'    => _x( 'Main navigation link color (mobile)', 'backend', 'buildpress_wp' ),
				'section'  => 'buildpress_section_navigation',
			)
		) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'main_navigation_color',
			array(
				'priority' => 30,
				'label'    => _x( 'Main navigation link color (desktop)', 'backend', 'buildpress_wp' ),
				'section'  => 'buildpress_section_navigation',
			)
		) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'main_navigation_color_hover',
			array(
				'priority' => 35,
				'label'    => _x( 'Main navigation link hover color (desktop)', 'backend', 'buildpress_wp' ),
				'section'  => 'buildpress_section_navigation',
			)
		) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'main_navigation_sub_color',
			array(
				'priority' => 40,
				'label'    => _x( 'Main navigation submenu link color', 'backend', 'buildpress_wp' ),
				'section'  => 'buildpress_section_navigation',
			)
		) );

		// section: buildpress_section_main_title
		$this->wp_customize->add_control( 'main_title_mode', array(
			'type'     => 'select',
			'priority' => 0,
			'label'    => _x( 'Main title option', 'backend', 'buildpress_wp' ),
			'section'  => 'buildpress_section_main_title',
			'choices'  => array(
				'big-title-area'   => _x( 'Big title area', 'backend', 'buildpress_wp' ),
				'small-title-area' => _x( 'Small title area', 'backend', 'buildpress_wp' ),
			)
		) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'main_title_bg_color',
			array(
				'priority' => 10,
				'label'    => _x( 'Main title background color', 'backend', 'buildpress_wp' ),
				'section'  => 'buildpress_section_main_title',
			)
		) );

		$this->wp_customize->add_control( new WP_Customize_Image_Control(
			$this->wp_customize,
			'main_title_bg_img',
			array(
				'priority' => 20,
				'label'    => _x( 'Main title background pattern', 'backend', 'buildpress_wp' ),
				'section'  => 'buildpress_section_main_title',
			)
		) );

		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'main_title_color',
			array(
				'priority' => 30,
				'label'    => _x( 'Main title color', 'backend', 'buildpress_wp' ),
				'section'  => 'buildpress_section_main_title',
			)
		) );


		// Section: buildpress_section_typography
		$this->wp_customize->add_control( 'charset_setting', array(
			'type'     => 'select',
			'priority' => 0,
			'label'    => _x( 'Character set for Google Fonts', 'backend' , 'buildpress_wp'),
			'section'  => 'buildpress_section_typography',
			'choices'  => array(
				'latin'        => 'Latin',
				'latin-ext'    => 'Latin Extended',
				'cyrillic'     => 'Cyrillic',
				'cyrillic-ext' => 'Cyrillic Extended'
			)
		) );


		// Section: buildpress_section_theme_colors
		$this->wp_customize->add_control( 'theme_style', array(
			'type'     => 'select',
			'priority' => 5,
			'label'    => esc_html__( 'Theme Style', 'buildpress_wp' ),
			'section'  => 'buildpress_section_theme_colors',
			'choices'  => array(
				'classic' => esc_html__( 'Classic', 'buildpress_wp' ),
				'light'   => esc_html__( 'Light', 'buildpress_wp' ),
			)
		) );
		$this->wp_customize->add_control( 'layout_mode', array(
			'type'     => 'select',
			'priority' => 10,
			'label'    => _x( 'Layout', 'backend', 'buildpress_wp' ),
			'section'  => 'buildpress_section_theme_colors',
			'choices'  => array(
				'wide'  => _x( 'Wide', 'backend', 'buildpress_wp' ),
				'boxed' => _x( 'Boxed', 'backend', 'buildpress_wp' ),
			)
		) );
		if ( 'boxed' === get_theme_mod( 'layout_mode', 'wide' ) ) {
			$this->wp_customize->add_control( new WP_Customize_Color_Control(
				$this->wp_customize,
				'boxed_content_bg',
				array(
					'priority'    => 11,
					'label'       => _x( 'Boxed content background color', 'backend', 'buildpress_wp' ),
					'description' => _x( 'Only applies when the Layout is set to <em>Boxed</em>.', 'backend', 'buildpress_wp' ),
					'section'     => 'buildpress_section_theme_colors',
				)
			) );
		}
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'primary_color',
			array(
				'priority' => 30,
				'label'    => _x( 'Primary color', 'backend', 'buildpress_wp' ),
				'section'  => 'buildpress_section_theme_colors',
			)
		) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'secondary_color',
			array(
				'priority' => 32,
				'label'    => _x( 'Secondary color', 'backend', 'buildpress_wp' ),
				'section'  => 'buildpress_section_theme_colors',
			)
		) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'text_color',
			array(
				'priority' => 34,
				'label'    => _x( 'Text color', 'backend', 'buildpress_wp' ),
				'section'  => 'buildpress_section_theme_colors',
			)
		) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'primary_btn_color',
			array(
				'priority' => 40,
				'label'    => _x( 'Primary button color', 'backend', 'buildpress_wp' ),
				'section'  => 'buildpress_section_theme_colors',
			)
		) );

		// Section: buildpress_section_projects
		$this->wp_customize->add_control( 'projects_title_mode', array(
				'label'       => _x( 'Title option of the projects', 'backend', 'buildpress_wp'),
				'section'     => 'buildpress_section_projects',
				'description' => _x( 'What is shown in the main title area.', 'backend', 'buildpress_wp' ),
				'type'        => 'select',
				'choices'     => array(
					'project-title' => _x( 'Show title of the actual project (+ subtitle from below if not empty)', 'backend', 'buildpress_wp'),
					'generic-title' => _x( 'Show title and subtitle from below', 'backend', 'buildpress_wp'),
				)
			)
		);
		$this->wp_customize->add_control( 'projects_title', array(
				'label'   => _x( 'Projects title', 'backend', 'buildpress_wp' ),
				'section' => 'buildpress_section_projects',
			)
		);
		$this->wp_customize->add_control( 'projects_subtitle', array(
				'label'   => _x( 'Projects subtitle', 'backend', 'buildpress_wp' ),
				'section' => 'buildpress_section_projects',
			)
		);
		$this->wp_customize->add_control( 'projects_slug', array(
				'label'       => _x( 'Projects slug', 'backend', 'buildpress_wp' ),
				'description' => _x( 'This is used in the URL part.', 'backend', 'buildpress_wp' ),
				'section'     => 'buildpress_section_projects',
			)
		);
		$this->wp_customize->add_control( 'prev_project_btn', array(
				'label'       => _x( 'Previous item label', 'backend', 'buildpress_wp' ),
				'section'     => 'buildpress_section_projects',
			)
		);
		$this->wp_customize->add_control( 'next_project_btn', array(
				'label'       => _x( 'Next item label', 'backend', 'buildpress_wp' ),
				'section'     => 'buildpress_section_projects',
			)
		);

		// Section: buildpress_section_shop
		if( is_woocommerce_active() ) {
			$this->wp_customize->add_control( 'products_per_page', array(
					'label'   => _x( 'Number of products per page', 'backend', 'buildpress_wp' ),
					'section' => 'buildpress_section_shop',
				)
			);
			$this->wp_customize->add_control( 'single_product_sidebar', array(
					'label'   => _x( 'Sidebar on single product page', 'backend', 'buildpress_wp'),
					'section' => 'buildpress_section_shop',
					'type'    => 'select',
					'choices' => array(
						'none'  => _x( 'No sidebar', 'backend', 'buildpress_wp'),
						'left'  => _x( 'Left', 'backend', 'buildpress_wp'),
						'right' => _x( 'Right', 'backend', 'buildpress_wp'),
					)
				)
			);
		}


		// Section: section_page_builder
		if ( $this->is_pb_2() ) {
			$this->wp_customize->add_control( new WP_Customize_Color_Control(
				$this->wp_customize,
				'pb_color_bg_color',
				array(
					'priority'    => 0,
					'label'       => _x( 'Background color', 'backend', 'buildpress_wp' ),
					'description' => _x( 'Row style: Wide Solid Background Color', 'backend', 'buildpress_wp' ),
					'section'     => 'section_page_builder',
				)
			) );
			$this->wp_customize->add_control( new WP_Customize_Color_Control(
				$this->wp_customize,
				'pb_color_dark_bg_color',
				array(
					'priority'    => 5,
					'label'       => _x( 'Dark background color', 'backend', 'buildpress_wp' ),
					'description' => _x( 'Row style: Wide Solid Background Dark Color', 'backend', 'buildpress_wp' ),
					'section'     => 'section_page_builder',
				)
			) );
			$this->wp_customize->add_control( new WP_Customize_Color_Control(
				$this->wp_customize,
				'pb_pattern_bg_color',
				array(
					'priority'    => 10,
					'label'       => _x( 'Background color', 'backend', 'buildpress_wp' ),
					'description' => _x( 'Row style: Wide Pattern Background', 'backend', 'buildpress_wp' ),
					'section'     => 'section_page_builder',
				)
			) );
			$this->wp_customize->add_control( new WP_Customize_Image_Control(
				$this->wp_customize,
				'pb_pattern_bg_img',
				array(
					'priority'    => 20,
					'label'       => _x( 'Background image', 'backend', 'buildpress_wp' ),
					'description' => _x( 'Row style: Wide Pattern Background', 'backend', 'buildpress_wp' ),
					'section'     => 'section_page_builder',
				)
			) );
			$this->wp_customize->add_control( new WP_Customize_Image_Control(
				$this->wp_customize,
				'pb_image_bg_img',
				array(
					'priority'    => 30,
					'label'       => _x( 'Background image', 'backend', 'buildpress_wp' ),
					'description' => _x( 'Row style: Wide Image Background', 'backend', 'buildpress_wp' ),
					'section'     => 'section_page_builder',
				)
			) );
			$this->wp_customize->add_control( 'pb_image_bg_size', array(
				'type'        => 'select',
				'priority'    => 40,
				'label'       => _x( 'Background image size', 'backend', 'buildpress_wp' ),
				'description' => _x( 'Row style: Wide Image Background', 'backend', 'buildpress_wp' ),
				'section'     => 'section_page_builder',
				'choices'     => array(
					'cover'   => _x( 'Cover', 'backend', 'buildpress_wp' ),
					'contain' => _x( 'Contain', 'backend', 'buildpress_wp' ),
					'auto'    => _x( 'Auto', 'backend', 'buildpress_wp' ),
				)
			) );
		}

		// Section: section_footer
		$this->wp_customize->add_control( 'footer_widgets_num', array(
			'type'        => 'select',
			'priority'    => 0,
			'label'       => _x( 'Number of widgets', 'backend', 'buildpress_wp' ),
			'description' => _x( 'How many widgets do you want to place in top the footer? Select <code>0</code> to disable the top footer at all.', 'backend', 'buildpress_wp' ),
			'section'     => 'section_footer',
			'choices'     => range( 0, 4 ),
		) );

		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'top_footer_bg_color',
			array(
				'priority' => 10,
				'label'    => _x( 'Top footer background color', 'backend', 'buildpress_wp' ),
				'section'  => 'section_footer',
			)
		) );

		$this->wp_customize->add_control( new WP_Customize_Image_Control(
			$this->wp_customize,
			'top_footer_bg_img',
			array(
				'priority' => 20,
				'label'    => _x( 'Top footer background pattern', 'backend', 'buildpress_wp' ),
				'section'  => 'section_footer',
			)
		) );

		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'top_footer_title_color',
			array(
				'priority' => 30,
				'label'    => _x( 'Top footer widget title color', 'backend', 'buildpress_wp' ),
				'section'  => 'section_footer',
			)
		) );

		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'top_footer_text_color',
			array(
				'priority' => 31,
				'label'    => _x( 'Top footer text color', 'backend', 'buildpress_wp' ),
				'section'  => 'section_footer',
			)
		) );

		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'top_footer_link_color',
			array(
				'priority' => 32,
				'label'    => _x( 'Top footer link color', 'backend', 'buildpress_wp' ),
				'section'  => 'section_footer',
			)
		) );

		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'footer_bg_color',
			array(
				'priority' => 100,
				'label'    => _x( 'Bottom footer background color', 'backend', 'buildpress_wp' ),
				'section'  => 'section_footer',
			)
		) );

		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'footer_text_color',
			array(
				'priority' => 105,
				'label'    => _x( 'Bottom footer text color', 'backend', 'buildpress_wp' ),
				'section'  => 'section_footer',
			)
		) );

		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'footer_link_color',
			array(
				'priority' => 106,
				'label'    => _x( 'Bottom footer link color', 'backend', 'buildpress_wp' ),
				'section'  => 'section_footer',
			)
		) );

		$this->wp_customize->add_control( 'footer_left_txt', array(
			'type'        => 'text',
			'priority'    => 110,
			'label'       => _x( 'Footer text on left', 'backend', 'buildpress_wp' ),
			'description' => _x( 'Before footer menu. You can use HTML.', 'backend', 'buildpress_wp' ),
			'section'     => 'section_footer',
		) );

		$this->wp_customize->add_control( 'footer_right_txt', array(
			'type'        => 'text',
			'priority'    => 120,
			'label'       => _x( 'Footer text on right', 'backend', 'buildpress_wp' ),
			'description' => _x( 'You can use HTML.', 'backend', 'buildpress_wp' ),
			'section'     => 'section_footer',
		) );


		// Section: section_custom_code
		$this->wp_customize->add_control( 'custom_css', array(
			'type'        => 'textarea',
			'label'       => _x( 'Custom CSS', 'backend', 'buildpress_wp' ),
			'description' => sprintf( _x( '%s How to find CSS classes %s in the theme.', 'backend', 'buildpress_wp' ), '<a href="https://www.youtube.com/watch?v=V2aAEzlvyDc" target="_blank">', '</a>' ),
			'section'     => 'section_custom_code',
		) );

		$this->wp_customize->add_control( 'custom_js_head', array(
			'type'        => 'textarea',
			'label'       => _x( 'Custom JavaScript (head)', 'backend', 'buildpress_wp' ),
			'description' => _x( 'You have to include the &lt;script&gt;&lt;/script&gt; tags as well.', 'backend', 'buildpress_wp' ),
			'section'     => 'section_custom_code',
		) );

		$this->wp_customize->add_control( 'custom_js_footer', array(
			'type'        => 'textarea',
			'label'       => _x( 'Custom JavaScript (footer)', 'backend', 'buildpress_wp' ),
			'description' => _x( 'You have to include the &lt;script&gt;&lt;/script&gt; tags as well.', 'backend', 'buildpress_wp' ),
			'section'     => 'section_custom_code',
		) );

		// Theme favicon setting and control, which will be phased out, because of WP core favicon integration
		if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
			$this->wp_customize->add_setting( 'favicon' );

			$this->wp_customize->add_control( new WP_Customize_Image_Control(
				$this->wp_customize,
				'favicon',
				array(
					'label'       => _x( 'Favicon Image', 'backend', 'buildpress_wp' ),
					'description' => _x( 'Recommended dimensions are 32 x 32px.', 'backend', 'buildpress_wp' ),
					'section'     => 'buildpress_section_logos',
				)
			) );
		}

		// Section: section_other
		$this->wp_customize->add_control( 'show_acf', array(
			'type'        => 'select',
			'label'       => _x( 'Show ACF admin panel?', 'backend', 'buildpress_wp' ),
			'description' => _x( 'If you want to use ACF and need the ACF admin panel set this to <strong>Yes</strong>. Do not change if you do not know what you are doing.', 'backend', 'buildpress_wp' ),
			'section'     => 'section_other',
			'choices'     => array(
				'no'  => _x( 'No', 'backend', 'buildpress_wp' ),
				'yes' => _x( 'Yes', 'backend', 'buildpress_wp' ),
			),
		) );

		$this->wp_customize->add_control( 'google_maps_api_key', array(
			'type'        => 'text',
			'label'       => esc_html__( 'Google maps API key', 'buildpress_wp' ),
			'description' => sprintf( esc_html__( 'Input the Google maps API key in order for maps to start working. %sGet your API key%s.', 'buildpress_wp' ), '<a href="https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key" target="_blank">', '</a>' ),
			'section'     => 'section_other',
		) );
	}

	/**
	 * Cache the rendered CSS after the settings are saved in the DB.
	 * This is purely a performance improvement.
	 *
	 * Used by hook: add_action( 'customize_save_after' , array( $this, 'cache_rendered_css' ) );
	 *
	 * @return void
	 */
	public function cache_rendered_css() {
		set_theme_mod( 'cached_css', $this->render_css() );
	}

	/**
	 * Get the dimensions of the logo image when the setting is saved
	 * This is purely a performance improvement.
	 *
	 * Used by hook: add_action( 'customize_save_logo_img' , array( $this, 'save_logo_dimensions' ), 10, 1 );
	 *
	 * @return void
	 */
	public static function save_logo_dimensions( $setting ) {
		$logo_width_height = '';
		$img_data          = getimagesize( esc_url( $setting->post_value() ) );

		if ( is_array( $img_data ) ) {
			$logo_width_height = $img_data[3];
		}

		set_theme_mod( 'logo_width_height', $logo_width_height );
	}

	/**
	 * Render the CSS from all the settings which are of type `BuildPress_Customize_Setting_Dynamic_CSS`
	 *
	 * @return string text/css
	 */
	public function render_css() {
		$out = '';

		foreach ( $this->get_dynamic_css_settings() as $setting ) {
			$out .= $setting->render_css();
		}

		return $out;
	}

	/**
	 * Get only the CSS settings of type `BuildPress_Customize_Setting_Dynamic_CSS`.
	 *
	 * @see is_dynamic_css_setting
	 * @return array
	 */
	public function get_dynamic_css_settings() {
		return array_filter( $this->wp_customize->settings(), array( $this, 'is_dynamic_css_setting' ) );
	}

	/**
	 * Helper conditional function for filtering the settings.
	 *
	 * @see
	 * @param  mixed  $setting
	 * @return boolean
	 */
	protected static function is_dynamic_css_setting( $setting ) {
		return is_a( $setting, 'BuildPress_Customize_Setting_Dynamic_CSS' );
	}

	/**
	 * Dynamically generate the JS for previewing the settings of type `BuildPress_Customize_Setting_Dynamic_CSS`.
	 *
	 * This function is better for the UX, since all the color changes are transported to the live
	 * preview frame using the 'postMessage' method. Since the JS is generated on-the-fly and we have a single
	 * entry point of entering settings along with related css properties and classes, we cannnot forget to
	 * include the setting in the customizer itself. Neat, man!
	 *
	 * @return string text/javascript
	 */
	public function customize_footer_js() {
		$settings = $this->get_dynamic_css_settings();

		ob_start();
		?>

			<script type="text/javascript">
				( function( $ ) {

				<?php
					foreach ( $settings as $key_id => $setting ) :
				?>

					wp.customize( '<?php echo $key_id; ?>', function( value ) {
						value.bind( function( newval ) {

						<?php
							foreach ( $setting->get_css_map() as $css_prop_raw => $css_selectors ) {
								extract( $setting->filter_css_property( $css_prop_raw ) );

								// background image needs a little bit different treatment
								if ( 'background-image' === $css_prop ) {
									echo 'newval = "url(" + newval + ")";' . PHP_EOL;
								}

								printf( '$( "%1$s" ).css( "%2$s", newval );%3$s', $setting->plain_selectors_for_all_groups( $css_prop_raw ), $css_prop, PHP_EOL );
							}
						?>

						} );
					} );

				<?php
					endforeach;
				?>

				} )( jQuery );
			</script>

		<?php

		echo ob_get_clean();
	}

	/**
	 * Is Page Builder by SiteOrigin v2?
	 * @return boolean
	 */
	protected function is_pb_2() {
		return defined( 'SITEORIGIN_PANELS_VERSION' ) && version_compare( SITEORIGIN_PANELS_VERSION, '2.0', '<' );
	}

	/**
	 * Create a sanitized slug, but always with a fallback to projects if it is empty
	 * @param  string $title
	 * @return string
	 */
	public static function sanitize_project_slug( $title ) {
		$title = trim( $title );
		return sanitize_title( $title, 'projects' );
	}
}

