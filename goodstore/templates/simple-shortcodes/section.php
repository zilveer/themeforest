<?php global $jaw_data; ?>
<?php
$fw_style = '';
if (jaw_template_get_var('fullwidth') == '1' && jaw_template_get_var('size') == 12) {
    $fullwidth = 'row-fullwidth';
} else if (jaw_template_get_var('fullwidth') == 'full-item' && jaw_template_get_var('size') == 12) {
    $fullwidth = 'row-fullwidth-item';
} else {
    $fullwidth = '';
}

if (jaw_template_get_var('full_back_color') != '') {
    $fw_style = 'background: ' . jaw_template_get_var('full_back_color') . '; ';
}
?>
<div class="builder-section col-lg-<?php echo jaw_template_get_var('size') . ' ' . jaw_template_get_var('class'); ?> <?php echo $fullwidth; ?>" >

    <?php
    if ($fullwidth == 'row-fullwidth') {
        echo '<div class="fullwidth-block row" style="' . $fw_style . '">';
    }
    $content = jaw_template_get_var('content');
    if (jaw_template_get_var('bar_type', '') != '') {
        echo jaw_get_template_part('section_bar', 'simple-shortcodes');
    }
    ?>
    <?php
    echo do_shortcode($content);
    if ($fullwidth == 'row-fullwidth') {
        echo '</div>';
    }
    ?>

</div>