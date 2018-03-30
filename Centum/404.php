<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Centum
 */

get_header(); ?>
<!-- 960 Container -->
<div class="container">

	<div class="sixteen columns">

		<!-- Page Title -->
		<div id="page-title">
			<h1><?php _e( 'Oops! That page can&rsquo;t be found.', 'centum' ); ?></h1>

		
			<div class="clear"></div>

			<div id="bolded-line"></div>
		</div>
		<!-- Page Title / End -->

	</div>
</div>
<!-- 960 Container / End -->
	<!-- 960 Container -->
	<div class="container">

		<!-- Post -->

		<div <?php post_class(''); ?> id="post-<?php the_ID(); ?>" >
			<div class="sixteen columns">
				<div class="columns two-third alpha">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'centum' ); ?></p>
				</div>
				<div class="columns one-third omega">
					<?php get_search_form(); ?>
				</div>
				<div class="columns four alpha">
				

					<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

				</div>
				<div class="columns four">
					<?php if ( centum_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
					<div class="widget widget_categories">
						<h2 class="widget-title"><?php _e( 'Most Used Categories', 'centum' ); ?></h2>
						<ul>
						<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
						?>
						</ul>
					</div><!-- .widget -->
					<?php endif; ?>
				</div>
				<div class="columns four">
					<?php
						/* translators: %1$s: smiley */
						$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'centum' ), convert_smilies( ':)' ) ) . '</p>';
						the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
					?>
				</div>
				<div class="columns four omega">
					<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
				</div>
			</div>
		</div>
	

<?php get_footer(); ?>
