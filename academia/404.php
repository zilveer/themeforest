<?php

get_header();
$g5plus_options = &G5Plus_Global::get_options();
do_action('g5plus_before_page');
if(!isset($title_image_404)|| ($title_image_404 === '')) {
    $title_image_404 = $g5plus_options['title_image_404'];
}

if (isset($title_image_404) && isset($title_image_404['url'])) {
    $title_image_404 = $title_image_404['url'];
}

if(!isset($image_bg_url_404) || ($image_bg_url_404 === '')) {
    $image_bg_url_404 = $g5plus_options['image_bg_404'];
}

if (isset($image_bg_url_404) && isset($image_bg_url_404['url'])) {
    $image_bg_url_404 = $image_bg_url_404['url'];
}
?>

<div class="page404">
    <div class="container">
        <div class="content-wrap" style="background-image: url('<?php echo esc_html($image_bg_url_404);?>');">
            <img src="<?php echo esc_html($title_image_404); ?>" alt="title-image-404">
            <h2 class="s-font"><?php echo wp_kses_post($g5plus_options['title_404']); ?></h2>
            <p  class="description s-font"><?php echo wp_kses_post($g5plus_options['subtitle_404']); ?></p>
            <div class="return">
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>


