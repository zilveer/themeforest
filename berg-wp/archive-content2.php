<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package berg-wp
 */

get_header(); ?>

		<section id="blog-classic" class="section-scroll main-section blog-content blog blog-sidebar">
		<?php if ( have_posts() ) : ?>

			<header class="section-header">
				<h2 class="page-title h3">
					<?php
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							printf( __( 'Author: %s', 'BERG'), '<span class="vcard">' . get_the_author() . '</span>' );

						elseif ( is_day() ) :
							printf( __( 'Day: %s', 'BERG'), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( 'Month: %s', 'BERG'), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'BERG') ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( 'Year: %s', 'BERG'), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'BERG') ) . '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( 'Asides', 'BERG');

						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
							_e( 'Galleries', 'BERG');

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( 'Images', 'BERG');

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', 'BERG');

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', 'BERG');

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( 'Links', 'BERG');

						elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
							_e( 'Statuses', 'BERG');

						elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
							_e( 'Audios', 'BERG');

						elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
							_e( 'Chats', 'BERG');

						else :
							_e( 'Archives', 'BERG');

						endif;
					?>
				</h2>
				
				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
				?>
			</header><!-- .page-header -->
			<div class="container">
				<div class="row">
					<div id="blog-content-append" class="col-md-7">
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', 'blog-classic' );
				?>

			<?php endwhile; ?>

			<?php berg_wp_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>
		</div>
		<div class="col-md-4 col-md-offset-1 widget-sidebar sidebar-padding">
			<?php get_sidebar(); ?>
		</div>
			</div>
			</div>
		<!-- </main>--><!-- #main --> 
	</section><!-- #primary -->

