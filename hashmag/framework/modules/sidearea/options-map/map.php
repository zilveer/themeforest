<?php

if (!function_exists('hashmag_mikado_sidearea_options_map')) {

    function hashmag_mikado_sidearea_options_map() {

        hashmag_mikado_add_admin_page(
            array(
                'slug' => '_side_area_page',
                'title' => 'Side Area',
                'icon' => 'fa fa-search'
            )
        );

        $side_area_panel = hashmag_mikado_add_admin_panel(
            array(
                'title' => 'Side Area',
                'name' => 'side_area',
                'page' => '_side_area_page'
            )
        );

        hashmag_mikado_add_admin_field(
            array(
                'parent' => $side_area_panel,
                'type' => 'select',
                'name' => 'side_area_type',
                'default_value' => 'side-menu-slide-over-content',
                'label' => 'Side Area Type',
                'description' => 'Choose a type of Side Area',
                'options' => array(
                    'side-menu-slide-over-content' => 'Slide from Left Over Content',
                ),

            )
        );

        $side_area_slide_over_content_container = hashmag_mikado_add_admin_container(
            array(
                'parent' => $side_area_panel,
                'name' => 'side_area_slide_with_content_container',
            )
        );

        hashmag_mikado_add_admin_field(
            array(
                'parent' => $side_area_slide_over_content_container,
                'type' => 'select',
                'name' => 'side_area_slide_over_content_width',
                'default_value' => 'width-290',
                'label' => 'Side Area Width',
                'description' => 'Choose width for Side Area',
                'options' => array(
                    'width-256' => '256px',
                    'width-290' => '290px',
                    'width-356' => '356px'
                )
            )
        );

//init icon pack hide and show array. It will be populated dinamically from collections array
        $side_area_icon_pack_hide_array = array();
        $side_area_icon_pack_show_array = array();

//do we have some collection added in collections array?
        if (is_array(hashmag_mikado_icon_collections()->iconCollections) && count(hashmag_mikado_icon_collections()->iconCollections)) {
            //get collections params array. It will contain values of 'param' property for each collection
            $side_area_icon_collections_params = hashmag_mikado_icon_collections()->getIconCollectionsParams();

            //foreach collection generate hide and show array
            foreach (hashmag_mikado_icon_collections()->iconCollections as $dep_collection_key => $dep_collection_object) {
                $side_area_icon_pack_hide_array[$dep_collection_key] = '';

                //we need to include only current collection in show string as it is the only one that needs to show
                $side_area_icon_pack_show_array[$dep_collection_key] = '#mkdf_side_area_icon_' . $dep_collection_object->param . '_container';

                //for all collections param generate hide string
                foreach ($side_area_icon_collections_params as $side_area_icon_collections_param) {
                    //we don't need to include current one, because it needs to be shown, not hidden
                    if ($side_area_icon_collections_param !== $dep_collection_object->param) {
                        $side_area_icon_pack_hide_array[$dep_collection_key] .= '#mkdf_side_area_icon_' . $side_area_icon_collections_param . '_container,';
                    }
                }

                //remove remaining ',' character
                $side_area_icon_pack_hide_array[$dep_collection_key] = rtrim($side_area_icon_pack_hide_array[$dep_collection_key], ',');
            }

        }

        hashmag_mikado_add_admin_field(
            array(
                'parent' => $side_area_panel,
                'type' => 'select',
                'name' => 'side_area_button_icon_pack',
                'default_value' => 'ion_icons',
                'label' => 'Side Area Button Icon Pack',
                'description' => 'Choose icon pack for side area button',
                'options' => hashmag_mikado_icon_collections()->getIconCollections(),
                'args' => array(
                    'dependence' => true,
                    'hide' => $side_area_icon_pack_hide_array,
                    'show' => $side_area_icon_pack_show_array
                )
            )
        );

        if (is_array(hashmag_mikado_icon_collections()->iconCollections) && count(hashmag_mikado_icon_collections()->iconCollections)) {
            //foreach icon collection we need to generate separate container that will have dependency set
            //it will have one field inside with icons dropdown
            foreach (hashmag_mikado_icon_collections()->iconCollections as $collection_key => $collection_object) {
                $icons_array = $collection_object->getIconsArray();

                //get icon collection keys (keys from collections array, e.g 'font_awesome', 'font_elegant' etc.)
                $icon_collections_keys = hashmag_mikado_icon_collections()->getIconCollectionsKeys();

                //unset current one, because it doesn't have to be included in dependency that hides icon container
                unset($icon_collections_keys[array_search($collection_key, $icon_collections_keys)]);

                $side_area_icon_hide_values = $icon_collections_keys;

                $side_area_icon_container = hashmag_mikado_add_admin_container(
                    array(
                        'parent' => $side_area_panel,
                        'name' => 'side_area_icon_' . $collection_object->param . '_container',
                        'hidden_property' => 'side_area_button_icon_pack',
                        'hidden_value' => '',
                        'hidden_values' => $side_area_icon_hide_values
                    )
                );

                hashmag_mikado_add_admin_field(
                    array(
                        'parent' => $side_area_icon_container,
                        'type' => 'select',
                        'name' => 'side_area_icon_' . $collection_object->param,
                        'default_value' => 'ion-navicon',
                        'label' => 'Side Area Icon',
                        'description' => 'Choose Side Area Icon',
                        'options' => $icons_array,
                    )
                );

            }

        }

        hashmag_mikado_add_admin_field(
            array(
                'parent' => $side_area_panel,
                'type' => 'text',
                'name' => 'side_area_icon_font_size',
                'default_value' => '',
                'label' => 'Side Area Icon Size',
                'description' => 'Choose a size for Side Area (px)',
                'args' => array(
                    'col_width' => 3,
                    'suffix' => 'px'
                ),
            )
        );

        hashmag_mikado_add_admin_field(
            array(
                'parent' => $side_area_panel,
                'type' => 'select',
                'name' => 'side_area_predefined_icon_size',
                'default_value' => 'medium',
                'label' => 'Predefined Side Area Icon Size',
                'description' => 'Choose predefined size for Side Area icons',
                'options' => array(
                    'normal' => 'Normal',
                    'medium' => 'Medium',
                    'large' => 'Large'
                ),
            )
        );

        $side_area_icon_style_group = hashmag_mikado_add_admin_group(
            array(
                'parent' => $side_area_panel,
                'name' => 'side_area_icon_style_group',
                'title' => 'Side Area Icon Style',
                'description' => 'Define styles for Side Area icon'
            )
        );

        $side_area_icon_style_row1 = hashmag_mikado_add_admin_row(
            array(
                'parent' => $side_area_icon_style_group,
                'name' => 'side_area_icon_style_row1'
            )
        );

        hashmag_mikado_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row1,
                'type' => 'colorsimple',
                'name' => 'side_area_icon_color',
                'default_value' => '',
                'label' => 'Color',
            )
        );

        hashmag_mikado_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row1,
                'type' => 'colorsimple',
                'name' => 'side_area_icon_hover_color',
                'default_value' => '',
                'label' => 'Hover Color',
            )
        );

        hashmag_mikado_add_admin_field(
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

        hashmag_mikado_add_admin_field(
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

        hashmag_mikado_add_admin_field(
            array(
                'parent' => $side_area_panel,
                'type' => 'color',
                'name' => 'side_area_background_color',
                'default_value' => '',
                'label' => 'Background Color',
                'description' => 'Choose a background color for Side Area',
            )
        );

        $title_group = hashmag_mikado_add_admin_group(
            array(
                'parent' => $side_area_panel,
                'name' => 'title_group',
                'title' => 'Title',
                'description' => 'Define Style for Side Area title'
            )
        );

        $title_row_1 = hashmag_mikado_add_admin_row(
            array(
                'parent' => $title_group,
                'name' => 'title_row_1',
            )
        );

        hashmag_mikado_add_admin_field(
            array(
                'parent' => $title_row_1,
                'type' => 'colorsimple',
                'name' => 'side_area_title_color',
                'default_value' => '',
                'label' => 'Text Color',
            )
        );

        hashmag_mikado_add_admin_field(
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

        hashmag_mikado_add_admin_field(
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

        hashmag_mikado_add_admin_field(
            array(
                'parent' => $title_row_1,
                'type' => 'selectblanksimple',
                'name' => 'side_area_title_texttransform',
                'default_value' => '',
                'label' => 'Text Transform',
                'options' => hashmag_mikado_get_text_transform_array()
            )
        );

        $title_row_2 = hashmag_mikado_add_admin_row(
            array(
                'parent' => $title_group,
                'name' => 'title_row_2',
                'next' => true
            )
        );

        hashmag_mikado_add_admin_field(
            array(
                'parent' => $title_row_2,
                'type' => 'fontsimple',
                'name' => 'side_area_title_google_fonts',
                'default_value' => '-1',
                'label' => 'Font Family',
            )
        );

        hashmag_mikado_add_admin_field(
            array(
                'parent' => $title_row_2,
                'type' => 'selectblanksimple',
                'name' => 'side_area_title_fontstyle',
                'default_value' => '',
                'label' => 'Font Style',
                'options' => hashmag_mikado_get_font_style_array()
            )
        );

        hashmag_mikado_add_admin_field(
            array(
                'parent' => $title_row_2,
                'type' => 'selectblanksimple',
                'name' => 'side_area_title_fontweight',
                'default_value' => '',
                'label' => 'Font Weight',
                'options' => hashmag_mikado_get_font_weight_array()
            )
        );

        hashmag_mikado_add_admin_field(
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


        $text_group = hashmag_mikado_add_admin_group(
            array(
                'parent' => $side_area_panel,
                'name' => 'text_group',
                'title' => 'Text',
                'description' => 'Define Style for Side Area text'
            )
        );

        $text_row_1 = hashmag_mikado_add_admin_row(
            array(
                'parent' => $text_group,
                'name' => 'text_row_1',
            )
        );

        hashmag_mikado_add_admin_field(
            array(
                'parent' => $text_row_1,
                'type' => 'colorsimple',
                'name' => 'side_area_text_color',
                'default_value' => '',
                'label' => 'Text Color',
            )
        );

        hashmag_mikado_add_admin_field(
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

        hashmag_mikado_add_admin_field(
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

        hashmag_mikado_add_admin_field(
            array(
                'parent' => $text_row_1,
                'type' => 'selectblanksimple',
                'name' => 'side_area_text_texttransform',
                'default_value' => '',
                'label' => 'Text Transform',
                'options' => hashmag_mikado_get_text_transform_array()
            )
        );

        $text_row_2 = hashmag_mikado_add_admin_row(
            array(
                'parent' => $text_group,
                'name' => 'text_row_2',
                'next' => true
            )
        );

        hashmag_mikado_add_admin_field(
            array(
                'parent' => $text_row_2,
                'type' => 'fontsimple',
                'name' => 'side_area_text_google_fonts',
                'default_value' => '-1',
                'label' => 'Font Family',
            )
        );

        hashmag_mikado_add_admin_field(
            array(
                'parent' => $text_row_2,
                'type' => 'fontsimple',
                'name' => 'side_area_text_google_fonts',
                'default_value' => '-1',
                'label' => 'Font Family',
            )
        );

        hashmag_mikado_add_admin_field(
            array(
                'parent' => $text_row_2,
                'type' => 'selectblanksimple',
                'name' => 'side_area_text_fontstyle',
                'default_value' => '',
                'label' => 'Font Style',
                'options' => hashmag_mikado_get_font_style_array()
            )
        );

        hashmag_mikado_add_admin_field(
            array(
                'parent' => $text_row_2,
                'type' => 'selectblanksimple',
                'name' => 'side_area_text_fontweight',
                'default_value' => '',
                'label' => 'Font Weight',
                'options' => hashmag_mikado_get_font_weight_array()
            )
        );

        hashmag_mikado_add_admin_field(
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

        $widget_links_group = hashmag_mikado_add_admin_group(
            array(
                'parent' => $side_area_panel,
                'name' => 'widget_links_group',
                'title' => 'Link Style',
                'description' => 'Define styles for Side Area widget links'
            )
        );

        $widget_links_row_1 = hashmag_mikado_add_admin_row(
            array(
                'parent' => $widget_links_group,
                'name' => 'widget_links_row_1',
            )
        );

        hashmag_mikado_add_admin_field(
            array(
                'parent' => $widget_links_row_1,
                'type' => 'colorsimple',
                'name' => 'sidearea_link_color',
                'default_value' => '',
                'label' => 'Text Color',
            )
        );

        hashmag_mikado_add_admin_field(
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

        hashmag_mikado_add_admin_field(
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

        hashmag_mikado_add_admin_field(
            array(
                'parent' => $widget_links_row_1,
                'type' => 'selectblanksimple',
                'name' => 'sidearea_link_text_transform',
                'default_value' => '',
                'label' => 'Text Transform',
                'options' => hashmag_mikado_get_text_transform_array()
            )
        );

        $widget_links_row_2 = hashmag_mikado_add_admin_row(
            array(
                'parent' => $widget_links_group,
                'name' => 'widget_links_row_2',
                'next' => true
            )
        );

        hashmag_mikado_add_admin_field(
            array(
                'parent' => $widget_links_row_2,
                'type' => 'fontsimple',
                'name' => 'sidearea_link_font_family',
                'default_value' => '-1',
                'label' => 'Font Family',
            )
        );

        hashmag_mikado_add_admin_field(
            array(
                'parent' => $widget_links_row_2,
                'type' => 'selectblanksimple',
                'name' => 'sidearea_link_font_style',
                'default_value' => '',
                'label' => 'Font Style',
                'options' => hashmag_mikado_get_font_style_array()
            )
        );

        hashmag_mikado_add_admin_field(
            array(
                'parent' => $widget_links_row_2,
                'type' => 'selectblanksimple',
                'name' => 'sidearea_link_font_weight',
                'default_value' => '',
                'label' => 'Font Weight',
                'options' => hashmag_mikado_get_font_weight_array()
            )
        );

        hashmag_mikado_add_admin_field(
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

        $widget_links_row_3 = hashmag_mikado_add_admin_row(
            array(
                'parent' => $widget_links_group,
                'name' => 'widget_links_row_3',
                'next' => true
            )
        );

        hashmag_mikado_add_admin_field(
            array(
                'parent' => $widget_links_row_3,
                'type' => 'colorsimple',
                'name' => 'sidearea_link_hover_color',
                'default_value' => '',
                'label' => 'Hover Color',
            )
        );

    }

    add_action('hashmag_mikado_options_map', 'hashmag_mikado_sidearea_options_map', 4);

}