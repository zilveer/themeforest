<?php
$screen = get_current_screen();

$help = <<<HTML
<h2 class="theme_help_title">STRIKING MULTIFLEX IMAGE PANEL</h2>
<p>This panel has a resource tab with a setting used to create new custom image sizes, and tabs with settings for adjusting the dimenisions of each of the current preset image sizes - small, medium and large, used in the Image shortcode.</p>
<p>The image shortcode provides two different ways of setting image size. &nbsp;A custom height and width can be set for each image loaded, but sometimes there is a large number of images in a unique size to be displayed in a website via the shortcode and so having to set dimensions each time can be cumbersome.  &nbsp;Alternatively, new image sizes can be created using the panel settings below, and these sizes will show up in the image shortcode <b>Size</b> setting dropdown selector for easy quick selection.</p>
<p><b>USAGE:</b> &nbsp;Creating the new image sizes is very simple -> enter an image size name below in to the field and save the tab. &nbsp;The new size will appear as another tab below the 3 theme presets. &nbsp;Go to the new tab and use the width and height settings to set the image size. &nbsp;Save and all done!</p>

HTML;

$screen->add_help_tab( array(
	'id'      => 'imagepanel',
	'title'   => __( 'Striking Image Panel' , 'theme_admin' ),
	'content' => $help,
) );

unset( $help );

include('blocks/admin.php');
include('blocks/support.php');
include('blocks/sidebar.php');