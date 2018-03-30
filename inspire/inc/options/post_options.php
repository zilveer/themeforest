	<div class="wrap">

		<div id="icon-themes" class="icon32"></div>

		<h2>Inspire - Post & Page Settings</h2>

		<?php 
			//delete_option('inspire_options_post');
			$inspire_options_post = get_option('inspire_options_post'); 

			//var_dump($inspire_options_post);
		?>

		<br>
		
		<div class="options_wrapper">
		
			<div class="table_container">

				<form method="post" action="options.php" enctype="multipart/form-data">
					<?php settings_fields('group_inspire_options_post'); ?>				<!-- very important to add these two functions as they mediate what wordpress generates automatically from the functions.php -->
					<?php do_settings_sections('handle_inspire_options_post'); ?>		

					<?php submit_button(); ?>

				<!-- POSTS-->

					<h3>Post <img src="<?php echo get_template_directory_uri() . '/images/help.png' ?>"></h3>

					<div class='help'>
						Settings for posts.<br>
						<br>
						<b>Post style : </b> <br>
						<span>
							- <i>Compact:</i> Normal size featured image and sidebar. <br>
							- <i>Full width:</i> Full width featured image.<br>
							- <i>Full width with sidebar:</i> Full width featured image with sidebar.
						</span>	
						<br><br>

					</div>

					<table class='form-table'>

						<tr valign='top'>
							<th scope='row'>Post Style</th>
							<td>
								<select id="post_style" name="inspire_options_post[post_style]"> 
					     			<option value="single" <?php if (isset($inspire_options_post['post_style'])) {if ($inspire_options_post['post_style'] == "single") echo "selected='selected'";} ?>>Compact</option> 
					     			<option value="full" <?php if (isset($inspire_options_post['post_style'])) {if ($inspire_options_post['post_style'] == "full") echo "selected='selected'";} ?>>Full width</option> 
					     			<option value="full_sidebar" <?php if (isset($inspire_options_post['post_style'])) {if ($inspire_options_post['post_style'] == "full_sidebar") echo "selected='selected'";} ?>>Full width with sidebar</option> 
								</select> 
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Show featured image</th>
							<td>
								<input type="checkbox" id="show_featured" name="inspire_options_post[show_featured]" class="checkbox" value="checked" <?php checked(isset($inspire_options_post['show_featured'])) ?>/> 
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Show post pagination</th>
							<td>
								<input type="checkbox" id="show_pagination" name="inspire_options_post[show_pagination]" class="checkbox" value="checked" <?php checked(isset($inspire_options_post['show_pagination'])) ?>/> 
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Show share buttons</th>
							<td>
								<input type="checkbox" id="show_share" name="inspire_options_post[show_share]" class="checkbox" value="checked" <?php checked(isset($inspire_options_post['show_share'])) ?>/> 
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Show comments</th>
							<td>
								<input type="checkbox" id="show_comments" name="inspire_options_post[show_comments]" class="checkbox" value="checked" <?php checked(isset($inspire_options_post['show_comments'])) ?>/> 
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Share buttons closed by default</th>
							<td>
								<input type="checkbox" id="share_buttons_closed_default" name="inspire_options_post[share_buttons_closed_default]" class="checkbox" value="checked" <?php checked(isset($inspire_options_post['share_buttons_closed_default'])) ?>/> 
							</td>
						</tr>

					</table>

				<!-- PAGES-->

					<h3>Page <img src="<?php echo get_template_directory_uri() . '/images/help.png' ?>"></h3>

					<div class='help'>
						<span>
							Settings for pages.
						</span>	
						<br><br>
					</div>

					<table class='form-table'>

						<tr valign='top'>
							<th scope='row'>Show author byline</th>
							<td>
								<input type="checkbox" id="page_show_byline" name="inspire_options_post[page_show_byline]" class="checkbox" value="checked" <?php checked(isset($inspire_options_post['page_show_byline'])) ?>/> 
							</td>
						</tr>

						<tr valign='top'>
							<th scope='row'>Show share buttons</th>
							<td>
								<input type="checkbox" id="page_show_share" name="inspire_options_post[page_show_share]" class="checkbox" value="checked" <?php checked(isset($inspire_options_post['page_show_share'])) ?>/> 
							</td>
						</tr>

					</table>

					<?php submit_button(); ?>

				</form>
			</div> <!-- end table container -->	

	
		</div>

	</div>

