<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
// PHP VERSION :
$php_version_class = (PHP_VERSION > 5.3) ? 'yes' : 'no';
$php_version = '<i class="dashicons dashicons-'.$php_version_class.'"></i><b>'.PHP_VERSION.'</b>';
// PHP ZIP EXTENSION :
$php_zip_extension_class = (extension_loaded('zip')) ? 'yes' : 'no';
$php_zip_extension_label = (extension_loaded('zip')) ? 'Enabled' : 'Disabled';
$php_zip_extension = '<i class="dashicons dashicons-'.$php_zip_extension_class.'"></i><b>'.$php_zip_extension_label.'</b>';
// PHP Memory limit :
$php_memory_limit_data = round((ini_get('memory_limit')), 1);
$php_memory_limit_class = ($php_memory_limit_data > 32) ? 'yes' : 'no';
$php_memory_limit = '<i class="dashicons dashicons-'.$php_memory_limit_class.'"></i><b>'.$php_memory_limit_data.' MB</b>';
// PHP Get Content function :
$php_file_content_class = (ini_get('allow_url_fopen')) ? 'yes' : 'no';
$php_file_content_label = (ini_get('allow_url_fopen')) ? 'Enabled' : 'Disabled';
$php_file_content = '<i class="dashicons dashicons-'.$php_file_content_class.'"></i><b>'.$php_file_content_label.'</b>';
// WP VERSION :
$wordpress_version_class = (get_bloginfo('version')  > 4.3) ? 'yes' : 'no';
$wordpress_version = '<i class="dashicons dashicons-'.$php_version_class.'"></i><b>'.get_bloginfo('version').'</b>';
// WP_DEBUG :
$wordpress_debug_label = (defined('WP_DEBUG') && true === WP_DEBUG) ? 'Enabled' : 'Disabled';
$wordpress_debug = '<i class="dashicons dashicons-admin-tools"></i><b>'.$wordpress_debug_label.'</b>';
// WP PLUGINS :
$wordpress_plugins_number = count(get_option('active_plugins'));
$wordpress_plugins_class = ($wordpress_plugins_number < 20) ? 'yes' : 'no';
$wordpress_plugins = '<i class="dashicons dashicons-'.$wordpress_plugins_class.'"></i><b>'.$wordpress_plugins_number.'</b>';


$options = array(
	'system' => array(
		'title'   => __( 'System Status', 'woffice' ),
		'type'    => 'tab',
		'options' => array(
			'wordpress-box' => array(
				'title'   => __( 'Wordpress Status', 'woffice' ),
				'type'    => 'box',
				'options' => array(
					'wordpress_version' => array(
						'type'  => 'html',
						'attr'  => array( 'class' => 'woffice-check' ),
						'label' => __('Wordpress Version', 'woffice'),
						'html'  => $wordpress_version,
                        'help'  => __('This is the current version of your Wordpress Installation, it\'s always recommanded to have the latest release.', 'woffice_backend'),
					),
					'wordpress_debug' => array(
						'type'  => 'html',
						'attr'  => array( 'class' => 'woffice-check' ),
						'label' => __('Wordpress Debug', 'woffice'),
						'html'  => $wordpress_debug,
                        'help'  => __('If enabled all PHP errors will be displayed, if you have an issue like a white page, make sure it\'s enabled.', 'woffice_backend'),
                    ),
					'wordpress_path' => array(
						'type'  => 'html',
						'attr'  => array( 'class' => 'woffice-check' ),
						'label' => __('Wordpress Path', 'woffice'),
						'html'  =>  '<i class="dashicons dashicons-archive"></i><b> '.ABSPATH.'</b>',
                        'help'  => __('The path on your FTP where you\'ve installed your Wordpress files.', 'woffice_backend'),
                    ),
					'wordpress_db_name' => array(
						'type'  => 'html',
						'attr'  => array( 'class' => 'woffice-check' ),
						'label' => __('Wordpress Database', 'woffice'),
						'html'  =>  '<i class="dashicons dashicons-location"></i><b> '.DB_NAME.'</b>',
                        'help'  => __('Name of the database where Wordpress has been installed.', 'woffice_backend'),
                    ),
					'wordpress_plugins' => array(
						'type'  => 'html',
						'attr'  => array( 'class' => 'woffice-check' ),
						'label' => __('Plugins Enabled', 'woffice'),
						'html'  =>  $wordpress_plugins,
                        'help'  => __('Too many plugins installed can impact heavily your site\'s speed performances.', 'woffice_backend'),
                    ),
				)
			),
			'server-box' => array(
				'title'   => __( 'Server Status', 'woffice' ),
				'type'    => 'box',
				'options' => array(
					'php_version' => array(
						'type'  => 'html',
						'attr'  => array( 'class' => 'woffice-check' ),
						'label' => __('PHP Version', 'woffice'),
						'html'  => $php_version,
                        'help'  => __('This is the version of the PHP installed on your server.', 'woffice_backend'),
                    ),
					'php_zip_extension' => array(
						'type'  => 'html',
						'attr'  => array( 'class' => 'woffice-check' ),
						'label' => __('PHP Zip Extension', 'woffice'),
						'html'  => $php_zip_extension,
                        'help'  => __('This PHP extension is required by Wordpress to install our demo content and other plugins.', 'woffice_backend'),
                    ),
					'php_memory_limit' => array(
						'type'  => 'html',
						'attr'  => array( 'class' => 'woffice-check' ),
						'label' => __('PHP Memory Limit', 'woffice'),
						'html'  => $php_memory_limit,
                        'help'  => __('The Memory limit allowed by your php.ini file on your server.', 'woffice_backend'),
                    ),
					'php_file_content' => array(
						'type'  => 'html',
						'attr'  => array( 'class' => 'woffice-check' ),
						'label' => __('PHP Remote URL Calls', 'woffice'),
						'html'  => $php_file_content,
                        'help'  => __('Whether your server allow us to make API calls or not, you need it enabled for the Members map.', 'woffice_backend'),
                    )
				)
			),
		)
	)
);