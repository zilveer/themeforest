<?php

// If in the homepage, we can't get the ID of the assigned page properly
global $post;
$pageMediaID = "";
$pageMediaContent = ""; // this holds the pagemedia html code that should be echoed
$pageMediaType = "";

if (is_home()) {
    if ('page' == get_option('show_on_front')) {
        $pageMediaID = strtolower(bfi_get_post_meta(get_option('page_on_front'), 'pagemedia', true));
    } else if (bfi_get_option(BFI_FRONTPAGEOPTION)) {
        $pageMediaID = strtolower(bfi_get_post_meta(bfi_get_option(BFI_FRONTPAGEOPTION), 'pagemedia', true));
    }
// non-page, non-post pages (e.g. search)
} else if (is_search() || is_archive() || is_404()) {
    $pageMediaID = "none";//bfi_get_option(BFIPagemediaController::GLOBAL_PAGEMEDIA_ID);
// blog posts
} else if ($post != null && $post->post_type == 'post') {
    $pageMediaID = "none";
// portfolio posts
} else if ($post != null && $post->post_type == BFIPortfolioModel::POST_TYPE) {
    $pageMediaID = "none";
// for portfolio items, this is done by header-content.php
// for posts, this is done by header-content.php
// a normal page
} else if ($post != null) {
    $pageMediaID = strtolower(bfi_get_post_meta(get_the_ID(), BFIPagemediaModel::POST_TYPE));
}

// find the ID of the pagemedia in Styles admin if set to default
if ($pageMediaID == "default" || $pageMediaID == "" || $pageMediaID == "none") {
    $pageMediaID = bfi_get_option('style_default_pagemedia');
}    

if ($pageMediaID != "none" && $pageMediaID != "none2") {
    // PAGEMEDIA IS ONLY USED FOR PAGES
    
    // this will contain the type of media to display
    $pageMediaType = "";
    
    global $pagemedia;
    $pagemedia = BFIPagemediaController::getPageMedia($pageMediaID);
    // if ($pagemedia) {
    //         // $pagemedia->width = '1020';
    //         echo $pagemedia->getHeader();
    //     }
}
?>