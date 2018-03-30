<?php 
    get_header();
    
    $title = sprintf(__('Search Results For: %s', BFI_I18NDOMAIN), get_search_query());
    
    $sidebarLocation = "right";
    $sidebarOffset = $sidebarLocation == "left" ? "pull by-twelve" : "";
    $sidebarAlphaOmega = $sidebarLocation == "left" ? "alpha" : "omega";
    $contentOffset = $sidebarLocation == "left" ? "push by-four" : "";
    $contentWidth = $sidebarLocation != "none" ? "twelve" : "sixteen";
    $contentAlphaOmega = '';
    if ($sidebarLocation != "none") {
        $contentAlphaOmega = $sidebarLocation == "left" ? "omega" : "alpha";
    }
?>
<div class='content'>
  <div class='container'>
    <?php 
        echo "<div class='$contentWidth columns $contentAlphaOmega'>";
        
        echo bfi_strip_stuff("<div class='amplus_panel title'><div><h1>$title</h1></div></div><div class='amplus_panel'><div>");
        
        $readmore = __("Read more", BFI_I18NDOMAIN);
        
        echo "<div class='blog-content'>";
        
        global $wp_query;
        
        // show no results notice
        if (!$wp_query->have_posts()) {
            echo do_shortcode("[infobox type='notice']".__("Sorry, we cannot find what you are looking for. Please try another search.", BFI_I18NDOMAIN)."[/infobox]");
        }
        
        while ( $wp_query->have_posts() ) : $wp_query->the_post();
        
            global $post;
            
            /*
             * PAGES
             */
            if ($post->post_type == "page") {
            
                bfi_set_excerpt_readmore('');
                ?>
                <article class='search-result-page <?php echo bfi_get_post_class('', get_the_ID()) ?>'>
                    <a href='<?php echo get_permalink() ?>'><h2><?php the_title() ?></h2></a>
                    <hr>
                    <div class='excerpt'><?php echo bfi_get_the_excerpt(500); ?></div>
                    <?php echo do_shortcode(sprintf("[button class='readmore' label='%s <i class=\"icon-double-angle-right\"></i>' href='%s']", __("Go to page", BFI_I18NDOMAIN), get_permalink())) ?>
                    <div class='clearfix'></div>
                </article>
                <?php
                
            /*
             * PORTFOLIO
             */
            } elseif ($post->post_type == "portfolio_item") {
            
                if ( has_post_thumbnail( get_the_ID() ) ) {
                    $image = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
                } else {
                    $image = bfi_get_post_meta( get_the_ID(), "preview_image" );
                }
                $subtitle      = bfi_get_post_meta(get_the_ID(), "subtitle");
                $previewAction = bfi_get_post_meta(get_the_ID(), "preview_action");
                $url           = bfi_get_post_meta(get_the_ID(), "url_action");
                $newWindow     = bfi_get_post_meta(get_the_ID(), "url_new_window");
                $mediaImage    = bfi_get_post_meta(get_the_ID(), "media_image");
                $mediaVideo    = bfi_get_post_meta(get_the_ID(), "media_video");
                $videoEmbed    = bfi_get_post_meta(get_the_ID(), "media_video_embed");
                
                // categories
                $categories = "";
                if (get_the_term_list(get_the_ID(), BFIPortfolioModel::TAXONOMY_ID, '', ', ', '')) {
                    $categories = "<span class='categories'>".get_the_term_list(get_the_ID(), BFIPortfolioModel::TAXONOMY_ID, '', ', ', '')."</span>";
                }
        
                $preview = '';
                if ($previewAction == "page" || $previewAction == "link") {
                    $preview = do_shortcode("[image src='".bfi_thumb($image, array('height' => 300, 'width' => 940, 'crop' => true))."' href='$image']");
                } else if ($previewAction == "image") {
                    $preview = do_shortcode("[image src='".bfi_thumb($mediaImage, array('height' => 300, 'width' => 940, 'crop' => true))."' href='$mediaImage']");
                } else if ($previewAction == "video") {
                    $preview = $videoEmbed;
                }
        
                bfi_set_excerpt_readmore('');
                ?>
                <article class='<?php echo bfi_get_post_class('', get_the_ID()) ?>'>
                    <a href='<?php echo get_permalink() ?>'><h2><?php the_title() ?></h2></a>
                    <hr>
                    <div class='details'><?php echo "$categories" ?></div>
                    <?php echo $preview ?>
                    <div class='excerpt'><?php echo bfi_get_the_excerpt(500); ?></div>
                    <?php echo do_shortcode(sprintf("[button class='readmore' label='%s <i class=\"icon-double-angle-right\"></i>' href='%s']", __("View portfolio", BFI_I18NDOMAIN), get_permalink())) ?>
                    <div class='clearfix'></div>
                </article>
                <?php
                
                
            /*
             * POSTS
             */
            } else {
        
                if ( has_post_thumbnail( get_the_ID() ) ) {
                    $image = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
                } else {
                    $image = bfi_get_post_meta( get_the_ID(), "preview_image" );
                }
                $mediaType = bfi_get_post_meta(get_the_ID(), "preview_type");
                $video = bfi_get_post_meta(get_the_ID(), "preview_video");
            
                // date
                $month = get_the_date("M");
                $day = get_the_date("j");
                $year = get_the_date("Y");
                // $date = "$month $day, $year";
                $date = "<span class='date_cont'>" 
                        . "<span class='date_big month'>$month</span>"
                        . "<span class='date_big day'>$day</span>"
                        . "<span class='date_big year'>$year</span>"
                        . "</span>";
            
                // author
                $author = sprintf('<span class="author"><a href="%1$s" title="%2$s">%3$s</a></span>',
                    get_author_posts_url(get_the_author_meta('ID')),
                    sprintf(__("View all posts by %s", BFI_I18NDOMAIN), get_the_author()),
                    get_the_author());
            
                // comments
                $comments = '';
                if (comments_open(get_the_ID())) {
                    $comments .= "<span class='comments'>".bfi_comments_number(__('No comments', BFI_I18NDOMAIN), __('1 comment', BFI_I18NDOMAIN), __('% comments', BFI_I18NDOMAIN))."</span>";
                }
            
                // categories    
                $categories = "";
                if (get_the_category_list(', ')) {
                    $categories = "<span class='categories'>".get_the_category_list(', ')."</span>";
                }
            
                bfi_set_excerpt_readmore('');
                
                $preview = '';
                if ($mediaType == "image") {
                    $preview = sprintf("<a href='%s' class='%s'><img data-original='%s' src='%s'/><noscript><img src='%s'/></noscript></a>",
                        get_permalink(),
                        "lightbox icon-plus icon-3x",
                        bfi_thumb($image, array('height' => 300, 'width' => 940, 'crop' => true)), // orig image
                        bfi_thumb(BFI_BLANKIMAGE, array('height' => 300, 'width' => 940, 'crop' => true, 'format' => '1')), // blank image
                        bfi_thumb($image, array('height' => 300, 'width' => 940, 'crop' => true)) // orig image
                    );
                } else {
                    $preview = $video;
                }
                ?>
                <article class='<?php echo bfi_get_post_class('', get_the_ID()) ?>'>
                    <?php echo $date ?>
                    <a href='<?php echo get_permalink() ?>'><h2><?php the_title() ?></h2></a>
                    <div class='details'><?php echo "$author $categories $comments" ?></div>
                    <?php echo $preview ?>
                    <div class='excerpt'><?php echo bfi_get_the_excerpt(500); ?></div>
                    <?php echo do_shortcode(sprintf("[button class='readmore' label='%s <i class=\"icon-double-angle-right\"></i>' href='%s']", $readmore, get_permalink())) ?>
                    <div class='clearfix'></div>
                </article>
                <?php
                
                
                
            }
        endwhile;
        
        $navigation = wp_corenavi();
        if ($navigation) {
            echo "<div id='page-nav'><hr>$navigation</div>";
        }
        
        echo "</div></div></div></div>";
        
        if ($sidebarLocation != "none") {
            echo "<div class='four columns sidebar $sidebarAlphaOmega $sidebarTopMargin'>";
           
            echo do_shortcode("<div class='amplus_panel title'><div><h4>".__("Search the site", BFI_I18NDOMAIN)."</h4></div></div><div class='amplus_panel'><div>[searchbar]<div class='clearfix'></div></div></div>");
            
            $afterWidget = '<div class="clearfix"></div></div></div></article>';
            $beforeTitle = '<div class="amplus_panel title"><div><h4 class="title">';
            $afterTitle = '</h4></div></div><div class="amplus_panel"><div>';
            
            bfi_the_widget('WP_Widget_Archives', array(
                "title" => __("Archives", BFI_I18NDOMAIN)),
                array(
                    "after_widget" => $afterWidget,
                    "before_title" => $beforeTitle,
                    "after_title" => $afterTitle));
            bfi_the_widget('WP_Widget_Calendar', array(
                "title" => __("Archive Calendar", BFI_I18NDOMAIN)),
                array(
                    "after_widget" => $afterWidget,
                    "before_title" => $beforeTitle,
                    "after_title" => $afterTitle));
            bfi_the_widget('WP_Widget_Recent_Comments', array(
                "title" => __("Recent Comments", BFI_I18NDOMAIN)),
                array(
                    "after_widget" => $afterWidget,
                    "before_title" => $beforeTitle,
                    "after_title" => $afterTitle));
            bfi_the_widget('WP_Widget_Recent_Posts', array(
                "title" => __("Recent Posts", BFI_I18NDOMAIN),
                "number" => 10),
                array(
                    "after_widget" => $afterWidget,
                    "before_title" => $beforeTitle,
                    "after_title" => $afterTitle));
                
            echo "</div>";
        }
    ?>
  </div>
</div>
<?php 
    get_footer();
?>
