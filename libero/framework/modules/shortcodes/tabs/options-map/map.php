<?php

if(!function_exists('libero_mikado_tabs_map')) {
    function libero_mikado_tabs_map() {
		
        $panel = libero_mikado_add_admin_panel(array(
            'title' => 'Tabs',
            'name'  => 'panel_tabs',
            'page'  => '_elements_page'
        ));

        //Typography options
        libero_mikado_add_admin_section_title(array(
            'name' => 'typography_section_title',
            'title' => 'Tabs Navigation Typography',			
            'parent' => $panel
        ));

        $typography_group = libero_mikado_add_admin_group(array(
            'name' => 'typography_group',
            'title' => 'Tabs Navigation Typography',
			'description' => 'Setup typography for tabs navigation',
            'parent' => $panel
        ));

        $typography_row = libero_mikado_add_admin_row(array(
            'name' => 'typography_row',
            'next' => true,
            'parent' => $typography_group
        ));

        libero_mikado_add_admin_field(array(
            'parent'        => $typography_row,
            'type'          => 'fontsimple',
            'name'          => 'tabs_font_family',
            'default_value' => '',
            'label'         => 'Font Family',
        ));

        libero_mikado_add_admin_field(array(
            'parent'        => $typography_row,
            'type'          => 'selectsimple',
            'name'          => 'tabs_text_transform',
            'default_value' => '',
            'label'         => 'Text Transform',
            'options'       => libero_mikado_get_text_transform_array()
        ));

        libero_mikado_add_admin_field(array(
            'parent'        => $typography_row,
            'type'          => 'selectsimple',
            'name'          => 'tabs_font_style',
            'default_value' => '',
            'label'         => 'Font Style',
            'options'       => libero_mikado_get_font_style_array()
        ));

        libero_mikado_add_admin_field(array(
            'parent'        => $typography_row,
            'type'          => 'textsimple',
            'name'          => 'tabs_letter_spacing',
            'default_value' => '',
            'label'         => 'Letter Spacing',
            'args'          => array(
                'suffix' => 'px'
            )
        ));

        $typography_row2 = libero_mikado_add_admin_row(array(
            'name' => 'typography_row2',
            'next' => true,
            'parent' => $typography_group
        ));		
		
        libero_mikado_add_admin_field(array(
            'parent'        => $typography_row2,
            'type'          => 'selectsimple',
            'name'          => 'tabs_font_weight',
            'default_value' => '',
            'label'         => 'Font Weight',
            'options'       => libero_mikado_get_font_weight_array()
        ));
		
		//Initial Tab Color Styles
		
		libero_mikado_add_admin_section_title(array(
            'name' => 'tab_color_section_title',
            'title' => 'Tab Navigation Color Styles',			
            'parent' => $panel
        ));


		$tabs_color_group = libero_mikado_add_admin_group(array(
            'name' => 'tabs_color_group',
            'title' => 'Tab Navigation Color Styles',
			'description' => 'Set color styles for tab navigation',
            'parent' => $panel
        ));
		$tabs_color_row = libero_mikado_add_admin_row(array(
            'name' => 'tabs_color_row',
            'next' => true,
            'parent' => $tabs_color_group
        ));

        libero_mikado_add_admin_field(array(
            'parent'        => $tabs_color_row,
            'type'          => 'colorsimple',
            'name'          => 'tabs_background_color',
            'default_value' => '',
            'label'         => 'Background Color'
        ));
        libero_mikado_add_admin_field(array(
            'parent'        => $tabs_color_row,
            'type'          => 'colorsimple',
            'name'          => 'tabs_border_color',
            'default_value' => '',
            'label'         => 'Border Color'
        ));

        libero_mikado_add_admin_field(array(
            'parent'        => $tabs_color_row,
            'type'          => 'colorsimple',
            'name'          => 'tabs_color',
            'default_value' => '',
            'label'         => 'Text Color'
        ));
		libero_mikado_add_admin_field(array(
            'parent'        => $tabs_color_row,
            'type'          => 'colorsimple',
            'name'          => 'tabs_icon_color',
            'default_value' => '',
            'label'         => 'Icon Color'
        ));
		
		//Active Tab Color Styles
		
		$active_tabs_color_group = libero_mikado_add_admin_group(array(
            'name' => 'active_tabs_color_group',
            'title' => 'Active and Hover Navigation Color Styles',
			'description' => 'Set color styles for active and hover tabs',
            'parent' => $panel
        ));
		$active_tabs_color_row = libero_mikado_add_admin_row(array(
            'name' => 'active_tabs_color_row',
            'next' => true,
            'parent' => $active_tabs_color_group
        ));

        libero_mikado_add_admin_field(array(
            'parent'        => $active_tabs_color_row,
            'type'          => 'colorsimple',
            'name'          => 'tabs_color_active',
            'default_value' => '',
            'label'         => 'Color'
        ));
		libero_mikado_add_admin_field(array(
            'parent'        => $active_tabs_color_row,
            'type'          => 'colorsimple',
            'name'          => 'tabs_icon_color_active',
            'default_value' => '',
            'label'         => 'Icon Color'
        ));
        
    }

    add_action('libero_mikado_options_elements_map', 'libero_mikado_tabs_map',5);
}