<?php

class crazyblog_AjaxResponse {

	static public function crazyblog_download_plugin_response() {
		if ( isset( $_POST['action'] ) && $_POST['action'] == 'crazyblog_download_plugin' ) {
			global $wp_filesystem;
			if ( empty( $wp_filesystem ) ) {
				require_once(ABSPATH . '/wp-admin/includes/file.php');
				WP_Filesystem();
			}
			$wp_filesystem->mkdir( str_replace( '\\', '/', ABSPATH ) . 'wp-content/upgrade/' );
			$pluginArray = _WST_UpdateSystem::$pluginWithSlugs;
			$currentPlugin = crazyblog_set( $pluginArray, crazyblog_set( $_POST, 'plugin' ) );
			$pluginFilePath = crazyblog_set( $currentPlugin, 'source' );
			$pluginName = crazyblog_set( $currentPlugin, 'name' );

			$my_plugin = crazyblog_set( $_POST, 'plugin' ) . '/' . crazyblog_set( $_POST, 'plugin' ) . '.php';
			$allPlugins = get_plugins();
			if ( !array_key_exists( $my_plugin, $allPlugins ) ) {
				$pluginUrl = '';
				if ( crazyblog_set( $_POST, 'repo' ) == 'true' ) {
					$pluginUrl = _WST_UpdateSystem::crazyblog_plugin_repo_version( crazyblog_set( $_POST, 'plugin' ), true );
				} elseif ( !empty( $pluginFilePath ) ) {
					$pluginUrl = $pluginFilePath;
				} else {
					$pluginUrl = 'http://webinane.com/update/api2/plugin/' . crazyblog_set( $_POST, 'plugin' );
				}
				if ( !in_array( 'zip', get_loaded_extensions() ) ) {
					esc_html_e( 'Zip extension not enable, please contact to your hostin provider to enable zip extension', 'crazyblog' );
					return;
				}
				if ( !empty( $pluginUrl ) ) {
					if ( empty( $pluginFilePath ) ) {
						$request = array(
							'httpversion' => '1.0',
							'timeout' => 1000,
							'method' => 'POST',
							'user-agent' => 'PHP-MCAPI/2.0',
							'sslverify' => false,
						);

						if ( crazyblog_set( $_POST, 'repo' ) == 'true' ) {
							$response = wp_remote_get( $pluginUrl, array( 'timeout' => 120, 'httpversion' => '1.1' ) );
							$zipdata = wp_remote_retrieve_body( $response );
						} else {
							$response = wp_remote_post( $pluginUrl, $request );
							$zipdata = wp_remote_retrieve_body( $response );
						}
						$file = crazyblog_set( $_POST, 'plugin' ) . '.zip';
						if ( file_exists( str_replace( '\\', '/', ABSPATH ) . 'wp-content/upgrade/' . $file ) ) {
							unlink( str_replace( '\\', '/', ABSPATH ) . 'wp-content/upgrade/' . $file );
						}

						$wp_filesystem->put_contents( str_replace( '\\', '/', ABSPATH ) . 'wp-content/upgrade/' . $file, $zipdata, 0777 );
						$path = realpath( str_replace( '\\', '/', ABSPATH ) . 'wp-content/plugins/' );
						$zip = new ZipArchive();
						if ( $zip->open( str_replace( '\\', '/', ABSPATH ) . 'wp-content/upgrade/' . $file ) === TRUE ) {
							$zip->extractTo( $path );
							$zip->close();
							unlink( ABSPATH . 'wp-content/upgrade/' . $file );

							$plugins = (get_option( 'active_plugins' )) ? get_option( 'active_plugins' ) : array();
							if ( count( $plugins ) > 0 ) {
								foreach ( $plugins as $plugin ) {
									if ( !in_array( $my_plugin, $plugins ) ) {
										array_push( $plugins, $my_plugin );
										update_option( 'active_plugins', $plugins );
									}
								}
							} else {
								update_option( 'active_plugins', array( $my_plugin ) );
							}
							activate_plugin( $my_plugin );
							echo sprintf( '%s ' . esc_html__( 'has been installed and activated.', 'crazyblog' ), $pluginName );
						} else {
							esc_html_e( 'Faild to open Zip Archive', 'crazyblog' );
						}
					} else {
						$path = realpath( str_replace( '\\', '/', ABSPATH ) . 'wp-content/plugins/' );
						$zip = new ZipArchive();
						if ( $zip->open( $pluginFilePath ) === TRUE ) {
							$zip->extractTo( $path );
							$zip->close();

							$plugins = (get_option( 'active_plugins' )) ? get_option( 'active_plugins' ) : array();
							if ( count( $plugins ) > 0 ) {
								foreach ( $plugins as $plugin ) {
									if ( !in_array( $my_plugin, $plugins ) ) {
										array_push( $plugins, $my_plugin );
										update_option( 'active_plugins', $plugins );
									}
								}
							} else {
								update_option( 'active_plugins', array( $my_plugin ) );
							}
							activate_plugin( $my_plugin );
							echo sprintf( '%s ' . esc_html__( 'has been installed and activated.', 'crazyblog' ), $pluginName );
						} else {
							esc_html_e( 'Faild to open Zip Archive', 'crazyblog' );
						}
					}
				} else {
					esc_html_e( 'Plugin URL not prest', 'crazyblog' );
				}
			}
		}
		exit;
	}

