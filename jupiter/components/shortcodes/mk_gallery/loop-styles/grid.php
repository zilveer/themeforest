
<article class="<?php echo $view_params['column_css']; ?> mk-gallery-item hover-<?php echo $view_params['hover_scenarios']; ?> <?php echo $view_params['frame_style']; ?>-frame">
    <div class="item-holder">
        <?php 
        echo mk_get_shortcode_view('mk_gallery', 'components/hover-layer', true, array(
                        'custom_links' => $view_params['custom_links'],
                        'i'=> $view_params['i'],
                        'id'=> $view_params['id'], 
                        'collection_title' => $view_params['collection_title'],
                        'hover_scenarios' => $view_params['hover_scenarios'],
                        'disable_title' => $view_params['disable_title'],
                        'style' => $view_params['style'], 
                        'column' => $view_params['column'], 
                        'height' => $view_params['height'], 
                        'image_size' => $view_params['image_size']
                        )
                    );

        echo mk_get_shortcode_view('mk_gallery', 'components/image', true, array(
                    'style' => $view_params['style'], 
                    'column' => $view_params['column'], 
                    'height' => $view_params['height'], 
                    //'image_quality' => $view_params['image_quality'], 
                    'image_size' => $view_params['image_size']
                    )
        );
        ?>
    </div>
</article>