<?php

if ( ! isset( $slides ) ) {
	$slides = '';
}

if ( ! isset( $image_size ) ) {
	$image_size = '';
}

if ( ! isset( $featured_image_config ) ) {
	$featured_image_config = '';
}

if ( ! isset( $slides_config ) ) {
	$slides_config = array();
}

$is_slideshow = thb_get_post_meta( thb_get_page_ID(), 'one_single_work_slideshow' ) == '1';
$classes = '';

if ( $is_slideshow ) {
	$classes .= 'thb-work-slideshow rsTHB';
}

$slides = ( array ) $slides;

?>

<div class="<?php echo $classes; ?> work-slides-container thb-images-container" data-count="<?php echo count( $slides ); ?>">
	<?php
		if ( empty( $slides ) ) {
			thb_featured_image( $image_size, $featured_image_config );
		} else {
			foreach ( $slides as $slide ) {
				echo "<div class='slide thb-image-wrapper " . $slide['class'] . "'>";
					if ( $slide['type'] == 'image' ) {
						if ( ! isset( $slides_config['attr'] ) ) {
							$slides_config['attr'] = array();
						}

						$slides_config['attr']['class'] = 'rsImg';

						thb_image( $slide['id'], $image_size, $slides_config );
					}
					else {
						echo "<a class='mfp-iframe' href='" . $slide['id'] . "'></a>";
						thb_video( $slide['id'], array( 'holder' => false ) );
					}

					if ( $slide['caption'] != '' ) {
						echo "<div class='thb-caption-content'>";
							echo $slide['caption'];
						echo "</div>";
					}
				echo "</div>";
			}
		}
	?>
</div>