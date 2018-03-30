<?php

if ( ! function_exists( 'tfuse_header_content' ) ):
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which runs
     * before the init hook. The init hook is too late for some features, such as indicating
     * support post thumbnails.
     *
     * To override tfuse_slider_type() in a child theme, add your own tfuse_slider_type to your child theme's
     * functions.php file.
     */

    function tfuse_header_content($location = false)
    {
        global $TFUSE,$post,$header_element,$is_tf_front_page,$is_tf_blog_page,$header_image;
        $posts = $header_element = $header_image = $slider = null;
        if (!$location) return;
        switch ($location)
        {
            case 'header' :
                if ($is_tf_blog_page)
                {
                    $header_element = tfuse_options('header_element_blog', 'none');
                    if ( 'slider' == $header_element )
                        $slider = tfuse_options('select_slider_blog');
                    elseif ( 'image' == $header_element ){
                        $header_image = tfuse_options('header_image_blog');
                    }
                }
                elseif ($is_tf_front_page)
                {
                    if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page'){
                        $page_id = $post->ID;
                        $header_element = tfuse_page_options('header_element','',$page_id);
                        if ( 'slider' == $header_element )
                            $slider = tfuse_page_options('select_slider','',$page_id);
                        elseif ( 'image' == $header_element ){
                            $header_image = tfuse_page_options('header_image','',$page_id);
                        }
                    }
                    else{
                        $header_element = tfuse_options('header_element','none');
                        if ( 'slider' == $header_element )
                            $slider = tfuse_options('select_slider');
                        elseif ( 'image' == $header_element ){
                            $header_image = tfuse_options('header_image');
                        }
                    }
                }
                elseif(is_search()){
                    $header_element = tfuse_options('header_element_search', 'none');
                    if ( 'slider' == $header_element )
                        $slider = tfuse_options('select_slider_search');
                    elseif ( 'image' == $header_element ){
                        $header_image = tfuse_options('header_image_search');
                    }
                }
                elseif(is_404()){
                    $header_element = tfuse_options('header_element_404', 'none');
                    if ( 'slider' == $header_element )
                        $slider = tfuse_options('select_slider_404');
                    elseif ( 'image' == $header_element ){
                        $header_image = tfuse_options('header_image_404');
                    }
                }
                elseif(is_tag()){
                    $header_element = tfuse_options('header_element_tag', 'none');
                    if ( 'slider' == $header_element )
                        $slider = tfuse_options('select_slider_tag');
                    elseif ( 'image' == $header_element ){
                        $header_image = tfuse_options('header_image_tag');
                    }
                }
                elseif ( is_singular() )
                {
                    $ID = $post->ID;
                    $header_element = tfuse_page_options('header_element','none');
                    if ( 'slider' == $header_element )
                        $slider = tfuse_page_options('select_slider');
                    elseif ( 'image' == $header_element ){
                        $header_image = tfuse_page_options('header_image');
                    }
                }
                elseif ( is_category() )
                {
                    $ID = get_query_var('cat');
                    $header_element = tfuse_options('header_element_cat', 'none', $ID);
                    if ( 'slider' == $header_element )
                        $slider = tfuse_options('select_slider_cat', null, $ID);
                    elseif ( 'image' == $header_element ){
                        $header_image = tfuse_options('header_image_cat', null, $ID);
                    }
                }
                elseif ( is_tax() )
                {
                    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                    $ID = $term->term_id;
                    $header_element = tfuse_options('header_element_cat', 'none', $ID);
                    if ( 'slider' == $header_element )
                        $slider = tfuse_options('select_slider_cat', null, $ID);
                    elseif ( 'image' == $header_element ){
                        $header_image = tfuse_options('header_image_cat', null, $ID);
                    }
                }
                elseif ( is_archive() )
                {
                    if(isset($_GET['posts']) && $_GET['posts'] == 'all' && isset($_GET['post_type']) && $_GET['post_type'] == 'portfolio'){
                        $header_element = tfuse_options('header_element_port_archive', 'none');
                        if ( 'slider' == $header_element )
                            $slider = tfuse_options('select_slider_port_archive', null);
                        elseif ( 'image' == $header_element ){
                            $header_image = tfuse_options('header_image_port_archive', null);
                        }
                    }
                    else{
                        $header_element = tfuse_options('header_element_archive', 'none');
                        if ( 'slider' == $header_element )
                            $slider = tfuse_options('select_slider_archive', null);
                        elseif ( 'image' == $header_element ){
                            $header_image = tfuse_options('header_image_archive', null);
                        }
                    }
                }
            break;
            case 'after_header' :
                if ($is_tf_blog_page)
                {
                    $header_element2 = tfuse_options('header_element_blog', 'none');
                    if ( 'full_slider' == $header_element2 )
                        $slider = tfuse_options('select_slider_after_header_blog');
                }
                elseif ($is_tf_front_page)
                {
                    if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page'){
                        $page_id = $post->ID;
                        $header_element2 = tfuse_page_options('header_element','',$page_id);
                        if ( 'full_slider' == $header_element2 )
                            $slider = tfuse_page_options('select_slider_after_header','',$page_id);
                    }
                    else{
                        $header_element2 = tfuse_options('header_element','none');
                        if ( 'full_slider' == $header_element2 )
                            $slider = tfuse_options('select_slider_after_header');
                    }
                }
                elseif(is_search()){
                    $header_element2 = tfuse_options('header_element_search', 'none');
                    if ( 'full_slider' == $header_element2 )
                        $slider = tfuse_options('select_slider_after_header_search');
                }
                elseif(is_404()){
                    $header_element2 = tfuse_options('header_element_404', 'none');
                    if ( 'full_slider' == $header_element2 )
                        $slider = tfuse_options('select_slider_after_header_404');
                }
                elseif(is_tag()){
                    $header_element2 = tfuse_options('header_element_tag', 'none');
                    if ( 'full_slider' == $header_element2 )
                        $slider = tfuse_options('select_slider_after_header_tag');
                }
                elseif ( is_singular() )
                {
                    $ID = $post->ID;
                    $header_element2 = tfuse_page_options('header_element','none');
                    if ( 'full_slider' == $header_element2 )
                        $slider = tfuse_page_options('select_slider_after_header');
                }
                elseif ( is_category() )
                {
                    $ID = get_query_var('cat');
                    $header_element2 = tfuse_options('header_element_cat', 'none', $ID);
                    if ( 'full_slider' == $header_element2 )
                        $slider = tfuse_options('select_slider_after_header_cat', null, $ID);
                }
                elseif ( is_tax() )
                {
                    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                    $ID = $term->term_id;
                    $header_element2 = tfuse_options('header_element_cat', 'none', $ID);
                    if ( 'full_slider' == $header_element2 )
                        $slider = tfuse_options('select_slider_after_header_cat', null, $ID);
                }
                elseif ( is_archive() )
                {
                    if(isset($_GET['posts']) && $_GET['posts'] == 'all' && isset($_GET['post_type']) && $_GET['post_type'] == 'portfolio'){
                        $header_element2 = tfuse_options('header_element_port_archive', 'none');
                        if ( 'full_slider' == $header_element2 )
                            $slider = tfuse_options('select_slider_after_header_port_archive', null);
                    }
                    else {
                        $header_element2 = tfuse_options('header_element_archive', 'none');
                        if ( 'full_slider' == $header_element2 )
                            $slider = tfuse_options('select_slider_after_header_archive', null);
                    }
                }
            break;
            case 'content' :
                if ($is_tf_blog_page)
                {
                    $header_element = tfuse_options('footer_element_blog', 'none');
                    if ( 'slider' == $header_element )
                        $slider = tfuse_options('select_slider_footer_blog');
                    else return;
                }
                elseif ($is_tf_front_page)
                {
                    if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page'){
                        $page_id = $post->ID;
                        $header_element = tfuse_page_options('footer_element','',$page_id);
                        if ( 'slider' == $header_element )
                            $slider = tfuse_page_options('select_slider_footer','',$page_id);
                        else return;
                    }
                    else{
                        $header_element = tfuse_options('footer_element','none');
                        if ( 'slider' == $header_element )
                            $slider = tfuse_options('select_slider_footer');
                        else return;
                    }
                }
                elseif(is_search()){
                    $header_element = tfuse_options('footer_element_search', 'none');
                    if ( 'slider' == $header_element )
                        $slider = tfuse_options('select_slider_footer_search', null);
                    else return;
                }
                elseif(is_404()){
                    $header_element = tfuse_options('footer_element_404', 'none');
                    if ( 'slider' == $header_element )
                        $slider = tfuse_options('select_slider_footer_404', null);
                    else return;
                }
                elseif(is_tag()){
                    $header_element = tfuse_options('footer_element_tag', 'none');
                    if ( 'slider' == $header_element )
                        $slider = tfuse_options('select_slider_footer_tag', null);
                    else return;
                }
                else if ( is_singular() )
                {
                    $ID = $post->ID;
                    $header_element = tfuse_page_options('footer_element','none');
                    if ( 'slider' == $header_element )
                        $slider = tfuse_page_options('select_slider_footer');
                    else return;
                }
                elseif ( is_category() )
                {
                    $ID = get_query_var('cat');
                    $header_element = tfuse_options('footer_element_cat', 'none', $ID);
                    if ( 'slider' == $header_element )
                        $slider = tfuse_options('select_slider_footer_cat', null, $ID);
                    else return;
                }
                elseif ( is_tax() )
                {
                    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                    $ID = $term->term_id;
                    $header_element = tfuse_options('footer_element_cat', 'none', $ID);
                    if ( 'slider' == $header_element )
                        $slider = tfuse_options('select_slider_footer_cat', null, $ID);
                    else return;
                }
                elseif ( is_archive() )
                {
                    if(isset($_GET['posts']) && $_GET['posts'] == 'all' && isset($_GET['post_type']) && $_GET['post_type'] == 'portfolio'){
                        $header_element = tfuse_options('footer_element_port_archive', 'none');
                        if ( 'slider' == $header_element )
                            $slider = tfuse_options('select_slider_footer_port_archive', null);
                        else return;
                    }
                    else{
                        $header_element = tfuse_options('footer_element_archive', 'none');
                        if ( 'slider' == $header_element )
                            $slider = tfuse_options('select_slider_footer_archive', null);
                        else return;
                    }
                }
            break;
        }

        if ( $header_element == 'image')
        {
            get_template_part( 'header', 'image' );
            return;
        }
        elseif ( $header_element == 'none' ){
            return;
        }
        elseif ( $header_element == 'map' )
        {
            get_template_part( 'header', 'map' );
            return;
        }
        elseif ( !$slider )
            return;

        $slider = $TFUSE->ext->slider->model->get_slider($slider);

        switch ($slider['type']):
            case 'custom':
                if ( is_array($slider['slides']) ) :
                    $slider_image_resize = ( isset($slider['general']['slider_image_resize']) && $slider['general']['slider_image_resize'] == 'true' ) ? true : false;
                    $design = $slider['design'];
                    if($design=='carousel'){
                        $width = 506;
                        $height = 316;
                    }
                    elseif($design=='image_video'){
                        $width = 960;
                        $height = 460;
                    }
                    foreach ($slider['slides'] as $k => $slide) :
                        $image = new TF_GET_IMAGE();
                        $slider['slides'][$k]['slide_src'] = $image->width($width)->height($height)->src($slide['slide_src'])->resize($slider_image_resize)->get_src();
                    endforeach;
                endif;
                break;

            case 'posts':
                $slides_posts = array();
                if($slider['general']['posts_select_type'] == 'categories')
                {
                    $args = array( 'post__in' => explode(',',$slider['general']['posts_select_cat']) );
                    $slides_posts = explode(',',$slider['general']['posts_select_cat']);
                }
                else
                {
                    $args = array( 'post__in' => explode(',',$slider['general']['posts_select_portf']) );
                    $slides_posts = explode(',',$slider['general']['posts_select_portf']);
                }
                foreach($slides_posts as $slide_posts):
                    $posts[] = get_post($slide_posts);
                endforeach;
                $posts = array_reverse($posts);
                $args = apply_filters('tfuse_slider_posts_args', $args, $slider);
                $args = @apply_filters('tfuse_slider_posts_args_'.$ID, $args, $slider);
                break;

            case 'tags':
                if($slider['general']['posts_select_type'] == 'categories')
                {
                    $args = array( 'tag__in' => explode(',',$slider['general']['posts_select_cat']) );

                    $args = apply_filters('tfuse_slider_tags_args', $args, $slider);
                    $args = @apply_filters('tfuse_slider_tags_args_'.$ID, $args, $slider);
                    $posts = get_posts($args);
                }
                else
                {
                    $args = array( 'tag__in' => explode(',',$slider['general']['posts_select_portf']),'post_type'=> 'tags' );
                    $args = apply_filters('tfuse_slider_tags_args', $args, $slider);
                    $args = @apply_filters('tfuse_slider_tags_args_'.$ID, $args, $slider);
                    $slides_posts = explode(',',$slider['general']['posts_select_portf']);
                    $args = array(
                        'posts_per_page' => -1,
                        'relation' => 'AND',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'tags',
                                'field' => 'id',
                                'terms' => $slides_posts
                            )
                        )
                    );
                    $query = new WP_Query($args);
                    $posts  = $query->get_posts();
                }
                break;

            case 'categories':
                if($slider['general']['posts_select_type'] == 'categories')
                {
                    $args = 'cat='.$slider['general']['posts_select_cat'];
                    $args = apply_filters('tfuse_slider_categories_args', $args, $slider);
                    $args = @apply_filters('tfuse_slider_categories_args_'.$ID, $args, $slider);
                    $posts = get_posts($args);
                }
                else
                {
                    $args = 'cat='.$slider['general']['posts_select_portf'];
                    $args = apply_filters('tfuse_slider_categories_args', $args, $slider);
                    $args = @apply_filters('tfuse_slider_categories_args_'.$ID, $args, $slider);
                    $slides_posts = explode(',',$slider['general']['posts_select_portf']);
                    $args = array(
                        'posts_per_page' => -1,
                        'relation' => 'AND',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'group',
                                'field' => 'id',
                                'terms' => $slides_posts
                            )
                        )
                    );
                    $query = new WP_Query($args);
                    $posts  = $query->get_posts();
                }

                break;

        endswitch;

        if ( is_array($posts) ) :
            $slider['slides'] = tfuse_get_slides_from_posts($posts,$slider);
        endif;

        if ( !is_array($slider['slides']) ) return;

        include(locate_template( '/theme_config/extensions/slider/designs/'.$slider['design'].'/template.php' ));
    }

