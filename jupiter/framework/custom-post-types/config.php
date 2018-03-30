<?php
if (!defined('THEME_FRAMEWORK')) exit('No direct script access allowed');

$mk_options = get_option(THEME_OPTIONS);


/*-----------------------------------------------------------------------------------*/

/* Register Clients Custom Post type */

/*-----------------------------------------------------------------------------------*/

Mk_Register_Custom_Post_Type('clients', __('Clients', 'mk_framework'), $supports = array(
    'title',
    'thumbnail',
    'page-attributes',
    'revisions'
) , $args = array(
    'menu_icon' => 'dashicons-businessman',
    'show_in_nav_menus' => false,
    'exclude_from_search' => true,
) , $singular = true);

function mk_edit_clients_columns($columns) {
    $columns = array(
        "cb" => "<input type=\"checkbox\" />",
        'title' => __('Client Name', 'mk_framework') ,
        "thumbnail" => __('Thumbnail', 'mk_framework') ,
        "date" => 'Date',
    );
    
    return $columns;
}
add_filter('manage_edit-clients_columns', 'mk_edit_clients_columns');

function mk_manage_clients_columns($column) {
    global $post;
    
    if ($post->post_type == "clients") {
        switch ($column) {
            case 'thumbnail':
                echo the_post_thumbnail('thumbnail');
                break;
        }
    }
}
add_action('manage_posts_custom_column', 'mk_manage_clients_columns', 10, 2);

/*-----------------------------------------------------------------------------------*/

/* Register Animated Columns Custom Post type */

/*-----------------------------------------------------------------------------------*/

Mk_Register_Custom_Post_Type('animated-columns', __('Animated Columns', 'mk_framework'), $supports = array(
    'title',
    'page-attributes',
    'revisions'
) , $args = array(
    'menu_icon' => 'dashicons-align-center',
    'show_in_nav_menus' => false,
    'exclude_from_search' => true,
) , $singular = true);

function mk_edit_animated_columns($columns) {
    $columns = array(
        "cb" => "<input type=\"checkbox\" />",
        'title' => __('Client Name', 'mk_framework') ,
        "icon_type" => __('Icon Type', 'mk_framework') ,
        "column_title" => __('Column Title', 'mk_framework') ,
        "column_desc" => __('Column Description', 'mk_framework') ,
        "date" => 'Date',
    );
    
    return $columns;
}
add_filter('manage_edit-animated-columns_columns', 'mk_edit_animated_columns');

function mk_manage_animated_columns($column) {
    global $post;
    
    if ($post->post_type == "animated-columns") {
        switch ($column) {
            case "icon_type":
                echo get_post_meta($post->ID, '_icon_type', true);
                break;

            case "column_title":
                echo get_post_meta($post->ID, '_title', true);
                break;

            case "column_desc":
                echo get_post_meta($post->ID, '_desc', true);
                break;
        }
    }
}
add_action('manage_posts_custom_column', 'mk_manage_animated_columns', 10, 2);

/*-----------------------------------------------------------------------------------*/

/* Register Banner Builder Custom Post type */

/*-----------------------------------------------------------------------------------*/

Mk_Register_Custom_Post_Type('banner_builder', __('Banner Builder', 'mk_framework'), $supports = array(
    'title',
    'editor',
    'thumbnail',
    'page-attributes',
    'revisions'
) , $args = array(
    'menu_icon' => 'dashicons-format-image',
    'show_in_nav_menus' => false,
    'exclude_from_search' => true,
) , $singular = true);

function mk_edit_banner_builder_columns($columns) {
    $columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => __('Slider Item Title', 'mk_framework') ,
        "thumbnail" => 'Thumbnail',
        "date" => 'Date',
    );
    
    return $columns;
}
add_filter('manage_edit-banner_builder_columns', 'mk_edit_banner_builder_columns');

function mk_manage_banner_builder_columns($column) {
    global $post;
    
    if ($post->post_type == "banner_builder") {
        switch ($column) {
            case 'thumbnail':
                echo the_post_thumbnail('thumbnail');
                break;
        }
    }
}
add_action('manage_posts_custom_column', 'mk_manage_banner_builder_columns', 10, 2);

/*-----------------------------------------------------------------------------------*/

