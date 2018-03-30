<?php
/**
 * Include javascript and css files for admin option
 *
 */

global $TFUSE;

$TFUSE->include->register_type('slider_js', get_template_directory() . '/js');
$TFUSE->include->js('advanced', 'slider_js', 'tf_footer');

$TFUSE->include->register_type('slider_css_folder', get_template_directory() . '/css');
$TFUSE->include->css('custom_admin', 'slider_css_folder', 'tf_head');
