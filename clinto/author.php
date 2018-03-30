<?php get_header(); ?>

<?php get_template_part( 'partials/primary-nav' ); ?>

<section class="container">

	<div class="row-fluid">
		<div class="span12 header" style="background-image:url(<?php echo get_blog_header_image(); ?>); ">
			<div class="carousel-caption span8 offset2">
				<?php if ( have_posts() ): the_post(); ?>
					<h2 class="archive-title"><?php printf( __( 'Author Archives %s', 'spritz' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author_meta( 'display_name' ) . '</a></span>' ); ?></h2>
					<?php if ( get_the_author_meta( 'description' ) ) : ?>
						<p class="author-desc"><?php the_author_meta( 'description' ); ?></p>
					<?php endif; ?>
				<?php endif; ?>
				<?php rewind_posts(); ?>
			</div>
		</div>
	</div>

	<?php 
		$query = $wp_query;
		get_template_part( 'partials/loop' );
	?>

	<!-- Pagination -->
	<?php 
		if ( $wp_query->max_num_pages > 1 ) : ?>
			<div class="row">
				<div class="offset2 span8 ">
					<ul class="pager">
						<li class="previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Later posts' , 'eventorganiser' ), $query->max_num_pages ); ?></li>
						<li class="next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'eventorganiser' ), $query->max_num_pages ); ?></li>
					</ul>
				</div>
			</div>
	<?php endif; ?>		
	<!-- /Pagination -->

</section>

<?php get_footer(); ?>