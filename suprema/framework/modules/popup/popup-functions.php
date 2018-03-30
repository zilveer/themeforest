<?php
if ( ! function_exists('suprema_qodef_get_popup') ) {
    /**
     * Loads search HTML based on search type option.
     */
    function suprema_qodef_get_popup() {

        if ( suprema_qodef_active_widget( false, false, 'qode_popup_opener' ) ) {
            if(suprema_qodef_options()->getOptionValue('enable_popup') == 'yes') {
                suprema_qodef_load_popup_template();
            }

        }
    }

}

if ( ! function_exists('suprema_qodef_load_popup_template') ) {
    /**
     * Loads HTML template with parameters
     */
    function suprema_qodef_load_popup_template() {
        $parameters = array();
        $parameters['title'] = suprema_qodef_options()->getOptionValue('popup_title');
        $parameters['subtitle'] = suprema_qodef_options()->getOptionValue('popup_subtitle');
        $parameters['contact_form'] = suprema_qodef_options()->getOptionValue('popup_contact_form');
        $parameters['contact_form_style'] = suprema_qodef_options()->getOptionValue('popup_contact_form_style');
        suprema_qodef_get_module_template_part( 'templates/popup', 'popup', '', $parameters );
    }

}