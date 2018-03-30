<?php
$path = pathinfo(__FILE__) ['dirname'];

include ($path . '/config.php');

global $mk_options, $wp_query;

$id = Mk_Static_Files::shortcode_id();

$query_options = array(
    'post_type' => $post_type,
    'exclude_post_format' => $exclude_post_format,
    'offset' => $offset,
    'posts' => $posts,
    'orderby' => $orderby,
    'order' => $order,
);


if(is_archive()) {

    if($post_type != 'post') {
        $category_name = $wp_query->query_vars['taxonomy'];
        $query_options['categories'] = isset($wp_query->query[$category_name]) ? $wp_query->query[$category_name] : '';
    } else {
        $query_options['category_name'] = isset($wp_query->query['category_name']) ? $wp_query->query['category_name'] : '';    
    }
    
    $count = isset($wp_query->query_vars['posts_per_page']) ? $wp_query->query_vars['posts_per_page'] : $count;
    $query_options['author_name'] = isset($wp_query->query['author_name']) ? $wp_query->query['author_name'] : '';

    $query_options['year'] = isset($wp_query->query['year']) ? $wp_query->query['year'] : '';
    $query_options['monthnum'] = isset($wp_query->query['monthnum']) ? $wp_query->query['monthnum'] : '';
    $query_options['m'] = isset($wp_query->query['m']) ? $wp_query->query['m'] : '';
    $query_options['second'] = isset($wp_query->query['second']) ? $wp_query->query['second'] : '';
    $query_options['minute'] = isset($wp_query->query['minute']) ? $wp_query->query['minute'] : '';
    $query_options['hour'] = isset($wp_query->query['hour']) ? $wp_query->query['hour'] : '';
    $query_options['w'] = isset($wp_query->query['w']) ? $wp_query->query['w'] : '';
    $query_options['day'] = isset($wp_query->query['day']) ? $wp_query->query['day'] : '';
    $query_options['tag'] = isset($wp_query->query['tag']) ? $wp_query->query['tag'] : '';

} else {
    $query_options['author'] = $author;
}

$query_options['count'] = $count;
$query_options['cat'] = $cat;


$query = mk_wp_query($query_options);
$r = $query['wp_query'];



if (is_singular()) {
    global $post;
    $layout = get_post_meta($post->ID, '_layout', true);
    $layout = (!empty($layout)) ? $layout : 'full';
} 
else if (is_search()) {
    $layout = $mk_options['search_page_layout'];
} 
else if (is_archive()) {
    $layout = $mk_options['archive_page_layout'];
} 
else {
    $layout = 'right';
}
$theme_images = THEME_IMAGES;
Mk_Static_Files::addCSS("
    #loop-{$id} .blog-twitter-content:before,
    #loop-{$id} .mk-blog-modern-item.twitter-post-type .blog-twitter-content footer:before {
        background-image: url('{$theme_images}/social-icons/twitter-blue.svg');
    }
    #loop-{$id} .mk-blog-meta-wrapper:before {
        background: url('{$theme_images}/social-icons/instagram.png') center center no-repeat;
    }
", $id);


$atts = array(
    'shortcode_name' => 'mk_blog',
    'style' => $style,
    'layout' => $layout,
    'column' => $column,
    'disable_meta' => $disable_meta,
    'grid_image_height' => $grid_image_height,
    'comments_share' => $comments_share,
    'full_content' => $full_content,
    'image_size' => $image_size,
    'excerpt_length' => $excerpt_length,
    'thumbnail_align' => $thumbnail_align,
    //'image_quality' => $image_quality,
    'i' => 0
);


/* Main wrapper classes */
$wrapper_class[] = 'mk-blog-container';
$wrapper_class[] = 'mk-'.$style.'-wrapper';
$wrapper_class[] = $el_class;
$wrapper_class[] = ($style == "grid" && $transparent_border == 'true') ? 'no-border' : '';

switch ($magazine_strcutre) {
    case 1:
        $wrapper_class[] = 'mag-one-column';
        break;

    case 2:
        $wrapper_class[] = 'mag-two-column-left';
        break;

    case 3:
        $wrapper_class[] = 'mag-two-column-right';
        break;

    default:
        $wrapper_class[] = 'mag-one-column';
        break;
}
/*********/


$data_config[] = 'data-query="'.base64_encode(json_encode($query_options)).'"';
$data_config[] = 'data-loop-atts="'.base64_encode(json_encode($atts)).'"';
$data_config[] = 'data-pagination-style="'.$pagination_style.'"';
$data_config[] = is_archive() ? 'data-max-pages="'.$r->max_num_pages.'"' : 'data-max-pages="'.$r->max_num_pages.'"';
$data_config[] = 'data-loop-iterator="'.$count.'"';
//if(is_archive()) $data_config[] = 'data-archive-cat="'.$wp_query->query['category_name'].'"';

if($style == 'grid' || $style == 'newspaper' || $style == 'spotlight') {
    $data_config[] = 'data-mk-component="Grid"';
    $data_config[] = 'data-grid-config=\'{"container":"#loop-'.$id.'", "item":".mk-isotop-item"}\'';
}

?>


<section id="loop-<?php echo $id; ?>" <?php echo implode(' ', $data_config); ?> class="js-loop js-el clearfix <?php echo implode(' ', $wrapper_class); ?>" <?php echo get_schema_markup('blog'); ?>>
    <?php
        if ($r->have_posts()):
            while ($r->have_posts()):
                $r->the_post();
                $atts['i']++;
                echo mk_get_shortcode_view('mk_blog', 'loop-styles/' . $style, true, $atts);
            endwhile;
        endif;
    ?>    
</section>


<?php


if ($pagination != 'false') {
    echo mk_get_view('global', 'loop-pagination', true, ['pagination_style' => $pagination_style, 'r' => $r]);
}

wp_nonce_field('mk-load-more', 'safe_load_more');

wp_reset_postdata();