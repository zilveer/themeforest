<?php 
get_header(); 
$layout = get_post_meta(get_option('page_for_posts'), 'page_layout', true);
query_posts( 'posts_per_page=6&paged='.$paged.'&cat='.$cat.'&author='.$author.'&tag='.$tag );
?>
	<div id="page-content" class="blog-container main-container">
    
    	<div class="container <?php echo $layout; ?>">
    
    	<?php if($layout == "sidebar-both"){ ?>
    	<div class="both-container twelve columns">
        <?php } ?>
    	<!-- Content Begin -->
        <div id="content" class="<?php if($layout == "fullwidth"){echo "sixteen";}elseif($layout == "sidebar-both"){ echo "eight"; }else echo "twelve"; ?> columns">
        	<div class="posts-holder">
				<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; query_posts( 'post_type=post&paged='.$paged ); if (have_posts()) : while (have_posts()) : the_post(); ?>    
                        
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
                
                <?php endwhile;
        
                # Archive doesn't exist:
                else :
                
                    get_header(); ?>
                    <?php echo $of_option['st_tr_404_content']; ?>
                <?php
                endif; wp_reset_query(); ?> 
            </div>
                       
            <?php blog_pagination(); ?>
        </div>
        
        <!-- Content End -->
        
        <?php if($layout == "sidebar-both"){ ?>
        <div id="sidebar-secondary" class="sidebar four columns">
            <?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar(get_post_meta(get_option('page_for_posts'), 'page_second_sidebar', true))) ?>
        </div>
        </div>        
        <?php } if($layout !== "fullwidth"){ ?>
        <!-- Sidebar Begin --> 
        
        <div id="sidebar" class="sidebar four columns">
            <?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar(get_post_meta(get_option('page_for_posts'), 'page_sidebar', true))) ?>
        </div>
        
        <!-- Sidebar End --> 
    	<?php } ?> 
        
        </div> 
    
    </div>


<?php get_footer(); ?>