<?php
/**
 * The loop that displays a page.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop-page.php.
 *
 */
?>

<?php
	if ( is_search() && class_exists('WP_eCommerce') ) { ?>
	<h1 class="entry-title"><?php _e('Search Results' , ETHEME_DOMAIN); ?></h1>
	<?php get_template_part( 'wpsc', 'products_page' ); ?>
<?php } else { ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if ( is_front_page() ) { ?>
						<h2 class="entry-title"><?php the_title(); ?></h2>
					<?php } else { ?>
						<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php } ?>

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', ETHEME_DOMAIN ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', ETHEME_DOMAIN ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->


<?php endwhile; // end of the loop. ?>
<?php }?>