/* Register Edge Slider Custom Post type */

/*-----------------------------------------------------------------------------------*/

Mk_Register_Custom_Post_Type('edge', __('Edge', 'mk_framework'), $supports = array(
    'title',
    'page-attributes',
    'editor',
    'revisions'
) , $args = array(
    'menu_icon' => 'dashicons-image-flip-horizontal',
    'show_in_nav_menus' => false,
    'exclude_from_search' => true,
) , $singular = true, array(
    'name' => sprintf(_x('%s', 'post type general name', 'mk_framework') , 'Edge Slider') ,
    'singular_name' => sprintf(_x('%s', 'post type singular title', 'mk_framework') , 'Edge Slider') ,
    'menu_name' => sprintf(__('%s', 'artbees') , 'Edge Slider') ,
    'all_items' => sprintf(__('All %s', 'mk_framework') , 'Slides') ,
    'add_new' => sprintf(_x('Add New', '%s', 'mk_framework') , 'Edge Slide') ,
    'add_new_item' => sprintf(__('Add New %s', 'mk_framework') , 'Edge Slide') ,
    'edit_item' => sprintf(__('Edit %s', 'mk_framework') , 'Edge Slide') ,
    'new_item' => sprintf(__('New %s', 'mk_framework') , 'Edge Slide') ,
    'view_item' => sprintf(__('View %s', 'mk_framework') , 'Edge Slide') ,
    'items_archive' => sprintf(__('%s Archive', 'mk_framework') , 'Edge Slider') ,
    'search_items' => sprintf(__('Search %s', 'mk_framework') , 'Edge Slides') ,
    'not_found' => sprintf(__('No %s found', 'mk_framework') , 'Edge Slides') ,
    'not_found_in_trash' => sprintf(__('No %s found in trash', 'mk_framework') , 'Edge Slides') ,
    'parent_item_colon' => sprintf(__('%s Parent', 'mk_framework') , 'Edge Slide') ,
));

function mk_edit_edge_slider_columns($columns) {
    unset($columns['date']);
    unset($columns['comments']);
    unset($columns['author']);

    $edge_slider_columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => __('Title', 'mk_framework') ,
        "caption_title" => 'Caption Title',
        "caption_desc" => 'Caption Description',
        "slider_type" => 'Slider Type',
        "thumbnail" => 'Thumbnail',
        "date" => 'Date',
    );
    
    return array_merge($columns, $edge_slider_columns);
}
add_filter('manage_edge_posts_columns', 'mk_edit_edge_slider_columns');

function mk_get_image_id_by_url($image_url) {
    global $wpdb;
    $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url));
    if (isset($attachment[0])) return $attachment[0];
}

function mk_manage_edge_columns($column) {
    global $post;
    
    if ($post->post_type == "edge") {
        $slider_type = get_post_meta($post->ID, '_edge_type', true);
        switch ($column) {
            case "slider_type":
                echo ucwords($slider_type);
                break;

            case "caption_title":
                echo get_post_meta($post->ID, '_title', true);
                break;

            case "caption_desc":
                echo get_post_meta($post->ID, '_description', true);
                break;

            case 'thumbnail':
                if ($slider_type == 'image') {
                    $url = get_post_meta($post->ID, '_slide_image', true);
                } 
                else {
                    $url = get_post_meta($post->ID, '_video_preview', true);
                }
                if (!empty($url)) {
                    $image_id = mk_get_image_id_by_url($url);
                    if (!empty($image_id)) {
                        $image = wp_get_attachment_image_src($image_id, 'thumbnail');
                        if (!empty($image[0])) {
                            echo '<img width="80" height="80" src="' . $image[0] . '" />';
                        }
                    }
                }
                break;
        }
    }
}
add_action('manage_posts_custom_column', 'mk_manage_edge_columns', 10, 2);

/*-----------------------------------------------------------------------------------*/

/* Register Employee Custom Post type */

/*-----------------------------------------------------------------------------------*/

Mk_Register_Custom_Post_Type('employees', __('Employees', 'mk_framework'), $supports = array(
    'title',
    'editor',
    'thumbnail',
    'page-attributes',
    'revisions'
) , $args = array(
    'menu_icon' => 'dashicons-groups',
    'has_archive' => true,
    'rewrite' => array(
        'slug' => _x('team', 'URL slug', 'mk_framework') ,
        'with_front' => FALSE
    ) ,
), $singular = false);

