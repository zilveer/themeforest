<?php get_header();

get_template_part('inc/blog-title'); ?>

<section id="content">
	<div class="container">
		<div class="vc_row">
			<div class="vc_col-sm-8">

				<?php if ( have_posts() ) : 

					while ( have_posts() ) : the_post();

						if ( is_single() && (get_post_type() == 'post') ) {

							get_template_part( 'content-single', get_post_format() );

						} else {

							get_template_part( 'content', get_post_format() );

						}

					endwhile; 

					the_posts_pagination();

				else :

					get_template_part( 'content', 'none' );

				endif; ?>

			</div>

			<div class="sidebar vc_col-sm-4">
				<?php get_sidebar(); ?>
			</div>

		</div>
	</div>
</section>

<?php get_footer(); ?>