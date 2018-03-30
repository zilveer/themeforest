<?php

//Testimonials

$edgtTestimonials = new EdgeMetaBox("testimonials", "Edge Testimonials");
$edgtFramework->edgtMetaBoxes->addMetaBox("testimonials",$edgtTestimonials);

	$edgt_show_testimonial_title_text = new EdgeMetaField("yesno","edgt_show_testimonial_title_text","no","Hide Testimonial Title Text","Enable this option to hide the title text", array(), array("dependence" => true, "dependence_hide_on_yes" => "#edgtf_edgt_testimonial_title_container", "dependence_show_on_yes" => ""));
	$edgtTestimonials->addChild("edgt_show_testimonial_title_text",$edgt_show_testimonial_title_text);

		$edgt_testimonial_title_container = new EdgeContainer("edgt_testimonial_title_container","edgt_show_testimonial_title_text","yes");
		$edgtTestimonials->addChild("edgt_testimonial_title_container",$edgt_testimonial_title_container);
	
			$edgt_testimonial_title= new EdgeMetaField("text","edgt_testimonial_title","","Title","Enter testimonial title");
			$edgt_testimonial_title_container->addChild("edgt_testimonial_title",$edgt_testimonial_title);
	
	$edgt_testimonial_author = new EdgeMetaField("text","edgt_testimonial-author","","Author","Enter author name");
	$edgtTestimonials->addChild("edgt_testimonial-author",$edgt_testimonial_author);

	$edgt_testimonial_author_position = new EdgeMetaField("text","edgt_testimonial_author_position","","Job Position","Enter job position name");
	$edgtTestimonials->addChild("edgt_testimonial_author_position",$edgt_testimonial_author_position);

	$edgt_testimonial_text = new EdgeMetaField("textarea","edgt_testimonial-text","","Text","Enter testimonial text");
	$edgtTestimonials->addChild("edgt_testimonial-text",$edgt_testimonial_text);