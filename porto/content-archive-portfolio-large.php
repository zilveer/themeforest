<?php

global $porto_settings, $post, $porto_portfolio_thumb_bg, $porto_portfolio_thumb_image, $porto_portfolio_ajax_load, $porto_portfolio_ajax_modal;

$portfolio_layout = 'large';

$post_class = array();
$post_class[] = 'portfolio';
$post_class[] = 'portfolio-' . $portfolio_layout;
$item_cats = get_the_terms($post->ID, 'portfolio_cat');
if ($item_cats):
    foreach ($item_cats as $item_cat) {
        $post_class[] = urldecode($item_cat->slug);
    }
endif;

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
$skill_list = get_the_term_list($post->ID, 'portfolio_skills', '', '</li><li><i class="fa fa-check-circle"></i> ', '');
$portfolio_location = get_post_meta($post->ID, 'portfolio_location', true);
$portfolio_client = get_post_meta($post->ID, 'portfolio_client', true);

$show_external_link = $porto_settings['portfolio-external-link'];
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
if ($portfolio_thumb_bg)
    $classes[] = 'thumb-info-' . $portfolio_thumb_bg;

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
?>

<article <?php post_class($post_class); ?>>

    <div class="row">

        <?php
        if ($count) : ?>
        <div class="col-md-6">
            <a href="<?php if ($show_external_link && $portfolio_link) echo $portfolio_link; else the_permalink(); ?>"<?php echo $ajax_attr ?>>
                <span class="thumb-info m-b-xl <?php echo $class ?>">
                    <span class="thumb-info-wrapper">
                        <?php if ($count > 1 && $portfolio_show_all_images) : ?><div class="porto-carousel owl-carousel m-b-none nav-inside show-nav-hover" data-plugin-options="<?php echo esc_attr($options) ?>"><?php endif; ?>
                            <?php
                            $i = 0;
                            foreach ($featured_images as $featured_image) :
                                $attachment_id = $featured_image['attachment_id'];
                                $attachment = porto_get_attachment($attachment_id);
                                $attachment_large = porto_get_attachment($attachment_id, 'portfolio-large');
                                if ($attachment && $attachment_large) :
                                    $zoom_src[] = $attachment['src'];
                                    $zoom_title[] = $attachment['caption'];
                                    ?>
                                    <img class="img-responsive" width="<?php echo $attachment_large['width'] ?>" height="<?php echo $attachment_large['height'] ?>" src="<?php echo $attachment_large['src'] ?>" alt="<?php echo $attachment_large['alt'] ?>" />
                                    <?php
                                    if (!$portfolio_show_all_images) break;
                                    $i++;
                                    if ($i >= $portfolio_images_count) break;
                                endif;
                            endforeach;
                            ?>
                        <?php if ($count > 1 && $portfolio_show_all_images) : ?></div><?php endif; ?>
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
        </div>
        <div class="col-md-6">
        <?php else : ?>
        <div class="col-md-12">
        <?php endif; ?>

            <div class="portfolio-info">
                <ul>
                    <?php if (in_array('like', $porto_settings['portfolio-metas'])) : ?>
                        <li>
                            <?php echo porto_portfolio_like() ?>
                        </li>
                    <?php endif;
                    if (in_array('date', $porto_settings['portfolio-metas'])) : ?>
                        <li>
                            <i class="fa fa-calendar"></i> <?php echo get_the_date() ?>
                        </li>
                    <?php endif;
                    $cat_list = get_the_term_list($post->ID, 'portfolio_cat', '', ', ', '');
                    if (in_array('cats', $porto_settings['portfolio-metas']) && $cat_list) : ?>
                        <li>
                            <i class="fa fa-tags"></i> <?php echo $cat_list ?>
                        </li>
                    <?php endif; ?>
                    <?php
                    if (function_exists('Post_Views_Counter') && Post_Views_Counter()->options['display']['position'] == 'manual') {
                        $post_count = do_shortcode('[post-views]');
                        if ($post_count) : ?>
                            <li>
                                <?php echo $post_count ?>
                            </li>
                        <?php endif;
                    }
                    ?>
                </ul>
            </div>

            <?php if ($ajax_attr) : ?>
                <h4 class="entry-title"><?php the_title() ?></h4>
            <?php else : ?>
                <h4 class="entry-title"><a href="<?php if ($show_external_link && $portfolio_link) echo $portfolio_link; else the_permalink() ?>"><?php the_title() ?></a></h4>
            <?php endif; ?>

            <div class="m-t-lg">
            <?php
            porto_render_rich_snippets( false );
            if ($porto_settings['portfolio-excerpt']) {
                echo porto_get_excerpt( $porto_settings['portfolio-excerpt-length'], false );
            } else {
                echo '<div class="entry-content">';
                the_content();
                wp_link_pages( array(
                    'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'porto' ) . '</span>',
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                    'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'porto' ) . ' </span>%',
                    'separator'   => '<span class="screen-reader-text">, </span>',
                ) );
                echo '</div>';
            }
            ?>
            </div>

            <?php if (!$ajax_attr) : ?>
                <a href="<?php if ($show_external_link && $portfolio_link) echo $portfolio_link; else the_permalink() ?>" class="btn btn-primary"><?php echo __('Learn More', 'porto') ?></a>
            <?php endif; ?>

            <div class="post-gap"></div>

            <?php if ((in_array('skills', $porto_settings['portfolio-metas']) && $skill_list) || (in_array('location', $porto_settings['portfolio-metas']) && $portfolio_location) || (in_array('client', $porto_settings['portfolio-metas']) && $portfolio_client)) : ?>
            <ul class="portfolio-details">
                <?php
                if (in_array('skills', $porto_settings['portfolio-metas']) && $skill_list) : ?>
                    <li>
                        <p><strong><?php _e('Skills', 'porto') ?>:</strong></p>

                        <ul class="list list-skills icons list-unstyled list-inline">
                            <li><i class="fa fa-check-circle"></i>
                                <?php echo $skill_list ?>
                            </li>
                        </ul>
                    </li>
                <?php endif;
                if (in_array('location', $porto_settings['portfolio-metas']) && $portfolio_location) : ?>
                    <li>
                        <p><strong><?php _e('Location', 'porto') ?>:</strong></p>
                        <p><?php echo esc_html($portfolio_location) ?></p>
                    </li>
                <?php endif;
                if (in_array('client', $porto_settings['portfolio-metas']) && $portfolio_client) : ?>
                    <li>
                        <p><strong><?php _e('Client', 'porto') ?>:</strong></p>
                        <p><?php echo esc_html($portfolio_client) ?></p>
                    </li>
                <?php endif; ?>
            </ul>
            <?php endif; ?>
        </div>
    </div>

</article>