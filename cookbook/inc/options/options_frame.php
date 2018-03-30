	<div class="wrap">

		<div id="icon-themes" class="icon32"></div>

		<h2><?php printf( "%s %s - %s", esc_attr(wp_get_theme()->Name), esc_attr(__("Settings", "loc_canon")), esc_attr(__("Header & Footer", "loc_canon")) ); ?></h2>

		<?php 
			//delete_option('canon_options_frame');
			$canon_options_frame = get_option('canon_options_frame'); 

			// ARRAY VALUES
			$canon_options_frame['social_links'] = array_values($canon_options_frame['social_links']);
			update_option('canon_options_frame', $canon_options_frame);

			// var_dump($canon_options_frame);
		?>

		<br>
		
		<div class="options_wrapper canon-options">
		
			<div class="table_container">

				<form method="post" action="options.php" enctype="multipart/form-data">
					<?php settings_fields('group_canon_options_frame'); ?>				<!-- very important to add these two functions as they mediate what wordpress generates automatically from the functions.php -->
					<?php do_settings_sections('handle_canon_options_frame'); ?>		


					<?php submit_button(); ?>
					
					<!-- 

						INDEX

						HEADER BUILDER
						FOOTER BUILDER
						HEADER: GENERAL
						MAIN HEADER ADJUSTMENTS
						ELEMENT: LOGO
						ELEMENT: HEADER IMAGE
						ELEMENT: BANNER
						ELEMENT: HEADER TEXT
						ELEMENT: FOOTER TEXT
						ELEMENT: SOCIAL LINKS 
						ELEMENT: TOOLBAR
						ELEMENT: COUNTDOWN

					-->


					<!-- 
					--------------------------------------------------------------------------
						HEADER BUILDER
				    -------------------------------------------------------------------------- 
					-->

						<h3 class="group-builders"><?php _e("Header Builder", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help group-builders'>
							<?php 


								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Header builder', 'loc_canon'),
									'content' 				=> array(
										__('Build your own header. Select layouts and then select elements for each layout section using the selects. Settings for each element can be found below.', 'loc_canon'),
										__('Notice that some elements are only available for certain spots e.g. logo which can only be placed in the main header etc.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> __('Available elements', 'loc_canon'),
									'content' 				=> array(
										__('Primary menu.', 'loc_canon'),
										__('Secondary menu', 'loc_canon'),
										__('Logo', 'loc_canon'),
										__('Header image.', 'loc_canon'),
										__('Social icons', 'loc_canon'),
										__('Header text', 'loc_canon'),
										__('Footer text', 'loc_canon'),
										__('Toolbar (search button)', 'loc_canon'),
										__('Ad banner', 'loc_canon'),
										__('Countdown', 'loc_canon'),
										__('Breadcrumbs', 'loc_canon'),
									),
								)); 


							 ?>		

						</div>


						<table class='form-table header-layout group-builders'>

						<!-- PRE HEADER -->

							<?php 

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Pre-header', 'loc_canon'),
									'slug' 					=> 'header_pre_layout',
									'colspan'				=> 2,
									'select_options'		=> array(
										'off'									=> __('Off', 'loc_canon'),
										'header_pre_custom_center'				=> __('Custom Center', 'loc_canon'),
										'header_pre_custom_left_right'			=> __('Custom Left + Right', 'loc_canon'),
										'header_pre_image'						=> __('Image header', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 

							?>

						<!-- PRE HEADER: CUSTOM CENTER -->

							<tr class="dynamic_option" data-listen_to="#header_pre_layout" data-listen_for="header_pre_custom_center">
								<th></th>
								<td colspan="2">

									<?php 

										fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'header_pre_custom_center',
											'select_options'		=> array(
												'off'					=> __('Off', 'loc_canon'),
												'primary'				=> __('Primary Menu', 'loc_canon'),
												'secondary'				=> __('Secondary Menu', 'loc_canon'),
												'social'				=> __('Social Icons', 'loc_canon'),
												'header_text'			=> __('Header Text', 'loc_canon'),
												'footer_text'			=> __('Footer Text', 'loc_canon'),
												'toolbar'				=> __('Toolbar', 'loc_canon'),
												'countdown'				=> __('Countdown', 'loc_canon'),
												'breadcrumbs'			=> __('Breadcrumbs', 'loc_canon'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

							</tr>

						<!-- PRE HEADER: CUSTOM LEFT RIGHT -->

							<tr class="dynamic_option" data-listen_to="#header_pre_layout" data-listen_for="header_pre_custom_left_right">
								<th></th>
								<td>
					
									<?php 

										fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'header_pre_custom_left',
											'select_options'		=> array(
												'off'					=> __('Off', 'loc_canon'),
												'primary'				=> __('Primary Menu', 'loc_canon'),
												'secondary'				=> __('Secondary Menu', 'loc_canon'),
												'social'				=> __('Social Icons', 'loc_canon'),
												'header_text'			=> __('Header Text', 'loc_canon'),
												'footer_text'			=> __('Footer Text', 'loc_canon'),
												'toolbar'				=> __('Toolbar', 'loc_canon'),
												'countdown'				=> __('Countdown', 'loc_canon'),
												'breadcrumbs'			=> __('Breadcrumbs', 'loc_canon'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

								</td>
								<td>

									<?php 

										fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'header_pre_custom_right',
											'select_options'		=> array(
												'off'					=> __('Off', 'loc_canon'),
												'primary'				=> __('Primary Menu', 'loc_canon'),
												'secondary'				=> __('Secondary Menu', 'loc_canon'),
												'social'				=> __('Social Icons', 'loc_canon'),
												'header_text'			=> __('Header Text', 'loc_canon'),
												'footer_text'			=> __('Footer Text', 'loc_canon'),
												'toolbar'				=> __('Toolbar', 'loc_canon'),
												'countdown'				=> __('Countdown', 'loc_canon'),
												'breadcrumbs'			=> __('Breadcrumbs', 'loc_canon'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

 								</td>
							</tr>


						<!-- MAIN HEADER -->

							<?php

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Main header', 'loc_canon'),
									'slug' 					=> 'header_main_layout',
									'colspan'				=> 2,
									'select_options'		=> array(
										'off'							=> __('Off', 'loc_canon'),
										'header_main_custom_center'			=> __('Custom Center', 'loc_canon'),
										'header_main_custom_left_right'		=> __('Custom Left + Right', 'loc_canon'),
										'header_main_image'					=> __('Image header', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 

							?>

						<!-- MAIN HEADER: CUSTOM CENTER -->

							<tr class="dynamic_option" data-listen_to="#header_main_layout" data-listen_for="header_main_custom_center">
								<th></th>
								<td colspan="2">
					
									<?php 

										fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'header_main_custom_center',
											'select_options'		=> array(
												'off'					=> __('Off', 'loc_canon'),
												'logo'					=> __('Logo', 'loc_canon'),
												'primary'				=> __('Primary Menu', 'loc_canon'),
												'secondary'				=> __('Secondary Menu', 'loc_canon'),
												'social'				=> __('Social Icons', 'loc_canon'),
												'header_text'			=> __('Header Text', 'loc_canon'),
												'footer_text'			=> __('Footer Text', 'loc_canon'),
												'toolbar'				=> __('Toolbar', 'loc_canon'),
												'banner'				=> __('Ad banner', 'loc_canon'),
												'countdown'				=> __('Countdown', 'loc_canon'),
												'breadcrumbs'			=> __('Breadcrumbs', 'loc_canon'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>
					
							</tr>

						<!-- MAIN HEADER: CUSTOM LEFT RIGHT -->

							<tr class="dynamic_option" data-listen_to="#header_main_layout" data-listen_for="header_main_custom_left_right">
								<th></th>
								<td>
					
									<?php 

										fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'header_main_custom_left',
											'select_options'		=> array(
												'off'					=> __('Off', 'loc_canon'),
												'logo'					=> __('Logo', 'loc_canon'),
												'primary'				=> __('Primary Menu', 'loc_canon'),
												'secondary'				=> __('Secondary Menu', 'loc_canon'),
												'social'				=> __('Social Icons', 'loc_canon'),
												'header_text'			=> __('Header Text', 'loc_canon'),
												'footer_text'			=> __('Footer Text', 'loc_canon'),
												'toolbar'				=> __('Toolbar', 'loc_canon'),
												'banner'				=> __('Ad banner', 'loc_canon'),
												'countdown'				=> __('Countdown', 'loc_canon'),
												'breadcrumbs'			=> __('Breadcrumbs', 'loc_canon'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

								</td>
								<td>

									<?php 

										fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'header_main_custom_right',
											'select_options'		=> array(
												'off'					=> __('Off', 'loc_canon'),
												'logo'					=> __('Logo', 'loc_canon'),
												'primary'				=> __('Primary Menu', 'loc_canon'),
												'secondary'				=> __('Secondary Menu', 'loc_canon'),
												'social'				=> __('Social Icons', 'loc_canon'),
												'header_text'			=> __('Header Text', 'loc_canon'),
												'footer_text'			=> __('Footer Text', 'loc_canon'),
												'toolbar'				=> __('Toolbar', 'loc_canon'),
												'banner'				=> __('Ad banner', 'loc_canon'),
												'countdown'				=> __('Countdown', 'loc_canon'),
												'breadcrumbs'			=> __('Breadcrumbs', 'loc_canon'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

 								</td>
							</tr>

						<!-- POST HEADER -->

							<?php							
								
								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Post-header', 'loc_canon'),
									'slug' 					=> 'header_post_layout',
									'colspan'				=> 2,
									'select_options'		=> array(
										'off'							=> __('Off', 'loc_canon'),
										'header_post_custom_center'		=> __('Custom Center', 'loc_canon'),
										'header_post_custom_left_right'	=> __('Custom Left + Right', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 
								
							?>

						<!-- POST HEADER: CUSTOM CENTER -->

							<tr class="dynamic_option" data-listen_to="#header_post_layout" data-listen_for="header_post_custom_center">
								<th></th>
								<td colspan="2">
					
									<?php 

										fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'header_post_custom_center',
											'select_options'		=> array(
												'off'					=> __('Off', 'loc_canon'),
												'primary'				=> __('Primary Menu', 'loc_canon'),
												'secondary'				=> __('Secondary Menu', 'loc_canon'),
												'social'				=> __('Social Icons', 'loc_canon'),
												'header_text'			=> __('Header Text', 'loc_canon'),
												'footer_text'			=> __('Footer Text', 'loc_canon'),
												'toolbar'				=> __('Toolbar', 'loc_canon'),
												'countdown'				=> __('Countdown', 'loc_canon'),
												'breadcrumbs'			=> __('Breadcrumbs', 'loc_canon'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

							</tr>

						<!-- POST HEADER: CUSTOM LEFT RIGHT -->

							<tr class="dynamic_option" data-listen_to="#header_post_layout" data-listen_for="header_post_custom_left_right">
								<th></th>
								<td>
					
									<?php 

										fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'header_post_custom_left',
											'select_options'		=> array(
												'off'					=> __('Off', 'loc_canon'),
												'primary'				=> __('Primary Menu', 'loc_canon'),
												'secondary'				=> __('Secondary Menu', 'loc_canon'),
												'social'				=> __('Social Icons', 'loc_canon'),
												'header_text'			=> __('Header Text', 'loc_canon'),
												'footer_text'			=> __('Footer Text', 'loc_canon'),
												'toolbar'				=> __('Toolbar', 'loc_canon'),
												'countdown'				=> __('Countdown', 'loc_canon'),
												'breadcrumbs'			=> __('Breadcrumbs', 'loc_canon'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

								</td>
								<td>

									<?php 

										fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'header_post_custom_right',
											'select_options'		=> array(
												'off'					=> __('Off', 'loc_canon'),
												'primary'				=> __('Primary Menu', 'loc_canon'),
												'secondary'				=> __('Secondary Menu', 'loc_canon'),
												'social'				=> __('Social Icons', 'loc_canon'),
												'header_text'			=> __('Header Text', 'loc_canon'),
												'footer_text'			=> __('Footer Text', 'loc_canon'),
												'toolbar'				=> __('Toolbar', 'loc_canon'),
												'countdown'				=> __('Countdown', 'loc_canon'),
												'breadcrumbs'			=> __('Breadcrumbs', 'loc_canon'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

 								</td>
							</tr>

						</table>


					<!-- 
					--------------------------------------------------------------------------
						FOOTER BUILDER
				    -------------------------------------------------------------------------- 
					-->

						<h3 class="group-builders"><?php _e("Footer Builder", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help group-builders'>
							<?php 


								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Footer builder', 'loc_canon'),
									'content' 				=> array(
										__('Build your own footer. Select layouts and then select elements for each layout section using the selects. Settings for each element can be found below.', 'loc_canon'),
									),
								)); 

							 ?>		

						</div>


						<table class='form-table header-layout group-builders'>

						<!-- PRE FOOTER -->

							<?php							
								
								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Pre-footer', 'loc_canon'),
									'slug' 					=> 'footer_pre_layout',
									'colspan'				=> 2,
									'select_options'		=> array(
										'off'							=> __('Off', 'loc_canon'),
										'footer_pre_custom_center'		=> __('Custom Center', 'loc_canon'),
										'footer_pre_custom_left_right'	=> __('Custom Left + Right', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 
								
							?>

						<!-- PRE FOOTER: CUSTOM CENTER -->

							<tr class="dynamic_option" data-listen_to="#footer_pre_layout" data-listen_for="footer_pre_custom_center">
								<th></th>
								<td colspan="2">
					
									<?php 

										fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'footer_pre_custom_center',
											'select_options'		=> array(
												'off'					=> __('Off', 'loc_canon'),
												'primary'				=> __('Primary Menu', 'loc_canon'),
												'secondary'				=> __('Secondary Menu', 'loc_canon'),
												'social'				=> __('Social Icons', 'loc_canon'),
												'header_text'			=> __('Header Text', 'loc_canon'),
												'footer_text'			=> __('Footer Text', 'loc_canon'),
												'toolbar'				=> __('Toolbar', 'loc_canon'),
												'countdown'				=> __('Countdown', 'loc_canon'),
												'breadcrumbs'			=> __('Breadcrumbs', 'loc_canon'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

							</tr>

						<!-- PRE FOOTER: CUSTOM LEFT RIGHT -->

							<tr class="dynamic_option" data-listen_to="#footer_pre_layout" data-listen_for="footer_pre_custom_left_right">
								<th></th>
								<td>
					
									<?php 

										fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'footer_pre_custom_left',
											'select_options'		=> array(
												'off'					=> __('Off', 'loc_canon'),
												'primary'				=> __('Primary Menu', 'loc_canon'),
												'secondary'				=> __('Secondary Menu', 'loc_canon'),
												'social'				=> __('Social Icons', 'loc_canon'),
												'header_text'			=> __('Header Text', 'loc_canon'),
												'footer_text'			=> __('Footer Text', 'loc_canon'),
												'toolbar'				=> __('Toolbar', 'loc_canon'),
												'countdown'				=> __('Countdown', 'loc_canon'),
												'breadcrumbs'			=> __('Breadcrumbs', 'loc_canon'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

								</td>
								<td>

									<?php 

										fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'footer_pre_custom_right',
											'select_options'		=> array(
												'off'					=> __('Off', 'loc_canon'),
												'primary'				=> __('Primary Menu', 'loc_canon'),
												'secondary'				=> __('Secondary Menu', 'loc_canon'),
												'social'				=> __('Social Icons', 'loc_canon'),
												'header_text'			=> __('Header Text', 'loc_canon'),
												'footer_text'			=> __('Footer Text', 'loc_canon'),
												'toolbar'				=> __('Toolbar', 'loc_canon'),
												'countdown'				=> __('Countdown', 'loc_canon'),
												'breadcrumbs'			=> __('Breadcrumbs', 'loc_canon'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

 								</td>
							</tr>

						<!-- MAIN FOOTER -->

							<?php

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Main footer', 'loc_canon'),
									'slug' 					=> 'footer_main_layout',
									'colspan'				=> 2,
									'select_options'		=> array(
										'off'						=> __('Off', 'loc_canon'),
										'block_widgetized_footer'	=> __('Widgetized footer', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 

							?>


						<!-- POST FOOTER -->

							<?php							
								
								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Post-footer', 'loc_canon'),
									'slug' 					=> 'footer_post_layout',
									'colspan'				=> 2,
									'select_options'		=> array(
										'off'							=> __('Off', 'loc_canon'),
										'footer_post_custom_center'		=> __('Custom Center', 'loc_canon'),
										'footer_post_custom_left_right'	=> __('Custom Left + Right', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 
								
							?>

						<!-- POST FOOTER: CUSTOM CENTER -->

							<tr class="dynamic_option" data-listen_to="#footer_post_layout" data-listen_for="footer_post_custom_center">
								<th></th>
								<td colspan="2">
					
									<?php 

										fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'footer_post_custom_center',
											'select_options'		=> array(
												'off'					=> __('Off', 'loc_canon'),
												'primary'				=> __('Primary Menu', 'loc_canon'),
												'secondary'				=> __('Secondary Menu', 'loc_canon'),
												'social'				=> __('Social Icons', 'loc_canon'),
												'header_text'			=> __('Header Text', 'loc_canon'),
												'footer_text'			=> __('Footer Text', 'loc_canon'),
												'toolbar'				=> __('Toolbar', 'loc_canon'),
												'countdown'				=> __('Countdown', 'loc_canon'),
												'breadcrumbs'			=> __('Breadcrumbs', 'loc_canon'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

							</tr>

						<!-- POST FOOTER: CUSTOM LEFT RIGHT -->

							<tr class="dynamic_option" data-listen_to="#footer_post_layout" data-listen_for="footer_post_custom_left_right">
								<th></th>
								<td>
					
									<?php 

										fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'footer_post_custom_left',
											'select_options'		=> array(
												'off'					=> __('Off', 'loc_canon'),
												'primary'				=> __('Primary Menu', 'loc_canon'),
												'secondary'				=> __('Secondary Menu', 'loc_canon'),
												'social'				=> __('Social Icons', 'loc_canon'),
												'header_text'			=> __('Header Text', 'loc_canon'),
												'footer_text'			=> __('Footer Text', 'loc_canon'),
												'toolbar'				=> __('Toolbar', 'loc_canon'),
												'countdown'				=> __('Countdown', 'loc_canon'),
												'breadcrumbs'			=> __('Breadcrumbs', 'loc_canon'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

								</td>
								<td>

									<?php 

										fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'footer_post_custom_right',
											'select_options'		=> array(
												'off'					=> __('Off', 'loc_canon'),
												'primary'				=> __('Primary Menu', 'loc_canon'),
												'secondary'				=> __('Secondary Menu', 'loc_canon'),
												'social'				=> __('Social Icons', 'loc_canon'),
												'header_text'			=> __('Header Text', 'loc_canon'),
												'footer_text'			=> __('Footer Text', 'loc_canon'),
												'toolbar'				=> __('Toolbar', 'loc_canon'),
												'countdown'				=> __('Countdown', 'loc_canon'),
												'breadcrumbs'			=> __('Breadcrumbs', 'loc_canon'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

 								</td>
							</tr>

						</table>

					
					<!-- HORIZONTAL DIVIDER -->
					<br><hr><br>


					<!-- 
					--------------------------------------------------------------------------
						HEADER: GENERAL
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Header: General Settings", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Sticky headers', 'loc_canon'),
									'content' 				=> array(
										__('Make the headers stick to the top of the page when scrolling down.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Stickyness in responsive mode', 'loc_canon'),
									'content' 				=> array(
										__('Turn off stickyness in responsive mode. Choose the viewport size under which stickyness will be disabled. The optimal setting depends on your content. If you have many sticky elements or tall sticky elements you might want to turn off stickyness at a higher viewport size to avoid the sticky elements taking up the whole viewport.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Add search button to primary or secondary menu', 'loc_canon'),
									'content' 				=> array(
										__('Select this to put a search button at the end of your primary or secondary menu', 'loc_canon'),
									),
								)); 

							 ?>		


						</div>

						<table class='form-table'>


							<?php 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Sticky pre-header', 'loc_canon'),
									'slug' 					=> 'use_sticky_preheader',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Sticky main header', 'loc_canon'),
									'slug' 					=> 'use_sticky_header',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Sticky post-header', 'loc_canon'),
									'slug' 					=> 'use_sticky_postheader',
									'options_name'			=> 'canon_options_frame',
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
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Add search button to primary menu', 'loc_canon'),
									'slug' 					=> 'add_search_btn_to_primary',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Add search button to secondary menu', 'loc_canon'),
									'slug' 					=> 'add_search_btn_to_secondary',
									'options_name'			=> 'canon_options_frame',
								)); 

							?>

						</table>



					<!-- 
					--------------------------------------------------------------------------
						MAIN HEADER ADJUSTMENTS
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Main Header Adjustments", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Header padding', 'loc_canon'),
									'content' 				=> array(
										__('Use to position your header elements.', 'loc_canon'),
										__('Increase header padding top to create space above the main header elements.', 'loc_canon'),
										__('Increase header padding bottom to create space below the main header elements.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Adjust left element relative position', 'loc_canon'),
									'content' 				=> array(
										__('You can fine adjust the left element position. Values are pixels from top-left.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Adjust right element relative position', 'loc_canon'),
									'content' 				=> array(
										__('You can fine adjust the right element position. Values are pixels from top-right.', 'loc_canon'),
									),
								)); 

							 ?>		

						</div>

						<table class='form-table header-layout'>

							<?php 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Header padding top', 'loc_canon'),
									'slug' 					=> 'header_padding_top',
									'min'					=> '0',										// optional
									'max'					=> '1000',									// optional
									'width_px'				=> '60',									// optional
									'postfix'				=> '<i>(pixels)</i>',						// optional
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Header padding bottom', 'loc_canon'),
									'slug' 					=> 'header_padding_bottom',
									'min'					=> '0',										// optional
									'max'					=> '1000',									// optional
									'width_px'				=> '60',									// optional
									'postfix'				=> '<i>(pixels)</i>',						// optional
									'options_name'			=> 'canon_options_frame',
								)); 

							 ?>		


							<tr valign='top'>
								<th scope='row'><?php _e("Adjust left element relative position", "loc_canon"); ?></th>
								<td>
									<input 
										type='number' 
										id='pos_left_element_top' 
										name='canon_options_frame[pos_left_element_top]' 
										min='-1000'
										max='1000'
										style='width: 60px;'
										value='<?php if (isset($canon_options_frame['pos_left_element_top'])) echo esc_attr($canon_options_frame['pos_left_element_top']); ?>'
									> <i>(pixels from top)</i>
									<input 
										type='number' 
										id='pos_left_element_left' 
										name='canon_options_frame[pos_left_element_left]' 
										min='-1000'
										max='1000'
										style='width: 60px;'
										value='<?php if (isset($canon_options_frame['pos_left_element_left'])) echo esc_attr($canon_options_frame['pos_left_element_left']); ?>'
									> <i>(pixels from left)</i>
								</td> 
							</tr>

							<tr valign='top'>
								<th scope='row'><?php _e("Adjust right element relative position", "loc_canon"); ?></th>
								<td>
									<input 
										type='number' 
										id='pos_right_element_top' 
										name='canon_options_frame[pos_right_element_top]' 
										min='-1000'
										max='1000'
										style='width: 60px;'
										value='<?php if (isset($canon_options_frame['pos_right_element_top'])) echo esc_attr($canon_options_frame['pos_right_element_top']); ?>'
									> <i>(pixels from top)</i>
									<input 
										type='number' 
										id='pos_right_element_right' 
										name='canon_options_frame[pos_right_element_right]' 
										min='-1000'
										max='1000'
										style='width: 60px;'
										value='<?php if (isset($canon_options_frame['pos_right_element_right'])) echo esc_attr($canon_options_frame['pos_right_element_right']); ?>'
									> <i>(pixels from right)</i>
								</td> 
							</tr>

						</table>

					<!-- 
					--------------------------------------------------------------------------
						ELEMENT: LOGO
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Logo", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> __('General logo hierarchy', 'loc_canon'),
									'content' 				=> array(
										__('by default the theme logo will be displayed', 'loc_canon'),
										__('if you enter a logo image URL this image will be displayed instead of the theme logo.', 'loc_canon'),
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
										__('This text will be displayed instead of any logo image. You can select font for logo text by going to Appearance > Google Webfonts > Logo text.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Text as logo size', 'loc_canon'),
									'content' 				=> array(
										__('If using text as logo this option lets you set a font size.', 'loc_canon'),
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

				                        if (!empty($canon_options_frame['logo_url'])) {
				                            $logo_url = $canon_options_frame['logo_url'];
				                        } else {
				                            $logo_url = get_template_directory_uri() .'/img/logo-black.png';
				                        }
				                        $logo_size = getimagesize($logo_url);
				                        if (!empty($canon_options_frame['logo_max_width'])) {
					                        $compression_ratio = $logo_size[0] / (int) $canon_options_frame['logo_max_width'];
				                        } else {
					                        $compression_ratio = 999;
				                        }

									 ?>
									<img class="thelogo" width="<?php if (!empty($canon_options_frame['logo_max_width'])) echo esc_attr($canon_options_frame['logo_max_width']); ?>" src="<?php echo esc_url($logo_url); ?>"><br><br>
									<?php printf("<i>(%s%s %s%s%s)</i>", __("Original size: Width: ", "loc_canon"), esc_attr($logo_size[0]), __("pixels, height: ", "loc_canon") , esc_attr($logo_size[1]), __(" pixels", "loc_canon")); ?><br>
                                    <?php printf("<i>(%s%s %s%.2f)</i>",__("Resized to max width: ", "loc_canon") , esc_attr($canon_options_frame['logo_max_width']), __("pixels. Compression ratio: ", "loc_canon"), esc_attr($compression_ratio)); ?><br>
									<br><br>
								</td>
							</tr>

							<?php 

								fw_option(array(
									'type'					=> 'upload',
									'title' 				=> __('Logo URL', 'loc_canon'),
									'slug' 					=> 'logo_url',
									'btn_text'				=> 'Upload logo',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'text',
									'title' 				=> __('Use text as logo', 'loc_canon'),
									'slug' 					=> 'logo_text',
									'options_name'			=> 'canon_options_frame',
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
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Logo max width', 'loc_canon'),
									'slug' 					=> 'logo_max_width',
									'min'					=> '1',										// optional
									'max'					=> '1000',									// optional
									'step'					=> '1',										// optional
									'width_px'				=> '60',									// optional
									'postfix'				=> '<i>(pixels)</i>',						// optional
									'options_name'			=> 'canon_options_frame',
								)); 

							?>

						</table>


					<!-- 
					--------------------------------------------------------------------------
						ELEMENT: HEADER IMAGE
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Header Image", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Show only on homepage', 'loc_canon'),
									'content' 				=> array(
										__('The header image will only be displayed on the homepage.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Image URL', 'loc_canon'),
									'content' 				=> array(
										__('Insert URL to use as header image or click Select Image button to choose from media library.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Background color', 'loc_canon'),
									'content' 				=> array(
										__('Set header image background color. Useful when using transparent image files.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Header height', 'loc_canon'),
									'content' 				=> array(
										__('Set header image height', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Parallax amount', 'loc_canon'),
									'content' 				=> array(
										__('Select how much of a parallax effect you want.', 'loc_canon'),
										__('Set at 0% to turn parallax off completely - the image will scroll along with the rest of the page.', 'loc_canon'),
										__('Set at 100% for maximum parallax effect - the image stays fixed as the page scrolls by.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Parallax img y-offset', 'loc_canon'),
									'content' 				=> array(
										__('Set beginning y-position of parallax image (relative to container element). Can be set to negative pixel value to position image upwards.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Image text', 'loc_canon'),
									'content' 				=> array(
										__('Text to display over header image.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Image text alignment', 'loc_canon'),
									'content' 				=> array(
										__('Align text left, center or right.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Image text top margin', 'loc_canon'),
									'content' 				=> array(
										__('Increase number to position text further down.', 'loc_canon'),
									),
								)); 


							?>
						</div>

						<table class='form-table'>


							<?php 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Show only on homepage', 'loc_canon'),
									'slug' 					=> 'header_img_homepage_only',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'upload',
									'title' 				=> __('Image URL', 'loc_canon'),
									'slug' 					=> 'header_img_url',
									'btn_text'				=> __('Select Image', 'loc_canon'),
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Background color', 'loc_canon'),
									'slug' 					=> 'header_img_bg_color',
									'options_name'			=> 'canon_options_frame',
								)); 
							
								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Header height', 'loc_canon'),
									'slug' 					=> 'header_img_height',
									'min'					=> '0',
									'max'					=> '10000',
									'step'					=> '10',
									'postfix'				=> '<i> (pixels)</i>',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Parallax amount', 'loc_canon'),
									'slug' 					=> 'header_img_parallax_amount',
									'min'					=> '0',
									'max'					=> '100',
									'step'					=> '1',
									'postfix'				=> '<i>%</i>',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Parallax img y-offset', 'loc_canon'),
									'slug' 					=> 'header_img_parallax_yoffset',
									'step'					=> '1',
									'postfix'				=> '<i> (pixels)</i>',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_frame',
								)); 


								fw_option(array(
									'type'					=> 'textarea',
									'title' 				=> __('Image text', 'loc_canon'),
									'slug' 					=> 'header_img_text',
									'rows'					=> '5',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Image text alignment', 'loc_canon'),
									'slug' 					=> 'header_img_text_alignment',
									'select_options'		=> array(
										'centered'			=> __('Center', 'loc_canon'),
										'left'				=> __('Left', 'loc_canon'),
										'right'				=> __('Right', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Image text top margin', 'loc_canon'),
									'slug' 					=> 'header_img_text_margin_top',
									'min'					=> '0',
									'max'					=> '10000',
									'step'					=> '10',
									'postfix'				=> '<i> (pixels)</i>',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_frame',
								)); 


							?>

						</table>

					<!-- 
					--------------------------------------------------------------------------
						ELEMENT: BANNER
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Ad Banner", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Ad Code', 'loc_canon'),
									'content' 				=> array(
										__('Insert your ad code or ad HTML here. If you are unsure what code to use you should consult your ad provider.', 'loc_canon'),
									),
								)); 


							?>
						</div>

						<table class='form-table'>


							<?php 

								fw_option(array(
									'type'					=> 'textarea',
									'title' 				=> __('Ad code', 'loc_canon'),
									'slug' 					=> 'header_banner_code',
									'rows'					=> '5',
									'options_name'			=> 'canon_options_frame',
								)); 

							?>

						</table>

					<!-- 
					--------------------------------------------------------------------------
						ELEMENT: HEADER TEXT
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Header Text", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Header text', 'loc_canon'),
									'content' 				=> array(
										__('Text to display in header. Can contain HTML.', 'loc_canon'),
									),
								)); 


							?>
						</div>

						<table class='form-table'>


							<?php 

								fw_option(array(
									'type'					=> 'textarea',
									'title' 				=> __('Header text', 'loc_canon'),
									'slug' 					=> 'header_text',
									'rows'					=> '5',
									'options_name'			=> 'canon_options_frame',
								)); 

							?>

						</table>

					<!-- 
					--------------------------------------------------------------------------
						ELEMENT: FOOTER TEXT
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Footer Text", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Footer text', 'loc_canon'),
									'content' 				=> array(
										__('Text to display in footer. Can contain HTML.', 'loc_canon'),
									),
								)); 


							?>
						</div>

						<table class='form-table'>


							<?php 

								fw_option(array(
									'type'					=> 'textarea',
									'title' 				=> __('Footer text', 'loc_canon'),
									'slug' 					=> 'footer_text',
									'rows'					=> '5',
									'options_name'			=> 'canon_options_frame',
								)); 

							?>

						</table>


					<!-- 
					--------------------------------------------------------------------------
						SOCIAL LINKS 
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Social Links", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

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
									'title' 				=> __('Open links in new window', 'loc_canon'),
									'slug' 					=> 'social_in_new',
									'options_name'			=> 'canon_options_frame',
								)); 

							?>

							<?php 
							if (isset($canon_options_frame['social_links'])) {

								$font_awesome_array = mb_get_font_awesome_icon_names_in_array();

								
								?>

								<tr valign='top' class='social_links_row'>
									<th scope='row'><?php _e("Social links", "loc_canon"); ?></th>
									<td>
										<ul class="ul_sortable"  data-split_index="2">
											<?php for ($i = 0; $i < count($canon_options_frame['social_links']); $i++) : ?>

												<li>
													<select class="social_links_icon fa_select li_option" name="canon_options_frame[social_links][<?php echo esc_attr($i); ?>][0]"> 
														<?php 

															for ($n = 0; $n < count($font_awesome_array); $n++) {  
															?>
										     					<option value="<?php echo esc_attr($font_awesome_array[$n]); ?>" <?php if (isset($canon_options_frame['social_links'][$i][0])) {if ($canon_options_frame['social_links'][$i][0] == $font_awesome_array[$n]) echo "selected='selected'";} ?>><?php echo esc_attr($font_awesome_array[$n]); ?></option> 
															<?php
															}

														?>
													</select> 

													<i class="fa <?php if (isset($canon_options_frame['social_links'][$i][0])) { echo esc_attr($canon_options_frame['social_links'][$i][0]); } else { echo "fa-flag"; } ?>"></i>
													<input type='text' class='social_links_link li_option' name='canon_options_frame[social_links][<?php echo esc_attr($i); ?>][1]' value='<?php if (isset($canon_options_frame['social_links'][$i][1])) echo esc_url($canon_options_frame['social_links'][$i][1]); ?>'>
													<button class="button ul_del_this"><?php _e("delete", "loc_canon"); ?></button>

												</li>

											<?php endfor; ?>

										</ul>

										<div class="ul_control" data-min="1" data-max="1000">
											<input type="button" class="button ul_add" value="<?php _e("Add", "loc_scoop_widgets_plugin"); ?>" />
											<input type="button" class="button ul_del" value="<?php _e("Delete", "loc_scoop_widgets_plugin"); ?>" />
										</div>

									</td>
								</tr>

								<?php

							}

							?>

						</table>


					<!-- 
					--------------------------------------------------------------------------
						ELEMENT: TOOLBAR
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Toolbar", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Toolbar', 'loc_canon'),
									'content' 				=> array(
										__('Select what tools to add to the toolbar.', 'loc_canon'),
									),
								)); 


							?>
						</div>

						<table class='form-table'>


							<?php 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Search button', 'loc_canon'),
									'slug' 					=> 'toolbar_search_button',
									'options_name'			=> 'canon_options_frame',
								)); 

							?>

						</table>


					<!-- 
					--------------------------------------------------------------------------
						ELEMENT: COUNTDOWN
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Countdown", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Countdown to', 'loc_canon'),
									'content' 				=> array(
										__('Must be in the format Month DD, YYYY HH:MM:SS e.g. December 31, 2023 23:59:59', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('GMT offset', 'loc_canon'),
									'content' 				=> array(
										__('GMT offset of your current timezone. You can search for your timezone <a href="http://www.worldtimezone.com/" target="_blank">here</a>.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Description', 'loc_canon'),
									'content' 				=> array(
										__('Countdown description. Will appear before the countdown.', 'loc_canon'),
									),
								)); 

							?>
						</div>

						<table class='form-table'>


							<?php 

								fw_option(array(
									'type'					=> 'text',
									'title' 				=> __('Countdown to', 'loc_canon'),
									'class'					=> 'widefat',
									'slug' 					=> 'countdown_datetime_string',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'text',
									'title' 				=> __('GMT Offset', 'loc_canon'),
									'class'					=> 'widefat',
									'slug' 					=> 'countdown_gmt_offset',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'text',
									'title' 				=> __('Description', 'loc_canon'),
									'class'					=> 'widefat',
									'slug' 					=> 'countdown_description',
									'options_name'			=> 'canon_options_frame',
								)); 

							?>

						</table>





					<!-- BOTTOM OF PAGE -->						
					<?php submit_button(); ?>

				</form>
			</div> <!-- end table container -->	

	
		</div>

	</div>

