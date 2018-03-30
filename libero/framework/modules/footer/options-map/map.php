<?php

if ( ! function_exists('libero_mikado_footer_options_map') ) {
	/**
	 * Add footer options
	 */
	function libero_mikado_footer_options_map() {

		libero_mikado_add_admin_page(
			array(
				'slug' => '_footer_page',
				'title' => 'Footer',
				'icon' => 'icon_cone_alt'
			)
		);

		$footer_panel = libero_mikado_add_admin_panel(
			array(
				'title' => 'Footer',
				'name' => 'footer',
				'page' => '_footer_page'
			)
		);

		libero_mikado_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'uncovering_footer',
				'default_value' => 'yes',
				'label' => 'Uncovering Footer',
				'description' => 'Enabling this option will make Footer gradually appear on scroll',
				'parent' => $footer_panel,
			)
		);

		libero_mikado_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'footer_in_grid',
				'default_value' => 'no',
				'label' => 'Footer in Grid',
				'description' => 'Enabling this option will place Footer content in grid',
				'parent' => $footer_panel,
			)
		);

		libero_mikado_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'show_footer_top',
				'default_value' => 'yes',
				'label' => 'Show Footer Top',
				'description' => 'Enabling this option will show Footer Top area',
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkd_show_footer_top_container'
				),
				'parent' => $footer_panel,
			)
		);

		$show_footer_top_container = libero_mikado_add_admin_container(
			array(
				'name' => 'show_footer_top_container',
				'hidden_property' => 'show_footer_top',
				'hidden_value' => 'no',
				'parent' => $footer_panel
			)
		);

		libero_mikado_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'footer_top_columns',
				'default_value' => '4',
				'label' => 'Footer Top Columns',
				'description' => 'Choose number of columns for Footer Top area',
				'options' => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'5' => '3(25%+25%+50%)',
					'6' => '3(50%+25%+25%)',
					'4' => '4'
				),
				'parent' => $show_footer_top_container,
			)
		);

		libero_mikado_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'footer_top_columns_alignment',
				'default_value' => '',
				'label' => 'Footer Top Columns Alignment',
				'description' => 'Text Alignment in Footer Columns',
				'options' => array(
					'left' => 'Left',
					'center' => 'Center',
					'right' => 'Right'
				),
				'parent' => $show_footer_top_container,
			)
		);

		libero_mikado_add_admin_field(
			array(
				'type' => 'image',
				'name' => 'footer_top_background_image',
				'default_value' => '',
				'label' => 'Footer Top Background Image',
				'description' => 'Choose background image',
				'parent' => $show_footer_top_container,
			)
		);

		libero_mikado_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'show_footer_bottom',
				'default_value' => 'yes',
				'label' => 'Show Footer Bottom',
				'description' => 'Enabling this option will show Footer Bottom area',
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkd_show_footer_bottom_container'
				),
				'parent' => $footer_panel,
			)
		);

		$show_footer_bottom_container = libero_mikado_add_admin_container(
			array(
				'name' => 'show_footer_bottom_container',
				'hidden_property' => 'show_footer_bottom',
				'hidden_value' => 'no',
				'parent' => $footer_panel
			)
		);


		libero_mikado_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'footer_bottom_columns',
				'default_value' => '3',
				'label' => 'Footer Bottom Columns',
				'description' => 'Choose number of columns for Footer Bottom area',
				'options' => array(
					'1' => '1',
					'2' => '2',
					'3' => '3'
				),
				'parent' => $show_footer_bottom_container,
			)
		);

	}

	add_action( 'libero_mikado_options_map', 'libero_mikado_footer_options_map', 8);

}