<?php  if ( ! defined('ET_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! Mega Search Widget
// **********************************************************************// 
class Etheme_Search_Widget extends WP_Widget {

    function Etheme_Search_Widget() {
        $widget_ops = array('classname' => 'etheme_widget_search', 'description' => __( "AJAX Search form for Products, Posts, Portfolio and Pages", ET_DOMAIN) );
        parent::__construct('etheme-search', '8theme - '.__('Search From', ET_DOMAIN), $widget_ops);
        $this->alt_option_name = 'etheme_widget_search';
    }

    function widget($args, $instance) {
        extract($args);

        $count = (int) $instance['count'];
        $products = (bool) $instance['products'];
        $images = (bool) $instance['images'];
        $posts = (bool) $instance['posts'];
        $portfolio = (bool) $instance['portfolio'];
        $pages = (bool) $instance['pages'];
        echo $before_widget;
        echo etheme_search(array(
			'products' => $products,
			'posts' => $posts,
			'portfolio' => $portfolio,
			'pages' => $pages,
			'images' => $images,
			'count' => $count
        ));
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['count'] = (int) $new_instance['count'];
        $instance['products'] = (bool) $new_instance['products'];
        $instance['images'] = (bool) $new_instance['images'];
        $instance['posts'] = (bool) $new_instance['posts'];
        $instance['portfolio'] = (bool) $new_instance['portfolio'];
        $instance['pages'] = (bool) $new_instance['pages'];

        return $instance;
    }

    function form( $instance ) {
        $products = isset($instance['products']) ? (bool) $instance['products'] : false;
        $images = isset($instance['images']) ? (bool) $instance['images'] : false;
        $posts = isset($instance['posts']) ? (bool) $instance['posts'] : false;
        $portfolio = isset($instance['portfolio']) ? (bool) $instance['portfolio'] : false;
        $pages = isset($instance['pages']) ? (bool) $instance['pages'] : false;
        $count = isset($instance['count']) ? $instance['count'] : '';

?>

        <?php etheme_widget_input_checkbox(__('Search for products', ET_DOMAIN), $this->get_field_id('products'), $this->get_field_name('products'),checked($products, true, false), 1); ?>
        <?php etheme_widget_input_checkbox(__('Display images for products', ET_DOMAIN), $this->get_field_id('images'), $this->get_field_name('images'),checked($images, true, false), 1); ?>
        <?php etheme_widget_input_checkbox(__('Search for posts', ET_DOMAIN), $this->get_field_id('posts'), $this->get_field_name('posts'),checked($posts, true, false), 1); ?>
        <?php etheme_widget_input_checkbox(__('Search in portfolio', ET_DOMAIN), $this->get_field_id('portfolio'), $this->get_field_name('portfolio'),checked($portfolio, true, false), 1); ?>
        <?php etheme_widget_input_checkbox(__('Search for pages', ET_DOMAIN), $this->get_field_id('pages'), $this->get_field_name('pages'),checked($pages, true, false), 1); ?>
        
        <?php etheme_widget_input_text(__('Number of items from each section', ET_DOMAIN), $this->get_field_id('count'),$this->get_field_name('count'), $count); ?>

<?php
    }
}

