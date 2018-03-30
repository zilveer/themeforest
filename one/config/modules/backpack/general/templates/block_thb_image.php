<?php
	$config = array();
	$caption_visible = $title != '' || $content != '';
	$lightbox_enabled = function_exists( 'thb_is_lightbox_enabled' ) && thb_is_lightbox_enabled();
	$image_size = isset( $image_size ) ? $image_size : 'full';

	if ( $open_lightbox == 1 && $lightbox_enabled ) {
		$config = array(
			'link' => true,
			'link_class'    => 'item-thumb',
			'overlay'       => true,
			'overlay_class' => 'thb-overlay'
		);
	}
	else {
		$link_href = isset( $link_href ) ? $link_href : '';
		$link_target_blank = isset( $link_target_blank ) ? (bool) $link_target_blank : false;

		if ( ! empty( $link_href ) ) {
			if ( is_numeric( $link_href ) ) {
				$link_href = get_permalink( $link_href );
			}

			$config = array(
				'link'          => true,
				'link_class'    => '',
				'link_href'     => $link_href,
				'overlay'       => false
			);

			if ( $link_target_blank ) {
				$config['link_target'] = '_blank';
			}
		}
	}
?>

<?php if ( $caption_visible ) : ?>
	<div class="thb-section-block-header">
		<?php if ( $title != '' ) : ?>
			<h1 class="thb-section-block-title"><?php echo thb_text_format( $title ); ?></h1>
		<?php endif; ?>
	</div>

	<?php if ( $content != '' ) : ?>
		<div class="thb-text">
			<?php echo thb_text_format( $content, true ); ?>
		</div>
	<?php endif; ?>
<?php endif; ?>

<div class="thb-section-block-thb_image-image-holder <?php if ( $caption_visible ) : ?>w-text<?php endif; ?>">
	<?php thb_image( $image, $image_size, $config ); ?>
</div>