<?php get_header(); ?>

<section id="title">
	<div class="container">
		<h1><?php _e( 'Testimonials', 'jobseek' ); ?></h1>
	</div>
</section>

<section id="content">
	<div class="container">

		<?php if ( is_active_sidebar( 'testimonials-archive' ) ) { ?>

			<div class="vc_row">

				<div class="vc_col-sm-8"><?php } ?>

					<?php if ( have_posts() ) :

						while ( have_posts() ) : the_post();

							get_template_part( 'content-testimonial', get_post_format() );

						endwhile;

					else :

						get_template_part( 'content', 'none' );

					endif;

					if ( is_active_sidebar( 'testimonials-archive' ) ) { ?>
						
				</div>

				<div class="vc_col-sm-4" id="sidebar">
					<?php dynamic_sidebar( 'testimonials-archive' ); ?>	
				</div>

			</div>

		<?php } ?>

	</div>
</section>

<?php get_footer(); ?>