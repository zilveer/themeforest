<?php
$screen = get_current_screen();

$help = <<<HTML
<h2 class="theme_help_title">STRIKING MULTIFLEX ADVANCED PANEL</h2>
<p align="justify">This panel has 11 resource tabs for control of various theme functions including setting the twitter functionality, woocommerce integration and control, and the internal Striking Update function.</p>
<p>This is a very feature filled panel. &nbsp;Most of the settings do not need immediate attention but taking the time to review them at a later date will provide many benefits to fine tuning the site appearence and behaviour. &nbsp;Many of the settings have very detailed help fields for understanding of function.</p>
<p>There are several changes to the Advanced Panel versus the prior Striking 5 non responsive series. &nbsp;A new addition to Striking MultiFlex and unusual among themes is a Responsive resource tab which provides settings that allow for some choice as to viewports that certain theme header elements will behave. &nbsp;The Responsive resource tab also contains the setting for disabling all responsive behaviour of the website. &Most of the optimization settings such as combine css, and combine js have been removed as the theme scripts now undertake this automatically.</p>
<p><b><span style="color:#0c4892">WooCommerce now has its own resource tab as Striking MultiFlex has many specialized features and adaptions specifically for users of Woocommerce.</span></b> &nbsp;Two other new tabs are for layout and features of a 404 page, and a Search Results page, meeting requests from users to have more control over these wp page templates.</p>
<p>Striking <u>MultiFlex has advanced wp archive support</u>. &nbsp;Using the custom sidebar panel, there is the ability to create and assign custom sidebars to each wp archive type. &nbsp;And the Advanced Panel features an Archive Feature Header Resource Tab, where customized feature header content (with html and shortcode support) can be created for every archive type. &nbsp;These rare features give the site builder the opportunity to customize the archive pages to an unusual extent without any coding knowledge required!</p>

HTML;

$screen->add_help_tab( array(
	'id'      => 'advancedpanel',
	'title'   => __( 'Striking Advanced Panel' , 'theme_admin' ),
	'content' => $help,
) );
unset( $help );

include('blocks/admin.php');
include('blocks/support.php');
include('blocks/sidebar.php');