<?php
    extract( shortcode_atts( array(
        'title'                     => '',
        'email'                     => get_bloginfo( 'admin_email' ),
        'style'                     => 'outline',
        'skin'                      => 'dark',
        'button_text'               => '',
        'bg_color'                  => '#f6f6f6',
        'border_color'              => '#f6f6f6',
        'button_color'              => '#373737',
        'button_font_color'         => '#ffffff',
        'font_color'                 => '#373737',
        'line_skin_color'           => '#000',
        'line_button_text_color'    => 'dark',
        'phone'                     => 'false',
        'captcha'                   => 'true',
        'el_class'                  => '',
        // 'attachfile'     => 'false',
    ), $atts ) );
Mk_Static_Files::addAssets('mk_contact_form');
Mk_Static_Files::addAssets('mk_button');