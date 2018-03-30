<?php
/**
 * Project of Megadrupal.com
 * Author: duongle
 * Date: 4/17/14
 * Time: 4:17 PM
 */

function default_layout()
{
    $layout = apply_filters('default_layout','MR');
    return $layout;
}

function footer_layout()
{
    $layout = apply_filters('footer_layout','1');
    return $layout;
}