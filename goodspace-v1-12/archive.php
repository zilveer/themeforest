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
				if( is_category() || is_tax('portfolio-category') ){
					_e('Category','gdl_front_end');
				}else if( is_tag() || is_tax('portfolio-tag') ){
					_e('Tag','gdl_front_end');
				}else if( is_day() ){
					_e('Day','gdl_front_end');
				}else if( is_month() ){
					_e('Month','gdl_front_end');
				}else if( is_year() ){
					_e('Year','gdl_front_end');
				}
				echo '</h1>';
				echo '<div class="gdl-page-caption">';
				if(is_category() || is_tag() || is_tax('portfolio-category') || is_tax('portfolio-tag') ){
					echo single_cat_title('', false);
				}else if( is_day() ){
					echo get_the_date( 'F j, Y' );
				}else if( is_month() ){
					echo get_the_date( 'F Y' );
				}else if( is_year() ){
					echo get_the_date( 'Y' );
				}
				echo '</div>';
				echo '<div class="gdl-page-title-left-bar"></div>';
				echo '<div class="clear"></div>';
				echo '</div>'; // gdl-page-title-wrapper
				echo '</div>'; // sixteen columns				
				
				echo "<div class='gdl-page-float-left'>";
				echo "<div class='gdl-page-item'>";
				
				echo '<div id="blog-item-holder" class="blog-item-holder">';
				
				print_blog_full($item_class, $item_size, $item_index, $num_excerpt);
					
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
