<?php
/**
 * Shortcodes Helpers
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */

defined( 'ABSPATH' ) OR exit( 'restricted access' ); // Protect against direct call

/**
 * Get HTML section header
 *
 * @param $atts
 *
 * @return string
 */
function get_section_header( $atts )
{
	// Defaults
	$atts = shortcode_atts( array(
		'title'                      => '',
		'description'                => '',
		'padding_top'                => '',
		'padding_bottom'             => '',
		'background_color'           => '',
		'inverted'                   => 'no',
		'background_image'           => '',
		'background_parallax_image'  => '',
		'background_parallax_ratio'  => '0.5',
		'background_parallax_offset' => '-150',
		'background_video'           => '',
		'background_video_opacity'   => '0.1',
		'full_height'                => 'no',
		'id'                         => '',
		'classes'                    => '',
		'no_container'               => 'no',
	), $atts, 'su_mental_section' );

	if( is_numeric( $atts['background_image'] ) ) {
		$atts['background_image'] = wp_get_attachment_url( $atts['background_image'] );
	}
	if( is_numeric( $atts['background_parallax_image'] ) ) {
		$atts['background_parallax_image'] = wp_get_attachment_url( $atts['background_parallax_image'] );
	}

	if ( ! empty( $atts['background_parallax_image'] ) ) $atts['classes'] = @$atts['classes'] . ' parallax';
	if ( $atts['inverted'] != 'no' ) $atts['classes'] .= ' st-invert'; // Inverted section colors
	if ( $atts['full_height'] != 'no' ) $atts['classes'] .= ' st-full-height'; // Inverted section colors

	ob_start();
	?>

	<div class="section <?php echo @$atts['classes'] ?>" <?php echo empty( $atts['id'] ) ? '' : 'id="' . $atts['id'] . '"' ?>
		style="
			<?php if ( $atts['padding_top'] != '' ) { echo 'padding-top: ' . $atts['padding_top'] . 'px;'; } ?>
			<?php if ( $atts['padding_bottom'] != '' ) { echo 'padding-bottom: ' . $atts['padding_bottom'] . 'px;'; } ?>
			<?php if ( ! empty( $atts['background_color'] ) ) { echo 'background-color: ' . $atts['background_color'] . ';'; } ?>
			<?php if ( ! empty( $atts['background_image'] ) ) { echo ' background-image: url(\'' . $atts['background_image'] . '\');'; } ?>
			<?php if ( ! empty( $atts['background_parallax_image'] ) ) { echo ' background-image: url(\'' . $atts['background_parallax_image'] . '\');'; } ?>
			"
		<?php if ( ! empty( $atts['background_parallax_image'] ) && ! empty( $atts['background_parallax_ratio'] ) ) {
		echo ' data-stellar-background-ratio="' . $atts['background_parallax_ratio'] . '" '; } ?>
		<?php if ( ! empty( $atts['background_parallax_image'] ) && ! empty( $atts['background_parallax_offset'] ) ) {
		echo ' data-stellar-vertical-offset="' . $atts['background_parallax_offset'] . '" '; } ?>
	>

	<?php if ( ! empty( $atts['background_video'] ) ): ?>
		<div class="st-video-background" style="opacity: <?php echo esc_attr($atts['background_video_opacity']); ?>;">
			<video autoplay="autoplay" loop="loop" muted="muted" width="960" height="544">
                                <?php if (is_numeric($atts['background_video'])){?>
                                    <?php $videos = array(wp_get_attachment_url( $atts['background_video'] )); ?>
                                <?php }else{ ?>
                                    <?php $videos = explode( ' ', $atts['background_video'] ); ?>
                                <?php } ?>
				<?php foreach ( $videos as $video ): ?>
					<?php
					$type = pathinfo( $video, PATHINFO_EXTENSION );
					if ( $type == 'ogv' ) {
						$type = 'ogg';
					}
					?>
					<source src="<?php echo esc_url($video); ?>" type="video/<?php echo esc_attr($type); ?>">
				<?php endforeach ?>
			</video>
		</div>
	<?php endif ?>

	<section>

	<?php if ( ! empty( $atts['title'] ) || ! empty( $atts['description'] ) ): ?>
		<div class="section-title">
			<h2><?php echo @$atts['title'] ?></h2>

			<p class="section-descr">
				<?php echo @$atts['description'] ?>
			</p>
		</div>
	<?php endif ?>

	<?php
	return ob_get_clean();
}