	static public function crazyblog_activate_plugin_response() {
		if ( isset( $_POST['action'] ) && $_POST['action'] == 'crazyblog_activate_plugin' ) {
			$my_plugin = crazyblog_set( $_POST, 'plugin' ) . '/' . crazyblog_set( $_POST, 'plugin' ) . '.php';
			$plugins = (get_option( 'active_plugins' )) ? get_option( 'active_plugins' ) : array();
			if ( count( $plugins ) > 0 ) {
				foreach ( $plugins as $plugin ) {
					if ( !in_array( $my_plugin, $plugins ) ) {
						array_push( $plugins, $my_plugin );
						update_option( 'active_plugins', $plugins );
					}
				}
			} else {
				update_option( 'active_plugins', array( $my_plugin ) );
			}
			activate_plugin( $my_plugin );
		}
	}

	static public function crazyblog_update_plugin_response() {
		if ( isset( $_POST['action'] ) && $_POST['action'] == 'crazyblog_update_plugin' ) {
			$pluginArray = _WST_UpdateSystem::$pluginWithSlugs;
			$currentPlugin = crazyblog_set( $pluginArray, crazyblog_set( $_POST, 'plugin' ) );
			$pluginFilePath = crazyblog_set( $currentPlugin, 'source' );
			$pluginName = crazyblog_set( $currentPlugin, 'name' );

			$my_plugin = crazyblog_set( $_POST, 'plugin' ) . '/' . crazyblog_set( $_POST, 'plugin' ) . '.php';
			$allPlugins = get_plugins();

			$pluginUrl = '';
			if ( crazyblog_set( $_POST, 'repo' ) == 'true' ) {
				$pluginUrl = _WST_UpdateSystem::crazyblog_plugin_repo_version( crazyblog_set( $_POST, 'plugin' ), true );
			} elseif ( !empty( $pluginFilePath ) ) {
				$pluginUrl = $pluginFilePath;
			} else {
				$pluginUrl = 'http://webinane.com/update/api2/updateplugin/' . crazyblog_set( $_POST, 'plugin' ) . '/' . crazyblog_set( $_POST, 'version' );
			}
			if ( !in_array( 'zip', get_loaded_extensions() ) ) {
				esc_html_e( 'Zip extension not enable, please contact to your hostin provider to enable zip extension', 'crazyblog' );
				return;
			}
			if ( !empty( $pluginUrl ) ) {
				if ( empty( $pluginFilePath ) ) {
					$request = array(
						'httpversion' => '1.0',
						'timeout' => 1000,
						'method' => 'POST',
						'user-agent' => 'PHP-MCAPI/2.0',
						'sslverify' => false,
					);
					if ( crazyblog_set( $_POST, 'repo' ) == 'true' ) {
						$response = wp_remote_get( $pluginUrl, array( 'timeout' => 120, 'httpversion' => '1.1' ) );
						$zipdata = wp_remote_retrieve_body( $response );
					} else {
						$response = wp_remote_post( $pluginUrl, $request );
						$zipdata = wp_remote_retrieve_body( $response );
					}

					$file = crazyblog_set( $_POST, 'plugin' ) . '.zip';
					if ( file_exists( str_replace( '\\', '/', ABSPATH ) . 'wp-content/upgrade/' . $file ) ) {
						unlink( str_replace( '\\', '/', ABSPATH ) . 'wp-content/upgrade/' . $file );
					}
					global $wp_filesystem;
					if ( empty( $wp_filesystem ) ) {
						require_once(ABSPATH . '/wp-admin/includes/file.php');
						WP_Filesystem();
					}
					$wp_filesystem->put_contents( str_replace( '\\', '/', ABSPATH ) . 'wp-content/upgrade/' . $file, $zipdata, 0777 );
					$path = realpath( str_replace( '\\', '/', ABSPATH ) . 'wp-content/plugins/' );
					$zip = new ZipArchive();
					if ( $zip->open( str_replace( '\\', '/', ABSPATH ) . 'wp-content/upgrade/' . $file ) === TRUE ) {
						$zip->extractTo( $path );
						$zip->close();
						unlink( ABSPATH . 'wp-content/upgrade/' . $file );

						$plugins = (get_option( 'active_plugins' )) ? get_option( 'active_plugins' ) : array();
						if ( count( $plugins ) > 0 ) {
							foreach ( $plugins as $plugin ) {
								if ( !in_array( $my_plugin, $plugins ) ) {
									array_push( $plugins, $my_plugin );
									update_option( 'active_plugins', $plugins );
								}
							}
						} else {
							update_option( 'active_plugins', array( $my_plugin ) );
						}
						activate_plugin( $my_plugin );
						echo sprintf( '%s ' . esc_html__( 'has been update and activated.', 'crazyblog' ), $pluginName );
					} else {
						esc_html_e( 'Faild to open Zip Archive', 'crazyblog' );
					}
				} else {
					$path = realpath( str_replace( '\\', '/', ABSPATH ) . 'wp-content/plugins/' );
					$zip = new ZipArchive();
					if ( $zip->open( $pluginFilePath ) === TRUE ) {
						$zip->extractTo( $path );
						$zip->close();

						$plugins = (get_option( 'active_plugins' )) ? get_option( 'active_plugins' ) : array();
						if ( count( $plugins ) > 0 ) {
							foreach ( $plugins as $plugin ) {
								if ( !in_array( $my_plugin, $plugins ) ) {
									array_push( $plugins, $my_plugin );
									update_option( 'active_plugins', $plugins );
								}
							}
						} else {
							update_option( 'active_plugins', array( $my_plugin ) );
						}
						activate_plugin( $my_plugin );
						echo sprintf( '%s ' . esc_html__( 'has been update and activatedd.', 'crazyblog' ), $pluginName );
					} else {
						esc_html_e( 'Faild to open Zip Archive', 'crazyblog' );
					}
				}
			} else {
				esc_html_e( 'Plugin URL not prest', 'crazyblog' );
			}
		}
		exit;
	}

