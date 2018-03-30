<?php
$screen = get_current_screen();

$help = <<<HTML
<h2 class="theme_help_title">STRIKING MULTIFLEX BACKGROUND PANEL</h2>
<p align="justify">The MultiFlex Background panel has 5 resource tabs for control of a theme wide background in each of the major sections of a webpage: header, feature header, body, footer, or page in box mode.</p>
<p align="justify"><b>NEW MULTIFLEX FEATURE:</b> &nbsp;<b><span style="color:#0c4892">Striking MultiFlex now includes 39 new preloaded backgrounds for the Box Mode</span></b>, which can be immediately selected by using the new setting <strong>Boxed Layout Subtle Pattern</strong> found below in the <b>Box Mode Background</b> resource tab. &nbsp;These are all subtle patterns intended for tiling. &nbsp;Any of these backgrounds can also be used as a background for one of the other sections by uploading the background image using the Custom Image button, from the unzipped Striking theme (path /striking_r/images/patterns/xxxpattern) on your desktop.
<p align="justify">Backgrounds have a myriad of settings and are considered an intermediate to advanced function, particularly in a responsive environment, where background behaviour is dependent upon the size of the background image, whether it is a repeating image or not, the viewports one wishes to display the background image, and more. &nbsp;With backgrounds, it is not just a matter of the settings, but of your  image and display goals, that determines its success as a background.</p>
<p align="justify">The theme provides all the settings for placing a background successfully, but it is recommended that users who are not so familiar with the art of responsive website backgrounds take some time to search for forum posts on the topic as well as visit the <a href="http://www.w3schools.com/css/css_background.asp" target="_blank">W3Schools Primer on Backgrounds</a> which includes some live learner adjustable demo content, to help familiarize oneself with background essentials. &nbsp;You will quickly recognize the settings in each resource tab and how they can assist you for your desired outcome.</p>
<p align="justify"><strong>->-> <u>A unique Striking MultiFlex feature is a setting allowing for creation of a different page background per page or post</u></strong>.  &nbsp;The setting for this feature is found in the <i>Page General Options Metabox/Page Design Settings Tab</i> (just below the setting to activate the Box Mode)  and any background loaded using this setting will override the generic page background (set below) for only that page or post. &nbsp;This feature provides one the option of a high degree of individuality per webpage, without having to resort to custom css for background placement in that webpage -> MulitFlex has you &#34;covered&#34; (any excuse for a pun....)!</p>

HTML;

$screen->add_help_tab( array(
	'id'      => 'backgroundpanel',
	'title'   => __( 'Striking Background Panel' , 'theme_admin' ),
	'content' => $help,
) );

unset( $help );

include('blocks/admin.php');
include('blocks/support.php');
include('blocks/sidebar.php');