<?php

global $porto_settings, $prev_post_year, $prev_post_month, $first_timeline_loop, $post_count, $post, $porto_portfolio_thumb, $porto_portfolio_thumb_bg, $porto_portfolio_thumb_image, $porto_portfolio_ajax_load, $porto_portfolio_ajax_modal;

$portfolio_layout = 'timeline';

$archive_image = (int)get_post_meta($post->ID, 'portfolio_archive_image', true);
if ($archive_image) {
    $featured_images = array();
    $featured_image         = array(
        'thumb'         => wp_get_attachment_thumb_url( $archive_image ),
        'full'          => wp_get_attachment_url( $archive_image ),
        'attachment_id' => $archive_image
    );
    $featured_images[] = $featured_image;
} else {
    $featured_images = porto_get_featured_images();
}
$portfolio_link = get_post_meta($post->ID, 'portfolio_link', true);
$show_external_link = $porto_settings['portfolio-external-link'];

$portfolio_thumb = $porto_portfolio_thumb ? $porto_portfolio_thumb : $porto_settings['portfolio-archive-thumb'];
$portfolio_thumb_bg = $porto_portfolio_thumb_bg ? $porto_portfolio_thumb_bg : $porto_settings['portfolio-archive-thumb-bg'];
$portfolio_thumb_image = $porto_portfolio_thumb_image ? ($porto_portfolio_thumb_image == 'zoom' ? '' : $porto_portfolio_thumb_image ) : $porto_settings['portfolio-archive-thumb-image'];
$portfolio_show_link = $porto_settings['portfolio-archive-link'];
$portfolio_show_all_images = $porto_settings['portfolio-archive-all-images'];
$portfolio_images_count = $porto_settings['portfolio-archive-images-count'];
$portfolio_show_zoom = $porto_settings['portfolio-archive-zoom'];
$portfolio_ajax = $porto_settings['portfolio-archive-ajax'];
$portfolio_ajax_modal = $porto_settings['portfolio-archive-ajax-modal'];

if ($porto_portfolio_ajax_load == 'yes') $portfolio_ajax = true;
else if ($porto_portfolio_ajax_load == 'no') $portfolio_ajax = false;

if ($porto_portfolio_ajax_modal == 'yes') $portfolio_ajax_modal = true;
else if ($porto_portfolio_ajax_modal == 'no') $portfolio_ajax_modal = false;

$options = array();
$options['margin'] = 10;
$options['animateOut'] = 'fadeOut';
$options['autoplay'] = true;
$options['autoplayTimeout'] = 3000;
$options = json_encode($options);

$count = count($featured_images);

$classes = array();
$classes[] = 'thumb-info-no-borders';
if ($portfolio_thumb_bg)
    $classes[] = 'thumb-info-' . $portfolio_thumb_bg;

switch ($portfolio_thumb) {
    case 'centered-info': $classes[] = 'thumb-info-centered-info'; $portfolio_show_zoom = false; break;
    case 'bottom-info': $classes[] = 'thumb-info-bottom-info'; break;
    case 'bottom-info-dark': $classes[] = 'thumb-info-bottom-info thumb-info-bottom-info-dark'; break;
    case 'hide-info-hover': $classes[] = 'thumb-info-centered-info thumb-info-hide-info-hover'; break;
}

if ($count > 1 && $portfolio_show_all_images)
    $classes[] = 'thumb-info-no-zoom';
else if ($portfolio_thumb_image)
    $classes[] = 'thumb-info-' . $portfolio_thumb_image;

$ajax_attr = '';
if (!($show_external_link && $portfolio_link) && $portfolio_ajax) {
    $portfolio_show_zoom = $portfolio_show_all_images = false;
    if ($portfolio_ajax_modal)
        $ajax_attr = ' data-ajax-on-modal';
    else
        $ajax_attr = ' data-ajax-on-page';
}

if ($portfolio_show_zoom)
    $classes[] = 'thumb-info-centered-icons';

$class = implode(' ', $classes);

$zoom_src = array();
$zoom_title = array();

