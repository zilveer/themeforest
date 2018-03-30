<?php
    global $_SETTINGS;
    $head = $_SETTINGS->admin_head;
    $body = $_SETTINGS->admin_body;
    $view = plsh_get($_GET, 'view', $head[key($head)]['slug']);   //get view; defaults to first element of header
    $section = plsh_get($_GET, 'section', 'ads_manager');   //get view; defaults to first element of header
    
    if($section == 'ads_manager')
    {
        plsh_get_admin_template('ads-edit');
    }
    else
    {
        plsh_get_admin_template('ads-locations');
    }
?>