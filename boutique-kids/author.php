<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package WordPress
 * @subpackage boutique
 * @since boutique 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

get_header(); ?>

<!-- boutique template: author.php -->
		<div id="primary">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<?php
					/*
				Queue the first post, that way we know
					 * what author we're dealing with (if that is the case).
					 *
					 * We reset this later so we can run the loop
					 * properly with a call to rewind_posts().
					 */
					the_post();
				?>

				<?php do_action( 'boutique_page_header_before' ); ?>
				<div class="page-header">
					<h1 class="page-title author"><?php printf( esc_html__( 'Author Archives: %s', 'boutique-kids' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
				</div>
				<?php do_action( 'boutique_page_header_after' ); ?>

				<?php
					/*
				Since we called the_post() above, we need to
					 * rewind the loop back to the beginning that way
					 * we can run the loop properly, in full.
					 */
					rewind_posts();
				?>

				<?php // boutique_content_nav( 'nav-above' ); ?>

				<?php
				// If a user has filled out their description, show a bio on their entries.
				if ( get_the_author_meta( 'description' ) ) : ?>
				<div id="author-info">
					<div id="author-avatar">
						<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'boutique_author_bio_avatar_size', 60 ) ); ?>
					</div><!-- #author-avatar -->
					<div id="author-description">
						<h2><?php printf( esc_html__( 'About %s', 'boutique-kids' ), get_the_author() ); ?></h2>
						<?php the_author_meta( 'description' ); ?>
					</div><!-- #author-description	-->
				</div><!-- #entry-author-info -->
				<?php endif; ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/*
					Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>

				<?php boutique_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<div id="post-0" class="post no-results not-found">
					<div class="entry-header">
						<h1 class="entry-title"><?php esc_html_e( 'Nothing Found', 'boutique-kids' ); ?></h1>
					</div><!-- .entry-header -->

					<div class="entry-content">
						<p><?php esc_html_e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'boutique-kids' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>
