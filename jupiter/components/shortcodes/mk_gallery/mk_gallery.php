<?php
$path = pathinfo(__FILE__) ['dirname'];
include ($path . '/config.php');


 $column_css = $mansory_style = '';

if ($images == '')
    
    return null;

$id =  Mk_Static_Files::shortcode_id();

global $mk_options, $post;



if($style == 'grid') {
    switch ($column) {
        case 1:
            $column_css = 'one-column';
            break;
        case 2:
            $column_css = 'two-column';
            break;
        case 3:
            $column_css = 'three-column';
            break;
        case 4:
            $column_css = 'four-column';
            break;
        case 5:
            $column_css = 'five-column';
            break;
        case 6:
            $column_css = 'six-column';
            break;
        case 7:
            $column_css = 'seven-column';
            break;
        case 8:
            $column_css = 'eight-column';
            break;
    }
} else {
    $mansory_style = 'masnory-gallery ';

}


$custom_links = explode(',', $custom_links); 


$query_options = array(
            'post_type' => 'attachment',
            'count' => ($pagination != 'true') ? -1 : $count,
            'posts' => $images,
            'orderby' => $orderby,
            'order' => $order,
);
$query = mk_wp_query($query_options);

$r = $query['wp_query'];



// Fixes pagination and custom links count issue


$atts = array(
    'shortcode_name' => 'mk_gallery',
    'style' => ($style != 'grid') ? 'masonry' : $style,
    'masonray_style' => $style,
    'hover_scenarios' => $hover_scenarios,
    'collection_title' => $collection_title,
    'disable_title' => $disable_title,
    'column_css' => $column_css,
    'frame_style' => $frame_style,
    'custom_links' => $custom_links,
    //'image_quality' => $image_quality,
    'image_size' => $image_size,
    'height' => $height,
    'column' => $column,
    'id' => $id,
    'i' => 0
    );

$paged = (get_query_var('paged')) ? get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);
if ($paged > 1) {
    $atts['i'] = (($count * $paged) - $count) + 1;
} 

if($style != 'grid') {
    $data_config[] = 'data-mk-component="Masonry"';
    $data_config[] = 'data-masonry-config=\'{"container":"#gallery-loop-'.$id.'", "item":".js-gallery-item", "cols": "4"}\'';
} 

$data_config[] = 'data-query="'.base64_encode(json_encode($query_options)).'"';
$data_config[] = 'data-loop-atts="'.base64_encode(json_encode($atts)).'"';
$data_config[] = 'data-pagination-style="'.$pagination_style.'"';
$data_config[] = 'data-max-pages="'.$r->max_num_pages.'"';
$data_config[] = 'data-loop-iterator="'.$r->query['posts_per_page'].'"';


echo mk_get_shortcode_view('mk_gallery', 'components/hover-blur-svg', true, ['hover_scenarios' => $hover_scenarios]);

?>

<?php mk_get_view('global', 'shortcode-heading', false, ['title' => $title]); ?>


<section id="gallery-loop-<?php echo $id; ?>" <?php echo implode(' ', $data_config); ?> class="mk-gallery <?php echo $mansory_style. $el_class; ?> js-loop js-el clearfix">

    <?php 
    $style = ($style != 'grid') ? 'masonry' : $style;
    if ($r->have_posts()):
        while ($r->have_posts()):
            $r->the_post();
                echo mk_get_shortcode_view('mk_gallery', 'loop-styles/' . $style, true, $atts);
           $atts['i']++;
        endwhile;
    endif;
    ?>
<div class="clearboth"></div>    
</section>

<?php 
    if( $pagination === 'true' ) {
        echo mk_get_view('global', 'loop-pagination', true, ['pagination_style' => $pagination_style, 'r' => $r]); 
    }

    wp_nonce_field('mk-load-more', 'safe_load_more');
?>

<?php 
wp_reset_postdata();


$overlay_color = !empty($overlay_color) ? 'background-color:'.$overlay_color.'!important;' : '';
$vertical_padding_space = $item_spacing/2;
$theme_images = THEME_IMAGES;


Mk_Static_Files::addCSS("
   #gallery-loop-{$id} { 
        margin-bottom:{$margin_bottom}px;
        margin-top: {$item_spacing}px;
    }
    #gallery-loop-{$id} .item-holder{ 
        margin:0 {$vertical_padding_space}px {$item_spacing}px;
    }
    #gallery-loop-{$id} .image-hover-overlay {
        {$overlay_color}
    }
    #gallery-loop-{$id} .hover-grayscale .image-hover-overlay img {
        filter: url('{$theme_images}/grayscale.svg#greyscale');
    }
", $id);





