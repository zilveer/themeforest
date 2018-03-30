<?php get_header(); ?>
	<?php
		$sidebar = get_option(THEME_SHORT_NAME.'_search_archive_sidebar','no-sidebar');
		$sidebar_class = '';
		if( $sidebar == "left-sidebar" || $sidebar == "right-sidebar"){
			$sidebar_class = "sidebar-included " . $sidebar;
		}else if( $sidebar == "both-sidebar" ){
			$sidebar_class = "both-sidebar-included";
		}
	?>
	<div class="content-wrapper <?php echo $sidebar_class; ?>">
		<div class="clear"></div>
		<div class="page-wrapper archive-wrapper">
			<?php
				$left_sidebar = "Search/Archive Left Sidebar";
				$right_sidebar = "Search/Archive Right Sidebar";		
				
				$item_type = '1/1 Full Thumbnail';
				$num_excerpt = get_option(THEME_SHORT_NAME.'_search_archive_num_excerpt', 420);

				global $blog_div_size_num_class;
				$item_class = $blog_div_size_num_class[$item_type]['class'];
				$item_index = $blog_div_size_num_class[$item_type]['index'];
				if( $sidebar == "no-sidebar" ){
					$item_size = $blog_div_size_num_class[$item_type]['size'];
				}else if ( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
					$item_size = $blog_div_size_num_class[$item_type]['size2'];
				}else{
					$item_size = $blog_div_size_num_class[$item_type]['size3'];
				}	

				// page title
				echo '<div class="sixteen columns mb0">';
				echo '<div class="gdl-page-title-wrapper">';
				echo '<h1 class="gdl-page-title gdl-title title-color">';
				_e('Search', 'gdl_front_end');
				echo '</h1>';
				echo '<div class="gdl-page-caption">';
				the_search_query();
				echo '</div>';
				echo '<div class="gdl-page-title-left-bar"></div>';
				echo '<div class="clear"></div>';
				echo '</div>'; // gdl-page-title-wrapper
				echo '</div>'; // sixteen columns
				
				echo "<div class='gdl-page-float-left'>";
				echo "<div class='gdl-page-item'>";
				
				if( have_posts() ){

					echo '<div id="blog-item-holder" class="blog-item-holder">';
					
					print_blog_full($item_class, $item_size, $item_index, $num_excerpt);
					
					echo '</div>'; // blog-item-holder
					
					echo '<div class="clear"></div>';
					
					pagination();
				
				}else{
				
					global $gdl_admin_translator;
					if( $gdl_admin_translator == 'enable' ){
						$translator_not_found = get_option(THEME_SHORT_NAME.'_search_not_found', 
							'Sorry, but nothing matched your search criteria. Please try again with some different keywords.');
					}else{
						$translator_not_found = __('Sorry, but nothing matched your search criteria.' . 
							' Please try again with some different keywords.','gdl_front_end');		
					}		
					
					echo '<div class="sixteen columns mt30">';
					echo '<h1 class="gdl-page-title gdl-divider gdl-title title-color">' . __('Search','gdl_front_end') . '</h1>';
					echo '<div class="gdl-page-content mt20">';
					echo $translator_not_found;
					echo '</div>';					
					echo '</div>';
				
				}
				
				echo "</div>"; // gdl-page-item
				
				get_sidebar('left');		
				
				echo "</div>"; // gdl-page-float-left
				
				get_sidebar('right');	
			?>
			<div class="clear"></div>
		</div>
	</div> <!-- content-wrapper -->

<?php get_footer(); ?>
