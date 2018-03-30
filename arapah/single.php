<?php
/**
 * @package WordPress
 * @subpackage Arapah-WP
 */
 
get_header();  //the Header ?>
        
    <?php get_template_part( 'menu', 'index' ); //the  menu + logo/site title ?>
			
	<section id="maincontent">
		<div class="container">		
			<div class="two-thirds column">
				<div class="gutter alpha">
					<section id="primary" class="main">
									
						<?php while ( have_posts() ) : the_post(); ?> <!--  the Loop -->
										
						<article id="post-<?php the_ID(); ?>" class="clearfix">
							<div class="title">            
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title('<h1 class="contentheading">', '</h1>'); ?></a>  <!--Post titles-->
							</div>
							<ul class="post-data">
								<li>Category: <?php the_category(', '); ?></li>
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

							<?php the_content("Continue reading " . the_title('', '', false)); ?> <!--The Content-->
							
							<div class="post-tags"><?php the_tags('<span>Tags:</span>' , ', '); ?></div>
							
						</article><!-- #post-<?php the_ID(); ?> -->
									
						<?php endwhile; ?><!--  End the Loop -->
						
					<?php comments_template( '', true ) ?>
				 
				  </section>  <!-- #primary -->
				</div>  <!-- .gutter .alpha -->
			</div>  <!-- .two-thirds .column -->
				 
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
    
                               