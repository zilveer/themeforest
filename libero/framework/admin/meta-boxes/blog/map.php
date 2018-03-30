<?php

$mkd_blog_categories = array();
$categories = get_categories();
foreach($categories as $category) {
    $mkd_blog_categories[$category->term_id] = $category->name;
}

$blog_meta_box = libero_mikado_add_meta_box(
    array(
        'scope' => array('page'),
        'title' => 'Blog',
        'name' => 'blog_meta'
    )
);

    libero_mikado_add_meta_box_field(
        array(
            'name'        => 'mkd_blog_category_meta',
            'type'        => 'selectblank',
            'label'       => 'Blog Category',
            'description' => 'Choose category of posts to display (leave empty to display all categories)',
            'parent'      => $blog_meta_box,
            'options'     => $mkd_blog_categories
        )
    );

    libero_mikado_add_meta_box_field(
        array(
            'name'        => 'mkd_show_posts_per_page_meta',
            'type'        => 'text',
            'label'       => 'Number of Posts',
            'description' => 'Enter the number of posts to display',
            'parent'      => $blog_meta_box,
            'options'     => $mkd_blog_categories,
            'args'        => array("col_width" => 3)
        )
    );

