<?php

$title_meta_box = libero_mikado_add_meta_box(
    array(
        'scope' => array('page', 'portfolio-item', 'post'),
        'title' => 'Title',
        'name' => 'title_meta'
    )
);

    libero_mikado_add_meta_box_field(
        array(
            'name' => 'mkd_show_title_area_meta',
            'type' => 'select',
            'default_value' => '',
            'label' => 'Show Title Area',
            'description' => 'Disabling this option will turn off page title area',
            'parent' => $title_meta_box,
            'options' => array(
                '' => '',
                'no' => 'No',
                'yes' => 'Yes'
            ),
            'args' => array(
                "dependence" => true,
                "hide" => array(
                    "" => "",
                    "no" => "#mkd_mkd_show_title_area_meta_container",
                    "yes" => ""
                ),
                "show" => array(
                    "" => "#mkd_mkd_show_title_area_meta_container",
                    "no" => "",
                    "yes" => "#mkd_mkd_show_title_area_meta_container"
                )
            )
        )
    );

    $show_title_area_meta_container = libero_mikado_add_admin_container(
        array(
            'parent' => $title_meta_box,
            'name' => 'mkd_show_title_area_meta_container',
            'hidden_property' => 'mkd_show_title_area_meta',
            'hidden_value' => 'no'
        )
    );

        libero_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_title_area_type_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => 'Title Area Type',
                'description' => 'Choose title type',
                'parent' => $show_title_area_meta_container,
                'options' => array(
                    '' => '',
                    'standard' => 'Standard',
                    'breadcrumb' => 'Breadcrumb'
                ),
                'args' => array(
                    "dependence" => true,
                    "hide" => array(
                        "standard" => "",
                        "standard" => "",
                        "breadcrumb" => "#mkd_mkd_title_area_type_meta_container"
                    ),
                    "show" => array(
                        "" => "#mkd_mkd_title_area_type_meta_container",
                        "standard" => "#mkd_mkd_title_area_type_meta_container",
                        "breadcrumb" => ""
                    )
                )
            )
        );

        $title_area_type_meta_container = libero_mikado_add_admin_container(
            array(
                'parent' => $show_title_area_meta_container,
                'name' => 'mkd_title_area_type_meta_container',
                'hidden_property' => 'mkd_title_area_type_meta',
                'hidden_value' => '',
                'hidden_values' => array('breadcrumb'),
            )
        );

            libero_mikado_add_meta_box_field(
                array(
                    'name' => 'mkd_title_area_enable_breadcrumbs_meta',
                    'type' => 'select',
                    'default_value' => '',
                    'label' => 'Enable Breadcrumbs',
                    'description' => 'This option will display Breadcrumbs in Title Area',
                    'parent' => $title_area_type_meta_container,
                    'options' => array(
                        '' => '',
                        'no' => 'No',
                        'yes' => 'Yes'
                    ),
                )
            );

        libero_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_title_area_animation_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => 'Animations',
                'description' => 'Choose an animation for Title Area',
                'parent' => $show_title_area_meta_container,
                'options' => array(
                    '' => '',
                    'no' => 'No Animation',
                    'right-left' => 'Text right to left',
                    'left-right' => 'Text left to right'
                )
            )
        );

        libero_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_title_area_vertial_alignment_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => 'Vertical Alignment',
                'description' => 'Specify title vertical alignment',
                'parent' => $show_title_area_meta_container,
                'options' => array(
                    '' => '',
                    'header_bottom' => 'From Bottom of Header',
                    'window_top' => 'From Window Top'
                )
            )
        );

        libero_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_title_area_content_alignment_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => 'Horizontal Alignment',
                'description' => 'Specify title horizontal alignment',
                'parent' => $show_title_area_meta_container,
                'options' => array(
                    '' => '',
                    'left' => 'Left',
                    'center' => 'Center',
                    'right' => 'Right'
                )
            )
        );

        libero_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_title_text_color_meta',
                'type' => 'color',
                'label' => 'Title Color',
                'description' => 'Choose a color for title text',
                'parent' => $show_title_area_meta_container
            )
        );

        libero_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_title_text_fsize_meta',
                'type' => 'text',
                'default_value' => '',
                'label' => 'Title Font Size',
                'description' => 'Enter title font size',
                'parent' => $show_title_area_meta_container,
                'args' => array(
                    'col_width' => 3,
                    'suffix' => 'px'
                )
            )
        );

        libero_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_title_breadcrumb_color_meta',
                'type' => 'color',
                'label' => 'Breadcrumb Color',
                'description' => 'Choose a color for breadcrumb text',
                'parent' => $show_title_area_meta_container
            )
        );

        libero_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_title_area_background_color_meta',
                'type' => 'color',
                'label' => 'Background Color',
                'description' => 'Choose a background color for Title Area',
                'parent' => $show_title_area_meta_container
            )
        );

        libero_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_hide_background_image_meta',
                'type' => 'yesno',
                'default_value' => 'no',
                'label' => 'Hide Background Image',
                'description' => 'Enable this option to hide background image in Title Area',
                'parent' => $show_title_area_meta_container,
                'args' => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "#mkd_mkd_hide_background_image_meta_container",
                    "dependence_show_on_yes" => ""
                )
            )
        );

        $hide_background_image_meta_container = libero_mikado_add_admin_container(
            array(
                'parent' => $show_title_area_meta_container,
                'name' => 'mkd_hide_background_image_meta_container',
                'hidden_property' => 'mkd_hide_background_image_meta',
                'hidden_value' => 'yes'
            )
        );

        libero_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_title_area_background_image_meta',
                'type' => 'image',
                'label' => 'Background Image',
                'description' => 'Choose an Image for Title Area',
                'parent' => $hide_background_image_meta_container
            )
        );

        libero_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_title_area_background_as_pattern_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => 'Background Image as Pattern',
                'description' => 'Choose whether to make background image behave as pattern',
                'parent' => $hide_background_image_meta_container,
                'options' => array(
                    "" => "",
                    "no" => "No",
                    "yes" => "Yes"
                )
            )
        );

        libero_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_title_area_background_image_responsive_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => 'Background Responsive Image',
                'description' => 'Enabling this option will make Title background image responsive',
                'parent' => $hide_background_image_meta_container,
                'options' => array(
                    '' => '',
                    'no' => 'No',
                    'yes' => 'Yes'
                ),
                'args' => array(
                    "dependence" => true,
                    "hide" => array(
                        "" => "",
                        "no" => "",
                        "yes" => "#mkd_mkd_title_area_background_image_responsive_meta_container, #mkd_mkd_title_area_height_meta"
                    ),
                    "show" => array(
                        "" => "#mkd_mkd_title_area_background_image_responsive_meta_container, #mkd_mkd_title_area_height_meta",
                        "no" => "#mkd_mkd_title_area_background_image_responsive_meta_container, #mkd_mkd_title_area_height_meta",
                        "yes" => ""
                    )
                )
            )
        );

        $title_area_background_image_responsive_meta_container = libero_mikado_add_admin_container(
            array(
                'parent' => $hide_background_image_meta_container,
                'name' => 'mkd_title_area_background_image_responsive_meta_container',
                'hidden_property' => 'mkd_title_area_background_image_responsive_meta',
                'hidden_value' => 'yes'
            )
        );

            libero_mikado_add_meta_box_field(
                array(
                    'name' => 'mkd_title_area_background_image_parallax_meta',
                    'type' => 'select',
                    'default_value' => '',
                    'label' => 'Background Image in Parallax',
                    'description' => 'Enabling this option will make Title background image parallax',
                    'parent' => $title_area_background_image_responsive_meta_container,
                    'options' => array(
                        '' => '',
                        'no' => 'No',
                        'yes' => 'Yes',
                        'yes_zoom' => 'Yes, with zoom out'
                    )
                )
            );

        libero_mikado_add_meta_box_field(array(
            'name' => 'mkd_title_area_height_meta',
            'type' => 'text',
            'label' => 'Height',
            'description' => 'Set a height for Title Area',
            'parent' => $show_title_area_meta_container,
            'args' => array(
                'col_width' => 2,
                'suffix' => 'px'
            )
        ));

        libero_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_title_area_border_bottom_enable_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => 'Enable Border Bottom',
                'description' => 'Enable this option to add border bottom on title area',
                'parent' => $show_title_area_meta_container,
                'options' => array(
                    '' => '',
                    'yes' => 'Yes',
                    'no' => 'No'
                ),
                'args' => array(
                    "dependence" => true,
                    "show" => array("yes" => "#mkd_mkd_show_border_bottom_meta_container"),
                    "hide" => array("no" => "#mkd_mkd_show_border_bottom_meta_container")
                )
            )
        );

        $show_border_bottom_meta_container = libero_mikado_add_admin_container(
            array(
                'parent' => $show_title_area_meta_container,
                'name' => 'mkd_show_border_bottom_meta_container',
                'hidden_property' => 'mkd_title_area_border_bottom_enable_meta',
                'hidden_value' => 'no'
            )
        );

        libero_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_title_area_border_bottom_meta',
                'type' => 'color',
                'default_value' => '',
                'label' => 'Border Bottom Color',
                'description' => 'Choose border bottom color for title area',
                'parent' => $show_border_bottom_meta_container
            )
        );

        libero_mikado_add_meta_box_field(array(
            'name' => 'mkd_title_area_subtitle_meta',
            'type' => 'text',
            'default_value' => '',
            'label' => 'Subtitle Text',
            'description' => 'Enter your subtitle text',
            'parent' => $show_title_area_meta_container,
            'args' => array(
                'col_width' => 6
            )
        ));

        libero_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_subtitle_color_meta',
                'type' => 'color',
                'label' => 'Subtitle Color',
                'description' => 'Choose a color for subtitle text',
                'parent' => $show_title_area_meta_container
            )
        );


        libero_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_title_icon_enable_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => 'Enable Icon',
                'description' => 'Enable icon to be rendered above title text',
                'parent' => $show_title_area_meta_container,
                'options' => array(
                	'' => '',
                	'yes' => 'Yes',
                	'no' => 'No'
            	),
                'args' => array(
                    "dependence" => true,
                    "show" => array("yes" => "#mkd_mkd_title_icon_meta_all_container"),
                    "hide" => array("no" => "#mkd_mkd_title_icon_meta_all_container")
                )
            )
        );

        $title_icon_meta_all_container = libero_mikado_add_admin_container(
            array(
                'parent' => $show_title_area_meta_container,
                'name' => 'mkd_title_icon_meta_all_container',
                'hidden_property' => 'mkd_title_icon_enable_meta',
                'hidden_value' => 'no'
            )
        );


