<?php
get_header(); 
?>
			<div id="content">
				<div id="fullwidth">
					<h1><?php the_title() ?></h1>
					<?php the_post(); ?>  
					<?php
					$custom = get_post_custom($post->ID); 
					$website_url_portfolio = $custom["website_url_portfolio"][0];
					?>
					<div id="placeportfolio">
						<?php the_post_thumbnail('portfolio-thumb1'); ?>
					</div>
					<div id="detailportfolio">
						<?php
						the_content();
						?>
						<a href="<?php echo $website_url_portfolio ?>" class="butmore">Visit Website</a>
					</div>
					<div class="clear"></div>
					<h1>Other Project</h1>
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
				</div>
			</div>	
		</div>		
			
<?php get_footer(); ?>
