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
		<div class="page-wrapper archive-wrapper">
			<?php
				$left_sidebar = "Search/Archive Left Sidebar";
				$right_sidebar = "Search/Archive Right Sidebar";		
				
				$item_type = get_option(THEME_SHORT_NAME.'_search_archive_item_size', '1/1 Full Thumbnail');
				$num_excerpt = get_option(THEME_SHORT_NAME.'_search_archive_num_excerpt', 200);
				$full_content = get_option(THEME_SHORT_NAME.'_search_archive_full_blog_content', 'No');

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
				
				echo "<div class='gdl-page-float-left'>";
				echo "<div class='gdl-page-item'>";
				
				echo '<div id="blog-item-holder" class="blog-item-holder">';
				
				if( $item_type == '1/1 Full Thumbnail' ){	
					print_blog_full($item_class, $item_size, $item_index, $num_excerpt, $full_content);
				}else if( $item_type == '1/1 Medium Thumbnail' ){
					print_blog_medium($item_class, $item_size, $item_index, $num_excerpt);
				}
					
				echo '</div>'; // blog-item-holder
				
				echo '<div class="clear"></div>';
				
				pagination();
				
				echo "</div>"; // gdl-page-item
				
				get_sidebar('left');		
				
				echo "</div>"; // gdl-page-float-left		
				
				get_sidebar('right');	
			?>
			<div class="clear"></div>
		</div>
	</div> <!-- content-wrapper -->

<?php get_footer(); ?>
