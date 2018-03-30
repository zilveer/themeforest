<?php if( function_exists('has_post_thumbnail') && has_post_thumbnail() ) { ?>
    
    <!--BEGIN .post-media -->
    <div class="post-media post-thumb">
        <?php the_post_thumbnail('thumbnail-large'); ?>        
    <!--END .post-media -->
    </div>
    
<?php } ?>
