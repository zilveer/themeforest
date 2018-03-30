	<div class="wrap">

		<div id="icon-themes" class="icon32"></div>

		<h2><?php printf( "%s %s - %s", esc_attr(wp_get_theme()->Name), esc_attr(__("Settings", "loc_canon")), esc_attr(__("Advanced", "loc_canon")) ); ?></h2>

		<?php 
			$canon_options_advanced = get_option('canon_options_advanced'); 

			//LOAD OPTIONS
			$canon_options = get_option('canon_options'); 
			$canon_options_frame = get_option('canon_options_frame'); 
			$canon_options_post = get_option('canon_options_post'); 
			$canon_options_appearance = get_option('canon_options_appearance');
			$canon_options_advanced = get_option('canon_options_advanced'); 

		////////////////////////////////////////////////
		// IMPORT/EXPORT SETTINGS
		////////////////////////////////////////////////

			//MAKE SUPERARRAY AND ENCODE
			$canon_options_superarray = array(
				'canon_options' => $canon_options,
				'canon_options_frame' => $canon_options_frame,
				'canon_options_post' => $canon_options_post,
				'canon_options_appearance' => $canon_options_appearance,
				'canon_options_advanced' => $canon_options_advanced,

			);
			$encoded_serialized_options_data = base64_encode(serialize($canon_options_superarray));

			//IF IMPORT DATA WAS CLICKED
			if ( (isset($canon_options_advanced['import_data'])) && (isset($canon_options_advanced['canon_options_data'])) )  {
				if ($canon_options_advanced['import_data'] == 'IMPORT') {
					
					//get import data (returns false if improper structured data sent)
					$import_superarray = @unserialize(base64_decode($canon_options_advanced['canon_options_data']));

					//only proceed if unserialize succeeded
					if ($import_superarray) {
						//replace old data with new data
						$canon_options = mb_array_replace($canon_options, $import_superarray['canon_options']);
						$canon_options_frame = mb_array_replace($canon_options_frame, $import_superarray['canon_options_frame']);
						$canon_options_post = mb_array_replace($canon_options_post, $import_superarray['canon_options_post']);
						$canon_options_appearance = mb_array_replace($canon_options_appearance, $import_superarray['canon_options_appearance']);
						$canon_options_advanced = mb_array_replace($canon_options_advanced, $import_superarray['canon_options_advanced']);

						//update data to database
						update_option('canon_options', $canon_options);
						update_option('canon_options_frame', $canon_options_frame);
						update_option('canon_options_post', $canon_options_post);
						update_option('canon_options_appearance', $canon_options_appearance);
						update_option('canon_options_advanced', $canon_options_advanced);

						//get data from database (is this not superfluous?)
						$canon_options = get_option('canon_options'); 
						$canon_options_frame = get_option('canon_options_frame'); 
						$canon_options_post = get_option('canon_options_post'); 
						$canon_options_appearance = get_option('canon_options_appearance');
						$canon_options_advanced = get_option('canon_options_advanced'); 

						//display success notice:
						echo '<div class="updated"><p>Settings successfully imported!</p></div>';

					} else {
							
						//display fail notice:
						echo '<div class="error"><p>Import failed!</p></div>';

					}

				}
					
			}

		////////////////////////////////////////////////
		// IMPORT/EXPORT WIDGETS
		////////////////////////////////////////////////

			// MAKE WIDGETS SUPERARRAY
			$canon_widgets_superarray = array();

			// GET AND ADD WIDGET AREAS SUBARRAY
			$widget_areas = get_option('sidebars_widgets');
			$canon_widgets_superarray['widget_areas'] = $widget_areas;

			// CREATE AND ADD ACTIVE WIDGETS SUBARRAY
			$active_widgets = array();
			foreach ($widget_areas as $area_slug => $area_content) {			// first we create an array of active widget slugs
				if (is_array($area_content) && !empty($area_content)) {
					foreach ($area_content as $key => $widget_name) {
						// grab and delete postfix
						$widget_name_explode_array = explode('-', $widget_name);
						$last_index = count($widget_name_explode_array)-1;
						$postfix = "-" . $widget_name_explode_array[$last_index];
						$widget_name = str_replace($postfix, "", $widget_name);
						array_push($active_widgets, $widget_name);
					}
				}
			}
			$active_widgets = array_unique($active_widgets);
			foreach ($active_widgets as $key => $widget_slug) {					// then we convert the array of active widget slugs to an assoc array of active widget slugs and their settings
				$widget_settings_array = get_option('widget_' . $widget_slug);
				$active_widgets[$widget_slug] = $widget_settings_array;
				unset($active_widgets[$key]);

			}
			$canon_widgets_superarray['active_widgets'] = $active_widgets;
			$encoded_serialized_widgets_data = base64_encode(serialize($canon_widgets_superarray));

			//IF IMPORT widgetsDATA WAS CLICKED
			if ( (isset($canon_options_advanced['import_widgets_data'])) && (isset($canon_options_advanced['canon_widgets_data'])) )  {
				if ($canon_options_advanced['import_widgets_data'] == 'IMPORT') {
					
					//get import data (returns false if improper structured data sent)
					$import_widgets_superarray = @unserialize(base64_decode($canon_options_advanced['canon_widgets_data']));

					//only proceed if unserialize succeeded
					if ($import_widgets_superarray) {

						// first replace widget areas
						update_option('sidebars_widgets', $import_widgets_superarray['widget_areas']);

						// next replace active widget settings
						foreach ($import_widgets_superarray['active_widgets'] as $widget_slug => $widget_content) {
							update_option('widget_' . $widget_slug, $widget_content);
						}

						// update data to database
						unset($canon_options_advanced['import_widgets_data']);
						unset($canon_options_advanced['canon_widgets_data']);
						update_option('canon_options_advanced', $canon_options_advanced);

						// get data from database (is this not superfluous?)
						$canon_options_advanced = get_option('canon_options_advanced'); 

						//display success notice:
						echo '<div class="updated"><p>Widgets successfully imported!</p></div>';

					} else {
							
						//display fail notice:
						echo '<div class="error"><p>Import failed!</p></div>';

					}

				}
					
			}

		////////////////////////////////////////////////
		// RESET SETTINGS
		////////////////////////////////////////////////

			//RESET BASIC
			if ($canon_options_advanced['reset_basic'] == 'RESET') {
				delete_option('canon_options');
				delete_option('canon_options_frame');
				delete_option('canon_options_post');
				delete_option('canon_options_appearance');

				// clear reset_basic var
				$canon_options_advanced['reset_basic'] = "";	// has to be reset individually because the advanced options is not reset.
				update_option('canon_options_advanced', $canon_options_advanced);

				// output response
				echo "<script>alert('Basic theme settings have been reset!'); window.location.reload();</script>";
			}


			//RESET ALL
			if ($canon_options_advanced['reset_all'] == 'RESET') {
				delete_option('canon_options');
				delete_option('canon_options_frame');
				delete_option('canon_options_post');
				delete_option('canon_options_appearance');
				delete_option('canon_options_advanced');

				// reset TGMPA notice (brings it back if dismissed)
				delete_user_meta(get_current_user_id(), 'tgmpa_dismissed_notice');

				// output response
				echo "<script>alert('All theme settings have been reset!'); window.location.reload();</script>";
			}


		////////////////////////////////////////////////
		// MISC
		////////////////////////////////////////////////

			// remove template + remove duplicate custom widget areas and rearrange keys
			if (isset($canon_options_advanced['custom_widget_areas'][9999])) { unset($canon_options_advanced['custom_widget_areas'][9999]); }
			$canon_options_advanced['custom_widget_areas'] = array_values(array_unique($canon_options_advanced['custom_widget_areas'], SORT_REGULAR));

			// delete_option('canon_options_advanced');
			// var_dump($canon_options_advanced);

		?>

		<br>
		
		<div class="options_wrapper canon-options">
		
			<div class="table_container">

				<form method="post" action="options.php" enctype="multipart/form-data">
					<?php settings_fields('group_canon_options_advanced'); ?>				<!-- very important to add these two functions as they mediate what wordpress generates automatically from the functions.php -->
					<?php do_settings_sections('handle_canon_options_advanced'); ?>		

					<?php submit_button(); ?>
					
					<!-- 

						INDEX

						CUSTOM WIDGET AREAS (CWA)
						FINAL CALL CSS
						IMPORT/EXPORT SETTINGS
						IMPORT/EXPORT WIDGETS

					-->

					<!-- 
					--------------------------------------------------------------------------
						CUSTOM WIDGET AREAS (CWA)
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Widget Areas Manager", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php
								
								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Widget Areas Manager', 'loc_canon'),
									'content' 				=> array(
										__('Here you can create new custom widget areas. Give each widget area a unique name.', 'loc_canon'),
										__('You can drag and drop to decide the order of which the widget areas will display in the widgets section.', 'loc_canon'),
										__('To add widgets to your custom widget areas go to <i>WordPress Appearance > Widgets</i>.', 'loc_canon'),
									),
								)); 

							?>

						</div>

						<table class='form-table'>

							<tr>

								<th scope='row'></th>
								<td>
									<ul id="cwa_template">

												<!-- TEMPLATE: C/P LI -->
												<?php $i=9999; ?>

												<li>
													<span><?php _e("Custom Widget Area Name", "loc_canon"); ?>:<span>
													<span class="cwa_del"><a href="#"><?php _e("Delete", "loc_canon"); ?></a></span>
													<input class='cwa_option' type='text' name='canon_options_advanced[custom_widget_areas][<?php echo esc_attr($i); ?>]' value="<?php if (isset($canon_options_advanced['custom_widget_areas'][$i])) echo htmlspecialchars($canon_options_advanced['custom_widget_areas'][$i]); ?>">
												</li>


									</ul>
								</td>
							</tr>

							<tr>
								<th scope='row'><?php _e("Custom Widget Areas", "loc_canon"); ?></th>
								<td>
									<ul id="cwa_list" class="cwa_sortable">

										<?php 

											if (isset($canon_options_advanced['custom_widget_areas'])) {

												for ($i = 0; $i < count($canon_options_advanced['custom_widget_areas']); $i++) {  
												?>

												<li>
													<span><?php _e("Custom Widget Area Name", "loc_canon"); ?>:<span>
													<span class="cwa_del"><a href="#"><?php _e("Delete", "loc_canon"); ?></a></span>
													<input class='cwa_option' type='text' name='canon_options_advanced[custom_widget_areas][<?php echo esc_attr($i); ?>]' value="<?php if (isset($canon_options_advanced['custom_widget_areas'][$i])) echo htmlspecialchars($canon_options_advanced['custom_widget_areas'][$i]); ?>">
												</li>

												<?php
												}

											}

										?>

									</ul>
								</td>
							</tr>

							<tr valign='top'>
								<th scope='row'></th>
								<td>
									<input type="button" class="button button_add_cwa" value="<?php _e("Create new custom widget area", "loc_canon"); ?>" />
									<br><br>
								</td>
							</tr>




						</table>


					<!-- 
					--------------------------------------------------------------------------
						FINAL CALL CSS
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Final Call CSS", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>

							<?php
								
								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Final Call CSS', 'loc_canon'),
									'content' 				=> array(
										__('Put your own CSS code here. This CSS will be called last and overwrites all theme CSS.', 'loc_canon'),
										__('Final call CSS will be exported/imported along with all other theme settings when using the <i>Import/Export</i> option.', 'loc_canon'),
									),
								)); 

							?>

						</div>

						<table class='form-table'>

							<?php 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Use final call CSS', 'loc_canon'),
									'slug' 					=> 'use_final_call_css',
									'options_name'			=> 'canon_options_advanced',
								)); 

							?>


							<tr valign='top'>
								<th></th>
								<td colspan="2">
									&lt;style&gt;
									<textarea id='final_call_css' name='canon_options_advanced[final_call_css]' rows='10' cols='100'><?php if (isset($canon_options_advanced['final_call_css'])) echo htmlentities($canon_options_advanced['final_call_css']); ?></textarea>
									&lt;/style&gt;

								</td>
							</tr>

						</table>




						<table class='form-table'>

						</table>


					<!-- 
					--------------------------------------------------------------------------
						IMPORT/EXPORT SETTINGS
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Import/Export Settings", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Import/Export settings', 'loc_canon'),
									'content' 				=> array(
										__('Use this section to import/export your settings.', 'loc_canon'),
										__('<strong>WARNING</strong>: Settings may be overwritten/deleted/replaced. ', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> __('Generate settings data', 'loc_canon'),
									'content' 				=> array(
										__('Clicking this button will generate settings data. You can copy this data from the settings data window.', 'loc_canon'),
										__('Clicking the window will select all text.', 'loc_canon'),
										__('Press CTRL+C on your keyboard or right click selected text and select copy.', 'loc_canon'),
										__('Once you have copied the data you can either save it to a text document/file (safest) or simply keep the data in your copy/paste clipboard (not safe).', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> __('Import settings data', 'loc_canon'),
									'content' 				=> array(
										__('Clicking this button will import your settings data from the data string supplied in the settings data window.', 'loc_canon'),
										__('Make sure you paste all of the data into the settings data textarea/window. If part of the code is altered or left out import will fail.', 'loc_canon'),
										__('Click the "Import settings data" button.', 'loc_canon'),
										__('Your setting have now been imported.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> __('Load predefined settings data', 'loc_canon'),
									'content' 				=> array(
										__('Use this select to load predefined settings data into the data window.', 'loc_canon'),
										__('Click the "Import settings data" button.', 'loc_canon'),
										__('The predefined settings have now been imported.', 'loc_canon'),
									),
								)); 

							?>
						</div>

						<table class='form-table import-export'>

							<tr valign='top'>
								<th scope='row'><?php _e("Settings data", "loc_canon"); ?></th>
								<td colspan="2">
									<textarea id='canon_options_data' class='canon_export_data' name='canon_options_advanced[canon_options_data]' rows='5' cols='100'></textarea>
								</td>
							</tr>

							<tr valign='top'>
								<th scope='row'></th>
								<td>
									<input type="hidden" id="import_data" name="canon_options_advanced[import_data]" value="">

									<input type="button" class="button button_generate_data" value="Generate settings data" data-export_data="<?php echo esc_attr($encoded_serialized_options_data); ?>" />
									<button id="button_import_data" name="button_import_data" class="button-secondary"><?php _e("Import settings data", "loc_canon"); ?></button>
								</td>

								<td class="float-right">
									<select class="predefined-data-select">
							     		<option value="" selected='selected'><?php _e('Load predefined settings data...', 'loc_canon'); ?></option> 
							     		
							     		<option value="YTo1OntzOjEzOiJjYW5vbl9vcHRpb25zIjthOjE1OntzOjk6InJlc2V0X2FsbCI7czowOiIiO3M6MTE6InJlc2V0X2Jhc2ljIjtzOjA6IiI7czoyMToidXNlX3Jlc3BvbnNpdmVfZGVzaWduIjtzOjc6ImNoZWNrZWQiO3M6MTY6InVzZV9ib3hlZF9kZXNpZ24iO3M6NzoiY2hlY2tlZCI7czoyMDoidXNlX21haW50ZW5hbmNlX21vZGUiO3M6OToidW5jaGVja2VkIjtzOjE3OiJtYWludGVuYW5jZV90aXRsZSI7czozMDoiV2UgYXJlIGRvaW5nIG1haW50ZW5hbmNlIHdvcmshIjtzOjE1OiJtYWludGVuYW5jZV9tc2ciO3M6MTM5OiJEb24ndCB3b3JyeSB3ZSB3aWxsIGJlIGJhY2sgc29vbiAtLSBpbiB0aGUgbWVhbnRpbWUgd2h5IGRvbid0IHlvdSB2aXNpdCA8YSBocmVmPSdodHRwOi8vd3d3Lmdvb2dsZS5jb20nPjxzdHJvbmc+PHU+R29vZ2xlPC91Pjwvc3Ryb25nPjwvYT4uIjtzOjE4OiJzaWRlYmFyc19hbGlnbm1lbnQiO3M6NToicmlnaHQiO3M6ODoiZGV2X21vZGUiO3M6NzoiY2hlY2tlZCI7czoxODoiYXV0b2NvbXBsZXRlX3dvcmRzIjtzOjcyOiJjKyssIGpxdWVyeSwgSSBsaWtlIGpRdWVyeSwgamF2YSwgcGhwLCBjb2xkZnVzaW9uLCBqYXZhc2NyaXB0LCBhc3AsIHJ1YnkiO3M6Mjc6ImhpZGVfdGhlbWVfbWV0YV9kZXNjcmlwdGlvbiI7czo5OiJ1bmNoZWNrZWQiO3M6MTM6ImhpZGVfdGhlbWVfb2ciO3M6OToidW5jaGVja2VkIjtzOjEyOiJmb250ZmFjZV9maXgiO3M6OToidW5jaGVja2VkIjtzOjExOiJmYXZpY29uX3VybCI7czowOiIiO3M6MjE6Imdvb2dsZV9hbmFseXRpY3NfY29kZSI7czowOiIiO31zOjE5OiJjYW5vbl9vcHRpb25zX2ZyYW1lIjthOjU5OntzOjE3OiJoZWFkZXJfcHJlX2xheW91dCI7czoyODoiaGVhZGVyX3ByZV9jdXN0b21fbGVmdF9yaWdodCI7czoyMjoiaGVhZGVyX3ByZV9jdXN0b21fbGVmdCI7czoxMToiaGVhZGVyX3RleHQiO3M6MjM6ImhlYWRlcl9wcmVfY3VzdG9tX3JpZ2h0IjtzOjY6InNvY2lhbCI7czoxODoiaGVhZGVyX21haW5fbGF5b3V0IjtzOjI5OiJoZWFkZXJfbWFpbl9jdXN0b21fbGVmdF9yaWdodCI7czoyNToiaGVhZGVyX21haW5fY3VzdG9tX2NlbnRlciI7czo0OiJsb2dvIjtzOjE4OiJoZWFkZXJfcG9zdF9sYXlvdXQiO3M6Mjk6ImhlYWRlcl9wb3N0X2N1c3RvbV9sZWZ0X3JpZ2h0IjtzOjIzOiJob21lcGFnZV9mZWF0dXJlX2xheW91dCI7czozOiJvZmYiO3M6MTc6ImZvb3Rlcl9wcmVfbGF5b3V0IjtzOjI4OiJmb290ZXJfcHJlX2N1c3RvbV9sZWZ0X3JpZ2h0IjtzOjIyOiJmb290ZXJfcHJlX2N1c3RvbV9sZWZ0IjtzOjExOiJicmVhZGNydW1icyI7czoyMzoiZm9vdGVyX3ByZV9jdXN0b21fcmlnaHQiO3M6Mzoib2ZmIjtzOjE4OiJmb290ZXJfbWFpbl9sYXlvdXQiO3M6MjM6ImJsb2NrX3dpZGdldGl6ZWRfZm9vdGVyIjtzOjE4OiJmb290ZXJfcG9zdF9sYXlvdXQiO3M6Mjk6ImZvb3Rlcl9wb3N0X2N1c3RvbV9sZWZ0X3JpZ2h0IjtzOjIzOiJmb290ZXJfcG9zdF9jdXN0b21fbGVmdCI7czoxMToiZm9vdGVyX3RleHQiO3M6MjQ6ImZvb3Rlcl9wb3N0X2N1c3RvbV9yaWdodCI7czo2OiJzb2NpYWwiO3M6MTg6ImhlYWRlcl9wYWRkaW5nX3RvcCI7czoyOiIyNSI7czoyMToiaGVhZGVyX3BhZGRpbmdfYm90dG9tIjtzOjI6IjI1IjtzOjIwOiJwb3NfbGVmdF9lbGVtZW50X3RvcCI7czoxOiIwIjtzOjIxOiJwb3NfbGVmdF9lbGVtZW50X2xlZnQiO3M6MToiMCI7czoyMToicG9zX3JpZ2h0X2VsZW1lbnRfdG9wIjtzOjI6IjEwIjtzOjIzOiJwb3NfcmlnaHRfZWxlbWVudF9yaWdodCI7czoxOiIwIjtzOjIwOiJ1c2Vfc3RpY2t5X3ByZWhlYWRlciI7czo5OiJ1bmNoZWNrZWQiO3M6MTc6InVzZV9zdGlja3lfaGVhZGVyIjtzOjk6InVuY2hlY2tlZCI7czoyMToidXNlX3N0aWNreV9wb3N0aGVhZGVyIjtzOjk6InVuY2hlY2tlZCI7czoyMToic3RpY2t5X3R1cm5fb2ZmX3dpZHRoIjtzOjM6Ijc2OCI7czoyNToiYWRkX3NlYXJjaF9idG5fdG9fcHJpbWFyeSI7czo5OiJ1bmNoZWNrZWQiO3M6Mjc6ImFkZF9zZWFyY2hfYnRuX3RvX3NlY29uZGFyeSI7czo5OiJ1bmNoZWNrZWQiO3M6ODoibG9nb191cmwiO3M6MDoiIjtzOjE0OiJsb2dvX3RleHRfc2l6ZSI7czoyOiI0OCI7czoxNDoibG9nb19tYXhfd2lkdGgiO3M6MzoiMjIzIjtzOjI0OiJoZWFkZXJfaW1nX2hvbWVwYWdlX29ubHkiO3M6OToidW5jaGVja2VkIjtzOjE0OiJoZWFkZXJfaW1nX3VybCI7czo4MDoiaHR0cDovL2xvY2FsaG9zdDo4ODg4LzIwMTUwNDE1LUNvb2tCb29rL3dwLWNvbnRlbnQvdXBsb2Fkcy8yMDE1LzA0L3BhcmFsbGF4MS5qcGciO3M6MTk6ImhlYWRlcl9pbWdfYmdfY29sb3IiO3M6NzoiIzE0MTMxMiI7czoxNzoiaGVhZGVyX2ltZ19oZWlnaHQiO3M6MzoiNDUwIjtzOjIzOiJoZWFkZXJfaW1nX3VzZV9wYXJhbGxheCI7czo3OiJjaGVja2VkIjtzOjI1OiJoZWFkZXJfaW1nX3BhcmFsbGF4X3JhdGlvIjtzOjM6IjAuMyI7czoxNToiaGVhZGVyX2ltZ190ZXh0IjtzOjE3OToiPGgyPkJhY2tncm91bmQgSGVhZGVyIEltYWdlIFdpdGggUGFyYWxsYXggU2Nyb2xsaW5nPC9oMj4NCjxwIHN0eWxlPSJtYXJnaW4tdG9wOiAtMTBweDsiIGNsYXNzPSJsZWFkIj5BbHNvIGFkZCB5b3VyIG93biBIVE1MIGFuZCBzaG9ydGNvZGVzPC9wPg0KW2J1dHRvbl1CdXkgQ29va2Jvb2sgVG9kYXlbL2J1dHRvbl0iO3M6MjU6ImhlYWRlcl9pbWdfdGV4dF9hbGlnbm1lbnQiO3M6ODoiY2VudGVyZWQiO3M6MjY6ImhlYWRlcl9pbWdfdGV4dF9tYXJnaW5fdG9wIjtzOjM6IjE3MCI7czoxODoiaGVhZGVyX2Jhbm5lcl9jb2RlIjtzOjEyNDoiPGEgaHJlZj0nIyc+PGltZyBzcmM9J2h0dHA6Ly9sb2NhbGhvc3Q6ODg4OC8yMDE1MDQxNS1Db29rQm9vay93cC1jb250ZW50L3RoZW1lcy9jb29rYm9vay9pbWcvYWRzLzQ2OHg2MC5wbmcnIGFsdD0nQWQnIC8+PC9hPiI7czoxMToiaGVhZGVyX3RleHQiO3M6NTM6IjxlbSBjbGFzcz0iZmEiPu+AhDwvZW0+IEVhdCBXZWxsLCBCZSBIYXBweSwgTG92ZSBGb29kIjtzOjExOiJmb290ZXJfdGV4dCI7czo5NzoiwqkgQ29weXJpZ2h0IENvb2tib29rIDIwMTUgYnkgPGEgaHJlZj0iaHR0cDovL3d3dy50aGVtZWNhbm9uLmNvbSIgdGFyZ2V0PSJfYmxhbmsiPlRoZW1lIENhbm9uPC9hPiI7czoyMToidG9vbGJhcl9zZWFyY2hfYnV0dG9uIjtzOjc6ImNoZWNrZWQiO3M6MjU6ImNvdW50ZG93bl9kYXRldGltZV9zdHJpbmciO3M6MjY6IkRlY2VtYmVyIDMxLCAyMDIzIDIzOjU5OjU5IjtzOjIwOiJjb3VudGRvd25fZ210X29mZnNldCI7czozOiIrMTAiO3M6MjE6ImNvdW50ZG93bl9kZXNjcmlwdGlvbiI7czoxMjoiTmV4dCBFdmVudDogIjtzOjEzOiJzb2NpYWxfaW5fbmV3IjtzOjc6ImNoZWNrZWQiO3M6MTI6InNvY2lhbF9saW5rcyI7YTozOntpOjA7YToyOntpOjA7czoxODoiZmEtZmFjZWJvb2stc3F1YXJlIjtpOjE7czozNToiaHR0cHM6Ly93d3cuZmFjZWJvb2suY29tL3RoZW1lY2Fub24iO31pOjE7YToyOntpOjA7czoxNzoiZmEtdHdpdHRlci1zcXVhcmUiO2k6MTtzOjMwOiJodHRwczovL3R3aXR0ZXIuY29tL1RoZW1lQ2Fub24iO31pOjI7YToyOntpOjA7czoxMzoiZmEtcnNzLXNxdWFyZSI7aToxO3M6NTA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODg4OC8yMDE1MDQxNS1Db29rQm9vay8/ZmVlZD1yc3MyIjt9fXM6MTU6InNob3dfcHJlX2Zvb3RlciI7czo3OiJjaGVja2VkIjtzOjIyOiJzaG93X3dpZGdldGl6ZWRfZm9vdGVyIjtzOjc6ImNoZWNrZWQiO3M6MTY6InNob3dfcG9zdF9mb290ZXIiO3M6NzoiY2hlY2tlZCI7czoyNDoiaGVhZGVyX3ByZV9jdXN0b21fY2VudGVyIjtzOjM6Im9mZiI7czoyMzoiaGVhZGVyX21haW5fY3VzdG9tX2xlZnQiO3M6NDoibG9nbyI7czoyNDoiaGVhZGVyX21haW5fY3VzdG9tX3JpZ2h0IjtzOjc6InByaW1hcnkiO3M6MjU6ImhlYWRlcl9wb3N0X2N1c3RvbV9jZW50ZXIiO3M6Mzoib2ZmIjtzOjIzOiJoZWFkZXJfcG9zdF9jdXN0b21fbGVmdCI7czoxMToiYnJlYWRjcnVtYnMiO3M6MjQ6ImhlYWRlcl9wb3N0X2N1c3RvbV9yaWdodCI7czo3OiJ0b29sYmFyIjtzOjI0OiJmb290ZXJfcHJlX2N1c3RvbV9jZW50ZXIiO3M6Mzoib2ZmIjtzOjI1OiJmb290ZXJfcG9zdF9jdXN0b21fY2VudGVyIjtzOjM6Im9mZiI7czo5OiJsb2dvX3RleHQiO3M6MDoiIjt9czoxODoiY2Fub25fb3B0aW9uc19wb3N0IjthOjQzOntzOjE0OiJzaG93X3Bvc3RfbWV0YSI7czo3OiJjaGVja2VkIjtzOjEzOiJzaG93X3Bvc3RfbmF2IjtzOjc6ImNoZWNrZWQiO3M6MTM6InNob3dfY29tbWVudHMiO3M6NzoiY2hlY2tlZCI7czoxODoic2hvd19hcmNoaXZlX3RpdGxlIjtzOjc6ImNoZWNrZWQiO3M6MjA6InNob3dfY2F0X2Rlc2NyaXB0aW9uIjtzOjc6ImNoZWNrZWQiO3M6MjM6InNob3dfYXJjaGl2ZV9hdXRob3JfYm94IjtzOjc6ImNoZWNrZWQiO3M6MTQ6InNob3dfbWV0YV9kYXRlIjtzOjc6ImNoZWNrZWQiO3M6MTg6InNob3dfbWV0YV9jb21tZW50cyI7czo3OiJjaGVja2VkIjtzOjE1OiJzaG93X21ldGFfbGlrZXMiO3M6NzoiY2hlY2tlZCI7czoxNToic2hvd19tZXRhX3ZpZXdzIjtzOjc6ImNoZWNrZWQiO3M6MTE6ImJsb2dfbGF5b3V0IjtzOjc6InNpZGViYXIiO3M6MTI6ImJsb2dfc2lkZWJhciI7czozMzoiY2Fub25fYXJjaGl2ZV9zaWRlYmFyX3dpZGdldF9hcmVhIjtzOjEwOiJibG9nX3N0eWxlIjtzOjc6Im1hc29ucnkiO3M6MTk6ImJsb2dfZXhjZXJwdF9sZW5ndGgiO3M6MzoiNDUwIjtzOjIwOiJibG9nX21hc29ucnlfY29sdW1ucyI7czoxOiIxIjtzOjEwOiJjYXRfbGF5b3V0IjtzOjc6InNpZGViYXIiO3M6MTE6ImNhdF9zaWRlYmFyIjtzOjMzOiJjYW5vbl9hcmNoaXZlX3NpZGViYXJfd2lkZ2V0X2FyZWEiO3M6OToiY2F0X3N0eWxlIjtzOjc6ImNsYXNzaWMiO3M6MTg6ImNhdF9leGNlcnB0X2xlbmd0aCI7czozOiIzMDAiO3M6MTk6ImNhdF9tYXNvbnJ5X2NvbHVtbnMiO3M6MToiMiI7czoxNDoiYXJjaGl2ZV9sYXlvdXQiO3M6Nzoic2lkZWJhciI7czoxNToiYXJjaGl2ZV9zaWRlYmFyIjtzOjMzOiJjYW5vbl9hcmNoaXZlX3NpZGViYXJfd2lkZ2V0X2FyZWEiO3M6MTM6ImFyY2hpdmVfc3R5bGUiO3M6NzoiY2xhc3NpYyI7czoyMjoiYXJjaGl2ZV9leGNlcnB0X2xlbmd0aCI7czozOiIzMDAiO3M6MjM6ImFyY2hpdmVfbWFzb25yeV9jb2x1bW5zIjtzOjE6IjIiO3M6MTU6InNlYXJjaF9ib3hfdGV4dCI7czoyNToiV2hhdCBhcmUgeW91IGxvb2tpbmcgZm9yPyI7czoxMjoic2VhcmNoX3Bvc3RzIjtzOjc6ImNoZWNrZWQiO3M6MTI6InNlYXJjaF9wYWdlcyI7czo3OiJjaGVja2VkIjtzOjEwOiJzZWFyY2hfY3B0IjtzOjc6ImNoZWNrZWQiO3M6MTc6InNlYXJjaF9jcHRfc291cmNlIjtzOjA6IiI7czoxMDoiNDA0X2xheW91dCI7czo3OiJzaWRlYmFyIjtzOjExOiI0MDRfc2lkZWJhciI7czozMzoiY2Fub25fYXJjaGl2ZV9zaWRlYmFyX3dpZGdldF9hcmVhIjtzOjk6IjQwNF90aXRsZSI7czoxNDoiRXJyb3IgNDA0IFBhZ2UiO3M6NzoiNDA0X21zZyI7czo4MjoiU29ycnksIEl0IHNlZW1zIHdlIGNhbid0IGZpbmQgd2hhdCB5b3UncmUgbG9va2luZyBmb3IuIFBlcmhhcHMgc2VhcmNoaW5nIGNhbiBoZWxwLiI7czoxMToiYXJjaGl2ZV9hZHMiO2E6Mjp7aTowO2E6NTp7czoxNToiYXBwZW5kX3RvX3Bvc3RzIjtzOjU6IjMsIDEwIjtzOjc6ImFkX2NvZGUiO3M6MzE1OiI8YSBocmVmPSIjIiBjbGFzcz0iYWRzIGNvbC0xLTIiPg0KPGltZyBzcmM9Imh0dHA6Ly9sb2NhbGhvc3Q6ODg4OC8yMDE1MDQxNS1Db29rQm9vay93cC1jb250ZW50L3RoZW1lcy9jb29rYm9vay9pbWcvYWRzLzQ2OHg2MC5wbmciIGFsdD0iQWRzIiAvPg0KPC9hPg0KICAgCQkJCQkNCjxhIGhyZWY9IiMiIGNsYXNzPSJhZHMgY29sLTEtMiBsYXN0Ij4NCjxpbWcgc3JjPSJodHRwOi8vbG9jYWxob3N0Ojg4ODgvMjAxNTA0MTUtQ29va0Jvb2svd3AtY29udGVudC90aGVtZXMvY29va2Jvb2svaW1nL2Fkcy80Njh4NjAucG5nIiBhbHQ9IkFkcyIgLz4NCjwvYT4iO3M6MTM6InNob3dfYWRzX2Jsb2ciO3M6OToidW5jaGVja2VkIjtzOjE3OiJzaG93X2Fkc19jYXRlZ29yeSI7czo5OiJ1bmNoZWNrZWQiO3M6MTY6InNob3dfYWRzX2FyY2hpdmUiO3M6OToidW5jaGVja2VkIjt9aToxO2E6NTp7czoxNToiYXBwZW5kX3RvX3Bvc3RzIjtzOjU6IjMsIDEwIjtzOjc6ImFkX2NvZGUiO3M6MTQ5OiI8YSBocmVmPSIjIiBjbGFzcz0iYWRzIGNvbC0xLTEiPg0KPGltZyBzcmM9Imh0dHA6Ly9sb2NhbGhvc3Q6ODg4OC8yMDE1MDQxNS1Db29rQm9vay93cC1jb250ZW50L3RoZW1lcy9jb29rYm9vay9pbWcvYWRzLzQ2OHg2MC5wbmciIGFsdD0iQWRzIiAvPg0KPC9hPiI7czoxMzoic2hvd19hZHNfYmxvZyI7czo5OiJ1bmNoZWNrZWQiO3M6MTc6InNob3dfYWRzX2NhdGVnb3J5IjtzOjk6InVuY2hlY2tlZCI7czoxNjoic2hvd19hZHNfYXJjaGl2ZSI7czo5OiJ1bmNoZWNrZWQiO319czoyMzoidXNlX3dvb2NvbW1lcmNlX3NpZGViYXIiO3M6NzoiY2hlY2tlZCI7czoxOToid29vY29tbWVyY2Vfc2lkZWJhciI7czoxNDoiY2Fub25fY3dhX3Nob3AiO3M6MjI6InVzZV9idWRkeXByZXNzX3NpZGViYXIiO3M6NzoiY2hlY2tlZCI7czoxODoiYnVkZHlwcmVzc19zaWRlYmFyIjtzOjE1OiJjYW5vbl9jd2FfZm9ydW0iO3M6MTk6InVzZV9iYnByZXNzX3NpZGViYXIiO3M6NzoiY2hlY2tlZCI7czoxNToiYmJwcmVzc19zaWRlYmFyIjtzOjE1OiJjYW5vbl9jd2FfZm9ydW0iO3M6MTg6InVzZV9ldmVudHNfc2lkZWJhciI7czo3OiJjaGVja2VkIjtzOjE0OiJldmVudHNfc2lkZWJhciI7czoxNjoiY2Fub25fY3dhX2V2ZW50cyI7fXM6MjQ6ImNhbm9uX29wdGlvbnNfYXBwZWFyYW5jZSI7YTo3Nzp7czoxNToiYm9keV9za2luX2NsYXNzIjtzOjY6InNraW4tMSI7czoxMzoiY29sb3JfcGFnZV9iZyI7czo3OiIjZjFmMWYxIjtzOjEzOiJjb2xvcl9ib2R5X2JnIjtzOjc6IiNmZmZmZmYiO3M6MTg6ImNvbG9yX2dlbmVyYWxfdGV4dCI7czo3OiIjMjIyMjIyIjtzOjE1OiJjb2xvcl9ib2R5X2xpbmsiO3M6NzoiIzIyMjIyMiI7czoyMToiY29sb3JfYm9keV9saW5rX2hvdmVyIjtzOjc6IiNjM2FkNzAiO3M6MTk6ImNvbG9yX2JvZHlfaGVhZGluZ3MiO3M6NzoiIzIyMjIyMiI7czoyMDoiY29sb3JfZ2VuZXJhbF90ZXh0XzIiO3M6NzoiI2FkYWRhZCI7czoxNToiY29sb3JfbG9nb190ZXh0IjtzOjc6IiMyMjIyMjIiO3M6MTY6ImNvbG9yX3ByZWhlYWRfYmciO3M6NzoiIzRjNTY1YyI7czoxMzoiY29sb3JfcHJlaGVhZCI7czo3OiIjZmZmZmZmIjtzOjE5OiJjb2xvcl9wcmVoZWFkX2hvdmVyIjtzOjc6IiNjM2FkNzAiO3M6MTg6ImNvbG9yX3RoaXJkX3ByZW5hdiI7czo3OiIjMzMzZDQzIjtzOjEzOiJjb2xvcl9oZWFkX2JnIjtzOjc6IiNmZmZmZmYiO3M6MTA6ImNvbG9yX2hlYWQiO3M6NzoiIzIyMjIyMiI7czoxNjoiY29sb3JfaGVhZF9ob3ZlciI7czo3OiIjYzNhZDcwIjtzOjIyOiJjb2xvcl9oZWFkZXJfbWVudXNfMm5kIjtzOjc6IiNmYWZhZmEiO3M6MTg6ImNvbG9yX2hlYWRlcl9tZW51cyI7czo3OiIjZjFmMWYxIjtzOjE3OiJjb2xvcl9wb3N0aGVhZF9iZyI7czo3OiIjMWYyNzJhIjtzOjE0OiJjb2xvcl9wb3N0aGVhZCI7czo3OiIjZmZmZmZmIjtzOjIwOiJjb2xvcl9wb3N0aGVhZF9ob3ZlciI7czo3OiIjYzNhZDcwIjtzOjE5OiJjb2xvcl90aGlyZF9wb3N0bmF2IjtzOjc6IiMxNDEzMTIiO3M6MTY6ImNvbG9yX3NpZHJfYmxvY2siO3M6NzoiIzIwMjcyYiI7czoxNzoiY29sb3JfbWVudV90ZXh0XzEiO3M6NzoiI2ZmZmZmZiI7czoyMDoiY29sb3JfYmxvY2tfaGVhZGluZ3MiO3M6NzoiIzIwMjcyYiI7czoyMjoiY29sb3JfYmxvY2tfaGVhZGluZ3NfMiI7czo3OiIjNGM1NjVjIjtzOjE3OiJjb2xvcl9mZWF0X3RleHRfMSI7czo3OiIjYzNhZDcwIjtzOjEyOiJjb2xvcl9xdW90ZXMiO3M6NzoiIzU1NWY2NCI7czoxNjoiY29sb3Jfd2hpdGVfdGV4dCI7czo3OiIjZmZmZmZmIjtzOjExOiJjb2xvcl9idG5fMSI7czo3OiIjYzNhZDcwIjtzOjE3OiJjb2xvcl9idG5fMV9ob3ZlciI7czo3OiIjMjAyNzJiIjtzOjE3OiJjb2xvcl9ibG9ja19saWdodCI7czo3OiIjZjZmNmY2IjtzOjE2OiJjb2xvcl9mZWF0X3RpdGxlIjtzOjc6IiNmZmZmZmYiO3M6MTQ6ImNvbG9yX2JvcmRlcl8xIjtzOjc6IiMyYjM2M2MiO3M6MTQ6ImNvbG9yX2JvcmRlcl8yIjtzOjc6IiNlYWVhZWEiO3M6MTQ6ImNvbG9yX2Zvcm1zX2JnIjtzOjc6IiNmNGY0ZjQiO3M6MTY6ImNvbG9yX3ByZWZvb3RfYmciO3M6NzoiI2VhZWFlYSI7czoxMzoiY29sb3JfcHJlZm9vdCI7czo3OiIjMjgyOTJjIjtzOjE5OiJjb2xvcl9wcmVmb290X2hvdmVyIjtzOjc6IiNjM2FkNzAiO3M6MTM6ImNvbG9yX2Zvb3RfYmciO3M6NzoiIzI3MmYzMyI7czoxMDoiY29sb3JfZm9vdCI7czo3OiIjZmZmZmZmIjtzOjE2OiJjb2xvcl9mb290X2hvdmVyIjtzOjc6IiNjM2FkNzAiO3M6MTI6ImNvbG9yX2Zvb3RfMiI7czo3OiIjZmZmZmZmIjtzOjE0OiJjb2xvcl9ib3JkZXJfMyI7czo3OiIjMmIzNjNjIjtzOjE1OiJjb2xvcl9mb290X2JnXzIiO3M6NzoiIzNhNDY0YyI7czoxNzoiY29sb3JfYmFzZWxpbmVfYmciO3M6NzoiIzE3MWUyMCI7czoxNDoiY29sb3JfYmFzZWxpbmUiO3M6NzoiI2I2YjZiNiI7czoyMDoiY29sb3JfYmFzZWxpbmVfaG92ZXIiO3M6NzoiI2MzYWQ3MCI7czoxMDoiYmdfaW1nX3VybCI7czowOiIiO3M6NzoiYmdfbGluayI7czowOiIiO3M6OToiYmdfcmVwZWF0IjtzOjY6InJlcGVhdCI7czoxMzoiYmdfYXR0YWNobWVudCI7czo1OiJmaXhlZCI7czoyMjoibGlnaHRib3hfb3ZlcmxheV9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjI0OiJsaWdodGJveF9vdmVybGF5X29wYWNpdHkiO3M6MzoiMC43IjtzOjk6ImZvbnRfbWFpbiI7YTozOntpOjA7czoxMzoiY2Fub25fZGVmYXVsdCI7aToxO3M6NzoicmVndWxhciI7aToyO3M6NToibGF0aW4iO31zOjEzOiJmb250X2hlYWRpbmdzIjthOjM6e2k6MDtzOjEzOiJjYW5vbl9kZWZhdWx0IjtpOjE7czo3OiJyZWd1bGFyIjtpOjI7czo1OiJsYXRpbiI7fXM6ODoiZm9udF9uYXYiO2E6Mzp7aTowO3M6MTM6ImNhbm9uX2RlZmF1bHQiO2k6MTtzOjc6InJlZ3VsYXIiO2k6MjtzOjU6ImxhdGluIjt9czoxODoiZm9udF9oZWFkaW5nc19tZXRhIjthOjM6e2k6MDtzOjEzOiJjYW5vbl9kZWZhdWx0IjtpOjE7czo3OiJyZWd1bGFyIjtpOjI7czo1OiJsYXRpbiI7fXM6OToiZm9udF9ib2xkIjthOjM6e2k6MDtzOjEzOiJjYW5vbl9kZWZhdWx0IjtpOjE7czo3OiJyZWd1bGFyIjtpOjI7czo1OiJsYXRpbiI7fXM6MTE6ImZvbnRfaXRhbGljIjthOjM6e2k6MDtzOjEzOiJjYW5vbl9kZWZhdWx0IjtpOjE7czo3OiJyZWd1bGFyIjtpOjI7czo1OiJsYXRpbiI7fXM6MTE6ImZvbnRfc3Ryb25nIjthOjM6e2k6MDtzOjEzOiJjYW5vbl9kZWZhdWx0IjtpOjE7czo3OiJyZWd1bGFyIjtpOjI7czo1OiJsYXRpbiI7fXM6OToiZm9udF9sb2dvIjthOjM6e2k6MDtzOjEzOiJjYW5vbl9kZWZhdWx0IjtpOjE7czo3OiJyZWd1bGFyIjtpOjI7czo1OiJsYXRpbiI7fXM6MTQ6ImZvbnRfc2l6ZV9yb290IjtzOjA6IiI7czoyNToiYW5pbV9pbWdfc2xpZGVyX3NsaWRlc2hvdyI7czo5OiJ1bmNoZWNrZWQiO3M6MjE6ImFuaW1faW1nX3NsaWRlcl9kZWxheSI7czo0OiI1MDAwIjtzOjI5OiJhbmltX2ltZ19zbGlkZXJfYW5pbV9kdXJhdGlvbiI7czozOiI4MDAiO3M6Mjc6ImFuaW1fcXVvdGVfc2xpZGVyX3NsaWRlc2hvdyI7czo5OiJ1bmNoZWNrZWQiO3M6MjM6ImFuaW1fcXVvdGVfc2xpZGVyX2RlbGF5IjtzOjQ6IjUwMDAiO3M6MzE6ImFuaW1fcXVvdGVfc2xpZGVyX2FuaW1fZHVyYXRpb24iO3M6MzoiODAwIjtzOjMzOiJsYXp5X2xvYWRfb25fcGFnZWJ1aWxkZXJfZWxlbWVudHMiO3M6OToidW5jaGVja2VkIjtzOjI2OiJsYXp5X2xvYWRfb25fYXJjaGl2ZV9wb3N0cyI7czo5OiJ1bmNoZWNrZWQiO3M6MjA6ImxhenlfbG9hZF9vbl93aWRnZXRzIjtzOjk6InVuY2hlY2tlZCI7czoxNToibGF6eV9sb2FkX2FmdGVyIjtzOjM6IjAuMyI7czoxNToibGF6eV9sb2FkX2VudGVyIjtzOjY6ImJvdHRvbSI7czoxNDoibGF6eV9sb2FkX21vdmUiO3M6MjoiMjQiO3M6MTQ6ImxhenlfbG9hZF9vdmVyIjtzOjQ6IjAuNTYiO3M6MjU6ImxhenlfbG9hZF92aWV3cG9ydF9mYWN0b3IiO3M6MzoiMC4yIjt9czoyMjoiY2Fub25fb3B0aW9uc19hZHZhbmNlZCI7YTo5OntzOjE5OiJjdXN0b21fd2lkZ2V0X2FyZWFzIjthOjEyOntpOjk5OTk7czowOiIiO2k6MDtzOjIwOiJDdXN0b20gV2lkZ2V0IEFyZWEgMSI7aToxO3M6MjA6IkN1c3RvbSBXaWRnZXQgQXJlYSAyIjtpOjI7czoyMDoiQ3VzdG9tIFdpZGdldCBBcmVhIDMiO2k6MztzOjQ6IlNob3AiO2k6NDtzOjU6IkZvcnVtIjtpOjU7czo2OiJFdmVudHMiO2k6NjtzOjY6IlNvY2lhbCI7aTo3O3M6OToiU3Vic2NyaWJlIjtpOjg7czo4OiJGYWNlYm9vayI7aTo5O3M6MTA6IlRleHQtQmxvY2siO2k6MTA7czo0OiJUYWJzIjt9czoxODoidXNlX2ZpbmFsX2NhbGxfY3NzIjtzOjk6InVuY2hlY2tlZCI7czoxNDoiZmluYWxfY2FsbF9jc3MiO3M6NTE6Ii5tYWluLWhlYWRlci5yaWdodCAuYWRzew0KICAgIG1hcmdpbi10b3A6IC0xNXB4Ow0KfSI7czoxODoiY2Fub25fb3B0aW9uc19kYXRhIjtzOjE0Mjk2OiJZVG8xT250ek9qRXpPaUpqWVc1dmJsOXZjSFJwYjI1eklqdGhPakUxT250ek9qazZJbkpsYzJWMFgyRnNiQ0k3Y3pvd09pSWlPM002TVRFNkluSmxjMlYwWDJKaGMybGpJanR6T2pBNklpSTdjem95TVRvaWRYTmxYM0psYzNCdmJuTnBkbVZmWkdWemFXZHVJanR6T2pjNkltTm9aV05yWldRaU8zTTZNVFk2SW5WelpWOWliM2hsWkY5a1pYTnBaMjRpTzNNNk56b2lZMmhsWTJ0bFpDSTdjem95TURvaWRYTmxYMjFoYVc1MFpXNWhibU5sWDIxdlpHVWlPM002T1RvaWRXNWphR1ZqYTJWa0lqdHpPakUzT2lKdFlXbHVkR1Z1WVc1alpWOTBhWFJzWlNJN2N6b3pNRG9pVjJVZ1lYSmxJR1J2YVc1bklHMWhhVzUwWlc1aGJtTmxJSGR2Y21zaElqdHpPakUxT2lKdFlXbHVkR1Z1WVc1alpWOXRjMmNpTzNNNk1UTTVPaUpFYjI0bmRDQjNiM0p5ZVNCM1pTQjNhV3hzSUdKbElHSmhZMnNnYzI5dmJpQXRMU0JwYmlCMGFHVWdiV1ZoYm5ScGJXVWdkMmg1SUdSdmJpZDBJSGx2ZFNCMmFYTnBkQ0E4WVNCb2NtVm1QU2RvZEhSd09pOHZkM2QzTG1kdmIyZHNaUzVqYjIwblBqeHpkSEp2Ym1jK1BIVStSMjl2WjJ4bFBDOTFQand2YzNSeWIyNW5Qand2WVQ0dUlqdHpPakU0T2lKemFXUmxZbUZ5YzE5aGJHbG5ibTFsYm5RaU8zTTZOVG9pY21sbmFIUWlPM002T0RvaVpHVjJYMjF2WkdVaU8zTTZOem9pWTJobFkydGxaQ0k3Y3pveE9Eb2lZWFYwYjJOdmJYQnNaWFJsWDNkdmNtUnpJanR6T2pjeU9pSmpLeXNzSUdweGRXVnllU3dnU1NCc2FXdGxJR3BSZFdWeWVTd2dhbUYyWVN3Z2NHaHdMQ0JqYjJ4a1puVnphVzl1TENCcVlYWmhjMk55YVhCMExDQmhjM0FzSUhKMVlua2lPM002TWpjNkltaHBaR1ZmZEdobGJXVmZiV1YwWVY5a1pYTmpjbWx3ZEdsdmJpSTdjem81T2lKMWJtTm9aV05yWldRaU8zTTZNVE02SW1ocFpHVmZkR2hsYldWZmIyY2lPM002T1RvaWRXNWphR1ZqYTJWa0lqdHpPakV5T2lKbWIyNTBabUZqWlY5bWFYZ2lPM002T1RvaWRXNWphR1ZqYTJWa0lqdHpPakV4T2lKbVlYWnBZMjl1WDNWeWJDSTdjem93T2lJaU8zTTZNakU2SW1kdmIyZHNaVjloYm1Gc2VYUnBZM05mWTI5a1pTSTdjem93T2lJaU8zMXpPakU1T2lKallXNXZibDl2Y0hScGIyNXpYMlp5WVcxbElqdGhPalU1T250ek9qRTNPaUpvWldGa1pYSmZjSEpsWDJ4aGVXOTFkQ0k3Y3pveU9Eb2lhR1ZoWkdWeVgzQnlaVjlqZFhOMGIyMWZiR1ZtZEY5eWFXZG9kQ0k3Y3pveU1qb2lhR1ZoWkdWeVgzQnlaVjlqZFhOMGIyMWZiR1ZtZENJN2N6b3hNVG9pYUdWaFpHVnlYM1JsZUhRaU8zTTZNak02SW1obFlXUmxjbDl3Y21WZlkzVnpkRzl0WDNKcFoyaDBJanR6T2pZNkluTnZZMmxoYkNJN2N6b3hPRG9pYUdWaFpHVnlYMjFoYVc1ZmJHRjViM1YwSWp0ek9qSTVPaUpvWldGa1pYSmZiV0ZwYmw5amRYTjBiMjFmYkdWbWRGOXlhV2RvZENJN2N6b3lOVG9pYUdWaFpHVnlYMjFoYVc1ZlkzVnpkRzl0WDJObGJuUmxjaUk3Y3pvME9pSnNiMmR2SWp0ek9qRTRPaUpvWldGa1pYSmZjRzl6ZEY5c1lYbHZkWFFpTzNNNk1qazZJbWhsWVdSbGNsOXdiM04wWDJOMWMzUnZiVjlzWldaMFgzSnBaMmgwSWp0ek9qSXpPaUpvYjIxbGNHRm5aVjltWldGMGRYSmxYMnhoZVc5MWRDSTdjem96T2lKdlptWWlPM002TVRjNkltWnZiM1JsY2w5d2NtVmZiR0Y1YjNWMElqdHpPakk0T2lKbWIyOTBaWEpmY0hKbFgyTjFjM1J2YlY5c1pXWjBYM0pwWjJoMElqdHpPakl5T2lKbWIyOTBaWEpmY0hKbFgyTjFjM1J2YlY5c1pXWjBJanR6T2pFeE9pSmljbVZoWkdOeWRXMWljeUk3Y3pveU16b2labTl2ZEdWeVgzQnlaVjlqZFhOMGIyMWZjbWxuYUhRaU8zTTZNem9pYjJabUlqdHpPakU0T2lKbWIyOTBaWEpmYldGcGJsOXNZWGx2ZFhRaU8zTTZNak02SW1Kc2IyTnJYM2RwWkdkbGRHbDZaV1JmWm05dmRHVnlJanR6T2pFNE9pSm1iMjkwWlhKZmNHOXpkRjlzWVhsdmRYUWlPM002TWprNkltWnZiM1JsY2w5d2IzTjBYMk4xYzNSdmJWOXNaV1owWDNKcFoyaDBJanR6T2pJek9pSm1iMjkwWlhKZmNHOXpkRjlqZFhOMGIyMWZiR1ZtZENJN2N6b3hNVG9pWm05dmRHVnlYM1JsZUhRaU8zTTZNalE2SW1admIzUmxjbDl3YjNOMFgyTjFjM1J2YlY5eWFXZG9kQ0k3Y3pvMk9pSnpiMk5wWVd3aU8zTTZNVGc2SW1obFlXUmxjbDl3WVdSa2FXNW5YM1J2Y0NJN2N6b3lPaUl5TlNJN2N6b3lNVG9pYUdWaFpHVnlYM0JoWkdScGJtZGZZbTkwZEc5dElqdHpPakk2SWpJMUlqdHpPakl3T2lKd2IzTmZiR1ZtZEY5bGJHVnRaVzUwWDNSdmNDSTdjem94T2lJd0lqdHpPakl4T2lKd2IzTmZiR1ZtZEY5bGJHVnRaVzUwWDJ4bFpuUWlPM002TVRvaU1DSTdjem95TVRvaWNHOXpYM0pwWjJoMFgyVnNaVzFsYm5SZmRHOXdJanR6T2pJNklqRXdJanR6T2pJek9pSndiM05mY21sbmFIUmZaV3hsYldWdWRGOXlhV2RvZENJN2N6b3hPaUl3SWp0ek9qSXdPaUoxYzJWZmMzUnBZMnQ1WDNCeVpXaGxZV1JsY2lJN2N6bzVPaUoxYm1Ob1pXTnJaV1FpTzNNNk1UYzZJblZ6WlY5emRHbGphM2xmYUdWaFpHVnlJanR6T2prNkluVnVZMmhsWTJ0bFpDSTdjem95TVRvaWRYTmxYM04wYVdOcmVWOXdiM04wYUdWaFpHVnlJanR6T2prNkluVnVZMmhsWTJ0bFpDSTdjem95TVRvaWMzUnBZMnQ1WDNSMWNtNWZiMlptWDNkcFpIUm9JanR6T2pNNklqYzJPQ0k3Y3pveU5Ub2lZV1JrWDNObFlYSmphRjlpZEc1ZmRHOWZjSEpwYldGeWVTSTdjem81T2lKMWJtTm9aV05yWldRaU8zTTZNamM2SW1Ga1pGOXpaV0Z5WTJoZlluUnVYM1J2WDNObFkyOXVaR0Z5ZVNJN2N6bzVPaUoxYm1Ob1pXTnJaV1FpTzNNNk9Eb2liRzluYjE5MWNtd2lPM002TURvaUlqdHpPakUwT2lKc2IyZHZYM1JsZUhSZmMybDZaU0k3Y3pveU9pSTBPQ0k3Y3pveE5Eb2liRzluYjE5dFlYaGZkMmxrZEdnaU8zTTZNem9pTWpJeklqdHpPakkwT2lKb1pXRmtaWEpmYVcxblgyaHZiV1Z3WVdkbFgyOXViSGtpTzNNNk9Ub2lkVzVqYUdWamEyVmtJanR6T2pFME9pSm9aV0ZrWlhKZmFXMW5YM1Z5YkNJN2N6bzRNRG9pYUhSMGNEb3ZMMnh2WTJGc2FHOXpkRG80T0RnNEx6SXdNVFV3TkRFMUxVTnZiMnRDYjI5ckwzZHdMV052Ym5SbGJuUXZkWEJzYjJGa2N5OHlNREUxTHpBMEwzQmhjbUZzYkdGNE1TNXFjR2NpTzNNNk1UazZJbWhsWVdSbGNsOXBiV2RmWW1kZlkyOXNiM0lpTzNNNk56b2lJekUwTVRNeE1pSTdjem94TnpvaWFHVmhaR1Z5WDJsdFoxOW9aV2xuYUhRaU8zTTZNem9pTkRVd0lqdHpPakl6T2lKb1pXRmtaWEpmYVcxblgzVnpaVjl3WVhKaGJHeGhlQ0k3Y3pvM09pSmphR1ZqYTJWa0lqdHpPakkxT2lKb1pXRmtaWEpmYVcxblgzQmhjbUZzYkdGNFgzSmhkR2x2SWp0ek9qTTZJakF1TXlJN2N6b3hOVG9pYUdWaFpHVnlYMmx0WjE5MFpYaDBJanR6T2pFM09Ub2lQR2d5UGtKaFkydG5jbTkxYm1RZ1NHVmhaR1Z5SUVsdFlXZGxJRmRwZEdnZ1VHRnlZV3hzWVhnZ1UyTnliMnhzYVc1blBDOW9NajROQ2p4d0lITjBlV3hsUFNKdFlYSm5hVzR0ZEc5d09pQXRNVEJ3ZURzaUlHTnNZWE56UFNKc1pXRmtJajVCYkhOdklHRmtaQ0I1YjNWeUlHOTNiaUJJVkUxTUlHRnVaQ0J6YUc5eWRHTnZaR1Z6UEM5d1BnMEtXMkoxZEhSdmJsMUNkWGtnUTI5dmEySnZiMnNnVkc5a1lYbGJMMkoxZEhSdmJsMGlPM002TWpVNkltaGxZV1JsY2w5cGJXZGZkR1Y0ZEY5aGJHbG5ibTFsYm5RaU8zTTZPRG9pWTJWdWRHVnlaV1FpTzNNNk1qWTZJbWhsWVdSbGNsOXBiV2RmZEdWNGRGOXRZWEpuYVc1ZmRHOXdJanR6T2pNNklqRTNNQ0k3Y3pveE9Eb2lhR1ZoWkdWeVgySmhibTVsY2w5amIyUmxJanR6T2pFeU5Eb2lQR0VnYUhKbFpqMG5JeWMrUEdsdFp5QnpjbU05SjJoMGRIQTZMeTlzYjJOaGJHaHZjM1E2T0RnNE9DOHlNREUxTURReE5TMURiMjlyUW05dmF5OTNjQzFqYjI1MFpXNTBMM1JvWlcxbGN5OWpiMjlyWW05dmF5OXBiV2N2WVdSekx6UTJPSGcyTUM1d2JtY25JR0ZzZEQwblFXUW5JQzgrUEM5aFBpSTdjem94TVRvaWFHVmhaR1Z5WDNSbGVIUWlPM002TlRNNklqeGxiU0JqYkdGemN6MGlabUVpUHUrQWhEd3ZaVzArSUVWaGRDQlhaV3hzTENCQ1pTQklZWEJ3ZVN3Z1RHOTJaU0JHYjI5a0lqdHpPakV4T2lKbWIyOTBaWEpmZEdWNGRDSTdjem81TnpvaXdxa2dRMjl3ZVhKcFoyaDBJRU52YjJ0aWIyOXJJREl3TVRVZ1lua2dQR0VnYUhKbFpqMGlhSFIwY0RvdkwzZDNkeTUwYUdWdFpXTmhibTl1TG1OdmJTSWdkR0Z5WjJWMFBTSmZZbXhoYm1zaVBsUm9aVzFsSUVOaGJtOXVQQzloUGlJN2N6b3lNVG9pZEc5dmJHSmhjbDl6WldGeVkyaGZZblYwZEc5dUlqdHpPamM2SW1Ob1pXTnJaV1FpTzNNNk1qVTZJbU52ZFc1MFpHOTNibDlrWVhSbGRHbHRaVjl6ZEhKcGJtY2lPM002TWpZNklrUmxZMlZ0WW1WeUlETXhMQ0F5TURJeklESXpPalU1T2pVNUlqdHpPakl3T2lKamIzVnVkR1J2ZDI1ZloyMTBYMjltWm5ObGRDSTdjem96T2lJck1UQWlPM002TWpFNkltTnZkVzUwWkc5M2JsOWtaWE5qY21sd2RHbHZiaUk3Y3pveE1qb2lUbVY0ZENCRmRtVnVkRG9nSWp0ek9qRXpPaUp6YjJOcFlXeGZhVzVmYm1WM0lqdHpPamM2SW1Ob1pXTnJaV1FpTzNNNk1USTZJbk52WTJsaGJGOXNhVzVyY3lJN1lUb3pPbnRwT2pBN1lUb3lPbnRwT2pBN2N6b3hPRG9pWm1FdFptRmpaV0p2YjJzdGMzRjFZWEpsSWp0cE9qRTdjem96TlRvaWFIUjBjSE02THk5M2QzY3VabUZqWldKdmIyc3VZMjl0TDNSb1pXMWxZMkZ1YjI0aU8zMXBPakU3WVRveU9udHBPakE3Y3pveE56b2labUV0ZEhkcGRIUmxjaTF6Y1hWaGNtVWlPMms2TVR0ek9qTXdPaUpvZEhSd2N6b3ZMM1IzYVhSMFpYSXVZMjl0TDFSb1pXMWxRMkZ1YjI0aU8zMXBPakk3WVRveU9udHBPakE3Y3pveE16b2labUV0Y25OekxYTnhkV0Z5WlNJN2FUb3hPM002TlRBNkltaDBkSEE2THk5c2IyTmhiR2h2YzNRNk9EZzRPQzh5TURFMU1EUXhOUzFEYjI5clFtOXZheTgvWm1WbFpEMXljM015SWp0OWZYTTZNVFU2SW5Ob2IzZGZjSEpsWDJadmIzUmxjaUk3Y3pvM09pSmphR1ZqYTJWa0lqdHpPakl5T2lKemFHOTNYM2RwWkdkbGRHbDZaV1JmWm05dmRHVnlJanR6T2pjNkltTm9aV05yWldRaU8zTTZNVFk2SW5Ob2IzZGZjRzl6ZEY5bWIyOTBaWElpTzNNNk56b2lZMmhsWTJ0bFpDSTdjem95TkRvaWFHVmhaR1Z5WDNCeVpWOWpkWE4wYjIxZlkyVnVkR1Z5SWp0ek9qTTZJbTltWmlJN2N6b3lNem9pYUdWaFpHVnlYMjFoYVc1ZlkzVnpkRzl0WDJ4bFpuUWlPM002TkRvaWJHOW5ieUk3Y3pveU5Eb2lhR1ZoWkdWeVgyMWhhVzVmWTNWemRHOXRYM0pwWjJoMElqdHpPamM2SW5CeWFXMWhjbmtpTzNNNk1qVTZJbWhsWVdSbGNsOXdiM04wWDJOMWMzUnZiVjlqWlc1MFpYSWlPM002TXpvaWIyWm1JanR6T2pJek9pSm9aV0ZrWlhKZmNHOXpkRjlqZFhOMGIyMWZiR1ZtZENJN2N6b3hNVG9pWW5KbFlXUmpjblZ0WW5NaU8zTTZNalE2SW1obFlXUmxjbDl3YjNOMFgyTjFjM1J2YlY5eWFXZG9kQ0k3Y3pvM09pSjBiMjlzWW1GeUlqdHpPakkwT2lKbWIyOTBaWEpmY0hKbFgyTjFjM1J2YlY5alpXNTBaWElpTzNNNk16b2liMlptSWp0ek9qSTFPaUptYjI5MFpYSmZjRzl6ZEY5amRYTjBiMjFmWTJWdWRHVnlJanR6T2pNNkltOW1aaUk3Y3pvNU9pSnNiMmR2WDNSbGVIUWlPM002TURvaUlqdDljem94T0RvaVkyRnViMjVmYjNCMGFXOXVjMTl3YjNOMElqdGhPalF6T250ek9qRTBPaUp6YUc5M1gzQnZjM1JmYldWMFlTSTdjem8zT2lKamFHVmphMlZrSWp0ek9qRXpPaUp6YUc5M1gzQnZjM1JmYm1GMklqdHpPamM2SW1Ob1pXTnJaV1FpTzNNNk1UTTZJbk5vYjNkZlkyOXRiV1Z1ZEhNaU8zTTZOem9pWTJobFkydGxaQ0k3Y3pveE9Eb2ljMmh2ZDE5aGNtTm9hWFpsWDNScGRHeGxJanR6T2pjNkltTm9aV05yWldRaU8zTTZNakE2SW5Ob2IzZGZZMkYwWDJSbGMyTnlhWEIwYVc5dUlqdHpPamM2SW1Ob1pXTnJaV1FpTzNNNk1qTTZJbk5vYjNkZllYSmphR2wyWlY5aGRYUm9iM0pmWW05NElqdHpPamM2SW1Ob1pXTnJaV1FpTzNNNk1UUTZJbk5vYjNkZmJXVjBZVjlrWVhSbElqdHpPamM2SW1Ob1pXTnJaV1FpTzNNNk1UZzZJbk5vYjNkZmJXVjBZVjlqYjIxdFpXNTBjeUk3Y3pvM09pSmphR1ZqYTJWa0lqdHpPakUxT2lKemFHOTNYMjFsZEdGZmJHbHJaWE1pTzNNNk56b2lZMmhsWTJ0bFpDSTdjem94TlRvaWMyaHZkMTl0WlhSaFgzWnBaWGR6SWp0ek9qYzZJbU5vWldOclpXUWlPM002TVRFNkltSnNiMmRmYkdGNWIzVjBJanR6T2pjNkluTnBaR1ZpWVhJaU8zTTZNVEk2SW1Kc2IyZGZjMmxrWldKaGNpSTdjem96TXpvaVkyRnViMjVmWVhKamFHbDJaVjl6YVdSbFltRnlYM2RwWkdkbGRGOWhjbVZoSWp0ek9qRXdPaUppYkc5blgzTjBlV3hsSWp0ek9qYzZJbTFoYzI5dWNua2lPM002TVRrNkltSnNiMmRmWlhoalpYSndkRjlzWlc1bmRHZ2lPM002TXpvaU5EVXdJanR6T2pJd09pSmliRzluWDIxaGMyOXVjbmxmWTI5c2RXMXVjeUk3Y3pveE9pSXhJanR6T2pFd09pSmpZWFJmYkdGNWIzVjBJanR6T2pjNkluTnBaR1ZpWVhJaU8zTTZNVEU2SW1OaGRGOXphV1JsWW1GeUlqdHpPak16T2lKallXNXZibDloY21Ob2FYWmxYM05wWkdWaVlYSmZkMmxrWjJWMFgyRnlaV0VpTzNNNk9Ub2lZMkYwWDNOMGVXeGxJanR6T2pjNkltTnNZWE56YVdNaU8zTTZNVGc2SW1OaGRGOWxlR05sY25CMFgyeGxibWQwYUNJN2N6b3pPaUl6TURBaU8zTTZNVGs2SW1OaGRGOXRZWE52Ym5KNVgyTnZiSFZ0Ym5NaU8zTTZNVG9pTWlJN2N6b3hORG9pWVhKamFHbDJaVjlzWVhsdmRYUWlPM002TnpvaWMybGtaV0poY2lJN2N6b3hOVG9pWVhKamFHbDJaVjl6YVdSbFltRnlJanR6T2pNek9pSmpZVzV2Ymw5aGNtTm9hWFpsWDNOcFpHVmlZWEpmZDJsa1oyVjBYMkZ5WldFaU8zTTZNVE02SW1GeVkyaHBkbVZmYzNSNWJHVWlPM002TnpvaVkyeGhjM05wWXlJN2N6b3lNam9pWVhKamFHbDJaVjlsZUdObGNuQjBYMnhsYm1kMGFDSTdjem96T2lJek1EQWlPM002TWpNNkltRnlZMmhwZG1WZmJXRnpiMjV5ZVY5amIyeDFiVzV6SWp0ek9qRTZJaklpTzNNNk1UVTZJbk5sWVhKamFGOWliM2hmZEdWNGRDSTdjem95TlRvaVYyaGhkQ0JoY21VZ2VXOTFJR3h2YjJ0cGJtY2dabTl5UHlJN2N6b3hNam9pYzJWaGNtTm9YM0J2YzNSeklqdHpPamM2SW1Ob1pXTnJaV1FpTzNNNk1USTZJbk5sWVhKamFGOXdZV2RsY3lJN2N6bzNPaUpqYUdWamEyVmtJanR6T2pFd09pSnpaV0Z5WTJoZlkzQjBJanR6T2pjNkltTm9aV05yWldRaU8zTTZNVGM2SW5ObFlYSmphRjlqY0hSZmMyOTFjbU5sSWp0ek9qQTZJaUk3Y3pveE1Eb2lOREEwWDJ4aGVXOTFkQ0k3Y3pvM09pSnphV1JsWW1GeUlqdHpPakV4T2lJME1EUmZjMmxrWldKaGNpSTdjem96TXpvaVkyRnViMjVmWVhKamFHbDJaVjl6YVdSbFltRnlYM2RwWkdkbGRGOWhjbVZoSWp0ek9qazZJalF3TkY5MGFYUnNaU0k3Y3pveE5Eb2lSWEp5YjNJZ05EQTBJRkJoWjJVaU8zTTZOem9pTkRBMFgyMXpaeUk3Y3pvNE1qb2lVMjl5Y25rc0lFbDBJSE5sWlcxeklIZGxJR05oYmlkMElHWnBibVFnZDJoaGRDQjViM1VuY21VZ2JHOXZhMmx1WnlCbWIzSXVJRkJsY21oaGNITWdjMlZoY21Ob2FXNW5JR05oYmlCb1pXeHdMaUk3Y3pveE1Ub2lZWEpqYUdsMlpWOWhaSE1pTzJFNk1qcDdhVG93TzJFNk5UcDdjem94TlRvaVlYQndaVzVrWDNSdlgzQnZjM1J6SWp0ek9qVTZJak1zSURFd0lqdHpPamM2SW1Ga1gyTnZaR1VpTzNNNk16RTFPaUk4WVNCb2NtVm1QU0lqSWlCamJHRnpjejBpWVdSeklHTnZiQzB4TFRJaVBnMEtQR2x0WnlCemNtTTlJbWgwZEhBNkx5OXNiMk5oYkdodmMzUTZPRGc0T0M4eU1ERTFNRFF4TlMxRGIyOXJRbTl2YXk5M2NDMWpiMjUwWlc1MEwzUm9aVzFsY3k5amIyOXJZbTl2YXk5cGJXY3ZZV1J6THpRMk9IZzJNQzV3Ym1jaUlHRnNkRDBpUVdSeklpQXZQZzBLUEM5aFBnMEtJQ0FnQ1FrSkNRa05DanhoSUdoeVpXWTlJaU1pSUdOc1lYTnpQU0poWkhNZ1kyOXNMVEV0TWlCc1lYTjBJajROQ2p4cGJXY2djM0pqUFNKb2RIUndPaTh2Ykc5allXeG9iM04wT2pnNE9EZ3ZNakF4TlRBME1UVXRRMjl2YTBKdmIyc3ZkM0F0WTI5dWRHVnVkQzkwYUdWdFpYTXZZMjl2YTJKdmIyc3ZhVzFuTDJGa2N5ODBOamg0TmpBdWNHNW5JaUJoYkhROUlrRmtjeUlnTHo0TkNqd3ZZVDRpTzNNNk1UTTZJbk5vYjNkZllXUnpYMkpzYjJjaU8zTTZPVG9pZFc1amFHVmphMlZrSWp0ek9qRTNPaUp6YUc5M1gyRmtjMTlqWVhSbFoyOXllU0k3Y3pvNU9pSjFibU5vWldOclpXUWlPM002TVRZNkluTm9iM2RmWVdSelgyRnlZMmhwZG1VaU8zTTZPVG9pZFc1amFHVmphMlZrSWp0OWFUb3hPMkU2TlRwN2N6b3hOVG9pWVhCd1pXNWtYM1J2WDNCdmMzUnpJanR6T2pVNklqTXNJREV3SWp0ek9qYzZJbUZrWDJOdlpHVWlPM002TVRRNU9pSThZU0JvY21WbVBTSWpJaUJqYkdGemN6MGlZV1J6SUdOdmJDMHhMVEVpUGcwS1BHbHRaeUJ6Y21NOUltaDBkSEE2THk5c2IyTmhiR2h2YzNRNk9EZzRPQzh5TURFMU1EUXhOUzFEYjI5clFtOXZheTkzY0MxamIyNTBaVzUwTDNSb1pXMWxjeTlqYjI5clltOXZheTlwYldjdllXUnpMelEyT0hnMk1DNXdibWNpSUdGc2REMGlRV1J6SWlBdlBnMEtQQzloUGlJN2N6b3hNem9pYzJodmQxOWhaSE5mWW14dlp5STdjem81T2lKMWJtTm9aV05yWldRaU8zTTZNVGM2SW5Ob2IzZGZZV1J6WDJOaGRHVm5iM0o1SWp0ek9qazZJblZ1WTJobFkydGxaQ0k3Y3pveE5qb2ljMmh2ZDE5aFpITmZZWEpqYUdsMlpTSTdjem81T2lKMWJtTm9aV05yWldRaU8zMTljem95TXpvaWRYTmxYM2R2YjJOdmJXMWxjbU5sWDNOcFpHVmlZWElpTzNNNk56b2lZMmhsWTJ0bFpDSTdjem94T1RvaWQyOXZZMjl0YldWeVkyVmZjMmxrWldKaGNpSTdjem94TkRvaVkyRnViMjVmWTNkaFgzTm9iM0FpTzNNNk1qSTZJblZ6WlY5aWRXUmtlWEJ5WlhOelgzTnBaR1ZpWVhJaU8zTTZOem9pWTJobFkydGxaQ0k3Y3pveE9Eb2lZblZrWkhsd2NtVnpjMTl6YVdSbFltRnlJanR6T2pFMU9pSmpZVzV2Ymw5amQyRmZabTl5ZFcwaU8zTTZNVGs2SW5WelpWOWlZbkJ5WlhOelgzTnBaR1ZpWVhJaU8zTTZOem9pWTJobFkydGxaQ0k3Y3pveE5Ub2lZbUp3Y21WemMxOXphV1JsWW1GeUlqdHpPakUxT2lKallXNXZibDlqZDJGZlptOXlkVzBpTzNNNk1UZzZJblZ6WlY5bGRtVnVkSE5mYzJsa1pXSmhjaUk3Y3pvM09pSmphR1ZqYTJWa0lqdHpPakUwT2lKbGRtVnVkSE5mYzJsa1pXSmhjaUk3Y3pveE5qb2lZMkZ1YjI1ZlkzZGhYMlYyWlc1MGN5STdmWE02TWpRNkltTmhibTl1WDI5d2RHbHZibk5mWVhCd1pXRnlZVzVqWlNJN1lUbzNOenA3Y3pveE5Ub2lZbTlrZVY5emEybHVYMk5zWVhOeklqdHpPalk2SW5OcmFXNHRNU0k3Y3pveE16b2lZMjlzYjNKZmNHRm5aVjlpWnlJN2N6bzNPaUlqWmpGbU1XWXhJanR6T2pFek9pSmpiMnh2Y2w5aWIyUjVYMkpuSWp0ek9qYzZJaU5tWm1abVptWWlPM002TVRnNkltTnZiRzl5WDJkbGJtVnlZV3hmZEdWNGRDSTdjem8zT2lJak1qSXlNakl5SWp0ek9qRTFPaUpqYjJ4dmNsOWliMlI1WDJ4cGJtc2lPM002TnpvaUl6SXlNakl5TWlJN2N6b3lNVG9pWTI5c2IzSmZZbTlrZVY5c2FXNXJYMmh2ZG1WeUlqdHpPamM2SWlOak0yRmtOekFpTzNNNk1UazZJbU52Ykc5eVgySnZaSGxmYUdWaFpHbHVaM01pTzNNNk56b2lJekl5TWpJeU1pSTdjem95TURvaVkyOXNiM0pmWjJWdVpYSmhiRjkwWlhoMFh6SWlPM002TnpvaUkyRmtZV1JoWkNJN2N6b3hOVG9pWTI5c2IzSmZiRzluYjE5MFpYaDBJanR6T2pjNklpTXlNakl5TWpJaU8zTTZNVFk2SW1OdmJHOXlYM0J5WldobFlXUmZZbWNpTzNNNk56b2lJelJqTlRZMVl5STdjem94TXpvaVkyOXNiM0pmY0hKbGFHVmhaQ0k3Y3pvM09pSWpabVptWm1abUlqdHpPakU1T2lKamIyeHZjbDl3Y21Wb1pXRmtYMmh2ZG1WeUlqdHpPamM2SWlOak0yRmtOekFpTzNNNk1UZzZJbU52Ykc5eVgzUm9hWEprWDNCeVpXNWhkaUk3Y3pvM09pSWpNek16WkRReklqdHpPakV6T2lKamIyeHZjbDlvWldGa1gySm5JanR6T2pjNklpTm1abVptWm1ZaU8zTTZNVEE2SW1OdmJHOXlYMmhsWVdRaU8zTTZOem9pSXpJeU1qSXlNaUk3Y3pveE5qb2lZMjlzYjNKZmFHVmhaRjlvYjNabGNpSTdjem8zT2lJall6TmhaRGN3SWp0ek9qSXlPaUpqYjJ4dmNsOW9aV0ZrWlhKZmJXVnVkWE5mTW01a0lqdHpPamM2SWlObVlXWmhabUVpTzNNNk1UZzZJbU52Ykc5eVgyaGxZV1JsY2w5dFpXNTFjeUk3Y3pvM09pSWpaakZtTVdZeElqdHpPakUzT2lKamIyeHZjbDl3YjNOMGFHVmhaRjlpWnlJN2N6bzNPaUlqTVdZeU56SmhJanR6T2pFME9pSmpiMnh2Y2w5d2IzTjBhR1ZoWkNJN2N6bzNPaUlqWm1abVptWm1JanR6T2pJd09pSmpiMnh2Y2w5d2IzTjBhR1ZoWkY5b2IzWmxjaUk3Y3pvM09pSWpZek5oWkRjd0lqdHpPakU1T2lKamIyeHZjbDkwYUdseVpGOXdiM04wYm1GMklqdHpPamM2SWlNeE5ERXpNVElpTzNNNk1UWTZJbU52Ykc5eVgzTnBaSEpmWW14dlkyc2lPM002TnpvaUl6SXdNamN5WWlJN2N6b3hOem9pWTI5c2IzSmZiV1Z1ZFY5MFpYaDBYekVpTzNNNk56b2lJMlptWm1abVppSTdjem95TURvaVkyOXNiM0pmWW14dlkydGZhR1ZoWkdsdVozTWlPM002TnpvaUl6SXdNamN5WWlJN2N6b3lNam9pWTI5c2IzSmZZbXh2WTJ0ZmFHVmhaR2x1WjNOZk1pSTdjem8zT2lJak5HTTFOalZqSWp0ek9qRTNPaUpqYjJ4dmNsOW1aV0YwWDNSbGVIUmZNU0k3Y3pvM09pSWpZek5oWkRjd0lqdHpPakV5T2lKamIyeHZjbDl4ZFc5MFpYTWlPM002TnpvaUl6VTFOV1kyTkNJN2N6b3hOam9pWTI5c2IzSmZkMmhwZEdWZmRHVjRkQ0k3Y3pvM09pSWpabVptWm1abUlqdHpPakV4T2lKamIyeHZjbDlpZEc1Zk1TSTdjem8zT2lJall6TmhaRGN3SWp0ek9qRTNPaUpqYjJ4dmNsOWlkRzVmTVY5b2IzWmxjaUk3Y3pvM09pSWpNakF5TnpKaUlqdHpPakUzT2lKamIyeHZjbDlpYkc5amExOXNhV2RvZENJN2N6bzNPaUlqWmpabU5tWTJJanR6T2pFMk9pSmpiMnh2Y2w5bVpXRjBYM1JwZEd4bElqdHpPamM2SWlObVptWm1abVlpTzNNNk1UUTZJbU52Ykc5eVgySnZjbVJsY2w4eElqdHpPamM2SWlNeVlqTTJNMk1pTzNNNk1UUTZJbU52Ykc5eVgySnZjbVJsY2w4eUlqdHpPamM2SWlObFlXVmhaV0VpTzNNNk1UUTZJbU52Ykc5eVgyWnZjbTF6WDJKbklqdHpPamM2SWlObU5HWTBaalFpTzNNNk1UWTZJbU52Ykc5eVgzQnlaV1p2YjNSZlltY2lPM002TnpvaUkyVmhaV0ZsWVNJN2N6b3hNem9pWTI5c2IzSmZjSEpsWm05dmRDSTdjem8zT2lJak1qZ3lPVEpqSWp0ek9qRTVPaUpqYjJ4dmNsOXdjbVZtYjI5MFgyaHZkbVZ5SWp0ek9qYzZJaU5qTTJGa056QWlPM002TVRNNkltTnZiRzl5WDJadmIzUmZZbWNpTzNNNk56b2lJekkzTW1Zek15STdjem94TURvaVkyOXNiM0pmWm05dmRDSTdjem8zT2lJalptWm1abVptSWp0ek9qRTJPaUpqYjJ4dmNsOW1iMjkwWDJodmRtVnlJanR6T2pjNklpTmpNMkZrTnpBaU8zTTZNVEk2SW1OdmJHOXlYMlp2YjNSZk1pSTdjem8zT2lJalptWm1abVptSWp0ek9qRTBPaUpqYjJ4dmNsOWliM0prWlhKZk15STdjem8zT2lJak1tSXpOak5qSWp0ek9qRTFPaUpqYjJ4dmNsOW1iMjkwWDJKblh6SWlPM002TnpvaUl6TmhORFkwWXlJN2N6b3hOem9pWTI5c2IzSmZZbUZ6Wld4cGJtVmZZbWNpTzNNNk56b2lJekUzTVdVeU1DSTdjem94TkRvaVkyOXNiM0pmWW1GelpXeHBibVVpTzNNNk56b2lJMkkyWWpaaU5pSTdjem95TURvaVkyOXNiM0pmWW1GelpXeHBibVZmYUc5MlpYSWlPM002TnpvaUkyTXpZV1EzTUNJN2N6b3hNRG9pWW1kZmFXMW5YM1Z5YkNJN2N6b3dPaUlpTzNNNk56b2lZbWRmYkdsdWF5STdjem93T2lJaU8zTTZPVG9pWW1kZmNtVndaV0YwSWp0ek9qWTZJbkpsY0dWaGRDSTdjem94TXpvaVltZGZZWFIwWVdOb2JXVnVkQ0k3Y3pvMU9pSm1hWGhsWkNJN2N6b3lNam9pYkdsbmFIUmliM2hmYjNabGNteGhlVjlqYjJ4dmNpSTdjem8zT2lJak1EQXdNREF3SWp0ek9qSTBPaUpzYVdkb2RHSnZlRjl2ZG1WeWJHRjVYMjl3WVdOcGRIa2lPM002TXpvaU1DNDNJanR6T2prNkltWnZiblJmYldGcGJpSTdZVG96T250cE9qQTdjem94TXpvaVkyRnViMjVmWkdWbVlYVnNkQ0k3YVRveE8zTTZOem9pY21WbmRXeGhjaUk3YVRveU8zTTZOVG9pYkdGMGFXNGlPMzF6T2pFek9pSm1iMjUwWDJobFlXUnBibWR6SWp0aE9qTTZlMms2TUR0ek9qRXpPaUpqWVc1dmJsOWtaV1poZFd4MElqdHBPakU3Y3pvM09pSnlaV2QxYkdGeUlqdHBPakk3Y3pvMU9pSnNZWFJwYmlJN2ZYTTZPRG9pWm05dWRGOXVZWFlpTzJFNk16cDdhVG93TzNNNk1UTTZJbU5oYm05dVgyUmxabUYxYkhRaU8yazZNVHR6T2pjNkluSmxaM1ZzWVhJaU8yazZNanR6T2pVNklteGhkR2x1SWp0OWN6b3hPRG9pWm05dWRGOW9aV0ZrYVc1bmMxOXRaWFJoSWp0aE9qTTZlMms2TUR0ek9qRXpPaUpqWVc1dmJsOWtaV1poZFd4MElqdHBPakU3Y3pvM09pSnlaV2QxYkdGeUlqdHBPakk3Y3pvMU9pSnNZWFJwYmlJN2ZYTTZPVG9pWm05dWRGOWliMnhrSWp0aE9qTTZlMms2TUR0ek9qRXpPaUpqWVc1dmJsOWtaV1poZFd4MElqdHBPakU3Y3pvM09pSnlaV2QxYkdGeUlqdHBPakk3Y3pvMU9pSnNZWFJwYmlJN2ZYTTZNVEU2SW1admJuUmZhWFJoYkdsaklqdGhPak02ZTJrNk1EdHpPakV6T2lKallXNXZibDlrWldaaGRXeDBJanRwT2pFN2N6bzNPaUp5WldkMWJHRnlJanRwT2pJN2N6bzFPaUpzWVhScGJpSTdmWE02TVRFNkltWnZiblJmYzNSeWIyNW5JanRoT2pNNmUyazZNRHR6T2pFek9pSmpZVzV2Ymw5a1pXWmhkV3gwSWp0cE9qRTdjem8zT2lKeVpXZDFiR0Z5SWp0cE9qSTdjem8xT2lKc1lYUnBiaUk3ZlhNNk9Ub2labTl1ZEY5c2IyZHZJanRoT2pNNmUyazZNRHR6T2pFek9pSmpZVzV2Ymw5a1pXWmhkV3gwSWp0cE9qRTdjem8zT2lKeVpXZDFiR0Z5SWp0cE9qSTdjem8xT2lKc1lYUnBiaUk3ZlhNNk1UUTZJbVp2Ym5SZmMybDZaVjl5YjI5MElqdHpPakE2SWlJN2N6b3lOVG9pWVc1cGJWOXBiV2RmYzJ4cFpHVnlYM05zYVdSbGMyaHZkeUk3Y3pvNU9pSjFibU5vWldOclpXUWlPM002TWpFNkltRnVhVzFmYVcxblgzTnNhV1JsY2w5a1pXeGhlU0k3Y3pvME9pSTFNREF3SWp0ek9qSTVPaUpoYm1sdFgybHRaMTl6Ykdsa1pYSmZZVzVwYlY5a2RYSmhkR2x2YmlJN2N6b3pPaUk0TURBaU8zTTZNamM2SW1GdWFXMWZjWFZ2ZEdWZmMyeHBaR1Z5WDNOc2FXUmxjMmh2ZHlJN2N6bzVPaUoxYm1Ob1pXTnJaV1FpTzNNNk1qTTZJbUZ1YVcxZmNYVnZkR1ZmYzJ4cFpHVnlYMlJsYkdGNUlqdHpPalE2SWpVd01EQWlPM002TXpFNkltRnVhVzFmY1hWdmRHVmZjMnhwWkdWeVgyRnVhVzFmWkhWeVlYUnBiMjRpTzNNNk16b2lPREF3SWp0ek9qTXpPaUpzWVhwNVgyeHZZV1JmYjI1ZmNHRm5aV0oxYVd4a1pYSmZaV3hsYldWdWRITWlPM002T1RvaWRXNWphR1ZqYTJWa0lqdHpPakkyT2lKc1lYcDVYMnh2WVdSZmIyNWZZWEpqYUdsMlpWOXdiM04wY3lJN2N6bzVPaUoxYm1Ob1pXTnJaV1FpTzNNNk1qQTZJbXhoZW5sZmJHOWhaRjl2Ymw5M2FXUm5aWFJ6SWp0ek9qazZJblZ1WTJobFkydGxaQ0k3Y3pveE5Ub2liR0Y2ZVY5c2IyRmtYMkZtZEdWeUlqdHpPak02SWpBdU15STdjem94TlRvaWJHRjZlVjlzYjJGa1gyVnVkR1Z5SWp0ek9qWTZJbUp2ZEhSdmJTSTdjem94TkRvaWJHRjZlVjlzYjJGa1gyMXZkbVVpTzNNNk1qb2lNalFpTzNNNk1UUTZJbXhoZW5sZmJHOWhaRjl2ZG1WeUlqdHpPalE2SWpBdU5UWWlPM002TWpVNklteGhlbmxmYkc5aFpGOTJhV1YzY0c5eWRGOW1ZV04wYjNJaU8zTTZNem9pTUM0eUlqdDljem95TWpvaVkyRnViMjVmYjNCMGFXOXVjMTloWkhaaGJtTmxaQ0k3WVRvM09udHpPakU1T2lKamRYTjBiMjFmZDJsa1oyVjBYMkZ5WldGeklqdGhPakV5T250cE9qazVPVGs3Y3pvd09pSWlPMms2TUR0ek9qSXdPaUpEZFhOMGIyMGdWMmxrWjJWMElFRnlaV0VnTVNJN2FUb3hPM002TWpBNklrTjFjM1J2YlNCWGFXUm5aWFFnUVhKbFlTQXlJanRwT2pJN2N6b3lNRG9pUTNWemRHOXRJRmRwWkdkbGRDQkJjbVZoSURNaU8yazZNenR6T2pRNklsTm9iM0FpTzJrNk5EdHpPalU2SWtadmNuVnRJanRwT2pVN2N6bzJPaUpGZG1WdWRITWlPMms2Tmp0ek9qWTZJbE52WTJsaGJDSTdhVG8zTzNNNk9Ub2lVM1ZpYzJOeWFXSmxJanRwT2pnN2N6bzRPaUpHWVdObFltOXZheUk3YVRvNU8zTTZNVEE2SWxSbGVIUXRRbXh2WTJzaU8yazZNVEE3Y3pvME9pSlVZV0p6SWp0OWN6b3hPRG9pZFhObFgyWnBibUZzWDJOaGJHeGZZM056SWp0ek9qYzZJbU5vWldOclpXUWlPM002TVRRNkltWnBibUZzWDJOaGJHeGZZM056SWp0ek9qVXhPaUl1YldGcGJpMW9aV0ZrWlhJdWNtbG5hSFFnTG1Ga2Mzc05DaUFnSUNCdFlYSm5hVzR0ZEc5d09pQXRNVFZ3ZURzTkNuMGlPM002TVRnNkltTmhibTl1WDI5d2RHbHZibk5mWkdGMFlTSTdjem93T2lJaU8zTTZNVEU2SW1sdGNHOXlkRjlrWVhSaElqdHpPakE2SWlJN2N6b3hNVG9pY21WelpYUmZZbUZ6YVdNaU8zTTZNRG9pSWp0ek9qazZJbkpsYzJWMFgyRnNiQ0k3Y3pvd09pSWlPMzE5IjtzOjExOiJpbXBvcnRfZGF0YSI7czowOiIiO3M6MTg6ImNhbm9uX3dpZGdldHNfZGF0YSI7czo4MjQ4OiJZVG95T250ek9qRXlPaUozYVdSblpYUmZZWEpsWVhNaU8yRTZNakE2ZTNNNk1UazZJbmR3WDJsdVlXTjBhWFpsWDNkcFpHZGxkSE1pTzJFNk1EcDdmWE02TXpNNkltTmhibTl1WDJGeVkyaHBkbVZmYzJsa1pXSmhjbDkzYVdSblpYUmZZWEpsWVNJN1lUb3pPbnRwT2pBN2N6b3lNem9pWTI5dmEySnZiMnRmYzI5amFXRnNYMnhwYm10ekxUSWlPMms2TVR0ek9qRXlPaUpqWVhSbFoyOXlhV1Z6TFRJaU8yazZNanR6T2pFeE9pSjBZV2RmWTJ4dmRXUXRNaUk3ZlhNNk16QTZJbU5oYm05dVgzQmhaMlZmYzJsa1pXSmhjbDkzYVdSblpYUmZZWEpsWVNJN1lUb3dPbnQ5Y3pveU5qb2lZMkZ1YjI1ZlptOXZkR1Z5WDNkcFpHZGxkRjloY21WaFh6RWlPMkU2TVRwN2FUb3dPM002TmpvaWRHVjRkQzB5SWp0OWN6b3lOam9pWTJGdWIyNWZabTl2ZEdWeVgzZHBaR2RsZEY5aGNtVmhYeklpTzJFNk1UcDdhVG93TzNNNk1qWTZJbU52YjJ0aWIyOXJYM1pqWDNCdmMzUnpYMnhwYzNSbFpDMHlJanQ5Y3pveU5qb2lZMkZ1YjI1ZlptOXZkR1Z5WDNkcFpHZGxkRjloY21WaFh6TWlPMkU2TVRwN2FUb3dPM002TVRnNkltTnZiMnRpYjI5clgzUjNhWFIwWlhJdE1pSTdmWE02TWpZNkltTmhibTl1WDJadmIzUmxjbDkzYVdSblpYUmZZWEpsWVY4MElqdGhPakU2ZTJrNk1EdHpPakl4T2lKamIyOXJZbTl2YTE5dGIzSmxYM0J2YzNSekxUSWlPMzF6T2pJMk9pSmpZVzV2Ymw5bWIyOTBaWEpmZDJsa1oyVjBYMkZ5WldGZk5TSTdZVG93T250OWN6b3pNRG9pWTJGdWIyNWZZM2RoWDJOMWMzUnZiUzEzYVdSblpYUXRZWEpsWVMweElqdGhPakE2ZTMxek9qTXdPaUpqWVc1dmJsOWpkMkZmWTNWemRHOXRMWGRwWkdkbGRDMWhjbVZoTFRJaU8yRTZNRHA3ZlhNNk16QTZJbU5oYm05dVgyTjNZVjlqZFhOMGIyMHRkMmxrWjJWMExXRnlaV0V0TXlJN1lUb3dPbnQ5Y3pveE5Eb2lZMkZ1YjI1ZlkzZGhYM05vYjNBaU8yRTZNenA3YVRvd08zTTZNalU2SW5kdmIyTnZiVzFsY21ObFgzZHBaR2RsZEY5allYSjBMVElpTzJrNk1UdHpPakkyT2lKM2IyOWpiMjF0WlhKalpWOXdjbWxqWlY5bWFXeDBaWEl0TWlJN2FUb3lPM002TXpJNkluZHZiMk52YlcxbGNtTmxYM1J2Y0Y5eVlYUmxaRjl3Y205a2RXTjBjeTB5SWp0OWN6b3hOVG9pWTJGdWIyNWZZM2RoWDJadmNuVnRJanRoT2pNNmUyazZNRHR6T2pFNE9pSmlZbkJmYkc5bmFXNWZkMmxrWjJWMExUSWlPMms2TVR0ek9qRTVPaUppWW5CZlptOXlkVzF6WDNkcFpHZGxkQzB5SWp0cE9qSTdjem94T0RvaVltSndYM04wWVhSelgzZHBaR2RsZEMweUlqdDljem94TmpvaVkyRnViMjVmWTNkaFgyVjJaVzUwY3lJN1lUb3lPbnRwT2pBN2N6b3lOam9pZEhKcFltVXRaWFpsYm5SekxXeHBjM1F0ZDJsa1oyVjBMVElpTzJrNk1UdHpPalk2SW5SbGVIUXRNeUk3ZlhNNk1UWTZJbU5oYm05dVgyTjNZVjl6YjJOcFlXd2lPMkU2TVRwN2FUb3dPM002TWpNNkltTnZiMnRpYjI5clgzTnZZMmxoYkY5c2FXNXJjeTB6SWp0OWN6b3hPVG9pWTJGdWIyNWZZM2RoWDNOMVluTmpjbWxpWlNJN1lUb3hPbnRwT2pBN2N6b3hORG9pYldNMGQzQmZkMmxrWjJWMExUSWlPMzF6T2pFNE9pSmpZVzV2Ymw5amQyRmZabUZqWldKdmIyc2lPMkU2TVRwN2FUb3dPM002TWpZNkluZHBaR2RsZEY5amIyOXJZbTl2YTE5bVlXTmxZbTl2YXkweUlqdDljem94T1RvaVkyRnViMjVmWTNkaFgzUmxlSFJpYkc5amF5STdZVG94T250cE9qQTdjem8yT2lKMFpYaDBMVFFpTzMxek9qRTBPaUpqWVc1dmJsOWpkMkZmZEdGaWN5STdZVG94T250cE9qQTdjem94TVRvaWRHRm5YMk5zYjNWa0xUTWlPMzF6T2pFek9pSmhjbkpoZVY5MlpYSnphVzl1SWp0cE9qTTdmWE02TVRRNkltRmpkR2wyWlY5M2FXUm5aWFJ6SWp0aE9qRTJPbnR6T2pJeE9pSmpiMjlyWW05dmExOXpiMk5wWVd4ZmJHbHVhM01pTzJFNk16cDdhVG95TzJFNk5EcDdjem94TWpvaWQybGtaMlYwWDNScGRHeGxJanR6T2prNklrWnZiR3h2ZHlCVmN5STdjem94TXpvaVpHbHpjR3hoZVY5emRIbHNaU0k3Y3pvM09pSnliM1Z1WkdWa0lqdHpPakV4T2lKdmNHVnVYMmx1WDI1bGR5STdjem8zT2lKamFHVmphMlZrSWp0ek9qRXlPaUp6YjJOcFlXeGZiR2x1YTNNaU8yRTZOVHA3YVRvd08yRTZNanA3YVRvd08zTTZNVEU2SW1aaExXWmhZMlZpYjI5cklqdHBPakU3Y3pvek5Ub2lhSFIwY0hNNkx5OTNkM2N1Wm1GalpXSnZiMnN1WTI5dEwzUm9aVzFsWTJGdWIyNGlPMzFwT2pFN1lUb3lPbnRwT2pBN2N6b3hNRG9pWm1FdGRIZHBkSFJsY2lJN2FUb3hPM002TXpBNkltaDBkSEJ6T2k4dmRIZHBkSFJsY2k1amIyMHZWR2hsYldWRFlXNXZiaUk3ZldrNk1qdGhPakk2ZTJrNk1EdHpPakV4T2lKbVlTMWtjbWxpWW1Kc1pTSTdhVG94TzNNNk16QTZJbWgwZEhCek9pOHZaSEpwWW1KaWJHVXVZMjl0TDJocGNtVnJaVzV1ZVNJN2ZXazZNenRoT2pJNmUyazZNRHR6T2pFd09pSm1ZUzFpWldoaGJtTmxJanRwT2pFN2N6b3pORG9pYUhSMGNITTZMeTkzZDNjdVltVm9ZVzVqWlM1dVpYUXZkR2hsYldWallXNXZiaUk3ZldrNk5EdGhPakk2ZTJrNk1EdHpPalk2SW1aaExYSnpjeUk3YVRveE8zTTZOVEE2SW1oMGRIQTZMeTlzYjJOaGJHaHZjM1E2T0RnNE9DOHlNREUxTURReE5TMURiMjlyUW05dmF5OC9abVZsWkQxeWMzTXlJanQ5ZlgxcE9qTTdZVG8wT250ek9qRXlPaUozYVdSblpYUmZkR2wwYkdVaU8zTTZPVG9pUm05c2JHOTNJRlZ6SWp0ek9qRXpPaUprYVhOd2JHRjVYM04wZVd4bElqdHpPamM2SW5KdmRXNWtaV1FpTzNNNk1URTZJbTl3Wlc1ZmFXNWZibVYzSWp0ek9qYzZJbU5vWldOclpXUWlPM002TVRJNkluTnZZMmxoYkY5c2FXNXJjeUk3WVRvMU9udHBPakE3WVRveU9udHBPakE3Y3pveE1Ub2labUV0Wm1GalpXSnZiMnNpTzJrNk1UdHpPak0xT2lKb2RIUndjem92TDNkM2R5NW1ZV05sWW05dmF5NWpiMjB2ZEdobGJXVmpZVzV2YmlJN2ZXazZNVHRoT2pJNmUyazZNRHR6T2pFd09pSm1ZUzEwZDJsMGRHVnlJanRwT2pFN2N6b3pNRG9pYUhSMGNITTZMeTkwZDJsMGRHVnlMbU52YlM5VWFHVnRaVU5oYm05dUlqdDlhVG95TzJFNk1qcDdhVG93TzNNNk1URTZJbVpoTFdSeWFXSmlZbXhsSWp0cE9qRTdjem96TURvaWFIUjBjSE02THk5a2NtbGlZbUpzWlM1amIyMHZhR2x5Wld0bGJtNTVJanQ5YVRvek8yRTZNanA3YVRvd08zTTZNVEE2SW1aaExXSmxhR0Z1WTJVaU8yazZNVHR6T2pNME9pSm9kSFJ3Y3pvdkwzZDNkeTVpWldoaGJtTmxMbTVsZEM5MGFHVnRaV05oYm05dUlqdDlhVG8wTzJFNk1qcDdhVG93TzNNNk5qb2labUV0Y25OeklqdHBPakU3Y3pvME5Ub2lhSFIwY0RvdkwyeHZZMkZzYUc5emREbzRPRGc0THpJd01UVXdOREUxTFVOdmIydENiMjlyTDJabFpXUXZJanQ5Zlgxek9qRXlPaUpmYlhWc2RHbDNhV1JuWlhRaU8yazZNVHQ5Y3pveE1Eb2lZMkYwWldkdmNtbGxjeUk3WVRveU9udHBPakk3WVRvME9udHpPalU2SW5ScGRHeGxJanR6T2pFNE9pSkNjbTkzYzJVZ1Fua2dRMkYwWldkdmNua2lPM002TlRvaVkyOTFiblFpTzJrNk1UdHpPakV5T2lKb2FXVnlZWEpqYUdsallXd2lPMms2TUR0ek9qZzZJbVJ5YjNCa2IzZHVJanRwT2pBN2ZYTTZNVEk2SWw5dGRXeDBhWGRwWkdkbGRDSTdhVG94TzMxek9qazZJblJoWjE5amJHOTFaQ0k3WVRvek9udHBPakk3WVRveU9udHpPalU2SW5ScGRHeGxJanR6T2pJd09pSkNjbTkzYzJVZ1Fua2dTVzVuY21Wa2FXVnVkQ0k3Y3pvNE9pSjBZWGh2Ym05dGVTSTdjem80T2lKd2IzTjBYM1JoWnlJN2ZXazZNenRoT2pJNmUzTTZOVG9pZEdsMGJHVWlPM002TWpBNklrSnliM2R6WlNCQ2VTQkpibWR5WldScFpXNTBJanR6T2pnNkluUmhlRzl1YjIxNUlqdHpPamc2SW5CdmMzUmZkR0ZuSWp0OWN6b3hNam9pWDIxMWJIUnBkMmxrWjJWMElqdHBPakU3ZlhNNk5Eb2lkR1Y0ZENJN1lUbzBPbnRwT2pJN1lUb3pPbnR6T2pVNkluUnBkR3hsSWp0ek9qRTBPaUpCWW05MWRDQkRiMjlyUW05dmF5STdjem8wT2lKMFpYaDBJanR6T2pNeE9Eb2lQSE4wY205dVp6NURjbUZ6SUcxaGRIUnBjeUJqYjI1elpXTjBaWFIxY2lCd2RYSjFjeUJ6YVhRZ1lXMWxkQ0JtWlhKdFpXNTBkVzB1SUVGbGJtVmhiaUJzWVdOcGJtbGhJR0pwWW1WdVpIVnRJRzUxYkd4aExqd3ZjM1J5YjI1blBnMEtEUXBXWlhOMGFXSjFiSFZ0SUdsa0lHeHBaM1ZzWVNCd2IzSjBZU0JtWld4cGN5QmxkV2x6Ylc5a0lITmxiWEJsY2k0Z1JYUnBZVzBnY0c5eWRHRWdjMlZ0SUcxaGJHVnpkV0ZrWVNCdFlXZHVZU0J0YjJ4c2FYTWdaWFZwYzIxdlpDNGdSRzl1WldNZ2FXUWdaV3hwZENCdWIyNGdiV2tnY0c5eWRHRWdaM0poZG1sa1lTQmhkQ0JsWjJWMElHMWxkSFZ6TGlCV2FYWmhiWFZ6SUhOaFoybDBkR2x6SUd4aFkzVnpJSFpsYkNCaGRXZDFaU0JzWVc5eVpXVjBJSEoxZEhKMWJTQm1ZWFZqYVdKMWN5QmtiMnh2Y2lCaGRXTjBiM0l1SWp0ek9qWTZJbVpwYkhSbGNpSTdZam94TzMxcE9qTTdZVG96T250ek9qVTZJblJwZEd4bElqdHpPakUwT2lKUmRXbGpheUJSZFdWemRHbHZiaUk3Y3pvME9pSjBaWGgwSWp0ek9qUTVPaUpiWTI5dWRHRmpkQzFtYjNKdExUY2dhV1E5SWpFd05qa2lJSFJwZEd4bFBTSlJkV2xqYXlCUmRXVnpkR2x2YmlKZElqdHpPalk2SW1acGJIUmxjaUk3WWpvd08zMXBPalE3WVRvek9udHpPalU2SW5ScGRHeGxJanR6T2pFME9pSkJZbTkxZENCRGIyOXJRbTl2YXlJN2N6bzBPaUowWlhoMElqdHpPakl3TXpvaVBHbHRaeUJ6Y21NOUltaDBkSEE2THk5c2IyTmhiR2h2YzNRNk9EZzRPQzh5TURFMU1EUXhOUzFEYjI5clFtOXZheTkzY0MxamIyNTBaVzUwTDNWd2JHOWhaSE12TWpBeE5TOHdOQzl0WVdOaGNtOXVjeTVxY0djaVBnMEtEUXBKYm5SbFoyVnlJSEJ2YzNWbGNtVWdaWEpoZENCaElHRnVkR1VnZG1WdVpXNWhkR2x6SUdSaGNHbGlkWE1nY0c5emRXVnlaU0IyWld4cGRDQmhiR2x4ZFdWMExpQkRkVzBnYzI5amFXbHpJRzVoZEc5eGRXVWdjR1Z1WVhScFluVnpJR1YwSUcxaFoyNXBjeTRpTzNNNk5qb2labWxzZEdWeUlqdGlPakU3ZlhNNk1USTZJbDl0ZFd4MGFYZHBaR2RsZENJN2FUb3hPMzF6T2pJME9pSmpiMjlyWW05dmExOTJZMTl3YjNOMGMxOXNhWE4wWldRaU8yRTZNanA3YVRveU8yRTZOanA3Y3pveE1qb2lkMmxrWjJWMFgzUnBkR3hsSWp0ek9qRXlPaUpNWVhSbGMzUWdjRzl6ZEhNaU8zTTZORG9pYzJodmR5STdjem94TWpvaWJHRjBaWE4wWDNCdmMzUnpJanR6T2pZNkltOW1abk5sZENJN2N6b3hPaUl4SWp0ek9qRTBPaUp1ZFcxZmNHOXpkSE5mYzJodmR5STdjem94T2lJeklqdHpPalE2SW0xbGRHRWlPM002TkRvaVpHRjBaU0k3Y3pveE1Ub2lhR2xrWlY5eVlYUnBibWNpTzNNNk9Ub2lkVzVqYUdWamEyVmtJanQ5Y3pveE1qb2lYMjExYkhScGQybGtaMlYwSWp0cE9qRTdmWE02TVRZNkltTnZiMnRpYjI5clgzUjNhWFIwWlhJaU8yRTZNanA3YVRveU8yRTZORHA3Y3pveE1qb2lkMmxrWjJWMFgzUnBkR3hsSWp0ek9qRXpPaUpNWVhSbGMzUWdkSGRsWlhSeklqdHpPakU1T2lKMGQybDBkR1Z5WDNkcFpHZGxkRjlqYjJSbElqdHpPalF6TVRvaUlEeGhJR05zWVhOelBTSjBkMmwwZEdWeUxYUnBiV1ZzYVc1bElpQm9jbVZtUFNKb2RIUndjem92TDNSM2FYUjBaWEl1WTI5dEwyMWhhMlZzWlcxdmJtRmtaV052SWlCa1lYUmhMWGRwWkdkbGRDMXBaRDBpTXpNME5qTXlPVE16TURBMk5qVTFORGc0SWo1VWQyVmxkSE1nWW5rZ1FHMWhhMlZzWlcxdmJtRmtaV052UEM5aFBpQThjMk55YVhCMFBpRm1kVzVqZEdsdmJpaGtMSE1zYVdRcGUzWmhjaUJxY3l4bWFuTTlaQzVuWlhSRmJHVnRaVzUwYzBKNVZHRm5UbUZ0WlNoektWc3dYU3h3UFM5ZWFIUjBjRG92TG5SbGMzUW9aQzVzYjJOaGRHbHZiaWsvSjJoMGRIQW5PaWRvZEhSd2N5YzdhV1lvSVdRdVoyVjBSV3hsYldWdWRFSjVTV1FvYVdRcEtYdHFjejFrTG1OeVpXRjBaVVZzWlcxbGJuUW9jeWs3YW5NdWFXUTlhV1E3YW5NdWMzSmpQWEFySWpvdkwzQnNZWFJtYjNKdExuUjNhWFIwWlhJdVkyOXRMM2RwWkdkbGRITXVhbk1pTzJacWN5NXdZWEpsYm5ST2IyUmxMbWx1YzJWeWRFSmxabTl5WlNocWN5eG1hbk1wTzMxOUtHUnZZM1Z0Wlc1MExDSnpZM0pwY0hRaUxDSjBkMmwwZEdWeUxYZHFjeUlwT3p3dmMyTnlhWEIwUGlBaU8zTTZNVFk2SW5WelpWOTBhR1Z0WlY5a1pYTnBaMjRpTzNNNk56b2lZMmhsWTJ0bFpDSTdjem94T0RvaWRIZHBkSFJsY2w5dWRXMWZkSGRsWlhSeklqdHpPakU2SWpJaU8zMXpPakV5T2lKZmJYVnNkR2wzYVdSblpYUWlPMms2TVR0OWN6b3hPVG9pWTI5dmEySnZiMnRmYlc5eVpWOXdiM04wY3lJN1lUb3lPbnRwT2pJN1lUbzFPbnR6T2pFeU9pSjNhV1JuWlhSZmRHbDBiR1VpTzNNNk1URTZJa3hoZEdWemRDQlFhV056SWp0ek9qRXdPaUp3YjNOMGMxOW1jbTl0SWp0ek9qRXlPaUpzWVhSbGMzUmZjRzl6ZEhNaU8zTTZNVE02SW1ScGMzQnNZWGxmYzNSNWJHVWlPM002TVRnNkltbHRZV2RsYzE5MGIxOXNhV2RvZEdKdmVDSTdjem81T2lKdWRXMWZjRzl6ZEhNaU8zTTZNVG9pTmlJN2N6b3hNVG9pYm5WdFgyTnZiSFZ0Ym5NaU8zTTZNVG9pTWlJN2ZYTTZNVEk2SWw5dGRXeDBhWGRwWkdkbGRDSTdhVG94TzMxek9qSXpPaUozYjI5amIyMXRaWEpqWlY5M2FXUm5aWFJmWTJGeWRDSTdZVG95T250cE9qSTdZVG95T250ek9qVTZJblJwZEd4bElqdHpPams2SWxsdmRYSWdRMkZ5ZENJN2N6b3hNem9pYUdsa1pWOXBabDlsYlhCMGVTSTdhVG93TzMxek9qRXlPaUpmYlhWc2RHbDNhV1JuWlhRaU8yazZNVHQ5Y3pveU5Eb2lkMjl2WTI5dGJXVnlZMlZmY0hKcFkyVmZabWxzZEdWeUlqdGhPakk2ZTJrNk1qdGhPakU2ZTNNNk5Ub2lkR2wwYkdVaU8zTTZNVFU2SWtacGJIUmxjaUJpZVNCd2NtbGpaU0k3ZlhNNk1USTZJbDl0ZFd4MGFYZHBaR2RsZENJN2FUb3hPMzF6T2pNd09pSjNiMjlqYjIxdFpYSmpaVjkwYjNCZmNtRjBaV1JmY0hKdlpIVmpkSE1pTzJFNk1qcDdhVG95TzJFNk1qcDdjem8xT2lKMGFYUnNaU0k3Y3pveE9Eb2lWRzl3SUZKaGRHVmtJRkJ5YjJSMVkzUnpJanR6T2pZNkltNTFiV0psY2lJN2N6b3hPaUl6SWp0OWN6b3hNam9pWDIxMWJIUnBkMmxrWjJWMElqdHBPakU3ZlhNNk1UWTZJbUppY0Y5c2IyZHBibDkzYVdSblpYUWlPMkU2TWpwN2FUb3lPMkU2TXpwN2N6bzFPaUowYVhSc1pTSTdjem8xT2lKTWIyZHBiaUk3Y3pvNE9pSnlaV2RwYzNSbGNpSTdjem93T2lJaU8zTTZPRG9pYkc5emRIQmhjM01pTzNNNk1Eb2lJanQ5Y3pveE1qb2lYMjExYkhScGQybGtaMlYwSWp0cE9qRTdmWE02TVRjNkltSmljRjltYjNKMWJYTmZkMmxrWjJWMElqdGhPakk2ZTJrNk1qdGhPakk2ZTNNNk5Ub2lkR2wwYkdVaU8zTTZOam9pUm05eWRXMXpJanR6T2pFeU9pSndZWEpsYm5SZlptOXlkVzBpTzNNNk1Ub2lNQ0k3ZlhNNk1USTZJbDl0ZFd4MGFYZHBaR2RsZENJN2FUb3hPMzF6T2pFMk9pSmlZbkJmYzNSaGRITmZkMmxrWjJWMElqdGhPakk2ZTJrNk1qdGhPakU2ZTNNNk5Ub2lkR2wwYkdVaU8zTTZNVFk2SWtadmNuVnRJRk4wWVhScGMzUnBZM01pTzMxek9qRXlPaUpmYlhWc2RHbDNhV1JuWlhRaU8yazZNVHQ5Y3pveU5Eb2lkSEpwWW1VdFpYWmxiblJ6TFd4cGMzUXRkMmxrWjJWMElqdGhPakk2ZTJrNk1qdGhPak02ZTNNNk5Ub2lkR2wwYkdVaU8zTTZNVFU2SWxWd1kyOXRhVzVuSUVWMlpXNTBjeUk3Y3pvMU9pSnNhVzFwZENJN2N6b3hPaUkxSWp0ek9qRTRPaUp1YjE5MWNHTnZiV2x1WjE5bGRtVnVkSE1pTzA0N2ZYTTZNVEk2SWw5dGRXeDBhWGRwWkdkbGRDSTdhVG94TzMxek9qRXlPaUp0WXpSM2NGOTNhV1JuWlhRaU8yRTZNanA3YVRveU8yRTZNVHA3Y3pvMU9pSjBhWFJzWlNJN2N6b3hPRG9pUjJWMElFOTFjaUJPWlhkemJHVjBkR1Z5SWp0OWN6b3hNam9pWDIxMWJIUnBkMmxrWjJWMElqdHBPakU3ZlhNNk1qUTZJbmRwWkdkbGRGOWpiMjlyWW05dmExOW1ZV05sWW05dmF5STdZVG95T250cE9qSTdZVG80T250ek9qRXlPaUozYVdSblpYUmZkR2wwYkdVaU8zTTZNVGs2SWt4cGEyVWdWWE1nVDI0Z1JtRmpaV0p2YjJzaU8zTTZOem9pWm1KZmNHRm5aU0k3Y3pvek5Ub2lhSFIwY0hNNkx5OTNkM2N1Wm1GalpXSnZiMnN1WTI5dEwzUm9aVzFsWTJGdWIyNGlPM002T0RvaVptSmZkMmxrZEdnaU8zTTZNem9pTXpJd0lqdHpPamc2SW1aaVgzTjBlV3hsSWp0ek9qVTZJbXhwWjJoMElqdHpPams2SW1aaVgyaGxZV1JsY2lJN2N6bzNPaUpqYUdWamEyVmtJanR6T2pjNkltWmlYM2RoYkd3aU8zTTZPVG9pZFc1amFHVmphMlZrSWp0ek9qZzZJbVppWDJaaFkyVnpJanR6T2pjNkltTm9aV05yWldRaU8zTTZPVG9pWm1KZlltOXlaR1Z5SWp0ek9qYzZJbU5vWldOclpXUWlPMzF6T2pFeU9pSmZiWFZzZEdsM2FXUm5aWFFpTzJrNk1UdDlmWDA9IjtzOjE5OiJpbXBvcnRfd2lkZ2V0c19kYXRhIjtzOjA6IiI7czoxMToicmVzZXRfYmFzaWMiO3M6MDoiIjtzOjk6InJlc2V0X2FsbCI7czowOiIiO319">
							     		<?php _e('Lite Demo settings', 'loc_canon'); ?></option>
							     		
							     		<option value="YTo1OntzOjEzOiJjYW5vbl9vcHRpb25zIjthOjE1OntzOjk6InJlc2V0X2FsbCI7czowOiIiO3M6MTE6InJlc2V0X2Jhc2ljIjtzOjA6IiI7czoyMToidXNlX3Jlc3BvbnNpdmVfZGVzaWduIjtzOjc6ImNoZWNrZWQiO3M6MTY6InVzZV9ib3hlZF9kZXNpZ24iO3M6NzoiY2hlY2tlZCI7czoyMDoidXNlX21haW50ZW5hbmNlX21vZGUiO3M6OToidW5jaGVja2VkIjtzOjE3OiJtYWludGVuYW5jZV90aXRsZSI7czozMDoiV2UgYXJlIGRvaW5nIG1haW50ZW5hbmNlIHdvcmshIjtzOjE1OiJtYWludGVuYW5jZV9tc2ciO3M6MTM5OiJEb24ndCB3b3JyeSB3ZSB3aWxsIGJlIGJhY2sgc29vbiAtLSBpbiB0aGUgbWVhbnRpbWUgd2h5IGRvbid0IHlvdSB2aXNpdCA8YSBocmVmPSdodHRwOi8vd3d3Lmdvb2dsZS5jb20nPjxzdHJvbmc+PHU+R29vZ2xlPC91Pjwvc3Ryb25nPjwvYT4uIjtzOjE4OiJzaWRlYmFyc19hbGlnbm1lbnQiO3M6NToicmlnaHQiO3M6ODoiZGV2X21vZGUiO3M6NzoiY2hlY2tlZCI7czoxODoiYXV0b2NvbXBsZXRlX3dvcmRzIjtzOjcyOiJjKyssIGpxdWVyeSwgSSBsaWtlIGpRdWVyeSwgamF2YSwgcGhwLCBjb2xkZnVzaW9uLCBqYXZhc2NyaXB0LCBhc3AsIHJ1YnkiO3M6Mjc6ImhpZGVfdGhlbWVfbWV0YV9kZXNjcmlwdGlvbiI7czo5OiJ1bmNoZWNrZWQiO3M6MTM6ImhpZGVfdGhlbWVfb2ciO3M6OToidW5jaGVja2VkIjtzOjEyOiJmb250ZmFjZV9maXgiO3M6OToidW5jaGVja2VkIjtzOjExOiJmYXZpY29uX3VybCI7czowOiIiO3M6MjE6Imdvb2dsZV9hbmFseXRpY3NfY29kZSI7czowOiIiO31zOjE5OiJjYW5vbl9vcHRpb25zX2ZyYW1lIjthOjU1OntzOjE3OiJoZWFkZXJfcHJlX2xheW91dCI7czozOiJvZmYiO3M6MjQ6ImhlYWRlcl9wcmVfY3VzdG9tX2NlbnRlciI7czozOiJvZmYiO3M6MjI6ImhlYWRlcl9wcmVfY3VzdG9tX2xlZnQiO3M6MTE6ImhlYWRlcl90ZXh0IjtzOjIzOiJoZWFkZXJfcHJlX2N1c3RvbV9yaWdodCI7czo2OiJzb2NpYWwiO3M6MTg6ImhlYWRlcl9tYWluX2xheW91dCI7czoyOToiaGVhZGVyX21haW5fY3VzdG9tX2xlZnRfcmlnaHQiO3M6MjU6ImhlYWRlcl9tYWluX2N1c3RvbV9jZW50ZXIiO3M6NDoibG9nbyI7czoyMzoiaGVhZGVyX21haW5fY3VzdG9tX2xlZnQiO3M6NDoibG9nbyI7czoyNDoiaGVhZGVyX21haW5fY3VzdG9tX3JpZ2h0IjtzOjY6ImJhbm5lciI7czoxODoiaGVhZGVyX3Bvc3RfbGF5b3V0IjtzOjI5OiJoZWFkZXJfcG9zdF9jdXN0b21fbGVmdF9yaWdodCI7czoyNToiaGVhZGVyX3Bvc3RfY3VzdG9tX2NlbnRlciI7czo3OiJwcmltYXJ5IjtzOjIzOiJoZWFkZXJfcG9zdF9jdXN0b21fbGVmdCI7czo3OiJwcmltYXJ5IjtzOjI0OiJoZWFkZXJfcG9zdF9jdXN0b21fcmlnaHQiO3M6Njoic29jaWFsIjtzOjE3OiJmb290ZXJfcHJlX2xheW91dCI7czoyODoiZm9vdGVyX3ByZV9jdXN0b21fbGVmdF9yaWdodCI7czoyNDoiZm9vdGVyX3ByZV9jdXN0b21fY2VudGVyIjtzOjM6Im9mZiI7czoyMjoiZm9vdGVyX3ByZV9jdXN0b21fbGVmdCI7czoxMToiYnJlYWRjcnVtYnMiO3M6MjM6ImZvb3Rlcl9wcmVfY3VzdG9tX3JpZ2h0IjtzOjM6Im9mZiI7czoxODoiZm9vdGVyX21haW5fbGF5b3V0IjtzOjIzOiJibG9ja193aWRnZXRpemVkX2Zvb3RlciI7czoxODoiZm9vdGVyX3Bvc3RfbGF5b3V0IjtzOjI5OiJmb290ZXJfcG9zdF9jdXN0b21fbGVmdF9yaWdodCI7czoyNToiZm9vdGVyX3Bvc3RfY3VzdG9tX2NlbnRlciI7czozOiJvZmYiO3M6MjM6ImZvb3Rlcl9wb3N0X2N1c3RvbV9sZWZ0IjtzOjExOiJmb290ZXJfdGV4dCI7czoyNDoiZm9vdGVyX3Bvc3RfY3VzdG9tX3JpZ2h0IjtzOjY6InNvY2lhbCI7czoyMDoidXNlX3N0aWNreV9wcmVoZWFkZXIiO3M6OToidW5jaGVja2VkIjtzOjE3OiJ1c2Vfc3RpY2t5X2hlYWRlciI7czo5OiJ1bmNoZWNrZWQiO3M6MjE6InVzZV9zdGlja3lfcG9zdGhlYWRlciI7czo3OiJjaGVja2VkIjtzOjIxOiJzdGlja3lfdHVybl9vZmZfd2lkdGgiO3M6MzoiNzY4IjtzOjI1OiJhZGRfc2VhcmNoX2J0bl90b19wcmltYXJ5IjtzOjc6ImNoZWNrZWQiO3M6Mjc6ImFkZF9zZWFyY2hfYnRuX3RvX3NlY29uZGFyeSI7czo5OiJ1bmNoZWNrZWQiO3M6MTg6ImhlYWRlcl9wYWRkaW5nX3RvcCI7czoyOiIyNSI7czoyMToiaGVhZGVyX3BhZGRpbmdfYm90dG9tIjtzOjI6IjI1IjtzOjIwOiJwb3NfbGVmdF9lbGVtZW50X3RvcCI7czoxOiIwIjtzOjIxOiJwb3NfbGVmdF9lbGVtZW50X2xlZnQiO3M6MToiMCI7czoyMToicG9zX3JpZ2h0X2VsZW1lbnRfdG9wIjtzOjI6IjEwIjtzOjIzOiJwb3NfcmlnaHRfZWxlbWVudF9yaWdodCI7czoxOiIwIjtzOjg6ImxvZ29fdXJsIjtzOjA6IiI7czo5OiJsb2dvX3RleHQiO3M6MDoiIjtzOjE0OiJsb2dvX3RleHRfc2l6ZSI7czoyOiI0OCI7czoxNDoibG9nb19tYXhfd2lkdGgiO3M6MzoiMjIzIjtzOjI0OiJoZWFkZXJfaW1nX2hvbWVwYWdlX29ubHkiO3M6OToidW5jaGVja2VkIjtzOjE0OiJoZWFkZXJfaW1nX3VybCI7czo4MDoiaHR0cDovL2xvY2FsaG9zdDo4ODg4LzIwMTUwNDE1LUNvb2tCb29rL3dwLWNvbnRlbnQvdXBsb2Fkcy8yMDE1LzA0L3BhcmFsbGF4MS5qcGciO3M6MTk6ImhlYWRlcl9pbWdfYmdfY29sb3IiO3M6NzoiIzE0MTMxMiI7czoxNzoiaGVhZGVyX2ltZ19oZWlnaHQiO3M6MzoiNDUwIjtzOjI2OiJoZWFkZXJfaW1nX3BhcmFsbGF4X2Ftb3VudCI7czoxOiIwIjtzOjI3OiJoZWFkZXJfaW1nX3BhcmFsbGF4X3lvZmZzZXQiO3M6MToiMCI7czoxNToiaGVhZGVyX2ltZ190ZXh0IjtzOjE3ODoiPGgyPkJhY2tncm91bmQgSGVhZGVyIEltYWdlIFdpdGggUGFyYWxsYXggU2Nyb2xsaW5nPC9oMj4NCjxwIHN0eWxlPSJtYXJnaW4tdG9wOiAtMTBweCIgY2xhc3M9ImxlYWQiPkFsc28gYWRkIHlvdXIgb3duIEhUTUwgYW5kIHNob3J0Y29kZXM8L3A+DQpbYnV0dG9uXUJ1eSBDb29rYm9vayBUb2RheVsvYnV0dG9uXSI7czoyNToiaGVhZGVyX2ltZ190ZXh0X2FsaWdubWVudCI7czo4OiJjZW50ZXJlZCI7czoyNjoiaGVhZGVyX2ltZ190ZXh0X21hcmdpbl90b3AiO3M6MzoiMTcwIjtzOjE4OiJoZWFkZXJfYmFubmVyX2NvZGUiO3M6MTI0OiI8YSBocmVmPScjJz48aW1nIHNyYz0naHR0cDovL2xvY2FsaG9zdDo4ODg4LzIwMTUwNDE1LUNvb2tCb29rL3dwLWNvbnRlbnQvdGhlbWVzL2Nvb2tib29rL2ltZy9hZHMvNDY4eDYwLnBuZycgYWx0PSdBZCcgLz48L2E+IjtzOjExOiJoZWFkZXJfdGV4dCI7czo1MzoiPGVtIGNsYXNzPSJmYSI+74CEPC9lbT4gRWF0IFdlbGwsIEJlIEhhcHB5LCBMb3ZlIEZvb2QiO3M6MTE6ImZvb3Rlcl90ZXh0IjtzOjk3OiLCqSBDb3B5cmlnaHQgQ29va2Jvb2sgMjAxNSBieSA8YSBocmVmPSJodHRwOi8vd3d3LnRoZW1lY2Fub24uY29tIiB0YXJnZXQ9Il9ibGFuayI+VGhlbWUgQ2Fub248L2E+IjtzOjEzOiJzb2NpYWxfaW5fbmV3IjtzOjc6ImNoZWNrZWQiO3M6MTI6InNvY2lhbF9saW5rcyI7YTozOntpOjA7YToyOntpOjA7czoxODoiZmEtZmFjZWJvb2stc3F1YXJlIjtpOjE7czozNToiaHR0cHM6Ly93d3cuZmFjZWJvb2suY29tL3RoZW1lY2Fub24iO31pOjE7YToyOntpOjA7czoxNzoiZmEtdHdpdHRlci1zcXVhcmUiO2k6MTtzOjMwOiJodHRwczovL3R3aXR0ZXIuY29tL1RoZW1lQ2Fub24iO31pOjI7YToyOntpOjA7czoxMzoiZmEtcnNzLXNxdWFyZSI7aToxO3M6NTA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODg4OC8yMDE1MDQxNS1Db29rQm9vay8/ZmVlZD1yc3MyIjt9fXM6MjE6InRvb2xiYXJfc2VhcmNoX2J1dHRvbiI7czo3OiJjaGVja2VkIjtzOjI1OiJjb3VudGRvd25fZGF0ZXRpbWVfc3RyaW5nIjtzOjI2OiJEZWNlbWJlciAzMSwgMjAyMyAyMzo1OTo1OSI7czoyMDoiY291bnRkb3duX2dtdF9vZmZzZXQiO3M6MzoiKzEwIjtzOjIxOiJjb3VudGRvd25fZGVzY3JpcHRpb24iO3M6MTI6Ik5leHQgRXZlbnQ6ICI7fXM6MTg6ImNhbm9uX29wdGlvbnNfcG9zdCI7YTo0Mzp7czoxMToiYmxvZ19sYXlvdXQiO3M6Nzoic2lkZWJhciI7czoxMjoiYmxvZ19zaWRlYmFyIjtzOjMzOiJjYW5vbl9hcmNoaXZlX3NpZGViYXJfd2lkZ2V0X2FyZWEiO3M6MTA6ImJsb2dfc3R5bGUiO3M6NzoibWFzb25yeSI7czoxOToiYmxvZ19leGNlcnB0X2xlbmd0aCI7czozOiI0NTAiO3M6MjA6ImJsb2dfbWFzb25yeV9jb2x1bW5zIjtzOjE6IjEiO3M6MTA6ImNhdF9sYXlvdXQiO3M6Nzoic2lkZWJhciI7czoxMToiY2F0X3NpZGViYXIiO3M6MzM6ImNhbm9uX2FyY2hpdmVfc2lkZWJhcl93aWRnZXRfYXJlYSI7czo5OiJjYXRfc3R5bGUiO3M6NzoiY2xhc3NpYyI7czoxODoiY2F0X2V4Y2VycHRfbGVuZ3RoIjtzOjM6IjMwMCI7czoxOToiY2F0X21hc29ucnlfY29sdW1ucyI7czoxOiIyIjtzOjE0OiJhcmNoaXZlX2xheW91dCI7czo3OiJzaWRlYmFyIjtzOjE1OiJhcmNoaXZlX3NpZGViYXIiO3M6MzM6ImNhbm9uX2FyY2hpdmVfc2lkZWJhcl93aWRnZXRfYXJlYSI7czoxMzoiYXJjaGl2ZV9zdHlsZSI7czo3OiJjbGFzc2ljIjtzOjIyOiJhcmNoaXZlX2V4Y2VycHRfbGVuZ3RoIjtzOjM6IjMwMCI7czoyMzoiYXJjaGl2ZV9tYXNvbnJ5X2NvbHVtbnMiO3M6MToiMiI7czoxODoic2hvd19hcmNoaXZlX3RpdGxlIjtzOjc6ImNoZWNrZWQiO3M6MjA6InNob3dfY2F0X2Rlc2NyaXB0aW9uIjtzOjc6ImNoZWNrZWQiO3M6MjM6InNob3dfYXJjaGl2ZV9hdXRob3JfYm94IjtzOjc6ImNoZWNrZWQiO3M6MTQ6InNob3dfbWV0YV9kYXRlIjtzOjc6ImNoZWNrZWQiO3M6MTg6InNob3dfbWV0YV9jb21tZW50cyI7czo3OiJjaGVja2VkIjtzOjE0OiJzaG93X3Bvc3RfbWV0YSI7czo3OiJjaGVja2VkIjtzOjEzOiJzaG93X3Bvc3RfbmF2IjtzOjc6ImNoZWNrZWQiO3M6MTM6InNob3dfY29tbWVudHMiO3M6NzoiY2hlY2tlZCI7czoxNToic2VhcmNoX2JveF90ZXh0IjtzOjI1OiJXaGF0IGFyZSB5b3UgbG9va2luZyBmb3I/IjtzOjEyOiJzZWFyY2hfcG9zdHMiO3M6NzoiY2hlY2tlZCI7czoxMjoic2VhcmNoX3BhZ2VzIjtzOjc6ImNoZWNrZWQiO3M6MTA6InNlYXJjaF9jcHQiO3M6NzoiY2hlY2tlZCI7czoxNzoic2VhcmNoX2NwdF9zb3VyY2UiO3M6MDoiIjtzOjEwOiI0MDRfbGF5b3V0IjtzOjc6InNpZGViYXIiO3M6MTE6IjQwNF9zaWRlYmFyIjtzOjMzOiJjYW5vbl9hcmNoaXZlX3NpZGViYXJfd2lkZ2V0X2FyZWEiO3M6OToiNDA0X3RpdGxlIjtzOjE0OiJFcnJvciA0MDQgUGFnZSI7czo3OiI0MDRfbXNnIjtzOjgyOiJTb3JyeSwgSXQgc2VlbXMgd2UgY2FuJ3QgZmluZCB3aGF0IHlvdSdyZSBsb29raW5nIGZvci4gUGVyaGFwcyBzZWFyY2hpbmcgY2FuIGhlbHAuIjtzOjExOiJhcmNoaXZlX2FkcyI7YToyOntpOjA7YTo1OntzOjE1OiJhcHBlbmRfdG9fcG9zdHMiO3M6NToiMywgMTAiO3M6NzoiYWRfY29kZSI7czozMTU6IjxhIGhyZWY9IiMiIGNsYXNzPSJhZHMgY29sLTEtMiI+DQo8aW1nIHNyYz0iaHR0cDovL2xvY2FsaG9zdDo4ODg4LzIwMTUwNDE1LUNvb2tCb29rL3dwLWNvbnRlbnQvdGhlbWVzL2Nvb2tib29rL2ltZy9hZHMvNDY4eDYwLnBuZyIgYWx0PSJBZHMiIC8+DQo8L2E+DQogICAJCQkJCQ0KPGEgaHJlZj0iIyIgY2xhc3M9ImFkcyBjb2wtMS0yIGxhc3QiPg0KPGltZyBzcmM9Imh0dHA6Ly9sb2NhbGhvc3Q6ODg4OC8yMDE1MDQxNS1Db29rQm9vay93cC1jb250ZW50L3RoZW1lcy9jb29rYm9vay9pbWcvYWRzLzQ2OHg2MC5wbmciIGFsdD0iQWRzIiAvPg0KPC9hPiI7czoxMzoic2hvd19hZHNfYmxvZyI7czo5OiJ1bmNoZWNrZWQiO3M6MTc6InNob3dfYWRzX2NhdGVnb3J5IjtzOjk6InVuY2hlY2tlZCI7czoxNjoic2hvd19hZHNfYXJjaGl2ZSI7czo5OiJ1bmNoZWNrZWQiO31pOjE7YTo1OntzOjE1OiJhcHBlbmRfdG9fcG9zdHMiO3M6NToiMywgMTAiO3M6NzoiYWRfY29kZSI7czoxNDk6IjxhIGhyZWY9IiMiIGNsYXNzPSJhZHMgY29sLTEtMSI+DQo8aW1nIHNyYz0iaHR0cDovL2xvY2FsaG9zdDo4ODg4LzIwMTUwNDE1LUNvb2tCb29rL3dwLWNvbnRlbnQvdGhlbWVzL2Nvb2tib29rL2ltZy9hZHMvNDY4eDYwLnBuZyIgYWx0PSJBZHMiIC8+DQo8L2E+IjtzOjEzOiJzaG93X2Fkc19ibG9nIjtzOjk6InVuY2hlY2tlZCI7czoxNzoic2hvd19hZHNfY2F0ZWdvcnkiO3M6OToidW5jaGVja2VkIjtzOjE2OiJzaG93X2Fkc19hcmNoaXZlIjtzOjk6InVuY2hlY2tlZCI7fX1zOjIzOiJ1c2Vfd29vY29tbWVyY2Vfc2lkZWJhciI7czo3OiJjaGVja2VkIjtzOjE5OiJ3b29jb21tZXJjZV9zaWRlYmFyIjtzOjE0OiJjYW5vbl9jd2Ffc2hvcCI7czoyMjoidXNlX2J1ZGR5cHJlc3Nfc2lkZWJhciI7czo3OiJjaGVja2VkIjtzOjE4OiJidWRkeXByZXNzX3NpZGViYXIiO3M6MTU6ImNhbm9uX2N3YV9mb3J1bSI7czoxOToidXNlX2JicHJlc3Nfc2lkZWJhciI7czo3OiJjaGVja2VkIjtzOjE1OiJiYnByZXNzX3NpZGViYXIiO3M6MTU6ImNhbm9uX2N3YV9mb3J1bSI7czoxODoidXNlX2V2ZW50c19zaWRlYmFyIjtzOjc6ImNoZWNrZWQiO3M6MTQ6ImV2ZW50c19zaWRlYmFyIjtzOjE2OiJjYW5vbl9jd2FfZXZlbnRzIjtzOjE1OiJzaG93X21ldGFfbGlrZXMiO3M6NzoiY2hlY2tlZCI7czoxNToic2hvd19tZXRhX3ZpZXdzIjtzOjc6ImNoZWNrZWQiO31zOjI0OiJjYW5vbl9vcHRpb25zX2FwcGVhcmFuY2UiO2E6Nzg6e3M6MTU6ImJvZHlfc2tpbl9jbGFzcyI7czo2OiJza2luLTIiO3M6MTM6ImNvbG9yX3BhZ2VfYmciO3M6NzoiIzI3MmYzMyI7czoxMzoiY29sb3JfYm9keV9iZyI7czo3OiIjMWYyNjI5IjtzOjE4OiJjb2xvcl9nZW5lcmFsX3RleHQiO3M6NzoiI2VhZWFlYSI7czoxNToiY29sb3JfYm9keV9saW5rIjtzOjc6IiNlYWVhZWEiO3M6MjE6ImNvbG9yX2JvZHlfbGlua19ob3ZlciI7czo3OiIjYzNhZDcwIjtzOjE5OiJjb2xvcl9ib2R5X2hlYWRpbmdzIjtzOjc6IiNmZmZmZmYiO3M6MjA6ImNvbG9yX2dlbmVyYWxfdGV4dF8yIjtzOjc6IiNhZGFkYWQiO3M6MTU6ImNvbG9yX2xvZ29fdGV4dCI7czo3OiIjZmZmZmZmIjtzOjE2OiJjb2xvcl9wcmVoZWFkX2JnIjtzOjc6IiM0MjRiNTAiO3M6MTM6ImNvbG9yX3ByZWhlYWQiO3M6NzoiI2ZmZmZmZiI7czoxOToiY29sb3JfcHJlaGVhZF9ob3ZlciI7czo3OiIjYzNhZDcwIjtzOjE4OiJjb2xvcl90aGlyZF9wcmVuYXYiO3M6NzoiIzMzM2Q0MyI7czoxMzoiY29sb3JfaGVhZF9iZyI7czo3OiIjMWYyNjI5IjtzOjEwOiJjb2xvcl9oZWFkIjtzOjc6IiNmZmZmZmYiO3M6MTY6ImNvbG9yX2hlYWRfaG92ZXIiO3M6NzoiI2MzYWQ3MCI7czoyMjoiY29sb3JfaGVhZGVyX21lbnVzXzJuZCI7czo3OiIjMTcxZTIwIjtzOjE4OiJjb2xvcl9oZWFkZXJfbWVudXMiO3M6NzoiIzAwMDAwMCI7czoxNzoiY29sb3JfcG9zdGhlYWRfYmciO3M6NzoiIzE3MWUyMCI7czoxNDoiY29sb3JfcG9zdGhlYWQiO3M6NzoiI2ZmZmZmZiI7czoyMDoiY29sb3JfcG9zdGhlYWRfaG92ZXIiO3M6NzoiI2MzYWQ3MCI7czoxOToiY29sb3JfdGhpcmRfcG9zdG5hdiI7czo3OiIjMTQxMzEyIjtzOjE4OiJjb2xvcl9oZWFkZXJfaW1hZ2UiO3M6NzoiI2ZmZmZmZiI7czoxNjoiY29sb3Jfc2lkcl9ibG9jayI7czo3OiIjMjAyNzJiIjtzOjE3OiJjb2xvcl9tZW51X3RleHRfMSI7czo3OiIjZmZmZmZmIjtzOjIwOiJjb2xvcl9ibG9ja19oZWFkaW5ncyI7czo3OiIjMjAyNzJiIjtzOjIyOiJjb2xvcl9ibG9ja19oZWFkaW5nc18yIjtzOjc6IiM0YzU2NWMiO3M6MTc6ImNvbG9yX2ZlYXRfdGV4dF8xIjtzOjc6IiNjM2FkNzAiO3M6MTI6ImNvbG9yX3F1b3RlcyI7czo3OiIjZmZmZmZmIjtzOjE2OiJjb2xvcl93aGl0ZV90ZXh0IjtzOjc6IiNmZmZmZmYiO3M6MTE6ImNvbG9yX2J0bl8xIjtzOjc6IiNjM2FkNzAiO3M6MTc6ImNvbG9yX2J0bl8xX2hvdmVyIjtzOjc6IiM4Mjc0NGUiO3M6MTc6ImNvbG9yX2Jsb2NrX2xpZ2h0IjtzOjc6IiMyZjM4M2MiO3M6MTY6ImNvbG9yX2ZlYXRfdGl0bGUiO3M6NzoiIzE3MWUyMCI7czoxNDoiY29sb3JfYm9yZGVyXzEiO3M6NzoiIzJiMzYzYyI7czoxNDoiY29sb3JfYm9yZGVyXzIiO3M6NzoiIzRjNTY1YyI7czoxNDoiY29sb3JfZm9ybXNfYmciO3M6NzoiIzJmMzgzYyI7czoxNjoiY29sb3JfcHJlZm9vdF9iZyI7czo3OiIjNDI0YjUwIjtzOjEzOiJjb2xvcl9wcmVmb290IjtzOjc6IiNjY2NjY2MiO3M6MTk6ImNvbG9yX3ByZWZvb3RfaG92ZXIiO3M6NzoiI2MzYWQ3MCI7czoxMzoiY29sb3JfZm9vdF9iZyI7czo3OiIjMWIyMTI0IjtzOjEwOiJjb2xvcl9mb290IjtzOjc6IiNmZmZmZmYiO3M6MTY6ImNvbG9yX2Zvb3RfaG92ZXIiO3M6NzoiI2MzYWQ3MCI7czoxMjoiY29sb3JfZm9vdF8yIjtzOjc6IiNmZmZmZmYiO3M6MTQ6ImNvbG9yX2JvcmRlcl8zIjtzOjc6IiMyYjM2M2MiO3M6MTU6ImNvbG9yX2Zvb3RfYmdfMiI7czo3OiIjM2E0NjRjIjtzOjE3OiJjb2xvcl9iYXNlbGluZV9iZyI7czo3OiIjMTExNjE4IjtzOjE0OiJjb2xvcl9iYXNlbGluZSI7czo3OiIjYjZiNmI2IjtzOjIwOiJjb2xvcl9iYXNlbGluZV9ob3ZlciI7czo3OiIjYzNhZDcwIjtzOjEwOiJiZ19pbWdfdXJsIjtzOjA6IiI7czo3OiJiZ19saW5rIjtzOjA6IiI7czo5OiJiZ19yZXBlYXQiO3M6NjoicmVwZWF0IjtzOjEzOiJiZ19hdHRhY2htZW50IjtzOjU6ImZpeGVkIjtzOjk6ImZvbnRfbWFpbiI7YTozOntpOjA7czoxMzoiY2Fub25fZGVmYXVsdCI7aToxO3M6NzoicmVndWxhciI7aToyO3M6NToibGF0aW4iO31zOjEzOiJmb250X2hlYWRpbmdzIjthOjM6e2k6MDtzOjEzOiJjYW5vbl9kZWZhdWx0IjtpOjE7czo3OiJyZWd1bGFyIjtpOjI7czo1OiJsYXRpbiI7fXM6ODoiZm9udF9uYXYiO2E6Mzp7aTowO3M6MTM6ImNhbm9uX2RlZmF1bHQiO2k6MTtzOjc6InJlZ3VsYXIiO2k6MjtzOjU6ImxhdGluIjt9czoxODoiZm9udF9oZWFkaW5nc19tZXRhIjthOjM6e2k6MDtzOjEzOiJjYW5vbl9kZWZhdWx0IjtpOjE7czo3OiJyZWd1bGFyIjtpOjI7czo1OiJsYXRpbiI7fXM6OToiZm9udF9ib2xkIjthOjM6e2k6MDtzOjEzOiJjYW5vbl9kZWZhdWx0IjtpOjE7czo3OiJyZWd1bGFyIjtpOjI7czo1OiJsYXRpbiI7fXM6MTE6ImZvbnRfaXRhbGljIjthOjM6e2k6MDtzOjEzOiJjYW5vbl9kZWZhdWx0IjtpOjE7czo3OiJyZWd1bGFyIjtpOjI7czo1OiJsYXRpbiI7fXM6MTE6ImZvbnRfc3Ryb25nIjthOjM6e2k6MDtzOjEzOiJjYW5vbl9kZWZhdWx0IjtpOjE7czo3OiJyZWd1bGFyIjtpOjI7czo1OiJsYXRpbiI7fXM6OToiZm9udF9sb2dvIjthOjM6e2k6MDtzOjEzOiJjYW5vbl9kZWZhdWx0IjtpOjE7czo3OiJyZWd1bGFyIjtpOjI7czo1OiJsYXRpbiI7fXM6MTQ6ImZvbnRfc2l6ZV9yb290IjtzOjA6IiI7czoyMjoibGlnaHRib3hfb3ZlcmxheV9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjI0OiJsaWdodGJveF9vdmVybGF5X29wYWNpdHkiO3M6MzoiMC43IjtzOjI1OiJhbmltX2ltZ19zbGlkZXJfc2xpZGVzaG93IjtzOjk6InVuY2hlY2tlZCI7czoyMToiYW5pbV9pbWdfc2xpZGVyX2RlbGF5IjtzOjQ6IjUwMDAiO3M6Mjk6ImFuaW1faW1nX3NsaWRlcl9hbmltX2R1cmF0aW9uIjtzOjM6IjgwMCI7czoyNzoiYW5pbV9xdW90ZV9zbGlkZXJfc2xpZGVzaG93IjtzOjk6InVuY2hlY2tlZCI7czoyMzoiYW5pbV9xdW90ZV9zbGlkZXJfZGVsYXkiO3M6NDoiNTAwMCI7czozMToiYW5pbV9xdW90ZV9zbGlkZXJfYW5pbV9kdXJhdGlvbiI7czozOiI4MDAiO3M6MzM6ImxhenlfbG9hZF9vbl9wYWdlYnVpbGRlcl9lbGVtZW50cyI7czo5OiJ1bmNoZWNrZWQiO3M6MjY6ImxhenlfbG9hZF9vbl9hcmNoaXZlX3Bvc3RzIjtzOjk6InVuY2hlY2tlZCI7czoyMDoibGF6eV9sb2FkX29uX3dpZGdldHMiO3M6OToidW5jaGVja2VkIjtzOjE1OiJsYXp5X2xvYWRfYWZ0ZXIiO3M6MzoiMC4zIjtzOjE1OiJsYXp5X2xvYWRfZW50ZXIiO3M6NjoiYm90dG9tIjtzOjE0OiJsYXp5X2xvYWRfbW92ZSI7czoyOiIyNCI7czoxNDoibGF6eV9sb2FkX292ZXIiO3M6NDoiMC41NiI7czoyNToibGF6eV9sb2FkX3ZpZXdwb3J0X2ZhY3RvciI7czozOiIwLjIiO31zOjIyOiJjYW5vbl9vcHRpb25zX2FkdmFuY2VkIjthOjk6e3M6MTk6ImN1c3RvbV93aWRnZXRfYXJlYXMiO2E6MTI6e2k6OTk5OTtzOjA6IiI7aTowO3M6MjA6IkN1c3RvbSBXaWRnZXQgQXJlYSAxIjtpOjE7czoyMDoiQ3VzdG9tIFdpZGdldCBBcmVhIDIiO2k6MjtzOjIwOiJDdXN0b20gV2lkZ2V0IEFyZWEgMyI7aTozO3M6NDoiU2hvcCI7aTo0O3M6NToiRm9ydW0iO2k6NTtzOjY6IkV2ZW50cyI7aTo2O3M6NjoiU29jaWFsIjtpOjc7czo5OiJTdWJzY3JpYmUiO2k6ODtzOjg6IkZhY2Vib29rIjtpOjk7czoxMDoiVGV4dC1CbG9jayI7aToxMDtzOjQ6IlRhYnMiO31zOjE4OiJ1c2VfZmluYWxfY2FsbF9jc3MiO3M6NzoiY2hlY2tlZCI7czoxNDoiZmluYWxfY2FsbF9jc3MiO3M6NTE6Ii5tYWluLWhlYWRlci5yaWdodCAuYWRzew0KICAgIG1hcmdpbi10b3A6IC0xNXB4Ow0KfSI7czoxODoiY2Fub25fb3B0aW9uc19kYXRhIjtzOjA6IiI7czoxMToiaW1wb3J0X2RhdGEiO3M6MDoiIjtzOjE4OiJjYW5vbl93aWRnZXRzX2RhdGEiO3M6MDoiIjtzOjE5OiJpbXBvcnRfd2lkZ2V0c19kYXRhIjtzOjA6IiI7czoxMToicmVzZXRfYmFzaWMiO3M6MDoiIjtzOjk6InJlc2V0X2FsbCI7czowOiIiO319">
							     			<?php _e('Dark Demo settings', 'loc_canon'); ?></option>

									</select> 
								</td>
							</tr>

						</table>


					<!-- 
					--------------------------------------------------------------------------
						IMPORT/EXPORT WIDGETS
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Import/Export Widgets", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Import/Export widgets', 'loc_canon'),
									'content' 				=> array(
										__('Use this section to import/export your widgets.', 'loc_canon'),
										__(' ', 'loc_canon'),
										__('<strong>WARNING</strong>: Existing widgets and widget settings will be lost! ', 'loc_canon'),
										__(' ', 'loc_canon'),
										__('The Widget Areas Manager which is used to create custom widget areas is part of the theme settings so please notice that custom widget areas are imported/exported along with the rest of the theme settings and NOT as part of the widgets import/export function. As widgets can only be imported into custom widget areas that already exist you may want to import your theme settings first to make sure that the required custom widget areas exist when importing your widgets.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> __('Generate widgets data', 'loc_canon'),
									'content' 				=> array(
										__('Clicking this button will generate widgets data. You can copy this data from the widgets data window.', 'loc_canon'),
										__('Clicking the window will select all text.', 'loc_canon'),
										__('Press CTRL+C on your keyboard or right click selected text and select copy.', 'loc_canon'),
										__('Once you have copied the data you can either save it to a text document/file (safest) or simply keep the data in your copy/paste clipboard (not safe).', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> __('Import widgets data', 'loc_canon'),
									'content' 				=> array(
										__('Clicking this button will import your widgets data from the data string supplied in the widgets data window.', 'loc_canon'),
										__('Make sure you paste all of the data into the widgets data textarea/window. If part of the code is altered or left out import will fail.', 'loc_canon'),
										__('Click the "Import widgets data" button.', 'loc_canon'),
										__('Your widgets have now been imported.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> __('Load predefined widgets data', 'loc_canon'),
									'content' 				=> array(
										__('Use this select to load predefined widgets data into the data window.', 'loc_canon'),
										__('Click the "Import widgets data" button.', 'loc_canon'),
										__('The predefined widgets have now been imported.', 'loc_canon'),
									),
								)); 

							?>
						</div>

						<table class='form-table'>

							<tr valign='top'>
								<th scope='row'><?php _e("Widgets data", "loc_canon"); ?></th>
								<td colspan="2">
									<textarea id='canon_widgets_data' class='canon_export_data' name='canon_options_advanced[canon_widgets_data]' rows='5' cols='100'></textarea>
								</td>
							</tr>

							<tr valign='top'>
								<th scope='row'></th>
								<td>
									<input type="hidden" id="import_widgets_data" name="canon_options_advanced[import_widgets_data]" value="">

									<input type="button" class="button button_generate_data" value="Generate widgets data" data-export_data="<?php echo esc_attr($encoded_serialized_widgets_data); ?>" />
									<button id="button_import_widgets_data" name="button_import_widgets_data" class="button-secondary"><?php _e("Import widgets data", "loc_canon"); ?></button>
								</td>
								<td class="float-right">
									<select class="predefined-data-select">
							     		<option value="" selected='selected'><?php _e('Load predefined widgets data...', 'loc_canon'); ?></option> 
							     		
							     		<option value="YToyOntzOjEyOiJ3aWRnZXRfYXJlYXMiO2E6MjA6e3M6MTk6IndwX2luYWN0aXZlX3dpZGdldHMiO2E6MDp7fXM6MzM6ImNhbm9uX2FyY2hpdmVfc2lkZWJhcl93aWRnZXRfYXJlYSI7YTozOntpOjA7czoyMzoiY29va2Jvb2tfc29jaWFsX2xpbmtzLTIiO2k6MTtzOjEyOiJjYXRlZ29yaWVzLTIiO2k6MjtzOjExOiJ0YWdfY2xvdWQtMiI7fXM6MzA6ImNhbm9uX3BhZ2Vfc2lkZWJhcl93aWRnZXRfYXJlYSI7YTowOnt9czoyNjoiY2Fub25fZm9vdGVyX3dpZGdldF9hcmVhXzEiO2E6MTp7aTowO3M6NjoidGV4dC0yIjt9czoyNjoiY2Fub25fZm9vdGVyX3dpZGdldF9hcmVhXzIiO2E6MTp7aTowO3M6MjY6ImNvb2tib29rX3ZjX3Bvc3RzX2xpc3RlZC0yIjt9czoyNjoiY2Fub25fZm9vdGVyX3dpZGdldF9hcmVhXzMiO2E6MTp7aTowO3M6MTg6ImNvb2tib29rX3R3aXR0ZXItMiI7fXM6MjY6ImNhbm9uX2Zvb3Rlcl93aWRnZXRfYXJlYV80IjthOjE6e2k6MDtzOjIxOiJjb29rYm9va19tb3JlX3Bvc3RzLTIiO31zOjI2OiJjYW5vbl9mb290ZXJfd2lkZ2V0X2FyZWFfNSI7YTowOnt9czozMDoiY2Fub25fY3dhX2N1c3RvbS13aWRnZXQtYXJlYS0xIjthOjA6e31zOjMwOiJjYW5vbl9jd2FfY3VzdG9tLXdpZGdldC1hcmVhLTIiO2E6MDp7fXM6MzA6ImNhbm9uX2N3YV9jdXN0b20td2lkZ2V0LWFyZWEtMyI7YTowOnt9czoxNDoiY2Fub25fY3dhX3Nob3AiO2E6Mzp7aTowO3M6MjU6Indvb2NvbW1lcmNlX3dpZGdldF9jYXJ0LTIiO2k6MTtzOjI2OiJ3b29jb21tZXJjZV9wcmljZV9maWx0ZXItMiI7aToyO3M6MzI6Indvb2NvbW1lcmNlX3RvcF9yYXRlZF9wcm9kdWN0cy0yIjt9czoxNToiY2Fub25fY3dhX2ZvcnVtIjthOjM6e2k6MDtzOjE4OiJiYnBfbG9naW5fd2lkZ2V0LTIiO2k6MTtzOjE5OiJiYnBfZm9ydW1zX3dpZGdldC0yIjtpOjI7czoxODoiYmJwX3N0YXRzX3dpZGdldC0yIjt9czoxNjoiY2Fub25fY3dhX2V2ZW50cyI7YToyOntpOjA7czoyNjoidHJpYmUtZXZlbnRzLWxpc3Qtd2lkZ2V0LTIiO2k6MTtzOjY6InRleHQtMyI7fXM6MTY6ImNhbm9uX2N3YV9zb2NpYWwiO2E6MTp7aTowO3M6MjM6ImNvb2tib29rX3NvY2lhbF9saW5rcy0zIjt9czoxOToiY2Fub25fY3dhX3N1YnNjcmliZSI7YToxOntpOjA7czoxNDoibWM0d3Bfd2lkZ2V0LTIiO31zOjE4OiJjYW5vbl9jd2FfZmFjZWJvb2siO2E6MTp7aTowO3M6MjY6IndpZGdldF9jb29rYm9va19mYWNlYm9vay0yIjt9czoxOToiY2Fub25fY3dhX3RleHRibG9jayI7YToxOntpOjA7czo2OiJ0ZXh0LTQiO31zOjE0OiJjYW5vbl9jd2FfdGFicyI7YToxOntpOjA7czoxMToidGFnX2Nsb3VkLTMiO31zOjEzOiJhcnJheV92ZXJzaW9uIjtpOjM7fXM6MTQ6ImFjdGl2ZV93aWRnZXRzIjthOjE2OntzOjIxOiJjb29rYm9va19zb2NpYWxfbGlua3MiO2E6Mzp7aToyO2E6NDp7czoxMjoid2lkZ2V0X3RpdGxlIjtzOjk6IkZvbGxvdyBVcyI7czoxMzoiZGlzcGxheV9zdHlsZSI7czo3OiJyb3VuZGVkIjtzOjExOiJvcGVuX2luX25ldyI7czo3OiJjaGVja2VkIjtzOjEyOiJzb2NpYWxfbGlua3MiO2E6NTp7aTowO2E6Mjp7aTowO3M6MTE6ImZhLWZhY2Vib29rIjtpOjE7czozNToiaHR0cHM6Ly93d3cuZmFjZWJvb2suY29tL3RoZW1lY2Fub24iO31pOjE7YToyOntpOjA7czoxMDoiZmEtdHdpdHRlciI7aToxO3M6MzA6Imh0dHBzOi8vdHdpdHRlci5jb20vVGhlbWVDYW5vbiI7fWk6MjthOjI6e2k6MDtzOjExOiJmYS1kcmliYmJsZSI7aToxO3M6MzA6Imh0dHBzOi8vZHJpYmJibGUuY29tL2hpcmVrZW5ueSI7fWk6MzthOjI6e2k6MDtzOjEwOiJmYS1iZWhhbmNlIjtpOjE7czozNDoiaHR0cHM6Ly93d3cuYmVoYW5jZS5uZXQvdGhlbWVjYW5vbiI7fWk6NDthOjI6e2k6MDtzOjY6ImZhLXJzcyI7aToxO3M6NTA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODg4OC8yMDE1MDQxNS1Db29rQm9vay8/ZmVlZD1yc3MyIjt9fX1pOjM7YTo0OntzOjEyOiJ3aWRnZXRfdGl0bGUiO3M6OToiRm9sbG93IFVzIjtzOjEzOiJkaXNwbGF5X3N0eWxlIjtzOjc6InJvdW5kZWQiO3M6MTE6Im9wZW5faW5fbmV3IjtzOjc6ImNoZWNrZWQiO3M6MTI6InNvY2lhbF9saW5rcyI7YTo1OntpOjA7YToyOntpOjA7czoxMToiZmEtZmFjZWJvb2siO2k6MTtzOjM1OiJodHRwczovL3d3dy5mYWNlYm9vay5jb20vdGhlbWVjYW5vbiI7fWk6MTthOjI6e2k6MDtzOjEwOiJmYS10d2l0dGVyIjtpOjE7czozMDoiaHR0cHM6Ly90d2l0dGVyLmNvbS9UaGVtZUNhbm9uIjt9aToyO2E6Mjp7aTowO3M6MTE6ImZhLWRyaWJiYmxlIjtpOjE7czozMDoiaHR0cHM6Ly9kcmliYmJsZS5jb20vaGlyZWtlbm55Ijt9aTozO2E6Mjp7aTowO3M6MTA6ImZhLWJlaGFuY2UiO2k6MTtzOjM0OiJodHRwczovL3d3dy5iZWhhbmNlLm5ldC90aGVtZWNhbm9uIjt9aTo0O2E6Mjp7aTowO3M6NjoiZmEtcnNzIjtpOjE7czo0NToiaHR0cDovL2xvY2FsaG9zdDo4ODg4LzIwMTUwNDE1LUNvb2tCb29rL2ZlZWQvIjt9fX1zOjEyOiJfbXVsdGl3aWRnZXQiO2k6MTt9czoxMDoiY2F0ZWdvcmllcyI7YToyOntpOjI7YTo0OntzOjU6InRpdGxlIjtzOjE4OiJCcm93c2UgQnkgQ2F0ZWdvcnkiO3M6NToiY291bnQiO2k6MTtzOjEyOiJoaWVyYXJjaGljYWwiO2k6MDtzOjg6ImRyb3Bkb3duIjtpOjA7fXM6MTI6Il9tdWx0aXdpZGdldCI7aToxO31zOjk6InRhZ19jbG91ZCI7YTozOntpOjI7YToyOntzOjU6InRpdGxlIjtzOjIwOiJCcm93c2UgQnkgSW5ncmVkaWVudCI7czo4OiJ0YXhvbm9teSI7czo4OiJwb3N0X3RhZyI7fWk6MzthOjI6e3M6NToidGl0bGUiO3M6MjA6IkJyb3dzZSBCeSBJbmdyZWRpZW50IjtzOjg6InRheG9ub215IjtzOjg6InBvc3RfdGFnIjt9czoxMjoiX211bHRpd2lkZ2V0IjtpOjE7fXM6NDoidGV4dCI7YTo0OntpOjI7YTozOntzOjU6InRpdGxlIjtzOjE0OiJBYm91dCBDb29rQm9vayI7czo0OiJ0ZXh0IjtzOjMxODoiPHN0cm9uZz5DcmFzIG1hdHRpcyBjb25zZWN0ZXR1ciBwdXJ1cyBzaXQgYW1ldCBmZXJtZW50dW0uIEFlbmVhbiBsYWNpbmlhIGJpYmVuZHVtIG51bGxhLjwvc3Ryb25nPg0KDQpWZXN0aWJ1bHVtIGlkIGxpZ3VsYSBwb3J0YSBmZWxpcyBldWlzbW9kIHNlbXBlci4gRXRpYW0gcG9ydGEgc2VtIG1hbGVzdWFkYSBtYWduYSBtb2xsaXMgZXVpc21vZC4gRG9uZWMgaWQgZWxpdCBub24gbWkgcG9ydGEgZ3JhdmlkYSBhdCBlZ2V0IG1ldHVzLiBWaXZhbXVzIHNhZ2l0dGlzIGxhY3VzIHZlbCBhdWd1ZSBsYW9yZWV0IHJ1dHJ1bSBmYXVjaWJ1cyBkb2xvciBhdWN0b3IuIjtzOjY6ImZpbHRlciI7YjoxO31pOjM7YTozOntzOjU6InRpdGxlIjtzOjE0OiJRdWljayBRdWVzdGlvbiI7czo0OiJ0ZXh0IjtzOjQ5OiJbY29udGFjdC1mb3JtLTcgaWQ9IjEwNjkiIHRpdGxlPSJRdWljayBRdWVzdGlvbiJdIjtzOjY6ImZpbHRlciI7YjowO31pOjQ7YTozOntzOjU6InRpdGxlIjtzOjE0OiJBYm91dCBDb29rQm9vayI7czo0OiJ0ZXh0IjtzOjIwMzoiPGltZyBzcmM9Imh0dHA6Ly9sb2NhbGhvc3Q6ODg4OC8yMDE1MDQxNS1Db29rQm9vay93cC1jb250ZW50L3VwbG9hZHMvMjAxNS8wNC9tYWNhcm9ucy5qcGciPg0KDQpJbnRlZ2VyIHBvc3VlcmUgZXJhdCBhIGFudGUgdmVuZW5hdGlzIGRhcGlidXMgcG9zdWVyZSB2ZWxpdCBhbGlxdWV0LiBDdW0gc29jaWlzIG5hdG9xdWUgcGVuYXRpYnVzIGV0IG1hZ25pcy4iO3M6NjoiZmlsdGVyIjtiOjE7fXM6MTI6Il9tdWx0aXdpZGdldCI7aToxO31zOjI0OiJjb29rYm9va192Y19wb3N0c19saXN0ZWQiO2E6Mjp7aToyO2E6Njp7czoxMjoid2lkZ2V0X3RpdGxlIjtzOjEyOiJMYXRlc3QgcG9zdHMiO3M6NDoic2hvdyI7czoxMjoibGF0ZXN0X3Bvc3RzIjtzOjY6Im9mZnNldCI7czoxOiIxIjtzOjE0OiJudW1fcG9zdHNfc2hvdyI7czoxOiIzIjtzOjQ6Im1ldGEiO3M6NDoiZGF0ZSI7czoxMToiaGlkZV9yYXRpbmciO3M6OToidW5jaGVja2VkIjt9czoxMjoiX211bHRpd2lkZ2V0IjtpOjE7fXM6MTY6ImNvb2tib29rX3R3aXR0ZXIiO2E6Mjp7aToyO2E6NDp7czoxMjoid2lkZ2V0X3RpdGxlIjtzOjEzOiJMYXRlc3QgdHdlZXRzIjtzOjE5OiJ0d2l0dGVyX3dpZGdldF9jb2RlIjtzOjQzMToiIDxhIGNsYXNzPSJ0d2l0dGVyLXRpbWVsaW5lIiBocmVmPSJodHRwczovL3R3aXR0ZXIuY29tL21ha2VsZW1vbmFkZWNvIiBkYXRhLXdpZGdldC1pZD0iMzM0NjMyOTMzMDA2NjU1NDg4Ij5Ud2VldHMgYnkgQG1ha2VsZW1vbmFkZWNvPC9hPiA8c2NyaXB0PiFmdW5jdGlvbihkLHMsaWQpe3ZhciBqcyxmanM9ZC5nZXRFbGVtZW50c0J5VGFnTmFtZShzKVswXSxwPS9eaHR0cDovLnRlc3QoZC5sb2NhdGlvbik/J2h0dHAnOidodHRwcyc7aWYoIWQuZ2V0RWxlbWVudEJ5SWQoaWQpKXtqcz1kLmNyZWF0ZUVsZW1lbnQocyk7anMuaWQ9aWQ7anMuc3JjPXArIjovL3BsYXRmb3JtLnR3aXR0ZXIuY29tL3dpZGdldHMuanMiO2Zqcy5wYXJlbnROb2RlLmluc2VydEJlZm9yZShqcyxmanMpO319KGRvY3VtZW50LCJzY3JpcHQiLCJ0d2l0dGVyLXdqcyIpOzwvc2NyaXB0PiAiO3M6MTY6InVzZV90aGVtZV9kZXNpZ24iO3M6NzoiY2hlY2tlZCI7czoxODoidHdpdHRlcl9udW1fdHdlZXRzIjtzOjE6IjIiO31zOjEyOiJfbXVsdGl3aWRnZXQiO2k6MTt9czoxOToiY29va2Jvb2tfbW9yZV9wb3N0cyI7YToyOntpOjI7YTo1OntzOjEyOiJ3aWRnZXRfdGl0bGUiO3M6MTE6IkxhdGVzdCBQaWNzIjtzOjEwOiJwb3N0c19mcm9tIjtzOjEyOiJsYXRlc3RfcG9zdHMiO3M6MTM6ImRpc3BsYXlfc3R5bGUiO3M6MTg6ImltYWdlc190b19saWdodGJveCI7czo5OiJudW1fcG9zdHMiO3M6MToiNiI7czoxMToibnVtX2NvbHVtbnMiO3M6MToiMiI7fXM6MTI6Il9tdWx0aXdpZGdldCI7aToxO31zOjIzOiJ3b29jb21tZXJjZV93aWRnZXRfY2FydCI7YToyOntpOjI7YToyOntzOjU6InRpdGxlIjtzOjk6IllvdXIgQ2FydCI7czoxMzoiaGlkZV9pZl9lbXB0eSI7aTowO31zOjEyOiJfbXVsdGl3aWRnZXQiO2k6MTt9czoyNDoid29vY29tbWVyY2VfcHJpY2VfZmlsdGVyIjthOjI6e2k6MjthOjE6e3M6NToidGl0bGUiO3M6MTU6IkZpbHRlciBieSBwcmljZSI7fXM6MTI6Il9tdWx0aXdpZGdldCI7aToxO31zOjMwOiJ3b29jb21tZXJjZV90b3BfcmF0ZWRfcHJvZHVjdHMiO2E6Mjp7aToyO2E6Mjp7czo1OiJ0aXRsZSI7czoxODoiVG9wIFJhdGVkIFByb2R1Y3RzIjtzOjY6Im51bWJlciI7czoxOiIzIjt9czoxMjoiX211bHRpd2lkZ2V0IjtpOjE7fXM6MTY6ImJicF9sb2dpbl93aWRnZXQiO2E6Mjp7aToyO2E6Mzp7czo1OiJ0aXRsZSI7czo1OiJMb2dpbiI7czo4OiJyZWdpc3RlciI7czowOiIiO3M6ODoibG9zdHBhc3MiO3M6MDoiIjt9czoxMjoiX211bHRpd2lkZ2V0IjtpOjE7fXM6MTc6ImJicF9mb3J1bXNfd2lkZ2V0IjthOjI6e2k6MjthOjI6e3M6NToidGl0bGUiO3M6NjoiRm9ydW1zIjtzOjEyOiJwYXJlbnRfZm9ydW0iO3M6MToiMCI7fXM6MTI6Il9tdWx0aXdpZGdldCI7aToxO31zOjE2OiJiYnBfc3RhdHNfd2lkZ2V0IjthOjI6e2k6MjthOjE6e3M6NToidGl0bGUiO3M6MTY6IkZvcnVtIFN0YXRpc3RpY3MiO31zOjEyOiJfbXVsdGl3aWRnZXQiO2k6MTt9czoyNDoidHJpYmUtZXZlbnRzLWxpc3Qtd2lkZ2V0IjthOjI6e2k6MjthOjM6e3M6NToidGl0bGUiO3M6MTU6IlVwY29taW5nIEV2ZW50cyI7czo1OiJsaW1pdCI7czoxOiI1IjtzOjE4OiJub191cGNvbWluZ19ldmVudHMiO047fXM6MTI6Il9tdWx0aXdpZGdldCI7aToxO31zOjEyOiJtYzR3cF93aWRnZXQiO2E6Mjp7aToyO2E6MTp7czo1OiJ0aXRsZSI7czoxODoiR2V0IE91ciBOZXdzbGV0dGVyIjt9czoxMjoiX211bHRpd2lkZ2V0IjtpOjE7fXM6MjQ6IndpZGdldF9jb29rYm9va19mYWNlYm9vayI7YToyOntpOjI7YTo4OntzOjEyOiJ3aWRnZXRfdGl0bGUiO3M6MTk6Ikxpa2UgVXMgT24gRmFjZWJvb2siO3M6NzoiZmJfcGFnZSI7czozNToiaHR0cHM6Ly93d3cuZmFjZWJvb2suY29tL3RoZW1lY2Fub24iO3M6ODoiZmJfd2lkdGgiO3M6MzoiMzIwIjtzOjg6ImZiX3N0eWxlIjtzOjU6ImxpZ2h0IjtzOjk6ImZiX2hlYWRlciI7czo3OiJjaGVja2VkIjtzOjc6ImZiX3dhbGwiO3M6OToidW5jaGVja2VkIjtzOjg6ImZiX2ZhY2VzIjtzOjc6ImNoZWNrZWQiO3M6OToiZmJfYm9yZGVyIjtzOjc6ImNoZWNrZWQiO31zOjEyOiJfbXVsdGl3aWRnZXQiO2k6MTt9fX0=">
							     		<?php _e('Lite Demo widgets', 'loc_canon'); ?></option>

									</select> 
								</td>

							</tr>

						</table>



					<!-- BOTTOM BUTTONS -->

					<br><br>
					
					<div class="save_submit"><?php submit_button(); ?></div>

					<input type="hidden" id="reset_basic" name="canon_options_advanced[reset_basic]" value="">
					<button id="reset_basic_button" class="button-primary reset_button"><?php _e("Reset basic settings ..", "loc_canon"); ?></button>

					<input type="hidden" id="reset_all" name="canon_options_advanced[reset_all]" value="">
					<button id="reset_all_button" class="button-primary reset_button"><?php _e("Reset all settings ..", "loc_canon"); ?></button>

				</form>
			</div> 
			<!-- end table container -->	

	
		</div>

	</div>

