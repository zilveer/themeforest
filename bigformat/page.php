<?php get_header(); ?>

<?php 
/* #Start the Loop
======================================================*/
if (have_posts()) : while (have_posts()) : the_post(); 
?>

<?php
/* #Get Fullscreen Background
======================================================*/
$pageimage = get_post_meta($post->ID,'_thumbnail_id',false);
$pageimage = wp_get_attachment_image_src($pageimage[0], 'portfoliolarge', false); 
ag_fullscreen_bg($pageimage[0]); 
?>

<div class="contentarea">

<!-- Page Title
  ================================================== -->
<div class="container namecontainer">
        <div class="pagename">
            <h2><span><?php the_title(); ?></span></h2>
        </div>
</div>
<!-- End Page Title -->

<!-- Page Content
  ================================================== -->
<div class="container clearfix"><div class="clear"></div>

    <div class="smallpage content pagebg">
        <div class="contentwrap">
        
                    <?php the_content(); ?>
                     <?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
        
                    <?php endwhile; else :?>
                    <!-- Else nothing found -->
                    <h2><?php _e('Error 404 - Not found.', 'framework'); ?></h2>
                    <p><?php _e("Sorry, but you are looking for something that isn't here.", 'framework'); ?></p>
                   <!--BEGIN .navigation .page-navigation -->
                    <?php endif; ?>
                    
                    <div class="clear"></div>
        </div>          
    </div>
    
    <div class="sidebar">
       <?php	/* Widget Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Page Sidebar') ) ?>
        <div class="clear"></div>
    </div>

<div class="clear"></div>
</div>
<!-- End Page Content -->
  
</div>
<?php get_footer(); ?>