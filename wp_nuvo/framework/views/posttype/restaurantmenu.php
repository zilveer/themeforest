<?php
add_action('init', 'cs_add_post_type_menu');

function cs_add_post_type_menu()
{
    $labels = array(
        'name' => esc_html__('Restaurant Menu', 'wp_nuvo'),
        'singular_name' => esc_html__('Menu', 'wp_nuvo'),
        'add_new' => esc_html__('Add New', 'wp_nuvo'),
        'add_new_item' => esc_html__('Add New Menu', 'wp_nuvo'),
        'edit_item' => esc_html__('Edit Menu', 'wp_nuvo'),
        'new_item' => esc_html__('New Menu', 'wp_nuvo'),
        'all_items' => esc_html__('Menu', 'wp_nuvo'),
        'view_item' => esc_html__('View Menu', 'wp_nuvo'),
        'search_items' => esc_html__('Search Menu', 'wp_nuvo'),
        'not_found' => esc_html__('No menu found', 'wp_nuvo'),
        'not_found_in_trash' => esc_html__('No menu found in Trash', 'wp_nuvo'),
        'menu_name' => esc_html__('Restaurant Menu', 'wp_nuvo')
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array(
            'slug' => 'restaurantmenu'
        ),
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 9,
        'menu_icon' => 'dashicons-welcome-write-blog',
        'supports' => array(
            'title',
            'editor',
            'author',
            'thumbnail',
            'excerpt',
            'comments'
        )
    );
    register_post_type('restaurantmenu', $args);
    register_taxonomy('restaurantmenu_category', 'restaurantmenu', array(
        'hierarchical' => true,
        'label' => esc_html__('Menu Categories', 'wp_nuvo'),
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true
    ));

    $labels = array(
        'name' => esc_html__('Menu Tags', 'wp_nuvo'),
        'singular_name' => esc_html__('Tag', 'wp_nuvo'),
        'search_items' => esc_html__('Search Tags', 'wp_nuvo'),
        'popular_items' => esc_html__('Popular Tags', 'wp_nuvo'),
        'all_items' => esc_html__('All Tags', 'wp_nuvo'),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => esc_html__('Edit Tag', 'wp_nuvo'),
        'update_item' => esc_html__('Update Tag', 'wp_nuvo'),
        'add_new_item' => esc_html__('Add New Tag', 'wp_nuvo'),
        'new_item_name' => esc_html__('New Tag Name', 'wp_nuvo'),
        'separate_items_with_commas' => esc_html__('Separate tags with commas', 'wp_nuvo'),
        'add_or_remove_items' => esc_html__('Add or remove tags', 'wp_nuvo'),
        'choose_from_most_used' => esc_html__('Choose from the most used tags', 'wp_nuvo'),
        'menu_name' => esc_html__('Menu Tags', 'wp_nuvo')
    );

    register_taxonomy('menu_tag', 'restaurantmenu', array(
        'hierarchical' => false,
        'labels' => $labels,
        'show_ui' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => array(
            'slug' => 'tag'
        )
    ));
}
/* custom filter */
add_action('restrict_manage_posts', 'restrict_listings_by_restaurantmenu');

function restrict_listings_by_restaurantmenu()
{
    global $typenow;
    global $wp_query;
    if ($typenow == 'restaurantmenu') {
        $taxonomy = 'restaurantmenu_category';
        $term = isset($wp_query->query['restaurantmenu_category']) ? $wp_query->query['restaurantmenu_category'] : '';
        $business_taxonomy = get_taxonomy($taxonomy);
        wp_dropdown_categories(array(
            'show_option_all' => esc_html__("Show All", 'wp_nuvo'),
            'taxonomy' => $taxonomy,
            'name' => 'restaurantmenu_category',
            'orderby' => 'name',
            'selected' => $term,
            'hierarchical' => true,
            'depth' => 3,
            'show_count' => true, // Show # listings in parens
            'hide_empty' => true // Don't show businesses w/o listings
        ));
    }
}
add_filter('parse_query', 'convert_restaurantmenu_id_to_taxonomy_term_in_query');

function convert_restaurantmenu_id_to_taxonomy_term_in_query($query)
{
    global $pagenow;
    $qv = &$query->query_vars;
    if ($pagenow == 'edit.php' && isset($qv['restaurantmenu_category']) && is_numeric($qv['restaurantmenu_category'])) {
        $term = get_term_by('id', $qv['restaurantmenu_category'], 'restaurantmenu_category');
        $qv['restaurantmenu_category'] = ($term ? $term->slug : '');
    }
}
/* custom collumn */
add_filter('manage_edit-restaurantmenu_columns', 'set_custom_restaurantmenu_columns');
add_action('manage_restaurantmenu_posts_custom_column', 'custom_restaurantmenu_column', 10, 2);

function set_custom_restaurantmenu_columns($columns)
{
    $columns['price'] = esc_html__('Price', 'wp_nuvo');
    $columns['special'] = esc_html__('Chefs Special', 'wp_nuvo');

    return $columns;
}

function custom_restaurantmenu_column($column, $post_id)
{
    switch ($column) {
        case 'price':
            echo get_post_meta($post_id, 'cs_menu_price', true).get_post_meta($post_id, 'cs_price_unit', true);
            break;
        case 'special':
            if(get_post_meta($post_id, 'cs_menu_special', true) == 'yes'){
                echo '<i class="dashicons dashicons-awards"></i>';
            }
            break;
    }
}