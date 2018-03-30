<?php

$prefix = 'pageoptions_';

$fields = array(
	array( // Taxonomy Select box
		'label'	=> 'Portfolio Category', // <label>
		'desc'  => 'Choose what portfolio type you want to display on this page. <strong>Note</strong>: Works on Homepage and Portfolio Pages only.',// the description is created in the callback function with a link to Manage the taxonomy terms
		'id'	=> 'portfolio_type', // field id and name, needs to be the exact name of the taxonomy
		'type'	=> 'tax_select' // type of field
	)
	
);

/**
 * Instantiate the class with all variables to create a meta box
 * var $id string meta box id
 * var $title string title
 * var $fields array fields
 * var $page string|array post type to add meta box to
 * var $js bool including javascript or not
 */
$pageoptions_box = new custom_add_meta_box( 'pageoptions_box', 'Page Options', $fields, 'page', false );



$prefix = 'contactpage_';

$fields = array(
	array( // Text Input
		'label'	=> 'Map Address for Contact page', // <label>
		'desc'	=> 'Add your map address here.  Latitude and Longitude also work.', // description
		'id'	=> $prefix.'mapaddress', // field id and name
		'type'	=> 'textarea' // type of field
	),
	array( // Text Input
		'label'	=> 'Contact Page Email Address', // <label>
		'desc'	=> 'Add the e-mail address you want to use for your e-mails using the default contact form. Alternatively you can use the "Contact Form 7 Plugin" from wordpress.org', // description
		'id'	=> $prefix.'emailaddress', // field id and name
		'type'	=> 'text' // type of field
	)
);

/**
 * Instantiate the class with all variables to create a meta box
 * var $id string meta box id
 * var $title string title
 * var $fields array fields
 * var $page string|array post type to add meta box to
 * var $js bool including javascript or not
 */
$contactpage_box = new custom_add_meta_box( 'contactpage_box', 'Contact Page Options', $fields, 'page', false );




$prefix = 'videoembed_';

$fields = array(
	array( // Text Input
		'label'	=> 'Video Embed Code', // <label>
		'desc'	=> 'Add your video embed code here.  This will replace your featured image.', // description
		'id'	=> $prefix.'videoembed', // field id and name
		'type'	=> 'textarea' // type of field
	)
);

/**
 * Instantiate the class with all variables to create a meta box
 * var $id string meta box id
 * var $title string title
 * var $fields array fields
 * var $page string|array post type to add meta box to
 * var $js bool including javascript or not
 */
$videoembed_box = new custom_add_meta_box( 'videoembed_box', 'Video Embed', $fields, 'post', false );




$prefix = 'portfoliooptions_';

$fields = array(
	array( // Text Input
		'label'	=> 'Video Embed Code', // <label>
		'desc'	=> 'Add your video embed code here.  This will replace your featured image.', // description
		'id'	=> $prefix.'videoembed', // field id and name
		'type'	=> 'textarea' // type of field
	),
	array( // Text Input
		'label'	=> 'Video Lightbox Link', // <label>
		'desc'	=> 'Paste in your video link here if you want to link to a video in the lightbox pop-up.', // description
		'id'	=> $prefix.'lightbox', // field id and name
		'type'	=> 'text' // type of field
	),
	array( // Text Input
		'label'	=> 'External Link', // <label>
		'desc'	=> 'Paste in a link to an external document here.', // description
		'id'	=> $prefix.'externallink', // field id and name
		'type'	=> 'text' // type of field
	)
);

/**
 * Instantiate the class with all variables to create a meta box
 * var $id string meta box id
 * var $title string title
 * var $fields array fields
 * var $page string|array post type to add meta box to
 * var $js bool including javascript or not
 */
$portfoliooptions_box = new custom_add_meta_box( 'portfoliooptions_box', 'Portfolio Options', $fields, 'portfolio', false );







$prefix = 'menuoption_';

$fields = array(
	array( // Text Input
		'label'	=> 'Item Price', // <label>
		'desc'	=> 'Add your product price here.', // description
		'id'	=> $prefix.'menu_pricing', // field id and name
		'type'	=> 'text' // type of field
	)
);

/**
 * Instantiate the class with all variables to create a meta box
 * var $id string meta box id
 * var $title string title
 * var $fields array fields
 * var $page string|array post type to add meta box to
 * var $js bool including javascript or not
 */
$portfoliooptions_box = new custom_add_meta_box( 'menuoption_box', 'Menu Options', $fields, 'menu', false );


