<?php get_header(); ?>

<section id="title">
	<div class="container">
		<h1><?php echo apply_filters( 'resume_archives_title', __( 'Candidates', 'jobseek' ) ); ?></h1>
	</div>
</section>

<section id="content">
	<div class="container">

		<?php echo do_shortcode( '[resumes]' ); ?>

	</div>
</section>

<?php get_footer(); ?>