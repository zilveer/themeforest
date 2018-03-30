<?php
get_header();
if (have_posts()) : while(have_posts()) : the_post(); ?>
<?php get_template_part( 'templates/pagehead' ); ?>
<section class="l-section">
	<div class="l-section-h g-html i-cf">
		<?php the_content(); ?>
	</div>
</section>
<?php endwhile; endif;
get_footer();