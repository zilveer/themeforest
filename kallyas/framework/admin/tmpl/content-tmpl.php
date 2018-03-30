<?php if(! defined('ABSPATH')){ return; } ?>
<div class="zn-about-content-wrapper">

	<div class="zn-about-tabs-wrapper">
		<div class="zn-about-navigation-wrapper">
			<ul class="zn-about-navigation">
				<li class="active"><a href="#zn-about-tab-welcome"> <span class="zn-about-counter">1</span>Welcome</a></li>
				<li><a href="#zn-about-tab-registration"><span class="zn-about-counter">2</span>Theme registration</a></li>
				<li><a href="#zn-about-tab-addons"><span class="zn-about-counter">3</span>Theme addons</a></li>
				<li><a href="#zn-about-tab-dummy_data"><span class="zn-about-counter">4</span>Import Sample data</a></li>
				<li><a href="#zn-about-tab-final"><span class="zn-about-counter">5</span>More info</a></li>
			</ul>
		</div>

		<div class="zn-about-tabs">
			<div class="zn-about-tab active" id="zn-about-tab-welcome">
				<div class="znfb-row">
					<div class="znfb-col-6">
						<h3 class="zn-lead-title" ><?php echo ZN()->theme_data['name']; ?> is now installed and almost ready to be used!</h3>
						<div class="zn-lead-text ">
							<p class="zn-lead-text--larger">This basic quick setup wizard will just configure a few basic settings to get started. <br>It's completely optional and shouldn't take longer than five minutes.</p>
						</div>
					</div>
					<div class="znfb-col-6">

						<h3>Server status:</h3>
						<div class="zn-server-status-wrapper">
							<div class="zn-server-status-row">
								<?php
									$message = '';
									$icon = 'dashicons-yes';
									$color_class = 'zn-system-status-ok';
									$php_version = phpversion();

									if ( version_compare($php_version, '5.2.4', '<') ) {
										$icon = 'dashicons-warning';
										$color_class = 'zn-system-status-notok';
										$message = ' - You are using an outdated PHP version. WordPress requires at least PHP version 5.2.4, altough a version greater than 5.6 is recommended. To learn more, see: <a href="https://wordpress.org/about/requirements/" target="_blank">WordPress requirements.</a>';
									}
								?>

								<div class="zn-server-status-column zn-server-status-column-name">PHP version</div>
								<div class="zn-server-status-column"><span class="zn-server-status-column-icon dashicons-before <?php echo $icon; ?>" title="Your current PHP version."></span></div>
								<div class="zn-server-status-column zn-server-status-column-value <?php echo $color_class; ?>"><?php echo $php_version; ?> <?php echo $message; ?></div>
							</div>
							<div class="zn-server-status-row">
								<?php
									$message = '';
									$icon = 'dashicons-yes';
									$color_class = 'zn-system-status-ok';
									$memory = wp_convert_hr_to_bytes( ini_get('memory_limit') );

									if ( $memory < 64000000 ) {
										$icon = 'dashicons-warning';
										$color_class = 'zn-system-status-notok';
										$message = ' - We recommend setting memory to at least <strong>64MB</strong>. <br /> To import the main demo sample data, <strong>256MB</strong> of memory limit is required. <br /> Please define memory limit in <strong>wp-config.php</strong> file. To learn how, see: <a href="http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP" target="_blank">Increasing memory allocated to PHP.</a>';
									}

								?>

								<div class="zn-server-status-column zn-server-status-column-name">WP memory limit</div>
								<div class="zn-server-status-column"><span class="zn-server-status-column-icon dashicons-before <?php echo $icon; ?>" title="The maximum amount of memory (RAM) that your site can use at one time."></span></div>
								<div class="zn-server-status-column zn-server-status-column-value <?php echo $color_class; ?>"><?php echo size_format( $memory ); ?> <?php echo $message; ?></div>
							</div>
							<div class="zn-server-status-row">

								<?php
									$message = '';
									$icon = 'dashicons-yes';
									$color_class = 'zn-system-status-ok';
									$time_limit = 'Writable';

									$uploads = wp_upload_dir();
									$zn_uploads_dir = trailingslashit( $uploads['basedir'] . '/' );

									if ( ! wp_is_writable($zn_uploads_dir)){
										$icon = 'dashicons-warning';
										$color_class = 'zn-system-status-notok';
										$message = '- It seems that your Uploads folder is not writable.';
										$time_limit = 'Not writable';
									}

								?>

								<div class="zn-server-status-column zn-server-status-column-name">Writable uploads directory</div>
								<div class="zn-server-status-column"><span class="zn-server-status-column-icon dashicons-before <?php echo $icon; ?>" title="The uploads folder needs to be writable in order to create optimized css files and font icons."></span></div>
								<div class="zn-server-status-column zn-server-status-column-value <?php echo $color_class; ?>"><?php echo $time_limit; ?> <?php echo $message; ?></div>
							</div>
							<div class="zn-server-status-row">

								<?php
									$message = '';
									$icon = 'dashicons-yes';
									$color_class = 'zn-system-status-ok';

									$time_limit = @ini_get('max_execution_time');

									if ( $time_limit < 180 && $time_limit != 0 ) {
										$icon = 'dashicons-warning';
										$color_class = 'zn-system-status-notok';
										$message = '- We recommend setting max execution time to at least 180 for importing the sample data. See: <a href="http://codex.wordpress.org/Common_WordPress_Errors#Maximum_execution_time_exceeded" target="_blank">Increasing max execution to PHP</a>';
									}

								?>

								<div class="zn-server-status-column zn-server-status-column-name">PHP Time Limit</div>
								<div class="zn-server-status-column"><span class="zn-server-status-column-icon dashicons-before <?php echo $icon; ?>" title="The amount of time (in seconds) that your site will spend on a single operation before timing out (to avoid server lockups)"></span></div>
								<div class="zn-server-status-column zn-server-status-column-value <?php echo $color_class; ?>"><?php echo $time_limit; ?> <?php echo $message; ?></div>
							</div>
							<div class="zn-server-status-row">

								<?php
									$message = '';
									$icon = 'dashicons-yes';
									$color_class = 'zn-system-status-ok';

									$input_vars = ini_get('max_input_vars');

									if ( $input_vars < 1000 ) {
										$icon = 'dashicons-warning';
										$color_class = 'zn-system-status-notok';
										$message = '- Max input vars limitation will truncate POST data such as menus. See: Increasing max input vars limit. See more info here <a href="'.esc_url('http://sevenspark.com/docs/ubermenu-3/faqs/menu-item-limit').'" target="_blank">See increasing max input vars limit.</a>';
									}

								?>

								<div class="zn-server-status-column zn-server-status-column-name">PHP Max Input Vars</div>
								<div class="zn-server-status-column"><span class="zn-server-status-column-icon dashicons-before <?php echo $icon; ?>" title="The maximum number of variables your server can use for a single function to avoid overloads."></span></div>
								<div class="zn-server-status-column zn-server-status-column-value <?php echo $color_class; ?>"><?php echo $input_vars ?> <?php echo $message; ?></div>
							</div>
							<div class="zn-server-status-row">
								<?php
									// delete_transient( 'zn_server_connection_check' );
									$url = admin_url( 'admin.php?page=zn-about&check_connection=true' );
									$icon = 'dashicons-warning';
									$connection_status = get_transient( 'zn_server_connection_check' );
									$message = '';

									if( 'ok' === $connection_status ){
										$icon = 'dashicons-yes';
									}
									elseif( 'notok' === $connection_status ){
										$icon = 'dashicons-no';
										$message = '<br />It seems that your server cannot connect to Hogash Servers. Some features like demo data import will not work. In order to resolve this, please contact your server administrator and ask them to allow connections to the theme servers.';
									}

								?>


								<div class="zn-server-status-column zn-server-status-column-name">Connection to server</div>
								<div class="zn-server-status-column"><span class="zn-server-status-column-icon dashicons-before dashicons-update <?php echo $icon; ?>" title="If a connection can be established between your current server and <?php echo ZN()->theme_data['name']; ?> servers."></span></div>
								<div class="zn-server-status-column zn-server-status-column-value"><a class="zn-server-status-button zn-about-action zn-action-green" href="<?php echo $url; ?>">Check now</a> <?php echo $message; ?></div>
							</div>
							<div class="zn-server-status-row">
								<?php
									$message = 'Installed';
									$icon = 'dashicons-yes';
									$color_class = 'zn-system-status-ok';

									$time_limit = ini_get('max_execution_time');

									if ( ! class_exists('ZipArchive') ) {
										$icon = 'dashicons-warning';
										$color_class = 'zn-system-status-notok';
										$message = 'Not installed - ZipArchive is required for importing custom icons. Please contact your server administrator and ask them to enable this class.';
									}

								?>


								<div class="zn-server-status-column zn-server-status-column-name">ZipArchive</div>
								<div class="zn-server-status-column"><span class="zn-server-status-column-icon dashicons-before <?php echo $icon; ?>" title="ZipArchive is required for importing demos and custom icons."></span></div>
								<div class="zn-server-status-column zn-server-status-column-value <?php echo $color_class; ?>"><?php echo $message; ?></div>
							</div>
							<div class="zn-server-status-row">

								<?php
									$message = 'OK';
									$icon = 'dashicons-yes';
									$color_class = 'zn-system-status-ok';

									$time_limit = ini_get('max_execution_time');

									if ( defined('WP_DEBUG') && WP_DEBUG ) {
										$icon = 'dashicons-warning';
										$color_class = 'zn-system-status-notok';
										$message = 'We recommend disabling WordPress debugging on your live site.';
									}

								?>

								<div class="zn-server-status-column zn-server-status-column-name">WP Debug Mode</div>
								<div class="zn-server-status-column"><span class="zn-server-status-column-icon dashicons-before <?php echo $icon; ?>" title="Displays whether or not WordPress is in Debug Mode. We recommend disabling debug mode for a live site."></span></div>
								<div class="zn-server-status-column zn-server-status-column-value <?php echo $color_class; ?>"><?php echo $message; ?></div>
							</div>
						</div>
					</div>
				</div>
			</div><!-- /.zn-about-tab -->

			<div class="zn-about-tab" id="zn-about-tab-registration">
				<?php include( FW_PATH .'/admin/tmpl/register-tmpl.php' ); ?>
			</div><!-- /.zn-about-tab -->

			<div class="zn-about-tab" id="zn-about-tab-addons">

				<div class="znfb-row">
					<div class="znfb-col-12">
						<h3 class="zn-lead-title">Install Addons (Optional)</h3>
						<div class="zn-lead-text">
							<p class="zn-lead-text--larger">These are premium and free plugins that have been used in <?php echo ZN()->theme_data['name']; ?> theme for certain functionalities and pages. Unless specified otherwise, most of them are optional and they can be installed later.</p>
						</div>
					</div>
				</div>

				<?php include( FW_PATH .'/admin/inc/addons_manager/ui/tmpl-addons-list.php' ); ?>
			</div><!-- /.zn-about-tab -->

			<div class="zn-about-tab" id="zn-about-tab-dummy_data">
				<?php include( FW_PATH .'/admin/tmpl/dummy_data-tmpl.php' ); ?>
			</div><!-- /.zn-about-tab -->

			<div class="zn-about-tab" id="zn-about-tab-final">
				<div class="znfb-row">
					<div class="znfb-col-12"><h3 class="zn-lead-title " >Awesome! Thanks!</h3></div>
					<div class="znfb-col-6">
						<div class="zn-lead-text ">
							<p class="zn-lead-text--larger">You don't know where to start first? Here are a few useful links:</p>
							<ul>
								<li><a href="<?php echo admin_url( 'admin.php?page=zn_tp_general_options' ); ?>" target="_blank"><?php echo ZN()->theme_data['name']; ?> General Options</a> </li>
								<li><a href="<?php echo admin_url( 'admin.php?page=zn_tp_general_options#header_options' ); ?>" target="_blank">Change Header settings</a> ( <?php echo ZN()->theme_data['name']; ?> options > General settings > Header Options )</li>
								<li><a href="<?php echo admin_url( 'admin.php?page=zn_tp_color_options' ); ?>" target="_blank">Change Site Color settings</a> ( <?php echo ZN()->theme_data['name']; ?> options > Color Options )</li>
								<li><a href="<?php echo site_url(); ?>" target="_blank">Preview site in frontend</a></li>
								<li><a href="<?php echo admin_url( 'post-new.php?post_type=page' ); ?>" target="_blank">Create New Page</a> (and enable the page builder)</li>
								<li><a href="<?php echo site_url('?zn_pb_edit=true'); ?>" target="_blank">Edit HomePage with Page builder</a></li>
							</ul>
							<p>* All links open in new window.</p>
						</div>
					</div>
					<div class="znfb-col-6">
						<div class="zn-lead-text ">
							<p class="zn-lead-text--larger">Or check the documentation:</p>
							<ul>
								<li><a href="<?php echo esc_url('http://support.hogash.com/kallyas-help/'); ?>" target="_blank"><strong><?php echo ZN()->theme_data['name']; ?> Central Documentation HUB</strong></a></li>
								<li><a href="<?php echo esc_url('http://support.hogash.com/kallyas-videos/'); ?>" target="_blank"><?php echo ZN()->theme_data['name']; ?> Video Tutorials</a></li>
								<li><a href="<?php echo esc_url('http://support.hogash.com/documentation_category/kallyas-wordpress-theme/'); ?>" target="_blank"><?php echo ZN()->theme_data['name']; ?> Written Documentation</a></li>
								<li><a href="<?php echo esc_url('http://support.hogash.com/kallyas-help/#eluidb6c09571'); ?>" target="_blank"><?php echo ZN()->theme_data['name']; ?> F.A.Q.</a></li>
								<li><a href="<?php echo esc_url('http://support.hogash.com/support/forum/wordpress-themes/kallyas-wordpress-theme/'); ?>" target="_blank">Support Forums</a></li>
							</ul>
							<p>* All links open in new window.</p>
						</div>
					</div>
					<div class="znfb-col-12">
					</div>
				</div>
			</div><!-- /.zn-about-tab -->

		</div>
	</div>

	<?php if( $this->is_setup ) : ?>
	<div class="zn-about-actions is-first" id="zn-about-actions">
		<div class="zn-about-action zn-about-action-back zn-about-action-nav zn-action--gray" data-to="prev"><i class="dashicons dashicons-arrow-left-alt2"></i> <span>Back to previous step</span></div>
		<div class="zn-about-action zn-about-action-next zn-about-action-nav" data-to="next"><span>Proceed to next step</span> <i class="dashicons dashicons-arrow-right-alt2"></i></div>
	</div>
	<?php endif; ?>
</div>
