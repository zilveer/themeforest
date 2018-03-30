<?php
/*
Template Name: Portfolio
*/
get_header(); 
?>
				<div id="content">
					<div id="fullwidth">
						<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
						<h1><?php the_title(); ?></h1>
							<?php
							the_content();
							?>
							<ul id="listportfolio">
							<?php
							$loop = new WP_Query(array('post_type' => 'portfolio', 'posts_per_page' => '-1')); 
							while ( $loop->have_posts() ) : $loop->the_post(); ?>
							<?php
							?>
							<li>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('portfolio-thumb3'); ?><br /><?php the_title(); ?></a>
							</li>
							<?php endwhile;?>
							</ul>
							<div class="clear"></div>
						<?php endwhile; ?>
					</div><!-- #fullwidth -->
				</div>
			</div>			
			
<?php get_footer(); ?>
