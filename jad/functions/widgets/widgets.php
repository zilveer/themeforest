<?php

/* Widgets */
require_once SG_TEMPLATEPATH.'/functions/widgets/widget.contact.php';
require_once SG_TEMPLATEPATH.'/functions/widgets/widget.flickr.php';
require_once SG_TEMPLATEPATH.'/functions/widgets/widget.twitter.php';
require_once SG_TEMPLATEPATH.'/functions/widgets/widget.pcategories.php';
require_once SG_TEMPLATEPATH.'/functions/widgets/widget.ptagcloud.php';

add_action('widgets_init', 'sg_unregister_widgets');
add_action('widgets_init', 'sg_register_widgets');

function sg_register_widgets()
{
	register_widget('SG_Widget_Contact');
	register_widget('SG_Widget_Flickr');
	register_widget('SG_Widget_Twitter');
	register_widget('SG_Widget_Portfolio_Categories');
	register_widget('SG_Widget_Portfolio_Tag_Cloud');
}

function sg_unregister_widgets()
{
	
}