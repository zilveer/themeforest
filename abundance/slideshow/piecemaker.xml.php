<?php
header ("Content-Type:text/xml"); 
$paths = array(
		".",
		"..",
		"../..",
		"../../..",
		"../../../..",
		"../../../../..",
		"../../../../../..",
		"../../../../../../..",
		"../../../../../../../.."
	);
	
	foreach($paths as $path) 
	{
		if(@include( $path.'/wp-load.php'))
		{
			break;
		}
	}

$post_id = $_GET['post_id'];

$slider = new avia_slideshow($post_id);
$slider->generate_xml();
echo $slider->slideshow_xml;