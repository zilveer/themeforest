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
    global $wpdb;
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
            
            // get all pages
            echo "<div class='one-third column alpha'>";
            echo "<h4>".__("Pages", BFI_I18NDOMAIN)."</h4><hr>";
            echo "<ul class='sitemap'>";
            $myposts = get_posts(array(
                'posts_per_page' => $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->posts WHERE post_type = 'page' AND post_status = 'publish'"),
                'orderby' => 'title', //'menu_order date',
                'post_type' => 'page',
                'order' => 'asc',
            ));
            foreach ($myposts as $post) {
                // echo list
                echo "<li><i class='icon-file-alt'></i>";
                echo "<a href='".get_permalink($post->ID)."'>$post->post_title</a>";
                echo "</li>";
            }
            unset($myposts);
            echo "</ul>";
        
        
            // get all portfolio
            echo "<h4>".__("Portfolio", BFI_I18NDOMAIN)."</h4><hr>";
            echo "<ul class='sitemap'>";
            $myposts = get_posts(array(
                'posts_per_page' => $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->posts WHERE post_type = 'portfolio_item' AND post_status = 'publish'"),
                'orderby' => 'title', //'menu_order date',
                'post_type' => 'portfolio_item',
                'order' => 'asc',
            ));
            foreach ($myposts as $post) {
                // echo list
                echo "<li><i class='icon-briefcase'></i>";
                echo "<a href='".get_permalink($post->ID)."'>$post->post_title</a>";
                echo "</li>";
            }
            unset($myposts);
            echo "</ul>";
            echo "</div>";
        
        
            // get all posts
            echo "<div class='one-third column'>";
            echo "<h4>".__("Blog Posts", BFI_I18NDOMAIN)."</h4><hr>";
            echo "<ul class='sitemap'>";
            $myposts = get_posts(array(
                'posts_per_page' => $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish'"),
                'orderby' => 'title', //'date',
                'order' => 'asc',
            ));
            foreach ($myposts as $post) {
                // form the date
                $month = mysql2date("M", $post->post_date);
                $day = mysql2date("j", $post->post_date);
                $year = mysql2date("Y", $post->post_date);
                if ($year == date("Y")) { // same year
                    $date = "$month $day";
                } else {
                    $date = "$month $day, $year";
                }
                $date = "<span class='date'>".sprintf(__("on %s", BFI_I18NDOMAIN), $date)."</span>";
                // echo list
                echo "<li><i class='icon-pencil'></i>";
                echo "<div><a href='".get_permalink($post->ID)."'>$post->post_title</a> $date</div>";
                echo "</li>";
        
                unset($date);
                unset($month);
                unset($day);
                unset($year);
            }
            unset($myposts);
            wp_reset_postdata();
            echo "</ul>";
            echo "</div>";
        
        
        
            echo "<div class='one-third column omega'>";
            // get all post categories
            echo "<h4>".__("Blog Categories", BFI_I18NDOMAIN)."</h4><hr>";
            echo "<ul class='sitemap'>";
            $categories = get_categories(array('hide_empty' => 0));
            foreach ($categories as $category) {
                $num = $category->count ? "<span> ($category->count)</span>" : '';
        
                // echo list
                echo "<li><i class='icon-folder-open'></i>";
                echo "<a href='".get_category_link($category->cat_ID)."'>$category->name</a>$num";
                echo "</li>";
            }
            unset($categories);
            echo "</ul>";
        
        
            // get all portfolio categories
            echo "<h4>".__("Portfolio Categories", BFI_I18NDOMAIN)."</h4><hr>";
            echo "<ul class='sitemap'>";
            $portfolioCategories = bfi_get_all_portfolio_categories();
            foreach ($portfolioCategories as $category) {
                $num = $category->count ? "<span> ($category->count)</span<" : '';
                $link = get_term_link($category->slug, BFIPortfolioModel::TAXONOMY_ID);
                // echo list
                echo "<li><i class='icon-tag'></i>";
                echo "<a href='$link'>$category->name</a>$num";
                echo "</li>";
            }
            unset($portfolioCategories);
            echo "</ul>";
            echo "</div><div class='clearfix'></div>";
            
            
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
