<?php
$post = $wp_query->post;
get_header();

// Translation

if(!$of_option['tr_enabled']){	
	$tr_author = $of_option['tr_author'];
	$tr_posted_in = $of_option['tr_posted_in'];
	$tr_tags = $of_option['tr_tags'];
}else{			
	$tr_author = __('Author', 'spacing');
	$tr_posted_in = __('Posted in', 'spacing');
	$tr_tags = __('Tags', 'spacing');
}
$layout = get_post_meta($post->ID, 'page_layout', true);
?>

	<div id="page-content" class="main-container">
    
    	<div class="container <?php echo $layout; ?>">
    
    	<?php if($layout == "sidebar-both"){ ?>
    	<div class="both-container twelve columns">
        <?php } ?>
    	<!-- Content Begin -->
        <div id="content" class="<?php if($layout == "fullwidth"){echo "sixteen";}elseif($layout == "sidebar-both"){ echo "eight"; }else echo "twelve"; ?> columns">
        
        <?php 		
		$blog_template = $of_option['st_blog_layout'];
		
		if(!$blog_template || $blog_template == "1"){			
			include "templates-blog/blog-single-default.php";			
		} else {			
			include "templates-blog/blog-single-classic.php";			
		}		
		?>
            
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
            <?php $sidebar = get_post_meta($post->ID, 'page_sidebar', true); if(!$sidebar) { $sidebar = "Default Sidebar"; } if(!function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar)) ?>
        </div>
        
        <!-- Sidebar End --> 
    	<?php } ?> 
        
        </div> 
    
    </div>
					
<?php get_footer(); ?>