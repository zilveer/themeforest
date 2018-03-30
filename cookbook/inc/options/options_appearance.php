	<div class="wrap">

		<div id="icon-themes" class="icon32"></div>

		<h2><?php printf( "%s %s - %s", esc_attr(wp_get_theme()->Name), esc_attr(__("Settings", "loc_canon")), esc_attr(__("Appearance", "loc_canon")) ); ?></h2>

		<?php 
			//delete_option('canon_options_appearance');
			$canon_options_appearance = get_option('canon_options_appearance'); 

			// var_dump($canon_options_appearance);

		?>

		<br>

		<div class="options_wrapper canon-options">
		
			<div class="table_container">

				<form method="post" action="options.php" enctype="multipart/form-data">
					<?php settings_fields('group_canon_options_appearance'); ?>				<!-- very important to add these two functions as they mediate what wordpress generates automatically from the functions.php -->
					<?php do_settings_sections('handle_canon_options_appearance'); ?>		

					<?php submit_button(); ?>
					
					<!-- 

						INDEX

						SKINS
						COLOR SETTINGS
						BACKGROUND
						GOOGLE WEBFONTS
						RELATIVE FONT SIZE
						LIGHTBOX SETTINGS
						ANIMATION: IMG SLIDERS
						ANIMATION: QUOTE SLIDERS
						ANIMATION: LAZY LOAD EFFECT

					-->


					<!-- 
					--------------------------------------------------------------------------
						SKINS
				    -------------------------------------------------------------------------- 
					-->


						<h3><?php _e("Skins", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>

							<?php
								
								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Skins', 'loc_canon'),
									'content' 				=> array(
										__('Click a skin-button to change the colour-scheme of the whole theme.', 'loc_canon'),
									),
								)); 

							?>			

						</div>

						<table class='form-table' id="skins">
							<?php
								
								fw_option(array(
									'type'					=> 'hidden',
									'slug' 					=> 'body_skin_class',
									'options_name'			=> 'canon_options_appearance',
								)); 
							
							?>
							<tr valign='top'>
								<td>
									<!-- SKIN OPTION 1 -->
									<img src="<?php echo get_template_directory_uri() ?>/img/skin_btn_1.png" alt="" 

										data-body_skin_class					="skin-1"
										
										data-color_page_bg						="#f1f1f1"
										data-color_body_bg						="#ffffff"
										data-color_general_text					="#222222"
										data-color_body_link					="#222222"
										data-color_body_link_hover				="#c3ad70"
										data-color_body_headings				="#222222"
										data-color_general_text_2				="#adadad"
										data-color_logo_text					="#222222"
										data-color_prehead_bg					="#4c565c"
										data-color_prehead						="#ffffff"
										data-color_prehead_hover				="#c3ad70"
										data-color_third_prenav					="#333d43"
										data-color_head_bg						="#ffffff"
										data-color_head							="#222222"
										data-color_head_hover					="#c3ad70"
										data-color_header_menus_2nd				="#fafafa"
										data-color_header_menus					="#f1f1f1"
										data-color_posthead_bg					="#1f272a"
										data-color_posthead						="#ffffff"
										data-color_posthead_hover				="#c3ad70"
										data-color_third_postnav				="#141312"
										data-color_header_image					="#ffffff"
										data-color_sidr_block					="#20272b"
										data-color_menu_text_1					="#ffffff"
										data-color_block_headings				="#20272b"
										data-color_block_headings_2				="#4c565c"
										data-color_feat_text_1					="#c3ad70"
										data-color_quotes						="#555f64"
										data-color_white_text					="#ffffff"
										data-color_btn_1						="#c3ad70"
										data-color_btn_1_hover					="#20272b"
										data-color_block_light					="#f6f6f6"
										data-color_feat_title					="#ffffff"
										data-color_border_1						="#2b363c"
										data-color_border_2						="#eaeaea"
										data-color_forms_bg						="#f4f4f4"
										data-color_prefoot_bg					="#eaeaea"
										data-color_prefoot						="#28292c"
										data-color_prefoot_hover				="#c3ad70"
										data-color_foot_bg						="#272f33"
										data-color_foot							="#ffffff"
										data-color_foot_hover					="#c3ad70"
										data-color_foot_2						="#ffffff"
										data-color_border_3						="#2b363c"
										data-color_foot_bg_2					="#3a464c"
										data-color_baseline_bg					="#171e20"
										data-color_baseline						="#b6b6b6"
										data-color_baseline_hover				="#c3ad70"
										
									/> 
									<!-- END SKIN OPTION 1 -->
									
									
									<!-- SKIN OPTION 1 -->
									<img src="<?php echo get_template_directory_uri() ?>/img/skin_btn_2.png" alt="" 

										data-body_skin_class					="skin-2"
										
										data-color_page_bg						="#272f33"
										data-color_body_bg						="#1f2629"
										data-color_general_text					="#eaeaea"
										data-color_body_link					="#eaeaea"
										data-color_body_link_hover				="#c3ad70"
										data-color_body_headings				="#ffffff"
										data-color_general_text_2				="#adadad"
										data-color_logo_text					="#ffffff"
										data-color_prehead_bg					="#424b50"
										data-color_prehead						="#ffffff"
										data-color_prehead_hover				="#c3ad70"
										data-color_third_prenav					="#333d43"
										data-color_head_bg						="#1f2629"
										data-color_head							="#ffffff"
										data-color_head_hover					="#c3ad70"
										data-color_header_menus_2nd				="#171e20"
										data-color_header_menus					="#000000"
										data-color_posthead_bg					="#171e20"
										data-color_posthead						="#ffffff"
										data-color_posthead_hover				="#c3ad70"
										data-color_third_postnav				="#141312"
										data-color_sidr_block					="#20272b"
										data-color_menu_text_1					="#ffffff"
										data-color_block_headings				="#20272b"
										data-color_block_headings_2				="#4c565c"
										data-color_feat_text_1					="#c3ad70"
										data-color_quotes						="#ffffff"
										data-color_white_text					="#ffffff"
										data-color_btn_1						="#c3ad70"
										data-color_btn_1_hover					="#82744e"
										data-color_block_light					="#2f383c"
										data-color_feat_title					="#171e20"
										data-color_border_1						="#2b363c"
										data-color_border_2						="#4c565c"
										data-color_forms_bg						="#2f383c"
										data-color_prefoot_bg					="#424b50"
										data-color_prefoot						="#cccccc"
										data-color_prefoot_hover				="#c3ad70"
										data-color_foot_bg						="#1b2124"
										data-color_foot							="#ffffff"
										data-color_foot_hover					="#c3ad70"
										data-color_foot_2						="#ffffff"
										data-color_border_3						="#2b363c"
										data-color_foot_bg_2					="#3a464c"
										data-color_baseline_bg					="#111618"
										data-color_baseline						="#b6b6b6"
										data-color_baseline_hover				="#c3ad70"
										
									/> 
									<!-- END SKIN OPTION 1 -->
									

									
								</td>
							</tr>
						</table>



					<!-- 
					--------------------------------------------------------------------------
						COLOR SETTINGS
				    -------------------------------------------------------------------------- 
					-->


						<h3><?php _e("Color settings", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>

							<?php
								
								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Colors', 'loc_canon'),
									'content' 				=> array(
										__('Change the colours of the theme. Remember to save your changes.', 'loc_canon'),
									),
								)); 

							?>			

						</div>

						<table class='form-table'>

						<?php
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Page Background', 'loc_canon'),
								'slug' 					=> 'color_page_bg',
								'options_name'			=> 'canon_options_appearance',
							)); 
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Body Background', 'loc_canon'),
								'slug' 					=> 'color_body_bg',
								'options_name'			=> 'canon_options_appearance',
							)); 
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('General Body Text', 'loc_canon'),
								'slug' 					=> 'color_general_text',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Body Text Link', 'loc_canon'),
								'slug' 					=> 'color_body_link',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Body Text Link Hover', 'loc_canon'),
								'slug' 					=> 'color_body_link_hover',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Main Headings', 'loc_canon'),
								'slug' 					=> 'color_body_headings',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Secondary Body Text', 'loc_canon'),
								'slug' 					=> 'color_general_text_2',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Logo As Text', 'loc_canon'),
								'slug' 					=> 'color_logo_text',
								'options_name'			=> 'canon_options_appearance',
							));
							
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Pre Header Background', 'loc_canon'),
								'slug' 					=> 'color_prehead_bg',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Pre Header Text', 'loc_canon'),
								'slug' 					=> 'color_prehead',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Pre Header Text Hover', 'loc_canon'),
								'slug' 					=> 'color_prehead_hover',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Pre Header Tertiary Menu', 'loc_canon'),
								'slug' 					=> 'color_third_prenav',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Header Background', 'loc_canon'),
								'slug' 					=> 'color_head_bg',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Header Text', 'loc_canon'),
								'slug' 					=> 'color_head',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Header Text Hover', 'loc_canon'),
								'slug' 					=> 'color_head_hover',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Header 2nd Menu Background', 'loc_canon'),
								'slug' 					=> 'color_header_menus_2nd',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Header 3rd Menu Background', 'loc_canon'),
								'slug' 					=> 'color_header_menus',
								'options_name'			=> 'canon_options_appearance',
							));
							
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Post Header Background', 'loc_canon'),
								'slug' 					=> 'color_posthead_bg',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Post Header Text', 'loc_canon'),
								'slug' 					=> 'color_posthead',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Post Header Text Hover', 'loc_canon'),
								'slug' 					=> 'color_posthead_hover',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Post Header Tertiary Menu', 'loc_canon'),
								'slug' 					=> 'color_third_postnav',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Header image Text Color', 'loc_canon'),
								'slug' 					=> 'color_header_image',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Sidr Block Background', 'loc_canon'),
								'slug' 					=> 'color_sidr_block',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Sidr Menu Text', 'loc_canon'),
								'slug' 					=> 'color_menu_text_1',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Block Headings Background', 'loc_canon'),
								'slug' 					=> 'color_block_headings',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('2nd Block Headings Background', 'loc_canon'),
								'slug' 					=> 'color_block_headings_2',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Feature Text 1', 'loc_canon'),
								'slug' 					=> 'color_feat_text_1',
								'options_name'			=> 'canon_options_appearance',
							)); 
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Quotes Text', 'loc_canon'),
								'slug' 					=> 'color_quotes',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('White Text', 'loc_canon'),
								'slug' 					=> 'color_white_text',
								'options_name'			=> 'canon_options_appearance',
							));                 
							
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Button Color 1', 'loc_canon'),
								'slug' 					=> 'color_btn_1',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Button Color 1 Hover', 'loc_canon'),
								'slug' 					=> 'color_btn_1_hover',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Light Blocks Background', 'loc_canon'),
								'slug' 					=> 'color_block_light',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Feature Title Background', 'loc_canon'),
								'slug' 					=> 'color_feat_title',
								'options_name'			=> 'canon_options_appearance',
							)); 
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Menu Border Color', 'loc_canon'),
								'slug' 					=> 'color_border_1',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Main Border Color', 'loc_canon'),
								'slug' 					=> 'color_border_2',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Form Elements Background', 'loc_canon'),
								'slug' 					=> 'color_forms_bg',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Pre Footer Background', 'loc_canon'),
								'slug' 					=> 'color_prefoot_bg',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Pre Footer Text Color', 'loc_canon'),
								'slug' 					=> 'color_prefoot',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Pre Footer Text Hover', 'loc_canon'),
								'slug' 					=> 'color_prefoot_hover',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Footer Background', 'loc_canon'),
								'slug' 					=> 'color_foot_bg',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Footer Text Color', 'loc_canon'),
								'slug' 					=> 'color_foot',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Footer Link Hover Color', 'loc_canon'),
								'slug' 					=> 'color_foot_hover',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Footer Text Color 2', 'loc_canon'),
								'slug' 					=> 'color_foot_2',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Footer Border Color', 'loc_canon'),
								'slug' 					=> 'color_border_3',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Footer Block Color 2', 'loc_canon'),
								'slug' 					=> 'color_foot_bg_2',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Baseline Background', 'loc_canon'),
								'slug' 					=> 'color_baseline_bg',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Baseline Text', 'loc_canon'),
								'slug' 					=> 'color_baseline',
								'options_name'			=> 'canon_options_appearance',
							));
							
							fw_option(array(
								'type'					=> 'color',
								'title' 				=> __('Baseline Text Hover', 'loc_canon'),
								'slug' 					=> 'color_baseline_hover',
								'options_name'			=> 'canon_options_appearance',
							));
							
						?>			

						</table>


					<!-- 
					--------------------------------------------------------------------------
						BACKGROUND
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Background", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php

								fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> __('Background image URL', 'loc_canon'),
									'content' 				=> array(
										__('Enter a complete URL to the image you want to use or', 'loc_canon'),
										__('Click the "Upload" button, upload an image and make sure you click the "Use this image" button or', 'loc_canon'),
										__('Click the "Upload" button and choose an image from the media library tab. Make sure you click the "Use this image" button.', 'loc_canon'),
										__('Remember to save your changes.', 'loc_canon'),
										__('NB: the background image will be positioned top-center.', 'loc_canon'),
									),
								));

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Background link (optional)', 'loc_canon'),
									'content' 				=> array(
										__('If you insert a link here you background will automatically be made clickable. Clicking the background will open up your link in a new window. Great for take-over style ad-campaigns.', 'loc_canon'),
										__('NB: Only works with boxed design.', 'loc_canon'),
									),
								));

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Repeat', 'loc_canon'),
									'content' 				=> array(
										__('If set to repeat the background image will repeat vertically.', 'loc_canon'),
									),
								));

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Attachement', 'loc_canon'),
									'content' 				=> array(
										__('If set to fixed the background image will not scroll.', 'loc_canon'),
									),
								));

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Background pattern', 'loc_canon'),
									'content' 				=> array(
										__('Click one of buttons to use that background pattern. Notice that the url of pattern image file will be automatically inserted into the Backgroun image URL input. Also notice that Repeat and attachment selects will be updated to recommended selections for use with pattern backgrounds (repeat fixed). Remember to save your changes.', 'loc_canon'),
									),
								));

							?> 

						</div>

						<table class='form-table' id="background_table">

							<?php

								fw_option(array(
									'type'					=> 'upload',
									'title' 				=> __('Background image URL', 'loc_canon'),
									'slug' 					=> 'bg_img_url',
									'btn_text'				=> __('Upload background image', 'loc_canon'),
									'options_name'			=> 'canon_options_appearance',
								)); 

								fw_option(array(
									'type'					=> 'text',
									'title' 				=> __('Background link (optional)', 'loc_canon'),
									'slug' 					=> 'bg_link',
									'class'					=> 'widefat',
									'options_name'			=> 'canon_options_appearance',
								)); 

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Repeat', 'loc_canon'),
									'slug' 					=> 'bg_repeat',
									'select_options'		=> array(
										'repeat'			=> __('Repeat', 'loc_canon'),
										'no-repeat'			=> __('No repeat', 'loc_canon')
									),
									'options_name'			=> 'canon_options_appearance',
								)); 

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Attachment', 'loc_canon'),
									'slug' 					=> 'bg_attachment',
									'select_options'		=> array(
										'fixed'				=> __('Fixed', 'loc_canon'),
										'scroll'			=> __('Scroll', 'loc_canon')
									),
									'options_name'			=> 'canon_options_appearance',
								)); 

							 ?>		

							<tr valign='top'>
								<th scope='row'><?php _e("Background pattern", "loc_canon"); ?></th>
								<td class="bg_pattern_picker">
									<img src="<?php echo get_template_directory_uri(); ?>/img/patterns/tile_btn.png" data-img_file="tile.png"> 
									<img src="<?php echo get_template_directory_uri(); ?>/img/patterns/tile2_btn.png" data-img_file="tile2.png"> 
									<img src="<?php echo get_template_directory_uri(); ?>/img/patterns/tile3_btn.png" data-img_file="tile3.png">
									<img src="<?php echo get_template_directory_uri(); ?>/img/patterns/tile4_btn.png" data-img_file="tile4.png"> 
									<img src="<?php echo get_template_directory_uri(); ?>/img/patterns/tile5_btn.png" data-img_file="tile5.png"> 
									<img src="<?php echo get_template_directory_uri(); ?>/img/patterns/tile6_btn.png" data-img_file="tile6.png">
									<img src="<?php echo get_template_directory_uri(); ?>/img/patterns/tile7_btn.png" data-img_file="tile7.png"> 
									<img src="<?php echo get_template_directory_uri(); ?>/img/patterns/tile8_btn.png" data-img_file="tile8.png"> 
									<img src="<?php echo get_template_directory_uri(); ?>/img/patterns/tile9_btn.png" data-img_file="tile9.png"> 
									<img src="<?php echo get_template_directory_uri(); ?>/img/patterns/tile10_btn.png" data-img_file="tile10.png">  
								</td>
							</tr>


						</table>



					<!-- 
					--------------------------------------------------------------------------
						GOOGLE WEBFONTS
				    -------------------------------------------------------------------------- 
					-->


						<h3><?php _e("Google Webfonts", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php

								fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> __('Change fonts', 'loc_canon'),
									'content' 				=> array(
										__('<i>first select:</i> Font name.', 'loc_canon'),
										__('<i>middle select:</i> Font variants (will change automatically if available for the chosen font).', 'loc_canon'),
										__('<i>last select:</i> Font subset (will change automatically if available for the chosen font).', 'loc_canon'),
									),
								));

								fw_option_help(array(
									'type'					=> 'paragraphs',
									'title' 				=> __('More info', 'loc_canon'),
									'content' 				=> array(
										__('Notice: You can only control the general fonts to be used. However, parameters like font size, styling, letter-spacing etc. are controlled by the theme itself.', 'loc_canon'),
										__('Go to <a href="http://www.google.com/webfonts" target="_blank">Google Webfonts</a> homepage to preview fonts.', 'loc_canon'),
									),
								));

							?> 

						</div>
						

						<table class='form-table'>

							<?php 

								fw_option(array(
									'type'					=> 'font',
									'title' 				=> __('Body Text', 'loc_canon'),
									'slug' 					=> 'font_main',
									'options_name'			=> 'canon_options_appearance',
								)); 
								
								fw_option(array(
									'type'					=> 'font',
									'title' 				=> __('Main Headings Text', 'loc_canon'),
									'slug' 					=> 'font_headings',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'font',
									'title' 				=> __('Navigation Text', 'loc_canon'),
									'slug' 					=> 'font_nav',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'font',
									'title' 				=> __('Second / Meta Headings Text', 'loc_canon'),
									'slug' 					=> 'font_headings_meta',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'font',
									'title' 				=> __('Bold Text', 'loc_canon'),
									'slug' 					=> 'font_bold',
									'options_name'			=> 'canon_options_appearance',
								)); 
								
								fw_option(array(
									'type'					=> 'font',
									'title' 				=> __('Italic Text', 'loc_canon'),
									'slug' 					=> 'font_italic',
									'options_name'			=> 'canon_options_appearance',
								)); 
								
								fw_option(array(
									'type'					=> 'font',
									'title' 				=> __('Strong Text', 'loc_canon'),
									'slug' 					=> 'font_strong',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'font',
									'title' 				=> __('Logo Text', 'loc_canon'),
									'slug' 					=> 'font_logo',
									'options_name'			=> 'canon_options_appearance',
								));    



							?>

						</table>



					<!-- 
					--------------------------------------------------------------------------
						RELATIVE FONT SIZE
				    -------------------------------------------------------------------------- 
					-->


						<h3><?php _e("Relative Font Size", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Font size', 'loc_canon'),
									'content' 				=> array(
										__('Adjust the relative size of all fonts.', 'loc_canon'),
									),
								));

							?> 

						</div>
						

						<table class='form-table'>

							<?php 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Font size', 'loc_canon'),
									'slug' 					=> 'font_size_root',
									'min'					=> '0',
									'max'					=> '1000',
									'step'					=> '1',
									'width_px'				=> '60',
									'colspan'				=> '2',
									'postfix' 				=> __('%', 'loc_canon'),
									'options_name'			=> 'canon_options_appearance',
								)); 

							?>

						</table>



					<!-- 
					--------------------------------------------------------------------------
						LIGHTBOX SETTINGS
				    -------------------------------------------------------------------------- 
					-->


						<h3><?php _e("Lightbox settings", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Lightbox overlay color', 'loc_canon'),
									'content' 				=> array(
										__('Select the color of the lightbox overlay.', 'loc_canon'),
									),
								));

								fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> __('Lightbox overlay opacity', 'loc_canon'),
									'content' 				=> array(
										__('Select the opacity of the lightbox overlay.', 'loc_canon'),
										__('Choose a value between 0 and 1.', 'loc_canon'),
										__('0 is completely transparent.', 'loc_canon'),
										__('1 is compeltely solid.', 'loc_canon'),
									),
								));

							?> 

						</div>

						<table class='form-table'>

							<?php

								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Lightbox overlay color', 'loc_canon'),
									'slug' 					=> 'lightbox_overlay_color',
									'options_name'			=> 'canon_options_appearance',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Lightbox overlay opacity', 'loc_canon'),
									'slug' 					=> 'lightbox_overlay_opacity',
									'min'					=> '0',
									'max'					=> '1',
									'step'					=> '0.1',
									'width_px'				=> '60',
									'colspan'				=> '2',
									'options_name'			=> 'canon_options_appearance',
								)); 

							?>

						</table>



					<!-- 
					--------------------------------------------------------------------------
						ANIMATION: IMG SLIDERS
				    -------------------------------------------------------------------------- 
					-->

					


						<h3><?php _e("Animation: Image Sliders", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>

							<p>This controls general behavior of image flexsliders used in theme.</p>

							<?php

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Slideshow', 'loc_canon'),
									'content' 				=> array(
										__('If checked slides will change automatically.', 'loc_canon'),
									),
								));

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Slide delay', 'loc_canon'),
									'content' 				=> array(
										__('Delay between each slide (in milliseconds).', 'loc_canon'),
									),
								));

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Animation duration', 'loc_canon'),
									'content' 				=> array(
										__('Duration of transition animation (in milliseconds).', 'loc_canon'),
									),
								));

							?> 

						</div>

						<table class='form-table'>

							<?php 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Slideshow', 'loc_canon'),
									'slug' 					=> 'anim_img_slider_slideshow',
									'options_name'			=> 'canon_options_appearance',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Slide delay', 'loc_canon'),
									'slug' 					=> 'anim_img_slider_delay',
									'min'					=> '0',
									'max'					=> '100000',
									'step'					=> '10',
									'postfix'				=> '<i> (milliseconds)</i>',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_appearance',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Animation duration', 'loc_canon'),
									'slug' 					=> 'anim_img_slider_anim_duration',
									'min'					=> '0',
									'max'					=> '100000',
									'step'					=> '10',
									'postfix'				=> '<i> (milliseconds)</i>',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_appearance',
								)); 

							?>

						</table>




					<!-- 
					--------------------------------------------------------------------------
						ANIMATION: QUOTE SLIDERS
				    -------------------------------------------------------------------------- 
					-->


						<h3><?php _e("Animation: Quote Sliders", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>

							<p>This controls general behavior of quote flexsliders used in theme.</p>

							<?php

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Slideshow', 'loc_canon'),
									'content' 				=> array(
										__('If checked slides will change automatically.', 'loc_canon'),
									),
								));

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Slide delay', 'loc_canon'),
									'content' 				=> array(
										__('Delay between each slide (in milliseconds).', 'loc_canon'),
									),
								));

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Animation duration', 'loc_canon'),
									'content' 				=> array(
										__('Duration of transition animation (in milliseconds).', 'loc_canon'),
									),
								));

							?> 

						</div>

						<table class='form-table'>

							<?php 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Slideshow', 'loc_canon'),
									'slug' 					=> 'anim_quote_slider_slideshow',
									'options_name'			=> 'canon_options_appearance',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Slide delay', 'loc_canon'),
									'slug' 					=> 'anim_quote_slider_delay',
									'min'					=> '0',
									'max'					=> '100000',
									'step'					=> '10',
									'postfix'				=> '<i> (milliseconds)</i>',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_appearance',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Animation duration', 'loc_canon'),
									'slug' 					=> 'anim_quote_slider_anim_duration',
									'min'					=> '0',
									'max'					=> '100000',
									'step'					=> '10',
									'postfix'				=> '<i> (milliseconds)</i>',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_appearance',
								)); 

							?>

						</table>



					<!-- 
					--------------------------------------------------------------------------
						ANIMATION: LAZY LOAD EFFECT
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Animation: Lazy Load Effect", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>

							<?php

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Lazy Load Effect', 'loc_canon'),
									'content' 				=> array(
										__('When scrolling down elements fade in as they enter the viewport simulating lazy load.', 'loc_canon'),
									),
								));

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Use on ..', 'loc_canon'),
									'content' 				=> array(
										__('Select what elements to use lazy the load effect on.', 'loc_canon'),
										__('Notice that the pagebuilder also allows you to display widgets which can lead to unexpected animations when "Use on widgets" is selected and "Use on pagebuilder elements" is deselected.', 'loc_canon'),
									),
								));

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Start animation after', 'loc_canon'),
									'content' 				=> array(
										__('Delay before animation starts (in seconds).', 'loc_canon'),
									),
								));

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Enter from', 'loc_canon'),
									'content' 				=> array(
										__('Element moves in from this angle.', 'loc_canon'),
									),
								));

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Move', 'loc_canon'),
									'content' 				=> array(
										__('How much the element will move (in pixels). Can be 0 if you do not want the element to move at all.', 'loc_canon'),
									),
								));

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Animation duration', 'loc_canon'),
									'content' 				=> array(
										__('How long the fade-in animation lasts (in seconds).', 'loc_canon'),
									),
								));

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Viewport factor', 'loc_canon'),
									'content' 				=> array(
										__('How big a part of the element that must enter the viewport for the fade-in animation to trigger. 0 will trigger fade-in animation right when element enters viewport. 1 will require the whole element to enter viewport before triggering fade-in.', 'loc_canon'),
									),
								));

							?> 

						</div>

						<table class='form-table'>

							<?php 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Use on pagebuilder elements', 'loc_canon'),
									'slug' 					=> 'lazy_load_on_pagebuilder_elements',
									'options_name'			=> 'canon_options_appearance',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Use on classic archive posts', 'loc_canon'),
									'slug' 					=> 'lazy_load_on_archive_posts',
									'options_name'			=> 'canon_options_appearance',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Use on widgets', 'loc_canon'),
									'slug' 					=> 'lazy_load_on_widgets',
									'options_name'			=> 'canon_options_appearance',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Start animation after', 'loc_canon'),
									'slug' 					=> 'lazy_load_after',
									'min'					=> '0',
									'max'					=> '100',
									'step'					=> '0.01',
									'postfix'				=> '<i> (seconds)</i>',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_appearance',
								)); 

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Enter from', 'loc_canon'),
									'slug' 					=> 'lazy_load_enter',
									'select_options'		=> array(
										'top'				=> __('Top', 'loc_canon'),
										'right'				=> __('Right', 'loc_canon'),
										'bottom'			=> __('Bottom', 'loc_canon'),
										'left'				=> __('Left', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_appearance',
								)); 


								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Move', 'loc_canon'),
									'slug' 					=> 'lazy_load_move',
									'min'					=> '0',
									'max'					=> '1000',
									'step'					=> '1',
									'postfix'				=> '<i> (pixels)</i>',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_appearance',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Animation duration', 'loc_canon'),
									'slug' 					=> 'lazy_load_over',
									'min'					=> '0',
									'max'					=> '100',
									'step'					=> '0.01',
									'postfix'				=> '<i> (seconds)</i>',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_appearance',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Viewport factor', 'loc_canon'),
									'slug' 					=> 'lazy_load_viewport_factor',
									'min'					=> '0',
									'max'					=> '1',
									'step'					=> '0.01',
									'postfix'				=> '<i> (ratio)</i>',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_appearance',
								)); 

							?>

						</table>


					<?php submit_button(); ?>
				</form>
			</div> <!-- end table container -->	
		</div>
	</div>

