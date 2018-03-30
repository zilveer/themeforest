<?php

   /**
    *
    * index.php file display latest
    * blog posts - it is default theme file
    * 
    * @author: Martanian <hello@martanian.com>
    *        
    */                    
    
    get_header();

?>
<section id="standard-page">

    <?php
    
        while( have_posts() ) {
            
            the_post();
            the_content();
        }
    
    ?>
        
</section>
<?php get_footer(); ?>