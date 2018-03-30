<?php

/**
 * just to make our nice widget simple conform
 */
class SimpleWidgetBlog extends BebelWidgetBlog
{
  protected
    $desc_name   = 'Blog Widget (main, side)',
    $widget_settings = array(
        'width' => '300px',
        'bundle' => 'simpleBaseBundle',
    );
}