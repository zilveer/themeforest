<?php

if ( ! function_exists('flow_elated_blog_options_map') ) {

	function flow_elated_blog_options_map() {

		flow_elated_add_admin_page(
			array(
				'slug' => '_blog_page',
				'title' => 'Blog',
				'icon' => 'fa fa-files-o'
			)
		);

		/**
		 * Blog Lists
		 */

		$custom_sidebars = flow_elated_get_custom_sidebars();

		$panel_blog_lists = flow_elated_add_admin_panel(
			array(
				'page' => '_blog_page',
				'name' => 'panel_blog_lists',
				'title' => 'Blog Lists'
			)
		);

		flow_elated_add_admin_field(array(
			'name'        => 'blog_list_type',
			'type'        => 'select',
			'label'       => 'Blog Layout for Archive Pages',
			'description' => 'Choose a default blog layout',
			'default_value' => 'standard',
			'parent'      => $panel_blog_lists,
			'options'     => array(
				'standard'				=> 'Blog: Standard',
				'split-column'			=> 'Blog: Split Column',
				'masonry' 				=> 'Blog: Masonry',
				'masonry-full-width' 	=> 'Blog: Masonry Full Width',
				'standard-whole-post' 	=> 'Blog: Standard Whole Post'
			)
		));
		flow_elated_add_admin_field(array(
			'name'        => 'blog_archive_page_padding',
			'type'        => 'text',
			'label'       => 'Blog Archive Page Padding',
			'description' => 'Insert padding in format 10px 10px 10px 10px',
			'default_value' => '',
			'parent'      => $panel_blog_lists,
			'args' => array(
				'col_width' => 3
			)
		));

		flow_elated_add_admin_field(array(
			'name'        => 'archive_sidebar_layout',
			'type'        => 'select',
			'label'       => 'Archive and Category Sidebar',
			'description' => 'Choose a sidebar layout for archived Blog Post Lists and Category Blog Lists',
			'default_value' => 'default',
			'parent'      => $panel_blog_lists,
			'options'     => array(
				'default'			=> 'No Sidebar',
				'sidebar-33-right'	=> 'Sidebar 1/3 Right',
				'sidebar-25-right' 	=> 'Sidebar 1/4 Right',
				'sidebar-33-left' 	=> 'Sidebar 1/3 Left',
				'sidebar-25-left' 	=> 'Sidebar 1/4 Left',
			)
		));


		if(count($custom_sidebars) > 0) {
			flow_elated_add_admin_field(array(
				'name' => 'blog_custom_sidebar',
				'type' => 'selectblank',
				'label' => 'Sidebar to Display',
				'description' => 'Choose a sidebar to display on Blog Post Lists and Category Blog Lists. Default sidebar is "Sidebar Page"',
				'parent' => $panel_blog_lists,
				'options' => flow_elated_get_custom_sidebars()
			));
		}

		flow_elated_add_admin_field(
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
					'dependence_show_on_yes' => '#eltd_eltd_pagination_container'
				)
			)
		);

		$pagination_container = flow_elated_add_admin_container(
			array(
				'name' => 'eltd_pagination_container',
				'hidden_property' => 'pagination',
				'hidden_value' => 'no',
				'parent' => $panel_blog_lists,
			)
		);

		flow_elated_add_admin_field(
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

		flow_elated_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'lists_pagination',
				'default_value' => 'standard',
				'label' => 'Pagination Type',
				'parent' => $pagination_container,
				'description' => 'Choose a pagination type for blog lists. Please note that the Expanding Tiles blog list only supports "load more" and "infinite scroll" pagination',
				'options'     => array(
					'standard'			=> 'Standard',
					'load-more'			=> 'Load More',
					'infinite-scroll' 	=> 'Infinite Scroll'
				)
			)
		);

		flow_elated_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'masonry_filter',
				'default_value' => 'no',
				'label' => 'Masonry Filter',
				'parent' => $panel_blog_lists,
				'description' => 'Enabling this option will display category filter on Masonry and Masonry Full Width Templates',
				'args' => array(
					'col_width' => 3
				)
			)
		);
		flow_elated_add_admin_field(
			array(
				'type' => 'selectblank',
				'name' => 'masonry_columns',
				'default_value' => 'two',
				'label' => 'Masonry Columns',
				'parent' => $panel_blog_lists,
				'description' => 'Column number in Blog Masonry and Blog Masonry Full Width Template',
				'options'     => array(
					'two'	=> 'Two',
					'three'	=> 'Three',
					'four' 	=> 'Four'
				)
			)
		);	
		flow_elated_add_admin_field(
			array(
				'type' => 'text',
				'name' => 'number_of_chars',
				'default_value' => '120',
				'label' => 'Number of Words in Excerpt',
				'parent' => $panel_blog_lists,
				'description' => 'Enter a number of words in excerpt (article summary)',
				'args' => array(
					'col_width' => 3
				)
			)
		);
		flow_elated_add_admin_field(
			array(
				'type' => 'text',
				'name' => 'standard_number_of_chars',
				'default_value' => '120',
				'label' => 'Standard Type Number of Words in Excerpt',
				'parent' => $panel_blog_lists,
				'description' => 'Enter a number of words in excerpt (article summary)',
				'args' => array(
					'col_width' => 3
				)
			)
		);
		flow_elated_add_admin_field(
			array(
				'type' => 'text',
				'name' => 'expanding_tiles_number_of_chars',
				'default_value' => '10',
				'label' => 'Expanding Tiles Type Number of Words in Excerpt',
				'parent' => $panel_blog_lists,
				'description' => 'Enter a number of words in excerpt (article summary)',
				'args' => array(
					'col_width' => 3
				)
			)
		);
		flow_elated_add_admin_field(
			array(
				'type' => 'text',
				'name' => 'masonry_number_of_chars',
				'default_value' => '40',
				'label' => 'Masonry Type Number of Words in Excerpt',
				'parent' => $panel_blog_lists,
				'description' => 'Enter a number of words in excerpt (article summary)',
				'args' => array(
					'col_width' => 3
				)
			)
		);
		flow_elated_add_admin_field(
			array(
				'type' => 'text',
				'name' => 'split_column_number_of_chars',
				'default_value' => '40',
				'label' => 'Split Column Type Number of Words in Excerpt',
				'parent' => $panel_blog_lists,
				'description' => 'Enter a number of words in excerpt (article summary)',
				'args' => array(
					'col_width' => 3
				)
			)
		);

		/**
		 * Blog Single
		 */
		$panel_blog_single = flow_elated_add_admin_panel(
			array(
				'page' => '_blog_page',
				'name' => 'panel_blog_single',
				'title' => 'Blog Single'
			)
		);


		flow_elated_add_admin_field(array(
			'name'        => 'blog_single_sidebar_layout',
			'type'        => 'select',
			'label'       => 'Sidebar Layout',
			'description' => 'Choose a sidebar layout for Blog Single pages',
			'parent'      => $panel_blog_single,
			'options'     => array(
				'default'			=> 'No Sidebar',
				'sidebar-33-right'	=> 'Sidebar 1/3 Right',
				'sidebar-25-right' 	=> 'Sidebar 1/4 Right',
				'sidebar-33-left' 	=> 'Sidebar 1/3 Left',
				'sidebar-25-left' 	=> 'Sidebar 1/4 Left',
			),
			'default_value'	=> 'default'
		));


		if(count($custom_sidebars) > 0) {
			flow_elated_add_admin_field(array(
				'name' => 'blog_single_custom_sidebar',
				'type' => 'selectblank',
				'label' => 'Sidebar to Display',
				'description' => 'Choose a sidebar to display on Blog Single pages. Default sidebar is "Sidebar"',
				'parent' => $panel_blog_single,
				'options' => flow_elated_get_custom_sidebars()
			));
		}
		flow_elated_add_admin_field(
			array(
				'type' => 'text',
				'name' => 'blog_single_padding',
				'default_value' => '',
				'label' => 'Blog Single Padding',
				'description' => 'Please insert padding in format (top right bottom left) i.e. 5px 5px 5px 5px or 5% 5% 5% 5%',
				'parent' => $panel_blog_single,
				'args' => array('col_width' => 3)
			)
		);
		flow_elated_add_admin_field(
			array(
				'type' => 'selectblank',
				'name' => 'blog_single_show_title_area',
				'default_value' => 'yes',
				'label' => 'Show Title',
				'description' => 'Show Title area on Blog Single Pages',
				'parent' => $panel_blog_single,
				'args' => array('col_width' => 3),
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No'					
				)
			)
		);
		flow_elated_add_admin_field(array(
			'name'          => 'blog_single_comments',
			'type'          => 'yesno',
			'label'         => 'Show Comments',
			'description'   => 'Enabling this option will show comments on your page.',
			'parent'        => $panel_blog_single,
			'default_value' => 'yes'
		));

		flow_elated_add_admin_field(array(
			'name'			=> 'blog_single_related_posts',
			'type'			=> 'yesno',
			'label'			=> 'Show Related Posts',
			'description'   => 'Enabling this option will show related posts on your single post.',
			'parent'        => $panel_blog_single,
			'default_value' => 'yes'
		));

		flow_elated_add_admin_field(
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
					'dependence_show_on_yes' => '#eltd_eltd_blog_single_navigation_container'
				)
			)
		);

		$blog_single_navigation_container = flow_elated_add_admin_container(
			array(
				'name' => 'eltd_blog_single_navigation_container',
				'hidden_property' => 'blog_single_navigation',
				'hidden_value' => 'no',
				'parent' => $panel_blog_single,
			)
		);

		flow_elated_add_admin_field(
			array(
				'type'        => 'yesno',
				'name' => 'blog_navigation_through_same_category',
				'default_value' => 'no',
				'label'       => 'Enable Navigation Only in Current Category',
				'description' => 'Limit your navigation only through current category',
				'parent'      => $blog_single_navigation_container,
				'args' => array(
					'col_width' => 3
				)
			)
		);

		flow_elated_add_admin_field(
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
					'dependence_show_on_yes' => '#eltd_eltd_blog_single_author_info_container'
				)
			)
		);

		$blog_single_author_info_container = flow_elated_add_admin_container(
			array(
				'name' => 'eltd_blog_single_author_info_container',
				'hidden_property' => 'blog_author_info',
				'hidden_value' => 'no',
				'parent' => $panel_blog_single,
			)
		);

		flow_elated_add_admin_field(
			array(
				'type'        => 'yesno',
				'name' => 'blog_author_info_email',
				'default_value' => 'no',
				'label'       => 'Show Author Email',
				'description' => 'Enabling this option will show author email',
				'parent'      => $blog_single_author_info_container,
				'args' => array(
					'col_width' => 3
				)
			)
		);
		flow_elated_add_admin_field(
			array(
				'type' => 'selectblank',
				'name' => 'blog_single_full_width',
				'default_value' => 'grid',
				'label' => 'Blog Single Template',
				'parent' => $panel_blog_single,
				'description' => 'Choose a blog single template',
				'options'     => array(
					'grid'		 => 'In Grid',
					'full-width' => 'Full Width'
				)
			)
		);

	}

	add_action( 'flow_elated_options_map', 'flow_elated_blog_options_map', 15);

}











