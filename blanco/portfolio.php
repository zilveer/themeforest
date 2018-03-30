<?php
/**
 * Template Name: Portfolio
 *
 */
 ?>
<?php
get_header(); ?>
        <section id="main" class="column1">
            <div class="content">
                	<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php 
						
						$columns = etheme_get_option('portfolio_columns');
						if(isset($_GET['col'])) {
							$columns = $_GET['col'];
						}
						
						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						$args = array(
							'post_type' => 'etheme_portfolio',
							'paged' => $paged,	
							'posts_per_page' => etheme_get_option('portfolio_count'),
						);
						$loop = new WP_Query($args);
					?>
					
           			<?php if ( $loop->have_posts() ) : ?>
	           			<ul class="portfolio-filters">
							<li><a href="#" data-filter="*"><?php _e('Show All', ETHEME_DOMAIN); ?></a>/</li>
	           				<?php 
								$categories = get_terms('categories');
								$catsCount = count($categories);
								$_i=0;
								foreach($categories as $category) {
									$_i++;
									?>
										<li><a href="#" data-filter=".sort-<?php echo $category->slug; ?>"><?php echo $category->name; ?></a><?php if($catsCount != $_i): ?>/<?php endif; ?></li>
									<?php 
								}
		           				
	           				?>
						</ul>
           				<div class="portfolio portfolio-<?php echo $columns; if($columns > 1) echo ' multi-columns'; ?>">
							<?php /* Start the Loop */ ?>
							<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
			
								<?php
									get_template_part( 'content', 'portfolio' );
								?>
			
							<?php endwhile; ?>
						</div>
						
						
						<?php etheme_portfolio_pagination($loop, $paged); ?>
						
					<?php else : ?>
                        <h3 class="page-title"><?php _e( 'Nothing Found', ETHEME_DOMAIN ); ?></h3>
        			<?php endif; ?>
        			
			</div><!-- #content -->
            <div class="clear"></div>
		</section><!-- #container -->
<?php get_footer(); ?>