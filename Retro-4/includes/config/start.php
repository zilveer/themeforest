<?php

$theme_config = array(
	'theme_name' => 'Retro 4',
	'theme' => 'retro',
	'theme_includes' => get_template_directory() . '/includes',
	'theme_includes_uri' => get_template_directory_uri() . '/includes',
	'theme_op' => get_template_directory() . '/includes/config',
	'theme_xml' => 'http://version.opendept.net/retro-portfolio-4.xml'
);

$theme_defaults = array(
	'header-bg-color' => '#7AC0C0',
	'light-menu' => true,
	'logo-left' => false,
	'logo-up' => false,
	'disable-fixed' => false,
	'hide-sidebar-blog-page' => false,
	'hide-sidebar-blog-single' => false,
	'hide-sidebar-portfolio-single' => true,
	'hide-sidebar-page' => false,
	'background-color' => '#E3E0DD',
	'icons-bg-color' => '#D35244',
	'fonts-headings' => 'BazarMedium',
	'google-fonts-body' => 'http://fonts.googleapis.com/css?family=Roboto+Slab:400,700',
	'google-fonts-secondary' => 'http://fonts.googleapis.com/css?family=Oswald:400,700',
	'multiple-borders' => true,
	'slider-speed' => 500,
	'slider-pause-time' => 4000,
	'slider-auto-sliding' => false,
	'slider-pause-hover' => false,
	'article-number' => 3,
	'portfolio-number' => 8
);

require_once( get_template_directory() . '/openframe/start.php' );

?>