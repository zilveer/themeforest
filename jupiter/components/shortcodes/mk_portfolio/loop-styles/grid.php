<?php

    global $mk_options;
    switch ($view_params['column']) {
        case 1:
            if ($view_params['layout'] == 'full') {
                $width = $mk_options['grid_width'] - 40;
            } else {
                $width = round(($mk_options['content_width'] / 100) * $mk_options['grid_width']) - 40;
            }
            $item_classes[] = 'one-column';
            break;
        case 2:
            if ($view_params['layout'] == 'full') {
                $width = round($mk_options['grid_width'] / 2) - 25;
            } else {
                $width = round((($mk_options['content_width'] / 100) * $mk_options['grid_width']) / 2) - 25;
            }
            $item_classes[] = 'two-column';
            break;
        case 3:
            if ($view_params['layout'] == 'full') {
                $width = round($mk_options['grid_width'] / 3) - 20;
            } else {
                $width = round((($mk_options['content_width'] / 100) * $mk_options['grid_width']) / 2) - 25;
            }
            $item_classes[] = 'three-column';
            break;
        case 4:
            if ($view_params['layout'] == 'full') {
                $width = round($mk_options['grid_width'] / 4) - 15;
            } else {
                $width = round((($mk_options['content_width'] / 100) * $mk_options['grid_width']) / 2) - 25;
            }
            $item_classes[] = 'four-column';
            break;
        case 5:
            if ($view_params['layout'] == 'full') {
                $width = round($mk_options['grid_width'] / 5) - 10;
            } else {
                $width = round((($mk_options['content_width'] / 100) * $mk_options['grid_width']) / 2) - 25;
            }
            $item_classes[] = 'five-column';
            break;
        case 6:
            if ($view_params['layout'] == 'full') {
                $width = round($mk_options['grid_width'] / 6) - 15;
            } else {
                $width = round((($mk_options['content_width'] / 100) * $mk_options['grid_width']) / 2) - 25;
            }
            $item_classes[] = 'six-column';
            break;
    }

    
    $featured_image_src = Mk_Image_Resize::resize_by_id_adaptive( get_post_thumbnail_id(), $view_params['image_size'], $width, $view_params['height'], $crop = false, $dummy = true);

    $image_size_atts = Mk_Image_Resize::get_image_dimension_attr(get_post_thumbnail_id(), $view_params['image_size'], $width, $view_params['height']);


    /* Dynamic color for slidebox meta overlay hover scenario */
    $hover_overlay_value = get_post_meta($post->ID, '_hover_skin', true);
    $hover_overlay       = !empty($hover_overlay_value) ? (' style="background-color:' . $hover_overlay_value . '"') : '';
    /* --- */
    

    /* Dynamic class names to be added to article tag. */
    $item_classes[] =  $view_params['hover_scenarios'] . '-hover';
    $item_classes[] = implode(' ', mk_get_custom_tax(get_the_id(), 'portfolio', false, true));
    /* ---- */

?>
 
<article id="<?php the_ID(); ?>" class="mk-portfolio-item mk-portfolio-grid-item <?php echo implode(' ', $item_classes); ?>">

    <div class="item-holder">
        
        <div class="featured-image js-taphover <?php if($view_params['permalink_icon'] == 'false' && $view_params['zoom_icon'] == 'false') echo 'buttons-disabled'; ?>" onclick="">
            
            <img alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" src="<?php echo $featured_image_src['dummy']; ?>" <?php echo $featured_image_src['data-set']; ?>  width="<?php echo esc_attr($image_size_atts['width']); ?>" height="<?php echo esc_attr($image_size_atts['height']); ?>"  />
            
                <?php echo mk_get_shortcode_view('mk_portfolio', 'components/hover-overlay', true, ['hover_scenarios' => $view_params['hover_scenarios']]); ?>

                <?php if($view_params['hover_scenarios'] != 'none') : ?>    
                    <div class="icons-holder">
                        <?php
                            echo mk_get_shortcode_view('mk_portfolio', 'components/permalink-icon', true, ['permalink_icon' => $view_params['permalink_icon'],'target' => $view_params['target']]);
                            echo mk_get_shortcode_view('mk_portfolio', 'components/zoom-icon', true, ['zoom_icon' => $view_params['zoom_icon'], 'permalink_icon' => $view_params['permalink_icon']]);
                        ?>
                    </div>
                    
                    <div class="portfolio-meta"<?php if($view_params['hover_scenarios'] == 'slidebox') $hover_overlay; ?>>
                        <div class="add-middle-align">
                            <?php 
                                echo mk_get_shortcode_view('mk_portfolio', 'components/title', true, ['permalink_icon' => $view_params['permalink_icon'],'target' => $view_params['target']]);
                                echo mk_get_shortcode_view('mk_portfolio', 'components/meta-category-date', true, ['meta_type' => $view_params['meta_type']]);    
                            ?>        
                        </div>
                    </div><!-- Portfolio meta -->
                <?php endif; ?>

        </div><!-- Featured Image -->
    </div><!-- Item Holder -->
</article>