<?php 
get_header(); 

$swm_blog_style = get_theme_mod( 'swm_blog_all_style', 'large-image' );
$swm_loop_type = ( $swm_blog_style == 'blog-style-grid' ) ? 'standard-grid' : 'standard';
$swm_infinite_pagination_style = ( $swm_blog_style == 'blog-style-grid' ) ? 'swm_infinite_scroll_style' : '';
?>				
	<div class="swm_container <?php echo swm_page_post_layout_type(); ?> <?php echo $swm_infinite_pagination_style; ?>" >	
		<div class="swm_column swm_custom_two_third">
			
			<?php

			$my_searchterm = trim(get_search_query());
				
			if ( $my_searchterm !='' ) : 

			?>
				<ul class="search-list">		
					<?php

					/* ----------------------------------------------------------------------------------
						Search List
					---------------------------------------------------------------------------------- */						

						if ( have_posts() ) : 
							while (have_posts()) : the_post(); ?>					
								
								<li>
									<h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
									<p>
										<?php
										ob_start();
										the_content();
										$old_content = ob_get_clean();
										$new_content = strip_tags($old_content);
										echo substr($new_content,0,300).'...';
										?>
									</p>
								</li>									

							<?php 
							endwhile; 					

						else:

							swm_search_page_form();
							get_search_form();

						endif; ?>
					
				</ul>

				<?php swm_blog_pagination(); ?>
				<?php wp_reset_postdata(); wp_reset_query(); ?>
				<div class="clear"></div>

				<?php
			else : 					
				swm_search_page_form();					
			endif; ?>				

			<div class="clear"></div>
			
			<div class="clear"></div>
		</div>		
	
		<?php
			if ( swm_page_post_layout_type() != 'layout-full-width' ) { ?>

				<aside class="swm_column sidebar" id="sidebar">		
					<?php
					if ( is_active_sidebar('blog-sidebar') ) {
						dynamic_sidebar('blog-sidebar');	
					}		
					?>		
					<div class="clear"></div>
				</aside>
				<?php 	
			}
		?>

	</div>	<?php
 
get_footer(); 

?>