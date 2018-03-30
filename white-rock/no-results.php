<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package progression
 * @since progression 1.0
 */
?>

<?php if ( is_home() ) : ?>
	
	<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'progression' ), admin_url( 'post-new.php' ) ); ?></p>


<?php elseif ( is_search() ) : ?>

	<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'progression' ); ?></p>
		<?php get_search_form(); ?>

<?php else : ?>

	<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'progression' ); ?></p>
	<?php get_search_form(); ?>

<?php endif; ?>
