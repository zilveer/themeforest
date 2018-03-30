<?php
	/* -------------------------------------------------------------------------*
	 * 						SET DEFAULT VALUES BY THEME INSTALL					*
	 * -------------------------------------------------------------------------*/
	global $pagenow;
	get_template_part(THEME_INCLUDES."/lib/class-tgm-plugin-activation");

	// with activate istall option
	if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
		$theme_logo = THEME_IMAGE_URL."TrendyBlog.png";
		$theme_logo_f = THEME_IMAGE_URL."logo-footer.png";
		$favicon = THEME_IMAGE_URL."favicon.ico";
		$banner = '	<a href="http://www.different-themes.com" target="_blank"><img src="'.esc_url(THEME_IMAGE_URL.'no-banner-728x90.jpg').'" alt="" title="" /></a>';
		$copyright = '&copy; '.date("Y").' Copyright '.THEME_FULL_NAME.' theme. All Rights reserved. <a href="http://themeforest.net/user/different-themes/portfolio?ref=different-themes" target="_blank">Different Themes</a>';
		
		//df_update_option(THEME_NAME."_logo", $theme_logo, true);
		df_update_option(THEME_NAME.'_stickyMenu', 'on', true);

		df_update_option(THEME_NAME.'_autostartFeatured', 'on', true);
		df_update_option(THEME_NAME.'_loopFeatured', 'on', true);
		df_update_option(THEME_NAME.'_featured_slider_count', '8', true);

		df_update_option(THEME_NAME.'_main_news_autostart', 'on', true);
		df_update_option(THEME_NAME.'_main_news_loop', 'on', true);
		df_update_option(THEME_NAME.'_breadcrumb', 'on', true);
		df_update_option(THEME_NAME.'_main_slider_count', '10', true);
		df_update_option(THEME_NAME.'_similar_post_count', '3', true);
		df_update_option(THEME_NAME.'_similar_post_excerpt', 'on', true);

		
		df_update_option(THEME_NAME.'_google_font_1', 'Titillium Web', true);
		df_update_option(THEME_NAME.'_google_font_2', 'Titillium Web', true);
		df_update_option(THEME_NAME.'_font_size_1', '14', true);
		df_update_option(THEME_NAME.'_font_size_2', '16', true);
		df_update_option(THEME_NAME.'_font_size_3', '12', true);
		df_update_option(THEME_NAME.'_font_size_4', '12', true);
		df_update_option(THEME_NAME.'_body_bg_type', 'color', true);
		df_update_option(THEME_NAME.'_color_1', 'f85050', true);
		df_update_option(THEME_NAME.'_color_2', 'f85050', true);
		df_update_option(THEME_NAME.'_color_3', 'f85050', true);
		df_update_option(THEME_NAME.'_color_4', '222222', true);
		df_update_option(THEME_NAME.'_color_5', 'FC8D8D', true);
		df_update_option(THEME_NAME.'_color_6', 'eee', true);
		df_update_option(THEME_NAME.'_color_7', 'ddd', true);
		df_update_option(THEME_NAME.'_color_8', '999', true);
		df_update_option(THEME_NAME.'_body_color', 'f1f1f1', true);
	
		df_update_option(THEME_NAME.'_default_cat_color', 'f85050', true);
		df_update_option(THEME_NAME.'_sticky_sidebar', 'on', true);



		df_update_option(THEME_NAME.'_show_single_title', 'custom', true);
		df_update_option(THEME_NAME.'_showTumbIcon', 'custom', true);
		df_update_option(THEME_NAME.'_sidebar_type', 'custom', true);
		df_update_option(THEME_NAME.'_share_buttons', 'custom', true);


		
		df_update_option(THEME_NAME.'_showLikes', 'custom', true);
		df_update_option(THEME_NAME.'_imagePopUp', 'custom', true);
		df_update_option(THEME_NAME.'_share_all', 'custom', true);
		df_update_option(THEME_NAME.'_aboutPostAuthor', 'custom', true);
		df_update_option(THEME_NAME.'_similar_posts_gallery', 'custom', true);
		df_update_option(THEME_NAME.'_sidebar_position', "custom", true);
		df_update_option(THEME_NAME.'_subcount', "6", true);
		df_update_option(THEME_NAME.'_post_style', "custom", true);



		
		df_update_option(THEME_NAME."_favicon", $favicon, true);
		df_update_option(THEME_NAME.'_page_layout', 'wide', true);
		df_update_option(THEME_NAME.'_responsive', 'on', true);
		df_update_option(THEME_NAME.'_menu_style', 'on', true);



		df_update_option(THEME_NAME.'_similar_posts', "custom", true);
		//df_update_option(THEME_NAME.'_single_post_style', 'custom', true);
		//df_update_option(THEME_NAME.'_post_likes_single', 'custom', true);
		df_update_option(THEME_NAME.'_postComments', 'custom', true);
		//df_update_option(THEME_NAME.'_post_views_single', 'custom', true);
		df_update_option(THEME_NAME.'_postAuthor', 'custom', true);
		df_update_option(THEME_NAME.'_postDate', 'custom', true);
		df_update_option(THEME_NAME.'_postImageStyle', 'custom', true);
		df_update_option(THEME_NAME.'_postCategory', 'custom', true);
		df_update_option(THEME_NAME.'_postPrint', 'custom', true);
		df_update_option(THEME_NAME.'_postFont', 'custom', true);
		df_update_option(THEME_NAME.'_post_tag_single', 'custom', true);
		df_update_option(THEME_NAME.'_show_single_thumb', "custom", true);
		df_update_option(THEME_NAME."_rss_url", get_bloginfo("rss_url"), true);
		df_update_option(THEME_NAME.'_copyright', $copyright, true);
		df_update_option(THEME_NAME.'_show_first_thumb', "on", true);
		df_update_option(THEME_NAME.'_singlePostBlogTitle', "on", true);

		
		df_update_option(THEME_NAME.'_search', 'on', true);
		df_update_option(THEME_NAME.'_headerStyle', '1', true);

		//set default thumbnail sizes in woocommerce
		update_option('shop_catalog_image_size',  array('width'  => '325','height' => '325','crop'   => 1));


}

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function my_theme_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin pre-packaged with a theme
		array(
			'name'     				=> 'Woocommerce', // The plugin name
			'slug'     				=> 'woocommerce', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),		

	);


	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
		'strings'      		=> array(
			'page_title'                       			=> esc_html__( 'Install Required Plugins', THEME_NAME ),
			'menu_title'                       			=> esc_html__( 'Install Plugins', THEME_NAME ),
			'installing'                       			=> esc_html__( 'Installing Plugin: %s', THEME_NAME ), // %1$s = plugin name
			'oops'                             			=> esc_html__( 'Something went wrong with the plugin API.', THEME_NAME ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_canndf_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_canndf_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_canndf_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> esc_html__( 'Return to Required Plugins Installer', THEME_NAME ),
			'plugin_activated'                 			=> esc_html__( 'Plugin activated successfully.', THEME_NAME ),
			'complete' 									=> esc_html__( 'All plugins installed and activated successfully. %s', THEME_NAME ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );
}

	


?>