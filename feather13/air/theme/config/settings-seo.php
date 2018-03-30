<?php

/*---------------------------------------------------------------------------*/
/* Theme Settings :: 
/*---------------------------------------------------------------------------*/

/* Sections
/*---------------------------------------------------------------------------*/

$sections = array(
	array(
		'id'	=> 'seo-disable',
		'title'	=> 'Disable'
	),
	array(
		'id'	=> 'seo-title',
		'title'	=> 'Title'
	),
	array(
		'id'	=> 'seo-home-page',
		'title'	=> 'Home Page',
	),
	array(
		'id'	=> 'seo-robot-meta-tags',
		'title'	=> 'Robot Meta Tags'
	)
);


/* Fields
/*---------------------------------------------------------------------------*/

/* Disable
/*-------------------------------------------------------*/

// Append site name to title
$fields[] = array(
	'id'		=> 'seo-disable',
	'label'		=> 'Disable',
	'section'	=> 'seo-disable',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'seo-disable' => 'Disable built-in SEO support'
	),
);

/* Title
/*-------------------------------------------------------*/

// Append site name to title
$fields[] = array(
	'id'		=> 'seo-title-append-sitename',
	'label'		=> 'Site Name',
	'section'	=> 'seo-title',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'seo-title-append-sitename' => 'Append site name to title'
	),
	'default'	=> array(
		'seo-title-append-sitename' => '1'
	)
);

// Title separator
$fields[] = array(
	'id'			=> 'seo-title-separator',
	'label'			=> 'Separator',
	'section'		=> 'seo-title',
	'type'			=> 'text',
	'class'			=> 'small-text aligncenter',
	'placeholder'	=> '|'
);

/* Home Page
/*-------------------------------------------------------*/

// Home page title
$fields[] = array(
	'id'		=> 'seo-home-title',
	'label'		=> 'Title',
	'section'	=> 'seo-home-page',
	'type'		=> 'text',
	'class'		=> 'large-text',
	'default'	=> get_bloginfo('name')
);

// Home page meta description
$fields[] = array(
	'id'		=> 'seo-home-meta-description',
	'label'		=> 'Meta Description',
	'section'	=> 'seo-home-page',
	'type'		=> 'textarea',
	'rows'		=> 3,
);

// Home page meta keywords
$fields[] = array(
	'id'		=> 'seo-home-meta-keywords',
	'label'		=> 'Meta Keywords',
	'section'	=> 'seo-home-page',
	'type'		=> 'text',
	'class'		=> 'large-text',
);

/* Robot Meta Tags
/*-------------------------------------------------------*/

// noindex
$fields[] = array(
	'id'		=> 'seo-noindex',
	'label'		=> '<code>noindex</code>',
	'section'	=> 'seo-robot-meta-tags',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'seo-noindex-author'	=> 'Add <code>noindex</code> to author pages',
		'seo-noindex-category'	=> 'Add <code>noindex</code> to category pages',
		'seo-noindex-date'		=> 'Add <code>noindex</code> to date-based pages',
		'seo-noindex-tag'		=> 'Add <code>noindex</code> to tag pages'
	),
	'default'	=> array(
		'seo-noindex-author'	=> '1',
		'seo-noindex-date'		=> '1',
		'seo-noindex-tag'		=> '1'
	)
);

// noarchive
$fields[] = array(
	'id'		=> 'seo-noarchive',
	'label'		=> '<code>noarchive</code>',
	'section'	=> 'seo-robot-meta-tags',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'seo-noarchive-author'		=> 'Add <code>noarchive</code> to author pages',
		'seo-noarchive-category'	=> 'Add <code>noarchive</code> to category pages',
		'seo-noarchive-date'		=> 'Add <code>noarchive</code> to date-based pages',
		'seo-noarchive-tag'			=> 'Add <code>noarchive</code> to tag pages'
	)
);

// nofollow
$fields[] = array(
	'id'		=> 'seo-nofollow',
	'label'		=> '<code>nofollow</code>',
	'section'	=> 'seo-robot-meta-tags',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'seo-nofollow-author'	=> 'Add <code>nofollow</code> to author pages',
		'seo-nofollow-category'	=> 'Add <code>nofollow</code> to category pages',
		'seo-nofollow-date'		=> 'Add <code>nofollow</code> to date-based pages',
		'seo-nofollow-tag'		=> 'Add <code>nofollow</code> to tag pages'
	),
	'default'	=> array(
		'seo-nofollow-author'	=> '1',
		'seo-nofollow-date'		=> '1',
		'seo-nofollow-tag'		=> '1'
	)
);

// noodp, noydir
$fields[] = array(
	'id'		=> 'seo-directory-tags',
	'label'		=> '<code>noodp,noydir</code>',
	'section'	=> 'seo-robot-meta-tags',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'seo-noodp' => 'Add <code>noodp</code> to your site',
		'seo-noydir' => 'Add <code>noydir</code> to your site'

	),
	'default'	=> array(
		'seo-noodp' 	=> '1',
		'seo-noydir'	=> '1'
	)
);
