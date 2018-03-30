<?php
global $zorka_data;
$hide_page_title = get_post_meta(get_the_ID(),'hide-page-title',true);
if ($hide_page_title == 1) return;

$page_title = get_post_meta(get_the_ID(),'custom-page-title',true);
if (empty($page_title)){
    $page_title = get_the_title();
}

if (empty($page_title)) return;

$page_sub_title = get_post_meta(get_the_ID(),'custom-page-sub-title',true);

$page_title_background = get_post_meta(get_the_ID(),'custom-page-title-background',true);

if (empty($page_title_background)) {
    $page_title_background = $zorka_data['page-title-background'];
}

$custom_page_title_style = get_post_meta(get_the_ID(),'custom-page-title-style',true);

if (!isset($custom_page_title_style) || empty($custom_page_title_style)) {
    $custom_page_title_style = 1;
}

$class = array();

$class[] = 'page-title-wrapper';

if (is_single()) {
    $class[] = 'page-title-archive-wrapper';
}

$custom_style = '';
if (!empty($page_title_background)) {
$class[] = 'dark';
$class[] = 'page-title-image';
    $custom_style = 'style="background-image: url('.$page_title_background.');"';
}

if ($custom_page_title_style == 1 && !is_single()) {
    $class[] = 'margin-bottom-50';
}

/*if (empty($page_title_background) && $custom_page_title_style == 1) {
    $class[] = 'border-bottom';
}*/

$class_name = join(' ',$class);


?>

<section class="<?php echo esc_attr($class_name) ?>" <?php echo wp_kses_post($custom_style); ?>>

    <div class="page-title-inner">
        <div class="container">
            <h1><?php echo esc_html($page_title);?></h1>
            <?php if (!empty($page_sub_title)) : ?>
                <span><?php echo esc_html($page_sub_title);?></span>
            <?php endif; ?>
        </div>
    </div>
</section>



