<?php

$eltd_blog_categories = array();
$categories = get_categories();
foreach($categories as $category) {
    $eltd_blog_categories[$category->term_id] = $category->name;
}

$blog_meta_box = flow_elated_add_meta_box(
    array(
        'scope' => array('page'),
        'title' => 'Blog',
        'name' => 'blog_meta'
    )
);

    flow_elated_add_meta_box_field(
        array(
            'name'        => 'eltd_blog_category_meta',
            'type'        => 'selectblank',
            'label'       => 'Blog Category',
            'description' => 'Choose category of posts to display (leave empty to display all categories)',
            'parent'      => $blog_meta_box,
            'options'     => $eltd_blog_categories
        )
    );

    flow_elated_add_meta_box_field(
        array(
            'name'        => 'eltd_show_posts_per_page_meta',
            'type'        => 'text',
            'label'       => 'Number of Posts',
            'description' => 'Enter the number of posts to display',
            'parent'      => $blog_meta_box,
            'options'     => $eltd_blog_categories,
            'args'        => array("col_width" => 3)
        )
    );
	flow_elated_add_meta_box_field(
        array(
            'name'        => 'eltd_lists_pagination_meta',
            'type'        => 'selectblank',
            'label'       => 'Pagination type',
			'description' => 'Choose a pagination type for blog lists. Please note that the Expanding Tiles blog list only supports "load more" and "infinite scroll" pagination',
			'options'     => array(
				'standard'			=> 'Standard',
				'load-more'			=> 'Load More',
				'infinite-scroll' 	=> 'Infinite Scroll'
			),
            'parent'      => $blog_meta_box,
            'args'        => array("col_width" => 3)
        )
    );
	flow_elated_add_meta_box_field(
        array(
            'name'        => 'eltd_blog_slider_position_meta',
            'type'        => 'selectblank',
            'label'       => 'Slider Position',
			'description' => 'Choose slider position on blog list templates(except Blog List Expanding Tiles).',
			'default_value' => 'above_content_sidebar',
			'options'     => array(
				'above_content_sidebar'		=> 'Above Content and Sidebar',
				'above_content'			=> 'Above Content'
			),
            'parent'      => $blog_meta_box,
            'args'        => array("col_width" => 3)
        )
    );
	flow_elated_add_meta_box_field(
        array(
            'name'        => 'eltd_masonry_columns_meta',
            'type'        => 'selectblank',
            'label'       => 'Masonry Columns',
			'description' => 'Column number in Blog Masonry and Blog Masonry Full Width Template',
			'default_value' => '',
			'options'     => array(
				'two'	=> 'Two',
				'three'	=> 'Three',
				'four' 	=> 'Four'
			),
            'parent'      => $blog_meta_box,
            'args'        => array("col_width" => 3)
        )
    );
	
$post_meta_box = flow_elated_add_meta_box(
    array(
        'scope' => array('post'),
        'title' => 'Post Settings',
        'name' => 'post_meta'
    )
);
	flow_elated_add_meta_box_field(
        array(
            'name'        => 'eltd_featured_post_meta',
            'type'        => 'selectblank',
            'label'       => 'Set as Featured Post',
            'parent'      => $post_meta_box,
			'default_value' => 'no',
            'options'     => array(
				'yes'	=> 'Yes',
				'no'	=> 'No'
			),
			'args'        => array("col_width" => 3)
        )
    );
	flow_elated_add_meta_box_field(
        array(
            'name'        => 'eltd_post_image_size_meta',
            'type'        => 'selectblank',
            'label'       => 'Choose Image Size',
            'parent'      => $post_meta_box,
			'description' => 'Choose post image size for masonry blog lists.',
			'default_value' => '',
            'options'     => array(
				'portrait'	=> 'Portrait',
				'landscape'	=> 'Landscape',
				'square'	=> 'Square'
			),
			'args'        => array("col_width" => 3)
        )
    );
	

