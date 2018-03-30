<?php
    if(have_posts()) :
        while(have_posts()) : the_post();
        get_template_part( 'content', get_post_format() );
        endwhile;
    endif; 
    // wp_reset_query();
?>