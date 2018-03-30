<?php
get_template_part('framework/widgets/tweets');
get_template_part('framework/widgets/news_tabs');
get_template_part('framework/widgets/recent_post_v1');
get_template_part('framework/widgets/recent_post_v2');
get_template_part('framework/widgets/categories_list');
get_template_part('framework/widgets/restaurantmenu');
get_template_part('framework/widgets/social');
get_template_part('framework/widgets/newsletter');
get_template_part('framework/widgets/cart_search');
get_template_part('framework/widgets/facebook');
get_template_part('framework/widgets/instagram');
get_template_part('framework/widgets/recent_comment');

if(class_exists('WooCommerce')){
    get_template_part('framework/widgets/woo-categories-filter');
    get_template_part('framework/widgets/woo-search');
}