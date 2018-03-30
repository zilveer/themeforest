<?php
$path = pathinfo(__FILE__) ['dirname'];
include ($path . '/config.php');

$icon = (!empty($icon)) ? ((strpos($icon, 'mk-') !== FALSE) ? $icon : ('mk-' . $icon)) : '';

$class[] = $visibility;
$class[] = $el_class;
$class[] = get_viewport_animation_class($animation);
?>

<div class="mk-content-box <?php echo implode(' ', $class); ?>">
	
	<span class="content-box-heading">
		<i><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, $icon); ?></i>
		<?php echo strip_tags( $heading ); ?>
	</span>
	
	<div class="content-box-content"><?php echo wpb_js_remove_wpautop( $content, true ); ?></div>

<div class="clearboth"></div>
</div>