<?php get_header(); ?>

<div class="maincontainer">	   		
			<div class="pagetitle"><h1>
							<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

							<?php /* If this is a category archive */ if (is_category()) { 
								_e( 'Posts Tagged ', 'bw_themes');
								echo '&#8216';
								single_tag_title(); 
								echo '&#8217';
								_e( 'Category', 'bw_themes');

							/* If this is a tag archive */ } elseif( is_tag() ) {
								_e( 'Posts Tagged ', 'bw_themes'); 
								echo '&#8216';
								single_tag_title(); 
								echo '&#8217';

							/* If this is a daily archive */ } elseif (is_day()) {
								_e( 'Archive for ', 'bw_themes');
								the_time('F jS, Y');

							/* If this is a monthly archive */ } elseif (is_month()) {
								_e( 'Archive for ', 'bw_themes'); 
								the_time('F, Y');

							/* If this is a yearly archive */ } elseif (is_year()) {
								_e( 'Archive for ', 'bw_themes');
								the_time('Y');

							/* If this is an author archive */ } elseif (is_author()) {
								_e( 'Author Archive ', 'bw_themes');

							/* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { 
								_e( 'Blog Archives ', 'bw_themes');
							?>
							
							<?php } ?>			
			</h1></div>
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
