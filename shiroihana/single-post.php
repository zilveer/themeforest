<?php get_header(); ?>

<div class="site-content">

	<div class="container">

		<div class="row">

			<?php shiroi_before_entries(); ?>

				<?php if( have_posts() ) : 

					while( have_posts() ) : the_post();

						Youxi()->templates->get( 'entry', get_post_format(), get_post_type() );

					endwhile;

				endif; ?>

			<?php shiroi_after_entries(); ?>

		</div>

	</div>

</div>

<?php get_footer(); ?>