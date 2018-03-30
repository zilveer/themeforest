<?php get_header(); 

get_template_part('inc/blog-title'); ?>

<section id="content"> 
	<div class="container">

		<?php if ( have_posts() ) :

			while ( have_posts() ) : the_post();

				get_job_manager_template_part( 'content-single', 'job_listing' );

			endwhile;

		else :

			get_template_part( 'content', 'none' );

		endif; ?>

	</div>
</section>

<?php get_footer(); ?>
