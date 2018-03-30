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

			//MAKE SUPERRAY AND ENCODE
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

			//RESET BASIC
			if ($canon_options_advanced['reset_basic'] == 'RESET') {
				delete_option('canon_options');
				delete_option('canon_options_frame');
				delete_option('canon_options_post');
				delete_option('canon_options_appearance');

				// clear reset_basic var
				$canon_options_advanced['reset_basic'] = "";
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


				// output response
				echo "<script>alert('All theme settings have been reset!'); window.location.reload();</script>";
			}



			// remove template + remove duplicate custom widget areas and rearrange keys
			if (isset($canon_options_advanced['custom_widget_areas'][9999])) { unset($canon_options_advanced['custom_widget_areas'][9999]); }
            $canon_options_advanced['custom_widget_areas'] = array_values($canon_options_advanced['custom_widget_areas']);

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
					--------------------------------------------------------------------------
						CUSTOM WIDGET AREAS (CWA)
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Widget Areas Manager", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='help'>
							<?php
								
								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Widget Areas Manager', 'loc_canon'),
									'content' 				=> array(
										__('Here you can create new custom widget areas. Give each widget area a unique name.', 'loc_canon'),
										__('You can drag and drop to decide the order of which the widget areas will display in the widgets section.', 'loc_canon'),
										__('To add widgets to your custom widget areas go to <i>WordPress Appearance > Widgets</i>.', 'loc_canon'),
										__('To display your custom widget areas go to Pagebuilder and add a Widgets block to one of your pages.', 'loc_canon'),
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
													<input class='widefat cwa_option' type='text' name='canon_options_advanced[custom_widget_areas][<?php echo $i; ?>][name]' value="<?php if (isset($canon_options_advanced['custom_widget_areas'][$i]['name'])) echo htmlspecialchars($canon_options_advanced['custom_widget_areas'][$i]['name']); ?>">
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
													<input class='widefat cwa_option' type='text' name='canon_options_advanced[custom_widget_areas][<?php echo $i; ?>][name]' value="<?php if (isset($canon_options_advanced['custom_widget_areas'][$i]['name'])) echo htmlspecialchars($canon_options_advanced['custom_widget_areas'][$i]['name']); ?>">
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

						<div class='help'>

							<?php
								
								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Final call CSS', 'loc_canon'),
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
						IMPORT/EXPORT
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Import/Export Settings", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Import/Export settings', 'loc_canon'),
									'content' 				=> array(
										__('Use this section to import/export your settings.', 'loc_canon'),
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

							?>
						</div>

						<table class='form-table'>

							<tr valign='top'>
								<th scope='row'><?php _e("Settings data", "loc_canon"); ?></th>
								<td>
									<textarea id='canon_options_data' name='canon_options_advanced[canon_options_data]' rows='5' cols='100'></textarea>
								</td>
							</tr>

							<tr valign='top'>
								<th scope='row'></th>
								<td>
									<input type="hidden" id="import_data" name="canon_options_advanced[import_data]" value="">

									<input type="button" id="button_generate_data" class="button" value="Generate settings data" data-options_data="<?php echo $encoded_serialized_options_data; ?>" />
									<button id="button_import_data" name="button_import_data" class="button-secondary"><?php _e("Import settings data", "loc_canon"); ?></button>
								</td>
							</tr>

						</table>

					<br><br>
					
					<div class="save_submit"><?php submit_button(); ?></div>

					<input type="hidden" id="reset_basic" name="canon_options_advanced[reset_basic]" value="">
					<button id="reset_basic_button" class="button-primary reset_button"><?php _e("Reset basic settings ..", "loc_canon"); ?></button>

					<input type="hidden" id="reset_all" name="canon_options_advanced[reset_all]" value="">
					<button id="reset_all_button" class="button-primary reset_button"><?php _e("Reset all settings ..", "loc_canon"); ?></button>

				</form>
			</div> <!-- end table container -->	

	
		</div>

	</div>

