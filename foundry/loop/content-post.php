<?php $format = get_post_format(); ?>

<div class="post-snippet mb64">

    <?php 
    	get_template_part('inc/content-format', $format);
    	get_template_part('inc/content','post-title'); 
    	get_template_part('inc/content','post-meta'); 
    ?>
    
    <hr>
    
    <?php 
    	if( '' == $format ){
    		the_excerpt();
    		echo '<a class="btn btn-sm" href="'. esc_url(get_permalink()) .'">'. __('Read More','foundry') .'</a>';
    	}
    ?>
    
</div>