<?php
if (($view_params['masonray_style'] == 'style1' && $view_params['i'] % 5 == 0) ||
    ($view_params['masonray_style'] == 'style2' && ($view_params['i'] - 2) % 5 == 0) ||
    ($view_params['masonray_style'] == 'style3' && ($view_params['i'] - 1) % 5 == 0) ) {
        $mansory_pointer_css = 'gallery-mansory-large ';
} else {
    $mansory_pointer_css = 'gallery-mansory-small ';
}
?>        

<article class="mk-gallery-item js-gallery-item hover-<?php echo $view_params['hover_scenarios']; ?> <?php echo $mansory_pointer_css . $view_params['frame_style']; ?>-frame">
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
                    'image_size' => $view_params['image_size']
                    )
        );
        ?>
    </div>
</article>