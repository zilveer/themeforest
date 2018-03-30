<?php
/*
Template Name: Services
*/
get_header(); 
?>
				<div id="content">
					<div id="fullwidth">
						<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
						<h1><?php the_title(); ?></h1>
							<?php the_content(); ?>
							<?php
							$loop = new WP_Query(array('post_type' => 'service', 'posts_per_page' => '-1')); 
							$i=0;
							while ( $loop->have_posts() ) : $loop->the_post(); ?>
							<?php
							$i++;
							?>
							<div class="<?php if ($i%2==0) echo"servicesright"; else echo"servicesleft"; ?>">
								<h2 class="titleservices"><?php the_title(); ?></h2>
								<?php the_content(); ?>
							</div>
							<?php if ($i%2==0) echo"<div class=\"clear\"></div>"; ?>
							<?php endwhile;?>
							<div class="clear"></div>
						<?php endwhile; ?>
					</div><!-- #fullwidth -->
				</div>
			</div>			
			
<?php get_footer(); ?>
