<?php
if (!class_exists('Custom_WooCommerce_Widget_Cart')) {
    class Custom_WooCommerce_Widget_Cart extends WC_Widget_Cart
    {

        public function widget($args, $instance)
        {
            extract($args);
            $title = apply_filters('widget_title', empty($instance['title']) ? esc_html__('Cart', 'ct_theme') : $instance['title'], $instance, $this->id_base);
            $hide_if_empty = empty($instance['hide_if_empty']) ? 0 : 1;

            //output raw html

            echo $before_widget;//no escape required

            if ($title)
                echo $before_title . $title . $after_title;//no escape required

            if ($hide_if_empty)
                echo '<div class="hide_cart_widget_if_empty">';

            // Insert cart widget placeholder - code in woocommerce.js will update this on page load
            echo '<div class="widget_shopping_cart_content"></div>';

            if ($hide_if_empty)
                echo '</div>';

            echo $after_widget;//no escape required

        }
    }

    new Custom_WooCommerce_Widget_Cart();
}

