<?php
$screen = get_current_screen();

$help = <<<HTML
<h2 class="theme_help_title">STRIKING MULTIFLEX HOMEPAGE PANEL</h2>
<p>The Homepage panel is intended as a &#34;quickstart&#34; homepage used in conjunction with the Striking default menu.  &nbsp;Users familiar with wordpress, custom menus, and setting a static homepage may choose to skip using this homepage panel altogether and immediately create a custom page to be used as a static homepage.</p>
<p>If proceeding immediately to a static page, then after creating that page use the first setting in this panel &#34;Homepage&#34; to designate that custom page as the site homepage.  &nbsp;All the pages in the site will appear in the dropdown field of the Homepage setting. &nbsp;The selected page will show as the static page in the wordpress Settings/Reading admin panel.</p>
<p>If choosing to use this hompage panel, the tabs below contain settings for designating the  feature header slider, and the main content editor.  &nbsp;The Homepage panel does not have the Striking Page General Options metabox and lacks the fine control a custom page built in Striking contains.</p>
<p><b>IMPORTANT INFORMATION IF USING AN SEO PLUGIN</b> - If using an seo plugins such as Yoast SEO or All In One SEO then one has to create a static page to be used as a homepage.  &nbsp;The plugins will not detect the default homepage built using this panel.</p>

HTML;

$screen->add_help_tab( array(
	'id'      => 'homepagepanel',
	'title'   => __( 'Striking Homepage Panel' , 'theme_admin' ),
	'content' => $help,
) );

unset( $help );

include('blocks/admin.php');
include('blocks/support.php');
include('blocks/sidebar.php');