<?php 
	$sidebar_enabled = get_theme_mod('oy_sidebar_enabled', 0); 
	$post_type = get_option('oy_post_content', 'excerpt'); //get the post type; excerpt or full post.	
?>	

<div class="blog-container">
	
	<div class="group">

		<div class="blog-posts <?php echo $grid_class = ($sidebar_enabled) ? 'blog-with-sidebar' : 'blog-no-sidebar'; ?>">		
		
			<?php if (have_posts()) while (have_posts()) : the_post(); ?>
				
				<article id="post-<?php the_ID(); ?>" <?php post_class('post group'); ?>>
					
					<a class="date-circle" href="<?php the_permalink(); ?>" rel="bookmark">
						<time class="post-time" datetime="<?php echo esc_attr(get_the_time('c'));?>">
							<?php 
								$pub_date = mysql2date( __( 'd M, Y', 'onioneye' ), $post->post_date ); 
								list($day, $month, $year) = explode(' ', $pub_date);
							?>
							<span class="day"><?php echo esc_html($day); ?></span>
							<span class="month-and-year"><?php echo esc_html($month . ' ' . $year); ?></span>
						</time>
					</a>
										
					<div class="post-content">	
						<h2 class="h1">
							<a href="<?php the_permalink(); ?>" class="post-title-link" rel="bookmark">
								<?php the_title(); ?>
							</a>
						</h2>
						
						<time class="secondary-post-time" datetime="<?php echo esc_attr(get_the_time('c'));?>">
							<?php 
								$pub_date = mysql2date( __( 'd M, Y', 'onioneye' ), $post->post_date ); 
								list($day, $month, $year) = explode(' ', $pub_date);
							?>
							<span class="day"><?php echo esc_html($day); ?></span>
							<span class="month-and-year"><?php echo esc_html($month . ' ' . $year); ?></span>
						</time>
							
						<?php if(has_post_thumbnail()) { ?>
							<a href="<?php the_permalink(); ?>" rel="bookmark" class="featured-img-link group">				
								<?php the_post_thumbnail(); ?>
							</a>
						<?php } ?>
						
						<ul class="additional-post-meta group">
							<?php if(has_category()) { ?> 
									
								<li><?php esc_html_e('Categories: ', 'onioneye'); the_category(', '); ?>&nbsp;&nbsp; &#8226; &nbsp;&nbsp;</li> 
									
							<?php } ?>
							
							<?php if(has_tag()) { ?> 
							
								<li><?php the_tags(__('Tags: ', 'onioneye'), ', ', '' ); ?>&nbsp;&nbsp; &#8226; &nbsp;&nbsp;</li> 
							
							<?php } ?>
								
							<li><?php comments_popup_link(__('No Comments', 'onioneye'), __('1 Comment', 'onioneye'), __('% Comments', 'onioneye')); ?>&nbsp;&nbsp; &#8226; &nbsp;&nbsp;</li>
							<li class="author"><?php echo esc_html(sprintf(__('by %s', 'onioneye'), get_the_author())); ?></li>
							<?php edit_post_link(__('Edit', 'onioneye'), '<li class="edit-post">&nbsp;&nbsp; &#8226; &nbsp;&nbsp;', '</li>'); // Display the edit link, if logged in ?>
						</ul><!-- /.additional-post-meta -->
							
						<div class="excerpt-content">
							<?php if( $post_type === 'excerpt' || !$post_type) { the_excerpt(); } else { the_content(__( 'Read the Rest', 'onioneye')); } ?>
						</div><!-- /.excerpt-content -->
					</div><!-- /.post-content -->
							
				</article><!-- /.post -->
							
			<?php endwhile; ?>
		
		</div><!-- /.blog-posts -->
		
		<?php if($sidebar_enabled) { ?>
			<?php get_sidebar('blog'); ?>
		<?php } ?>
	
	</div><!-- /.group -->
	
	<ul class="pager group">
        <li class="prev-page">
			<?php next_posts_link(esc_html__('&larr; Older Entries', 'onioneye')); ?>
        </li>
			
		<li class="next-page">
           	<?php previous_posts_link(esc_html__( 'Newer Entries &rarr;', 'onioneye')); ?> 
        </li>
    </ul><!-- /.pager -->

</div><!-- /.blog-container -->