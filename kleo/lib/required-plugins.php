<?php

function kleo_get_required_plugins() {

	/* Delete plugin version transient on Install plugins page */
	$kleo_rem_plugin_transient = false;
	if ( is_admin() && isset($_GET['page']) && $_GET['page'] == 'install-required-plugins' ) {
		$kleo_rem_plugin_transient = true;
	}

	$required_plugins = array(
		array(
			'name'               => 'Buddypress',
			// The plugin name
			'slug'               => 'buddypress',
			// The plugin slug (typically the folder name)
			'required'           => false,
			// If false, the plugin is only 'recommended' instead of required
			'version'            => '2.3.2.1',
			// E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'   => false,
			// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false,
			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'       => '',
			// If set, overrides default API URL and points to an external URL
			'description'        => 'Build any type of community website with member profiles, activity streams, user groups, messaging, and more.',
		),

		array(
			'name'               => 'bbPress',
			// The plugin name
			'slug'               => 'bbpress',
			// The plugin slug (typically the folder name)
			'required'           => false,
			// If false, the plugin is only 'recommended' instead of required
			'version'            => '',
			// E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'   => false,
			// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false,
			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'       => '',
			// If set, overrides default API URL and points to an external URL
			'description'        => 'Allows you to create a forum on your WordPress site'
		),
		array(
			'name'               => 'Visual Composer',
			// The plugin name
			'slug'               => 'js_composer',
			// The plugin slug (typically the folder name)
			'version'            => kleo_get_plugin_version( 'js_composer', '4.12', $kleo_rem_plugin_transient ),
			// E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'source'             => kleo_get_plugin_src( 'js_composer', '4.12', false ),
			// The plugin source
			'required'           => true,
			// If false, the plugin is only 'recommended' instead of required
			'force_activation'   => false,
			// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false,
			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'       => '',
			// If set, overrides default API URL and points to an external URL
			'description'        => 'Build pages with an advanced Drag&Drop interface'
		),
		array(
			'name'               => 'Revolution Slider',
			// The plugin name
			'slug'               => 'revslider',
			// The plugin slug (typically the folder name)
			'required'           => true,
			// If false, the plugin is only 'recommended' instead of required
			'version'            => kleo_get_plugin_version( 'revslider', '5.2.5', $kleo_rem_plugin_transient ),
			// E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'source'             => kleo_get_plugin_src( 'revslider', '5.2.5' ),
			// The plugin source
			'force_activation'   => false,
			// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false,
			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'       => '',
			// If set, overrides default API URL and points to an external URL
			'description'        => 'Create advanced and beautiful sliders and also one page sites.'
		),
		array(
			'name'               => 'K Elements',
			// The plugin name
			'slug'               => 'k-elements',
			// The plugin slug (typically the folder name)
			'source'             => get_template_directory() . '/lib/inc/k-elements.zip',
			// The plugin source
			'required'           => true,
			// If false, the plugin is only 'recommended' instead of required
			'version'            => '4.1',
			// E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'   => false,
			// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false,
			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'       => '',
			// If set, overrides default API URL and points to an external URL
			'description'        => 'Part of KLEO theme, it adds the shortcodes required to work properly.'
		),
		array(
			'name'               => 'Go Pricing',
			// The plugin name
			'slug'               => 'go_pricing',
			// The plugin slug (typically the folder name)
			'required'           => false,
			// If false, the plugin is only 'recommended' instead of required
			'version'            => kleo_get_plugin_version( 'go_pricing', '3.2.1', $kleo_rem_plugin_transient ),
			// E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'source'             => kleo_get_plugin_src( 'go_pricing', '3.2.1' ),
			// The plugin source
			'force_activation'   => false,
			// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false,
			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'       => '',
			// If set, overrides default API URL and points to an external URL
			'description'        => 'You can build amazing pricing & compare tables with this plugin.'
		),
		array(
			'name'               => 'Essential Grid',
			'slug'               => 'essential-grid',
			'required'           => false,
			// If false, the plugin is only 'recommended' instead of required
			'version'            => kleo_get_plugin_version( 'essential-grid', '2.1.0.2', $kleo_rem_plugin_transient ),
			'source'             => kleo_get_plugin_src( 'essential-grid', '2.1.0.2' ),
			'force_activation'   => false,
			// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false,
			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'       => '',
			// If set, overrides default API URL and points to an external URL
			'description'        => 'Premium plugin - Display various content formats in a highly customizable grid.'
		),
		array(
			'name'               => 'SideKick - Interactive Tutorials',
			// The plugin name
			'slug'               => 'sidekick',
			// The plugin slug (typically the folder name)
			'required'           => false,
			// If false, the plugin is only 'recommended' instead of required
			'version'            => '2.6.8',
			// E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'   => false,
			// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false,
			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'       => '',
			// If set, overrides default API URL and points to an external URL
			'description'        => 'Interactive WordPress tutorials in your admin area.'
		),
		array(
			'name'               => 'rtMedia',
			// The plugin name
			'slug'               => 'buddypress-media',
			// The plugin slug (typically the folder name)
			'required'           => false,
			// If false, the plugin is only 'recommended' instead of required
			'version'            => '',
			// E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'   => false,
			// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false,
			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'       => '',
			// If set, overrides default API URL and points to an external URL
			'description'        => 'Allows BuddyPress users to create image, video or audio galleries.'
		),
		array(
			'name'               => 'WooCommerce',
			// The plugin name
			'slug'               => 'woocommerce',
			// The plugin slug (typically the folder name)
			'required'           => false,
			// If false, the plugin is only 'recommended' instead of required
			'version'            => '2.4.5',
			// E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'   => false,
			// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false,
			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'       => '',
			// If set, overrides default API URL and points to an external URL
			'description'        => 'Create an advanced Shop right in your WordPress site. '
		),
		array(
			'name'               => 'YITH WooCommerce Wishlist',
			// The plugin name
			'slug'               => 'yith-woocommerce-wishlist',
			// The plugin slug (typically the folder name)
			'required'           => false,
			// If false, the plugin is only 'recommended' instead of required
			'version'            => '1.1.2',
			// E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'   => false,
			// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false,
			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'       => '',
			// If set, overrides default API URL and points to an external URL
			'description'        => 'Adds Wishlist functionality to your WooCommerce shop'
		),
		array(
			'name'               => 'Paid Memberships Pro',
			// The plugin name
			'slug'               => 'paid-memberships-pro',
			// The plugin slug (typically the folder name)
			'required'           => false,
			// If false, the plugin is only 'recommended' instead of required
			'version'            => '1.8',
			// E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'   => false,
			// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false,
			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'       => '',
			// If set, overrides default API URL and points to an external URL
			'description'        => 'Add memberships levels and create access restrictions for your users.'
		),
		array(
			'name'               => 'BP Profile Search',
			// The plugin name
			'slug'               => 'bp-profile-search',
			// The plugin slug (typically the folder name)
			'required'           => false,
			// If false, the plugin is only 'recommended' instead of required
			'version'            => '4.3.1',
			// E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'   => false,
			// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false,
			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'       => '',
			// If set, overrides default API URL and points to an external URL
			'description'        => 'Search your BuddyPress Members Directory by profile fields(used on Get Connected demo).'
		),
		array(
			'name'               => 'MailChimp for WordPress',
			// The plugin name
			'slug'               => 'mailchimp-for-wp',
			// The plugin slug (typically the folder name)
			'required'           => false,
			// If false, the plugin is only 'recommended' instead of required
			'version'            => '3.1',
			// E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'   => false,
			// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false,
			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'       => '',
			// If set, overrides default API URL and points to an external URL
			'description'        => 'Subscribe your WordPress site visitors to your MailChimp lists, with ease.'
		),
		array(
			'name'               => 'Geodirectory',
			// The plugin name
			'slug'               => 'geodirectory',
			// The plugin slug (typically the folder name)
			'required'           => false,
			// If false, the plugin is only 'recommended' instead of required
			'version'            => '1.6.5',
			// E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'   => false,
			// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false,
			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'       => '',
			// If set, overrides default API URL and points to an external URL
			'description'        => 'Create huge location-based business directories'
		),
		array(
			'name'               => 'Contact Form 7',
			// The plugin name
			'slug'               => 'contact-form-7',
			// The plugin slug (typically the folder name)
			'required'           => false,
			// If false, the plugin is only 'recommended' instead of required
			'version'            => '4.4.2',
			// E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'   => false,
			// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false,
			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'       => '',
			// If set, overrides default API URL and points to an external URL
			'description'        => 'Simple but flexible contact form plugin.'
		),
		array(
			'name'               => 'Social Articles',
			// The plugin name
			'slug'               => 'social-articles',
			// The plugin slug (typically the folder name)
			'required'           => false,
			// If false, the plugin is only 'recommended' instead of required
			'version'            => '1.8',
			// E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'   => false,
			// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false,
			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'       => '',
			// If set, overrides default API URL and points to an external URL
			'description'        => 'Create and manage posts from your BuddyPress profile.'
		),
	);

	return $required_plugins;
}

