<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Total WordPress Theme
 * @subpackage Templates
 * @version 3.5.3
 */

get_header(); ?>
	
	<div id="content-wrap" class="container clr">

		<?php wpex_hook_primary_before(); ?>

		<div id="primary" class="content-area clr">

			<?php wpex_hook_content_before(); ?>

			<main id="content" class="clr site-content" role="main">

				<?php wpex_hook_content_top(); ?>

				<article class="entry clr">

					<?php
					// Check custom page content
					if ( wpex_get_mod( 'error_page_content_id' ) ) :
						$id   = wpex_global_obj( 'post_id' );
						$post = get_post( $id );
						echo apply_filters( 'the_content', $post->post_content );

					else :

						// Get error text
						$error_text = wpex_get_translated_theme_mod( 'error_page_text' );

						// Display custom text
						if ( ! empty( $error_text ) )  : ?>

							<div class="custom-error404-content clr">
								<?php echo apply_filters( 'the_content', $error_text ); ?>
							</div><!-- .custom-error404-content -->

						<?php
						// Display default text
						else : ?>

							<div class="error404-content clr">

								<h1><?php esc_html_e( 'You Broke The Internet!', 'total' ); ?></h1>
								<p><?php esc_html_e( 'We are just kidding...but sorry the page you were looking for can not be found.', 'total' ); ?></p>

							</div><!-- .error404-content -->

						<?php endif; ?>

					<?php endif; ?>

				</article><!-- .entry -->

				<?php wpex_hook_content_bottom(); ?>

			</main><!-- #content -->

			<?php wpex_hook_content_after(); ?>

		</div><!-- #primary -->

		<?php wpex_hook_primary_after(); ?>

	</div><!-- .container -->
	
<?php get_footer(); ?>