<?php
add_action('wp_head','custom_css',20);
if ( ! function_exists( 'custom_css' ) ) {
    function custom_css() {
        global $bk_option;
        if ( isset($bk_option)):
            $primary_color = $bk_option['bk-primary-color'];
            $dark_color = $bk_option['bk-dark-color'];
            $bg_switch = $bk_option['bk-site-layout'];
            $meta_review = $bk_option['bk-meta-review-sw'];
            $meta_author = $bk_option['bk-meta-author-sw'];
            $meta_date = $bk_option['bk-meta-date-sw'];
            $meta_views = $bk_option['bk-meta-views-sw'];
            $meta_comments = $bk_option['bk-meta-comments-sw'];
            $meta_readmore = $bk_option['bk-meta-readmore-sw'];
            $custom_css = $bk_option['bk-css-code'];
            $sb_responsive_sw = $bk_option['bk-sb-responsive-sw'];
            ?>
            <style type='text/css' media="all">
            <?php
            if ( ($meta_review) == 0) echo ('.reviewscore {display: none;}'); 
            if ( ($meta_author) == 0) echo ('.post-meta .post-author {display: none;}'); 
            if ( ($meta_date) == 0) echo ('.post-meta .date {display: none;}'); 
            if ( ($meta_views) == 0) echo ('.post-meta .views {display: none;}'); 
            if ( ($meta_comments) == 0) echo ('.post-meta .comments {display: none;}'); 
            if ( ($meta_readmore) == 0) echo ('.post-meta .read-more {display: none;}'); 
    
            if ( ($primary_color) != null) {?> 
                .top-bar, .overlay-card, #main-menu .menu > li:hover, .bk-meta:before, .header-custom .main-nav .header-inner,
                .bk-mega-menu, .bk-dropdown-menu, .main-nav #s, .search-icon i, .main-nav .mobile,
                 
                .icon-thumb, .post-info-line, .grid-container .post-cat:after, .module-carousel .post-cat:after, .bk-card-content .post-cat:after, .post-cat-bg, #back-top:hover,
                
                .bk-header h3, .cat-header h3, .widget-tabs-title-container li.active h3, h3.ticker-header,
                
                .comment-navigation a, .comment.bypostauthor > .comment-article > .comment-author > .comment-author-name:after, #comment-submit, .add-comment-btn, .cat-btn, .tag-btn, .bkpaginate-current, .bkpaginate a:hover, .tagcloud a:hover, .widget_search #search-form #search-submit,
                .widget-facebook h4, .widget_flickr h4, .widget_calendar h4, .widget_youtube_subscribe .widget-title , .widget_recent_comments h4, .widget_links h4, .widget_search h4, .widget_tag_cloud h4, .widget_categories h4, .widget_recent h4, .widget_archive h4, .widget_meta h4, .widget_pages h4, .widget_recent_entries h4, .widget_nav_menu h4, .widget_text h4, .widget_rss h4,
                .widget_archive ul li, .widget_categories ul li, .widget_calendar #wp-calendar caption, .widget_calendar #today, .widget_tag_cloud a,
                
                .bk-score-box-wrap, .rating-wrap, .reviewscore, .bk-bar-ani, .bk-score-box, .heading-wrap hr, #pagination .current, .post-page-links > span, .button-primary
                
                    {background-color: <?php echo $primary_color; ?>}
                
                a, .post-title:hover a, .module-carousel .post-title a:hover, .module-carousel .post-cat a:hover, .post-meta .read-more a:hover, .post-nav-link-title h3:hover, .flexslider .flex-direction-nav a:hover, .module-hero .main-post.hero-video .post-details .post-title a:hover,
                 
                .bk-sub-posts .post-title.post-title-card:hover a, .bk-dropdown-menu .bk-sub-sub-menu a, .widget_nav_menu li a:hover, #main-mobile-menu .expand i,
                .header-dark .main-nav #main-menu .menu > li.current-menu-item > a, .header-light .main-nav #main-menu .menu > li.current-menu-item > a,
                 
                .recentcomments, .post-author a, .comment-author, .single .author a, .page .author a, .bk-author-page-contact a:hover, #pagination a:hover, .post-page-links a:hover span,
                
                ul.ticker li h2:before, #bk-404-wrap .redirect-home i, .footer .bk-header h3, .footer .widget-tabs-title-container li.active h3 a, .widget_tag_cloud a:hover, .footer .widget_rss h3 a, .widget_nav_menu li a, .widget_recent_comments .recentcomments a:last-child, .widget_calendar #wp-calendar td a
                
                    {color: <?php echo $primary_color; ?>}
                
                ::selection
                {background-color: <?php echo $primary_color; ?>}
                ::-moz-selection 
                {background-color: <?php echo $primary_color; ?>}
                body::-webkit-scrollbar-thumb
                {background-color: <?php echo $primary_color; ?>}
                
                .mask-1, .mask-2, .bk-score-box.reverse, .reviewscore.reverse , .bk-review-box .bk-overlay, .bk-author-box , .tagcloud a, .load-more span:hover, ul#flickr li a:hover img, .post-meta .read-more:hover, .header-light .main-nav #main-menu, .article-content blockquote, #bk-carousel-gallery-thumb li.flex-active-slide, #pagination .current, .post-page-links > span, .widget_pages li, .widget_meta li
                {border-color: <?php echo $primary_color; ?>}
                
                .widget-tabs-title-container li.active:after, .module-header-left .bk-header h3:after, .module-header-left .cat-header h3:after, h3.ticker-header:after 
                {border-left-color: <?php echo $primary_color; ?>;border-right-color: <?php echo $primary_color; ?>}
                
                .widget-tabs-title-container li.active:nth-child(n+2):before {border-top-color: <?php echo $primary_color; ?>}
                 
                
        
            <?php }
            if ( isset($dark_color)) {?>
                .main-nav .header-inner, #main-mobile-menu, .header-custom .top-bar, .header-custom #main-menu .menu > li:hover, .header-custom .bk-mega-menu,
                .header-custom .bk-dropdown-menu, .header-custom .main-nav #s, .header-custom .main-nav .search-icon i, .header-custom .main-nav .mobile,
                
                 .widget-tabs-title-container, .widget-tabs-title-container li h4, .widget-tabs-title-container li h3, .cat-header, .bk-header, .bk-review-box .bk-overlay, 
                 
                 .module-carousel .style-thumb, #bk-carousel-gallery-thumb, .cat-btn:hover, .tag-btn:hover, .add-comment-btn:hover, #comment-submit:hover, .post-cat-bg:hover,
                 .widget_calendar tfoot tr              
                
                    {background-color: <?php echo $dark_color; ?>}
                    
                .header-custom .main-nav #main-menu .menu > li.current-menu-item > a,
                .load-more span, .bk-mega-menu .bk-sub-sub-menu > li > a, .bk-dropdown-menu .bk-sub-sub-menu a, .header-light .main-nav #main-menu .menu > li > a, #pagination a, #pagination span, .post-page-links a span           
                
                    {color: <?php echo $dark_color; ?>}
                    
                .load-more .inner, #pagination a, .post-page-links a span
                
                    {border-color: <?php echo $dark_color; ?>}
                
                
                
            <?php }
            if ( $bg_switch == 1) {?>
                body {background: none !important}
            <?php };
            if ( $sb_responsive_sw == 0) {?>
            @media screen and (max-width: 1079px) {
                .sidebar {display: none !important}
            }
            <?php };
            if ($custom_css != '') echo $custom_css;
            ?>
            </style>
            <?php
        endif;
    }
}