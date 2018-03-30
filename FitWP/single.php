<?php get_header(); ?>





 <div class="pageInfo">
        
        <div class="container">
            
            <div class="five columns pageTitle">
                
                      <?php if (ot_get_option('blogtitle')) {  ?>
                
                <h1><?php echo ot_get_option('blogtitle') ?></h1>
                
                    <?php } else { ?>
                
                <h1><?php _e('NEWS', 'localization'); ?></h1>
                
                    <?php } ?>
                
            </div>
            
            <div class="eleven columns breadcrumb">
               
               <?php my_breadcrumb(); ?>    
            </div>
            
        </div>
        
    </div>

   <div class="pageContentWrapper">
        
        <div class="container">
            
            <div class="two-thirds column">
                
                
                         <?php
        if (have_posts ()) {

            while (have_posts ()) {

                (the_post());
        ?>

                      <?php 

$bigimg = get_post_meta(get_the_ID(), 'bigimg', true);
$quote = get_post_meta(get_the_ID(), 'quote', true);
$contactemail = get_post_meta(get_the_ID(), 'contactemail', true);


?>

                 <div class="singleInfo">
        
                    
                        <?php if( $bigimg) { ?>
                                
                                    <div class="singleThumb"><img src="<?php echo $bigimg; ?>" alt="" /></div>
    
      <?php } ?>
                                
                                  
                    <div class="singleMeta clearfix">
                        
                        <h1><?php the_title(); ?></h1>
                        <span><?php _e('By', 'localization'); ?> <?php the_author(); ?> | <?php _e('In', 'localization'); ?> <?php the_category(', ');?> | on <?php the_time('F j, Y'); ?> </span>
                        
                            <?php if( $contactemail) { ?>
                        
                        <a class="singleContact button-small-theme rounded3" href="mailto:<?php echo $contactemail; ?>"><?php _e('CONTACT', 'localization'); ?> <?php the_title(); ?></a>
                           
                                    <?php } ?>
                        
                    </div>
                    
                                          <?php if( $quote) { ?>
                                    
                    <div class="singleQuote">
                        
                        <p><?php echo $quote; ?></p>
                        
                    </div>
                                    
                                                <?php } ?>
                    
                </div>
                
                <div class="pageContent">
                    
                            <?php the_content(); ?>
                 
                </div>
                
                                <?php comments_template( '', true ); ?>
                
                <div style="display:none;"><?php comment_form(); ?></div>
                
                
<?php }
        } else { ?>

            <div class="post box">
                <h3><?php _e('There is not post available.', 'localization'); ?></h3>

            </div>

<?php } ?>
                

                
            </div>
            
            <ul class="sidebar one-third column clearfix">
               
                   <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Single Blog Post")) ; ?>
                
            </ul>
            
        </div>
        
    </div>




<?php get_footer(); ?>

