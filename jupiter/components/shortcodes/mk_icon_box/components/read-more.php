<?php if ( empty($view_params['read_more_txt']) ) return false; ?>

<a class="icon-box-readmore clearfix" href="<?php echo $view_params['read_more_url']; ?>">
		<?php echo $view_params['read_more_txt']; ?> 
		<?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-icon-caret-right', 16); ?>
</a>

