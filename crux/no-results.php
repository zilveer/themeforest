<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package StagFramework
 * @subpackage Crux
 */
?>

<section class="no-results not-found"<?php stag_markup_helper( array( 'context' => 'entry' ) ); ?>>
	<header class="page-header">
		<h1 class="page-title"<?php stag_markup_helper( array( 'context' => 'title' ) ); ?>><?php _e( 'Nothing Found', 'stag' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content"<?php stag_markup_helper( array( 'context' => 'entry_content' ) ); ?>>
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'stag' ), admin_url( 'post-new.php' ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'stag' ); ?></p>

		<?php else : ?>

			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'stag' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
