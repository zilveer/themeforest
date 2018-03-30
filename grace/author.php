<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package Grace - Religious WordPress Theme
 * @subpackage grace
 * @author Theme Blossom - www.themeblossom.net
 */

get_header();
st_before_content($columns='');
?>


<?php
	/* Queue the first post, that way we know who
	 * the author is when we try to get their name,
	 * URL, description, avatar, etc.
	 *
	 * We reset this later so we can run the loop
	 * properly with a call to rewind_posts().
	 */
	if ( have_posts() )
		the_post();
?>

				<h1><?php printf( __( 'Author Archives: %s', 'grace' ), "<a class='url fn n' href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='me'>" . get_the_author() . "</a>" ); ?></h1>

<?php
if ( get_the_author_meta( 'description' ) ) : ?>
<div id="entry-author-info">
	<div id="author-avatar">
		<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'skeleton_author_bio_avatar_size', 60 ) ); ?>
	</div><!-- #author-avatar -->
	<div id="author-description">
		<h3><?php $postAuthor = get_the_author(); printf( esc_attr__( 'About %s', 'grace' ),  $postAuthor); ?></h3>
		<?php the_author_meta( 'description' ); ?>
		<div id="author-link">
			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
				<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'grace' ), $postAuthor ); ?>
			</a>
		</div><!-- #author-link	-->
	</div><!-- #author-description -->
</div><!-- #entry-author-info -->
<?php endif; ?>

<?php
	/* Since we called the_post() above, we need to
	 * rewind the loop back to the beginning that way
	 * we can run the loop properly, in full.
	 */
	rewind_posts();

	/* Run the loop for the author archive page to output the authors posts
	 * If you want to overload this in a child theme then include a file
	 * called loop-author.php and that will be used instead.
	 */
	get_template_part( 'loop', 'author' );
	st_after_content();
	get_sidebar();
	get_footer();
?>