<?php /*
  Template Name: Blog (Sidebar) Template
 */ ?>


<?php get_header(); ?>


    <?php 

$wmodulepage = get_post_meta(get_the_ID(), 'wmodulepage', true);

?>

 <div class="pageInfo">
        
        <div class="container">
            
            <div class="eight columns pageTitle">
                
                <h1><?php the_title(); ?></h1>
                
            </div>
            
            <div class="eight columns breadcrumb">
               
               <?php my_breadcrumb(); ?>    
            </div>
            
        </div>
        
    </div>

   <div class="pageContentWrapper">
        
        <div class="container">
            
            <div class="two-thirds column">
                
                    <ul class="newsPostList">
                
                            <?php
                global $paged;


                $arguments = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'paged' => $paged
                );

                $blog_query = new WP_Query($arguments);

                dd_set_query($blog_query);
            ?>
                    
         <?php if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post(); ?>

                      <?php 

$bigimg = get_post_meta(get_the_ID(), 'bigimg', true);

?>

                        
                    <li <?php post_class('singleInfo'); ?>>
                    
                               <?php if( $bigimg) { ?>
                        
                        <div class="singleThumb"><a href="<?php the_permalink(); ?>"><img src="<?php echo $bigimg; ?>" alt="" /></a></div>
                    
                                <?php } ?>
                        
                    <div class="singleMeta clearfix">
                        
                        <h1 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                          <span><?php _e('By', 'localization'); ?> <?php the_author(); ?> | <?php _e('In', 'localization'); ?> <?php the_category(', ');?> | on <?php the_time('F j, Y'); ?> </span>
                                   
                    </div>
                    
                    <div class="excerpt">
                        
                                <?php the_excerpt(); ?>
            
                        
                           <a class="button-small-theme rounded3 " href="<?php the_permalink(); ?>"><?php _e('CONTINUE READING', 'localization'); ?></a>
                                 
                        
                    </div>
                    
                </li>

        <?php endwhile; ?>

<?php endif; ?>
                     
                 </ul>

                
				 <?php
                            kriesi_pagination();

                            dd_restore_query();
?>                  

            </div>
            
            
                 
       
                 
            
            <ul class="sidebar one-third column clearfix">
               
                   <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Blog")) ; ?>
                
            </ul>
            
        </div>
        
    </div>

 <?php if ( $wmodulepage == 'yes') { ?>

<div class="widgetModuleWrapper">
        
    <ul class="widgetModule container clearfix">
        
          <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Widgetized Module")) ; ?>
        
    </ul>
    
</div>

<div style="display: none;"><?php the_tags(); ?><?php  posts_nav_link(); ?><?php if ( ! isset( $content_width ) ) $content_width = 900; ?></div>

        <?php } ?>


<?php get_footer(); ?>

