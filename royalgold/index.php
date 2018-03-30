<?php get_header(); ?>

	<section id="main">
		<div class="wrapper">
<?php if ( is_search() ) : ?>
			<h2><?php printf( __( 'Search results for &#8216;%s&#8217;', 'royalgold' ), esc_attr( get_search_query() ) ) ?></h2>
			<div class="sep"><span></span></div>
<?php endif; ?>
<?php get_template_part( 'part-loop' ); ?>

		</div>
	</section>

<?php
wp_reset_query();
get_footer(); ?>