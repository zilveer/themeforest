<?php
$screen = get_current_screen();

$help = <<<HTML
<h2 class="theme_help_title">STRIKING MULTIFLEX COLOR PANEL</h2>
<p align="justify">The MultiFlex Color panel has 11 resource tabs containing 145 color settings (at last count!) for control of theme wide colors for different theme elements.  &nbsp;The resource tabs are organized along the lines of the webpage sections, and for certain major functions such as Flat Design, Slideshows, Blogs, Portfolios, etc. &nbsp;Some resource tabs have a <b>&#34;Help Information&#34;</b> link which you can click on to open/close a dropdown field containing detailed information on the functions of the resource tab, and settings possess a help field where explanation of the setting is warranted.</p>
<p align="justify"><strong>NEW MULTIFLEX FEATURES :</strong> <b><span style="color:#0c4892">Modified Flat Design Option</span></b> - see the first resource tab below for more information on the usage and options for flat design in Striking MultiFlex.   &nbsp;There are approx 30 other new color settings in MultiFlex 1.0 and of special note are the new <b>Detail Elements Primary Color and Text Selection</b> settings found in the <b>Body Elements</b> resource tab.  &nbsp;The <b>Page Elements & Tags</b> tab also has a large number of new settings to accomodate presets for the new content boxes/pies/charts/carousels that one should quickly review for future reference.</p>
<p align="justify">Unlike most themes, Striking MultiFlex does not trap the user into a set group of color palettes (usually advertized as &#34;Skins&#34;), which is both very constraining, and is usually accompanied by very limited color options for the rest of the site elements.  &nbsp;Our experience based on user feedback is that colors settings are normally very easy to work with for the average user -> the theme has a predefined launch color palette but one will find that one can quickly change colors on the fly as desired in order to vary the website to your needs. &nbsp;In fact, as colors are a readily graspable concept, even custom css for colors is straightforward for most beginners, and often a good place to commence some special website creativity and learning some basic css.</p>
<p align="justify"><strong>NOTE:</strong> &nbsp;While the purpose of the color panel is to arrange color defaults for different display settings, almost all of these color defaults can be overridden either in a metabox or shortcode, so endless color customization is possible throughout of the content of your site.</p>
<p align="justify">The Striking Support forum (link is in the right sidebar) has many threads on customizing specific elements for color with custom code all laid out, and is a perfect way to get started on advancing basic css knowledge and adding that personal touch to the website.</p>

HTML;

$screen->add_help_tab( array(
	'id'      => 'colorpanel',
	'title'   => __( 'Striking Color Panel' , 'theme_admin' ),
	'content' => $help,
) );

unset( $help );

include('blocks/admin.php');
include('blocks/support.php');
include('blocks/sidebar.php');