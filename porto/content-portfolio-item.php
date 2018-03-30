<?php
global $porto_settings, $post, $porto_portfolio_view, $porto_portfolio_thumb, $porto_portfolio_thumb_bg, $porto_portfolio_thumb_image, $porto_portfolio_ajax_load, $porto_portfolio_ajax_modal;

$portfolio_view = ($porto_portfolio_view && $porto_portfolio_view != 'classic') ? $porto_portfolio_view : $porto_settings['portfolio-related-style'];
$portfolio_thumb = $porto_portfolio_thumb ? $porto_portfolio_thumb : $porto_settings['portfolio-related-thumb'];
$portfolio_thumb_bg = $porto_portfolio_thumb_bg ? $porto_portfolio_thumb_bg : $porto_settings['portfolio-related-thumb-bg'];
$portfolio_thumb_image = $porto_portfolio_thumb_image ? ($porto_portfolio_thumb_image == 'zoom' ? '' : $porto_portfolio_thumb_image ) : $porto_settings['portfolio-related-thumb-image'];
$portfolio_show_link = $porto_settings['portfolio-related-link'];
$portfolio_show_zoom = $porto_settings['portfolio-zoom'];
$portfolio_ajax = false;
$portfolio_ajax_modal = false;

if ($porto_portfolio_ajax_load == 'yes') $portfolio_ajax = true;
else if ($porto_portfolio_ajax_load == 'no') $portfolio_ajax = false;

if ($porto_portfolio_ajax_modal == 'yes') $portfolio_ajax_modal = true;
else if ($porto_portfolio_ajax_modal == 'no') $portfolio_ajax_modal = false;

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

$count = count($featured_images);

$classes = array();
if ($portfolio_view == 'full')
    $classes[] = 'thumb-info-no-borders';
if ($portfolio_thumb_bg)
    $classes[] = 'thumb-info-' . $portfolio_thumb_bg;

switch ($portfolio_thumb) {
    case 'centered-info': $classes[] = 'thumb-info-centered-info'; break;
    case 'bottom-info': $classes[] = 'thumb-info-bottom-info'; break;
    case 'bottom-info-dark': $classes[] = 'thumb-info-bottom-info thumb-info-bottom-info-dark'; break;
    case 'hide-info-hover': $classes[] = 'thumb-info-centered-info thumb-info-hide-info-hover'; break;
}

if ($portfolio_thumb_image)
    $classes[] = 'thumb-info-' . $portfolio_thumb_image;

$class = implode(' ', $classes);

$ajax_attr = '';
if (!($show_external_link && $portfolio_link) && $portfolio_ajax) {
    $portfolio_show_zoom = false;
    if ($portfolio_ajax_modal)
        $ajax_attr = ' data-ajax-on-modal';
    else
        $ajax_attr = ' data-ajax-on-page';
}

$sub_title = porto_portfolio_sub_title($post);

if ($count) :
    $attachment_id = $featured_images[0]['attachment_id'];
    $attachment = porto_get_attachment($attachment_id);
    $attachment_related = porto_get_attachment($attachment_id, 'related-portfolio');
    if ($attachment && $attachment_related) :
        ?>
        <div class="portfolio-item <?php echo $portfolio_view == 'outimage' ? 'outimage' : $portfolio_view ?>">
            <a class="text-decoration-none" href="<?php if ($show_external_link && $portfolio_link) echo $portfolio_link; else the_permalink() ?>"<?php echo $ajax_attr ?>>
                <span class="thumb-info <?php echo $class ?>">
                    <span class="thumb-info-wrapper">
                        <img class="img-responsive" width="<?php echo $attachment_related['width'] ?>" height="<?php echo $attachment_related['height'] ?>" src="<?php echo $attachment_related['src'] ?>" alt="<?php echo $attachment_related['alt'] ?>" />
                        <?php if ($portfolio_view != 'outimage') : ?>
                            <span class="thumb-info-title">
                                <span class="thumb-info-inner"><?php the_title(); ?></span>
                                <?php
                                if ($sub_title) : ?>
                                    <span class="thumb-info-type"><?php echo $sub_title ?></span>
                                <?php endif; ?>
                            </span>
                        <?php else :
                            if ($porto_settings['portfolio-archive-readmore']) :
                                ?>
                                <span class="thumb-info-title">
                                    <span class="thumb-info-inner"><?php echo ($porto_settings['portfolio-archive-readmore-label'] ? $porto_settings['portfolio-archive-readmore-label'] : __('View Project...', 'porto')); ?></span>
                                </span>
                            <?php
                            endif;
                        endif; ?>
                        <?php if ($portfolio_show_link) : ?>
                            <span class="thumb-info-action">
                                <span class="thumb-info-action-icon"><i class="fa <?php echo $ajax_attr ? 'fa-plus-square' : 'fa-link' ?>"></i></span>
                            </span>
                        <?php endif; ?>
                        <?php if ($portfolio_show_zoom) : ?>
                            <span class="zoom" data-src="<?php echo $attachment['src'] ?>" data-title="<?php echo $attachment['caption'] ?>"><i class="fa fa-search"></i></span>
                        <?php endif; ?>
                    </span>
                </span>
                <?php if ($portfolio_view == 'outimage') : ?>
                    <h4 class="m-t-md m-b-none"><?php the_title(); ?></h4>
                    <?php
                    if ($sub_title) : ?>
                        <p class="m-b-sm color-body"><?php echo $sub_title ?></p>
                    <?php endif;
                endif; ?>
            </a>
        </div>
    <?php
    endif;
endif;