<?php

if($view_params['style'] == 'modern') {
	$controlNav = 'true';
	$directionNav = 'false';
} else {
	$controlNav = 'false';
	$directionNav = 'true';
}

$slide_atts[] = 'data-isCarousel="false"';
$slide_atts[] = 'data-animation="fade"';
$slide_atts[] = 'data-easing="swing"';
$slide_atts[] = 'data-direction="horizontal"';
$slide_atts[] = 'data-smoothHeight="false"';
$slide_atts[] = 'data-pauseOnHover="true"';
$slide_atts[] = 'data-animationSpeed="'.$view_params['animation_speed'].'"';
$slide_atts[] = 'data-slideshowSpeed="'.$view_params['slideshow_speed'].'"';
$slide_atts[] = 'data-controlNav="'.$controlNav.'"';
$slide_atts[] = 'data-directionNav="'.$directionNav.'"';

?>

<div class="mk-testimonial mk-script-call mk-flexslider js-flexslider <?php echo $view_params['style']; ?>-style <?php echo $view_params['skin'].'-version '.$view_params['el_class']; ?> <?php echo $view_params['animation_css']; ?> clearfix" id="testimonial_<?php echo $view_params['id']; ?>" <?php echo implode(' ', $slide_atts); ?>>
	<?php if ( $view_params['style'] == 'simple' ) { ?>
		<?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-moon-quotes-left') ?>
		<?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-moon-quotes-right') ?>
	<?php } ?>
	<ul class="mk-flex-slides">
		<?php
		$i = 0;
		while ( $view_params['loop']->have_posts() ):
			$view_params['loop']->the_post();
			$i++;

			echo mk_get_shortcode_view('mk_testimonials', 'loop-styles/'.$view_params['style'], true, ['column_class' => '']);

		endwhile;

		wp_reset_query();

		?>
	</ul>
	<div class="clearboth"></div>
</div>