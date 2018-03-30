<?php 
    get_header();
    
    $sidebarLocation = bfi_get_option('sidebar_post_location');
    $sidebar = bfi_get_option('sidebar_post');
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
            if ($year == date("Y")) { // same year
                $date = "$month $day";
            } else {
                $date = "$month $day, $year";
            }
            $date = "<span class='date'>$date</span>";
            
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
            
            // tags
            $tags = '';
            if (get_the_tag_list())
                $tags = "<span class='tags'>".get_the_tag_list('', ', ')."</span>";
            
            $preview = '';
            if ($mediaType == "image") {
                $preview = do_shortcode("[image src='".bfi_thumb($image, array('height' => 300, 'width' => 940, 'crop' => true))."' href='$image']");
            } else {
                $preview = $video;
            }
            ?>
            <article class='blog-content <?php echo bfi_get_post_class('', get_the_ID()) ?>'>
                <?php 
                echo $preview;
                ?>
                <div class='details'><?php echo "$date $author $categories $tags $comments" ?></div>
                <hr>
                <div><?php echo bfi_get_contents_stripped(); ?></div>
            </article>
            <?php
            
            $media = $mediaType == "image" ? $image : $video;
            echo do_shortcode("[sharebuttons media='$media']");
            
            
            // previous and next buttons
            if (get_next_post() != '' || get_previous_post() != '') {
                if (get_previous_post()) {
                    echo "<a href='".get_permalink(get_previous_post()->ID)."' class='button readmore prev-post'><i class='icon-double-angle-left'></i> ".__("Older post", BFI_I18NDOMAIN)."</a>";
                }
                if (get_next_post()) {
                    echo "<a href='".get_permalink(get_next_post()->ID)."' class='button readmore next-post'>".__("Newer post", BFI_I18NDOMAIN)." <i class='icon-double-angle-right'></i></a>";
                }
            }
            echo "<div class='clearfix'></div>";
            
            
            // author box
            if (bfi_get_option('author_global_enabled') == '1') {
                $avatar = function_exists('get_avatar') ? get_avatar(get_the_author_meta('email'), '80' ) : '';
                $name = '<a href="'.get_author_posts_url(get_the_author_meta('ID')).'">'.get_the_author().'</a>';
                // $allPosts = sprintf(__('View all posts by %s', BFI_I18NDOMAIN), '<a href="'.get_author_posts_url(get_the_author_meta('ID')).'">'.get_the_author().'</a>');
                if ($avatar) $avatar = "<span class='avatar'>$avatar</span>";
                ?>
                <div class='spacer'></div>
                <div class='spacer'></div>
                <h4><?php _e("About the Author", BFI_I18NDOMAIN) ?></h4>
                <hr>
                <div class='author-box'>
                    <?php echo $avatar ?>
                    <div>
                        <h4><?php echo $name ?></h4>
                        <p><?php echo get_the_author_meta('description') ?></p>
                        <?php echo do_shortcode("[button label='".__("View all posts by author", BFI_I18NDOMAIN)."' href='".get_author_posts_url(get_the_author_meta('ID'))."']"); ?>
                    </div>
                </div>
                <div class='clearfix'></div>
            <?php
            }
            
            
            
            /*
             * related categories
             */
            if (bfi_get_option('show_related_posts')) {
                $categories = get_the_category();
                if ($categories && is_array($categories)) {
                    $cats = '';
                    foreach ($categories as $category) {
                        $cats .= $cats ? ',' : '';
                        $cats .= $category->cat_ID;
                    }
                    $cats = '';
                    global $wp_query;
                    $wp_query_temp = $wp_query;
                    $wp_query = new WP_Query(array(
                        'cat' => $cats, 
                        //'post_count' => 3,
                        'posts_per_page' => 3,
                        'orderby' => 'rand',
                        'post__not_in' => array(get_the_ID())
                        ));
                
                    $hadPosts = false;
                    if ($wp_query->have_posts()) {
                        echo "<div class='spacer'></div><div class='spacer'></div>";
                        echo "<h4>".__("Related Posts", BFI_I18NDOMAIN)."</h4>";
                        echo "<hr>";
                        $hadPosts = true;
                    }
                
                    $i = 0;
                    while ($wp_query->have_posts()) : $wp_query->the_post();
                        $i++;
                    
                        if ( has_post_thumbnail( get_the_ID() ) ) {
                            $image = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
                        } else {
                            $image = bfi_get_post_meta( get_the_ID(), "preview_image" );
                        }
                        $mediaType = bfi_get_post_meta(get_the_ID(), "preview_type");
                        $video = bfi_get_post_meta(get_the_ID(), "preview_video");
                    
                        $preview = '';
                        if ($mediaType == "image") {
                            $preview = sprintf("<a href='%s' class='%s'><img data-original='%s' src='%s'/><noscript><img src='%s'/></noscript></a>",
                                get_permalink(),
                                "lightbox icon-plus icon-3x",
                                bfi_thumb($image, array('height' => 315, 'width' => 420, 'crop' => true)), // orig image
                                bfi_thumb(BFI_BLANKIMAGE, array('height' => 315, 'width' => 420, 'crop' => true, 'format' => '1')), // blank image
                                bfi_thumb($image, array('height' => 315, 'width' => 420, 'crop' => true)) // orig image
                            );
                        } else {
                            $video = preg_replace("/width=[\"|\']\d+[\"|\']/i", "width=\"420\"", $video);
                            $video = preg_replace("/height=[\"|\']\d+[\"|\']/i", "height=\"315\"", $video);
                            $preview = $video;
                            $preview = "<div>$preview<div class='clearfix'></div></div>";
                        }
                    
                        echo do_shortcode("[col3 class='related-post ".bfi_get_post_class('', get_the_ID())."']$preview<h5><a href='".get_permalink()."'>".get_the_title()."</a></h5>[/col3]");
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
            
            // add replies / comments
            if (comments_open(get_the_ID()) || get_comments_number()) {
                echo "<div class='spacer'></div><div class='spacer'></div>";
                echo "<h4>";
                comments_number(__('Comments', BFI_I18NDOMAIN), __('Comment (1)', BFI_I18NDOMAIN), __('Comments (%)', BFI_I18NDOMAIN));
                echo "</h4>";
                ?>
                <hr>
                <div class='comments'>
                    <?php comments_template() ?>
                </div>
                <?php
            }
            // display 'comments are closed' if necessary
            if (!comments_open(get_the_ID()) && get_comments_number()) {
                echo "<div class='spacer'></div><div class='spacer'></div>";
                echo do_shortcode("[infobox type='notice']".__("Comments are closed for this post", BFI_I18NDOMAIN)."[/infobox]");
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
