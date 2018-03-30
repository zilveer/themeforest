<?php
switch($view_params['column']) {
		case 1 :
		$column_class = 'one-column';
		break;
		case 2 :
		$column_class = 'two-column';
		break;
		case 3 :
		$column_class = 'three-column';
		break;
		case 4 :
		$column_class = 'four-column';
		continue;
	}
?>

<div class="mk-testimonial js-el <?php echo $view_params['style']; ?>-style testimonial-column <?php echo $view_params['skin'].'-version '.$view_params['el_class']; ?> <?php echo $view_params['animation_css']; ?> clearfix" id="testimonial_<?php echo $view_params['id']; ?>" data-mk-component="Grid" data-grid-config='{"container":"#testimonial_<?php echo $view_params['id']; ?>", "item":".testimonial-item"}' >

	<?php if ( $view_params['style'] == 'simple' ) { ?>
		<?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-moon-quotes-left') ?>
		<?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-moon-quotes-right') ?>
	<?php } ?>
	<ul class="testimonial-ul clearfix">
		<?php
		$i = 0;
		while ( $view_params['loop']->have_posts() ):
			$view_params['loop']->the_post();
			$i++;

			echo mk_get_shortcode_view('mk_testimonials', 'loop-styles/'.$view_params['style'], true, ['column_class' => $column_class]);


			// if($i%$view_params['column'] == 0) {
			// 	echo '<div class="clearboth"></div>';
			// }

		endwhile;

		wp_reset_query();

		?>
	</ul>
	<div class="clearboth"></div>
</div>
