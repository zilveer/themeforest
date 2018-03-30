<?php
get_header();
the_post();
?>

	<section id="main">
		<div class="wrapper">
			<h2><?php the_title(); ?></h2>
			<?php the_content(); ?>

			<?php if ( comments_open() ) : ?>
			<div class="sep"><span></span></div>
			<?php comments_template( '', true ); ?>
			<?php endif; ?>
		</div>
	</section>

<?php get_footer(); ?>