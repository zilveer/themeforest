<?php 

echo mk_get_shortcode_view('mk_contact_form', 'components/name-field', true, array('tab_index' => $view_params['id']++, 'show_icon' => true));

if($view_params['phone'] == 'true') {
    echo mk_get_shortcode_view('mk_contact_form', 'components/phone-field', true, array('tab_index' => $view_params['id']++, 'show_icon' => true)); 
} 

echo mk_get_shortcode_view('mk_contact_form', 'components/email-field', true, array('tab_index' => $view_params['id']++, 'show_icon' => true));

echo mk_get_shortcode_view('mk_contact_form', 'components/message-field', true, array('tab_index' => $view_params['id']++, 'show_icon' => true));

if($view_params['captcha'] == 'true') {
    echo mk_get_shortcode_view('mk_contact_form', 'components/captcha-field', true, array('tab_index' => $view_params['id']++, 'show_icon' => true, 'add_br' => true));    
}

$button_class = 'mk-progress-button mk-button contact-form-button mk-skin-button mk-button--dimension-flat text-color-light mk-button--size-medium';

echo mk_get_shortcode_view('mk_contact_form', 'components/button', true, array('tab_index' => $view_params['id']++,'button_text' => $view_params['button_text'], 'button_class' => $button_class));

echo mk_get_shortcode_view('mk_contact_form', 'components/security', true, array('id' => $view_params['id'], 'email' => $view_params['email']));

