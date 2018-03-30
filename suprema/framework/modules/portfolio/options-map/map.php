<?php

if ( ! function_exists('suprema_qodef_portfolio_options_map') ) {

	function suprema_qodef_portfolio_options_map() {

		suprema_qodef_add_admin_page(array(
			'slug'  => '_portfolio',
			'title' => 'Portfolio',
			'icon'  => 'fa fa-camera-retro'
		));

		$panel = suprema_qodef_add_admin_panel(array(
			'title' => 'Portfolio Single',
			'name'  => 'panel_portfolio_single',
			'page'  => '_portfolio'
		));

		suprema_qodef_add_admin_field(array(
			'name'        => 'portfolio_single_template',
			'type'        => 'select',
			'label'       => 'Portfolio Type',
			'default_value'	=> 'small-images',
			'description' => 'Choose a default type for Single Project pages',
			'parent'      => $panel,
			'options'     => array(
				'small-images' => 'Portfolio small images',
				'small-slider' => 'Portfolio small slider',
				'big-images' => 'Portfolio big images',
				'big-slider' => 'Portfolio big slider',
				'custom' => 'Portfolio custom',
				'full-width-custom' => 'Portfolio full width custom',
				'gallery' => 'Portfolio gallery'
			)
		));

		suprema_qodef_add_admin_field(array(
			'name'          => 'portfolio_single_lightbox_images',
			'type'          => 'yesno',
			'label'         => 'Lightbox for Images',
			'description'   => 'Enabling this option will turn on lightbox functionality for projects with images.',
			'parent'        => $panel,
			'default_value' => 'yes'
		));

		suprema_qodef_add_admin_field(array(
			'name'          => 'portfolio_single_lightbox_videos',
			'type'          => 'yesno',
			'label'         => 'Lightbox for Videos',
			'description'   => 'Enabling this option will turn on lightbox functionality for YouTube/Vimeo projects.',
			'parent'        => $panel,
			'default_value' => 'no'
		));

		suprema_qodef_add_admin_field(array(
			'name'          => 'portfolio_single_hide_categories',
			'type'          => 'yesno',
			'label'         => 'Hide Categories',
			'description'   => 'Enabling this option will disable category meta description on Single Projects.',
			'parent'        => $panel,
			'default_value' => 'no'
		));

		suprema_qodef_add_admin_field(array(
			'name'          => 'portfolio_single_hide_date',
			'type'          => 'yesno',
			'label'         => 'Hide Date',
			'description'   => 'Enabling this option will disable date meta on Single Projects.',
			'parent'        => $panel,
			'default_value' => 'no'
		));

		suprema_qodef_add_admin_field(array(
			'name'          => 'portfolio_single_comments',
			'type'          => 'yesno',
			'label'         => 'Show Comments',
			'description'   => 'Enabling this option will show comments on your page.',
			'parent'        => $panel,
			'default_value' => 'no'
		));

		suprema_qodef_add_admin_field(array(
			'name'          => 'portfolio_single_sticky_sidebar',
			'type'          => 'yesno',
			'label'         => 'Sticky Side Text',
			'description'   => 'Enabling this option will make side text sticky on Single Project pages',
			'parent'        => $panel,
			'default_value' => 'yes'
		));

		suprema_qodef_add_admin_field(array(
			'name'          => 'portfolio_single_hide_pagination',
			'type'          => 'yesno',
			'label'         => 'Hide Pagination',
			'description'   => 'Enabling this option will turn off portfolio pagination functionality.',
			'parent'        => $panel,
			'default_value' => 'no',
			'args' => array(
				'dependence' => true,
				'dependence_hide_on_yes' => '#qodef_navigate_same_category_container'
			)
		));

		$container_navigate_category = suprema_qodef_add_admin_container(array(
			'name'            => 'navigate_same_category_container',
			'parent'          => $panel,
			'hidden_property' => 'portfolio_single_hide_pagination',
			'hidden_value'    => 'yes'
		));

		suprema_qodef_add_admin_field(array(
			'name'            => 'portfolio_single_nav_same_category',
			'type'            => 'yesno',
			'label'           => 'Enable Pagination Through Same Category',
			'description'     => 'Enabling this option will make portfolio pagination sort through current category.',
			'parent'          => $container_navigate_category,
			'default_value'   => 'no'
		));

		suprema_qodef_add_admin_field(array(
			'name'        => 'portfolio_single_numb_columns',
			'type'        => 'select',
			'label'       => 'Number of Columns',
			'default_value' => 'three-columns',
			'description' => 'Enter the number of columns for Portfolio Gallery type',
			'parent'      => $panel,
			'options'     => array(
				'two-columns' => '2 columns',
				'three-columns' => '3 columns',
				'four-columns' => '4 columns'
			)
		));

		suprema_qodef_add_admin_field(array(
			'name'        => 'portfolio_single_slug',
			'type'        => 'text',
			'label'       => 'Portfolio Single Slug',
			'description' => 'Enter if you wish to use a different Single Project slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect)',
			'parent'      => $panel,
			'args'        => array(
				'col_width' => 3
			)
		));

	}

	add_action( 'suprema_qodef_options_map', 'suprema_qodef_portfolio_options_map', 12);

}