<?php get_header(); ?>

<section id="title">
	<div class="container">
		<h1><?php the_title(); ?></h1>
	</div>
</section>

<section id="content">
	<div class="container">

		<?php if ( have_posts() ) :

			while ( have_posts() ) : the_post();

				the_content();

				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'modellic' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'modellic' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				) );

				if ( comments_open() ) {
					comments_template();
				}

			endwhile; 

		else :

			get_template_part( 'content', 'none' );

		endif; ?>

	</div>
</section>

<?php get_footer(); ?>