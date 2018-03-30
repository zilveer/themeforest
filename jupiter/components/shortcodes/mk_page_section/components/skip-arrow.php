<?php if($view_params['skip_arrow'] == 'false') return false; ?>

<div class="mk-skip-to-next" data-skin="<?php echo $view_params['skip_arrow_skin']; ?>">
	<?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-arrow-bottom', 16); ?>
</div>