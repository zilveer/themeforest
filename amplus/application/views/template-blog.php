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
            $categories = bfi_get_post_meta(get_the_ID(), "blog_categories");
            
            // display the blog contents
            $cats = '';
            if ($categories && is_array($categories)) {
                foreach ($categories as $category) {
                    $cats .= $cats ? ',' : '';
                    $cats .= $category;
                }
            }
            
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $wp_query_temp = $wp_query;
            
            $args = array(
                'cat' => $cats, 
                'paged' => $paged, 
                'posts_per_page' => 5
                );
                
            // if no category is selected, display all
            if (!$cats) unset($args['cat']);
                
            $wp_query = new WP_Query($args);
            
            echo "<div class='blog-content'>";
            
            $i = 1;
            while ($wp_query->have_posts()) : $wp_query->the_post();
            
                if ( has_post_thumbnail( $post->ID ) ) {
                    $image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
                } else {
                    $image = bfi_get_post_meta( $post->ID, "preview_image" );
                }
                $mediaType = bfi_get_post_meta($post->ID, "preview_type");
                $video = bfi_get_post_meta($post->ID, "preview_video");
                
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
                    <h2><a href='<?php echo get_permalink() ?>'><?php the_title() ?></a></h2>
                    <div class='details'><?php echo "$author $categories $comments" ?></div>
                    <?php echo $preview ?>
                    <div class='excerpt'><?php echo bfi_get_the_excerpt(600); ?></div>
                    <?php echo do_shortcode(sprintf("[button class='readmore' label='%s <i class=\"icon-double-angle-right\"></i>' href='%s']", __("Read more", BFI_I18NDOMAIN), get_permalink())) ?>
                    <div class='clearfix'></div>
                </article>
                <?php
            endwhile;
            
            echo "</div>";
            
            $navigation = wp_corenavi();
            if ($navigation) {
                echo "<div id='page-nav'><hr>$navigation</div>";
            }
            
            $wp_query = $wp_query_temp;
            wp_reset_postdata();
            
            echo "</div></div>";
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
