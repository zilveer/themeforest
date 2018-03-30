<?php

$mkd_pages = array();
$pages     = get_pages();
foreach($pages as $page) {
    $mkd_pages[$page->ID] = $page->post_title;
}

global $hue_IconCollections;

//Portfolio Images

$mkdPortfolioImages = new HueMikadoMetaBox("portfolio-item", esc_html__('Portfolio Images (multiple upload)', 'hue'), '', '', 'portfolio_images');
$hue_Framework->mkdMetaBoxes->addMetaBox("portfolio_images", $mkdPortfolioImages);

$mkd_portfolio_image_gallery = new HueMikadoMultipleImages("mkd_portfolio-image-gallery", esc_html__('Portfolio Images', 'hue'), esc_html__('Choose your portfolio images', 'hue'));
$mkdPortfolioImages->addChild("mkd_portfolio-image-gallery", $mkd_portfolio_image_gallery);

//Portfolio Images/Videos 2

$mkdPortfolioImagesVideos2 = new HueMikadoMetaBox("portfolio-item", esc_html__('Portfolio Images/Videos (single upload)', 'hue'));
$hue_Framework->mkdMetaBoxes->addMetaBox("portfolio_images_videos2", $mkdPortfolioImagesVideos2);

$mkd_portfolio_images_videos2 = new HueMikadoImagesVideosFramework(esc_html__('Portfolio Images/Videos 2', 'hue'), esc_html__('ThisIsDescription', 'hue'));
$mkdPortfolioImagesVideos2->addChild("mkd_portfolio_images_videos2", $mkd_portfolio_images_videos2);

//Portfolio Additional Sidebar Items

$mkdAdditionalSidebarItems = new HueMikadoMetaBox("portfolio-item", esc_html__('Additional Portfolio Sidebar Items', 'hue'));
$hue_Framework->mkdMetaBoxes->addMetaBox("portfolio_properties", $mkdAdditionalSidebarItems);

$mkd_portfolio_properties = new HueMikadoOptionsFramework(esc_html__('Portfolio Properties', 'hue'), esc_html__('ThisIsDescription', 'hue'));
$mkdAdditionalSidebarItems->addChild("mkd_portfolio_properties", $mkd_portfolio_properties);

