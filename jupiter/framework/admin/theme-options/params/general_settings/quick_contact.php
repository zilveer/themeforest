<?php
$captcha_plugin_status = '';
if(!Mk_Theme_Captcha::is_plugin_active()) {
    $captcha_plugin_status = '<span style="color:red">Artbees Themes Captcha plugin is not activated! <a href="'.admin_url('themes.php?page=tgmpa-install-plugins').'">Click here</a> to begin installing.</span>';
}

$general_section[] = array(
    "type" => "sub_group",
    "id" => "mk_options_quick_contact",
    "name" => __("General / Quick Contact", "mk_framework") ,
    "desc" => __("Quick Contact is a floating contact form accessible by a button that will be always stick to the website's bottom right section.", "mk_framework") ,
    "fields" => array(
        array(
            "name" => __("Quick Contact", "mk_framework") ,
            "desc" => __("You can enable or disable Quick Contact Form using this option.", "mk_framework") ,
            "id" => "disable_quick_contact",
            "default" => 'true',
            "type" => "toggle",
        ) ,
        array(
            "name" => __("Quick Contact on Blog & News / Single Post ", "mk_framework") ,
            "desc" => __("You can disable Quick Contact Form on Blog & News Sinle Post using this option.", "mk_framework"),
            "id" => "quick_contact_on_single",
            "default" => 'true',
            "type" => "toggle",
        ) ,
        array(
            "name" => __("Quick Contact Title", "mk_framework") ,
            "desc" => __("", "mk_framework") ,
            "id" => "quick_contact_title",
            "default" => "Contact Us",
            "type" => "text",
        ) ,
        array(
            "name" => __("Quick Contact Email", "mk_framework") ,
            "desc" => __("This email will be used for sending this form's inqueries. Admin's email will be used as default email.", "mk_framework") ,
            "id" => "quick_contact_email",
            "default" => get_bloginfo('admin_email') ,
            "type" => "text",
        ) ,
        array(
            "name" => __("Quick Contact Description", "mk_framework") ,
            "desc" => "",
            "id" => "quick_contact_desc",
            "default" => "We're not around right now. But you can send us an email and we'll get back to you, asap.",
            "type" => "textarea",
        ) ,
        array(
            "name" => __("Enable Captcha?", "mk_framework") ,
            "desc" => sprintf(__("Keep away spam bots. %s", "mk_framework"), $captcha_plugin_status ) ,
            "id" => "captcha_quick_contact",
            "default" => 'true',
            "type" => "toggle",
        ) ,
    ) ,
);