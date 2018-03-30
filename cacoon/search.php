<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package metcreative
 */

get_header(); ?>

<div class="met_content">
	<div class="row-fluid">
		<div class="span12">
			<div class="met_page_header met_bgcolor5 clearfix">
				<h1 class="met_bgcolor met_color2"><?php echo __( 'Search Results', 'metcreative' ); ?></h1>
				<h2 class="met_color2"><?php echo get_search_query(); ?></h2>
			</div>
		</div>
	</div>

	<?php if ( have_posts() ) : ?>

		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'search' ); ?>

		<?php endwhile; ?>

		<?php metcreative_content_nav( 'nav-below' ); ?>

	<?php else : ?>

		<?php get_template_part( 'no-results', 'search' ); ?>

	<?php endif; ?>
</div>

<?php get_footer(); ?>