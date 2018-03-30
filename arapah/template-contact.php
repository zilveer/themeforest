<?php
/**
 * Template Name: Contact Page
 * Description: A Contact Page template
 *
 * @package WordPress
 * @subpackage Arapah-WP
 */

get_header(); 
get_template_part( 'menu', 'index' ); //the  menu + logo/site title ?>

	<section id="maincontent">
		<div class="container">		
			<div class="two-thirds column">
				<div class="gutter alpha">
					<section id="primary" class="main">
						<div class="main">

							<?php the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
								<header class="title">
									<h1 class="contentheading"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
								</header><!-- .entry-header -->
							
								<div class="blog-thumb">
									<?php the_post_thumbnail( 'def-blog-thumb' ); ?>
								</div>

								<div class="entry-content">
									<?php the_content(); ?>
									<?php wp_link_pages( 'before=<div class="page-link">' . __( 'Pages:', 'Arapah-WP' ) . '&after=</div>' ); ?>
									<?php edit_post_link( __( 'Edit', 'themename' ), '<span class="edit-link">', '</span>' ); ?>
								</div><!-- .entry-content -->
							</article><!-- #post-<?php the_ID(); ?> -->
						
							<?php comments_template( '', true ) ?>
							
						</div><!-- .main -->
				 
				  </section>  <!-- #primary -->
				</div>  <!-- .gutter .alpha -->
			</div>  <!-- .two-thirds .column --> 
				 
			<div class="one-third column" id="side">
				<aside class="gutter sidebar"><!--  the Sidebar -->
					<?php if ( is_active_sidebar( 'contact-sidebar' ) ) : ?> <?php dynamic_sidebar( 'contact-sidebar' ); ?>
					<?php else : ?><p>You need to drag a widget into your sidebar in the WordPress Admin</p>
					<?php endif; ?>
				</aside>
			</div>
		</div><!--  .container -->
	</section>
                
<?php get_footer(); ?>