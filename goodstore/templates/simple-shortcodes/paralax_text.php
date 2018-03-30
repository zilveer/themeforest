<?php global $jaw_data; ?>
<?php

if (jaw_template_get_var('pattern') == '1') {
    echo '<div class="block-pattern" ></div>';
}
?>

<?php

echo '<div class="paralax-text row" style="padding-top:' . jaw_template_get_var('padding') . 'px;padding-bottom:' . jaw_template_get_var('padding') . 'px;">';
echo do_shortcode(jaw_template_get_var('custom_text'));
echo '</div>';
?>