	static public function crazyblog_installDemo() {
		if ( isset( $_POST['action'] ) && $_POST['action'] == 'crazyblog_installDemo' ) {
			$message = array(
				'importer' => _n_noop( 'Please activate the following pligin %1$s before importing demo', 'Please activate the following pligins %1$s before importing demo', 'crazyblog' )
			);
			$pluginArray = (new crazyblog_Plugins )->crazyblog_plugin_list();
			$themePlugin = $checkPlugin = array();
			if ( !empty( $pluginArray ) ) {
				foreach ( $pluginArray as $p ) {
					if ( crazyblog_set( $p, 'required' ) == true ) {
						$themePlugin[crazyblog_set( $p, 'name' )] = crazyblog_set( $p, 'slug' );
					}
				}
			}

			if ( !empty( $themePlugin ) && count( $themePlugin ) > 0 ) {
				foreach ( $themePlugin as $k => $v ) {
					if ( !is_plugin_active( "$v/$v.php" ) ) {
						$checkPlugin[] = $k;
					}
				}
			}

			if ( !empty( $checkPlugin ) && count( $checkPlugin ) > 0 ) {
				$count = count( $checkPlugin );
				$last_plugin = array_pop( $checkPlugin );
				$imploded = empty( $checkPlugin ) ? $last_plugin : ( implode( ', ', $checkPlugin ) . ' ' . esc_html_x( 'and', 'plugin A *and* plugin B', 'crazyblog' ) . ' ' . $last_plugin );
				$msg = sprintf( '%s', sprintf( translate_nooped_plural( $message['importer'], $count, 'carazyblog' ), $imploded, $count ) );
				echo wp_kses( $msg, true );
				exit;
				return false;
			}

			$ext = get_loaded_extensions();
			$id = crazyblog_set( $_POST, 'fileid' );
			$media = (crazyblog_set( $_POST, 'media' ) == 'true') ? true : false;
			$name = crazyblog_set( $_POST, 'name' );
			$url = 'http://webinane.com/update/api2/zipContent/' . $id;
			$request = array(
				'httpversion' => '1.0',
				'timeout' => 1000,
				'method' => 'POST',
				'user-agent' => 'PHP-MCAPI/2.0',
				'sslverify' => false,
			);
			$response = wp_remote_post( $url, $request );
			$zipdata = wp_remote_retrieve_body( $response );
			$file = 'demo.zip';
			global $wp_filesystem;
			if ( empty( $wp_filesystem ) ) {
				require_once(ABSPATH . '/wp-admin/includes/file.php');
				WP_Filesystem();
			}
			$wp_filesystem->mkdir( str_replace( '\\', '/', ABSPATH ) . 'wp-content/webinane' );
			$wp_filesystem->put_contents( str_replace( '\\', '/', ABSPATH ) . 'wp-content/webinane/' . $file, $zipdata, 0777 );

			if ( in_array( 'zip', $ext ) ) {
				$zip = new ZipArchive;
				if ( $zip->open( ABSPATH . 'wp-content/webinane/' . $file ) === TRUE ) {
					$zip->extractTo( ABSPATH . 'wp-content/webinane/' );
					$zip->close();
					unlink( ABSPATH . 'wp-content/webinane/' . $file );
				} else {
					esc_html_e( 'There is some error to extract Demo File', 'crazyblog' );
					exit;
				}
			} else {
				esc_html_e( 'Please Enable ZIP Extension in php.ini', 'crazyblog' );
				exit;
			}


			if ( $media == true ) {
//				if ( is_dir( ABSPATH . 'wp-content/uploads' ) ) {
//					self::crazyblog_delete( ABSPATH . 'wp-content/uploads' );
//				}
				$path = realpath( ABSPATH . 'wp-content/' );
				if ( in_array( 'zip', $ext ) ) {
					$zip = new ZipArchive;
					if ( $zip->open( ABSPATH . 'wp-content/webinane/uploads.zip' ) === TRUE ) {
						$zip->extractTo( $path );
						$zip->close();
						unlink( ABSPATH . 'wp-content/webinane/uploads.zip' );
					} else {
						esc_html_e( 'There is some error to extract Upload File', 'crazyblog' );
						exit;
					}
				} else {
					esc_html_e( 'Please Enable ZIP Extension in php.ini', 'crazyblog' );
					exit;
				}
			}

			if ( file_exists( ABSPATH . 'wp-content/webinane/data.xml' ) ) {
				define( 'WP_LOAD_IMPORTERS', true );
				if ( !class_exists( 'WP_Import' ) ) {
					if ( function_exists( 'crazyblog_wp_importer' ) ) {
						crazyblog_wp_importer();
					}
				}
				$content_xml = ABSPATH . 'wp-content/webinane/data.xml';
				if ( !is_file( $content_xml ) ) {
					esc_html_e( 'Wrong XML File', 'crazyblog' );
					exit;
				} else {
					$importer = new WP_Import();
					$importer->fetch_attachments = $media;
					$importer->import( $content_xml );
					// delete megamenu
					$args = array(
						'post_type' => 'cr_megamenu_profile',
						'nopaging' => true
					);
					$query = new WP_Query( $args );
					if ( $query->have_posts() ) {
						while ( $query->have_posts() ) {
							$query->the_post();
							$id = get_the_ID();
							wp_delete_post( $id, true );
						}
						wp_reset_postdata();
					}
					// delete megamenu
					include_once crazyblog_ROOT . 'core/application/library/import_export.php';
					$importer = new crazyblog_import_export( $name );
					$importer->import();
					self::crazyblgo_rrmdir( realpath( ABSPATH . 'wp-content/webinane' ) );
				}
			}
		}
		exit;
	}

