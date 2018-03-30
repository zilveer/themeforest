<?php 
    get_header();
    
    $sidebarLocation = bfi_get_option('portfolio_sidebar_global_location');
    $sidebar = bfi_get_option('portfolio_sidebar');
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
        
        if ( have_posts() ) while ( have_posts() ) : the_post();
            $contents = bfi_get_contents_stripped();
            $titleBoxAtStart = stripos($contents, "<div class=\"clearfix\"></div></div></div><div class='amplus_panel title") === 0 ? true : false;
            $title = '';
            if (!bfi_get_post_meta(get_the_ID(), 'hidetitle') && !$titleBoxAtStart) {
                $title = "<div class='amplus_panel title'><div><h1>".get_the_title()."</h1></div></div>";
            }
            echo "<div class='amplus_panel title'><div><h1>".get_the_title()."</h1></div></div>";
            echo "<div class='amplus_panel'><div>";
            // echo bfi_strip_stuff("$title<div class='amplus_panel'><div>$contents</div></div>");
            
            
            // get the properties of the item
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
            
            $media = $image;
            if ($previewAction == "video") {
                $media = $mediaVideo;
            } elseif ($previewAction == "image") {
                $media = $mediaImage;
            }
            
            $relatedClass = bfi_get_option('show_related_portfolio') ? '' : 'no-related';
            
            ?>
            <article class='blog-content <?php echo bfi_get_post_class($relatedClass, get_the_ID()) ?>'>
                <?php 
                echo $preview;
                echo do_shortcode("[sharebuttons media='$media']");
                ?>
                <div><?php echo bfi_get_contents_stripped(); ?></div>
                <div class='details'><?php echo "$categories" ?></div>
            </article>
            <?php
            
            
            
            /*
             * related categories
             */
            if (bfi_get_option('show_related_portfolio')) {
                $categories = get_the_terms(get_the_ID(), BFIPortfolioModel::TAXONOMY_ID);
                if ($categories && is_array($categories)) {
                    $cats = '';
                    foreach ($categories as $category) {
                        $cats .= $cats ? ',' : '';
                        $cats .= $category->slug;
                    }
                
                    global $wp_query;
                    $wp_query_temp = $wp_query;
                
                    $args = array(
                        'post_type' => 'portfolio_item', 
                        'portfolio_category' => $cats, 
                        'orderby' => 'rand',
                        'post__not_in' => array(get_the_ID()),
                        'posts_per_page' => 3,
                        );
                    
                    $wp_query = new WP_Query($args);    
                    
                    $cats = '';
                    
                    $hadPosts = false;
                    if ($wp_query->have_posts()) {
                        echo "<h4>".__("Related Portfolio", BFI_I18NDOMAIN)."</h4>";
                        echo "<hr>";
                        $hadPosts = true;
                    }
                
                    $i = 0;
                    while ($wp_query->have_posts()) : $wp_query->the_post();
                        $i++;
                    
                        // get the properties of the item
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
                    
                        $width = 300;
                        $height = 225;
                        $class = 'one-third';
                    
                        // image links to portfolio page
                        if ($previewAction == 'page') {
                            $preview = sprintf("<a href='%s' class='%s'><img data-original='%s' src='%s'/><noscript><img src='%s'/></noscript></a>",
                                get_permalink(),
                                "lightbox icon-plus icon-3x",
                                bfi_thumb($image, array('height' => $height, 'width' => $width, 'crop' => true)), // orig image
                                bfi_thumb(BFI_BLANKIMAGE, array('height' => $height, 'width' => $width, 'crop' => true, 'format' => '1')), // blank image
                                bfi_thumb($image, array('height' => $height, 'width' => $width, 'crop' => true)) // orig image
                            );
                        // image lightbox
                        } else if ($previewAction == 'image') {
                            $preview = do_shortcode(sprintf("[lightbox href='%s' src='%s' blank='%s']",
                                $mediaImage,
                                bfi_thumb($image, array('height' => $height, 'width' => $width, 'crop' => true)), // orig image
                                bfi_thumb(BFI_BLANKIMAGE, array('height' => $height, 'width' => $width, 'crop' => true, 'format' => '1')) // blank image
                            ));
                        // video lightbox
                        } else if ($previewAction == 'video') {
                            $preview = do_shortcode(sprintf("[lightbox href='%s' src='%s' blank='%s']",
                                $mediaVideo,
                                bfi_thumb($image, array('height' => $height, 'width' => $width, 'crop' => true)), // orig image
                                bfi_thumb(BFI_BLANKIMAGE, array('height' => $height, 'width' => $width, 'crop' => true, 'format' => '1')) // blank image
                            ));
                        // another link
                        } else if ($previewAction == 'link') {
                            $preview = sprintf("<a href='%s' %s class='%s'><img data-original='%s' src='%s'/><noscript><img src='%s'/></noscript></a>",
                                $url,
                                $newWindow ? "target='_blank'" : '',
                                "lightbox icon-external-link icon-3x",
                                bfi_thumb($image, array('height' => $height, 'width' => $width, 'crop' => true)), // orig image
                                bfi_thumb(BFI_BLANKIMAGE, array('height' => $height, 'width' => $width, 'crop' => true, 'format' => '1')), // blank image
                                bfi_thumb($image, array('height' => $height, 'width' => $width, 'crop' => true)) // orig image
                            );
                        }
                    
                        echo do_shortcode("[col3 class='related-post ".bfi_get_post_class('', get_the_ID())."']$preview<div><h5><a href='".get_permalink()."'>".get_the_title()."</a></h5><p>$subtitle</p><div class='clearfix'></div></div>[/col3]");
                        
                        if ($i == 3) break;
                    endwhile;
                
                    // if the last recent post is missing the other column
                    while ($hadPosts && $i++ < 3) {
                        echo do_shortcode("[col3] [/col3]");
                    }
                
                    $wp_query = $wp_query_temp;
                    wp_reset_postdata();
                }
            }
        endwhile;
        
        echo "</div></div></div>";
        if ($sidebarLocation != "none") {
           echo "<div class='four columns sidebar $sidebarAlphaOmega $sidebarTopMargin'>";
           BFISidebarModel::displayDynamicSidebar($sidebar);
           echo "</div>";
        }
    ?>
  </div>
</div>
<?php 
    get_footer();
?>
