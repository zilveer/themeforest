<?php

$qode_pages = array();
$pages = get_pages(); 
foreach($pages as $page) {
	$qode_pages[$page->ID] = $page->post_title;
}

global $qode_startit_IconCollections;

//Portfolio Images

$qodePortfolioImages = new QodeStartitMetaBox("portfolio-item", "Portfolio Images (multiple upload)", '', '', 'portfolio_images');
$qode_startit_Framework->qodeMetaBoxes->addMetaBox("portfolio_images",$qodePortfolioImages);

	$qode_portfolio_image_gallery = new QodeStartitMultipleImages("qode_portfolio-image-gallery","Portfolio Images","Choose your portfolio images");
	$qodePortfolioImages->addChild("qode_portfolio-image-gallery",$qode_portfolio_image_gallery);

//Portfolio Images/Videos 2

$qodePortfolioImagesVideos2 = new QodeStartitMetaBox("portfolio-item", "Portfolio Images/Videos (single upload)");
$qode_startit_Framework->qodeMetaBoxes->addMetaBox("portfolio_images_videos2",$qodePortfolioImagesVideos2);

	$qode_portfolio_images_videos2 = new QodeStartitImagesVideosFramework("Portfolio Images/Videos 2","ThisIsDescription");
	$qodePortfolioImagesVideos2->addChild("qode_portfolio_images_videos2",$qode_portfolio_images_videos2);

//Portfolio Additional Sidebar Items

$qodeAdditionalSidebarItems = new QodeStartitMetaBox("portfolio-item", "Additional Portfolio Sidebar Items");
$qode_startit_Framework->qodeMetaBoxes->addMetaBox("portfolio_properties",$qodeAdditionalSidebarItems);

	$qode_portfolio_properties = new QodeStartitOptionsFramework("Portfolio Properties","ThisIsDescription");
	$qodeAdditionalSidebarItems->addChild("qode_portfolio_properties",$qode_portfolio_properties);

