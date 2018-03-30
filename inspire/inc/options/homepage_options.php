	<div class="wrap">

		<div id="icon-themes" class="icon32"></div>

		<h2>Inspire - Homepage Settings</h2>

		<?php 
			//delete_option('inspire_options_hp');

			$inspire_options_hp = get_option('inspire_options_hp'); 

			//var_dump($inspire_options_hp);

			$results_slider_posts = get_posts(array(
				'numberposts'		=> -1,
				'meta_key'			=> 'cmb_slider_feature',
				'meta_value'		=> 'checked',
				'orderby'			=> 'post_date',
				'order'				=> 'DESC',
				'post_type'    		=> 'post',
				'post_status'     	=> 'publish',
				'suppress_filters'  => true,
			));

			$order_array = mb_get_updated_order_array($results_slider_posts);

		?>

		<br>
		
		<div class="options_wrapper">
		
			<div class="table_container">

				<form method="post" action="options.php" enctype="multipart/form-data">
					<?php settings_fields('group_inspire_options_hp'); ?>				<!-- very important to add these two functions as they mediate what wordpress generates automatically from the functions.php -->
					<?php do_settings_sections('handle_inspire_options_hp'); ?>		

					<?php submit_button(); ?>

				<!-- LAYOUT-->

					<h3>Layout <img src="<?php echo get_template_directory_uri() . '/images/help.png' ?>"></h3>

					<div class='help'>
						<b>Show slider. </b> <br>
						<span>
							Turn slider on/off.
						</span>	
						<br><br>

						<b>Homepage style. </b> <br>
						<span>
							- <i>Classic:</i> classic blog style.<br>
							- <i>Columns:</i> choose between 1 to 4 columns.
						</span>	
						<br><br>

					</div>

					<table class='form-table'>

						<tr valign='top'>
							<th scope='row'>Show slider</th>
							<td>
								<input class="checkbox" type="checkbox" id="show_slider" name="inspire_options_hp[show_slider]" value="checked" <?php checked(isset($inspire_options_hp['show_slider'])) ?>/> 
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Homepage style</th>
							<td>
								<select id="hp_style" name="inspire_options_hp[hp_style]"> 
					     			<option value="classic" <?php if (isset($inspire_options_hp['hp_style'])) {if ($inspire_options_hp['hp_style'] == "classic") echo "selected='selected'";} ?>>Classic</option> 
					     			<option value="1-column" <?php if (isset($inspire_options_hp['hp_style'])) {if ($inspire_options_hp['hp_style'] == "1-column") echo "selected='selected'";} ?>>1-column</option> 
					     			<option value="2-column" <?php if (isset($inspire_options_hp['hp_style'])) {if ($inspire_options_hp['hp_style'] == "2-column") echo "selected='selected'";} ?>>2-columns</option> 
					     			<option value="3-column" <?php if (isset($inspire_options_hp['hp_style'])) {if ($inspire_options_hp['hp_style'] == "3-column") echo "selected='selected'";} ?>>3-columns</option> 
					     			<option value="4-column" <?php if (isset($inspire_options_hp['hp_style'])) {if ($inspire_options_hp['hp_style'] == "4-column") echo "selected='selected'";} ?>>4-columns</option> 
								</select> 
							</td>
						</tr>

					</table>


				<!-- SLIDER ORDER-->

					<input type='hidden' id='slider_order' name='inspire_options_hp[slider_order]' value='<?php if (isset($inspire_options_hp['slider_order'])) echo ($inspire_options_hp['slider_order']); ?>'>
					
					<?php 
						if (empty($results_slider_posts)) {
						?>
							<h3><i>No posts added to slider</i></h3>
							<br>

							<table class='form-table'>
								<tr valign='top'>
									<td width='769px'>
										To add posts to your slider go to Posts > My Post. <br>
										In the Inspire Post Settings box check the checkbox "Feature this post in slider"
									</td>
								<tr>
							</table>

						<?php
						} else {
						?>
							<h3>Slider order <img src="<?php echo get_template_directory_uri() . '/images/help.png' ?>"></h3>

							<div class='help'>
								<span>
									Drag and drop to change the order of the slider posts. Top posts appear first. Remember to save changes. Clicking the "Remove" button on each post will remove the post from the slider, but will not delete the post itself. 
								</span>	
								<br><br>

							</div>

							<br>

						<?php
						}
					?>

					<ul id='slider_items_list'>
						<?php 

							for ($i = 0; $i < count($results_slider_posts); $i++) {
								$current_id = $order_array[$i];  
								//get the array key for the object from $results_slider_posts where ID is = $current_id
								for ($n = 0; $n < count($results_slider_posts); $n++) { 
									if ($results_slider_posts[$n]->ID == $current_id) {
										$current_key = $n;
										break;	
									}
								}
								$nonce = wp_create_nonce("del_slider_item_nonce");


							?>
								<li id='<?php echo $current_id; ?>'>
									<?php
										if (has_post_thumbnail($current_id)) { 
											echo get_the_post_thumbnail($current_id,'slider_order');
										} else { ?>
											<img src="<?php echo get_template_directory_uri(); ?>/images/slider-thumb.jpg" alt="" />
										<?php
										}
									?>

									<?php echo $results_slider_posts[$current_key]->post_title; ?>
									<img src="<?php echo get_template_directory_uri(); ?>/images/sort-icon.png" class="sort" alt="" />
									<button type="button" class='del_item button-secondary' data-item_id='<?php echo $current_id; ?>' data-nonce='<?php echo $nonce; ?>'>remove</button>
								</li>
							<?php
							}

						?>

					</ul>

				<br><br>

				<!-- SUBFILTER MENU-->

					<h3>Subfilter menu <img src="<?php echo get_template_directory_uri() . '/images/help.png' ?>"></h3>

					<div class='help'>
						Select what menu items to show in the subfilter (sorting) menu.
						<br><br>

					</div>

					<table class='form-table'>

						<tr valign='top'>
							<th scope='row'>Show latest</th>
							<td>
								<input class="checkbox" type="checkbox" id="subfilter_show_latest" name="inspire_options_hp[subfilter_show_latest]" value="checked" <?php checked(isset($inspire_options_hp['subfilter_show_latest'])) ?>/> 
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Show likes</th>
							<td>
								<input class="checkbox" type="checkbox" id="subfilter_show_likes" name="inspire_options_hp[subfilter_show_likes]" value="checked" <?php checked(isset($inspire_options_hp['subfilter_show_likes'])) ?>/> 
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Show comments</th>
							<td>
								<input class="checkbox" type="checkbox" id="subfilter_show_comments" name="inspire_options_hp[subfilter_show_comments]" value="checked" <?php checked(isset($inspire_options_hp['subfilter_show_comments'])) ?>/> 
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Show random</th>
							<td>
								<input class="checkbox" type="checkbox" id="subfilter_show_random" name="inspire_options_hp[subfilter_show_random]" value="checked" <?php checked(isset($inspire_options_hp['subfilter_show_random'])) ?>/> 
							</td>
						</tr>


					</table>

				<!-- FILTER MENU-->

					<?php 

						$cat_list = get_categories(array(
							'hide_empty' => 0
						));
						$cat_list = array_values($cat_list);

					 ?>

					<h3>Filter Menu <img src="<?php echo get_template_directory_uri() . '/images/help.png' ?>"></h3>

					<div class='help'>
						<b>Include the following categories in the filter menu</b> <br>
						<span>
							The filter menu is located under the slider just above the posts. With this menu you can choose to only show posts from a certain category. Choose which categories to include in the filter menu.
						</span>	
						<br><br>

						<b>Exclude the following categories from "Show all"</b> <br>
						<span>
							Exclude a certain category from the default "Show all" view. Notice that you can still include this category in the filter menu. This gives you the powerful option to make special posts (maybe a gallery, a collection of audio-posts, video-posts etc) and then group them together in a category that shows up in your filter menu but is exluded from the "Show all" view.
						</span>	
						<br><br>

					</div>

					<table class='form-table'>

						<tr valign='top'>
							<th  width='769px'>Include the following categories in the filter menu:</th>
						</tr>

					</table>

					<table class='form-table'>

						<?php 

							for ($i = 0; $i < count($cat_list); $i++) {  
							?>

								<tr valign='top'>
									<th scope='row'><?php echo $cat_list[$i]->name; ?></th>
									<td>
										<input type="checkbox" id="cat_ID[<?php echo $cat_list[$i]->cat_ID; ?>]" name="inspire_options_hp[cat_ID][<?php echo $cat_list[$i]->cat_ID; ?>]" class="checkbox" value="checked" <?php checked(isset($inspire_options_hp['cat_ID'][$cat_list[$i]->cat_ID])) ?>/> 
									</td>
								</tr>

							<?php
							}

						?>

					</table>

					<table class='form-table'>

						<tr valign='top'>
							<th  width='769px'>Exclude the following categories from "Show all":</th>
						</tr>

					</table>

					<table class='form-table'>

						<?php 

							for ($i = 0; $i < count($cat_list); $i++) {  
							?>

								<tr valign='top'>
									<th scope='row'><?php echo $cat_list[$i]->name; ?></th>
									<td>
										<input type="checkbox" id="ex_ID[<?php echo $cat_list[$i]->cat_ID; ?>]" name="inspire_options_hp[ex_ID][<?php echo $cat_list[$i]->cat_ID; ?>]" class="checkbox" value="checked" <?php checked(isset($inspire_options_hp['ex_ID'][$cat_list[$i]->cat_ID])) ?>/> 
									</td>
								</tr>

							<?php
							}

						?>

					</table>

					<?php submit_button(); ?>

				</form>
			</div> <!-- end table container -->	

	
		</div>

	</div>

