<?php global $jaw_data; ?>

<?php

echo '<div class="row-fullwidth-item fullwidth-background" data-image="'.jaw_template_get_var('bg_video_image_url').'" data-color="'.jaw_template_get_var('bg_video_color').'">';
if (jaw_template_get_var('pattern') == '1') {
    echo '<div class="block-pattern" ></div>';
}

echo '<video class="paralax_video js-paralax_video" width="1920" height="1080"  autoplay muted loop>
  <source src="' . jaw_template_get_var('bg_video_mp4_url') . '" type="video/mp4">';
if (jaw_template_get_var('bg_video_ogg_type', '') == 'ogg') {
    echo '<source src="' . jaw_template_get_var('bg_video_ogg_url') . '" type="video/ogg">';
} else if (jaw_template_get_var('bg_video_ogg_type', '') == 'webm') {
    echo '<source src="' . jaw_template_get_var('bg_video_ogg_url') . '" type="video/webm">';
}

echo 'Your browser does not support the video tag.
</video>';
echo '</div>';
echo '<div class="paralax-video-text row" style="padding-top:' . jaw_template_get_var('padding') . 'px;padding-bottom:' . jaw_template_get_var('padding') . 'px;">';
echo do_shortcode(jaw_template_get_var('custom_text'));
echo '</div>';
?>
