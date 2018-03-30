<?php
    global $mk_options;

    switch ($view_params['column']) {
        case 1:
            if ($view_params['layout'] == 'full') {
                    $width = $mk_options['grid_width'] - 62;
            } else {
                    $width = round(($mk_options['content_width'] / 100) * $mk_options['grid_width']) - 62;
            }
            $item_classes[] = 'one-column';
            break;
        case 2:
            if ($view_params['layout'] == 'full') {
                    $width = round($mk_options['grid_width'] / 2) - 42;
            } else {
                    $width = round((($mk_options['content_width'] / 100) * $mk_options['grid_width']) / 2) - 47;
            }
            $item_classes[] = 'two-column';
            break;
        case 3:
            if ($view_params['layout'] == 'full') {
                    $width = round($mk_options['grid_width'] / 3) - 36;
            } else {
                    $width = round((($mk_options['content_width'] / 100) * $mk_options['grid_width']) / 2) - 47;
            }
            $item_classes[] = 'three-column';
            break;
        case 4:
            if ($view_params['layout'] == 'full') {
                    $width = round($mk_options['grid_width'] / 4) - 32;
            } else {
                    $width = round((($mk_options['content_width'] / 100) * $mk_options['grid_width']) / 2) - 47;
            }
            $item_classes[] = 'four-column';
            break;
        case 5:
            if ($view_params['layout'] == 'full') {
                    $width = round($mk_options['grid_width'] / 5) - 30;
            } else {
                    $width = round((($mk_options['content_width'] / 100) * $mk_options['grid_width']) / 2) - 47;
            }
            $item_classes[] = 'five-column';
            break;
        case 6:
            if ($view_params['layout'] == 'full') {
                    $width = round($mk_options['grid_width'] / 6) - 32;
            } else {
                    $width = round((($mk_options['content_width'] / 100) * $mk_options['grid_width']) / 2) - 47;
            }
            $item_classes[] = 'six-column';
            break;
    }

    $item_classes[] = implode(' ', mk_get_custom_tax(get_the_id(), 'portfolio', false, true));

?>



<article id="<?php the_ID(); ?>" class="mk-portfolio-item mk-portfolio-classic-item <?php echo implode(' ', $item_classes); ?>">
    <div class="item-holder">
        <?php

            $featured_image_src = Mk_Image_Resize::resize_by_id_adaptive( get_post_thumbnail_id(), $view_params['image_size'], $width, $view_params['height'], $crop = false, $dummy = true);

            $image_size_atts = Mk_Image_Resize::get_image_dimension_attr(get_post_thumbnail_id(), $view_params['image_size'], $width, $view_params['height']);

        ?>
        <div class="featured-image js-taphover">
            <img alt="<?php the_title(); ?>" title="<?php the_title(); ?>" src="<?php echo $featured_image_src['dummy']; ?>" <?php echo $featured_image_src['data-set']; ?> width="<?php echo esc_attr($image_size_atts['width']); ?>" height="<?php echo esc_attr($image_size_atts['height']); ?>"  />
            <div class="image-hover-overlay"></div>
            <?php
                echo mk_get_shortcode_view('mk_portfolio', 'components/permalink-icon', true, ['permalink_icon' => $view_params['permalink_icon'],'target' => $view_params['target']]);
                echo mk_get_shortcode_view('mk_portfolio', 'components/zoom-icon', true, ['zoom_icon' => $view_params['zoom_icon'], 'permalink_icon' => $view_params['permalink_icon']]);
            ?>
        </div>
        <div class="portfolio-meta-wrapper">
            <?php
                echo mk_get_shortcode_view('mk_portfolio', 'components/title', true, ['permalink_icon' => $view_params['permalink_icon'],'target' => $view_params['target']]);
                echo mk_get_shortcode_view('mk_portfolio', 'components/meta-category-date', true, ['meta_type' => $view_params['meta_type']]);    
                echo mk_get_shortcode_view('mk_portfolio', 'components/excerpt', true, ['excerpt_length' => $view_params['excerpt_length']]);
            ?>
        </div>
    </div>
</article>



