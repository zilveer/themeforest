<div class="stripe_top" style="background-color: #b39964"></div>
<div class="wrap about-wrap getbowtied-about-wrap getbowtied-welcome-wrap">

	<?php 
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

		if ( !is_plugin_active('getbowtied-tools/getbowtied-tools.php') ): ?>
			<div class="inner">
				<img src="<?php echo get_template_directory_uri();?>/images/welcome.svg" alt="welcome" />
				<h1>You're almost there!</h1>
				<p>Install the <b>Get Bowtied — Tools</b> plugin to continue the setup. <br/>
				A one-stop spot that enables you to: install/update the plugins coming with the theme,<br/> import demo content and update the theme without leaving the dashboard.</p>
				
				<?php 

					$plugins = TGM_Plugin_Activation::$instance->plugins;
					$item = $plugins['getbowtied-tools'];
					$item['sanitized_plugin'] = $item['name'];

					$installed_plugins = get_plugins();

					/** We need to display the 'Install' hover link */
					if ( ! isset( $installed_plugins['getbowtied-tools/getbowtied-tools.php'] ) && ! isset( $installed_plugins['getbowtied-tools/index.php'] ) ) {
						$actions = array(
							'button' => sprintf(
								'<a href="%1$s" class="button button-primary" title="Install %2$s">Install Now</a>',
								esc_url( wp_nonce_url(
									add_query_arg(
										array(
											'page'          => urlencode( TGM_Plugin_Activation::$instance->menu ),
											'plugin'        => urlencode( $item['slug'] ),
											'plugin_name'   => urlencode( $item['sanitized_plugin'] ),
											'plugin_source' => urlencode( $item['source'] ),
											'tgmpa-install' => 'install-plugin',
										),
										TGM_Plugin_Activation::$instance->get_tgmpa_url()
									),
									'tgmpa-install',
									'tgmpa-nonce'
								) ),
								$item['sanitized_plugin']
							),
						);
					}
					/** We need to display the 'Activate' hover link */
					elseif ( is_plugin_inactive( 'getbowtied-tools/getbowtied-tools.php' ) ) {
						$actions = array(
							'button' => sprintf(
								'<a href="%1$s" class="button button-primary" title="Activate %2$s">Activate</a>',
								esc_url( add_query_arg(
									array(
										'plugin'               => urlencode( $item['slug'] ),
										'tgmpa-activate'       => 'activate-plugin',
										'tgmpa-nonce' 		   => wp_create_nonce( 'tgmpa-activate' ),
									),
									admin_url( 'admin.php?page=tgmpa-install-plugins' )
								) ),
								$item['sanitized_plugin']
							),
						);
					}

					echo $actions['button'];
				?>
				<br/><a href="https://the-retailer-help.zendesk.com/hc/en-us/articles/206693659-Getting-Started" class="video-guide" target="_blank"><span class="dashicons dashicons-video-alt3"></span> <?php echo __("Installation & Setup <span class='dashicons dashicons-minus'></span> Video Guide"); ?></a>
			
			</div>
		<?php endif; ?>
</div>