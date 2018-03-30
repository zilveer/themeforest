<?php
get_header();
global $of_option;
$layout = $of_option['st_archives_layout'];
?>

<div id="search-content" class="main-container">
    
    <div class="container <?php echo $layout; ?>">

    <!-- Content Begin -->
    
    <div id="content" class="<?php if($layout == "fullwidth"){echo "sixteen";}else { echo "twelve"; } ?> columns">        
    
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            
        <div class="post clearfix">
                    
			<?php 
        
            $blog_template = $of_option['st_blog_layout'];
            
            if(!$blog_template || $blog_template == 1){                    
                include "templates-blog/blog-index-default.php";                    
            } else {                    
                include "templates-blog/blog-index-classic.php";
            }
            
            ?>
        
        </div>
              
    <?php endwhile; else : ?>
	
    	<?php echo $of_option['st_tr_no_results']; ?>		
			
	<?php endif; ?>
    
    <?php blog_pagination(); ?>
        
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