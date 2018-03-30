<?php 
/* Template Name: Portfolio */
get_header(); 
query_posts('post_type=portfolio&project-type='.get_post_meta($post->ID, 'portfolio_page_cats', true).'&posts_per_page=-1&orderby=menu_order&order=ASC');
$layout = get_post_meta($post->ID, 'page_layout', true);
?>

	<div id="page-content" class="main-container">    
    
    	<div class="container <?php echo $layout; ?> clearfix">
        
    	<!-- Content Begin -->   
        
        <div id="content" class="content <?php if($layout == "fullwidth"){ echo "portfolio-full"; }elseif($layout == "sidebar-both"){ echo "portfolio-sidebar"; }else echo "portfolio-sidebar"; ?>">
        
        	<?php 
			$cats = strpos(get_post_meta($post->ID, 'portfolio_page_cats', true),",");
			if($of_option['st_filtering_enabled'] && $cats == true) include("includes/filtering-menu.php"); ?>
            
			<div id="portfolio-container">
    		  <?php 
				if ($layout == "sidebar-right" || $layout == "sidebar-left" || $layout == "sidebar-both"){
					$layout = "sidebar";
				}
				$file_name = $layout."-".get_post_meta($post->ID, 'portfolio_style', true)."-".get_post_meta($post->ID, 'portfolio_cols', true);
				include("templates-portfolio/" .$file_name.".php"); ?>   
            </div>
        </div>                  
      
        <?php if(get_post_meta($post->ID, 'page_layout', true) !== "fullwidth"){ ?>
        <!-- Sidebar Begin --> 
        
        <div id="sidebar" class="sidebar four columns">
            <?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar(get_post_meta($post->ID, 'page_sidebar', true))) ?>
        </div>
        
        <!-- Sidebar End --> 
    	<?php } ?> 
        
        </div>
    
	</div>

<?php get_footer(); ?>