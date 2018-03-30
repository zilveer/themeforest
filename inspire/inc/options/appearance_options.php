	<div class="wrap">

		<div id="icon-themes" class="icon32"></div>

		<h2>Inspire - Appearance Settings</h2>

		<?php 
			//delete_option('inspire_options_appearance');
			$inspire_options_appearance = get_option('inspire_options_appearance'); 

			//var_dump($inspire_options_appearance);
		?>

		<br>
		
		<div class="options_wrapper">
		
			<div class="table_container">

				<form method="post" action="options.php" enctype="multipart/form-data">
					<?php settings_fields('group_inspire_options_appearance'); ?>				<!-- very important to add these two functions as they mediate what wordpress generates automatically from the functions.php -->
					<?php do_settings_sections('handle_inspire_options_appearance'); ?>		

					<?php submit_button(); ?>

				<!-- COLORS-->

					<h3>Color settings <img src="<?php echo get_template_directory_uri() . '/images/help.png' ?>"></h3>

					<div class='help'>
						<b>Grayscale : </b> <br>
						<span>
							If checked images on site will be grayscaled.
						</span>	
						<br><br>

						<b>Main color : </b> <br>
						<span>
							This will change the main color of the site.
						</span>	
						<br><br>

						<b>Background color : </b> <br>
						<span>
							This will change the background color of the site.
						</span>	
						<br><br>
					</div>

					<table class='form-table'>

						<tr valign='top'>
							<th scope='row'>Grayscale</th>
							<td>
								<select id="grayscale" name="inspire_options_appearance[grayscale]"> 
					     			<option value="grayscale" <?php if (isset($inspire_options_appearance['grayscale'])) {if ($inspire_options_appearance['grayscale'] == "grayscale") echo "selected='selected'";} ?>>Grayscale</option> 
					     			<option value="grayscale_reverse" <?php if (isset($inspire_options_appearance['grayscale'])) {if ($inspire_options_appearance['grayscale'] == "grayscale_reverse") echo "selected='selected'";} ?>>Reverse grayscale</option> 
					     			<option value="grayscale_off" <?php if (isset($inspire_options_appearance['grayscale'])) {if ($inspire_options_appearance['grayscale'] == "grayscale_off") echo "selected='selected'";} ?>>Full color mode</option> 
								</select> 
							</td>
						</tr>

						<tr valign='top' class='inspire_colorpicker'>
							<th scope='row'>Main color</th>
							<td class='inspire_colorpicker_input'>
								<input type="text" id="color_main" name="inspire_options_appearance[color_main]" value="<?php echo $inspire_options_appearance['color_main']; ?>" />    
							</td>
							<td>
								<div id="colorSelector_main" class="colorSelectorBox"><div style="background-color: <?php echo $inspire_options_appearance['color_main']; ?>"></div></div>
							</td>
						</tr>

						<tr valign='top' class='inspire_colorpicker'>
							<th scope='row'>Background color</th>
							<td class='inspire_colorpicker_input'>
								<input type="text" id="color_bg" name="inspire_options_appearance[color_bg]" value="<?php echo $inspire_options_appearance['color_bg']; ?>" />    
							</td>
							<td>
								<div id="colorSelector_bg" class="colorSelectorBox"><div style="background-color: <?php echo $inspire_options_appearance['color_bg']; ?>"></div></div>
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Lightbox overlay opacity</th>
							<td>
								<input 
									type='number' 
									id='lightbox_overlay_opacity' 
									name='inspire_options_appearance[lightbox_overlay_opacity]' 
									min='0'
									max='1'
									step='0.1'
									style='width: 60px;'
									value='<?php if (isset($inspire_options_appearance['lightbox_overlay_opacity'])) echo esc_attr($inspire_options_appearance['lightbox_overlay_opacity']); ?>'
								>
							</td>
						</tr>

						<tr valign='top' class='inspire_colorpicker'>
							<th scope='row'>Lightbox overlay color</th>
							<td class='inspire_colorpicker_input'>
								<input type="text" id="color_lightbox_overlay" name="inspire_options_appearance[color_lightbox_overlay]" value="<?php if (isset($inspire_options_appearance['color_lightbox_overlay'])) echo $inspire_options_appearance['color_lightbox_overlay']; ?>" />    
							</td>
							<td>
								<div id="colorSelector_lightbox_overlay" class="colorSelectorBox"><div style="background-color: <?php if (isset($inspire_options_appearance['color_lightbox_overlay'])) echo $inspire_options_appearance['color_lightbox_overlay']; ?>"></div></div>
							</td>
						</tr>

					</table>

				<!-- BACKGROUND-->

					<h3>Background <img src="<?php echo get_template_directory_uri() . '/images/help.png' ?>"></h3>

					<div class='help'>
						<b> Background URL </b> <br>
						<span>
							- Enter a complete URL to the image you want to use or<br>
							- Click the "Upload" button, upload an image and make sure you click the "Use as background" button or<br>
							- Click the "Upload" button and choose an image from the media library tab. Make sure you click the "Use as background" button.<br>
							- If you leave the URL text field empty no background will be displayed.<br>
							- Remember to save your changes.<br>
						</span>	
						<br><br>

						<b> Background Link </b> <br>
						<span>
							If you put a URL in this input you will be able to click the background and it will link to your URL. <br>
							Just leave this input empty if you do not want your background to be clickable.
						</span>	
						<br><br>

						<b> Open background link in new window </b> <br>
						<span>
							By default background links will open in same window. If you check this checkbox links will instead open up in a new window. <br>
							NB: requires Background Link.
						</span>	
						<br><br>

					</div>

					<table class='form-table'>

						<tr valign='top'>
							<th scope='row'>Background URL</th>
							<td>
								<input type='text' id='bg_url' name='inspire_options_appearance[bg_url]' class='url' value='<?php if (isset($inspire_options_appearance['bg_url'])) echo $inspire_options_appearance['bg_url']; ?>'>
								<input type="button" id="upload_bg_button" class="upload button" value="Upload background" />
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Background link (optional)</th>
							<td class='table_input'>
								<input type='text' id='bg_link' name='inspire_options_appearance[bg_link]' value='<?php if (isset($inspire_options_appearance['bg_link'])) echo $inspire_options_appearance['bg_link']; ?>'>
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Open background link in new window</th>
							<td>
								<input class="checkbox" type="checkbox" id="bg_link_opens_in_new_window" name="inspire_options_appearance[bg_link_opens_in_new_window]" value="checked" <?php checked(isset($inspire_options_appearance['bg_link_opens_in_new_window'])) ?>/> 
							</td>
						</tr>

					</table>


				<!-- FONTS-->

					<h3>Fonts <img src="<?php echo get_template_directory_uri() . '/images/help.png' ?>"></h3>

					<div class='help'>
						Change fonts.<br>
						- <i>first select:</i> Font name.<br>
						- <i>middle select:</i> Font variants (will change automatically if available for the chosen font).<br>
						- <i>last select:</i> Font subset (will change automatically if available for the chosen font).<br>
						<br>
						Notice: You can only control the general fonts to be used. However, parameters like font size, styling, letter-spacing etc. are controlled by the theme itself.<br>
						<br>

						<b>Main font :  </b> <br>
						<span>
							Menus and general text.
						</span>	
						<br><br>

						<b>Secondary font : </b> <br>
						<span>
							Mainly headings.
						</span>	
						<br><br>
					 	Go to <a href="http://www.google.com/webfonts" target="_blank">Google Webfonts</a> homepage to preview fonts.
					</div>

					<table class='form-table' style="width:960px;">

					<!-- MAIN FONT -->	

						<tr id='font_main' valign='top' class='inspire_webfonts_controller'>
							<th scope='row'>Main font</th>
							<td>
								<select id="font_main_family" name="inspire_options_appearance[font_main][0]" class="inspire_font_family" data-selected="<?php if (isset($inspire_options_appearance['font_main'][0])) echo $inspire_options_appearance['font_main'][0]; ?>"> 
					     			<option value="inspire_default" <?php if (isset($inspire_options_appearance['font_main'][0])) {if ($inspire_options_appearance['font_main'][0] == "inspire_default") echo "selected='selected'";} ?>>INSPIRE DEFAULT</option> 
					     			<option value="inspire_default">----</option> 
								</select> 
							</td>
							<td>
								<select id="font_main_variant" name="inspire_options_appearance[font_main][1]" class="inspire_font_variant" data-selected="<?php if (isset($inspire_options_appearance['font_main'][1])) echo $inspire_options_appearance['font_main'][1]; ?>"> 
								</select> 
							</td>
							<td>
								<select id="font_main_subset" name="inspire_options_appearance[font_main][2]" class="inspire_font_subset" data-selected="<?php if (isset($inspire_options_appearance['font_main'][2])) echo $inspire_options_appearance['font_main'][2]; ?>"> 
								</select> 
							</td>
						</tr>

					<!-- HEADER FONT -->	

						<tr id='font_secondary' valign='top' class='inspire_webfonts_controller'>
							<th scope='row'>Secondary font</th>
							<td>
								<select id="font_secondary_family" name="inspire_options_appearance[font_secondary][0]" class="inspire_font_family" data-selected="<?php if (isset($inspire_options_appearance['font_secondary'][0])) echo $inspire_options_appearance['font_secondary'][0]; ?>"> 
					     			<option value="inspire_default" <?php if (isset($inspire_options_appearance['font_secondary'][0])) {if ($inspire_options_appearance['font_secondary'][0] == "inspire_default") echo "selected='selected'";} ?>>INSPIRE DEFAULT</option> 
					     			<option value="inspire_default">----</option> 
								</select> 
							</td>
							<td>
								<select id="font_secondary_variant" name="inspire_options_appearance[font_secondary][1]" class="inspire_font_variant" data-selected="<?php if (isset($inspire_options_appearance['font_secondary'][1])) echo $inspire_options_appearance['font_secondary'][1]; ?>"> 
								</select> 
							</td>
							<td>
								<select id="font_secondary_subset" name="inspire_options_appearance[font_secondary][2]" class="inspire_font_subset" data-selected="<?php if (isset($inspire_options_appearance['font_secondary'][2])) echo $inspire_options_appearance['font_secondary'][2]; ?>"> 
								</select> 
							</td>
						</tr>

					</table>

				<!-- ANIMATION: LOAD POSTS: FADE-->

					<h3>Animation: Load Posts : Fade <img src="<?php echo get_template_directory_uri() . '/images/help.png' ?>"></h3>

					<div class='help'>
						<b>Fade-in speed: </b> <br>
						<span>
							The speed at which posts fade in (milliseconds).
						</span>	
						<br><br>

						<b>Fade-out speed: </b> <br>
						<span>
							The speed at which posts fade out (milliseconds).
						</span>	
						<br><br>

					</div>

					<table class='form-table'>

						<tr valign='top'>
							<th scope='row'>Fade-in speed</th>
							<td>
								<input 
									type='number' 
									id='anim_loadposts_fade_speed' 
									name='inspire_options_appearance[anim_loadposts_fade_speed]' 
									min='0'
									max='100000'
									step='10'
									style='width: 60px;'
									value='<?php if (isset($inspire_options_appearance['anim_loadposts_fade_speed'])) echo esc_attr($inspire_options_appearance['anim_loadposts_fade_speed']); ?>'
								> <i> (milliseconds)</i>
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Fade-out speed</th>
							<td>
								<input 
									type='number' 
									id='anim_loadposts_fade_outspeed' 
									name='inspire_options_appearance[anim_loadposts_fade_outspeed]' 
									min='0'
									max='100000'
									step='10'
									style='width: 60px;'
									value='<?php if (isset($inspire_options_appearance['anim_loadposts_fade_outspeed'])) echo esc_attr($inspire_options_appearance['anim_loadposts_fade_outspeed']); ?>'
								> <i> (milliseconds)</i>
							</td>
						</tr>


					</table>

				<!-- ANIMATION: LOAD POSTS: ASYNCHRONOUS FADE-->

					<h3>Animation: Load Posts : Asynchronous Fade <img src="<?php echo get_template_directory_uri() . '/images/help.png' ?>"></h3>

					<div class='help'>
						<b>Fade-in speed: </b> <br>
						<span>
							The speed at which posts fade in (milliseconds).
						</span>	
						<br><br>

						<b>Fade-out speed: </b> <br>
						<span>
							The speed at which posts fade out (milliseconds).
						</span>	
						<br><br>

						<b>Container resize speed: </b> <br>
						<span>
							The speed at which the post container resizes (milliseconds).
						</span>	
						<br><br>

						<b>Maximum delay: </b> <br>
						<span>
							With asynchronous fade there is a random delay before each post fades in. This is the maximum delay allowed (milliseconds).
						</span>	
						<br><br>

					</div>

					<table class='form-table'>

						<tr valign='top'>
							<th scope='row'>Fade-in speed</th>
							<td>
								<input 
									type='number' 
									id='anim_loadposts_async_speed' 
									name='inspire_options_appearance[anim_loadposts_async_speed]' 
									min='0'
									max='100000'
									step='10'
									style='width: 60px;'
									value='<?php if (isset($inspire_options_appearance['anim_loadposts_async_speed'])) echo esc_attr($inspire_options_appearance['anim_loadposts_async_speed']); ?>'
								> <i> (milliseconds)</i>
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Fade-out speed</th>
							<td>
								<input 
									type='number' 
									id='anim_loadposts_async_outspeed' 
									name='inspire_options_appearance[anim_loadposts_async_outspeed]' 
									min='0'
									max='100000'
									step='10'
									style='width: 60px;'
									value='<?php if (isset($inspire_options_appearance['anim_loadposts_async_outspeed'])) echo esc_attr($inspire_options_appearance['anim_loadposts_async_outspeed']); ?>'
								> <i> (milliseconds)</i>
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Container resize speed</th>
							<td>
								<input 
									type='number' 
									id='anim_loadposts_async_container_speed' 
									name='inspire_options_appearance[anim_loadposts_async_container_speed]' 
									min='0'
									max='100000'
									step='10'
									style='width: 60px;'
									value='<?php if (isset($inspire_options_appearance['anim_loadposts_async_container_speed'])) echo esc_attr($inspire_options_appearance['anim_loadposts_async_container_speed']); ?>'
								> <i> (milliseconds)</i>
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Maximum delay</th>
							<td>
								<input 
									type='number' 
									id='anim_loadposts_async_max_delay' 
									name='inspire_options_appearance[anim_loadposts_async_max_delay]' 
									min='0'
									max='100000'
									step='10'
									style='width: 60px;'
									value='<?php if (isset($inspire_options_appearance['anim_loadposts_async_max_delay'])) echo esc_attr($inspire_options_appearance['anim_loadposts_async_max_delay']); ?>'
								> <i> (milliseconds)</i>
							</td>
						</tr>

					</table>

				<!-- ANIMATION: POST SLIDER-->

					<h3>Animation: Post Slider <img src="<?php echo get_template_directory_uri() . '/images/help.png' ?>"></h3>

					<div class='help'>
						<b>Post slider: </b> <br>
						<span>
							If you have several images attached to a single post these images will be displayed in a slider in the place where the featured image would normally appear. The featured image will always be the first image.
						</span>	
						<br><br>

						<b>Attach images to post: </b> <br>
						<span>
							NB: only images that are uploaded to a post will be attached to that post. You can not attach images to a post that are already in your media library.<br>
							<br>
							To attach an images to a post:<br>
							- Go to All posts > Your post.<br>
							- Right above the editor box click "Add Media" button.<br>
							- Choose Upload Files.<br>
							- Select files and upload.<br>
							- When your images have been uploaded you can either insert the images into your post or simply close down the Add Media window. <br>
							<br>
							Once your images have been uploaded they will be "attached" to your post whether you choose to insert them in your post or not. <br>
							<br>
							To check if your images have been attached correctly to a post:<br>
							- Go to Media.<br>
							- Here is a list of all media and in the column Uploaded to you can see which post each media is attached to.<br>
						</span>	
						<br><br>

						<b>Slideshow: </b> <br>
						<span>
							If checked slider will automatically change images (slideshow). <br>
							WARNING: If your images have different height automatically changing images can make your page content jump up and down. Therefore it is not recommended to display images as a slideshow.<br>
						</span>	
						<br><br>

						<b>Slideshow speed: </b> <br>
						<span>
							How fast you want the slides to change.<br>
						</span>	
						<br><br>

						<b>Animation speed: </b> <br>
						<span>
							Speed of the fade animation.<br>
						</span>	
						<br><br>

					</div>

					<table class='form-table'>

						<tr valign='top'>
							<th scope='row'>Slideshow :</th>
							<td>
								<input type="checkbox" id="anim_postslider_slideshow" name="inspire_options_appearance[anim_postslider_slideshow]" class="checkbox" value="checked" <?php checked(isset($inspire_options_appearance['anim_postslider_slideshow'])) ?>/> 
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Slideshow speed</th>
							<td>
								<input 
									type='number' 
									id='anim_postslider_slideshow_speed' 
									name='inspire_options_appearance[anim_postslider_slideshow_speed]' 
									min='0'
									max='100000'
									step='10'
									style='width: 60px;'
									value='<?php if (isset($inspire_options_appearance['anim_postslider_slideshow_speed'])) echo esc_attr($inspire_options_appearance['anim_postslider_slideshow_speed']); ?>'
								> <i> (milliseconds)</i>
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Animation speed</th>
							<td>
								<input 
									type='number' 
									id='anim_postslider_anim_speed' 
									name='inspire_options_appearance[anim_postslider_anim_speed]' 
									min='0'
									max='100000'
									step='10'
									style='width: 60px;'
									value='<?php if (isset($inspire_options_appearance['anim_postslider_anim_speed'])) echo esc_attr($inspire_options_appearance['anim_postslider_anim_speed']); ?>'
								> <i> (milliseconds)</i>
							</td>
						</tr>

					</table>

					<?php submit_button(); ?>
				</form>
			</div> <!-- end table container -->	

	
		</div>

	</div>

