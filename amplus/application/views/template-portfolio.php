<?php 
    get_header();
    
    $sidebarLocation = bfi_get_post_meta(get_the_ID(), 'sidebar_location');
    $sidebar = bfi_get_post_meta(get_the_ID(), 'sidebar');
    $sidebarOffset = $sidebarLocation == "left" ? "pull by-twelve" : "";
    $sidebarAlphaOmega = $sidebarLocation == "left" ? "alpha" : "omega";
    $contentOffset = $sidebarLocation == "left" ? "push by-four" : "";
    $contentWidth = $sidebarLocation != "none" ? "twelve" : "sixteen";
    $contentAlphaOmega = '';
    if ($sidebarLocation != "none") {
        $contentAlphaOmega = $sidebarLocation == "left" ? "omega" : "alpha";
    }
    $filtersEnabled = bfi_get_post_meta(get_the_ID(), "portfolio_enable_filters");
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
            echo bfi_strip_stuff("$title<div class='amplus_panel'><div>$contents");
            
            // Loop through all blog posts
            global $post, $wp_query;
            $galleryColumns = bfi_get_post_meta(get_the_ID(), 'portfolio_gallery_type');
            $galleryNum     = bfi_get_post_meta(get_the_ID(), 'portfolio_display_number');
            $categories     = bfi_get_post_meta(get_the_ID(), 'portfolio_categories');
            
            // get the portfolio items
            $cats = '';
            $catSlugs = array();
            if ($categories && is_array($categories)) {
                foreach ($categories as $category) {
                    $cats .= $cats ? ',' : '';
                    $slug = bfi_get_taxonomy_slug($category);
                    $cats .= $slug;
                    $catSlugs[] = $slug;
                }
            }
            
            $wp_query_temp = $wp_query;
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        
            $args = array(
                'post_type' => 'portfolio_item', 
                'portfolio_category' => $cats, 
                'order' => 'desc',
                'orderby' => 'menu_order date',
                'posts_per_page' => $galleryNum, 
                'paged' => $paged, 
                );
                
            // if no category is selected, display all
            if (!$cats) unset($args['portfolio_category']);
        
            // get the portfolio items
            $wp_query = new WP_Query($args);
            
            // create the filter area
            if ($filtersEnabled) {
                $cats = bfi_get_all_portfolio_categories();
                if ($cats && count($catSlugs) > 1) {
                    echo "<div class='filters'><span><i class='icon-filter icon-large'></i> ".__('Filter', BFI_I18NDOMAIN)."</span>";
                    echo "<a href='#' class='button filter selected' onclick='bfi.portfolioFilter(this); return false' data-filter=''>".__('Show all', BFI_I18NDOMAIN)."</a>";
                    foreach ($cats as $cat) {
                        if (in_array($cat->slug, $catSlugs)) {
                            echo "<a href='#' class='button filter not-selected' onclick='bfi.portfolioFilter(this); return false' data-filter='$cat->cat_ID'>$cat->name</a>";
                        }
                    }
                    unset($cats);
                    echo "</div>";
                }
            }
            
            // main container
            echo "<div class='blog-content'>";
            
            $i = 1;
            while ($wp_query->have_posts()) : $wp_query->the_post();
            
                // get the categories the item belongs to
                $portfolioCategories = '';
                $cats = get_the_terms(get_the_ID(), BFIPortfolioModel::TAXONOMY_ID);
                foreach ($cats as $cat) {
                    $portfolioCategories .= $portfolioCategories ? ',' : '';
                    $portfolioCategories .= $cat->term_id;
                }
                unset($cats);
            
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
                
                // compute dimensions of each preview image
                if ($galleryColumns == '4') {
                    $width = 220;
                    $height = 165;
                    $class = 'one-fourth';
                } elseif ($galleryColumns == '3') {
                    $width = 300;
                    $height = 225;
                    $class = 'one-third';
                } else { // 2
                    $width = 460;
                    $height = 345;
                    $class = 'one-half';
                }
        
                // compute the alpha and omega columns
                if ($i % $galleryColumns == 1) {
                    $class .= ' alpha';
                } elseif ($i % $galleryColumns == 0) {
                    $class .= ' omega';
                }
                $i++;
                
                /*
                 * Form the preview image
                 */
                 
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
                
                
                ?>
                <article class='portfolio column <?php echo $class ?> <?php echo bfi_get_post_class('', get_the_ID()) ?>' data-cats='<?php echo $portfolioCategories ?>'>
                    <?php echo $preview ?>
                    <div>
                        <h4><a href='<?php echo get_permalink() ?>'><?php the_title() ?></a></h4>
                        <p><?php echo $subtitle ?></p>
                    </div>
                    <div class='clearfix'></div>
                </article>
                <?php
            endwhile;
            
            echo "</div>";
            
            $navigation = wp_corenavi();
            if ($navigation) {
                echo "<div id='page-nav' class='clearfix'><hr>$navigation</div>";
            }
            
            $wp_query = $wp_query_temp;
            wp_reset_postdata();
            
            echo "<div class='clearfix'></div></div></div>";
        endwhile;
        
        echo "</div>";
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
