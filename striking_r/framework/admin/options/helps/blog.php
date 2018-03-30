<?php
$screen = get_current_screen();

$help = <<<HTML
<h2 class="theme_help_title">STRIKING BLOG PANEL</h2>
<p>This panel has 7 resource tabs for control of the the various blog related functions. &nbsp;Settings in the various resource tabs are applicable to the static blog page, the single post page, and the blog shortcode. &nbsp;Most of the tabs contain a Help Introduction and settings contain more detailed help fields where necessary.</p>

HTML;

$screen->add_help_tab( array(
	'id'      => 'blogpanel',
	'title'   => __( 'Striking Blog Panel' , 'theme_admin' ),
	'content' => $help,
) );

unset( $help );

include('blocks/admin.php');
include('blocks/support.php');
include('blocks/sidebar.php');