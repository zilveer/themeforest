<?php
/*
Template Name: Full Width Template
*/
?>

<?php get_header();?>
        <!-- BEGIN OF PAGE TITLE -->
        <?php if (have_posts()) : ?>      
        <div id="page-title">
        	<div id="page-title-inner">
                <div class="title">
                <h1><?php the_title();?></h1>
                </div>
                <div class="dot-separator-title"></div>
                <div class="description">
                  <?php global $post;?>
                  <?php $short_desc = get_post_meta($post->ID, '_short_desc', true ); ?>
                  <p><?php echo $short_desc;?></p>
                </div>
            </div>   	            
        </div>
        <!-- END OF PAGE TITLE --> 
        
        <!-- BEGIN OF CONTENT -->
        <div id="content">
        	   <div id="content-fullwidth">          
                <div class="maincontent">
                <?php while (have_posts()) : the_post();?>
                <?php the_content();?>
                <?php endwhile;?>     
                </div>
            </div>
            <?php endif;?>        
                  
        </div>
        <!-- END OF CONTENT -->
        <?php get_footer();?>
