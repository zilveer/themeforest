<?php
global $orange_themes_managment;
$orangeThemes_documentation_options= array(
 array(
	"type" => "navigation",
	"name" => "Contact Info",
	"slug" => "contact"
),

array(
	"type" => "tab",
	"slug"=>'documentation'
),

array(
	"type" => "sub_navigation",
	"subname"=>array(
		array("slug"=>"documentation", "name"=>"Contact Info")
		)
),

/* ------------------------------------------------------------------------*
 * DOCUMENTATION SLIDER SETTINGS
 * ------------------------------------------------------------------------*/

array(
	"type" => "sub_tab",
	"slug"=>'documentation'
),

array(
	"type" => "row"
),

 array(
	"type" => "text",
	"text"=>'<h2>'.THEME_FULL_NAME.' Support </h2>
			<p>Please note that there is a documentation included where all the theme customization settings are explained. The documentation is located within the documentation folder, or You can view an example of documentation here: <a href="http://'.THEME_NAME.'orange-themes.com/documentation/"><strong>http://'.THEME_NAME.'.orange-themes.com/documentation/</strong></a></p>
			<h2 style="padding-top:30px;">If you have any questions </h2>
			<p>It is faster for us to communicate with clients using our forum <a href="http://support.orange-themes.com" target="_blank"><strong>support.orange-themes.com</strong></a></p>
			<p>If you like this theme or wish to receive e-mail updates about or products etc., please be sure to subscribe to our mailing list at <a href="http://www.orange-themes.com/subscribe/"><strong>http://www.orange-themes.com/subscribe/</strong></a></p>

			<h2 style="padding-top:30px;">Theme support policy</h2>
			<em>Orange Themes reserve the right to reject support to a theme if any of the following conditions are violated or not obeyed.</em>
			<ul>
				<li>Reread the documentation prior to contacting us. Ensure that your problem is not described there. The documentation is added to every theme, as well as description of every theme contains a link to the documentation.</li>
				<li>
			<p lang="en-US">We support only themes developed by Orange Themes.</p>
			</li>
				<li>
			<p lang="en-US">Themes are not for commercial use, excluding if an Extended License is purchased.</p>
			</li>
				<li>
			<p lang="en-US">Ensure that your server supports the latest PHP version; ensure as well that the particular Wordpress version is supported by the theme. We suggest updates to be performed always, except cases indicated in the theme description.</p>
			</li>
				<li>
			<p lang="en-US">Check if the problem remains after you turn off all Wordpress plug-ins.</p>
			</li>
				<li>Use Support forum to contact us <a href="http://support.orange-themes.com" target="_blank"><strong>support.orange-themes.com</strong></a></li>
				<li>
			</li>
				<li>Indicate a type of browser and its version where the error appeared.</li>
				<li>If there are any visual problems it is advisable to add a screenshot of the page where the error appears.</li>
				<li>
			<p lang="en-US">Try to describe the problem precisely and in details. In case of necessity, add a link to the image.</p>
			</li>
				<li>
			<p lang="en-US">We do not guarantee that the theme is compatible with all available plug-ins. There may be cases when plug-in is incompatible with the theme and has to be turned off.</p>
			</li>
				<li>
			<p lang="en-US">We do not provide support if the theme has been modified, i.e., if any files have been modified and afterwards it does not work, then we do not provide support. Excluding cases when a separate order has been made and paid for.</p>
			</li>
				<li>
			<p lang="en-US">Any supplements or modifications of the theme shall be formalized as a separate purchase.</p>
			</li>
				<li>
			<p lang="en-US">The reply shall be given within one working day.</p>
			</li>
				<li>Orange Themes reserves the right to amend the terms of usage without a prior notice!</li>
			</ul>
'
),

array(
	"type" => "close"
),

array(
	"type" => "save",
	"title" => "Save Changes"
),

array(
	"type" => "closesubtab"
),

array(
	"type" => "closetab"
)
 
 
);

$orange_themes_managment->add_options($orangeThemes_documentation_options);
 
?>