endif;
add_action('tfuse_header_content', 'tfuse_get_header_content');


if ( ! function_exists( 'tfuse_get_slides_from_posts' ) ):
    /**
     * Note that this function is hooked into the after_setup_theme hook, which runs
     * before the init hook. The init hook is too late for some features, such as indicating
     * support post thumbnails.
     *
     * To override tfuse_slider_type() in a child theme, add your own tfuse_slider_type to your child theme's
     * functions.php file.
     */
    function tfuse_get_slides_from_posts( $posts=array(), $slider = array() )
    {
        global $post;
        $c = 0;
        $slides = array();
        $slider_image_resize = ( isset($slider['general']['slider_image_resize']) && $slider['general']['slider_image_resize'] == 'true' ) ? $slider['general']['slider_image_resize'] : false;
        $design = $slider['design'];
        if($design=='carousel'){
            $width = 506;
            $height = 316;
        }

        foreach ($posts as $k => $post) : setup_postdata( $post );
            $tfuse_image = $image = null;

            if ( !$single_image = tfuse_page_options('single_image') ) continue;
            $c++;
            $image = new TF_GET_IMAGE();
            $tfuse_image = $image->width($width)->height($height)->src($single_image)->resize($slider_image_resize)->get_src();

            $slides[$k]['slide_src'] = $tfuse_image;
            $slides[$k]['slide_title'] = get_the_title();

            if ( $slider['design'] == 'image_video' ){
                $slides[$k]['slide_type_slide'] = 'image';
            }
            if($slider['type']!='posts'){
                if($c == $slider['general']['sliders_posts_number'] )break;
            }
        endforeach;
        wp_reset_query();
        return $slides;
    }
endif;
