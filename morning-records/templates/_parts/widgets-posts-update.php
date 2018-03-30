<?php
// Get template args
extract(morning_records_template_get_args('widgets-posts'));

global $post;
$post_id = $post->ID;
$post_date = morning_records_get_date_or_difference(apply_filters('morning_records_filter_post_date', $post->post_date, $post->ID, $post->post_type));
$post_title = $post->post_title;
$post_link = !isset($show_links) || $show_links ? get_permalink($post_id) : '';

$output = '<article class="post_item' . ($show_image == 0 ? ' no_thumb' : ' with_thumb') . ($post_number == 1 ? ' first' : '') . '">';

if ($show_image) {
    $post_thumb = morning_records_get_resized_image_tag($post_id, 75, 75);
    if ($post_thumb) {
        $output .= '<div class="post_thumb">' . ($post_thumb) . '</div>';
    }
}

$output .= '<div class="post_content">'
    . '<h6 class="post_title">'
    . ($post_link ? '<a href="' . esc_url($post_link) . '">' : '') . trim(morning_records_strshort($post_title, (!empty($reviews_php) ? 30 : 50))) . ($post_link ? '</a>' : '')
    . '</h6>';

if ($show_counters) {
    if (morning_records_strpos($show_counters, 'views') !== false) {
        $post_counters = morning_records_storage_isset('post_data_' . $post_id) && morning_records_storage_get_array('post_data_' . $post_id, 'post_options_counters')
            ? morning_records_storage_get_array('post_data_' . $post_id, 'post_views')
            : morning_records_get_post_views($post_id);
        $post_counters_icon = 'post_counters_views icon-eye';
    } else if (morning_records_strpos($show_counters, 'likes') !== false) {
        $likes = isset($_COOKIE['morning_records_likes']) ? $_COOKIE['morning_records_likes'] : '';
        $allow = morning_records_strpos($likes, ',' . ($post_id) . ',') === false;
        $post_counters = morning_records_storage_isset('post_data_' . $post_id) && morning_records_storage_get_array('post_data_' . $post_id, 'post_options_counters')
            ? morning_records_storage_get_array('post_data_' . $post_id, 'post_likes')
            : morning_records_get_post_likes($post_id);
        $post_counters_icon = 'post_counters_likes icon-heart ' . ($allow ? 'enabled' : 'disabled');
        morning_records_enqueue_messages();
    } else if (morning_records_strpos($show_counters, 'stars') !== false || morning_records_strpos($show_counters, 'rating') !== false) {
        $post_counters = morning_records_reviews_marks_to_display(get_post_meta($post_id, $post_rating, true));
        $post_counters_icon = 'post_counters_rating icon-star';
    } else {
        $post_counters = morning_records_storage_isset('post_data_' . $post_id) && morning_records_storage_get_array('post_data_' . $post_id, 'post_options_counters')
            ? morning_records_storage_get_array('post_data_' . $post_id, 'post_comments')
            : get_comments_number($post_id);
        $post_counters_icon = 'post_counters_comments icon-comment';
    }

    if (morning_records_strpos($show_counters, 'stars') !== false && $post_counters > 0) {
        if (morning_records_strpos($post_counters, '.') === false)
            $post_counters .= '.0';
        if (morning_records_get_custom_option('show_reviews') == 'yes') {
            $output .= '<div class="post_rating reviews_summary blog_reviews">'
                . '<div class="criteria_summary criteria_row">' . trim(morning_records_reviews_get_summary_stars($post_counters, false, false, 5)) . '</div>'
                . '</div>';
        }
    }
}
$output .= '</div>';

if ($show_date || $show_counters || $show_author) {
    $output .= '<div class="post_info update">';

    if ($show_date) {
        $output .= '<span class="post_info_item post_info_posted">' . ($post_link ? '<a href="' . esc_url($post_link) . '" class="post_info_date">' : '') . ($post_date) . ($post_link ? '</a>' : '') . '</span>';
    }
    if ($show_author) {
        if (morning_records_storage_isset('post_data_' . $post_id)) {
            $post_author_id = morning_records_storage_get_array('post_data_' . $post_id, 'post_author_id');
            $post_author_name = morning_records_storage_get_array('post_data_' . $post_id, 'post_author');
            $post_author_url = morning_records_storage_get_array('post_data_' . $post_id, 'post_author_url');
        } else {
            $post_author_id = $post->post_author;
            $post_author_name = get_the_author_meta('display_name', $post_author_id);
            $post_author_url = get_author_posts_url($post_author_id, '');
        }
        $output .= '<span class="post_info_item post_info_posted_by">' . esc_html__('by', 'morning-records') . ' ' . ($post_link ? '<a href="' . esc_url($post_author_url) . '" class="post_info_author">' : '') . ($post_author_name) . ($post_link ? '</a>' : '') . '</span>';
    }

    if ( ($show_date || $show_author) && ($show_counters && morning_records_strpos($show_counters, 'stars') === false) ) {
        $output .=  '<span class="post_info_delimiter"></span>';
    }

    if ($show_counters && morning_records_strpos($show_counters, 'stars') === false) {
        $post_counters_link = morning_records_strpos($show_counters, 'comments') !== false
            ? get_comments_link($post_id)
            : (morning_records_strpos($show_counters, 'likes') !== false
                ? '#'
                : $post_link
            );
        $output .= '<span class="post_info_item post_info_counters">'
            . ($post_counters_link ? '<a href="' . esc_url($post_counters_link) . '"' : '<span')
            . ' class="post_counters_item ' . esc_attr($post_counters_icon) . '"'
            . (morning_records_strpos($show_counters, 'likes') !== false
                ? ' title="' . ($allow ? esc_attr__('Like', 'morning-records') : esc_attr__('Dislike', 'morning-records')) . '"'
                . ' data-postid="' . esc_attr($post_id) . '"'
                . ' data-likes="' . esc_attr($post_counters) . '"'
                . ' data-title-like="' . esc_attr__('Like', 'morning-records') . '"'
                . ' data-title-dislike="' . esc_attr__('Dislike', 'morning-records') . '"'
                : ''
            )
            . '>'
            . '<span class="post_counters_number">' . ($post_counters) . '</span>'
            . ($post_counters_link ? '</a>' : '</span>')
            . '</span>';
    }
    $output .= '</div>';
}
$output .= '</article>';

// Return result
morning_records_storage_set('widgets_posts_output', $output);
?>