/**
 * Get HTML section footer
 *
 * @param $atts
 *
 * @return string
 */
function get_section_footer( $atts )
{

	ob_start();
	?>

		</section>
	</div> <!-- section -->

	<?php
	return ob_get_clean();
}


/* ========================================================================= *\
   Other Helper Functions
\* ========================================================================= */


/**
 * Calculate bootstrap columns, default = 2 columns
 *
 * @param $columns
 *
 * @return int|string
 */
function calc_bootstrap_columns( $columns )
{
	switch ( $columns ) {
		case 1:
			return 12;
		case 2:
			return 6;
		case 3:
			return 4;
		case 4:
			return 3;
		case 5:
			return '24';
		case 6:
			return 2;
		default:
			return 6;
	}
}

/**
 * Parse Shortcode Ultimate image_source attribute
 *
 * @param $arrt_value
 * @param bool $url_only
 *
 * @return array
 */
function get_media_from_shotrcode_attribute( $arrt_value, $url_only = false )
{
	$media_items = array();

	foreach ( array( 'media', 'posts', 'category', 'taxonomy' ) as $type ) {
		if ( strpos( trim( $arrt_value ), $type . ':' ) === 0 ) {
			$arrt_value = array(
				'type' => $type,
				'val'  => (string) trim( str_replace( array( $type . ':', ' ' ), '', $arrt_value ), ',' )
			);
			break;
		}
	}
	// Source is not parsed correctly, return empty array
	if ( ! is_array( $arrt_value ) ) {
		return $media_items;
	}

	// Default posts query
	$query = array( 'posts_per_page' => - 1 );

	// Source: media
	if ( $arrt_value['type'] === 'media' ) {
		$query['post_type']   = 'attachment';
		$query['post_status'] = 'any';
		$query['post__in']    = (array) explode( ',', $arrt_value['val'] );
		$query['orderby']     = 'post__in';
	}
	// Source: posts
	if ( $arrt_value['type'] === 'posts' ) {
		if ( $arrt_value['val'] !== 'recent' ) {
			$query['post__in'] = (array) explode( ',', $arrt_value['val'] );
			$query['orderby']  = 'post__in';
		}
	} // Source: category
	elseif ( $arrt_value['type'] === 'category' ) {
		$query['category__in'] = (array) explode( ',', $arrt_value['val'] );
	} // Source: taxonomy
	elseif ( $arrt_value['type'] === 'taxonomy' ) {
		// Parse taxonomy name and terms ids
		$arrt_value['val'] = explode( '/', $arrt_value['val'] );
		// Taxonomy parsed incorrectly, return empty array
		if ( ! is_array( $arrt_value['val'] ) || count( $arrt_value['val'] ) !== 2 ) {
			return $slides;
		}
		$query['tax_query'] = array(
			array(
				'taxonomy' => $arrt_value['val'][0],
				'field'    => 'id',
				'terms'    => (array) explode( ',', $arrt_value['val'][1] )
			)
		);
	}
	// Query posts
	$query = new WP_Query( $query );
	// Loop through posts
	if ( is_array( $query->posts ) ) {
		foreach ( $query->posts as $post ) {
			// Get post thumbnail ID
			$thumb = ( $arrt_value['type'] === 'media' ) ? $post->ID : get_post_thumbnail_id( $post->ID );
			// Thumbnail isn't set, go to next post
			if ( ! is_numeric( $thumb ) ) {
				continue;
			}
			$slide         = array(
				'url'   => wp_get_attachment_url( $thumb ),
				'title' => get_the_title( $post->ID )
			);
			$media_items[] = $slide;
		}
	}

	if ( $url_only ) {
		return @$media_items[0]['url'];
	}

	// Return slides
	return $media_items;

}
