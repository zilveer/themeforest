<?php

$taxonomy = get_taxonomy( get_queried_object()->taxonomy );

get_header(); ?>

<section id="title">
	<div class="container">
		<h1><?php if( $taxonomy ) : echo esc_attr( $taxonomy->labels->singular_name ); echo ":"; endif; ?> <?php single_term_title(); ?></h1>
	</div>
</section>

<section id="content">
	<div class="container">

		<?php echo do_shortcode('[jobs_by_tag tag="'. get_query_var('term') .'" per_page="10"]'); ?>

	</div>
</section>

<?php get_footer(); ?>