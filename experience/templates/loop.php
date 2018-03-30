<?php // Save theme options array to variable for use in this file
$experience_theme_array = experience_get_options();?>

<?php if ( have_posts() ) : ?>
		
	<!-- BEGIN .post-container (class used to append AJAX button) -->
	<div class="post-container">
		
		<?php while ( have_posts() ) : the_post(); ?>

			<article class="post-item">
			
				<div class="section-content narrow-width padding-h padding-v">
			
					<div class="post-content">
				
						<!-- title -->
						<?php if ( get_the_title() ) {
							$title = get_the_title();
						} else {
							$title = $post->post_name;
						} ?>
						
						<h2><a href="<?php the_permalink(); ?>"><?php echo esc_html( $title ); ?></a></h2>
						
						<span class="post-permalink"><?php the_permalink(); ?></span>
						
						<!-- content -->
						<?php the_excerpt(); ?>
				
					</div>
					
				</div>
				
			</article>
			
		<?php endwhile; ?>
	
	</div>
	<!-- END .post-container -->
	
<?php else: ?>
	
	<!-- BEGIN .section-content -->
	<div class="section-content padding-v padding-h site-width">

		<!-- BEGIN .post-content -->
		<div class="post-content clearfix">
		
			<p><?php esc_html_e( 'No posts to show.', 'experience' ); ?></p>
		
		</div>
		<!-- END .section-content -->
		
	</div>
	<!-- END .section-content -->
	
<?php endif; ?>
