<?php
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'main_page_section.php' == basename($_SERVER['SCRIPT_FILENAME'])){
	die ('This file can not be accessed directly!');
}
$full_screen_type = (rwmb_meta('us_full_screen') == 1)?' full_screen':'';
$full_width_type = (rwmb_meta('us_full_width') == 1)?' full_width':'';
$full_height_type = (rwmb_meta('us_full_height') == 1)?' full_height':'';
$centering_class = (rwmb_meta('us_centering') == 1)?' valign_center':'';
$output_type = (rwmb_meta('us_style') != '')?' color_'.rwmb_meta('us_style'):'';
$parallax_class = (rwmb_meta('us_scrolling_effect') != '' AND in_array(rwmb_meta('us_scrolling_effect'), array('parallax_ver', 'parallax_hor')))?' '.rwmb_meta('us_scrolling_effect'):'';
$animation_class = (rwmb_meta('us_animation_effect') != '')?' animate_'.rwmb_meta('us_animation_effect'):'';

$background_style = $background_class = '';
if (rwmb_meta('us_background') != '')
{
    $background_img_id = preg_replace('/[^\d]/', '', rwmb_meta('us_background'));

    if ( $background_img_id != NULL )
    {
        $background_img = wp_get_attachment_image_src($background_img_id, 'full');
        $background_image = $background_img[0];
        $background_style = ' style="background-image: url('.$background_image.');"';
        if (rwmb_meta('us_bg_stretch') == 1) {
            $background_class .= ' cover';
        }
        if (rwmb_meta('us_scrolling_effect') == 'bg_fix') {
            $background_class .= ' fixed';
        }
    }
}
$video_html = $video_class = '';

if (rwmb_meta('us_video') == 1 AND (rwmb_meta('us_video_mp4') != '' OR rwmb_meta('us_video_ogg') != '' OR rwmb_meta('us_video_webm') != '' )) {
    $video_class = ' with_video';
    $parallax_class = '';
    $video_mp4_part = (rwmb_meta('us_video_mp4') != '')?'<source type="video/mp4" src="'.rwmb_meta('us_video_mp4').'"></source>':'';
    $video_ogg_part = (rwmb_meta('us_video_ogg') != '')?'<source type="video/ogg" src="'.rwmb_meta('us_video_ogg').'"></source>':'';
    $video_webm_part = (rwmb_meta('us_video_webm') != '')?'<source type="video/webm" src="'.rwmb_meta('us_video_webm').'"></source>':'';
    $video_poster_part = (rwmb_meta('us_background') != '')?' poster="'.rwmb_meta('us_background').'"':'';
    $video_img_part = (rwmb_meta('us_background') != '')?'<img src="'.rwmb_meta('us_background').'" alt="">':'';
    $video_html = '<video loop="loop" autoplay="autoplay" preload="auto"'.$video_poster_part.'>'.$video_mp4_part.$video_ogg_part.$video_webm_part.$video_img_part.'</video>';
}

$fade_class = $fade_style = '';
if (rwmb_meta('us_fade') == 1) {
    $fade_class = ' with_overlay';
    if (rwmb_meta('us_fade_color') != '') {
        $fade_style .= ' background-color: '.rwmb_meta('us_fade_color').';';
    }
    if (rwmb_meta('us_fade_opacity') != '') {
        $fade_opacity = rwmb_meta('us_fade_opacity');
        if ($fade_opacity < 10) {
            $fade_opacity = '0'.$fade_opacity;
        }
        $fade_style .= ' opacity: 0.'.$fade_opacity.';';
    }
    if ($fade_style != '') {
        $fade_style = ' style="'.$fade_style.'"';
    }
}

$custom_style = '';
if (rwmb_meta('us_style') == 'custom') {
    if (rwmb_meta('us_bg_color') != '') {
       $custom_style .= ' background-color: '.rwmb_meta('us_bg_color').';';
    }
    if (rwmb_meta('us_text_color') != '') {
        $custom_style .= ' color: '.rwmb_meta('us_text_color').';';
    }
    if ($custom_style != '') {
        $custom_style = ' style="'.$custom_style.'"';
    }
}

?>
<section id="<?php echo $post->post_name;?>" class="l-section<?php echo $full_screen_type.$full_width_type.$full_height_type.$output_type.$parallax_class.$video_class.$fade_class.$centering_class.$animation_class;?>"<?php echo $custom_style; ?>>
    <div class="l-section-img<?php echo $background_class; ?>"<?php echo $background_style; ?>></div>
	<?php if ( ! empty($video_html)): ?>
    <div class="l-section-video"><?php echo $video_html; ?></div>
	<?php endif; ?>
    <div class="l-section-overlay"<?php echo $fade_style; ?>></div>
    <div class="l-section-h g-html i-cf">
        <?php the_content(); ?>
    </div>
</section>
