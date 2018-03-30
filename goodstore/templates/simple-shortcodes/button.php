<?php
global $jaw_data;

$size = jaw_template_get_var('button_size', 'default');
if ($size == "default") {
    $size = "";
}

$style = array();

$rgba = jaw_template_get_var('button_bg_color');
$rgb = jwUtils::rgba2rgb($rgba);

if ($rgba == $rgb) {
    $style[] = 'background-color: ' . $rgba;
} else {
    $style[] = 'background-color: ' . $rgb;
    $style[] = 'background-color: ' . $rgba;
}
$style[] = 'border: 1px solid ' . jaw_template_get_var('button_border_color');
$style[] = 'color: ' . jaw_template_get_var('button_font_color');
?>
<div class="jaw_button">
    <a type="button" class="btn <?php echo esc_attr($size); ?>" href="<?php echo esc_url(jaw_template_get_var('link')); ?>" target="<?php echo esc_attr(jaw_template_get_var('target')); ?>" style="<?php echo implode(';', $style); ?>">
        <?php echo jaw_template_get_var('title'); ?>
    </a>
</div>
