<?php get_header(); ?>

<div class="sliderWrapper">
        
          <div id="slider" class="flexslider">

              <div class="whiteTop"></div>
              <div class="whiteTop2"></div>
              
        <ul class="slides">
        
            
                   <?php if ( function_exists( 'ot_get_option' ) ) {
  
  /* get the slider array */
  $slides = ot_get_option( 'my_slider', array() );
  
  if ( ! empty( $slides ) ) {
    foreach( $slides as $slide ) {
        
     	echo '<li><a href="'.$slide['btnurl'].'"><img src="'.$slide['image'].'" alt="'.$slide['title'].'" /></a><div class="slidesDescription">';
                            
                                     if($slide['title']) {
                      echo '<h2>'.$slide['title'].'</h2>';
                                     }
                         if($slide['title2']) {
                             
                       echo ' <span>'.$slide['title2'].'</span> ';
                         }
                                     
                        if($slide['btnurl']) { 
                       
                       echo ' <a class="button-big rounded3 grey" href="'.$slide['btnurl'].'">'.$slide['btntext'].'</a>';
                            
                        }
                        
                       echo ' </div></li>';

  }
  
} 

                    }
                    
                    ?>
                            
             
        </ul>
        
    </div>

    <div id="carousel">

        <ul class="slides container">
 
            
                   <?php if ( function_exists( 'ot_get_option' ) ) {
  
  /* get the slider array */
  $slides = ot_get_option( 'my_slider', array() );
  
  if ( ! empty( $slides ) ) {
    foreach( $slides as $slide ) {
        
     	echo '<li class="four columns">';
                            
            if($slide['thumbimage']) { 
        
        	echo '<img src="'.$slide['thumbimage'].'" alt="'.$slide['title'].'" />';
                
            }
        
        echo'<div class="navDescription">';
        
                                     if($slide['title']) {
                      echo '<h3>'.$slide['title'].'</h3>';
                                     }
                         if($slide['title2']) {
                             
                       echo ' <p>'.$slide['title2'].'</p> ';
                         }
                                     
                   
                        
                       echo ' </div></li>';

  }
  
} 

                    }
                    
                    ?>
 
        </ul>
        
    </div>
        
    </div>

<div class="container">
    
    <ul class="sixteen columns homeHorizontalWidget">
        
                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Home Horizontal Widget")) ; ?>
        
    </ul>
    
    
</div>

<div class="widgetModuleWrapper">
        
    <ul class="widgetModule container clearfix">
        
          <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Widgetized Module")) ; ?>
        
    </ul>
    
</div>

   



<?php get_footer(); ?>