Mk_Register_custom_taxonomy('employees_category', __('Employees Category', 'mk_framework'), 'employees', array(
        'rewrite' => array(
            'slug' => _x('employees_category', 'URL slug', 'mk_framework') ,
            'with_front' => FALSE
        )
));


function mk_edit_employees_columns($columns) {
    $employees_columns = array(
        "cb" => "<input type=\"checkbox\" />",
        'title' => __('Employee Name', 'mk_framework') ,
        "position" => __('Position', 'mk_framework') ,
        "desc" => __('Description', 'mk_framework') ,
        "thumbnail" => __('Thumbnail', 'mk_framework') ,
    );
    
    return array_merge($columns, $employees_columns);
}
add_filter('manage_employees_posts_columns', 'mk_edit_employees_columns');

function mk_manage_employees_columns($column) {
    global $post;
    
    if ($post->post_type == "employees") {
        switch ($column) {
            case "position":
                echo get_post_meta($post->ID, '_position', true);
                break;

            case "desc":
                echo get_post_meta($post->ID, '_desc', true);
                break;

            case 'thumbnail':
                echo the_post_thumbnail('thumbnail');
                break;
        }
    }
}
add_action('manage_posts_custom_column', 'mk_manage_employees_columns', 10, 2);

/*-----------------------------------------------------------------------------------*/

/* Register FAQ Custom Post type */

/*-----------------------------------------------------------------------------------*/

Mk_Register_Custom_Post_Type('faq', __('Faq', 'mk_framework'), $supports = array(
    'title',
    'editor',
    'page-attributes',
    'revisions'
) , $args = array(
    'menu_icon' => 'dashicons-editor-help',
    'has_archive' => true,
    'rewrite' => array(
        'slug' => 'faq'
    ) ,
) , $singular = true);

/**
 * Registers Faq taxonomy
 */
Mk_Register_custom_taxonomy('faq_category', __('Faq Category', 'mk_framework'), 'faq');


/*-----------------------------------------------------------------------------------*/

/* Register News Custom Post type */

/*-----------------------------------------------------------------------------------*/
$news_slug = isset($mk_options['news_slug']) ? $mk_options['news_slug'] : 'news-posts';
Mk_Register_Custom_Post_Type('news', __('News', 'mk_framework'), $supports = array(
    'title',
    'editor',
    'excerpt',
    'thumbnail',
    'page-attributes',
    'revisions'
) , $args = array(
    'menu_icon' => 'dashicons-welcome-widgets-menus',
    'has_archive' => true,
    'rewrite' => array(
        'slug' => _x($news_slug, 'URL slug', 'mk_framework') ,
        'with_front' => FALSE
    ) ,
) , $singular = true);

/**
 * Registers News taxonomy
 */
Mk_Register_custom_taxonomy('news_category', __('News Category', 'mk_framework'), 'news');

function mk_edit_news_columns($columns) {
    unset($columns['date']);
    unset($columns['comments']);
    unset($columns['author']);

    $news_columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => _x('News Name', 'column name', 'mk_framework') ,
        "news_categories" => __('Categories', 'mk_framework') ,
        "description" => __('Description', 'mk_framework') ,
        "thumbnail" => __('Thumbnail', 'mk_framework') ,
        "date" => 'Date',
    );
    
    return array_merge($columns, $news_columns);
}
add_filter('manage_news_posts_columns', 'mk_edit_news_columns');

function mk_manage_news_columns($column) {
    global $post;
    
    if ($post->post_type == "news") {
        switch ($column) {
            case "description":
                the_excerpt();
                break;

            case "news_categories":
                $terms = get_the_terms($post->ID, 'news_category');
                
                if (!empty($terms)) {
                    foreach ($terms as $t) $output[] = "<a href='edit.php?post_type=news&news_tag=$t->slug'> " . esc_html(sanitize_term_field('name', $t->name, $t->term_id, 'news_tag', 'display')) . "</a>";
                    $output = implode(', ', $output);
                } 
                else {
                    $t = get_taxonomy('news_category');
                    $output = "No $t->label";
                }
                
                echo $output;
                break;

            case 'thumbnail':
                echo the_post_thumbnail('thumbnail');
                break;
            }
    }
}
add_action('manage_posts_custom_column', 'mk_manage_news_columns', 10, 2);

