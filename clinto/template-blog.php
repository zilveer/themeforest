<?php /* Template Name: Blog */ ?>

<?php get_header(); ?>

<?php get_template_part( 'partials/primary-nav' ); ?>

<section class="container">

	<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>

		<?php if ( has_post_thumbnail() ) : // the current post has a thumbnail

			//Get the Thumbnail URL
			$src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'slides', false, '' ); ?>

			<div class="row-fluid">
				<div class="span12 header" style="background-image:url(<?php echo $src[0] ?>); ">
					<div class="carousel-caption span8 offset2">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<p><?php the_excerpt(); ?></p>
					</div>
				</div>
			</div>

		<?php else: ?>
			<div class="row-fluid">
				<div class="span12 header" style="background-image:url(<?php echo get_blog_header_image(); ?>); ">
					<div class="carousel-caption span8 offset2">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<p><?php the_excerpt(); ?></p>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php 
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged') : 1;
			$args = array(
				'post_type'      => 'post',
				'posts_per_page' => 4,
				'paged'          => $paged
			);
			$query = new WP_Query( $args );
		?>
			
		<?php get_template_part( 'partials/loop' ); ?>

		<!-- Pagination -->
		<?php 
			if ( $query->max_num_pages > 1 ) : ?>
				<div class="row">
					<div class="offset2 span8 ">
					<ul class="pager">
						<li class=""><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Later posts' , 'eventorganiser' ), $query->max_num_pages ); ?></li>
						<li class=""><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'eventorganiser' ), $query->max_num_pages ); ?></li>
					</ul>
				</div>
			</div>
		<?php endif; ?>
		<!-- /Pagination -->

	<?php endwhile;  else: ?>

		<div class="row-fluid">
			<div class="offset2 span8">

				<!-- Article -->
				<article>
					<h1><?php _e( 'Sorry, nothing to display.', 'spritz' ); ?></h1>
					<p><?php _e( 'You are looking for an empty page. We are sorry for the inconvenience.', 'spritz' ); ?></p>
					<p><a href="/"><?php _e( 'Return to home', 'spritz' ); ?></a></p>
				</article>
				<!-- /Article -->

			</div>
		</div>

	<?php endif; ?>

</section>

<?php get_footer(); ?>