<?php

if (!function_exists('hashmag_mikado_blog_options_map')) {

    function hashmag_mikado_blog_options_map() {

        hashmag_mikado_add_admin_page(
            array(
                'slug' => '_blog_page',
                'title' => 'Blog',
                'icon' => 'fa fa-files-o'
            )
        );

        /**
         * Blog Lists
         */

        $custom_sidebars = hashmag_mikado_get_custom_sidebars();

        $panel_blog_lists = hashmag_mikado_add_admin_panel(
            array(
                'page' => '_blog_page',
                'name' => 'panel_blog_lists',
                'title' => 'Blog Lists'
            )
        );

        hashmag_mikado_add_admin_field(array(
            'name' => 'blog_list_type',
            'type' => 'select',
            'label' => 'Blog Layout for Archive Pages',
            'description' => 'Choose a default blog layout',
            'default_value' => 'standard',
            'parent' => $panel_blog_lists,
            'options' => array(
                'standard' => 'Blog: Standard',
                'standard-whole-post' => 'Blog: Standard Whole Post',
                'type1' => 'Template 1',
                'type2' => 'Template 2',
                'type3' => 'Template 3',
                'type4' => 'Template 4',
            )
        ));

        hashmag_mikado_add_admin_field(array(
            'name' => 'archive_sidebar_layout',
            'type' => 'select',
            'label' => 'Archive Sidebar',
            'description' => 'Choose a sidebar layout for Archive Blog Post Lists',
            'parent' => $panel_blog_lists,
            'options' => array(
                'default' => 'No Sidebar',
                'sidebar-33-right' => 'Sidebar 1/3 Right',
                'sidebar-25-right' => 'Sidebar 1/4 Right',
                'sidebar-33-left' => 'Sidebar 1/3 Left',
                'sidebar-25-left' => 'Sidebar 1/4 Left',
            )
        ));

        if (count($custom_sidebars) > 0) {
            hashmag_mikado_add_admin_field(array(
                'name' => 'blog_custom_sidebar',
                'type' => 'selectblank',
                'label' => 'Archive Sidebar to Display',
                'description' => 'Choose a sidebar to display on Blog Post Lists. Default sidebar is "Sidebar Page"',
                'parent' => $panel_blog_lists,
                'options' => hashmag_mikado_get_custom_sidebars()
            ));
        }

        hashmag_mikado_add_admin_field(array(
            'name' => 'unique_category_layout',
            'type' => 'yesno',
            'default_value' => 'yes',
            'label' => 'Enable Unique Category Layout',
            'description' => 'Enable unique layout for Category Blog Post Lists',
            'parent' => $panel_blog_lists,
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#mkdf_mkdf_category_unique_layout_container'
            )
        ));

        $category_unique_layout_container = hashmag_mikado_add_admin_container(
            array(
                'name' => 'mkdf_category_unique_layout_container',
                'hidden_property' => 'unique_category_layout',
                'hidden_value' => 'no',
                'parent' => $panel_blog_lists,
            )
        );

        hashmag_mikado_add_admin_field(
            array(
                'parent' => $category_unique_layout_container,
                'type' => 'select',
                'name' => 'category_unique_layout',
                'default_value' => 'type1',
                'label' => 'Category Layout',
                'description' => 'Choose unique layout for Category Blog Post Lists',
                'options' => array(
                    'type_standard' => 'Template Standard',
                    'type1' => 'Template 1',
                    'type2' => 'Template 2',
                    'type3' => 'Template 3',
                    'type4' => 'Template 4',
                )
            )
        );

        hashmag_mikado_add_admin_field(array(
            'name' => 'category_sidebar_layout',
            'type' => 'select',
            'label' => 'Category Sidebar',
            'description' => 'Choose a sidebar layout for Category Blog Post Lists',
            'parent' => $panel_blog_lists,
            'options' => array(
                'default' => 'No Sidebar',
                'sidebar-33-right' => 'Sidebar 1/3 Right',
                'sidebar-25-right' => 'Sidebar 1/4 Right',
                'sidebar-33-left' => 'Sidebar 1/3 Left',
                'sidebar-25-left' => 'Sidebar 1/4 Left',
            )
        ));

        if (count($custom_sidebars) > 0) {
            hashmag_mikado_add_admin_field(array(
                'name' => 'blog_custom_category_sidebar',
                'type' => 'selectblank',
                'label' => 'Category Sidebar to Display',
                'description' => 'Choose a sidebar to display on Category Blog Lists. Default sidebar is "Sidebar Page"',
                'parent' => $panel_blog_lists,
                'options' => hashmag_mikado_get_custom_sidebars()
            ));
        }

        hashmag_mikado_add_admin_field(array(
            'name' => 'unique_author_layout',
            'type' => 'yesno',
            'default_value' => 'yes',
            'label' => 'Enable Unique Author Layout',
            'description' => 'Enable unique layout for Author Blog Post Lists',
            'parent' => $panel_blog_lists,
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#mkdf_mkdf_author_unique_layout_container'
            )
        ));

        $author_unique_layout_container = hashmag_mikado_add_admin_container(
            array(
                'name' => 'mkdf_author_unique_layout_container',
                'hidden_property' => 'unique_author_layout',
                'hidden_value' => 'no',
                'parent' => $panel_blog_lists,
            )
        );

        hashmag_mikado_add_admin_field(
            array(
                'parent' => $author_unique_layout_container,
                'type' => 'select',
                'name' => 'author_unique_layout',
                'default_value' => 'type3',
                'label' => 'Author Layout',
                'description' => 'Choose unique layout for Author Blog Post Lists',
                'options' => array(
                    'type_standard' => 'Template Standard',
                    'type1' => 'Template 1',
                    'type2' => 'Template 2',
                    'type3' => 'Template 3',
                    'type4' => 'Template 4',
                )
            )
        );

        hashmag_mikado_add_admin_field(array(
            'name' => 'author_sidebar_layout',
            'type' => 'select',
            'label' => 'Author Sidebar',
            'description' => 'Choose a sidebar layout for Author Blog Post Lists',
            'parent' => $panel_blog_lists,
            'options' => array(
                'default' => 'No Sidebar',
                'sidebar-33-right' => 'Sidebar 1/3 Right',
                'sidebar-25-right' => 'Sidebar 1/4 Right',
                'sidebar-33-left' => 'Sidebar 1/3 Left',
                'sidebar-25-left' => 'Sidebar 1/4 Left',
            )
        ));

        if (count($custom_sidebars) > 0) {
            hashmag_mikado_add_admin_field(array(
                'name' => 'blog_custom_author_sidebar',
                'type' => 'selectblank',
                'label' => 'Author Sidebar to Display',
                'description' => 'Choose a sidebar to display on Author Blog Lists. Default sidebar is "Sidebar Page"',
                'parent' => $panel_blog_lists,
                'options' => hashmag_mikado_get_custom_sidebars()
            ));
        }

        hashmag_mikado_add_admin_field(array(
            'name' => 'unique_tag_layout',
            'type' => 'yesno',
            'default_value' => 'no',
            'label' => 'Enable Unique Tag Layout',
            'description' => 'Enable unique layout for Tag Blog Post Lists',
            'parent' => $panel_blog_lists,
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#mkdf_mkdf_tag_unique_layout_container'
            )
        ));

        $tag_unique_layout_container = hashmag_mikado_add_admin_container(
            array(
                'name' => 'mkdf_tag_unique_layout_container',
                'hidden_property' => 'unique_tag_layout',
                'hidden_value' => 'no',
                'parent' => $panel_blog_lists,
            )
        );

        hashmag_mikado_add_admin_field(
            array(
                'parent' => $tag_unique_layout_container,
                'type' => 'select',
                'name' => 'tag_unique_layout',
                'default_value' => 'type2',
                'label' => 'Tag Layout',
                'description' => 'Choose unique layout for Tag Blog Post Lists',
                'options' => array(
                    'type_standard' => 'Template Standard',
                    'type1' => 'Template 1',
                    'type2' => 'Template 2',
                    'type3' => 'Template 3',
                    'type4' => 'Template 4',
                )
            )
        );

        hashmag_mikado_add_admin_field(array(
            'name' => 'tag_sidebar_layout',
            'type' => 'select',
            'label' => 'Tag Sidebar',
            'default_value' => 'default',
            'description' => 'Choose a sidebar layout for Tag Blog Post Lists',
            'parent' => $panel_blog_lists,
            'options' => array(
                'default' => 'Default',
                'no-sidebar' => 'No Sidebar',
                'sidebar-33-right' => 'Sidebar 1/3 Right',
                'sidebar-25-right' => 'Sidebar 1/4 Right',
                'sidebar-33-left' => 'Sidebar 1/3 Left',
                'sidebar-25-left' => 'Sidebar 1/4 Left',
            )
        ));

        if (count($custom_sidebars) > 0) {
            hashmag_mikado_add_admin_field(array(
                'name' => 'blog_custom_tag_sidebar',
                'type' => 'selectblank',
                'label' => 'Tag Sidebar to Display',
                'description' => 'Choose a sidebar to display on Tag Blog Lists. Default sidebar is "Sidebar Page"',
                'parent' => $panel_blog_lists,
                'options' => hashmag_mikado_get_custom_sidebars()
            ));
        }

        hashmag_mikado_add_admin_field(
            array(
                'type' => 'yesno',
                'name' => 'pagination',
                'default_value' => 'yes',
                'label' => 'Pagination',
                'parent' => $panel_blog_lists,
                'description' => 'Enabling this option will display pagination links on bottom of Blog Post List',
                'args' => array(
                    'dependence' => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkdf_mkdf_pagination_container'
                )
            )
        );

        $pagination_container = hashmag_mikado_add_admin_container(
            array(
                'name' => 'mkdf_pagination_container',
                'hidden_property' => 'pagination',
                'hidden_value' => 'no',
                'parent' => $panel_blog_lists,
            )
        );

        hashmag_mikado_add_admin_field(
            array(
                'parent' => $pagination_container,
                'type' => 'text',
                'name' => 'blog_page_range',
                'default_value' => '',
                'label' => 'Pagination Range limit',
                'description' => 'Enter a number that will limit pagination to a certain range of links',
                'args' => array(
                    'col_width' => 3
                )
            )
        );

        hashmag_mikado_add_admin_field(
            array(
                'type' => 'text',
                'name' => 'number_of_chars',
                'default_value' => '45',
                'label' => 'Number of Words in Excerpt',
                'parent' => $panel_blog_lists,
                'description' => 'Enter a number of words in excerpt (article summary)',
                'args' => array(
                    'col_width' => 3
                )
            )
        );

        hashmag_mikado_add_admin_field(array(
            'name' => 'blog_list_feature_image',
            'type' => 'yesno',
            'label' => 'Show Feature Image',
            'description' => 'Enabling this option will show feature image for your posts on your blog page.',
            'parent' => $panel_blog_lists,
            'default_value' => 'yes',
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#mkdf_blog_list_feature_image_container'
            )
        ));

        $blog_list_feature_image_container = hashmag_mikado_add_admin_container(
            array(
                'name' => 'blog_list_feature_image_container',
                'hidden_property' => 'blog_list_feature_image',
                'hidden_value' => 'no',
                'parent' => $panel_blog_lists,
            )
        );

        hashmag_mikado_add_admin_field(
            array(
                'type' => 'text',
                'name' => 'blog_list_feature_image_max_width',
                'default_value' => '',
                'label' => 'Featured Image Max Width',
                'parent' => $blog_list_feature_image_container,
                'description' => 'Define maximum width for featured images on your blog page. Default value is 1300',
                'args' => array(
                    'col_width' => 3,
                    'suffix' => 'px'
                )
            )
        );

        hashmag_mikado_add_admin_field(array(
            'name' => 'blog_list_category',
            'type' => 'yesno',
            'label' => 'Show Category',
            'description' => 'Enabling this option will show category post info on your blog page.',
            'parent' => $panel_blog_lists,
            'default_value' => 'yes'
        ));

        hashmag_mikado_add_admin_field(array(
            'name' => 'blog_list_date',
            'type' => 'yesno',
            'label' => 'Show Date',
            'description' => 'Enabling this option will show date post info on your blog page.',
            'parent' => $panel_blog_lists,
            'default_value' => 'yes'
        ));

        hashmag_mikado_add_admin_field(array(
            'name' => 'blog_list_author',
            'type' => 'yesno',
            'label' => 'Show Author',
            'description' => 'Enabling this option will show author post info on your blog page.',
            'parent' => $panel_blog_lists,
            'default_value' => 'no'
        ));

        hashmag_mikado_add_admin_field(array(
            'name' => 'blog_list_comment',
            'type' => 'yesno',
            'label' => 'Show Comments',
            'description' => 'Enabling this option will show comments post info on your blog page.',
            'parent' => $panel_blog_lists,
            'default_value' => 'yes'
        ));

        hashmag_mikado_add_admin_field(array(
            'name' => 'blog_list_like',
            'type' => 'yesno',
            'label' => 'Show Like',
            'description' => 'Enabling this option will show like post info on your blog page.',
            'parent' => $panel_blog_lists,
            'default_value' => 'no'
        ));

        hashmag_mikado_add_admin_field(array(
            'name' => 'blog_list_share',
            'type' => 'yesno',
            'label' => 'Show Share',
            'description' => 'Enabling this option will show share post info on your blog page.',
            'parent' => $panel_blog_lists,
            'default_value' => 'no'
        ));

        hashmag_mikado_add_admin_field(array(
            'name' => 'blog_list_read_more',
            'type' => 'yesno',
            'label' => 'Show Read More',
            'description' => 'Enabling this option will show read more button on your blog page.',
            'parent' => $panel_blog_lists,
            'default_value' => 'no'
        ));

        /**
         * Blog Single
         */
        $panel_blog_single = hashmag_mikado_add_admin_panel(
            array(
                'page' => '_blog_page',
                'name' => 'panel_blog_single',
                'title' => 'Blog Single'
            )
        );

        hashmag_mikado_add_admin_field(array(
            'name' => 'blog_single_sidebar_layout',
            'type' => 'select',
            'label' => 'Sidebar Layout',
            'description' => 'Choose a sidebar layout for Blog Single pages',
            'parent' => $panel_blog_single,
            'options' => array(
                'default' => 'No Sidebar',
                'sidebar-33-right' => 'Sidebar 1/3 Right',
                'sidebar-25-right' => 'Sidebar 1/4 Right',
                'sidebar-33-left' => 'Sidebar 1/3 Left',
                'sidebar-25-left' => 'Sidebar 1/4 Left',
            ),
            'default_value' => 'default'
        ));


        if (count($custom_sidebars) > 0) {
            hashmag_mikado_add_admin_field(array(
                'name' => 'blog_single_custom_sidebar',
                'type' => 'selectblank',
                'label' => 'Sidebar to Display',
                'description' => 'Choose a sidebar to display on Blog Single pages. Default sidebar is "Sidebar"',
                'parent' => $panel_blog_single,
                'options' => hashmag_mikado_get_custom_sidebars()
            ));
        }

        hashmag_mikado_add_admin_field(
            array(
                'type' => 'text',
                'name' => 'blog_single_feature_image_max_width',
                'default_value' => '',
                'label' => 'Featured Image Max Width',
                'parent' => $panel_blog_single,
                'description' => 'Define maximum width for featured image on single post pages. Default value is 1200',
                'args' => array(
                    'col_width' => 3,
                    'suffix' => 'px'
                )
            )
        );

        hashmag_mikado_add_admin_field(array(
            'name' => 'blog_single_category',
            'type' => 'yesno',
            'label' => 'Show Category',
            'description' => 'Enabling this option will show category post info on your single post page.',
            'parent' => $panel_blog_single,
            'default_value' => 'yes'
        ));

        hashmag_mikado_add_admin_field(array(
            'name' => 'blog_single_date',
            'type' => 'yesno',
            'label' => 'Show Date',
            'description' => 'Enabling this option will show date post info on your single post page.',
            'parent' => $panel_blog_single,
            'default_value' => 'yes'
        ));

        hashmag_mikado_add_admin_field(array(
            'name' => 'blog_single_author',
            'type' => 'yesno',
            'label' => 'Show Author',
            'description' => 'Enabling this option will show author post info on your single post page.',
            'parent' => $panel_blog_single,
            'default_value' => 'yes'
        ));

        hashmag_mikado_add_admin_field(array(
            'name' => 'blog_single_comment',
            'type' => 'yesno',
            'label' => 'Show Comments',
            'description' => 'Enabling this option will show comments post info on your single post page.',
            'parent' => $panel_blog_single,
            'default_value' => 'yes'
        ));

        hashmag_mikado_add_admin_field(array(
            'name' => 'blog_single_like',
            'type' => 'yesno',
            'label' => 'Show Like',
            'description' => 'Enabling this option will show like post info on your single post page.',
            'parent' => $panel_blog_single,
            'default_value' => 'yes'
        ));

        hashmag_mikado_add_admin_field(array(
            'name' => 'blog_single_count',
            'type' => 'yesno',
            'label' => 'Show Post Count',
            'description' => 'Enabling this option will show count post info on your single post page.',
            'parent' => $panel_blog_single,
            'default_value' => 'yes'
        ));

        hashmag_mikado_add_admin_field(array(
            'name' => 'blog_single_share',
            'type' => 'yesno',
            'label' => 'Show Share',
            'description' => 'Enabling this option will show share post info on your single post page.',
            'parent' => $panel_blog_single,
            'default_value' => 'yes'
        ));

        hashmag_mikado_add_admin_field(array(
            'name' => 'blog_single_tags',
            'type' => 'yesno',
            'label' => 'Show Tags',
            'description' => 'Enabling this option will show post tags on your single post page.',
            'parent' => $panel_blog_single,
            'default_value' => 'yes'
        ));

        hashmag_mikado_add_admin_field(array(
            'name' => 'blog_single_related_posts',
            'type' => 'yesno',
            'label' => 'Show Related Posts',
            'description' => 'Enabling this option will show related posts on your single post page.',
            'parent' => $panel_blog_single,
            'default_value' => 'yes',
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#mkdf_related_image_container'
            )
        ));

        $related_image_container = hashmag_mikado_add_admin_container(
            array(
                'name' => 'related_image_container',
                'hidden_property' => 'blog_single_related_posts',
                'hidden_value' => 'no',
                'parent' => $panel_blog_single,
            )
        );

        hashmag_mikado_add_admin_field(
            array(
                'type' => 'text',
                'name' => 'blog_single_related_image_size',
                'default_value' => '',
                'label' => 'Related Posts Image Max Width',
                'parent' => $related_image_container,
                'description' => 'Define maximum width for related posts images on your single post pages. Default value is 1200',
                'args' => array(
                    'col_width' => 3
                )
            )
        );

        hashmag_mikado_add_admin_field(
            array(
                'type' => 'text',
                'name' => 'blog_single_related_title_size',
                'default_value' => '70',
                'label' => 'Title Max Chars',
                'parent' => $related_image_container,
                'description' => 'Enter max characters of title post list that you want to display',
                'args' => array(
                    'col_width' => 3
                )
            )
        );

        hashmag_mikado_add_admin_field(
            array(
                'type' => 'yesno',
                'name' => 'blog_single_navigation',
                'default_value' => 'yes',
                'label' => 'Enable Prev/Next Single Post Navigation Links',
                'parent' => $panel_blog_single,
                'description' => 'Enable navigation links through the blog posts (left and right arrows will appear)',
                'args' => array(
                    'dependence' => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkdf_mkdf_blog_single_navigation_container'
                )
            )
        );

        $blog_single_navigation_container = hashmag_mikado_add_admin_container(
            array(
                'name' => 'mkdf_blog_single_navigation_container',
                'hidden_property' => 'blog_single_navigation',
                'hidden_value' => 'no',
                'parent' => $panel_blog_single,
            )
        );

        hashmag_mikado_add_admin_field(
            array(
                'type' => 'yesno',
                'name' => 'blog_navigation_through_same_category',
                'default_value' => 'no',
                'label' => 'Enable Navigation Only in Current Category',
                'description' => 'Limit your navigation only through current category',
                'parent' => $blog_single_navigation_container,
                'args' => array(
                    'col_width' => 3
                )
            )
        );

        hashmag_mikado_add_admin_field(
            array(
                'type' => 'yesno',
                'name' => 'blog_author_info',
                'default_value' => 'yes',
                'label' => 'Show Author Info Box',
                'parent' => $panel_blog_single,
                'description' => 'Enabling this option will display author name and descriptions on Blog Single pages',
                'args' => array(
                    'dependence' => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkdf_mkdf_blog_single_author_info_container'
                )
            )
        );

        $blog_single_author_info_container = hashmag_mikado_add_admin_container(
            array(
                'name' => 'mkdf_blog_single_author_info_container',
                'hidden_property' => 'blog_author_info',
                'hidden_value' => 'no',
                'parent' => $panel_blog_single,
            )
        );

        hashmag_mikado_add_admin_field(
            array(
                'type' => 'yesno',
                'name' => 'blog_author_info_email',
                'default_value' => 'no',
                'label' => 'Show Author Email',
                'description' => 'Enabling this option will show author email',
                'parent' => $blog_single_author_info_container,
                'args' => array(
                    'col_width' => 3
                )
            )
        );
    }

    add_action('hashmag_mikado_options_map', 'hashmag_mikado_blog_options_map', 10);
}