<?php if (!defined('TFUSE')) exit('Direct access forbidden.');

$cfg['restricted_names'] = array(
    'load',
    'buffer',
    'include',
    'get',
    'theme',
    'ajax',
    'optigen',
    'optisave',
    'interface',
    'ext',
    'init',
    'callbacks',
    'input',
    'updater',
    'import',
    'export',
    'shortcodes',
    'session',
    'request'
);

$cfg['init_classes'] = array(
    'REQUEST',
    'LOAD',
    'INPUT',
    'BUFFER',
    'INCLUDE',
    'GET',
    'THEME',
    'OPTIGEN',
    'CALLBACKS',
    'OPTISAVE',
    'INTERFACE',
    'INIT',
    'EXT',
    'UPDATER',
    'AJAX',
    'SESSION'
);

$cfg['init_helpers'] = array(
    'GENERAL',
    'CACHE',
    'INTERFACE',
    'GET_EMBED',
    'GET_IMAGE',
    'DB_CONTAINER',
    'TFORM',
    'TFLASH',
    'TFWPML',
    'PRIVATE_DIR',
    'SEARCH_FORM',
);
