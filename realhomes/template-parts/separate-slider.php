<?php
/**
 * Slider for slides custom post type
 */
$number_of_slides = intval( get_option( 'theme_number_custom_slides' ) );
if ( ! $number_of_slides ) {
	$number_of_slides = 5;
}

$slides_arguments = array(
	'post_type' => 'slide',
	'posts_per_page' => $number_of_slides
);

$slides_query = new WP_Query( $slides_arguments );

if ( $slides_query->have_posts() ) {
	?>
	<!-- Slider -->
	<div id="home-flexslider" class="clearfix">
		<div class="flexslider loading">
			<ul class="slides">
				<?php
				while ( $slides_query->have_posts() ) :
					$slides_query->the_post();

					if ( has_post_thumbnail() ) {
						$image_id = get_post_thumbnail_id();
						$slider_image_url = wp_get_attachment_url( $image_id );
						$slide_title = get_the_title();
						$slide_sub_text = get_post_meta( $post->ID, 'slide_sub_text', true );
						$slide_url = get_post_meta( $post->ID, 'slide_url', true );
						if ( ! empty( $slide_url ) ) {
							$slide_url = addhttp( $slide_url );
						}
						?>
						<li>
							<div class="desc-wrap">
								<?php
								if ( ! empty( $slide_title ) || ! empty( $slide_sub_text ) ) {
									?>
									<div class="slide-description">
										<?php
										if ( ! empty( $slide_title ) ) {
											?>
											<h3>
												<?php
												if ( $slide_url ) {
													echo '<a href="' . esc_url( $slide_url ) . '">';
													echo $slide_title;
													echo '</a>';
												} else {
													echo $slide_title;
												}
												?>
											</h3>
											<?php
										}

										if ( ! empty( $slide_sub_text ) ) {
											echo '<p>' . $slide_sub_text . '</p>';
										}

										if ( ! empty( $slide_url ) ) {
											echo '<a href="' . esc_url( $slide_url ) . '" class="know-more">' . __( 'Know More', 'framework' ) . '</a>';
										}
										?>
									</div>
									<?php
								}
								?>
							</div>
							<?php
							if ( ! empty( $slide_url ) ) {
								echo '<a href="' . esc_url( $slide_url ) . '">';
								echo '<img src="' . esc_url( $slider_image_url ) . '" alt="' . get_the_title() . '">';
								echo '</a>';
							} else {
								echo '<img src="' . esc_url( $slider_image_url ) . '" alt="' . get_the_title() . '">';
							}
							?>
						</li>
						<?php
					}
				endwhile;
				wp_reset_query();
				?>
			</ul>
		</div>
	</div>
	<!-- End Slider -->
	<?php
} else {
	get_template_part( 'banners/default_page_banner' );
}
?>