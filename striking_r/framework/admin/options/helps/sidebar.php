<?php
$screen = get_current_screen();

$help = <<<HTML
<h2 class="theme_help_title">STRIKING MULTIFLEX SIDEBAR PANEL</h2>
<p>This panel has 3 tabs for creating and assigning custom sidebars to page and post types in the website.  &nbsp;The Sidebar Generator Tab is for creating custom sidebars, and the other two tabs are for assigning sidebars to the various pages and archives in the website. </p>
<p>After having created a custom sidebar, go to the Widgets section of the WP admin and all the custom sidebars created will appear below the list of regular sidebars. &nbsp;&nbsp;Drag into a custom sidebar the widgets you wish to appear in the page or post sidebar when that webpage is viewed. &nbsp;As of WP 3.8, each widget also has a built in sidebar selector as an alternative to drag and drop.</p><p>There is no limit to the number of custom sidebars in a site. &nbsp;If even more control is needed over widgets appearing in sidebars, then please visit the wordpress.org plugin index and download a widget control plugin such as Dynamic Widgets, Widget Logic or Widgets Controller. &nbsp;However, the Striking Custom Sidebar can alleviate the need for a widget plugin in most instances, and reduces the processing overhead  a plugin script incurs on a page load.</p>
<p><strong><u>SPECIAL USAGE NOTE:</u></strong> &nbsp;&nbsp;the 2 Global Settings tabs allow one to assign a custom sidebar to all pages, to all blog posts, to all portfolio posts, and for all the different archive page types.  &nbsp;However, custom sidebars can also be assigned on a case by case basis per webpage (pages/posts/products/media attachments). &nbsp;To do so use the <strong>Custom Sidebar</strong> setting which is found in the <i>Page General Options</i> metabox found below the wp content editor. <b><span style="color:#0c4892">Every normal webpage in a website can have its own unique sidebar by using this setting combined with creating a custom sidebar for each webpage.</span></b></p> 
<p><strong><u>NEW TABS UPON PLUGIN CUSTOM POST TYPE DETECTION:</u></strong>  &nbsp;&nbsp;If one has activated a plugin which generates a valid custom post type, such as an ecommerce plugin and some image management plugins, then new admin tabs will appear below for management of custom sidebars for the custom post type pages and its taxonomies.

HTML;

$screen->add_help_tab( array(
	'id'      => 'sidebarpanel',
	'title'   => __( 'Striking Sidebar Panel' , 'theme_admin' ),
	'content' => $help,
) );

unset( $help );

include('blocks/admin.php');
include('blocks/support.php');
include('blocks/sidebar.php');