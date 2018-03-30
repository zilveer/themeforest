<?php

if ( ! function_exists('libero_mikado_search_options_map') ) {

	function libero_mikado_search_options_map() {

		libero_mikado_add_admin_page(
			array(
				'slug' => '_search_page',
				'title' => 'Search',
				'icon' => 'icon_search'
			)
		);

		$search_panel = libero_mikado_add_admin_panel(
			array(
				'title' => 'Search',
				'name' => 'search',
				'page' => '_search_page'
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $search_panel,
				'type'			=> 'select',
				'name'			=> 'search_type',
				'default_value'	=> 'search-covers-header',
				'label' 		=> 'Select Search Type',
				'description' 	=> "Choose a type of Select search bar (Note: Slide From Header Bottom search type doesn't work with transparent header)",
				'options' 		=> array(
					'search-slides-from-header-bottom' => 'Slide From Header Bottom',
					'search-covers-header' => 'Search Covers Header',
					'fullscreen-search' => 'Fullscreen Search',
					'search-slides-from-window-top' => 'Slide from Window Top'
				),
				'args'			=> array(
					'dependence'=> true,
					'hide'		=> array(
						'search-slides-from-header-bottom' => '#mkd_search_animation_container',
						'search-covers-header' => '#mkd_search_height_container, #mkd_search_animation_container',
						'fullscreen-search' => '#mkd_search_height_container',
						'search-slides-from-window-top' => '#mkd_search_height_container, #mkd_search_animation_container'
					),
					'show'		=> array(
						'search-slides-from-header-bottom' => '#mkd_search_height_container',
						'search-covers-header' => '',
						'fullscreen-search' => '#mkd_search_animation_container',
						'search-slides-from-window-top' => ''
					)
				)
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $search_panel,
				'type'			=> 'select',
				'name'			=> 'search_icon_pack',
				'default_value'	=> 'ion_icons',
				'label'			=> 'Search Icon Pack',
				'description'	=> 'Choose icon pack for search icon',
				'options'		=> libero_mikado_icon_collections()->getIconCollectionsExclude(array('linea_icons', 'dripicons'))
			)
		);

		$search_height_container = libero_mikado_add_admin_container(
			array(
				'parent'			=> $search_panel,
				'name'				=> 'search_height_container',
				'hidden_property'	=> 'search_type',
				'hidden_value'		=> '',
				'hidden_values'		=> array(
					'search-covers-header',
					'fullscreen-search',
					'search-slides-from-window-top'
				)
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $search_height_container,
				'type'			=> 'text',
				'name'			=> 'search_height',
				'default_value'	=> '',
				'label'			=> 'Search bar height',
				'description'	=> 'Set search bar height',
				'args'			=> array(
					'col_width' => 3,
					'suffix'	=> 'px'
				)
			)
		);

		$search_animation_container = libero_mikado_add_admin_container(
			array(
				'parent'			=> $search_panel,
				'name'				=> 'search_animation_container',
				'hidden_property'	=> 'search_type',
				'hidden_value'		=> '',
				'hidden_values'		=> array(
					'search-covers-header',
					'search-slides-from-header-bottom',
					'search-slides-from-window-top'
				)
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $search_animation_container,
				'type'			=> 'select',
				'name'			=> 'search_animation',
				'default_value'	=> 'search-fade',
				'label'			=> 'Fullscreen Search Overlay Animation',
				'description'	=> 'Choose animation for fullscreen search overlay',
				'options'		=> array(
					'search-fade'			=> 'Fade',
					'search-from-circle'	=> 'Circle appear'
				)
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $search_panel,
				'type'			=> 'yesno',
				'name'			=> 'search_in_grid',
				'default_value'	=> 'yes',
				'label'			=> 'Search area in grid',
				'description'	=> 'Set search area to be in grid',
			)
		);

		libero_mikado_add_admin_section_title(
			array(
				'parent' 	=> $search_panel,
				'name'		=> 'initial_header_icon_title',
				'title'		=> 'Initial Search Icon in Header'
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $search_panel,
				'type'			=> 'text',
				'name'			=> 'header_search_icon_size',
				'default_value'	=> '',
				'label'			=> 'Icon Size',
				'description'	=> 'Set size for icon',
				'args'			=> array(
					'col_width' => 3,
					'suffix'	=> 'px'
				)
			)
		);

		$search_icon_color_group = libero_mikado_add_admin_group(
			array(
				'parent'	=> $search_panel,
				'title'		=> 'Icon Colors',
				'description'	=> 'Define color style for icon',
				'name'		=> 'search_icon_color_group'
			)
		);

		$search_icon_color_row = libero_mikado_add_admin_row(
			array(
				'parent'	=> $search_icon_color_group,
				'name'		=> 'search_icon_color_row'
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'	=> $search_icon_color_row,
				'type'		=> 'colorsimple',
				'name'		=> 'header_search_icon_color',
				'label'		=> 'Color'
			)
		);
		libero_mikado_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'		=> 'colorsimple',
				'name'		=> 'header_search_icon_hover_color',
				'label'		=> 'Hover Color'
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $search_panel,
				'type'			=> 'yesno',
				'name'			=> 'enable_search_icon_text',
				'default_value'	=> 'yes',
				'label'			=> 'Enable Search Icon Text',
				'description'	=> "Enable this option to show 'Search' text next to search icon in header",
				'args'			=> array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkd_enable_search_icon_text_container'
				)
			)
		);

		$enable_search_icon_text_container = libero_mikado_add_admin_container(
			array(
				'parent'			=> $search_panel,
				'name'				=> 'enable_search_icon_text_container',
				'hidden_property'	=> 'enable_search_icon_text',
				'hidden_value'		=> 'no'
			)
		);

		$enable_search_icon_text_group = libero_mikado_add_admin_group(
			array(
				'parent'	=> $enable_search_icon_text_container,
				'title'		=> 'Search Icon Text',
				'name'		=> 'enable_search_icon_text_group',
				'description'	=> 'Define Style for Search Icon Text'
			)
		);

		$enable_search_icon_text_row = libero_mikado_add_admin_row(
			array(
				'parent'	=> $enable_search_icon_text_group,
				'name'		=> 'enable_search_icon_text_row'
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row,
				'type'			=> 'colorsimple',
				'name'			=> 'search_icon_text_color',
				'label'			=> 'Text Color',
				'default_value'	=> ''
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row,
				'type'			=> 'colorsimple',
				'name'			=> 'search_icon_text_color_hover',
				'label'			=> 'Text Hover Color',
				'default_value'	=> ''
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row,
				'type'			=> 'textsimple',
				'name'			=> 'search_icon_text_fontsize',
				'label'			=> 'Font Size',
				'default_value'	=> '',
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row,
				'type'			=> 'textsimple',
				'name'			=> 'search_icon_text_lineheight',
				'label'			=> 'Line Height',
				'default_value'	=> '',
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);

		$enable_search_icon_text_row2 = libero_mikado_add_admin_row(
			array(
				'parent'	=> $enable_search_icon_text_group,
				'name'		=> 'enable_search_icon_text_row2',
				'next'		=> true
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row2,
				'type'			=> 'selectblanksimple',
				'name'			=> 'search_icon_text_texttransform',
				'label'			=> 'Text Transform',
				'default_value'	=> '',
				'options'		=> libero_mikado_get_text_transform_array()
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row2,
				'type'			=> 'fontsimple',
				'name'			=> 'search_icon_text_google_fonts',
				'label'			=> 'Font Family',
				'default_value'	=> '-1',
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row2,
				'type'			=> 'selectblanksimple',
				'name'			=> 'search_icon_text_fontstyle',
				'label'			=> 'Font Style',
				'default_value'	=> '',
				'options'		=> libero_mikado_get_font_style_array(),
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row2,
				'type'			=> 'selectblanksimple',
				'name'			=> 'search_icon_text_fontweight',
				'label'			=> 'Font Weight',
				'default_value'	=> '',
				'options'		=> libero_mikado_get_font_weight_array(),
			)
		);

		$enable_search_icon_text_row3 = libero_mikado_add_admin_row(
			array(
				'parent'	=> $enable_search_icon_text_group,
				'name'		=> 'enable_search_icon_text_row3',
				'next'		=> true
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row3,
				'type'			=> 'textsimple',
				'name'			=> 'search_icon_text_letterspacing',
				'label'			=> 'Letter Spacing',
				'default_value'	=> '',
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);

		$search_icon_spacing_group = libero_mikado_add_admin_group(
			array(
				'parent'	=> $search_panel,
				'title'		=> 'Icon Spacing',
				'description'	=> 'Define padding and margins for Search icon',
				'name'		=> 'search_icon_spacing_group'
			)
		);

		$search_icon_spacing_row = libero_mikado_add_admin_row(
			array(
				'parent'	=> $search_icon_spacing_group,
				'name'		=> 'search_icon_spacing_row'
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $search_icon_spacing_row,
				'type'			=> 'textsimple',
				'name'			=> 'search_padding_left',
				'default_value'	=> '',
				'label'			=> 'Padding Left',
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $search_icon_spacing_row,
				'type'			=> 'textsimple',
				'name'			=> 'search_padding_right',
				'default_value'	=> '',
				'label'			=> 'Padding Right',
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $search_icon_spacing_row,
				'type'			=> 'textsimple',
				'name'			=> 'search_margin_left',
				'default_value'	=> '',
				'label'			=> 'Margin Left',
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $search_icon_spacing_row,
				'type'			=> 'textsimple',
				'name'			=> 'search_margin_right',
				'default_value'	=> '',
				'label'			=> 'Margin Right',
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);

		libero_mikado_add_admin_section_title(
			array(
				'parent' 	=> $search_panel,
				'name'		=> 'search_form_title',
				'title'		=> 'Search Bar'
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $search_panel,
				'type'			=> 'color',
				'name'			=> 'search_background_color',
				'default_value'	=> '',
				'label'			=> 'Background Color',
				'description'	=> 'Choose a background color for Select search bar'
			)
		);

		$search_input_text_group = libero_mikado_add_admin_group(
			array(
				'parent'	=> $search_panel,
				'title'		=> 'Search Input Text',
				'description'	=> 'Define style for search text',
				'name'		=> 'search_input_text_group'
			)
		);

		$search_input_text_row = libero_mikado_add_admin_row(
			array(
				'parent'	=> $search_input_text_group,
				'name'		=> 'search_input_text_row'
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $search_input_text_row,
				'type'			=> 'colorsimple',
				'name'			=> 'search_text_color',
				'default_value'	=> '',
				'label'			=> 'Text Color',
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $search_input_text_row,
				'type'			=> 'colorsimple',
				'name'			=> 'search_text_disabled_color',
				'default_value'	=> '',
				'label'			=> 'Disabled Text Color',
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $search_input_text_row,
				'type'			=> 'textsimple',
				'name'			=> 'search_text_fontsize',
				'default_value'	=> '',
				'label'			=> 'Font Size',
				'args'			=> array(
					'suffix' => 'px'
				)
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $search_input_text_row,
				'type'			=> 'selectblanksimple',
				'name'			=> 'search_text_texttransform',
				'default_value'	=> '',
				'label'			=> 'Text Transform',
				'options'		=> libero_mikado_get_text_transform_array()
			)
		);

		$search_input_text_row2 = libero_mikado_add_admin_row(
			array(
				'parent'	=> $search_input_text_group,
				'name'		=> 'search_input_text_row2'
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $search_input_text_row2,
				'type'			=> 'fontsimple',
				'name'			=> 'search_text_google_fonts',
				'default_value'	=> '-1',
				'label'			=> 'Font Family',
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $search_input_text_row2,
				'type'			=> 'selectblanksimple',
				'name'			=> 'search_text_fontstyle',
				'default_value'	=> '',
				'label'			=> 'Font Style',
				'options'		=> libero_mikado_get_font_style_array(),
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $search_input_text_row2,
				'type'			=> 'selectblanksimple',
				'name'			=> 'search_text_fontweight',
				'default_value'	=> '',
				'label'			=> 'Font Weight',
				'options'		=> libero_mikado_get_font_weight_array()
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $search_input_text_row2,
				'type'			=> 'textsimple',
				'name'			=> 'search_text_letterspacing',
				'default_value'	=> '',
				'label'			=> 'Letter Spacing',
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);

		$search_label_text_group = libero_mikado_add_admin_group(
			array(
				'parent'	=> $search_panel,
				'title'		=> 'Search Label Text',
				'description'	=> 'Define style for search label text',
				'name'		=> 'search_label_text_group'
			)
		);

		$search_label_text_row = libero_mikado_add_admin_row(
			array(
				'parent'	=> $search_label_text_group,
				'name'		=> 'search_label_text_row'
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $search_label_text_row,
				'type'			=> 'colorsimple',
				'name'			=> 'search_label_text_color',
				'default_value'	=> '',
				'label'			=> 'Text Color',
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $search_label_text_row,
				'type'			=> 'textsimple',
				'name'			=> 'search_label_text_fontsize',
				'default_value'	=> '',
				'label'			=> 'Font Size',
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $search_label_text_row,
				'type'			=> 'selectblanksimple',
				'name'			=> 'search_label_text_texttransform',
				'default_value'	=> '',
				'label'			=> 'Text Transform',
				'options'		=> libero_mikado_get_text_transform_array()
			)
		);

		$search_label_text_row2 = libero_mikado_add_admin_row(
			array(
				'parent'	=> $search_label_text_group,
				'name'		=> 'search_label_text_row2',
				'next'		=> true
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $search_label_text_row2,
				'type'			=> 'fontsimple',
				'name'			=> 'search_label_text_google_fonts',
				'default_value'	=> '-1',
				'label'			=> 'Font Family',
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $search_label_text_row2,
				'type'			=> 'selectblanksimple',
				'name'			=> 'search_label_text_fontstyle',
				'default_value'	=> '',
				'label'			=> 'Font Style',
				'options'		=> libero_mikado_get_font_style_array()
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $search_label_text_row2,
				'type'			=> 'selectblanksimple',
				'name'			=> 'search_label_text_fontweight',
				'default_value'	=> '',
				'label'			=> 'Font Weight',
				'options'		=> libero_mikado_get_font_weight_array()
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $search_label_text_row2,
				'type'			=> 'textsimple',
				'name'			=> 'search_label_text_letterspacing',
				'default_value'	=> '',
				'label'			=> 'Letter Spacing',
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);

		$search_icon_group = libero_mikado_add_admin_group(
			array(
				'parent'	=> $search_panel,
				'title'		=> 'Search Icon',
				'description'	=> 'Define style for search icon',
				'name'		=> 'search_icon_group'
			)
		);

		$search_icon_row = libero_mikado_add_admin_row(
			array(
				'parent'	=> $search_icon_group,
				'name'		=> 'search_icon_row'
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $search_icon_row,
				'type'			=> 'colorsimple',
				'name'			=> 'search_icon_color',
				'default_value'	=> '',
				'label'			=> 'Icon Color',
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $search_icon_row,
				'type'			=> 'colorsimple',
				'name'			=> 'search_icon_hover_color',
				'default_value'	=> '',
				'label'			=> 'Icon Hover Color',
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $search_icon_row,
				'type'			=> 'colorsimple',
				'name'			=> 'search_icon_disabled_color',
				'default_value'	=> '',
				'label'			=> 'Icon Disabled Color',
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $search_icon_row,
				'type'			=> 'textsimple',
				'name'			=> 'search_icon_size',
				'default_value'	=> '',
				'label'			=> 'Icon Size',
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);

		$search_close_icon_group = libero_mikado_add_admin_group(
			array(
				'parent'	=> $search_panel,
				'title'		=> 'Search Close',
				'description'	=> 'Define style for search close icon',
				'name'		=> 'search_close_icon_group'
			)
		);

		$search_close_icon_row = libero_mikado_add_admin_row(
			array(
				'parent'	=> $search_close_icon_group,
				'name'		=> 'search_icon_row'
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $search_close_icon_row,
				'type'			=> 'colorsimple',
				'name'			=> 'search_close_color',
				'label'			=> 'Icon Color',
				'default_value'	=> ''
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $search_close_icon_row,
				'type'			=> 'colorsimple',
				'name'			=> 'search_close_hover_color',
				'label'			=> 'Icon Hover Color',
				'default_value'	=> ''
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent'		=> $search_close_icon_row,
				'type'			=> 'textsimple',
				'name'			=> 'search_close_size',
				'label'			=> 'Icon Size',
				'default_value'	=> '',
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);

	}

	add_action('libero_mikado_options_map', 'libero_mikado_search_options_map', 5);

}