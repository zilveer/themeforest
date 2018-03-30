<?php

// REMOVES THE SEARCH WIDGET COMPLETELY
function circulo_remove_searchbar_widget() {
    unregister_widget('WP_Widget_Search');
}

add_action('widgets_init','circulo_remove_searchbar_widget');