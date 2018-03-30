<?php

/* Prepare query arguments */
$posts_per_page = absint( Youxi()->option->get( 'featured_slider_limit' ) );
$order = Youxi()->option->get( 'featured_slider_order' );
$orderby = Youxi()->option->get( 'featured_slider_orderby' );

$query_args = array(
	'posts_per_page' => $posts_per_page ? $posts_per_page : -1, 
	'post_type' => array( 'post', 'page' ), 
	'order' => $order, 
	'orderby' => $orderby, 
	'ignore_sticky_posts' => true, 
	'suppress_filters' => false, 
	'no_found_rows' => true, 
	'meta_query' => array(
		array(
			'key' => 'featured', 
			'value' => 1, 
			'compare' => '='
		)
	)
);

$featured_entries = get_posts( $query_args );

if( empty( $featured_entries ) ) {
	return;
}

global $post;
$tmp_post = $post;

$featured_entries_slider_class = array( 'featured-entries-slider' );

if( Youxi()->option->get( 'featured_slider_animate_text' ) ) {
	$featured_entries_slider_class[] = 'animation-enabled';
}
if( Youxi()->option->get( 'featured_slider_overlap' ) ) {
	$featured_entries_slider_class[] = 'overlap';
}

?><div class="<?php echo esc_attr( implode( ' ', $featured_entries_slider_class ) ) ?>">

	<div class="featured-entries-slider-wrap">

		<div class="fotorama" 
			data-auto="false" 
			data-nav="false" 
			data-fit="cover" 
			data-margin="0" 
			data-width="100%" 
			<?php if( $featured_slider_autoplay_timeout = Youxi()->option->get( 'featured_slider_autoplay_timeout' ) ): 
			?>data-autoplay="<?php echo esc_attr( $featured_slider_autoplay_timeout ) ?>" <?php endif; 
			?>data-transition="<?php echo esc_attr( Youxi()->option->get( 'featured_slider_transition' ) ) ?>" 
			data-transitionduration="<?php echo esc_attr( Youxi()->option->get( 'featured_slider_transition_duration' ) ) ?>"><?php

			foreach( $featured_entries as $post ) : setup_postdata( $post );

				$featured = wp_parse_args( $post->featured_post, array(
					'featured_image' => '', 
					'featured_meta'  => 'inherit'
				));

				/* Parse properties */
				if( 'inherit' == $featured['featured_meta'] ) {
					$featured_slider_meta = Youxi()->option->get( 'featured_slider_meta' );
				} else {
					$featured_slider_meta = $featured['featured_meta'];
				}

				$attachment_url = '';
				if( ! empty( $featured['featured_image'] ) ) {
					$attachment_image_src = wp_get_attachment_image_src( $featured['featured_image'], 'shiroi_featured' );
					if( is_array( $attachment_image_src ) && isset( $attachment_image_src[0] ) ) {
						$attachment_url = $attachment_image_src[0];
					}
				}
				if( ! $attachment_url && has_post_thumbnail() ) {
					$attachment_image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'shiroi_featured' );
					if( is_array( $attachment_image_src ) && isset( $attachment_image_src[0] ) ) {
						$attachment_url = $attachment_image_src[0];
					}
				}

			?><div class="featured-entries-slide"<?php if( $attachment_url ) echo ' data-img="' . esc_url( $attachment_url ) . '"'; ?>><?php

				?><div class="featured-entries-slide-content"><?php

					?><div class="container">

						<div class="row">

							<div class="col-md-8 col-md-push-2">

								<div class="wrap">

									<?php switch( $featured_slider_meta ) {
										case 'none':
											break;
										case 'author':
											echo '<span class="featured-entry-meta fotorama__select">' . __( 'By', 'shiroi' ) . ' ' . esc_html( get_the_author() ) . '</span>';
											break;
										case 'category':
											if( 'post' == $post->post_type && ( $categories = get_the_category() ) ) {
												echo '<span class="featured-entry-meta fotorama__select">' . sprintf( __( 'Posted in %s', 'shiroi' ), implode( ', ', wp_list_pluck( $categories, 'name' ) ) ) . '</span>';
											}
											unset( $_terms );
											break;
										case 'tags':
											if( 'post' == $post->post_type && ( $tags = get_the_tags() ) ) {
												echo '<span class="featured-entry-meta fotorama__select">' . implode( ', ', wp_list_pluck( $tags, 'name' ) ) . '</span>';
											}
											break;
										case 'date':
										default:
											echo '<time class="featured-entry-meta fotorama__select" datetime="' . esc_attr( get_the_date( 'c' ) ) . '">';
												echo get_the_date( get_option( 'date_format' ) );
											echo '</time>';
											break;
									}

									the_title( '<h1 class="featured-entry-title fotorama__select">', '</h1>' );

									?><div class="featured-entry-read-more fotorama__select">
										<a href="<?php echo esc_url( get_permalink() ) ?>" title="<?php the_title_attribute(); ?>">
											<?php _e( 'Read Now', 'shiroi' ) ?>
										</a>
									</div>

								</div>

							</div>

						</div>

					</div>

				</div>

			</div><?php

			endforeach;

			$post = $tmp_post;
			if( is_a( $post, 'WP_Post' ) ) {
				setup_postdata( $post );
			}

			?>

		</div>

	</div>

</div>