	static public function crazyblog_installTheme() {
		if ( isset( $_POST['action'] ) && $_POST['action'] == 'crazyblog_installTheme' ) {
			if ( is_dir( ABSPATH . 'wp-content/webinane' ) ) {
				self::crazyblog_delete( ABSPATH . 'wp-content/webinane' );
			}
			$ext = get_loaded_extensions();
			$url = 'http://webinane.com/update/api2/themeUpdate/' . ucfirst( APP );
			$request = array(
				'httpversion' => '1.0',
				'timeout' => 1000,
				'method' => 'POST',
				'user-agent' => 'PHP-MCAPI/2.0',
				'sslverify' => false,
			);
			$response = wp_remote_post( $url, $request );
			$zipdata = wp_remote_retrieve_body( $response );
			$file = array_pop( explode( '/', get_template_directory_uri() ) ) . '.zip';
			global $wp_filesystem;
			if ( empty( $wp_filesystem ) ) {
				require_once(ABSPATH . '/wp-admin/includes/file.php');
				WP_Filesystem();
			}
			$wp_filesystem->mkdir( str_replace( '\\', '/', ABSPATH ) . 'wp-content/webinane' );
			$wp_filesystem->put_contents( str_replace( '\\', '/', ABSPATH ) . 'wp-content/webinane/' . $file, $zipdata, 0777 );
			$path = realpath( ABSPATH . 'wp-content/webinane/' );
			if ( in_array( 'zip', $ext ) ) {
				$zip = new ZipArchive;
				if ( $zip->open( ABSPATH . 'wp-content/webinane/' . $file ) === TRUE ) {
					$zip->extractTo( $path );
					$zip->close();
					unlink( ABSPATH . 'wp-content/webinane/' . $file );
					self::crazyblog_updateStylesheet();
					esc_html_e( 'Theme Update Successfully', 'crazyblog' );
					exit;
				} else {
					esc_html_e( 'There is some error to extract Theme File', 'crazyblog' );
					exit;
				}
			} else {
				esc_html_e( 'Please Enable ZIP Extension in php.ini', 'crazyblog' );
				exit;
			}
		}
	}

