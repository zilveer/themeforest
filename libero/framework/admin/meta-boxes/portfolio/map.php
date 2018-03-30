<?php

$mkd_pages = array();
$pages = get_pages(); 
foreach($pages as $page) {
	$mkd_pages[$page->ID] = $page->post_title;
}

global $libero_mikado_IconCollections;

//Portfolio Images

$mkdPortfolioImages = new LiberoMetaBox("portfolio-item", "Portfolio Images (multiple upload)", '', '', 'portfolio_images');
$libero_mikado_Framework->mkdMetaBoxes->addMetaBox("portfolio_images",$mkdPortfolioImages);

	$mkd_portfolio_image_gallery = new LiberoMultipleImages("mkd_portfolio-image-gallery","Portfolio Images","Choose your portfolio images");
	$mkdPortfolioImages->addChild("mkd_portfolio-image-gallery",$mkd_portfolio_image_gallery);

//Portfolio Images/Videos 2

$mkdPortfolioImagesVideos2 = new LiberoMetaBox("portfolio-item", "Portfolio Images/Videos (single upload)");
$libero_mikado_Framework->mkdMetaBoxes->addMetaBox("portfolio_images_videos2",$mkdPortfolioImagesVideos2);

	$mkd_portfolio_images_videos2 = new LiberoImagesVideosFramework("Portfolio Images/Videos 2","ThisIsDescription");
	$mkdPortfolioImagesVideos2->addChild("mkd_portfolio_images_videos2",$mkd_portfolio_images_videos2);

//Portfolio Additional Sidebar Items

$mkdAdditionalSidebarItems = new LiberoMetaBox("portfolio-item", "Additional Portfolio Sidebar Items");
$libero_mikado_Framework->mkdMetaBoxes->addMetaBox("portfolio_properties",$mkdAdditionalSidebarItems);

	$mkd_portfolio_properties = new LiberoOptionsFramework("Portfolio Properties","ThisIsDescription");
	$mkdAdditionalSidebarItems->addChild("mkd_portfolio_properties",$mkd_portfolio_properties);

