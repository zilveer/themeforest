<?php

if (!function_exists('hashmag_mikado_get_shortcode_params')) {
    /**
     * Function that returns array of predefined params formatted for Visual Composer
     *
     * @param $signature string base param of shortcode
     *
     * @return array of params
     *
     */
    function hashmag_mikado_get_shortcode_params($signature) {

        switch ($signature) {
            case "mkdf_block_one":
                return hashmag_mikado_get_block_one_params();
                break;
            case "mkdf_block_two":
                return hashmag_mikado_get_block_two_params();
                break;
            case "mkdf_block_three":
                return hashmag_mikado_get_block_three_params();
                break;
            case "mkdf_block_four":
                return hashmag_mikado_get_block_four_params();
                break;
            case "mkdf_post_layout_one":
                return hashmag_mikado_get_layout_one_params();
                break;
            case "mkdf_post_layout_two":
                return hashmag_mikado_get_layout_two_params();
                break;
            case "mkdf_post_layout_three":
                return hashmag_mikado_get_layout_three_params();
                break;
            case "mkdf_post_layout_four":
                return hashmag_mikado_get_layout_four_params();
                break;
            case "mkdf_post_layout_five":
                return hashmag_mikado_get_layout_five_params();
                break;
            case "mkdf_post_layout_six":
                return hashmag_mikado_get_layout_six_params();
                break;
            case "mkdf_post_layout_seven":
                return hashmag_mikado_get_layout_seven_params();
                break;
            case "mkdf_post_slider_classic":
                return hashmag_mikado_get_slider_classic_params();
                break;
            case "mkdf_post_slider_with_thumbnails":
                return hashmag_mikado_get_slider_with_thumbnails_params();
                break;
            case "mkdf_post_carousel":
                return hashmag_mikado_get_carousel_params();
                break;
            case "mkdf_post_carousel_swipe":
                return hashmag_mikado_get_carousel_swipe_params();
                break;
            default:
                return hashmag_mikado_get_shortcode_params_default($signature);
                break;
        }
    }
}

if (!function_exists('hashmag_mikado_get_shortcode_params_names')) {
    /**
     * Function that returns array of predefined names which will be used for shortcode
     * This is used just to set default values
     *
     * @param $params_array array with all params for shortcode with empty value
     *
     * @return array of names with empty values
     *
     */
    function hashmag_mikado_get_shortcode_params_names($params_array) {
        $params_names = array();

        foreach ($params_array as $param) {
            $params_names[$param['param_name']] = '';
        }

        $params_names['offset'] = '';

        return $params_names;
    }
}

if (!function_exists('hashmag_mikado_get_post_categories_VC')) {
    /**
     * Function that returns array of categories formatted for Visual Composer
     *
     * @return array of categories where key is category name and value is category id
     *
     * @see mkd_get_post_categories
     */
    function hashmag_mikado_get_post_categories_VC() {
        return array_flip(hashmag_mikado_get_post_categories());
    }
}

if (!function_exists('hashmag_mikado_get_post_categories')) {
    /**
     * Function that returns associative array of post categories,
     * where key is category id and value is category name
     * @return array
     */
    function hashmag_mikado_get_post_categories() {
        $vc_array = $post_categories = array();
        $vc_array[0] = "All Categories";
        $post_categories = get_categories();
        foreach ($post_categories as $cat) {
            $vc_array[$cat->cat_ID] = $cat->name;
        }
        return $vc_array;
    }
}

if (!function_exists('hashmag_mikado_get_authors')) {
    /**
     * Function that returns associative array of authors,
     * where key is author id and value is author name
     * @return array
     */
    function hashmag_mikado_get_authors() {
        $vc_array = $authors = array();
        $vc_array[0] = "All Authors";
        $authors = get_users();
        foreach ($authors as $author) {
            $vc_array[$author->ID] = $author->display_name;
        }
        return $vc_array;
    }
}

if (!function_exists('hashmag_mikado_get_authors_VC')) {
    /**
     * Function that returns array of authors formatted for Visual Composer
     *
     * @return array of authors where key is category name and value is category id
     *
     * @see hashmag_mikado_get_authors
     */
    function hashmag_mikado_get_authors_VC() {
        return array_flip(hashmag_mikado_get_authors());
    }
}

if (!function_exists('hashmag_mikado_get_sort_array')) {
    /**
     * Function that returns array of sort properties for list shortcode formatted for Visual Composer
     *
     * @return array of sort properties for formatted for Visual Composer
     *
     */
    function hashmag_mikado_get_sort_array() {
        $sort_array = array(
            "" => "",
            "Latest" => "latest",
            "Random" => "random",
            "Random Posts Today" => "random_today",
            "Random in Last 7 Days" => "random_seven_days",
            "Most Commented" => "comments",
            "Title" => "title",
            "Popular" => "popular",
            "Featured Posts First" => "featured_first"
        );
        return $sort_array;
    }
}

