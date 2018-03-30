<?php

class _WST_UpdateSystem {

	static $pluginList;
	static $tgmPlugins;
	static $pluginSlugs = array();
	static $pluginSlugsWithFile = array();
	static $pluginWithSlugs;
	static $activePlugins;
	static $installedPlugins;
	static $page;
	static $notices;
	static $messages = array();
	private static $_instance = null;

	static public function _wst_init() {
		if ( is_admin() ) {
			include (crazyblog_ROOT . 'core/application/library/update/classes/ajax.php');
			include (crazyblog_ROOT . 'core/application/library/update/classes/response.php');
			include (crazyblog_ROOT . 'core/application/library/update/classes/update-notification.php');
			include (crazyblog_ROOT . 'core/application/library/update/classes/demoimporter.php');
			add_action( 'admin_enqueue_scripts', array( '_WST_UpdateEnqueue', '_wst_adminEnqueue' ) );
			_WST_DemoImporter::_wst_init();
			crazyblog_PluginsAjax::init();
		}
		if ( !function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}
		self::$messages = array(
			'install_plugins' => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'crazyblog' ),
			'install_recommended' => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'crazyblog' ),
			'activate_plugin' => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'crazyblog' ),
			'activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'crazyblog' ),
			'plugin_update' => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'crazyblog' ),
		);
		$updateNag = array();
		$slugs = array();
		$slugsWithFile = array();
		$PluginNotActive = array();

		self::$installedPlugins = get_plugins();
		self::$activePlugins = get_option( 'active_plugins' );
		//printr( self::$activePlugins );
		self::$tgmPlugins = new crazyblog_Plugins();
		self::$pluginList = self::$tgmPlugins->crazyblog_plugin_list();

		foreach ( self::$pluginList as $list ) {
			$slugs[crazyblog_set( $list, 'slug' )] = $list;
		}
		self::$pluginWithSlugs = $slugs;
		self::$pluginSlugs = array_keys( $slugs );

		foreach ( self::$pluginSlugs as $file ) {
			self::$pluginSlugsWithFile[] = $file . '/' . $file . '.php';
		}

		$updateNag = self::_wst_updateNag( self::$pluginSlugsWithFile );
		if ( $updateNag === true ) {
			add_action( 'admin_menu', array( __CLASS__, '_wst_registerPage' ) );
		}

		_WST_UpdateNotification::_wst_sendPingTHeme();
	}

	static public function _wst_updateNag( $plugins ) {
		$updateNag = array();
		$active = self::_wst_pluginActive( $plugins );
		$notInstalled = self::_wst_pluginInstall( $plugins );
		$hasUpdate = self::_wst_hasUpdate( $plugins );
		if ( !empty( $active ) || !empty( $notInstalled ) || !empty( $hasUpdate ) ) {
			if ( !empty( $notInstalled ) ) {
				foreach ( $notInstalled as $i ) {
					$updateNag['NotInstalled'][] = $i;
				}
			}
			if ( !empty( $active ) ) {
				foreach ( $active as $a ) {
					if ( !in_array( $a, $notInstalled ) ) {
						$updateNag['notActive'][] = $a;
					}
				}
			}

			if ( !empty( $hasUpdate ) ) {
				foreach ( $hasUpdate as $a ) {
					$updateNag['hasUpdate'][] = $a;
				}
			}
		}
		self::$notices = $updateNag;
		$currentPage = crazyblog_set( $_GET, 'page' );
		if ( !empty( self::$notices ) && $currentPage !== 'webinane-theme-extensions' ) {
			global $current_user;
			$user_id = crazyblog_set( crazyblog_set( $current_user, 'data' ), 'ID' );
			$CheckDismiss = crazyblog_set( get_user_meta( $user_id, 'crazyblog_DismissNotice' ), '0' );

			if ( $CheckDismiss != 'true' ) {
				add_action( 'admin_notices', array( __CLASS__, '_wst_plugin_notices' ) );
			}
		}
		if ( !empty( $active ) || !empty( $notInstalled ) || !empty( $hasUpdate ) ) {
			return true;
		} else {
			return false;
		}
	}

	static public function _wst_registerPage() {
		self::$page = add_theme_page( esc_html__( 'Extensions', 'crazyblog' ), esc_html__( 'Extensions', 'crazyblog' ), 'manage_options', 'webinane-theme-extensions', array( '_WST_UpdateEnqueue', '_wst_pluginPage' ) );
		add_action( 'load-' . self::$page, array( '_WST_UpdateEnqueue', '_wst_css' ) );
		add_action( 'load-' . self::$page, array( '_WST_UpdateEnqueue', '_wst_js' ) );
	}

	static public function _wst_pluginInstall( $plugins ) {
		$reusult = array();
		$installedPlugins = array_keys( self::$installedPlugins );
		foreach ( $plugins as $plugin ) {
			if ( !in_array( $plugin, $installedPlugins ) ) {
				$reusult[] = $plugin;
			}
		}
		return $reusult;
	}

	static public function _wst_pluginActive( $plugins ) {
		$result = array();
		foreach ( $plugins as $plugin ) {
			if ( !is_plugin_active( $plugin ) ) {
				$result[] = $plugin;
			}
		}

		return $result;
	}

	static public function _wst_hasUpdate( $plugins ) {
		$result = array();
		foreach ( $plugins as $plugin ) {
			if ( is_plugin_active( $plugin ) ) {
				$exp = explode( '/', $plugin );
				$getPlugin = self::$pluginWithSlugs[crazyblog_set( $exp, '0' )];
				if ( _WST_UpdateNotification::_wst_checkUpdate( 'plugin', crazyblog_set( $getPlugin, 'slug' ), crazyblog_set( $getPlugin, 'repo' ) ) == true ) {
					$result[] = $plugin;
				}
			}
		}

		return $result;
	}

	static public function _wst_plugin_notices() {
		$class = 'wp-noticebox update-nag settings-error notice is-dismissible';
		$messageInstall = '';
		$messageActive = '';
		$messageUpdate = '';

		foreach ( self::$notices as $type => $notic ) {
			if ( $type == 'NotInstalled' ) {
				$messageInstall = self::_wst_pluginInstallNotic( self::$notices['NotInstalled'] );
			}
			if ( $type == 'notActive' ) {
				$messageActive = self::_wst_pluginActiveNotic( self::$notices['notActive'] );
			}
			if ( $type == 'hasUpdate' ) {
				$messageUpdate = self::_wst_pluginUpdateNotic( self::$notices['hasUpdate'] );
			}
		}
		ob_start();
		?>
		<div class="<?php echo esc_attr( $class ) ?>">
			<ul class="admin-notice">
				<?php
				if ( !empty( $messageInstall ) ):
					echo wp_kses_post( $messageInstall );
				endif;

				if ( !empty( $messageActive ) ):
					echo wp_kses_post( $messageActive );
				endif;
				if ( !empty( $messageUpdate ) ):
					echo wp_kses_post( $messageUpdate );
				endif;
				?>
			</ul>
			<?php
			if ( !empty( $messageActive ) || !empty( $messageInstall ) || !empty( $messageUpdate ) ) {
				global $current_user;
				$user_id = crazyblog_set( crazyblog_set( $current_user, 'data' ), 'ID' );
				echo '<span id="dismiss-current-user">' . $user_id . '</span><a class="goto" href="' . admin_url( 'themes.php?page=webinane-theme-extensions' ) . '">' . esc_html__( 'GoTo Extension\'s Page', 'crazyblog' ) . '</a> <a class="dismiss" id="tgm_dismiss" href="#">' . esc_html__( 'Dismiss this notice', 'crazyblog' ) . '</a>';
			}
			?>
		</div>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		echo wp_kses( $output, true );
	}

	static public function _wst_pluginInstallNotic( $plugins ) {
		$line_template = '<li><span>%s</span></li>' . "\n";
		$return = array();
		$message = '';
		foreach ( $plugins as $plugin ) {
			$temp = explode( '/', $plugin );
			$getPlugin = self::$pluginWithSlugs[crazyblog_set( $temp, '0' )];
			if ( crazyblog_set( $getPlugin, 'required' ) == true ) {
				$return['install_plugins'][] = crazyblog_set( $getPlugin, 'name' );
			} else {
				$return['install_recommended'][] = crazyblog_set( $getPlugin, 'name' );
			}
		}
		foreach ( $return as $type => $plugin ) {
			$count = count( $plugin );
			$linked_plugins = array_map( array( __CLASS__, '_wst_wrap_in_em' ), $plugin );
			$last_plugin = array_pop( $linked_plugins );
			$imploded = empty( $linked_plugins ) ? $last_plugin : ( implode( ', ', $linked_plugins ) . ' ' . esc_html_x( 'and', 'plugin A *and* plugin B', 'crazyblog' ) . ' ' . $last_plugin );
			$message .= sprintf( $line_template, sprintf( translate_nooped_plural( self::$messages[$type], $count, 'carazyblog' ), $imploded, $count ) );
		}
		return $message;
	}

	static public function _wst_pluginActiveNotic( $plugins ) {
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

		$line_template = '<li><span>%s</span></li>' . "\n";
		$return = array();
		$message = '';
		foreach ( $plugins as $plugin ) {
			$temp = explode( '/', $plugin );
			$getPlugin = self::$pluginWithSlugs[crazyblog_set( $temp, '0' )];
			if ( !is_plugin_active( crazyblog_set( $getPlugin, 'slug' ) . '/' . crazyblog_set( $getPlugin, 'slug' ) . '.php' ) && crazyblog_set( $getPlugin, 'required' ) == true ) {
				$return['activate_plugin'][] = crazyblog_set( $getPlugin, 'name' );
			} else {
				$return['activate_recommended'][] = crazyblog_set( $getPlugin, 'name' );
			}
		}
		foreach ( $return as $type => $plugin ) {
			$count = count( $plugin );
			$linked_plugins = array_map( array( __CLASS__, '_wst_wrap_in_em' ), $plugin );
			$last_plugin = array_pop( $linked_plugins );
			$imploded = empty( $linked_plugins ) ? $last_plugin : ( implode( ', ', $linked_plugins ) . ' ' . esc_html_x( 'and', 'plugin A *and* plugin B', 'crazyblog' ) . ' ' . $last_plugin );
			$message .= sprintf( $line_template, sprintf( translate_nooped_plural( self::$messages[$type], $count, 'carazyblog' ), $imploded, $count ) );
		}
		return $message;
	}

	static public function _wst_pluginUpdateNotic( $plugins ) {
		$line_template = '<span>%s</span>' . "\n";
		$return = array();
		$message = '';
		foreach ( $plugins as $plugin ) {
			$temp = explode( '/', $plugin );
			$getPlugin = self::$pluginWithSlugs[crazyblog_set( $temp, '0' )];
			if ( _WST_UpdateNotification::_wst_checkUpdate( 'plugin', crazyblog_set( $getPlugin, 'slug' ), crazyblog_set( $getPlugin, 'repo' ) ) == true ) {
				$return['plugin_update'][] = crazyblog_set( $getPlugin, 'name' );
			}
		}
		foreach ( $return as $type => $plugin ) {
			$count = count( $return );
			$linked_plugins = array_map( array( __CLASS__, '_wst_wrap_in_em' ), $plugin );
			$last_plugin = array_pop( $linked_plugins );
			$imploded = empty( $linked_plugins ) ? $last_plugin : ( implode( ', ', $linked_plugins ) . ' ' . esc_html_x( 'and', 'plugin A *and* plugin B', 'crazyblog' ) . ' ' . $last_plugin );
			$message .= sprintf( $line_template, sprintf( translate_nooped_plural( self::$messages[$type], $count, 'carazyblog' ), $imploded, $count ) );
		}
		return $message;
	}

	static public function _wst_get_installed_version( $slug ) {
		$installed_plugins = self::$pluginWithSlugs;
		if ( !empty( $installed_plugins[$slug]['version'] ) ) {
			return $installed_plugins[$slug]['version'];
		}

		return '';
	}

	static public
			function _wst_does_plugin_require_update( $slug ) {
		if ( array_key_exists( $slug . '/' . $slug . '.php', self::$installedPlugins ) ) {
			$minimum_version = self::_wst_get_installed_version( $slug );
			$installed_version = self::$installedPlugins[$slug . '/' . $slug . '.php']['Version'];
			return version_compare( $installed_version, $minimum_version, '>' );
		}
	}

	static public function _wst_wrap_in_em( $string ) {
		return '<i style="color:#ffba00">' . wp_kses_post( $string ) . '</i>';
	}

	static public function crazyblog_plugin_repo_version( $slug, $link = false ) {
		$args = (object) array( 'slug' => $slug );
		$request = array( 'action' => 'plugin_information', 'timeout' => 15, 'request' => serialize( $args ) );
		$url = 'http://api.wordpress.org/plugins/info/1.0/';
		$response = wp_remote_post( $url, array( 'body' => $request ) );
		$plugin_info = unserialize( wp_remote_retrieve_body( $response ) );
		if ( !empty( $plugin_info ) ) {
			if ( $link == true ) {
				return $plugin_info->download_link;
			} elseif ( $link == false ) {
				return $plugin_info->version;
			}
		}
	}

	static public function get_instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	function __clone() {
		
	}

}
