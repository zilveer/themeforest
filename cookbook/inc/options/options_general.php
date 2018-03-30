<div class="wrap">

		<div id="icon-themes" class="icon32"></div>

		<h2><?php printf( "%s %s - %s", esc_attr(wp_get_theme()->Name), esc_attr(__("Settings", "loc_canon")), esc_attr(__("General", "loc_canon")) ); ?></h2>

		<?php 
			//delete_option('canon_options');
			$canon_options = get_option('canon_options'); 

			//detect dev
			$dev = (isset($_GET['dev'])) ? $_GET['dev'] : "false";

			// var_dump($canon_options);

		?>

		<br>
		
		<div class="options_wrapper canon-options">
		
			<div class="table_container">

				<form method="post" action="options.php" enctype="multipart/form-data">
					<?php settings_fields('group_canon_options'); ?>				<!-- very important to add these two functions as they mediate what wordpress generates automatically from the functions.php -->
					<?php do_settings_sections('handle_canon_options'); ?>		


					<?php submit_button(); ?>

					<!-- 

						INDEX

						GENERAL 
						MAIN SEARCH AUTOCOMPLETE
						COMPATIBILITY

					-->

					<!-- 
					--------------------------------------------------------------------------
						GENERAL 
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("General", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php
								
								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Use responsive design', 'loc_canon'),
									'content' 				=> array(
										__('Responsive design changes the way your site looks depending on the browser size. This is done to optimize the viewing experience on different devices.', 'loc_canon'),
										__('Turning off responsive design will make the site look the same across all devices and browser sizes.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Use boxed design', 'loc_canon'),
									'content' 				=> array(
										__('Use boxed design for site layout. Otherwise site will display in full width layout.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Maintenance mode', 'loc_canon'),
									'content' 				=> array(
										__('Activating maintenance mode will mean that only logged in users can see the content of your site.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Maintenance mode title', 'loc_canon'),
									'content' 				=> array(
										__('The title that will be displayed to visitors when in maintenance mode.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Maintenance mode message', 'loc_canon'),
									'content' 				=> array(
										__('The message that will be displayed to visitors when in maintenance mode. Accepts HTML and shortcodes.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> __('Favicon URL', 'loc_canon'),
									'content' 				=> array(
										__('Enter a complete URL to the image you want to use or', 'loc_canon'),
										__('Click the "Upload" button, upload an image and make sure you click the "Use as favicon" button or', 'loc_canon'),
										__('Click the "Upload" button and choose an image from the media library tab. Make sure you click the "Use as favicon" button.', 'loc_canon'),
										__('If you leave the URL text field empty the default favicon will be displayed.', 'loc_canon'),
										__('Remember to save your changes.', 'loc_canon'),
									),
								)); 

							?>			

						</div>

						<table class='form-table'>

							<?php 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Use responsive design', 'loc_canon'),
									'slug' 					=> 'use_responsive_design',
									'options_name'			=> 'canon_options',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Use boxed design', 'loc_canon'),
									'slug' 					=> 'use_boxed_design',
									'options_name'			=> 'canon_options',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Maintenance mode', 'loc_canon'),
									'postfix'				=> __('<i>(Warning: only logged-in users will be able to see your site pages.)</i>', 'loc_canon'),
									'slug' 					=> 'use_maintenance_mode',
									'options_name'			=> 'canon_options',
								)); 

								fw_option(array(
									'type'					=> 'text',
									'title' 				=> __('Maintenance mode title', 'loc_canon'),
									'slug' 					=> 'maintenance_title',
									'class'					=> 'widefat',
									'options_name'			=> 'canon_options',
								)); 

								fw_option(array(
									'type'					=> 'textarea',
									'title' 				=> __('Maintenance mode message', 'loc_canon'),
									'slug' 					=> 'maintenance_msg',
									'rows'					=> '5',
									'options_name'			=> 'canon_options',
								)); 

								fw_option(array(
									'type'					=> 'upload',
									'title' 				=> __('Favicon URL', 'loc_canon'),
									'slug' 					=> 'favicon_url',
									'btn_text'				=> 'Upload favicon',
									'options_name'			=> 'canon_options',
								)); 

								if ($dev === "true") {

									fw_option(array(
										'type'					=> 'checkbox',
										'title' 				=> __('Developer mode', 'loc_canon'),
										'slug' 					=> 'dev_mode',
										'options_name'			=> 'canon_options',
									)); 
										
								} else {
								?>
									<input type="hidden" name="canon_options[dev_mode]" value="<?php echo esc_attr($canon_options['dev_mode']); ?>" />
								<?php
								}

							 ?>		

						</table>

					<!-- 
					--------------------------------------------------------------------------
						MAIN SEARCH AUTOCOMPLETE
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Main Search Autocomplete", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Search words', 'loc_canon'),
									'content' 				=> array(
										__('When typing a search term in the main search box the autocomplete function will make search suggestions.', 'loc_canon'),
										__('Enter words or phrases to give as search suggestions. Separate terms with a comma.', 'loc_canon'),
									),
								)); 

							?>

						</div>

						<table class='form-table'>

							<?php 

								fw_option(array(
									'type'					=> 'textarea',
									'title' 				=> __('Suggest these words', 'loc_canon'),
									'slug' 					=> 'autocomplete_words',
									'rows'					=> '5',
									'options_name'			=> 'canon_options',
								)); 

							?>

						</table>


					<!-- 
					--------------------------------------------------------------------------
						COMPATIBILITY
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Compatibility", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Suppress theme meta description', 'loc_canon'),
									'content' 				=> array(
										__('If using a 3rd party SEO plugin the theme meta description can sometimes interfere with the plugin meta description.', 'loc_canon'),
										__('Use this option to suppress the theme meta description and use the plugin meta description instead.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Suppress theme Open Graph data', 'loc_canon'),
									'content' 				=> array(
										__('Open Graph is a protocol used by Facebook to gather information about your site that can be utilized when sharing content on Facebook.', 'loc_canon'),
										__('If using a 3rd party SEO plugin the theme Open Graph data can sometimes interfere with the plugin Open Graph data.', 'loc_canon'),
										__('Use this option to suppress the theme Open Graph data and use the plugin Open Graph data instead.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Chrome/Safari @font-face fix', 'loc_canon'),
									'content' 				=> array(
										__('On some server configurations a known bug in Chrome and Safari can prevent the rendering of serverside @font-face fonts leaving a page blank except for images and other non-text media. If your site experiences this bug make sure you turn on the Chrome/Safari @font-face fix.', 'loc_canon'),
									),
								)); 

							?>

						</div>

						<table class='form-table'>

							<?php 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Suppress theme meta description', 'loc_canon'),
									'slug' 					=> 'hide_theme_meta_description',
									'options_name'			=> 'canon_options',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Suppress theme Open Graph data', 'loc_canon'),
									'slug' 					=> 'hide_theme_og',
									'options_name'			=> 'canon_options',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Chrome/Safari @font-face fix', 'loc_canon'),
									'slug' 					=> 'fontface_fix',
									'options_name'			=> 'canon_options',
								)); 

							?>

						</table>



					<?php submit_button(); ?>


				</form>
			</div> <!-- end table container -->	

	
		</div>

	</div>

