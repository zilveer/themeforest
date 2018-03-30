<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$choices = array();
$choices['post'] = __('Blog Post');
if (function_exists( 'woffice_wiki_extension_on' )){
    $choices['wiki'] = __('Wiki Post');
}
if (function_exists( 'woffice_projects_extension_on' )){
    $choices['project'] = __('Project Post');
}

$options = array(
	'post_type' => array(
		'type'  => 'select',
	    'label' => __('New Post Type Created', 'woffice'),
        'desc' => __('Nothing will be displayed if the user isn\'t allowed to.', 'woffice'),
	    'choices' => $choices,
	    'value' => 'post'
	),
	
);