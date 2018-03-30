	<div class="wrap">

		<div id="icon-themes" class="icon32"></div>

		<h2><?php printf( "%s %s - %s", esc_attr(wp_get_theme()->Name), esc_attr(__("Settings", "loc_canon")), esc_attr(__("Header & Footer", "loc_canon")) ); ?></h2>

		<?php 
			//delete_option('canon_options_frame');
			$canon_options_frame = get_option('canon_options_frame'); 

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

						HEADER: GENERAL
						HEADER LAYOUT
						MAIN HEADER ADJUSTMENTS
						HEADER ELEMENT: LOGO
						HEADER ELEMENT: IMAGE
						HEADER ELEMENT: BANNER
						HEADER ELEMENT: HEADER TEXT
						SOCIAL LINKS 
						HEADER ELEMENT: TOOLBAR
						HEADER ELEMENT: COUNTDOWN
						FOOTER

					-->


					<!-- 
					--------------------------------------------------------------------------
						HEADER: GENERAL
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Header: General Settings", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='help'>
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

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Scroll-to menu items', 'loc_canon'),
									'content' 				=> array(
										__('Usually the current page user is on is highlighted in the menu. This however may not be desirable when putting scroll-to links in the menu as this can lead to multiple menu items being highlighted at the same time. Use this option to determine how scroll-to links in the menu are highlighted.<br>', 'loc_canon'),
										__('<i><strong>Act normal</strong></i>: Scroll-to links act as normal menu items which means they are highlighted when current page.', 'loc_canon'),
										__('<i><strong>Disable active status at top level</strong></i>: Scroll-to links are not highlighted if placed as top level menu items.', 'loc_canon'),
										__('<i><strong>Disable active status at all levels</strong></i>: Scroll-to links are never highlighted. <strong>NB</strong>: Ancestor menu items are still highlighted even if the scroll-to links themselves are not.', 'loc_canon'),

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
										'0'						=> __('Stickyness is always on', 'loc_canon'),
										'768'					=> __('Turn off @ viewport width below 768px', 'loc_canon'),
										'600'					=> __('Turn off @ viewport width below 600px', 'loc_canon'),
										'480'					=> __('Turn off @ viewport width below 480px', 'loc_canon'),
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

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Scroll-to menu items', 'loc_canon'),
									'slug' 					=> 'status_of_scroll_to_menu_items',
									'select_options'		=> array(
										'normal'				=> __('Act normal', 'loc_canon'),
										'hide_at_top_level'		=> __('Disable active status at top level', 'loc_canon'),
										'hide_at_all_levels'	=> __('Disable active status at all levels', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 

							?>

						</table>

					<!-- 
					--------------------------------------------------------------------------
						HEADER LAYOUT
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Header Builder", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='help'>
							<?php 


								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Header builder', 'loc_canon'),
									'content' 				=> array(
										__('Build your own header. Select elements for each header section using the selects. Settings for each element can be found below.', 'loc_canon'),
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
										__('Text', 'loc_canon'),
										__('Toolbar (search button)', 'loc_canon'),
										__('Ad banner', 'loc_canon'),
									),
								)); 


							 ?>		

						</div>


						<table class='form-table header-layout'>

						<!-- PRE HEADER -->

							<?php 

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Pre-header', 'loc_canon'),
									'slug' 					=> 'pre_header_layout',
									'colspan'				=> 2,
									'select_options'		=> array(
										'off'							=> __('Off', 'loc_canon'),
										'pre_custom_center'				=> __('Custom Center', 'loc_canon'),
										'pre_custom_left_right'			=> __('Custom Left + Right', 'loc_canon'),
										'pre_image'						=> __('Image header', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 

							?>

						<!-- PRE HEADER: CUSTOM CENTER -->

							<tr class="dynamic_option" data-listen_to="#pre_header_layout" data-listen_for="pre_custom_center">
								<th></th>
								<td colspan="2">
					
									<select id="pre_custom_center" name="canon_options_frame[pre_custom_center]"> 

						     			<option value="off" <?php if (isset($canon_options_frame['pre_custom_center'])) {if ($canon_options_frame['pre_custom_center'] == 'off') echo "selected='selected'";} ?>><?php _e("Off", "loc_canon"); ?></option> 
						     			<option value="primary" <?php if (isset($canon_options_frame['pre_custom_center'])) {if ($canon_options_frame['pre_custom_center'] == 'primary') echo "selected='selected'";} ?>><?php _e("Primary Menu", "loc_canon"); ?></option> 
						     			<option value="secondary" <?php if (isset($canon_options_frame['pre_custom_center'])) {if ($canon_options_frame['pre_custom_center'] == 'secondary') echo "selected='selected'";} ?>><?php _e("Secondary Menu", "loc_canon"); ?></option> 
						     			<option value="social" <?php if (isset($canon_options_frame['pre_custom_center'])) {if ($canon_options_frame['pre_custom_center'] == 'social') echo "selected='selected'";} ?>><?php _e("Social Icons", "loc_canon"); ?></option> 
						     			<option value="text" <?php if (isset($canon_options_frame['pre_custom_center'])) {if ($canon_options_frame['pre_custom_center'] == 'text') echo "selected='selected'";} ?>><?php _e("Text", "loc_canon"); ?></option> 
						     			<option value="toolbar" <?php if (isset($canon_options_frame['pre_custom_center'])) {if ($canon_options_frame['pre_custom_center'] == 'toolbar') echo "selected='selected'";} ?>><?php _e("Toolbar", "loc_canon"); ?></option> 
						     			<option value="countdown" <?php if (isset($canon_options_frame['pre_custom_center'])) {if ($canon_options_frame['pre_custom_center'] == 'countdown') echo "selected='selected'";} ?>><?php _e("Countdown", "loc_canon"); ?></option> 
						     			<option value="breadcrumbs" <?php if (isset($canon_options_frame['pre_custom_center'])) {if ($canon_options_frame['pre_custom_center'] == 'breadcrumbs') echo "selected='selected'";} ?>><?php _e("Breadcrumbs", "loc_canon"); ?></option> 
						     	
									</select> 
					
							</tr>

						<!-- PRE HEADER: CUSTOM LEFT RIGHT -->

							<tr class="dynamic_option" data-listen_to="#pre_header_layout" data-listen_for="pre_custom_left_right">
								<th></th>
								<td>
					
									<select id="pre_custom_left" name="canon_options_frame[pre_custom_left]"> 

						     			<option value="off" <?php if (isset($canon_options_frame['pre_custom_left'])) {if ($canon_options_frame['pre_custom_left'] == 'off') echo "selected='selected'";} ?>><?php _e("Off", "loc_canon"); ?></option> 
						     			<option value="primary" <?php if (isset($canon_options_frame['pre_custom_left'])) {if ($canon_options_frame['pre_custom_left'] == 'primary') echo "selected='selected'";} ?>><?php _e("Primary Menu", "loc_canon"); ?></option> 
						     			<option value="secondary" <?php if (isset($canon_options_frame['pre_custom_left'])) {if ($canon_options_frame['pre_custom_left'] == 'secondary') echo "selected='selected'";} ?>><?php _e("Secondary Menu", "loc_canon"); ?></option> 
						     			<option value="social" <?php if (isset($canon_options_frame['pre_custom_left'])) {if ($canon_options_frame['pre_custom_left'] == 'social') echo "selected='selected'";} ?>><?php _e("Social Icons", "loc_canon"); ?></option> 
						     			<option value="text" <?php if (isset($canon_options_frame['pre_custom_left'])) {if ($canon_options_frame['pre_custom_left'] == 'text') echo "selected='selected'";} ?>><?php _e("Text", "loc_canon"); ?></option> 
						     			<option value="toolbar" <?php if (isset($canon_options_frame['pre_custom_left'])) {if ($canon_options_frame['pre_custom_left'] == 'toolbar') echo "selected='selected'";} ?>><?php _e("Toolbar", "loc_canon"); ?></option> 
						     			<option value="countdown" <?php if (isset($canon_options_frame['pre_custom_left'])) {if ($canon_options_frame['pre_custom_left'] == 'countdown') echo "selected='selected'";} ?>><?php _e("Countdown", "loc_canon"); ?></option> 
						     			<option value="breadcrumbs" <?php if (isset($canon_options_frame['pre_custom_left'])) {if ($canon_options_frame['pre_custom_left'] == 'breadcrumbs') echo "selected='selected'";} ?>><?php _e("Breadcrumbs", "loc_canon"); ?></option> 

									</select> 
					

								</td>
								<td>

									<select id="pre_custom_right" name="canon_options_frame[pre_custom_right]"> 

						     			<option value="off" <?php if (isset($canon_options_frame['pre_custom_right'])) {if ($canon_options_frame['pre_custom_right'] == 'off') echo "selected='selected'";} ?>><?php _e("Off", "loc_canon"); ?></option> 
						     			<option value="primary" <?php if (isset($canon_options_frame['pre_custom_right'])) {if ($canon_options_frame['pre_custom_right'] == 'primary') echo "selected='selected'";} ?>><?php _e("Primary Menu", "loc_canon"); ?></option> 
						     			<option value="secondary" <?php if (isset($canon_options_frame['pre_custom_right'])) {if ($canon_options_frame['pre_custom_right'] == 'secondary') echo "selected='selected'";} ?>><?php _e("Secondary Menu", "loc_canon"); ?></option> 
						     			<option value="social" <?php if (isset($canon_options_frame['pre_custom_right'])) {if ($canon_options_frame['pre_custom_right'] == 'social') echo "selected='selected'";} ?>><?php _e("Social Icons", "loc_canon"); ?></option> 
						     			<option value="text" <?php if (isset($canon_options_frame['pre_custom_right'])) {if ($canon_options_frame['pre_custom_right'] == 'text') echo "selected='selected'";} ?>><?php _e("Text", "loc_canon"); ?></option> 
						     			<option value="toolbar" <?php if (isset($canon_options_frame['pre_custom_right'])) {if ($canon_options_frame['pre_custom_right'] == 'toolbar') echo "selected='selected'";} ?>><?php _e("Toolbar", "loc_canon"); ?></option> 
						     			<option value="countdown" <?php if (isset($canon_options_frame['pre_custom_right'])) {if ($canon_options_frame['pre_custom_right'] == 'countdown') echo "selected='selected'";} ?>><?php _e("Countdown", "loc_canon"); ?></option> 
						     			<option value="breadcrumbs" <?php if (isset($canon_options_frame['pre_custom_right'])) {if ($canon_options_frame['pre_custom_right'] == 'breadcrumbs') echo "selected='selected'";} ?>><?php _e("Breadcrumbs", "loc_canon"); ?></option> 
						     	
									</select> 

 								</td>
							</tr>


						<!-- MAIN HEADER -->

							<?php

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Main header', 'loc_canon'),
									'slug' 					=> 'main_header_layout',
									'colspan'				=> 2,
									'select_options'		=> array(
										'off'							=> __('Off', 'loc_canon'),
										'main_custom_center'			=> __('Custom Center', 'loc_canon'),
										'main_custom_left_right'		=> __('Custom Left + Right', 'loc_canon'),
										'main_image'					=> __('Image header', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 

							?>

						<!-- MAIN HEADER: CUSTOM CENTER -->

							<tr class="dynamic_option" data-listen_to="#main_header_layout" data-listen_for="main_custom_center">
								<th></th>
								<td colspan="2">
					
									<select id="main_custom_center" name="canon_options_frame[main_custom_center]"> 

						     			<option value="off" <?php if (isset($canon_options_frame['main_custom_center'])) {if ($canon_options_frame['main_custom_center'] == 'off') echo "selected='selected'";} ?>><?php _e("Off", "loc_canon"); ?></option> 
						     			<option value="logo" <?php if (isset($canon_options_frame['main_custom_center'])) {if ($canon_options_frame['main_custom_center'] == 'logo') echo "selected='selected'";} ?>><?php _e("Logo", "loc_canon"); ?></option> 
						     			<option value="primary" <?php if (isset($canon_options_frame['main_custom_center'])) {if ($canon_options_frame['main_custom_center'] == 'primary') echo "selected='selected'";} ?>><?php _e("Primary Menu", "loc_canon"); ?></option> 
						     			<option value="secondary" <?php if (isset($canon_options_frame['main_custom_center'])) {if ($canon_options_frame['main_custom_center'] == 'secondary') echo "selected='selected'";} ?>><?php _e("Secondary Menu", "loc_canon"); ?></option> 
						     			<option value="social" <?php if (isset($canon_options_frame['main_custom_center'])) {if ($canon_options_frame['main_custom_center'] == 'social') echo "selected='selected'";} ?>><?php _e("Social Icons", "loc_canon"); ?></option> 
						     			<option value="text" <?php if (isset($canon_options_frame['main_custom_center'])) {if ($canon_options_frame['main_custom_center'] == 'text') echo "selected='selected'";} ?>><?php _e("Text", "loc_canon"); ?></option> 
						     			<option value="toolbar" <?php if (isset($canon_options_frame['main_custom_center'])) {if ($canon_options_frame['main_custom_center'] == 'toolbar') echo "selected='selected'";} ?>><?php _e("Toolbar", "loc_canon"); ?></option> 
						     			<option value="banner" <?php if (isset($canon_options_frame['main_custom_center'])) {if ($canon_options_frame['main_custom_center'] == 'banner') echo "selected='selected'";} ?>><?php _e("Ad Banner", "loc_canon"); ?></option> 
						     			<option value="countdown" <?php if (isset($canon_options_frame['main_custom_center'])) {if ($canon_options_frame['main_custom_center'] == 'countdown') echo "selected='selected'";} ?>><?php _e("Countdown", "loc_canon"); ?></option> 
						     			<option value="breadcrumbs" <?php if (isset($canon_options_frame['main_custom_center'])) {if ($canon_options_frame['main_custom_center'] == 'breadcrumbs') echo "selected='selected'";} ?>><?php _e("Breadcrumbs", "loc_canon"); ?></option> 
						     	
									</select> 
					
							</tr>

						<!-- MAIN HEADER: CUSTOM LEFT RIGHT -->

							<tr class="dynamic_option" data-listen_to="#main_header_layout" data-listen_for="main_custom_left_right">
								<th></th>
								<td>
					
									<select id="main_custom_left" name="canon_options_frame[main_custom_left]"> 

						     			<option value="off" <?php if (isset($canon_options_frame['main_custom_left'])) {if ($canon_options_frame['main_custom_left'] == 'off') echo "selected='selected'";} ?>><?php _e("Off", "loc_canon"); ?></option> 
						     			<option value="logo" <?php if (isset($canon_options_frame['main_custom_left'])) {if ($canon_options_frame['main_custom_left'] == 'logo') echo "selected='selected'";} ?>><?php _e("Logo", "loc_canon"); ?></option> 
						     			<option value="primary" <?php if (isset($canon_options_frame['main_custom_left'])) {if ($canon_options_frame['main_custom_left'] == 'primary') echo "selected='selected'";} ?>><?php _e("Primary Menu", "loc_canon"); ?></option> 
						     			<option value="secondary" <?php if (isset($canon_options_frame['main_custom_left'])) {if ($canon_options_frame['main_custom_left'] == 'secondary') echo "selected='selected'";} ?>><?php _e("Secondary Menu", "loc_canon"); ?></option> 
						     			<option value="social" <?php if (isset($canon_options_frame['main_custom_left'])) {if ($canon_options_frame['main_custom_left'] == 'social') echo "selected='selected'";} ?>><?php _e("Social Icons", "loc_canon"); ?></option> 
						     			<option value="text" <?php if (isset($canon_options_frame['main_custom_left'])) {if ($canon_options_frame['main_custom_left'] == 'text') echo "selected='selected'";} ?>><?php _e("Text", "loc_canon"); ?></option> 
						     			<option value="toolbar" <?php if (isset($canon_options_frame['main_custom_left'])) {if ($canon_options_frame['main_custom_left'] == 'toolbar') echo "selected='selected'";} ?>><?php _e("Toolbar", "loc_canon"); ?></option> 
						     			<option value="banner" <?php if (isset($canon_options_frame['main_custom_left'])) {if ($canon_options_frame['main_custom_left'] == 'banner') echo "selected='selected'";} ?>><?php _e("Ad Banner", "loc_canon"); ?></option> 
						     			<option value="countdown" <?php if (isset($canon_options_frame['main_custom_left'])) {if ($canon_options_frame['main_custom_left'] == 'countdown') echo "selected='selected'";} ?>><?php _e("Countdown", "loc_canon"); ?></option> 
						     			<option value="breadcrumbs" <?php if (isset($canon_options_frame['main_custom_left'])) {if ($canon_options_frame['main_custom_left'] == 'breadcrumbs') echo "selected='selected'";} ?>><?php _e("Breadcrumbs", "loc_canon"); ?></option> 
						     	
									</select> 
					

								</td>
								<td>

									<select id="main_custom_right" name="canon_options_frame[main_custom_right]"> 

						     			<option value="off" <?php if (isset($canon_options_frame['main_custom_right'])) {if ($canon_options_frame['main_custom_right'] == 'off') echo "selected='selected'";} ?>><?php _e("Off", "loc_canon"); ?></option> 
						     			<option value="logo" <?php if (isset($canon_options_frame['main_custom_right'])) {if ($canon_options_frame['main_custom_right'] == 'logo') echo "selected='selected'";} ?>><?php _e("Logo", "loc_canon"); ?></option> 
						     			<option value="primary" <?php if (isset($canon_options_frame['main_custom_right'])) {if ($canon_options_frame['main_custom_right'] == 'primary') echo "selected='selected'";} ?>><?php _e("Primary Menu", "loc_canon"); ?></option> 
						     			<option value="secondary" <?php if (isset($canon_options_frame['main_custom_right'])) {if ($canon_options_frame['main_custom_right'] == 'secondary') echo "selected='selected'";} ?>><?php _e("Secondary Menu", "loc_canon"); ?></option> 
						     			<option value="social" <?php if (isset($canon_options_frame['main_custom_right'])) {if ($canon_options_frame['main_custom_right'] == 'social') echo "selected='selected'";} ?>><?php _e("Social Icons", "loc_canon"); ?></option> 
						     			<option value="text" <?php if (isset($canon_options_frame['main_custom_right'])) {if ($canon_options_frame['main_custom_right'] == 'text') echo "selected='selected'";} ?>><?php _e("Text", "loc_canon"); ?></option> 
						     			<option value="toolbar" <?php if (isset($canon_options_frame['main_custom_right'])) {if ($canon_options_frame['main_custom_right'] == 'toolbar') echo "selected='selected'";} ?>><?php _e("Toolbar", "loc_canon"); ?></option> 
						     			<option value="banner" <?php if (isset($canon_options_frame['main_custom_right'])) {if ($canon_options_frame['main_custom_right'] == 'banner') echo "selected='selected'";} ?>><?php _e("Ad Banner", "loc_canon"); ?></option> 
						     			<option value="countdown" <?php if (isset($canon_options_frame['main_custom_right'])) {if ($canon_options_frame['main_custom_right'] == 'countdown') echo "selected='selected'";} ?>><?php _e("Countdown", "loc_canon"); ?></option> 
						     			<option value="breadcrumbs" <?php if (isset($canon_options_frame['main_custom_right'])) {if ($canon_options_frame['main_custom_right'] == 'breadcrumbs') echo "selected='selected'";} ?>><?php _e("Breadcrumbs", "loc_canon"); ?></option> 
						     	
									</select> 

 								</td>
							</tr>

						<!-- POST HEADER -->

							<?php							
								
								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Post-header', 'loc_canon'),
									'slug' 					=> 'post_header_layout',
									'colspan'				=> 2,
									'select_options'		=> array(
										'off'						=> __('Off', 'loc_canon'),
										'post_custom_center'		=> __('Custom Center', 'loc_canon'),
										'post_custom_left_right'	=> __('Custom Left + Right', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 
								
							?>

						<!-- POST HEADER: CUSTOM CENTER -->

							<tr class="dynamic_option" data-listen_to="#post_header_layout" data-listen_for="post_custom_center">
								<th></th>
								<td colspan="2">
					
									<select id="post_custom_center" name="canon_options_frame[post_custom_center]"> 

						     			<option value="off" <?php if (isset($canon_options_frame['post_custom_center'])) {if ($canon_options_frame['post_custom_center'] == 'off') echo "selected='selected'";} ?>><?php _e("Off", "loc_canon"); ?></option> 
						     			<option value="primary" <?php if (isset($canon_options_frame['post_custom_center'])) {if ($canon_options_frame['post_custom_center'] == 'primary') echo "selected='selected'";} ?>><?php _e("Primary Menu", "loc_canon"); ?></option> 
						     			<option value="secondary" <?php if (isset($canon_options_frame['post_custom_center'])) {if ($canon_options_frame['post_custom_center'] == 'secondary') echo "selected='selected'";} ?>><?php _e("Secondary Menu", "loc_canon"); ?></option> 
						     			<option value="social" <?php if (isset($canon_options_frame['post_custom_center'])) {if ($canon_options_frame['post_custom_center'] == 'social') echo "selected='selected'";} ?>><?php _e("Social Icons", "loc_canon"); ?></option> 
						     			<option value="text" <?php if (isset($canon_options_frame['post_custom_center'])) {if ($canon_options_frame['post_custom_center'] == 'text') echo "selected='selected'";} ?>><?php _e("Text", "loc_canon"); ?></option> 
						     			<option value="toolbar" <?php if (isset($canon_options_frame['post_custom_center'])) {if ($canon_options_frame['post_custom_center'] == 'toolbar') echo "selected='selected'";} ?>><?php _e("Toolbar", "loc_canon"); ?></option> 
						     			<option value="countdown" <?php if (isset($canon_options_frame['post_custom_center'])) {if ($canon_options_frame['post_custom_center'] == 'countdown') echo "selected='selected'";} ?>><?php _e("Countdown", "loc_canon"); ?></option> 
						     			<option value="breadcrumbs" <?php if (isset($canon_options_frame['post_custom_center'])) {if ($canon_options_frame['post_custom_center'] == 'breadcrumbs') echo "selected='selected'";} ?>><?php _e("Breadcrumbs", "loc_canon"); ?></option> 
						     	
									</select> 
					
							</tr>

						<!-- POST HEADER: CUSTOM LEFT RIGHT -->

							<tr class="dynamic_option" data-listen_to="#post_header_layout" data-listen_for="post_custom_left_right">
								<th></th>
								<td>
					
									<select id="post_custom_left" name="canon_options_frame[post_custom_left]"> 

						     			<option value="off" <?php if (isset($canon_options_frame['post_custom_left'])) {if ($canon_options_frame['post_custom_left'] == 'off') echo "selected='selected'";} ?>><?php _e("Off", "loc_canon"); ?></option> 
						     			<option value="primary" <?php if (isset($canon_options_frame['post_custom_left'])) {if ($canon_options_frame['post_custom_left'] == 'primary') echo "selected='selected'";} ?>><?php _e("Primary Menu", "loc_canon"); ?></option> 
						     			<option value="secondary" <?php if (isset($canon_options_frame['post_custom_left'])) {if ($canon_options_frame['post_custom_left'] == 'secondary') echo "selected='selected'";} ?>><?php _e("Secondary Menu", "loc_canon"); ?></option> 
						     			<option value="social" <?php if (isset($canon_options_frame['post_custom_left'])) {if ($canon_options_frame['post_custom_left'] == 'social') echo "selected='selected'";} ?>><?php _e("Social Icons", "loc_canon"); ?></option> 
						     			<option value="text" <?php if (isset($canon_options_frame['post_custom_left'])) {if ($canon_options_frame['post_custom_left'] == 'text') echo "selected='selected'";} ?>><?php _e("Text", "loc_canon"); ?></option> 
						     			<option value="toolbar" <?php if (isset($canon_options_frame['post_custom_left'])) {if ($canon_options_frame['post_custom_left'] == 'toolbar') echo "selected='selected'";} ?>><?php _e("Toolbar", "loc_canon"); ?></option> 
						     			<option value="countdown" <?php if (isset($canon_options_frame['post_custom_left'])) {if ($canon_options_frame['post_custom_left'] == 'countdown') echo "selected='selected'";} ?>><?php _e("Countdown", "loc_canon"); ?></option> 
						     			<option value="breadcrumbs" <?php if (isset($canon_options_frame['post_custom_left'])) {if ($canon_options_frame['post_custom_left'] == 'breadcrumbs') echo "selected='selected'";} ?>><?php _e("Breadcrumbs", "loc_canon"); ?></option> 
						     	
									</select> 
					

								</td>
								<td>

									<select id="post_custom_right" name="canon_options_frame[post_custom_right]"> 

						     			<option value="off" <?php if (isset($canon_options_frame['post_custom_right'])) {if ($canon_options_frame['post_custom_right'] == 'off') echo "selected='selected'";} ?>><?php _e("Off", "loc_canon"); ?></option> 
						     			<option value="primary" <?php if (isset($canon_options_frame['post_custom_right'])) {if ($canon_options_frame['post_custom_right'] == 'primary') echo "selected='selected'";} ?>><?php _e("Primary Menu", "loc_canon"); ?></option> 
						     			<option value="secondary" <?php if (isset($canon_options_frame['post_custom_right'])) {if ($canon_options_frame['post_custom_right'] == 'secondary') echo "selected='selected'";} ?>><?php _e("Secondary Menu", "loc_canon"); ?></option> 
						     			<option value="social" <?php if (isset($canon_options_frame['post_custom_right'])) {if ($canon_options_frame['post_custom_right'] == 'social') echo "selected='selected'";} ?>><?php _e("Social Icons", "loc_canon"); ?></option> 
						     			<option value="text" <?php if (isset($canon_options_frame['post_custom_right'])) {if ($canon_options_frame['post_custom_right'] == 'text') echo "selected='selected'";} ?>><?php _e("Text", "loc_canon"); ?></option> 
						     			<option value="toolbar" <?php if (isset($canon_options_frame['post_custom_right'])) {if ($canon_options_frame['post_custom_right'] == 'toolbar') echo "selected='selected'";} ?>><?php _e("Toolbar", "loc_canon"); ?></option> 
						     			<option value="countdown" <?php if (isset($canon_options_frame['post_custom_right'])) {if ($canon_options_frame['post_custom_right'] == 'countdown') echo "selected='selected'";} ?>><?php _e("Countdown", "loc_canon"); ?></option> 
						     			<option value="breadcrumbs" <?php if (isset($canon_options_frame['post_custom_right'])) {if ($canon_options_frame['post_custom_right'] == 'breadcrumbs') echo "selected='selected'";} ?>><?php _e("Breadcrumbs", "loc_canon"); ?></option> 
						     	
									</select> 

 								</td>
							</tr>

						</table>


					<!-- 
					--------------------------------------------------------------------------
						MAIN HEADER ADJUSTMENTS
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Main Header Adjustments", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='help'>
							<?php 

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
						HEADER ELEMENT: LOGO
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Logo", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='help'>
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
				                            $logo_url = get_template_directory_uri() .'/img/logo@2x.png';
				                        }
				                        $logo_size = getimagesize($logo_url);
				                        if (!empty($canon_options_frame['logo_max_width'])) {
					                        $compression_ratio = $logo_size[0] / (int) $canon_options_frame['logo_max_width'];
				                        } else {
					                        $compression_ratio = 999;
				                        }

									 ?>
									<img class="thelogo" width="<?php if (!empty($canon_options_frame['logo_max_width'])) echo $canon_options_frame['logo_max_width']; ?>" src="<?php echo $logo_url; ?>"><br><br>
									<?php printf("<i>(%s%s %s%s%s)</i>", __("Original size: Width: ", "loc_canon"), $logo_size[0], __("pixels, height: ", "loc_canon") , $logo_size[1], __(" pixels", "loc_canon")); ?><br>
                                    <?php printf("<i>(%s%s %s%.2f)</i>",__("Resized to max width: ", "loc_canon") , $canon_options_frame['logo_max_width'], __("pixels. Compression ratio: ", "loc_canon"), $compression_ratio); ?><br>
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
						HEADER ELEMENT: IMAGE
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Header Image", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='help'>
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
									'title' 				=> __('Use Parallax Scrolling', 'loc_canon'),
									'content' 				=> array(
										__('Enable parallax scrolling.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Parallax ratio', 'loc_canon'),
									'content' 				=> array(
										__('Number usually between 0 and 1 (but can be up to 2). 1 is no parallax scroll. 0 is max parallax scroll (image does not move when window is scrolling). Above 1 and image will scroll more than window.', 'loc_canon'),
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
									'type'					=> 'checkbox',
									'title' 				=> __('Use Parallax Scrolling', 'loc_canon'),
									'slug' 					=> 'header_img_use_parallax',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Parallax ratio', 'loc_canon'),
									'slug' 					=> 'header_img_parallax_ratio',
									'min'					=> '0',
									'max'					=> '2',
									'step'					=> '0.05',
									'postfix'				=> '<i> (0 for no-scroll)</i>',
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
						HEADER ELEMENT: BANNER
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Ad Banner", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='help'>
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
						HEADER ELEMENT: HEADER TEXT
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Header Text", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='help'>
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
									'type'					=> 'text',
									'title' 				=> __('Header text', 'loc_canon'),
									'slug' 					=> 'header_text',
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
									'options_name'			=> 'canon_options_frame',
								)); 

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

								for ($i = 0; $i < count($canon_options_frame['social_links']); $i++) {  
								?>

								<tr valign='top' class='social_links_row'>
									<th scope='row'><?php _e("Social link", "loc_canon"); ?> <?php echo $i+1; ?></th>
									<td>
										<select class="social_links_icon fa_select" name="canon_options_frame[social_links][<?php echo $i; ?>][0]"> 
											<?php 

												for ($n = 0; $n < count($font_awesome_array); $n++) {  
												?>
							     					<option value="<?php echo $font_awesome_array[$n]; ?>" <?php if (isset($canon_options_frame['social_links'][$i][0])) {if ($canon_options_frame['social_links'][$i][0] == $font_awesome_array[$n]) echo "selected='selected'";} ?>><?php echo $font_awesome_array[$n]; ?></option> 
												<?php
												}

											?>
										</select> 

									<i class="fa <?php if (isset($canon_options_frame['social_links'][$i][0])) { echo $canon_options_frame['social_links'][$i][0]; } else { echo "fa-flag"; } ?>"></i>

									<input type='text' class='social_links_link' name='canon_options_frame[social_links][<?php echo $i; ?>][1]' value='<?php if (isset($canon_options_frame['social_links'][$i][1])) echo $canon_options_frame['social_links'][$i][1]; ?>'>
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
						HEADER ELEMENT: TOOLBAR
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Toolbar", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='help'>
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
						HEADER ELEMENT: COUNTDOWN
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Countdown", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='help'>
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
										__('Countdown description.', 'loc_canon'),
									),
								)); 

							?>
						</div>

						<table class='form-table'>


							<?php 

								fw_option(array(
									'type'					=> 'text',
									'title' 				=> __('Countdown to', 'loc_canon'),
									'slug' 					=> 'countdown_datetime_string',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'text',
									'title' 				=> __('GMT Offset', 'loc_canon'),
									'slug' 					=> 'countdown_gmt_offset',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'text',
									'title' 				=> __('Description', 'loc_canon'),
									'slug' 					=> 'countdown_description',
									'options_name'			=> 'canon_options_frame',
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
									'title' 				=> __('Show breadcrumbs footer', 'loc_canon'),
									'content' 				=> array(
										__('Footer containing breadcrumbs.', 'loc_canon'),
									),
								)); 

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

							?>
						</div>

						<table class='form-table'>

							<?php 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Show breadcrumbs footer', 'loc_canon'),
									'slug' 					=> 'show_pre_footer',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Show widgetized footer', 'loc_canon'),
									'slug' 					=> 'show_main_footer',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Show social footer', 'loc_canon'),
									'slug' 					=> 'show_post_footer',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'textarea',
									'title' 				=> __('Footer text', 'loc_canon'),
									'slug' 					=> 'footer_text',
									'rows'					=> '5',
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

