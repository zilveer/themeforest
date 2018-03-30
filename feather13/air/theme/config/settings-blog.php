<?php

/*---------------------------------------------------------------------------*/
/* Theme Settings :: Blog
/*---------------------------------------------------------------------------*/

/* Sections
/*---------------------------------------------------------------------------*/

$sections = array(
	array(
		'id'	=> 'blog-general',
		'title'	=> 'General'
	),
	array(
		'id'	=> 'blog-headings',
		'title'	=> 'Headings',
	),
	array(
		'id'	=> 'blog-post-content',
		'title'	=> 'Post Content'
	),
	array(
		'id'	=> 'blog-post-details',
		'title'	=> 'Post Details'
	),
	array(
		'id'	=> 'blog-author-block',
		'title'	=> 'Author Block'
	),
	array(
		'id'	=> 'blog-comments',
		'title'	=> 'Comments'
	)
);


/* Fields
/*---------------------------------------------------------------------------*/

/* General
/*-------------------------------------------------------*/

// Read More
$fields[] = array(
	'id'			=> 'read-more',
	'label'			=> 'Read More Text',
	'section'		=> 'blog-general',
	'type'			=> 'text',
	'placeholder'	=> '(more...)'
);

// Excerpt Read More Link
$fields[] = array(
	'id'		=> 'excerpt-more-link-enable',
	'label'		=> 'Read More Link',
	'section'	=> 'blog-general',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'excerpt-more-link-enable' => 'Enable read more link on excerpts'
	)
);

// Excerpt More
$fields[] = array(
	'id'			=> 'excerpt-more',
	'label'			=> 'Excerpt Ending',
	'section'		=> 'blog-general',
	'type'			=> 'text',
	'class'			=> 'small-text',
	'placeholder'	=> '[...]'
);

// Excerpt Length
$fields[] = array(
	'id'			=> 'excerpt-length',
	'label'			=> 'Excerpt Length <small>(words)</small>',
	'section'		=> 'blog-general',
	'type'			=> 'text',
	'class'			=> 'small-text',
	'placeholder'	=> '55'
);

// Blog Format
$fields[] = array(
	'id'		=> 'blog-format',
	'label'		=> 'Blog Format <small>(not single)</small>',
	'section'	=> 'blog-general',
	'type'		=> 'radio',
	'choices'	=> array(
		'0' => 'Display none',
		'1' => 'Display post formats',
		'2' => 'Display thumbnails'
	),
	'default'	=> '1'
);

/* Headings
/*-------------------------------------------------------*/

// Heading
$fields[] = array(
	'id'			=> 'blog-heading',
	'label'			=> 'Heading',
	'section'		=> 'blog-headings',
	'type'			=> 'text',
	'placeholder'	=> ''
);

// Subheading
$fields[] = array(
	'id'			=> 'blog-subheading',
	'label'			=> 'Subheading',
	'section'		=> 'blog-headings',
	'type'			=> 'text',
	'placeholder'	=> ''
);

/* Post Content
/*-------------------------------------------------------*/

// Home
$fields[] = array(
	'id'		=> 'post-content-home',
	'label'		=> 'Home',
	'section'	=> 'blog-post-content',
	'type'		=> 'radio',
	'choices'	=> array(
		'0' => 'Excerpt',
		'1' => 'Full Post',
	),
	'vertical'	=> FALSE,
	'default'	=> '1'
);

// Archive
$fields[] = array(
	'id'		=> 'post-content-archive',
	'label'		=> 'Archive',
	'section'	=> 'blog-post-content',
	'type'		=> 'radio',
	'choices'	=> array(
		'0' => 'Excerpt',
		'1' => 'Full Post <small>(not recommended)</small>',
	),
	'vertical'	=> FALSE
);

// Search
$fields[] = array(
	'id'		=> 'post-content-search',
	'label'		=> 'Search',
	'section'	=> 'blog-post-content',
	'type'		=> 'radio',
	'choices'	=> array(
		'0' => 'Excerpt',
		'1' => 'Full Post <small>(not recommended)</small>',
	),
	'vertical'	=> FALSE
);

/* Post Details
/*-------------------------------------------------------*/

// Hide Post Details
$fields[] = array(
	'id'		=> 'post-hide-fields',
	'label'		=> 'Hide Post Details',
	'section'	=> 'blog-post-details',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'post-hide-author'		=> 'Hide post author',
		'post-hide-date'		=> 'Hide post date',
		'post-hide-categories'	=> 'Hide post categories',
		'post-hide-tags'		=> 'Hide post tags',
		'post-hide-comments'	=> 'Hide post comment count',
	)
);

/* Blog : Author Block
/*-------------------------------------------------------*/

// Enable Author Block
$fields[] = array(
	'id'		=> 'post-enable-author-block',
	'label'		=> 'Enable',
	'section'	=> 'blog-author-block',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'post-enable-author-block' => 'Enable author block'
	)
);
		
/* Comments
/*-------------------------------------------------------*/

// Comments Form Location
$fields[] = array(
	'id'		=> 'comments-form-location',
	'label'		=> 'Comments Form Location',
	'section'	=> 'blog-comments',
	'type'		=> 'radio',
	'choices'	=> array(
		'top'		=> 'Display above comments',
		'bottom'	=> 'Display below comments',
	),
	'default'	=> 'bottom'
);

// Disable Comments
$fields[] = array(
	'id'		=> 'disable-comments',
	'label'		=> 'Disable Comments',
	'section'	=> 'blog-comments',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'comments-pages-disable' => 'Disable comments on pages',
		'comments-posts-disable' => 'Disable comments on posts'
	),
	'default'	=> array(
		'comments-pages-disable' => '1'
	)
);
