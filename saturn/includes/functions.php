<?php
if( !function_exists( 'saturn_install_required_plugins' ) ){
	function saturn_install_required_plugins() {
		/**
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(
			array(
				'name'					=>	'Redux Framework',
				'slug'					=>	'redux-framework',
				'required'				=>	true,
			),
			array(
				'name'					=>	'Vafpress Post Formats UI',
				'slug'					=>	'vafpress-post-formats-ui-develop',
				'source'				=>	SATURN_TEMPLATE_DIRECTORY . '/plugins/vafpress-post-formats-ui-develop.zip',
				'required'				=>	true
			)
		);
		/**
		 * Array of configuration settings. Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		 */
		$config = array(
			'domain'       		=> 'saturn',         	// Text domain - likely want to be the same as your theme.
			'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
			'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
			'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
			'menu'         		=> 'install-required-plugins', 	// Menu slug
			'has_notices'      	=> true,                       	// Show admin notices or not
			'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
			'message' 			=> '',							// Message to output right before the plugins table
			'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', 'saturn' ),
			'menu_title'                       			=> __( 'Install Plugins', 'saturn' ),
			'installing'                       			=> __( 'Installing Plugin: %s', 'saturn' ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', 'saturn' ),
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
			'return'                           			=> __( 'Return to Required Plugins Installer', 'saturn' ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'saturn' ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'saturn' ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
			)
		);
		tgmpa( $plugins, $config );
	}
	add_action( 'tgmpa_register', 'saturn_install_required_plugins' );
}
if( !function_exists( 'saturn_get_embed_code' ) ){
	function saturn_get_embed_code( $post_id ) {
		$post_format = get_post_format( $post_id );
		$format_field = ($post_format == 'video') ? '_format_video_embed' : '_format_audio_embed';
		$_format_embed	=	get_post_meta( $post_id, $format_field, true );
		if( !$_format_embed )
			return;
		print '<div class="fitvideo">';
			$wp_oembed = wp_oembed_get( $_format_embed );
			if( $wp_oembed ){
				print function_exists( 'jetpack_responsive_videos_embed_html' ) ? jetpack_responsive_videos_embed_html( $wp_oembed ) : $wp_oembed;
			}
			else{
				$_format_embed = function_exists( 'jetpack_responsive_videos_embed_html' ) ? jetpack_responsive_videos_embed_html( $_format_embed ) : $_format_embed;
				print do_shortcode( $_format_embed );
			}
		print '</div>';
	}
}

function saturn_get_post_views( $post_id ){
	// update view_count from wp stats
	if( isset( $post_id ) && function_exists( 'stats_get_csv' ) ){
		$random = mt_rand( 9999, 999999999 ); // hack to break cache bug
			
		$args = array(
			'days' => $random,
			'post_id' => $post_id,
		);
			
		$stats = stats_get_csv( 'postviews', $args );
		$views = ( isset( $stats['0']['views'] ) &&  $stats['0']['views'] > 0 ) ? $stats['0']['views'] : 0;
		return absint( $views );
	}
	return 0;
}

if( !function_exists( 'saturn_update_post_views' ) ){
	function saturn_update_post_views() {
		global $post;
		if( is_single() && is_main_query() ){
			$views = function_exists( 'saturn_get_post_views' ) ? saturn_get_post_views( $post->ID ) : 0;
			if( defined( 'SATURN_POST_VIEWS' ) ){
				update_post_meta( $post->ID , SATURN_POST_VIEWS, $views);
			}			
		}
		return;
	}
	add_action( 'wp' , 'saturn_update_post_views', 100);
}

if( !function_exists( 'saturn_thumbnail_size' ) ){
	function saturn_thumbnail_size( $size ) {
		return 'post-760-434';
	}
	add_action( 'saturn_thumbnail_size' , 'saturn_thumbnail_size', 10, 1);
}

if( !function_exists('saturn_post_orderby') ){
	function saturn_post_orderby() {
		$orderby = array(
			'ID'	=>	__('Order by Post ID','saturn'),
			'author'	=>	__('Order by Author','saturn'),
			'title'	=>	__('Order by Title','saturn'),
			'name'	=>	__('Order by Post name (Post slug)','saturn'),
			'date'	=>	__('Order by Date','saturn'),
			'modified'	=>	__('Order by Last modified date','saturn'),
			'rand'	=>	__('Order by Random','saturn'),
			'comment_count'	=>	__('Order by number of comments','saturn')
		);
		if( function_exists( 'stats_get_csv' ) ){
			$orderby['view']	=	__('Order by Views','saturn');
		}
		return apply_filters( 'saturn_post_orderby' , $orderby);
	}
}
if( !function_exists('saturn_post_order') ){
	function saturn_post_order(){
		$order = array(
			'ASC'	=>	__('ASC','saturn'),
			'DESC'	=>	__('DESC','saturn')
		);
		return apply_filters( 'saturn_post_order' , $order);
	}
}

if( !function_exists( 'saturn_option_sticky' ) ){
	function saturn_option_sticky() {
		$options = array(
			'default'				=>	__('Default','saturn'),
			'ignore_sticky_posts'	=>	__('Ignore Sticky Posts','saturn'),
			'sticky_posts_only'		=>	__('Sticky Posts Only','saturn')
		);
		return apply_filters( 'saturn_option_sticky' , $options);
	}
}

if( !function_exists( 'saturn_excerpt_length' ) ){
	function saturn_excerpt_length( $length ) {
		return apply_filters( 'saturn_excerpt_length' , 40);
	}	
}

if( !function_exists( 'saturn_get_post_archive_link' ) ){
	/**
	 * Get the post archive link.
	 * return the link.
	 * @param int $post_id
	 */
	function saturn_get_post_archive_link( $post_id ) {
		if( !$post_id )
			return;
		$post_day = get_the_date('d', $post_id);
		$post_month = get_the_date('m', $post_id);
		$post_year = get_the_date('Y', $post_id);
		$date_archive_link	=	get_day_link($post_year, $post_month, $post_day);
		return esc_url( $date_archive_link );
	}
}
if( !function_exists('saturn_social_profile') ){
	function saturn_social_profile(){
		$socials = array(
			'fa-google-plus'	=>	'Google Plus',
			'fa-facebook'		=>	'Facebook',
			'fa-twitter'		=>	'Twitter',
			'fa-instagram'		=>	'Instagram',
			'fa-tumblr'			=>	'Tumblr',
			'fa-linkedin'		=>	'Linkedin',
			'fa-flickr'			=>	'Flickr',
			'fa-weibo'			=>	'Weibo',
			'fa-pinterest'		=>	'Pinterest',
			'fa-youtube'		=>	'Youtube'
		);
		$socials = apply_filters( 'saturn_social_profile_args' , $socials);
		return $socials;
	}
}

if( !function_exists( 'saturn_get_primary_sidebar_counter' ) ){
	function saturn_get_primary_sidebar_counter() {
		$the_sidebars = function_exists( 'wp_get_sidebars_widgets' ) ? wp_get_sidebars_widgets() : 0;
		if( isset( $the_sidebars['sidebar-primary'] ) && count( $the_sidebars['sidebar-primary'] ) > 0 ){
			return count( $the_sidebars['sidebar-primary'] );
		}
		return 0;
	}
}