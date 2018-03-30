<?php if (!defined('FW')) die('Forbidden');

function disable_default_shortcodes($to_disabled)
{
    //fw_print($all_shortcodes);
    $to_disabled[] = 'accordion';
    $to_disabled[] = 'contact_form';
    //$to_disabled[] = 'button';
    $to_disabled[] = 'calendar';
    //$to_disabled[] = 'column';
    $to_disabled[] = 'divider';
    //$to_disabled[] = 'call_to_action';
    $to_disabled[] = 'table';
    //$to_disabled[] = 'icon';
    $to_disabled[] = 'map';
    $to_disabled[] = 'media_image';
    $to_disabled[] = 'media_video';
    $to_disabled[] = 'notification';
    //$to_disabled[] = 'row';
    //$to_disabled[] = 'section';
    //$to_disabled[] = 'special_heading';
    //$to_disabled[] = 'tabs';
    //$to_disabled[] = 'widget_area';
    //$to_disabled[] = 'icon_box';
    $to_disabled[] = 'team_member';
    return $to_disabled;
}
add_filter('fw_ext_shortcodes_disable_shortcodes', 'disable_default_shortcodes');