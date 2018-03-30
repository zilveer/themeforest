<?php
$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

global $post;

$query = array(
    'post_type' => $post_type,
    'posts_per_page' => (int) $count
);
if ($offset) {
    $query['offset'] = $offset;
}
if ($post_type == 'post') {
    if ($cat) {
        $query['cat'] = $cat;
    }
    if ($posts) {
        $query['post__in'] = explode(',', $posts);
    }
}

if ($author) {
    $query['author'] = $author;
}

if ($orderby) {
    $query['orderby'] = $orderby;
}
if ($order) {
    $query['order'] = $order;
}

$r = new WP_Query($query);


$slider_atts[] = 'data-animation="slide"';
$slider_atts[] = 'data-easing="swing"';
$slider_atts[] = 'data-direction="horizontal"';
$slider_atts[] = 'data-smoothHeight="false"'; 
$slider_atts[] = 'data-slideshowSpeed="4000"'; 
$slider_atts[] = 'data-animationSpeed="500"'; 
$slider_atts[] = 'data-pauseOnHover="true"'; 
$slider_atts[] = 'data-controlNav="false"'; 
$slider_atts[] = 'data-directionNav="true"'; 
$slider_atts[] = 'data-isCarousel="true"'; 
$slider_atts[] = 'data-itemWidth="260"'; 
$slider_atts[] = 'data-itemMargin="0"'; 
$slider_atts[] = 'data-minItems="1"'; 
$slider_atts[] = 'data-maxItems="4"'; 
$slider_atts[] = 'data-move="1"';

?>

<div class="posts-carousel <?php echo $el_class; ?>">

    <?php echo mk_get_shortcode_view('mk_blog_carousel', 'components/shortcode-heading', true, ['title' => $title, 'view_all' => $view_all]); ?>

    <div class="mk-flexslider mk-script-call js-flexslider" <?php echo implode(' ', $slider_atts); ?>>
        <ul class="mk-flex-slides">

            <?php
            if ($r->have_posts()):
                while ($r->have_posts()):
                    $r->the_post();
                    ?>        

                        <li>
                            <div class="item-holder">
        
                                <div class="item-thumb">
                                    <a class="full-cover-link" href="<?php echo esc_url( get_permalink() ); ?>"></a>
                                    <?php echo mk_get_shortcode_view('mk_blog_carousel', 'components/thumbnail', true); ?>
                                </div>

                                <div class="detail-holder">
                                    <?php echo mk_get_shortcode_view('mk_blog_carousel', 'components/title', true); ?>
                                    <?php echo mk_get_shortcode_view('mk_blog_carousel', 'components/excerpt', true, ['enable_excerpt' => $enable_excerpt]); ?>
                                </div>

                            </div>
                        </li>

                    <?php
                    endwhile;
                endif;
            wp_reset_query();
            ?>
        </ul>
    </div>
    <div class="clearboth"></div>
</div>
