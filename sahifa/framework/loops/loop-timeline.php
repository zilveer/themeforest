<div class="post-listing archive-box">

	<div class="post-inner">
	
		<div class="timeline-contents timeline-archive">
		
		<?php $timeline_time = ''; ?>
		<?php while ( have_posts() ) : the_post();  ?>

			<?php
			if( ( empty( $timeline_time ) && get_the_time('F, Y') ) || ( !empty( $timeline_time ) && $timeline_time != get_the_time('F, Y')) ){
			
				if( !empty( $timeline_time) ) {
			?>
			
			</ul>
			<div class="clear"></div>
			<?php }
			
				$timeline_time = get_the_time('F, Y');
			?>
		
			<h2 class="timeline-head"><?php echo $timeline_time ?></h2>
			<div class="clear"></div>
			<ul class="timeline">

			<?php } ?>
				
				<li <?php tie_post_class( 'timeline-post' ); ?>>	
					<div class="timeline-content">
						<span class="timeline-date"><?php echo get_the_time('j F') ?></span>
						<h2 class="post-box-title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h2>
						
						<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>	
						
						<div class="post-thumbnail">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail('tie-medium');  ?>
								<span class="fa overlay-icon"></span>
							</a>
						</div><!-- post-thumbnail /-->
						
						<?php endif; ?>
							
						<div class="entry">
							<p><?php tie_excerpt() ?></p>
						</div>
						
						<?php if( tie_get_option( 'archives_socail' ) ) get_template_part( 'framework/parts/share' );  // Get Share Button template ?>

					</div>
					<div class="clear"></div>
				</li>
	
		<?php endwhile;?>

			</ul>
			<div class="clear"></div>
		</div><!-- .timeline-contents /-->	

	</div>

</div>
