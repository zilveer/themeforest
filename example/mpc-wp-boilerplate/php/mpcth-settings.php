<?php

/**
 * Default Theme Settings
 *
 * @package WordPress
 * @subpackage MPC WP Boilerplate
 * @since 1.0
 *
 */

$custom_page_meta = get_post_custom();

/* blog custom meta boxes */

$blogType = 'masonry';

if(isset($custom_page_meta['blog_post_max_width'][0]) && $custom_page_meta['blog_post_max_width'][0] != '') 
	$blogPostWidthMax = $custom_page_meta['blog_post_max_width'][0];
else
	$blogPostWidthMax = 500;

if(isset($custom_page_meta['blog_post_min_width'][0]) && $custom_page_meta['blog_post_min_width'][0] != '') 
	$blogPostWidthMin = $custom_page_meta['blog_post_min_width'][0];
else
	$blogPostWidthMin = 300;

if(isset($custom_page_meta['blog_lm_info'][0]) && $custom_page_meta['blog_lm_info'][0] != '') 
	$blogDisplayLMInfo = ($custom_page_meta['blog_lm_info'][0] == 'on') ? 'true' : 'false';
else
	$blogDisplayLMInfo = 'true';

if(isset($custom_page_meta['blog_category_filter'][0]) && $custom_page_meta['blog_category_filter'][0] != '') 
	$blogCategoryFilter = ($custom_page_meta['blog_category_filter'][0] == 'on') ? 'true' : 'false';
else
	$blogCategoryFilter = 'true';

/* portfolio custom meta box */

$portfolioType = 'masonry';

if(isset($custom_page_meta['portfolio_post_max_width'][0]) && $custom_page_meta['portfolio_post_max_width'][0] != '') 
	$portfolioPostWidthMax = $custom_page_meta['portfolio_post_max_width'][0];
else
	$portfolioPostWidthMax = 500;

if(isset($custom_page_meta['portfolio_post_min_width'][0]) && $custom_page_meta['portfolio_post_min_width'][0] != '') 
	$portfolioPostWidthMin = $custom_page_meta['portfolio_post_min_width'][0];
else
	$portfolioPostWidthMin = 300;

if(isset($custom_page_meta['portfolio_lm_info'][0]) && $custom_page_meta['portfolio_lm_info'][0] != '') 
	$portfolioDisplayLMInfo = ($custom_page_meta['portfolio_lm_info'][0] == 'on') ? 'true' : 'false';
else
	$portfolioDisplayLMInfo = 'true';

if(isset($custom_page_meta['portfolio_category_filter'][0]) && $custom_page_meta['portfolio_category_filter'][0] != '') 
	$portfolioCategoryFilter = ($custom_page_meta['portfolio_category_filter'][0] == 'on') ? 'true' : 'false';
else
	$portfolioCategoryFilter = 'true';

if(isset($custom_page_meta['portfolio_link_item'][0]) && $custom_page_meta['portfolio_link_item'][0] != '') 
	$portfolioLinkToItem = ($custom_page_meta['portfolio_link_item'][0] == 'on') ? 'true' : 'false';
else
	$portfolioLinkToItem = 'true';

	$portfolioDisplayTitle = 'true';

	$portfolioDisplayMeta = 'true';

if(isset($custom_page_meta['portfolio_display_content'][0]) && $custom_page_meta['portfolio_display_content'][0] != '') 
	$portfolioDisplayContent = ($custom_page_meta['portfolio_display_content'][0] == 'on') ? 'true' : 'false';
else
	$portfolioDisplayContent = 'true';

if(isset($custom_page_meta['portfolio_remove_frame'][0]) && $custom_page_meta['portfolio_remove_frame'][0] != '') 
	$portfolioRemoveFrame = ($custom_page_meta['portfolio_remove_frame'][0] == 'on') ? 'true' : 'false';
else
	$portfolioRemoveFrame = 'true';

/* gallery custom meta box */

$galleryType = 'masonry';

if(isset($custom_page_meta['gallery_post_max_width'][0]) && $custom_page_meta['gallery_post_max_width'][0] != '') 
	$galleryPostWidthMax = $custom_page_meta['gallery_post_max_width'][0];
else
	$galleryPostWidthMax = 500;

if(isset($custom_page_meta['gallery_post_min_width'][0]) && $custom_page_meta['gallery_post_min_width'][0] != '') 
	$galleryPostWidthMin = $custom_page_meta['gallery_post_min_width'][0];
else
	$galleryPostWidthMin = 300;

if(isset($custom_page_meta['gallery_lm_info'][0]) && $custom_page_meta['gallery_lm_info'][0] != '') 
	$galleryDisplayLMInfo = ($custom_page_meta['gallery_lm_info'][0] == 'on') ? 'true' : 'false';
