<?php
/**
 * Display the first gallery of the post as slider
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_post_gallery_slider' ) ) {
	/**
	 * Get the first gallery shortcode, grab the attachments ids and display a slider
	 *
	 * @param string $size
	 */
	function wolf_post_gallery_slider( $size = 'slide', $tag_id = null, $class = null, $post_id = null  ) {

		$array_ids = array();
		$post_id = ( $post_id ) ?  $post_id : get_the_ID();

		$tag_id = ( $tag_id ) ? esc_attr( $tag_id ) : 'post-gallery-slider-' . rand( 0, 999 );

		$content_post = get_post( $post_id );
		$content = $content_post->post_content;

		$pattern = get_shortcode_regex();
		if ( preg_match( "/$pattern/s", $content, $match ) ) {

			if ( isset( $match[3] ) && preg_match( '/\ ids="(.*)"/', $content, $ids ) ) {
				if ( $ids[1] ) {
					$array_ids = explode( ',', $ids[1] );
				}
			}
		}

		ob_start();
		if ( array() != $array_ids ) {
			?>
			<div id="<?php echo esc_attr( $tag_id ); ?>-container">
				<div id="<?php echo esc_attr( $tag_id ); ?>" class="flexslider post-gallery-slider <?php echo sanitize_html_class( $class ); ?> ">
					<ul class="slides">
						<?php foreach ( $array_ids as $attachment_id ) : ?>
						<li class="slide">
							<img src="<?php echo esc_url( wolf_get_url_from_attachment_id( $attachment_id, $size ) ); ?>">
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
			<?php
		}
		return ob_get_clean();
	}
}
