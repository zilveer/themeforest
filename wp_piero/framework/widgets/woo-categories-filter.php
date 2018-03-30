<?php

add_action('widgets_init', 'register_woo_categories_filter_widget');

function register_woo_categories_filter_widget() {
    register_widget('Woo_Categories_Filter_Widget');
}

class Woo_Categories_Filter_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'woo_categories_filter', // Base ID
            __('Woo Categories Filte', THEMENAME), // Name
            array('description' => __('Search Product by Categories', THEMENAME),) // Args
        );
    }
    
    function widget($args, $instance) {
        global $wpdb, $wp_query, $wp;
        
        if ( '' == get_option( 'permalink_structure' ) ) {
            $form_action = remove_query_arg( array( 'page', 'paged' ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
        } else {
            $form_action = preg_replace( '%\/page/[0-9]+%', '', home_url( $wp->request ) );
        }
        
        
        $args = array(
            'taxonomy'     => 'product_cat',
            'orderby'      => 'name',
            'show_count'   => 1,
            'pad_counts'   => 0,
            'hierarchical' => 1,
            'title_li'     => '',
            'hide_empty'   => 0
        );
        
        $all_categories = get_categories($args);
        
        $category_name = $wp_query->query_vars['product_cat'];
        
        $category_slug = '';
        
        if( $category_name ) {
            $category_object = get_term_by('name', $category_name, 'product_cat');
            $category_slug = $category_object->slug;
        }
             
        ?>
        <form method="get" action="<?php echo esc_url( $form_action ); ?>">
            <select name="product_cat" onchange="this.form.submit()">
                <?php foreach ($all_categories as $cat): ?>
                <option value="<?php echo $cat->slug; ?>" <?php echo ($category_slug == $cat->slug) ? 'selected="selected"' : '' ; ?>><?php echo $cat->name; ?></option>
                <?php endforeach; ?>
            </select>
        </form>
        <?php
    }
    
    function update( $new_instance, $old_instance ) {
        
    }
    
    function form( $instance ) {
        
    }
}