if (!function_exists('hashmag_mikado_get_query')) {
    /**
     * Function that returns query from params
     *
     * @return WP_Query
     *
     */
    function hashmag_mikado_get_query($params) {
        $params = shortcode_atts(
            array(
                'post_type' => 'post',
                'number_of_posts' => '-1',
                'author_id' => '',
                'category_id' => '',
                'category_slug' => '',
                'orderby' => 'date',
                'order' => '',
                'tag_slug' => '',
                'post_in' => '',
                'post_not_in' => '',
                'sort' => '',
                'offset' => '0',
                'paged' => '',
                'pagination' => 'no',
                'pagination_type' => '',
                'post_status' => 'publish'
            ), $params);

        $query_array = array();

        $query_array['post_status'] = $params['post_status']; //to ensure that ajax call will not return 'private' posts

        $categoryExist = true;
        $categoryHasPosts = true;
        if (is_wp_error(get_the_category_by_ID($params['category_id']))) {
            $categoryExist = false;
        } else {
            $categoryHasPosts = get_posts('cat=' . $params['category_id']);
            if (empty($categoryHasPosts)) {
                $categoryHasPosts = false;
            }
        }
        if ($params['category_id'] !== '' && $categoryExist && $categoryHasPosts) {
            $query_array['cat'] = $params['category_id'];
        }
        if ($params['category_slug'] !== '') {
            $query_array['category_name'] = $params['category_slug'];
        }
        $userExist = true;
        if (get_the_author_meta('display_name',$params['author_id']) === '') {
            $userExist = false;
        }
        if ($params['author_id'] !== "" && $userExist) {
            $query_array['author'] = $params['author_id'];
        }
        if (!empty($params['tag_slug'])) {
            $query_array['tag'] = str_replace(' ', '-', $params['tag_slug']);
        }
        if (!empty($params['post_not_in'])) {
            $query_array['post__not_in'] = explode(",", $params['post_not_in']);
        }
        if (!empty($params['post_in'])) {
            $query_array['post__in'] = explode(",", $params['post_in']);
        }

        $query_array['ignore_sticky_posts'] = '1';

        switch ($params['sort']) {
            case 'latest':
                $query_array['orderby'] = 'date';
                break;

            case 'random':
                $query_array['orderby'] = 'rand';
                break;

            case 'random_today':
                $query_array['orderby'] = 'rand';
                $query_array['year'] = date('Y');
                $query_array['monthnum'] = date('n');
                $query_array['day'] = date('j');
                break;

            case 'random_seven_days':
                $query_array['date_query'] = array(
                    'column' => 'post_date_gmt',
                    'after' => '1 week ago'
                );
                break;

            case 'comments':
                $query_array['orderby'] = 'comment_count';
                $query_array['order'] = 'DESC';
                break;

            case 'title':
                $query_array['orderby'] = 'title';
                $query_array['order'] = 'ASC';
                break;

            case 'popular':
                $query_array['meta_key'] = 'count_post_views';
                $query_array['orderby'] = 'meta_value_num';
                $query_array['order'] = 'DESC';
                break;
            case 'featured_first':
                $query_array['meta_key'] = 'mkdf_show_featured_post';
                $query_array['orderby'] = 'meta_value';
                $query_array['order'] = 'DESC';
                break;
        }

        $query_array['posts_per_page'] = $params['number_of_posts'];

        if (!empty($params['order'])) {
            $query_array['order'] = $params['order'];
        }

        if ($params['paged'] == '') {
            if (get_query_var('paged')) {
                $params['paged'] = get_query_var('paged');
            } elseif (get_query_var('page')) {
                $params['paged'] = get_query_var('page');
            }
        }

        if (!empty($params['paged'])) {
            $query_array['paged'] = $params['paged'];
        } else {
            $query_array['paged'] = 1;
        }

        if (!empty($params['offset'])) {
            if ($query_array['paged'] > 1) {
                $query_array['offset'] = $params['offset'] + (($params['paged'] - 1) * $params['number_of_posts']);
            } else {
                $query_array['offset'] = $params['offset'];
            }
        }


        $list_query = new WP_Query($query_array);

        return $list_query;
    }
}

if (!function_exists('hashmag_mikado_get_filtered_params')) {
    /**
     * Function that returns associative array without prefix.
     * This function is used for block shortcodes (prefix_param -> param)
     *
     * @param $params array which need to be filtered
     * @param $prefix string part of key that need to be removed
     *
     * @return array
     */

    function hashmag_mikado_get_filtered_params($params, $prefix) {
        $params_filtered = array();

        foreach ($params as $key => $value) {
            $new_key = substr($key, strlen($prefix) + 1);
            $params_filtered[$new_key] = $value;
        }

        return $params_filtered;
    }
}

if (!function_exists('hashmag_mikado_get_title_substring')) {
    /**
     * Function that returns substring of title
     *
     * @param $title string that need to be shorten
     * @param $length size of substring
     *
     * @return array
     */

    function hashmag_mikado_get_title_substring($title, $length) {
        $new_title = esc_attr($title);
        $title_length = strlen($title);
        if ($length !== '' && $title_length > $length) {
            $new_title = rtrim(substr($new_title, 0, $length)) . '...';
        }

        return $new_title;
    }
}


