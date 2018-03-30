<?php
/**
 * Register default theme options fields
 *
 * @package Learn
 */


/**
 * Register theme options fields
 *
 * @since  1.0
 *
 * @return array Theme options fields
 */
function learn_theme_option_fields() {
	$options = array();

	// Help information
	$options['help'] = array(
		'document' => 'http://vegatheme.com/docs/learn/',
		'support' => 'http://vegatheme.com/support/learn/',
	);


	// Sections
	$options['sections'] = array(
		'general' => array(
			'icon' => 'cog',
			'title' => esc_html__( 'General', 'learn' ),
		),
		'misce' => array(
			'icon' => 'bell',
			'title' => esc_html__( 'Miscellaneous', 'learn' ),
		),
		'content' => array(
			'icon' => 'news',
			'title' => esc_html__( 'Blog', 'learn' ),
		),
		'header' => array(
			'icon' => 'browser',
			'title' => esc_html__( 'Header', 'learn' ),
		),
		'footer' => array(
			'icon' => 'rss',
			'title' => esc_html__( 'Footer', 'learn' ),
		),
		'style' => array(
			'icon' => 'palette',
			'title' => esc_html__( 'Style', 'learn' ),
		),
		'export' => array(
			'icon' => 'upload-to-cloud',
			'title' => esc_html__( 'Backup - Restore', 'learn' ),
		),
	);

	// Fields
	$options['fields'] = array();
	$options['fields']['general'] = array(
		array(
			'name' => 'favicon',
			'label' => esc_html__( 'Favicon', 'learn' ),
			'type' => 'icon',
		),
		array(
			'name' => 'logo',
			'label' => esc_html__( 'Logo', 'learn' ),
			'type' => 'image',
		),
		array(
			'name' => 'home_screen_icons',
			'label' => esc_html__( 'Home Screen Icons', 'learn' ),
			'desc' => esc_html__( 'Select image file that will be displayed on home screen of handheld devices.', 'learn' ),
			'type' => 'group',
			'children' => array(
				array(
					'name' => 'icon_ipad_retina',
					'type' => 'icon',
					'subdesc' => esc_html__( 'IPad Retina (144x144px)', 'learn' ),
				),
				array(
					'name' => 'icon_ipad',
					'type' => 'icon',
					'subdesc' => esc_html__( 'IPad (72x72px)', 'learn' ),
				),

				array(
					'name' => 'icon_iphone_retina',
					'type' => 'icon',
					'subdesc' => esc_html__( 'IPhone Retina (114x114px)', 'learn' ),
				),

				array(
					'name' => 'icon_iphone',
					'type' => 'icon',
					'subdesc' => esc_html__( 'IPhone (57x57px)', 'learn' ),
				)
			)
		)
		
	);

	$options['fields']['misce'] = array(
		array(
			'name' => 'color_scheme2',
			'label' => esc_html__( 'Theme Color 2', 'learn' ),
			'type' => 'switcher',
			'default' => false,
		),
		array(
			'name' => 'boxed',
			'label' => esc_html__( 'Display Boxed', 'learn' ),
			'desc' => esc_html__( 'Enable/Disable Boxed Layout', 'learn' ),
			'type' => 'switcher',
			'default' => 1,
		),
		array(
			'name' => 'bg_boxed',
			'label' => esc_html__( 'Background Body Boxed', 'learn' ),
			'type' => 'color',
		),
		array(
			'name' => 'breadcrumb',
			'label' => esc_html__( 'Display Breadcrumbs', 'learn' ),
			'desc' => esc_html__( 'Enable/Disable breadcrumbs on the content of site', 'learn' ),
			'type' => 'switcher',
			'default' => 1,
		),		
		array(
			'name' => 'link_sub',
			'label' => esc_html__( 'Subscribe Courses Link', 'learn' ),
			'type' => 'text',
			'desc'	=> esc_html__( 'Link in Course Grid page', 'learn' ),
		),
	);

	$options['fields']['content'] = array(
		array(
			'name' => 'bg_head',
			'label' => esc_html__( 'Background Image Header', 'learn' ),
			'type' => 'background',
		),
		array(
			'name' => 'sub_head',
			'label' => esc_html__( 'Subtitle Header', 'learn' ),
			'type' => 'textarea',
		),
		array(
			'name' => 'des_head',
			'label' => esc_html__( 'Description Header', 'learn' ),
			'type' => 'textarea',
		),
		array(
			'name' => 'excerpt_length',
			'label' => esc_html__( 'Excerpt Length', 'learn' ),
			'type' => 'number',
			'size' => 'small',
			'default' => 30,
		),
	);

	$options['fields']['header'] = array(
		array(
			'name' => 'bg_top',
			'label' => esc_html__( 'Background Top Header', 'learn' ),
			'type' => 'color',
		),
		array(
			'name' => 'bg_nav',
			'label' => esc_html__( 'Background Nav Menu', 'learn' ),
			'type' => 'color',
		),
		array(
			'name' => 'color_menu',
			'label' => esc_html__( 'Text Color Menu', 'learn' ),
			'type' => 'color',
		),
		array(
			'name' => 'head_text',
			'label' => esc_html__( 'Top Header', 'learn' ),
			'type' => 'editor',
			'settings' => array(
			'media_buttons' => false,
			'teeny'         => true,
			'quicktags'     => true,
			),
			'desc' => 'Input following <a target="_blank" href="http://www.w3schools.com/tags/tag_ul.asp">this struct</a>'
		),
	);

	$options['fields']['footer'] = array(
		array(
			'name' => 'bg_footer',
			'label' => esc_html__( 'Background Color Footer', 'learn' ),
			'type' => 'color',
		),
		array(
			'name' => 'topfooter',
			'label' => esc_html__( 'Top Footer', 'learn' ),
			'type' => 'switcher',
			'default' => 1,
		),
		array(
			'name' => 'logo_footer',
			'label' => esc_html__( 'Logo Footer', 'learn' ),
			'type' => 'image',
		),
		array(
			'name' => 'newsletter',
			'label' => esc_html__( 'Newsletter Shortcode', 'learn' ),
			'type' => 'text',
			'size' => 'medium',
			'desc' => wp_kses_post( sprintf( __( 'You can edit your sign-up form in the <a href="%s">MailChimp for WordPress form settings</a>.', 'learn' ), admin_url( 'admin.php?page=mailchimp-for-wp-forms' ) ) )
		),	
		array(
			'name' => 'bg_copyr',
			'label' => esc_html__( 'Background Copyright', 'learn' ),
			'type' => 'color',
		),	
		array(
			'name' => 'copyr',
			'label' => esc_html__( 'Copyright Text', 'learn' ),
			'type' => 'editor',
		)
		
	);

	$options['fields']['style'] = array(
		array(
			'name' => 'custom_color_scheme',
			'label' => esc_html__( 'Custom Color Scheme', 'learn' ),
			'desc' => esc_html__( 'Enable custom color scheme to pick your own color scheme', 'learn' ),
			'type' => 'group',
			'layout' => 'vertical',
			'children' => array(
				array(
					'name' => 'custom_color_scheme',
					'type' => 'switcher',
					'default' => false,
				),
				array(
					'name' => 'custom_color_1',
					'type' => 'color',
					'subdesc' => esc_html__( 'Custom Primary Color', 'learn' ),
				)				
			)
		),
		array(
			'type' => 'divider',
		),
		array(
			'name' => 'custom_css',
			'label' => esc_html__( 'Custom CSS', 'learn' ),
			'type' => 'code_editor',
			'language' => 'css',
			'subdesc' => esc_html__( 'Enter your custom style rules here', 'learn' )
		),
	);
	
	$options['fields']['export'] = array(
		array(
			'name' => 'backup',
			'label' => esc_html__( 'Backup Settings', 'learn' ),
			'subdesc' => esc_html__( 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options" button above', 'learn' ),
			'type' => 'backup',
		),
	);

	return $options;
}

add_filter( 'learn_theme_options', 'learn_theme_option_fields' );

/**
 * Generate custom color scheme css
 *
 * @since 1.0
 */
function learn_generate_custom_color_scheme() {
	parse_str( $_POST['data'], $data );

	if ( ! isset( $data['custom_color_scheme'] ) || ! $data['custom_color_scheme'] ) {
		return;
	}

	$color_1 = $data['custom_color_1'];
	$color_2 = $data['custom_color_2'];
	if ( ! $color_1 && ! $color_2 ) {
		return;
	}

	// Getting credentials
	$url = wp_nonce_url( 'themes.php?page=theme-options' );
	if ( false === ( $creds = request_filesystem_credentials( $url, '', false, false, null ) ) ) {
		return; // stop the normal page form from displaying
	}

	// Try to get the wp_filesystem running
	if ( ! WP_Filesystem( $creds ) ) {
		// Ask the user for them again
		request_filesystem_credentials( $url, '', true, false, null );
		return;
	}

	global $wp_filesystem;

	// Prepare LESS to compile
	$less = $wp_filesystem->get_contents( get_template_directory() . '/css/color-schemes.less' );
	if(  $color_1 ) {
		$less .= ".color-scheme($color_1);";
	}
	
	if(  $color_2 ) {
		$less .= ".color-scheme-2($color_2);";
	}

	// Compile
	require get_template_directory() . '/framework/theme-options/lessc.inc.php';
	$compiler = new lessc;
	$compiler->setFormatter( 'compressed' );
	$css = $compiler->compile( $less );

	// Get file path
	$upload_dir = wp_upload_dir();
	$dir = path_join( $upload_dir['basedir'], 'custom-css' );
	$file = $dir . '/color-scheme.css';

	// Create directory if it doesn't exists
	wp_mkdir_p( $dir );
	$wp_filesystem->put_contents( $file, $css, FS_CHMOD_FILE );


	wp_send_json_success();
}

add_action( 'learn_ajax_generate_custom_css', 'learn_generate_custom_color_scheme' );

/**
 * Load script for theme options
 *
 * @since 1.0.0
 *
 * @param string $hook
 */
function learn_enqueue_admin_scripts( $hook ) {
	if ( 'appearance_page_theme-options' != $hook ) {
		return;
	}

	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

}

add_action( 'admin_enqueue_scripts', 'learn_enqueue_admin_scripts' );
