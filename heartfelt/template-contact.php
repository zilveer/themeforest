<?php
/**
 * Template Name: Contact
 *
 */
get_header(); ?>

<?php 
	if ( get_theme_mod( 'map_choice' ) ) :

		// Display Google Map
		echo '<div class="content_row_map clearfix">';

		$height = get_theme_mod( 'map_height', customizer_library_get_default( 'map_height' ) );
		$title = get_theme_mod( 'map_title', customizer_library_get_default( 'map_title' ) );
		$location = get_theme_mod( 'map_location', customizer_library_get_default( 'map_location' ) );
		$zoom = get_theme_mod( 'map_zoom', customizer_library_get_default( 'map_zoom' ) );

		echo '<div id="map_canvas_' . rand(1, 100) . '" class="googlemap rescue-all" style="height:' . esc_attr( $height ) . 'px;width:100%">';
			echo ( !empty ( $title ) ) ? '<input class="title" type="hidden" value="' . esc_attr( $title ) . '" />' : '';
			echo '<input class="location" type="hidden" value="' . esc_attr( $location ) . '" />';
			echo '<input class="zoom" type="hidden" value="' . esc_attr( $zoom ) . '" />';
			echo '<div class="map_canvas"></div>';

		echo '</div><!-- .googlemap -->';
		
		echo '</div><!-- .content_row_map -->';

	endif; // End Google Map
?>

<div class="row content_row">
	<div class="large-12 columns">

		<div id="primary" class="content-area">

			<main id="main" class="site-main" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'template-parts/content', 'full' ); ?>

					<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || '0' != get_comments_number() ) :
							comments_template();
						endif;
					?>

				<?php endwhile; // end of the loop. ?>

			</main><!-- #main .site-main -->

		</div><!-- #primary .content-area -->

	</div><!-- .large-12 -->

  </div><!-- .row .content_row -->

<?php get_footer(); ?>