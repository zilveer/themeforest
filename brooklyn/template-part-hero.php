<?php 
    
if( is_front_page() /* settings > reading > Front page */
    || is_home() /* settings > reading > Posts page */
    || ( get_post_meta( get_the_ID() , 'ut_activate_page_hero' , true ) == 'on' && !ut_is_shop() ) /* all other pages except woocommerce main shop page / portfolio */
    || ( is_singular('portfolio') && get_post_meta( get_the_ID() , 'ut_activate_page_hero' , true ) != 'off' ) /* portfolio plugin  */
    || ( ut_is_shop() && get_post_meta( get_option('woocommerce_shop_page_id') , 'ut_activate_page_hero' , true ) == 'on' ) /* woocommerce main shop page  */
) : 

/* get hero template part based on hero type */
get_template_part( 'partials/hero', ut_return_hero_config('ut_hero_type') );  ?>
    
<div class="clear"></div>      
       
<?php endif; ?>