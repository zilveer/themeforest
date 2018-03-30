<?php if (!defined('FW')) die('Forbidden');

$manifest = array();

$manifest['id']           = 'apital';
$manifest['name']         = __('Apital', 'fw');
$manifest['uri']          = 'http://nrgthemes.com/';
$manifest['description']  = __('Multi-Purpose Business Template', 'fw');
$manifest['version']      = '1.0';
$manifest['author']       = 'Nrgthemes';
$manifest['author_uri']   = 'http://nrgthemes.com/';
$manifest['requirements'] = array(
    'wordpress' => array(
        'min_version' => '4.0',
    )
);

$manifest['supported_extensions'] = array(
    'sidebars' => array(),
    'portfolio' => array(),
    'page-builder' => array(),
    'backup' => array(),
    'seo' => array(),
    'social' => array(),
    'breadcrumbs' => array(),
    'slider' => array(),
    'megamenu' => array()
);