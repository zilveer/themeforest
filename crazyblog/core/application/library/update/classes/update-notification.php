<?php

class _WST_UpdateNotification {

	static private $type, $name, $interval, $repo, $version;

	public static function _wst_checkUpdate( $type, $name, $repo = false, $version = false ) {
		self::$type = $type;
		self::$name = $name;
		self::$repo = $repo;
		self::$version = $version;
		self::$interval = 24 * 3600;
		return self::_wst_sendPing();
		return self::_wst_sendPingTHeme();
	}

	static public function _wst_sendPing() {
		$pluginData = get_plugin_data( ABSPATH . 'wp-content/plugins/' . self::$name . '/' . self::$name . '.php' );
		if ( self::$repo == 'true' ) {
			$version = _WST_UpdateSystem::crazyblog_plugin_repo_version( self::$name, false );
			if ( self::$version == true ) {
				return $version;
			} else {
				$pluginVersion = crazyblog_set( $pluginData, 'Version' );
				if ( $pluginVersion < $version ) {
					return true;
				} else {
					return false;
				}
			}
		} else {
			$url = 'http://webinane.com/update/api2/check-' . self::$type . '/' . self::$name;
			$request = array(
				'httpversion' => '1.0',
				'timeout' => 1000,
				'method' => 'POST',
				'user-agent' => 'PHP-MCAPI/2.0',
				'sslverify' => false,
			);
			$response = wp_remote_post( $url, $request );
			$maxVal = wp_remote_retrieve_body( $response );
			if ( self::$version == true ) {
				return $maxVal;
			} else {
				$pluginVersion = crazyblog_set( $pluginData, 'Version' );
				if ( $pluginVersion < $maxVal ) {
					return true;
				} else {
					return false;
				}
			}
		}
	}

	static public function _wst_sendPingTHeme() {
		$data = wp_get_theme();
		$url = 'http://webinane.com/update/api2/getThemeVersion/' . ucfirst( APP );
		$request = array(
			'httpversion' => '1.0',
			'timeout' => 1000,
			'method' => 'POST',
			'user-agent' => 'PHP-MCAPI/2.0',
			'sslverify' => false,
		);
		$response = wp_remote_post( $url, $request );
		$version = wp_remote_retrieve_body( $response );
		if ( version_compare( $version, $data->get( 'Version' ), '>' ) ) {
			add_action( 'admin_enqueue_scripts', array( __CLASS__, '_wst_themeUpdateStyle' ) );
			$currentPage = crazyblog_set( $_GET, 'page' );
			if ( $currentPage != 'webinane-theme-update' ) {
				add_action( 'admin_notices', array( __CLASS__, '_wst_themeUpdateNotice' ) );
			}
			add_action( 'admin_menu', array( __CLASS__, '_wst_addUpdatePage' ) );
			add_action( 'admin_bar_menu', array( __CLASS__, 'crazyblog_toolbar_link_to_mypage' ), 999 );
			add_action( 'admin_menu', array( __CLASS__, 'crazyblog_addUpdateMenuCounter' ) );
		}
	}

	static public function crazyblog_addUpdateMenuCounter() {
		global $menu, $submenu;
		$counter = wp_get_update_data();
		$increase = crazyblog_set( crazyblog_set( $counter, 'counts' ), 'total' ) + 1;
		foreach ( $menu as $key => $value ) {
			if ( $menu[$key][2] == 'index.php' ) {
				$menu[$key][0] .= "<span class='update-plugins'><span class='update-count'>" . number_format_i18n( $increase ) . "</span></span>";
				return;
			}
		}
	}

	static public function crazyblog_toolbar_link_to_mypage( $wp_admin_bar ) {
		$args = array(
			'id' => 'webinane-theme-update',
			'title' => sprintf( esc_html__( "%s Update", 'crazyblog' ), TH ),
			'href' => admin_url( 'index.php?page=webinane-theme-update' ),
			'meta' => array( 'class' => 'webinane-update-notify' )
		);
		$wp_admin_bar->add_node( $args );
	}

	static public function _wst_addUpdatePage() {
		if ( function_exists( 'crazyblog_themeUpdateStuatus' ) ) {
			crazyblog_themeUpdateStuatus( array( __CLASS__, '_wst_updatePage' ) );
		}
	}

	static public function _wst_themeUpdateNotice() {
		?>
		<div class="updated notice is-dismissible">
			<p><?php echo sprintf( esc_html__( 'There is a new theme update. Goto %s', 'crazyblog' ), '<a href = "' . admin_url( 'index.php?page=webinane-theme-update' ) . '">' . esc_html__( 'Update Theme', 'crazyblog' ) . '</a>' ); ?></p>
		</div>
		<?php
	}

	static public function _wst_updatePage() {
		$data = wp_get_theme();
		?>
		<div class="wrap2">
			<div class="page-wraper"></div>
			<div class="popup-wrapper">
				<div class="popup-content">
					<div class="theme-popup">
						<div class="popup-inner">
							<span class="close-btn">X</span>
							<p id="response-data"></p>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="theme-update">
							<div class="theme-thumb">
								<img src="<?php echo get_template_directory_uri() ?>/screenshot.png" alt="" />
							</div>
							<div class="theme-detail">
								<div class="theme-title">
									<h4><?php echo $data->get( 'Name' ) ?></h4>
								</div>
								<p><?php echo $data->get( 'Description' ) ?></p>
								<a href="javascript:void(0)" title="" class="update-btn themeUpdate">
									<?php esc_html_e( 'Update Theme ', 'crazyblog' ) ?>
									<i style="display: none;"><img src="<?php echo crazyblog_URI ?>core/application/library/update/assets/images/loader.svg" /></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
		    jQuery(document).ready(function ($) {
		        $('a.themeUpdate').live('click', function () {
		            var data = 'action=crazyblog_installTheme';
		            jQuery.ajax({
		                type: "post",
		                url: ajaxurl,
		                data: data,
		                beforeSend: function () {
		                    $(this).prop('disabled', true);
		                    $('div.page-wraper').fadeIn('slow');
		                    $('a.themeUpdate').children('i').fadeIn('slow');
		                },
		                success: function (response) {
		                    $(this).prop('disabled', false);
		                    $('div.page-wraper').fadeOut('slow');
		                    $('a.themeUpdate').children('i').fadeOut('slow');
		                    $('div.popup-wrapper p#response-data').empty();
		                    $('div.popup-wrapper').fadeIn('slow');
		                    $('div.popup-wrapper p#response-data').html(response);
		                    if (response.indexOf('Theme Update Successfully') > 0) {
		                        window.location.href = dashbord;
		                    }
		                }
		            });
		            return false;
		        });
		    });
		</script>
		<?php
	}

	static public function _wst_themeUpdateStyle() {
		echo '<script type="text/javascript"> var dashbord="' . admin_url( 'index.php' ) . '";</script>';
		$styles = array(
			'theme-update-style' => 'css/theme-update.css',
			'theme-update-responsive' => 'css/theme-update-responsive.css'
		);
		foreach ( $styles as $name => $style ) {
			$file = crazyblog_URI . 'core/application/library/update/assets/' . $style;
			wp_enqueue_style( 'wst-' . $name, $file, array(), '', 'all' );
		}
	}

}
