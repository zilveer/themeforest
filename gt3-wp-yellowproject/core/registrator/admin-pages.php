<?php

function theme_add_admin()
{

    #Settings page
    //add_menu_page(THEMENAME, THEMENAME, 'administrator', THEMESHORT.'options', 'theme_options', IMGURL.'/theme_icon.png', '110');
    add_menu_page(THEMENAME, THEMENAME, 'administrator', THEMESHORT . 'options', 'theme_options', false, '110');

}

add_action('admin_menu', 'theme_add_admin');

?>