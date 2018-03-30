<?php

//		Testimonials Carousel

function th_testimonials($atts, $content = null) {
    extract(shortcode_atts(array(
        "posts_nr" => '',
    ), $atts));


    ob_start();

    ?>

    <div class="row">
        <div id="owl-testimonials" class="owl-carousel owl-theme">

    <?php

    wp_reset_postdata();

        $args = array(
            'posts_per_page' => $posts_nr,
            'post_type' => 'testimonials'
        );


    $the_query = new WP_Query($args);

    if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();

        $output ='';
        $output .= '<div class="item">
                        <div class="col-md-8 col-md-offset-2 t-info">
                            <p>'.get_post_meta(get_the_id(), 'testimonial_content', true).'</p>';
                            $url = get_post_meta(get_the_id(), 'url', true);

        if (!empty($url)) {
        $output .= '<b><a href="'.$url.'"> - ' . get_post_meta(get_the_id(), 'name', true) . '</a></b>';
        } else {
        $output .= '<b> - ' . get_post_meta(get_the_id(), 'name', true) . '</b>';
        }

        $output .= '</div>
                </div>';
        echo $output;

    endwhile; endif; wp_reset_postdata();

    echo '</div></div>';

    $content = ob_get_contents();
    ob_end_clean();

    return $content;

}
remove_shortcode('testimonials');
add_shortcode('testimonials', 'th_testimonials');