/***** General Group Visual Composer Options for Shortcodes *****/
if (!function_exists('hashmag_mikado_get_general_shortcode_params')) {
    /**
     * Function that returns array of general predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function hashmag_mikado_get_general_shortcode_params($exclude_options = array()) {

        $params_array = array();

        // GENERAL OPTIONS - START

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => 'Extra Class Name',
            'param_name' => 'extra_class_name',
            'description' => '',
            "group" => "General"
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => 'Style',
            'param_name' => 'general_style',
            'value' => array(
                'Default' => '',
                'Dark' => 'dark',
                'Light' => 'light'
            ),
            'description' => 'Choose predifined style',
            "group" => "General"
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => 'Carousel Layout',
            'param_name' => 'carousel_layout',
            'value' => array(
                'Two Posts' => 'two-posts',
                'Three Posts' => 'three-posts',
                'Four Posts' => 'four-posts'
            ),
            'save_always' => true,
            'description' => '',
            "group" => "General"
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => 'Number of Posts',
            'param_name' => 'number_of_posts',
            'description' => '',
            'value' => '6',
            'save_always' => true,
            "group" => "General"
        );

        $params_array[] = array(
            "type" => "dropdown",
            "class" => "",
            "heading" => "Number of Columns",
            "param_name" => "column_number",
            "value" => array(
                "" => "",
                "One" => 1,
                "Two" => 2,
                "Three" => 3,
                "Four" => 4,
                "Five" => 5
            ),
            'description' => '',
            "group" => "General"
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => 'Block Proportion',
            'param_name' => 'block_proportion',
            'value' => array(
                '1/2+1/2' => 'two_half',
                '2/3+1/3' => 'two_third_one_third',
                '1/3+2/3' => 'one_third_two_third',
                '3/4+1/4' => 'three_fourths_one_fourth'
            ),
            'save_always' => true,
            'description' => '',
            "group" => "General"
        );

        $params_array[] = array(
            "type" => "dropdown",
            "class" => "",
            "heading" => "Category",
            "value" => hashmag_mikado_get_post_categories_VC(),
            "param_name" => "category_id",
            'save_always' => true,
            "group" => "General"
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => 'Category Slug',
            'param_name' => 'category_slug',
            'description' => 'Leave empty for all or use comma for list',
            "group" => "General"
        );

        $params_array[] = array(
            "type" => "dropdown",
            "admin_label" => true,
            "class" => "",
            "heading" => "Choose Author",
            "param_name" => "author_id",
            "value" => hashmag_mikado_get_authors_VC(),
            "description" => "",
            'save_always' => true,
            "group" => "General"
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => 'Tag Slug',
            'param_name' => 'tag_slug',
            'description' => 'Leave empty for all or use comma for list',
            "group" => "General"
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => 'Include Posts',
            'param_name' => 'post_in',
            'description' => 'Enter the IDs of the posts you want to display',
            "group" => "General"
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => 'Exclude Posts',
            'param_name' => 'post_not_in',
            'description' => 'Enter the IDs of the posts you want to exclude',
            "group" => "General"
        );

        $params_array[] = array(
            "type" => "dropdown",
            "admin_label" => true,
            "class" => "",
            "heading" => "Sort",
            "param_name" => "sort",
            "value" => hashmag_mikado_get_sort_array(),
            "description" => "",
            "group" => "General"
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => 'Layout Title',
            'param_name' => 'title',
            'description' => '',
            'group' => 'General'
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => 'Carousel Title',
            'param_name' => 'carousel_title',
            'description' => '',
            "group" => "General"
        );

        // GENERAL OPTIONS - END

        if (is_array($exclude_options) && count($exclude_options)) {
            foreach ($exclude_options as $exclude_key) {
                foreach ($params_array as $params_item) {
                    if ($exclude_key == $params_item['param_name']) {
                        $key = array_search($params_item, $params_array);
                        unset($params_array[$key]);
                    }
                }
            }
        }

        return $params_array;
    }
}

/***** Feature Group Visual Composer Options for Shortcodes *****/
if (!function_exists('hashmag_mikado_get_feature_shortcode_params')) {
    /**
     * Function that returns array of feature predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function hashmag_mikado_get_feature_shortcode_params($exclude_options = array()) {

        $params_array = array();

        // FEATURE OPTIONS - START

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => 'Image Size',
            'param_name' => 'featured_thumb_image_size',
            'value' => array(
                'Original' => 'original',
                'Landscape' => 'landscape',
                'Portrait' => 'portrait',
                'Square' => 'square',
                'Custom' => 'custom_size'
            ),
            'save_always' => true,
            'description' => '',
            'group' => 'Featured Item'
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => 'Image Width (px)',
            'param_name' => 'featured_thumb_image_width',
            'description' => 'Set custom image width (px)',
            'dependency' => array('element' => 'featured_thumb_image_size', 'value' => array('custom_size')),
            'group' => 'Featured Item'
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => 'Image Height (px)',
            'param_name' => 'featured_thumb_image_height',
            'description' => 'Set custom image height (px)',
            'dependency' => array('element' => 'featured_thumb_image_size', 'value' => array('custom_size')),
            'group' => 'Featured Item'
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => 'Custom Image Width (px)',
            'param_name' => 'featured_custom_thumb_image_width',
            'description' => 'Set custom image width (px)',
            'group' => 'Featured Item'
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => 'Custom Image Height (px)',
            'param_name' => 'featured_custom_thumb_image_height',
            'description' => 'Set custom image height (px)',
            'group' => 'Featured Item'
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => 'Title Tag',
            'param_name' => 'featured_title_tag',
            'value' => array(
                'Default' => '',
                'h2' => 'h2',
                'h3' => 'h3',
                'h4' => 'h4',
                'h5' => 'h5',
                'h6' => 'h6',
            ),
            'description' => '',
            'group' => 'Featured Item'
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => 'Title Max Chars',
            'param_name' => 'featured_title_length',
            'description' => 'Enter max characters of title post list that you want to display',
            'group' => 'Featured Item'
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => 'Display Excerpt',
            'param_name' => 'featured_display_excerpt',
            'value' => array(
                'Default' => '',
                'Yes' => 'yes',
                'No' => 'no'
            ),
            'description' => '',
            'group' => 'Featured Item'
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => 'Max. Excerpt Length',
            'param_name' => 'featured_excerpt_length',
            'value' => '',
            'description' => 'Enter max of words that can be shown for excerpt',
            'dependency' => array('element' => 'featured_display_excerpt', 'value' => array('yes')),
            'group' => 'Featured Item'
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => 'Display Date',
            'param_name' => 'featured_display_date',
            'value' => array(
                'Default' => '',
                'Yes' => 'yes',
                'No' => 'no'
            ),
            'description' => '',
            'group' => 'Featured Item'
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => 'Date Format',
            'param_name' => 'featured_date_format',
            'description' => 'Enter the date format that you want to display',
            'dependency' => array('element' => 'featured_display_date', 'value' => array('yes', '')),
            'group' => 'Featured Item'
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => 'Display Category',
            'param_name' => 'featured_display_category',
            'value' => array(
                'Default' => '',
                'Yes' => 'yes',
                'No' => 'no'
            ),
            'description' => '',
            'group' => 'Featured Item'
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => 'Display Author',
            'param_name' => 'featured_display_author',
            'value' => array(
                'Default' => '',
                'Yes' => 'yes',
                'No' => 'no'
            ),
            'description' => '',
            'group' => 'Featured Item'
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => 'Display Comments',
            'param_name' => 'featured_display_comments',
            'value' => array(
                'Default' => '',
                'No' => 'no',
                'Yes' => 'yes',
            ),
            'description' => '',
            'group' => 'Featured Item'
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => 'Display Like',
            'param_name' => 'featured_display_like',
            'value' => array(
                'Default' => '',
                'Yes' => 'yes',
                'No' => 'no'
            ),
            'description' => '',
            'group' => 'Featured Item'
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => 'Display Count',
            'param_name' => 'featured_display_count',
            'value' => array(
                'Default' => '',
                'Yes' => 'yes',
                'No' => 'no'
            ),
            'description' => '',
            'group' => 'Featured Item'
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => 'Display Post Type Icon',
            'param_name' => 'featured_display_post_type_icon',
            'value' => array(
                'No' => 'no',
                'Yes' => 'yes'
            ),
            'save_always' => true,
            'description' => '',
            'group' => 'Featured Item'
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => 'Display share links',
            'param_name' => 'featured_display_share',
            'value' => array(
                'No' => 'no',
                'Yes' => 'yes'
            ),
            'save_always' => true,
            'group' => 'Featured Item'
        );
        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => 'Display Trending Icon',
            'param_name' => 'featured_display_featured_icon',
            'value' => array(
                'No' => 'no',
                'Yes' => 'yes'
            ),
            'description' => 'Display icon on trending posts',
            'group' => 'Featured Item'
        );

        // FEATURE OPTIONS - END

        if (is_array($exclude_options) && count($exclude_options)) {
            foreach ($exclude_options as $exclude_key) {
                foreach ($params_array as $params_item) {
                    if ($exclude_key == $params_item['param_name']) {
                        $key = array_search($params_item, $params_array);
                        unset($params_array[$key]);
                    }
                }
            }
        }

        return $params_array;
    }
}

/***** Non-Feature Group Visual Composer Options for Shortcodes *****/
if (!function_exists('hashmag_mikado_get_non_feature_shortcode_params')) {
    /**
     * Function that returns array of non-feature predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function hashmag_mikado_get_non_feature_shortcode_params($exclude_options = array()) {

        $params_array = array();

        // NON-FEATURED OPTIONS - START

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => 'Image Size',
            'param_name' => 'thumb_image_size',
            'value' => array(
                'Original' => 'original',
                'Landscape' => 'landscape',
                'Portrait' => 'portrait',
                'Square' => 'square',
                'Custom' => 'custom_size'
            ),
            'save_always' => true,
            'description' => '',
            'group' => 'Post Item'
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => 'Image Width (px)',
            'param_name' => 'thumb_image_width',
            'description' => 'Set custom image width (px)',
            'dependency' => array('element' => 'thumb_image_size', 'value' => array('custom_size')),
            'group' => 'Post Item'
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => 'Image Height (px)',
            'param_name' => 'thumb_image_height',
            'description' => 'Set custom image height (px)',
            'dependency' => array('element' => 'thumb_image_size', 'value' => array('custom_size')),
            'group' => 'Post Item'
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => 'Custom Image Width (px)',
            'param_name' => 'custom_thumb_image_width',
            'description' => 'Set custom image width (px)',
            'group' => 'Post Item'
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => 'Custom Image Height (px)',
            'param_name' => 'custom_thumb_image_height',
            'description' => 'Set custom image height (px)',
            'group' => 'Post Item'
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => 'Title Tag',
            'param_name' => 'title_tag',
            'value' => array(
                'Default' => '',
                'h2' => 'h2',
                'h3' => 'h3',
                'h4' => 'h4',
                'h5' => 'h5',
                'h6' => 'h6',
            ),
            'description' => '',
            'group' => 'Post Item'
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => 'Title Max Chars',
            'param_name' => 'title_length',
            'description' => 'Enter max characters of title post list that you want to display',
            'group' => 'Post Item'
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => 'Display Date',
            'param_name' => 'display_date',
            'value' => array(
                'Default' => '',
                'Yes' => 'yes',
                'No' => 'no'
            ),
            'description' => '',
            'group' => 'Post Item'
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => 'Date Format',
            'param_name' => 'date_format',
            'description' => 'Enter the date format that you want to display',
            'dependency' => array('element' => 'display_date', 'value' => array('yes', '')),
            'group' => 'Post Item'
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => 'Display Category',
            'param_name' => 'display_category',
            'value' => array(
                'Default' => '',
                'Yes' => 'yes',
                'No' => 'no'
            ),
            'description' => '',
            'group' => 'Post Item'
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => 'Display Author',
            'param_name' => 'display_author',
            'value' => array(
                'Default' => '',
                'Yes' => 'yes',
                'No' => 'no'
            ),
            'description' => '',
            'group' => 'Post Item'
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => 'Display Comments',
            'param_name' => 'display_comments',
            'value' => array(
                'Default' => '',
                'No' => 'no',
                'Yes' => 'yes',
            ),
            'description' => '',
            'group' => 'Post Item'
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => 'Display Like',
            'param_name' => 'display_like',
            'value' => array(
                'Default' => '',
                'Yes' => 'yes',
                'No' => 'no'
            ),
            'description' => '',
            'group' => 'Post Item'
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => 'Display Count',
            'param_name' => 'display_count',
            'value' => array(
                'Default' => '',
                'Yes' => 'yes',
                'No' => 'no'
            ),
            'description' => '',
            'group' => 'Post Item'
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => 'Display Excerpt',
            'param_name' => 'display_excerpt',
            'value' => array(
                'Default' => '',
                'Yes' => 'yes',
                'No' => 'no'
            ),
            'description' => '',
            'group' => 'Post Item'
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => 'Max. Excerpt Length',
            'param_name' => 'excerpt_length',
            'value' => '',
            'description' => 'Enter max of words that can be shown for excerpt',
            'dependency' => array('element' => 'display_excerpt', 'value' => array('yes')),
            'group' => 'Post Item'
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => 'Display Post Type Icon',
            'param_name' => 'display_post_type_icon',
            'value' => array(
                'No' => 'no',
                'Yes' => 'yes'
            ),
            'save_always' => true,
            'description' => '',
            'group' => 'Post Item'
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => 'Display share links',
            'param_name' => 'display_share',
            'value' => array(
                'No' => 'no',
                'Yes' => 'yes'
            ),
            'save_always' => true,
            'group' => 'Post Item'
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => 'Display Trending Icon',
            'param_name' => 'display_featured_icon',
            'value' => array(
                'No' => 'no',
                'Yes' => 'yes'
            ),
            'description' => 'Display featured icon on featured posts',
            'group' => 'Post Item'
        );

        // NON-FEATURED OPTIONS - END

        if (is_array($exclude_options) && count($exclude_options)) {
            foreach ($exclude_options as $exclude_key) {
                foreach ($params_array as $params_item) {
                    if ($exclude_key == $params_item['param_name']) {
                        $key = array_search($params_item, $params_array);
                        unset($params_array[$key]);
                    }
                }
            }
        }

        return $params_array;
    }
}

/***** Pagination Group Visual Composer Options for Shortcodes *****/
if (!function_exists('hashmag_mikado_get_pagination_shortcode_params')) {
    /**
     * Function that returns array of pagination predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function hashmag_mikado_get_pagination_shortcode_params($exclude_options = array()) {

        $params_array = array();

        // PAGINATION OPTIONS - START

        $params_array[] = array(
            'type' => 'dropdown',
            'class' => '',
            'heading' => 'Pagination',
            'param_name' => 'display_pagination',
            'value' => array(
                'No' => 'no',
                'Yes' => 'yes'
            ),
            'save_always' => true,
            'description' => '',
            'group' => 'Pagination'
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'class' => '',
            'heading' => 'Pagination Type',
            'param_name' => 'pagination_type',
            'value' => array(
                "Horizontal Navigation" => "np-horizontal",
                "Load More" => "load-more",
                "Infinite Scroll" => "infinite"
            ),
            'description' => '',
            'save_always' => true,
            'dependency' => array('element' => 'display_pagination', 'value' => array('yes')),
            'group' => 'Pagination'
        );

        // PAGINATION OPTIONS - END

        if (is_array($exclude_options) && count($exclude_options)) {
            foreach ($exclude_options as $exclude_key) {
                foreach ($params_array as $params_item) {
                    if ($exclude_key == $params_item['param_name']) {
                        $key = array_search($params_item, $params_array);
                        unset($params_array[$key]);
                    }
                }
            }
        }

        return $params_array;
    }
}

/***** Navigation Group Visual Composer Options for Shortcodes *****/
if (!function_exists('hashmag_mikado_get_navigation_shortcode_params')) {
    /**
     * Function that returns array of navigation predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function hashmag_mikado_get_navigation_shortcode_params($exclude_options = array()) {

        $params_array = array();

        // NAVIGATION OPTIONS - START

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => 'Display Navigation',
            'param_name' => 'display_navigation',
            'value' => array(
                'Yes' => 'yes',
                'No' => 'no'
            ),
            'save_always' => true,
            'description' => '',
            'group' => 'Navigation'
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => 'Display Paging',
            'param_name' => 'display_paging',
            'value' => array(
                'No' => 'no',
                'Yes' => 'yes'
            ),
            'description' => '',
            'save_always' => true,
            'group' => 'Navigation'
        );

        // NAVIGATION OPTIONS - END

        if (is_array($exclude_options) && count($exclude_options)) {
            foreach ($exclude_options as $exclude_key) {
                foreach ($params_array as $params_item) {
                    if ($exclude_key == $params_item['param_name']) {
                        $key = array_search($params_item, $params_array);
                        unset($params_array[$key]);
                    }
                }
            }
        }

        return $params_array;
    }
}

/***** Default Visual Composer Options for Shortcodes *****/
if (!function_exists('hashmag_mikado_get_shortcode_params_default')) {
    /**
     * Function that returns array of default predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function hashmag_mikado_get_shortcode_params_default($exclude_options = array()) {

        // GENERAL OPTIONS - BEGIN

        $params_general_array = hashmag_mikado_get_general_shortcode_params();

        // GENERAL OPTIONS - END

        // FEATURED POST OPTIONS - START

        $params_feature_array = hashmag_mikado_get_feature_shortcode_params();

        // FEATURED POST OPTIONS - END

        // NON-FEATURED POSTS OPTIONS - START

        $params_non_feature_array = hashmag_mikado_get_non_feature_shortcode_params();

        // NON-FEATURED POSTS OPTIONS - END

        // PAGINATION OPTIONS - START

        $params_pagination_array = hashmag_mikado_get_pagination_shortcode_params();

        // PAGINATION OPTIONS - END

        // NAVIGATION OPTIONS - START

        $params_navigation_array = hashmag_mikado_get_navigation_shortcode_params();

        // NAVIGATION OPTIONS - END              

        $params_array = array_merge($params_general_array, $params_feature_array, $params_non_feature_array, $params_pagination_array, $params_navigation_array);

        if (is_array($exclude_options) && count($exclude_options)) {
            foreach ($exclude_options as $exclude_key) {
                foreach ($params_array as $params_item) {
                    if ($exclude_key == $params_item['param_name']) {
                        $key = array_search($params_item, $params_array);
                        unset($params_array[$key]);
                    }
                }
            }
        }

        return $params_array;
    }
}

/***** Visual Composer Options for Block One Shortcode *****/
if (!function_exists('hashmag_mikado_get_block_one_params')) {
    /**
     * Function that returns array of predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function hashmag_mikado_get_block_one_params() {

        // GENERAL OPTIONS - BEGIN

        $params_general_array = hashmag_mikado_get_general_shortcode_params(
            array(
                'carousel_layout',
                'carousel_title',
                'column_number',
            ));

        // GENERAL OPTIONS - END

        // FEATURED POST OPTIONS - START

        $params_feature_array = hashmag_mikado_get_feature_shortcode_params(array(
            'featured_custom_thumb_image_width',
            'featured_custom_thumb_image_height'
        ));


        // FEATURED POST OPTIONS - END

        // NON-FEATURED POSTS OPTIONS - START

        $params_non_feature_array = hashmag_mikado_get_non_feature_shortcode_params(
            array(
                'thumb_image_size',
                'thumb_image_width',
                'thumb_image_height',
                'display_share',
                'display_post_type_icon',
                'display_featured_icon'
            ));

        // NON-FEATURED POSTS OPTIONS - END

        // PAGINATION OPTIONS - START

        $params_pagination_array = hashmag_mikado_get_pagination_shortcode_params();

        // PAGINATION OPTIONS - END

        $params_array = array_merge($params_general_array, $params_feature_array, $params_non_feature_array, $params_pagination_array);

        return $params_array;
    }
}


/***** Visual Composer Options for Block Two Shortcode *****/
if (!function_exists('hashmag_mikado_get_block_two_params')) {
    /**
     * Function that returns array of predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function hashmag_mikado_get_block_two_params() {

        // GENERAL OPTIONS - BEGIN

        $params_general_array = hashmag_mikado_get_general_shortcode_params(
            array(
                'carousel_layout',
                'carousel_title',
                'column_number',
                'general_style'
            ));

        // GENERAL OPTIONS - END

        // FEATURED POST OPTIONS - START

        $params_feature_array = hashmag_mikado_get_feature_shortcode_params(array(
            'featured_custom_thumb_image_width',
            'featured_custom_thumb_image_height',
            'featured_display_share',
            'featured_display_featured_icon'
        ));

        // FEATURED POST OPTIONS - END

        // NON-FEATURED POSTS OPTIONS - START

        $params_non_feature_array = hashmag_mikado_get_non_feature_shortcode_params(
            array(
                'custom_thumb_image_width',
                'custom_thumb_image_height',
                'display_share',
                'display_featured_icon'
            ));

        // NON-FEATURED POSTS OPTIONS - END

        // PAGINATION OPTIONS - START

        $params_pagination_array = hashmag_mikado_get_pagination_shortcode_params();

        // PAGINATION OPTIONS - END

        $params_array = array_merge($params_general_array, $params_feature_array, $params_non_feature_array, $params_pagination_array);

        return $params_array;
    }
}

/***** Visual Composer Options for Block Three Shortcode *****/
if (!function_exists('hashmag_mikado_get_block_three_params')) {
    /**
     * Function that returns array of predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function hashmag_mikado_get_block_three_params() {

        // GENERAL OPTIONS - BEGIN

        $params_general_array = hashmag_mikado_get_general_shortcode_params(
            array(
                'carousel_layout',
                'carousel_title',
                'block_proportion',
                'column_number',
            ));

        // GENERAL OPTIONS - END

        // FEATURED POST OPTIONS - START

        $params_feature_array = hashmag_mikado_get_feature_shortcode_params(array(
            'featured_custom_thumb_image_height',
            'featured_custom_thumb_image_width',
            'featured_display_featured_icon'
        ));

        // FEATURED POST OPTIONS - END

        // NON-FEATURED POSTS OPTIONS - START

        $params_non_feature_array = hashmag_mikado_get_non_feature_shortcode_params(
            array(
                'thumb_image_size',
                'thumb_image_width',
                'thumb_image_height',
                'custom_thumb_image_width',
                'custom_thumb_image_height',
                'display_excerpt',
                'excerpt_length',
                'display_share',
                'display_post_type_icon',
                'display_featured_icon'
            ));

        // NON-FEATURED POSTS OPTIONS - END

        // PAGINATION OPTIONS - START

        $params_pagination_array = hashmag_mikado_get_pagination_shortcode_params();

        // PAGINATION OPTIONS - END

        $params_array = array_merge($params_general_array, $params_feature_array, $params_non_feature_array, $params_pagination_array);

        return $params_array;
    }
}

/***** Visual Composer Options for Block Four Shortcode *****/
if (!function_exists('hashmag_mikado_get_block_four_params')) {
    /**
     * Function that returns array of predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function hashmag_mikado_get_block_four_params() {

        // GENERAL OPTIONS - BEGIN

        $params_general_array = hashmag_mikado_get_general_shortcode_params(
            array(
                'number_of_posts',
                'block_proportion',
                'carousel_layout',
                'carousel_title',
                'column_number',
            ));

        // GENERAL OPTIONS - END

        // FEATURED POST OPTIONS - START

        $params_feature_array = hashmag_mikado_get_feature_shortcode_params(array(
            'featured_custom_thumb_image_width',
            'featured_custom_thumb_image_height',
            'featured_display_featured_icon'
        ));


        // FEATURED POST OPTIONS - END

        // NON-FEATURED POSTS OPTIONS - START

        $params_non_feature_array = hashmag_mikado_get_non_feature_shortcode_params(
            array(
                'display_date',
                'display_comments',
                'display_count',
                'date_format',
                'display_excerpt',
                'excerpt_length',
                'display_author',
                'display_like',
                'display_category',
                'thumb_image_size',
                'thumb_image_width',
                'thumb_image_height',
                'display_share',
                'display_post_type_icon',
                'display_featured_icon'
            ));

        // NON-FEATURED POSTS OPTIONS - END

        $params_array = array_merge($params_general_array, $params_feature_array, $params_non_feature_array);

        return $params_array;
    }
}

/***** Visual Composer Options for Layout One Shortcode *****/
if (!function_exists('hashmag_mikado_get_layout_one_params')) {
    /**
     * Function that returns array of predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function hashmag_mikado_get_layout_one_params() {

        // GENERAL OPTIONS - BEGIN

        $params_general_array = hashmag_mikado_get_general_shortcode_params(
            array(
                'carousel_layout',
                'carousel_title',
                'block_proportion',
            ));

        $params_general_additonal_array = array(
            array(
                'type' => 'dropdown',
                'class' => '',
                'heading' => 'Remove Bottom Border',
                'param_name' => 'remove_bottom_border',
                'value' => array(
                    'No' => '',
                    'Last Row' => 'last_row',
                    'All' => 'all',
                ),
                'save_always' => true,
                'description' => 'This option will remove bottom border from post items',
                'group' => 'General'
            )
        );

        $params_general_array = array_merge($params_general_additonal_array, $params_general_array);

        // GENERAL OPTIONS - END

        // NON-FEATURED POSTS OPTIONS - START

        $params_non_feature_array = hashmag_mikado_get_non_feature_shortcode_params(
            array(
                'custom_thumb_image_width',
                'custom_thumb_image_height'
            ));

        // NON-FEATURED POSTS OPTIONS - END

        // PAGINATION OPTIONS - START

        $params_pagination_array = hashmag_mikado_get_pagination_shortcode_params();

        // PAGINATION OPTIONS - END

        $params_array = array_merge($params_general_array, $params_non_feature_array, $params_pagination_array);

        return $params_array;
    }
}

/***** Visual Composer Options for Layout Two Shortcode *****/
if (!function_exists('hashmag_mikado_get_layout_two_params')) {
    /**
     * Function that returns array of predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function hashmag_mikado_get_layout_two_params() {

        // GENERAL OPTIONS - BEGIN

        $params_general_array = hashmag_mikado_get_general_shortcode_params(
            array(
                'carousel_layout',
                'carousel_title',
                'block_proportion',
            ));

        // GENERAL OPTIONS - END

        // NON-FEATURED POSTS OPTIONS - START

        $params_non_feature_array = hashmag_mikado_get_non_feature_shortcode_params(
            array(
                'thumb_image_size',
                'thumb_image_width',
                'thumb_image_height',
                'display_share',
                'display_post_type_icon',
                'display_featured_icon'
            ));

        // NON-FEATURED POSTS OPTIONS - END

        // PAGINATION OPTIONS - START

        $params_pagination_array = hashmag_mikado_get_pagination_shortcode_params();

        // PAGINATION OPTIONS - END

        $params_array = array_merge($params_general_array, $params_non_feature_array, $params_pagination_array);

        return $params_array;
    }
}


/***** Visual Composer Options for Layout Three Shortcode *****/
if (!function_exists('hashmag_mikado_get_layout_three_params')) {
    /**
     * Function that returns array of predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function hashmag_mikado_get_layout_three_params() {

        // GENERAL OPTIONS - BEGIN

        $params_general_array = hashmag_mikado_get_general_shortcode_params(
            array(
                'carousel_layout',
                'carousel_title',
                'block_proportion',
            ));

        // GENERAL OPTIONS - END

        // NON-FEATURED POSTS OPTIONS - START

        $params_non_feature_array = hashmag_mikado_get_non_feature_shortcode_params(
            array(
                'custom_thumb_image_width',
                'custom_thumb_image_height',
                'display_post_type_icon',
                'display_share',
                'display_featured_icon'
            ));

        // NON-FEATURED POSTS OPTIONS - END

        // PAGINATION OPTIONS - START

        $params_pagination_array = hashmag_mikado_get_pagination_shortcode_params();

        // PAGINATION OPTIONS - END

        $params_array = array_merge($params_general_array, $params_non_feature_array, $params_pagination_array);

        return $params_array;
    }
}


/***** Visual Composer Options for Layout Four Shortcode *****/
if (!function_exists('hashmag_mikado_get_layout_four_params')) {
    /**
     * Function that returns array of predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function hashmag_mikado_get_layout_four_params() {

        // GENERAL OPTIONS - BEGIN

        $params_general_array = hashmag_mikado_get_general_shortcode_params(
            array(
                'carousel_layout',
                'carousel_title',
                'block_proportion',
            ));

        // GENERAL OPTIONS - END

        // NON-FEATURED POSTS OPTIONS - START

        $params_non_feature_array = hashmag_mikado_get_non_feature_shortcode_params(
            array(
                'thumb_image_size',
                'thumb_image_width',
                'thumb_image_height',
                'custom_thumb_image_width',
                'custom_thumb_image_height',
                'display_excerpt',
                'excerpt_length',
                'display_share',
                'display_post_type_icon',
                'display_featured_icon'
            ));

        // NON-FEATURED POSTS OPTIONS - END

        // PAGINATION OPTIONS - START

        $params_pagination_array = hashmag_mikado_get_pagination_shortcode_params();

        // PAGINATION OPTIONS - END

        $params_array = array_merge($params_general_array, $params_non_feature_array, $params_pagination_array);

        return $params_array;
    }
}

/***** Visual Composer Options for Layout Five Shortcode *****/
if (!function_exists('hashmag_mikado_get_layout_five_params')) {
    /**
     * Function that returns array of predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function hashmag_mikado_get_layout_five_params() {

        // GENERAL OPTIONS - BEGIN

        $params_general_array = hashmag_mikado_get_general_shortcode_params(
            array(
                'carousel_layout',
                'carousel_title',
                'block_proportion',
                'general_style'
            ));

        // GENERAL OPTIONS - END

        // NON-FEATURED POSTS OPTIONS - START

        $params_non_feature_array = hashmag_mikado_get_non_feature_shortcode_params(
            array(
                'custom_thumb_image_width',
                'custom_thumb_image_height',
                'display_post_type_icon'
            ));

        // NON-FEATURED POSTS OPTIONS - END

        // PAGINATION OPTIONS - START

        $params_pagination_array = hashmag_mikado_get_pagination_shortcode_params();

        // PAGINATION OPTIONS - END

        $params_array = array_merge($params_general_array, $params_non_feature_array, $params_pagination_array);

        return $params_array;
    }
}

/***** Visual Composer Options for Layout Six Shortcode *****/
if (!function_exists('hashmag_mikado_get_layout_six_params')) {
    /**
     * Function that returns array of predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function hashmag_mikado_get_layout_six_params() {

        // GENERAL OPTIONS - BEGIN

        $params_general_array = hashmag_mikado_get_general_shortcode_params(
            array(
                'carousel_layout',
                'carousel_title',
                'block_proportion',
            ));

        // GENERAL OPTIONS - END

        // NON-FEATURED POSTS OPTIONS - START

        $params_non_feature_array = hashmag_mikado_get_non_feature_shortcode_params(
            array(
                'thumb_image_size',
                'thumb_image_width',
                'thumb_image_height',
                'display_post_type_icon'
            ));


        // NON-FEATURED POSTS OPTIONS - END

        // PAGINATION OPTIONS - START

        $params_pagination_array = hashmag_mikado_get_pagination_shortcode_params();

        // PAGINATION OPTIONS - END

        $params_array = array_merge($params_general_array, $params_non_feature_array, $params_pagination_array);

        return $params_array;
    }
}

/***** Visual Composer Options for Layout One Shortcode *****/
if (!function_exists('hashmag_mikado_get_layout_seven_params')) {
    /**
     * Function that returns array of predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function hashmag_mikado_get_layout_seven_params() {

        // GENERAL OPTIONS - BEGIN

        $params_general_array = hashmag_mikado_get_general_shortcode_params(
            array(
                'carousel_layout',
                'carousel_title',
                'block_proportion',
            ));

        // GENERAL OPTIONS - END

        // NON-FEATURED POSTS OPTIONS - START

        $params_non_feature_array = hashmag_mikado_get_non_feature_shortcode_params(
            array(
                'custom_thumb_image_width',
                'custom_thumb_image_height',
                'display_share',
                'display_featured_icon'
            ));

        // NON-FEATURED POSTS OPTIONS - END

        // PAGINATION OPTIONS - START

        $params_pagination_array = hashmag_mikado_get_pagination_shortcode_params();

        // PAGINATION OPTIONS - END

        $params_array = array_merge($params_general_array, $params_non_feature_array, $params_pagination_array);

        return $params_array;
    }
}

/***** Visual Composer Options for Post Slider Classic Shortcode *****/
if (!function_exists('hashmag_mikado_get_slider_classic_params')) {
    /**
     * Function that returns array of predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function hashmag_mikado_get_slider_classic_params() {

        // GENERAL OPTIONS - BEGIN

        $params_general_array = hashmag_mikado_get_general_shortcode_params(
            array(
                'carousel_layout',
                'carousel_title',
                'column_number',
                'block_proportion',
            ));

        // GENERAL OPTIONS - END

        // NON-FEATURED POSTS OPTIONS - START

        $params_non_feature_array = hashmag_mikado_get_non_feature_shortcode_params(
            array(
                'custom_thumb_image_width',
                'custom_thumb_image_height',
                'title_length',
                'display_excerpt',
                'excerpt_length',
                'display_featured_icon'
            ));

        // NON-FEATURED POSTS OPTIONS - END

        // NAVIGATION OPTIONS - START

        $params_navigation_array = hashmag_mikado_get_navigation_shortcode_params();

        // NAVIGATION OPTIONS - END    

        $params_array = array_merge($params_general_array, $params_non_feature_array, $params_navigation_array);

        return $params_array;
    }
}

/***** Visual Composer Options for Post Slider With Thumbnails Shortcode *****/
if (!function_exists('hashmag_mikado_get_slider_with_thumbnails_params')) {
    /**
     * Function that returns array of predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function hashmag_mikado_get_slider_with_thumbnails_params() {

        // GENERAL OPTIONS - BEGIN

        $params_general_array = hashmag_mikado_get_general_shortcode_params(
            array(
                'carousel_layout',
                'carousel_title',
                'column_number',
                'block_proportion',
                'general_style',
            ));

        // GENERAL OPTIONS - END

        // NON-FEATURED POSTS OPTIONS - START

        $params_non_feature_array = hashmag_mikado_get_non_feature_shortcode_params(
            array(
                'custom_thumb_image_width',
                'custom_thumb_image_height',
                'title_length',
                'display_excerpt',
                'excerpt_length',
                'display_post_type_icon',
                'display_share',
                'display_featured_icon'
            ));

        // NON-FEATURED POSTS OPTIONS - END

        $params_array = array_merge($params_general_array, $params_non_feature_array);

        return $params_array;
    }
}

/***** Visual Composer Options for Post Carousel Shortcode *****/
if (!function_exists('hashmag_mikado_get_carousel_params')) {
    /**
     * Function that returns array of predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function hashmag_mikado_get_carousel_params() {

        // GENERAL OPTIONS - BEGIN

        $params_general_array = hashmag_mikado_get_general_shortcode_params(
            array(
                'column_number',
                'carousel_title',
                'block_proportion',
            ));

        // GENERAL OPTIONS - END

        // NON-FEATURED POSTS OPTIONS - START

        $params_non_feature_array = hashmag_mikado_get_non_feature_shortcode_params(
            array(
                'custom_thumb_image_width',
                'custom_thumb_image_height'

            ));

        // NON-FEATURED POSTS OPTIONS - END

        // NAVIGATION OPTIONS - START

        $params_navigation_array = hashmag_mikado_get_navigation_shortcode_params(
            array(
                'display_paging'
            ));

        // NAVIGATION OPTIONS - END

        $params_array = array_merge($params_general_array, $params_non_feature_array, $params_navigation_array);

        return $params_array;
    }
}

/***** Visual Composer Options for Post Carousel Swipe Shortcode *****/
if (!function_exists('hashmag_mikado_get_carousel_swipe_params')) {
    /**
     * Function that returns array of predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function hashmag_mikado_get_carousel_swipe_params() {

        // GENERAL OPTIONS - BEGIN

        $params_general_array = hashmag_mikado_get_general_shortcode_params(
            array(
                'column_number',
                'carousel_title',
                'block_proportion',
            ));

        // GENERAL OPTIONS - END

        // NON-FEATURED POSTS OPTIONS - START

        $params_non_feature_array = hashmag_mikado_get_non_feature_shortcode_params(
            array(
                'thumb_image_size',
                'thumb_image_height',
                'thumb_image_width',
                'display_excerpt',
                'excerpt_length',
                'display_share',
                'display_featured_icon'
            ));

        // NON-FEATURED POSTS OPTIONS - END

        // NAVIGATION OPTIONS - START

        $params_navigation_array = hashmag_mikado_get_navigation_shortcode_params(
            array(
                'display_paging'
            ));

        // NAVIGATION OPTIONS - END

        $params_array = array_merge($params_general_array, $params_non_feature_array, $params_navigation_array);

        return $params_array;
    }
}