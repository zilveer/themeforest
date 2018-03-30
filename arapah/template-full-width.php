<?php
/**
 * Template Name: Full-width, no sidebar
 * Description: A full-width template with no sidebar
 *
 * @package WordPress
 * @subpackage Arapah-WP
 */

get_header(); 
get_template_part( 'menu', 'index' ); //the  menu + logo/site title ?>

	<div class="container">
		<div class="sixteen columns">
			<div class="gutter alpha omega">
				<section id="primary" class="full-width">
					<div id="content">

						<?php the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
							<header class="title">
								<h1 class="contentheading"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
							</header><!-- .entry-header -->

							<div class="entry-content">
								<?php the_content(); ?>
								<?php wp_link_pages( 'before=<div class="page-link">' . __( 'Pages:', 'Arapah-WP' ) . '&after=</div>' ); ?>
								<?php edit_post_link( __( 'Edit', 'themename' ), '<span class="edit-link">', '</span>' ); ?>
							</div><!-- .entry-content -->
						</article><!-- #post-<?php the_ID(); ?> -->

						<?php comments_template( '', true ); ?>

					</div><!-- #content -->
				</section><!-- #primary -->
			</div><!-- .gutter .alpha .omega -->
		</div><!-- .sixteen .columns -->	
	</div><!-- .container -->
                
<?php get_footer(); ?>