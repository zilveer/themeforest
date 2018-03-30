<?php

/*---------------------------------------------------------------------------*/
/* Theme Settings :: 
/*---------------------------------------------------------------------------*/

/* Sections
/*---------------------------------------------------------------------------*/

$sections = array(
	array(
		'id'	=> 'styling-advanced',
		'title'	=> 'Advanced Styling'
	),
	array(
		'id'	=> 'styling-color',
		'title'	=> 'Theme Color',
	),
	array(
		'id'	=> 'styling-misc',
		'title'	=> 'Miscellaneous'
	),
	array(
		'id'	=> 'styling-body',
		'title'	=> 'Body'
	)
);


/* Fields
/*---------------------------------------------------------------------------*/

/* Advanced Styling
/*-------------------------------------------------------*/

// Enable advanced styling
$fields[] = array(
	'id'		=> 'advanced-css',
	'label'		=> 'Enable to use',
	'section'	=> 'styling-advanced',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'advanced-css' => '<strong>Enable styling options</strong> <small>(style-advanced.css)</small>'
	)
);

/* Theme Color
/*-------------------------------------------------------*/

// Color 1
$fields[] = array(
	'id'			=> 'styling-color-1',
	'label'			=> 'Color',
	'section'		=> 'styling-color',
	'type'			=> 'colorpicker',
	'placeholder'	=> '00c8d6'
);

// Color 2
$fields[] = array(
	'id'			=> 'styling-color-2',
	'label'			=> 'Color Secondary',
	'section'		=> 'styling-color',
	'type'			=> 'colorpicker',
	'placeholder'	=> 'fcee21'
);

// Color 3
$fields[] = array(
	'id'			=> 'styling-color-3',
	'label'			=> 'Logo Background Color',
	'section'		=> 'styling-color',
	'type'			=> 'colorpicker',
	'placeholder'	=> ''
);

// Quote Text Color
$fields[] = array(
	'id'		=> 'styling-color-quote',
	'label'		=> 'Quote Text Color',
	'section'	=> 'styling-color',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'styling-color-quote' => 'Use white color for quote format post'
	)
);

/* Miscellaneous
/*-------------------------------------------------------*/

// Misc Paper Effect
$fields[] = array(
	'id'		=> 'styling-misc-paper',
	'label'		=> 'Paper Effect',
	'section'	=> 'styling-misc',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'styling-misc-paper' => 'Disable stacked paper effect'
	)
);

// Misc Box Shadow
$fields[] = array(
	'id'		=> 'styling-misc-box-shadow',
	'label'		=> 'Box Shadows',
	'section'	=> 'styling-misc',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'styling-misc-box-shadow' => 'Disable box shadows'
	)
);

// Misc Glass Effect
$fields[] = array(
	'id'		=> 'styling-misc-glass-effect',
	'label'		=> 'Glass Effect',
	'section'	=> 'styling-misc',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'styling-misc-glass-effect' => 'Disable on portfolio and blog thumbnails'
	)
);

// Misc Stick Header
$fields[] = array(
	'id'		=> 'styling-misc-stick-header',
	'label'		=> 'Stick Header Top',
	'section'	=> 'styling-misc',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'styling-misc-stick-header' => 'Stick the header to top of the browser window'
	)
);

// Misc Vertical Images (Gallery)
$fields[] = array(
	'id'		=> 'styling-misc-vertical-image',
	'label'		=> 'Gallery Image Height',
	'section'	=> 'styling-misc',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'styling-misc-vertical-image' => 'Limit vertical image height in galleries to 700px'
	)
);

/* Body
/*-------------------------------------------------------*/

// Body BG Color
$fields[] = array(
	'id'			=> 'styling-body-bg-color',
	'label'			=> 'Background Color',
	'section'		=> 'styling-body',
	'type'			=> 'colorpicker',
	'placeholder'	=> '262626'
);

// Body BG Image
$fields[] = array(
	'id'		=> 'styling-body-bg-image',
	'label'		=> 'Background Image',
	'section'	=> 'styling-body',
	'type'		=> 'image'
);

// Body BG Image Repeat
$fields[] = array(
	'id'		=> 'styling-body-bg-image-repeat',
	'label'		=> 'Background Image Repeat',
	'section'	=> 'styling-body',
	'type'		=> 'select',
	'choices'	=> array(
		'repeat'	=> 'repeat',
		'no-repeat' => 'no-repeat',
		'repeat-x'	=> 'repeat-x',
		'repeat-y'	=> 'repeat-y'
	)
);
