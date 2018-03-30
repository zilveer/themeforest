<?php

if( empty($id) ) $id = 0;

$slideshow_type = thb_get_post_meta($id, 'slideshow_type');
$slideshow_path = thb_get_module_path('core/slideshows/submodules/' . $slideshow_type);

$slideshow = new THB_Slideshow($id);
$slideshow->setBaseTemplate( $slideshow_path . '/templates' );
$slideshow->setSize( thb_config('core/slideshows/submodules/' . $slideshow_type, 'image_size') );
$slideshow->setMarkupId($markup_id);
$slideshow->render();