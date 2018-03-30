<?php

if(!function_exists('hue_mikado_portfolio_options_map')) {

	function hue_mikado_portfolio_options_map() {

		hue_mikado_add_admin_page(array(
			'slug'  => '_portfolio',
			'title' => esc_html__('Portfolio', 'hue'),
			'icon'  => 'icon_images'
		));

		$panel = hue_mikado_add_admin_panel(array(
			'title' => esc_html__('Portfolio Single', 'hue'),
			'name'  => 'panel_portfolio_single',
			'page'  => '_portfolio'
		));

		hue_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_template',
			'type'          => 'select',
			'label'         => esc_html__('Portfolio Type', 'hue'),
			'default_value' => 'small-images',
			'description'   => 'Choose a default type for Single Project pages',
			'parent'        => $panel,
			'options'       => array(
				'small-images'      => esc_html__('Portfolio small images', 'hue'),
				'small-slider'      => esc_html__('Portfolio small slider', 'hue'),
				'big-images'        => esc_html__('Portfolio big images', 'hue'),
				'big-slider'        => esc_html__('Portfolio big slider', 'hue'),
				'custom'            => esc_html__('Portfolio custom', 'hue'),
				'full-width-custom' => esc_html__('Portfolio full width custom', 'hue'),
				'masonry'   => esc_html__('Portfolio masonry', 'hue'),
				'gallery'           => esc_html__('Portfolio gallery', 'hue')
			)
		));

		hue_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_lightbox_images',
			'type'          => 'yesno',
			'label'         => esc_html__('Lightbox for Images', 'hue'),
			'description'   => esc_html__('Enabling this option will turn on lightbox functionality for projects with images.', 'hue'),
			'parent'        => $panel,
			'default_value' => 'yes'
		));

		hue_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_lightbox_videos',
			'type'          => 'yesno',
			'label'         => esc_html__('Lightbox for Videos', 'hue'),
			'description'   => esc_html__('Enabling this option will turn on lightbox functionality for YouTube/Vimeo projects.', 'hue'),
			'parent'        => $panel,
			'default_value' => 'no'
		));

		hue_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_hide_categories',
			'type'          => 'yesno',
			'label'         => esc_html__('Hide Categories', 'hue'),
			'description'   => esc_html__('Enabling this option will disable category meta description on Single Projects.', 'hue'),
			'parent'        => $panel,
			'default_value' => 'no'
		));

		hue_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_hide_date',
			'type'          => 'yesno',
			'label'         => esc_html__('Hide Date', 'hue'),
			'description'   => esc_html__('Enabling this option will disable date meta on Single Projects.', 'hue'),
			'parent'        => $panel,
			'default_value' => 'no'
		));

		hue_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_likes',
			'type'          => 'yesno',
			'label'         => esc_html__('Show Likes', 'hue'),
			'description'   => esc_html__('Enabling this option will show likes on your page.', 'hue'),
			'parent'        => $panel,
			'default_value' => 'no'
		));


		hue_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_comments',
			'type'          => 'yesno',
			'label'         => esc_html__('Show Comments', 'hue'),
			'description'   => esc_html__('Enabling this option will show comments on your page.', 'hue'),
			'parent'        => $panel,
			'default_value' => 'no'
		));

		hue_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_sticky_sidebar',
			'type'          => 'yesno',
			'label'         => esc_html__('Sticky Side Text', 'hue'),
			'description'   => esc_html__('Enabling this option will make side text sticky on Single Project pages', 'hue'),
			'parent'        => $panel,
			'default_value' => 'yes'
		));

		hue_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_hide_pagination',
			'type'          => 'yesno',
			'label'         => esc_html__('Hide Pagination', 'hue'),
			'description'   => esc_html__('Enabling this option will turn off portfolio pagination functionality.', 'hue'),
			'parent'        => $panel,
			'default_value' => 'no',
			'args'          => array(
				'dependence'             => true,
				'dependence_hide_on_yes' => '#mkd_navigate_same_category_container'
			)
		));

		$container_navigate_category = hue_mikado_add_admin_container(array(
			'name'            => 'navigate_same_category_container',
			'parent'          => $panel,
			'hidden_property' => 'portfolio_single_hide_pagination',
			'hidden_value'    => 'yes'
		));

		hue_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_nav_same_category',
			'type'          => 'yesno',
			'label'         => esc_html__('Enable Pagination Through Same Category', 'hue'),
			'description'   => esc_html__('Enabling this option will make portfolio pagination sort through current category.', 'hue'),
			'parent'        => $container_navigate_category,
			'default_value' => 'no'
		));

		hue_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_numb_columns',
			'type'          => 'select',
			'label'         => esc_html__('Number of Columns', 'hue'),
			'default_value' => 'three-columns',
			'description'   => esc_html__('Enter the number of columns for Portfolio Gallery type', 'hue'),
			'parent'        => $panel,
			'options'       => array(
				'two-columns'   => esc_html__('2 columns', 'hue'),
				'three-columns' => esc_html__('3 columns', 'hue'),
				'four-columns'  => esc_html__('4 columns', 'hue')
			)
		));

		hue_mikado_add_admin_field(array(
			'name'        => 'portfolio_single_slug',
			'type'        => 'text',
			'label'       => esc_html__('Portfolio Single Slug', 'hue'),
			'description' => esc_html__('Enter if you wish to use a different Single Project slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect)', 'hue'),
			'parent'      => $panel,
			'args'        => array(
				'col_width' => 3
			)
		));

	}

	add_action('hue_mikado_options_map', 'hue_mikado_portfolio_options_map', 14);

}