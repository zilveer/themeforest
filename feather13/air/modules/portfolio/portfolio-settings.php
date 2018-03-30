<?php

// Set option name
AirSettings::set_option_name('air-portfolio');

/*-------------------------------------------------------------------------- */
/* Module Settings :: Portfolio
/*-------------------------------------------------------------------------- */

/* Sections
/*---------------------------------------------------------------------------*/

$sections = array(
	array(
		'id'	=> 'portfolio',
		'title'	=> 'Portfolio'
	),
	array(
		'id'	=> 'portfolio-archive',
		'title'	=> 'Archive Template <small>[ archive-portfolio.php ]</small>',
		'desc'	=> 'The settings below are used when the portfolio archive'.
			' is enabled. They do not apply to the Portfolio page template.'
	),
	array(
		'id'	=> 'portfolio-tax',
		'title'	=> 'Category Template <small>[ taxonomy-portfolio_category.php ]</small>',
		'desc'	=> 'The settings below do not apply to the Portfolio page template.'
	)
);


/* Fields
/*---------------------------------------------------------------------------*/

/* Portfolio Fields
/*-------------------------------------------------------*/

// Enable portfolio
$fields[] = array(
	'id'		=> 'portfolio-enable',
	'label'		=> 'Enable',
	'section'	=> 'portfolio',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'portfolio-enable'	=> 'Enable portfolio'
	)
);

// Label
$fields[] = array(
	'id'			=> 'label',
	'label'			=> 'Label',
	'section'		=> 'portfolio',
	'type'			=> 'text',
	'placeholder'	=> 'Portfolio'
);

// Disable Prev/Next Buttons
$fields[] = array(
	'id'		=> 'portfolio-prevnext',
	'label'		=> 'Previous / Next Links',
	'section'	=> 'portfolio',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'portfolio-prevnext' => 'Disable on single pages'
	)
);

// Disable Comments
$fields[] = array(
	'id'		=> 'portfolio-comments-disable',
	'label'		=> 'Disable Comments',
	'section'	=> 'portfolio',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'portfolio-comments-disable' => 'Disable comments on all portfolio posts'
	)
);

// Are permalinks enabled ?
if ( air_portfolio::$vars['PERMALINKS'] ):

	// Add Rewrite Slugs section
	array_splice($sections, 1, 0,
		array(
			array(
				'id'	=> 'portfolio-rewrite',
				'title'	=> 'Rewrite Slugs'
			)
		)
	);

	/* Rewrite Slugs
	/*-------------------------------------------------------*/

	// Post Type
	$fields[] = array(
		'id'			=> 'portfolio-rewrite-type',
		'label'			=> 'Post Type',
		'section'		=> 'portfolio-rewrite',
		'type'			=> 'text',
		'class'			=> 'medium-text',
		'placeholder'	=> 'portfolio'
	);

	// Taxonomy
	$fields[] = array(
		'id'			=> 'portfolio-rewrite-taxonomy',
		'label'			=> 'Category',
		'section'		=> 'portfolio-rewrite',
		'type'			=> 'text',
		'class'			=> 'medium-text',
		'placeholder'	=> 'category'
	);

endif;


/* Archive Fields
/*-------------------------------------------------------*/

// Enable archive
$fields[] = array(
	'id'		=> 'archive-enable',
	'label'		=> 'Enable',
	'section'	=> 'portfolio-archive',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'has_archive' => 'Enable portfolio archive'
	)
);

// Heading
$fields[] = array(
	'id'			=> 'archive-heading',
	'label'			=> 'Heading',
	'section'		=> 'portfolio-archive',
	'type'			=> 'text',
	'placeholder'	=> air_portfolio::get_option('label','Portfolio')
);

// Subheading
$fields[] = array(
	'id'			=> 'archive-subheading',
	'label'			=> 'Subheading',
	'section'		=> 'portfolio-archive',
	'type'			=> 'text',
	'placeholder'	=> ''
);

// Posts per Page
$fields[] = array(
	'id'			=> 'archive_posts_per_page',
	'label'			=> 'Posts per Page',
	'section'		=> 'portfolio-archive',
	'type'			=> 'text',
	'class'			=> 'small-text',
	'placeholder'	=> '10'
);

// Layout (Size)
$fields[] = array(
	'id'		=> 'archive_layout',
	'label'		=> 'Size',
	'section'	=> 'portfolio-archive',
	'type'		=> 'select',
	'choices'	=> array(
		'grid one-fourth'	=> 'Small',
		'grid one-third'	=> 'Medium',
		'grid one-half'		=> 'Large'
	)
);

// Lightbox
$fields[] = array(
	'id'		=> 'archive_lightbox',
	'label'		=> 'Lightbox',
	'section'	=> 'portfolio-archive',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'archive_enable_lightbox'			=> 'Enable lightbox',
		'archive_enable_lightbox_gallery'	=> 'Show lightbox images as gallery'
	)
);

// Disable
$fields[] = array(
	'id'		=> 'archive_disable',
	'label'		=> 'Disable',
	'section'	=> 'portfolio-archive',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'archive_disable_switcher'		=> 'Disable size switcher',
		'archive_disable_category_menu' => 'Disable category menu'
	)
);


/* Category Fields
/*-------------------------------------------------------*/

// Posts per Page
$fields[] = array(
	'id'			=> 'taxonomy_posts_per_page',
	'label'			=> 'Posts per Page',
	'section'		=> 'portfolio-tax',
	'type'			=> 'text',
	'class'			=> 'small-text',
	'placeholder'	=> '10'
);

// Layout (Size)
$fields[] = array(
	'id'		=> 'taxonomy_layout',
	'label'		=> 'Size',
	'section'	=> 'portfolio-tax',
	'type'		=> 'select',
	'choices'	=> array(
		'grid one-fourth'	=> 'Small',
		'grid one-third'	=> 'Medium',
		'grid one-half'		=> 'Large'
	)
);

// Lightbox
$fields[] = array(
	'id'		=> 'taxonomy_lightbox',
	'label'		=> 'Lightbox',
	'section'	=> 'portfolio-tax',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'taxonomy_lightbox_enable'	=> 'Enable lightbox',
		'taxonomy_lightbox_gallery'	=> 'Show lightbox images as gallery'
	)
);

// Disable
$fields[] = array(
	'id'		=> 'taxonomy_disable',
	'label'		=> 'Disable',
	'section'	=> 'portfolio-tax',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'taxonomy_disable_switcher'			=> 'Disable size switcher',
		'taxonomy_disable_category_menu'	=> 'Disable category menu'
	)
);
