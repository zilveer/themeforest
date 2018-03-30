<?php
$plugins = new crazyblog_Plugins();
$info = $plugins->_wst_extensionInfo();
$list = $plugins->crazyblog_plugin_list();
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
	<div class="main-div">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="title-sec">
						<h1><?php echo esc_html( crazyblog_set( $info, 'title' ) ) ?></h1>
						<p><?php echo esc_html( crazyblog_set( $info, 'desc' ) ) ?></p>
					</div>
					<div class="extensions-sec">
						<div class="row">
							<?php
							if ( !empty( $list ) ) {
								foreach ( $list as $l ) {
									$repo = (crazyblog_set( $l, 'repo' ) == true) ? _WST_UpdateSystem::crazyblog_plugin_repo_version( crazyblog_set( $l, 'slug' ) ) : '';
									$isRepo = (crazyblog_set( $l, 'repo' ) == true) ? 'true' : 'false';
									$chkFile = crazyblog_set( $l, 'slug' ) . '/' . crazyblog_set( $l, 'slug' ) . '.php';
									$check = is_plugin_active( $chkFile );
									$activePlugins = get_plugins();
									if ( array_key_exists( $chkFile, $activePlugins ) ) {
										$pluginData = get_plugin_data( ABSPATH . 'wp-content/plugins/' . $chkFile );
									} else {
										$pluginData = '';
									}
									if ( $check ) {
										$btnClass = 'active';
										$btnText = esc_html__( 'Activated', 'crazyblog' );
										$img = '<img src="' . crazyblog_URI . 'core/application/library/update/assets/images/active-img.png" alt="" />';
										$v = '';
										$disable = 'disabled';
										$u = '';
									} else if ( !$check && array_key_exists( $chkFile, $activePlugins ) ) {
										$btnClass = 'not-active';
										$btnText = esc_html__( 'Installed But Not Active', 'crazyblog' );
										$img = '<img src="' . crazyblog_URI . 'core/application/library/update/assets/images/notinstall-img.png" alt="" />';
										$v = '';
										$disable = '';
										$u = '';
									} else if ( !array_key_exists( $chkFile, $activePlugins ) ) {
										$btnClass = 'not-install';
										$btnText = esc_html__( 'Not Installed', 'crazyblog' );
										$img = '<img src="' . crazyblog_URI . 'core/application/library/update/assets/images/installnot-active-img.png" alt="" />';
										$v = '';
										$disable = '';
										$u = '';
									}
									if ( $check && _WST_UpdateNotification::_wst_checkUpdate( 'plugin', crazyblog_set( $l, 'slug' ), crazyblog_set( $l, 'repo' ) ) === true ) {
										$getVersion = _WST_UpdateNotification::_wst_checkUpdate( 'plugin', crazyblog_set( $l, 'slug' ), crazyblog_set( $l, 'repo' ), true );
										$btnClass = 'update';
										$btnText = esc_html__( 'Update Available', 'crazyblog' );
										$v = '<span class="update-v">' . esc_html__( 'Ver', 'crazyblog' ) . ' ' . $getVersion . '</span>';
										$img = '<img src="' . crazyblog_URI . 'core/application/library/update/assets/images/update-img.png" alt="" />';
										$disable = '';
										$u = $getVersion;
									}
									?>
									<div class="col-md-4">
										<div class="extention">
											<div class="extention-top" style="background: url(<?php echo esc_url( crazyblog_set( $l, 'bg_url' ) ) ?>) no-repeat center / cover;">
												<?php echo wp_kses_post( $v ) ?>
												<i class="fixed-v">
													<?php
													esc_html_e( 'Ver ', 'crazyblog' );
													if ( !empty( $repo ) ) {
														echo esc_html( $repo );
													} else {
														if ( $check ) {
															echo esc_attr( crazyblog_set( $pluginData, 'Version' ) );
														} else {
															echo esc_attr( crazyblog_set( $l, 'version' ) );
														}
													}
													?>
												</i>
												<div class="icon">
													<img src="<?php echo esc_url( crazyblog_set( $l, 'img_url' ) ) ?>" alt="" />
												</div>
											</div>
											<div class="extention-mid">
												<h2><?php echo esc_attr( crazyblog_set( $l, 'name' ) ) ?></h2>
												<i>
													<?php
													esc_html_e( 'By ', 'crazyblog' );
													echo esc_attr( crazyblog_set( $l, 'plugin_author' ) );
													?>
												</i>
												<p><?php echo esc_attr( crazyblog_set( $l, 'plugin_desc' ) ) ?></p>
											</div>
											<ul class="extention-bottom">
												<li>
													<button data-version="<?php echo esc_attr( $u ) ?>" data-repo="<?php echo esc_attr( $isRepo ) ?>" data-slug="<?php echo esc_attr( crazyblog_set( $l, 'slug' ) ) ?>" class="<?php echo esc_attr( $btnClass ) ?>" <?php echo esc_attr( $disable ) ?>>
														<?php echo wp_kses_post( $img ) ?>
														<span><?php echo esc_html( $btnText ) ?></span>
														<i style="display: none;"><img src="<?php echo crazyblog_URI ?>core/application/library/update/assets/images/loader.svg" /></i>
													</button>
												</li>
											</ul>
										</div>
									</div>
									<?php
								}
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>