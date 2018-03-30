<div id="<?php echo $tab_id ?>" class="mk-tabs-pane">

	<div class="title-mobile">
		<?php if(isset($icon)) { ?>
			<i><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, $icon,16); ?></i> 
		<?php } ?>
		<?php echo $title ?>
	</div>
	<div class="mk-tabs-pane-content">
		<?php echo wpb_js_remove_wpautop( $content ) ?>
	</div>	

	<div class="clearboth"></div>
</div>