<?php

extract( shortcode_atts( array(
			'src' => '',
			'animation' => '',
			'speed' => 2000,
			'height' => 300,
			'link' => '',
			'target' => '_self',
			'el_class' => '',
			'visibility' => ''
		), $atts ) );

$animation_css = ($animation != '') ? (' mk-animate-element ' . $animation . ' ') : '';
$image_id = mk_get_attachment_id_from_url($src);
$alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
$title = get_the_title($image_id);

?>

<div class="mk-window-scroller <?php echo $visibility; ?> <?php echo $animation_css.$el_class; ?>" data-speed="<?php echo $speed; ?>" data-height="<?php echo $height; ?>" onclick="return true">
	
	<div class="window-top-bar"><span></span></div>

	<?php if(!empty($link)) { ?>
		<a target="<?php echo $target; ?>" href="<?php echo $link; ?>">
	<?php } ?>

	<div class="image-holder" style="height:<?php echo $height; ?>px">
		<img alt="<?php echo $alt; ?>" title="<?php echo $title; ?>" src="<?php echo $src; ?>" />
	</div>
	
	<?php if(!empty($link)) { ?>
		</a>
	<?php } ?>

	<div class="clearboth"></div>
</div>
