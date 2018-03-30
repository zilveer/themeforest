<?php get_header(); ?>
		
		<div id="content">
			
			<!-- grab the posts -->
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<div <?php post_class('post clearfix'); ?>>
				<div class="box">
					
					<?php if ( has_post_thumbnail() ) { ?>
						<div class="post-image">
							<a class="large-image" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'large-image' ); ?></a>
						</div>
					<?php } ?>
					
					<?php if ( get_post_meta($post->ID, 'crvideo', true) ) { ?>
						<div class="crvideo">
							<?php echo get_post_meta($post->ID, 'crvideo', true) ?>
						</div>
					<?php } ?>
					
					<div class="frame frame-full">
						<div class="title-wrap">
							<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
						</div>
						
						<div class="post-content">
							<?php the_content(); ?>
						</div>
					</div><!-- frame -->
				</div><!-- box -->
			</div><!--writing post-->			
			
			<?php endwhile; ?>
			<?php endif; ?>
			
		</div><!--content-->
		
		<!-- grab the sidebar -->
		<?php get_sidebar(); ?>
	
		<!-- grab footer -->
		<?php get_footer(); ?>
