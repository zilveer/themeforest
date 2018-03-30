	<div class="wrap">

		<div id="icon-themes" class="icon32"></div>

		<h2>Inspire - General Settings</h2>

		<?php 
			//delete_option('inspire_options');

			$inspire_options = get_option('inspire_options'); 

			//RESET
			if ($inspire_options['reset_all'] == 'RESET') {
				delete_option('inspire_options');
				delete_option('inspire_options_hp');
				delete_option('inspire_options_post');
				delete_option('inspire_options_appearance');
				delete_option('inspire_options_hooks');
				echo "<script>alert('All theme settings have been reset!'); window.location.reload();</script>";
			}
			//var_dump($inspire_options);
		?>

		<br>
		
		<div class="options_wrapper">
		
			<div class="table_container">

				<form method="post" action="options.php" enctype="multipart/form-data">
					<?php settings_fields('group_inspire_options'); ?>				<!-- very important to add these two functions as they mediate what wordpress generates automatically from the functions.php -->
					<?php do_settings_sections('handle_inspire_options'); ?>		

					<?php submit_button(); ?>

				<!-- GENERAL -->

					<h3>General <img src="<?php echo get_template_directory_uri() . '/images/help.png' ?>"></h3>

					<div class='help'>
						<b> Use responsive design: </b> <br>
						<span>
							Responsive design changes the way your site looks depending on the browser size. This is done to optimize the viewing experience on different devices. The Inspire theme supports 3 browser sizes which are roughly: Normal computer screen, mobile phone horizontal and mobile phone vertical.
							Turning off the responsive design will make the site look the same across all devices and browser sizes. Notice that responsiveness is only visible on mobile devices.
						</span>	
						<br><br>

						<b> Favicon URL </b> <br>
						<span>
							- Enter a complete URL to the image you want to use or<br>
							- Click the "Upload" button, upload an image and make sure you click the "Use as favicon" button or<br>
							- Click the "Upload" button and choose an image from the media library tab. Make sure you click the "Use as favicon" button.<br>
							- If you leave the URL text field empty the default favicon will be displayed.<br>
							- Remember to save your changes.<br>
						</span>	
						<br><br>

						<b> Archive style </b> <br>
						<span>
							Choose what style to use on archive pages.<br>
						</span>	
						<br><br>

						<b>Load posts by</b> <br>
						<span>
							- <i>Load more button</i>: New posts will load when user clicks load more button.<br>
							- <i>Infinity scroll</i>: New posts will load automatically when user scrolls to the bottom of the page.<br>
						</span>	
						<br><br>

						<b>Load posts animation</b> <br>
						<span>
							Choose which animation to use when loading new posts onto the page using AJAX:<br>
							- <i>Fade:</i> All new posts fade onto the page together.<br>
							- <i>Asynchronous Fade:</i> New posts fade onto the page in random sequence.<br>
						</span>	
						<br><br>

						<b>Back-to-top button style</b> <br>
						<span>
							- <i>On/off:</i> Button fades into view as the user scrolls down.<br>
							- <i>Gradient:</i> Button fades gradually into view depending on how far down user scrolls.<br>
						</span>	
						<br><br>

					</div>

					<table class='form-table'>

						<tr valign='top'>
							<th scope='row'>Use responsive design</th>
							<td>
								<input class="checkbox" type="checkbox" id="use_responsive_design" name="inspire_options[use_responsive_design]" value="checked" <?php checked(isset($inspire_options['use_responsive_design'])) ?>/> 
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Favicon URL</th>
							<td>
								<input type='text' id='favicon_url' name='inspire_options[favicon_url]' class='url' value='<?php if (isset($inspire_options['favicon_url'])) echo $inspire_options['favicon_url']; ?>'>
								<input type="button" id="upload_favicon_button" class="upload button" value="Upload favicon" />
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Archive style</th>
							<td>
								<select id="archive_style" name="inspire_options[archive_style]"> 
					     			<option value="classic" <?php if (isset($inspire_options['archive_style'])) {if ($inspire_options['archive_style'] == "classic") echo "selected='selected'";} ?>>Classic</option> 
					     			<option value="1-column" <?php if (isset($inspire_options['archive_style'])) {if ($inspire_options['archive_style'] == "1-column") echo "selected='selected'";} ?>>1-column</option> 
					     			<option value="2-column" <?php if (isset($inspire_options['archive_style'])) {if ($inspire_options['archive_style'] == "2-column") echo "selected='selected'";} ?>>2-column</option> 
					     			<option value="3-column" <?php if (isset($inspire_options['archive_style'])) {if ($inspire_options['archive_style'] == "3-column") echo "selected='selected'";} ?>>3-column</option> 
					     			<option value="4-column" <?php if (isset($inspire_options['archive_style'])) {if ($inspire_options['archive_style'] == "4-column") echo "selected='selected'";} ?>>4-column</option> 
								</select> 
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Load posts by</th>
							<td>
								<select id="load_posts_by" name="inspire_options[load_posts_by]"> 
					     			<option value="button" <?php if (isset($inspire_options['load_posts_by'])) {if ($inspire_options['load_posts_by'] == "button") echo "selected='selected'";} ?>>Load more button</option> 
					     			<option value="scroll" <?php if (isset($inspire_options['load_posts_by'])) {if ($inspire_options['load_posts_by'] == "scroll") echo "selected='selected'";} ?>>Infinity scroll</option> 
								</select> 
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Load posts animation</th>
							<td>
								<select id="load_posts_animation" name="inspire_options[load_posts_animation]"> 
					     			<option value="fade" <?php if (isset($inspire_options['load_posts_animation'])) {if ($inspire_options['load_posts_animation'] == "fade") echo "selected='selected'";} ?>>Fade</option> 
					     			<option value="asynchronous" <?php if (isset($inspire_options['load_posts_animation'])) {if ($inspire_options['load_posts_animation'] == "asynchronous") echo "selected='selected'";} ?>>Asynchronous fade</option> 
								</select> 
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Back-to-top button style</th>
							<td>
								<select id="to_top_style" name="inspire_options[to_top_style]"> 
					     			<option value="onoff" <?php if (isset($inspire_options['to_top_style'])) {if ($inspire_options['to_top_style'] == "onoff") echo "selected='selected'";} ?>>On / Off</option> 
					     			<option value="gradient" <?php if (isset($inspire_options['to_top_style'])) {if ($inspire_options['to_top_style'] == "gradient") echo "selected='selected'";} ?>>Gradient</option> 
								</select> 
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Search box starts</th>
							<td>
								<select id="search_box_default" name="inspire_options[search_box_default]"> 
					     			<option value="open" <?php if (isset($inspire_options['search_box_default'])) {if ($inspire_options['search_box_default'] == "open") echo "selected='selected'";} ?>>Open</option> 
					     			<option value="open_homepage" <?php if (isset($inspire_options['search_box_default'])) {if ($inspire_options['search_box_default'] == "open_homepage") echo "selected='selected'";} ?>>Open on homepage</option> 
					     			<option value="closed" <?php if (isset($inspire_options['search_box_default'])) {if ($inspire_options['search_box_default'] == "closed") echo "selected='selected'";} ?>>Closed</option> 
								</select> 
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Load more button with an attitude</th>
							<td>
								<input class="checkbox" type="checkbox" id="load_more_attitude" name="inspire_options[load_more_attitude]" value="checked" <?php checked(isset($inspire_options['load_more_attitude'])) ?>/> 
							</td>
						</tr>

					</table>

				<!-- HEADER -->

					<h3>Header <img src="<?php echo get_template_directory_uri() . '/images/help.png' ?>"></h3>

					<div class='help'>
						<b> Header height: </b> <br>
						<span>
							Manually set the height of the header (default: 150 pixels).
						</span>	
						<br><br>

						<b>Logo position:</b> <br>
						<span>
							From top left corner of the header area.
						</span>	
						<br><br>

						<b>Nav. menu position:</b> <br>
						<span>
							From top right corner of the header area.
						</span>	
						<br><br>

						<b>Header content positioning:</b> <br>
						<span>
							Push the "Calculate" button to automatically set the logo and the nav. menu positions. This will attempt to vertically align those elements within the header area.
						</span>	
						<br><br>

						<b>Logo URL </b> <br>
						<span>
							- Enter a complete URL to the image you want to use or<br>
							- Click the "Upload" button, upload an image and make sure you click the "Use as logo" button or<br>
							- Click the "Upload" button and choose an image from the media library tab. Make sure you click the "Use as logo" button.<br>
							- If you leave the URL text field empty the default logo will be displayed.<br>
							- Remember to save your changes.<br>
						</span>	
						<br><br>

					</div>

					<table class='form-table'>

						<tr valign='top'>
							<th scope='row'>Header height</th>
							<td>
								<input 
									type='number' 
									id='header_height' 
									name='inspire_options[header_height]' 
									min='1'
									max='1000'
									style='width: 60px;'
									value='<?php if (isset($inspire_options['header_height'])) echo esc_attr($inspire_options['header_height']); ?>'
								> <i>(pixels)</i>
							</td> 
						</tr>

						<tr valign='top'>
							<th scope='row'>Logo position (from top left)</th>
							<td>
								<input 
									type='number' 
									id='pos_logo_top' 
									name='inspire_options[pos_logo_top]' 
									min='0'
									max='1000'
									style='width: 60px;'
									value='<?php if (isset($inspire_options['pos_logo_top'])) echo esc_attr($inspire_options['pos_logo_top']); ?>'
								> <i>(pixels from top)</i>
								<input 
									type='number' 
									id='pos_logo_left' 
									name='inspire_options[pos_logo_left]' 
									min='0'
									max='1000'
									style='width: 60px;'
									value='<?php if (isset($inspire_options['pos_logo_left'])) echo esc_attr($inspire_options['pos_logo_left']); ?>'
								> <i>(pixels from left)</i>
							</td> 
						</tr>

						<tr valign='top'>
							<th scope='row'>Nav. menu position (from top right)</th>
							<td>
								<input 
									type='number' 
									id='pos_nav_top' 
									name='inspire_options[pos_nav_top]' 
									min='0'
									max='1000'
									style='width: 60px;'
									value='<?php if (isset($inspire_options['pos_nav_top'])) echo esc_attr($inspire_options['pos_nav_top']); ?>'
								> <i>(pixels from top)</i>
								<input 
									type='number' 
									id='pos_nav_right' 
									name='inspire_options[pos_nav_right]' 
									min='0'
									max='1000'
									style='width: 60px;'
									value='<?php if (isset($inspire_options['pos_nav_right'])) echo esc_attr($inspire_options['pos_nav_right']); ?>'
								> <i>(pixels from right)</i>
							</td> 
						</tr>

						<tr valign='top'>
							<th scope='row'>Header content positioning</th>
							<td>
								<?php 
									if (!empty($inspire_options['logo_url'])) {
										echo '<img class="hidden" src="'. $inspire_options['logo_url'] .'">';
									} else {
										echo '<img class="hidden" src="'. get_template_directory_uri() .'/images/logo2.png">';
									}
								?>
								<input type="button" id="auto_header_content_pos" class="hidden button" value="Calculate" />
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Logo URL</th>
							<td>
								<input type='text' id='logo_url' name='inspire_options[logo_url]' class='url' value='<?php if (isset($inspire_options['logo_url'])) echo $inspire_options['logo_url']; ?>'>
								<input type="button" id="upload_logo_button" class="upload button" value="Upload logo" />
							</td>
						</tr>

					</table>

				<!-- SOCIAL LINKS -->

					<h3>Social links <img src="<?php echo get_template_directory_uri() . '/images/help.png' ?>"></h3>

					<div class='help'>
						<b> Social links: </b> <br>
						<span>
							Enter the full URL to your social pages. This will add an icon to the social icons line-up in the top-right corner of the header area. If no URL is entered the corresponding icon will not appear.
						</span>	
						<br><br>

					</div>

					<table id='social_links' class='form-table'>

						<tr valign='top'>
							<th scope='row'>Social icons size</th>
							<td>
								<select id="social_icons_size" name="inspire_options[social_icons_size]"> 
					     			<option value="small" <?php if (isset($inspire_options['social_icons_size'])) {if ($inspire_options['social_icons_size'] == "small") echo "selected='selected'";} ?>>Small</option> 
					     			<option value="big" <?php if (isset($inspire_options['social_icons_size'])) {if ($inspire_options['social_icons_size'] == "big") echo "selected='selected'";} ?>>Big</option> 
								</select> 
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Facebook</th>
							<td>
								<input type='text' id='facebook_url' name='inspire_options[facebook_url]' value='<?php if (isset($inspire_options['facebook_url'])) echo $inspire_options['facebook_url']; ?>'>
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Twitter</th>
							<td class='table_input'>
								<input type='text' id='twitter_url' name='inspire_options[twitter_url]' value='<?php if (isset($inspire_options['twitter_url'])) echo $inspire_options['twitter_url']; ?>'>
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Pinterest</th>
							<td>
								<input type='text' id='pinterest_url' name='inspire_options[pinterest_url]' value='<?php if (isset($inspire_options['pinterest_url'])) echo $inspire_options['pinterest_url']; ?>'>
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Flickr</th>
							<td>
								<input type='text' id='flickr_url' name='inspire_options[flickr_url]' value='<?php if (isset($inspire_options['flickr_url'])) echo $inspire_options['flickr_url']; ?>'>
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Tumblr</th>
							<td>
								<input type='text' id='tumblr_url' name='inspire_options[tumblr_url]' value='<?php if (isset($inspire_options['tumblr_url'])) echo $inspire_options['tumblr_url']; ?>'>
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Vimeo</th>
							<td>
								<input type='text' id='vimeo_url' name='inspire_options[vimeo_url]' value='<?php if (isset($inspire_options['vimeo_url'])) echo $inspire_options['vimeo_url']; ?>'>
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Instagram</th>
							<td>
								<input type='text' id='instagram_url' name='inspire_options[instagram_url]' value='<?php if (isset($inspire_options['instagram_url'])) echo $inspire_options['instagram_url']; ?>'>
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Google Plus</th>
							<td>
								<input type='text' id='google_url' name='inspire_options[google_url]' value='<?php if (isset($inspire_options['google_url'])) echo $inspire_options['google_url']; ?>'>
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>RSS</th>
							<td>
								<input type='text' id='rss_url' name='inspire_options[rss_url]' value='<?php if (isset($inspire_options['rss_url'])) echo $inspire_options['rss_url']; ?>'>
							</td>
						</tr>


					</table>

				<!-- FOOTER -->

					<h3>Footer <img src="<?php echo get_template_directory_uri() . '/images/help.png' ?>"></h3>

					<div class='help'>
						<b> Footer Layout: </b> <br>
						<span>
							Select layout of footer. Footer can show widgetized footer, text footer, both or none.
						</span>	
						<br><br>

						<b> Google Analytics: </b> <br>
						<span>
							Enter your <a href='http://www.google.com/analytics/' target='_blank'>Google Analytics</a> code here.
						</span>	
						<br><br>

						<b> Footer text left: </b> <br>
						<span>
							The text that will appear in the left side of the footer.
						</span>	
						<br><br>

						<b> Footer text right: </b> <br>
						<span>
							The text that will appear in the right side of the footer.
						</span>	
						<br><br>

					</div>

					<table class='form-table'>

						<tr valign='top'>
							<th scope='row'>Footer layout</th>
							<td>
								<select id="footer_layout" name="inspire_options[footer_layout]"> 
					     			<option value="none" <?php if (isset($inspire_options['footer_layout'])) {if ($inspire_options['footer_layout'] == "none") echo "selected='selected'";} ?>>No footer</option> 
					     			<option value="widgets_footer" <?php if (isset($inspire_options['footer_layout'])) {if ($inspire_options['footer_layout'] == "widgets_footer") echo "selected='selected'";} ?>>Widgets footer only</option> 
					     			<option value="text_footer" <?php if (isset($inspire_options['footer_layout'])) {if ($inspire_options['footer_layout'] == "text_footer") echo "selected='selected'";} ?>>Text footer only</option> 
					     			<option value="both" <?php if (isset($inspire_options['footer_layout'])) {if ($inspire_options['footer_layout'] == "both") echo "selected='selected'";} ?>>Both</option> 
								</select> 
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Google Analytics</th>
							<td>
								<textarea id='google_analytics_code' name='inspire_options[google_analytics_code]' rows='5' cols='100'><?php if (isset($inspire_options['google_analytics_code'])) echo $inspire_options['google_analytics_code']; ?></textarea>
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Footer text Left</th>
							<td>
								<textarea id='footer_text_left' name='inspire_options[footer_text_left]' rows='5' cols='100'><?php if (isset($inspire_options['footer_text_left'])) echo $inspire_options['footer_text_left']; ?></textarea>
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Footer text Right</th>
							<td>
								<textarea id='footer_text_right' name='inspire_options[footer_text_right]' rows='5' cols='100'><?php if (isset($inspire_options['footer_text_right'])) echo $inspire_options['footer_text_right']; ?></textarea>
							</td>
						</tr>

					</table>

				<!-- FOOTER CAROUSEL-->

					<h3>Footer Carousel <img src="<?php echo get_template_directory_uri() . '/images/help.png' ?>"></h3>

					<div class='help'>
						<b>Footer shows: </b> <br>
						<span>
						 	Choose what posts the footer displays: random, latest or from certain category.
						</span>	
						<br><br>

						<b>Footer carousel default: </b> <br>
						<span>
							Choose to start with the footer carousel open or closed.
						</span>	
						<br><br>

						<b>Number of posts: </b> <br>
						<span>
							The number of posts that the footer carousel will load and rotate.
						</span>	
						<br><br>

						<b>Number of posts to scroll: </b> <br>
						<span>
							How many posts to scroll by at a time.
						</span>	
						<br><br>

						<b>Autoscroll every: </b> <br>
						<span>
							The number of seconds before the carousel scrolls automatically. Set to 0 to turn off autoscroll.
						</span>	
						<br><br>

						<b>Animation speed: </b> <br>
						<span>
							In milliseconds. How fast to scroll the carousel.
						</span>	
						<br><br>

					</div>

					<table id='footer_carousel' class='form-table'>

						<tr valign='top'>
							<th scope='row'>Footer carousel shows</th>
							<td>
								<select id="footer_shows" name="inspire_options[footer_shows]"> 
					     			<option value="random" <?php if (isset($inspire_options['footer_shows'])) {if ($inspire_options['footer_shows'] == "random") echo "selected='selected'";} ?>>Random posts</option> 
					     			<option value="latest" <?php if (isset($inspire_options['footer_shows'])) {if ($inspire_options['footer_shows'] == "latest") echo "selected='selected'";} ?>>Latest posts</option> 
	     							<option value="random"><hr></option> 

					     			<?php 
					     				$categories = get_categories(array(
					     					'orderby' => 'name',
					     					'order' => 'ASC'
					     				));
					     				foreach ($categories as $single_category) {
					     				?>
					     					<option value="<?php echo $single_category->name; ?>" <?php if (isset($inspire_options['footer_shows'])) {if ($inspire_options['footer_shows'] == "$single_category->name") echo "selected='selected'";} ?>><?php echo $single_category->name; ?> category</option> 
					     				<?php	     						
					     				}
					     			 ?>


								</select> 
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Footer carousel default</th>
							<td>
								<select id="footer_default" name="inspire_options[footer_default]"> 
					     			<option value="open" <?php if (isset($inspire_options['footer_default'])) {if ($inspire_options['footer_default'] == "open") echo "selected='selected'";} ?>>Open</option> 
					     			<option value="closed" <?php if (isset($inspire_options['footer_default'])) {if ($inspire_options['footer_default'] == "closed") echo "selected='selected'";} ?>>Closed</option> 
								</select> 
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Number of posts</th>
							<td>
								<input 
									type='number' 
									id='footer_num_posts' 
									name='inspire_options[footer_num_posts]' 
									min='1'
									max='100'
									value='<?php if (isset($inspire_options['footer_num_posts'])) echo esc_attr($inspire_options['footer_num_posts']); ?>'
								>
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Number of posts to scroll</th>
							<td>
								<input 
									type='number' 
									id='footer_num_posts_scroll' 
									name='inspire_options[footer_num_posts_scroll]' 
									min='1'
									max='5'
									value='<?php if (isset($inspire_options['footer_num_posts_scroll'])) echo esc_attr($inspire_options['footer_num_posts_scroll']); ?>'
								>
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Autoscroll every</th>
							<td>
								<input 
									type='number' 
									id='footer_autoscroll_sec' 
									name='inspire_options[footer_autoscroll_sec]' 
									min='0'
									max='60'
									value='<?php if (isset($inspire_options['footer_autoscroll_sec'])) echo esc_attr($inspire_options['footer_autoscroll_sec']); ?>'
								> <i>(seconds)</i>
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Animation speed</th>
							<td>
								<input 
									type='number' 
									id='footer_animation_speed' 
									name='inspire_options[footer_animation_speed]' 
									min='1'
									max='10000'
									value='<?php if (isset($inspire_options['footer_animation_speed'])) echo esc_attr($inspire_options['footer_animation_speed']); ?>'
								> <i>(milliseconds)</i>
							</td>
						</tr>


					</table>

					<?php submit_button(); ?>
					<button id="reset_all_button" name="reset_all_button" class="button-primary">Reset</button>
					<input type="hidden" id="reset_all" name="inspire_options[reset_all]" value="">

				</form>
			</div> <!-- end table container -->	

	
		</div>

	</div>

