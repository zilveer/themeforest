<?php get_header(); ?>

<div class="maincontainer">
			<?php global $wp_query;
			$total_results = $wp_query->found_posts;?>
	   		<div class="pagetitle"><h1><?php echo $total_results;  _e(' Search Results for: ', 'bw_themes'); echo get_search_query(); ?></h1></div>
			<div class="contentwrapper1">

 				<div class="contentleft">

						<?php if (have_posts()) : ?>

						<?php while (have_posts()) : the_post(); ?>
							<div class="entry">
								<h2><span><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></span></h2>
								
								<?php the_excerpt(); ?>
								<ul class="post-meta">
									<li class="post-meta-readmore"><a href="<?php echo get_permalink(); ?>"><?php _e('Read More', 'bw_themes');?></a></li>
								</ul>
							</div>
						<?php endwhile; ?>
									<div class="navigation">
										<div class="next-posts"><?php previous_posts_link('&laquo; Previous Results') ?></div>
										<div class="prev-posts"><?php next_posts_link('Next Results &raquo;') ?></div>
									</div>
					<?php else : ?>

						<p><?php echo do_shortcode('[messagebox msgstyle="red"]'.__('Sorry, couldn\'t find what you were searching for.', 'bw_themes').'[/messagebox]');  ?></p>

					<?php endif; ?>
				</div>

				<div class="contentright">
					<?php get_sidebar(); ?>
				</div>		
			</div><!-- contentwrapper -->
			<div class="footerwrapper">
<?php get_footer(); ?>