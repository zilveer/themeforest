<?php

if(!function_exists('flow_elated_get_button_html')) {
    /**
     * Calls button shortcode with given parameters and returns it's output
     * @param $params
     *
     * @return mixed|string
     */
    function flow_elated_get_button_html($params) {
        $button_html = flow_elated_execute_shortcode('eltd_button', $params);
        $button_html = str_replace("\n", '', $button_html);
        return $button_html;
    }
}

if ( ! function_exists( 'flow_elated_get_load_more_button_html' ) ) {

    function flow_elated_get_load_more_button_html() {

        $button_html = '<div class="eltd-load-more-btn-holder eltd-btn">';
        $button_html .= '<a href="#" class="eltd-btn-load-more"><span>'. esc_html__('Load More', 'flow') .'</span></a>';
        $button_html .= '</div>';
        return $button_html;

    }

}