/*-----------------------------------------------------------------------------------*/

/* Register Portfolio Custom Post type */

/*-----------------------------------------------------------------------------------*/

$portfolio_slug = isset($mk_options['portfolio_slug']) ? $mk_options['portfolio_slug'] : 'portfolio-posts';
Mk_Register_Custom_Post_Type('portfolio', __('Portfolio', 'mk_framework'), $supports = array(
    'title',
    'editor',
    'author',
    'excerpt',
    'thumbnail',
    'comments',
    'page-attributes',
    'revisions'
) , $args = array(
    'menu_icon' => 'dashicons-portfolio',
    'has_archive' => true,
    'rewrite' => array(
        'slug' => _x($portfolio_slug, 'URL slug', 'mk_framework') ,
        'with_front' => FALSE
    ) ,
));

/**
 * Registers Portfolio taxonomy
 */
$portfolio_cat_slug = isset($mk_options['portfolio_cat_slug']) ? $mk_options['portfolio_cat_slug'] : 'portfolio_category';

Mk_Register_custom_taxonomy('portfolio_category', __('Portfolio Category', 'mk_framework'), 'portfolio', array(
        'rewrite' => array(
            'slug' => _x($portfolio_cat_slug, 'URL slug', 'mk_framework') ,
            'with_front' => FALSE
        )
    ));


function mk_edit_portfolio_columns($columns) {
    unset($columns['date']);
    unset($columns['comments']);
    unset($columns['author']);

    $portfolio_columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => _x('Portfolio Name', 'column name', 'mk_framework') ,
        "portfolio_categories" => __('Categories', 'mk_framework') ,
        "thumbnail" => __('Thumbnail', 'mk_framework') ,
        "date" => 'Date',
    );
    
    return array_merge($columns, $portfolio_columns);
}
add_filter('manage_portfolio_posts_columns', 'mk_edit_portfolio_columns');

function mk_manage_portfolio_columns($column) {
    global $post;
    
    if ($post->post_type == "portfolio") {
        switch ($column) {
            case "portfolio_categories":
                $terms = get_the_terms($post->ID, 'portfolio_category');
                
                if (!empty($terms)) {
                    foreach ($terms as $t) $output[] = "<a href='edit.php?post_type=portfolio&portfolio_tag=$t->slug'> " . esc_html(sanitize_term_field('name', $t->name, $t->term_id, 'portfolio_tag', 'display')) . "</a>";
                    $output = implode(', ', $output);
                } 
                else {
                    $t = get_taxonomy('portfolio_category');
                    $output = "No $t->label";
                }
                
                echo $output;
                break;

            case 'thumbnail':
                echo the_post_thumbnail('thumbnail');
                break;
            }
    }
}
add_action('manage_posts_custom_column', 'mk_manage_portfolio_columns', 10, 2);

/*-----------------------------------------------------------------------------------*/

/* Register Pricing Table Custom Post type */

/*-----------------------------------------------------------------------------------*/

Mk_Register_Custom_Post_Type('pricing', __('Pricing', 'mk_framework'), $supports = array(
    'title',
    'thumbnail',
    'page-attributes',
    'revisions'
) , $args = array(
    'menu_icon' => 'dashicons-tag',
    'show_in_nav_menus' => false,
    'exclude_from_search' => true,
) , $singular = true, array(
    'name' => sprintf(_x('%s', 'post type general name', 'mk_framework') , 'Pricing Table') ,
    'singular_name' => sprintf(_x('%s', 'post type singular title', 'mk_framework') , 'Pricing Table') ,
    'menu_name' => sprintf(__('%s', 'artbees') , 'Pricing Table') ,
    'all_items' => sprintf(__('All %s', 'mk_framework') , 'Pricing Tables') ,
    'add_new' => sprintf(_x('Add New', '%s', 'mk_framework') , 'Pricing Table') ,
    'add_new_item' => sprintf(__('Add New %s', 'mk_framework') , 'Pricing Table') ,
    'edit_item' => sprintf(__('Edit %s', 'mk_framework') , 'Pricing Table') ,
    'new_item' => sprintf(__('New %s', 'mk_framework') , 'Pricing Table') ,
    'view_item' => sprintf(__('View %s', 'mk_framework') , 'Pricing Table') ,
    'items_archive' => sprintf(__('%s Archive', 'mk_framework') , 'Pricing Tables') ,
    'search_items' => sprintf(__('Search %s', 'mk_framework') , 'Pricing Tables') ,
    'not_found' => sprintf(__('No %s found', 'mk_framework') , 'Pricing Tables') ,
    'not_found_in_trash' => sprintf(__('No %s found in trash', 'mk_framework') , 'Pricing Tables') ,
    'parent_item_colon' => sprintf(__('%s Parent', 'mk_framework') , 'Pricing Table') ,
));

