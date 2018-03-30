<?php

//Carousels

$edgtCarousels = new EdgeMetaBox("carousels", "Edge Carousels");
$edgtFramework->edgtMetaBoxes->addMetaBox("carousels",$edgtCarousels);

	$edgt_carousel_image = new EdgeMetaField("image","edgt_carousel-image","","Carousel Image","Choose carousel image (min width needs to be 215px)");
	$edgtCarousels->addChild("edgt_carousel-image",$edgt_carousel_image);

	$edgt_carousel_hover_image = new EdgeMetaField("image","edgt_carousel-hover-image","","Carousel Hover Image","Choose carousel hover image (min width needs to be 215px)");
	$edgtCarousels->addChild("edgt_carousel-hover-image",$edgt_carousel_hover_image);

	$edgt_carousel_item_link = new EdgeMetaField("text","edgt_carousel-item-link","","Link","Enter the URL to which you want the image to link to (e.g. http://www.example.com)");
	$edgtCarousels->addChild("edgt_carousel-item-link",$edgt_carousel_item_link);

	$edgt_carousel_item_target = new EdgeMetaField("selectblank","edgt_carousel-item-target","","Target","Specify where to open the linked document", array(
        "_self" => "Self",
        "_blank" => "Blank"
    ));
	$edgtCarousels->addChild("edgt_carousel-item-target",$edgt_carousel_item_target);