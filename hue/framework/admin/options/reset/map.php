<?php

if(!function_exists('hue_mikado_reset_options_map')) {
    /**
     * Reset options panel
     */
    function hue_mikado_reset_options_map() {

        hue_mikado_add_admin_page(
            array(
                'slug'  => '_reset_page',
                'title' => esc_html__('Reset', 'hue'),
                'icon'  => 'icon_refresh'
            )
        );

        $panel_reset = hue_mikado_add_admin_panel(
            array(
                'page'  => '_reset_page',
                'name'  => 'panel_reset',
                'title' => esc_html__('Reset', 'hue')
            )
        );

        hue_mikado_add_admin_field(array(
            'type'          => 'yesno',
            'name'          => 'reset_to_defaults',
            'default_value' => 'no',
            'label'         => esc_html__('Reset to Defaults', 'hue'),
            'description'   => esc_html__('This option will reset all Mikado Options values to defaults', 'hue'),
            'parent'        => $panel_reset
        ));

    }

    add_action('hue_mikado_options_map', 'hue_mikado_reset_options_map', 19);

}