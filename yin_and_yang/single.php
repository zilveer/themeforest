<?php get_header(); ?>

<?php 
	$sidebar_enabled = get_theme_mod('oy_sidebar_enabled', 0);  
?> 

<div class="blog-container">
	
	<div class="group">
		
		<div class="single-post blog-posts <?php echo $grid_class = ($sidebar_enabled) ? 'blog-with-sidebar' : 'blog-no-sidebar'; ?>">		
		
			<?php if (have_posts()) while (have_posts()) : the_post(); ?>
				
				<article id="post-<?php the_ID(); ?>" <?php post_class('post group'); ?>>
					
					<div class="date-circle" href="<?php the_permalink(); ?>" rel="bookmark">
						<time class="post-time" datetime="<?php echo esc_attr(get_the_time('c'));?>">
							<?php 
								$pub_date = mysql2date( __( 'd M, Y', 'onioneye' ), $post->post_date ); 
								list($day, $month, $year) = explode(' ', $pub_date);
							?>
							<span class="day"><?php echo esc_html($day); ?></span>
							<span class="month-and-year"><?php echo esc_html($month . ' ' . $year); ?></span>
						</time>
					</div>
										
					<div class="post-content">	
						<h2 class="h1">
							<div class="post-title-link">
								<?php the_title(); ?>
							</div>
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
							<div class="featured-img-link group">				
								<?php the_post_thumbnail(); ?>
							</div>
						<?php } ?>
						
						<div class="the-content single-post-content">
							<?php the_content(); ?>
						</div><!-- /.the-content -->
						
						<?php wp_link_pages( array( 'before' => '<div class="page-link"><span class="page-link-title">Pages &rarr;</span>', 'after' => '</div>', 'pagelink' => ' Page % &nbsp;' ) ); ?>
						
						<?php comments_template(); ?>
					</div><!-- /.post-content -->
							
				</article><!-- /.post -->
							
			<?php endwhile; ?>
		
		</div><!-- /.single-post -->
				
		<?php if($sidebar_enabled) { ?>
			<?php get_sidebar('blog'); ?>
		<?php } ?>
	
	</div><!-- /.group -->
	
	<ul class="pager group">
        <li class="prev-page">
			<?php next_post_link( '%link', '&larr; %title' ); ?>
        </li>
			
		<li class="next-page">
           	<?php previous_post_link( '%link', '%title &rarr;' ); ?>        
        </li>
    </ul><!-- /.pager -->
    
</div><!-- /.blog-container -->
		
<?php get_footer(); ?>