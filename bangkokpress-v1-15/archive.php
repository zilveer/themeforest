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

				global $gdl_admin_translator;
				if( $gdl_admin_translator == 'enable' ){
					$translator_continue_reading = get_option(THEME_SHORT_NAME.'_translator_continue_reading', '[...]');
				}else{
					$translator_continue_reading = __('[...]','gdl_front_end');
				}				
				
				$full_content = get_option(THEME_SHORT_NAME.'_search_archive_full_blog_content', 'No');
				$num_excerpt = get_option(THEME_SHORT_NAME.'_search_archive_num_excerpt', 200);
				$archive_size = get_option(THEME_SHORT_NAME.'_search_archive_size', '1/2');
				$page_background = get_option(THEME_SHORT_NAME.'_search_archive_background','No');				
				
				$archive_img_size = array(
					"1/4" => array("index"=>"0" ,"class"=>"four columns", "size"=>"386x386", "size2"=>"386x386"),
					"1/3" => array("index"=>"1" ,"class"=>"one-third column", "size"=>"386x386", "size2"=>"386x386"),
					"1/2" => array("index"=>"2" ,"class"=>"eight columns", "size"=>"433x191", "size2"=>"426x188"),
					"1/1" => array("index"=>"3" ,"class"=>"sixteen columns", "size"=>"886x300", "size2"=>"586x198")
				);			
						
				$item_class = $archive_img_size[$archive_size]['class'];
				if( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
					$item_size = $archive_img_size[$archive_size]['size2'];
				}else{
					$item_size = $archive_img_size[$archive_size]['size'];
				}	

				echo "<div class='gdl-page-float-left'>";
				
				echo "<div class='gdl-page-item'>";
				
				if( $page_background != 'No' ){
					echo "<div class='sixteen columns'>";
					echo '<div class="page-bkp-frame-wrapper">';
					echo '<div class="page-bkp-frame">';
				}					
				
				echo '<div class="blog-item-holder grid-style">';
				while( have_posts() ){
	
					the_post();
					
					if( $post->post_type == 'testimonial' || $post->post_type == 'price_table' || $post->post_type == 'gallery'){ continue; }

					echo '<div class="blog-item blog-item-grid ' . $item_class . '">'; 
					
					echo '<div class="bkp-frame-wrapper">';
					echo '<div class="position-relative">';
					echo '<div class="bkp-frame">';
					
					// Blog thumbnail media
					$thumbnail_type = get_post_meta( get_the_ID(), 'post-option-thumbnail-types', true);
					print_gdl_blog_thumbnail( $thumbnail_type, $item_size );
					
					echo '<div class="blog-thumbnail-context">';
					
					// Blog thumbnail title
					echo '<div class="blog-thumbnail-title-wrapper">';
					echo '<h2 class="blog-thumbnail-title post-title-color gdl-title">';
					echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';
					echo '</h2>';
					
					echo '<div class="blog-thumbnail-comment">';
					comments_popup_link( '0', '1', '%', '', '0' );
					echo '</div>';
					echo '</div>';
					
					// Blog thumbnail Content
					echo '<div class="blog-thumbnail-content">';
					if( $archive_size == '1/1' && $full_content == 'Yes' ){
						the_content();
					}else{					
						echo mb_substr( get_the_excerpt(), 0, $num_excerpt );
						echo '<a class="blog-continue-reading" href="' . get_permalink() . '">' . $translator_continue_reading . '</a>';
					}
					echo '</div>';	
				
					echo '<div class="blog-thumbnail-info post-info-color gdl-divider gdl-info">';
					echo '<div class="blog-thumbnail-date">' . get_the_time('d M Y') . '</div>';
					$blog_tag_header = '<span class="blog-thumbnail-tag-title">' . __('Tag ','gdl_front_end') . '</span>';
					the_tags('<div class="blog-thumbnail-tag">' . $blog_tag_header, ', ' ,'</div>');
					echo '<div class="clear"></div>';
					echo '</div>';
					echo '</div>'; // blog-thumbnail-context
					
					echo '</div>'; // bkp-item
					echo '</div>'; // position-relative
					echo '</div>'; // bkp-item-wrapper
					
					echo '</div>'; // blog-item		
					
				}
				echo '</div>'; // blog-item-holder
				
				echo '<div class="clear"></div>';
		
				pagination();

				if( $page_background != 'No' ){				
					echo "<div class='clear'></div>";
					echo "</div>"; // page-bkp-frame
					echo "</div>"; // page-bkp-frame-wrapper
					echo "</div>"; // sixteen-columns
				}				
				
				echo "</div>"; // gdl-page-item
				
				get_sidebar('left');		
				
				echo "</div>"; // gdl-page-float-left				
				
				get_sidebar('right');	
			?>
			<br class="clear">
		</div>
	</div> <!-- content-wrapper -->

<?php get_footer(); ?>
