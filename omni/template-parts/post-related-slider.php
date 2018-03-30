<?php
/**
 * The template for related posts output slider style
 *
 * @package strawberry
 */

$hide_meta = get_query_var('show_meta');
$hide_excerpt = get_query_var('show_excerpt');

if ( class_exists('RP4WP') ) {
	$excerpt_length_options = RP4WP::get()->settings->get_option( 'excerpt_length' );
	$heading_text_options = RP4WP::get()->settings->get_option( 'heading_text' );
}

if(isset($heading_text_options) && !empty($heading_text_options)){
	$heading_text = $heading_text_options;
}else{
	$heading_text = esc_html__( 'Related Posts', 'omni' );
}

if(isset($excerpt_length_options) && !empty($excerpt_length_options)){
	$excerpt_length = $excerpt_length_options;
}else{
	$excerpt_length = 15;
}

$related_posts_output = '';

if ( class_exists( 'RP4WP_Post_Link_Manager' ) && is_singular( 'post' ) ) {

	$related_posts_class = new RP4WP_Post_Link_Manager;

	$related = $related_posts_class->get_children( get_the_ID() );

	$related_posts_output .= '<h2 class="h2 titel-left">' . $heading_text . '</h2><!-- end widget-title -->';

	$related_posts_output .= '<div class="related-posts-slider swiper-container horizontal-pagination" data-autoplay="0" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="2" data-lg-slides="2">';

	$related_posts_output .= '<div class="swiper-wrapper">';

	if ( $related ) {
		foreach ( $related as $result ) {

			if ( has_post_thumbnail( $result->ID ) ) {
				$post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $result->ID ), 'full' );
			} else {
				$post_thumbnail[0] = get_template_directory_uri() . '/img/no-image.png';
			}

			$related_posts_output .= '<div class="swiper-slide">';
			$related_posts_output .= '<div class="related-entry content">';

			$related_posts_output .= '<img src="' . esc_url( crum_theme_thumb( $post_thumbnail[0], '370', '220', true ) ) . '" alt="" />';
			$related_posts_output .= '<a class="title" href="' . esc_url( get_the_permalink( $result->ID ) ) . '">' . get_the_title( $result->ID ) . '</a>';

			if ( !(true === $hide_meta) ) {
				$args = array(
					'post_id'         => $result->ID,
					'show_author'     => true,
					'show_categories' => true,
					'show_date'       => false,
					'show_comments'   => false,
					'avatar_size'     => 60,
				);
				ob_start();
				omni_posted_on( $args );
				$related_posts_output .= ob_get_clean();
			}

			if ( !(true === $hide_excerpt) ) {
				$related_posts_output .= '<div class="description">';
				$post_excerpt = get_post_field( 'post_excerpt', $result->ID );
				if ( isset( $post_excerpt ) && ! ( empty( $post_excerpt ) ) ) {
					$post_content = $post_excerpt;
				} else {
					$post_content = strip_tags( get_post_field( 'post_content', $result->ID ) );
				}

				$post_content = strip_shortcodes( $post_content );
				$related_posts_output .= wp_trim_words($post_content,$excerpt_length);
				$related_posts_output .= '</div>';
			}

			$related_posts_output .= '</div>';
			$related_posts_output .= '</div>';//swiper-slide

		}


		$related_posts_output .= '</div>';//swiper-wrapper

		$related_posts_output .= '<div class="pagination"></div>';

		$related_posts_output .= '</div>';//swiper-container

		echo $related_posts_output; // WPCS: XSS OK.
	}
}
