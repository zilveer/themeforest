<?php
$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

?>

<div class="mk-accordion-single">
	
	<div class="mk-accordion-tab">
		<?php echo $icon; ?>
		<span><?php echo $title; ?></span>
		<?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-icon-chevron-right', 13); ?>
	</div>

	<div class="mk-accordion-pane">
		<?php echo wpb_js_remove_wpautop($content, true); ?>
		<div class="clearboth"></div>
	</div>

</div>