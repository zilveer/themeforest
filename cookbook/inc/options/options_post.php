	<div class="wrap">

		<div id="icon-themes" class="icon32"></div>

		<h2><?php printf( "%s %s - %s", esc_attr(wp_get_theme()->Name), esc_attr(__("Settings", "loc_canon")), esc_attr(__("Posts & Pages", "loc_canon")) ); ?></h2>

		<?php 
			//delete_option('canon_options_post');

			// GET VARS
			$canon_options_post = get_option('canon_options_post'); 
			$canon_theme_name = wp_get_theme()->Name;

			// ARRAY VALUES
			$canon_options_post['archive_ads'] = array_values($canon_options_post['archive_ads']);
			update_option('canon_options_post', $canon_options_post);

			// var_dump($canon_options_post);
		
			// GET ARRAY OF REGISTERED SIDEBARS
			$registered_sidebars_array = array();
			foreach ($GLOBALS['wp_registered_sidebars'] as $key => $value) { array_push($registered_sidebars_array, $value); }



		?>

		<br>
		
		<div class="options_wrapper canon-options">
		
			<div class="table_container">

				<form method="post" action="options.php" enctype="multipart/form-data">
					<?php settings_fields('group_canon_options_post'); ?>				<!-- very important to add these two functions as they mediate what wordpress generates automatically from the functions.php -->
					<?php do_settings_sections('handle_canon_options_post'); ?>		


					<?php submit_button(); ?>
					
					<!-- 

						INDEX

						BLOG
						CATEGORY
						OTHER ARCHIVE PAGES
						ALL ARCHIVE PAGES
						SINGLE POST
						SEARCH 
						404
						ARCHIVE ADS
						WOOCOMMERCE
						BUDDYPRESS
						BBPRESS
						THE EVENTS CALENDAR BY TRIBE
					
					-->


					<!-- 
					--------------------------------------------------------------------------
						BLOG
				    -------------------------------------------------------------------------- 
					-->

						<h3 class="group-page-setups"><?php _e("Blog", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help group-page-setups'>
							
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Layout', 'loc_canon'),
									'content' 				=> array(
										__('Choose between full width or sidebar layout.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Sidebar', 'loc_canon'),
									'content' 				=> array(
										__('Select what widget area to use in sidebar if sidebar layout is selected.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Style', 'loc_canon'),
									'content' 				=> array(
										__('Choose between classic or masonry style.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Masonry columns', 'loc_canon'),
									'content' 				=> array(
										__('Number of columns if masonry style is selected.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Excerpt length', 'loc_canon'),
									'content' 				=> array(
										__('Set the excerpt length in aprox. number of characters before cut-off.', 'loc_canon'),
									),
								)); 

							?>

						</div>

						<table class='form-table blog-section group-page-setups'>

							<?php 

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Blog Layout', 'loc_canon'),
									'slug' 					=> 'blog_layout',
									'select_options'		=> array(
										'full'				=> __('Full width', 'loc_canon'),
										'sidebar'			=> __('Sidebar', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_post',
								)); 

							?>


							<tr valign='top' class="dynamic_option" data-listen_to="#blog_layout" data-listen_for="sidebar">

								<th scope='row'><?php _e("Sidebar for blog pages", "loc_canon"); ?></th>
								<td>
									<select name="canon_options_post[blog_sidebar]">
										<?php 
											for ($i = 0; $i < count($registered_sidebars_array); $i++) { 
											?>
							     				<option value="<?php echo esc_attr($registered_sidebars_array[$i]['id']); ?>" <?php if (isset($canon_options_post['blog_sidebar'])) {if ($canon_options_post['blog_sidebar'] ==  $registered_sidebars_array[$i]['id']) echo "selected='selected'";} ?>><?php echo esc_attr($registered_sidebars_array[$i]['name']); ?></option> 
											<?php
											}
										?>
									</select> 
								</td>

							</tr>


							<?php

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Blog Style', 'loc_canon'),
									'slug' 					=> 'blog_style',
									'select_options'		=> array(
										'classic'				=> __('Classic', 'loc_canon'),
										'masonry'				=> __('Masonry', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Masonry columns', 'loc_canon'),
									'slug' 					=> 'blog_masonry_columns',
									'listen_to'				=> '#blog_style',						// optional
									'listen_for'			=> 'masonry',							// optional
									'min'					=> '1',									// optional
									'max'					=> '4',									// optional
									'step'					=> '1',									// optional
									'width_px'				=> '60',								// optional
									'postfix'				=> '(columns)',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Excerpt length', 'loc_canon'),
									'slug' 					=> 'blog_excerpt_length',
									'min'					=> '1',									// optional
									'max'					=> '1000',								// optional
									'step'					=> '1',									// optional
									'width_px'				=> '60',								// optional
									'postfix'				=> '(characters)',
									'options_name'			=> 'canon_options_post',
								)); 

							?>

							<?php 



							?>




						</table>

					<!-- 
					--------------------------------------------------------------------------
						CATEGORY
				    -------------------------------------------------------------------------- 
					-->

						<h3 class="group-page-setups"><?php _e("Category", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help group-page-setups'>
							
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Layout', 'loc_canon'),
									'content' 				=> array(
										__('Choose between full width or sidebar layout.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Sidebar', 'loc_canon'),
									'content' 				=> array(
										__('Select what widget area to use in sidebar if sidebar layout is selected.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Style', 'loc_canon'),
									'content' 				=> array(
										__('Choose between classic or masonry style.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Masonry columns', 'loc_canon'),
									'content' 				=> array(
										__('Number of columns if masonry style is selected.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Excerpt length', 'loc_canon'),
									'content' 				=> array(
										__('Set the excerpt length in aprox. number of characters before cut-off.', 'loc_canon'),
									),
								)); 

							?>

						</div>

						<table class='form-table cat-section group-page-setups'>

							<?php 

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Category Layout', 'loc_canon'),
									'slug' 					=> 'cat_layout',
									'select_options'		=> array(
										'full'				=> __('Full width', 'loc_canon'),
										'sidebar'			=> __('Sidebar', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_post',
								)); 

							?>
								

							<tr valign='top' class="dynamic_option" data-listen_to="#cat_layout" data-listen_for="sidebar">

								<th scope='row'><?php _e("Sidebar for category pages", "loc_canon"); ?></th>
								<td>
									<select name="canon_options_post[cat_sidebar]">
										<?php 
											for ($i = 0; $i < count($registered_sidebars_array); $i++) { 
											?>
							     				<option value="<?php echo esc_attr($registered_sidebars_array[$i]['id']); ?>" <?php if (isset($canon_options_post['cat_sidebar'])) {if ($canon_options_post['cat_sidebar'] ==  $registered_sidebars_array[$i]['id']) echo "selected='selected'";} ?>><?php echo esc_attr($registered_sidebars_array[$i]['name']); ?></option> 
											<?php
											}
										?>
									</select> 
								</td>

							</tr>


							<?php

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Category Style', 'loc_canon'),
									'slug' 					=> 'cat_style',
									'select_options'		=> array(
										'classic'				=> __('Classic', 'loc_canon'),
										'masonry'				=> __('Masonry', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Masonry columns', 'loc_canon'),
									'slug' 					=> 'cat_masonry_columns',
									'listen_to'				=> '#cat_style',						// optional
									'listen_for'			=> 'masonry',							// optional
									'min'					=> '1',									// optional
									'max'					=> '4',									// optional
									'step'					=> '1',									// optional
									'width_px'				=> '60',								// optional
									'postfix'				=> '(columns)',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Excerpt length', 'loc_canon'),
									'slug' 					=> 'cat_excerpt_length',
									'min'					=> '1',									// optional
									'max'					=> '1000',								// optional
									'step'					=> '1',									// optional
									'width_px'				=> '60',								// optional
									'postfix'				=> '(characters)',
									'options_name'			=> 'canon_options_post',
								)); 

							?>



						</table>

					<!-- 
					--------------------------------------------------------------------------
						OTHER ARCHIVE PAGES
				    -------------------------------------------------------------------------- 
					-->

						<h3 class="group-page-setups"><?php _e("Other archive pages", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help group-page-setups'>
							
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Layout', 'loc_canon'),
									'content' 				=> array(
										__('Choose between full width or sidebar layout.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Sidebar', 'loc_canon'),
									'content' 				=> array(
										__('Select what widget area to use in sidebar if sidebar layout is selected.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Style', 'loc_canon'),
									'content' 				=> array(
										__('Choose between classic or masonry style.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Masonry columns', 'loc_canon'),
									'content' 				=> array(
										__('Number of columns if masonry style is selected.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Excerpt length', 'loc_canon'),
									'content' 				=> array(
										__('Set the excerpt length in aprox. number of characters before cut-off.', 'loc_canon'),
									),
								)); 
							?>

						</div>

						<table class='form-table archive-section group-page-setups'>

							<?php 

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Archive Layout', 'loc_canon'),
									'slug' 					=> 'archive_layout',
									'select_options'		=> array(
										'full'				=> __('Full width', 'loc_canon'),
										'sidebar'			=> __('Sidebar', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_post',
								)); 

							?>
								

							<tr valign='top' class="dynamic_option" data-listen_to="#archive_layout" data-listen_for="sidebar">

								<th scope='row'><?php _e("Sidebar for archive pages", "loc_canon"); ?></th>
								<td>
									<select name="canon_options_post[archive_sidebar]">
										<?php 
											for ($i = 0; $i < count($registered_sidebars_array); $i++) { 
											?>
							     				<option value="<?php echo esc_attr($registered_sidebars_array[$i]['id']); ?>" <?php if (isset($canon_options_post['archive_sidebar'])) {if ($canon_options_post['archive_sidebar'] ==  $registered_sidebars_array[$i]['id']) echo "selected='selected'";} ?>><?php echo esc_attr($registered_sidebars_array[$i]['name']); ?></option> 
											<?php
											}
										?>
									</select> 
								</td>

							</tr>


							<?php

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Archive Style', 'loc_canon'),
									'slug' 					=> 'archive_style',
									'select_options'		=> array(
										'classic'				=> __('Classic', 'loc_canon'),
										'masonry'				=> __('Masonry', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Masonry columns', 'loc_canon'),
									'slug' 					=> 'archive_masonry_columns',
									'listen_to'				=> '#archive_style',					// optional
									'listen_for'			=> 'masonry',							// optional
									'min'					=> '1',									// optional
									'max'					=> '4',									// optional
									'step'					=> '1',									// optional
									'width_px'				=> '60',								// optional
									'postfix'				=> '(columns)',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Excerpt length', 'loc_canon'),
									'slug' 					=> 'archive_excerpt_length',
									'min'					=> '1',									// optional
									'max'					=> '1000',								// optional
									'step'					=> '1',									// optional
									'width_px'				=> '60',								// optional
									'postfix'				=> '(characters)',
									'options_name'			=> 'canon_options_post',
								)); 

							?>



						</table>



					<!-- HORIZONTAL DIVIDER -->
					<br><hr><br>


					<!-- 
					--------------------------------------------------------------------------
						ALL ARCHIVE PAGES
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("All archive pages", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Archive pages', 'loc_canon'),
									'content' 				=> array(
										__('Archive pages list groups of posts and include pages such as blog, category pages, search result pages, author pages, tag pages, date pages etc.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Show archive title', 'loc_canon'),
									'content' 				=> array(
										__('Displays the archive title at the top of the archive page.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Show category description', 'loc_canon'),
									'content' 				=> array(
										__('Displays the category description at the top of category pages.', 'loc_canon'),
										__('You can set the category description at <i>Posts > Categories > Your category > Description</i>.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Show author box on author pages', 'loc_canon'),
									'content' 				=> array(
										__('Displays an "about the author" box at the top of author pages.', 'loc_canon'),
										__('You can set the author description at <i>Users > Your author > About the user > Biographical Info</i>.', 'loc_canon'),
										__('Also notice that you can enter URLs for social accounts (Twitter, Facebook etc.) under Contact Info. These URLs will be displayed as icons in the author box.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Show meta info', 'loc_canon'),
									'content' 				=> array(
										__('Choose what meta info to display on archive pages.', 'loc_canon'),
									),
								)); 

							 ?>		

						</div>

						<table class='form-table archive-pages-section'>


							<?php 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Show archive title', 'loc_canon'),
									'slug' 					=> 'show_archive_title',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Show category description', 'loc_canon'),
									'slug' 					=> 'show_cat_description',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Show author box on author pages', 'loc_canon'),
									'slug' 					=> 'show_archive_author_box',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'separator',
									'colspan'				=> '2',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Show meta info: publish date', 'loc_canon'),
									'slug' 					=> 'show_meta_date',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Show meta info: comments count', 'loc_canon'),
									'slug' 					=> 'show_meta_comments',
									'options_name'			=> 'canon_options_post',
								)); 

							 ?>	

						</table>


					<!-- 
					--------------------------------------------------------------------------
						SINGLE POST
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Single Post", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Show post meta', 'loc_canon'),
									'content' 				=> array(
										__('Displays categories and publish date.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Show post navigation', 'loc_canon'),
									'content' 				=> array(
										__('Adds post navigation to posts. Use this to navigate between previous and next post relative to the current post.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Show comments', 'loc_canon'),
									'content' 				=> array(
										__('Displays comments and comment reply form.', 'loc_canon'),
									),
								)); 

							 ?>		

						</div>

						<table class='form-table'>

							<?php 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Show post meta', 'loc_canon'),
									'slug' 					=> 'show_post_meta',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Show post navigation', 'loc_canon'),
									'slug' 					=> 'show_post_nav',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Show comments', 'loc_canon'),
									'slug' 					=> 'show_comments',
									'options_name'			=> 'canon_options_post',
								)); 

							 ?>	

						</table>



					<!-- 
					--------------------------------------------------------------------------
						SEARCH 
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Search", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Search box text', 'loc_canon'),
									'content' 				=> array(
										__('The text that displays inside the search box.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Search post types', 'loc_canon'),
									'content' 				=> array(
										__('Select what post types to include in search. Notice that deselecting all post types will result in no filters being applied to search (default WordPress behaviour) and all post types containing the search term will be returned on the search results page. This may not always be what you want as a lot of custom post types are for internal theme/plugin use only and are not meant to be viewed as regular posts. Correct styling and functionality of search results can only be guaranteed for posts and pages. Including custom post types in search is to be viewed as "experimental" and is "use-at-own-risk".', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Custom post types', 'loc_canon'),
									'content' 				=> array(
										__('What custom post types to include in search when Search custom post types has been selected. Separate with commas. Notice that you need to put in the custom post type slug. If you are unsure what the slug of a certain custom post type is please consult the plugin documentation or the plugin author.', 'loc_canon'),
									),
								)); 

							?>

						</div>

						<table class='form-table'>

							<?php
								
								fw_option(array(
									'type'					=> 'text',
									'title' 				=> __('Search box text', 'loc_canon'),
									'slug' 					=> 'search_box_text',
									'class'					=> 'widefat',
									'options_name'			=> 'canon_options_post',
								)); 
							
								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Search posts', 'loc_canon'),
									'slug' 					=> 'search_posts',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Search pages', 'loc_canon'),
									'slug' 					=> 'search_pages',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Search custom post types', 'loc_canon'),
									'slug' 					=> 'search_cpt',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'text',
									'title' 				=> __('Custom post types', 'loc_canon'),
									'slug' 					=> 'search_cpt_source',
									'class'					=> 'widefat',
									'options_name'			=> 'canon_options_post',
								)); 
							
							?>			

						</table>

					<!-- 
					--------------------------------------------------------------------------
						404
				    -------------------------------------------------------------------------- 
					-->

						<h3>404 <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('404 layout', 'loc_canon'),
									'content' 				=> array(
										__('Choose between full width or sidebar layout.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('404 title', 'loc_canon'),
									'content' 				=> array(
										__('Title that displays on the 404-page.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('404 message', 'loc_canon'),
									'content' 				=> array(
										__('Message to display on the 404-page.', 'loc_canon'),
									),
								)); 

							?>
						</div>

						<table class='form-table'>

							<?php 

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('404 Layout', 'loc_canon'),
									'slug' 					=> '404_layout',
									'select_options'		=> array(
										'full'				=> __('Full width', 'loc_canon'),
										'sidebar'			=> __('Sidebar', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_post',
								)); 

							?>
								

							<tr valign='top' class="dynamic_option" data-listen_to="#404_layout" data-listen_for="sidebar">

								<th scope='row'><?php _e("Sidebar for 404 page", "loc_canon"); ?></th>
								<td>
									<select name="canon_options_post[404_sidebar]">
										<?php 
											for ($i = 0; $i < count($registered_sidebars_array); $i++) { 
											?>
							     				<option value="<?php echo esc_attr($registered_sidebars_array[$i]['id']); ?>" <?php if (isset($canon_options_post['404_sidebar'])) {if ($canon_options_post['404_sidebar'] ==  $registered_sidebars_array[$i]['id']) echo "selected='selected'";} ?>><?php echo esc_attr($registered_sidebars_array[$i]['name']); ?></option> 
											<?php
											}
										?>
									</select> 
								</td>

							</tr>

							<?php
								
								fw_option(array(
									'type'					=> 'text',
									'title' 				=> __('404 title', 'loc_canon'),
									'slug' 					=> '404_title',
									'class'					=> 'widefat',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'textarea',
									'title' 				=> __('404 message', 'loc_canon'),
									'slug' 					=> '404_msg',
									'cols'					=> '100',
									'rows'					=> '5',
									'options_name'			=> 'canon_options_post',
								)); 
							
							?>			

						</table>
						

					<!-- 
					--------------------------------------------------------------------------
						ARCHIVE ADS
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Archive ads", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Ads', 'loc_canon'),
									'content' 				=> array(
										__('Use this control to put ads in your archive posts stream. Use the Add and Delete buttons to add and remove ads.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Show ad after post number', 'loc_canon'),
									'content' 				=> array(
										__('Your ad will show up after these number of posts on archive pages. You can add more posts separated by comma. "5, 10" will make your ad appear after post number 5 and 10 on archive page.', 'loc_canon'),
										__('Do notice that these numbers are NOT the id of each individual post - they are simply how many posts to display before an ad will appear.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Ad code', 'loc_canon'),
									'content' 				=> array(
										__('The ad code. If you are unsure what code to use you should consult your ad-provider.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Show on', 'loc_canon'),
									'content' 				=> array(
										__('Select what archive pages to put this ad on.', 'loc_canon'),
									),
								)); 


							?>
						</div>

						<table class='form-table archive_ads'>

							<tr valign='top' class='archive_ads_row'>
								<th scope='row'><?php _e("Ads", "loc_canon"); ?></th>
								<td>
									<ul class="ul_sortable"  data-split_index="2" data-placeholder="ul_sortable_archive_ads_placeholder">

										<?php for ($i = 0; $i < count($canon_options_post['archive_ads']); $i++) : ?>

											<li>

												<p>
													<button class="button ul_del_this right"><?php _e("delete", "loc_canon"); ?></button>
													<label><?php _e("Show ad after post number", "loc_canon"); ?></label><br>
													<input type='text' class='li_option widefat' name='canon_options_post[archive_ads][<?php echo esc_attr($i); ?>][append_to_posts]' value='<?php if (isset($canon_options_post['archive_ads'][$i]['append_to_posts'])) echo esc_attr($canon_options_post['archive_ads'][$i]['append_to_posts']); ?>'>
												</p>

												<p>
													<label><?php _e("Ad code", "loc_canon"); ?></label><br>
													<textarea 
														id='ad_code_id' 
														name='canon_options_post[archive_ads][<?php echo esc_attr($i); ?>][ad_code]' 
														class="li_option" 
														cols=5
														rows=10
													><?php if (isset($canon_options_post['archive_ads'][$i]['ad_code'])) echo esc_attr($canon_options_post['archive_ads'][$i]['ad_code']); ?></textarea>
												</p>

												<p class="archive_ads_checkboxes">

														<span><?php _e("Show on", "loc_canon"); ?>: </span>
														<span>
															<input class="li_option" type="hidden" name="canon_options_post[archive_ads][<?php echo esc_attr($i); ?>][show_ads_blog]" value="unchecked" />
															<input class="checkbox li_option" type="checkbox" id="show_ads_blog" name="canon_options_post[archive_ads][<?php echo esc_attr($i); ?>][show_ads_blog]" value="checked" <?php if (isset($canon_options_post['archive_ads'][$i]['show_ads_blog'])) { checked($canon_options_post['archive_ads'][$i]['show_ads_blog'] == "checked"); } ?>/> <?php _e("Blog", "loc_canon"); ?>
														</span>
														<span>
															<input class="li_option" type="hidden" name="canon_options_post[archive_ads][<?php echo esc_attr($i); ?>][show_ads_category]" value="unchecked" />
															<input class="checkbox li_option" type="checkbox" id="show_ads_category" name="canon_options_post[archive_ads][<?php echo esc_attr($i); ?>][show_ads_category]" value="checked" <?php if (isset($canon_options_post['archive_ads'][$i]['show_ads_category'])) { checked($canon_options_post['archive_ads'][$i]['show_ads_category'] == "checked"); } ?>/> <?php _e("Category", "loc_canon"); ?>
														</span>
														<span>
															<input class="li_option" type="hidden" name="canon_options_post[archive_ads][<?php echo esc_attr($i); ?>][show_ads_archive]" value="unchecked" />
															<input class="checkbox li_option" type="checkbox" id="show_ads_archive" name="canon_options_post[archive_ads][<?php echo esc_attr($i); ?>][show_ads_archive]" value="checked" <?php if (isset($canon_options_post['archive_ads'][$i]['show_ads_archive'])) { checked($canon_options_post['archive_ads'][$i]['show_ads_archive'] == "checked"); } ?>/> <?php _e("Other archive pages", "loc_canon"); ?>
														</span>

												</p>


											</li>

										<?php endfor; ?>

									</ul>

									<div class="ul_control" data-min="1" data-max="1000">
										<input type="button" class="button ul_add" value="<?php _e("Add", "loc_canon"); ?>" />
										<input type="button" class="button ul_del" value="<?php _e("Delete", "loc_canon"); ?>" />
									</div>

								</td>
							</tr>

						</table>



					<?php 

						if (is_plugin_active('woocommerce/woocommerce.php')) {
						?>

					<!-- 
					--------------------------------------------------------------------------
						WOOCOMMERCE
				    -------------------------------------------------------------------------- 
					-->

							<h3>WooCommerce <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

							<div class='contextual-help'>
								<?php 

									fw_option_help(array(
										'type'					=> 'standard',
										'title' 				=> __('Use sidebar on shop and product pages', 'loc_canon'),
										'content' 				=> array(
											__('Choose to have a sidebar displayed on your shop and product pages.', 'loc_canon'),
										),
									)); 

									fw_option_help(array(
										'type'					=> 'standard',
										'title' 				=> __('What about the other WooCommerce pages?', 'loc_canon'),
										'content' 				=> array(
											__('Other WooCommerce pages use ordinary page templates. You can change which template to use for each of the WooCommerce pages (sidebar or full width page templates).', 'loc_canon'),
										),
									)); 

									fw_option_help(array(
										'type'					=> 'standard',
										'title' 				=> __('Sidebar for shop and product pages', 'loc_canon'),
										'content' 				=> array(
											__('Choose which sidebar to use for shop and product pages.', 'loc_canon'),
										),
									)); 

								?>

							</div>

							<table class='form-table'>

								<?php
								
									fw_option(array(
										'type'					=> 'checkbox',
										'title' 				=> __('Use sidebar on shop and product pages', 'loc_canon'),
										'slug' 					=> 'use_woocommerce_sidebar',
										'options_name'			=> 'canon_options_post',
									)); 

								?>

								<?php 

									// get array of registered sidebars
									$registered_sidebars_array = array();

									foreach ($GLOBALS['wp_registered_sidebars'] as $key => $value) {
										array_push($registered_sidebars_array, $value);
									}


								?>

								<tr valign='top'>
									<th scope='row'><?php _e("Sidebar for shop and product pages", "loc_canon"); ?></th>
									<td>
										<select name="canon_options_post[woocommerce_sidebar]">
											<?php 
												for ($i = 0; $i < count($registered_sidebars_array); $i++) { 
												?>
								     				<option value="<?php echo esc_attr($registered_sidebars_array[$i]['id']); ?>" <?php if (isset($canon_options_post['woocommerce_sidebar'])) {if ($canon_options_post['woocommerce_sidebar'] ==  $registered_sidebars_array[$i]['id']) echo "selected='selected'";} ?>><?php echo esc_attr($registered_sidebars_array[$i]['name']); ?></option> 
												<?php
												}
											?>
										</select> 
									</td>
								</tr>


							</table>

						 		
						<?php	
						}
					?>
					

					<?php 

						if (function_exists('bp_is_active')) {
						?>

					<!-- 
					--------------------------------------------------------------------------
						BUDDYPRESS
				    -------------------------------------------------------------------------- 
					-->

							<h3>BuddyPress <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

							<div class='contextual-help'>
								<?php 

									fw_option_help(array(
										'type'					=> 'standard',
										'title' 				=> __('Sidebar on BuddyPress pages', 'loc_canon'),
										'content' 				=> array(
											__('Choose to have a sidebar displayed on your BuddyPress pages.', 'loc_canon'),
										),
									)); 

									fw_option_help(array(
										'type'					=> 'standard',
										'title' 				=> __('Sidebar for BuddyPress pages', 'loc_canon'),
										'content' 				=> array(
											__('Choose which sidebar to use for your BuddyPress pages.', 'loc_canon'),
										),
									)); 

								?>

							</div>

							<table class='form-table'>

								<?php
								
									fw_option(array(
										'type'					=> 'checkbox',
										'title' 				=> __('Sidebar on BuddyPress pages', 'loc_canon'),
										'slug' 					=> 'use_buddypress_sidebar',
										'options_name'			=> 'canon_options_post',
									)); 

								?>

								<?php 

									// get array of registered sidebars
									$registered_sidebars_array = array();

									foreach ($GLOBALS['wp_registered_sidebars'] as $key => $value) {
										array_push($registered_sidebars_array, $value);
									}


								?>

								<tr valign='top'>
									<th scope='row'><?php _e("Sidebar for BuddyPress pages", "loc_canon"); ?></th>
									<td>
										<select name="canon_options_post[buddypress_sidebar]">
											<?php 
												for ($i = 0; $i < count($registered_sidebars_array); $i++) { 
												?>
								     				<option value="<?php echo esc_attr($registered_sidebars_array[$i]['id']); ?>" <?php if (isset($canon_options_post['buddypress_sidebar'])) {if ($canon_options_post['buddypress_sidebar'] ==  $registered_sidebars_array[$i]['id']) echo "selected='selected'";} ?>><?php echo esc_attr($registered_sidebars_array[$i]['name']); ?></option> 
												<?php
												}
											?>
										</select> 
									</td>
								</tr>


							</table>

						 		
						<?php	
						}
					?>


					<?php 

						if (class_exists('bbPress')) {
						?>

					<!-- 
					--------------------------------------------------------------------------
						BBPRESS
				    -------------------------------------------------------------------------- 
					-->

							<h3>bbPress <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

							<div class='contextual-help'>
								<?php 

									fw_option_help(array(
										'type'					=> 'standard',
										'title' 				=> __('Sidebar on bbPress pages', 'loc_canon'),
										'content' 				=> array(
											__('Choose to have a sidebar displayed on your bbPress pages.', 'loc_canon'),
										),
									)); 

									fw_option_help(array(
										'type'					=> 'standard',
										'title' 				=> __('Sidebar for bbPress pages', 'loc_canon'),
										'content' 				=> array(
											__('Choose which sidebar to use for your bbPress pages.', 'loc_canon'),
										),
									)); 

								?>

							</div>

							<table class='form-table'>

								<?php
								
									fw_option(array(
										'type'					=> 'checkbox',
										'title' 				=> __('Sidebar on bbPress pages', 'loc_canon'),
										'slug' 					=> 'use_bbpress_sidebar',
										'options_name'			=> 'canon_options_post',
									)); 

								?>

								<?php 

									// get array of registered sidebars
									$registered_sidebars_array = array();

									foreach ($GLOBALS['wp_registered_sidebars'] as $key => $value) {
										array_push($registered_sidebars_array, $value);
									}


								?>

								<tr valign='top'>
									<th scope='row'><?php _e("Sidebar for bbPress pages", "loc_canon"); ?></th>
									<td>
										<select name="canon_options_post[bbpress_sidebar]">
											<?php 
												for ($i = 0; $i < count($registered_sidebars_array); $i++) { 
												?>
								     				<option value="<?php echo esc_attr($registered_sidebars_array[$i]['id']); ?>" <?php if (isset($canon_options_post['bbpress_sidebar'])) {if ($canon_options_post['bbpress_sidebar'] ==  $registered_sidebars_array[$i]['id']) echo "selected='selected'";} ?>><?php echo esc_attr($registered_sidebars_array[$i]['name']); ?></option> 
												<?php
												}
											?>
										</select> 
									</td>
								</tr>


							</table>

						 		
						<?php	
						}
					?>
					

					<?php 

						if (class_exists('Tribe__Events__Main')) {
						?>

					<!-- 
					--------------------------------------------------------------------------
						THE EVENTS CALENDAR BY TRIBE
				    -------------------------------------------------------------------------- 
					-->

							<h3>The Events Calendar <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

							<div class='contextual-help'>
								<?php 

									fw_option_help(array(
										'type'					=> 'standard',
										'title' 				=> __('Sidebar on Events pages', 'loc_canon'),
										'content' 				=> array(
											__('Choose to have a sidebar displayed on your Events pages. Make sure you are using the Default Events Template (Events > Settings > Display > Events Template).', 'loc_canon'),
										),
									)); 

									fw_option_help(array(
										'type'					=> 'standard',
										'title' 				=> __('Sidebar for Events pages', 'loc_canon'),
										'content' 				=> array(
											__('Choose which sidebar to use for your Events pages.', 'loc_canon'),
										),
									)); 

								?>

							</div>

							<table class='form-table'>

								<?php
								
									fw_option(array(
										'type'					=> 'checkbox',
										'title' 				=> __('Sidebar on Events pages', 'loc_canon'),
										'slug' 					=> 'use_events_sidebar',
										'options_name'			=> 'canon_options_post',
									)); 

								?>

								<tr valign='top'>
									<th scope='row'><?php _e("Sidebar for Events pages", "loc_canon"); ?></th>
									<td>
										<select name="canon_options_post[events_sidebar]">
											<?php 
												for ($i = 0; $i < count($registered_sidebars_array); $i++) { 
												?>
								     				<option value="<?php echo esc_attr($registered_sidebars_array[$i]['id']); ?>" <?php if (isset($canon_options_post['events_sidebar'])) {if ($canon_options_post['events_sidebar'] ==  $registered_sidebars_array[$i]['id']) echo "selected='selected'";} ?>><?php echo esc_attr($registered_sidebars_array[$i]['name']); ?></option> 
												<?php
												}
											?>
										</select> 
									</td>
								</tr>


							</table>

						 		
						<?php	
						}
					?>
					

					<!-- END OPTIONS AND WRAP UP FILE -->

					<?php submit_button(); ?>

				</form>
			</div> <!-- end table container -->	

	
		</div>

	</div>

