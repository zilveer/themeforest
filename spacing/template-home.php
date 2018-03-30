<?php 
/* Template Name: Homepage */
get_header(); 
?>

	<?php 
	global $of_option;
	$layout = $of_option['st_homepage_layout']['enabled'];
	
	if ($layout) :

	foreach ($layout as $section=>$key) {

		switch($section) {			
	
		// Slider
		case 'slider' :
			include("includes/homepage-slider.php");
		break;
		
		// Page Content
		case 'block_content' : ?>
        	<!--Homepage Content Begin-->
            <div id="page-content" class="main-container">
            
            	<?php
            	$content_layout = $of_option['st_homepage_layout2']['enabled'];
	
                if ($content_layout) :
            
                foreach ($content_layout as $content_block=>$key) {
            
                    switch($content_block) {					
																				
					// Tagline
					case 'tagline' : ?>
						<div id="tagline" class="container">
                            <div class="sixteen columns">
                            <h1>
                            <?php 
                            if($of_option['st_translate']){
                                echo $of_option['st_homepage_tagline'];
                            }else{
                                _e('This is an example homepage tagline', 'spacing');	
                            }
                            ?>
                            </h1>
                            </div>
                        </div>
					<?php
					break;		
                
                    // Recent Work
					case 'recent_work' : 
						include("includes/homepage-work.php");
					break;
					
					// Recent Posts
					case 'recent_posts' : 
						include("includes/homepage-posts.php");
					break;
					
					case 'page_content' : wp_reset_query(); global $post; $homepage_layout = get_post_meta($post->ID, 'page_layout', true);
					?>
						<div id="homepage-content" class="container <?php echo $homepage_layout; ?>">          
						
							<?php if($homepage_layout == "sidebar-both"){ ?>
							<div class="both-container twelve columns">
							<?php } ?>
							<!-- Content Begin -->
							
							<div id="content" class="<?php if($homepage_layout == "fullwidth"){echo "sixteen";}elseif($homepage_layout == "sidebar-both"){ echo "eight"; }else echo "twelve"; ?> columns">        
							
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
									
								<?php the_content(); ?>
									  
							<?php endwhile; endif; ?>   
								
							</div>
							
							<!-- Content End -->
							<?php if($homepage_layout == "sidebar-both"){ ?>
							<div id="sidebar-secondary" class="sidebar four columns">
								<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar(get_post_meta(get_option('page_for_posts'), 'page_second_sidebar', true))) ?>
							</div>
							</div>        
							<?php } if($homepage_layout !== "fullwidth"){ ?>
							<!-- Sidebar Begin --> 
							
							<div id="sidebar" class="sidebar four columns">
								<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar(get_post_meta(get_option('page_for_posts'), 'page_sidebar', true))) ?>
							</div>
							
							<!-- Sidebar End --> 
							<?php } ?> 
							
						</div>
					<?php
					break;
					
					// Dividing Lines
					case 'divider_1' : 
						echo '<div class="divider-homepage"><div class="divider line"></div></div>';
					break;

					case 'divider_2' : 
						echo '<div class="divider-homepage"><div class="divider line"></div></div>';
					break;

					case 'divider_3' : 
						echo '<div class="divider-homepage"><div class="divider line"></div></div>';
					break;
					
					// Clients
					case 'clients' : 
						include("includes/homepage-clients.php");
					break;
					
					// Blog
					case 'blog' : 
						
						$layout = get_post_meta(get_option('page_for_posts'), 'page_layout', true);
					?>
			
					<div class="container <?php echo $layout; ?>">
				
					<?php if($layout == "sidebar-both"){ ?>
					<div class="both-container twelve columns">
					<?php } ?>
					<!-- Homepage Blog Begin -->
					<div id="homepage-blog" class="<?php if($layout == "fullwidth"){echo "sixteen";}elseif($layout == "sidebar-both"){ echo "eight"; }else echo "twelve"; ?> columns">
							<div class="posts-holder">
								<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; query_posts( 'post_type=post&paged='.$paged ); if (have_posts()) : while (have_posts()) : the_post(); ?>    
										
								<div class="post clearfix">
								
									<?php 
								
									$blog_template = $of_option['st_blog_layout'];
									global $more; $more = 0;
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
						
						<!-- Homepage Blog End -->
						
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
					<?php
					break;
					
				}}		
				endif;
				?>
            
            </div>
            <!--Homepage Content End--> 
		<?php
		break;	
		
		// Homepage Custom Content
		case 'custom_content' : ?>
            <div class="homepage-custom">
            	<?php echo $of_option['st_homepage_ccontent']; ?>
            </div>
		<?php
		break;
		
		
		}

	} endif; ?>

<?php get_footer(); ?>