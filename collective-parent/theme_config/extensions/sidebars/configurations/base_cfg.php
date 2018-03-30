<?php
/**
 * Defined number of placeholders
 *
 * @since  Collective 1.0
 */
$cfg['max_placeholders'] = 1;
$cfg['select_options'] = array(
    'post_types' => array(
        'post' => array(
            'name' => 'Posts',
            'has_id' => TRUE,
            'has_templates' => FALSE,
            'default_number' => 1
        ),
        'page' => array(
            'name' => 'Pages',
            'has_id' => TRUE,
            'has_templates' => TRUE,
            'default_number' => 1,
            'templates' => array()
        )
    ),
    'categories' => array(
        'category' => array(
            'name' => 'Categories',
            'has_id' => TRUE,
            'has_templates' => FALSE,
            'default_number' => 1
        )
    ),
    'other' => array(
        'is_archive' => array(
            'name' => 'Archives',
            'has_id' => FALSE,
            'has_templates' => FALSE,
            'default_number' => 1
        ),
        
        'is_front_page' => array(
            'name' => 'Front Page',
            'has_id' => FALSE,
            'has_templates' => FALSE,
            'default_number' => 1
        ),
        'is_blogpage' => array(
            'name' => 'Blog Page',
            'has_id' => FALSE,
            'has_templates' => FALSE,
            'default_number' => 1
        ),
        'is_search' => array(
            'name' => 'Search Page',
            'has_id' => FALSE,
            'has_templates' => FALSE,
            'default_number' => 1
        ),
        'is_404' => array(
            'name' => '404 Error Page',
            'has_id' => FALSE,
            'has_templates' => FALSE,
            'default_number' => 1
        )
    )
);
#define number of placeholders for custom post types, defined manually
$cfg['post_types'] = array(
    'portfolio' => 1,
    'attachment' => 1,
    'service' => 1,
    'members' => 1
);
#define number of placeholders for custom taxonomies, defined manually
$cfg['taxonomies'] = array(
    'group' => 1,
    'services' => 1
);

$url = tf_config_extimage($this->ext->sidebars->_the_class_name, '');

$cfg['sidebar_positions_options'] =
        array(
            1 => array(
                'id' => 'sidebars_positions_1',
                'options' => array(
                    'full' => array($url . 'placeholder_1/full.png', 'No sidebar on the page'),
                    'left' => array($url . 'placeholder_1/left.png', 'Align to the left'),
                    'right' => array($url . 'placeholder_1/right.png', 'Align to the right')
                )
            )
);

$cfg['sidebar_disabled_types'] = array();

$cfg['sidebars_colors'] = array(1 => 'blue');
