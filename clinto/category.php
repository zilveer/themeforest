<?php get_header(); ?>

<?php get_template_part( 'partials/primary-nav' ); ?>

<section class="container">

	<div class="row-fluid">
		<div class="span12 header" style="background-image:url(<?php echo get_blog_header_image(); ?>); ">
			<div class="carousel-caption span8 offset2">
				<h1 class="archive-title"><?php printf( __( 'Category Archives: %s', 'spritz' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>
				<?php if ( category_description() ) : // Show an optional category description ?>
					<div class="archive-meta"><?php echo category_description(); ?></div>
				<?php endif; ?>
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