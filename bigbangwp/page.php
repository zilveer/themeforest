<?php 
get_header(); 
global $PAGE_ID;
?>

<?php while ( have_posts() ) : the_post(); 
$featured_image_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'single-post-thumbnail' ); 
$featured_image = $featured_image_array[0];
$sidebar = get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."select_sidebar", true);
$hide_featured_image = get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."hide_featured_image", true); 

if (get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."hide_title", true) != "yes")
{
?>
    <div class="section-title">
    
        <h1 class="title"><?php the_title(); if (get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."subtitle", true) != "") { ?> <span><?php echo get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."subtitle", true); ?></span><?php } ?></h1>
                        
    </div><!--END SECTION TITLE-->
    
<?php
}
else
{
?>
<div style="height:20px;"></div>	
<?php
}
?>  

<?php
if (get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."centered_title", true) != "")
{
?>
    <div class="section-title text-align-center">
    
        <h1 class="title"><?php echo get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."centered_title", true); ?></h1>
<?php if (get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."subtitle", true) != "") { ?> <p><?php echo get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."subtitle", true); ?></p><?php } ?>
                        
    </div><!--END SECTION TITLE-->
<?php
}
if ($sidebar)
{
?> 
    <div id="inner-content">
<?php
}
else
{
?>
    <div class="one">
<?php
}
if ($featured_image != "" && $hide_featured_image != "yes")
{
?> 
<p><img src="<?php echo $featured_image; ?>" alt="<?php the_title(); ?>"></p>
<?php
}
if (extra_images_exists()) include ("slider.inc.php");

the_content(); 
?>
    </div><!--END ONE-->
<?php

if ($sidebar) get_sidebar(); 

?>

<?php endwhile; // end of the loop. ?> 
	
<?php get_footer(); ?>
			