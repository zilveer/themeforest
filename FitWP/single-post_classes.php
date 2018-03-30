<?php get_header(); ?>




 <div class="pageInfo">
        
        <div class="container">
            
           <div class="eight columns pageTitle">
                
                      <?php if (ot_get_option('classestitle')) {  ?>
                
                <h1><?php echo ot_get_option('classestitle') ?></h1>
                
                    <?php } else { ?>
                
                
                <h1><?php _e('OUR CLASSES', 'localization'); ?></h1>
                    <?php } ?>
                
            </div>
            
            <div class="eight columns breadcrumb">
               
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
$difficulty= get_post_meta(get_the_ID(), 'difficulty', true);


?>

                 <div class="singleInfo">
        
                    
                        <?php if( $bigimg) { ?>
                                
                                    <div class="singleThumb"><img src="<?php echo $bigimg; ?>" alt="" /></div>
    
      <?php } ?>
                                
                                  
                    <div class="singleMeta clearfix">
                        
                        <h1><?php the_title(); ?></h1>
                        
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
                
                
<?php }
        } else { ?>

            <div class="post box">
                <h3><?php _e('There is not post available.', 'localization'); ?></h3>

            </div>

<?php } ?>
                

                
            </div>
            
              <ul class="sidebar one-third column clearfix">
               
                          <?php if( $difficulty) { ?>
                                    
                     <li class="widget">
                    
                      <div class="classesInfo">
                          
                        <h3><?php _e('DIFFICULTY LEVEL', 'localization'); ?></h3>			
                       
                       <?php echo $difficulty; ?>
                        
		</div>
                    
                </li>
                
                    <?php } ?>
                
                   <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Single Classes")) ; ?>
                
            </ul>
            
        </div>
        
    </div>





<?php get_footer(); ?>

