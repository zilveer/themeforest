<?php
$post = $wp_query->post;
get_header();
$layout = get_post_meta($post->ID, 'page_layout', true);
?>

	<div id="page-content" class="main-container">
    
    	<div class="container <?php echo $layout; ?>">
    
    	<?php if($layout == "sidebar-both"){ ?>
    	<div class="both-container twelve columns">
        <?php } ?>
    	<!-- Content Begin -->
        
        <div id="content" class="<?php if($layout == "fullwidth"){echo "sixteen";}elseif($layout == "sidebar-both"){ echo "eight"; }else echo "twelve"; ?> columns">        
        
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                
			<?php the_content(); ?>
                  
        <?php endwhile; endif; ?>   
            
        </div>
        
        <!-- Content End -->
        <?php if($layout == "sidebar-both"){ ?>
        <div id="sidebar-secondary" class="sidebar four columns">
            <?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar(get_post_meta($post->ID, 'page_second_sidebar', true))) ?>
        </div>
        </div>        
        <?php } if($layout !== "fullwidth"){ ?>
        <!-- Sidebar Begin --> 
        
        <div id="sidebar" class="sidebar four columns">
            <?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar(get_post_meta($post->ID, 'page_sidebar', true))) ?>
        </div>
        
        <!-- Sidebar End --> 
    	<?php } ?> 
        
        </div> 
    
    </div>


					
<?php get_footer(); ?>