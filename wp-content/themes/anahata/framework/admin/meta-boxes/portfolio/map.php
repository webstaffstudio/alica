<?php

$mkd_pages = array();
$pages     = get_pages();
foreach($pages as $page) {
    $mkd_pages[$page->ID] = $page->post_title;
}

global $anahata_IconCollections;

//Portfolio Images

$mkdPortfolioImages = new AnahataMikadoMetaBox("portfolio-item", esc_html__('Portfolio Images (multiple upload)', 'anahata'), '', '', 'portfolio_images');
$anahata_Framework->mkdMetaBoxes->addMetaBox("portfolio_images", $mkdPortfolioImages);

$mkd_portfolio_image_gallery = new AnahataMikadoMultipleImages("mkd_portfolio-image-gallery", esc_html__('Portfolio Images', 'anahata'), esc_html__('Choose your portfolio images', 'anahata'));
$mkdPortfolioImages->addChild("mkd_portfolio-image-gallery", $mkd_portfolio_image_gallery);

//Portfolio Images/Videos 2

$mkdPortfolioImagesVideos2 = new AnahataMikadoMetaBox("portfolio-item", esc_html__('Portfolio Images/Videos (single upload)', 'anahata'));
$anahata_Framework->mkdMetaBoxes->addMetaBox("portfolio_images_videos2", $mkdPortfolioImagesVideos2);

$mkd_portfolio_images_videos2 = new AnahataMikadoImagesVideosFramework(esc_html__('Portfolio Images/Videos 2', 'anahata'), esc_html__('ThisIsDescription', 'anahata'));
$mkdPortfolioImagesVideos2->addChild("mkd_portfolio_images_videos2", $mkd_portfolio_images_videos2);

//Portfolio Additional Sidebar Items

$mkdAdditionalSidebarItems = new AnahataMikadoMetaBox("portfolio-item", esc_html__('Additional Portfolio Sidebar Items', 'anahata'));
$anahata_Framework->mkdMetaBoxes->addMetaBox("portfolio_properties", $mkdAdditionalSidebarItems);

$mkd_portfolio_properties = new AnahataMikadoOptionsFramework(esc_html__('Portfolio Properties', 'anahata'), esc_html__('ThisIsDescription', 'anahata'));
$mkdAdditionalSidebarItems->addChild("mkd_portfolio_properties", $mkd_portfolio_properties);

