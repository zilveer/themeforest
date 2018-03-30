<?php
/**
 * The template for displaying a "No posts found" message
 *
 * @package WordPress
 * @subpackage Houzez
 * @since Houzez 1.0
 */
$allowed_html_array = array(
	'a' => array(
		'href' => array(),
		'title' => array()
	)
);
?>

<section class="section-detail-content">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-12 container-contentbar">
				<div class="article-main">
					<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

						<p><?php printf( wp_kses(__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>', 'houzez' ), $allowed_html_array ), admin_url( 'post-new.php' ) ); ?></p>
					<?php elseif ( is_search() ) : ?>

						<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'houzez' ); ?></p>
						<div class="widget_search">
							<?php get_search_form(); ?>
						</div>

					<?php else : ?>

						<p><?php esc_html_e( 'It seems we cannot find what you are looking for. Perhaps searching can help.', 'houzez' ); ?></p>
						<div class="widget_search">
							<?php get_search_form(); ?>
						</div>

					<?php endif; ?>

				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-md-offset-0 col-sm-offset-3 container-sidebar">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</section>