<?php get_header(); ?>

<?php get_template_part( 'nav' ); ?>

<?php while ( have_posts() ) : ?>

	<?php the_post(); ?>

	<?php get_template_part( 'view', is_retro_post_type() ? 'item' : 'article' ); ?>

<?php endwhile; ?>

<?php get_footer(); ?>