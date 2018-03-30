<?php
$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

$id = Mk_Static_Files::shortcode_id();

if(strpos( $style, 'mk-') === 0) {
	
	$icon_class = $style;

} else {
	if ( substr( $style, 0, 1 ) == 'f' ) {

		$font_family = 'awesome-icons';

	} else if(substr( $style, 0, 2 ) == 'e6' ) {

		$font_family = 'pe-line-icons';

	} else {

		$font_family = 'icomoon';
	}
	$icons = new Mk_SVG_Icons();
	$icon_class = $icons->get_class_name_by_unicode($font_family, $style);
}


Mk_Static_Files::addCSS('
#list-'.$id.' {margin-bottom:'.$margin_bottom.'px}
#list-'.$id.' ul li .mk-svg-icon { fill:'.$icon_color.' }', $id);


$class[] = get_viewport_animation_class($animation);
$class[] = 'mk-align-'.$align;
$class[] = $el_class;

?>

<div id="list-<?php echo $id; ?>" class="mk-list-styles <?php echo implode(' ', $class); ?> clear" data-charcode="<?php echo $style; ?>" data-family="<?php echo $font_family; ?>">
	
	<?php mk_get_view('global', 'shortcode-heading', false, ['title' => $title]); ?>

	<?php 

		$content =  wpb_js_remove_wpautop( $content, true );

		echo str_replace('<li>', '<li>'.Mk_SVG_Icons::get_svg_icon_by_class_name(false, $icon_class, 16), $content);
	 ?>

</div>