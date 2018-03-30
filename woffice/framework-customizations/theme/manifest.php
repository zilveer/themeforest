<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$manifest = array();

$manifest['id'] = 'woffice';

$manifest['name']         = __('Woffice', 'woffice');
$manifest['uri']          = 'themeforest.net/user/alkaweb';
$manifest['description']  = __('Another awesome Wordpress theme', 'woffice');
$manifest['version']      = '2.0.4';
$manifest['author']       = 'Alkaweb';
$manifest['author_uri']   = '//themeforest.net/user/alkaweb';

$manifest['supported_extensions'] = array(
	'page-builder' => array(),
	'megamenu' => array(),
	'backups' => array(),
);