$kleo_theme = Kleo::instance();

//add required plugins
$kleo_theme->tgm_plugins = kleo_get_required_plugins();
require_once KLEO_DIR . '/lib/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', array( $kleo_theme, 'required_plugins' ) );




/**
 * Get the source of the plugin depending on the version available
 * @param string $name
 * @param string $version
 * @param boolean $external_only
 *
 * @return string
 */
function kleo_get_plugin_src( $name, $version, $external_only = true ) {

	$online_version = kleo_get_plugin_version( $name, $version );

	if ( $external_only === true || version_compare( $online_version, $version, '>' ) ) {
		$output = 'http://updates.seventhqueen.com/check/kleo/' . $name . '.zip';
	} else {
		$output = get_template_directory() . '/lib/inc/' . $name . '.zip';
	}

	return $output;
}

/**
 * @param string $name Plugin name
 * @param string $version Default version in case of error
 * @param boolean $reset_transient Delete transient and check the online version now
 *
 * @return mixed|string
 */
function kleo_get_plugin_version( $name, $version, $reset_transient = false ) {

	if( $reset_transient === true ) {
		delete_transient( 'kleo_'. $name );
	}

	$final_version = $version;

	if( get_transient( 'kleo_'. $name ) ) {
		$final_version = get_transient('kleo_'. $name);
	} else {
		$version_get = wp_remote_get( 'http://updates.seventhqueen.com/check/kleo/plugin_version.php?name='. $name );
		// Check for error
		if ( ! is_wp_error( $version_get ) ) {
			$url_version = wp_remote_retrieve_body( $version_get );

			// Check for error
			if ( ! is_wp_error( $url_version ) ) {
				$final_version = $url_version;

				set_transient( 'kleo_'. $name, $url_version, 86400 );
			}
		}
	}

	return $final_version;
}