/*-----------------------------------------------------------------------------------*/

/* Register FlexSlider Custom Post type */

/*-----------------------------------------------------------------------------------*/

Mk_Register_Custom_Post_Type('slideshow', __('Slideshow', 'mk_framework'), $supports = array(
    'title',
    'page-attributes',
    'thumbnail'
) , $args = array(
    'menu_icon' => 'dashicons-format-gallery',
    'show_in_nav_menus' => false,
    'exclude_from_search' => true,
) , $singular = true, array(
    'name' => sprintf(_x('%s', 'post type general name', 'mk_framework') , 'FlexSlider') ,
    'singular_name' => sprintf(_x('%s', 'post type singular title', 'mk_framework') , 'FlexSlide') ,
    'menu_name' => sprintf(__('%s', 'artbees') , 'FlexSlider') ,
    'all_items' => sprintf(__('All %s', 'mk_framework') , 'FlexSliders') ,
    'add_new' => sprintf(_x('Add New', '%s', 'mk_framework') , 'FlexSlide') ,
    'add_new_item' => sprintf(__('Add New %s', 'mk_framework') , 'FlexSlide') ,
    'edit_item' => sprintf(__('Edit %s', 'mk_framework') , 'FlexSlider') ,
    'new_item' => sprintf(__('New %s', 'mk_framework') , 'FlexSlider') ,
    'view_item' => sprintf(__('View %s', 'mk_framework') , 'FlexSlider') ,
    'items_archive' => sprintf(__('%s Archive', 'mk_framework') , 'FlexSlides') ,
    'search_items' => sprintf(__('Search %s', 'mk_framework') , 'FlexSlides') ,
    'not_found' => sprintf(__('No %s found', 'mk_framework') , 'FlexSlides') ,
    'not_found_in_trash' => sprintf(__('No %s found in trash', 'mk_framework') , 'FlexSlides') ,
    'parent_item_colon' => sprintf(__('%s Parent', 'mk_framework') , 'FlexSlide') ,
));

function mk_edit_slideshow_columns($columns) {
    $columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => __('Slider Item Title', 'mk_framework') ,
        "thumbnail" => 'Thumbnail',
        "date" => 'Date',
    );
    
    return $columns;
}
add_filter('manage_edit-slideshow_columns', 'mk_edit_slideshow_columns');

function mk_manage_slideshow_columns($column) {
    global $post;
    
    if ($post->post_type == "slideshow") {
        switch ($column) {
            case 'thumbnail':
                echo the_post_thumbnail('thumbnail');
                break;
        }
    }
}
add_action('manage_posts_custom_column', 'mk_manage_slideshow_columns', 10, 2);

/*-----------------------------------------------------------------------------------*/

/* Register Tab Slider Custom Post type */

/*-----------------------------------------------------------------------------------*/

Mk_Register_Custom_Post_Type('tab_slider', __('Tab Slider', 'mk_framework'), $supports = array(
    'title',
    'thumbnail',
    'page-attributes',
    'revisions'
) , $args = array(
    'menu_icon' => 'dashicons-slides',
    'exclude_from_search' => true,
) , $singular = true);


/*-----------------------------------------------------------------------------------*/

/* Register Timeline Custom Post type */

/*-----------------------------------------------------------------------------------*/

