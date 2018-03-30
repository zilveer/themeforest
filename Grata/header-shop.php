<?php
global $smof_data;
if (is_single()) {
    if (@$smof_data['good_sidebar_pos'] == 'No Sidebar')
    {
        define('IS_FULLWIDTH', TRUE);
    }
    elseif (@$smof_data['good_sidebar_pos'] == 'Left')
    {
        define('SIDEBAR_POS', 'left');
    }
    else
    {
        define('SIDEBAR_POS', 'right');
    }
} else {
    if (@$smof_data['shop_sidebar_pos'] == 'No Sidebar')
    {
        define('IS_FULLWIDTH', TRUE);
    }
    elseif (@$smof_data['shop_sidebar_pos'] == 'Left')
    {
        define('SIDEBAR_POS', 'left');
    }
    else
    {
        define('SIDEBAR_POS', 'right');
    }
}

get_header();