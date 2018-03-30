<?php get_header(); ?>

<section id="title">
	<div class="container">
		<h1><?php echo apply_filters( 'jobseek_job_archives_title', __( 'Jobs', 'jobseek' ) ); ?></h1>
	</div>
</section>

<section id="content">
	<div class="container">

		<?php echo do_shortcode( '[jobs]' ); ?>

	</div>
</section>

<?php get_footer(); ?>