/*Mk_Register_Custom_Post_Type('timeline', $supports = array(
    'title',
    'thumbnail',
    'editor',
    'page-attributes',
    'revisions'
) , $args = array(
    'menu_icon' => 'dashicons-slides',
    'exclude_from_search' => true,
) , $singular = true);*/

/*-----------------------------------------------------------------------------------*/

/* Register Testimonials Custom Post type */

/*-----------------------------------------------------------------------------------*/

Mk_Register_Custom_Post_Type('testimonial', __('Testimonial', 'mk_framework'), $supports = array(
    'title',
    'thumbnail',
    'page-attributes',
    'revisions'
) , $args = array(
    'menu_icon' => 'dashicons-exerpt-view',
    'exclude_from_search' => true,
) , $singular = true);

Mk_Register_custom_taxonomy('testimonial_category', __('Testimonial Category', 'mk_framework'), 'testimonial', array(
        'rewrite' => array(
            'slug' => _x('testimonial_category', 'URL slug', 'mk_framework') ,
            'with_front' => FALSE
        )
));



function mk_edit_testimonial_columns($columns) {
    unset($columns['date']);
    unset($columns['comments']);
    unset($columns['author']);

    $testimonail_columns = array(
        "cb" => "<input type=\"checkbox\" />",
        'title' => __('Testimonial Name', 'mk_framework') ,
        "quote_author" => __('Author', 'mk_framework') ,
        "desc" => __('Description', 'mk_framework') ,
        "thumbnail" => __('Thumbnail', 'mk_framework') ,
    );
    
    return array_merge($columns, $testimonail_columns);
}
add_filter('manage_testimonial_posts_columns', 'mk_edit_testimonial_columns');

function mk_manage_testimonials_columns($column) {
    global $post;
    
    if ($post->post_type == "testimonial") {
        switch ($column) {
            case "quote_author":
                echo get_post_meta($post->ID, '_author', true);
                break;

            case "desc":
                echo get_post_meta($post->ID, '_desc', true);
                break;

            case 'thumbnail':
                echo the_post_thumbnail('thumbnail');
                break;
        }
    }
}
add_action('manage_posts_custom_column', 'mk_manage_testimonials_columns', 10, 2);




/*-----------------------------------------------------------------------------------*/

/* Register Gallery Custom Post type */

/*-----------------------------------------------------------------------------------*/

Mk_Register_Custom_Post_Type('photo_album', __('Photo Album', 'mk_framework'), $supports = array(
    'title',
    'thumbnail',
    'page-attributes',
    'revisions'
) , $args = array(
    'menu_icon' => 'dashicons-format-gallery',
    'exclude_from_search' => true,
    'has_archive' => true,
    'rewrite' => array(
        'slug' => 'albums'
    ) ,
) , $singular = true);

/**
 * Registers Gallery taxonomy
 */
Mk_Register_custom_taxonomy('photo_album_category', __('Photo Album Category', 'mk_framework'), 'photo_album');

function mk_edit_photo_album_columns($columns) {
    unset($columns['date']);
    unset($columns['comments']);
    unset($columns['author']);

    $photo_album_columns = array(
        "cb" => "<input type=\"checkbox\" />",
        'title' => _x('Album Name', 'column name', 'mk_framework') ,
        "thumbnail" => __('Cover Photo', 'mk_framework') ,
        "images" => __('Photos', 'mk_framework') ,
        "date" => 'Date',
    );
    
    return array_merge($columns, $photo_album_columns);
}
add_filter('manage_photo_album_posts_columns', 'mk_edit_photo_album_columns');

function mk_manage_photo_album_columns($column) {
    global $post;
    
    if ($post->post_type == "photo_album") {
        switch ($column) {

            case "images":
                $images = explode(',', get_post_meta($post->ID, '_gallery_images', true));

                foreach ($images as $image) {
                    if($image != '') {
                    $image_src_array = wp_get_attachment_image_src( $image, 'thumbnail', true );
                        echo '<span class="media-icon image-icon"><img width="100" height="100" src="'.$image_src_array[0].'" class="attachment-60x60" alt=""></span>';
                    }
                }
                break;

                case 'thumbnail':
                    echo the_post_thumbnail('thumbnail');
                break;


        }
    }
}
add_action('manage_posts_custom_column', 'mk_manage_photo_album_columns', 10, 2);
