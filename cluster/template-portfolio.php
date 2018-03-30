<?php
/*
 * Template Name: Portfolio
 *
 */

get_header(); ?>

<!--BEGIN #primary .hfeed-->
<div id="primary" class="full" role="main">

	<?php while ( have_posts() ): the_post(); ?>

		<?php if ( stag_get_option( 'portfolio_style' ) == 'filterable' ) : ?>
			<ul id="portfolio-filter" class="portfolio-filter">
				<li><a href="#" data-filter="*" class="current"><?php _e( 'All Items', 'stag' ); ?></a></li>
				<?php

				$terms     = get_terms( 'skill' );
				$all_terms = wp_list_pluck( $terms, 'slug' );

				if ( count ( $terms ) > 0 ) {
					foreach ( $terms as $term ) {
						echo '<li data-filter="' . $term->slug . '"><a href="#" data-filter=".'.$term->slug.'">'.$term->name.'</a></li>';
					}
				}

				?>
			</ul>
		<?php endif; ?>
	<?php endwhile; ?>

	<div class="portfolio-items">
		<div id="filterable-portfolio" class="grids portfolios" data-filter-type="<?php echo stag_get_option( 'portfolio_style' ); ?>">
			<?php
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$query = new WP_Query(array(
				'post_type'      => 'portfolio',
				'posts_per_page' => stag_get_option( 'portfolio_count' ),
				'paged'          => $paged,
				'meta_query'     => array(
					array( 'key' => '_thumbnail_id'),
					),
				));

			$unique_skills = array();

			while ( $query->have_posts() ) : $query->the_post();

			if ( ! has_post_thumbnail() ) continue;

			$skills = get_the_terms( get_the_ID(), 'skill' );

			$class = 'grid-4';

			if ( is_array( $skills ) ) {
				$unique_skills = wp_list_pluck( $skills, 'slug' );
				$class .= ' ' . implode( ' ', $unique_skills );
			}

			?>

			<div <?php post_class( $class ); ?>>
				<div class="overlay">
					<h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( __( 'Permanent Link to %s', 'stag' ), get_the_title() ); ?>"> <?php the_title(); ?></a></h3>
					<div class="portfolio-navigation">
						<a href="<?php the_permalink(); ?>" class="accent-background portfolio-trigger" data-id="<?php the_ID(); ?>"><i class="icon-eye"></i></a>
						<a href="<?php the_permalink(); ?>" class="accent-background" rel="bookmark" title="<?php printf( __( 'Permanent Link to %s', 'stag' ), get_the_title() ); ?>"><i class="icon-post-link"></i></a>
					</div>
				</div>
				<?php the_post_thumbnail( 'portfolio-thumbnail' ); ?>
			</div>


			<?php endwhile; ?>
			<?php wp_reset_query(); ?>

			<span id="all-skills" data-all-skills='<?php echo json_encode( array_values( array_unique( $unique_skills ) ) ); ?>' data-all-filters='<?php echo json_encode( array_unique( $all_terms ) ); ?>'></span>
		</div>
		<?php
		if ( $query->max_num_pages > 1 ) : ?>
		<a href="#" class="button" id="load-more"><?php _e( 'Load More', 'stag' ); ?></a>
	<?php endif; ?>

</div>


<!--END #primary .hfeed-->
</div>

<?php get_footer(); ?>