	static public function crazyblog_updateStylesheet() {
		if ( is_child_theme() === true ) {
			$folder = array_pop( explode( '/', get_stylesheet_directory_uri() ) );
		} else {
			$folder = array_pop( explode( '/', get_template_directory_uri() ) );
		}

		$versionUrl = 'http://webinane.com/update/api2/getThemeVersion/' . ucfirst( APP );
		$versionsParams = array(
			'httpversion' => '1.0',
			'timeout' => 1000,
			'method' => 'POST',
			'user-agent' => 'PHP-MCAPI/2.0',
			'sslverify' => false,
		);
		$sendRequest = wp_remote_post( $versionUrl, $versionsParams );
		$getVersion = wp_remote_retrieve_body( $sendRequest );
		$themeData = wp_get_theme();
		$currentVersion = $themeData->get( 'Version' );
		// start updating style.css
		$contents = '';
		$contents2 = '';

		if ( is_child_theme() === true ) {
			$styleSheet = new SplFileObject( ABSPATH . 'wp-content/themes/' . $folder . '/style.css', 'r' );
			while ( !$styleSheet->eof() ) {
				$contents .= $styleSheet->fgets();
			}
			$styleSheet = null;
			$styleSheet = new SplFileObject( ABSPATH . 'wp-content/themes/' . $folder . '/style.css', 'w+' );
			$line = str_replace( 'Version: ' . $currentVersion, 'Version: ' . $getVersion, $contents );
			if ( function_exists( 'crazyblog_fileWrite' ) ) {
				crazyblog_fileWrite( $styleSheet, $line );
			}
		}
		if ( is_child_theme() === true ) {
			$styleSheet2 = new SplFileObject( ABSPATH . 'wp-content/themes/' . array_pop( explode( '/', get_template_directory_uri() ) ) . '/style.css', 'r' );
		} else {
			$styleSheet2 = new SplFileObject( ABSPATH . 'wp-content/themes/' . $folder . '/style.css', 'r' );
		}
		while ( !$styleSheet2->eof() ) {
			$contents2 .= $styleSheet2->fgets();
		}

		$styleSheet2 = null;
		$styleSheet2 = new SplFileObject( ABSPATH . 'wp-content/themes/' . APP . '/style.css', 'w+' );
		$line = str_replace( 'Version: ' . $currentVersion, 'Version: ' . $getVersion, $contents2 );
		if ( function_exists( 'crazyblog_fileWrite' ) ) {
			crazyblog_fileWrite( $styleSheet2, $line );
		}
		if ( is_child_theme() === true ) {
			$getParent = array_pop( explode( '/', get_template_directory_uri() ) );
			$folder = $getParent;
		}
		self::crazyblog_copy( ABSPATH . 'wp-content/webinane/' . APP, ABSPATH . 'wp-content/themes/' . $folder );
		self::crazyblgo_rrmdir( ABSPATH . 'wp-content/webinane/' );
		// end updtaing style.css
	}

