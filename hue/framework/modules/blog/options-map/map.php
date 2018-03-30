<?php

if(!function_exists('hue_mikado_blog_options_map')) {

    function hue_mikado_blog_options_map() {

        hue_mikado_add_admin_page(
            array(
                'slug'  => '_blog_page',
                'title' => 'Blog',
                'icon'  => 'icon_book_alt'
            )
        );

        /**
         * Blog Lists
         */

        $custom_sidebars = hue_mikado_get_custom_sidebars();

        $panel_blog_lists = hue_mikado_add_admin_panel(
            array(
                'page'  => '_blog_page',
                'name'  => 'panel_blog_lists',
                'title' => esc_html__('Blog Lists', 'hue')
            )
        );

        hue_mikado_add_admin_field(array(
            'name'          => 'blog_list_type',
            'type'          => 'select',
            'label'         => esc_html__('Blog Layout for Archive Pages', 'hue'),
            'description'   => esc_html__('Choose a default blog layout', 'hue'),
            'default_value' => 'standard',
            'parent'        => $panel_blog_lists,
            'options'       => array(
                'standard'           => esc_html__(' Blog: Standard', 'hue'),
                'simple'             => esc_html__('Blog: Simple', 'hue'),
                'masonry'            => esc_html__('Blog: Masonry', 'hue'),
                'masonry-full-width' => esc_html__('Blog: Masonry Full Width', 'hue'),
                'masonry-no-image'   => esc_html__('Blog: Masonry No Image', 'hue'),
                'masonry-simple'     => esc_html__('Blog: Masonry Simple', 'hue'),
            )
        ));

        hue_mikado_add_admin_field(array(
            'name'        => 'archive_sidebar_layout',
            'type'        => 'select',
            'label'       => esc_html__('Archive and Category Sidebar', 'hue'),
            'description' => esc_html__('Choose a sidebar layout for archived Blog Post Lists and Category Blog Lists', 'hue'),
            'parent'      => $panel_blog_lists,
            'options'     => array(
                'default'          => esc_html__('No Sidebar', 'hue'),
                'sidebar-33-right' => esc_html__('Sidebar 1/3 Right', 'hue'),
                'sidebar-25-right' => esc_html__('Sidebar 1/4 Right', 'hue'),
                'sidebar-33-left'  => esc_html__('Sidebar 1/3 Left', 'hue'),
                'sidebar-25-left'  => esc_html__('Sidebar 1/4 Left', 'hue'),
            )
        ));


        if(count($custom_sidebars) > 0) {
            hue_mikado_add_admin_field(array(
                'name'        => 'blog_custom_sidebar',
                'type'        => 'selectblank',
                'label'       => esc_html__('Sidebar to Display', 'hue'),
                'description' => esc_html__('Choose a sidebar to display on Blog Post Lists and Category Blog Lists. Default sidebar is "Sidebar Page"', 'hue'),
                'parent'      => $panel_blog_lists,
                'options'     => hue_mikado_get_custom_sidebars()
            ));
        }

        hue_mikado_add_admin_field(array(
            'type'          => 'color',
            'name'          => 'blog_archive_background_color',
            'default_value' => '#fafafa',
            'label'         => esc_html__('Background color for Archive pages', 'hue'),
            'description'   => esc_html__('Choose background color for blog archive pages', 'hue'),
            'parent'        => $panel_blog_lists
        ));

        hue_mikado_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'pagination',
                'default_value' => 'yes',
                'label'         => esc_html__('Pagination', 'hue'),
                'parent'        => $panel_blog_lists,
                'description'   => esc_html__('Enabling this option will display pagination links on bottom of Blog Post List', 'hue'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_mkd_pagination_container'
                )
            )
        );

        $pagination_container = hue_mikado_add_admin_container(
            array(
                'name'            => 'mkd_pagination_container',
                'hidden_property' => 'pagination',
                'hidden_value'    => 'no',
                'parent'          => $panel_blog_lists,
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $pagination_container,
                'type'          => 'text',
                'name'          => 'blog_page_range',
                'default_value' => '',
                'label'         => esc_html__('Pagination Range limit', 'hue'),
                'description'   => esc_html__('Enter a number that will limit pagination to a certain range of links', 'hue'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        hue_mikado_add_admin_field(array(
            'name'        => 'masonry_pagination',
            'type'        => 'select',
            'label'       => esc_html__('Pagination on Masonry', 'hue'),
            'description' => esc_html__('Choose a pagination style for Masonry Blog List', 'hue'),
            'parent'      => $pagination_container,
            'options'     => array(
                'no-pagination'   => esc_html__('No Pagination', 'hue'),
                'standard'        => esc_html__('Standard', 'hue'),
                'load-more'       => esc_html__('Load More', 'hue'),
                'infinite-scroll' => esc_html__('Infinite Scroll', 'hue')
            ),

        ));
        hue_mikado_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'enable_load_more_pag',
                'default_value' => 'no',
                'label'         => esc_html__('Load More Pagination on Other Lists', 'hue'),
                'parent'        => $pagination_container,
                'description'   => esc_html__('Enable Load More Pagination on other lists', 'hue'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'masonry_filter',
                'default_value' => 'no',
                'label'         => esc_html__('Masonry Filter', 'hue'),
                'parent'        => $panel_blog_lists,
                'description'   => esc_html__('Enabling this option will display category filter on Masonry and Masonry Full Width Templates', 'hue'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_mkd_blog_filter_container'
                )
            )
        );

        $blog_filter_container = hue_mikado_add_admin_container(
            array(
                'name'            => 'mkd_blog_filter_container',
                'hidden_property' => 'masonry_filter',
                'hidden_value'    => 'no',
                'parent'          => $panel_blog_lists,
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $blog_filter_container,
                'type'          => 'text',
                'name'          => 'blog_filter_margin',
                'default_value' => '0',
                'label'         => esc_html__('Masonry filter margin', 'hue'),
                'description'   => esc_html__('Insert margin in format: 0px 0px 1px 0px', 'hue'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $blog_filter_container,
                'type'          => 'text',
                'name'          => 'blog_filter_padding',
                'default_value' => '0',
                'label'         => esc_html__('Masonry filter padding', 'hue'),
                'description'   => esc_html__('Insert padding in format: 0px 0px 1px 0px', 'hue'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        hue_mikado_add_admin_field(array(
            'name'          => 'blog_filter_position',
            'type'          => 'select',
            'label'         => esc_html__('Masonry filter position', 'hue'),
            'description'   => esc_html__('Default value is center', 'hue'),
            'parent'        => $blog_filter_container,
            'options'       => array(
                'center' => esc_html__('Center', 'hue'),
                'left'   => esc_html__('Left', 'hue'),
                'right'  => esc_html__('Right', 'hue'),
            ),
            'default_value' => 'center'
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'color',
            'name'          => 'blog_filter_text_color',
            'default_value' => '#ffffff',
            'label'         => esc_html__('Masonry filter text color', 'hue'),
            'description'   => esc_html__('Choose text color for masonry filter', 'hue'),
            'parent'        => $blog_filter_container
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'color',
            'name'          => 'blog_filter_background_color',
            'default_value' => '#d4145a',
            'label'         => esc_html__('Masonry filter background color', 'hue'),
            'description'   => esc_html__('Choose background color for masonry filter', 'hue'),
            'parent'        => $blog_filter_container
        ));

        hue_mikado_add_admin_field(
            array(
                'parent'        => $blog_filter_container,
                'type'          => 'text',
                'name'          => 'blog_filter_background_transparency',
                'default_value' => '1',
                'label'         => esc_html__('Masonry filter background transparency', 'hue'),
                'description'   => esc_html__('Choose a transparency for the masonry filter background color (0 = fully transparent, 1 = opaque)', 'hue'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'type'          => 'text',
                'name'          => 'number_of_chars',
                'default_value' => '',
                'label'         => esc_html__('Number of Words in Excerpt', 'hue'),
                'parent'        => $panel_blog_lists,
                'description'   => esc_html__('Enter a number of words in excerpt (article summary)', 'hue'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );
        hue_mikado_add_admin_field(
            array(
                'type'          => 'text',
                'name'          => 'standard_number_of_chars',
                'default_value' => '45',
                'label'         => esc_html__('Standard Type Number of Words in Excerpt', 'hue'),
                'parent'        => $panel_blog_lists,
                'description'   => esc_html__('Enter a number of words in excerpt (article summary)', 'hue'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );
        hue_mikado_add_admin_field(
            array(
                'type'          => 'text',
                'name'          => 'masonry_number_of_chars',
                'default_value' => '45',
                'label'         => esc_html__('Masonry Type Number of Words in Excerpt', 'hue'),
                'parent'        => $panel_blog_lists,
                'description'   => esc_html__('Enter a number of words in excerpt (article summary)', 'hue'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );
        hue_mikado_add_admin_field(
            array(
                'type'          => 'text',
                'name'          => 'split_column_number_of_chars',
                'default_value' => '45',
                'label'         => esc_html__('Split Column Type Number of Words in Excerpt', 'hue'),
                'parent'        => $panel_blog_lists,
                'description'   => esc_html__('Enter a number of words in excerpt (article summary)', 'hue'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );
        hue_mikado_add_admin_field(
            array(
                'type'          => 'select',
                'name'          => 'blog_gradient_element_style',
                'default_value' => 'mkd-type5-gradient-left-to-right',
                'label'         => esc_html__('Gradient Elements Style', 'hue'),
                'parent'        => $panel_blog_lists,
                'description'   => esc_html__('Choose style for gradient elements', 'hue'),
                'options'       => hue_mikado_get_gradient_left_to_right_styles('', false)
            )
        );

        /**
         * Blog Single
         */
        $panel_blog_single = hue_mikado_add_admin_panel(
            array(
                'page'  => '_blog_page',
                'name'  => 'panel_blog_single',
                'title' => esc_html__('Blog Single', 'hue')
            )
        );

        hue_mikado_add_admin_field(array(
            'name'          => 'blog_single_sidebar_layout',
            'type'          => 'select',
            'label'         => esc_html__('Sidebar Layout', 'hue'),
            'description'   => esc_html__('Choose a sidebar layout for Blog Single pages', 'hue'),
            'parent'        => $panel_blog_single,
            'options'       => array(
                'default'          => esc_html__('No Sidebar', 'hue'),
                'sidebar-33-right' => esc_html__('Sidebar 1/3 Right', 'hue'),
                'sidebar-25-right' => esc_html__('Sidebar 1/4 Right', 'hue'),
                'sidebar-33-left'  => esc_html__('Sidebar 1/3 Left', 'hue'),
                'sidebar-25-left'  => esc_html__('Sidebar 1/4 Left', 'hue'),
            ),
            'default_value' => 'default'
        ));


        if(count($custom_sidebars) > 0) {
            hue_mikado_add_admin_field(array(
                'name'        => 'blog_single_custom_sidebar',
                'type'        => 'selectblank',
                'label'       => esc_html__('Sidebar to Display', 'hue'),
                'description' => esc_html__('Choose a sidebar to display on Blog Single pages. Default sidebar is "Sidebar"', 'hue'),
                'parent'      => $panel_blog_single,
                'options'     => hue_mikado_get_custom_sidebars()
            ));
        }

        hue_mikado_add_admin_field(array(
            'name'          => 'blog_single_title_in_title_area',
            'type'          => 'yesno',
            'label'         => esc_html__('Show Post Title in Title Area', 'hue'),
            'description'   => esc_html__('Enabling this option will show post title in title area on single post pages', 'hue'),
            'parent'        => $panel_blog_single,
            'default_value' => 'no'
        ));

        hue_mikado_add_admin_field(array(
            'name'          => 'blog_single_likes',
            'type'          => 'yesno',
            'label'         => esc_html__('Show Likes', 'hue'),
            'description'   => esc_html__('Enabling this option will show likes on your page.', 'hue'),
            'parent'        => $panel_blog_single,
            'default_value' => 'yes'
        ));

        hue_mikado_add_admin_field(array(
            'name'          => 'blog_single_comments',
            'type'          => 'yesno',
            'label'         => esc_html__('Show Comments', 'hue'),
            'description'   => esc_html__('Enabling this option will show comments on your page.', 'hue'),
            'parent'        => $panel_blog_single,
            'default_value' => 'yes'
        ));

        hue_mikado_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'blog_single_navigation',
                'default_value' => 'no',
                'label'         => esc_html__('Enable Prev/Next Single Post Navigation Links', 'hue'),
                'parent'        => $panel_blog_single,
                'description'   => esc_html__('Enable navigation links through the blog posts (left and right arrows will appear)', 'hue'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_mkd_blog_single_navigation_container'
                )
            )
        );

        $blog_single_navigation_container = hue_mikado_add_admin_container(
            array(
                'name'            => 'mkd_blog_single_navigation_container',
                'hidden_property' => 'blog_single_navigation',
                'hidden_value'    => 'no',
                'parent'          => $panel_blog_single,
            )
        );

        hue_mikado_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'blog_navigation_through_same_category',
                'default_value' => 'no',
                'label'         => esc_html__('Enable Navigation Only in Current Category', 'hue'),
                'description'   => esc_html__('Limit your navigation only through current category', 'hue'),
                'parent'        => $blog_single_navigation_container,
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        hue_mikado_add_admin_field(array(
            'type'          => 'yesno',
            'name'          => 'blog_enable_single_tags',
            'default_value' => 'yes',
            'label'         => esc_html__('Enable Tags on Single Post', 'hue'),
            'description'   => esc_html__('Enabling this option will display posts\s tags on single post page', 'hue'),
            'parent'        => $panel_blog_single
        ));


        hue_mikado_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'blog_author_info',
                'default_value' => 'no',
                'label'         => esc_html__('Show Author Info Box', 'hue'),
                'parent'        => $panel_blog_single,
                'description'   => esc_html__('Enabling this option will display author name and descriptions on Blog Single pages', 'hue'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_mkd_blog_single_author_info_container'
                )
            )
        );

        $blog_single_author_info_container = hue_mikado_add_admin_container(
            array(
                'name'            => 'mkd_blog_single_author_info_container',
                'hidden_property' => 'blog_author_info',
                'hidden_value'    => 'no',
                'parent'          => $panel_blog_single,
            )
        );

        hue_mikado_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'blog_author_info_email',
                'default_value' => 'no',
                'label'         => esc_html__('Show Author Email', 'hue'),
                'description'   => esc_html__('Enabling this option will show author email', 'hue'),
                'parent'        => $blog_single_author_info_container,
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

    }

    add_action('hue_mikado_options_map', 'hue_mikado_blog_options_map', 12);

}











