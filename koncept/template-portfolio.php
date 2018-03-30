<?php
/**
 * Template Name: Portfolio
 */
get_header(); ?>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); 

		$pag = get_post_meta( $post->ID, 'folio_pag', true );
		$per = get_post_meta( $post->ID, 'folio_per', true );

		$style = get_post_meta( $post->ID, 'folio_style', true );
		$animation = get_post_meta( $post->ID, 'folio_anim', true );
		$color = get_post_meta( $post->ID, 'folio_color', true );
		$info = get_post_meta( $post->ID, 'folio_info', true );

		$ratio = get_post_meta( $post->ID, 'folio_ratio', true );
		$r = explode( ':', $ratio );

		$cols = get_post_meta( $post->ID, 'folio_cols', true );
		$c = $cols == 'two' ? 648 : ( $cols == 'three' ? 432 : 324 );
		$img_factor = '0';

		$cats = get_post_meta( $post->ID, 'folio_cats', true );
		$query_filter = '';
		$filter_output = '<li><a href="#" data-filter="*" class="selected">' . __( 'All', 'krown' ) . '</a></li>';
		$show_cats = get_post_meta( $post->ID, 'folio_filter', true ) == 'enable-filters' ? true : false;

		if ( ! empty ( $cats ) ) {

			if ( sizeof( $cats ) == 1 ) {
				$show_cats = false;
			}

			foreach ( $cats as $cat ) {

				$filter = get_term_by( 'id', $cat, 'portfolio_category' ); 

				$query_filter .= $filter->slug . ',';

				$filter_output .= '<li><a href="#" data-filter=".' . $filter->slug . '">' . $filter->name . '</a></li>';

			}

		} else {

			$cats = get_categories( array( 'taxonomy'=>'portfolio_category' ) );

			foreach ( $cats as $cat ) {
				$filter_output .= '<li><a href="#" data-filter=".' . $cat->slug . '">' . $cat->name . '</a></li>';
			}

		}

	?>

	<?php if ( get_post_meta( $post->ID, 'folio_content', true ) == 'content-above' ) {
		the_content(); 
	} ?>

	<?php if ( $show_cats ) {

		echo '<div id="filter"><ul class="clearfix">' . $filter_output . '</ul></div>';

	} ?>

	<div id="portfolio-holder" class="clearfix">

		<ul id="portfolio" class="folio-grid cols-<?php echo $cols; ?> style-<?php echo $animation . ' ' . $color; ?> show-<?php echo $info; ?> layout-<?php echo $style; ?> clearfix">

			<?php

			$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : ( get_query_var( 'page' ) ? get_query_var( 'page' ) : 1 );

			$args = array(
				'post_type' => 'portfolio',
				'portfolio_category' => $query_filter,
				'posts_per_page' => ( $pag == 'no-pagination' ? -1 : $per ),
				'paged' => $paged
			);

			$all_posts = new WP_Query( $args ); 

			$page_id = $post->ID;

			while ( $all_posts->have_posts() ) : $all_posts->the_post();

				$thumb = get_post_thumbnail_id();
				$img_url = wp_get_attachment_image_src( $thumb, 'full' );

				if ( $thumb == '' ) {
					$img_url = Array( get_template_directory_uri() . '/images/blank_2.gif' );
				}

				$retina = krown_retina();
				$retina_thumb = get_post_meta( $post->ID, 'portfolio_retina-thumbnail_thumbnail_id', true );

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

					if ( $retina === 'true' && $retina_thumb != '' ) {

						$retina_url = wp_get_attachment_image_src( $retina_thumb, 'full' );
						$image = aq_resize( $retina_url[0], $img_width*2, $img_height*2, true, false );

					} else {

						$image = aq_resize( $img_url[0], $img_width, $img_height, true, false ); 

					}
					 
				} else if ( $style == 'masonry' ) {

					$img_factor = 1;
					$img_width = $c;

					if ( $retina === 'true' && $retina_thumb != '' ) {

						$retina_url = wp_get_attachment_image_src( $retina_thumb, 'full' );
						$image = aq_resize( $retina_url[0], $img_width*2, null, false, false );

					} else {

						$image = aq_resize( $img_url[0], $img_width, null, false, false );

					}  

				} else if ( $style == 'masonry-advanced' ) {

					$img_factor = floor( $img_url[1] / $c );
					
					$img_width = $img_factor * $c;

					if ( $retina === 'true' && $retina_thumb != '' ) {

						$retina_url = wp_get_attachment_image_src( $retina_thumb, 'full' );
						$image = aq_resize( $retina_url[0], $img_width*2, null, false, false );

					} else {

						$image = aq_resize( $img_url[0], $img_width, null, false, false );

					}  

				}
	 

			?>

				<li class="item <?php krown_categories( $post->ID, 'portfolio_category', ' ', 'slug' ); ?>" data-factor="<?php echo $img_factor; ?>">

					<a href="<?php echo get_new_permalink( $page_id, $post->ID, $cats ); ?>">

						<img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" alt="<?php the_title(); ?>" />

						<div class="caption">

							<div>

								<div>

									<h3><?php the_title(); ?></h3>

									<span class="category"><?php krown_categories( $post->ID, 'portfolio_category' ); ?></span>
									<span class="excerpt"><?php echo krown_excerpt( 'krown_excerptlength_post' ); ?></span>

								</div>

							</div>

						</div>

					</a>

				</li>

			<?php endwhile; 

			?>

		</ul>

	</div>

	<?php if ( $pag == 'classic' ) {
		krown_pagination( $all_posts, true );
	} else if ( $pag == 'infinte-loading' ) {
		echo '<div class="infinite-barrier"><span class="preloader"></span><p class="end">' . __( 'No More Projects', 'krown' ) . '</p><a id="infinite-link" href="' . next_posts( 0, false ) . '">' . __( 'Load More Projects', 'krown' ) . '</a></div>';
	} ?>

	<?php wp_reset_query(); ?>
	
	<?php if ( get_post_meta( $post->ID, 'folio_content', true ) == 'content-below' ) {
		the_content(); 
	} ?>

	<?php endwhile;     

get_footer(); ?>