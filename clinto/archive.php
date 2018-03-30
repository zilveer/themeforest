<?php get_header(); ?>

<?php get_template_part( 'partials/primary-nav' ); ?>

<section class="container">

	<div class="row-fluid">
		<div class="span12 header" style="background-image:url(<?php echo get_blog_header_image(); ?>); ">
			<div class="carousel-caption span8 offset2">
				<h1><?php _e( 'Archives', 'spritz' ); ?> <small>
					<?php if ( is_day() ) : ?>
						<?php printf( __( 'Daily Archives: %s', 'spritz' ), '<span>' . get_the_date() . '</span>' ); ?>
					<?php elseif ( is_month() ) : ?>
						<?php printf( __( 'Monthly Archives: %s', 'spritz' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'spritz' ) ) . '</span>' ); ?>
					<?php elseif ( is_year() ) : ?>
						<?php printf( __( 'Yearly Archives: %s', 'spritz' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'spritz' ) ) . '</span>' ); ?>
					<?php endif; ?>
				</small></h1>
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
				<div class="offset2 span8">
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