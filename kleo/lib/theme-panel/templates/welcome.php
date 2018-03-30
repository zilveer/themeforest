<div class="clear"></div>
<div class="theme-panel">

	<div class="cd-tabs">

		<div class="page-title">
			<?php esc_html_e( "KLEO THEME", 'kleo_framework' );?>
			<div class="theme-version"><?php esc_html_e( "Version", 'kleo_framework' );?> <?php echo KLEO_THEME_VERSION; ?></div>
		</div>

		<nav>
			<ul class="cd-tabs-navigation">
				<li><a data-content="welcome" class="selected" href="#welcome"><span class="count-tab">1</span> Welcome</a></li>
				<li><a data-content="registration" href="#registration"><span class="count-tab">2</span> Registration</a></li>
				<li><a data-content="addons" href="#addons"><span class="count-tab">3</span> Theme Addons</a></li>
				<li><a data-content="demo-data" href="#demo-data"><span class="count-tab">4</span> Import Demo Data</a></li>
				<li><a data-content="extras" href="#extras"><span class="count-tab">5</span> Extras</a></li>
			</ul> <!-- cd-tabs-navigation -->
		</nav>

		<ul class="cd-tabs-content">
			<li data-content="welcome" class="selected">

				<div class="sq-row">

					<div class="sq-col-6">
						<h3 class="sq-lead-title">Hello and thanks for using KLEO theme</h3>
						
						<p>We are supper happy that you are now part of our community.<br>
							Please follow the steps on this page to setup your theme. It is totally optional but it will greatly help you get started with KLEO.</p>
						<p>After you went through the above steps, make sure to also check the advanced <strong><a href="<?php echo admin_url('admin.php?page=kleo_options');?>">Theme options</a></strong></p>
					</div>

					<div class="sq-col-6">

						<h3>Server status:</h3>
						<div class="sq-sstatus-wrapper">

							<?php
							$statuses = array();

							//writable directory
							global $kleo_config;
							$icon = 'dashicons-yes';
							$color_class = 'sq-sstatus-ok';
							$message = 'Uploads folder is writable';

							if ( ! is_writable( trailingslashit( $kleo_config['upload_basedir'] ) ) ) {
								$icon = 'dashicons-warning';
								$color_class = 'sq-sstatus-notok';
								$message = 'Uploads folder is not writable. Please check with your hosting provider.';
							}

							$statuses[] = array(
								'name' => 'File permissions',
								'title' => 'Server PHP version',
								'icon' => $icon,
								'color_class' => $color_class,
								'message' => $message

							);

							//php version
							$icon = 'dashicons-yes';
							$color_class = 'sq-sstatus-ok';
							$php_version = phpversion();
							$message = 'v. ' . $php_version;

							if ( version_compare($php_version, '5.3', '<') ) {
								$icon = 'dashicons-warning';
								$color_class = 'sq-sstatus-notok';
								$message = ' - You are using an outdated PHP version. A version greater than 5.6 is recommended.';
							}

							$statuses[] = array(
								'name' => 'PHP version',
								'title' => 'Server PHP version',
								'icon' => $icon,
								'color_class' => $color_class,
								'message' => $message

							);


							//Memory limit
							$icon = 'dashicons-yes';
							$color_class = 'sq-sstatus-ok';
							$memory = wp_convert_hr_to_bytes( ini_get('memory_limit') );
							$message = size_format( $memory );

							if ( $memory < 64000000 ) {
								$icon = 'dashicons-warning';
								$color_class = 'sq-sstatus-notok';
								$message .= ' - We recommend setting memory at <strong>128MB</strong>. <br /> To import all demo sample data, <strong>256MB</strong> of memory limit is required. <br /> See how to <a href="http://seventhqueen.com/blog/code-snippets/increase-php-memory-limit-in-wordpress.html" target="_blank">increase memory allocated to PHP.</a>';
							}

							$statuses[] = array(
								'name' => 'PHP Memory limit',
								'title' => 'The maximum amount of memory (RAM) that your site can use at one time',
								'icon' => $icon,
								'color_class' => $color_class,
								'message' => $message

							);


							//max execution time
							$message = '';
							$icon = 'dashicons-yes';
							$color_class = 'sq-sstatus-ok';

							$time_limit = @ini_get('max_execution_time');
							$message = $time_limit;

							if ( $time_limit < 180 && $time_limit != 0 ) {
								$icon = 'dashicons-warning';
								$color_class = 'sq-sstatus-notok';
								$message .= ' - We recommend setting max execution time to at least 180 for importing the sample data. See: <a href="http://codex.wordpress.org/Common_WordPress_Errors#Maximum_execution_time_exceeded" target="_blank">Increasing max execution to PHP</a>';
							}

							$statuses[] = array(
								'name' => 'PHP Time limit',
								'title' => 'The amount of time (in seconds) that your site will spend on a single operation before timing out',
								'icon' => $icon,
								'color_class' => $color_class,
								'message' => $message
							);

							//max input vars
							$icon = 'dashicons-yes';
							$color_class = 'sq-sstatus-ok';
							$input_vars = ini_get('max_input_vars');

							$message = $input_vars;

							if ( $input_vars < 1000 ) {
								$icon = 'dashicons-warning';
								$color_class = 'sq-sstatus-notok';
								$message .= ' - Max input vars limitation will truncate POST data such as menus. See: Increasing max input vars limit. See more info here <a href="'.esc_url('http://sevenspark.com/docs/ubermenu-3/faqs/menu-item-limit').'" target="_blank">See increasing max input vars limit.</a>';
							}

							$statuses[] = array(
								'name' => 'PHP Max Input Vars',
								'title' => 'The maximum number of variables your server can use for a single function to avoid overloads',
								'icon' => $icon,
								'color_class' => $color_class,
								'message' => $message
							);

							//zipArchive
							$message = 'Installed';
							$icon = 'dashicons-yes';
							$color_class = 'sq-sstatus-ok';

							if ( ! class_exists('ZipArchive') ) {
								$icon = 'dashicons-warning';
								$color_class = 'sq-sstatus-notok';
								$message = 'Not installed - ZipArchive is required for importing content. Please contact your server administrator and ask them to enable it.';
							}

							$statuses[] = array(
								'name' => 'ZipArchive',
								'title' => 'ZipArchive is required for importing demos and WordPress content',
								'icon' => $icon,
								'color_class' => $color_class,
								'message' => $message
							);

							// WP DEBUG MODE
							$message = 'OK - DEBUG is OFF';
							$icon = 'dashicons-yes';
							$color_class = 'sq-sstatus-ok';

							if ( defined('WP_DEBUG') && WP_DEBUG === TRUE ) {
								$icon = 'dashicons-warning';
								$color_class = 'sq-sstatus-notok';
								$message = 'DEBUG is ON - We recommend disabling WordPress debugging on your live site.';
							}

							$statuses[] = array(
								'name' => 'WP Debug',
								'title' => 'Displays whether or not WordPress is in Debug Mode. We recommend disabling debug mode for a live site',
								'icon' => $icon,
								'color_class' => $color_class,
								'message' => $message
							);

							?>

							<?php foreach ( $statuses as $status ) : ?>

								<div class="sq-sstatus-row">
									<div class="sq-sstatus-col sq-sstatus-col-name"><?php echo $status['name']; ?></div>
									<div class="sq-sstatus-col"><span class="sq-sstatus-col-icon tooltip-me dashicons-before <?php echo $status['icon']; ?>" title="<?php echo $status['title'];?>"></span></div>
									<div class="sq-sstatus-col sq-sstatus-col-value <?php echo $status['color_class']; ?>"><?php echo $status['message']; ?></div>
								</div>

							<?php endforeach; ?>

						</div>
					</div>

				</div>


			</li>

			<li data-content="registration">
				<div class="sq-row">
					<div class="sq-col-7">
						<h3 class="sq-lead-title">Register your theme for automatic updates</h3>
						<div class="sq-lead-text">
							<p>We strongly recommend you to register your theme. You will get automatic updates and notifications as well.</p>
							<p><strong>All you have to do is to follow these steps:</strong></p>
							<ul class="decimal-style">
								<li>Enter your ThemeForest username.</li>
								<li>Generate an API key on ThemeForest and enter it. <a target="_blank" href="http://seventhqueen.com/support/general/article/how-to-get-themeforest-api-key">How to get my API key?</a></li>
								<li>Hit REGISTER button.</li>
							</ul>
						</div>
					</div>

					<div class="sq-col-5">
						<?php
						$tf_username  = sq_option('tf_username', '');
						$tf_api       = sq_option('tf_apikey', '');
						?>
						<form action="<?php echo admin_url('themes.php?page=' . SQ_Panel::getInstance()->slug );?>#registration" class="sq-panel-register-form">
							<div class="sq-panel-form-field">
								<label for="tf_username">Themeforest Username</label>
								<input type="text" id="tf_username" class="sq-panel-register-form-username" value="<?php echo $tf_username;?>" placeholder="Themeforest username">
							</div>
							<div class="sq-panel-form-field">
								<label for="tf_apikey">Themeforest API key</label>
								<input type="text" id="tf_apikey" name="tf_apikey" class="sq-panel-register-form-api" value="<?php echo $tf_api;?>" placeholder="Themeforest API key">
							</div>

							<div class="response-area hidden"></div>

							<?php wp_nonce_field( 'sq_theme_registration', 'sq_nonce' ); ?>
							<input type="submit" class="sq-panel-register-form-submit sq-panel-action sq-action-green sq-action-md" value="REGISTER">
						</form>
					</div>
				</div>
			</li>

			<li data-content="addons">

				<h3 class="sq-lead-title">Install Addons</h3>
				<div class="wq-lead-text">
					<p>There are required plugins that are needed for Kleo to properly function and also options extensions.
						KLEO needs only K-elements and Visual composer to run and all the other plugins are needed if you want a certain functionality</p>
				</div>

				<div class="sq-extensions-list">
					<?php
					foreach ( SQ_Addons_Manager()->plugins as $plugin ) : ?>

						<?php
						$plugin_status = SQ_Addons_Manager()->get_plugin_status( $plugin['slug'] );

						$button = '<a class="sq-extension-button"' .
						          ' data-action="' . $plugin_status['action'] . '"' .
						          ' data-status="' . $plugin_status['status'].'"' .
						          ' data-nonce="' . wp_create_nonce( 'sq_plugins_nonce' ) . '"' .
						          ' href="#"' .
						          ' data-slug="'.$plugin['slug'].'">' . 
						          $plugin_status['action_text'] . 
					          '</a>';
						?>
						<div class="sq-extension <?php echo $plugin_status['status']; ?>" id="ext-<?php echo $plugin['slug']; ?>">
							<div class="sq-extension-inner">
								<div class="sq-extension-info">
									<h4 class="sq-extension-title"><?php echo $plugin['name']; ?></h4>
									<span class="sq-extension-status"><?php echo $plugin_status['status_text']; ?></span>
									<p class="sq-extension-desc"><?php echo isset($plugin['description']) ? $plugin['description'] : '' ; ?></p>
									<p class="sq-extension-extra"><cite><?php echo ( isset($plugin['required']) && $plugin['required'] == true ) ? 'REQUIRED' : 'Optional'; ?></cite></p>
									<p class="sq-extension-ajax-text"></p>
								</div>
								<div class="sq-extension-actions"><?php echo $button; ?></div>
							</div>

						</div>
					<?php endforeach; ?>
				</div>
			</li>

			<li data-content="demo-data">

				<?php

				$kleoImport = kleoImport::getInstance();
				$kleoImport->show_message();

				?>

				<form class="kleo-import-form" action="" method="post" onSubmit="if(!confirm('Really import the data?')){return false;}">

					<input type="hidden" name="kleo_import_nonce" value="<?php echo wp_create_nonce( 'import_nonce' ); ?>" />
					<?php
					$kleoImport->generate_boxes_css();
					$kleoImport->generate_boxes_html();
					?>
				</form>
				
			</li>

			<li data-content="extras">
				<div class="sq-row">
					<div class="sq-col-6">
						<p>Check out these theme sections too:</p>
						<ul>
							<li><a href="<?php echo admin_url('admin.php?page=kleo_options');?>" target="_blank">Theme options</a> - Manage theme settings</li>
							<li><a href="<?php echo admin_url('customize.php');?>" target="_blank">Customizer </a> - Live preview colors changes</li>
							<li><a href="<?php echo admin_url('themes.php?page=multiple_sidebars');?>" target="_blank">Custom sidebars</a> - Add edit sidebars</li>
							<li><a href="<?php echo admin_url('themes.php?page=install-required-plugins');?>" target="_blank">Add-ons manager</a> - Recommended plugins page</li>
							<li><a href="<?php echo admin_url('themes.php?page=kleo_import');?>" target="_blank">Import demo</a> - Demo pages importer</li>
						</ul>
					</div>
					<div class="sq-col-6">
						<p>Some useful links:</p>
						<ul>
							<li><a href="http://seventhqueen.com/support/kleo" target="_blank">Support site</a></li>
							<li><a href="http://seventhqueen.com/support/documentation/kleo" target="_blank">Documentation</a></li>
							<li><a href="http://seventhqueen.com/support/kleo/video-tutorials" target="_blank">Video Articles</a></li>
							<li><a href="https://www.youtube.com/watch?v=e1fLpukxW5s&list=PLLLQcfCN3GmOcITcMDOdx_IC8VKizIekD" target="_blank">Youtube channel</a></li>
							<li><a href="https://www.facebook.com/groups/786011184844608/" target="_blank">Facebook Community</a></li>
						</ul>
					</div>
			</li>
		</ul> <!-- cd-tabs-content -->
	</div> <!-- cd-tabs -->
	
</div>


<style>
	#wpcontent {
		background-color: #fff;
	}
	.update-nag,
	.notice,
	#message.updated,
	#setting-error-tgmpa {
		display: none;
	}
</style>