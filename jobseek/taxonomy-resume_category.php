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

		<?php echo do_shortcode('[resumes categories='.get_query_var('resume_category').' show_filters="false" show_pagination="true"]')?>

	</div>
</section>

<?php get_footer(); ?>