<?php
$path = pathinfo(__FILE__) ['dirname'];

include ($path . '/config.php');

global $wp_query;

$id = uniqid();

$categories = is_archive() ? $wp_query->query['news_category'] : $categories;
$count = is_archive() ? get_option('posts_per_page') : $count;

$query_options = array(
    'post_type' => 'news',
    'count' => $count,
    'offset' => $offset,
    'categories' => $categories,
    'author' => $author,
    'posts' => $posts,
    'orderby' => $orderby,
    'order' => $order,
);
$query = mk_wp_query($query_options);
$r = $query['wp_query'];

if (is_singular()) {
    global $post;
    $layout = get_post_meta($post->ID, '_layout', true);
} 
else {
    $layout = 'full';
}

$atts = array(
    'shortcode_name' => 'mk_news',
    'style' => $style,
    'layout' => $layout,
    'image_height' => $image_height
);

$data_config[] = 'data-query="'.base64_encode(json_encode($query_options)).'"';
$data_config[] = 'data-loop-atts="'.base64_encode(json_encode($atts)).'"';
$data_config[] = 'data-pagination-style="'.$pagination_style.'"';
$data_config[] = 'data-max-pages="'.$r->max_num_pages.'"';
$data_config[] = 'data-loop-iterator="'.$r->query['posts_per_page'].'"';

?>

<section id="mk-news-section-<?php echo $id; ?>" <?php echo implode(' ', $data_config); ?> class="mk-news-container js-loop clearfix <?php echo $el_class; ?>">
    <?php
        if ($r->have_posts()):
            while ($r->have_posts()):
                $r->the_post();
                echo mk_get_shortcode_view('mk_news', 'loop-styles/' . $style, true, $atts);
            endwhile;
        endif;
    ?>
</section>

<?php

if( $pagination === 'true' ) {
    echo mk_get_view('global', 'loop-pagination', true, ['pagination_style' => $pagination_style, 'r' => $r]); 
}

wp_nonce_field('mk-load-more', 'safe_load_more');

wp_reset_postdata();