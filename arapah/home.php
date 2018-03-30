<?php
/**
 * @package WordPress
 * @subpackage Arapah-WP
 */
 ?>

    <?php get_header();  //the Header ?>
        
    <?php get_template_part( 'menu', 'index' ); //the  menu + logo/site title ?>	
			
	<section id="maincontent" class="right-s">
		<div class="container">	
			<?php $post_query = array( 'cat' => of_get_option('ar-blog-category'), 'paged' => get_query_var('paged') ); ?>
			<section id="homepage" class="two-thirds column">
				<div class="gutter alpha">
					<div class="main"> 
						<h2 class="page-title"><?php echo of_get_option('ar-blog-cat-title') ?></h2>
						<?php query_posts( $post_query ); ?>
						<?php while ( have_posts() ) : the_post(); ?> <!--  the Loop -->
										
						<article id="post-<?php the_ID(); ?>" class="clearfix">
							<div class="title">            
								<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title('', ''); ?></a></h2>  <!--Post titles-->
							</div>
							<ul class="post-data">
								<li>Category: <?php the_category(' '); ?></li>
								<li>Published Dated: <?php echo get_the_date(); ?></li>
								<li>Writen by: <?php the_author_posts_link(); ?></li>
							</ul>
							<div class="blog-thumb">
								<?php
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( 'def-blog-thumb' );
								} else {
									echo '<img width="250" height="167" src="' . get_template_directory_uri() . '/images/thumbnail-default.jpg" class="wp-post-image" />';
								}
								?>
							</div>
							<?php the_content('' ); ?>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="more-link"><span class="block">Read More</span></a>
						</article> <!--The Content-->			
						<?php endwhile; ?><!--  End the Loop -->

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
				 
				  </div>  <!-- .main -->
				</div>  <!-- .gutter .alpha -->
			</section>  <!-- #homepage .two-thirds .column -->
				 
			<div class="one-third column" id="side">
				<aside class="gutter sidebar"><!--  the Sidebar -->
					<?php if ( is_active_sidebar( 'blog-sidebar' ) ) : ?> <?php dynamic_sidebar( 'blog-sidebar' ); ?>
					<?php else : ?><p>You need to drag a widget into your sidebar in the WordPress Admin</p>
					<?php endif; ?>
				</aside>
			</div>
		</div><!--  .container -->
	</section><!--  #maincontent -->
            
    <?php get_footer(); //the Footer ?>
                        
           
