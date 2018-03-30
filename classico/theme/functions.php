<?php  if ( ! defined('ET_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! Specific functions only for this theme
// **********************************************************************//

if(!function_exists('et_theme_setup')) {

	add_action('after_setup_theme', 'et_theme_setup');
	
	function et_theme_setup(){
        add_theme_support( 'post-formats', array( 'video', 'quote', 'gallery' ) );
        add_theme_support('post-thumbnails', array('post'));
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'woocommerce' );
	}
}

// **********************************************************************// 
// ! Menus
// **********************************************************************// 

if(!function_exists('etheme_register_menus')) {
    function etheme_register_menus() {
        register_nav_menus(array(
            'main-menu' => __('Main menu', ET_DOMAIN),
            'mobile-menu' => __('Mobile menu', ET_DOMAIN)
        ));
    }
    add_action('init', 'etheme_register_menus');
}

// **********************************************************************// 
// ! Script, styles, fonts
// **********************************************************************// 

// **********************************************************************// 
// ! Include CSS and JS
// **********************************************************************// 
if(!function_exists('et_theme_styles')) {
    function et_theme_styles() {

        if ( !is_admin() ) {
            wp_enqueue_style("fa",get_template_directory_uri().'/css/font-awesome.min.css');
            wp_enqueue_style("bootstrap",get_template_directory_uri().'/css/bootstrap.min.css');
            wp_enqueue_style("parent-style",get_template_directory_uri().'/style.css', array("bootstrap"));
            wp_enqueue_style( 'js_composer_front');
            wp_enqueue_style("google-fonts",et_http()."fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic|Raleway:400,300,500,600,700,800|Cookie&subset=latin,latin-ext");
        	
        	if( etheme_get_option('dark_styles') ) {
            	wp_enqueue_style("dark-style",get_template_directory_uri().'/css/dark.css');
        	}

        }
    }
}

add_action( 'wp_enqueue_scripts', 'et_theme_styles', 40);
// **********************************************************************// 
// ! Ititialize theme configuration and variables
// **********************************************************************// 
add_action('wp_head', 'etheme_assets');
if(!function_exists('etheme_assets')) {
    function etheme_assets() {
    	global $et_selectors;
			$et_selectors = array();
			
			$et_selectors['active_color'] = '
				a:hover,
				a:focus,
				a.active,
				h1.active,
				h2.active,
				h3.active,
				h4.active,
				h5.active,
				h6.active,
				h1.active a,
				h2.active a,
				h3.active a,
				h4.active a,
				h5.active a,
				h6.active a,
				.menu > li.sfHover > a, .menu > li > a:hover,
				.menu-item-language .submenu-languages > li a:hover,
				p.active, em.active, li.active, strong.active, span.active,
				.sidebar-widget.widget_categories li a:hover, 
				.sidebar-slider.widget_categories li a:hover, 
				.sidebar-widget.widget_archive li a:hover, 
				.sidebar-slider.widget_archive li a:hover, 
				.sidebar-widget.widget_pages li a:hover, 
				.sidebar-slider.widget_pages li a:hover, 
				.sidebar-widget.widget_meta li a:hover, 
				.sidebar-slider.widget_meta li a:hover, 
				.sidebar-widget.widget_nav_menu li a:hover, 
				.sidebar-slider.widget_nav_menu li a:hover,
				.breadcrumbs a:hover,
				.woocommerce-breadcrumb a:hover,
				.breadcrumbs li a,
				.woocommerce-breadcrumb li a,
				.back-history:hover:before, .back-history:focus:before,
				.product-categories > li > ul.children li > a:hover,
				.product-categories.with-accordion ul.children li a:hover,
				.product .product-details .products-page-cats a:hover,
				.product-categories > li span:hover,
				.product .product-details .product-title a:hover,
				.languages-area .lang_sel_list_horizontal a:hover,
				.languages-area .widget_currency_sel_widget ul.wcml_currency_switcher li:hover,
				.register-link .register-popup .popup-terms a,
				.login-link .register-popup .popup-terms a,
				.register-link .login-popup .popup-terms a,
				.login-link .login-popup .popup-terms a,
				.mobile-nav ul.wcml_currency_switcher li:hover,
				.mobile-nav #lang_sel_list a:hover,
				.mobile-nav .links li a:hover,
				.mobile-nav-heading a:hover,
				.et-mobile-menu li a:hover,
				.et-mobile-menu li .open-child:hover,
				.et-mobile-menu.line-items li.active a,
				.product-categories > li.current-cat,
				.product-categories > li.current-cat a,
				.product-categories > li.current-cat span,
				.home .sidebar-widget.widget_product_categories li > a:hover,
				.product-information .menu-social-icons a i:hover,
				.product-information .out-of-stock,
				.comments-list .comment .comment-reply-link:hover,
				table.shop_table td.product-details a:hover,
				.woocommerce-info a:hover,
				.icon-box .read-more-btn:hover,
				.icon-box.design-3:hover i,
				.widget.widget_pages ul li a:hover,
				.widget.widget_nav_menu ul li a:hover,
				.widget.widget_categories ul li a:hover,
				.widget.widget_archive ul li a:hover,
				.tabs.accordion .tab-title:hover,
				.tabs.accordion .tab-title:focus,
				.left-titles a:hover,
				.tab-title-left:hover,
				.menu-social-icons li a i:hover,
				.posts-carousel.carousel-design-3 .post-item.post-format-quote .category-list a:hover,
				.teaser_grid_container .isotope-inner .meta-post span a:hover,
				footer .container .widget-container .blog-post-list .media a:hover,
				.error404 .header-wrapper .menu > li a:hover,
				.sidebar-widget.widget_nav_menu li.current-menu-item a, 
				.sidebar-slider.widget_nav_menu li.current-menu-item a, 
				.widget-container.widget_nav_menu li.current-menu-item a,
				mark, .mark,
				.twitter-list li a,
				.product-information .out-stock .wr-c,
				.et-twitter-slider li a,
				.menu .item-design-full-width.demo-column .nav-sublist-dropdown ul > li a:hover,
				.mobile-menu-wrapper .menu > li.over > a,  .mobile-menu-wrapper .menu > li .nav-sublist-dropdown ul li.over > a

			';

			$et_selectors['active_bg'] = '
				.btn.filled.active,
				.shopping-container .btn.border-grey:hover,
				.btn-active,
				.btn.filled.active,
				.horizontal-break-alt:after,
				.bottom-btn .btn.btn-black:hover,
				.icon-box.animation-2:hover .icon i,
				.tabs.accordion .tab-title:before,
				.posts-carousel.carousel-design-3 .post-item .category-list,
				.et-tooltip:hover,
				article.blog-post.sticky .sticky-post, article.post-grid.sticky .sticky-post
			';

			$et_selectors['active_border'] = '
				.btn.filled.active,
				.shopping-container .btn.border-grey:hover,
				.btn-active,
				.btn.filled.active,
				.btn.filled.active.medium,
				hr.active,
				.bottom-btn .btn.btn-black:hover,
				.icon-box.design-3:hover i,
				.icon-box.animation-2:hover .icon i,
				.tagcloud a:hover
			';
			
			?>

            <?php 
                $activeColor = (etheme_get_option('activecol')) ? etheme_get_option('activecol') : '#8a8a8a';
            ?>

                
            <style type="text/css">
	            <?php echo et_js2tring($et_selectors['active_color']); ?>              { color: <?php echo $activeColor; ?>; }
	
	            <?php echo et_js2tring($et_selectors['active_bg']); ?>                 { background-color: <?php echo $activeColor; ?>; }
	
	            <?php echo et_js2tring($et_selectors['active_border']); ?>             { border-color: <?php echo $activeColor; ?>; }
	
            </style>

        <?php
    }
}


// **********************************************************************// 
// ! Header Type
// **********************************************************************// 
function get_header_type() {
	$ht = etheme_get_option('header_type');
    return $ht;
}
add_filter('custom_header_filter', 'get_header_type',10);

function etheme_get_header_structure($ht) {
    switch ($ht) {
        case 1:
        case 2:
        case 14:
            return 1;
            break;
        case 3:
            return 2;
            break;
        case 6:
            return 3;
            break;
        case 7:
        case 8:
        case 10:
            return 4;
            break;
        case 4:
        case 11:
        	return 5;
        	break;
       	case 5:
        case 9:
        	return 6;
        	break;
       	case 12:
        	return 7;
        	break;
        case 13:
        	return 8;
        	break;
       	case 15:
        	return 9;
        	break;
        case 16:
        	return 10;
        	break;
        case 17:
        	return 11;
        	break;
        default:
            return 1;
            break;
    }
}


// **********************************************************************// 
// ! Plugins activation
// **********************************************************************// 
if(!function_exists('et_register_required_plugins')) {
	add_action('tgmpa_register', 'et_register_required_plugins');
	function et_register_required_plugins() {
		$plugins = array(
			/*array(
				'name'     				=> 'LayerSlider', // The plugin name
				'slug'     				=> 'LayerSlider', // The plugin slug (typically the folder name)
				'source'   				=> get_template_directory_uri() . '/code/plugins/LayerSlider.zip', // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			),*/
			array(
				'name'     				=> '8theme Post Types', // The plugin name
				'slug'     				=> 'et-post-types', // The plugin slug (typically the folder name)
				'source'   				=> get_template_directory_uri() . '/theme/plugins/et-post-types.zip', // The plugin source
				'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'     				=> 'WooCommerce', // The plugin name
				'slug'     				=> 'woocommerce', // The plugin slug (typically the folder name)
				//'source'   				=> get_template_directory_uri() . '/framework/plugins/screets-chat.zip', // The plugin source
				'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> 'woocommerce', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'     				=> 'Visual Composer', // The plugin name
				'slug'     				=> 'js_composer', // The plugin slug (typically the folder name)
				'source'   				=> get_template_directory_uri() . '/theme/plugins/js_composer.zip', // The plugin source
				'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'     				=> 'Ultimate addons for Visual Composer', // The plugin name
				'slug'     				=> 'Ultimate_VC_Addons', // The plugin slug (typically the folder name)
				'source'   				=> get_template_directory_uri() . '/theme/plugins/Ultimate_VC_Addons.zip', // The plugin source
				'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'     				=> 'Essential grid', // The plugin name
				'slug'     				=> 'essential-grid', // The plugin slug (typically the folder name)
				'source'   				=> get_template_directory_uri() . '/theme/plugins/essential-grid.zip', // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'     				=> 'Revolution Slider', // The plugin name
				'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
				'source'   				=> get_template_directory_uri() . '/theme/plugins/revslider.zip', // The plugin source
				'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'     				=> 'Master Slider', // The plugin name
				'slug'     				=> 'masterslider', // The plugin slug (typically the folder name)
				'source'   				=> get_template_directory_uri() . '/theme/plugins/masterslider-installable.zip', // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			),
	        array(
	            'name'      => 'Wishlist',
	            'slug'      => 'yith-woocommerce-wishlist',
	            'required'  => false,
	        ),
	        array(
	            'name'      => 'Contact Form 7',
	            'slug'      => 'contact-form-7',
	            'required'  => false,
	        ),
	        array(
	            'name'      => 'WooCommerce',
	            'slug'      => 'woocommerce',
	            'required'  => false,
	        ),
			array(
				'name'     				=> 'Screets Chat', // The plugin name
				'slug'     				=> 'screets-chat', // The plugin slug (typically the folder name)
				'source'   				=> get_template_directory_uri() . '/theme/plugins/screets-lc.zip', // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			)	
		);

		// Change this to your theme text domain, used for internationalising strings

		/**
		 * Array of configuration settings. Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		 */
		$config = array(
			'domain'       		=> ET_DOMAIN,         	// Text domain - likely want to be the same as your theme.
			'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
			'parent_slug' 	=> 'themes.php', 				// Default parent menu slug
			'parent_slug' 	=> 'themes.php', 				// Default parent URL slug
			'menu'         		=> 'install-required-plugins', 	// Menu slug
			'has_notices'      	=> true,                       	// Show admin notices or not
			'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
			'message' 			=> '',							// Message to output right before the plugins table
			'strings'      		=> array(
				'page_title'                       			=> __( 'Install Required Plugins', ET_DOMAIN),
				'menu_title'                       			=> __( 'Install Plugins', ET_DOMAIN ),
				'installing'                       			=> __( 'Installing Plugin: %s', ET_DOMAIN ), // %1$s = plugin name
				'oops'                             			=> __( 'Something went wrong with the plugin API.', ET_DOMAIN ),
				'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
				'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
				'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
				'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
				'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
				'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
				'return'                           			=> __( 'Return to Required Plugins Installer', ET_DOMAIN ),
				'plugin_activated'                 			=> __( 'Plugin activated successfully.', ET_DOMAIN ),
				'complete' 									=> __( 'All plugins installed and activated successfully. %s', ET_DOMAIN ), // %1$s = dashboard link
				'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
			)
		);

		tgmpa($plugins, $config);
	}
}

// **********************************************************************// 
// ! Footer Demo Widgets
// **********************************************************************// 

if(!function_exists('etheme_footer_demo')) {
    function etheme_footer_demo($position){
        switch ($position) {
            case 'footer10':
                ?>

					<div class="row">
						<div class="col-md-12 text-center">
							<?php etheme_logo(); ?>
							<div class="clear"></div>
							<hr class="footer-divider">
							<ul class="footer-demo-links">
								<li><a href="#">Home</a></li>
								<li><a href="#">Pages</a></li>
								<li><a href="#">Shop</a></li>
								<li><a href="#">Checkout</a></li>
								<li><a href="#">Buy Theme!</a></li>
							</ul>
							<hr class="footer-divider">
							<p>Made with love by <strong><a href="http://www.8theme.com">8theme</a></strong>. All Rights Reserved.</p>
						</div>
					</div>
                <?php
            break;
        }
    }
}