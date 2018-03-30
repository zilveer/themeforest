<?php

if ( ! function_exists('flow_elated_footer_options_map') ) {
	/**
	 * Add footer options
	 */
	function flow_elated_footer_options_map() {

		flow_elated_add_admin_page(
			array(
				'slug' => '_footer_page',
				'title' => 'Footer',
				'icon' => 'fa fa-sort-amount-asc'
			)
		);

		$footer_panel = flow_elated_add_admin_panel(
			array(
				'title' => 'Footer',
				'name' => 'footer',
				'page' => '_footer_page'
			)
		);

		flow_elated_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'uncovering_footer',
				'default_value' => 'no',
				'label' => 'Uncovering Footer',
				'description' => 'Enabling this option will make Footer gradually appear on scroll',
				'parent' => $footer_panel,
			)
		);

		flow_elated_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'footer_in_grid',
				'default_value' => 'yes',
				'label' => 'Footer in Grid',
				'description' => 'Enabling this option will place Footer content in grid',
				'parent' => $footer_panel,
			)
		);

		flow_elated_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'show_footer_top',
				'default_value' => 'yes',
				'label' => 'Show Footer Top',
				'description' => 'Enabling this option will show Footer Top area',
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#eltd_show_footer_top_container'
				),
				'parent' => $footer_panel,
			)
		);

		$show_footer_top_container = flow_elated_add_admin_container(
			array(
				'name' => 'show_footer_top_container',
				'hidden_property' => 'show_footer_top',
				'hidden_value' => 'no',
				'parent' => $footer_panel
			)
		);

		flow_elated_add_admin_field(
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

		flow_elated_add_admin_field(
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
		flow_elated_add_admin_field(
			array(
				'type' => 'color',
				'name' => 'footer_top_background_color',
				'default_value' => '',
				'label' => 'Footer Top Background Color',
				'description' => '',
				'parent' => $show_footer_top_container,
			)
		);
		flow_elated_add_admin_field(
			array(
				'type' => 'text',
				'name' => 'footer_top_padding',
				'default_value' => '',
				'label' => 'Footer Top Padding',
				'description' => 'Please insert padding in format (top right bottom left) i.e. 5px 5px 5px 5px or 5% 5% 5% 5%',
				'parent' => $show_footer_top_container,
				'args' => array('col_width' => 3)
			)
		);

		flow_elated_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'show_footer_bottom',
				'default_value' => 'yes',
				'label' => 'Show Footer Bottom',
				'description' => 'Enabling this option will show Footer Bottom area',
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#eltd_show_footer_bottom_container'
				),
				'parent' => $footer_panel,
			)
		);

		$show_footer_bottom_container = flow_elated_add_admin_container(
			array(
				'name' => 'show_footer_bottom_container',
				'hidden_property' => 'show_footer_bottom',
				'hidden_value' => 'no',
				'parent' => $footer_panel
			)
		);


		flow_elated_add_admin_field(
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

	add_action( 'flow_elated_options_map', 'flow_elated_footer_options_map', 12);

}