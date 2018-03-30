<?php
$screen = get_current_screen();

$help = <<<HTML
<h2 class="theme_help_title">STRIKING MULTIFLEX FOOTER PANEL</h2>
<p>This panel has 2 resource tabs for control of the the footer layout, and subfooter functions. &nbsp;The Subfooter admin tab contains the settings for the sub-footer widget area and the copyright text field.</p>

HTML;

$screen->add_help_tab( array(
	'id'      => 'footerpanel',
	'title'   => __( 'Striking Footer Panel' , 'theme_admin' ),
	'content' => $help,
) );

unset( $help );

include('blocks/admin.php');
include('blocks/support.php');
include('blocks/sidebar.php');