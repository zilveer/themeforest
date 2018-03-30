<?php

/**
 * Theme options / General / Posts
 *
 * @package wpv
 * @subpackage health-center
 */

return array(

array(
	'name' => __('Posts', 'health-center'),
	'type' => 'start',
),

array(
	'name' => __('Blog and Portfolio Listing Pages and Archives', 'health-center'),
	'type' => 'separator',
),

array(
	'name' => __('Pagination Type', 'health-center'),
	'desc' => __('Please note that you will need WP-PageNavi plugin installed if you chose "paged" style.', 'health-center'),
	'id' => 'pagination-type',
	'type' => 'select',
	'options' => array(
		'paged' => __('Paged', 'health-center'),
		'load-more' => __('Load more button', 'health-center'),
		'infinite-scrolling' => __('Infinite scrolling', 'health-center'),
	),
	'class' => 'slim',
),


array(
	'name' => __('Blog Posts', 'health-center'),
	'type' => 'separator',
),

array(
	'name' => __('"View All Posts" Link', 'health-center'),
	'desc' => __('In a single blog post view in the top you will find navigation with 3 buttons. The middle gets you to the blog listing view.<br>
You can place the link here.', 'health-center'),
	'id' => 'post-all-items',
	'type' => 'text',
	'static' => true,
	'class' => 'slim',
),

array(
	'name' => __('Show "Related Posts" in Single Post View', 'health-center'),
	'desc' => __('Enabling this option will show more posts from the same category when viewing a single post.', 'health-center'),
	'id' => 'show-related-posts',
	'type' => 'toggle',
	'class' => 'slim',
),

array(
	'name' => __('"Related Posts" title', 'health-center'),
	'id' => 'related-posts-title',
	'type' => 'text',
	'class' => 'slim',
),

array(
	'name' => __('Show Post Author', 'health-center'),
	'desc' => __('Blog post meta info, works for the single blog post view.', 'health-center'),
	'id' => 'show-post-author',
	'type' => 'toggle',
	'class' => 'slim'
),
array(
	'name' => __('Show Categories and Tags', 'health-center'),
	'desc' => __('Blog post meta info, works for the single blog post view.', 'health-center'),
	'id' => 'meta_posted_in',
	'type' => 'toggle',
	'class' => 'slim',
),
array(
	'name' => __('Show Post Timestamp', 'health-center'),
	'desc' => __('Blog post meta info, works for the single blog post view.', 'health-center'),
	'id' => 'meta_posted_on',
	'type' => 'toggle',
	'class' => 'slim',
),
array(
	'name' => __('Show Comment Count', 'health-center'),
	'desc' => __('Blog post meta info, works for the single blog post view.', 'health-center'),
	'id' => 'meta_comment_count',
	'type' => 'toggle',
	'class' => 'slim',
),

array(
	'name' => __('Portfolio Posts', 'health-center'),
	'type' => 'separator',
),

array(
	'name' => __('"View All Portfolios" Link', 'health-center'),
	'desc' => __('In a single portfolio post view in the top you will find navigation with 3 buttons. The middle gets you to the portfolio listing view.<br>
You can place the link here.', 'health-center'),
	'id' => 'portfolio-all-items',
	'type' => 'text',
	'static' => true,
	'class' => 'slim',
),
array(
	'name' => __('Show "Related Portfolios" in Single Portfolio View', 'health-center'),
	'desc' => __('Enabling this option will show more portfolio posts from the same category in the single portfolio post.', 'health-center'),
	'id' => 'show-related-portfolios',
	'type' => 'toggle',
	'class' => 'slim',
),

array(
	'name' => __('"Related Portfolios" title', 'health-center'),
	'id' => 'related-portfolios-title',
	'type' => 'text',
	'class' => 'slim',
),

array(
	'name' => __('URL Prefix for Single Portfolios', 'health-center'),
	'desc' => __('Use an unique string without spaces. It must not be the same as any other URL slugs (used on pages, etc.).', 'health-center'),
	'id' => 'portfolio-slug',
	'type' => 'text',
	'class' => 'slim',
),

	array(
		'type' => 'end'
	),
);