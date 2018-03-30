<?php get_header(); ?>

<div class="maincontainer">
	   		<div class="pagetitle"><h1><?php echo wp_title(''); ?></h1></div>
			<div class="contentwrapper1">

 				 <div class="contentleft">
				  
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<div class="postwrapper1">
						<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
							<?php
							if(has_post_thumbnail()) {
								echo '<div class="post-image">';
								echo '<a href="'.get_permalink().'">';
								echo the_post_thumbnail('thumbnail');
								echo '</a></div>';
								}
							else {
								 
								}
								?>

							<div class="entry">
							<h2><span><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></span></h2>
								<?php the_excerpt(); ?>
							</div>
							
						</div>
						<?php get_template_part( 'meta' ); ?>
					</div>

					<?php endwhile; ?>

					<?php get_template_part( 'nav' ); ?>

					<?php else : ?>

						<p><?php _e('Sorry, no posts matched your criteria.', 'bw_themes'); ?></p>

					<?php endif; ?>
				</div>
				<div class="contentright">
					<?php get_sidebar(); ?>
				</div>		
			</div><!-- contentwrapper -->
			<div class="footerwrapper">
				<?php get_footer(); ?>
