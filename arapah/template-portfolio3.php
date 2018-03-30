<?php
/**
 * Template Name: Portfolio 3 Cols
 * Description: A full-width template for Portfolio 3 Cols
 *
 * @package WordPress
 * @subpackage Arapah-WP
 */

get_header(); 
get_template_part( 'menu', 'index' ); //the  menu + logo/site title ?>

	<div class="container">

		<div class="sixteen columns">
			<div class="gutter alpha omega">
				<section id="primary" class="portf three-columns">
				<?php $post_query = array( 'cat' => of_get_option('ar-port-category'), 'posts_per_page' => 9, 'paged' => get_query_var('paged') ); ?>
					<div id="content">
					
						<header class="title">
							<h1 class="page-title"><?php echo of_get_option('ar-port-cat-title') ?></h1>
						</header>
						<?php query_posts( $post_query ); ?>
						<div class="minmargin clearfix">
						<?php while ( have_posts() ) : the_post(); ?> <!--  the Loop -->
							<div class="portfolio one-third columns">
								<div class="margin">
				
									<?php if ( has_post_thumbnail() ) {
										$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large'); 
										echo '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" >';
										echo get_the_post_thumbnail($post->ID, 'medium', array('class' => 'car_thumb') ); 
										echo '</a>';
									} else {
										echo '<img width="300" height="201" src="' . get_template_directory_uri() . '/images/thumbnail-default.jpg" />';
									}
									?>
									<h4 class="post-title"> 
										<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>" >
											<?php $short_title = substr(the_title('','',FALSE),0,25);
											echo $short_title; if (strlen($short_title) >24){ echo '...'; } ?>	
										</a>
									</h4>
									<div class="post-meta">
										<span class="date"><?php the_time('j-m-Y'); ?></span>
										<span class="cate"><?php the_category(' '); ?></span>
									</div>
									<div class="post-content">
										<p>
										<?php 
											$content = get_the_content();
											$content = strip_tags($content);
											echo substr($content, 0, 104). '...';
										?>				
										</p>
									</div>
								</div>
							</div><!--  .port -->
						<?php endwhile; ?><!--  End the Loop -->
						</div>

						<?php /* Display navigation to next/previous pages when applicable */ ?>

						  <nav id="nav-below">
							<?php if(function_exists('wp_pagenavi')) : wp_pagenavi();
								else : ?>
									<div class="navigation">
										<div class="button float-left"><?php previous_posts_link('prev') ?></div>
										<div class="button float-right"><?php next_posts_link('next') ?></div>
									</div>
							<?php endif; ?>
						  </nav><!-- #nav-below -->
						
					<?php wp_reset_query();?>

					</div><!-- #content -->
				</section><!-- #primary -->
			</div><!-- .gutter .alpha .omega -->
		</div><!-- .sixteen .columns -->
		
	</div><!-- .container -->
                
<?php get_footer(); ?>