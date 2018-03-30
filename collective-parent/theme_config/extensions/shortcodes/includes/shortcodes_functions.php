<?php

if (!function_exists('tfuse_shortcode_posts')) {

    /**
     *  Generate array with: recent/popular/most commented posts
     * @param string $sort Sort type (recent/popular/most commented)
     * @param integer $items Number of items to be extracted
     * @param boolean $image_post Extract or no post image
     * @param integer $image_width Set width of post image
     * @param integer $image_height Set height of post image
     * @param string $image_class Set class of post image
     * @param boolean $date_post Extract or no post date
     * @param string $date_format Set date format
     * @param string $post_type Set post type
     * @param string $category Set category from where posts would be extracted
     * @since Collective 1.0
     */
    function tfuse_shortcode_posts($args = null) {
        $defaults = array(
            'sort' => 'recent',
            'items' => 5,
            'image_post' => true,
            'image_width' => 54,
            'image_height' => 54,
            'image_class' => 'thumbnail',
            'date_post' => true,
            'date_format' => 'F jS, Y',
            'post_type' => 'post',
            'category' => '',
            'specialites' => ''
        );

        extract(wp_parse_args($args, $defaults));

        global $post;

        $tf_cat_ID = (!empty($category) && empty($specialites) ) ? get_cat_ID($category) : '';

        $specialites = ( empty($category) && !empty($specialites) ) ? $specialites : '';

        if ($sort == 'recent') {
            $query = new WP_Query(array('post_type' => $post_type, 'orderby' => 'post_date', 'order ' => 'DESC', 'cat' => $tf_cat_ID, 'Specialites' => $specialites, 'posts_per_page' => $items));
            $posts = $query->get_posts();
        } elseif ($sort == 'popular') {
            $query = new WP_Query(array('post_type' => $post_type, 'orderby' => 'meta_value', 'meta_key' => TF_THEME_PREFIX . '_post_viewed', 'order ' => 'DESC', 'cat' => $tf_cat_ID, 'posts_per_page' => $items));
            $posts = $query->get_posts();
        } elseif ($sort == 'commented') {
            $query = new WP_Query(array('post_type' => $post_type, 'orderby' => 'comment_count', 'order ' => 'DESC', 'cat' => $tf_cat_ID, 'posts_per_page' => $items));
            $posts = $query->get_posts();
        }
        else
            return false;

        $tf_post_option = array();
        $count = 0;
        if (!empty($posts)) {

            foreach ($posts as $post_elm) {
                setup_postdata($post_elm);

                $img = '';

                if ($image_post == true) {
                    $post_image_src = tfuse_page_options('thumbnail_image', tfuse_page_options('single_image', null, $post_elm->ID), $post_elm->ID);
                    if (!empty($post_image_src)) {
                        $get_image = new TF_GET_IMAGE();
                        $img = $get_image->properties(array('class' => $image_class, 'alt' => get_the_title($post_elm->ID)))->width($image_width)->height($image_height)->src($post_image_src)->resize(true)->get_img();
                    }
                }

                if (!empty($img))
                    $tf_post_option[$count]['post_img'] = $img;
                else
                    $tf_post_option[$count]['post_img'] = '';

                if ($date_post) {
                    $time_format = apply_filters('tfuse_widget_time_format', $date_format);
                    $tf_post_option[$count]['post_date_post'] = get_the_time($time_format, $post_elm->ID);
                }
                else
                    $tf_post_option[$count]['post_date_post'] = '';

                $tf_post_option[$count]['post_class'] = ( is_singular() && $post->ID == $post_elm->ID ) ? 'current-menu-item post_' . $sort : 'post_' . $sort;
                $tf_post_option[$count]['post_title'] = get_the_title($post_elm->ID);
                $tf_post_option[$count]['post_link'] = get_permalink($post_elm->ID);
                $tf_post_option[$count]['post_author_link'] = get_author_posts_url(get_the_author_meta('ID'));
                $tf_post_option[$count]['post_author_name'] = get_the_author();
                $tf_post_option[$count]['post_comnt_numb'] = get_comments_number($post_elm->ID);
                $tf_post_option[$count]['post_comnt_numb_link'] = tfuse_get_comments(true, $post_elm->ID);
                $tf_post_option[$count]['post_loveit_number'] = get_post_meta($post_elm->ID, TF_THEME_PREFIX . '_post_viewed', true);
                $tf_post_option[$count]['post_excerpt'] = ( isset($post) ) ? get_the_excerpt() : '';
                $count++;
            }
            wp_reset_postdata();
        }

        return $tf_post_option;
    }

}