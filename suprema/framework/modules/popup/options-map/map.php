<?php

if ( ! function_exists('suprema_qodef_popup_options_map') ) {

    function suprema_qodef_popup_options_map() {

        $cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );

        $contact_forms = array();
        if ( $cf7 ) {
            foreach ( $cf7 as $cform ) {
                $contact_forms[ $cform->ID ] = $cform->post_title;
            }
        } else {
            $contact_forms[0] =  __( 'No contact forms found', 'suprema' ) ;
        }

        suprema_qodef_add_admin_page(
            array(
                'slug' => '_popup_page',
                'title' => 'Pop-up',
                'icon' => 'fa fa-pencil-square-o'
            )
        );

        $popup_panel = suprema_qodef_add_admin_panel(
            array(
                'title' => 'Pop-up',
                'name' => 'popup',
                'page' => '_popup_page'
            )
        );

        suprema_qodef_add_admin_field(
            array(
                'parent'		=> $popup_panel,
                'type'			=> 'yesno',
                'name'			=> 'enable_popup',
                'default_value'	=> 'no',
                'label'			=> 'Enable Pop-up',
                'description'	=> '',
                'args'			=> array(
                    'dependence' => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#qodef_enable_popup_container'
                )
            )
        );

        $enable_popup_container = suprema_qodef_add_admin_container(
            array(
                'parent'			=> $popup_panel,
                'name'				=> 'enable_popup_container',
                'hidden_property'	=> 'enable_popup',
                'hidden_value'		=> 'no',
            )
        );

        suprema_qodef_add_admin_field(array(
            'parent' => $enable_popup_container,
            'type' => 'text',
            'name' => 'popup_title',
            'default_value' => '',
            'label' => 'Title',
            'description' => 'Enter title pop-up window'
        ));

        suprema_qodef_add_admin_field(array(
            'parent' => $enable_popup_container,
            'type' => 'text',
            'name' => 'popup_subtitle',
            'default_value' => '',
            'label' => 'Subtitle',
            'description' => 'Enter subtitle pop-up window'
        ));

        suprema_qodef_add_admin_field(
            array(
                'name'          => 'popup_contact_form',
                'type'          => 'select',
                'default_value' => '',
                'label'         => 'Select Contact Form',
                'description'   => 'Choose contact form to display in popup window',
                'parent'        => $enable_popup_container,
                'options'       => $contact_forms
            )
        );

        suprema_qodef_add_admin_field(
            array(
                'name'          => 'popup_contact_form_style',
                'type'          => 'select',
                'default_value' => '',
                'label'         => 'Contact Form Style',
                'description'   => 'Choose style defined in Contact Form 7 option tab',
                'parent'        => $enable_popup_container,
                'options'       => array(
                    'default' => 'Default',
                    'cf7_custom_style_1' => 'Custom Style 1',
                    'cf7_custom_style_2' => 'Custom Style 2'
                )
            )
        );
    }

    add_action('suprema_qodef_options_map', 'suprema_qodef_popup_options_map', 16);
}