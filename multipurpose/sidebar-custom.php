<?php
$options = get_post_custom($post->ID);  
$sidebar_choice = $options['custom_sidebar'][0];  
  
?>  
<aside class="sidebar">  
        <?php 
        if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) :   
            dynamic_sidebar($sidebar_choice);  
        else :   
            /* No widget */  
        endif; ?>    
</aside> 