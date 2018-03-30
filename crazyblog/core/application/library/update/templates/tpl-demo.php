<?php
$plugins = new crazyblog_Plugins();
$info = $plugins->_wst_extensionInfo();
$list = $plugins->crazyblog_plugin_list();


$url = 'http://webinane.com/update/api2/demoList/' . APP;
$request = array(
	'httpversion' => '1.0',
	'timeout' => 1000,
	'method' => 'POST',
	'user-agent' => 'PHP-MCAPI/2.0',
	'sslverify' => false,
);
$response = wp_remote_post( $url, $request );
$getResponse = wp_remote_retrieve_body( $response );
$list = json_decode( $getResponse );
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
					<div class="extensions-sec">
						<div class="row">
							<?php
							if ( !empty( $list ) ) {
								foreach ( $list as $demo ) {
									$bg = '';
									switch ( strtolower( crazyblog_set( $demo, 'name' ) ) ) {
										case "cars":
											$bg = '<img src="' . esc_url( crazyblog_URI . 'core/application/library/update/assets/images/demo/cars.jpg' ) . '" />';
											break;
										case "cars-new":
											$bg = '<img src="' . esc_url( crazyblog_URI . 'core/application/library/update/assets/images/demo/cars-new.jpg' ) . '" />';
											break;
										case "crazyblog":
											$bg = '<img src="' . esc_url( crazyblog_URI . 'core/application/library/update/assets/images/demo/main-demo.jpg' ) . '" />';
											break;
										case "creative":
											$bg = '<img src="' . esc_url( crazyblog_URI . 'core/application/library/update/assets/images/demo/creative.jpg' ) . '" />';
											break;
										case "fashion":
											$bg = '<img src="' . esc_url( crazyblog_URI . 'core/application/library/update/assets/images/demo/fashion.jpg' ) . '" />';
											break;
										case "magazine":
											$bg = '<img src="' . esc_url( crazyblog_URI . 'core/application/library/update/assets/images/demo/magazine.jpg' ) . '" />';
											break;
										case "personal-store":
											$bg = '<img src="' . esc_url( crazyblog_URI . 'core/application/library/update/assets/images/demo/personal-store.jpg' ) . '" />';
											break;
										case "recipes":
											$bg = '<img src="' . esc_url( crazyblog_URI . 'core/application/library/update/assets/images/demo/recipes.jpg' ) . '" />';
											break;
										case "travel":
											$bg = '<img src="' . esc_url( crazyblog_URI . 'core/application/library/update/assets/images/demo/travel.jpg' ) . '" />';
											break;
									}
									?>
									<div class="col-md-4">
										<div class="parent">
											<div class="extention">
												<div class="bg"><?php echo wp_kses( $bg, true ) ?></div>
												<div class="extention-detail">
													<h4><?php echo esc_html( ucwords( str_replace( '-', ' ', crazyblog_set( $demo, 'name' ) ) ) ) ?></h4>
												</div>
											</div>
											<div class="extention-bottom2">
												<span>
													<input id="download_media" type="checkbox" />
													<label><?php esc_html_e( 'Download Media', 'crazyblog' ) ?></label>
												</span>
												<ul class="extention-bottom">
													<li>
														<button id="demo-importer" data-name="<?php echo esc_attr( crazyblog_set( $demo, 'name' ) ) ?>" data-id="<?php echo esc_attr( crazyblog_set( $demo, 'ID' ) ) ?>" class="not-install">
															<?php esc_html_e( 'Import Demo', 'crazyblog' ) ?>
															<i style="display: none;"><img src="<?php echo crazyblog_URI ?>core/application/library/update/assets/images/loader.svg" /></i>
														</button>
													</li>
												</ul>
											</div>
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