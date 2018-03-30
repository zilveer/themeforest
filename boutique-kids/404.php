<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage boutique
 * @since boutique 1.0
 */


if ( ! defined( 'ABSPATH' ) ) exit;

get_header(); ?>

	<div id="primary">
		<div id="content" role="main">

			<div id="post-0" class="post error404 not-found">
				<?php do_action( 'boutique_page_header_before' ); ?>
				<div class="entry-header">
					<h1 class="entry-title"><?php esc_html_e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'boutique-kids' ); ?></h1>
				</div>
				<?php do_action( 'boutique_page_header_after' ); ?>

				<div class="entry-content">
					<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links below, can help.', 'boutique-kids' ); ?></p>

					<?php get_search_form(); ?>

					<?php the_widget( 'WP_Widget_Recent_Posts', array( 'number' => 10 ), array( 'widget_id' => '404' ) ); ?>

					<div class="widget">
						<h2 class="widgettitle"><?php esc_html_e( 'Most Used Categories', 'boutique-kids' ); ?></h2>
						<ul>
						<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
						</ul>
					</div>

					<?php
					/* translators: %1$s: smilie */
					$archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'boutique-kids' ), convert_smilies( ':)' ) ) . '</p>';
					the_widget( 'WP_Widget_Archives', array( 'count' => 0, 'dropdown' => 1 ), array( 'after_title' => '</h2>'.$archive_content ) );
					?>

					<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>

				</div><!-- .entry-content -->
			</div><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>