else
	$galleryDisplayLMInfo = 'true';

if(isset($custom_page_meta['gallery_category_filter'][0]) && $custom_page_meta['gallery_category_filter'][0] != '') 
	$galleryCategoryFilter = ($custom_page_meta['gallery_category_filter'][0] == 'on') ? 'true' : 'false';
else
	$galleryCategoryFilter = 'true';

/* MPCTH Settings */
$mpcth_settings = Array(
	/* blog */
	'blogPostLayoutOrder' 	=> Array('thumbnail', 'title', 'meta', 'content', 'readmore'), /* define the order in which the post structure will be displayed */
	'blogPagination' 		=> 'loadmore', 				/* standard or loadmore */
	'blogDisplayLMInfo' 	=> $blogDisplayLMInfo, 		/* display loadmore info -> 10 / 20 */
	'blogType' 				=> $blogType,				/* blog type: standard or masonry */
	'blogPostWidthMax'		=> $blogPostWidthMax, 		/* for masonry blog max post width */
	'blogPostWidthMin'		=> $blogPostWidthMin, 		/* for masonry blog min post width */
	'blogCategoryFilter'	=> $blogCategoryFilter, 	/* add category filter */

	/* portfolio */
	'portfolioPostLayoutOrder' 		=> Array('thumbnail', 'title', 'meta', 'content', 'readmore'), /* define the order in which the post structure will be displayed */
	'portfolioPagination' 			=> 'loadmore', 					/* standard or loadmore */
	'portfolioDisplayLMInfo' 		=> $portfolioDisplayLMInfo, 	/* display loadmore info -> 10 / 20 */
	'portfolioType' 				=> $portfolioType,				/* blog type: standard or masonry */
	'portfolioPostWidthMax'			=> $portfolioPostWidthMax, 		/* for masonry blog max post width */
	'portfolioPostWidthMin'			=> $portfolioPostWidthMin, 		/* for masonry blog min post width */
	'portfolioCategoryFilter'		=> $portfolioCategoryFilter,	/* add category filter */
	'portfolioLinkToItem'			=> $portfolioLinkToItem, 		/* link to item, if removed there is no way to see the single view of the post */
	'portfolioDisplayTitle'			=> $portfolioDisplayTitle, 		/* should the title be displayed */
	'portfolioDisplayMeta'			=> $portfolioDisplayMeta, 		/* should the meta be displayed */
	'portfolioDisplayContent'		=> $portfolioDisplayContent,	/* should the content be displayed */
	'portfolioRemoveFrame'			=> $portfolioRemoveFrame,		/* should the frame be visible around the item */

	/* gallery */
	'galleryPostLayoutOrder' 		=> Array('thumbnail', 'title', 'meta', 'content', 'readmore'), /* define the order in which the post structure will be displayed */
	'galleryPagination' 			=> 'loadmore', 					/* standard or loadmore */
	'galleryDisplayLMInfo' 			=> $galleryDisplayLMInfo, 		/* display loadmore info -> 10 / 20 */
	'galleryType' 					=> $galleryType,				/* blog type: standard or masonry */
	'galleryPostWidthMax'			=> $galleryPostWidthMax, 		/* for masonry blog max post width */
	'galleryPostWidthMin'			=> $galleryPostWidthMin, 		/* for masonry blog min post width */
	'galleryCategoryFilter'			=> $galleryCategoryFilter,		/* add category filter */

	/* search */
	'searchPostLayoutOrder' 		=> Array('thumbnail', 'title', 'meta', 'content', 'readmore'), /* define the order in which the post structure will be displayed */
	'searchPagination' 				=> 'loadmore', 	/* standard or loadmore */
	'searchDisplayLMInfo' 			=> 'true', 		/* display loadmore info -> 10 / 20 */
	'searchType' 					=> 'masonry',	/* blog type: standard or masonry */
	'searchPostWidthMax'			=> 500, 		/* for masonry blog max post width */
	'searchPostWidthMin'			=> 300, 		/* for masonry blog min post width */

	/* archive */
	'archivePostLayoutOrder' 		=> Array('thumbnail', 'title', 'meta', 'content', 'readmore'), /* define the order in which the post structure will be displayed */
	'archivePagination' 			=> 'loadmore', 	/* standard or loadmore */
	'archiveDisplayLMInfo' 			=> 'true', 		/* display loadmore info -> 10 / 20 */
	'archiveType' 					=> 'masonry',	/* blog type: standard or masonry */
	'archivePostWidthMax'			=> 500, 		/* for masonry blog max post width */
	'archivePostWidthMin'			=> 300, 		/* for masonry blog min post width */
);