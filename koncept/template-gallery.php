<?php
/**
 * Template Name: Gallery
 */
get_header(); ?>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); 

		$style = get_post_meta( $post->ID, 'gallery_style', true );

		$ratio = get_post_meta( $post->ID, 'gallery_ratio', true );
		$r = explode( ':', $ratio );

		$cols = get_post_meta( $post->ID, 'gallery_cols', true );
		$c = $cols == 'two' ? 648 : ( $cols == 'three' ? 432 : 324 );
		$img_factor = '0';
	?>

	<?php if ( get_post_meta( $post->ID, 'gallery_content', true ) == 'content-above' ) {
		the_content(); 
	} ?>

	<div id="portfolio-holder" class="clearfix">

		<ul id="portfolio" class="folio-grid cols-<?php echo $cols; ?> layout-<?php echo $style; ?> clearfix">

			<?php

			$slides = explode( ',', get_post_meta( $post->ID, 'pp_gallery_slider', true ) );

			if ( ! empty( $slides ) ) : 

				foreach ( $slides as $slide_id ) :

					$img_url = wp_get_attachment_image_src( $slide_id, 'full' );

					if ( $style == 'fixed' ) {

						switch ( $cols ) {

							case 'two':
								$img_width = 648;
								$img_height = ceil( $img_width / $r[0] * $r[1] );
								break;

							case 'three':
								$img_width = 432;
								$img_height = ceil( $img_width / $r[0] * $r[1] );
								break;

							default:
								$img_width = 324;
								$img_height = ceil( $img_width / $r[0] * $r[1] );
								break;

						}

						$image = aq_resize( $img_url[0], $img_width, $img_height, true, false ); 
						 
					} else if ( $style == 'masonry' ) {

						$img_factor = 1;
						$img_width = $c;

						$image = aq_resize( $img_url[0], $img_width, null, false, false );

					} else if ( $style == 'masonry-advanced' ) {

						$img_factor = floor( $img_url[1] / $c );
						
						$img_width = $img_factor * $c;
						
						$image = aq_resize( $img_url[0], $img_width, null, false, false );

					}

				?>

				<li class="item" data-factor="<?php echo $img_factor; ?>">

					<a href="<?php echo $img_url[0]; ?>" data-fancybox-title="<?php echo get_post( $slide_id )->post_excerpt; ?>" data-fancybox-group="gallery-template" class="fancybox fancybox-thumb">

						<img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" alt="<?php echo get_post( $slide_id )->post_title; ?>" />

					</a>

				</li>

				<?php endforeach;

			endif; ?>

		</ul>

	</div>
	
	<?php if ( get_post_meta( $post->ID, 'gallery_content', true ) == 'content-below' ) {
		the_content(); 
	} ?>

	<?php endwhile;     

get_footer(); ?>