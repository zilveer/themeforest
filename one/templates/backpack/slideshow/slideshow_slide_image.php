<?php
$slide_content = '';

if ( $mode === 'bg' ) {
	$image = thb_image_get_size( $slide['id'], $images_size );
	$slide_attrs['style'] = 'background-image: url(' . $image . ')';
}
if ( $mode === 'img' ) {
	$slide_content = thb_get_image( $slide['id'], $images_size, array(
		'attr' => array(
			'class' => 'rsImg'
		)
	) );
}

?>

<div <?php thb_attributes( $slide_attrs ); ?> <?php thb_data_attributes( $slide_data ); ?>>
	<span class="thb-fake-background" <?php thb_attributes( $slide_attrs ); ?>></span>
	<?php echo $slide_content; ?>
	<?php
		if ( $slide['overlay_display'] ) {
			thb_overlay( $slide['overlay_color'], $slide['overlay_opacity'] );
		}
	?>
	<?php thb_slide_caption( $slide ); ?>
</div>