//init icon pack hide and show array. It will be populated dinamically from collections array
		$title_above_icon_pack_hide_array = array();
		$title_above_icon_pack_show_array = array();

//do we have some collection added in collections array?
		if (is_array(libero_mikado_icon_collections()->iconCollections) && count(libero_mikado_icon_collections()->iconCollections)) {
			//get collections params array. It will contain values of 'param' property for each collection
			$title_above_icon_collections_params = libero_mikado_icon_collections()->getIconCollectionsParams();

			//foreach collection generate hide and show array
			foreach (libero_mikado_icon_collections()->iconCollections as $dep_collection_key => $dep_collection_object) {
				$title_above_icon_pack_hide_array[$dep_collection_key] = '';

				//we need to include only current collection in show string as it is the only one that needs to show
				$title_above_icon_pack_show_array[$dep_collection_key] = '#mkd_mkd_title_above_icon_' . $dep_collection_object->param . '_container';

				//for all collections param generate hide string
				foreach ($title_above_icon_collections_params as $title_above_icon_collections_param) {
					//we don't need to include current one, because it needs to be shown, not hidden
					if ($title_above_icon_collections_param !== $dep_collection_object->param) {
						$title_above_icon_pack_hide_array[$dep_collection_key] .= '#mkd_mkd_title_above_icon_' . $title_above_icon_collections_param . '_container,';
					}
				}

				//remove remaining ',' character
				$title_above_icon_pack_hide_array[$dep_collection_key] = rtrim($title_above_icon_pack_hide_array[$dep_collection_key], ',');
			}

		}

		libero_mikado_add_meta_box_field(
			array(
				'parent' => $title_icon_meta_all_container,
				'type' => 'selectblank',
				'name' => 'mkd_title_above_icon_pack_meta',
				'default_value' => '',
				'label' => 'Icon Pack',
				'description' => 'Choose icon pack',
				'options' => libero_mikado_icon_collections()->getIconCollections(),
				'args' => array(
					'dependence' => true,
					'hide' => $title_above_icon_pack_hide_array,
					'show' => $title_above_icon_pack_show_array
				)
			)
		);

		if (is_array(libero_mikado_icon_collections()->iconCollections) && count(libero_mikado_icon_collections()->iconCollections)) {
			//foreach icon collection we need to generate separate container that will have dependency set
			//it will have one field inside with icons dropdown
			foreach (libero_mikado_icon_collections()->iconCollections as $collection_key => $collection_object) {
				$icons_array = $collection_object->getIconsArray();

				//get icon collection keys (keys from collections array, e.g 'font_awesome', 'font_elegant' etc.)
				$icon_collections_keys = libero_mikado_icon_collections()->getIconCollectionsKeys();

				//unset current one, because it doesn't have to be included in dependency that hides icon container
				unset($icon_collections_keys[array_search($collection_key, $icon_collections_keys)]);

				$title_icon_hide_values = $icon_collections_keys;

				$title_icon_meta_container = libero_mikado_add_admin_container(
					array(
						'parent' => $title_icon_meta_all_container,
						'name' => 'mkd_title_above_icon_' . $collection_object->param . '_container',
						'hidden_property' => 'mkd_title_above_icon_pack_meta',
						'hidden_value' => '',
						'hidden_values' => $title_icon_hide_values
					)
				);

				libero_mikado_add_meta_box_field(
					array(
						'parent' => $title_icon_meta_container,
						'type' => 'select',
						'name' => 'mkd_title_above_icon_' . $collection_object->param.'_meta',
						'default_value' => '',
						'label' => 'Icon',
						'description' => 'Choose icon to be displayed above title',
						'options' => $icons_array,
					)
				);

			}

		}

		$group_page_title_icon_styles_meta = libero_mikado_add_admin_group(array(
			'name'			=> 'group_page_title_icon_styles_meta',
			'title'			=> 'Icon Style',
			'description'	=> 'Define icon style',
			'parent'		=> $title_icon_meta_all_container
		));

		$row_page_title_icon_styles_1_meta = libero_mikado_add_admin_row(array(
			'name'		=> 'row_page_title_icon_styles_1_meta',
			'parent'	=> $group_page_title_icon_styles_meta
		));

		libero_mikado_add_meta_box_field(
			array(
				'parent' => $row_page_title_icon_styles_1_meta,
				'type' => 'colorsimple',
				'name' => 'mkd_title_icon_color_meta',
				'default_value' => '',
				'label' => 'Color',
			)
		);

		libero_mikado_add_meta_box_field(
			array(
				'parent' => $row_page_title_icon_styles_1_meta,
				'type' => 'colorsimple',
				'name' => 'mkd_title_icon_border_color_meta',
				'default_value' => '',
				'label' => 'Border Color',
			)
		);

		$row_page_title_icon_styles_2_meta = libero_mikado_add_admin_row(array(
			'name'		=> 'row_page_title_icon_styles_2_meta',
			'parent'	=> $group_page_title_icon_styles_meta
		));

		libero_mikado_add_meta_box_field(
			array(
				'parent' => $row_page_title_icon_styles_2_meta,
				'type' => 'selectblanksimple',
				'name' => 'mkd_title_icon_size_meta',
				'default_value' => '',
				'label' => 'Size',
				'options' => array(
					'' => 'Default',
					'mkd-icon-tiny' => 'Tiny',
					'mkd-icon-small' => 'Small',
					'mkd-icon-medium' => 'Medium',
					'mkd-icon-large' => 'Large',
					'mkd-icon-huge' => 'Very Large',
				)
			)
		);

		libero_mikado_add_meta_box_field(
			array(
				'parent' => $row_page_title_icon_styles_2_meta,
				'type' => 'textsimple',
				'name' => 'mkd_title_icon_custom_size_meta',
				'default_value' => '',
				'label' => 'Custom Size',
				'args' => array(
					'suffix' => 'px',
				)
			)
		);

		libero_mikado_add_meta_box_field(
			array(
				'parent' => $row_page_title_icon_styles_2_meta,
				'type' => 'textsimple',
				'name' => 'mkd_title_icon_shape_size_meta',
				'default_value' => '',
				'label' => 'Shape Size',
				'args' => array(
					'suffix' => 'px',
				)
			)
		);