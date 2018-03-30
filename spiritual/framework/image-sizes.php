<?php

// Theme Image Sizes for different sections	

// get image height from theme options
$swm_img_pt_2col 			= get_theme_mod('swm_img_pt_2col');
$swm_img_pt_3col 			= get_theme_mod('swm_img_pt_3col');
$swm_img_pt_4col 			= get_theme_mod('swm_img_pt_4col');
$swm_img_pt_blog_featured 	= get_theme_mod('swm_img_pt_blog_featured');
$swm_img_pt_blog_gallery 	= get_theme_mod('swm_img_pt_blog_gallery');
$swm_img_pt_blog_grid_featured 	= get_theme_mod('swm_img_pt_blog_grid_featured');
$swm_img_pt_blog_grid_gallery 	= get_theme_mod('swm_img_pt_blog_grid_gallery');
$swm_img_pt_blog_fullwidth_featured 	= get_theme_mod('swm_img_pt_blog_fullwidth_featured');

add_image_size('portfolio-2', 		540, $swm_img_pt_2col, true);						// portfolio 2 column image
add_image_size('portfolio-3', 		401, $swm_img_pt_3col, true);						// portfolio 3 and 4 column image
add_image_size('portfolio-4', 		401, $swm_img_pt_4col, true);						// portfolio 4 column image
add_image_size('blog-post', 		800, $swm_img_pt_blog_featured, true);				// blog post standard and image 
add_image_size('blog-grid-post', 	540, $swm_img_pt_blog_grid_featured, true);			// blog post grid standard and image
add_image_size('events', 			230,120, true);										// events image
add_image_size('recent-post', 		514, 342, true); 									// recent posts full image 2, 3 column
add_image_size('blog-fullwidth-post', 	1100, $swm_img_pt_blog_fullwidth_featured, true);	// blog post fullwidth standard and image 