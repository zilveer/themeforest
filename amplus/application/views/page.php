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
            echo bfi_strip_stuff("$title<div class='amplus_panel'><div>$contents</div></div>");
        endwhile;
        echo "</div>";
        if ($sidebarLocation != "none") {
           echo "<div class='four columns sidebar $sidebarAlphaOmega'>";
           BFISidebarModel::displayDynamicSidebar($sidebar);
           echo "</div>";
        }
    ?>
  </div>
</div>
<?php 
    get_footer();
?>
