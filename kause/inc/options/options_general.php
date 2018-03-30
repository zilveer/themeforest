<div class="wrap">

		<div id="icon-themes" class="icon32"></div>

		<h2>Kause - <?php _e("General Settings", "loc_canon"); ?></h2>

		<?php 
			//delete_option('canon_options');
			$canon_options = get_option('canon_options'); 

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
					--------------------------------------------------------------------------
						GENERAL 
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("General", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='help'>
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
									'title' 				=> __('Construction mode', 'loc_canon'),
									'content' 				=> array(
										__('Activating construction mode will mean that only logged in users can see the content of your site. Only exception are pages using the placeholder template which can still be seen by all.', 'loc_canon'),
										__('We suggest that if you use this function you also use a placeholder page as a "static homepage" to let people know that your site is under construction.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Construction mode message', 'loc_canon'),
									'content' 				=> array(
										__('The message that will be displayed to visitors when in construction mode.', 'loc_canon'),
										__('Remember that you can set up a placeholder page (using the placeholder page-template) and use as a homepage as this page type will always display even when construction mode is active.', 'loc_canon'),
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
									'title' 				=> __('Construction mode', 'loc_canon'),
									'postfix'				=> __('<i>(Warning: only logged-in users will be able to see your site pages.)</i>', 'loc_canon'),
									'slug' 					=> 'use_construction_mode',
									'options_name'			=> 'canon_options',
								)); 

								fw_option(array(
									'type'					=> 'text',
									'title' 				=> __('Construction mode message', 'loc_canon'),
									'slug' 					=> 'construction_msg',
									'class'					=> 'widefat',
									'options_name'			=> 'canon_options',
								)); 

								fw_option(array(
									'type'					=> 'upload',
									'title' 				=> __('Favicon URL', 'loc_canon'),
									'slug' 					=> 'favicon_url',
									'btn_text'				=> 'Upload favicon',
									'options_name'			=> 'canon_options',
								)); 

							 ?>		

						</table>


					<!-- 
					--------------------------------------------------------------------------
						HEADER
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Header", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> __('General logo hierarchy', 'loc_canon'),
									'content' 				=> array(
										__('by default the Kause logo will be displayed', 'loc_canon'),
										__('if you enter a logo image URL this image will be displayed instead of the Kause logo.', 'loc_canon'),
										__('if you enter text as logo this text will be displayed instead of any custom logo image and instead of the theme logo.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> __('Logo URL', 'loc_canon'),
									'content' 				=> array(
										__('Enter a complete URL to the image you want to use or', 'loc_canon'),
										__('Click the "Upload" button, upload an image and make sure you click the "Use as logo" button or', 'loc_canon'),
										__('Click the "Upload" button and choose an image from the media library tab. Make sure you click the "Use as logo" button.', 'loc_canon'),
										__('If you leave the URL text field empty the default logo will be displayed.', 'loc_canon'),
										__('Remember to save your changes.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Use text as logo', 'loc_canon'),
									'content' 				=> array(
										__('This text will be displayed instead of any logo image. It will be styled like the Kause default logo.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Logo max width', 'loc_canon'),
									'content' 				=> array(
										__('You can control the size of your logo by setting the maximum allowed width of your logo image.', 'loc_canon'),
										__('To make your logo HD-ready/retina-ready you should set the logo max width to half the original width of your image (compression ratio: 2)', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Padding top & Padding bottom', 'loc_canon'),
									'content' 				=> array(
										__('Used to position your header elements.', 'loc_canon'),
										__('Increase padding top to create space above the header elements.', 'loc_canon'),
										__('Increase padding bottom to create space below the header elements.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Adjust logo relative position', 'loc_canon'),
									'content' 				=> array(
										__('You can fine adjust the logo position. Values are pixels from top-left.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Adjust nav. menu relative position', 'loc_canon'),
									'content' 				=> array(
										__('You can fine adjust the navigation menu position. Values are pixels from top-right.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Sticky header', 'loc_canon'),
									'content' 				=> array(
										__('Make the header stick to the top of the page when scrolling down.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Highlight last menu item', 'loc_canon'),
									'content' 				=> array(
										__('Check this to hightlight the last menu item', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Style highlight as button', 'loc_canon'),
									'content' 				=> array(
										__('When last menu item is highlighted this option will style it as a button.', 'loc_canon'),
									),
								)); 

							 ?>		


						</div>

						<table class='form-table'>

							<tr valign='top'>
								<th scope='row'></th>
								<td>
									 <br>
								</td>
							</tr>

							<tr valign='top'>
								<th scope='row'><?php _e("Logo Preview", "loc_canon"); ?></th>
								<td>
									<?php 
				                        if (!empty($canon_options['logo_url'])) {
				                            $logo_url = $canon_options['logo_url'];
				                        } else {
				                            $logo_url = get_template_directory_uri() .'/img/logo@2x.png';
				                        }
				                        $logo_size = getimagesize($logo_url);
				                        if (!empty($canon_options['logo_max_width'])) {
					                        $compression_ratio = $logo_size[0] / $canon_options['logo_max_width'];
				                        } else {
					                        $compression_ratio = 999;
				                        }

									 ?>
									<img class="thelogo" width="<?php if (!empty($canon_options['logo_max_width'])) echo $canon_options['logo_max_width']; ?>" src="<?php echo $logo_url; ?>"><br><br>
									<?php printf("<i>(%s%s %s%s%s)</i>", __("Original size: Width: ", "loc_canon"), $logo_size[0], __("pixels, height: ", "loc_canon") , $logo_size[1], __(" pixels", "loc_canon")); ?><br>
                                    <?php printf("<i>(%s%s %s%.2f)</i>",__("Resized to max width: ", "loc_canon") , $canon_options['logo_max_width'], __("pixels. Compression ratio: ", "loc_canon"), $compression_ratio); ?><br>
									<br><br>
								</td>
							</tr>

							<?php 

								fw_option(array(
									'type'					=> 'upload',
									'title' 				=> __('Logo URL', 'loc_canon'),
									'slug' 					=> 'logo_url',
									'btn_text'				=> 'Upload logo',
									'options_name'			=> 'canon_options',
								)); 

								fw_option(array(
									'type'					=> 'text',
									'title' 				=> __('Use text as logo', 'loc_canon'),
									'slug' 					=> 'logo_text',
									'options_name'			=> 'canon_options',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Text as logo size', 'loc_canon'),
									'slug' 					=> 'logo_text_size',
									'min'					=> '1',										// optional
									'max'					=> '1000',									// optional
									'step'					=> '1',										// optional
									'width_px'				=> '60',									// optional
									'postfix'				=> '<i>(pixels)</i>',						// optional
									'options_name'			=> 'canon_options',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Logo max width', 'loc_canon'),
									'slug' 					=> 'logo_max_width',
									'min'					=> '1',										// optional
									'max'					=> '1000',									// optional
									'step'					=> '0.1',									// optional
									'width_px'				=> '60',									// optional
									'postfix'				=> '<i>(pixels)</i>',						// optional
									'options_name'			=> 'canon_options',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Header padding top', 'loc_canon'),
									'slug' 					=> 'header_padding_top',
									'min'					=> '0',										// optional
									'max'					=> '1000',									// optional
									'width_px'				=> '60',									// optional
									'postfix'				=> '<i>(pixels)</i>',						// optional
									'options_name'			=> 'canon_options',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Header padding bottom', 'loc_canon'),
									'slug' 					=> 'header_padding_bottom',
									'min'					=> '0',										// optional
									'max'					=> '1000',									// optional
									'width_px'				=> '60',									// optional
									'postfix'				=> '<i>(pixels)</i>',						// optional
									'options_name'			=> 'canon_options',
								)); 

							 ?>		


							<tr valign='top'>
								<th scope='row'><?php _e("Adjust logo relative position", "loc_canon"); ?></th>
								<td>
									<input 
										type='number' 
										id='pos_logo_top' 
										name='canon_options[pos_logo_top]' 
										min='-1000'
										max='1000'
										style='width: 60px;'
										value='<?php if (isset($canon_options['pos_logo_top'])) echo esc_attr($canon_options['pos_logo_top']); ?>'
									> <i>(pixels from top)</i>
									<input 
										type='number' 
										id='pos_logo_left' 
										name='canon_options[pos_logo_left]' 
										min='-1000'
										max='1000'
										style='width: 60px;'
										value='<?php if (isset($canon_options['pos_logo_left'])) echo esc_attr($canon_options['pos_logo_left']); ?>'
									> <i>(pixels from left)</i>
								</td> 
							</tr>

							<tr valign='top'>
								<th scope='row'><?php _e("Adjust nav. menu relative position", "loc_canon"); ?></th>
								<td>
									<input 
										type='number' 
										id='pos_nav_top' 
										name='canon_options[pos_nav_top]' 
										min='-1000'
										max='1000'
										style='width: 60px;'
										value='<?php if (isset($canon_options['pos_nav_top'])) echo esc_attr($canon_options['pos_nav_top']); ?>'
									> <i>(pixels from top)</i>
									<input 
										type='number' 
										id='pos_nav_right' 
										name='canon_options[pos_nav_right]' 
										min='-1000'
										max='1000'
										style='width: 60px;'
										value='<?php if (isset($canon_options['pos_nav_right'])) echo esc_attr($canon_options['pos_nav_right']); ?>'
									> <i>(pixels from right)</i>
								</td> 
							</tr>

							<?php 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Highlight last menu item', 'loc_canon'),
									'slug' 					=> 'highlight_last_menu_item',
									'options_name'			=> 'canon_options',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Style highlight as button', 'loc_canon'),
									'slug' 					=> 'highlight_as_button',
									'options_name'			=> 'canon_options',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Sticky header', 'loc_canon'),
									'slug' 					=> 'use_sticky_header',
									'options_name'			=> 'canon_options',
								)); 

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Stickyness in responsive mode', 'loc_canon'),
									'slug' 					=> 'sticky_turn_off_width',
									'select_options'		=> array(
										'0'					=> __('Stickyness is always on', 'loc_canon'),
										'768'				=> __('Turn off @ viewport width below 768px', 'loc_canon'),
										'600'				=> __('Turn off @ viewport width below 600px', 'loc_canon'),
										'480'				=> __('Turn off @ viewport width below 480px', 'loc_canon'),
									),
									'options_name'			=> 'canon_options',
								)); 

							?>

						</table>



					<!-- 
					--------------------------------------------------------------------------
						FOOTER
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Footer", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Show widgetized footer', 'loc_canon'),
									'content' 				=> array(
										__('Footer containing four widgetized areas. Go to <i>Appearance > Widgets</i> to add widgets.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Show social footer', 'loc_canon'),
									'content' 				=> array(
										__('Footer containing footer text and social icons.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Footer text', 'loc_canon'),
									'content' 				=> array(
										__('Text to be displayed in the left side of the social footer area.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Google Analytics', 'loc_canon'),
									'content' 				=> array(
										__('Enter your <a href="http://www.google.com/analytics/" target="_blank">Google Analytics</a> code here.', 'loc_canon'),
										__('NB: If you have any Google Analytics plugins installed make sure you only add you Google Analytics code in one place (either here or in the plugin) or you will get a duplicate code error.', 'loc_canon'),
									),
								)); 

							?>
						</div>

						<table class='form-table'>

							<?php 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Show widgetized footer', 'loc_canon'),
									'slug' 					=> 'show_widgetized_footer',
									'options_name'			=> 'canon_options',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Show social footer', 'loc_canon'),
									'slug' 					=> 'show_social_footer',
									'options_name'			=> 'canon_options',
								)); 

								fw_option(array(
									'type'					=> 'textarea',
									'title' 				=> __('Footer text', 'loc_canon'),
									'slug' 					=> 'footer_text',
									'rows'					=> '5',
									'options_name'			=> 'canon_options',
								)); 

							?>

							<tr valign='top'>
								<th scope='row'><?php _e("Google Analytics", "loc_canon"); ?></th>
								<td>
									<textarea id='google_analytics_code' name='canon_options[google_analytics_code]' rows='5' cols='100'><?php if (isset($canon_options['google_analytics_code'])) echo htmlentities($canon_options['google_analytics_code']); ?></textarea>
								</td>
							</tr>

						</table>



					<!-- 
					--------------------------------------------------------------------------
						SOCIAL LINKS 
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Social links", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Show social icons', 'loc_canon'),
									'content' 				=> array(
										__('If checked your social icons will be displayed at the bottom right area of the footer.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> __('Social links', 'loc_canon'),
									'content' 				=> array(
										__('Choose an icon in the select and attach this to a social link.', 'loc_canon'),
										__('Make sure you put the whole URL to your social site in the text input.', 'loc_canon'),
										__('You can add a new social link to the end of the list by clicking "Add social link', 'loc_canon'),
										__('You can remove the last social link in your list by clicking "Remove social link".', 'loc_canon'),
										__('You can see a full list of the Font Awesome icons <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank">here</a>.', 'loc_canon'),
									),
								)); 

							?>
						</div>

						<table class='form-table social_links'>

							<?php 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Show social icons', 'loc_canon'),
									'slug' 					=> 'show_social_icons',
									'options_name'			=> 'canon_options',
								)); 

							?>

							<?php 
							if (isset($canon_options['social_links'])) {

								$font_awesome_array = mb_get_font_awesome_icon_names_in_array();

								for ($i = 0; $i < count($canon_options['social_links']); $i++) {  
								?>

								<tr valign='top' class='social_links_row'>
									<th scope='row'><?php _e("Social link", "loc_canon"); ?> <?php echo $i+1; ?></th>
									<td>
										<select class="social_links_icon fa_select" name="canon_options[social_links][<?php echo $i; ?>][0]"> 
											<?php 

												for ($n = 0; $n < count($font_awesome_array); $n++) {  
												?>
							     					<option value="<?php echo $font_awesome_array[$n]; ?>" <?php if (isset($canon_options['social_links'][$i][0])) {if ($canon_options['social_links'][$i][0] == $font_awesome_array[$n]) echo "selected='selected'";} ?>><?php echo $font_awesome_array[$n]; ?></option> 
												<?php
												}

											?>
										</select> 

									<i class="fa <?php if (isset($canon_options['social_links'][$i][0])) { echo $canon_options['social_links'][$i][0]; } else { echo "fa-flag"; } ?>"></i>

									<input type='text' class='social_links_link' name='canon_options[social_links][<?php echo $i; ?>][1]' value='<?php if (isset($canon_options['social_links'][$i][1])) echo $canon_options['social_links'][$i][1]; ?>'>
									</td>
								</tr>

								<?php
								}

							}

							?>

						</table>



						<table class='form-table social_links_control'>
							<tr valign='top'>
								<th scope='row'></th>
								<td>
									<input type="button" class="button button_add_social_link" value="<?php _e("Add social link", "loc_canon"); ?>" />
									<input type="button" class="button button_remove_social_link" value="<?php _e("Remove social link", "loc_canon"); ?>" />
								</td>
							</tr>

						</table>


					<!-- 
					--------------------------------------------------------------------------
						SEO
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("SEO", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='help'>
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

							?>

						</table>



					<?php submit_button(); ?>


				</form>
			</div> <!-- end table container -->	

	
		</div>

	</div>

