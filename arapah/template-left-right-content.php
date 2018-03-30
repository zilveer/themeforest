<?php
/**
 * Template Name: Left + Right + Content
 * Description: Left + Right Sidebar + Content template
 *
 * @package WordPress
 * @subpackage Arapah-WP
 */

get_header(); 
get_template_part( 'menu', 'index' ); //the  menu + logo/site title ?>

	<section id="maincontent">
		<div id="leftside" class="container">	
			
			<div id="primary" class="eight columns">
				<div class="gutter alpha omega">
					<section class="main">

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
				 
				  </section>  <!-- #primary .main -->
				</div>  <!-- .gutter .alpha -->
			</div>  <!-- .eight .columns -->
				 
			<div id="leftSidebar" class="four columns">
				<aside class="gutter alpha sidebar"><!--  the Sidebar -->
					<?php if ( is_active_sidebar( 'left-page-sidebar' ) ) : ?> <?php dynamic_sidebar( 'left-page-sidebar' ); ?>
					<?php else : ?><p>You need to drag a widget into your sidebar in the WordPress Admin</p>
					<?php endif; ?>
				</aside>
			</div>	<!-- .four .columns --> 
				 
			<div id="side" class="four columns">
				<aside class="gutter sidebar"><!--  the Sidebar -->
					<?php if ( is_active_sidebar( 'page-sidebar' ) ) : ?> <?php dynamic_sidebar( 'page-sidebar' ); ?>
					<?php else : ?><p>You need to drag a widget into your sidebar in the WordPress Admin</p>
					<?php endif; ?>
				</aside>
			</div> <!-- .four .columns --> 
		</div><!--  .container -->
	</section>
                
<?php get_footer(); ?>