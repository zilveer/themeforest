<?php
// Template Name: Full-Width Page
?>

<?php //set theme options
$oswc_trending_hide = $oswc_other['full_width_trending_hide'];

// use variables from page custom fields instead of made options page (if they exist)
$override = get_post_meta($post->ID, "Featured Image Size", $single = true);
if($override!="" && $override!="null") $oswc_featuredimage_size=$override;
$override = get_post_meta($post->ID, "Hide Trending", $single = true);
if($override!="" && $override!="null") {
	$oswc_trending_hide=$override;
	if($oswc_trending_hide=="false") {
		$oswc_trending_hide=false;	
	} else {
		$oswc_trending_hide=true;
	}
}
?>

<?php get_header(); // show header ?>

<div class="hide-responsive"><?php oswc_get_template_part('sharebox'); // show the sharebox ?></div> 

<div class="main-content">

    <div class="page-content">
        
        <div class="content-panel">
        
        	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>            
            
                <h1><?php the_title(); ?></h1>
                
                <?php if($oswc_featuredimage_size=="full" && has_post_thumbnail()) { ?>
                
                	<div class="article-image">
                
                		<?php the_post_thumbnail('single', array( 'title' => '' )); ?>
                        
                    </div>
                    
                <?php } elseif($oswc_featuredimage_size=="medium" && has_post_thumbnail()) { ?>
                
                    <div class="article-image">
                
                        <?php the_post_thumbnail('single-medium', array( 'title' => '' )); ?>
                        
                    </div>
                                    
                <?php } elseif($oswc_featuredimage_size=="small" && has_post_thumbnail()) { ?>
                
                	<div class="article-image">
                
                        <?php the_post_thumbnail('single-small', array( 'title' => '' )); ?>
                        
                    </div>
                	
                <?php } ?>
                
                <div class="the-content">
            
                	<?php the_content(); ?>
                    
                </div>
            
			<?php endwhile;
            endif; ?>
            
        </div>      
        
    </div>
    
    <?php if(!$oswc_trending_hide) { ?>
    
    	<?php oswc_get_template_part('trending'); // show trending ?>
        
    <?php } ?>

</div>

<br class="clearer" />

<?php get_footer(); // show footer ?>