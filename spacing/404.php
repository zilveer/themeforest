<?php
$post = $wp_query->post;
get_header();
$layout = $of_option['st_archives_layout'];
?>

<div id="404-content" class="main-container">
    
    <div class="container <?php echo $layout; ?>">

    <!-- Content Begin -->
    
    <div id="content" class="<?php if($layout == "fullwidth"){echo "sixteen";}else { echo "twelve"; } ?> columns">    
        
        <?php echo $of_option['st_tr_404_content']; ?>
        
    </div>
    
    <!-- Content End -->    
    <?php if($layout !== "fullwidth"){ ?>
    <!-- Sidebar Begin --> 
    
    <div id="sidebar" class="sidebar four columns">
        <?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar("Archives/Search Sidebar")) ?>
    </div>
    
    <!-- Sidebar End --> 
    <?php } ?> 
    
    </div> 
    
</div>
					
<?php get_footer(); ?>