$sub_title = porto_portfolio_sub_title($post);

if ($count) :
    $post_timestamp = strtotime($post->post_date);
    $post_month = date('n', $post_timestamp);
    $post_year = get_the_date('o');
    $current_date = get_the_date('o-n');
    ?>

    <?php if ($prev_post_month != $post_month || ($prev_post_month == $post_month && $prev_post_year != $post_year)) : $post_count = 1; ?>
    <div class="timeline-date"><h3><?php echo get_the_date('F Y'); ?></h3></div>
<?php endif; ?>

    <?php
    $post_class = array();
    $post_class[] = 'portfolio';
    $post_class[] = 'portfolio-' . $portfolio_layout;
    $post_class[] = 'timeline-box';
    $post_class[] = ($post_count % 2 == 1 ? 'left' : 'right');

    $item_cats = get_the_terms($post->ID, 'portfolio_cat');
    if ($item_cats):
        foreach ($item_cats as $item_cat) {
            $post_class[] = urldecode($item_cat->slug);
        }
    endif;
    ?>
    <article <?php post_class($post_class); ?>>
        <?php porto_render_rich_snippets(); ?>
        <a href="<?php if ($show_external_link && $portfolio_link) echo $portfolio_link; else the_permalink() ?>"<?php echo $ajax_attr ?>>
            <span class="portfolio-item thumb-info <?php echo $class ?>">
                <span class="thumb-info-wrapper">
                    <?php if ($count > 1 && $portfolio_show_all_images) : ?><div class="porto-carousel owl-carousel m-b-none nav-inside show-nav-hover" data-plugin-options="<?php echo esc_attr($options) ?>"><?php endif; ?>
                        <?php
                        $i = 0;
                        foreach ($featured_images as $featured_image) :
                            $attachment_id = $featured_image['attachment_id'];
                            $attachment = porto_get_attachment($attachment_id);
                            $attachment_timeline = porto_get_attachment($attachment_id, 'portfolio-timeline');
                            if ($attachment && $attachment_timeline) :
                                $zoom_src[] = $attachment['src'];
                                $zoom_title[] = $attachment['caption'];
                                ?>
                                <img class="img-responsive" width="<?php echo $attachment_timeline['width'] ?>" height="<?php echo $attachment_timeline['height'] ?>" src="<?php echo $attachment_timeline['src'] ?>" alt="<?php echo $attachment_timeline['alt'] ?>" />
                                <?php
                                if (!$portfolio_show_all_images) break;
                                $i++;
                                if ($i >= $portfolio_images_count) break;
                            endif;
                        endforeach;
                        ?>
                    <?php if ($count > 1 && $portfolio_show_all_images) : ?></div><?php endif; ?>
                    <span class="thumb-info-title">
                        <span class="thumb-info-inner"><?php the_title(); ?></span>
                        <?php
                        if ($sub_title) : ?>
                            <span class="thumb-info-type"><?php echo $sub_title ?></span>
                        <?php endif; ?>
                    </span>
                    <?php if ($portfolio_show_link || $portfolio_show_zoom) : ?>
                        <span class="thumb-info-action">
                            <?php if ($portfolio_show_link) : ?>
                                <span class="thumb-info-action-icon thumb-info-action-icon-primary"><i class="fa <?php echo $ajax_attr ? 'fa-plus-square' : 'fa-link' ?>"></i></span>
                            <?php endif; ?>
                            <?php if ($portfolio_show_zoom) : ?>
                                <span class="thumb-info-action-icon thumb-info-action-icon-light thumb-info-zoom" data-src="<?php echo esc_attr(json_encode($zoom_src)) ?>" data-title="<?php echo esc_attr(json_encode($zoom_title)) ?>"><i class="fa fa-search-plus"></i></span>
                            <?php endif; ?>
                        </span>
                    <?php endif; ?>
                </span>
            </span>
        </a>
    </article>
    <?php
    $prev_post_year = $post_year;
    $prev_post_month = $post_month;
    $post_count++;
endif;