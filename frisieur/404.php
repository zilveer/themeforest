<?php

   /**
    *
    * 404.php page
    * - not found page    
    * 
    * @author: Martanian <hello@martanian.com>
    *        
    */                    
    
    get_header();

?>
<section id="not-found">
                
    <h3><?php _e( 'Page <span>not found</span>', 'martanian' ); ?></h3>
    <div class="header-line">
                                
        <div class="gray-line"></div>
        <div class="color-line"></div>
    
    </div>
    
    <p class="space"><?php _e( 'It looks like nothing was found here.', 'martanian' ); ?></p>
    <p><?php _e( 'Please try one of the links below or use this search form:', 'martanian' ); ?></p>
    
    <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
                       
        <input type="text" placeholder="<?php _e( 'Type and hit enter...', 'martanian' ); ?>" value="<?php echo get_search_query(); ?>" name="s" id="search-form" />
     
    </form>

</section>
<?php get_footer(); ?>