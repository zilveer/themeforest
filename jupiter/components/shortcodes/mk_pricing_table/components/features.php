<?php
$html = phpQuery::newDocument( do_shortcode(get_post_meta( get_the_ID(), '_features', true )) );

foreach($html['i'] as $icon) {
	$pq_icon  = pq($icon);
	$classes  = explode(' ', $pq_icon->attr('class'));	
	$svg_icon = Mk_SVG_Icons::get_svg_icon_by_class_name(false, $classes[0]);
	$pq_icon->prepend($svg_icon);
}
?>

<div class="pricing-features"><?php echo $html; ?></div>