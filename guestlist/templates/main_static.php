<?php 


include_once dirname(__FILE__).'/../header.php'; 


wp_reset_query();
        
     if($bSettings->get('static_mainpage_type') == "page")
     {
         $q = array('page_id' => $bSettings->get('static_mainpage_page_id'));
         
         $content = new WP_Query($q);
         if($content->have_posts())
                {
                    $content->the_post();
                }
         
     }else {
         $content = $bSettings->get('static_mainpage_content');
     }
     
            

        
    
    ?>

  <div id="container">
    <a href="<?php echo home_url('/') ?>">
        <?php if($logo = $bSettings->get('logo_website')): ?>  
            <img src="<?php echo $logo ?>" id="logo" alt="logo" />
        <?php else: ?>
            <img src="<?php bloginfo('stylesheet_directory') ?>/images/main/logo.png" id="logo" alt="logo" />
        <?php endif ?>
    </a>
    
      
     
    <div id="main_static" role="main">
        <div class="main_static">
            <?php if(is_object($content)): ?>    
                <h1><?php the_title(); ?></h1> 
            <?php endif; ?>    
            <div id="static_main_scrollbar">
                <div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
                <div class="viewport">
                    <div class="overview">
                        
            
            
            <?php if(is_object($content)): ?>    
                <div class="content"><?php the_content(); ?></div>
            <?php else: ?>
                <?php echo $content ?>
            <?php endif; ?>
            
            
                    </div>
                </div>
            </div>	
                
                
            

        </div>
    </div>
  </div> <!--! end of #container -->
  
<?php
  
include_once dirname(__FILE__).'/../footer.php'; 

?>