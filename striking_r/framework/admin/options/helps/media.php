<?php
$screen = get_current_screen();

$help = <<<HTML
<h2 class="theme_help_title">STRIKING MULTIFLEX MEDIA PANEL</h2>
<p align="justify">This panel has 7 resource tabs for control of the the video and audio media in the theme.  &nbsp;The settings in each tab are for height and width of the media frames, and for functions such as preloading, looping and autoplay, if supported by that media type.</p>
<p>In most instances, the shortcodes for the media below contain duplicate settings allowing for override of these theme defaults when a particular situation warrants unique settings.</p>

HTML;

$screen->add_help_tab( array(
	'id'      => 'mediapanel',
	'title'   => __( 'Striking Media Panel', 'theme_admin'),
	'content' => $help,
) );

unset( $help );

include('blocks/admin.php');
include('blocks/support.php');
include('blocks/sidebar.php');