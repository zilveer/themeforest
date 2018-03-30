<?php

if (!function_exists('hashmag_mikado_register_widgets')) {

    function hashmag_mikado_register_widgets() {

        $widgets = array(
            'HashmagMikadoBreakingNews',
            'HashmagMikadoDateWidget',
            'HashmagMikadoImageWidget',
            'HashmagMikadoPostLayoutOne',
            'HashmagMikadoPostLayoutTwo',
            'HashmagMikadoPostLayoutFour',
            'HashmagMikadoPostLayoutTabs',
            'HashmagMikadoRecentComments',
            'HashmagMikadoSearchForm',
            'HashmagMikadoSeparatorWidget',
            'HashmagMikadoSocialIconWidget',
            'HashmagMikadoStickySidebar',
            'HashmagMikadoSideAreaOpener',
            'HashmagMikadoWeatherWidget',
        );

        foreach ($widgets as $widget) {
            register_widget($widget);
        }
    }
}

add_action('widgets_init', 'hashmag_mikado_register_widgets');