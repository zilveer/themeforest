<?php
	$slide_data['autoplay'] = (int) $slide['autoplay'];
	$slide_data['loop']     = (int) $slide['loop'];
	$slide_data['fit']      = (int) $slide['fit'];
?>

<div <?php thb_attributes( $slide_attrs ); ?> <?php thb_data_attributes( $slide_data ); ?>>
	<?php thb_video( $slide['id'] ); ?>
	<?php thb_overlay(); ?>
	<?php thb_slide_caption( $slide ); ?>
</div>