<?php

get_header(); ?>


		<div class="container-col-w-sidebar">
			<?php $post = $posts[0]; ?>
    	<h1 class="main-h1"><?php
	 	  				if (is_category()) { 
	 	  					printf(__('All posts in %s', 'om_theme'), single_cat_title('',false));
	 	  				} elseif( is_tag() ) {
	 	  					printf(__('All posts tagged %s', 'om_theme'), single_tag_title('',false));
	 	  				} elseif (is_day()) { 
	 	  					_e('Archive for', 'om_theme'); the_time('F jS, Y'); 
	 	  				} elseif (is_month()) { 
	 	  					_e('Archive for', 'om_theme'); the_time('F, Y'); 
	 	  				} elseif (is_year()) { 
	 	  					_e('Archive for', 'om_theme'); the_time('Y');
	 	  				} elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
								_e('Blog Archives', 'om_theme');
	 	  				} else { 
	 	  					$blog = get_post(get_option('page_for_posts'));
								echo $blog->post_title;
							}
						?></h1>
    </div>
    <div class="clear"></div>
        
		<div class="container-col-w-sidebar">
			
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							
					    <?php 
								$format = get_post_format(); 
								if( false === $format )
									$format = 'standard';
								get_template_part( 'includes/post-type-' . $format );
					    ?>
	
							
								<?php endwhile; ?>
		
							<?php
								$nav_prev=get_previous_posts_link(__('Older Entries', 'om_theme'));
								$nav_next=get_next_posts_link(__('Newer Entries', 'om_theme'));
								if( $nav_prev || $nav_next ) {
									?>
									<div class="navigation-prev-next">
										<?php if($nav_prev){?><div class="navigation-prev"><?php echo $nav_prev; ?></div><?php } ?>
										<?php if($nav_next){?><div class="navigation-next"><?php echo $nav_next; ?></div><?php } ?>
										<div class="clear"></div>
									</div>
									<?php
								}		
							?>
			
						<?php else : 
			
							echo '<h2>';
							if ( is_category() ) {
								printf(__('Sorry, but there aren\'t any posts in the %s category yet.', 'om_theme'), single_cat_title('',false));
							} elseif ( is_tag() ) { 
							    printf(__('Sorry, but there aren\'t any posts tagged %s yet.', 'om_theme'), single_tag_title('',false));
							} elseif ( is_date() ) { 
								echo(__('Sorry, but there aren\'t any posts with this date.', 'om_theme'));
							} else {
								echo(__('No posts found.', 'om_theme'));
							}
							echo '</h2>';
		
						 endif; ?>

		</div>

		<div class="container-col-sidebar">
			<!-- Sidebar -->
			<div class="sidebar-inner">
			<?php	get_sidebar(); ?>
			</div>
			<!-- /Sidebar -->
		</div>
		
		<div class="clear"></div>
		
<?php get_footer(); ?>