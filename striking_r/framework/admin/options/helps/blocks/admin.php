<?php

$help  = '<p>' . __('<h2 class="theme_help_title"><b>STRIKING MULTIFLEX ADMIN OVERVIEW</b></h2>
<h3 align="center"><i><font color="#DC2F2F">MULTIFLEX</font></i> <font color="#0c4892">= MULTIPURPOSE & FLEXIBLE =</font> <i><font color="#DC2F2F">YOUR SITE YOUR WAY</font></i></h3>
<p align="justify">Thank you for your purchase of Striking MultiFlex & Ecommerce Premium Responsive Wordpress Theme. &nbsp;The development team behind Striking has been committed for approaching 4 years to providing wordpress users an enriched, flexible, multipurpose wordpress theme that incorporates functions designed to allow a DIY (&#34;Do It Yourself&#34;) user to format and display their content in interesting ways without requiring any knowledge of the dreaded wordpress &#34;hooks&#34; and &#34;filters&#34; or html, css, php and js.  &nbsp;At the same time, Striking incorporates the necessary tools allowing advanced users and designers who are comfortable with web code to incorporate custom html, css and js into their design: some examples of this are custom css and custom js fields, advanced functions like inline lightbox capability, and fields in some shortcodes for assigning classes or id for custom css to modify the shortcode output.</p>
<p align="justify">To assist all users with their design imperatives, Striking MultiFlex provides 3 main resources for configuring the look of a website:</p><ul>
<li><b>Administration Panels</b> - theme level custom settings</li>
<li><b>Metaboxes</b> - page & post level custom settings</li>
<li><b>Shortcodes</b> - content level custom settings</li></ul>
<p align="justify">Between these 3 methods are hundreds of optional settings that allow one to manipulate the appearence of the website down to the granular level.  &nbsp;Every setting has a preconfigured default, so one can take one&#34;s time to learn how each setting will benefit the customization of a site, without being hindered at the outset of the site implementation.</p>
<p align="justify">The &#34;Help&#34; dropdown at the top of the Striking General Panel has detailed information on the 3 Striking resources and some general Wordpress administration related information for those previously unfamiliar with Wordpress.</p>
', 'theme_admin' ) .'</p>';

$screen->add_help_tab( array(
	'id'      => 'theme-admin',
	'title'   => __( 'Striking Admin' , 'theme_admin' ),
	'content' => $help,
) );

unset($help);