<?php

/*---------------------------------------------------------------------------*/
/* Theme Settings :: Footer
/*---------------------------------------------------------------------------*/

/* Sections
/*---------------------------------------------------------------------------*/

$sections = array(
	array(
		'id'	=> 'footer-widgets',
		'title'	=> 'Footer Widgets'
	),
	array(
		'id'	=> 'footer-text',
		'title'	=> 'Footer Copyright',
	),
	array(
		'id'	=> 'footer-contact',
		'title'	=> 'Contact Information'
	)
);


/* Fields
/*---------------------------------------------------------------------------*/

/* Footer Widgets
/*-------------------------------------------------------*/

// Footer Widgets
$fields[] = array(
	'id'		=> 'footer-widgets',
	'label'		=> 'Enable',
	'section'	=> 'footer-widgets',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'footer-widgets' => 'Enable footer widgets'
	)
);

/* Footer Text
/*-------------------------------------------------------*/

// Footer text
$fields[] = array(
	'id'		=> 'footer-text',
	'label'		=> 'Text',
	'section'	=> 'footer-text',
	'type'		=> 'textarea',
	'rows'		=> '2',
	'cols'		=> '10'
);

/* Contact Information
/*-------------------------------------------------------*/

// Enable footer contact information
$fields[] = array(
	'id'		=> 'footer-contact-enable',
	'label'		=> 'Enable',
	'section'	=> 'footer-contact',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'footer-contact-enable' => 'Display contact information in footer'
	)
);

// Footer Address
$fields[] = array(
	'id'			=> 'footer-address',
	'label'			=> 'Address',
	'section'		=> 'footer-contact',
	'type'			=> 'text'
);

// Footer Phone
$fields[] = array(
	'id'			=> 'footer-phone',
	'label'			=> 'Phone',
	'section'		=> 'footer-contact',
	'type'			=> 'text'
);

// Footer Email
$fields[] = array(
	'id'			=> 'footer-email',
	'label'			=> 'Email',
	'section'		=> 'footer-contact',
	'type'			=> 'text'
);
