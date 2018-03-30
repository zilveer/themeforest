<?php
global $smof_data;
require get_template_directory().'/framework/templates/multiple-blog.php';
require get_template_directory().'/framework/dynamic/dynamic.php';
if(class_exists('CsCoreControl')){
    require_once 'metabox/page_extra_options.php';
    require_once 'metabox/portfolio.php';
}
if(class_exists('Vc_Manager')){
    require_once 'vc_extra_params.php';
}
get_template_part('framework/widgets');