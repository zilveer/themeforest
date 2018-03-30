<?php get_header(); ?>
	<?php
		// Check and get Sidebar Class
		$sidebar = get_option(THEME_SHORT_NAME.'_search_archive_sidebar','no-sidebar');
		$sidebar_array = gdl_get_sidebar_size( $sidebar );
	?>
	<div class="page-wrapper search-page <?php echo $sidebar_array['sidebar_class']; ?>">
		<?php
			$left_sidebar = get_option(THEME_SHORT_NAME.'_search_archive_left_sidebar');
			$right_sidebar = get_option(THEME_SHORT_NAME.'_search_archive_right_sidebar');		
				
			echo '<div class="row">';
			echo '<div class="gdl-page-left mb0 ' . $sidebar_array['page_left_class'] . '">';
			
			echo '<div class="row">';
			echo '<div class="gdl-page-item mb20 ' . $sidebar_array['page_item_class'] . '">';
			
			if( have_posts() ){
			
				// blog archive
				$item_type = '1/1 Full Thumbnail';
				$num_excerpt = get_option(THEME_SHORT_NAME.'_search_archive_num_excerpt', 285);
				$full_content = get_option(THEME_SHORT_NAME.'_search_archive_full_blog_content', 'No');

				global $blog_div_size_num_class;
				$item_class = $blog_div_size_num_class[$item_type]['class'];
				$item_size = $blog_div_size_num_class[$item_type][$sidebar_type];		

					
				echo '<div id="blog-item-holder" class="blog-item-holder">';
				print_blog_full($item_class, $item_size, $num_excerpt, $full_content);
				echo '</div>'; // blog-item-holder

				echo '<div class="clear"></div>';
				pagination();
				
			}else{

				global $gdl_admin_translator;
				if( $gdl_admin_translator == 'enable' ){
					$translator_not_found_title = get_option(THEME_SHORT_NAME.'_search_not_found_title', 'Search Not Found');
					$translator_not_found = get_option(THEME_SHORT_NAME.'_search_not_found', 
						'Sorry, but nothing matched your search criteria. Please try again with some different keywords.');
				}else{
					$translator_not_found_title = __('Search Not Found','gdl_front_end');
					$translator_not_found = __('Sorry, but nothing matched your search criteria.' . 
						' Please try again with some different keywords.','gdl_front_end');		
				}		

				echo '<div class="message-box-wrapper red">';
				echo '<div class="message-box-title">' . $translator_not_found_title . '</div>';
				echo '<div class="message-box-content">' . $translator_not_found . '</div>';
				echo '</div>'; // message box wrapper			
			
			
			}
			
			echo "</div>"; // end of gdl-page-item
			
			get_sidebar('left');	
			echo '<div class="clear"></div>';			
			echo "</div>"; // row
			echo "</div>"; // gdl-page-left

			get_sidebar('right');
			echo '<div class="clear"></div>';
			echo "</div>"; // row
		?>
		<div class="clear"></div>
	</div> <!-- page wrapper -->
<?php get_footer(); ?>
