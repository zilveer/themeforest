<?php
$path = pathinfo(__FILE__) ['dirname'];

include ($path . '/config.php');

global $mk_options, $wp_query;

$id = Mk_Static_Files::shortcode_id();

$query_options = array(
    'post_type'     => 'photo_album',
    'count'         => $count,
    'offset'        => $offset,
    'categories'    => $categories,
    'author'        => $author,
    'posts'         => $posts,
    'orderby'       => $orderby,
    'order'         => $order,
);
$query = mk_wp_query($query_options);

$r = $query['wp_query'];



$atts = array(
    'shortcode_name'                => 'mk_photo_album',
    'style'                         => $style,
    'column'                        => $column,
    'height'                        => $album_height,
    'image_size'                    => $image_size,
    //'image_quality'                 => $image_quality,
    'description_preview'           => $description_preview,
    'thumbnail_preview'             => $thumbnail_preview,
    'overlay_preview'               => $overlay_preview,
    'title_preview_style'           => $title_preview_style,
    'thumbnail_shape'               => $thumbnail_shape,
    'title_animation'               => $title_animation,
    'overlay_hover_animation'       => $overlay_hover_animation,
    'full_height'                   => $full_height,
    'i' => 0
);

$atts['album_url'] = esc_url( get_permalink() );

$without_hovers[] = '';
$without_hover_string  = '';

if( $show_title_desc_without_hover == 'true' ) {
    $without_hovers[] = 'without-hover-title ';
}
if( $show_thumbnail_without_hover == 'true' ) {
    $without_hovers[] = 'without-hover-thumbnail ';
}
if( $show_overlay_without_hover == 'true' ) {
    $without_hovers[] = 'without-hover-overlay ';
}

foreach ($without_hovers as $without_hover) {
    $without_hover_string .= $without_hover;
}

$cover_image_animation[] = $cover_image_hover_animation == 'blur' ? 'data-mk-component="PhotoAlbumBlur"' : '' ;
$cover_image_animation[] = $cover_image_hover_animation == 'blur' ? 'js-loop' : '' ;
$cover_image_animation[] = $cover_image_hover_animation == 'slide' ? 'anim-cover-slide' : '' ;

$data_config[] = 'data-query="'.base64_encode(json_encode($query_options)).'"';
$data_config[] = 'data-loop-atts="'.base64_encode(json_encode($atts)).'"';
$data_config[] = 'data-pagination-style="'.$pagination_style.'"';
$data_config[] = 'data-max-pages="'.$r->max_num_pages.'"';
$data_config[] = 'data-loop-iterator="'.$r->query['posts_per_page'].'"';
$data_config[] = 'data-style="'.$style.'"';

?>

<section id="photo-album-<?php echo $id; ?>" <?php echo implode(' ', $data_config); ?> class="mk-photo-album js-loop js-el img-hover-anim-<?php echo $cover_image_hover_animation; ?> mk-<?php echo $style; ?>-wrapper mk--row <?php echo $without_hover_string; ?> <?php echo $el_class.' '.$cover_image_animation[1].' '.$cover_image_animation[2]; ?> clearfix" <?php echo $cover_image_animation[0];?> >
    <?php
    if (is_archive()):
        $r = $wp_query;
        if (have_posts()):
            while (have_posts()):
                the_post();
                $atts['i']++;
                echo mk_get_shortcode_view('mk_photo_album', 'loop-styles/' . $style, true, $atts);
            endwhile;
        endif;
    else:
        if ($r->have_posts()):
            while ($r->have_posts()):
                $r->the_post();
                $atts['i']++;
                echo mk_get_shortcode_view('mk_photo_album', 'loop-styles/' . $style, true, $atts);
            endwhile;
        endif;
    endif;
    ?>
    <div class="clearboth"></div>
</section>

<?php

    if( $pagination == 'true' ) {
        echo mk_get_view('global', 'loop-pagination', true, ['pagination_style' => $pagination_style, 'r' => $r]); 
    }

    wp_nonce_field('mk-load-more', 'safe_load_more');
    
    wp_reset_postdata();
?>


<script type="text/tpl" id="tpl-photo-album">
    <?php include ($path . '/tpl-photo-album.php'); ?>
</script>


<?php
    /**
     * Custom CSS Output
     * ==================================================================================*/
    Mk_Static_Files::addCSS('
        #photo-album-'.$id.' .item-meta .the-title {
            font-size: '.$title_font_size.'px;
        }
        #photo-album-'.$id.' .item-meta .description {
            font-size: '.$description_font_size.'px;
        }
    ', $id);
    if( $space > 0 ) {
        Mk_Static_Files::addCSS('
            #photo-album-'.$id.' {
                width: calc( 100% + '.$space.'px );
                margin-left: -'.($space / 2).'px;
                margin-right: -'.($space / 2).'px;
            }
            #photo-album-'.$id.' .mk-album-item {
                padding-left: '.($space / 2).'px; 
                padding-right: '.($space / 2).'px; 
                margin-bottom: '.$space.'px; 
            }
        ', $id);
    }

    if( $show_overlay_without_hover == 'true' || $overlay_background != '') {
        Mk_Static_Files::addCSS('
            #photo-album-'.$id.' .overlay {
                background-color: '.$overlay_background.';
            }
        ', $id);
    }