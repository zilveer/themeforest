<?php

/*---------------------------------------------------------------------------*/
/* Meta Settings :: Page Templates
/*---------------------------------------------------------------------------*/

/* Sections
/*---------------------------------------------------------------------------*/

$sections = array(
	
	/* 0. Front
	/*-----------------------------------------*/
	array(
		'id'		=> 'template-front-slider',
		'title'		=> 'Slider',
		'page'		=> 'page',
		'template'	=> array('page-templates/frontpage-boxed.php', 'page-templates/frontpage-wide.php')
	),
	array(
		'id'		=> 'template-front-blog',
		'title'		=> 'Blog',
		'page'		=> 'page',
		'template'	=> array('page-templates/frontpage-boxed.php', 'page-templates/frontpage-wide.php')
	),
	
	/* 1. Portfolio
	/*-----------------------------------------*/
	array(
		'id'		=> 'template-portfolio',
		'title'		=> 'Portfolio',
		'page'		=> 'page',
		'template'	=> array('page-templates/portfolio.php')
	),

);


/**
	0. Front Template Fields : frontpage.php
**/

/* Front : Slider
/*-------------------------------------------------------*/

// Enable
$fields[] = array(
	'id'		=> '_front_slider_enable',
	'label'		=> 'Enable',
	'section'	=> 'template-front-slider',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'_front_slider_enable'	=> 'Display slider'
	)
);


/* Front : Portfolio
/*-------------------------------------------------------*/
// Is portfolio enabled ?
if(air_portfolio::get_option('portfolio-enable')):

// Add portfolio section
$sections[] = array(
	'id'		=> 'template-front-portfolio',
	'title'		=> 'Portfolio',
	'page'		=> 'page',
	'template'	=> array('page-templates/frontpage-boxed.php', 'page-templates/frontpage-wide.php')
);

	// Enable
	$fields[] = array(
		'id'		=> '_front_portfolio_enable',
		'label'		=> 'Enable',
		'section'	=> 'template-front-portfolio',
		'type'		=> 'checkbox',
		'choices'	=> array(
			'_front_portfolio_enable'	=> 'Display portfolio entries'
		)
	);

	// Category
	$fields[] = array(
		'id'		=> '_front_portfolio_category',
		'label'		=> 'Category',
		'section'	=> 'template-front-portfolio',
		'type'		=> 'select',
		'choices'	=> air_portfolio::meta_category_dropdown()
	);

	// Heading
	$fields[] = array(
		'id'		=> '_front_portfolio_heading',
		'label'		=> 'Heading',
		'section'	=> 'template-front-portfolio',
		'type'		=> 'text',
		'class'		=> 'large-text'
	);

	// Content
	$fields[] = array(
		'id'		=> '_front_portfolio_content',
		'label'		=> 'Content',
		'section'	=> 'template-front-portfolio',
		'type'		=> 'textarea',
		'rows'		=> 4
	);

endif; // end portfolio enabled check

/* Front : Blog
/*-------------------------------------------------------*/

// Enable
$fields[] = array(
	'id'		=> '_front_blog_enable',
	'label'		=> 'Enable',
	'section'	=> 'template-front-blog',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'_front_blog_enable'	=> 'Display blog posts'
	)
);

// Category
$fields[] = array(
	'id'		=> '_front_blog_category',
	'label'		=> 'Category',
	'section'	=> 'template-front-blog',
	'type'		=> 'category-dropdown'
);

// Format
$fields[] = array(
	'id'		=> '_front_blog_format',
	'label'		=> 'Format',
	'section'	=> 'template-front-blog',
	'type'		=> 'radio',
	'choices'	=> array(
		'0' => 'Display none',
		'1' => 'Display post formats',
		'2' => 'Display thumbnails'
	)
);

// Excerpt length
$fields[] = array(
	'id'		=> '_front_blog_excerpt_length',
	'label'		=> 'Excerpt Length',
	'section'	=> 'template-front-blog',
	'type'		=> 'text',
	'class'		=> 'small-text'
);

// Heading
$fields[] = array(
	'id'		=> '_front_blog_heading',
	'label'		=> 'Heading',
	'section'	=> 'template-front-blog',
	'type'		=> 'text',
	'class'		=> 'large-text'
);

// Content
$fields[] = array(
	'id'		=> '_front_blog_content',
	'label'		=> 'Content',
	'section'	=> 'template-front-blog',
	'type'		=> 'textarea',
	'rows'		=> 4
);


/**
	1. Portfolio Template Fields : portfolio.php
**/

/* Portfolio
/*-------------------------------------------------------*/

// Category
$fields[] = array(
	'id'		=> '_portfolio_category',
	'label'		=> 'Category',
	'section'	=> 'template-portfolio',
	'type'		=> 'select',
	'choices'	=> air_portfolio::meta_category_dropdown()
);

// Layout
$fields[] = array(
	'id'		=> '_portfolio_layout',
	'label'		=> 'Layout',
	'section'	=> 'template-portfolio',
	'type'		=> 'select',
	'choices'	=> array(
		'grid one-fourth'	=> 'Small',
		'grid one-third'	=> 'Medium',
		'grid one-half'		=> 'Large'
	)
);

// Order
$fields[] = array(
	'id'		=> '_portfolio_order',
	'label'		=> 'Order',
	'section'	=> 'template-portfolio',
	'type'		=> 'select',
	'choices'	=> array(
		'DESC'	=> 'Descending',
		'ASC'	=> 'Ascending'
	)
);

// Orderby
$fields[] = array(
	'id'		=> '_portfolio_orderby',
	'label'		=> 'Orderby',
	'section'	=> 'template-portfolio',
	'type'		=> 'select',
	'choices'	=> array(
		'date'	=> 'Date',
		'title'	=> 'Title',
		'rand'	=> 'Random'
	)
);

// Lightbox
$fields[] = array(
	'id'		=> '_portfolio_lightbox',
	'label'		=> 'Lightbox',
	'section'	=> 'template-portfolio',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'_portfolio_lightbox' => 'Enable lightbox',
		'_portfolio_lightbox_gallery' => 'Show lightbox images as gallery'
	)
);

// Disable
$fields[] = array(
	'id'		=> '_portfolio_disable',
	'label'		=> 'Disable',
	'section'	=> 'template-portfolio',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'_portfolio_disable_switcher'	=> 'Disable size switcher',
		'_portfolio_disable_categories'	=> 'Disable category menu'
	)
);

// Pagination and category pages instead of isotope filtering
$fields[] = array(
	'id'		=> '_portfolio_view',
	'label'		=> 'Portfolio View',
	'section'	=> 'template-portfolio',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'_portfolio_view' => 'Use category links instead of isotope filtering'
	)
);