	static public function crazyblog_copy( $src, $dst ) {
		$dir = opendir( $src );
		@mkdir( $dst );
		while ( false !== ( $file = readdir( $dir )) ) {
			if ( ( $file != '.' ) && ( $file != '..' ) ) {
				if ( is_dir( $src . '/' . $file ) ) {
					self::crazyblog_copy( $src . '/' . $file, $dst . '/' . $file );
				} else {
					copy( $src . '/' . $file, $dst . '/' . $file );
				}
			}
		}
		closedir( $dir );
	}

	static public function crazyblog_delete( $path ) {
		if ( is_dir( $path ) === true ) {
			$files = array_diff( scandir( $path ), array( '.', '..' ) );
			foreach ( $files as $file ) {
				self::crazyblog_delete( realpath( $path ) . '/' . $file );
			}
			return rmdir( $path );
		} else if ( is_file( $path ) === true ) {
			return unlink( $path );
		}
		return false;
	}

	static public function crazyblgo_rrmdir( $dir ) {
		if ( is_dir( $dir ) ) {
			$objects = scandir( $dir );
			foreach ( $objects as $object ) {
				if ( $object != "." && $object != ".." ) {
					if ( filetype( $dir . "/" . $object ) == "dir" )
						self::crazyblgo_rrmdir( $dir . "/" . $object );
					else
						unlink( $dir . "/" . $object );
				}
			}
			reset( $objects );
			rmdir( $dir );
		}
	}

	static public function crazyblog_dimissNotice() {
		if ( isset( $_POST['action'] ) && $_POST['action'] == 'crazyblog_dimissNotice' ) {
			$user = crazyblog_set( $_POST, 'user' );
			add_user_meta( $user, 'crazyblog_DismissNotice', 'true', true );
		}
		exit;
	}

}
