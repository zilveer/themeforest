<?php
if (!is_singular('portfolio')) return false;

global $post, $mk_options;

if ($mk_options['enable_portfolio_similar_posts'] != 'true' || get_post_meta($post->ID, '_portfolio_similar', true) == 'false') return false;

$backup = $post;
$cats = wp_get_object_terms($post->ID, 'portfolio_category');
$catSlugs = array();
$related_post_found = false;
$width = absint($mk_options['grid_width'] / 4);
$height = absint($width / 1.25);

function mk_similar_portfolio_html($title, $width, $height, $query) {
    global $post;
    $output = '<section class="portfolio-similar-posts">';
    $output.= '<div class="similar-post-title">' . esc_html( $title ) . '</div>';
    $output.= '<div class="mk-grid">';
    $output.= '<ul>';
    while ($query->have_posts()) {
        $query->the_post();
        if (has_post_thumbnail()) {
            $output.= '<li>';
            $post_type = get_post_meta($post->ID, '_single_post_type', true);
            $post_type = !empty($post_type) ? $post_type : 'image';
            $link_to = get_post_meta(get_the_ID() , '_portfolio_permalink', true);
            $permalink = '';
            if (!empty($link_to)) {
                $link_array = explode('||', $link_to);
                switch ($link_array[0]) {
                    case 'page':
                        $permalink = esc_url( get_page_link( $link_array[1] ) );
                        break;

                    case 'cat':
                        $permalink = esc_url( get_category_link( $link_array[1] ) );
                        break;

                    case 'portfolio':
                        $permalink = esc_url( get_permalink( $link_array[1] ) );
                        break;

                    case 'post':
                        $permalink = esc_url( get_permalink( $link_array[1] ) );
                        break;

                    case 'manually':
                        $permalink = esc_url( $link_array[1] );
                        break;
                }
            }
            if (empty($permalink)) {
                $permalink = esc_url( get_permalink() );
            }
            $terms = get_the_terms(get_the_id() , 'portfolio_category');
            $terms_slug = array();
            $terms_name = array();
            if (is_array($terms)) {
                foreach ($terms as $term) {
                    $terms_slug[] = $term->slug;
                    $terms_name[] = $term->name;
                }
            }

            $featured_image_src = Mk_Image_Resize::resize_by_id_adaptive( get_post_thumbnail_id(), 'crop', $width, $height, $crop = true, $dummy = true);

            $output.= '<div class="portfolio-similar-posts-image"><img src="' . $featured_image_src['dummy'] . '" '.$featured_image_src['data-set'].' alt="' . the_title_attribute(array('echo' => false)) . '" title="' . the_title_attribute(array('echo' => false)) . '" />';
            $output.= '<div class="image-hover-overlay"></div>';
            $output.= '<a title="' . the_title_attribute(array('echo' => false)) . '" class="modern-post-type-icon" href="' . $permalink . '">'.Mk_SVG_Icons::get_svg_icon_by_class_name(false, 'mk-jupiter-icon-plus-circle').'</a>';
            $output.= '<div class="portfolio-similar-meta">';
            $output.= '<a class="the-title" href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a><div class="clearboth"></div>';
            $output.= '<div class="portfolio-categories">' . esc_html( implode(' ', $terms_name) ) . '</div>';
            $output.= '</div>';
            $output.= '</div>';
            $output.= '</li>';
        }
    }
    $output.= '</ul></div>';
    $output.= '<div class="clearboth"></div></section>';
    
    echo $output;
}

$output = '';
if ($cats) {
    $catcount = count($cats);
    for ($i = 0; $i < $catcount; $i++) {
        $catSlugs[$i] = $cats[$i]->slug;
    }
    $query = array(
        'post__not_in' => array(
            $post->ID
        ) ,
        'showposts' => 4,
        'ignore_sticky_posts' => 1,
        'post_type' => 'portfolio'
    );
    global $wp_version;
    if (version_compare($wp_version, "3.1", '>=')) {
        $query['tax_query'] = array(
            array(
                'taxonomy' => 'portfolio_category',
                'field' => 'slug',
                'terms' => $catSlugs
            )
        );
    } 
    else {
        $query['taxonomy'] = 'portfolio_category';
        $query['term'] = implode(',', $catSlugs);
    }
    $output = '';
    $related = new WP_Query($query);
    if ($related->have_posts()) {
        $related_post_found = true;
        mk_similar_portfolio_html(esc_html__( 'Related Projects', 'mk_framework' ) , $width, $height, $related);
    }
    $post = $backup;
}
if (!$related_post_found) {
    $recent = new WP_Query(array(
        'post_type' => 'portfolio',
        'showposts' => 4,
        'nopaging' => 0,
        'post_status' => 'publish',
        'ignore_sticky_posts' => 1
    ));
    $output = '';
    mk_similar_portfolio_html(esc_html__( 'Most Recent Projects', 'mk_framework' ) , $width, $height, $recent);
}
wp_reset_postdata();
echo $output;
