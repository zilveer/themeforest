<?php

$qode_pages = array();
$pages = get_pages(); 
foreach($pages as $page) {
	$qode_pages[$page->ID] = $page->post_title;
}

//Portfolio Images

$qodePortfolioImages = new SupremaQodefMetaBox("portfolio-item", "Portfolio Images (multiple upload)", '', '', 'portfolio_images');
$suprema_qodef_Framework->qodeMetaBoxes->addMetaBox("portfolio_images",$qodePortfolioImages);

	$qode_portfolio_image_gallery = new SupremaQodefMultipleImages("qode_portfolio-image-gallery","Portfolio Images","Choose your portfolio images");
	$qodePortfolioImages->addChild("qode_portfolio-image-gallery",$qode_portfolio_image_gallery);

//Portfolio Images/Videos 2

$qodePortfolioImagesVideos2 = new SupremaQodefMetaBox("portfolio-item", "Portfolio Images/Videos (single upload)");
$suprema_qodef_Framework->qodeMetaBoxes->addMetaBox("portfolio_images_videos2",$qodePortfolioImagesVideos2);

	$qode_portfolio_images_videos2 = new SupremaQodefImagesVideosFramework("Portfolio Images/Videos 2","ThisIsDescription");
	$qodePortfolioImagesVideos2->addChild("qode_portfolio_images_videos2",$qode_portfolio_images_videos2);

//Portfolio Additional Sidebar Items

$qodeAdditionalSidebarItems = new SupremaQodefMetaBox("portfolio-item", "Additional Portfolio Sidebar Items");
$suprema_qodef_Framework->qodeMetaBoxes->addMetaBox("portfolio_properties",$qodeAdditionalSidebarItems);

	$qode_portfolio_properties = new SupremaQodefOptionsFramework("Portfolio Properties","ThisIsDescription");
	$qodeAdditionalSidebarItems->addChild("qode_portfolio_properties",$qode_portfolio_properties);

