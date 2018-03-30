<?php

global $porto_settings, $porto_layout, $post, $porto_portfolio_columns, $porto_portfolio_view, $porto_portfolio_thumb, $porto_portfolio_thumb_bg, $porto_portfolio_thumb_image, $porto_portfolio_ajax_load, $porto_portfolio_ajax_modal;

$portfolio_columns = $porto_settings['portfolio-grid-columns'];

if ($porto_portfolio_columns)
    $portfolio_columns = $porto_portfolio_columns;

$portfolio_layout = 'grid';
$portfolio_view = $porto_settings['portfolio-grid-view'];
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

if ($porto_portfolio_view && $porto_portfolio_view != 'classic')
    $portfolio_view = $porto_portfolio_view;

$post_class = array();
$post_class[] = 'portfolio';
$post_class[] = 'portfolio-' . $portfolio_layout;
$post_class[] = 'portfolio-col-'.$portfolio_columns;
$item_cats = get_the_terms($post->ID, 'portfolio_cat');
if ($item_cats) {
    foreach ($item_cats as $item_cat) {
        $post_class[] = urldecode($item_cat->slug);
    }
}

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

$options = array();
$options['margin'] = 10;
$options['animateOut'] = 'fadeOut';
$options['autoplay'] = true;
$options['autoplayTimeout'] = 3000;
$options = json_encode($options);

$count = count($featured_images);

$classes = array();
if ($portfolio_view == 'full')
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

if ($count) : ?>
<article <?php post_class($post_class); ?>>
    <?php porto_render_rich_snippets(); ?>
    <div class="portfolio-item <?php echo $portfolio_view == 'outimage' ? 'outimage' : $portfolio_view ?>">
        <a class="text-decoration-none" href="<?php if ($show_external_link && $portfolio_link) echo $portfolio_link; else the_permalink() ?>"<?php echo $ajax_attr ?>>
            <span class="thumb-info <?php echo $class ?>">
                <span class="thumb-info-wrapper">
                    <?php if ($count > 1 && $portfolio_show_all_images) : ?><div class="porto-carousel owl-carousel m-b-none nav-inside show-nav-hover" data-plugin-options="<?php echo esc_attr($options) ?>"><?php endif; ?>
                        <?php
                        $i = 0;
                        foreach ($featured_images as $featured_image) :
                            $attachment_id = $featured_image['attachment_id'];
                            $attachment = porto_get_attachment($attachment_id);
                            if ($portfolio_columns == 1) {
                                $attachment_grid = porto_get_attachment($attachment_id, 'portfolio-grid-one');
                            } else if ($portfolio_columns == 2) {
                                $attachment_grid = porto_get_attachment($attachment_id, 'portfolio-grid-two');
                            } else {
                                $attachment_grid = porto_get_attachment($attachment_id, 'portfolio-grid');
                            }
                            if ($attachment && $attachment_grid) :
                                $zoom_src[] = $attachment['src'];
                                $zoom_title[] = $attachment['caption'];
                                ?>
                                <img class="img-responsive" width="<?php echo $attachment_grid['width'] ?>" height="<?php echo $attachment_grid['height'] ?>" src="<?php echo $attachment_grid['src'] ?>" alt="<?php echo $attachment_grid['alt'] ?>" />
                                <?php
                                if (!$portfolio_show_all_images) break;
                                $i++;
                                if ($i >= $portfolio_images_count) break;
                            endif;
                        endforeach;
                        ?>
                    <?php if ($count > 1 && $portfolio_show_all_images) : ?></div><?php endif; ?>
                    <?php if ($portfolio_view != 'outimage') : ?>
                        <span class="thumb-info-title">
                            <span class="thumb-info-inner<?php echo ($portfolio_columns > 4 && ($porto_layout == 'fullwidth' || $porto_layout == 'left-sidebar' || $porto_layout == 'right-sidebar')) ? ' font-size-xs line-height-xs' . ($portfolio_thumb == 'bottom-info' ? ' p-t-xs' : '') : '' ?>"><?php the_title(); ?></span>
                            <?php
                            if ($sub_title) : ?>
                                <span class="thumb-info-type"><?php echo $sub_title ?></span>
                            <?php endif ?>
                        </span>
                    <?php else :
                        if ($porto_settings['portfolio-archive-readmore']) :
                        ?>
                        <span class="thumb-info-title">
                            <span class="thumb-info-inner<?php echo ($portfolio_columns > 4 && ($porto_layout == 'fullwidth' || $porto_layout == 'left-sidebar' || $porto_layout == 'right-sidebar')) ? ' font-size-xs line-height-xs' . ($portfolio_thumb == 'bottom-info' ? ' p-t-xs' : '') : '' ?>"><?php echo ($porto_settings['portfolio-archive-readmore-label'] ? $porto_settings['portfolio-archive-readmore-label'] : __('View Project...', 'porto')); ?></span>
                        </span>
                        <?php
                        endif;
                    endif; ?>
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
        <?php if ($portfolio_view == 'outimage') : ?>
            <?php if ($portfolio_columns > 4) :?><h5 class="m-t-md m-b-none"><?php the_title(); ?></h5><?php
            else : ?><h4 class="m-t-md m-b-none"><?php the_title(); ?></h4><?php endif; ?>
            <?php
            if ($sub_title) : ?>
                <p class="m-b-sm color-body"><?php echo $sub_title ?></p>
            <?php endif;
        endif; ?>
    </div>
</article>
<?php
endif;