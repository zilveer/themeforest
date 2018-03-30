<?php

extract(shortcode_atts(array(
	'title' => false,
	'icon' => '',
	'icon_color' => '',
	'pane_bg' => '',
	"el_class" => '',
), $atts));

if (!empty($icon)) {
	$icon = (strpos($icon, 'mk-') !== FALSE) ? ($icon) : ('mk-' . $icon);
} else {
	$icon = '';
}
?>

<div class="mk-toggle <?php echo $el_class; ?>">
    <div class="mk-toggle-title"><i style="color:<?php echo $icon_color; ?>" class="<?php echo $icon; ?>"></i><?php echo $title; ?></div>
    <div class="mk-toggle-pane">
        <div style="background-color:<?php echo $pane_bg; ?>" class="inner-box">
            <?php echo wpb_js_remove_wpautop(do_shortcode(trim($content))); ?>
        </div>
    </div>
</div>