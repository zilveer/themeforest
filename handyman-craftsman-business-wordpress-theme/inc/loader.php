<?php
/**
 * Register class auto loader
 */
require_once 'core/class-loader.php';

$tl_loader = Handyman\Core\Loader::loader();

$tl_loader->addPrefixes(array(
    'Handyman\Core'          => array(get_stylesheet_directory() . '/inc/core',
                                      get_stylesheet_directory() . '/inc/core/customizer',
                                      get_stylesheet_directory() . '/inc/core/customizer/controls'),
    'Handyman\Front'         => get_stylesheet_directory() . '/inc',
    'Handyman\Admin\Ui'      => get_stylesheet_directory() . '/inc/admin/ui',
    'Handyman\Admin\Metabox' => get_stylesheet_directory() . '/inc/admin',
    'Handyman\Admin'         => get_stylesheet_directory() . '/inc/admin',
    'Handyman'               => get_stylesheet_directory() . '/inc',
    'Handyman\Customizer\Control' => get_stylesheet_directory() . '/inc/core/customizer/controls'
));
$tl_loader->register(true);