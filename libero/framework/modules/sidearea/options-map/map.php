<?php

if ( ! function_exists('libero_mikado_sidearea_options_map') ) {

	function libero_mikado_sidearea_options_map() {

		libero_mikado_add_admin_page(
			array(
				'slug' => '_side_area_page',
				'title' => 'Side Area',
				'icon' => 'icon_menu'
			)
		);

		$side_area_panel = libero_mikado_add_admin_panel(
			array(
				'title' => 'Side Area',
				'name' => 'side_area',
				'page' => '_side_area_page'
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $side_area_panel,
				'type' => 'select',
				'name' => 'side_area_type',
				'default_value' => 'side-menu-slide-from-right',
				'label' => 'Side Area Type',
				'description' => 'Choose a type of Side Area',
				'options' => array(
					'side-menu-slide-from-right' => 'Slide from Right Over Content',
					'side-menu-slide-with-content' => 'Slide from Right With Content',
					'side-area-uncovered-from-content' => 'Side Area Uncovered from Content'
				),
				'args' => array(
					'dependence' => true,
					'hide' => array(
						'side-menu-slide-from-right' => '#mkd_side_area_slide_with_content_container',
						'side-menu-slide-with-content' => '#mkd_side_area_width_container',
						'side-area-uncovered-from-content' => '#mkd_side_area_width_container, #mkd_side_area_slide_with_content_container'
					),
					'show' => array(
						'side-menu-slide-from-right' => '#mkd_side_area_width_container',
						'side-menu-slide-with-content' => '#mkd_side_area_slide_with_content_container',
						'side-area-uncovered-from-content' => ''
					)
				)
			)
		);

		$side_area_width_container = libero_mikado_add_admin_container(
			array(
				'parent' => $side_area_panel,
				'name' => 'side_area_width_container',
				'hidden_property' => 'side_area_type',
				'hidden_value' => '',
				'hidden_values' => array(
					'side-menu-slide-with-content',
					'side-area-uncovered-from-content'
				)
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $side_area_width_container,
				'type' => 'text',
				'name' => 'side_area_width',
				'default_value' => '',
				'label' => 'Side Area Width',
				'description' => 'Enter a width for Side Area',
				'args' => array(
					'col_width' => 3,
					'suffix' => '%'
				)
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $side_area_width_container,
				'type' => 'color',
				'name' => 'side_area_content_overlay_color',
				'default_value' => '',
				'label' => 'Content Overlay Background Color',
				'description' => 'Choose a background color for a content overlay',
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $side_area_width_container,
				'type' => 'text',
				'name' => 'side_area_content_overlay_opacity',
				'default_value' => '',
				'label' => 'Content Overlay Background Transparency',
				'description' => 'Choose a transparency for the content overlay background color (0 = fully transparent, 1 = opaque)',
				'args' => array(
					'col_width' => 3
				)
			)
		);

		$side_area_slide_with_content_container = libero_mikado_add_admin_container(
			array(
				'parent' => $side_area_panel,
				'name' => 'side_area_slide_with_content_container',
				'hidden_property' => 'side_area_type',
				'hidden_value' => '',
				'hidden_values' => array(
					'side-menu-slide-from-right',
					'side-area-uncovered-from-content'
				)
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $side_area_slide_with_content_container,
				'type' => 'select',
				'name' => 'side_area_slide_with_content_width',
				'default_value' => 'width-470',
				'label' => 'Side Area Width',
				'description' => 'Choose width for Side Area',
				'options' => array(
					'width-270' => '270px',
					'width-370' => '370px',
					'width-470' => '470px'
				)
			)
		);

//init icon pack hide and show array. It will be populated dinamically from collections array
		$side_area_icon_pack_hide_array = array();
		$side_area_icon_pack_show_array = array();

//do we have some collection added in collections array?
		if (is_array(libero_mikado_icon_collections()->iconCollections) && count(libero_mikado_icon_collections()->iconCollections)) {
			//get collections params array. It will contain values of 'param' property for each collection
			$side_area_icon_collections_params = libero_mikado_icon_collections()->getIconCollectionsParams();

			//foreach collection generate hide and show array
			foreach (libero_mikado_icon_collections()->iconCollections as $dep_collection_key => $dep_collection_object) {
				$side_area_icon_pack_hide_array[$dep_collection_key] = '';

				//we need to include only current collection in show string as it is the only one that needs to show
				$side_area_icon_pack_show_array[$dep_collection_key] = '#mkd_side_area_icon_' . $dep_collection_object->param . '_container';

				//for all collections param generate hide string
				foreach ($side_area_icon_collections_params as $side_area_icon_collections_param) {
					//we don't need to include current one, because it needs to be shown, not hidden
					if ($side_area_icon_collections_param !== $dep_collection_object->param) {
						$side_area_icon_pack_hide_array[$dep_collection_key] .= '#mkd_side_area_icon_' . $side_area_icon_collections_param . '_container,';
					}
				}

				//remove remaining ',' character
				$side_area_icon_pack_hide_array[$dep_collection_key] = rtrim($side_area_icon_pack_hide_array[$dep_collection_key], ',');
			}

		}

		$side_area_icon_style_group = libero_mikado_add_admin_group(
			array(
				'parent' => $side_area_panel,
				'name' => 'side_area_icon_style_group',
				'title' => 'Side Area Icon Style',
				'description' => 'Define styles for Side Area icon'
			)
		);

		$side_area_icon_style_row1 = libero_mikado_add_admin_row(
			array(
				'parent'		=> $side_area_icon_style_group,
				'name'			=> 'side_area_icon_style_row1'
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row1,
				'type' => 'colorsimple',
				'name' => 'side_area_icon_color',
				'default_value' => '',
				'label' => 'Color',
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row1,
				'type' => 'colorsimple',
				'name' => 'side_area_icon_hover_color',
				'default_value' => '',
				'label' => 'Hover Color',
			)
		);

		$icon_spacing_group = libero_mikado_add_admin_group(
			array(
				'parent' => $side_area_panel,
				'name' => 'icon_spacing_group',
				'title' => 'Side Area Icon Spacing',
				'description' => 'Define padding and margin for side area icon'
			)
		);

		$icon_spacing_row = libero_mikado_add_admin_row(
			array(
				'parent'		=> $icon_spacing_group,
				'name'			=> 'icon_spancing_row',
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $icon_spacing_row,
				'type' => 'textsimple',
				'name' => 'side_area_icon_padding_left',
				'default_value' => '',
				'label' => 'Padding Left',
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $icon_spacing_row,
				'type' => 'textsimple',
				'name' => 'side_area_icon_padding_right',
				'default_value' => '',
				'label' => 'Padding Right',
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $icon_spacing_row,
				'type' => 'textsimple',
				'name' => 'side_area_icon_margin_left',
				'default_value' => '',
				'label' => 'Margin Left',
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $icon_spacing_row,
				'type' => 'textsimple',
				'name' => 'side_area_icon_margin_right',
				'default_value' => '',
				'label' => 'Margin Right',
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

        libero_mikado_add_admin_field(
            array(
                'parent'		=> $side_area_panel,
                'type'			=> 'yesno',
                'name'			=> 'enable_side_area_icon_text',
                'default_value'	=> 'yes',
                'label'			=> 'Enable Side Area Icon Text',
                'description'	=> "Enable this option to show 'Menu' text next to search icon in header",
                'args'			=> array(
                    'dependence' => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_enable_side_area_icon_text_container'
                )
            )
        );

        $enable_side_area_icon_text_container = libero_mikado_add_admin_container(
            array(
                'parent'			=> $side_area_panel,
                'name'				=> 'enable_side_area_icon_text_container',
                'hidden_property'	=> 'enable_side_area_icon_text',
                'hidden_value'		=> 'no'
            )
        );

        $enable_side_area_icon_text_group = libero_mikado_add_admin_group(
            array(
                'parent'	=> $enable_side_area_icon_text_container,
                'title'		=> 'Side Area Icon Text',
                'name'		=> 'enable_side_area_icon_text_group',
                'description'	=> 'Define Style for Side Area Icon Text'
            )
        );

        $enable_side_area_icon_text_row = libero_mikado_add_admin_row(
            array(
                'parent'	=> $enable_side_area_icon_text_group,
                'name'		=> 'enable_side_area_icon_text_row'
            )
        );

        libero_mikado_add_admin_field(
            array(
                'parent'		=> $enable_side_area_icon_text_row,
                'type'			=> 'colorsimple',
                'name'			=> 'side_area_icon_text_color',
                'label'			=> 'Text Color',
                'default_value'	=> ''
            )
        );

        libero_mikado_add_admin_field(
            array(
                'parent'		=> $enable_side_area_icon_text_row,
                'type'			=> 'colorsimple',
                'name'			=> 'side_area_icon_text_color_hover',
                'label'			=> 'Text Hover Color',
                'default_value'	=> ''
            )
        );

        libero_mikado_add_admin_field(
            array(
                'parent'		=> $enable_side_area_icon_text_row,
                'type'			=> 'textsimple',
                'name'			=> 'side_area_icon_text_fontsize',
                'label'			=> 'Font Size',
                'default_value'	=> '',
                'args'			=> array(
                    'suffix'	=> 'px'
                )
            )
        );

        libero_mikado_add_admin_field(
            array(
                'parent'		=> $enable_side_area_icon_text_row,
                'type'			=> 'textsimple',
                'name'			=> 'side_area_icon_text_lineheight',
                'label'			=> 'Line Height',
                'default_value'	=> '',
                'args'			=> array(
                    'suffix'	=> 'px'
                )
            )
        );

        $enable_side_area_icon_text_row2 = libero_mikado_add_admin_row(
            array(
                'parent'	=> $enable_side_area_icon_text_group,
                'name'		=> 'enable_side_area_icon_text_row2',
                'next'		=> true
            )
        );

        libero_mikado_add_admin_field(
            array(
                'parent'		=> $enable_side_area_icon_text_row2,
                'type'			=> 'selectblanksimple',
                'name'			=> 'side_area_icon_text_texttransform',
                'label'			=> 'Text Transform',
                'default_value'	=> '',
                'options'		=> libero_mikado_get_text_transform_array()
            )
        );

        libero_mikado_add_admin_field(
            array(
                'parent'		=> $enable_side_area_icon_text_row2,
                'type'			=> 'fontsimple',
                'name'			=> 'side_area_icon_text_google_fonts',
                'label'			=> 'Font Family',
                'default_value'	=> '-1',
            )
        );

        libero_mikado_add_admin_field(
            array(
                'parent'		=> $enable_side_area_icon_text_row2,
                'type'			=> 'selectblanksimple',
                'name'			=> 'side_area_icon_text_fontstyle',
                'label'			=> 'Font Style',
                'default_value'	=> '',
                'options'		=> libero_mikado_get_font_style_array(),
            )
        );

        libero_mikado_add_admin_field(
            array(
                'parent'		=> $enable_side_area_icon_text_row2,
                'type'			=> 'selectblanksimple',
                'name'			=> 'side_area_icon_text_fontweight',
                'label'			=> 'Font Weight',
                'default_value'	=> '',
                'options'		=> libero_mikado_get_font_weight_array(),
            )
        );

        $enable_side_area_icon_text_row3 = libero_mikado_add_admin_row(
            array(
                'parent'	=> $enable_side_area_icon_text_group,
                'name'		=> 'enable_side_area_icon_text_row3',
                'next'		=> true
            )
        );

        libero_mikado_add_admin_field(
            array(
                'parent'		=> $enable_side_area_icon_text_row3,
                'type'			=> 'textsimple',
                'name'			=> 'side_area_icon_text_letterspacing',
                'label'			=> 'Letter Spacing',
                'default_value'	=> '',
                'args'			=> array(
                    'suffix'	=> 'px'
                )
            )
        );

		libero_mikado_add_admin_field(
			array(
				'parent' => $side_area_panel,
				'type' => 'selectblank',
				'name' => 'side_area_aligment',
				'default_value' => '',
				'label' => 'Text Aligment',
				'description' => 'Choose text aligment for side area',
				'options' => array(
					'center' => 'Center',
					'left' => 'Left',
					'right' => 'Right'
				)
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $side_area_panel,
				'type' => 'text',
				'name' => 'side_area_title',
				'default_value' => '',
				'label' => 'Side Area Title',
				'description' => 'Enter a title to appear in Side Area',
				'args' => array(
					'col_width' => 3,
				)
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $side_area_panel,
				'type' => 'color',
				'name' => 'side_area_background_color',
				'default_value' => '',
				'label' => 'Background Color',
				'description' => 'Choose a background color for Side Area',
			)
		);

        libero_mikado_add_admin_field(
            array(
                'parent' => $side_area_panel,
                'type' => 'image',
                'name' => 'side_area_background_image',
                'default_value' => '',
                'label' => 'Background Image',
                'description' => 'Choose a background image for Side Area',
            )
        );

		$padding_group = libero_mikado_add_admin_group(
			array(
				'parent' => $side_area_panel,
				'name' => 'padding_group',
				'title' => 'Padding',
				'description' => 'Define padding for Side Area'
			)
		);

		$padding_row = libero_mikado_add_admin_row(
			array(
				'parent' => $padding_group,
				'name' => 'padding_row',
				'next' => true
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $padding_row,
				'type' => 'textsimple',
				'name' => 'side_area_padding_top',
				'default_value' => '',
				'label' => 'Top Padding',
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $padding_row,
				'type' => 'textsimple',
				'name' => 'side_area_padding_right',
				'default_value' => '',
				'label' => 'Right Padding',
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $padding_row,
				'type' => 'textsimple',
				'name' => 'side_area_padding_bottom',
				'default_value' => '',
				'label' => 'Bottom Padding',
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $padding_row,
				'type' => 'textsimple',
				'name' => 'side_area_padding_left',
				'default_value' => '',
				'label' => 'Left Padding',
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $side_area_panel,
				'type' => 'select',
				'name' => 'side_area_close_icon',
				'default_value' => 'light',
				'label' => 'Close Icon Style',
				'description' => 'Choose a type of close icon',
				'options' => array(
					'light' => 'Light',
					'dark' => 'Dark'
				)
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $side_area_panel,
				'type' => 'text',
				'name' => 'side_area_close_icon_size',
				'default_value' => '',
				'label' => 'Close Icon Size',
				'description' => 'Define close icon size',
				'args' => array(
					'col_width' => 3,
					'suffix' => 'px'
				)
			)
		);

		$title_group = libero_mikado_add_admin_group(
			array(
				'parent' => $side_area_panel,
				'name' => 'title_group',
				'title' => 'Title',
				'description' => 'Define Style for Side Area title'
			)
		);

		$title_row_1 = libero_mikado_add_admin_row(
			array(
				'parent' => $title_group,
				'name' => 'title_row_1',
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $title_row_1,
				'type' => 'colorsimple',
				'name' => 'side_area_title_color',
				'default_value' => '',
				'label' => 'Text Color',
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $title_row_1,
				'type' => 'textsimple',
				'name' => 'side_area_title_fontsize',
				'default_value' => '',
				'label' => 'Font Size',
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $title_row_1,
				'type' => 'textsimple',
				'name' => 'side_area_title_lineheight',
				'default_value' => '',
				'label' => 'Line Height',
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $title_row_1,
				'type' => 'selectblanksimple',
				'name' => 'side_area_title_texttransform',
				'default_value' => '',
				'label' => 'Text Transform',
				'options' => libero_mikado_get_text_transform_array()
			)
		);

		$title_row_2 = libero_mikado_add_admin_row(
			array(
				'parent' => $title_group,
				'name' => 'title_row_2',
				'next' => true
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $title_row_2,
				'type' => 'fontsimple',
				'name' => 'side_area_title_google_fonts',
				'default_value' => '-1',
				'label' => 'Font Family',
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $title_row_2,
				'type' => 'selectblanksimple',
				'name' => 'side_area_title_fontstyle',
				'default_value' => '',
				'label' => 'Font Style',
				'options' => libero_mikado_get_font_style_array()
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $title_row_2,
				'type' => 'selectblanksimple',
				'name' => 'side_area_title_fontweight',
				'default_value' => '',
				'label' => 'Font Weight',
				'options' => libero_mikado_get_font_weight_array()
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $title_row_2,
				'type' => 'textsimple',
				'name' => 'side_area_title_letterspacing',
				'default_value' => '',
				'label' => 'Letter Spacing',
				'args' => array(
					'suffix' => 'px'
				)
			)
		);


		$text_group = libero_mikado_add_admin_group(
			array(
				'parent' => $side_area_panel,
				'name' => 'text_group',
				'title' => 'Text',
				'description' => 'Define Style for Side Area text'
			)
		);

		$text_row_1 = libero_mikado_add_admin_row(
			array(
				'parent' => $text_group,
				'name' => 'text_row_1',
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $text_row_1,
				'type' => 'colorsimple',
				'name' => 'side_area_text_color',
				'default_value' => '',
				'label' => 'Text Color',
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $text_row_1,
				'type' => 'textsimple',
				'name' => 'side_area_text_fontsize',
				'default_value' => '',
				'label' => 'Font Size',
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $text_row_1,
				'type' => 'textsimple',
				'name' => 'side_area_text_lineheight',
				'default_value' => '',
				'label' => 'Line Height',
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $text_row_1,
				'type' => 'selectblanksimple',
				'name' => 'side_area_text_texttransform',
				'default_value' => '',
				'label' => 'Text Transform',
				'options' => libero_mikado_get_text_transform_array()
			)
		);

		$text_row_2 = libero_mikado_add_admin_row(
			array(
				'parent' => $text_group,
				'name' => 'text_row_2',
				'next' => true
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $text_row_2,
				'type' => 'fontsimple',
				'name' => 'side_area_text_google_fonts',
				'default_value' => '-1',
				'label' => 'Font Family',
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $text_row_2,
				'type' => 'fontsimple',
				'name' => 'side_area_text_google_fonts',
				'default_value' => '-1',
				'label' => 'Font Family',
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $text_row_2,
				'type' => 'selectblanksimple',
				'name' => 'side_area_text_fontstyle',
				'default_value' => '',
				'label' => 'Font Style',
				'options' => libero_mikado_get_font_style_array()
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $text_row_2,
				'type' => 'selectblanksimple',
				'name' => 'side_area_text_fontweight',
				'default_value' => '',
				'label' => 'Font Weight',
				'options' => libero_mikado_get_font_weight_array()
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $text_row_2,
				'type' => 'textsimple',
				'name' => 'side_area_text_letterspacing',
				'default_value' => '',
				'label' => 'Letter Spacing',
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		$widget_links_group = libero_mikado_add_admin_group(
			array(
				'parent' => $side_area_panel,
				'name' => 'widget_links_group',
				'title' => 'Link Style',
				'description' => 'Define styles for Side Area widget links'
			)
		);

		$widget_links_row_1 = libero_mikado_add_admin_row(
			array(
				'parent' => $widget_links_group,
				'name' => 'widget_links_row_1',
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $widget_links_row_1,
				'type' => 'colorsimple',
				'name' => 'sidearea_link_color',
				'default_value' => '',
				'label' => 'Text Color',
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $widget_links_row_1,
				'type' => 'textsimple',
				'name' => 'sidearea_link_font_size',
				'default_value' => '',
				'label' => 'Font Size',
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $widget_links_row_1,
				'type' => 'textsimple',
				'name' => 'sidearea_link_line_height',
				'default_value' => '',
				'label' => 'Line Height',
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $widget_links_row_1,
				'type' => 'selectblanksimple',
				'name' => 'sidearea_link_text_transform',
				'default_value' => '',
				'label' => 'Text Transform',
				'options' => libero_mikado_get_text_transform_array()
			)
		);

		$widget_links_row_2 = libero_mikado_add_admin_row(
			array(
				'parent' => $widget_links_group,
				'name' => 'widget_links_row_2',
				'next' => true
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $widget_links_row_2,
				'type' => 'fontsimple',
				'name' => 'sidearea_link_font_family',
				'default_value' => '-1',
				'label' => 'Font Family',
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $widget_links_row_2,
				'type' => 'selectblanksimple',
				'name' => 'sidearea_link_font_style',
				'default_value' => '',
				'label' => 'Font Style',
				'options' => libero_mikado_get_font_style_array()
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $widget_links_row_2,
				'type' => 'selectblanksimple',
				'name' => 'sidearea_link_font_weight',
				'default_value' => '',
				'label' => 'Font Weight',
				'options' => libero_mikado_get_font_weight_array()
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $widget_links_row_2,
				'type' => 'textsimple',
				'name' => 'sidearea_link_letter_spacing',
				'default_value' => '',
				'label' => 'Letter Spacing',
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		$widget_links_row_3 = libero_mikado_add_admin_row(
			array(
				'parent' => $widget_links_group,
				'name' => 'widget_links_row_3',
				'next' => true
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $widget_links_row_3,
				'type' => 'colorsimple',
				'name' => 'sidearea_link_hover_color',
				'default_value' => '',
				'label' => 'Hover Color',
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $side_area_panel,
				'type' => 'yesno',
				'name' => 'side_area_enable_bottom_border',
				'default_value' => 'no',
				'label' => 'Border Bottom on Elements',
				'description' => 'Enable border bottom on elements in side area',
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkd_side_area_bottom_border_container'
				)
			)
		);

		$side_area_bottom_border_container = libero_mikado_add_admin_container(
			array(
				'parent' => $side_area_panel,
				'name' => 'side_area_bottom_border_container',
				'hidden_property' => 'side_area_enable_bottom_border',
				'hidden_value' => 'no'
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $side_area_bottom_border_container,
				'type' => 'color',
				'name' => 'side_area_bottom_border_color',
				'default_value' => '',
				'label' => 'Border Bottom Color',
				'description' => 'Choose color for border bottom on elements in sidearea'
			)
		);

	}

	add_action('libero_mikado_options_map', 'libero_mikado_sidearea_options_map', 4);

}