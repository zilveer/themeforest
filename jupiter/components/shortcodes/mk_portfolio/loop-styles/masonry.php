<?php
    global $mk_options;

    $column = get_post_meta(get_the_ID(), '_masonry_img_size', true);
    $column = !(empty($column)) ? $column : 'x_x';
    $id = Mk_Static_Files::shortcode_id();

    switch ($column) {
        case 'x_x':
            $width  = 300;
            $height = 300;
            break;
        
        case 'two_x_x': // 
            $width  = 600;
            $height = 300;
            break;
        
        case 'three_x_x':
            $width  = 900;
            $height = 300;
            break;
        case 'four_x_x':
            $width  = 1200;
            $height = 300;
            break;
        
        case 'x_two_x':
            $width  = 300;
            $height = 600;
            break;
        case 'two_x_two_x':
            $width  = 600;
            $height = 600;
            break;
        case 'three_x_two_x':
            $width  = 900;
            $height = 600;
            break;
        
        case 'four_x_two_x':
            $width  = 1200;
            $height = 600;
            break;
        
        default:
            $width  = 300;
            $height = 300;
            break;
    }


    $featured_image_src = Mk_Image_Resize::resize_by_id_adaptive( get_post_thumbnail_id(), 'portfolio-'.$column, $width, $height, $crop = false, $dummy = true);

    $image_size_atts = Mk_Image_Resize::get_image_dimension_attr(get_post_thumbnail_id(), 'portfolio-'.$column, $width, $height);

    /* --- */


    /* Dynamic class names to be added to article tag. */
    $item_classes[] = 'size_' . $column;
    $item_classes[] =  $view_params['hover_scenarios'] . '-hover';
    $item_classes[] = implode(' ', mk_get_custom_tax(get_the_id(), 'portfolio', false, true));
    /* ---- */

     ?>

<article id="<?php the_ID(); ?>" class="mk-portfolio-item portfolio-item-<?php echo $id; ?> mk-portfolio-masonry-item <?php echo implode(' ', $item_classes); ?>">
    <div class="item-holder">
           <div class="featured-image js-taphover <?php if($view_params['permalink_icon'] == 'false' && $view_params['zoom_icon'] == 'false') echo 'buttons-disabled'; ?>">
        
                <img alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" src="<?php echo $featured_image_src['dummy']; ?>" <?php echo $featured_image_src['data-set']; ?> width="<?php echo esc_attr($image_size_atts['width']); ?>" height="<?php echo esc_attr($image_size_atts['height']); ?>"/>
                
                    <?php echo mk_get_shortcode_view('mk_portfolio', 'components/hover-overlay', true, ['hover_scenarios' => $view_params['hover_scenarios']]); ?>


                    <?php if($view_params['hover_scenarios'] != 'none') : ?>
                        <div class="icons-holder">
                            <?php
                                echo mk_get_shortcode_view('mk_portfolio', 'components/permalink-icon', true, ['permalink_icon' => $view_params['permalink_icon'],'target' => $view_params['target']]);
                                echo mk_get_shortcode_view('mk_portfolio', 'components/zoom-icon', true, ['zoom_icon' => $view_params['zoom_icon'], 'permalink_icon' => $view_params['permalink_icon']]);
                            ?>
                        </div>
                    
                        <div class="portfolio-meta"<?php if($view_params['hover_scenarios'] == 'slidebox') { echo $hover_overlay; } ?>>
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

<?php 
Mk_Static_Files::addCSS('
    .portfolio-item-'.$id.' {
        border-right-width:' . ($view_params['grid_spacing'] / 2) . 'px;
        border-bottom-width:' . $view_params['grid_spacing'] . 'px;
        border-left-width:' . ($view_params['grid_spacing'] / 2) . 'px;
    }
', $id);


/* Dynamic color for slidebox meta overlay hover scenario */
$hover_overlay_value = get_post_meta($post->ID, '_hover_skin', true);

if($view_params['hover_scenarios'] == 'slidebox' && !empty($hover_overlay_value)) {
    Mk_Static_Files::addCSS('
        .portfolio-item-'.$id.' .portfolio-meta {
            background-color:' . $hover_overlay_value . '
        }
    ', $id);
}

?>
