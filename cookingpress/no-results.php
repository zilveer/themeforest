<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package CookingPress
 */
?>


	<h3><span><?php _e( 'Nothing Found', 'cookingpress' ); ?></span></h3>


	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'cookingpress' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'cookingpress' ); ?></p>
			<?php  get_template_part( 'searchformadv' );  ?>

		<?php else : ?>

			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'cookingpress' ); ?></p>
			<?php  get_template_part( 'searchformadv' ); ?>

		<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
