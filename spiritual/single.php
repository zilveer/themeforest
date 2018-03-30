<?php 
get_header(); 
?>
				
	<div class="swm_container <?php echo swm_page_post_layout_type(); ?>" >	
		<div class="swm_column swm_custom_two_third">
			
			<?php
			echo '<section>';

			$swm_date_box_on = '';

			if ( get_theme_mod('swm_show_date_box',1) == 1 ) {
				$swm_date_box_on =  'class="swm_date_box_on"';
			}


			echo '<div id="blog-main-section" ' . $swm_date_box_on . '>';
				
			if (have_posts()) : while (have_posts()) : the_post();	
					
					$postid = swm_get_id();		
					$post_format = get_post_format() ? get_post_format() : 'standard';

					if (is_sticky()) {
						$classes = array( 'swm-infinite-item-selector post-entry', 'swm_blog_post', 'sticky');
					} else {
						$classes = array( 'swm-infinite-item-selector post-entry', 'swm_blog_post');
					}
					echo "<article class='".implode(" ", get_post_class($classes))."'  >";

					echo swm_post_date();

					echo '<div class="swm_post_content">';
					echo swm_post_title();
					echo '<div class="swm_post_format">';
					echo swm_display_post_format();			
					echo '</div>';

					echo swm_post_single_content();
					

					$args = array(
						'before'           => '<div class="clear"></div><div class="pagination_menu">',
						'after'            => '</div>',
						'link_before'      => '<span class="wp_link_pages_custom">',
						'link_after'       => '</span>',
						'next_or_number'   => 'number',
						'nextpagelink'     => __('Next Page ', 'swmtranslate'),
						'previouspagelink' => __('Previous Page ', 'swmtranslate'),
						'pagelink'         => '%',
						'echo'             => 0
					);

					echo wp_link_pages( $args );
					echo '<div class="clear"></div>';
					echo '</div>';						
					echo '</article>';
					echo '<div class="clear"></div>';					
					
					/* ----------------------------------------------------------------------------------
						About Author Box
					---------------------------------------------------------------------------------- */		
					
					$swm_about_author_box = get_theme_mod('swm_single_about_author',1);
					$url = get_the_author_meta( 'user_login' );
					$url = str_replace(' ' , '-', $url );
					
					if (isset($_COOKIE["pixel_ratio"])) {
			   	 		$pixel_ratio = $_COOKIE["pixel_ratio"];
			    		$avatar_size = $pixel_ratio > 1 ? '150' : '75'; 
					} else { 	   
					    $avatar_size = '75'; 
					}
					
					if ($swm_about_author_box) { ?>				
						
						<div class="about_author primary_color">
							<div class="author_title"><h4><span><?php _e('Author: ', 'swmtranslate'); ?></span><?php the_author(); ?></h4></div>				

							<a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>">
								<?php echo get_avatar(get_the_author_meta('email'),$size=$avatar_size,$default=get_template_directory_uri().'/images/thumbs/blog-author.jpg' ); ?>
							</a>			

							<p><?php the_author_meta('description'); ?></p>	
							<div class="clear"></div>
										
						</div>

						<div class="clear"></div>				
					
					<?php }

					/* ----------------------------------------------------------------------------------
						Post Comments
					---------------------------------------------------------------------------------- */	
					
					$swm_post_comments = get_theme_mod('swm_single_comments',1);
					
					if ($swm_post_comments) {
					
						comments_template('', true); 		
					
					}	

			endwhile;
			endif; 

			echo '</div>';	

			echo '<div class="clear"></div>';

			echo '</section>';

			wp_reset_postdata(); wp_reset_query();
			?>



			<div class="clear"></div>
			
			<div class="clear"></div>
		</div>
		
	
	<?php get_sidebar(); 	?>

	</div>	<?php
 
get_footer(); 

?>