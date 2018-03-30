<?php
$screen = get_current_screen();

$help = <<<HTML
<h2 class="theme_help_title">STRIKING MULTIFLEX SLIDESHOW PANEL</h2>
<h3>Introduction</h3>
<p align="justify">Striking MultiFlex has a variety of slideshow type resources - some are for the feature header area only, and others are also shortcoded so that they can be used almost anywhere in content.</p>

HTML;

$screen->add_help_tab( array(
	'id'      => 'slideshowpanel',
	'title'   => __( 'Striking Slideshow Panel', 'theme_admin' ),
	'content' => $help,
) );

unset( $help );

include('blocks/admin.php');
include('blocks/support.php');
include('blocks/sidebar.php');